-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 05:59 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengadaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `user_id`, `kode_barang`, `nama_barang`, `harga`, `nama_bank`, `nama_rekening`, `no_rekening`, `created_at`, `updated_at`) VALUES
(1, 2, 'LAB-001', 'Mikroskop Siswa', 2500000.00, 'BCA', 'PT Vendor A', '1234567890', '2025-10-30 01:24:59', '2025-11-02 07:18:47'),
(2, 2, 'LAB-002', 'Bunsen Burner', 650000.00, '', 'PT Vendor A', '1234567890', '2025-10-30 01:24:59', '2025-10-30 01:24:59'),
(3, 2, 'LAB-003', 'Pipet Set', 300000.00, '', 'PT Vendor A', '1234567890', '2025-10-30 01:24:59', '2025-10-30 01:24:59'),
(4, 2, 'BRG-078', 'Buku Tulis SIDU', 5000.00, '', 'CV Sejahtera Gagah Perkasa', '7295896353', '2025-10-30 20:31:57', '2025-10-30 20:31:57'),
(7, 2, 'KEC - 156', 'Pler Kuda', 67000.00, '', 'PT Indog Sejahtera', '723172371237', '2025-10-30 21:23:42', '2025-10-30 21:23:42'),
(8, 6, 'ATK - 002', 'Alat Tulis Anu', 70000.00, '', 'Banu - BCA', '123219312312', '2025-10-31 00:05:22', '2025-10-31 00:05:22'),
(9, 2, 'LAB-001231', 'Mikroskop Siswa Siswi', 10000.00, 'Mandiri', 'Asep', '7298231983', '2025-11-02 07:20:43', '2025-11-02 07:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('e-procurement-cache-1c7c0465bbfb208b8475275d35a24562', 'i:1;', 1765731370),
('e-procurement-cache-1c7c0465bbfb208b8475275d35a24562:timer', 'i:1765731370;', 1765731370),
('e-procurement-cache-84e800ff75ba4c7b6804416d2d8b02ff', 'i:1;', 1765731449),
('e-procurement-cache-84e800ff75ba4c7b6804416d2d8b02ff:timer', 'i:1765731449;', 1765731449),
('e-procurement-cache-bfd519124c0387fcf0a1df2d131a44bb', 'i:1;', 1765732520),
('e-procurement-cache-bfd519124c0387fcf0a1df2d131a44bb:timer', 'i:1765732520;', 1765732520),
('laravel-cache-1c7c0465bbfb208b8475275d35a24562', 'i:1;', 1762349033),
('laravel-cache-1c7c0465bbfb208b8475275d35a24562:timer', 'i:1762349033;', 1762349033),
('laravel-cache-298652bffbded3fbb069f439c9124197', 'i:1;', 1761895988),
('laravel-cache-298652bffbded3fbb069f439c9124197:timer', 'i:1761895988;', 1761895988),
('laravel-cache-7bda24ff6f94fe99247e87252090e7b6', 'i:1;', 1762349263),
('laravel-cache-7bda24ff6f94fe99247e87252090e7b6:timer', 'i:1762349263;', 1762349263),
('laravel-cache-84e800ff75ba4c7b6804416d2d8b02ff', 'i:1;', 1762349471),
('laravel-cache-84e800ff75ba4c7b6804416d2d8b02ff:timer', 'i:1762349471;', 1762349471),
('laravel-cache-bfd519124c0387fcf0a1df2d131a44bb', 'i:1;', 1762349311),
('laravel-cache-bfd519124c0387fcf0a1df2d131a44bb:timer', 'i:1762349311;', 1762349311),
('laravel-cache-vendor2@gmail.com|127.0.0.1', 'i:1;', 1761895988),
('laravel-cache-vendor2@gmail.com|127.0.0.1:timer', 'i:1761895988;', 1761895988);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaans`
--

CREATE TABLE `detail_pengadaans` (
  `id` bigint UNSIGNED NOT NULL,
  `pengadaan_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `nama_vendor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pengadaans`
--

INSERT INTO `detail_pengadaans` (`id`, `pengadaan_id`, `barang_id`, `qty`, `harga_satuan`, `subtotal`, `nama_vendor`, `nama_rekening`, `no_rekening`, `created_at`, `updated_at`) VALUES
(16, 16, 2, 1, 650000.00, 650000.00, 'Vendor A', 'PT Vendor A', '1234567890', '2025-12-14 10:41:40', '2025-12-14 10:41:40');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_29_015145_add_two_factor_columns_to_users_table', 1),
(5, '2025_10_29_015224_create_personal_access_tokens_table', 1),
(6, '2025_10_29_144604_add_role_to_users_table', 1),
(7, '2025_10_29_145719_create_barangs_table', 2),
(8, '2025_10_30_082119_create_pengadaans_table', 2),
(9, '2025_10_30_082138_create_detail_pengadaans_table', 2),
(10, '2025_10_30_082156_create_pembayarans_table', 2),
(11, '2025_10_30_093553_add_is_approved_to_pembayarans_table', 3),
(12, '2025_10_30_095052_add_invoice_path_to_pembayarans_table', 4),
(13, '2025_10_31_041032_update_status_enum_in_pembayarans_table', 5),
(14, '2025_10_31_041200_update_status_enum_in_pengadaans_table', 6),
(15, '2025_11_02_141323_add_nama_bank_to_barang_table', 7),
(16, '2025_12_14_161022_add_approval_columns_to_pengadaans_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `pengadaan_id` bigint UNSIGNED NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','lunas','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `is_approved` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `invoice_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `pengadaan_id`, `nominal`, `bukti`, `status`, `is_approved`, `invoice_path`, `created_at`, `updated_at`) VALUES
(14, 16, 650000.00, 'bukti-transfer/0nPqCvCvd93l1yVSK8dRirwfK6aUMQ3D8LWyefin.png', 'lunas', 'pending', 'invoices/invoice_16.pdf', '2025-12-14 10:48:24', '2025-12-14 10:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaans`
--

CREATE TABLE `pengadaans` (
  `id` bigint UNSIGNED NOT NULL,
  `staff_id` bigint UNSIGNED NOT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `total_harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('menunggu_approval','menunggu_pembayaran','dibayar','dikirim','selesai','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengadaans`
--

INSERT INTO `pengadaans` (`id`, `staff_id`, `approved_by`, `approved_at`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(16, 1, 3, '2025-12-14 10:47:54', 650000.00, 'selesai', '2025-12-14 10:41:40', '2025-12-14 10:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('33JstUybFFtZE0OuMbdHPPJ8uk0zD3RVCnR7GqYZ', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTUcyTDdUMEJ4bWZzek1GTEh5UlQwNjE1cnNjaUh4YWNEMG1ta2JLVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZXBzZWsvcGVuZ2FkYWFuIjtzOjU6InJvdXRlIjtzOjIyOiJrZXBzZWsucGVuZ2FkYWFuLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1765735034),
('e6Q11Ye4oGlMI3IBKDqjdRwnIRORwnDElWIQPwfA', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUWVwVzFLdEpIYW91MWFwZExLSHhWM3Y3TFAxczBFU0FPeG9Zcm1wMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1iYXlhcmFuIjtzOjU6InJvdXRlIjtzOjE2OiJwZW1iYXlhcmFuLmluZGV4Ijt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1765735047),
('mLfiTKiNuJlUOpL0DnZ6PrPQjhX2xF56Hwa7VtPM', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic2VxOGNzSDd2a2FSRXhpbnFsazZkNkF5ZzZFY2EyWWhtQ2VkcTNFWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92ZW5kb3IvcGVtYmF5YXJhbiI7czo1OiJyb3V0ZSI7czoyMzoidmVuZG9yLnBlbWJheWFyYW4uaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1765734998);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('staff','vendor','kepala_sekolah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin Staff', 'staff@edu.com', NULL, '$2y$12$1nVUlfWP0JqIJx9OKvmJPeCZSvgyV8kpRos3/7T958A0hZvgi.Nrm', 'staff', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 01:24:59', '2025-10-30 01:24:59'),
(2, 'Vendor A', 'vendor@edu.com', NULL, '$2y$12$ibV/k/D/FUTG.U2jOCekqeC4Kx8ckFoo17jrxTryQ11kb8Mpt7uGy', 'vendor', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 01:24:59', '2025-10-30 01:24:59'),
(3, 'Kepala Sekolah', 'kepsek@edu.com', NULL, '$2y$12$rueG7WMQpB212USvywq/l.O7Vausrh86t0d.FfI5xqAy9M0JA5/vi', 'kepala_sekolah', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 01:24:59', '2025-10-30 01:24:59'),
(6, 'Vendor 2', 'vendor2@edu.com', NULL, '$2y$12$ci59MpGLrgW.z9vYD2Ff4.khO8wanJhzW53V4NYJCz9lI4m2UV28u', 'vendor', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-31 00:02:16', '2025-10-31 00:02:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_kode_barang_unique` (`kode_barang`),
  ADD KEY `barangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_pengadaans`
--
ALTER TABLE `detail_pengadaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pengadaans_pengadaan_id_foreign` (`pengadaan_id`),
  ADD KEY `detail_pengadaans_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_pengadaan_id_foreign` (`pengadaan_id`);

--
-- Indexes for table `pengadaans`
--
ALTER TABLE `pengadaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengadaans_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_pengadaans`
--
ALTER TABLE `detail_pengadaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengadaans`
--
ALTER TABLE `pengadaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_pengadaans`
--
ALTER TABLE `detail_pengadaans`
  ADD CONSTRAINT `detail_pengadaans_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pengadaans_pengadaan_id_foreign` FOREIGN KEY (`pengadaan_id`) REFERENCES `pengadaans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_pengadaan_id_foreign` FOREIGN KEY (`pengadaan_id`) REFERENCES `pengadaans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengadaans`
--
ALTER TABLE `pengadaans`
  ADD CONSTRAINT `pengadaans_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
