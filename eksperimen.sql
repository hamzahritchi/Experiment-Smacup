-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 17, 2018 at 03:46 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eksperimen`
--

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_aktivitas`
--

DROP TABLE IF EXISTS `eksperimen_aktivitas`;
CREATE TABLE IF NOT EXISTS `eksperimen_aktivitas` (
  `aktivitas_id` int(11) NOT NULL AUTO_INCREMENT,
  `peserta_id` int(11) NOT NULL,
  `aktivitas_url` text NOT NULL,
  `aktivitas_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`aktivitas_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25995 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_barang`
--

DROP TABLE IF EXISTS `eksperimen_barang`;
CREATE TABLE IF NOT EXISTS `eksperimen_barang` (
  `barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_kode` varchar(20) NOT NULL,
  `barang_kategori` varchar(30) NOT NULL,
  `barang_segment1` varchar(100) NOT NULL,
  `barang_segment2` varchar(100) NOT NULL,
  `barang_segment3` varchar(100) NOT NULL,
  `barang_nama` varchar(45) NOT NULL,
  `barang_satuan` varchar(20) NOT NULL,
  `barang_jumlah` decimal(20,2) NOT NULL,
  `barang_cost` decimal(20,2) NOT NULL,
  `barang_hargajual` decimal(20,2) NOT NULL,
  PRIMARY KEY (`barang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eksperimen_barang`
--

INSERT INTO `eksperimen_barang` (`barang_id`, `barang_kode`, `barang_kategori`, `barang_segment1`, `barang_segment2`, `barang_segment3`, `barang_nama`, `barang_satuan`, `barang_jumlah`, `barang_cost`, `barang_hargajual`) VALUES
(1, 'B00001', '', '', '', '', 'Kain Blacu', 'meter', '0.00', '50000.00', '100000.00'),
(2, 'B00002', '', '', '', '', 'Kain Katun Motif Batik', 'meter', '0.00', '75000.00', '75000.00'),
(3, 'B00003', '', '', '', '', 'Kain Katun', 'meter', '0.00', '60000.00', '100000.00'),
(4, 'B00004', '', '', '', '', 'Kain Wools', 'meter', '0.00', '100000.00', '200000.00'),
(5, 'B00005', '', '', '', '', 'Kain Denim', 'meter', '0.00', '75000.00', '75000.00'),
(6, 'B00006', '', '', '', '', 'Baju Sablon Warna Putih', 'lusin', '100.00', '250000.00', '500000.00'),
(7, 'B00007', '', '', '', '', 'Baju Sablon Warna Abu', 'lusin', '100.00', '240000.00', '450000.00'),
(8, 'B00008', '', '', '', '', 'Batik Putih', 'lusin', '0.00', '250000.00', '500000.00'),
(9, 'B00009', '', '', '', '', 'Hoodie Hitam', 'lusin', '0.00', '100000.00', '520000.00'),
(10, 'B00010', '', '', '', '', 'Hoodie Hitam Woll', 'lusin', '0.00', '100000.00', '550000.00');

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_bariskwitansi`
--

DROP TABLE IF EXISTS `eksperimen_bariskwitansi`;
CREATE TABLE IF NOT EXISTS `eksperimen_bariskwitansi` (
  `kwitansi_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `bariskwitansi_jumlah` decimal(20,2) NOT NULL,
  `bariskwitansi_subtotal` decimal(20,2) NOT NULL,
  PRIMARY KEY (`kwitansi_id`,`peserta_id`,`barang_id`),
  KEY `eksperimen_bariskwitansi_ibfk_1` (`peserta_id`),
  KEY `barang_id` (`barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_barispengiriman`
--

DROP TABLE IF EXISTS `eksperimen_barispengiriman`;
CREATE TABLE IF NOT EXISTS `eksperimen_barispengiriman` (
  `pengiriman_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `barispengiriman_jumlah` decimal(20,2) NOT NULL,
  `barispengiriman_tcost` decimal(20,2) NOT NULL,
  PRIMARY KEY (`pengiriman_id`,`peserta_id`,`barang_id`),
  KEY `eksperimen_barispengiriman_ibfk_1` (`peserta_id`),
  KEY `barang_id` (`barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_barispesanan`
--

DROP TABLE IF EXISTS `eksperimen_barispesanan`;
CREATE TABLE IF NOT EXISTS `eksperimen_barispesanan` (
  `pesanan_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `barispesanan_jumlah` decimal(20,2) NOT NULL,
  `barispesanan_subtotal` decimal(20,2) NOT NULL,
  PRIMARY KEY (`pesanan_id`,`peserta_id`,`barang_id`),
  KEY `eksperimen_barispesanan_ibfk_1` (`peserta_id`),
  KEY `barang_id` (`barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_barispesanbeli`
--

DROP TABLE IF EXISTS `eksperimen_barispesanbeli`;
CREATE TABLE IF NOT EXISTS `eksperimen_barispesanbeli` (
  `pesanbeli_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `barispesanbeli_jumlah` decimal(20,2) NOT NULL,
  `barispesanbeli_subtotal` decimal(20,2) NOT NULL,
  PRIMARY KEY (`pesanbeli_id`,`peserta_id`,`barang_id`),
  KEY `eksperimen_barispesanbeli_ibfk_1` (`peserta_id`,`pesanbeli_id`) USING BTREE,
  KEY `barang_id` (`barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_baristagihan`
--

DROP TABLE IF EXISTS `eksperimen_baristagihan`;
CREATE TABLE IF NOT EXISTS `eksperimen_baristagihan` (
  `tagihan_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `baristagihan_jumlah` decimal(20,2) NOT NULL,
  `baristagihan_subtotal` decimal(20,2) NOT NULL,
  PRIMARY KEY (`tagihan_id`,`peserta_id`,`barang_id`),
  KEY `eksperimen_baristagihan_ibfk_1` (`peserta_id`),
  KEY `barang_id` (`barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_baristerimabarang`
--

DROP TABLE IF EXISTS `eksperimen_baristerimabarang`;
CREATE TABLE IF NOT EXISTS `eksperimen_baristerimabarang` (
  `terimabarang_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `baristerimabarang_jumlah` decimal(20,2) NOT NULL,
  PRIMARY KEY (`terimabarang_id`,`peserta_id`,`barang_id`),
  KEY `eksperimen_baristerimabarang_ibfk_1` (`peserta_id`),
  KEY `barang_id` (`barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_case1`
--

DROP TABLE IF EXISTS `eksperimen_case1`;
CREATE TABLE IF NOT EXISTS `eksperimen_case1` (
  `case1_id` int(11) NOT NULL AUTO_INCREMENT,
  `peserta_id` int(11) NOT NULL,
  `case1_1` int(11) NOT NULL,
  `case1_2` int(11) NOT NULL,
  `case1_3` int(11) NOT NULL,
  `case1_4` int(11) NOT NULL,
  `case1_5` int(11) NOT NULL,
  `case1_6` int(11) NOT NULL,
  `case1_7` int(11) NOT NULL,
  `case1_8` int(11) NOT NULL,
  `case1_9` int(11) NOT NULL,
  `case1_10` int(11) NOT NULL,
  `case1_11` int(11) NOT NULL,
  `case1_12` int(11) NOT NULL,
  `case1_13` int(11) NOT NULL,
  `case1_14` int(11) NOT NULL,
  `case1_15` int(11) NOT NULL,
  `case1_16` int(11) NOT NULL,
  `case1_17` int(11) NOT NULL,
  `case1_18` int(11) NOT NULL,
  `case1_19` int(11) NOT NULL,
  `case1_20` int(11) NOT NULL,
  `case1_final` int(11) NOT NULL,
  `case1_a1` int(11) NOT NULL DEFAULT '0',
  `case1_a2` int(11) NOT NULL DEFAULT '0',
  `case1_a3` int(11) NOT NULL DEFAULT '0',
  `case1_a4` int(11) NOT NULL DEFAULT '0',
  `case1_a5` int(11) NOT NULL DEFAULT '0',
  `case1_timestart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `case1_timefinish` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`case1_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_case2`
--

DROP TABLE IF EXISTS `eksperimen_case2`;
CREATE TABLE IF NOT EXISTS `eksperimen_case2` (
  `case2_id` int(11) NOT NULL AUTO_INCREMENT,
  `peserta_id` int(11) NOT NULL,
  `case2_1` int(11) NOT NULL,
  `case2_2` int(11) NOT NULL,
  `case2_3` int(11) NOT NULL,
  `case2_4` int(11) NOT NULL,
  `case2_5` int(11) NOT NULL,
  `case2_6` int(11) NOT NULL,
  `case2_7` int(11) NOT NULL,
  `case2_8` int(11) NOT NULL,
  `case2_9` int(11) NOT NULL,
  `case2_10` int(11) NOT NULL,
  `case2_11` int(11) NOT NULL,
  `case2_12` int(11) NOT NULL,
  `case2_13` int(11) NOT NULL,
  `case2_14` int(11) NOT NULL,
  `case2_15` int(11) NOT NULL,
  `case2_16` int(11) NOT NULL,
  `case2_17` int(11) NOT NULL,
  `case2_18` int(11) NOT NULL,
  `case2_19` int(11) NOT NULL,
  `case2_20` int(11) NOT NULL,
  `case2_final` int(11) NOT NULL,
  `case2_a1` int(11) NOT NULL,
  `case2_a2` int(11) NOT NULL,
  `case2_a3` int(11) NOT NULL,
  `case2_a4` int(11) NOT NULL,
  `case2_a5` int(11) NOT NULL,
  `case2_timestart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `case2_timefinish` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`case2_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_karakteristik`
--

DROP TABLE IF EXISTS `eksperimen_karakteristik`;
CREATE TABLE IF NOT EXISTS `eksperimen_karakteristik` (
  `karakteristik_id` int(11) NOT NULL AUTO_INCREMENT,
  `peserta_id` int(11) NOT NULL,
  `karakteristik_1` int(11) NOT NULL,
  `karakteristik_2` int(11) NOT NULL,
  `karakteristik_3` int(11) NOT NULL,
  `karakteristik_4` int(11) NOT NULL,
  `karakteristik_text2` text NOT NULL,
  `karakteristik_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`karakteristik_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=378 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_kesulitan`
--

DROP TABLE IF EXISTS `eksperimen_kesulitan`;
CREATE TABLE IF NOT EXISTS `eksperimen_kesulitan` (
  `kesulitan_id` int(11) NOT NULL AUTO_INCREMENT,
  `peserta_id` int(11) NOT NULL,
  `kesulitan_1` int(11) NOT NULL,
  `kesulitan_2` int(11) NOT NULL,
  `kesulitan_3` int(11) NOT NULL,
  `kesulitan_4` int(11) NOT NULL,
  `kesulitan_5` int(11) NOT NULL,
  `kesulitan_preferensi` text NOT NULL,
  `kesulitan_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kesulitan_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_kontak`
--

DROP TABLE IF EXISTS `eksperimen_kontak`;
CREATE TABLE IF NOT EXISTS `eksperimen_kontak` (
  `kontak_id` int(11) NOT NULL AUTO_INCREMENT,
  `kontak_kode` varchar(20) NOT NULL,
  `kontak_jenis` int(11) NOT NULL,
  `kontak_nama` varchar(45) NOT NULL,
  `kontak_npwd` varchar(30) NOT NULL,
  `kontak_email` varchar(20) NOT NULL,
  `kontak_kodepos` varchar(20) NOT NULL,
  `kontak_provinsi` varchar(50) NOT NULL,
  `kontak_kota` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kontak_alamat` varchar(200) DEFAULT NULL,
  `kontak_telepon` varchar(30) DEFAULT NULL,
  `kontak_status` varchar(20) NOT NULL DEFAULT 'aktif',
  PRIMARY KEY (`kontak_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eksperimen_kontak`
--

INSERT INTO `eksperimen_kontak` (`kontak_id`, `kontak_kode`, `kontak_jenis`, `kontak_nama`, `kontak_npwd`, `kontak_email`, `kontak_kodepos`, `kontak_provinsi`, `kontak_kota`, `kecamatan`, `kontak_alamat`, `kontak_telepon`, `kontak_status`) VALUES
(1, 'C0001', 2, 'Tuan Adi', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(2, 'C0002', 2, 'Toko Bu Fitra', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(3, 'C0003', 2, 'Achmad Bandung', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(4, 'C0004', 2, 'Tuan Andy', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(5, 'C0005', 2, 'Firman SBY', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(6, 'V0001', 1, 'PT Cahaya Purma Katun Sakti', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(7, 'V0002', 1, 'PT Jaya Katun Abadi', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(8, 'V0003', 1, 'PT Batik Cahaya Utama', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(9, 'V0004', 1, 'PT Kain Katun', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(10, 'V0005', 1, 'PT KCK', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(11, 'C0006', 2, 'Hirman Firdaus', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(12, 'C0007', 2, 'Eddy Jaya', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(13, 'C0008', 2, 'PD Unggar Cahaya', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(14, 'C0009', 2, 'PD Baju Kami', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(15, 'C0010', 2, 'PD Baju Linggar Jaya', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(16, 'V0006', 1, 'PD Baju Kujang Cikampek', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(17, 'V0007', 1, 'PT Kain Sutra', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(18, 'V0008', 1, 'PT Jasa Batik', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(19, 'V0009', 1, 'PT Borneo Woll', '', '', '', '', '', '', NULL, NULL, 'aktif'),
(20, 'V0010', 1, 'PT Dipatiukur', '', '', '', '', '', '', NULL, NULL, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_kwitansi`
--

DROP TABLE IF EXISTS `eksperimen_kwitansi`;
CREATE TABLE IF NOT EXISTS `eksperimen_kwitansi` (
  `kwitansi_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `kwitansi_tanggal` date NOT NULL,
  `kwitansi_term` varchar(20) NOT NULL,
  `kwitansi_dp` decimal(20,2) NOT NULL,
  `kwitansi_beban` decimal(20,2) NOT NULL,
  `kontak_id` int(11) NOT NULL,
  `kwitansi_status` int(11) NOT NULL,
  `pengiriman_id` varchar(20) NOT NULL,
  `kwitansi_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kwitansi_id`,`peserta_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_pembayaran`
--

DROP TABLE IF EXISTS `eksperimen_pembayaran`;
CREATE TABLE IF NOT EXISTS `eksperimen_pembayaran` (
  `pembayaran_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `kwitansi_id` varchar(20) NOT NULL,
  `pembayaran_tanggal` date NOT NULL,
  `pembayaran_jumlah` decimal(20,2) NOT NULL,
  `pembayaran_via` varchar(20) NOT NULL,
  `pembayaran_ket` text NOT NULL,
  `pembayaran_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pembayaran_id`,`peserta_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_pembtagihan`
--

DROP TABLE IF EXISTS `eksperimen_pembtagihan`;
CREATE TABLE IF NOT EXISTS `eksperimen_pembtagihan` (
  `pembtagihan_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `tagihan_id` varchar(20) NOT NULL,
  `pembtagihan_tanggal` date NOT NULL,
  `pembtagihan_jumlah` decimal(20,2) NOT NULL,
  `pembtagihan_via` varchar(20) NOT NULL,
  `pembtagihan_ket` text NOT NULL,
  `pembtagihan_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pembtagihan_id`,`peserta_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_pengiriman`
--

DROP TABLE IF EXISTS `eksperimen_pengiriman`;
CREATE TABLE IF NOT EXISTS `eksperimen_pengiriman` (
  `pengiriman_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `pengiriman_tanggal` date NOT NULL,
  `pengiriman_beban` decimal(20,2) NOT NULL,
  `pesanan_id` varchar(20) DEFAULT NULL,
  `pengiriman_term` varchar(20) NOT NULL,
  `kontak_id` varchar(20) NOT NULL,
  `pengiriman_status` int(11) NOT NULL,
  `pengiriman_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pengiriman_id`,`peserta_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_pesanan`
--

DROP TABLE IF EXISTS `eksperimen_pesanan`;
CREATE TABLE IF NOT EXISTS `eksperimen_pesanan` (
  `pesanan_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `pesanan_tanggal` date NOT NULL,
  `kontak_id` int(11) NOT NULL,
  `pesanan_dp` decimal(20,2) NOT NULL,
  `pesanan_term` varchar(40) NOT NULL,
  `pesanan_status` int(11) NOT NULL,
  `pesanan_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pesanan_id`,`peserta_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_pesanbeli`
--

DROP TABLE IF EXISTS `eksperimen_pesanbeli`;
CREATE TABLE IF NOT EXISTS `eksperimen_pesanbeli` (
  `pesanbeli_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `pesanbeli_tanggal` date NOT NULL,
  `kontak_id` int(11) NOT NULL,
  `pesanbeli_dp` decimal(20,2) NOT NULL,
  `pesanbeli_term` varchar(40) NOT NULL,
  `pesanbeli_status` int(11) NOT NULL,
  `pesanbeli_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pesanbeli_id`,`peserta_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_peserta`
--

DROP TABLE IF EXISTS `eksperimen_peserta`;
CREATE TABLE IF NOT EXISTS `eksperimen_peserta` (
  `peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `peserta_email` varchar(40) DEFAULT NULL,
  `peserta_hp` varchar(40) DEFAULT NULL,
  `peserta_hadiah` varchar(40) NOT NULL,
  `peserta_token` varchar(128) NOT NULL,
  `peserta_ip` varchar(40) NOT NULL,
  `peserta_kota` varchar(40) NOT NULL,
  `peserta_lokasi` varchar(40) NOT NULL,
  `peserta_browser` text NOT NULL,
  `peserta_isp` varchar(40) NOT NULL,
  `peserta_pengalaman` int(11) NOT NULL,
  `peserta_navigasi` int(11) NOT NULL,
  `peserta_panduan` int(11) NOT NULL,
  `peserta_urutan` int(11) NOT NULL,
  `peserta_status` int(11) NOT NULL,
  `peserta_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`peserta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=384 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_responden`
--

DROP TABLE IF EXISTS `eksperimen_responden`;
CREATE TABLE IF NOT EXISTS `eksperimen_responden` (
  `responden_id` int(11) NOT NULL AUTO_INCREMENT,
  `peserta_id` int(11) NOT NULL,
  `responden_jk` varchar(6) NOT NULL,
  `responden_usia` decimal(2,0) NOT NULL,
  `responden_pendidikan` varchar(40) NOT NULL,
  `responden_bidangusaha` varchar(40) NOT NULL,
  `responden_penghasilan` varchar(100) NOT NULL,
  `responden_karyawan` varchar(100) NOT NULL,
  `responden_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`responden_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_tagihan`
--

DROP TABLE IF EXISTS `eksperimen_tagihan`;
CREATE TABLE IF NOT EXISTS `eksperimen_tagihan` (
  `tagihan_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `tagihan_tanggal` date NOT NULL,
  `tagihan_term` varchar(20) NOT NULL,
  `tagihan_dp` decimal(20,2) NOT NULL,
  `tagihan_beban` decimal(20,2) NOT NULL,
  `kontak_id` int(11) NOT NULL,
  `tagihan_status` int(11) NOT NULL,
  `terimabarang_id` varchar(20) NOT NULL,
  `tagihan_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tagihan_id`,`peserta_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_terimabarang`
--

DROP TABLE IF EXISTS `eksperimen_terimabarang`;
CREATE TABLE IF NOT EXISTS `eksperimen_terimabarang` (
  `terimabarang_id` varchar(20) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `terimabarang_tanggal` date NOT NULL,
  `terimabarang_beban` decimal(20,2) NOT NULL,
  `pesanbeli_id` varchar(20) DEFAULT NULL,
  `terimabarang_term` varchar(20) NOT NULL,
  `kontak_id` varchar(20) NOT NULL,
  `terimabarang_status` int(11) NOT NULL,
  `terimabarang_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`terimabarang_id`,`peserta_id`),
  KEY `peserta_id` (`peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eksperimen_aktivitas`
--
ALTER TABLE `eksperimen_aktivitas`
  ADD CONSTRAINT `eksperimen_aktivitas_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_bariskwitansi`
--
ALTER TABLE `eksperimen_bariskwitansi`
  ADD CONSTRAINT `eksperimen_bariskwitansi_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eksperimen_bariskwitansi_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `eksperimen_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_barispengiriman`
--
ALTER TABLE `eksperimen_barispengiriman`
  ADD CONSTRAINT `eksperimen_barispengiriman_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eksperimen_barispengiriman_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `eksperimen_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_barispesanan`
--
ALTER TABLE `eksperimen_barispesanan`
  ADD CONSTRAINT `eksperimen_barispesanan_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eksperimen_barispesanan_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `eksperimen_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_barispesanbeli`
--
ALTER TABLE `eksperimen_barispesanbeli`
  ADD CONSTRAINT `eksperimen_barispesanbeli_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eksperimen_barispesanbeli_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `eksperimen_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_baristagihan`
--
ALTER TABLE `eksperimen_baristagihan`
  ADD CONSTRAINT `eksperimen_baristagihan_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eksperimen_baristagihan_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `eksperimen_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_baristerimabarang`
--
ALTER TABLE `eksperimen_baristerimabarang`
  ADD CONSTRAINT `eksperimen_baristerimabarang_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eksperimen_baristerimabarang_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `eksperimen_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_case1`
--
ALTER TABLE `eksperimen_case1`
  ADD CONSTRAINT `eksperimen_case1_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_case2`
--
ALTER TABLE `eksperimen_case2`
  ADD CONSTRAINT `eksperimen_case2_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_karakteristik`
--
ALTER TABLE `eksperimen_karakteristik`
  ADD CONSTRAINT `eksperimen_karakteristik_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_kesulitan`
--
ALTER TABLE `eksperimen_kesulitan`
  ADD CONSTRAINT `eksperimen_kesulitan_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_kwitansi`
--
ALTER TABLE `eksperimen_kwitansi`
  ADD CONSTRAINT `eksperimen_kwitansi_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_pembayaran`
--
ALTER TABLE `eksperimen_pembayaran`
  ADD CONSTRAINT `eksperimen_pembayaran_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_pembtagihan`
--
ALTER TABLE `eksperimen_pembtagihan`
  ADD CONSTRAINT `eksperimen_pembtagihan_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_pengiriman`
--
ALTER TABLE `eksperimen_pengiriman`
  ADD CONSTRAINT `eksperimen_pengiriman_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_pesanan`
--
ALTER TABLE `eksperimen_pesanan`
  ADD CONSTRAINT `eksperimen_pesanan_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_pesanbeli`
--
ALTER TABLE `eksperimen_pesanbeli`
  ADD CONSTRAINT `eksperimen_pesanbeli_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_responden`
--
ALTER TABLE `eksperimen_responden`
  ADD CONSTRAINT `eksperimen_responden_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_tagihan`
--
ALTER TABLE `eksperimen_tagihan`
  ADD CONSTRAINT `eksperimen_tagihan_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksperimen_terimabarang`
--
ALTER TABLE `eksperimen_terimabarang`
  ADD CONSTRAINT `eksperimen_terimabarang_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `eksperimen_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
