-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 08:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rezultati`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(50) NOT NULL,
  `round_number` int(11) NOT NULL,
  `home_team_id` int(50) NOT NULL,
  `away_team_id` int(50) NOT NULL,
  `home_team_score` int(11) NOT NULL,
  `away_team_score` int(11) NOT NULL,
  `match_time` time DEFAULT NULL,
  `match_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `round_number`, `home_team_id`, `away_team_id`, `home_team_score`, `away_team_score`, `match_time`, `match_date`) VALUES
(1, 1, 2, 20, 2, 1, '13:30:00', '2024-08-17'),
(2, 1, 1, 19, 1, 1, '16:00:00', '2024-08-17'),
(3, 1, 3, 15, 2, 0, '16:00:00', '2024-08-17'),
(4, 1, 7, 16, 1, 0, '16:00:00', '2024-08-17'),
(5, 1, 4, 14, 1, 1, '16:00:00', '2024-08-17'),
(6, 1, 5, 17, 2, 1, '18:30:00', '2024-08-17'),
(7, 1, 6, 18, 1, 0, '13:00:00', '2024-08-18'),
(8, 1, 8, 9, 1, 0, '15:00:00', '2024-08-18'),
(9, 1, 11, 10, 1, 1, '15:00:00', '2024-08-18'),
(10, 1, 12, 13, 0, 0, '17:30:00', '2024-08-18'),
(11, 2, 19, 3, 1, 2, '13:30:00', '2024-08-24'),
(12, 2, 15, 7, 0, 2, '16:00:00', '2024-08-24'),
(13, 2, 16, 4, 0, 1, '16:00:00', '2024-08-24'),
(14, 2, 14, 5, 0, 0, '16:00:00', '2024-08-24'),
(15, 2, 17, 6, 1, 2, '16:00:00', '2024-08-24'),
(16, 2, 2, 1, 1, 0, '18:30:00', '2024-08-24'),
(17, 2, 18, 8, 1, 1, '13:00:00', '2024-08-25'),
(18, 2, 9, 11, 1, 1, '15:00:00', '2024-08-25'),
(19, 2, 10, 12, 2, 1, '15:00:00', '2024-08-25'),
(20, 2, 13, 20, 0, 1, '17:30:00', '2024-08-25'),
(21, 3, 1, 3, 3, 1, '13:30:00', '2024-08-31'),
(22, 3, 2, 7, 2, 0, '16:00:00', '2024-08-31'),
(23, 3, 19, 16, 1, 1, '16:00:00', '2024-08-31'),
(24, 3, 15, 4, 1, 1, '16:00:00', '2024-08-31'),
(25, 3, 14, 8, 0, 0, '16:00:00', '2024-08-31'),
(26, 3, 17, 18, 1, 1, '18:30:00', '2024-08-31'),
(27, 3, 11, 9, 1, 0, '13:00:00', '2024-09-01'),
(28, 3, 5, 13, 2, 0, '15:00:00', '2024-09-01'),
(29, 3, 6, 10, 1, 2, '15:00:00', '2024-09-01'),
(30, 3, 12, 20, 1, 1, '17:30:00', '2024-09-01'),
(31, 4, 2, 4, 2, 2, '13:30:00', '2024-09-13'),
(32, 4, 1, 19, 1, 1, '16:00:00', '2024-09-13'),
(33, 4, 3, 15, 3, 0, '16:00:00', '2024-09-13'),
(34, 4, 7, 16, 2, 1, '16:00:00', '2024-09-13'),
(35, 4, 5, 14, 1, 0, '16:00:00', '2024-09-13'),
(36, 4, 6, 17, 0, 0, '18:30:00', '2024-09-13'),
(37, 4, 8, 11, 0, 0, '13:00:00', '2024-09-14'),
(38, 4, 9, 10, 1, 2, '15:00:00', '2024-09-14'),
(39, 4, 13, 12, 0, 2, '15:00:00', '2024-09-14'),
(40, 4, 20, 18, 1, 1, '17:30:00', '2024-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `statisticss`
--

CREATE TABLE `statisticss` (
  `stat_id` int(50) NOT NULL,
  `team_id` int(50) NOT NULL,
  `wins` int(11) DEFAULT 0,
  `losses` int(11) DEFAULT 0,
  `draws` int(11) DEFAULT 0,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statisticss`
--

INSERT INTO `statisticss` (`stat_id`, `team_id`, `wins`, `losses`, `draws`, `points`) VALUES
(1, 1, 2, 1, 1, NULL),
(2, 2, 3, 0, 1, NULL),
(3, 3, 3, 1, 0, NULL),
(4, 4, 1, 0, 3, NULL),
(5, 5, 3, 0, 1, NULL),
(6, 6, 2, 1, 1, NULL),
(7, 7, 3, 1, 0, NULL),
(8, 8, 2, 0, 2, NULL),
(9, 9, 0, 3, 1, NULL),
(10, 10, 3, 0, 1, NULL),
(11, 11, 1, 3, 0, NULL),
(12, 12, 1, 2, 1, NULL),
(13, 13, 0, 3, 1, NULL),
(14, 14, 0, 1, 3, NULL),
(15, 15, 0, 3, 1, NULL),
(16, 16, 0, 3, 1, NULL),
(17, 17, 0, 2, 2, NULL),
(18, 18, 0, 2, 2, NULL),
(19, 19, 0, 1, 3, NULL),
(20, 20, 0, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(50) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `logo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `logo_path`) VALUES
(1, 'Man City', 'mcii.jpg'),
(2, 'Liverpool', 'livv.png'),
(3, 'Chelsea', 'che.jpg'),
(4, 'Man Utd', 'munn.jpg'),
(5, 'Tottenham', 'tott.jpg'),
(6, 'Aston Villa', 'ast.jpg'),
(7, 'Southampton', 'sou.jfif'),
(8, 'Wolves', 'wol.jpg'),
(9, 'Ipswich ', 'ips.jfif'),
(10, 'West Ham', 'whu.jpg'),
(11, 'Crystal Palace', 'cry.jpg'),
(12, 'Leicester', 'lei.jfif'),
(13, 'Nottm Forest', 'nfo.jpg'),
(14, 'Fulham', 'ful.jpg'),
(15, 'Bournemount', 'bmo.jpg'),
(16, 'Arsenal', 'ars1.jpg'),
(17, 'Newcastle', 'new.jpg'),
(18, 'Brighton', 'bha.jpg'),
(19, 'Everton', 'eve.jpg'),
(20, 'Brentford', 'bre.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`),
  ADD UNIQUE KEY `match_id` (`match_id`),
  ADD UNIQUE KEY `match_id_3` (`match_id`),
  ADD UNIQUE KEY `match_id_4` (`match_id`),
  ADD UNIQUE KEY `unique_match_id` (`match_id`),
  ADD KEY `match_id_2` (`match_id`),
  ADD KEY `home_team_id` (`home_team_id`),
  ADD KEY `away_team_id` (`away_team_id`);

--
-- Indexes for table `statisticss`
--
ALTER TABLE `statisticss`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `stat_id` (`stat_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `team_name` (`team_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`home_team_id`) REFERENCES `statisticss` (`team_id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`away_team_id`) REFERENCES `statisticss` (`team_id`);

--
-- Constraints for table `statisticss`
--
ALTER TABLE `statisticss`
  ADD CONSTRAINT `statisticss_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
