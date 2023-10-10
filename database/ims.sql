-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 08:04 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

CREATE TABLE IF NOT EXISTS `log_history` (
`log_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `logout_time` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

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
(41, 130, '2023-10-11 01:15 AM', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`p_Id` int(11) NOT NULL,
  `prod_Id` varchar(255) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `prod_item_no` int(11) NOT NULL,
  `prod_image` varchar(255) NOT NULL,
  `prod_qr` varchar(255) NOT NULL,
  `date_added` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_Id`, `prod_Id`, `prod_name`, `prod_stock`, `prod_item_no`, `prod_image`, `prod_qr`, `date_added`) VALUES
(5, '00000001', 'Aa', 1, 1, '1.jpg', '65258be7c29d05.79956203.png', '2023-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
  `verification_code` int(11) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=139 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `email`, `contact`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `password`, `image`, `user_type`, `verification_code`, `date_registered`) VALUES
(130, 'Admin', 'Admin', 'Admin', '', '2023-06-27', '2 weeks old', 'image', 'Male', 'Married', 'image', 'Methodist', 'admin@gmail.com', '9359428963', 'image', 'image', 'image', 'image', 'image', 'image', '', 'image', '0192023a7bbd73250516f069df18b500', 'aclc.png', 'Admin', 0, '2023-07-12 01:53:04'),
(131, 'sample', 'sample', 'sample', '', '2021-03-03', '2 years old', 'sample', 'Male', 'Single', 'sample', 'Evangelical Christianity', 'Sample@gmail.com', '9359428963', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '', 'sample', '0192023a7bbd73250516f069df18b500', '1.jpg', 'User', 0, '2023-07-12 01:54:10'),
(133, 'kini', 'kini', 'kini', '', '2020-03-04', '3 years old', 'kini', 'Male', 'Married', 'kini', 'Evangelical Christianity', 'kini@gmail.com', '9359428963', 'kini', 'kinikini', 'kini', 'kini', 'kini', 'kini', 'kini', 'kini', '$2y$10$9olBkTFKM9nxalDpZ0uAWuv4q9qtklx82TdtAjENCSsLIAlFiHHti', 'images-users/bsu.png', 'User', 0, '2023-07-12 02:10:45'),
(134, 'haha', 'haha', 'haha', '', '2018-01-31', '5 years old', 'haha', 'Female', 'Single', 'haha', 'Islam', 'hahahahahaha@gmail.com', '9359428963', 'haha', 'haha', 'haha', 'haha', 'haha', 'haha', 'haha', 'haha', '$2y$10$xWEWx6pgQE.F6EoyrAVbz.bP0cEflvFMUkm/ovnkfwK5xqBe8YPmO', 'images-users/64ad9d419e109.png', 'User', 0, '2023-07-12 02:19:45'),
(137, 'dsadasd', 'asdasd', 'asdasd', 'asdsadas', '2023-10-04', '6 days old', 'dsadsa', 'Male', 'Single', 'dsadsa', 'Aglipayan', 'addsadsadsamin@gmail.com', '9359428963', 'dsads', 'adasdsa', 'dasdasdas', 'dasd', 'sadasdsadas', 'dsad', 'sadsad', 'sadsa', 'bfc73950efa4f493a0baa406150efe7f', 'amg.png', 'Staff', 0, '2023-10-10 00:00:00'),
(138, 'gaga', 'gaga', 'gaga', 'gaga', '2021-04-02', '2 years old', 'gaga', 'Male', 'Married', 'gaga', 'Buddhist', 'gaga@gmail.com', '9359428963', 'gaga', 'gaga', 'gaga', 'gaga', 'gaga', 'gaga', 'gaga', 'gaga', '802cbb98cbe46020906e4b386b1545cc', 'access.png', 'Admin', 0, '2023-10-10 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_history`
--
ALTER TABLE `log_history`
 ADD PRIMARY KEY (`log_Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`p_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_history`
--
ALTER TABLE `log_history`
MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `p_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=139;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
