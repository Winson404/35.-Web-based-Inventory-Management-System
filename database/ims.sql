-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 25, 2024 at 01:06 PM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u688092772_ims`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`u688092772_rbfshop`@`127.0.0.1` PROCEDURE `InsertMultipleProducts` ()   BEGIN
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
(14, 'Motor Parts', 'To support the motor and to maintain a safety', '2024-01-16 07:50:15'),
(16, 'Helmet', 'For safety gears ', '2024-01-16 08:38:33'),
(17, 'Motor Oil', 'Its used to change oil ', '2024-01-16 08:38:59');

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
  `client_branch` int(11) NOT NULL COMMENT '0=Unassigned, 1=M.H.del Pilar St, Calamba, Laguna, 2=Mabuhay City Road Cabuyao, Laguna',
  `verification_code` int(11) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`Id`, `firstname`, `middlename`, `lastname`, `suffix`, `email`, `address`, `vehicleType`, `yearModel`, `password`, `is_verified`, `client_branch`, `verification_code`, `date_registered`) VALUES
(166, 'cess', '', 'husena', '', 'cesshusena@gmail.com', 'Banlic Calamba Laguna', 'Honda', '2000', '3a926d27e2d52efafa1ebc5a63af3934', 1, 1, 0, '2024-01-16 07:34:47'),
(167, 'Mark Jefferson', 'D', 'Ano', '', 'anomarkjefferson30@gmail.com', 'MCDC, Canlubang Calamba Laguna', 'Skygo', '2017', '824a67f29e97b8798a9df7f00189f3e1', 1, 1, 198929, '2024-01-16 11:24:54'),
(168, 'Mark', '', 'Catacutan', '', 'anomarkjefferson301@gmail.com', 'Canlubang MCDC', 'Yamaha', '2015', '824a67f29e97b8798a9df7f00189f3e1', 1, 2, 0, '2024-01-16 13:15:31'),
(169, 'Mark', '', 'ano', '', 'mrkjffrsnano@gmail.com', 'calamba', 'Yamaha', '2001', '824a67f29e97b8798a9df7f00189f3e1', 1, 2, 0, '2024-01-17 04:53:34'),
(170, 'Mark', 'D', 'Ano', '', 'dadadaddadad@gmail.com', 'safgasfgafs', 'Yamaha', '2010', '824a67f29e97b8798a9df7f00189f3e1', 0, 1, 126661, '2024-01-17 14:38:43');

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
(146, 133, '2024-01-16 04:32 PM', '2024-01-16 04:40:42'),
(147, 130, '2024-01-16 04:41 PM', '2024-01-16 04:47:07'),
(148, 131, '2024-01-16 04:48 PM', '2024-01-16 04:59:45'),
(149, 131, '2024-01-16 05:03 PM', '2024-01-16 05:12:30'),
(150, 131, '2024-01-16 05:05 PM', '2024-01-16 05:11:23'),
(151, 133, '2024-01-16 05:11 PM', ''),
(152, 131, '2024-01-16 05:12 PM', '2024-01-16 05:18:09'),
(153, 133, '2024-01-16 05:18 PM', '2024-01-16 05:22:48'),
(154, 131, '2024-01-16 07:28 PM', '2024-01-16 07:35:08'),
(155, 133, '2024-01-16 07:35 PM', '2024-01-16 07:49:30'),
(156, 133, '2024-01-16 07:56 PM', '2024-01-16 07:59:29'),
(157, 133, '2024-01-16 08:01 PM', '2024-01-16 08:06:41'),
(158, 133, '2024-01-16 08:07 PM', '2024-01-16 08:13:17'),
(159, 131, '2024-01-16 08:13 PM', '2024-01-16 08:14:38'),
(160, 131, '2024-01-16 09:03 PM', '2024-01-16 09:04:28'),
(161, 133, '2024-01-16 09:05 PM', '2024-01-16 09:05:44'),
(162, 133, '2024-01-16 09:06 PM', '2024-01-16 09:07:25'),
(163, 133, '2024-01-16 09:09 PM', '2024-01-16 09:10:27'),
(164, 133, '2024-01-16 09:13 PM', '2024-01-16 09:13:49'),
(165, 133, '2024-01-16 09:16 PM', '2024-01-16 09:16:47'),
(166, 133, '2024-01-16 09:17 PM', '2024-01-16 09:17:50'),
(167, 130, '2024-01-16 09:18 PM', ''),
(168, 131, '2024-01-16 09:22 PM', ''),
(169, 131, '2024-01-16 09:23 PM', ''),
(170, 131, '2024-01-17 11:52 AM', '2024-01-17 11:53:05'),
(171, 131, '2024-01-17 11:52 AM', '2024-01-17 11:53:05'),
(172, 131, '2024-01-17 11:53 AM', '2024-01-17 11:54:30'),
(173, 131, '2024-01-17 11:57 AM', '2024-01-17 12:05:54'),
(174, 131, '2024-01-17 11:57 AM', '2024-01-17 12:05:54'),
(175, 131, '2024-01-17 12:06 PM', ''),
(176, 131, '2024-01-17 12:09 PM', ''),
(177, 131, '2024-01-17 12:10 PM', '2024-01-17 12:12:12'),
(178, 131, '2024-01-17 12:12 PM', ''),
(179, 133, '2024-01-17 12:45 PM', ''),
(180, 133, '2024-01-17 12:49 PM', '2024-01-17 12:50:29'),
(181, 133, '2024-01-17 12:52 PM', '2024-01-17 12:52:18'),
(182, 131, '2024-01-17 01:00 PM', '2024-01-17 01:24:39'),
(183, 133, '2024-01-17 01:13 PM', '2024-01-17 01:29:19'),
(184, 131, '2024-01-17 01:29 PM', '2024-01-17 01:41:39'),
(185, 133, '2024-01-17 01:41 PM', '2024-01-17 01:44:19'),
(186, 130, '2024-01-17 01:44 PM', '2024-01-17 01:52:37'),
(187, 130, '2024-01-17 01:57 PM', ''),
(188, 131, '2024-01-17 02:35 PM', ''),
(189, 131, '2024-01-17 02:51 PM', '2024-01-17 02:52:00'),
(190, 130, '2024-01-17 02:52 PM', '2024-01-17 02:57:00'),
(191, 131, '2024-01-17 03:06 PM', ''),
(192, 131, '2024-01-17 03:13 PM', ''),
(193, 131, '2024-01-17 03:57 PM', ''),
(194, 130, '2024-01-17 04:08 PM', '2024-01-17 04:10:41'),
(195, 130, '2024-01-17 04:11 PM', '2024-01-17 04:11:48'),
(196, 133, '2024-01-17 04:11 PM', '2024-01-17 04:15:51'),
(197, 131, '2024-01-17 04:11 PM', '2024-01-17 04:12:25'),
(198, 131, '2024-01-17 04:11 PM', '2024-01-17 04:12:25'),
(199, 133, '2024-01-17 04:20 PM', ''),
(200, 131, '2024-01-17 07:54 PM', '2024-01-17 07:54:52'),
(201, 131, '2024-01-17 10:16 PM', '2024-01-17 10:19:04'),
(202, 130, '2024-01-17 10:16 PM', '2024-01-17 10:17:13'),
(203, 131, '2024-01-17 10:17 PM', '2024-01-17 10:17:38'),
(204, 133, '2024-01-17 10:19 PM', '2024-01-17 10:23:04'),
(205, 130, '2024-01-17 10:23 PM', '2024-01-17 10:24:30'),
(206, 131, '2024-01-17 10:25 PM', '2024-01-17 10:25:53'),
(207, 131, '2024-01-17 10:43 PM', '2024-01-17 11:04:27'),
(208, 131, '2024-01-17 11:06 PM', '2024-01-17 11:09:49'),
(209, 130, '2024-01-17 11:15 PM', '2024-01-17 11:19:30'),
(210, 131, '2024-01-17 11:19 PM', '2024-01-17 11:20:00'),
(211, 131, '2024-01-17 11:21 PM', '2024-01-17 11:21:28'),
(212, 130, '2024-01-17 11:21 PM', '2024-01-17 11:22:04'),
(213, 130, '2024-01-17 11:22 PM', '2024-01-17 11:23:03'),
(214, 131, '2024-01-18 12:17 PM', '2024-01-18 12:20:11'),
(215, 133, '2024-01-18 12:23 PM', '2024-01-18 12:25:01'),
(216, 131, '2024-01-18 12:25 PM', '2024-01-18 12:25:39'),
(217, 131, '2024-01-18 03:00 PM', '2024-01-18 03:02:17'),
(218, 130, '2024-01-18 03:02 PM', '2024-01-18 03:03:07'),
(219, 131, '2024-01-18 03:03 PM', ''),
(220, 131, '2024-01-18 03:15 PM', ''),
(221, 131, '2024-01-18 03:58 PM', '2024-01-18 04:00:50'),
(222, 130, '2024-01-18 04:03 PM', '2024-01-18 04:04:38'),
(223, 131, '2024-01-18 04:05 PM', '2024-01-18 04:07:07'),
(224, 130, '2024-01-18 04:07 PM', '2024-01-18 04:07:54'),
(225, 131, '2024-01-18 04:08 PM', ''),
(226, 130, '2024-01-18 04:09 PM', '2024-01-18 04:10:27'),
(227, 131, '2024-01-18 04:10 PM', '2024-01-18 04:13:42'),
(228, 131, '2024-01-19 06:44 PM', ''),
(229, 131, '2024-01-22 01:18 PM', ''),
(230, 130, '2024-01-23 05:18 AM', '2024-01-23 05:21:19'),
(231, 131, '2024-01-23 10:33 PM', '2024-01-23 10:54:05'),
(232, 130, '2024-01-23 10:45 PM', ''),
(233, 130, '2024-01-23 10:54 PM', '2024-01-23 10:58:45'),
(234, 131, '2024-01-23 10:59 PM', '2024-01-23 11:24:46'),
(235, 131, '2024-01-23 11:17 PM', '2024-01-23 11:22:07'),
(236, 131, '2024-01-23 11:21 PM', ''),
(237, 131, '2024-01-23 11:26 PM', '2024-01-23 11:26:37'),
(238, 131, '2024-01-23 11:27 PM', '2024-01-23 11:33:38'),
(239, 131, '2024-01-23 11:34 PM', '2024-01-23 11:38:43'),
(240, 133, '2024-01-23 11:36 PM', ''),
(241, 133, '2024-01-23 11:38 PM', '2024-01-23 11:48:22'),
(242, 133, '2024-01-23 11:47 PM', '2024-01-23 11:59:57'),
(243, 131, '2024-01-23 11:48 PM', ''),
(244, 130, '2024-01-24 12:00 AM', '2024-01-24 12:00:24'),
(245, 133, '2024-01-24 12:00 AM', ''),
(246, 131, '2024-01-24 10:02 AM', '2024-01-24 10:02:18'),
(247, 131, '2024-01-24 10:05 AM', '2024-01-24 10:09:16'),
(248, 131, '2024-01-24 10:10 AM', '2024-01-24 10:11:14'),
(249, 133, '2024-01-24 10:11 AM', '2024-01-24 10:13:22'),
(250, 130, '2024-01-24 10:13 AM', '2024-01-24 10:14:06'),
(251, 130, '2024-01-24 10:16 AM', '2024-01-24 10:19:38'),
(252, 131, '2024-01-24 12:36 PM', '2024-01-24 12:42:03'),
(253, 133, '2024-01-24 01:15 PM', ''),
(254, 130, '2024-01-24 01:16 PM', '2024-01-24 01:17:57'),
(255, 130, '2024-01-24 01:19 PM', '');

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
  `verification_code` int(11) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`Id`, `firstname`, `middlename`, `lastname`, `suffix`, `email`, `contact`, `address`, `status`, `password`, `mechanic_branch`, `verification_code`, `date_registered`) VALUES
(147, 'Reden', '', 'Del Pilar', '', 'redendelpilar@gmail.com', '9097748084', 'Mabuhay city', 1, 'f811da39356ba14241e0f9a489b39d53', 2, 0, '2024-01-16 08:21:52'),
(148, 'michael', '', 'yen', '', 'michaelyen@gmail.com', '9097748085', 'Mabuhay City', 1, '56cf01f6edfe9598b5e23407fe290990', 2, 0, '2024-01-16 08:23:44'),
(149, 'Arvin', '', 'Capunitan', '', 'arvincapunitan@gmail.com', '9097748086', 'Purok 5, Calamba Laguna', 1, 'adc7fa367574225918e54da20c89d1f5', 1, 0, '2024-01-16 09:07:33'),
(150, 'Carl', '', 'Briones', '', 'carlbriones@gmail.com', '9097748087', 'Brgy. 5 Calamba Laguna', 1, '7c06a080a759e2de776c908ac8431f33', 1, 0, '2024-01-16 09:10:14');

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
(67, 16, '00000001', 'EVO Helmet', 33, 'Screenshot 2023-10-26 120446.png', '00000001-EVO Helmet.png', 0, 1, '2024-01-23'),
(68, 17, '00000002', 'Gear Oil', 247, '355440094_659197588879419_2575707842708776500_n.png', '00000002-Gear Oil.png', 1, 1, '2024-01-16'),
(69, 17, '00000003', 'ZIC X7 Motor Oil', 257, 'Screenshot 2023-12-12 001617.png', '00000003-ZIC X7 Motor Oil.png', 1, 1, '2024-01-16'),
(70, 14, '00000004', 'Spark Plug', 240, '413401300_740059721060588_4610389454242047067_n.png', '00000004-Spark Plug.png', 0, 1, '2024-01-24'),
(71, 14, '00000005', 'Headlight Bulb', 11, '413418274_912039720319457_1480227460169425970_n.png', '00000005-Headlight Bulb.png', 0, 1, '2024-01-24'),
(72, 16, '00000006', 'Helmet_', 250, 'Screenshot 2023-12-12 000544.png', '00000006-Helmet_.png', 0, 1, '2024-01-16'),
(73, 14, '00000007', 'Cylinder', 237, '413902966_251434404645900_4065878132431685157_n.png', '00000007-Cylinder.png', 0, 1, '2024-01-16'),
(74, 14, '00000008', 'Winker', 58, '413932981_901685561501634_3332706814125374930_n.png', '00000008-Winker.png', 0, 1, '2024-01-16'),
(75, 14, '00000009', 'Piston', 344, '413961451_3617186321934029_3639741400310256458_n.png', '00000009-Piston.png', 0, 1, '2024-01-16'),
(76, 14, '00000010', 'Belt Drive', 333, '413991800_910447813926562_2788123151080179331_n.png', '00000010-Belt Drive.png', 0, 1, '2024-01-16'),
(77, 14, '00000011', 'Piston Ring ', 367, '414188206_186052917898018_4455208689977190048_n.png', '00000011-Piston Ring .png', 0, 1, '2024-01-16'),
(78, 14, '00000012', 'Belt_drive', 144, 'belt drive.png', '00000012-Belt_drive.png', 0, 2, '2024-01-16'),
(79, 14, '00000013', 'Cylinder_', 340, 'cylinder.png', '00000013-Cylinder_.png', 0, 2, '2024-01-16'),
(80, 14, '00000014', 'Head_light Bulb', 236, 'head light bulb.png', '00000014-Head_light Bulb.png', 0, 2, '2024-01-16'),
(81, 14, '00000015', 'Piston_ring ', 134, 'piston ring.png', '00000015-Piston_ring .png', 0, 2, '2024-01-16'),
(82, 14, '00000016', 'Piston_', 357, 'piston.png', '00000016-Piston_.png', 0, 2, '2024-01-16'),
(86, 16, '00000020', 'Helmet', 231, 'Screenshot 2024-01-16 123221.png', '00000020-Helmet.png', 0, 2, '2024-01-16'),
(87, 14, '00000021', 'Spark_Plug', 245, 'spark plug.png', '00000021-Spark_Plug.png', 0, 2, '2024-01-16'),
(90, 14, '00000023', 'Winker_', 14, 'winker bulb.png', '00000023-Winker_.png', 0, 2, '2024-01-16'),
(96, 14, '00000025', 'Pad', 134, 'Screenshot 2024-01-16 210243.png', '00000025-Pad.png', 0, 2, '2024-01-16'),
(97, 14, '00000026', 'Evo', 276, 'Screenshot 2024-01-16 210915.png', '00000026-Evo.png', 0, 2, '2024-01-16'),
(98, 17, '00000027', 'ZIC X7 10w40', 146, 'Screenshot 2024-01-16 211234.png', '00000027-ZIC X7 10w40.png', 0, 2, '2024-01-16');

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
(18, 167, '2024-01-19', '09:30', 'Tail Light Bulb', '', 0, 0, '', '2024-01-16 11:27:43'),
(19, 168, '2024-01-21', '09:17', 'Air Filter Element', '', 0, 0, '', '2024-01-16 13:17:27'),
(20, 166, '2024-01-19', '13:58', 'Gear oil', '', 149, 1, '2024-01-17 03:58:18', '2024-01-17 03:56:52'),
(21, 166, '2024-01-31', '08:00', 'Spark Plug', '', 0, 2, '', '2024-01-17 04:09:46'),
(22, 167, '2024-01-19', '11:42', 'Spark Plug', '', 0, 0, '', '2024-01-17 14:42:33'),
(23, 167, '2024-01-18', '17:00', 'Change oil', '', 0, 0, '', '2024-01-18 08:14:47'),
(24, 167, '2024-01-18', '17:00', 'Major tune up', '', 0, 0, '', '2024-01-18 08:15:25'),
(25, 167, '2024-01-18', '17:00', 'Drain Plug Washer', '', 0, 0, '', '2024-01-18 08:16:12'),
(26, 167, '2024-01-24', '10:05', 'Gasket Cylinder', '', 0, 0, '', '2024-01-23 14:05:05'),
(27, 167, '2024-01-24', '12:06', 'Piston', '', 0, 0, '', '2024-01-23 16:04:56'),
(28, 167, '2024-01-24', '12:05', 'Gasket Packing', '', 0, 0, '', '2024-01-23 16:05:15'),
(29, 167, '2024-01-24', '12:05', 'Piston', '', 0, 0, '', '2024-01-23 16:05:29'),
(30, 167, '2024-01-24', '12:07', 'Gasket Cylinder Head', '', 0, 0, '', '2024-01-23 16:07:18'),
(31, 167, '2024-01-26', '12:10', 'Air Filter Element', '', 0, 0, '', '2024-01-23 16:11:09'),
(32, 167, '2024-01-26', '12:11', 'Gasket Oil Filter', '', 0, 0, '', '2024-01-23 16:11:24'),
(33, 167, '2024-01-26', '12:11', 'Gasket Cylinder Head', '', 0, 0, '', '2024-01-23 16:11:35'),
(34, 167, '2024-01-26', '12:11', 'Gasket Cylinder Head', '', 0, 0, '', '2024-01-23 16:11:35'),
(35, 167, '2024-01-26', '12:11', 'Piston', '', 0, 0, '', '2024-01-23 16:11:52');

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
(252, 20, 166, 149, 78, 2, '2024-01-17 05:27:13'),
(253, 20, 166, 149, 67, 1, '2024-01-17 15:13:44'),
(254, 20, 166, 149, 68, 1, '2024-01-17 15:13:44'),
(255, 20, 166, 149, 69, 1, '2024-01-17 15:13:44');

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
(130, 'Super ', '', 'admin', '', '1986-06-27', '37 years old', 'laguna', 'Male', 'Married', 'Owner', 'Roman Catholic', 'superadmin@gmail.com', '9359428963', 'n/a', 'Del Pilar St.', 'purok 5', '4027', 'n/a', 'Calamba', 'Laguna', 'IV- A', '0192023a7bbd73250516f069df18b500', 'Screenshot 2023-12-12 153256.png', 'Superadmin', 0, 0, '2023-07-12 01:53:04'),
(131, 'RBF', '', 'Motorshop I', '', '1986-03-03', '37 years old', 'san Pablo', 'Male', 'Single', 'admin', 'Roman Catholic', 'rbfmotorshop@gmail.com', '9359428963', 'n/a', 'Del Pilar St.', 'n/A', '4027', 'Purok 4', 'Calamba', 'Laguna', 'IV- A', '0192023a7bbd73250516f069df18b500', 'Screenshot 2023-12-12 153256.png', 'Admin', 1, 219742, '2023-07-12 01:54:10'),
(133, 'RBF', '', 'Motorshop II', '', '1985-03-04', '38 years old', 'laguna', 'Male', 'Married', 'admin', 'Roman Catholic', 'rbfmotorshopadmin2@gmail.com', '9359428963', 'n/a', 'Mabuhay City', 'purok 5', '4027', 'Mabuhay', 'Calamba', 'Laguna', 'IV- A', '0192023a7bbd73250516f069df18b500', '415483496_6727747417347359_3700964744510115712_n.png', 'Admin', 2, 0, '2023-07-12 02:10:45'),
(151, 'Gilbert', '', 'Magsaysay', '', '1988-05-12', '35 years old', 'Caloocan', 'Female', 'Married', 'Seller', 'Iglesia Ni Cristo', 'gilbertmagsaysay@gmail.com', '9097748083', 'n/a', 'Caloocan', 'n/a', '1400', 'bagong Silang', 'Caloocan', 'Rizal', 'NCR', '48317ac9e1604d12135a4a8f5b9aee00', 'image (1).jpg', 'User', 1, 0, '2024-01-16 00:00:00'),
(152, 'Gilbert', '', 'Magsaysay', '', '1988-05-12', '35 years old', 'caloocan', 'Female', 'Married', 'Seller', 'Roman Catholic', 'gilbertmagsaysay1@gmail.com', '9097748088', 'n/a', 'Caloocan', 'n/a', '1400', 'bagong Silang', 'Caloocan', 'Rizal', 'NCR', '48317ac9e1604d12135a4a8f5b9aee00', 'image (1).jpg', 'User', 2, 0, '2024-01-16 00:00:00');

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
  MODIFY `cat_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `log_history`
--
ALTER TABLE `log_history`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
