-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2024 at 03:20 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uhl_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `ID` int NOT NULL,
  `ModulesName` varchar(256) NOT NULL DEFAULT '',
  `FolderName` varchar(256) NOT NULL DEFAULT '',
  `IconPath` varchar(256) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`ID`, `ModulesName`, `FolderName`, `IconPath`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(1, 'uhl', 'uhl-management', '', '2024-09-09', '11:56:27', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `ID` int NOT NULL,
  `OrganizationName` varchar(256) NOT NULL DEFAULT '',
  `OrganizationTitle` varchar(256) NOT NULL DEFAULT '',
  `Address` varchar(256) NOT NULL DEFAULT '',
  `POC` varchar(256) NOT NULL DEFAULT '',
  `Email` varchar(256) NOT NULL DEFAULT '',
  `PhoneNumber` varchar(256) NOT NULL DEFAULT '',
  `GSTNo` varchar(256) NOT NULL DEFAULT '',
  `Logo` varchar(256) NOT NULL DEFAULT '',
  `SubDomain` varchar(256) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`ID`, `OrganizationName`, `OrganizationTitle`, `Address`, `POC`, `Email`, `PhoneNumber`, `GSTNo`, `Logo`, `SubDomain`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(1, 'UHL', '', 'UHL', 'UHL', 'admin@uhl.com', '88888888', '', '', '', '2024-09-09', '11:55:11', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `org_module_mapping`
--

CREATE TABLE `org_module_mapping` (
  `ID` int NOT NULL,
  `OrgID` int NOT NULL,
  `ModuleID` int NOT NULL,
  `SubscriptionType` varchar(50) NOT NULL DEFAULT '',
  `SubscriptionStartDate` varchar(50) NOT NULL DEFAULT '',
  `SubscriptionEndDate` varchar(50) NOT NULL DEFAULT '',
  `db_name_global` varchar(100) NOT NULL DEFAULT '',
  `db_user_global` varchar(100) NOT NULL DEFAULT '',
  `db_password_global` varchar(100) NOT NULL DEFAULT '',
  `db_name_local` varchar(100) NOT NULL DEFAULT '',
  `db_user_local` varchar(100) NOT NULL DEFAULT '',
  `db_password_local` varchar(100) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL,
  `CreatedTime` varchar(50) NOT NULL,
  `CreatedBy` varchar(50) NOT NULL,
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_module_mapping`
--

INSERT INTO `org_module_mapping` (`ID`, `OrgID`, `ModuleID`, `SubscriptionType`, `SubscriptionStartDate`, `SubscriptionEndDate`, `db_name_global`, `db_user_global`, `db_password_global`, `db_name_local`, `db_user_local`, `db_password_local`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(1, 1, 1, 'Regular', '2024-09-09', '2025-08-27', 'uhl_all', 'root', 'Gary@123', 'uhl_all', 'root', '', '2024-09-09', '11:57:12', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_otp`
--

CREATE TABLE `temp_otp` (
  `ID` int NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL DEFAULT '',
  `OTP` int NOT NULL DEFAULT '-1',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `UserName` varchar(50) NOT NULL DEFAULT '',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `PhoneNumber` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `OrgID` int NOT NULL DEFAULT '-1',
  `UserType` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `OTP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1111',
  `CreatedDate` varchar(50) NOT NULL,
  `CreatedTime` varchar(50) NOT NULL,
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserName`, `Name`, `PhoneNumber`, `Email`, `Password`, `OrgID`, `UserType`, `OTP`, `CreatedDate`, `CreatedTime`, `IsActive`) VALUES
(1, 'admin@uhl.com', 'adminUhl', '', 'admin@uhl.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Client Admin', '1111', '16-11-2024', '13:54', 1),
(2, 'rohitmaurya112.gary@gmail.com', 'Rohit Kushwaha Testing ', '8948975967', 'rohitmaurya112.gary@gmail.com', '0490d4707e348175c13d151e3b7bfc7a', 1, 'Policy Customer', '1111', '2024-11-16', '14:01:05', 1),
(3, 'rohitmaurya113.gary@gmail.com', 'Rohit Test Second', '8874644133', 'rohitmaurya113.gary@gmail.com', '0490d4707e348175c13d151e3b7bfc7a', 1, 'Policy Customer', '1111', '2024-11-16', '14:09:45', 1),
(4, 'ChannelPartner1@uhl.com', 'ChannelPartner1', '8826709578', 'ChannelPartner1@uhl.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Channel Partner', '1111', '2024-11-16', '14:13:45', 1),
(5, 'testingchanalpartnercustomer@gmail.com', 'Testing Customer Chanal Partner', '8948975639', 'testingchanalpartnercustomer@gmail.com', '48266f82c49687141b321ba038981b52', 1, 'Policy Customer', '1111', '2024-11-16', '14:15:49', 1),
(6, 'salesman@uhl.com', 'Testing SelsMan', '7874562563', 'salesman@uhl.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Client User', '1111', '2024-11-16', '14:24:11', 1),
(7, 'testingsalescustomer@gmail.com', 'Testing Sales man Policy Customer', '6428528520', 'testingsalescustomer@gmail.com', 'a77f17706b1c513474a0d0b0e4680bf6', 1, 'Policy Customer', '1111', '2024-11-16', '14:26:50', 1),
(8, 'Deepak', 'Deepak ', '07210720153', 'deepakch@gmail.com', '019ec8a24fc5c25e0d86b0049bbc4935', 1, 'Policy Customer', '1111', '2024-11-16', '14:32:25', 1),
(9, 'lifeapana@gmail.com', 'Adarsh ', '8874644132', 'lifeapana@gmail.com', 'd2dd37aa43c6371dc2b5ddc5b6729c08', 1, 'Policy Customer', '1111', '2024-11-16', '17:17:06', 1),
(10, 'rohitmaurya112.gary@gmail.com', 'Testingch', '8948975966', 'rohitmaurya112.gary@gmail.com', 'e5d1625eabc217862c6e65a1e865b788', 1, 'Policy Customer', '1111', '2024-11-18', '14:00:03', 1),
(11, 'gujjar8915672@gmail.com', 'Anuj Adhana', '9717054517', 'gujjar8915672@gmail.com', '7096a882e34f9105d93c6ba70e981e37', 1, 'Channel Partner', '1111', '2024-11-18', '14:25:46', 1),
(12, 'test@gmail.com', 'test', '8528528525', 'test@gmail.com', '73c17a0ded536e80dd7014c9d445ee31', 1, 'Policy Customer', '1111', '2024-11-18', '14:47:23', 1),
(13, 'test@gmail.com', 'test', '8528528525', 'test@gmail.com', '73c17a0ded536e80dd7014c9d445ee31', 1, 'Policy Customer', '1111', '2024-11-18', '14:49:16', 1),
(14, 'Rahul@gmail.com', 'Rahul', '7210720153', 'Deepakchauhan7210march@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Client User', '1111', '2024-11-18', '14:53:05', 1),
(15, 'testingdf@gmail.com', 'Rahul Kashyap testing', '8528528526', 'testingdf@gmail.com', '7a06ecd34d7d5e5ae4fe5fee7fc4a50d', 1, 'Policy Customer', '1111', '2024-11-18', '15:30:08', 1),
(16, 'rohitmaurya11.gary@gmail.com', 'Mohan Testing', '8538528520', 'rohitmaurya11.gary@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Policy Customer', '1111', '2024-11-18', '16:57:34', 1),
(17, 'test4@gmail.com', 'Testing', '8528528520', 'test4@gmail.com', 'fa05f0ecfc8453646c28776e3eb0cfa1', 1, 'Policy Customer', '1111', '2024-11-19', '13:49:54', 1),
(18, 'Vaibhav ', 'Vaibhav', '2582582583', 'vaibhav@salesuhl.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Client User', '1111', '2024-11-19', '13:52:39', 1),
(19, 'rp0604326@gmail.com', 'ROHIT KUMAR SHARMA', '8219973593', 'rp0604326@gmail.com', '986a33825d03f3c371e87bcfc657b4b4', 1, 'Policy Customer', '1111', '2024-11-19', '15:44:36', 1),
(20, 'uofcharity@gmail.com', 'OMPRAKASH YADAV', '8700313923', 'uofcharity@gmail.com', '469f8c562e00fe6a0d6e2d8054d393e2', 1, 'Policy Customer', '1111', '2024-11-19', '17:11:39', 1),
(21, 'testing98@gmail.com', 'Testing', '8528528529', 'testing98@gmail.com', '97d4488e186d8fa3ea0b4888a893fdfe', 1, 'Policy Customer', '1111', '2024-11-19', '17:22:13', 1),
(22, 'pgfiry@gmail.com', 'Prateek Gupta', '8826789578', 'pgfiry@gmail.com', 'd05a5a750fb7d00b2a8d651d0541d0a6', 1, 'Policy Customer', '1111', '2024-11-19', '17:34:53', 1),
(23, 'adityamayurgupta@gmail.com', 'Rohit Kushwaha', '8874644133', 'adityamayurgupta@gmail.com', '0490d4707e348175c13d151e3b7bfc7a', 1, 'Policy Customer', '1111', '2024-11-19', '17:49:07', 1),
(24, 'prakashbackground@gmail.com', 'Omprakash Yadav ', '8700313923', 'prakashbackground@gmail.com', '469f8c562e00fe6a0d6e2d8054d393e2', 1, 'Policy Customer', '1111', '2024-11-19', '22:03:09', 1),
(25, 'prakashbackground@gmail.com', 'Omprakash Yadav ', '8700313923', 'prakashbackground@gmail.com', '469f8c562e00fe6a0d6e2d8054d393e2', 1, 'Policy Customer', '1111', '2024-11-19', '22:03:17', 1),
(26, 'prakashbackground@gmail.com', 'Omprakash Yadav ', '8700313923', 'prakashbackground@gmail.com', '469f8c562e00fe6a0d6e2d8054d393e2', 1, 'Policy Customer', '1111', '2024-11-19', '22:03:18', 1),
(27, 'prakashbackground@gmail.com', 'Omprakash Yadav ', '8700313923', 'prakashbackground@gmail.com', '469f8c562e00fe6a0d6e2d8054d393e2', 1, 'Policy Customer', '1111', '2024-11-19', '22:03:32', 1),
(28, 'prakashbackground@gmail.com', 'Omprakash Yadav ', '8700313923', 'prakashbackground@gmail.com', '469f8c562e00fe6a0d6e2d8054d393e2', 1, 'Policy Customer', '1111', '2024-11-19', '22:03:55', 1),
(29, 'lifeapana134@gmail.com', 'Omprakash Yadav', '8700313925', 'lifeapana134@gmail.com', '1511cb00613e8ffa4ea4c2934d59b0c4', 1, 'Policy Customer', '1111', '2024-11-20', '09:40:13', 1),
(30, 'rahulkashyap.gary@gmail.com', 'TestingRahul', '7906584090', 'rahulkashyap.gary@gmail.com', '5fece4f6e1612f075b3bcb1e5bc38b62', 1, 'Policy Customer', '1111', '2024-11-20', '13:03:04', 1),
(31, 'majhawaliya01@gmail.com', 'Test ', '8874644189', 'majhawaliya01@gmail.com', 'e56ac76a6eee4966ea55cc1dc5f4d665', 1, 'Policy Customer', '1111', '2024-11-20', '13:09:27', 1),
(32, 'prakashbackgroundD@gmail.com', 'OMPRAKASH YADAV', '8888888887', 'prakashbackgroundD@gmail.com', '469f8c562e00fe6a0d6e2d8054d393e2', 1, 'Policy Customer', '1111', '2024-11-20', '13:40:18', 1),
(33, 'majhawaliya09@gmail.com', 'Rohit maurya testing', '8874644131', 'majhawaliya09@gmail.com', '42f08c79a36ff3d5bdcd68572329ac6f', 1, 'Policy Customer', '1111', '2024-11-20', '14:59:52', 1),
(34, 'majhawaliya0@gmail.com', 'Chitransh Gary', '8948556633', 'majhawaliya0@gmail.com', '1511cb00613e8ffa4ea4c2934d59b0c4', 1, 'Policy Customer', '1111', '2024-11-20', '16:22:10', 1),
(35, 'rohitmaurya.gary@gmail.com', 'Rohit Maurya', '8948975967', 'rohitmaurya.gary@gmail.com', '9f7542f1a764889b8474e2e8abb74ec1', 1, 'Policy Customer', '1111', '2024-11-20', '17:11:44', 1),
(36, 'akkiechaudhary28@gmail.com', 'Akash', '09643899034', 'akkiechaudhary28@gmail.com', '08719222ff835e98348ae6336cd4c0a6', 1, 'Policy Customer', '1111', '2024-11-20', '17:35:30', 1),
(37, 'rahulrajwani900@gmail.com', 'Vijay ', '8989898989', 'rahulrajwani900@gmail.com', '1511cb00613e8ffa4ea4c2934d59b0c4', 1, 'Policy Customer', '1111', '2024-11-20', '23:05:24', 1),
(38, 'SUSHMITABACKGROUND@GMAIL.COM', 'PRAVESH', '9090909090', 'SUSHMITABACKGROUND@GMAIL.COM', '631d1c8e0d322c3fa02aceb1e07356b5', 1, 'Policy Customer', '1111', '2024-11-21', '14:02:21', 1),
(232, 'manoj.smec@gmail.com', 'Manoj Kumar Yadav', '9784246223', 'manoj.smec@gmail.com', '2c0fe6c459b39aed9565241b8eb3ee34', 1, 'Policy Customer', '1111', '2024-12-11', '16:39:24', 1),
(192, 'lifeapana@gmail.com', 'Testing', '8528528529', 'lifeapana@gmail.com', '1d165b7c8dbf1f8f836b4717a154429d', 1, 'Policy Customer', '1111', '2024-12-06', '12:02:11', 1),
(193, 'tanya9seth@gmail.com', 'TANYA RAJU SETH', '9967741679', 'tanya9seth@gmail.com', '091331bde046b1c9d5549857bade149f', 1, 'Policy Customer', '1111', '2024-12-07', '13:15:48', 1),
(194, 'sachin.kenjoor@gmail.com', 'Sachin Kenjoor', '9619912012', 'sachin.kenjoor@gmail.com', '34210133d2d54856ef43e84239ee7c1c', 1, 'Policy Customer', '1111', '2024-12-09', '16:17:34', 1),
(195, 'gopal9587501505@gmail.com', 'Ram Gopal Berwa', '9587501505', 'gopal9587501505@gmail.com', '89689eed265bb429b02aa51a632738a6', 1, 'Policy Customer', '1111', '2024-12-09', '16:21:23', 1),
(196, 'kamleshsaini21071967@gmail.com', 'Kamlesh Kumar Saini', '7877682001', 'kamleshsaini21071967@gmail.com', '83b024b69b9b17a81ff69f73df414ff6', 1, 'Policy Customer', '1111', '2024-12-09', '18:05:04', 1),
(197, 'deepak23march@gmail.com', 'Deepak chauhan', '87827382732', 'deepak23march@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '16:05:18', 1),
(198, 'tea@gmail.com ', 'tena ', '878739838', 'tea@gmail.com ', '53d70159c12ccbf7dc5db9ca2779ef08', 1, 'Policy Customer', '1111', '2024-12-10', '16:08:42', 1),
(199, 'Rohit44@gmail.com', 'Deepak chauhan', '892829282', 'Rohit44@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '16:13:38', 1),
(200, 'it@gmail.com', 'Deepak chauhan', '8736373643', 'it@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '16:16:50', 1),
(201, 'uio@gmail.com', 'Deepak chauhan', '9847648493', 'uio@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '16:18:59', 1),
(202, 'iou@gmail.com', 'Deepak chauhan', '909098383', 'iou@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '16:23:04', 1),
(203, 'Deepak22@gmail.com', 'Deepak chauhan', '8748387393', 'Deepak22@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '16:39:52', 1),
(204, 'testopo@gmail.com ', 'tets ', '9748747383', 'testopo@gmail.com ', '53d70159c12ccbf7dc5db9ca2779ef08', 1, 'Policy Customer', '1111', '2024-12-10', '16:46:14', 1),
(205, 'pop@gmail.com', 'Deepak chauhan', '809087767', 'pop@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '16:50:19', 1),
(206, 'iuo@gmail.com', 'Deepak chauhan', '989879487', 'iuo@gmail.com', '53d70159c12ccbf7dc5db9ca2779ef08', 1, 'Policy Customer', '1111', '2024-12-10', '16:52:21', 1),
(207, 'iuo90@gmail.com', 'Deepak chauhan', '989879480', 'iuo90@gmail.com', '53d70159c12ccbf7dc5db9ca2779ef08', 1, 'Policy Customer', '1111', '2024-12-10', '16:53:52', 1),
(208, 'tiu@gmai.com', 'Deepak chauhan', '0903939323', 'tiu@gmai.com', 'a70ac2f3e9ccfc042d1f43cf96133d91', 1, 'Policy Customer', '1111', '2024-12-10', '16:55:55', 1),
(209, 'pop43@gmail.com', 'Deepak chauhan', '84748479887', 'pop43@gmail.com', '53d70159c12ccbf7dc5db9ca2779ef08', 1, 'Policy Customer', '1111', '2024-12-10', '16:59:49', 1),
(210, 'lop@gmail.com', 'Deepak chauhan', '9849489374', 'lop@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '17:02:00', 1),
(211, 'wer@gmail.com', 'Deepak chauhan', '983983874', 'wer@gmail.com', '53d70159c12ccbf7dc5db9ca2779ef08', 1, 'Policy Customer', '1111', '2024-12-10', '17:06:11', 1),
(212, 'rajuvsulakhe@gmail.com', 'Rajendra Vasant Sulakhe', '9920101327', 'rajuvsulakhe@gmail.com', '418bc786bdc39592c67b1a859d01192a', 1, 'Policy Customer', '1111', '2024-12-10', '17:10:24', 1),
(213, 'Deepak7@gmail.com', 'Deepak chauhan', '984984784', 'Deepak7@gmail.com', '9e5752c0771e745aa67cad9225cf03f0', 1, 'Policy Customer', '1111', '2024-12-10', '17:59:37', 1),
(214, 'Testing', 'Testing', '8528528520', 'rohitmaurya.gary@gmail.com', '698c6a41754d31d968a6f672ba40381a', 1, 'Policy Customer', '1111', '2024-12-10', '19:04:59', 1),
(215, 'Rohit Maurya Testing ', 'Rohit Maurya Testing ', '8528528529', 'rohitmaurya.gary@gmail.com', '698c6a41754d31d968a6f672ba40381a', 1, 'Policy Customer', '1111', '2024-12-10', '21:40:03', 1),
(180, 'lifeapana278@gmail.com', 'Testing for Address Issue', '8577528500', 'lifeapana278@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-28', '15:02:45', 1),
(181, 'lifeapana378@gmail.com', 'Testing for Address Issue', '8577528400', 'lifeapana378@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-28', '15:03:19', 1),
(182, 'testing908@gmail.com', 'Testing', '7778528520', 'testing908@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-28', '15:49:35', 1),
(183, 'test999@gmail.com', 'Testing123', '1234567000', 'test999@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-28', '15:54:32', 1),
(184, 'test@cashfree.com', 'jnlk;l.', '9877678697', 'test@cashfree.com', 'd54562210ba75226d9cc1f5649cbdaa0', 1, 'Policy Customer', '1111', '2024-11-29', '11:43:53', 1),
(185, 'info@unitedhealthlumina.com', 'Rahul Singh', '8768767648', 'info@unitedhealthlumina.com', '78842cdd83ec06976dbd3b112b8b704b', 1, 'Policy Customer', '1111', '2024-11-29', '17:09:53', 1),
(186, 'test000@gmail.com', 'Testing', '1264567890', 'test000@gmail.com', '5edc37707cdfc2002027b1e0b11584f0', 1, 'Policy Customer', '1111', '2024-11-30', '15:55:33', 1),
(187, 'admin123@uhl.com', 'Testing', '8528528520', 'admin123@uhl.com', '4f76fc777dbfe60913ac6f49a713325e', 1, 'Policy Customer', '1111', '2024-12-02', '13:50:22', 1),
(188, 'rohitmaurya.gary@gmail.com', 'Rohit Maurya', '8528528520', 'rohitmaurya.gary@gmail.com', '4f76fc777dbfe60913ac6f49a713325e', 1, 'Policy Customer', '1111', '2024-12-02', '13:50:56', 1),
(189, 'devapatil2002@gmail.com', 'DEVANAND VISHNU PATIL', '9923680902', 'devapatil2002@gmail.com', 'dfd9d7df5665a77d2de2a10ee6f5d276', 1, 'Policy Customer', '1111', '2024-12-02', '14:55:44', 1),
(190, 'binduruj@hotmail.com', 'BINDU URUJ', '9820151600', 'binduruj@hotmail.com', '8847c333ead2daab6544f1587bdb8c73', 1, 'Policy Customer', '1111', '2024-12-03', '17:51:08', 1),
(191, 'PRASADRAMBRIKHS0156@GMAIL.COM', 'RAM BRIKSH PRASAD', '8146673156', 'PRASADRAMBRIKHS0156@GMAIL.COM', 'a99971ff02ecaebfdbd04e3750323314', 1, 'Policy Customer', '1111', '2024-12-05', '12:09:58', 1),
(76, 'prateek.gupta@webomates.com', 'Prateek Gupta', '8826789567', 'prateek.gupta@webomates.com', 'd05a5a750fb7d00b2a8d651d0541d0a6', 1, 'Policy Customer', '1111', '2024-11-21', '14:51:36', 1),
(227, 'Rahul Kashyap', 'Rahul Kashyap', '8528528520', 'rohitmaurya.gary@gmail.com', '07c7c8a5370127c3e9078b1f28e4a2f2', 1, 'Policy Customer', '1111', '2024-12-11', '12:02:41', 1),
(216, 'Rohit Maurya Testing ', 'Rohit Maurya Testing ', '8528528529', 'rohitmaurya.gary@gmail.com', '698c6a41754d31d968a6f672ba40381a', 1, 'Policy Customer', '1111', '2024-12-10', '21:40:04', 1),
(217, 'Rohit Maurya', 'Rohit Maurya', '8948975967', 'rohitmaurya.gary@gmail.com', '8fded72d528d21ae692ce578129543d6', 1, 'Policy Customer', '1111', '2024-12-11', '09:43:51', 1),
(218, 'Rohit Maurya', 'Rohit Maurya', '8528528520', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '10:34:30', 1),
(219, 'Testing', 'Testing', '8528528520', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '10:44:31', 1),
(220, 'Testing', 'Testing', '8528528520', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '11:15:07', 1),
(221, 'Testing', 'Testing', '8528528520', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '11:18:40', 1),
(222, 'Testing', 'Testing', '8528528520', 'rohitmaurya.gary@gmail.com', '25d34630876617e030af019a0e80f862', 1, 'Policy Customer', '1111', '2024-12-11', '11:28:04', 1),
(223, 'Rohit Maurya Testing ', 'Rohit Maurya Testing ', '8528528520', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '11:42:23', 1),
(224, 'Rohit Maurya Testing ', 'Rohit Maurya Testing ', '8528528520', 'rohitmaurya.gary@gmail.com', '25d34630876617e030af019a0e80f862', 1, 'Policy Customer', '1111', '2024-12-11', '11:46:35', 1),
(225, 'Rohit Maurya', 'Rohit Maurya', '8528528520', 'rohitmaurya.gary@gmail.com', '25d34630876617e030af019a0e80f862', 1, 'Policy Customer', '1111', '2024-12-11', '11:48:41', 1),
(226, 'Rahul Kashyap', 'Rahul Kashyap', '8528528520', 'lifeapana@gmail.com', '25d34630876617e030af019a0e80f862', 1, 'Policy Customer', '1111', '2024-12-11', '11:52:42', 1),
(89, 'nandiniissar@gmail.com', 'Nandini Satinder Issar', '9320210640', 'nandiniissar@gmail.com', '91b7f44fec9e11c6e8603966ba52ea92', 1, 'Policy Customer', '1111', '2024-11-21', '14:54:10', 1),
(157, 'deepakk@gamil.com', 'Deepak ', '989387362', 'deepakk@gamil.com', '78437fe06118302ab9269c8b74633a45', 1, 'Policy Customer', '1111', '2024-11-26', '18:15:13', 1),
(158, 'admin456@uhl.com', 'Chitransh Gary', '8528628520', 'admin456@uhl.com', 'f44459cbd0dfad98908de86222f60dfc', 1, 'Policy Customer', '1111', '2024-11-26', '18:16:52', 1),
(159, 'testingg@gmail.com', 'Prateek Gupta', '07898756142', 'testingg@gmail.com', '941e22d8a4f291e3ef640e97c4354a02', 1, 'Policy Customer', '1111', '2024-11-27', '09:45:10', 1),
(160, 'Deepak98@gmail.com', 'Rahul ', '7210920153', 'Deepak98@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-27', '10:06:45', 1),
(161, 'Rohit@gmail.com', 'Rohit ', '7210720193', 'Rohit@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-27', '12:17:47', 1),
(162, 'mohssan@gmail.com', 'mohna ', '89887373', 'mohssan@gmail.com', 'b3897bff8ea3cc7f99549fa31f8d0472', 1, 'Policy Customer', '1111', '2024-11-27', '12:27:17', 1),
(163, 'mohssssan@gmail.com', 'mohna ', '8988754373', 'mohssssan@gmail.com', 'b3897bff8ea3cc7f99549fa31f8d0472', 1, 'Policy Customer', '1111', '2024-11-27', '12:29:06', 1),
(164, 'muiussssan@gmail.com', 'mohnua ', '9090954373', 'muiussssan@gmail.com', 'b3897bff8ea3cc7f99549fa31f8d0472', 1, 'Policy Customer', '1111', '2024-11-27', '12:30:14', 1),
(165, 'raju@gmail.com', 'Raju ', '72107000', 'raju@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-27', '13:50:16', 1),
(166, 'Ravi2@gmail.com', 'Ravi ', '8783763873', 'Ravi2@gmail.com', 'b3897bff8ea3cc7f99549fa31f8d0472', 1, 'Policy Customer', '1111', '2024-11-27', '13:56:38', 1),
(167, 'manoj967505@gmail.com', 'Akash kumar', '9643899034', 'manoj967505@gmail.com', 'a42f0403e30853ac083c1f9ab5dba86f', 1, 'Policy Customer', '1111', '2024-11-27', '15:07:31', 1),
(168, 'raju23may@gmail.com', 'raju', '9282729262', 'raju23may@gmail.com', '5edc37707cdfc2002027b1e0b11584f0', 1, 'Policy Customer', '1111', '2024-11-27', '15:36:31', 1),
(169, 'rohitkushwaha134@gmail.com', 'Rohit Testing Payment', '9651265631', 'rohitkushwaha134@gmail.com', '9f7542f1a764889b8474e2e8abb74ec1', 1, 'Policy Customer', '1111', '2024-11-27', '23:35:48', 1),
(170, 'saniyajaiho@gmail.com', 'Saniya', '8929120000', 'saniyajaiho@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-28', '01:54:19', 1),
(171, 'test54@gmail.com', 'Testing12', '1234567880', 'test54@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-28', '10:04:30', 1),
(172, 'rohitmaurya90.gary@gmail.com', 'Testing34', '1234555550', 'rohitmaurya90.gary@gmail.com', '1d6bdf320b5e7b1b26c3fff880836a72', 1, 'Policy Customer', '1111', '2024-11-28', '10:07:14', 1),
(173, 'rohitkushwaha127@gmail.com', 'Rohit testing', '6393254371', 'rohitkushwaha127@gmail.com', '42f08c79a36ff3d5bdcd68572329ac6f', 1, 'Policy Customer', '1111', '2024-11-28', '11:40:50', 1),
(174, 'mahendrabandukwala1@gmail.com', 'Mahendra kumar bandukwala', '9828344264', 'mahendrabandukwala1@gmail.com', 'c6892a15e1abae479c416fc33cb9e091', 1, 'Policy Customer', '1111', '2024-11-28', '13:00:38', 1),
(175, 'mahendrabandukwala2@gmail.com', 'Mahendra kumar bandukwala', '9828344264', 'mahendrabandukwala2@gmail.com', 'c6892a15e1abae479c416fc33cb9e091', 1, 'Policy Customer', '1111', '2024-11-28', '13:07:53', 1),
(176, 'mahendrabandukwala3@gmail.com', 'Mahendra kumar bandukwala', '9828344264', 'mahendrabandukwala3@gmail.com', 'c6892a15e1abae479c416fc33cb9e091', 1, 'Policy Customer', '1111', '2024-11-28', '13:25:39', 1),
(177, 'mahendrabandukwala@gmail.com', 'Mahendra kumar bandukwala', '9828344264', 'mahendrabandukwala@gmail.com', 'c6892a15e1abae479c416fc33cb9e091', 1, 'Policy Customer', '1111', '2024-11-28', '13:29:15', 1),
(178, 'lifeapana236@gmail.com', 'Testing for Address Issue', '8577528520', 'lifeapana236@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-28', '15:00:46', 1),
(179, 'lifeapana266@gmail.com', 'Testing for Address Issue', '8577528589', 'lifeapana266@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-28', '15:02:06', 1),
(156, 'parul3@gmail.com', 'Parull', '9879748927', 'parul3@gmail.com', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-26', '17:57:01', 1),
(155, 'testingfgdd@gmail.com ', 'deepak_testing ', '989898787', 'testingfgdd@gmail.com ', '9913f136f555e8d180895e7b13f3cc29', 1, 'Policy Customer', '1111', '2024-11-26', '14:46:08', 1),
(150, 'Rahul@gmail.com ', 'Rahul ', '721082084', 'Rahul@gmail.com ', '2fed2af6f4ac6887309873c6d6f5ad4c', 1, 'Policy Customer', '1111', '2024-11-26', '12:58:48', 1),
(151, 'ravi@gmail.com ', 'Rahu ', '7219827635', 'ravi@gmail.com ', '9913f136f555e8d180895e7b13f3cc29', 1, 'Policy Customer', '1111', '2024-11-26', '13:01:38', 1),
(152, 'parul@gmail.com ', 'parul ', '8738373837', 'parul@gmail.com ', '78437fe06118302ab9269c8b74633a45', 1, 'Policy Customer', '1111', '2024-11-26', '14:01:10', 1),
(153, 'testing@gmail.com ', 'testing ', '878373873', 'testing@gmail.com ', '9913f136f555e8d180895e7b13f3cc29', 1, 'Policy Customer', '1111', '2024-11-26', '14:08:32', 1),
(154, 'mohuan@gmail.com ', 'mohan ', '872828278', 'mohuan@gmail.com ', '8dea283c95738e8618feacd3613ef614', 1, 'Policy Customer', '1111', '2024-11-26', '14:39:33', 1),
(120, 'ajadkhan05@gmail.com', 'Ajad Basheer Khan ', '9769225014', 'ajadkhan05@gmail.com', 'ee6edb919799df1dd0d2dcb20753d9a9', 1, 'Policy Customer', '1111', '2024-11-21', '15:16:06', 1),
(121, 'vnaina599@gmail.com', 'Rohit Testing', '7992011052', 'vnaina599@gmail.com', 'e7987ca6ee78baa31791ba579c39d1b1', 1, 'Policy Customer', '1111', '2024-11-22', '17:50:55', 1),
(122, 'prakashfedor@gmail.com', 'Rahul Singh', '9599119216', 'prakashfedor@gmail.com', '469f8c562e00fe6a0d6e2d8054d393e2', 1, 'Policy Customer', '1111', '2024-11-23', '12:43:44', 1),
(123, 'ombackground@gmail.com', 'Rahul', '87003139222', 'ombackground@gmail.com', 'dd29c402bf731c616c8e1afe5f7faf13', 1, 'Policy Customer', '1111', '2024-11-23', '13:52:46', 1),
(124, 'devapatil20021@gmail.com', 'Devanand Vishnu patil', '992368090121', 'devapatil20021@gmail.com', 'dfd9d7df5665a77d2de2a10ee6f5d276', 1, 'Policy Customer', '1111', '2024-11-25', '16:08:17', 1),
(125, 'devapatil2002@gmail.com', 'Devanand Vishnu patil', '9923680902', 'devapatil2002@gmail.com', '1298d4352f8eae1194aff36ee4152214', 1, 'Policy Customer', '1111', '2024-11-25', '16:14:46', 1),
(126, 'deepakch1.gary@gmail.com', 'Testing', '8948976630', 'deepakch1.gary@gmail.com', '9f7542f1a764889b8474e2e8abb74ec1', 1, 'Policy Customer', '1111', '2024-11-25', '17:32:16', 1),
(127, 'rohitkushwaha136@gmail.com', 'Testing ', '08848975967', 'rohitkushwaha136@gmail.com', '04d6c157a7ca8f8016dd416e9ca2811f', 1, 'Policy Customer', '1111', '2024-11-25', '19:49:34', 1),
(128, 'fedorprakash@gmail.com', 'Omprakash ', '8700313920', 'fedorprakash@gmail.com', '04d6c157a7ca8f8016dd416e9ca2811f', 1, 'Policy Customer', '1111', '2024-11-25', '20:40:12', 1),
(136, 'abc@gmail.com', 'Abc', '1238526549', 'abc@gmail.com', '6faf4e52b080c6173a4b69a1ffd6bd9b', 1, 'Policy Customer', '1111', '', '', 1),
(137, 'abc@gmail.com', 'Abc', '1238526549', 'abc@gmail.com', '6faf4e52b080c6173a4b69a1ffd6bd9b', 1, 'Policy Customer', '1111', '2024-11-26', '09:53:16', 1),
(138, 'test345@gmail.com', 'Testing', '8568528520', 'test345@gmail.com', 'f44459cbd0dfad98908de86222f60dfc', 1, 'Policy Customer', '1111', '2024-11-26', '09:56:46', 1),
(146, 'abdc@gmail.com', 'Abc123', '1238526549', 'abdc@gmail.com', '6faf4e52b080c6173a4b69a1ffd6bd9b', 1, 'Policy Customer', '1111', '2024-11-26', '11:17:13', 1),
(147, 'deepakch.gary@gmail.com', 'Deepk Testing', '8528529520', 'deepakch.gary@gmail.com', 'eac9f10ad87d7f62c55d6dcf61ae55a5', 1, 'Policy Customer', '1111', '2024-11-26', '11:27:47', 1),
(148, 'Deepakch.ary ', 'Deepak ', '7210720153', 'Deepakch.ary ', '9913f136f555e8d180895e7b13f3cc29', 1, 'Policy Customer', '1111', '2024-11-26', '12:27:50', 1),
(229, 'manoj.smec@gmail.com', 'Manoj Kumar Yadav', '9784246223', 'manoj.smec@gmail.com', '2c0fe6c459b39aed9565241b8eb3ee34', 1, 'Policy Customer', '1111', '2024-12-11', '16:15:33', 1),
(233, 'Prateek Gupta', 'Prateek Gupta', '8826789578', 'pgfiry@gmail.com', '94bc5d9f2e30e5678caa5a3b2feb4216', 1, 'Policy Customer', '1111', '2024-12-11', '16:43:13', 1),
(234, 'Rohit Maurya', 'Rohit Maurya', '8528528520', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '17:02:33', 1),
(235, 'Rohit Maurya', 'Rohit Maurya', '8528528520', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '17:03:49', 1),
(236, 'Rohit Maurya', 'Rohit Maurya', '8528528520', 'rohitmaurya.gary@gmail.com', '25d34630876617e030af019a0e80f862', 1, 'Policy Customer', '1111', '2024-12-11', '17:04:43', 1),
(237, 'Rohit Maurya', 'Rohit Maurya', '8528528520', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '17:08:31', 1),
(238, 'Rohit Maurya', 'Rohit Maurya', '8528528520', 'rohitmaurya.gary@gmail.com', '25d34630876617e030af019a0e80f862', 1, 'Policy Customer', '1111', '2024-12-11', '17:13:19', 1),
(239, 'sonali.goswami@ril.com', 'Sonali Goswami', '9004465917', 'sonali.goswami@ril.com', '1832a1d923208e5dd50abe27ea914208', 1, 'Policy Customer', '1111', '2024-12-11', '17:48:46', 1),
(240, 'omprakash yadav', 'omprakash yadav', '08700313923', 'prakashbackground@gmail.com', 'e39f9d11f4f2bd6e4fb066a92d3d32c2', 1, 'Policy Customer', '1111', '2024-12-11', '18:04:17', 1),
(241, 'Prateek Gupta', 'Prateek Gupta', '8948975967', 'rohitmaurya.gary@gmail.com', '850eda8e4bb380a5570df40bd82762e5', 1, 'Policy Customer', '1111', '2024-12-11', '18:53:56', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `org_module_mapping`
--
ALTER TABLE `org_module_mapping`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `temp_otp`
--
ALTER TABLE `temp_otp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `org_module_mapping`
--
ALTER TABLE `org_module_mapping`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_otp`
--
ALTER TABLE `temp_otp`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
