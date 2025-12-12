-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 09:51 AM
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
-- Database: `universitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `id` int(8) NOT NULL,
  `nim` varchar(14) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tempatLahir` varchar(25) NOT NULL,
  `tanggaLahir` date NOT NULL,
  `jmlSaudara` int(2) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `jenisKelamin` varchar(2) NOT NULL,
  `statusKeluarga` varchar(1) NOT NULL,
  `hobi` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`id`, `nim`, `nama`, `tempatLahir`, `tanggaLahir`, `jmlSaudara`, `alamat`, `kota`, `jenisKelamin`, `statusKeluarga`, `hobi`, `email`, `pass`) VALUES
(0, 'A12.2002.06786', 'Fikriinabil', 'Semarang', '0000-00-00', 1, 'Australia', 'Semarang', 'L', 'B', 'Musik', 'nabil@gmial.com', '$2y$10$Wj6IxWsLOXu4AgNPvqxuIO9Nga1fjf1Wo6A1rziKXqCKMnAB9T3zm'),
(0, 'A12.2002.06782', 'wewew', 'Semarang', '0000-00-00', 2, 'Sydney', 'Semarang', 'L', 'K', 'Membaca', 'wewew@gmial.com', '$2y$10$Zs4G.Mo/01Dkgdh05PqyYOUqPFRI0Sfj3ma.5hV.Ogo22trKiHsgS'),
(0, 'A12.2002.06782', 'wewew', 'Semarang', '0000-00-00', 2, 'Sydney', 'Semarang', 'L', 'K', 'Membaca', 'wewew@gmial.com', '$2y$10$ctr9MoaxD8/ig3/ITaXmeuUBlH.AA/R.A5ljx2nDAoKQ8SQdW4sQe');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
