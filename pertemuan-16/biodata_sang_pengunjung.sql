-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2026 at 04:40 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pwd2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata_sang_pengunjung`
--

CREATE TABLE `biodata_sang_pengunjung` (
  `cid` int(11) NOT NULL,
  `kode_pengunjung` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pengunjung` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_rumah` text COLLATE utf8mb4_unicode_ci,
  `tanggal_kunjungan` date DEFAULT NULL,
  `hobi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_slta` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_orang_tua` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pacar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_mantan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biodata_sang_pengunjung`
--

INSERT INTO `biodata_sang_pengunjung` (`cid`, `kode_pengunjung`, `nama_pengunjung`, `alamat_rumah`, `tanggal_kunjungan`, `hobi`, `asal_slta`, `pekerjaan`, `nama_orang_tua`, `nama_pacar`, `nama_mantan`, `created_at`) VALUES
(2, '13131111', 'ridhoooo', 'deket stm ditulah', '2026-01-08', 'main lah', 'mana yaaa', 'adalah pkonya', 'yayayaya', 'tatatatta', 'jajajajjaja', '2026-01-22 04:25:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata_sang_pengunjung`
--
ALTER TABLE `biodata_sang_pengunjung`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata_sang_pengunjung`
--
ALTER TABLE `biodata_sang_pengunjung`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
