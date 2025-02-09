-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 09:16 PM
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
('admin', '$2y$10$d06denpaf61lTJgsZI5WgehMeEdK2DEmkw1BRzX/vfUB92VIol0iO', 'admin'),
('jayden', '$2y$10$GknbdnCXX9eNeawOTCW5ruuXetGkqocWJ6lQVTvFDDq6RGje.meSS', 'customer'),
('user', '$2y$10$ylGnyNhkCFT8iLD6tFWTXuEOsy91QJzi49ujEv5Oa2sO98GdRjK0.', 'customer'),
('user123', '$2y$10$4AP2m34XbSXJjknnGTvFj.VG1rqGBSEkcxnbUA7ddd95qLlVf7IW.', 'customer');

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_name`);

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
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoo_bookings`
--
ALTER TABLE `zoo_bookings`
  MODIFY `zoo_booking_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `zoo_bookings_daily`
--
ALTER TABLE `zoo_bookings_daily`
  MODIFY `zoo_booking_daily_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;

--
-- Constraints for dumped tables
--

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
