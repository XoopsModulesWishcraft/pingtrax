
DROP TABLE IF EXISTS `pingtrax_items`;

CREATE TABLE `pingtrax_items` (
  `id` mediumint(20) NOT NULL AUTO_INCREMENT,
  `referer` varchar(44) NOT NULL DEFAULT '',
  `type` enum('local','remote','unknown') NOT NULL DEFAULT 'unknown',
  `module-dirname` varchar(30) NOT NULL DEFAULT '',
  `module-class` varchar(100) NOT NULL DEFAULT '',
  `module-item-id` mediumint(30) NOT NULL DEFAULT '0',
  `module-php-self` varchar(150) NOT NULL DEFAULT '',
  `module-get` tinytext,
  `item-author-uid` int(13) NOT NULL DEFAULT '0',
  `item-author-name` varchar(64) NOT NULL DEFAULT '',
  `item-id` int(20) NOT NULL DEFAULT '0',
  `item-category-id` int(20) NOT NULL DEFAULT '0',
  `item-title` varchar(180) NOT NULL DEFAULT '',
  `item-description` varchar(250) NOT NULL DEFAULT '',
  `item-protocol` enum('https://','http://') NOT NULL DEFAULT 'http://',
  `item-domain` varchar(150) NOT NULL DEFAULT '',
  `item-referer-uri` varchar(250) NOT NULL DEFAULT '',
  `item-php-self` varchar(250) NOT NULL DEFAULT '',
  `feed-protocol` enum('https://','http://') NOT NULL DEFAULT 'http://',
  `feed-domain` varchar(150) NOT NULL DEFAULT '',
  `feed-referer-uri` varchar(250) NOT NULL DEFAULT '',
  `discovery-hook` enum('php','preloader','smarty','combination','unknown') NOT NULL DEFAULT 'unknown',
  `user-session` enum('admin','user','guest','unknown') NOT NULL DEFAULT 'unknown',
  `created` int(12) NOT NULL DEFAULT '0',
  `updated` int(12) NOT NULL DEFAULT '0',
  `offlined` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`referer`,`item-author-uid`,`item-author-name`,`module-dirname`,`item-protocol`,`item-domain`,`item-referer-uri`,`module-php-self`,`item-php-self`,`discovery-hook`,`id`) KEY_BLOCK_SIZE=128,
  KEY `CHRONOLOGISTICS` (`id`,`referer`,`created`,`updated`,`offlined`) USING BTREE KEY_BLOCK_SIZE=64
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=16;


DROP TABLE IF EXISTS `pingtrax_items_pings`;

CREATE TABLE `pingtrax_items_pings` (
  `id` mediumint(32) NOT NULL AUTO_INCREMENT,
  `ping-referer` varchar(44) NOT NULL DEFAULT '',
  `item-referer` varchar(44) NOT NULL DEFAULT '',
  `when` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`id`,`ping-referer`,`item-referer`) USING BTREE,
  KEY `CHRONOLOGISTICS` (`ping-referer`,`item-referer`,`when`) USING BTREE KEY_BLOCK_SIZE=64
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=8;

DROP TABLE IF EXISTS `pingtrax_items_sitemaps`;

CREATE TABLE `pingtrax_items_sitemaps` (
  `id` mediumint(32) NOT NULL AUTO_INCREMENT,
  `map-referer` varchar(44) NOT NULL DEFAULT '',
  `item-referer` varchar(44) NOT NULL DEFAULT '',
  `when` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`id`,`map-referer`,`item-referer`) USING BTREE,
  KEY `CHRONOLOGISTICS` (`map-referer`,`item-referer`,`when`) USING BTREE KEY_BLOCK_SIZE=64
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=8;

DROP TABLE IF EXISTS `pingtrax_pings`;

CREATE TABLE `pingtrax_pings` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `referer` varchar(44) NOT NULL DEFAULT '',
  `type` enum('XML-RPC','SITEMAPS') NOT NULL DEFAULT 'XML-RPC',
  `uri` varchar(250) NOT NULL DEFAULT '',
  `last-item-referer` varchar(44) NOT NULL DEFAULT '',
  `successful-pings` int(18) NOT NULL DEFAULT '0',
  `failed-pings` int(18) NOT NULL DEFAULT '0',
  `sleep-till` int(12) NOT NULL DEFAULT '0',
  `success-time` int(12) NOT NULL DEFAULT '0',
  `failure-time` int(12) NOT NULL DEFAULT '0',
  `created` int(12) NOT NULL DEFAULT '0',
  `updated` int(12) NOT NULL DEFAULT '0',
  `offlined` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`referer`,`type`,`uri`),
  KEY `SEARCH` (`referer`,`type`,`uri`,`last-item-referer`,`successful-pings`,`failed-pings`,`id`) USING BTREE,
  KEY `CHRONOLOGISTICS` (`id`,`referer`,`created`,`updated`,`offlined`,`failure-time`,`success-time`,`sleep-till`) USING BTREE KEY_BLOCK_SIZE=128
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8 PACK_KEYS=1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=16;

DROP TABLE IF EXISTS `pingtrax_pings_sitemaps`;

CREATE TABLE `pingtrax_pings_sitemaps` (
  `id` mediumint(32) NOT NULL AUTO_INCREMENT,
  `map-referer` varchar(44) NOT NULL DEFAULT '',
  `ping-referer` varchar(44) NOT NULL DEFAULT '',
  `when` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`id`,`map-referer`,`ping-referer`) USING BTREE,
  KEY `CHRONOLOGISTICS` (`map-referer`,`ping-referer`,`when`) USING BTREE KEY_BLOCK_SIZE=64
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=8;

DROP TABLE IF EXISTS `pingtrax_sitemaps`;

CREATE TABLE `pingtrax_sitemaps` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `referer` varchar(44) NOT NULL DEFAULT '',
  `protocol` enum('https://','http://') NOT NULL DEFAULT 'http://',
  `domain` varchar(100) NOT NULL DEFAULT '',
  `baseurl` varchar(100) NOT NULL DEFAULT '',
  `filename` varchar(65) NOT NULL DEFAULT '',
  `items` int(18) NOT NULL DEFAULT '0',
  `bytes` int(18) NOT NULL DEFAULT '0',
  `successful-pings` int(18) NOT NULL DEFAULT '0',
  `failed-pings` int(18) NOT NULL DEFAULT '0',
  `sleep-till` int(12) NOT NULL DEFAULT '0',
  `success-time` int(12) NOT NULL DEFAULT '0',
  `failure-time` int(12) NOT NULL DEFAULT '0',
  `written` int(12) NOT NULL DEFAULT '0',
  `created` int(12) NOT NULL DEFAULT '0',
  `updated` int(12) NOT NULL DEFAULT '0',
  `offlined` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`id`,`referer`,`protocol`,`filename`,`domain`,`baseurl`) USING BTREE,
  KEY `CHRONOLOGISTICS` (`id`,`written`,`created`,`updated`,`offlined`,`referer`) USING BTREE KEY_BLOCK_SIZE=64
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC KEY_BLOCK_SIZE=16;

