-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 09:26 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryDescription` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `categoryDescription`, `created_at`) VALUES
(3, 'food', 'some thing you can cook', '2024-07-29 09:17:16'),
(4, 'electronic', 'ict', '2024-07-29 09:48:58'),
(5, 'shoe', 'wearable', '2024-07-29 09:54:49'),
(6, 'drinks', 'alchool', '2024-07-29 09:55:23'),
(7, 'daily', 'milk', '2024-07-29 09:55:38'),
(8, 'women', 'shorts', '2024-07-29 09:56:00'),
(9, 'foods', 'some thing you can cook', '2024-07-29 09:56:44'),
(11, 'childish', 'ict', '2024-07-29 11:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `contact`, `email`, `address`, `username`, `password`, `photo`, `created_at`) VALUES
(2, 'mbarushimana danny', '785498054', 'ykdann53@gmail.com', 'kgl', 'danny', '12345$Da', 'messi.jpg', '2024-07-29 18:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `resident_gps` varchar(255) NOT NULL,
  `image` varchar(600) NOT NULL DEFAULT '1',
  `position` varchar(100) NOT NULL,
  `hired_date` date NOT NULL,
  `contract_type` varchar(50) NOT NULL,
  `contract_length` int(11) DEFAULT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_account_number` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `full_name`, `gmail`, `phone`, `dob`, `gender`, `resident_gps`, `image`, `position`, `hired_date`, `contract_type`, `contract_length`, `bank_name`, `bank_account_number`, `status`, `password`, `created_at`) VALUES
(6, '1', 'Human Resource', 'hr@gmail.com', '0785498054', '2024-07-18', 'Male', 'https://maps.app.goo.gl/QCPsDzNV5NFzQmwz7', '2.jpg', 'Human Resource', '2024-07-31', 'full_time', 12, 'equity', '2345678', 'Active', '12345678', '2024-07-25 19:59:04'),
(15, '2', 'wera house', 'werahouse@gmail.com', '0785498052', '2024-07-18', 'Male', 'https://maps.app.goo.gl/TFCxKVBofKWh6Y7v8', 'j.jpg', 'Warehouse Manager', '2024-07-19', 'full_time', 4, 'equity', '2345678', 'Active', '12345678', '2024-07-29 14:16:24'),
(16, '3', 'Stock Manager', 'stock@gmail.com', '0785498054', '2024-07-01', 'Male', 'https://maps.app.goo.gl/QCPsDzNV5NFzQmwz7', 'jude.jpg', 'Stock Manager', '2024-07-01', 'full_time', 2, 'equity', '234567', 'Active', '12345678', '2024-07-29 14:25:42'),
(17, '4', 'Customer Manager', 'custom@gmail.com', '23456789', '2024-07-17', 'Male', 'https://maps.app.goo.gl/QCPsDzNV5NFzQmwz7', 'sanco.jpg', 'Customer Manager', '2024-07-24', 'full_time', 2, 'equity', '55565', 'Active', '12345678', '2024-07-29 14:26:57'),
(18, '5', 'Producrt Manager', 'product@gmail.com', '111111111', '2024-07-01', 'Male', 'https://maps.app.goo.gl/TFCxKVBofKWh6Y7v8', 'messi.jpg', 'Product Manager', '2024-07-17', 'full_time', 2, 'equity', '45678', 'Active', '12345678', '2024-07-29 14:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `pricestype` varchar(50) NOT NULL,
  `partnerID` int(11) NOT NULL,
  `netprice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `supplyPrice` int(11) NOT NULL,
  `sellingPrice` int(11) DEFAULT NULL,
  `productCategory` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `productDescription` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productName`, `productImage`, `supplyPrice`, `sellingPrice`, `productCategory`, `quantity`, `stock`, `productDescription`, `created_at`, `updated_at`) VALUES
(2, 'Jordan Future', '../../../images/products/Vicky.jpg', 7850, 35000, 5, 50, 1, 'High Quality', '2024-07-30 05:23:58', '2024-07-30 06:44:49'),
(3, 'Maize', '../../../images/products/Vicky.jpg', 4300, 45000, 9, 430, 3, 'Maize Flour', '2024-07-30 06:50:48', '2024-07-30 07:21:33'),
(4, 'f', '../../../images/products/Vicky.jpg', 400, 0, 11, 45, 1, 'jj', '2024-07-30 07:00:05', '2024-07-30 07:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `price`) VALUES
(5, 2, 35000),
(6, 3, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `category`, `location`, `description`, `created_at`, `updated_at`) VALUES
(1, 'food', 'kimiromko', 'child', '2024-07-29 15:46:07', '2024-07-29 15:46:07'),
(2, 'cars', 'kgl', 'moto', '2024-07-29 17:55:44', '2024-07-29 17:55:44'),
(3, 'JJ', 'Kih', 'ss', '2024-07-30 07:46:03', '2024-07-30 07:46:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`,`gmail`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productCategory` (`productCategory`),
  ADD KEY `stock` (`stock`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`productCategory`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`stock`) REFERENCES `stocks` (`id`);

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
