-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql203.eb2a.com
-- Generation Time: May 28, 2015 at 10:14 PM
-- Server version: 5.6.22-71.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eb2a_14146314_gpstracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_lat` double NOT NULL,
  `start_lng` double NOT NULL,
  `start_location_title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_lat` double DEFAULT NULL,
  `end_lng` double DEFAULT NULL,
  `end_location_title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `end_time` datetime NOT NULL,
  `vehicle_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `start_lat`, `start_lng`, `start_location_title`, `start_time`, `end_lat`, `end_lng`, `end_location_title`, `end_time`, `vehicle_id`) VALUES
(27, 31.0360638, 31.3650357, 'Ahmed Maher, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', '2015-05-28 04:04:26', 31.0360638, 31.3650357, 'Ahmed Maher, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', '2015-05-28 04:05:29', 'sh10'),
(33, 31.0360638, 31.3650357, 'Ahmed Maher, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', '2015-05-28 14:37:37', 31.0360638, 31.3650357, 'Ahmed Maher, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', '2015-05-28 14:38:08', 'sh10'),
(34, 31.0360638, 31.3650357, 'Ahmed Maher, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', '2015-05-28 14:38:22', 31.1231405, 31.4217006, 'طريق الخراب، Talkha, Dakahlia Governorate, Egypt', '2015-05-28 15:00:46', 'sh10'),
(35, 31.0378992, 31.3638101, 'Street 1, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', '2015-05-28 00:00:00', 31.0378992, 31.3638101, 'Street 1, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', '2015-05-28 00:00:00', 'sh10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` int(11) NOT NULL,
  `address` text,
  `org_type` varchar(30) DEFAULT NULL,
  `ver_number` int(11) NOT NULL,
  `verified` tinyint(1) DEFAULT '0',
  `tracking_interval` int(11) NOT NULL DEFAULT '3',
  `reg_id` text,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `name`, `type`, `address`, `org_type`, `ver_number`, `verified`, `tracking_interval`, `reg_id`) VALUES
('jo', '123456', 'engineryousef@gmail.com', 'Yousef Elerian', 1, '', '', 1431885311, 1, 3, NULL),
('khaled', '123456', 'khaled.sonbaty@gmail.com', 'Khaled Sonbaty', 1, '', '', 2146326350, 1, 3, NULL),
('shamy', '123456', 'shamyyoun@gmail.com', 'Mahmoud Elshamy', 2, 'Damietta', 'Demo Organization', 1993425492, 1, 5, 'APA91bHejpP1DgiQgqNNTrHig4OJPCB1KrfwfKpDdFFBbTBtig-3vW4M2nk2Y2mPIFcriOmyjvbb2F64tugxkwiw9Ixih3WW_1P0CslzRJgDtHW-qlTrkbfreZFZjB7IdUnfawByjEW566Nb5MGCt3bLzHt22rxKMEVeI6oqICOYg4NBh6BRtjE'),
('waheed', '123', 'shamyyoun@gmail.com', 'Waheed', 1, '', '', 818792863, 1, 3, 'APA91bFzS4bDBHIkkmK27YZTdL7R0IElKrS7Qo53ebwyuMlBmCWamBcKCk1Hwe6xzgI6lWnDAuLm2CAGJT6lOgJOyRUNKMfUU3sYIeNY5esULoG-QfcypaFZB03i1txADma82OARuAMhNo3iVYZ8LZstq3kv9LbQ2WB2yadCnLfwTb705-dQcok');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `licence_number` int(40) DEFAULT NULL,
  `number` int(40) DEFAULT NULL,
  `color` varchar(40) DEFAULT NULL,
  `model` varchar(40) DEFAULT NULL,
  `year` int(10) DEFAULT NULL,
  `brand` varchar(40) DEFAULT NULL,
  `lat` double DEFAULT '0',
  `lng` double DEFAULT '0',
  `reg_id` text,
  `trip_status` int(11) NOT NULL DEFAULT '2',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `password`, `name`, `purpose`, `licence_number`, `number`, `color`, `model`, `year`, `brand`, `lat`, `lng`, `reg_id`, `trip_status`, `time_stamp`, `user_id`) VALUES
('jo_vebicle', '123456', 'My Vehicle', 'My Vehicle', 0, 0, '', '', 0, '', 0, 0, NULL, 2, '2015-05-28 01:31:21', 'jo'),
('khaled_vehicle', '123456', 'My', '', 0, 0, '', '', 0, '', 0, 0, NULL, 2, '2015-05-28 01:31:25', 'khaled'),
('sh10', '123456', 'Mansoura Car', 'My Car', 504030, 20, '', 'ger', 2010, 'Kia', 31.0360638, 31.3650357, 'APA91bFe3LWlTeSpKiLd-ieh9Du-Z7lfDQgB6rBKuONcxl_R0946x8ISFjmodmpG_psdNuX5JBh8YcqnrnAQfkzznhxALNmKaqeZEbOy3PhTfO7Go-6zGXA27LSuIvbJIrYPiRWnds-mDDnFzrmzIkYSDPwZQkB3Y2xvu0FsVZ13AM2BIv_NWzc', 2, '2015-05-28 19:10:20', 'shamy'),
('sh20', '123456', 'Damietta Car', 'Son''s Car', 0, 0, 'White', '', 0, '', 31.2063326, 31.5361557, '', 2, '2015-05-28 01:31:33', 'shamy'),
('sh30', '123456', 'Talkha Car', 'for testing purposes', 0, 0, '', '', 0, '', 31.0549599, 31.384869, 'APA91bEsJsE1xKSyjVsqWX-R-wUICmNn3CRdvcPYnxjfhbdSn-vwRtI_2BcazAz6J6k752KY5qmtCZojwDzW216Sm4dsUjWDOt1utm2bRJEEPJQmFsFYJZTfeiOH3279saRboOIgi5ne5ASH_kMcuIJ9i68nr8KcA5nhrqLI3EvVhmxuRTezoww', 2, '2015-05-28 19:18:13', 'shamy');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
