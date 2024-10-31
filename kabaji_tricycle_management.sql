-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql304.infinityfree.com
-- Generation Time: Oct 31, 2024 at 11:22 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37543846_tricycle_riders`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin1', 'admin1@gmail.com', '$2y$10$YrZtMXfPUBPW/BCP9ZVm2u.QGCUA8BUIVjD1lTAWJy.qsrUG0uC1m'),
(2, 'kabir', 'kabirajibadecode@gmail.com', '$2y$10$jCnU8uPyk8XKm.P.acvePuVnwRzu840X4DLpcG1/ZagVGAdD8q37a');

-- --------------------------------------------------------

--
-- Table structure for table `tricycle_riders`
--

CREATE TABLE `tricycle_riders` (
  `chassis_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `plate_number` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `payment_status` enum('paid','not_paid') DEFAULT 'not_paid',
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tricycle_riders`
--

INSERT INTO `tricycle_riders` (`chassis_number`, `name`, `phone_number`, `plate_number`, `picture`, `payment_status`, `email`) VALUES
('111YU778U', 'Keke Manu', '0902333445', 'BS989TMW', 'uploads/FB_IMG_15480144736144887.jpg', 'not_paid', 'keke@gmail.com'),
('2223444GGJ', 'Kaka kaku', '09012345678', 'AE674NGU', 'uploads/IMG-20170529-WA0003.jpg', 'paid', 'kabiraji@gmail.com'),
('444555GT87', 'Mala Bunu', '0987776666', 'SA5456PLU', 'uploads/IMG_20150817_122948.jpg', 'not_paid', ''),
('999ALGT009', 'Aliyu Musa B', '07065448760', 'GS678DTR', 'uploads/1014669363_36184537.jpg', 'not_paid', 'aliyub@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tricycle_riders`
--
ALTER TABLE `tricycle_riders`
  ADD PRIMARY KEY (`chassis_number`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `plate_number` (`plate_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
