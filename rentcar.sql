-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 04:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentcar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `com_code` int(11) NOT NULL,
  `permission_roles_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `com_code`, `permission_roles_id`, `active`, `date`, `created_at`, `updated_at`) VALUES
(1, 'manar', 'admin@admin', 'admin', '$2y$12$Gl4IPgkCj8e9DLXg3cJXTOn2xno1S/UrdmHHhZn1.tcH5IQDDSnrW', 1, 1, 1, '2024-08-05', '2024-08-05 08:34:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plate_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `car_status_id` int(11) NOT NULL,
  `full_insurance` tinyint(4) NOT NULL,
  `third_party` tinyint(4) NOT NULL,
  `full_cover` tinyint(4) NOT NULL,
  `UAE` tinyint(4) NOT NULL,
  `oman` tinyint(4) NOT NULL,
  `km_number` decimal(10,2) NOT NULL,
  `daily_rent_price` decimal(10,2) NOT NULL,
  `hourly_rent_price` decimal(10,2) NOT NULL,
  `weekly_rent_price` decimal(10,2) NOT NULL,
  `monthly_rent_price` decimal(10,2) NOT NULL,
  `km_rent_price` decimal(10,2) NOT NULL,
  `contract_number` int(11) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `plate_number`, `car_color`, `image`, `type_id`, `car_status_id`, `full_insurance`, `third_party`, `full_cover`, `UAE`, `oman`, `km_number`, `daily_rent_price`, `hourly_rent_price`, `weekly_rent_price`, `monthly_rent_price`, `km_rent_price`, `contract_number`, `com_code`, `date`, `added_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '55577', 'black', NULL, 5, 2, 1, 0, 1, 1, 0, '100.00', '500.00', '150.00', '1200.00', '3000.00', '100.00', 2, 1, '2024-08-08', 1, NULL, '2024-08-09 02:05:18', '2024-08-09 22:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `car_expenses`
--

CREATE TABLE `car_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `total_price_tax` decimal(8,2) NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_expenses`
--

INSERT INTO `car_expenses` (`id`, `car_id`, `type_id`, `supplier`, `price`, `tax`, `total_price_tax`, `note`, `date`, `added_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 55577, 2, 'الشرطة', '1455.00', '150.00', '1605.00', NULL, '2024-08-08', 1, NULL, '2024-08-08 17:29:31', '2024-08-08 17:29:31'),
(2, 333333, 5, 'غيار زيت', '14.66', '15.00', '29.66', 'غيار زيت جديد', '2024-08-08', 1, NULL, '2024-08-08 17:44:35', '2024-08-08 17:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `car_status`
--

CREATE TABLE `car_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_status_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_status`
--

INSERT INTO `car_status` (`id`, `car_status_name`, `added_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'متاحة', 1, NULL, '2024-08-07 00:39:48', '2024-08-07 00:39:48'),
(3, 'صيانة', 1, NULL, '2024-08-07 23:33:08', '2024-08-07 23:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `car_types`
--

CREATE TABLE `car_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_types`
--

INSERT INTO `car_types` (`id`, `name`, `added_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'BMW', 1, NULL, '2024-08-06 17:23:02', '2024-08-06 17:23:02'),
(5, 'BG', 1, NULL, '2024-08-07 23:33:36', '2024-08-07 23:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `contract_type` tinyint(4) NOT NULL,
  `contract_number` tinyint(4) NOT NULL,
  `contract_price` decimal(8,2) NOT NULL,
  `contract_status` tinyint(4) NOT NULL,
  `pre_paid_price` decimal(8,2) DEFAULT NULL,
  `paid_price` decimal(8,2) DEFAULT NULL,
  `tax_price` decimal(8,2) DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `excess_km_price` decimal(8,2) DEFAULT NULL,
  `remind_price` decimal(8,2) DEFAULT NULL,
  `penalty_price` decimal(8,2) DEFAULT NULL,
  `patrol_price` decimal(8,2) DEFAULT NULL,
  `washing_price` decimal(8,2) DEFAULT NULL,
  `insurance_price` decimal(8,2) DEFAULT NULL,
  `exist_date` date NOT NULL,
  `exist_time` time NOT NULL,
  `return_date` date NOT NULL,
  `return_time` time NOT NULL,
  `exist_km` decimal(8,2) NOT NULL,
  `return_km` decimal(8,2) DEFAULT NULL,
  `due_km` decimal(8,2) DEFAULT NULL,
  `free_km` decimal(8,2) DEFAULT NULL,
  `total_km` decimal(8,2) DEFAULT NULL,
  `excess_km` decimal(8,2) DEFAULT NULL,
  `date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `car_id`, `customer_id`, `contract_type`, `contract_number`, `contract_price`, `contract_status`, `pre_paid_price`, `paid_price`, `tax_price`, `total_price`, `excess_km_price`, `remind_price`, `penalty_price`, `patrol_price`, `washing_price`, `insurance_price`, `exist_date`, `exist_time`, `return_date`, `return_time`, `exist_km`, `return_km`, `due_km`, `free_km`, `total_km`, `excess_km`, `date`, `added_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 2, '1000.00', 1, NULL, '200.00', NULL, '1000.00', NULL, '800.00', NULL, NULL, NULL, NULL, '2024-08-09', '14:50:09', '2024-08-07', '09:53:00', '100.00', NULL, NULL, NULL, NULL, NULL, '2024-08-09', 1, 1, '2024-08-09 22:50:35', '2024-08-09 22:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `com_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_front_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_back_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license_release_date` date NOT NULL,
  `driver_license_address_end_date` date NOT NULL,
  `driver_license_front_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_license_back_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_number` int(11) NOT NULL DEFAULT 0,
  `total_money` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_money` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remaining_money` decimal(10,2) NOT NULL DEFAULT 0.00,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `com_name`, `identity_number`, `identity_front_image`, `identity_back_image`, `phone`, `email`, `address`, `nationality`, `driver_license_number`, `driver_license_address`, `driver_license_release_date`, `driver_license_address_end_date`, `driver_license_front_image`, `driver_license_back_image`, `details`, `contract_number`, `total_money`, `paid_money`, `remaining_money`, `com_code`, `date`, `added_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'منار عمر', 'Ng Soft', '4467454', NULL, NULL, '09965655', 'admin@admin', 'Alahadhia', 'sudness', '4545454', 'Sudan', '2024-07-27', '2024-08-23', NULL, NULL, NULL, 1, '1000.00', '200.00', '800.00', 1, '2024-08-09', 1, NULL, '2024-08-09 16:51:16', '2024-08-09 22:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_02_071239_admins', 1),
(10, '2024_08_05_210324_car_types', 3),
(11, '2024_08_05_214913_car_status', 3),
(14, '2024_08_07_080834_panel_settings', 5),
(16, '2024_08_05_084918_customers', 7),
(21, '2024_08_07_190946_carexpenses', 8),
(23, '2024_08_05_203833_cars', 10),
(26, '2024_08_08_114332_contract', 11);

-- --------------------------------------------------------

--
-- Table structure for table `panel_settings`
--

CREATE TABLE `panel_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_one` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_two` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `panel_settings`
--

INSERT INTO `panel_settings` (`id`, `system_name`, `photo`, `phone_one`, `phone_two`, `email`, `address`, `cr_number`, `intro`, `tax_number`, `added_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'manar sys', '1723028431840.jpg', '02020', '2323', 'ad@dd', 'mal', 'dll33443', 'sldf ldld', '3kl4443', 1, 1, '2024-08-12 08:52:22', '2024-08-07 19:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_expenses`
--
ALTER TABLE `car_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_status`
--
ALTER TABLE `car_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_types`
--
ALTER TABLE `car_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panel_settings`
--
ALTER TABLE `panel_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `car_expenses`
--
ALTER TABLE `car_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `car_status`
--
ALTER TABLE `car_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `car_types`
--
ALTER TABLE `car_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `panel_settings`
--
ALTER TABLE `panel_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
