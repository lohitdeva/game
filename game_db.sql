-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 12:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_db`
--

CREATE DATABASE IF NOT EXISTS `game_db`
CHARSET utf8mb4
COLLATE utf8mb4_general_ci

-- --------------------------------------------------------

--
-- Table structure for table `hangman-game-scores`
--

CREATE TABLE `hangman-game-scores` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reaction-game-scores`
--

CREATE TABLE `reaction-game-scores` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hangman-game-scores`
--
ALTER TABLE `hangman-game-scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `reaction-game-scores`
--
ALTER TABLE `reaction-game-scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `uname` (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hangman-game-scores`
--
ALTER TABLE `hangman-game-scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reaction-game-scores`
--
ALTER TABLE `reaction-game-scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hangman-game-scores`
--
ALTER TABLE `hangman-game-scores`
  ADD CONSTRAINT `hangman-game-scores` FOREIGN KEY (`uname`) REFERENCES `users` (`uname`);

--
-- Constraints for table `reaction-game-scores`
--
ALTER TABLE `reaction-game-scores`
  ADD CONSTRAINT `uname` FOREIGN KEY (`uname`) REFERENCES `users` (`uname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
