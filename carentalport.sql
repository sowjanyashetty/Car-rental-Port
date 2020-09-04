-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2020 at 01:51 PM
-- Server version: 10.3.15-MariaDB
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
-- Database: `carentalport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `email`, `phone`, `password`, `dob`) VALUES
('Admin1', 'admin@gmail.com', 9990008881, 'admin', '1999-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `v_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date NOT NULL DEFAULT current_timestamp(),
  `location` varchar(500) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`v_id`, `email`, `start_date`, `end_date`, `location`, `status`) VALUES
(1, 'user1@gmail.com', '2019-10-11', '2019-10-18', 'udupi', 0),
(5, 'user1@gmail.com', '2020-09-04', '2019-10-11', 'Mangaluru,Karnataka', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(200) NOT NULL,
  `name` varchar(500) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` varchar(8) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `phone`, `password`, `dob`) VALUES
('user1@gmail.com', 'user1', 9900990099, 'user1', '1999-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `v_id` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `cost_perday` bigint(20) NOT NULL,
  `capacity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `available` int(11) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`v_id`, `brand_name`, `cost_perday`, `capacity`, `image`, `available`, `removed`) VALUES
(1, 'Benz', 30000, 4, 'img11.jpg', 1, 1),
(2, 'Benz', 25000, 4, 'img12.jpg', 0, 1),
(3, 'Benz', 35000, 4, 'img13.jpg', 1, 1),
(5, 'Toyota', 20000, 4, 'img15.jpg', 0, 1),
(6, 'Toyota', 20000, 4, 'img16.jpg', 1, 1),
(7, 'Toyota', 25000, 4, 'img17.jpg', 1, 1),
(8, 'Ford', 20000, 4, 'img18.jpg', 1, 1),
(9, 'Ford', 18000, 4, 'img19.jpg', 1, 1),
(10, 'Ford', 20000, 4, 'img20.jpg', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`v_id`,`email`,`start_date`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`v_id`,`removed`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`v_id`) REFERENCES `vehicles` (`v_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`email`) REFERENCES `user` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
