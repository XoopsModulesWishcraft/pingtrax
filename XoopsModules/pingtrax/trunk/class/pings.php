<?php
/**
 * Pingtrax Database Class Handler module
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


/**
 * Class PingtraxPings
 *
 * @subpackage      pingtrax
 *
 * Database MySQL Table:-
 * 
 * CREATE TABLE `pingtrax_pings` (
 *   `id` int(14) NOT NULL AUTO_INCREMENT,
 *   `referer` varchar(44) NOT NULL DEFAULT '',
 *   `type` enum('XML-RPC','SITEMAPS') NOT NULL DEFAULT 'XML-RPC',
 *   `uri` varchar(250) NOT NULL DEFAULT '',
 *   `last-item-referer` varchar(44) NOT NULL DEFAULT '',
 *   `successful-pings` int(18) NOT NULL DEFAULT '0',
 *   `failed-pings` int(18) NOT NULL DEFAULT '0',
 *   `sleep-till` int(12) NOT NULL DEFAULT '0',
 *   `success-time` int(12) NOT NULL DEFAULT '0',
 *   `failure-time` int(12) NOT NULL DEFAULT '0',
 *   `created` int(12) NOT NULL DEFAULT '0',
 *   `updated` int(12) NOT NULL DEFAULT '0',
 *   `offlined` int(12) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`,`referer`,`type`,`uri`),
 *   KEY `SEARCH` (`referer`,`type`,`uri`,`last-item-referer`,`successful-pings`,`failed-pings`,`id`) USING BTREE,
 *   KEY `CHRONOLOGISTICS` (`id`,`referer`,`created`,`updated`,`offlined`,`failure-time`,`success-time`,`sleep-till`) USING BTREE KEY_BLOCK_SIZE=128
 * ) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8 PACK_KEYS=1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=16;
 *
 */
class PingtraxPings extends XoopsObject
{
    /**
     *
     */
    function __construct()
    {
        $this->XoopsObject();
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('referer', XOBJ_DTYPE_OTHER, sha1(NULL), false, 44);
        $this->initVar('type', XOBJ_DTYPE_ENUM, 'XML-RPC', true, false, false, false, array('XML-RPC','SITEMAPS'));
        $this->initVar('uri', XOBJ_DTYPE_TXTBOX, null, true, 250);
        $this->initVar('last-item-referer', XOBJ_DTYPE_OTHER, sha1(NULL), false, 44);
  		$this->initVar('successful-pings', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('failed-pings', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('sleep-till', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('success-time', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('failure-time', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('created', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('updated', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('offline', XOBJ_DTYPE_INT, 0, false);
    }

}

/**
 * Class PingtraxPingsHandler
 */
class PingtraxPingsHandler extends XoopsPersistableObjectHandler
{

	/**
	 * var string		URL of JSON Resource for Install
	 */
	var $_resource 	=	"https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/pingtrax/data/ping-resources.json?format=raw";
	
    /**
     * @param null|object $db
     */
    function __construct(&$db)
    {
        parent::__construct($db, "pingtrax_pings", 'PingtraxPings', 'id', 'referer');
        
        $criteria = new Criteria('id',0,"<>");
        if ($this->getCount($criteria)==0)
        {
        	$data = json_decode(file_get_contents($this->_resource), true);
        	foreach($data as $referer => $values)
        	{
        		$obj = $this->create(true);
        		$obj->setVar('referer', $referer);
        		$obj->setVar('type', $values['type']);
        		$obj->setVar('uri', $values['uri']);
        		$this->insert($obj);
        	}
        }
    }
    
    function insert($object = NULL, $force = true)
    {
    	if ($object->isNew())
    	{
    		$object->setVar('created', time());
    	} else {
    		$object->setVar('updated', time());
    	}
    	return parent::insert($object, $force);
    }

 
}
