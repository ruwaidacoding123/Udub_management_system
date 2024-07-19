-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 07:56 AM
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
-- Database: `ums`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `role`, `password`, `image`, `created_at`) VALUES
(7, 'Admin', 'Admin', '$2y$10$uykhFEI4g5XNT/a95yIhI.zfFtD7398bPpU9RpHP2WOFeDprmNd5a', 'uploads/AH.jpg', '2024-06-03 17:00:18'),
(8, 'Bile', 'Admin', '$2y$10$MQHrImL3x7DsNYNYcwTfpu7qlg8GJ2N.6qywcFqG7Io2SN/sESeS.', 'uploads/apple.png', '2024-06-04 03:51:29'),
(11, 'dalmar', 'Admin', '$2y$10$VSoOpPb/a7JrKqzTw/4lRuqZMlcllI2y.ldsPyeQeoRDV2s7duA6u', 'uploads/AH.jpg', '2024-06-04 15:27:31'),
(12, 'admin', 'Admin', '$2y$10$8RNrG4CHpX0SBNMVW./Mx.hkh4sAVVxqx1dnM2BlyDtZBRWFPO9si', 'uploads/black hair.jpg', '2024-06-19 18:05:19'),
(13, 'shaima', 'Admin', '$2y$10$ZsEJ3ogDQS3fuQengWwEJeFxN0TqV.yO.PT4SgSIr6wX2eYuV92hq', 'uploads/ahmed.jpeg', '2024-06-20 21:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `asign_project`
--

CREATE TABLE `asign_project` (
  `id` int(11) NOT NULL,
  `project_type` varchar(50) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `lead_job` varchar(100) NOT NULL,
  `reg_date` date NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `deposit_amount` float(10,2) NOT NULL,
  `deposit_date` date NOT NULL,
  `amount` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asign_project`
--

INSERT INTO `asign_project` (`id`, `project_type`, `client_name`, `phone_number`, `lead_job`, `reg_date`, `date`, `status`, `deposit_amount`, `deposit_date`, `amount`) VALUES
(69, 'Films', 'Baydan', '0618247098', '59', '2024-06-24', '2024-06-24', 'Completed', 50.00, '2024-06-24', 100.00),
(70, 'Documentary', 'Ruweida Muzamil', '0618247098', '59', '2024-06-24', '2024-06-24', 'Pending', 60.00, '2024-06-24', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `Expenses` varchar(40) NOT NULL,
  `Salary` decimal(10,0) NOT NULL,
  `rc_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `salary` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `phone_number`, `address`, `role`, `date`, `salary`) VALUES
(1, 'Ruweida', 'Muzamil', '0610111111', 'Bondhere', 'Admin', '2024-05-22', 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `empl_role`
--

CREATE TABLE `empl_role` (
  `empl_role_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Permission` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(11) NOT NULL,
  `entry_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `entry_type`, `description`, `amount`, `date`) VALUES
(2, 'Expense', 'mushaar la qaatay', 3300.00, '2024-04-06'),
(3, 'Other', 'sadaqo', 1200.00, '2024-05-27'),
(11, 'Expense', 'mushaar la bixiye', 12000.00, '2024-06-02'),
(12, 'Expense', 'Something', 100.00, '2024-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `maintainance`
--

CREATE TABLE `maintainance` (
  `maintainance_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `maintained_date` datetime NOT NULL,
  `euip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `record_finances`
--

CREATE TABLE `record_finances` (
  `rc_no` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Entry_Type` varchar(50) DEFAULT NULL,
  `Amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register_empl`
--

CREATE TABLE `register_empl` (
  `empl_id` int(11) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Salary` float(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_empl`
--

INSERT INTO `register_empl` (`empl_id`, `First_Name`, `Last_Name`, `phonenumber`, `Address`, `Role`, `Date`, `Salary`) VALUES
(57, 'shaima', 'Muzamil', 614478794, 'Abdiaziz', 'Admin', '2024-06-24', 40),
(59, 'shaima', 'Abdi', 614478794, 'Abdiaziz', 'leadjob', '2024-06-25', 200),
(60, 'Mohamed', 'Shuute', 614478794, 'Abdiaziz', 'Staff', '2024-06-25', 200);

-- --------------------------------------------------------

--
-- Table structure for table `register_equip`
--

CREATE TABLE `register_equip` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `date_acquired` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_equip`
--

INSERT INTO `register_equip` (`id`, `name`, `model`, `manufacturer`, `date_acquired`, `status`, `price`) VALUES
(1, 'Digital', 'ca002M', 'sonny', '2024-05-09', 'Active', 699.00),
(9, 'laptop', 'MAC', 'Apple', '2024-05-30', 'Active', 12000.00),
(23, 'Digital', 'ca002M', 'HP', '2024-06-23', 'Active', 500.00),
(24, 'Digital', 'As12345', 'sonny', '2024-06-23', 'Active', 400.00),
(25, 'Digital', 'ca002M', 'sonny', '2024-06-24', 'Active', 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`, `image`) VALUES
(1, 'admin', 'Admin', '$2y$10$qbVNwSdZ6r1eF34RRwnGgeRilxaeLEenfEBKkmaUDozLdUJN5vcya', 'white-logo.ico'),
(6, 'Sahal', 'Admin', 'f37466219229ba5c6aa25af05342e8ff', 'camera.jpg'),
(20, 'Abdi', 'Admin', '$2y$10$jgVbjpUqY17BTdSHHclw..vZgyWRfrG6XVLzER/eY8/Ivp6Yal8nm', 'camera.jpg'),
(23, 'luzako', 'Admin', '$2y$10$pRX36DDoXoes2H9ixUtw6O6rDGx.Fx.iUP.w4pTxJRfglWe4y5DUa', 'luzako.jpg'),
(24, 'shafici', 'Admin', '$2y$10$Zg7QBBB1X8FGQofGW1c5e.mdN.gVgqR4.o3ICsUk.SZxwdfPZg3ca', ''),
(25, 'najma', 'Admin', '$2y$10$.jGz8SNYLSMKeyKlQmLfFuq8mgOsuiiQYdqrbGobAit1lxXAAkDf.', ''),
(26, 'shuute', 'Admin', '$2y$10$u4wLF./IOHas1DPZKsAnSOSIjymIYd765l79ziWeB77vUOUaw9YHS', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asign_project`
--
ALTER TABLE `asign_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_empl`
--
ALTER TABLE `register_empl`
  ADD PRIMARY KEY (`empl_id`);

--
-- Indexes for table `register_equip`
--
ALTER TABLE `register_equip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `asign_project`
--
ALTER TABLE `asign_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `register_empl`
--
ALTER TABLE `register_empl`
  MODIFY `empl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `register_equip`
--
ALTER TABLE `register_equip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
