-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2019 at 12:20 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projektas`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_guests`
--

CREATE TABLE `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `active_users`
--

INSERT INTO `active_users` (`username`, `timestamp`) VALUES
('Administratorius', 1575889442);

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fondas`
--

CREATE TABLE `fondas` (
  `balance` decimal(20,0) NOT NULL DEFAULT '1000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fondas`
--

INSERT INTO `fondas` (`balance`) VALUES
('6015'),
('6015');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL,
  `skola` decimal(10,0) NOT NULL DEFAULT '0',
  `laikotarpis` int(3) NOT NULL DEFAULT '0',
  `imoka` decimal(6,0) NOT NULL DEFAULT '0',
  `data` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`, `skola`, `laikotarpis`, `imoka`, `data`) VALUES
('Valdytojas', 'fe01ce2a7fbac8fafaed7c982a04e229', '8ade4fdc3020cdf4023db8977480619f', 5, 'demo@ktu.lt', 1575306379, '0', 0, '0', '0000-00-00'),
('Administratorius', 'fe01ce2a7fbac8fafaed7c982a04e229', 'b056e3cfbc208674966e5f5916a0af09', 9, 'demo@ktu.lt', 1575889442, '0', 0, '183', '2020-06-09'),
('Vartotojas', 'fe01ce2a7fbac8fafaed7c982a04e229', '655d7374429546f986c8ef57bdf267b1', 1, 'demo@ktu.lt', 1575306213, '0', 0, '0', '0000-00-00'),
('domhd', '36ea04489149c7d7b68cbfa531683817', 'dd5e68c77b9b25d9d01b68791f1c653a', 5, 'domke10@gmail.com', 1575315348, '0', 0, '0', '0000-00-00'),
('domas', 'fe01ce2a7fbac8fafaed7c982a04e229', '1e33769ea9b03d2f966118ffd010d2fe', 1, 'domke10@gmail.com', 1575583493, '0', 0, '0', '0000-00-00'),
('testas', '098f6bcd4621d373cade4e832627b4f6', '60aaae854ddcf49afe279019acae4904', 1, 'test@gmail.com', 1575889040, '0', 0, '18', '2020-06-09'),
('arnas', '098f6bcd4621d373cade4e832627b4f6', '0', 1, 'test@gmail.com', 1575887316, '0', 0, '0', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_guests`
--
ALTER TABLE `active_guests`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `banned_users`
--
ALTER TABLE `banned_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
