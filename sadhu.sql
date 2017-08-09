-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2016 at 03:47 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sadhu`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `email_address` varchar(200) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` enum('Sadhu','Sadhvi','Admin','User') DEFAULT NULL,
  `diksha_date` date DEFAULT NULL,
  `address` text,
  `group_id` int(11) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `device_id` text NOT NULL,
  `join_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `social_id` text NOT NULL,
  `longitude` varchar(150) NOT NULL,
  `latitude` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`user_id`, `mobile_number`, `email_address`, `password`, `user_type`, `diksha_date`, `address`, `group_id`, `username`, `device_id`, `join_date`, `modified_date`, `social_id`, `longitude`, `latitude`) VALUES
(1, '7737147647', 'test@test.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Sadhu', '0000-00-00', '', 1, 'Gachadipati Acharya Shri Maniprabhsagarsuriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(2, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Upadhyay Shri Manogyasagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(3, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Muktiprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(4, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Manishprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(5, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Mayankprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(6, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Manitprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(7, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Mehulprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(8, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Maunprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(9, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Mokshprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(10, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Maitriprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(11, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Mananprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(12, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Kalpagyasagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(13, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Nayagyasagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(14, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Samayprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(15, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Viraktprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(16, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Shreyansprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(17, '', '', '', 'Sadhu', '0000-00-00', '', 1, 'Shri Malayprabhsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(18, '', '', '', 'Sadhu', '0000-00-00', '', 2, 'Shri Maniratnsagarji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(19, '', '', '', 'Sadhvi', '0000-00-00', '', 3, 'Shri Divyaprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(20, '', '', '', 'Sadhvi', '0000-00-00', '', 3, 'Shri Vishalprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(21, '', '', '', 'Sadhvi', '0000-00-00', '', 3, 'Shri Dakshagunashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(22, '', '', '', 'Sadhvi', '0000-00-00', '', 3, 'Shri Mayanrehashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(23, '', '', '', 'Sadhvi', '0000-00-00', '', 3, 'Shri Viragjyotishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(24, '', '', '', 'Sadhvi', '0000-00-00', '', 3, 'Shri Vishwayotishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(25, '', '', '', 'Sadhvi', '0000-00-00', '', 3, 'Shri Jinjyotishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(26, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Sashiprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(27, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Priyadarshanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(28, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Divyadarshanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(29, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Tatvadarshanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(30, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Samyakdarshanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(31, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Muditpragyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(32, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Shilgunashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(33, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Soumyagunashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(34, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Kanakprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(35, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Shruthdarshanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(36, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Saiyampragyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(37, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Saiyampragyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(38, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Stithpragyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(39, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Anantadarshanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(40, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Shrudhanvitashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(41, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Samyakprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(42, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Shuklapragyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(43, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Samvegpragyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(44, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Samvarbodhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(45, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Samatvabhodhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(46, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Satvabhodhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(47, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Shudhbodhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(48, '', '', '', 'Sadhvi', '0000-00-00', '', 4, 'Shri Shramanipragyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(49, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Sulochnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(50, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Sulakshanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(51, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Pritisudhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(52, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Pritiyashashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(53, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyasmitashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(54, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyalattashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(55, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyavandanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(56, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyakalpanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(57, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyaranjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(58, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyashraddhanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(59, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyasnehanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(60, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyasomyanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(61, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyadivyanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(62, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyaswaranjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(63, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyaprekshanshnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(64, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyashreyanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(65, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyashrutanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(66, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyashubhajanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(67, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyadarshanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(68, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyagyananjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(69, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyadakshananjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(70, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyashreshtanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(71, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyavarshanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(72, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyameghanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(73, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyavinayanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(74, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyakrutanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(75, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyaviranjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(76, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyachaityanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(77, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyashailanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(78, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyamudranjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(79, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyamantranjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(80, '', '', '', 'Sadhvi', '0000-00-00', '', 5, 'Shri Priyasutranjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(81, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Suryaprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(82, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Purnaprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(83, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Vimalprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(84, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Hemratnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(85, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Harshpragnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(86, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Harshpurnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(87, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Jayratnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(88, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Vishwaratnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(89, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Amitgunashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(90, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Madhurimashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(91, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Manoramashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(92, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Rashmirekhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(93, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Abhinanditashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(94, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Priyananditashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(95, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Samarpitpragnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(96, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Arpitpragnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(97, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Nayanditashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(98, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Charulattashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(99, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Nutanpriyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(100, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Mayurpriyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(101, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Charitrapriyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(102, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Tatvagnalattashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(103, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Sayamlattashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(104, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Preynanditashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(105, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Shreynanditashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(106, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Viralprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(107, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Vipulprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(108, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Virtiprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(109, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Vinamraprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(110, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Vishuddhaprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(111, '', '', '', 'Sadhvi', '0000-00-00', '', 6, 'Shri Vishrutprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(112, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Ratanmalashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(113, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Vidhyutprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(114, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Sashanprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(115, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Nilanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(116, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Pragnanjnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(117, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Diptipragnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(118, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Nitipragnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(119, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Vibhanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(120, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Vigyanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(121, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Nishthanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(122, '', '', '', 'Sadhvi', '0000-00-00', '', 7, 'Shri Aagnanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(123, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Kalplattashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(124, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Priyamvadashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(125, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Amityashashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(126, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Vinityashashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(127, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Shuddhanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(128, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Shraddhanjnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(129, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Yoganjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(130, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Shilanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(131, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Dipmalashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(132, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Dipshikhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(133, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Pramuditashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(134, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Dharmnidhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(135, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Samvegpriyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(136, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Jaypriyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(137, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Kalyanmalashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(138, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Mananpriyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(139, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Parampriyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(140, '', '', '', 'Sadhvi', '0000-00-00', '', 8, 'Shri Bhavyapriyashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(141, '', '', '', 'Sadhvi', '0000-00-00', '', 9, 'Shri Lakshyapurnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(142, '', '', '', 'Sadhvi', '0000-00-00', '', 9, 'Shri Swetanjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(143, '', '', '', 'Sadhvi', '0000-00-00', '', 9, 'Shri Bhavyapurnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(144, '', '', '', 'Sadhvi', '0000-00-00', '', 9, 'Shri Kalppurnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(145, '', '', '', 'Sadhvi', '0000-00-00', '', 9, 'Shri Pragyapurnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(146, '', '', '', 'Sadhvi', '0000-00-00', '', 10, 'Shri Mrudulashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(147, '', '', '', 'Sadhvi', '0000-00-00', '', 10, 'Shri Mitranjanashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(148, '', '', '', 'Sadhvi', '0000-00-00', '', 10, 'Shri Samdarshitashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(149, '', '', '', 'Sadhvi', '0000-00-00', '', 10, 'Shri Vairagyanidhiji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(150, '', '', '', 'Sadhvi', '0000-00-00', '', 10, 'Shri Jaynashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(151, '', '', '', 'Sadhvi', '0000-00-00', '', 11, 'Shri Snehyshashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(152, '', '', '', 'Sadhvi', '0000-00-00', '', 11, 'Shri Ratnanidhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(153, '', '', '', 'Sadhvi', '0000-00-00', '', 11, 'Shri Yashonidhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(154, '', '', '', 'Sadhvi', '0000-00-00', '', 11, 'Shri Siddhantnidhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(155, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Sanghmitrashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(156, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Abhyudayashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(157, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Amijharashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(158, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Amipurnashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(159, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Swarnodayashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(160, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Satvodayashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(161, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Darshanprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(162, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Gyanprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(163, '', '', '', 'Sadhvi', '0000-00-00', '', 12, 'Shri Charitraprabhashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(164, '', '', '', 'Sadhvi', '0000-00-00', '', 13, 'Shri Bhagyodayashriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(165, '', '', '', 'Sadhvi', '0000-00-00', '', 13, 'Shri Prashmanidhishriji M.S.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(166, NULL, 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', NULL, NULL, NULL, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(250) NOT NULL,
  `event_description` longtext NOT NULL,
  `event_date_time` varchar(150) NOT NULL,
  `event_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_description`, `event_date_time`, `event_time`) VALUES
(1, '', '', '', ''),
(2, 'test', 'adf sdf', '03/15/2016 12:00 AM - 03/15/2016 11:59 PM', '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gallery_id` varchar(150) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gallery_id`, `title`) VALUES
(3, '1457082903', 'dsfdf');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `gallery_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_id`, `gallery_image`) VALUES
(14, 1457521347, '1457521347-kisan-maha-sammelan-2.png'),
(16, 1457082903, '1457082903-kisan-maha-sammelan-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(200) DEFAULT NULL,
  `group_head` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `group_head`, `created_date`) VALUES
(1, 'Gachadipati Acharya Shri Maniprabhsagarsuriji M.S.', 1, '0000-00-00 00:00:00'),
(2, 'Acharya Jinmahodaysagarji M.S.', 18, '0000-00-00 00:00:00'),
(3, 'Pavitra Mandal', 19, '0000-00-00 00:00:00'),
(4, 'Sajjan Mandal', 26, '0000-00-00 00:00:00'),
(5, 'Prem Mandal', 49, '0000-00-00 00:00:00'),
(6, 'Champa Mandal', 81, '0000-00-00 00:00:00'),
(7, 'Pramod Mandal', 112, '0000-00-00 00:00:00'),
(8, 'Hemprabha Mandal', 123, '0000-00-00 00:00:00'),
(9, 'Mahendra Mandal', 141, '0000-00-00 00:00:00'),
(10, 'Vichakshan Mandal', 146, '0000-00-00 00:00:00'),
(11, 'Nipunashriji Mandal', 151, '0000-00-00 00:00:00'),
(12, 'Manohar Mandal', 155, '0000-00-00 00:00:00'),
(13, 'Jinshriji Mandal', 164, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `location_sadhu`
--

CREATE TABLE `location_sadhu` (
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `longs` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `panchang`
--

CREATE TABLE `panchang` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `weekday` varchar(150) NOT NULL,
  `lunar_year` year(4) NOT NULL,
  `lunar_month` varchar(150) NOT NULL,
  `lunar_tithi` int(11) NOT NULL,
  `shubh_din` enum('Yes','No') NOT NULL,
  `lunar_cycle` enum('Krushna','Shukla') NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panchang`
--

INSERT INTO `panchang` (`id`, `date`, `weekday`, `lunar_year`, `lunar_month`, `lunar_tithi`, `shubh_din`, `lunar_cycle`, `description`) VALUES
(2, '2015-11-12', 'Thursday', 2072, 'Karthik', 1, 'No', 'Shukla', 'Nutan Varsh Prarambh'),
(3, '2015-11-13', 'Friday', 2072, 'Karthik', 2, 'Yes', 'Shukla', ''),
(4, '2015-11-14', 'Saturday', 2072, 'Karthik', 3, 'No', 'Shukla', 'Shri Suvidhinath - Kevalgyan Kalyanak'),
(5, '2015-11-15', 'Sunday', 2072, 'Karthik', 4, 'Yes', 'Shukla', ''),
(6, '2015-11-16', 'Monday', 2072, 'Karthik', 5, 'Yes', 'Shukla', 'Gyan Panchami'),
(7, '2015-11-17', 'Tuesday', 2072, 'Karthik', 6, 'No', 'Shukla', ''),
(8, '2015-11-18', 'Wednesday', 2072, 'Karthik', 7, 'Yes', 'Shukla', ''),
(9, '2015-11-19', 'Thursday', 2072, 'Karthik', 8, 'No', 'Shukla', ''),
(10, '2015-11-20', 'Friday', 2072, 'Karthik', 9, 'No', 'Shukla', ''),
(11, '2015-11-21', 'Saturday', 2072, 'Karthik', 10, 'No', 'Shukla', ''),
(12, '2015-11-22', 'Sunday', 2072, 'Karthik', 11, 'No', 'Shukla', ''),
(13, '2015-11-23', 'Monday', 2072, 'Karthik', 12, 'Yes', 'Shukla', 'Shri Arnath - Kevalgyan Kalyanak'),
(14, '2015-11-24', 'Tuesday', 2072, 'Karthik', 13, 'Yes', 'Shukla', ''),
(15, '2015-11-25', 'Wednesday', 2072, 'Karthik', 14, 'No', 'Shukla', 'Choumasi Pratikraman'),
(17, '2015-11-26', 'Thursday', 2072, 'Margshirsh', 1, 'No', 'Krushna', ''),
(18, '2015-11-27', 'Friday', 2072, 'Margshirsh', 2, 'Yes', 'Krushna', ''),
(19, '2015-11-28', 'Saturday', 2072, 'Margshirsh', 3, 'No', 'Krushna', 'Dada Jinkushalsuri - Janmtithi'),
(20, '2015-11-29', 'Sunday', 2072, 'Margshirsh', 4, 'Yes', 'Krushna', ''),
(21, '2015-11-30', 'Monday', 2072, 'Margshirsh', 5, 'Yes', 'Krushna', 'Shri Suvidhinath - Janm Kalyanak'),
(22, '2015-12-01', 'Tuesday', 2072, 'Margshirsh', 6, 'No', 'Krushna', 'Shri Suvidhinath - Diksha Kalyanak'),
(23, '2015-12-02', 'Wednesday', 2072, 'Margshirsh', 7, 'Yes', 'Krushna', 'Acharya Jinkantisagarsuri Punyatithi'),
(24, '2015-12-03', 'Thursday', 2072, 'Margshirsh', 8, 'No', 'Krushna', ''),
(25, '2015-12-04', 'Friday', 2072, 'Margshirsh', 9, 'No', 'Krushna', ''),
(26, '2015-12-05', 'Saturday', 2072, 'Margshirsh', 10, 'No', 'Krushna', 'Shri Mahaveerswami - Diksha Kalyanak'),
(27, '2015-12-06', 'Sunday', 2072, 'Margshirsh', 10, 'Yes', 'Krushna', ''),
(28, '2015-12-07', 'Monday', 2072, 'Margshirsh', 11, 'Yes', 'Krushna', 'Shri Padmaprabhswami - Moksh Kalyanak'),
(29, '2015-12-08', 'Tuesday', 2072, 'Margshirsh', 12, 'No', 'Krushna', ''),
(30, '2015-12-09', 'Wednesday', 2072, 'Margshirsh', 13, 'No', 'Krushna', ''),
(31, '2015-12-10', 'Thursday', 2072, 'Margshirsh', 14, 'No', 'Krushna', 'Pakshik Pratikraman'),
(32, '2015-12-11', 'Friday', 2072, 'Margshirsh', 30, 'No', 'Krushna', ''),
(33, '2015-12-12', 'Saturday', 2072, 'Margshirsh', 1, 'No', 'Shukla', ''),
(34, '2015-12-13', 'Sunday', 2072, 'Margshirsh', 2, 'No', 'Shukla', ''),
(35, '2015-12-14', 'Monday', 2072, 'Margshirsh', 3, 'Yes', 'Shukla', ''),
(36, '2015-12-15', 'Tuesday', 2072, 'Margshirsh', 4, 'No', 'Shukla', ''),
(37, '2015-12-16', 'Wednesday', 2072, 'Margshirsh', 5, 'No', 'Shukla', ''),
(38, '2015-12-17', 'Thursday', 2072, 'Margshirsh', 6, 'No', 'Shukla', ''),
(39, '2015-12-18', 'Friday', 2072, 'Margshirsh', 7, 'No', 'Shukla', ''),
(40, '2015-12-19', 'Saturday', 2072, 'Margshirsh', 8, 'No', 'Shukla', ''),
(42, '2015-12-20', 'Sunday', 2072, 'Margshirsh', 10, 'No', 'Shukla', 'Shri Arnath - Janm Kalyanak; Shri Arnath - Moksh Kalyanak'),
(43, '2015-12-21', 'Monday', 2072, 'Margshirsh', 11, 'Yes', 'Shukla', 'Moun Ekadasi; Shri Arnath - Diksha Kalyanak; Shri Mallinath - Janm Kalyanak; Shri Mallinath - Diksha Kalyanak; Shri Mallinath - Kevalgyan Kalyanak; Shri Naminath - Kevalgyan Kalyanak'),
(44, '2015-12-22', 'Tuesday', 2072, 'Margshirsh', 12, 'No', 'Shukla', ''),
(45, '2015-12-23', 'Wednesday', 2072, 'Margshirsh', 13, 'No', 'Shukla', ''),
(46, '2015-12-24', 'Thursday', 2072, 'Margshirsh', 14, 'No', 'Shukla', 'Pakshik Pratikraman; Shri Sambhavnath - Janm Kalyanak'),
(47, '2015-12-25', 'Friday', 2072, 'Margshirsh', 15, 'Yes', 'Shukla', 'Shri Sambhavnath - Diksha Kalyanak'),
(48, '2015-12-26', 'Saturday', 2072, 'Posh', 1, 'No', 'Krushna', ''),
(49, '2015-12-27', 'Sunday', 2072, 'Posh', 2, 'Yes', 'Krushna', ''),
(50, '2015-12-28', 'Monday', 2072, 'Posh', 3, 'Yes', 'Krushna', ''),
(51, '2015-12-29', 'Tuesday', 2072, 'Posh', 4, 'No', 'Krushna', ''),
(52, '2015-12-30', 'Wednesday', 2072, 'Posh', 5, 'Yes', 'Krushna', ''),
(53, '2015-12-31', 'Thursday', 2072, 'Posh', 6, 'No', 'Krushna', ''),
(54, '2016-01-01', 'Friday', 2072, 'Posh', 7, 'Yes', 'Krushna', ''),
(55, '2016-01-02', 'Saturday', 2072, 'Posh', 8, 'No', 'Krushna', ''),
(56, '2016-01-03', 'Sunday', 2072, 'Posh', 9, 'Yes', 'Krushna', ''),
(57, '2016-01-04', 'Monday', 2072, 'Posh', 10, 'Yes', 'Krushna', 'Posh Dasami - Shri Parshvanath - Janm Kalyanak'),
(58, '2016-01-05', 'Tuesday', 2072, 'Posh', 11, 'No', 'Krushna', 'Shri Parshvanath - Diksha Kalyanak'),
(59, '2016-01-06', 'Wednesday', 2072, 'Posh', 12, 'Yes', 'Krushna', 'Shri Chandraprabhswami - Janm Kalyanak'),
(60, '2016-01-07', 'Thursday', 2072, 'Posh', 12, 'No', 'Krushna', ''),
(61, '2016-01-08', 'Friday', 2072, 'Posh', 13, 'No', 'Krushna', 'Shri Chandraprabhswami - Diksha Kalyanak'),
(62, '2016-01-09', 'Saturday', 2072, 'Posh', 14, 'No', 'Krushna', 'Pakshik Pratikraman; Shri Shitalnath - Kevalgyan Kalyanak'),
(64, '2016-01-10', 'Sunday', 2072, 'Posh', 1, 'No', 'Shukla', ''),
(65, '2016-01-11', 'Monday', 2072, 'Posh', 2, 'Yes', 'Shukla', ''),
(66, '2016-01-12', 'Tuesday', 2072, 'Posh', 3, 'No', 'Shukla', ''),
(67, '2016-01-13', 'Wednesday', 2072, 'Posh', 4, 'No', 'Shukla', ''),
(68, '2016-01-14', 'Thursday', 2072, 'Posh', 5, 'Yes', 'Shukla', ''),
(69, '2016-01-15', 'Friday', 2072, 'Posh', 6, 'Yes', 'Shukla', 'Shri Vimalnath - Kevalgyan Kalyanak'),
(70, '2016-01-16', 'Saturday', 2072, 'Posh', 7, 'Yes', 'Shukla', ''),
(71, '2016-01-17', 'Sunday', 2072, 'Posh', 8, 'No', 'Shukla', ''),
(72, '2016-01-18', 'Monday', 2072, 'Posh', 9, 'No', 'Shukla', 'Shri Shantinath - Kevalgyan Kalyanak'),
(73, '2016-01-19', 'Tuesday', 2072, 'Posh', 10, 'No', 'Shukla', ''),
(74, '2016-01-20', 'Wednesday', 2072, 'Posh', 11, 'Yes', 'Shukla', 'Shri Ajitnath - Kevalgyan Kalyanak'),
(75, '2016-01-21', 'Thursday', 2072, 'Posh', 12, 'Yes', 'Shukla', ''),
(76, '2016-01-22', 'Friday', 2072, 'Posh', 13, 'No', 'Shukla', 'Shri Abhinandanswami - Kevalgyan Kalyanak'),
(78, '2016-01-23', 'Saturday', 2072, 'Posh', 15, 'No', 'Shukla', 'Pakshik Pratikraman; Shri Dharmanath - Kevalgyan Kalyanak'),
(79, '2016-01-24', 'Sunday', 2072, 'Magh', 1, 'Yes', 'Krushna', ''),
(80, '2016-01-25', 'Monday', 2072, 'Magh', 1, 'No', 'Krushna', ''),
(81, '2016-01-26', 'Tuesday', 2072, 'Magh', 2, 'No', 'Krushna', ''),
(82, '2016-01-27', 'Wednesday', 2072, 'Magh', 3, 'No', 'Krushna', ''),
(83, '2016-01-28', 'Thursday', 2072, 'Magh', 4, 'No', 'Krushna', ''),
(84, '2016-01-29', 'Friday', 2072, 'Magh', 5, 'Yes', 'Krushna', ''),
(85, '2016-01-30', 'Saturday', 2072, 'Magh', 6, 'Yes', 'Krushna', 'Shri Padmaprabhswami - Chyavan Kalyanak'),
(86, '2016-01-31', 'Sunday', 2072, 'Magh', 7, 'Yes', 'Krushna', ''),
(87, '2016-02-01', 'Monday', 2072, 'Magh', 8, 'No', 'Krushna', ''),
(88, '2016-02-02', 'Tuesday', 2072, 'Magh', 9, 'No', 'Krushna', ''),
(89, '2016-02-03', 'Wednesday', 2072, 'Magh', 10, 'Yes', 'Krushna', ''),
(90, '2016-02-04', 'Thursday', 2072, 'Magh', 11, 'No', 'Krushna', ''),
(91, '2016-02-05', 'Friday', 2072, 'Magh', 12, 'Yes', 'Krushna', 'Shri Shitalnath - Janm Kalyanak; Shri Shitalnath - Diksha Kalyanak'),
(92, '2016-02-06', 'Saturday', 2072, 'Magh', 13, 'Yes', 'Krushna', 'Shri Adinath - Moksh Kalyanak'),
(93, '2016-02-07', 'Sunday', 2072, 'Magh', 14, 'No', 'Krushna', 'Pakshik Pratikraman'),
(94, '2016-02-08', 'Monday', 2072, 'Magh', 30, 'No', 'Krushna', 'Shri Shreyanshnath - Kevalgyan Kalyanak'),
(95, '2016-02-09', 'Tuesday', 2072, 'Magh', 1, 'No', 'Shukla', ''),
(96, '2016-02-10', 'Wednesday', 2072, 'Magh', 2, 'Yes', 'Shukla', 'Shri Abhinandanswami - Janm Kalyanak; Shri Vasupujya - Kevalgyan Kalyanak'),
(97, '2016-02-11', 'Thursday', 2072, 'Magh', 3, 'No', 'Shukla', 'Shri Dharmanath - Janm Kalyanak; Shri Vimalnath - Janm Kalyanak'),
(98, '2016-02-12', 'Friday', 2072, 'Magh', 4, 'No', 'Shukla', 'Shri Vimalnath - Diksha Kalyanak'),
(100, '2016-02-13', 'Saturday', 2072, 'Magh', 6, 'Yes', 'Shukla', ''),
(101, '2016-02-14', 'Sunday', 2072, 'Magh', 7, 'No', 'Shukla', ''),
(102, '2016-02-15', 'Monday', 2072, 'Magh', 8, 'No', 'Shukla', 'Shri Ajitnath - Janm Kalyanak'),
(103, '2016-02-16', 'Tuesday', 2072, 'Magh', 9, 'No', 'Shukla', 'Shri Ajitnath - Diksha Kalyanak'),
(104, '2016-02-17', 'Wednesday', 2072, 'Magh', 10, 'Yes', 'Shukla', ''),
(105, '2016-02-18', 'Thursday', 2072, 'Magh', 11, 'No', 'Shukla', ''),
(106, '2016-02-19', 'Friday', 2072, 'Magh', 12, 'Yes', 'Shukla', 'Shri Abhinandanswami - Diksha Kalyanak'),
(107, '2016-02-20', 'Saturday', 2072, 'Magh', 13, 'Yes', 'Shukla', 'Shri Dharmanath - Diksha Kalyanak'),
(108, '2016-02-21', 'Sunday', 2072, 'Magh', 14, 'No', 'Shukla', 'Pakshik Pratikraman'),
(109, '2016-02-22', 'Monday', 2072, 'Magh', 15, 'No', 'Shukla', ''),
(110, '2016-02-23', 'Tuesday', 2072, 'Falgun', 1, 'No', 'Krushna', ''),
(111, '2016-02-24', 'Wednesday', 2072, 'Falgun', 2, 'Yes', 'Krushna', ''),
(112, '2016-02-25', 'Thursday', 2072, 'Falgun', 3, 'No', 'Krushna', ''),
(113, '2016-02-26', 'Friday', 2072, 'Falgun', 4, 'No', 'Krushna', ''),
(114, '2016-02-27', 'Saturday', 2072, 'Falgun', 4, 'Yes', 'Krushna', ''),
(115, '2016-02-28', 'Sunday', 2072, 'Falgun', 5, 'Yes', 'Krushna', ''),
(116, '2016-02-29', 'Monday', 2072, 'Falgun', 6, 'No', 'Krushna', 'Shri Suparshwanath - Kevalgyan Kalyanak'),
(117, '2016-03-01', 'Tuesday', 2072, 'Falgun', 7, 'No', 'Krushna', 'Shri Suparshwanath - Moksh Kalyanak; Shri Chandraprabhswami - Kevalgyan Kalyanak'),
(118, '2016-03-02', 'Wednesday', 2072, 'Falgun', 8, 'No', 'Krushna', ''),
(119, '2016-03-03', 'Thursday', 2072, 'Falgun', 9, 'No', 'Krushna', 'Shri Suvidhinath - Chyavan Kalyanak'),
(120, '2016-03-04', 'Friday', 2072, 'Falgun', 10, 'No', 'Krushna', ''),
(121, '2016-03-05', 'Saturday', 2072, 'Falgun', 11, 'Yes', 'Krushna', 'Shri Adinath - Kevalgyan Kalyanak'),
(122, '2016-03-06', 'Sunday', 2072, 'Falgun', 12, 'No', 'Krushna', 'Shri Shreyanshnath - Janm Kalyanak; Shri Munisuvratswami - Kevalgyan Kalyanak'),
(123, '2016-03-07', 'Monday', 2072, 'Falgun', 13, 'Yes', 'Krushna', 'Shri Shreyanshnath - Diksha Kalyanak'),
(124, '2016-03-08', 'Tuesday', 2072, 'Falgun', 14, 'No', 'Krushna', 'Pakshik Pratikraman; Shri Vasupujyaswami - Janm Kalyanak'),
(125, '2016-03-09', 'Wednesday', 2072, 'Falgun', 30, 'No', 'Krushna', 'Shri Vasupujyaswami - Diksha Kalyanak; Dada Jinkushalsuri - Punyatithi'),
(127, '2016-03-10', 'Thursday', 2072, 'Falgun', 2, 'No', 'Shukla', 'Shri Arnath - Chyavan Kalyanak'),
(128, '2016-03-11', 'Friday', 2072, 'Falgun', 3, 'Yes', 'Shukla', ''),
(129, '2016-03-12', 'Saturday', 2072, 'Falgun', 4, 'Yes', 'Shukla', 'Shri Mallinath - Chyavan Kalyanak'),
(130, '2016-03-13', 'Sunday', 2072, 'Falgun', 5, 'No', 'Shukla', ''),
(131, '2016-03-14', 'Monday', 2072, 'Falgun', 6, 'No', 'Shukla', ''),
(132, '2016-03-15', 'Tuesday', 2072, 'Falgun', 7, 'No', 'Shukla', ''),
(133, '2016-03-16', 'Wednesday', 2072, 'Falgun', 8, 'No', 'Shukla', 'Shri Sambhavnath - Chyavan Kalyanak'),
(134, '2016-03-17', 'Thursday', 2072, 'Falgun', 9, 'No', 'Shukla', ''),
(135, '2016-03-18', 'Friday', 2072, 'Falgun', 10, 'Yes', 'Shukla', ''),
(136, '2016-03-19', 'Saturday', 2072, 'Falgun', 11, 'Yes', 'Shukla', ''),
(137, '2016-03-20', 'Sunday', 2072, 'Falgun', 12, 'No', 'Shukla', 'Shri Mallinath - Moksh Kalyanak; Shri Munisuvratswami - Diksha Kalyanak'),
(138, '2016-03-21', 'Monday', 2072, 'Falgun', 13, 'Yes', 'Shukla', ''),
(139, '2016-03-22', 'Tuesday', 2072, 'Falgun', 14, 'No', 'Shukla', 'Choumasi Pratikraman'),
(140, '2016-03-23', 'Wednesday', 2072, 'Falgun', 15, 'Yes', 'Shukla', ''),
(141, '2016-03-24', 'Thursday', 2072, 'Chaitra', 1, 'No', 'Krushna', ''),
(142, '2016-03-25', 'Friday', 2072, 'Chaitra', 2, 'Yes', 'Krushna', ''),
(143, '2016-03-26', 'Saturday', 2072, 'Chaitra', 3, 'Yes', 'Krushna', ''),
(144, '2016-03-27', 'Sunday', 2072, 'Chaitra', 4, 'No', 'Krushna', 'Shri Parshvanath - Chyavan Kalyanak; Shri Parshvanath - Kevalgyan Kalyanak'),
(145, '2016-03-28', 'Monday', 2072, 'Chaitra', 5, 'No', 'Krushna', 'Shri Chandraprabhswami - Chyavan Kalyanak'),
(146, '2016-03-29', 'Tuesday', 2072, 'Chaitra', 6, 'No', 'Krushna', ''),
(147, '2016-03-30', 'Wednesday', 2072, 'Chaitra', 6, 'No', 'Krushna', ''),
(148, '2016-03-31', 'Thursday', 2072, 'Chaitra', 7, 'Yes', 'Krushna', ''),
(149, '2016-04-01', 'Friday', 2072, 'Chaitra', 8, 'No', 'Krushna', 'Shri Adinath - Janm Kalyanak; Shri Adinath - Diksha Kalyanak'),
(150, '2016-04-02', 'Saturday', 2072, 'Chaitra', 9, 'Yes', 'Krushna', ''),
(151, '2016-04-03', 'Sunday', 2072, 'Chaitra', 10, 'No', 'Krushna', ''),
(153, '2016-04-04', 'Monday', 2072, 'Chaitra', 12, 'No', 'Krushna', ''),
(154, '2016-04-05', 'Tuesday', 2072, 'Chaitra', 13, 'Yes', 'Krushna', ''),
(155, '2016-04-06', 'Wednesday', 2072, 'Chaitra', 14, 'No', 'Krushna', 'Pakshik Pratikraman'),
(156, '2016-04-07', 'Thursday', 2072, 'Chaitra', 30, 'No', 'Krushna', ''),
(157, '2016-04-08', 'Friday', 2073, 'Chaitra', 1, 'Yes', 'Shukla', ''),
(158, '2016-04-09', 'Saturday', 2073, 'Chaitra', 2, 'No', 'Shukla', 'Shri Kunthunath - Kevalgyan Kalyanak'),
(160, '2016-04-10', 'Sunday', 2073, 'Chaitra', 4, 'No', 'Shukla', ''),
(161, '2016-04-11', 'Monday', 2073, 'Chaitra', 5, 'Yes', 'Shukla', 'Shri Ajitnath - Moksh Kalyanak; Shri Sambhavnath - Moksh Kalyanak; Shri Anantnath - Moksh Kalyanak'),
(162, '2016-04-12', 'Tuesday', 2073, 'Chaitra', 6, 'No', 'Shukla', ''),
(163, '2016-04-13', 'Wednesday', 2073, 'Chaitra', 7, 'No', 'Shukla', ''),
(164, '2016-04-14', 'Thursday', 2073, 'Chaitra', 8, 'Yes', 'Shukla', 'Navpad Oli Prarambh'),
(165, '2016-04-15', 'Friday', 2073, 'Chaitra', 9, 'Yes', 'Shukla', 'Shri Sumatinath - Moksh Kalyanak'),
(166, '2016-04-16', 'Saturday', 2073, 'Chaitra', 10, 'No', 'Shukla', ''),
(167, '2016-04-17', 'Sunday', 2073, 'Chaitra', 11, 'Yes', 'Shukla', 'Shri Sumatinath - Kevalgyan Kalyanak'),
(168, '2016-04-18', 'Monday', 2073, 'Chaitra', 12, 'No', 'Shukla', ''),
(169, '2016-04-19', 'Tuesday', 2073, 'Chaitra', 13, 'No', 'Shukla', 'Mahaveer Jayanthi - Shri Mahaveerswami - Janm Kalyanak'),
(170, '2016-04-20', 'Wednesday', 2073, 'Chaitra', 14, 'No', 'Shukla', 'Pakshik Pratikraman'),
(171, '2016-04-21', 'Thursday', 2073, 'Chaitra', 14, 'No', 'Shukla', ''),
(172, '2016-04-22', 'Friday', 2073, 'Chaitra', 15, 'Yes', 'Shukla', 'Navapad Oli Samapan; Shri Padmaprabhswami - Kevalgyan Kalyanak'),
(173, '2016-04-23', 'Saturday', 2073, 'Vaishakh', 1, 'Yes', 'Krushna', 'Shri Kunthunath - Moksh Kalyanak'),
(174, '2016-04-24', 'Sunday', 2073, 'Vaishakh', 2, 'No', 'Krushna', 'Shri Shitalnath - Moksh Kalyanak'),
(175, '2016-04-25', 'Monday', 2073, 'Vaishakh', 3, 'Yes', 'Krushna', ''),
(176, '2016-04-26', 'Tuesday', 2073, 'Vaishakh', 4, 'No', 'Krushna', ''),
(177, '2016-04-27', 'Wednesday', 2073, 'Vaishakh', 5, 'No', 'Krushna', 'Shri Kunthunath - Diksha Kalyanak'),
(178, '2016-04-28', 'Thursday', 2073, 'Vaishakh', 6, 'No', 'Krushna', 'Shri Shitalnath - Chyavan Kalyanak'),
(179, '2016-04-29', 'Friday', 2073, 'Vaishakh', 7, 'Yes', 'Krushna', ''),
(180, '2016-04-30', 'Saturday', 2073, 'Vaishakh', 8, 'No', 'Krushna', ''),
(181, '2016-05-01', 'Sunday', 2073, 'Vaishakh', 9, 'No', 'Krushna', ''),
(182, '2016-05-02', 'Monday', 2073, 'Vaishakh', 10, 'Yes', 'Krushna', 'Shri Naminath - Moksh Kalyanak'),
(183, '2016-05-03', 'Tuesday', 2073, 'Vaishakh', 11, 'No', 'Krushna', ''),
(184, '2016-05-04', 'Wednesday', 2073, 'Vaishakh', 12, 'Yes', 'Krushna', ''),
(185, '2016-05-05', 'Thursday', 2073, 'Vaishakh', 13, 'No', 'Krushna', 'Shri Anantnath - Janm Kalyanak'),
(187, '2016-05-06', 'Friday', 2073, 'Vaishakh', 30, 'No', 'Krushna', 'Pakshik Pratikraman'),
(188, '2016-05-07', 'Saturday', 2073, 'Vaishakh', 1, 'No', 'Shukla', ''),
(189, '2016-05-08', 'Sunday', 2073, 'Vaishakh', 2, 'No', 'Shukla', ''),
(190, '2016-05-09', 'Monday', 2073, 'Vaishakh', 3, 'Yes', 'Shukla', 'Akshay Trutya'),
(191, '2016-05-10', 'Tuesday', 2073, 'Vaishakh', 4, 'No', 'Shukla', 'Shri Abhinandanswami - Chyavan Kalyanak'),
(192, '2016-05-11', 'Wednesday', 2073, 'Vaishakh', 5, 'No', 'Shukla', ''),
(193, '2016-05-12', 'Thursday', 2073, 'Vaishakh', 6, 'Yes', 'Shukla', ''),
(194, '2016-05-13', 'Friday', 2073, 'Vaishakh', 7, 'Yes', 'Shukla', 'Shri Dharmanath - Chyavan Kalyanak'),
(195, '2016-05-14', 'Saturday', 2073, 'Vaishakh', 8, 'No', 'Shukla', 'Shri Abhinandanswami - Moksh Kalyanak; Shri Sumatinath - Janm Kalyanak'),
(196, '2016-05-15', 'Sunday', 2073, 'Vaishakh', 9, 'Yes', 'Shukla', 'Shri Sumatinath - Diksha Kalyanak'),
(197, '2016-05-16', 'Monday', 2073, 'Vaishakh', 10, 'No', 'Shukla', 'Shri Mahaveerswami - Kevalgyan Kalyanak'),
(198, '2016-05-17', 'Tuesday', 2073, 'Vaishakh', 11, 'No', 'Shukla', ''),
(199, '2016-05-18', 'Wednesday', 2073, 'Vaishakh', 12, 'Yes', 'Shukla', 'Shri Vimalnath - Chyavan Kalyanak'),
(200, '2016-05-19', 'Thursday', 2073, 'Vaishakh', 13, 'Yes', 'Shukla', 'Shri Ajitnath - Chyavan Kalyanak'),
(201, '2016-05-20', 'Friday', 2073, 'Vaishakh', 14, 'Yes', 'Shukla', 'Pakshik Pratikraman'),
(202, '2016-05-21', 'Saturday', 2073, 'Vaishakh', 15, 'No', 'Shukla', ''),
(203, '2016-05-22', 'Sunday', 2073, 'Jyesht', 1, 'No', 'Krushna', ''),
(204, '2016-05-23', 'Monday', 2073, 'Jyesht', 2, 'No', 'Krushna', ''),
(205, '2016-05-24', 'Tuesday', 2073, 'Jyesht', 3, 'No', 'Krushna', ''),
(206, '2016-05-25', 'Wednesday', 2073, 'Jyesht', 3, 'No', 'Krushna', ''),
(207, '2016-05-26', 'Thursday', 2073, 'Jyesht', 4, 'No', 'Krushna', ''),
(208, '2016-05-27', 'Friday', 2073, 'Jyesht', 5, 'Yes', 'Krushna', ''),
(209, '2016-05-28', 'Saturday', 2073, 'Jyesht', 6, 'No', 'Krushna', 'Shri Shreyansnath - Chyavan Kalyanak'),
(210, '2016-05-29', 'Sunday', 2073, 'Jyesht', 7, 'No', 'Krushna', ''),
(212, '2016-05-30', 'Monday', 2073, 'Jyesht', 9, 'No', 'Krushna', 'Shri Munisvratswami - Moksh Kalyanak'),
(213, '2016-05-31', 'Tuesday', 2073, 'Jyesht', 10, 'No', 'Krushna', ''),
(214, '2016-06-01', 'Wednesday', 2073, 'Jyesht', 11, 'Yes', 'Krushna', ''),
(215, '2016-06-02', 'Thursday', 2073, 'Jyesht', 12, 'Yes', 'Krushna', ''),
(216, '2016-06-03', 'Friday', 2073, 'Jyesht', 13, 'No', 'Krushna', 'Shri Shantinath - Janm Kalyanak; Shri Shantinath - Moksh Kalyanak'),
(217, '2016-06-04', 'Saturday', 2073, 'Jyesht', 14, 'Yes', 'Krushna', 'Pakshik Pratikraman; Shri Shantinath - Diksha Kalyanak'),
(218, '2016-06-05', 'Sunday', 2073, 'Jyesht', 30, 'No', 'Krushna', ''),
(220, '2016-06-06', 'Monday', 2073, 'Jyesht', 2, 'Yes', 'Shukla', ''),
(221, '2016-06-07', 'Tuesday', 2073, 'Jyesht', 3, 'No', 'Shukla', ''),
(222, '2016-06-08', 'Wednesday', 2073, 'Jyesht', 4, 'No', 'Shukla', ''),
(223, '2016-06-09', 'Thursday', 2073, 'Jyesht', 5, 'Yes', 'Shukla', 'Shri Dharmanath - Moksh Kalyanak'),
(224, '2016-06-10', 'Friday', 2073, 'Jyesht', 6, 'Yes', 'Shukla', ''),
(225, '2016-06-11', 'Saturday', 2073, 'Jyesht', 7, 'Yes', 'Shukla', ''),
(226, '2016-06-12', 'Sunday', 2073, 'Jyesht', 8, 'No', 'Shukla', ''),
(227, '2016-06-13', 'Monday', 2073, 'Jyesht', 9, 'No', 'Shukla', 'Shri Vasupujyaswami - Chyavan Kalyanak'),
(228, '2016-06-14', 'Tuesday', 2073, 'Jyesht', 10, 'No', 'Shukla', ''),
(229, '2016-06-15', 'Wednesday', 2073, 'Jyesht', 10, 'Yes', 'Shukla', ''),
(230, '2016-06-16', 'Thursday', 2073, 'Jyesht', 11, 'Yes', 'Shukla', ''),
(231, '2016-06-17', 'Friday', 2073, 'Jyesht', 12, 'No', 'Shukla', 'Shri Suparshwanath - Janm Kalyanak'),
(232, '2016-06-18', 'Saturday', 2073, 'Jyesht', 13, 'No', 'Shukla', 'Shri Suparshwanath - Diksha Kalyanak'),
(233, '2016-06-19', 'Sunday', 2073, 'Jyesht', 14, 'No', 'Shukla', 'Pakshik Pratikraman'),
(234, '2016-06-20', 'Monday', 2073, 'Jyesht', 15, 'Yes', 'Shukla', ''),
(235, '2016-06-21', 'Tuesday', 2073, 'Ashad', 1, 'No', 'Krushna', 'Aadra Nakshatra Prarambh - Aam Tyag'),
(236, '2016-06-22', 'Wednesday', 2073, 'Ashad', 2, 'Yes', 'Krushna', ''),
(237, '2016-06-23', 'Thursday', 2073, 'Ashad', 3, 'No', 'Krushna', ''),
(238, '2016-06-24', 'Friday', 2073, 'Ashad', 4, 'No', 'Krushna', 'Shri Adinath - Chyavan Kalyanak'),
(239, '2016-06-25', 'Saturday', 2073, 'Ashad', 5, 'No', 'Krushna', ''),
(240, '2016-06-26', 'Sunday', 2073, 'Ashad', 6, 'No', 'Krushna', ''),
(241, '2016-06-27', 'Monday', 2073, 'Ashad', 7, 'Yes', 'Krushna', 'Shri Vimalnath - Moksh Kalyanak'),
(242, '2016-06-28', 'Tuesday', 2073, 'Ashad', 8, 'No', 'Krushna', ''),
(243, '2016-06-29', 'Wednesday', 2073, 'Ashad', 9, 'No', 'Krushna', 'Shri Naminath - Diksha Kalyanak'),
(244, '2016-06-30', 'Thursday', 2073, 'Ashad', 10, 'No', 'Krushna', ''),
(246, '2016-07-01', 'Friday', 2073, 'Ashad', 12, 'No', 'Krushna', ''),
(247, '2016-07-02', 'Saturday', 2073, 'Ashad', 13, 'Yes', 'Krushna', ''),
(248, '2016-07-03', 'Sunday', 2073, 'Ashad', 14, 'Yes', 'Krushna', 'Pakshik Pratikraman'),
(249, '2016-07-04', 'Monday', 2073, 'Ashad', 30, 'No', 'Krushna', ''),
(250, '2016-07-05', 'Tuesday', 2073, 'Ashad', 1, 'No', 'Shukla', ''),
(251, '2016-07-06', 'Wednesday', 2073, 'Ashad', 2, 'Yes', 'Shukla', ''),
(252, '2016-07-07', 'Thursday', 2073, 'Ashad', 3, 'No', 'Shukla', ''),
(253, '2016-07-08', 'Friday', 2073, 'Ashad', 4, 'No', 'Shukla', ''),
(254, '2016-07-09', 'Saturday', 2073, 'Ashad', 5, 'No', 'Shukla', ''),
(255, '2016-07-10', 'Sunday', 2073, 'Ashad', 6, 'No', 'Shukla', 'Shri Mahaveerswami - Chyavan Kalyanak'),
(256, '2016-07-11', 'Monday', 2073, 'Ashad', 7, 'Yes', 'Shukla', ''),
(257, '2016-07-12', 'Tuesday', 2073, 'Ashad', 8, 'No', 'Shukla', 'Shri Neminath - Moksh Kalyanak'),
(258, '2016-07-13', 'Wednesday', 2073, 'Ashad', 9, 'Yes', 'Shukla', ''),
(259, '2016-07-14', 'Thursday', 2073, 'Ashad', 10, 'Yes', 'Shukla', ''),
(260, '2016-07-15', 'Friday', 2073, 'Ashad', 11, 'No', 'Shukla', 'Dada Jinduttsuri - Puyatithi'),
(261, '2016-07-16', 'Saturday', 2073, 'Ashad', 12, 'No', 'Shukla', ''),
(262, '2016-07-17', 'Sunday', 2073, 'Ashad', 13, 'No', 'Shukla', ''),
(263, '2016-07-18', 'Monday', 2073, 'Ashad', 14, 'No', 'Shukla', 'Chaturmas Prarambh - Choumasi Pratikraman; Shri Vasupujyaswami - Moksh Kalyanak'),
(264, '2016-07-19', 'Tuesday', 2073, 'Ashad', 15, 'No', 'Shukla', ''),
(265, '2016-07-20', 'Wednesday', 2073, 'Shravan', 1, 'No', 'Krushna', ''),
(266, '2016-07-21', 'Thursday', 2073, 'Shravan', 2, 'Yes', 'Krushna', ''),
(267, '2016-07-22', 'Friday', 2073, 'Shravan', 3, 'Yes', 'Krushna', 'Shri Shreyansnath - Moksh Kalyanak'),
(268, '2016-07-23', 'Saturday', 2073, 'Shravan', 4, 'Yes', 'Krushna', ''),
(269, '2016-07-24', 'Sunday', 2073, 'Shravan', 5, 'No', 'Krushna', ''),
(270, '2016-07-25', 'Monday', 2073, 'Shravan', 6, 'Yes', 'Krushna', ''),
(271, '2016-07-26', 'Tuesday', 2073, 'Shravan', 7, 'No', 'Krushna', 'Shri Anantnath - Chyavan Kalyanak'),
(272, '2016-07-27', 'Wednesday', 2073, 'Shravan', 8, 'No', 'Krushna', 'Shri Naminath - Janm Kalyanak'),
(273, '2016-07-28', 'Thursday', 2073, 'Shravan', 9, 'No', 'Krushna', 'Shri Kunthunath - Chyavan Kalyanak'),
(274, '2016-07-29', 'Friday', 2073, 'Shravan', 10, 'Yes', 'Krushna', ''),
(275, '2016-07-30', 'Saturday', 2073, 'Shravan', 11, 'Yes', 'Krushna', ''),
(276, '2016-07-31', 'Sunday', 2073, 'Shravan', 12, 'No', 'Krushna', ''),
(278, '2016-08-01', 'Monday', 2073, 'Shravan', 14, 'Yes', 'Krushna', 'Pakshik Pratikraman'),
(279, '2016-08-02', 'Tuesday', 2073, 'Shravan', 30, 'No', 'Krushna', ''),
(280, '2016-08-03', 'Wednesday', 2073, 'Shravan', 1, 'No', 'Shukla', ''),
(281, '2016-08-04', 'Thursday', 2073, 'Shravan', 2, 'Yes', 'Shukla', 'Shri Sumatinath - Chyavan Kalyanak'),
(282, '2016-08-05', 'Friday', 2073, 'Shravan', 3, 'Yes', 'Shukla', ''),
(283, '2016-08-06', 'Saturday', 2073, 'Shravan', 4, 'Yes', 'Shukla', ''),
(284, '2016-08-07', 'Sunday', 2073, 'Shravan', 5, 'No', 'Shukla', 'Shri Neminath - Janm Kalyanak'),
(285, '2016-08-08', 'Monday', 2073, 'Shravan', 6, 'No', 'Shukla', 'Shri Neminath - Diksha Kalyanak'),
(286, '2016-08-09', 'Tuesday', 2073, 'Shravan', 6, 'No', 'Shukla', ''),
(287, '2016-08-10', 'Wednesday', 2073, 'Shravan', 7, 'Yes', 'Shukla', ''),
(288, '2016-08-11', 'Thursday', 2073, 'Shravan', 8, 'No', 'Shukla', 'Shri Parshwanath - Moksh Kalyanak'),
(289, '2016-08-12', 'Friday', 2073, 'Shravan', 9, 'Yes', 'Shukla', ''),
(290, '2016-08-13', 'Saturday', 2073, 'Shravan', 10, 'No', 'Shukla', ''),
(291, '2016-08-14', 'Sunday', 2073, 'Shravan', 11, 'Yes', 'Shukla', ''),
(292, '2016-08-15', 'Monday', 2073, 'Shravan', 12, 'No', 'Shukla', ''),
(293, '2016-08-16', 'Tuesday', 2073, 'Shravan', 13, 'Yes', 'Shukla', ''),
(294, '2016-08-17', 'Wednesday', 2073, 'Shravan', 14, 'No', 'Shukla', 'Pakshik Pratikraman'),
(295, '2016-08-18', 'Thursday', 2073, 'Shravan', 15, 'Yes', 'Shukla', 'Shri Munisuvratswami - Chyavan Kalyanak'),
(296, '2016-08-19', 'Friday', 2073, 'Bhadrapad', 1, 'Yes', 'Krushna', ''),
(297, '2016-08-20', 'Saturday', 2073, 'Bhadrapad', 2, 'No', 'Krushna', ''),
(298, '2016-08-21', 'Sunday', 2073, 'Bhadrapad', 3, 'No', 'Krushna', ''),
(300, '2016-08-22', 'Monday', 2073, 'Bhadrapad', 5, 'Yes', 'Krushna', ''),
(301, '2016-08-23', 'Tuesday', 2073, 'Bhadrapad', 6, 'No', 'Krushna', ''),
(302, '2016-08-24', 'Wednesday', 2073, 'Bhadrapad', 7, 'Yes', 'Krushna', 'Shri Chandraprabhswami - Moksh Kalyanak; Shri Shantinath - Chyavan Kalyanak'),
(303, '2016-08-25', 'Thursday', 2073, 'Bhadrapad', 8, 'No', 'Krushna', 'Shri Suparshwanath - Chyavan Kalyanak'),
(304, '2016-08-26', 'Friday', 2073, 'Bhadrapad', 9, 'Yes', 'Krushna', 'Shri Suvidhinath - Moksh Kalyanak'),
(305, '2016-08-27', 'Saturday', 2073, 'Bhadrapad', 10, 'Yes', 'Krushna', ''),
(306, '2016-08-28', 'Sunday', 2073, 'Bhadrapad', 11, 'No', 'Krushna', ''),
(307, '2016-08-29', 'Monday', 2073, 'Bhadrapad', 12, 'Yes', 'Krushna', 'Parvadhiraj Paryushan Prarambh'),
(308, '2016-08-30', 'Tuesday', 2073, 'Bhadrapad', 13, 'No', 'Krushna', ''),
(309, '2016-08-31', 'Wednesday', 2073, 'Bhadrapad', 14, 'No', 'Krushna', 'Manidhari Jinchandraksuri - Punyatithi; Pakshik Pratikraman'),
(310, '2016-09-01', 'Thursday', 2073, 'Bhadrapad', 30, 'No', 'Krushna', ''),
(311, '2016-09-02', 'Friday', 2073, 'Bhadrapad', 1, 'Yes', 'Shukla', ''),
(312, '2016-09-03', 'Saturday', 2073, 'Bhadrapad', 2, 'No', 'Shukla', ''),
(313, '2016-09-04', 'Sunday', 2073, 'Bhadrapad', 3, 'Yes', 'Shukla', ''),
(314, '2016-09-05', 'Monday', 2073, 'Bhadrapad', 4, 'No', 'Shukla', 'Samvatsari Mahparv'),
(315, '2016-09-06', 'Tuesday', 2073, 'Bhadrapad', 5, 'No', 'Shukla', ''),
(316, '2016-09-07', 'Wednesday', 2073, 'Bhadrapad', 6, 'No', 'Shukla', ''),
(317, '2016-09-08', 'Thursday', 2073, 'Bhadrapad', 7, 'No', 'Shukla', ''),
(318, '2016-09-09', 'Friday', 2073, 'Bhadrapad', 8, 'No', 'Shukla', ''),
(319, '2016-09-10', 'Saturday', 2073, 'Bhadrapad', 9, 'No', 'Shukla', ''),
(320, '2016-09-11', 'Sunday', 2073, 'Bhadrapad', 9, 'Yes', 'Shukla', ''),
(321, '2016-09-12', 'Monday', 2073, 'Bhadrapad', 10, 'No', 'Shukla', ''),
(322, '2016-09-13', 'Tuesday', 2073, 'Bhadrapad', 11, 'No', 'Shukla', ''),
(323, '2016-09-14', 'Wednesday', 2073, 'Bhadrapad', 12, 'No', 'Shukla', ''),
(325, '2016-09-15', 'Thursday', 2073, 'Bhadrapad', 14, 'No', 'Shukla', 'Pakshik Pratikraman'),
(326, '2016-09-16', 'Friday', 2073, 'Bhadrapad', 15, 'Yes', 'Shukla', ''),
(327, '2016-09-17', 'Saturday', 2073, 'Ashwin', 1, 'No', 'Krushna', ''),
(328, '2016-09-18', 'Sunday', 2073, 'Ashwin', 2, 'No', 'Krushna', 'Dada Jinchandrasuri Punyatithi'),
(329, '2016-09-19', 'Monday', 2073, 'Ashwin', 3, 'Yes', 'Krushna', ''),
(330, '2016-09-20', 'Tuesday', 2073, 'Ashwin', 4, 'No', 'Krushna', ''),
(331, '2016-09-21', 'Wednesday', 2073, 'Ashwin', 5, 'No', 'Krushna', ''),
(333, '2016-09-22', 'Thursday', 2073, 'Ashwin', 7, 'No', 'Krushna', ''),
(334, '2016-09-23', 'Friday', 2073, 'Ashwin', 8, 'No', 'Krushna', ''),
(335, '2016-09-24', 'Saturday', 2073, 'Ashwin', 9, 'Yes', 'Krushna', ''),
(336, '2016-09-25', 'Sunday', 2073, 'Ashwin', 10, 'No', 'Krushna', ''),
(337, '2016-09-26', 'Monday', 2073, 'Ashwin', 11, 'Yes', 'Krushna', ''),
(338, '2016-09-27', 'Tuesday', 2073, 'Ashwin', 12, 'No', 'Krushna', ''),
(339, '2016-09-28', 'Wednesday', 2073, 'Ashwin', 13, 'Yes', 'Krushna', 'Shri Mahaveerswami - Garbhapahaar'),
(340, '2016-09-29', 'Thursday', 2073, 'Ashwin', 14, 'No', 'Krushna', 'Pakshik Pratikraman'),
(341, '2016-09-30', 'Friday', 2073, 'Ashwin', 30, 'No', 'Krushna', 'Shri Neminath - Kevalgyan Kalyanak'),
(342, '2016-10-01', 'Saturday', 2073, 'Ashwin', 1, 'No', 'Shukla', ''),
(343, '2016-10-02', 'Sunday', 2073, 'Ashwin', 1, 'Yes', 'Shukla', ''),
(344, '2016-10-03', 'Monday', 2073, 'Ashwin', 2, 'Yes', 'Shukla', ''),
(345, '2016-10-04', 'Tuesday', 2073, 'Ashwin', 3, 'No', 'Shukla', ''),
(346, '2016-10-05', 'Wednesday', 2073, 'Ashwin', 4, 'Yes', 'Shukla', ''),
(347, '2016-10-06', 'Thursday', 2073, 'Ashwin', 5, 'No', 'Shukla', ''),
(348, '2016-10-07', 'Friday', 2073, 'Ashwin', 6, 'No', 'Shukla', ''),
(349, '2016-10-08', 'Saturday', 2073, 'Ashwin', 7, 'No', 'Shukla', 'Navpad Oli Prarambh'),
(350, '2016-10-09', 'Sunday', 2073, 'Ashwin', 8, 'No', 'Shukla', ''),
(351, '2016-10-10', 'Monday', 2073, 'Ashwin', 9, 'No', 'Shukla', ''),
(352, '2016-10-11', 'Tuesday', 2073, 'Ashwin', 10, 'No', 'Shukla', ''),
(353, '2016-10-12', 'Wednesday', 2073, 'Ashwin', 11, 'Yes', 'Shukla', ''),
(354, '2016-10-13', 'Thursday', 2073, 'Ashwin', 12, 'No', 'Shukla', ''),
(355, '2016-10-14', 'Friday', 2073, 'Ashwin', 13, 'No', 'Shukla', ''),
(356, '2016-10-15', 'Saturday', 2073, 'Ashwin', 14, 'Yes', 'Shukla', 'Pakshik Pratikraman'),
(357, '2016-10-16', 'Sunday', 2073, 'Ashwin', 15, 'No', 'Shukla', 'Navpad Oli Samapan; Shri Naminath - Chyavan Kalyanak'),
(359, '2016-10-17', 'Monday', 2073, 'Karthik', 2, 'No', 'Krushna', ''),
(360, '2016-10-18', 'Tuesday', 2073, 'Karthik', 3, 'No', 'Krushna', ''),
(361, '2016-10-19', 'Wednesday', 2073, 'Karthik', 4, 'No', 'Krushna', ''),
(362, '2016-10-20', 'Thursday', 2073, 'Karthik', 5, 'Yes', 'Krushna', 'Shri Sambhavnath - Kevalgyan Kalyanak'),
(363, '2016-10-21', 'Friday', 2073, 'Karthik', 6, 'Yes', 'Krushna', ''),
(364, '2016-10-22', 'Saturday', 2073, 'Karthik', 7, 'Yes', 'Krushna', ''),
(365, '2016-10-23', 'Sunday', 2073, 'Karthik', 8, 'Yes', 'Krushna', ''),
(366, '2016-10-24', 'Monday', 2073, 'Karthik', 9, 'No', 'Krushna', ''),
(367, '2016-10-25', 'Tuesday', 2073, 'Karthik', 10, 'No', 'Krushna', ''),
(368, '2016-10-26', 'Wednesday', 2073, 'Karthik', 11, 'No', 'Krushna', ''),
(369, '2016-10-27', 'Thursday', 2073, 'Karthik', 12, 'No', 'Krushna', 'Shri Padmaprabhswami - Janm Kalyanak; Shri Neminath - Chyavan Kalyanak'),
(370, '2016-10-28', 'Friday', 2073, 'Karthik', 13, 'Yes', 'Krushna', 'Shri Padmaprabhswami - Diksha Kalyanak'),
(371, '2016-10-29', 'Saturday', 2073, 'Karthik', 14, 'Yes', 'Krushna', 'Pakshik Pratikraman'),
(372, '2016-10-30', 'Sunday', 2073, 'Karthik', 30, 'No', 'Krushna', 'Shri Mahaveerswami - Moksh Kalyanak; Diwali'),
(373, '2016-10-31', 'Monday', 2073, 'Karthik', 1, 'Yes', 'Shukla', 'Gautam Ras Vanchan'),
(374, '2016-11-01', 'Tuesday', 2073, 'Karthik', 2, 'No', 'Shukla', ''),
(375, '2016-11-02', 'Wednesday', 2073, 'Karthik', 3, 'Yes', 'Shukla', 'Shri Suvidhinath - Kevalgyan Kalyanak'),
(376, '2016-11-03', 'Thursday', 2073, 'Karthik', 4, 'No', 'Shukla', ''),
(377, '2016-11-04', 'Friday', 2073, 'Karthik', 4, 'No', 'Shukla', ''),
(378, '2016-11-05', 'Saturday', 2073, 'Karthik', 5, 'No', 'Shukla', 'Gyan Panchami'),
(379, '2016-11-06', 'Sunday', 2073, 'Karthik', 6, 'No', 'Shukla', ''),
(380, '2016-11-07', 'Monday', 2073, 'Karthik', 7, 'Yes', 'Shukla', ''),
(381, '2016-11-08', 'Tuesday', 2073, 'Karthik', 8, 'No', 'Shukla', ''),
(382, '2016-11-09', 'Wednesday', 2073, 'Karthik', 9, 'No', 'Shukla', ''),
(383, '2016-11-10', 'Thursday', 2073, 'Karthik', 10, 'Yes', 'Shukla', ''),
(384, '2016-11-11', 'Friday', 2073, 'Karthik', 11, 'No', 'Shukla', ''),
(386, '2016-11-12', 'Saturday', 2073, 'Karthik', 13, 'Yes', 'Shukla', ''),
(387, '2016-11-13', 'Sunday', 2073, 'Karthik', 14, 'No', 'Shukla', 'Choumasi Pratikraman'),
(388, '2016-11-14', 'Monday', 2073, 'Karthik', 15, 'Yes', 'Shukla', '');

-- --------------------------------------------------------

--
-- Table structure for table `panchang_months`
--

CREATE TABLE `panchang_months` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panchang_months`
--

INSERT INTO `panchang_months` (`id`, `name`) VALUES
(1, 'Chaitra'),
(2, 'Vaishakh'),
(3, 'Jyeshta'),
(4, 'Aashaadh'),
(5, 'Sharaavan'),
(6, 'Bhadrapad'),
(7, 'Ashwin'),
(8, 'Kaartik'),
(9, 'Margasheersh'),
(10, 'Paush'),
(11, 'Maagh'),
(12, 'Phalgun');

-- --------------------------------------------------------

--
-- Table structure for table `religious_places`
--

CREATE TABLE `religious_places` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `type` enum('dadawadi','tirth') NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `religious_places`
--

INSERT INTO `religious_places` (`id`, `name`, `address`, `type`, `state_id`) VALUES
(2, 'Ajmer Dadawadi', 'Vinay Nagar , Ajmer', 'dadawadi', 27),
(3, 'Mehrauli Dadawadi', 'Mahendra Kumar Bhansali Marg, Opp. Qutub Minar Metro Station Mehrauli New Delhi', 'dadawadi', 9),
(4, 'Malpura Dadabadi', 'Malpura , Tonk District', 'dadawadi', 27),
(5, 'Bilada Dadabadi', 'Bilara , Jodhpur District', 'dadawadi', 27),
(6, 'Brahmasar Dadawadi', 'Brahmasar , Jaisalmer', 'dadawadi', 27),
(7, 'Udairamsar Dadabadi', 'Udairamsar', 'dadawadi', 27),
(8, 'Nal Dadabadi', 'Nal Badi Village , Bikaner', 'dadawadi', 27),
(9, 'Karwan Dadabadi', 'Karwan , Hyderabad/Secunderabad', 'dadawadi', 34),
(10, 'Maniktalla Dadabadi', 'Maniktalla, 36, Badridas Temple Street Kolkata', 'dadawadi', 32),
(11, 'Raipur Dadabadi', 'M G Road , Chhatisgarh Raipur', 'dadawadi', 33),
(12, 'Dhamtari Dadabadi', 'Dhamtari , Raipur', 'dadawadi', 33),
(13, 'Durg Dadabadi', 'Durg', 'dadawadi', 33),
(14, 'Rajnandgaon Dadabadi', 'Rajnandgaon', 'dadawadi', 33),
(15, 'Indore Dadawadi', 'Scheme No 71 , Indore', 'dadawadi', 15),
(16, 'Sagartal Dadabadi', 'Sagar Tal Road, Vinay Nagar Gwalior', 'dadawadi', 15),
(17, 'Jagdalpur Dadabadi', 'Dadabadi Road, Dalpat Sagar Ward, Motitalab Para, Jagdalpur', 'dadawadi', 33),
(18, 'Nakoda Dadabadi', 'Nakoda', 'dadawadi', 27),
(19, 'Kewaldham Dadabadi', 'Kewal Dham Ext., Durgakund Varanasi', 'dadawadi', 15),
(20, 'Shitalbadi Dadabadi', '', 'dadawadi', 11),
(21, 'Dholka Dadabadi', 'Dholka Bypass Road,, Kalikund Dholka', 'dadawadi', 11),
(22, 'Anand Sagar Dadabadi', 'Jalna', 'dadawadi', 19),
(23, 'Jaisalmer Dadabadi', 'Barmer Road(Nh-15), Suthar Para Jaisalmer', 'dadawadi', 27),
(24, 'Navrangpura Dadabadi', 'University Area , Ahmedabad', 'dadawadi', 11),
(25, 'Bhilwada Dadabadi', 'Bhilwara', 'dadawadi', 27),
(26, 'Chittorgarh Dadabari', '', 'dadawadi', 27),
(27, 'Secunderabad Dadabari', 'National Highway 9, Mudfort, Bowenpally Secunderabad', 'dadawadi', 34),
(28, 'Chennai Dadabari', '370, Konnur High Road, Aynavaram Chennai', 'dadawadi', 35),
(29, 'Byculla Dadabari', '16, Shubh Sandesh Building, Ground Floor, Byculla, Mumbai', 'dadawadi', 19),
(30, 'Patna Dadabari', 'Begampur , Patna', 'dadawadi', 5),
(31, 'Kanpur Dadabari', '', 'dadawadi', 31),
(32, 'Haripura Dadabari', 'Surat', 'dadawadi', 11),
(33, 'Gadh Siwana Dadabari', 'Siwana , Barmer District', 'dadawadi', 27),
(34, 'Barmer Dadawadi', 'Barmer , Barmer', 'dadawadi', 27),
(35, 'Sanchor Jindutt Suri Dadawadi', 'National Highway No.15, Pathankot-Samkhiali Sanchor; Jalore District', 'dadawadi', 27),
(36, 'Wilson Street Khetwadi', 'Dr. Wilson Street, Sikka Nagar, Behind Alankar Talkies, Khetwadi, Mumbai', 'dadawadi', 19),
(37, 'Borivali Dadawadi', 'Borivali , Mumbai', 'dadawadi', 19),
(38, 'Andheri Dadawadi', 'J.B Nager, Andheri East Mumbai', 'dadawadi', 19),
(39, 'Bhiwandi Dadawadi', 'Kalyan Road, Ghoonghat Nagar, Bhiwandi Thane', 'dadawadi', 19),
(40, 'Lalbag (Madhavbag) Dadawadi', '', 'dadawadi', 19),
(41, 'Chintamani (Gulalwadi)', 'Chintamani, Gulalwadi, Kalbadevi, Mumbai', 'dadawadi', 19),
(42, 'Pydhonie Mahaveer Swami Mandir Dadawadi', 'Building No.213,, Pydhonie Mumbai', 'dadawadi', 19),
(43, 'Sheetalnath (White House) Dadawadi', 'Balaji Nagar , Pune', 'dadawadi', 19),
(44, 'Malegaon Dadabari', 'Malegaon, M G Road, Raipur Ho Raipur', 'dadawadi', 33),
(45, 'Jalgaon Dadawadi', 'Jalgaon , Jalgaon', 'dadawadi', 19),
(46, 'Dhulia Dadabari', 'Mh Sh 22, Mohadi Upnagar , Dhule', 'dadawadi', 19),
(47, 'Dondecha Dadawadi', 'Dondaicha; Dhule District', 'dadawadi', 19),
(48, 'Valkhana Dadawadi', '', 'dadawadi', 19),
(49, 'Nasik Dadawadi', 'Sagar Village, Nashik Nashik', 'dadawadi', 19),
(50, 'Padaru Dadawadi', '', 'dadawadi', 19),
(51, 'Balotra Dadawadi', 'E-292 Lokseva Compond Kher Road, Industrial Area Balotra', 'dadawadi', 27),
(52, 'Pachpadra Dadawadi', 'Nakoda Village , Barmer District', 'dadawadi', 27),
(53, 'Sindhari Dadawadi', 'Sindhari Circle, Bagoda Jalore District', 'dadawadi', 27),
(54, 'Chennai Choolai Dadawadi', '370, Konnur High Road , Chennai', 'dadawadi', 35),
(55, 'Chitalwana Dadawadi', 'Sanchor; Jalor District', 'dadawadi', 27),
(56, 'Shankheshwar Theerth Par Dadawadi', 'Shankheshwar , Harij', 'dadawadi', 11),
(57, 'Shikhar Ji Tirth Par Dadawadi', 'Shikharji , Giridih District', 'dadawadi', 36),
(58, 'Kulpakji Tirth Par Dadawadi', 'Kulpakji Teerth Kolanpak, Aler Nalgonda District', 'dadawadi', 2),
(59, 'Erode Dadawadi', 'Erode', 'dadawadi', 35),
(60, 'Gadag Dadawadi', 'Gurudev Nagar , Sarvoday Society Road Gadag', 'dadawadi', 15),
(61, 'Hubli Dadawadi', 'Near Bankapur Chowk , Gabbur Road Hubli', 'dadawadi', 15),
(62, 'Kottar Dadawadi', 'West Kovalam Road , Kanyakumari', 'dadawadi', 35),
(63, 'Osiyaji Dadabadi', 'Mangalsiha Ratnasihji Devki , Pedhi District. Jodhpur;Osiyaji', 'dadawadi', 27),
(64, 'Pali Dadabadi', 'Ranakpur , Pali', 'dadawadi', 27),
(65, 'Moti Dungari Dadabadi', 'Moti Doongri Rd, Adarsh Nagar Jaipur', 'dadawadi', 27),
(66, 'Mohanbadi Dadabadi', 'Jaipur', 'dadawadi', 27),
(67, 'Amber Dadabadi', 'Amber , Jaipur', 'dadawadi', 27),
(68, 'Sanganer Dadabadi', 'Dada Bari Road, Dada Gurudev Nagar, Sanganer Jaipur', 'dadawadi', 27),
(69, 'Jawahar Nagar Jaipur Dadabari', 'Jawahar Nagar Main, Jawahar Nagar Jaipur', 'dadawadi', 27),
(70, 'Chaksu Dadabari', 'Chaksu , Jaipur', 'dadawadi', 27),
(71, 'Rambagh Indore Dadabari', 'Scheme No 71, Indore Indore', 'dadawadi', 15),
(72, 'Kirat Bagh Dadabari', 'Jiaganj', 'dadawadi', 32),
(73, 'Deraur Dadabari', 'Jamdoli , Jaipur', 'dadawadi', 27),
(74, 'Kathgola Dadabari', 'Murshidabad', 'dadawadi', 32),
(75, 'Tiruppattur Dadabari', 'Tiruppattur', 'dadawadi', 35),
(76, 'Beawar Dadabari', 'Beawar', 'dadawadi', 27),
(77, 'Kishangarh Dadabari', 'Pal Bichala , Ajmer', 'dadawadi', 27),
(78, 'Bijaynagar (Ajmer) Dadawadi', 'Bilara', 'dadawadi', 27),
(79, 'Kekri Dadawadi, Ajmer', 'Ajmer', 'dadawadi', 27),
(80, 'Azimgunj Dadawadi', 'Murshidabad', 'dadawadi', 32),
(81, 'Jiaganj Dadabari', 'Badurtala, Jiaganj Murshidabad', 'dadawadi', 32),
(82, 'Kolkata Dadabari', '32, Raja Dinedra, Badri Das Temple Road, Gouri Bari, Maniktala, Kolkata', 'dadawadi', 32),
(83, 'Katgola Dadabari', 'Jiaganj', 'dadawadi', 32),
(84, 'Shyamnagar Dadabari', 'Jaipur', 'dadawadi', 27),
(85, 'Vaniyambodi Dadabari', '', 'dadawadi', 35),
(86, 'Kamaldah Dadabadi', '', 'dadawadi', 5);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `name`, `code`, `status`) VALUES
(1, 'Andaman and Nicobar Islands', 'AN', 1),
(2, 'Andhra Pradesh', 'AP', 1),
(3, 'Arunachal Pradesh', 'AR', 1),
(4, 'Assam', 'AS', 1),
(5, 'Bihar', 'BI', 1),
(6, 'Chandigarh', 'CH', 1),
(7, 'Dadra and Nagar Haveli', 'DA', 1),
(8, 'Daman and Diu', 'DM', 1),
(9, 'Delhi', 'DE', 1),
(10, 'Goa', 'GO', 1),
(11, 'Gujarat', 'GU', 1),
(12, 'Haryana', 'HA', 1),
(13, 'Himachal Pradesh', 'HP', 1),
(14, 'Jammu and Kashmir', 'JA', 1),
(15, 'Karnataka', 'KA', 1),
(16, 'Kerala', 'KE', 1),
(17, 'Lakshadweep Islands', 'LI', 1),
(18, 'Madhya Pradesh', 'MP', 1),
(19, 'Maharashtra', 'MA', 1),
(20, 'Manipur', 'MN', 1),
(21, 'Meghalaya', 'ME', 1),
(22, 'Mizoram', 'MI', 1),
(23, 'Nagaland', 'NA', 1),
(24, 'Orissa', 'OR', 1),
(25, 'Pondicherry', 'PO', 1),
(26, 'Punjab', 'PU', 1),
(27, 'Rajasthan', 'RA', 1),
(28, 'Sikkim', 'SI', 1),
(30, 'Tripura', 'TR', 1),
(31, 'Uttar Pradesh', 'UP', 1),
(32, 'West Bengal', 'WB', 1),
(33, 'Chhattisgarh', '', 1),
(34, 'Telangana', '', 1),
(35, 'Tamil Nadu', '', 1),
(36, 'Jharkhand', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stavansangrah`
--

CREATE TABLE `stavansangrah` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `lyrics` longtext NOT NULL,
  `type` varchar(150) NOT NULL,
  `audio_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stavansangrah`
--

INSERT INTO `stavansangrah` (`id`, `title`, `lyrics`, `type`, `audio_file`) VALUES
(8, 'fdgds d', 'd dsdfsdfdf', 'Type 2', '');

-- --------------------------------------------------------

--
-- Table structure for table `stavansangrah_type`
--

CREATE TABLE `stavansangrah_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stavansangrah_type`
--

INSERT INTO `stavansangrah_type` (`id`, `name`) VALUES
(1, 'Type 1'),
(2, 'Type 2'),
(3, 'Type 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_sadhu`
--
ALTER TABLE `location_sadhu`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `panchang`
--
ALTER TABLE `panchang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panchang_months`
--
ALTER TABLE `panchang_months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religious_places`
--
ALTER TABLE `religious_places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `stavansangrah`
--
ALTER TABLE `stavansangrah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stavansangrah_type`
--
ALTER TABLE `stavansangrah_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `location_sadhu`
--
ALTER TABLE `location_sadhu`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `panchang`
--
ALTER TABLE `panchang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;
--
-- AUTO_INCREMENT for table `panchang_months`
--
ALTER TABLE `panchang_months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `religious_places`
--
ALTER TABLE `religious_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `stavansangrah`
--
ALTER TABLE `stavansangrah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `stavansangrah_type`
--
ALTER TABLE `stavansangrah_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
