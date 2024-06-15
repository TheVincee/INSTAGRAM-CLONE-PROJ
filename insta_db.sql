-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 03:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insta_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentername` varchar(25) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_text` varchar(100) NOT NULL,
  `time_stamp` datetime DEFAULT current_timestamp(),
  `comment` text NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentername`, `comment_id`, `post_id`, `comment_text`, `time_stamp`, `comment`, `username`) VALUES
('argus', 38, 46, 'kah nindot bah', '2024-06-13 09:39:17', '', ''),
('argus', 39, 46, 'what if ', '2024-06-13 09:40:00', '', ''),
('argus', 40, 46, 'wow so pretty', '2024-06-13 09:41:27', '', ''),
('argus', 41, 47, 'asdasds', '2024-06-13 09:42:15', '', ''),
('valo', 42, 46, 'asdsadsads', '2024-06-13 09:42:33', '', ''),
('valo', 43, 47, 'asdasdasdas', '2024-06-13 09:42:54', '', ''),
('argus', 44, 47, 'argus pisot ', '2024-06-13 09:58:41', '', ''),
('valo', 45, 46, 'kinsa kah ', '2024-06-13 10:00:45', '', ''),
('argus', 46, 47, 'asdasdsadas', '2024-06-13 10:06:54', '', ''),
('argus', 47, 47, 'dawdaw', '2024-06-13 14:12:25', '', ''),
('valo', 48, 47, 'DAWDAW', '2024-06-13 14:14:10', '', ''),
('dragon', 49, 47, 'DAWDAW', '2024-06-15 08:35:19', '', ''),
('viva', 50, 49, 'NINDOTA AH ', '2024-06-15 09:23:18', '', ''),
('viva', 51, 47, 'kuyawa', '2024-06-15 09:24:58', '', ''),
('king', 52, 49, 'kokokoko', '2024-06-15 09:41:24', '', ''),
('jp', 53, 49, 'kingasfdsad', '2024-06-15 09:43:13', '', ''),
('argus', 54, 50, 'king asfasdfdsa', '2024-06-15 09:44:28', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `followings`
--

CREATE TABLE `followings` (
  `username` varchar(25) NOT NULL,
  `following` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followings`
--

INSERT INTO `followings` (`username`, `following`) VALUES
('argus', 'dragon'),
('argus', 'jp'),
('argus', 'valo'),
('dogstorm', 'valo'),
('dragon', 'argus'),
('dragon', 'valo'),
('king', 'argus'),
('valo', 'argus'),
('viva', 'dragon'),
('viva', 'valo');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `post_id` int(11) NOT NULL,
  `likername` varchar(25) NOT NULL,
  `time_stamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`post_id`, `likername`, `time_stamp`) VALUES
(47, 'valo', '2024-06-13 10:06:34'),
(46, 'argus', '2024-06-13 10:06:48'),
(46, 'valo', '2024-06-13 10:07:04'),
(47, 'argus', '2024-06-13 14:13:11'),
(49, 'dogstorm', '2024-06-13 21:09:07'),
(48, 'dogstorm', '2024-06-13 21:09:31'),
(48, 'dragon', '2024-06-15 08:35:10'),
(46, 'dragon', '2024-06-15 08:37:31'),
(49, 'argus', '2024-06-15 09:22:36'),
(48, 'viva', '2024-06-15 09:23:33'),
(49, 'viva', '2024-06-15 09:38:43'),
(49, 'king', '2024-06-15 09:41:27'),
(50, 'argus', '2024-06-15 09:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `type` enum('like','comment') NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) DEFAULT 0,
  `triggered_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `username`, `type`, `post_id`, `created_at`, `seen`, `triggered_by`) VALUES
(5, 'valo', 'like', 46, '2024-06-13 01:34:50', 1, 'argus'),
(6, 'valo', 'comment', 46, '2024-06-13 01:39:17', 1, 'argus'),
(7, 'valo', 'like', 46, '2024-06-13 01:39:44', 1, 'argus'),
(8, 'valo', 'comment', 46, '2024-06-13 01:40:00', 1, 'argus'),
(9, 'valo', 'comment', 46, '2024-06-13 01:41:27', 1, 'argus'),
(10, 'argus', 'comment', 47, '2024-06-13 01:42:54', 1, 'valo'),
(11, 'argus', 'like', 47, '2024-06-13 01:59:30', 1, 'valo'),
(12, 'argus', 'like', 47, '2024-06-13 02:06:34', 1, 'valo'),
(13, 'valo', 'like', 46, '2024-06-13 02:06:48', 1, 'argus'),
(14, 'argus', 'comment', 47, '2024-06-13 06:14:10', 1, 'valo'),
(15, 'argus', 'like', 49, '2024-06-13 13:09:07', 1, 'dogstorm'),
(16, 'argus', 'like', 48, '2024-06-13 13:09:31', 1, 'dogstorm'),
(17, 'argus', 'like', 48, '2024-06-15 00:35:10', 1, 'dragon'),
(18, 'argus', 'comment', 47, '2024-06-15 00:35:19', 1, 'dragon'),
(19, 'valo', 'like', 46, '2024-06-15 00:37:31', 1, 'dragon'),
(20, 'argus', 'comment', 49, '2024-06-15 01:23:18', 1, 'viva'),
(21, 'argus', 'like', 48, '2024-06-15 01:23:33', 1, 'viva'),
(22, 'argus', 'comment', 47, '2024-06-15 01:24:58', 1, 'viva'),
(23, 'argus', 'like', 49, '2024-06-15 01:38:43', 1, 'viva'),
(24, 'argus', 'comment', 49, '2024-06-15 01:41:24', 1, 'king'),
(25, 'argus', 'like', 49, '2024-06-15 01:41:27', 1, 'king'),
(26, 'argus', 'comment', 49, '2024-06-15 01:43:13', 1, 'jp'),
(27, 'jp', 'comment', 50, '2024-06-15 01:44:28', 0, 'argus'),
(28, 'jp', 'like', 50, '2024-06-15 01:44:29', 0, 'argus');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `photo` blob NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `photos` text NOT NULL,
  `comments` int(11) DEFAULT 0,
  `time_stamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `username`, `photo`, `description`, `likes`, `photos`, `comments`, `time_stamp`) VALUES
(46, 'valo', '', 'I LOVE YOU KOL', 3, '[\"photos/wallpaperflare.com_wallpaper (3).jpg\",\"photos/wallpaperflare.com_wallpaper (2).jpg\"]', 5, '2024-06-13 09:33:44'),
(47, 'argus', '', '', 2, '[\"photos/wallpaperflare.com_wallpaper (3).jpg\",\"photos/wallpaperflare.com_wallpaper (7).jpg\",\"photos/wallpaperflare.com_wallpaper (8).jpg\"]', 8, '2024-06-13 09:42:07'),
(48, 'argus', '', 'DWAWADWA', 3, '[\"photos/wallpaperflare.com_wallpaper (8).jpg\",\"photos/wallpaperflare.com_wallpaper (6).jpg\",\"photos/wallpaperflare.com_wallpaper (7).jpg\"]', 0, '2024-06-13 14:15:59'),
(49, 'argus', '', 'NIGGA', 4, '[\"photos/wallpaperflare.com_wallpaper (9).jpg\",\"photos/wallpaperflare.com_wallpaper (10).jpg\",\"photos/wallpaperflare.com_wallpaper (11).jpg\",\"photos/wallpaperflare.com_wallpaper (12).jpg\",\"photos/wallpaperflare.com_wallpaper (1).jpg\",\"photos/wallpaperflare.com_wallpaper (2).jpg\",\"photos/wallpaperflare.com_wallpaper (3).jpg\",\"photos/wallpaperflare.com_wallpaper (4).jpg\",\"photos/wallpaperflare.com_wallpaper (5).jpg\",\"photos/wallpaperflare.com_wallpaper (6).jpg\",\"photos/wallpaperflare.com_wallpaper (7).jpg\",\"photos/wallpaperflare.com_wallpaper (8).jpg\"]', 3, '2024-06-13 14:16:32'),
(50, 'jp', '', 'kikplasdfadsfs', 1, '[\"photos/wallpaperflare.com_wallpaper (7).jpg\",\"photos/wallpaperflare.com_wallpaper (8).jpg\",\"photos/wallpaperflare.com_wallpaper (9).jpg\",\"photos/wallpaperflare.com_wallpaper (10).jpg\",\"photos/wallpaperflare.com_wallpaper (11).jpg\"]', 1, '2024-06-15 09:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `profile_name` varchar(25) NOT NULL,
  `profile_picture` blob DEFAULT NULL,
  `followings` int(11) DEFAULT 0,
  `followers` int(11) DEFAULT 0,
  `posts` int(11) DEFAULT 0,
  `email` varchar(50) NOT NULL,
  `bio` varchar(1000) DEFAULT NULL,
  `time_stamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `profile_name`, `profile_picture`, `followings`, `followers`, `posts`, `email`, `bio`, `time_stamp`) VALUES
('argus', 'argus11', 'argus1', 0x70686f746f732f77616c6c7061706572666c6172652e636f6d5f77616c6c7061706572202832292e6a7067, 3, 3, 3, 'argus11@gmail.com', 'argus11', '2024-06-13 09:34:36'),
('billgates2024', 'billgates2024', 'Bill Gates', 0x70686f746f732f6c6963656e7365642d696d6167652e6a666966, 1, 1, 12, 'billgates@gmail.com', 'Microsoft CEO', '2024-06-05 10:23:32'),
('dogie', 'dgoie', 'dogie', 0x70686f746f732f505a4f383530372d536b616e64657262726f672e706e67, 0, 0, 0, 'dogiestorm@gmail.com', 'dogiekoh', '2024-06-13 21:06:45'),
('dogstorm', 'dog', 'dogstorm', 0x70686f746f732f, 1, 0, 0, 'dogstorm@gmail.com', 'dogstorm', '2024-06-13 21:08:45'),
('drag', 'dragon', 'dragon', 0x70686f746f732f77616c6c7061706572666c6172652e636f6d5f77616c6c706170657220283132292e6a7067, 0, 0, 0, 'dragons@gmail.com', 'dragons', '2024-06-15 09:20:52'),
('dragon', 'dragon', 'dragonKnight', 0x70686f746f732f77616c6c7061706572666c6172652e636f6d5f77616c6c706170657220283131292e6a7067, 2, 2, 0, 'dragononking@gmail.com', 'dragonking', '2024-06-15 08:34:50'),
('elon2024', 'elon2024', 'Elon Musk', 0x70686f746f732f656c6f6e5f6d75736b5f726f79616c5f736f63696574792e6a7067, 0, 1, 2, 'elon2024@outlook.com', 'Tesla CEO', '2024-06-07 15:57:41'),
('jp', 'jp', 'jp', 0x70686f746f732f77616c6c7061706572666c6172652d63726f70706564202831292e6a7067, 0, 1, 1, 'JP@GMAIL.COM', 'jp', '2024-06-15 09:19:36'),
('justine', 'justine', 'Justine Malabat', 0x70686f746f732f3339343135303339305f333631363838353630353235353937345f363635303838333333323836333932313639375f6e2e6a7067, 1, 1, 2, 'justine@gmail.com', 'Concentrix CEO', '2024-06-07 16:36:21'),
('karl', 'karl', 'Karl Sala', 0x70686f746f732f3234303832313633325f3536353030353133343634333331375f383130363634303231333131313532323235305f6e2e6a7067, 1, 1, 2, 'karl@gmail.com', 'Online Sabong CEO', '2024-06-07 16:40:25'),
('king', 'king', 'king', 0x70686f746f732f77616c6c7061706572666c6172652e636f6d5f77616c6c706170657220283131292e6a7067, 1, 0, 0, 'king@gmail.com', 'king', '2024-06-15 09:40:50'),
('richmon', 'richmon', 'MORT AKP', 0x70686f746f732f6d69647465726d206c6f676f20656c656374697665322e6a7067, 4, 5, 17, 'richmon@gmail.com', '', '2024-05-09 16:32:05'),
('valo', 'valos', 'valos', 0x70686f746f732f77616c6c7061706572666c6172652e636f6d5f77616c6c7061706572202833292e6a7067, 1, 4, 1, 'valo@gmail.com', 'valos', '2024-06-13 09:33:17'),
('viva', 'VIVA', 'viva', 0x70686f746f732f77616c6c7061706572666c6172652e636f6d5f77616c6c70617065722e6a7067, 2, 0, 0, 'VIVA@GMAIL.COM', 'viva ', '2024-06-15 09:22:03'),
('valo', 'valo', 'valo', 0x70686f746f732f77616c6c7061706572666c6172652e636f6d5f77616c6c70617065722e6a7067, 0, 0, 0, 'valo@gmail.com', 'valo', '2024-06-13 09:32:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `followings`
--
ALTER TABLE `followings`
  ADD PRIMARY KEY (`username`,`following`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `followings`
--
ALTER TABLE `followings`
  ADD CONSTRAINT `followings_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
