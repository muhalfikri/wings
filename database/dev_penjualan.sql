-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2023 at 07:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `id` int(11) NOT NULL,
  `product_code` varchar(18) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `price` int(6) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `discount` int(6) NOT NULL DEFAULT 0,
  `dimension` varchar(50) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `deleted_at` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`id`, `product_code`, `product_name`, `price`, `currency`, `discount`, `dimension`, `unit`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SKUKILNP', 'So Klin Pewangi', 15000, 'IDR', 10, '13cm x 10cm', 'PCS', 0, '2023-01-30 15:26:58', '2023-01-30 15:26:58'),
(2, 'SKUKILNP2', 'Deterjen Bubuk', 15000, 'IDR', 10, '13cm x 10cm', 'PCS', 0, '2023-01-30 15:26:58', '2023-01-30 15:26:58'),
(3, 'SKUKILNP3', 'Sabun Giv', 5000, 'IDR', 0, '13cm x 10cm', 'PCS', 0, '2023-01-30 15:26:58', '2023-01-30 15:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaction_detail`
--

CREATE TABLE `tb_transaction_detail` (
  `id` int(11) NOT NULL,
  `document_code` varchar(3) NOT NULL,
  `document_number` varchar(10) NOT NULL,
  `product_code` varchar(18) NOT NULL,
  `price` int(6) NOT NULL,
  `quantity` int(6) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaction_detail`
--

INSERT INTO `tb_transaction_detail` (`id`, `document_code`, `document_number`, `product_code`, `price`, `quantity`, `unit`, `subtotal`, `currency`, `created_at`, `updated_at`) VALUES
(2, 'TRX', '01', 'SKUKILNP2', 13500, 3, 'PCS', 40500, 'IDR', '2023-01-30 17:12:53', '2023-01-30 17:57:30'),
(5, 'TRX', '01', 'SKUKILNP', 13500, 5, 'PCS', 67500, 'IDR', '2023-01-30 17:53:37', '2023-01-30 17:57:27'),
(6, 'TRX', '02', 'SKUKILNP', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:04:41', '2023-01-30 18:04:41'),
(7, 'TRX', '02', 'SKUKILNP2', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:04:42', '2023-01-30 18:04:42'),
(8, 'TRX', '02', 'SKUKILNP3', 5000, 1, 'PCS', 5000, 'IDR', '2023-01-30 18:04:44', '2023-01-30 18:04:44'),
(10, 'TRX', '03', 'SKUKILNP2', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:09:16', '2023-01-30 18:09:16'),
(11, 'TRX', '04', 'SKUKILNP', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:09:36', '2023-01-30 18:09:36'),
(12, 'TRX', '04', 'SKUKILNP2', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:09:39', '2023-01-30 18:09:39'),
(13, 'TRX', '04', 'SKUKILNP3', 5000, 2, 'PCS', 10000, 'IDR', '2023-01-30 18:09:40', '2023-01-30 18:09:40'),
(14, 'TRX', '05', 'SKUKILNP', 13500, 2, 'PCS', 27000, 'IDR', '2023-01-30 18:09:46', '2023-01-30 18:11:59'),
(15, 'TRX', '05', 'SKUKILNP3', 5000, 1, 'PCS', 5000, 'IDR', '2023-01-30 18:09:47', '2023-01-30 18:09:47'),
(16, 'TRX', '05', 'SKUKILNP2', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:12:02', '2023-01-30 18:12:02'),
(17, 'TRX', '06', 'SKUKILNP', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:12:21', '2023-01-30 18:12:21'),
(18, 'TRX', '06', 'SKUKILNP2', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:12:22', '2023-01-30 18:12:22'),
(19, 'TRX', '06', 'SKUKILNP3', 5000, 1, 'PCS', 5000, 'IDR', '2023-01-30 18:12:23', '2023-01-30 18:12:23'),
(20, 'TRX', '07', 'SKUKILNP', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:12:33', '2023-01-30 18:12:33'),
(21, 'TRX', '07', 'SKUKILNP2', 13500, 1, 'PCS', 13500, 'IDR', '2023-01-30 18:12:34', '2023-01-30 18:12:34'),
(22, 'TRX', '07', 'SKUKILNP3', 5000, 4, 'PCS', 20000, 'IDR', '2023-01-30 18:12:35', '2023-01-30 18:12:35'),
(24, 'TRX', '08', 'SKUKILNP2', 13500, 2, 'PCS', 27000, 'IDR', '2023-01-30 18:31:20', '2023-01-30 18:31:32'),
(25, 'TRX', '08', 'SKUKILNP3', 5000, 10, 'PCS', 50000, 'IDR', '2023-01-30 18:31:22', '2023-01-30 18:31:36'),
(26, 'TRX', '08', 'SKUKILNP', 13500, 5, 'PCS', 67500, 'IDR', '2023-01-30 18:31:54', '2023-01-30 18:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaction_header`
--

CREATE TABLE `tb_transaction_header` (
  `id` int(11) NOT NULL,
  `document_code` varchar(3) NOT NULL,
  `document_number` varchar(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `total` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 = Belum Selesai | 1 = Sudah Selesai',
  `deleted_at` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaction_header`
--

INSERT INTO `tb_transaction_header` (`id`, `document_code`, `document_number`, `user`, `total`, `date`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'TRX', '01', 'admin_demo', 108000, '2023-01-30', 1, 0, '2023-01-30 17:12:52', '2023-01-30 18:02:47'),
(2, 'TRX', '02', 'admin_demo', 32000, '2023-01-30', 1, 0, '2023-01-30 18:04:41', '2023-01-30 18:06:49'),
(3, 'TRX', '03', 'admin_demo', 40500, '2023-01-30', 1, 0, '2023-01-30 18:09:13', '2023-01-30 18:09:31'),
(4, 'TRX', '04', 'admin_demo', 37000, '2023-01-30', 1, 0, '2023-01-30 18:09:36', '2023-01-30 18:09:42'),
(5, 'TRX', '05', 'admin_demo', 45500, '2023-01-30', 1, 0, '2023-01-30 18:09:46', '2023-01-30 18:12:19'),
(6, 'TRX', '06', 'admin_demo', 32000, '2023-01-30', 1, 0, '2023-01-30 18:12:21', '2023-01-30 18:12:26'),
(7, 'TRX', '07', 'admin_demo', 47000, '2023-01-30', 1, 0, '2023-01-30 18:12:33', '2023-01-30 18:12:37'),
(8, 'TRX', '08', 'admin_demo', 144500, '2023-01-30', 1, 0, '2023-01-30 18:31:15', '2023-01-30 18:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deleted_at` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `user`, `password`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'admin_demo', 'becfa012770c6e5311710e59cdddebf0', 0, '2022-07-24 13:56:31', '2023-01-30 14:27:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaction_detail`
--
ALTER TABLE `tb_transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaction_header`
--
ALTER TABLE `tb_transaction_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_transaction_detail`
--
ALTER TABLE `tb_transaction_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_transaction_header`
--
ALTER TABLE `tb_transaction_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
