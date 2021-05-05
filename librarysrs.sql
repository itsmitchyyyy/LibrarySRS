-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 12:34 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarysrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `ddc` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `edition_number` varchar(255) NOT NULL,
  `place_of_publication` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `ddc`, `description`, `category_id`, `author`, `edition_number`, `place_of_publication`, `publisher`, `copyright`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Book title', 'Descriptionaaaajjj', 2, 'Author', '1212', 'bisag asa', 'bisag aaaa', '12', 'published', '2021-04-20 14:57:04', '2021-05-05 11:05:42'),
(2, 'zxc', 'zxczxczxc', 0, 'zxc', '12121', 'asasd', 'asasdasd', '111', 'disabled', '2021-04-20 15:03:09', '2021-04-20 15:45:18'),
(3, 'Book title', 'qqq', 0, 'Author', '12121', 'asasd', 'bisag aaaa', '12', 'disabled', '2021-04-20 15:45:32', '2021-04-20 15:54:08'),
(4, 'zxczxczxczxqqqqq', 'casdasd', 0, 'Author', '12121', 'asasd', 'asasdasd', '12', 'disabled', '2021-04-20 15:46:01', '2021-04-20 16:21:07'),
(5, 'With Category', 'With Category Description', 2, 'With Category Author', '1212121212', 'bisag asa', 'si aaaa', '12', 'published', '2021-05-05 10:38:48', '2021-05-05 11:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `ddc` int(11) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `ddc`, `alias`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1212, 'Category 1', 'Alias 1', 'Description 111111', '2021-04-20 14:38:19', '2021-04-20 14:38:19'),
(2, 11111, 'Category 2', 'Alias 2', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2021-04-20 14:42:55', '2021-04-20 14:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `library_staffs`
--

CREATE TABLE `library_staffs` (
  `id` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `contact_number` int(20) NOT NULL,
  `course` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library_staffs`
--

INSERT INTO `library_staffs` (`id`, `id_number`, `first_name`, `middle_name`, `last_name`, `contact_number`, `course`, `email`, `status`, `created_at`, `updated_at`) VALUES
(254, 123456, 'sven', 'q', 'santul', 912412323, 'BSIT', 'sven_puerto@yahoo.com.ph', 'active', '2021-05-05 10:55:26', '2021-05-05 10:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penalties`
--

INSERT INTO `penalties` (`id`, `amount`, `due_date`, `created_at`, `updated_at`) VALUES
(1, '0', NULL, '2021-05-05 21:50:23', '2021-05-05 21:50:23'),
(2, '0', NULL, '2021-05-05 21:51:18', '2021-05-05 21:51:18'),
(3, '0', NULL, '2021-05-05 21:51:51', '2021-05-05 21:51:51'),
(4, '49', '2021-04-30 16:00:00', '2021-05-05 21:52:17', '2021-05-05 22:15:26'),
(5, '0', NULL, '2021-05-05 22:16:16', '2021-05-05 22:16:16'),
(6, '0', NULL, '2021-05-05 22:28:48', '2021-05-05 22:28:48'),
(7, '0', NULL, '2021-05-05 22:29:35', '2021-05-05 22:29:35'),
(8, '0', NULL, '2021-05-05 22:29:59', '2021-05-05 22:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `approver_id` int(11) NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `return_date` timestamp NULL DEFAULT NULL,
  `penalty_id` int(11) DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `book_id`, `user_id`, `approver_id`, `approved_by`, `status`, `return_date`, `penalty_id`, `approved_date`, `created_at`, `updated_at`) VALUES
(1, 1, 259, 254, 'sven', 'approved', '2021-04-21 10:46:56', 0, '2021-05-05 05:09:12', '2021-04-21 14:51:47', '2021-04-21 14:51:47'),
(2, 5, 259, 0, 'admin', 'approved', NULL, 0, '2021-05-05 05:11:51', '2021-05-05 11:11:15', '2021-05-05 11:11:15'),
(6, 5, 259, 0, 'admin', 'approved', NULL, 4, '2021-05-01 16:08:16', '2021-05-05 21:52:17', '2021-05-05 21:52:17'),
(7, 5, 259, 0, '', 'pending', NULL, 5, NULL, '2021-05-05 22:16:16', '2021-05-05 22:16:16'),
(8, 5, 265, 0, '', 'pending', NULL, 8, NULL, '2021-05-05 22:29:59', '2021-05-05 22:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Library Staff'),
(3, 'Teacher'),
(4, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `contact_number` int(20) NOT NULL,
  `course` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `id_number`, `first_name`, `middle_name`, `last_name`, `contact_number`, `course`, `email`, `status`, `created_at`, `updated_at`) VALUES
(253, 12345651, 'asasdad', 'qwe', 'qqwewqzzz', 123123, 'qqwewq', 'emailasdasdasdaddress@gmail.com', 'active', '2021-04-21 14:23:39', '2021-04-21 16:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `id_number`, `first_name`, `middle_name`, `last_name`, `email`, `department`, `contact_number`, `status`, `created_at`, `updated_at`) VALUES
(4, 2147483647, 'svenz', 'q', 'santul', 'sven_puerto@yahoo.com.ph', 'BSIT', '912412323', 'active', '2021-05-05 22:20:49', '2021-05-05 22:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(259, '12345651', '$2y$10$DwMwPDLAxdXNOoX/RuYEDeisaan7S62LNU3JizfnsOZCXv8xmouvC', 'students', 253, 'active', '2021-04-21 14:23:39', '2021-04-21 14:23:39'),
(263, 'test', '$2y$10$2P4scTxcxUsuvO3SPCVVP.gnHKj9Wn.Oy3QN/M36s59zrVXnNAopy', 'admin', 0, 'active', '2021-05-05 10:33:20', '2021-05-05 10:33:20'),
(264, '123456', '$2y$10$vX92iXteF/jKnzq66EG.9u5Z5VH3tXsAxjVu3akRVB5igJsvC/sCu', 'staff', 254, 'active', '2021-05-05 10:55:26', '2021-05-05 10:55:26'),
(265, '2147483647', '$2y$10$K9nfuNiFq10xjLPgvkX33eixTVKmTGOiKxvy0E8.QZj1.PX3EVl1.', 'teachers', 4, 'active', '2021-05-05 22:20:49', '2021-05-05 22:20:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_staffs`
--
ALTER TABLE `library_staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `library_staffs`
--
ALTER TABLE `library_staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
