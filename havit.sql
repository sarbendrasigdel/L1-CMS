-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 06:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inquiry_page`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_notification_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(4) NOT NULL DEFAULT 1,
  `is_super_admin` tinyint(4) DEFAULT 0,
  `changed_password` tinyint(4) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `remember_token`, `push_notification_token`, `active_status`, `is_super_admin`, `changed_password`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'havit', '$2y$10$RnFJJ8K5DzCTIsZBak0TYey5lWu/RChm.3iXlWUL4EmMd3SyBa4Sy', NULL, NULL, 1, 1, 0, NULL, '2023-07-05 05:10:11', '2023-07-18 07:31:04'),
(2, 'test', '$2y$10$RKAofGFGZG9nlR6mtT2yYe/2F9guVXWAwiTmpO.BuVzdGtCgW1d/2', NULL, NULL, 1, 0, 0, NULL, '2023-07-13 05:50:22', '2023-07-18 07:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_infos`
--

CREATE TABLE `admin_user_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_created_by_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_updated_by_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_deleted_by_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_user_infos`
--

INSERT INTO `admin_user_infos` (`id`, `admin_user_id`, `full_name`, `email`, `phone_number`, `address`, `user_created_by_users_info_id`, `user_updated_by_users_info_id`, `user_deleted_by_users_info_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'sanjay', 'admin@havit.com', '9843702839', 'Bhaktapur', NULL, NULL, NULL, NULL, '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(2, 2, 'test', 'test@gmail.com', '9874563210', 'test', 1, NULL, NULL, NULL, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(3, 2, 'test', 'test@gmail.com', '9874563210', 'test', 1, NULL, NULL, NULL, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(4, 2, 'test', 'test@gmail.com', '9874563210', 'test', 1, NULL, NULL, NULL, '2023-07-18 07:41:08', '2023-07-18 07:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_settings`
--

CREATE TABLE `dashboard_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 1,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by_model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(4) NOT NULL DEFAULT 1,
  `is_editable` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_admin_users_info_id` bigint(20) UNSIGNED NOT NULL,
  `updated_by_admin_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_admin_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `active_status`, `is_editable`, `created_by_admin_users_info_id`, `updated_by_admin_users_info_id`, `deleted_by_admin_users_info_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tester', 1, 1, 1, NULL, NULL, NULL, '2023-07-13 05:50:00', '2023-07-13 05:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2019_12_19_112156_create_admin_users_table', 1),
(7, '2019_12_19_112227_create_admin_user_infos_table', 1),
(8, '2019_12_19_112827_create_designations_table', 1),
(9, '2019_12_19_113006_create_user_designations_table', 1),
(10, '2019_12_19_113526_create_user_activities_table', 1),
(11, '2020_05_14_134234_create_dashboard_settings_table', 1),
(12, '2020_08_25_121533_create_permission_tables', 1),
(13, '2020_08_25_161205_create_user_permissions_table', 1),
(19, '2021_07_26_091025_create_site_settings_table', 2),
(20, '2022_04_01_125924_create_seo_settings_table', 2),
(21, '2022_04_05_120428_create_terms_and_conditions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admins\\AdminUser', 2),
(2, 'App\\Models\\Admins\\AdminUser', 2),
(3, 'App\\Models\\Admins\\AdminUser', 2),
(4, 'App\\Models\\Admins\\AdminUser', 2),
(5, 'App\\Models\\Admins\\AdminUser', 2),
(6, 'App\\Models\\Admins\\AdminUser', 2),
(7, 'App\\Models\\Admins\\AdminUser', 2),
(8, 'App\\Models\\Admins\\AdminUser', 2),
(9, 'App\\Models\\Admins\\AdminUser', 2),
(10, 'App\\Models\\Admins\\AdminUser', 2),
(11, 'App\\Models\\Admins\\AdminUser', 2),
(12, 'App\\Models\\Admins\\AdminUser', 2),
(13, 'App\\Models\\Admins\\AdminUser', 2),
(14, 'App\\Models\\Admins\\AdminUser', 2),
(15, 'App\\Models\\Admins\\AdminUser', 2),
(16, 'App\\Models\\Admins\\AdminUser', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `key_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view.user.role', 'View Role', 'role', 'admin-user', '2023-07-05 05:10:10', '2023-07-05 05:10:10'),
(2, 'create.user.role', 'Create Role', 'role', 'admin-user', '2023-07-05 05:10:10', '2023-07-05 05:10:10'),
(3, 'edit.user.role', 'Edit Role', 'role', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(4, 'delete.user.role', 'Delete Role', 'role', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(5, 'export.user.role', 'Export Roles', 'role', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(6, 'view.user.designation', 'View Designation', 'designation', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(7, 'create.user.designation', 'Create Designation', 'designation', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(8, 'edit.user.designation', 'Edit Designation', 'designation', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(9, 'delete.user.designation', 'Delete Designation', 'designation', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(10, 'export.user.designation', 'Export Designation', 'designation', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(11, 'view.user', 'View User', 'user', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(12, 'create.user', 'Create User', 'user', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(13, 'edit.user', 'Edit User', 'user', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(14, 'delete.user', 'Delete User', 'user', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(15, 'export.user', 'Export Users', 'user', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11'),
(16, 'switch.user.portal', 'Switch User Portal', 'user', 'admin-user', '2023-07-05 05:10:11', '2023-07-05 05:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for active and 0 for inactive',
  `created_by_admin_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_admin_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_admin_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `guard_name`, `active_status`, `created_by_admin_users_info_id`, `updated_by_admin_users_info_id`, `deleted_by_admin_users_info_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'test', 'ts', 'admin-user', 1, 1, 1, NULL, NULL, '2023-07-13 05:49:55', '2023-07-18 07:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backinputone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_admin_users_info_id` bigint(20) UNSIGNED NOT NULL,
  `updated_by_admin_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_admin_users_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `company_name`, `company_logo`, `company_email`, `company_location`, `contact_number`, `copyright`, `facebook`, `instagram`, `twitter`, `linkedin`, `youtube`, `meta_keyword`, `meta_title`, `meta_description`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 'Capital Eye Nepal', '/file-manager/photos/1/241053300_4293788527376363_6999506022231650786_n.jpg', 'connect@capitaleye.com.np', 'connect@capitaleye.com.np', '+977-9801081849', 'Copyright 2021 | Lakasa Nepal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-07-19 08:01:35', '2023-07-19 09:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('terms_and_condition','privacy_policy') COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `title`, `description`, `type`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 'terms and conditions', '<p>this is terms and condition</p>', 'terms_and_condition', 1, '2023-07-19 09:54:42', '2023-07-19 09:54:42'),
(2, 'privacy and policy', '<p>this is privacy and policy pages.</p>', 'privacy_policy', 1, '2023-07-19 09:55:06', '2023-07-19 09:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) NOT NULL,
  `model_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_users_info_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_designations`
--

CREATE TABLE `user_designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_users_info_id` bigint(20) UNSIGNED NOT NULL,
  `designation_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_designations`
--

INSERT INTO `user_designations` (`id`, `admin_users_info_id`, `designation_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(2, 2, 1, NULL, '2023-07-18 07:40:42', '2023-07-18 07:40:42'),
(3, 3, 1, NULL, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(4, 4, 1, NULL, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(5, 4, 1, NULL, '2023-07-18 07:41:43', '2023-07-18 07:41:43'),
(6, 4, 1, NULL, '2023-07-18 07:44:21', '2023-07-18 07:44:21'),
(7, 4, 1, NULL, '2023-07-18 07:44:34', '2023-07-18 07:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`permission_id`, `model_type`, `model_id`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(1, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(1, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(2, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(2, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(2, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(3, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(3, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(3, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(4, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(4, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(4, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(5, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(5, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(5, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(6, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(6, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(6, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(7, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(7, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(7, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(8, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(8, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(8, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(9, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(9, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(9, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(10, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(10, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(10, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(11, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(11, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(11, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(12, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(12, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(12, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(13, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(13, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(13, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(14, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(14, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(14, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(15, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(15, 'App\\Models\\Admins\\AdminUserInfo', 3, '2023-07-18 07:40:57', '2023-07-18 07:40:57'),
(15, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08'),
(16, 'App\\Models\\Admins\\AdminUserInfo', 2, '2023-07-13 05:50:22', '2023-07-13 05:50:22'),
(16, 'App\\Models\\Admins\\AdminUserInfo', 4, '2023-07-18 07:41:08', '2023-07-18 07:41:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Indexes for table `admin_user_infos`
--
ALTER TABLE `admin_user_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_info_users_info1_idx` (`user_created_by_users_info_id`),
  ADD KEY `fk_users_info_users_info2_idx` (`user_updated_by_users_info_id`),
  ADD KEY `fk_users_info_users_info3_idx` (`user_deleted_by_users_info_id`),
  ADD KEY `fk_users_info_users1_idx` (`admin_user_id`);

--
-- Indexes for table `dashboard_settings`
--
ALTER TABLE `dashboard_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_designations_users_info3_idx` (`deleted_by_admin_users_info_id`),
  ADD KEY `fk_designations_users_info2_idx` (`updated_by_admin_users_info_id`),
  ADD KEY `fk_designations_users_info1_idx` (`created_by_admin_users_info_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roles_users_info1_idx` (`created_by_admin_users_info_id`),
  ADD KEY `fk_roles_users_info3_idx` (`deleted_by_admin_users_info_id`),
  ADD KEY `fk_roles_users_info2_idx` (`updated_by_admin_users_info_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seo_settings_created_by_admin_users_info_id_foreign` (`created_by_admin_users_info_id`),
  ADD KEY `seo_settings_updated_by_admin_users_info_id_foreign` (`updated_by_admin_users_info_id`),
  ADD KEY `seo_settings_deleted_by_admin_users_info_id_foreign` (`deleted_by_admin_users_info_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_activities_users_info1_idx` (`admin_users_info_id`);

--
-- Indexes for table `user_designations`
--
ALTER TABLE `user_designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_designations_users_info1_idx` (`admin_users_info_id`),
  ADD KEY `fk_user_designations_designations1_idx` (`designation_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `user_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_user_infos`
--
ALTER TABLE `admin_user_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dashboard_settings`
--
ALTER TABLE `dashboard_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_designations`
--
ALTER TABLE `user_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_user_infos`
--
ALTER TABLE `admin_user_infos`
  ADD CONSTRAINT `fk_users_info_users1_idx` FOREIGN KEY (`admin_user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_info_users_info1_idx` FOREIGN KEY (`user_created_by_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_info_users_info2_idx` FOREIGN KEY (`user_updated_by_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_info_users_info3_idx` FOREIGN KEY (`user_deleted_by_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `fk_designations_users_info1_idx` FOREIGN KEY (`created_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_designations_users_info2_idx` FOREIGN KEY (`updated_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_designations_users_info3_idx` FOREIGN KEY (`deleted_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_roles_users_info1_idx` FOREIGN KEY (`created_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roles_users_info2_idx` FOREIGN KEY (`updated_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roles_users_info3_idx` FOREIGN KEY (`deleted_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD CONSTRAINT `seo_settings_created_by_admin_users_info_id_foreign` FOREIGN KEY (`created_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seo_settings_deleted_by_admin_users_info_id_foreign` FOREIGN KEY (`deleted_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seo_settings_updated_by_admin_users_info_id_foreign` FOREIGN KEY (`updated_by_admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `fk_user_activities_users_info1_idx` FOREIGN KEY (`admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_designations`
--
ALTER TABLE `user_designations`
  ADD CONSTRAINT `fk_user_designations_designations1_idx` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_designations_users_info1_idx` FOREIGN KEY (`admin_users_info_id`) REFERENCES `admin_user_infos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
