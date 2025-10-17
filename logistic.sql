-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 09:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistic`
--

-- --------------------------------------------------------

--
-- Table structure for table `common_questions`
--

CREATE TABLE `common_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`description`)),
  `metadata_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_title`)),
  `metadata_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_description`)),
  `metadata_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_keywords`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_by` varchar(255) DEFAULT 'admin',
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `common_questions`
--

INSERT INTO `common_questions` (`id`, `title`, `slug`, `description`, `metadata_title`, `metadata_description`, `metadata_keywords`, `status`, `published_on`, `views`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"كيف يمكنني تتبع الطرد الخاص بي؟\",\"en\":\"How can I track my parcel?\"}', '{\"ar\":\"sint-dolores-similique\",\"en\":\"pariatur-et-aliquam-atque\"}', '{\"ar\":\"يمكنك تتبع الطرد عن طريق إدخال رقم التتبع في صفحة التتبع الخاصة بنا.\",\"en\":\"You can track your parcel by entering the tracking number on our tracking page.\"}', '{\"ar\":\"كيف يمكنني تتبع الطرد الخاص بي؟\",\"en\":\"How can I track my parcel?\"}', '{\"ar\":\"يمكنك تتبع الطرد عن طريق إدخال رقم التتبع في صفحة التتبع الخاصة بنا.\",\"en\":\"You can track your parcel by entering the tracking number on our tracking page.\"}', '{\"ar\":\"سؤال شائع, توصيل, تخزين\",\"en\":\"faq, delivery, storage\"}', 1, '1997-08-03 03:51:12', 0, 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(2, '{\"ar\":\"كم يستغرق توصيل الطرود داخل المدينة؟\",\"en\":\"How long does delivery take within the city?\"}', '{\"ar\":\"modi-aliquam-ducimus\",\"en\":\"ut-possimus-est\"}', '{\"ar\":\"عادةً ما يتم التوصيل خلال 24 ساعة داخل المدينة.\",\"en\":\"Usually, delivery is completed within 24 hours inside the city.\"}', '{\"ar\":\"كم يستغرق توصيل الطرود داخل المدينة؟\",\"en\":\"How long does delivery take within the city?\"}', '{\"ar\":\"عادةً ما يتم التوصيل خلال 24 ساعة داخل المدينة.\",\"en\":\"Usually, delivery is completed within 24 hours inside the city.\"}', '{\"ar\":\"سؤال شائع, توصيل, تخزين\",\"en\":\"faq, delivery, storage\"}', 1, '1972-10-27 18:35:01', 0, 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(3, '{\"ar\":\"هل توفرون خدمات الشحن الدولي؟\",\"en\":\"Do you provide international shipping?\"}', '{\"ar\":\"mollitia-aspernatur-qui-et\",\"en\":\"autem-et-perferendis\"}', '{\"ar\":\"نعم، نقدم خدمات الشحن الدولي لجميع الدول المتاحة.\",\"en\":\"Yes, we provide international shipping to all available countries.\"}', '{\"ar\":\"هل توفرون خدمات الشحن الدولي؟\",\"en\":\"Do you provide international shipping?\"}', '{\"ar\":\"نعم، نقدم خدمات الشحن الدولي لجميع الدول المتاحة.\",\"en\":\"Yes, we provide international shipping to all available countries.\"}', '{\"ar\":\"سؤال شائع, توصيل, تخزين\",\"en\":\"faq, delivery, storage\"}', 1, '2004-06-06 09:33:20', 0, 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(4, '{\"ar\":\"ما هي رسوم التخزين؟\",\"en\":\"What are the storage fees?\"}', '{\"ar\":\"nesciunt-saepe-consequuntur-quaerat\",\"en\":\"aut-rerum-accusamus-quibusdam\"}', '{\"ar\":\"تختلف رسوم التخزين حسب حجم الطرد ومدة التخزين.\",\"en\":\"Storage fees vary depending on the parcel size and storage duration.\"}', '{\"ar\":\"ما هي رسوم التخزين؟\",\"en\":\"What are the storage fees?\"}', '{\"ar\":\"تختلف رسوم التخزين حسب حجم الطرد ومدة التخزين.\",\"en\":\"Storage fees vary depending on the parcel size and storage duration.\"}', '{\"ar\":\"سؤال شائع, توصيل, تخزين\",\"en\":\"faq, delivery, storage\"}', 0, '1974-02-26 19:21:40', 0, 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(5, '{\"ar\":\"كيف يمكنني تعديل عنوان التوصيل؟\",\"en\":\"How can I change the delivery address?\"}', '{\"ar\":\"voluptatibus-neque-ratione-minima\",\"en\":\"qui-laborum-aut-et\"}', '{\"ar\":\"يمكنك تعديل عنوان التوصيل من خلال حسابك قبل الشحن.\",\"en\":\"You can change the delivery address through your account before shipping.\"}', '{\"ar\":\"كيف يمكنني تعديل عنوان التوصيل؟\",\"en\":\"How can I change the delivery address?\"}', '{\"ar\":\"يمكنك تعديل عنوان التوصيل من خلال حسابك قبل الشحن.\",\"en\":\"You can change the delivery address through your account before shipping.\"}', '{\"ar\":\"سؤال شائع, توصيل, تخزين\",\"en\":\"faq, delivery, storage\"}', 0, '2013-02-11 08:10:07', 0, 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  `assigned_at` datetime DEFAULT NULL,
  `status` enum('pending','assigned_to_driver','driver_picked_up','in_transit','arrived_at_hub','out_for_delivery','delivered','delivery_failed','returned','cancelled','in_warehouse') NOT NULL DEFAULT 'pending',
  `note` varchar(255) DEFAULT NULL,
  `picked_up_at` datetime DEFAULT NULL,
  `in_transit_at` datetime DEFAULT NULL,
  `arrived_at_hub_at` datetime DEFAULT NULL,
  `out_for_delivery_at` datetime DEFAULT NULL,
  `delivery_failed_at` datetime DEFAULT NULL,
  `returned_at` datetime DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `delivery_attempts` int(11) NOT NULL DEFAULT 0,
  `status_visible` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `driver_id`, `package_id`, `delivered_at`, `assigned_at`, `status`, `note`, `picked_up_at`, `in_transit_at`, `arrived_at_hub_at`, `out_for_delivery_at`, `delivery_failed_at`, `returned_at`, `cancelled_at`, `delivery_attempts`, `status_visible`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-10-05 03:43:22', NULL, 'assigned_to_driver', 'تم التوصيل بنجاح', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:22', '2025-10-05 00:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`first_name`)),
  `middle_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`middle_name`)),
  `last_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`last_name`)),
  `phone` varchar(255) DEFAULT NULL,
  `driver_image` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `vehicle_type` varchar(255) DEFAULT NULL,
  `vehicle_number` varchar(255) DEFAULT NULL,
  `vehicle_model` varchar(255) DEFAULT NULL,
  `vehicle_color` varchar(255) DEFAULT NULL,
  `vehicle_capacity_weight` varchar(255) DEFAULT NULL,
  `vehicle_capacity_volume` varchar(255) DEFAULT NULL,
  `vehicle_image` varchar(255) DEFAULT NULL,
  `license_image` varchar(255) DEFAULT NULL,
  `id_card_image` varchar(255) DEFAULT NULL,
  `license_expiry_date` date DEFAULT NULL,
  `hired_date` date DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_deliveries` int(11) NOT NULL DEFAULT 0,
  `rating` double(8,2) NOT NULL DEFAULT 0.00,
  `availability_status` enum('available','busy','offline') NOT NULL DEFAULT 'offline',
  `last_seen_at` datetime DEFAULT NULL,
  `status` enum('active','inactive','suspended','terminated') NOT NULL DEFAULT 'active',
  `reason` varchar(255) DEFAULT NULL,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `phone`, `driver_image`, `username`, `email`, `password`, `country`, `region`, `city`, `district`, `latitude`, `longitude`, `license_number`, `vehicle_type`, `vehicle_number`, `vehicle_model`, `vehicle_color`, `vehicle_capacity_weight`, `vehicle_capacity_volume`, `vehicle_image`, `license_image`, `id_card_image`, `license_expiry_date`, `hired_date`, `supervisor_id`, `total_deliveries`, `rating`, `availability_status`, `last_seen_at`, `status`, `reason`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 10, '{\"ar\":\"خالد\",\"en\":\"Khaled\"}', '{\"ar\":\"احمد\",\"en\":\"Ahmed\"}', '{\"ar\":\"حمود\",\"en\":\"Hammoud\"}', '777123456', NULL, 'driver_khaled', 'khaled@example.com', '$2y$10$I0A6vqMCYjOQT6vTFuCzP.IHAIJdu0Ez90kvGjte9owstEjwPf0Y2', NULL, NULL, NULL, NULL, NULL, NULL, 'LIC-123456', 'van', 'ABC-9876', 'Hyundai H1', 'white', NULL, NULL, NULL, 'licenses/khaled_license.jpg', 'id_cards/khaled_id.jpg', '2026-10-05', '2025-07-05', NULL, 28, 4.60, 'available', '2025-10-05 03:43:21', 'active', NULL, '2025-10-05 03:43:21', 'system', NULL, NULL, NULL, '2025-10-05 00:43:21', '2025-10-05 00:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `external_shipments`
--

CREATE TABLE `external_shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipping_partner_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `external_tracking_number` varchar(255) NOT NULL,
  `status` enum('pending','in_transit','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `delivery_date` date DEFAULT NULL,
  `synced_at` date DEFAULT NULL,
  `delivered_at` date DEFAULT NULL,
  `status_visible` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `external_shipments`
--

INSERT INTO `external_shipments` (`id`, `shipping_partner_id`, `package_id`, `external_tracking_number`, `status`, `delivery_date`, `synced_at`, `delivered_at`, `status_visible`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'EXT-IDWLBENTHL', 'in_transit', '2025-10-10', '2025-10-10', '2025-10-10', 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:23', '2025-10-05 00:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `merchant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payable_type` varchar(255) NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(10) NOT NULL DEFAULT 'USD',
  `status` enum('unpaid','paid','partial') NOT NULL DEFAULT 'unpaid',
  `due_date` date DEFAULT NULL,
  `issued_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `merchant_id`, `payable_type`, `payable_id`, `total_amount`, `paid_amount`, `currency`, `status`, `due_date`, `issued_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'INV-000001', 1, 'App\\Models\\Package', 1, 350.00, 150.00, 'USD', 'partial', '2025-10-12', '2025-10-05 00:43:23', 'فاتورة مرتبطة بالطرد رقم 1', '2025-10-05 00:43:23', '2025-10-05 00:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `link` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`link`)),
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `metadata_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_title`)),
  `metadata_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_description`)),
  `metadata_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_keywords`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `slug`, `description`, `link`, `icon`, `parent_id`, `section`, `metadata_title`, `metadata_description`, `metadata_keywords`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"الرئيسية\",\"en\":\"Home\"}', '{\"ar\":\"الرئيسية\",\"en\":\"home\"}', NULL, '{\"ar\":\"index\"}', 'fa fa-home', NULL, 1, NULL, NULL, NULL, 1, '2007-09-22 16:02:00', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(2, '{\"ar\":\"عن الشركة\",\"en\":\"About Us\"}', '{\"ar\":\"عن-الشركة\",\"en\":\"about-us\"}', NULL, '{\"ar\":\"about\",\"en\":\"about\"}', 'fa fa-info-circle', NULL, 1, NULL, NULL, NULL, 1, '1983-03-26 07:17:33', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(3, '{\"ar\":\"رؤيتنا\",\"en\":\"Our Vision\"}', '{\"ar\":\"رؤيتنا\",\"en\":\"our-vision\"}', NULL, NULL, 'fa fa-eye', 2, 1, NULL, NULL, NULL, 1, '2010-12-01 13:59:17', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(4, '{\"ar\":\"مهمتنا\",\"en\":\"Our Mission\"}', '{\"ar\":\"مهمتنا\",\"en\":\"our-mission\"}', NULL, NULL, 'fa fa-bullseye', 2, 1, NULL, NULL, NULL, 1, '1972-08-04 10:01:36', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(5, '{\"ar\":\"خدماتنا\",\"en\":\"Services\"}', '{\"ar\":\"خدماتنا\",\"en\":\"services\"}', NULL, '{\"ar\":\"services\",\"en\":\"services\"}', 'fa fa-truck', NULL, 1, NULL, NULL, NULL, 1, '1973-01-13 09:37:32', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(6, '{\"ar\":\"الشحن السريع\",\"en\":\"Express Delivery\"}', '{\"ar\":\"الشحن-السريع\",\"en\":\"express-delivery\"}', NULL, NULL, 'fa fa-bolt', 5, 1, NULL, NULL, NULL, 1, '1991-10-16 02:03:06', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(7, '{\"ar\":\"التخزين\",\"en\":\"Storage\"}', '{\"ar\":\"التخزين\",\"en\":\"storage\"}', NULL, NULL, 'fa fa-warehouse', 5, 1, NULL, NULL, NULL, 1, '1993-04-02 06:22:51', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(8, '{\"ar\":\"التتبع المباشر\",\"en\":\"Live Tracking\"}', '{\"ar\":\"التتبع-المباشر\",\"en\":\"live-tracking\"}', NULL, NULL, 'fa fa-map-marker-alt', 5, 1, NULL, NULL, NULL, 1, '1982-08-28 07:38:17', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(9, '{\"ar\":\"مميزاتنا\",\"en\":\"Features\"}', '{\"ar\":\"مميزاتنا\",\"en\":\"features\"}', NULL, '{\"ar\":\"features\",\"en\":\"features\"}', 'fa fa-star', NULL, 1, NULL, NULL, NULL, 1, '1991-05-19 03:59:29', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(10, '{\"ar\":\"توصيل سريع\",\"en\":\"Fast Delivery\"}', '{\"ar\":\"توصيل-سريع\",\"en\":\"fast-delivery\"}', NULL, NULL, 'fa fa-shipping-fast', 9, 1, NULL, NULL, NULL, 1, '2013-12-26 22:56:03', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(11, '{\"ar\":\"دعم 24/7\",\"en\":\"24/7 Support\"}', '{\"ar\":\"دعم-24-7\",\"en\":\"24-7-support\"}', NULL, NULL, 'fa fa-headset', 9, 1, NULL, NULL, NULL, 1, '2019-06-19 18:16:08', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(12, '{\"ar\":\"تواصل معنا\",\"en\":\"Contact Us\"}', '{\"ar\":\"تواصل-معنا\",\"en\":\"contact-us\"}', NULL, '{\"ar\":\"contact\",\"en\":\"contact\"}', 'fa fa-envelope', NULL, 1, NULL, NULL, NULL, 1, '1974-03-16 04:54:22', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(13, '{\"ar\":\"الأسئلة الشائعة\",\"en\":\"FAQ\"}', '{\"ar\":\"الأسئلة-الشائعة\",\"en\":\"faq\"}', NULL, '{\"ar\":\"faq\",\"en\":\"faq\"}', 'fa fa-question-circle', NULL, 1, NULL, NULL, NULL, 1, '1980-12-30 17:39:49', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(14, '{\"ar\":\"سياسة الخصوصية\",\"en\":\"Privacy Policy\"}', '{\"ar\":\"سياسة-الخصوصية\",\"en\":\"privacy-policy\"}', NULL, '{\"ar\":\"privacy\",\"en\":\"privacy\"}', 'fa fa-user-secret', NULL, 1, NULL, NULL, NULL, 1, '1984-04-26 08:10:28', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(15, '{\"ar\":\"تتبع الشحنة\",\"en\":\"Track Shipment\"}', '{\"ar\":\"تتبع-الشحنة\",\"en\":\"track-shipment\"}', '{\"ar\":\"تابع شحنتك في الوقت الحقيقي وكن مطمئنًا لمعرفة مكانها دائمًا.\",\"en\":\"Track your shipment in real-time and stay informed about its location at all times.\"}', '{\"ar\":\"tracking\",\"en\":\"tracking\"}', 'fa fa-map-marker-alt', NULL, 2, NULL, NULL, NULL, 1, '2025-05-21 13:02:21', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(16, '{\"ar\":\"حساب تكلفة الشحن\",\"en\":\"Shipping Rates\"}', '{\"ar\":\"حساب-تكلفة-الشحن\",\"en\":\"shipping-rates\"}', '{\"ar\":\"احسب تكلفة شحنتك بسهولة قبل الإرسال لتجنب أي مفاجآت.\",\"en\":\"Easily calculate your shipping cost in advance to avoid surprises.\"}', '{\"ar\":\"rates\",\"en\":\"rates\"}', 'fa fa-calculator', NULL, 2, NULL, NULL, NULL, 1, '2025-07-26 00:12:48', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(17, '{\"ar\":\"مراكز التخزين\",\"en\":\"Warehouses\"}', '{\"ar\":\"مراكز-التخزين\",\"en\":\"warehouses\"}', '{\"ar\":\"نحن نملك مراكز تخزين متعددة لضمان سلامة البضائع وتسليمها في الوقت المحدد.\",\"en\":\"We have multiple warehouses to ensure the safety of goods and timely delivery.\"}', '{\"ar\":\"warehouses\",\"en\":\"warehouses\"}', 'fa fa-warehouse', NULL, 2, NULL, NULL, NULL, 1, '2025-04-22 13:07:37', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(18, '{\"ar\":\"بوابة التاجر\",\"en\":\"Merchant Portal\"}', '{\"ar\":\"بوابة-التاجر\",\"en\":\"merchant-portal\"}', '{\"ar\":\"لوحة تحكم سهلة للتجار لإدارة شحناتهم ومتابعة الطلبات.\",\"en\":\"An easy-to-use dashboard for merchants to manage shipments and track orders.\"}', '{\"ar\":\"merchant/portal\",\"en\":\"merchant/portal\"}', 'fa fa-store', NULL, 2, NULL, NULL, NULL, 1, '2025-05-27 23:01:02', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(19, '{\"ar\":\"خدمة العملاء\",\"en\":\"Customer Support\"}', '{\"ar\":\"خدمة-العملاء\",\"en\":\"customer-support\"}', '{\"ar\":\"دعم متواصل للإجابة عن استفساراتك وحل أي مشكلة بسرعة.\",\"en\":\"24/7 support to answer your questions and resolve issues quickly.\"}', '{\"ar\":\"support\",\"en\":\"support\"}', 'fa fa-headset', NULL, 2, NULL, NULL, NULL, 1, '2025-08-24 18:50:23', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(20, '{\"ar\":\"تقارير الشحن\",\"en\":\"Shipping Reports\"}', '{\"ar\":\"تقارير-الشحن\",\"en\":\"shipping-reports\"}', '{\"ar\":\"احصل على تقارير مفصلة عن شحناتك لاتخاذ قرارات أفضل.\",\"en\":\"Get detailed reports on your shipments for better decision-making.\"}', '{\"ar\":\"reports\",\"en\":\"reports\"}', 'fa fa-chart-line', NULL, 2, NULL, NULL, NULL, 1, '2025-06-03 15:18:19', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(21, '{\"ar\":\"تسليم سريع وموثوق\",\"en\":\"Fast & Reliable Delivery\"}', '{\"ar\":\"تسليم-سريع-وموثوق\",\"en\":\"fast-reliable-delivery\"}', '{\"ar\":\"نضمن وصول شحنتك بسرعة وبأمان إلى وجهتها.\",\"en\":\"We ensure your shipment reaches its destination quickly and safely.\"}', '{\"ar\":\"fast-delivery\",\"en\":\"fast-delivery\"}', 'fa fa-truck', NULL, 2, NULL, NULL, NULL, 1, '2025-04-05 15:49:32', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(22, '{\"ar\":\"نظام إدارة عمليات التوصيل\",\"en\":\"Delivery Operations Management\"}', '{\"ar\":\"نظام-إدارة-عمليات-التوصيل\",\"en\":\"delivery-operations-management\"}', '{\"ar\":\"إدارة جميع عمليات التوصيل من الشحن حتى التسليم النهائي للعملاء بكفاءة وسرعة.\",\"en\":\"Manage all delivery operations from shipment to final customer delivery efficiently and quickly.\"}', '{\"ar\":\"delivery-operations\",\"en\":\"delivery-operations\"}', 'fa fa-truck', NULL, 3, NULL, NULL, NULL, 1, '2025-09-12 06:00:31', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(23, '{\"ar\":\"نظام إدارة المستودعات\",\"en\":\"Warehouse Management\"}', '{\"ar\":\"نظام-إدارة-المستودعات\",\"en\":\"warehouse-management\"}', '{\"ar\":\"تنظيم المخازن وإدارة المخزون لضمان التخزين الصحيح وسهولة الوصول للبضائع.\",\"en\":\"Organize warehouses and manage inventory to ensure proper storage and easy access to goods.\"}', '{\"ar\":\"warehouse-management\",\"en\":\"warehouse-management\"}', 'fa fa-warehouse', NULL, 3, NULL, NULL, NULL, 1, '2025-04-17 07:16:57', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(24, '{\"ar\":\"نظام إدارة الطرود\",\"en\":\"Parcel Management\"}', '{\"ar\":\"نظام-إدارة-الطرود\",\"en\":\"parcel-management\"}', '{\"ar\":\"متابعة الطرود من لحظة الاستلام وحتى التسليم مع تحديثات الحالة المستمرة.\",\"en\":\"Track parcels from pickup to delivery with continuous status updates.\"}', '{\"ar\":\"parcel-management\",\"en\":\"parcel-management\"}', 'fa fa-box', NULL, 3, NULL, NULL, NULL, 1, '2025-05-14 02:20:18', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(25, '{\"ar\":\"نظام إدارة خدمات النقل\",\"en\":\"Transport Services Management\"}', '{\"ar\":\"نظام-إدارة-خدمات-النقل\",\"en\":\"transport-services-management\"}', '{\"ar\":\"تنسيق جميع وسائل النقل وتحديد أفضل الطرق والشحنات لضمان سرعة وكفاءة التوصيل.\",\"en\":\"Coordinate all transport means and determine the best routes and shipments to ensure fast and efficient delivery.\"}', '{\"ar\":\"transport-services\",\"en\":\"transport-services\"}', 'fa fa-shipping-fast', NULL, 3, NULL, NULL, NULL, 1, '2025-07-09 18:07:12', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(26, '{\"ar\":\"نظام إدارة المرتجعات\",\"en\":\"Returns Management\"}', '{\"ar\":\"نظام-إدارة-المرتجعات\",\"en\":\"returns-management\"}', '{\"ar\":\"إدارة جميع طلبات المرتجعات بشكل منظم وسريع لضمان رضا العملاء.\",\"en\":\"Manage all return requests in an organized and fast manner to ensure customer satisfaction.\"}', '{\"ar\":\"returns-management\",\"en\":\"returns-management\"}', 'fa fa-undo', NULL, 3, NULL, NULL, NULL, 1, '2025-05-27 16:14:07', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(27, '{\"ar\":\"نظام إدارة العملاء\",\"en\":\"Customer Management\"}', '{\"ar\":\"نظام-إدارة-العملاء\",\"en\":\"customer-management\"}', '{\"ar\":\"حفظ معلومات العملاء، متابعة الطلبات والتواصل معهم بشكل فعال.\",\"en\":\"Store customer information, track orders, and communicate with them effectively.\"}', '{\"ar\":\"customer-management\",\"en\":\"customer-management\"}', 'fa fa-users', NULL, 3, NULL, NULL, NULL, 1, '2025-04-22 23:13:05', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(28, '{\"ar\":\"نظام إدارة الفواتير والمدفوعات\",\"en\":\"Billing & Payments Management\"}', '{\"ar\":\"نظام-إدارة-الفواتير-والمدفوعات\",\"en\":\"billing-payments-management\"}', '{\"ar\":\"إنشاء الفواتير، متابعة المدفوعات والتحكم الكامل في الحسابات المالية للعملاء.\",\"en\":\"Generate invoices, track payments, and have full control over customer financial accounts.\"}', '{\"ar\":\"billing-management\",\"en\":\"billing-management\"}', 'fa fa-credit-card', NULL, 3, NULL, NULL, NULL, 1, '2025-08-05 00:49:07', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(29, '{\"ar\":\"نظام التقارير والإحصائيات\",\"en\":\"Reports & Analytics\"}', '{\"ar\":\"نظام-التقارير-والإحصائيات\",\"en\":\"reports-analytics\"}', '{\"ar\":\"تقديم تقارير مفصلة وإحصائيات دقيقة لدعم اتخاذ القرارات وتحسين الأداء.\",\"en\":\"Provide detailed reports and accurate analytics to support decision-making and improve performance.\"}', '{\"ar\":\"reports-analytics\",\"en\":\"reports-analytics\"}', 'fa fa-chart-line', NULL, 3, NULL, NULL, NULL, 1, '2025-06-28 16:00:10', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(30, '{\"ar\":\"تتبع الشحنة\",\"en\":\"Track Shipment\"}', '{\"ar\":\"تتبع-الشحنة-1\",\"en\":\"track-shipment-1\"}', NULL, '{\"ar\":\"tracking\",\"en\":\"tracking\"}', 'fa fa-map-marker-alt', NULL, 4, NULL, NULL, NULL, 1, '2025-06-07 20:30:21', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(31, '{\"ar\":\"حساب تكلفة الشحن\",\"en\":\"Shipping Rates\"}', '{\"ar\":\"حساب-تكلفة-الشحن-1\",\"en\":\"shipping-rates-1\"}', NULL, '{\"ar\":\"rates\",\"en\":\"rates\"}', 'fa fa-calculator', NULL, 4, NULL, NULL, NULL, 1, '2025-08-12 13:43:02', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(32, '{\"ar\":\"مراكز التخزين\",\"en\":\"Warehouses\"}', '{\"ar\":\"مراكز-التخزين-1\",\"en\":\"warehouses-1\"}', NULL, '{\"ar\":\"warehouses\",\"en\":\"warehouses\"}', 'fa fa-warehouse', NULL, 4, NULL, NULL, NULL, 1, '2025-08-29 19:12:17', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(33, '{\"ar\":\"بوابة التاجر\",\"en\":\"Merchant Portal\"}', '{\"ar\":\"بوابة-التاجر-1\",\"en\":\"merchant-portal-1\"}', NULL, '{\"ar\":\"merchant/portal\",\"en\":\"merchant/portal\"}', 'fa fa-store', NULL, 4, NULL, NULL, NULL, 1, '2025-08-11 19:05:39', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(34, '{\"ar\":\"اتصل بنا\",\"en\":\"Contact Us\"}', '{\"ar\":\"اتصل-بنا\",\"en\":\"contact-us-1\"}', NULL, '{\"ar\":\"contact\",\"en\":\"contact\"}', 'fa fa-envelope', NULL, 4, NULL, NULL, NULL, 1, '2025-06-27 20:58:59', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `menu_properties`
--

CREATE TABLE `menu_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `property_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`property_value`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `published_on` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_properties`
--

INSERT INTO `menu_properties` (`id`, `menu_id`, `property_value`, `status`, `created_by`, `updated_by`, `published_on`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 22, '{\"ar\":\"الإرجاع عبر قنوات متعددة\",\"en\":\"Multi-channel Returns\"}', 1, 'admin', NULL, '2025-08-03 00:00:06', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(2, 22, '{\"ar\":\"تجميع المرتجعات\",\"en\":\"Returns Consolidation\"}', 1, 'admin', NULL, '2025-06-12 22:43:22', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(3, 22, '{\"ar\":\"التتبع الحي\",\"en\":\"Live Tracking\"}', 1, 'admin', NULL, '2025-06-30 22:29:58', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(4, 22, '{\"ar\":\"التسوية المالية\",\"en\":\"Financial Settlement\"}', 1, 'admin', NULL, '2025-05-04 23:22:22', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(5, 23, '{\"ar\":\"الإرجاع عبر قنوات متعددة\",\"en\":\"Multi-channel Returns\"}', 1, 'admin', NULL, '2025-07-18 20:28:54', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(6, 23, '{\"ar\":\"تجميع المرتجعات\",\"en\":\"Returns Consolidation\"}', 1, 'admin', NULL, '2025-04-11 10:47:18', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(7, 23, '{\"ar\":\"التتبع الحي\",\"en\":\"Live Tracking\"}', 1, 'admin', NULL, '2025-09-07 20:25:38', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(8, 23, '{\"ar\":\"التسوية المالية\",\"en\":\"Financial Settlement\"}', 1, 'admin', NULL, '2025-08-02 19:27:57', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(9, 24, '{\"ar\":\"الإرجاع عبر قنوات متعددة\",\"en\":\"Multi-channel Returns\"}', 1, 'admin', NULL, '2025-08-09 01:22:14', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(10, 24, '{\"ar\":\"تجميع المرتجعات\",\"en\":\"Returns Consolidation\"}', 1, 'admin', NULL, '2025-08-25 15:23:55', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(11, 24, '{\"ar\":\"التتبع الحي\",\"en\":\"Live Tracking\"}', 1, 'admin', NULL, '2025-09-09 01:15:56', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(12, 24, '{\"ar\":\"التسوية المالية\",\"en\":\"Financial Settlement\"}', 1, 'admin', NULL, '2025-07-23 02:05:25', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(13, 25, '{\"ar\":\"الإرجاع عبر قنوات متعددة\",\"en\":\"Multi-channel Returns\"}', 1, 'admin', NULL, '2025-05-19 08:48:21', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(14, 25, '{\"ar\":\"تجميع المرتجعات\",\"en\":\"Returns Consolidation\"}', 1, 'admin', NULL, '2025-10-02 18:03:01', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(15, 25, '{\"ar\":\"التتبع الحي\",\"en\":\"Live Tracking\"}', 1, 'admin', NULL, '2025-05-24 19:49:24', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(16, 25, '{\"ar\":\"التسوية المالية\",\"en\":\"Financial Settlement\"}', 1, 'admin', NULL, '2025-09-10 04:18:42', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(17, 26, '{\"ar\":\"الإرجاع عبر قنوات متعددة\",\"en\":\"Multi-channel Returns\"}', 1, 'admin', NULL, '2025-09-08 18:53:32', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(18, 26, '{\"ar\":\"تجميع المرتجعات\",\"en\":\"Returns Consolidation\"}', 1, 'admin', NULL, '2025-05-18 22:20:21', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(19, 26, '{\"ar\":\"التتبع الحي\",\"en\":\"Live Tracking\"}', 1, 'admin', NULL, '2025-06-30 22:22:50', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(20, 26, '{\"ar\":\"التسوية المالية\",\"en\":\"Financial Settlement\"}', 1, 'admin', NULL, '2025-08-24 05:43:44', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(21, 27, '{\"ar\":\"الإرجاع عبر قنوات متعددة\",\"en\":\"Multi-channel Returns\"}', 1, 'admin', NULL, '2025-07-18 17:16:26', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(22, 27, '{\"ar\":\"تجميع المرتجعات\",\"en\":\"Returns Consolidation\"}', 1, 'admin', NULL, '2025-04-09 07:57:29', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(23, 27, '{\"ar\":\"التتبع الحي\",\"en\":\"Live Tracking\"}', 1, 'admin', NULL, '2025-05-07 12:41:35', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(24, 27, '{\"ar\":\"التسوية المالية\",\"en\":\"Financial Settlement\"}', 1, 'admin', NULL, '2025-08-02 22:30:58', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(25, 28, '{\"ar\":\"الإرجاع عبر قنوات متعددة\",\"en\":\"Multi-channel Returns\"}', 1, 'admin', NULL, '2025-09-18 10:12:31', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(26, 28, '{\"ar\":\"تجميع المرتجعات\",\"en\":\"Returns Consolidation\"}', 1, 'admin', NULL, '2025-06-27 14:06:00', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(27, 28, '{\"ar\":\"التتبع الحي\",\"en\":\"Live Tracking\"}', 1, 'admin', NULL, '2025-09-15 12:27:08', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(28, 28, '{\"ar\":\"التسوية المالية\",\"en\":\"Financial Settlement\"}', 1, 'admin', NULL, '2025-06-26 16:38:02', NULL, '2025-10-05 00:43:25', '2025-10-05 00:43:25'),
(29, 29, '{\"ar\":\"الإرجاع عبر قنوات متعددة\",\"en\":\"Multi-channel Returns\"}', 1, 'admin', NULL, '2025-07-04 06:15:24', NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(30, 29, '{\"ar\":\"تجميع المرتجعات\",\"en\":\"Returns Consolidation\"}', 1, 'admin', NULL, '2025-06-30 06:10:25', NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(31, 29, '{\"ar\":\"التتبع الحي\",\"en\":\"Live Tracking\"}', 1, 'admin', NULL, '2025-08-19 06:44:51', NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(32, 29, '{\"ar\":\"التسوية المالية\",\"en\":\"Financial Settlement\"}', 1, 'admin', NULL, '2025-05-23 17:42:23', NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `contact_person` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`contact_person`)),
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `user_id`, `name`, `slug`, `country`, `region`, `city`, `district`, `postal_code`, `latitude`, `longitude`, `others`, `contact_person`, `phone`, `email`, `api_key`, `logo`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `website`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 9, '{\"ar\":\"متجر النجاح\",\"en\":\"Al Nagah Store\"}', '{\"ar\":\"متجر-النجاح\",\"en\":\"al-nagah-store\"}', 'اليمن', 'صنعاء', 'صنعاء', 'الزبيري', '11111', 15.3547000, 44.2066000, 'ملاحظات إضافية عن موقع المتجر', '{\"ar\":\"أحمد محمد\",\"en\":\"Ahmed Mohamed\"}', '777777777', 'alnagah@gmail.com', '550a6b64-05e6-438c-b2a0-3f762a248fdc', NULL, 'https://facebook.com/alnagah', 'https://twitter.com/alnagah', 'https://instagram.com/alnagah', NULL, NULL, 'https://alnagahstore.com', 1, '2025-10-05 03:43:18', 'Seeder', NULL, NULL, NULL, '2025-10-05 00:43:18', '2025-10-05 00:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_04_134145_entrust_setup_tables', 1),
(6, '2024_10_13_132227_create_photos_table', 1),
(7, '2024_10_13_132255_create_tags_table', 1),
(8, '2024_10_13_133252_create_taggables_table', 1),
(9, '2025_06_24_203626_create_merchants_table', 1),
(10, '2025_06_24_203940_create_products_table', 1),
(11, '2025_06_24_203954_create_warehouses_table', 1),
(12, '2025_06_24_204006_create_shelves_table', 1),
(13, '2025_06_24_204017_create_warehouse_rentals_table', 1),
(14, '2025_06_24_204018_create_rental_shelves_table', 1),
(15, '2025_06_24_204028_create_stock_items_table', 1),
(16, '2025_06_24_204040_create_packages_table', 1),
(17, '2025_06_24_204051_create_package_products_table', 1),
(18, '2025_06_24_204104_create_drivers_table', 1),
(19, '2025_06_24_204116_create_deliveries_table', 1),
(20, '2025_06_24_204129_create_pickup_requests_table', 1),
(21, '2025_06_24_204142_create_package_logs_table', 1),
(22, '2025_06_24_204154_create_return_requests_table', 1),
(23, '2025_06_24_204206_create_return_items_table', 1),
(24, '2025_06_24_204218_create_shipping_partners_table', 1),
(25, '2025_06_24_204230_create_external_shipments_table', 1),
(26, '2025_06_24_204231_create_invoices_table', 1),
(27, '2025_06_24_204242_create_payments_table', 1),
(28, '2025_06_24_204254_create_pricing_rules_table', 1),
(29, '2025_08_12_143356_create_invoice_items_table', 1),
(30, '2025_10_01_162851_create_menus_table', 1),
(31, '2025_10_02_125748_create_sliders_table', 1),
(32, '2025_10_02_142729_create_partners_table', 1),
(33, '2025_10_02_143426_create_page_categories_table', 1),
(34, '2025_10_02_143429_create_pages_table', 1),
(35, '2025_10_02_143512_create_testimonials_table', 1),
(36, '2025_10_02_144236_create_common_questions_table', 1),
(37, '2025_10_03_130853_create_statistics_table', 1),
(38, '2025_10_03_154249_create_site_settings_table', 1),
(39, '2025_10_03_225127_create_menu_properties_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_first_name` varchar(255) DEFAULT NULL,
  `sender_middle_name` varchar(255) DEFAULT NULL,
  `sender_last_name` varchar(255) DEFAULT NULL,
  `sender_phone` varchar(255) DEFAULT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `sender_country` varchar(255) DEFAULT NULL,
  `sender_region` varchar(255) DEFAULT NULL,
  `sender_city` varchar(255) DEFAULT NULL,
  `sender_district` varchar(255) DEFAULT NULL,
  `sender_postal_code` varchar(255) DEFAULT NULL,
  `sender_latitude` varchar(255) DEFAULT NULL,
  `sender_longitude` varchar(255) DEFAULT NULL,
  `sender_others` varchar(255) DEFAULT NULL,
  `receiver_merchant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receiver_first_name` varchar(255) NOT NULL,
  `receiver_middle_name` varchar(255) NOT NULL,
  `receiver_last_name` varchar(255) NOT NULL,
  `receiver_phone` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `receiver_country` varchar(255) DEFAULT NULL,
  `receiver_region` varchar(255) DEFAULT NULL,
  `receiver_city` varchar(255) DEFAULT NULL,
  `receiver_district` varchar(255) DEFAULT NULL,
  `receiver_postal_code` varchar(255) DEFAULT NULL,
  `receiver_latitude` varchar(255) DEFAULT NULL,
  `receiver_longitude` varchar(255) DEFAULT NULL,
  `receiver_others` varchar(255) DEFAULT NULL,
  `package_content` varchar(255) DEFAULT NULL,
  `package_note` varchar(255) DEFAULT NULL,
  `rental_shelf_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `dimensions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dimensions`)),
  `quantity` int(11) NOT NULL DEFAULT 1,
  `payment_responsibility` enum('merchant','recipient') NOT NULL DEFAULT 'merchant',
  `payment_method` enum('prepaid','cash_on_delivery','exchange','bring') NOT NULL DEFAULT 'prepaid',
  `collection_method` enum('cash','cheque','bank_transfer','e_wallet','credit_card','mada') NOT NULL DEFAULT 'cash',
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `insurance_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `overpayment` decimal(10,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cod_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_speed` enum('standard','express','same_day','next_day') NOT NULL DEFAULT 'standard',
  `delivery_date` date DEFAULT NULL,
  `status` enum('pending','assigned_to_driver','driver_picked_up','in_transit','arrived_at_hub','out_for_delivery','delivered','delivery_failed','returned','cancelled','in_warehouse') NOT NULL DEFAULT 'pending',
  `delivery_method` enum('standard','express','pickup','courier') NOT NULL DEFAULT 'standard',
  `package_type` enum('box','envelope','pallet','tube','bag') NOT NULL DEFAULT 'box',
  `package_size` enum('small','medium','large','oversized') NOT NULL DEFAULT 'medium',
  `origin_type` enum('warehouse','store','home','other') NOT NULL DEFAULT 'warehouse',
  `delivery_status_note` text DEFAULT NULL,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '{"is_fragile":true,"is_returnable":false,"is_confidential":true,"is_express":false,"is_cod":true,"is_gift":false,"is_oversized":false,"is_hazardous_material":false,"is_temperature_controlled":false,"is_perishable":false,"is_signature_required":true,"is_inspection_required":false,"is_special_handling_required":true}' CHECK (json_valid(`attributes`)),
  `origin_warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `merchant_id`, `sender_first_name`, `sender_middle_name`, `sender_last_name`, `sender_phone`, `sender_email`, `sender_country`, `sender_region`, `sender_city`, `sender_district`, `sender_postal_code`, `sender_latitude`, `sender_longitude`, `sender_others`, `receiver_merchant_id`, `receiver_first_name`, `receiver_middle_name`, `receiver_last_name`, `receiver_phone`, `receiver_email`, `receiver_country`, `receiver_region`, `receiver_city`, `receiver_district`, `receiver_postal_code`, `receiver_latitude`, `receiver_longitude`, `receiver_others`, `package_content`, `package_note`, `rental_shelf_id`, `parent_package_id`, `weight`, `dimensions`, `quantity`, `payment_responsibility`, `payment_method`, `collection_method`, `delivery_fee`, `insurance_fee`, `service_fee`, `total_fee`, `paid_amount`, `overpayment`, `due_amount`, `cod_amount`, `delivery_speed`, `delivery_date`, `status`, `delivery_method`, `package_type`, `package_size`, `origin_type`, `delivery_status_note`, `attributes`, `origin_warehouse_id`, `tracking_number`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'خالد', 'عبدالله', 'على', '772036131', 'khaled@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'خليل', 'عبدالله', 'راوح', '777000111', 'khaleel@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 3000, '{\"length\":30,\"width\":20,\"height\":15}', 1, 'recipient', 'prepaid', 'cash', 1000.00, 200.00, 300.00, 1500.00, 500.00, 0.00, 1000.00, 0.00, 'express', '2025-10-08', 'assigned_to_driver', 'express', 'box', 'large', 'warehouse', 'يحتاج إلى مراجعة قبل التسليم', '{\"is_fragile\":true,\"is_returnable\":false,\"is_confidential\":true,\"is_express\":true,\"is_cod\":false,\"is_gift\":true,\"is_oversized\":false,\"is_hazardous_material\":false,\"is_temperature_controlled\":false,\"is_perishable\":false,\"is_signature_required\":true,\"is_inspection_required\":false,\"is_special_handling_required\":true}', NULL, 'PKG-CAYW7D3H', 'system', NULL, NULL, NULL, '2025-10-05 00:43:21', '2025-10-05 00:43:22'),
(2, 1, 'سامي', 'أحمد', 'يوسف', '777123456', 'sami@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'محمد', 'علي', 'سالم', '735000222', 'mohammed@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1000, '{\"length\":20,\"width\":10,\"height\":5}', 1, '', 'prepaid', 'cash', 800.00, 100.00, 200.00, 1100.00, 1100.00, 0.00, 0.00, 0.00, 'standard', '2025-10-06', '', 'standard', 'envelope', 'small', '', 'مستعجل للتوصيل صباحًا', '{\"is_fragile\":false,\"is_returnable\":true,\"is_confidential\":false,\"is_express\":false,\"is_cod\":false,\"is_gift\":false,\"is_oversized\":false,\"is_hazardous_material\":false,\"is_temperature_controlled\":false,\"is_perishable\":false,\"is_signature_required\":false,\"is_inspection_required\":false,\"is_special_handling_required\":false}', NULL, 'PKG-84JRZGVW', 'system', NULL, NULL, NULL, '2025-10-05 00:43:21', '2025-10-05 00:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `package_logs`
--

CREATE TABLE `package_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','assigned_to_driver','driver_picked_up','in_transit','arrived_at_hub','out_for_delivery','delivered','delivery_failed','returned','cancelled','in_warehouse') NOT NULL,
  `note` text DEFAULT NULL,
  `changed_by` varchar(255) DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_logs`
--

INSERT INTO `package_logs` (`id`, `package_id`, `status`, `note`, `changed_by`, `driver_id`, `logged_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'pending', 'تم انشاء الطلب', NULL, NULL, '2025-10-05 00:43:21', '2025-10-05 00:43:21', '2025-10-05 00:43:21'),
(2, 1, 'assigned_to_driver', 'تم إسناد التوصيلة للسائق: خالد احمد حمود', 'system', 1, '2025-10-05 00:43:22', '2025-10-05 00:43:22', '2025-10-05 00:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `package_products`
--

CREATE TABLE `package_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('stock','custom') NOT NULL DEFAULT 'custom',
  `stock_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `custom_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `price_per_unit` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_products`
--

INSERT INTO `package_products` (`id`, `package_id`, `type`, `stock_item_id`, `custom_name`, `quantity`, `weight`, `price_per_unit`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'stock', 1, NULL, 2, 500.00, 150.00, 300.00, '2025-10-05 00:43:21', '2025-10-05 00:43:21'),
(2, 1, 'custom', NULL, 'لوحة فنية مخصصة', 1, 200.00, 500.00, 500.00, '2025-10-05 00:43:21', '2025-10-05 00:43:21'),
(3, 1, 'stock', 1, NULL, 3, 1.50, 50.00, 150.00, '2025-10-05 00:43:21', '2025-10-05 00:43:21'),
(4, 1, 'custom', NULL, 'Custom Printed Mug', 4, 0.40, 25.00, 100.00, '2025-10-05 00:43:21', '2025-10-05 00:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `page_category_id` bigint(20) UNSIGNED NOT NULL,
  `metadata_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_title`)),
  `metadata_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_description`)),
  `metadata_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_keywords`)),
  `status` tinyint(1) DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `page_category_id`, `metadata_title`, `metadata_description`, `metadata_keywords`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"العنوان\",\"en\":\"title\"}', '{\"ar\":\"العنوان\",\"en\":\"title\"}', '{\"ar\":\"Alice had no reason to be ashamed of yourself,\'.\",\"en\":\"Alice\'s shoulder, and it sat for a conversation.\",\"ca\":\"March Hare said--\' \'I didn\'t!\' the March Hare.\"}', 1, '{\"ar\":\"Alice gave a little startled when she had peeped.\",\"en\":\"So she began looking at Alice for protection.\"}', '{\"ar\":\"Alice, very loudly and decidedly, and there.\",\"en\":\"Mock Turtle, who looked at each other for some.\"}', '{\"ar\":\"Alice: \'I don\'t even know what \\\"it\\\" means.\' \'I.\",\"en\":\"Puss,\' she began, rather timidly, saying to her.\"}', 1, NULL, 'Mouse, turning to.', 'Cat remarked.', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `page_categories`
--

CREATE TABLE `page_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `metadata_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_title`)),
  `metadata_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_description`)),
  `metadata_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_keywords`)),
  `status` tinyint(1) DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_categories`
--

INSERT INTO `page_categories` (`id`, `title`, `slug`, `content`, `metadata_title`, `metadata_description`, `metadata_keywords`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"خدماتنا\",\"en\":\"Our Services\"}', '{\"ar\":\"خدماتنا\",\"en\":\"our-services\"}', '{\"ar\":\"BEST butter, you know.\' \'Not the same size for ten minutes together!\' \'Can\'t remember WHAT.\",\"en\":\"Hatter. \'Nor I,\' said the Gryphon. \'The reason is,\' said the Duchess. An invitation for the end of.\"}', '{\"ar\":\"Blanditiis qui autem magnam ut.\",\"en\":\"Quaerat dolorem quibusdam distinctio voluptas repellat in harum.\"}', '{\"ar\":\"Alice panted as she picked her way out. \'I shall do nothing of the cakes, and was a little way off, and found that, as nearly as large as himself.\",\"en\":\"Alice alone with the Gryphon. \'Turn a somersault in the direction in which you usually see Shakespeare, in the wind, and was gone across to the.\"}', '{\"ar\":\"aut,eligendi,asperiores,deserunt,sequi\",\"en\":\"aperiam,velit,nam,ut,voluptatem\"}', 1, NULL, '1', '1', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(2, '{\"ar\":\"حول الشركة\",\"en\":\"About Us\"}', '{\"ar\":\"حول-الشركة\",\"en\":\"about-us\"}', '{\"ar\":\"T!\' said the Hatter, \'I cut some more tea,\' the Hatter asked triumphantly. Alice did not like to.\",\"en\":\"Hatter went on \'And how did you manage to do this, so that by the Queen jumped up on tiptoe, and.\"}', '{\"ar\":\"Repudiandae quam assumenda enim et voluptatibus est sed.\",\"en\":\"Ut quis doloribus ut.\"}', '{\"ar\":\"Mouse was swimming away from her as she came in with the Queen,\' and she had tired herself out with his knuckles. It was the Hatter. \'Does YOUR.\",\"en\":\"I shall have to fly; and the sounds will take care of themselves.\\\"\' \'How fond she is only a child!\' The Queen turned crimson with fury, and, after.\"}', '{\"ar\":\"voluptatem,doloremque,vero,animi,maiores\",\"en\":\"occaecati,ipsum,possimus,fugit,deleniti\"}', 1, NULL, '1', '1', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(3, '{\"ar\":\"الأسئلة الشائعة\",\"en\":\"FAQ\"}', '{\"ar\":\"الأسئلة-الشائعة\",\"en\":\"faq\"}', '{\"ar\":\"Duchess, the Duchess! Oh! won\'t she be savage if I\'ve kept her eyes immediately met those of a.\",\"en\":\"Alice. \'Only a thimble,\' said Alice indignantly, and she put one arm out of breath, and said \'No.\"}', '{\"ar\":\"Repellat quo eos facere.\",\"en\":\"A ut quisquam iusto qui dicta ab.\"}', '{\"ar\":\"Queen merely remarking that a moment\'s delay would cost them their lives. All the time they were mine before. If I or she should meet the real Mary.\",\"en\":\"Alice\'s great surprise, the Duchess\'s knee, while plates and dishes crashed around it--once more the shriek of the other arm curled round her at the.\"}', '{\"ar\":\"soluta,reiciendis,sapiente,deserunt,nemo\",\"en\":\"aut,sint,praesentium,qui,et\"}', 1, NULL, '1', '1', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(4, '{\"ar\":\"سياسة الخصوصية\",\"en\":\"Privacy Policy\"}', '{\"ar\":\"سياسة-الخصوصية\",\"en\":\"privacy-policy\"}', '{\"ar\":\"Either the well was very fond of beheading people here; the great question certainly was, what?.\",\"en\":\"Dinah my dear! I wish I hadn\'t cried so much!\' Alas! it was indeed: she was getting very sleepy.\"}', '{\"ar\":\"Praesentium et nihil eos fugiat.\",\"en\":\"Quia ut rerum nihil maxime.\"}', '{\"ar\":\"I can guess that,\' she added aloud. \'Do you play croquet with the grin, which remained some time without interrupting it. \'They were obliged to have.\",\"en\":\"RIGHT FOOT, ESQ. HEARTHRUG, NEAR THE FENDER, (WITH ALICE\'S LOVE). Oh dear, what nonsense I\'m talking!\' Just then she heard one of the officers: but.\"}', '{\"ar\":\"eos,consequatur,molestiae,ut,eum\",\"en\":\"ducimus,in,error,at,aliquid\"}', 1, NULL, '1', '1', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(5, '{\"ar\":\"الشروط والأحكام\",\"en\":\"Terms & Conditions\"}', '{\"ar\":\"الشروط-والأحكام\",\"en\":\"terms-conditions\"}', '{\"ar\":\"Hardly knowing what she was up to the waving of the sort!\' said Alice. \'Anything you like,\' said.\",\"en\":\"Duchess; \'and that\'s a fact.\' Alice did not like to be listening, so she turned the corner, but.\"}', '{\"ar\":\"Et earum minus ut consectetur quos eum.\",\"en\":\"Rerum ut fuga eos pariatur aut repellendus animi.\"}', '{\"ar\":\"However, everything is queer to-day.\' Just then she remembered that she was dozing off, and had been for some minutes. Alice thought she might find.\",\"en\":\"There are no mice in the house, quite forgetting in the window, and some of the reeds--the rattling teacups would change to dull reality--the grass.\"}', '{\"ar\":\"quas,laboriosam,rerum,cumque,architecto\",\"en\":\"illum,autem,modi,hic,nesciunt\"}', 1, NULL, '1', '1', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `partner_image` varchar(255) DEFAULT NULL,
  `partner_link` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`partner_link`)),
  `metadata_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_title`)),
  `metadata_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_description`)),
  `metadata_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_keywords`)),
  `status` tinyint(1) DEFAULT 0,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `slug`, `description`, `partner_image`, `partner_link`, `metadata_title`, `metadata_description`, `metadata_keywords`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"أرامكس\",\"en\":\"Aramex\"}', '{\"ar\":\"أرامكس\",\"en\":\"aramex\"}', '{\"ar\":\"شركة عالمية متخصصة في حلول النقل والشحن السريع واللوجستيات.\",\"en\":\"A global provider of transport, express shipping, and logistics solutions.\"}', 'aramex.png', NULL, NULL, NULL, NULL, 1, NULL, 'system', 'system', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(2, '{\"ar\":\"دي إتش إل\",\"en\":\"DHL Express\"}', '{\"ar\":\"دي-إتش-إل\",\"en\":\"dhl-express\"}', '{\"ar\":\"شركة رائدة في خدمات التوصيل السريع والشحن الدولي.\",\"en\":\"A leading company in express delivery and international shipping.\"}', 'dhl.png', NULL, NULL, NULL, NULL, 1, NULL, 'system', 'system', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(3, '{\"ar\":\"فيديكس\",\"en\":\"FedEx\"}', '{\"ar\":\"فيديكس\",\"en\":\"fedex\"}', '{\"ar\":\"تقدم حلول متكاملة للشحن الجوي والبحري والتخزين.\",\"en\":\"Providing integrated solutions for air, sea freight, and warehousing.\"}', 'fedex.png', NULL, NULL, NULL, NULL, 1, NULL, 'system', 'system', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(4, '{\"ar\":\"البريد السعودي (سبل)\",\"en\":\"Saudi Post (SPL)\"}', '{\"ar\":\"البريد-السعودي-سبل\",\"en\":\"saudi-post-spl\"}', '{\"ar\":\"مؤسسة حكومية تقدم خدمات البريد والتوصيل المحلي والدولي.\",\"en\":\"A governmental organization providing postal and delivery services locally and internationally.\"}', 'spl.png', NULL, NULL, NULL, NULL, 1, NULL, 'system', 'system', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(5, '{\"ar\":\"هيئة الزكاة والضريبة والجمارك السعودية\",\"en\":\"Saudi Zakat, Tax and Customs Authority\"}', '{\"ar\":\"هيئة-الزكاة-والضريبة-والجمارك-السعودية\",\"en\":\"saudi-zakat-tax-and-customs-authority\"}', '{\"ar\":\"الجهة الرسمية المنظمة والمشرفة على عمليات الجمارك والضرائب.\",\"en\":\"The official authority regulating customs and tax operations in Saudi Arabia.\"}', 'zatca.png', NULL, NULL, NULL, NULL, 1, NULL, 'system', 'system', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `method` enum('cash','credit_card','bank_transfer','wallet','cod') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `paid_on` datetime DEFAULT NULL,
  `for` enum('delivery','service_fee','storage','combined') NOT NULL DEFAULT 'delivery',
  `reference_note` varchar(255) DEFAULT NULL,
  `payment_reference` varchar(255) DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_visible` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `merchant_id`, `invoice_id`, `method`, `amount`, `currency`, `status`, `paid_on`, `for`, `reference_note`, `payment_reference`, `driver_id`, `status_visible`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'cash', 150.00, 'USD', 'paid', '2025-10-05 03:43:23', 'delivery', 'دفعة نقدية كاملة', 'REF-001', NULL, 1, '2025-10-05 03:43:23', 'system', NULL, NULL, NULL, '2025-10-05 00:43:23', '2025-10-05 00:43:23'),
(2, 1, 1, 'cod', 200.00, 'USD', 'pending', NULL, 'delivery', 'الدفع عند الاستلام للسائق', NULL, 1, 1, '2025-10-05 03:43:23', 'system', NULL, NULL, NULL, '2025-10-05 00:43:23', '2025-10-05 00:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `as` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `parent` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `parent_show` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `parent_original` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `sidebar_link` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `appear` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `ordering` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `route`, `module`, `as`, `icon`, `parent`, `parent_show`, `parent_original`, `sidebar_link`, `appear`, `ordering`, `created_at`, `updated_at`) VALUES
(1, 'main', '{\"ar\":\"الرئيسية\",\"en\":\"Main\"}', NULL, 'index', 'index', 'index', 'fa fa-home', 0, 1, 0, 1, 1, 1, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(2, 'manage_merchants', '{\"ar\":\"إدارة حساب التاجر\",\"en\":\"Manage Merchants\"}', NULL, 'merchants', 'merchants', 'merchants.index', ' fas fa-user-plus', 0, 2, 0, 1, 1, 5, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(3, 'show_merchants', '{\"ar\":\"التاجر\",\"en\":\"Merchants\"}', NULL, 'merchants', 'merchants', 'merchants.index', ' fas fa-user-plus', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(4, 'create_merchants', '{\"ar\":\"إضافة تاجر\",\"en\":\"Add New Merchant\"}', NULL, 'merchants', 'merchants', 'merchants.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(5, 'display_merchants', '{\"ar\":\"استعراض تاجر\",\"en\":\"Display Merchant\"}', NULL, 'merchants', 'merchants', 'merchants.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(6, 'update_merchants', '{\"ar\":\"تعديل تاجر\",\"en\":\"Update Merchant\"}', NULL, 'merchants', 'merchants', 'merchants.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(7, 'delete_merchants', '{\"ar\":\"حذف تاجر \",\"en\":\"Delete Merchant\"}', NULL, 'merchants', 'merchants', 'merchants.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(8, 'manage_products', '{\"ar\":\"إدارة المنتجات\",\"en\":\"Manage Products\"}', NULL, 'products', 'products', 'products.index', 'fab fa-product-hunt', 0, 8, 0, 1, 1, 10, '2025-10-05 00:43:05', '2025-10-05 00:43:06'),
(9, 'show_products', '{\"ar\":\"المنتجات\",\"en\":\"Products\"}', NULL, 'products', 'products', 'products.index', 'fab fa-product-hunt', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(10, 'create_products', '{\"ar\":\"إضافة منتج\",\"en\":\"Add New Product\"}', NULL, 'products', 'products', 'products.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(11, 'display_products', '{\"ar\":\"استعراض منتج\",\"en\":\"Display Product\"}', NULL, 'products', 'products', 'products.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(12, 'update_products', '{\"ar\":\"تعديل منتج\",\"en\":\"Update Product\"}', NULL, 'products', 'products', 'products.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(13, 'delete_products', '{\"ar\":\"حذف منتج \",\"en\":\"Delete Product\"}', NULL, 'products', 'products', 'products.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(14, 'manage_warehouses', '{\"ar\":\"إدارة المستودعات\",\"en\":\"Manage Warehouses\"}', NULL, 'warehouses', 'warehouses', 'warehouses.index', 'fas fa-warehouse', 0, 14, 0, 1, 1, 15, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(15, 'show_warehouses', '{\"ar\":\"المستودعات\",\"en\":\"Warehouses\"}', NULL, 'warehouses', 'warehouses', 'warehouses.index', 'fas fa-warehouse', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(16, 'create_warehouses', '{\"ar\":\"إضافة مستودع\",\"en\":\"Add New Warehouse\"}', NULL, 'warehouses', 'warehouses', 'warehouses.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(17, 'display_warehouses', '{\"ar\":\"استعراض مستودع\",\"en\":\"Display Warehouse\"}', NULL, 'warehouses', 'warehouses', 'warehouses.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(18, 'update_warehouses', '{\"ar\":\"تعديل مستودع\",\"en\":\"Update Warehouse\"}', NULL, 'warehouses', 'warehouses', 'warehouses.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(19, 'delete_warehouses', '{\"ar\":\"حذف مستودع \",\"en\":\"Delete Warehouse\"}', NULL, 'warehouses', 'warehouses', 'warehouses.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(20, 'manage_shelves', '{\"ar\":\"إدارة الرفوف\",\"en\":\"Manage Shelves\"}', NULL, 'shelves', 'shelves', 'shelves.index', 'mdi mdi-18px mdi-library-shelves', 0, 20, 0, 1, 1, 20, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(21, 'show_shelves', '{\"ar\":\"الرفوف\",\"en\":\"Shelves\"}', NULL, 'shelves', 'shelves', 'shelves.index', 'mdi mdi-18px mdi-library-shelves', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(22, 'create_shelves', '{\"ar\":\"إضافة رف\",\"en\":\"Add New Shelve\"}', NULL, 'shelves', 'shelves', 'shelves.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(23, 'display_shelves', '{\"ar\":\"استعراض رف\",\"en\":\"Display Shelve\"}', NULL, 'shelves', 'shelves', 'shelves.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(24, 'update_shelves', '{\"ar\":\"تعديل رف\",\"en\":\"Update Shelve\"}', NULL, 'shelves', 'shelves', 'shelves.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(25, 'delete_shelves', '{\"ar\":\"حذف رف \",\"en\":\"Delete Shelve\"}', NULL, 'shelves', 'shelves', 'shelves.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(26, 'manage_warehouse_rentals', '{\"ar\":\"إدارة تاجير الرفوف\",\"en\":\"Manage Warehouse Rentals\"}', NULL, 'warehouse_rentals', 'warehouse_rentals', 'warehouse_rentals.index', ' fas fa-file-contract ', 0, 26, 0, 1, 1, 25, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(27, 'show_warehouse_rentals', '{\"ar\":\"تاجير الرفوف\",\"en\":\"Warehouse Rentals\"}', NULL, 'warehouse_rentals', 'warehouse_rentals', 'warehouse_rentals.index', ' fas fa-file-contract ', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(28, 'create_warehouse_rentals', '{\"ar\":\"إضافة عملية تاجير رف\",\"en\":\"Add New Warehouse Rental\"}', NULL, 'warehouse_rentals', 'warehouse_rentals', 'warehouse_rentals.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(29, 'display_warehouse_rentals', '{\"ar\":\"استعراض عملية تاجير الرفوف\",\"en\":\"Display Warehouse Rental\"}', NULL, 'warehouse_rentals', 'warehouse_rentals', 'warehouse_rentals.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(30, 'update_warehouse_rentals', '{\"ar\":\"تعديل عملية تاجير الرفوف\",\"en\":\"Update Warehouse Rental\"}', NULL, 'warehouse_rentals', 'warehouse_rentals', 'warehouse_rentals.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(31, 'delete_warehouse_rentals', '{\"ar\":\"عملية تاجير رف \",\"en\":\"Delete Warehouse Rental\"}', NULL, 'warehouse_rentals', 'warehouse_rentals', 'warehouse_rentals.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(32, 'manage_stock_items', '{\"ar\":\"إدارة المخزون\",\"en\":\"Manage Stock Items\"}', NULL, 'stock_items', 'stock_items', 'stock_items.index', 'mdi mdi-1 8px mdi-stocking', 0, 32, 0, 1, 1, 30, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(33, 'show_stock_items', '{\"ar\":\"المخزون\",\"en\":\"Stock Items\"}', NULL, 'stock_items', 'stock_items', 'stock_items.index', 'mdi mdi-1 8px mdi-stocking', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(34, 'create_stock_items', '{\"ar\":\"إضافة عناصر لمخزن\",\"en\":\"Add New Stock Item\"}', NULL, 'stock_items', 'stock_items', 'stock_items.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(35, 'display_stock_items', '{\"ar\":\"استعراض عناصر مخزن\",\"en\":\"Display Stock Item\"}', NULL, 'stock_items', 'stock_items', 'stock_items.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(36, 'update_stock_items', '{\"ar\":\"تعديل عناصر مخزن\",\"en\":\"Update Stock Item\"}', NULL, 'stock_items', 'stock_items', 'stock_items.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(37, 'delete_stock_items', '{\"ar\":\"حذف عناصر مخزن\",\"en\":\"Delete Stock Item\"}', NULL, 'stock_items', 'stock_items', 'stock_items.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(38, 'manage_packages', '{\"ar\":\"إدارة الطرود\",\"en\":\"Manage Packages\"}', NULL, 'packages', 'packages', 'packages.index', 'fas fa-boxes', 0, 38, 0, 1, 1, 35, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(39, 'show_packages', '{\"ar\":\"الطرود\",\"en\":\"Packages\"}', NULL, 'packages', 'packages', 'packages.index', 'fas fa-boxes', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(40, 'create_packages', '{\"ar\":\"إضافة طرد\",\"en\":\"Add New Package\"}', NULL, 'packages', 'packages', 'packages.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(41, 'display_packages', '{\"ar\":\"استعراض طرد\",\"en\":\"Display Package\"}', NULL, 'packages', 'packages', 'packages.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(42, 'update_packages', '{\"ar\":\"تعديل طرد\",\"en\":\"Update Package\"}', NULL, 'packages', 'packages', 'packages.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(43, 'delete_packages', '{\"ar\":\"حذف طرد\",\"en\":\"Delete Package\"}', NULL, 'packages', 'packages', 'packages.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(44, 'manage_drivers', '{\"ar\":\"إدارة السائقين\",\"en\":\"Manage Drivers\"}', NULL, 'drivers', 'drivers', 'drivers.index', 'mdi mdi-1 8px mdi mdi-account-tie', 0, 44, 0, 1, 1, 40, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(45, 'show_drivers', '{\"ar\":\"السائقين\",\"en\":\"Drivers\"}', NULL, 'drivers', 'drivers', 'drivers.index', 'mdi mdi-1 8px mdi mdi-account-tie', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(46, 'create_drivers', '{\"ar\":\"إضافة سائق\",\"en\":\"Add New Driver\"}', NULL, 'drivers', 'drivers', 'drivers.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(47, 'display_drivers', '{\"ar\":\"استعراض سائق\",\"en\":\"Display Driver\"}', NULL, 'drivers', 'drivers', 'drivers.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(48, 'update_drivers', '{\"ar\":\"تعديل سائق\",\"en\":\"Update Driver\"}', NULL, 'drivers', 'drivers', 'drivers.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(49, 'delete_drivers', '{\"ar\":\"حذف سائق\",\"en\":\"Delete Driver\"}', NULL, 'drivers', 'drivers', 'drivers.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(50, 'manage_deliveries', '{\"ar\":\"إدارة التوصيل\",\"en\":\"Manage Deliveries\"}', NULL, 'deliveries', 'deliveries', 'deliveries.index', ' mdi mdi-1 8px mdi-truck-delivery', 0, 50, 0, 1, 1, 45, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(51, 'show_deliveries', '{\"ar\":\"التوصيل\",\"en\":\"Deliveries\"}', NULL, 'deliveries', 'deliveries', 'deliveries.index', ' mdi mdi-1 8px mdi-truck-delivery', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(52, 'create_deliveries', '{\"ar\":\"إضافة عملية توصيل\",\"en\":\"Add New Delivery\"}', NULL, 'deliveries', 'deliveries', 'deliveries.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(53, 'display_deliveries', '{\"ar\":\"استعراض عملية توصيل\",\"en\":\"Display Delivery\"}', NULL, 'deliveries', 'deliveries', 'deliveries.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(54, 'update_deliveries', '{\"ar\":\"تعديل عملية توصيل\",\"en\":\"Update Delivery\"}', NULL, 'deliveries', 'deliveries', 'deliveries.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(55, 'delete_deliveries', '{\"ar\":\"حذف عملية توصيل\",\"en\":\"Delete Delivery\"}', NULL, 'deliveries', 'deliveries', 'deliveries.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(56, 'manage_pickup_requests', '{\"ar\":\"إدارة طلبات الاستلام\",\"en\":\"Manage Pickup Requests\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.index', 'fas fa-truck-loading', 0, 56, 0, 1, 1, 50, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(57, 'show_pickup_requests', '{\"ar\":\"طلبات الاستلام\",\"en\":\"Pickup Requests\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.index', 'fas fa-truck-loading', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(58, 'create_pickup_requests', '{\"ar\":\"إضافة عملية طلب استلام\",\"en\":\"Add New Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(59, 'display_pickup_requests', '{\"ar\":\"استعراض عملية طلب استلام\",\"en\":\"Display Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(60, 'update_pickup_requests', '{\"ar\":\"تعديل عملية طلب استلام\",\"en\":\"Update Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(61, 'delete_pickup_requests', '{\"ar\":\"حذف عملية طلب استلام\",\"en\":\"Delete Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(62, 'manage_return_requests', '{\"ar\":\"إدارة طلبات المرتجعات\",\"en\":\"Manage Return Requests\"}', NULL, 'return_requests', 'return_requests', 'return_requests.index', 'dripicons-return', 0, 62, 0, 1, 1, 55, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(63, 'show_return_requests', '{\"ar\":\"طلبات المرتجعات\",\"en\":\"Return Requests\"}', NULL, 'return_requests', 'return_requests', 'return_requests.index', 'dripicons-return', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(64, 'create_return_requests', '{\"ar\":\"إضافة عملية طلب ارجاع\",\"en\":\"Add New Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(65, 'display_return_requests', '{\"ar\":\"استعراض عملية طلب ارجاع\",\"en\":\"Display Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(66, 'update_return_requests', '{\"ar\":\"تعديل عملية طلب ارجاع\",\"en\":\"Update Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(67, 'delete_return_requests', '{\"ar\":\"حذف عملية طلب ارجاع\",\"en\":\"Delete Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(68, 'manage_shipping_partners', '{\"ar\":\"إدارة شركات الشحن\",\"en\":\"Manage Shipping Partners\"}', NULL, 'shipping_partners', 'shipping_partners', 'shipping_partners.index', 'ri-ship-fill', 0, 68, 0, 1, 1, 60, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(69, 'show_shipping_partners', '{\"ar\":\"شركات الشحن\",\"en\":\"Shipping Partners\"}', NULL, 'shipping_partners', 'shipping_partners', 'shipping_partners.index', 'ri-ship-fill', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(70, 'create_shipping_partners', '{\"ar\":\"إضافة  شركة شحن\",\"en\":\"Add New Shipping Partner\"}', NULL, 'shipping_partners', 'shipping_partners', 'shipping_partners.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(71, 'display_shipping_partners', '{\"ar\":\"استعراض  شركة شحن\",\"en\":\"Display Shipping Partner\"}', NULL, 'shipping_partners', 'shipping_partners', 'shipping_partners.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(72, 'update_shipping_partners', '{\"ar\":\"تعديل  شركة شحن\",\"en\":\"Update Shipping Partner\"}', NULL, 'shipping_partners', 'shipping_partners', 'shipping_partners.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(73, 'delete_shipping_partners', '{\"ar\":\"حذف  شركة شحن\",\"en\":\"Delete Shipping Partner\"}', NULL, 'shipping_partners', 'shipping_partners', 'shipping_partners.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(74, 'manage_external_shipments', '{\"ar\":\"إدارة الشحنات الخارجية \",\"en\":\"Manage External Shipments\"}', NULL, 'external_shipments', 'external_shipments', 'external_shipments.index', 'fas fa-external-link-alt', 0, 74, 0, 1, 1, 65, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(75, 'show_external_shipments', '{\"ar\":\"الشحنات الخارجية\",\"en\":\"External Shipments\"}', NULL, 'external_shipments', 'external_shipments', 'external_shipments.index', 'fas fa-external-link-alt', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(76, 'create_external_shipments', '{\"ar\":\"إضافة  شحنة خارجية\",\"en\":\"Add New External Shipment\"}', NULL, 'external_shipments', 'external_shipments', 'external_shipments.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(77, 'display_external_shipments', '{\"ar\":\"استعراض شحنة خارجية\",\"en\":\"Display External Shipment\"}', NULL, 'external_shipments', 'external_shipments', 'external_shipments.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(78, 'update_external_shipments', '{\"ar\":\"تعديل  شحنة خارجية\",\"en\":\"Update External Shipment\"}', NULL, 'external_shipments', 'external_shipments', 'external_shipments.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(79, 'delete_external_shipments', '{\"ar\":\"حذف  شحنة خارجية\",\"en\":\"Delete External Shipment\"}', NULL, 'external_shipments', 'external_shipments', 'external_shipments.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(80, 'manage_invoices', '{\"ar\":\"إدارة الفواتير\",\"en\":\"Manage Invoices\"}', NULL, 'invoices', 'invoices', 'invoices.index', ' fas fa-file-invoice ', 0, 80, 0, 1, 1, 70, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(81, 'show_invoices', '{\"ar\":\"الفواتير\",\"en\":\"Invoices\"}', NULL, 'invoices', 'invoices', 'invoices.index', ' fas fa-file-invoice ', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(82, 'create_invoices', '{\"ar\":\"إضافة فاتورة\",\"en\":\"Add New Invoice\"}', NULL, 'invoices', 'invoices', 'invoices.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(83, 'display_invoices', '{\"ar\":\"استعراض  فاتورة\",\"en\":\"Display Invoice\"}', NULL, 'invoices', 'invoices', 'invoices.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(84, 'update_invoices', '{\"ar\":\"تعديل فاتورة\",\"en\":\"Update Invoice\"}', NULL, 'invoices', 'invoices', 'invoices.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(85, 'delete_invoices', '{\"ar\":\"حذف فاتورة\",\"en\":\"Delete Invoice\"}', NULL, 'invoices', 'invoices', 'invoices.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(86, 'manage_pricing_rules', '{\"ar\":\"إدارة قواعد التسعير\",\"en\":\"Manage Pricing Rules\"}', NULL, 'pricing_rules', 'pricing_rules', 'pricing_rules.index', 'fas fa-pencil-ruler', 0, 86, 0, 1, 1, 75, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(87, 'show_pricing_rules', '{\"ar\":\"قواعد التسعير\",\"en\":\"Pricing Rules\"}', NULL, 'pricing_rules', 'pricing_rules', 'pricing_rules.index', 'fas fa-pencil-ruler', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(88, 'create_pricing_rules', '{\"ar\":\"إضافة قاعدة تسعير\",\"en\":\"Add New Pricing Rule\"}', NULL, 'pricing_rules', 'pricing_rules', 'pricing_rules.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(89, 'display_pricing_rules', '{\"ar\":\"استعراض  قاعدة تسعير\",\"en\":\"Display Pricing Rule\"}', NULL, 'pricing_rules', 'pricing_rules', 'pricing_rules.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(90, 'update_pricing_rules', '{\"ar\":\"تعديل قاعدة تسعير\",\"en\":\"Update Pricing Rule\"}', NULL, 'pricing_rules', 'pricing_rules', 'pricing_rules.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(91, 'delete_pricing_rules', '{\"ar\":\"حذف قاعدة تسعير\",\"en\":\"Delete Pricing Rule\"}', NULL, 'pricing_rules', 'pricing_rules', 'pricing_rules.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(92, 'manage_supervisors', '{\"ar\":\"المشرفين\",\"en\":\"Supervisors\"}', NULL, 'supervisors', 'supervisors', 'supervisors.index', 'fas fa-user', 0, 92, 0, 0, 1, 100, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(93, 'show_supervisors', '{\"ar\":\"المشرفين\",\"en\":\"Supervisors\"}', NULL, 'supervisors', 'supervisors', 'supervisors.index', 'fas fa-user', 92, 92, 92, 1, 1, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(94, 'create_supervisors', '{\"ar\":\"إنشاء مشرف\",\"en\":\"Create Supervisor\"}', NULL, 'supervisors', 'supervisors', 'supervisors.create', NULL, 92, 92, 92, 1, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(95, 'display_supervisors', '{\"ar\":\"عرض المشرف\",\"en\":\"Show Supervisor\"}', NULL, 'supervisors', 'supervisors', 'supervisors.show', NULL, 92, 92, 92, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(96, 'update_supervisors', '{\"ar\":\"تحديث المشرف\",\"en\":\"Update Supervisor\"}', NULL, 'supervisors', 'supervisors', 'supervisors.edit', NULL, 92, 92, 92, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(97, 'delete_supervisors', '{\"ar\":\"حذف المشرف\",\"en\":\"Delete Supervisor\"}', NULL, 'supervisors', 'supervisors', 'supervisors.destroy', NULL, 92, 92, 92, 0, 0, 0, '2025-10-05 00:43:06', '2025-10-05 00:43:06'),
(98, 'merchant_main', '{\"ar\":\"الرئيسية\",\"en\":\"Main\"}', NULL, 'index', 'index', 'index', 'fa fa-home', 0, 98, 0, 1, 1, 1, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(99, 'merchant_manage_packages', '{\"ar\":\"إدارة الطرود\",\"en\":\"Manage Packages\"}', NULL, 'packages', 'packages', 'packages.index', 'fas fa-boxes', 0, 99, 0, 1, 1, 5, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(100, 'merchant_show_packages', '{\"ar\":\"الطرود\",\"en\":\"Packages\"}', NULL, 'packages', 'packages', 'packages.index', 'fas fa-boxes', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(101, 'merchant_create_packages', '{\"ar\":\"إضافة طرد\",\"en\":\"Add New Package\"}', NULL, 'packages', 'packages', 'packages.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(102, 'merchant_display_packages', '{\"ar\":\"استعراض طرد\",\"en\":\"Display Package\"}', NULL, 'packages', 'packages', 'packages.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(103, 'merchant_update_packages', '{\"ar\":\"تعديل طرد\",\"en\":\"Update Package\"}', NULL, 'packages', 'packages', 'packages.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(104, 'merchant_delete_packages', '{\"ar\":\"حذف طرد\",\"en\":\"Delete Package\"}', NULL, 'packages', 'packages', 'packages.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(105, 'merchant_manage_products', '{\"ar\":\"إدارة المنتجات\",\"en\":\"Manage Products\"}', NULL, 'products', 'products', 'products.index', 'fab fa-product-hunt', 0, 105, 0, 1, 1, 10, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(106, 'merchant_show_products', '{\"ar\":\"عرض المنتجات\",\"en\":\"Show Products\"}', NULL, 'products', 'products', 'products.index', 'fas fa-box', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(107, 'merchant_create_products', '{\"ar\":\"إضافة منتج\",\"en\":\"Create Product\"}', NULL, 'products', 'products', 'products.create', 'fas fa-plus', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(108, 'merchant_edit_products', '{\"ar\":\"تعديل منتج\",\"en\":\"Edit Product\"}', NULL, 'products', 'products', 'products.edit', 'fas fa-edit', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(109, 'merchant_delete_products', '{\"ar\":\"حذف منتج\",\"en\":\"Delete Product\"}', NULL, 'products', 'products', 'products.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(110, 'merchant_manage_pickup_requests', '{\"ar\":\"إدارة طلبات الاستلام\",\"en\":\"Manage Pickup Requests\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.index', 'fas fa-truck-loading', 0, 110, 0, 1, 1, 50, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(111, 'merchant_show_pickup_requests', '{\"ar\":\"طلبات الاستلام\",\"en\":\"Pickup Requests\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.index', 'fas fa-truck-loading', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(112, 'merchant_create_pickup_requests', '{\"ar\":\"إضافة عملية طلب استلام\",\"en\":\"Add New Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(113, 'merchant_display_pickup_requests', '{\"ar\":\"استعراض عملية طلب استلام\",\"en\":\"Display Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(114, 'merchant_update_pickup_requests', '{\"ar\":\"تعديل عملية طلب استلام\",\"en\":\"Update Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(115, 'merchant_delete_pickup_requests', '{\"ar\":\"حذف عملية طلب استلام\",\"en\":\"Delete Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(116, 'merchant_manage_return_requests', '{\"ar\":\"إدارة طلبات المرتجعات\",\"en\":\"Manage Return Requests\"}', NULL, 'return_requests', 'return_requests', 'return_requests.index', 'dripicons-return', 0, 116, 0, 1, 1, 55, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(117, 'merchant_show_return_requests', '{\"ar\":\"طلبات المرتجعات\",\"en\":\"Return Requests\"}', NULL, 'return_requests', 'return_requests', 'return_requests.index', 'dripicons-return', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(118, 'merchant_create_return_requests', '{\"ar\":\"إضافة عملية طلب ارجاع\",\"en\":\"Add New Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(119, 'merchant_display_return_requests', '{\"ar\":\"استعراض عملية طلب ارجاع\",\"en\":\"Display Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(120, 'merchant_update_return_requests', '{\"ar\":\"تعديل عملية طلب ارجاع\",\"en\":\"Update Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(121, 'merchant_delete_return_requests', '{\"ar\":\"حذف عملية طلب ارجاع\",\"en\":\"Delete Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(122, 'driver_main', '{\"ar\":\"الرئيسية\",\"en\":\"Main\"}', NULL, 'index', 'index', 'index', 'fa fa-home', 0, 122, 0, 1, 1, 1, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(123, 'driver_manage_deliveries', '{\"ar\":\"إدارة التوصيل\",\"en\":\"Manage Deliveries\"}', NULL, 'deliveries', 'deliveries', 'deliveries.index', ' mdi mdi-1 8px mdi-truck-delivery', 0, 123, 0, 1, 1, 45, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(124, 'driver_show_deliveries', '{\"ar\":\"التوصيل\",\"en\":\"Deliveries\"}', NULL, 'deliveries', 'deliveries', 'deliveries.index', ' mdi mdi-1 8px mdi-truck-delivery', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(125, 'driver_create_deliveries', '{\"ar\":\"إضافة عملية توصيل\",\"en\":\"Add New Delivery\"}', NULL, 'deliveries', 'deliveries', 'deliveries.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(126, 'driver_display_deliveries', '{\"ar\":\"استعراض عملية توصيل\",\"en\":\"Display Delivery\"}', NULL, 'deliveries', 'deliveries', 'deliveries.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(127, 'driver_update_deliveries', '{\"ar\":\"تعديل عملية توصيل\",\"en\":\"Update Delivery\"}', NULL, 'deliveries', 'deliveries', 'deliveries.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(128, 'driver_delete_deliveries', '{\"ar\":\"حذف عملية توصيل\",\"en\":\"Delete Delivery\"}', NULL, 'deliveries', 'deliveries', 'deliveries.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(129, 'driver_manage_pickup_requests', '{\"ar\":\"إدارة طلبات الاستلام\",\"en\":\"Manage Pickup Requests\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.index', 'fas fa-truck-loading', 0, 129, 0, 1, 1, 50, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(130, 'driver_show_pickup_requests', '{\"ar\":\"طلبات الاستلام\",\"en\":\"Pickup Requests\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.index', 'fas fa-truck-loading', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(131, 'driver_create_pickup_requests', '{\"ar\":\"إضافة عملية طلب استلام\",\"en\":\"Add New Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(132, 'driver_display_pickup_requests', '{\"ar\":\"استعراض عملية طلب استلام\",\"en\":\"Display Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(133, 'driver_update_pickup_requests', '{\"ar\":\"تعديل عملية طلب استلام\",\"en\":\"Update Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(134, 'driver_delete_pickup_requests', '{\"ar\":\"حذف عملية طلب استلام\",\"en\":\"Delete Pickup Request\"}', NULL, 'pickup_requests', 'pickup_requests', 'pickup_requests.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(135, 'driver_manage_return_requests', '{\"ar\":\"إدارة طلبات المرتجعات\",\"en\":\"Manage Return Requests\"}', NULL, 'return_requests', 'return_requests', 'return_requests.index', 'dripicons-return', 0, 135, 0, 1, 1, 55, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(136, 'driver_show_return_requests', '{\"ar\":\"طلبات المرتجعات\",\"en\":\"Return Requests\"}', NULL, 'return_requests', 'return_requests', 'return_requests.index', 'dripicons-return', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(137, 'driver_create_return_requests', '{\"ar\":\"إضافة عملية طلب ارجاع\",\"en\":\"Add New Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(138, 'driver_display_return_requests', '{\"ar\":\"استعراض عملية طلب ارجاع\",\"en\":\"Display Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(139, 'driver_update_return_requests', '{\"ar\":\"تعديل عملية طلب ارجاع\",\"en\":\"Update Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(140, 'driver_delete_return_requests', '{\"ar\":\"حذف عملية طلب ارجاع\",\"en\":\"Delete Return Request\"}', NULL, 'return_requests', 'return_requests', 'return_requests.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(141, 'frontend_dashboard_main', '{\"ar\":\"الرئيسية\",\"en\":\"Main\"}', NULL, 'index', 'index', 'index', 'fa fa-home', 0, 141, 0, 1, 1, 1, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(142, 'frontend_dashboard_manage_main_menus', '{\"ar\":\"إدارة القوائم\",\"en\":\"Manage Menus\"}', NULL, 'main_menus', 'main_menus', 'main_menus.index', 'fa fa-list-ul', 0, 142, 0, 1, 1, 5, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(143, 'frontend_dashboard_show_main_menus', '{\"ar\":\"إدارة القائمة الرئيسية\",\"en\":\"Main Menu\"}', NULL, 'main_menus', 'main_menus', 'main_menus.index', 'fas fa-bars', 142, 142, 142, 1, 1, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(144, 'frontend_dashboard_create_main_menus', '{\"ar\":\"إضافة عنصر قائمة رئيسية\",\"en\":\"Add Main Menu Item\"}', NULL, 'main_menus', 'main_menus', 'main_menus.create', NULL, 142, 142, 142, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(145, 'frontend_dashboard_display_main_menus', '{\"ar\":\"عرض عنصر قائمة رئيسية\",\"en\":\"Display Main Menu Item\"}', NULL, 'main_menus', 'main_menus', 'main_menus.show', NULL, 142, 142, 142, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(146, 'frontend_dashboard_update_main_menus', '{\"ar\":\"تعديل عنصر قائمة رئيسية\",\"en\":\"Edit Main Menu Item\"}', NULL, 'main_menus', 'main_menus', 'main_menus.edit', NULL, 142, 142, 142, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(147, 'frontend_dashboard_delete_main_menus', '{\"ar\":\"حذف عنصر قائمة رئيسية\",\"en\":\"Delete Main Menu Item\"}', NULL, 'main_menus', 'main_menus', 'main_menus.destroy', NULL, 142, 142, 142, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(148, 'frontend_dashboard_manage_system_features_menus', '{\"ar\":\"إدارة قائمة مميزات النظام\",\"en\":\"System Features Menu\"}', NULL, 'system_features_menus', 'system_features_menus', 'system_features_menus.index', 'fas fa-bars', 142, 148, 142, 1, 1, 10, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(149, 'frontend_dashboard_show_system_features_menus', '{\"ar\":\"إدارة قائمة مميزات النظام\",\"en\":\"System Features Menu\"}', NULL, 'system_features_menus', 'system_features_menus', 'system_features_menus.index', 'fas fa-bars', 148, 148, 148, 1, 1, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(150, 'frontend_dashboard_create_system_features_menus', '{\"ar\":\"إضافة عنصر قائمة مميزات النظام \",\"en\":\"Add System Features Menu Item\"}', NULL, 'system_features_menus', 'system_features_menus', 'system_features_menus.create', NULL, 148, 148, 148, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(151, 'frontend_dashboard_display_system_features_menus', '{\"ar\":\"عرض عنصر قائمة مميزات النظام \",\"en\":\"Display System Features Menu Item\"}', NULL, 'system_features_menus', 'system_features_menus', 'system_features_menus.show', NULL, 148, 148, 148, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(152, 'frontend_dashboard_update_system_features_menus', '{\"ar\":\"تعديل عنصر قائمة مميزات النظام \",\"en\":\"Edit System Features Menu Item\"}', NULL, 'system_features_menus', 'system_features_menus', 'system_features_menus.edit', NULL, 148, 148, 148, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(153, 'frontend_dashboard_delete_system_features_menus', '{\"ar\":\"حذف عنصر قائمة مميزات النظام \",\"en\":\"Delete System Features Menu Item\"}', NULL, 'system_features_menus', 'system_features_menus', 'system_features_menus.destroy', NULL, 148, 148, 148, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(154, 'frontend_dashboard_manage_system_modules_menus', '{\"ar\":\"إدارة قائمة وحدات النظام\",\"en\":\"System Modules Menu\"}', NULL, 'system_modules_menus', 'system_modules_menus', 'system_modules_menus.index', 'fas fa-bars', 142, 154, 142, 1, 1, 10, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(155, 'frontend_dashboard_show_system_modules_menus', '{\"ar\":\"إدارة قائمة وحدات النظام\",\"en\":\"System Modules Menu\"}', NULL, 'system_modules_menus', 'system_modules_menus', 'system_modules_menus.index', 'fas fa-bars', 154, 154, 154, 1, 1, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(156, 'frontend_dashboard_create_system_modules_menus', '{\"ar\":\"إضافة عنصر قائمة وحدات النظام \",\"en\":\"Add System Modules Menu Item\"}', NULL, 'system_modules_menus', 'system_modules_menus', 'system_modules_menus.create', NULL, 154, 154, 154, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(157, 'frontend_dashboard_display_system_modules_menus', '{\"ar\":\"عرض عنصر قائمة وحدات النظام \",\"en\":\"Display System Modules Menu Item\"}', NULL, 'system_modules_menus', 'system_modules_menus', 'system_modules_menus.show', NULL, 154, 154, 154, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(158, 'frontend_dashboard_update_system_modules_menus', '{\"ar\":\"تعديل عنصر قائمة وحدات النظام \",\"en\":\"Edit System Modules Menu Item\"}', NULL, 'system_modules_menus', 'system_modules_menus', 'system_modules_menus.edit', NULL, 154, 154, 154, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(159, 'frontend_dashboard_delete_system_modules_menus', '{\"ar\":\"حذف عنصر قائمة وحدات النظام \",\"en\":\"Delete System Modules Menu Item\"}', NULL, 'system_modules_menus', 'system_modules_menus', 'system_modules_menus.destroy', NULL, 154, 154, 154, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(160, 'frontend_dashboard_manage_important_link_menus', '{\"ar\":\"إدارة قائمة روابط مهمة\",\"en\":\"Important Link Menu\"}', NULL, 'important_link_menus', 'important_link_menus', 'important_link_menus.index', 'fas fa-bars', 142, 160, 142, 1, 1, 10, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(161, 'frontend_dashboard_show_important_link_menus', '{\"ar\":\"إدارة قائمة روابط مهمة\",\"en\":\"Important Link Menu\"}', NULL, 'important_link_menus', 'important_link_menus', 'important_link_menus.index', 'fas fa-bars', 160, 160, 160, 1, 1, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(162, 'frontend_dashboard_create_important_link_menus', '{\"ar\":\"إضافة عنصر قائمة روابط مهمة \",\"en\":\"Add Important Link Menu Item\"}', NULL, 'important_link_menus', 'important_link_menus', 'important_link_menus.create', NULL, 160, 160, 160, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(163, 'frontend_dashboard_display_important_link_menus', '{\"ar\":\"عرض عنصر قائمة روابط مهمة \",\"en\":\"Display Important Link Menu Item\"}', NULL, 'important_link_menus', 'important_link_menus', 'important_link_menus.show', NULL, 160, 160, 160, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(164, 'frontend_dashboard_update_important_link_menus', '{\"ar\":\"تعديل عنصر قائمة روابط مهمة \",\"en\":\"Edit Important Link Menu Item\"}', NULL, 'important_link_menus', 'important_link_menus', 'important_link_menus.edit', NULL, 160, 160, 160, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(165, 'frontend_dashboard_delete_important_link_menus', '{\"ar\":\"حذف عنصر قائمة روابط مهمة \",\"en\":\"Delete Important Link Menu Item\"}', NULL, 'important_link_menus', 'important_link_menus', 'important_link_menus.destroy', NULL, 160, 160, 160, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(166, 'frontend_dashboard_manage_main_sliders', '{\"ar\":\"إدارة عارض الشرائح\",\"en\":\"Manage Slide Viewer\"}', NULL, 'main_sliders', 'main_sliders', 'main_sliders.index', 'fas fa-sliders-h', 0, 166, 0, 1, 1, 15, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(167, 'frontend_dashboard_show_main_sliders', '{\"ar\":\" عارض الشرائح الرئيسي\",\"en\":\"Main Slide Viewer\"}', NULL, 'main_sliders', 'main_sliders', 'main_sliders.index', 'fas  fa-sliders-h', 166, 166, 166, 1, 1, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(168, 'frontend_dashboard_create_main_sliders', '{\"ar\":\"إضافة شريحة جديد\",\"en\":\"Add Slide\"}', NULL, 'main_sliders', 'main_sliders', 'main_sliders.create', NULL, 166, 166, 166, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(169, 'frontend_dashboard_display_main_sliders', '{\"ar\":\"عرض الشريحة\",\"en\":\"Display Main Slide\"}', NULL, 'main_sliders', 'main_sliders', 'main_sliders.show', NULL, 166, 166, 166, 0, 0, 0, '2025-10-05 00:43:09', '2025-10-05 00:43:09'),
(170, 'frontend_dashboard_update_main_sliders', '{\"ar\":\"تعديل الشريحة\",\"en\":\"Edit Main Slide\"}', NULL, 'main_sliders', 'main_sliders', 'main_sliders.edit', NULL, 166, 166, 166, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(171, 'frontend_dashboard_delete_main_sliders', '{\"ar\":\"حذف الشريحة\",\"en\":\"Delete Main Slide\"}', NULL, 'main_sliders', 'main_sliders', 'main_sliders.destroy', NULL, 166, 166, 166, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(172, 'frontend_dashboard_manage_advertisor_sliders', '{\"ar\":\"عارض شرائح الإعلانات\",\"en\":\"Adv Slide Viewer\"}', NULL, 'advertisor_sliders', 'advertisor_sliders', 'advertisor_sliders.index', 'fas fa-bullhorn', 166, 172, 0, 1, 1, 20, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(173, 'frontend_dashboard_show_advertisor_sliders', '{\"ar\":\"عارض شرائح الإعلانات\",\"en\":\"Adv Slide Viewer\"}', NULL, 'advertisor_sliders', 'advertisor_sliders', 'advertisor_sliders.index', 'fas fa-bullhorn', 172, 172, 172, 1, 1, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(174, 'frontend_dashboard_create_advertisor_sliders', '{\"ar\":\"إضافة شريحة جديد\",\"en\":\"Add Adv Slide\"}', NULL, 'advertisor_sliders', 'advertisor_sliders', 'advertisor_sliders.create', NULL, 172, 172, 172, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(175, 'frontend_dashboard_display_advertisor_sliders', '{\"ar\":\"عرض الشريحة\",\"en\":\"Display Adv Slide\"}', NULL, 'advertisor_sliders', 'advertisor_sliders', 'advertisor_sliders.show', NULL, 172, 172, 172, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(176, 'frontend_dashboard_update_advertisor_sliders', '{\"ar\":\"تعديل الشريحة\",\"en\":\"Edit Adv Slide\"}', NULL, 'advertisor_sliders', 'advertisor_sliders', 'advertisor_sliders.edit', NULL, 172, 172, 172, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(177, 'frontend_dashboard_delete_advertisor_sliders', '{\"ar\":\"حذف الشريحة\",\"en\":\"Delete Adv Slide\"}', NULL, 'advertisor_sliders', 'advertisor_sliders', 'advertisor_sliders.destroy', NULL, 172, 172, 172, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(178, 'frontend_dashboard_manage_partners', '{\"ar\":\"شركاؤنا\",\"en\":\"Our Partners\"}', NULL, 'partners', 'partners', 'partners.index', 'far fa-handshake', 0, 178, 0, 1, 1, 25, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(179, 'frontend_dashboard_show_partners', '{\"ar\":\"شركاؤنا\",\"en\":\"Our Partners\"}', NULL, 'partners', 'partners', 'partners.index', 'far fa-handshake', 178, 178, 178, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(180, 'frontend_dashboard_create_partners', '{\"ar\":\"إنشاء شريك\",\"en\":\"Create Our Partner\"}', NULL, 'partners', 'partners', 'partners.create', NULL, 178, 178, 178, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(181, 'frontend_dashboard_display_partners', '{\"ar\":\"عرض شريك\",\"en\":\"Display Our Partner\"}', NULL, 'partners', 'partners', 'partners.show', NULL, 178, 178, 178, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(182, 'frontend_dashboard_update_partners', '{\"ar\":\"تعديل شريك\",\"en\":\"Edit Our Partner\"}', NULL, 'partners', 'partners', 'partners.edit', NULL, 178, 178, 178, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(183, 'frontend_dashboard_delete_partners', '{\"ar\":\"حذف شريك\",\"en\":\"Delete Our Partner\"}', NULL, 'partners', 'partners', 'partners.destroy', NULL, 178, 178, 178, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(184, 'frontend_dashboard_manage_page_categories', '{\"ar\":\"إدارة الصفحات\",\"en\":\"Manage Pages\"}', NULL, 'page_categories', 'page_categories', 'page_categories.index', 'far fa-file-alt', 0, 184, 0, 1, 1, 30, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(185, 'frontend_dashboard_show_page_categories', '{\"ar\":\"إدارة تصنيف الصفحات \",\"en\":\"manage Page Categories\"}', NULL, 'page_categories', 'page_categories', 'page_categories.index', 'far fa-file-alt', 184, 184, 184, 1, 1, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(186, 'frontend_dashboard_create_page_categories', '{\"ar\":\"إضافة تصنيف صفحة\",\"en\":\"Add Page Category\"}', NULL, 'page_categories', 'page_categories', 'page_categories.create', NULL, 184, 184, 184, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(187, 'frontend_dashboard_display_page_categories', '{\"ar\":\"عرض تصنيف صفحة\",\"en\":\"Display Page Category\"}', NULL, 'page_categories', 'page_categories', 'page_categories.show', NULL, 184, 184, 184, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(188, 'frontend_dashboard_update_page_categories', '{\"ar\":\"تعديل تصنيف صفحة\",\"en\":\"Edit Page Category\"}', NULL, 'page_categories', 'page_categories', 'page_categories.edit', NULL, 184, 184, 184, 0, 0, 0, '2025-10-05 00:43:10', '2025-10-05 00:43:10'),
(189, 'frontend_dashboard_delete_page_categories', '{\"ar\":\"حذف تصنيف صفحة\",\"en\":\"Delete Page Category\"}', NULL, 'page_categories', 'page_categories', 'page_categories.destroy', NULL, 184, 184, 184, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(190, 'frontend_dashboard_manage_pages', '{\"ar\":\"إدارة الصفحات\",\"en\":\"Manage Pages\"}', NULL, 'pages', 'pages', 'pages.index', 'far fa-file-alt', 184, 190, 0, 1, 1, 35, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(191, 'frontend_dashboard_show_pages', '{\"ar\":\"إدارة الصفحة \",\"en\":\"Main Page\"}', NULL, 'pages', 'pages', 'pages.index', 'far fa-file-alt', 190, 190, 190, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(192, 'frontend_dashboard_create_pages', '{\"ar\":\"إضافة صفحة\",\"en\":\"Add Page\"}', NULL, 'pages', 'pages', 'pages.create', NULL, 190, 190, 190, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(193, 'frontend_dashboard_display_pages', '{\"ar\":\"عرض صفحة\",\"en\":\"Display Page\"}', NULL, 'pages', 'pages', 'pages.show', NULL, 190, 190, 190, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(194, 'frontend_dashboard_update_pages', '{\"ar\":\"تعديل صفحة\",\"en\":\"Edit Page\"}', NULL, 'pages', 'pages', 'pages.edit', NULL, 190, 190, 190, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(195, 'frontend_dashboard_delete_pages', '{\"ar\":\"حذف صفحة\",\"en\":\"Delete Page\"}', NULL, 'pages', 'pages', 'pages.destroy', NULL, 190, 190, 190, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(196, 'frontend_dashboard_manage_testimonials', '{\"ar\":\"إدارة ماذا يقولوا عنا\",\"en\":\"Manage Testimonials\"}', NULL, 'testimonials', 'testimonials', 'testimonials.index', 'fas fa-certificate', 0, 196, 0, 1, 1, 40, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(197, 'frontend_dashboard_show_testimonials', '{\"ar\":\"ماذا يقولوا عنا\",\"en\":\"Testimonials\"}', NULL, 'testimonials', 'testimonials', 'testimonials.index', 'fas fa-certificate', 196, 196, 196, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(198, 'frontend_dashboard_create_testimonials', '{\"ar\":\"إضافة ماذا يقولوا عنا جديدة\",\"en\":\"Create New Testimonial\"}', NULL, 'testimonials/create', 'testimonials', 'testimonials.create', NULL, 196, 196, 196, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(199, 'frontend_dashboard_display_testimonials', '{\"ar\":\"عرض ماذا يقولوا عنا\",\"en\":\"Dispay Testimonial\"}', NULL, 'testimonials/{testimonials}', 'testimonials', 'testimonials.show', NULL, 196, 196, 196, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(200, 'frontend_dashboard_update_testimonials', '{\"ar\":\"تعديل ماذا يقولوا عنا\",\"en\":\"Edit Testimonial\"}', NULL, 'testimonials/{testimonials}/edit', 'testimonials', 'testimonials.edit', NULL, 196, 196, 196, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(201, 'frontend_dashboard_delete_testimonials', '{\"ar\":\"حذف ماذا يقولوا عنا\",\"en\":\"Delete Testimonial\"}', NULL, 'testimonials/{testimonials}', 'testimonials', 'testimonials.destroy', NULL, 196, 196, 196, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(202, 'frontend_dashboard_manage_common_questions', '{\"ar\":\"إدارة الاسئلة الشائعة\",\"en\":\"Asked Questions\"}', NULL, 'common_questions', 'common_questions', 'common_questions.index', 'fas fa-question', 0, 202, 0, 1, 1, 45, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(203, 'frontend_dashboard_show_common_questions', '{\"ar\":\"الاسئلة الشائعة\",\"en\":\"Questions\"}', NULL, 'common_questions', 'common_questions', 'common_questions.index', 'fas fa-question', 202, 202, 202, 1, 1, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(204, 'frontend_dashboard_create_common_questions', '{\"ar\":\"إنشاء سؤال\",\"en\":\"Create Question\"}', NULL, 'common_questions/create', 'common_questions', 'common_questions.create', NULL, 202, 202, 202, 1, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(205, 'frontend_dashboard_display_common_questions', '{\"ar\":\"عرض سؤال\",\"en\":\"Dispay Question\"}', NULL, 'common_questions/{common_questions}', 'common_questions', 'common_questions.show', NULL, 202, 202, 202, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(206, 'frontend_dashboard_update_common_questions', '{\"ar\":\"تعديل سؤال\",\"en\":\"Edit Question\"}', NULL, 'common_questions/{common_questions}/edit', 'common_questions', 'common_questions.edit', NULL, 202, 202, 202, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(207, 'frontend_dashboard_delete_common_questions', '{\"ar\":\"حذف سؤال\",\"en\":\"Delete Question\"}', NULL, 'common_questions/{common_questions}', 'common_questions', 'common_questions.destroy', NULL, 202, 202, 202, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(208, 'frontend_dashboard_manage_Statistics', '{\"ar\":\"إدارة الإحصائيات\",\"en\":\"Manage Statistics\"}', NULL, 'statistics', 'statistics', 'statistics.index', 'far fa-calendar-alt', 0, 208, 0, 1, 1, 140, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(209, 'frontend_dashboard_show_Statistics', '{\"ar\":\"الإحصائيات\",\"en\":\"Statistics\"}', NULL, 'statistics', 'statistics', 'statistics.index', 'far fa-calendar-alt', 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11');
INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `route`, `module`, `as`, `icon`, `parent`, `parent_show`, `parent_original`, `sidebar_link`, `appear`, `ordering`, `created_at`, `updated_at`) VALUES
(210, 'frontend_dashboard_create_Statistics', '{\"ar\":\"إنشاء إحصاء جديد\",\"en\":\"Create Statistic\"}', NULL, 'statistics', 'statistics', 'statistics.create', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(211, 'frontend_dashboard_display_Statistics', '{\"ar\":\"عرض إحصاء\",\"en\":\"Display Statistic\"}', NULL, 'statistics', 'statistics', 'statistics.show', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(212, 'frontend_dashboard_update_Statistics', '{\"ar\":\"تعديل إحصاء\",\"en\":\"Edit Statistic\"}', NULL, 'statistics', 'statistics', 'statistics.edit', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(213, 'frontend_dashboard_delete_Statistics', '{\"ar\":\"حذف إحصاء\",\"en\":\"Delete Statistic\"}', NULL, 'statistics', 'statistics', 'statistics.destroy', NULL, 0, 0, 0, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(214, 'frontend_dashboard_manage_site_settings', '{\"ar\":\"الاعدادات العامة\",\"en\":\"General Settings\"}', NULL, 'settings', 'settings', 'settings.index', 'fa fa-cog', 0, 214, 0, 1, 1, 180, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(215, 'frontend_dashboard_display_site_infos', '{\"ar\":\"إدارة  بيانات الموقع\",\"en\":\"Manage Site Infos\"}', NULL, 'settings.site_main_infos', 'settings.site_main_infos', 'settings.site_main_infos.show', 'fa fa-info-circle', 214, 214, 214, 1, 1, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(216, 'frontend_dashboard_update_site_infos', '{\"ar\":\"تعديل بيانات الموقع\",\"en\":\"Edit Site Infos\"}', NULL, 'settings.site_main_infos', 'settings.site_main_infos', 'settings.site_main_infos.edit', NULL, 214, 214, 214, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(217, 'frontend_dashboard_display_site_contacts', '{\"ar\":\"إدارة  بيانات الإتصال \",\"en\":\"Manage Site Contact \"}', NULL, 'settings.site_contacts', 'settings.site_contacts', 'settings.site_contacts.show', 'fa fa-address-book', 214, 214, 214, 1, 1, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(218, 'frontend_dashboard_update_site_contacts', '{\"ar\":\"تعديل بيانات الإتصال \",\"en\":\"Edit Site Contact \"}', NULL, 'settings.site_contacts', 'settings.site_contacts', 'settings.site_contacts.edit', NULL, 214, 214, 214, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(219, 'frontend_dashboard_display_site_socials', '{\"ar\":\" إدارة  حسابات التواصل  \",\"en\":\"Manage Site Socials\"}', NULL, 'settings.site_socials', 'settings.site_socials', 'settings.site_socials.show', 'fas fa-rss', 214, 214, 214, 1, 1, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(220, 'frontend_dashboard_update_site_socials', '{\"ar\":\"تعديل حسابات التواصل \",\"en\":\"Edit Site Contact Infos\"}', NULL, 'settings.site_socials', 'settings.site_socials', 'settings.site_socials.edit', NULL, 214, 214, 214, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(221, 'frontend_dashboard_display_site_meta', '{\"ar\":\"إدارة  SEO\",\"en\":\"Manage Site SEO\"}', NULL, 'settings.site_meta', 'settings.site_meta', 'settings.site_meta.show', 'fa fa-tag', 214, 214, 214, 1, 1, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11'),
(222, 'frontend_dashboard_update_site_meta', '{\"ar\":\"تعديل SEO\",\"en\":\"Edit Site SEO\"}', NULL, 'settings.site_meta', 'settings.site_meta', 'settings.site_meta.edit', NULL, 214, 214, 214, 0, 0, 0, '2025-10-05 00:43:11', '2025-10-05 00:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(8, 1),
(8, 2),
(14, 1),
(14, 2),
(20, 1),
(20, 2),
(26, 1),
(26, 2),
(32, 1),
(32, 2),
(38, 1),
(38, 2),
(44, 1),
(44, 2),
(50, 1),
(50, 2),
(56, 1),
(56, 2),
(62, 1),
(62, 2),
(68, 1),
(68, 2),
(74, 1),
(74, 2),
(80, 1),
(80, 2),
(86, 1),
(86, 2),
(98, 4),
(99, 4),
(100, 4),
(101, 4),
(102, 4),
(103, 4),
(104, 4),
(105, 4),
(106, 4),
(107, 4),
(108, 4),
(109, 4),
(110, 4),
(111, 4),
(112, 4),
(113, 4),
(114, 4),
(115, 4),
(116, 4),
(117, 4),
(118, 4),
(119, 4),
(120, 4),
(121, 4),
(122, 5),
(123, 5),
(124, 5),
(125, 5),
(126, 5),
(127, 5),
(128, 5),
(129, 5),
(130, 5),
(131, 5),
(132, 5),
(133, 5),
(134, 5),
(135, 5),
(136, 5),
(137, 5),
(138, 5),
(139, 5),
(140, 5),
(141, 6),
(142, 6),
(143, 6),
(144, 6),
(145, 6),
(146, 6),
(147, 6),
(148, 6),
(149, 6),
(150, 6),
(151, 6),
(152, 6),
(153, 6),
(154, 6),
(155, 6),
(156, 6),
(157, 6),
(158, 6),
(159, 6),
(160, 6),
(161, 6),
(162, 6),
(163, 6),
(164, 6),
(165, 6),
(166, 6),
(167, 6),
(168, 6),
(169, 6),
(170, 6),
(171, 6),
(172, 6),
(173, 6),
(174, 6),
(175, 6),
(176, 6),
(177, 6),
(178, 6),
(179, 6),
(180, 6),
(181, 6),
(182, 6),
(183, 6),
(184, 6),
(185, 6),
(186, 6),
(187, 6),
(188, 6),
(189, 6),
(190, 6),
(191, 6),
(192, 6),
(193, 6),
(194, 6),
(195, 6),
(196, 6),
(197, 6),
(198, 6),
(199, 6),
(200, 6),
(201, 6),
(202, 6),
(203, 6),
(204, 6),
(205, 6),
(206, 6),
(207, 6),
(208, 6),
(209, 6),
(210, 6),
(211, 6),
(212, 6),
(213, 6),
(214, 6),
(215, 6),
(216, 6),
(217, 6),
(218, 6),
(219, 6),
(220, 6),
(221, 6),
(222, 6);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `file_status` varchar(255) NOT NULL DEFAULT '1',
  `file_sort` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_requests`
--

CREATE TABLE `pickup_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `scheduled_at` datetime DEFAULT NULL,
  `accepted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `status` enum('pending','accepted','completed','canceled') NOT NULL DEFAULT 'pending',
  `status_visible` tinyint(1) NOT NULL DEFAULT 1,
  `note` varchar(255) DEFAULT NULL,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pickup_requests`
--

INSERT INTO `pickup_requests` (`id`, `merchant_id`, `driver_id`, `country`, `region`, `city`, `district`, `postal_code`, `latitude`, `longitude`, `scheduled_at`, `accepted_at`, `completed_at`, `status`, `status_visible`, `note`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-07 03:43:22', NULL, NULL, 'pending', 1, 'يرجى التأكد من وجود شخص لاخذ الطرود في العنوان المحدد.', '2025-10-05 03:43:22', 'system', NULL, NULL, NULL, '2025-10-05 00:43:22', '2025-10-05 00:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_rules`
--

CREATE TABLE `pricing_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `type` enum('delivery','storage','handling') NOT NULL DEFAULT 'delivery',
  `zone` varchar(255) DEFAULT NULL,
  `min_weight` int(11) NOT NULL DEFAULT 0,
  `max_weight` int(11) DEFAULT NULL,
  `max_length` int(11) DEFAULT NULL,
  `max_width` int(11) DEFAULT NULL,
  `max_height` int(11) DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price_per_kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `extra_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `oversized` tinyint(1) NOT NULL DEFAULT 0,
  `fragile` tinyint(1) NOT NULL DEFAULT 0,
  `perishable` tinyint(1) NOT NULL DEFAULT 0,
  `express` tinyint(1) NOT NULL DEFAULT 0,
  `same_day` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricing_rules`
--

INSERT INTO `pricing_rules` (`id`, `name`, `slug`, `description`, `type`, `zone`, `min_weight`, `max_weight`, `max_length`, `max_width`, `max_height`, `base_price`, `price_per_kg`, `extra_fee`, `oversized`, `fragile`, `perishable`, `express`, `same_day`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Riyadh Local (0-5kg)\",\"ar\":\"داخل الرياض (0 - 5 كجم)\"}', '{\"en\":\"riyadh-local-0-5kg\",\"ar\":\"داخل-الرياض-0-5-كجم\"}', '{\"en\":\"Delivery within Riyadh up to 5kg\",\"ar\":\"التوصيل داخل الرياض للطرود حتى 5 كجم\"}', 'delivery', 'Riyadh', 0, 5000, NULL, NULL, NULL, 25.00, 3.00, 0.00, 0, 0, 0, 0, 0, 1, '2025-10-05 00:43:23', '2025-10-05 00:43:23'),
(2, '{\"en\":\"Outside Riyadh (0-5kg)\",\"ar\":\"خارج الرياض (0 - 5 كجم)\"}', '{\"en\":\"outside-riyadh-0-5kg\",\"ar\":\"خارج-الرياض-0-5-كجم\"}', '{\"en\":\"Delivery outside Riyadh up to 5kg\",\"ar\":\"التوصيل خارج الرياض للطرود حتى 5 كجم\"}', 'delivery', 'Outside_Riyadh', 0, 5000, NULL, NULL, NULL, 35.00, 4.00, 0.00, 0, 0, 0, 0, 0, 1, '2025-10-05 00:43:23', '2025-10-05 00:43:23'),
(3, '{\"en\":\"Remote Areas (0-10kg)\",\"ar\":\"المناطق النائية (0 - 10 كجم)\"}', '{\"en\":\"remote-areas-0-10kg\",\"ar\":\"المناطق-النائية-0-10-كجم\"}', '{\"en\":\"Delivery to remote areas up to 10kg\",\"ar\":\"التوصيل إلى المناطق النائية حتى 10 كجم\"}', 'delivery', 'Remote', 0, 10000, NULL, NULL, NULL, 50.00, 6.00, 0.00, 0, 0, 0, 0, 0, 1, '2025-10-05 00:43:23', '2025-10-05 00:43:23'),
(4, '{\"en\":\"Express Delivery\",\"ar\":\"شحن سريع\"}', '{\"en\":\"express-delivery\",\"ar\":\"شحن-سريع\"}', '{\"en\":\"Express delivery\",\"ar\":\"شحن سريع\"}', 'delivery', 'Any', 0, NULL, NULL, NULL, NULL, 10.00, 0.00, 15.00, 0, 0, 0, 1, 0, 1, '2025-10-05 00:43:23', '2025-10-05 00:43:23'),
(5, '{\"en\":\"Same Day Delivery\",\"ar\":\"توصيل نفس اليوم\"}', '{\"en\":\"same-day-delivery\",\"ar\":\"توصيل-نفس-اليوم\"}', '{\"en\":\"Delivery on the same day\",\"ar\":\"التوصيل في نفس اليوم\"}', 'delivery', 'Any', 0, NULL, NULL, NULL, NULL, 0.00, 0.00, 25.00, 0, 0, 0, 0, 1, 1, '2025-10-05 00:43:23', '2025-10-05 00:43:23'),
(6, '{\"en\":\"Storage Tier 1\",\"ar\":\"تخزين - المستوى الأول\"}', '{\"en\":\"storage-tier-1\",\"ar\":\"تخزين-المستوى-الأول\"}', '{\"en\":\"Storage up to 30 days\",\"ar\":\"التخزين على الرفوف القياسية حتى 30 يوم\"}', 'storage', NULL, 0, NULL, NULL, NULL, NULL, 500.00, 0.00, 0.00, 0, 0, 0, 0, 0, 1, '2025-10-05 00:43:23', '2025-10-05 00:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `merchant_id`, `name`, `description`, `sku`, `images`, `price`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'كمبيوتر محمول', 'كمبيوتر محمول عالي الأداء', 'LPTP-12345', NULL, 25.00, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:19', '2025-10-05 00:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `rental_shelves`
--

CREATE TABLE `rental_shelves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_rental_id` bigint(20) UNSIGNED NOT NULL,
  `shelf_id` bigint(20) UNSIGNED NOT NULL,
  `custom_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `custom_start` date DEFAULT NULL,
  `custom_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rental_shelves`
--

INSERT INTO `rental_shelves` (`id`, `warehouse_rental_id`, `shelf_id`, `custom_price`, `total_price`, `custom_start`, `custom_end`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 318.00, 0.00, '2025-09-17', '2025-12-14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_request_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('stock','custom') NOT NULL DEFAULT 'custom',
  `stock_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `custom_name` varchar(255) DEFAULT NULL,
  `shelf_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_items`
--

INSERT INTO `return_items` (`id`, `return_request_id`, `type`, `stock_item_id`, `custom_name`, `shelf_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'stock', 1, NULL, 1, 2, '2025-10-05 00:43:23', '2025-10-05 00:43:23'),
(2, 1, 'custom', NULL, 'Custom Product Example', 1, 3, '2025-10-05 00:43:23', '2025-10-05 00:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `return_requests`
--

CREATE TABLE `return_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `return_type` enum('to_warehouse','to_merchant','to_both') NOT NULL DEFAULT 'to_warehouse',
  `reason` text DEFAULT NULL,
  `status` enum('requested','assigned_to_driver','picked_up','in_transit','received','partially_received','rejected','cancelled') NOT NULL DEFAULT 'requested',
  `requested_at` datetime DEFAULT NULL,
  `received_at` datetime DEFAULT NULL,
  `target_address` varchar(255) DEFAULT NULL,
  `status_visible` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_requests`
--

INSERT INTO `return_requests` (`id`, `package_id`, `driver_id`, `return_type`, `reason`, `status`, `requested_at`, `received_at`, `target_address`, `status_visible`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'to_warehouse', 'المنتج مكسور', 'requested', '2025-10-05 03:43:23', NULL, NULL, 1, '2025-10-05 03:43:23', 'system', NULL, NULL, NULL, '2025-10-05 00:43:23', '2025-10-05 00:43:23'),
(2, 1, NULL, 'to_merchant', 'المنتج لا يناسب الطلب', 'in_transit', '2025-10-04 03:43:23', '2025-10-05 03:43:23', 'شارع الزبيري - صنعاء', 1, '2025-10-05 03:43:23', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:23', '2025-10-05 00:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `allowed_route` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `allowed_route`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', 'admin', '2025-10-05 00:43:02', '2025-10-05 00:43:02'),
(2, 'supervisor', 'User Supervisor', 'Supervisor is allowed to manage and edit other users', 'admin', '2025-10-05 00:43:02', '2025-10-05 00:43:02'),
(3, 'customer', 'Project Customer', 'Customer is the customer of a given project', NULL, '2025-10-05 00:43:03', '2025-10-05 00:43:03'),
(4, 'merchant', 'Merchant', 'User is merchant and has his own dashboard', 'merchant', '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(5, 'driver', 'Driver', 'User is Driver and has his own dashboard', 'driver', '2025-10-05 00:43:08', '2025-10-05 00:43:08'),
(6, 'frontend_dashboard', 'Frontend Dashboard', 'User is Frontend designer and has his own dashboard', 'frontend_dashboard', '2025-10-05 00:43:09', '2025-10-05 00:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 4),
(10, 5),
(11, 6);

-- --------------------------------------------------------

--
-- Table structure for table `shelves`
--

CREATE TABLE `shelves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `size` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shelves`
--

INSERT INTO `shelves` (`id`, `warehouse_id`, `code`, `description`, `size`, `price`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'SH-A1', NULL, 'large', 250, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:19', '2025-10-05 00:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_partners`
--

CREATE TABLE `shipping_partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`address`)),
  `contact_person` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contact_person`)),
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `api_url` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `auth_type` varchar(255) DEFAULT NULL,
  `credentails` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_partners`
--

INSERT INTO `shipping_partners` (`id`, `name`, `slug`, `description`, `address`, `contact_person`, `contact_email`, `contact_phone`, `api_url`, `api_token`, `auth_type`, `credentails`, `logo`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"شريك شحن سريع\",\"en\":\"Fast Shipping Partner\"}', '{\"ar\":\"شريك-شحن-سريع\",\"en\":\"fast-shipping-partner\"}', '{\"ar\":\"شريك شحن سريع\",\"en\":\"Fast Shipping Partner\"}', NULL, '{\"ar\":\"محمد على\",\"en\":\"Moamed Ali\"}', 'FastShipping@gmail.com', '772036131', 'https://api.fastship.com', 'tokentest123', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:23', '2025-10-05 00:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`value`)),
  `section` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT 'admin',
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `key`, `value`, `section`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'site_name', '{\"ar\":\"أوراكس لوجستيك\",\"en\":\"Orax Logistics\"}', 1, 1, '2002-07-10 20:38:41', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(2, 'site_short_name', '{\"ar\":\"أوراكس\",\"en\":\"Orax\"}', 1, 1, '2012-10-08 16:44:23', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(3, 'site_address', '{\"ar\":\"المملكة العربية السعودية\",\"en\":\"Kingdom of Saudi Arabia\"}', 1, 1, '2016-07-30 12:54:58', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(4, 'site_description', '{\"ar\":\"خدمات الشحن والتخزين والتوصيل الموثوقة\",\"en\":\"Reliable shipping, storage, and delivery services\"}', 1, 1, '1983-07-21 21:08:59', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(5, 'site_link', '{\"ar\":\"https://www.oraxlogistics.com\"}', 1, 1, '2001-05-31 16:29:09', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(6, 'site_workTime', '{\"ar\":\"طوال أيام الأسبوع\",\"en\":\"Every day of the week\"}', 1, 1, '1970-11-14 11:24:45', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(7, 'site_img', '{\"ar\":\"1.jpg\"}', 1, 1, '1971-02-03 18:22:42', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(8, 'site_logo_large_light', '{\"ar\":\"logo_light.png\"}', 1, 1, '2010-09-03 04:27:22', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(9, 'site_logo_small_light', '{\"ar\":\"logo_small_light.png\"}', 1, 1, '2017-11-09 22:47:24', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(10, 'site_logo_large_dark', '{\"ar\":\"logo_dark.png\"}', 1, 1, '2006-12-02 05:24:18', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(11, 'site_logo_small_dark', '{\"ar\":\"logo_small_dark.png\"}', 1, 1, '2002-02-27 00:27:05', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(12, 'site_phone', '{\"ar\":\"772036131\"}', 2, 1, '1994-10-10 16:39:30', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(13, 'site_mobile', '{\"ar\":\"436285\"}', 2, 1, '2022-04-09 19:38:45', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(14, 'site_fax', '{\"ar\":\"fx\"}', 2, 1, '1994-07-30 23:58:57', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(15, 'site_po_box', '{\"ar\":\"985\"}', 2, 1, '1979-11-09 09:00:28', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(16, 'site_email1', '{\"ar\":\"info@oraxlogistics.com\"}', 2, 1, '1988-10-15 10:05:45', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(17, 'site_email2', '{\"ar\":\"support@oraxlogistics.com\"}', 2, 1, '1981-07-01 21:14:20', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(18, 'site_facebook', '{\"ar\":\"https://facebook.com/oraxlogistics\"}', 3, 1, '1974-06-01 06:59:50', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(19, 'site_twitter', '{\"ar\":\"https://twitter.com/oraxlogistics\"}', 3, 1, '1971-02-13 13:47:55', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(20, 'site_youtube', '{\"ar\":\"https://youtube.com/oraxlogistics\"}', 3, 1, '1986-07-15 09:13:25', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(21, 'site_instagram', '{\"ar\":\"https://instagram.com/oraxlogistics\"}', 3, 1, '2001-02-18 11:14:21', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(22, 'site_linkedin', '{\"ar\":\"https://linkedin.com/company/oraxlogistics\"}', 3, 1, '2001-05-18 15:21:11', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(23, 'site_name_meta', '{\"ar\":\"أوراكس لوجستيك\",\"en\":\"Orax Logistics\"}', 4, 1, '2020-08-30 06:35:36', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(24, 'site_description_meta', '{\"ar\":\"شركة رائدة في خدمات الشحن والتخزين والتوصيل\",\"en\":\"Leading company in shipping, storage, and delivery services\"}', 4, 1, '1970-07-26 11:59:42', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(25, 'site_link_meta', '{\"ar\":\"https://www.oraxlogistics.com\"}', 4, 1, '2009-02-17 19:12:06', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(26, 'site_keywords_meta', '{\"ar\":\"شحن, تخزين, توصيل, لوجستيات\",\"en\":\"shipping, storage, delivery, logistics\"}', 4, 1, '2011-01-18 14:37:20', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(27, 'site_main_sliders', '{\"ar\":10}', 6, 1, '1994-07-18 02:50:57', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(28, 'site_advertisor_sliders', '{\"ar\":10}', 6, 1, '1979-10-06 14:58:03', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(29, 'site_posts', '{\"ar\":10}', 6, 1, '2008-08-03 16:53:25', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `subtitle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`subtitle`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`description`)),
  `icon` varchar(255) DEFAULT NULL,
  `btn_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`btn_title`)),
  `url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`url`)),
  `show_btn_title` tinyint(1) NOT NULL DEFAULT 1,
  `target` varchar(255) NOT NULL DEFAULT '_self',
  `section` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `show_info` tinyint(1) NOT NULL DEFAULT 1,
  `metadata_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_title`)),
  `metadata_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_description`)),
  `metadata_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_keywords`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `slug`, `subtitle`, `description`, `icon`, `btn_title`, `url`, `show_btn_title`, `target`, `section`, `show_info`, `metadata_title`, `metadata_description`, `metadata_keywords`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"خدمات التوصيل السريع\",\"en\":\"Fast & Reliable Delivery\"}', '{\"ar\":\"velit-fuga-eum-commodi\",\"en\":\"aut-consequatur-sed-inventore\"}', '{\"ar\":\"توصيل في نفس اليوم للمناطق المختارة\",\"en\":\"Same-day delivery in selected areas\"}', '{\"ar\":\"خدمات توصيل سريعة وآمنة مع تتبع لحظي وإمكانية اختيار مواعيد التسليم.\",\"en\":\"Fast, secure deliveries with real-time tracking and delivery time options.\"}', NULL, '{\"ar\":\"اطلب الآن\",\"en\":\"Order Now\"}', '{\"ar\":\"https://beier.net\",\"en\":\"https://purdy.net\"}', 1, '_self', 1, 1, NULL, NULL, NULL, 1, '2025-08-22 00:10:46', 'seeder', 'seeder', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(2, '{\"ar\":\"تخزين آمن ومرن\",\"en\":\"Secure & Flexible Storage\"}', '{\"ar\":\"placeat-doloribus-expedita-rem\",\"en\":\"deleniti-est-sed-iure-in\"}', '{\"ar\":\"مستودعات مؤمّنة وموزعة جغرافيًا\",\"en\":\"Secure warehouses distributed geographically\"}', '{\"ar\":\"خدمات تخزين مرنة مع إدارة مخزون متقدمة ومستويات أمان عالية تناسب التجار.\",\"en\":\"Flexible storage with advanced inventory management and high security levels for merchants.\"}', NULL, '{\"ar\":\"احجز مساحة\",\"en\":\"Reserve Space\"}', '{\"ar\":\"https://sipes.info\",\"en\":\"https://dietrich.com\"}', 1, '_self', 1, 1, NULL, NULL, NULL, 1, '2025-05-08 17:21:12', 'seeder', 'seeder', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(3, '{\"ar\":\"تتبع الطرود لحظة بلحظة\",\"en\":\"Real-time Parcel Tracking\"}', '{\"ar\":\"esse-recusandae\",\"en\":\"aut-dolor-vero\"}', '{\"ar\":\"اعرف حالة الشحنة في كل مرحلة\",\"en\":\"Know your shipment status at every step\"}', '{\"ar\":\"لوحة تحكم متقدمة للتتبع، إشعارات لحظية وسجل حركة كامل لكل طرد.\",\"en\":\"Advanced tracking dashboard, instant notifications and full activity log per parcel.\"}', NULL, '{\"ar\":\"تتبع طردك\",\"en\":\"Track Your Parcel\"}', '{\"ar\":\"https://mclaughlin.com\",\"en\":\"https://romaguera.org\"}', 1, '_self', 1, 1, NULL, NULL, NULL, 1, '2025-06-25 18:38:22', 'seeder', 'seeder', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(4, '{\"ar\":\"حلول متكاملة للتجار\",\"en\":\"Integrated Solutions for Merchants\"}', '{\"ar\":\"eveniet-nostrum-quia\",\"en\":\"laborum-sunt-rerum-deleniti\"}', '{\"ar\":\"إدارة المخزون، الشحن والفوترة من مكان واحد\",\"en\":\"Inventory, shipping and billing from one place\"}', '{\"ar\":\"APIs للربط، تقارير مبيعات وفوترة أوتوماتيكية لتسهيل عمليات المتاجر.\",\"en\":\"APIs for integration, reports and automated billing to simplify merchant operations.\"}', NULL, '{\"ar\":\"انضم كتاجر\",\"en\":\"Join as Merchant\"}', '{\"ar\":\"https://bernier.org\",\"en\":\"https://stamm.org\"}', 1, '_self', 1, 1, NULL, NULL, NULL, 1, '2025-07-10 15:03:15', 'seeder', 'seeder', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(5, '{\"ar\":\"خدمة التوصيل السريع\",\"en\":\"Express Delivery Service\"}', '{\"ar\":\"خدمة-التوصيل-السريع\",\"en\":\"express-delivery-service\"}', '{\"ar\":\"شحن آمن إلى جميع المدن\",\"en\":\"Safe shipping to all cities\"}', '{\"ar\":\"توصيل سريع وآمن للطرود مع إمكانية التتبع المباشر.\",\"en\":\"Fast and secure parcel delivery with real-time tracking.\"}', 'fas fa-shipping-fast', '{\"ar\":\"ابدأ الآن\",\"en\":\"Get Started\"}', '{\"ar\":\"https://howe.net\"}', 1, '_self', 2, 1, NULL, NULL, NULL, 1, '2025-06-15 18:42:15', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(6, '{\"ar\":\"حلول التخزين المرن\",\"en\":\"Flexible Storage Solutions\"}', '{\"ar\":\"حلول-التخزين-المرن\",\"en\":\"flexible-storage-solutions\"}', '{\"ar\":\"مستودعات مؤمنة بالكامل\",\"en\":\"Fully secured warehouses\"}', '{\"ar\":\"وفر مساحة لتخزين منتجاتك مع مراقبة دقيقة للمخزون.\",\"en\":\"Store your products with precise inventory monitoring.\"}', 'fas fa-warehouse', '{\"ar\":\"احجز مستودعك\",\"en\":\"Book Storage\"}', '{\"ar\":\"https://ryan.com\"}', 1, '_self', 2, 1, NULL, NULL, NULL, 1, '2025-08-08 08:25:05', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(7, '{\"ar\":\"تتبع الطرود بسهولة\",\"en\":\"Easy Parcel Tracking\"}', '{\"ar\":\"تتبع-الطرود-بسهولة\",\"en\":\"easy-parcel-tracking\"}', '{\"ar\":\"اعرف مكان طردك في أي وقت\",\"en\":\"Know where your parcel is anytime\"}', '{\"ar\":\"نظام تتبع لحظي مع إشعارات فورية لكل عملية تسليم.\",\"en\":\"Real-time tracking system with instant delivery updates.\"}', 'fas fa-map-marked-alt', '{\"ar\":\"تتبع الآن\",\"en\":\"Track Now\"}', '{\"ar\":\"https://metz.org\"}', 1, '_self', 2, 1, NULL, NULL, NULL, 1, '2025-05-31 16:06:21', 'admin', NULL, NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `icon` varchar(255) DEFAULT NULL,
  `statistic_number` int(11) DEFAULT NULL,
  `statistic_image` varchar(255) DEFAULT NULL,
  `metadata_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_title`)),
  `metadata_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_description`)),
  `metadata_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata_keywords`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `title`, `slug`, `icon`, `statistic_number`, `statistic_image`, `metadata_title`, `metadata_description`, `metadata_keywords`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"الطرود المسلَّمة\",\"en\":\"Parcels Delivered\"}', '{\"ar\":\"sit-quia\",\"en\":\"sunt-tenetur-deserunt-perspiciatis\"}', 'fas fa-box', 4325, NULL, '{\"ar\":\"الطرود المسلَّمة\",\"en\":\"Parcels Delivered\"}', '{\"ar\":\"إحصائية حول الطرود المسلَّمة\",\"en\":\"Statistics about Parcels Delivered\"}', '{\"ar\":\"إحصائيات, لوجستيات, توصيل, تخزين\",\"en\":\"statistics, logistics, delivery, storage\"}', 1, '2016-09-11 14:07:08', 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(2, '{\"ar\":\"الشحنات قيد النقل\",\"en\":\"Shipments In Transit\"}', '{\"ar\":\"ex-est-quo-praesentium\",\"en\":\"dignissimos-eos-dolores-beatae\"}', 'fas fa-truck', 903, NULL, '{\"ar\":\"الشحنات قيد النقل\",\"en\":\"Shipments In Transit\"}', '{\"ar\":\"إحصائية حول الشحنات قيد النقل\",\"en\":\"Statistics about Shipments In Transit\"}', '{\"ar\":\"إحصائيات, لوجستيات, توصيل, تخزين\",\"en\":\"statistics, logistics, delivery, storage\"}', 0, '2003-05-13 07:35:36', 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(3, '{\"ar\":\"الشركاء اللوجستيون\",\"en\":\"Logistic Partners\"}', '{\"ar\":\"sed-voluptatem-amet-dignissimos-quis\",\"en\":\"atque-dolorem-eaque\"}', 'fas fa-handshake', 10, NULL, '{\"ar\":\"الشركاء اللوجستيون\",\"en\":\"Logistic Partners\"}', '{\"ar\":\"إحصائية حول الشركاء اللوجستيون\",\"en\":\"Statistics about Logistic Partners\"}', '{\"ar\":\"إحصائيات, لوجستيات, توصيل, تخزين\",\"en\":\"statistics, logistics, delivery, storage\"}', 0, '1971-08-25 13:07:48', 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27'),
(4, '{\"ar\":\"مراكز التخزين\",\"en\":\"Warehouses\"}', '{\"ar\":\"velit-non-in\",\"en\":\"aspernatur-dolorem-aut-quos\"}', 'fas fa-warehouse', 39, NULL, '{\"ar\":\"مراكز التخزين\",\"en\":\"Warehouses\"}', '{\"ar\":\"إحصائية حول مراكز التخزين\",\"en\":\"Statistics about Warehouses\"}', '{\"ar\":\"إحصائيات, لوجستيات, توصيل, تخزين\",\"en\":\"statistics, logistics, delivery, storage\"}', 0, '1980-01-02 03:57:34', 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:27', '2025-10-05 00:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `stock_items`
--

CREATE TABLE `stock_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `rental_shelf_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_items`
--

INSERT INTO `stock_items` (`id`, `merchant_id`, `rental_shelf_id`, `product_id`, `quantity`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 98, 1, '2025-10-05 03:43:21', 'seeder', NULL, NULL, NULL, '2025-10-05 00:43:21', '2025-10-05 00:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `section` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `section`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"تطوير الذات\",\"en\":\"Self development\"}', '{\"ar\":\"تطوير-الذات\",\"en\":\"self-development\"}', 1, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:13', '2025-10-05 00:43:13'),
(2, '{\"ar\":\"تطوير البرمجيات\",\"en\":\"software development\"}', '{\"ar\":\"تطوير-البرمجيات\",\"en\":\"software-development\"}', 1, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:13', '2025-10-05 00:43:13'),
(3, '{\"ar\":\"تطوير الذات\",\"en\":\"Self development\"}', '{\"ar\":\"تطوير-الذات-1\",\"en\":\"self-development-1\"}', 2, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:13', '2025-10-05 00:43:13'),
(4, '{\"ar\":\"تطوير البرمجيات\",\"en\":\"software development\"}', '{\"ar\":\"تطوير-البرمجيات-1\",\"en\":\"software-development-1\"}', 2, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:13', '2025-10-05 00:43:13'),
(5, '{\"ar\":\"تطوير الذات\",\"en\":\"Self development\"}', '{\"ar\":\"تطوير-الذات-2\",\"en\":\"self-development-2\"}', 3, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:13', '2025-10-05 00:43:13'),
(6, '{\"ar\":\"تطوير البرمجيات\",\"en\":\"software development\"}', '{\"ar\":\"تطوير-البرمجيات-2\",\"en\":\"software-development-2\"}', 3, 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:13', '2025-10-05 00:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `image` varchar(255) DEFAULT NULL,
  `metadata_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_title`)),
  `metadata_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_description`)),
  `metadata_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_keywords`)),
  `status` tinyint(1) DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `title`, `slug`, `content`, `image`, `metadata_title`, `metadata_description`, `metadata_keywords`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"شركة أرامكس\",\"en\":\"Aramex\"}', '{\"ar\":\"شريك موثوق في التوصيل\",\"en\":\"Trusted Delivery Partner\"}', '{\"ar\":\"unde-sit-et-sint-possimus\",\"en\":\"necessitatibus-ipsam-eius-nulla-consequatur-nisi-nemo-quam-temporibus\"}', '{\"ar\":\"نعمل مع هذا النظام لتسريع عمليات التوصيل وتحسين تجربة العملاء.\",\"en\":\"We collaborate with this system to accelerate deliveries and enhance customer experience.\"}', 'aramex.jpg', '{\"ar\":\"شريك موثوق في التوصيل\",\"en\":\"Trusted Delivery Partner\"}', '{\"ar\":\"نعمل مع هذا النظام لتسريع عمليات التوصيل وتحسين تجربة العملاء.\",\"en\":\"We collaborate with this system to accelerate deliveries and enhance customer experience.\"}', '{\"ar\":\"شحن,توصيل,لوجستيات,طرود\",\"en\":\"shipping,delivery,logistics,parcels\"}', 0, '1975-02-22 14:17:42', 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(2, '{\"ar\":\"شركة DHL\",\"en\":\"DHL\"}', '{\"ar\":\"التوصيل الدولي بسرعة\",\"en\":\"Fast International Delivery\"}', '{\"ar\":\"libero-praesentium-voluptatibus-atque-ut-sed-qui-repellat\",\"en\":\"et-saepe-est-delectus-placeat-explicabo-quis\"}', '{\"ar\":\"النظام ساعدنا في تتبع الطرود بدقة عالية وتحسين خدماتنا الدولية.\",\"en\":\"The system helped us track parcels accurately and improve our international services.\"}', 'dhl.jpg', '{\"ar\":\"التوصيل الدولي بسرعة\",\"en\":\"Fast International Delivery\"}', '{\"ar\":\"النظام ساعدنا في تتبع الطرود بدقة عالية وتحسين خدماتنا الدولية.\",\"en\":\"The system helped us track parcels accurately and improve our international services.\"}', '{\"ar\":\"شحن,توصيل,لوجستيات,طرود\",\"en\":\"shipping,delivery,logistics,parcels\"}', 1, '1978-04-12 00:16:39', 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(3, '{\"ar\":\"هيئة الزكاء السعودية\",\"en\":\"Saudi Logistics Authority\"}', '{\"ar\":\"تحسين الخدمات اللوجستية\",\"en\":\"Enhancing Logistic Services\"}', '{\"ar\":\"et-culpa-nemo-aut-illum-sit-eum-reprehenderit\",\"en\":\"eius-nisi-velit-voluptatibus-molestiae-id-neque-quia-vel\"}', '{\"ar\":\"نظام موثوق يساهم في تحسين إدارة الطرود وتسهيل عمليات التخزين.\",\"en\":\"A reliable system that enhances parcel management and streamlines warehouse operations.\"}', 'saudi_authority.jpg', '{\"ar\":\"تحسين الخدمات اللوجستية\",\"en\":\"Enhancing Logistic Services\"}', '{\"ar\":\"نظام موثوق يساهم في تحسين إدارة الطرود وتسهيل عمليات التخزين.\",\"en\":\"A reliable system that enhances parcel management and streamlines warehouse operations.\"}', '{\"ar\":\"شحن,توصيل,لوجستيات,طرود\",\"en\":\"shipping,delivery,logistics,parcels\"}', 1, '1975-07-16 13:14:48', 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26'),
(4, '{\"ar\":\"شركة فيديكس\",\"en\":\"FedEx\"}', '{\"ar\":\"دعم كامل لشحن الطرود\",\"en\":\"Complete Support for Parcel Shipping\"}', '{\"ar\":\"sit-accusantium-alias-in-vel\",\"en\":\"ea-voluptatum-quod-eum\"}', '{\"ar\":\"العمل مع هذا النظام يجعل عملياتنا أسرع وأكثر دقة.\",\"en\":\"Working with this system makes our operations faster and more accurate.\"}', 'fedex.jpg', '{\"ar\":\"دعم كامل لشحن الطرود\",\"en\":\"Complete Support for Parcel Shipping\"}', '{\"ar\":\"العمل مع هذا النظام يجعل عملياتنا أسرع وأكثر دقة.\",\"en\":\"Working with this system makes our operations faster and more accurate.\"}', '{\"ar\":\"شحن,توصيل,لوجستيات,طرود\",\"en\":\"shipping,delivery,logistics,parcels\"}', 1, '1970-11-02 18:09:04', 'admin', 'admin', NULL, NULL, '2025-10-05 00:43:26', '2025-10-05 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`first_name`)),
  `last_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`last_name`)),
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `layout_preferences` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`layout_preferences`)),
  `remember_token` varchar(100) DEFAULT NULL,
  `receive_emails` tinyint(1) NOT NULL DEFAULT 1,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `motavation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`motavation`)),
  `biography` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `email_verified_at`, `mobile`, `password`, `user_image`, `status`, `layout_preferences`, `remember_token`, `receive_emails`, `description`, `motavation`, `biography`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `website`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"مدير\",\"en\":\"Admin\"}', '{\"ar\":\"النظام\",\"en\":\"System\"}', 'admin', 'admin@gmail.com', '2025-10-05 00:43:03', '00967772036131', '$2y$10$jTPlb5S.s80gd5YsyRRm/eckNVBcdFVSvJqoNvgUFzng2lOz4T8fK', 'avator.svg', 1, '\"{\\\"layout\\\":\\\"vertical\\\",\\\"topbar\\\":\\\"dark\\\",\\\"sidebar\\\":\\\"dark\\\",\\\"sidebar_size\\\":\\\"default\\\",\\\"layout_size\\\":\\\"fluid\\\",\\\"preloader\\\":true,\\\"rtl\\\":true,\\\"mode\\\":\\\"light\\\",\\\"locale\\\":\\\"ar\\\"}\"', 'q8Xkj0vBwq', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:03', '2025-10-05 00:43:03'),
(2, '{\"ar\":\"مشرف\",\"en\":\"Supervisor\"}', '{\"ar\":\"النظام\",\"en\":\"System\"}', 'supervisor', 'supervisor@gmail.com', '2025-10-05 00:43:03', '00967772036132', '$2y$10$za7i8DV7lzofjl8KsNVdEutN4EAawXx4ogq7IWL/qM9J//LE0uW/G', 'avator.svg', 1, NULL, 'PLIPQTTl01', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:03', '2025-10-05 00:43:03'),
(3, '{\"ar\":\"خليل\",\"en\":\"khaleel\"}', '{\"ar\":\"راوح\",\"en\":\"Raweh\"}', 'khaleel', 'khaleelvisa@gmail.com', '2025-10-05 00:43:03', '00967772036133', '$2y$10$lCHBK5Jf.hm8S88yCntDKeDiloxHh9/dIO1l63VdkXF.CBScDA8sy', 'avator.svg', 1, NULL, 'kNCF5kaiuV', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:03', '2025-10-05 00:43:03'),
(4, '{\"ar\":\"Leanne\",\"en\":\"Lavinia\"}', '{\"ar\":\"Goyette\",\"en\":\"Olson\"}', 'mckenzie.avery', 'joannie.ohara@frami.com', '2025-10-05 00:43:04', '00967771705765', '$2y$10$zZcbV4UTATkYsBHNFpIsEuVsfey3VKbVofzugiBiy.6PEegVflvOS', 'avator.svg', 1, NULL, 'CIsv0Ap1ZQ', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:04', '2025-10-05 00:43:04'),
(5, '{\"ar\":\"Steve\",\"en\":\"Reyes\"}', '{\"ar\":\"Schumm\",\"en\":\"Kling\"}', 'casey76', 'dzemlak@connelly.com', '2025-10-05 00:43:04', '00967771647025', '$2y$10$EmFDMXE2nh9KEp.cAnvskOruXULGS4p7Q7iZZGil6w9wyM4FQMeF6', 'avator.svg', 1, NULL, 'ez8ltWNtbX', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:04', '2025-10-05 00:43:04'),
(6, '{\"ar\":\"Kareem\",\"en\":\"Rachel\"}', '{\"ar\":\"Cassin\",\"en\":\"Crooks\"}', 'otho.stokes', 'nona13@renner.org', '2025-10-05 00:43:04', '00967777486961', '$2y$10$Wt4c.Tlzm3cc6SSY69ERo.VXOQ4veBa9pXjHV.pea8qcIbOS3Q00O', 'avator.svg', 1, NULL, 'iUgOCHKedZ', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:04', '2025-10-05 00:43:04'),
(7, '{\"ar\":\"Alta\",\"en\":\"Otha\"}', '{\"ar\":\"Dicki\",\"en\":\"Russel\"}', 'mraz.annamae', 'conrad19@dicki.org', '2025-10-05 00:43:05', '00967773753951', '$2y$10$FGr7LnM.3IupadVar5dl.OOyZZd4qDztTxweLwhbK.TvKgDHGYkMS', 'avator.svg', 1, NULL, 'zwZeeDAfCf', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(8, '{\"ar\":\"Ruth\",\"en\":\"Rosamond\"}', '{\"ar\":\"Ryan\",\"en\":\"Ernser\"}', 'vanessa21', 'hill.brittany@gmail.com', '2025-10-05 00:43:05', '00967777545664', '$2y$10$nlBrcH8igG2a1xlNgKgHIOhLQJFrtDwSsKGCsiemSGWodFv8SggWC', 'avator.svg', 1, NULL, 'FhpLGhd69Y', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:05', '2025-10-05 00:43:05'),
(9, '{\"ar\":\"متجر النجاح\"}', '{\"ar\":\"أحمد محمد\"}', 'alnagah', 'alnagah@gmail.com', '2025-10-05 00:43:18', '777777777', '$2y$10$TRDJ43JfcJXosZgsnvDWluJx9g5YJ3xJWUdWPqi6IDfQjU5mxRyWq', 'avator.svg', 1, '\"{\\\"layout\\\":\\\"vertical\\\",\\\"topbar\\\":\\\"dark\\\",\\\"sidebar\\\":\\\"dark\\\",\\\"sidebar_size\\\":\\\"default\\\",\\\"layout_size\\\":\\\"fluid\\\",\\\"preloader\\\":true,\\\"rtl\\\":true,\\\"mode\\\":\\\"light\\\",\\\"locale\\\":\\\"ar\\\"}\"', 'eLZdamCYF86b8gyz0tYXRSQ5BAwMCcLX2Xy8GdpSsar8W2eZbNTvjQZ2hf0z', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Seeder', NULL, NULL, NULL, '2025-10-05 00:43:18', '2025-10-05 00:43:18'),
(10, '{\"ar\":\"خالد\",\"en\":\"Khaled\"}', '{\"ar\":\"حمود\",\"en\":\"Hammoud\"}', 'driver', 'khaled@example.com', '2025-10-05 00:43:21', '777123456', '$2y$10$IjHNwSZAv7vJg1wpudXViOKaStfnHLFgaD4rHchubSU0e7D5EK8aC', 'avator.svg', 1, '\"{\\\"layout\\\":\\\"vertical\\\",\\\"topbar\\\":\\\"dark\\\",\\\"sidebar\\\":\\\"dark\\\",\\\"sidebar_size\\\":\\\"default\\\",\\\"layout_size\\\":\\\"fluid\\\",\\\"preloader\\\":true,\\\"rtl\\\":true,\\\"mode\\\":\\\"light\\\",\\\"locale\\\":\\\"ar\\\"}\"', 'YX7Ri3vN70', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Seeder', NULL, NULL, NULL, '2025-10-05 00:43:21', '2025-10-05 00:43:21'),
(11, '{\"ar\":\"واجهة امامية\",\"en\":\"Frontend\"}', '{\"ar\":\"مدير\",\"en\":\"Manager\"}', 'frontend_manager', 'frontend_manager@gmail.com', '2025-10-05 00:43:24', '00967772036166', '$2y$10$IkQW7dqqvfi6agFLQ6u3yO7cdiS0Sx8nK53DcND4FHM684.Ccw0ay', 'avator.svg', 1, '\"{\\\"layout\\\":\\\"vertical\\\",\\\"topbar\\\":\\\"dark\\\",\\\"sidebar\\\":\\\"dark\\\",\\\"sidebar_size\\\":\\\"default\\\",\\\"layout_size\\\":\\\"fluid\\\",\\\"preloader\\\":true,\\\"rtl\\\":true,\\\"mode\\\":\\\"light\\\",\\\"locale\\\":\\\"ar\\\"}\"', 'zpyWg0LbCj', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Seeder', NULL, NULL, NULL, '2025-10-05 00:43:24', '2025-10-05 00:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `manager` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manager`)),
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `country`, `region`, `city`, `district`, `postal_code`, `latitude`, `longitude`, `manager`, `email`, `phone`, `code`, `status`, `published_on`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"المستودع الرئيسي\",\"en\":\"Main Warehouse\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"ar\":\"محمد احمد صالح\",\"en\":\"Mohamed Ahmed Saleh\"}', NULL, NULL, 'wa-1', 1, NULL, NULL, NULL, NULL, NULL, '2025-10-05 00:43:19', '2025-10-05 00:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_rentals`
--

CREATE TABLE `warehouse_rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `rental_start` date NOT NULL,
  `rental_end` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_rentals`
--

INSERT INTO `warehouse_rentals` (`id`, `merchant_id`, `rental_start`, `rental_end`, `price`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-09-05', '2025-12-05', 318.00, 1, 'Seeder', NULL, NULL, NULL, '2025-10-05 00:43:19', '2025-10-05 00:43:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `common_questions`
--
ALTER TABLE `common_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_driver_id_foreign` (`driver_id`),
  ADD KEY `deliveries_package_id_foreign` (`package_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `drivers_username_unique` (`username`),
  ADD UNIQUE KEY `drivers_email_unique` (`email`),
  ADD KEY `drivers_user_id_foreign` (`user_id`),
  ADD KEY `drivers_supervisor_id_foreign` (`supervisor_id`);

--
-- Indexes for table `external_shipments`
--
ALTER TABLE `external_shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `external_shipments_external_tracking_number_unique` (`external_tracking_number`),
  ADD KEY `external_shipments_shipping_partner_id_foreign` (`shipping_partner_id`),
  ADD KEY `external_shipments_package_id_foreign` (`package_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_merchant_id_foreign` (`merchant_id`),
  ADD KEY `invoices_payable_type_payable_id_index` (`payable_type`,`payable_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `menu_properties`
--
ALTER TABLE `menu_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_properties_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchants_api_key_unique` (`api_key`),
  ADD KEY `merchants_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packages_tracking_number_unique` (`tracking_number`),
  ADD KEY `packages_merchant_id_foreign` (`merchant_id`),
  ADD KEY `packages_receiver_merchant_id_foreign` (`receiver_merchant_id`),
  ADD KEY `packages_rental_shelf_id_foreign` (`rental_shelf_id`),
  ADD KEY `packages_parent_package_id_foreign` (`parent_package_id`),
  ADD KEY `packages_origin_warehouse_id_foreign` (`origin_warehouse_id`);

--
-- Indexes for table `package_logs`
--
ALTER TABLE `package_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_logs_package_id_foreign` (`package_id`),
  ADD KEY `package_logs_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `package_products`
--
ALTER TABLE `package_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_products_package_id_foreign` (`package_id`),
  ADD KEY `package_products_stock_item_id_foreign` (`stock_item_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_page_category_id_foreign` (`page_category_id`);

--
-- Indexes for table `page_categories`
--
ALTER TABLE `page_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payments_driver_id_foreign` (`driver_id`),
  ADD KEY `payments_merchant_id_index` (`merchant_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pickup_requests_merchant_id_foreign` (`merchant_id`),
  ADD KEY `pickup_requests_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `pricing_rules`
--
ALTER TABLE `pricing_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `rental_shelves`
--
ALTER TABLE `rental_shelves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_shelves_warehouse_rental_id_foreign` (`warehouse_rental_id`),
  ADD KEY `rental_shelves_shelf_id_foreign` (`shelf_id`);

--
-- Indexes for table `return_items`
--
ALTER TABLE `return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_items_return_request_id_foreign` (`return_request_id`),
  ADD KEY `return_items_stock_item_id_foreign` (`stock_item_id`),
  ADD KEY `return_items_shelf_id_foreign` (`shelf_id`);

--
-- Indexes for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_requests_package_id_foreign` (`package_id`),
  ADD KEY `return_requests_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `shelves`
--
ALTER TABLE `shelves`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shelves_code_unique` (`code`),
  ADD KEY `shelves_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `shipping_partners`
--
ALTER TABLE `shipping_partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_items_merchant_id_foreign` (`merchant_id`),
  ADD KEY `stock_items_rental_shelf_id_foreign` (`rental_shelf_id`),
  ADD KEY `stock_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `user_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_rentals`
--
ALTER TABLE `warehouse_rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_rentals_merchant_id_foreign` (`merchant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `common_questions`
--
ALTER TABLE `common_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `external_shipments`
--
ALTER TABLE `external_shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `menu_properties`
--
ALTER TABLE `menu_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package_logs`
--
ALTER TABLE `package_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package_products`
--
ALTER TABLE `package_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_categories`
--
ALTER TABLE `page_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pricing_rules`
--
ALTER TABLE `pricing_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rental_shelves`
--
ALTER TABLE `rental_shelves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `return_items`
--
ALTER TABLE `return_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `return_requests`
--
ALTER TABLE `return_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shelves`
--
ALTER TABLE `shelves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_partners`
--
ALTER TABLE `shipping_partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taggables`
--
ALTER TABLE `taggables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouse_rentals`
--
ALTER TABLE `warehouse_rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deliveries_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `drivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `external_shipments`
--
ALTER TABLE `external_shipments`
  ADD CONSTRAINT `external_shipments_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `external_shipments_shipping_partner_id_foreign` FOREIGN KEY (`shipping_partner_id`) REFERENCES `shipping_partners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `menu_properties`
--
ALTER TABLE `menu_properties`
  ADD CONSTRAINT `menu_properties_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `merchants`
--
ALTER TABLE `merchants`
  ADD CONSTRAINT `merchants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `packages_origin_warehouse_id_foreign` FOREIGN KEY (`origin_warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `packages_parent_package_id_foreign` FOREIGN KEY (`parent_package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `packages_receiver_merchant_id_foreign` FOREIGN KEY (`receiver_merchant_id`) REFERENCES `merchants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `packages_rental_shelf_id_foreign` FOREIGN KEY (`rental_shelf_id`) REFERENCES `rental_shelves` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `package_logs`
--
ALTER TABLE `package_logs`
  ADD CONSTRAINT `package_logs_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `package_logs_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_products`
--
ALTER TABLE `package_products`
  ADD CONSTRAINT `package_products_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_products_stock_item_id_foreign` FOREIGN KEY (`stock_item_id`) REFERENCES `stock_items` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_page_category_id_foreign` FOREIGN KEY (`page_category_id`) REFERENCES `page_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD CONSTRAINT `pickup_requests_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pickup_requests_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rental_shelves`
--
ALTER TABLE `rental_shelves`
  ADD CONSTRAINT `rental_shelves_shelf_id_foreign` FOREIGN KEY (`shelf_id`) REFERENCES `shelves` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rental_shelves_warehouse_rental_id_foreign` FOREIGN KEY (`warehouse_rental_id`) REFERENCES `warehouse_rentals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_items`
--
ALTER TABLE `return_items`
  ADD CONSTRAINT `return_items_return_request_id_foreign` FOREIGN KEY (`return_request_id`) REFERENCES `return_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_items_shelf_id_foreign` FOREIGN KEY (`shelf_id`) REFERENCES `shelves` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `return_items_stock_item_id_foreign` FOREIGN KEY (`stock_item_id`) REFERENCES `stock_items` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD CONSTRAINT `return_requests_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `return_requests_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shelves`
--
ALTER TABLE `shelves`
  ADD CONSTRAINT `shelves_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD CONSTRAINT `stock_items_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_items_rental_shelf_id_foreign` FOREIGN KEY (`rental_shelf_id`) REFERENCES `rental_shelves` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warehouse_rentals`
--
ALTER TABLE `warehouse_rentals`
  ADD CONSTRAINT `warehouse_rentals_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
