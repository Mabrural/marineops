-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2026 at 03:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marineops`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT '1',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#1572E8',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amprahans`
--

CREATE TABLE `amprahans` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `vessel_id` bigint UNSIGNED NOT NULL,
  `supply_date` date NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(15,2) DEFAULT NULL,
  `total_price` decimal(15,2) DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amprahans`
--

INSERT INTO `amprahans` (`id`, `company_id`, `vessel_id`, `supply_date`, `item`, `specification`, `qty`, `unit`, `vendor_name`, `unit_price`, `total_price`, `created_by`, `created_at`, `updated_at`) VALUES
(15, 11, 8, '2026-07-22', 'Oli', 'SAE', 1, 'unit', NULL, 10000.00, 10000.00, 7, '2026-07-24 06:19:10', '2026-07-24 06:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `vessel_id` bigint UNSIGNED NOT NULL,
  `asset_group_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `company_id`, `vessel_id`, `asset_group_id`, `name`, `model`, `qty`, `remarks`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 9, 7, 4, 'GPS', 'GP-32', 1, 'Baik (By  Welly)', 6, '2026-03-02 06:18:01', '2026-05-09 06:22:29'),
(5, 9, 7, 4, 'AIS', 'M-500', 1, 'Antenna kurang baik', 6, '2026-03-02 06:18:30', '2026-03-02 06:18:30'),
(6, 9, 7, 4, 'Radar', '1715', 1, 'Kabel power tidak ada', 6, '2026-03-02 06:19:24', '2026-03-02 06:22:57'),
(7, 9, 7, 4, 'Ecosonder', 'JRC FF-50', 1, 'Baik', 6, '2026-03-02 06:24:15', '2026-03-02 06:37:31'),
(8, 9, 7, 4, 'VHF', 'M-504', 1, 'Baik', 6, '2026-03-02 06:29:13', '2026-03-02 06:29:13'),
(9, 9, 7, 4, 'Navtex', 'NCA-300A', 1, 'Baik', 6, '2026-03-02 06:29:40', '2026-03-02 06:29:40'),
(10, 9, 7, 4, 'SSB', 'M-700', 1, 'Baik', 6, '2026-03-02 06:30:47', '2026-03-02 06:30:47'),
(11, 9, 7, 4, 'Kompas', NULL, 1, 'Belum dikalibrasi', 6, '2026-03-02 06:31:52', '2026-03-02 07:15:33'),
(12, 9, 7, 4, 'Barometer', NULL, 1, 'Baik', 6, '2026-03-02 06:32:21', '2026-03-02 07:11:20'),
(13, 9, 7, 4, 'Clino Meter', NULL, 1, 'Baik', 6, '2026-03-02 06:32:39', '2026-03-02 06:32:39'),
(14, 9, 7, 4, 'SearLighth', NULL, 0, 'Std 1 Unit', 6, '2026-03-02 06:33:10', '2026-03-02 06:36:13'),
(15, 9, 7, 4, 'Wiper', NULL, 1, 'Baik', 6, '2026-03-02 06:36:38', '2026-03-02 07:16:10'),
(16, 9, 7, 4, 'Bendera Isyarat', NULL, 1, 'Baik', 6, '2026-03-02 06:36:55', '2026-03-02 07:15:51'),
(17, 9, 7, 8, 'Apar Dry Chemical', NULL, 2, 'Baik', 6, '2026-03-02 06:43:08', '2026-03-02 06:43:08'),
(18, 9, 7, 8, 'Apar Foam', NULL, 7, 'Baik', 6, '2026-03-02 06:43:25', '2026-03-02 06:43:25'),
(19, 9, 7, 8, 'Apar CO2', NULL, 0, 'Std 2 unit 6 Kg', 6, '2026-03-02 06:45:36', '2026-03-02 06:45:36'),
(20, 9, 7, 8, 'Emergency Fire Pump', NULL, 1, 'Baik', 6, '2026-03-02 06:46:02', '2026-03-02 06:46:02'),
(21, 9, 7, 8, 'Fire Hose', NULL, 3, 'Baik', 6, '2026-03-02 06:46:27', '2026-03-02 06:46:27'),
(22, 9, 7, 8, 'Fire Nozzel', NULL, 3, 'Baik', 6, '2026-03-02 06:46:43', '2026-03-02 06:46:43'),
(23, 9, 7, 8, 'Baju Tahan Api', NULL, 0, NULL, 6, '2026-03-02 06:47:06', '2026-03-02 06:47:06'),
(24, 9, 7, 8, 'EEBD', NULL, 0, 'Std 2 unit', 6, '2026-03-02 06:47:26', '2026-03-02 06:47:26'),
(25, 9, 7, 8, 'ISC', NULL, 0, NULL, 6, '2026-03-02 06:47:43', '2026-03-02 06:48:26'),
(26, 9, 7, 8, 'Fire Blangket', NULL, 0, 'Std 1 unit', 6, '2026-03-02 06:48:19', '2026-03-02 06:48:19'),
(27, 9, 7, 8, 'Smoke Detector', NULL, 1, 'Std 3 Pcs (ER-Galley-Cabin Crew)', 6, '2026-03-02 06:49:07', '2026-03-02 06:49:07'),
(28, 9, 7, 8, 'Fire Alarm', NULL, 3, 'Baik', 6, '2026-03-02 06:49:29', '2026-03-02 06:49:29'),
(29, 9, 7, 8, 'Fire Plan', NULL, 0, 'Std 2 unit', 6, '2026-03-02 06:50:24', '2026-03-02 06:50:24'),
(30, 9, 7, 9, 'Liferaft', NULL, 1, 'Std 2 unit', 6, '2026-03-02 06:51:03', '2026-03-02 06:51:03'),
(31, 9, 7, 9, 'Lifebouy', NULL, 8, NULL, 6, '2026-03-02 06:51:19', '2026-03-02 06:51:19'),
(32, 9, 7, 9, 'Line life', NULL, 2, NULL, 6, '2026-03-02 06:51:42', '2026-03-02 06:51:42'),
(33, 9, 7, 9, 'Lampu Lifebouy', NULL, 2, NULL, 6, '2026-03-02 06:51:58', '2026-03-02 06:51:58'),
(34, 9, 7, 9, 'Life Jacket', NULL, 10, NULL, 6, '2026-03-02 06:52:15', '2026-03-02 06:52:15'),
(35, 9, 7, 9, 'Pluit', NULL, 10, NULL, 6, '2026-03-02 06:52:32', '2026-03-02 06:52:32'),
(36, 9, 7, 9, 'Lampu Life Jacket', NULL, 10, NULL, 6, '2026-03-02 06:52:49', '2026-03-02 06:52:49'),
(37, 9, 7, 9, 'Line Trowing', NULL, 0, 'Std 1 unit', 6, '2026-03-02 06:53:09', '2026-03-02 06:53:09'),
(38, 9, 7, 9, 'Rocket Parasut Flare', NULL, 6, NULL, 6, '2026-03-02 06:53:37', '2026-03-02 06:53:37'),
(39, 9, 7, 9, 'Red Hand Flare', NULL, 4, NULL, 6, '2026-03-02 06:54:03', '2026-03-02 06:54:03'),
(40, 9, 7, 9, 'Smoke Signal', NULL, 4, NULL, 6, '2026-03-02 06:54:25', '2026-03-02 06:54:25'),
(41, 9, 7, 9, 'MOB', NULL, 0, NULL, 6, '2026-03-02 06:54:36', '2026-03-02 06:54:36'),
(42, 9, 7, 9, 'SART', NULL, 1, NULL, 6, '2026-03-02 06:54:51', '2026-03-02 06:54:51'),
(43, 9, 7, 9, 'EPIREB', NULL, 1, NULL, 6, '2026-03-02 06:55:02', '2026-03-02 06:55:02'),
(44, 9, 7, 10, 'Main Engine', 'Mitsubishi 8DC10', 2, 'Baik', 6, '2026-03-02 06:55:53', '2026-03-02 06:55:53'),
(45, 9, 7, 10, 'Auxilery Engine', 'Mitsubishi 4 D 34', 1, 'Baik', 6, '2026-03-02 06:56:13', '2026-03-02 06:56:13'),
(46, 9, 7, 10, 'GS Pump', NULL, 0, NULL, 6, '2026-03-02 06:56:46', '2026-03-02 06:56:46'),
(47, 9, 7, 10, 'Bilge Pump', NULL, 0, NULL, 6, '2026-03-02 06:56:57', '2026-03-02 06:56:57'),
(48, 9, 7, 10, 'FO Pump', NULL, 1, 'Baik', 6, '2026-03-02 06:57:17', '2026-03-02 06:57:17'),
(49, 9, 7, 10, 'Fire Pump', NULL, 1, 'Baik', 6, '2026-03-02 06:57:31', '2026-03-02 06:57:31'),
(50, 9, 7, 10, 'FW Pump', NULL, 1, 'Baik', 6, '2026-03-02 06:57:43', '2026-03-02 06:57:43'),
(51, 9, 7, 10, 'OWS', NULL, 1, 'Rusak/Pump sistem tidak ada', 6, '2026-03-02 06:58:17', '2026-03-02 06:58:17'),
(52, 9, 7, 10, 'Cargo Pump', NULL, 1, 'Rusak', 6, '2026-03-02 06:58:33', '2026-03-02 06:58:33'),
(53, 9, 7, 10, 'Steering Gear', NULL, 0, NULL, 6, '2026-03-02 06:59:04', '2026-03-02 06:59:04'),
(54, 9, 7, 10, 'Emergency Generator', NULL, 1, 'Baik', 6, '2026-03-02 06:59:17', '2026-03-02 06:59:17'),
(55, 9, 7, 11, 'Kompar Gas', NULL, 1, NULL, 6, '2026-03-02 06:59:51', '2026-03-02 06:59:51'),
(56, 9, 7, 11, 'Kompor Listrik', NULL, 0, NULL, 6, '2026-03-02 07:00:13', '2026-03-02 07:00:13'),
(57, 9, 7, 11, 'Kulkas', NULL, 0, NULL, 6, '2026-03-02 07:00:24', '2026-03-02 07:00:24'),
(58, 9, 7, 11, 'Freezer', NULL, 1, NULL, 6, '2026-03-02 07:00:40', '2026-03-02 07:00:40'),
(59, 9, 7, 12, 'Anchor Winch Port', NULL, 1, 'Rusak', 6, '2026-03-02 07:01:03', '2026-03-02 07:01:03'),
(60, 9, 7, 12, 'Anchor Winch STB', NULL, 1, 'Baik', 6, '2026-03-02 07:01:18', '2026-03-02 07:01:18'),
(61, 9, 7, 12, 'Tali Tambat', NULL, 4, 'Baik', 6, '2026-03-02 07:01:40', '2026-03-02 07:01:40'),
(62, 9, 7, 12, 'Jangkar', NULL, 0, 'Hilang/Putus', 6, '2026-03-02 07:02:01', '2026-03-02 07:02:01'),
(63, 9, 7, 12, 'Rantai Jangkar', NULL, 0, 'Hilang/Putus', 6, '2026-03-02 07:02:16', '2026-03-02 07:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `asset_groups`
--

CREATE TABLE `asset_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_groups`
--

INSERT INTO `asset_groups` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 'Navigation', 1, '2026-03-02 04:33:41', '2026-03-02 04:38:47'),
(8, 'Fire Fighting Apparatus', 1, '2026-03-02 04:48:30', '2026-03-02 04:48:30'),
(9, 'Live Saving Apparatus', 1, '2026-03-02 04:49:12', '2026-03-02 04:49:12'),
(10, 'Engine Room', 1, '2026-03-02 04:49:30', '2026-03-02 04:49:30'),
(11, 'Galley', 1, '2026-03-02 04:49:43', '2026-03-02 04:50:54'),
(12, 'Windlass and Mooring', 1, '2026-03-02 04:50:18', '2026-03-02 04:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `asset_maintenance_logs`
--

CREATE TABLE `asset_maintenance_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `asset_id` bigint UNSIGNED NOT NULL,
  `maintenance_date` date DEFAULT NULL,
  `type` enum('routine','repair','inspection') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `performed_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `result_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimate_next_maintenance` date DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('marineops-cache-operasion@globalmaritim.com|180.242.192.34', 'i:1;', 1779164021),
('marineops-cache-operasion@globalmaritim.com|180.242.192.34:timer', 'i:1779164021;', 1779164021),
('marineops-cache-ynkgirxn@immenseignite.info|107.173.160.167', 'i:2;', 1782180556),
('marineops-cache-ynkgirxn@immenseignite.info|107.173.160.167:timer', 'i:1782180556;', 1782180556);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cargos`
--

INSERT INTO `cargos` (`id`, `company_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 9, 'POME', 6, '2026-01-19 03:15:01', '2026-01-19 03:15:01'),
(4, 9, 'PFAD', 6, '2026-01-22 19:29:12', '2026-01-22 19:29:12'),
(5, 11, 'POME', 7, '2026-02-26 07:18:58', '2026-02-26 07:34:12'),
(6, 9, 'CRUD', 6, '2026-03-25 07:48:28', '2026-03-25 07:48:28'),
(8, 9, 'BIOSOLAR', 6, '2026-05-09 05:55:26', '2026-05-09 05:55:26'),
(9, 11, 'CRUD', 7, '2026-05-12 03:27:02', '2026-05-12 03:27:02'),
(10, 11, 'PFAD', 7, '2026-05-12 03:27:09', '2026-05-12 03:27:09'),
(11, 11, 'BIOSOLAR', 7, '2026-05-12 03:27:16', '2026-05-12 03:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company_id`, `name`, `address`, `created_by`, `created_at`, `updated_at`) VALUES
(6, 9, 'PT Tamatech Waste Industry', 'Jalan Jeruk Nomor 51, RT 009 RW -, Rimba Sekampung, Dumai Kota, Kota Dumai, Indonesia', 6, '2026-01-19 02:09:29', '2026-05-12 03:18:47'),
(9, 9, 'PT Mito Energi Indonesia', 'Jl. Riau Gg. Harapan 2 Komp. Taman Harapan Indah, Blk. C No.16, Air Hitam, Kec. Payung Sekaki, Kota Pekanbaru, Riau 28292', 6, '2026-01-19 02:12:24', '2026-05-12 03:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(9, 'PT Global Maritim Nusantara', 1, 1, '2026-01-18 21:20:17', '2026-01-18 21:20:17'),
(11, 'PT Mitra Maritim Mandiri', 1, 1, '2026-01-19 00:34:57', '2026-01-19 00:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `crews`
--

CREATE TABLE `crews` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `vessel_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Male',
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Indonesia',
  `seafarer_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seafarer_book_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seafarer_book_expired_at` date DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_15_093106_add_platform_admin_and_active_to_users_table', 2),
(5, '2026_01_15_100932_create_companies_table', 3),
(6, '2026_01_19_045520_create_personal_access_tokens_table', 4),
(7, '2026_01_19_060726_create_user_companies_table', 5),
(8, '2026_01_19_080614_create_clients_table', 6),
(9, '2026_01_19_092148_create_ports_table', 7),
(10, '2026_01_19_094517_create_vessels_table', 8),
(11, '2026_01_19_100258_create_cargos_table', 9),
(12, '2026_01_19_102929_create_periods_table', 10),
(14, '2026_01_20_025442_create_projects_table', 11),
(15, '2026_01_22_062942_create_vessel_certificates_table', 12),
(16, '2026_01_23_030121_create_crews_table', 13),
(18, '2026_02_25_104409_create_project_document_types_table', 14),
(19, '2026_02_25_141345_create_project_document_uploads_table', 15),
(20, '2026_02_26_105205_create_project_vessels_table', 16),
(22, '2026_02_26_133113_create_project_voyages_table', 17),
(24, '2026_02_26_144531_create_project_timesheets_table', 18),
(25, '2026_03_02_104753_create_asset_groups_table', 19),
(27, '2026_03_02_115249_create_assets_table', 20),
(28, '2026_03_03_103200_create_asset_maintenance_logs_table', 21),
(29, '2026_03_04_152137_create_amprahans_table', 22),
(30, '2026_06_02_170811_create_agendas_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('superadmin@marineops.id', '$2y$12$OwvSDpOK/MQplZK1Y4yfF.y73x3jiKeMDH.POydPEo9VFFd9/2aum', '2026-01-14 19:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `company_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(10, 11, 'Project 2022', 7, '2026-01-19 22:20:54', '2026-01-19 22:21:32'),
(13, 9, 'Project-2026', 6, '2026-01-20 21:07:13', '2026-02-18 08:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ports`
--

CREATE TABLE `ports` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ports`
--

INSERT INTO `ports` (`id`, `company_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 9, 'Batam', 6, '2026-01-19 02:34:47', '2026-01-19 02:34:47'),
(3, 9, 'Sintang Raya', 6, '2026-01-19 02:34:57', '2026-01-19 02:34:57'),
(4, 9, 'Kalimantan Barat', 6, '2026-01-19 02:35:20', '2026-01-19 02:35:20'),
(6, 9, 'Jakarta', 6, '2026-01-19 02:35:42', '2026-01-19 02:35:42'),
(7, 9, 'Bangka Belitung', 6, '2026-01-19 02:35:54', '2026-01-19 02:35:54'),
(8, 9, 'Bintan', 6, '2026-01-19 02:36:03', '2026-01-19 02:36:03'),
(9, 9, 'Jayapura', 6, '2026-01-19 02:36:09', '2026-01-19 02:36:09'),
(10, 9, 'Papua', 6, '2026-01-19 02:36:15', '2026-01-19 02:36:15'),
(11, 9, 'Bitung', 6, '2026-01-19 02:36:19', '2026-01-19 02:36:19'),
(12, 9, 'Sintete', 6, '2026-01-19 02:36:22', '2026-01-19 02:36:22'),
(13, 9, 'Talang Duku', 6, '2026-01-19 02:36:39', '2026-01-19 02:42:13'),
(15, 9, 'Sungai Guntung', 6, '2026-01-19 02:42:19', '2026-01-19 02:42:19'),
(16, 11, 'Batam', 7, '2026-01-19 02:43:34', '2026-01-19 02:43:34'),
(17, 11, 'Sintang Raya', 7, '2026-01-19 02:43:40', '2026-01-19 02:43:40'),
(18, 11, 'Dumai', 7, '2026-01-19 02:43:45', '2026-01-19 02:43:45'),
(20, 11, 'Kalimantan Barat', 7, '2026-05-12 03:27:52', '2026-05-12 03:27:52'),
(21, 11, 'Jakarta', 7, '2026-05-12 03:27:58', '2026-05-12 03:27:58'),
(22, 11, 'Bangka Belitung', 7, '2026-05-12 03:28:08', '2026-05-12 03:28:08'),
(23, 11, 'Bintan', 7, '2026-05-12 03:28:14', '2026-05-12 03:28:14'),
(24, 11, 'Jayapura', 7, '2026-05-12 03:28:19', '2026-05-12 03:28:19'),
(25, 11, 'Papua', 7, '2026-05-12 03:28:27', '2026-05-12 03:28:27'),
(26, 11, 'Bitung', 7, '2026-05-12 03:28:32', '2026-05-12 03:28:32'),
(27, 11, 'Sintete', 7, '2026-05-12 03:28:37', '2026-05-12 03:28:37'),
(29, 11, 'Talang Duku', 7, '2026-05-12 03:28:49', '2026-05-12 03:28:49'),
(30, 11, 'Sungai Guntung', 7, '2026-05-12 03:28:58', '2026-05-12 03:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `period_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `project_number` int UNSIGNED NOT NULL COMMENT 'Nomor project, reset per periode (diatur di backend)',
  `type` enum('time_charter','freight_charter','shipping_agency') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Jenis project / kontrak',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `contract_value` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'Nilai kontrak / nilai jual project',
  `status` enum('draft','active','finished','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'Status project operasional',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `uuid`, `company_id`, `period_id`, `client_id`, `project_number`, `type`, `start_date`, `end_date`, `contract_value`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(44, '0a663209-eaa5-4003-9ae6-d2823a6f60e8', 9, 13, 6, 1, 'freight_charter', NULL, NULL, 0.00, 'draft', 6, '2026-06-13 07:34:35', '2026-06-13 07:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `project_document_types`
--

CREATE TABLE `project_document_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('time_charter','freight_charter','shipping_agency') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_document_types`
--

INSERT INTO `project_document_types` (`id`, `name`, `type`, `created_by`, `created_at`, `updated_at`) VALUES
(24, 'RAB Keagenan', 'freight_charter', 1, '2026-03-04 03:00:50', '2026-03-04 03:00:50'),
(25, 'Surat Perjanjian Angkutan Laut (SPAL)', 'freight_charter', 1, '2026-03-04 03:01:08', '2026-03-04 03:01:08'),
(26, 'PETA (Jarak Nautical Miles)', 'freight_charter', 1, '2026-03-04 03:01:17', '2026-03-04 03:01:17'),
(27, 'Time Sheet Loading', 'freight_charter', 1, '2026-03-04 03:11:56', '2026-03-04 03:11:56'),
(28, 'Dokumen Muatan (Loading)', 'freight_charter', 1, '2026-03-04 03:12:12', '2026-03-04 03:12:12'),
(29, 'Surat Persetujuan Berlayar Port Loading', 'freight_charter', 1, '2026-03-04 03:12:39', '2026-03-04 03:12:39'),
(30, 'Invoice Keagenan Port Loading', 'freight_charter', 1, '2026-03-04 03:12:55', '2026-03-04 03:12:55'),
(31, 'Invoice Pengurusan Dokumen Kapal Port Loading', 'freight_charter', 1, '2026-03-04 03:13:18', '2026-03-04 03:13:18'),
(32, 'Time Sheet Discharge', 'freight_charter', 1, '2026-03-04 03:13:36', '2026-03-04 03:13:36'),
(33, 'Dokumen Muatan (Discharge)', 'freight_charter', 1, '2026-03-04 03:13:48', '2026-03-04 03:14:04'),
(34, 'Surat Persetujuan Berlayar Port Discharge', 'freight_charter', 1, '2026-03-04 03:14:29', '2026-03-04 03:14:29'),
(35, 'Invoice Keagenan Port Discharge', 'freight_charter', 1, '2026-03-04 03:15:11', '2026-03-04 03:15:11'),
(36, 'Invoice Pengurusan Dokumen Kapal Port Discharge', 'freight_charter', 1, '2026-03-04 03:16:36', '2026-03-04 03:16:36'),
(37, 'Demurrage', 'freight_charter', 1, '2026-03-04 03:16:49', '2026-03-04 03:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `project_document_uploads`
--

CREATE TABLE `project_document_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `period_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `document_type_id` bigint UNSIGNED NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_timesheets`
--

CREATE TABLE `project_timesheets` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `period_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_vessels`
--

CREATE TABLE `project_vessels` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `period_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `vessel_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_vessels`
--

INSERT INTO `project_vessels` (`id`, `company_id`, `period_id`, `project_id`, `vessel_id`, `created_by`, `created_at`, `updated_at`) VALUES
(22, 9, 13, 44, 7, 6, '2026-06-13 07:34:52', '2026-06-13 07:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `project_voyages`
--

CREATE TABLE `project_voyages` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `period_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `spal_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_id` bigint UNSIGNED NOT NULL,
  `loading_port_id` bigint UNSIGNED NOT NULL,
  `discharge_port_id` bigint UNSIGNED NOT NULL,
  `quantity` decimal(18,0) NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_voyages`
--

INSERT INTO `project_voyages` (`id`, `company_id`, `period_id`, `project_id`, `spal_number`, `cargo_id`, `loading_port_id`, `discharge_port_id`, `quantity`, `unit`, `created_by`, `created_at`, `updated_at`) VALUES
(12, 9, 13, 44, 'Z', 3, 2, 6, 1000, 'Kl', 6, '2026-06-13 07:35:44', '2026-06-13 07:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0ttdsJR0RwIvE6nHFscvjGIIglsmWZLdOFSaAx7T', NULL, '195.96.139.165', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickRlcGNvaHFGSmZZdEdyODZXVmJoOFFjeVVvczBiVDZXeTM0ejdMTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785301160),
('16tmvpEBRNHoLUFkpx5UBEqdTMUKxoFSLwSuxOlq', NULL, '23.180.120.148', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWm90cGloWU10c1BNWTlNVjJXVFFXRkE2N21GOU1BMTdtUXkwbk9PbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC8/cmVzdF9yb3V0ZT0lMkYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785301903),
('1LNUaljHnzjIIXhiJIA0D6WYJuVJzLpgRdc48Y0L', NULL, '23.180.120.148', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzdFRUdVUlFZZmpHUEM1VE5hSlZYUUZnU3dQOXl1ZTU3bXlTRUVNMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785301901),
('1W7S7WNmISyUog0SDGPKYf70uASvloOGQoAjzzc4', NULL, '198.235.24.33', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHQ4aWZ2U3NMSW5aRThWbndzU0xMeWtDMTlhR2dPZGNzMnZOZzdrTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785588294),
('2V4d7CJ2P1klrF2nIiikkrK52yNONFTcVXRknuce', NULL, '3.217.141.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjl0TGZ6Rmh6c0RTeWIyR25FWmZSVzZlNDNqdUg4UlNUNHFUd0hyZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1784998991),
('2vh14IWHzb8ETLGxrxCBtsxCJ4zqJQHxp9gUIuIk', NULL, '209.38.145.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoianhRYlVNcHdJTGxBMDc2bEpXWk9iU3NramNrVjM3SGVLTG9UYW9haSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785118094),
('4aMQ8JylMhPKwhj3kXPYU1Vz1XoVp0HKSKvEb3uK', NULL, '34.195.23.187', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDE0U3lXajVNNE9qNDhMSVFZT255alc3Y0lRbVJUclJRQm5jTDl1NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785098853),
('4k3Gki9ft0GgAfw3jwxqLPizPe5obMEJLFCTNFBB', NULL, '54.211.2.94', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHhkU0tPaTFvV0xJbTMzQ1l0OWE3b3BpNFdqMndqc3BXRHNPZ2RNMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785725341),
('5JSKeAaS0HOGD6hlP25Uw6KGK2qKvYTGc0zs9vg7', NULL, '45.148.10.247', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDNUTkNnSjlvM29ocnRaWjlIV2FheWpPblVRWVlDY0dET2JncENBcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785548479),
('5wqK2d9E56aJ6udbV2nrDQc43DvuNaq0LZ6EFtTy', NULL, '45.148.10.244', 'Mozilla/5.0 (compatible; pathscan/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnd4SVNqYTkyQXR1ZEVGQXhVbmh4clAzUDJwRGpHRXRicnc3MFFTRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1784981707),
('65lKaxAvn4qpkPxyMRt7h7lzQ1aanDBQDvCotv0n', NULL, '66.132.195.56', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHd0Mmk3YWVLejFCbDdMMDYyN2V1UU0zY1pYNXJXSkEzVjJVczBIaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785605659),
('6l4bNMtNUWjGfEguTKW3R9mf0SegYLGhzlGQoje1', NULL, '180.242.196.16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWW50YTlxQnBjR2ZBS1pObjVTb2NDNzBwZ1lSNkhkVG0xNTJtaG91NSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785148431),
('7dN1AtKd1qtqNmValEb8IAAbaFI2jqhMbD7EN3R5', NULL, '185.247.137.82', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTA0aWtwajNtdlVvdllJQTROa1pxdlFnbExncFVuek9RVnJRSHNjRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785243644),
('7Hbt0FlDkmAdqG86qLMOfrqEbhQXYP1JzoV08MZL', NULL, '74.7.227.6', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHJUUmRRakZld1k2aXFFSVFuWHByMG5oc2FKTDJvTTd2Z01FcTFPNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MTY6InBhc3N3b3JkLnJlcXVlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785447098),
('9bp6lWtUntynTXyStB5m2sDdlBSxnVxKZNGvrqGo', NULL, '192.227.176.16', 'Mozilla/5.0 (Ubuntu; Linux i686; rv:127.0) Gecko/20100101 Firefox/127.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidERTNU92SDN5OWlzbGl5eUVacU5LaWNHMjZCMndLSjg1b3FDdG9ndCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785063088),
('9E3m59vZH4pAd7s6f8FvC4s9LFFYJAxAVIwj76Zx', NULL, '185.247.137.82', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFVJcE9lbWF6WklwZjRScnRJbXNRcTRwMXJ1RUliY0pVWHJXN291NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785243643),
('a5ZyeptuQYq9T0HMusuj5MVbo9UhRHQm0OtRjRvl', NULL, '87.236.176.46', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTRLMlAxM1BiMkRkZWVEdUR5cDBYWFhmSFdidzE1V2xsSzY5aUtiOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785333729),
('A6j16Yp04tG74OQObkURAOdlRWYxvdvyMbgknP6e', NULL, '34.53.232.78', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1pQbTIyWEdLY1JCZ21iMkRYUmRrMUM5ZWNKaGdBeHlyaU8wdmFpcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785423882),
('apF3uBC5trBzVjoXx9Qw5emTSbCgJmYAQfTrWygu', NULL, '72.11.155.223', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1 Safari/605.8.25', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmhLQTdWSnhrNk9jZlk1Z3FreFRHSmhxMlZMdUtwcG40RU1oeVg1OCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785516281),
('BIbx7ByHNcBDJ4h6GnFfLzvOWFMeYjbjd9yKfsBf', NULL, '45.148.10.244', 'Mozilla/5.0 (compatible; pathscan/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1dDSlBUSmV4Zm1wNzFFVUdDUXFFSGQ1eGExdGVFRXZEQ29xYmc3TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1784981707),
('BjENpeZ9u713xmZ7cSFRI0OX4SNRvDOVMbyQTBG4', NULL, '32.193.141.171', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN09DOUd3bHliaEd3MldqWEdvV3lLWWpWeVB3czJHaHAzd2RoVlVaWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785098852),
('BLtFKZ7UUslRHDzLYrxPHQV7V1HApWravvhbyHs0', NULL, '205.210.31.154', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXR3VlVYaFUydkRwWHpCN1hvV3BCQnl1ZnhNNFVxRFpMMERRTXBxeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785623853),
('bSQujifX4WeMZaGbdKGnn8mFQIxlAUpJLj9ZjhtE', NULL, '54.211.2.94', 'Mozilla/5.0 (X11; Linux x86_64; rv:104.0) Gecko/20100101 Firefox/104.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlZuRGQxcDRKNFNrNHlYcUhaWnRIYU9iSTdTYTFMcXJ2aHZ4U1A1NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785640767),
('bvNwZwcMdLlQShPlh8rXAJf4HAKRmryV7s5baj94', NULL, '45.148.10.217', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGQ4NUM1VU9lNFNaN0xSakFJaDJmUHAwTGtmVlRMR2ZWMVBUWnVTayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1784975722),
('c4cFx7hD8r9xv6BjZP5cAMHhiJR275xv7BpbbPYH', NULL, '139.59.95.203', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekpuTlVJSVZ2bWxZY3JkbFBqYThjc01NbVZxN0dQUVhjQXpvSlE2ayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785718865),
('C4uANKSphA8b86z2AOmTTUn3MRiSqGud0qCBXPTp', NULL, '34.134.81.72', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmJydEdnZE5yMDZmZjN0MjBUSzIyMTdrd2hLZGNPSDFFYmpnQTNpcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785520616),
('CvNX4Y5Wp37yEKlULkfISBJJ9BtOHojWuysqfOlF', NULL, '45.148.10.244', 'Mozilla/5.0 (compatible; pathscan/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGNwR0Mwa2l6RnB6OHZGRWl5T3FLNktja1VIMHY4WGlMV2JCOVlyRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1784981656),
('D1HTDvrX9aLL0kFPLWrro3mjWzFcVeoKQGAnEHjy', NULL, '192.227.176.16', 'Mozilla/5.0 (Ubuntu; Linux i686; rv:127.0) Gecko/20100101 Firefox/127.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODg2TlFZYlYxR1JvN1dmTEtIcEtrdHNLVVZVVmJoUUFtU3J1cEdZNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785063091),
('db6TlIPsR3TIVBc04yoyDlTbAwy6uTbF8vmviNPP', NULL, '32.193.141.171', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUE4dm1USkFSYmM3NUVsWld4SmRUTVdkVDI0eFlFbTRjWEl5eDlzUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785098853),
('DeCxLn56vrCqPLgaXkf5gBxxU4gqJuDiKVt9s29K', NULL, '198.235.24.172', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEVleEpGMmJOaVFDT2txWWdRZVFnUVhZb2JxTmxnUmJjSlFSa3VDaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785586494),
('diSgHL0XxF9SWTsQpZUP54jRuG0TtqpXQOYXvTW7', NULL, '87.236.176.250', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGFRZVF5dnpIcFpEWk9SV3Mza1d5cW83djZvQTNrbEVZZHI2UVMzSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785385300),
('dRMM2gLli8c0i6qdjkJe7py1MS0s8DKtoTbnbSS7', NULL, '198.235.24.115', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmJzcFJvYkd2WU1wZ25aVTJiVXpoQTFDUGpZNkhtcHdOcHNndXVxWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785358972),
('DVUcX5eachYxv6qAC09LmkCzJFFFxhhqvaWp2PXq', NULL, '45.148.10.247', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVlJQU05Q0N1WG94dmRvWWVGZm1kUVBuUzBSTHh3QUNiNUs0Q3NlNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785548480),
('dyAiQrabQHboqXanfzNKfMix82y9F8f6jg5nNv4d', NULL, '3.217.141.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGhkeFU5OERTQ2VuNENQcFIxWlFJUHIzdUs4N3JyZ1F4SUtPTlhmVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1784998992),
('E20JO9tfoUO4JWPmOjNHlrDWZ6bJiXFi0dz3BVBk', NULL, '94.154.43.184', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXRhQndXczc5UXYzamxsMkZVTk1qeHNVNlFHN1c5VEZ0eWhwaVFiSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785326090),
('edc9PLs4NiJGzuCvRCrtHR6c03dLKpYj4EqDVVtS', NULL, '198.235.24.174', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibEs5ZUFHeHAxV2YwT3F2Z1JoTVlrajJKeE9TcW95Y2YzUFdPaU5lYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1784991431),
('eMbyc5O8JZm176C1AU463akYnSiHE3d75sSwbXRN', NULL, '45.148.10.244', 'Mozilla/5.0 (compatible; pathscan/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTBPM016QmZHalQwMThXZWJhQU9xNTZjd1VxRU9RczN4Yjlvc01PVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785028215),
('eor9pEHyeDzE1vmLY4eWs9wJFqGtng5rpLKCbBiS', NULL, '94.154.43.178', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHpiSFNPOHR2VGFhTkxjQXRDU3c4SVlLMnZDS0lReFMwblFnbFBCNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785693135),
('EWXY1vd51ELDYcQ3bKOQBN746i3Jjcz3rayctBfQ', NULL, '107.172.180.205', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlEwQUhndUZSZ3dYUFFNR0dIR2VucE45TDhadjVJSUU0aVJ2S2ZOZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785587035),
('F5EVA2AELPVi9hXMeDqWVFImCFYGxawMFP3MeTY2', NULL, '74.7.242.11', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1dhY2x1SXZsVWZMTUVpbXNMRm1IemdMZUZrUW1yek8wd2tqQzJwOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785087598),
('fBnX5zI4C36FETVuyRK3MWV7ZgFboityzv1CM6Uz', NULL, '135.136.19.180', 'Mozilla/5.0 (Windows NT 10.0; rv:68.0) Gecko/20100101 Firefox/68.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiem9EODQ1bDZZSmZ2d2dXeWNId2d3RXZzSW1jOVhzYmtyamM3YVI2YSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785088729),
('G2PLJ5BKIUCf8b7FSAvBeIicfTeZcd40D9SS9XKo', NULL, '34.53.232.78', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWURVMEQyNnVFVG5kNnQ1NGhYSlROVlFoRFEyQW5QMkduaTQ5U3FsWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785423882),
('GJdGTuGC3QjtrvMb6D4G7LvmytG1G8NqZUPgoFl0', NULL, '34.38.171.180', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVRxY3BjU3ZaOVpkajZTMG9hZ3hIWEo4azlkWE1pTzB5TGZCU2hzRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785067645),
('H2YdLmTemYj5Fpt04AWvbsN3ItKxGGyMBV18LaOu', NULL, '81.217.16.32', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2U0bTJyNU9KN2pkRzZhaUdBYktyYWV2ak5BSDVjN2FENjNsRlU1bSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785053803),
('hdP6gvXdk6u9zPKt4jA7Z9PIMmVgIR7vZ8rOszxz', NULL, '35.245.187.47', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWNRS0doaXRNTE9WQmhFelhjZzhBRmhha091M0twNm9XbHFhbWU5RCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785415336),
('hNSksiP1gNf7vciDAjQn0HUaVh7TkhwsmEeWK9O2', NULL, '94.154.43.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGJwTUE4aTFkNjc1T1dIYVkzQnRzZHJZTW1qSmlWNGJZemdrRWppSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785326089),
('HWqtfCqQRSGrgyhouWDvcj7vL0MlZUvSsjnoyHbe', NULL, '94.154.43.229', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXhzOW9jMmhMbERGQ3E4emZhcDAxQ0dpblJONW0ySFlscTNtQUlYYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785512191),
('ibad970piZjY1MmrHzCz5JKZpemsltKRyJPskzje', NULL, '45.148.10.247', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiSW9XdlVRZmZRQWZIUEJTQzNEY0RwRWJwc05xMXJ0RDBFcDZabzJLeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785426906),
('iF7DZD1i9iROfrFYsKAKxdeOGC0o5CrtlLUPXPLS', NULL, '216.73.216.229', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDc2TDFhRTRQdmo2MFFIc0Fhbk5GbHluZGNxREF4Z3pNdXdkUngyOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvZm9yZ290LXBhc3N3b3JkIjtzOjU6InJvdXRlIjtzOjE2OiJwYXNzd29yZC5yZXF1ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785524892),
('IPlpnNnS9RzyJbVTkhFGEkfqYtSS6ML3YhTrcFKG', NULL, '34.195.23.187', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTdhYWxuVUFJalMxU0FMQnZSM0VkTTY4TTV3Rk9udFZLRkQ4YUdtTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785098852),
('IWLVgyCpZLbHoJf9Lh7FKraykgW9MXNVkuJMY1Cu', NULL, '94.154.43.188', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekp3WnVWekp3MnZxVTV5bEpMT0xIZ3ZBSXFCTFRRNTZQSG5WNE1XUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785693136),
('jehKArfIYAJ4GKZjUWzjYXRcK7qQIJJzKY4nCREi', NULL, '198.235.24.206', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUVvbkFra0lDQ0Jka21WVTlmV1FsZGdGVjFKNlk0UnVIbFQxQ2R0eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785220767),
('jmjsIN8UWdzDwfS3PQUr67UjrLl57UjKLinEg6Hq', NULL, '180.242.196.16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUlkanI1eVJ0NFpXRW14aFRhbloyWnBYQlQ1bEZ6Vm1vSUZ2ZlA0QiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785221609),
('k1nIQ9JL4BlZxNoEHt5T17fA5yzeBV7aPgYBYUsU', NULL, '137.184.35.19', 'Mozilla/5.0 (X11; Linux x86_64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMndGcWZNNEpNY3VwbjhGdVZYRDBHbW9TZmdWVmNNOWgwWXA2ZjBpaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785112235),
('kenr3eeCQsOT6spzEmvX8BbtX5PXvmAwlWymcnev', NULL, '64.95.11.158', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; GPTBot/1.1; +https://openai.com/gptbot', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNzIxNVdxb1ZXWHFRVWZpVWlLWnYydUJOM2hSVTVjTXBKc2R5d2hNRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785240392),
('KilryvLb9dSFjBjxNGes25ofbCMb2wjgmFNzEHP4', NULL, '205.210.31.145', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmJJUjBxZHVZbk9hM25aeUF2QzM2dmRHSnROT0xSSjZSNjB1UUxFNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785596304),
('KnEH0OoY1m55DJhHlVwP35RvAWMjH3j340EzkCiW', NULL, '66.132.195.56', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHdydzB5c2ZLRWRVc3JZeWRFYmdtT2dISXRnYzhXMkh5UTB4cFdLRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785605664),
('KR3hHs5uspC8bsbtawX226G83HBBHFxkWkbnZMcO', NULL, '216.73.216.229', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVlzU2N4Wjl3VGZsam13YXpDQmdYUUFaY1hXSGphb3p0S09qV0RxRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785521486),
('lDlaYdQ03OgQKl3eUlVuDMUjvAlDQY85B5xqAxll', NULL, '45.148.10.244', 'Mozilla/5.0 (compatible; pathscan/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUJHUXhOTjhXbk5zN2s1djgxblZkZmh2eWx2YWo2NUxsSEdWUFdRNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1784981652),
('LhRU4GUUTvTmmqByHjG04vYZspcCUjWEs4AxDtL1', NULL, '54.211.2.94', 'Mozilla/5.0 (X11; Linux x86_64; rv:104.0) Gecko/20100101 Firefox/104.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZEJaSGhSZVJmTDV3RWNTektvdW9ldXF3VDZ4ZEJMOVV0UVZBdm9IbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785640767),
('Lj3uM9liN5k2Wvj2przSHVub7m8eUKYhziSunUeV', NULL, '143.198.238.89', 'Mozilla/5.0 (X11; Linux x86_64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2RPWWk1ZzUzRW5NS2lzcnF0Nm8yTHlCclRZdXpjaWw1ejdLQklBNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785206106),
('LpFZ8k7OvxEVuLXeIlOkXaa9LEnNfoSZwXvlRZQV', NULL, '205.210.31.165', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWY3d1pRMHFIZmliOEhuZWVDMWlvWVo2WWo0Um1WNFdxS1RzMndRTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785088453),
('LW6FytM7zUu4VxZVW2iLD9WUzS2fM911MTGVOKBu', NULL, '107.172.180.205', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTE5oSVR1R1BvVFlMWDRwRHJjaTc3Z2l2UmJzM2c0OXdjZ2l4d1VzMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785587038),
('m8DJewOx9jpME4ADaHivnJkTpyD2LyhSgTvWWSvP', NULL, '45.148.10.244', 'Mozilla/5.0 (compatible; pathscan/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzRKM3gzT3dIblliR2JQMWFIb3lKZkFRZXJKMW4weGdINW91RTBFYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785028214),
('mfZaR49oIGl2EA6rPOYfZ2Uvn6JnrjUZwDUUcSpy', NULL, '216.73.216.229', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmxicENsaDhaZHBFTTBrZFRFRE85S0JwN0pNd3BsczZIWUxRN3hXUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MTY6InBhc3N3b3JkLnJlcXVlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785524534),
('MIH88nLXZFLaXTOXUgGhIjefc8VWeoPBNKiXo1LJ', NULL, '143.198.49.167', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHlXeEtpdWI5eW43MzdTcE4yM2ZsVDczdGU0cEdFRHpvM2N6d2F6TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785290151),
('mN2n9OnmnyzlEhfuwuFREeYBJjxFLmkNHUMgF73u', NULL, '104.199.168.198', 'crusader-worker/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYm5jS2JvVWg5Y3l6MlVubHRXZzkxR0RPd2hhY2VPTTNvZlNDdHR0RyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvc3RvcmFnZS9sb2dzL2xhcmF2ZWwubG9nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785707812),
('MRVkss7MfVXhSoQyEvoiXg1riofzkikqtrPTobsT', NULL, '45.148.10.244', 'Mozilla/5.0 (compatible; pathscan/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGNSQmVGREpwajU2d3FXSnF1OEc4Z3VEZ2dXMjNHWGhBbnlVdWppQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785028197),
('mwGA7MBV14yiLeVobcc7JdGl9Ydj716484fOkmH2', NULL, '34.38.171.180', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXllU24wN0RGclhCeUtPN0FJTE13ZDF2enpOYTNpZkh4U21HT3VYdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785067644),
('MwHjj7EvcMS1In8J5pfFPN3y9luW9MLCRzZwrjCf', NULL, '180.242.196.16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFpoaENhYnZwbUxoT21XSU5sRGE2Mlh1eUl2UjFDMVpXN3BLVFJaYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785217273),
('n4Pw0t2n3H1zmoXy6cAhwTQaGM63mrwqmQ8hrqZF', NULL, '52.22.1.240', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDhWUDc0T1lPbG5HQ3dzdG9kM3ozRTQwUFJkUklobmlrUDJvTEZkbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785569021),
('Nb6GzlUvDK5J3MY2EoA0RygCqqC2qKllNI4XXR8I', NULL, '74.7.227.154', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVG1WOHY3YVczclZSc1R3dUNzbmo2aHlFcFlLeFdRN3dJSlpFMDl3bCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvZm9yZ290LXBhc3N3b3JkIjtzOjU6InJvdXRlIjtzOjE2OiJwYXNzd29yZC5yZXF1ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785110907),
('NUwQYkDgv2DjAKuEW1xBjbYnDXZRqDiErUXU1Wff', NULL, '205.210.31.145', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmdjT2pFcXpJNTZLUmhYVmdvUUNtelgwNTF0WDlEUzNrS05SQVMwNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785596303),
('oeZCK4RFnOsGcn4AlDSJWdTMhfJG99y4COS8bY1c', NULL, '94.154.43.187', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2g5bVlGNjk3a05hNFdkZEtYOHVIUVhqdldEaFNGbHB6QmgxWGlmWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785512193),
('OylQDClBmvobEP1A3NQ0D1XpLU9Iw0xg8svUkV2f', NULL, '34.23.187.121', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWNIUWdITzF0VExhN25PNmh1MDV5Zlp0WUdJeEVqbVRMd1NiZ0tPdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785062048),
('P1iJTRLDFjVT8hVptlqtJnfXspXzpqxxGJAMcpLI', NULL, '64.227.117.0', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2pFSXA1aUhrUEtBTGw5YzBQa01ZWFQzdDlCRktqUmxqZXJqNGd1OSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785289759),
('pahxW2oMXaLDzSafQ9i7oWCgB42BW2hptYIuwvqz', NULL, '72.11.155.223', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1 Safari/605.8.25', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTVicVB3N0NzQ2llemdaaDc3Rm9JeEZ3b1lnNnpob2ZKY0RRN1BNeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785516280),
('PtVo4R7O55LJJ99idxoGnTMNkPoZqJPMdttp3Pwb', NULL, '54.173.131.118', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmdvNUhLTUJtRk9qbkhxalVxUk5IMTVHYzlDVHNaa1Nld1JqZjk4SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1784998991),
('PvRKI9W2VUbi7etZKjRvy7qr07MDf1b2dOmLQA1t', NULL, '74.7.241.50', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUZqQ3FRNkpSSXlvYnk5NnVvWXVRUlRzaENWUHU3N29oY25Fc01sSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785441580),
('PWYghqPzweo2C4kN5i8di49rJ2riGw27YVwkcByp', NULL, '198.235.24.33', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDhOcGJ3OTRhZHZKUGdvQmFwbU1ZUXBDTEtlTjJvVjRya3pDNHJjNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785588293),
('qe7dDltZMOkjPIHfKLyBmHFoVpbRHXR68cPZnGkL', NULL, '135.136.19.180', 'Mozilla/5.0 (X11; Linux i686; rv:1.9.6.20) Gecko/ Firefox/3.6.16', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1l3d28zeEdRdFpVbERrRU5ndGx3THFyc1htZTFUTXc3NmhvdXBCMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785088818),
('QmvPIroV7RX80XwpvNhNY2v2OJxNyu4jkOAZTRE1', NULL, '135.136.19.180', 'Mozilla/5.0 (Windows NT 10.0; rv:68.0) Gecko/20100101 Firefox/68.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnRKSFNHd3pTU0plNXh6c2UxaGE1Z1JBTDVWWjV1OWRuem1kcGJOMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785088728),
('qXo8zlIu71UudbTmUx7EeHIEP1rgh51DNKUB96RD', NULL, '45.148.10.247', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMmtnako1SlZoU2RCZlhSVWZ0R1gxT09LajJsSlk2d1ZHU0hjUkFRMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785426849),
('R1wgs80fLacRo1KtDPDBtdgaFcy5jI5et5LIJsGV', NULL, '34.181.197.142', 'crusader-worker/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibzBvcTNzYkFoTzJxcUNsQlNrdENXMlhrZEcxeGxnZVNEVUxFSmlxeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9zdG9yYWdlL2xvZ3MvbGFyYXZlbC5sb2ciO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785712404),
('RbVV7Gj1vkZGtm8s9JhzdI5UvfZEdNLU3E3wghVs', NULL, '178.63.73.169', 'Mozilla/5.0 (compatible; wp2shell-checker/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV21sOEFSNWFuVlBpOGhyUW1OTVpyTUUyY2JQVjRWNDJ6bWpnN1dEeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785299962),
('ruRAMLt1JjaU5OPYMBiteVNxUSC1GVYb4nxkJZNX', NULL, '35.185.4.234', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTVVT1FvM28wblV5cURweTdoTEpZY05EY3FQRVEyUWdrTGhyM1JEViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785060722),
('rvoNu9kb6nJDVWQ16NDXUgzp8geTr42U0u7qXQ6u', NULL, '45.148.10.244', 'Mozilla/5.0 (compatible; pathscan/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkJIbk91Wk5sNDIwcUkwVnRPMVdWMTRJeEVHb25RV2ZZYzEzRTZjaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785028196),
('RwUOaffX3vCTaoXkBLoUpyttghHsqLi8Eh50rzQe', NULL, '23.180.120.148', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWZvMzQzYlBjeVgyQ2NJYVAzc09taFo3dGV1c2FhZFl5V0NxSXhhUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785301902),
('rXaTSk7ITikhn6a8Llt0rpoSHEgoD6qI73yZCJlG', NULL, '87.236.176.46', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTJuSUplbXVtVnl0NzlMbW5BMkdrb082b1dvZnY5aXBkUFVGVkMwRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785333729),
('rxvCfpcUvagfoFjzsXBRyXLkRmh26dODjnrwyMqB', NULL, '135.136.19.180', 'Mozilla/5.0 (X11; Linux i686; rv:1.9.6.20) Gecko/ Firefox/3.6.16', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWMyc1RTWjFMczhOVVhEd2F1NGd0SExVRVJyOWYxQVAzNzdyTnV3TSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785088820),
('s8CWUOHCjZprKiT5beSoZB06ekZdWaVbOjkyvV0n', NULL, '94.154.43.188', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXdyS283VTlpTnRmU3NWVVNzY3Azb0cwbEJkZ0VSR29TSEdFTEZleSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785151861),
('SVC0rrob86SgRn58C0vMrBnpVMC5UhVC33MXVeeG', NULL, '52.22.1.240', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3BXV3ZIWFlIRmJFNzlVYk41NmdKRFVlWGYxY2dpRlNJMVdWT096SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785569021),
('TPyEk17uTdGxXkczu7oKHNzRuisUBcuJKSyc1LLx', NULL, '198.235.24.172', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWZPcHRld0dHelZUOTI1YzIxZENWVlFudmUzZkRvMWM2S2VlaUtsTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785586495),
('Tzpsmu1EC9nwCxAMDDpm6ePacCL2m3wF2H4InYbh', NULL, '178.63.73.169', 'Mozilla/5.0 (compatible; wp2shell-checker/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEhjNHBybEhua3FHODQxTXlsMms5VnoyUTBQZTNpbVY4eWNxNlUwYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785101197),
('uAIqiuzBbwe5oIFbND8ABXIoBId9YQPamygy17kA', NULL, '216.73.216.229', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVRXZEhhTDVRd01xQzFjT2cxV0tNWEJlR05lRU9ud0FiTXlzaGlvdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785521459),
('uCsWQfU0qM08Rp88Z3m8ProXscuXlBDChAXPaTlX', NULL, '178.63.73.169', 'Mozilla/5.0 (compatible; wp2shell-checker/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3R3SkpIcjVlM1BwNGdIaEx1S2RKZVpGbmJNMFEwUUM0Z3pDQ2k2aSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785101196),
('uDHdcUJo8JnC83x41cLjJTlF5Q6dUXojxpuaSDOc', NULL, '54.211.2.94', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYk5Rd1pxaGE1cFVKaHZOWWg0MWhzcURrVW5KcnBqdWFFZFh6QXM5SyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785725341),
('UL9be6e1L9FohExVsIf41SSazjbFClo5y2pDFZKN', NULL, '3.142.166.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0N4aThrRGRsRXlxSmdib2h4UEhvTlNlWGJLVEtLcnNVTndWZTg0aiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785074950),
('Uob723EBTj9v8W73hdKXXZkIvwUBQ51cbYlBnoJl', NULL, '52.3.206.35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejBkZFBmdUQ4MWRMR3RSN3NSeE5YOXU0eTVFcXF6THMyVFlIOFJ0cCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785725342),
('V8ZNfxTDREJ8ii9qgQoDEU5b6XEbWzdOgR7fXJVl', NULL, '178.63.73.169', 'Mozilla/5.0 (compatible; wp2shell-checker/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1FySlM4eXNJMGJENnFQU3JKVzNETlNoblRpZFJNZUNZS2NrVFhNNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785299962),
('VCsm0jGTOs13E5qMhzST5y9CwRcGJrQTDA69Rq6E', NULL, '54.173.131.118', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnhVdnlvZmp3cE1zblVNM2VPSXFKaHFFd2Y2VUFjMUdtT1BieDhIdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1784998992),
('VHGYFp6yulqwpbVkbGtZEmdPrP26DOpQ0RDwMZ3R', NULL, '192.227.176.16', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:109.0) Gecko/20100101 Firefox/115.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnFpV1p6aDgxZ3F1T3hzQ2RqRHVLTlRCMFdXanBCZ2poWnpqeTZjUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785063082),
('VKfcK0gBOVs6jztOLFvxAilTLaqs0znXC9LgAcXR', NULL, '3.77.92.222', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRElRMGRiZktlOE0wMXd4YmdNaWdIa0hmWDB0STR0OHN5cDVraTBDNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785031999),
('Vw1nSI0pBgjFNIfdXmvugb0FkKZaBGVlgGpDX4O7', NULL, '195.178.110.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/122.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0tyQ09wdnlFdEtUcmw3b0RPSXRoekxSRUJSdVVpb2xtUW5Kd0RTUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785078927),
('vWeVkQXrFkhoxPvAmcSASQcutjqIq0eU6LZ9Kpkl', NULL, '52.3.206.35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHBpRVhoeWcxWk1XdGxuVUV3YW91QlJkZ1RyS0p4c1p4OUpUSW5QZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785725341),
('VxB6hWrJxQMneziufA6wR84TgWmD02SkRF9eUSTq', NULL, '35.185.4.234', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0hJTWZWQ043Y2VmdlNKUkJXY25FU0RzUGRlbkFuZVFNV0gwbHd3bCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785060722),
('vxBGKsbbjFHXCvJakdVOP8GmVz19VqA7whNEEOs4', NULL, '23.180.120.148', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZW1jMGpsQ3p0Z3dxT1k4RFFYRnRhRXljbVN4anNUZXpvUVVWYTl1QyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785301904),
('VyL2pUF9IIEviZoHXv6wbBWO86BFSmEhvXxxa0a7', NULL, '35.245.187.47', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVpGZkxhZ0lGRGI0dExqdDdDOGdnU2VTbVVOS084amM0NkFablRpVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785415335),
('WEKxznd4G23T9kfFRbHzWq0G26g6uE5mHh6TxUva', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUm9ieW9VcTFZZzE5Wm1mWVpxTFpEVndnQVpQOXlaWU1zaUIwazYwWSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjk0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3RvcmFnZS92ZXNzZWwtY2VydGlmaWNhdGVzL2ZHUWFDUXdQVlVkY2JzcXpHYjJvenB5U3ZneGdvRmNTVmFVWkpIdUMucGRmIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O3M6MTY6ImFjdGl2ZV9wZXJpb2RfaWQiO2k6MTA7fQ==', 1785727894);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('WV5YQCK3d1Ht8uNBZgSL362c6IaVjoYxOGvHDjVo', NULL, '198.235.24.168', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiek1zU2h3ZHhWcllwZFhHM3BNRGZ4MDZ5Rm81UzA2WGRnUU9DRjB4RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785237166),
('Wvl6n37QYUyOOyZyr5kr1HUWJsMIwAGlk8z9XcFu', NULL, '94.154.43.183', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVRxM3F2bHExaUlIMHhSWnAycWpoMWFLbFhIY3kxM0Y0dXdlUUlkTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785151862),
('xh0olODpuNKdSNeAE1fPL5MfCaR60fXXKJ3Mcpw6', NULL, '64.95.11.158', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; GPTBot/1.1; +https://openai.com/gptbot', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNzJCZXB0dGw1aGFxNWVvOVdFbDJwbnYyd25Wb3VTOGJlaXQ4OGhoTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785240391),
('xSrcHizaNgJQAI9pJ9vxs0g6ngRTwrylaxfol7sW', NULL, '195.96.139.165', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2FxZk5uWW9MSXU2a2oxSldxV0RuOWJJcWxDQzFpMUV3eGF0YlQxYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785301160),
('Y9DoKmmzzGGO8nVBChbXoWK6oE34r8v9MlYAwKfr', NULL, '34.23.187.121', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXBnTmVpTDBHQk4yNHU0UHRyVTJQRXM3Y1JzUnVOTVhOM3E2aVdBeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785062049),
('yHccsyD8UMqRKKOq6Y0Vact77o4M3Mt1fAt4mK3u', NULL, '87.236.176.250', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzR2am5zZDlJZnNuZnRkd2dTQ1dwVjBBVUgwczNPZEhFZ3hlcUxkNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785385301),
('ykHIam2wpaAkb6m2vWZy76jhcOMb4IkdjGQAcBuT', NULL, '195.178.110.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/122.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZ2dOckNnVmxTb2lOVVowNEhObzg5bFI5dXhYcmhKSlVOMWtmOWsydiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785078928),
('yy57bERliQYBQon3JFFOcjj081n9W4At5PPjChAk', NULL, '45.148.10.217', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVERQSTR2a0NsV3o2bWpCUGlwc0MwbDllTm9JT1hlTURNM2NSS1NsZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1784975723),
('Zch1YBNmTgKnCo8Znx5irPGRATOFP0NgYAqlEtNH', NULL, '198.235.24.174', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnU5V3JaSHhXc1JhS2thM0NLbFRkUDdzeXhFMkdIcEtsNmZXdEx3UiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1784991429),
('Zgb1dKv8xU7IKzlZKB0tRN5MsRYR1Qp1ig15tAEy', NULL, '81.217.16.32', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRllTOXFkanU3cnRMQ2cwMGZaYXZ1TldkczlKTG9IbUp2Nlc1bjF5RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785053803),
('zJfh9mciRgx0I6LviyX2zh5WPFoQGeN7tAQMyzCB', NULL, '198.235.24.168', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTZ6Q1B1NjBkcEtSOTZBMVJaQjNWOUxsNWNaRjhCQnE3QXV6bFBjNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vYXBwLm1hcmluZW9wcy5pZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785237165),
('Zz8IO5ISC5LWKk9sHZylwmHR2i6f3vTQynM9dfQa', NULL, '205.210.31.165', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFltbDZENUV6bGIxYTNCbFZGeFJWUXB6M0JpODg1dGFQa0xHVGtYRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vd3d3LmFwcC5tYXJpbmVvcHMuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785088451);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_platform_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_platform_admin`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@marineops.id', NULL, '$2y$12$Baywm5M0PKwRUJQwH7s4zuu0T.e3Th93sVbICWmfyQ2kaDRV54yZi', NULL, 1, 1, '2026-01-13 21:11:34', '2026-04-21 06:46:42'),
(6, 'Operasion Global Maritim', 'operasion@globalmaritim.id', NULL, '$2y$12$hkWJE1T9vF9T.S/56b3P.ORCVJLZg41Tn/gI0hL4UmGxHYIxqroTi', NULL, 0, 1, '2026-01-18 21:56:35', '2026-05-19 03:53:03'),
(7, 'Operasion Mitra Maritim', 'operasion@mitramaritim.com', NULL, '$2y$12$Fe98AezwaYhBlp56OXBhXuxrM971p165dxZkitty55Atn3oUcQ8cK', NULL, 0, 1, '2026-01-19 00:29:49', '2026-05-19 04:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_companies`
--

CREATE TABLE `user_companies` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_companies`
--

INSERT INTO `user_companies` (`id`, `user_id`, `company_id`, `is_active`, `created_at`, `updated_at`) VALUES
(13, 6, 9, 1, '2026-01-19 00:20:07', '2026-01-19 00:20:07'),
(18, 7, 11, 1, '2026-01-21 02:37:48', '2026-01-21 02:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `vessels`
--

CREATE TABLE `vessels` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vessels`
--

INSERT INTO `vessels` (`id`, `company_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(7, 9, 'SPOB AAA MARINE 05', 6, '2026-01-22 19:47:21', '2026-02-05 03:54:58'),
(8, 11, 'TB Tiga Permata', 7, '2026-01-22 20:23:01', '2026-01-22 20:23:01'),
(9, 11, 'TK Selaras 01', 7, '2026-01-22 20:23:06', '2026-01-22 20:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `vessel_certificates`
--

CREATE TABLE `vessel_certificates` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `vessel_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `certificate_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vessel_certificates`
--

INSERT INTO `vessel_certificates` (`id`, `company_id`, `vessel_id`, `name`, `issue_date`, `expiry_date`, `certificate_file`, `created_by`, `created_at`, `updated_at`) VALUES
(29, 11, 9, 'ANTI FOULING SYSTEM', '2025-11-14', '2028-02-01', 'vessel-certificates/MBsPjAWK4gPB0mKmtGcZCsO7DqEWHOEz2cB7Alhv.pdf', 7, '2026-03-26 03:34:14', '2026-03-26 03:34:14'),
(30, 11, 9, 'SURAT LAUT', '2025-12-20', '2026-12-20', 'vessel-certificates/FuL2juOe8bkH6S8BRKE13ZzonKg414QV1uF9HuxY.pdf', 7, '2026-03-26 03:35:28', '2026-03-26 03:35:28'),
(31, 11, 9, 'SERTIFIKAT SANITASI', '2026-03-15', '2026-09-15', 'vessel-certificates/axJz6vxaWxQe9rFJ6ddqh3KqyacN9cgKBqCkSSNl.pdf', 7, '2026-03-26 03:36:19', '2026-05-19 04:25:33'),
(32, 11, 9, 'KES.PERLENGKAPAN', '2025-08-15', '2026-07-31', 'vessel-certificates/fGQaCQwPVUdcbsqzGb2ozpySvgxgoFcSVaUZJHuC.pdf', 7, '2026-03-26 03:37:36', '2026-03-26 03:37:36'),
(33, 11, 9, 'KES.KONSTRUKSI', '2025-08-15', '2026-07-31', 'vessel-certificates/nBsHByDKzULVGdU3yWyRAr8mGx07L2fEEW6Iiit6.pdf', 7, '2026-03-26 03:38:34', '2026-03-26 03:38:34'),
(34, 11, 9, 'ILR, FE, HRU', '2026-07-06', '2026-07-06', 'vessel-certificates/hJhrgE4mb97tzVck7BAhr7ZD8DPIDQbkFEEA7YFS.pdf', 7, '2026-03-26 03:39:37', '2026-03-26 03:39:37'),
(36, 11, 9, 'SNPP', '2024-12-11', '2026-12-11', 'vessel-certificates/iX7IHEhO3y4DXfmDwESpNRCPHhan464O6tzQvIwP.pdf', 7, '2026-03-26 03:41:16', '2026-03-26 03:41:16'),
(37, 11, 9, 'SURAT UKUR', '2011-11-06', '2030-11-06', 'vessel-certificates/u8I9mVDv5WKgC4TD1f28X6gi4wPNfV8ic34c8wGe.pdf', 7, '2026-03-26 03:42:36', '2026-03-26 03:42:36'),
(38, 11, 8, 'RPK TRAMPER', '2026-04-30', '2026-08-25', 'vessel-certificates/MqO21XWw8ftWkzoXg9ISuvaVfW6kycpliuisiAqz.pdf', 7, '2026-03-26 03:54:06', '2026-07-24 07:55:04'),
(39, 11, 8, 'SNPP', '2025-11-24', '2028-08-24', 'vessel-certificates/v0tAugDKyRj3j6I2clmqqUsdVYxqC0xBqlSJdeg9.pdf', 7, '2026-03-26 03:55:20', '2026-03-26 03:55:20'),
(40, 11, 8, 'KES.RADIO', '2026-06-14', '2026-07-16', 'vessel-certificates/F7hkVf0ixfIDBw7WGxElYOzPazSMpv18oNwI4eqw.pdf', 7, '2026-03-26 03:56:32', '2026-07-24 07:53:33'),
(41, 11, 8, 'KES.PERLENGKAPAN', '2026-06-14', '2026-07-16', 'vessel-certificates/YAG8HxvUCIs8VvdZM6FuGt9KTa0GhVaOQDxYMy37.pdf', 7, '2026-03-26 03:57:25', '2026-07-24 07:54:06'),
(42, 11, 8, 'KES.KONSTRUKSI', '2026-06-14', '2026-07-16', 'vessel-certificates/JFk1JrV4dtflYb27HxInIHIBJDF8A46Q3RDgjWK1.pdf', 7, '2026-03-26 03:58:31', '2026-07-24 07:54:44'),
(43, 11, 8, 'ILR, FE, HRU', '2025-08-15', '2026-08-15', 'vessel-certificates/1UuNfA5QlIaDvCC7ySD5DGO5xDaFhuaEEYoR5AkM.pdf', 7, '2026-03-26 04:00:01', '2026-03-26 04:00:01'),
(44, 11, 8, 'SANITASI KAPAL / SSCEC', '2026-03-15', '2026-09-15', 'vessel-certificates/QSxKqtE5UH0WwIYwHAQcO8UTefEwjbUTPCkFBEeO.pdf', 7, '2026-03-26 04:01:11', '2026-05-19 04:22:22'),
(45, 11, 8, 'CLC OIL POLLUTION & REMOVAL OF WRECKS', '2025-09-16', '2026-08-08', 'vessel-certificates/iz300rG9SdEA5cLF8wFuc7kpLPa9nXRyQ9WqL2ux.pdf', 7, '2026-03-26 04:02:18', '2026-03-26 04:02:18'),
(46, 11, 8, 'SURAT LAUT', '2025-08-29', '2026-08-29', 'vessel-certificates/5HQG06bosd8ipfysfyOLEIOeSje0b32rgovhosgw.pdf', 7, '2026-03-26 04:04:54', '2026-03-26 04:04:54'),
(47, 11, 8, 'GROSS AKTA', '2019-05-03', '2050-05-03', 'vessel-certificates/VCQxbI0RvhnVjFsQHn7G9hV6Q9XCNa0F2qt2Xm66.pdf', 7, '2026-03-26 04:06:17', '2026-03-26 04:06:17'),
(48, 11, 8, 'ANTI FOULING SYSTEM', '2024-12-08', '2026-07-14', 'vessel-certificates/x48X3uKcVoFXnw2usIzsi8mkG49B7RNOL7PEgGBT.pdf', 7, '2026-03-26 04:07:54', '2026-03-26 04:07:54'),
(49, 11, 8, 'SPESIFIKASI KAPAL', '2019-11-06', '2050-11-06', 'vessel-certificates/mVYmd3zoJzVMUbGCskjCk6Sf0gcxEelovPa9L9Sf.pdf', 7, '2026-03-26 04:08:48', '2026-03-26 04:08:48'),
(50, 11, 8, 'KLAS BKI MESIN', '2024-03-15', '2028-11-23', 'vessel-certificates/XyBCUADtqJPAtovkQsn3n6HfuLf43WumkXmgEF5B.pdf', 7, '2026-03-26 04:09:49', '2026-03-26 04:09:49'),
(51, 11, 8, 'KLAS BKI LOADLINE', '2024-03-15', '2028-11-23', 'vessel-certificates/e6RwZZmY5UVZlpYDuqcc5mPFpqGq9p6ysVrjzIqj.pdf', 7, '2026-03-26 04:10:54', '2026-03-26 04:10:54'),
(52, 11, 8, 'KLAS BKI LAMBUNG', '2024-03-15', '2028-11-23', 'vessel-certificates/SdDYQdtPHtaGD212ceYfTDtE6ELAfbJkYmjvpEAb.pdf', 7, '2026-03-26 04:12:19', '2026-03-26 04:12:19'),
(53, 11, 8, 'SAFE MANNING', '2026-05-25', '2026-08-24', 'vessel-certificates/Am6lB834ErZqGIp6SfrSWi1z9UGQ5oMJeVAOk1WU.pdf', 7, '2026-03-26 04:13:14', '2026-07-24 07:57:10'),
(54, 11, 8, 'SURAT UKUR', '1998-04-05', '2050-04-05', 'vessel-certificates/gjEEaf0G3CsPcZPtwVoqFXMnK0kvV343J805Wa07.pdf', 7, '2026-03-26 04:14:09', '2026-03-26 04:14:09'),
(59, 11, 9, 'BKI - LOAD LINE', '2025-09-18', '2027-03-10', 'vessel-certificates/NrZfCLdaKwtvHMdqW2YQxX14pehVJDOygYeoDrGk.pdf', 7, '2026-07-24 08:09:05', '2026-07-24 08:09:05'),
(60, 11, 9, 'BKI - LAMBUNG', '2025-09-18', '2027-03-10', 'vessel-certificates/LuXMv1pLTUM5Ox1QD0k2BqTWXnMhpC0JCuF14yAp.pdf', 7, '2026-07-24 08:09:51', '2026-07-24 08:09:51'),
(61, 11, 9, 'BKI - MESIN', '2025-09-18', '2027-03-10', 'vessel-certificates/SU85E1szNQWdUqyFAXJKHv3u4kRh9zfcDhfoe07w.pdf', 7, '2026-07-24 08:10:28', '2026-07-24 08:10:28'),
(62, 11, 9, 'RPK TRAMPER', '2026-05-26', '2026-08-25', 'vessel-certificates/jTnDwt0fvRfxogADjvXkmOFu9krhJbbXuiWSXqCY.pdf', 7, '2026-07-24 08:11:52', '2026-07-24 08:11:52'),
(63, 11, 9, 'SPEK KAPAL', '2026-05-25', '2027-05-13', 'vessel-certificates/hTnxamGK1HwLQPAyboQkQ85x1UwzxIo4nYeX5CNG.pdf', 7, '2026-07-24 08:12:53', '2026-07-24 08:12:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agendas_created_by_foreign` (`created_by`);

--
-- Indexes for table `amprahans`
--
ALTER TABLE `amprahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `amprahans_company_id_foreign` (`company_id`),
  ADD KEY `amprahans_vessel_id_foreign` (`vessel_id`),
  ADD KEY `amprahans_created_by_foreign` (`created_by`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assets_company_id_foreign` (`company_id`),
  ADD KEY `assets_vessel_id_foreign` (`vessel_id`),
  ADD KEY `assets_asset_group_id_foreign` (`asset_group_id`),
  ADD KEY `assets_created_by_foreign` (`created_by`);

--
-- Indexes for table `asset_groups`
--
ALTER TABLE `asset_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_groups_created_by_foreign` (`created_by`);

--
-- Indexes for table `asset_maintenance_logs`
--
ALTER TABLE `asset_maintenance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_maintenance_logs_company_id_foreign` (`company_id`),
  ADD KEY `asset_maintenance_logs_asset_id_foreign` (`asset_id`),
  ADD KEY `asset_maintenance_logs_created_by_foreign` (`created_by`);

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
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargos_company_id_foreign` (`company_id`),
  ADD KEY `cargos_created_by_foreign` (`created_by`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_company_id_foreign` (`company_id`),
  ADD KEY `clients_created_by_foreign` (`created_by`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `companies_created_by_foreign` (`created_by`);

--
-- Indexes for table `crews`
--
ALTER TABLE `crews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crews_company_id_foreign` (`company_id`),
  ADD KEY `crews_vessel_id_foreign` (`vessel_id`),
  ADD KEY `crews_created_by_foreign` (`created_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periods_company_id_foreign` (`company_id`),
  ADD KEY `periods_created_by_foreign` (`created_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ports_company_id_foreign` (`company_id`),
  ADD KEY `ports_created_by_foreign` (`created_by`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_uuid_unique` (`uuid`),
  ADD KEY `projects_company_id_foreign` (`company_id`),
  ADD KEY `projects_period_id_foreign` (`period_id`),
  ADD KEY `projects_client_id_foreign` (`client_id`),
  ADD KEY `projects_created_by_foreign` (`created_by`);

--
-- Indexes for table `project_document_types`
--
ALTER TABLE `project_document_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_document_types_created_by_foreign` (`created_by`);

--
-- Indexes for table `project_document_uploads`
--
ALTER TABLE `project_document_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_document_uploads_company_id_foreign` (`company_id`),
  ADD KEY `project_document_uploads_period_id_foreign` (`period_id`),
  ADD KEY `project_document_uploads_project_id_foreign` (`project_id`),
  ADD KEY `project_document_uploads_document_type_id_foreign` (`document_type_id`),
  ADD KEY `project_document_uploads_created_by_foreign` (`created_by`);

--
-- Indexes for table `project_timesheets`
--
ALTER TABLE `project_timesheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_timesheets_company_id_foreign` (`company_id`),
  ADD KEY `project_timesheets_period_id_foreign` (`period_id`),
  ADD KEY `project_timesheets_project_id_foreign` (`project_id`),
  ADD KEY `project_timesheets_created_by_foreign` (`created_by`);

--
-- Indexes for table `project_vessels`
--
ALTER TABLE `project_vessels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_vessels_company_id_foreign` (`company_id`),
  ADD KEY `project_vessels_period_id_foreign` (`period_id`),
  ADD KEY `project_vessels_project_id_foreign` (`project_id`),
  ADD KEY `project_vessels_vessel_id_foreign` (`vessel_id`),
  ADD KEY `project_vessels_created_by_foreign` (`created_by`);

--
-- Indexes for table `project_voyages`
--
ALTER TABLE `project_voyages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_voyages_company_id_foreign` (`company_id`),
  ADD KEY `project_voyages_period_id_foreign` (`period_id`),
  ADD KEY `project_voyages_project_id_foreign` (`project_id`),
  ADD KEY `project_voyages_cargo_id_foreign` (`cargo_id`),
  ADD KEY `project_voyages_loading_port_id_foreign` (`loading_port_id`),
  ADD KEY `project_voyages_discharge_port_id_foreign` (`discharge_port_id`),
  ADD KEY `project_voyages_created_by_foreign` (`created_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_companies`
--
ALTER TABLE `user_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_companies_user_id_company_id_unique` (`user_id`,`company_id`),
  ADD KEY `user_companies_company_id_foreign` (`company_id`);

--
-- Indexes for table `vessels`
--
ALTER TABLE `vessels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vessels_company_id_foreign` (`company_id`),
  ADD KEY `vessels_created_by_foreign` (`created_by`);

--
-- Indexes for table `vessel_certificates`
--
ALTER TABLE `vessel_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vessel_certificates_company_id_foreign` (`company_id`),
  ADD KEY `vessel_certificates_vessel_id_foreign` (`vessel_id`),
  ADD KEY `vessel_certificates_created_by_foreign` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `amprahans`
--
ALTER TABLE `amprahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `asset_groups`
--
ALTER TABLE `asset_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `asset_maintenance_logs`
--
ALTER TABLE `asset_maintenance_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `crews`
--
ALTER TABLE `crews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `project_document_types`
--
ALTER TABLE `project_document_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `project_document_uploads`
--
ALTER TABLE `project_document_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `project_timesheets`
--
ALTER TABLE `project_timesheets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `project_vessels`
--
ALTER TABLE `project_vessels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `project_voyages`
--
ALTER TABLE `project_voyages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_companies`
--
ALTER TABLE `user_companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `vessels`
--
ALTER TABLE `vessels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vessel_certificates`
--
ALTER TABLE `vessel_certificates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `amprahans`
--
ALTER TABLE `amprahans`
  ADD CONSTRAINT `amprahans_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `amprahans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `amprahans_vessel_id_foreign` FOREIGN KEY (`vessel_id`) REFERENCES `vessels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_asset_group_id_foreign` FOREIGN KEY (`asset_group_id`) REFERENCES `asset_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assets_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assets_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assets_vessel_id_foreign` FOREIGN KEY (`vessel_id`) REFERENCES `vessels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `asset_groups`
--
ALTER TABLE `asset_groups`
  ADD CONSTRAINT `asset_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `asset_maintenance_logs`
--
ALTER TABLE `asset_maintenance_logs`
  ADD CONSTRAINT `asset_maintenance_logs_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_maintenance_logs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_maintenance_logs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `cargos_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cargos_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clients_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crews`
--
ALTER TABLE `crews`
  ADD CONSTRAINT `crews_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crews_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crews_vessel_id_foreign` FOREIGN KEY (`vessel_id`) REFERENCES `vessels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `periods`
--
ALTER TABLE `periods`
  ADD CONSTRAINT `periods_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `periods_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ports`
--
ALTER TABLE `ports`
  ADD CONSTRAINT `ports_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ports_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_document_types`
--
ALTER TABLE `project_document_types`
  ADD CONSTRAINT `project_document_types_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_document_uploads`
--
ALTER TABLE `project_document_uploads`
  ADD CONSTRAINT `project_document_uploads_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_document_uploads_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_document_uploads_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `project_document_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_document_uploads_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_document_uploads_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_timesheets`
--
ALTER TABLE `project_timesheets`
  ADD CONSTRAINT `project_timesheets_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_timesheets_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `project_timesheets_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_timesheets_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_vessels`
--
ALTER TABLE `project_vessels`
  ADD CONSTRAINT `project_vessels_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_vessels_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_vessels_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_vessels_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_vessels_vessel_id_foreign` FOREIGN KEY (`vessel_id`) REFERENCES `vessels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_voyages`
--
ALTER TABLE `project_voyages`
  ADD CONSTRAINT `project_voyages_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_voyages_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_voyages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `project_voyages_discharge_port_id_foreign` FOREIGN KEY (`discharge_port_id`) REFERENCES `ports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_voyages_loading_port_id_foreign` FOREIGN KEY (`loading_port_id`) REFERENCES `ports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_voyages_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_voyages_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_companies`
--
ALTER TABLE `user_companies`
  ADD CONSTRAINT `user_companies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vessels`
--
ALTER TABLE `vessels`
  ADD CONSTRAINT `vessels_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vessels_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vessel_certificates`
--
ALTER TABLE `vessel_certificates`
  ADD CONSTRAINT `vessel_certificates_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vessel_certificates_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vessel_certificates_vessel_id_foreign` FOREIGN KEY (`vessel_id`) REFERENCES `vessels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
