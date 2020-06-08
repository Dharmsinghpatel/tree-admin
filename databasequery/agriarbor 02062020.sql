-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2020 at 01:18 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agriarbor`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytic`
--

CREATE TABLE `analytic` (
  `id` int(11) NOT NULL,
  `display_type` enum('video','blog','news','info','dashboard') NOT NULL,
  `views_count` int(11) DEFAULT NULL,
  `product_type` enum('animal','crop','fertilizer','pesticides','plant','none') NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analytic`
--

INSERT INTO `analytic` (`id`, `display_type`, `views_count`, `product_type`, `created`) VALUES
(1, 'video', 3, 'animal', '2020-05-13'),
(3, 'blog', 3, 'animal', '2020-05-13'),
(4, 'blog', 1, 'crop', '2020-05-13'),
(5, 'news', 2, 'fertilizer', '2020-05-13'),
(6, 'info', 1, 'crop', '2020-05-13'),
(7, 'blog', 5, 'fertilizer', '2020-05-14'),
(8, 'blog', 9, 'animal', '2020-05-14'),
(9, 'blog', 1, 'crop', '2020-05-14'),
(10, 'video', 2, 'animal', '2020-05-14'),
(12, 'info', 1, 'crop', '2020-05-14'),
(13, 'info', 1, 'animal', '2020-05-14'),
(14, 'video', 1, 'crop', '2020-05-14'),
(16, 'dashboard', 9, 'none', '2020-05-14'),
(17, 'dashboard', 51, 'none', '2020-05-15'),
(18, 'blog', 1, 'crop', '2020-05-15'),
(19, 'dashboard', 30, 'none', '2020-05-16'),
(20, 'news', 3, 'pesticides', '2020-05-16'),
(21, 'blog', 5, 'crop', '2020-05-16'),
(22, 'video', 1, 'fertilizer', '2020-05-16'),
(23, 'blog', 5, 'animal', '2020-05-16'),
(24, 'blog', 1, 'fertilizer', '2020-05-16'),
(25, 'info', 1, 'animal', '2020-05-16'),
(26, 'info', 1, 'crop', '2020-05-16'),
(27, 'video', 1, 'crop', '2020-05-16'),
(28, 'dashboard', 65, 'none', '2020-05-17'),
(29, 'blog', 11, 'crop', '2020-05-17'),
(30, 'blog', 1, 'animal', '2020-05-17'),
(31, 'video', 2, 'crop', '2020-05-17'),
(32, 'blog', 6, 'fertilizer', '2020-05-17'),
(33, 'info', 4, 'crop', '2020-05-17'),
(34, 'info', 32, 'animal', '2020-05-17'),
(35, 'video', 1, 'animal', '2020-05-17'),
(36, 'news', 5, 'pesticides', '2020-05-17'),
(37, 'video', 1, 'fertilizer', '2020-05-17'),
(38, 'dashboard', 3, 'none', '2020-05-18'),
(39, 'video', 1, 'fertilizer', '2020-05-18'),
(40, 'info', 2, 'crop', '2020-05-18'),
(41, 'info', 17, 'animal', '2020-05-18'),
(42, 'dashboard', 13, 'none', '2020-05-20'),
(43, 'info', 1, 'animal', '2020-05-20'),
(44, 'dashboard', 6, 'none', '2020-05-31'),
(45, 'dashboard', 84, 'none', '2020-06-01'),
(46, 'info', 2, 'animal', '2020-06-01'),
(47, 'blog', 4, 'none', '2020-06-01'),
(48, 'blog', 29, 'animal', '2020-06-01'),
(49, 'video', 2, 'animal', '2020-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `link` varchar(250) DEFAULT NULL,
  `file_id` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `id` int(11) NOT NULL,
  `product_type` enum('crop','animal','fertilizer','pesticides','plant','none') NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_use` varchar(250) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `content_type` enum('topic','file','description','document') NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `icon` int(11) DEFAULT NULL,
  `display_type` enum('info','news','blog') DEFAULT NULL,
  `is_topic` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `unique_name` varchar(500) NOT NULL,
  `size` smallint(6) NOT NULL,
  `file_type` enum('image','site','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `unique_name`, `size`, `file_type`) VALUES
(269, 'user.jpg', '9c01cbfa7f5348ce2539a53ac0a8c84c.jpg', 8, 'image');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `resource_type` enum('video','image','site') NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `file_id_2` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `position` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `dashboard_random` enum('1','0') NOT NULL,
  `comment_allow` enum('1','0') NOT NULL,
  `api_on` enum('1','0') NOT NULL,
  `carousel_random` enum('1','0') NOT NULL,
  `carousel_event` enum('1','0') NOT NULL,
  `carousel_limit` tinyint(4) NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `dashboard_random`, `comment_allow`, `api_on`, `carousel_random`, `carousel_event`, `carousel_limit`, `updated`) VALUES
(2, '1', '1', '1', '1', '1', 3, '2020-06-01 09:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `file_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `file_id`, `name`, `password`, `created`, `updated`) VALUES
(2, '813cb66440d44c7936a6967b39cd7b0bd66666132d42a99497d709cb274412c83a14ed637b6cffb7cf82709e77ad731339eb7f56c8d3927ecc1223ee070856fbGElV6PKKxgoK4dk7SwSudieSlto8O9xJKjXug6Fq36Y23o7kIQEcGMr7WZ5311Jg', 269, '43f329a45f32a459b335bd648dbac2ae4e136c78b0a4aeab67f5ceb853a03c551405ad2ebbfee1b5397a8358290e604b7e4e3dee6094178527881cc7ecd7cc7f6lX2xH0Zpy4tOIon7zqrNIvsiUwqKGsw0a5uemSXnNQ=', 'bee6b172d922ff1066d21206a2141e2d8aca4a1e1400e1e37800651b789b4ba2164c2d1cba2fb01f2c40301fce0149eb3fafbbff2b2648132edf4e76d9a198e0K1S07PqenXNe51gg3kdRh3djt9GfRjxI2gl92wwSPdFqL38TiukOSvRXo9AYuZpMyEy1j1FABLyG0wZ26BOiLg==', '2020-05-06 10:19:12', '2020-05-21 01:30:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytic`
--
ALTER TABLE `analytic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carousel_ibfk_1` (`file_id`);

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classification_ibfk_1` (`document_id`),
  ADD KEY `classification_ibfk_2` (`resource_id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contents_ibfk_2` (`resource_id`),
  ADD KEY `contents_ibfk_3` (`topic_id`),
  ADD KEY `contents_ibfk_4` (`document_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resources_ibfk_1` (`file_id`),
  ADD KEY `resources_ibfk_2` (`file_id_2`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analytic`
--
ALTER TABLE `analytic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carousel`
--
ALTER TABLE `carousel`
  ADD CONSTRAINT `carousel_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classification`
--
ALTER TABLE `classification`
  ADD CONSTRAINT `classification_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classification_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_ibfk_3` FOREIGN KEY (`topic_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_ibfk_4` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resources_ibfk_2` FOREIGN KEY (`file_id_2`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
