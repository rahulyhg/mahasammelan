-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 166.62.8.4
-- Generation Time: Feb 21, 2016 at 10:53 PM
-- Server version: 5.5.43
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbsadhu`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` enum('sadhu','shravak') NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `join_date` datetime NOT NULL,
  `social_id` int(11) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `location_string` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` VALUES(1, 'test', '123456789', 'test@gmail.com', '20713845', 'shravak', '', '2015-11-27 12:07:07', 0, '', '', '');
INSERT INTO `app_users` VALUES(2, 'gourav', '7828699099', 'singhaniagourav@gmail.com', '93864127', 'sadhu', '', '2015-11-27 12:51:04', 0, '4543', '2323', 'cddsddfxcv');
INSERT INTO `app_users` VALUES(3, 'viky', '9143052218', 'viky@yahoo.com', '123456', 'sadhu', '', '2015-11-27 12:53:07', 0, '123', 'sss', 'aaaa');
INSERT INTO `app_users` VALUES(4, 'raghav daga', '1234567890', 'daga_raghav@yahoo.com', '12345', 'shravak', '', '2015-11-27 12:53:55', 0, '', '', '');
INSERT INTO `app_users` VALUES(5, 'gourav', '7737180733', 'priya@gmail.com', '123456', 'sadhu', '', '2015-11-27 11:13:14', 0, '', '', '');
INSERT INTO `app_users` VALUES(6, 'pp', '1234675', 'aa@gmail.com', '123', '', '00000', '2015-12-19 01:57:21', 0, '', '', '');
INSERT INTO `app_users` VALUES(7, 'priyanka', '16536157681', 'priyanka@hjjsw.co', '1234', '', '000000000000000', '2015-12-19 04:12:18', 0, '', '', '');
INSERT INTO `app_users` VALUES(8, 'priyankagg', '1653615768189', 'priyanka12@hjjsw.co', '1234', '', '000000000000000', '2015-12-19 04:13:18', 0, '', '', '');
INSERT INTO `app_users` VALUES(9, 'dgghh', '536777277777', 'sfghh@gmail.com', '1234', '', '000000000000000', '2015-12-19 04:16:08', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `location_sadhu`
--

CREATE TABLE `location_sadhu` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `longs` varchar(50) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `location_sadhu`
--

INSERT INTO `location_sadhu` VALUES(1, 1, '63.4''', '54.12''');
