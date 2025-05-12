-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2025 at 02:54 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pictogram`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '123', '2025-03-16 12:50:50', '2025-03-16 12:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_user_id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `msg` text NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `from_user_id`, `to_user_id`, `msg`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 5, 'hello, kem cho', 1, '2025-03-14 17:03:28', '0000-00-00 00:00:00'),
(2, 5, 3, 'testing yaar', 1, '2025-03-14 17:18:09', '0000-00-00 00:00:00'),
(3, 3, 4, 'oye!good morning yaar', 1, '2025-03-14 17:18:09', '0000-00-00 00:00:00'),
(4, 6, 3, 'or! bhai kya kr rha h', 1, '2025-03-14 17:03:28', '0000-00-00 00:00:00'),
(5, 3, 6, 'hey', 1, '2025-03-16 04:46:12', '2025-03-16 04:46:12'),
(6, 3, 6, 'kuch nhi just checking', 1, '2025-03-16 04:47:03', '2025-03-16 04:47:03'),
(7, 3, 4, 'or qureshi', 1, '2025-03-16 04:47:23', '2025-03-16 04:47:23'),
(8, 4, 3, 'ha bolo', 1, '2025-03-16 04:48:09', '2025-03-16 04:48:09'),
(9, 4, 3, 'kya kaam h', 1, '2025-03-16 04:48:23', '2025-03-16 04:48:23'),
(10, 4, 3, 'kyun nhi ol rhe ho', 1, '2025-03-16 05:24:09', '2025-03-16 05:24:09'),
(11, 4, 5, 'hello nitesh', 1, '2025-03-16 05:25:17', '2025-03-16 05:25:17'),
(12, 4, 5, 'hello', 1, '2025-03-25 02:48:13', '2025-03-25 02:48:13'),
(13, 4, 3, 'hello shivam', 1, '2025-03-25 02:48:27', '2025-03-25 02:48:27'),
(14, 4, 5, 'ghelo', 1, '2025-03-25 03:53:46', '2025-03-25 03:53:46'),
(15, 4, 3, 'hr', 1, '2025-03-25 03:54:06', '2025-03-25 03:54:06'),
(16, 3, 4, 'hey', 1, '2025-04-24 11:09:44', '2025-04-24 11:09:44'),
(17, 6, 4, 'hey rani', 1, '2025-04-24 12:52:54', '2025-04-24 12:52:54'),
(18, 6, 4, 'hellp', 1, '2025-05-08 01:16:17', '2025-05-08 01:16:17'),
(19, 3, 4, 'hi', 1, '2025-05-08 02:22:26', '2025-05-08 02:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'hey test', '2025-01-27 10:06:04', '2025-01-27 10:06:04'),
(2, 1, 4, 'this is nice view', '2025-01-27 10:09:22', '2025-01-27 10:09:22'),
(3, 4, 4, 'now lets see', '2025-01-27 10:45:12', '2025-01-27 10:45:12'),
(4, 4, 4, 'testing', '2025-01-27 11:02:22', '2025-01-27 11:02:22'),
(5, 4, 4, 'again test', '2025-01-27 11:03:07', '2025-01-27 11:03:07'),
(6, 4, 4, 'try again', '2025-01-27 11:03:46', '2025-01-27 11:03:46'),
(7, 4, 4, 'testing final', '2025-01-27 11:04:01', '2025-01-27 11:04:01'),
(8, 5, 4, 'ab add ho jayega', '2025-01-27 11:04:25', '2025-01-27 11:04:25'),
(10, 2, 3, 'wolf', '2025-01-27 12:37:00', '2025-01-27 12:37:00'),
(11, 1, 3, 'really nice view', '2025-01-27 12:37:33', '2025-01-27 12:37:33'),
(13, 3, 3, 'chalo proper add ho gya', '2025-01-27 12:44:37', '2025-01-27 12:44:37'),
(14, 3, 3, 'looking great', '2025-01-27 12:45:04', '2025-01-27 12:45:04'),
(15, 3, 3, 'Be happy', '2025-01-27 12:53:35', '2025-01-27 12:53:35'),
(16, 2, 3, 'hmm acha hai', '2025-01-27 13:01:37', '2025-01-27 13:01:37'),
(17, 2, 3, 'ek ayr', '2025-01-27 13:02:15', '2025-01-27 13:02:15'),
(18, 4, 3, 'hmm', '2025-01-27 13:03:12', '2025-01-27 13:03:12'),
(19, 1, 6, 'Really! Ya kehne h iss view ke toh', '2025-01-27 13:04:32', '2025-01-27 13:04:32'),
(20, 2, 7, 'accha hai bhai', '2025-03-01 01:59:12', '2025-03-01 01:59:12'),
(21, 4, 3, 'hey', '2025-03-01 03:13:12', '2025-03-01 03:13:12'),
(22, 2, 3, 'sital', '2025-03-01 03:19:22', '2025-03-01 03:19:22'),
(23, 1, 3, '', '2025-03-01 03:28:12', '2025-03-01 03:28:12'),
(24, 2, 3, '', '2025-03-01 03:28:24', '2025-03-01 03:28:24'),
(25, 2, 3, '', '2025-03-01 03:28:26', '2025-03-01 03:28:26'),
(26, 5, 3, 'okk', '2025-03-01 03:39:58', '2025-03-01 03:39:58'),
(27, 3, 3, 'hello bro', '2025-03-14 03:55:24', '2025-03-14 03:55:24'),
(28, 3, 3, 'hey', '2025-03-14 04:01:41', '2025-03-14 04:01:41'),
(29, 2, 3, 'helo', '2025-04-24 09:19:58', '2025-04-24 09:19:58'),
(30, 3, 6, 'why it is there', '2025-04-24 12:52:03', '2025-04-24 12:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE IF NOT EXISTS `followers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `follower_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `follower_id`, `user_id`, `created_at`, `updated_at`) VALUES
(76, 5, 3, '2025-01-14 02:38:40', '2025-01-14 02:38:40'),
(90, 4, 3, '2025-01-27 06:53:26', '2025-01-27 06:53:26'),
(94, 3, 4, '2025-03-01 03:27:58', '2025-03-01 03:27:58'),
(92, 7, 3, '2025-03-01 01:58:05', '2025-03-01 01:58:05'),
(97, 6, 4, '2025-03-12 10:19:43', '2025-03-12 10:19:43'),
(86, 6, 3, '2025-01-14 04:15:02', '2025-01-14 04:15:02'),
(95, 8, 3, '2025-03-01 03:37:28', '2025-03-01 03:37:28'),
(96, 3, 8, '2025-03-01 03:38:30', '2025-03-01 03:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `likeposts`
--

DROP TABLE IF EXISTS `likeposts`;
CREATE TABLE IF NOT EXISTS `likeposts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `action` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likeposts`
--

INSERT INTO `likeposts` (`id`, `post_id`, `user_id`, `action`, `created_at`, `updated_at`) VALUES
(66, 2, 4, 'like', '2025-03-09 10:26:27', '2025-03-09 10:26:27'),
(60, 2, 3, 'like', '2025-03-01 03:19:12', '2025-03-01 03:19:12'),
(53, 1, 3, 'like', '2025-01-27 12:37:43', '2025-01-27 12:37:43'),
(54, 5, 6, 'like', '2025-01-27 13:03:58', '2025-01-27 13:03:58'),
(55, 1, 6, 'like', '2025-01-27 13:04:04', '2025-01-27 13:04:04'),
(57, 2, 7, 'like', '2025-03-01 01:59:22', '2025-03-01 01:59:22'),
(59, 4, 3, 'like', '2025-03-01 03:19:01', '2025-03-01 03:19:01'),
(92, 3, 3, 'like', '2025-04-24 13:01:07', '2025-04-24 13:01:07'),
(75, 3, 6, 'like', '2025-03-12 10:29:08', '2025-03-12 10:29:08'),
(86, 1, 4, 'like', '2025-03-16 05:30:19', '2025-03-16 05:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2024_12_26_134532_create_posts_table', 1),
(3, '2025_01_01_123732_create_followuser_table', 2),
(4, '2025_01_01_163415_create_followusers_table', 3),
(5, '2025_01_01_172536_create_follow_users_table', 4),
(6, '2025_01_01_172917_create_followers_table', 5),
(7, '2025_01_14_090831_create_likeposts_table', 6),
(8, '2025_01_27_152250_create_comments_table', 7),
(9, '2025_02_02_133723_create_notifications_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifies`
--

DROP TABLE IF EXISTS `notifies`;
CREATE TABLE IF NOT EXISTS `notifies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `postlike` int NOT NULL,
  `u_postid` int DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'comment,like',
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifies`
--

INSERT INTO `notifies` (`id`, `user_id`, `postlike`, `u_postid`, `type`, `status`, `created_at`, `updated_at`) VALUES
(22, 4, 3, 4, 'like', 0, '2025-03-16 05:27:31', '2025-03-16 05:27:58'),
(21, 3, 3, 4, 'like', 0, '2025-03-14 04:04:18', '2025-03-14 04:07:32'),
(20, 3, 3, 4, 'comment', 0, '2025-03-14 04:01:41', '2025-03-14 04:07:32'),
(17, 3, 3, 4, 'like', 0, '2025-03-14 03:30:28', '2025-03-14 03:35:56'),
(18, 3, 3, 4, 'like', 0, '2025-03-14 03:35:16', '2025-03-14 03:35:56'),
(23, 4, 1, 3, 'like', 0, '2025-03-16 05:27:49', '2025-03-16 05:27:58'),
(24, 4, 1, 3, 'like', 0, '2025-03-16 05:29:38', '2025-03-16 05:29:52'),
(25, 4, 1, 3, 'like', 0, '2025-03-16 05:30:19', '2025-03-16 05:30:41'),
(26, 3, 3, 4, 'like', 0, '2025-03-24 07:58:42', '2025-03-24 08:00:21'),
(27, 3, 3, 4, 'like', 0, '2025-03-25 02:47:52', '2025-03-25 02:48:00'),
(28, 3, 3, 4, 'like', 0, '2025-03-25 03:51:40', '2025-03-25 03:52:23'),
(29, 3, 3, 4, 'like', 0, '2025-03-25 03:53:02', '2025-03-25 03:53:15'),
(30, 3, 3, 4, 'like', 0, '2025-04-24 09:12:17', '2025-04-24 10:59:57'),
(31, 3, 2, 3, 'comment', 0, '2025-04-24 09:19:58', '2025-04-24 10:59:57'),
(32, 6, 3, 4, 'comment', 0, '2025-04-24 12:52:03', '2025-04-24 12:56:27'),
(33, 3, 3, 4, 'like', 0, '2025-04-24 13:01:07', '2025-04-24 13:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img`, `post_text`, `created_at`, `updated_at`) VALUES
(1, 3, 'posts/IMG_20241218_151701033.jpg', 'This is beauutiful', '2024-12-26 11:54:42', '2024-12-26 11:54:42'),
(2, 3, 'posts/wolf.jpg', 'Kaisa laga ye wolf', '2024-12-28 12:00:38', '2024-12-28 12:00:38'),
(3, 4, 'posts/download.jpg', 'This is handsome man.', '2024-12-28 12:14:49', '2024-12-28 12:14:49'),
(4, 5, 'posts/bird.jpg', 'Hey! I got one bird.', '2025-01-04 09:13:49', '2025-01-04 09:13:49'),
(5, 6, 'posts/bird.jpg', 'This is bird', '2025-01-07 13:14:05', '2025-01-07 13:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_status` int NOT NULL DEFAULT '0' COMMENT '0->not_verified,1->verified,2->blocked',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `username`, `password`, `profile_pic`, `ac_status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Rani', 'Singhania', 0, 'rani@gmail.com', 'rani12', '$2y$10$7/rLarfkxM6ApcQLuQYo3uGeTMt1V6/xxjn7VGnhs.I630etDluxu', 'profile/WhatsApp Image 2025-03-12 at 5.33.03 PM.jpeg', 1, NULL, NULL, '2024-12-28 12:12:19', '2025-04-24 12:56:02'),
(3, 'Shivam', 'Singh', 1, 'singhshivamrock2@gmail.com', 'singhshivam', '$2y$10$bjltO4yCFjNCMkuNwxBJwO8/n0vfmyzOv53c9hqef1cJN1.3OEpFu', 'profile/men.jpg', 1, NULL, NULL, '2024-12-26 11:26:57', '2025-03-25 02:52:22'),
(5, 'Nitesh', 'Sharma', 1, 'nitesh@gmail.com', 'nitesh12', '$2y$10$ykbazfBv04tnOG4geB2AnO.m7pqoeXLLUEt8zZlq8K663hWq5b1Ne', 'profile/download.jpg', 2, NULL, NULL, '2025-01-04 09:06:56', '2025-03-21 12:05:46'),
(6, 'test', 'khurana', 0, 'test@gmail.com', 'test12', '$2y$10$a7Hz8piiCozWXf4Fqh80o.WtssPIP9I02K17XUxt7UPAXhhBqcY0O', '', 1, NULL, NULL, '2025-01-04 11:45:35', '2025-04-24 12:51:08'),
(7, 'chirag', 'gupta', 1, 'chraggupta2432003@gmail.com', 'chirag1307', '$2y$10$GB.jFKhBXRTzAYoeSjCzTueEy5LiZ2Ya2zmdXumwWxOfNTr83zePC', NULL, 2, NULL, NULL, '2025-03-01 01:53:17', '2025-03-25 02:50:18'),
(8, 'megha', 'sankhala', 1, 'sankhala.megha@raiuniversity.edu', 'megha123', '$2y$10$U9MrPA2rGNUaNFz/azErDekgBP4Dc2bZta2MabnhswlnaGFFDDGua', NULL, 2, NULL, NULL, '2025-03-01 03:36:11', '2025-03-21 12:05:53');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
