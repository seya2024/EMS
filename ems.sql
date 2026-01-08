-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2026 at 04:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_reports`
--

CREATE TABLE `activity_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `deliverable_id` bigint(20) UNSIGNED NOT NULL,
  `task_giver_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_classes`
--

CREATE TABLE `asset_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_classes`
--

INSERT INTO `asset_classes` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Furniture & Office Materials', 'Office materials', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(2, 'Generator', 'Generator', '2026-01-08 07:51:47', '2026-01-08 07:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `asset_disposals`
--

CREATE TABLE `asset_disposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_type` varchar(255) DEFAULT NULL,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `disposed_by` bigint(20) UNSIGNED NOT NULL,
  `disposed_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT 'disposed',
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_maintenances`
--

CREATE TABLE `asset_maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assetable_type` varchar(255) NOT NULL,
  `assetable_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `ou_id` bigint(20) UNSIGNED NOT NULL,
  `problem` text DEFAULT NULL,
  `sent_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('SENT','RECEIVED','IN_PROGRESS','CLOSED') DEFAULT NULL,
  `approval_status` enum('PENDING','ACCEPTED','REJECTED') DEFAULT 'PENDING',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_transfers`
--

CREATE TABLE `asset_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assetable_type` varchar(255) NOT NULL,
  `assetable_id` bigint(20) UNSIGNED NOT NULL,
  `from_branch_id` bigint(20) UNSIGNED NOT NULL,
  `to_branch_id` bigint(20) UNSIGNED NOT NULL,
  `action` enum('handover','takeover','transfer','disposal') NOT NULL,
  `performed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `performed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_t_m_reports`
--

CREATE TABLE `a_t_m_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custodian` bigint(20) UNSIGNED NOT NULL,
  `atm_id` bigint(20) UNSIGNED NOT NULL,
  `downtime_reason_id` bigint(20) UNSIGNED NOT NULL,
  `action_taken` varchar(255) DEFAULT NULL,
  `down_time_in_days` decimal(5,2) DEFAULT NULL,
  `open_date` date DEFAULT NULL,
  `call_ID` varchar(255) DEFAULT NULL,
  `TT` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `closed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `close_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_t_m_s`
--

CREATE TABLE `a_t_m_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terminal` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `design` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `code`, `name`, `grade`, `tag`, `district_id`, `created_at`, `updated_at`) VALUES
(1, '21', 'Jimma Branch', 'II', 'JM', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(2, '22', 'Agaro Branch', 'I', 'AGR', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(3, '23', 'Limmugenet Branch', 'I', 'LMG', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(4, 'YB', 'Yebu Branch', 'I', 'YB', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(5, 'BL', 'Bilida Outlet', 'I', 'BL', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(6, 'AL', 'Al-nur IFB', 'I', 'AL', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(7, 'CH', 'Gecha Branch', 'I', 'CH', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(8, 'BD', 'Bedele Branch', 'I', 'BD', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(9, 'FR', 'Furisa Abawoga', 'I', 'FR', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(10, 'CHR', 'Chora Outlet', 'I', 'CHR', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(11, 'YY', 'Yayo Branch', 'I', 'YY', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(12, 'MT', 'Mettu Branch', 'I', 'MT', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(13, 'GH', 'Gecha Branch', 'I', 'GH', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(14, 'MSH', 'Masha Branch', 'I', 'MSH', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(15, 'MTI', 'Meti Branch', 'I', 'MTI', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(16, 'YR', 'Yeri Outlet', 'I', 'YR', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(17, 'SHE', 'Shebe Branch', 'I', 'SHE', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(18, 'CHD', 'Chida Branch', 'I', 'CHD', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(19, 'DNB', 'Deneba Branch', 'I', 'DNB', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(20, 'SJ', 'Saja Branch', 'I', 'SJ', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(21, 'SK', 'Sokoru Outlet', 'I', 'SK', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(22, 'TLY', 'Tollay Branch', 'I', 'TLY', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(23, 'SLA', 'SilkAmba Branch', 'I', 'SLA', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(24, 'ALF', 'Alif Branch', 'I', 'ALF', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(25, 'ALFS', 'Alif Outlet', 'I', 'ALFS', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(26, 'HIR', 'Hirmata Branch', 'I', 'HIR', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(27, 'MNR', 'Meneharia Branch', 'I', 'MNR', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(28, 'IQR', 'IFB - Iqra Branch', 'I', 'IQR', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(29, 'ABJ', 'Abajifar Branch', 'I', 'ABJ', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(30, 'ABJS', 'Abajifar Outlet', 'I', 'ABJS', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(31, 'FRJ', 'Ferenji Arada Branch', 'I', 'FRJ', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(32, 'JDO', 'Jimma District Office', 'I', 'JDO', 1, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(33, 'WDO', 'Wolaita District Office', 'I', 'WDO', 14, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(34, 'NDO', 'Nekemete District Office', 'I', 'NDO', 3, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(35, 'ADO', 'Adama District Office', 'I', 'ADO', 5, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(36, 'SWDO', 'South West District Office', 'I', 'SWDO', 2, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(37, 'HDO', 'Hawasa District Office', 'I', 'HDO', 4, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(38, 'DDDO', 'Dire Dawa District Office', 'I', 'DDDO', 6, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(39, 'DDO', 'Dessie District Office', 'I', 'DDO', 8, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(40, 'MDO', 'Mekele District Office', 'I', 'MDO', 7, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(41, 'BDO', 'Bahir Dar District Office', 'I', 'BDO', 9, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(42, 'SADO', 'South Addis District Office', 'I', 'SADO', 13, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(43, 'NADO', 'North Addis District Office', 'I', 'NADO', 10, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(44, 'EADO', 'East Addis District Office', 'I', 'EADO', 11, '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(45, 'WADO', 'West Addis District Office', 'I', 'WADO', 12, '2026-01-08 07:51:45', '2026-01-08 07:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext DEFAULT NULL,
  `expiration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `computers`
--

CREATE TABLE `computers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hardware_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `computer_model_id` bigint(20) UNSIGNED NOT NULL,
  `tagNo` varchar(255) DEFAULT NULL,
  `serialNo` varchar(255) DEFAULT NULL,
  `harddiskSize` varchar(255) DEFAULT NULL,
  `ramSize` varchar(255) DEFAULT NULL,
  `speed` varchar(255) DEFAULT NULL,
  `isActiveAntivirus` varchar(255) DEFAULT 'Active agent',
  `os` varchar(255) DEFAULT NULL,
  `isActivated` tinyint(1) DEFAULT 0,
  `IpAddress` varchar(255) DEFAULT NULL,
  `hostName` varchar(255) DEFAULT NULL,
  `status` enum('Active','Working','Not Working','Functional') DEFAULT 'Active',
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `computer_models`
--

CREATE TABLE `computer_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `hardware_type_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `computer_models`
--

INSERT INTO `computer_models` (`id`, `name`, `hardware_type_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Dell OptiPlex 380', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(2, 'Dell OptiPlex 390', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(3, 'Dell OptiPlex 7010', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(4, 'Dell OptiPlex 7020', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(5, 'Dell OptiPlex 3020', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(6, 'Dell OptiPlex 3040', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(7, 'Dell OptiPlex 5040', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(8, 'Dell OptiPlex 5050', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(9, 'Dell OptiPlex 3060', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(10, 'Dell OptiPlex 3070', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(11, 'Dell OptiPlex 3080', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(12, 'Dell OptiPlex 3000 Micro', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(13, 'Dell OptiPlex 3000 SFF', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(14, 'Dell OptiPlex 3000 Tower', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(15, 'Dell OptiPlex 3000 AIO', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(16, 'HP Compaq dc5800', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(17, 'HP Compaq dc7900', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(18, 'HP Compaq 6000 Pro', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(19, 'HP Compaq 6200 Pro', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(20, 'HP Compaq 6300 Pro', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(21, 'HP ProDesk 400 G1', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(22, 'HP ProDesk 400 G2', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(23, 'HP ProDesk 400 G3', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(24, 'HP ProDesk 400 G5', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(25, 'HP ProDesk 600 G1', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(26, 'HP ProDesk 600 G3', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(27, 'HP EliteDesk 800 G1', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(28, 'HP EliteDesk 800 G2', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(29, 'HP EliteDesk 800 G3', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(30, 'HP EliteDesk 800 G5', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(31, 'HP ProOne 400 G3', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(32, 'HP ProOne 400 G4', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(33, 'Lenovo ThinkCentre M58', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(34, 'Lenovo ThinkCentre M700', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(35, 'Lenovo ThinkCentre M710', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(36, 'Lenovo ThinkCentre M720', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(37, 'Lenovo ThinkCentre M900', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(38, 'Lenovo ThinkCentre M910', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(39, 'Lenovo ThinkCentre M920', 1, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(40, 'Dell Latitude E6410', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(41, 'Dell Latitude E6430', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(42, 'Dell Latitude 5480', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(43, 'Dell Latitude 5490', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(44, 'Dell Latitude 5500', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(45, 'Dell Latitude 5520', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(46, 'HP EliteBook 8460p', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(47, 'HP EliteBook 840 G3', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(48, 'HP EliteBook 840 G5', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(49, 'HP ProBook 450 G6', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(50, 'Lenovo ThinkPad T430', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(51, 'Lenovo ThinkPad T480', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(52, 'Lenovo ThinkPad T490', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(53, 'Lenovo ThinkPad X260', 2, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(54, 'Dell PowerEdge T30', 3, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(55, 'Dell PowerEdge R740', 3, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(56, 'HP ProLiant ML350 Gen9', 3, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(57, 'HP ProLiant DL380 Gen10', 3, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(58, 'Lenovo ThinkSystem SR650', 3, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `data_v_p_n_s`
--

CREATE TABLE `data_v_p_n_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serviceNo` varchar(255) DEFAULT NULL,
  `lANIp` varchar(255) DEFAULT NULL,
  `wanIp` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `bandwidth` varchar(255) DEFAULT NULL,
  `linkType` varchar(255) DEFAULT NULL,
  `vlan` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliverables`
--

CREATE TABLE `deliverables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `outcome` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Jimma', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(2, 'South West', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(3, 'Nekemete', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(4, 'Hawasa', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(5, 'Adama', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(6, 'Dire Dawa', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(7, 'Mekele', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(8, 'Dessie', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(9, 'Bahir Dar', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(10, 'North Addis', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(11, 'East Addis', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(12, 'West Addis', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(13, 'South Addis', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(14, 'Wolaita', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(15, 'Head Office', '2026-01-08 07:51:45', '2026-01-08 07:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `dongles`
--

CREATE TABLE `dongles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `imei` varchar(255) DEFAULT NULL,
  `iccid` varchar(255) DEFAULT NULL,
  `service_no` varchar(255) DEFAULT NULL,
  `network_type` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downtime_reasons`
--

CREATE TABLE `downtime_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `responsible` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `downtime_reasons`
--

INSERT INTO `downtime_reasons` (`id`, `name`, `responsible`, `created_at`, `updated_at`) VALUES
(1, 'No Power', 'Electric-Utility', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(2, 'No Network', 'Ethiotelecom', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(3, 'Dispenser', 'Vendor', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(4, 'Card Reader', 'Vendor', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(5, 'EPP', 'Vendor', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(6, 'No cash', 'The-branch', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(7, 'Note Jam', 'The-branch', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(8, 'Cassette Error', 'Vendor', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(9, 'Relocation', 'Digital-channel', '2026-01-08 07:51:47', '2026-01-08 07:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `d_o_b_s`
--

CREATE TABLE `d_o_b_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `service_no` varchar(255) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `iccid` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `network_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exports`
--

CREATE TABLE `exports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `exporter` varchar(255) DEFAULT NULL,
  `total_rows` int(11) DEFAULT NULL,
  `processed_rows` int(11) NOT NULL DEFAULT 0,
  `successful_rows` int(11) NOT NULL DEFAULT 0,
  `file_disk` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_import_rows`
--

CREATE TABLE `failed_import_rows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `import_id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `validation_error` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_lines`
--

CREATE TABLE `fixed_lines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serviceNo` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

CREATE TABLE `group_permission` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hardware_types`
--

CREATE TABLE `hardware_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hardware_types`
--

INSERT INTO `hardware_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Desktop', 'Portable computers', '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(2, 'Laptop', 'Stationary computers', '2026-01-08 07:51:46', '2026-01-08 07:51:46'),
(3, 'Server', 'Enterprise-grade servers', '2026-01-08 07:51:46', '2026-01-08 07:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `h_q_s`
--

CREATE TABLE `h_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `h_q_s`
--

INSERT INTO `h_q_s` (`id`, `name`, `slogan`, `created_at`, `updated_at`) VALUES
(1, 'Head Office', 'One step a head', '2026-01-08 07:51:46', '2026-01-08 07:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `importer` varchar(255) DEFAULT NULL,
  `total_rows` int(10) UNSIGNED DEFAULT NULL,
  `processed_rows` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `successful_rows` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `failed_rows` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_districts_table', 1),
(2, '0001_01_01_000001_create_branches_table', 1),
(3, '0001_01_01_000002_create_users_table', 1),
(4, '0001_01_01_000003_create_cache_table', 1),
(5, '0001_01_01_000004_create_jobs_table', 1),
(6, '0001_01_01_00000_create_user_groups_table', 1),
(7, '2025_12_23_090310_create_outlets_table', 1),
(8, '2025_12_23_104042_add_branch_id_to_outlets_table', 1),
(9, '2025_12_23_104043_create_hardware_types_table', 1),
(10, '2025_12_23_205754_create_computer_models_table', 1),
(11, '2025_12_23_205755_create_computers_table', 1),
(12, '2025_12_24_055648_create_h_q_s_table', 1),
(13, '2025_12_24_124251_create_d_o_b_s_table', 1),
(14, '2025_12_24_124251_create_pos_table', 1),
(15, '2025_12_24_124252_create_dongles_table', 1),
(16, '2025_12_24_124253_create_photocopies_table', 1),
(17, '2025_12_24_124254_create_scanners_table', 1),
(18, '2025_12_24_124259_create_printers_table', 1),
(19, '2025_12_25_115442_create_a_t_m_s_table', 1),
(20, '2025_12_25_115525_create_data_v_p_n_s_table', 1),
(21, '2025_12_25_115548_create_fixed_lines_table', 1),
(22, '2025_12_25_150404 _create_downtime_reasons_table', 1),
(23, '2025_12_25_170941_create_a_t_m_reports_table', 1),
(24, '2025_12_26_201856_create_o_u_s_table', 1),
(25, '2025_12_26_213308_create_exports_table', 1),
(26, '2025_12_29_151133_create_task_categories_table', 1),
(27, '2025_12_29_151134_create_tasks_table', 1),
(28, '2025_12_29_151135_create_deliverables_table', 1),
(29, '2025_12_29_151136_create_activity_reports_table', 1),
(30, '2025_12_29_192506_create_permission_tables', 1),
(31, '2025_12_31_134004_create_imports_table', 1),
(32, '2025_12_31_134325_create_failed_import_rows_table', 1),
(33, '2025_12_31_134555_make_validation_error_nullable_in_failed_import_rows', 1),
(34, '2026_01_01_105724_create_asset_classes_table', 1),
(35, '2026_01_01_105728_create_other_assets_table', 1),
(36, '2026_01_02_110526_create_permissions_table', 1),
(37, '2026_01_02_110556_create_group_permission_table', 1),
(38, '2026_01_02_124446_create_user_user_group_table', 1),
(39, '2026_01_05_143637_create_quarters_table', 1),
(40, '2026_01_06_120509_create_asset_disposals_table', 1),
(41, '2026_01_06_121822_create_asset_transfers_table', 1),
(42, '2026_01_06_130705_create_activity_log_table', 1),
(43, '2026_01_06_130706_add_event_column_to_activity_log_table', 1),
(44, '2026_01_06_130707_add_batch_uuid_column_to_activity_log_table', 1),
(45, '2026_01_06_185810_create_asset_maintenances_table', 1),
(46, '2026_01_07_114628_add_approval_status_to_asset_maintenances_table', 1),
(47, '2026_01_08_124554_create_messages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_assets`
--

CREATE TABLE `other_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_class_id` bigint(20) UNSIGNED NOT NULL,
  `asset_number` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cost_center` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `asset_cost` decimal(15,2) DEFAULT 0.00,
  `depreciation_current_year` decimal(15,2) DEFAULT 0.00,
  `assigned_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `name`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 'Bilida Branch', 1, '2025-12-23 14:30:38', '2025-12-23 14:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `o_u_s`
--

CREATE TABLE `o_u_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `o_u_s`
--

INSERT INTO `o_u_s` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'District', 'District Office', '2025-12-09 16:39:53', '2025-12-23 16:40:00'),
(2, 'Branch', 'Branch', '2025-12-09 16:39:53', '2025-12-23 16:40:00'),
(3, 'Head Office', 'Corpoarte', '2025-12-09 16:39:53', '2025-12-23 16:40:00'),
(4, 'IT Operations', 'IT Operations', '2025-12-09 16:39:53', '2025-12-23 16:40:00'),
(5, 'ATM Vendor', 'ATM Vendor', '2025-12-09 16:39:53', '2025-12-23 16:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `model`, `action`, `created_at`, `updated_at`) VALUES
(1, 'activity_reports.viewany', 'activity_reports', 'viewAny', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(2, 'activity_reports.view', 'activity_reports', 'view', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(3, 'activity_reports.create', 'activity_reports', 'create', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(4, 'activity_reports.update', 'activity_reports', 'update', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(5, 'activity_reports.delete', 'activity_reports', 'delete', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(6, 'activity_reports.restore', 'activity_reports', 'restore', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(7, 'activity_reports.forcedelete', 'activity_reports', 'forceDelete', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(8, 'activity_reports.export', 'activity_reports', 'export', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(9, 'activity_reports.import', 'activity_reports', 'import', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(10, 'activity_reports.approve', 'activity_reports', 'approve', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(11, 'activity_reports.reject', 'activity_reports', 'reject', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(12, 'activity_reports.archive', 'activity_reports', 'archive', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(13, 'activity_reports.unarchive', 'activity_reports', 'unarchive', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(14, 'activity_reports.publish', 'activity_reports', 'publish', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(15, 'activity_reports.unpublish', 'activity_reports', 'unpublish', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(16, 'activity_reports.assign', 'activity_reports', 'assign', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(17, 'asset_classes.viewany', 'asset_classes', 'viewAny', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(18, 'asset_classes.view', 'asset_classes', 'view', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(19, 'asset_classes.create', 'asset_classes', 'create', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(20, 'asset_classes.update', 'asset_classes', 'update', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(21, 'asset_classes.delete', 'asset_classes', 'delete', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(22, 'asset_classes.restore', 'asset_classes', 'restore', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(23, 'asset_classes.forcedelete', 'asset_classes', 'forceDelete', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(24, 'asset_classes.export', 'asset_classes', 'export', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(25, 'asset_classes.import', 'asset_classes', 'import', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(26, 'asset_classes.approve', 'asset_classes', 'approve', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(27, 'asset_classes.reject', 'asset_classes', 'reject', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(28, 'asset_classes.archive', 'asset_classes', 'archive', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(29, 'asset_classes.unarchive', 'asset_classes', 'unarchive', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(30, 'asset_classes.publish', 'asset_classes', 'publish', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(31, 'asset_classes.unpublish', 'asset_classes', 'unpublish', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(32, 'asset_classes.assign', 'asset_classes', 'assign', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(33, 'a_t_m_reports.viewany', 'a_t_m_reports', 'viewAny', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(34, 'a_t_m_reports.view', 'a_t_m_reports', 'view', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(35, 'a_t_m_reports.create', 'a_t_m_reports', 'create', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(36, 'a_t_m_reports.update', 'a_t_m_reports', 'update', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(37, 'a_t_m_reports.delete', 'a_t_m_reports', 'delete', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(38, 'a_t_m_reports.restore', 'a_t_m_reports', 'restore', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(39, 'a_t_m_reports.forcedelete', 'a_t_m_reports', 'forceDelete', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(40, 'a_t_m_reports.export', 'a_t_m_reports', 'export', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(41, 'a_t_m_reports.import', 'a_t_m_reports', 'import', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(42, 'a_t_m_reports.approve', 'a_t_m_reports', 'approve', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(43, 'a_t_m_reports.reject', 'a_t_m_reports', 'reject', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(44, 'a_t_m_reports.archive', 'a_t_m_reports', 'archive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(45, 'a_t_m_reports.unarchive', 'a_t_m_reports', 'unarchive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(46, 'a_t_m_reports.publish', 'a_t_m_reports', 'publish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(47, 'a_t_m_reports.unpublish', 'a_t_m_reports', 'unpublish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(48, 'a_t_m_reports.assign', 'a_t_m_reports', 'assign', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(49, 'a_t_m_s.viewany', 'a_t_m_s', 'viewAny', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(50, 'a_t_m_s.view', 'a_t_m_s', 'view', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(51, 'a_t_m_s.create', 'a_t_m_s', 'create', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(52, 'a_t_m_s.update', 'a_t_m_s', 'update', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(53, 'a_t_m_s.delete', 'a_t_m_s', 'delete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(54, 'a_t_m_s.restore', 'a_t_m_s', 'restore', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(55, 'a_t_m_s.forcedelete', 'a_t_m_s', 'forceDelete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(56, 'a_t_m_s.export', 'a_t_m_s', 'export', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(57, 'a_t_m_s.import', 'a_t_m_s', 'import', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(58, 'a_t_m_s.approve', 'a_t_m_s', 'approve', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(59, 'a_t_m_s.reject', 'a_t_m_s', 'reject', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(60, 'a_t_m_s.archive', 'a_t_m_s', 'archive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(61, 'a_t_m_s.unarchive', 'a_t_m_s', 'unarchive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(62, 'a_t_m_s.publish', 'a_t_m_s', 'publish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(63, 'a_t_m_s.unpublish', 'a_t_m_s', 'unpublish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(64, 'a_t_m_s.assign', 'a_t_m_s', 'assign', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(65, 'branches.viewany', 'branches', 'viewAny', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(66, 'branches.view', 'branches', 'view', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(67, 'branches.create', 'branches', 'create', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(68, 'branches.update', 'branches', 'update', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(69, 'branches.delete', 'branches', 'delete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(70, 'branches.restore', 'branches', 'restore', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(71, 'branches.forcedelete', 'branches', 'forceDelete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(72, 'branches.export', 'branches', 'export', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(73, 'branches.import', 'branches', 'import', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(74, 'branches.approve', 'branches', 'approve', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(75, 'branches.reject', 'branches', 'reject', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(76, 'branches.archive', 'branches', 'archive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(77, 'branches.unarchive', 'branches', 'unarchive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(78, 'branches.publish', 'branches', 'publish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(79, 'branches.unpublish', 'branches', 'unpublish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(80, 'branches.assign', 'branches', 'assign', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(81, 'cache.viewany', 'cache', 'viewAny', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(82, 'cache.view', 'cache', 'view', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(83, 'cache.create', 'cache', 'create', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(84, 'cache.update', 'cache', 'update', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(85, 'cache.delete', 'cache', 'delete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(86, 'cache.restore', 'cache', 'restore', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(87, 'cache.forcedelete', 'cache', 'forceDelete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(88, 'cache.export', 'cache', 'export', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(89, 'cache.import', 'cache', 'import', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(90, 'cache.approve', 'cache', 'approve', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(91, 'cache.reject', 'cache', 'reject', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(92, 'cache.archive', 'cache', 'archive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(93, 'cache.unarchive', 'cache', 'unarchive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(94, 'cache.publish', 'cache', 'publish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(95, 'cache.unpublish', 'cache', 'unpublish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(96, 'cache.assign', 'cache', 'assign', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(97, 'cache_locks.viewany', 'cache_locks', 'viewAny', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(98, 'cache_locks.view', 'cache_locks', 'view', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(99, 'cache_locks.create', 'cache_locks', 'create', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(100, 'cache_locks.update', 'cache_locks', 'update', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(101, 'cache_locks.delete', 'cache_locks', 'delete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(102, 'cache_locks.restore', 'cache_locks', 'restore', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(103, 'cache_locks.forcedelete', 'cache_locks', 'forceDelete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(104, 'cache_locks.export', 'cache_locks', 'export', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(105, 'cache_locks.import', 'cache_locks', 'import', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(106, 'cache_locks.approve', 'cache_locks', 'approve', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(107, 'cache_locks.reject', 'cache_locks', 'reject', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(108, 'cache_locks.archive', 'cache_locks', 'archive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(109, 'cache_locks.unarchive', 'cache_locks', 'unarchive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(110, 'cache_locks.publish', 'cache_locks', 'publish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(111, 'cache_locks.unpublish', 'cache_locks', 'unpublish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(112, 'cache_locks.assign', 'cache_locks', 'assign', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(113, 'computers.viewany', 'computers', 'viewAny', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(114, 'computers.view', 'computers', 'view', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(115, 'computers.create', 'computers', 'create', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(116, 'computers.update', 'computers', 'update', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(117, 'computers.delete', 'computers', 'delete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(118, 'computers.restore', 'computers', 'restore', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(119, 'computers.forcedelete', 'computers', 'forceDelete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(120, 'computers.export', 'computers', 'export', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(121, 'computers.import', 'computers', 'import', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(122, 'computers.approve', 'computers', 'approve', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(123, 'computers.reject', 'computers', 'reject', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(124, 'computers.archive', 'computers', 'archive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(125, 'computers.unarchive', 'computers', 'unarchive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(126, 'computers.publish', 'computers', 'publish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(127, 'computers.unpublish', 'computers', 'unpublish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(128, 'computers.assign', 'computers', 'assign', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(129, 'computer_models.viewany', 'computer_models', 'viewAny', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(130, 'computer_models.view', 'computer_models', 'view', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(131, 'computer_models.create', 'computer_models', 'create', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(132, 'computer_models.update', 'computer_models', 'update', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(133, 'computer_models.delete', 'computer_models', 'delete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(134, 'computer_models.restore', 'computer_models', 'restore', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(135, 'computer_models.forcedelete', 'computer_models', 'forceDelete', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(136, 'computer_models.export', 'computer_models', 'export', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(137, 'computer_models.import', 'computer_models', 'import', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(138, 'computer_models.approve', 'computer_models', 'approve', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(139, 'computer_models.reject', 'computer_models', 'reject', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(140, 'computer_models.archive', 'computer_models', 'archive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(141, 'computer_models.unarchive', 'computer_models', 'unarchive', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(142, 'computer_models.publish', 'computer_models', 'publish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(143, 'computer_models.unpublish', 'computer_models', 'unpublish', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(144, 'computer_models.assign', 'computer_models', 'assign', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(145, 'data_v_p_n_s.viewany', 'data_v_p_n_s', 'viewAny', '2026-01-08 07:51:48', '2026-01-08 07:51:48'),
(146, 'data_v_p_n_s.view', 'data_v_p_n_s', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(147, 'data_v_p_n_s.create', 'data_v_p_n_s', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(148, 'data_v_p_n_s.update', 'data_v_p_n_s', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(149, 'data_v_p_n_s.delete', 'data_v_p_n_s', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(150, 'data_v_p_n_s.restore', 'data_v_p_n_s', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(151, 'data_v_p_n_s.forcedelete', 'data_v_p_n_s', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(152, 'data_v_p_n_s.export', 'data_v_p_n_s', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(153, 'data_v_p_n_s.import', 'data_v_p_n_s', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(154, 'data_v_p_n_s.approve', 'data_v_p_n_s', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(155, 'data_v_p_n_s.reject', 'data_v_p_n_s', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(156, 'data_v_p_n_s.archive', 'data_v_p_n_s', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(157, 'data_v_p_n_s.unarchive', 'data_v_p_n_s', 'unarchive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(158, 'data_v_p_n_s.publish', 'data_v_p_n_s', 'publish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(159, 'data_v_p_n_s.unpublish', 'data_v_p_n_s', 'unpublish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(160, 'data_v_p_n_s.assign', 'data_v_p_n_s', 'assign', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(161, 'deliverables.viewany', 'deliverables', 'viewAny', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(162, 'deliverables.view', 'deliverables', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(163, 'deliverables.create', 'deliverables', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(164, 'deliverables.update', 'deliverables', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(165, 'deliverables.delete', 'deliverables', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(166, 'deliverables.restore', 'deliverables', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(167, 'deliverables.forcedelete', 'deliverables', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(168, 'deliverables.export', 'deliverables', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(169, 'deliverables.import', 'deliverables', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(170, 'deliverables.approve', 'deliverables', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(171, 'deliverables.reject', 'deliverables', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(172, 'deliverables.archive', 'deliverables', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(173, 'deliverables.unarchive', 'deliverables', 'unarchive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(174, 'deliverables.publish', 'deliverables', 'publish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(175, 'deliverables.unpublish', 'deliverables', 'unpublish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(176, 'deliverables.assign', 'deliverables', 'assign', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(177, 'districts.viewany', 'districts', 'viewAny', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(178, 'districts.view', 'districts', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(179, 'districts.create', 'districts', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(180, 'districts.update', 'districts', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(181, 'districts.delete', 'districts', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(182, 'districts.restore', 'districts', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(183, 'districts.forcedelete', 'districts', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(184, 'districts.export', 'districts', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(185, 'districts.import', 'districts', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(186, 'districts.approve', 'districts', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(187, 'districts.reject', 'districts', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(188, 'districts.archive', 'districts', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(189, 'districts.unarchive', 'districts', 'unarchive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(190, 'districts.publish', 'districts', 'publish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(191, 'districts.unpublish', 'districts', 'unpublish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(192, 'districts.assign', 'districts', 'assign', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(193, 'dongles.viewany', 'dongles', 'viewAny', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(194, 'dongles.view', 'dongles', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(195, 'dongles.create', 'dongles', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(196, 'dongles.update', 'dongles', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(197, 'dongles.delete', 'dongles', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(198, 'dongles.restore', 'dongles', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(199, 'dongles.forcedelete', 'dongles', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(200, 'dongles.export', 'dongles', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(201, 'dongles.import', 'dongles', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(202, 'dongles.approve', 'dongles', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(203, 'dongles.reject', 'dongles', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(204, 'dongles.archive', 'dongles', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(205, 'dongles.unarchive', 'dongles', 'unarchive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(206, 'dongles.publish', 'dongles', 'publish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(207, 'dongles.unpublish', 'dongles', 'unpublish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(208, 'dongles.assign', 'dongles', 'assign', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(209, 'downtime_reasons.viewany', 'downtime_reasons', 'viewAny', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(210, 'downtime_reasons.view', 'downtime_reasons', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(211, 'downtime_reasons.create', 'downtime_reasons', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(212, 'downtime_reasons.update', 'downtime_reasons', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(213, 'downtime_reasons.delete', 'downtime_reasons', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(214, 'downtime_reasons.restore', 'downtime_reasons', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(215, 'downtime_reasons.forcedelete', 'downtime_reasons', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(216, 'downtime_reasons.export', 'downtime_reasons', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(217, 'downtime_reasons.import', 'downtime_reasons', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(218, 'downtime_reasons.approve', 'downtime_reasons', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(219, 'downtime_reasons.reject', 'downtime_reasons', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(220, 'downtime_reasons.archive', 'downtime_reasons', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(221, 'downtime_reasons.unarchive', 'downtime_reasons', 'unarchive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(222, 'downtime_reasons.publish', 'downtime_reasons', 'publish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(223, 'downtime_reasons.unpublish', 'downtime_reasons', 'unpublish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(224, 'downtime_reasons.assign', 'downtime_reasons', 'assign', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(225, 'd_o_b_s.viewany', 'd_o_b_s', 'viewAny', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(226, 'd_o_b_s.view', 'd_o_b_s', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(227, 'd_o_b_s.create', 'd_o_b_s', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(228, 'd_o_b_s.update', 'd_o_b_s', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(229, 'd_o_b_s.delete', 'd_o_b_s', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(230, 'd_o_b_s.restore', 'd_o_b_s', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(231, 'd_o_b_s.forcedelete', 'd_o_b_s', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(232, 'd_o_b_s.export', 'd_o_b_s', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(233, 'd_o_b_s.import', 'd_o_b_s', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(234, 'd_o_b_s.approve', 'd_o_b_s', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(235, 'd_o_b_s.reject', 'd_o_b_s', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(236, 'd_o_b_s.archive', 'd_o_b_s', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(237, 'd_o_b_s.unarchive', 'd_o_b_s', 'unarchive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(238, 'd_o_b_s.publish', 'd_o_b_s', 'publish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(239, 'd_o_b_s.unpublish', 'd_o_b_s', 'unpublish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(240, 'd_o_b_s.assign', 'd_o_b_s', 'assign', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(241, 'exports.viewany', 'exports', 'viewAny', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(242, 'exports.view', 'exports', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(243, 'exports.create', 'exports', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(244, 'exports.update', 'exports', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(245, 'exports.delete', 'exports', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(246, 'exports.restore', 'exports', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(247, 'exports.forcedelete', 'exports', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(248, 'exports.export', 'exports', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(249, 'exports.import', 'exports', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(250, 'exports.approve', 'exports', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(251, 'exports.reject', 'exports', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(252, 'exports.archive', 'exports', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(253, 'exports.unarchive', 'exports', 'unarchive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(254, 'exports.publish', 'exports', 'publish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(255, 'exports.unpublish', 'exports', 'unpublish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(256, 'exports.assign', 'exports', 'assign', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(257, 'failed_import_rows.viewany', 'failed_import_rows', 'viewAny', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(258, 'failed_import_rows.view', 'failed_import_rows', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(259, 'failed_import_rows.create', 'failed_import_rows', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(260, 'failed_import_rows.update', 'failed_import_rows', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(261, 'failed_import_rows.delete', 'failed_import_rows', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(262, 'failed_import_rows.restore', 'failed_import_rows', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(263, 'failed_import_rows.forcedelete', 'failed_import_rows', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(264, 'failed_import_rows.export', 'failed_import_rows', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(265, 'failed_import_rows.import', 'failed_import_rows', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(266, 'failed_import_rows.approve', 'failed_import_rows', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(267, 'failed_import_rows.reject', 'failed_import_rows', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(268, 'failed_import_rows.archive', 'failed_import_rows', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(269, 'failed_import_rows.unarchive', 'failed_import_rows', 'unarchive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(270, 'failed_import_rows.publish', 'failed_import_rows', 'publish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(271, 'failed_import_rows.unpublish', 'failed_import_rows', 'unpublish', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(272, 'failed_import_rows.assign', 'failed_import_rows', 'assign', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(273, 'failed_jobs.viewany', 'failed_jobs', 'viewAny', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(274, 'failed_jobs.view', 'failed_jobs', 'view', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(275, 'failed_jobs.create', 'failed_jobs', 'create', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(276, 'failed_jobs.update', 'failed_jobs', 'update', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(277, 'failed_jobs.delete', 'failed_jobs', 'delete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(278, 'failed_jobs.restore', 'failed_jobs', 'restore', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(279, 'failed_jobs.forcedelete', 'failed_jobs', 'forceDelete', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(280, 'failed_jobs.export', 'failed_jobs', 'export', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(281, 'failed_jobs.import', 'failed_jobs', 'import', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(282, 'failed_jobs.approve', 'failed_jobs', 'approve', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(283, 'failed_jobs.reject', 'failed_jobs', 'reject', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(284, 'failed_jobs.archive', 'failed_jobs', 'archive', '2026-01-08 07:51:49', '2026-01-08 07:51:49'),
(285, 'failed_jobs.unarchive', 'failed_jobs', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(286, 'failed_jobs.publish', 'failed_jobs', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(287, 'failed_jobs.unpublish', 'failed_jobs', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(288, 'failed_jobs.assign', 'failed_jobs', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(289, 'fixed_lines.viewany', 'fixed_lines', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(290, 'fixed_lines.view', 'fixed_lines', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(291, 'fixed_lines.create', 'fixed_lines', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(292, 'fixed_lines.update', 'fixed_lines', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(293, 'fixed_lines.delete', 'fixed_lines', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(294, 'fixed_lines.restore', 'fixed_lines', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(295, 'fixed_lines.forcedelete', 'fixed_lines', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(296, 'fixed_lines.export', 'fixed_lines', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(297, 'fixed_lines.import', 'fixed_lines', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(298, 'fixed_lines.approve', 'fixed_lines', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(299, 'fixed_lines.reject', 'fixed_lines', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(300, 'fixed_lines.archive', 'fixed_lines', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(301, 'fixed_lines.unarchive', 'fixed_lines', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(302, 'fixed_lines.publish', 'fixed_lines', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(303, 'fixed_lines.unpublish', 'fixed_lines', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(304, 'fixed_lines.assign', 'fixed_lines', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(305, 'group_permission.viewany', 'group_permission', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(306, 'group_permission.view', 'group_permission', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(307, 'group_permission.create', 'group_permission', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(308, 'group_permission.update', 'group_permission', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(309, 'group_permission.delete', 'group_permission', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(310, 'group_permission.restore', 'group_permission', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(311, 'group_permission.forcedelete', 'group_permission', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(312, 'group_permission.export', 'group_permission', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(313, 'group_permission.import', 'group_permission', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(314, 'group_permission.approve', 'group_permission', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(315, 'group_permission.reject', 'group_permission', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(316, 'group_permission.archive', 'group_permission', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(317, 'group_permission.unarchive', 'group_permission', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(318, 'group_permission.publish', 'group_permission', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(319, 'group_permission.unpublish', 'group_permission', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(320, 'group_permission.assign', 'group_permission', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(321, 'h_q_s.viewany', 'h_q_s', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(322, 'h_q_s.view', 'h_q_s', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(323, 'h_q_s.create', 'h_q_s', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(324, 'h_q_s.update', 'h_q_s', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(325, 'h_q_s.delete', 'h_q_s', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(326, 'h_q_s.restore', 'h_q_s', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(327, 'h_q_s.forcedelete', 'h_q_s', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(328, 'h_q_s.export', 'h_q_s', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(329, 'h_q_s.import', 'h_q_s', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(330, 'h_q_s.approve', 'h_q_s', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(331, 'h_q_s.reject', 'h_q_s', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(332, 'h_q_s.archive', 'h_q_s', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(333, 'h_q_s.unarchive', 'h_q_s', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(334, 'h_q_s.publish', 'h_q_s', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(335, 'h_q_s.unpublish', 'h_q_s', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(336, 'h_q_s.assign', 'h_q_s', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(337, 'imports.viewany', 'imports', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(338, 'imports.view', 'imports', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(339, 'imports.create', 'imports', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(340, 'imports.update', 'imports', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(341, 'imports.delete', 'imports', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(342, 'imports.restore', 'imports', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(343, 'imports.forcedelete', 'imports', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(344, 'imports.export', 'imports', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(345, 'imports.import', 'imports', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(346, 'imports.approve', 'imports', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(347, 'imports.reject', 'imports', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(348, 'imports.archive', 'imports', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(349, 'imports.unarchive', 'imports', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(350, 'imports.publish', 'imports', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(351, 'imports.unpublish', 'imports', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(352, 'imports.assign', 'imports', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(353, 'jobs.viewany', 'jobs', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(354, 'jobs.view', 'jobs', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(355, 'jobs.create', 'jobs', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(356, 'jobs.update', 'jobs', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(357, 'jobs.delete', 'jobs', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(358, 'jobs.restore', 'jobs', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(359, 'jobs.forcedelete', 'jobs', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(360, 'jobs.export', 'jobs', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(361, 'jobs.import', 'jobs', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(362, 'jobs.approve', 'jobs', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(363, 'jobs.reject', 'jobs', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(364, 'jobs.archive', 'jobs', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(365, 'jobs.unarchive', 'jobs', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(366, 'jobs.publish', 'jobs', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(367, 'jobs.unpublish', 'jobs', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(368, 'jobs.assign', 'jobs', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(369, 'job_batches.viewany', 'job_batches', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(370, 'job_batches.view', 'job_batches', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(371, 'job_batches.create', 'job_batches', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(372, 'job_batches.update', 'job_batches', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(373, 'job_batches.delete', 'job_batches', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(374, 'job_batches.restore', 'job_batches', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(375, 'job_batches.forcedelete', 'job_batches', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(376, 'job_batches.export', 'job_batches', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(377, 'job_batches.import', 'job_batches', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(378, 'job_batches.approve', 'job_batches', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(379, 'job_batches.reject', 'job_batches', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(380, 'job_batches.archive', 'job_batches', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(381, 'job_batches.unarchive', 'job_batches', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(382, 'job_batches.publish', 'job_batches', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(383, 'job_batches.unpublish', 'job_batches', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(384, 'job_batches.assign', 'job_batches', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(385, 'migrations.viewany', 'migrations', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(386, 'migrations.view', 'migrations', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(387, 'migrations.create', 'migrations', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(388, 'migrations.update', 'migrations', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(389, 'migrations.delete', 'migrations', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(390, 'migrations.restore', 'migrations', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(391, 'migrations.forcedelete', 'migrations', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(392, 'migrations.export', 'migrations', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(393, 'migrations.import', 'migrations', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(394, 'migrations.approve', 'migrations', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(395, 'migrations.reject', 'migrations', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(396, 'migrations.archive', 'migrations', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(397, 'migrations.unarchive', 'migrations', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(398, 'migrations.publish', 'migrations', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(399, 'migrations.unpublish', 'migrations', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(400, 'migrations.assign', 'migrations', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(401, 'model_has_permissions.viewany', 'model_has_permissions', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(402, 'model_has_permissions.view', 'model_has_permissions', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(403, 'model_has_permissions.create', 'model_has_permissions', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(404, 'model_has_permissions.update', 'model_has_permissions', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(405, 'model_has_permissions.delete', 'model_has_permissions', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(406, 'model_has_permissions.restore', 'model_has_permissions', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(407, 'model_has_permissions.forcedelete', 'model_has_permissions', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(408, 'model_has_permissions.export', 'model_has_permissions', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(409, 'model_has_permissions.import', 'model_has_permissions', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(410, 'model_has_permissions.approve', 'model_has_permissions', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(411, 'model_has_permissions.reject', 'model_has_permissions', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(412, 'model_has_permissions.archive', 'model_has_permissions', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(413, 'model_has_permissions.unarchive', 'model_has_permissions', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(414, 'model_has_permissions.publish', 'model_has_permissions', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(415, 'model_has_permissions.unpublish', 'model_has_permissions', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(416, 'model_has_permissions.assign', 'model_has_permissions', 'assign', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(417, 'model_has_roles.viewany', 'model_has_roles', 'viewAny', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(418, 'model_has_roles.view', 'model_has_roles', 'view', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(419, 'model_has_roles.create', 'model_has_roles', 'create', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(420, 'model_has_roles.update', 'model_has_roles', 'update', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(421, 'model_has_roles.delete', 'model_has_roles', 'delete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(422, 'model_has_roles.restore', 'model_has_roles', 'restore', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(423, 'model_has_roles.forcedelete', 'model_has_roles', 'forceDelete', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(424, 'model_has_roles.export', 'model_has_roles', 'export', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(425, 'model_has_roles.import', 'model_has_roles', 'import', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(426, 'model_has_roles.approve', 'model_has_roles', 'approve', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(427, 'model_has_roles.reject', 'model_has_roles', 'reject', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(428, 'model_has_roles.archive', 'model_has_roles', 'archive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(429, 'model_has_roles.unarchive', 'model_has_roles', 'unarchive', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(430, 'model_has_roles.publish', 'model_has_roles', 'publish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(431, 'model_has_roles.unpublish', 'model_has_roles', 'unpublish', '2026-01-08 07:51:50', '2026-01-08 07:51:50'),
(432, 'model_has_roles.assign', 'model_has_roles', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(433, 'other_assets.viewany', 'other_assets', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(434, 'other_assets.view', 'other_assets', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(435, 'other_assets.create', 'other_assets', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(436, 'other_assets.update', 'other_assets', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(437, 'other_assets.delete', 'other_assets', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(438, 'other_assets.restore', 'other_assets', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(439, 'other_assets.forcedelete', 'other_assets', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(440, 'other_assets.export', 'other_assets', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(441, 'other_assets.import', 'other_assets', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(442, 'other_assets.approve', 'other_assets', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(443, 'other_assets.reject', 'other_assets', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(444, 'other_assets.archive', 'other_assets', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(445, 'other_assets.unarchive', 'other_assets', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(446, 'other_assets.publish', 'other_assets', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(447, 'other_assets.unpublish', 'other_assets', 'unpublish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(448, 'other_assets.assign', 'other_assets', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(449, 'outlets.viewany', 'outlets', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(450, 'outlets.view', 'outlets', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(451, 'outlets.create', 'outlets', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(452, 'outlets.update', 'outlets', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(453, 'outlets.delete', 'outlets', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(454, 'outlets.restore', 'outlets', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(455, 'outlets.forcedelete', 'outlets', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(456, 'outlets.export', 'outlets', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(457, 'outlets.import', 'outlets', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(458, 'outlets.approve', 'outlets', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(459, 'outlets.reject', 'outlets', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(460, 'outlets.archive', 'outlets', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(461, 'outlets.unarchive', 'outlets', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(462, 'outlets.publish', 'outlets', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(463, 'outlets.unpublish', 'outlets', 'unpublish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(464, 'outlets.assign', 'outlets', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(465, 'o_u_s.viewany', 'o_u_s', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(466, 'o_u_s.view', 'o_u_s', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(467, 'o_u_s.create', 'o_u_s', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(468, 'o_u_s.update', 'o_u_s', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(469, 'o_u_s.delete', 'o_u_s', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(470, 'o_u_s.restore', 'o_u_s', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(471, 'o_u_s.forcedelete', 'o_u_s', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(472, 'o_u_s.export', 'o_u_s', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(473, 'o_u_s.import', 'o_u_s', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(474, 'o_u_s.approve', 'o_u_s', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(475, 'o_u_s.reject', 'o_u_s', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(476, 'o_u_s.archive', 'o_u_s', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(477, 'o_u_s.unarchive', 'o_u_s', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(478, 'o_u_s.publish', 'o_u_s', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(479, 'o_u_s.unpublish', 'o_u_s', 'unpublish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(480, 'o_u_s.assign', 'o_u_s', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(481, 'password_reset_tokens.viewany', 'password_reset_tokens', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(482, 'password_reset_tokens.view', 'password_reset_tokens', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(483, 'password_reset_tokens.create', 'password_reset_tokens', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(484, 'password_reset_tokens.update', 'password_reset_tokens', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(485, 'password_reset_tokens.delete', 'password_reset_tokens', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(486, 'password_reset_tokens.restore', 'password_reset_tokens', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(487, 'password_reset_tokens.forcedelete', 'password_reset_tokens', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(488, 'password_reset_tokens.export', 'password_reset_tokens', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(489, 'password_reset_tokens.import', 'password_reset_tokens', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(490, 'password_reset_tokens.approve', 'password_reset_tokens', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(491, 'password_reset_tokens.reject', 'password_reset_tokens', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(492, 'password_reset_tokens.archive', 'password_reset_tokens', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(493, 'password_reset_tokens.unarchive', 'password_reset_tokens', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(494, 'password_reset_tokens.publish', 'password_reset_tokens', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(495, 'password_reset_tokens.unpublish', 'password_reset_tokens', 'unpublish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(496, 'password_reset_tokens.assign', 'password_reset_tokens', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(497, 'permissions.viewany', 'permissions', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(498, 'permissions.view', 'permissions', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(499, 'permissions.create', 'permissions', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(500, 'permissions.update', 'permissions', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(501, 'permissions.delete', 'permissions', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51');
INSERT INTO `permissions` (`id`, `name`, `model`, `action`, `created_at`, `updated_at`) VALUES
(502, 'permissions.restore', 'permissions', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(503, 'permissions.forcedelete', 'permissions', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(504, 'permissions.export', 'permissions', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(505, 'permissions.import', 'permissions', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(506, 'permissions.approve', 'permissions', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(507, 'permissions.reject', 'permissions', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(508, 'permissions.archive', 'permissions', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(509, 'permissions.unarchive', 'permissions', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(510, 'permissions.publish', 'permissions', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(511, 'permissions.unpublish', 'permissions', 'unpublish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(512, 'permissions.assign', 'permissions', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(513, 'photocopies.viewany', 'photocopies', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(514, 'photocopies.view', 'photocopies', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(515, 'photocopies.create', 'photocopies', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(516, 'photocopies.update', 'photocopies', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(517, 'photocopies.delete', 'photocopies', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(518, 'photocopies.restore', 'photocopies', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(519, 'photocopies.forcedelete', 'photocopies', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(520, 'photocopies.export', 'photocopies', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(521, 'photocopies.import', 'photocopies', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(522, 'photocopies.approve', 'photocopies', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(523, 'photocopies.reject', 'photocopies', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(524, 'photocopies.archive', 'photocopies', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(525, 'photocopies.unarchive', 'photocopies', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(526, 'photocopies.publish', 'photocopies', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(527, 'photocopies.unpublish', 'photocopies', 'unpublish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(528, 'photocopies.assign', 'photocopies', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(529, 'pos.viewany', 'pos', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(530, 'pos.view', 'pos', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(531, 'pos.create', 'pos', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(532, 'pos.update', 'pos', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(533, 'pos.delete', 'pos', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(534, 'pos.restore', 'pos', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(535, 'pos.forcedelete', 'pos', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(536, 'pos.export', 'pos', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(537, 'pos.import', 'pos', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(538, 'pos.approve', 'pos', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(539, 'pos.reject', 'pos', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(540, 'pos.archive', 'pos', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(541, 'pos.unarchive', 'pos', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(542, 'pos.publish', 'pos', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(543, 'pos.unpublish', 'pos', 'unpublish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(544, 'pos.assign', 'pos', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(545, 'printers.viewany', 'printers', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(546, 'printers.view', 'printers', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(547, 'printers.create', 'printers', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(548, 'printers.update', 'printers', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(549, 'printers.delete', 'printers', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(550, 'printers.restore', 'printers', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(551, 'printers.forcedelete', 'printers', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(552, 'printers.export', 'printers', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(553, 'printers.import', 'printers', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(554, 'printers.approve', 'printers', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(555, 'printers.reject', 'printers', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(556, 'printers.archive', 'printers', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(557, 'printers.unarchive', 'printers', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(558, 'printers.publish', 'printers', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(559, 'printers.unpublish', 'printers', 'unpublish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(560, 'printers.assign', 'printers', 'assign', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(561, 'roles.viewany', 'roles', 'viewAny', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(562, 'roles.view', 'roles', 'view', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(563, 'roles.create', 'roles', 'create', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(564, 'roles.update', 'roles', 'update', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(565, 'roles.delete', 'roles', 'delete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(566, 'roles.restore', 'roles', 'restore', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(567, 'roles.forcedelete', 'roles', 'forceDelete', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(568, 'roles.export', 'roles', 'export', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(569, 'roles.import', 'roles', 'import', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(570, 'roles.approve', 'roles', 'approve', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(571, 'roles.reject', 'roles', 'reject', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(572, 'roles.archive', 'roles', 'archive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(573, 'roles.unarchive', 'roles', 'unarchive', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(574, 'roles.publish', 'roles', 'publish', '2026-01-08 07:51:51', '2026-01-08 07:51:51'),
(575, 'roles.unpublish', 'roles', 'unpublish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(576, 'roles.assign', 'roles', 'assign', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(577, 'role_has_permissions.viewany', 'role_has_permissions', 'viewAny', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(578, 'role_has_permissions.view', 'role_has_permissions', 'view', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(579, 'role_has_permissions.create', 'role_has_permissions', 'create', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(580, 'role_has_permissions.update', 'role_has_permissions', 'update', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(581, 'role_has_permissions.delete', 'role_has_permissions', 'delete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(582, 'role_has_permissions.restore', 'role_has_permissions', 'restore', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(583, 'role_has_permissions.forcedelete', 'role_has_permissions', 'forceDelete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(584, 'role_has_permissions.export', 'role_has_permissions', 'export', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(585, 'role_has_permissions.import', 'role_has_permissions', 'import', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(586, 'role_has_permissions.approve', 'role_has_permissions', 'approve', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(587, 'role_has_permissions.reject', 'role_has_permissions', 'reject', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(588, 'role_has_permissions.archive', 'role_has_permissions', 'archive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(589, 'role_has_permissions.unarchive', 'role_has_permissions', 'unarchive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(590, 'role_has_permissions.publish', 'role_has_permissions', 'publish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(591, 'role_has_permissions.unpublish', 'role_has_permissions', 'unpublish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(592, 'role_has_permissions.assign', 'role_has_permissions', 'assign', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(593, 'scanners.viewany', 'scanners', 'viewAny', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(594, 'scanners.view', 'scanners', 'view', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(595, 'scanners.create', 'scanners', 'create', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(596, 'scanners.update', 'scanners', 'update', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(597, 'scanners.delete', 'scanners', 'delete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(598, 'scanners.restore', 'scanners', 'restore', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(599, 'scanners.forcedelete', 'scanners', 'forceDelete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(600, 'scanners.export', 'scanners', 'export', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(601, 'scanners.import', 'scanners', 'import', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(602, 'scanners.approve', 'scanners', 'approve', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(603, 'scanners.reject', 'scanners', 'reject', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(604, 'scanners.archive', 'scanners', 'archive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(605, 'scanners.unarchive', 'scanners', 'unarchive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(606, 'scanners.publish', 'scanners', 'publish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(607, 'scanners.unpublish', 'scanners', 'unpublish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(608, 'scanners.assign', 'scanners', 'assign', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(609, 'sessions.viewany', 'sessions', 'viewAny', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(610, 'sessions.view', 'sessions', 'view', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(611, 'sessions.create', 'sessions', 'create', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(612, 'sessions.update', 'sessions', 'update', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(613, 'sessions.delete', 'sessions', 'delete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(614, 'sessions.restore', 'sessions', 'restore', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(615, 'sessions.forcedelete', 'sessions', 'forceDelete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(616, 'sessions.export', 'sessions', 'export', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(617, 'sessions.import', 'sessions', 'import', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(618, 'sessions.approve', 'sessions', 'approve', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(619, 'sessions.reject', 'sessions', 'reject', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(620, 'sessions.archive', 'sessions', 'archive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(621, 'sessions.unarchive', 'sessions', 'unarchive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(622, 'sessions.publish', 'sessions', 'publish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(623, 'sessions.unpublish', 'sessions', 'unpublish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(624, 'sessions.assign', 'sessions', 'assign', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(625, 'tasks.viewany', 'tasks', 'viewAny', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(626, 'tasks.view', 'tasks', 'view', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(627, 'tasks.create', 'tasks', 'create', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(628, 'tasks.update', 'tasks', 'update', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(629, 'tasks.delete', 'tasks', 'delete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(630, 'tasks.restore', 'tasks', 'restore', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(631, 'tasks.forcedelete', 'tasks', 'forceDelete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(632, 'tasks.export', 'tasks', 'export', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(633, 'tasks.import', 'tasks', 'import', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(634, 'tasks.approve', 'tasks', 'approve', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(635, 'tasks.reject', 'tasks', 'reject', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(636, 'tasks.archive', 'tasks', 'archive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(637, 'tasks.unarchive', 'tasks', 'unarchive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(638, 'tasks.publish', 'tasks', 'publish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(639, 'tasks.unpublish', 'tasks', 'unpublish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(640, 'tasks.assign', 'tasks', 'assign', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(641, 'task_categories.viewany', 'task_categories', 'viewAny', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(642, 'task_categories.view', 'task_categories', 'view', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(643, 'task_categories.create', 'task_categories', 'create', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(644, 'task_categories.update', 'task_categories', 'update', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(645, 'task_categories.delete', 'task_categories', 'delete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(646, 'task_categories.restore', 'task_categories', 'restore', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(647, 'task_categories.forcedelete', 'task_categories', 'forceDelete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(648, 'task_categories.export', 'task_categories', 'export', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(649, 'task_categories.import', 'task_categories', 'import', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(650, 'task_categories.approve', 'task_categories', 'approve', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(651, 'task_categories.reject', 'task_categories', 'reject', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(652, 'task_categories.archive', 'task_categories', 'archive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(653, 'task_categories.unarchive', 'task_categories', 'unarchive', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(654, 'task_categories.publish', 'task_categories', 'publish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(655, 'task_categories.unpublish', 'task_categories', 'unpublish', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(656, 'task_categories.assign', 'task_categories', 'assign', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(657, 'users.viewany', 'users', 'viewAny', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(658, 'users.view', 'users', 'view', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(659, 'users.create', 'users', 'create', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(660, 'users.update', 'users', 'update', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(661, 'users.delete', 'users', 'delete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(662, 'users.restore', 'users', 'restore', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(663, 'users.forcedelete', 'users', 'forceDelete', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(664, 'users.export', 'users', 'export', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(665, 'users.import', 'users', 'import', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(666, 'users.approve', 'users', 'approve', '2026-01-08 07:51:52', '2026-01-08 07:51:52'),
(667, 'users.reject', 'users', 'reject', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(668, 'users.archive', 'users', 'archive', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(669, 'users.unarchive', 'users', 'unarchive', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(670, 'users.publish', 'users', 'publish', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(671, 'users.unpublish', 'users', 'unpublish', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(672, 'users.assign', 'users', 'assign', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(673, 'user_groups.viewany', 'user_groups', 'viewAny', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(674, 'user_groups.view', 'user_groups', 'view', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(675, 'user_groups.create', 'user_groups', 'create', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(676, 'user_groups.update', 'user_groups', 'update', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(677, 'user_groups.delete', 'user_groups', 'delete', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(678, 'user_groups.restore', 'user_groups', 'restore', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(679, 'user_groups.forcedelete', 'user_groups', 'forceDelete', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(680, 'user_groups.export', 'user_groups', 'export', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(681, 'user_groups.import', 'user_groups', 'import', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(682, 'user_groups.approve', 'user_groups', 'approve', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(683, 'user_groups.reject', 'user_groups', 'reject', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(684, 'user_groups.archive', 'user_groups', 'archive', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(685, 'user_groups.unarchive', 'user_groups', 'unarchive', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(686, 'user_groups.publish', 'user_groups', 'publish', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(687, 'user_groups.unpublish', 'user_groups', 'unpublish', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(688, 'user_groups.assign', 'user_groups', 'assign', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(689, 'user_user_group.viewany', 'user_user_group', 'viewAny', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(690, 'user_user_group.view', 'user_user_group', 'view', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(691, 'user_user_group.create', 'user_user_group', 'create', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(692, 'user_user_group.update', 'user_user_group', 'update', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(693, 'user_user_group.delete', 'user_user_group', 'delete', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(694, 'user_user_group.restore', 'user_user_group', 'restore', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(695, 'user_user_group.forcedelete', 'user_user_group', 'forceDelete', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(696, 'user_user_group.export', 'user_user_group', 'export', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(697, 'user_user_group.import', 'user_user_group', 'import', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(698, 'user_user_group.approve', 'user_user_group', 'approve', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(699, 'user_user_group.reject', 'user_user_group', 'reject', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(700, 'user_user_group.archive', 'user_user_group', 'archive', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(701, 'user_user_group.unarchive', 'user_user_group', 'unarchive', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(702, 'user_user_group.publish', 'user_user_group', 'publish', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(703, 'user_user_group.unpublish', 'user_user_group', 'unpublish', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(704, 'user_user_group.assign', 'user_user_group', 'assign', '2026-01-08 07:51:53', '2026-01-08 07:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `photocopies`
--

CREATE TABLE `photocopies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `service_no` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `merchant` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE `printers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quarters`
--

CREATE TABLE `quarters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quarters`
--

INSERT INTO `quarters` (`id`, `name`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Quarter I : 2018', '2025-07-08', '2025-10-10', 'First quarter of Ethiopian Fiscal Year 2018', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(2, 'Quarter II : 2018', '2025-10-11', '2026-01-08', 'Second quarter of Ethiopian Fiscal Year 2018', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(3, 'Quarter III : 2018', '2026-01-09', '2026-04-08', 'Third quarter of Ethiopian Fiscal Year 2018', '2026-01-08 07:51:53', '2026-01-08 07:51:53'),
(4, 'Quarter IV : 2018', '2026-04-09', '2026-07-07', 'Fourth quarter of Ethiopian Fiscal Year 2018', '2026-01-08 07:51:53', '2026-01-08 07:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scanners`
--

CREATE TABLE `scanners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_category_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'Operating System Re-installation', '192.168.163.113', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(2, 2, 'From Window 10 to Window 11 Upgrade', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(3, 1, 'Hard Drive Replacement', '192.168.163.110', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(4, 1, 'CMOS Battry Replacement', '192.168.163.87', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(5, 1, 'Power supply Replacement', '192.168.163.45', '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(6, 12, 'Office letter preparation for Ethiotelecomn', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(7, 11, 'Kasper database update', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `task_categories`
--

CREATE TABLE `task_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_categories`
--

INSERT INTO `task_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Hardware Mainatinance', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(2, 'Sofware Maintenance', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(3, 'User Support on Smart Desk', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(4, 'Network Incident Follow up', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(5, 'ATM Vendor Communication', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(6, 'ATM Support', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(7, 'ATM and Branch Relocation', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(8, 'Branch Opening', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(9, 'Switch Configuration', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(10, 'LAN Installation', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(11, 'Kasper Anntivirus: Agent, database update and license push', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47'),
(12, 'Ethiotelecom Communication', NULL, '2026-01-08 07:51:47', '2026-01-08 07:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `role` varchar(255) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `has_email_authentication` tinyint(1) DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `force_password_change` tinyint(1) DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fname`, `mname`, `lname`, `email`, `phone`, `address`, `branch_id`, `isActive`, `role`, `employee_id`, `has_email_authentication`, `email_verified_at`, `password`, `password_changed_at`, `force_password_change`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abebe', 'Seid', 'Mohammed', 'Seid', 'seid.mohammedseid@dashenbanksc.com', '0985192541', 'Jimma', 1, 1, 'admin', '1', 0, '2026-01-08 07:51:45', '$2y$12$SzSltzBZd5MLAozNCCOKMurlkVw.acAEC28Z59V/PhWtbJAGBTaoO', NULL, 0, NULL, '2026-01-08 07:51:46', '2026-01-08 07:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Super Admin', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(2, 'uadmin', 'System administrator', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(3, 'branch', 'Branch', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(4, 'head', 'Head', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(5, 'stocker', 'Stocker', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(6, 'om', 'Operation Manager', '2026-01-08 07:51:45', '2026-01-08 07:51:45'),
(7, 'sm', 'Senoir Manager', '2026-01-08 07:51:45', '2026-01-08 07:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_user_group`
--

CREATE TABLE `user_user_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `activity_reports`
--
ALTER TABLE `activity_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_reports_task_id_foreign` (`task_id`),
  ADD KEY `activity_reports_deliverable_id_foreign` (`deliverable_id`),
  ADD KEY `activity_reports_task_giver_id_foreign` (`task_giver_id`),
  ADD KEY `activity_reports_district_id_foreign` (`district_id`);

--
-- Indexes for table `asset_classes`
--
ALTER TABLE `asset_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asset_classes_name_unique` (`name`);

--
-- Indexes for table `asset_disposals`
--
ALTER TABLE `asset_disposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_disposals_branch_id_foreign` (`branch_id`),
  ADD KEY `asset_disposals_disposed_by_foreign` (`disposed_by`),
  ADD KEY `asset_disposals_asset_type_asset_id_index` (`asset_type`,`asset_id`);

--
-- Indexes for table `asset_maintenances`
--
ALTER TABLE `asset_maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_maintenances_assetable_type_assetable_id_index` (`assetable_type`,`assetable_id`),
  ADD KEY `asset_maintenances_branch_id_foreign` (`branch_id`),
  ADD KEY `asset_maintenances_ou_id_foreign` (`ou_id`),
  ADD KEY `asset_maintenances_user_id_foreign` (`user_id`);

--
-- Indexes for table `asset_transfers`
--
ALTER TABLE `asset_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_transfers_assetable_type_assetable_id_index` (`assetable_type`,`assetable_id`),
  ADD KEY `asset_transfers_from_branch_id_foreign` (`from_branch_id`),
  ADD KEY `asset_transfers_to_branch_id_foreign` (`to_branch_id`),
  ADD KEY `asset_transfers_performed_by_foreign` (`performed_by`);

--
-- Indexes for table `a_t_m_reports`
--
ALTER TABLE `a_t_m_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_t_m_reports_custodian_foreign` (`custodian`),
  ADD KEY `a_t_m_reports_atm_id_foreign` (`atm_id`),
  ADD KEY `a_t_m_reports_downtime_reason_id_foreign` (`downtime_reason_id`),
  ADD KEY `a_t_m_reports_created_by_foreign` (`created_by`),
  ADD KEY `a_t_m_reports_closed_by_foreign` (`closed_by`);

--
-- Indexes for table `a_t_m_s`
--
ALTER TABLE `a_t_m_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_t_m_s_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_code_unique` (`code`),
  ADD UNIQUE KEY `branches_tag_unique` (`tag`),
  ADD KEY `branches_district_id_foreign` (`district_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `computers`
--
ALTER TABLE `computers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `computers_serialno_unique` (`serialNo`),
  ADD KEY `computers_hardware_type_id_foreign` (`hardware_type_id`),
  ADD KEY `computers_computer_model_id_foreign` (`computer_model_id`),
  ADD KEY `computers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `computer_models`
--
ALTER TABLE `computer_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `computer_models_hardware_type_id_foreign` (`hardware_type_id`);

--
-- Indexes for table `data_v_p_n_s`
--
ALTER TABLE `data_v_p_n_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_v_p_n_s_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `deliverables`
--
ALTER TABLE `deliverables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliverables_task_id_foreign` (`task_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dongles`
--
ALTER TABLE `dongles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dongles_serial_unique` (`serial`),
  ADD UNIQUE KEY `dongles_imei_unique` (`imei`),
  ADD UNIQUE KEY `dongles_iccid_unique` (`iccid`),
  ADD KEY `dongles_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `downtime_reasons`
--
ALTER TABLE `downtime_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `d_o_b_s`
--
ALTER TABLE `d_o_b_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `d_o_b_s_service_no_unique` (`service_no`),
  ADD UNIQUE KEY `d_o_b_s_serial_unique` (`serial`),
  ADD UNIQUE KEY `d_o_b_s_iccid_unique` (`iccid`),
  ADD KEY `d_o_b_s_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `exports`
--
ALTER TABLE `exports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `failed_import_rows_import_id_foreign` (`import_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fixed_lines`
--
ALTER TABLE `fixed_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fixed_lines_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD PRIMARY KEY (`group_id`,`permission_id`),
  ADD KEY `group_permission_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `hardware_types`
--
ALTER TABLE `hardware_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_q_s`
--
ALTER TABLE `h_q_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imports_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`),
  ADD KEY `messages_sender_id_receiver_id_index` (`sender_id`,`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `other_assets`
--
ALTER TABLE `other_assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `other_assets_asset_number_unique` (`asset_number`),
  ADD KEY `other_assets_asset_class_id_foreign` (`asset_class_id`),
  ADD KEY `other_assets_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlets_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `o_u_s`
--
ALTER TABLE `o_u_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `photocopies`
--
ALTER TABLE `photocopies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photocopies_tag_unique` (`tag`),
  ADD KEY `photocopies_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pos_tag_unique` (`tag`),
  ADD UNIQUE KEY `pos_serial_unique` (`serial`),
  ADD KEY `pos_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `printers_tag_unique` (`tag`),
  ADD KEY `printers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `quarters`
--
ALTER TABLE `quarters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `scanners`
--
ALTER TABLE `scanners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scanners_tag_unique` (`tag`),
  ADD KEY `scanners_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_task_category_id_foreign` (`task_category_id`);

--
-- Indexes for table `task_categories`
--
ALTER TABLE `task_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `task_categories_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_groups_name_unique` (`name`);

--
-- Indexes for table `user_user_group`
--
ALTER TABLE `user_user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_user_group_user_id_foreign` (`user_id`),
  ADD KEY `user_user_group_user_group_id_foreign` (`user_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_reports`
--
ALTER TABLE `activity_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_classes`
--
ALTER TABLE `asset_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `asset_disposals`
--
ALTER TABLE `asset_disposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_maintenances`
--
ALTER TABLE `asset_maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_transfers`
--
ALTER TABLE `asset_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_t_m_reports`
--
ALTER TABLE `a_t_m_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_t_m_s`
--
ALTER TABLE `a_t_m_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `computers`
--
ALTER TABLE `computers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `computer_models`
--
ALTER TABLE `computer_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `data_v_p_n_s`
--
ALTER TABLE `data_v_p_n_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliverables`
--
ALTER TABLE `deliverables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dongles`
--
ALTER TABLE `dongles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downtime_reasons`
--
ALTER TABLE `downtime_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `d_o_b_s`
--
ALTER TABLE `d_o_b_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exports`
--
ALTER TABLE `exports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fixed_lines`
--
ALTER TABLE `fixed_lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hardware_types`
--
ALTER TABLE `hardware_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `h_q_s`
--
ALTER TABLE `h_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `other_assets`
--
ALTER TABLE `other_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_u_s`
--
ALTER TABLE `o_u_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=705;

--
-- AUTO_INCREMENT for table `photocopies`
--
ALTER TABLE `photocopies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `printers`
--
ALTER TABLE `printers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quarters`
--
ALTER TABLE `quarters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scanners`
--
ALTER TABLE `scanners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task_categories`
--
ALTER TABLE `task_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_user_group`
--
ALTER TABLE `user_user_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_reports`
--
ALTER TABLE `activity_reports`
  ADD CONSTRAINT `activity_reports_deliverable_id_foreign` FOREIGN KEY (`deliverable_id`) REFERENCES `deliverables` (`id`),
  ADD CONSTRAINT `activity_reports_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `activity_reports_task_giver_id_foreign` FOREIGN KEY (`task_giver_id`) REFERENCES `o_u_s` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activity_reports_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `asset_disposals`
--
ALTER TABLE `asset_disposals`
  ADD CONSTRAINT `asset_disposals_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `asset_disposals_disposed_by_foreign` FOREIGN KEY (`disposed_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `asset_maintenances`
--
ALTER TABLE `asset_maintenances`
  ADD CONSTRAINT `asset_maintenances_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_maintenances_ou_id_foreign` FOREIGN KEY (`ou_id`) REFERENCES `o_u_s` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_maintenances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `asset_transfers`
--
ALTER TABLE `asset_transfers`
  ADD CONSTRAINT `asset_transfers_from_branch_id_foreign` FOREIGN KEY (`from_branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_transfers_performed_by_foreign` FOREIGN KEY (`performed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `asset_transfers_to_branch_id_foreign` FOREIGN KEY (`to_branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `a_t_m_reports`
--
ALTER TABLE `a_t_m_reports`
  ADD CONSTRAINT `a_t_m_reports_atm_id_foreign` FOREIGN KEY (`atm_id`) REFERENCES `a_t_m_s` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `a_t_m_reports_closed_by_foreign` FOREIGN KEY (`closed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `a_t_m_reports_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `a_t_m_reports_custodian_foreign` FOREIGN KEY (`custodian`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `a_t_m_reports_downtime_reason_id_foreign` FOREIGN KEY (`downtime_reason_id`) REFERENCES `downtime_reasons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `a_t_m_s`
--
ALTER TABLE `a_t_m_s`
  ADD CONSTRAINT `a_t_m_s_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `computers`
--
ALTER TABLE `computers`
  ADD CONSTRAINT `computers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `computers_computer_model_id_foreign` FOREIGN KEY (`computer_model_id`) REFERENCES `computer_models` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `computers_hardware_type_id_foreign` FOREIGN KEY (`hardware_type_id`) REFERENCES `hardware_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `computer_models`
--
ALTER TABLE `computer_models`
  ADD CONSTRAINT `computer_models_hardware_type_id_foreign` FOREIGN KEY (`hardware_type_id`) REFERENCES `hardware_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_v_p_n_s`
--
ALTER TABLE `data_v_p_n_s`
  ADD CONSTRAINT `data_v_p_n_s_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deliverables`
--
ALTER TABLE `deliverables`
  ADD CONSTRAINT `deliverables_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dongles`
--
ALTER TABLE `dongles`
  ADD CONSTRAINT `dongles_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `d_o_b_s`
--
ALTER TABLE `d_o_b_s`
  ADD CONSTRAINT `d_o_b_s_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  ADD CONSTRAINT `failed_import_rows_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `imports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fixed_lines`
--
ALTER TABLE `fixed_lines`
  ADD CONSTRAINT `fixed_lines_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD CONSTRAINT `group_permission_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `imports`
--
ALTER TABLE `imports`
  ADD CONSTRAINT `imports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `other_assets`
--
ALTER TABLE `other_assets`
  ADD CONSTRAINT `other_assets_asset_class_id_foreign` FOREIGN KEY (`asset_class_id`) REFERENCES `asset_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `other_assets_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `outlets`
--
ALTER TABLE `outlets`
  ADD CONSTRAINT `outlets_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photocopies`
--
ALTER TABLE `photocopies`
  ADD CONSTRAINT `photocopies_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pos`
--
ALTER TABLE `pos`
  ADD CONSTRAINT `pos_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `printers`
--
ALTER TABLE `printers`
  ADD CONSTRAINT `printers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scanners`
--
ALTER TABLE `scanners`
  ADD CONSTRAINT `scanners_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_task_category_id_foreign` FOREIGN KEY (`task_category_id`) REFERENCES `task_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_user_group`
--
ALTER TABLE `user_user_group`
  ADD CONSTRAINT `user_user_group_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_user_group_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
