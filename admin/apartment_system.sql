-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 01:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `fname`, `lname`) VALUES
(1, 'Keith', 'Garma'),
(2, 'Timothy', 'Rivero');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaintID` int(11) NOT NULL,
  `tenantID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `complaintDate` date NOT NULL DEFAULT current_timestamp(),
  `complaintSubject` varchar(255) NOT NULL,
  `complaintDescription` varchar(255) NOT NULL,
  `complaintStatus` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaintID`, `tenantID`, `unitID`, `complaintDate`, `complaintSubject`, `complaintDescription`, `complaintStatus`) VALUES
(3, 5, 2, '2024-11-18', 'Noise Complaint', 'Junny on unit 1 is playing loud music at the middle of the night.', 'resolved');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `monthYear` varchar(20) NOT NULL,
  `rentAmount` decimal(10,2) NOT NULL,
  `issueDate` date NOT NULL,
  `dueDate` date NOT NULL,
  `paymentStatus` enum('paid','unpaid','overdue') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `unitID`, `monthYear`, `rentAmount`, `issueDate`, `dueDate`, `paymentStatus`) VALUES
(56, 1, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'paid'),
(57, 2, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'paid'),
(58, 3, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'paid'),
(59, 4, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'paid'),
(60, 5, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'paid'),
(61, 6, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'paid'),
(62, 7, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'paid'),
(63, 8, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'overdue'),
(64, 9, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'overdue'),
(65, 10, 'December 2024', 3000.00, '2024-11-30', '2024-12-03', 'overdue'),
(66, 11, 'December 2024', 5000.00, '2024-11-30', '2024-12-03', 'paid'),
(67, 12, 'December 2024', 5000.00, '2024-11-30', '2024-12-03', 'overdue'),
(68, 13, 'December 2024', 5000.00, '2024-11-30', '2024-12-03', 'overdue'),
(69, 14, 'December 2024', 5000.00, '2024-11-30', '2024-12-03', 'overdue'),
(70, 15, 'December 2024', 5000.00, '2024-11-30', '2024-12-03', 'overdue'),
(71, 16, 'December 2024', 5000.00, '2024-11-30', '2024-12-03', 'paid'),
(72, 18, 'December 2024', 5000.00, '2024-11-30', '2024-12-03', 'overdue'),
(73, 19, 'December 2024', 5000.00, '2024-11-30', '2024-12-03', 'overdue'),
(74, 1, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(75, 2, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(76, 3, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(77, 4, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(78, 5, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(79, 6, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(80, 7, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(81, 8, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(82, 9, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(83, 10, 'November 2024', 3000.00, '2024-11-01', '2024-11-03', 'paid'),
(84, 11, 'November 2024', 5000.00, '2024-11-01', '2024-11-03', 'paid'),
(85, 12, 'November 2024', 5000.00, '2024-11-01', '2024-11-03', 'paid'),
(86, 13, 'November 2024', 5000.00, '2024-11-01', '2024-11-03', 'paid'),
(87, 14, 'November 2024', 5000.00, '2024-11-01', '2024-11-03', 'paid'),
(88, 15, 'November 2024', 5000.00, '2024-11-01', '2024-11-03', 'paid'),
(89, 16, 'November 2024', 5000.00, '2024-11-01', '2024-11-03', 'paid'),
(90, 18, 'November 2024', 5000.00, '2024-11-01', '2024-11-03', 'paid'),
(91, 19, 'November 2024', 5000.00, '2024-11-01', '2024-11-03', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `lease`
--

CREATE TABLE `lease` (
  `leaseID` int(11) NOT NULL,
  `tenantID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `lease`
--

INSERT INTO `lease` (`leaseID`, `tenantID`, `unitID`, `startDate`, `endDate`) VALUES
(1, 3, 1, '2024-11-01', '2025-04-30'),
(2, 5, 2, '2024-11-01', '2025-04-30'),
(3, 74, 3, '2024-11-01', '2025-04-30'),
(4, 6, 4, '2024-11-01', '2025-04-30'),
(5, 43, 5, '2024-11-01', '2025-04-30'),
(6, 26, 6, '2024-11-01', '2025-04-30'),
(7, 67, 7, '2024-11-01', '2025-04-30'),
(8, 70, 8, '2024-11-01', '2025-04-30'),
(9, 27, 9, '2024-11-01', '2025-04-30'),
(10, 36, 10, '2024-11-01', '2025-04-30'),
(11, 53, 11, '2024-11-01', '2025-04-30'),
(12, 28, 12, '2024-11-01', '2025-04-30'),
(13, 31, 13, '2024-11-01', '2025-04-30'),
(14, 29, 14, '2024-11-01', '2025-04-30'),
(15, 25, 15, '2024-11-01', '2025-04-30'),
(16, 38, 16, '2024-11-01', '2025-04-30'),
(17, 42, 18, '2024-11-01', '2025-04-30'),
(18, 32, 19, '2024-11-01', '2025-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `logID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `logDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `type` enum('tenant','admin') NOT NULL,
  `logType` enum('login','logout') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`logID`, `userID`, `logDateTime`, `type`, `logType`) VALUES
(1, 1, '2024-11-28 15:18:58', 'admin', 'login'),
(2, 1, '2024-11-28 15:20:27', 'admin', 'logout'),
(3, 1, '2024-11-28 15:21:19', 'admin', 'login'),
(4, 1, '2024-11-28 15:58:03', 'admin', 'logout'),
(5, 5, '2024-11-28 15:58:08', 'tenant', 'login'),
(6, 1, '2024-11-28 15:58:20', 'admin', 'login'),
(7, 1, '2024-11-28 15:59:00', 'admin', 'logout'),
(8, 5, '2024-11-28 15:59:54', 'tenant', 'login'),
(9, 5, '2024-11-28 15:59:57', 'tenant', 'logout'),
(10, 1, '2024-11-28 16:00:02', 'admin', 'login'),
(11, 1, '2024-11-29 18:47:42', 'admin', 'logout'),
(12, 5, '2024-11-29 18:47:48', 'tenant', 'login'),
(13, 5, '2024-11-29 19:16:15', 'tenant', 'logout'),
(14, 3, '2024-11-29 19:16:33', 'tenant', 'login'),
(15, 3, '2024-11-29 19:17:33', 'tenant', 'logout'),
(16, 8, '2024-11-29 19:17:40', 'tenant', 'login'),
(17, 8, '2024-11-29 19:17:45', 'tenant', 'logout'),
(18, 25, '2024-11-29 19:18:03', 'tenant', 'login'),
(19, 25, '2024-11-29 19:19:46', 'tenant', 'logout'),
(20, 1, '2024-11-29 19:41:30', 'admin', 'login'),
(21, 1, '2024-11-29 20:03:37', 'admin', 'logout'),
(22, 5, '2024-11-29 20:03:41', 'tenant', 'login'),
(23, 5, '2024-11-29 20:04:08', 'tenant', 'logout'),
(24, 1, '2024-11-29 20:04:20', 'admin', 'login'),
(25, 1, '2024-11-29 20:12:52', 'admin', 'logout'),
(26, 1, '2024-11-29 20:18:03', 'admin', 'login'),
(27, 1, '2024-11-29 20:25:43', 'admin', 'logout'),
(28, 3, '2024-11-29 20:25:49', 'tenant', 'login'),
(29, 3, '2024-11-29 20:28:12', 'tenant', 'logout'),
(30, 1, '2024-11-29 20:28:16', 'admin', 'login'),
(31, 1, '2024-11-30 17:37:57', 'admin', 'logout'),
(32, 5, '2024-11-30 17:38:18', 'tenant', 'login'),
(33, 1, '2024-11-30 18:02:12', 'admin', 'login'),
(34, 5, '2024-11-30 18:35:47', 'tenant', 'logout'),
(35, 5, '2024-11-30 19:52:23', 'tenant', 'login'),
(36, 5, '2024-11-30 19:57:52', 'tenant', 'logout'),
(37, 1, '2024-11-30 19:58:03', 'admin', 'login'),
(38, 1, '2024-11-30 19:59:13', 'admin', 'logout'),
(39, 5, '2024-11-30 19:59:17', 'tenant', 'login'),
(40, 5, '2024-11-30 21:26:28', 'tenant', 'logout'),
(41, 5, '2024-11-30 21:41:43', 'tenant', 'login'),
(42, 5, '2024-11-30 21:42:08', 'tenant', 'logout'),
(43, 1, '2024-11-30 21:42:26', 'admin', 'login'),
(44, 74, '2024-11-30 23:15:32', 'tenant', 'login'),
(45, 74, '2024-11-30 23:19:14', 'tenant', 'logout'),
(46, 33, '2024-11-30 23:19:20', 'tenant', 'login'),
(47, 33, '2024-11-30 23:23:13', 'tenant', 'logout'),
(48, 3, '2024-11-30 23:23:19', 'tenant', 'login'),
(49, 3, '2024-11-30 23:30:04', 'tenant', 'logout'),
(50, 6, '2024-11-30 23:30:20', 'tenant', 'login'),
(51, 6, '2024-11-30 23:31:58', 'tenant', 'logout'),
(52, 43, '2024-11-30 23:34:01', 'tenant', 'login'),
(53, 1, '2024-11-30 23:52:57', 'admin', 'logout'),
(54, 5, '2024-11-30 23:54:49', 'tenant', 'login'),
(55, 5, '2024-11-30 23:54:52', 'tenant', 'logout'),
(56, 5, '2024-11-30 23:55:19', 'tenant', 'login'),
(57, 5, '2024-11-30 23:55:36', 'tenant', 'logout'),
(58, 1, '2024-11-30 23:55:43', 'admin', 'login'),
(59, 1, '2024-11-30 23:56:40', 'admin', 'logout'),
(60, 38, '2024-11-30 23:56:54', 'tenant', 'login'),
(61, 38, '2024-11-30 23:58:50', 'tenant', 'logout'),
(62, 5, '2024-11-30 23:58:56', 'tenant', 'login'),
(63, 5, '2024-11-30 23:59:21', 'tenant', 'logout'),
(64, 1, '2024-12-02 12:21:37', 'admin', 'login'),
(65, 1, '2024-12-02 12:28:43', 'admin', 'logout'),
(66, 5, '2024-12-02 12:28:46', 'tenant', 'login'),
(67, 5, '2024-12-02 12:30:53', 'tenant', 'logout'),
(68, 1, '2024-12-02 12:31:00', 'admin', 'login'),
(69, 1, '2024-12-02 12:35:42', 'admin', 'logout'),
(70, 5, '2024-12-02 12:35:45', 'tenant', 'login'),
(71, 5, '2024-12-02 12:41:46', 'tenant', 'logout'),
(72, 1, '2024-12-02 12:41:49', 'admin', 'login'),
(73, 1, '2024-12-02 13:30:29', 'admin', 'logout'),
(74, 5, '2024-12-02 13:30:37', 'tenant', 'login'),
(75, 5, '2024-12-02 13:37:06', 'tenant', 'logout'),
(76, 5, '2024-12-02 14:06:18', 'tenant', 'login'),
(77, 5, '2024-12-02 14:07:06', 'tenant', 'logout'),
(78, 43, '2024-12-02 14:07:21', 'tenant', 'login'),
(79, 43, '2024-12-02 14:07:24', 'tenant', 'logout'),
(80, 40, '2024-12-02 14:07:37', 'tenant', 'login'),
(81, 40, '2024-12-02 14:08:39', 'tenant', 'logout'),
(82, 1, '2024-12-02 14:08:45', 'admin', 'login'),
(83, 1, '2024-12-02 14:20:56', 'admin', 'logout'),
(84, 5, '2024-12-02 20:20:06', 'tenant', 'login'),
(85, 5, '2024-12-02 20:25:19', 'tenant', 'logout'),
(86, 1, '2024-12-02 20:26:11', 'admin', 'login'),
(87, 1, '2024-12-02 20:27:01', 'admin', 'logout'),
(88, 5, '2024-12-02 20:27:04', 'tenant', 'login'),
(89, 5, '2024-12-02 20:27:38', 'tenant', 'logout'),
(90, 26, '2024-12-02 20:28:11', 'tenant', 'login'),
(91, 26, '2024-12-02 20:38:35', 'tenant', 'logout'),
(92, 5, '2024-12-02 20:42:44', 'tenant', 'login'),
(93, 5, '2024-12-02 20:44:35', 'tenant', 'logout'),
(94, 1, '2024-12-02 20:44:49', 'admin', 'login'),
(95, 1, '2024-12-02 23:00:09', 'admin', 'logout'),
(96, 1, '2024-12-02 23:01:22', 'admin', 'login'),
(97, 1, '2024-12-02 23:02:27', 'admin', 'logout'),
(98, 5, '2024-12-02 23:02:33', 'tenant', 'login'),
(99, 5, '2024-12-02 23:03:07', 'tenant', 'logout'),
(100, 6, '2024-12-02 23:03:14', 'tenant', 'login'),
(101, 6, '2024-12-02 23:03:30', 'tenant', 'logout'),
(102, 5, '2024-12-02 23:54:23', 'tenant', 'login'),
(103, 5, '2024-12-02 23:54:32', 'tenant', 'logout'),
(104, 1, '2024-12-03 11:31:20', 'admin', 'login'),
(105, 67, '2024-12-03 11:36:05', 'tenant', 'login'),
(106, 67, '2024-12-03 11:50:00', 'tenant', 'logout'),
(107, 1, '2024-12-03 20:55:08', 'admin', 'login'),
(108, 53, '2024-12-03 21:21:07', 'tenant', 'login'),
(109, 1, '2024-12-03 22:13:51', 'admin', 'logout'),
(110, 5, '2024-12-03 22:58:42', 'tenant', 'login'),
(111, 5, '2024-12-03 23:27:38', 'tenant', 'logout'),
(112, 1, '2024-12-04 10:07:44', 'admin', 'login'),
(127, 1, '2024-12-04 16:36:17', 'admin', 'logout'),
(128, 1, '2024-12-04 16:46:05', 'admin', 'login'),
(129, 5, '2024-12-04 16:54:40', 'tenant', 'login'),
(130, 5, '2024-12-04 17:23:29', 'tenant', 'logout'),
(131, 5, '2024-12-04 17:26:48', 'tenant', 'login'),
(132, 5, '2024-12-04 17:33:12', 'tenant', 'logout'),
(133, 5, '2024-12-04 18:02:05', 'tenant', 'login'),
(134, 5, '2024-12-04 18:13:16', 'tenant', 'logout');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `requestID` int(11) NOT NULL,
  `tenantID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `requestDate` date NOT NULL DEFAULT current_timestamp(),
  `requestDescription` varchar(255) NOT NULL,
  `requestStatus` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`requestID`, `tenantID`, `unitID`, `requestDate`, `requestDescription`, `requestStatus`) VALUES
(1, 3, 1, '2024-11-16', 'Wall Paint', 'completed'),
(2, 5, 2, '2024-11-16', 'Water Leak', 'completed'),
(3, 3, 1, '2024-11-16', 'Fix door lock', 'pending'),
(13, 6, 3, '2024-11-18', 'Fix Heater', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `tenantID` int(11) NOT NULL,
  `paymentDate` date NOT NULL DEFAULT current_timestamp(),
  `paymentAmount` decimal(11,2) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `referenceNum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `invoiceID`, `tenantID`, `paymentDate`, `paymentAmount`, `paymentMethod`, `referenceNum`) VALUES
(11, 57, 5, '2024-11-30', 3000.00, 'gcash', 'jojDsYp'),
(12, 58, 74, '2024-11-30', 3000.00, 'gcash', 'jnKBUH5'),
(13, 56, 3, '2024-11-30', 3000.00, 'gcash', 'bdYyajr'),
(14, 59, 6, '2024-11-30', 3000.00, 'gcash', 'BV7GzTz'),
(15, 60, 43, '2024-11-30', 3000.00, 'gcash', 'ddpbFkR'),
(16, 71, 38, '2024-11-30', 5000.00, 'gcash', 'NdBtfpB'),
(17, 61, 26, '2024-12-02', 3000.00, 'gcash', 'cVuiTTC'),
(18, 74, 3, '2024-11-01', 3000.00, 'cash', ''),
(55, 75, 5, '2024-11-01', 3000.00, 'cash', ''),
(56, 76, 74, '2024-11-01', 3000.00, 'cash', ''),
(57, 77, 6, '2024-11-01', 3000.00, 'cash', ''),
(58, 78, 43, '2024-11-01', 3000.00, 'cash', ''),
(59, 79, 26, '2024-11-01', 3000.00, 'cash', ''),
(60, 80, 67, '2024-11-01', 3000.00, 'cash', ''),
(61, 81, 40, '2024-11-01', 3000.00, 'cash', ''),
(62, 82, 27, '2024-11-01', 3000.00, 'cash', ''),
(63, 83, 36, '2024-11-01', 3000.00, 'cash', ''),
(64, 84, 53, '2024-11-01', 5000.00, 'cash', ''),
(65, 85, 28, '2024-11-01', 5000.00, 'cash', ''),
(66, 86, 31, '2024-11-01', 5000.00, 'cash', ''),
(67, 87, 29, '2024-11-01', 5000.00, 'cash', ''),
(68, 88, 25, '2024-11-01', 5000.00, 'cash', ''),
(69, 89, 38, '2024-11-01', 5000.00, 'cash', ''),
(70, 90, 42, '2024-11-01', 5000.00, 'cash', ''),
(71, 91, 32, '2024-11-01', 5000.00, 'cash', ''),
(72, 62, 67, '2024-12-03', 3000.00, 'gcash', 'LkpbTJY'),
(73, 66, 53, '2024-12-03', 5000.00, 'card', 'zjawE1A');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenantID` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `tenantImage` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `unitID` int(11) NOT NULL,
  `reset_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenantID`, `fname`, `mname`, `lname`, `tenantImage`, `contact`, `email`, `unitID`, `reset_code`) VALUES
(3, 'Ferdinand Jr.', 'Carlos', 'Rodriguez', 'assets/uploads/profile/1732027956.png', '09123456789', 'ferodriguez@gmail.com', 1, ''),
(5, 'Ervin Angelo', 'Miguel', 'Ilarde', 'assets/uploads/profile/1732029653.jpg', '09987654321', 'ervinilarde18@gmail.com', 2, ''),
(6, 'Miguel', 'Andrew', 'Capiral', 'assets/uploads/profile/1732029066.png', '09987654321', 'migscapiral@gmail.com', 4, ''),
(8, 'Jowa', 'Nicolas', 'Ervin', 'assets/uploads/profile/1732198523.jpg', '09987654321', 'keithgarma001@gmail.com', 2, ''),
(25, 'Pieter', 'Alexander', 'Cuningham', '', '09827406773', 'pcuningham0@gmail.com', 15, ''),
(26, 'Nana', 'Rafael', 'Ucchino', '', '09798351791', 'nucchino1@gmail.com', 6, ''),
(27, 'Marcia', 'Katherine', 'Viollet', '', '09615794910', 'mviollet2@gmail.com', 9, ''),
(28, 'Stillmann', 'Samuel', 'Buxsey', '', '09471904087', 'sbuxsey3@gmail.com', 12, ''),
(29, 'Antonino', 'Nathan', 'Bramer', '', '09946821429', 'abramer4@gmail.com', 14, ''),
(30, 'Christine', 'Christine', 'Mancer', '', '09624261542', 'cmancer5@gmail.com', 2, ''),
(31, 'Bert', 'Yves', 'Mowsley', '', '09138129301', 'bmowsley6@gmail.com', 13, ''),
(32, 'Bernardo', 'Gabriel', 'Linnett', '', '09833862550', 'blinnett7@gmail.com', 19, ''),
(33, 'Joanne', 'Theresa', 'Binstead', '', '09722565995', 'jbinstead8@gmail.com', 3, ''),
(34, 'Joseph', 'Benjamin', 'Lea', '', '09542479707', 'jlea9@gmail.com', 19, ''),
(35, 'Dixie', 'Fiona', 'Sloane', '', '09131077419', 'dsloanea@gmail.com', 1, ''),
(36, 'Tory', 'Michael', 'Eburah', '', '09216954280', 'teburahb@gmail.com', 10, ''),
(37, 'Forster', 'Oscar', 'Audas', '', '09790551790', 'faudasc@gmail.com', 4, ''),
(38, 'Kelsi', 'Eleanor', 'Pinwill', '', '09490327538', 'kpinwilld@gmail.com', 16, ''),
(39, 'Barri', 'Liam', 'Mixter', '', '09246880678', 'bmixtere@gmail.com', 16, ''),
(40, 'Anetta', 'William', 'Reasce', '', '09041368759', 'areascef@gmail.com', 8, ''),
(41, 'Cammy', 'Ulysses', 'Hawarden', '', '09049892260', 'chawardeng@gmail.com', 19, ''),
(42, 'Barry', 'James', 'Penvarden', '', '09822319453', 'bpenvardenh@gmail.com', 18, ''),
(43, 'Grace', 'Diana', 'Melding', '', '09094001280', 'gmeldingi@gmail.com', 5, ''),
(44, 'Gunar', 'Isaac', 'Daton', '', '09717537520', 'gdatonj@gmail.com', 14, ''),
(45, 'Jeremias', 'Paul', 'Gossipin', '', '09348384224', 'jgossipink@gmail.com', 12, ''),
(46, 'Danell', 'Xander', 'Piccard', '', '09550990991', 'dpiccardl@gmail.com', 1, ''),
(47, 'Coop', 'Quentin', 'Hutable', '', '09245342193', 'chutablem@gmail.com', 5, ''),
(48, 'Renae', 'Victoria', 'Valentine', '', '09688354876', 'rvalentinen@google.com', 9, ''),
(49, 'Yoko', 'Hannah', 'Beakes', '', '09532307541', 'ybeakeso@gmail.com', 1, ''),
(50, 'Pammie', 'Zachary', 'Plitz', '', '09016455315', 'pplitzp@gmail.com', 15, ''),
(51, 'Darsey', 'David', 'Winterflood', '', '09783562353', 'dwinterfloodq@gmail.com', 4, ''),
(52, 'Danielle', 'Rebecca', 'Bellelli', '', '09879982400', 'dbellellir@gmail.com', 14, ''),
(53, 'Rubin', 'Simon', 'Riddles', '', '09753972850', 'rriddless@gmail.com', 11, ''),
(54, 'Tad', 'Thomas', 'Cartan', '', '09983836865', 'tcartant@gmail.com', 12, ''),
(55, 'Brooke', 'Brooke', 'Mateo', '', '09167357821', 'bmateou@gmail.com', 2, ''),
(56, 'Ginelle', 'Ginelle', 'Gurton', '', '09815109532', 'ggurtonv@gmail.com', 6, ''),
(57, 'Giana', 'Giana', 'Columbine', '', '09365898666', 'gcolumbinew@gmail.com', 11, ''),
(58, 'Eziechiele', 'Ezekiel', 'Skamell', '', '09047905765', 'eskamellx@gmail.com', 19, ''),
(59, 'Marchelle', 'Marie', 'Melendez', '', '09615100757', 'mmelendezy@gmail.com', 9, ''),
(60, 'Maddie', 'Lynn', 'Sweatland', '', '09670490495', 'msweatlandz@gmail.com', 5, ''),
(61, 'Chevalier', 'Jean', 'Hurlin', '', '09942442921', 'churlin10@gmail.com', 14, ''),
(62, 'Brandy', 'Louise', 'Sauvan', '', '09551705387', 'bsauvan11@gmail.com', 5, ''),
(63, 'Bradley', 'James', 'Bowmen', '', '09946039994', 'bbowmen12@gmail.com', 11, ''),
(64, 'Carly', 'Anne', 'Barham', '', '09792421733', 'cbarham13@gmail.com', 12, ''),
(65, 'Dionis', 'Paul', 'Benian', '', '09039140458', 'dbenian14@gmail.com', 13, ''),
(66, 'Clair', 'Marie', 'Abrami', '', '09020049620', 'cabrami15@gmail.com', 13, ''),
(67, 'Parnell', 'John', 'Newbegin', '', '09678371823', 'pnewbegin16@gmail.com', 7, ''),
(68, 'Elizabeth', 'Marie', 'Thorrington', '', '09478643353', 'ethorrington17@gmail.com', 6, ''),
(69, 'Grethel', 'Anne', 'Layson', '', '09083702038', 'glayson18@gmail.com', 10, ''),
(70, 'Brew', 'James', 'Aldine', '', '09312457469', 'baldine19@gmail.com', 8, ''),
(71, 'Filippo', 'Marie', 'Eadmeades', '', '09297806104', 'feadmeades1a@gmail.com', 13, ''),
(72, 'Lisha', 'Anne', 'Benduhn', '', '09770951598', 'lbenduhn1b@gmail.com', 16, ''),
(73, 'Hector', 'James', 'McMychem', '', '09237790442', 'hmcmychem1c@gmail.com', 9, ''),
(74, 'Jade', 'Rouise', 'Pascual', '', '09765432189', 'jadepascual@gmail.com', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unitID` int(11) NOT NULL,
  `numOfRoom` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `unitRate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unitID`, `numOfRoom`, `status`, `unitRate`) VALUES
(1, 1, 'occupied', 3000),
(2, 1, 'occupied', 3000),
(3, 1, 'occupied', 3000),
(4, 1, 'occupied', 3000),
(5, 1, 'occupied', 3000),
(6, 1, 'occupied', 3000),
(7, 1, 'occupied', 3000),
(8, 1, 'occupied', 3000),
(9, 1, 'occupied', 3000),
(10, 1, 'occupied', 3000),
(11, 2, 'occupied', 5000),
(12, 2, 'occupied', 5000),
(13, 2, 'occupied', 5000),
(14, 2, 'occupied', 5000),
(15, 2, 'occupied', 5000),
(16, 2, 'occupied', 5000),
(17, 2, 'vacant', 5000),
(18, 2, 'occupied', 5000),
(19, 2, 'occupied', 5000),
(20, 2, 'vacant', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `type`) VALUES
(1, 'kthgrm', '12345', 'admin'),
(2, 'timothy', '67890', 'admin'),
(3, 'junny', '13579', 'tenant'),
(5, 'ervsilarde', '112233', 'tenant'),
(6, 'migscapiral', '445566', 'tenant'),
(8, 'jowaniervin', 'jowaniervin', 'tenant'),
(25, 'Pieter', 'vV22TmH>BP7d', 'tenant'),
(26, 'Nana', 'zZ08HN*!m%qyb2L?', 'tenant'),
(27, 'Marcia', 'bG4OAYjQjLQU_`.', 'tenant'),
(28, 'Stillmann', 'gL6keD.0j|<FTFZ', 'tenant'),
(29, 'Antonino', 'rZ8Y&)$cQ', 'tenant'),
(30, 'Christine', 'kH9`xsHA#bs', 'tenant'),
(31, 'Bert', 'cZ6uN!{KfAn', 'tenant'),
(32, 'Bernardo', 'bX6Nt$ViG<pQdUOy', 'tenant'),
(33, 'Joanne', 'zR8RRe~I', 'tenant'),
(34, 'Joseph', 'kB3N%annfl\"%', 'tenant'),
(35, 'Dixie', 'lZ1\'T((%.,gW', 'tenant'),
(36, 'Tory', 'eQ9v5\0XEGIpM<', 'tenant'),
(37, 'Forster', 'yA5tqzlvMGro', 'tenant'),
(38, 'Kelsi', 'bM2qrN5gZV', 'tenant'),
(39, 'Barri', 'gK4t>=az1nk7', 'tenant'),
(40, 'Anetta', 'oG59~\'U.<gLdd', 'tenant'),
(41, 'Cammy', 'lW3bwLHXspJ', 'tenant'),
(42, 'Barry', 'mC3xzT84YdUqC', 'tenant'),
(43, 'Grace', 'uR0zflmyq_`!X', 'tenant'),
(44, 'Gunar', 'wH5mW=~X>', 'tenant'),
(45, 'Jeremias', 'kN8>vBGYJbd4B!~i', 'tenant'),
(46, 'Danell', 'uU4j>fe~l)h', 'tenant'),
(47, 'Coop', 'rK5I&KY`O?wuQ', 'tenant'),
(48, 'Renae', 'uJ5}bus}/hF4$ZLI', 'tenant'),
(49, 'Yoko', 'dY5(hIj~', 'tenant'),
(50, 'Pammie', 'yJ4oW.l(}', 'tenant'),
(51, 'Darsey', 'nQ8=A6IaD|', 'tenant'),
(52, 'Danielle', 'yK8y{Yb#Is', 'tenant'),
(53, 'Rubin', 'hI8P_dyA', 'tenant'),
(54, 'Tad', 'hT9lubKT5`e', 'tenant'),
(55, 'Brooke', 'qM7zl4VCxxXlo', 'tenant'),
(56, 'Ginelle', 'qU0|0}*3ebvD1', 'tenant'),
(57, 'Giana', 'oX8Ko2o+i)', 'tenant'),
(58, 'Eziechiele', 'zU9KI{=GO4PT', 'tenant'),
(59, 'Marchelle', 'dQ2D3&oy/y3e', 'tenant'),
(60, 'Maddie', 'bO9PzjmF65', 'tenant'),
(61, 'Chevalier', 'wI2,p`A=u@,6', 'tenant'),
(62, 'Brandy', 'fL6RP?61!x3.X&', 'tenant'),
(63, 'Bradley', 'tR3fm_4+ZQ~>I', 'tenant'),
(64, 'Carly', 'xH2v5AXm', 'tenant'),
(65, 'Dionis', 'gB9wXm?5cr$th6', 'tenant'),
(66, 'Clair', 'cH8CABTOjAs', 'tenant'),
(67, 'Parnell', 'eT9+1,X`X\'@k\'', 'tenant'),
(68, 'Elizabeth', 'oM1?CG<avh', 'tenant'),
(69, 'Grethel', 'fW0gq\'R+_82kX2', 'tenant'),
(70, 'Brew', 'dZ7tkm@<Y,G', 'tenant'),
(71, 'Filippo', 'xX17PHpm', 'tenant'),
(72, 'Lisha', 'oE1h&UHCrCrwPz|C', 'tenant'),
(73, 'Hector', 'gG5B(D{o?Y/', 'tenant'),
(74, 'jade', 'pascual', 'tenant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaintID`),
  ADD KEY `tenant_complaint_fk` (`tenantID`),
  ADD KEY `unit_complaint_fk` (`unitID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`),
  ADD KEY `unit_invoice_fk` (`unitID`);

--
-- Indexes for table `lease`
--
ALTER TABLE `lease`
  ADD PRIMARY KEY (`leaseID`),
  ADD KEY `tenant_lease_fk` (`tenantID`),
  ADD KEY `unit_lease_fk` (`unitID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `user_log_fk` (`userID`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `tenant_maintenance_fk` (`tenantID`),
  ADD KEY `unit_maintenance_fk` (`unitID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `tenant_payment_fk` (`tenantID`),
  ADD KEY `invoice_payment_fk` (`invoiceID`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenantID`),
  ADD KEY `unit_tenant_fk` (`unitID`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unitID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaintID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `lease`
--
ALTER TABLE `lease`
  MODIFY `leaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `user_admin_fk` FOREIGN KEY (`adminID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `tenant_complaint_fk` FOREIGN KEY (`tenantID`) REFERENCES `tenant` (`tenantID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_complaint_fk` FOREIGN KEY (`unitID`) REFERENCES `unit` (`unitID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `unit_invoice_fk` FOREIGN KEY (`unitID`) REFERENCES `unit` (`unitID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lease`
--
ALTER TABLE `lease`
  ADD CONSTRAINT `tenant_lease_fk` FOREIGN KEY (`tenantID`) REFERENCES `tenant` (`tenantID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_lease_fk` FOREIGN KEY (`unitID`) REFERENCES `unit` (`unitID`) ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `user_log_fk` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `tenant_maintenance_fk` FOREIGN KEY (`tenantID`) REFERENCES `tenant` (`tenantID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_maintenance_fk` FOREIGN KEY (`unitID`) REFERENCES `unit` (`unitID`) ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `invoice_payment_fk` FOREIGN KEY (`invoiceID`) REFERENCES `invoice` (`invoiceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenant_payment_fk` FOREIGN KEY (`tenantID`) REFERENCES `tenant` (`tenantID`) ON UPDATE CASCADE;

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `unit_tenant_fk` FOREIGN KEY (`unitID`) REFERENCES `unit` (`unitID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_tenant_fk` FOREIGN KEY (`tenantID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
