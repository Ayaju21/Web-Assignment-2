-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 11:55 PM
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
-- Database: `ticketsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `ticket_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `issue_description` text DEFAULT NULL,
  `urgency_level` varchar(20) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` varchar(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `urgency_level` enum('Low','Medium','High') NOT NULL,
  `date_submitted` date NOT NULL,
  `status` enum('Pending','Assigned','Completed') NOT NULL,
  `assigned_to` varchar(100) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `customer_name`, `email`, `location`, `description`, `urgency_level`, `date_submitted`, `status`, `assigned_to`, `photo_url`) VALUES
('#001', 'John Smith', 'john.smith@example.com', '123 Main Street, New York', 'Fixing a leaky faucet', 'High', '2024-12-01', 'Pending', 'Chris Hourny', 'images/staff.jpeg'),
('#002', 'Emma Johnson', 'emma.johnson@example.com', '456 Oak Avenue, Chicago', 'Repairing a broken air conditioner', 'Medium', '2024-12-02', 'Assigned', 'James Taylor', 'images/staff.jpeg'),
('#003', 'Michael Brown', 'michael.brown@example.com', '789 Pine Road, San Francisco', 'Fixing a water leak', 'High', '2024-12-03', 'Completed', 'Laura Davis', 'images/staff.jpeg'),
('#004', 'Sophia Williams', 'sophia.williams@example.com', '101 Maple Lane, Boston', 'Elevator maintenance', 'Low', '2024-12-04', 'Pending', 'Tommy Haz', 'images/staff.jpeg'),
('#005', 'Olivia Davis', 'olivia.davis@example.com', '202 Elm Street, Los Angeles', 'Electrical wiring issue', 'Medium', '2024-12-05', 'Pending', 'Billie Eilish', 'images/staff.jpeg'),
('#006', 'Liam Martinez', 'liam.martinez@example.com', '303 Birch Avenue, Dallas', 'Broken window repair', 'Low', '2024-12-06', 'Assigned', 'Emma Taylor', 'images/staff.jpeg'),
('#007', 'Isabella Garcia', 'isabella.garcia@example.com', '404 Willow Lane, Houston', 'Ceiling fan installation', 'Medium', '2024-12-07', 'Completed', 'Noah Wilson', 'images/staff.jpeg'),
('#008', 'Noah Martinez', 'noah.martinez@example.com', '505 Aspen Road, Miami', 'Carpentry work', 'High', '2024-12-08', 'Pending', 'Selena Lo', 'images/staff.jpeg'),
('#009', 'Mia Rodriguez', 'mia.rodriguez@example.com', '606 Cedar Street, Denver', 'Heating system repair', 'High', '2024-12-09', 'Assigned', 'Sophia Brown', 'images/staff.jpeg'),
('#010', 'Ava Harris', 'ava.harris@example.com', '707 Spruce Avenue, Atlanta', 'Water heater maintenance', 'Medium', '2024-12-10', 'Completed', 'Olivia Green', 'images/staff.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('manager','customer','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(47, 'Manager 1', 'manager@maktoob.com', 'comp@334', 'manager'),
(48, 'Manager 2', 'manager2@maktoob.com', 'comp@334', 'manager'),
(49, 'Manager 3', 'manager3@maktoob.com', 'comp@334', 'manager'),
(50, 'Customer 1', 'cust@maktoob.com', 'comp#334', 'customer'),
(51, 'Customer 2', 'cust2@maktoob.com', 'comp#334', 'customer'),
(52, 'Customer 3', 'cust3@maktoob.com', 'comp#334', 'customer'),
(53, 'Customer 4', 'cust4@maktoob.com', 'comp#334', 'customer'),
(54, 'Customer 5', 'cust5@maktoob.com', 'comp#334', 'customer'),
(55, 'Customer 6', 'cust6@maktoob.com', 'comp#334', 'customer'),
(56, 'Customer 7', 'cust7@maktoob.com', 'comp#334', 'customer'),
(57, 'Customer 8', 'cust8@maktoob.com', 'comp#334', 'customer'),
(58, 'Customer 9', 'cust9@maktoob.com', 'comp#334', 'customer'),
(59, 'Customer 10', 'cust10@maktoob.com', 'comp#334', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1733957119;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
