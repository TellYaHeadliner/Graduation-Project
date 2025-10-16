-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2025 lúc 09:36 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `roomix`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(34, 'Sức khỏe & Thể thao', NULL, '2025-07-17 17:56:17', '2025-07-17 17:56:17'),
(35, 'Phòng ngủ', NULL, '2025-07-17 17:56:17', '2025-07-17 17:56:17'),
(36, 'Phòng tắm', NULL, '2025-07-17 17:56:17', '2025-07-17 17:56:17'),
(37, 'Tiện nghi giải trí', NULL, '2025-07-17 17:56:17', '2025-07-17 17:56:17'),
(38, 'Tiện nghi bếp', NULL, '2025-07-17 17:56:17', '2025-07-17 17:56:17'),
(39, 'Ăn uống', NULL, '2025-07-17 17:56:17', '2025-07-17 17:56:17'),
(40, 'An toàn & bảo mật', NULL, '2025-07-17 17:56:17', '2025-07-17 17:56:17'),
(41, 'Dịch vụ & tiện ích khác', NULL, '2025-07-17 17:56:17', '2025-07-17 17:56:17'),
(50, 'Phòng gym', 34, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(51, 'Trung tâm thể dục', 34, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(52, 'Hồ bơi', 34, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(53, 'Spa', 34, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(54, 'Giường cỡ King', 35, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(55, 'Tủ quần áo', 35, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(56, 'Bàn làm việc', 35, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(57, 'Vòi sen', 36, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(58, 'Bồn tắm', 36, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(59, 'Máy sấy tóc', 36, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(60, 'Khăn tắm', 36, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(61, 'TV màn hình phẳng', 37, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(62, 'Truyền hình cáp', 37, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(63, 'WiFi miễn phí', 37, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(64, 'Ấm đun nước điện', 38, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(65, 'Tủ lạnh', 38, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(66, 'Lò vi sóng', 38, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(67, 'Bếp điện', 38, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(68, 'Máy pha cà phê', 38, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(69, 'Minibar', 39, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(70, 'Phục vụ ăn sáng tại phòng', 39, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(71, 'Khu vực ăn uống riêng', 39, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(72, 'Két an toàn', 40, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(73, 'Báo cháy tự động', 40, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(74, 'Máy báo khói', 40, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(75, 'Dọn phòng hàng ngày', 41, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(76, 'Lễ tân 24 giờ', 41, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(77, 'Giặt là', 41, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(78, 'Thang máy', 41, '2025-07-17 17:58:51', '2025-07-17 17:58:51'),
(79, 'Điều hòa', 41, '2025-07-17 17:58:51', '2025-07-17 17:58:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` char(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Người lớn', 'guest', 1, '2025-06-21 16:05:18', '2025-06-21 16:05:18'),
(4, 'Trẻ em', 'children', 1, '2025-06-21 16:06:21', '2025-06-21 16:06:21'),
(5, 'Bao gồm bữa sáng', 'meal', 1, '2025-06-21 16:06:52', '2025-06-21 16:06:52'),
(6, 'Không hút thuốc', 'smoking', 1, '2025-06-21 16:07:42', '2025-06-21 16:07:42'),
(7, 'Miễn phí huỷ trước 24h và thu phí sau đó', 'free_before and fee_after', 1, '2025-06-21 16:09:41', '2025-06-21 16:10:16'),
(8, 'Không hoàn tiền', 'no_refund', 1, '2025-06-21 16:10:53', '2025-06-21 16:10:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bed_types`
--

CREATE TABLE `bed_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bed_types`
--

INSERT INTO `bed_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Giường Đơn', '2025-05-27 08:08:22', '2025-05-27 08:08:22'),
(2, 'Giường Đôi', '2025-05-27 08:08:45', '2025-05-27 08:08:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `voucher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_code` char(50) NOT NULL,
  `total_amount` int(11) NOT NULL DEFAULT 0,
  `checkin_date` datetime NOT NULL,
  `checkout_date` datetime NOT NULL,
  `check_in_at` datetime DEFAULT NULL,
  `check_out_at` datetime DEFAULT NULL,
  `note` text DEFAULT NULL,
  `cancellation_fee` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `customer_id`, `hotel_id`, `voucher_id`, `booking_code`, `total_amount`, `checkin_date`, `checkout_date`, `check_in_at`, `check_out_at`, `note`, `cancellation_fee`, `status`, `created_at`, `updated_at`) VALUES
(92, 135, 2, 7, 'RMX20250718HHTNKD', 2480000, '2025-07-18 19:25:00', '2025-07-20 16:25:00', '2025-07-18 08:19:45', '2025-07-18 08:20:29', '', 0, 3, '2025-07-18 01:12:20', '2025-07-18 01:20:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_combos`
--

CREATE TABLE `booking_combos` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `combo_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL DEFAULT 0,
  `total_price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_combos`
--

INSERT INTO `booking_combos` (`booking_id`, `combo_id`, `quantity`, `price`, `total_price`, `created_at`, `updated_at`) VALUES
(92, 3, 1, 1000000, 1000000, '2025-07-18 01:12:20', '2025-07-18 01:12:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_details`
--

CREATE TABLE `booking_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `room_type_variant_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price_per_room` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_details`
--

INSERT INTO `booking_details` (`id`, `booking_id`, `room_type_id`, `room_type_variant_id`, `room_id`, `price_per_room`, `created_at`, `updated_at`) VALUES
(144, 92, 4, 10, 1, 990000, '2025-07-18 01:12:20', '2025-07-18 01:12:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_services`
--

CREATE TABLE `booking_services` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_service_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL DEFAULT 0,
  `total_price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `combos`
--

CREATE TABLE `combos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` longtext DEFAULT NULL,
  `combo_price` int(11) NOT NULL DEFAULT 0,
  `original_price` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `combos`
--

INSERT INTO `combos` (`id`, `hotel_id`, `name`, `short_description`, `combo_price`, `original_price`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 'Combo cuối tuần', NULL, 1000000, 2000000, 1, '2025-06-19 08:29:32', '2025-07-10 08:51:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `combo_services`
--

CREATE TABLE `combo_services` (
  `combo_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_service_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `combo_services`
--

INSERT INTO `combo_services` (`combo_id`, `hotel_service_id`, `quantity`, `created_at`, `updated_at`) VALUES
(3, 3, 2, '2025-06-19 09:53:38', '2025-06-19 09:53:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `commission_rules`
--

CREATE TABLE `commission_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_amount` int(11) NOT NULL,
  `max_amount` int(11) DEFAULT NULL,
  `commission_percent` decimal(5,1) UNSIGNED NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `commission_rules`
--

INSERT INTO `commission_rules` (`id`, `min_amount`, `max_amount`, `commission_percent`, `note`, `is_active`, `created_at`, `updated_at`) VALUES
(7, 0, 10000000, 15.0, NULL, 1, '2025-06-30 17:18:05', '2025-06-30 17:18:05'),
(8, 10001000, 30000000, 12.0, NULL, 1, '2025-06-30 17:19:41', '2025-06-30 17:19:41'),
(9, 30001000, 50000000, 10.0, NULL, 1, '2025-06-30 17:20:46', '2025-06-30 17:20:46'),
(10, 50001000, NULL, 8.0, NULL, 1, '2025-06-30 17:22:23', '2025-06-30 17:23:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `partner_id` bigint(20) UNSIGNED NOT NULL,
  `last_message` text DEFAULT NULL,
  `last_message_at` datetime DEFAULT NULL,
  `unread_by_customer` tinyint(1) DEFAULT 0,
  `unread_by_partner` tinyint(1) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `conversations`
--

INSERT INTO `conversations` (`id`, `customer_id`, `partner_id`, `last_message`, `last_message_at`, `unread_by_customer`, `unread_by_partner`, `status`, `created_at`, `updated_at`) VALUES
(14, 115, 2, 'sao bạn', '2025-07-17 09:27:27', 0, 1, 1, '2025-07-17 02:27:04', '2025-07-17 02:27:27'),
(15, 135, 2, 'Khách sạn Tam Cốc chào', '2025-07-18 08:24:50', 1, 0, 1, '2025-07-17 05:35:51', '2025-07-18 01:24:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `favorites`
--

CREATE TABLE `favorites` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `favorites`
--

INSERT INTO `favorites` (`user_id`, `hotel_id`, `created_at`, `updated_at`) VALUES
(4, 2, '2025-07-08 01:56:26', '2025-07-08 01:56:26'),
(135, 137, '2025-07-18 00:19:22', '2025-07-18 00:19:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `description` longtext DEFAULT NULL,
  `star_rating` tinyint(4) NOT NULL DEFAULT 0,
  `phone` char(10) NOT NULL,
  `mst` char(13) NOT NULL,
  `bank_account_number` char(50) NOT NULL,
  `bank_account_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `avatar` text DEFAULT NULL,
  `gallery` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `reputation_score` tinyint(4) NOT NULL DEFAULT 70,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `address`, `description`, `star_rating`, `phone`, `mst`, `bank_account_number`, `bank_account_name`, `bank_name`, `avatar`, `gallery`, `status`, `reputation_score`, `created_at`, `updated_at`) VALUES
(1, 'HOLO HAM NGHI SAIGON - Serviced HomeStay', '89/14 Hàm Nghi 7, Quận 1, 71009 TP Hồ Chí Minh, Việt Nam', NULL, 0, '0312412312', '0315872565', '031412341', 'Tran Thanh Minh', 'MB Bank', '/uploads/images/bg-admin.jpg', '/uploads/images/bg-admin.jpg,/uploads/images/IMG_7245.JPG,/uploads/images/IMG_7252.JPG', 4, 70, '2025-06-05 07:00:26', '2025-06-05 07:32:05'),
(2, 'Tam Coc Windy Fields 1', 'Thônn Đam Khê Trong, xã Ninh Hải, huyện Hoa Lư, Ninh Bình, Việt Nam', '<p>Với Ch&ugrave;a B&aacute;i Đ&iacute;nh nằm c&aacute;ch đ&oacute; 26 km, Tam Coc Windy Fields cung cấp chỗ nghỉ, nh&agrave; h&agrave;ng, xe đạp miễn ph&iacute;, hồ bơi ngo&agrave;i trời v&agrave; khu vườn. WiFi miễn ph&iacute; c&oacute; sẵn ở to&agrave;n bộ chỗ nghỉ. Nơi đ&acirc;y c&ograve;n c&oacute; ph&ograve;ng tắm ri&ecirc;ng với v&ograve;i xịt/chậu rửa vệ sinh ở tất cả c&aacute;c căn, c&ugrave;ng đồ vệ sinh c&aacute; nh&acirc;n miễn ph&iacute;, m&aacute;y sấy t&oacute;c v&agrave; dép đi trong phòng. Chỗ nghỉ c&oacute; c&aacute;c lựa chọn thực đơn buffet, thực đơn &agrave; la carte hoặc kiểu lục địa cho bữa s&aacute;ng. Lodge c&oacute; s&acirc;n hi&ecirc;n. Kh&aacute;ch nghỉ tại Tam Coc Windy Fields c&oacute; thể chơi bi-a trong khu&ocirc;n vi&ecirc;n, hoặc đi xe đạp ở khu vực xung quanh. Chỗ nghỉ c&aacute;ch Nh&agrave; thờ đ&aacute; Ph&aacute;t Diệm 33 km. S&acirc;n bay Thọ Xu&acirc;n c&aacute;ch 94 km, đồng thời chỗ nghỉ c&oacute; cung cấp dịch vụ đưa đ&oacute;n s&acirc;n bay mất ph&iacute;.</p>', 3, '0306221140', '2147483647314', '021020004', 'Tam Coc', 'MB', '/uploads/files/demo/689128499.jpg', '/uploads/files/demo/689072330.jpg,/uploads/files/demo/689124941.jpg,/uploads/files/demo/689128495.jpg,/uploads/files/demo/689128499.jpg,/uploads/files/demo/689128496.jpg', 2, 70, NULL, '2025-07-14 01:28:34'),
(4, 'HOLO HAM NGHI SAIGON - Serviced HomeStay', '89/14 Hàm Nghi 7, Quận 1, 71009 TP. Hồ Chí Minh, Việt Nam', '<p>Với Ch&ugrave;a B&aacute;i Đ&iacute;nh nằm c&aacute;ch đ&oacute; 26 km, Tam Coc Windy Fields cung cấp chỗ nghỉ, nh&agrave; h&agrave;ng, xe đạp miễn ph&iacute;, hồ bơi ngo&agrave;i trời v&agrave; khu vườn. WiFi miễn ph&iacute; c&oacute; sẵn ở to&agrave;n bộ chỗ nghỉ. Nơi đ&acirc;y c&ograve;n c&oacute; ph&ograve;ng tắm ri&ecirc;ng với v&ograve;i xịt/chậu rửa vệ sinh ở tất cả c&aacute;c căn, c&ugrave;ng đồ vệ sinh c&aacute; nh&acirc;n miễn ph&iacute;, m&aacute;y sấy t&oacute;c v&agrave; dép đi trong phòng. Chỗ nghỉ c&oacute; c&aacute;c lựa chọn thực đơn buffet, thực đơn &agrave; la carte hoặc kiểu lục địa cho bữa s&aacute;ng. Lodge c&oacute; s&acirc;n hi&ecirc;n. Kh&aacute;ch nghỉ tại Tam Coc Windy Fields c&oacute; thể chơi bi-a trong khu&ocirc;n vi&ecirc;n, hoặc đi xe đạp ở khu vực xung quanh. Chỗ nghỉ c&aacute;ch Nh&agrave; thờ đ&aacute; Ph&aacute;t Diệm 33 km. S&acirc;n bay Thọ Xu&acirc;n c&aacute;ch 94 km, đồng thời chỗ nghỉ c&oacute; cung cấp dịch vụ đưa đ&oacute;n s&acirc;n bay mất ph&iacute;.</p>', 2, '0312412312', '031241234121', '031412341', 'Tran Thanh Minh', 'MB Bank', '/uploads/images/bg-admin.jpg', '/uploads/images/bg-admin.jpg,/uploads/images/IMG_7245.JPG,/uploads/images/IMG_7252.JPG', 2, 70, '2025-06-03 08:37:03', '2025-06-03 15:53:24'),
(101, 'Sunlight Hotel', 'Thônn Đam Khê Trong, xã Ninh Hải, huyện Hoa Lư, Ninh Bình, Việt Nam', '<p>Kh&aacute;ch sạn với vị tr&iacute; tuyệt vời&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 3, '0901234567', '1234567890', '011234567890', 'Nguyễn Văn A', 'MB Bank', '/uploads/files/t%E1%BA%A3i%20xu%E1%BB%91ng.jpg', '/uploads/files/52598929917_ba336cfdf8_b.jpg,/uploads/files/HD-wallpaper-spiderman-amazing-spider-man.jpg,/uploads/files/IMG_7243.JPG,/uploads/files/IMG_7245.JPG,/uploads/files/IMG_7244.JPG,/uploads/files/t%E1%BA%A3i%20xu%E1%BB%91ng.jpg', 2, 80, '2025-07-10 05:51:27', '2025-07-10 07:53:49'),
(102, 'Blue Sky Hotel', 'Thônn Đam Khê Trong, xã Ninh Hải, huyện Hoa Lư, TP Hồ Chí Minh, Việt Nam', '<p>Kh&aacute;ch sạn tuyệt vời</p>\r\n\r\n<p>&nbsp;</p>', 4, '0902234567', '1234567891', '011234567891', 'Trần Thị B', 'Vietcombank', '/uploads/files/default-image2.png', '/uploads/files/52598929917_ba336cfdf8_b.jpg,/uploads/files/t%E1%BA%A3i%20xu%E1%BB%91ng.jpg,/uploads/files/HD-wallpaper-spiderman-amazing-spider-man.jpg', 2, 75, '2025-07-10 05:51:27', '2025-07-10 08:18:04'),
(103, 'Green Leaf Hotel', '35 Nguyễn Trãi, TP Hồ Chí Minh', 'ph&iacute;.</p>', 2, '0903234567', '1234567892', '011234567892', 'Lê Văn C', 'TP Bank', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 2, 85, '2025-07-10 05:51:27', '2025-07-10 05:51:27'),
(104, 'Ocean Pearl Hotel', '58 Trần Hưng Đạo, TP Hồ Chí Minh', 'ph&iacute;.</p>', 5, '0904234567', '1234567893', '011234567893', 'Phạm Thị D', 'MB Bank', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 2, 90, '2025-07-10 05:51:27', '2025-07-10 05:51:27'),
(105, 'Riverside Palace Hotel', '44 Hàm Nghi, TP Hồ Chí Minh', 'ph&iacute;.</p>', 3, '0905234567', '1234567894', '011234567894', 'Đỗ Quốc E', 'BIDV', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 2, 70, '2025-07-10 05:51:27', '2025-07-10 05:51:27'),
(106, 'Central Inn Hotel', '18 Võ Văn Tần, TP Hồ Chí Minh', 'ph&iacute;.</p>', 4, '0906234567', '1234567895', '011234567895', 'Hoàng Gia F', 'MB Bank', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 2, 78, '2025-07-10 05:51:27', '2025-07-12 03:43:56'),
(107, 'Sky Tower Hotel', '10 Nguyễn Thị Minh Khai, TP Hồ Chí Minh', 'ph&iacute;.</p>', 3, '0907234567', '1234567896', '011234567896', 'Trịnh Văn G', 'TP Bank', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 2, 76, '2025-07-10 05:51:27', '2025-07-12 03:44:15'),
(109, 'Ruby Hotel', '99 Cách Mạng Tháng 8, TP Hồ Chí Minh', 'ph&iacute;.</p>', 3, '0909234567', '1234567898', '011234567898', 'Vũ Hoàng I', 'BIDV', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 2, 88, '2025-07-10 05:51:27', '2025-07-17 05:45:08'),
(111, 'Green Valley Hotel', '12 Trần Phú, Đà Lạt', 'ph&iacute;.</p>', 3, '0911234567', '2345678900', '011234567800', 'Đặng Minh L', 'Vietcombank', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 1, 79, '2025-07-10 05:51:27', '2025-07-10 05:51:27'),
(112, 'Sunrise Bay Hotel', '98 Hùng Vương, Nha Trang', 'ph&iacute;.</p>', 4, '0912234567', '2345678901', '011234567801', 'Lương Thế M', 'TP Bank', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 2, 84, '2025-07-10 05:51:27', '2025-07-12 03:41:04'),
(113, 'Golden Sea Hotel', '102 Nguyễn Văn Linh, Đà Nẵng', 'ph&iacute;.</p>', 5, '0913234567', '2345678902', '011234567802', 'Mai Thị N', 'MB Bank', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 1, 87, '2025-07-10 05:51:27', '2025-07-10 05:51:27'),
(114, 'Palm Garden Hotel', '45 Bạch Đằng, Hội An', 'ph&iacute;.</p>', 3, '0914234567', '2345678903', '011234567803', 'Hồ Văn O', 'BIDV', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 1, 77, '2025-07-10 05:51:27', '2025-07-10 05:51:27'),
(115, 'Peaceful House Hotel', '36 Trần Phú, Hà Nội', 'ph&iacute;.</p>', 4, '0915234567', '2345678904', '011234567804', 'Tạ Thu P', 'Vietcombank', '/assets/images/avatar-user.png', '/uploads/images/default.jpg,/uploads/images/second.jpg', 2, 91, '2025-07-10 05:51:27', '2025-07-12 03:42:10'),
(120, 'Khách sạn ABC', '89/14 Hàm Nghi 7, Quận 1, 71009 TP. Hồ Chí Minh, Việt Nam', NULL, 3, '0889702104', '3000333212', '04412412514', 'Tran Thanh Minh', 'MB Bank', '/assets/images/1752131467_IMG_7252.JPG', NULL, 2, 70, '2025-07-10 07:11:07', '2025-07-12 03:41:37'),
(136, 'Tam Cốc Garden Resort', 'Xã Ninh Hải, Hoa Lư, Ninh Bình', '<p>Khu nghỉ dưỡng cao cấp giữa thi&ecirc;n nhi&ecirc;n</p>', 5, '0912345678', '09812345678', '123456789012', 'Nguyễn Văn A', 'Vietcombank', '/uploads/files/demo/158751970.jpg', '/uploads/files/demo/224492616.jpg,/uploads/files/demo/689124941.jpg,/uploads/files/demo/689072330.jpg,/uploads/files/demo/590546103.jpg', 2, 5, '2025-07-17 17:50:41', '2025-07-17 19:05:23'),
(137, 'Ninh Bình Legend Hotel', 'Trần Hưng Đạo, Ninh Bình', '<p>Kh&aacute;ch sạn 4 sao trung t&acirc;m th&agrave;nh phố</p>', 4, '0987654321', '09122334455', '123456789013', 'Trần Thị B', 'ACB', '/uploads/files/demo/590545684.jpg', '/uploads/files/demo/689128499.jpg,/uploads/files/demo/689128496.jpg,/uploads/files/demo/689128495.jpg', 2, 4, '2025-07-17 17:50:41', '2025-07-17 19:06:40'),
(138, 'Emeralda Resort Ninh Bình', 'Khu bảo tồn Vân Long, Gia Vân', '<p>Resort sinh th&aacute;i sang trọng</p>', 5, '0933888777', '09311223344', '123456789014', 'Lê Văn C', 'Techcombank', '/uploads/files/demo/689124941.jpg', '/uploads/files/demo/689072330.jpg,/uploads/files/demo/224492616.jpg,/uploads/files/demo/689124941.jpg,/uploads/files/demo/689128495.jpg,/uploads/files/demo/590546103.jpg', 2, 5, '2025-07-17 17:50:41', '2025-07-17 19:29:44'),
(139, 'Trang An Retreat', 'Tràng An, Hoa Lư, Ninh Bình', '<p>Kh&ocirc;ng gian nghỉ dưỡng y&ecirc;n tĩnh</p>', 3, '0977123456', '09566778899', '123456789015', 'Phạm Thị D', 'MB Bank', '/uploads/files/demo/689072330.jpg', '/uploads/files/demo/590545684.jpg,/uploads/files/demo/689072330.jpg,/uploads/files/demo/158751970.jpg,/uploads/files/demo/590546103.jpg,/uploads/files/demo/224492616.jpg,/uploads/files/demo/689124941.jpg,/uploads/files/demo/689128496.jpg', 2, 3, '2025-07-17 17:50:41', '2025-07-17 19:07:50'),
(140, 'Tam Cốc Windy Fields', 'Thôn Đam Khê Trong, Ninh Hải', 'Homestay giữa cánh đồng lúa', 3, '0966223344', '09099887766', '123456789016', 'Đỗ Quốc E', 'VietinBank', '/uploads/files/demo/5.jpg', '[]', 2, 4, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(141, 'Chez Loan Homestay', 'Văn Lâm, Ninh Hải', 'Không gian gia đình ấm cúng', 2, '0922113344', '09655667788', '123456789017', 'Hoàng Gia F', 'BIDV', '/uploads/files/demo/6.jpg', '[]', 2, 3, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(142, 'Tam Coc Rice Fields Resort', 'Kênh Gà, Gia Thịnh, Ninh Bình', 'Ẩn mình giữa thiên nhiên', 4, '0911223344', '09441122334', '123456789018', 'Trịnh Văn G', 'Agribank', '/uploads/files/demo/7.jpg', '[]', 2, 4, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(143, 'Tam Coc Banana Bungalow', 'Tam Cốc, Ninh Hải', 'Phòng bungalow riêng tư', 3, '0944332211', '09110022335', '123456789019', 'Ngô Thị H', 'Sacombank', '/uploads/files/demo/8.jpg', '[]', 2, 4, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(144, 'Ninh Binh Valley Homestay', 'Khê Thượng, Ninh Xuân', 'Homestay ẩn mình trong thung lũng', 2, '0933112244', '09090011223', '123456789020', 'Vũ Hoàng I', 'VPBank', '/uploads/files/demo/9.jpg', '[]', 2, 3, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(145, 'Tam Cốc Friendly Homestay', 'Ninh Hải, Hoa Lư', 'Thân thiện, gần gũi, tiện nghi', 3, '0966335544', '09223344556', '123456789021', 'Đặng Minh K', 'SHB', '/uploads/files/demo/10.jpg', '[]', 2, 4, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(146, 'The Myst Đồng Khởi', '6-8 Hồ Huấn Nghiệp, Quận 1, TP Hồ Chí Minh', 'Khách sạn sang trọng trung tâm Sài Gòn', 5, '0911002233', '09332211009', '123456789022', 'Tạ Thu L', 'Vietcombank', '/uploads/files/demo/11.jpg', '[]', 2, 5, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(147, 'Hotel Nikko Saigon', '235 Nguyễn Văn Cừ, Quận 1, TP Hồ Chí Minh', 'Khách sạn chuẩn Nhật Bản', 5, '0922003344', '09551100987', '123456789023', 'Lương Thế M', 'Techcombank', '/uploads/files/demo/12.jpg', '[]', 2, 5, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(148, 'Liberty Central Citypoint', '59-61 Pasteur, Quận 1, TP Hồ Chí Minh', 'Khách sạn hiện đại, tiện nghi', 4, '0933004455', '09660077889', '123456789024', 'Mai Thị N', 'ACB', '/uploads/files/demo/13.jpg', '[]', 2, 4, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(149, 'Fusion Suites Saigon', '3-5 Sương Nguyệt Ánh, Quận 1, TP Hồ Chí Minh', 'Thiết kế trẻ trung, đầy cảm hứng', 4, '0944005566', '09001122334', '123456789025', 'Hồ Văn O', 'MB Bank', '/uploads/files/demo/14.jpg', '[]', 2, 4, '2025-07-17 17:50:41', '2025-07-17 17:50:41'),
(150, 'Riverside Hotel Saigon', '18 Tôn Đức Thắng, Quận 1, TP Hồ Chí Minh', 'View sông Sài Gòn tuyệt đẹp', 3, '0955006677', '09888776655', '123456789026', 'Tạ Quỳnh P', 'Agribank', '/uploads/files/demo/15.jpg', '[]', 2, 3, '2025-07-17 17:50:41', '2025-07-17 17:50:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotel_amenities`
--

CREATE TABLE `hotel_amenities` (
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `amenity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hotel_amenities`
--

INSERT INTO `hotel_amenities` (`hotel_id`, `amenity_id`, `created_at`, `updated_at`) VALUES
(136, 52, NULL, NULL),
(136, 58, NULL, NULL),
(136, 59, NULL, NULL),
(136, 63, NULL, NULL),
(136, 66, NULL, NULL),
(136, 67, NULL, NULL),
(136, 68, NULL, NULL),
(136, 75, NULL, NULL),
(136, 76, NULL, NULL),
(136, 77, NULL, NULL),
(137, 50, NULL, NULL),
(137, 60, NULL, NULL),
(137, 63, NULL, NULL),
(137, 71, NULL, NULL),
(137, 72, NULL, NULL),
(137, 75, NULL, NULL),
(137, 77, NULL, NULL),
(138, 52, NULL, NULL),
(138, 57, NULL, NULL),
(138, 59, NULL, NULL),
(138, 60, NULL, NULL),
(138, 63, NULL, NULL),
(138, 65, NULL, NULL),
(138, 68, NULL, NULL),
(138, 70, NULL, NULL),
(138, 76, NULL, NULL),
(139, 51, NULL, NULL),
(139, 52, NULL, NULL),
(139, 54, NULL, NULL),
(139, 55, NULL, NULL),
(139, 57, NULL, NULL),
(139, 61, NULL, NULL),
(139, 70, NULL, NULL),
(139, 74, NULL, NULL),
(139, 75, NULL, NULL),
(139, 77, NULL, NULL),
(140, 51, NULL, NULL),
(140, 55, NULL, NULL),
(140, 58, NULL, NULL),
(140, 61, NULL, NULL),
(140, 70, NULL, NULL),
(140, 71, NULL, NULL),
(140, 73, NULL, NULL),
(140, 78, NULL, NULL),
(140, 79, NULL, NULL),
(141, 50, NULL, NULL),
(141, 53, NULL, NULL),
(141, 58, NULL, NULL),
(141, 64, NULL, NULL),
(141, 66, NULL, NULL),
(141, 73, NULL, NULL),
(141, 77, NULL, NULL),
(141, 78, NULL, NULL),
(141, 79, NULL, NULL),
(142, 55, NULL, NULL),
(142, 58, NULL, NULL),
(142, 59, NULL, NULL),
(142, 60, NULL, NULL),
(142, 67, NULL, NULL),
(142, 75, NULL, NULL),
(143, 50, NULL, NULL),
(143, 52, NULL, NULL),
(143, 56, NULL, NULL),
(143, 58, NULL, NULL),
(143, 73, NULL, NULL),
(143, 76, NULL, NULL),
(143, 78, NULL, NULL),
(143, 79, NULL, NULL),
(144, 52, NULL, NULL),
(144, 53, NULL, NULL),
(144, 59, NULL, NULL),
(144, 60, NULL, NULL),
(144, 68, NULL, NULL),
(144, 71, NULL, NULL),
(144, 76, NULL, NULL),
(144, 79, NULL, NULL),
(145, 56, NULL, NULL),
(145, 57, NULL, NULL),
(145, 64, NULL, NULL),
(145, 65, NULL, NULL),
(145, 67, NULL, NULL),
(145, 71, NULL, NULL),
(146, 55, NULL, NULL),
(146, 56, NULL, NULL),
(146, 57, NULL, NULL),
(146, 58, NULL, NULL),
(146, 69, NULL, NULL),
(146, 72, NULL, NULL),
(146, 74, NULL, NULL),
(146, 77, NULL, NULL),
(147, 50, NULL, NULL),
(147, 52, NULL, NULL),
(147, 55, NULL, NULL),
(147, 56, NULL, NULL),
(147, 60, NULL, NULL),
(147, 63, NULL, NULL),
(147, 67, NULL, NULL),
(147, 69, NULL, NULL),
(147, 70, NULL, NULL),
(147, 73, NULL, NULL),
(148, 51, NULL, NULL),
(148, 54, NULL, NULL),
(148, 62, NULL, NULL),
(148, 63, NULL, NULL),
(148, 64, NULL, NULL),
(148, 67, NULL, NULL),
(148, 75, NULL, NULL),
(148, 76, NULL, NULL),
(149, 54, NULL, NULL),
(149, 55, NULL, NULL),
(149, 56, NULL, NULL),
(149, 58, NULL, NULL),
(149, 67, NULL, NULL),
(149, 69, NULL, NULL),
(149, 70, NULL, NULL),
(149, 74, NULL, NULL),
(150, 60, NULL, NULL),
(150, 72, NULL, NULL),
(150, 74, NULL, NULL),
(150, 77, NULL, NULL),
(150, 78, NULL, NULL),
(150, 79, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotel_rules`
--

CREATE TABLE `hotel_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `check_in_time` time NOT NULL,
  `check_out_time` time NOT NULL,
  `pet_policy` tinyint(1) DEFAULT 0,
  `child_policy` tinyint(1) DEFAULT 0,
  `extra_bed_fee` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hotel_rules`
--

INSERT INTO `hotel_rules` (`id`, `check_in_time`, `check_out_time`, `pet_policy`, `child_policy`, `extra_bed_fee`, `created_at`, `updated_at`) VALUES
(2, '19:25:00', '16:25:00', 1, 0, 100000, '2025-06-13 09:25:55', '2025-07-04 03:31:46'),
(101, '14:51:00', '02:51:00', 1, 1, -1, '2025-07-10 07:51:53', '2025-07-10 07:51:53'),
(102, '15:16:00', '03:16:00', 1, 1, 100000, '2025-07-10 08:16:56', '2025-07-10 08:16:56'),
(107, '11:53:00', '23:53:00', 0, 1, -1, '2025-07-12 04:53:28', '2025-07-12 04:53:28'),
(136, '14:00:00', '12:00:00', 1, 1, 100000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(137, '15:00:00', '11:00:00', 1, 1, 120000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(138, '14:30:00', '12:00:00', 0, 1, -1, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(139, '13:00:00', '11:30:00', 1, 0, 80000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(140, '14:00:00', '12:00:00', 1, 1, 100000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(141, '15:00:00', '12:00:00', 0, 1, -1, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(142, '14:00:00', '11:00:00', 1, 1, 100000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(143, '13:30:00', '10:30:00', 1, 1, 90000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(144, '14:00:00', '12:00:00', 1, 1, 100000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(145, '15:30:00', '11:30:00', 0, 1, -1, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(146, '14:00:00', '12:00:00', 1, 1, 100000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(147, '14:30:00', '11:30:00', 1, 0, 110000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(148, '15:00:00', '12:00:00', 1, 1, 100000, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(149, '14:00:00', '11:00:00', 0, 1, -1, '2025-07-17 18:58:46', '2025-07-17 18:58:46'),
(150, '14:00:00', '12:00:00', 1, 1, 100000, '2025-07-17 18:58:46', '2025-07-17 18:58:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotel_services`
--

CREATE TABLE `hotel_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `short_description` longtext DEFAULT NULL,
  `base_price` int(11) NOT NULL DEFAULT 0,
  `promo_price` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hotel_services`
--

INSERT INTO `hotel_services` (`id`, `hotel_id`, `service_id`, `short_description`, `base_price`, `promo_price`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 2, NULL, 1000000, 500000, 1, '2025-06-19 06:18:42', '2025-06-19 06:18:42'),
(4, 2, 1, NULL, 1500000, NULL, 1, '2025-06-19 08:14:06', '2025-06-19 08:14:06'),
(8, 136, 10, 'Dịch vụ chất lượng cao', 100000, 70000, 1, NULL, NULL),
(9, 136, 21, 'Dịch vụ chất lượng cao', 250000, 200000, 1, NULL, NULL),
(10, 136, 1, 'Được ưa chuộng bởi du khách', 100000, 75000, 1, NULL, NULL),
(11, 136, 16, 'Phục vụ nhanh chóng', 300000, 255000, 1, NULL, NULL),
(12, 136, 8, 'Được ưa chuộng bởi du khách', 100000, 80000, 1, NULL, NULL),
(13, 137, 15, 'Phục vụ nhanh chóng', 200000, 140000, 1, NULL, NULL),
(14, 137, 10, 'Phục vụ tận tình chu đáo', 300000, 225000, 1, NULL, NULL),
(15, 137, 9, 'Phục vụ nhanh chóng', 100000, 70000, 1, NULL, NULL),
(16, 137, 17, 'Hài lòng khách hàng', 250000, 175000, 1, NULL, NULL),
(17, 137, 13, 'Phục vụ tận tình chu đáo', 200000, 160000, 1, NULL, NULL),
(18, 138, 20, 'Hài lòng khách hàng', 300000, 240000, 1, NULL, NULL),
(19, 138, 15, 'Được ưa chuộng bởi du khách', 300000, 270000, 1, NULL, NULL),
(20, 138, 17, 'Giá ưu đãi hấp dẫn', 300000, 255000, 1, NULL, NULL),
(21, 138, 12, 'Tiện lợi và chuyên nghiệp', 300000, 240000, 1, NULL, NULL),
(22, 138, 8, 'Phục vụ tận tình chu đáo', 250000, 200000, 1, NULL, NULL),
(23, 139, 14, 'Tiết kiệm thời gian cho khách', 250000, 175000, 1, NULL, NULL),
(24, 139, 1, 'Tiết kiệm thời gian cho khách', 200000, 150000, 1, NULL, NULL),
(25, 139, 12, 'Phục vụ tận tình chu đáo', 100000, 70000, 1, NULL, NULL),
(26, 139, 16, 'Phục vụ tận tình chu đáo', 250000, 225000, 1, NULL, NULL),
(27, 139, 10, 'Hài lòng khách hàng', 100000, 90000, 1, NULL, NULL),
(28, 140, 8, 'Tiết kiệm thời gian cho khách', 150000, 105000, 1, NULL, NULL),
(29, 140, 4, 'Dịch vụ chất lượng cao', 100000, 70000, 1, NULL, NULL),
(30, 140, 6, 'Hài lòng khách hàng', 250000, 175000, 1, NULL, NULL),
(31, 140, 1, 'Tiết kiệm thời gian cho khách', 100000, 80000, 1, NULL, NULL),
(32, 140, 13, 'Được ưa chuộng bởi du khách', 300000, 255000, 1, NULL, NULL),
(33, 141, 21, 'Tiết kiệm thời gian cho khách', 70000, 60000, 1, NULL, NULL),
(34, 141, 16, 'Giá ưu đãi hấp dẫn', 300000, 210000, 1, NULL, NULL),
(35, 141, 10, 'Tiện lợi và chuyên nghiệp', 150000, 110000, 1, NULL, NULL),
(36, 141, 22, 'Hài lòng khách hàng', 150000, 120000, 1, NULL, NULL),
(37, 141, 3, 'Phục vụ tận tình chu đáo', 100000, 80000, 1, NULL, NULL),
(38, 142, 9, 'Phục vụ nhanh chóng', 70000, 55000, 1, NULL, NULL),
(39, 142, 6, 'Tiết kiệm thời gian cho khách', 300000, 225000, 1, NULL, NULL),
(40, 142, 18, 'Phục vụ tận tình chu đáo', 100000, 80000, 1, NULL, NULL),
(41, 142, 3, 'Phục vụ nhanh chóng', 150000, 120000, 1, NULL, NULL),
(42, 142, 7, 'Phục vụ tận tình chu đáo', 70000, 55000, 1, NULL, NULL),
(43, 143, 4, 'Dịch vụ chất lượng cao', 100000, 75000, 1, NULL, NULL),
(44, 143, 14, 'Hài lòng khách hàng', 300000, 225000, 1, NULL, NULL),
(45, 143, 20, 'Tiện lợi và chuyên nghiệp', 70000, 55000, 1, NULL, NULL),
(46, 143, 2, 'Giá ưu đãi hấp dẫn', 100000, 75000, 1, NULL, NULL),
(47, 143, 16, 'Phục vụ tận tình chu đáo', 150000, 110000, 1, NULL, NULL),
(48, 144, 19, 'Giá ưu đãi hấp dẫn', 250000, 185000, 1, NULL, NULL),
(49, 144, 16, 'Được ưa chuộng bởi du khách', 250000, 200000, 1, NULL, NULL),
(50, 144, 8, 'Được ưa chuộng bởi du khách', 300000, 270000, 1, NULL, NULL),
(51, 144, 7, 'Hài lòng khách hàng', 70000, 45000, 1, NULL, NULL),
(52, 144, 18, 'Hài lòng khách hàng', 150000, 135000, 1, NULL, NULL),
(53, 145, 22, 'Dịch vụ chất lượng cao', 200000, 180000, 1, NULL, NULL),
(54, 145, 4, 'Hài lòng khách hàng', 200000, 160000, 1, NULL, NULL),
(55, 145, 11, 'Dịch vụ chất lượng cao', 150000, 135000, 1, NULL, NULL),
(56, 145, 15, 'Tiện lợi và chuyên nghiệp', 200000, 170000, 1, NULL, NULL),
(57, 145, 19, 'Phục vụ tận tình chu đáo', 100000, 75000, 1, NULL, NULL),
(58, 146, 2, 'Phục vụ tận tình chu đáo', 150000, 125000, 1, NULL, NULL),
(59, 146, 20, 'Được ưa chuộng bởi du khách', 150000, 110000, 1, NULL, NULL),
(60, 146, 15, 'Được ưa chuộng bởi du khách', 200000, 180000, 1, NULL, NULL),
(61, 146, 4, 'Tiết kiệm thời gian cho khách', 70000, 45000, 1, NULL, NULL),
(62, 146, 17, 'Phục vụ tận tình chu đáo', 150000, 105000, 1, NULL, NULL),
(63, 147, 19, 'Tiện lợi và chuyên nghiệp', 100000, 70000, 1, NULL, NULL),
(64, 147, 12, 'Tiện lợi và chuyên nghiệp', 300000, 225000, 1, NULL, NULL),
(65, 147, 18, 'Được ưa chuộng bởi du khách', 200000, 140000, 1, NULL, NULL),
(66, 147, 13, 'Giá ưu đãi hấp dẫn', 70000, 55000, 1, NULL, NULL),
(67, 147, 6, 'Giá ưu đãi hấp dẫn', 100000, 80000, 1, NULL, NULL),
(68, 148, 18, 'Hài lòng khách hàng', 200000, 160000, 1, NULL, NULL),
(69, 148, 3, 'Tiết kiệm thời gian cho khách', 300000, 270000, 1, NULL, NULL),
(70, 148, 8, 'Tiết kiệm thời gian cho khách', 300000, 225000, 1, NULL, NULL),
(71, 148, 16, 'Dịch vụ chất lượng cao', 100000, 70000, 1, NULL, NULL),
(72, 148, 17, 'Hài lòng khách hàng', 150000, 135000, 1, NULL, NULL),
(73, 149, 15, 'Được ưa chuộng bởi du khách', 100000, 90000, 1, NULL, NULL),
(74, 149, 10, 'Phục vụ nhanh chóng', 70000, 55000, 1, NULL, NULL),
(75, 149, 21, 'Dịch vụ chất lượng cao', 250000, 185000, 1, NULL, NULL),
(76, 149, 1, 'Tiết kiệm thời gian cho khách', 70000, 45000, 1, NULL, NULL),
(77, 149, 5, 'Giá ưu đãi hấp dẫn', 250000, 200000, 1, NULL, NULL),
(78, 150, 5, 'Phục vụ nhanh chóng', 300000, 270000, 1, NULL, NULL),
(79, 150, 4, 'Phục vụ nhanh chóng', 100000, 80000, 1, NULL, NULL),
(80, 150, 20, 'Dịch vụ chất lượng cao', 200000, 170000, 1, NULL, NULL),
(81, 150, 12, 'Tiện lợi và chuyên nghiệp', 250000, 185000, 1, NULL, NULL),
(82, 150, 16, 'Được ưa chuộng bởi du khách', 150000, 125000, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `sent_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `message`, `is_read`, `sent_at`, `created_at`, `updated_at`) VALUES
(38, 14, 115, 'Hi', 0, '2025-07-17 09:27:09', '2025-07-17 02:27:09', '2025-07-17 02:27:09'),
(39, 14, 2, 'Hi', 0, '2025-07-17 09:27:20', '2025-07-17 02:27:20', '2025-07-17 02:27:20'),
(40, 14, 115, 'sao bạn', 0, '2025-07-17 09:27:27', '2025-07-17 02:27:27', '2025-07-17 02:27:27'),
(41, 15, 135, 'Mình cần giúp đỡ', 0, '2025-07-17 12:36:05', '2025-07-17 05:36:05', '2025-07-17 05:36:05'),
(42, 15, 2, 'Chào bạn', 0, '2025-07-17 12:36:19', '2025-07-17 05:36:19', '2025-07-17 05:36:19'),
(43, 15, 135, 'chào bạn', 0, '2025-07-18 08:24:29', '2025-07-18 01:24:29', '2025-07-18 01:24:29'),
(44, 15, 2, 'Khách sạn Tam Cốc chào', 0, '2025-07-18 08:24:50', '2025-07-18 01:24:50', '2025-07-18 01:24:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(79, '2014_10_12_000000_create_users_table', 1),
(80, '2014_10_12_100000_create_password_resets_table', 1),
(81, '2019_08_19_000000_create_failed_jobs_table', 1),
(82, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(83, '2025_05_18_044510_create_hotels_table', 1),
(84, '2025_05_18_044512_create_amenities_table', 1),
(85, '2025_05_18_044514_create_hotel_amenities_table', 1),
(87, '2025_05_18_044520_create_bed_types_table', 1),
(89, '2025_05_18_044524_create_attributes_table', 1),
(91, '2025_05_18_044530_create_variant_attributes_table', 1),
(92, '2025_05_18_044532_create_seasons_table', 1),
(93, '2025_05_18_044538_create_room_type_season_prices_table', 1),
(94, '2025_05_18_044540_create_services_table', 1),
(96, '2025_05_18_044546_create_combos_table', 1),
(101, '2025_05_18_044564_create_booking_services_table', 1),
(102, '2025_05_18_044566_create_booking_combos_table', 1),
(104, '2025_05_18_050523_create_notifications_table', 1),
(106, '2025_05_18_155046_create_complaints_table', 1),
(110, '2025_05_18_155655_create_conversations_table', 1),
(111, '2025_05_18_155827_create_messages_table', 1),
(112, '2025_05_18_155920_create_reputation_log_table', 1),
(113, '2025_05_18_160040_create_hotel_rules_table', 1),
(114, '2025_05_18_160743_create_room_type_amenities_table', 1),
(115, '2025_05_18_162709_create_notification_user_table', 1),
(117, '2025_05_18_162824_create_favorites_table', 1),
(118, '2025_06_10_133537_create_commission_rules_table', 2),
(119, '2025_05_18_044554_create_vouchers_table', 3),
(120, '2025_05_18_162750_create_voucher_user_table', 4),
(121, '2025_06_11_163517_create_voucher_hotels_table', 5),
(122, '2025_05_18_044542_create_hotel_services_table', 6),
(123, '2025_05_18_044550_create_combo_services_table', 7),
(124, '2025_05_18_044521_create_room_types_table', 8),
(125, '2025_05_18_044526_create_room_type_variants_table', 9),
(127, '2025_05_18_044562_create_booking_details_table', 11),
(130, '2025_05_18_154029_create_rooms_table', 14),
(131, '2025_05_18_044560_create_bookings_table', 15),
(133, '2025_05_18_044570_create_transactions_table', 16),
(134, '2025_05_18_155210_create_reviews_table', 17),
(135, '2025_07_14_011803_create_jobs_table', 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `content`, `sent_at`, `created_at`, `updated_at`) VALUES
(23, 'Thông báo test', NULL, '2025-06-09 00:00:00', '2025-06-09 16:22:08', '2025-06-09 16:22:08'),
(25, 'Thông báo lần 1', NULL, '2025-06-09 00:00:00', '2025-06-09 16:41:59', '2025-06-09 16:41:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notification_user`
--

CREATE TABLE `notification_user` (
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notification_user`
--

INSERT INTO `notification_user` (`notification_id`, `user_id`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(25, 4, 0, NULL, '2025-06-09 16:41:59', '2025-06-09 16:41:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text DEFAULT NULL,
  `star` tinyint(3) UNSIGNED NOT NULL COMMENT 'Số sao đánh giá từ 1 đến 5',
  `hotel_reply` text DEFAULT NULL,
  `hotel_replied_at` datetime DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `hotel_id`, `booking_id`, `user_id`, `content`, `star`, `hotel_reply`, `hotel_replied_at`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(4, 2, 92, 135, 'Khách sạn tuyệt vời !', 4, NULL, NULL, NULL, '2025-07-18 01:25:50', '2025-07-18 01:25:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `code` char(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `room_type_id`, `hotel_id`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 'Delexu 1', 1, NULL, NULL),
(2, 5, 2, 'Deluxu 1', 1, '2025-06-25 15:06:59', '2025-06-25 15:20:58'),
(3, 4, 2, 'Delexu 2', 1, '2025-06-26 05:00:43', '2025-06-26 05:00:45'),
(4, 5, 2, 'Delexu 3', 1, NULL, NULL),
(401, 201, 101, 'RM-201-1', 1, '2025-07-10 06:07:49', '2025-07-10 06:07:49'),
(402, 201, 101, 'RM-201-2', 1, '2025-07-10 06:07:49', '2025-07-10 06:07:49'),
(403, 202, 101, 'RM-202-1', 1, '2025-07-10 06:07:49', '2025-07-10 06:07:49'),
(404, 202, 101, 'RM-202-2', 1, '2025-07-10 06:07:49', '2025-07-10 06:07:49'),
(405, 203, 102, 'RM-203-1', 1, '2025-07-10 06:07:49', '2025-07-10 06:07:49'),
(406, 203, 102, 'RM-203-2', 1, '2025-07-10 06:07:49', '2025-07-10 06:07:49'),
(407, 5, 2, 'Deluxe 1', 1, '2025-07-10 07:31:00', '2025-07-10 07:31:00'),
(408, 204, 102, 'DELUXE-102-2 1', 1, '2025-07-10 08:19:51', '2025-07-10 08:19:51'),
(416, 236, 2, 'Deluxe 1', 1, '2025-07-17 05:29:59', '2025-07-17 05:29:59'),
(417, 236, 2, 'Deluxe 2', 1, '2025-07-17 05:29:59', '2025-07-17 05:29:59'),
(418, 237, 136, 'DELUXE-136-1-1', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(419, 237, 136, 'DELUXE-136-1-2', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(420, 237, 136, 'DELUXE-136-1-3', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(421, 238, 136, 'DELUXE-136-2-1', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(422, 238, 136, 'DELUXE-136-2-2', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(423, 239, 137, 'DELUXE-137-1-1', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(424, 239, 137, 'DELUXE-137-1-2', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(425, 239, 137, 'DELUXE-137-1-3', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(426, 240, 137, 'DELUXE-137-2-1', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(427, 240, 137, 'DELUXE-137-2-2', 1, '2025-07-17 18:53:32', '2025-07-17 18:53:32'),
(428, 241, 138, 'DELUXE-138-1-1', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(429, 241, 138, 'DELUXE-138-1-2', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(430, 241, 138, 'DELUXE-138-1-3', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(431, 242, 138, 'DELUXE-138-2-1', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(432, 242, 138, 'DELUXE-138-2-2', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(433, 243, 139, 'DELUXE-139-1-1', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(434, 243, 139, 'DELUXE-139-1-2', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(435, 243, 139, 'DELUXE-139-1-3', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(436, 244, 139, 'DELUXE-139-2-1', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(437, 244, 139, 'DELUXE-139-2-2', 1, '2025-07-17 18:53:41', '2025-07-17 18:53:41'),
(438, 241, 138, 'DELUXE-138-1-1', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(439, 241, 138, 'DELUXE-138-1-2', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(440, 241, 138, 'DELUXE-138-1-3', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(441, 242, 138, 'DELUXE-138-2-1', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(442, 242, 138, 'DELUXE-138-2-2', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(443, 243, 139, 'DELUXE-139-1-1', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(444, 243, 139, 'DELUXE-139-1-2', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(445, 243, 139, 'DELUXE-139-1-3', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(446, 244, 139, 'DELUXE-139-2-1', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(447, 244, 139, 'DELUXE-139-2-2', 1, '2025-07-17 18:54:37', '2025-07-17 18:54:37'),
(448, 241, 138, 'DELUXE-138-1-1', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(449, 241, 138, 'DELUXE-138-1-2', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(450, 241, 138, 'DELUXE-138-1-3', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(451, 242, 138, 'DELUXE-138-2-1', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(452, 242, 138, 'DELUXE-138-2-2', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(453, 243, 139, 'DELUXE-139-1-1', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(454, 243, 139, 'DELUXE-139-1-2', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(455, 243, 139, 'DELUXE-139-1-3', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(456, 244, 139, 'DELUXE-139-2-1', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39'),
(457, 244, 139, 'DELUXE-139-2-2', 1, '2025-07-17 18:54:39', '2025-07-17 18:54:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` double DEFAULT NULL,
  `room_quantity` int(11) DEFAULT 0,
  `room_code` char(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `gallery` longtext DEFAULT NULL,
  `bed_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bed_quantity` int(11) DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_types`
--

INSERT INTO `room_types` (`id`, `hotel_id`, `name`, `area`, `room_quantity`, `room_code`, `description`, `gallery`, `bed_type_id`, `bed_quantity`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, 'Phòng Deluxe', 20, 3, 'Deluxe', '<p>Ph&ograve;ng giường đ&ocirc;i rộng r&atilde;i n&agrave;y c&oacute; máy điều h&ograve;a, tủ để quần &aacute;o cũng như ph&ograve;ng tắm ri&ecirc;ng với v&ograve;i sen v&agrave; m&aacute;y sấy t&oacute;c. Căn n&agrave;y được trang bị 1 giường.</p>', '/uploads/files/demo/689072330.jpg,/uploads/files/demo/689124941.jpg,/uploads/files/demo/689128495.jpg,/uploads/files/demo/689128499.jpg,/uploads/files/demo/689128496.jpg', 1, 2, 1, '2025-06-21 04:46:14', '2025-07-14 01:29:31'),
(5, 2, 'Phòng Deluxe Giường Đơn', 20, 0, 'Deluxe', NULL, NULL, 1, 1, 1, '2025-06-22 04:00:22', '2025-06-22 04:34:39'),
(201, 101, 'Phòng Deluxe 1', 25, 3, 'DELUXE-101-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(202, 101, 'Phòng Deluxe 2', 30, 4, 'DELUXE-101-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(203, 102, 'Phòng Deluxe 1', 25, 3, 'DELUXE-102-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(204, 102, 'Phòng Deluxe 2', 30, 4, 'DELUXE-102-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(205, 103, 'Phòng Deluxe 1', 25, 3, 'DELUXE-103-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(206, 103, 'Phòng Deluxe 2', 30, 4, 'DELUXE-103-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(207, 104, 'Phòng Deluxe 1', 25, 3, 'DELUXE-104-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(208, 104, 'Phòng Deluxe 2', 30, 4, 'DELUXE-104-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(209, 105, 'Phòng Deluxe 1', 25, 3, 'DELUXE-105-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(210, 105, 'Phòng Deluxe 2', 30, 4, 'DELUXE-105-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(211, 106, 'Phòng Deluxe 1', 25, 3, 'DELUXE-106-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(212, 106, 'Phòng Deluxe 2', 30, 4, 'DELUXE-106-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(213, 107, 'Phòng Deluxe 1', 25, 3, 'DELUXE-107-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(214, 107, 'Phòng Deluxe 2', 30, 4, 'DELUXE-107-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(217, 109, 'Phòng Deluxe 1', 25, 3, 'DELUXE-109-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(218, 109, 'Phòng Deluxe 2', 30, 4, 'DELUXE-109-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(221, 111, 'Phòng Deluxe 1', 25, 3, 'DELUXE-111-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(222, 111, 'Phòng Deluxe 2', 30, 4, 'DELUXE-111-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(223, 112, 'Phòng Deluxe 1', 25, 3, 'DELUXE-112-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(224, 112, 'Phòng Deluxe 2', 30, 4, 'DELUXE-112-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(225, 113, 'Phòng Deluxe 1', 25, 3, 'DELUXE-113-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(226, 113, 'Phòng Deluxe 2', 30, 4, 'DELUXE-113-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(227, 114, 'Phòng Deluxe 1', 25, 3, 'DELUXE-114-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(228, 114, 'Phòng Deluxe 2', 30, 4, 'DELUXE-114-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(229, 115, 'Phòng Deluxe 1', 25, 3, 'DELUXE-115-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(230, 115, 'Phòng Deluxe 2', 30, 4, 'DELUXE-115-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-10 05:58:44', '2025-07-10 05:58:44'),
(236, 2, 'Phòng Deluxe', 20, 2, 'Deluxe', NULL, NULL, 1, 1, 0, '2025-07-17 05:29:59', '2025-07-18 00:34:13'),
(237, 136, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-136-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(238, 136, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-136-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(239, 137, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-137-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(240, 137, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-137-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(241, 138, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-138-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(242, 138, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-138-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(243, 139, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-139-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(244, 139, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-139-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(245, 140, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-140-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(246, 140, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-140-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(247, 141, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-141-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(248, 141, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-141-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(249, 142, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-142-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(250, 142, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-142-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(251, 143, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-143-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(252, 143, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-143-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(253, 144, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-144-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(254, 144, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-144-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(255, 145, 'Phòng Deluxe Giường Đôi', 25, 3, 'DELUXE-145-1', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 1, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33'),
(256, 145, 'Phòng Deluxe Giường Đơn', 20, 2, 'DELUXE-145-2', 'Phòng đẹp, đầy đủ tiện nghi', '/uploads/images/room-default.jpg,/uploads/images/room-alt.jpg', 2, 1, 1, '2025-07-17 18:25:33', '2025-07-17 18:25:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_type_amenities`
--

CREATE TABLE `room_type_amenities` (
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `amenity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_type_season_prices`
--

CREATE TABLE `room_type_season_prices` (
  `room_type_variant_id` bigint(20) UNSIGNED NOT NULL,
  `season_id` bigint(20) UNSIGNED NOT NULL,
  `discount_type` tinyint(4) NOT NULL DEFAULT 0,
  `discount_value` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_type_season_prices`
--

INSERT INTO `room_type_season_prices` (`room_type_variant_id`, `season_id`, `discount_type`, `discount_value`, `created_at`, `updated_at`) VALUES
(10, 1, 0, 10000, NULL, '2025-07-02 13:21:27'),
(334, 1, 0, 150000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(335, 2, 0, 200000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(336, 3, 0, 100000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(337, 4, 0, 180000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(338, 5, 0, 120000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(339, 6, 0, 150000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(340, 7, 0, 100000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(341, 1, 0, 130000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(342, 2, 0, 200000, '2025-07-17 19:27:27', '2025-07-17 19:27:27'),
(343, 3, 0, 170000, '2025-07-17 19:27:27', '2025-07-17 19:27:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_type_variants`
--

CREATE TABLE `room_type_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `base_price` int(11) NOT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `fee_type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_type_variants`
--

INSERT INTO `room_type_variants` (`id`, `room_type_id`, `base_price`, `discount_price`, `fee_type`, `status`, `created_at`, `updated_at`) VALUES
(10, 4, 1500000, 1000000, 0, 1, '2025-06-22 20:32:26', '2025-06-22 20:32:26'),
(12, 4, 2000000, 1500000, 0, 1, '2025-06-23 19:24:31', '2025-06-23 19:24:31'),
(301, 201, 1200000, NULL, 0, 1, '2025-07-10 06:03:57', '2025-07-10 06:03:57'),
(302, 202, 1300000, NULL, 0, 1, '2025-07-10 06:03:57', '2025-07-10 06:03:57'),
(303, 203, 1100000, NULL, 0, 1, '2025-07-10 06:03:57', '2025-07-10 06:03:57'),
(330, 230, 1300000, NULL, 0, 1, '2025-07-10 06:03:57', '2025-07-10 06:03:57'),
(331, 5, 1000000, 500000, 0, 1, '2025-07-10 07:31:53', '2025-07-10 07:31:53'),
(332, 204, 1500000, 500000, NULL, 1, '2025-07-10 08:19:12', '2025-07-10 08:19:12'),
(333, 236, 1000000, NULL, 0, 1, '2025-07-17 05:31:46', '2025-07-17 05:31:46'),
(334, 237, 1500000, 1200000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(335, 237, 1700000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(336, 238, 1400000, 1000000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(337, 238, 1600000, 1300000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(338, 239, 1200000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(339, 239, 1500000, 1200000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(340, 240, 1000000, 800000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(341, 240, 1300000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(342, 241, 1800000, 1500000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(343, 241, 1600000, 1400000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(344, 242, 1400000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(345, 242, 1600000, 1300000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(346, 243, 1500000, 1200000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(347, 243, 1700000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(348, 244, 1200000, 1000000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(349, 244, 1300000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(350, 245, 1800000, 1500000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(351, 245, 1900000, 1600000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(352, 246, 1000000, 800000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(353, 246, 1200000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(354, 247, 1100000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(355, 247, 1300000, 1000000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(356, 248, 1400000, 1100000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(357, 248, 1600000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(358, 249, 1500000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(359, 249, 1700000, 1300000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(360, 250, 1200000, 1000000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(361, 250, 1400000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(362, 251, 1800000, 1500000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(363, 251, 1600000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(364, 252, 1500000, 1200000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(365, 252, 1700000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(366, 253, 1300000, 1000000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(367, 253, 1100000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(368, 254, 1900000, 1600000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(369, 254, 1700000, 1400000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(370, 255, 1600000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(371, 255, 1400000, 1100000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(372, 256, 1000000, 800000, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31'),
(373, 256, 1300000, NULL, 0, 1, '2025-07-17 18:36:31', '2025-07-17 18:36:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seasons`
--

CREATE TABLE `seasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `seasons`
--

INSERT INTO `seasons` (`id`, `name`, `start_date`, `end_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mùa du lịch', '2025-06-08 00:00:00', '2025-07-11 00:00:00', NULL, 1, '2025-06-08 15:31:38', '2025-06-08 15:54:24'),
(2, 'Sự kiện 30/4', '2025-07-17 00:00:00', '2025-07-20 00:00:00', NULL, 1, '2025-07-17 05:48:27', '2025-07-17 05:48:27'),
(3, 'Chiến dịch Nắng Vàng', '2025-06-01 00:00:00', '2025-08-31 00:00:00', 'Thời điểm du lịch hè sôi động, bãi biển nhộn nhịp và ưu đãi hấp dẫn', 1, '2025-07-17 18:20:30', '2025-07-17 18:20:30'),
(4, 'Giai đoạn Mưa Mộng Mơ', '2025-09-01 00:00:00', '2025-10-15 00:00:00', 'Mùa mưa nhẹ nhàng, phù hợp cho các kỳ nghỉ thư giãn, ít đông đúc', 1, '2025-07-17 18:20:30', '2025-07-17 18:20:30'),
(5, 'Mùa Lễ Hội Ánh Sáng', '2025-12-15 00:00:00', '2026-01-05 00:00:00', 'Thời điểm cuối năm với không khí Giáng sinh và năm mới rực rỡ', 1, '2025-07-17 18:20:30', '2025-07-17 18:20:30'),
(6, 'Sắc Xuân Truyền Thống', '2026-01-20 00:00:00', '2026-03-31 00:00:00', 'Mùa xuân với nhiều lễ hội văn hóa, không khí ấm áp dễ chịu', 1, '2025-07-17 18:20:30', '2025-07-17 18:20:30'),
(7, 'Thời Gian Khám Phá Xanh', '2026-04-01 00:00:00', '2026-05-31 00:00:00', 'Thời điểm lý tưởng cho các chuyến du lịch khám phá và nghỉ dưỡng nhẹ nhàng', 1, '2025-07-17 18:20:30', '2025-07-17 18:20:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `default_unit` char(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `default_unit`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Massage', 'Người', 1, '2025-06-04 08:03:14', '2025-06-04 08:40:07'),
(2, 'Tourn tham quan', 'Vé', 1, '2025-06-04 08:40:41', '2025-06-04 08:40:41'),
(3, 'Đưa đón sân bay', 'lượt', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(4, 'Thuê xe máy/xe hơi', 'ngày', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(5, 'Giặt ủi', 'kg', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(6, 'Massage & Spa', 'lượt', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(7, 'Gọi đồ ăn tại phòng', 'lượt', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(8, 'Đặt tour du lịch', 'tour', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(9, 'Bảo vệ 24/7', 'ngày', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(10, 'Hỗ trợ mang hành lý', 'lượt', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(11, 'Đặt vé máy bay', 'vé', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(12, 'Hỗ trợ y tế khẩn cấp', 'lượt', 1, '2025-07-17 18:02:49', '2025-07-17 18:02:49'),
(13, 'Dịch vụ giữ hành lý', 'lượt', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(14, 'Thuê xe đạp', 'ngày', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(15, 'Dọn phòng hàng ngày', 'ngày', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(16, 'Tổ chức sự kiện/hội nghị', 'gói', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(17, 'Dịch vụ giữ trẻ', 'giờ', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(18, 'Đặt vé tham quan', 'vé', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(19, 'Giặt khô', 'kg', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(20, 'Chăm sóc da mặt', 'lượt', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(21, 'Cho thuê thiết bị hội thảo', 'ngày', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10'),
(22, 'Dịch vụ gọi taxi', 'lượt', 1, '2025-07-17 18:04:10', '2025-07-17 18:04:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hotel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_type` tinyint(4) NOT NULL,
  `transaction_code` char(50) NOT NULL,
  `original_code` char(50) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `commission_amount` int(11) DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`id`, `booking_id`, `hotel_id`, `user_id`, `transaction_type`, `transaction_code`, `original_code`, `amount`, `commission_amount`, `payment_status`, `paid_at`, `created_at`, `updated_at`) VALUES
(72, 92, 2, 135, 0, 'RMX20250718081221FG8L', NULL, 2480000, NULL, 1, '2025-07-18 08:13:02', '2025-07-18 01:12:21', '2025-07-18 01:13:02'),
(73, 92, 2, 1, 1, 'RMX20250718082029J2KO', NULL, 2108000, 372000, 1, '2025-07-18 08:20:29', '2025-07-18 01:20:29', '2025-07-18 01:20:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `birthday`, `gender`, `address`, `avatar`, `provider`, `provider_id`, `role`, `email_verified_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Logn', 'admin@gmail.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0306221140', '2004-10-02', 0, 'Hồ Chí Minh', '/uploads/images/bg-admin.jpg', '', '', 1, '2025-07-11 07:12:51', 1, '2025-05-22 09:55:31', '2025-06-12 09:13:45'),
(2, 'Hugn', 'hotel@gmail.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0340900900', '2025-05-22', 0, 'HN', '/assets/images/avatar-user.png', '', '', 3, '2025-07-11 07:12:54', 1, '2025-05-22 09:56:40', '2025-06-14 11:50:46'),
(4, 'Logn', 'logn021004@gmail.com', '$2y$10$uGFFod.p5ziQ1NHgec3f5ezJIHZG/4HS/J3yabeS2Nf2Uh0bi6kk6', '0999999999', '2025-06-03', 0, 'Hồ Chí Minh', '/uploads/images/bg-admin.jpg', '', '', 2, '2025-07-11 07:12:57', 1, '2025-06-03 06:10:34', '2025-06-27 09:41:43'),
(5, 'L0ng', 'wmfunnygame@gmail.com', '$2y$10$sZkinCvzHgRS0W5PHXX/IeQq3Rbd1AOuTd23lv31KsvcgXlRxhWD.', NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocLzvmmoj2m8XeIeRG3m-xfJzNHVD99wdgEBbYvJ5blocV2Asugh=s96-c', 'google', '116990182216988347878', 1, '2025-07-11 07:12:59', 1, '2025-06-14 05:18:08', '2025-06-14 05:18:08'),
(6, 'Thành Long', 'thanhlong7899900@gmail.com', '$2y$10$mxaXb/kdgmKnhTAAKnVGfe0Gu1kYPIrDtxC1tG/ZqMk0h2YTtv0Za', NULL, NULL, NULL, NULL, 'https://graph.facebook.com/v3.3/707793311854896/picture', 'facebook', '707793311854896', 1, '2025-07-11 07:13:05', 1, '2025-06-15 07:03:09', '2025-06-15 07:03:09'),
(7, 'Bùi Bảo Lâm', 'laml0n@gmail.com', '$2y$10$Dj7QEJOOjjqaygUfhgms3e.08DehLv5utkC2pCOSVCHDMs5v9JIqC', '0323456789', NULL, 1, NULL, NULL, NULL, NULL, 2, '2025-07-11 07:13:07', 1, '2025-06-16 10:03:26', '2025-06-16 10:03:26'),
(100, 'Nguyễn Văn Long', 'user100@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0901123456', '1997-06-15', 1, 'Hà Nội', '/assets/images/avatar-user.png', NULL, NULL, 1, '2025-07-11 07:13:10', 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(101, 'Trần Thị Mai', 'user101@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0932345678', '1995-03-10', 0, 'TP. Hồ Chí Minh', '/assets/images/avatar-user.png', NULL, NULL, 3, '2025-07-11 07:13:12', 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(102, 'Lê Văn An', 'user102@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0987654321', '1990-11-20', 1, 'Đà Nẵng', '/assets/images/avatar-user.png', NULL, NULL, 3, '2025-07-11 07:13:16', 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(103, 'Phạm Thị Thảo', 'user103@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0944112233', '1996-07-30', 0, 'Cần Thơ', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(104, 'Đặng Minh Tuấn', 'user104@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0909777333', '1992-05-05', 1, 'Hải Phòng', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(105, 'Hoàng Ngọc Bích', 'user105@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0971223344', '1993-09-18', 0, 'Huế', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(106, 'Bùi Quốc Huy', 'user106@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0911333444', '1991-02-12', 1, 'Biên Hòa', '/assets/images/avatar-user.png', NULL, NULL, 3, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(107, 'Nguyễn Thị Hoa', 'user107@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0966778899', '1998-04-08', 0, 'Vũng Tàu', '/assets/images/avatar-user.png', NULL, NULL, 3, NULL, 1, '2025-07-10 05:48:04', '2025-07-12 03:44:15'),
(108, 'Trần Văn Phúc', '10306221140@caothang.edu.vn', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0922333444', '1989-08-23', 1, 'Bắc Ninh', '/assets/images/avatar-user.png', NULL, NULL, 3, NULL, 1, '2025-07-10 05:48:04', '2025-07-12 19:21:57'),
(109, 'Lý Thị Lan', 'user109@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0933999000', '1994-01-15', 0, 'Long An', '/assets/images/avatar-user.png', NULL, NULL, 3, NULL, 1, '2025-07-10 05:48:04', '2025-07-17 05:45:08'),
(110, 'Vũ Hoàng Nam', 'user110@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0909111222', '1993-12-11', 1, 'Thái Nguyên', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(111, 'Nguyễn Bảo Châu', 'user111@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0911555666', '1997-10-10', 0, 'Quảng Ninh', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(112, 'Phan Thanh Bình', 'user112@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0933444555', '1992-02-02', 1, 'Hòa Bình', '/assets/images/avatar-user.png', NULL, NULL, 3, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(113, 'Ngô Thị Mai Hương', 'user113@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0955888777', '1990-06-06', 0, 'Tây Ninh', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(114, 'Trịnh Quốc Thịnh', 'user114@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0944333222', '1991-01-30', 1, 'Bình Dương', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(115, 'Dương Mỹ Linh', 'user115@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0988666777', '1996-03-12', 0, 'Quảng Ngãi', '/assets/images/avatar-user.png', NULL, NULL, 3, '2025-07-15 09:41:31', 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(116, 'Mai Văn Hiếu', 'user116@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0922111000', '1995-07-07', 1, 'Phú Yên', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(117, 'Trương Ngọc Diệp', 'user117@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0966332211', '1998-12-01', 0, 'Sóc Trăng', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(118, 'Lâm Nhật Minh', 'user118@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0977333444', '1990-10-25', 1, 'Cà Mau', '/assets/images/avatar-user.png', NULL, NULL, 1, NULL, 1, '2025-07-10 05:48:04', '2025-07-10 05:48:04'),
(119, 'Tạ Thu Hà', '120306221140@caothang.edu.vn', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0911667888', '1994-09-09', 0, 'Kiên Giang', '/assets/images/avatar-user.png', NULL, NULL, 1, '2025-07-12 17:53:18', 1, '2025-07-10 05:48:04', '2025-07-12 17:53:18'),
(120, 'Trần Thành Long', 'Logn0202@gmail.com', '$2y$10$kHy607bHsBGoLf8gpRrJqeDahQK17ndU6XeIR07cNvJLct41DLWpS', '0889702104', '2025-07-10', 0, 'Hồ Chí Minh', '/assets/images/1752131193_HD-wallpaper-spiderman-amazing-spider-man.jpg', NULL, NULL, 3, '2025-07-13 13:53:10', 1, '2025-07-10 07:06:33', '2025-07-12 03:41:37'),
(134, 'Trần Thành Long', '0306221140@caothang.com.vn', '$2y$10$IFgGb7Iw/W8hbhlI.De5aeo9hPWHJcSC6mENC0Qfud1SAfPUvt1Lm', '0889702104', '2025-07-18', 0, '89/14 Hàm Nghi 7, Quận 1, 71009 TP. Hồ Chí Minh, Việt Nam', '/assets/images/1752722771_IMG_7243.JPG', NULL, NULL, 2, NULL, 1, '2025-07-17 03:26:11', '2025-07-17 03:26:11'),
(135, 'Trần Thành Long', '0306221140@caothang.edu.vn', '$2y$10$TBj4Xljn6jFmm08r5psTAOcCUFnqXuI70EmSyGVZifGpnF8X.1Z9e', '0889702104', '2004-10-02', 0, '89/14 Hàm Nghi 7, Quận 1, 71009 TP. Hồ Chí Minh, Việt Nam', '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 2, '2025-07-17 03:29:49', 1, '2025-07-17 03:27:47', '2025-07-17 03:29:49'),
(136, 'Nguyễn Văn A', 'a1@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(137, 'Trần Thị B', 'b2@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 1, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(138, 'Lê Văn C', 'c3@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(139, 'Phạm Thị D', 'd4@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 1, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(140, 'Đỗ Quốc E', 'e5@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(141, 'Hoàng Gia F', 'f6@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(142, 'Trịnh Văn G', 'g7@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(143, 'Ngô Thị H', 'h8@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 1, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(144, 'Vũ Hoàng I', 'i9@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(145, 'Đặng Minh K', 'k10@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(146, 'Tạ Thu L', 'l11@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 1, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(147, 'Lương Thế M', 'm12@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(148, 'Mai Thị N', 'n13@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 1, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(149, 'Hồ Văn O', 'o14@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(150, 'Tạ Quỳnh P', 'p15@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 1, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 3, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(151, 'Nguyễn Duy Q', 'q16@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 2, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(152, 'Trần Mỹ R', 'r17@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 1, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 2, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(153, 'Lê Đình S', 's18@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 2, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(154, 'Phạm Hồng T', 't19@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 1, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 2, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(155, 'Đỗ Văn U', 'u20@example.com', '$2y$10$gw9dyyrNE0KTF94o3p6PxOOzzE1wNUScQsqFwFd97U.Vel4.jnZrO', '0889702104', NULL, 0, NULL, '/assets/images/1752722867_IMG_7243.JPG', NULL, NULL, 2, '2025-07-17 17:44:46', 1, '2025-07-17 17:44:46', '2025-07-17 17:44:46'),
(156, 'Trần Thành Long', '0306221140@caothang.edu.com', '$2y$10$9J77fBZgYCjwM9uvhT1ONeUS6DakVMmhruX2WSwdF1csFGPeMSIom', '0889702104', '2004-02-03', 0, 'Tràng An, Hoa Lư, Ninh Bình', '/assets/images/1752800786_IMG_7243.JPG', NULL, NULL, 2, NULL, 1, '2025-07-18 01:06:26', '2025-07-18 01:06:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `variant_attributes`
--

CREATE TABLE `variant_attributes` (
  `variant_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `variant_attributes`
--

INSERT INTO `variant_attributes` (`variant_id`, `attribute_id`, `attribute_value`, `created_at`, `updated_at`) VALUES
(10, 3, '2', '2025-06-22 20:32:26', '2025-07-02 13:21:28'),
(10, 4, '1', '2025-06-22 20:32:26', '2025-07-02 13:21:28'),
(10, 5, '1', '2025-06-22 20:32:26', '2025-07-02 13:21:28'),
(10, 6, '1', '2025-06-22 20:32:26', '2025-07-02 13:21:28'),
(10, 8, NULL, '2025-07-02 13:21:28', '2025-07-02 13:21:28'),
(12, 3, '1', '2025-06-23 19:24:31', '2025-07-10 07:29:21'),
(12, 4, '1', '2025-06-23 19:24:32', '2025-07-10 07:29:21'),
(12, 5, '1', '2025-06-23 19:24:32', '2025-07-10 07:29:21'),
(12, 6, '1', '2025-07-10 07:29:21', '2025-07-10 07:29:21'),
(12, 7, '500000', '2025-06-23 19:24:32', '2025-07-10 07:29:21'),
(301, 3, '2', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(301, 4, '1', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(301, 5, '1', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(301, 6, '1', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(301, 7, '100000', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(302, 3, '2', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(302, 4, '1', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(302, 5, '1', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(302, 6, '1', '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(302, 8, NULL, '2025-07-10 06:04:54', '2025-07-10 06:04:54'),
(331, 3, '2', '2025-07-10 07:31:53', '2025-07-10 07:31:53'),
(331, 4, '0', '2025-07-10 07:31:53', '2025-07-10 07:31:53'),
(331, 5, '1', '2025-07-10 07:31:53', '2025-07-10 07:31:53'),
(331, 6, '1', '2025-07-10 07:31:53', '2025-07-10 07:31:53'),
(331, 7, '300000', '2025-07-10 07:31:53', '2025-07-10 07:31:53'),
(332, 3, '2', '2025-07-10 08:19:12', '2025-07-10 08:19:12'),
(332, 4, '1', '2025-07-10 08:19:12', '2025-07-10 08:19:12'),
(332, 5, '1', '2025-07-10 08:19:12', '2025-07-10 08:19:12'),
(332, 6, '1', '2025-07-10 08:19:12', '2025-07-10 08:19:12'),
(332, 8, NULL, '2025-07-10 08:19:12', '2025-07-10 08:19:12'),
(333, 3, '2', '2025-07-17 05:31:46', '2025-07-17 05:31:46'),
(333, 4, '1', '2025-07-17 05:31:46', '2025-07-17 05:31:46'),
(333, 5, '1', '2025-07-17 05:31:46', '2025-07-17 05:31:46'),
(333, 6, '1', '2025-07-17 05:31:46', '2025-07-17 05:31:46'),
(333, 7, '100000', '2025-07-17 05:31:46', '2025-07-17 05:31:46'),
(334, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(334, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(334, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(334, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(334, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(335, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(335, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(335, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(335, 6, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(335, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(336, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(336, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(336, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(336, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(336, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(337, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(337, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(337, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(337, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(337, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(338, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(338, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(338, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(338, 6, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(338, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(339, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(339, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(339, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(339, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(339, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(340, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(340, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(340, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(340, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(340, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(341, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(341, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(341, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(341, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(341, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(342, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(342, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(342, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(342, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(342, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(343, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(343, 4, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(343, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(343, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(343, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(344, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(344, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(344, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(344, 6, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(344, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(345, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(345, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(345, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(345, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(345, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(346, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(346, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(346, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(346, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(346, 7, '250000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(347, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(347, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(347, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(347, 6, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(347, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(348, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(348, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(348, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(348, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(348, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(349, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(349, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(349, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(349, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(349, 7, '200000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(350, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(350, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(350, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(350, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(350, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(351, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(351, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(351, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(351, 6, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(351, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(352, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(352, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(352, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(352, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(352, 7, '250000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(353, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(353, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(353, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(353, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(353, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(354, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(354, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(354, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(354, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(354, 7, '250000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(355, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(355, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(355, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(355, 6, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(355, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(356, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(356, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(356, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(356, 6, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(356, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(357, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(357, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(357, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(357, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(357, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(358, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(358, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(358, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(358, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(358, 7, '200000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(359, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(359, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(359, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(359, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(359, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(360, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(360, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(360, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(360, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(360, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(361, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(361, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(361, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(361, 6, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(361, 7, '250000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(362, 3, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(362, 4, '2', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(362, 5, '0', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(362, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(362, 7, '300000', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(363, 3, '3', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(363, 4, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(363, 5, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(363, 6, '1', '2025-07-17 18:48:48', '2025-07-17 18:48:48'),
(363, 8, NULL, '2025-07-17 18:48:48', '2025-07-17 18:48:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(255) NOT NULL,
  `discount_type` tinyint(4) NOT NULL,
  `discount_value` int(11) NOT NULL,
  `max_discount_value` int(11) DEFAULT NULL,
  `min_order_value` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `hotel_scope` tinyint(4) NOT NULL DEFAULT 0,
  `customer_scope` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `discount_type`, `discount_value`, `max_discount_value`, `min_order_value`, `is_active`, `start_date`, `end_date`, `hotel_scope`, `customer_scope`, `created_at`, `updated_at`) VALUES
(5, 'NGON', 0, 200000, 100000, 10000, 0, '2025-06-12', '2025-06-29', 1, 0, '2025-06-11 17:30:12', '2025-07-17 16:28:11'),
(6, 'MUAHE', 0, 150000, 0, 0, 0, '2025-07-10', '2025-07-12', 1, 1, '2025-07-10 03:13:49', '2025-07-17 16:28:04'),
(7, 'VIP2', 0, 500000, 0, 1000000, 1, '2025-07-17', '2025-07-31', 1, 1, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(8, 'WELCOME50', 0, 50000, 0, 200000, 1, '2025-07-16', '2025-08-27', 1, 1, '2025-07-17 19:34:19', '2025-07-17 19:34:19'),
(9, 'FLASHSALE', 0, 150000, 0, 300000, 1, '2025-07-17', '2025-07-25', 0, 1, '2025-07-17 19:34:19', '2025-07-17 19:34:19'),
(10, 'VIPUSER', 0, 250000, 0, 1000000, 1, '2025-07-15', '2025-07-20', 1, 0, '2025-07-17 19:34:19', '2025-07-17 19:34:19'),
(11, 'SUMMERHOTEL', 0, 300000, 0, 800000, 1, '2025-07-25', '2025-08-15', 0, 0, '2025-07-17 19:34:19', '2025-07-17 19:34:19'),
(12, 'FREESTAY', 0, 500000, 0, 2000000, 1, '2025-08-01', '2025-09-01', 1, 1, '2025-07-17 19:34:19', '2025-07-17 19:34:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher_hotels`
--

CREATE TABLE `voucher_hotels` (
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher_hotels`
--

INSERT INTO `voucher_hotels` (`voucher_id`, `hotel_id`, `created_at`, `updated_at`) VALUES
(5, 1, '2025-06-11 17:36:48', '2025-06-11 17:36:48'),
(5, 2, '2025-06-11 17:36:48', '2025-06-11 17:36:48'),
(5, 4, '2025-06-11 17:35:01', '2025-06-11 17:35:01'),
(5, 101, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 102, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 103, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 104, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 105, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 106, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 107, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 109, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 111, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 112, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 113, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 114, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 115, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(5, 120, '2025-07-17 16:28:11', '2025-07-17 16:28:11'),
(6, 1, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 2, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 4, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 101, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 102, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 103, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 104, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 105, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 106, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 107, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 109, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 111, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 112, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 113, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 114, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 115, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 120, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(7, 1, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 2, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 4, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 101, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 102, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 103, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 104, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 105, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 106, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 107, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 109, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 111, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 112, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 113, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 114, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 115, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 120, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(9, 2, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 136, '2025-07-17 19:35:09', '2025-07-17 19:35:09'),
(9, 137, '2025-07-17 19:35:09', '2025-07-17 19:35:09'),
(10, 1, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 2, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 4, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 101, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 102, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 103, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 104, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 105, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 106, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 107, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 109, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 111, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 112, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 113, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 114, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 115, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 120, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 136, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 137, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 138, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 139, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 140, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 141, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 142, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 143, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 144, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 145, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 146, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 147, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 148, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 149, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(10, 150, '2025-07-17 19:50:40', '2025-07-17 19:50:40'),
(11, 138, '2025-07-17 19:35:09', '2025-07-17 19:35:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher_user`
--

CREATE TABLE `voucher_user` (
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher_user`
--

INSERT INTO `voucher_user` (`voucher_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 4, '2025-06-11 17:36:35', '2025-06-11 17:36:35'),
(6, 1, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 2, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 4, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 5, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 6, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 7, '2025-07-10 03:13:49', '2025-07-10 03:13:49'),
(6, 100, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 101, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 102, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 103, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 104, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 105, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 106, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 107, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 108, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 109, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 110, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 111, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 112, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 113, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 114, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 115, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 116, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 117, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 118, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 119, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 120, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 134, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(6, 135, '2025-07-17 16:28:04', '2025-07-17 16:28:04'),
(7, 1, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 2, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 4, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 5, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 6, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 7, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 100, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 101, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 102, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 103, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 104, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 105, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 106, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 107, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 108, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 109, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 110, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 111, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 112, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 113, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 114, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 115, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 116, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 117, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 118, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 119, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 120, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 134, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(7, 135, '2025-07-17 16:38:14', '2025-07-17 16:38:14'),
(9, 1, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 2, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 4, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 5, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 6, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 7, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 100, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 101, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 102, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 103, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 104, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 105, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 106, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 107, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 108, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 109, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 110, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 111, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 112, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 113, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 114, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 115, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 116, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 117, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 118, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 119, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 120, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 134, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 135, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 136, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 137, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 138, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 139, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 140, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 141, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 142, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 143, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 144, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 145, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 146, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 147, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 148, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 149, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 150, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 151, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 152, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 153, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 154, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(9, 155, '2025-07-17 19:44:33', '2025-07-17 19:44:33'),
(10, 136, '2025-07-17 19:35:25', '2025-07-17 19:35:25'),
(10, 137, '2025-07-17 19:35:25', '2025-07-17 19:35:25'),
(10, 138, '2025-07-17 19:35:25', '2025-07-17 19:35:25'),
(11, 139, '2025-07-17 19:35:25', '2025-07-17 19:35:25'),
(11, 140, '2025-07-17 19:35:25', '2025-07-17 19:35:25');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `amenities_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bed_types`
--
ALTER TABLE `bed_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_booking_code_unique` (`booking_code`),
  ADD KEY `bookings_customer_id_foreign` (`customer_id`),
  ADD KEY `bookings_hotel_id_foreign` (`hotel_id`),
  ADD KEY `bookings_voucher_id_foreign` (`voucher_id`);

--
-- Chỉ mục cho bảng `booking_combos`
--
ALTER TABLE `booking_combos`
  ADD PRIMARY KEY (`booking_id`,`combo_id`),
  ADD KEY `booking_combos_combo_id_foreign` (`combo_id`);

--
-- Chỉ mục cho bảng `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_details_booking_id_foreign` (`booking_id`),
  ADD KEY `booking_details_room_type_id_foreign` (`room_type_id`),
  ADD KEY `booking_details_room_type_variant_id_foreign` (`room_type_variant_id`),
  ADD KEY `booking_details_room_id_foreign` (`room_id`);

--
-- Chỉ mục cho bảng `booking_services`
--
ALTER TABLE `booking_services`
  ADD PRIMARY KEY (`booking_id`,`hotel_service_id`) USING BTREE,
  ADD KEY `booking_services_hotel_service_id_foreign` (`hotel_service_id`);

--
-- Chỉ mục cho bảng `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `combos_hotel_id_foreign` (`hotel_id`);

--
-- Chỉ mục cho bảng `combo_services`
--
ALTER TABLE `combo_services`
  ADD PRIMARY KEY (`combo_id`,`hotel_service_id`),
  ADD KEY `combo_services_hotel_service_id_foreign` (`hotel_service_id`);

--
-- Chỉ mục cho bảng `commission_rules`
--
ALTER TABLE `commission_rules`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_customer_id_foreign` (`customer_id`),
  ADD KEY `conversations_partner_id_foreign` (`partner_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`hotel_id`),
  ADD KEY `favorites_hotel_id_foreign` (`hotel_id`);

--
-- Chỉ mục cho bảng `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hotel_amenities`
--
ALTER TABLE `hotel_amenities`
  ADD PRIMARY KEY (`hotel_id`,`amenity_id`),
  ADD KEY `hotel_amenities_amenity_id_foreign` (`amenity_id`);

--
-- Chỉ mục cho bảng `hotel_rules`
--
ALTER TABLE `hotel_rules`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hotel_services`
--
ALTER TABLE `hotel_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_services_hotel_id_foreign` (`hotel_id`),
  ADD KEY `hotel_services_service_id_foreign` (`service_id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notification_user`
--
ALTER TABLE `notification_user`
  ADD PRIMARY KEY (`notification_id`,`user_id`),
  ADD KEY `notification_user_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_booking_id_unique` (`booking_id`),
  ADD KEY `reviews_hotel_id_foreign` (`hotel_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_room_type_id_foreign` (`room_type_id`),
  ADD KEY `rooms_hotel_id_foreign` (`hotel_id`);

--
-- Chỉ mục cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_types_hotel_id_foreign` (`hotel_id`),
  ADD KEY `room_types_bed_type_id_foreign` (`bed_type_id`);

--
-- Chỉ mục cho bảng `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  ADD PRIMARY KEY (`room_type_id`,`amenity_id`),
  ADD KEY `room_type_amenities_amenity_id_foreign` (`amenity_id`);

--
-- Chỉ mục cho bảng `room_type_season_prices`
--
ALTER TABLE `room_type_season_prices`
  ADD PRIMARY KEY (`room_type_variant_id`,`season_id`),
  ADD KEY `room_type_season_prices_season_id_foreign` (`season_id`);

--
-- Chỉ mục cho bảng `room_type_variants`
--
ALTER TABLE `room_type_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_variants_room_type_id_foreign` (`room_type_id`);

--
-- Chỉ mục cho bảng `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_booking_id_foreign` (`booking_id`),
  ADD KEY `transactions_hotel_id_foreign` (`hotel_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `variant_attributes`
--
ALTER TABLE `variant_attributes`
  ADD PRIMARY KEY (`variant_id`,`attribute_id`),
  ADD KEY `variant_attributes_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `voucher_hotels`
--
ALTER TABLE `voucher_hotels`
  ADD PRIMARY KEY (`voucher_id`,`hotel_id`),
  ADD KEY `voucher_hotels_hotel_id_foreign` (`hotel_id`);

--
-- Chỉ mục cho bảng `voucher_user`
--
ALTER TABLE `voucher_user`
  ADD PRIMARY KEY (`voucher_id`,`user_id`),
  ADD KEY `voucher_user_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `bed_types`
--
ALTER TABLE `bed_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT cho bảng `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT cho bảng `combos`
--
ALTER TABLE `combos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `commission_rules`
--
ALTER TABLE `commission_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hotel_services`
--
ALTER TABLE `hotel_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=458;

--
-- AUTO_INCREMENT cho bảng `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT cho bảng `room_type_variants`
--
ALTER TABLE `room_type_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT cho bảng `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `amenities`
--
ALTER TABLE `amenities`
  ADD CONSTRAINT `amenities_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `amenities` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `booking_combos`
--
ALTER TABLE `booking_combos`
  ADD CONSTRAINT `booking_combos_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_combos_combo_id_foreign` FOREIGN KEY (`combo_id`) REFERENCES `combos` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_details_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `booking_details_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_details_room_type_variant_id_foreign` FOREIGN KEY (`room_type_variant_id`) REFERENCES `room_type_variants` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `booking_services`
--
ALTER TABLE `booking_services`
  ADD CONSTRAINT `booking_services_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_services_hotel_service_id_foreign` FOREIGN KEY (`hotel_service_id`) REFERENCES `hotel_services` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `combos`
--
ALTER TABLE `combos`
  ADD CONSTRAINT `combos_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `combo_services`
--
ALTER TABLE `combo_services`
  ADD CONSTRAINT `combo_services_combo_id_foreign` FOREIGN KEY (`combo_id`) REFERENCES `combos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `combo_services_hotel_service_id_foreign` FOREIGN KEY (`hotel_service_id`) REFERENCES `hotel_services` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hotel_amenities`
--
ALTER TABLE `hotel_amenities`
  ADD CONSTRAINT `hotel_amenities_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hotel_amenities_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hotel_rules`
--
ALTER TABLE `hotel_rules`
  ADD CONSTRAINT `hotel_rules_id_foreign` FOREIGN KEY (`id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hotel_services`
--
ALTER TABLE `hotel_services`
  ADD CONSTRAINT `hotel_services_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hotel_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `notification_user`
--
ALTER TABLE `notification_user`
  ADD CONSTRAINT `notification_user_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD CONSTRAINT `room_types_bed_type_id_foreign` FOREIGN KEY (`bed_type_id`) REFERENCES `bed_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `room_types_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  ADD CONSTRAINT `room_type_amenities_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_type_amenities_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room_type_season_prices`
--
ALTER TABLE `room_type_season_prices`
  ADD CONSTRAINT `room_type_season_prices_room_type_variant_id_foreign` FOREIGN KEY (`room_type_variant_id`) REFERENCES `room_type_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_type_season_prices_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room_type_variants`
--
ALTER TABLE `room_type_variants`
  ADD CONSTRAINT `room_type_variants_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `variant_attributes`
--
ALTER TABLE `variant_attributes`
  ADD CONSTRAINT `variant_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variant_attributes_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `room_type_variants` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `voucher_hotels`
--
ALTER TABLE `voucher_hotels`
  ADD CONSTRAINT `voucher_hotels_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voucher_hotels_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `voucher_user`
--
ALTER TABLE `voucher_user`
  ADD CONSTRAINT `voucher_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voucher_user_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
