/*
MySQL Backup
Source Server Version: 5.5.27
Source Database: purchord
Date: 5/24/2013 19:39:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `azlref`
-- ----------------------------
DROP TABLE IF EXISTS `azlref`;
CREATE TABLE `azlref` (
  `AZLCOD` varchar(2) NOT NULL,
  `AZLDES` varchar(30) NOT NULL,
  `AZLMAX` decimal(9,0) NOT NULL,
  PRIMARY KEY (`AZLCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `calendar_events`
-- ----------------------------
DROP TABLE IF EXISTS `calendar_events`;
CREATE TABLE `calendar_events` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `date_created` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`event_id`),
  KEY `calevent_projectid` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `cgyref`
-- ----------------------------
DROP TABLE IF EXISTS `cgyref`;
CREATE TABLE `cgyref` (
  `CGYCOD` varchar(3) NOT NULL,
  `CGYDES` varchar(20) NOT NULL,
  PRIMARY KEY (`CGYCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `clgref`
-- ----------------------------
DROP TABLE IF EXISTS `clgref`;
CREATE TABLE `clgref` (
  `CLGCOD` varchar(3) NOT NULL,
  `CLGDES` varchar(10) NOT NULL,
  PRIMARY KEY (`CLGCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `country`
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `telephone` varchar(16) NOT NULL,
  `fax` varchar(16) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `cellphone` varchar(16) NOT NULL,
  `other_tel` varchar(16) DEFAULT NULL,
  `alt_contact` varchar(30) DEFAULT NULL,
  `alt_tel` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=87654325 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `delivery_code`
-- ----------------------------
DROP TABLE IF EXISTS `delivery_code`;
CREATE TABLE `delivery_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `eqpclg`
-- ----------------------------
DROP TABLE IF EXISTS `eqpclg`;
CREATE TABLE `eqpclg` (
  `EQPNBR` varchar(10) NOT NULL,
  `EQPDES` varchar(40) NOT NULL,
  PRIMARY KEY (`EQPNBR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `eqrmas`
-- ----------------------------
DROP TABLE IF EXISTS `eqrmas`;
CREATE TABLE `eqrmas` (
  `ORDNBR` varchar(10) NOT NULL,
  `ODINUM` decimal(2,0) NOT NULL,
  `EQRRLDT` datetime NOT NULL,
  `EQRINI` varchar(4) NOT NULL,
  `EQRQTY` decimal(7,2) NOT NULL,
  `EQRATD` varchar(4) DEFAULT NULL,
  `EQRAZDT` datetime DEFAULT NULL,
  `GTPNBR` varchar(8) DEFAULT NULL,
  `EQRNAM` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ORDNBR`,`ODINUM`,`EQRRLDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `gapref`
-- ----------------------------
DROP TABLE IF EXISTS `gapref`;
CREATE TABLE `gapref` (
  `GAPSRS` varchar(4) NOT NULL,
  `GAPFRDT` datetime NOT NULL,
  `GAPTODT` datetime DEFAULT NULL,
  `GAPSQN` decimal(4,0) NOT NULL,
  PRIMARY KEY (`GAPSRS`,`GAPFRDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `gtpmas`
-- ----------------------------
DROP TABLE IF EXISTS `gtpmas`;
CREATE TABLE `gtpmas` (
  `GTPNBR` varchar(8) NOT NULL,
  `GTPISDT` datetime NOT NULL,
  `GTPNAM` varchar(30) NOT NULL,
  `TFRNBR` varchar(8) DEFAULT NULL,
  `ORDNBR` varchar(10) DEFAULT NULL,
  `ODINUM` decimal(2,0) DEFAULT NULL,
  `GTPATD` varchar(4) DEFAULT NULL,
  `GTPAZDT` datetime DEFAULT NULL,
  PRIMARY KEY (`GTPNBR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `isnref`
-- ----------------------------
DROP TABLE IF EXISTS `isnref`;
CREATE TABLE `isnref` (
  `ISNKEY` varchar(5) NOT NULL,
  `ISNCPN` varchar(50) NOT NULL,
  PRIMARY KEY (`ISNKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `jclref`
-- ----------------------------
DROP TABLE IF EXISTS `jclref`;
CREATE TABLE `jclref` (
  `JCLCOD` varchar(4) NOT NULL,
  `JCLDES` varchar(30) NOT NULL,
  PRIMARY KEY (`JCLCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `location`
-- ----------------------------
DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `parish_state` varchar(45) DEFAULT NULL,
  `country` char(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `matclg`
-- ----------------------------
DROP TABLE IF EXISTS `matclg`;
CREATE TABLE `matclg` (
  `MATNBR` varchar(12) NOT NULL,
  `MATDES` varchar(40) NOT NULL,
  PRIMARY KEY (`MATNBR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `modref`
-- ----------------------------
DROP TABLE IF EXISTS `modref`;
CREATE TABLE `modref` (
  `MODCOD` varchar(2) NOT NULL,
  `MODDES` varchar(22) NOT NULL,
  PRIMARY KEY (`MODCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `odimas`
-- ----------------------------
DROP TABLE IF EXISTS `odimas`;
CREATE TABLE `odimas` (
  `ORDNBR` varchar(10) NOT NULL,
  `ODINUM` decimal(2,0) NOT NULL,
  `REQNBR` varchar(8) NOT NULL,
  `RQINUM` decimal(2,0) NOT NULL,
  `ODIRTE` decimal(5,3) NOT NULL,
  `ODISCT` decimal(11,2) NOT NULL,
  `ODIGCT` decimal(9,2) NOT NULL,
  `ODITOT` decimal(11,2) NOT NULL,
  `ODIDVY` varchar(1) NOT NULL,
  PRIMARY KEY (`ORDNBR`,`ODINUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `odsref`
-- ----------------------------
DROP TABLE IF EXISTS `odsref`;
CREATE TABLE `odsref` (
  `ODSCOD` varchar(1) NOT NULL,
  `ODSDES` varchar(14) NOT NULL,
  PRIMARY KEY (`ODSCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ordmas`
-- ----------------------------
DROP TABLE IF EXISTS `ordmas`;
CREATE TABLE `ordmas` (
  `ORDNBR` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL,
  `order_intial` varchar(4) NOT NULL,
  `REQNBR` varchar(8) NOT NULL,
  `SUPNBR` varchar(10) NOT NULL,
  `ODSCOD` varchar(1) NOT NULL,
  `ORDVAL` decimal(11,2) NOT NULL,
  `ORDATD` varchar(4) DEFAULT NULL,
  `ORDAZDT` datetime DEFAULT NULL,
  `ORDISDT` datetime DEFAULT NULL,
  `ORDNAM` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ORDNBR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `parish`
-- ----------------------------
DROP TABLE IF EXISTS `parish`;
CREATE TABLE `parish` (
  `code` varchar(2) NOT NULL,
  `parish` varchar(14) NOT NULL,
  PRIMARY KEY (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `podref`
-- ----------------------------
DROP TABLE IF EXISTS `podref`;
CREATE TABLE `podref` (
  `PODREF` varchar(4) NOT NULL,
  `PODFRDT` datetime NOT NULL,
  `PODTODT` datetime DEFAULT NULL,
  `PODSQN` decimal(6,0) NOT NULL,
  PRIMARY KEY (`PODREF`,`PODFRDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `project`
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `location` int(10) unsigned NOT NULL,
  `project_manager` int(10) unsigned NOT NULL,
  `site_telephone` varchar(16) DEFAULT NULL,
  `site_fax` varchar(16) DEFAULT NULL,
  `site_email` varchar(45) DEFAULT NULL,
  `parish_code` varchar(2) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=123461 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `prqref`
-- ----------------------------
DROP TABLE IF EXISTS `prqref`;
CREATE TABLE `prqref` (
  `PRQSRS` varchar(4) NOT NULL,
  `PRQFRDT` datetime NOT NULL,
  `PRQTODT` datetime DEFAULT NULL,
  `PRQSQN` decimal(4,0) NOT NULL,
  PRIMARY KEY (`PRQSRS`,`PRQFRDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `pwdref`
-- ----------------------------
DROP TABLE IF EXISTS `pwdref`;
CREATE TABLE `pwdref` (
  `USRID` varchar(12) NOT NULL,
  `PWDFRDT` datetime NOT NULL,
  `PWDTODT` datetime DEFAULT NULL,
  `PWDEPW` varchar(128) NOT NULL,
  PRIMARY KEY (`USRID`,`PWDFRDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rcvmas`
-- ----------------------------
DROP TABLE IF EXISTS `rcvmas`;
CREATE TABLE `rcvmas` (
  `ORDNBR` varchar(10) NOT NULL,
  `ODINUM` decimal(2,0) NOT NULL,
  `RCVRCDT` datetime NOT NULL,
  `RCVIBY` varchar(4) NOT NULL,
  `RCVQTY` decimal(7,2) NOT NULL,
  `RCVATD` varchar(4) DEFAULT NULL,
  `RCVAZDT` datetime DEFAULT NULL,
  PRIMARY KEY (`ORDNBR`,`ODINUM`,`RCVRCDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `requisition`
-- ----------------------------
DROP TABLE IF EXISTS `requisition`;
CREATE TABLE `requisition` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `req_date` date NOT NULL,
  `req_init` varchar(4) NOT NULL,
  `status_code` varchar(1) NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `delivery_code` int(10) unsigned NOT NULL,
  `date_delivery_required` date NOT NULL,
  `req_value` decimal(11,2) NOT NULL,
  `req_authorize_init` varchar(4) DEFAULT NULL,
  `authorized_date` datetime DEFAULT NULL,
  `seeking_approval` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `requisition_project_id` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `requisition_items`
-- ----------------------------
DROP TABLE IF EXISTS `requisition_items`;
CREATE TABLE `requisition_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `req_id` int(10) unsigned zerofill NOT NULL,
  `qty` decimal(10,0) NOT NULL DEFAULT '1',
  `part_no` varchar(45) DEFAULT NULL,
  `cost` decimal(10,0) DEFAULT NULL,
  `order_no` varchar(45) DEFAULT NULL,
  `supplier_id` varchar(45) NOT NULL DEFAULT '0',
  `qty_used` decimal(10,0) DEFAULT '0',
  `chargeto` varchar(45) DEFAULT NULL,
  `item_no` int(10) unsigned NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_reqi_req_id` (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `requisition_items_recv`
-- ----------------------------
DROP TABLE IF EXISTS `requisition_items_recv`;
CREATE TABLE `requisition_items_recv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `req_id` int(10) unsigned NOT NULL,
  `qty` decimal(10,0) NOT NULL DEFAULT '1',
  `supplier_id` int(10) unsigned NOT NULL,
  `sku` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `requisition_items_recv_reqid` (`req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `requisition_items_used`
-- ----------------------------
DROP TABLE IF EXISTS `requisition_items_used`;
CREATE TABLE `requisition_items_used` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `qty` decimal(10,0) DEFAULT '1',
  `req_item_id` int(10) unsigned NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `req_items_used_reqid` (`req_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rgpref`
-- ----------------------------
DROP TABLE IF EXISTS `rgpref`;
CREATE TABLE `rgpref` (
  `RGPCOD` varchar(3) NOT NULL,
  `RGPDES` varchar(30) NOT NULL,
  PRIMARY KEY (`RGPCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rights`
-- ----------------------------
DROP TABLE IF EXISTS `rights`;
CREATE TABLE `rights` (
  `rname` varchar(25) NOT NULL,
  `title` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `simple` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`rname`,`category`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rqimas`
-- ----------------------------
DROP TABLE IF EXISTS `rqimas`;
CREATE TABLE `rqimas` (
  `REQNBR` varchar(8) NOT NULL COMMENT 'requisition no.',
  `RQINUM` decimal(2,0) NOT NULL COMMENT 'requisition item no.',
  `UNTCOD` varchar(4) NOT NULL COMMENT 'unit of measure code',
  `RQIQTY` decimal(7,2) NOT NULL COMMENT 'quantity requested',
  `CLGCOD` varchar(3) NOT NULL COMMENT 'catalogue type code',
  `RQICGN` varchar(12) NOT NULL COMMENT 'item no. from catalogue',
  `SPYCOD` varchar(1) DEFAULT NULL COMMENT 'source of supply code',
  `RQISKU` varchar(20) DEFAULT NULL COMMENT 'stock no. from supplier''s inventory',
  `RQIAMT` decimal(11,2) DEFAULT NULL COMMENT 'cost of quantity requested inclusive of GCT',
  `TFRNBR` varchar(8) DEFAULT NULL COMMENT 'transfer advice no., if supplied via transfer',
  `ORDNBR` varchar(10) DEFAULT NULL COMMENT 'purchase order no., if supplied via purchase order',
  `ODINUM` decimal(2,0) DEFAULT NULL COMMENT 'purchase order item no., if supplied via purchase order',
  `JCLCOD` varchar(4) DEFAULT NULL COMMENT 'job cost accounting code',
  PRIMARY KEY (`REQNBR`,`RQINUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rqsref`
-- ----------------------------
DROP TABLE IF EXISTS `rqsref`;
CREATE TABLE `rqsref` (
  `RQSCOD` varchar(1) NOT NULL,
  `RQSDES` varchar(10) NOT NULL,
  PRIMARY KEY (`RQSCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rtnmas`
-- ----------------------------
DROP TABLE IF EXISTS `rtnmas`;
CREATE TABLE `rtnmas` (
  `ORDNBR` varchar(10) NOT NULL,
  `ODINUM` decimal(2,0) NOT NULL,
  `RTNRTDT` datetime NOT NULL,
  `RTNINI` varchar(4) NOT NULL,
  `RTNQTY` decimal(7,2) NOT NULL,
  `RTNATD` varchar(4) DEFAULT NULL,
  `RTNAZDT` datetime DEFAULT NULL,
  `GTPNBR` varchar(8) DEFAULT NULL,
  `RTNNAM` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ORDNBR`,`ODINUM`,`RTNRTDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `spsclg`
-- ----------------------------
DROP TABLE IF EXISTS `spsclg`;
CREATE TABLE `spsclg` (
  `SPSNBR` varchar(8) NOT NULL,
  `SPSDES` varchar(40) NOT NULL,
  PRIMARY KEY (`SPSNBR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `spyref`
-- ----------------------------
DROP TABLE IF EXISTS `spyref`;
CREATE TABLE `spyref` (
  `SPYCOD` varchar(1) NOT NULL,
  `SPYDES` varchar(10) NOT NULL,
  PRIMARY KEY (`SPYCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `srvclg`
-- ----------------------------
DROP TABLE IF EXISTS `srvclg`;
CREATE TABLE `srvclg` (
  `SRVNBR` varchar(6) NOT NULL,
  `SRVDES` varchar(4) NOT NULL,
  PRIMARY KEY (`SRVNBR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `status_code`
-- ----------------------------
DROP TABLE IF EXISTS `status_code`;
CREATE TABLE `status_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'requisition status code',
  `title` varchar(20) NOT NULL COMMENT 'requisition status description',
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `supplier`
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `CGYCOD` varchar(3) NOT NULL,
  `PSHCOD` varchar(2) NOT NULL,
  `SUPAD1` varchar(40) NOT NULL,
  `SUPAD2` varchar(40) NOT NULL,
  `SUPTEL` varchar(12) NOT NULL,
  `SUPFAX` varchar(12) NOT NULL,
  `SUPCON` varchar(30) NOT NULL,
  `SUPAD3` varchar(40) DEFAULT NULL,
  `SUPAD4` varchar(40) DEFAULT NULL,
  `SUPADDTEL` varchar(12) DEFAULT NULL,
  `SUPEMA` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tavref`
-- ----------------------------
DROP TABLE IF EXISTS `tavref`;
CREATE TABLE `tavref` (
  `TAVSRS` varchar(4) NOT NULL,
  `TAVFRDT` datetime NOT NULL,
  `TAVTODT` datetime DEFAULT NULL,
  `TAVSQN` decimal(4,0) NOT NULL,
  PRIMARY KEY (`TAVSRS`,`TAVFRDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tfrmas`
-- ----------------------------
DROP TABLE IF EXISTS `tfrmas`;
CREATE TABLE `tfrmas` (
  `TFRNBR` varchar(8) NOT NULL,
  `TFRINDT` datetime NOT NULL,
  `TFRINI` varchar(4) NOT NULL,
  `REQNBR` varchar(8) NOT NULL,
  `PRJNBR` varchar(6) DEFAULT NULL,
  `TFRATD` varchar(4) DEFAULT NULL,
  `TFRAZDT` datetime DEFAULT NULL,
  `GTPNBR` varchar(8) DEFAULT NULL,
  `TFRIBY` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`TFRNBR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `trimas`
-- ----------------------------
DROP TABLE IF EXISTS `trimas`;
CREATE TABLE `trimas` (
  `TFRNBR` varchar(8) NOT NULL,
  `REQNBR` varchar(8) NOT NULL,
  `RQINUM` decimal(2,0) NOT NULL,
  `TRIQTY` decimal(7,2) NOT NULL,
  PRIMARY KEY (`TFRNBR`,`REQNBR`,`RQINUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ualref`
-- ----------------------------
DROP TABLE IF EXISTS `ualref`;
CREATE TABLE `ualref` (
  `USRID` varchar(12) NOT NULL,
  `UALFRDT` datetime NOT NULL,
  `UALTODT` datetime DEFAULT NULL,
  `AZLCOD` varchar(2) NOT NULL,
  PRIMARY KEY (`USRID`,`UALFRDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `untref`
-- ----------------------------
DROP TABLE IF EXISTS `untref`;
CREATE TABLE `untref` (
  `UNTCOD` varchar(4) NOT NULL,
  `UNTDES` varchar(10) NOT NULL,
  PRIMARY KEY (`UNTCOD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `urgref`
-- ----------------------------
DROP TABLE IF EXISTS `urgref`;
CREATE TABLE `urgref` (
  `USRID` varchar(12) NOT NULL,
  `URGFRDT` datetime NOT NULL,
  `URGTODT` datetime DEFAULT NULL,
  `RGPCOD` varchar(3) NOT NULL,
  PRIMARY KEY (`USRID`,`URGFRDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `usergroup_id` int(10) unsigned DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `initial` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user_groups`
-- ----------------------------
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `rights` text,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user_group_notify`
-- ----------------------------
DROP TABLE IF EXISTS `user_group_notify`;
CREATE TABLE `user_group_notify` (
  `group_id` int(10) unsigned NOT NULL,
  `notifcation` varchar(45) NOT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `usrref`
-- ----------------------------
DROP TABLE IF EXISTS `usrref`;
CREATE TABLE `usrref` (
  `USRID` varchar(12) NOT NULL,
  `USRNAM` varchar(30) NOT NULL,
  `USRINIT` varchar(4) NOT NULL,
  `USREMA` varchar(60) NOT NULL,
  PRIMARY KEY (`USRID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `azlref` VALUES ('11','SIte clerk','50000'), ('12','Site foreman','100000'), ('13','Site supervisor','200000'), ('21','Purchasing officer','1000000'), ('22','Project engineer','1000000'), ('31','Purchasing manager','5000000'), ('32','Project manager','5000000'), ('41','construction manager','10000000'), ('51','general manager','999999999');
INSERT INTO `calendar_events` VALUES ('1','123459','Project created','The project \'Constant Spring Revive 2\' was created.','2013-05-14 08:14:43','1'), ('2','263654','Something happened','Somethign event worthy happened and here are the details','2013-05-09 08:14:49','1'), ('3','0','Requisition created','A requisition was created for project # 0','2013-05-16 08:00:07','1'), ('4','0','Requisition created','A requisition was created for project # 0','2013-05-16 16:53:47','1'), ('5','0','Requisition created','A requisition was created for project # 0','2013-05-16 23:55:38','1'), ('6','0','Requisition created','A requisition was created for project # 0','2013-05-16 23:56:54','1'), ('7','123457','Requisition created','A requisition was created for project # 123457','2013-05-17 04:11:43','1'), ('8','123456','Requisition created','A requisition was created for project # 123456','2013-05-17 05:14:18','1'), ('9','123458','Requisition created','A requisition was created for project # 123458','2013-05-22 07:20:19','1'), ('10','123460','Project created','The project \'Test Project 1\' was created.','2013-05-23 03:38:38','1'), ('11','123460','Requisition created','A requisition was created for project # 123460','2013-05-23 03:40:31','1'), ('12','123460','Requisition created','A requisition was created for project # 123460','2013-05-23 03:40:50','1'), ('13','0','Requisition created','A requisition was created for project # 0','2013-05-25 02:09:53','1'), ('14','0','Requisition created','A requisition was created for project # 0','2013-05-25 02:14:59','1');
INSERT INTO `cgyref` VALUES ('CMT','Cement'), ('EQP','Equipment rental'), ('FUL','Fuel and lubricants'), ('HDW','General hardware'), ('LBR','Lumber');
INSERT INTO `clgref` VALUES ('EQP','Equipment'), ('MAT','Materials'), ('SPS','Supplies'), ('SRV','Services');
INSERT INTO `country` VALUES ('AD','ANDORRA','Andorra','AND','20'), ('AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE','784'), ('AF','AFGHANISTAN','Afghanistan','AFG','4'), ('AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG','28'), ('AI','ANGUILLA','Anguilla','AIA','660'), ('AL','ALBANIA','Albania','ALB','8'), ('AM','ARMENIA','Armenia','ARM','51'), ('AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT','530'), ('AO','ANGOLA','Angola','AGO','24'), ('AQ','ANTARCTICA','Antarctica',NULL,NULL), ('AR','ARGENTINA','Argentina','ARG','32'), ('AS','AMERICAN SAMOA','American Samoa','ASM','16'), ('AT','AUSTRIA','Austria','AUT','40'), ('AU','AUSTRALIA','Australia','AUS','36'), ('AW','ARUBA','Aruba','ABW','533'), ('AZ','AZERBAIJAN','Azerbaijan','AZE','31'), ('BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH','70'), ('BB','BARBADOS','Barbados','BRB','52'), ('BD','BANGLADESH','Bangladesh','BGD','50'), ('BE','BELGIUM','Belgium','BEL','56'), ('BF','BURKINA FASO','Burkina Faso','BFA','854'), ('BG','BULGARIA','Bulgaria','BGR','100'), ('BH','BAHRAIN','Bahrain','BHR','48'), ('BI','BURUNDI','Burundi','BDI','108'), ('BJ','BENIN','Benin','BEN','204'), ('BM','BERMUDA','Bermuda','BMU','60'), ('BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN','96'), ('BO','BOLIVIA','Bolivia','BOL','68'), ('BR','BRAZIL','Brazil','BRA','76'), ('BS','BAHAMAS','Bahamas','BHS','44'), ('BT','BHUTAN','Bhutan','BTN','64'), ('BV','BOUVET ISLAND','Bouvet Island',NULL,NULL), ('BW','BOTSWANA','Botswana','BWA','72'), ('BY','BELARUS','Belarus','BLR','112'), ('BZ','BELIZE','Belize','BLZ','84'), ('CA','CANADA','Canada','CAN','124'), ('CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL), ('CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD','180'), ('CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF','140'), ('CG','CONGO','Congo','COG','178'), ('CH','SWITZERLAND','Switzerland','CHE','756'), ('CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV','384'), ('CK','COOK ISLANDS','Cook Islands','COK','184'), ('CL','CHILE','Chile','CHL','152'), ('CM','CAMEROON','Cameroon','CMR','120'), ('CN','CHINA','China','CHN','156'), ('CO','COLOMBIA','Colombia','COL','170'), ('CR','COSTA RICA','Costa Rica','CRI','188'), ('CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL), ('CU','CUBA','Cuba','CUB','192'), ('CV','CAPE VERDE','Cape Verde','CPV','132'), ('CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL), ('CY','CYPRUS','Cyprus','CYP','196'), ('CZ','CZECH REPUBLIC','Czech Republic','CZE','203'), ('DE','GERMANY','Germany','DEU','276'), ('DJ','DJIBOUTI','Djibouti','DJI','262'), ('DK','DENMARK','Denmark','DNK','208'), ('DM','DOMINICA','Dominica','DMA','212'), ('DO','DOMINICAN REPUBLIC','Dominican Republic','DOM','214'), ('DZ','ALGERIA','Algeria','DZA','12'), ('EC','ECUADOR','Ecuador','ECU','218'), ('EE','ESTONIA','Estonia','EST','233'), ('EG','EGYPT','Egypt','EGY','818'), ('EH','WESTERN SAHARA','Western Sahara','ESH','732'), ('ER','ERITREA','Eritrea','ERI','232'), ('ES','SPAIN','Spain','ESP','724'), ('ET','ETHIOPIA','Ethiopia','ETH','231'), ('FI','FINLAND','Finland','FIN','246'), ('FJ','FIJI','Fiji','FJI','242'), ('FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK','238'), ('FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM','583'), ('FO','FAROE ISLANDS','Faroe Islands','FRO','234'), ('FR','FRANCE','France','FRA','250'), ('GA','GABON','Gabon','GAB','266'), ('GB','UNITED KINGDOM','United Kingdom','GBR','826'), ('GD','GRENADA','Grenada','GRD','308'), ('GE','GEORGIA','Georgia','GEO','268'), ('GF','FRENCH GUIANA','French Guiana','GUF','254'), ('GH','GHANA','Ghana','GHA','288'), ('GI','GIBRALTAR','Gibraltar','GIB','292'), ('GL','GREENLAND','Greenland','GRL','304'), ('GM','GAMBIA','Gambia','GMB','270'), ('GN','GUINEA','Guinea','GIN','324'), ('GP','GUADELOUPE','Guadeloupe','GLP','312'), ('GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ','226'), ('GR','GREECE','Greece','GRC','300'), ('GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL), ('GT','GUATEMALA','Guatemala','GTM','320'), ('GU','GUAM','Guam','GUM','316'), ('GW','GUINEA-BISSAU','Guinea-Bissau','GNB','624'), ('GY','GUYANA','Guyana','GUY','328'), ('HK','HONG KONG','Hong Kong','HKG','344'), ('HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL), ('HN','HONDURAS','Honduras','HND','340'), ('HR','CROATIA','Croatia','HRV','191'), ('HT','HAITI','Haiti','HTI','332'), ('HU','HUNGARY','Hungary','HUN','348'), ('ID','INDONESIA','Indonesia','IDN','360'), ('IE','IRELAND','Ireland','IRL','372'), ('IL','ISRAEL','Israel','ISR','376');
INSERT INTO `country` VALUES ('IN','INDIA','India','IND','356'), ('IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL), ('IQ','IRAQ','Iraq','IRQ','368'), ('IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN','364'), ('IS','ICELAND','Iceland','ISL','352'), ('IT','ITALY','Italy','ITA','380'), ('JM','JAMAICA','Jamaica','JAM','388'), ('JO','JORDAN','Jordan','JOR','400'), ('JP','JAPAN','Japan','JPN','392'), ('KE','KENYA','Kenya','KEN','404'), ('KG','KYRGYZSTAN','Kyrgyzstan','KGZ','417'), ('KH','CAMBODIA','Cambodia','KHM','116'), ('KI','KIRIBATI','Kiribati','KIR','296'), ('KM','COMOROS','Comoros','COM','174'), ('KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA','659'), ('KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK','408'), ('KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR','410'), ('KW','KUWAIT','Kuwait','KWT','414'), ('KY','CAYMAN ISLANDS','Cayman Islands','CYM','136'), ('KZ','KAZAKHSTAN','Kazakhstan','KAZ','398'), ('LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO','418'), ('LB','LEBANON','Lebanon','LBN','422'), ('LC','SAINT LUCIA','Saint Lucia','LCA','662'), ('LI','LIECHTENSTEIN','Liechtenstein','LIE','438'), ('LK','SRI LANKA','Sri Lanka','LKA','144'), ('LR','LIBERIA','Liberia','LBR','430'), ('LS','LESOTHO','Lesotho','LSO','426'), ('LT','LITHUANIA','Lithuania','LTU','440'), ('LU','LUXEMBOURG','Luxembourg','LUX','442'), ('LV','LATVIA','Latvia','LVA','428'), ('LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY','434'), ('MA','MOROCCO','Morocco','MAR','504'), ('MC','MONACO','Monaco','MCO','492'), ('MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA','498'), ('MG','MADAGASCAR','Madagascar','MDG','450'), ('MH','MARSHALL ISLANDS','Marshall Islands','MHL','584'), ('MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD','807'), ('ML','MALI','Mali','MLI','466'), ('MM','MYANMAR','Myanmar','MMR','104'), ('MN','MONGOLIA','Mongolia','MNG','496'), ('MO','MACAO','Macao','MAC','446'), ('MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP','580'), ('MQ','MARTINIQUE','Martinique','MTQ','474'), ('MR','MAURITANIA','Mauritania','MRT','478'), ('MS','MONTSERRAT','Montserrat','MSR','500'), ('MT','MALTA','Malta','MLT','470'), ('MU','MAURITIUS','Mauritius','MUS','480'), ('MV','MALDIVES','Maldives','MDV','462'), ('MW','MALAWI','Malawi','MWI','454'), ('MX','MEXICO','Mexico','MEX','484'), ('MY','MALAYSIA','Malaysia','MYS','458'), ('MZ','MOZAMBIQUE','Mozambique','MOZ','508'), ('NA','NAMIBIA','Namibia','NAM','516'), ('NC','NEW CALEDONIA','New Caledonia','NCL','540'), ('NE','NIGER','Niger','NER','562'), ('NF','NORFOLK ISLAND','Norfolk Island','NFK','574'), ('NG','NIGERIA','Nigeria','NGA','566'), ('NI','NICARAGUA','Nicaragua','NIC','558'), ('NL','NETHERLANDS','Netherlands','NLD','528'), ('NO','NORWAY','Norway','NOR','578'), ('NP','NEPAL','Nepal','NPL','524'), ('NR','NAURU','Nauru','NRU','520'), ('NU','NIUE','Niue','NIU','570'), ('NZ','NEW ZEALAND','New Zealand','NZL','554'), ('OM','OMAN','Oman','OMN','512'), ('PA','PANAMA','Panama','PAN','591'), ('PE','PERU','Peru','PER','604'), ('PF','FRENCH POLYNESIA','French Polynesia','PYF','258'), ('PG','PAPUA NEW GUINEA','Papua New Guinea','PNG','598'), ('PH','PHILIPPINES','Philippines','PHL','608'), ('PK','PAKISTAN','Pakistan','PAK','586'), ('PL','POLAND','Poland','POL','616'), ('PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM','666'), ('PN','PITCAIRN','Pitcairn','PCN','612'), ('PR','PUERTO RICO','Puerto Rico','PRI','630'), ('PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL), ('PT','PORTUGAL','Portugal','PRT','620'), ('PW','PALAU','Palau','PLW','585'), ('PY','PARAGUAY','Paraguay','PRY','600'), ('QA','QATAR','Qatar','QAT','634'), ('RE','REUNION','Reunion','REU','638'), ('RO','ROMANIA','Romania','ROM','642'), ('RU','RUSSIAN FEDERATION','Russian Federation','RUS','643'), ('RW','RWANDA','Rwanda','RWA','646'), ('SA','SAUDI ARABIA','Saudi Arabia','SAU','682'), ('SB','SOLOMON ISLANDS','Solomon Islands','SLB','90'), ('SC','SEYCHELLES','Seychelles','SYC','690'), ('SD','SUDAN','Sudan','SDN','736'), ('SE','SWEDEN','Sweden','SWE','752'), ('SG','SINGAPORE','Singapore','SGP','702'), ('SH','SAINT HELENA','Saint Helena','SHN','654'), ('SI','SLOVENIA','Slovenia','SVN','705'), ('SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM','744'), ('SK','SLOVAKIA','Slovakia','SVK','703'), ('SL','SIERRA LEONE','Sierra Leone','SLE','694'), ('SM','SAN MARINO','San Marino','SMR','674'), ('SN','SENEGAL','Senegal','SEN','686'), ('SO','SOMALIA','Somalia','SOM','706'), ('SR','SURINAME','Suriname','SUR','740'), ('ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP','678');
INSERT INTO `country` VALUES ('SV','EL SALVADOR','El Salvador','SLV','222'), ('SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR','760'), ('SZ','SWAZILAND','Swaziland','SWZ','748'), ('TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA','796'), ('TD','CHAD','Chad','TCD','148'), ('TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL), ('TG','TOGO','Togo','TGO','768'), ('TH','THAILAND','Thailand','THA','764'), ('TJ','TAJIKISTAN','Tajikistan','TJK','762'), ('TK','TOKELAU','Tokelau','TKL','772'), ('TL','TIMOR-LESTE','Timor-Leste',NULL,NULL), ('TM','TURKMENISTAN','Turkmenistan','TKM','795'), ('TN','TUNISIA','Tunisia','TUN','788'), ('TO','TONGA','Tonga','TON','776'), ('TR','TURKEY','Turkey','TUR','792'), ('TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO','780'), ('TV','TUVALU','Tuvalu','TUV','798'), ('TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN','158'), ('TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA','834'), ('UA','UKRAINE','Ukraine','UKR','804'), ('UG','UGANDA','Uganda','UGA','800'), ('UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL), ('US','UNITED STATES','United States','USA','840'), ('UY','URUGUAY','Uruguay','URY','858'), ('UZ','UZBEKISTAN','Uzbekistan','UZB','860'), ('VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT','336'), ('VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT','670'), ('VE','VENEZUELA','Venezuela','VEN','862'), ('VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB','92'), ('VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR','850'), ('VN','VIET NAM','Viet Nam','VNM','704'), ('VU','VANUATU','Vanuatu','VUT','548'), ('WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF','876'), ('WS','SAMOA','Samoa','WSM','882'), ('YE','YEMEN','Yemen','YEM','887'), ('YT','MAYOTTE','Mayotte',NULL,NULL), ('ZA','SOUTH AFRICA','South Africa','ZAF','710'), ('ZM','ZAMBIA','Zambia','ZMB','894'), ('ZW','ZIMBABWE','Zimbabwe','ZWE','716');
INSERT INTO `customers` VALUES ('12345678','Everglade Attractions Ltd.','954-1717','953-6543','Lorna Wilson','831-5641','953-2121',NULL,NULL), ('87654321','Timberlake Construction','978-5041','978-5040','John Lake','826-4946','978-5042','Mary Lake','999-3695'), ('87654322','ClearTalk Communication Systems','943-8255','943-8299','Kevin Kirkland','877-3461',NULL,NULL,NULL), ('87654323','Nationwide Property Development Ltd.','946-1357','977-4852','Jason Williams','836-6529','978-2051','Sharon Martin','997-3636'), ('87654324','Dredix','876-420-4881','','Andre Dixon','876-420-4881','','N. Miller','');
INSERT INTO `delivery_code` VALUES ('1','D Status 1','2013-05-15 23:10:26'), ('2','D Status 2','2013-05-15 23:10:26'), ('3','D Status 3','2013-05-15 23:10:26');
INSERT INTO `gapref` VALUES ('GP01','2013-01-01 00:00:00',NULL,'0');
INSERT INTO `isnref` VALUES ('ISNKY','Tank-Weld Special Projects');
INSERT INTO `items` VALUES ('1','Item 1',NULL), ('2','Item 2',NULL), ('3','Item 3',NULL), ('4','Item 4',NULL), ('5','Item 5',NULL);
INSERT INTO `location` VALUES ('0','Construction Site 1','Somewhere','Kingston','JM'), ('2','Acc Practice Paper','Somewhere','Kingston','JM');
INSERT INTO `modref` VALUES ('HO','Deliver to head office'), ('PU','Pick up from supplier'), ('SO','Deliver to site office');
INSERT INTO `odsref` VALUES ('A','Authorized'), ('C','Closed'), ('I','Issued'), ('O','Opened'), ('V','Voided');
INSERT INTO `parish` VALUES ('AN','St. Ann'), ('AW','St. Andrew'), ('CL','Clarendon'), ('CT','St. Catherine'), ('E','St. ELizabeth'), ('H','Hanover'), ('J','St. James'), ('K','Kingston'), ('MC','Manchester'), ('MY','St. Mary'), ('P','Portland'), ('TH','St. Thomas'), ('TR','Trelawny'), ('W','Westmoreland');
INSERT INTO `podref` VALUES ('PO01','2013-01-01 00:00:00',NULL,'0');
INSERT INTO `project` VALUES ('0','87654324','Palm Glades road network','Palm Glades housing development','0','1','973-4356','973-4356','',NULL,NULL,'0'), ('1234','87654321','Road construction','Walkers Wood','2','1','','','',NULL,NULL,'0'), ('123456','87654322','Erect trunked radio transmission tower','Chudleigh district, Manchester','0','1','','','',NULL,NULL,'0'), ('123457','87654324','Constant Spring Revive','Constant Spring Revive\r\nConstant Spring Revive','0','1','8764204881','','dredix84@gmail.com','K','2013-05-14 07:31:40','1'), ('123458','87654323','Constant Spring Revive 2','Constant Spring Revive 2\r\n\r\nConstant Spring Revive 2','0','1','8764204881','8769229292','dredix84@gmail.com','E','2013-05-14 08:14:12','1'), ('123459','87654323','Constant Spring Revive 2','Constant Spring Revive 2\r\n\r\nConstant Spring Revive 2','0','1','8764204881','8769229292','dredix84@gmail.com','E','2013-05-14 08:14:43','1'), ('123460','87654324','Test Project 1','','0','2','8764204881','','dredix84@gmail.com','AN','2013-05-23 03:38:37','1');
INSERT INTO `prqref` VALUES ('RQ01','2103-01-01 00:00:00',NULL,'0');
INSERT INTO `pwdref` VALUES ('demo','2013-01-01 00:00:00',NULL,'demo@01'), ('LevyG','2013-01-01 00:00:00',NULL,'levy99@twsp');
INSERT INTO `requisition` VALUES ('0000000001','2013-05-16','1','3','0','2','2013-05-30','6516.00','1','2013-05-22 10:12:25','2013-05-22 10:11:50'), ('0000000002','2013-05-17','1','4','0','3','2013-05-28','58649.00',NULL,NULL,NULL), ('0000000003','2013-05-18','1','1','0','2','2013-05-20','5000.00',NULL,NULL,NULL), ('0000000004','2013-05-15','1','1','0','3','2013-05-24','58649.00','1','2013-05-23 22:40:03','2013-05-23 22:24:34'), ('0000000005','2013-05-16','1','3','123457','1','2013-05-30','5000.00',NULL,NULL,NULL), ('0000000006','2013-05-24','1','1','123456','3','2013-06-28','6516156.00',NULL,NULL,NULL), ('0000000007','2013-05-22','1','3','123458','2','2013-05-31','5000.00',NULL,NULL,NULL), ('0000000008','2013-05-22','1','2','123460','2','2013-05-31','58649.00',NULL,NULL,NULL), ('0000000009','2013-05-23','1','4','123460','3','2013-05-30','58649.00',NULL,NULL,'2013-05-22 20:48:27'), ('0000000010','2013-05-29','1','2','0','2','2013-05-08','5776.00',NULL,NULL,NULL), ('0000000011','2013-05-29','1','2','0','2','2013-05-08','5776.00',NULL,NULL,NULL);
INSERT INTO `requisition_items` VALUES ('1','0000000004','56',NULL,'5640',NULL,'1','0',NULL,'2','2013-05-18 08:19:56','1','2013-05-18 01:32:33',NULL), ('5','0000000001','32',NULL,'65430',NULL,'1','0',NULL,'2','2013-05-18 10:37:10','1','2013-05-18 03:37:10','654615315'), ('6','0000000001','502',NULL,'5640',NULL,'1','0',NULL,'5','2013-05-18 10:37:34','1','2013-05-18 03:37:34','561315351'), ('7','0000000001','56',NULL,'8000',NULL,'1','0',NULL,'5','2013-05-18 10:37:57','1','2013-05-18 03:37:57','561315351'), ('8','0000000001','502',NULL,'65430',NULL,'1','0',NULL,'4','2013-05-22 07:16:36','1','2013-05-22 00:16:36','654615315'), ('9','0000000007','32',NULL,'5640',NULL,'1','0',NULL,'3','2013-05-22 07:24:06','1','2013-05-22 00:24:06','654615315'), ('10','0000000009','32',NULL,'5640',NULL,'1','0',NULL,'3','2013-05-23 03:44:53','1','2013-05-22 20:44:54','654615315'), ('11','0000000009','56',NULL,'8000',NULL,'1','0',NULL,'2','2013-05-23 03:45:43','1','2013-05-22 20:45:44','561315351'), ('12','0000000003','56',NULL,'65430',NULL,'1','0',NULL,'3','2013-05-24 05:40:02','1','2013-05-23 22:40:03','561315351');
INSERT INTO `requisition_items_used` VALUES ('1','2013-05-24 08:30:06','1','1','5','Nothing'), ('2','2013-05-24 08:30:46','1','24','5','Test note'), ('3','2013-05-24 08:36:04','1','24','7',''), ('4','2013-05-24 08:52:26','1','2','8',''), ('5','2013-05-24 08:54:18','1','7','8',''), ('6','2013-05-25 01:25:01','1','432','6',''), ('7','2013-05-25 01:25:11','1','1','6','');
INSERT INTO `rgpref` VALUES ('ADM','Clerical users'), ('INQ','Inquiry users'), ('MGR','Managers'), ('PWR','Power users'), ('SYS','System administrators');
INSERT INTO `rights` VALUES ('a','Add Requisition','Requisition','1'), ('a','Users - Add','User','0'), ('a','Create User Group','User Group','0'), ('apprv_req_email','Approve Notification - Email','Notification','0'), ('apprv_req_sms','Approve Notification - SMS','Notification','0'), ('c','Users - Change','User','0'), ('c','Edit User Groups','User Group','1'), ('d','Remove Requisition','Requisition','1'), ('d','Users - Delete','User','0'), ('d','Delete User Group','User Group','1'), ('p','Users - Copy','User','0'), ('p','Copy User Group','User Group','1'), ('req_apprv','Approve Requisition','Requisition','1'), ('req_edit_afterseekapprv','Edit after seek approval','Requisition','1'), ('req_seekapprv','Seek Approval','Requisition','1'), ('v','Users - Views','User','0'), ('v','View User Group','User Group','1');
INSERT INTO `rqsref` VALUES ('A','Authorized'), ('O','P/O issued'), ('R','Raised'), ('V','Voided');
INSERT INTO `spyref` VALUES ('I','Stores'), ('S','Supplier'), ('X','Combined');
INSERT INTO `status_code` VALUES ('1','Initiated','1'), ('2','Awaiting approval','2'), ('3','Stalled','3'), ('4','Completed','4');
INSERT INTO `supplier` VALUES ('1','BigMac Heavy Equipment Rentals','EQP','','Manchester Avenue','May Pen P.O.','938-8264','938-8815','Junior McIntosh','Clarendon',NULL,'938-9022','bigmac01@gmail.com');
INSERT INTO `tavref` VALUES ('TA01','2103-01-01 00:00:00',NULL,'0');
INSERT INTO `ualref` VALUES ('LevyG','2013-01-01 00:00:00',NULL,'51');
INSERT INTO `untref` VALUES ('GAL','gal'), ('KG','Kg'), ('LB','lb'), ('LTR','L'), ('MTR','m'), ('OZ','oz'), ('QRT','qt');
INSERT INTO `urgref` VALUES ('demo','2013-01-01 00:00:00',NULL,'SYS'), ('LevyG','2013-01-01 00:00:00',NULL,'MGR');
INSERT INTO `users` VALUES ('1','Andre','Dixon','admin','21232f297a57a5a743894a0e4a801fc3','0','dredix84@gmail.com','1','AND'), ('2','Tamara','Bailey','bt','21232f297a57a5a743894a0e4a801fc3','0','tb@tb.com','1','TB');
INSERT INTO `user_groups` VALUES ('0','Administrator','Admin users','[\"a_Requisition\",\"d_Requisition\",\"req_apprv_Requisition\",\"req_edit_afterseekapprv_Requisition\",\"req_seekapprv_Requisition\",\"a_User\",\"c_User\",\"d_User\",\"p_User\",\"v_User\",\"a_User Group\",\"c_User Group\",\"d_User Group\",\"p_User Group\",\"v_User Group\",\"apprv_req_email_Notification\",\"apprv_req_sms_Notification\"]','2013-05-09 02:09:11','1','2013-05-22 20:55:39','1','1'), ('2','Managers','Managers','[\"a_User\",\"c_User\",\"d_User\",\"p_User\",\"v_User\",\"a_User Group\",\"c_User Group\",\"d_User Group\",\"p_User Group\",\"v_User Group\"]','2013-05-09 08:20:46','1','2013-05-21 21:00:22','1','1'), ('3','Clerk','Clerk','[\"v_User\",\"c_User Group\",\"v_User Group\"]','2013-05-22 00:00:00','1','2013-05-21 20:08:26','1','1');
INSERT INTO `user_group_notify` VALUES ('0','newcreate_requisition','1','2013-05-15 17:48:51');
INSERT INTO `usrref` VALUES ('demo','System Demonstrator','DEMO','systemdemo@anysite.com'), ('LevyG','George Levy','GDL','george.levy@twsp.com');
