-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 08:06 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distributor_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `module_permissions`
--

CREATE TABLE `module_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_permissions`
--

INSERT INTO `module_permissions` (`id`, `name`, `module`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Registration.list', '1', '1', NULL, NULL, NULL, NULL, NULL),
(2, 'Registration.edit', '1', '1', NULL, NULL, NULL, NULL, NULL),
(3, 'Registration.update', '1', '1', NULL, NULL, NULL, NULL, NULL),
(4, 'Registration.delete', '1', '1', NULL, NULL, NULL, NULL, NULL),
(5, 'Distributor.list', '2', '1', NULL, NULL, NULL, NULL, NULL),
(6, 'Distributor.create', '2', '1', NULL, NULL, NULL, NULL, NULL),
(7, 'Distributor.update', '2', '1', NULL, NULL, NULL, NULL, NULL),
(8, 'Distributor.delete', '2', '1', NULL, NULL, NULL, NULL, NULL),
(9, 'Dealer.list', '3', '1', NULL, NULL, NULL, NULL, NULL),
(10, 'Dealer.create', '3', '1', NULL, NULL, NULL, NULL, NULL),
(11, 'Dealer.edit', '3', '1', NULL, NULL, NULL, NULL, NULL),
(12, 'Dealer.delete', '3', '1', NULL, NULL, NULL, NULL, NULL),
(13, 'Customer.list', '4', '1', NULL, NULL, NULL, NULL, NULL),
(14, 'Customer.create', '4', '1', NULL, NULL, NULL, NULL, NULL),
(15, 'Customer.edit', '4', '1', NULL, NULL, NULL, NULL, NULL),
(16, 'Customer.delete', '4', '1', NULL, NULL, NULL, NULL, NULL),
(17, 'Order.list', '5', '1', NULL, NULL, NULL, NULL, NULL),
(18, 'Order.create', '5', '1', NULL, NULL, NULL, NULL, NULL),
(19, 'Order.edit', '5', '1', NULL, NULL, NULL, NULL, NULL),
(20, 'Order.delete', '5', '1', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `module_permissions`
--
ALTER TABLE `module_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
