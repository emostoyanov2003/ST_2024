-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 12:30 PM
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
-- Database: `st_tu`
--

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(8) NOT NULL,
  `e-mail` varchar(128) NOT NULL,
  `password` varchar(512) NOT NULL,
  `type` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `family` varchar(64) NOT NULL,
  `image` varchar(128) NOT NULL,
  `job` varchar(32) NOT NULL,
  `acception_time` varchar(128) NOT NULL,
  `subject` varchar(128) NOT NULL,
  `education` varchar(1024) NOT NULL,
  `from_year` varchar(4) NOT NULL,
  `phone_1` varchar(16) NOT NULL,
  `phone_2` varchar(16) NOT NULL,
  `e-mail_1` varchar(128) NOT NULL,
  `e-mail_2` varchar(128) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `e-mail`, `password`, `type`, `name`, `surname`, `family`, `image`, `job`, `acception_time`, `subject`, `education`, `from_year`, `phone_1`, `phone_2`, `e-mail_1`, `e-mail_2`, `added_date`) VALUES
(42, 'emosoto3000@gmail.com', '1d72310edc006dadf2190caad5802983', 'admin', 'Емил', 'Божидаров', 'Стоянов', '1666604630_1.jpg', 'Учител', '', 'професионална подготовка', '', '2022', '', '', '', '', '2022-10-24 09:43:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
