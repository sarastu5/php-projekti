-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10.05.2018 klo 20:15
-- Palvelimen versio: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a1602823`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `suoritukset`
--

create database a1602823;
use a1602823;

CREATE TABLE `suoritukset` (
  `id` int(11) NOT NULL,
  `liike` varchar(30) NOT NULL,
  `painot` decimal(10,2) NOT NULL,
  `toistot` int(10) NOT NULL,
  `sarjat` int(10) NOT NULL,
  `huomiot` varchar(100) DEFAULT NULL,
  `aika` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `suoritukset`
--

INSERT INTO `suoritukset` (`id`, `liike`, `painot`, `toistot`, `sarjat`, `huomiot`, `aika`) VALUES
(2, 'kyykky', '100.00', 10, 3, 'dfada', NULL),
(5, 'askelkyykky', '75.00', 10, 3, 'hdjlfahljdfjaldfjnas.nfja as dvöakasödfjöklfoä asjiöfadoädfvdsöfjäadäawo', NULL),
(6, 'kyykky', '80.00', 10, 3, '', NULL),
(7, 'penkki', '100.00', 100, 100, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suoritukset`
--
ALTER TABLE `suoritukset`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `suoritukset`
--
ALTER TABLE `suoritukset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
