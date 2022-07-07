-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 03:25 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_lunartech`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `percent` int(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `description`, `image`, `price`, `percent`, `status`, `link`, `position`, `click_name`, `page`, `created_at`, `updated_at`) VALUES
(5, '123456', NULL, '202206291935.png', NULL, NULL, 'Published', NULL, 'Second', 'Wick', 'Home', '2022-06-29 17:35:31', '2022-06-30 10:20:24'),
(15, 'SHOP AND <strong>SAVE BIG</strong> ON HOTTEST DEALS', 'ggggg', '202206301100.png', 1234, 34200, 'Published', 'eerfd', 'First', 'eeerr', 'Home', '2022-06-30 09:00:57', '2022-06-30 09:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `ad_users`
--

CREATE TABLE `ad_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_users`
--

INSERT INTO `ad_users` (`id`, `ad_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 5, 1, NULL, '2022-06-30 10:20:24'),
(3, 15, 1, '2022-06-30 09:00:57', '2022-06-30 09:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `basic_infos`
--

CREATE TABLE `basic_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operating_hours` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_infos`
--

INSERT INTO `basic_infos` (`id`, `company_logo`, `company_name`, `company_phone_number`, `company_email`, `company_address`, `email_two`, `operating_hours`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Test', '54443456', 'abc@dc.rf', '12 J, Mor', 'mgh@g.com', '', '2022-06-17 05:03:24', '2022-06-17 05:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Ahoo', '202206301425.png', '2022-06-30 12:25:57', '2022-06-30 12:47:40'),
(3, 'Trep', '202206301449.png', '2022-06-30 12:49:55', '2022-06-30 12:53:12'),
(4, 'One', '202206301455.png', '2022-06-30 12:55:44', '2022-06-30 12:55:44'),
(5, 'Home', '202206301456.png', '2022-06-30 12:56:30', '2022-06-30 12:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shopping_session` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_fee` int(11) DEFAULT NULL,
  `cart_subtotal` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `shopping_session`, `customer_id`, `ip_address`, `shipping_fee`, `cart_subtotal`, `total`, `created_at`, `updated_at`) VALUES
(4, 'bprwjyn3irseowxmb2gov5yfbnbix3', 1, NULL, NULL, NULL, 3400, '2022-06-29 11:31:12', '2022-06-29 11:31:12'),
(6, '39aaskuq9otowrhuzp1lbybh8etoyd', 1, NULL, 2000, 26428, 28428, '2022-07-05 05:05:17', '2022-07-07 00:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `cart_id` bigint(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `product_variation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `product_id`, `cart_id`, `quantity`, `product_variation`, `created_at`, `updated_at`) VALUES
(140, 1, 6, 25, NULL, '2022-07-07 00:02:54', '2022-07-07 00:02:54'),
(141, 8, 6, 1, NULL, '2022-07-07 00:02:54', '2022-07-07 00:02:54'),
(142, 2, 6, 1, NULL, '2022-07-07 00:02:54', '2022-07-07 00:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `status`, `position`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Latest', 'Latest', 'latest', 'published', NULL, NULL, '2022-06-01 07:59:01', '2022-06-01 07:59:01'),
(2, 'Trending', 'Trending', 'trending', 'published', NULL, NULL, '2022-06-01 10:05:19', '2022-06-01 10:05:19'),
(3, 'Hot Deals', NULL, 'hot-deals', 'published', NULL, NULL, '2022-06-01 10:46:53', '2022-06-01 10:46:53'),
(4, 'On Promotion', NULL, 'promotion', 'published', NULL, NULL, '2022-06-01 10:47:52', '2022-06-01 10:47:52'),
(5, 'Laptops', 'Laptops', NULL, 'Published', 'Second', '202206281142.png', '2022-06-28 08:35:07', '2022-06-28 09:50:25'),
(6, 'Smart Phones', NULL, NULL, 'Published', 'Third', '202206281044.png', '2022-06-28 08:35:33', '2022-06-28 09:52:08'),
(7, 'Memory Stick', 'Memory Stick', 'memory-stick', 'Published', 'First', '202206281134.png', '2022-06-28 09:34:30', '2022-06-28 09:34:30'),
(8, 'Processors', 'Processors', 'processors', 'Published', 'Forth', '202206281151.png', '2022-06-28 09:51:43', '2022-06-28 09:51:43'),
(9, 'Accessories', 'Accessories', 'accessories', 'Published', 'Fifth', '202206281154.png', '2022-06-28 09:54:25', '2022-06-28 09:55:06'),
(10, 'SSD', 'ssd', 'ssd', 'Published', 'Sixth', '202206281200.png', '2022-06-28 10:00:13', '2022-06-28 10:02:22'),
(11, 'Bags', 'bags', 'bags', 'Published', 'Seventh', '202206281203.png', '2022-06-28 10:03:30', '2022-06-28 10:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  `start_period` datetime DEFAULT NULL,
  `end_period` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `product_id`, `name`, `discount_percent`, `start_period`, `end_period`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Discount Percentage', 23, NULL, NULL, NULL, '2022-06-01 07:58:08', '2022-06-28 12:53:12'),
(2, 2, 'Discount Percentage', 30, NULL, NULL, NULL, '2022-06-01 08:01:06', '2022-07-01 03:38:32'),
(3, 3, 'Discount Percentage', 12, NULL, NULL, NULL, '2022-06-01 10:19:59', '2022-06-01 10:19:59'),
(4, 4, 'Discount Percentage', 30, NULL, NULL, NULL, '2022-06-01 10:22:04', '2022-06-29 07:04:13'),
(5, 5, 'Discount Percentage', 40, NULL, NULL, NULL, '2022-06-01 10:22:42', '2022-06-01 10:24:31'),
(6, 6, 'Discount Percentage', 10, NULL, NULL, NULL, '2022-06-01 10:24:00', '2022-06-01 11:30:29'),
(7, 7, 'Discount Percentage', 30, NULL, NULL, NULL, '2022-06-01 11:53:25', '2022-06-01 12:07:58'),
(8, 8, 'Discount Percentage', 33, NULL, NULL, NULL, '2022-06-01 12:02:39', '2022-06-01 12:04:25');

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
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `in_store_quantity` bigint(20) DEFAULT NULL,
  `in_warehouse_quantity` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `in_store_quantity`, `in_warehouse_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 43, 100, '2022-06-01 07:58:08', '2022-07-05 11:04:01'),
(2, 2, 94, 12, '2022-06-01 08:01:06', '2022-07-05 10:16:35'),
(3, 3, 100, 7, '2022-06-01 10:19:59', '2022-07-03 09:23:57'),
(4, 4, 98, 40, '2022-06-01 10:22:04', '2022-06-29 07:40:48'),
(5, 5, 94, 40, '2022-06-01 10:22:42', '2022-06-29 07:40:38'),
(6, 6, 77, 30, '2022-06-01 10:24:00', '2022-06-29 11:31:23'),
(7, 7, 40, 100, '2022-06-01 11:53:25', '2022-06-23 17:02:42'),
(8, 8, 100, 23, '2022-06-01 12:02:39', '2022-07-05 09:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_05_11_113659_create_sessions_table', 1),
(7, '2022_05_11_131202_create_products_table', 1),
(8, '2022_05_11_131221_create_categories_table', 1),
(9, '2022_05_11_131237_create_inventories_table', 1),
(10, '2022_05_11_131356_create_brands_table', 1),
(11, '2022_05_11_131701_create_product_images_table', 1),
(12, '2022_05_11_131720_create_discounts_table', 1),
(13, '2022_05_11_203206_create_variations_table', 1),
(14, '2022_05_11_203805_create_tags_table', 1),
(15, '2022_05_17_132023_create_product_metas_table', 1),
(16, '2022_05_18_075423_create_product_tags_table', 1),
(17, '2022_05_18_095215_create_taxes_table', 1),
(18, '2022_05_18_122725_create_product_brands_table', 1),
(19, '2022_05_19_195732_create_product_categories_table', 1),
(20, '2022_05_25_083330_create_user_products_table', 1),
(25, '2022_05_26_214210_create_payment_details_table', 1),
(26, '2022_05_30_102325_create_sales_table', 1),
(63, '2022_05_26_204659_create_cart_items_table', 2),
(64, '2022_05_26_204720_create_orders_table', 2),
(65, '2022_05_26_204742_create_order_items_table', 1),
(68, '2022_06_17_025520_create_basic_infos_table', 1),
(71, '2022_06_02_192122_create_quotes_table', 1),
(72, '2022_06_06_052510_create_quote_items_table', 1),
(73, '2022_06_17_135921_create_product_serial_numbers_table', 1),
(77, '2022_06_20_133231_create_purchases_table', 1),
(78, '2022_06_20_134541_create_warehouses_table', 1),
(79, '2022_06_21_145557_create_shelves_table', 1),
(80, '2022_05_26_204403_create_carts_table', 3),
(82, '2022_06_22_203306_create_suppliers_table', 4),
(84, '2022_06_24_124124_create_product_stickers_table', 3),
(86, '2022_06_24_123715_create_stickers_table', 5),
(88, '2022_06_29_094843_create_ads_table', 6),
(89, '2022_06_30_074911_create_ad_users_table', 7),
(90, '2022_07_06_155217_create_roles_table', 8),
(92, '2022_07_07_051221_create_messages_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `payment_id` bigint(20) DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` mediumint(100) DEFAULT NULL,
  `shipping_fee` mediumint(100) DEFAULT NULL,
  `total` mediumint(9) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `payment_id`, `reference_id`, `subtotal`, `shipping_fee`, `total`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(4, 21, NULL, 'ORDER20025238-79', 6000, 2000, 18500, 'Processing', NULL, '2022-06-20 12:52:38', '2022-06-20 12:52:38'),
(5, 21, NULL, 'ORDER20025617-94', 1500, 2000, 60600, 'Processing', NULL, '2022-06-20 12:56:17', '2022-06-20 12:56:17'),
(6, 1, NULL, 'ORDER21030149-62', 4400, 2000, 70000, 'Processing', NULL, '2022-06-21 13:01:49', '2022-06-21 13:01:49'),
(7, 23, NULL, 'ORDER21031144-32', 1500, 2000, 31500, 'Processing', NULL, '2022-06-21 13:11:44', '2022-06-21 13:11:44'),
(8, 1, NULL, 'ORDER23100424-6', 1500, 2000, 86300, 'Processing', NULL, '2022-06-23 08:04:24', '2022-06-23 08:04:24'),
(9, 1, NULL, 'ORDER23022304-56', 2200, 2000, 48000, 'Processing', NULL, '2022-06-23 12:23:04', '2022-06-23 12:23:04'),
(10, 1, NULL, 'ORDER29013045-20', 6800, 2000, 92800, 'Processing', NULL, '2022-06-29 11:30:45', '2022-06-29 11:30:45'),
(11, 1, NULL, 'ORDER04070059-85', 990, 2000, 9824, 'Processing', NULL, '2022-07-04 17:00:59', '2022-07-04 17:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` int(20) DEFAULT NULL,
  `product_total` mediumint(100) DEFAULT NULL,
  `order_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `product_name`, `unit_price`, `product_total`, `order_id`, `quantity`, `delivery_date`, `created_at`, `updated_at`) VALUES
(3, 5, 'Samsung 11', NULL, 10500, 4, 3, NULL, '2022-06-20 12:52:39', '2022-06-20 12:52:39'),
(4, 2, 'LG', NULL, 6000, 4, 4, NULL, '2022-06-20 12:52:39', '2022-06-20 12:52:39'),
(5, 8, 'Phone', NULL, 6800, 5, 2, NULL, '2022-06-20 12:56:17', '2022-06-20 12:56:17'),
(6, 7, 'Cable', NULL, 40000, 5, 4, NULL, '2022-06-20 12:56:18', '2022-06-20 12:56:18'),
(7, 6, 'Moto 11', NULL, 3300, 5, 3, NULL, '2022-06-20 12:56:18', '2022-06-20 12:56:18'),
(8, 5, 'Samsung 11', NULL, 7000, 5, 2, NULL, '2022-06-20 12:56:18', '2022-06-20 12:56:18'),
(9, 2, 'LG', NULL, 1500, 5, 1, NULL, '2022-06-20 12:56:19', '2022-06-20 12:56:19'),
(10, 8, 'Phone', NULL, 13600, 6, 4, NULL, '2022-06-21 13:01:49', '2022-06-21 13:01:49'),
(11, 7, 'Cable', NULL, 50000, 6, 5, NULL, '2022-06-21 13:01:49', '2022-06-21 13:01:49'),
(12, 6, 'Moto 11', NULL, 4400, 6, 4, NULL, '2022-06-21 13:01:49', '2022-06-21 13:01:49'),
(13, 7, 'Cable', NULL, 20000, 7, 2, NULL, '2022-06-21 13:11:44', '2022-06-21 13:11:44'),
(14, 8, 'Phone', NULL, 3400, 7, 1, NULL, '2022-06-21 13:11:44', '2022-06-21 13:11:44'),
(15, 6, 'Moto 11', NULL, 1100, 7, 1, NULL, '2022-06-21 13:11:44', '2022-06-21 13:11:44'),
(16, 5, 'Samsung 11', NULL, 3500, 7, 1, NULL, '2022-06-21 13:11:44', '2022-06-21 13:11:44'),
(17, 2, 'LG', NULL, 1500, 7, 1, NULL, '2022-06-21 13:11:44', '2022-06-21 13:11:44'),
(18, 8, 'Phone', NULL, 13600, 8, 4, NULL, '2022-06-23 08:04:25', '2022-06-23 08:04:25'),
(19, 7, 'Cable', NULL, 60000, 8, 6, NULL, '2022-06-23 08:04:25', '2022-06-23 08:04:25'),
(20, 5, 'Samsung 11', NULL, 7000, 8, 2, NULL, '2022-06-23 08:04:25', '2022-06-23 08:04:25'),
(21, 6, 'Moto 11', NULL, 2200, 8, 2, NULL, '2022-06-23 08:04:25', '2022-06-23 08:04:25'),
(22, 2, 'LG', NULL, 1500, 8, 1, NULL, '2022-06-23 08:04:25', '2022-06-23 08:04:25'),
(23, 8, 'Phone', NULL, 23800, 9, 7, NULL, '2022-06-23 12:23:04', '2022-06-23 12:23:04'),
(24, 7, 'Cable', NULL, 20000, 9, 2, NULL, '2022-06-23 12:23:04', '2022-06-23 12:23:04'),
(25, 6, 'Moto 11', NULL, 2200, 9, 2, NULL, '2022-06-23 12:23:04', '2022-06-23 12:23:04'),
(26, 7, 'Cable', NULL, 50000, 10, 5, NULL, '2022-06-29 11:30:45', '2022-06-29 11:30:45'),
(27, 6, 'Moto 11', NULL, 14300, 10, 13, NULL, '2022-06-29 11:30:45', '2022-06-29 11:30:45'),
(28, 5, 'Samsung 11', NULL, 17500, 10, 5, NULL, '2022-06-29 11:30:45', '2022-06-29 11:30:45'),
(29, 4, 'Samsung', NULL, 2200, 10, 1, NULL, '2022-06-29 11:30:45', '2022-06-29 11:30:45'),
(30, 8, 'Phone', NULL, 6800, 10, 2, NULL, '2022-06-29 11:30:45', '2022-06-29 11:30:45'),
(31, 8, 'Phone', 2278, 6834, 11, 3, NULL, '2022-07-04 17:01:00', '2022-07-04 17:01:00'),
(32, 6, 'Moto 11', 990, 990, 11, 1, NULL, '2022-07-04 17:01:00', '2022-07-04 17:01:00');

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
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_offer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` bigint(20) DEFAULT NULL,
  `serialnumber` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrcode` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `zwl_price` bigint(20) DEFAULT NULL,
  `physical_delivery` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `short_description`, `product_thumbnail`, `sku`, `status`, `special_offer`, `barcode`, `serialnumber`, `qrcode`, `price`, `zwl_price`, `physical_delivery`, `weight`, `width`, `height`, `length`, `created_at`, `updated_at`) VALUES
(1, 'Grepper', 'Grepper', 'Grepper', '202206011312.png', '1234', 'Published', NULL, 1234, '1234', '1234', 1200, 12000, 'Yes', 1, 12, 12, 12, '2022-06-01 07:58:08', '2022-07-06 09:20:28'),
(2, 'LG', 'LG', 'LG', '202206302008.jpg', '1212', 'Published', NULL, 1212, '1212', '1212', 1500, 15000, 'Yes', 12, 12, 12, 12, '2022-06-01 08:01:06', '2022-07-05 20:23:11'),
(3, 'Apple', 'Apple', 'Apple', '202206011219.png', '11', 'Published', NULL, 11111111111111111, '1212', '11', 1200, 12000, 'Yes', 23, 12, 12, 12, '2022-06-01 10:19:59', '2022-07-03 09:24:38'),
(4, 'Samsung', 'Samsung', 'Samsung', '202206011222.png', NULL, 'Published', NULL, NULL, NULL, NULL, 2200, 12898, 'Yes', 21, 1, 2, 4, '2022-06-01 10:22:04', '2022-07-03 09:28:06'),
(5, 'Samsung 11', 'Samsung', 'Samsung', '202206011222.png', NULL, 'Published', 'Yes', NULL, NULL, NULL, 3500, 12898, 'Yes', 22, 1, 2, 4, '2022-06-01 10:22:42', '2022-06-28 17:10:12'),
(6, 'Moto 11', 'Samsung', 'Samsung', '202206011224.png', NULL, 'Published', NULL, NULL, NULL, NULL, 1100, 12898, 'Yes', 44, 1, 2, 4, '2022-06-01 10:24:00', '2022-07-03 09:28:32'),
(7, 'Cable', 'Cable', 'Cable', '202206011353.png', NULL, 'Published', NULL, NULL, NULL, NULL, 10000, 12000, NULL, 31, 23, 33, 21, '2022-06-01 11:53:25', '2022-07-04 18:11:49'),
(8, 'Phone', 'Phone', 'Phone', '202206021448.png', '4545', 'Published', NULL, 4545, '4545', '4545', 3400, 100899, NULL, 23, 3, 2, 3, '2022-06-01 12:02:39', '2022-07-05 19:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `brand_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `product_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(6, 3, 3, '2022-07-03 09:24:38', '2022-07-03 09:24:38'),
(7, 4, 5, '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(8, 4, 4, '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(9, 6, 4, '2022-07-03 09:28:32', '2022-07-03 09:28:32'),
(16, 7, 3, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(17, 7, 2, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(30, 2, 2, '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(31, 2, 4, '2022-07-05 20:23:11', '2022-07-05 20:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(110, 5, 2, '2022-06-28 17:10:12', '2022-06-28 17:10:12'),
(111, 5, 3, '2022-06-28 17:10:12', '2022-06-28 17:10:12'),
(112, 5, 8, '2022-06-28 17:10:12', '2022-06-28 17:10:12'),
(128, 3, 1, '2022-07-03 09:24:38', '2022-07-03 09:24:38'),
(129, 3, 2, '2022-07-03 09:24:38', '2022-07-03 09:24:38'),
(130, 3, 11, '2022-07-03 09:24:38', '2022-07-03 09:24:38'),
(143, 4, 5, '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(144, 4, 1, '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(145, 4, 9, '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(146, 4, 8, '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(147, 6, 1, '2022-07-03 09:28:32', '2022-07-03 09:28:32'),
(148, 6, 2, '2022-07-03 09:28:32', '2022-07-03 09:28:32'),
(149, 6, 3, '2022-07-03 09:28:32', '2022-07-03 09:28:32'),
(150, 6, 5, '2022-07-03 09:28:32', '2022-07-03 09:28:32'),
(158, 7, 3, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(159, 7, 2, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(160, 7, 10, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(229, 8, 2, '2022-07-05 19:36:45', '2022-07-05 19:36:45'),
(230, 8, 7, '2022-07-05 19:36:45', '2022-07-05 19:36:45'),
(257, 2, 1, '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(258, 2, 3, '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(337, 1, 1, '2022-07-06 09:20:28', '2022-07-06 09:20:28'),
(338, 1, 2, '2022-07-06 09:20:28', '2022-07-06 09:20:28'),
(339, 1, 6, '2022-07-06 09:20:28', '2022-07-06 09:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product_option_id` bigint(20) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_option_id`, `image`, `created_at`, `updated_at`) VALUES
(34, 1, NULL, '1737601980236960.png', '2022-07-06 09:19:40', '2022-07-06 09:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_metas`
--

CREATE TABLE `product_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_metas`
--

INSERT INTO `product_metas` (`id`, `product_id`, `title`, `description`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 1, '1234', '1234', '1234', '2022-06-01 07:58:08', '2022-06-01 07:58:08'),
(2, 2, 'Product', '12', '12', '2022-06-01 08:01:06', '2022-06-01 08:01:06'),
(3, 3, 'Apple', 'Apple', 'Apple', '2022-06-01 10:19:59', '2022-06-01 10:19:59'),
(4, 4, 'Samsung', 'Samsung', 'Samsung', '2022-06-01 10:22:04', '2022-06-01 10:22:04'),
(5, 5, 'Samsung', 'Samsung', 'Samsung', '2022-06-01 10:22:42', '2022-06-01 10:22:42'),
(6, 6, 'Samsung', 'Samsung', 'Samsung', '2022-06-01 10:24:00', '2022-06-01 10:24:00'),
(7, 7, NULL, NULL, NULL, '2022-06-01 11:53:25', '2022-06-01 11:53:25'),
(8, 8, '4545', '4545', '4545', '2022-06-01 12:02:39', '2022-06-01 12:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_serial_numbers`
--

CREATE TABLE `product_serial_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_serial_numbers`
--

INSERT INTO `product_serial_numbers` (`id`, `product_id`, `serial_number`, `created_at`, `updated_at`) VALUES
(101, 4, '1234567', '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(102, 4, '777777777777', '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(103, 4, '6666666666', '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(251, 8, '777777777777', '2022-07-05 19:36:45', '2022-07-05 19:36:45'),
(252, 8, '444444444445', '2022-07-05 19:36:45', '2022-07-05 19:36:45'),
(253, 8, '1234567', '2022-07-05 19:36:45', '2022-07-05 19:36:45'),
(297, 2, '1234567', '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(298, 2, '777777777777', '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(299, 2, '6666666666', '2022-07-05 20:23:11', '2022-07-05 20:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_stickers`
--

CREATE TABLE `product_stickers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `sticker_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`id`, `product_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(26, 3, 3, '2022-07-03 09:24:38', '2022-07-03 09:24:38'),
(27, 3, 2, '2022-07-03 09:24:38', '2022-07-03 09:24:38'),
(30, 4, 3, '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(31, 4, 4, '2022-07-03 09:28:06', '2022-07-03 09:28:06'),
(39, 7, 2, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(40, 7, 1, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(41, 7, 4, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(42, 7, 5, '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(77, 8, 2, '2022-07-05 19:36:45', '2022-07-05 19:36:45'),
(108, 2, 2, '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(109, 2, 1, '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(110, 2, 3, '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(111, 2, 4, '2022-07-05 20:23:11', '2022-07-05 20:23:11'),
(238, 1, 4, '2022-07-06 09:20:28', '2022-07-06 09:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `product_name`, `supplier_id`, `quantity`, `cost`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(6, 'Apple we', 1, 223, 20000, 'Delivered', 'fghkk,', '2022-06-22 20:25:11', '2022-06-22 20:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `quote_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `subtotal_cents` int(11) DEFAULT NULL,
  `zw_subtotal_cents` int(11) DEFAULT NULL,
  `grandtotal_cents` int(11) DEFAULT NULL,
  `zw_grandtotal_cents` int(11) DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote_due_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `user_id`, `quote_number`, `billing_name`, `billing_address`, `billing_email`, `billing_phone`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_address`, `tax`, `discount`, `subtotal_cents`, `zw_subtotal_cents`, `grandtotal_cents`, `zw_grandtotal_cents`, `notes`, `quote_date`, `quote_due_date`, `created_at`, `updated_at`) VALUES
(1, 1, '#QUOTE-2022171009', 'Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi', 'Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi', 'hi@hi.hi', 'Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi', 'Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi', 'Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi', 'hi@hey.hey', 'Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi Hi Hi Hi  Hi  Hi  Hi  Hi  Hi  Hi', 23, 15, 4500, NULL, 4860, NULL, '1qdsdfg Mark Mark v Mark Mark Mark Mark MarkMark Mark', '1212-11-11', '1212-12-12', '2022-06-17 08:13:09', '2022-06-17 08:40:22'),
(3, 1, '#QUOTE-2022290342', 'Billing Details', 'Billing Details', 'asc@d.com', '1234', 'Billing Details', '3334445', 'asds@fg.com', 'Billing Details', 21, 11, 6000, NULL, 6600, NULL, NULL, '1111-11-11', '2222-02-22', '2022-06-29 13:16:42', '2022-06-29 13:16:42'),
(4, 1, '#QUOTE-2022040857', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, 12, 9500, NULL, 10545, NULL, NULL, NULL, NULL, '2022-07-04 06:56:57', '2022-07-04 06:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `quote_items`
--

CREATE TABLE `quote_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` bigint(20) DEFAULT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `price_cents` int(11) DEFAULT NULL,
  `zw_price_cents` int(11) DEFAULT NULL,
  `total_cents` int(11) DEFAULT NULL,
  `zw_total_cents` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quote_items`
--

INSERT INTO `quote_items` (`id`, `quote_id`, `product_name`, `description`, `quantity`, `price_cents`, `zw_price_cents`, `total_cents`, `zw_total_cents`, `created_at`, `updated_at`) VALUES
(10, 1, 'Sam', NULL, 3, 300, NULL, 900, NULL, '2022-06-17 08:40:22', '2022-06-17 08:40:22'),
(11, 1, 'a', NULL, 7, 400, NULL, 2800, NULL, '2022-06-17 08:40:22', '2022-06-17 08:40:22'),
(12, 1, 'Apple', NULL, 4, 200, NULL, 800, NULL, '2022-06-17 08:40:22', '2022-06-17 08:40:22'),
(16, 3, 'Apple', NULL, 5, 1200, NULL, 6000, NULL, '2022-06-29 13:16:42', '2022-06-29 13:16:42'),
(17, 4, 'Apple', NULL, 5, 1200, NULL, 6000, NULL, '2022-07-04 06:56:57', '2022-07-04 06:56:57'),
(18, 4, 'qwert', NULL, 1, 1200, NULL, 1200, NULL, '2022-07-04 06:56:57', '2022-07-04 06:56:57'),
(19, 4, 'qwert', NULL, 1, 2300, NULL, 2300, NULL, '2022-07-04 06:56:57', '2022-07-04 06:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL, NULL),
(2, 'Manager', NULL, NULL, NULL),
(3, 'Operator', NULL, NULL, NULL),
(4, 'Customer', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kVIIilSQp9OonWF8Bz2gRQnAgXpuGZI4AGGJi8g9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVFhnVzFZd2tkOGlPZUR4eGJOdHNheGtXYTA3WGdMaHdrRkdiVE9ueCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1657200023);

-- --------------------------------------------------------

--
-- Table structure for table `shelves`
--

CREATE TABLE `shelves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stickers`
--

CREATE TABLE `stickers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` int(20) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone_number`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'New Supplier', 'Test', NULL, 'Test', '2022-06-22 20:04:08', '2022-06-22 20:25:11'),
(2, 'notari', 'notari', 'notari', 'notari', '2022-06-22 20:43:09', '2022-06-22 20:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(20) DEFAULT NULL,
  `percent` int(20) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `subtitle`, `amount`, `percent`, `slug`, `status`, `click_name`, `image`, `position`, `created_at`, `updated_at`) VALUES
(1, 'General General', 'General General', 2300, 34, 'latest', 'Published', 'General General', '202206271843.png', 'Second', '2022-06-27 12:34:51', '2022-07-04 17:58:25'),
(2, 'CATCH BIG <strong>DEALS</strong> ON THE CAMERAS', 'Tag Title Tag Title Tag', 3200, 23, 'promotion', 'Published', 'CATCH BIG DEALS', '202206271846.png', 'First', '2022-06-27 12:39:46', '2022-06-30 11:28:03'),
(3, 'Latest Products Latest Products', 'Latest Products', 3400, 30, 'featured', 'Published', 'Latest Products', '202206271903.png', 'Third', '2022-06-27 17:03:10', '2022-07-04 17:50:30'),
(4, 'CATCH <b>BIG DEALS</b> ON THE CAMERAS', 'CATCH <b>BIG DEAL CAMERAS</b>', 2200, 15, 'hot-deals', 'Published', 'Buy better', '202206271910.png', 'Forth', '2022-06-27 17:10:35', '2022-07-04 17:49:19'),
(5, 'BUY THE <B>TRENDING PRODUCTS</B>', 'AT A DISCOUNT', 34000, 15, 'trending', 'Published', 'TRENDING PRODUCTS', '202206301900.png', 'Fifth', '2022-06-30 17:00:29', '2022-07-04 17:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_percent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `product_id`, `name`, `amount_percent`, `created_at`, `updated_at`) VALUES
(1, 1, 'Taxable Goods', '15', '2022-06-01 07:58:08', '2022-06-01 07:58:08'),
(2, 2, 'Taxable Goods', '12', '2022-06-01 08:01:06', '2022-06-01 08:01:06'),
(3, 3, 'Taxable Goods', '15', '2022-06-01 10:19:59', '2022-06-01 10:19:59'),
(4, 4, 'Taxable Goods', '2300', '2022-06-01 10:22:04', '2022-06-01 10:22:04'),
(5, 5, 'Taxable Goods', '2300', '2022-06-01 10:22:42', '2022-06-01 10:22:42'),
(6, 6, 'Downloadable Product', '2300', '2022-06-01 10:24:00', '2022-06-01 10:24:00'),
(7, 7, 'Select option below', NULL, '2022-06-01 11:53:25', '2022-06-01 12:07:58'),
(8, 8, 'Taxable Goods', '23', '2022-06-01 12:02:39', '2022-06-01 12:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `first_name`, `last_name`, `address`, `phone_number`, `date_of_birth`, `id_number`, `code`, `status`, `gender`, `image`, `role_id`, `email_verified_at`, `password`, `city`, `company_name`, `delivery_address`, `company_email`, `company_phone_number`, `company_address`, `company_city`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Mark', 'admin@gmail.com', 'Jame', 'Time', '12 ABC qwer', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 1, NULL, '$2y$10$zaQCcvVj3jOVcFgNqH/T9.g2Qkeba8gH3mYSVfm9ZaJ0WFkgtHYjK', 'Harare', 'FL', NULL, 'mark@gmail.com', NULL, 'Qwerty 12 etr', 'Harare', NULL, NULL, NULL, 'ruLnOf0UDn5pVkEoOvgkGezcdzqWY8enlWGkMGuUNpiYf7r0ZNONUXTL1m4e', NULL, NULL, '2022-06-01 07:55:19', '2022-06-21 13:01:49'),
(21, NULL, 'john@gmail.com', 'John', 'Rohn', '1', '12345678', '34', '232345', NULL, NULL, 'Male', NULL, 4, NULL, '$2y$10$w.ng9mZQpQr42s3hb87PJenoy4dyGWO5CJE.d4MI8KtT299BsUJNC', '34', 'Company', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kEEQZbUv3U1TGeipSD6pF3wvUSIF53slBcvz56cwLSNs2hs3wLfH38WGq58W', NULL, NULL, '2022-06-16 07:23:26', '2022-07-07 01:00:46'),
(22, 'test', 'test@gmail.com', 'Test', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '$2y$10$kLFqMU3FHG5jiRQSWzTE9OniauKcvsqrHps2IU2m2hejimYtiISwO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '90Pt7YE3itI2xF7Ppi452lSUbkshxXAeEpZQIhJt6dyaNeFGzGQF9cyJd0O9', NULL, NULL, '2022-06-16 19:07:36', '2022-06-16 19:07:36'),
(23, 'Mar', 'mar@a.com', 'Mar', 'Mar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '$2y$10$xQpEIU0ipVipmtGbmIfVeeFzSr.QQUxnHEqNnBwlO4cdQvR/kDJci', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xPCR29O7mZ1EP2YW6I1Zb5JIhQw9mbNcXxrX6CbNF5f5X7yYs7vVA2vwIbZ1', NULL, NULL, '2022-06-21 13:08:47', '2022-06-21 13:11:44'),
(27, 'Jay', 'jay@gmail.com', 'ghhhh', 'jbjkbj', 'fhgf 767 gfhvh', '88888', '34jjfytj56656', '565654564565', '908603', NULL, 'Male', NULL, 3, NULL, '$2y$10$Dx/x/coBlcXIh1q1OKT91eQ/ak0M5DX2xOE9ZiBJw5aD9oIVB0viq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-06 14:20:08', '2022-07-06 23:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_products`
--

CREATE TABLE `user_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_products`
--

INSERT INTO `user_products` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-06-01 07:58:08', '2022-06-01 07:58:08'),
(2, 1, 2, '2022-06-01 08:01:06', '2022-06-01 08:01:06'),
(3, 1, 3, '2022-06-01 10:19:59', '2022-06-01 10:19:59'),
(4, 1, 4, '2022-06-01 10:22:04', '2022-06-01 10:22:04'),
(5, 1, 5, '2022-06-01 10:22:42', '2022-06-01 10:22:42'),
(6, 1, 6, '2022-06-01 10:24:00', '2022-06-01 10:24:00'),
(7, 1, 7, '2022-06-01 11:53:25', '2022-06-01 11:53:25'),
(8, 1, 8, '2022-06-01 12:02:39', '2022-06-01 12:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `product_id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(78, 3, 'Color', 'Blue', '2022-07-03 09:24:39', '2022-07-03 09:24:39'),
(84, 6, 'Texture', 'Paper', '2022-07-03 09:28:32', '2022-07-03 09:28:32'),
(92, 7, 'Type', 'Single', '2022-07-04 18:11:49', '2022-07-04 18:11:49'),
(99, 2, 'Mark', 'Chovava', '2022-07-05 20:23:12', '2022-07-05 20:23:12'),
(119, 1, 'Color', 'Red', '2022-07-06 09:20:28', '2022-07-06 09:20:28'),
(120, 1, 'Texture', 'Plastic', '2022-07-06 09:20:28', '2022-07-06 09:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_users`
--
ALTER TABLE `ad_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_infos`
--
ALTER TABLE `basic_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_metas`
--
ALTER TABLE `product_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_serial_numbers`
--
ALTER TABLE `product_serial_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stickers`
--
ALTER TABLE `product_stickers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shelves`
--
ALTER TABLE `shelves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stickers`
--
ALTER TABLE `stickers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `company_name` (`company_name`);

--
-- Indexes for table `user_products`
--
ALTER TABLE `user_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ad_users`
--
ALTER TABLE `ad_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `basic_infos`
--
ALTER TABLE `basic_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_metas`
--
ALTER TABLE `product_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_serial_numbers`
--
ALTER TABLE `product_serial_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT for table `product_stickers`
--
ALTER TABLE `product_stickers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shelves`
--
ALTER TABLE `shelves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stickers`
--
ALTER TABLE `stickers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_products`
--
ALTER TABLE `user_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
