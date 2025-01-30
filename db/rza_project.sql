-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 04:14 PM
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
-- Table structure for table `roles_to_users`
--

CREATE TABLE `roles_to_users` (
  `roles_to_users_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles_to_users`
--

INSERT INTO `roles_to_users` (`roles_to_users_id`, `username`, `role_name`) VALUES
(1, 'user13', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('user', '$2y$10$Qpd/ENQsgB.hDfyClxxiMOIMKVitYuMkhDC0yDFyzJXtid2Mlhici'),
('user1', '$2y$10$yPLXojvrs9KD9WZHX6/jhuOk6BeL4SjkmXte50BiCyJH25CdYXO3C'),
('user12', '$2y$10$IAWSXFgnUHzwIUR8l.0IZuhUm3iWlUarMDUG0miL5YZWDlwG07EMm'),
('user123', '$2y$10$AVbLfvaUwmmpynudbFmC8.Ygs/QNGrjeWRNYomd6Dmilkcg691HLa'),
('user13', '$2y$10$7tzVnPhqjFhibihSHuv0puEPyT0SBqGWsBR7MQGY7be9YNTsm9veG'),
('username', '$2y$10$vQhnd7NXQWHGYKRnEGpoG.qi/4KoGzfTYloxsoUoxo7kvTkXmVSYi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_name`);

--
-- Indexes for table `roles_to_users`
--
ALTER TABLE `roles_to_users`
  ADD PRIMARY KEY (`roles_to_users_id`),
  ADD KEY `roles_to_users_role_name` (`role_name`),
  ADD KEY `roles_to_users_username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles_to_users`
--
ALTER TABLE `roles_to_users`
  MODIFY `roles_to_users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `roles_to_users`
--
ALTER TABLE `roles_to_users`
  ADD CONSTRAINT `roles_to_users_role_name` FOREIGN KEY (`role_name`) REFERENCES `roles` (`role_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_to_users_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
