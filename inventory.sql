-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2018 at 11:56 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persediaan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id`, `nama`, `persediaan`, `created_at`, `updated_at`) VALUES
(1, 'Kain Drill', 85, '2018-07-15 23:00:50', '2018-07-15 23:00:50'),
(2, 'Katun polos warna dan bermotif', 93, '2018-07-15 23:01:30', '2018-07-15 23:01:30'),
(3, 'Brukat motif', 107, '2018-07-15 23:01:45', '2018-07-15 23:01:45'),
(4, 'Kain shantung atau santung', 130, '2018-07-15 23:02:04', '2018-07-15 23:02:04'),
(5, 'Sifon', 150, '2018-07-15 23:02:16', '2018-07-15 23:02:16'),
(6, 'Kain jeruk lebar 100cm', 168, '2018-07-15 23:04:53', '2018-07-15 23:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produksi` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `keperluan` int(11) NOT NULL,
  `hasil` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id`, `id_order`, `id_produksi`, `id_bahan`, `keperluan`, `hasil`, `created_at`, `updated_at`) VALUES
(2, 7, 1, 6, 3, 6, '2018-07-16 09:21:25', '2018-07-16 09:21:25'),
(3, 9, 1, 6, 100, 60, '2018-07-16 09:24:51', '2018-07-16 09:24:51'),
(4, 10, 1, 6, 100, 60, '2018-07-16 09:27:19', '2018-07-16 09:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `detail_prod_bahan`
--

CREATE TABLE `detail_prod_bahan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_detail_prod_bahan` int(10) UNSIGNED NOT NULL,
  `id_bahan` int(10) UNSIGNED NOT NULL,
  `keperluan` int(11) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_prod_bahan`
--

INSERT INTO `detail_prod_bahan` (`id`, `id_detail_prod_bahan`, `id_bahan`, `keperluan`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 10, 'Meter', '2018-07-15 23:07:22', '2018-07-15 23:07:22'),
(2, 1, 3, 3, 'Yard', '2018-07-15 23:07:22', '2018-07-15 23:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `kode`, `nama`, `kontak`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'WRH1', 'Gudang Kain Satu', '0888999777', 'Bandung, Jl.Doktor Djunjunan No.145', '2018-07-15 23:18:39', '2018-07-15 23:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(84, '2014_10_12_000000_create_users_table', 1),
(85, '2014_10_12_100000_create_password_resets_table', 1),
(86, '2018_07_09_021402_pemotong_pola', 1),
(87, '2018_07_09_023359_gudang', 1),
(88, '2018_07_09_074813_produksi', 1),
(89, '2018_07_09_075144_detail_produksi', 1),
(90, '2018_07_12_005750_bahan', 1),
(91, '2018_07_12_010737_fk_detail', 1),
(92, '2018_07_13_014733_delete_detail', 2),
(93, '2018_07_13_023320_warna', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Bolero', '2018-07-15 23:02:28', '2018-07-15 23:02:28'),
(2, 'Blouse', '2018-07-15 23:02:41', '2018-07-15 23:02:41'),
(3, 'Gaun', '2018-07-15 23:02:46', '2018-07-15 23:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `nomor_order` varchar(255) NOT NULL,
  `pemberi_order` varchar(255) NOT NULL,
  `id_pemotong_pola` int(11) NOT NULL,
  `id_gudang_penerima` int(11) NOT NULL,
  `tanggal_order` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `biaya_produksi` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `nomor_order`, `pemberi_order`, `id_pemotong_pola`, `id_gudang_penerima`, `tanggal_order`, `tanggal_selesai`, `biaya_produksi`, `created_at`, `updated_at`) VALUES
(1, '201807163AQDNB', 'Rendy Reynaldy A', 2, 1, '2018-07-25', '2018-07-11', 900000, '2018-07-16 09:14:05', '2018-07-16 09:14:05'),
(2, '201807163AQDNB', 'Rendy Reynaldy A', 2, 1, '2018-07-25', '2018-07-11', 900000, '2018-07-16 09:14:20', '2018-07-16 09:14:20'),
(3, '201807163AQDNB', 'Rendy Reynaldy A', 2, 1, '2018-07-25', '2018-07-11', 900000, '2018-07-16 09:15:59', '2018-07-16 09:15:59'),
(4, '201807163AQDNB', 'Rendy Reynaldy A', 2, 1, '2018-07-25', '2018-07-11', 900000, '2018-07-16 09:17:51', '2018-07-16 09:17:51'),
(5, '201807163AQDNB', 'Rendy Reynaldy A', 2, 1, '2018-07-25', '2018-07-11', 900000, '2018-07-16 09:20:39', '2018-07-16 09:20:39'),
(6, '201807163AQDNB', 'Rendy Reynaldy A', 2, 1, '2018-07-25', '2018-07-11', 900000, '2018-07-16 09:20:59', '2018-07-16 09:20:59'),
(7, '201807163AQDNB', 'Rendy Reynaldy A', 2, 1, '2018-07-25', '2018-07-11', 900000, '2018-07-16 09:21:25', '2018-07-16 09:21:25'),
(8, '201807169BSRLX', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 5000000, '2018-07-16 09:24:01', '2018-07-16 09:24:01'),
(9, '20180716XOSI9K', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 5000000, '2018-07-16 09:24:51', '2018-07-16 09:24:51'),
(10, '20180716XOSI9K', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 5000000, '2018-07-16 09:27:19', '2018-07-16 09:27:19'),
(11, '20180716C2TNFG', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 500000, '2018-07-16 09:36:58', '2018-07-16 09:36:58'),
(12, '20180716C2TNFG', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 500000, '2018-07-16 09:37:24', '2018-07-16 09:37:24'),
(13, '20180716C2TNFG', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 500000, '2018-07-16 09:37:50', '2018-07-16 09:37:50'),
(14, '20180716QA8EVC', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 500000, '2018-07-16 09:54:16', '2018-07-16 09:54:16'),
(15, '20180716QA8EVC', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 500000, '2018-07-16 09:54:20', '2018-07-16 09:54:20'),
(16, '20180716QA8EVC', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 500000, '2018-07-16 09:54:39', '2018-07-16 09:54:39'),
(17, '20180716QA8EVC', 'Rendy Reynaldy A', 2, 1, '2018-07-16', '2018-07-17', 500000, '2018-07-16 09:54:43', '2018-07-16 09:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemotong_pola`
--

CREATE TABLE `pemotong_pola` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemotong_pola`
--

INSERT INTO `pemotong_pola` (`id`, `nama`, `kontak`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Rendy Reynaldy Anggradwiguna', '08112008423', 'Padalarang', '2018-07-15 23:04:00', '2018-07-15 23:04:00'),
(2, 'Rima Kospiah Handayani', '085721145572', 'Cimahi Tengah', '2018-07-15 23:04:17', '2018-07-15 23:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `pola`
--

CREATE TABLE `pola` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pola`
--

INSERT INTO `pola` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Formil and Energic', '2018-07-15 23:03:03', '2018-07-15 23:03:03'),
(2, 'Fresh and Energic', '2018-07-15 23:03:11', '2018-07-15 23:03:11'),
(3, 'Energic', '2018-07-15 23:03:16', '2018-07-15 23:03:16'),
(4, 'Power', '2018-07-15 23:03:21', '2018-07-15 23:03:21'),
(5, 'Passion', '2018-07-15 23:03:26', '2018-07-15 23:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pola` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` int(11) NOT NULL,
  `satuan_hasil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id`, `nama_produk`, `kode`, `model`, `pola`, `warna`, `ukuran`, `hasil`, `satuan_hasil`, `created_at`, `updated_at`) VALUES
(1, 'Gaun Keren', '2016080901', 'Gaun', 'Power', 'Merah', 'Medium', 60, 'Potong', '2018-07-15 23:07:22', '2018-07-15 23:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rendy Reynaldy A', 'rendyreynaldy@gmail.com', '$2y$10$hrlKIJLL.4iofFuylrx3zuDdr/I.mESMegPaUn3RLIABGsDmGht0C', 'EAYv5vStBXdbgE4hKiYPiFqOPkx5cC9c70gRyzROVbt6JYStYnklPDn546u2', '2018-07-11 18:20:44', '2018-07-11 18:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `id` int(11) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`id`, `warna`, `created_at`, `updated_at`) VALUES
(1, 'Merah', '2018-07-16 06:03:34', '2018-07-16 06:03:34'),
(2, 'Jingga', '2018-07-16 06:03:40', '2018-07-16 06:03:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_prod_bahan`
--
ALTER TABLE `detail_prod_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_prod_bahan_id_bahan_foreign` (`id_bahan`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemotong_pola`
--
ALTER TABLE `pemotong_pola`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pola`
--
ALTER TABLE `pola`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_prod_bahan`
--
ALTER TABLE `detail_prod_bahan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pemotong_pola`
--
ALTER TABLE `pemotong_pola`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pola`
--
ALTER TABLE `pola`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
