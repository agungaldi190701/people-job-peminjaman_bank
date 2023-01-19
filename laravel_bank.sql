-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2023 at 03:37 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_17_141218_create_nasabahs_table', 1),
(6, '2023_01_18_060928_create_peminjamen_table', 1),
(7, '2023_01_18_061546_create_syarat_pinjamen_table', 1),
(8, '2023_01_18_061901_create_setorans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nasabahs`
--

CREATE TABLE `nasabahs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` bigint UNSIGNED DEFAULT NULL,
  `jk` enum('Laki-Laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED DEFAULT NULL,
  `nasabahs_id` bigint UNSIGNED DEFAULT NULL,
  `jumlah_pinjaman` int NOT NULL,
  `jumlah_angsuran` int NOT NULL,
  `lama_pinjam` int NOT NULL,
  `bunga` int NOT NULL,
  `total_pinjaman` int NOT NULL,
  `tujuan_pinjaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `users_id`, `nasabahs_id`, `jumlah_pinjaman`, `jumlah_angsuran`, `lama_pinjam`, `bunga`, `total_pinjaman`, `tujuan_pinjaman`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 90000000, 3750000, 24, 13, 101700000, 'pinjol', 'belum lunas', '2023-01-19 08:19:37', '2023-01-19 08:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setorans`
--

CREATE TABLE `setorans` (
  `id` bigint UNSIGNED NOT NULL,
  `nasabahs_id` bigint UNSIGNED DEFAULT NULL,
  `users_id` bigint UNSIGNED DEFAULT NULL,
  `peminjaman_id` bigint UNSIGNED DEFAULT NULL,
  `jumlah_setoran` int NOT NULL,
  `tanggal_setoran` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setorans`
--

INSERT INTO `setorans` (`id`, `nasabahs_id`, `users_id`, `peminjaman_id`, `jumlah_setoran`, `tanggal_setoran`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 1, 900000, '2023-01-19', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `syarat_pinjaman`
--

CREATE TABLE `syarat_pinjaman` (
  `id` bigint UNSIGNED NOT NULL,
  `nasabahs_id` bigint UNSIGNED DEFAULT NULL,
  `surat_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `syarat_pinjaman`
--

INSERT INTO `syarat_pinjaman` (`id`, `nasabahs_id`, `surat_keterangan`, `identitas`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, NULL, '1674142565_rsz_120230105220226_page-0001.jpg', '1674142565_20230105220226_page-0001.jpg', 'kebutuhan', '2023-01-19 08:19:15', '2023-01-19 08:36:05'),
(2, NULL, '1674142453_rsz_120230105220226_page-0001.jpg', '1674142453_20230105220226_page-0001.jpg', 'xdsfhgzdf', '2023-01-19 08:34:13', '2023-01-19 08:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','nasabah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$5yke0doRU3tt2XTgXagBBOMg0w2fVtTY8gUVh6nsjLk0A/hQ5wQD.', 'admin', NULL, '2023-01-19 08:04:39', '2023-01-19 08:04:39'),
(2, 'admin2', 'admin2', '$2y$10$5kMX4wL9fasbIpEy7X2h4u6vLkcIyrwAXGSzXJR8U1/k.k5gLH62i', 'admin', NULL, '2023-01-19 08:08:49', '2023-01-19 08:08:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nasabahs`
--
ALTER TABLE `nasabahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nasabahs_users_id_foreign` (`users_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_users_id_foreign` (`users_id`),
  ADD KEY `peminjaman_nasabahs_id_foreign` (`nasabahs_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `setorans`
--
ALTER TABLE `setorans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setorans_nasabahs_id_foreign` (`nasabahs_id`),
  ADD KEY `setorans_users_id_foreign` (`users_id`),
  ADD KEY `setorans_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `syarat_pinjaman`
--
ALTER TABLE `syarat_pinjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `syarat_pinjaman_nasabahs_id_foreign` (`nasabahs_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nasabahs`
--
ALTER TABLE `nasabahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setorans`
--
ALTER TABLE `setorans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `syarat_pinjaman`
--
ALTER TABLE `syarat_pinjaman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nasabahs`
--
ALTER TABLE `nasabahs`
  ADD CONSTRAINT `nasabahs_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_nasabahs_id_foreign` FOREIGN KEY (`nasabahs_id`) REFERENCES `nasabahs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjaman_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `setorans`
--
ALTER TABLE `setorans`
  ADD CONSTRAINT `setorans_nasabahs_id_foreign` FOREIGN KEY (`nasabahs_id`) REFERENCES `nasabahs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `setorans_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `setorans_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `syarat_pinjaman`
--
ALTER TABLE `syarat_pinjaman`
  ADD CONSTRAINT `syarat_pinjaman_nasabahs_id_foreign` FOREIGN KEY (`nasabahs_id`) REFERENCES `nasabahs` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
