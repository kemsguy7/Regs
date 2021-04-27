-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2021 at 10:46 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fecamds`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cat` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `cat`, `description`) VALUES
(1, '4rty4', 'Html', 'rtrtr'),
(3, 'Matthew Idungafa', 'Javascript', 'Third course'),
(4, 'images', 'Html', 'Dummy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(13) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `registration_date` varchar(50) DEFAULT NULL,
  `active` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `birthday`, `gender`, `email`, `phone`, `password`, `department`, `level`, `role`, `profile_pic`, `registration_date`, `active`) VALUES
(1, 'Nyenime Address', NULL, NULL, NULL, 'dominicamos7@gmail.com', NULL, '279277a093', NULL, NULL, NULL, NULL, 'April-26-2021 11:24:09', '0'),
(7, 'Nyenime Address', NULL, NULL, NULL, 'dominicamos7wfw@gmail.com', NULL, 'c78b6663d47cfbdb4d65ea51c104044e', NULL, NULL, NULL, NULL, 'April-26-2021 12:34:15', '4abfabbf6fc34a3766137b7aab4f464f'),
(8, 'Nyenime Address', NULL, NULL, NULL, 'dominicamos7vb@gmail.com', NULL, 'a001f972cedca49d3c062e82c2b5ecf4', NULL, NULL, NULL, NULL, 'April-26-2021 12:36:29', NULL),
(9, 'Matthew Idungafa', NULL, NULL, NULL, 'b@gmail.com', NULL, 'c78b6663d47cfbdb4d65ea51c104044e', NULL, NULL, NULL, NULL, 'April-26-2021 14:04:54', NULL),
(10, 'Matthew Idungafa', NULL, NULL, NULL, 'b3@gmail.com', NULL, 'a9b577b54775d3cb1a8cda14225d3f60', NULL, NULL, NULL, NULL, 'April-26-2021 14:11:16', NULL),
(11, 'Matthew John', NULL, NULL, NULL, 'matt@gmail.com', NULL, 'c78b6663d47cfbdb4d65ea51c104044e', NULL, NULL, NULL, NULL, 'April-26-2021 14:40:03', NULL),
(12, 'donald', NULL, NULL, NULL, 'donald@gmail.com', NULL, '41f12a252dde06d4a658e881b9425b74', NULL, NULL, NULL, NULL, 'April-26-2021 17:09:58', NULL),
(13, 'Nyenime Address', NULL, NULL, NULL, 'dominicamos7rgrgr@gmail.com', NULL, 'a001f972cedca49d3c062e82c2b5ecf4', NULL, NULL, NULL, NULL, 'April-27-2021 14:24:19', 'd2dcec81d42fe597c31fce708d7814a5'),
(14, 'Rex King', NULL, NULL, NULL, 'rex@gmail.com', NULL, '7fc66cb2563de8d1bbce4f26258539f6', NULL, NULL, NULL, NULL, 'April-27-2021 14:26:56', '4fb13a4d69875692b1523e594ca35869'),
(15, 'xer', NULL, NULL, NULL, 'xer@gmail.com', NULL, 'c78b6663d47cfbdb4d65ea51c104044e', NULL, NULL, NULL, NULL, 'April-27-2021 14:28:09', NULL),
(16, 'kk', NULL, NULL, NULL, 'kk@gmail.com', NULL, 'c78b6663d47cfbdb4d65ea51c104044e', NULL, NULL, NULL, NULL, 'April-27-2021 19:37:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
