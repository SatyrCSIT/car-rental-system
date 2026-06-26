-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 06:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_carrent`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_phone` varchar(10) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_address` text NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_name`, `admin_phone`, `admin_email`, `admin_address`, `admin_password`) VALUES
(1, 'admin', 'admin', '0855179886', 'admin@gmail.com', 'พิษณุโลก', '$2y$10$SJpiF5s.o5aogx8yAZ01fudhtw/6kz3VlEbGcqBpAC.sI/056bja.');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(100) NOT NULL,
  `car_nameplate` varchar(50) NOT NULL,
  `car_img` varchar(255) NOT NULL,
  `ac_price` decimal(10,2) NOT NULL,
  `ac_price_per_day` decimal(10,2) NOT NULL,
  `non_ac_price_per_day` decimal(10,2) NOT NULL,
  `car_availability` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `car_name`, `car_nameplate`, `car_img`, `ac_price`, `ac_price_per_day`, `non_ac_price_per_day`, `car_availability`, `type_id`) VALUES
(1, 'Toyota Alphard', 'กข1234', 'uploads/original-1642142160959.png', 300.00, 1500.00, 15000.00, 'รถว่างให้เช่า', 4),
(2, 'Honda Wave 110i', 'กง5555', 'uploads/Untitled-7.png', 100.00, 500.00, 3000.00, 'รถไม่ว่างให้เช่า', 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

CREATE TABLE `car_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`type_id`, `type_name`) VALUES
(1, 'มอเตอร์ไซต์'),
(2, 'รถเก๋ง'),
(3, 'รถกระบะ'),
(4, 'รถตู้'),
(5, 'รถพิเศษ');

-- --------------------------------------------------------

--
-- Table structure for table `clientcars`
--

CREATE TABLE `clientcars` (
  `clientcar_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `client_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientcars`
--

INSERT INTO `clientcars` (`clientcar_id`, `car_id`, `client_username`) VALUES
(1, 2, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
(1, 'test', 'test01 test01', '0011224455', 'test01@gmail.com', 'test01', '$2y$10$8mX5uyvFL1txV5ILPineqOnZBcrNoA5CBDuzwl4xnuOLhMHo/8csa');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `name`, `e_mail`, `message`, `created_at`) VALUES
(1, 'test test', 'test@gmail.com', 'test', '2025-06-21 16:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `rentedcars`
--

CREATE TABLE `rentedcars` (
  `rent_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `rent_start_date` datetime NOT NULL,
  `rent_end_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `return_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentedcars`
--

INSERT INTO `rentedcars` (`rent_id`, `car_id`, `customer_username`, `rent_start_date`, `rent_end_date`, `total_amount`, `return_status`) VALUES
(1, 2, 'test', '2025-06-21 23:04:00', '2025-06-23 23:04:00', 1000.00, 'จองสำเร็จ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `car_type`
--
ALTER TABLE `car_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `clientcars`
--
ALTER TABLE `clientcars`
  ADD PRIMARY KEY (`clientcar_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `client_username` (`client_username`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_username` (`customer_username`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `rentedcars`
--
ALTER TABLE `rentedcars`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `customer_username` (`customer_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `car_type`
--
ALTER TABLE `car_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clientcars`
--
ALTER TABLE `clientcars`
  MODIFY `clientcar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rentedcars`
--
ALTER TABLE `rentedcars`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `car_type` (`type_id`);

--
-- Constraints for table `clientcars`
--
ALTER TABLE `clientcars`
  ADD CONSTRAINT `clientcars_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`),
  ADD CONSTRAINT `clientcars_ibfk_2` FOREIGN KEY (`client_username`) REFERENCES `customers` (`customer_username`);

--
-- Constraints for table `rentedcars`
--
ALTER TABLE `rentedcars`
  ADD CONSTRAINT `rentedcars_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`),
  ADD CONSTRAINT `rentedcars_ibfk_2` FOREIGN KEY (`customer_username`) REFERENCES `customers` (`customer_username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
