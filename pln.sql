-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2019 at 08:00 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pln`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `email`, `tgl_log`) VALUES
(19, 'jenrinaldo@student.ub.ac.id', '2019-09-03 07:13:34'),
(20, 'jenrinaldo@student.ub.ac.id', '2019-09-03 07:46:57'),
(21, 'jenrinaldo@student.ub.ac.id', '2019-09-03 07:55:10'),
(22, 'jenrinaldo@student.ub.ac.id', '2019-09-11 14:23:51'),
(23, 'jenrinaldo@student.ub.ac.id', '2019-09-11 14:23:56'),
(24, 'jenrinaldo@student.ub.ac.id', '2019-09-11 14:24:02'),
(25, 'jenrinaldo@student.ub.ac.id', '2019-09-11 14:24:06'),
(26, 'jenrinaldo@student.ub.ac.id', '2019-09-12 00:00:30'),
(27, 'jenrinaldo@student.ub.ac.id', '2019-09-17 19:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `pemutusan`
--

CREATE TABLE `pemutusan` (
  `id_pel` varchar(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tarif` varchar(5) NOT NULL,
  `daya` int(4) NOT NULL,
  `sketsa` varchar(200) NOT NULL,
  `persil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemutusan`
--

INSERT INTO `pemutusan` (`id_pel`, `nama`, `alamat`, `tarif`, `daya`, `sketsa`, `persil`) VALUES
('061830800634', 'Jenrinaldo Tampubolon', 'Malang', 'R1', 6600, 'photo/sketsa_061830800634.jpg', 'photo/persil_061830800634.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tgl_daftar` timestamp NULL DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `tgl_daftar`, `status`) VALUES
(5, 'jen', 'jenrinaldo@student.ub.ac.id', 'b18ea44550b68d0d012bd9017c4a864a', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
