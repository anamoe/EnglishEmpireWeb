-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2024 at 10:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `englishempire`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `created_at`, `updated_at`) VALUES
(90, 29, '22', '2024-05-17 03:22:32', '2024-05-21 10:59:50'),
(91, 29, '33', '2024-05-17 03:22:32', '2024-05-21 11:00:08'),
(92, 29, '44', '2024-05-17 03:22:32', '2024-05-21 11:00:08'),
(93, 30, '3', '2024-05-17 03:22:45', '2024-05-17 03:22:45'),
(94, 30, '4', '2024-05-17 03:22:45', '2024-05-17 03:22:45'),
(95, 30, '5', '2024-05-17 03:22:45', '2024-05-17 03:22:45'),
(96, 31, '2', '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(97, 31, '3', '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(98, 31, '4', '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(99, 32, '3', '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(100, 32, '4', '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(101, 32, '5', '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(102, 33, '2', '2024-05-18 01:59:35', '2024-05-18 01:59:35'),
(103, 33, '3', '2024-05-18 01:59:35', '2024-05-18 01:59:35'),
(104, 33, '4', '2024-05-18 01:59:35', '2024-05-18 01:59:35'),
(105, 34, '2', '2024-05-18 02:25:35', '2024-05-18 02:25:35'),
(106, 34, '3', '2024-05-18 02:25:35', '2024-05-18 02:25:35'),
(107, 34, '4', '2024-05-18 02:25:35', '2024-05-18 02:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `answer_exams`
--

CREATE TABLE `answer_exams` (
  `id` bigint UNSIGNED NOT NULL,
  `quest_exam_id` int DEFAULT NULL,
  `answer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answer_exams`
--

INSERT INTO `answer_exams` (`id`, `quest_exam_id`, `answer`, `created_at`, `updated_at`) VALUES
(28, 8, 'saya', '2024-05-21 08:46:27', '2024-05-21 11:12:01'),
(29, 8, 'cinta', '2024-05-21 08:46:27', '2024-05-21 11:13:22'),
(30, 8, 'ed', '2024-05-21 08:46:27', '2024-05-21 11:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `class_courses`
--

CREATE TABLE `class_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `course_program_id` bigint NOT NULL,
  `class` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_courses`
--

INSERT INTO `class_courses` (`id`, `course_program_id`, `class`, `created_at`, `updated_at`) VALUES
(1, 4, 'Old-Class 1', '2024-03-27 09:33:28', '2024-03-27 10:20:38'),
(2, 4, 'Old-Class 3', '2024-03-27 09:33:56', '2024-03-27 10:20:44'),
(3, 1, 'GA-Class1', '2024-03-27 10:20:24', '2024-03-27 10:20:24'),
(4, 2, 'general english 22', '2024-05-06 02:49:01', '2024-05-06 02:49:01'),
(5, 3, 'Hospitality 1', '2024-05-06 02:50:55', '2024-05-06 02:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `course_programs`
--

CREATE TABLE `course_programs` (
  `id` bigint UNSIGNED NOT NULL,
  `program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_programs`
--

INSERT INTO `course_programs` (`id`, `program`, `created_at`, `updated_at`) VALUES
(1, 'Golden Age', '2024-03-26 04:56:36', '2024-03-26 04:56:36'),
(2, 'General English', '2024-03-26 04:56:36', '2024-03-26 04:56:36'),
(3, 'Hospitality English', '2024-03-26 04:56:36', '2024-03-26 04:56:36'),
(4, 'Old English', '2024-03-27 07:50:51', '2024-03-27 09:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_program_id` bigint NOT NULL,
  `class_id` bigint NOT NULL,
  `waktu_pengerjaan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `course_program_id`, `class_id`, `waktu_pengerjaan`, `created_at`, `updated_at`) VALUES
(1, 'Tes Exam 12', 4, 2, 45, '2024-04-26 23:11:42', '2024-04-28 01:47:10'),
(2, 'Test Exam 3', 4, 1, 30, '2024-04-28 01:47:37', '2024-04-28 01:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_updates`
--

CREATE TABLE `info_updates` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_updates`
--

INSERT INTO `info_updates` (`id`, `image`, `link`, `created_at`, `updated_at`) VALUES
(1, '20240327download.jpg', 'https://www.instagram.com/p/C4z__fDrwJi/?utm_source=ig_web_copy_links', '2024-03-27 06:00:17', '2024-03-27 06:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `main` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quiz_category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `main`, `quiz_category_id`, `created_at`, `updated_at`) VALUES
(1, 'Main 1', 1, '2024-03-26 05:26:10', '2024-03-26 05:26:10'),
(2, 'Main 2', 1, '2024-03-26 05:26:16', '2024-03-26 05:26:16'),
(3, 'main 3', 1, '2024-03-31 13:42:28', '2024-03-31 13:42:28'),
(4, 'main2-1', 2, '2024-03-31 14:14:24', '2024-03-31 14:14:24'),
(5, 'main2-2', 2, '2024-03-31 14:14:47', '2024-03-31 14:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `type_message`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'mau rakit budget 6.500 bang', 'payment', 1, '2024-04-22 01:18:10', '2024-04-22 01:18:10'),
(2, 'mau ra', 'All', NULL, '2024-05-08 04:56:50', '2024-05-08 04:56:50'),
(3, 'aa', 'One', 1, '2024-05-08 04:57:46', '2024-05-08 04:57:46'),
(4, 'asas', 'One', 3, '2024-05-08 04:58:00', '2024-05-08 04:58:00'),
(5, 'asa', 'One', 4, '2024-05-08 13:56:33', '2024-05-08 13:56:33'),
(6, 'semua', 'All', NULL, '2024-05-08 14:14:11', '2024-05-08 14:14:11'),
(7, 'x', 'One', 1, '2024-05-08 14:16:45', '2024-05-08 14:16:45'),
(8, 'all notif', 'All', NULL, '2024-05-08 14:17:11', '2024-05-08 14:17:11'),
(9, 'satu', 'One', 1, '2024-05-08 14:17:18', '2024-05-08 14:17:18'),
(10, 'all', 'All', NULL, '2024-05-08 14:28:12', '2024-05-08 14:28:12'),
(11, 'one', 'One', 1, '2024-05-08 14:28:30', '2024-05-08 14:28:30'),
(12, 'mas dul pacare 5', 'All', NULL, '2024-05-08 14:29:57', '2024-05-08 14:29:57'),
(13, 'mas dul pacare 1', 'One', 1, '2024-05-08 14:30:12', '2024-05-08 14:30:12'),
(14, '1', 'One', 1, '2024-05-08 14:32:37', '2024-05-08 14:32:37'),
(15, 'all', 'All', NULL, '2024-05-08 14:32:45', '2024-05-08 14:32:45'),
(16, 'aksa', 'All', NULL, '2024-05-08 14:39:54', '2024-05-08 14:39:54'),
(17, 'all', 'All', NULL, '2024-05-08 14:42:04', '2024-05-08 14:42:04'),
(18, 'all', 'All', NULL, '2024-05-08 14:42:42', '2024-05-08 14:42:42'),
(19, 'all', 'All', NULL, '2024-05-08 14:47:13', '2024-05-08 14:47:13'),
(20, 'all', 'All', NULL, '2024-05-08 14:47:22', '2024-05-08 14:47:22'),
(21, 'one', 'One', 1, '2024-05-08 14:48:11', '2024-05-08 14:48:11'),
(22, 'all', 'All', NULL, '2024-05-08 14:52:05', '2024-05-08 14:52:05'),
(23, '113', 'All', NULL, '2024-05-08 15:44:07', '2024-05-08 15:44:07'),
(24, '123', 'All', NULL, '2024-05-08 15:44:33', '2024-05-08 15:44:33'),
(25, 'one notif', 'One', 1, '2024-05-08 16:08:09', '2024-05-08 16:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_26_025440_create_course_programs_table', 1),
(6, '2024_03_26_034943_create_students_table', 1),
(7, '2024_03_26_035826_create_slide_infos_table', 1),
(8, '2024_03_26_035854_create_quiz_categories_table', 1),
(9, '2024_03_26_035939_create_main_categories_table', 1),
(10, '2024_03_26_035953_create_sub_categories_table', 1),
(11, '2024_03_26_040051_create_exams_table', 1),
(12, '2024_03_26_040202_create_student_schedules_table', 1),
(13, '2024_03_26_041048_create_quizzes_table', 1),
(14, '2024_03_26_043608_create_questions_table', 1),
(15, '2024_03_26_043834_create_answers_table', 1),
(16, '2024_03_26_043901_create_student_answers_table', 1),
(17, '2024_03_26_220611_create_poin_students_table', 2),
(18, '2024_03_27_065208_create_info_updates_table', 3),
(19, '2024_03_27_092736_create_class_courses_table', 3),
(20, '2024_04_03_070649_create_exam_questions_table', 4),
(21, '2024_04_03_071215_create_poin_student_exams_table', 4),
(22, '2024_04_03_071232_create_answer_exams_table', 4),
(23, '2024_04_03_071245_create_question_exams_table', 4),
(24, '2024_04_22_054557_create_messages_table', 4),
(25, '2024_04_27_113210_create_quiz_exams_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poin_students`
--

CREATE TABLE `poin_students` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `point` int NOT NULL,
  `answer_student` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poin_student_exams`
--

CREATE TABLE `poin_student_exams` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `question_id` int NOT NULL,
  `point` int NOT NULL,
  `answer_student` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `quest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quest`, `audio`, `image`, `answer_key`, `sub_id`, `created_at`, `updated_at`) VALUES
(29, '11', '', '', '90', 13, '2024-05-17 03:22:32', '2024-05-21 11:00:08'),
(30, '2', '', '', '93', 13, '2024-05-17 03:22:45', '2024-05-17 03:22:45'),
(31, '1', '', '', '96', 19, '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(32, '2', '', '', '99', 19, '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(33, '1', '', '', '102', 20, '2024-05-18 01:59:35', '2024-05-18 01:59:35'),
(34, '1', '', '', '105', 21, '2024-05-18 02:25:35', '2024-05-18 02:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `question_exams`
--

CREATE TABLE `question_exams` (
  `id` bigint UNSIGNED NOT NULL,
  `quest_exam` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `answer_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `exam_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_exams`
--

INSERT INTO `question_exams` (`id`, `quest_exam`, `audio`, `image`, `answer_key`, `exam_id`, `created_at`, `updated_at`) VALUES
(8, 'aku', '', '', '28', 4, '2024-05-21 08:46:27', '2024-05-21 11:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint UNSIGNED NOT NULL,
  `sub_categories_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_test` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_categories`
--

CREATE TABLE `quiz_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_categories`
--

INSERT INTO `quiz_categories` (`id`, `category`, `program_id`, `created_at`, `updated_at`) VALUES
(1, 'Quiz 121', 1, '2024-03-26 05:24:19', '2024-04-28 05:10:26'),
(2, 'quiz 2', 2, '2024-03-31 14:13:52', '2024-03-31 14:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_exams`
--

CREATE TABLE `quiz_exams` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_test` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_exams`
--

INSERT INTO `quiz_exams` (`id`, `exam_id`, `user_id`, `status_test`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 'finish', '2024-04-30 00:46:50', '2024-04-30 00:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `slide_infos`
--

CREATE TABLE `slide_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slide_infos`
--

INSERT INTO `slide_infos` (`id`, `image`, `created_at`, `updated_at`) VALUES
(2, '202403277750495_b05c5cb2-d392-4364-a72b-b4468b4cd28c_700_700.jpg', '2024-03-27 06:04:25', '2024-03-27 06:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_program_id` bigint UNSIGNED NOT NULL,
  `class_id` bigint NOT NULL,
  `parent_id` int DEFAULT NULL,
  `school` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `course_program_id`, `class_id`, `parent_id`, `school`, `date_birth`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 11, 'MI Al Ishlah', '2014-09-02', '08217531', '2024-03-26 04:56:37', '2024-05-16 13:36:18'),
(2, 4, 1, 3, NULL, 'smk', '2024-03-16', '0822576', '2024-03-27 10:35:14', '2024-04-03 00:56:52'),
(3, 5, 4, 2, NULL, 'smk', '2024-03-15', '082257661154', '2024-03-27 10:35:56', '2024-04-03 01:23:19'),
(5, 7, 4, 1, 12, 'MI Miftahul Siti', '2009-12-09', '0812345678', '2024-03-29 22:14:38', '2024-05-16 13:38:52'),
(6, 8, 2, 4, NULL, 'smk', '2024-05-18', '092', '2024-05-06 02:49:31', '2024-05-06 02:49:31'),
(7, 9, 3, 5, NULL, 'MI Al Ishlah Sukodono', '2014-02-12', '08217531', '2024-05-06 02:51:43', '2024-05-06 02:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `quiz_id` bigint UNSIGNED NOT NULL,
  `skor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answered_student` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_schedules`
--

CREATE TABLE `student_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homework` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_schedules`
--

INSERT INTO `student_schedules` (`id`, `user_id`, `session`, `date`, `note`, `homework`, `skor`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '2024-03-06', 'Present', 'Describing', 2, NULL, '2024-05-08 00:58:01'),
(3, 1, '2', '2024-04-26', 'None', 'describing family 3', 3, '2024-03-30 10:14:32', '2024-05-08 00:58:06'),
(4, 7, '1', '2024-04-27', 'None', 'describing family gathering', NULL, '2024-04-21 19:03:07', '2024-04-21 19:05:36'),
(5, 1, '3', '2024-04-22', 'Alpha', 'None', NULL, '2024-04-22 00:21:32', '2024-04-22 00:21:41'),
(6, 1, '3', '2024-04-23', 'Sick', 'None', NULL, '2024-04-22 00:25:14', '2024-04-22 00:25:23'),
(7, 1, '5', '2024-04-25', 'Permit', 'None', NULL, '2024-04-22 00:27:49', '2024-04-22 00:27:57'),
(8, 1, 'ASA', '2024-05-24', 'None', 'None', NULL, '2024-05-11 01:31:00', '2024-05-11 01:31:00'),
(9, 1, '3', '2024-05-24', 'None', 'None', NULL, '2024-05-11 01:31:16', '2024-05-11 01:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `main_category_id` bigint UNSIGNED NOT NULL,
  `sub` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_pengerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `main_category_id`, `sub`, `waktu_pengerjaan`, `created_at`, `updated_at`) VALUES
(13, 1, 'sub 1', '10', '2024-05-17 01:45:50', '2024-05-17 01:45:50'),
(19, 1, 'sub2', '20', '2024-05-17 03:23:00', '2024-05-17 03:23:00'),
(20, 2, 'sub2', '10', '2024-05-18 01:59:20', '2024-05-18 01:59:20'),
(21, 2, 'aub3', '15', '2024-05-18 02:25:18', '2024-05-18 02:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'profil.jpg',
  `status_account` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activate_date` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_fcm` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `nick_name`, `id_number`, `role`, `email_verified_at`, `password`, `foto_profil`, `status_account`, `activate_date`, `token_fcm`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Anan Anam', 'Anan', '220303', 'student', NULL, '$2y$12$gvLmWllXi.yYxzjYFl0/g.1D211IHemvnSvgwe3/KO7VX/KozQuVW', 'profil.jpg', 'active', NULL, 'dJIrpNWbQbGSj4i4rqozaM:APA91bGvNAGSQU-s6qyGYSzCBRhgxSpIDPOPRNn437jE-miAwwiAOxQ2rIKT6qWMC_r5bcSsdlRq_eHcev8oS8vo6djqQ2KrW9zHNbMuYIx4lyLZKCkfmnZBfslfp9jn81xV_zBAQEc_', NULL, '2024-03-26 04:56:36', '2024-05-16 13:36:18'),
(2, 'Admin Dana', 'Dana', '220304', 'admin', NULL, '$2y$12$bessCUA50glkSHgD27nrNOh4DNdqiKolLMdRWR5tQ6rjfrB9nahXu', NULL, '', '', NULL, NULL, '2024-03-26 04:56:36', '2024-03-26 04:56:36'),
(3, 'aa', 's', '2023', 'student', NULL, '$2y$12$AIrEh2gFJm4G3mZS32jGOu/KcS9eq4Lqagz6OJQD/O3FK8Q8UQ1a2', 'profil.jpg', '', '', NULL, NULL, '2024-03-27 07:15:15', '2024-03-27 07:15:15'),
(4, 'Khoirul Anam', 'ANAM', '2026', 'student', NULL, '$2y$12$gvLmWllXi.yYxzjYFl0/g.1D211IHemvnSvgwe3/KO7VX/KozQuVW', '20240329Septia.jpg', 'active', '2024-04-12', '133', NULL, '2024-03-27 10:35:14', '2024-05-08 15:55:25'),
(5, 'Habibi Ahmad', 'hABAIBI', '2022', 'student', NULL, '$2y$12$52k45KdsDzM1k3H1VJVee.KziQpGzkAiv/hwqliwg/j2Y/YUyIvxC', 'profil.jpg', 'active', '2024-04-30', '123', NULL, '2024-03-27 10:35:56', '2024-05-05 18:56:57'),
(7, 'Arhan Aha', 'Arhan', '22222', 'student', NULL, '$2y$12$RmhJQ8I/yf/g9sWnrysmuOU40UzKQvTIz9sraqgpG/8fJ2325geMm', '1714971627.jpg', 'active', '2024-03-28', NULL, NULL, '2024-03-29 22:14:38', '2024-05-16 13:38:52'),
(8, 'evan stenas', 'ecan', '21', 'student', NULL, '$2y$12$2FVTUOk8SN0MOojSCMlzme6PwZvd/sICVnkYQIeGda20MxMPkRpjK', 'profil.jpg', 'active', '2024-05-24', NULL, NULL, '2024-05-06 02:49:31', '2024-05-06 02:49:31'),
(9, 'rijal aan', 'aan', '220101', 'student', NULL, '$2y$12$.fOEWCqcNgKl2DlzZetIKe39ilCyhsRGHT5mpM9I8EkTEiap1aFhW', '20240506133571008536636228.jpg', 'active', '2024-05-31', NULL, NULL, '2024-05-06 02:51:43', '2024-05-06 02:51:57'),
(11, 'Joko Samudro', 'jOKO', '123', 'parent', NULL, '$2y$12$yPqc2EzCQcKYmeuiaA7UQef5rna4aDwKYO3txW1Y0u8XhXjZRYq8W', 'profil-parent.jpg', 'active', NULL, NULL, NULL, '2024-05-16 13:34:51', '2024-05-16 13:34:51'),
(12, 'joni samson', 'samson', '122', 'parent', NULL, '$2y$12$u/sRdqXjSSHpEkcmAtT5V.i7jU8CzQRi6fBhZnIUlSrpJQix60d8K', 'profil.jpg', 'active', NULL, NULL, NULL, '2024-05-16 13:38:39', '2024-05-16 13:38:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `answer_exams`
--
ALTER TABLE `answer_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_courses`
--
ALTER TABLE `class_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_program_id` (`course_program_id`);

--
-- Indexes for table `course_programs`
--
ALTER TABLE `course_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `info_updates`
--
ALTER TABLE `info_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_categories_quiz_category_id_foreign` (`quiz_category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `poin_students`
--
ALTER TABLE `poin_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poin_students_user_id_foreign` (`user_id`),
  ADD KEY `poin_students_question_id_foreign` (`question_id`);

--
-- Indexes for table `poin_student_exams`
--
ALTER TABLE `poin_student_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_exams`
--
ALTER TABLE `question_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_sub_categories_id_foreign` (`sub_categories_id`),
  ADD KEY `quizzes_user_id_foreign` (`user_id`);

--
-- Indexes for table `quiz_categories`
--
ALTER TABLE `quiz_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_exams`
--
ALTER TABLE `quiz_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_exams_exam_id_foreign` (`exam_id`),
  ADD KEY `quiz_exams_user_id_foreign` (`user_id`);

--
-- Indexes for table `slide_infos`
--
ALTER TABLE `slide_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_user_id_foreign` (`user_id`),
  ADD KEY `students_course_program_id_foreign` (`course_program_id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_answers_question_id_foreign` (`question_id`),
  ADD KEY `student_answers_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `student_schedules`
--
ALTER TABLE `student_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_schedules_user_id_foreign` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_main_category_id_foreign` (`main_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `answer_exams`
--
ALTER TABLE `answer_exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `class_courses`
--
ALTER TABLE `class_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_programs`
--
ALTER TABLE `course_programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_updates`
--
ALTER TABLE `info_updates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poin_students`
--
ALTER TABLE `poin_students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `poin_student_exams`
--
ALTER TABLE `poin_student_exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `question_exams`
--
ALTER TABLE `question_exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quiz_categories`
--
ALTER TABLE `quiz_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_exams`
--
ALTER TABLE `quiz_exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slide_infos`
--
ALTER TABLE `slide_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_schedules`
--
ALTER TABLE `student_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD CONSTRAINT `main_categories_quiz_category_id_foreign` FOREIGN KEY (`quiz_category_id`) REFERENCES `quiz_categories` (`id`);

--
-- Constraints for table `poin_students`
--
ALTER TABLE `poin_students`
  ADD CONSTRAINT `poin_students_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `poin_students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_course_program_id_foreign` FOREIGN KEY (`course_program_id`) REFERENCES `course_programs` (`id`),
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `student_answers_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `student_schedules`
--
ALTER TABLE `student_schedules`
  ADD CONSTRAINT `student_schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_main_category_id_foreign` FOREIGN KEY (`main_category_id`) REFERENCES `main_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
