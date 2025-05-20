-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 09:41 AM
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
-- Table structure for table `db_service`
--

CREATE TABLE `db_service` (
  `service_aid` int(11) NOT NULL,
  `service_is_active` tinyint(1) NOT NULL,
  `service_title` varchar(128) NOT NULL,
  `service_description` varchar(128) NOT NULL,
  `service_created` datetime NOT NULL,
  `service_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_service`
--

INSERT INTO `db_service` (`service_aid`, `service_is_active`, `service_title`, `service_description`, `service_created`, `service_updated`) VALUES
(1, 1, 'asdd', 'asds', '2025-05-20 13:53:17', '2025-05-20 15:18:40'),
(5, 0, 'a', 'a', '2025-05-20 15:18:30', '2025-05-20 15:18:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_service`
--
ALTER TABLE `db_service`
  ADD PRIMARY KEY (`service_aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_service`
--
ALTER TABLE `db_service`
  MODIFY `service_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
