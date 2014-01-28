-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 01 月 28 日 09:56
-- 服务器版本: 5.5.35
-- PHP 版本: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `weibo`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_atme`
--

CREATE TABLE IF NOT EXISTS `t_atme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL COMMENT '提到我的微博id',
  `uid` int(10) unsigned NOT NULL COMMENT '所属用户id',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `index3` (`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='at表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_collect`
--

CREATE TABLE IF NOT EXISTS `t_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '收藏用户id',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏时间',
  `wid` int(10) unsigned NOT NULL COMMENT '收藏微博的id',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收藏表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_comment`
--

CREATE TABLE IF NOT EXISTS `t_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '评论用户uid',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '评论内容',
  `time` int(10) unsigned NOT NULL COMMENT 'i评论时间',
  `wid` int(10) unsigned NOT NULL COMMENT '所属微博id',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_follow`
--

CREATE TABLE IF NOT EXISTS `t_follow` (
  `follow` int(10) unsigned NOT NULL COMMENT '关注者ID',
  `fans` int(10) unsigned NOT NULL COMMENT '粉丝ID',
  `gid` int(10) unsigned NOT NULL COMMENT '所属分组id',
  KEY `follow` (`follow`),
  KEY `fans` (`fans`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='关注和粉丝表';

-- --------------------------------------------------------

--
-- 表的结构 `t_group`
--

CREATE TABLE IF NOT EXISTS `t_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT '分组名称',
  `uid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='关注分组表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_letter`
--

CREATE TABLE IF NOT EXISTS `t_letter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发信用户id',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '私信内容',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发件时间',
  `uid` int(10) unsigned NOT NULL COMMENT '收件人',
  PRIMARY KEY (`id`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='私信表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_picture`
--

CREATE TABLE IF NOT EXISTS `t_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(60) NOT NULL DEFAULT '' COMMENT '微博配图',
  `wid` int(10) unsigned NOT NULL COMMENT '所属微博id',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微博配图' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_praise`
--

CREATE TABLE IF NOT EXISTS `t_praise` (
  `id` int(11) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `wid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `index3` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='赞 表';

-- --------------------------------------------------------

--
-- 表的结构 `t_sessions`
--

CREATE TABLE IF NOT EXISTS `t_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `t_sessions`
--

INSERT INTO `t_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('72f08689a9e2b981103a2653f8dce02b', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.77 Safari/537.36', 1390744932, ''),
('ad93c4a721ca929d1fcf54afbe43439a', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 1390738472, '');

-- --------------------------------------------------------

--
-- 表的结构 `t_skin`
--

CREATE TABLE IF NOT EXISTS `t_skin` (
  `id` int(11) NOT NULL,
  `suit` tinyint(3) unsigned DEFAULT '0' COMMENT '套装',
  `bg` tinyint(3) unsigned DEFAULT '0' COMMENT '背景图',
  `cover` tinyint(3) unsigned DEFAULT '0' COMMENT '顶部封面图',
  `style` tinyint(3) unsigned DEFAULT '0' COMMENT 'css样式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='皮肤表';

-- --------------------------------------------------------

--
-- 表的结构 `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(20) NOT NULL DEFAULT '' COMMENT '用户帐号',
  `passwd` char(128) NOT NULL DEFAULT '' COMMENT '用户密码',
  `regis_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定（0不锁定、1锁定）',
  `vemail` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱验证(0未验证，1已验证)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户帐号表\n' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `t_user`
--

INSERT INTO `t_user` (`id`, `account`, `passwd`, `regis_time`, `lock`, `vemail`) VALUES
(1, '532499602@qq.com', 'purple', 0, 0, 0),
(2, 'purple@qq.com', 'ddd', 0, 0, 0),
(15, 'air_zhes@163.com', 'f40461bbdcc82e9f1a5aa6b33d9398a7c6247b34eab8b5c5347a1711117a55d98aadd84231055d68dd2a8be0f47bb7295a10ef55bb02bbbacfb81ff0c01bb56c', 0, 0, 0),
(16, 'air_zhe@qq.com', '7663658e53704ee7caaf2b4eb449fde9c06ebd99043bdfa5fa8f96adab89d8f064346a1ff35c5782ef09d5903788bd9acc48acbe5b50d14d8133e524608d2a14', 0, 0, 0),
(17, 'air_zhe@126.com', '481e94e1a26f2e8b295765c25e4f4f4b31629a992c48b8c3fee6dfb6186385d638abce86c96aa701a5d4cb9e51ae1687a7523377b4133b4ec57528454a595e35', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `t_user_info`
--

CREATE TABLE IF NOT EXISTS `t_user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `truename` varchar(45) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `location` varchar(45) NOT NULL DEFAULT '' COMMENT '居住地',
  `birthday` date NOT NULL COMMENT '生日(日期时间型)',
  `sex` enum('男','女') NOT NULL DEFAULT '男' COMMENT '性别',
  `intro` varchar(100) NOT NULL DEFAULT '' COMMENT '一句话介绍自己',
  `avatar` varchar(60) NOT NULL DEFAULT '' COMMENT '头像(有180，50,30三个，图片名字相同，路径不同)',
  `domain` varchar(100) DEFAULT NULL COMMENT '个性域名',
  `style` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '模板风格',
  `follow` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关注数',
  `fans` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝数',
  `weibo` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表微博数',
  `uid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `domain` (`domain`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户信息表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `t_user_info`
--

INSERT INTO `t_user_info` (`id`, `username`, `truename`, `location`, `birthday`, `sex`, `intro`, `avatar`, `domain`, `style`, `follow`, `fans`, `weibo`, `uid`) VALUES
(1, 'purple', '', '', '0000-00-00', '男', '', '', '', 0, 0, 0, 0, 0),
(12, 'airzhess', '', 'a:2:{i:0;s:6:"浙江";i:1;s:6:"宁波";}', '1998-01-01', '男', '', '', NULL, 0, 0, 0, 0, 15),
(13, 'runner', '', 'a:2:{i:0;s:6:"湖北";i:1;s:9:"神农架";}', '2012-01-01', '男', '', '', NULL, 0, 0, 0, 0, 16),
(14, 'purpless', '', 'a:2:{i:0;s:6:"浙江";i:1;s:6:"台州";}', '2014-01-01', '男', '', '', NULL, 0, 0, 0, 0, 17);

-- --------------------------------------------------------

--
-- 表的结构 `t_weibo`
--

CREATE TABLE IF NOT EXISTS `t_weibo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '微博内容',
  `isturn` int(11) NOT NULL DEFAULT '0' COMMENT '是否转发(0原创，否则记录转发的ID)',
  `iscomment` int(11) NOT NULL DEFAULT '0' COMMENT '是否转发(0原创，否则记录评论的ID)',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表时间',
  `praise` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '赞次数',
  `turn` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '转发次数',
  `collect` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论条数',
  `uid` int(10) unsigned NOT NULL COMMENT '所属用户id',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微博表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
