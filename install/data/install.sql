DROP TABLE IF EXISTS `slcms_article_category`;
CREATE TABLE `slcms_article_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) NOT NULL,
  `cate_ab` varchar(50) NOT NULL,
  `intro` text,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `parent_path` varchar(255) NOT NULL DEFAULT '0',
  `path` varchar(255) DEFAULT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `page_num` int(11) NOT NULL DEFAULT '0',
  `cate_tpl` varchar(255) DEFAULT NULL,
  `detail_tpl` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `slcms_article_content`;
CREATE TABLE `slcms_article_content` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `com_title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `copyfrom` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `default_pic` varchar(255) DEFAULT NULL,
  `intro` text,
  `content` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `editor` varchar(40) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `passed` tinyint(1) NOT NULL DEFAULT '1',
  `ontop` tinyint(1) NOT NULL DEFAULT '0',
  `elite` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `slcms_config`;
CREATE TABLE `slcms_config` (
  `cf_name` varchar(30) NOT NULL,
  `cf_value` text,
  PRIMARY KEY (`cf_name`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `slcms_feedback`;
CREATE TABLE `slcms_feedback` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `update_time` int(11) DEFAULT NULL,
  `reply_content` text,
  `reply_time` int(11) DEFAULT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `slcms_member`;
CREATE TABLE `slcms_member` (
  `user_id` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(20) DEFAULT NULL,
  `purviews` text,
  `last_time` int(11) DEFAULT NULL,
  `last_ip` varchar(15) DEFAULT NULL,
  `this_time` int(11) DEFAULT NULL,
  `this_ip` varchar(15) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `slcms_page_category`;
CREATE TABLE `slcms_page_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) NOT NULL,
  `cate_ab` varchar(50) NOT NULL,
  `intro` text,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `cate_tpl` varchar(255) DEFAULT NULL,
  `detail_tpl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `slcms_page_content`;
CREATE TABLE `slcms_page_content` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `cate_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `default_pic` varchar(255) DEFAULT NULL,
  `intro` text,
  `content` text,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `passed` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `slcms_plate_category`;
CREATE TABLE `slcms_plate_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate_ab` varchar(30) NOT NULL,
  `plate_name` varchar(255) DEFAULT NULL,
  `plate_type` tinyint(1) NOT NULL DEFAULT '0',
  `intro` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `slcms_plate_content`;
CREATE TABLE `slcms_plate_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate_id` int(11) NOT NULL DEFAULT '0',
  `plate_type` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `update_time` int(11) DEFAULT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;



INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('sysname', '广西广电网络管理系统');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('title', '广西广电网络管理系统');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('sysurl', 'http://www.96335.com/');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('ceoemail', '');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('icp', '');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('icpurl', '');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('metakeyword', '');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('metadescrip', '');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('makestatic', '9');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('statictype', '1');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('staticfolder', '/html');
INSERT INTO `slcms_config` (`cf_name`, `cf_value`) VALUES('startyear', '2012');

