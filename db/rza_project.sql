-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 11:14 AM
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
-- Database: `rza_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bookings`
--

CREATE TABLE `hotel_bookings` (
  `hotel_booking_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `username` varchar(100) NOT NULL,
  `files` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`username`, `files`) VALUES
('admin', 'elephant-1421167_640 (1) (1) (1).jpg'),
('admin', 'rice1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_name`) VALUES
('admin'),
('customer');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `theme_id` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `theme_name` varchar(20) NOT NULL,
  `body_color` varchar(7) NOT NULL DEFAULT '#212529',
  `body_bg` varchar(7) NOT NULL DEFAULT '#fff',
  `secondary` varchar(7) NOT NULL DEFAULT '#6c757d',
  `secondary_color` varchar(9) NOT NULL DEFAULT '#212529bf',
  `secondary_bg` varchar(7) NOT NULL DEFAULT '#e9ecef',
  `secondary_bg_subtle` varchar(7) NOT NULL DEFAULT '#e2e3e5',
  `tertiary_color` varchar(9) NOT NULL DEFAULT '#21252980',
  `tertiary_bg` varchar(7) NOT NULL DEFAULT '#f8f9fa',
  `emphasis_color` varchar(7) NOT NULL DEFAULT '#000',
  `border_color` varchar(7) NOT NULL DEFAULT '#dee2e6',
  `primary_color` varchar(7) NOT NULL DEFAULT '#0d6efd',
  `primary_bg_subtle` varchar(7) NOT NULL DEFAULT '#cfe2ff',
  `primary_border_subtle` varchar(7) NOT NULL DEFAULT '#9ec5fe',
  `primary_text_emphasis` varchar(7) NOT NULL DEFAULT '#052c65',
  `success` varchar(7) NOT NULL DEFAULT '#198754',
  `success_bg_subtle` varchar(7) NOT NULL DEFAULT '#d1e7dd',
  `success_border_subtle` varchar(7) NOT NULL DEFAULT '#a3cfbb',
  `success_text_emphasis` varchar(7) NOT NULL DEFAULT '#0a3622',
  `danger` varchar(7) NOT NULL DEFAULT '#dc3545',
  `danger_bg_subtle` varchar(7) NOT NULL DEFAULT '#f8d7da',
  `danger_border_subtle` varchar(7) NOT NULL DEFAULT '#f1aeb5',
  `danger_text_emphasis` varchar(7) NOT NULL DEFAULT '#58151c',
  `warning` varchar(7) NOT NULL DEFAULT '#ffc107',
  `warning_bg_subtle` varchar(7) NOT NULL DEFAULT '#fff3cd',
  `warning_border_subtle` varchar(7) NOT NULL DEFAULT '#ffe69c',
  `warning_text_emphasis` varchar(7) NOT NULL DEFAULT '#664d03',
  `info` varchar(7) NOT NULL DEFAULT '#0dcaf0',
  `info_bg_subtle` varchar(7) NOT NULL DEFAULT '#cff4fc',
  `info_border_subtle` varchar(7) NOT NULL DEFAULT '#9eeaf9',
  `info_text_emphasis` varchar(7) NOT NULL DEFAULT '#055160',
  `light` varchar(7) NOT NULL DEFAULT '#f8f9fa',
  `light_bg_subtle` varchar(7) NOT NULL DEFAULT '#fcfcfd',
  `light_border_subtle` varchar(7) NOT NULL DEFAULT '#e9ecef',
  `light_text_emphasis` varchar(7) NOT NULL DEFAULT '#495057',
  `dark` varchar(7) NOT NULL DEFAULT '#212529',
  `dark_bg_subtle` varchar(7) NOT NULL DEFAULT '#ced4da',
  `dark_border_subtle` varchar(7) NOT NULL DEFAULT '#adb5bd',
  `dark_text_emphasis` varchar(7) NOT NULL DEFAULT '#495057',
  `form_valid_color` varchar(7) NOT NULL DEFAULT '#198754',
  `form_valid_border_color` varchar(7) NOT NULL DEFAULT '#198754',
  `form_invalid_color` varchar(7) NOT NULL DEFAULT '#dc3545',
  `form_invalid_border_color` varchar(7) NOT NULL DEFAULT '#dc3545',
  `rza_green` varchar(7) NOT NULL DEFAULT '#4B6F44',
  `rza_brown` varchar(7) NOT NULL DEFAULT '#645452',
  `rza_outline_gray` varchar(7) NOT NULL DEFAULT '#D3D3D3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`theme_id`, `username`, `theme_name`, `body_color`, `body_bg`, `secondary`, `secondary_color`, `secondary_bg`, `secondary_bg_subtle`, `tertiary_color`, `tertiary_bg`, `emphasis_color`, `border_color`, `primary_color`, `primary_bg_subtle`, `primary_border_subtle`, `primary_text_emphasis`, `success`, `success_bg_subtle`, `success_border_subtle`, `success_text_emphasis`, `danger`, `danger_bg_subtle`, `danger_border_subtle`, `danger_text_emphasis`, `warning`, `warning_bg_subtle`, `warning_border_subtle`, `warning_text_emphasis`, `info`, `info_bg_subtle`, `info_border_subtle`, `info_text_emphasis`, `light`, `light_bg_subtle`, `light_border_subtle`, `light_text_emphasis`, `dark`, `dark_bg_subtle`, `dark_border_subtle`, `dark_text_emphasis`, `form_valid_color`, `form_valid_border_color`, `form_invalid_color`, `form_invalid_border_color`, `rza_green`, `rza_brown`, `rza_outline_gray`) VALUES
(1, 'jayden', 'test_theme', '#212529', '#fff', '#6c757d', '#212529bf', '#e9ecef', '#e2e3e5', '#21252980', '#f8f9fa', '#000', '#dee2e6', '#0d6efd', '#cfe2ff', '#9ec5fe', '#052c65', '#198754', '#d1e7dd', '#a3cfbb', '#0a3622', '#dc3545', '#f8d7da', '#f1aeb5', '#58151c', '#ffc107', '#fff3cd', '#ffe69c', '#664d03', '#0dcaf0', '#cff4fc', '#9eeaf9', '#055160', '#f8f9fa', '#fcfcfd', '#e9ecef', '#495057', '#212529', '#ced4da', '#adb5bd', '#495057', '#198754', '#198754', '#dc3545', '#dc3545', '#4B6F44', '#645452', '#D3D3D3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role_name`) VALUES
('admin', '$2y$10$2QZPdmdIdxV1QSqEMaK3me4iEsG5c3Iwc6fVPYBo/SyN.GSON7DNy', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visit_id` int(100) NOT NULL,
  `zoo_booking_id` int(100) NOT NULL,
  `hotel_booking_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zoo_bookings`
--

CREATE TABLE `zoo_bookings` (
  `zoo_booking_id` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `number_of_people` int(100) NOT NULL DEFAULT 1,
  `educational_visit` tinyint(1) NOT NULL,
  `booking_key` varchar(64) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zoo_bookings_daily`
--

CREATE TABLE `zoo_bookings_daily` (
  `zoo_booking_daily_id` int(100) NOT NULL,
  `zoo_booking_id` int(100) NOT NULL,
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  ADD PRIMARY KEY (`hotel_booking_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`files`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_name`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`theme_id`),
  ADD KEY `user_theme` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `role` (`role_name`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `visits_hotel_booking_id` (`hotel_booking_id`),
  ADD KEY `visits_zoo_booking_id` (`zoo_booking_id`);

--
-- Indexes for table `zoo_bookings`
--
ALTER TABLE `zoo_bookings`
  ADD PRIMARY KEY (`zoo_booking_id`),
  ADD UNIQUE KEY `booking_key` (`booking_key`),
  ADD KEY `zoo_booking_username` (`username`);

--
-- Indexes for table `zoo_bookings_daily`
--
ALTER TABLE `zoo_bookings_daily`
  ADD PRIMARY KEY (`zoo_booking_daily_id`),
  ADD KEY `daily_zoo_booking_to_zoo_booking` (`zoo_booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  MODIFY `hotel_booking_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `theme_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoo_bookings`
--
ALTER TABLE `zoo_bookings`
  MODIFY `zoo_booking_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `zoo_bookings_daily`
--
ALTER TABLE `zoo_bookings_daily`
  MODIFY `zoo_booking_daily_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=628;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `themes`
--
ALTER TABLE `themes`
  ADD CONSTRAINT `user_theme` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role` FOREIGN KEY (`role_name`) REFERENCES `roles` (`role_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_hotel_booking_id` FOREIGN KEY (`hotel_booking_id`) REFERENCES `hotel_bookings` (`hotel_booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visits_zoo_booking_id` FOREIGN KEY (`zoo_booking_id`) REFERENCES `zoo_bookings` (`zoo_booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zoo_bookings`
--
ALTER TABLE `zoo_bookings`
  ADD CONSTRAINT `zoo_booking_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zoo_bookings_daily`
--
ALTER TABLE `zoo_bookings_daily`
  ADD CONSTRAINT `daily_zoo_booking_to_zoo_booking` FOREIGN KEY (`zoo_booking_id`) REFERENCES `zoo_bookings` (`zoo_booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
