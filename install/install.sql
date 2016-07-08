-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-07-08 11:25:47
-- 服务器版本： 5.7.12-0ubuntu1.1
-- PHP Version: 7.0.4-7ubuntu2.1

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `title`, `parent_id`) VALUES
(1, '玄幻', 0),
(2, '仙侠', 0),
(3, '武侠', 0),
(4, '都市', 0),
(5, '校园', 0),
(6, '历史', 0),
(7, '农村', 0),
(8, '恐怖', 0);

-- --------------------------------------------------------

--
-- 表的结构 `chapter`
--

CREATE TABLE IF NOT EXISTS `chapter` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `story_id` int(10) NOT NULL,
  `order` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `collect`
--

CREATE TABLE IF NOT EXISTS `collect` (
  `id` int(11) NOT NULL,
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
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `collect`
--

INSERT INTO `collect` (`id`, `site_title`, `site_url`, `book_url`, `book_title`, `book_author`, `book_desc`, `book_img`, `book_list`, `chapter_list`, `chapter_url`, `chapter_content`, `test_id`) VALUES
(1, '顶点小说', 'http://www.23wx.com/', 'http://www.23wx.com/book/(:book_id)', '#content dd:eq(0) h1', '#content dd:eq(1) table td:eq(1)', '#content dd:eq(3) p:eq(1)', '#content dd:eq(1) div:eq(0) img', '#content dd:eq(1) .btnlinks a:eq(0)', '.bdsub table td a', '', '#contents ', 55519),
(2, '笔趣阁', 'http://www.biquge.la/', 'http://www.biquge.la/book/(:book_id)', '#info h1', '#info p:eq(0)', '#intro p:eq(0)', '#fmimg img', 'http://www.biquge.la/book/(:book_id)', '#list dd a', '', '#content', 14);

-- --------------------------------------------------------

--
-- 表的结构 `collect_book`
--

CREATE TABLE IF NOT EXISTS `collect_book` (
  `id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `collect_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` mediumtext NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`id`, `title`, `desc`, `value`) VALUES
(1, 'title', '主页标题', '東木书屋'),
(2, 'chapter_cache_time', '章节缓存时间', '30000'),
(3, 'content_filter', '过滤内容敏感字', '{"<a href=\\"http:\\/\\/www.01bz.in\\/.+\\"><u>%%<\\/u><\\/a>":"\\\\1"}'),
(4, 'per_page', '分类中文章列表数量', '20');

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
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
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
-- Indexes for table `collect`
--
ALTER TABLE `collect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collect_book`
--
ALTER TABLE `collect_book`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `collect`
--
ALTER TABLE `collect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `collect_book`
--
ALTER TABLE `collect_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
