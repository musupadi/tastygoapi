-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 09:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tastygo`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `label`, `unit`, `id_shop`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, '132', 'mg', 1, '2024-05-13 10:37:15', 0, '2024-05-13 11:09:24', 1),
(3, 'Tost', 'mg', 1, '2024-05-13 11:11:33', 0, '2024-05-13 11:11:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `balance` bigint(20) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `status`, `balance`, `id_shop`, `id_user`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 2333304, 1, 1, '2024-05-22 15:54:52', 1, '2024-05-22 15:54:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `id_user`, `id_shop`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, '2024-05-22 15:35:54', 1, '2024-05-22 15:35:54', 1),
(2, 1, 1, '2024-05-22 15:37:24', 1, '2024-05-22 15:37:24', 1),
(3, 1, 1, '2024-05-27 11:50:49', 1, '2024-05-27 11:50:49', 1),
(4, 1, 1, '2024-05-27 11:51:17', 1, '2024-05-27 11:51:17', 1),
(5, 1, 1, '2024-05-28 14:06:46', 1, '2024-05-28 14:06:46', 1),
(6, 1, 1, '2024-05-28 14:31:59', 1, '2024-05-28 14:31:59', 1),
(10, 1, 1, '2024-05-28 15:26:08', 1, '2024-05-28 15:26:08', 1),
(11, 1, 1, '2024-05-28 16:05:54', 1, '2024-05-28 16:05:54', 1),
(12, 1, 1, '2024-05-31 15:01:03', 1, '2024-05-31 15:01:03', 1),
(13, 1, 1, '2024-05-31 15:46:55', 1, '2024-05-31 15:46:55', 1),
(14, 1, 1, '2024-05-31 16:05:40', 1, '2024-05-31 16:05:40', 1),
(15, 1, 1, '2024-05-31 16:25:21', 1, '2024-05-31 16:25:21', 1),
(16, 1, 1, '2024-05-31 16:28:40', 1, '2024-05-31 16:28:40', 1),
(17, 1, 1, '2024-05-31 16:32:27', 1, '2024-05-31 16:32:27', 1),
(18, 1, 1, '2024-06-02 15:26:28', 1, '2024-06-02 15:26:28', 1),
(19, 1, 1, '2024-06-02 15:27:10', 1, '2024-06-02 15:27:10', 1),
(20, 1, 1, '2024-06-02 20:41:13', 1, '2024-06-02 20:41:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_finance`
--

CREATE TABLE `log_finance` (
  `id` int(11) NOT NULL,
  `balance` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_finance`
--

INSERT INTO `log_finance` (`id`, `balance`, `status`, `id_shop`, `id_invoice`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 10000, 0, 1, 0, '2024-05-28 14:31:59', 1, '2024-05-28 14:31:59', 1),
(2, 10000, 0, 1, 10, '2024-05-28 15:26:08', 1, '2024-05-28 15:26:08', 1),
(3, 10000, 0, 1, 11, '2024-05-28 16:05:54', 1, '2024-05-28 16:05:54', 1),
(4, 10000, 0, 1, 12, '2024-05-31 15:01:03', 1, '2024-05-31 15:01:03', 1),
(5, 10000, 0, 1, 13, '2024-05-31 15:46:55', 1, '2024-05-31 15:46:55', 1),
(6, 24624, 0, 1, 14, '2024-05-31 16:05:40', 1, '2024-05-31 16:05:40', 1),
(7, 24624, 0, 1, 15, '2024-05-31 16:25:21', 1, '2024-05-31 16:25:21', 1),
(8, 24624, 0, 1, 16, '2024-05-31 16:28:40', 1, '2024-05-31 16:28:40', 1),
(9, 2036936, 0, 1, 17, '2024-05-31 16:32:27', 1, '2024-05-31 16:32:27', 1),
(10, 49248, 0, 1, 18, '2024-06-02 15:26:28', 1, '2024-06-02 15:26:28', 1),
(11, 49248, 0, 1, 19, '2024-06-02 15:27:10', 1, '2024-06-02 15:27:10', 1),
(12, 44000, 0, 1, 20, '2024-06-02 20:41:13', 1, '2024-06-02 20:41:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `label` varchar(50) NOT NULL,
  `price` bigint(20) NOT NULL,
  `stock` bigint(11) NOT NULL,
  `description` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `img`, `label`, `price`, `stock`, `description`, `id_category`, `id_shop`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'black_coffee.jpg', 'Black Coffee', 10000, 10, 'test', 2, 1, '2024-05-13 16:18:26', 1, '2024-05-13 16:18:26', 1),
(2, 'latte.jpg', 'Coffee Latte', 12000, 12, '12321', 2, 1, '2024-05-13 16:22:22', 1, '2024-05-13 16:22:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `level`, `label`, `id_shop`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Admin', 0, '2024-04-29 09:59:07', 1, '2024-04-29 09:59:07', 1),
(2, 2, 'Owner', 0, '2024-04-29 10:42:33', 1, '2024-04-29 10:42:33', 1),
(3, 3, 'Marketing', 0, '2024-04-29 13:16:23', 1, '2024-04-29 13:16:23', 1),
(4, 4, 'PIC', 0, '2024-04-29 13:16:46', 1, '2024-04-29 13:16:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `label`, `status`, `description`, `logo`, `id_user`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Ascendant', 1, 'Aplikasi POS', '', 2, '2024-04-29 10:44:34', 1, '2024-04-29 10:44:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_product` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `id_invoice` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_product`, `quantity`, `note`, `id_invoice`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, '1', 1, '2024-05-22 15:35:54', 1, '2024-05-22 15:35:54', 1),
(1, 1, '1', 2, '2024-05-22 15:37:24', 1, '2024-05-22 15:37:24', 1),
(2, 5, '1', 2, '2024-05-22 15:37:24', 1, '2024-05-22 15:37:24', 1),
(1, 3, '1', 2, '2024-05-22 15:37:24', 1, '2024-05-22 15:37:24', 1),
(1, 1, '1', 3, '2024-05-27 11:50:49', 1, '2024-05-27 11:50:49', 1),
(2, 5, '1', 3, '2024-05-27 11:50:49', 1, '2024-05-27 11:50:49', 1),
(1, 3, '1', 3, '2024-05-27 11:50:49', 1, '2024-05-27 11:50:49', 1),
(1, 1, '1', 4, '2024-05-27 11:51:17', 1, '2024-05-27 11:51:17', 1),
(2, 5, '1', 4, '2024-05-27 11:51:17', 1, '2024-05-27 11:51:17', 1),
(1, 3, '1', 4, '2024-05-27 11:51:17', 1, '2024-05-27 11:51:17', 1),
(1, 1, '1', 5, '2024-05-28 14:06:46', 1, '2024-05-28 14:06:46', 1),
(2, 5, '1', 5, '2024-05-28 14:06:46', 1, '2024-05-28 14:06:46', 1),
(1, 3, '1', 5, '2024-05-28 14:06:46', 1, '2024-05-28 14:06:46', 1),
(1, 1, '1', 6, '2024-05-28 14:31:59', 1, '2024-05-28 14:31:59', 1),
(2, 5, '1', 6, '2024-05-28 14:31:59', 1, '2024-05-28 14:31:59', 1),
(1, 3, '1', 6, '2024-05-28 14:31:59', 1, '2024-05-28 14:31:59', 1),
(1, 1, '1', 10, '2024-05-28 15:26:08', 1, '2024-05-28 15:26:08', 1),
(2, 5, '1', 10, '2024-05-28 15:26:08', 1, '2024-05-28 15:26:08', 1),
(1, 3, '1', 10, '2024-05-28 15:26:08', 1, '2024-05-28 15:26:08', 1),
(1, 1, '1', 11, '2024-05-28 16:05:54', 1, '2024-05-28 16:05:54', 1),
(2, 5, '1', 11, '2024-05-28 16:05:54', 1, '2024-05-28 16:05:54', 1),
(1, 3, '1', 11, '2024-05-28 16:05:54', 1, '2024-05-28 16:05:54', 1),
(1, 1, '1', 12, '2024-05-31 15:01:03', 1, '2024-05-31 15:01:03', 1),
(2, 5, '1', 12, '2024-05-31 15:01:03', 1, '2024-05-31 15:01:03', 1),
(1, 3, '1', 12, '2024-05-31 15:01:03', 1, '2024-05-31 15:01:03', 1),
(1, 1, '1', 13, '2024-05-31 15:46:55', 1, '2024-05-31 15:46:55', 1),
(2, 5, '1', 13, '2024-05-31 15:46:55', 1, '2024-05-31 15:46:55', 1),
(1, 3, '1', 13, '2024-05-31 15:46:55', 1, '2024-05-31 15:46:55', 1),
(2, 2, '', 14, '2024-05-31 16:05:40', 1, '2024-05-31 16:05:40', 1),
(2, 1, '', 15, '2024-05-31 16:25:21', 1, '2024-05-31 16:25:21', 1),
(2, 2, '', 16, '2024-05-31 16:28:40', 1, '2024-05-31 16:28:40', 1),
(1, 1, '', 17, '2024-05-31 16:32:27', 1, '2024-05-31 16:32:27', 1),
(2, 3, '', 18, '2024-06-02 15:26:28', 1, '2024-06-02 15:26:28', 1),
(2, 3, '', 19, '2024-06-02 15:27:10', 1, '2024-06-02 15:27:10', 1),
(2, 1, '', 20, '2024-06-02 20:41:13', 1, '2024-06-02 20:41:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `id_role` int(1) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `jenis_kelamin`, `username`, `password`, `kontak`, `id_role`, `photo`, `id_shop`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Zyarga', 'zyargacode@gmail.com', 0, 'zyarga', '202cb962ac59075b964b07152d234b70', '081384215205', 1, 'default.png', 1, '2024-04-29 10:01:11', 1, '2024-04-29 10:01:11', 1),
(2, 'Hamid', 'hamid@gmail.com', 0, 'hamid', '202cb962ac59075b964b07152d234b70', '21312321', 2, 'default.png', 1, '2024-04-29 10:43:43', 1, '2024-04-29 10:43:43', 1),
(4, 'Ryeisa', 'ryeisa@gmail.com', 1, 'Ryeisa', '202cb962ac59075b964b07152d234b70', '21312321', 1, 'default.png', 1, '2024-10-09 09:06:07', 1, '2024-10-09 09:06:07', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_finance`
--
ALTER TABLE `log_finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `log_finance`
--
ALTER TABLE `log_finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
