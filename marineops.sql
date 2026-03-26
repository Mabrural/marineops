-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2026 at 06:31 AM
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
(8, 9, 7, '2026-01-05', 'Oli Mesin SAE 40', NULL, 20, 'liter', 'PT Marine Supply', 240000.00, 4800000.00, 6, '2026-03-04 09:47:30', '2026-03-04 09:47:30'),
(10, 9, 7, '2026-03-04', 'Filter Solar', NULL, 1, 'liter', NULL, NULL, 0.00, 6, '2026-03-04 10:05:33', '2026-03-04 10:05:33'),
(11, 9, 7, '2026-03-04', 'Filter Solar', NULL, 1, 'liter', NULL, NULL, 0.00, 6, '2026-03-04 10:05:42', '2026-03-04 10:05:42'),
(12, 9, 7, '2026-03-04', 'Filter Solar', NULL, 1, 'L', NULL, NULL, 0.00, 6, '2026-03-04 10:05:58', '2026-03-04 10:05:58'),
(13, 9, 7, '2026-03-04', 'Oli Mesin SAE 40', NULL, 1, 'pcs', NULL, NULL, 0.00, 6, '2026-03-04 10:06:12', '2026-03-04 10:06:12');

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
(4, 9, 7, 4, 'GPS', 'GP-32', 1, 'Baik', 6, '2026-03-02 06:18:01', '2026-03-02 06:18:01'),
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
('marineops-cache-mabruralmutaqi@gmail.com|127.0.0.1', 'i:1;', 1769398685),
('marineops-cache-mabruralmutaqi@gmail.com|127.0.0.1:timer', 'i:1769398685;', 1769398685),
('marineops-cache-operasional@globalmaritim.com|127.0.0.1', 'i:1;', 1772000442),
('marineops-cache-operasional@globalmaritim.com|127.0.0.1:timer', 'i:1772000442;', 1772000442),
('marineops-cache-ptglobalmaritimnusantara@gmail.com|127.0.0.1', 'i:5;', 1770264640),
('marineops-cache-ptglobalmaritimnusantara@gmail.com|127.0.0.1:timer', 'i:1770264640;', 1770264640);

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
(6, 9, 'CRUD', 6, '2026-03-25 07:48:28', '2026-03-25 07:48:28');

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
(6, 9, 'PT Tamatech Waste Industry', 'Nongsa', 6, '2026-01-19 02:09:29', '2026-01-19 02:14:02'),
(7, 9, 'PT Berkat Cahaya Indah', 'Dumai', 6, '2026-01-19 02:09:40', '2026-01-19 02:13:53'),
(9, 9, 'PT Mito Energi Indonesia', NULL, 6, '2026-01-19 02:12:24', '2026-01-19 02:15:12'),
(12, 9, 'PT Petrolindo Energy Mandiri', 'Jl. Central Raya No. 17, Komplek The Centro Town House, Kel. Sukajadi, Kec. Batam Kota', 6, '2026-03-25 07:26:37', '2026-03-25 07:26:37');

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

--
-- Dumping data for table `crews`
--

INSERT INTO `crews` (`id`, `company_id`, `vessel_id`, `name`, `gender`, `date_of_birth`, `nationality`, `seafarer_code`, `seafarer_book_number`, `seafarer_book_expired_at`, `position`, `certificate`, `certificate_number`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(17, 9, 7, 'KAESANG', 'Female', NULL, 'Indonesia', NULL, NULL, NULL, NULL, NULL, NULL, 1, 6, '2026-03-04 02:56:58', '2026-03-25 07:02:54');

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
(29, '2026_03_04_152137_create_amprahans_table', 22);

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
(18, 11, 'Dumai', 7, '2026-01-19 02:43:45', '2026-01-19 02:43:45');

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
(10, '15fe81e8-7a56-47ee-92e1-23f97a6df29a', 9, 13, 9, 1, 'freight_charter', '2026-02-02', '2026-02-17', 650000000.00, 'finished', 6, '2026-02-05 03:55:50', '2026-02-05 07:35:46'),
(11, 'e5499adb-89b2-4dd0-9ef0-2f4577a2af31', 9, 13, 6, 2, 'freight_charter', NULL, NULL, 550000000.00, 'active', 6, '2026-02-05 07:32:26', '2026-02-26 03:44:26');

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

--
-- Dumping data for table `project_timesheets`
--

INSERT INTO `project_timesheets` (`id`, `company_id`, `period_id`, `project_id`, `datetime`, `position`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(10, 9, 13, 11, '2026-02-26 15:39:00', 'Sintang Raya', 'Sailing ETA 18:20', 6, '2026-02-26 08:40:03', '2026-02-26 08:40:03'),
(11, 9, 13, 11, '2026-02-26 15:44:00', 'Sintang Raya', 'Sailing ETA 18:20', 6, '2026-02-26 08:44:36', '2026-02-26 08:44:36'),
(12, 9, 13, 11, '2026-02-27 10:43:00', 'Sailing', 'Sailing to Tayan', 6, '2026-02-27 03:43:38', '2026-02-27 03:43:38'),
(13, 9, 13, 11, '2026-02-27 10:44:00', 'qqq', 'qqq', 6, '2026-02-27 03:45:05', '2026-02-27 03:45:05'),
(14, 9, 13, 11, '2026-02-27 10:45:00', 'qwe', 'qwe', 6, '2026-02-27 03:45:15', '2026-02-27 03:45:15'),
(15, 9, 13, 11, '2026-02-27 10:45:00', 'qweqwe', 'qweqweqw', 6, '2026-02-27 03:45:22', '2026-02-27 03:45:22'),
(16, 9, 13, 11, '2026-02-27 10:45:00', 'asd', 'asdas', 6, '2026-02-27 03:45:31', '2026-02-27 03:45:31'),
(17, 9, 13, 11, '2026-02-27 10:45:00', 'asd', 'asdas', 6, '2026-02-27 03:45:37', '2026-02-27 03:45:37'),
(18, 9, 13, 11, '2026-02-27 10:45:00', 'zxc', 'zxc', 6, '2026-02-27 03:46:02', '2026-02-27 03:46:02'),
(19, 9, 13, 11, '2026-02-27 10:46:00', 'zxc', 'zxczx', 6, '2026-02-27 03:46:23', '2026-02-27 03:46:23'),
(20, 9, 13, 11, '2026-02-27 10:47:00', 'fsas', 'asdasdasdasdasdasdasdasdas', 6, '2026-02-27 03:48:31', '2026-02-27 03:48:31'),
(21, 9, 13, 11, '2026-02-27 10:47:00', 'asdasdasdasdasd', 'asdasdasdas', 6, '2026-02-27 03:48:46', '2026-02-27 03:48:46'),
(22, 9, 13, 11, '2026-02-27 10:48:00', 'ddddd', 'dddddd', 6, '2026-02-27 03:49:42', '2026-02-27 03:49:42'),
(23, 9, 13, 11, '2026-02-27 10:48:00', 'ddddd', 'dddddd', 6, '2026-02-27 03:49:57', '2026-02-27 03:49:57'),
(24, 9, 13, 11, '2026-02-26 10:50:00', 'asdasd', 'asdasdasd', 6, '2026-02-27 03:50:07', '2026-02-27 03:50:07'),
(25, 9, 13, 11, '2026-02-27 10:50:00', 'asdasda', 'asdasd', 6, '2026-02-27 03:50:15', '2026-02-27 03:50:15'),
(26, 9, 13, 11, '2026-02-27 10:50:00', 'asdasd', 'asdasd', 6, '2026-02-27 03:50:22', '2026-02-27 03:50:22'),
(27, 9, 13, 11, '2026-02-27 10:50:00', '123123', '1231231231231231231231231231', 6, '2026-02-27 03:50:56', '2026-02-27 03:50:56'),
(28, 9, 13, 11, '2026-02-27 10:51:00', '212312321321', '12312312321321', 6, '2026-02-27 03:51:07', '2026-02-27 03:51:07'),
(29, 9, 13, 11, '2026-02-27 10:51:00', 'bnm', 'bnm', 6, '2026-02-27 03:51:16', '2026-02-27 03:51:16'),
(30, 9, 13, 11, '2026-02-27 10:51:00', 'mmmmmm', 'mmmmmmm', 6, '2026-02-27 03:51:22', '2026-02-27 03:51:22'),
(31, 9, 13, 11, '2026-02-27 10:51:00', 'mmmmm', 'mmmmm', 6, '2026-02-27 03:51:29', '2026-02-27 03:51:29'),
(32, 9, 13, 11, '2026-02-27 10:51:00', 'nnnnn', 'nnnnnn', 6, '2026-02-27 03:51:41', '2026-02-27 03:51:41'),
(33, 9, 13, 11, '2026-02-27 10:51:00', 'bbbbbb', 'bbbbbbb', 6, '2026-02-27 03:51:48', '2026-02-27 03:51:48'),
(34, 9, 13, 11, '2026-02-27 10:55:00', 'ssssss', 'ssssssssssssssssssssssssssssssssssssssssssssssssss', 6, '2026-02-27 03:55:15', '2026-02-27 03:55:15'),
(35, 9, 13, 11, '2026-02-27 10:55:00', 'sasassssssssssssssssssssa', 'asaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 6, '2026-02-27 03:55:30', '2026-02-27 03:55:30'),
(36, 9, 13, 11, '2026-02-27 10:55:00', 'aaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', 6, '2026-02-27 03:55:44', '2026-02-27 03:55:44'),
(37, 9, 13, 11, '2026-02-27 10:55:00', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 6, '2026-02-27 03:55:56', '2026-02-27 03:55:56'),
(38, 9, 13, 11, '2026-02-27 10:56:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:56:15', '2026-02-27 03:56:15'),
(39, 9, 13, 11, '2026-02-27 10:56:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:56:24', '2026-02-27 03:56:24'),
(40, 9, 13, 11, '2026-02-27 10:56:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:56:29', '2026-02-27 03:56:29'),
(41, 9, 13, 11, '2026-02-27 10:56:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:56:38', '2026-02-27 03:56:38'),
(42, 9, 13, 11, '2026-02-27 10:56:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:56:53', '2026-02-27 03:56:53'),
(43, 9, 13, 11, '2026-02-27 10:57:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:57:07', '2026-02-27 03:57:07'),
(44, 9, 13, 11, '2026-02-27 10:57:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:57:15', '2026-02-27 03:57:15'),
(45, 9, 13, 11, '2026-02-27 10:57:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:57:28', '2026-02-27 03:57:28'),
(46, 9, 13, 11, '2026-02-27 10:57:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:57:33', '2026-02-27 03:57:33'),
(47, 9, 13, 11, '2026-02-27 10:57:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:57:44', '2026-02-27 03:57:44'),
(48, 9, 13, 11, '2026-02-27 10:57:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:57:52', '2026-02-27 03:57:52'),
(49, 9, 13, 11, '2026-02-27 10:57:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:58:01', '2026-02-27 03:58:01'),
(50, 9, 13, 11, '2026-02-27 10:58:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:58:23', '2026-02-27 03:58:23'),
(51, 9, 13, 11, '2026-02-27 10:58:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:58:37', '2026-02-27 03:58:37'),
(52, 9, 13, 11, '2026-02-27 10:58:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:58:48', '2026-02-27 03:58:48'),
(53, 9, 13, 11, '2026-02-27 10:58:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:59:03', '2026-02-27 03:59:03'),
(54, 9, 13, 11, '2026-02-27 10:59:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:59:11', '2026-02-27 03:59:11'),
(55, 9, 13, 11, '2026-02-27 10:59:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:59:19', '2026-02-27 03:59:19'),
(56, 9, 13, 11, '2026-02-27 10:59:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:59:27', '2026-02-27 03:59:27'),
(57, 9, 13, 11, '2026-02-27 10:59:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 6, '2026-02-27 03:59:37', '2026-02-27 03:59:37'),
(59, 9, 13, 11, '2026-02-27 10:59:00', 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx5', 6, '2026-02-27 03:59:58', '2026-02-27 04:17:59'),
(60, 9, 13, 11, '2026-02-27 11:11:00', 'wwwww', 'wwwwwwwwwww', 6, '2026-02-27 04:11:33', '2026-03-02 02:53:04');

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
(16, 9, 13, 11, 7, 6, '2026-02-27 05:02:21', '2026-02-27 05:02:21'),
(17, 9, 13, 10, 7, 6, '2026-03-25 03:51:24', '2026-03-25 03:51:24');

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
(7, 9, 13, 11, '002/MMM-BCI/VI/2026', 4, 7, 4, 1800226, 'L', 6, '2026-02-26 07:37:26', '2026-02-26 08:38:40');

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
('7azyednFtmhCG8lqOrcf2CP3frpJbcMfCwsw8oel', NULL, '127.0.0.1', 'Microsoft Office Excel 2014', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQkd1RnZKMmpYMFpRZXY3TUpaU2psNDk2SzFabjVmM0lIRmJHblFDVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774498589),
('YDbv0g5R1CDLPiZyEU38BAV9EbraPk1gLWzz2Xue', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNnB0SlJnTURvRDNXd3BsTlZyRVhNaFVyTkxVUUlicnlXeVQ2NmlzSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3J0cyI7czo1OiJyb3V0ZSI7czoxMToicG9ydHMuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O3M6MTY6ImFjdGl2ZV9wZXJpb2RfaWQiO2k6MTM7fQ==', 1774506492);

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
(1, 'Super Admin', 'superadmin@marineops.id', NULL, '$2y$12$Baywm5M0PKwRUJQwH7s4zuu0T.e3Th93sVbICWmfyQ2kaDRV54yZi', NULL, 1, 1, '2026-01-13 21:11:34', '2026-01-19 01:31:59'),
(6, 'Operasion Global Maritim', 'operasion@globalmaritim.com', NULL, '$2y$12$EO/aTjNo1j51.el88TpOXuavX0mBH/mbmVe1/QKwaroo.YkTp5992', NULL, 0, 1, '2026-01-18 21:56:35', '2026-01-22 01:17:36'),
(7, 'Operasion Mitra Maritim', 'operasion@mitramaritim.com', NULL, '$2y$12$UKsKyob8GdqACYMO0XnB1erzlDkNYAZ94fr8YCoFs/vhCWW4csTGi', NULL, 0, 1, '2026-01-19 00:29:49', '2026-01-19 01:19:44');

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
(31, 11, 9, 'SERTIFIKAT SANITASI', '2025-09-16', '2026-03-15', 'vessel-certificates/JXPCeT59fMP0SZhFY1mDpgkC2P9jTRPPq2tjewN3.pdf', 7, '2026-03-26 03:36:19', '2026-03-26 03:36:19'),
(32, 11, 9, 'KES.PERLENGKAPAN', '2025-08-15', '2026-07-31', 'vessel-certificates/fGQaCQwPVUdcbsqzGb2ozpySvgxgoFcSVaUZJHuC.pdf', 7, '2026-03-26 03:37:36', '2026-03-26 03:37:36'),
(33, 11, 9, 'KES.KONSTRUKSI', '2025-08-15', '2026-07-31', 'vessel-certificates/nBsHByDKzULVGdU3yWyRAr8mGx07L2fEEW6Iiit6.pdf', 7, '2026-03-26 03:38:34', '2026-03-26 03:38:34'),
(34, 11, 9, 'ILR, FE, HRU', '2026-07-06', '2026-07-06', 'vessel-certificates/hJhrgE4mb97tzVck7BAhr7ZD8DPIDQbkFEEA7YFS.pdf', 7, '2026-03-26 03:39:37', '2026-03-26 03:39:37'),
(35, 11, 9, 'SERTIFIKAT KELAS BKI LOADLINE, MESIN, LAMBUNG', '2022-06-07', '2027-03-10', 'vessel-certificates/ZdSMdfaCiBkHrLnsWX2gmqaPIxhRsx5Upg2VLUMd.pdf', 7, '2026-03-26 03:40:25', '2026-03-26 03:40:25'),
(36, 11, 9, 'SNPP', '2024-12-11', '2026-12-11', 'vessel-certificates/iX7IHEhO3y4DXfmDwESpNRCPHhan464O6tzQvIwP.pdf', 7, '2026-03-26 03:41:16', '2026-03-26 03:41:16'),
(37, 11, 9, 'SURAT UKUR', '2011-11-06', '2030-11-06', 'vessel-certificates/u8I9mVDv5WKgC4TD1f28X6gi4wPNfV8ic34c8wGe.pdf', 7, '2026-03-26 03:42:36', '2026-03-26 03:42:36'),
(38, 11, 8, 'RPK TRAMPER', '2026-01-30', '2026-04-30', 'vessel-certificates/rbzcwAcyTel796Qely7TYwre3UJl7lWxzfWOovMe.pdf', 7, '2026-03-26 03:54:06', '2026-03-26 03:54:06'),
(39, 11, 8, 'SNPP', '2025-11-24', '2028-08-24', 'vessel-certificates/v0tAugDKyRj3j6I2clmqqUsdVYxqC0xBqlSJdeg9.pdf', 7, '2026-03-26 03:55:20', '2026-03-26 03:55:20'),
(40, 11, 8, 'KES.RADIO', '2025-11-30', '2026-06-14', 'vessel-certificates/Rn4s4lFQaZlXnqgv2JUecoZA6XlMk4g1Dpcffmbz.pdf', 7, '2026-03-26 03:56:32', '2026-03-26 03:56:32'),
(41, 11, 8, 'KES.PERLENGKAPAN', '2025-11-30', '2026-06-14', 'vessel-certificates/mKOFsHNzi5naEeGMePat4Nhg6PKxkZ4trd0DLGRW.pdf', 7, '2026-03-26 03:57:25', '2026-03-26 03:57:25'),
(42, 11, 8, 'KES.KONSTRUKSI', '2025-11-30', '2026-06-14', 'vessel-certificates/5JR4lwQnzBDV2ImhdBYM1GbuFP3IOHDvhMM9mgyI.pdf', 7, '2026-03-26 03:58:31', '2026-03-26 03:58:31'),
(43, 11, 8, 'ILR, FE, HRU', '2025-08-15', '2026-08-15', 'vessel-certificates/1UuNfA5QlIaDvCC7ySD5DGO5xDaFhuaEEYoR5AkM.pdf', 7, '2026-03-26 04:00:01', '2026-03-26 04:00:01'),
(44, 11, 8, 'SANITASI KAPAL / SSCEC', '2025-09-16', '2026-03-15', 'vessel-certificates/37v74vCZxDvo53M09R3YTnMHKSKdej7IWLTJnccQ.pdf', 7, '2026-03-26 04:01:11', '2026-03-26 04:01:11'),
(45, 11, 8, 'CLC OIL POLLUTION & REMOVAL OF WRECKS', '2025-09-16', '2026-08-08', 'vessel-certificates/iz300rG9SdEA5cLF8wFuc7kpLPa9nXRyQ9WqL2ux.pdf', 7, '2026-03-26 04:02:18', '2026-03-26 04:02:18'),
(46, 11, 8, 'SURAT LAUT', '2025-08-29', '2026-08-29', 'vessel-certificates/5HQG06bosd8ipfysfyOLEIOeSje0b32rgovhosgw.pdf', 7, '2026-03-26 04:04:54', '2026-03-26 04:04:54'),
(47, 11, 8, 'GROSS AKTA', '2019-05-03', '2050-05-03', 'vessel-certificates/VCQxbI0RvhnVjFsQHn7G9hV6Q9XCNa0F2qt2Xm66.pdf', 7, '2026-03-26 04:06:17', '2026-03-26 04:06:17'),
(48, 11, 8, 'ANTI FOULING SYSTEM', '2024-12-08', '2026-07-14', 'vessel-certificates/x48X3uKcVoFXnw2usIzsi8mkG49B7RNOL7PEgGBT.pdf', 7, '2026-03-26 04:07:54', '2026-03-26 04:07:54'),
(49, 11, 8, 'SPESIFIKASI KAPAL', '2019-11-06', '2050-11-06', 'vessel-certificates/mVYmd3zoJzVMUbGCskjCk6Sf0gcxEelovPa9L9Sf.pdf', 7, '2026-03-26 04:08:48', '2026-03-26 04:08:48'),
(50, 11, 8, 'KLAS BKI MESIN', '2024-03-15', '2028-11-23', 'vessel-certificates/XyBCUADtqJPAtovkQsn3n6HfuLf43WumkXmgEF5B.pdf', 7, '2026-03-26 04:09:49', '2026-03-26 04:09:49'),
(51, 11, 8, 'KLAS BKI LOADLINE', '2024-03-15', '2028-11-23', 'vessel-certificates/e6RwZZmY5UVZlpYDuqcc5mPFpqGq9p6ysVrjzIqj.pdf', 7, '2026-03-26 04:10:54', '2026-03-26 04:10:54'),
(52, 11, 8, 'KLAS BKI LAMBUNG', '2024-03-15', '2028-11-23', 'vessel-certificates/SdDYQdtPHtaGD212ceYfTDtE6ELAfbJkYmjvpEAb.pdf', 7, '2026-03-26 04:12:19', '2026-03-26 04:12:19'),
(53, 11, 8, 'SAFE MANNING', '2025-04-08', '2026-04-07', 'vessel-certificates/nBetHRQKDu5YIDMp2BAoWLHxvLFuQADdkTiIrDut.pdf', 7, '2026-03-26 04:13:14', '2026-03-26 04:13:14'),
(54, 11, 8, 'SURAT UKUR', '1998-04-05', '2050-04-05', 'vessel-certificates/gjEEaf0G3CsPcZPtwVoqFXMnK0kvV343J805Wa07.pdf', 7, '2026-03-26 04:14:09', '2026-03-26 04:14:09');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `amprahans`
--
ALTER TABLE `amprahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `asset_groups`
--
ALTER TABLE `asset_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `asset_maintenance_logs`
--
ALTER TABLE `asset_maintenance_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `crews`
--
ALTER TABLE `crews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `project_vessels`
--
ALTER TABLE `project_vessels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `project_voyages`
--
ALTER TABLE `project_voyages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vessel_certificates`
--
ALTER TABLE `vessel_certificates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

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
