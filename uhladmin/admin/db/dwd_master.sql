-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2023 at 01:50 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dwd_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ModulesName` varchar(256) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`ID`, `ModulesName`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(6, 'test', '2023-11-14', '17:10:58', 'admin@dwd.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrganizationName` varchar(256) NOT NULL DEFAULT '',
  `Address` varchar(256) NOT NULL DEFAULT '',
  `POC` varchar(256) NOT NULL DEFAULT '',
  `Email` varchar(256) NOT NULL DEFAULT '',
  `PhoneNumber` varchar(256) NOT NULL DEFAULT '',
  `SubscriptionType` varchar(256) NOT NULL DEFAULT '',
  `StartDate` varchar(50) NOT NULL DEFAULT '',
  `EndDate` varchar(50) NOT NULL DEFAULT '',
  `GSTNo` varchar(256) NOT NULL DEFAULT '',
  `Logo` varchar(256) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`ID`, `OrganizationName`, `Address`, `POC`, `Email`, `PhoneNumber`, `SubscriptionType`, `StartDate`, `EndDate`, `GSTNo`, `Logo`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(3, 'testnn', 'ramnager  road, nainital', 'test', 'manish@gmail.com', '08433098391', 'Yearly', '2023-11-16', '2023-11-24', 'wwwwwwwwww', 'testnnlogo.pdf', '2023-11-14', '17:08:03', 'admin@dwd.com', 1),
(4, 'testnn', 'ramnager  road, nainital', 'test', 'manish@gmail.com', '08433098391', 'Yearly', '2023-11-16', '2023-11-24', 'wwwwwwwwww', 'testnnlogo.pdf', '2023-11-14', '17:08:20', 'admin@dwd.com', 1),
(5, 'testnn', 'ramnager  road, nainital', 'test', 'manish@gmail.com', '08433098391', 'Yearly', '2023-11-16', '2023-11-24', 'wwwwwwwwww', 'testnnlogo.pdf', '2023-11-14', '17:09:38', 'admin@dwd.com', 1),
(6, 'testnn', 'ramnager  road, nainital', 'test', 'manish@gmail.com', '08433098391', 'Yearly', '2023-11-16', '2023-11-24', 'wwwwwwwwww', 'testnnlogo.pdf', '2023-11-14', '17:09:59', 'admin@dwd.com', 1),
(7, 'test2', 'ramnager  road, nainital', 'test', 'manish@gmail.com', '08433098391', 'Quaterly', '2023-11-24', '2023-11-17', 'wwwwwwwwww', 'test2logo.png', '2023-11-14', '17:11:43', 'admin@dwd.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(12) NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `ModuleID` int(11) NOT NULL DEFAULT '-1',
  `OrgID` int(11) NOT NULL DEFAULT '-1',
  `UserType` varchar(50) NOT NULL,
  `CreatedDate` varchar(50) NOT NULL,
  `CreatedTime` varchar(50) NOT NULL,
  `IsActive` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Email`, `Password`, `ModuleID`, `OrgID`, `UserType`, `CreatedDate`, `CreatedTime`, `IsActive`) VALUES
(16, 'manish@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 6, -1, 'Client', '2023-11-14', '17:11:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `ID` int(12) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Mobile` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT '',
  `UserType` varchar(100) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int(12) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
