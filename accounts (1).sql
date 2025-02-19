-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2025 at 07:57 PM
-- Server version: 10.11.11-MariaDB
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baytaltarmim_hrms_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--


--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_number`, `branch_id`, `name`, `slug`, `account_type`, `is_credit`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(NULL, '95222331106001', 3, 'Inter Branch account Credit originating', 'inter_branch_account', 'office', '1', 'This is Account for Inter Branch account Credit originating', NULL, 'active', '2025-02-19 08:52:28', '2025-02-19 08:52:28'),
(NULL, '95242331106001', 4, 'Inter Branch account Credit originating', 'inter_branch_account', 'office', '1', 'This is Account for Inter Branch account Credit originating', NULL, 'active', '2025-02-19 08:52:32', '2025-02-19 08:52:35'),
(NULL, '95222331106001', 2, 'Inter Branch account Credit originating', 'inter_branch_account', 'office', '1', 'This is Account for Inter Branch account Credit originating', NULL, 'active', '2025-02-19 08:52:28', '2025-02-19 08:52:28'),
(NULL, '95212331106001', 1, 'Inter Branch account Credit originating', 'inter_branch_account', 'office', '1', 'This is Account for Inter Branch account Credit originating', NULL, 'active', '2025-02-19 08:52:24', '2025-02-19 08:52:24');

INSERT INTO `accounts` (`id`, `account_number`, `branch_id`, `name`, `slug`, `account_type`, `is_credit`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(NULL, '95242352451013', 4, 'TDS Staff', 'tds_staff', 'office', '0', 'This is Account for TDS TO STAFF', NULL, 'active', '2025-02-19 08:52:35', '2025-02-19 08:52:35'),
(NULL, '95232352451013', 3, 'TDS Staff', 'tds_staff', 'office', '0', 'This is Account for TDS TO STAFF', NULL, 'active', '2025-02-19 08:52:31', '2025-02-19 08:52:31'),
(NULL, '95222352451013', 2, 'TDS Staff', 'tds_staff', 'office', '0', 'This is Account for TDS TO STAFF', NULL, 'active', '2025-02-19 08:52:28', '2025-02-19 08:52:28'),
(NULL, '95212352451013', 1, 'TDS Staff', 'tds_staff', 'office', '0', 'This is Account for TDS TO STAFF', NULL, 'active', '2025-02-19 08:52:24', '2025-02-19 08:52:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
