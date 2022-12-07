-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 08:07 AM
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
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `id` int(11) NOT NULL,
  `category_id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`id`, `category_id`, `name`, `description`, `price`, `image`, `status`) VALUES
(1, '0', 'vivo', 'red piss', '15,000/-', './image/1670390155Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(2, '0', 'vivo', 'black color', '20,000/-', './image/1670390176Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(3, '0', 'vivo', 'black color', '20,000/-', './image/1670390257Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(4, '0', '123456', 'black color', '100', './image/1670393658Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(5, '0', '123456', 'black color', '100', './image/1670393813Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(6, '0', '123456', 'black color', '100', './image/1670393826Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(7, '0', 'vivo', 'df', 'wdsqw', './image/1670393865sunshine.jpg', 'Active'),
(8, '0', 'samsung', '1234', '45000/-', './image/1670393906Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(9, '1', 'samsung', 'sa', 'SDSDS', './image/1670395913Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(10, '4', 'samsung', 'sa', 'SDSDS', './image/1670396036Vivo-V25-Smart-Phone-493177670-i-1-1200Wx1200H.jpeg', 'Active'),
(11, '8', 'Test Category ', 'ALL TEST', '500/-', './image/1670396281', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
