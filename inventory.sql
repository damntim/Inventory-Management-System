-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 10:51 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `categoryDescription`, `created_at`) VALUES
(12, 'phone', 'smartphone', '2024-08-16 09:06:02'),
(13, 'beer', 'less that 5.5 alc', '2024-08-16 13:15:17');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `contact`, `email`, `address`, `username`, `password`, `photo`, `created_at`) VALUES
(4, 'mbarushimana danny', '789657890', 'ykdann53@gmail.com', 'kgl', 'product@gmail.com', '1234Da$1', 'iphone 15.jpg', '2024-08-16 14:57:31');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `full_name`, `gmail`, `phone`, `dob`, `gender`, `resident_gps`, `image`, `position`, `hired_date`, `contract_type`, `contract_length`, `bank_name`, `bank_account_number`, `status`, `password`, `created_at`) VALUES
(6, '1', 'Human Resource', 'hr@gmail.com', '0785498054', '2024-07-18', 'Male', 'https://maps.app.goo.gl/QCPsDzNV5NFzQmwz7', '2.jpg', 'Human Resource', '2024-07-31', 'full_time', 12, 'equity', '2345678', 'Active', '12345678', '2024-07-25 19:59:04'),
(18, '5', 'Producrt Manager', 'product@gmail.com', '111111111', '2024-07-01', 'Male', 'https://maps.app.goo.gl/TFCxKVBofKWh6Y7v8', 'messi.jpg', 'Product Manager', '2024-07-17', 'full_time', 2, 'equity', '45678', 'Active', '12345678', '2024-07-29 14:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `pricetype` varchar(50) NOT NULL,
  `paternerID` int(11) NOT NULL,
  `netprice` decimal(10,2) NOT NULL,
  `taxrate` double NOT NULL,
  `discount` int(11) NOT NULL,
  `effectivedate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `productID`, `amount`, `pricetype`, `paternerID`, `netprice`, `taxrate`, `discount`, `effectivedate`) VALUES
(12, 11, '1000000.00', 'purchase', 2, '1200000.00', 20, 0, '2024-08-16 13:31:09'),
(14, 11, '1500000.00', 'selling', 0, '1800000.00', 20, 0, '2024-08-16 14:32:07'),
(15, 12, '1000.00', 'purchase', 3, '1000.00', 0, 0, '2024-08-16 14:47:49'),
(16, 12, '1200.00', 'selling', 0, '1200.00', 0, 0, '2024-08-16 14:49:02'),
(17, 13, '1000000.00', 'purchase', 2, '1100000.00', 10, 0, '2024-08-17 23:09:25'),
(18, 13, '1200000.00', 'selling', 4, '1320000.00', 10, 0, '2024-08-17 23:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `products_tab`
--

CREATE TABLE `products_tab` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_tab`
--

INSERT INTO `products_tab` (`product_id`, `product_name`, `description`, `warehouse_id`, `category_id`, `product_image`) VALUES
(11, 'iphone 15', 'hd cam', 5, 12, 'iphone 15.jpg'),
(12, 'primus', 'fghskjl', 6, 13, 'primus.jpg'),
(13, 'iphone 13', 'fqwghdsjfkl;', 5, 12, 'iphone 15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `netprice` decimal(10,2) NOT NULL,
  `taxrate` decimal(5,2) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `totalprice` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`stock_id`, `product_id`, `quantity`, `partner_id`, `amount`, `netprice`, `taxrate`, `discount`, `totalprice`, `created_at`) VALUES
(1, 11, 10, 2, '1000000.00', '1200000.00', '20.00', '0.00', '12000000.00', '2024-08-16 14:31:02'),
(2, 12, 500, 3, '1000.00', '1100.00', '10.00', '0.00', '550000.00', '2024-08-16 14:48:19'),
(3, 13, 10, 2, '1000000.00', '1100000.00', '10.00', '0.00', '11000000.00', '2024-08-17 23:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `tin` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `tin`, `fullname`, `email`, `address`) VALUES
(2, '123456', 'mbarushimana danny', 'ykdann53@gmail.com', 'kgl'),
(3, '123459', 'niyonzima', 'y@gmail.com', 'kgl');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `category`, `location`, `description`, `created_at`, `updated_at`) VALUES
(5, 'electonics', 'kimironko', 'phone,printer, tvs', '2024-08-16 11:01:44', '2024-08-16 11:01:44'),
(6, 'drinks', 'kimironko', 'alchol', '2024-08-16 15:12:07', '2024-08-16 15:12:07');

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
-- Indexes for table `products_tab`
--
ALTER TABLE `products_tab`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `partner_id` (`partner_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products_tab`
--
ALTER TABLE `products_tab`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_tab`
--
ALTER TABLE `products_tab`
  ADD CONSTRAINT `products_tab_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `stockin`
--
ALTER TABLE `stockin`
  ADD CONSTRAINT `stockin_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products_tab` (`product_id`),
  ADD CONSTRAINT `stockin_ibfk_2` FOREIGN KEY (`partner_id`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
