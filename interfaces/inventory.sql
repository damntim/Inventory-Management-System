-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 06, 2024 at 08:46 AM
-- Server version: 10.6.18-MariaDB-cll-lve
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afrino3_inventory`
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
(2, 'mbarushimana danny', '785498054', 'ykdann53@gmail.com', 'kgl', 'danny', '12345$Da', 'messi.jpg', '2024-07-29 18:52:00'),
(3, 'Guinevere Hernandez', '781006107', 'besoxosagu@mailinator.com', 'Voluptate ut quasi i', 'tanicafede', 'Pa$$w0rd!', 'sneakers.png', '2024-07-31 23:01:21');

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
  `pricetype` varchar(50) NOT NULL,
  `paternerID` int(11) NOT NULL,
  `netprice` decimal(10,2) NOT NULL,
  `taxrate` double NOT NULL,
  `discount` int(11) NOT NULL,
  `effectivedate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `productID`, `amount`, `pricetype`, `paternerID`, `netprice`, `taxrate`, `discount`, `effectivedate`) VALUES
(1, 2, 200.00, 'purchase', 1, 198.00, 2, 3, '2024-07-31 21:50:54'),
(2, 2, 500.00, 'selling', 2, 500.00, 0, 0, '2024-07-31 21:55:37'),
(3, 4, 4000.00, 'purchase', 1, 3600.00, 0, 10, '2024-07-31 22:51:19'),
(4, 4, 5000.00, 'selling', 2, 5000.00, 0, 0, '2024-07-31 22:53:32'),
(5, 3, 300000.00, 'purchase', 1, 279000.00, 3, 10, '2024-08-01 05:39:11'),
(6, 3, 500000.00, 'selling', 0, 495000.00, 6, 7, '2024-08-01 05:51:15'),
(7, 5, 80000.00, 'purchase', 1, 76000.00, 3, 8, '2024-08-01 06:51:49'),
(8, 5, 90000.00, 'selling', 0, 90900.00, 2, 1, '2024-08-01 07:06:39'),
(9, 1, 20000.00, 'purchase', 2, 21000.00, 10, 5, '2024-08-04 20:19:34'),
(10, 6, 1300.00, 'purchase', 2, 1521.00, 20, 3, '2024-08-05 00:11:10'),
(11, 6, 6000.00, 'selling', 0, 6420.00, 10, 3, '2024-08-06 05:24:56'),
(12, 8, 800000.00, 'purchase', 2, 840000.00, 10, 5, '2024-08-06 06:14:44'),
(13, 8, 1000000.00, 'selling', 0, 1100000.00, 10, 0, '2024-08-06 06:17:03');

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
-- Table structure for table `products_tab`
--

CREATE TABLE `products_tab` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_tab`
--

INSERT INTO `products_tab` (`product_id`, `product_name`, `description`, `warehouse_id`, `category_id`, `product_image`) VALUES
(1, 'ISABUNE', 'asdfghjkl;werty', 1, 7, 'Screenshot (123).png'),
(2, 'Lesley Chapman', 'Ut sequi laudantium', 3, 4, 'Screenshot (126).png'),
(3, 'computer', 'wsertyuiokawsedrftgyuhij', 1, 4, 'desktop.png'),
(4, 'Ipasi', 'iyi pasi rero nanjye sinzi tuh hhhh', 3, 4, 'flatiron.png'),
(5, 'UMUSHANANA', 'UMUSHANA NA ', 2, 8, 'dress.png'),
(6, 'INGUVU', 'inzoga yabakuru', 3, 6, 'DSC_7923.png'),
(7, 'Joel Jackson', 'Incididunt omnis rem', 1, 6, 'DSC_7923.png'),
(8, 'Lenovo Laptop', 'RAM ssd 56 nibindi', 2, 4, 'download.jpg');

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
  `totalprice` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`stock_id`, `product_id`, `quantity`, `partner_id`, `amount`, `netprice`, `taxrate`, `discount`, `totalprice`, `created_at`) VALUES
(1, 4, 10, 1, 4000.00, 3600.00, 0.00, 10.00, 36000, '2024-08-04 21:14:33'),
(2, 1, 20, 2, 20000.00, 21000.00, 10.00, 5.00, 420000, '2024-08-04 22:12:01'),
(3, 6, 40, 2, 1300.00, 1521.00, 20.00, 3.00, 60840, '2024-08-05 00:11:47'),
(4, 8, 100, 2, 800000.00, 840000.00, 10.00, 5.00, 84000000, '2024-08-06 06:19:05');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `tin`, `fullname`, `email`, `address`) VALUES
(1, '23890', 'qwertyu', 'qwer@gmail.com', 'file:///C:/Users/25078/Downloads/Requisition_Table.pdf'),
(2, '2389078', 'RURANGIRWA', 'ru@gmail.com', 'https://www.google.com/maps/place/Kigali/data=!4m2!3m1!1s0x19dca4258ed8e797:0xf32b36a5411d0bc8?sa=X&ved=1t:242&ictx=111');

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
-- Indexes for table `products_tab`
--
ALTER TABLE `products_tab`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `partner_id` (`partner_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products_tab`
--
ALTER TABLE `products_tab`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `products_tab`
--
ALTER TABLE `products_tab`
  ADD CONSTRAINT `products_tab_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

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
