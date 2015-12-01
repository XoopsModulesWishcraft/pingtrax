<?php
/**
 * Pintrax Database Class Handler module
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
 * Class PintraxItems
 *
 * @subpackage      pingtrax
 *
 * Database MySQL Table:-
 * 
 * CREATE TABLE `pingtrax_items` (
 *   `id` mediumint(20) NOT NULL AUTO_INCREMENT,
 *   `referer` varchar(44) NOT NULL DEFAULT '',
 *   `type` enum('local','remote','unknown') NOT NULL DEFAULT 'unknown',
 *   `module-dirname` varchar(30) NOT NULL DEFAULT '',
 *   `module-class` varchar(100) NOT NULL DEFAULT '',
 *   `module-item-id` mediumint(30) NOT NULL DEFAULT '0',
 *   `module-php-self` varchar(150) NOT NULL DEFAULT '',
 *   `module-get` tinytext,
 *   `item-author-uid` int(13) NOT NULL DEFAULT '0',
 *   `item-author-name` varchar(64) NOT NULL DEFAULT '',
 *   `item-category-id` int(20) NOT NULL DEFAULT '0',
 *   `item-title` varchar(180) NOT NULL DEFAULT '',
 *   `item-description` varchar(250) NOT NULL DEFAULT '',
 *   `item-protocol` enum('https://','http://') NOT NULL DEFAULT 'http://',
 *   `item-domain` varchar(150) NOT NULL DEFAULT '',
 *   `item-referer-uri` varchar(250) NOT NULL DEFAULT '',
 *   `item-php-self` varchar(250) NOT NULL DEFAULT '',
 *   `feed-protocol` enum('https://','http://') NOT NULL DEFAULT 'http://',
 *   `feed-domain` varchar(150) NOT NULL DEFAULT '',
 *   `feed-referer-uri` varchar(250) NOT NULL DEFAULT '',
 *   `discovery-hook` enum('php','preloader','smarty','combination','unknown') NOT NULL DEFAULT 'unknown',
 *   `user-session` enum('admin','user','guest','unknown') NOT NULL DEFAULT 'unknown',
 *   `created` int(12) NOT NULL DEFAULT '0',
 *   `updated` int(12) NOT NULL DEFAULT '0',
 *   `offlined` int(12) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`referer`,`item-author-uid`,`item-author-name`,`module-dirname`,`item-protocol`,`item-domain`,`item-referer-uri`,`module-php-self`,`item-php-self`,`discovery-hook`,`id`) KEY_BLOCK_SIZE=128,
 *   KEY `CHRONOLOGISTICS` (`id`,`referer`,`created`,`updated`,`offlined`) USING BTREE KEY_BLOCK_SIZE=64
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=16;
 */
class PingtraxItems extends XoopsObject
{
    /**
     *
     */
    function __construct()
    {
        $this->XoopsObject();
   		$this->initVar('id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('referer', XOBJ_DTYPE_OTHER, sha1(NULL), false, 44);
        $this->initVar('type', XOBJ_DTYPE_ENUM, 'unknown', true, false, false, false, array('local','remote','unknown'));
        $this->initVar('module-dirname', XOBJ_DTYPE_OTHER, '', false, 30);
        $this->initVar('module-class', XOBJ_DTYPE_OTHER, '', false, 100);
        $this->initVar('module-item-id', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('module-php-self', XOBJ_DTYPE_OTHER, '', false, 150);
        $this->initVar('module-get', XOBJ_DTYPE_ARRAY, array(), false);
  		$this->initVar('item-author-uid', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('item-author-name', XOBJ_DTYPE_TXTBOX, 0, false, 64);
        $this->initVar('item-title', XOBJ_DTYPE_TXTBOX, 0, false, 180);
        $this->initVar('item-description', XOBJ_DTYPE_TXTBOX, 0, false, 250);
        $this->initVar('item-protocol', XOBJ_DTYPE_ENUM, XOOPS_PROT, true, false, false, false, array('https://','http://'));
        $this->initVar('item-domain', XOBJ_DTYPE_TXTBOX, parse_url(XOOPS_URL, PHP_URL_HOST), true, 150);
        $this->initVar('item-referer-uri', XOBJ_DTYPE_TXTBOX, $_SERVER["REQUEST_URI"], true, 250);
        $this->initVar('item-php-self', XOBJ_DTYPE_TXTBOX, str_replace(XOOPS_ROOT_PATH, "", $_SERVER["PHP_SELF"]), true, 250);
        $this->initVar('feed-protocol', XOBJ_DTYPE_ENUM, XOOPS_PROT, true, false, false, false, array('https://','http://'));
        $this->initVar('feed-domain', XOBJ_DTYPE_TXTBOX, parse_url(XOOPS_URL, PHP_URL_HOST), true, 150);
        $this->initVar('feed-referer-uri', XOBJ_DTYPE_TXTBOX, parse_url(XOOPS_URL, PHP_URL_PATH) . '/backend.php', true, 250);
        $this->initVar('discovery-hook', XOBJ_DTYPE_ENUM, 'unknown', true, false, false, false, array('php','preloader','smarty','combination','unknown'));
        $this->initVar('user-session', XOBJ_DTYPE_ENUM, 'unknown', true, false, false, false, array('admin','user','guest','unknown'));
        $this->initVar('written', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('created', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('updated', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('offline', XOBJ_DTYPE_INT, 0, false);
    }

}

/**
 * Class PintraxItemsHandler
 */
class PintraxItemsHandler extends XoopsPersistableObjectHandler
{

    /**
     * @param null|object $db
     */
    function __construct(&$db)
    {
        parent::__construct($db, "pingtrax_items", 'PingtraxItems', 'id', 'referer');
    }

 
}
