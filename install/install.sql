-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: localhost    Database: novel
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `parent_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'玄幻',0),(2,'仙侠',0),(3,'武侠',0),(4,'都市',0),(5,'校园',0),(6,'历史',0),(7,'农村',0),(8,'恐怖',0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter`
--

DROP TABLE IF EXISTS `chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MRG_MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci INSERT_METHOD=LAST UNION=(`chapter_0`,`chapter_1`,`chapter_2`,`chapter_3`,`chapter_4`,`chapter_5`,`chapter_6`,`chapter_7`,`chapter_8`,`chapter_9`);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `chapter_0`
--

DROP TABLE IF EXISTS `chapter_0`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_0` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_0`
--

LOCK TABLES `chapter_0` WRITE;
/*!40000 ALTER TABLE `chapter_0` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_0` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_1`
--

DROP TABLE IF EXISTS `chapter_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_1` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `chapter_2`
--

DROP TABLE IF EXISTS `chapter_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_2` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_2`
--

LOCK TABLES `chapter_2` WRITE;
/*!40000 ALTER TABLE `chapter_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_3`
--

DROP TABLE IF EXISTS `chapter_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_3` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_3`
--

LOCK TABLES `chapter_3` WRITE;
/*!40000 ALTER TABLE `chapter_3` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_4`
--

DROP TABLE IF EXISTS `chapter_4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_4` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_4`
--

LOCK TABLES `chapter_4` WRITE;
/*!40000 ALTER TABLE `chapter_4` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_5`
--

DROP TABLE IF EXISTS `chapter_5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_5` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_5`
--

LOCK TABLES `chapter_5` WRITE;
/*!40000 ALTER TABLE `chapter_5` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_6`
--

DROP TABLE IF EXISTS `chapter_6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_6` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_6`
--

LOCK TABLES `chapter_6` WRITE;
/*!40000 ALTER TABLE `chapter_6` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_6` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_7`
--

DROP TABLE IF EXISTS `chapter_7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_7` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_7`
--

LOCK TABLES `chapter_7` WRITE;
/*!40000 ALTER TABLE `chapter_7` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_7` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_8`
--

DROP TABLE IF EXISTS `chapter_8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_8` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_8`
--

LOCK TABLES `chapter_8` WRITE;
/*!40000 ALTER TABLE `chapter_8` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_9`
--

DROP TABLE IF EXISTS `chapter_9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_9` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_9`
--

LOCK TABLES `chapter_9` WRITE;
/*!40000 ALTER TABLE `chapter_9` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_9` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_id`
--

DROP TABLE IF EXISTS `chapter_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_id` (
  `id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_id`
--

LOCK TABLES `chapter_id` WRITE;
/*!40000 ALTER TABLE `chapter_id` DISABLE KEYS */;
INSERT INTO `chapter_id` VALUES (1);
/*!40000 ALTER TABLE `chapter_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collect`
--

DROP TABLE IF EXISTS `collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `book_url` varchar(255) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_desc` varchar(255) NOT NULL,
  `book_img` varchar(255) NOT NULL,
  `book_list` varchar(255) NOT NULL,
  `chapter_list` varchar(255) NOT NULL,
  `chapter_url` varchar(255) NOT NULL,
  `chapter_content` varchar(255) NOT NULL,
  `test_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collect`
--

LOCK TABLES `collect` WRITE;
/*!40000 ALTER TABLE `collect` DISABLE KEYS */;
INSERT INTO `collect` VALUES (1,'顶点小说','http://www.23wx.com/','http://www.23wx.com/book/:book_id','#content dd:eq(0) h1','#content dd:eq(1) table td:eq(1)','#content dd:eq(3) p:eq(1)','#content dd:eq(1) div:eq(0) img','#content dd:eq(1) .btnlinks a:eq(0)','.bdsub table td a',':book_url/','#contents ',55519),(2,'笔趣阁','http://www.biquge.la/','http://www.biquge.la/book/:book_id','#info h1','#info p:eq(0)','#intro p:eq(0)','#fmimg img','http://www.biquge.la/book/:book_id','#list dd a',':book_url/','#content',14),(3,'三五文学网','http://www.555zw.com','http://www.555zw.com/bookinfo/:book_id[2]/:book_id.htm','span#title a','div#title span:eq(1) a','.rightDiv div:eq(5)','.picborder','span#title a','.acss td a',':book_url/','#content',31281),(4,'看书网','http://www.kanshu.com/','http://www.kanshu.com/artinfo/:book_id.html','.title_h1 .div1 h1','.title_h1 .div2 span:eq(1) a','#articledesc','.xx_left1 img','http://www.kanshu.com/files/article/html/:book_id','.mulu_list li a',':site_url','div.yd_text2',28942);
/*!40000 ALTER TABLE `collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collect_cache`
--

DROP TABLE IF EXISTS `collect_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collect_cache` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `collect_id` int(10) NOT NULL,
  `book_id` varchar(255) NOT NULL,
  `list_url` varchar(255) NOT NULL,
  `chapter_url` varchar(255) NOT NULL,
  `story_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `update_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collect_cache`
--

LOCK TABLES `collect_cache` WRITE;
/*!40000 ALTER TABLE `collect_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `collect_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` mediumtext NOT NULL,
  `value` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'title','主页标题','東木书屋'),(2,'chapter_cache_time','章节缓存时间','30000'),(3,'content_filter','过滤内容敏感字','{\"<a href=\\\"http:\\/\\/www.01bz.in\\/.+\\\"><u>%%<\\/u><\\/a>\":\"\\\\1\"}'),(4,'per_page','分类中文章列表数量','20');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story`
--

DROP TABLE IF EXISTS `story`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `desc` mediumtext NOT NULL,
  `click` int(10) NOT NULL,
  `category` int(10) NOT NULL,
  `time` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story`
--

LOCK TABLES `story` WRITE;
/*!40000 ALTER TABLE `story` DISABLE KEYS */;
/*!40000 ALTER TABLE `story` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `password` char(32) NOT NULL,
  `avater` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-25  9:29:37
