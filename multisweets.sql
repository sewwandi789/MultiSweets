-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 02:10 PM
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
-- Database: `multisweets`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`, `status`) VALUES
(1, 'sewwandi', 'msewwandi789@gmail.com', 'this is test mail', '2024-12-31 06:09:23', 'read'),
(3, 'test user', 'testing@gmail.com', 'test this mail for long', '2024-12-31 07:56:50', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `food_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `AddBy` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `category`, `name`, `price`, `food_description`, `image`, `AddBy`, `created_at`) VALUES
(14, 'Our Special', 'test', 45.00, 'tdj ', 'food_images/download.jpeg', 'Admin', '2024-12-30 17:25:21'),
(16, 'Offers', 'food item 1', 420.00, 'test description', 'food_images/beaker.jpg', 'Admin', '2024-12-30 17:28:42'),
(17, 'Our Special', 'test', 14545.00, 'testbdjdhekdef', 'food_images/steieves set.PNG', 'Admin', '2024-12-30 17:28:59'),
(18, 'Our Special', 'this is test ', 700.00, 'oil cake are best', 'food_images/images.jpeg', 'Admin', '2024-12-31 05:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `created_at`) VALUES
(1, 'testing 123', 'testing@gmail.com', 'Admin', '$2y$10$88qrfIvwdirYKQB8MVuMtegVlz9Rcu9NVO.idC0rJ6wjgFT9O0HyO', '2024-12-28 13:15:08'),
(3, 'test ', 'msewwandi789@gmail.com', 'User', '$2y$10$/IHMio6S0FUsPUKibA.ahOgwk0kgqqpqfhz4Y.MmGj/sTYkIV8sg6', '2024-12-28 13:18:19'),
(5, 'Full name', 'teting@gmail.com', '', '$2y$10$FlQUokpOXKlCCsmo442RVeHFb72ZJMZ0lxhkCzw2Gmuh9w7xBiOty', '2024-12-28 16:09:57'),
(6, 'user', 'ing@gmail.com', '', '$2y$10$uri6CvM1/vGlrHNYkzhRPuWOpLsCvsqOPKq3ilbKM.ZeDAt46A6dS', '2024-12-31 05:41:40'),
(7, 'user tesr yt', 'admin@gmail.com', '', '$2y$10$YvEROPiKMrAMWiVC2V1oyO8XUUH64PLquMIoGkwN4874vWfw/by5m', '2024-12-31 05:43:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
