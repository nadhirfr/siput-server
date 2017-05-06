-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2017 at 06:24 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siput`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `deposit_jumlah` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `user_id`, `deposit_jumlah`) VALUES
(00001, 00004, 85000),
(00002, 00002, 2000),
(00004, 00001, 500),
(00006, 00039, 20000),
(00008, 00043, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `iuran`
--

CREATE TABLE `iuran` (
  `iuran_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `iuran_nama` varchar(35) NOT NULL,
  `iuran_nominal` int(9) NOT NULL,
  `iuran_jenis_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `iuran_kategori_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iuran`
--

INSERT INTO `iuran` (`iuran_id`, `iuran_nama`, `iuran_nominal`, `iuran_jenis_id`, `iuran_kategori_id`) VALUES
(00001, 'Iuran Sampah', 10000, 00002, 00001),
(00002, 'Iuran Pokok', 25000, 00001, 00001),
(00003, 'Iuran Sosial', 10000, 00001, 00001),
(00004, 'Iuran Syawalan', 20000, 00002, 00002),
(00005, 'Iuran 17-an', 20000, 00001, 00002),
(00006, 'Pembangunan Infrastruktur', 30000, 00001, 00002),
(00007, 'Sumbangan warga baru', 200000, 00001, 00002),
(00008, 'Iuran Coba', 20000, 00001, 00003),
(00009, 'Ini coba', 20000, 00001, 00001);

-- --------------------------------------------------------

--
-- Table structure for table `iuran_jenis`
--

CREATE TABLE `iuran_jenis` (
  `iuran_jenis_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `iuran_jenis_nama` varchar(20) NOT NULL,
  `iuran_jenis_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iuran_jenis`
--

INSERT INTO `iuran_jenis` (`iuran_jenis_id`, `iuran_jenis_nama`, `iuran_jenis_keterangan`) VALUES
(00001, 'Iuran Wajib', 'Merupakan iuran yang wajib dibayar oleh semua anggota'),
(00002, 'Iuran tidak wajib', 'Merupakan iuran yang tidak wajib dibayar oleh semua anggota'),
(00003, 'Iuran cek', 'cek dhdkwe');

-- --------------------------------------------------------

--
-- Table structure for table `iuran_kategori`
--

CREATE TABLE `iuran_kategori` (
  `iuran_kategori_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `iuran_kategori_nama` varchar(20) NOT NULL,
  `iuran_kategori_interval` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iuran_kategori`
--

INSERT INTO `iuran_kategori` (`iuran_kategori_id`, `iuran_kategori_nama`, `iuran_kategori_interval`) VALUES
(00001, 'Iuran Rutin Bulanan', 30),
(00002, 'Iuran Insidental', NULL),
(00003, 'Iuran Rutin Mingguan', 7);

-- --------------------------------------------------------

--
-- Table structure for table `iuran_perubahan`
--

CREATE TABLE `iuran_perubahan` (
  `iuran_perubahan_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `iuran_perubahan_nominal` int(9) NOT NULL,
  `iuran_perubahan_date` date NOT NULL,
  `iuran_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iuran_user`
--

CREATE TABLE `iuran_user` (
  `iuran_user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `iuran_user_status` tinyint(1) NOT NULL,
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `iuran_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iuran_user`
--

INSERT INTO `iuran_user` (`iuran_user_id`, `iuran_user_status`, `user_id`, `iuran_id`) VALUES
(00002, 1, 00001, 00002),
(00005, 0, 00001, 00004),
(00006, 1, 00001, 00005),
(00024, 1, 00001, 00003),
(00030, 1, 00002, 00002),
(00031, 1, 00002, 00003),
(00032, 1, 00002, 00005),
(00034, 0, 00039, 00001),
(00035, 1, 00004, 00002),
(00036, 1, 00004, 00003),
(00037, 0, 00004, 00004),
(00039, 0, 00039, 00002),
(00391, 0, 00043, 00001),
(00392, 1, 00043, 00002),
(00393, 0, 00043, 00003),
(00397, 1, 00004, 00009),
(00398, 0, 00039, 00009),
(00399, 0, 00043, 00009),
(00400, 0, 00043, 00008);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `pengeluaran_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pengeluaran_nama` varchar(30) NOT NULL,
  `pengeluaran_keterangan` text,
  `pengeluaran_jenis_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pengeluaran_kategori_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`pengeluaran_id`, `pengeluaran_nama`, `pengeluaran_keterangan`, `pengeluaran_jenis_id`, `pengeluaran_kategori_id`) VALUES
(00001, 'Pembayaran Sampah', NULL, 00001, 00001),
(00002, 'Pembayaran Iuran RW', NULL, 00001, 00001),
(00003, 'Pembayaran Bersih Makam', NULL, 00001, 00001),
(00004, 'Pembayaran Konsum Rapat', NULL, 00001, 00001),
(00005, 'Gaji Pengelola Lampu', NULL, 00001, 00001),
(00006, 'Pembangunan Infrastruktur', NULL, 00002, 00002),
(00007, 'Iuran Coba', 'Ini ya hanya iuran coba coba aja lah gausah dipikirkan', 00001, 00001),
(00008, 'coba aja', NULL, 00001, 00001);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_jenis`
--

CREATE TABLE `pengeluaran_jenis` (
  `pengeluaran_jenis_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pengeluaran_nama` varchar(20) NOT NULL,
  `pengeluaran_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran_jenis`
--

INSERT INTO `pengeluaran_jenis` (`pengeluaran_jenis_id`, `pengeluaran_nama`, `pengeluaran_keterangan`) VALUES
(00001, 'wajib', 'ini jenis pengeluaran yang harus dibayar '),
(00002, 'tidak wajib', 'ini yang tidak wajib');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_kategori`
--

CREATE TABLE `pengeluaran_kategori` (
  `pengeluaran_kategori_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pengeluaran_kategori_nama` varchar(20) NOT NULL,
  `pengeluaran_kategori_waktu` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran_kategori`
--

INSERT INTO `pengeluaran_kategori` (`pengeluaran_kategori_id`, `pengeluaran_kategori_nama`, `pengeluaran_kategori_waktu`) VALUES
(00001, 'rutin', 7),
(00002, 'insidental', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_perubahan`
--

CREATE TABLE `pengeluaran_perubahan` (
  `pengeluaran_perubahan_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pengeluaran_perubahan_nominal` int(9) NOT NULL,
  `pengeluaran_perubahan_date` date NOT NULL,
  `pengeluaran_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran_perubahan`
--

INSERT INTO `pengeluaran_perubahan` (`pengeluaran_perubahan_id`, `pengeluaran_perubahan_nominal`, `pengeluaran_perubahan_date`, `pengeluaran_id`) VALUES
(00001, 90900, '2017-09-09', 00002);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `session_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `transaksi_date` date NOT NULL,
  `transaksi_nama` varchar(30) NOT NULL,
  `transaksi_nominal` int(9) NOT NULL,
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `transaksi_tipe` enum('iuran','pengeluaran') NOT NULL,
  `iuran_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `pengeluaran_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_date`, `transaksi_nama`, `transaksi_nominal`, `user_id`, `transaksi_tipe`, `iuran_id`, `pengeluaran_id`) VALUES
(00055, '2016-02-24', 'Iuran Pokok', 20000, 00001, 'iuran', 00002, NULL),
(00062, '2017-02-25', 'Iuran Coba', 5000, 00001, 'iuran', 00008, NULL),
(00079, '2017-02-24', 'kuda', 20000, 00001, 'iuran', 00002, NULL),
(00083, '2017-01-01', 'Pembayaran Sampah', 20000, 00001, 'pengeluaran', NULL, 00001),
(00085, '2017-02-01', 'Pembayaran Iuran RW', 2000, 00001, 'pengeluaran', NULL, 00002),
(00094, '2017-07-02', 'Iuran Sosial', 10000, 00001, 'iuran', 00003, NULL),
(00095, '2017-08-02', 'Iuran Sosial', 10000, 00002, 'iuran', 00003, NULL),
(00096, '2017-09-02', 'Iuran Pokok', 10000, 00002, 'iuran', 00002, NULL),
(00097, '2017-10-02', 'Iuran Pokok', 5000, 00043, 'iuran', 00002, NULL),
(00098, '2017-11-02', 'Iuran Pokok', 50000, 00002, 'iuran', 00002, NULL),
(00100, '2017-12-02', 'Iuran Sosial', 10000, 00004, 'iuran', 00003, NULL),
(00104, '2017-06-04', 'Iuran Syawalan', 10000, 00001, 'iuran', 00004, NULL),
(00105, '2017-01-05', 'Iuran 17-an', 10000, 00002, 'iuran', 00005, NULL),
(00106, '2017-02-05', 'Iuran 17-an', 2000, 00002, 'iuran', 00005, NULL),
(00107, '2017-03-05', 'Iuran Pokok', 10000, 00043, 'iuran', 00002, NULL),
(00108, '2017-04-05', 'Iuran Pokok', 10000, 00043, 'iuran', 00002, NULL),
(00109, '2017-05-05', 'Ini coba', 10000, 00004, 'iuran', 00009, NULL),
(00110, '2017-03-05', 'Pembayaran Sampah', 100000, 00001, 'pengeluaran', NULL, 00001),
(00111, '2017-04-05', 'Pembayaran Iuran RW', 20000, 00001, 'pengeluaran', NULL, 00002),
(00112, '2017-05-05', 'Pembayaran Bersih Makam', 300000, 00001, 'pengeluaran', NULL, 00003),
(00113, '2017-06-05', 'Pembayaran Bersih Makam', 80000, 00001, 'pengeluaran', NULL, 00003),
(00114, '2017-07-05', 'Pembayaran Bersih Makam', 20000, 00001, 'pengeluaran', NULL, 00003),
(00115, '2017-08-05', 'Pembayaran Bersih Makam', 30000, 00001, 'pengeluaran', NULL, 00003),
(00116, '2017-09-05', 'Pembayaran Bersih Makam', 40000, 00001, 'pengeluaran', NULL, 00003),
(00117, '2017-10-05', 'Pembayaran Bersih Makam', 90000, 00001, 'pengeluaran', NULL, 00003),
(00118, '2017-11-05', 'Pembayaran Bersih Makam', 90000, 00001, 'pengeluaran', NULL, 00003);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `user_username` varchar(8) NOT NULL,
  `user_displayname` varchar(30) NOT NULL,
  `user_ktp` varchar(16) NOT NULL,
  `user_alamat` varchar(50) NOT NULL,
  `user_tgl_lahir` date NOT NULL,
  `user_password` varchar(10) NOT NULL,
  `user_tipe` enum('admin','operator','anggota') NOT NULL DEFAULT 'anggota'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_displayname`, `user_ktp`, `user_alamat`, `user_tgl_lahir`, `user_password`, `user_tipe`) VALUES
(00001, 'admin', 'Administrator', '3404020607960001', 'Gatak IX', '2017-05-09', 'admin', 'admin'),
(00002, 'op1', 'Operator-1', '3404020607960002', 'ASAS', '2017-05-29', 'op1', 'operator'),
(00004, 'anggota1', 'Anggota 1', '3404020607960003', 'klkl', '1978-11-22', 'anggota1', 'anggota'),
(00039, 'coba', 'Coba User', '3404020607960005', 'jhjh', '2017-05-01', '123', 'admin'),
(00043, 'ini suda', 'sudah bisa', '3404020607960006', 'qwerw', '2017-02-01', 'bisa', 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `iuran`
--
ALTER TABLE `iuran`
  ADD PRIMARY KEY (`iuran_id`),
  ADD KEY `iuran_jenis_id` (`iuran_jenis_id`,`iuran_kategori_id`),
  ADD KEY `iuran_kategori_id` (`iuran_kategori_id`);

--
-- Indexes for table `iuran_jenis`
--
ALTER TABLE `iuran_jenis`
  ADD PRIMARY KEY (`iuran_jenis_id`);

--
-- Indexes for table `iuran_kategori`
--
ALTER TABLE `iuran_kategori`
  ADD PRIMARY KEY (`iuran_kategori_id`);

--
-- Indexes for table `iuran_perubahan`
--
ALTER TABLE `iuran_perubahan`
  ADD PRIMARY KEY (`iuran_perubahan_id`),
  ADD KEY `iuran_id` (`iuran_id`);

--
-- Indexes for table `iuran_user`
--
ALTER TABLE `iuran_user`
  ADD PRIMARY KEY (`iuran_user_id`),
  ADD KEY `user_id` (`user_id`,`iuran_id`),
  ADD KEY `iuran_id` (`iuran_id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`pengeluaran_id`),
  ADD KEY `pengeluaran_jenis_id` (`pengeluaran_jenis_id`),
  ADD KEY `pengeluaran_kategori_id` (`pengeluaran_kategori_id`);

--
-- Indexes for table `pengeluaran_jenis`
--
ALTER TABLE `pengeluaran_jenis`
  ADD PRIMARY KEY (`pengeluaran_jenis_id`);

--
-- Indexes for table `pengeluaran_kategori`
--
ALTER TABLE `pengeluaran_kategori`
  ADD PRIMARY KEY (`pengeluaran_kategori_id`);

--
-- Indexes for table `pengeluaran_perubahan`
--
ALTER TABLE `pengeluaran_perubahan`
  ADD PRIMARY KEY (`pengeluaran_perubahan_id`),
  ADD KEY `iuran_id` (`pengeluaran_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `iuran_id` (`iuran_id`),
  ADD KEY `pengeluaran_id` (`pengeluaran_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `iuran`
--
ALTER TABLE `iuran`
  MODIFY `iuran_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `iuran_jenis`
--
ALTER TABLE `iuran_jenis`
  MODIFY `iuran_jenis_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `iuran_kategori`
--
ALTER TABLE `iuran_kategori`
  MODIFY `iuran_kategori_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `iuran_perubahan`
--
ALTER TABLE `iuran_perubahan`
  MODIFY `iuran_perubahan_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iuran_user`
--
ALTER TABLE `iuran_user`
  MODIFY `iuran_user_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `pengeluaran_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pengeluaran_jenis`
--
ALTER TABLE `pengeluaran_jenis`
  MODIFY `pengeluaran_jenis_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengeluaran_kategori`
--
ALTER TABLE `pengeluaran_kategori`
  MODIFY `pengeluaran_kategori_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengeluaran_perubahan`
--
ALTER TABLE `pengeluaran_perubahan`
  MODIFY `pengeluaran_perubahan_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iuran`
--
ALTER TABLE `iuran`
  ADD CONSTRAINT `iuran_ibfk_1` FOREIGN KEY (`iuran_kategori_id`) REFERENCES `iuran_kategori` (`iuran_kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iuran_jenis` FOREIGN KEY (`iuran_jenis_id`) REFERENCES `iuran_jenis` (`iuran_jenis_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iuran_perubahan`
--
ALTER TABLE `iuran_perubahan`
  ADD CONSTRAINT `iuran_perubahan_ibfk_1` FOREIGN KEY (`iuran_id`) REFERENCES `iuran` (`iuran_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iuran_user`
--
ALTER TABLE `iuran_user`
  ADD CONSTRAINT `iuran_id` FOREIGN KEY (`iuran_id`) REFERENCES `iuran` (`iuran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iuran_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `kategori_kategori_id` FOREIGN KEY (`pengeluaran_kategori_id`) REFERENCES `pengeluaran_kategori` (`pengeluaran_kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengeluaran_jenis_id` FOREIGN KEY (`pengeluaran_jenis_id`) REFERENCES `pengeluaran_jenis` (`pengeluaran_jenis_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengeluaran_perubahan`
--
ALTER TABLE `pengeluaran_perubahan`
  ADD CONSTRAINT `pengeluaran_perubahan_ibfk_1` FOREIGN KEY (`pengeluaran_id`) REFERENCES `pengeluaran` (`pengeluaran_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `iuran_id_transaksi` FOREIGN KEY (`iuran_id`) REFERENCES `iuran` (`iuran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengeluaran_id_transaksi` FOREIGN KEY (`pengeluaran_id`) REFERENCES `pengeluaran` (`pengeluaran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
