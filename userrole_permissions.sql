-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 08:07 PM
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
-- Table structure for table `userrole_permissions`
--

CREATE TABLE `userrole_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userrole_permissions`
--

INSERT INTO `userrole_permissions` (`id`, `role_id`, `permission_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 6, 13, 1, 1, '2022-09-23 10:48:39', '2022-09-23 10:48:39', NULL),
(12, 1, 13, 1, 1, '2022-09-23 10:56:09', '2022-09-23 10:56:09', NULL),
(13, 1, 14, 1, 1, '2022-09-23 10:56:09', '2022-09-23 10:56:09', NULL),
(14, 1, 15, 1, 1, '2022-09-23 10:56:09', '2022-09-23 10:56:09', NULL),
(15, 1, 16, 1, 1, '2022-09-23 10:56:09', '2022-09-23 10:56:09', NULL),
(16, 1, 12, 1, 1, '2022-09-23 10:56:09', '2022-09-23 10:56:09', NULL),
(17, 1, 9, 1, 1, '2022-09-23 10:56:09', '2022-09-23 10:56:09', NULL),
(18, 2, 2, 1, 1, '2022-09-23 10:56:16', '2022-09-23 10:56:16', NULL),
(19, 2, 3, 1, 1, '2022-09-23 10:56:16', '2022-09-23 10:56:16', NULL),
(20, 3, 14, 1, 1, '2022-09-23 10:56:26', '2022-09-23 10:56:26', NULL),
(21, 3, 15, 1, 1, '2022-09-23 10:56:26', '2022-09-23 10:56:26', NULL),
(22, 4, 5, 1, 1, '2022-09-23 10:56:40', '2022-09-23 10:56:40', NULL),
(23, 4, 6, 1, 1, '2022-09-23 10:56:40', '2022-09-23 10:56:40', NULL),
(24, 4, 7, 1, 1, '2022-09-23 10:56:40', '2022-09-23 10:56:40', NULL),
(25, 4, 8, 1, 1, '2022-09-23 10:56:40', '2022-09-23 10:56:40', NULL),
(26, 9, 10, 1, 1, '2022-09-23 10:57:57', '2022-09-23 10:57:57', NULL),
(27, 9, 11, 1, 1, '2022-09-23 10:57:57', '2022-09-23 10:57:57', NULL),
(28, 9, 12, 1, 1, '2022-09-23 10:57:57', '2022-09-23 10:57:57', NULL),
(29, 9, 9, 1, 1, '2022-09-23 10:57:57', '2022-09-23 10:57:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userrole_permissions`
--
ALTER TABLE `userrole_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userrole_permissions`
--
ALTER TABLE `userrole_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
