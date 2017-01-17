-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-01-17 04:00:07
-- 服务器版本： 10.1.20-MariaDB
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_app_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_app_comment` (
  `id` int(11) NOT NULL,
  `mid` int(11) DEFAULT NULL COMMENT 'tbl_app_market id',
  `uid` int(11) DEFAULT NULL,
  `content` varchar(256) CHARACTER SET utf8mb4 DEFAULT NULL,
  `rate` tinyint(4) DEFAULT NULL,
  `create_time` double DEFAULT NULL,
  `update_time` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_app_hot`
--

CREATE TABLE IF NOT EXISTS `tbl_app_hot` (
  `id` int(11) NOT NULL,
  `mid` int(11) DEFAULT NULL,
  `create_time` double DEFAULT NULL,
  `update_time` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_app_market`
--

CREATE TABLE IF NOT EXISTS `tbl_app_market` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `name` char(32) CHARACTER SET utf8mb4 DEFAULT NULL,
  `qrcode` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `description` varchar(512) CHARACTER SET utf8mb4 DEFAULT NULL,
  `icon` varchar(256) DEFAULT NULL,
  `likes` int(11) DEFAULT '0',
  `shares` int(11) DEFAULT '0',
  `overall_rating` tinyint(4) DEFAULT '0' COMMENT '进位评分',
  `available` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` double DEFAULT NULL,
  `update_time` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_app_screenshot`
--

CREATE TABLE IF NOT EXISTS `tbl_app_screenshot` (
  `id` int(11) NOT NULL,
  `mid` int(11) DEFAULT NULL COMMENT 'tbl_app_market id',
  `image` varchar(256) DEFAULT NULL,
  `create_time` double DEFAULT NULL,
  `update_time` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_app_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_app_tag` (
  `id` int(11) NOT NULL,
  `name` char(10) CHARACTER SET utf8mb4 DEFAULT NULL,
  `create_time` double DEFAULT NULL,
  `update_time` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_app_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_app_tags` (
  `id` int(11) NOT NULL,
  `mid` int(11) DEFAULT NULL,
  `tid` int(11) DEFAULT NULL,
  `create_time` double DEFAULT NULL,
  `update_time` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_app_user`
--

CREATE TABLE IF NOT EXISTS `tbl_app_user` (
  `id` int(11) NOT NULL,
  `nickname` char(16) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` double DEFAULT NULL,
  `update_time` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_app_comment`
--
ALTER TABLE `tbl_app_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_hot`
--
ALTER TABLE `tbl_app_hot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_market`
--
ALTER TABLE `tbl_app_market`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_screenshot`
--
ALTER TABLE `tbl_app_screenshot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_tag`
--
ALTER TABLE `tbl_app_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_tags`
--
ALTER TABLE `tbl_app_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_user`
--
ALTER TABLE `tbl_app_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_app_comment`
--
ALTER TABLE `tbl_app_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_app_hot`
--
ALTER TABLE `tbl_app_hot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_app_market`
--
ALTER TABLE `tbl_app_market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_app_screenshot`
--
ALTER TABLE `tbl_app_screenshot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_app_tag`
--
ALTER TABLE `tbl_app_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_app_tags`
--
ALTER TABLE `tbl_app_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_app_user`
--
ALTER TABLE `tbl_app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
