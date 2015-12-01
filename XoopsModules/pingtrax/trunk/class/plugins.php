<?php
/**
 * PingTrax Constructor for Plugin's
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   Chronolabs Cooperative http://sourceforge.net/projects/chronolabs/
 * @license     GNU GPL 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @author      Simon Antony Roberts <wishcraft@users.sourceforge.net>
 * @see			http://sourceforge.net/projects/xoops/
 * @see			http://sourceforge.net/projects/chronolabs/
 * @see			http://sourceforge.net/projects/chronolabsapi/
 * @see			http://labs.coop
 * @version     1.0.1
 * @since		1.0.1
 */

defined('XOOPS_ROOT_PATH') || die('XOOPS root path not defined');

/**
 * Class PingtraxPlugins
 */
class PingtraxPlugins extends XoopsObject
{
  
	/**
	 *
	 */
	function __construct()
	{
		$this->XoopsObject();
	}
 
	/**
	 * 
	 */
	function getModuleDirname()
	{
		if (is_a($GLOBALS['xoopsModule'], 'XoopsModule'))
		{
			return $GLOBALS['xoopsModule']->getVar('dirname');
		}
	}

	/**
	 *
	 */
	function getModuleClass()
	{
		switch ($this->getModulePHPSelf())
		{
			default:
				
				foreach(get_declared_classes() as $class)
				{ 
					if (substr(strtolower($class), 0, strlen($this->getModuleDirname()))==strtolower($this->getModuleDirname()) && (!strpos(strtolower($class), 'categor') && !strpos(strtolower($this->getModulePHPSelf()), 'categor')))
					{
						if (is_a(new $class(), "XoopsPersistableObjectHandler"))
							return $class;
					}
				}
				
				break;
		}
	}

	/**
	 *
	 */
	function getModuleItemID()
	{
		$id = 0;
		switch ($this->getModulePHPSelf())
		{
			default:
				
				$idnaming = explode(array("\n", "\n\r", "\r\n"), file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'item-id-names.txt'));
				foreach($_GET as $key => $value)
				{
					if (!is_array($value))
					{
						foreach($idnaming as $idname)
						{
							if (strpos($key, $idname) && is_numeric($_GET[$key]))
								$id = $_GET[$key];
							elseif (is_numeric($_GET[$key]) && !in_array($key, explode(array("\n", "\n\r", "\r\n"), file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'exclude-names.txt'))))
								$id = $_GET[$key];
						}
					}
				}
		}
		return $id;
	}
	
	/**
	 *
	 */
	function getModulePHPSelf()
	{
		$parts = explode(DIRECTORY_SEPARATOR, $this->getItemPHPSelf());
		$found = false;
		foreach($parts as $id => $value)
		{
			if ($found == false)
				unset($parts[$id]);
			if ($value == 'modules')
				$found = true;
		}
		return implode(DIRECTORY_SEPARATOR, $parts);
	}

	/**
	 *
	 */
	function getModuleGet()
	{
		return $_GET;
	}


	/**
	 *
	 */
	function getItemCategoryID()
	{
		$id = 0;
		switch ($this->getModulePHPSelf())
		{
			default:
		
				$idnaming = explode(array("\n", "\n\r", "\r\n"), file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'category-id-names.txt'));
				foreach($_GET as $key => $value)
				{
					if (!is_array($value))
					{
						foreach($idnaming as $idname)
						{
							if (strpos($key, $idname) && is_numeric($_GET[$key]))
								$id = $_GET[$key];
							elseif ($id = 0 && is_numeric($_GET[$key]) && !in_array($key, explode(array("\n", "\n\r", "\r\n"), file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'exclude-names.txt'))))
								$id = $_GET[$key];
						}
					}
				}
		}
		return $id;
	}
	
	/**
	 *
	 */
	function getItemProtocol()
	{
		return strtolower(XOOPS_PROT);
	}

	/**
	 *
	 */
	function getItemDomain()
	{
		return parse_url(strtolower(XOOPS_URL), PHP_URL_HOST);
	}

	/**
	 *
	 */
	function getItemRefererURI()
	{
		if (parse_url(strtolower(XOOPS_URL), PHP_URL_PATH) == substr(strtolower($_SERVER["REQUEST_URI"]), 0, strlen(parse_url(strtolower(XOOPS_URL), PHP_URL_PATH))))
			return substr($_SERVER["REQUEST_URI"], strlen(parse_url(strtolower(XOOPS_URL), PHP_URL_PATH))-1);
		return $_SERVER["REQUEST_URI"];
	}

	/**
	 *
	 */
	function getItemPHPSelf()
	{
		if (XOOPS_ROOT_PATH == substr(strtolower($_SERVER["REQUEST_URI"]), 0, strlen(XOOPS_ROOT_PATH)))
			return substr($_SERVER["PHP_SELF"], strlen(XOOPS_ROOT_PATH)-1);
		return $_SERVER["PHP_SELF"];
	}
}


/**
 * Class PingtraxPluginsHandler
 */
class PingtraxPluginsHandler extends XoopsPersistableObjectHandler
{

	/**
	 * @var string
	 */
	var $_default = 'default';

	/**
	 * @var array
	 */
	var $_plugins = array();
		
	/**
	 * @param null|object $db
	 */
	function __construct(&$db)
	{
		parent::__construct($db);
	}

	function getIntialItemArray()
	{
		$ret = array();
		if (is_a($GLOBALS['xoopsModule'], 'XoopsModule'))
		{
			if (file_exists($file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . ($dirname = $GLOBALS['xoopsModule']->getVar('dirname')) . '.php'))
			{
				require_once $file;
			} elseif (file_exists($file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . ($dirname = $this->_default) . '.php'))
			{
				require_once $file;
			}
		} elseif (file_exists($file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . ($dirname = $this->_default) . '.php'))
		{
			require_once $file;
		}
		if (class_exists($class = "PingtraxPlugins".ucfirst(strtolower($dirname))) && empty($this->_plugins[$dirname]))
		{
			$this->_plugins[$dirname] = new $class();
		}
		if (is_object($this->_plugins[$dirname]))
		{
			$ret['module-dirname'] = $this->_plugins[$dirname]->getModuleDirname();
			$ret['module-class'] = $this->_plugins[$dirname]->getModuleClass();
			$ret['module-item-id'] = $this->_plugins[$dirname]->getModuleItemID();
			$ret['module-php-self'] = $this->_plugins[$dirname]->getModulePHPSelf();
			$ret['module-get'] = $this->_plugins[$dirname]->getModuleGet();
			$ret['item-category-id'] = $this->_plugins[$dirname]->getItemCategoryID();
			$ret['item-protocol'] = $this->_plugins[$dirname]->getItemProtocol();
			$ret['item-domain'] = $this->_plugins[$dirname]->getItemDomain();
			$ret['item-referer-uri'] = $this->_plugins[$dirname]->getItemRefererURI();
			$ret['item-php-self'] = $this->_plugins[$dirname]->getItemPHPSelf();
			$ret['referer'] = $this->getReferer($ret);
		}
		return $ret;
	}
	
	function getReferer($ret = array())
	{
		return sha1($ret['item-php-self'] . $ret['item-referer-uri'] . $ret['module-dirname'] . $ret['module-class'] . $ret['item-category-id'] . $ret['module-item-id'] . $ret['module-php-self'] . json_encode($ret['module-get'], true) . $ret['item-protocol'] . $ret['item-domain']);
	}
}
