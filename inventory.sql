-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 10:13 PM
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
(6, '1', 'Human Resource', 'hr@gmail.com', '0785498054', '2024-07-18', 'Male', 'https://maps.app.goo.gl/QCPsDzNV5NFzQmwz7', '2.jpg', 'Human Resource', '2024-07-31', 'full_time', 12, 'equity', '2345678', 'Active', '123', '2024-07-25 19:59:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`,`gmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

-- CREATE TABLE `stock` (
--   `ProductId` int(11) NOT NULL AUTO_INCREMENT,
--   `Quantity` int(11) NOT NULL,
--   `LastUpdated` timestamp NOT NULL DEFAULT current_timestamp(),
--   `Category` varchar(100) NOT NULL,
--   `Location` varchar(100) NOT NULL,
--   PRIMARY KEY (`ProductId`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

-- INSERT INTO `stock` (`ProductId`, `Quantity`, `LastUpdated`, `Category`, `Location`) VALUES
-- (1, 100, '2024-07-25 10:00:00', 'Electronics', 'Warehouse A'),
-- (2, 200, '2024-07-26 11:00:00', 'Clothing', 'Warehouse B');

-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
