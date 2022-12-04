-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2022 at 02:26 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerice_mo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_type` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `vendor_type`, `created_by`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'man clothes', NULL, 1, NULL, '7LWg2bCg0EFfROeIVL3cBbZC5FjSOi2vbHK0m5Q2.png', NULL, '2022-12-02 11:57:05', '2022-12-02 11:57:05'),
(2, 'wemone clouthes', NULL, 1, NULL, '9YZwV11EiFTzN3KRbxbBavAbny0OWSuxBktF3OiH.jpg', NULL, '2022-12-02 11:57:25', '2022-12-02 11:57:26');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2022_11_22_122326_create_verification_codes_table', 1),
(10, '2022_11_27_073015_create_tokens_table', 1),
(11, '2022_11_27_073913_add_verified_to_users_table', 1),
(12, '2022_12_02_130030_create_type_of_vendor_table', 1),
(13, '2022_12_02_130105_create_categories_table', 1),
(14, '2022_12_02_130135_create_products_table', 1),
(15, '2022_12_02_131416_create_product_transaction_table', 1),
(17, '2022_12_02_141348_add_description_to_products_table', 2),
(19, '2022_12_02_172617_add_vendor_type_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `price_after_discount` double(8,2) DEFAULT NULL,
  `flag` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `user_id`, `price`, `price_after_discount`, `flag`, `image`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test2', 'dsgkmsdkm', 1, 2, 50.00, 20.00, '2', 'ns7xZoNwJ0xSCOMxfOqzp5nK0Vd1ARizlLi7haYk.png', NULL, '2022-12-02 12:24:06', '2022-12-02 12:35:20', NULL),
(2, 'test2', 'dsgkmsdkm', 1, 2, 50.00, 20.00, '2', 'ns7xZoNwJ0xSCOMxfOqzp5nK0Vd1ARizlLi7haYk.png', NULL, '2022-12-02 12:24:06', '2022-12-02 12:35:20', NULL),
(3, 'test2', 'dsgkmsdkm', 1, 2, 50.00, 20.00, '2', 'ns7xZoNwJ0xSCOMxfOqzp5nK0Vd1ARizlLi7haYk.png', NULL, '2022-12-02 12:24:06', '2022-12-02 12:35:20', NULL),
(4, 'test2', 'dsgkmsdkm', 1, 2, 50.00, 20.00, '2', 'ns7xZoNwJ0xSCOMxfOqzp5nK0Vd1ARizlLi7haYk.png', NULL, '2022-12-02 12:24:06', '2022-12-02 12:35:20', NULL),
(5, 'test2', 'dsgkmsdkm', 1, 2, 50.00, 20.00, '2', 'ns7xZoNwJ0xSCOMxfOqzp5nK0Vd1ARizlLi7haYk.png', NULL, '2022-12-02 12:24:06', '2022-12-02 12:35:20', NULL),
(6, 'test2', 'dsgkmsdkm', 1, 2, 50.00, 20.00, '2', 'ns7xZoNwJ0xSCOMxfOqzp5nK0Vd1ARizlLi7haYk.png', NULL, '2022-12-02 12:24:06', '2022-12-02 12:35:20', NULL),
(7, 'test2', 'dsgkmsdkm', 1, 2, 50.00, 20.00, '2', 'ns7xZoNwJ0xSCOMxfOqzp5nK0Vd1ARizlLi7haYk.png', NULL, '2022-12-02 12:24:06', '2022-12-02 12:35:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_transaction`
--

CREATE TABLE `product_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` smallint(6) DEFAULT NULL,
  `price` smallint(6) DEFAULT NULL,
  `total` smallint(6) DEFAULT NULL,
  `status` enum('bought','returned') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_transaction`
--

INSERT INTO `product_transaction` (`id`, `product_id`, `user_id`, `quantity`, `price`, `total`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 5, 50, 250, 'bought', '2022-12-02 13:01:06', '2022-12-02 13:01:06', NULL),
(2, 1, NULL, 4, 50, 200, 'bought', '2022-12-02 13:01:12', '2022-12-02 13:01:12', NULL),
(3, 1, NULL, 4, 50, 200, 'bought', '2022-12-02 13:01:22', '2022-12-02 13:01:22', NULL),
(4, 1, NULL, 1, 50, 50, 'bought', '2022-12-02 13:03:08', '2022-12-02 13:03:08', NULL),
(5, 1, NULL, 4, 50, 200, 'bought', '2022-12-02 13:03:11', '2022-12-02 13:03:11', NULL),
(6, 1, NULL, 4, 50, 200, 'bought', '2022-12-02 13:03:13', '2022-12-02 13:03:13', NULL),
(7, 1, NULL, 2, 50, 100, 'bought', '2022-12-02 14:57:09', '2022-12-02 14:57:09', NULL),
(8, 1, NULL, 1, 50, 50, 'bought', '2022-12-02 14:57:59', '2022-12-02 14:57:59', NULL),
(9, 1, NULL, 3, 50, 150, 'bought', '2022-12-02 14:58:37', '2022-12-02 14:58:37', NULL),
(10, 1, NULL, 1, 50, 50, 'bought', '2022-12-02 15:03:06', '2022-12-02 15:03:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `fcm_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_vendors`
--

CREATE TABLE `type_of_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_of_vendors`
--

INSERT INTO `type_of_vendors` (`id`, `name`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'clouthes', NULL, NULL, '2022-12-02 11:52:22', '2022-12-02 11:52:22'),
(2, 'cars', NULL, NULL, '2022-12-02 11:53:38', '2022-12-02 11:53:38'),
(3, 'fearntuhe', NULL, NULL, '2022-12-02 11:54:18', '2022-12-02 11:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` smallint(6) DEFAULT NULL,
  `status` enum('active','not_active') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_type` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile_no`, `email_verified_at`, `password`, `verified`, `status`, `type`, `image`, `remember_token`, `created_at`, `updated_at`, `vendor_type`) VALUES
(1, 'Mohammed Obaid', 'mhmd.obaid.18@gmail.com', '0594034429', '2022-12-02 11:20:44', '$2y$10$FCCdR1p4wO1AogHmAKbXueYfbqPIb17DrQubx4qMmT7l3SqT8y10W', NULL, NULL, '1', NULL, 'l8fJSMK7SG', '2022-12-02 11:20:44', '2022-12-02 11:20:44', NULL),
(2, 'Ona Ankunding', 'cali09@example.com', '+1-315-656-9344', '2022-12-02 11:20:58', '$2y$10$SqFpJFXQgUjqG0F2.93jHunORqplLKEObxP6rIcEleQHRLTSjdlNe', NULL, NULL, '2', NULL, 'MkqnngpDPT', '2022-12-02 11:20:58', '2022-12-02 11:20:58', 1),
(3, 'Trent White', 'hartmann.myrl@example.net', '1-907-456-5308 x1469', '2022-12-02 11:20:58', '$2y$10$OmHyWlNU/fOmlhntnM97kuBjk0iEv4MJWzHLqBukUgco1XykT5d7m', NULL, NULL, '2', NULL, 'xt1Vmv68O4', '2022-12-02 11:20:58', '2022-12-02 11:20:58', 2),
(4, 'Chauncey Okuneva', 'ally20@example.net', '609.748.2286 x420', '2022-12-02 11:20:58', '$2y$10$0VemosHKNgDlmRiaQM3ttueLh7IeLhEYbnagTQyhSOvCerlVY1cEy', NULL, NULL, '2', NULL, 'it2wjrDgRA', '2022-12-02 11:20:58', '2022-12-02 11:20:58', 1),
(5, 'Heidi Jerde', 'maya.stiedemann@example.net', '+18746522459', '2022-12-02 11:20:58', '$2y$10$vqz0A5IeFKBMNI7xf3UoFeNN9bjrOvcxeqE1RJ/Ym1NEu1Z0pgDca', NULL, NULL, '2', NULL, 'zakep3g09G', '2022-12-02 11:20:58', '2022-12-02 11:20:58', 3),
(6, 'Dr. Ernestine Lemke III', 'magali47@example.org', '789-558-7986', '2022-12-02 11:20:58', '$2y$10$GRicas6mnm18NyQs4nM5xeL3sqt9WD9NzJzYz3e.wSpXhEFLCleI.', NULL, NULL, '1', NULL, 'eakbASOIC4', '2022-12-02 11:20:58', '2022-12-02 11:20:58', NULL),
(7, 'Prof. Tanya Leannon', 'hartmann.annette@example.com', '606.739.0629 x151', '2022-12-02 11:20:58', '$2y$10$BQA2NIfPI7kwAslNyN/CwO0GI1vovvt8exP3jD3N9LLxlNA3RiC8O', NULL, NULL, '1', NULL, 'aZSOS27vWp', '2022-12-02 11:20:58', '2022-12-02 11:20:58', NULL),
(8, 'Dr. Michelle Doyle Sr.', 'ramiro89@example.com', '(232) 700-5905', '2022-12-02 11:20:58', '$2y$10$.5e.2cWLJGRyeHVnBKTgyuSYDClu6eFJB10s72WJgVxHZA2T3TCwa', NULL, NULL, '2', NULL, 'fWNK0TOcCL', '2022-12-02 11:20:58', '2022-12-02 11:20:58', 1),
(9, 'Tyrell Walter V', 'sarina77@example.net', '734.831.8026 x172', '2022-12-02 11:20:58', '$2y$10$mgx0z29lIwZNcU10LtMGHOwxTDVD51kZK5DGyl/0AWQYx8eXTk7AC', NULL, NULL, '2', NULL, 'qn4Jd0SHHD', '2022-12-02 11:20:58', '2022-12-02 11:20:58', 1),
(10, 'Mrs. Syble Ward', 'bbogisich@example.com', '1-660-446-8987', '2022-12-02 11:20:58', '$2y$10$tSuKolNc1PW9AfjjELeB3.dzWt/AvZEmRWCoM.1OcwbyklnUjr0xG', NULL, NULL, '1', NULL, 'xvvHzbZjYm', '2022-12-02 11:20:58', '2022-12-02 11:20:58', NULL),
(11, 'Janae Kiehn', 'ocartwright@example.com', '+1 (369) 658-3669', '2022-12-02 11:20:58', '$2y$10$OLhHdHTslw721USo07.ljue/jmEORNQ1VnXOckUk2Nw4YKIzDKqJ6', NULL, NULL, '1', NULL, 'eANrZSnfaR', '2022-12-02 11:20:58', '2022-12-02 11:20:58', NULL),
(12, 'Nick', 'Nick@gmail.com', '0594034423', NULL, '$2y$10$l6vV54YA0shdKFGzjB47aejN4sYFPGtlD6Jt8HyG2IS38fZlYW/SO', NULL, NULL, '1', '9NJXhAqyEPjE0u3NHvoYqvHN4HtqNBzRLEgaIEL0.png', NULL, '2022-12-02 16:37:03', '2022-12-02 16:37:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_vendor_type_foreign` (`vendor_type`);

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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_created_by_foreign` (`created_by`);

--
-- Indexes for table `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_transaction_product_id_foreign` (`product_id`),
  ADD KEY `product_transaction_user_id_foreign` (`user_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tokens_created_by_foreign` (`created_by`);

--
-- Indexes for table `type_of_vendors`
--
ALTER TABLE `type_of_vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_of_vendors_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_no_unique` (`mobile_no`),
  ADD KEY `users_vendor_type_foreign` (`vendor_type`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_transaction`
--
ALTER TABLE `product_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_of_vendors`
--
ALTER TABLE `type_of_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `categories_vendor_type_foreign` FOREIGN KEY (`vendor_type`) REFERENCES `type_of_vendors` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD CONSTRAINT `product_transaction_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_transaction_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `type_of_vendors`
--
ALTER TABLE `type_of_vendors`
  ADD CONSTRAINT `type_of_vendors_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_vendor_type_foreign` FOREIGN KEY (`vendor_type`) REFERENCES `type_of_vendors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
