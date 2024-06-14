-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 02:30 AM
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
(7, 'Asli', 'Admin', '$2y$10$uykhFEI4g5XNT/a95yIhI.zfFtD7398bPpU9RpHP2WOFeDprmNd5a', 'uploads/AH.jpg', '2024-06-03 17:00:18'),
(8, 'Bile', 'Admin', '$2y$10$MQHrImL3x7DsNYNYcwTfpu7qlg8GJ2N.6qywcFqG7Io2SN/sESeS.', 'uploads/apple.png', '2024-06-04 03:51:29'),
(9, 'shaima Abdi', 'Admin', '$2y$10$XXBI0Vj2wh4AWI1D38lSguRCPMgHPj/3FrHr93f2xYelnL77OYkMq', 'uploads/carton house.png', '2024-06-04 04:13:21'),
(11, 'dalmar', 'Admin', '$2y$10$VSoOpPb/a7JrKqzTw/4lRuqZMlcllI2y.ldsPyeQeoRDV2s7duA6u', 'uploads/AH.jpg', '2024-06-04 15:27:31');

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
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `deposit_amount` float(10,2) NOT NULL,
  `deposit_date` date NOT NULL,
  `amount` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asign_project`
--

INSERT INTO `asign_project` (`id`, `project_type`, `client_name`, `phone_number`, `lead_job`, `date`, `status`, `deposit_amount`, `deposit_date`, `amount`) VALUES
(28, 'Commercial', 'Ahmed Mohamed ', '0618247098', '17', '2024-06-02', 'Completed', 1000.00, '2024-06-02', 12000.00),
(30, 'Documentary', 'asli', '252613467890', '19', '2024-06-02', 'Completed', 5000.00, '2024-06-02', 10000.00),
(31, '', '', '', '', '0000-00-00', '', 0.00, '0000-00-00', 0.00),
(32, '', '', '', '', '0000-00-00', '', 0.00, '0000-00-00', 0.00),
(33, '', '', '', '', '0000-00-00', '', 0.00, '0000-00-00', 0.00),
(34, 'Commercial', 'abdinoor', '61344556699', '22', '2024-03-06', 'Pending', 300.00, '2024-04-06', 1000.00),
(35, '', '', '', '', '0000-00-00', '', 0.00, '0000-00-00', 0.00),
(36, '', '', '', '', '0000-00-00', '', 0.00, '0000-00-00', 0.00),
(37, 'Documentary', 'Ali Ahmed', '7000999099', '16', '2024-06-10', 'Pending', 1000.00, '2024-06-08', 10000.02),
(38, 'Event', 'Maxamed Shafici Ahmed', '252613467890', '19', '2024-06-11', 'Completed', 1000.00, '2024-06-10', 30.00),
(39, 'Films', 'Shafici Mohamed Dahir', '0616557225', '22', '2024-06-10', 'Completed', 4444.00, '2024-06-09', 100.00),
(40, 'Films', 'Shafici', '7000999099', '22', '2024-06-10', 'Completed', 999.98, '2024-06-09', 600.00),
(41, 'Documentary', 'Baydan', '7000999099', '19', '2024-06-11', 'Completed', 1000.00, '2024-06-09', 300.00),
(42, 'Commercial', 'Shafici', '252613467890', '23', '2024-06-11', 'Completed', 300.00, '2024-06-10', 34.00);

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
(1, 'Ruweida', 'Muzamil', '0610111111', 'Bondhere', 'Admin', '2024-05-22', 800.00),
(6, 'Ruweida', 'Muzamil', '0610111111', 'Bondhere', 'Admin', '2024-05-26', 5000.00);

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
(11, 'Expense', 'mushaar la bixiye', 12000.00, '2024-06-02');

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
  `Date` datetime NOT NULL,
  `Salary` float(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_empl`
--

INSERT INTO `register_empl` (`empl_id`, `First_Name`, `Last_Name`, `phonenumber`, `Address`, `Role`, `Date`, `Salary`) VALUES
(16, 'Hibo', 'AbdiSalad', 2147483647, 'Shibis', 'leadjob', '2024-06-08 00:00:00', 50000),
(18, 'Ali', 'mohamed', 2147483647, 'Shibis', 'leadjob', '2024-06-08 00:00:00', 20000),
(19, 'ahmed', 'Moha', 610111111, 'Dharkeynley', 'leadjob', '2024-06-02 00:00:00', 1000),
(22, 'mohamed', 'abdifitah', 612567890, 'Abdiaziz', 'leadjob', '2024-02-04 00:00:00', 40),
(23, 'ahmed', 'dahir', 612621243, 'Kahda', 'leadjob', '2024-03-03 00:00:00', 250),
(26, 'ahmed', 'Moha', 2147483647, 'Abdiaziz', 'Admin', '2024-06-08 00:00:00', 1000),
(27, 'Ramzi', 'mohamed', 2147483647, 'Howl-wadaag', 'Admin', '2024-06-09 00:00:00', 122),
(28, 'Farah', 'Hasan', 610111111, 'Waberi', 'Admin', '2024-06-09 00:00:00', 1000),
(29, 'Ramzi', 'Moha', 779654467, 'Wadajir', 'Admin', '2024-06-10 00:00:00', 60000);

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
(7, 'Camera129', 'As12345', 'Canon', '2024-05-30', 'Out of Service', 9999.00),
(9, 'laptop', 'MAC', 'Apple', '2024-05-30', 'Active', 12000.00),
(18, '625', 'ca002M', '22', '2024-06-08', 'Maintained', 4444.00),
(19, '66777', '5667', 'sonny', '2024-06-09', 'Active', 7888.00),
(20, '46538', 'r2674', '52334', '2024-06-09', 'Maintained', 3000.00),
(21, 'llllll', '3636', 'fgkjd', '2024-06-09', 'Maintained', 43553.00);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `asign_project`
--
ALTER TABLE `asign_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `register_empl`
--
ALTER TABLE `register_empl`
  MODIFY `empl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `register_equip`
--
ALTER TABLE `register_equip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
