-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2021 at 03:32 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blirumah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$N/IS54Avih5ZOjDvW8V2nOME6wqnw2QGqgn3qcQnljYEfovGLv3zy', '2021-06-14 13:04:06'),
(2, 'admin2', '$2y$10$jXsNo1ToSxaJIMm67qcceOWk.ebvjAnBre/GxUCm1V7S.Xm82nzFG', '2021-06-21 11:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `agent_name` varchar(100) NOT NULL,
  `slug_agent_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `agent_name`, `slug_agent_name`, `email`, `password`, `created_at`) VALUES
(6, 'Agent 1', 'agent-1', 'agent@gmail.com', '$2y$10$TnrlVpwcIEA6YojcAD9AX.bq6.WeVHfZndI1NgH.WF6uoATBTxHhi', '2021-06-20 11:29:01'),
(7, 'Agent 2', 'agent-2', 'agent2@gmail.com', '$2y$10$fG4LQ1hCPB27Bd4JEydFleAA61Wyl1iVzF03Fq6Ndn/mqHdUSe6IC', '2021-06-20 19:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `owner_name` text NOT NULL,
  `slug_owner_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `owner_name`, `slug_owner_name`, `email`, `password`, `created_at`) VALUES
(4, 'owner', 'owner', 'owner@gmail.com', '$2y$10$Glyj3tc3PSFTe6kUyDYou.iR.ZhsveaLiKs5WWKMhUmUJVDl/P1zm', '2021-06-20 11:29:27'),
(5, 'owner 2', 'owner-2', 'owner2@gmail.com', '$2y$10$GClt6d4wfYkKsIBKOR9R.uaIMHx2fHI20ARkoKHoc0sQ92CldSxIK', '2021-06-20 19:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `prices` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `prices`, `created_at`) VALUES
(1, 5000, '2021-06-19 09:43:10'),
(2, 8000, '2021-06-19 09:43:10'),
(3, 10000, '2021-06-19 09:43:10'),
(4, 20000, '2021-06-19 09:43:10'),
(5, 30000, '2021-06-19 09:43:10'),
(6, 40000, '2021-06-19 09:43:51'),
(7, 50000, '2021-06-19 09:43:51'),
(8, 60000, '2021-06-19 09:43:51'),
(9, 70000, '2021-06-19 09:43:51'),
(10, 80000, '2021-06-19 09:43:51'),
(11, 90000, '2021-06-19 11:07:56'),
(12, 100000, '2021-06-19 11:07:56'),
(13, 200000, '2021-06-19 11:08:12'),
(14, 300000, '2021-06-19 11:08:12'),
(15, 400000, '2021-06-20 20:12:27'),
(16, 500000, '2021-06-20 20:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `name_property` varchar(20) NOT NULL,
  `slug_agent_name` varchar(100) NOT NULL,
  `slug_owner_name` varchar(100) NOT NULL,
  `type_property` text NOT NULL,
  `sertificate` varchar(20) NOT NULL,
  `prices` int(11) NOT NULL,
  `descriptions` text NOT NULL,
  `rooms` int(11) NOT NULL,
  `pools` enum('none','1','2','3') NOT NULL,
  `address` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `status` enum('req','done') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name_property`, `slug_agent_name`, `slug_owner_name`, `type_property`, `sertificate`, `prices`, `descriptions`, `rooms`, `pools`, `address`, `images`, `status`, `created_at`) VALUES
(1, 'Hotel Rofa Kuta', 'agent-1', 'owner', 'Hotel', 'Tanah Milik Dia', 10000, 'This good places nice', 1, 'none', 'Jl. Raya Sunset Road', 'card-1.jpg', 'done', '2021-06-20 00:05:04'),
(3, 'House Seroja', 'agent-1', 'owner', 'House', 'Tanah Milik Bersama', 40000, 'oke nice places', 1, 'none', 'Jl. Raya Teukumar, Bali', 'card-4.jpg', 'done', '2021-06-20 00:07:27'),
(7, 'Oyo Sedap', 'agent-2', 'owner', 'House', 'Tanah Milik Bersama', 400000, 'Oke this is good places, to relaxing ur body', 1, 'none', 'Jalan Sedap Malam', 'card-3.jpg', 'done', '2021-06-20 19:00:01'),
(8, 'Apartment Balinesse', 'agent-1', 'owner', 'Apartment', 'Tanah Milik Bersama', 300000, 'Oke cool apartment', 4, '3', 'Jl. Raya Denpasar-Singaraja', 'card-5.jpg', 'done', '2021-06-20 19:00:46'),
(9, 'Hotel in YUKS', 'agent-1', 'owner', 'Hotel', 'Tanah Milik Dia', 500000, 'This is good hotel for ur holidays', 6, 'none', 'Jl. Raya Sunset Road', 'card-2.jpg', 'done', '2021-06-20 19:02:04'),
(10, 'Random', 'agent-2', 'owner', 'Hotel', 'Tanah Milik Dia', 6000, 'asd', 4, '3', 'Jl. Raya Sunset Road', '', 'done', '2021-06-20 21:17:03'),
(11, 'Random', 'agent-2', 'owner-2', 'Villa', 'Tanah Milik Bersama', 500000, 'Oke test', 1, '2', 'Jl. Raya Sunset Road', '', 'done', '2021-06-20 21:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `total_rooms` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `total_rooms`, `created_at`) VALUES
(1, 1, '2021-06-14 20:45:49'),
(2, 2, '2021-06-14 20:45:49'),
(3, 3, '2021-06-14 20:45:49'),
(4, 4, '2021-06-14 20:45:49'),
(5, 5, '2021-06-14 20:45:49'),
(6, 6, '2021-06-19 11:13:53'),
(7, 7, '2021-06-19 11:13:53'),
(8, 8, '2021-06-19 11:13:53'),
(9, 9, '2021-06-19 11:13:53'),
(10, 10, '2021-06-19 11:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `type_property`
--

CREATE TABLE `type_property` (
  `id` int(11) NOT NULL,
  `name_type` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_property`
--

INSERT INTO `type_property` (`id`, `name_type`, `created_at`) VALUES
(1, 'Hotel', '2021-06-14 20:46:32'),
(2, 'House', '2021-06-14 20:46:32'),
(3, 'Apartment', '2021-06-14 20:46:32'),
(4, 'Villa', '2021-06-14 20:46:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_property`
--
ALTER TABLE `type_property`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `type_property`
--
ALTER TABLE `type_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
