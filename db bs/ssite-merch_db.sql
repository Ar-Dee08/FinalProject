-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 09:45 PM
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
-- Database: `ssite-merch_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `userinfo_id` bigint(11) UNSIGNED NOT NULL,
  `user_privilege` varchar(255) NOT NULL,
  `granting_date` datetime NOT NULL,
  `admin_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `userinfo_id`, `user_privilege`, `granting_date`, `admin_status`) VALUES
(1, 1, 'Authorized', '0000-00-00 00:00:00', 'Active'),
(2, 6, 'Authorized', '0000-00-00 00:00:00', 'Active'),
(3, 15, 'Unauthorized', '2024-12-06 00:00:00', 'Active'),
(4, 17, 'Authorized', '2024-12-07 16:39:55', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` bigint(20) NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `cart_status` varchar(50) NOT NULL,
  `userinfo_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `item_id`, `quantity`, `cart_status`, `userinfo_id`) VALUES
(1, 2, 1, 'Active', 6),
(2, 3, 3, 'Active', 6),
(3, 2, 3, 'Active', 6);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `admin_creator` bigint(20) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `record_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `category_name`, `admin_creator`, `date_created`, `record_status`) VALUES
(1, 'Clothing', 2, '2024-12-04 17:08:04', 'Active'),
(2, 'Miscellaneous', 2, '2024-12-04 17:08:12', 'Active'),
(3, 'Bag', 2, '2024-12-04 17:08:44', 'Active'),
(4, 'Handbag', 2, '2024-12-06 16:29:40', 'Active'),
(5, 'asd', 2, '2024-12-06 18:25:34', 'Removed'),
(6, 'asd', 2, '2024-12-07 17:38:16', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customertype`
--

CREATE TABLE `customertype` (
  `customertype_id` bigint(20) UNSIGNED NOT NULL,
  `customer_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customertype`
--

INSERT INTO `customertype` (`customertype_id`, `customer_type`) VALUES
(1, 'Student'),
(2, 'Non-Student');

-- --------------------------------------------------------

--
-- Table structure for table `customertype_verification`
--

CREATE TABLE `customertype_verification` (
  `custype_verif_id` int(11) NOT NULL,
  `type_verification_stat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customertype_verification`
--

INSERT INTO `customertype_verification` (`custype_verif_id`, `type_verification_stat`) VALUES
(1, 'Pending'),
(2, 'Verified'),
(3, 'Invalid');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_spec` text NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `item_img` longblob NOT NULL,
  `item_price` decimal(10,0) NOT NULL,
  `item_discprice` decimal(10,0) NOT NULL,
  `cat_id` int(11) UNSIGNED NOT NULL,
  `admin_creator` bigint(20) UNSIGNED NOT NULL,
  `date_created` date NOT NULL,
  `record_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_spec`, `item_desc`, `item_type`, `item_img`, `item_price`, `item_discprice`, `cat_id`, `admin_creator`, `date_created`, `record_status`) VALUES
(1, 'T-SHIRT', 'Small', '   ASD', 'Single', 0x315f313733333534363237312e706e67, 320, 300, 1, 2, '2024-12-07', 'Active'),
(2, 'Tote Bag', 'Brightening Future~', ' White', 'Single', 0x325f313733333534363636362e706e67, 220, 200, 1, 2, '2024-12-07', 'Active'),
(3, 'Crinkles', '8pcs', '-', 'Bundle', 0x335f313733333537363230342e706e67, 80, 75, 2, 2, '2024-12-07', 'Active'),
(4, 'ITEM 1', 'A', 'AA', 'Single', 0x345f313733333537363835312e706e67, 412, 312, 3, 4, '2024-12-07', 'Active'),
(5, 'TSHIT', 'E', 'A', 'Single', 0x355f313733333537363933342e6a7067, 566, 342, 1, 4, '2024-12-07', 'Active'),
(6, 'TOTE BAG', 'SSITE', '4', 'Single', 0x365f313733333537363937362e6a7067, 200, 232, 4, 4, '2024-12-07', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `item_orders`
--

CREATE TABLE `item_orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_totalamount` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_id` bigint(11) UNSIGNED NOT NULL,
  `transaction_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mem_status`
--

CREATE TABLE `mem_status` (
  `memstatus_id` bigint(20) UNSIGNED NOT NULL,
  `memstatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mem_status`
--

INSERT INTO `mem_status` (`memstatus_id`, `memstatus`) VALUES
(1, 'Unidentified'),
(2, 'Active'),
(3, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `news_update`
--

CREATE TABLE `news_update` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` text NOT NULL,
  `post_img` longblob NOT NULL,
  `post_url` text NOT NULL,
  `admin_id` bigint(11) UNSIGNED NOT NULL,
  `date_webposted` datetime NOT NULL,
  `record_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_update`
--

INSERT INTO `news_update` (`post_id`, `title`, `caption`, `post_img`, `post_url`, `admin_id`, `date_webposted`, `record_status`) VALUES
(1, 'SSITE Conversion Week 2024', ' 🎶“𝐺𝑢𝑠𝑡𝑜 𝑘𝑜𝑛𝑔 𝑖𝑏𝑖𝑔𝑎𝑦 𝑎𝑛𝑔 𝑐𝑜𝑑𝑒 𝑛𝑎 𝑔𝑢𝑠𝑡𝑜 𝑚𝑜”🎶\r\n\r\n\r\nDecember 06 is coming, Peninsulares! Are you ready for some fun at the Treyd Fest 2024?💥📢\r\n\r\nDon’t miss out on this chance to get a discount when you purchase your tickets—just use our promo code, 𝗦𝗦𝗜𝗧𝗘𝟮𝟬𝟮𝟰 ✨ Malay mo, may makasama ka pa sa 711 after the event. 👀\r\n\r\nGrab your tickets now, and let&#039;s make this event unforgettable!🎉\r\n\r\n:pushpin: For ticket-selling instructions, click this link: https://www.facebook.com/share/p/19bQLNzAwJ/ \r\n\r\n:pushpin: Visit the page below for further updates and information regarding Treyd Fest 2024\r\nCampus Student Government- BPSU Main Campus : \r\nhttps://www.facebook.com/bpsuCSGmain\r\n@everyone\r\n\r\n#TreydFest2024\r\n#SSITE2024', 0x315f313733333337323235322e6a7067, 'https://www.facebook.com/', 2, '2024-12-05 00:00:00', 'Active'),
(2, 'SSITE Conversion Week', 'A\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA', 0x325f313733333538333239382e6a7067, 'ASDSAD.COM', 2, '2024-12-07 22:54:58', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `totalamount` decimal(10,0) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `transaction_status_id` bigint(50) UNSIGNED NOT NULL,
  `userinfo_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactionstatus`
--

CREATE TABLE `transactionstatus` (
  `transaction_status_id` bigint(11) UNSIGNED NOT NULL,
  `transaction_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactionstatus`
--

INSERT INTO `transactionstatus` (`transaction_status_id`, `transaction_status`) VALUES
(1, 'Pending'),
(2, 'Ongoing'),
(3, 'Completed'),
(4, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `usercred_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userinfo_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`usercred_id`, `email`, `password`, `userinfo_id`) VALUES
(1, 'e...d@gmail.com', '$2y$10$FGyROsrZw7NN6I59JnW2sOUhfrjqJn9w06cEvnlQlJSC60GQM31zK', 6),
(2, 'asd@gmail.com', '$2y$10$UsNYhieCYJQzxB8vb/KcEeLmwpZd0t/9MWJp7fFw1JMqjd38.hfpG', 7),
(3, 'asdf@gmail.com', '$2y$10$4fwqDQmyzmeYfFJ1Kkqr2ePY9uVxEfmlNk0TjzowWiSyEWd9PwqUq', 8),
(4, 'ass@gmail.com', '$2y$10$ozLtTi8z6IooAw0zQoxm3em1QpFsUnHoqlFsZvq3lD4Z8uXFtsLyO', 9),
(5, 'aaa@gmail.com', '$2y$10$fmkfVFKVdAKbVbw2vd6/p.ugcPd0gjTvGEKekx72oeUCbME3ATrGW', 10),
(6, 'a@gmail.com', '$2y$10$NHiSFpuQo1AnpWxhdRG23eQvp221Zx8Ifu8e8MmOpikSzLpOBzvAK', 11),
(7, 'ab@gmail.com', '$2y$10$W31csEdjNraLvriwdETHPeB6/ggQft79znMy7K7ibp4gA.iOiQkBe', 12),
(8, 'grardee@gmail.com', '$2y$10$O.ybD2QXctQAAhQsqa9C2.k17EvH0BAAf1JKz6Z6nbZxyKVNL2jYu', 15),
(9, 'grards@gmail.com', '$2y$10$YUEmC3DVtcxkXdQ.u5j4P.J.7K9cc7SC8eTwinM6OCVITBKDUMh7G', 16),
(10, 'abs@gmail.com', '$2y$10$b/noFIZJE3xONQmDbRJDlOU/2UnG3KFyDvdQ1uvImu0r3.iAezVR6', 17);

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `userinfo_id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `bday` date NOT NULL,
  `student_number` varchar(15) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_status` varchar(50) NOT NULL,
  `memstatus_id` bigint(11) UNSIGNED NOT NULL,
  `customertype_id` bigint(11) UNSIGNED NOT NULL,
  `custype_verif_id` int(11) NOT NULL,
  `account_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`userinfo_id`, `firstname`, `lastname`, `sex`, `bday`, `student_number`, `contact_number`, `email`, `account_status`, `memstatus_id`, `customertype_id`, `custype_verif_id`, `account_created`) VALUES
(1, 'Eloisa Marie', 'Sumbad', 'Male', '2004-10-28', '22-05509', '09765868588', 'emsumbad@gmail.com', 'Active', 3, 1, 1, '2024-12-02 17:00:53'),
(2, 'Eloisa Marie', 'Sumbad', 'Male', '2004-10-28', '22-05509', '09765868588', 'eloisamariemsumbaddd@gmail.com', 'Active', 1, 1, 1, '2024-12-02 17:12:15'),
(3, 'Eloisa Marie', 'Sumbad', 'Female', '2004-10-28', '-', '09765868588', 'jayne.islyf@gmail.com', 'Active', 1, 2, 1, '2024-12-02 17:19:10'),
(4, 'Eloisa Marie', 'Sumbad', 'Female', '2004-10-28', '-', '09765868588', 'name@gmail.com', 'Active', 1, 2, 1, '2024-12-02 17:26:48'),
(5, 'Eloisa Marie', 'Sumbad', 'Male', '2004-02-02', '-', '09765868588', 'blue26gatorade@gmail.com', 'Active', 1, 2, 1, '2024-12-02 17:27:37'),
(6, 'Eloisa Marie', 'Sumbad', 'Female', '2004-10-28', '-', '09765868588', 'e...d@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:23:34'),
(7, 'Eloisa Marie', 'Sumbad', 'Female', '2004-05-20', '-', '09765868588', 'asd@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:34:37'),
(8, 'Eloisa Marie', 'Sumbad', 'Male', '2003-02-22', '22-05509', '09765868588', 'asdf@gmail.com', 'Active', 1, 1, 1, '2024-12-03 00:35:52'),
(9, 'Eloisa Marie', 'Sumbad', 'Male', '2004-02-22', '22-05509', '09765868588', 'ass@gmail.com', 'Active', 1, 1, 1, '2024-12-03 00:37:27'),
(10, 'Eloisa Marie', 'Sumbad', 'Female', '2004-11-01', '-', '09765868588', 'aaa@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:40:38'),
(11, 'Eloisa Marie', 'Sumbad', 'Female', '2005-05-12', '-', '09765868588', 'a@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:54:50'),
(12, 'Eloisa Marie', 'Sumbad', 'Female', '2005-05-12', '-', '09765868588', 'ab@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:57:58'),
(13, 'Grace', 'Atrazo', 'Male', '2011-11-11', '-', '09666666666', 'grace@gmail.com', 'Active', 2, 2, 2, '2024-12-06 02:41:14'),
(14, 'Grace', 'Atrazo', 'Male', '2011-11-11', '22-05509', '09666666666', 'graceerd@gmail.com', 'Active', 2, 1, 2, '2024-12-06 10:00:06'),
(15, 'ra', 'rd', 'Male', '2011-11-11', '132', '09666666666', 'grardee@gmail.com', 'Active', 1, 2, 1, '2024-12-06 16:26:15'),
(16, 'Grace', 'Atrazo', 'Male', '2022-02-22', '-', '09666666666', 'grards@gmail.com', 'Active', 1, 2, 2, '2024-12-06 16:28:38'),
(17, 'Ace', 'Macaspac', 'Female', '2005-10-11', '-', '09913655545', 'abs@gmail.com', 'Active', 1, 2, 1, '2024-12-07 16:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `userlogin_id` bigint(20) UNSIGNED NOT NULL,
  `usercred_id` bigint(11) UNSIGNED NOT NULL,
  `logindate` datetime NOT NULL,
  `usertype_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`userlogin_id`, `usercred_id`, `logindate`, `usertype_id`) VALUES
(1, 1, '2024-12-03 00:23:47', 1),
(2, 1, '2024-12-03 00:25:23', 2),
(3, 1, '2024-12-03 00:30:30', 2),
(4, 4, '2024-12-03 00:41:06', 1),
(5, 4, '2024-12-03 01:06:05', 1),
(6, 1, '2024-12-03 01:06:13', 2),
(7, 1, '2024-12-03 01:14:27', 2),
(8, 1, '2024-12-03 01:16:36', 2),
(9, 1, '2024-12-03 01:16:36', 2),
(10, 1, '2024-12-03 01:24:19', 2),
(11, 1, '2024-12-03 10:28:43', 2),
(12, 1, '2024-12-03 10:56:10', 2),
(13, 1, '2024-12-03 11:37:57', 2),
(14, 1, '2024-12-03 11:59:50', 2),
(15, 4, '2024-12-03 12:03:48', 1),
(16, 1, '2024-12-03 12:06:56', 2),
(17, 1, '2024-12-03 12:17:40', 2),
(18, 1, '2024-12-03 12:20:11', 2),
(19, 1, '2024-12-03 12:20:40', 2),
(20, 1, '2024-12-03 12:42:28', 2),
(21, 4, '2024-12-03 13:08:21', 1),
(22, 1, '2024-12-03 13:08:32', 2),
(23, 1, '2024-12-03 13:59:00', 2),
(24, 4, '2024-12-03 13:59:29', 1),
(25, 1, '2024-12-03 13:59:38', 2),
(26, 1, '2024-12-03 14:02:38', 2),
(27, 4, '2024-12-03 14:13:51', 1),
(28, 1, '2024-12-03 14:14:06', 1),
(29, 1, '2024-12-03 14:15:13', 1),
(30, 4, '2024-12-03 14:20:08', 1),
(31, 1, '2024-12-03 14:20:15', 1),
(32, 1, '2024-12-03 14:21:03', 2),
(33, 1, '2024-12-03 14:36:19', 1),
(34, 4, '2024-12-03 14:37:04', 1),
(35, 1, '2024-12-03 14:38:48', 1),
(36, 1, '2024-12-03 14:39:15', 2),
(37, 1, '2024-12-03 17:57:15', 2),
(38, 1, '2024-12-03 18:02:05', 2),
(39, 1, '2024-12-03 20:37:27', 2),
(40, 1, '2024-12-03 20:49:37', 2),
(41, 1, '2024-12-03 20:55:38', 2),
(42, 1, '2024-12-04 01:19:26', 2),
(43, 1, '2024-12-04 10:52:47', 2),
(44, 1, '2024-12-04 14:27:22', 2),
(45, 4, '2024-12-04 14:29:42', 1),
(46, 1, '2024-12-04 14:31:37', 2),
(47, 1, '2024-12-04 22:14:10', 2),
(48, 4, '2024-12-05 10:27:15', 1),
(49, 1, '2024-12-05 10:27:23', 2),
(50, 1, '2024-12-05 16:05:02', 2),
(51, 1, '2024-12-05 16:18:00', 1),
(52, 1, '2024-12-05 16:18:07', 2),
(53, 1, '2024-12-06 08:57:01', 2),
(54, 4, '2024-12-06 17:45:12', 1),
(55, 1, '2024-12-06 17:45:22', 2),
(56, 1, '2024-12-06 17:52:36', 2),
(57, 1, '2024-12-06 17:53:40', 2),
(58, 1, '2024-12-06 18:10:57', 2),
(59, 1, '2024-12-06 18:11:34', 1),
(60, 1, '2024-12-06 18:11:44', 2),
(61, 1, '2024-12-06 18:16:00', 2),
(62, 1, '2024-12-06 18:16:36', 2),
(63, 1, '2024-12-06 19:17:56', 2),
(64, 1, '2024-12-06 21:21:03', 2),
(65, 1, '2024-12-06 21:44:51', 2),
(66, 1, '2024-12-07 00:12:25', 2),
(67, 1, '2024-12-07 02:59:17', 1),
(68, 1, '2024-12-07 09:16:18', 2),
(69, 4, '2024-12-07 09:17:56', 1),
(70, 1, '2024-12-07 09:37:44', 2),
(71, 10, '2024-12-07 16:38:22', 1),
(72, 1, '2024-12-07 16:38:39', 2),
(73, 10, '2024-12-07 16:40:11', 2),
(74, 10, '2024-12-07 16:45:35', 1),
(75, 10, '2024-12-07 16:48:16', 2),
(76, 1, '2024-12-07 16:48:29', 2),
(77, 1, '2024-12-07 16:49:24', 2),
(78, 10, '2024-12-07 16:58:57', 2),
(79, 1, '2024-12-07 17:06:56', 2),
(80, 10, '2024-12-07 17:07:11', 2),
(81, 1, '2024-12-07 17:07:27', 2),
(82, 1, '2024-12-07 17:08:47', 2),
(83, 10, '2024-12-07 17:10:13', 2),
(84, 10, '2024-12-07 17:10:51', 2),
(85, 10, '2024-12-07 17:12:55', 2),
(86, 4, '2024-12-07 17:28:12', 1),
(87, 10, '2024-12-07 17:32:38', 2),
(88, 10, '2024-12-07 17:33:45', 2),
(89, 10, '2024-12-07 17:34:02', 2),
(90, 1, '2024-12-07 17:37:19', 2),
(91, 1, '2024-12-07 17:42:15', 2),
(92, 1, '2024-12-07 17:42:25', 2),
(93, 1, '2024-12-07 17:44:17', 2),
(94, 1, '2024-12-07 17:44:26', 2),
(95, 1, '2024-12-07 17:44:40', 2),
(96, 10, '2024-12-07 17:44:50', 2),
(97, 10, '2024-12-07 17:45:29', 2),
(98, 10, '2024-12-07 17:45:33', 2),
(99, 10, '2024-12-07 17:48:18', 2),
(100, 10, '2024-12-07 17:49:31', 2),
(101, 10, '2024-12-07 17:50:20', 2),
(102, 1, '2024-12-07 17:51:04', 2),
(103, 10, '2024-12-07 17:56:48', 2),
(104, 1, '2024-12-07 17:59:19', 2),
(105, 10, '2024-12-07 18:26:37', 2),
(106, 1, '2024-12-07 18:40:30', 2),
(107, 10, '2024-12-07 18:51:42', 2),
(108, 1, '2024-12-07 18:53:58', 2),
(109, 10, '2024-12-07 18:56:32', 2),
(110, 1, '2024-12-07 18:58:16', 2),
(111, 10, '2024-12-07 19:39:06', 2),
(112, 1, '2024-12-07 19:39:21', 2),
(113, 10, '2024-12-07 19:39:42', 2),
(114, 1, '2024-12-07 19:53:35', 2),
(115, 1, '2024-12-07 19:54:12', 1),
(116, 1, '2024-12-07 19:54:21', 2),
(117, 1, '2024-12-07 19:54:40', 1),
(118, 1, '2024-12-07 20:34:49', 2),
(119, 10, '2024-12-07 20:56:59', 1),
(120, 10, '2024-12-07 21:05:36', 2),
(121, 1, '2024-12-07 22:48:05', 2),
(122, 10, '2024-12-07 22:56:59', 1),
(123, 4, '2024-12-08 02:22:51', 1),
(124, 1, '2024-12-08 02:41:49', 2),
(125, 1, '2024-12-08 02:42:14', 2),
(126, 1, '2024-12-08 02:45:19', 2),
(127, 4, '2024-12-08 02:45:43', 1),
(128, 10, '2024-12-08 02:46:02', 2),
(129, 1, '2024-12-08 02:47:44', 2),
(130, 1, '2024-12-08 02:52:20', 2),
(131, 1, '2024-12-08 03:04:15', 2),
(132, 4, '2024-12-08 03:09:23', 1),
(133, 1, '2024-12-08 03:18:18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `usertype_id` int(20) UNSIGNED NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`usertype_id`, `usertype`) VALUES
(1, 'Customer'),
(2, 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD KEY `fk_adminuid` (`userinfo_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_cart_item` (`item_id`),
  ADD KEY `fk_cart_` (`userinfo_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_id` (`cat_id`),
  ADD KEY `fk_adminid_cat` (`admin_creator`);

--
-- Indexes for table `customertype`
--
ALTER TABLE `customertype`
  ADD PRIMARY KEY (`customertype_id`),
  ADD UNIQUE KEY `customertype_id` (`customertype_id`);

--
-- Indexes for table `customertype_verification`
--
ALTER TABLE `customertype_verification`
  ADD PRIMARY KEY (`custype_verif_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_id` (`item_id`),
  ADD KEY `fk_catid` (`cat_id`),
  ADD KEY `fk_adminid_item` (`admin_creator`);

--
-- Indexes for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `fk_itemid` (`item_id`),
  ADD KEY `fk_tranid` (`transaction_id`);

--
-- Indexes for table `mem_status`
--
ALTER TABLE `mem_status`
  ADD PRIMARY KEY (`memstatus_id`),
  ADD UNIQUE KEY `memstatus_id` (`memstatus_id`);

--
-- Indexes for table `news_update`
--
ALTER TABLE `news_update`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`),
  ADD KEY `fk_adminid_post` (`admin_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `fk_trstatus` (`transaction_status_id`),
  ADD KEY `fk_tr_uid` (`userinfo_id`);

--
-- Indexes for table `transactionstatus`
--
ALTER TABLE `transactionstatus`
  ADD PRIMARY KEY (`transaction_status_id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`usercred_id`),
  ADD UNIQUE KEY `usercred_id` (`usercred_id`),
  ADD KEY `fk_userinfo` (`userinfo_id`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`userinfo_id`),
  ADD UNIQUE KEY `userinfo_id` (`userinfo_id`),
  ADD KEY `fk_memstat` (`memstatus_id`),
  ADD KEY `dk_customertype` (`customertype_id`),
  ADD KEY `fk_custype_verif` (`custype_verif_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`userlogin_id`),
  ADD UNIQUE KEY `userlogin_id` (`userlogin_id`),
  ADD KEY `fk_usercred` (`usercred_id`),
  ADD KEY `fk_login_usertype` (`usertype_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`usertype_id`),
  ADD UNIQUE KEY `usertype_id` (`usertype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customertype`
--
ALTER TABLE `customertype`
  MODIFY `customertype_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_orders`
--
ALTER TABLE `item_orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mem_status`
--
ALTER TABLE `mem_status`
  MODIFY `memstatus_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news_update`
--
ALTER TABLE `news_update`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `userlogin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_adminuid` FOREIGN KEY (`userinfo_id`) REFERENCES `user_information` (`userinfo_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_` FOREIGN KEY (`userinfo_id`) REFERENCES `user_information` (`userinfo_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_adminid_cat` FOREIGN KEY (`admin_creator`) REFERENCES `admin` (`admin_id`) ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_adminid_item` FOREIGN KEY (`admin_creator`) REFERENCES `admin` (`admin_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_catid` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON UPDATE CASCADE;

--
-- Constraints for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD CONSTRAINT `fk_itemid` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tranid` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON UPDATE CASCADE;

--
-- Constraints for table `news_update`
--
ALTER TABLE `news_update`
  ADD CONSTRAINT `fk_adminid_post` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_tr_uid` FOREIGN KEY (`userinfo_id`) REFERENCES `user_information` (`userinfo_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_trstatus` FOREIGN KEY (`transaction_status_id`) REFERENCES `transactionstatus` (`transaction_status_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD CONSTRAINT `fk_userinfo` FOREIGN KEY (`userinfo_id`) REFERENCES `user_information` (`userinfo_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_information`
--
ALTER TABLE `user_information`
  ADD CONSTRAINT `dk_customertype` FOREIGN KEY (`customertype_id`) REFERENCES `customertype` (`customertype_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_custype_verif` FOREIGN KEY (`custype_verif_id`) REFERENCES `customertype_verification` (`custype_verif_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_memstat` FOREIGN KEY (`memstatus_id`) REFERENCES `mem_status` (`memstatus_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_login`
--
ALTER TABLE `user_login`
  ADD CONSTRAINT `fk_login_usertype` FOREIGN KEY (`usertype_id`) REFERENCES `user_type` (`usertype_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usercred` FOREIGN KEY (`usercred_id`) REFERENCES `user_credentials` (`usercred_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
