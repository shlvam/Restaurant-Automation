-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 03:07 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custid` int(8) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `zipcode` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custid`, `pass`, `cname`, `surname`, `mobile`, `address`, `zipcode`) VALUES
(1, '$2y$10$ISdbTOKA4hqjVR3YiQ4ZEefHyMiljEPuns62yl6.iol0F8SeG6HnW', 'Shivam', 'Kumar', '8965471235', 'IIIT Bhubaneswar', '987456'),
(2, '$2y$10$CUAAo90kNVDnn0V0guN9DO8ZWTrvKv1PT86ZqpQSf243zuu38dpZy', 'Ritik Kumar', 'Raj', '7896540210', 'IIIT Bhubaneswar', '751980'),
(3, '$2y$10$a80TP3cUA390Q4WfXW39au57Uh/ouJecaWm2GYscXKggQeSlvhu4y', 'Karanbir', 'Singh', '8965471235', 'IIIT Bhubaneswar', '756984');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empid` int(16) NOT NULL,
  `ename` varchar(50) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `zipcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empid`, `ename`, `surname`, `pass`, `role`, `mobile`, `address`, `zipcode`) VALUES
(1, 'Shivam', 'Kumar', '$2y$10$fZyCSLAKWOD2BOVvARGkFODGtDuXtnbO8cKbU3xLK4zCFBKi7zLUK', 'Cook', '7896540210', 'IIIT Bhubaneswar', '987456'),
(2, 'Ritik', 'Kumar Raj', '$2y$10$3NUiG1WsiOue4IPbtFeKE.wOtdW/Pro8axtSqQJmBxHZ9X9fNKenW', 'Cook', '8965471235', 'IIIT Bhubaneswar', '751985'),
(3, 'Karanbir', 'Singh', '$2y$10$C2YMQmkTgBOtzjSms9/lNub2KLPK.xRcv1S.9UpKB0iHEMPJesMey', 'Cook', '8786245687', 'IIIT Bhubaneswar', '756984');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuid` int(11) NOT NULL,
  `food_name` varchar(55) NOT NULL,
  `food_pic` text DEFAULT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuid`, `food_name`, `food_pic`, `price`) VALUES
(1, 'Noodles', 'http://localhost/restaurant/menu/1.jpg', 200),
(2, 'Pizza', 'http://localhost/restaurant/menu/2.jpg', 200),
(3, 'Pasta', 'http://localhost/restaurant/menu/3.jpg', 100),
(4, 'Mojito', 'http://localhost/restaurant/menu/4.jpg', 120),
(5, 'Coffee', 'http://localhost/restaurant/menu/5.jpg', 50),
(6, 'Burger', 'http://localhost/restaurant/menu/6.jpg', 200);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(8) NOT NULL,
  `empid` int(8) NOT NULL,
  `custid` int(8) NOT NULL,
  `menuid` varchar(255) NOT NULL,
  `ordate` date NOT NULL DEFAULT current_timestamp(),
  `ordtime` time NOT NULL DEFAULT current_timestamp(),
  `tot_pay` double NOT NULL,
  `cmnt` text DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `empid`, `custid`, `menuid`, `ordate`, `ordtime`, `tot_pay`, `cmnt`, `done`) VALUES
(7954, 0, 1, '5, 1', '2021-03-16', '13:14:09', 155, 'make food good', 0),
(7955, 0, 3, '4, 5, 3, 1', '2021-03-16', '13:29:08', 325, 'no butter', 0),
(7960, 0, 2, '2, 6, 5, ', '2021-03-22', '19:26:36', 450, 'Extra cheese.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab`
--

CREATE TABLE `tab` (
  `tab_id` int(11) NOT NULL,
  `nchair` int(11) NOT NULL,
  `bked` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tab`
--

INSERT INTO `tab` (`tab_id`, `nchair`, `bked`) VALUES
(1, 3, 1),
(2, 6, 1),
(3, 4, 0),
(4, 8, 0),
(5, 12, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `tab`
--
ALTER TABLE `tab`
  ADD PRIMARY KEY (`tab_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7961;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
