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
('1', '$2y$10$dQgKMLCOUKMX161/jxK/NeXn64cjnwBHfzGY/WiUVrU1ETsggtRia', 'customer'),
('2', '$2y$10$ELTKmNfmpo5I2hV6Jz6Nf.kzi1TkPZEMnfseRmCJYGimdRV.cqH82', 'customer'),
('3', '$2y$10$QQq3Nw1gYGkQmZ8r5tTlLupnN7scm/5W5Og4CI7FWQiqtmvtUqdIC', 'customer'),
('admin', '$2y$10$2QZPdmdIdxV1QSqEMaK3me4iEsG5c3Iwc6fVPYBo/SyN.GSON7DNy', 'admin'),
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

--
-- Dumping data for table `zoo_bookings`
--

INSERT INTO `zoo_bookings` (`zoo_booking_id`, `username`, `start_datetime`, `end_datetime`, `number_of_people`, `educational_visit`, `booking_key`, `active`) VALUES
(63, 'jayden', '2025-02-12 09:19:00', '2025-02-18 09:19:00', 10, 0, '153665096', 0),
(64, '1', '2025-02-12 09:21:00', '2025-02-18 09:21:00', 9, 0, '991137745', 0),
(65, '2', '2025-02-11 09:27:00', '2025-02-11 09:32:00', 6, 0, '803555501', 1);

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
-- Dumping data for table `zoo_bookings_daily`
--

INSERT INTO `zoo_bookings_daily` (`zoo_booking_daily_id`, `zoo_booking_id`, `day`) VALUES
(553, 63, '2025-02-12'),
(554, 63, '2025-02-13'),
(555, 63, '2025-02-14'),
(556, 63, '2025-02-15'),
(557, 63, '2025-02-16'),
(558, 63, '2025-02-17'),
(559, 63, '2025-02-18'),
(560, 64, '2025-02-12'),
(561, 64, '2025-02-13'),
(562, 64, '2025-02-14'),
(563, 64, '2025-02-15'),
(564, 64, '2025-02-16'),
(565, 64, '2025-02-17'),
(566, 64, '2025-02-18'),
(567, 65, '2025-02-11'),
(568, 65, '2025-02-12');

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
  MODIFY `zoo_booking_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `zoo_bookings_daily`
--
ALTER TABLE `zoo_bookings_daily`
  MODIFY `zoo_booking_daily_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=569;

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
