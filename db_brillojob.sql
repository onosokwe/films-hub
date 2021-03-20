-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2021 at 09:31 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_brillojob`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_films`
--

CREATE TABLE `tbl_films` (
  `sn` int(11) NOT NULL,
  `film_id` int(11) DEFAULT NULL,
  `film_title` varchar(455) DEFAULT NULL,
  `film_year` varchar(11) DEFAULT NULL,
  `film_price` varchar(11) DEFAULT 'NULL',
  `film_genre` varchar(155) DEFAULT NULL,
  `film_avatar` varchar(155) DEFAULT 'NULL',
  `status` int(1) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `created_at` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genres`
--

CREATE TABLE `tbl_genres` (
  `sn` int(11) NOT NULL,
  `genre_id` varchar(11) DEFAULT NULL,
  `genre_name` varchar(155) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created_on` varchar(10) NOT NULL,
  `created_at` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_genres`
--

INSERT INTO `tbl_genres` (`sn`, `genre_id`, `genre_name`, `status`, `created_on`, `created_at`) VALUES
(1, '98743947', 'Romance', '1', '2021-03-16', '11:08:13'),
(2, '93632355', 'Horror', '1', '2021-03-17', '08:54:55'),
(3, '59630196', 'Action', '1', '2021-03-17', '09:34:41'),
(4, '85080873', 'Comedy', '1', '2021-03-20', '09:17:23'),
(5, '27479645', 'Documentary', '1', '2021-03-20', '09:18:13'),
(6, '84832284', 'Science Fiction', '1', '2021-03-20', '09:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `sn` int(11) NOT NULL,
  `order_id` varchar(11) DEFAULT NULL,
  `film_id` varchar(11) DEFAULT NULL,
  `film_title` varchar(455) DEFAULT NULL,
  `film_year` varchar(11) DEFAULT NULL,
  `film_price` varchar(11) DEFAULT NULL,
  `film_avatar` varchar(455) DEFAULT NULL,
  `film_genre` varchar(155) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `user_address` varchar(155) DEFAULT NULL,
  `ordered_on` varchar(10) DEFAULT NULL,
  `ordered_at` varchar(10) DEFAULT NULL,
  `order_total` varchar(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `order_ref` varchar(65) DEFAULT NULL,
  `time_paid` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `sn` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_username` varchar(455) DEFAULT NULL,
  `user_name` varchar(455) DEFAULT NULL,
  `user_email` varchar(455) DEFAULT NULL,
  `user_pass` varchar(455) DEFAULT NULL,
  `user_address` varchar(455) DEFAULT NULL,
  `user_level` varchar(1) DEFAULT NULL,
  `user_bday` varchar(55) DEFAULT NULL,
  `user_cardname` varchar(455) DEFAULT NULL,
  `user_cardno` varchar(55) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `created_at` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_films`
--
ALTER TABLE `tbl_films`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `tbl_genres`
--
ALTER TABLE `tbl_genres`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_films`
--
ALTER TABLE `tbl_films`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_genres`
--
ALTER TABLE `tbl_genres`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
