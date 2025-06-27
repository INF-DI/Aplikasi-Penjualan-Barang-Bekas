-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 06:56 PM
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
-- Database: `db_barang_bekas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jenis_barang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `jenis_barang`, `harga`, `deskripsi`, `gambar`) VALUES
(3, 'Acer Aspire 5 Slim', 'Elektronik', 7500000, 'Barang masih dalam kondisi baik, pemakaian sudah 2 tahun.', '1751033917_0429501e6b3fd90da7a1.jpeg'),
(4, 'Acer Nitro 17', 'Elektronik', 5000000, 'Kondisi laptop masih bagus, pemakaian 2 tahun.', '1751034334_beb1d77f786ecc922b00.jpeg'),
(5, 'Setrika Philips', 'Elektronik', 90000, 'Berfungsi dengan baik dan cepat panas.', '1751034789_43182eb9754273dfdc2d.jpeg'),
(6, 'Poco m3', 'Elektronik', 1250000, 'Barang masih berfungsi dengan baik.', '1751038141_d536fb11c390ac7c585e.jpeg'),
(7, 'Xiaomi Redmi Note 10', 'Elektronik', 2150000, 'Barang masih bagus dan berfungsi dengan baik.', '1751041473_aad6872414ff1942c624.jpeg'),
(8, 'Kaca spion PCX ', 'Sparepart', 80000, 'Barang masih mulus no lecet-lecet.', '1751041992_d0bc3e3448c979ef1ae5.jpeg'),
(9, 'Kompor gas COSMOS', 'Peralatan Dapur', 125000, 'Barang masih berfungsi dengan baik.', '1751042744_3bc354c79d696e203e6c.jpeg'),
(10, 'Gas LPG 3kg', 'Peralatan Dapur', 150000, 'Barang masih bagus dan aman.', '1751042968_d64d9248dba566adcddd.jpeg'),
(11, 'Kipas Angin Rowenta', 'Elektronik', 100, 'Masih berfungsi dengan baik.', '1751043145_6fc1d0fa216fcedd7aea.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$xWbwMLb3jFTN6/gpemSrf.UyvXYoBQu5RlSy5.fDZnbOYb1redgTa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
