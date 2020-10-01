-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2019 at 01:42 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prak_pw_183040004`
--

-- --------------------------------------------------------

--
-- Table structure for table `smartphone`
--

CREATE TABLE `smartphone` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `chipset` varchar(128) NOT NULL,
  `internal` varchar(64) NOT NULL,
  `camera` varchar(256) NOT NULL,
  `sensor` varchar(256) NOT NULL,
  `image` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smartphone`
--

INSERT INTO `smartphone` (`id`, `name`, `chipset`, `internal`, `camera`, `sensor`, `image`) VALUES
(21, 'Huawei P30 Pro', 'HiSilicon Kirin 980 (7 nm)', '128/256/512 GB, 8 GB RAM or 128 GB, 6 GB RAM', '40 MP, f/1.6, 27mm (wide), 1/1.7, PDAF, OIS\r\n20 MP, f/2.2, 16mm (ultrawide), 1/2.7, PDAF\r\nPeriscope 8 MP, f/3.4, 125mm (telephoto), 1/4, 5x optical zoom, OIS, PDAF\r\nTOF 3D camera', 'Fingerprint (under display), accelerometer, gyro, proximity, compass, color spectrum', 'huawei-p30-pro-r3.jpg'),
(22, 'Huawei P30 lite', 'Hisilicon Kirin 710 (12 nm)', '128 GB, 6 GB RAM', '24 MP, f/1.8, (wide), PDAF\r\n8 MP, 13mm (ultrawide) \r\n2 MP, f/2.4, depth sensor', 'Fingerprint (rear-mounted), accelerometer, gyro, proximity, compass', 'huawei-p30-lite--.jpg'),
(23, 'Xiaomi Redmi 7', 'Qualcomm SDM632 Snapdragon 632 (14 nm)', '64 GB, 4 GB RAM or 32 GB, 3 GB RAM or 16 GB, 2 GB RAM', '12 MP, f/2.2, 1.25µm, PDAF 2 MP, depth sensor', 'Fingerprint (rear-mounted), accelerometer, proximity, compass', 'xiaomi-redmi-note-7-pro-1.jpg'),
(24, 'Apple iPhone XS Max', 'Apple A12 Bionic (7 nm)', '64/256/512 GB, 4 GB RAM', '12 MP, f/1.8, 26mm (wide), 1/2.55, 1.4µm, OIS, PDAF\r\n12 MP, f/2.4, 52mm (telephoto), 1/3.4, 1.0µm, OIS, PDAF, 2x optical zoom', 'Face ID, accelerometer, gyro, proximity, compass, barometer, Siri natural language commands and dictation', 'apple-iphone-xs-max-5.jpg'),
(25, 'Samsung Galaxy S10+', 'Exynos 9820 (8 nm) - EMEA\r\nQualcomm SDM855 Snapdragon 855 (7 nm) - USA/LATAM, China', '128/512 GB, 8 GB RAM', '12 MP, f/1.5-2.4, 26mm (wide), 1/2.55, 1.4µm, Dual Pixel PDAF, OIS\r\n12 MP, f/2.4, 52mm (telephoto), 1/3.6, 1.0µm, AF, OIS, 2x optical zoom\r\n16 MP, f/2.2, 12mm (ultrawide), 1.0µm', 'Fingerprint (under display), accelerometer, gyro, proximity, compass, barometer, heart rate, SpO2, ANT+,\r\nBixby natural language commands and dictation, Samsung DeX (desktop experience support)', 'samsung-galaxy-s10-plus-1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `smartphone`
--
ALTER TABLE `smartphone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `smartphone`
--
ALTER TABLE `smartphone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
