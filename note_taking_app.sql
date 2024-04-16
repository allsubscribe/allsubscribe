-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 10:40 PM
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
-- Database: `note_taking_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES
(2, 1, 'No matter jow dark ur past with christ ur future is bright', 'No matter jow dark ur past with christ ur future is bright', '2024-04-14 21:20:18'),
(3, 1, 'No matter hwo dark', 'create a meeting', '2024-04-14 21:37:58'),
(8, 2, 'hhhehehhhheheh', 'hhhehehNomatter how dark ur past with christ ur future is bright so instead of living in the dark of yesterday walk in the light and the hope of tomorrw', '2024-04-14 22:10:15'),
(9, 2, 'may meeting ako sa client', 'Kelangan pumunta sa costa', '2024-04-14 22:20:21'),
(10, 2, 'may meeting ako sa client', 'may meeting ako sa client', '2024-04-14 22:20:48'),
(11, 2, 'need ko matulog na', 'kc 2 am na', '2024-04-14 22:25:25'),
(12, 2, 'Ui Matulog na po', 'Ui Matulog na po kc 2 am', '2024-04-14 22:36:08'),
(13, 2, 'Matulog na hahah', 'create an invoice', '2024-04-14 22:38:41'),
(14, 2, 'Decision maker risky', 'decide when you want to join lazada dropshipping', '2024-04-14 22:41:11'),
(15, 1, 'hehhehe', 'eeee', '2024-04-15 15:42:41'),
(16, 1, 'fsdf', 'ess', '2024-04-15 15:42:48'),
(17, 1, 'dsdsds', 'dsdsd', '2024-04-15 15:42:51'),
(18, 1, 'dsdsd', 'sdsds', '2024-04-15 15:42:56'),
(19, 1, 'Create Note', 'Create Note', '2024-04-15 15:44:41'),
(20, 1, 'Create Note', 'Create Note', '2024-04-15 15:44:45'),
(21, 2, 'how earth made', 'sdsdsdsd', '2024-04-15 17:16:40'),
(22, 2, 'sdsds', 'sds', '2024-04-15 17:25:53'),
(23, 2, 'how earth made', 'fdfdfdf', '2024-04-15 17:29:28'),
(25, 2, 'asasasas', 'asasa', '2024-04-15 17:48:45'),
(26, 2, 'MARKETS', 'SAF Partners focuses on mandates at the mid to senior level with the following types of institutions', '2024-04-15 17:49:17'),
(38, 3, 'First Born Daughters Birth', 'August 1 1991\n', '2024-04-15 20:29:14'),
(39, 3, 'Bring Gift Tomorrow', 'Gift worth 50 usd dollars\n', '2024-04-15 20:29:40'),
(40, 3, 'Meeting boss Tuesday', 'Meeting boss Tuesday dont forget to bring pen and notebook\n', '2024-04-15 20:30:20'),
(41, 3, 'Sayings Of True Wisdom', 'Many hands make light work.\nA stitch in time saves nine.\nAbsence makes the heart grow fonder.', '2024-04-15 20:31:12'),
(42, 3, 'Never look a gift horse in the mouth', 'Never look a gift horse in the mouth', '2024-04-15 20:31:32'),
(43, 3, 'QOUTES FOR THE DAY', 'You have within you, right now, everything you need to deal with whatever the world can throw at you.” ', '2024-04-15 20:31:55'),
(44, 3, 'DONT LIMIT', '“Never be limited by other people\'s limited imaginations', '2024-04-15 20:32:15'),
(45, 3, 'QOUTES', 'You must be the change you wish to see in the world.', '2024-04-15 20:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'orlando', '2369', 'jrwebdubai@gmail.com'),
(2, 'jhay555', '2369', 'jhay@gmail.com'),
(3, 'lyca', '2369', 'lyca@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
