-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2016 at 09:41 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `checknchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `access_id` int(11) NOT NULL AUTO_INCREMENT,
  `access_level_id` int(11) NOT NULL,
  `access_module_id` int(11) NOT NULL,
  `access_view` int(11) DEFAULT '0',
  `access_insert` int(11) DEFAULT '0',
  `access_update` int(11) DEFAULT '0',
  `access_delete` int(11) DEFAULT '0',
  PRIMARY KEY (`access_id`),
  KEY `access_group_id_idx` (`access_level_id`),
  KEY `access_module_id` (`access_module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

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
(32, 1, 16, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE IF NOT EXISTS `access_level` (
  `access_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `access_level_name` varchar(45) DEFAULT NULL,
  `access_level_description` varchar(130) DEFAULT NULL,
  PRIMARY KEY (`access_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amc_name` varchar(255) NOT NULL,
  `amc_code` varchar(255) NOT NULL,
  `amc_duration` varchar(255) NOT NULL,
  `amc_visit` int(11) NOT NULL,
  `amc_criteria` varchar(255) NOT NULL,
  `amc_description` text NOT NULL,
  `package_logo` text NOT NULL,
  `amc_status` int(11) NOT NULL,
  `package_update` datetime NOT NULL,
  `amc_type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `amc`
--

INSERT INTO `amc` (`id`, `amc_name`, `amc_code`, `amc_duration`, `amc_visit`, `amc_criteria`, `amc_description`, `package_logo`, `amc_status`, `package_update`, `amc_type`) VALUES
(7, 'AMC - RO MAINTENANCE', '101', '1', 4, ' CLEANING AND SERVICE COMMITMENT', 'PART REPLACEMENT WITHOUT LABOUR CHARGE - CHANGING MAM-BRAN,CARBON AND FILTER REPLACEMENT LABOUR FREE (WATER  HARDNESS  LAB TEST*)', 'assets/img/package/userimage_2890633.jpg', 1, '2016-09-16 20:29:15', 'primary'),
(8, 'AMC - ELECTRIC/INVERTER BATTERY', '102', '1', 12, 'WITHOUT MATERIAL CHANGING SWITCHES ,ELECTRIC WIRING FAULT DETECTION AND SOLUTION ,HANGING FAN AND REPLACEMENT OF LIGHTS BULB TUBE AT HOME ( CIVIL WORK NOT A PART OF AMC* ITS COST YOU EXTRA ON SITE TO SITE CONDITION)', 'PART REPLACEMENT WITHOUT LABOUR CHARGE - AS PER MARKET RATE + 30 RS + Actual TRANSPORTATION CHARGES (ONLY BRANDED MATERIAL WILL BE USED)IF CUSTOMER WANTS TO PROVIDE REPLACING PART THEN WE WILL FIX THE SAME FREE OF COST (15 DAYS SERVICE WARRANTY NOT CONSIDER)', 'assets/img/package/userimage_897a4be.jpg', 1, '2016-09-16 20:30:30', 'primary'),
(9, 'PLUMBER', '103', '1', 12, 'CRITERIA - WITHOUT MATERIAL CHANGING TAPS AND SHOWERS ,LEAKAGE DETECTION AND SOLUTION OUTER FITTINGS( IN COURSE OF LEAKAGE REPAIR OR FITTINGS WALL AND TILES WILL BROKE OR DAMAGE WHICH IS PART OF SOLUTION FOR THAT ', 'PART REPLACEMENT WITHOUT LABOUR CHARGE - AS PER MARKET RATE + 30 RS +Actual TRANSPORTATION CHARGES (ONLY BRANDED MATERIAL WILL BE USED)IF CUSTOMER WANTS TO PROVIDE REPLACING PART THEN WE WILL FIX THE SAME FREE OF COST (15 DAYS SERVICE WARRANTY NOT CONSIDER)', 'assets/img/package/userimage_545fe9e.jpg', 1, '2016-09-16 20:31:54', 'primary'),
(10, 'AMC - CARPENTER + MODULAR KITCHEN', '104', '1', 12, 'WITHOUT MATERIAL CHANGING DOOR WINDOWS,LOCKS HOLE DROPS FITTINGS MODULAR KITCHEN REPAIRING ( IN COURSE OF REPAIR OR FITTINGS WALL AND TILES WILL BROKE OR DAMAGE WHICH IS PART OF SOLUTION FOR THAT ', 'PART REPLACEMENT WITHOUT LABOUR CHARGE - AS PER MARKET RATE +  30Rs + ACTUAL TRANSPORTATION CHARGES (ONLY BRANDED MATERIAL WILL BE USED)IF CUSTOMER WANTS TO PROVIDE REPLACING PART THEN WE WILL FIX THE SAME FREE OF COST (15 DAYS SERVICE WARRANTY NOT CONSIDER)', 'assets/img/package/userimage_752d25a.jpg', 1, '2016-09-22 10:56:59', 'primary'),
(11, 'Paste Control', '0', '1', 2, 'terrere', 'fdsfdsfds', '', 0, '2016-10-29 22:22:04', 'on_call'),
(12, 'Paste Control', '0', '0', 0, 'terrere', 'fdsfdsfds', '', 1, '2016-10-29 22:25:32', 'on_call'),
(13, 'dsadas', 'AMC47403025', '1', 2, 'dsadsad', 'dsads', '', 0, '2016-11-04 18:00:15', 'home_appliance'),
(14, 'dsadas', 'AMC47403025', '1', 2, 'dsadsad', 'dsads', '', 0, '2016-11-04 18:00:15', 'home_appliance');

-- --------------------------------------------------------

--
-- Table structure for table `amc_service`
--

CREATE TABLE IF NOT EXISTS `amc_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amc_id` int(11) NOT NULL,
  `amc_rel` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `reference_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `amc_note` text NOT NULL,
  `edited_at` datetime NOT NULL,
  `amc_code` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `amc_service`
--

INSERT INTO `amc_service` (`id`, `user_id`, `amc_id`, `amc_rel`, `start_date`, `due_date`, `reference_by`, `create_date`, `amc_note`, `edited_at`, `amc_code`) VALUES
(1, 49, 7, 1, '0000-00-00 00:00:00', '2016-11-08 20:19:43', 48, '2016-11-05 20:19:43', '', '0000-00-00 00:00:00', 0),
(2, 49, 8, 2, '0000-00-00 00:00:00', '2016-11-08 20:19:44', 48, '2016-11-05 20:19:44', '', '0000-00-00 00:00:00', 0),
(3, 49, 9, 3, '0000-00-00 00:00:00', '2016-11-08 20:19:44', 48, '2016-11-05 20:19:44', '', '0000-00-00 00:00:00', 0),
(4, 49, 10, 4, '0000-00-00 00:00:00', '2016-11-08 20:19:44', 48, '2016-11-05 20:19:44', '', '0000-00-00 00:00:00', 0),
(5, 50, 7, 5, '0000-00-00 00:00:00', '2016-11-08 20:20:04', 48, '2016-11-05 20:20:04', '', '0000-00-00 00:00:00', 0),
(6, 50, 8, 6, '0000-00-00 00:00:00', '2016-11-08 20:20:04', 48, '2016-11-05 20:20:04', '', '0000-00-00 00:00:00', 0),
(7, 50, 9, 7, '0000-00-00 00:00:00', '2016-11-08 20:20:04', 48, '2016-11-05 20:20:04', '', '0000-00-00 00:00:00', 0),
(8, 50, 10, 8, '0000-00-00 00:00:00', '2016-11-08 20:20:04', 48, '2016-11-05 20:20:04', '', '0000-00-00 00:00:00', 0),
(9, 51, 9, 9, '2016-11-08 20:29:55', '2016-11-11 20:29:55', 48, '2016-11-08 20:29:55', 'sadsasa', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `amc_service_history`
--

CREATE TABLE IF NOT EXISTS `amc_service_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amc_id` int(11) NOT NULL,
  `amc_service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `reference_by` int(11) NOT NULL,
  `notes` varchar(500) NOT NULL,
  `complete_notes` varchar(255) NOT NULL,
  `complete_date` datetime NOT NULL,
  `amc_code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_Id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_date` date NOT NULL,
  `appointment_start_time` varchar(50) NOT NULL,
  `appointment_end_time` varchar(50) NOT NULL,
  `appointment_venue` varchar(100) NOT NULL,
  `appointment_create` datetime NOT NULL,
  PRIMARY KEY (`appointment_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_Id`, `appointment_date`, `appointment_start_time`, `appointment_end_time`, `appointment_venue`, `appointment_create`) VALUES
(1, '2016-04-26', '01:00', '03:00', '', '2016-04-01 14:28:38'),
(2, '2016-04-27', '01:30', '02:30', '', '2016-04-01 14:29:22'),
(3, '2016-04-19', '00:00', '01:00', '', '2016-04-01 14:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_relation`
--

CREATE TABLE IF NOT EXISTS `appointment_relation` (
  `appointment_relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `assignee_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`appointment_relation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `article_comment_rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_article_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `article_status` enum('Answer') DEFAULT NULL,
  PRIMARY KEY (`article_comment_rel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

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
  `article_idea_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_article_id` int(11) NOT NULL,
  `article_idea_status` enum('Planned','Done','Not planned','None') NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`article_idea_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_name` varchar(254) NOT NULL,
  `attachment_path` varchar(254) NOT NULL,
  `attachment_type` enum('audio','video','image','doc','extra','object') NOT NULL,
  `attachment_update` datetime NOT NULL,
  PRIMARY KEY (`attachment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
(10, 'favicon.png', 'assets/attachment/image/1459335501_favicon.png', 'image', '2016-03-30 12:58:21'),
(11, '10169205_219951188337247_4014068942968777191_n.jpg', 'assets/attachment/image/1477590877_10169205_219951188337247_4014068942968777191_n.jpg', 'image', '2016-10-27 18:54:37'),
(12, '10349983_422375857936446_6431713811344540796_n.jpg', 'assets/attachment/image/1477590880_10349983_422375857936446_6431713811344540796_n.jpg', 'image', '2016-10-27 18:54:40'),
(13, '61.jpg', 'assets/attachment/image/1478024384_61.jpg', 'image', '2016-11-01 18:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_message` text NOT NULL,
  `comment_by_id` int(11) NOT NULL,
  `comment_update` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

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
  `comment_attach_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_attach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_type` enum('good','bad') NOT NULL,
  `feedback_comment` text NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_created_at` datetime NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forget_password`
--

CREATE TABLE IF NOT EXISTS `forget_password` (
  `forget_password_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `forget_token` varchar(256) NOT NULL,
  `forget_update` datetime NOT NULL,
  PRIMARY KEY (`forget_password_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `forget_password`
--

INSERT INTO `forget_password` (`forget_password_id`, `user_id`, `forget_token`, `forget_update`) VALUES
(1, 43, '56d831e1c7a6f', '2016-03-03 13:45:21'),
(2, 44, '56d831fecf612', '2016-03-03 13:45:50'),
(3, 45, '56d8325a298f5', '2016-03-03 13:47:22'),
(4, 46, '56d832755e5b1', '2016-03-03 13:47:49'),
(5, 63, '580317f5a2a83', '2016-10-16 07:02:29'),
(6, 71, '5812388463ddb', '2016-10-27 18:25:24'),
(7, 72, '581245ba7d884', '2016-10-27 19:21:46'),
(8, 73, '58150e34c54b3', '2016-10-29 22:01:40'),
(9, 74, '58181aedc7411', '2016-11-01 04:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_title` varchar(254) NOT NULL,
  `forum_desc` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `forum_type` enum('Articles','Ideas','Questions') NOT NULL,
  `forum_topic_view` enum('Everybody','Signed-in users','Agents only') NOT NULL,
  `forum_topic_create` enum('Logged-in users','Unrestricted agents and moderators only') NOT NULL,
  `forum_created_at` datetime NOT NULL,
  `forum_created_by` int(11) NOT NULL,
  `forum_order_by` text,
  `updated_by` datetime NOT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
  `forum_article_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `forum_category_id` int(11) NOT NULL,
  `forum_article_title` varchar(512) NOT NULL,
  `forum_article_desc` text NOT NULL,
  `forum_article_comment_status` tinyint(1) NOT NULL,
  `forum_article_homepage_status` tinyint(1) NOT NULL,
  `forum_article_highlight_status` tinyint(1) NOT NULL,
  `forum_article_created_by` int(11) NOT NULL,
  `forum_article_cretaed_at` datetime NOT NULL,
  `updated_by` datetime NOT NULL,
  PRIMARY KEY (`forum_article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
  `article_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_article_id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL,
  PRIMARY KEY (`article_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_article_like`
--

CREATE TABLE IF NOT EXISTS `forum_article_like` (
  `article_like_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`article_like_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `forum_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_category_name` varchar(254) NOT NULL,
  `forum_category_description` text NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `forum_created_by` varchar(10) NOT NULL,
  `forum_created_at` datetime NOT NULL,
  PRIMARY KEY (`forum_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `forum_article_id` bigint(20) NOT NULL,
  `tags_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_title` varchar(254) NOT NULL,
  `group_update` datetime NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_parent` int(11) NOT NULL,
  `module_name` varchar(45) DEFAULT NULL,
  `module_description` text,
  `module_link` varchar(125) DEFAULT NULL,
  `module_icon` varchar(45) NOT NULL,
  `module_position` enum('menu','profile','submenu') NOT NULL,
  `module_order` int(11) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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
(16, 0, 'archive', 'archive', 'archive', 'fi-archive', 'menu', 12);

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE IF NOT EXISTS `organisation` (
  `organisation_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `organisation_update` datetime NOT NULL,
  PRIMARY KEY (`organisation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `amc_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `ticket_number`, `ticket_subject`, `ticket_description`, `ticket_priority`, `ticket_status`, `amc_ticket_type`, `user_id`, `ticket_updated`, `ticket_created`, `amc_code`, `amc_type`, `amc_id`) VALUES
(1, '#TKT04742835', 'dsadsad', 'dsdfsfdsfds', 'high', 'Open', '', 51, '2016-11-08 20:40:23', '2016-11-08 20:40:23', 0, 'primary', 8);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_assign`
--

CREATE TABLE IF NOT EXISTS `ticket_assign` (
  `ticket_assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `parent_user_id` int(11) NOT NULL,
  `current_working_user` int(11) NOT NULL,
  `ticket_assign_at` datetime NOT NULL,
  PRIMARY KEY (`ticket_assign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ticket_assign`
--

INSERT INTO `ticket_assign` (`ticket_assign_id`, `user_id`, `group_id`, `ticket_id`, `assigned_by`, `parent_user_id`, `current_working_user`, `ticket_assign_at`) VALUES
(1, 48, 0, 8, 47, 0, 1, '2016-11-01 18:26:34'),
(2, 48, 0, 1, 47, 0, 1, '2016-11-08 20:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachment_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_attachment_rel` (
  `ticket_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_attachment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ticket_attachment_rel`
--

INSERT INTO `ticket_attachment_rel` (`ticket_attachment_id`, `ticket_id`, `attachment_id`) VALUES
(1, 1, 0),
(2, 3, 13),
(3, 4, 0),
(4, 5, 0),
(5, 6, 0),
(6, 7, 0),
(7, 8, 0),
(8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_cc`
--

CREATE TABLE IF NOT EXISTS `ticket_cc` (
  `ticket_cc_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `ticket_cc_email` varchar(200) NOT NULL,
  `ticket_cc_created_at` datetime NOT NULL,
  PRIMARY KEY (`ticket_cc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comment_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_comment_rel` (
  `ticket_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `comment_type` varchar(20) NOT NULL DEFAULT 'public',
  PRIMARY KEY (`ticket_comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
  `ticket_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `ticket_group_update` datetime NOT NULL,
  PRIMARY KEY (`ticket_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_history`
--

CREATE TABLE IF NOT EXISTS `ticket_history` (
  `ticket_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `ticket_updated_by` int(11) NOT NULL,
  `ticket_history_status` enum('Open','Pending','Solved','Doing','Closed') NOT NULL,
  `ticket_history_created_at` datetime NOT NULL,
  PRIMARY KEY (`ticket_history_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ticket_history`
--

INSERT INTO `ticket_history` (`ticket_history_id`, `ticket_id`, `ticket_updated_by`, `ticket_history_status`, `ticket_history_created_at`) VALUES
(1, 1, 1, 'Doing', '2016-04-01 09:50:21'),
(2, 1, 1, 'Solved', '2016-04-01 11:07:04'),
(3, 1, 47, 'Pending', '2016-10-31 16:14:27'),
(4, 1, 47, 'Pending', '2016-10-31 17:02:05'),
(5, 1, 47, 'Doing', '2016-11-01 04:13:41'),
(6, 2, 47, 'Solved', '2016-11-01 04:13:45'),
(7, 1, 47, 'Open', '2016-11-01 04:13:49'),
(8, 1, 47, 'Doing', '2016-11-01 04:14:01'),
(9, 1, 47, 'Doing', '2016-11-01 04:14:20'),
(10, 1, 47, 'Open', '2016-11-01 04:16:36'),
(11, 2, 47, 'Open', '2016-11-01 04:16:39'),
(12, 2, 47, 'Doing', '2016-11-01 04:16:42'),
(13, 2, 47, 'Solved', '2016-11-01 04:19:59'),
(14, 1, 47, 'Open', '2016-11-01 04:58:44'),
(15, 4, 47, 'Open', '2016-11-01 18:23:04'),
(16, 5, 47, 'Open', '2016-11-01 18:24:58'),
(17, 8, 47, 'Open', '2016-11-01 18:26:34'),
(18, 1, 47, 'Open', '2016-11-03 19:44:21'),
(19, 1, 47, 'Open', '2016-11-03 19:44:21'),
(20, 1, 47, 'Open', '2016-11-08 20:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_tag`
--

CREATE TABLE IF NOT EXISTS `ticket_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_heading` varchar(256) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `tag_created_at` datetime NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_tag_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_tag_rel` (
  `ticket_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_tag_update` datetime NOT NULL,
  PRIMARY KEY (`ticket_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(255) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_email` varchar(256) NOT NULL,
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
  `annivery` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_code`, `user_name`, `first_name`, `last_name`, `user_password`, `user_mobile`, `user_phone`, `user_email`, `user_profile`, `user_status`, `user_note`, `user_access_level`, `user_update`, `user_type`, `reference_by`, `document`, `address1`, `address2`, `user_city`, `user_country`, `user_postcode`, `dob`, `annivery`) VALUES
(47, '0', 'dsadsa', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '0', '12345678933', 'admin@mail.com', 'assets/img/user/userimage_3958bec.jpg', 1, 'dsdsa', 1, '2016-09-18 18:15:23', '0', 51, '', '543543', '', '54353', '5435', '5434534', '0000-00-00', '0000-00-00 00:00:00'),
(48, 'EMP88826783', 'Rajendra', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '5454323456', '5454323456', 'admin2@mail.com', '', 1, '', 3, '2016-11-05 19:04:58', '', 0, 'assets/attachment/employee/attachment_e801f99.jpg', '12121', '', 'india', 'indore', '4234', NULL, NULL),
(49, 'CUS26174089', 'Dharmendra Gupta', 'Dharmendra', 'Gupta', '827ccb0eea8a706c4c34a16891f84e7b', '1234567898', '', 'adfgfgfmin@mail.com', '', 1, '', 4, '2016-11-06 16:14:58', 'premium', 48, '', 'Biyabani', 'fdsf', 'Indore', 'India', '54454', '2020-11-20', '2020-11-20 00:00:00'),
(50, 'CUS86551542', 'Dharmendra Gupta', 'Dharmendra', 'Gupta', '827ccb0eea8a706c4c34a16891f84e7b', '1234567898', '', 'adfgfgdfdffmin@mail.com', '', 1, 'fdsfds', 4, '2016-11-06 15:59:57', 'premium', 48, '', 'Biyabani', '', 'Indore', 'India', '54454', '2020-11-20', '2020-11-20 00:00:00'),
(51, 'CUS09161798', 'dsdsa sad', 'dsdsa', 'sad', '827ccb0eea8a706c4c34a16891f84e7b', '1111111177', '1111111177', 'admissn@mail.com', 'assets/img/user/userimage_234e5dc.jpg', 1, 'sadsasa', 4, '2016-11-08 20:29:55', 'premium', 48, '', 'sds', 'sadsa', 'india', 'fdsf', 'rer', '2016-11-09', '2016-11-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_amc_rel`
--

CREATE TABLE IF NOT EXISTS `user_amc_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amc_id` int(11) NOT NULL,
  `amc_start_date` datetime NOT NULL,
  `amc_end_date` datetime NOT NULL,
  `reference_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_at` datetime NOT NULL,
  `amc_user_status` tinyint(1) NOT NULL,
  `amc_count` int(11) NOT NULL,
  `amc_code` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_amc_rel`
--

INSERT INTO `user_amc_rel` (`id`, `user_id`, `amc_id`, `amc_start_date`, `amc_end_date`, `reference_by`, `created_at`, `edited_at`, `amc_user_status`, `amc_count`, `amc_code`) VALUES
(1, 49, 7, '2016-11-05 20:19:43', '2017-11-05 20:19:43', 48, '2016-11-05 20:19:43', '2016-11-06 16:14:58', 1, 0, 0),
(2, 49, 8, '2016-11-05 20:19:43', '2017-11-05 20:19:43', 48, '2016-11-05 20:19:43', '2016-11-06 16:14:58', 1, 0, 0),
(3, 49, 9, '2016-11-05 20:19:44', '2017-11-05 20:19:44', 48, '2016-11-05 20:19:44', '2016-11-06 16:14:58', 1, 0, 0),
(4, 49, 10, '2016-11-05 20:19:44', '2017-11-05 20:19:44', 48, '2016-11-05 20:19:44', '2016-11-06 16:14:58', 1, 0, 0),
(5, 50, 7, '2016-11-05 20:20:04', '2017-11-05 20:20:04', 48, '2016-11-05 20:20:04', '2016-11-06 15:59:57', 1, 0, 0),
(6, 50, 8, '2016-11-05 20:20:04', '2017-11-05 20:20:04', 48, '2016-11-05 20:20:04', '2016-11-06 15:59:57', 1, 0, 0),
(7, 50, 9, '2016-11-05 20:20:04', '2017-11-05 20:20:04', 48, '2016-11-05 20:20:04', '2016-11-06 15:59:57', 1, 0, 0),
(8, 50, 10, '2016-11-05 20:20:04', '2017-11-05 20:20:04', 48, '2016-11-05 20:20:04', '2016-11-06 15:59:57', 1, 0, 0),
(9, 51, 9, '2016-11-08 20:29:55', '2017-11-08 20:29:55', 48, '2016-11-08 20:29:55', '0000-00-00 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_rel`
--

CREATE TABLE IF NOT EXISTS `user_group_rel` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_group_update` datetime NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_organisation_rel`
--

CREATE TABLE IF NOT EXISTS `user_organisation_rel` (
  `user_organisation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `user_organisation_update` datetime NOT NULL,
  PRIMARY KEY (`user_organisation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user_organisation_rel`
--

INSERT INTO `user_organisation_rel` (`user_organisation_id`, `user_id`, `organisation_id`, `user_organisation_update`) VALUES
(1, 38, 1, '0000-00-00 00:00:00'),
(2, 39, 1, '0000-00-00 00:00:00'),
(5, 42, 2, '0000-00-00 00:00:00'),
(6, 43, 1, '0000-00-00 00:00:00'),
(7, 44, 1, '0000-00-00 00:00:00'),
(8, 45, 2, '0000-00-00 00:00:00'),
(9, 46, 2, '0000-00-00 00:00:00'),
(10, 41, 1, '0000-00-00 00:00:00'),
(11, 47, 1, '0000-00-00 00:00:00'),
(14, 50, 1, '0000-00-00 00:00:00'),
(15, 51, 1, '0000-00-00 00:00:00'),
(16, 52, 1, '0000-00-00 00:00:00'),
(17, 63, 5, '0000-00-00 00:00:00'),
(18, 71, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `working_hour`
--

CREATE TABLE IF NOT EXISTS `working_hour` (
  `working_hour_id` int(11) NOT NULL AUTO_INCREMENT,
  `minutes` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`working_hour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
