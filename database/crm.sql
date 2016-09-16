-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2016 at 06:35 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crm`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE IF NOT EXISTS `access_level` (
  `access_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `access_level_name` varchar(45) DEFAULT NULL,
  `access_level_description` varchar(130) DEFAULT NULL,
  PRIMARY KEY (`access_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`access_level_id`, `access_level_name`, `access_level_description`) VALUES
(1, 'admin', 'Administrator Access'),
(2, 'user', 'User Access'),
(3, 'employee', 'Employee access');

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_name` varchar(254) NOT NULL,
  `attachment_path` varchar(254) NOT NULL,
  `attachment_type` enum('image','video','pdf','extra') NOT NULL,
  `attachment_update` datetime NOT NULL,
  PRIMARY KEY (`attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_question` text NOT NULL,
  `faq_answer` text NOT NULL,
  `faq_user_id` int(11) NOT NULL,
  `faq_organisation_id` int(11) NOT NULL,
  `faq_update` datetime NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faq_attachment_rel`
--

CREATE TABLE IF NOT EXISTS `faq_attachment_rel` (
  `faq_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_id` int(11) NOT NULL,
  `faq_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faq_comment_rel`
--

CREATE TABLE IF NOT EXISTS `faq_comment_rel` (
  `faq_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `faq_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_comment_id`)
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
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_title` varchar(254) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `group_update` datetime NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(45) DEFAULT NULL,
  `module_description` text,
  `module_link` varchar(125) DEFAULT NULL,
  `module_icon` varchar(45) NOT NULL,
  `module_order` int(11) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE IF NOT EXISTS `organisation` (
  `organisation_id` int(11) NOT NULL AUTO_INCREMENT,
  `organisation_name` varchar(256) NOT NULL,
  `organisation_address` varchar(256) NOT NULL,
  `organisation_phone` varchar(20) NOT NULL,
  `organisation_notes` text NOT NULL,
  `organisation_customer_type` varchar(128) NOT NULL,
  `organisation_extra` text NOT NULL,
  `organisation_update` datetime NOT NULL,
  PRIMARY KEY (`organisation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(254) NOT NULL,
  `ticket_subject` text NOT NULL,
  `ticket_description` text NOT NULL,
  `ticket_priority` enum('normal','high','urgent') NOT NULL,
  `ticket_status` enum('open','close','solved') NOT NULL,
  `ticket_type` enum('question','task','problem') NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_update` datetime NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_assign`
--

CREATE TABLE IF NOT EXISTS `ticket_assign` (
  `ticket_assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `ticket_assign_at` datetime NOT NULL,
  PRIMARY KEY (`ticket_assign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachment_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_attachment_rel` (
  `ticket_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comment_rel`
--

CREATE TABLE IF NOT EXISTS `ticket_comment_rel` (
  `ticket_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `ticket_history_status` enum('open','close','solved') NOT NULL,
  `ticket_history_created_at` datetime NOT NULL,
  PRIMARY KEY (`ticket_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_artical`
--

CREATE TABLE IF NOT EXISTS `tutorial_artical` (
  `tutorial_artical_id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_artical_heading` text NOT NULL,
  `tutorial_artical_content` text NOT NULL,
  `tutorial_artical_created_by` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `tutorial_tag_id` int(11) NOT NULL,
  `tutorial_artical_created_at` datetime NOT NULL,
  PRIMARY KEY (`tutorial_artical_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_attachment_rel`
--

CREATE TABLE IF NOT EXISTS `tutorial_attachment_rel` (
  `tutorial_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_id` int(11) NOT NULL,
  `tutorial_artical_id` int(11) NOT NULL,
  PRIMARY KEY (`tutorial_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_comment_rel`
--

CREATE TABLE IF NOT EXISTS `tutorial_comment_rel` (
  `tutorial_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `tutorial_artical_id` int(11) NOT NULL,
  PRIMARY KEY (`tutorial_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_tag`
--

CREATE TABLE IF NOT EXISTS `tutorial_tag` (
  `tutorial_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_tag_heading` varchar(256) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `tutorial_tag_created_at` datetime NOT NULL,
  PRIMARY KEY (`tutorial_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_password` varchar(256) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_status` int(11) NOT NULL,
  `user_access_level` int(11) NOT NULL,
  `user_update` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
