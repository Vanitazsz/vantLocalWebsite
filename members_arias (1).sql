-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 05:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `members_arias`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(6) UNSIGNED NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `psword` char(255) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `user_level` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `psword`, `registration_date`, `user_level`) VALUES
(1, 'admin', 'admin', 'admin@admin', '$2y$10$TFms0I8KN6qhgC4quf8txu2WChmDEu9tWoLX0Wn5tu60WTTTzyG86', '2024-12-11 13:22:42', '1'),
(10, 'Lhanz', 'Arias', 'ariaslhanzjoshua@gmail.com', '1234ARIAS', '2024-11-13 19:45:08', '0'),
(11, 'shan', 'gealone', 'shang@warhammer.net', 'empire', '2024-11-13 22:10:59', '0'),
(14, 'a', 'b', 'c@d', 'ee', '2024-12-11 13:23:12', '0'),
(15, 'a', 'a', 'aa@aa', 'aa', '2024-12-11 13:25:18', '0'),
(19, 'bb', 'bb', 'bb@bb', '$2y$10$owFTt48qHgNxvelgDHdphuaGUC.fYC0XDwLqNX9lFM2paAPsUIMu6', '2024-12-11 14:03:20', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
