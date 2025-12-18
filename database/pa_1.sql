-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 11:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pa_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `konten` varchar(1000) NOT NULL,
  `status` enum('terima','tolak') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemberitahuan`
--

INSERT INTO `pemberitahuan` (`id`, `username`, `konten`, `status`, `timestamp`) VALUES
(15, 'ros', 'Permintaan Peminjaman Barang Anda Telah di Terima. 1 buah Keyboard. Username: rossgn. Silahkan ke bagian Staff untuk mengambil barang', 'terima', '2023-05-11 13:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `gambar_barang` varchar(100) NOT NULL,
  `stok_barang` int(10) NOT NULL,
  `kondisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `nama_barang`, `gambar_barang`, `stok_barang`, `kondisi`) VALUES
(1, 'Keyboard', 'keyboard.jpg', 10, 'Baik'),
(2, 'Arduino', 'arduino.jpg', 9, 'Baik'),
(3, ' LoRa / GPS HAT 433 MHZ', 'LoRa.jpg', 40, 'Baik'),
(5, 'Arduino Mega 2560 R3', 'mega.jpg', 50, 'Baik'),
(6, 'batre to usb', 'batre to usb.jpg', 10, 'Baik'),
(7, 'Bread Board', 'Bread Board.jpg', 10, 'Baik'),
(8, 'Buzzer', 'Buzzer.jpg', 7, 'Baik'),
(10, 'Digital Multimeter', 'Digital_Multimeter.jpg', 8, ''),
(11, 'Batre', 'batre.jpg', 3, 'Baik'),
(12, 'Dot Matrix 8x8', 'Dot Matrix 8x8.jpg', 3, 'Baik'),
(13, 'Ethernet Shield', 'Ethernet Shield.jpg', 10, 'Baik'),
(14, 'GPS Module Tracker', 'GPS Module Tracker.jpg', 10, 'Baik'),
(15, 'HDMI', 'HDMI.jpg', 7, 'Baik'),
(16, 'LCD 1602A', 'LCD 1602A.jpg', 10, 'Baik'),
(17, 'Mini Servo SG90', 'Mini Servo SG90.jpg', 10, 'Baik'),
(18, 'Pematik', 'pematik.jpg', 2, 'Baik'),
(19, 'ZBee Pro S1', 'ZBee Pro S1.jpg', -50, 'Rusak');
-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `jml_barang` int(50) NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id`, `nama_barang`, `peminjam`, `level`, `jml_barang`, `tgl_pinjam`, `tgl_kembali`) VALUES
(1, 'Keyboard', 'Rosmida', 'D3TK1', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `peminjam` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_req_kembali`
--

CREATE TABLE `tbl_req_kembali` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `peminjam` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', '12345', 'admin'),
(2, 'admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(3, 'Rosmida', 'ros', 'a11a991549312b291ada8118e96495ab', 'D3TK2'),
(4, 'Agnes', 'agnes', 'b0baee9d279d34fa1dfd71aadb908c3f', 'D3TK2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_req_kembali`
--
ALTER TABLE `tbl_req_kembali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_req_kembali`
--
ALTER TABLE `tbl_req_kembali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
