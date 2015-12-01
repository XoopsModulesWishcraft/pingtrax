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
 * Class PintraxSitemaps
 * 
 * Database MySQL Table:-
 * 
 * CREATE TABLE `pingtrax_sitemaps` (
 *   `id` int(10) NOT NULL AUTO_INCREMENT,
 *   `referer` varchar(44) NOT NULL DEFAULT '',
 *   `protocol` enum('https://','http://') NOT NULL DEFAULT 'http://',
 *   `domain` varchar(100) NOT NULL DEFAULT '',
 *   `baseurl` varchar(100) NOT NULL DEFAULT '',
 *   `filename` varchar(65) NOT NULL DEFAULT '',
 *   `items` int(18) NOT NULL DEFAULT '0',
 *   `bytes` int(18) NOT NULL DEFAULT '0',
 *   `successful-pings` int(18) NOT NULL DEFAULT '0',
 *   `failed-pings` int(18) NOT NULL DEFAULT '0',
 *   `sleep-till` int(12) NOT NULL DEFAULT '0',
 *   `success-time` int(12) NOT NULL DEFAULT '0',
 *   `failure-time` int(12) NOT NULL DEFAULT '0',
 *   `written` int(12) NOT NULL DEFAULT '0',
 *   `created` int(12) NOT NULL DEFAULT '0',
 *   `updated` int(12) NOT NULL DEFAULT '0',
 *   `offlined` int(12) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`id`,`referer`,`protocol`,`filename`,`domain`,`baseurl`) USING BTREE,
 *   KEY `CHRONOLOGISTICS` (`id`,`written`,`created`,`updated`,`offlined`,`referer`) USING BTREE KEY_BLOCK_SIZE=64
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=16;
 *
 * @subpackage      pingtrax
 */
class PingtraxSitemaps extends XoopsObject
{
    /**
     *
     */
    function __construct()
    {
        $this->XoopsObject();
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('referer', XOBJ_DTYPE_OTHER, sha1(NULL), true, 44);
        $this->initVar('protocol', XOBJ_DTYPE_ENUM, 'http://', true, false, false, false, array('https://','http://'));
        $this->initVar('domain', XOBJ_DTYPE_TXTBOX, parse_url(XOOPS_URL, PHP_URL_HOST), true, 100);
        $this->initVar('baseurl', XOBJ_DTYPE_TXTBOX, parse_url(XOOPS_URL, PHP_URL_PATH), true, 100);
        $this->initVar('filename', XOBJ_DTYPE_TXTBOX, 'sitemap.'.parse_url(XOOPS_URL, PHP_URL_HOST).'.xml', true, 64);
        $this->initVar('items', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('bytes', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('successful-pings', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('failed-pings', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('sleep-till', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('success-time', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('failure-time', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('written', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('created', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('updated', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('offline', XOBJ_DTYPE_INT, 0, false);
    }

}

/**
 * Class PintraxSitemapsHandler
 */
class PintraxSitemapsHandler extends XoopsPersistableObjectHandler
{

    /**
     * @param null|object $db
     */
    function __construct(&$db)
    {
        parent::__construct($db, "pingtrax_sitemaps", 'PingtraxSitemaps', 'id', 'referer');
    }

 
}
