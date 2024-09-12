-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 12, 2024 at 08:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile`) VALUES
(1, 'Tahfim', 'Tahfim@gmail.com', 'Tahfim', 'tahfim.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `price`, `qty`) VALUES
('yltT74tthMgaRK8NRRwM', 'inAkTZt60oadYlfEdDmY', 'EiLTWNWB6ipuS7GrcGyK', '5000', '5');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address_type` varchar(10) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'in progress',
  `payment_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`, `date`, `status`, `payment_status`) VALUES
('2', '456', 'Butter', '9876543211', 'user2@example.com', '456 Elm St', 'Office', 'Credit Card', '2', '150', '3', '2024-05-18', 'active', 'in progress'),
('3', '789', 'Ghee', '9876543212', 'user3@example.com', '789 Oak St', 'Home', 'PayPal', '3', '300', '1', '2024-05-18', 'active', 'canceled'),
('4', '101', 'Milk', '9876543213', 'user4@example.com', '101 Pine St', 'Office', 'Cash on Delivery', '1', '180', '4', '2024-05-18', 'active', 'in progress'),
('5', '202', 'Butter', '9876543214', 'user5@example.com', '202 Cedar St', 'Home', 'Credit Card', '2', '220', '2', '2024-05-18', 'active', 'pending'),
('6', '303', 'Ghee', '9876543215', 'user6@example.com', '303 Maple St', 'Office', 'PayPal', '3', '250', '3', '2024-05-18', 'active', 'pending'),
('7', '404', 'Milk', '9876543216', 'user7@example.com', '404 Walnut St', 'Home', 'Cash on Delivery', '1', '200', '1', '2024-05-18', 'active', 'pending'),
('8', '505', 'Butter', '9876543217', 'user8@example.com', '505 Birch St', 'Office', 'Credit Card', '2', '170', '2', '2024-05-18', 'active', 'complete'),
('9', '606', 'Ghee', '9876543218', 'user9@example.com', '606 Sycamore St', 'Home', 'PayPal', '3', '300', '4', '2024-05-18', 'active', 'pending'),
('10', '707', 'Milk', '9876543219', 'user10@example.com', '707 Oak St', 'Office', 'Cash on Delivery', '1', '230', '3', '2024-05-18', 'active', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantityAdded` int(255) NOT NULL,
  `quantityAvailable` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_detail` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `consumer` varchar(255) NOT NULL,
  `TotalSold` int(11) NOT NULL,
  `expectedSell` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantityAdded`, `quantityAvailable`, `image`, `product_detail`, `status`, `consumer`, `TotalSold`, `expectedSell`) VALUES
('M25zpPD8bpGSTkNzl0rb', 'Milk 5L', '500', 10, 10, 'p10.png', 'Milk is a good source of energy.', 'active', 'Household Customer', 4, 13),
('Hi33GJj5dvhWbhLswSCe', 'Milk 1L', '100', 20, 20, 'p10.png', 'Milk is a good source of energy.', 'active', 'Household Customer', 8, 15),
('12MIlcY1zu8Zp06910W3', 'Butter 500gm', '500', 8, 8, 'p10.png', 'Butter is a good source of good fat.', 'active', 'Household Customer', 3, 8),
('3hP0nHeOhGVS3BDjCqID', 'Butter 100gm', '110', 15, 15, 'p10.png', 'Butter is a good source of good fat.', 'active', 'Household Customer', 2, 12),
('dRagFtenDz4nhLMFi2Yu', 'Ghee 250ml', '500', 7, 7, 'p10.png', 'Ghee is a good source of good fat.', 'active', 'Household Customer', 1, 7),
('dKR2M1rqLraBewZCyOgt', 'Ghee 5kg', '9900', 5, 5, 'p10.png', 'Ghee is a good source of good fat.', 'active', 'Commercial Customer', 11, 9),
('Tuow4xVIYfxYX6iS4VAc', 'Butter 10 kg', '5000', 15, 15, 'p10.png', 'Butter is a good source of good fat.', 'active', 'Commercial Customer', 7, 4),
('7XqbfSWAA8oEDI3ytrUh', 'Milk 20L', '10000', 7, 7, 'p10.png', 'Milk is a good source of good Energy.', 'active', 'Commercial Customer', 8, 5),
('oKmcHNlHEJWbIpZi8LfN', 'Milk 5 Gallons', '6000', 5, 5, 'p10.png', 'Milk is a good source of energy.', 'active', 'Commercial Customer', 10, 7),
('NGM5FAkTrIMtGxN9YhYN', 'dwuhxkws', '500', 3, 3, 'p10.png', 'wihx1wkj', 'active', 'Household Customer', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `user_type`) VALUES
('0FcT15hodc4IB71wcpFr', 'Shuchi', 'shuchi@gmail.com', 'Household Customer', '1234', 'user'),
('ZD60xozo0xJcVe2dxPJz', 'Shuchi', 'shuchi1@gmail.com', 'Household Customer', '1234', 'user'),
('inAkTZt60oadYlfEdDmY', 'Brishti', 'brishti@gmail.com', 'Commercial Customer', '1234', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
