-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2025 at 04:04 AM
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
-- Database: `kabis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `konten`, `gambar`, `created_at`) VALUES
(1, 'KABIS with Automechanika Shanghai 2024', 'Recently, the globally anticipated Automechanika Shanghai 2024 kicked off on December 2, 2024 at Shanghai National Convention and Exhibition Center. As a leading independent aftermarket brand, KABIS took part in the exhibition with its latest products and techniques.\r\n\r\nDuring the exhibition, there are lots of exhibitors and related technical personnel visiting and consulting at the booth. Also, we had in-depth discussions with many industry partners which yielded fruitful results.\r\n\r\nIn the future, we will continue to uphold the concept of \"Cooperation & Co-creation\", continuously develop new products and technologies, and provide customers with higher quality products and services.\r\n\r\nLets look forward to meeting you again next year!', '1759202663_artikel1.jpg', '2025-09-30 03:24:23'),
(2, 'KABIS with Automechanika Shanghai 2023', 'As an independent aftermarket brand, KABIS had participated in the 18th edition of Automechanika Shanghai, which took place from 29th November to 2nd December 2023.', '1759202888_artikel2.jpg', '2025-09-30 03:28:08'),
(3, '2023 Aftermarket automotive parts Asia Pacific Workshop in Thailand', 'KABIS had participated in TecAlliance Aftermarket automotive parts Asia Pacific Customer Day in Pattaya, Thailand.', '1759202963_artikel3.jpg', '2025-09-30 03:29:23'),
(4, '2023 Aftermarket automotive parts Asia Pacific Workshop in Malaysia', 'In August 2023, KABIS, as an independent brand of DJP, participated in TecAlliance Aftermarket automotive parts Asia Pacific Customer Day in Kuala Lumpur, Malaysia.', '1759203109_artikel4.jpg', '2025-09-30 03:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `gambar`, `created_at`) VALUES
(1, 'Master Cylinder, clutch', '', 'Master Cylinder, clutch.png', '2025-09-27 14:15:16'),
(2, 'Slave Cylinder, clutch', '', 'Slave Cylinder, clutch.png', '2025-09-27 14:19:41'),
(3, 'Brake Booster', '', 'Brake Booster.png', '2025-09-27 14:20:08'),
(4, 'Brake Caliper', '', 'Brake Caliper.png', '2025-09-27 14:20:55'),
(5, 'Brake Force Regulator', '', 'Brake Force Regulator.png', '2025-09-27 14:21:21'),
(6, 'Brake Master Cylinder', '', 'Brake Master Cylinder.png', '2025-09-27 14:21:41'),
(7, 'Wheel Brake Cylinder', '', 'Wheel Brake Cylinder.png', '2025-09-27 14:22:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
