-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 07:07 AM
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
-- Database: `meeting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tb`
--

CREATE TABLE `attendance_tb` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `meetingId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delegate_tb`
--

CREATE TABLE `delegate_tb` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_number` int(11) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delegate_tb`
--

INSERT INTO `delegate_tb` (`id`, `name`, `id_number`, `Country`, `Position`, `Email`) VALUES
(54, 'Jane McCorry', 12345678, 'Tanzania', 'Manager', 'jane@gmail.commm'),
(55, 'Felix McCorry', 13572468, 'Sudan', 'Manager', 'feloh@fg.fg');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_schedule_tb`
--

CREATE TABLE `meeting_schedule_tb` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `meeting_name` varchar(255) NOT NULL,
  `meeting_place` varchar(100) NOT NULL,
  `meeting_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `speaker_tb`
--

CREATE TABLE `speaker_tb` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_number` int(11) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `speaker_tb`
--

INSERT INTO `speaker_tb` (`id`, `name`, `id_number`, `Country`, `Position`, `topic`, `Email`) VALUES
(11, 'Robert Oigara', 67854321, 'Kenya', 'Manager', 'ICT', 'rober@gmail.commmm'),
(12, 'Jay Jay Okocha', 789065432, 'Kenya', 'Staff', 'AI', 'okocha@gmail.commm');

-- --------------------------------------------------------

--
-- Table structure for table `support_tb`
--

CREATE TABLE `support_tb` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_number` int(11) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_tb`
--

INSERT INTO `support_tb` (`id`, `name`, `id_number`, `Position`, `Email`, `Country`) VALUES
(30, 'Alberto DelRio', 54321678, 'Manager', 'albertdigara@gmail.commmm', 'Kenya'),
(31, 'Feloh Bonty', 98765432, 'Staff', 'asp@ggd.bb', 'Somalia');

-- --------------------------------------------------------

--
-- Table structure for table `vip_tb`
--

CREATE TABLE `vip_tb` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_number` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `Position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vip_tb`
--

INSERT INTO `vip_tb` (`id`, `name`, `id_number`, `Email`, `Country`, `Position`) VALUES
(26, 'Nizzah Fatuma', 87654321, 'fatuma@gmail.commmm', 'Kenya', 'Manager'),
(27, 'Cynthia Fatuma', 24681357, 'f21@hg.fg', 'Uganda', 'Staff'),
(28, 'Jane Robert', 45362617, 'jj@gmail.com', 'Ethiopia', 'Staff'),
(29, 'Alphonce ', 44354566, 'fggg2g@bdfbv.fg', 'Tanzania', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_tb`
--
ALTER TABLE `attendance_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delegate_tb`
--
ALTER TABLE `delegate_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_schedule_tb`
--
ALTER TABLE `meeting_schedule_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speaker_tb`
--
ALTER TABLE `speaker_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `SupportId` (`id_number`);

--
-- Indexes for table `support_tb`
--
ALTER TABLE `support_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `SupportId` (`id_number`);

--
-- Indexes for table `vip_tb`
--
ALTER TABLE `vip_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `VIPId` (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_tb`
--
ALTER TABLE `attendance_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delegate_tb`
--
ALTER TABLE `delegate_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `meeting_schedule_tb`
--
ALTER TABLE `meeting_schedule_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `speaker_tb`
--
ALTER TABLE `speaker_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `support_tb`
--
ALTER TABLE `support_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `vip_tb`
--
ALTER TABLE `vip_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
