-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 03:11 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbbahan`
--

CREATE TABLE `tbbahan` (
  `id_bahan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbbahan`
--

INSERT INTO `tbbahan` (`id_bahan`, `nama`, `jumlah`) VALUES
(1, 'Ayam', 9),
(2, 'Nasi', 9),
(4, 'Air', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbkategori`
--

CREATE TABLE `tbkategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkategori`
--

INSERT INTO `tbkategori` (`id_kategori`, `nama`) VALUES
(1, 'Ayam Dan Nasi'),
(2, 'Minuman'),
(7, 'Ayam ');

-- --------------------------------------------------------

--
-- Table structure for table `tbmeja`
--

CREATE TABLE `tbmeja` (
  `id_meja` int(11) NOT NULL,
  `no_meja` int(3) NOT NULL,
  `status` enum('Kosong','Terisi') NOT NULL DEFAULT 'Kosong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmeja`
--

INSERT INTO `tbmeja` (`id_meja`, `no_meja`, `status`) VALUES
(3, 3, 'Terisi'),
(4, 4, 'Terisi'),
(5, 5, 'Kosong'),
(8, 1, 'Terisi'),
(9, 2, 'Terisi');

-- --------------------------------------------------------

--
-- Table structure for table `tbmenu`
--

CREATE TABLE `tbmenu` (
  `id_menu` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmenu`
--

INSERT INTO `tbmenu` (`id_menu`, `nama`, `harga`, `gambar`, `deskripsi`, `id_kategori`) VALUES
(31, 'Paket Geprek Sambal Original', 17000, 'bc80a459-f927-4844-a83e-13c695302a0e_Go-Biz_20221214_185734.jpeg', 'Ayam Dan Nasi', 1),
(32, 'Paket Geprek Sambal Matah', 17000, '5383b3d7-51bb-41f1-8349-96c1d15b437e_Go-Biz_20221214_185755.jpeg', 'Ayam Dan Nasi', 1),
(33, 'Paket Geprek Sambal Ijo', 17000, 'e6ebe024-6f60-4158-8798-7fd694997573_Go-Biz_20221214_185811.jpeg', 'Ayam Dan Nasi', 1),
(34, 'Paket Geprek Sambal Bawang', 17000, 'bc80a459-f927-4844-a83e-13c695302a0e_Go-Biz_20221214_185734.jpeg', 'Ayam Dan Nasi', 1),
(35, 'Paket Gencor (Geprek Ancoor)', 15000, '1452709f-26b4-4c18-aef1-395e0596ef4d_Go-Biz_20221214_185843.jpeg', 'Ayam Dan Nasi', 1),
(36, 'Ayam Geprek Sambal Ijo', 12000, '02b31af9-1af0-4a2b-a5f1-0f711d19a57a_Go-Biz_20221214_185926.jpeg', 'Tanpa Nasi', 7),
(37, 'Ayam Geprek Sambal Matah', 12000, '6f83f75b-f384-4b7b-ab34-6637858ffc7b_Go-Biz_20221214_185939.jpeg', 'Tanpa Nasi', 7),
(38, 'Ayam Geprek Sambal Bawang', 12000, '370f6006-404b-45b8-979e-0ed951760933_Go-Biz_20221214_190213.jpeg', 'Tanpa Nasi', 7),
(39, 'Ayam Geprek Sambal Original', 12000, '3d1b96df-8512-484a-984f-5debfc1d54e6_Go-Biz_20221214_190229.jpeg', 'Tanpa Nasi', 7),
(40, 'Ayam Gencor (Geprek Ancoor)', 10000, 'b598d936-dc09-42e7-978a-dde389ebd28e_Go-Biz_20221214_190242.jpeg', 'Tanpa Nasi', 7),
(41, 'Teh Botol 250 ml', 4000, 'f0dc7f4b-b44e-4fce-9e43-cbdc50b39872_Go-Biz_20230827_110610.jpeg', 'Minuman Teh', 2),
(42, 'Fruit Tea 350 ml', 5000, 'b4ec9877-336a-4d4f-9432-b2bf9bb9db03_Go-Biz_20230827_110555.jpeg', 'Minuman Teh Berasa', 2),
(43, 'Teh Tarik Hanaang', 8000, 'b34770c9-9a10-456a-a562-6c4f5533485f_Go-Biz_20230827_105407.jpeg', 'Minuman Teh Tarik', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbmenustock`
--

CREATE TABLE `tbmenustock` (
  `id_menu` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmenustock`
--

INSERT INTO `tbmenustock` (`id_menu`, `id_bahan`) VALUES
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 4),
(42, 4),
(43, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbpesan`
--

CREATE TABLE `tbpesan` (
  `id_pesan` int(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_pesan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Proses','Selesai') NOT NULL DEFAULT 'Proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpesan`
--

INSERT INTO `tbpesan` (`id_pesan`, `id_meja`, `nama`, `tgl_pesan`, `status`) VALUES
(48, 4, 'alif', '2024-01-16 02:29:38', 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `tbpesanmenu`
--

CREATE TABLE `tbpesanmenu` (
  `id_pesanmenu` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpesanmenu`
--

INSERT INTO `tbpesanmenu` (`id_pesanmenu`, `id_pesan`, `id_menu`, `jumlah`, `total_harga`) VALUES
(65, 48, 31, 1, 17000),
(66, 48, 43, 1, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` enum('Pelayan','Owner','','') NOT NULL DEFAULT 'Pelayan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(1, 'pelayan', 'pelayan', 'Alif', 'Pelayan'),
(2, 'owner', 'owner', 'Asep', 'Owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbbahan`
--
ALTER TABLE `tbbahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbmeja`
--
ALTER TABLE `tbmeja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `tbmenu`
--
ALTER TABLE `tbmenu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tbmenustock`
--
ALTER TABLE `tbmenustock`
  ADD PRIMARY KEY (`id_menu`,`id_bahan`),
  ADD KEY `id_bahan` (`id_bahan`);

--
-- Indexes for table `tbpesan`
--
ALTER TABLE `tbpesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `fk_tbpesan_tbmeja` (`id_meja`);

--
-- Indexes for table `tbpesanmenu`
--
ALTER TABLE `tbpesanmenu`
  ADD PRIMARY KEY (`id_pesanmenu`),
  ADD KEY `fk_tbpesanmenu_tbpesan` (`id_pesan`),
  ADD KEY `fk_tbpesanmenu_tbmenu` (`id_menu`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbbahan`
--
ALTER TABLE `tbbahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbmeja`
--
ALTER TABLE `tbmeja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbmenu`
--
ALTER TABLE `tbmenu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbpesan`
--
ALTER TABLE `tbpesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbpesanmenu`
--
ALTER TABLE `tbpesanmenu`
  MODIFY `id_pesanmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbmenu`
--
ALTER TABLE `tbmenu`
  ADD CONSTRAINT `tbmenu_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbkategori` (`id_kategori`);

--
-- Constraints for table `tbmenustock`
--
ALTER TABLE `tbmenustock`
  ADD CONSTRAINT `tbmenustock_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tbmenu` (`id_menu`),
  ADD CONSTRAINT `tbmenustock_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `tbbahan` (`id_bahan`);

--
-- Constraints for table `tbpesan`
--
ALTER TABLE `tbpesan`
  ADD CONSTRAINT `fk_tbpesan_tbmeja` FOREIGN KEY (`id_meja`) REFERENCES `tbmeja` (`id_meja`);

--
-- Constraints for table `tbpesanmenu`
--
ALTER TABLE `tbpesanmenu`
  ADD CONSTRAINT `fk_tbpesanmenu_tbmenu` FOREIGN KEY (`id_menu`) REFERENCES `tbmenu` (`id_menu`),
  ADD CONSTRAINT `fk_tbpesanmenu_tbpesan` FOREIGN KEY (`id_pesan`) REFERENCES `tbpesan` (`id_pesan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
