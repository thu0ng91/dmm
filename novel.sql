-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-04-13 17:00:58
-- 服务器版本： 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `novel`
--

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `title`, `parent_id`) VALUES
(1, '玄幻', 0),
(2, '仙侠', 0),
(3, '武侠', 0),
(4, '都市', 0),
(5, '言情', 0),
(6, '历史', 0),
(7, '侦探', 0),
(8, '军事', 0),
(9, '恐怖', 0),
(10, '其他', 0);

-- --------------------------------------------------------

--
-- 表的结构 `chapter`
--

CREATE TABLE IF NOT EXISTS `chapter` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` mediumtext NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`id`, `title`, `desc`, `value`) VALUES
(1, 'title', '主页标题', '東木书屋'),
(2, 'chapter_cache_time', '章节缓存时间', '30000');

-- --------------------------------------------------------

--
-- 表的结构 `story`
--

CREATE TABLE IF NOT EXISTS `story` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `desc` mediumtext NOT NULL,
  `click` int(10) NOT NULL,
  `category` int(10) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `update`
--

CREATE TABLE IF NOT EXISTS `update` (
  `story_id` int(10) NOT NULL,
  `story_title` varchar(255) NOT NULL,
  `book_id` int(10) NOT NULL COMMENT '抓取的书号',
  `chapter_url` mediumtext NOT NULL COMMENT '章节前置地址',
  `last_chapter` varchar(255) NOT NULL COMMENT '最后抓取的章节',
  `chapter_id` int(10) NOT NULL,
  `chapter_title` varchar(255) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL,
  `name` char(20) NOT NULL,
  `password` char(32) NOT NULL,
  `avater` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update`
--
ALTER TABLE `update`
  ADD PRIMARY KEY (`story_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;