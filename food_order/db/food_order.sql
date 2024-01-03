-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2023 at 11:21 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int UNSIGNED NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(15, 'azerty', 'azerty', '$argon2id$v=19$m=65536,t=4,p=1$MzNkeEwyTFNlL3EwMHN3cg$IYto5W6mX1VP0WuhRNcllN75K/8m5gVEgNJm9yjoOyk'),
(24, 'mehdi', 'azerty', '$argon2id$v=19$m=65536,t=4,p=1$UkRldkI4b1BUdWVqSkJSag$MhJS1ULoAemzuCE0h7jDxZRPXbHGzA0O2coGgsMNn0Y'),
(25, '', 'azer', '$argon2id$v=19$m=65536,t=4,p=1$S3NzMHJqUmNIUjVoMkc1Ug$xcpfD1K5+FfQmnjriwwpySaEHWWhfLfxk42RT7qxh/g'),
(26, '', 'azerty', '$argon2id$v=19$m=65536,t=4,p=1$YUNHdE54ZC5GbDBLNHhiRg$kTJibUaEc0q3jwy4kgwGXWYXPa6rICN6WQieBUB28pY');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(54, 'pizza', '722e6db809270934273f48bb3366730b.jpg', 'yes', 'yes'),
(56, 'hamburger', '208e7f16ad77d52e22f06543cd655d8d.jpg', 'yes', 'yes'),
(57, 'momo', 'a7d240e33671eda83e39152dcf7c7edb.jpg', 'yes', 'yes'),
(59, 'legume', '9fccf6ead5dfbfa1b1570b96fbbc80a8.png', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(5, 'salades', 'salades verte', '55.00', '61e7a4f562656848998e789e2998d38b.jpg', 57, 'no', 'no'),
(6, 'tesst', 'gdgdg', '55551.00', 'd259b1abb04bc2881236634201cbb289.png', 56, 'yes', 'yes'),
(8, 'terztez', 'sfsdfsdfsf', '5565.00', '14e1a9770beab52953f03190556f3bcc.jpg', 54, 'no', 'yes'),
(9, 'sfsdf', 'sfsdfsf', '1515.00', '53336b41bb9fa5039637fbe05744120b.jpg', 56, 'yes', 'yes'),
(10, 'fghfg', 'hfghf', '8884.00', '50017d6dbd36355303e7c42795df3c5b.jpg', 57, 'yes', 'yes'),
(11, 'qdqsd', 'dqdqs', '555.00', '76ae208299fe64f996a0add645607b14.jpg', 60, 'yes', 'no'),
(12, 'dsd', 'sqdq', '65.00', 'c280b52e33a51296f65ed437a937cc37.jpg', 60, 'yes', 'yes'),
(13, 'sfsdf', 'fsfdsfsf55652', '156.00', '1ecf8df24e957f868a08b2583f411b0f.jpg', 54, 'no', 'yes'),
(14, 'qdqsd', 'salades', '11.00', 'df8af369ed7b7179be3d4dce5be9344f.png', 56, 'yes', 'yes'),
(16, 'pizza', 'burger', '999999.00', '2f43364d535e58d2dda08159e2e75333.png', 54, 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int UNSIGNED NOT NULL,
  `food` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_contact` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'salades', '55.00', 2, '110.00', '2023-11-21 16:26:51', 'Delivered', 'ilyes', '0656565', 'mehdi@kerkar.com', 'qsqs'),
(2, 'salades', '55.00', 3, '165.00', '2023-11-21 16:27:36', 'Cancelled', 'mehdi', '0656565', 'mehdi@kerkar.com', 'bbvcbv'),
(3, 'salades', '55.00', 1, '55.00', '2023-11-21 16:32:12', 'Delivered', 'mehdi', '0656565', 'mehdi@kerkar.com', 'gfgd'),
(4, 'salades', '55.00', 1, '55.00', '2023-11-21 16:34:32', 'Delivered', 'mehdi', '0656565', 'mehdi@kerkar.com', '62'),
(5, 'salades', '55.00', 2, '110.00', '2023-11-21 16:35:03', 'Delivered', 'mehdis', '0656565ssss', 'mehdi@kerkar.com', 'dzqdsqSqs'),
(6, 'pizza', '999999.00', 4, '3999996.00', '2023-11-21 20:44:41', 'Delivered', 'mehdi', '0656565', 'mehdi@kerkar.com', 'gugj'),
(7, 'fghfg', '8884.00', 1, '8884.00', '2023-11-21 22:04:14', 'Ordered', 'azerty', '0656565', 'mehdi@kerkar.comcc', 'zdzqdzq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
