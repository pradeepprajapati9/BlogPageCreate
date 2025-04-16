-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 07:39 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `title` text NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `thumbnail` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `url`, `title`, `short_description`, `description`, `thumbnail`, `created_at`) VALUES
(8, 'This is url testing', 'sonu bhai testing', 'this is testing short', 'this is content testing des', 'uploads/thumbnails/5 April National Maritime Day (2).png', '2025-04-02 05:25:07'),
(9, 'asdf', 'adsf', 'asdf', '<p><b><u style=\"background-color: rgb(255, 255, 0);\">asdfsad</u></b></p>', 'uploads/thumbnails/New Application received.jpg', '2025-04-02 06:11:29'),
(10, 'any', 'asdf', 'asdfd', '<p><b><u style=\"background-color: rgb(255, 255, 0);\">asfds</u></b></p>', 'uploads/thumbnails/whatsapp.png', '2025-04-02 06:52:13'),
(11, 'asdf', 'asdf', 'asdf', '<p>asdf</p>', 'uploads/thumbnails/Job Posted  .jpg', '2025-04-05 05:37:56'),
(12, 'sonal url', 'sonal', 'sonal descrtipiton', '<p><b><u style=\"background-color: rgb(255, 255, 0);\">sonal testing lead</u></b></p>', 'uploads/thumbnails/New Application received.jpg', '2025-04-05 05:38:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
