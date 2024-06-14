-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 10:42 AM
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
('richmon', 13, 35, 'hoy kahoy', '2024-06-07 08:38:52', '', ''),
('billgates2024', 15, 35, 'poha taa oh!!', '2024-06-07 09:13:34', '', ''),
('richmon', 17, 36, 'panghatag ani kol!!', '2024-06-07 14:20:26', '', ''),
('richmon', 20, 36, 'hoy', '2024-06-07 14:45:54', '', ''),
('richmon', 24, 36, 'palpak man kol!', '2024-06-07 15:11:26', '', ''),
('richmon', 26, 35, 'HOY RICHMON!!', '2024-06-07 15:28:28', '', ''),
('billgates2024', 27, 38, 'hoy richmon!', '2024-06-07 15:32:15', '', ''),
('richmon', 28, 36, 'kol!', '2024-06-07 15:37:00', '', ''),
('richmon', 29, 39, 'panghatag ni kol?', '2024-06-07 16:01:13', '', ''),
('elon2024', 31, 39, 'nindut unta pang hatag ni kol!', '2024-06-07 16:18:57', '', ''),
('elon2024', 32, 38, 'hoy!', '2024-06-07 16:22:43', '', ''),
('elon2024', 33, 38, 'bayari na ang utang! LOL', '2024-06-07 16:27:25', '', '');

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
('billgates2024', 'richmon'),
('richmon', 'billgates2024'),
('richmon', 'elon2024'),
('richmon', 'justine'),
('richmon', 'karl');

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
(35, '', '2024-06-07 08:36:06'),
(35, 'billgates2024', '2024-06-07 09:13:19'),
(36, 'richmon', '2024-06-07 14:20:02'),
(38, 'billgates2024', '2024-06-07 15:31:50'),
(39, 'richmon', '2024-06-07 16:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `type` enum('like','follow') NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `seen` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(35, 'richmon', '', '\r\n\r\n   Mort ;-0', 2, '[\"photos/317378071_201923559041639_6486198931364557027_n.jpg\",\"photos/415757055_388447093722617_3449962843476862475_n.jpg\",\"photos/midterm logo elective.jpg\"]', 3, '2024-06-07 08:30:14'),
(36, 'billgates2024', '', ' \n   WINDOWS  11 /12 ', 1, '[\"photos/5d22ba152043293.Y3JvcCwyNzYxLDIxNjAsNTQwLDA.png\",\"photos/07byLBF5UaGsFsKtyOsENAg-24.fit_lim.v1651253326.jpg\",\"photos/y3utRPtrbH7PYS7gwMfAyF-1200-80.jpg\"]', 5, '2024-06-07 09:07:55'),
(38, 'richmon', '', '\r\n  SAMPLE IMAGES!!', 1, '[\"photos/317378071_201923559041639_6486198931364557027_n.jpg\",\"photos/415757055_388447093722617_3449962843476862475_n.jpg\"]', 3, '2024-06-07 15:30:20'),
(39, 'elon2024', '', '\r\n    TESLA CAR!!', 1, '[\"photos/tesla_model_x.jpg\",\"photos/Tesla-Car_Dealership.png\",\"photos/tesla-model-2.jpg\"]', 3, '2024-06-07 15:59:32'),
(40, 'richmon', '', 'adssdsd', 0, '[\"photos/beautiful-natural-view-landscape.jpg\"]', 0, '2024-06-07 16:34:14'),
(41, 'justine', '', '  \r\n    ITS ME JUSTINE!', 0, '[\"photos/394150390_3616885605255974_6650883332863921697_n.jpg\"]', 0, '2024-06-07 16:36:58'),
(42, 'justine', '', '  \r\n\r\n   GWAPO KO! ', 0, '[\"photos/151830231_2905905339687341_3225552311366244076_n.jpg\",\"photos/279011279_3213460282265177_154073346013174030_n.jpg\",\"photos/316041580_3381347052143165_1749665585172113381_n.jpg\",\"photos/362625008_3555946978016504_3991974272744833951_n.jpg\"]', 0, '2024-06-07 16:38:45'),
(43, 'karl', '', '\r\n\r\n   ako si karl gwapo!', 0, '[\"photos/240741520_565003054643525_2382433030264786174_n.jpg\"]', 0, '2024-06-07 16:41:24');

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
('billgates2024', 'billgates2024', 'Bill Gates', 0x70686f746f732f6c6963656e7365642d696d6167652e6a666966, 1, 1, 12, 'billgates@gmail.com', 'Microsoft CEO', '2024-06-05 10:23:32'),
('elon2024', 'elon2024', 'Elon Musk', 0x70686f746f732f656c6f6e5f6d75736b5f726f79616c5f736f63696574792e6a7067, 0, 1, 1, 'elon2024@outlook.com', 'Tesla CEO', '2024-06-07 15:57:41'),
('justine', 'justine', 'Justine Malabat', 0x70686f746f732f3339343135303339305f333631363838353630353235353937345f363635303838333333323836333932313639375f6e2e6a7067, 0, 0, 2, 'justine@gmail.com', 'Concentrix CEO', '2024-06-07 16:36:21'),
('karl', 'karl', 'Karl Sala', 0x70686f746f732f3234303832313633325f3536353030353133343634333331375f383130363634303231333131313532323235305f6e2e6a7067, 0, 0, 1, 'karl@gmail.com', 'Online Sabong CEO', '2024-06-07 16:40:25'),
('richmon', 'richmon', 'MORT AKP', 0x70686f746f732f6d69647465726d206c6f676f20656c656374697665322e6a7067, 4, 3, 17, 'richmon@gmail.com', '', '2024-05-09 16:32:05');

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
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
