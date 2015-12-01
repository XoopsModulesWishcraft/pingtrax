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
 * Class PintraxItems_sitemaps
 *
 * @subpackage      itemtrax
 *
 * Database MySQL Table:-
 * 
 * CREATE TABLE `itemtrax_items_sitemaps` (
 *   `id` mediumint(32) NOT NULL AUTO_INCREMENT,
 *   `map-referer` varchar(44) NOT NULL DEFAULT '',
 *   `item-referer` varchar(44) NOT NULL DEFAULT '',
 *   `when` int(12) NOT NULL DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`id`,`map-referer`,`item-referer`) USING BTREE,
 *   KEY `CHRONOLOGISTICS` (`map-referer`,`item-referer`,`when`) USING BTREE KEY_BLOCK_SIZE=64
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=8;
 *
 */
class PingtraxItems_sitemaps extends XoopsObject
{
    /**
     *
     */
    function __construct()
    {
        $this->XoopsObject();
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('map-referer', XOBJ_DTYPE_TXTBOX, null, true, 44);
        $this->initVar('item-referer', XOBJ_DTYPE_TXTBOX, null, true, 44);
        $this->initVar('when', XOBJ_DTYPE_INT, 0, false);
    }

}

/**
 * Class PintraxItems_sitemapsHandler
 */
class PintraxItems_sitemapsHandler extends XoopsPersistableObjectHandler
{

    /**
     * @param null|object $db
     */
    function __construct(&$db)
    {
        parent::__construct($db, "itemtrax_items_sitemaps", 'PingtraxItems_sitemaps', 'id', 'map-referer');
    }

 
}
