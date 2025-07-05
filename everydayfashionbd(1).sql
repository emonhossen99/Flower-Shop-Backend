-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 05, 2025 at 06:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `everydayfashionbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `submenu_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Pending ,1 = Publish',
  `home_page_show` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0 = No , 1 = Yes',
  `order_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `submenu_id`, `slug`, `image`, `tag`, `status`, `home_page_show`, `order_by`, `created_at`, `updated_at`) VALUES
(2, 'Flower', '0', '0', 'flower', NULL, NULL, '1', '0', '1', '2025-07-02 08:42:47', '2025-07-03 05:52:10'),
(3, 'Periwinkle Flower', '0', '0', 'periwinkle-flower', NULL, NULL, '1', '0', '2', '2025-07-03 05:51:46', '2025-07-03 05:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=Pending , 1= Publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Order Online', '<p>Share\r\n                            some details here. This is Flexible\r\n                            section where you can share anything you\r\n                            want</p>', '1', '2025-07-02 07:14:48', '2025-07-02 07:14:48'),
(2, 'Free Shipping', '<p>Share\r\n                            some details here. This is Flexible\r\n                            section where you can share anything you\r\n                            want</p>', '1', '2025-07-02 07:15:59', '2025-07-02 07:15:59'),
(3, 'Store Freshness', '<p>Share\r\n                            some details here. This is Flexible\r\n                            section where you can share anything you\r\n                            want</p>', '1', '2025-07-02 07:16:14', '2025-07-02 07:16:14'),
(4, 'Safe Payments', '<p>Share\r\n                            some details here. This is Flexible\r\n                            section where you can share anything you\r\n                            want</p>', '1', '2025-07-02 07:16:27', '2025-07-02 07:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `imagegalleries`
--

CREATE TABLE `imagegalleries` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` enum('ltr','rtl') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr' COMMENT 'lrt = Left To Right , rtl = Right To Left',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 = Pending , 1 = Publish',
  `default` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `order_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `child_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Pending , 1 = Active',
  `position` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Menu , 1 = Footer 1, 2 = Footer 2, 3 = Footer 3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `url`, `target`, `order_by`, `parent_id`, `child_id`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Home', '', '/', '0', '1', '0', '0', '1', '0', '2025-07-02 05:58:59', '2025-07-02 06:00:40'),
(2, 'About', '', '#', '0', '2', '0', '0', '1', '0', '2025-07-02 06:00:55', '2025-07-02 06:00:55'),
(3, 'Shop', '', '#', '0', '3', '0', '0', '1', '0', '2025-07-02 06:01:09', '2025-07-02 06:01:09'),
(4, 'Contact', '', '#', '0', '4', '0', '0', '1', '0', '2025-07-02 06:01:25', '2025-07-02 06:01:25'),
(5, 'Home', '', '/', '0', '5', '0', '0', '1', '1', '2025-07-03 01:10:33', '2025-07-03 01:10:33'),
(6, 'About', '', '/about', '0', '6', '0', '0', '1', '1', '2025-07-03 01:11:11', '2025-07-03 01:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_13_071536_create_pathao_courier_table', 1),
(6, '2024_12_23_154720_create_roles_table', 1),
(8, '2025_01_01_081809_create_categories_table', 1),
(9, '2025_01_02_104610_create_products_table', 1),
(11, '2025_01_08_071935_create_sliders_table', 1),
(12, '2025_01_09_054301_create_features_table', 1),
(13, '2025_01_09_115513_create_ImageGalleries_table', 1),
(14, '2025_01_12_060436_create_menus_table', 1),
(15, '2025_01_12_060721_create_settings_table', 1),
(18, '2025_02_20_091628_create_product_category_table', 1),
(19, '2025_04_29_045730_create_languages_table', 1),
(20, '2025_06_25_095519_create_email_templates_table', 1),
(21, '2025_06_25_100359_create_jobs_table', 1),
(22, '2024_12_23_154721_create_users_table', 2),
(23, '2025_07_03_074608_create_testimonails_table', 3);

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
-- Table structure for table `pathao-courier`
--

CREATE TABLE `pathao-courier` (
  `id` bigint UNSIGNED NOT NULL,
  `secret_token` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `refresh_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` double(10,2) DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `product_stock_qty` decimal(10,2) DEFAULT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `special_feature` text COLLATE utf8mb4_unicode_ci,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Pending ,1 = Publish',
  `producttype` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = single ,1 = variable',
  `brand_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `discount_price`, `price`, `product_stock_qty`, `product_sku`, `description`, `product_location`, `short_description`, `special_feature`, `status`, `producttype`, `brand_id`, `tag`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 2, 'Custom Floral Designs', NULL, 100.00, '0.00', NULL, 'Red Rose\r\n                                        Delight', NULL, 'Red Rose\r\n                                        Delight', NULL, '1', NULL, NULL, 'Sales', 'uploads/images/product/product-5-300x300_343.jpg', '2025-07-02 23:08:39', '2025-07-02 23:24:03'),
(2, 2, 'Red Rose Delight', 50.00, 100.00, NULL, NULL, '<p>Red Rose\r\n                                        Delight</p>', NULL, '<p>Red Rose\r\n                                        Delight</p>', NULL, '1', NULL, NULL, 'Sales', 'uploads/images/product/product-10-300x300_739.jpg', '2025-07-02 23:22:19', '2025-07-02 23:22:19'),
(3, 2, 'Periwinkle Flower', 80.00, 100.00, NULL, NULL, '<p>Periwinkle Flower</p>', NULL, '<p>Periwinkle Flower</p>', NULL, '1', NULL, NULL, 'Sales', 'uploads/images/product/product-7-300x300_509.jpg', '2025-07-02 23:23:58', '2025-07-02 23:23:58'),
(4, 2, 'Periwinkle Flowers Bouquet', 20.00, 100.00, '0.00', NULL, '<p>Periwinkle Flowers Bouquet</p>', NULL, '<p>Periwinkle Flowers Bouquet</p>', NULL, '1', NULL, NULL, 'Sales', 'uploads/images/product/product-1-300x300_588.jpg', '2025-07-02 23:24:43', '2025-07-03 05:56:21'),
(5, 2, 'Rose Flower Bouquet', 100.00, 150.00, NULL, NULL, '<p>Rose Flower Bouquet</p>', NULL, '<p>Rose Flower Bouquet</p>', NULL, '1', NULL, NULL, 'Sales', 'uploads/images/product/product-2-300x300_778.jpg', '2025-07-02 23:25:17', '2025-07-02 23:25:17'),
(6, 2, 'Tulip Custom Flower', 10.00, 120.00, '0.00', NULL, '<p>Tulip Custom Flower</p>', NULL, '<p>Tulip Custom Flower</p>', NULL, '1', NULL, NULL, 'Sales', 'uploads/images/product/product-4-300x300_507.jpg', '2025-07-02 23:25:54', '2025-07-03 05:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 4, 2, NULL, NULL),
(5, 5, 2, NULL, NULL),
(6, 6, 2, NULL, NULL),
(7, 6, 3, NULL, NULL),
(8, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2025-07-02 11:47:28', '2025-07-02 11:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `option_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_key`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'Flower Shop', '2025-07-02 06:20:54', '2025-07-03 03:08:36'),
(2, 'company_email', NULL, '2025-07-02 06:20:54', '2025-07-02 06:20:54'),
(3, 'company_cell', NULL, '2025-07-02 06:20:54', '2025-07-02 06:20:54'),
(4, 'company_copy_right', NULL, '2025-07-02 06:20:54', '2025-07-02 06:20:54'),
(5, 'currency', NULL, '2025-07-02 06:20:54', '2025-07-02 06:20:54'),
(6, 'admincontactmail', NULL, '2025-07-02 06:20:54', '2025-07-02 06:20:54'),
(7, 'company_primary_logo', 'uploads/images/company/dynamic/465cfbde-e0fc-41a8-8dee-bf72d904bdc2.jpg', '2025-07-02 06:20:54', '2025-07-02 06:20:54'),
(8, 'company_secondary_logo', 'uploads/images/company/dynamic/f278ccdf-1de4-485b-a019-bf04f62a12b2.jpg', '2025-07-02 06:20:54', '2025-07-02 06:20:54'),
(9, 'favicon_first', NULL, '2025-07-02 06:20:54', '2025-07-02 06:20:54'),
(10, 'commingsoonmode', '0', '2025-07-02 06:20:54', '2025-07-03 03:08:36'),
(11, 'herosectiontitle', 'Welcome to Florist', '2025-07-02 06:57:13', '2025-07-02 06:57:13'),
(12, 'herosectionsubtitle', 'Let\'s Make Beautiful Flowers a Part of Your Life.', '2025-07-02 06:57:13', '2025-07-02 06:57:13'),
(13, 'herosectionbtntitle', 'Shop Now', '2025-07-02 06:57:13', '2025-07-02 06:57:13'),
(14, 'herosectionbtnurltitle', '#', '2025-07-02 06:57:13', '2025-07-02 06:57:13'),
(15, 'herosectionshortdescription', '<p>Explore a vibrant tapestry\r\n                    of blooms\r\n                    and\r\n                    arrangements that add color, fragrance, and\r\n                    elegance\r\n                    to\r\n                    your life. Discover the perfect floral\r\n                    expression\r\n                    for\r\n                    every moment and occasion.</p>', '2025-07-02 06:57:13', '2025-07-02 06:57:13'),
(16, 'hero_section_bg_image', 'uploads/images/hero/hero-bg_349.jpg', '2025-07-02 06:57:13', '2025-07-02 06:57:13'),
(17, 'specialmomentssectiontitle', 'About Florist', '2025-07-02 08:12:22', '2025-07-02 08:12:22'),
(18, 'specialmomentssectionsubtitle', 'Blossoming Your Special Moments with Nature\'s Finest', '2025-07-02 08:12:22', '2025-07-02 08:12:22'),
(19, 'specialmomentssectionbtntitle', 'Read More', '2025-07-02 08:12:22', '2025-07-02 08:12:22'),
(20, 'specialmomentssectionbtnurltitle', '#', '2025-07-02 08:12:22', '2025-07-02 08:12:22'),
(21, 'specialmomentssectionshortdescription', '<p>Welcome to Florist, where floral artistry meets passion for nature\'s \r\nbeauty. Our story is rooted in a deep love for flowers and a commitment \r\nto creating unforgettable moments for our customers.</p>', '2025-07-02 08:12:22', '2025-07-02 08:12:22'),
(22, 'special_moments_section_first_image', 'uploads/images/special-moments/about-01_693.jpg', '2025-07-02 08:12:22', '2025-07-02 08:12:22'),
(23, 'special_moments_section_second_image', 'uploads/images/special-moments/about-02_475.jpg', '2025-07-02 08:12:22', '2025-07-02 08:12:22'),
(24, 'latestadditionssectiontitle', 'NEW ARRIVAL', '2025-07-02 08:31:05', '2025-07-02 08:31:05'),
(25, 'latestadditionssectionsubtitle', 'Discover the Latest Additions at Your Top Choice Flower Shop', '2025-07-02 08:31:05', '2025-07-02 08:31:05'),
(26, 'latestadditionssectionbtntitle', 'Share some details here. This is Flexible section where you can share anything you want.', '2025-07-02 08:31:05', '2025-07-02 08:31:05'),
(27, 'latestadditionssectionbtnurltitle', 'Sale!', '2025-07-02 08:31:05', '2025-07-02 08:31:05'),
(28, 'specialoffersectiontitle', 'SPECIAL OFFER', '2025-07-03 00:29:44', '2025-07-03 00:29:44'),
(29, 'specialoffersectionsubtitle', 'Your Floral Journey Begins Here: Get 20% Off Your First Order!', '2025-07-03 00:29:44', '2025-07-03 00:29:44'),
(30, 'specialoffersectionbtntitle', 'Shop Now', '2025-07-03 00:29:44', '2025-07-03 00:29:44'),
(31, 'specialoffersectionbtnurltitle', '#', '2025-07-03 00:29:44', '2025-07-03 00:29:44'),
(32, 'special_offer_section_image', 'uploads/images/special-offers/offer_567.jpg', '2025-07-03 00:29:44', '2025-07-03 00:29:44'),
(33, 'calltoactionsectiontitle', 'Call to action', '2025-07-03 00:36:45', '2025-07-03 00:36:45'),
(34, 'calltoactionsectionsubtitle', 'Explore Our Exquisite Floral Collections & Shop Now for the Perfect Blooms', '2025-07-03 00:36:45', '2025-07-03 00:36:45'),
(35, 'calltoactionsectionbtntitle', 'Shop Now', '2025-07-03 00:36:45', '2025-07-03 00:36:45'),
(36, 'calltoactionsectionbtnurltitle', '#', '2025-07-03 00:36:45', '2025-07-03 00:36:45'),
(37, 'call_to_action_section_image', 'uploads/images/call-to-action/final-cta_772.jpg', '2025-07-03 00:36:45', '2025-07-03 00:36:45'),
(38, 'footer_section_description_text', '<p><span class=\"copyright-title\">Welcome to the world of Florist, where \r\nflowers come to life with love and creativity. Discover our story, our \r\npassion for flowers, and our commitment to making every moment \r\nmemorable.</span></p>', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(39, 'footer_second_gird_title', 'Links', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(40, 'footer_section_third_title', 'Contact Us', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(41, 'footer_section_email', NULL, '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(42, 'footer_section_phone', '+1 234 567 8901', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(43, 'footer_section_copyright', 'Copyright © 2025 Flower Shop', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(44, 'footer_section_facebook_url', 'facebook', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(45, 'footer_section_twitter_url', 'twitter', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(46, 'footer_section_instagram_url', 'instagram', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(47, 'footer_section_youtube_url', 'youtube', '2025-07-03 01:31:36', '2025-07-03 01:31:36'),
(48, 'testimonailsectiontitle', 'TESTIMONAIL', '2025-07-03 01:43:28', '2025-07-03 01:43:28'),
(49, 'testimonailsectionsubtitle', 'Hear From Our Happy Customers', '2025-07-03 01:43:28', '2025-07-03 01:43:28'),
(50, 'testimonailsectiondescriptiontitle', 'Share some details here. This is Flexible section where you can share anything you want..', '2025-07-03 01:43:28', '2025-07-03 01:43:28'),
(51, 'favicon_second', NULL, '2025-07-03 03:08:36', '2025-07-03 03:08:36'),
(52, 'bestsellingsectiontitle', NULL, '2025-07-03 05:31:56', '2025-07-03 05:31:56'),
(53, 'bestsellingsectionsubtitle', NULL, '2025-07-03 05:31:56', '2025-07-03 05:31:56'),
(54, 'bestsellingsectiondescriptiontitle', NULL, '2025-07-03 05:31:56', '2025-07-03 05:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=Inactive, 1= active',
  `slider_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_m_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonails`
--

CREATE TABLE `testimonails` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ratting` int NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Pending , 1 = Publish',
  `review` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonails`
--

INSERT INTO `testimonails` (`id`, `name`, `designation`, `ratting`, `status`, `review`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Mila Kunis', 'Business Owner', 3, '1', '\"Absolutely stunning bouquets! The flowers arrived fresh and lasted for days. Highly recommended!\"', 'uploads/images/testimonail/testimonial-skip-01-1_339.jpg', '2025-07-03 02:31:35', '2025-07-03 03:08:02'),
(2, 'Wade Warren', 'Designer', 5, '1', '\"Prompt delivery and beautiful arrangements. My go-to flower shop for\r\n                        every occasion.\"', 'uploads/images/testimonail/testimonial-skip-02-1_401.jpg', '2025-07-03 02:33:58', '2025-07-03 02:59:12'),
(3, 'Steve Smith', 'Wedding Planner', 4, '1', '\"Absolutely stunning bouquets! The flowers arrived fresh and lasted\r\n                        for days. Highly recommended!\"', 'uploads/images/testimonail/testimonial-skip-01_728.jpg', '2025-07-03 02:35:14', '2025-07-03 03:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verify_code` longtext COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avater` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `fname`, `lname`, `phone`, `email`, `email_verified_at`, `verify_code`, `password`, `avater`, `subscription`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 1, 'Emon', 'Hossen', '0194507987', 'admin@gmail.com', '2025-07-02 11:45:40', NULL, '$2y$12$diJfF6iYVsU4kJxOJApYEO8j0yJ09FI2GkKceX0OwwJK35e6s08Gq', NULL, NULL, NULL, '2025-07-02 11:45:40', '2025-07-02 11:45:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagegalleries`
--
ALTER TABLE `imagegalleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagegalleries_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pathao-courier`
--
ALTER TABLE `pathao-courier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_product_id_foreign` (`product_id`),
  ADD KEY `product_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonails`
--
ALTER TABLE `testimonails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `imagegalleries`
--
ALTER TABLE `imagegalleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pathao-courier`
--
ALTER TABLE `pathao-courier`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonails`
--
ALTER TABLE `testimonails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `imagegalleries`
--
ALTER TABLE `imagegalleries`
  ADD CONSTRAINT `imagegalleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
