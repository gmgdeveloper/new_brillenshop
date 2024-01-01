-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2020 at 06:36 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exportimport_laravel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `excelexport`
--

CREATE TABLE `excelexport` (
  `id` int(11) NOT NULL,
  `ItemName` varchar(500) NOT NULL,
  `ItemCode` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `EItype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `excelexport`
--

INSERT INTO `excelexport` (`id`, `ItemName`, `ItemCode`, `Date`, `Price`, `Quantity`, `EItype`) VALUES
(1, 'car audio (CA)', 'NM-8010', '2017-11-10', 8544, 41, 'excel'),
(2, 'car navigation (CN)', 'NM-8011', '2017-11-10', 4514, 14, 'excel'),
(3, 'computer (CP)', 'NM-8013', '2017-11-10', 4413, 54, 'excel'),
(4, 'copy machine (CM)', 'NM-8012', '2017-11-10', 5756, 100, 'excel'),
(5, 'digital camera (DC)', 'NM-8014', '2017-11-11', 4597, 90, 'excel'),
(6, 'digital video camera (DVC)', 'NM-8016', '2017-11-11', 4121, 45, 'excel'),
(7, 'digital video player (DVP)', 'NM-8017', '2017-11-11', 7458, 40, 'excel'),
(8, 'digital video recorder (DVR)', 'NM-8018', '2017-11-11', 4756, 500, 'excel'),
(9, 'display device (DD)', 'NM-8015', '2017-11-11', 7456, 50, 'excel'),
(10, 'fax (FAX)', 'NM-8019', '2017-11-11', 2584, 120, 'excel'),
(11, 'global positioning system (GPS)', 'NM-8020', '2017-11-12', 3695, 350, 'excel'),
(12, 'hard disk drive (HDD)', 'NM-8021', '2017-11-12', 4522, 740, 'excel'),
(13, 'mechatronics (MN)', 'NM-8023', '2017-11-12', 9685, 580, 'excel'),
(14, 'mobile phone (MP)', 'NM-8024', '2017-11-13', 8657, 685, 'excel'),
(15, 'multifunction printer (MFP)', 'NM-8022', '2017-11-12', 4521, 280, 'excel'),
(16, 'network device (NW)', 'NM-8026', '2017-11-13', 8574, 385, 'excel'),
(17, 'personal computer (PC)', 'NM-8027', '2017-11-13', 2574, 452, 'excel'),
(18, 'portable media player (PMP)', 'NM-8028', '2017-11-13', 9685, 274, 'excel'),
(19, 'printer (PR)', 'NM-8029', '2017-11-13', 7451, 200, 'excel'),
(20, 'semiconductor (SC)', 'NM-8030', '2017-11-13', 3585, 500, 'excel'),
(21, 'car audio (CA)', 'NM-8010', '2017-11-10', 8544, 41, 'csv'),
(22, 'car navigation (CN)', 'NM-8011', '2017-11-10', 4514, 14, 'csv'),
(23, 'computer (CP)', 'NM-8013', '2017-11-10', 4413, 54, 'csv'),
(24, 'copy machine (CM)', 'NM-8012', '2017-11-10', 5756, 100, 'csv'),
(25, 'digital camera (DC)', 'NM-8014', '2017-11-11', 4597, 90, 'csv'),
(26, 'digital video camera (DVC)', 'NM-8016', '2017-11-11', 4121, 45, 'csv'),
(27, 'digital video player (DVP)', 'NM-8017', '2017-11-11', 7458, 40, 'csv'),
(28, 'digital video recorder (DVR)', 'NM-8018', '2017-11-11', 4756, 500, 'csv'),
(29, 'display device (DD)', 'NM-8015', '2017-11-11', 7456, 50, 'csv'),
(30, 'fax (FAX)', 'NM-8019', '2017-11-11', 2584, 120, 'csv'),
(31, 'global positioning system (GPS)', 'NM-8020', '2017-11-12', 3695, 350, 'csv'),
(32, 'hard disk drive (HDD)', 'NM-8021', '2017-11-12', 4522, 740, 'csv'),
(33, 'mechatronics (MN)', 'NM-8023', '2017-11-12', 9685, 580, 'csv'),
(34, 'mobile phone (MP)', 'NM-8024', '2017-11-13', 8657, 685, 'csv'),
(35, 'multifunction printer (MFP)', 'NM-8022', '2017-11-12', 4521, 280, 'csv'),
(36, 'network device (NW)', 'NM-8026', '2017-11-13', 8574, 385, 'csv'),
(37, 'personal computer (PC)', 'NM-8027', '2017-11-13', 2574, 452, 'csv'),
(38, 'portable media player (PMP)', 'NM-8028', '2017-11-13', 9685, 274, 'csv'),
(39, 'printer (PR)', 'NM-8029', '2017-11-13', 7451, 200, 'csv'),
(40, 'semiconductor (SC)', 'NM-8030', '2017-11-13', 3585, 500, 'csv'),
(52, 'Mouse', 'NM-001', '2017-12-20', 40, 5000, 'computer'),
(53, 'Key-board', 'NM-002', '2017-11-12', 300, 4000, 'computer'),
(54, 'Monitor', 'NM-003', '2017-01-24', 474, 454, 'computer'),
(55, 'Speaker', 'NM-004', '2017-12-21', 578, 42, 'computer'),
(56, 'Microphone', 'NM-005', '2017-11-14', 45, 4545, 'computer'),
(57, 'Headphone', 'NM-006', '2017-04-21', 24, 45457, 'computer'),
(58, 'Web Cam', 'NM-007', '2017-05-24', 54, 874, 'computer'),
(59, 'Network Accessories', 'NM-008', '2017-04-22', 55, 2545, 'computer'),
(60, 'Projector', 'NM-009', '2017-05-11', 85, 745, 'computer'),
(61, 'TV Card & Stick', 'NM-010', '2017-07-21', 28, 544, 'computer'),
(62, 'Processor & Motherboard', 'NM-011', '2017-08-21', 45, 545, 'computer'),
(63, 'printer & scanner', 'NM-012', '2017-02-25', 69, 744, 'computer'),
(64, 'Hard Disk & Ram', 'NM-013', '2017-08-24', 44, 574, 'computer'),
(65, 'Optical Drive', 'NM-014', '2017-03-20', 28, 4785, 'computer'),
(66, 'Laptop Accessories', 'NM-015', '2017-04-14', 39, 7478, 'computer'),
(67, 'Gaming Accessories', 'NM-016', '2017-02-24', 45, 6747, 'computer'),
(68, 'Anti-Virus & Software', 'NM-017', '2017-05-12', 25, 3854, 'computer'),
(69, 'Casing', 'NM-018', '2017-07-24', 555, 2875, 'computer'),
(70, 'Cooling', 'NM-019', '2017-08-24', 474, 2956, 'computer'),
(71, 'Power', 'NM-020', '2017-04-03', 745, 6447, 'computer'),
(72, 'Pendrive', 'NM-021', '2017-09-24', 445, 2856, 'computer'),
(73, 'multi-plug and hub', 'NM-022', '2017-04-24', 395, 3745, 'computer'),
(74, 'Cables', 'NM-023', '2017-07-14', 452, 8542, 'computer'),
(75, 'Converter', 'NM-024', '2017-07-12', 855, 7542, 'computer'),
(76, 'Card reader', 'NM-025', '2017-11-24', 1254, 3854, 'computer'),
(77, 'UPS', 'NM-026', '2017-09-10', 398, 9857, 'computer'),
(83, 'Accessory Systems', 'NM-001', '2017-12-20', 40, 5000, 'mobile'),
(84, 'Adapters', 'NM-002', '2017-11-12', 300, 4000, 'mobile'),
(85, 'Cables', 'NM-003', '2017-01-24', 474, 454, 'mobile'),
(86, 'Chargers', 'NM-004', '2017-12-21', 578, 42, 'mobile'),
(87, 'Bluetooth', 'NM-005', '2017-11-14', 45, 4545, 'mobile'),
(88, 'Wireless Speakers', 'NM-006', '2017-04-21', 24, 45457, 'mobile'),
(89, 'Car & Travel Accessories', 'NM-007', '2017-05-24', 54, 874, 'mobile'),
(90, 'Batteries & Power', 'NM-008', '2017-04-22', 55, 2545, 'mobile'),
(91, 'Cases & Clips', 'NM-009', '2017-05-11', 85, 745, 'mobile'),
(92, 'Headsets & Stick', 'NM-010', '2017-07-21', 28, 544, 'mobile'),
(93, 'iPhone Accessories', 'NM-011', '2017-08-21', 45, 545, 'mobile'),
(94, 'printer & scanner', 'NM-012', '2017-02-25', 69, 744, 'mobile'),
(95, 'Micro SD', 'NM-013', '2017-08-24', 44, 574, 'mobile'),
(96, 'Mobile Hotspots', 'NM-014', '2017-03-20', 28, 4785, 'mobile'),
(97, 'Photography Accessories', 'NM-015', '2017-04-14', 39, 7478, 'mobile'),
(98, 'Prepaid Minutes', 'NM-016', '2017-02-24', 45, 6747, 'mobile'),
(99, 'Samsung Galaxy Accessories', 'NM-017', '2017-05-12', 25, 3854, 'mobile'),
(100, 'Screen Protectors', 'NM-018', '2017-07-24', 555, 2875, 'mobile'),
(101, 'Smartwatches & Accessories', 'NM-019', '2017-08-24', 474, 2956, 'mobile'),
(102, 'Power', 'NM-020', '2017-04-03', 745, 6447, 'mobile'),
(103, 'Signal Boosters', 'NM-021', '2017-09-24', 445, 2856, 'mobile'),
(104, 'Tablet Stylus Pens', 'NM-022', '2017-04-24', 395, 3745, 'mobile'),
(105, 'Cables', 'NM-023', '2017-07-14', 452, 8542, 'mobile'),
(106, 'Converter', 'NM-024', '2017-07-12', 855, 7542, 'mobile'),
(107, 'Smart Tracker Tags', 'NM-025', '2017-11-24', 1254, 3854, 'mobile'),
(108, 'SIM Cards', 'NM-026', '2017-09-10', 398, 9857, 'mobile');

-- --------------------------------------------------------

--
-- Table structure for table `imported_data`
--

CREATE TABLE `imported_data` (
  `id` int(11) NOT NULL,
  `ItemName` varchar(500) NOT NULL,
  `ItemCode` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `EItype` varchar(20) NOT NULL,
  `libType` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `excelexport`
--
ALTER TABLE `excelexport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imported_data`
--
ALTER TABLE `imported_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `excelexport`
--
ALTER TABLE `excelexport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `imported_data`
--
ALTER TABLE `imported_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
