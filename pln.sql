-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Agu 2019 pada 15.43
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

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
-- Struktur dari tabel `pemutusan`
--

CREATE TABLE `pemutusan` (
  `id_pel` int(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tarif` varchar(5) NOT NULL,
  `daya` int(4) NOT NULL,
  `no_upr` varchar(50) NOT NULL,
  `kode_prr` varchar(50) NOT NULL,
  `kode_tiang` varchar(50) NOT NULL,
  `kode_gardu` varchar(50) NOT NULL,
  `kode_rbm` varchar(50) NOT NULL,
  `lembar` varchar(50) NOT NULL,
  `bln_awal` varchar(50) NOT NULL,
  `bln_akhir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemutusan`
--

INSERT INTO `pemutusan` (`id_pel`, `nama`, `alamat`, `tarif`, `daya`, `no_upr`, `kode_prr`, `kode_tiang`, `kode_gardu`, `kode_rbm`, `lembar`, `bln_awal`, `bln_akhir`) VALUES
(1, 'sa', 'plg', 'r1mt', 1300, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_peg` int(12) NOT NULL,
  `nama_peg` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_peg`, `nama_peg`, `username`, `password`) VALUES
(0, '', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemutusan`
--
ALTER TABLE `pemutusan`
  ADD PRIMARY KEY (`id_pel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
