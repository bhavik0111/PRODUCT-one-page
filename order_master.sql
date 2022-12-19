-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 08:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `category_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `Order_ID` int(11) NOT NULL,
  `Order_Number` int(200) NOT NULL,
  `Date` date NOT NULL,
  `Customer_Name` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Shipping_Address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`Order_ID`, `Order_Number`, `Date`, `Customer_Name`, `Address`, `Phone`, `Email`, `Shipping_Address`) VALUES
(1, 0, '0000-00-00', '', '', '', '', ''),
(2, 1, '0000-00-00', 'rohit', 'rajkot', '1234657890', 'abc@gmail.com', 'rajkot kalawad road.'),
(3, 0, '0000-00-00', '', '', '', '', ''),
(4, 0, '0000-00-00', '', '', '', '', ''),
(5, 0, '0000-00-00', '', '', '', '', ''),
(6, 0, '0000-00-00', '', '', '', '', ''),
(7, 0, '0000-00-00', '', '', '', '', ''),
(8, 0, '2222-02-02', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`Order_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
