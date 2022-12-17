-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2022 at 02:57 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_reservasi_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `img`, `name`, `address`, `country`, `phone_number`, `email`, `username`, `password`, `deleted_at`, `created_at`, `updated_at`) VALUES
('101d58a6-9760-4c3e-9b21-7b828fb74f77', '1670852668.jpg', 'customer1234', 'address 1', 'country 1', '08756467123', 'customer1234@gmail.com', 'customer1234', '$2y$10$ymxnkb6q5uSKsYd7qMZG2OVCLvowyIOoFlFp1sSMlOWDoR2uOx41y', NULL, '2022-12-12 12:44:28', '2022-12-12 13:07:18'),
('6ba95a44-b031-4b0e-bba5-37b8cbdeda2c', '1670852119.jpg', 'customer1', 'address 1', 'country 1', '08756467', 'customer1@gmail.com', 'customer1', '$2y$10$b2GXYhjUdctpFDncqKull.qsUDSUJuSgZbYum/tJ8gX2v27Juy9Ki', '2022-12-12 12:45:14', '2022-12-12 12:35:19', '2022-12-12 12:45:14'),
('6de11e5d-d5cf-4c2e-9609-443a6e272ecb', '1670852677.jpg', 'customer123', 'address 1', 'country 1', '0875646723', 'customer123@gmail.com', 'customer123', '$2y$10$xLlxVWEeS6tW2Ib46BVMr.3511ZI0gIhPE4Pi4eHlcOu9cATS4F7u', NULL, '2022-12-12 12:44:37', '2022-12-12 12:44:37');

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
(1, '2022_10_08_134635_create_customers_table', 1),
(2, '2022_10_08_214937_create_rooms_table', 1),
(3, '2022_10_09_095751_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `img`, `name`, `description`, `price`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
('17700d06-3e9f-4f40-b810-d3be9e48566d', '1670854337.jpg', 'room3', 'description 1', 150000, 'active', '2022-12-12 13:14:18', '2022-12-12 13:12:17', '2022-12-12 13:14:18'),
('5d730992-3cd8-4dae-9db6-c65b7a19dd35', '1670854326.jpg', 'room1', 'description 1', 150000, 'active', NULL, '2022-12-12 13:12:06', '2022-12-12 13:12:06'),
('65b758a6-85c9-41be-8677-3bb2f8503472', '1670854334.jpg', 'room2', 'description 1', 150000, 'active', NULL, '2022-12-12 13:12:14', '2022-12-12 13:12:14'),
('ca2c4ecd-2f40-46c3-ab0a-48f3487e042f', '1670854340.jpg', 'room updated', 'description 1', 200000, 'active', NULL, '2022-12-12 13:12:20', '2022-12-12 13:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `img`, `code`, `room_id`, `total_price`, `check_in`, `check_out`, `customer_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
('5c9f9eb0-570b-468a-8cad-897346bd56f2', '1670943277.jpg', '5C950', '65b758a6-85c9-41be-8677-3bb2f8503472', 300000, '2022-12-04', '2022-12-06', '6de11e5d-d5cf-4c2e-9609-443a6e272ecb', 'in_progress', NULL, '2022-12-12 13:52:56', '2022-12-13 13:54:37'),
('d909e724-c96c-4e08-9d38-14375d9f3caa', NULL, 'D9040', '65b758a6-85c9-41be-8677-3bb2f8503472', 450000, '2022-11-30', '2022-12-03', '6de11e5d-d5cf-4c2e-9609-443a6e272ecb', 'pending', NULL, '2022-12-12 13:52:36', '2022-12-12 13:52:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_name_unique` (`name`),
  ADD UNIQUE KEY `customers_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_username_unique` (`username`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
