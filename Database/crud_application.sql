-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 02:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud_application`
--

CREATE TABLE `crud_application` (
  `user_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_description` varchar(200) NOT NULL,
  `product_price` varchar(200) NOT NULL,
  `product_image` varchar(500) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud_application`
--

INSERT INTO `crud_application` (`user_id`, `product_name`, `product_description`, `product_price`, `product_image`, `date_time`) VALUES
(5, 'Smart watch', 'Pulse meter with chest strap on white background', '500', 'product_image_65589fb146626.jpg', '2023-11-18 11:27:45'),
(6, 'Nike ', 'red color', '5000', 'product_image_6558a0a91171c.jpg', '2023-11-18 11:31:53'),
(7, 'Smart Phone', 'Tuch Screen', '20000', 'product_image_6558a0e335849.jpg', '2023-11-18 11:32:51'),
(8, 'Hadphones', 'Black color', '2000', 'product_image_6558a110d6a89.jpg', '2023-11-18 11:33:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud_application`
--
ALTER TABLE `crud_application`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud_application`
--
ALTER TABLE `crud_application`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
