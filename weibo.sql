-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: weibo
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `t_atme`
--

DROP TABLE IF EXISTS `t_atme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_atme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL COMMENT '提到我的微博id',
  `uid` int(10) unsigned NOT NULL COMMENT '所属用户id',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `index3` (`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='at表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_atme`
--

LOCK TABLES `t_atme` WRITE;
/*!40000 ALTER TABLE `t_atme` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_atme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_collect`
--

DROP TABLE IF EXISTS `t_collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '收藏用户id',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏时间',
  `wid` int(10) unsigned NOT NULL COMMENT '收藏微博的id',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收藏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_collect`
--

LOCK TABLES `t_collect` WRITE;
/*!40000 ALTER TABLE `t_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_comment`
--

DROP TABLE IF EXISTS `t_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '评论用户uid',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '评论内容',
  `time` int(10) unsigned NOT NULL COMMENT 'i评论时间',
  `wid` int(10) unsigned NOT NULL COMMENT '所属微博id',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_comment`
--

LOCK TABLES `t_comment` WRITE;
/*!40000 ALTER TABLE `t_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_follow`
--

DROP TABLE IF EXISTS `t_follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_follow` (
  `follow` int(10) unsigned NOT NULL COMMENT '关注者ID',
  `fans` int(10) unsigned NOT NULL COMMENT '粉丝ID',
  `time` int(10) unsigned NOT NULL COMMENT '添加关注的时间',
  `from` char(30) NOT NULL COMMENT '关注来源',
  `gid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属分组id',
  KEY `follow` (`follow`),
  KEY `fans` (`fans`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='关注和粉丝表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_follow`
--

LOCK TABLES `t_follow` WRITE;
/*!40000 ALTER TABLE `t_follow` DISABLE KEYS */;
INSERT INTO `t_follow` VALUES (10005,10000,0,'0',0);
/*!40000 ALTER TABLE `t_follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_group`
--

DROP TABLE IF EXISTS `t_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT '分组名称',
  `uid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='关注分组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_group`
--

LOCK TABLES `t_group` WRITE;
/*!40000 ALTER TABLE `t_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_letter`
--

DROP TABLE IF EXISTS `t_letter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_letter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发信用户id',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '私信内容',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发件时间',
  `uid` int(10) unsigned NOT NULL COMMENT '收件人',
  PRIMARY KEY (`id`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='私信表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_letter`
--

LOCK TABLES `t_letter` WRITE;
/*!40000 ALTER TABLE `t_letter` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_letter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_picture`
--

DROP TABLE IF EXISTS `t_picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(60) NOT NULL DEFAULT '' COMMENT '微博配图',
  `wid` int(10) unsigned NOT NULL COMMENT '所属微博id',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微博配图';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_picture`
--

LOCK TABLES `t_picture` WRITE;
/*!40000 ALTER TABLE `t_picture` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_praise`
--

DROP TABLE IF EXISTS `t_praise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_praise` (
  `id` int(11) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `wid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `index3` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='赞 表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_praise`
--

LOCK TABLES `t_praise` WRITE;
/*!40000 ALTER TABLE `t_praise` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_praise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_sessions`
--

DROP TABLE IF EXISTS `t_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_sessions`
--

LOCK TABLES `t_sessions` WRITE;
/*!40000 ALTER TABLE `t_sessions` DISABLE KEYS */;
INSERT INTO `t_sessions` VALUES ('483f3995b28094d8f23efecefdeea68b','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0',1391755122,'a:5:{s:9:\"user_data\";s:0:\"\";s:3:\"uid\";s:5:\"10005\";s:7:\"account\";s:17:\"532499602@163.com\";s:8:\"username\";s:9:\"苍老师\";s:8:\"loggedin\";b:1;}'),('e14446e64b0c4ec05ad11cd951121a3a','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.102 Safari/537.36',1391755212,'a:5:{s:9:\"user_data\";s:0:\"\";s:3:\"uid\";s:5:\"10000\";s:7:\"account\";s:16:\"532499602@qq.com\";s:8:\"username\";s:6:\"runner\";s:8:\"loggedin\";b:1;}');
/*!40000 ALTER TABLE `t_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_skin`
--

DROP TABLE IF EXISTS `t_skin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_skin` (
  `id` int(11) NOT NULL,
  `suit` tinyint(3) unsigned DEFAULT '0' COMMENT '套装',
  `bg` tinyint(3) unsigned DEFAULT '0' COMMENT '背景图',
  `cover` tinyint(3) unsigned DEFAULT '0' COMMENT '顶部封面图',
  `style` tinyint(3) unsigned DEFAULT '0' COMMENT 'css样式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='皮肤表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_skin`
--

LOCK TABLES `t_skin` WRITE;
/*!40000 ALTER TABLE `t_skin` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_skin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(20) NOT NULL DEFAULT '' COMMENT '用户帐号',
  `passwd` char(128) NOT NULL DEFAULT '' COMMENT '用户密码',
  `regis_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定（0不锁定、1锁定）',
  `vemail` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱验证(0未验证，1已验证)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=10006 DEFAULT CHARSET=utf8 COMMENT='用户帐号表\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (10000,'532499602@qq.com','7663658e53704ee7caaf2b4eb449fde9c06ebd99043bdfa5fa8f96adab89d8f064346a1ff35c5782ef09d5903788bd9acc48acbe5b50d14d8133e524608d2a14',0,0,0),(10001,'air_zhe@163.com','481e94e1a26f2e8b295765c25e4f4f4b31629a992c48b8c3fee6dfb6186385d638abce86c96aa701a5d4cb9e51ae1687a7523377b4133b4ec57528454a595e35',1390923149,0,0),(10004,'run@run.com','7663658e53704ee7caaf2b4eb449fde9c06ebd99043bdfa5fa8f96adab89d8f064346a1ff35c5782ef09d5903788bd9acc48acbe5b50d14d8133e524608d2a14',1391518379,0,0),(10005,'532499602@163.com','7663658e53704ee7caaf2b4eb449fde9c06ebd99043bdfa5fa8f96adab89d8f064346a1ff35c5782ef09d5903788bd9acc48acbe5b50d14d8133e524608d2a14',1391518425,0,0);
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user_info`
--

DROP TABLE IF EXISTS `t_user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user_info` (
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='用户信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user_info`
--

LOCK TABLES `t_user_info` WRITE;
/*!40000 ALTER TABLE `t_user_info` DISABLE KEYS */;
INSERT INTO `t_user_info` VALUES (1,'runner','','a:2:{i:0;s:6:\"浙江\";i:1;s:6:\"杭州\";}','1999-01-01','男','','',NULL,0,1,0,32,10000),(6,'purple','','a:2:{i:0;s:6:\"浙江\";i:1;s:6:\"杭州\";}','1998-01-01','女','','',NULL,0,0,7,12,10001),(8,'敏敏','','a:2:{i:0;s:6:\"湖北\";i:1;s:6:\"天门\";}','2015-02-01','女','','',NULL,0,0,0,0,10004),(9,'苍老师','','a:2:{i:0;s:6:\"湖北\";i:1;s:6:\"武汉\";}','2014-01-01','女','','',NULL,0,1,3,1,10005);
/*!40000 ALTER TABLE `t_user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_weibo`
--

DROP TABLE IF EXISTS `t_weibo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_weibo` (
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
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='微博表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_weibo`
--

LOCK TABLES `t_weibo` WRITE;
/*!40000 ALTER TABLE `t_weibo` DISABLE KEYS */;
INSERT INTO `t_weibo` VALUES (1,'这Runner我发表的第一条微博哦[ppb鼓掌]',0,0,1391584578,0,0,0,0,10000),(2,'这是purple发的1号微博[挤眼]',0,0,1391584879,0,0,0,0,10001),(3,'这是purple发的2号微博',0,0,1391584914,0,0,0,0,10001),(4,'这Runner我发表的第二条微博哦',0,0,1391584924,0,0,0,0,10000),(5,'这Runner我发表的第3条微博哦',0,0,1391584933,0,0,0,0,10000),(6,'哈哈，很好玩啊',0,0,1391584946,0,0,0,0,10001),(7,'从前有个国王,他两个女儿的眼泪都会变成钻石.大女儿嫁给了一个用她的眼泪创造了一个个城堡的王子,小女儿却嫁给了牧羊人.国王临死见到他们的时候,大女儿满身金银珠宝,而小女儿和牧羊人仍是贫穷.国王很惊讶的说:明明她的一滴眼泪就够你们生活的很好. 牧羊人说:可是我舍不得让她哭啊.....',0,0,1391584965,0,0,0,0,10000),(8,'【中国最美五大沙漠】巴丹吉林沙漠，塔克拉玛干沙漠，鸣沙山—月牙泉，古尔班通古特沙漠，沙坡头。一生一定要去次沙漠，体验烈日风沙，体味孤独辽远，它在那里等你，等候了千年。什么时候启程吧！',0,0,1391584976,0,0,0,0,10001),(9,'[蛋糕]生日快乐',0,0,1391584988,0,0,0,0,10001),(10,'这是我的地盘哦？',0,0,1391584995,0,0,0,0,10001),(11,'我想做什么都可以的。',0,0,1391585002,0,0,0,0,10001),(12,'哈哈，我来刷屏了。',0,0,1391585016,0,0,0,0,10001),(13,'【凡人凡事：写春联】小时候，我们生产队里能写得一手好毛笔字的人叫谭四叔。那时，队里五十多户的对联几乎全是四叔自编自写且无一雷同。因为这个，他在队里的威望也相当高，好多年轻后生的情书也是拜求四叔操刀而就。',0,0,1391585041,0,0,0,0,10001),(14,'功能超强：$349.95包邮 附送$75 Walmart电子礼卷，【乐高LEGO】 Mindstorms EV3 三代机器人拼装玩具，配置WiFi，可以与iOS与Android设备连接，改进的麦克风和扬声器配置，可以支持简单的人际交流，除了命令模式与程序模式，还支持app操控方式。Linux系统，支持SD延展。http://t.cn/8k66RlZ',0,0,1391585051,0,0,0,0,10000),(15,'死亡的骆驼（最近网上真的很火）你看了么？[转] ',0,0,1391585069,0,0,0,0,10000),(16,'人人秀舞：看社交手游的动与静】12月，手游市场依旧风起云涌，好戏连台。企鹅屡放大招，搭上微信快车的天天家族不多说了，《全民英雄》、《水果忍者》、《全民飞机大战》等数不过来的作品狂轰乱炸。如今手游市场已进入平稳期，以往圈一笔快钱就跑路的打法还奏效吗？看雷哥分析',0,0,1391585081,0,0,0,0,10001),(17,'据说这是每一个女汉纸都会的技能。。。冬天必备啊！|图：imgur',0,0,1391585105,0,0,0,0,10001),(18,'【果壳探索：这不是堵车，这是通过汽车传导的冲击波！】下次你上下班遇到堵车时，把它想象成一股向你的汽车袭来并将其吞没的压力波。把堵车看成是一个简单的生物，由汽车而非分子构成。不要气馁，期待这条结晶变形虫过会儿就把你的车从它里面拉出去',0,0,1391585113,0,0,0,0,10000),(19,'宝贝最想去哪儿？晒照片得安仔！】海边？大草原？外婆家？迪士尼乐园？还是……？宝贝们，最想去的地方会是哪儿？童爸、童妈们，你们知道吗？ 让宝贝亲手写下或画出他们最想去的地方，拍下宝贝们大声宣言的照片，带上话题#宝贝最想去哪儿# 并且@360儿童卫士 发微博，小童每天送出安仔，还有手环哦~',0,0,1391585124,0,0,0,0,10000),(20,'宝贝最想去哪儿？晒照片得安仔！】海边？大草原？外婆家？迪士尼乐园？还是……？宝贝们，最想去的地方会是哪儿？童爸、童妈们，你们知道吗？ 让宝贝亲手写下或画出他们最想去的地方，拍下宝贝们大声宣言的照片，带上话题#宝贝最想去哪儿# 并且@360儿童卫士 发微博，小童每天送出安仔，还有手环哦~',0,0,1391585127,0,0,0,0,10000),(21,'宝贝最想去哪儿？晒照片得安仔！】海边？大草原？外婆家？迪士尼乐园？还是……？宝贝们，最想去的地方会是哪儿？童爸、童妈们，你们知道吗？ 让宝贝亲手写下或画出他们最想去的地方，拍下宝贝们大声宣言的照片，带上话题#宝贝最想去哪儿# 并且@360儿童卫士 发微博，小童每天送出安仔，还有手环哦~',0,0,1391585128,0,0,0,0,10000),(22,'宝贝最想去哪儿？晒照片得安仔！】海边？大草原？外婆家？迪士尼乐园？还是……？宝贝们，最想去的地方会是哪儿？童爸、童妈们，你们知道吗？ 让宝贝亲手写下或画出他们最想去的地方，拍下宝贝们大声宣言的照片，带上话题#宝贝最想去哪儿# 并且@360儿童卫士 发微博，小童每天送出安仔，还有手环哦~',0,0,1391585130,0,0,0,0,10000),(23,'宝贝最想去哪儿？晒照片得安仔！】海边？大草原？外婆家？迪士尼乐园？还是……？宝贝们，最想去的地方会是哪儿？童爸、童妈们，你们知道吗？ 让宝贝亲手写下或画出他们最想去的地方，拍下宝贝们大声宣言的照片，带上话题#宝贝最想去哪儿# 并且@360儿童卫士 发微博，小童每天送出安仔，还有手环哦~',0,0,1391585132,0,0,0,0,10000),(24,'宝贝最想去哪儿？晒照片得安仔！】海边？大草原？外婆家？迪士尼乐园？还是……？宝贝们，最想去的地方会是哪儿？童爸、童妈们，你们知道吗？ 让宝贝亲手写下或画出他们最想去的地方，拍下宝贝们大声宣言的照片，带上话题#宝贝最想去哪儿# 并且@360儿童卫士 发微博，小童每天送出安仔，还有手环哦~',0,0,1391585138,0,0,0,0,10000),(25,'宝贝最想去哪儿？晒照片得安仔！】海边？大草原？外婆家？迪士尼乐园？还是……？宝贝们，最想去的地方会是哪儿？童爸、童妈们，你们知道吗？ 让宝贝亲手写下或画出他们最想去的地方，拍下宝贝们大声宣言的照片，带上话题#宝贝最想去哪儿# 并且@360儿童卫士 发微博，小童每天送出安仔，还有手环哦~',0,0,1391585191,0,0,0,0,10000),(26,'宝贝最想去哪儿？晒照片得安仔！】海边？大草原？外婆家？迪士尼乐园？还是……？宝贝们，最想去的地方会是哪儿？童爸、童妈们，你们知道吗？ 让宝贝亲手写下或画出他们最想去的地方，拍下宝贝们大声宣言的照片，带上话题#宝贝最想去哪儿# 并且@360儿童卫士 发微博，小童每天送出安仔，还有手环哦~',0,0,1391585271,0,0,0,0,10000),(27,'老家有土狗一只，看院子的，天冷了给它窝里弄了块破布垫子，隔天都给它拖出来晒晒，刚开始这狗子不让动，估计晒后睡着舒服，它自己养成了拉出来晒晒的习惯，无论刮风下雨',0,0,1391585293,0,0,0,0,10001),(28,'[抓狂]两天没有喝到热的汤了',0,0,1391599825,0,0,0,0,10000),(29,'[ali哇][左哼哼][阴险]',0,0,1391605211,0,0,0,0,10000),(30,'[拜拜][抓狂][困][失望]',0,0,1391605221,0,0,0,0,10000),(31,'[阴险][睡觉]',0,0,1391605233,0,0,0,0,10000),(32,'[神马]',0,0,1391625357,0,0,0,0,10000),(33,'要睡觉了，好好休息下吧。[爱你]',0,0,1391626058,0,0,0,0,10000),(34,'purple，我要睡觉了啊。好梦。。[挤眼]',0,0,1391626158,0,0,0,0,10000),(35,'[给力][左哼哼]',0,0,1391674294,0,0,0,0,10000),(42,'这可是苍老师的第一次哦[害羞]',0,0,1391696311,0,0,0,0,10005),(44,'[吃惊][困]',0,0,1391753419,0,0,0,0,10000),(43,'[浮云][挖鼻屎]',0,0,1391752900,0,0,0,0,10000),(45,'[右哼哼]',0,0,1391753423,0,0,0,0,10000);
/*!40000 ALTER TABLE `t_weibo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-07 15:41:41
