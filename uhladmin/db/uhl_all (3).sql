-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2024 at 05:11 AM
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
-- Database: `uhl_all`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel_partner`
--

CREATE TABLE `channel_partner` (
  `ID` int NOT NULL,
  `Name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PhoneNumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Tin` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RegistrationNumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LicenseNumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AlternativeContact` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IsActive` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `CreatedTime` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedBy` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `channel_partner`
--

INSERT INTO `channel_partner` (`ID`, `Name`, `Email`, `PhoneNumber`, `Tin`, `Address`, `RegistrationNumber`, `LicenseNumber`, `AlternativeContact`, `IsActive`, `CreatedTime`, `CreatedDate`, `CreatedBy`) VALUES
(1, 'ChannelPartner1', 'ChannelPartner1@uhl.com', '8826709578', '1234567890', 'Noida Sector-64  C-104', '1234567890', '123412341234', '8619340686', '1', '14:13:45', '2024-11-16', 'admin@uhl.com'),
(2, 'Anuj Adhana', 'gujjar8915672@gmail.com', '9717054517', '123', 'Sector-65 ,B-53, Noida Utter Pradesh', '123', '123', '9717054517', '1', '14:25:46', '2024-11-18', 'admin@uhl.com');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `ID` int NOT NULL,
  `CompanyName` varchar(100) NOT NULL DEFAULT '',
  `CompanyAddress` varchar(256) NOT NULL DEFAULT '',
  `POCName` varchar(50) NOT NULL DEFAULT '',
  `POCEmail` varchar(50) NOT NULL DEFAULT '',
  `POCContact` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_sites`
--

CREATE TABLE `company_sites` (
  `ID` int NOT NULL,
  `CompanyID` int NOT NULL,
  `ZoneID` int NOT NULL DEFAULT '-1',
  `SiteName` varchar(100) NOT NULL DEFAULT '',
  `SiteAddress` varchar(256) NOT NULL DEFAULT '',
  `SitePOCName` varchar(50) NOT NULL DEFAULT '',
  `SitePOCEmail` varchar(50) NOT NULL DEFAULT '',
  `SitePOCContact` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conf_doctor_cat`
--

CREATE TABLE `conf_doctor_cat` (
  `ID` int NOT NULL,
  `CategoryName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CatImage` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `conf_doctor_cat`
--

INSERT INTO `conf_doctor_cat` (`ID`, `CategoryName`, `CatImage`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(12, 'Homoeopath', '1730096100_homo.png', '2024-10-15', '10:13:34', '', 1),
(11, 'Cough & Fever', '1730096327_fever.png', '2024-10-15', '10:13:21', '', 1),
(13, 'Pediatrician', '1730096386_pediatrician_3461585.png', '2024-10-15', '10:13:50', '', 1),
(14, 'Gynecologist', '1730096447_gynecologist_7370313.png', '2024-10-15', '10:14:16', '', 1),
(15, 'Physiotherapist', '1730096420_phy.png', '2024-10-15', '10:14:31', '', 1),
(16, 'Nutritionist', '1730096433_nutritionist.png', '2024-10-15', '10:14:48', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_reimbursement`
--

CREATE TABLE `customer_reimbursement` (
  `ID` int NOT NULL,
  `PolicyNumber` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `HospitalName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CheckupDate` date NOT NULL,
  `CheckupCost` decimal(10,2) NOT NULL,
  `Documents` json DEFAULT NULL,
  `Status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pending',
  `CreatedDate` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedTime` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedBy` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_reimbursement`
--

INSERT INTO `customer_reimbursement` (`ID`, `PolicyNumber`, `HospitalName`, `CheckupDate`, `CheckupCost`, `Documents`, `Status`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `CreatedAt`, `IsActive`) VALUES
(1, 'UHL267549', 'Testing', '2024-11-26', '20000.00', '[]', 'Pending', '2024-11-26', '16:07:26', 'rohitmaurya.gary@gmail.com', '2024-11-26 10:37:26', 1),
(2, 'UHL267549', 'Testing', '2024-11-26', '20000.00', '[]', 'Pending', '2024-11-26', '16:08:56', 'rohitmaurya.gary@gmail.com', '2024-11-26 10:38:56', 1),
(3, 'UHL267549', 'sdfghj', '2024-11-26', '20000.00', '[]', 'Pending', '2024-11-26', '16:09:13', 'rohitmaurya.gary@gmail.com', '2024-11-26 10:39:13', 1),
(4, 'UHL267549', 'Testing', '2024-11-27', '20500.00', '[\"UHL267549_6746c9bfc9204.png\"]', 'Pending', '2024-11-27', '12:56:55', 'rohitmaurya.gary@gmail.com', '2024-11-27 07:26:55', 1),
(5, 'UHL267549', 'Testing', '2024-11-27', '20000.00', '[\"UHL267549_6746ca1ad63f8.png\"]', 'Pending', '2024-11-27', '12:58:26', 'rohitmaurya.gary@gmail.com', '2024-11-27 07:28:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `ID` int NOT NULL,
  `HospitalName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `DoctorName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `DoctorImage` varchar(255) NOT NULL DEFAULT '',
  `Gender` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PhoneNumber` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `MedicalDegrees` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Specialization` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Experience` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `LicenseNumber` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `LicenseExpiryDate` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Fee` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedDate` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedTime` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedBy` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`ID`, `HospitalName`, `DoctorName`, `DoctorImage`, `Gender`, `PhoneNumber`, `Email`, `Address`, `MedicalDegrees`, `Specialization`, `Experience`, `LicenseNumber`, `LicenseExpiryDate`, `Fee`, `Description`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(1, '', 'DR.Shavani ', 'DR.Shavani 5610_item.jpg', 'male', '07210720153', 'Deepakchauhan7210march@gmail.com', 'celo county up sec 98 Noida', 'MBBS', 'Homoeopath', '', '', '', '200', '', '2024-11-16', '14:47:00', 'admin@uhl.com', 1),
(2, 'City Care Hospital', 'Dr. John Doe', '', 'Male', '9876543210', 'johndoe@example.com', '1234 Elm Street, Springfield', 'MBBS, MD', 'Cardiology', '10 years', '', '', '', 'A highly experienced cardiologist with expertise in interventional procedures.', '', '', '', 1),
(3, 'City Care Hospital', 'Dr. John Doe', '', 'Male', '9876543210', 'johndoe@example.com', '1234 Elm Street, Springfield', 'MBBS, MD', 'Cardiology', '10 years', '', '', '', 'A highly experienced cardiologist with expertise in interventional procedures.', '2024-11-27', '14:53:42', '', 1),
(4, ' ', 'Dr. John Doe12', '', 'Male', '9976543210', 'johnd123oe@example.com', '1234 Elm Street, Springfield', 'MBBS, MD', 'Cardiology', '10 years', '', '', '', 'A highly experienced cardiologist with expertise in interventional procedures.', '2024-11-27', '14:56:02', '', 1),
(5, '', 'Dr. John Doe12', '', 'Male', '9976543210', 'johnd123oe@example.com', '1234 Elm Street, Springfield', 'MBBS, MD', 'Cardiology', '10 years', '', '', '', 'A highly experienced cardiologist with expertise in interventional procedures.', '2024-11-27', '15:11:16', '', 1),
(6, 'Testing', 'Dr. SHIVAM', '', '', '9976543210', 'johnd123oe@example.com', '1234 Elm Street, Springfield', 'MBBS, MD', 'Cardiology', '10 years', '', '', '', 'A highly experienced cardiologist with expertise in interventional procedures.', '2024-11-27', '16:03:50', 'admin@uhl.com', 1),
(7, 'Testing', 'Dr. John Doe12', '', 'Male', '9976543210', 'johnd123oe@example.com', '1234 Elm Street, Springfield', 'MBBS, MD', 'Cardiology', '10 years', '', '', '', 'A highly experienced cardiologist with expertise in interventional procedures.', '2024-11-28', '10:38:48', '', 1),
(8, 'Fortish ', 'Deepak ', '', 'female', '7210720153', 'deepak@gmail.com', 'Delhi', 'MBBS', 'Pediatrician', '2', '', '', '', 'good work ', '2024-11-28', '14:27:58', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_appointment`
--

CREATE TABLE `doctor_appointment` (
  `ID` int NOT NULL,
  `ContactNumber` varchar(100) NOT NULL DEFAULT '',
  `Name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `DoctorName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `AppointmentDate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `AppointmentTime` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Hold',
  `CreatedDate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedTime` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_form`
--

CREATE TABLE `enquiry_form` (
  `ID` int NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `MobileNumber` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Plan` varchar(100) NOT NULL DEFAULT '',
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `enquiry_form`
--

INSERT INTO `enquiry_form` (`ID`, `Name`, `MobileNumber`, `Email`, `Plan`, `CreatedDate`) VALUES
(1, 'Omprakash Yadav', '8700313923', '', 'HAPPY SURAKSHA UNLIMITED (MAIGNIT 2.0)', '2024-11-20 17:47:50'),
(2, 'test', '1234567890', '', 'REGULAR FAMILY FLOATER 3.0', '2024-11-22 11:50:33'),
(3, 'omprakash', '8700313923', '', 'HAPPY SURAKSHA UNLIMITED (FAMILY FLOATER 3.0)', '2024-11-26 08:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `ID` int NOT NULL,
  `Question` text NOT NULL,
  `Answer` text NOT NULL,
  `CreatedDate` varchar(100) NOT NULL DEFAULT '',
  `CreatedTime` varchar(100) NOT NULL DEFAULT '',
  `CreatedBy` varchar(100) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_service_report`
--

CREATE TABLE `general_service_report` (
  `ID` int NOT NULL,
  `ReportID` int NOT NULL DEFAULT '-1',
  `CompanyID` int NOT NULL,
  `CompanySiteID` int NOT NULL,
  `ReportedBy` varchar(50) NOT NULL DEFAULT '',
  `HelpdeskComplaintNumber` varchar(50) NOT NULL DEFAULT '',
  `AttendedDate` varchar(50) NOT NULL DEFAULT '',
  `RegisteredDate` varchar(50) NOT NULL DEFAULT '',
  `CompletedDate` varchar(50) NOT NULL DEFAULT '',
  `NatureOfCall` varchar(50) NOT NULL DEFAULT '',
  `ProblemReportedByClient` text NOT NULL,
  `JLLObservation` text NOT NULL,
  `ActionTaken` text NOT NULL,
  `Remarks` text NOT NULL,
  `Technician` varchar(50) NOT NULL DEFAULT '',
  `ClientRepresentative` varchar(50) NOT NULL DEFAULT '',
  `ClientRepresentativeContact` varchar(50) NOT NULL DEFAULT '',
  `ClientRepresentativeEmails` varchar(256) NOT NULL DEFAULT '',
  `ClientRepresentativeDesignation` varchar(100) NOT NULL DEFAULT '',
  `ClientSignature` varchar(256) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `UpdatedDate` varchar(50) NOT NULL DEFAULT '',
  `UpdatedTime` varchar(50) NOT NULL DEFAULT '',
  `UpdatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `policyID` int NOT NULL,
  `razorpay_payment_id` varchar(255) NOT NULL,
  `razorpay_order_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `status` enum('Success','Failed') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `policyID`, `razorpay_payment_id`, `razorpay_order_id`, `amount`, `name`, `phone`, `status`, `created_at`) VALUES
(1, 1, 'pay_PLuYs6ivgNYiwv', 'order_PLuYhvVTH6VBJe', '32999.00', 'Rohit Kushwaha Testing ', '8948975967', 'Success', '2024-11-16 08:31:51'),
(2, 2, 'pay_PLuhyXuRKqbYUr', 'order_PLuhhfNlvKCaDJ', '14999.00', 'Rohit Test Second', '8874644133', 'Success', '2024-11-16 08:40:28'),
(3, 3, 'pay_PLuoQq3Ea8NBy7', 'order_PLuoIV1m7DNPxE', '49999.00', 'Testing Customer Chanal Partner', '8948975639', 'Success', '2024-11-16 08:46:33'),
(4, 4, 'pay_PLv0UnaxnLg4xa', 'order_PLuzmC7CaFkzwT', '32999.00', 'Testing Sales man Policy Customer', '6428528520', 'Success', '2024-11-16 08:57:57'),
(5, 5, 'pay_PLv62WaSiGxdvx', 'order_PLv5dcrycvssYa', '32999.00', 'Deepak ', '07210720153', 'Success', '2024-11-16 09:03:12'),
(6, 6, 'pay_PLxtiuQLWODOcH', 'order_PLxtaS2Gkue3DN', '32999.00', 'Adarsh ', '8874644132', 'Success', '2024-11-16 11:47:40'),
(7, 7, 'pay_PMhcFWE1PwNfzt', 'order_PMhbveqj38GV8u', '32999.00', 'Testingch', '8948975966', 'Success', '2024-11-18 08:31:02'),
(8, 10, 'pay_PMj8w6dkSWxiU7', 'order_PMj8nD6oUKPhpf', '32999.00', 'Rahul Kashyap testing', '8528528526', 'Success', '2024-11-18 10:00:38'),
(9, 12, 'pay_PN5yIfdKd5JIpg', 'order_PN5y5T45q2HfYS', '5999.00', 'Testing', '8528528520', 'Success', '2024-11-19 08:20:33'),
(10, 13, 'pay_PN7xBEesMeBGfe', 'order_PN7wsaVUUj09wu', '5999.00', 'ROHIT KUMAR SHARMA', '8219973593', 'Success', '2024-11-19 10:17:03'),
(11, 16, 'pay_PN9psazhqMsRWt', 'order_PN9nueT7k3kjAs', '1.00', 'Prateek Gupta', '8826789578', 'Success', '2024-11-19 12:07:19'),
(12, 17, 'pay_PNA3WnAj7Tu2Ah', 'order_PNA2jaoF8E4xDG', '10.00', 'Rohit Kushwaha', '8874644133', 'Success', '2024-11-19 12:20:40'),
(13, 22, 'pay_PNEOZCnIl5OiIm', 'order_PNENu0AR9Z5CuP', '10.00', 'Omprakash Yadav ', '8700313923', 'Success', '2024-11-19 16:35:06'),
(14, 25, 'pay_PNToZWW6IZcBHQ', 'order_PNToPjIn5IWT3j', '10.00', 'Test ', '8874644189', 'Success', '2024-11-20 07:40:19'),
(15, 26, 'pay_PNULV8PjvMkXt1', 'order_PNUL7ZrialPSyj', '10.00', 'OMPRAKASH YADAV', '8888888887', 'Success', '2024-11-20 08:11:06'),
(16, 27, 'pay_PNVhC9KUkdnyII', 'order_PNVh62e7OYnmon', '10.00', 'Rohit maurya testing', '8874644131', 'Success', '2024-11-20 09:30:38'),
(17, 28, 'pay_PNX7EzpzMTh9ur', 'order_PNX6kQbwnK77EQ', '10.00', 'Chitransh Gary', '8948556633', 'Success', '2024-11-20 10:53:42'),
(18, 30, 'pay_PNYLbFvrCcQqCy', 'order_PNYLWAUfm9RQcN', '10.00', 'Akash', '09643899034', 'Success', '2024-11-20 12:06:27'),
(19, 31, 'pay_PNdyDbBeKkBbDV', 'order_PNdxvqhrdrUdn4', '10.00', 'Vijay ', '8989898989', 'Success', '2024-11-20 17:36:26'),
(20, 36, 'pay_POLgOn4URiPYNi', 'order_POLgIm0B0ht9A1', '10.00', 'Rohit Testing', '7992011052', 'Success', '2024-11-22 12:21:52'),
(21, 38, 'pay_POgD67Q0Ju3PjI', 'order_POgCN1OHorhC9m', '100.00', 'Rahul', '87003139222', 'Success', '2024-11-23 08:26:37'),
(22, 44, 'pay_PPaAJkmJwc2wTZ', 'order_PPaA8Ghjak3eyD', '100.00', 'Omprakash ', '8700313920', 'Success', '2024-11-25 15:10:51'),
(23, 91, 'pay_PQQELK5zJpm5Pg', 'order_PQQDxgKmNYeCN9', '10.00', 'Rohit Testing Payment', '9651265631', 'Success', '2024-11-27 18:06:36'),
(24, 95, 'pay_PQcZwG7866GBPA', 'order_PQcZneja0WllAj', '5.00', 'Rohit testing', '6393254371', 'Success', '2024-11-28 06:11:43'),
(25, 96, 'pay_PQfNoWuP4Pqdah', 'order_PQfNkcpOOthxN6', '49999.00', 'Mahendra kumar bandukwala', '9828344264', 'Success', '2024-11-28 14:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `ID` int NOT NULL,
  `PlanName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PlanImage` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PlanDuration` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PlanDurationFormat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PlanFamilyMember` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CoverageComments` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PlanCost` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PlanImportantPoint` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PlanHighlights` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PlanDescription` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PlanCoordinator` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedDate` date DEFAULT NULL,
  `CreatedTime` time NOT NULL,
  `CreatedBy` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`ID`, `PlanName`, `PlanImage`, `PlanDuration`, `PlanDurationFormat`, `PlanFamilyMember`, `CoverageComments`, `PlanCost`, `PlanImportantPoint`, `PlanHighlights`, `PlanDescription`, `PlanCoordinator`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(13, 'MED BENEFIT PRO (MED 2.0)', 'HAPPY SURAKSHA UNLIMITED (MAIGNIT 2.0)1504_item.jpg', '12', 'months', '2', ' \"Vitamin D3 Total 25-Hydroxy\" (Bone Health, Immunity & Tiredness), \"Iron Profile – Anaemia\" (Hair, Skin & Anxiety), \"HbA1c (Glycated hemoglobin)(Higher HbA1c, Greater diabetes complications)\", \"Thyroid Profile - T3 T4 TSH (Weight Gain/Loss, Mood Swings)\", \"Lipid/Cholesterol Profile (Heart health, Arteries Clogging/Hardening) \" , \"LFT - Liver Function Tests with GGT (Jaundice, Weight Loss, Abdominal Pain, Nausea)\", \"KFT - Kidney Function Tests – RFT (Kidney Diseases, Frequent Urination)\", \"CBC - Complete Haemogram (Blood Cancer, Infection, Hb & Anaemia)\", \"Electrolytes Profile (Muscle Cramps, Electrolytes Imbalance)\", \"Calcium, Phosphorus & ALP (Healthy Bones & Teeth Profile)\", \"ESR, Uric Acid and Protein(Inflammation, Joint Pain or Swelling)\", \"FBS - Blood Glucose, Urine Glucose (Diabetic Screen)\", \"Urine R/M (Urine R/E) (Detects UTI, Pus Cells, and Bacteria)\".', '49999', '\"Diagnostices,\" \"Doctor Consultation,\" \"Fitness,\" \"Day Care Consultation,\" \"Early Joining Benefits,\" \"Free Annual Health Check-up claims,\" \"Fitness & Nutrition Premium Session,\" \"Cover for Modern treatment procedures,\" and \"Full Checkup Panel 3\"', '<div>\r\n\r\n</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Diagnostics\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Doctor Consultation\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Day Care Consultation\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Early Benefits\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Annual Health Checkup\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Fitness And Nutrition Premium Session\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\" Cover For Modern Treatment Procedures\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Full Checkup Panel 3\".</li>', '<div>\r\n\r\n<div>Our comprehensive healthcare offerings include<span>&nbsp;</span><strong>Unlimited Diagnostics</strong>, ensuring that all your medical tests and screenings are covered for early detection and preventive care. We also provide<span>&nbsp;</span><strong>Unlimited Doctor Consultation</strong>, giving you continuous access to medical expertise whenever you need it. Our<span>&nbsp;</span><strong>Unlimited Fitness</strong><span>&nbsp;</span>services are designed to keep you in optimal health with personalized fitness programs. We offer<span>&nbsp;</span><strong>Unlimited Day Care Consultation</strong>, offering care for minor treatments that do not require an overnight stay. Benefit from our<span>&nbsp;</span><strong>Unlimited Early Joining Benefits</strong>, which give you the advantage of exclusive offers and privileges upon enrollment. With<span>&nbsp;</span><strong>Unlimited Free Annual Health Check-up Claims</strong>, you can stay proactive about your health, ensuring that routine check-ups are always available. Our<span>&nbsp;</span><strong>Unlimited Fitness &amp; Nutrition Premium Sessions</strong><span>&nbsp;</span>are tailored to meet your individual health and wellness goals. Additionally, our<span>&nbsp;</span><strong>Unlimited Cover for Modern Treatment Procedures</strong><span>&nbsp;</span>ensures you have access to the latest medical advancements. Lastly, we provide a<span>&nbsp;</span><strong>Full Checkup Panel 3</strong><span>&nbsp;</span>that includes a complete range of diagnostic tests to keep your health in check year-round. Together, these services are designed to provide holistic, continuous healthcare coverage for you and your family.<br /></div><p><br />\r\n</p><br /></div>', '-1', '2024-11-28', '13:22:40', 'admin@uhl.com', 1),
(12, 'HAPPY SURAKSHA UNLIMITED (INDIVIDUAL)', 'HAPPY SURAKSHA UNLIMITED (INDIVIDUAL)3676_item.jpg', '12', 'months', '1', ' \"Vitamin D3 Total 25-Hydroxy\" (Bone Health, Immunity & Tiredness), \"Iron Profile – Anaemia\" (Hair, Skin & Anxiety), \"HbA1c (Glycated hemoglobin)(Higher HbA1c, Greater diabetes complications)\", \"Thyroid Profile - T3 T4 TSH (Weight Gain/Loss, Mood Swings)\", \"Lipid/Cholesterol Profile (Heart health, Arteries Clogging/Hardening) \" , \"LFT - Liver Function Tests with GGT (Jaundice, Weight Loss, Abdominal Pain, Nausea)\", \"KFT - Kidney Function Tests – RFT (Kidney Diseases, Frequent Urination)\", \"CBC - Complete Haemogram (Blood Cancer, Infection, Hb & Anaemia)\", \"Electrolytes Profile (Muscle Cramps, Electrolytes Imbalance)\", \"Calcium, Phosphorus & ALP (Healthy Bones & Teeth Profile)\", \"ESR, Uric Acid and Protein(Inflammation, Joint Pain or Swelling)\", \"FBS - Blood Glucose, Urine Glucose (Diabetic Screen)\", \"Urine R/M (Urine R/E) (Detects UTI, Pus Cells, and Bacteria)\".', '29999', '\"Diagnostices,\" \"Doctor Consultation,\" \"Fitness,\" \"Day Care Consultation,\" \"Early Joining Benefits,\" \"Free Annual Health Check-up claims,\" \"Fitness & Nutrition Premium Session,\" \"Cover for Modern treatment procedures,\" and \"Full Checkup Panel 3\"', '<div>\r\n\r\n</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Diagnostics\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Doctor Consultation\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Early Benefits\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Annual Health Checkup\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Fitness And Nutrition Premium Session\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Cover For Modern Treatment Procedures\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Full Checkup Panel 3\"</li>', '<div>\r\n\r\nOur comprehensive healthcare offerings include <strong>Unlimited Diagnostics</strong>, ensuring that all your medical tests and screenings are covered for early detection and preventive care. We also provide <strong>Unlimited Doctor Consultation</strong>, giving you continuous access to medical expertise whenever you need it. Our <strong>Unlimited Fitness</strong> services are designed to keep you in optimal health with personalized fitness programs. We offer <strong>Unlimited Day Care Consultation</strong>, offering care for minor treatments that do not require an overnight stay. Benefit from our <strong>Unlimited Early Joining Benefits</strong>, which give you the advantage of exclusive offers and privileges upon enrollment. With <strong>Unlimited Free Annual Health Check-up Claims</strong>, you can stay proactive about your health, ensuring that routine check-ups are always available. Our <strong>Unlimited Fitness &amp; Nutrition Premium Sessions</strong> are tailored to meet your individual health and wellness goals. Additionally, our <strong>Unlimited Cover for Modern Treatment Procedures</strong> ensures you have access to the latest medical advancements. Lastly, we provide a <strong>Full Checkup Panel 3</strong> that includes a complete range of diagnostic tests to keep your health in check year-round. Together, these services are designed to provide holistic, continuous healthcare coverage for you and your family.\r\n<br /></div>', '-1', '2024-11-23', '02:08:26', 'admin@uhl.com', 1),
(9, 'REGULAR ( INDIVIDUAL)', 'REGULAR INDIVIDUAL9831_item.jpg', '12', 'months', '1', ', \"Vitamin D3 Total 25-Hydroxy\" (Bone Health, Immunity & Tiredness), \"Iron Profile – Anaemia\" (Hair, Skin & Anxiety), \"HbA1c (Glycated hemoglobin)(Higher HbA1c, Greater diabetes complications)\", \"Thyroid Profile - T3 T4 TSH (Weight Gain/Loss, Mood Swings)\", \"Lipid/Cholesterol Profile (Heart health, Arteries Clogging/Hardening) \" , \"LFT - Liver Function Tests with GGT (Jaundice, Weight Loss, Abdominal Pain, Nausea)\", \"KFT - Kidney Function Tests – RFT (Kidney Diseases, Frequent Urination)\", \"CBC - Complete Haemogram (Blood Cancer, Infection, Hb & Anaemia)\", \"Electrolytes Profile (Muscle Cramps, Electrolytes Imbalance)\", \"Calcium, Phosphorus & ALP (Healthy Bones & Teeth Profile)\", \"ESR, Uric Acid and Protein(Inflammation, Joint Pain or Swelling)\", \"FBS - Blood Glucose, Urine Glucose (Diabetic Screen)\", \"Urine R/M (Urine R/E) (Detects UTI, Pus Cells, and Bacteria)\".', '5999', '\"5000 Flexi Diagnostics Wallet\" \"Doctor Consultation\" \"Annual Health Check-up \" \"Fitness And Nutrition Premium Session\"', '<p>\r\n\r\n\r\n\r\n</p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\r\n\r\n</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><span style=\"text-align: left\"><span style=\"color: rgb(128, 128, 0);\">\"5000 Flexi Diagnostices Wallet\"</span>&nbsp;&nbsp;</span></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Doctor Consultation\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Fitness\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Full Checkup Panel 3\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<br />', '<p>\r\n\r\n\r\n\r\n</p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Diagnostics</strong>: Access to a wide range of diagnostic tests and screenings to monitor your overall health.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Doctor Consultation</strong>: Unlimited consultations with experienced doctors to address your health concerns and provide professional medical advice.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Fitness</strong>: Benefit from comprehensive fitness programs designed to improve your overall health and physical performance.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Day Care Consultation</strong>: Convenient day-care consultations for non-critical health issues, allowing you to manage your health without the need for hospital visits.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Early Joining Benefits</strong>: Special perks for those who join early, including additional services and discounts to kickstart your wellness journey.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Free Annual Health Check-up Claims</strong>: A free annual health check-up to ensure you are in optimal health, with coverage for necessary tests and screenings.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Fitness &amp; Nutrition Premium Session</strong>: Premium sessions for fitness and nutrition, tailored to help you achieve your health goals.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Cover for Modern Treatment Procedures</strong>: Coverage for advanced and modern treatment options, ensuring you have access to the latest medical procedures.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<br />', '-1', '2024-11-27', '23:37:46', 'admin@uhl.com', 1),
(10, 'REGULAR (MAGNIT 2.0)', 'REGULAR MAGNIT 2.02870_item.jpg', '12', 'months', '2', ' \"Vitamin D3 Total 25-Hydroxy\" (Bone Health, Immunity & Tiredness), \"Iron Profile – Anaemia\" (Hair, Skin & Anxiety), \"HbA1c (Glycated hemoglobin)(Higher HbA1c, Greater diabetes complications)\", \"Thyroid Profile - T3 T4 TSH (Weight Gain/Loss, Mood Swings)\", \"Lipid/Cholesterol Profile (Heart health, Arteries Clogging/Hardening) \" , \"LFT - Liver Function Tests with GGT (Jaundice, Weight Loss, Abdominal Pain, Nausea)\", \"KFT - Kidney Function Tests – RFT (Kidney Diseases, Frequent Urination)\", \"CBC - Complete Haemogram (Blood Cancer, Infection, Hb & Anaemia)\", \"Electrolytes Profile (Muscle Cramps, Electrolytes Imbalance)\", \"Calcium, Phosphorus & ALP (Healthy Bones & Teeth Profile)\", \"ESR, Uric Acid and Protein(Inflammation, Joint Pain or Swelling)\", \"FBS - Blood Glucose, Urine Glucose (Diabetic Screen)\", \"Urine R/M (Urine R/E) (Detects UTI, Pus Cells, and Bacteria)\".', '9999', '\"8000 Flexi Diagnostices Wallet\"   \"Doctor Consultation\" \"Fitness\" \"Full Checkup Panel One\"', '<p>\r\n\r\n<span>\r\n\r\n<span>\r\n\r\n</span></span></p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\r\n\r\n<span style=\" text-align: left\">\"8000 Flexi Diagnostices Wallet\"&nbsp;&nbsp;</span></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Doctor Consultation\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Fitness\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Full Checkup Panel 3\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<br />', '<p>\r\n\r\n<span>\r\n\r\n</span></p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Diagnostics</strong>: Access to a wide range of diagnostic tests and screenings to monitor your overall health.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Doctor Consultation</strong>: Unlimited consultations with experienced doctors to address your health concerns and provide professional medical advice.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Fitness</strong>: Benefit from comprehensive fitness programs designed to improve your overall health and physical performance.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Day Care Consultation</strong>: Convenient day-care consultations for non-critical health issues, allowing you to manage your health without the need for hospital visits.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Early Joining Benefits</strong>: Special perks for those who join early, including additional services and discounts to kickstart your wellness journey.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Free Annual Health Check-up Claims</strong>: A free annual health check-up to ensure you are in optimal health, with coverage for necessary tests and screenings.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Fitness &amp; Nutrition Premium Session</strong>: Premium sessions for fitness and nutrition, tailored to help you achieve your health goals.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Cover for Modern Treatment Procedures</strong>: Coverage for advanced and modern treatment options, ensuring you have access to the latest medical procedures.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<br />', '-1', '2024-11-28', '13:21:15', 'admin@uhl.com', 1),
(11, 'REGULAR (FAMILY FLOATER 3.0)', 'REGULAR FAMILY FLOATER 3.09225_item.jpg', '12', 'months', '4', ' \"Vitamin D3 Total 25-Hydroxy\" (Bone Health, Immunity & Tiredness), \"Iron Profile – Anaemia\" (Hair, Skin & Anxiety), \"HbA1c (Glycated hemoglobin)(Higher HbA1c, Greater diabetes complications)\", \"Thyroid Profile - T3 T4 TSH (Weight Gain/Loss, Mood Swings)\", \"Lipid/Cholesterol Profile (Heart health, Arteries Clogging/Hardening) \" , \"LFT - Liver Function Tests with GGT (Jaundice, Weight Loss, Abdominal Pain, Nausea)\", \"KFT - Kidney Function Tests – RFT (Kidney Diseases, Frequent Urination)\", \"CBC - Complete Haemogram (Blood Cancer, Infection, Hb & Anaemia)\", \"Electrolytes Profile (Muscle Cramps, Electrolytes Imbalance)\", \"Calcium, Phosphorus & ALP (Healthy Bones & Teeth Profile)\", \"ESR, Uric Acid and Protein(Inflammation, Joint Pain or Swelling)\", \"FBS - Blood Glucose, Urine Glucose (Diabetic Screen)\", \"Urine R/M (Urine R/E) (Detects UTI, Pus Cells, and Bacteria)\".', '15999', '\"10000 Flexi Diagnostics Wallet\" \"Doctor Consultation\" \"Fitness\" \"Early Joining Benefits\" \"Fitness And Nutrition Premium Session\" \"Full Checkup Panel 3\"', '<p>\r\n\r\n<span>\r\n\r\n<span>\r\n\r\n</span></span></p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\r\n\r\n<span style=\" text-align: left\">\"10000 Flexi Diagnostics Wallet\"</span></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Doctor Consultation\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Fitness And Nutrition Premium Session\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Full Checkup Panel 3\"</li>', '<p>\r\n\r\n\r\n\r\n</p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Diagnostics</strong>: Access to a wide range of diagnostic tests and screenings to monitor your overall health.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Doctor Consultation</strong>: Unlimited consultations with experienced doctors to address your health concerns and provide professional medical advice.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Fitness</strong>: Benefit from comprehensive fitness programs designed to improve your overall health and physical performance.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Day Care Consultation</strong>: Convenient day-care consultations for non-critical health issues, allowing you to manage your health without the need for hospital visits.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Early Joining Benefits</strong>: Special perks for those who join early, including additional services and discounts to kickstart your wellness journey.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Free Annual Health Check-up Claims</strong>: A free annual health check-up to ensure you are in optimal health, with coverage for necessary tests and screenings.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Fitness &amp; Nutrition Premium Session</strong>: Premium sessions for fitness and nutrition, tailored to help you achieve your health goals.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Cover for Modern Treatment Procedures</strong>: Coverage for advanced and modern treatment options, ensuring you have access to the latest medical procedures.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<br />', '-1', '2024-11-28', '11:42:41', 'admin@uhl.com', 1),
(14, 'HAPPY SURAKSHA UNLIMITED (FAMILY FLOATER 3.0)', 'HAPPY SURAKSHA UNLIMITED (FAMILY FLOATER 3.0)1866_item.jpg', '12', 'months', '5', '\"Vitamin D3 Total 25-Hydroxy (Bone Health, Immunity & Tiredness)\"\r\n\"Iron Profile – Anaemia (Hair, Skin & Anxiety)\"\r\n\"HbA1c (Glycated Hemoglobin) (Higher HbA1c, Greater Diabetes Complications)\"\r\n\"Thyroid Profile - T3 T4 TSH (Weight Gain/Loss, Mood Swings)\"\r\n\"Lipid/Cholesterol Profile (Heart Health, Arteries Clogging/Hardening)\"\r\n\"LFT - Liver Function Tests with GGT (Jaundice, Weight Loss, Abdominal Pain, Nausea)\"\r\n\"KFT - Kidney Function Tests – RFT (Kidney Diseases, Frequent Urination)\"\r\n\"CBC - Complete Haemogram (Blood Cancer, Infection, Hb & Anaemia)\"\r\n\"Electrolytes Profile (Muscle Cramps, Electrolytes Imbalance)\"\r\n\"Calcium, Phosphorus & ALP (Healthy Bones & Teeth Profile)\"\r\n\"ESR, Uric Acid and Protein (Inflammation, Joint Pain or Swelling)\"\r\n\"FBS - Blood Glucose, Urine Glucose (Diabetic Screen)\"\r\n\"Urine R/M (Urine R/E) (Detects UTI, Pus Cells, and Bacteria)\"', '99999', '\"Diagnostices,\" \"Doctor Consultation,\" \"Fitness,\" \"Day Care Consultation,\" \"Early Joining Benefits,\" \"Free Annual Health Check-up claims,\" \"Fitness & Nutrition Premium Session,\" \"Cover for Modern treatment procedures,\" and \"Full Checkup Panel 3\"', '<p>\r\n\r\n</p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div style=\"line-height: 100%;\">\r\n\r\n</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Diagnostics\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Doctor Consultation\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Fitness\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Day Care Consultation\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Early Joining Benefits\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Annual Health Checkup Claims\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Fitness And Nutrition Premium Session\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Cover For Modern Treatment Procedures\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li>\"Full Checkup Panel 3\"</li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<p><br />\r\n</p>', '<p>\r\n\r\n\r\n\r\n</p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Diagnostics</strong>: Access to a wide range of diagnostic tests and screenings to monitor your overall health.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Doctor Consultation</strong>: Unlimited consultations with experienced doctors to address your health concerns and provide professional medical advice.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Fitness</strong>: Benefit from comprehensive fitness programs designed to improve your overall health and physical performance.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Day Care Consultation</strong>: Convenient day-care consultations for non-critical health issues, allowing you to manage your health without the need for hospital visits.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Early Joining Benefits</strong>: Special perks for those who join early, including additional services and discounts to kickstart your wellness journey.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Free Annual Health Check-up Claims</strong>: A free annual health check-up to ensure you are in optimal health, with coverage for necessary tests and screenings.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Fitness &amp; Nutrition Premium Session</strong>: Premium sessions for fitness and nutrition, tailored to help you achieve your health goals.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<li><p><strong>Cover for Modern Treatment Procedures</strong>: Coverage for advanced and modern treatment options, ensuring you have access to the latest medical procedures.</p></li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<br />', '-1', '2024-11-23', '02:10:34', 'admin@uhl.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `policy_customer`
--

CREATE TABLE `policy_customer` (
  `ID` int NOT NULL,
  `UserID` int NOT NULL DEFAULT '-1',
  `PolicyNumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PlanID` int NOT NULL,
  `PlanAmount` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Issue_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Policy_Last_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `ContactNumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Gender` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `DateOfBirth` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Address` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `State` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '-1',
  `Pincode` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `BuyingFor` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `FamilyMemberCount` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1',
  `CreatedDate` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedTime` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedBy` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `policy_customer`
--

INSERT INTO `policy_customer` (`ID`, `UserID`, `PolicyNumber`, `PlanID`, `PlanAmount`, `Issue_Date`, `Policy_Last_Date`, `Name`, `ContactNumber`, `Gender`, `DateOfBirth`, `Email`, `Address`, `State`, `Pincode`, `BuyingFor`, `FamilyMemberCount`, `IsActive`, `CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES
(1, 2, 'UHL442150', 3, '', '2024-11-16 00:00:00', '2025-11-15 23:59:59', 'Rohit Kushwaha Testing ', '8948975965', 'male', '2000-06-29', 'rohitmaurya1123.gary@gmail.com', 'Noida Chauhan Pur  ', '1', '201301', '', '', 1, '2024-11-16', '14:01:05', 'admin@uhl.com'),
(2, 3, 'UHL515190', 8, '', '2024-11-16 00:00:00', '2025-11-15 23:59:59', 'Rohit Test Second', '8874644134', 'male', '2000-06-29', 'rohitmaurya567.gary@gmail.com', 'Chauhanpur Nirman City  Noida  ', '1', '201306', '', '', 1, '2024-11-16', '14:09:45', 'client-Itself'),
(3, 5, 'UHL631402', 2, '', '2024-11-16 00:00:00', '2025-11-15 23:59:59', 'Testing Customer Chanal Partner', '8948975639', 'male', '1995-02-26', 'testingchanalpartnercustomer@gmail.com', 'Noida Sector-65', '1', '201309', '', '', 1, '2024-11-16', '14:15:49', 'ChannelPartner1@uhl.com'),
(4, 7, 'UHL615134', 3, '', '2024-11-16 00:00:00', '2025-11-15 23:59:59', 'Testing Sales man Policy Customer', '6428528520', 'male', '1996-11-11', 'testingsalescustomer@gmail.com', 'Noida Sector-65 C-104', '1', '201306', '', '', 1, '2024-11-16', '14:26:50', 'salesman@uhl.com'),
(5, 8, 'UHL378655', 3, '', '2024-11-16 00:00:00', '2025-11-15 23:59:59', 'Deepak ', '07210720153', 'male', '1998-05-02', 'deepakch@gmail.com', 'celo county up sec 98 Noida', '31', '110099', '', '', 1, '2024-11-16', '14:32:25', 'client-Itself'),
(6, 9, 'UHL115035', 3, '', '2024-11-16 00:00:00', '2025-11-15 23:59:59', 'Adarsh ', '8874644132', 'male', '2000-04-25', 'lifeapana@gmail.com', 'Chauhanpur Nirman City  Noida  ', '1', '201301', '', '2', 1, '2024-11-16', '17:17:06', 'client-Itself'),
(7, 10, 'UHL170022', 3, '', '2024-11-18 00:00:00', '2025-11-17 23:59:59', 'Testingch', '8948975966', 'male', '2003-01-20', 'rohitmaurya112.gary@gmail.com', 'Chauhanpur Nirman City  Noida  ', '1', '201301', '', '', 1, '2024-11-18', '14:00:03', 'ChannelPartner1@uhl.com'),
(8, 12, 'UHL564988', 3, '', '2024-11-18 00:00:00', '2025-11-17 23:59:59', 'test', '8528528525', 'male', '2024-11-18', 'test@gmail.com', 'Chauhanpur Nirman City  Noida  ', '6', '111111', 'other', '1', 1, '2024-11-18', '14:47:23', 'salesman@uhl.com'),
(9, 13, 'UHL845827', 3, '', '2024-11-18 00:00:00', '2025-11-17 23:59:59', 'test', '8528528525', 'male', '2024-11-18', 'test@gmail.com', 'Chauhanpur Nirman City  Noida  ', '6', '111111', 'other', '1', 1, '2024-11-18', '14:49:16', 'salesman@uhl.com'),
(10, 15, 'UHL209300', 3, '', '2024-11-18 00:00:00', '2025-11-17 23:59:59', 'Rahul Kashyap testing', '8528528526', 'male', '2003-02-02', 'testingdf@gmail.com', 'Chauhanpur Nirman City  Noida  ', '4', '201306', 'other', '2', 1, '2024-11-18', '15:30:08', 'ChannelPartner1@uhl.com'),
(11, 16, 'UHL800870', 8, '', '2024-11-18 00:00:00', '2025-11-17 23:59:59', 'Mohan Testing', '8538528520', 'male', '2013-05-29', 'rohitmaurya11.gary@gmail.com', 'Chauhanpur Nirman City  Noida  ', '13', '111111', 'myself', '', 1, '2024-11-18', '16:57:34', 'admin@uhl.com'),
(12, 17, 'UHL567569', 9, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Testing', '8528528520', 'male', '2024-11-19', 'test4@gmail.com', 'Chauhanpur Nirman City  Noida  ', '1', '111111', 'myself', '', 1, '2024-11-19', '13:49:54', 'salesman@uhl.com'),
(13, 19, 'UHL266642', 9, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'ROHIT KUMAR SHARMA', '8219973593', 'male', '1997-05-14', 'rp0604326@gmail.com', 'Gari chaukhandi sector 68 noida', '1', '201301', 'myself', '', 1, '2024-11-19', '15:44:36', 'Vaibhav '),
(14, 20, 'UHL851874', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'OMPRAKASH YADAV', '8700313923', 'male', '1991-05-08', 'uofcharity@gmail.com', 'J/901 STELLAR JEVAN GRETAR NOIDA SECTOR 1', '1', '201306', 'myself', '', 1, '2024-11-19', '17:11:39', 'admin@uhl.com'),
(15, 21, 'UHL763983', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Testing', '8528528529', 'male', '2003-12-02', 'testing98@gmail.com', 'Chauhanpur Nirman City  Noida  ', '6', '201306', 'myself', '', 1, '2024-11-19', '17:22:13', 'client-Itself'),
(16, 22, 'UHL595805', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Prateek Gupta', '8826789578', 'male', '1989-09-29', 'pgfiry@gmail.com', 'D-101, Ajnara Homes', '1', '201301', 'myself', '', 1, '2024-11-19', '17:34:53', 'client-Itself'),
(17, 23, 'UHL104197', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Rohit Kushwaha', '8874644133', 'male', '2000-06-29', 'adityamayurgupta@gmail.com', 'D-101, Ajanara Homes', '1', '201306', 'myself', '', 1, '2024-11-19', '17:49:07', 'client-Itself'),
(18, 24, 'UHL691612', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Omprakash Yadav ', '8700313923', 'male', '1991-05-08', 'prakashbackground@gmail.com', 'J/901 stellar jeevan ', '1', '201306', 'myself', '8383838338', 1, '2024-11-19', '22:03:09', 'client-Itself'),
(19, 25, 'UHL418206', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Omprakash Yadav ', '8700313923', 'male', '1991-05-08', 'prakashbackground@gmail.com', 'J/901 stellar jeevan ', '1', '201306', 'myself', '8383838338', 1, '2024-11-19', '22:03:17', 'client-Itself'),
(20, 26, 'UHL230844', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Omprakash Yadav ', '8700313923', 'male', '1991-05-08', 'prakashbackground@gmail.com', 'J/901 stellar jeevan ', '1', '201306', 'myself', '8383838338', 1, '2024-11-19', '22:03:18', 'client-Itself'),
(21, 27, 'UHL709572', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Omprakash Yadav ', '8700313923', 'male', '1991-05-08', 'prakashbackground@gmail.com', 'J/901 stellar jeevan ', '1', '201306', 'myself', '8383838338', 1, '2024-11-19', '22:03:32', 'client-Itself'),
(22, 28, 'UHL923949', 14, '', '2024-11-19 00:00:00', '2025-11-18 23:59:59', 'Omprakash Yadav ', '8700313923', 'male', '1991-05-08', 'prakashbackground@gmail.com', 'J/901 stellar jeevan ', '1', '201306', 'myself', '', 1, '2024-11-19', '22:03:55', 'client-Itself'),
(23, 29, 'UHL243783', 14, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'Omprakash Yadav', '8700313925', 'male', '2024-11-20', 'lifeapana134@gmail.com', 'Chauhanpur Nirman City  Noida  ', '8', '111111', 'myself', '', 1, '2024-11-20', '09:40:13', 'client-Itself'),
(24, 30, 'UHL743842', 9, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'TestingRahul', '7906584090', 'male', '2000-02-24', 'rahulkashyap.gary@gmail.com', 'Noida sector-2', '16', '111111', 'myself', '', 1, '2024-11-20', '13:03:04', 'admin@uhl.com'),
(25, 31, 'UHL479951', 14, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'Test ', '8874644189', 'male', '1981-11-18', 'majhawaliya01@gmail.com', 'VPO MAJHWALIYA KHUKHUNDU DEORIA', '1', '274501', 'myself', '', 1, '2024-11-20', '13:09:27', 'client-Itself'),
(26, 32, 'UHL452087', 14, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'OMPRAKASH YADAV', '8888888887', 'male', '1991-05-08', 'prakashbackgroundD@gmail.com', 'J/901 STELLAR JEVAN GRETAR NOIDA SECTOR 1', '1', '201306', 'other', '1', 1, '2024-11-20', '13:40:18', 'client-Itself'),
(27, 33, 'UHL731324', 14, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'Rohit maurya testing', '8874644131', 'male', '2000-11-16', 'majhawaliya05@gmail.com', 'VPO MAJHWALIYA KHUKHUNDU DEORIA', '1', '274501', 'other', '2', 1, '2024-11-20', '14:59:52', 'client-Itself'),
(28, 34, 'UHL121537', 14, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'Chitransh Gary', '8948556633', 'male', '2024-11-20', 'majhawaliya0@gmail.com', 'Chauhanpur Nirman City  Noida  ', '12', '111111', 'myself', '', 1, '2024-11-20', '16:22:10', 'admin@uhl.com'),
(29, 35, 'UHL267549', 9, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'Rohit Maurya', '8948975967', 'male', '2003-06-29', 'rohitmaurya.gary@gmail.com', 'Chauhanpur Nirman City  Noida  ', '1', '201306', 'myself', '', 1, '2024-11-20', '17:11:44', 'admin@uhl.com'),
(30, 36, 'UHL325378', 14, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'Akash', '09643899034', 'male', '1994-03-30', 'akkiechaudhary28@gmail.com', 'ghaziabad', '1', '201301', 'myself', '', 1, '2024-11-20', '17:35:30', 'client-Itself'),
(31, 37, 'UHL535674', 14, '', '2024-11-20 00:00:00', '2025-11-19 23:59:59', 'Vijay ', '8989898989', 'male', '2024-11-20', 'rahulrajwani900@gmail.com', 'Stellar jeevan ', '1', '201306', 'myself', '', 1, '2024-11-20', '23:05:24', 'client-Itself'),
(32, 38, 'UHL910965', 14, '', '2024-11-21 00:00:00', '2025-11-20 23:59:59', 'PRAVESH', '9090909090', 'male', '2000-07-06', 'SUSHMITABACKGROUND@GMAIL.COM', 'J902 STEELER JEVAN ', '1', '201301', 'myself', '', 1, '2024-11-21', '14:02:21', 'admin@uhl.com'),
(33, 76, 'UHL553272', 14, '', '2024-11-21 00:00:00', '2025-11-20 23:59:59', 'Prateek Gupta', '8826789567', 'male', '1989-09-29', 'prateek.gupta@webomates.com', 'D-101, Ajnara Homes', '1', '201301', 'myself', '', 1, '2024-11-21', '14:51:36', 'admin@uhl.com'),
(34, 119, 'UHL993941', 14, '', '2024-11-21 00:00:00', '2025-11-20 23:59:59', 'Nandini Satinder Issar', '9320210640', 'female', '1972-01-11', 'nandiniissar@gmail.com', 'Satinder Issar , 21 Anukool Apartment Behind Daljit Gym Bunglows Andheri Mumbai Maharashtra 400061', '18', '400061', 'other', '1', 1, '2024-11-21', '14:57:53', 'admin@uhl.com'),
(35, 120, 'UHL553527', 14, '', '2024-11-21 00:00:00', '2025-11-20 23:59:59', 'Ajad Basheer Khan ', '9769225014', 'male', '1985-06-10', 'ajadkhan05@gmail.com', 'Sunder gali Durga  Mandir, Sanjay Nagar Kandivali West Mumbai Maharashtra', '18', '400067', 'other', '1', 1, '2024-11-21', '15:16:06', 'admin@uhl.com'),
(36, 121, 'UHL607554', 11, '', '2024-11-22 00:00:00', '2025-11-21 23:59:59', 'Rohit Testing', '7992011052', 'male', '2002-06-19', 'vnaina599@gmail.com', 'DEORIA UTTER PRADESH', '1', '204001', 'myself', '', 1, '2024-11-22', '17:50:55', 'admin@uhl.com'),
(37, 122, 'UHL519470', 9, '', '2024-11-23 00:00:00', '2025-11-22 23:59:59', 'Rahul Singh', '9599119216', 'male', '1991-05-08', 'prakashfedor@gmail.com', 'c104 noida sector 65', '1', '201301', 'myself', '', 1, '2024-11-23', '12:43:44', 'admin@uhl.com'),
(38, 123, 'UHL503668', 9, '', '2024-11-23 00:00:00', '2025-11-22 23:59:59', 'Rahul', '87003139222', 'male', '2024-11-23', 'ombackground@gmail.com', 'c104 noida sector 65', '1', '201301', 'myself', '', 1, '2024-11-23', '13:52:46', 'admin@uhl.com'),
(39, 124, 'UHL639955', 11, '', '2024-11-25 00:00:00', '2025-11-24 23:59:59', 'Devanand Vishnu patil', '99236809021', 'male', '1975-06-01', 'devapatil20021@gmail.com', 'Sidharth Residency Gandhre rode Shivaji nagar post talukk wada palghar', '18', '421303', 'other', '1', 1, '2024-11-25', '16:08:17', 'admin@uhl.com'),
(40, 125, 'UHL200797', 14, '', '2024-11-25 00:00:00', '2025-11-24 23:59:59', 'Devanand Vishnu patil', '9923680902', 'male', '1975-06-10', 'devapatil2002@gmail.com', 'Sidharth Residency Gandhre rode Shivaji nagar post talukk wada palghar', '18', '421303', 'other', '1', 1, '2024-11-25', '16:14:46', 'admin@uhl.com'),
(41, 126, 'UHL392912', 10, '', '2024-11-25 00:00:00', '2025-11-24 23:59:59', 'Testing', '8948976630', 'male', '2003-06-29', 'deepakch12.gary@gmail.com', 'Flat #24, Block-A, Tower!@Alpha, Chauhanpur Nirman City, Noida (U.P.), India', '1', '274001', 'myself', '', 1, '2024-11-25', '17:32:16', 'admin@uhl.com'),
(42, 127, 'UHL772621', 11, '', '2024-11-25 00:00:00', '2025-11-24 23:59:59', 'Testing ', '08848975967', 'male', '2024-11-25', 'rohitkushwaha136@gmail.com', 'Flat #24, Block-A, Tower!@Alpha, Chauhanpur Nirma\'n City\'s, Noida (U.P.), India', '1', '274501', 'myself', '', 1, '2024-11-25', '19:49:34', 'admin@uhl.com'),
(76, 154, 'UHL398498', 9, '', '2024-11-26 10:09:34', '2024-11-26 10:09:34', 'mohan ', '872828278', 'female', '2024-11-28', 'mohuan@gmail.com ', 'Delhi', '3', '110036', 'Other', '', 1, '2024-11-26', '14:39:33', 'admin@uhl'),
(77, 155, 'UHL284901', 9, '', '2024-11-26 10:16:08', '2024-11-26 10:16:08', 'deepak_testing ', '989898787', 'male', '2024-11-21', 'testingfgdd@gmail.com ', 'Delhi', '3', '110036', 'Other', '', 1, '2024-11-26', '14:46:08', 'admin@uhl'),
(44, 128, 'UHL395715', 9, '', '2024-11-25 00:00:00', '2025-11-24 23:59:59', 'Omprakash ', '8700313920', 'male', '2024-11-25', 'fedorprakash@gmail.com', 'Noida sector 65 ', '1', '201031', 'myself', '', 1, '2024-11-25', '20:40:12', 'client-Itself'),
(81, 159, 'UHL592864', 9, '', '2024-11-27 00:00:00', '2025-11-26 23:59:59', 'Prateek Gupta', '07898756142', 'male', '2024-11-14', 'testingg@gmail.com', 'Ground Floor, Plot no. 84, 85 and 86 Bajaj Khana, Ratlam, MP, PIN-457001', '8', '457001', 'myself', '', 1, '2024-11-27', '09:45:10', 'client-Itself'),
(80, 158, 'UHL629280', 12, '', '2024-11-26 00:00:00', '2025-11-25 23:59:59', 'Chitransh Gary', '8528628520', 'male', '2024-11-26', 'admin456@uhl.com', 'Chauhanpur Nirman City  Noida  ', '8', '111111', 'myself', '', 0, '2024-11-26', '18:16:52', 'client-Itself'),
(78, 156, 'UHL418256', 9, '', '2024-11-26 13:27:01', '2024-11-26 13:27:01', 'Parull', '9879748927', 'male', '2024-11-28', 'parul3@gmail.com', 'Delhi', '2', '110036', 'Myself', '', 1, '2024-11-26', '17:57:01', 'admin@uhl'),
(79, 157, 'UHL878077', 9, '', '2024-11-26 13:45:13', '2024-11-26 13:45:13', 'Deepak ', '989387362', 'female', '2024-11-22', 'deepakk@gamil.com', 'Delhi', '2', '110036', 'Myself', '', 1, '2024-11-26', '18:15:13', 'admin@uhl'),
(68, 146, 'UHL935233', 5, '', '2024-11-26 06:47:13', '2024-11-26 06:47:13', 'Abc123', '1238526549', 'male', '2003-03-22', 'abdc@gmail.com', ' Flat #24, Block-A, Tower!@Alpha, Chauhanpur Nirman City, Noida (U.P.), India', 'Utterpradesh', '1111', 'Myself', '', 1, '2024-11-26', '11:17:13', 'admin@uhl'),
(69, 147, 'UHL613796', 9, '', '2024-11-26 00:00:00', '2025-11-25 23:59:59', 'Deepk Testing', '8528529520', 'male', '2003-02-20', 'deepakch.gary@gmail.com', '123\\! \\@\\#Main St\\., Apartment 456, Suite 7\\&8, NY 10001, USA \\<script\\>alert\\(\'Test\'\\);\\</script\\>', '12', '111111', 'myself', '', 1, '2024-11-26', '11:27:47', 'admin@uhl.com'),
(70, 148, 'UHL193589', 9, '', '2024-11-26 07:57:50', '2024-11-26 07:57:50', 'Deepak ', '7210720153', 'male', '2024-11-21', 'Deepakch.ary ', 'bakoli delhi  1110036', '31', '110036', 'Myself', '', 1, '2024-11-26', '12:27:50', 'admin@uhl'),
(71, 149, 'UHL503166', 9, '', '2024-11-26 08:07:39', '2024-11-26 08:07:39', '', '', '', '', '', '', '', '', '', '', 0, '2024-11-26', '12:37:39', 'admin@uhl'),
(72, 150, 'UHL857090', 9, '', '2024-11-26 08:28:48', '2024-11-26 08:28:48', 'Rahul ', '721082084', 'male', '2024-11-27', 'Rahul@gmail.com ', 'Delhi', '8', '110036', 'Myself', '', 1, '2024-11-26', '12:58:48', 'admin@uhl'),
(73, 151, 'UHL847338', 9, '', '2024-11-26 08:31:38', '2024-11-26 08:31:38', 'Rahu ', '7219827635', 'male', '2024-11-21', 'ravi@gmail.com ', 'Delhi', '4', '110036', 'Myself', '', 1, '2024-11-26', '13:01:38', 'admin@uhl'),
(74, 152, 'UHL248133', 9, '', '2024-11-26 09:31:10', '2024-11-26 09:31:10', 'parul ', '8738373837', 'female', '2024-11-22', 'parul@gmail.com ', 'Delhi', '3', '110036', 'Myself', '', 1, '2024-11-26', '14:01:10', 'admin@uhl'),
(75, 153, 'UHL506898', 9, '', '2024-11-26 09:38:32', '2024-11-26 09:38:32', 'testing ', '878373873', 'male', '2024-11-21', 'testing@gmail.com ', 'Delhi', '3', '110036', 'Other', '', 1, '2024-11-26', '14:08:32', 'admin@uhl'),
(82, 160, 'UHL166811', 9, '', '2024-11-27 05:36:45', '2024-11-27 05:36:45', 'Rahul ', '7210920153', 'male', '2024-11-28', 'Deepak98@gmail.com', 'Delhi', '-1', '110036', 'Myself', '', 1, '2024-11-27', '10:06:45', 'admin@uhl'),
(83, 161, 'UHL442233', 9, '', '2024-11-27 07:47:47', '2024-11-27 07:47:47', 'Rohit ', '7210720193', 'male', '2024-11-28', 'Rohit@gmail.com', 'Delhi', '3', '110036', 'Myself', '', 1, '2024-11-27', '12:17:47', 'admin@uhl'),
(84, 162, 'UHL124759', 9, '', '2024-11-27 07:57:17', '2024-11-27 07:57:17', 'mohna ', '89887373', 'male', '2024-11-29', 'mohssan@gmail.com', 'Delhi', '5', '110036', 'Myself', '', 1, '2024-11-27', '12:27:17', 'admin@uhl'),
(85, 163, 'UHL571535', 9, '', '2024-11-27 07:59:06', '2024-11-27 07:59:06', 'mohna ', '8988754373', 'male', '2024-11-29', 'mohssssan@gmail.com', 'Delhi', '5', '110036', 'Myself', '', 1, '2024-11-27', '12:29:06', 'admin@uhl'),
(86, 164, 'UHL330547', 9, '', '2024-11-27 08:00:14', '2024-11-27 08:00:14', 'mohnua ', '9090954373', 'male', '2024-11-29', 'muiussssan@gmail.com', 'Delhi', '5', '110036', 'Myself', '', 1, '2024-11-27', '12:30:14', 'admin@uhl'),
(87, 165, 'UHL546285', 12, '', '2024-11-27 09:20:17', '2024-11-27 09:20:17', 'Raju ', '72107000', 'male', '2024-11-28', 'raju@gmail.com', 'Delhi', '7', '110036', 'Myself', '', 1, '2024-11-27', '13:50:16', 'admin@uhl'),
(88, 166, 'UHL378279', 9, '', '2024-11-27 09:26:38', '2024-11-27 09:26:38', 'Ravi ', '8783763873', 'male', '2024-11-29', 'Ravi2@gmail.com', 'Delhi', '5', '110036', 'Other', '', 1, '2024-11-27', '13:56:38', 'admin@uhl'),
(89, 167, 'UHL395757', 9, '', '2024-11-27 00:00:00', '2025-11-26 23:59:59', 'Akash kumar', '9643899034', 'male', '1994-03-03', 'manoj967505@gmail.com', 'ghaziabad', '1', '203207', 'myself', '', 0, '2024-11-27', '15:07:31', 'admin@uhl.com'),
(90, 168, 'UHL138592', 9, '', '2024-11-27 11:06:31', '2024-11-27 11:06:31', 'raju', '9282729262', 'male', '2024-11-30', 'raju23may@gmail.com', 'delhi ', '3', '110036', 'Myself', '', 1, '2024-11-27', '15:36:31', 'FromApp'),
(91, 169, 'UHL516783', 9, '', '2024-11-27 00:00:00', '2025-11-26 23:59:59', 'Rohit Testing Payment', '9651265631', 'male', '2003-06-29', 'rohitkushwaha134@gmail.com', 'VPO MAJHWALIYA KHUKHUNDU DEORIA', '1', '274501', 'myself', '', 1, '2024-11-27', '23:35:48', 'client-Itself'),
(92, 170, 'UHL837994', 9, '', '2024-11-28 00:00:00', '2025-11-27 23:59:59', 'Saniya', '8929120000', 'female', '2024-11-28', 'saniyajaiho@gmail.com', 'J/901 steering wheel drive ', '1', '201301', 'myself', '', 1, '2024-11-28', '01:54:19', 'Vaibhav '),
(93, 171, 'UHL229835', 14, '99999', '2024-11-28 00:00:00', '2025-11-27 23:59:59', 'Testing12', '1234567880', 'male', '2024-11-28', 'test54@gmail.com', 'Chauhanpur Nirman City  Noida  ', '1', '111111', 'myself', '', 1, '2024-11-28', '10:04:30', 'client-Itself'),
(94, 172, 'UHL262473', 12, '29999', '2024-11-28 00:00:00', '2025-11-27 23:59:59', 'Testing34', '1234555550', 'male', '2002-02-12', 'rohitmaurya90.gary@gmail.com', 'Chauhanpur Nirman City  Noida  ', '15', '111111', 'myself', '', 0, '2024-11-28', '10:07:14', 'admin@uhl.com'),
(95, 173, 'UHL706292', 11, '5', '2024-11-28 00:00:00', '2025-11-27 23:59:59', 'Rohit testing', '6393254371', 'male', '2000-11-16', 'rohitkushwaha127@gmail.com', 'VPO MAJHWALIYA KHUKHUNDU DEORIA', '1', '274501', 'myself', '', 1, '2024-11-28', '11:40:50', 'client-Itself'),
(96, 177, 'UHL727493', 13, '49999', '2024-11-28 00:00:00', '2025-11-27 23:59:59', 'Mahendra kumar bandukwala', '9828344264', 'male', '1967-07-15', 'mahendrabandukwala@gmail.com', 'S O Shankar lal bandukwala, hanuman mandir, 31 new polo ground saheli nagar, udaipur, rajasthan ', '25', '313004', 'other', '1', 1, '2024-11-28', '13:29:15', 'Vaibhav '),
(97, 181, 'UHL422052', 10, '9999', '2024-11-28 00:00:00', '2025-11-27 23:59:59', 'Testing for Address Issue', '8577528400', 'male', '2024-11-28', 'lifeapana378@gmail.com', '12345 Main St., Apt #@!$%^&*()_+{}|:\\\"<>?`~-=[]\\\\;\\\',./  Block 6789, Near \\\"O\\\'Connor\\\'s Place\\\" & Co., Office Email Road, Village/Locality: Anand Nagar (East) - Opp. Green Valley  City/Town: Example City (PIN: 98765) - P.O. Box 4321 State/Region: Demo-State , District: Test-District  Country: United \\\'Nations\\\' of  Example-Land', '11', '111111', 'other', '1', 0, '2024-11-28', '15:03:19', 'admin@uhl.com'),
(98, 182, 'UHL121340', 10, '9999', '2024-11-28 00:00:00', '2025-11-27 23:59:59', 'Testing', '7778528520', 'male', '2024-11-28', 'testing908@gmail.com', 'Chauhanpur Nirman City  Noida  ', '17', '111111', 'other', '1', 0, '2024-11-28', '15:49:35', 'admin@uhl.com'),
(99, 183, 'UHL649911', 10, '9999', '2024-11-28 00:00:00', '2025-11-27 23:59:59', 'Testing123', '1234567000', 'male', '2024-11-28', 'test999@gmail.com', 'Chauhanpur Nirman City  Noida  ', '14', '111111', 'other', '1', 0, '2024-11-28', '15:54:32', 'admin@uhl.com');

-- --------------------------------------------------------

--
-- Table structure for table `policy_customer_documents`
--

CREATE TABLE `policy_customer_documents` (
  `ID` int NOT NULL,
  `PolicyID` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `PolicyNumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Documents` json NOT NULL,
  `CreatedBy` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedDate` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedTime` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `IsActive` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `policy_customer_documents`
--

INSERT INTO `policy_customer_documents` (`ID`, `PolicyID`, `PolicyNumber`, `Documents`, `CreatedBy`, `CreatedDate`, `CreatedTime`, `IsActive`) VALUES
(1, '77', 'UHL284901', '[\"UHL284901_67459f808fb7b.pdf\"]', 'admin@uhl.com', '2024-11-26', '15:44:24', '1');

-- --------------------------------------------------------

--
-- Table structure for table `policy_member_details`
--

CREATE TABLE `policy_member_details` (
  `ID` int NOT NULL,
  `PolicyCustomerID` int NOT NULL,
  `PolicyNumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `DateOfBirth` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Age` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Gender` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Relationship` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `Document` json DEFAULT NULL,
  `CreatedDate` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedTime` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedBy` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `policy_member_details`
--

INSERT INTO `policy_member_details` (`ID`, `PolicyCustomerID`, `PolicyNumber`, `Name`, `DateOfBirth`, `Age`, `Gender`, `Relationship`, `Document`, `CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES
(1, 40, 'UHL200797', 'Ratana Devanand Patil', '1975-09-09', '49', 'female', 'spouse', '[\"NULL\"]', '2024-11-25', '16:14:46', 'admin@uhl.com'),
(5, 77, 'UHL284901', 'Deepak chauhan', '2024-11-21', '0', 'male ', 'Sister', '[\"67459f76583bc_supriyaTiwari (1).pdf\"]', '2024-11-26', '14:47:16', 'admin@uhl'),
(6, 77, 'UHL284901', 'sonu ', '2008-07-21', '16', 'Male', 'Brother', NULL, '2024-11-26', '14:54:18', 'admin@uhl'),
(7, 96, 'UHL727493', 'Meena', '1976-01-01', '48', 'female', 'spouse', NULL, '2024-11-28', '13:29:15', 'Vaibhav ');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID` int NOT NULL,
  `ServiceName` varchar(100) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_reports`
--

CREATE TABLE `service_reports` (
  `ID` int NOT NULL,
  `HelpdeskComplaintNumber` varchar(100) NOT NULL DEFAULT '',
  `CompanyID` int NOT NULL,
  `CompanySiteID` int NOT NULL,
  `ServiceID` int NOT NULL,
  `ChannelPartner` varchar(100) NOT NULL DEFAULT '',
  `ReportPath` varchar(256) NOT NULL DEFAULT '',
  `Status` varchar(50) NOT NULL DEFAULT 'Initiated',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_report_media`
--

CREATE TABLE `service_report_media` (
  `ID` int NOT NULL,
  `ReportID` int NOT NULL,
  `Image` varchar(256) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `ID` int NOT NULL,
  `StateName` varchar(200) NOT NULL,
  `CreatedBy` varchar(200) NOT NULL,
  `CreatedDate` varchar(50) NOT NULL,
  `CreatedTime` varchar(50) NOT NULL,
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`ID`, `StateName`, `CreatedBy`, `CreatedDate`, `CreatedTime`, `IsActive`) VALUES
(1, 'UTTAR PRADESH', '', '2023-01-27', '03:25:50', 1),
(2, 'BIHAR ', '', '2023-01-27', '03:26:07', 1),
(3, 'JARKHAND ', '', '2023-01-27', '03:26:24', 1),
(4, 'ANDHRA PRADESH', 'admin', '2023-01-30', '00:22:34', 1),
(5, 'ARUNACHAL PRADESH', 'admin', '2023-01-30', '00:26:30', 1),
(6, 'ASSAM', 'admin', '2023-01-30', '00:28:00', 1),
(7, 'WEST BENGAL', 'admin', '2023-01-30', '00:28:10', 1),
(8, 'CHHATTISGARH', 'admin', '2023-01-30', '00:29:34', 1),
(9, 'UTTARAKHAND', 'admin', '2023-01-30', '00:29:49', 1),
(10, 'GOA', 'admin', '2023-01-30', '00:30:01', 1),
(11, 'GUJARAT', 'admin', '2023-01-30', '00:30:36', 1),
(12, 'HARYANA', 'admin', '2023-01-30', '00:31:02', 1),
(13, 'HIMACHAL PRADESH', 'admin', '2023-01-30', '00:31:25', 1),
(14, 'JHARKHAND', 'admin', '2023-01-30', '00:31:57', 1),
(15, 'KARNATAKA', 'admin', '2023-01-30', '00:32:22', 1),
(16, 'KERALA', 'admin', '2023-01-30', '00:32:48', 1),
(17, 'MADHYA PRADESH', 'admin', '2023-01-30', '00:33:12', 1),
(18, 'MAHARASHTRA', 'admin', '2023-01-30', '00:33:29', 1),
(19, 'MANIPUR', 'admin', '2023-01-30', '00:33:54', 1),
(20, 'MEGHALAYA', 'admin', '2023-01-30', '00:34:16', 1),
(21, 'MIZORAM', 'admin', '2023-01-30', '00:34:36', 1),
(22, 'NAGALAND', 'admin', '2023-01-30', '00:34:51', 1),
(23, 'ODISHA', 'admin', '2023-01-30', '00:35:15', 1),
(24, 'PUNJAB', 'admin', '2023-01-30', '00:35:44', 1),
(25, 'RAJASTHAN', 'admin', '2023-01-30', '00:36:15', 1),
(26, 'SIKKIM', 'admin', '2023-01-30', '00:36:31', 1),
(27, 'TAMIL NADU', 'admin', '2023-01-30', '00:36:47', 1),
(28, 'TELANGANA', 'admin', '2023-01-30', '00:37:11', 1),
(29, 'TRIPURA', 'admin', '2023-01-30', '00:37:32', 1),
(30, 'JAMMU-KASHMIR', 'admin', '2023-01-30', '00:44:04', 1),
(31, 'DELHI', 'admin', '2023-02-03', '00:09:18', 1),
(32, 'DAMAN AND DIU', 'admin', '2023-02-06', '01:11:25', 1),
(33, 'Union territory', 'admin', '2023-02-06', '01:14:17', 0),
(34, 'CHANDIGARH', 'admin', '2023-02-08', '01:20:58', 1),
(35, 'LADAKH', 'admin', '2023-02-08', '01:22:38', 1),
(36, 'LAKSHADWEEP', 'admin', '2023-02-08', '01:23:17', 1),
(37, 'PUDUCHERRY', 'admin', '2023-02-08', '01:23:52', 1),
(38, 'ANDAMAN & NICOBAR ISLANDS', 'admin', '2023-02-08', '01:24:19', 1),
(39, 'GURGAON-HARYANA', 'admin', '2023-04-09', '07:32:43', 1),
(40, 'FARIDABAD-HARYANA', 'admin', '2023-04-09', '07:34:05', 1),
(41, 'ANDMAN AND NIKOBAR', 'admin', '2023-05-30', '05:52:31', 0),
(42, 'ANDMAN AND NIKOBAR', 'admin', '2023-05-30', '05:52:42', 0),
(43, 'DADAR NAGAR HAWELI', 'admin', '2023-05-30', '07:22:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `ID` int NOT NULL,
  `UserID` int NOT NULL,
  `UserName` varchar(50) NOT NULL DEFAULT '',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `PhoneNumber` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT '',
  `EmployeeID` varchar(50) NOT NULL DEFAULT '',
  `Address` varchar(256) NOT NULL DEFAULT '',
  `Aadhar` varchar(50) NOT NULL DEFAULT '',
  `PAN` varchar(50) NOT NULL DEFAULT '',
  `UserType` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`ID`, `UserID`, `UserName`, `Name`, `PhoneNumber`, `Email`, `EmployeeID`, `Address`, `Aadhar`, `PAN`, `UserType`, `CreatedDate`, `CreatedTime`, `CreatedBy`, `IsActive`) VALUES
(1, 6, 'salesman@uhl.com', 'Testing SelsMan', '7874562563', 'salesman@uhl.com', '', 'Sector-65 C-104', '12345678912', 'Pan1234567', '', '2024-11-16', '14:24:11', 'admin@uhl.com', 1),
(2, 14, 'Rahul@gmail.com', 'Rahul', '7210720153', 'Deepakchauhan7210march@gmail.com', '', 'celo county up sec 98 Noida\r\ncelo county up sec 98 Noida', 'sssssss', '', '', '2024-11-18', '14:53:05', 'admin@uhl.com', 1),
(3, 18, 'Vaibhav ', 'Vaibhav', '2582582583', 'vaibhav@salesuhl.com', '', 'Sector-65 C-104 Noida', '', '', '', '2024-11-19', '13:52:39', 'admin@uhl.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `ID` int NOT NULL,
  `UserID` int NOT NULL,
  `Role` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`ID`, `UserID`, `Role`, `CreatedDate`, `CreatedTime`, `IsActive`) VALUES
(1, 1, 'Admin', '16-11-2024', '13:54', 1),
(2, 2, 'Policy Customer', '2024-11-16', '14:01:05', 1),
(3, 3, 'Policy Customer', '2024-11-16', '14:09:45', 1),
(4, 4, 'Channel Partner', '2024-11-16', '14:13:45', 1),
(5, 5, 'Policy Customer', '2024-11-16', '14:15:49', 1),
(6, 6, 'Sales Man', '2024-11-16', '14:24:11', 1),
(7, 7, 'Policy Customer', '2024-11-16', '14:26:50', 1),
(8, 8, 'Policy Customer', '2024-11-16', '14:32:25', 1),
(9, 9, 'Policy Customer', '2024-11-16', '17:17:06', 1),
(10, 10, 'Policy Customer', '2024-11-18', '14:00:03', 1),
(11, 11, 'Channel Partner', '2024-11-18', '14:25:46', 1),
(12, 12, 'Policy Customer', '2024-11-18', '14:47:23', 1),
(13, 13, 'Policy Customer', '2024-11-18', '14:49:16', 1),
(14, 14, 'Sales Man', '2024-11-18', '14:53:05', 1),
(15, 15, 'Policy Customer', '2024-11-18', '15:30:08', 1),
(16, 16, 'Policy Customer', '2024-11-18', '16:57:35', 1),
(17, 17, 'Policy Customer', '2024-11-19', '13:49:54', 1),
(18, 18, 'Sales Man', '2024-11-19', '13:52:39', 1),
(19, 19, 'Policy Customer', '2024-11-19', '15:44:36', 1),
(20, 20, 'Policy Customer', '2024-11-19', '17:11:39', 1),
(21, 21, 'Policy Customer', '2024-11-19', '17:22:13', 1),
(22, 22, 'Policy Customer', '2024-11-19', '17:34:53', 1),
(23, 23, 'Policy Customer', '2024-11-19', '17:49:07', 1),
(24, 28, 'Policy Customer', '2024-11-19', '22:03:55', 1),
(25, 29, 'Policy Customer', '2024-11-20', '09:40:13', 1),
(26, 30, 'Policy Customer', '2024-11-20', '13:03:04', 1),
(27, 31, 'Policy Customer', '2024-11-20', '13:09:28', 1),
(28, 32, 'Policy Customer', '2024-11-20', '13:40:18', 1),
(29, 33, 'Policy Customer', '2024-11-20', '14:59:52', 1),
(30, 34, 'Policy Customer', '2024-11-20', '16:22:10', 1),
(31, 35, 'Policy Customer', '2024-11-20', '17:11:44', 1),
(32, 36, 'Policy Customer', '2024-11-20', '17:35:30', 1),
(33, 37, 'Policy Customer', '2024-11-20', '23:05:24', 1),
(34, 38, 'Policy Customer', '2024-11-21', '14:02:21', 1),
(35, 76, 'Policy Customer', '2024-11-21', '14:51:36', 1),
(36, 119, 'Policy Customer', '2024-11-21', '14:57:53', 1),
(37, 120, 'Policy Customer', '2024-11-21', '15:16:06', 1),
(38, 121, 'Policy Customer', '2024-11-22', '17:50:55', 1),
(39, 122, 'Policy Customer', '2024-11-23', '12:43:44', 1),
(40, 123, 'Policy Customer', '2024-11-23', '13:52:46', 1),
(41, 124, 'Policy Customer', '2024-11-25', '16:08:17', 1),
(42, 125, 'Policy Customer', '2024-11-25', '16:14:46', 1),
(43, 126, 'Policy Customer', '2024-11-25', '17:32:16', 1),
(44, 127, 'Policy Customer', '2024-11-25', '19:49:34', 1),
(45, 128, 'Policy Customer', '2024-11-25', '20:40:12', 1),
(46, 129, 'Policy Customer', '2024-11-25', '20:51:16', 1),
(47, 130, 'Policy Customer', '2024-11-25', '20:52:37', 1),
(48, 131, 'Policy Customer', '2024-11-25', '20:54:12', 1),
(49, 132, 'Policy Customer', '2024-11-25', '20:55:32', 1),
(50, 133, 'Policy Customer', '2024-11-25', '20:56:03', 1),
(51, 134, 'Policy Customer', '2024-11-25', '21:01:44', 1),
(52, 135, 'Policy Customer', '2024-11-25', '21:03:33', 1),
(53, 136, 'Policy Customer', '2024-11-26', '09:49:22', 1),
(54, 137, 'Policy Customer', '2024-11-26', '09:53:16', 1),
(55, 138, 'Policy Customer', '2024-11-26', '09:56:46', 1),
(56, 139, 'Policy Customer', '2024-11-26', '10:00:20', 1),
(67, 150, 'Policy Customer', '2024-11-26', '12:58:48', 1),
(66, 149, 'Policy Customer', '2024-11-26', '12:37:39', 1),
(65, 148, 'Policy Customer', '2024-11-26', '12:27:50', 1),
(64, 147, 'Policy Customer', '2024-11-26', '11:27:47', 1),
(61, 144, 'Policy Customer', '2024-11-26', '11:05:29', 1),
(63, 146, 'Policy Customer', '2024-11-26', '11:17:13', 1),
(68, 151, 'Policy Customer', '2024-11-26', '13:01:38', 1),
(69, 152, 'Policy Customer', '2024-11-26', '14:01:10', 1),
(70, 153, 'Policy Customer', '2024-11-26', '14:08:32', 1),
(71, 154, 'Policy Customer', '2024-11-26', '14:39:34', 1),
(72, 155, 'Policy Customer', '2024-11-26', '14:46:08', 1),
(73, 156, 'Policy Customer', '2024-11-26', '17:57:01', 1),
(74, 157, 'Policy Customer', '2024-11-26', '18:15:13', 1),
(75, 158, 'Policy Customer', '2024-11-26', '18:16:52', 1),
(76, 159, 'Policy Customer', '2024-11-27', '09:45:10', 1),
(77, 160, 'Policy Customer', '2024-11-27', '10:06:45', 1),
(78, 161, 'Policy Customer', '2024-11-27', '12:17:47', 1),
(79, 162, 'Policy Customer', '2024-11-27', '12:27:17', 1),
(80, 163, 'Policy Customer', '2024-11-27', '12:29:06', 1),
(81, 164, 'Policy Customer', '2024-11-27', '12:30:14', 1),
(82, 165, 'Policy Customer', '2024-11-27', '13:50:16', 1),
(83, 166, 'Policy Customer', '2024-11-27', '13:56:38', 1),
(84, 167, 'Policy Customer', '2024-11-27', '15:07:31', 1),
(85, 168, 'Policy Customer', '2024-11-27', '15:36:31', 1),
(86, 169, 'Policy Customer', '2024-11-27', '23:35:48', 1),
(87, 170, 'Policy Customer', '2024-11-28', '01:54:19', 1),
(88, 171, 'Policy Customer', '2024-11-28', '10:04:30', 1),
(89, 172, 'Policy Customer', '2024-11-28', '10:07:14', 1),
(90, 173, 'Policy Customer', '2024-11-28', '11:40:50', 1),
(91, 177, 'Policy Customer', '2024-11-28', '13:29:15', 1),
(92, 181, 'Policy Customer', '2024-11-28', '15:03:19', 1),
(93, 182, 'Policy Customer', '2024-11-28', '15:49:35', 1),
(94, 183, 'Policy Customer', '2024-11-28', '15:54:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `ID` int NOT NULL,
  `ZoneName` varchar(256) NOT NULL DEFAULT '',
  `ZoneEmail` varchar(256) NOT NULL DEFAULT '',
  `CreatedDate` varchar(50) NOT NULL DEFAULT '',
  `CreatedTime` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `IsActive` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel_partner`
--
ALTER TABLE `channel_partner`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `company_sites`
--
ALTER TABLE `company_sites`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `conf_doctor_cat`
--
ALTER TABLE `conf_doctor_cat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer_reimbursement`
--
ALTER TABLE `customer_reimbursement`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `enquiry_form`
--
ALTER TABLE `enquiry_form`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `general_service_report`
--
ALTER TABLE `general_service_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `policy_customer`
--
ALTER TABLE `policy_customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `policy_customer_documents`
--
ALTER TABLE `policy_customer_documents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `policy_member_details`
--
ALTER TABLE `policy_member_details`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `service_reports`
--
ALTER TABLE `service_reports`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `service_report_media`
--
ALTER TABLE `service_report_media`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channel_partner`
--
ALTER TABLE `channel_partner`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_sites`
--
ALTER TABLE `company_sites`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conf_doctor_cat`
--
ALTER TABLE `conf_doctor_cat`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer_reimbursement`
--
ALTER TABLE `customer_reimbursement`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiry_form`
--
ALTER TABLE `enquiry_form`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_service_report`
--
ALTER TABLE `general_service_report`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `policy_customer`
--
ALTER TABLE `policy_customer`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `policy_customer_documents`
--
ALTER TABLE `policy_customer_documents`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `policy_member_details`
--
ALTER TABLE `policy_member_details`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_reports`
--
ALTER TABLE `service_reports`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_report_media`
--
ALTER TABLE `service_report_media`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
