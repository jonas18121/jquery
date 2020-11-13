-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2020 at 02:48 PM
-- Server version: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anonforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `likedislike`
--

CREATE TABLE `likedislike` (
  `id` int(11) NOT NULL,
  `ipauteur` varchar(15) NOT NULL,
  `idmessage` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likedislike`
--

INSERT INTO `likedislike` (`id`, `ipauteur`, `idmessage`, `value`) VALUES
(1, '127.0.0.1', 1, -1),
(3, '127.0.0.1', 2, 1),
(4, '127.0.0.1', 4, -1),
(5, '127.0.0.1', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `dateheure` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ipauteur` varchar(15) NOT NULL,
  `idrepond` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `titre`, `message`, `dateheure`, `ipauteur`, `idrepond`) VALUES
(1, 'Salut', 'Coucou', '2020-11-12 10:49:41', '127.0.0.1', NULL),
(2, 'Salut2', 'Coucou2', '2020-11-12 10:49:51', '127.0.0.1', NULL),
(3, 'Salut3', 'Coucou3', '2020-11-12 10:50:05', '127.0.0.1', 1),
(4, 'test', 'test', '2020-11-12 11:41:22', '127.0.0.1', NULL),
(5, 'sallo', 'poqszgibhnom', '2020-11-12 11:58:10', '127.0.0.1', NULL),
(6, 'dsgdfg', 'dfgfd', '2020-11-12 11:58:27', '127.0.0.1', 1),
(7, 'dfgdf', 'dfggdf', '2020-11-12 11:58:33', '127.0.0.1', 1),
(8, 'dsf', 'dffd', '2020-11-12 11:58:38', '127.0.0.1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likedislike`
--
ALTER TABLE `likedislike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idmessage` (`idmessage`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idrepond` (`idrepond`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likedislike`
--
ALTER TABLE `likedislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `likedislike`
--
ALTER TABLE `likedislike`
  ADD CONSTRAINT `likedislike_ibfk_1` FOREIGN KEY (`idmessage`) REFERENCES `message` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`idrepond`) REFERENCES `message` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
