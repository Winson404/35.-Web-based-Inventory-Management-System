-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 06:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertMultipleProducts` ()   BEGIN
    DECLARE counter INT DEFAULT 0;
    DECLARE maxCounter INT DEFAULT 19;

    WHILE counter <= maxCounter DO
        INSERT INTO product (cat_Id, prod_Id, prod_name, prod_stock, prod_image, prod_qr, is_archived, date_added)
        VALUES ('2', LPAD(counter + 2, 8, '0'), CONCAT('Sample Product ', counter + 2), 10, 'sample_image.jpg', 'sample_qr_code.png', 0, NOW());

        SET counter = counter + 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_Id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_Id`, `cat_name`, `cat_description`, `date_created`) VALUES
(2, 'Pants', 'Pants Sample description', '2022-06-28'),
(3, 'Perfume', 'Perfume Sample Description', '2022-06-28'),
(4, 'Electric Fan', 'Electric Fan Sample Description', '2022-06-28'),
(6, 'Shoes', 'Shoes Sample Description', '2022-06-28'),
(8, 'T-Shirts', 'T-Shirts Sample Description', '2022-06-30'),
(9, 'Bags', 'Bags Sample Description', '2022-06-30'),
(12, 'Shorts', 'Shorts Sample Description', '2022-07-18'),
(13, 'Dress for Women', 'Dress for Women Sample Description', '2022-07-18');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `vehicleType` varchar(50) NOT NULL,
  `yearModel` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0 COMMENT '0=Not verified, 1=Verified',
  `client_branch` int(11) NOT NULL,
  `verification_code` int(11) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`Id`, `firstname`, `middlename`, `lastname`, `suffix`, `email`, `address`, `vehicleType`, `yearModel`, `password`, `is_verified`, `client_branch`, `verification_code`, `date_registered`) VALUES
(152, 'Client', 'Client', 'Client', 'Client', 'client@gmail.com', 'Client Address', 'sedan', '2222', 'f6fdffe48c908deb0f4c3bd36c032e72', 1, 0, 244244, '2023-12-05 14:30:23'),
(153, 'fsfsf', 'fdsfds', 'fdsfds', 'fsdfsdf', 'sonerwin12@gmail.com', 'fdsfsfs', 'convertible', '4324', 'f6fdffe48c908deb0f4c3bd36c032e72', 0, 1, 129370, '2023-12-05 14:38:15'),
(154, 'Edit', 'dsada', 'dasd', 'as', 'jetdsahro@gmail.com', 'dsa', 'truck', '2222', '0192023a7bbd73250516f069df18b500', 1, 2, 0, '2023-12-10 20:06:14'),
(155, 'dsadas', 'dasdas', 'dsadsa', 'dsa', 'dadsa432ethro@gmail.com', 'sadsada', 'truck', '3242', '0192023a7bbd73250516f069df18b500', 1, 0, 0, '2023-12-10 20:59:25'),
(156, 'dsad', 'sadsad', 'sadsa', 'das', 'jethrodsa432@gmail.com', 'dsadasdsa', 'motorcycle', '2222', '0192023a7bbd73250516f069df18b500', 1, 1, 0, '2023-12-10 21:02:16'),
(157, 'dadsadsadsad', '', 'asdas', 'dasd', 'jethro432dsd@gmail.com', 'dsadasd', 'suv', '2222', '0192023a7bbd73250516f069df18b500', 1, 1, 0, '2023-12-10 21:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

CREATE TABLE `log_history` (
  `log_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `logout_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_history`
--

INSERT INTO `log_history` (`log_Id`, `user_Id`, `login_time`, `logout_time`) VALUES
(1, 66, '2023-06-07 08:18 PM', ''),
(2, 66, '2023-07-07 01:01 PM', '2023-07-07 02:19:12'),
(3, 67, '2023-07-07 02:19 PM', '2023-07-07 02:23:47'),
(4, 66, '2023-07-07 02:23 PM', ''),
(5, 66, '2023-07-07 02:41 PM', ''),
(6, 66, '2023-07-07 03:12 PM', ''),
(7, 66, '2023-07-07 04:01 PM', ''),
(8, 66, '2023-07-07 04:46 PM', '2023-07-07 04:48:15'),
(9, 66, '2023-07-07 04:48 PM', ''),
(10, 72, '2023-07-07 04:50 PM', '2023-07-07 04:51:03'),
(11, 66, '2023-07-07 05:21 PM', '2023-07-07 05:21:12'),
(12, 66, '2023-07-07 05:23 PM', ''),
(13, 66, '2023-07-07 06:37 PM', ''),
(14, 66, '2023-07-07 07:37 PM', ''),
(15, 66, '2023-07-07 08:23 PM', ''),
(16, 66, '2023-07-07 09:39 PM', ''),
(17, 66, '2023-07-08 01:25 PM', ''),
(18, 66, '2023-07-08 02:11 PM', ''),
(19, 66, '2023-07-08 02:46 PM', ''),
(20, 66, '2023-07-08 07:15 PM', ''),
(21, 66, '2023-07-08 07:50 PM', ''),
(22, 66, '2023-07-08 08:45 PM', ''),
(23, 72, '2023-07-08 09:38 PM', '2023-07-08 09:40:59'),
(24, 72, '2023-07-08 09:41 PM', '2023-07-08 09:41:15'),
(25, 66, '2023-07-08 09:41 PM', '2023-07-08 09:43:02'),
(26, 66, '2023-07-09 12:40 AM', ''),
(27, 66, '2023-07-09 02:07 AM', '2023-07-09 02:20:50'),
(28, 66, '2023-07-09 02:24 AM', '2023-07-09 02:28:27'),
(29, 72, '2023-07-09 02:28 AM', '2023-07-09 02:28:45'),
(30, 66, '2023-07-09 02:28 AM', '2023-07-09 02:35:48'),
(31, 72, '2023-07-09 02:35 AM', '2023-07-09 02:36:25'),
(32, 66, '2023-07-09 02:37 AM', '2023-07-09 02:40:43'),
(33, 66, '2023-07-09 02:45 AM', '2023-07-09 02:49:07'),
(34, 72, '2023-07-09 02:52 AM', ''),
(35, 130, '2023-10-10 11:13 PM', '2023-10-10 11:15:08'),
(36, 130, '2023-10-10 11:20 PM', '2023-10-10 11:20:04'),
(37, 130, '2023-10-10 11:21 PM', '2023-10-11 12:04:07'),
(38, 131, '2023-10-11 12:04 AM', '2023-10-11 12:11:10'),
(39, 130, '2023-10-11 12:13 AM', ''),
(40, 130, '2023-10-11 12:55 AM', ''),
(41, 130, '2023-10-11 01:15 AM', ''),
(42, 130, '2023-10-13 02:13 PM', ''),
(43, 130, '2023-10-13 03:01 PM', ''),
(44, 130, '2023-10-13 03:13 PM', ''),
(45, 130, '2023-10-13 03:32 PM', ''),
(46, 130, '2023-10-16 12:01 PM', ''),
(47, 130, '2023-10-16 01:17 PM', '2023-10-16 01:18:13'),
(48, 130, '2023-10-17 10:04 PM', ''),
(49, 130, '2023-10-17 10:25 PM', ''),
(50, 130, '2023-10-18 12:26 AM', '2023-10-18 01:22:54'),
(51, 130, '2023-10-18 01:33 AM', '2023-10-18 01:33:50'),
(52, 130, '2023-10-18 02:00 AM', '2023-10-18 02:03:19'),
(53, 130, '2023-10-18 02:55 AM', '2023-10-18 03:03:07'),
(54, 130, '2023-10-18 03:03 AM', '2023-10-18 03:06:35'),
(55, 130, '2023-11-11 11:03 AM', ''),
(56, 130, '2023-11-11 11:44 AM', ''),
(57, 130, '2023-11-11 03:02 PM', ''),
(58, 130, '2023-11-11 03:40 PM', ''),
(59, 130, '2023-11-11 08:27 PM', ''),
(60, 130, '2023-11-14 08:33 PM', ''),
(61, 130, '2023-11-14 09:20 PM', ''),
(62, 130, '2023-11-16 08:00 PM', '2023-11-16 08:16:35'),
(63, 130, '2023-11-16 08:19 PM', ''),
(64, 130, '2023-11-16 08:47 PM', '2023-11-16 09:29:10'),
(65, 130, '2023-11-16 11:14 PM', '2023-11-16 11:59:49'),
(66, 130, '2023-12-04 07:35 PM', ''),
(67, 130, '2023-12-04 10:02 PM', '2023-12-04 10:37:10'),
(68, 137, '2023-12-04 10:37 PM', '2023-12-04 10:53:09'),
(69, 130, '2023-12-04 10:53 PM', '2023-12-04 11:03:48'),
(70, 137, '2023-12-04 11:04 PM', ''),
(71, 130, '2023-12-04 11:33 PM', '2023-12-04 11:49:08'),
(72, 130, '2023-12-05 09:59 AM', ''),
(73, 130, '2023-12-05 11:07 AM', '2023-12-05 11:27:27'),
(74, 130, '2023-12-05 02:33 PM', '2023-12-05 02:37:49'),
(75, 130, '2023-12-05 04:04 PM', '2023-12-05 04:04:55'),
(76, 130, '2023-12-05 06:56 PM', '2023-12-05 06:57:12'),
(77, 130, '2023-12-05 06:58 PM', '2023-12-05 07:02:37'),
(78, 130, '2023-12-05 07:26 PM', ''),
(79, 130, '2023-12-05 08:01 PM', ''),
(80, 130, '2023-12-05 09:10 PM', ''),
(81, 130, '2023-12-05 09:56 PM', '2023-12-05 10:42:28'),
(82, 130, '2023-12-05 10:53 PM', ''),
(83, 130, '2023-12-05 11:25 PM', '2023-12-05 11:49:45'),
(84, 130, '2023-12-06 12:19 AM', ''),
(85, 130, '2023-12-08 12:27 AM', '2023-12-08 12:46:29'),
(86, 130, '2023-12-08 01:39 PM', '2023-12-08 01:40:50'),
(87, 130, '2023-12-08 06:10 PM', '2023-12-08 06:13:59'),
(88, 130, '2023-12-08 06:17 PM', '2023-12-08 06:19:12'),
(89, 130, '2023-12-08 07:28 PM', ''),
(90, 130, '2023-12-08 11:17 PM', ''),
(91, 130, '2023-12-09 12:32 PM', ''),
(92, 130, '2023-12-09 01:06 PM', ''),
(93, 130, '2023-12-09 01:23 PM', ''),
(94, 130, '2023-12-10 05:16 PM', ''),
(95, 130, '2023-12-10 06:47 PM', ''),
(96, 130, '2023-12-10 07:31 PM', ''),
(97, 130, '2023-12-10 08:01 PM', ''),
(98, 130, '2023-12-10 08:27 PM', '2023-12-10 08:46:07'),
(99, 131, '2023-12-10 08:46 PM', '2023-12-10 09:30:17'),
(100, 133, '2023-12-10 09:32 PM', '2023-12-10 09:34:14'),
(101, 134, '2023-12-10 09:34 PM', '2023-12-10 09:38:30'),
(102, 130, '2023-12-10 09:38 PM', ''),
(103, 130, '2023-12-10 10:41 PM', ''),
(104, 130, '2023-12-10 11:07 PM', '2023-12-10 11:09:04'),
(105, 130, '2023-12-10 11:30 PM', '2023-12-10 11:40:19'),
(106, 130, '2023-12-11 12:49 AM', '2023-12-11 01:22:02'),
(107, 130, '2023-12-11 01:17 AM', '');

-- --------------------------------------------------------

--
-- Table structure for table `mechanic`
--

CREATE TABLE `mechanic` (
  `Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=Unavailable, 1=Available',
  `password` varchar(255) NOT NULL,
  `mechanic_branch` int(11) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`Id`, `firstname`, `middlename`, `lastname`, `suffix`, `email`, `contact`, `address`, `status`, `password`, `mechanic_branch`, `date_registered`) VALUES
(143, 'sample', 'Sample', 'Sample', 'Sample', 'sonerSamplewin8@gmail.com', '', 'Medellin', 1, '', 0, '2023-12-04 00:00:00'),
(144, 'Mechanic', 'Mechanic', 'Mechanic', 'Mechanic', 'Mechanic@gmail.com', '9359428962', 'Mechanic Mechanic Mechanic', 1, '0192023a7bbd73250516f069df18b500', 0, '2023-12-05 10:17:10'),
(145, 'DirtyDirty', 'DirtyDirty', 'DirtyDirty', 'DirtyDirty', 'DirtyDirty@gmail.com', '9359428963', 'Dirty', 1, '0691331879b6dce12aef0309dfefa1c2', 0, '2023-12-05 10:17:42'),
(146, 'ds', 'adsa', 'dsadsa', 'dsa', 'jethrdsaasaa@gmail.com', '9359428963', 'dsadas', 1, '0192023a7bbd73250516f069df18b500', 1, '2023-12-10 21:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_Id` int(11) NOT NULL,
  `cat_Id` int(11) NOT NULL,
  `prod_Id` varchar(255) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `prod_image` varchar(255) NOT NULL,
  `prod_qr` varchar(255) NOT NULL,
  `is_archived` int(11) NOT NULL DEFAULT 0 COMMENT '0=Not Archived, 1=Archived',
  `branch` int(11) NOT NULL,
  `date_added` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_Id`, `cat_Id`, `prod_Id`, `prod_name`, `prod_stock`, `prod_image`, `prod_qr`, `is_archived`, `branch`, `date_added`) VALUES
(18, 2, '00000001', 'Sample Product 1', 45, '1.jpg', '6572fdfed0f818.89595702.png', 0, 0, '2023-12-08'),
(19, 2, '00000002', 'Sample Product 2', 40, 'sample_image.jpg', 'sample_qr_code.png', 1, 0, '2023-12-08 19:35:07'),
(20, 2, '00000003', 'Sample Product 3', 45, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(21, 2, '00000004', 'Sample Product 4', 45, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(22, 2, '00000005', 'Sample Product 5', 48, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(23, 2, '00000006', 'Sample Product 6', 49, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(24, 2, '00000007', 'Sample Product 7', 49, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(25, 2, '00000008', 'Sample Product 8', 49, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(26, 2, '00000009', 'Sample Product 9', 49, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(27, 2, '00000010', 'Sample Product 10', 49, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(28, 2, '00000011', 'Sample Product 11', 40, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(29, 2, '00000012', 'Sample Product 12', 42, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(30, 2, '00000013', 'Sample Product 13', 47, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(31, 2, '00000014', 'Sample Product 14', 47, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(32, 2, '00000015', 'Sample Product 15', 47, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(33, 2, '00000016', 'Sample Product 16', 48, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(34, 2, '00000017', 'Sample Product 17', 48, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(35, 2, '00000018', 'Sample Product 18', 45, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(36, 2, '00000019', 'Sample Product 19', 38, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(37, 2, '00000020', 'Sample Product 20', 45, 'sample_image.jpg', 'sample_qr_code.png', 0, 0, '2023-12-08 19:35:07'),
(38, 2, '00000021', 'Sample Product 21', 5, 'pexels-photo-1516680.jpeg', '657335c68326e1.30101236.png', 0, 0, '2023-12-08 19:35:07'),
(39, 3, '00000022', 'Product 24', 48, 'pexels-photo-1516680.jpeg', '657335c68326e1.30101236.png', 0, 0, '2023-12-08'),
(40, 3, '00000023', 'Product 111', 10, 'pexels-photo-1516680.jpeg', 'Product 111.png', 0, 0, '2023-12-09'),
(41, 3, '00000024', 'Dsa', 34, '3.jpg', 'Dsa.png', 0, 0, '2023-12-10'),
(42, 2, '00000025', 'Dsada', 343, 'testimonials-4.jpg', 'Dsada.png', 0, 1, '2023-12-10'),
(43, 3, '00000026', 'Agay', 33, 'testimonials-3.jpg', 'Agay.png', 0, 1, '2023-12-10'),
(44, 4, '00000027', 'Norlyn', 232, 'pexels-photo-5876695.jpeg', 'Norlyn.png', 0, 2, '2023-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_Id` int(11) NOT NULL,
  `client_Id` int(11) NOT NULL,
  `selectedDate` varchar(100) NOT NULL,
  `selectedTime` varchar(50) NOT NULL,
  `services` varchar(150) NOT NULL,
  `otherServices` varchar(255) NOT NULL,
  `mechanic_Id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2=Denied',
  `date_approved` varchar(30) NOT NULL,
  `date_added` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_Id`, `client_Id`, `selectedDate`, `selectedTime`, `services`, `otherServices`, `mechanic_Id`, `status`, `date_approved`, `date_added`) VALUES
(12, 152, '2023-12-15', '08:30', 'Piston', '', 144, 2, '2023-12-08 23:18:56', '2023-12-08 23:17:55'),
(13, 156, '2023-12-16', '09:21', 'Tappet Cap O-ring', '', 144, 1, '2023-12-08 23:24:02', '2023-12-08 23:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_log`
--

CREATE TABLE `transaction_log` (
  `transaction_id` int(11) NOT NULL,
  `sched_Id` int(11) DEFAULT NULL,
  `client_Id` int(11) DEFAULT NULL,
  `mechanic_Id` int(11) DEFAULT NULL,
  `product_Id` int(11) DEFAULT NULL,
  `quantity_used` int(11) DEFAULT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_log`
--

INSERT INTO `transaction_log` (`transaction_id`, `sched_Id`, `client_Id`, `mechanic_Id`, `product_Id`, `quantity_used`, `date_updated`) VALUES
(226, 12, 152, 144, 18, 5, '2023-12-08 15:21:19'),
(227, 12, 152, 144, 19, 5, '2023-12-08 15:21:19'),
(228, 12, 152, 144, 20, 5, '2023-12-08 15:21:19'),
(229, 12, 152, 144, 21, 5, '2023-12-08 15:21:19'),
(230, 12, 152, 144, 19, 5, '2023-12-08 15:22:30'),
(231, 12, 152, 144, 23, 1, '2023-12-08 15:22:30'),
(232, 12, 152, 144, 24, 1, '2023-12-08 15:22:30'),
(233, 12, 152, 144, 25, 1, '2023-12-08 15:22:30'),
(234, 12, 152, 144, 26, 1, '2023-12-08 15:22:30'),
(235, 12, 152, 144, 27, 1, '2023-12-08 15:22:30'),
(236, 13, 152, 144, 28, 3, '2023-12-08 15:25:14'),
(237, 13, 152, 144, 29, 3, '2023-12-08 15:25:14'),
(238, 13, 152, 144, 30, 3, '2023-12-08 15:25:14'),
(239, 13, 152, 144, 31, 3, '2023-12-08 15:25:14'),
(240, 13, 152, 144, 32, 3, '2023-12-08 15:25:14'),
(241, 13, 152, 144, 28, 7, '2023-12-08 15:37:31'),
(242, 13, 152, 144, 29, 5, '2023-12-08 15:37:31'),
(243, 13, 152, 144, 35, 5, '2023-12-08 15:37:31'),
(244, 13, 152, 144, 36, 10, '2023-12-08 15:37:31'),
(245, 13, 152, 144, 37, 3, '2023-12-08 15:37:31'),
(246, 13, 152, 144, 39, 2, '2023-12-08 15:37:31'),
(247, 13, 152, 144, 36, 2, '2023-12-08 15:39:05'),
(248, 13, 152, 144, 37, 2, '2023-12-08 15:39:05'),
(249, 13, 152, 144, 22, 2, '2023-12-08 15:39:31'),
(250, 13, 152, 144, 33, 2, '2023-12-08 15:39:31'),
(251, 13, 152, 144, 34, 2, '2023-12-08 15:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'User',
  `assigned_branch` int(11) NOT NULL DEFAULT 0 COMMENT '0=Unassigned, 1=M.H.del Pilar St, Calamba, Laguna, 2=Mabuhay City Road Cabuyao, Laguna',
  `verification_code` int(11) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `email`, `contact`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `password`, `image`, `user_type`, `assigned_branch`, `verification_code`, `date_registered`) VALUES
(130, 'Jose', '', 'Rizal', '', '2023-06-27', '2 weeks old', 'image', 'Male', 'Married', 'image', 'Methodist', 'superadmin@gmail.com', '9359428963', 'image', 'image', 'image', 'image', 'image', 'image', '', 'image', '0192023a7bbd73250516f069df18b500', 'testimonials-1.jpg', 'Superadmin', 0, 360328, '2023-07-12 01:53:04'),
(131, 'Andres', '', 'Bonifacio', '', '2021-03-03', '2 years old', 'sample', 'Male', 'Single', 'sample', 'Evangelical Christianity', 'admin1@gmail.com', '9359428963', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '', 'sample', '0192023a7bbd73250516f069df18b500', 'testimonials-3.jpg', 'Admin', 1, 0, '2023-07-12 01:54:10'),
(133, 'Emilio', '', 'Aguinaldo', '', '2020-03-04', '3 years old', 'kini', 'Male', 'Married', 'kini', 'Evangelical Christianity', 'staff1@gmail.com', '9359428963', 'kini', 'kinikini', 'kini', 'kini', 'kini', 'kini', 'kini', 'kini', '0192023a7bbd73250516f069df18b500', 'testimonials-2.jpg', 'Staff', 1, 0, '2023-07-12 02:10:45'),
(134, 'Emilio', '', 'Jacinto', '', '2018-01-31', '5 years old', 'haha', 'Female', 'Single', 'haha', 'Islam', 'admin2@gmail.com', '9359428963', 'haha', 'haha', 'haha', 'haha', 'haha', 'haha', 'haha', 'haha', '0192023a7bbd73250516f069df18b500', 'testimonials-4.jpg', 'Admin', 2, 0, '2023-07-12 02:19:45'),
(137, 'Jose', '', 'Marichan', 'asdsadas', '2023-10-04', '6 days old', 'dsadsa', 'Male', 'Single', 'dsadsa', 'Aglipayan', 'staff2@gmail.com', '9359428963', 'dsads', 'adasdsa', 'dasdasdas', 'dasd', 'sadasdsadas', 'dsad', 'fds', 'sadsas', '0192023a7bbd73250516f069df18b500', 'testimonials-5.jpg', 'Staff', 2, 0, '2023-10-10 00:00:00'),
(145, 'Supplier', 'Supplier', 'Supplier', 'Supplier', '1990-01-30', '', 'Supplier', 'Female', 'Married', 'Supplier', 'Hindu', 'Supplier@gmail.com', '9359428963', 'Supplier', 'Supplier', 'Supplier', 'Supplier', 'Supplier', 'Supplier', 'Supplier', 'Supplier', 'dad98c61254b505f6f52625b81c1197a', 'pexels-photo-1130626.jpeg', 'User', 1, 0, '2023-12-10 00:00:00'),
(146, 'Sup', 'Sup', 'SupSup', 'Sup', '1998-03-10', '25 years old', 'Sup', 'Female', 'Single', 'Sup', 'Roman Catholic', 'superadmSupin@gmail.com', '9359428963', 'Sup', 'SupSup', 'Sup', 'Sup', 'Sup', 'Sup', 'Sup', 'Sup', '5ad011722f655967a0962b6262976cd3', 'woman-person-flowers-wreaths.jpg', 'User', 0, 0, '2023-12-10 00:00:00'),
(147, 'dsa', 'dsad', 'sadasd', 'sadas', '1990-03-01', '33 years old', 'dsada', 'Female', 'Married', 'fdsfsd', 'Buddhist', 'jethrdsa432o@gmail.com', '9359428963', 'dsad', 'adsad', 'sadas', 'dsad', 'sadsa', 'dasd', 'dasdasas', 'dasdas', '0192023a7bbd73250516f069df18b500', 'pexels-photo-1181686.jpeg', 'User', 0, 0, '2023-12-10 00:00:00'),
(148, 'akoy', 'Akoy', 'Akoy', 'Akoy', '1973-02-28', '50 years old', 'Akoy', 'Male', 'Widow/ER', 'Akoy', 'Iglesia Ni Cristo', 'AkoyAkoy@gmail.com', '9359428963', 'Akoy', 'Akoy', 'Akoy', 'Akoy', 'Akoy', 'Akoy', 'Akoy', 'Akoy', '13375a33b9a55910ca086223e4dda190', 'pexels-photo-769772.jpeg', 'User', 0, 0, '2023-12-10 00:00:00'),
(149, 'dsa', 'dasdas', 'das', 'dsa', '1988-03-02', '35 years old', 'dsadas', 'Male', 'Married', 'dsad', 'Methodist', 'jethdsa432ro@gmail.com', '9359428963', 'dsadsa', 'daddsad', 'asdasdadasdas', 'asdas', 'dasdsad', 'dsadas', 'adas', 'dasdasdsad', '0192023a7bbd73250516f069df18b500', 'pexels-photo-1130626.jpeg', 'User', 1, 0, '2023-12-10 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_Id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `log_history`
--
ALTER TABLE `log_history`
  ADD PRIMARY KEY (`log_Id`);

--
-- Indexes for table `mechanic`
--
ALTER TABLE `mechanic`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_Id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_Id`);

--
-- Indexes for table `transaction_log`
--
ALTER TABLE `transaction_log`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `log_history`
--
ALTER TABLE `log_history`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
