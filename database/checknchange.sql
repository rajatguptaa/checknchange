-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2017 at 10:42 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `checknch_adminpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `access_id` int(11) NOT NULL,
  `access_level_id` int(11) NOT NULL,
  `access_module_id` int(11) NOT NULL,
  `access_view` int(11) DEFAULT '0',
  `access_insert` int(11) DEFAULT '0',
  `access_update` int(11) DEFAULT '0',
  `access_delete` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`access_id`, `access_level_id`, `access_module_id`, `access_view`, `access_insert`, `access_update`, `access_delete`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 0),
(5, 2, 1, 0, 0, 0, 0),
(6, 2, 2, 0, 0, 0, 0),
(7, 2, 3, 1, 1, 1, 1),
(8, 2, 4, 0, 0, 0, 0),
(9, 3, 1, 0, 0, 0, 0),
(10, 3, 2, 1, 1, 1, 1),
(11, 3, 3, 1, 1, 1, 1),
(12, 3, 4, 0, 0, 0, 0),
(13, 1, 5, 1, 1, 1, 1),
(14, 2, 5, 0, 0, 0, 0),
(15, 3, 5, 1, 1, 1, 1),
(16, 1, 8, 1, 1, 0, 0),
(17, 2, 8, 1, 1, 0, 0),
(18, 3, 8, 1, 1, 1, 1),
(19, 1, 9, 1, 1, 1, 1),
(20, 2, 9, 0, 0, 0, 0),
(21, 3, 9, 1, 1, 1, 1),
(22, 1, 10, 1, 1, 1, 1),
(23, 2, 10, 1, 0, 0, 0),
(24, 3, 10, 1, 1, 1, 1),
(25, 1, 11, 1, 1, 1, 1),
(26, 2, 11, 1, 1, 1, 1),
(27, 3, 11, 1, 1, 1, 1),
(28, 1, 14, 1, 1, 1, 1),
(29, 2, 14, 1, 1, 1, 1),
(30, 1, 15, 1, 1, 1, 1),
(31, 2, 15, 1, 1, 1, 1),
(32, 1, 16, 1, 1, 1, 1),
(33, 2, 16, 1, 1, 1, 1),
(34, 1, 17, 1, 1, 1, 1),
(35, 2, 17, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE IF NOT EXISTS `access_level` (
  `access_level_id` int(11) NOT NULL,
  `access_level_name` varchar(45) DEFAULT NULL,
  `access_level_description` varchar(130) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`access_level_id`, `access_level_name`, `access_level_description`) VALUES
(1, 'superadmin', 'Administrator Access'),
(2, 'admin', 'Admin Access'),
(3, 'employee', 'Employee access'),
(4, 'customer', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `amc`
--

CREATE TABLE IF NOT EXISTS `amc` (
  `id` int(11) NOT NULL,
  `amc_name` varchar(255) NOT NULL,
  `amc_code` int(11) NOT NULL,
  `amc_duration` varchar(255) NOT NULL,
  `amc_visit` int(11) NOT NULL,
  `amc_criteria` varchar(255) NOT NULL,
  `amc_description` text NOT NULL,
  `package_logo` text NOT NULL,
  `amc_status` int(11) NOT NULL,
  `package_update` datetime NOT NULL,
  `amc_type` text NOT NULL,
  `amc_price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amc`
--

INSERT INTO `amc` (`id`, `amc_name`, `amc_code`, `amc_duration`, `amc_visit`, `amc_criteria`, `amc_description`, `package_logo`, `amc_status`, `package_update`, `amc_type`, `amc_price`) VALUES
(7, ' RO ', 101, '1', 4, ' CLEANING AND SERVICE COMMITMENT', 'PART REPLACEMENT WITHOUT LABOUR CHARGE - CHANGING MAM-BRAN,CARBON AND FILTER REPLACEMENT LABOUR FREE (WATER  HARDNESS  LAB TEST*)', 'assets/img/package/userimage_fb25a28.jpg', 1, '2017-01-23 16:59:25', 'primary', 0),
(8, 'ELECTRIC', 102, '1', 12, 'WITHOUT MATERIAL CHANGING SWITCHES ,ELECTRIC WIRING FAULT DETECTION AND SOLUTION ,HANGING FAN AND REPLACEMENT OF LIGHTS BULB TUBE AT HOME ( CIVIL WORK NOT A PART OF AMC* ITS COST YOU EXTRA ON SITE TO SITE CONDITION)', 'PART REPLACEMENT WITHOUT LABOUR CHARGE - AS PER MARKET RATE + 30 RS + Actual TRANSPORTATION CHARGES (ONLY BRANDED MATERIAL WILL BE USED)IF CUSTOMER WANTS TO PROVIDE REPLACING PART THEN WE WILL FIX THE SAME FREE OF COST (15 DAYS SERVICE WARRANTY NOT CONSIDER)', 'assets/img/package/userimage_2d1b247.jpg', 1, '2016-12-13 11:37:48', 'primary', 0),
(9, 'PLUMBER', 103, '1', 12, 'CRITERIA - WITHOUT MATERIAL CHANGING TAPS AND SHOWERS ,LEAKAGE DETECTION AND SOLUTION OUTER FITTINGS( IN COURSE OF LEAKAGE REPAIR OR FITTINGS WALL AND TILES WILL BROKE OR DAMAGE WHICH IS PART OF SOLUTION FOR THAT ', 'PART REPLACEMENT WITHOUT LABOUR CHARGE - AS PER MARKET RATE + 30 RS +Actual TRANSPORTATION CHARGES (ONLY BRANDED MATERIAL WILL BE USED)IF CUSTOMER WANTS TO PROVIDE REPLACING PART THEN WE WILL FIX THE SAME FREE OF COST (15 DAYS SERVICE WARRANTY NOT CONSIDER)', 'assets/img/package/userimage_7d9431c.jpg', 1, '2016-12-12 12:06:56', 'primary', 0),
(10, ' CARPENTER ', 104, '1', 12, 'WITHOUT MATERIAL CHANGING DOOR WINDOWS,LOCKS HOLE DROPS FITTINGS MODULAR KITCHEN REPAIRING ( IN COURSE OF REPAIR OR FITTINGS WALL AND TILES WILL BROKE OR DAMAGE WHICH IS PART OF SOLUTION FOR THAT ', 'PART REPLACEMENT WITHOUT LABOUR CHARGE - AS PER MARKET RATE +  30Rs + ACTUAL TRANSPORTATION CHARGES (ONLY BRANDED MATERIAL WILL BE USED)IF CUSTOMER WANTS TO PROVIDE REPLACING PART THEN WE WILL FIX THE SAME FREE OF COST (15 DAYS SERVICE WARRANTY NOT CONSIDER)', 'assets/img/package/userimage_b96a1ac.jpg', 1, '2016-12-13 11:52:00', 'primary', 0),
(11, 'Peste Control', 0, '1', 2, 'bugs and lizards', 'tied up with laxmi pest and fumigation', 'assets/img/package/userimage_762e0b6.jpg', 0, '2016-11-19 10:42:29', 'secondary', 0),
(12, 'PEST CONTROL', 0, '1', 2, 'this is test', 'test', 'assets/img/package/userimage_6ad6887.jpg', 1, '2016-12-17 12:39:41', 'secondary', 0),
(13, 'Electric Appliancestt', 0, '1', 2, 'tt', '', '', 0, '2016-11-19 10:43:47', 'primary', 0),
(14, 'Glass Work', 0, '1', 2, 'this amc is related to glass work', '', 'assets/img/package/userimage_0bca229.jpg', 1, '2016-12-02 08:28:10', 'secondary', 200),
(15, 'PAINTING', 0, '1', 2, 'NOT AMC', '', '', 1, '2016-12-17 12:41:01', 'secondary', 0),
(16, 'WASHING MACHINE', 0, '1', 2, 'NON AMC', 'REPAIRING WORK', '', 1, '2017-01-15 13:53:22', 'home_appliance', 0),
(17, 'MICROWAVE', 0, '1', 2, 'NON AMC', '', '', 1, '2017-01-23 17:52:03', 'home_appliance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `amc_service`
--

CREATE TABLE IF NOT EXISTS `amc_service` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amc_id` int(11) NOT NULL,
  `amc_rel` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `reference_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `amc_note` text COLLATE utf8_unicode_ci NOT NULL,
  `edited_at` datetime NOT NULL,
  `amc_code` bigint(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `amc_service`
--

INSERT INTO `amc_service` (`id`, `user_id`, `amc_id`, `amc_rel`, `start_date`, `due_date`, `reference_by`, `create_date`, `amc_note`, `edited_at`, `amc_code`) VALUES
(10, 83, 7, 6, '2017-02-19 00:00:00', '2017-02-19 00:00:00', 81, '2016-11-19 10:57:05', 'he want to regular sevice also ', '0000-00-00 00:00:00', 0),
(11, 83, 9, 7, '2017-02-19 00:00:00', '2017-02-19 00:00:00', 81, '2016-11-19 10:57:05', 'he want to regular sevice also ', '0000-00-00 00:00:00', 0),
(12, 101, 8, 8, '2017-02-27 00:00:00', '2017-02-27 00:00:00', 81, '2016-11-27 13:20:34', 'SERVICE TEX NOT INCLUDED ', '0000-00-00 00:00:00', 0),
(13, 101, 9, 9, '2017-02-27 00:00:00', '2017-02-27 00:00:00', 81, '2016-11-27 13:20:34', 'SERVICE TEX NOT INCLUDED ', '0000-00-00 00:00:00', 0),
(14, 153, 7, 10, '2017-04-19 00:00:00', '2017-04-19 00:00:00', 88, '2017-01-19 14:49:09', 'WITH MATERIAL. EVERY MONTH TDS TEST.', '0000-00-00 00:00:00', 0),
(15, 169, 8, 11, '2017-03-03 00:00:00', '2017-03-03 00:00:00', 88, '2017-02-03 16:48:06', 'PLUMBER SERVICES TAX OMITTED. HALF YEARLY AMOUNT @ 50% RECEIPTED.', '0000-00-00 00:00:00', 0),
(16, 169, 9, 12, '2017-03-03 00:00:00', '2017-03-03 00:00:00', 88, '2017-02-03 16:48:06', 'PLUMBER SERVICES TAX OMITTED. HALF YEARLY AMOUNT @ 50% RECEIPTED.', '0000-00-00 00:00:00', 0),
(17, 169, 10, 13, '2017-03-03 00:00:00', '2017-03-03 00:00:00', 88, '2017-02-03 16:48:06', 'PLUMBER SERVICES TAX OMITTED. HALF YEARLY AMOUNT @ 50% RECEIPTED.', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `amc_service_history`
--

CREATE TABLE IF NOT EXISTS `amc_service_history` (
  `id` int(11) NOT NULL,
  `amc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `reference_by` int(11) NOT NULL,
  `notes` int(11) NOT NULL,
  `complete_date` datetime NOT NULL,
  `complete_notes` varchar(500) NOT NULL,
  `amc_service_id` int(11) NOT NULL,
  `amc_code` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amc_service_history`
--

INSERT INTO `amc_service_history` (`id`, `amc_id`, `user_id`, `start_date`, `due_date`, `reference_by`, `notes`, `complete_date`, `complete_notes`, `amc_service_id`, `amc_code`) VALUES
(1, 7, 83, '2016-11-19 10:57:05', '2016-11-19 10:57:05', 81, 0, '2016-11-19 11:00:24', 'Ro m/c is going well and no work is there', 10, '0'),
(2, 9, 83, '2016-11-19 10:57:05', '2016-11-19 10:57:05', 81, 0, '2016-11-19 11:10:53', 'complete', 11, '0'),
(3, 7, 153, '2017-01-19 14:49:09', '2017-01-19 14:49:09', 88, 0, '2017-02-06 12:30:18', 'ro amc provided by manish /iswar sir', 14, '0'),
(4, 9, 83, '2016-12-19 00:00:00', '2016-12-19 00:00:00', 81, 0, '2017-02-06 12:30:54', 'dummy\n\n', 11, '0'),
(5, 9, 83, '2017-01-19 00:00:00', '2017-01-19 00:00:00', 81, 0, '2017-02-06 12:31:12', 'dummy\n\n', 11, '0'),
(6, 9, 101, '2016-11-27 13:20:34', '2016-11-27 13:20:34', 81, 0, '2017-02-06 12:31:37', 'dummy\n\n', 13, '0'),
(7, 8, 101, '2016-11-27 13:20:34', '2016-11-27 13:20:34', 81, 0, '2017-02-06 12:31:54', 'dummy\n\n', 12, '0'),
(8, 9, 101, '2016-12-27 00:00:00', '2016-12-27 00:00:00', 81, 0, '2017-02-06 12:32:17', 'dummy\nvivek sir\n', 13, '0'),
(9, 9, 101, '2017-01-27 00:00:00', '2017-01-27 00:00:00', 81, 0, '2017-02-06 12:33:46', 'dummy entry', 13, '0'),
(10, 8, 101, '2016-12-27 00:00:00', '2016-12-27 00:00:00', 81, 0, '2017-02-06 12:33:59', 'dummy entry ', 12, '0'),
(11, 8, 101, '2017-01-27 00:00:00', '2017-01-27 00:00:00', 81, 0, '2017-02-06 12:34:30', 'DUMMY ENTRY', 12, '0'),
(12, 9, 169, '2017-02-03 16:48:06', '2017-02-03 16:48:06', 88, 0, '2017-02-06 12:36:35', 'VIKRAM CHAWDA DONE AMC GIVEN HALF YEARLY', 16, '0'),
(13, 8, 169, '2017-02-03 16:48:06', '2017-02-03 16:48:06', 88, 0, '2017-02-06 12:36:56', 'AMC GIVEN HALF YEARLY', 15, '0'),
(14, 10, 169, '2017-02-03 16:48:06', '2017-02-03 16:48:06', 88, 0, '2017-02-06 12:37:16', 'AMC GIVEN HALF YEARLY ', 17, '0');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_Id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_start_time` varchar(50) NOT NULL,
  `appointment_end_time` varchar(50) NOT NULL,
  `appointment_venue` varchar(100) NOT NULL,
  `appointment_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_relation`
--

CREATE TABLE IF NOT EXISTS `appointment_relation` (
  `appointment_relation_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `assignee_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_relation`
--

INSERT INTO `appointment_relation` (`appointment_relation_id`, `appointment_id`, `ticket_id`, `assignee_id`, `assigned_by`, `comment_id`, `created_at`) VALUES
(1, 1, 1, 42, 1, 73, '2016-04-01 14:28:38'),
(2, 2, 1, 42, 1, 74, '2016-04-01 14:29:22'),
(3, 3, 1, 42, 1, 75, '2016-04-01 14:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `article_comment_rel`
--

CREATE TABLE IF NOT EXISTS `article_comment_rel` (
  `article_comment_rel_id` int(11) NOT NULL,
  `forum_article_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `article_status` enum('Answer') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_comment_rel`
--

INSERT INTO `article_comment_rel` (`article_comment_rel_id`, `forum_article_id`, `comment_id`, `article_status`) VALUES
(1, 2, 1, NULL),
(5, 3, 5, NULL),
(6, 3, 6, NULL),
(10, 3, 10, NULL),
(11, 3, 11, NULL),
(12, 3, 12, NULL),
(13, 3, 13, NULL),
(14, 3, 14, NULL),
(15, 3, 15, NULL),
(23, 1, 23, NULL),
(33, 1, 33, NULL),
(40, 1, 40, NULL),
(42, 1, 42, NULL),
(43, 1, 43, NULL),
(44, 1, 44, NULL),
(45, 1, 45, NULL),
(46, 1, 46, NULL),
(47, 1, 47, NULL),
(51, 2, 51, NULL),
(52, 2, 52, NULL),
(54, 2, 54, NULL),
(56, 2, 56, NULL),
(57, 2, 57, NULL),
(58, 2, 58, NULL),
(59, 2, 59, NULL),
(60, 2, 60, NULL),
(61, 2, 61, NULL),
(62, 2, 62, NULL),
(63, 2, 63, NULL),
(64, 2, 64, NULL),
(65, 2, 65, NULL),
(66, 2, 66, NULL),
(67, 2, 67, NULL),
(68, 2, 68, NULL),
(69, 2, 69, NULL),
(70, 2, 70, NULL),
(71, 5, 72, NULL),
(72, 5, 76, NULL),
(73, 5, 77, NULL),
(74, 5, 78, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_idea_status`
--

CREATE TABLE IF NOT EXISTS `article_idea_status` (
  `article_idea_status_id` int(11) NOT NULL,
  `forum_article_id` int(11) NOT NULL,
  `article_idea_status` enum('Planned','Done','Not planned','None') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `attachment_id` int(11) NOT NULL,
  `attachment_name` varchar(254) NOT NULL,
  `attachment_path` varchar(254) NOT NULL,
  `attachment_type` enum('audio','video','image','doc','extra','object') NOT NULL,
  `attachment_update` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attachment`
--

INSERT INTO `attachment` (`attachment_id`, `attachment_name`, `attachment_path`, `attachment_type`, `attachment_update`) VALUES
(1, 'fresh-lemon-juice.jpg', 'assets/attachment/image/1459322124_fresh-lemon-juice.jpg', 'image', '2016-03-30 09:15:24'),
(2, 'default_avatar_male.jpg', 'assets/attachment/image/1459335245_default_avatar_male.jpg', 'image', '2016-03-30 12:54:05'),
(3, 'composite.gif', 'assets/attachment/image/1459335247_composite.gif', 'image', '2016-03-30 12:54:07'),
(4, 'default_avatar_male.jpg', 'assets/attachment/image/1459335258_default_avatar_male.jpg', 'image', '2016-03-30 12:54:18'),
(5, 'fresh-lemon-juice.jpg', 'assets/attachment/image/1459335262_fresh-lemon-juice.jpg', 'image', '2016-03-30 12:54:22'),
(6, 'Gajar_Ka_Halwa_Carrot_Halwa1.JPG', 'assets/attachment/extra/1459335272_Gajar_Ka_Halwa_Carrot_Halwa1.JPG', 'extra', '2016-03-30 12:54:32'),
(7, 'Lenovo_ThinkPad_X1_Ultrabook.jpg', 'assets/attachment/image/1459335285_Lenovo_ThinkPad_X1_Ultrabook.jpg', 'image', '2016-03-30 12:54:45'),
(8, 'composite.gif', 'assets/attachment/image/1459335492_composite.gif', 'image', '2016-03-30 12:58:12'),
(9, 'complaince_check.png', 'assets/attachment/image/1459335498_complaince_check.png', 'image', '2016-03-30 12:58:18'),
(10, 'favicon.png', 'assets/attachment/image/1459335501_favicon.png', 'image', '2016-03-30 12:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_message` text NOT NULL,
  `comment_by_id` int(11) NOT NULL,
  `comment_update` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_message`, `comment_by_id`, `comment_update`) VALUES
(1, '<p>hhhhhhhhhhhhhhhhh</p>\r\n', 1, '2016-03-31 08:08:50'),
(5, '<p>dsadsadsa</p>\r\n', 1, '2016-03-30 09:17:53'),
(6, '<p>sdfdsfds</p>\r\n', 1, '2016-03-30 09:18:25'),
(10, '<p>fdsfdsfds</p>', 1, '2016-03-30 12:30:41'),
(11, 'fdsfdsfds', 1, '2016-03-30 12:30:45'),
(12, '<p>dsadsadsadsad</p>', 1, '2016-03-30 12:31:11'),
(13, '<p>c</p>', 1, '2016-03-30 12:33:58'),
(14, '<p>eeeeeeeeeeeee</p>\r\n', 1, '2016-04-01 14:24:21'),
(15, '<p><iframe src="//www.youtube.com/embed/Hj4zrNI9bcU" width="560" height="314" allowfullscreen="allowfullscreen"></iframe></p>', 1, '2016-03-30 12:39:17'),
(23, '<p>dfsfdsfds</p>', 1, '2016-03-30 15:47:55'),
(33, '<p><br data-mce-bogus="1"></p>', 1, '2016-03-30 16:04:42'),
(40, '<p>fdfdsf</p>', 1, '2016-03-30 16:29:30'),
(42, '<p>dsds</p>', 1, '2016-03-30 16:32:18'),
(43, '<p>dfgdfgd</p>', 1, '2016-03-30 16:33:03'),
(44, '<p>sds</p>', 1, '2016-03-30 16:34:42'),
(45, '<p>cxczx</p>', 1, '2016-03-30 16:35:50'),
(46, '<p>dsadsad</p>', 1, '2016-03-30 16:36:17'),
(47, '<p>vbvcbvc</p>', 1, '2016-03-30 16:37:17'),
(51, 'cxcxcx', 1, '2016-03-31 07:05:29'),
(52, '<p>sss</p>', 1, '2016-03-31 07:14:42'),
(54, 'dsds', 1, '2016-03-31 07:16:41'),
(56, 'fvvcv gdfgdfgdfgdfg fdsfsdfds', 1, '2016-03-31 07:49:32'),
(57, '<p>fdfdsfds<br data-mce-bogus="1"></p>', 1, '2016-03-31 07:33:30'),
(58, '<p>dsafdsf</p>', 1, '2016-03-31 08:33:45'),
(59, '<p>hfdgh</p>', 1, '2016-03-31 08:34:19'),
(60, '<p>s</p>', 1, '2016-03-31 08:44:25'),
(61, '<p>sdfa</p>', 1, '2016-03-31 08:53:40'),
(62, '<p>dsfsdf</p>', 1, '2016-03-31 08:57:20'),
(63, '<p>as</p>', 1, '2016-03-31 09:27:41'),
(64, '<p>sdf</p>', 1, '2016-03-31 09:29:15'),
(65, '<p>vscvvc</p>', 1, '2016-03-31 09:39:19'),
(66, '<p>df</p>', 1, '2016-03-31 09:39:52'),
(67, '<p>s</p>', 1, '2016-03-31 09:45:26'),
(68, '<p>fffef</p>', 1, '2016-03-31 09:49:42'),
(69, '<p>wwwwww</p>', 1, '2016-03-31 09:50:29'),
(70, '<p>qq</p>', 1, '2016-03-31 09:51:38'),
(71, 'dsadsad', 1, '2016-03-31 16:18:06'),
(72, '<p>dfdfdsfdsf fdfdf</p>\r\n', 1, '2016-04-04 06:17:34'),
(73, 'cdxcdxs', 1, '2016-04-01 14:28:38'),
(74, 'asasa', 1, '2016-04-01 14:29:22'),
(75, 'cc', 1, '2016-04-01 14:32:29'),
(76, '<p>cxzcxzcxzcxzczx</p>\r\n', 1, '2016-04-04 06:18:40'),
(77, '<p>czcccxccxcxc</p>\r\n', 1, '2016-04-04 06:18:57'),
(78, '<p>czcxzcxcxcx</p>\r\n', 1, '2016-04-04 06:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `comment_attachment_rel`
--

CREATE TABLE IF NOT EXISTS `comment_attachment_rel` (
  `comment_attach_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_type` enum('good','bad') NOT NULL,
  `feedback_comment` text NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `followup`
--

CREATE TABLE IF NOT EXISTS `followup` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `work_requirement` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forget_password`
--

CREATE TABLE IF NOT EXISTS `forget_password` (
  `forget_password_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `forget_token` varchar(256) NOT NULL,
  `forget_update` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forget_password`
--

INSERT INTO `forget_password` (`forget_password_id`, `user_id`, `forget_token`, `forget_update`) VALUES
(1, 43, '56d831e1c7a6f', '2016-03-03 13:45:21'),
(2, 44, '56d831fecf612', '2016-03-03 13:45:50'),
(3, 45, '56d8325a298f5', '2016-03-03 13:47:22'),
(4, 46, '56d832755e5b1', '2016-03-03 13:47:49'),
(5, 79, '582da38970270', '2016-11-17 12:33:13'),
(6, 80, '582da89ae8378', '2016-11-17 12:54:50'),
(7, 82, '58302d46a792a', '2016-11-19 10:45:26'),
(8, 84, '5834303da0eda', '2016-11-22 11:47:09'),
(9, 85, '5834353601a15', '2016-11-22 12:08:21'),
(10, 89, '5836cd4907522', '2016-11-24 11:21:45'),
(11, 90, '583955682dd79', '2016-11-26 09:27:04'),
(12, 91, '583a9b23d17f3', '2016-11-27 08:36:51'),
(13, 100, '583aad9a35e59', '2016-11-27 09:55:38'),
(14, 110, '583e71a04f536', '2016-11-30 06:28:48'),
(15, 117, '584116310689e', '2016-12-02 06:35:29'),
(16, 122, '58412c7e28a27', '2016-12-02 08:10:38'),
(17, 123, '5841311dd1552', '2016-12-02 08:30:21'),
(18, 124, '584a85fe3682d', '2016-12-09 15:52:54'),
(19, 125, '584e552b30d69', '2016-12-12 13:13:39'),
(20, 126, '584f8fd977698', '2016-12-13 11:36:17'),
(21, 127, '584f941fb0ba9', '2016-12-13 11:54:31'),
(22, 128, '58537e40f4177', '2016-12-16 11:10:16'),
(23, 129, '5854dcb101a00', '2016-12-17 12:05:28'),
(24, 130, '5854e6060ea83', '2016-12-17 12:45:18'),
(25, 131, '5856282f05a1b', '2016-12-18 11:39:51'),
(26, 132, '58562b6b7bca5', '2016-12-18 11:53:39'),
(27, 133, '5860dbeb7d371', '2016-12-26 14:29:23'),
(28, 134, '5866577479eb2', '2016-12-30 18:17:48'),
(29, 135, '586741db94c8e', '2016-12-31 10:57:55'),
(30, 136, '586782facc227', '2016-12-31 15:35:46'),
(31, 137, '586785cd2de0b', '2016-12-31 15:47:49'),
(32, 138, '58689d88d8c09', '2017-01-01 11:41:20'),
(33, 139, '586f6da9278e3', '2017-01-06 15:42:57'),
(34, 140, '587229ef04121', '2017-01-08 17:30:47'),
(35, 141, '58735d51f0235', '2017-01-09 15:22:17'),
(36, 142, '587745e9e3e55', '2017-01-12 14:31:29'),
(37, 143, '58788a409fabf', '2017-01-13 13:35:20'),
(38, 144, '58788e698c4fa', '2017-01-13 13:53:05'),
(39, 145, '587a21001f26f', '2017-01-14 18:30:48'),
(40, 146, '587b2ba07eaf0', '2017-01-15 13:28:24'),
(41, 147, '587b2d3715be9', '2017-01-15 13:35:11'),
(42, 148, '587b2ef945caf', '2017-01-15 13:42:41'),
(43, 149, '587b32efc97d0', '2017-01-15 13:59:35'),
(44, 150, '587dfce3dad56', '2017-01-17 16:45:47'),
(45, 151, '587e0f2293cd3', '2017-01-17 18:03:38'),
(46, 152, '587e117f04ffd', '2017-01-17 18:13:43'),
(47, 154, '58831d587c07b', '2017-01-21 14:05:36'),
(48, 155, '58831e26e26b7', '2017-01-21 14:09:02'),
(49, 156, '58844f64cb03c', '2017-01-22 11:51:24'),
(50, 157, '5885a161e16fd', '2017-01-23 11:53:29'),
(51, 158, '5885f1593b2af', '2017-01-23 17:34:41'),
(52, 159, '5885f2bad3f7f', '2017-01-23 17:40:34'),
(53, 160, '5885f5f31063a', '2017-01-23 17:54:19'),
(54, 161, '588b2fb3a4210', '2017-01-27 17:02:03'),
(55, 162, '588b40b29f65d', '2017-01-27 18:14:34'),
(56, 163, '588de7340d97e', '2017-01-29 18:29:32'),
(57, 164, '588de8256e89b', '2017-01-29 18:33:33'),
(58, 165, '58907ff66a30e', '2017-01-31 17:45:50'),
(59, 166, '5892fcdc8dcf0', '2017-02-02 15:03:16'),
(60, 167, '5892fde4150c7', '2017-02-02 15:07:40'),
(61, 168, '5892fefd4e81d', '2017-02-02 15:12:21'),
(62, 170, '589467e0d6b2d', '2017-02-03 16:52:08'),
(63, 172, '5896d15f8265e', '2017-02-05 12:46:47'),
(64, 173, '5896d4cc82666', '2017-02-05 13:01:24'),
(65, 174, '5896e770a0219', '2017-02-05 14:20:56'),
(66, 175, '5896e7ecd392d', '2017-02-05 14:23:00'),
(67, 176, '5896ecfcbd73e', '2017-02-05 14:44:36'),
(68, 177, '5896fa5c87988', '2017-02-05 15:41:40'),
(69, 178, '58981bc42fc98', '2017-02-06 12:16:28'),
(70, 179, '589839d4b9082', '2017-02-06 14:24:44'),
(71, 184, '589c395b18441', '2017-02-09 15:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `forum_id` int(11) NOT NULL,
  `forum_title` varchar(254) NOT NULL,
  `forum_desc` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `forum_type` enum('Articles','Ideas','Questions') NOT NULL,
  `forum_topic_view` enum('Everybody','Signed-in users','Agents only') NOT NULL,
  `forum_topic_create` enum('Logged-in users','Unrestricted agents and moderators only') NOT NULL,
  `forum_created_at` datetime NOT NULL,
  `forum_created_by` int(11) NOT NULL,
  `forum_order_by` text,
  `updated_by` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `forum_title`, `forum_desc`, `category_id`, `forum_type`, `forum_topic_view`, `forum_topic_create`, `forum_created_at`, `forum_created_by`, `forum_order_by`, `updated_by`) VALUES
(1, 'fdfdf', 'fdfd', 4, 'Articles', 'Agents only', 'Unrestricted agents and moderators only', '2016-03-26 05:48:52', 1, 'forum_article.forum_article_highlight_status DESC, forum_article.updated_by DESC', '0000-00-00 00:00:00'),
(2, 'fdsfdsfds', 'fdsfdsf', 5, 'Articles', 'Signed-in users', '', '2016-03-26 06:04:54', 1, 'forum_article.forum_article_highlight_status DESC, forum_article.updated_by DESC', '0000-00-00 00:00:00'),
(3, 'fdsfdsfdsdd', 'dsdsd', 5, 'Questions', 'Agents only', 'Unrestricted agents and moderators only', '2016-03-30 08:36:30', 1, 'forum_article.forum_article_highlight_status DESC, forum_article.updated_by DESC', '0000-00-00 00:00:00'),
(4, 'fdsfdsfds', 'dsfdsf', 10, 'Articles', 'Everybody', '', '2016-03-30 08:38:33', 1, 'forum_article.forum_article_highlight_status DESC, forum_article.updated_by DESC', '0000-00-00 00:00:00'),
(5, 'dsadsa', 'dsad', 8, 'Articles', 'Everybody', '', '2016-03-30 08:56:04', 1, 'forum_article.forum_article_highlight_status DESC, forum_article.updated_by DESC', '0000-00-00 00:00:00'),
(6, 'dsadsa', 'dsadsad', 7, 'Articles', 'Everybody', '', '2016-04-05 14:49:00', 1, 'forum_article.forum_article_highlight_status DESC, forum_article.updated_by DESC', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `forum_article`
--

CREATE TABLE IF NOT EXISTS `forum_article` (
  `forum_article_id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `forum_category_id` int(11) NOT NULL,
  `forum_article_title` varchar(512) NOT NULL,
  `forum_article_desc` text NOT NULL,
  `forum_article_comment_status` tinyint(1) NOT NULL,
  `forum_article_homepage_status` tinyint(1) NOT NULL,
  `forum_article_highlight_status` tinyint(1) NOT NULL,
  `forum_article_created_by` int(11) NOT NULL,
  `forum_article_cretaed_at` datetime NOT NULL,
  `updated_by` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_article`
--

INSERT INTO `forum_article` (`forum_article_id`, `forum_id`, `forum_category_id`, `forum_article_title`, `forum_article_desc`, `forum_article_comment_status`, `forum_article_homepage_status`, `forum_article_highlight_status`, `forum_article_created_by`, `forum_article_cretaed_at`, `updated_by`) VALUES
(1, 2, 5, 'sasasa', '<p>sasasas</p>\r\n', 0, 0, 0, 43, '2016-03-30 08:43:38', '2016-03-30 16:26:48'),
(2, 5, 8, 'sasasa', '<p>dsfdsfds</p>\r\n', 0, 0, 1, 1, '2016-03-30 08:56:12', '2016-03-31 07:23:17'),
(3, 3, 5, 'dsdsds', '<p>dsdsdsd</p>\r\n', 0, 0, 0, 1, '2016-03-30 09:17:48', '2016-03-30 09:17:48'),
(4, 3, 5, 'cxcxcx', '<p>cxcxc</p>\r\n', 0, 0, 0, 1, '2016-03-31 11:30:32', '2016-03-31 11:30:32'),
(5, 3, 5, 'xzcxzcxcxzczxcx', '<p>cxzczxczxcxzcxz</p>\r\n', 0, 0, 1, 1, '2016-03-31 11:31:02', '2016-04-04 06:20:48'),
(6, 6, 7, 'sdsadsa', '<p>dsadsad</p>\r\n', 0, 0, 0, 43, '2016-04-05 14:52:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `forum_article_attachment_rel`
--

CREATE TABLE IF NOT EXISTS `forum_article_attachment_rel` (
  `article_attachment_id` int(11) NOT NULL,
  `forum_article_id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_article_like`
--

CREATE TABLE IF NOT EXISTS `forum_article_like` (
  `article_like_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_article_like`
--

INSERT INTO `forum_article_like` (`article_like_id`, `article_id`, `user_id`, `created_at`) VALUES
(2, 1, 1, '2016-03-30 10:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `forum_category`
--

CREATE TABLE IF NOT EXISTS `forum_category` (
  `forum_category_id` int(11) NOT NULL,
  `forum_category_name` varchar(254) NOT NULL,
  `forum_category_description` text NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `forum_created_by` varchar(10) NOT NULL,
  `forum_created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_category`
--

INSERT INTO `forum_category` (`forum_category_id`, `forum_category_name`, `forum_category_description`, `organisation_id`, `forum_created_by`, `forum_created_at`) VALUES
(1, 'None', 'Default Category', 1, '1', '2016-03-25 15:31:51'),
(2, 'None', 'Default category', 2, '1', '2016-03-25 00:00:00'),
(3, 'None', 'Default Category', 3, '1', '2016-03-25 00:00:00'),
(4, 'dsfdsf', 'fdsfdsfdfdfds', 1, '1', '2016-03-26 05:48:38'),
(5, 'fdsfs', 'fdsfdsf', 1, '1', '2016-03-26 06:04:30'),
(6, 'fdsfs', 'cdsdfsadfs', 1, '1', '2016-03-30 08:00:00'),
(7, 'fdsfs', 'sfsdf', 1, '1', '2016-03-30 08:00:26'),
(8, 'dsfdsf', 'cx', 2, '1', '2016-03-30 08:08:46'),
(9, 'fdsfdsfds', 'fdsfdsf', 1, '1', '2016-03-30 08:22:41'),
(10, 'None', 'Default Category', 4, '1', '0000-00-00 00:00:00'),
(11, 'dsadsa', 'dsada', 1, '1', '2016-04-05 14:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `forum_tags`
--

CREATE TABLE IF NOT EXISTS `forum_tags` (
  `id` bigint(20) NOT NULL,
  `forum_article_id` bigint(20) NOT NULL,
  `tags_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_tags`
--

INSERT INTO `forum_tags` (`id`, `forum_article_id`, `tags_name`) VALUES
(1, 3, 'sds'),
(2, 4, 'cxcxcx');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL,
  `group_title` varchar(254) NOT NULL,
  `group_update` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `group_title`, `group_update`) VALUES
(1, 'Operations', '2016-02-15 10:58:42'),
(2, 'Support', '2016-02-15 10:58:42'),
(3, 'Engineers', '2016-02-24 03:14:15'),
(4, 'Renewals', '2016-02-24 04:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(11) NOT NULL,
  `module_parent` int(11) NOT NULL,
  `module_name` varchar(45) DEFAULT NULL,
  `module_description` text,
  `module_link` varchar(125) DEFAULT NULL,
  `module_icon` varchar(45) NOT NULL,
  `module_position` enum('menu','profile','submenu') NOT NULL,
  `module_order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_parent`, `module_name`, `module_description`, `module_link`, `module_icon`, `module_position`, `module_order`) VALUES
(2, 0, 'employee', 'Employee Module', 'employee', 'fa fa-user-md', 'menu', 6),
(3, 0, 'dashboard', 'Dashboard Module', 'dashboard', 'fa fa-tachometer', 'menu', 1),
(4, 0, 'permission', 'Access Module', 'access', 'fa fa-user-secret', 'profile', 1),
(5, 0, 'customer', 'Customer Module', 'customer', 'glyphicon glyphicon-user', 'menu', 7),
(6, 0, 'approved ', 'Approved Customer', 'customer', 'glyphicon glyphicon-ok', 'submenu', 10),
(7, 0, 'unapproved', 'Unapproved Customer', 'customer/unapproved', 'glyphicon glyphicon-remove', 'submenu', 11),
(8, 0, 'ticket', 'Ticket', 'request', 'fa fa-bug', 'menu', 6),
(11, 0, 'AMC', 'Package name', 'amc', 'glyphicon glyphicon-cog', 'menu', 2),
(14, 0, 'AMC Service', 'AMC Service list of customer', 'service', 'glyphicon glyphicon-wrench', 'menu', 3),
(15, 0, 'AMC Service History', 'Amc service history', 'history', 'glyphicon glyphicon-random', 'menu', 4),
(16, 0, 'archive', 'archive', 'archive', 'fa fa-archive', 'menu', 13),
(17, 0, 'Followup', 'Followup', 'followup', 'fa fa-arrow-up', 'menu', 15);

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE IF NOT EXISTS `organisation` (
  `organisation_id` int(11) NOT NULL,
  `organisation_name` varchar(256) NOT NULL,
  `organisation_title` text NOT NULL,
  `organisation_address` varchar(256) NOT NULL,
  `organisation_address2` varchar(256) NOT NULL,
  `city` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `postcode` varchar(128) NOT NULL,
  `organisation_phone` varchar(20) NOT NULL,
  `organisation_logo` varchar(254) NOT NULL,
  `organisation_notes` text NOT NULL,
  `organisation_customer_type` varchar(128) NOT NULL,
  `organisation_extra` text NOT NULL,
  `organisation_text` text NOT NULL,
  `organisation_update` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`organisation_id`, `organisation_name`, `organisation_title`, `organisation_address`, `organisation_address2`, `city`, `country`, `postcode`, `organisation_phone`, `organisation_logo`, `organisation_notes`, `organisation_customer_type`, `organisation_extra`, `organisation_text`, `organisation_update`) VALUES
(1, 'schoolAudit', 'Welcome to ignis', '10 Street Down', 'TDS', 'Indore', 'India', '452003', '11234455555', 'assets/img/organisation/userimage_9e8b0cf.jpg', 'Work on monday to friday.', 'Educational', 'iSchoolAudit.com | A smart way to audit your school assets using a PC, Tablet or iPhone. Audit and track your high value equipment and report faults.', 'The inVentry customer portal is a one stop shop for all your support requirements. Here you have access to a wide range of support tutorials and documentation. You can also ask questions, raise support tickets and track ticket ', '2016-02-23 06:31:58'),
(2, 'CLASSMARK', 'Welcome to classmark', '34, Saket, Indore,', 'mp', 'Indore', 'India', '452003', '12345678999', '', 'Class Mark', 'Educational', 'Classmarks are the number codes which you can see on the spine labels of the library books. Each classmark identifies a particular subject, e.g. the classmark for anatomy is 611.', 'The inVentry customer portal is a one stop shop for all your support requirements. Here you have access to a wide range of support tutorials and documentation. You can also ask questions, raise support tickets and track ticket progress.', '2016-02-23 06:35:20'),
(4, 'IWorkaudit', 'iworkaudit', 'dsadsa', 'dvcxfdsf', 'Indore', 'sdsdsa', '4545', '43434343433', 'assets/img/organisation/userimage_15bc628.png', 'fdsfdsfds', 'Educational', 'sfdsfds', 'fdsfdsfdsfdsfdsfdsf', '2016-03-22 12:33:05'),
(5, 'Ignis fdsfdsfds', 'fdsfds', 'fdsfds', 'fdsfds', 'fdsfsd', 'fdsfs', '45445', '45874874587', '', 'fdsfds', 'Educational', 'dfds', '', '2016-03-22 12:35:58'),
(6, 'source one', 'dsdsa', 'dsadsad', 'dsadsa', 'dsadsa', 'dsadsad', '232323', '22222222222', 'assets/img/organisation/userimage_74e1ed8.jpg', 'fdsfds', 'Commercial', 'fdsfdsfds', 'fdsfdsfdsfdsf', '2016-03-22 12:43:37'),
(7, 'George School', 'dsdsa', 'dsadas', 'dsadsadsads', 'dsadsa', 'dsdsa', '4343', '43433434444', '', 'fdfdsfds', 'Educational', 'fdsfds', 'fsdfdsfdsfdsf', '2016-03-25 15:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int(11) NOT NULL,
  `ticket_number` varchar(254) NOT NULL,
  `ticket_subject` text NOT NULL,
  `ticket_description` text NOT NULL,
  `ticket_priority` enum('normal','high','low','urgent') NOT NULL,
  `ticket_status` enum('Open','Pending','Solved','Doing','Closed') NOT NULL,
  `amc_ticket_type` enum('existing','new') NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_updated` datetime NOT NULL,
  `ticket_created` datetime NOT NULL,
  `amc_code` int(11) NOT NULL,
  `amc_type` varchar(255) NOT NULL,
  `amc_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `ticket_number`, `ticket_subject`, `ticket_description`, `ticket_priority`, `ticket_status`, `amc_ticket_type`, `user_id`, `ticket_updated`, `ticket_created`, `amc_code`, `amc_type`, `amc_id`) VALUES
(1, '#TKT47770161', 'Issue on AC', 'This is dummy ticket please ignore this one', 'normal', 'Open', 'existing', 80, '2017-02-05 12:57:02', '2016-11-17 12:54:55', 0, 'primary', 7),
(2, '#TKT42286124', 'plumber for geaser', 'wants to fix small geaser in kithchen', 'normal', 'Open', '', 79, '2016-11-17 13:04:10', '2016-11-17 13:00:56', 0, 'primary', 9),
(3, '#TKT93188153', 'related to AC Repairing', 'customer willing to sort out this issue as soon as possible \n', 'urgent', 'Open', '', 82, '2016-11-28 07:07:55', '2016-11-19 10:46:42', 0, 'primary', 7),
(4, '#TKT65207961', 'Need of Plumber', 'All Tap of washroom is not working please have a look once more ', 'high', 'Open', 'existing', 83, '2017-02-05 12:57:06', '2016-11-19 11:03:54', 11, 'primary', 9),
(5, '#TKT01929275', 'GAS CHULHA', 'MR. VIKRAM CHAWDA FOR GAS REGULATER CHANGE,GAS PIPE CHANGE CLEANING BURNER & LINE HP PERSON MANGILAL 7987827895  ', 'high', 'Solved', 'existing', 84, '2016-11-22 12:16:38', '2016-11-22 11:54:02', 0, 'primary', 7),
(6, '#TKT17617579', 'PLUMBING', 'MR. VIKRAM CHAWDA INSTAL A NEW SPANDLE  ', 'normal', 'Solved', '', 85, '2016-11-22 12:17:05', '2016-11-22 12:15:29', 0, 'primary', 9),
(7, '#TKT80612129', 'WORK IN BASHROOM ', 'INSTALL A NEW FLUSH TANK,CORNER BASIN,NEW SHOWER,NET CONNECTION,2 WAY BIB COCK & TOILET JET SPRAY.', 'normal', 'Solved', 'existing', 89, '2016-11-24 11:34:34', '2016-11-24 11:28:19', 0, 'primary', 9),
(8, '#TKT38975485', 'ELECTRIC', 'MR. RAVI KUNDAL ', 'normal', 'Solved', 'existing', 89, '2016-11-24 12:10:00', '2016-11-24 12:09:36', 0, 'primary', 7),
(9, '#TKT09783107', 'WORK IN WASHING MACHINE', 'MR. MANISH SHARMA', 'normal', 'Open', 'existing', 90, '2017-02-06 12:27:19', '2016-11-26 09:29:46', 0, 'primary', 7),
(10, '#TKT19149019', 'PLUMBING WORK', '2, WEST COUPPELIN CHANGE, BASIN NET CONNECTOR ', 'high', 'Solved', '', 91, '2016-11-27 11:37:59', '2016-11-27 08:56:33', 0, 'primary', 9),
(11, '#TKT30961897', 'PLUMBING WORK', 'MOTOR INSTALLATION,6 PVC VALVE FIX ', 'normal', 'Solved', '', 100, '2016-11-27 11:36:56', '2016-11-27 10:32:47', 0, 'primary', 9),
(12, '#TKT55982640', 'WORK FOR PLUMBING', 'WALL MIXTURE NIPPLE CHANGE', 'normal', 'Solved', '', 110, '2016-11-30 07:57:31', '2016-11-30 07:16:35', 0, 'primary', 9),
(13, '#TKT68641834', 'PLUMBER WORK', '(2) BATHROOM CLEANING & BASIN CORNER INSTALLATION. ', 'normal', 'Solved', '', 117, '2016-12-06 12:57:50', '2016-12-02 06:36:50', 0, 'primary', 9),
(14, '#TKT38742575', 'Repairing on plinth', 'this is test ticket please ignore this one', 'normal', 'Open', '', 80, '2016-12-02 08:14:15', '2016-12-02 08:14:15', 0, 'primary', 7),
(15, '#TKT56195140', 'window glass work', 'there is glass work on showcase \nneed heavy glass supporter', 'normal', 'Solved', '', 123, '2016-12-14 11:13:11', '2016-12-02 08:33:15', 0, 'secondary', 14),
(16, '#TKT32520688', 'PLUMBER & TILES', 'PLUMBING WORK & AFTER SIDE VISIT', 'normal', 'Solved', '', 124, '2016-12-13 13:56:37', '2016-12-09 15:57:37', 0, 'primary', 9),
(17, '#TKT60870922', 'PLUMBER WORK', 'TAPE SPINDLE CHANGE, WALL MIXTURE SPINDLE CHANGE.', 'normal', 'Solved', '', 125, '2016-12-12 15:40:46', '2016-12-12 14:07:53', 0, 'primary', 9),
(18, '#TKT15766545', 'ELECTRIC WORK', 'ELECTRIC WORK', 'normal', 'Solved', '', 126, '2016-12-16 11:15:43', '2016-12-13 11:43:22', 0, 'primary', 8),
(19, '#TKT49582833', 'Test', 'Test', 'high', 'Open', '', 127, '2016-12-15 17:42:05', '2016-12-15 17:42:05', 0, 'primary', 7),
(20, '#TKT55093665', 'Work In Carpanter', 'carpenter work', 'normal', 'Open', '', 128, '2016-12-16 11:11:43', '2016-12-16 11:11:43', 0, 'primary', 10),
(21, '#TKT50721272', 'WORK FOR CARPENTER', 'SOFA-SET CUSHION   ', 'normal', 'Open', '', 129, '2016-12-17 12:05:38', '2016-12-17 12:05:38', 0, 'primary', 10),
(22, '#TKT17173474', 'PAINTING WORK', 'HOUSE PAINTING', 'normal', 'Solved', '', 130, '2017-01-03 15:23:36', '2016-12-17 12:45:23', 0, 'secondary', 15),
(23, '#TKT70007636', 'WORK IN WASHING MACHINE', 'WASHING MACHINE WATER LEAK & DRAINING', 'normal', 'Solved', '', 131, '2016-12-20 17:52:50', '2016-12-18 11:39:55', 0, 'secondary', 16),
(24, '#TKT99860968', 'PLUMBER WORK', 'WORK FOR PLUMBING ', 'normal', 'Open', '', 132, '2017-01-06 15:43:50', '2016-12-18 11:53:43', 0, 'primary', 9),
(25, '#TKT22151248', 'PLUMBER WORK', 'WATER LINE CLEANING.', 'normal', 'Solved', '', 133, '2016-12-29 19:41:20', '2016-12-26 14:29:29', 0, 'primary', 9),
(26, '#TKT32324465', 'WORK FOR PLUMBER', 'TAPE SPINDLE CHANGE', 'normal', 'Solved', '', 134, '2016-12-30 18:18:47', '2016-12-30 18:17:51', 0, 'primary', 9),
(27, '#TKT53782844', 'PLUMBER WORK', 'PLUMBING WORK.', 'normal', 'Solved', '', 135, '2016-12-31 15:28:56', '2016-12-31 10:57:58', 0, 'primary', 9),
(28, '#TKT39983360', 'PLUMBER WORK', '(2) WATER TANK CLEANING', 'normal', 'Solved', '', 136, '2017-01-03 11:41:04', '2016-12-31 15:35:50', 0, 'primary', 9),
(29, '#TKT86189080', 'PLUMBER WORK', '(2) WATER TANK CLEANING', 'normal', 'Solved', '', 136, '2017-01-03 11:42:25', '2016-12-31 15:35:50', 0, 'primary', 9),
(30, '#TKT41929345', 'PLUMBING WORK', 'WATER LINE PIPE LEAKAGE REPAIR.', 'normal', 'Solved', '', 137, '2017-01-03 15:23:01', '2016-12-31 15:47:51', 0, 'primary', 9),
(31, '#TKT24671045', 'PLUMBER WORK', 'FLUSH TANK WORK, LEAKAGE REPAIR', 'normal', 'Solved', '', 138, '2017-01-02 17:30:57', '2017-01-01 11:41:23', 0, 'primary', 9),
(32, '#TKT98209990', 'ELECTRIC WORK', 'FAN HANGING.', 'normal', 'Open', '', 138, '2017-01-09 14:21:10', '2017-01-01 11:52:54', 0, 'primary', 8),
(33, '#TKT26665625', 'PLUMBER WORK', 'WATER TANK CLEANING,NARMADA PIPE LINE ATECH.  ', 'normal', 'Solved', '', 110, '2017-01-03 13:54:42', '2017-01-01 11:56:33', 0, 'primary', 9),
(34, '#TKT63714954', 'WORK FOR ELECTRIC', 'GEYSER REPAIRING.', 'normal', 'Solved', '', 139, '2017-01-08 12:55:21', '2017-01-06 15:43:00', 0, 'primary', 8),
(35, '#TKT50362578', 'RO WORK', 'RO REPAIRING.', 'normal', 'Solved', '', 140, '2017-01-09 18:22:50', '2017-01-08 17:30:54', 0, 'primary', 7),
(36, '#TKT36995535', 'Plumber Work', 'WALL MIXTURE BAND CHANGE & NRV CHANGE. (BY KRISHNPAL)', 'normal', 'Solved', '', 141, '2017-01-09 15:22:55', '2017-01-09 15:22:21', 0, 'primary', 9),
(37, '#TKT26140312', 'WASHING MACHINE', 'TIMER REPAIR.', 'normal', 'Solved', '', 142, '2017-01-12 14:31:55', '2017-01-12 14:31:34', 0, 'secondary', 16),
(38, '#TKT24900025', 'PAINTING WORK', 'ROOM PAINT. ASSIGN TO ATMARAM JI.', 'normal', 'Open', '', 143, '2017-01-15 13:42:58', '2017-01-13 13:37:17', 0, 'secondary', 15),
(39, '#TKT39171415', 'PLUMBER WORK.', '(7) BATHROOM WASH CLEANING,DIVER-TOR HEAD CHANGE,TAPE JALI CLEANING,PIPE LINE FITTING & MURGA SHEET FITTING. ASSIGN KRISHNPAL JI.    ', 'normal', 'Solved', '', 144, '2017-01-13 13:53:25', '2017-01-13 13:53:09', 0, 'primary', 9),
(40, '#TKT46107831', 'PLUMBER WORK.', 'LOFT TANK CONNECTED. ', 'normal', 'Solved', '', 146, '2017-01-17 15:01:34', '2017-01-15 13:28:27', 0, 'primary', 9),
(41, '#TKT85998538', 'ELECTRIC WORK.', 'ELECTRIC WORK.', 'normal', 'Solved', '', 147, '2017-01-17 15:02:16', '2017-01-15 13:37:06', 0, 'primary', 9),
(42, '#TKT92459504', 'ELECTRIC WORK', 'ELECTRIC WORK.', 'normal', 'Solved', '', 148, '2017-01-15 14:05:57', '2017-01-15 13:42:43', 0, 'primary', 8),
(43, '#TKT45221311', 'WASHING MACHINE ', 'WASHING MACHINE REPAIR.', 'normal', 'Open', '', 149, '2017-01-21 14:09:37', '2017-01-15 13:59:38', 0, 'home_appliance', 16),
(44, '#TKT89500604', 'PLUMBER WORK', 'FLUSH TANK REPAIR.', 'normal', 'Open', '', 150, '2017-01-17 17:14:21', '2017-01-17 16:45:51', 0, 'primary', 9),
(45, '#TKT03102591', 'ELECTRIC WORK', 'HOLDER CHANGE.', 'normal', 'Solved', '', 151, '2017-01-17 18:04:09', '2017-01-17 18:03:43', 0, 'primary', 8),
(46, '#TKT86745560', 'ELECTRIC WORK', 'FAN HANGING.', 'normal', 'Solved', '', 152, '2017-01-17 18:14:06', '2017-01-17 18:13:46', 0, 'primary', 8),
(47, '#TKT55210998', 'PLUMBER WORK', 'SPINDLE CHANGE. (ASSIGN KRISHNPAL)', 'normal', 'Solved', '', 154, '2017-01-21 14:06:02', '2017-01-21 14:05:39', 0, 'primary', 9),
(48, '#TKT46331092', 'PLUMBER WORK', 'ASSIGN KRISHNPAL JI.', 'normal', 'Solved', '', 155, '2017-01-21 14:09:22', '2017-01-21 14:09:06', 0, 'primary', 9),
(49, '#TKT18576680', 'ELECTRIC WORK', 'ELECTRIC WORK.', 'normal', 'Solved', '', 156, '2017-01-22 11:52:04', '2017-01-22 11:51:27', 0, 'primary', 8),
(50, '#TKT45466038', 'PLUMBER WORK.', 'KITCHEN STAND DRILL. ASSIGN TO VIKRAM JI', 'normal', 'Solved', '', 157, '2017-01-23 11:53:53', '2017-01-23 11:53:34', 0, 'primary', 9),
(51, '#TKT40321775', 'MICROWAVE WORK', 'MICROWAVE WORK.', 'normal', 'Solved', '', 158, '2017-01-25 16:33:47', '2017-01-23 17:34:45', 0, 'primary', 7),
(52, '#TKT14081243', 'RO WORK', 'WATER PURIFIER TDS CHECKING.', 'normal', 'Solved', '', 159, '2017-01-23 17:41:10', '2017-01-23 17:40:37', 0, 'primary', 7),
(53, '#TKT64694468', 'MICROWAVE WORK', 'MICROWAVE WORK', 'normal', 'Solved', '', 160, '2017-02-05 12:51:12', '2017-01-23 17:54:21', 0, 'home_appliance', 17),
(54, '#TKT21567676', 'ELECTRIC WORK', 'GEYSER REPAIRING (PREM PATIDAR JI)', 'normal', 'Solved', '', 161, '2017-02-05 12:51:20', '2017-01-27 17:02:06', 0, 'primary', 8),
(55, '#TKT16056660', 'PLUMBER WORK', 'WATER TANK CLEANING. ( VIKRAM JI )', 'normal', 'Solved', '', 161, '2017-01-28 13:35:41', '2017-01-27 17:26:32', 0, 'primary', 9),
(56, '#TKT11870796', 'CARPENTER WORK ', 'DOOR HANDLE REPAIR.( NIRMAL YADAV ) ', 'normal', 'Solved', '', 162, '2017-02-05 12:51:23', '2017-01-27 18:14:36', 0, 'primary', 10),
(57, '#TKT18244447', 'PLUMBER WORK', 'WATER TANK CLEANING,NARMADA CONNECTION & WATER PROOFING ( KRISHNA PAL JI ) VIKRAM JI.  ', 'normal', 'Open', '', 162, '2017-01-28 13:40:35', '2017-01-27 18:30:06', 0, 'primary', 9),
(58, '#TKT64170526', 'PLUMBER WORK', 'WATER TANK CLEANING & VALVE CHANGE. ASSIGN TO VIKRAM JI (PATIDAR JI)', 'normal', 'Solved', '', 163, '2017-01-29 18:29:58', '2017-01-29 18:29:36', 0, 'primary', 9),
(59, '#TKT75492776', 'PLUMBER WORK', 'BASIN NET CONNECTION. VIKRAM JI', 'normal', 'Solved', '', 164, '2017-01-29 18:34:41', '2017-01-29 18:33:44', 0, 'primary', 9),
(60, '#TKT36217075', 'PLUMBER WORK', 'TAPE REPAIRING.(VIKRAM JI)', 'normal', 'Solved', '', 165, '2017-01-31 17:46:53', '2017-01-31 17:46:25', 0, 'primary', 9),
(61, '#TKT36535110', 'CARPENTER WORK', 'CARPENTER WORK. (NIRMAL YADAV JI) ', 'normal', 'Solved', '', 166, '2017-02-02 15:12:55', '2017-02-02 15:03:19', 0, 'primary', 10),
(62, '#TKT56569454', 'CARPENTER WORK', 'CARPENTER WORK.(NIRMAL YADAV JI)', 'normal', 'Solved', '', 167, '2017-02-02 15:12:59', '2017-02-02 15:07:45', 0, 'primary', 10),
(63, '#TKT53990814', 'CARPENTER WORK', 'CARPENTER WORK.(NIRMAL YADAV JI)', 'normal', 'Solved', '', 168, '2017-02-02 15:13:03', '2017-02-02 15:12:24', 0, 'primary', 10),
(64, '#TKT05711235', 'RO WORK', 'RO WORK', 'normal', 'Solved', '', 170, '2017-02-05 12:48:38', '2017-02-03 16:52:14', 0, 'primary', 7),
(65, '#TKT57254338', 'WASHING MACHINE', 'PUMP CLEANING', 'normal', 'Solved', '', 172, '2017-02-05 12:57:42', '2017-02-05 12:46:50', 0, 'home_appliance', 16),
(66, '#TKT63724497', 'RO WORK ', 'RO REPAIR', 'normal', 'Open', '', 173, '2017-02-05 13:01:27', '2017-02-05 13:01:27', 0, 'primary', 7),
(67, '#TKT45978503', 'CARPENTER WORK', 'CARPENTER WORK', 'normal', 'Solved', '', 174, '2017-02-09 15:14:59', '2017-02-05 14:20:59', 0, 'primary', 10),
(68, '#TKT75964546', 'MICROWAVE WORK', 'MICROWAVE WORK', 'normal', 'Doing', '', 175, '2017-02-05 14:23:16', '2017-02-05 14:23:03', 0, 'home_appliance', 17),
(69, '#TKT33484919', 'PLUMBER WORK', 'PLUMBER WORK', 'normal', 'Solved', '', 176, '2017-02-05 14:44:54', '2017-02-05 14:44:39', 0, 'primary', 9),
(70, '#TKT16744620', 'ELECTRIC WORK', 'ELECTRIC WORK', 'normal', 'Solved', '', 177, '2017-02-05 15:42:02', '2017-02-05 15:41:46', 0, 'primary', 8),
(71, '#TKT28512180', 'WASH ROOM CLEANING', ' 7 BATHROOM AND TANK CLEANING WORK  ', 'normal', 'Doing', '', 178, '2017-02-06 14:13:55', '2017-02-06 12:18:48', 0, 'primary', 9),
(72, '#TKT32883147', 'plumber work', 'NEW WATER TANK INSTALLATION WITH FITTING. ', 'normal', 'Open', 'existing', 179, '2017-02-06 14:26:02', '2017-02-06 14:24:58', 0, 'primary', 9),
(73, '#TKT85271435', 'ELECTRIC WORK', 'FAN HANGING. (ASSIGN UMESH NIGAM JI) ', 'normal', 'Solved', '', 184, '2017-02-09 15:13:37', '2017-02-09 15:13:21', 0, 'primary', 8);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_assign`
--

CREATE TABLE IF NOT EXISTS `ticket_assign` (
  `ticket_assign_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `parent_user_id` int(11) NOT NULL,
  `current_working_user` int(11) NOT NULL,
  `ticket_assign_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_assign`
--

INSERT INTO `ticket_assign` (`ticket_assign_id`, `user_id`, `group_id`, `ticket_id`, `assigned_by`, `parent_user_id`, `current_working_user`, `ticket_assign_at`) VALUES
(1, 81, 0, 4, 47, 0, 0, '2016-11-19 11:03:54'),
(2, 81, 0, 5, 47, 0, 0, '2016-11-22 11:54:02'),
(3, 81, 0, 6, 47, 0, 1, '2016-11-22 12:15:29'),
(4, 88, 0, 7, 47, 0, 0, '2016-11-24 11:28:19'),
(5, 88, 0, 8, 47, 0, 1, '2016-11-24 12:09:36'),
(6, 88, 0, 10, 47, 0, 1, '2016-11-27 08:56:33'),
(7, 88, 0, 11, 47, 0, 1, '2016-11-27 10:32:47'),
(8, 88, 0, 12, 47, 0, 1, '2016-11-30 07:16:35'),
(9, 114, 0, 13, 47, 0, 1, '2016-12-02 06:36:50'),
(10, 86, 0, 14, 47, 0, 1, '2016-12-02 08:14:15'),
(11, 114, 0, 16, 47, 0, 1, '2016-12-09 15:57:37'),
(12, 114, 0, 17, 47, 0, 1, '2016-12-12 14:07:53'),
(13, 81, 0, 18, 47, 0, 1, '2016-12-13 11:43:22'),
(14, 87, 0, 19, 47, 0, 1, '2016-12-15 17:42:05'),
(15, 81, 0, 20, 47, 0, 1, '2016-12-16 11:11:43'),
(16, 81, 0, 21, 47, 0, 1, '2016-12-17 12:05:38'),
(17, 81, 0, 22, 47, 0, 1, '2016-12-17 12:45:23'),
(18, 81, 0, 23, 47, 0, 1, '2016-12-18 11:39:55'),
(19, 114, 0, 24, 47, 0, 1, '2016-12-18 11:53:43'),
(20, 114, 0, 25, 47, 0, 1, '2016-12-26 14:29:29'),
(21, 81, 0, 26, 47, 0, 1, '2016-12-30 18:17:51'),
(22, 81, 0, 27, 47, 0, 1, '2016-12-31 10:57:58'),
(23, 81, 0, 28, 47, 0, 1, '2016-12-31 15:35:50'),
(24, 81, 0, 29, 47, 0, 1, '2016-12-31 15:35:50'),
(25, 81, 0, 30, 47, 0, 1, '2016-12-31 15:47:51'),
(26, 81, 0, 31, 47, 0, 1, '2017-01-01 11:41:23'),
(27, 81, 0, 32, 47, 0, 1, '2017-01-01 11:52:54'),
(28, 81, 0, 33, 47, 0, 1, '2017-01-01 11:56:33'),
(29, 81, 0, 34, 47, 0, 1, '2017-01-06 15:43:00'),
(30, 81, 0, 35, 47, 0, 1, '2017-01-08 17:30:54'),
(31, 88, 0, 36, 47, 0, 1, '2017-01-09 15:22:21'),
(32, 81, 0, 37, 47, 0, 1, '2017-01-12 14:31:34'),
(33, 81, 0, 38, 47, 0, 1, '2017-01-13 13:37:17'),
(34, 81, 0, 39, 47, 0, 1, '2017-01-13 13:53:09'),
(35, 81, 0, 40, 47, 0, 1, '2017-01-15 13:28:27'),
(36, 81, 0, 41, 47, 0, 1, '2017-01-15 13:37:06'),
(37, 81, 0, 42, 47, 0, 1, '2017-01-15 13:42:43'),
(38, 81, 0, 43, 47, 0, 1, '2017-01-15 13:59:38'),
(39, 81, 0, 44, 47, 0, 1, '2017-01-17 16:45:51'),
(40, 81, 0, 45, 47, 0, 1, '2017-01-17 18:03:43'),
(41, 81, 0, 46, 47, 0, 1, '2017-01-17 18:13:46'),
(42, 81, 0, 47, 47, 0, 1, '2017-01-21 14:05:39'),
(43, 81, 0, 48, 47, 0, 1, '2017-01-21 14:09:06'),
(44, 81, 0, 49, 47, 0, 1, '2017-01-22 11:51:27'),
(45, 81, 0, 50, 47, 0, 1, '2017-01-23 11:53:34'),
(46, 81, 0, 51, 47, 0, 1, '2017-01-23 17:34:45'),
(47, 81, 0, 52, 47, 0, 1, '2017-01-23 17:40:37'),
(48, 81, 0, 53, 47, 0, 1, '2017-01-23 17:54:21'),
(49, 81, 0, 54, 47, 0, 1, '2017-01-27 17:02:06'),
(50, 81, 0, 55, 47, 0, 1, '2017-01-27 17:26:32'),
(51, 81, 0, 56, 47, 0, 1, '2017-01-27 18:14:37'),
(52, 81, 0, 57, 47, 0, 1, '2017-01-27 18:30:06'),
(53, 81, 0, 58, 47, 0, 1, '2017-01-29 18:29:36'),
(54, 81, 0, 59, 47, 0, 1, '2017-01-29 18:33:44'),
(55, 81, 0, 60, 47, 0, 1, '2017-01-31 17:46:25'),
(56, 81, 0, 61, 47, 0, 1, '2017-02-02 15:03:19'),
(57, 81, 0, 62, 47, 0, 1, '2017-02-02 15:07:45'),
(58, 81, 0, 63, 47, 0, 1, '2017-02-02 15:12:24'),
(59, 81, 0, 64, 47, 0, 1, '2017-02-03 16:52:14'),
(60, 81, 0, 65, 47, 0, 1, '2017-02-05 12:46:50'),
(61, 81, 0, 66, 47, 0, 1, '2017-02-05 13:01:27'),
(62, 81, 0, 67, 47, 0, 1, '2017-02-05 14:20:59'),
(63, 81, 0, 68, 47, 0, 1, '2017-02-05 14:23:03'),
(64, 81, 0, 69, 47, 0, 1, '2017-02-05 14:44:39'),
(65, 81, 0, 70, 47, 0, 1, '2017-02-05 15:41:46'),
(66, 81, 0, 71, 47, 0, 1, '2017-02-06 12:18:48'),
(67, 81, 0, 72, 47, 0, 0, '2017-02-06 14:24:58'),
(68, 86, 0, 73, 47, 0, 1, '2017-02-09 15:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachment_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_attachment_rel` (
  `ticket_attachment_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_attachment_rel`
--

INSERT INTO `ticket_attachment_rel` (`ticket_attachment_id`, `ticket_id`, `attachment_id`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 2, 0),
(4, 3, 0),
(5, 4, 0),
(6, 5, 0),
(7, 6, 0),
(8, 7, 0),
(9, 8, 0),
(10, 9, 0),
(11, 10, 0),
(12, 11, 0),
(13, 12, 0),
(14, 13, 0),
(15, 14, 0),
(16, 15, 0),
(17, 16, 0),
(18, 17, 0),
(19, 18, 0),
(20, 19, 0),
(21, 20, 0),
(22, 21, 0),
(23, 22, 0),
(24, 23, 0),
(25, 24, 0),
(26, 25, 0),
(27, 26, 0),
(28, 27, 0),
(29, 28, 0),
(30, 29, 0),
(31, 30, 0),
(32, 31, 0),
(33, 32, 0),
(34, 33, 0),
(35, 34, 0),
(36, 35, 0),
(37, 36, 0),
(38, 37, 0),
(39, 38, 0),
(40, 39, 0),
(41, 40, 0),
(42, 41, 0),
(43, 42, 0),
(44, 43, 0),
(45, 44, 0),
(46, 45, 0),
(47, 46, 0),
(48, 47, 0),
(49, 48, 0),
(50, 49, 0),
(51, 50, 0),
(52, 51, 0),
(53, 52, 0),
(54, 53, 0),
(55, 54, 0),
(56, 55, 0),
(57, 56, 0),
(58, 57, 0),
(59, 58, 0),
(60, 59, 0),
(61, 60, 0),
(62, 61, 0),
(63, 62, 0),
(64, 63, 0),
(65, 64, 0),
(66, 65, 0),
(67, 66, 0),
(68, 67, 0),
(69, 68, 0),
(70, 69, 0),
(71, 70, 0),
(72, 71, 0),
(73, 72, 0),
(74, 73, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_cc`
--

CREATE TABLE IF NOT EXISTS `ticket_cc` (
  `ticket_cc_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_cc_email` varchar(200) NOT NULL,
  `ticket_cc_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comment_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_comment_rel` (
  `ticket_comment_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `comment_type` varchar(20) NOT NULL DEFAULT 'public'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_comment_rel`
--

INSERT INTO `ticket_comment_rel` (`ticket_comment_id`, `comment_id`, `ticket_id`, `comment_type`) VALUES
(1, 71, 1, 'public'),
(2, 73, 1, 'appointment'),
(3, 74, 1, 'appointment'),
(4, 75, 1, 'appointment');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_group_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_group_rel` (
  `ticket_group_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `ticket_group_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_history`
--

CREATE TABLE IF NOT EXISTS `ticket_history` (
  `ticket_history_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_updated_by` int(11) NOT NULL,
  `ticket_history_status` enum('Open','Pending','Solved','Doing','Closed') NOT NULL,
  `ticket_history_created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_history`
--

INSERT INTO `ticket_history` (`ticket_history_id`, `ticket_id`, `ticket_updated_by`, `ticket_history_status`, `ticket_history_created_at`) VALUES
(1, 1, 1, 'Doing', '2016-04-01 09:50:21'),
(2, 1, 1, 'Solved', '2016-04-01 11:07:04'),
(3, 3, 47, 'Doing', '2016-11-05 11:40:59'),
(4, 3, 47, 'Solved', '2016-11-05 11:41:20'),
(5, 3, 47, 'Doing', '2016-11-19 10:48:16'),
(6, 3, 47, 'Solved', '2016-11-19 10:48:28'),
(7, 4, 47, 'Open', '2016-11-19 11:03:54'),
(8, 4, 47, 'Solved', '2016-11-19 11:06:30'),
(9, 4, 47, 'Solved', '2016-11-21 18:16:47'),
(10, 5, 47, 'Open', '2016-11-22 11:54:02'),
(11, 5, 47, 'Doing', '2016-11-22 11:54:59'),
(12, 5, 47, 'Doing', '2016-11-22 11:55:19'),
(13, 5, 47, 'Doing', '2016-11-22 11:57:35'),
(14, 6, 47, 'Open', '2016-11-22 12:15:29'),
(15, 5, 47, 'Solved', '2016-11-22 12:16:38'),
(16, 6, 47, 'Doing', '2016-11-22 12:16:50'),
(17, 6, 47, 'Solved', '2016-11-22 12:17:05'),
(18, 1, 47, 'Solved', '2016-11-22 12:51:42'),
(19, 1, 47, 'Open', '2016-11-22 12:51:55'),
(20, 7, 47, 'Open', '2016-11-24 11:28:19'),
(21, 7, 47, 'Open', '2016-11-24 11:31:07'),
(22, 7, 47, 'Doing', '2016-11-24 11:34:09'),
(23, 7, 47, 'Solved', '2016-11-24 11:34:34'),
(24, 8, 47, 'Open', '2016-11-24 12:09:36'),
(25, 8, 47, 'Solved', '2016-11-24 12:10:01'),
(26, 9, 47, 'Doing', '2016-11-26 09:31:28'),
(27, 10, 47, 'Open', '2016-11-27 08:56:33'),
(28, 10, 47, 'Doing', '2016-11-27 09:52:32'),
(29, 11, 47, 'Open', '2016-11-27 10:32:47'),
(30, 11, 47, 'Doing', '2016-11-27 10:33:02'),
(31, 11, 47, 'Solved', '2016-11-27 11:36:57'),
(32, 10, 47, 'Solved', '2016-11-27 11:37:59'),
(33, 9, 47, 'Open', '2016-11-27 12:34:04'),
(34, 3, 47, 'Doing', '2016-11-27 12:37:33'),
(35, 3, 47, 'Open', '2016-11-28 07:07:55'),
(36, 12, 47, 'Open', '2016-11-30 07:16:35'),
(37, 12, 47, 'Doing', '2016-11-30 07:16:53'),
(38, 12, 47, 'Solved', '2016-11-30 07:57:31'),
(39, 13, 47, 'Open', '2016-12-02 06:36:50'),
(40, 13, 47, 'Doing', '2016-12-02 06:40:33'),
(41, 14, 47, 'Open', '2016-12-02 08:14:15'),
(42, 13, 47, 'Open', '2016-12-02 14:28:51'),
(43, 13, 47, 'Doing', '2016-12-06 12:57:11'),
(44, 13, 47, 'Open', '2016-12-06 12:57:23'),
(45, 13, 47, 'Doing', '2016-12-06 12:57:26'),
(46, 13, 47, 'Solved', '2016-12-06 12:57:41'),
(47, 13, 47, 'Doing', '2016-12-06 12:57:43'),
(48, 13, 47, 'Solved', '2016-12-06 12:57:50'),
(49, 4, 47, 'Open', '2016-12-09 14:14:31'),
(50, 4, 47, 'Solved', '2016-12-09 14:14:35'),
(51, 16, 47, 'Open', '2016-12-09 15:57:37'),
(52, 17, 47, 'Open', '2016-12-12 14:07:53'),
(53, 17, 47, 'Doing', '2016-12-12 14:09:57'),
(54, 17, 47, 'Solved', '2016-12-12 15:40:46'),
(55, 18, 47, 'Open', '2016-12-13 11:43:22'),
(56, 18, 47, 'Doing', '2016-12-13 11:48:26'),
(57, 16, 47, 'Doing', '2016-12-13 13:56:24'),
(58, 16, 47, 'Solved', '2016-12-13 13:56:37'),
(59, 15, 47, 'Doing', '2016-12-14 11:11:23'),
(60, 15, 47, 'Solved', '2016-12-14 11:13:11'),
(61, 19, 47, 'Open', '2016-12-15 17:42:05'),
(62, 20, 47, 'Open', '2016-12-16 11:11:43'),
(63, 18, 47, 'Solved', '2016-12-16 11:15:43'),
(64, 21, 47, 'Open', '2016-12-17 12:05:38'),
(65, 22, 47, 'Open', '2016-12-17 12:45:23'),
(66, 23, 47, 'Open', '2016-12-18 11:39:55'),
(67, 23, 47, 'Doing', '2016-12-18 11:40:24'),
(68, 22, 47, 'Doing', '2016-12-18 11:40:38'),
(69, 24, 47, 'Open', '2016-12-18 11:53:43'),
(70, 24, 47, 'Doing', '2016-12-18 11:54:02'),
(71, 23, 47, 'Solved', '2016-12-20 17:52:50'),
(72, 25, 47, 'Open', '2016-12-26 14:29:29'),
(73, 25, 47, 'Doing', '2016-12-26 14:29:54'),
(74, 25, 47, 'Solved', '2016-12-26 14:29:58'),
(75, 26, 47, 'Open', '2016-12-30 18:17:51'),
(76, 26, 47, 'Doing', '2016-12-30 18:18:09'),
(77, 26, 47, 'Solved', '2016-12-30 18:18:47'),
(78, 27, 47, 'Open', '2016-12-31 10:57:58'),
(79, 27, 47, 'Doing', '2016-12-31 10:58:20'),
(80, 27, 47, 'Solved', '2016-12-31 15:28:56'),
(81, 28, 47, 'Open', '2016-12-31 15:35:50'),
(82, 29, 47, 'Open', '2016-12-31 15:35:50'),
(83, 28, 47, 'Doing', '2016-12-31 15:36:13'),
(84, 30, 47, 'Open', '2016-12-31 15:47:51'),
(85, 29, 47, 'Doing', '2016-12-31 15:48:14'),
(86, 31, 47, 'Open', '2017-01-01 11:41:23'),
(87, 31, 47, 'Doing', '2017-01-01 11:41:43'),
(88, 31, 47, 'Open', '2017-01-01 11:41:58'),
(89, 32, 47, 'Open', '2017-01-01 11:52:54'),
(90, 33, 47, 'Open', '2017-01-01 11:56:33'),
(91, 33, 47, 'Doing', '2017-01-01 11:56:57'),
(92, 1, 47, 'Solved', '2017-01-01 19:48:00'),
(93, 30, 47, 'Doing', '2017-01-02 16:18:19'),
(94, 31, 47, 'Doing', '2017-01-02 17:30:37'),
(95, 31, 47, 'Solved', '2017-01-02 17:30:57'),
(96, 1, 47, 'Open', '2017-01-02 23:27:12'),
(97, 1, 47, 'Open', '2017-01-02 23:28:40'),
(98, 1, 47, 'Solved', '2017-01-02 23:30:21'),
(99, 28, 47, 'Solved', '2017-01-03 11:41:04'),
(100, 24, 47, 'Solved', '2017-01-03 11:41:18'),
(101, 29, 47, 'Solved', '2017-01-03 11:42:25'),
(102, 24, 47, 'Doing', '2017-01-03 11:49:39'),
(103, 24, 47, 'Open', '2017-01-03 11:49:46'),
(104, 33, 47, 'Solved', '2017-01-03 13:54:42'),
(105, 30, 47, 'Solved', '2017-01-03 15:23:01'),
(106, 22, 47, 'Solved', '2017-01-03 15:23:36'),
(107, 34, 47, 'Open', '2017-01-06 15:43:00'),
(108, 32, 47, 'Doing', '2017-01-06 15:43:26'),
(109, 32, 47, 'Open', '2017-01-06 15:43:36'),
(110, 24, 47, 'Doing', '2017-01-06 15:43:41'),
(111, 24, 47, 'Open', '2017-01-06 15:43:50'),
(112, 34, 47, 'Doing', '2017-01-06 15:43:56'),
(113, 34, 47, 'Solved', '2017-01-08 12:55:21'),
(114, 35, 47, 'Open', '2017-01-08 17:30:54'),
(115, 32, 47, 'Doing', '2017-01-09 14:20:55'),
(116, 32, 47, 'Open', '2017-01-09 14:21:10'),
(117, 35, 47, 'Doing', '2017-01-09 14:21:16'),
(118, 36, 47, 'Open', '2017-01-09 15:22:22'),
(119, 36, 47, 'Doing', '2017-01-09 15:22:46'),
(120, 36, 47, 'Solved', '2017-01-09 15:22:55'),
(121, 35, 47, 'Solved', '2017-01-09 18:22:50'),
(122, 37, 47, 'Open', '2017-01-12 14:31:34'),
(123, 37, 47, 'Doing', '2017-01-12 14:31:49'),
(124, 37, 47, 'Solved', '2017-01-12 14:31:55'),
(125, 38, 47, 'Open', '2017-01-13 13:37:17'),
(126, 39, 47, 'Open', '2017-01-13 13:53:09'),
(127, 39, 47, 'Doing', '2017-01-13 13:53:21'),
(128, 39, 47, 'Solved', '2017-01-13 13:53:25'),
(129, 40, 47, 'Open', '2017-01-15 13:28:27'),
(130, 40, 47, 'Doing', '2017-01-15 13:28:56'),
(131, 41, 47, 'Open', '2017-01-15 13:37:06'),
(132, 41, 47, 'Doing', '2017-01-15 13:37:17'),
(133, 42, 47, 'Open', '2017-01-15 13:42:43'),
(134, 38, 47, 'Doing', '2017-01-15 13:42:55'),
(135, 38, 47, 'Open', '2017-01-15 13:42:58'),
(136, 42, 47, 'Doing', '2017-01-15 13:43:05'),
(137, 43, 47, 'Open', '2017-01-15 13:59:38'),
(138, 43, 47, 'Doing', '2017-01-15 13:59:53'),
(139, 42, 47, 'Solved', '2017-01-15 14:05:57'),
(140, 40, 47, 'Solved', '2017-01-17 15:01:34'),
(141, 41, 47, 'Solved', '2017-01-17 15:02:16'),
(142, 44, 47, 'Open', '2017-01-17 16:45:51'),
(143, 44, 47, 'Doing', '2017-01-17 16:46:08'),
(144, 44, 47, 'Open', '2017-01-17 17:14:21'),
(145, 45, 47, 'Open', '2017-01-17 18:03:43'),
(146, 45, 47, 'Doing', '2017-01-17 18:04:03'),
(147, 45, 47, 'Solved', '2017-01-17 18:04:09'),
(148, 46, 47, 'Open', '2017-01-17 18:13:46'),
(149, 46, 47, 'Doing', '2017-01-17 18:14:03'),
(150, 46, 47, 'Solved', '2017-01-17 18:14:06'),
(151, 47, 47, 'Open', '2017-01-21 14:05:39'),
(152, 47, 47, 'Doing', '2017-01-21 14:05:57'),
(153, 47, 47, 'Solved', '2017-01-21 14:06:02'),
(154, 48, 47, 'Open', '2017-01-21 14:09:06'),
(155, 48, 47, 'Doing', '2017-01-21 14:09:18'),
(156, 48, 47, 'Solved', '2017-01-21 14:09:22'),
(157, 43, 47, 'Open', '2017-01-21 14:09:37'),
(158, 49, 47, 'Open', '2017-01-22 11:51:27'),
(159, 49, 47, 'Doing', '2017-01-22 11:51:49'),
(160, 49, 47, 'Solved', '2017-01-22 11:52:04'),
(161, 50, 47, 'Open', '2017-01-23 11:53:34'),
(162, 50, 47, 'Doing', '2017-01-23 11:53:50'),
(163, 50, 47, 'Solved', '2017-01-23 11:53:53'),
(164, 51, 47, 'Open', '2017-01-23 17:34:45'),
(165, 51, 47, 'Doing', '2017-01-23 17:35:08'),
(166, 52, 47, 'Open', '2017-01-23 17:40:37'),
(167, 52, 47, 'Doing', '2017-01-23 17:41:07'),
(168, 52, 47, 'Solved', '2017-01-23 17:41:10'),
(169, 53, 47, 'Open', '2017-01-23 17:54:21'),
(170, 53, 47, 'Doing', '2017-01-23 17:54:32'),
(171, 53, 47, 'Solved', '2017-01-23 17:54:40'),
(172, 51, 47, 'Solved', '2017-01-25 16:33:47'),
(173, 53, 47, 'Doing', '2017-01-25 16:34:40'),
(174, 54, 47, 'Open', '2017-01-27 17:02:06'),
(175, 54, 47, 'Doing', '2017-01-27 17:02:16'),
(176, 55, 47, 'Open', '2017-01-27 17:26:32'),
(177, 56, 47, 'Open', '2017-01-27 18:14:37'),
(178, 56, 47, 'Doing', '2017-01-27 18:14:48'),
(179, 57, 47, 'Open', '2017-01-27 18:30:06'),
(180, 57, 47, 'Doing', '2017-01-27 18:30:34'),
(181, 57, 47, 'Solved', '2017-01-28 13:34:18'),
(182, 57, 47, 'Doing', '2017-01-28 13:34:30'),
(183, 55, 47, 'Doing', '2017-01-28 13:35:34'),
(184, 55, 47, 'Solved', '2017-01-28 13:35:41'),
(185, 57, 47, 'Open', '2017-01-28 13:40:35'),
(186, 58, 47, 'Open', '2017-01-29 18:29:36'),
(187, 58, 47, 'Doing', '2017-01-29 18:29:51'),
(188, 58, 47, 'Solved', '2017-01-29 18:29:58'),
(189, 59, 47, 'Open', '2017-01-29 18:33:44'),
(190, 59, 47, 'Doing', '2017-01-29 18:34:35'),
(191, 59, 47, 'Solved', '2017-01-29 18:34:41'),
(192, 60, 47, 'Open', '2017-01-31 17:46:25'),
(193, 60, 47, 'Doing', '2017-01-31 17:46:51'),
(194, 60, 47, 'Solved', '2017-01-31 17:46:53'),
(195, 61, 47, 'Open', '2017-02-02 15:03:19'),
(196, 62, 47, 'Open', '2017-02-02 15:07:45'),
(197, 63, 47, 'Open', '2017-02-02 15:12:24'),
(198, 61, 47, 'Solved', '2017-02-02 15:12:55'),
(199, 62, 47, 'Solved', '2017-02-02 15:12:59'),
(200, 63, 47, 'Solved', '2017-02-02 15:13:03'),
(201, 64, 47, 'Open', '2017-02-03 16:52:14'),
(202, 64, 47, 'Doing', '2017-02-03 16:52:29'),
(203, 64, 47, 'Solved', '2017-02-03 16:52:33'),
(204, 65, 47, 'Open', '2017-02-05 12:46:50'),
(205, 64, 47, 'Doing', '2017-02-05 12:47:04'),
(206, 64, 47, 'Solved', '2017-02-05 12:47:23'),
(207, 64, 47, 'Doing', '2017-02-05 12:48:34'),
(208, 64, 47, 'Solved', '2017-02-05 12:48:38'),
(209, 53, 47, 'Solved', '2017-02-05 12:49:28'),
(210, 54, 47, 'Solved', '2017-02-05 12:49:39'),
(211, 56, 47, 'Solved', '2017-02-05 12:49:47'),
(212, 53, 47, 'Solved', '2017-02-05 12:51:12'),
(213, 54, 47, 'Solved', '2017-02-05 12:51:20'),
(214, 56, 47, 'Solved', '2017-02-05 12:51:23'),
(215, 1, 47, 'Open', '2017-02-05 12:57:02'),
(216, 4, 47, 'Open', '2017-02-05 12:57:06'),
(217, 65, 47, 'Doing', '2017-02-05 12:57:31'),
(218, 65, 47, 'Solved', '2017-02-05 12:57:42'),
(219, 66, 47, 'Open', '2017-02-05 13:01:27'),
(220, 67, 47, 'Open', '2017-02-05 14:20:59'),
(221, 67, 47, 'Doing', '2017-02-05 14:21:14'),
(222, 68, 47, 'Open', '2017-02-05 14:23:03'),
(223, 68, 47, 'Doing', '2017-02-05 14:23:16'),
(224, 69, 47, 'Open', '2017-02-05 14:44:39'),
(225, 69, 47, 'Doing', '2017-02-05 14:44:49'),
(226, 69, 47, 'Solved', '2017-02-05 14:44:54'),
(227, 70, 47, 'Open', '2017-02-05 15:41:46'),
(228, 70, 47, 'Doing', '2017-02-05 15:41:58'),
(229, 70, 47, 'Solved', '2017-02-05 15:42:02'),
(230, 71, 47, 'Open', '2017-02-06 12:18:48'),
(231, 9, 47, 'Open', '2017-02-06 12:27:19'),
(232, 71, 47, 'Doing', '2017-02-06 14:13:37'),
(233, 71, 47, 'Solved', '2017-02-06 14:13:40'),
(234, 71, 47, 'Doing', '2017-02-06 14:13:55'),
(235, 72, 47, 'Open', '2017-02-06 14:24:58'),
(236, 72, 47, 'Open', '2017-02-06 14:26:02'),
(237, 73, 47, 'Open', '2017-02-09 15:13:21'),
(238, 73, 47, 'Doing', '2017-02-09 15:13:34'),
(239, 73, 47, 'Solved', '2017-02-09 15:13:37'),
(240, 67, 47, 'Solved', '2017-02-09 15:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_tag`
--

CREATE TABLE IF NOT EXISTS `ticket_tag` (
  `tag_id` int(11) NOT NULL,
  `tag_heading` varchar(256) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `tag_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_tag_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_tag_rel` (
  `ticket_tag_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_tag_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `user_code` varchar(255) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_email` text NOT NULL,
  `user_mobile` bigint(20) NOT NULL,
  `user_phone` bigint(20) NOT NULL,
  `user_profile` varchar(254) NOT NULL,
  `user_status` int(11) NOT NULL,
  `user_note` text NOT NULL,
  `user_access_level` int(11) NOT NULL,
  `user_update` datetime NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `reference_by` int(11) NOT NULL,
  `document` text NOT NULL,
  `address1` varchar(1000) NOT NULL,
  `address2` varchar(1000) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_country` varchar(255) NOT NULL,
  `user_postcode` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `annivery` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_code`, `user_name`, `first_name`, `last_name`, `user_password`, `user_email`, `user_mobile`, `user_phone`, `user_profile`, `user_status`, `user_note`, `user_access_level`, `user_update`, `user_type`, `reference_by`, `document`, `address1`, `address2`, `user_city`, `user_country`, `user_postcode`, `dob`, `annivery`) VALUES
(47, 'ADM00000001', 'Vivek Yadav', 'Vivek ', 'Yadav', '103e3d5213d53891b020a9fdde50789e', 'admin@checknnchange.com', 9826036131, 9826036131, 'assets/img/user/userimage_092ad09.png', 1, 'dsdsa', 1, '2016-11-12 07:33:41', '0', 51, '', '543543', '', '54353', '5435', '5434534', '0000-00-00', '0000-00-00 00:00:00'),
(79, '', 'saba ', 'saba', '', '', '', 8770221002, 0, '', 0, '', 4, '2016-11-17 12:33:13', 'on call', 0, '', 'B-609 space park II block-B nipania Indore', '', '', '', '', NULL, NULL),
(80, '', 'Dharmendra Deora', 'Dharmendra', '', '', '', 9770348768, 0, '', 0, '', 4, '2016-11-17 12:54:50', 'on call', 0, '', '33/2 Biyabani indore', '', '', '', '', NULL, NULL),
(81, 'EMP19369207', 'vivek yadav', 'Vivek', 'Yadav', '8e421035705ebe79f9e881f46426a5ef', '', 9826036131, 9826036131, 'assets/img/employee/userimage_93dac39.jpg', 1, '', 3, '2016-11-21 07:54:13', '', 81, 'assets/attachment/employee/attachment_7e34cd4.jpg', '317 sanwarya nagar ', '', 'indore', 'india', '452006', NULL, NULL),
(82, '', 'Rohit Salvi', 'Rohit', '', '', '', 9009099200, 0, '', 0, '', 4, '2016-11-19 10:45:26', 'on call', 0, '', '12/1 sukhdev nagar indore ', '', '', '', '', NULL, NULL),
(83, 'CUS27185573', 'KK  Yadav', 'K K ', 'Yadav', '827ccb0eea8a706c4c34a16891f84e7b', '', 7611112347, 0, '', 0, 'he want to regular sevice also ', 4, '2016-11-19 10:57:05', 'regular', 0, '', '442/6 nehru nagar ', 'road no 6', 'indore', 'india', '452002', '1960-05-12', '1985-04-29 00:00:00'),
(84, '', 'NIDHI PANDIT', 'NIDHI', '', '', '', 907458000, 0, '', 1, '', 4, '2016-11-22 11:47:09', 'on call', 81, '', 'B-214 SPACE PARK PHASE1', '', '', '', '', NULL, NULL),
(85, '', 'GIRISH SHARMA', 'GIRISH', '', '', '', 9755011227, 0, '', 1, '', 4, '2016-11-22 12:08:21', 'on call', 0, '', 'HOUSE NO. 152/202, MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(86, 'EMP78876080', 'VINITA YADAV', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '', 9589298203, 9589298203, 'assets/img/employee/userimage_163e27d.jpg', 1, 'NEHA YADAV (BELMONT PARK)', 3, '2016-11-23 05:55:47', '', 0, 'assets/attachment/employee/attachment_b5e79f2.jpg', '21/1 MALVIYA NAGAR', 'NEAR C-21 MALL ', 'INDORE', 'INDIA', '452010', NULL, NULL),
(87, 'EMP04761093', 'K.K. YADAV', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '', 9827210151, 9827210151, 'assets/img/employee/userimage_9e30d44.JPG', 1, 'COMPANY FUFAJI', 3, '2017-01-08 13:55:16', '', 0, 'assets/attachment/employee/attachment_336de37.jpg', '442/6, NEHRU NAGAR ', '', 'INDORE (M.P.)', 'INDORE', '452001', NULL, NULL),
(88, 'EMP13696944', 'ISWAR RATHI', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '', 9826707732, 9826707732, 'assets/img/employee/userimage_f000961.jpg', 1, 'REF BY VINITA YADAV NEHA SIS IN LAW ', 3, '2017-01-08 13:52:09', '', 0, 'assets/attachment/employee/attachment_d1c7fb7.jpg', '86 VAKRATUND NAGAR ', 'RING ROAD KHAJRANA', 'INDORE', 'INDIA', '452010', NULL, NULL),
(89, '', 'AMIT CHOUHAN ', 'AMIT', '', '', '', 8962355194, 0, '', 1, '', 4, '2016-11-24 11:21:45', 'on call', 0, '', 'HOUSE NO. A/8, MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(90, '', 'RAHUL THAKKER', 'RAHUL', '', '', '', 9425300935, 0, '', 1, '', 4, '2016-11-26 09:27:04', 'on call', 0, '', 'BLOCK A, 123 NARIMAN POINT ', '', '', '', '', NULL, NULL),
(91, '', 'JAI SINGHANIA', 'JAI', '', '', '', 9644408280, 0, '', 1, '', 4, '2016-11-27 08:36:51', 'on call', 0, '', 'FLAT, 202 EKTA APPT. VEENA NAGAR', '', '', '', '', NULL, NULL),
(100, '', 'MANOJ JI', 'MANOJ', '', '', '', 8120322224, 0, '', 1, '', 4, '2016-11-27 09:55:38', 'on call', 0, '', '42 MR-5 MAHA LAXMI NAGAR', '', '', '', '', NULL, NULL),
(101, 'SS55184476', 'VIPIN  / KANTESH GUPTA', 'VIPIN  /', 'KANTESH GUPTA', '827ccb0eea8a706c4c34a16891f84e7b', '', 8878433888, 9826443535, 'assets/img/user/userimage_4614658.jpg', 1, 'SERVICE TEX NOT INCLUDED ', 4, '2016-11-28 07:41:39', 'premium', 81, '', '95A, MANGAL MURTI NAGAR', 'BANGALI SQ. BSNL KE PICHE', 'INDORE', 'M.P', '452010', '2020-12-20', '2020-11-20 00:00:00'),
(110, '', 'MISS HEMNANI JI  ', 'MISS', '', '', '', 9826912216, 0, '', 1, '', 4, '2016-11-30 06:28:48', 'on call', 0, '', '433, MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(114, 'EMP43968214', 'PREM SUNMORIYA', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '', 8225040364, 8225040364, 'assets/img/employee/userimage_23ad487.jpg', 0, 'SATISH JOSHI JI ER.BCM GROUP', 3, '2017-02-04 15:15:54', '', 0, 'assets/attachment/employee/attachment_42aec1d.jpg', '13/4 SHANTI NIKETAN COLONY ', 'AB BY PASS  ', 'INDORE', 'INDIA', '452006', NULL, NULL),
(117, '', 'PRAMTHESH JAIN', 'PRAMTHESH', '', '', '', 8224007149, 0, '', 1, '', 4, '2016-12-02 06:35:28', 'on call', 0, '', 'B-203, SPACE PARK', '', '', '', '', NULL, NULL),
(122, '', 'Dharmedra test', 'Dharmedra', '', '', '', 9770348768, 0, '', 1, '', 4, '2016-12-02 08:10:38', 'on call', 0, '', '12/1 sukhdev nagar indore', '', '', '', '', NULL, NULL),
(123, '', 'K C Sharma', 'K', '', '', '', 9907070966, 0, '', 1, '', 4, '2016-12-02 08:30:21', 'on call', 0, '', 'A sector Basant Vihar behind bombay hospital', '', '', '', '', NULL, NULL),
(124, '', 'SUNIL AJMERA', 'SUNIL', '', '', '', 9425081018, 0, '', 1, '', 4, '2016-12-09 15:52:54', 'on call', 0, '', 'SCHEME NO, 71-32K1 NEAR CHOUDHARY .DUDH DAHI BHANDAR', '', '', '', '', NULL, NULL),
(125, '', 'PRAVINA VYAS', 'PRAVINA', '', '', '', 9993111997, 0, '', 1, '', 4, '2016-12-12 13:13:39', 'on call', 0, '', 'SHEKHAR REGENCY-105, 1 SECTOR KANADIYA SQ..', '', '', '', '', NULL, NULL),
(126, '', 'SHALENI ROUTE', 'SHALENI', '', '', '', 9111012379, 0, '', 1, '', 4, '2016-12-13 11:36:17', 'on call', 0, '', 'BCM HIGHTS -A,606', '', '', '', '', NULL, NULL),
(127, '', 'SHALENI RAUTE', 'SHALENI', '', '', '', 9111012379, 0, '', 1, '', 4, '2016-12-13 11:54:31', 'on call', 0, '', 'BCM HIGHTS -A,606', '', '', '', '', NULL, NULL),
(128, '', 'KAPIL BHALTED', 'KAPIL', '', '', '', 9323657249, 0, '', 1, '', 4, '2016-12-16 11:10:16', 'on call', 0, '', 'SAMAR PARK NIPANIA', '', '', '', '', NULL, NULL),
(129, '', 'ASHOK SHARMA', 'ASHOK', '', '', '', 9826078991, 0, '', 1, '', 4, '2016-12-17 12:05:28', 'on call', 0, '', '370,MR-5 MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(130, '', 'PRNAY GUPTA', 'PRNAY', '', '', '', 9826505547, 0, '', 1, '', 4, '2016-12-17 12:45:18', 'on call', 0, '', '51-A MANGAL NAGAR', '', '', '', '', NULL, NULL),
(131, '', 'VINOD GUPTA', 'VINOD', '', '', '', 8602809770, 0, '', 1, '', 4, '2016-12-18 11:39:50', 'on call', 0, '', '203, SWASTIK REVERA 6-7 VEENA NAGAR', '', '', '', '', NULL, NULL),
(132, '', 'KAPIL BHALTED', 'KAPIL', '', '', '', 9323657249, 0, '', 1, '', 4, '2016-12-18 11:53:39', 'on call', 0, '', 'SAMAR PARK NIPANIA 114-A', '', '', '', '', NULL, NULL),
(133, '', 'AJIT JI', 'AJIT', '', '', '', 9826061259, 0, '', 1, '', 4, '2016-12-26 14:29:23', 'on call', 0, '', 'HOUSE NO. 419-SUNCITY', '', '', '', '', NULL, NULL),
(134, '', 'AKANKSHA', 'AKANKSHA', '', '', '', 7746069990, 0, '', 1, '', 4, '2016-12-30 18:17:48', 'on call', 0, '', 'HO.NO. 366-MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(135, '', 'S.K. JAISWAL', 'S.K.', '', '', '', 731, 0, '', 1, '', 4, '2016-12-31 10:57:55', 'on call', 0, '', '210, SAIKRIPA COLONY', '', '', '', '', NULL, NULL),
(136, '', 'RAHUL HIRWE', 'RAHUL', '', '', '', 9979748968, 0, '', 1, '', 4, '2016-12-31 15:35:46', 'on call', 0, '', 'HO. NO. 30- SUNCITY', '', '', '', '', NULL, NULL),
(137, '', 'SHASHANK SHARMA', 'SHASHANK', '', '', '', 9981111336, 0, '', 1, '', 4, '2016-12-31 15:47:49', 'on call', 0, '', 'VILLA NO. 736- OMEX CITY', '', '', '', '', NULL, NULL),
(138, '', 'BHARADIYA JI', 'BHARADIYA', '', '', '', 9893248100, 0, '', 1, '', 4, '2017-01-01 11:41:20', 'on call', 0, '', ' HO. NO. DH-194  ', '', '', '', '', NULL, NULL),
(139, '', 'SHUBHANGI JI', 'SHUBHANGI', '', '', '', 7314090604, 0, '', 1, '', 4, '2017-01-06 15:42:57', 'on call', 0, '', 'HO.NO. 104,MR-4 MAHALAXMI NAGAR ', '', '', '', '', NULL, NULL),
(140, '', 'DIPTI MEM', 'DIPTI', '', '', '', 9301026260, 0, '', 1, '', 4, '2017-01-08 17:30:46', 'on call', 0, '', 'KOTHARI HOUSE SCHEME NO, 54 (NEAR SHUBHAM JEWELERS) ', '', '', '', '', NULL, NULL),
(141, '', 'RAJENDRA JI', 'RAJENDRA', '', '', '', 9826039927, 0, '', 1, '', 4, '2017-01-09 15:22:17', 'on call', 0, '', 'HOUSE NO. 492,R-SECTOR MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(142, '', 'HARDYE PATLEY', 'HARDYE', '', '', '', 8889774460, 0, '', 1, '', 4, '2017-01-12 14:31:29', 'on call', 0, '', 'HO.NO. 115, TIRUPATI PALACE', '', '', '', '', NULL, NULL),
(143, '', 'MOHIT TIWARI', 'MOHIT', '', '', '', 8223800122, 0, '', 1, '', 4, '2017-01-13 13:35:20', 'on call', 0, '', '33,BF, SCHEME NO. 54 NEAR SICA SCHOOL OLIVE QUEEN', '', '', '', '', NULL, NULL),
(144, '', 'ANIL MODI JI', 'ANIL', '', '', '', 9425081696, 0, '', 1, '', 4, '2017-01-13 13:53:05', 'on call', 0, '', 'MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(145, '', 'ARCHNA SHARMA', 'ARCHNA', '', '', '', 9770014250, 0, '', 1, '', 4, '2017-01-14 18:30:48', 'on call', 0, '', 'R-6 44, MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(146, '', 'P.P. SHARMA', 'P.P.', '', '', '', 9584625982, 0, '', 1, '', 4, '2017-01-15 13:28:24', 'on call', 0, '', '107,BLOCK-C PHACE 1 SPACE PARK', '', '', '', '', NULL, NULL),
(147, '', 'MUKESH BHALSE', 'MUKESH', '', '', '', 8085563529, 0, '', 1, '', 4, '2017-01-15 13:35:11', 'on call', 0, '', 'FLAT NO. 324,BLOCK-A NARIMAN POINT', '', '', '', '', NULL, NULL),
(148, '', 'SHUBHANGI JI', 'SHUBHANGI', '', '', '', 9713339778, 0, '', 1, '', 4, '2017-01-15 13:42:41', 'on call', 0, '', 'HO.NO. 104,MR-4 MAHALAXMI NAGAR ', '', '', '', '', NULL, NULL),
(149, '', 'SUNIL THAKUR', 'SUNIL', '', '', '', 7869922103, 0, '', 1, '', 4, '2017-01-15 13:59:35', 'on call', 0, '', 'G-608, NARIMAN POINT', '', '', '', '', NULL, NULL),
(150, '', 'BRAJESH UPADHYAY', 'BRAJESH', '', '', '', 9644324938, 0, '', 1, '', 4, '2017-01-17 16:45:47', 'on call', 0, '', '361,ALOK NAGAR NEAR SHUSH LABH  RESIDENCY ', '', '', '', '', NULL, NULL),
(151, '', 'ARVIND JI', 'ARVIND', '', '', '', 9826896599, 0, '', 1, '', 4, '2017-01-17 18:03:38', 'on call', 0, '', '24, SHIMLA PARK (NEAR APOLLO DB CITY)', '', '', '', '', NULL, NULL),
(152, '', 'YASHENDRA JI', 'YASHENDRA', '', '', '', 9826103548, 0, '', 1, '', 4, '2017-01-17 18:13:42', 'on call', 0, '', 'BUSINESS ISLAND NIPANIA ROAD', '', '', '', '', NULL, NULL),
(153, 'NJ05234819', 'NEELIMA W/O PANKAJ JAIN', 'NEELIMA W/O PANKAJ', 'JAIN', '827ccb0eea8a706c4c34a16891f84e7b', 'TASHUJAIN95@GMAIL.COM', 9826011828, 9981558999, '', 1, 'WITH MATERIAL. EVERY MONTH TDS TEST. WITHOUT SERVICES TAX.', 4, '2017-01-19 15:16:50', 'premium', 88, '', 'SPACE PARK, PHASE-1 A,704  MAHALAXMI NAGAR  ', '', 'INDORE', 'M.P ', '452010', '2020-01-20', '2020-01-20 00:00:00'),
(154, '', 'RAHUL JI', 'RAHUL', '', '', '', 7772871341, 0, '', 1, '', 4, '2017-01-21 14:05:36', 'on call', 0, '', '102, AMAN ELITE ', '', '', '', '', NULL, NULL),
(155, '', 'H.N JAIN', 'H.N', '', '', '', 9893151015, 0, '', 1, '', 4, '2017-01-21 14:09:02', 'on call', 0, '', '517-A, SECTOR MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(156, '', 'MOHIT JI', 'MOHIT', '', '', '', 8288014555, 0, '', 1, '', 4, '2017-01-22 11:51:24', 'on call', 0, '', 'HO.NO. 4, TULSIYANA RESIDENCY', '', '', '', '', NULL, NULL),
(157, '', 'HIMANSHU JI', 'HIMANSHU', '', '', '', 7770851143, 0, '', 1, '', 4, '2017-01-23 11:53:29', 'on call', 0, '', '427-A SECTOR SHARAD PURNIMA MALTI   ', '', '', '', '', NULL, NULL),
(158, '', 'DATTA JI', 'DATTA', '', '', '', 9993669232, 0, '', 1, '', 4, '2017-01-23 17:34:41', 'on call', 0, '', '499-A TULSI NAGAR', '', '', '', '', NULL, NULL),
(159, '', 'PRASHANT TIWARI', 'PRASHANT', '', '', '', 8374711164, 0, '', 1, '', 4, '2017-01-23 17:40:34', 'on call', 0, '', '202, TULSIYANA HEIGHTS', '', '', '', '', NULL, NULL),
(160, '', 'KUNAL JI', 'KUNAL', '', '', '', 93298787701, 0, '', 1, '', 4, '2017-01-23 17:54:19', 'on call', 0, '', '426-A BLOCK NARIMAN POINT', '', '', '', '', NULL, NULL),
(161, '', 'SOMESH JI', 'SOMESH', '', '', '', 7314247387, 0, '', 1, '', 4, '2017-01-27 17:02:03', 'on call', 0, '', '60, SUNCITY', '', '', '', '', NULL, NULL),
(162, '', 'SOMESH JI', 'SOMESH', '', '', '', 7314247387, 0, '', 0, '', 4, '2017-01-27 18:14:34', 'on call', 0, '', '60, SUNCITY', '', '', '', '', NULL, NULL),
(163, '', 'TARUN JI CHABRA', 'TARUN', '', '', '', 7389974736, 0, '', 1, '', 4, '2017-01-29 18:29:32', 'on call', 0, '', '102,HO. NO 204-A SECTOR MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(164, '', 'G.S. RATHORE', 'G.S.', '', '', '', 834990012, 0, '', 1, '', 4, '2017-01-29 18:33:33', 'on call', 0, '', '253- AMRIT PALACE', '', '', '', '', NULL, NULL),
(165, '', 'NAYDU SIR', 'NAYDU', '', '', '', 9826411165, 0, '', 1, '', 4, '2017-01-31 17:45:50', 'on call', 0, '', '178-R SECTOR MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(166, '', 'CHETAN NIROLE JI', 'CHETAN', '', '', '', 7000218231, 0, '', 1, '', 4, '2017-02-02 15:03:16', 'on call', 0, '', '110-SHUBH-SAMPADA COLONY', '', '', '', '', NULL, NULL),
(167, '', 'AJAY VARMA', 'AJAY', '', '', '', 8871139155, 0, '', 1, '', 4, '2017-02-02 15:07:40', 'on call', 0, '', '280-B, AMRIT PALACE NIPANIA (HARSHAL KIRANA STORE)', '', '', '', '', NULL, NULL),
(168, '', 'ARCHNA PATEL', 'ARCHNA', '', '', '', 9826927632, 0, '', 1, '', 4, '2017-02-02 15:12:21', 'on call', 0, '', '304-TULSIYANA HIGHTS (NEAR NAMRATA  GARDEN)', '', '', '', '', NULL, NULL),
(169, 'DD39835258', 'AMIT SINGH DAMOR', 'AMIT SINGH', 'DAMOR', '827ccb0eea8a706c4c34a16891f84e7b', 'AMITDAMOR15@GMAIL.COM', 9827570152, 9584223722, '', 1, 'PLUMBER SERVICES TAX OMITTED. HALF YEARLY AMOUNT @ 50% RECEIPTED.', 4, '2017-02-03 16:48:06', 'premium', 88, '', '50-A, MAHALAXMI NAGAR', '', 'INDORE', 'M.P.', '452010', '1992-04-13', '1992-04-13 00:00:00'),
(170, '', 'AKANKSHA', 'AKANKSHA', '', '', '', 7746069990, 0, '', 1, '', 4, '2017-02-03 16:52:08', 'on call', 0, '', '366- MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(171, 'EMP92859465', 'PREM NARAYAN PATIDAR', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '', 7580814912, 7580814912, '', 0, 'REFERENCE BY NEWS PAPER. (AGNI BAN)', 3, '2017-02-05 16:36:06', '', 0, '', '186-A, MAYUR NAGAR', 'MUSAKHEDI,INDORE', 'INDORE', 'M.P.', '452016', NULL, NULL),
(172, '', 'NISHAD KHAN', 'NISHAD', '', '', '', 731, 0, '', 1, '', 4, '2017-02-05 12:46:47', 'on call', 0, '', '503-BLOCK-5,VIJAY NAGAR', '', '', '', '', NULL, NULL),
(173, '', 'MUKESH SAHU', 'MUKESH', '', '', '', 8889545566, 0, '', 1, '', 4, '2017-02-05 13:01:24', 'on call', 0, '', '38-MR-5, MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(174, '', 'OM NATH JI VERMA  ', 'OM', '', '', '', 9302396789, 0, '', 1, '', 4, '2017-02-05 14:20:56', 'on call', 0, '', '535-GULAB BAG ', '', '', '', '', NULL, NULL),
(175, '', 'OM NATH JI VERMA  ', 'OM', '', '', '', 9302396789, 0, '', 1, '', 4, '2017-02-05 14:23:00', 'on call', 0, '', '535-GULAB BAG ', '', '', '', '', NULL, NULL),
(176, '', 'VIKRAM BHOSLE', 'VIKRAM', '', '', '', 731, 0, '', 1, '', 4, '2017-02-05 14:44:36', 'on call', 0, '', '28-B, ANKUR ANGAN ', '', '', '', '', NULL, NULL),
(177, '', 'KARANVEER SINGH', 'KARANVEER', '', '', '', 9977356052, 0, '', 1, '', 4, '2017-02-05 15:41:40', 'on call', 0, '', '870-R-SECTOR, MAHALAXMI NAGAR', '', '', '', '', NULL, NULL),
(178, '', 'SHANTI KUMAR JAIN', 'SHANTI', '', '', '', 8224007149, 0, '', 1, '', 4, '2017-02-06 12:16:28', 'on call', 0, '', '150 NEMI NAGAR JAIN COLONY KESHAR BAUG ROAD INDORE', '', '', '', '', NULL, NULL),
(179, '', 'JOHAR SIR', 'JOHAR', '', '', '', 8109069000, 0, '', 1, '', 4, '2017-02-06 14:24:44', 'on call', 0, '', '616,A-BLOCK PHACE-1 SPACE PARK', '', '', '', '', NULL, NULL),
(180, 'EMP14298609', 'MANISH SHARMA', '', '', '1c104b9c0accfca52ef21728eaf01453', '', 9479402005, 9479402005, '', 1, 'REFERENCE BY VIVEK YADAV JI.', 3, '2017-02-07 12:38:14', '', 0, '', '249 MISHRELAL NAGAR EXT. DEWAS', 'CHANKYA PURI FA-1 DEWAS', 'DEWAS', 'M.P.', '455001', NULL, NULL),
(181, 'EMP26417248', 'NIRMAL YADAV', '', '', '49b44fc23736ae85aededcc798f22c4a', 'YADAVNIRMAL131@YAHU.COM', 9826541920, 9826541920, '', 1, 'REFERENCE BY NEWS PAPER (AGNI-BAN)', 3, '2017-02-07 12:48:15', '', 0, '', '2713/A, YADAV MOHLLA', '', 'MAHU', 'M.P.', '456443', NULL, NULL),
(182, 'EMP14709900', 'KRISHNA PAL JI SOLANKI ', '', '', 'f190ce9ac8445d249747cab7be43f7d5', '', 9589986072, 9589986072, '', 1, 'REFERENCE BY VIKRAM CHAWDA JI', 3, '2017-02-07 12:56:38', '', 0, '', '3004/ SOLANKI NAGAR, MALVIYA NAGAR', '', 'INDORE', 'M.P.', '452010', NULL, NULL),
(183, 'EMP56581436', 'SHUBHAM CHOUHAN', '', '', '269efc0384256ed26a4f1bc2c6d72758', '', 9993865796, 9993865796, '', 1, 'REFERENCE BY VIKAS JI. (KALI MATA MANDIR) ', 3, '2017-02-07 13:07:02', '', 0, '', '13, PATEL NAGAR (NEAR VELO CITY TALKIES)', '', 'INDORE', 'M.P.', '452001', NULL, NULL),
(184, '', 'NINAV MATA', 'NINAV', '', '', '', 9826895176, 0, '', 1, '', 4, '2017-02-09 15:11:47', 'on call', 0, '', '72-C, TULSI NAGAR', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_amc_rel`
--

CREATE TABLE IF NOT EXISTS `user_amc_rel` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amc_id` int(11) NOT NULL,
  `amc_start_date` datetime NOT NULL,
  `amc_end_date` datetime NOT NULL,
  `reference_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_at` datetime NOT NULL,
  `amc_user_status` tinyint(1) NOT NULL,
  `amc_count` int(11) NOT NULL,
  `amc_code` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_amc_rel`
--

INSERT INTO `user_amc_rel` (`id`, `user_id`, `amc_id`, `amc_start_date`, `amc_end_date`, `reference_by`, `created_at`, `edited_at`, `amc_user_status`, `amc_count`, `amc_code`) VALUES
(1, 76, 8, '2016-11-07 08:45:57', '2017-11-07 08:45:57', 75, '2016-11-07 08:45:57', '0000-00-00 00:00:00', 1, 1, 0),
(2, 77, 7, '2016-11-08 16:32:18', '2017-11-08 16:32:18', 75, '2016-11-08 16:32:18', '0000-00-00 00:00:00', 1, 0, 0),
(3, 77, 9, '2016-11-08 16:32:18', '2017-11-08 16:32:18', 75, '2016-11-08 16:32:18', '0000-00-00 00:00:00', 1, 0, 0),
(4, 78, 7, '2016-11-12 06:35:41', '0000-00-00 00:00:00', 75, '2016-11-12 06:35:41', '2016-11-12 06:36:10', 1, 0, 0),
(5, 78, 10, '2016-11-12 06:35:41', '0000-00-00 00:00:00', 75, '2016-11-12 06:35:41', '2016-11-12 06:36:10', 1, 0, 0),
(6, 83, 7, '2016-11-19 10:57:05', '0000-00-00 00:00:00', 81, '2016-11-19 10:57:05', '0000-00-00 00:00:00', 1, 1, 0),
(7, 83, 9, '2016-11-19 10:57:05', '0000-00-00 00:00:00', 81, '2016-11-19 10:57:05', '0000-00-00 00:00:00', 1, 3, 0),
(8, 101, 8, '2016-11-27 13:20:34', '0000-00-00 00:00:00', 81, '2016-11-27 13:20:34', '2016-11-28 07:41:39', 1, 3, 0),
(9, 101, 9, '2016-11-27 13:20:34', '0000-00-00 00:00:00', 81, '2016-11-27 13:20:34', '2016-11-28 07:41:39', 1, 3, 0),
(10, 153, 7, '2017-01-19 14:49:09', '0000-00-00 00:00:00', 88, '2017-01-19 14:49:09', '2017-01-19 15:16:50', 1, 1, 0),
(11, 169, 8, '2017-02-03 16:48:06', '0000-00-00 00:00:00', 88, '2017-02-03 16:48:06', '0000-00-00 00:00:00', 1, 1, 0),
(12, 169, 9, '2017-02-03 16:48:06', '0000-00-00 00:00:00', 88, '2017-02-03 16:48:06', '0000-00-00 00:00:00', 1, 1, 0),
(13, 169, 10, '2017-02-03 16:48:06', '0000-00-00 00:00:00', 88, '2017-02-03 16:48:06', '0000-00-00 00:00:00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_rel`
--

CREATE TABLE IF NOT EXISTS `user_group_rel` (
  `user_group_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_group_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_organisation_rel`
--

CREATE TABLE IF NOT EXISTS `user_organisation_rel` (
  `user_organisation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `user_organisation_update` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_organisation_rel`
--

INSERT INTO `user_organisation_rel` (`user_organisation_id`, `user_id`, `organisation_id`, `user_organisation_update`) VALUES
(1, 38, 1, '0000-00-00 00:00:00'),
(5, 42, 2, '0000-00-00 00:00:00'),
(6, 43, 1, '0000-00-00 00:00:00'),
(7, 44, 1, '0000-00-00 00:00:00'),
(8, 45, 2, '0000-00-00 00:00:00'),
(9, 46, 2, '0000-00-00 00:00:00'),
(10, 41, 1, '0000-00-00 00:00:00'),
(11, 47, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `working_hour`
--

CREATE TABLE IF NOT EXISTS `working_hour` (
  `working_hour_id` int(11) NOT NULL,
  `minutes` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`access_id`), ADD KEY `access_group_id_idx` (`access_level_id`), ADD KEY `access_module_id` (`access_module_id`);

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`access_level_id`);

--
-- Indexes for table `amc`
--
ALTER TABLE `amc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amc_service`
--
ALTER TABLE `amc_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amc_service_history`
--
ALTER TABLE `amc_service_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_Id`);

--
-- Indexes for table `appointment_relation`
--
ALTER TABLE `appointment_relation`
  ADD PRIMARY KEY (`appointment_relation_id`);

--
-- Indexes for table `article_comment_rel`
--
ALTER TABLE `article_comment_rel`
  ADD PRIMARY KEY (`article_comment_rel_id`);

--
-- Indexes for table `article_idea_status`
--
ALTER TABLE `article_idea_status`
  ADD PRIMARY KEY (`article_idea_status_id`);

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`attachment_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `comment_attachment_rel`
--
ALTER TABLE `comment_attachment_rel`
  ADD PRIMARY KEY (`comment_attach_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `followup`
--
ALTER TABLE `followup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forget_password`
--
ALTER TABLE `forget_password`
  ADD PRIMARY KEY (`forget_password_id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indexes for table `forum_article`
--
ALTER TABLE `forum_article`
  ADD PRIMARY KEY (`forum_article_id`);

--
-- Indexes for table `forum_article_attachment_rel`
--
ALTER TABLE `forum_article_attachment_rel`
  ADD PRIMARY KEY (`article_attachment_id`);

--
-- Indexes for table `forum_article_like`
--
ALTER TABLE `forum_article_like`
  ADD PRIMARY KEY (`article_like_id`);

--
-- Indexes for table `forum_category`
--
ALTER TABLE `forum_category`
  ADD PRIMARY KEY (`forum_category_id`);

--
-- Indexes for table `forum_tags`
--
ALTER TABLE `forum_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`organisation_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_assign`
--
ALTER TABLE `ticket_assign`
  ADD PRIMARY KEY (`ticket_assign_id`);

--
-- Indexes for table `ticket_attachment_rel`
--
ALTER TABLE `ticket_attachment_rel`
  ADD PRIMARY KEY (`ticket_attachment_id`);

--
-- Indexes for table `ticket_cc`
--
ALTER TABLE `ticket_cc`
  ADD PRIMARY KEY (`ticket_cc_id`);

--
-- Indexes for table `ticket_comment_rel`
--
ALTER TABLE `ticket_comment_rel`
  ADD PRIMARY KEY (`ticket_comment_id`);

--
-- Indexes for table `ticket_group_rel`
--
ALTER TABLE `ticket_group_rel`
  ADD PRIMARY KEY (`ticket_group_id`);

--
-- Indexes for table `ticket_history`
--
ALTER TABLE `ticket_history`
  ADD PRIMARY KEY (`ticket_history_id`);

--
-- Indexes for table `ticket_tag`
--
ALTER TABLE `ticket_tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `ticket_tag_rel`
--
ALTER TABLE `ticket_tag_rel`
  ADD PRIMARY KEY (`ticket_tag_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_amc_rel`
--
ALTER TABLE `user_amc_rel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_rel`
--
ALTER TABLE `user_group_rel`
  ADD PRIMARY KEY (`user_group_id`);

--
-- Indexes for table `user_organisation_rel`
--
ALTER TABLE `user_organisation_rel`
  ADD PRIMARY KEY (`user_organisation_id`);

--
-- Indexes for table `working_hour`
--
ALTER TABLE `working_hour`
  ADD PRIMARY KEY (`working_hour_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `access_level_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `amc`
--
ALTER TABLE `amc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `amc_service`
--
ALTER TABLE `amc_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `amc_service_history`
--
ALTER TABLE `amc_service_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `appointment_relation`
--
ALTER TABLE `appointment_relation`
  MODIFY `appointment_relation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `article_comment_rel`
--
ALTER TABLE `article_comment_rel`
  MODIFY `article_comment_rel_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `article_idea_status`
--
ALTER TABLE `article_idea_status`
  MODIFY `article_idea_status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attachment`
--
ALTER TABLE `attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `comment_attachment_rel`
--
ALTER TABLE `comment_attachment_rel`
  MODIFY `comment_attach_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `followup`
--
ALTER TABLE `followup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forget_password`
--
ALTER TABLE `forget_password`
  MODIFY `forget_password_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `forum_article`
--
ALTER TABLE `forum_article`
  MODIFY `forum_article_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `forum_article_attachment_rel`
--
ALTER TABLE `forum_article_attachment_rel`
  MODIFY `article_attachment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_article_like`
--
ALTER TABLE `forum_article_like`
  MODIFY `article_like_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `forum_category`
--
ALTER TABLE `forum_category`
  MODIFY `forum_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `forum_tags`
--
ALTER TABLE `forum_tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `organisation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `ticket_assign`
--
ALTER TABLE `ticket_assign`
  MODIFY `ticket_assign_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `ticket_attachment_rel`
--
ALTER TABLE `ticket_attachment_rel`
  MODIFY `ticket_attachment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `ticket_cc`
--
ALTER TABLE `ticket_cc`
  MODIFY `ticket_cc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_comment_rel`
--
ALTER TABLE `ticket_comment_rel`
  MODIFY `ticket_comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ticket_group_rel`
--
ALTER TABLE `ticket_group_rel`
  MODIFY `ticket_group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_history`
--
ALTER TABLE `ticket_history`
  MODIFY `ticket_history_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT for table `ticket_tag`
--
ALTER TABLE `ticket_tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_tag_rel`
--
ALTER TABLE `ticket_tag_rel`
  MODIFY `ticket_tag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=185;
--
-- AUTO_INCREMENT for table `user_amc_rel`
--
ALTER TABLE `user_amc_rel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_group_rel`
--
ALTER TABLE `user_group_rel`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_organisation_rel`
--
ALTER TABLE `user_organisation_rel`
  MODIFY `user_organisation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `working_hour`
--
ALTER TABLE `working_hour`
  MODIFY `working_hour_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
