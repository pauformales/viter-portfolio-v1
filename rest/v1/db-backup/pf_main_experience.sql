-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 06:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viter-portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `pf_main_experience`
--

CREATE TABLE `pf_main_experience` (
  `mainexperience_aid` int(11) NOT NULL,
  `mainexperience_is_active` tinyint(1) NOT NULL,
  `mainexperience_title` varchar(128) NOT NULL,
  `mainexperience_category` varchar(50) NOT NULL,
  `mainexperience_description` text NOT NULL,
  `mainexperience_created` datetime NOT NULL,
  `mainexperience_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pf_main_experience`
--

INSERT INTO `pf_main_experience` (`mainexperience_aid`, `mainexperience_is_active`, `mainexperience_title`, `mainexperience_category`, `mainexperience_description`, `mainexperience_created`, `mainexperience_updated`) VALUES
(1, 1, 'sdsd', '3', 'sdsds', '2025-05-23 09:35:07', '2025-05-23 09:35:07'),
(2, 0, 'sds', '3', 'sds', '2025-05-23 10:17:00', '2025-05-26 09:39:53'),
(3, 1, 'sdss', '3', 'sd', '2025-05-23 13:00:15', '2025-05-23 13:00:15'),
(4, 1, 'sd', '3', 'sd', '2025-05-23 13:47:37', '2025-05-23 13:47:37'),
(5, 0, 'sdsdsdasdasd', '3', 'asdasdad', '2025-05-23 14:11:22', '2025-05-26 09:39:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pf_main_experience`
--
ALTER TABLE `pf_main_experience`
  ADD PRIMARY KEY (`mainexperience_aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pf_main_experience`
--
ALTER TABLE `pf_main_experience`
  MODIFY `mainexperience_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
