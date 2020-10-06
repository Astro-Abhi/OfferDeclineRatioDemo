-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 09:06 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odr`
--
CREATE DATABASE IF NOT EXISTS `odr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `odr`;

-- --------------------------------------------------------

--
-- Table structure for table `declinedfeedback`
--

CREATE TABLE `declinedfeedback` (
  `row_id` int(11) NOT NULL,
  `resId` varchar(100) NOT NULL,
  `betterOp` int(11) NOT NULL,
  `locationCon` int(11) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `declinedfeedback`
--

INSERT INTO `declinedfeedback` (`row_id`, `resId`, `betterOp`, `locationCon`, `others`) VALUES
(1, '', 1, 0, 0),
(2, '', 1, 0, 0),
(5, '', 1, 0, 0),
(6, '', 0, 1, 0),
(7, '', 0, 0, 1),
(8, '', 0, 1, 0),
(9, '', 0, 1, 0),
(10, '', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `row_id` int(11) NOT NULL,
  `offerId` varchar(100) NOT NULL,
  `vacancy` int(11) NOT NULL,
  `updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`row_id`, `offerId`, `vacancy`, `updated`) VALUES
(1, '', 121, '2020-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `row_id` int(11) NOT NULL,
  `accepted` int(11) NOT NULL DEFAULT '0',
  `decline` int(11) NOT NULL DEFAULT '0',
  `dated` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`row_id`, `accepted`, `decline`, `dated`) VALUES
(1, 0, 1, '2020-09-12'),
(2, 0, 1, '2020-09-12'),
(5, 0, 1, '2020-09-12'),
(6, 0, 1, '2020-09-15'),
(7, 0, 1, '2020-09-15'),
(8, 0, 1, '2020-09-19'),
(9, 0, 1, '2020-09-19'),
(10, 0, 1, '2020-09-19'),
(11, 1, 0, '2020-09-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `declinedfeedback`
--
ALTER TABLE `declinedfeedback`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`row_id`,`offerId`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`row_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `declinedfeedback`
--
ALTER TABLE `declinedfeedback`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
