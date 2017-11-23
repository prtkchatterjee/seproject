-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:54936
-- Generation Time: Nov 13, 2017 at 05:06 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `localdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_calendar`
--

CREATE TABLE `event_calendar` (
  `User_ID` varchar(12) NOT NULL,
  `Event_Name` varchar(100) NOT NULL,
  `Event_Start_Date` varchar(10) NOT NULL,
  `Event_End_Date` varchar(10) NOT NULL,
  `Event_Start_Time` varchar(5) NOT NULL,
  `Event_End_Time` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_calendar`
--

INSERT INTO `event_calendar` (`User_ID`, `Event_Name`, `Event_Start_Date`, `Event_End_Date`, `Event_Start_Time`, `Event_End_Time`) VALUES
('COMMON', 'Christmas', '25-12-2017', '25-12-2017', '00:00', '23:59'),
('PES001', 'SE Project Evaluation', '24-11-2017', '24-11-2017', '15:30', '17:00'),
('PES002', 'SE Project Evaluation', '25-11-2017', '25-11-2017', '15:30', '17:00'),
('PES001', 'ESA - OOMD', '5-12-2017', '5-12-2017', '0:0', '0:0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
