-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 10:37 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbt-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Fullname`, `username`, `email`, `password`) VALUES
(1, 'James Cedrick Barzaga', 'admin', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cancelsales`
--

CREATE TABLE `cancelsales` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_cash` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` int(100) NOT NULL,
  `total_item` int(100) NOT NULL,
  `pay_deadline_date` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cancelsales`
--

INSERT INTO `cancelsales` (`id`, `customer_id`, `is_cash`, `total_price`, `total_item`, `pay_deadline_date`, `date`, `status`) VALUES
('OUT1669635861', 'CUST0001', '1', 50, 1, NULL, '2022-11-28 17:58:04', 'Deleted'),
('OUT1669828137', 'CUST0001', '0', 50, 1, NULL, '2022-11-30 17:09:03', 'Deleted'),
('OUT1669829358', 'CUST0001', '0', 50, 1, NULL, '2022-11-30 17:29:35', 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_desc`, `date`, `status`) VALUES
('CTG0001', 'per pcs', '', '2022-11-28 04:40:09', 'Deleted'),
('CTG0002', 'CASE x9', '', '2022-11-30 09:51:21', 'ㅤ'),
('CTG0003', 'CASE x12', '', '2022-12-10 03:29:19', 'ㅤ');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `store_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `store_name`, `customer_name`, `customer_phone`, `customer_address`, `date`, `status`) VALUES
('CUST0001', 'asd', 'test', '0912356789', '100 E. Rodriguez Avenue, C5 Road, Barangay Ugong, Pasig City', '2023-01-15 10:23:25', 'Deleted'),
('CUST0002', 'nena store', 'aling nena', '09123456789', 'Santa Maria Bulacan', '2023-02-12 15:47:02', '');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `log_name` varchar(50) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_name`, `activity`, `name`, `date`) VALUES
(26, 'James Cedrick Barzaga', 'add new Sales Transaction', 'OUT1676803197', '2023-02-19 19:39:57'),
(27, 'James Cedrick Barzaga', 'add new Sales Transaction', 'OUT1676803197', '2023-02-19 19:39:57'),
(28, 'James Cedrick Barzaga', 'add new Sales Transaction', 'OUT1676803383', '2023-02-19 10:43:10'),
(29, 'James Cedrick Barzaga', 'add new Purchase Transaction', 'INTRC0032', '2023-02-20 09:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT '0',
  `buying_price` int(11) NOT NULL,
  `tax` double NOT NULL,
  `sale_price` double NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `category_id`, `product_desc`, `product_qty`, `buying_price`, `tax`, `sale_price`, `date`, `status`) VALUES
('PRD0001', 'Redhorse', 'CTG0002', 'normal size bottle', 78, 90, 0, 100.8, '2022-12-09 07:48:13', ''),
('PRD0002', 'Redhorse mucho', 'CTG0003', 'normal size bottle', 3, 1500, 0, 1680, '2023-01-03 14:44:50', ''),
('PRD0003', 'ASD', 'CTG0002', 'normal size bottle', 23, 90, 0, 100.8, '2023-02-16 10:54:40', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_data`
--

CREATE TABLE `purchase_data` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `selling_price` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `price_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Purchase Transaction, 0=Purchase Retur',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_data`
--

INSERT INTO `purchase_data` (`id`, `transaction_id`, `product_id`, `category_id`, `quantity`, `selling_price`, `price_item`, `subtotal`, `type`, `date`) VALUES
(6, 'TRC0001', 'PRD0001', 'CTG0002', '1', '₱106', '95', '95', 1, '2022-12-11 08:51:05'),
(7, 'TRC0002', 'PRD0001', 'CTG0002', '1', '106', '95', '95', 1, '2022-12-11 09:10:10'),
(8, 'TRC0003', 'PRD0001', 'CTG0002', '1', '1,120', '1000', '1000', 1, '2022-12-11 09:26:34'),
(9, 'TRC0004', 'PRD0001', 'CTG0002', '1', '1,120', '1000', '1000', 1, '2022-12-11 09:29:42'),
(10, 'TRC0005', 'PRD0001', 'CTG0002', '1', '1,120', '1000', '1000', 1, '2022-12-11 09:31:14'),
(11, 'TRC0006', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1500', 1, '2022-12-11 09:33:17'),
(12, 'TRC0007', 'PRD0002', 'CTG0003', '1', '1120', '1000', '1000', 1, '2023-01-03 21:53:27'),
(13, 'TRC0008', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-16 06:03:42'),
(14, 'TRC0009', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:27:48'),
(15, 'TRC0010', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:30:03'),
(16, 'TRC0011', 'PRD0002', 'CTG0003', '1', '1680', '1500', '1500', 1, '2023-02-17 20:31:04'),
(17, 'TRC0012', 'PRD0003', 'CTG0002', '1', '1680', '1500', '1500', 1, '2023-02-17 20:35:00'),
(18, 'TRC0013', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:38:06'),
(19, 'TRC0014', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:40:10'),
(20, 'TRC0015', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:43:48'),
(21, 'TRC0016', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:47:29'),
(22, 'TRC0017', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:49:27'),
(23, 'TRC0018', 'PRD0001', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:51:13'),
(24, 'TRC0019', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-17 20:56:07'),
(25, 'TRC0020', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 10:13:04'),
(26, 'TRC0021', 'PRD0001', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 10:35:21'),
(27, 'TRC0022', 'PRD0002', 'CTG0003', '1', '1680', '1500', '1500', 1, '2023-02-19 10:41:36'),
(28, 'TRC0023', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 10:47:36'),
(29, 'TRC0024', 'PRD0002', 'CTG0003', '1', '1680', '1500', '1500', 1, '2023-02-19 10:49:24'),
(30, 'TRC0025', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 10:51:44'),
(31, 'TRC0026', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 10:55:11'),
(32, 'TRC0027', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 11:00:32'),
(33, 'TRC0028', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 11:01:38'),
(34, 'TRC0029', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 11:21:22'),
(35, 'TRC0030', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 11:24:13'),
(36, 'TRC0031', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-19 11:29:30'),
(37, 'INTRC0032', 'PRD0003', 'CTG0002', '1', '100.8', '90', '90', 1, '2023-02-20 09:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_retur`
--

CREATE TABLE `purchase_retur` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sales_return_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_return` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `return_by` enum('1','0') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Retur by 1 = barang, 0 = uang',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_retur`
--

INSERT INTO `purchase_retur` (`id`, `sales_return_id`, `total_price`, `total_item`, `is_return`, `return_by`, `date`) VALUES
('RETP1670086941', 'TRC0004', '95', '1', '1', '1', '2022-12-03 17:06:51'),
('RETS1676885356', 'RETS1676665623', '100', '1', '0', '1', '2023-02-20 09:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_transaction`
--

CREATE TABLE `purchase_transaction` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` int(20) NOT NULL,
  `total_item` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `supplier_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_transaction`
--

INSERT INTO `purchase_transaction` (`id`, `total_price`, `total_item`, `date`, `supplier_id`) VALUES
('INTRC0032', 90, 1, '2023-02-20 09:26:39', 'SUP002'),
('TRC0001', 95, 1, '2022-12-11 08:51:05', 'SUP001'),
('TRC0002', 95, 1, '2022-12-11 09:10:10', 'SUP001'),
('TRC0003', 1000, 1, '2022-12-11 09:26:34', 'SUP001'),
('TRC0004', 1000, 1, '2022-12-11 09:29:42', 'SUP001'),
('TRC0005', 1000, 1, '2022-12-11 09:31:14', 'SUP001'),
('TRC0006', 1500, 1, '2022-12-11 09:33:17', 'SUP001'),
('TRC0007', 1000, 1, '2023-01-03 21:53:26', 'SUP001'),
('TRC0008', 90, 1, '2023-02-16 06:03:42', 'SUP002'),
('TRC0009', 90, 1, '2023-02-17 20:27:47', 'SUP002'),
('TRC0010', 90, 1, '2023-02-17 20:30:03', 'SUP002'),
('TRC0011', 1500, 1, '2023-02-17 20:31:04', 'SUP002'),
('TRC0012', 1500, 1, '2023-02-17 20:35:00', 'SUP002'),
('TRC0013', 90, 1, '2023-02-17 20:38:06', 'SUP002'),
('TRC0014', 90, 1, '2023-02-17 20:40:10', 'SUP002'),
('TRC0015', 90, 1, '2023-02-17 20:43:48', 'SUP002'),
('TRC0016', 90, 1, '2023-02-17 20:47:29', 'SUP002'),
('TRC0017', 90, 1, '2023-02-17 20:49:27', 'SUP002'),
('TRC0018', 90, 1, '2023-02-17 20:51:13', 'SUP002'),
('TRC0019', 90, 1, '2023-02-17 20:56:07', 'SUP002'),
('TRC0020', 90, 1, '2023-02-19 10:13:04', 'SUP002'),
('TRC0021', 90, 1, '2023-02-19 10:35:21', 'SUP002'),
('TRC0022', 1500, 1, '2023-02-19 10:41:36', 'SUP002'),
('TRC0023', 90, 1, '2023-02-19 10:47:36', 'SUP002'),
('TRC0024', 1500, 1, '2023-02-19 10:49:24', 'SUP002'),
('TRC0025', 90, 1, '2023-02-19 10:51:44', 'SUP002'),
('TRC0026', 90, 1, '2023-02-19 10:55:11', 'SUP002'),
('TRC0027', 90, 1, '2023-02-19 11:00:32', 'SUP002'),
('TRC0028', 90, 1, '2023-02-19 11:01:38', 'SUP002'),
('TRC0029', 90, 1, '2023-02-19 11:21:21', 'SUP002'),
('TRC0030', 90, 1, '2023-02-19 11:24:12', 'SUP002'),
('TRC0031', 90, 1, '2023-02-19 11:29:30', 'SUP002');

-- --------------------------------------------------------

--
-- Table structure for table `sales_data`
--

CREATE TABLE `sales_data` (
  `id` int(11) NOT NULL,
  `sales_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buying_price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Sales Transaction, 0=Sales Retur',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_data`
--

INSERT INTO `sales_data` (`id`, `sales_id`, `product_id`, `category_id`, `quantity`, `price_item`, `buying_price`, `subtotal`, `type`, `date`) VALUES
(9, 'OUT1672802271', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-01-04 04:02:59'),
(10, 'OUT1672802886', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-01-04 04:03:13'),
(11, 'OUT1676184470', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 06:48:00'),
(12, 'OUT1676185124', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 06:58:52'),
(13, 'OUT1676185243', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 07:00:53'),
(14, 'OUT1676185303', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 07:01:50'),
(15, 'OUT1676185346', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 07:02:34'),
(16, 'OUT1676185424', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 07:04:02'),
(17, 'OUT1676185803', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 07:10:11'),
(18, 'OUT1676190219', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 08:24:00'),
(19, 'OUT1676190689', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 08:31:36'),
(20, 'OUT1676191979', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 08:53:07'),
(21, 'OUT1676192136', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 08:55:48'),
(22, 'OUT1676192238', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-12 08:57:26'),
(23, 'OUT1676508568', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-16 00:49:35'),
(24, 'OUT1676509341', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-16 01:02:31'),
(25, 'OUT1676509730', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-16 01:08:56'),
(26, 'OUT1676510736', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-16 01:25:44'),
(27, 'OUT1676512390', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-16 01:53:17'),
(28, 'OUT1676512426', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-16 01:53:52'),
(29, 'OUT1676512499', 'PRD0003', 'CTG0002', '1', '100', '0', '100', 1, '2023-02-16 01:55:09'),
(30, 'OUT1676527900', 'PRD0003', 'CTG0002', '1', '100', '90', '100', 1, '2023-02-16 06:11:57'),
(31, 'OUT1676665513', 'PRD0003', 'CTG0002', '1', '100', '90', '100', 1, '2023-02-17 20:25:31'),
(33, 'OUT1676665775', 'PRD0001', 'CTG0002', '1', '1680', '1500', '1680', 1, '2023-02-17 20:29:45'),
(34, 'OUT1676666073', 'PRD0003', 'CTG0002', '1', '100', '90', '100', 1, '2023-02-17 20:34:44'),
(35, 'OUT1676803197', 'PRD0003', 'CTG0002', '1', '100', '90', '100', 1, '2023-02-19 10:40:08'),
(36, 'OUT1676803383', 'PRD0003', 'CTG0002', '1', '100', '90', '100', 1, '2023-02-19 10:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `sales_retur`
--

CREATE TABLE `sales_retur` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sales_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_return` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_retur`
--

INSERT INTO `sales_retur` (`id`, `sales_id`, `total_price`, `total_item`, `is_return`, `date`) VALUES
('RETS1670086702', 'OUT1670085398', '500', '1', '1', '2022-12-03 16:58:44'),
('RETS1676665623', 'OUT1676665513', '100', '1', '1', '2023-02-20 09:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `sales_transaction`
--

CREATE TABLE `sales_transaction` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_cash` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` int(100) NOT NULL,
  `total_item` int(100) NOT NULL,
  `pay_deadline_date` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_transaction`
--

INSERT INTO `sales_transaction` (`id`, `customer_id`, `is_cash`, `total_price`, `total_item`, `pay_deadline_date`, `date`, `status`) VALUES
('OUT1672802271', 'CUST0001', '1', 1680, 1, '2023-01-04', '2023-01-04 04:02:09', ''),
('OUT1672802886', 'CUST0001', '0', 1680, 1, '2023-02-03', '2023-01-04 03:28:38', ''),
('OUT1676184470', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 06:48:00', ''),
('OUT1676185124', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 06:58:52', ''),
('OUT1676185243', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 07:00:53', ''),
('OUT1676185303', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 07:01:50', ''),
('OUT1676185346', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 07:02:34', ''),
('OUT1676185424', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 07:04:02', ''),
('OUT1676185803', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 07:10:11', ''),
('OUT1676190219', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 08:24:00', ''),
('OUT1676190689', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 08:31:36', ''),
('OUT1676191979', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 08:53:07', ''),
('OUT1676192136', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 08:55:48', ''),
('OUT1676192238', 'CUST0002', '1', 1680, 1, '2023-02-12', '2023-02-12 08:57:26', ''),
('OUT1676508568', 'CUST0002', '1', 1680, 1, '2023-02-16', '2023-02-16 00:49:35', ''),
('OUT1676509341', 'CUST0002', '1', 1680, 1, '2023-02-16', '2023-02-16 01:02:30', ''),
('OUT1676509730', 'CUST0002', '1', 1680, 1, '2023-02-16', '2023-02-16 01:08:56', ''),
('OUT1676510736', 'CUST0002', '1', 1680, 1, '2023-02-16', '2023-02-16 01:25:44', ''),
('OUT1676512390', 'CUST0002', '1', 1680, 1, '2023-02-16', '2023-02-16 01:53:17', ''),
('OUT1676512426', 'CUST0002', '1', 1680, 1, '2023-02-16', '2023-02-16 01:53:52', ''),
('OUT1676512499', 'CUST0002', '1', 100, 1, '2023-02-16', '2023-02-16 01:55:09', ''),
('OUT1676527900', 'CUST0002', '1', 100, 1, '2023-02-16', '2023-02-16 06:11:56', ''),
('OUT1676665513', 'CUST0002', '1', 100, 1, '2023-02-17', '2023-02-17 20:25:31', ''),
('OUT1676665775', 'CUST0002', '1', 1680, 1, '2023-02-17', '2023-02-17 20:29:45', ''),
('OUT1676666073', 'CUST0002', '1', 100, 1, '2023-02-17', '2023-02-17 20:34:43', ''),
('OUT1676803197', 'CUST0002', '1', 100, 1, '2023-02-19', '2023-02-19 10:40:08', ''),
('OUT1676803383', 'CUST0002', '1', 100, 1, '2023-02-19', '2023-02-19 10:43:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_address` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `company_name`, `supplier_name`, `email`, `supplier_phone`, `supplier_address`, `date`, `status`) VALUES
('SUP001', 'pogiako', 'test@gmail.com', 'test@gmail.com', '0912356789', '100 E. Rodriguez Avenue, C5 Road, Barangay Ugong, Pasig City', '2023-01-15 09:52:54', 'Deleted'),
('SUP002', 'asdasdasd', 'test@gmail.com', 'test@gmail.com', '0912356789', '100 E. Rodriguez Avenue, C5 Road, Barangay Ugong, Pasig City', '2023-01-15 10:05:54', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `recovery` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `address`, `birthday`, `contact`, `username`, `password`, `recovery`, `status`, `date`) VALUES
('user0001', 'james', 'admin@admin.com', 'smb', '2013-12-30', '0912345679', 'admin', 'asdasdasdasd', 'asd', 'Deleted', '0000-00-00 00:00:00'),
('user0002', 'asdasdas', 'admin@admin.com', 'smb', '2010-02-02', '09123456987', 'asdasdasd', '123123', 'asdasd', 'Deleted', '2023-02-17 15:28:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cancelsales`
--
ALTER TABLE `cancelsales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `purchase_data`
--
ALTER TABLE `purchase_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_retur`
--
ALTER TABLE `purchase_retur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `purchase_transaction`
--
ALTER TABLE `purchase_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `sales_data`
--
ALTER TABLE `sales_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_retur`
--
ALTER TABLE `sales_retur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `purchase_data`
--
ALTER TABLE `purchase_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sales_data`
--
ALTER TABLE `sales_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
