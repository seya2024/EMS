-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2026 at 01:49 PM
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
(1, 'Furniture & Office Materials', 'Office materials', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(2, 'Digital Computer', 'Digital Computer', '2026-01-09 08:44:33', '2026-01-09 08:44:33');

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
  `name` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `design` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `ipAddress` varchar(255) DEFAULT NULL,
  `networkType` varchar(255) DEFAULT 'Broadband',
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `a_t_m_s`
--

INSERT INTO `a_t_m_s` (`id`, `terminal`, `name`, `os`, `type`, `location`, `design`, `branch_id`, `ipAddress`, `networkType`, `remark`, `created_at`, `updated_at`) VALUES
(1, 'PATML059', 'ABAJIFAR ATM', '7', 'NCR', 'On-branch', 'Lobby', 30, '172.21.16.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(2, 'PATML133', 'FERENJ ARADA ATM', '10', 'NCR', 'On-branch', 'Lobby', 31, '172.20.149.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:08:14'),
(3, 'PATML167', 'LIMU GENT ATM', '10', 'NCR', 'On-branch', 'Lobby', 3, '192.168.96.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:08:44'),
(4, 'PATML185', 'AGARO ATM', '10', 'NCR', 'On-branch', 'Lobby', 2, '172.19.15.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:09:10'),
(5, 'PATML228', 'JIMMA 2 ATM', 'Windows 10 Build 14393 Intel IA-32', 'ATM', 'JIMMA', 'Lobby', 1, '192.168.163.154', 'Broadband', '', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(6, 'PATMT077', 'Yayo', '10', 'GRG', 'On-branch', 'Lobby', 11, '172.23.179.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:09:49'),
(7, 'PATMT151', 'METU ATM', '10', 'NCR', 'On-branch', 'Lobby', 12, '192.168.90.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:10:12'),
(8, 'PATMT074', 'Jimma Ferenj Arada_2 Branch', '10', 'NCR', 'On-branch', 'Lobby', 31, '172.20.149.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:10:40'),
(9, 'PATMT069', 'Silk Amba Branch', '10', 'NCR', 'On-branch', 'Lobby', 23, '172.23.221.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:11:13'),
(10, 'PATML177', 'Jimma Branch', '', 'ATM', 'Jimma', 'Lobby', 1, '192.168.163.153', 'Broadband', '', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(11, 'PAGRL191', 'Masha Branch', '10', 'GRG', 'On-branch', 'Lobby', 14, '172.21.77.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:11:50'),
(12, 'PAGRL194', 'Denebe(sokoru) Branch', '10', 'GRG', 'On-branch', 'Lobby', 19, '172.21.235.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:12:18'),
(13, 'PAGRL196', 'Meti Branch', '10', 'GRG', 'On-branch', 'Lobby', 15, '172.21.182.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:12:40'),
(14, 'PAGRL197', 'Jimma Main Branch', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'ATM', 'JIMMA', 'Lobby', 1, '192.168.163.155', 'Broadband', '', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(15, 'PAGRL253', 'Alif Branch', '10', 'GRG', 'On-branch', 'Lobby', 24, '172.19.30.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:13:09'),
(16, 'PAGRL257', 'Gechi Branch', '10', 'GRG', 'On-branch', 'Lobby', 13, '172.21.69.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:13:37'),
(17, 'PAGRL254', 'Abajifar Main', '10', 'GRG', 'On-branch', 'Lobby', 29, '172.21.165.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:14:07'),
(18, 'PAGRL400', 'Hermata Branch', '10', 'GRG', 'On-branch', 'Lobby', 26, '172.21.73.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:14:27'),
(19, 'PAGRL401', 'Iqra Branch', '10', 'GRG', 'On-branch', 'Lobby', 28, '172.21.74.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:15:00'),
(20, 'PAGRL402', 'Bedele branch', '10', 'GRG', 'On-branch', 'Lobby', 8, '192.168.154.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:15:24'),
(21, 'PAGRL403', 'Jimma Menahira Branch', '10', 'GRG', 'On-branch', 'Lobby', 27, '172.20.94.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:15:57'),
(22, 'PAGRL404', 'Saja Branch', '10', 'GRG', 'On-branch', 'Lobby', 20, '172.21.115.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:16:18'),
(23, 'PAGRL463', 'Tolay Branch', '10', 'NCR', 'On-branch', 'Lobby', 22, '172.23.142.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:17:15'),
(24, 'PAGRL631', 'Jimma Haile Resort', '10', 'GRG', 'Off-branch', 'Lobby', 27, '172.22.141.60', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:17:35'),
(25, 'PAGRL637', 'Gumerro Tea', '10', 'GRG', 'Off-branch', 'Lobby', 12, '172.29.90.8', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:18:16'),
(26, 'PAGRL774', 'Jimma ATM center 2', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'ATM', 'JIMMA', 'Lobby', 1, '192.168.163.157', 'Broadband', '', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(27, 'PAGRL773', 'Jimma ATM center 1', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'ATM', 'JIMMA', 'Lobby', 1, '192.168.163.156', 'Broadband', '', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(28, 'PAGRL717', 'Mettu Branch', '10', 'GRG', 'On-branch', 'Lobby', 12, '192.168.90.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:01:46'),
(29, 'PAGRL764', 'Chida Branch', '10', 'GRG', 'On-branch', 'Lobby', 18, '172.21.236.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:01:22'),
(30, 'PAGRR823', 'Jimma Merkato Market', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 2TB HDD', 'Recycler', 'Jimma', 'Lobby', 1, '192.168.163.159', 'Broadband', '', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(31, 'PATML166', 'Limmu Genet_2 Branch', '10', 'NCR', 'On-branch', 'Lobby', 3, '192.168.96.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:00:53'),
(32, 'PATML176', 'Gecha Branch', '10', 'NCR', 'On-branch', 'Lobby', 7, '172.21.78.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 02:00:29'),
(33, 'PATML180', 'Agaro_2 Branch', '10', 'NCR', 'On-branch', 'Lobby', 2, '172.19.15.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 01:58:11'),
(34, 'PATML184', 'IFB Al-nur Agaro Branch', '10', 'NCR', 'On-branch', 'Lobby', 6, '172.20.87.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 01:57:40'),
(35, 'PATML186', 'Shebe Branch', '10', 'NCR', 'On-branch', 'Lobby', 17, '172.23.60.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 01:57:12'),
(36, 'PATML132', 'Shishonde', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.20.123.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(37, 'PATMT081', 'Bonga', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '192.168.206.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(38, 'PATMT085', 'Mizan', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '192.168.191.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(39, 'PATML266', 'Tarekegn Tadesse Com.center', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.22.149.234', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(40, 'PATMT080', 'Bonga Branch #3', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '192.168.206.156', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(41, 'PAGRL190', 'Gessa Branch', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.21.68.2', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(42, 'PAGRL457', 'Gesha Branch', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.20.170.1', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(43, 'PAGRL462', 'Al-Baaraka Teppi Branch', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.23.253.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(44, 'PAGRL455', 'Berges Branch', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.23.Windows 106.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(45, 'PAGRL461', 'Shay Bench', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.20.169.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(46, 'PAGRL459', 'Makira Branch', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.23.83.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(47, 'PAGRL456', 'Bonga Branch', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '192.168.206.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(48, 'PAGRL458', 'Gojeb', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '172.23.184.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(49, 'PAGRL636', 'Bonga university', 'Windows Windows 10', 'GRG', 'Off-branch', 'Lobby', 36, '172.22.144.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(50, 'PAGRL635', 'Mintesint Tesfaye Building', 'Windows Windows 10', 'GRG', 'Off-branch', 'Lobby', 36, '172.22.141.83', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(51, 'PAGRL763', 'Teppi Branch2', 'Windows Windows 10', 'GRG', 'On-branch', 'Lobby', 36, '192.168.58.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(52, 'PAGRL199', 'Aman Branch', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(53, 'PAGRL195', 'Dima Branch', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(54, 'PAGRL460', 'Mizan2', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(55, 'PAGRL632', 'Dimma Branch 2', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(56, 'PAGRL630', 'Tercha branch', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(57, 'PAGRL762', 'Saylem Branch', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(58, 'PAGRL252', 'Wonber Yosef Market Center', 'Windows 10', 'GRG', 'Off-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(59, 'PATML229', 'Bita Branch', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(60, 'PATML234', 'Goba Dishi Branch', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(61, 'PATML243', 'Bachuma Branch', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(62, 'PATML264', 'Jemu branch', 'Windows 10', 'GRG', 'On-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(63, 'PATML265', 'Meseret Welde Commercial center', 'Windows 10', 'GRG', 'Off-branch', 'Lobby', 36, NULL, 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(64, 'PATML227', 'Baro Mado', 'windows 7 Professional 32-bit', 'GRG', 'On-branch', NULL, 34, '172.20.171.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(65, 'PATMT078', 'Gambella', 'windows 7 Professional 32-bit', 'GRG', 'On-branch', NULL, 34, '192.168.169.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(66, 'PATMT079', 'Nekemte', 'windows 7 Professional 32-bit', 'GRG', 'On-branch', NULL, 34, '192.168.144.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(67, 'PATMT171', 'Dembi dolo', 'Windows 10 Enterprise 2016 LTSB 64-bit', 'GRG', 'On-branch', NULL, 34, '172.20.122.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(68, 'PATML183', 'Gimbi', 'Windows 10 Enterprise 2016 LTSB 64-bit', 'GRG', 'On-branch', NULL, 34, '172.20.121.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(69, 'PATMT042', 'Ambo', 'windows 7 Professional 32-bit', 'GRG', 'On-branch', NULL, 34, '192.168.166.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(70, 'PAGRL192', 'Terfam Branch', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.21.183.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(71, 'PAGRL255', 'Meklit Hotel', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.22.141.66/24', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(72, 'PAGRL399', 'Gambella new Land', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.21.7.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(73, 'PAGRL454', 'Benishangul Branch', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.21.237.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(74, 'PAGRL464', 'Gambella Hospital', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.22.144.141/24', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(75, 'PAGRL628', 'Bambasi', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.21.238.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(76, 'PAGRL629', 'Nekemte Branch2', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '192.168.144.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(77, 'PAGRL633', 'Arumela', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.22.144.132/29', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(78, 'PAGRL678', 'Baro Mado Branch', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.20.171.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(79, 'PAGRL752', 'Gambella New land2', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.21.7.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(80, 'PAGRL472', 'Yai Geda', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.21.40.53', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(81, 'PAGRL198', 'Gambela General Hospital', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '172.22.148.210/29', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(82, 'PAGRL799', 'Assosa Branch', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 21H2', 'GRG', 'On-branch', NULL, 34, '192.168.54.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(83, 'PAGRR811', 'Gambella', 'Microsoft Windows 10 IoT Enterprise LTSC 64-bit 2TB HDD', 'GRG', 'On-branch', NULL, 34, '192.168.169.158', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(84, 'PATML158', 'Yai Geda Branch', 'Win 10 IOT Enterprise LTSC 64-bit', 'GRG', 'On-branch', NULL, 34, '172.21.40.155', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(85, 'PATML160', 'Shambu Branch', 'Win 10 IOT Enterprise LTSC 64-bit', 'GRG', 'On-branch', NULL, 34, '172.19.19.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(86, 'PATML164', 'wollga University/Bake Jama #2', 'Win 10 IOT Enterprise LTSC 64-bit', 'GRG', 'On-branch', NULL, 34, '172.21.75.153', 'Broadband', NULL, '2026-01-09 08:44:38', '2026-01-09 08:44:38');

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
(1, '21', 'Jimma Branch', 'II', 'JM', 1, '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(2, '22', 'Agaro Branch', 'I', 'AGR', 1, '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(3, '23', 'Limmugenet Branch', 'I', 'LMG', 1, '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(4, 'YB', 'Yebu Branch', 'I', 'YB', 1, '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(5, 'BL', 'Bilida Outlet', 'I', 'BL', 1, '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(6, 'AL', 'Al-nur IFB', 'I', 'AL', 1, '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(7, 'CH', 'Gecha Branch', 'I', 'CH', 1, '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(8, 'BD', 'Bedele Branch', 'I', 'BD', 1, '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(9, 'FR', 'Furisa Abawoga', 'I', 'FR', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(10, 'CHR', 'Chora Outlet', 'I', 'CHR', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(11, 'YY', 'Yayo Branch', 'I', 'YY', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(12, 'MT', 'Mettu Branch', 'I', 'MT', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(13, 'GH', 'Gechi Branch', 'I', 'GH', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(14, 'MSH', 'Masha Branch', 'I', 'MSH', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(15, 'MTI', 'Meti Branch', 'I', 'MTI', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(16, 'YR', 'Yeri Outlet', 'I', 'YR', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(17, 'SHE', 'Shebe Branch', 'I', 'SHE', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(18, 'CHD', 'Chida Branch', 'I', 'CHD', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(19, 'DNB', 'Deneba Branch', 'I', 'DNB', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(20, 'SJ', 'Saja Branch', 'I', 'SJ', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(21, 'SK', 'Sokoru Outlet', 'I', 'SK', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(22, 'TLY', 'Tollay Branch', 'I', 'TLY', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(23, 'SLA', 'SilkAmba Branch', 'I', 'SLA', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(24, 'ALF', 'Alif Branch', 'I', 'ALF', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(25, 'ALFS', 'Alif Outlet', 'I', 'ALFS', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(26, 'HIR', 'Hirmata Branch', 'I', 'HIR', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(27, 'MNR', 'Meneharia Branch', 'I', 'MNR', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(28, 'IQR', 'IFB - Iqra Branch', 'I', 'IQR', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(29, 'ABJ', 'Abajifar Branch', 'I', 'ABJ', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(30, 'ABJS', 'Abajifar Outlet', 'I', 'ABJS', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(31, 'FRJ', 'Ferenji Arada Branch', 'I', 'FRJ', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(32, 'JDO', 'Jimma District Office', 'I', 'JDO', 1, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(33, 'WDO', 'Wolaita District Office', 'I', 'WDO', 14, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(34, 'NDO', 'Nekemete District Office', 'I', 'NDO', 3, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(35, 'ADO', 'Adama District Office', 'I', 'ADO', 5, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(36, 'SWDO', 'South West District Office', 'I', 'SWDO', 2, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(37, 'HDO', 'Hawasa District Office', 'I', 'HDO', 4, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(38, 'DDDO', 'Dire Dawa District Office', 'I', 'DDDO', 6, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(39, 'DDO', 'Dessie District Office', 'I', 'DDO', 8, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(40, 'MDO', 'Mekele District Office', 'I', 'MDO', 7, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(41, 'BDO', 'Bahir Dar District Office', 'I', 'BDO', 9, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(42, 'SADO', 'South Addis District Office', 'I', 'SADO', 13, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(43, 'NADO', 'North Addis District Office', 'I', 'NADO', 10, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(44, 'EADO', 'East Addis District Office', 'I', 'EADO', 11, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(45, 'WADO', 'West Addis District Office', 'I', 'WADO', 12, '2026-01-09 08:44:31', '2026-01-09 08:44:31');

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
  `name` varchar(255) DEFAULT NULL,
  `hardware_type_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `computer_models`
--

INSERT INTO `computer_models` (`id`, `name`, `hardware_type_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Dell OptiPlex 380', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(2, 'Dell OptiPlex 390', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(3, 'Dell OptiPlex 7010', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(4, 'Dell OptiPlex 7020', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(5, 'Dell OptiPlex 3020', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(6, 'Dell OptiPlex 3040', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(7, 'Dell OptiPlex 5040', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(8, 'Dell OptiPlex 5050', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(9, 'Dell OptiPlex 3060', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(10, 'Dell OptiPlex 3070', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(11, 'Dell OptiPlex 3080', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(12, 'Dell OptiPlex 3000 Micro', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(13, 'Dell OptiPlex 3000 SFF', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(14, 'Dell OptiPlex 3000 Tower', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(15, 'Dell OptiPlex 3000 AIO', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(16, 'HP Compaq dc5800', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(17, 'HP Compaq dc7900', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(18, 'HP Compaq 6000 Pro', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(19, 'HP Compaq 6200 Pro', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(20, 'HP Compaq 6300 Pro', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(21, 'HP ProDesk 400 G1', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(22, 'HP ProDesk 400 G2', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(23, 'HP ProDesk 400 G3', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(24, 'HP ProDesk 400 G5', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(25, 'HP ProDesk 600 G1', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(26, 'HP ProDesk 600 G3', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(27, 'HP EliteDesk 800 G1', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(28, 'HP EliteDesk 800 G2', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(29, 'HP EliteDesk 800 G3', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(30, 'HP EliteDesk 800 G5', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(31, 'HP ProOne 400 G3', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(32, 'HP ProOne 400 G4', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(33, 'Lenovo ThinkCentre M58', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(34, 'Lenovo ThinkCentre M700', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(35, 'Lenovo ThinkCentre M710', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(36, 'Lenovo ThinkCentre M720', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(37, 'Lenovo ThinkCentre M900', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(38, 'Lenovo ThinkCentre M910', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(39, 'Lenovo ThinkCentre M920', 1, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(40, 'Dell Latitude E6410', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(41, 'Dell Latitude E6430', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(42, 'Dell Latitude 5480', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(43, 'Dell Latitude 5490', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(44, 'Dell Latitude 5500', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(45, 'Dell Latitude 5520', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(46, 'HP EliteBook 8460p', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(47, 'HP EliteBook 840 G3', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(48, 'HP EliteBook 840 G5', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(49, 'HP ProBook 450 G6', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(50, 'Lenovo ThinkPad T430', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(51, 'Lenovo ThinkPad T480', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(52, 'Lenovo ThinkPad T490', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(53, 'Lenovo ThinkPad X260', 2, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(54, 'Dell PowerEdge T30', 3, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(55, 'Dell PowerEdge R740', 3, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(56, 'HP ProLiant ML350 Gen9', 3, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(57, 'HP ProLiant DL380 Gen10', 3, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(58, 'Lenovo ThinkSystem SR650', 3, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31');

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
(1, 'Jimma', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(2, 'South West', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(3, 'Nekemete', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(4, 'Hawasa', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(5, 'Adama', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(6, 'Dire Dawa', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(7, 'Mekele', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(8, 'Dessie', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(9, 'Bahir Dar', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(10, 'North Addis', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(11, 'East Addis', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(12, 'West Addis', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(13, 'South Addis', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(14, 'Wolaita', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(15, 'Head Office', '2026-01-09 08:44:30', '2026-01-09 08:44:30');

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
(1, 'No Power', 'Electric-Utility', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(2, 'No Network', 'Ethiotelecom', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(3, 'Dispenser', 'Vendor', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(4, 'Card Reader', 'Vendor', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(5, 'EPP', 'Vendor', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(6, 'No cash', 'The-branch', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(7, 'Note Jam', 'The-branch', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(8, 'Cassette Error', 'Vendor', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(9, 'Relocation', 'Digital-channel', '2026-01-09 08:44:33', '2026-01-09 08:44:33');

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
(1, 'Desktop', 'Portable computers', '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(2, 'Laptop', 'Stationary computers', '2026-01-09 08:44:31', '2026-01-09 08:44:31'),
(3, 'Server', 'Enterprise-grade servers', '2026-01-09 08:44:31', '2026-01-09 08:44:31');

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
(1, 'Head Office', 'One step a head', '2026-01-09 08:44:31', '2026-01-09 08:44:31');

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
(47, '2026_01_08_124554_create_messages_table', 1),
(48, '2026_01_08_183953_add_photo_to_users_table', 1);

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
(1, 'activity_reports.viewany', 'activity_reports', 'viewAny', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(2, 'activity_reports.view', 'activity_reports', 'view', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(3, 'activity_reports.create', 'activity_reports', 'create', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(4, 'activity_reports.update', 'activity_reports', 'update', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(5, 'activity_reports.delete', 'activity_reports', 'delete', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(6, 'activity_reports.restore', 'activity_reports', 'restore', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(7, 'activity_reports.forcedelete', 'activity_reports', 'forceDelete', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(8, 'activity_reports.export', 'activity_reports', 'export', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(9, 'activity_reports.import', 'activity_reports', 'import', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(10, 'activity_reports.approve', 'activity_reports', 'approve', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(11, 'activity_reports.reject', 'activity_reports', 'reject', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(12, 'activity_reports.archive', 'activity_reports', 'archive', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(13, 'activity_reports.unarchive', 'activity_reports', 'unarchive', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(14, 'activity_reports.publish', 'activity_reports', 'publish', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(15, 'activity_reports.unpublish', 'activity_reports', 'unpublish', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(16, 'activity_reports.assign', 'activity_reports', 'assign', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(17, 'asset_classes.viewany', 'asset_classes', 'viewAny', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(18, 'asset_classes.view', 'asset_classes', 'view', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(19, 'asset_classes.create', 'asset_classes', 'create', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(20, 'asset_classes.update', 'asset_classes', 'update', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(21, 'asset_classes.delete', 'asset_classes', 'delete', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(22, 'asset_classes.restore', 'asset_classes', 'restore', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(23, 'asset_classes.forcedelete', 'asset_classes', 'forceDelete', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(24, 'asset_classes.export', 'asset_classes', 'export', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(25, 'asset_classes.import', 'asset_classes', 'import', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(26, 'asset_classes.approve', 'asset_classes', 'approve', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(27, 'asset_classes.reject', 'asset_classes', 'reject', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(28, 'asset_classes.archive', 'asset_classes', 'archive', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(29, 'asset_classes.unarchive', 'asset_classes', 'unarchive', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(30, 'asset_classes.publish', 'asset_classes', 'publish', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(31, 'asset_classes.unpublish', 'asset_classes', 'unpublish', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(32, 'asset_classes.assign', 'asset_classes', 'assign', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(33, 'a_t_m_reports.viewany', 'a_t_m_reports', 'viewAny', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(34, 'a_t_m_reports.view', 'a_t_m_reports', 'view', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(35, 'a_t_m_reports.create', 'a_t_m_reports', 'create', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(36, 'a_t_m_reports.update', 'a_t_m_reports', 'update', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(37, 'a_t_m_reports.delete', 'a_t_m_reports', 'delete', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(38, 'a_t_m_reports.restore', 'a_t_m_reports', 'restore', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(39, 'a_t_m_reports.forcedelete', 'a_t_m_reports', 'forceDelete', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(40, 'a_t_m_reports.export', 'a_t_m_reports', 'export', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(41, 'a_t_m_reports.import', 'a_t_m_reports', 'import', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(42, 'a_t_m_reports.approve', 'a_t_m_reports', 'approve', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(43, 'a_t_m_reports.reject', 'a_t_m_reports', 'reject', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(44, 'a_t_m_reports.archive', 'a_t_m_reports', 'archive', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(45, 'a_t_m_reports.unarchive', 'a_t_m_reports', 'unarchive', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(46, 'a_t_m_reports.publish', 'a_t_m_reports', 'publish', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(47, 'a_t_m_reports.unpublish', 'a_t_m_reports', 'unpublish', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(48, 'a_t_m_reports.assign', 'a_t_m_reports', 'assign', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(49, 'a_t_m_s.viewany', 'a_t_m_s', 'viewAny', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(50, 'a_t_m_s.view', 'a_t_m_s', 'view', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(51, 'a_t_m_s.create', 'a_t_m_s', 'create', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(52, 'a_t_m_s.update', 'a_t_m_s', 'update', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(53, 'a_t_m_s.delete', 'a_t_m_s', 'delete', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(54, 'a_t_m_s.restore', 'a_t_m_s', 'restore', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(55, 'a_t_m_s.forcedelete', 'a_t_m_s', 'forceDelete', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(56, 'a_t_m_s.export', 'a_t_m_s', 'export', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(57, 'a_t_m_s.import', 'a_t_m_s', 'import', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(58, 'a_t_m_s.approve', 'a_t_m_s', 'approve', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(59, 'a_t_m_s.reject', 'a_t_m_s', 'reject', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(60, 'a_t_m_s.archive', 'a_t_m_s', 'archive', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(61, 'a_t_m_s.unarchive', 'a_t_m_s', 'unarchive', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(62, 'a_t_m_s.publish', 'a_t_m_s', 'publish', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(63, 'a_t_m_s.unpublish', 'a_t_m_s', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(64, 'a_t_m_s.assign', 'a_t_m_s', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(65, 'branches.viewany', 'branches', 'viewAny', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(66, 'branches.view', 'branches', 'view', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(67, 'branches.create', 'branches', 'create', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(68, 'branches.update', 'branches', 'update', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(69, 'branches.delete', 'branches', 'delete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(70, 'branches.restore', 'branches', 'restore', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(71, 'branches.forcedelete', 'branches', 'forceDelete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(72, 'branches.export', 'branches', 'export', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(73, 'branches.import', 'branches', 'import', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(74, 'branches.approve', 'branches', 'approve', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(75, 'branches.reject', 'branches', 'reject', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(76, 'branches.archive', 'branches', 'archive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(77, 'branches.unarchive', 'branches', 'unarchive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(78, 'branches.publish', 'branches', 'publish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(79, 'branches.unpublish', 'branches', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(80, 'branches.assign', 'branches', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(81, 'cache.viewany', 'cache', 'viewAny', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(82, 'cache.view', 'cache', 'view', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(83, 'cache.create', 'cache', 'create', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(84, 'cache.update', 'cache', 'update', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(85, 'cache.delete', 'cache', 'delete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(86, 'cache.restore', 'cache', 'restore', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(87, 'cache.forcedelete', 'cache', 'forceDelete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(88, 'cache.export', 'cache', 'export', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(89, 'cache.import', 'cache', 'import', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(90, 'cache.approve', 'cache', 'approve', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(91, 'cache.reject', 'cache', 'reject', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(92, 'cache.archive', 'cache', 'archive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(93, 'cache.unarchive', 'cache', 'unarchive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(94, 'cache.publish', 'cache', 'publish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(95, 'cache.unpublish', 'cache', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(96, 'cache.assign', 'cache', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(97, 'cache_locks.viewany', 'cache_locks', 'viewAny', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(98, 'cache_locks.view', 'cache_locks', 'view', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(99, 'cache_locks.create', 'cache_locks', 'create', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(100, 'cache_locks.update', 'cache_locks', 'update', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(101, 'cache_locks.delete', 'cache_locks', 'delete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(102, 'cache_locks.restore', 'cache_locks', 'restore', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(103, 'cache_locks.forcedelete', 'cache_locks', 'forceDelete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(104, 'cache_locks.export', 'cache_locks', 'export', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(105, 'cache_locks.import', 'cache_locks', 'import', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(106, 'cache_locks.approve', 'cache_locks', 'approve', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(107, 'cache_locks.reject', 'cache_locks', 'reject', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(108, 'cache_locks.archive', 'cache_locks', 'archive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(109, 'cache_locks.unarchive', 'cache_locks', 'unarchive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(110, 'cache_locks.publish', 'cache_locks', 'publish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(111, 'cache_locks.unpublish', 'cache_locks', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(112, 'cache_locks.assign', 'cache_locks', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(113, 'computers.viewany', 'computers', 'viewAny', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(114, 'computers.view', 'computers', 'view', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(115, 'computers.create', 'computers', 'create', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(116, 'computers.update', 'computers', 'update', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(117, 'computers.delete', 'computers', 'delete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(118, 'computers.restore', 'computers', 'restore', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(119, 'computers.forcedelete', 'computers', 'forceDelete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(120, 'computers.export', 'computers', 'export', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(121, 'computers.import', 'computers', 'import', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(122, 'computers.approve', 'computers', 'approve', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(123, 'computers.reject', 'computers', 'reject', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(124, 'computers.archive', 'computers', 'archive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(125, 'computers.unarchive', 'computers', 'unarchive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(126, 'computers.publish', 'computers', 'publish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(127, 'computers.unpublish', 'computers', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(128, 'computers.assign', 'computers', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(129, 'computer_models.viewany', 'computer_models', 'viewAny', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(130, 'computer_models.view', 'computer_models', 'view', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(131, 'computer_models.create', 'computer_models', 'create', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(132, 'computer_models.update', 'computer_models', 'update', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(133, 'computer_models.delete', 'computer_models', 'delete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(134, 'computer_models.restore', 'computer_models', 'restore', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(135, 'computer_models.forcedelete', 'computer_models', 'forceDelete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(136, 'computer_models.export', 'computer_models', 'export', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(137, 'computer_models.import', 'computer_models', 'import', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(138, 'computer_models.approve', 'computer_models', 'approve', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(139, 'computer_models.reject', 'computer_models', 'reject', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(140, 'computer_models.archive', 'computer_models', 'archive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(141, 'computer_models.unarchive', 'computer_models', 'unarchive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(142, 'computer_models.publish', 'computer_models', 'publish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(143, 'computer_models.unpublish', 'computer_models', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(144, 'computer_models.assign', 'computer_models', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(145, 'data_v_p_n_s.viewany', 'data_v_p_n_s', 'viewAny', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(146, 'data_v_p_n_s.view', 'data_v_p_n_s', 'view', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(147, 'data_v_p_n_s.create', 'data_v_p_n_s', 'create', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(148, 'data_v_p_n_s.update', 'data_v_p_n_s', 'update', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(149, 'data_v_p_n_s.delete', 'data_v_p_n_s', 'delete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(150, 'data_v_p_n_s.restore', 'data_v_p_n_s', 'restore', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(151, 'data_v_p_n_s.forcedelete', 'data_v_p_n_s', 'forceDelete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(152, 'data_v_p_n_s.export', 'data_v_p_n_s', 'export', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(153, 'data_v_p_n_s.import', 'data_v_p_n_s', 'import', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(154, 'data_v_p_n_s.approve', 'data_v_p_n_s', 'approve', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(155, 'data_v_p_n_s.reject', 'data_v_p_n_s', 'reject', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(156, 'data_v_p_n_s.archive', 'data_v_p_n_s', 'archive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(157, 'data_v_p_n_s.unarchive', 'data_v_p_n_s', 'unarchive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(158, 'data_v_p_n_s.publish', 'data_v_p_n_s', 'publish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(159, 'data_v_p_n_s.unpublish', 'data_v_p_n_s', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(160, 'data_v_p_n_s.assign', 'data_v_p_n_s', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(161, 'deliverables.viewany', 'deliverables', 'viewAny', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(162, 'deliverables.view', 'deliverables', 'view', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(163, 'deliverables.create', 'deliverables', 'create', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(164, 'deliverables.update', 'deliverables', 'update', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(165, 'deliverables.delete', 'deliverables', 'delete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(166, 'deliverables.restore', 'deliverables', 'restore', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(167, 'deliverables.forcedelete', 'deliverables', 'forceDelete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(168, 'deliverables.export', 'deliverables', 'export', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(169, 'deliverables.import', 'deliverables', 'import', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(170, 'deliverables.approve', 'deliverables', 'approve', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(171, 'deliverables.reject', 'deliverables', 'reject', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(172, 'deliverables.archive', 'deliverables', 'archive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(173, 'deliverables.unarchive', 'deliverables', 'unarchive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(174, 'deliverables.publish', 'deliverables', 'publish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(175, 'deliverables.unpublish', 'deliverables', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(176, 'deliverables.assign', 'deliverables', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(177, 'districts.viewany', 'districts', 'viewAny', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(178, 'districts.view', 'districts', 'view', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(179, 'districts.create', 'districts', 'create', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(180, 'districts.update', 'districts', 'update', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(181, 'districts.delete', 'districts', 'delete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(182, 'districts.restore', 'districts', 'restore', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(183, 'districts.forcedelete', 'districts', 'forceDelete', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(184, 'districts.export', 'districts', 'export', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(185, 'districts.import', 'districts', 'import', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(186, 'districts.approve', 'districts', 'approve', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(187, 'districts.reject', 'districts', 'reject', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(188, 'districts.archive', 'districts', 'archive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(189, 'districts.unarchive', 'districts', 'unarchive', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(190, 'districts.publish', 'districts', 'publish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(191, 'districts.unpublish', 'districts', 'unpublish', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(192, 'districts.assign', 'districts', 'assign', '2026-01-09 08:44:34', '2026-01-09 08:44:34'),
(193, 'dongles.viewany', 'dongles', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(194, 'dongles.view', 'dongles', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(195, 'dongles.create', 'dongles', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(196, 'dongles.update', 'dongles', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(197, 'dongles.delete', 'dongles', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(198, 'dongles.restore', 'dongles', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(199, 'dongles.forcedelete', 'dongles', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(200, 'dongles.export', 'dongles', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(201, 'dongles.import', 'dongles', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(202, 'dongles.approve', 'dongles', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(203, 'dongles.reject', 'dongles', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(204, 'dongles.archive', 'dongles', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(205, 'dongles.unarchive', 'dongles', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(206, 'dongles.publish', 'dongles', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(207, 'dongles.unpublish', 'dongles', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(208, 'dongles.assign', 'dongles', 'assign', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(209, 'downtime_reasons.viewany', 'downtime_reasons', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(210, 'downtime_reasons.view', 'downtime_reasons', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(211, 'downtime_reasons.create', 'downtime_reasons', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(212, 'downtime_reasons.update', 'downtime_reasons', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(213, 'downtime_reasons.delete', 'downtime_reasons', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(214, 'downtime_reasons.restore', 'downtime_reasons', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(215, 'downtime_reasons.forcedelete', 'downtime_reasons', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(216, 'downtime_reasons.export', 'downtime_reasons', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(217, 'downtime_reasons.import', 'downtime_reasons', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(218, 'downtime_reasons.approve', 'downtime_reasons', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(219, 'downtime_reasons.reject', 'downtime_reasons', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(220, 'downtime_reasons.archive', 'downtime_reasons', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(221, 'downtime_reasons.unarchive', 'downtime_reasons', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(222, 'downtime_reasons.publish', 'downtime_reasons', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(223, 'downtime_reasons.unpublish', 'downtime_reasons', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(224, 'downtime_reasons.assign', 'downtime_reasons', 'assign', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(225, 'd_o_b_s.viewany', 'd_o_b_s', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(226, 'd_o_b_s.view', 'd_o_b_s', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(227, 'd_o_b_s.create', 'd_o_b_s', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(228, 'd_o_b_s.update', 'd_o_b_s', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(229, 'd_o_b_s.delete', 'd_o_b_s', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(230, 'd_o_b_s.restore', 'd_o_b_s', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(231, 'd_o_b_s.forcedelete', 'd_o_b_s', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(232, 'd_o_b_s.export', 'd_o_b_s', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(233, 'd_o_b_s.import', 'd_o_b_s', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(234, 'd_o_b_s.approve', 'd_o_b_s', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(235, 'd_o_b_s.reject', 'd_o_b_s', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(236, 'd_o_b_s.archive', 'd_o_b_s', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(237, 'd_o_b_s.unarchive', 'd_o_b_s', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(238, 'd_o_b_s.publish', 'd_o_b_s', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(239, 'd_o_b_s.unpublish', 'd_o_b_s', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(240, 'd_o_b_s.assign', 'd_o_b_s', 'assign', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(241, 'exports.viewany', 'exports', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(242, 'exports.view', 'exports', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(243, 'exports.create', 'exports', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(244, 'exports.update', 'exports', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(245, 'exports.delete', 'exports', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(246, 'exports.restore', 'exports', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(247, 'exports.forcedelete', 'exports', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(248, 'exports.export', 'exports', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(249, 'exports.import', 'exports', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(250, 'exports.approve', 'exports', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(251, 'exports.reject', 'exports', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(252, 'exports.archive', 'exports', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(253, 'exports.unarchive', 'exports', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(254, 'exports.publish', 'exports', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(255, 'exports.unpublish', 'exports', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(256, 'exports.assign', 'exports', 'assign', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(257, 'failed_import_rows.viewany', 'failed_import_rows', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(258, 'failed_import_rows.view', 'failed_import_rows', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(259, 'failed_import_rows.create', 'failed_import_rows', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(260, 'failed_import_rows.update', 'failed_import_rows', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(261, 'failed_import_rows.delete', 'failed_import_rows', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(262, 'failed_import_rows.restore', 'failed_import_rows', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(263, 'failed_import_rows.forcedelete', 'failed_import_rows', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(264, 'failed_import_rows.export', 'failed_import_rows', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(265, 'failed_import_rows.import', 'failed_import_rows', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(266, 'failed_import_rows.approve', 'failed_import_rows', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(267, 'failed_import_rows.reject', 'failed_import_rows', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(268, 'failed_import_rows.archive', 'failed_import_rows', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(269, 'failed_import_rows.unarchive', 'failed_import_rows', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(270, 'failed_import_rows.publish', 'failed_import_rows', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(271, 'failed_import_rows.unpublish', 'failed_import_rows', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(272, 'failed_import_rows.assign', 'failed_import_rows', 'assign', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(273, 'failed_jobs.viewany', 'failed_jobs', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(274, 'failed_jobs.view', 'failed_jobs', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(275, 'failed_jobs.create', 'failed_jobs', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(276, 'failed_jobs.update', 'failed_jobs', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(277, 'failed_jobs.delete', 'failed_jobs', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(278, 'failed_jobs.restore', 'failed_jobs', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(279, 'failed_jobs.forcedelete', 'failed_jobs', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(280, 'failed_jobs.export', 'failed_jobs', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(281, 'failed_jobs.import', 'failed_jobs', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(282, 'failed_jobs.approve', 'failed_jobs', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(283, 'failed_jobs.reject', 'failed_jobs', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(284, 'failed_jobs.archive', 'failed_jobs', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(285, 'failed_jobs.unarchive', 'failed_jobs', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(286, 'failed_jobs.publish', 'failed_jobs', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(287, 'failed_jobs.unpublish', 'failed_jobs', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(288, 'failed_jobs.assign', 'failed_jobs', 'assign', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(289, 'fixed_lines.viewany', 'fixed_lines', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(290, 'fixed_lines.view', 'fixed_lines', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(291, 'fixed_lines.create', 'fixed_lines', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(292, 'fixed_lines.update', 'fixed_lines', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(293, 'fixed_lines.delete', 'fixed_lines', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(294, 'fixed_lines.restore', 'fixed_lines', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(295, 'fixed_lines.forcedelete', 'fixed_lines', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(296, 'fixed_lines.export', 'fixed_lines', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(297, 'fixed_lines.import', 'fixed_lines', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(298, 'fixed_lines.approve', 'fixed_lines', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(299, 'fixed_lines.reject', 'fixed_lines', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(300, 'fixed_lines.archive', 'fixed_lines', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(301, 'fixed_lines.unarchive', 'fixed_lines', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(302, 'fixed_lines.publish', 'fixed_lines', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(303, 'fixed_lines.unpublish', 'fixed_lines', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(304, 'fixed_lines.assign', 'fixed_lines', 'assign', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(305, 'group_permission.viewany', 'group_permission', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(306, 'group_permission.view', 'group_permission', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(307, 'group_permission.create', 'group_permission', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(308, 'group_permission.update', 'group_permission', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(309, 'group_permission.delete', 'group_permission', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(310, 'group_permission.restore', 'group_permission', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(311, 'group_permission.forcedelete', 'group_permission', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(312, 'group_permission.export', 'group_permission', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(313, 'group_permission.import', 'group_permission', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(314, 'group_permission.approve', 'group_permission', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(315, 'group_permission.reject', 'group_permission', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(316, 'group_permission.archive', 'group_permission', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(317, 'group_permission.unarchive', 'group_permission', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(318, 'group_permission.publish', 'group_permission', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(319, 'group_permission.unpublish', 'group_permission', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(320, 'group_permission.assign', 'group_permission', 'assign', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(321, 'h_q_s.viewany', 'h_q_s', 'viewAny', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(322, 'h_q_s.view', 'h_q_s', 'view', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(323, 'h_q_s.create', 'h_q_s', 'create', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(324, 'h_q_s.update', 'h_q_s', 'update', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(325, 'h_q_s.delete', 'h_q_s', 'delete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(326, 'h_q_s.restore', 'h_q_s', 'restore', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(327, 'h_q_s.forcedelete', 'h_q_s', 'forceDelete', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(328, 'h_q_s.export', 'h_q_s', 'export', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(329, 'h_q_s.import', 'h_q_s', 'import', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(330, 'h_q_s.approve', 'h_q_s', 'approve', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(331, 'h_q_s.reject', 'h_q_s', 'reject', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(332, 'h_q_s.archive', 'h_q_s', 'archive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(333, 'h_q_s.unarchive', 'h_q_s', 'unarchive', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(334, 'h_q_s.publish', 'h_q_s', 'publish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(335, 'h_q_s.unpublish', 'h_q_s', 'unpublish', '2026-01-09 08:44:35', '2026-01-09 08:44:35'),
(336, 'h_q_s.assign', 'h_q_s', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(337, 'imports.viewany', 'imports', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(338, 'imports.view', 'imports', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(339, 'imports.create', 'imports', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(340, 'imports.update', 'imports', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(341, 'imports.delete', 'imports', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(342, 'imports.restore', 'imports', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(343, 'imports.forcedelete', 'imports', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(344, 'imports.export', 'imports', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(345, 'imports.import', 'imports', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(346, 'imports.approve', 'imports', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(347, 'imports.reject', 'imports', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(348, 'imports.archive', 'imports', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(349, 'imports.unarchive', 'imports', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(350, 'imports.publish', 'imports', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(351, 'imports.unpublish', 'imports', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(352, 'imports.assign', 'imports', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(353, 'jobs.viewany', 'jobs', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(354, 'jobs.view', 'jobs', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(355, 'jobs.create', 'jobs', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(356, 'jobs.update', 'jobs', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(357, 'jobs.delete', 'jobs', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(358, 'jobs.restore', 'jobs', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(359, 'jobs.forcedelete', 'jobs', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(360, 'jobs.export', 'jobs', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(361, 'jobs.import', 'jobs', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(362, 'jobs.approve', 'jobs', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(363, 'jobs.reject', 'jobs', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(364, 'jobs.archive', 'jobs', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(365, 'jobs.unarchive', 'jobs', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(366, 'jobs.publish', 'jobs', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(367, 'jobs.unpublish', 'jobs', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(368, 'jobs.assign', 'jobs', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(369, 'job_batches.viewany', 'job_batches', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(370, 'job_batches.view', 'job_batches', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(371, 'job_batches.create', 'job_batches', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(372, 'job_batches.update', 'job_batches', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(373, 'job_batches.delete', 'job_batches', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(374, 'job_batches.restore', 'job_batches', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(375, 'job_batches.forcedelete', 'job_batches', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(376, 'job_batches.export', 'job_batches', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(377, 'job_batches.import', 'job_batches', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(378, 'job_batches.approve', 'job_batches', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(379, 'job_batches.reject', 'job_batches', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(380, 'job_batches.archive', 'job_batches', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(381, 'job_batches.unarchive', 'job_batches', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(382, 'job_batches.publish', 'job_batches', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(383, 'job_batches.unpublish', 'job_batches', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(384, 'job_batches.assign', 'job_batches', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(385, 'migrations.viewany', 'migrations', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(386, 'migrations.view', 'migrations', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(387, 'migrations.create', 'migrations', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(388, 'migrations.update', 'migrations', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(389, 'migrations.delete', 'migrations', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(390, 'migrations.restore', 'migrations', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(391, 'migrations.forcedelete', 'migrations', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(392, 'migrations.export', 'migrations', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(393, 'migrations.import', 'migrations', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(394, 'migrations.approve', 'migrations', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(395, 'migrations.reject', 'migrations', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(396, 'migrations.archive', 'migrations', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(397, 'migrations.unarchive', 'migrations', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(398, 'migrations.publish', 'migrations', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(399, 'migrations.unpublish', 'migrations', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(400, 'migrations.assign', 'migrations', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(401, 'model_has_permissions.viewany', 'model_has_permissions', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(402, 'model_has_permissions.view', 'model_has_permissions', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(403, 'model_has_permissions.create', 'model_has_permissions', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(404, 'model_has_permissions.update', 'model_has_permissions', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(405, 'model_has_permissions.delete', 'model_has_permissions', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(406, 'model_has_permissions.restore', 'model_has_permissions', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(407, 'model_has_permissions.forcedelete', 'model_has_permissions', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(408, 'model_has_permissions.export', 'model_has_permissions', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(409, 'model_has_permissions.import', 'model_has_permissions', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(410, 'model_has_permissions.approve', 'model_has_permissions', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(411, 'model_has_permissions.reject', 'model_has_permissions', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(412, 'model_has_permissions.archive', 'model_has_permissions', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(413, 'model_has_permissions.unarchive', 'model_has_permissions', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(414, 'model_has_permissions.publish', 'model_has_permissions', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(415, 'model_has_permissions.unpublish', 'model_has_permissions', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(416, 'model_has_permissions.assign', 'model_has_permissions', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(417, 'model_has_roles.viewany', 'model_has_roles', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(418, 'model_has_roles.view', 'model_has_roles', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(419, 'model_has_roles.create', 'model_has_roles', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(420, 'model_has_roles.update', 'model_has_roles', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(421, 'model_has_roles.delete', 'model_has_roles', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(422, 'model_has_roles.restore', 'model_has_roles', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(423, 'model_has_roles.forcedelete', 'model_has_roles', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(424, 'model_has_roles.export', 'model_has_roles', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(425, 'model_has_roles.import', 'model_has_roles', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(426, 'model_has_roles.approve', 'model_has_roles', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(427, 'model_has_roles.reject', 'model_has_roles', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(428, 'model_has_roles.archive', 'model_has_roles', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(429, 'model_has_roles.unarchive', 'model_has_roles', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(430, 'model_has_roles.publish', 'model_has_roles', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(431, 'model_has_roles.unpublish', 'model_has_roles', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(432, 'model_has_roles.assign', 'model_has_roles', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(433, 'other_assets.viewany', 'other_assets', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(434, 'other_assets.view', 'other_assets', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(435, 'other_assets.create', 'other_assets', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(436, 'other_assets.update', 'other_assets', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(437, 'other_assets.delete', 'other_assets', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(438, 'other_assets.restore', 'other_assets', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(439, 'other_assets.forcedelete', 'other_assets', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(440, 'other_assets.export', 'other_assets', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(441, 'other_assets.import', 'other_assets', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(442, 'other_assets.approve', 'other_assets', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(443, 'other_assets.reject', 'other_assets', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(444, 'other_assets.archive', 'other_assets', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(445, 'other_assets.unarchive', 'other_assets', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(446, 'other_assets.publish', 'other_assets', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(447, 'other_assets.unpublish', 'other_assets', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(448, 'other_assets.assign', 'other_assets', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(449, 'outlets.viewany', 'outlets', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(450, 'outlets.view', 'outlets', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(451, 'outlets.create', 'outlets', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(452, 'outlets.update', 'outlets', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(453, 'outlets.delete', 'outlets', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(454, 'outlets.restore', 'outlets', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(455, 'outlets.forcedelete', 'outlets', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(456, 'outlets.export', 'outlets', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(457, 'outlets.import', 'outlets', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(458, 'outlets.approve', 'outlets', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(459, 'outlets.reject', 'outlets', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(460, 'outlets.archive', 'outlets', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(461, 'outlets.unarchive', 'outlets', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(462, 'outlets.publish', 'outlets', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(463, 'outlets.unpublish', 'outlets', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(464, 'outlets.assign', 'outlets', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(465, 'o_u_s.viewany', 'o_u_s', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(466, 'o_u_s.view', 'o_u_s', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(467, 'o_u_s.create', 'o_u_s', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(468, 'o_u_s.update', 'o_u_s', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(469, 'o_u_s.delete', 'o_u_s', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(470, 'o_u_s.restore', 'o_u_s', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(471, 'o_u_s.forcedelete', 'o_u_s', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(472, 'o_u_s.export', 'o_u_s', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(473, 'o_u_s.import', 'o_u_s', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(474, 'o_u_s.approve', 'o_u_s', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(475, 'o_u_s.reject', 'o_u_s', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(476, 'o_u_s.archive', 'o_u_s', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(477, 'o_u_s.unarchive', 'o_u_s', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(478, 'o_u_s.publish', 'o_u_s', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(479, 'o_u_s.unpublish', 'o_u_s', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(480, 'o_u_s.assign', 'o_u_s', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(481, 'password_reset_tokens.viewany', 'password_reset_tokens', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(482, 'password_reset_tokens.view', 'password_reset_tokens', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(483, 'password_reset_tokens.create', 'password_reset_tokens', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(484, 'password_reset_tokens.update', 'password_reset_tokens', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(485, 'password_reset_tokens.delete', 'password_reset_tokens', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(486, 'password_reset_tokens.restore', 'password_reset_tokens', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(487, 'password_reset_tokens.forcedelete', 'password_reset_tokens', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(488, 'password_reset_tokens.export', 'password_reset_tokens', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(489, 'password_reset_tokens.import', 'password_reset_tokens', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(490, 'password_reset_tokens.approve', 'password_reset_tokens', 'approve', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(491, 'password_reset_tokens.reject', 'password_reset_tokens', 'reject', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(492, 'password_reset_tokens.archive', 'password_reset_tokens', 'archive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(493, 'password_reset_tokens.unarchive', 'password_reset_tokens', 'unarchive', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(494, 'password_reset_tokens.publish', 'password_reset_tokens', 'publish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(495, 'password_reset_tokens.unpublish', 'password_reset_tokens', 'unpublish', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(496, 'password_reset_tokens.assign', 'password_reset_tokens', 'assign', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(497, 'permissions.viewany', 'permissions', 'viewAny', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(498, 'permissions.view', 'permissions', 'view', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(499, 'permissions.create', 'permissions', 'create', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(500, 'permissions.update', 'permissions', 'update', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(501, 'permissions.delete', 'permissions', 'delete', '2026-01-09 08:44:36', '2026-01-09 08:44:36');
INSERT INTO `permissions` (`id`, `name`, `model`, `action`, `created_at`, `updated_at`) VALUES
(502, 'permissions.restore', 'permissions', 'restore', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(503, 'permissions.forcedelete', 'permissions', 'forceDelete', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(504, 'permissions.export', 'permissions', 'export', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(505, 'permissions.import', 'permissions', 'import', '2026-01-09 08:44:36', '2026-01-09 08:44:36'),
(506, 'permissions.approve', 'permissions', 'approve', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(507, 'permissions.reject', 'permissions', 'reject', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(508, 'permissions.archive', 'permissions', 'archive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(509, 'permissions.unarchive', 'permissions', 'unarchive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(510, 'permissions.publish', 'permissions', 'publish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(511, 'permissions.unpublish', 'permissions', 'unpublish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(512, 'permissions.assign', 'permissions', 'assign', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(513, 'photocopies.viewany', 'photocopies', 'viewAny', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(514, 'photocopies.view', 'photocopies', 'view', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(515, 'photocopies.create', 'photocopies', 'create', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(516, 'photocopies.update', 'photocopies', 'update', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(517, 'photocopies.delete', 'photocopies', 'delete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(518, 'photocopies.restore', 'photocopies', 'restore', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(519, 'photocopies.forcedelete', 'photocopies', 'forceDelete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(520, 'photocopies.export', 'photocopies', 'export', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(521, 'photocopies.import', 'photocopies', 'import', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(522, 'photocopies.approve', 'photocopies', 'approve', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(523, 'photocopies.reject', 'photocopies', 'reject', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(524, 'photocopies.archive', 'photocopies', 'archive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(525, 'photocopies.unarchive', 'photocopies', 'unarchive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(526, 'photocopies.publish', 'photocopies', 'publish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(527, 'photocopies.unpublish', 'photocopies', 'unpublish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(528, 'photocopies.assign', 'photocopies', 'assign', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(529, 'pos.viewany', 'pos', 'viewAny', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(530, 'pos.view', 'pos', 'view', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(531, 'pos.create', 'pos', 'create', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(532, 'pos.update', 'pos', 'update', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(533, 'pos.delete', 'pos', 'delete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(534, 'pos.restore', 'pos', 'restore', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(535, 'pos.forcedelete', 'pos', 'forceDelete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(536, 'pos.export', 'pos', 'export', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(537, 'pos.import', 'pos', 'import', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(538, 'pos.approve', 'pos', 'approve', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(539, 'pos.reject', 'pos', 'reject', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(540, 'pos.archive', 'pos', 'archive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(541, 'pos.unarchive', 'pos', 'unarchive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(542, 'pos.publish', 'pos', 'publish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(543, 'pos.unpublish', 'pos', 'unpublish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(544, 'pos.assign', 'pos', 'assign', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(545, 'printers.viewany', 'printers', 'viewAny', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(546, 'printers.view', 'printers', 'view', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(547, 'printers.create', 'printers', 'create', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(548, 'printers.update', 'printers', 'update', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(549, 'printers.delete', 'printers', 'delete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(550, 'printers.restore', 'printers', 'restore', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(551, 'printers.forcedelete', 'printers', 'forceDelete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(552, 'printers.export', 'printers', 'export', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(553, 'printers.import', 'printers', 'import', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(554, 'printers.approve', 'printers', 'approve', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(555, 'printers.reject', 'printers', 'reject', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(556, 'printers.archive', 'printers', 'archive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(557, 'printers.unarchive', 'printers', 'unarchive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(558, 'printers.publish', 'printers', 'publish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(559, 'printers.unpublish', 'printers', 'unpublish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(560, 'printers.assign', 'printers', 'assign', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(561, 'roles.viewany', 'roles', 'viewAny', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(562, 'roles.view', 'roles', 'view', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(563, 'roles.create', 'roles', 'create', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(564, 'roles.update', 'roles', 'update', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(565, 'roles.delete', 'roles', 'delete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(566, 'roles.restore', 'roles', 'restore', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(567, 'roles.forcedelete', 'roles', 'forceDelete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(568, 'roles.export', 'roles', 'export', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(569, 'roles.import', 'roles', 'import', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(570, 'roles.approve', 'roles', 'approve', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(571, 'roles.reject', 'roles', 'reject', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(572, 'roles.archive', 'roles', 'archive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(573, 'roles.unarchive', 'roles', 'unarchive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(574, 'roles.publish', 'roles', 'publish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(575, 'roles.unpublish', 'roles', 'unpublish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(576, 'roles.assign', 'roles', 'assign', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(577, 'role_has_permissions.viewany', 'role_has_permissions', 'viewAny', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(578, 'role_has_permissions.view', 'role_has_permissions', 'view', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(579, 'role_has_permissions.create', 'role_has_permissions', 'create', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(580, 'role_has_permissions.update', 'role_has_permissions', 'update', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(581, 'role_has_permissions.delete', 'role_has_permissions', 'delete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(582, 'role_has_permissions.restore', 'role_has_permissions', 'restore', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(583, 'role_has_permissions.forcedelete', 'role_has_permissions', 'forceDelete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(584, 'role_has_permissions.export', 'role_has_permissions', 'export', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(585, 'role_has_permissions.import', 'role_has_permissions', 'import', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(586, 'role_has_permissions.approve', 'role_has_permissions', 'approve', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(587, 'role_has_permissions.reject', 'role_has_permissions', 'reject', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(588, 'role_has_permissions.archive', 'role_has_permissions', 'archive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(589, 'role_has_permissions.unarchive', 'role_has_permissions', 'unarchive', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(590, 'role_has_permissions.publish', 'role_has_permissions', 'publish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(591, 'role_has_permissions.unpublish', 'role_has_permissions', 'unpublish', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(592, 'role_has_permissions.assign', 'role_has_permissions', 'assign', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(593, 'scanners.viewany', 'scanners', 'viewAny', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(594, 'scanners.view', 'scanners', 'view', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(595, 'scanners.create', 'scanners', 'create', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(596, 'scanners.update', 'scanners', 'update', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(597, 'scanners.delete', 'scanners', 'delete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(598, 'scanners.restore', 'scanners', 'restore', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(599, 'scanners.forcedelete', 'scanners', 'forceDelete', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(600, 'scanners.export', 'scanners', 'export', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(601, 'scanners.import', 'scanners', 'import', '2026-01-09 08:44:37', '2026-01-09 08:44:37'),
(602, 'scanners.approve', 'scanners', 'approve', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(603, 'scanners.reject', 'scanners', 'reject', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(604, 'scanners.archive', 'scanners', 'archive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(605, 'scanners.unarchive', 'scanners', 'unarchive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(606, 'scanners.publish', 'scanners', 'publish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(607, 'scanners.unpublish', 'scanners', 'unpublish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(608, 'scanners.assign', 'scanners', 'assign', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(609, 'sessions.viewany', 'sessions', 'viewAny', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(610, 'sessions.view', 'sessions', 'view', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(611, 'sessions.create', 'sessions', 'create', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(612, 'sessions.update', 'sessions', 'update', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(613, 'sessions.delete', 'sessions', 'delete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(614, 'sessions.restore', 'sessions', 'restore', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(615, 'sessions.forcedelete', 'sessions', 'forceDelete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(616, 'sessions.export', 'sessions', 'export', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(617, 'sessions.import', 'sessions', 'import', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(618, 'sessions.approve', 'sessions', 'approve', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(619, 'sessions.reject', 'sessions', 'reject', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(620, 'sessions.archive', 'sessions', 'archive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(621, 'sessions.unarchive', 'sessions', 'unarchive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(622, 'sessions.publish', 'sessions', 'publish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(623, 'sessions.unpublish', 'sessions', 'unpublish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(624, 'sessions.assign', 'sessions', 'assign', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(625, 'tasks.viewany', 'tasks', 'viewAny', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(626, 'tasks.view', 'tasks', 'view', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(627, 'tasks.create', 'tasks', 'create', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(628, 'tasks.update', 'tasks', 'update', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(629, 'tasks.delete', 'tasks', 'delete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(630, 'tasks.restore', 'tasks', 'restore', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(631, 'tasks.forcedelete', 'tasks', 'forceDelete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(632, 'tasks.export', 'tasks', 'export', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(633, 'tasks.import', 'tasks', 'import', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(634, 'tasks.approve', 'tasks', 'approve', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(635, 'tasks.reject', 'tasks', 'reject', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(636, 'tasks.archive', 'tasks', 'archive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(637, 'tasks.unarchive', 'tasks', 'unarchive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(638, 'tasks.publish', 'tasks', 'publish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(639, 'tasks.unpublish', 'tasks', 'unpublish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(640, 'tasks.assign', 'tasks', 'assign', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(641, 'task_categories.viewany', 'task_categories', 'viewAny', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(642, 'task_categories.view', 'task_categories', 'view', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(643, 'task_categories.create', 'task_categories', 'create', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(644, 'task_categories.update', 'task_categories', 'update', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(645, 'task_categories.delete', 'task_categories', 'delete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(646, 'task_categories.restore', 'task_categories', 'restore', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(647, 'task_categories.forcedelete', 'task_categories', 'forceDelete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(648, 'task_categories.export', 'task_categories', 'export', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(649, 'task_categories.import', 'task_categories', 'import', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(650, 'task_categories.approve', 'task_categories', 'approve', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(651, 'task_categories.reject', 'task_categories', 'reject', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(652, 'task_categories.archive', 'task_categories', 'archive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(653, 'task_categories.unarchive', 'task_categories', 'unarchive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(654, 'task_categories.publish', 'task_categories', 'publish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(655, 'task_categories.unpublish', 'task_categories', 'unpublish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(656, 'task_categories.assign', 'task_categories', 'assign', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(657, 'users.viewany', 'users', 'viewAny', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(658, 'users.view', 'users', 'view', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(659, 'users.create', 'users', 'create', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(660, 'users.update', 'users', 'update', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(661, 'users.delete', 'users', 'delete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(662, 'users.restore', 'users', 'restore', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(663, 'users.forcedelete', 'users', 'forceDelete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(664, 'users.export', 'users', 'export', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(665, 'users.import', 'users', 'import', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(666, 'users.approve', 'users', 'approve', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(667, 'users.reject', 'users', 'reject', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(668, 'users.archive', 'users', 'archive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(669, 'users.unarchive', 'users', 'unarchive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(670, 'users.publish', 'users', 'publish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(671, 'users.unpublish', 'users', 'unpublish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(672, 'users.assign', 'users', 'assign', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(673, 'user_groups.viewany', 'user_groups', 'viewAny', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(674, 'user_groups.view', 'user_groups', 'view', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(675, 'user_groups.create', 'user_groups', 'create', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(676, 'user_groups.update', 'user_groups', 'update', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(677, 'user_groups.delete', 'user_groups', 'delete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(678, 'user_groups.restore', 'user_groups', 'restore', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(679, 'user_groups.forcedelete', 'user_groups', 'forceDelete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(680, 'user_groups.export', 'user_groups', 'export', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(681, 'user_groups.import', 'user_groups', 'import', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(682, 'user_groups.approve', 'user_groups', 'approve', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(683, 'user_groups.reject', 'user_groups', 'reject', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(684, 'user_groups.archive', 'user_groups', 'archive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(685, 'user_groups.unarchive', 'user_groups', 'unarchive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(686, 'user_groups.publish', 'user_groups', 'publish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(687, 'user_groups.unpublish', 'user_groups', 'unpublish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(688, 'user_groups.assign', 'user_groups', 'assign', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(689, 'user_user_group.viewany', 'user_user_group', 'viewAny', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(690, 'user_user_group.view', 'user_user_group', 'view', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(691, 'user_user_group.create', 'user_user_group', 'create', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(692, 'user_user_group.update', 'user_user_group', 'update', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(693, 'user_user_group.delete', 'user_user_group', 'delete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(694, 'user_user_group.restore', 'user_user_group', 'restore', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(695, 'user_user_group.forcedelete', 'user_user_group', 'forceDelete', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(696, 'user_user_group.export', 'user_user_group', 'export', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(697, 'user_user_group.import', 'user_user_group', 'import', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(698, 'user_user_group.approve', 'user_user_group', 'approve', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(699, 'user_user_group.reject', 'user_user_group', 'reject', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(700, 'user_user_group.archive', 'user_user_group', 'archive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(701, 'user_user_group.unarchive', 'user_user_group', 'unarchive', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(702, 'user_user_group.publish', 'user_user_group', 'publish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(703, 'user_user_group.unpublish', 'user_user_group', 'unpublish', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(704, 'user_user_group.assign', 'user_user_group', 'assign', '2026-01-09 08:44:38', '2026-01-09 08:44:38');

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
(1, 'Quarter I : 2018', '2025-07-08', '2025-10-10', 'First quarter of Ethiopian Fiscal Year 2018', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(2, 'Quarter II : 2018', '2025-10-11', '2026-01-08', 'Second quarter of Ethiopian Fiscal Year 2018', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(3, 'Quarter III : 2018', '2026-01-09', '2026-04-08', 'Third quarter of Ethiopian Fiscal Year 2018', '2026-01-09 08:44:38', '2026-01-09 08:44:38'),
(4, 'Quarter IV : 2018', '2026-04-09', '2026-07-07', 'Fourth quarter of Ethiopian Fiscal Year 2018', '2026-01-09 08:44:38', '2026-01-09 08:44:38');

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
(1, 2, 'Operating System Re-installation', '192.168.163.113', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(2, 2, 'From Window 10 to Window 11 Upgrade', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(3, 1, 'Hard Drive Replacement', '192.168.163.110', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(4, 1, 'CMOS Battry Replacement', '192.168.163.87', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(5, 1, 'Power supply Replacement', '192.168.163.45', '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(6, 12, 'Office letter preparation for Ethiotelecomn', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(7, 11, 'Kasper database update', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33');

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
(1, 'Hardware Mainatinance', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(2, 'Sofware Maintenance', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(3, 'User Support on Smart Desk', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(4, 'Network Incident Follow up', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(5, 'ATM Vendor Communication', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(6, 'ATM Support', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(7, 'ATM and Branch Relocation', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(8, 'Branch Opening', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(9, 'Switch Configuration', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(10, 'LAN Installation', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(11, 'Kasper Anntivirus: Agent, database update and license push', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33'),
(12, 'Ethiotelecom Communication', NULL, '2026-01-09 08:44:33', '2026-01-09 08:44:33');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fname`, `mname`, `lname`, `email`, `phone`, `address`, `branch_id`, `isActive`, `role`, `employee_id`, `has_email_authentication`, `email_verified_at`, `password`, `password_changed_at`, `force_password_change`, `remember_token`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'Abebe', 'Seid', 'Mohammed', 'Seid', 'seid.mohammedseid@dashenbanksc.com', '0985192541', 'Jimma', 1, 1, 'admin', '1', 0, '2026-01-09 08:44:31', '$2y$12$SzSltzBZd5MLAozNCCOKMurlkVw.acAEC28Z59V/PhWtbJAGBTaoO', NULL, 0, NULL, '2026-01-09 08:44:31', '2026-01-09 08:44:31', NULL);

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
(1, 'admin', 'Super Admin', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(2, 'uadmin', 'System administrator', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(3, 'branch', 'Branch', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(4, 'head', 'Head', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(5, 'stocker', 'Stocker', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(6, 'om', 'Operation Manager', '2026-01-09 08:44:30', '2026-01-09 08:44:30'),
(7, 'sm', 'Senoir Manager', '2026-01-09 08:44:30', '2026-01-09 08:44:30');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
