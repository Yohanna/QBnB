-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2016 at 05:00 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qbnb`
--
CREATE DATABASE IF NOT EXISTS `qbnb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `qbnb`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL COMMENT '1: Confirmed, 2:Rejected, 3:Waiting',
  `check_in` date NOT NULL,
  `property_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `check_in` (`check_in`,`property_id`,`tenant_id`),
  KEY `property_id_index` (`property_id`) USING BTREE,
  KEY `tenant_id_index` (`tenant_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for booking info, with status being a flag (Ints)';

--
-- RELATIONS FOR TABLE `bookings`:
--   `property_id`
--       `properties` -> `property_id`
--   `tenant_id`
--       `user` -> `user_id`
--

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `status`, `check_in`, `property_id`, `tenant_id`) VALUES
(1, 1, '2016-02-17', 1, 1),
(2, 2, '2016-02-23', 2, 2),
(3, 3, '2016-02-17', 3, 3),
(4, 1, '2016-03-31', 2, 7),
(5, 2, '2016-04-27', 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `property_id` int(11) NOT NULL,
  `comment_text` text COLLATE utf16_unicode_520_ci NOT NULL,
  `reply_text` text COLLATE utf16_unicode_520_ci,
  `commenter_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `property_id` (`property_id`,`commenter_id`),
  KEY `property_id_index` (`property_id`) USING BTREE,
  KEY `commenter_id_index` (`commenter_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for Comments';

--
-- RELATIONS FOR TABLE `comments`:
--   `commenter_id`
--       `user` -> `user_id`
--   `property_id`
--       `properties` -> `property_id`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `timestamp`, `property_id`, `comment_text`, `reply_text`, `commenter_id`, `rating`) VALUES
(1, '2016-03-07 23:20:23', 1, 'Great place and location.', NULL, 1, 3),
(2, '2016-03-07 23:20:23', 2, 'Great location. Unfortunately place was mostly unfurnished.', NULL, 2, 5),
(3, '2016-03-07 23:20:23', 3, 'It was clean.', 'Thanks for the comment!', 3, 4),
(4, '2016-03-10 19:43:18', 5, 'Property was clean like the pictures. Host was nice. Would definitely stay here again! ', NULL, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `District` varchar(40) COLLATE utf16_unicode_520_ci NOT NULL,
  `POI` varchar(100) COLLATE utf16_unicode_520_ci NOT NULL,
  PRIMARY KEY (`District`,`POI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='Table storing distract information';

--
-- RELATIONS FOR TABLE `district`:
--   `District`
--       `properties` -> `district`
--

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`District`, `POI`) VALUES
('Kanata', 'Kanata Lakes'),
('Nepean', 'Canadian War Museum'),
('Nepean', 'Parliament Hill'),
('Nepean', 'Rideau Canal'),
('Nepean', 'Supreme Court');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE IF NOT EXISTS `features` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `internet` tinyint(1) NOT NULL DEFAULT '0',
  `gym` tinyint(1) NOT NULL DEFAULT '0',
  `pet_allowed` tinyint(1) NOT NULL DEFAULT '0',
  `tv` tinyint(1) NOT NULL DEFAULT '0',
  `washer` tinyint(1) NOT NULL DEFAULT '0',
  `parking` tinyint(1) NOT NULL DEFAULT '0',
  `patio` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='Additional table to keep track a list of features';

--
-- RELATIONS FOR TABLE `features`:
--   `property_id`
--       `properties` -> `property_id`
--   `property_id`
--       `properties` -> `property_id`
--

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`property_id`, `internet`, `gym`, `pet_allowed`, `tv`, `washer`, `parking`, `patio`) VALUES
(1, 1, 0, 1, 1, 1, 1, 1),
(2, 1, 0, 0, 1, 0, 0, 0),
(3, 1, 1, 1, 1, 1, 1, 1),
(4, 1, 1, 1, 1, 1, 1, 1),
(5, 1, 0, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_path` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`pic_id`) USING BTREE,
  UNIQUE KEY `pic_path` (`pic_path`),
  KEY `property_id_index` (`property_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `picture`:
--   `property_id`
--       `properties` -> `property_id`
--

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`pic_id`, `pic_path`, `property_id`) VALUES
(1, '/home/user/joe/pics/1.jpg', 2),
(2, '/home/user/joe/pics/2.jpg', 3),
(3, '/home/user/joe/pics/3.jpg', 3),
(5, '/home/yohanna/pic.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf16_unicode_520_ci NOT NULL,
  `district` varchar(20) COLLATE utf16_unicode_520_ci NOT NULL,
  `type` varchar(20) COLLATE utf16_unicode_520_ci NOT NULL,
  `price` float NOT NULL COMMENT 'Price per month',
  PRIMARY KEY (`property_id`),
  KEY `supplier_id_index` (`supplier_id`) USING BTREE,
  KEY `district` (`district`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for the property';

--
-- RELATIONS FOR TABLE `properties`:
--   `supplier_id`
--       `user` -> `user_id`
--

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `supplier_id`, `address`, `district`, `type`, `price`) VALUES
(1, 1, '89 Waterfall Ave. Ottawa ON', 'Kanata', 'House', 220),
(2, 1, '121 Ontario St, Ottawa ON', 'Kanata', 'Town House', 200),
(3, 3, '2331 London St, Ottawa ON', 'Nepean', 'Apartment', 120),
(4, 2, '43 Centre St. Ottawa ON', 'Nepean', 'Apartment', 180),
(5, 7, '123 West St.', 'Kanata', 'House', 250);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `LName` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `gender` char(1) COLLATE utf16_unicode_520_ci NOT NULL COMMENT 'F or M',
  `email` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `phone_no` char(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `grad_year` year(4) NOT NULL,
  `faculty` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `degree_type` varchar(5) COLLATE utf16_unicode_520_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci;

--
-- RELATIONS FOR TABLE `user`:
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `FName`, `LName`, `gender`, `email`, `password`, `phone_no`, `grad_year`, `faculty`, `degree_type`, `is_admin`) VALUES
(1, 'Raquel', 'Smith', 'F', 'smith_raquel@queensu.ca', 'pass', '1234567890', 2003, 'Science', 'Bsc', 0),
(2, 'Mai', 'Wu', 'F', 'mai_wu@queensu.ca', 'pass', '1234567899', 2004, 'Con-ed', 'Ba', 0),
(3, 'Jeffery', 'Lin', 'M', 'jeffery_lin@queensu.ca', 'pass', '1234567889', 2001, 'Computing', 'Bcs', 0),
(5, 'Dylan', 'Liu', 'M', 'dl@queensu.ca', 'pass', '6133333333', 2017, 'Computing', 'BAs', 1),
(6, 'Jack', 'Qiao', 'M', 'jq@queensu.ca', 'pass', '6133333333', 2017, 'Computing', 'BAs', 1),
(7, 'Yohanna', 'Gadelrab', 'M', 'y', '1234', '3333333333', 2017, 'ECE', 'B.Sc.', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_property_id_constraint` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_tenant_id_constraint` FOREIGN KEY (`tenant_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_commenter_id_constraint` FOREIGN KEY (`commenter_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_property_id_constraints` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_constraint` FOREIGN KEY (`District`) REFERENCES `properties` (`district`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_property_id_constraint` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `property_id_constraint` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `supplier_id_constraint` FOREIGN KEY (`supplier_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
