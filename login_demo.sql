-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 07:07 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `req_reg`
--

CREATE TABLE `req_reg` (
  `id` int(255) UNSIGNED NOT NULL,
  `nid` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_admin_info`
--

CREATE TABLE `user_admin_info` (
  `id` int(255) NOT NULL,
  `nid` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_admin_info`
--

INSERT INTO `user_admin_info` (`id`, `nid`, `name`, `email`, `password`, `user_type`) VALUES
(20, '36987458745', 'Trena', 'shamlima@gmail.com', '2475c20d9e9a1aaee80dcbc4e6316157', 'admin'),
(22, '69321547893', 'Mehrab', 'mehrabdaishi974@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(27, '26987458745', 'Test1', 'test1@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'user'),
(30, '36987458745', 'Test', 'test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(31, '36987458745', 'Test2', 'test2@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'admin'),
(32, '36987458745', 'Test3', 'test3@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'admin'),
(35, '36987458745', 'Test5', 'test5@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `req_reg`
--
ALTER TABLE `req_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_admin_info`
--
ALTER TABLE `user_admin_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `req_reg`
--
ALTER TABLE `req_reg`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_admin_info`
--
ALTER TABLE `user_admin_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
