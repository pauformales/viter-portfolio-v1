-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 06:42 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viter-portfolio_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_main_testimonials`
--

CREATE TABLE `db_main_testimonials` (
  `maintestimonials_aid` int(11) NOT NULL,
  `maintestimonials_description` varchar(128) NOT NULL,
  `maintestimonials_title` varchar(128) NOT NULL,
  `maintestimonials_created` datetime NOT NULL,
  `maintestimonials_is_active` tinyint(1) NOT NULL,
  `maintestimonials_updated` datetime NOT NULL,
  `maintestimonials_last_name` varchar(128) NOT NULL,
  `maintestimonials_first_name` varchar(128) NOT NULL,
  `maintestimonials_email` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_main_testimonials`
--

INSERT INTO `db_main_testimonials` (`maintestimonials_aid`, `maintestimonials_description`, `maintestimonials_title`, `maintestimonials_created`, `maintestimonials_is_active`, `maintestimonials_updated`, `maintestimonials_last_name`, `maintestimonials_first_name`, `maintestimonials_email`) VALUES
(1, 'dsds', 'dsds', '2025-05-23 15:01:30', 1, '2025-05-23 15:01:35', '', '', ''),
(2, 'dsd', 'sds', '2025-05-26 07:49:20', 1, '2025-05-26 07:49:20', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_main_testimonials`
--
ALTER TABLE `db_main_testimonials`
  ADD PRIMARY KEY (`maintestimonials_aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_main_testimonials`
--
ALTER TABLE `db_main_testimonials`
  MODIFY `maintestimonials_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
