-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2018 at 01:32 PM
-- Server version: 10.2.19-MariaDB-10.2.19+maria~stretch
-- PHP Version: 7.2.12-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yogo`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `costumer_id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('signature','attachment') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `costumers`
--

CREATE TABLE `costumers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` enum('AGM Chargable Job','OKI Warranty') COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `printer_model` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `printer_serial` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_count_mono` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_count_color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('FINISHED','PARTS','QUOTE','CANCEL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_costumer_id_foreign` (`costumer_id`);

--
-- Indexes for table `costumers`
--
ALTER TABLE `costumers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `costumers`
--
ALTER TABLE `costumers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_costumer_id_foreign` FOREIGN KEY (`costumer_id`) REFERENCES `costumers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
