-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2020 at 06:26 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id15560279_blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_info`
--

CREATE TABLE `blood_info` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `blood_group` varchar(4) NOT NULL,
  `qnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_info`
--

INSERT INTO `blood_info` (`id`, `hospital_id`, `blood_group`, `qnt`) VALUES
(61, 18, 'A+', 6),
(62, 18, 'A-', 0),
(63, 18, 'B+', 1),
(64, 18, 'B-', 9),
(65, 18, 'AB+', 3),
(66, 18, 'AB-', 0),
(67, 18, 'O+', 0),
(68, 18, 'O-', 0),
(69, 19, 'A+', 4),
(70, 19, 'A-', 0),
(71, 19, 'B+', 2),
(72, 19, 'B-', 7),
(73, 19, 'AB+', 0),
(74, 19, 'AB-', 1),
(75, 19, 'O+', 0),
(76, 19, 'O-', 3),
(77, 20, 'A+', 8),
(78, 20, 'A-', 2),
(79, 20, 'B+', 7),
(80, 20, 'B-', 0),
(81, 20, 'AB+', 2),
(82, 20, 'AB-', 0),
(83, 20, 'O+', 1),
(84, 20, 'O-', 1),
(85, 21, 'A+', 0),
(86, 21, 'A-', 4),
(87, 21, 'B+', 1),
(88, 21, 'B-', 6),
(89, 21, 'AB+', 0),
(90, 21, 'AB-', 2),
(91, 21, 'O+', 0),
(92, 21, 'O-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital_name` varchar(50) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zipcode` varchar(8) NOT NULL,
  `contact_no` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `user_id`, `hospital_name`, `state`, `city`, `zipcode`, `contact_no`) VALUES
(18, 24, 'Rainbow Hospitals', 'Andhra Pradesh', 'Hyderabad', '534001', '040765616'),
(19, 26, 'Cure and Care', 'Andhra Pradesh', 'Hyderabad', '534001', '87656776787'),
(20, 27, 'National Research Hospital', 'Maharastra', 'Mumbai', '699768', '79875886897'),
(21, 28, 'Narmadha Hospitals', 'Andhra Pradesh', 'Vijayawada', '534001', '78786546788');

-- --------------------------------------------------------

--
-- Table structure for table `receiver_details`
--

CREATE TABLE `receiver_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(35) NOT NULL,
  `blood_group` varchar(6) NOT NULL,
  `age` varchar(3) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(35) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `contact_no` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiver_details`
--

INSERT INTO `receiver_details` (`id`, `user_id`, `user_name`, `blood_group`, `age`, `state`, `city`, `zipcode`, `contact_no`) VALUES
(7, 25, 'Dileep', 'B-', '21', 'Andhra Pradesh', 'Eluru', '534001', '7899876545');

-- --------------------------------------------------------

--
-- Table structure for table `receiver_requests`
--

CREATE TABLE `receiver_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blood_info_id` int(11) NOT NULL,
  `qnt` int(11) NOT NULL,
  `msg` text NOT NULL DEFAULT 'N/A',
  `req_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiver_requests`
--

INSERT INTO `receiver_requests` (`id`, `user_id`, `blood_info_id`, `qnt`, `msg`, `req_time`) VALUES
(26, 25, 64, 1, 'I am in urgent', '2020-12-02 05:56:47'),
(27, 25, 72, 1, 'N/A', '2020-12-02 06:07:31'),
(28, 25, 76, 1, 'N/A', '2020-12-02 06:07:41'),
(29, 25, 64, 1, 'N/A', '2020-12-02 06:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(1) NOT NULL DEFAULT 'R'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`) VALUES
(24, 'h1@g.com', '81dc9bdb52d04dc20036dbd8313ed055', 'H'),
(25, 'r1@g.com', '81dc9bdb52d04dc20036dbd8313ed055', 'R'),
(26, 'h2@g.com', '81dc9bdb52d04dc20036dbd8313ed055', 'H'),
(27, 'h3@g.com', '81dc9bdb52d04dc20036dbd8313ed055', 'H'),
(28, 'h4@g.com', '81dc9bdb52d04dc20036dbd8313ed055', 'H');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_info`
--
ALTER TABLE `blood_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital__blood` (`hospital_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospitals_users` (`user_id`);

--
-- Indexes for table `receiver_details`
--
ALTER TABLE `receiver_details`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `receiver_details_users` (`user_id`);

--
-- Indexes for table `receiver_requests`
--
ALTER TABLE `receiver_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver_requests` (`user_id`),
  ADD KEY `blood_info` (`blood_info_id`);

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
-- AUTO_INCREMENT for table `blood_info`
--
ALTER TABLE `blood_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `receiver_details`
--
ALTER TABLE `receiver_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receiver_requests`
--
ALTER TABLE `receiver_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_info`
--
ALTER TABLE `blood_info`
  ADD CONSTRAINT `hospital__blood` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospitals_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `receiver_details`
--
ALTER TABLE `receiver_details`
  ADD CONSTRAINT `receiver_details_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `receiver_requests`
--
ALTER TABLE `receiver_requests`
  ADD CONSTRAINT `blood_info` FOREIGN KEY (`blood_info_id`) REFERENCES `blood_info` (`id`),
  ADD CONSTRAINT `receiver_requests` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
