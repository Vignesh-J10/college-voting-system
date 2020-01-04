-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 08:22 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collegev_vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `clg`
--

CREATE TABLE `clg` (
  `College_Name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Location` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Activation_Code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Mail_Status` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `Date_Of_Creation` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `Conduct` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clg`
--

INSERT INTO `clg` (`College_Name`, `Location`, `Email`, `Password`, `Activation_Code`, `Mail_Status`, `Date_Of_Creation`, `Conduct`) VALUES
('Loyola College', 'Chennai', 'aravindkrish97@gmail.com', '25d55ad283aa400af464c76d713c07ad', '9c865bf80467daa3e17592b8913ae2c6', '1', '2019-07-23 07:14:47.000000', 0),
('GNC12345', 'velachery', 'bharathisweety24@gmail.com', '88cd6f808db88030f860f9cf8b42c8b1', 'c044753a8da57036ef0a85fd51fd2ff3', '1', '2019-08-05 05:07:05.000000', 0),
('Xyz', 'Yhs', 'karthikvk185@gmail.com', '24b1b30b8515ad36088a409c99144564', '9feebd0919ed02e166647df5e1cc92cd', '1', '2019-08-18 17:55:18.000000', 0),
('gnc123455', 'Chennai', 'rohith.subhakar@gmail.com', '25d55ad283aa400af464c76d713c07ad', '70fdc975674c1610ec6f8091e1215030', '0', '2019-07-23 07:16:22.000000', 0),
('qwertyui', 'chennai', 'shanthajanakiraman85@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'c420397671c1321f4557d0a510471a61', '0', '2019-09-24 11:05:10.000000', 0),
('Gnc', 'chennai', 'vigneshraman97@gmail.com', '25d55ad283aa400af464c76d713c07ad', '63f5df76bd7b9292dd7124326333c16e', '1', '2019-09-16 14:50:40.000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `College_Name` varchar(30) NOT NULL,
  `Edate` date NOT NULL,
  `Etime` time NOT NULL,
  `Rdate` date NOT NULL,
  `Rtime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `College_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`Name`, `College_Name`, `Status`) VALUES
('president', 'Guru Nanak College', 1),
('president', 'GuruNanakCollege', 1),
('seccretary', 'GuruNanakCollege', 1),
('culsec', 'GuruNanakCollege', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clg`
--
ALTER TABLE `clg`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `College Name` (`College_Name`,`Email`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`College_Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
