-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 07:49 PM
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
  `privilege` varchar(255) NOT NULL,
  `granting_date` date NOT NULL,
  `admin_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `userinfo_id`, `privilege`, `granting_date`, `admin_status`) VALUES
(1, 1, '', '0000-00-00', 'Active'),
(2, 6, '', '0000-00-00', 'Active');

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
(3, 'Bag', 2, '2024-12-04 17:08:44', 'Active');

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
-- Table structure for table `item-orders`
--

CREATE TABLE `item-orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_totalamount` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_id` bigint(11) UNSIGNED NOT NULL,
  `transaction_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_spec` text NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_img` longblob NOT NULL,
  `item_price` decimal(10,0) NOT NULL,
  `cat_id` int(11) UNSIGNED NOT NULL,
  `admin_creator` bigint(20) UNSIGNED NOT NULL,
  `date_created` date NOT NULL,
  `record_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_spec`, `item_desc`, `item_img`, `item_price`, `cat_id`, `admin_creator`, `date_created`, `record_status`) VALUES
(1, 'T-Shirt', 'Small', 'White', 0x315f313733333333333938312e706e67, 320, 1, 2, '2024-12-05', 'Active'),
(2, 'Polo Shirt', 'Medium', '  Turquoise', 0x325f313733333333343135342e6a7067, 700, 1, 2, '2024-12-05', 'Active'),
(3, 'Tote Bag', 'Brightening Future~', '-', 0x335f313733333333343230322e706e67, 220, 3, 2, '2024-12-05', 'Active');

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
  `date_webposted` date NOT NULL,
  `record_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 'ab@gmail.com', '$2y$10$W31csEdjNraLvriwdETHPeB6/ggQft79znMy7K7ibp4gA.iOiQkBe', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `userinfo_id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
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

INSERT INTO `user_information` (`userinfo_id`, `firstname`, `lastname`, `gender`, `bday`, `student_number`, `contact_number`, `email`, `account_status`, `memstatus_id`, `customertype_id`, `custype_verif_id`, `account_created`) VALUES
(1, 'Eloisa Marie', 'Sumbad', 'Female', '2004-10-28', '22-05509', '09765868588', 'emmsumbad@bpsu.edu.ph', 'Active', 1, 1, 1, '2024-12-02 17:00:53'),
(2, 'Eloisa Marie', 'Sumbad', 'Female', '2004-10-28', '22-05509', '09765868588', 'eloisamariemsumbad@gmail.com', 'Active', 1, 1, 1, '2024-12-02 17:12:15'),
(3, 'Eloisa Marie', 'Sumbad', 'Female', '2004-10-28', '-', '09765868588', 'jayne.islyf@gmail.com', 'Active', 1, 2, 1, '2024-12-02 17:19:10'),
(4, 'Eloisa Marie', 'Sumbad', 'Female', '2004-10-28', '-', '09765868588', 'name@gmail.com', 'Active', 1, 2, 1, '2024-12-02 17:26:48'),
(5, 'Eloisa Marie', 'Sumbad', 'Male', '2004-02-02', '-', '09765868588', 'blue26gatorade@gmail.com', 'Active', 1, 2, 1, '2024-12-02 17:27:37'),
(6, 'Eloisa Marie', 'Sumbad', 'Female', '2004-10-28', '-', '09765868588', 'e...d@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:23:34'),
(7, 'Eloisa Marie', 'Sumbad', 'Female', '2004-05-20', '-', '09765868588', 'asd@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:34:37'),
(8, 'Eloisa Marie', 'Sumbad', 'Male', '2003-02-22', '22-05509', '09765868588', 'asdf@gmail.com', 'Active', 1, 1, 1, '2024-12-03 00:35:52'),
(9, 'Eloisa Marie', 'Sumbad', 'Male', '2004-02-22', '22-05509', '09765868588', 'ass@gmail.com', 'Active', 1, 1, 1, '2024-12-03 00:37:27'),
(10, 'Eloisa Marie', 'Sumbad', 'Female', '2004-11-01', '-', '09765868588', 'aaa@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:40:38'),
(11, 'Eloisa Marie', 'Sumbad', 'Female', '2005-05-12', '-', '09765868588', 'a@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:54:50'),
(12, 'Eloisa Marie', 'Sumbad', 'Female', '2005-05-12', '-', '09765868588', 'ab@gmail.com', 'Active', 1, 2, 1, '2024-12-03 00:57:58');

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
(47, 1, '2024-12-04 22:14:10', 2);

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
-- Indexes for table `item-orders`
--
ALTER TABLE `item-orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `fk_itemid` (`item_id`),
  ADD KEY `fk_tranid` (`transaction_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_id` (`item_id`),
  ADD KEY `fk_catid` (`cat_id`),
  ADD KEY `fk_adminid_item` (`admin_creator`);

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
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customertype`
--
ALTER TABLE `customertype`
  MODIFY `customertype_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item-orders`
--
ALTER TABLE `item-orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mem_status`
--
ALTER TABLE `mem_status`
  MODIFY `memstatus_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news_update`
--
ALTER TABLE `news_update`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `userlogin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_adminuid` FOREIGN KEY (`userinfo_id`) REFERENCES `user_information` (`userinfo_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_adminid_cat` FOREIGN KEY (`admin_creator`) REFERENCES `admin` (`admin_id`) ON UPDATE CASCADE;

--
-- Constraints for table `item-orders`
--
ALTER TABLE `item-orders`
  ADD CONSTRAINT `fk_itemid` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tranid` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_adminid_item` FOREIGN KEY (`admin_creator`) REFERENCES `admin` (`admin_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_catid` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON UPDATE CASCADE;

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
