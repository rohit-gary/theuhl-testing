-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2023 at 07:59 AM
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
-- Database: `dwd`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

DROP TABLE IF EXISTS `company_details`;
CREATE TABLE IF NOT EXISTS `company_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(256) NOT NULL DEFAULT '',
  `CompanyLogo` varchar(256) NOT NULL DEFAULT '',
  `Email` varchar(256) NOT NULL DEFAULT '',
  `PhoneNumber` varchar(256) NOT NULL DEFAULT '',
  `AlternativeNumber` varchar(256) NOT NULL DEFAULT '',
  `Address` varchar(500) NOT NULL DEFAULT '',
  `GSTNumber` varchar(256) NOT NULL DEFAULT '',
  `CGST` varchar(256) NOT NULL DEFAULT '',
  `SGST` varchar(256) NOT NULL DEFAULT '',
  `IGST` varchar(256) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`ID`, `CompanyName`, `CompanyLogo`, `Email`, `PhoneNumber`, `AlternativeNumber`, `Address`, `GSTNumber`, `CGST`, `SGST`, `IGST`, `CreatedBy`, `CreatedDate`, `CreatedTime`, `IsActive`) VALUES
(3, 'TATA communications Limited', '', 'manish@gmail.com', '08433098391', '8433098391', '53/1, Upper Ground Floor, Bada Bazar Road, Old Rajinder Nagar, New Delhi -110060', 'HSSB12637GTV37', '3', '3', '3', 'admin@tathastuics.com', '2023-08-31', '10:40:24', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`ID`, `ModulesName`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(1, 'test44', '2023-11-13', '12:22:58', 'admin@dwd.com', 1),
(2, 'teste', '2023-11-13', '12:24:17', 'admin@dwd.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrganizationName` varchar(256) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`ID`, `OrganizationName`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(1, 'testhhh', '2023-11-13', '16:35:44', 'admin@dwd.com', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Email`, `Password`, `ModuleID`, `OrgID`, `UserType`, `CreatedDate`, `CreatedTime`, `IsActive`) VALUES
(7, 'manishsharma.gary+1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'ContentTeam', '2023-08-28', '16:33:55', 1),
(6, 'admin@dwd.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'System Admin', '', '', 1),
(3, 'manishsharma.gary@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'ContentTeam', '2023-08-02', '16:07:24', 1),
(4, 'deepak@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'Counsellor', '2023-08-02', '18:01:41', 1),
(5, 'rajasinghsahib60@gmail.com', '172beb7ce155aef3754ff7606253a208', -1, -1, 'Counsellor', '2023-08-03', '14:33:58', 1),
(8, 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'Student', '2023-09-01', '12:51:07', 1),
(9, 'admin@test.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'Student', '2023-09-01', '12:52:10', 1),
(10, 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'Faculty', '2023-09-01', '15:19:54', 1),
(11, 'deepak@test.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'Book Dispatch', '2023-09-04', '12:02:14', 1),
(12, 'educator@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'Educator', '2023-09-08', '16:45:37', 1),
(13, 'manish@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'Academic Head', '2023-09-11', '15:05:36', 1),
(14, 'manishtest@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', -1, -1, 'Academic Head', '2023-09-23', '12:51:21', 1),
(15, 'test2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 'Counsellor', '2023-11-14', '09:18:04', 1);

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

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`ID`, `Name`, `Mobile`, `Email`, `UserType`, `CreatedDate`, `CreatedBy`, `IsActive`) VALUES
(2, 'Manish', '8433098391', 'manishsharma.gary@gmail.com', 'Counsellor', '2023-08-02', 'admin@tathastuics.com', 1),
(4, 'Raja Singh', '9760230478', 'rajasinghsahib60@gmail.com', 'Counsellor', '2023-08-03', 'admin@tathastuics.com', 1),
(7, 'manish', '8433098396', 'admin@test.com', 'Student', '2023-09-01', 'admin@tathastuics.com', 1),
(8, 'Deepak', '8477034886', 'deepak@test.com', 'Book Dispatch', '2023-09-04', 'admin@tathastuics.com', 1),
(9, 'Manish', '3448759933', 'educator@gmail.com', 'Educator', '2023-09-08', 'admin@tathastuics.com', 1),
(10, 'test', '8433098394', 'test@gmail.com', 'Counsellor', '2023-11-14', 'admin@dwd.com', 1),
(11, 'test', '8433098334', 'test1@gmail.com', 'Counsellor', '2023-11-14', 'admin@dwd.com', 1),
(12, 'test', '8433098324', 'test2@gmail.com', 'Counsellor', '2023-11-14', 'admin@dwd.com', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
