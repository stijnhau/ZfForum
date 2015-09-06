-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 31, 2015 at 08:26 PM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zfcprivatemessagingtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum_category`
--

CREATE TABLE IF NOT EXISTS `forum_category` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `timestamp_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_reply`
--

CREATE TABLE IF NOT EXISTS `forum_reply` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `forum_topic_id` int(11) unsigned NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timestamp_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(64) NOT NULL DEFAULT '',
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
`id` int(11) unsigned NOT NULL,
  `forum_category_id` int(11) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timestamp_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_vist`
--

CREATE TABLE IF NOT EXISTS `forum_vist` (
`id` int(10) unsigned NOT NULL,
  `forum_topic_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `ip` varchar(64) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_category`
--
ALTER TABLE `forum_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_reply`
--
ALTER TABLE `forum_reply`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`forum_topic_id`), ADD KEY `forum_topic_id` (`forum_topic_id`);

--
-- Indexes for table `forum_topic`
--
ALTER TABLE `forum_topic`
 ADD PRIMARY KEY (`id`), ADD KEY `forum_category_id` (`forum_category_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `forum_visit`
--
ALTER TABLE `forum_visit`
 ADD PRIMARY KEY (`id`), ADD KEY `forum_topic_id` (`forum_topic_id`,`user_id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_category`
--
ALTER TABLE `forum_category`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_reply`
--
ALTER TABLE `forum_reply`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_topic`
--
ALTER TABLE `forum_topic`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_visit`
--
ALTER TABLE `forum_visit`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum_reply`
--
ALTER TABLE `forum_reply`
ADD CONSTRAINT `forum_reply_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
ADD CONSTRAINT `forum_reply_ibfk_2` FOREIGN KEY (`forum_topic_id`) REFERENCES `forum_topic` (`id`);

--
-- Constraints for table `forum_topic`
--
ALTER TABLE `forum_topic`
ADD CONSTRAINT `forum_topic_ibfk_1` FOREIGN KEY (`forum_category_id`) REFERENCES `forum_category` (`id`),
ADD CONSTRAINT `forum_topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `forum_visit`
--
ALTER TABLE `forum_visit`
ADD CONSTRAINT `forum_visit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
ADD CONSTRAINT `forum_visit_ibfk_2` FOREIGN KEY (`forum_topic_id`) REFERENCES `forum_topic` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
