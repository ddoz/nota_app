-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 12:52 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nota_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `retainer_fee` int(100) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `email`, `retainer_fee`, `updated_at`, `created_at`) VALUES
(1, 'Nels Hettinger', 'golden.ankunding@sauer.com', 81055670, NULL, '2021-03-08 09:55:18'),
(2, 'June Strosin', 'htorphy@spencer.com', 66421389, NULL, '2021-03-08 09:55:18'),
(3, 'Antonia Greenholt', 'deborah50@gmail.com', 33903218, NULL, '2021-03-08 09:55:18'),
(4, 'Maybelle Padberg', 'lindsay03@welch.org', 37877081, NULL, '2021-03-08 09:55:18'),
(5, 'Prof. Edmund Farrell II', 'florida.ebert@gmail.com', 24915615, NULL, '2021-03-08 09:55:18'),
(6, 'Paris Buckridge', 'lily.white@hotmail.com', 35156674, NULL, '2021-03-08 09:55:18'),
(7, 'Dr. Theodore Parker', 'zieme.ursula@gmail.com', 5944203, NULL, '2021-03-08 09:55:18'),
(8, 'Miss Samanta Runte', 'tatyana.zboncak@pagac.com', 68553329, NULL, '2021-03-08 09:55:18'),
(9, 'Ms. Jada Pollich Jr.', 'wiza.jessy@yundt.com', 78766807, NULL, '2021-03-08 09:55:18'),
(10, 'Forest Kihn', 'leopoldo43@beatty.org', 69086685, NULL, '2021-03-08 09:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-03-08-022446', 'App\\Database\\Migrations\\AddClient', 'default', 'App', 1615170897, 1),
(2, '2021-03-08-022453', 'App\\Database\\Migrations\\AddUser', 'default', 'App', 1615170897, 1),
(3, '2021-03-08-031928', 'App\\Database\\Migrations\\AddNota', 'default', 'App', 1615173922, 2),
(4, '2021-03-08-040911', 'App\\Database\\Migrations\\AddSettingNota', 'default', 'App', 1615177198, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id` int(5) UNSIGNED NOT NULL,
  `judul` varchar(100) NOT NULL,
  `terima_dari` varchar(100) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id`, `judul`, `terima_dari`, `nominal`, `keterangan`, `tanggal`, `user_id`, `updated_at`, `created_at`) VALUES
(5, 'Pembayaran Itu', 'Anik', '1500000', NULL, '2021-03-08 09:20:17', 1, NULL, '2021-03-08 11:06:46'),
(6, 'Pembayaran Itu 2', 'Anik', '1500000', NULL, '2021-03-08 09:20:17', 1, NULL, '2021-03-08 11:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `setting_nota`
--

CREATE TABLE `setting_nota` (
  `id` int(5) UNSIGNED NOT NULL,
  `logo` text NOT NULL,
  `watermark` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting_nota`
--

INSERT INTO `setting_nota` (`id`, `logo`, `watermark`, `user_id`, `updated_at`, `created_at`) VALUES
(2, 'LOGO_1.jpg', 'WATERMARK_1.jpg', 1, NULL, '2021-03-08 15:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `updated_at`, `created_at`) VALUES
(1, 'Adam Japal', 'adam.japal@gmail.com', '$2y$10$8A/Fij3n5Z9Co1WyaEe12eKIK.TOsVl8RqI56pNdh.Qxnf.5fgLaK', NULL, '2021-03-08 10:09:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `retainer_fee` (`retainer_fee`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_nota`
--
ALTER TABLE `setting_nota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting_nota`
--
ALTER TABLE `setting_nota`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
