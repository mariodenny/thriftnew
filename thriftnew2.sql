-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 03:34 PM
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
-- Database: `thriftnew2`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `foto` text NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `no_whatsapp` varchar(14) NOT NULL,
  `password` text NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `tipe_daftar` varchar(50) NOT NULL,
  `tipe_akun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `foto`, `nama_lengkap`, `email`, `no_whatsapp`, `password`, `waktu`, `tipe_daftar`, `tipe_akun`) VALUES
(24, 'user.png', 'admin', 'admin@gmail.com', '0812345678', '$2y$10$73yDp52vjhMO9U7QgleDGeDtqgG6.pBs8lAjZYNXMHqTjW4gRgb96', '2024-11-23 14:47:16', '', 'Admin'),
(26, 'user.png', 'test', 'test@gmail.com', '98291891', '$2y$10$MMmpdfL5XM.EKCQXreaXjOTXD3VegnlUKjswitJcpCOL93YKyGAve', '2024-11-26 12:11:34', '', 'user'),
(28, '1328063556_aacuuu2.jpg', 'Tiaraa', 'coba@gmail.com', '083123456789', '$2y$10$6aNSkNRhPsM/zQ0GE7twxOZJIawcENasdsxnGlj3lZO6qZOTcmH2y', '2024-11-30 09:25:39', '', 'user'),
(29, 'user.png', 'eggy rizqi naufal', 'eggy@gmail.com', '085780353417', '$2y$10$wXrJ/hwbZpHu8T9tMbzCBumiJX2MOshhS3.s6OJyp/eRIwoGPLH.C', '2025-07-11 17:46:27', '', 'user'),
(30, '68713fb137779.jpg', 'putri', 'putri@gmail.com', '09888765', '$2y$10$YclSvCXob5jp1qGm8ysWj.NiB5U3kgiB.878s5vT1/I57L0rbtjEy', '2025-07-11 18:36:53', '', 'User'),
(31, 'user.png', 'yanfa', 'yanfa@gmail.com', '08876677789', '$2y$10$3ycQHx841poEoAyZ4zz6B.QAM2QbmrPm.K1Lp3ReCvfxLl26mS1b.', '2025-07-11 18:46:18', '', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `banner_promo`
--

CREATE TABLE `banner_promo` (
  `idbanner` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner_promo`
--

INSERT INTO `banner_promo` (`idbanner`, `image`, `status`) VALUES
(28, '13b1dadd4d7a53ac48b0b4aa8f709205.png', ''),
(29, 'ef77e08e706840c872011f0688025cb1.jpg', ''),
(31, 'b1c710c0be17d2ca1d839deaa6d7beb3.jpg', ''),
(34, 'd21ae516211f41e357ef8df67b9bccd2.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `flashsale`
--

CREATE TABLE `flashsale` (
  `id_fs` int(11) NOT NULL,
  `waktu_berakhir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flashsale`
--

INSERT INTO `flashsale` (`id_fs`, `waktu_berakhir`) VALUES
(1, '1659110400');

-- --------------------------------------------------------

--
-- Table structure for table `iklan`
--

CREATE TABLE `iklan` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `gambar` longtext NOT NULL,
  `judul` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `berat` int(11) NOT NULL,
  `warna` text NOT NULL,
  `ukuran` text NOT NULL,
  `stok` int(11) NOT NULL,
  `terjual` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `tipe_iklan` varchar(15) NOT NULL,
  `waktu` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iklan`
--

INSERT INTO `iklan` (`id`, `id_kategori`, `gambar`, `judul`, `harga`, `deskripsi`, `berat`, `warna`, `ukuran`, `stok`, `terjual`, `diskon`, `tipe_iklan`, `waktu`, `status`) VALUES
(45, 15, '1732268451-1.jpg', 'Kode  01', 30000, 'TRIFT TIGHIF STYLE', 500, '', '', 10, 0, 0, '', '2024-11-22 10:40:50', 'delete'),
(46, 13, '1733023098-1.jpg', 'Kode 01', 35000, 'Live tiktok thrift tighif', 300, '', '', 1, 0, 0, '', '2024-12-01 04:18:18', 'delete'),
(47, 12, '1733023295-1.jpg', 'Kode 01', 35000, 'Live tiktok thrift tighif', 300, '', '', 1, 0, 0, '', '2024-12-01 04:21:35', ''),
(48, 13, '1733026206-1.jpg', 'KODE 01', 35000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:10:06', ''),
(49, 13, '1733026262-1.jpg', 'KODE 02', 40000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:11:02', ''),
(50, 13, '1733026321-1.jpg', 'KODE 03', 45000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:12:00', ''),
(51, 14, '1733026495-1.jpg', 'KODE 01', 50000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:14:55', ''),
(52, 14, '1733026596-1.jpg', 'KODE 02', 55000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:16:35', ''),
(53, 14, '1733026769-1.jpg', 'KODE 03', 60000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:19:29', ''),
(54, 14, '1733026883-1.jpg', 'KODE 04', 70000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:21:23', ''),
(55, 14, '1733026939-1.jpg', 'KODE 05', 80000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:22:18', ''),
(56, 14, '1733027011-1.jpg', 'KODE 06', 90000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:23:31', ''),
(57, 14, '1733027060-1.jpg', 'KODE 7', 150000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:24:19', ''),
(58, 14, '1733027224-1.jpg', 'KODE 8', 1500000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:27:04', ''),
(59, 14, '1733027276-1.jpg', 'KODE 9', 1300000, 'LIVE THRIFT TIGHIF STYLE', 500, '', '', 1, 0, 0, '', '2024-12-01 05:27:55', ''),
(60, 15, '1733027481-1.jpg', 'KODE 1', 45000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:31:21', ''),
(61, 15, '1733027536-1.jpg', 'KODE 02', 50000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:32:15', ''),
(62, 15, '1733027618-1.jpg', 'KODE 03', 55000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:33:37', ''),
(63, 15, '1733027721-1.jpg', 'KODE 04', 60000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:35:20', ''),
(64, 15, '1733027896-1.jpg', 'KODE 05', 65000, 'LIVE THRIFT TIGHIF STYLE ', 300, '', '', 1, 0, 0, '', '2024-12-01 05:38:16', ''),
(65, 15, '1733028192-1.jpg', 'KODE 06', 70000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:43:11', ''),
(66, 15, '1733028245-1.jpg', 'KODE 07', 75000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:44:05', ''),
(67, 16, '1733028855-1.jpg', 'KODE 01', 35000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:45:48', ''),
(68, 16, '1733028872-1.jpg', 'KODE 02', 40000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:46:37', ''),
(69, 16, '1733028441-1.jpg', 'KODE 03', 45000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:47:21', ''),
(70, 16, '1733028478-1.jpg', 'KODE 04', 50000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:47:58', ''),
(71, 16, '1733028525-1.jpg', 'KODE 05', 55000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:48:44', ''),
(72, 16, '1733028976-1.jpg', 'KODE  06', 60000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:56:16', ''),
(73, 16, '1733029065-1.jpg', 'KODE 07', 65000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:57:21', ''),
(74, 16, '1733029908-1.jpg', 'KODE 08', 75000, 'LIVE THRIFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 05:58:58', ''),
(75, 16, '1733029274-1.jpg', 'KODE 09', 130000, 'LIVE THRFT TIGHIF STYLE', 300, '', '', 1, 0, 0, '', '2024-12-01 06:01:14', ''),
(76, 16, '1733029314-1.jpg,1733797324-2.jpg', 'KODE 10', 150000, 'LIVE THRIFT TIGHIF STYLE', 300, 'Merah,Biru,Unggu', 'S===20000,L===50000', 1, 0, 0, '', '2024-12-01 06:01:53', ''),
(77, 17, '1750656715-1.png', 'KODE 20', 50000, '....', 500, '', '', 1, 0, 0, '', '2025-06-23 07:31:54', 'delete'),
(78, 18, '1751428035-1.jpg', 'KODE 100', 100000, 'THRIFT', 300, '', '', 1, 0, 0, '', '2025-07-02 05:47:14', ''),
(79, 18, '1751429999-1.jpg', 'KODE 99', 85000, 'THRIFT', 300, '', '', 1, 0, 0, '', '2025-07-02 06:19:58', ''),
(80, 18, '1751430048-1.jpg', 'KODE 98', 78000, 'THRIFT', 300, '', '', 1, 0, 0, '', '2025-07-02 06:20:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `idinvoice` int(11) NOT NULL,
  `id_iklan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `warna_i` text NOT NULL,
  `ukuran_i` text NOT NULL,
  `harga_i` int(11) NOT NULL,
  `diskon_i` int(11) NOT NULL,
  `kurir` varchar(10) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `layanan_kurir` text NOT NULL,
  `etd` text NOT NULL,
  `harga_ongkir` int(11) NOT NULL,
  `resi` text NOT NULL,
  `provinsi` text NOT NULL,
  `kota` text NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `waktu` varchar(200) NOT NULL,
  `tipe_progress` varchar(50) NOT NULL,
  `transaction` text NOT NULL,
  `type` text NOT NULL,
  `order_id` text NOT NULL,
  `fraud` text NOT NULL,
  `bank_manual` text NOT NULL,
  `bukti_transfer` text NOT NULL,
  `waktu_transaksi` text NOT NULL,
  `waktu_dikirim` text NOT NULL,
  `waktu_selesai` text NOT NULL,
  `waktu_dibatalkan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`idinvoice`, `id_iklan`, `id_user`, `jumlah`, `warna_i`, `ukuran_i`, `harga_i`, `diskon_i`, `kurir`, `id_kurir`, `layanan_kurir`, `etd`, `harga_ongkir`, `resi`, `provinsi`, `kota`, `alamat_lengkap`, `waktu`, `tipe_progress`, `transaction`, `type`, `order_id`, `fraud`, `bank_manual`, `bukti_transfer`, `waktu_transaksi`, `waktu_dikirim`, `waktu_selesai`, `waktu_dibatalkan`) VALUES
(99, 26, 14, 2, '', '', 87000, 0, 'jne', 0, 'OKE', '2-3', 30000, '12345523245', '11,Jawa Timur', '444,Surabaya', 'Jl banyu urip', '2021-07-25 16:54:57', 'Selesai', '', '', '', '', 'BCA', '99-bukti-transfer.jpeg', '2021-07-25 16:55:10', '2021-07-25 17:04:10', '2021-07-25 17:12:37', ''),
(100, 25, 14, 1, 'MERAH', 'S', 75000, 10, 'jne', 0, 'OKE', '2-3', 15000, '12189624823', '11,Jawa Timur', '444,Surabaya', 'Jl banyu urip', '2021-07-25 17:15:06', 'Selesai', '', '', '', '', 'BCA', '100-bukti-transfer.jpeg', '2021-07-25 17:15:17', '2021-07-25 17:15:47', '2021-07-25 17:15:52', ''),
(101, 27, 14, 2, '', '', 75000, 10, 'jne', 0, 'OKE', '2-3', 30000, '12456765432', '11,Jawa Timur', '444,Surabaya', 'Jl banyu urip', '2021-07-25 22:09:36', 'Selesai', '', '', '', '', 'BCA', '101-bukti-transfer.png', '2021-07-25 22:09:46', '2021-07-25 22:11:24', '2021-07-25 22:14:15', ''),
(102, 29, 14, 1, '', '', 415000, 30, 'jne', 0, 'OKE', '2-3', 15000, '123456', '11,Jawa Timur', '444,Surabaya', 'Jl banyu urip', '2021-07-25 22:38:31', 'Selesai', '', '', '', '', 'BCA', '102-bukti-transfer.png', '2021-07-25 22:38:44', '2021-09-09 12:26:33', '2021-09-09 12:26:48', ''),
(103, 20, 14, 1, '', '', 222000, 0, 'jne', 0, 'OKE', '2-3', 90000, '123', '11,Jawa Timur', '444,Surabaya', 'Jl banyu urip', '2021-07-25 23:27:20', 'Selesai', '', '', '', '', 'BCA', '103-bukti-transfer.png', '2021-07-25 23:27:32', '2021-09-09 12:26:21', '2021-09-09 12:26:44', ''),
(105, 21, 14, 1, '', '', 15000000, 0, 'jne', 0, '', '', 0, '', '', '', '', '2021-09-09 12:44:57', 'Belum Bayar', '', '', '', '', '', '', '', '', '', ''),
(106, 30, 18, 1, '', '', 450000, 0, 'jne', 0, '', '', 0, '', '', '', '', '2022-09-17 21:35:33', 'Belum Bayar', '', '', '', '', '', '', '', '', '', ''),
(107, 20, 18, 5, '', '', 222000, 0, 'jne', 0, 'OKE', '3-4', 1110000, '12313414', '13,Kalimantan Selatan', '35,Banjarbaru', 'Kp Blokang', '2022-09-17 21:37:34', 'Selesai', '', '', '', '', 'BCA', '107-bukti-transfer.jpg', '2022-09-17 21:38:11', '2022-09-17 21:38:44', '2022-09-17 21:39:45', ''),
(108, 43, 18, 0, '', '', 0, 0, 'jne', 0, 'OKE', '3-4', 43000, '9898989898989', '13,Kalimantan Selatan', '35,Banjarbaru', 'Kp Blokang', '2023-02-04 11:28:45', 'Selesai', '', '', '', '', 'BCA', '108-bukti-transfer.jpeg', '2023-02-04 11:28:58', '2023-02-04 11:29:42', '2023-02-04 11:30:11', ''),
(109, 43, 19, 1, '', '', 1800000, 0, 'jne', 0, 'OKE', '4-5', 23000, '567576576576 ', '5,DI Yogyakarta', '135,Gunung Kidul', 'oouou', '2023-02-04 13:44:40', 'Selesai', '', '', '', '', 'BCA', '109-bukti-transfer.jpeg', '2023-02-04 13:45:08', '2023-02-04 13:45:42', '2023-02-04 13:45:49', ''),
(113, 45, 22, 1, '', '', 30000, 0, 'jne', 0, 'CTC', '1-2', 10000, 'JT1234567', '6,DKI Jakarta', '153,Jakarta Selatan', 'jagakarsa', '2024-11-22 10:41:11', 'Selesai', '', '', '', '', 'BCA', '113-bukti-transfer.jpg', '2024-11-22 10:41:42', '2024-11-22 10:46:57', '2024-11-22 10:49:48', ''),
(114, 45, 25, 1, '', '', 30000, 0, 'jne', 0, 'CTC', '1-2', 10000, 'jt12345678', '6,DKI Jakarta', '153,Jakarta Selatan', 'moh.kahfi II Rt 12', '2024-11-25 06:45:44', 'Selesai', '', '', '', '', 'BCA', '114-bukti-transfer.JPG', '2024-11-25 06:47:05', '2024-11-25 06:47:39', '2024-11-25 06:47:46', ''),
(116, 45, 27, 1, '', '', 30000, 0, 'jne', 1, 'OKE', '3-4', 25000, 'jn1356789', '8,Jambi', '156,Jambi', 'talang banjar', '2024-11-27 09:47:53', 'Selesai', '', '', '', '', 'BCA', '116-bukti-transfer.jpeg', '2024-11-27 09:55:24', '2024-11-27 09:56:44', '2025-06-16 09:42:50', ''),
(117, 45, 28, 1, '', '', 30000, 0, 'jne', 1, 'REG', '1-2', 10000, 'jnbvtrd456', '9,Jawa Barat', '79,Bogor', 'jlan raya bogor', '2024-11-30 09:25:50', 'Selesai', '', '', '', '', 'BCA', '117-bukti-transfer.png', '2024-11-30 09:27:04', '2025-06-16 09:42:43', '2025-06-16 09:42:48', ''),
(118, 52, 28, 1, '', '', 55000, 0, 'jne', 1, 'REG', '1-2', 10000, 'jne1234567', '9,Jawa Barat', '79,Bogor', 'jlan raya bogor', '2025-06-20 12:53:49', 'Selesai', '', '', '', '', 'BCA', '118-bukti-transfer.png', '2025-06-20 12:56:34', '2025-06-20 12:57:06', '2025-06-20 12:57:10', ''),
(119, 48, 28, 1, '', '', 35000, 0, 'jne', 1, 'REG', '1-2', 10000, 'jne1234567', '9,Jawa Barat', '79,Bogor', 'jlan raya bogor', '2025-06-20 12:58:58', 'Selesai', '', '', '', '', 'BCA', '119-bukti-transfer.png', '2025-06-20 13:00:57', '2025-06-20 13:02:38', '2025-06-20 13:02:44', ''),
(120, 49, 28, 1, '', '', 40000, 0, 'jne', 0, 'JTR', '3-4', 40000, 'hhfhfhtju', '9,Jawa Barat', '79,Bogor', 'jlan raya bogor', '2025-06-20 14:15:19', 'Selesai', '', '', '', '', 'BCA', '120-bukti-transfer.jpg', '2025-06-20 14:16:56', '2025-06-20 14:17:49', '2025-07-07 11:49:43', ''),
(121, 59, 28, 1, '', '', 1300000, 0, 'jne', 1, 'REG', '1-2', 10000, 'jne123456778', '9,Jawa Barat', '79,Bogor', 'jlan raya bogor', '2025-06-23 17:06:05', 'Selesai', '', '', '', '', 'BCA', '121-bukti-transfer.png', '2025-06-23 17:07:23', '2025-06-29 13:01:58', '2025-06-29 13:02:22', ''),
(122, 60, 28, 1, '', '', 45000, 0, 'jne', 1, 'REG', '1-2', 10000, '', '9,Jawa Barat', '79,Bogor', 'jlan raya bogor', '2025-06-23 17:10:28', 'Belum Bayar', '', '', '', '', '', '', '', '', '', ''),
(123, 50, 28, 1, '', '', 45000, 0, 'jne', 1, 'REG', '1-2', 10000, 'jnt1234566', '9,Jawa Barat', '79,Bogor', 'jlan raya bogor', '2025-07-07 11:46:18', 'Selesai', '', '', '', '', 'BCA', '123-bukti-transfer.jpeg', '2025-07-07 11:48:02', '2025-07-07 11:49:16', '2025-07-07 11:49:31', ''),
(124, 76, 29, 1, 'Merah', 'S', 20000, 0, 'jne', 0, 'JTR', '15-21', 110000, '77777777777777777', '2,Bangka Belitung', '28,Bangka Barat', 'jalan jalan', '2025-07-11 17:46:56', 'Selesai', '', '', '', '', 'BCA', '124-bukti-transfer.jpg', '2025-07-11 17:47:56', '2025-07-11 17:48:42', '2025-07-11 17:49:02', ''),
(125, 73, 30, 1, '', '', 65000, 0, 'jne', 0, 'JTR', '3-4', 40000, 'ygyu', '9,Jawa Barat', '115,Depok', 'gcctvbubu', '2025-07-11 19:26:40', 'Dikirim', '', '', '', '', 'BCA', '125-bukti-transfer.jpg', '2025-07-11 19:28:51', '2025-07-11 19:31:29', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `icon`) VALUES
(13, 'T-Shirt', '099c3e257090593c5e1cda593c8384d8.jpg'),
(14, 'Hoodie dan Jacket', '8aa16123c7ac72475fe114957cf0ca12.jpg'),
(15, 'Kemeja', '739b8b740a6228b466bae25dfa8be7b5.jpg'),
(16, 'Cardigan', '7f216c9999fd58649c749f9eb7150106.jpg'),
(18, 'KODE 01-100', '320c7b9893f5cbd6e3305f0343acd979.jpg'),
(19, 'GAMIS', '9c6c09f192654c0eef7fe7da7e236a21.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_iklan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_k` int(11) NOT NULL,
  `diskon_k` int(11) NOT NULL,
  `warna_k` text NOT NULL,
  `ukuran_k` text NOT NULL,
  `waktu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_iklan`, `id_user`, `jumlah`, `harga_k`, `diskon_k`, `warna_k`, `ukuran_k`, `waktu`) VALUES
(180, 58, 28, 1, 1500000, 0, '', '', '2025-06-23 17:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_user`
--

CREATE TABLE `lokasi_user` (
  `idlokasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `provinsi` text NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `kota` text NOT NULL,
  `id_kota` int(11) NOT NULL,
  `kecamatan` text NOT NULL,
  `kelurahan` text NOT NULL,
  `alamat_lengkap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_user`
--

INSERT INTO `lokasi_user` (`idlokasi`, `id_user`, `provinsi`, `id_provinsi`, `kota`, `id_kota`, `kecamatan`, `kelurahan`, `alamat_lengkap`) VALUES
(9, 3, 'Jawa Timur', 11, 'Surabaya', 444, '', '', 'Jl banyu urip'),
(10, 18, 'Kalimantan Selatan', 13, 'Banjarbaru', 35, '', '', 'Kp Blokang'),
(11, 19, 'DI Yogyakarta', 5, 'Gunung Kidul', 135, '', '', 'oouou'),
(12, 20, 'DI Yogyakarta', 5, 'Sleman', 419, '', '', 'tes'),
(13, 21, 'Banten', 3, 'Tangerang Selatan', 457, '', '', 'gg suka damai ciputat'),
(14, 22, 'DKI Jakarta', 6, 'Jakarta Selatan', 153, '', '', 'jagakarsa'),
(15, 25, 'DKI Jakarta', 6, 'Jakarta Selatan', 153, '', '', 'moh.kahfi II Rt 12'),
(16, 27, 'Jambi', 8, 'Jambi', 156, '', '', 'talang banjar'),
(17, 28, 'Jawa Barat', 9, 'Bogor', 79, '', '', 'jlan raya bogor'),
(18, 29, 'Bangka Belitung', 2, 'Bangka Barat', 28, '', '', 'jalan jalan'),
(19, 30, 'Jawa Barat', 9, 'Depok', 115, '', '', 'gcctvbubu');

-- --------------------------------------------------------

--
-- Table structure for table `nomor_rekening`
--

CREATE TABLE `nomor_rekening` (
  `idnorek` int(11) NOT NULL,
  `nama_bank` text NOT NULL,
  `norek` text NOT NULL,
  `an` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nomor_rekening`
--

INSERT INTO `nomor_rekening` (`idnorek`, `nama_bank`, `norek`, `an`) VALUES
(1, 'BCA', '5470814138', 'Tiara Oktavia'),
(2, 'BRI', '1876889286539', '');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id_notif` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `nama_notif` text NOT NULL,
  `deskripsi_notif` text NOT NULL,
  `waktu_notif` text NOT NULL,
  `status_notif` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id_notif`, `id_user`, `id_invoice`, `nama_notif`, `deskripsi_notif`, `waktu_notif`, `status_notif`) VALUES
(1, 3, 36, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-06-18 14:51:53', 'Read'),
(2, 3, 35, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-22 18:09:46', 'Read'),
(3, 3, 34, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 12:53:23', 'Read'),
(4, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 12:59:55', 'Read'),
(5, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 12:59:56', 'Read'),
(6, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 12:59:56', 'Read'),
(7, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 12:59:56', 'Read'),
(8, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 12:59:56', 'Read'),
(9, 3, 34, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:01:14', 'Read'),
(10, 3, 35, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:01:19', 'Read'),
(11, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:03:03', 'Read'),
(12, 3, 35, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:05:54', 'Read'),
(13, 3, 34, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:05:55', 'Read'),
(14, 3, 35, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:05:58', 'Read'),
(15, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:06:00', 'Read'),
(16, 3, 35, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:08:02', 'Read'),
(17, 3, 34, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:08:04', 'Read'),
(18, 3, 35, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:08:07', 'Read'),
(19, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:08:15', 'Read'),
(20, 3, 34, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:11:39', 'Read'),
(21, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:11:41', 'Read'),
(22, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:12:12', 'Read'),
(23, 3, 35, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:13:50', 'Read'),
(24, 3, 35, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:13:53', 'Read'),
(25, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:15:52', 'Read'),
(26, 3, 35, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:16:23', 'Read'),
(27, 3, 34, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:16:24', 'Read'),
(28, 3, 35, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:16:27', 'Read'),
(29, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:16:29', 'Read'),
(30, 3, 35, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:17:11', 'Read'),
(31, 3, 34, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-06-24 13:17:12', 'Read'),
(32, 3, 35, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:17:15', 'Read'),
(33, 3, 34, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-06-24 13:17:16', 'Read'),
(34, 3, 49, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-13 22:55:36', 'Read'),
(35, 3, 49, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-07-13 22:55:45', 'Read'),
(36, 3, 48, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-13 23:43:31', 'Read'),
(37, 3, 66, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-19 02:00:16', 'Read'),
(38, 3, 74, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-19 02:41:18', 'Read'),
(39, 3, 74, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-19 02:42:26', 'Read'),
(40, 3, 74, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-19 02:44:50', 'Read'),
(41, 3, 70, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-19 02:44:57', 'Read'),
(42, 3, 89, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-23 11:41:08', 'Read'),
(43, 3, 89, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-23 11:41:08', 'Read'),
(44, 3, 89, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-23 12:09:46', 'Read'),
(45, 3, 89, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-23 12:09:46', 'Read'),
(46, 3, 89, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-23 12:19:14', 'Read'),
(47, 3, 89, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-23 12:19:14', 'Read'),
(48, 3, 89, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-23 12:22:13', 'Read'),
(49, 3, 89, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-23 12:22:13', 'Read'),
(50, 3, 87, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 15:44:34', 'Read'),
(51, 3, 87, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 15:44:34', 'Read'),
(52, 3, 85, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 15:47:14', 'Read'),
(53, 3, 85, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 15:47:14', 'Read'),
(54, 3, 86, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:09:00', 'Read'),
(55, 3, 86, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:09:00', 'Read'),
(56, 3, 91, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:12:45', 'Read'),
(57, 3, 91, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:12:45', 'Read'),
(58, 3, 92, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:26:19', 'Read'),
(59, 3, 92, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:26:19', 'Read'),
(60, 3, 93, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:30:19', 'Read'),
(61, 3, 93, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:30:19', 'Read'),
(62, 3, 85, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:30:21', 'Read'),
(63, 3, 85, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:30:21', 'Read'),
(64, 3, 94, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:31:38', 'Read'),
(65, 3, 94, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:31:38', 'Read'),
(66, 3, 95, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:33:05', 'Read'),
(67, 3, 95, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:33:05', 'Read'),
(68, 3, 96, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:36:58', 'Read'),
(69, 3, 96, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:36:58', 'Read'),
(70, 3, 97, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:41:02', 'Read'),
(71, 3, 97, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:41:02', 'Read'),
(72, 3, 97, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:42:33', 'Read'),
(73, 3, 97, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:42:33', 'Read'),
(74, 3, 98, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:44:30', 'Read'),
(75, 3, 98, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:44:30', 'Read'),
(76, 3, 99, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 16:55:18', ''),
(77, 3, 99, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 16:55:18', ''),
(78, 3, 99, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-25 17:04:10', ''),
(79, 3, 99, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-07-25 17:12:37', ''),
(80, 3, 100, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 17:15:32', ''),
(81, 3, 100, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 17:15:32', ''),
(82, 3, 100, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-25 17:15:47', ''),
(83, 3, 100, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-07-25 17:15:52', ''),
(84, 3, 101, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 22:09:55', ''),
(85, 3, 101, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 22:09:55', ''),
(86, 3, 101, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-07-25 22:11:24', ''),
(87, 3, 101, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-07-25 22:14:15', ''),
(88, 3, 103, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-07-25 23:29:08', ''),
(89, 3, 103, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-07-25 23:29:08', ''),
(90, 14, 102, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2021-09-09 12:25:46', 'Read'),
(91, 14, 102, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2021-09-09 12:25:46', 'Read'),
(92, 14, 103, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-09-09 12:26:21', 'Read'),
(93, 0, 0, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-09-09 12:26:30', 'Read'),
(94, 14, 102, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2021-09-09 12:26:33', 'Read'),
(95, 14, 103, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-09-09 12:26:44', 'Read'),
(96, 14, 102, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2021-09-09 12:26:48', 'Read'),
(97, 18, 107, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2022-09-17 21:38:30', 'Read'),
(98, 18, 107, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2022-09-17 21:38:30', 'Read'),
(99, 18, 107, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2022-09-17 21:38:44', 'Read'),
(100, 18, 107, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2022-09-17 21:39:45', 'Read'),
(101, 18, 108, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2023-02-04 11:29:32', 'Read'),
(102, 18, 108, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2023-02-04 11:29:32', 'Read'),
(103, 18, 108, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2023-02-04 11:29:42', 'Read'),
(104, 18, 108, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2023-02-04 11:30:11', 'Read'),
(105, 19, 109, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2023-02-04 13:45:27', 'Read'),
(106, 19, 109, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2023-02-04 13:45:27', 'Read'),
(107, 19, 109, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2023-02-04 13:45:42', 'Read'),
(108, 19, 109, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2023-02-04 13:45:49', 'Read'),
(109, 21, 111, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2024-11-18 18:08:25', 'Read'),
(110, 21, 111, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2024-11-18 18:08:25', 'Read'),
(111, 20, 110, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2024-11-18 18:08:36', ''),
(112, 20, 110, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2024-11-18 18:08:36', ''),
(113, 21, 111, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2024-11-18 18:19:15', 'Read'),
(114, 21, 111, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2024-11-18 18:21:29', 'Read'),
(115, 22, 112, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2024-11-22 10:13:12', 'Read'),
(116, 22, 112, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2024-11-22 10:13:12', 'Read'),
(117, 22, 112, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2024-11-22 10:13:32', 'Read'),
(118, 22, 112, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2024-11-22 10:13:45', 'Read'),
(119, 22, 113, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2024-11-22 10:45:20', 'Read'),
(120, 22, 113, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2024-11-22 10:45:20', 'Read'),
(121, 22, 113, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2024-11-22 10:46:57', 'Read'),
(122, 22, 113, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2024-11-22 10:49:48', 'Read'),
(123, 25, 114, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2024-11-25 06:47:24', 'Read'),
(124, 25, 114, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2024-11-25 06:47:24', 'Read'),
(125, 25, 114, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2024-11-25 06:47:39', 'Read'),
(126, 25, 114, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2024-11-25 06:47:46', 'Read'),
(127, 25, 115, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2024-11-26 12:09:19', ''),
(128, 25, 115, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2024-11-26 12:09:19', ''),
(129, 25, 115, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2024-11-26 12:09:47', ''),
(130, 25, 115, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2024-11-26 12:09:53', ''),
(131, 27, 116, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2024-11-27 09:55:55', 'Read'),
(132, 27, 116, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2024-11-27 09:55:55', 'Read'),
(133, 27, 116, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2024-11-27 09:56:44', 'Read'),
(134, 28, 117, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2025-06-16 09:42:34', 'Read'),
(135, 28, 117, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2025-06-16 09:42:34', 'Read'),
(136, 28, 117, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2025-06-16 09:42:43', 'Read'),
(137, 28, 117, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2025-06-16 09:42:48', 'Read'),
(138, 27, 116, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2025-06-16 09:42:50', ''),
(139, 28, 118, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2025-06-20 12:56:55', 'Read'),
(140, 28, 118, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2025-06-20 12:56:55', 'Read'),
(141, 28, 118, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2025-06-20 12:57:06', 'Read'),
(142, 28, 118, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2025-06-20 12:57:10', 'Read'),
(143, 28, 119, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2025-06-20 13:01:12', 'Read'),
(144, 28, 119, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2025-06-20 13:01:12', 'Read'),
(145, 28, 119, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2025-06-20 13:02:38', 'Read'),
(146, 28, 119, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2025-06-20 13:02:44', 'Read'),
(147, 28, 120, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2025-06-20 14:17:22', 'Read'),
(148, 28, 120, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2025-06-20 14:17:22', 'Read'),
(149, 28, 120, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2025-06-20 14:17:49', 'Read'),
(150, 28, 121, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2025-06-23 17:10:15', 'Read'),
(151, 28, 121, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2025-06-23 17:10:15', 'Read'),
(152, 28, 121, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2025-06-29 13:01:58', 'Read'),
(153, 28, 121, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2025-06-29 13:02:22', 'Read'),
(154, 28, 123, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2025-07-07 11:48:48', ''),
(155, 28, 123, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2025-07-07 11:48:48', ''),
(156, 28, 123, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2025-07-07 11:49:16', ''),
(157, 28, 123, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2025-07-07 11:49:31', ''),
(158, 28, 120, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2025-07-07 11:49:43', ''),
(159, 29, 124, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2025-07-11 17:48:21', ''),
(160, 29, 124, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2025-07-11 17:48:21', ''),
(161, 29, 124, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2025-07-11 17:48:42', ''),
(162, 29, 124, 'Pesanan Telah Sampai', 'Pesanan sudah sampai ke tempat tujuan', '2025-07-11 17:49:02', ''),
(163, 30, 125, 'Pembayaran Berhasil', 'Pembayaran pesanan sudah berhasil terverifikasi', '2025-07-11 19:30:53', ''),
(164, 30, 125, 'Pesanan Dikemas', 'Pesanan sedang dalam proses pengemasan oleh penjual', '2025-07-11 19:30:53', ''),
(165, 30, 125, 'Pesanan Dikirim', 'Pesanan sudah dikirim oleh penjual dan sedang dalam perjalanan', '2025-07-11 19:31:29', '');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `idrating` int(11) NOT NULL,
  `id_invoice_rat` int(11) NOT NULL,
  `star_rat` int(11) NOT NULL,
  `deskripsi_rat` text NOT NULL,
  `waktu_rat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`idrating`, `id_invoice_rat`, `star_rat`, `deskripsi_rat`, `waktu_rat`) VALUES
(7, 35, 5, 'Barang nya bagus sekali', '2021-06-18 14:51:53'),
(8, 35, 5, '', '2021-06-18 14:51:53'),
(9, 35, 5, '', '2021-06-18 14:51:53'),
(10, 35, 3, '', '2021-06-18 14:51:53'),
(11, 103, 5, 'kerennn dan berkualitas', ''),
(12, 102, 4, 'kerennn dan berkualitas', ''),
(13, 101, 5, 'kerennn dan berkualitas', ''),
(14, 100, 5, 'kerennn dan berkualitas', ''),
(15, 99, 2, 'kegedean', ''),
(16, 107, 1, 'jelek', ''),
(17, 108, 5, '', ''),
(18, 109, 5, '', ''),
(19, 112, 5, 'lucu', ''),
(20, 113, 5, 'Ga nyesal beli thrift di live tiktok sini bajunya cakep dan lucu lucu banget', ''),
(21, 114, 5, 'wahhh baju nya wangi bangettt', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting_apikey`
--

CREATE TABLE `setting_apikey` (
  `id_apikey` int(11) NOT NULL,
  `google_client_id` text NOT NULL,
  `google_client_secret` text NOT NULL,
  `midtrans_client_key` text NOT NULL,
  `midtrans_server_key` text NOT NULL,
  `rajaongkir_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_apikey`
--

INSERT INTO `setting_apikey` (`id_apikey`, `google_client_id`, `google_client_secret`, `midtrans_client_key`, `midtrans_server_key`, `rajaongkir_key`) VALUES
(1, '667755539556-t91a5rigvs8sjn8ov5ob449uofahvjdf.apps.googleusercontent.com', 'egHGBI5BcztK-VbZNeCEHHTW', 'SB-Mid-client-rwRR5kz4E-kNnJs2', 'SB-Mid-server-iU7JbDaoVDjBJu4N-LLH0xW8', 'ba41ff0062c6c1fd933599257260431f');

-- --------------------------------------------------------

--
-- Table structure for table `setting_email`
--

CREATE TABLE `setting_email` (
  `id` int(11) NOT NULL,
  `email_notif` text NOT NULL,
  `host_smtp` varchar(100) NOT NULL,
  `port_smtp` int(11) NOT NULL,
  `username_smtp` varchar(100) NOT NULL,
  `password_smtp` varchar(100) NOT NULL,
  `setfrom_smtp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_email`
--

INSERT INTO `setting_email` (`id`, `email_notif`, `host_smtp`, `port_smtp`, `username_smtp`, `password_smtp`, `setfrom_smtp`) VALUES
(1, 'support@401xd.com', 'mail.401xd.com', 465, 'support@401xd.com', 'PASSWORD EMAIL ANDA', 'SENJA STORE');

-- --------------------------------------------------------

--
-- Table structure for table `setting_footer`
--

CREATE TABLE `setting_footer` (
  `id_fo` int(11) NOT NULL,
  `name_social` text NOT NULL,
  `icon_social` text NOT NULL,
  `link_social` text NOT NULL,
  `status_social` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_footer`
--

INSERT INTO `setting_footer` (`id_fo`, `name_social`, `icon_social`, `link_social`, `status_social`) VALUES
(1, 'Facebook', '<i class=\"ri-facebook-box-fill\"></i>', '', ''),
(2, 'Instagram', '<i class=\"ri-instagram-fill\"></i>', '', ''),
(3, 'Whatsapp', '<i class=\"ri-whatsapp-fill\"></i>', 'https://wa.me/', ''),
(4, 'Twitter', '<i class=\"ri-twitter-fill\"></i>', '', ''),
(5, 'YouTube', '<i class=\"ri-youtube-fill\"></i>', '', ''),
(6, 'LinkedIn', '<i class=\"ri-linkedin-fill\"></i>', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting_header`
--

CREATE TABLE `setting_header` (
  `id_hs` int(11) NOT NULL,
  `logo` text NOT NULL,
  `title_name` text NOT NULL,
  `placeholder_search` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_header`
--

INSERT INTO `setting_header` (`id_hs`, `logo`, `title_name`, `placeholder_search`) VALUES
(1, 'Logo.png', 'Thrift Store', 'Pencarian..');

-- --------------------------------------------------------

--
-- Table structure for table `setting_lokasi`
--

CREATE TABLE `setting_lokasi` (
  `id` int(11) NOT NULL,
  `provinsi` text NOT NULL,
  `kota` text NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_lokasi`
--

INSERT INTO `setting_lokasi` (`id`, `provinsi`, `kota`, `provinsi_id`, `kota_id`) VALUES
(1, 'DKI Jakarta', 'Jakarta Selatan', 6, 153);

-- --------------------------------------------------------

--
-- Table structure for table `setting_pembayaran`
--

CREATE TABLE `setting_pembayaran` (
  `id` int(11) NOT NULL,
  `tipe` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_pembayaran`
--

INSERT INTO `setting_pembayaran` (`id`, `tipe`, `status`) VALUES
(1, 'Midtrans', ''),
(2, 'Manual', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_promo`
--
ALTER TABLE `banner_promo`
  ADD PRIMARY KEY (`idbanner`);

--
-- Indexes for table `flashsale`
--
ALTER TABLE `flashsale`
  ADD PRIMARY KEY (`id_fs`);

--
-- Indexes for table `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`idinvoice`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_user`
--
ALTER TABLE `lokasi_user`
  ADD PRIMARY KEY (`idlokasi`);

--
-- Indexes for table `nomor_rekening`
--
ALTER TABLE `nomor_rekening`
  ADD PRIMARY KEY (`idnorek`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`idrating`);

--
-- Indexes for table `setting_apikey`
--
ALTER TABLE `setting_apikey`
  ADD PRIMARY KEY (`id_apikey`);

--
-- Indexes for table `setting_email`
--
ALTER TABLE `setting_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_footer`
--
ALTER TABLE `setting_footer`
  ADD PRIMARY KEY (`id_fo`);

--
-- Indexes for table `setting_header`
--
ALTER TABLE `setting_header`
  ADD PRIMARY KEY (`id_hs`);

--
-- Indexes for table `setting_lokasi`
--
ALTER TABLE `setting_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_pembayaran`
--
ALTER TABLE `setting_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `banner_promo`
--
ALTER TABLE `banner_promo`
  MODIFY `idbanner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `flashsale`
--
ALTER TABLE `flashsale`
  MODIFY `id_fs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iklan`
--
ALTER TABLE `iklan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `idinvoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `lokasi_user`
--
ALTER TABLE `lokasi_user`
  MODIFY `idlokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nomor_rekening`
--
ALTER TABLE `nomor_rekening`
  MODIFY `idnorek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `idrating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `setting_apikey`
--
ALTER TABLE `setting_apikey`
  MODIFY `id_apikey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_email`
--
ALTER TABLE `setting_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_footer`
--
ALTER TABLE `setting_footer`
  MODIFY `id_fo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting_header`
--
ALTER TABLE `setting_header`
  MODIFY `id_hs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_lokasi`
--
ALTER TABLE `setting_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_pembayaran`
--
ALTER TABLE `setting_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
