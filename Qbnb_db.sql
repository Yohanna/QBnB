-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2016 at 05:31 AM
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
-- Creation: Feb 11, 2016 at 04:23 AM
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for booking info, with status being a flag (Ints)';

--
-- RELATIONS FOR TABLE `bookings`:
--   `property_id`
--       `properties` -> `property_id`
--

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `status`, `check_in`, `check_out`, `property_id`) VALUES
(1, 1, '2016-02-17', '2016-02-18', 1),
(2, 2, '2016-02-23', '2016-02-23', 2),
(3, 3, '2016-02-17', '2016-02-17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--
-- Creation: Feb 11, 2016 at 04:28 AM
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `property_id` int(11) NOT NULL,
  `comment_text` text COLLATE utf16_unicode_520_ci NOT NULL,
  `reply_text` text COLLATE utf16_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for Comments';

--
-- RELATIONS FOR TABLE `comments`:
--   `property_id`
--       `properties` -> `property_id`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `timestamp`, `property_id`, `comment_text`, `reply_text`) VALUES
(1, '2016-02-11 01:44:59', 1, 'Great place and location.', NULL),
(2, '2016-02-11 01:49:27', 2, 'Great location. Unfortunately place was mostly unfurnished.', NULL),
(3, '2016-02-11 01:52:59', 3, 'It was clean.', 'Thanks for the comment!'),
(4, '2016-02-11 01:54:03', 4, 'Best place at his price!!', 'Glad you liked it!');

-- --------------------------------------------------------

--
-- Table structure for table `consumer`
--
-- Creation: Feb 11, 2016 at 03:20 AM
--

CREATE TABLE `consumer` (
  `consumer_id` int(11) NOT NULL,
  `FName` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `LName` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `email` varchar(32) COLLATE utf16_unicode_520_ci NOT NULL,
  `password` varchar(16) COLLATE utf16_unicode_520_ci NOT NULL,
  `phone_no` int(10) NOT NULL,
  `grad_year` year(4) NOT NULL,
  `faculty` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `degree_type` varchar(5) COLLATE utf16_unicode_520_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for consumers and buyers';

--
-- RELATIONS FOR TABLE `consumer`:
--

--
-- Dumping data for table `consumer`
--

INSERT INTO `consumer` (`consumer_id`, `FName`, `LName`, `email`, `password`, `phone_no`, `grad_year`, `faculty`, `degree_type`, `is_admin`) VALUES
(1, 'Niko', 'Prinsen', 'nikoprinsen@queensu.ca', 'specialpw', 1004567289, 2015, 'Science', 'BSc', 0),
(2, 'Charisma', 'Cooper', 'ccooper@queensu.ca', 'qwerty', 2008672349, 2014, 'Arts', 'BA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--
-- Creation: Feb 11, 2016 at 03:02 AM
--

CREATE TABLE `district` (
  `District_name` varchar(40) COLLATE utf16_unicode_520_ci NOT NULL COMMENT 'Name for the District',
  `POI` varchar(100) COLLATE utf16_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='Table storing distract information';

--
-- RELATIONS FOR TABLE `district`:
--

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`District_name`, `POI`) VALUES
('Downtown', 'Parliament Hill, Supreme Court'),
('Kanata', 'Kanata Lakes');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--
-- Creation: Feb 11, 2016 at 03:02 AM
--

CREATE TABLE `features` (
  `property_id` int(11) NOT NULL,
  `internet` tinyint(1) NOT NULL,
  `gym` tinyint(1) NOT NULL,
  `pet_allowed` tinyint(1) NOT NULL,
  `tv` tinyint(1) NOT NULL,
  `washer` tinyint(1) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `patio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='Additional table to keep track a list of features';

--
-- RELATIONS FOR TABLE `features`:
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
(4, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--
-- Creation: Feb 11, 2016 at 04:08 AM
--

CREATE TABLE `owns` (
  `supplier_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for the relation Owns';

--
-- RELATIONS FOR TABLE `owns`:
--   `property_id`
--       `properties` -> `property_id`
--   `supplier_id`
--       `supplier` -> `supplier_id`
--

--
-- Dumping data for table `owns`
--

INSERT INTO `owns` (`supplier_id`, `property_id`) VALUES
(1, 1),
(1, 2),
(2, 4),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--
-- Creation: Feb 11, 2016 at 03:36 AM
--

CREATE TABLE `properties` (
  `supplier_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf16_unicode_520_ci NOT NULL,
  `district` varchar(20) COLLATE utf16_unicode_520_ci NOT NULL,
  `type` varchar(20) COLLATE utf16_unicode_520_ci NOT NULL,
  `price` float NOT NULL COMMENT 'Price per month',
  `rating` int(11) NOT NULL,
  `pictures` text COLLATE utf16_unicode_520_ci COMMENT 'Property pictures stored as comma separated file paths list'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci COMMENT='A table for the property';

--
-- RELATIONS FOR TABLE `properties`:
--

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`supplier_id`, `property_id`, `address`, `district`, `type`, `price`, `rating`, `pictures`) VALUES
(1, 1, '89 Waterfall Ave. Ottawa ON', 'Kanata', 'House', 220, 5, NULL),
(1, 2, '121 Ontario St, Ottawa ON', 'Kanata', 'Town House', 200, 3, NULL),
(3, 3, '2331 London St, Ottawa ON', 'Downtown', 'Apartment', 120, 4, NULL),
(2, 4, '43 Centre St. Ottawa ON', 'Downtown', 'Apartment', 180, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--
-- Creation: Feb 11, 2016 at 03:02 AM
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `FName` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `LName` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `email` varchar(32) COLLATE utf16_unicode_520_ci NOT NULL,
  `password` varchar(16) COLLATE utf16_unicode_520_ci NOT NULL,
  `phone_no` int(10) NOT NULL,
  `grad_year` year(4) NOT NULL,
  `faculty` varchar(10) COLLATE utf16_unicode_520_ci NOT NULL,
  `degree_type` varchar(5) COLLATE utf16_unicode_520_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_520_ci;

--
-- RELATIONS FOR TABLE `supplier`:
--

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `FName`, `LName`, `email`, `password`, `phone_no`, `grad_year`, `faculty`, `degree_type`, `is_admin`) VALUES
(1, 'Raquel', 'Smith', 'smith_raquel@queensu.ca', 'raquelsmith', 1234567890, 2003, 'Science', 'Bsc', 1),
(2, 'Mai', 'Wu', 'mai_wu@queensu.ca', 'maiwu', 1234567899, 2004, 'Con-ed', 'Ba', 0),
(3, 'Jeffery', 'Lin', 'jeffery_lin@queensu.ca', 'jefferylin', 1234567889, 2001, 'Computing', 'Bcs', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `property_id_index` (`property_id`) USING BTREE;

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `property_id_index` (`property_id`) USING BTREE;

--
-- Indexes for table `consumer`
--
ALTER TABLE `consumer`
  ADD PRIMARY KEY (`consumer_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`District_name`,`POI`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`supplier_id`,`property_id`),
  ADD KEY `property_id_constraint` (`property_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `consumer`
--
ALTER TABLE `consumer`
  MODIFY `consumer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_property_id_constraint` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_property_id_constraints` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `property_id_constraint` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_id_constraint` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
