-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 09:13 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ck_recruitment_management_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `menu_name`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'M001', 'Dashboard', 'active', '', NULL, NULL),
(2, 'M002', 'Pre Onboarding', 'active', '', NULL, NULL),
(3, 'M003', 'Employee List', 'active', '', NULL, NULL),
(4, 'M004', 'Profile', 'active', '', NULL, NULL),
(5, 'M005', 'Goals', 'active', '', NULL, NULL),
(6, 'M006', 'Buddy Info', 'active', '', NULL, NULL),
(7, 'M007', 'Masters', 'active', '', NULL, NULL),
(8, 'M008', 'Holidays', 'active', '', NULL, NULL),
(9, 'M009', 'Events', 'active', '', NULL, NULL),
(10, 'M010', 'Settings', 'active', '', NULL, NULL),
(11, 'M011', 'Seating Request', 'active', '', NULL, NULL),
(12, 'M012', 'EmailId Creation', 'active', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
