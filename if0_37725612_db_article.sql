-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql100.infinityfree.com
-- Generation Time: Feb 24, 2025 at 11:46 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37725612_db_article`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `field` varchar(200) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` bit(1) NOT NULL DEFAULT b'1',
  `profile_pic` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `name`, `email`, `field`, `password`, `time`, `status`, `profile_pic`) VALUES
(2, 'Admin', 'Admin@gmail.com', 'Marketing', '$2y$10$rw1UMtBaOn3lmsWJDwSP6.ge91nQd0DjWi4xB1GHkl.8y3WxnQO7S', '2024-11-12 13:33:24', b'1', '/Article/css/image/profile_6733b115641a37.65016901.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `useremail` varchar(100) NOT NULL,
  `comment` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `form_id`, `useremail`, `comment`) VALUES
(1, 3, 'duakhanwazir@gmail.com', 'OK'),
(2, 3, 'duakhanwazir@gmail.com', ''),
(3, 3, 'duakhanwazir@gmail.com', 'NO'),
(4, 3, 'duakhanwazir@gmail.com', 'Working OK SIR'),
(5, 3, 'duakhanwazir@gmail.com', 'AllahHamdoleAllah'),
(6, 25, 'duakhanwazir@gmail.com', 'OK'),
(7, 25, 'duakhanwazir@gmail.com', 'OK shoki'),
(8, 25, 'duakhanwazir@gmail.com', 'Janab'),
(9, 27, 'duakhanwazir@gmail.com', 'Too Good But...'),
(10, 29, 'duakhanwazir@gmail.com', 'hgjgjhgjh'),
(11, 1, 'duakhanwazir@gmail.com', 'pk');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form`
--

CREATE TABLE `tbl_form` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `abstract` varchar(250) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `useremail` varchar(100) DEFAULT NULL,
  `authers` varchar(1000) DEFAULT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_likes`
--

CREATE TABLE `tbl_likes` (
  `id` int(11) NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `useremail` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `field` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `profile_pic` varchar(2000) DEFAULT NULL,
  `university` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `field`, `password`, `time`, `status`, `profile_pic`, `university`) VALUES
(2, 'Name 1', 'user1@example.com', 'Field 1', 'password123', '2024-11-13 13:26:26', 1, 'profile1.jpg', NULL),
(3, 'Name 2', 'user2@example.com', 'Field 2', 'password456', '2024-11-13 13:26:26', 0, 'profile2.jpg', NULL),
(4, 'Name 3', 'user3@example.com', 'Field 3', 'password789', '2024-11-13 13:26:26', 1, 'profile3.jpg', NULL),
(5, 'Name 4', 'user4@example.com', 'Field 4', 'password101', '2024-11-13 13:26:26', 0, 'profile4.jpg', NULL),
(6, 'Name 5', 'user5@example.com', 'Field 5', 'password112', '2024-11-13 13:26:26', 1, 'profile5.jpg', NULL),
(7, 'Name 6', 'user6@example.com', 'Field 6', 'password131', '2024-11-13 13:26:26', 0, 'profile6.jpg', NULL),
(8, 'Name 7', 'user7@example.com', 'Field 7', 'password415', '2024-11-13 13:26:26', 1, 'profile7.jpg', NULL),
(9, 'Name 8', 'user8@example.com', 'Field 8', 'password161', '2024-11-13 13:26:26', 0, 'profile8.jpg', NULL),
(10, 'Name 9', 'user9@example.com', 'Field 9', 'password718', '2024-11-13 13:26:26', 1, 'profile9.jpg', NULL),
(11, 'Name 10', 'user10@example.com', 'Field 10', 'password192', '2024-11-13 13:26:26', 0, 'profile10.jpg', NULL),
(12, 'Name 11', 'user11@example.com', 'Field 11', 'password202', '2024-11-13 13:26:26', 1, 'profile11.jpg', NULL),
(13, 'Name 12', 'user12@example.com', 'Field 12', 'password212', '2024-11-13 13:26:26', 0, 'profile12.jpg', NULL),
(14, 'Name 13', 'user13@example.com', 'Field 13', 'password222', '2024-11-13 13:26:26', 1, 'profile13.jpg', NULL),
(15, 'Name 14', 'user14@example.com', 'Field 14', 'password232', '2024-11-13 13:26:26', 0, 'profile14.jpg', NULL),
(16, 'Name 15', 'user15@example.com', 'Field 15', 'password242', '2024-11-13 13:26:26', 1, 'profile15.jpg', NULL),
(17, 'Name 16', 'user16@example.com', 'Field 16', 'password252', '2024-11-13 13:26:26', 0, 'profile16.jpg', NULL),
(18, 'Name 17', 'user17@example.com', 'Field 17', 'password262', '2024-11-13 13:26:26', 1, 'profile17.jpg', NULL),
(19, 'Name 18', 'user18@example.com', 'Field 18', 'password272', '2024-11-13 13:26:26', 0, 'profile18.jpg', NULL),
(20, 'Name 19', 'user19@example.com', 'Field 19', 'password282', '2024-11-13 13:26:26', 1, 'profile19.jpg', NULL),
(21, 'Name 20', 'user20@example.com', 'Field 20', 'password292', '2024-11-13 13:26:26', 0, 'profile20.jpg', NULL),
(22, 'shahab', 'shahabmahsood12345@gmail.com', 'computer_science', '$2y$10$fouzXzw5J7OIbQHpCf5.d.5NfqpQchPk.la3c.PaqB/KG3UnT6TkW', '2024-11-14 04:24:29', 1, '/Article/css/image/profile_6735c1cd874331.09440662.png', NULL),
(24, 'Muhammad Junaid', 'duakhanwazir@gmail.com', 'marketing', '$2y$10$Z4LFHbOQmtDVa7uYjwOUlOs9cOr4vdbyibsQIsjr.EXPXXk3N2c3m', '2024-11-16 08:15:14', 1, '/Article/css/image/profile_67389ae296d613.65039786.png', 'Qurtaba');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_form`
--
ALTER TABLE `tbl_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_useremail_form` (`useremail`),
  ADD KEY `idx_id_form` (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_id_order` (`id`),
  ADD KEY `idx_status_useremail` (`status`,`useremail`);
ALTER TABLE `tbl_form` ADD FULLTEXT KEY `idx_title_fulltext` (`title`);

--
-- Indexes for table `tbl_likes`
--
ALTER TABLE `tbl_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_likes_id` (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email_users` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_form`
--
ALTER TABLE `tbl_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_likes`
--
ALTER TABLE `tbl_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
