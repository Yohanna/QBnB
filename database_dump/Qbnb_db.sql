-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2016 at 10:02 PM
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
--       `users` -> `user_id`
--

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `status`, `check_in`, `property_id`, `tenant_id`) VALUES
(1, 1, '2016-02-17', 1, 3),
(2, 2, '2016-02-23', 2, 2),
(3, 3, '2016-02-17', 3, 1),
(4, 1, '2016-03-31', 2, 7),
(5, 2, '2016-04-27', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `commenter_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `comment_text` text COLLATE utf16_unicode_520_ci NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `property_id` (`property_id`,`commenter_id`),
  KEY `property_id_index` (`property_id`) USING BTREE,
  KEY `commenter_id_index` (`commenter_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for Comments';

--
-- RELATIONS FOR TABLE `comments`:
--   `commenter_id`
--       `users` -> `user_id`
--   `property_id`
--       `properties` -> `property_id`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `commenter_id`, `property_id`, `comment_text`, `rating`, `timestamp`) VALUES
(1, 1, 1, 'Great place and location.', 3, '2016-03-07 23:20:23'),
(2, 2, 2, 'Great location. Unfortunately place was mostly unfurnished.', 5, '2016-03-07 23:20:23'),
(3, 3, 3, 'It was clean.', 4, '2016-03-07 23:20:23'),
(4, 7, 5, 'Property was clean like the pictures. Host was nice. Would definitely stay here again! ', 5, '2016-03-10 19:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `District` varchar(40) COLLATE utf16_unicode_520_ci NOT NULL,
  `POI` varchar(100) COLLATE utf16_unicode_520_ci NOT NULL,
  PRIMARY KEY (`District`,`POI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='Table storing distract information';

--
-- RELATIONS FOR TABLE `districts`:
--   `District`
--       `properties` -> `district`
--

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`District`, `POI`) VALUES
('Kanata', 'Kanata Lakes'),
('Nepean', 'Canadian War Museum'),
('Nepean', 'Parliament Hill'),
('Nepean', 'Rideau Canal'),
('Nepean', 'Supreme Court');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`faculty_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `faculties`:
--

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty`) VALUES
(1, 'Faculty of Arts and Science'),
(2, 'Faculty of Education'),
(3, 'Faculty of Engineering and Applied Science'),
(4, 'Smith School of Business');

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
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_path` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`pic_id`) USING BTREE,
  UNIQUE KEY `pic_path` (`pic_path`),
  KEY `property_id_index` (`property_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `pictures`:
--   `property_id`
--       `properties` -> `property_id`
--

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`pic_id`, `pic_path`, `property_id`) VALUES
(1, 'property_pics/1_2.jpg', 2),
(2, 'property_pics/2_3.jpg', 3),
(3, 'property_pics/3_3.jpg', 3),
(5, 'property_pics/5_5.jpg', 5);

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
--       `users` -> `user_id`
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `LName` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `gender` char(1) COLLATE utf16_unicode_520_ci NOT NULL COMMENT 'F or M',
  `email` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `phone_no` char(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `grad_year` year(4) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `degree_type` varchar(5) COLLATE utf16_unicode_520_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `faculty_id_index` (`faculty_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci;

--
-- RELATIONS FOR TABLE `users`:
--   `faculty_id`
--       `faculties` -> `faculty_id`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `FName`, `LName`, `gender`, `email`, `password`, `phone_no`, `grad_year`, `faculty_id`, `is_admin`, `degree_type`) VALUES
(1, 'Raquel', 'Smith', 'F', 'smith_raquel@queensu.ca', 'pass', '1234567890', 2003, 2, 0, 'Bsc'),
(2, 'Mai', 'Wu', 'F', 'mai_wu@queensu.ca', 'pass', '1234567899', 2004, 3, 0, 'Ba'),
(3, 'Jeffery', 'Lin', 'M', 'jeffery_lin@queensu.ca', 'pass', '1234567889', 2001, 2, 0, 'Bcs'),
(5, 'Dylan', 'Liu', 'M', 'dl@queensu.ca', 'pass', '6133333333', 2017, 1, 0, 'BAs'),
(6, 'Jack', 'Qiao', 'M', 'jq@queensu.ca', 'pass', '6133333333', 2017, 1, 0, 'BAs'),
(7, 'Yohanna', 'Gadelrab', 'M', 'y', '1234', '3333333333', 2017, 3, 1, 'B.Sc.'),
(8, 'John', 'Doe', 'M', 'J', '1234', '3433333333', 2017, 1, 0, 'BA'),
(9, 'Yoha', 'Gad', 'F', 'adsf@ca.ca', '123', '3', 2003, 1, 0, 'BA');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_property_id_constraint` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_tenant_id_constraint` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_commenter_id_constraint` FOREIGN KEY (`commenter_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_property_id_constraints` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `district_constraint` FOREIGN KEY (`District`) REFERENCES `properties` (`district`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_property_id_constraint` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `property_id_constraint` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `supplier_id_constraint` FOREIGN KEY (`supplier_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_faculty_id_constraint` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
