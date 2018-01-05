-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-05 11:35:18
-- 服务器版本： 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelangular`
--

-- --------------------------------------------------------

--
-- 表的结构 `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `answers`
--

INSERT INTO `answers` (`id`, `content`, `user_id`, `question_id`, `created_at`, `updated_at`) VALUES
(1, '恩恩，地球就是圆的，有缘千里来相聚', 2, 1, '2017-12-24 04:24:55', '2017-12-24 04:24:55'),
(2, '恩恩，肯定有外星人！！！不信你看', 2, 2, '2017-12-24 04:25:33', '2017-12-24 04:25:33'),
(5, '地球真的好大，地球是圆的哦', 1, 1, '2017-12-24 04:35:37', '2017-12-24 04:35:37'),
(6, '宇宙真的有外星人，看', 1, 2, '2017-12-24 04:35:59', '2017-12-24 04:35:59');

-- --------------------------------------------------------

--
-- 表的结构 `answer_user`
--

CREATE TABLE `answer_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL,
  `vote` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `answer_user`
--

INSERT INTO `answer_user` (`id`, `user_id`, `answer_id`, `vote`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2017-12-24 04:37:08', '2017-12-24 04:37:08'),
(2, 1, 2, 1, '2017-12-24 04:37:17', '2017-12-24 04:37:17');

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `answer_id` int(10) UNSIGNED DEFAULT NULL,
  `reply_to` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `question_id`, `answer_id`, `reply_to`, `created_at`, `updated_at`) VALUES
(1, '哈哈哈哈', 1, 1, NULL, NULL, '2017-12-24 04:38:47', '2017-12-24 04:38:47'),
(2, '对的，赞成', 1, 2, NULL, NULL, '2017-12-24 04:39:14', '2017-12-24 04:39:14');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_12_15_065633_create_table_users', 1),
(2, '2017_12_16_113115_create_table_questions', 1),
(3, '2017_12_17_112950_create_table_answers', 1),
(4, '2017_12_18_095005_create_table_comments', 1),
(5, '2017_12_19_102054_create_table_answer_user', 1),
(6, '2017_12_20_151620_add_field_phone_captcha', 1);

-- --------------------------------------------------------

--
-- 表的结构 `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci COMMENT 'description',
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ok',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `questions`
--

INSERT INTO `questions` (`id`, `title`, `desc`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '为什么地球是圆的？', NULL, 1, 'ok', '2017-12-24 04:19:28', '2017-12-24 04:19:28'),
(2, '宇宙有外星人吗？', '外星人', 1, 'ok', '2017-12-24 04:20:21', '2017-12-24 04:20:21'),
(3, '王尼玛今天大婚', '恭喜恭喜', 2, 'ok', '2017-12-24 04:21:56', '2017-12-24 04:21:56'),
(4, '牙擦苏是什么鬼', '做人第一！！！！', 2, 'ok', '2017-12-24 04:22:22', '2017-12-24 04:22:22'),
(5, 'wannim6', '什么鬼', 1, 'ok', '2017-12-24 04:40:18', '2017-12-24 04:40:18'),
(8, '地方大幅度', '发放到沙发', 1, 'ok', '2017-12-24 04:52:21', '2017-12-24 04:52:21'),
(9, '猫猫发发发', '范德萨发啥的分段润肺', 1, 'ok', '2017-12-24 04:53:43', '2017-12-24 04:53:43'),
(10, '地方发发发', '发', 1, 'ok', '2017-12-24 04:59:32', '2017-12-24 04:59:32'),
(11, '房东发发发', '丰富的', 1, 'ok', '2017-12-24 05:02:02', '2017-12-24 05:02:02'),
(12, '15404', 'sdcccgff', 1, 'ok', '2017-12-24 13:21:45', '2017-12-24 13:21:45'),
(13, '发大财', '发发发发大财', 1, 'ok', '2018-01-03 01:22:56', '2018-01-03 01:22:56'),
(14, '中等发达', '法人', 1, 'ok', '2018-01-05 10:34:32', '2018-01-05 10:34:32');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_captcha` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `avatar_url`, `phone`, `password`, `intro`, `created_at`, `updated_at`, `phone_captcha`) VALUES
(1, 'lili', NULL, NULL, NULL, '$2y$10$NLUk2Z/9.uENlPOVO9Cq/O3zxRGcRN1s0AeCqdc4k2bxgVLlla4SC', NULL, '2017-12-24 04:16:24', '2017-12-24 04:16:24', NULL),
(2, 'lilei', NULL, NULL, NULL, '$2y$10$d9gXabdGuy3ItuXrEjJfruaMAIBDYN0d8ITsql3tkudpSrBxloC2i', NULL, '2017-12-24 04:17:29', '2017-12-24 04:17:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_user_id_foreign` (`user_id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `answer_user`
--
ALTER TABLE `answer_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `answer_user_user_id_answer_id_vote_unique` (`user_id`,`answer_id`,`vote`),
  ADD KEY `answer_user_answer_id_foreign` (`answer_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_question_id_foreign` (`question_id`),
  ADD KEY `comments_answer_id_foreign` (`answer_id`),
  ADD KEY `comments_reply_to_foreign` (`reply_to`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `answer_user`
--
ALTER TABLE `answer_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 限制导出的表
--

--
-- 限制表 `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 限制表 `answer_user`
--
ALTER TABLE `answer_user`
  ADD CONSTRAINT `answer_user_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `answer_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 限制表 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `comments_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `comments_reply_to_foreign` FOREIGN KEY (`reply_to`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 限制表 `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
