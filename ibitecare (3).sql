-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 03:00 PM
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
-- Database: `ibitecare`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `albay_patient_report`
-- (See below for the actual view)
--
CREATE TABLE `albay_patient_report` (
`year` int(4)
,`quarter` int(1)
,`Localities` varchar(255)
,`patient_count` bigint(21)
,`male_count` decimal(22,0)
,`female_count` decimal(22,0)
,`age_0_17` decimal(22,0)
,`age_18_64` decimal(22,0)
,`age_65_plus` decimal(22,0)
,`dog_count` decimal(22,0)
,`cat_count` decimal(22,0)
,`others_count` decimal(22,0)
,`bite_cat_1` decimal(22,0)
,`bite_cat_2` decimal(22,0)
,`bite_cat_3` decimal(22,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `animal_profile`
--

CREATE TABLE `animal_profile` (
  `id` bigint(12) UNSIGNED NOT NULL,
  `species` varchar(255) NOT NULL,
  `clinical_status` enum('Healthy','Sick','Died','Killed','Lost') NOT NULL,
  `ownership_status` enum('Owned','Neighbor','Stray') NOT NULL,
  `brain_exam` varchar(255) DEFAULT NULL,
  `brain_exam_location` varchar(255) DEFAULT NULL,
  `brain_exam_results` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal_profile`
--

INSERT INTO `animal_profile` (`id`, `species`, `clinical_status`, `ownership_status`, `brain_exam`, `brain_exam_location`, `brain_exam_results`, `created_at`, `updated_at`) VALUES
(28, 'Cat', 'Healthy', 'Owned', NULL, NULL, NULL, '2025-10-15 20:16:50', '2025-10-15 20:16:50'),
(29, 'Cat', 'Healthy', 'Owned', NULL, NULL, NULL, '2025-10-17 04:06:12', '2025-10-17 04:06:12'),
(30, 'Cat', 'Healthy', 'Owned', NULL, NULL, NULL, '2025-10-17 04:17:15', '2025-10-20 11:34:50'),
(32, 'Cat', 'Healthy', 'Owned', NULL, NULL, NULL, '2025-10-18 05:05:20', '2025-10-18 05:05:20'),
(33, 'Cat', 'Healthy', 'Owned', NULL, NULL, NULL, '2025-10-18 05:21:31', '2025-10-18 05:21:31'),
(34, 'Cat', 'Healthy', 'Owned', NULL, NULL, NULL, '2025-10-18 06:08:12', '2025-10-18 06:08:12'),
(35, 'Cat', 'Healthy', 'Owned', NULL, NULL, NULL, '2025-10-24 05:01:49', '2025-10-24 05:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_slots`
--

CREATE TABLE `appointment_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `max_bookings` int(11) DEFAULT 5,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_slots`
--

INSERT INTO `appointment_slots` (`id`, `start_time`, `end_time`, `max_bookings`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '09:00:00', '10:00:00', 5, 1, '2025-10-24 05:50:24', '2025-10-24 05:50:24'),
(2, '10:00:00', '11:00:00', 5, 1, '2025-10-24 05:50:24', '2025-10-24 05:50:24'),
(3, '11:00:00', '12:00:00', 5, 1, '2025-10-24 05:50:24', '2025-10-24 05:50:24'),
(4, '13:00:00', '14:00:00', 5, 1, '2025-10-24 05:50:24', '2025-10-24 05:50:24'),
(5, '14:00:00', '15:00:00', 5, 1, '2025-10-24 05:50:24', '2025-10-24 05:50:24'),
(6, '15:00:00', '16:00:00', 5, 1, '2025-10-24 05:50:24', '2025-10-24 05:50:24');

-- --------------------------------------------------------

--
-- Stand-in structure for view `barangay_patient_report`
-- (See below for the actual view)
--
CREATE TABLE `barangay_patient_report` (
`year` int(4)
,`quarter` int(1)
,`barangay` varchar(255)
,`patient_count` bigint(21)
,`male_count` bigint(21)
,`female_count` bigint(21)
,`age_0_17` bigint(21)
,`age_18_64` bigint(21)
,`age_65_plus` bigint(21)
,`dog_count` bigint(21)
,`cat_count` bigint(21)
,`others_count` bigint(21)
,`bite_cat_1` bigint(21)
,`bite_cat_2` bigint(21)
,`bite_cat_3` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('ada|127.0.0.1', 'i:1;', 1761186886),
('ada|127.0.0.1:timer', 'i:1761186886;', 1761186886),
('dsa@gmail.com|127.0.0.1', 'i:1;', 1761186880),
('dsa@gmail.com|127.0.0.1:timer', 'i:1761186880;', 1761186880),
('johndoe12@gmail.com|127.0.0.1', 'i:1;', 1761186938),
('johndoe12@gmail.com|127.0.0.1:timer', 'i:1761186938;', 1761186938);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `immunity_type` varchar(255) DEFAULT NULL,
  `service` int(20) UNSIGNED DEFAULT NULL,
  `stock_status` varchar(255) NOT NULL,
  `last_restocked_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_items`
--

INSERT INTO `inventory_items` (`id`, `category`, `brand_name`, `product_type`, `immunity_type`, `service`, `stock_status`, `last_restocked_date`, `created_at`, `updated_at`) VALUES
(1, 'Vaccine', 'Abhayrab', 'PVRV', 'Active', NULL, 'Low Stock', '2025-08-22 00:00:00', '2025-08-22 13:00:52', '2025-10-18 05:27:23'),
(2, 'Vaccine', 'Speeda', 'PVRV', 'Active', NULL, 'In Stock', '2025-08-23 00:00:00', '2025-08-23 13:11:52', '2025-10-18 05:27:25'),
(3, 'RIG', 'Equirab', 'ERIG', 'Passive', NULL, 'In Stock', '2025-08-24 00:00:00', '2025-08-24 15:03:52', '2025-08-28 05:05:32'),
(4, 'RIG', 'Vinrab', 'ERIG', 'Passive', NULL, 'In Stock', '2025-08-24 04:00:00', '2025-08-24 13:00:52', '2025-08-28 05:05:39'),
(5, 'Supply', 'Syringes 1ml', 'Syringe', NULL, NULL, 'In Stock', '2025-08-25 00:00:00', '2025-08-25 13:03:52', '2025-10-18 06:35:31'),
(6, 'Supply', 'CottonSoft 50g', 'Cotton', NULL, NULL, 'In Stock', '2025-08-26 05:00:00', '2025-08-26 13:03:52', '2025-10-18 06:21:12'),
(7, 'Supply', 'Alcohol 70%', 'Disinfectant', NULL, NULL, 'In Stock', '2025-08-27 00:00:00', '2025-08-27 13:03:52', '2025-08-28 05:05:49'),
(25, 'Vaccine', 'Test Product', 'PVRV', 'Active', NULL, 'In Stock', '2025-08-30 02:06:46', '2025-08-29 18:06:46', '2025-08-29 18:06:46'),
(27, 'Anti-Tetanus', 'Tetanus Toxoid', 'TT1', NULL, NULL, 'In Stock', '2025-09-02 01:52:11', '2025-09-01 17:52:11', '2025-09-01 17:52:11'),
(28, 'Vaccine', 'CHIRORAB', 'PCEC', 'Active', NULL, 'In Stock', '2025-09-27 15:16:18', '2025-09-27 07:16:18', '2025-09-27 07:16:18'),
(30, 'Vaccine', 'Engerix B', 'Recombinant', 'Active', 8, 'In Stock', '2025-10-16 09:03:07', '2025-10-16 01:03:07', '2025-10-18 07:24:16');

-- --------------------------------------------------------

--
-- Stand-in structure for view `inventory_records`
-- (See below for the actual view)
--
CREATE TABLE `inventory_records` (
`id` bigint(20) unsigned
,`category` varchar(255)
,`brand_name` varchar(255)
,`product_type` varchar(255)
,`immunity_type` varchar(255)
,`stock_status` varchar(255)
,`total_units` varchar(314)
,`total_unit_remaining` varchar(314)
,`vol_qty_total` varchar(302)
,`vol_qty_remaining` varchar(314)
,`last_restocked_date` datetime
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stocks`
--

CREATE TABLE `inventory_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `package_type` varchar(255) NOT NULL,
  `packages_received` int(20) NOT NULL,
  `items_per_package` int(20) NOT NULL,
  `unit_type` varchar(255) DEFAULT NULL,
  `total_units` int(20) NOT NULL,
  `total_remaining_units` int(20) NOT NULL,
  `total_package_amount` decimal(10,2) NOT NULL,
  `restock_date` datetime NOT NULL,
  `supplier` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stocks`
--

INSERT INTO `inventory_stocks` (`id`, `item_id`, `package_type`, `packages_received`, `items_per_package`, `unit_type`, `total_units`, `total_remaining_units`, `total_package_amount`, `restock_date`, `supplier`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vial', 3, 1, 'pcs', 3, 1, 500.00, '2025-08-28 04:23:38', 'Supplier A', '2025-08-28 02:24:15', '2025-10-18 05:27:23'),
(2, 2, 'Box', 1, 5, 'pcs', 5, 3, 0.00, '2025-08-28 04:24:49', 'Supplier B', '2025-08-28 02:25:14', '2025-10-18 05:27:25'),
(3, 3, 'Vial', 3, 1, 'pcs', 3, 3, 0.00, '2025-08-28 04:25:32', 'Supplier B', '2025-08-28 02:25:50', '2025-08-29 07:07:25'),
(4, 4, 'Box', 1, 5, 'pcs', 5, 5, 0.00, '2025-08-28 04:26:07', 'Supplier B', '2025-08-28 02:26:22', '2025-08-28 02:48:55'),
(5, 5, 'Box', 1, 100, 'pcs', 100, 100, 2000.00, '2025-08-28 04:27:01', 'Supplier A', '2025-08-28 02:27:51', '2025-10-17 22:35:31'),
(7, 7, 'Piece', 1, 1, 'pcs', 1, 1, 0.00, '2025-08-28 04:29:55', 'Supplier A', '2025-08-28 02:30:31', '2025-08-28 02:49:09'),
(33, 25, 'Vial', 2, 1, 'pcs', 2, 1, 1000.00, '2025-08-30 07:03:13', 'Supplier ABC', '2025-08-29 23:03:13', '2025-10-05 21:09:38'),
(35, 6, 'Pack', 2, 40, 'pcs', 40, 39, 4000.00, '2025-08-30 07:08:42', 'Supplier ABC', '2025-08-29 23:08:42', '2025-10-04 18:22:45'),
(36, 27, 'Vial', 4, 1, 'pcs', 4, 3, 800.00, '2025-09-02 01:52:11', 'Supplier ABC', '2025-09-01 17:52:11', '2025-10-18 13:05:20'),
(37, 28, 'Vial', 5, 1, 'pcs', 5, 5, 1300.00, '2025-09-27 15:16:18', 'Supplier ABC', '2025-09-27 07:16:18', '2025-09-27 07:16:18'),
(38, 6, 'Pack', 2, 20, 'pcs', 20, 18, 200.00, '2025-10-05 02:13:09', 'Supplier ABC', '2025-10-04 18:13:09', '2025-10-17 22:27:09'),
(40, 30, 'Vial', 2, 1, 'pcs', 2, 0, 700.00, '2025-10-16 09:03:07', 'Supplier ABC', '2025-10-16 01:03:07', '2025-10-18 07:19:53'),
(41, 30, 'Vial', 1, 1, 'pcs', 1, 0, 150.00, '2025-10-18 07:01:23', 'Supplier ABC', '2025-10-17 23:01:23', '2025-10-18 07:16:12'),
(42, 30, 'Box', 2, 5, 'pcs', 10, 10, 650.00, '2025-10-18 07:22:24', 'Supplier ABC', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(43, 30, 'Vial', 1, 1, 'pcs', 1, 1, 65.00, '2025-10-18 07:24:16', 'Supplier ABC', '2025-10-17 23:24:16', '2025-10-17 23:24:16');

--
-- Triggers `inventory_stocks`
--
DELIMITER $$
CREATE TRIGGER `update_item_stock_status_after_stock_change` AFTER UPDATE ON `inventory_stocks` FOR EACH ROW BEGIN
    DECLARE total_units INT DEFAULT 0;
    DECLARE new_status VARCHAR(20);

    -- Only update when total_remaining_units actually changes
    IF NEW.total_remaining_units <> OLD.total_remaining_units THEN

        -- Sum all remaining units for the same item_id
        SELECT SUM(total_remaining_units)
        INTO total_units
        FROM inventory_stocks
        WHERE item_id = NEW.item_id;

        -- Determine new stock status based on the total
        IF total_units <= 0 THEN
            SET new_status = 'Out of Stock';
        ELSEIF total_units <= 2 THEN
            SET new_status = 'Low Stock';
        ELSE
            SET new_status = 'In Stock';
        END IF;

        -- Update the corresponding inventory item
        UPDATE inventory_items
        SET stock_status = new_status
        WHERE id = NEW.item_id;

    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_item_stock_status_after_stock_insert` AFTER INSERT ON `inventory_stocks` FOR EACH ROW BEGIN
    DECLARE total_units INT DEFAULT 0;
    DECLARE new_status VARCHAR(20);

    -- Recalculate total for the item after new stock is added
    SELECT SUM(total_remaining_units)
    INTO total_units
    FROM inventory_stocks
    WHERE item_id = NEW.item_id;

    IF total_units <= 0 THEN
        SET new_status = 'Out of Stock';
    ELSEIF total_units <= 2 THEN
        SET new_status = 'Low Stock';
    ELSE
        SET new_status = 'In Stock';
    END IF;

    UPDATE inventory_items
    SET stock_status = new_status
    WHERE id = NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_units`
--

CREATE TABLE `inventory_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `package_number` int(20) NOT NULL,
  `unit_number` int(20) NOT NULL,
  `measurement_unit` varchar(255) NOT NULL,
  `unit_volume` decimal(10,2) DEFAULT NULL,
  `remaining_volume` decimal(10,2) DEFAULT NULL,
  `unit_quantity` int(11) DEFAULT NULL,
  `remaining_quantity` int(20) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_units`
--

INSERT INTO `inventory_units` (`id`, `item_id`, `stock_id`, `package_number`, `unit_number`, `measurement_unit`, `unit_volume`, `remaining_volume`, `unit_quantity`, `remaining_quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'ml', 5.00, 1.40, NULL, NULL, 'Opened', '2025-08-25 13:10:00', '2025-10-24 05:01:49'),
(4, 2, 2, 1, 1, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-08-25 13:11:00', '2025-10-18 05:26:57'),
(5, 2, 2, 1, 2, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-08-25 13:11:00', '2025-10-18 05:27:02'),
(6, 2, 2, 1, 3, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-08-25 13:11:00', '2025-10-18 05:27:08'),
(9, 3, 3, 1, 1, 'ml', 5.00, 3.20, NULL, NULL, 'Opened', '2025-08-25 13:12:00', '2025-10-24 05:01:49'),
(10, 3, 3, 2, 2, 'ml', 5.00, 5.00, NULL, NULL, 'sealed', '2025-08-25 13:12:00', '2025-08-29 07:30:15'),
(11, 3, 3, 3, 3, 'ml', 5.00, 5.00, NULL, NULL, 'sealed', '2025-08-25 13:12:00', '2025-08-29 07:30:30'),
(12, 4, 4, 1, 1, 'ml', 5.00, 5.00, NULL, NULL, 'sealed', '2025-08-25 13:13:00', '2025-08-28 02:40:05'),
(13, 4, 4, 1, 2, 'ml', 5.00, 5.00, NULL, NULL, 'sealed', '2025-08-25 13:13:00', '2025-08-28 02:40:11'),
(14, 4, 4, 1, 3, 'ml', 5.00, 5.00, NULL, NULL, 'sealed', '2025-08-25 13:13:00', '2025-08-28 02:40:15'),
(15, 4, 4, 1, 4, 'ml', 5.00, 5.00, NULL, NULL, 'sealed', '2025-08-25 13:13:00', '2025-08-28 02:40:18'),
(16, 4, 4, 1, 5, 'ml', 5.00, 5.00, NULL, NULL, 'sealed', '2025-08-25 13:13:00', '2025-08-28 02:40:21'),
(17, 5, 5, 1, 1, 'pcs', NULL, NULL, 100, 100, 'Opened', '2025-08-25 13:14:00', '2025-10-17 22:35:31'),
(97, 25, 33, 1, 1, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-08-29 23:03:13', '2025-08-29 23:03:13'),
(100, 6, 35, 1, 1, 'pcs', NULL, NULL, 40, 39, 'Opened', '2025-08-29 23:08:42', '2025-10-17 22:30:31'),
(101, 27, 36, 1, 1, 'ml', 5.00, 0.00, NULL, NULL, 'Used', '2025-09-01 17:52:11', '2025-10-18 05:05:20'),
(102, 27, 36, 2, 2, 'ml', 5.00, 4.20, NULL, NULL, 'Opened', '2025-09-01 17:52:11', '2025-10-24 05:01:49'),
(103, 27, 36, 3, 3, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-09-01 17:52:11', '2025-09-01 17:52:11'),
(104, 27, 36, 4, 4, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-09-01 17:52:11', '2025-09-01 17:52:11'),
(105, 28, 37, 1, 1, 'ml', 5.00, 4.80, NULL, NULL, 'Opened', '2025-09-27 07:16:18', '2025-10-15 21:15:09'),
(106, 28, 37, 2, 2, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-09-27 07:16:18', '2025-09-27 07:16:18'),
(107, 28, 37, 3, 3, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-09-27 07:16:18', '2025-09-27 07:16:18'),
(108, 28, 37, 4, 4, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-09-27 07:16:18', '2025-09-27 07:16:18'),
(109, 28, 37, 5, 5, 'ml', 5.00, 5.00, NULL, NULL, 'Sealed', '2025-09-27 07:16:18', '2025-09-27 07:16:18'),
(110, 6, 38, 2, 1, 'pcs', NULL, NULL, 20, 18, 'Opened', '2025-10-04 18:13:09', '2025-10-17 22:30:35'),
(121, 30, 40, 1, 1, 'ml', 5.00, 4.00, NULL, NULL, 'Disposed', '2025-10-16 01:03:07', '2025-10-17 23:14:51'),
(122, 30, 40, 2, 2, 'ml', 5.00, 5.00, NULL, NULL, 'Disposed', '2025-10-16 01:03:07', '2025-10-17 23:19:53'),
(123, 30, 41, 1, 1, 'ml', 2.50, 0.00, NULL, NULL, 'Used', '2025-10-17 23:01:23', '2025-10-17 23:16:12'),
(124, 30, 42, 1, 1, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(125, 30, 42, 1, 2, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(126, 30, 42, 1, 3, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(127, 30, 42, 1, 4, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(128, 30, 42, 1, 5, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(129, 30, 42, 2, 1, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(130, 30, 42, 2, 2, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(131, 30, 42, 2, 3, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(132, 30, 42, 2, 4, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(133, 30, 42, 2, 5, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:22:24', '2025-10-17 23:22:24'),
(134, 30, 43, 1, 1, 'ml', 2.50, 2.50, NULL, NULL, 'Sealed', '2025-10-17 23:24:16', '2025-10-17 23:24:16');

--
-- Triggers `inventory_units`
--
DELIMITER $$
CREATE TRIGGER `update_stock_remaining_after_unit_change` AFTER UPDATE ON `inventory_units` FOR EACH ROW BEGIN
    DECLARE used_count INT DEFAULT 0;
    DECLARE total_remaining INT DEFAULT 0;

    -- Only run if unit status changes to used or discard
    IF NEW.status IN ('Used', 'Disposed') THEN

        -- Count all used/discarded units under this stock
        SELECT COUNT(*) INTO used_count
        FROM inventory_units
        WHERE stock_id = NEW.stock_id
          AND status IN ('Used', 'Disposed');

        -- Get total remaining units from inventory_stocks
        SELECT total_remaining_units INTO total_remaining
        FROM inventory_stocks
        WHERE id = NEW.stock_id;

        -- Update remaining count
        UPDATE inventory_stocks
        SET total_remaining_units = GREATEST(total_remaining - used_count, 0)
        WHERE id = NEW.stock_id;

    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_usage`
--

CREATE TABLE `inventory_usage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `used` decimal(10,2) DEFAULT NULL,
  `measurement_unit` varchar(255) DEFAULT NULL,
  `usage_date` datetime NOT NULL DEFAULT current_timestamp(),
  `used_by` bigint(20) UNSIGNED NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_usage`
--

INSERT INTO `inventory_usage` (`id`, `unit_id`, `used`, `measurement_unit`, `usage_date`, `used_by`, `details`, `created_at`, `updated_at`) VALUES
(39, 1, 0.20, 'ml', '2025-10-12 11:27:55', 14, 'Used for Rabies vaccination for patient Timmy Wood', '2025-10-12 03:27:55', '2025-10-12 03:27:55'),
(40, 1, 0.20, 'ml', '2025-10-12 11:46:49', 14, 'Used for Rabies vaccination for patient Timmy Wood', '2025-10-12 03:46:49', '2025-10-12 03:46:49'),
(41, 1, 0.20, 'ml', '2025-10-12 12:16:43', 14, 'Used for Rabies vaccination for patient Timmy Wood', '2025-10-12 04:16:43', '2025-10-12 04:16:43'),
(42, 1, 0.20, 'ml', '2025-10-12 12:27:05', 14, 'Used for Rabies vaccination for patient Timmy Wood', '2025-10-12 04:27:05', '2025-10-12 04:27:05'),
(43, 101, 0.50, 'ml', '2025-10-12 12:35:59', 14, 'Used for Anti-Tetanus vaccination for patient Timmy Wood', '2025-10-12 04:35:59', '2025-10-12 04:35:59'),
(44, 1, 0.20, 'ml', '2025-10-12 12:35:59', 14, 'Used for Rabies vaccination for patient Timmy Wood', '2025-10-12 04:35:59', '2025-10-12 04:35:59'),
(45, 9, 0.20, 'ml', '2025-10-12 12:35:59', 14, 'Used for RIG administration for patient Timmy Wood', '2025-10-12 04:35:59', '2025-10-12 04:35:59'),
(46, 101, 0.50, 'ml', '2025-10-13 13:17:01', 14, 'Used for Anti-Tetanus vaccination for patient John Doe', '2025-10-13 05:17:01', '2025-10-13 05:17:01'),
(47, 101, 0.50, 'ml', '2025-10-13 13:41:08', 14, 'Used for Anti-Tetanus vaccination for patient John Doe', '2025-10-13 05:41:08', '2025-10-13 05:41:08'),
(48, 1, 0.20, 'ml', '2025-10-13 13:41:08', 14, 'Used for Rabies vaccination for patient John Doe', '2025-10-13 05:41:08', '2025-10-13 05:41:08'),
(49, 9, 0.20, 'ml', '2025-10-13 13:41:08', 14, 'Used for RIG administration for patient John Doe', '2025-10-13 05:41:08', '2025-10-13 05:41:08'),
(50, 101, 0.50, 'ml', '2025-10-13 14:22:43', 14, 'Used for Anti-Tetanus vaccination for patient Mark Doe', '2025-10-13 06:22:43', '2025-10-13 06:22:43'),
(51, 1, 0.20, 'ml', '2025-10-16 03:58:57', 14, 'Used for Rabies vaccination for patient Mark Doe', '2025-10-15 19:58:57', '2025-10-15 19:58:57'),
(52, 101, 0.50, 'ml', '2025-10-16 04:16:50', 14, 'Used for Anti-Tetanus vaccination for patient John Doe', '2025-10-15 20:16:50', '2025-10-15 20:16:50'),
(53, 1, 0.20, 'ml', '2025-10-16 04:16:50', 14, 'Used for Rabies vaccination for patient John Doe', '2025-10-15 20:16:50', '2025-10-15 20:16:50'),
(54, 9, 0.20, 'ml', '2025-10-16 04:16:50', 14, 'Used for RIG administration for patient John Doe', '2025-10-15 20:16:50', '2025-10-15 20:16:50'),
(55, 101, 0.50, 'ml', '2025-10-16 04:21:20', 14, 'Used for Anti-Tetanus vaccination for patient Mark Barreda', '2025-10-15 20:21:20', '2025-10-15 20:21:20'),
(56, 105, 0.20, 'ml', '2025-10-16 05:15:09', 14, 'Used for Rabies vaccination for patient Mark Barreda', '2025-10-15 21:15:09', '2025-10-15 21:15:09'),
(57, 101, 0.50, 'ml', '2025-10-16 06:10:19', 14, 'Used for Anti-Tetanus vaccination for patient Mark Barreda', '2025-10-15 22:10:19', '2025-10-15 22:10:19'),
(58, 121, 0.40, 'ml', '2025-10-16 13:11:32', 14, 'Used for Hepatitis B vaccination for patient Jeron Rengie', '2025-10-16 05:11:32', '2025-10-16 05:11:32'),
(59, 121, 0.20, 'ml', '2025-10-16 13:56:14', 14, 'Used for Hepatitis B vaccination for patient Jeron Rengie', '2025-10-16 05:56:14', '2025-10-16 05:56:14'),
(60, 101, 0.20, 'ml', '2025-10-17 20:03:00', 14, 'Used for Anti-Tetanus vaccination for patient Jervy Morales', '2025-10-17 04:06:12', '2025-10-17 04:06:12'),
(61, 1, 0.20, 'ml', '2025-10-17 20:03:00', 14, 'Used for Rabies vaccination for patient Jervy Morales', '2025-10-17 04:06:12', '2025-10-17 04:06:12'),
(62, 101, 0.20, 'ml', '2025-10-17 20:13:00', 14, 'Used for Anti-Tetanus vaccination for patient Jerome Morales', '2025-10-17 04:17:16', '2025-10-17 04:17:16'),
(63, 1, 0.20, 'ml', '2025-10-17 20:13:00', 14, 'Used for Rabies vaccination for patient Jerome Morales', '2025-10-17 04:17:16', '2025-10-17 04:17:16'),
(64, 9, 0.20, 'ml', '2025-10-17 12:17:16', 14, 'Used for RIG administration for patient Jerome Morales', '2025-10-17 04:17:16', '2025-10-17 04:17:16'),
(65, 1, 0.20, 'ml', '2025-10-17 20:44:00', 14, 'Used for Rabies vaccination for patient Jerome Morales', '2025-10-17 04:45:08', '2025-10-17 04:45:08'),
(66, 101, 0.30, 'ml', '2025-10-17 21:31:00', 14, 'Used for Anti-Tetanus vaccination for patient Juan Dela Cruz', '2025-10-17 05:32:56', '2025-10-17 05:32:56'),
(67, 121, 0.20, 'ml', '2025-10-17 14:16:41', 14, 'Used for Hepatitis B vaccination for patient Juan Dela Cruz', '2025-10-17 06:16:41', '2025-10-17 06:16:41'),
(68, 1, 0.20, 'ml', '2025-10-18 12:24:00', 14, 'Used for Rabies vaccination for patient Jerome Morales', '2025-10-17 20:25:27', '2025-10-17 20:25:27'),
(69, 121, 0.20, 'ml', '2025-10-18 15:06:00', 14, 'Used for Hepatitis B vaccination for patient Tupac Meate', '2025-10-17 23:07:01', '2025-10-17 23:07:01'),
(70, 123, 2.50, 'ml', '2025-10-18 07:08:29', 14, 'Used for Hepatitis B vaccination for patient Tupac Meate', '2025-10-17 23:08:29', '2025-10-17 23:08:29'),
(71, 123, 2.50, 'ml', '2025-10-18 07:16:12', 14, 'Used for Hepatitis B vaccination for patient Tupac Meate', '2025-10-17 23:16:12', '2025-10-17 23:16:12'),
(72, 101, 0.30, 'ml', '2025-10-18 21:04:00', 14, 'Used for Anti-Tetanus vaccination for patient Jeriko Dela Cruz', '2025-10-18 05:05:20', '2025-10-18 05:05:20'),
(73, 1, 0.20, 'ml', '2025-10-18 21:04:00', 14, 'Used for Rabies vaccination for patient Jeriko Dela Cruz', '2025-10-18 05:05:20', '2025-10-18 05:05:20'),
(74, 9, 0.20, 'ml', '2025-10-18 21:04:00', 14, 'Used for RIG administration for patient Jeriko Dela Cruz', '2025-10-18 05:05:20', '2025-10-18 05:05:20'),
(75, 102, 0.20, 'ml', '2025-10-18 21:20:00', 14, 'Used for Anti-Tetanus vaccination for patient Krishna Oabina', '2025-10-18 05:21:31', '2025-10-18 05:21:31'),
(76, 1, 0.20, 'ml', '2025-10-18 21:20:00', 14, 'Used for Rabies vaccination for patient Krishna Oabina', '2025-10-18 05:21:31', '2025-10-18 05:21:31'),
(77, 9, 0.20, 'ml', '2025-10-18 21:20:00', 14, 'Used for RIG administration for patient Krishna Oabina', '2025-10-18 05:21:31', '2025-10-18 05:21:31'),
(78, 102, 0.20, 'ml', '2025-10-18 22:06:00', 14, 'Used for Anti-Tetanus vaccination for patient Danica Oabina', '2025-10-18 06:08:13', '2025-10-18 06:08:13'),
(79, 1, 0.20, 'ml', '2025-10-18 22:06:00', 14, 'Used for Rabies vaccination for patient Danica Oabina', '2025-10-18 06:08:13', '2025-10-18 06:08:13'),
(80, 9, 0.20, 'ml', '2025-10-18 22:06:00', 14, 'Used for RIG administration for patient Danica Oabina', '2025-10-18 06:08:13', '2025-10-18 06:08:13'),
(81, 102, 0.20, 'ml', '2025-10-22 20:50:00', 14, 'Used for Anti-Tetanus vaccination for patient Francine Collantes', '2025-10-22 04:53:13', '2025-10-22 04:53:13'),
(82, 102, 0.20, 'ml', '2025-10-24 20:57:00', 14, 'Used for Anti-Tetanus vaccination for patient Jalen Williams', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(83, 1, 0.20, 'ml', '2025-10-24 20:57:00', 14, 'Used for Rabies vaccination for patient Jalen Williams', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(84, 9, 0.20, 'ml', '2025-10-24 20:57:00', 14, 'Used for RIG administration for patient Jalen Williams', '2025-10-24 05:01:49', '2025-10-24 05:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `immunization_sched_id` bigint(20) UNSIGNED DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `day_label` varchar(255) DEFAULT NULL,
  `scheduled_send_date` date DEFAULT NULL,
  `display_message` text NOT NULL,
  `message_text` text NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `patient_id`, `immunization_sched_id`, `schedule`, `day_label`, `scheduled_send_date`, `display_message`, `message_text`, `sender_id`, `status`, `created_at`, `updated_at`) VALUES
(17, 79, 169, '2025-10-21', 'D3', '2025-10-19', 'Reminder: your D3 PEP dose is on Oct 21, 2025.', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your PEP schedule on Oct 21, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-18 06:08:12', '2025-10-24 12:56:49'),
(18, 79, 169, '2025-10-21', 'D3', '2025-10-21', 'Today is your PEP dose (D3).', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your PEP schedule today, Oct 21, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-18 06:08:12', '2025-10-24 12:56:40'),
(19, 79, 170, '2025-10-25', 'D7', '2025-10-23', 'Reminder: your D7 PEP dose is on Oct 25, 2025.', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your PEP schedule on Oct 25, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-18 06:08:12', '2025-10-19 12:13:19'),
(20, 79, 170, '2025-10-25', 'D7', '2025-10-25', 'Today is your PEP dose (D7).', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your PEP schedule today, Oct 25, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-18 06:08:12', '2025-10-18 06:08:12'),
(21, 79, 171, '2025-11-01', 'D14', '2025-10-30', 'Reminder: your D14 PEP dose is on Nov 1, 2025.', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your PEP schedule on Nov 1, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-18 06:08:12', '2025-10-18 06:08:12'),
(22, 79, 171, '2025-11-01', 'D14', '2025-11-01', 'Today is your PEP dose (D14).', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your PEP schedule today, Nov 1, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-18 06:08:12', '2025-10-21 09:54:54'),
(23, 79, 172, '2025-11-15', 'D28', '2025-11-13', 'Reminder: your D28 PEP dose is on Nov 15, 2025.', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your PEP schedule on Nov 15, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-18 06:08:12', '2025-10-18 06:08:12'),
(24, 79, 172, '2025-11-15', 'D28', '2025-11-15', 'Today is your PEP dose (D28).', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your PEP schedule today, Nov 15, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-18 06:08:12', '2025-10-18 06:08:12'),
(25, 81, 174, '2025-10-27', 'D3', '2025-10-25', 'Reminder: your (D3) PEP dose is on Oct 27, 2025.', 'Good day! This is Dr. Care ABC Guinobatan reminding you of your (D3) PEP schedule on Oct 27, 2025. Clinic hours: 8AM to 5PM. Thank you!', NULL, 'Pending', '2025-10-24 05:01:49', '2025-10-24 13:07:18'),
(26, 81, 174, '2025-10-27', 'D3', '2025-10-27', 'Today is your PEP dose (D3).', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your (D3) PEP schedule today, Oct 27, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(27, 81, 175, '2025-10-31', 'D7', '2025-10-29', 'Reminder: your (D7) PEP dose is on Oct 31, 2025.', 'Good day! This is Dr. Care ABC Guinobatan reminding you of your (D7) PEP schedule on Oct 31, 2025. Clinic hours: 8AM to 5PM. Thank you!', NULL, 'Pending', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(28, 81, 175, '2025-10-31', 'D7', '2025-10-31', 'Today is your PEP dose (D7).', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your (D7) PEP schedule today, Oct 31, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(29, 81, 176, '2025-11-07', 'D14', '2025-11-05', 'Reminder: your (D14) PEP dose is on Nov 7, 2025.', 'Good day! This is Dr. Care ABC Guinobatan reminding you of your (D14) PEP schedule on Nov 7, 2025. Clinic hours: 8AM to 5PM. Thank you!', NULL, 'Pending', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(30, 81, 176, '2025-11-07', 'D14', '2025-11-07', 'Today is your PEP dose (D14).', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your (D14) PEP schedule today, Nov 7, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(31, 81, 177, '2025-11-21', 'D28', '2025-11-19', 'Reminder: your (D28) PEP dose is on Nov 21, 2025.', 'Good day! This is Dr. Care ABC Guinobatan reminding you of your (D28) PEP schedule on Nov 21, 2025. Clinic hours: 8AM to 5PM. Thank you!', NULL, 'Pending', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(32, 81, 177, '2025-11-21', 'D28', '2025-11-21', 'Today is your PEP dose (D28).', 'Good day, Ma\'am/Sir.\nThis is Dr. Care Animal Bite Center Guinobatan reminding you of your (D28) PEP schedule today, Nov 21, 2025.\n\nClinic hours: 8:00 AM to 5:00 PM.\nThank you!', NULL, 'Pending', '2025-10-24 05:01:49', '2025-10-24 05:01:49'),
(33, 72, NULL, NULL, NULL, '2025-10-25', 'TEST', 'test message', NULL, 'Sent', '2025-10-24 19:52:28', '2025-10-24 19:52:28');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_16_022452_create_patient_account__table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_accounts`
--

CREATE TABLE `patient_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `auth_provider` varchar(255) DEFAULT NULL,
  `auth_provider_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_code` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_accounts`
--

INSERT INTO `patient_accounts` (`id`, `name`, `email`, `auth_provider`, `auth_provider_id`, `email_verified_at`, `password`, `two_factor_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'Jake Morales', 'thedemonhunter11@gmail.com', 'google', '106243973741570504902', NULL, '$2y$12$OL20K696wqSG5OnEcTYNcui6IrnYtAMDpDjQ.lpV87BceCyqpw4h2', NULL, NULL, '2025-10-22 23:37:38', '2025-10-22 23:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `patient_appointments`
--

CREATE TABLE `patient_appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_reference` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `treatment_type` varchar(255) NOT NULL,
  `booking_channel` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `additional_notes` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `handled_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_appointments`
--

INSERT INTO `patient_appointments` (`id`, `patient_account_id`, `booking_reference`, `name`, `contact_number`, `email`, `treatment_type`, `booking_channel`, `appointment_date`, `appointment_time`, `additional_notes`, `status`, `handled_by_id`, `created_at`, `updated_at`) VALUES
(2, 8, 'DrCare-20251024-00001', 'Jake Morales', '09669862331', 'thedemonhunter11@gmail.com', 'Post Exposure Prophylaxis', 'online', '2025-10-28', '13:00:00', NULL, 'Pending', NULL, '2025-10-23 21:59:34', '2025-10-25 06:09:35'),
(3, NULL, '', 'John Doe', '09123456677', 'example@gmail.com', 'Post Exposure Prophylaxis', 'Phone Call', '2025-10-27', '14:01:00', 'test', 'Arrived', NULL, '2025-10-24 22:01:27', '2025-10-24 22:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `patient_exposures`
--

CREATE TABLE `patient_exposures` (
  `id` bigint(12) UNSIGNED NOT NULL,
  `patient_id` bigint(12) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `place_of_bite` varchar(255) DEFAULT NULL,
  `type_of_exposure` enum('Bite','Non-Bite') NOT NULL,
  `site_of_bite` varchar(500) NOT NULL,
  `bite_category` bigint(255) NOT NULL,
  `bite_management` varchar(500) DEFAULT NULL,
  `animal_profile_id` bigint(12) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_exposures`
--

INSERT INTO `patient_exposures` (`id`, `patient_id`, `transaction_id`, `date_time`, `place_of_bite`, `type_of_exposure`, `site_of_bite`, `bite_category`, `bite_management`, `animal_profile_id`, `created_at`, `updated_at`) VALUES
(29, 69, 60, '2025-10-16 12:15:00', 'Home', 'Bite', 'forearm-left', 3, 'washed', 28, '2025-10-16 04:16:50', '2025-10-16 04:16:50'),
(30, 72, 66, '2025-10-17 20:04:00', 'Home', 'Non-Bite', 'forearm-left', 2, 'washed', 29, '2025-10-17 12:06:12', '2025-10-17 12:06:12'),
(31, 73, 67, '2025-10-17 20:14:00', 'Home', 'Bite', 'forearm-left', 3, 'washed', 30, '2025-10-17 12:17:16', '2025-10-17 12:17:16'),
(33, 77, 76, '2025-10-18 08:04:00', 'Home', 'Bite', 'forearm-left', 3, 'washed', 32, '2025-10-18 13:05:20', '2025-10-18 13:05:20'),
(34, 78, 77, '2025-10-18 09:20:00', 'Home', 'Bite', 'forearm-left', 3, 'washed', 33, '2025-10-18 13:21:31', '2025-10-18 13:21:31'),
(35, 79, 78, '2025-10-18 10:06:00', 'Home', 'Bite', 'forearm-left', 3, 'washed', 34, '2025-10-18 14:08:12', '2025-10-18 14:08:12'),
(36, 81, 80, '2025-10-24 09:00:00', NULL, 'Bite', 'forearm-left', 3, 'washed', 35, '2025-10-24 13:01:49', '2025-10-24 13:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `patient_immunizations`
--

CREATE TABLE `patient_immunizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(12) UNSIGNED NOT NULL,
  `exposure_id` bigint(12) UNSIGNED DEFAULT NULL,
  `vital_signs_id` bigint(20) UNSIGNED DEFAULT NULL,
  `immunization_type` enum('None','Active','Passive/Active') DEFAULT NULL,
  `date_given` date DEFAULT NULL,
  `day_label` varchar(255) DEFAULT NULL,
  `vaccine_used_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rig_used_id` bigint(20) UNSIGNED DEFAULT NULL,
  `anti_tetanus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `route_of_administration` enum('Intradermal','Intramuscular') NOT NULL,
  `administered_by_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `schedule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_immunizations`
--

INSERT INTO `patient_immunizations` (`id`, `patient_id`, `transaction_id`, `service_id`, `exposure_id`, `vital_signs_id`, `immunization_type`, `date_given`, `day_label`, `vaccine_used_id`, `rig_used_id`, `anti_tetanus_id`, `route_of_administration`, `administered_by_id`, `payment_id`, `schedule_id`, `status`, `created_at`, `updated_at`) VALUES
(43, 69, 60, 1, 29, 53, 'Passive/Active', '2025-10-16', 'D0', 1, 9, 101, 'Intradermal', 14, 39, 139, 'Completed', '2025-10-16 04:16:50', '2025-10-21 13:34:22'),
(44, 70, 61, 4, NULL, 54, 'None', '2025-10-16', NULL, NULL, NULL, 101, 'Intradermal', 14, 40, NULL, 'Completed', '2025-10-16 04:21:20', '2025-10-16 04:21:20'),
(45, 70, 62, 3, NULL, 55, 'Active', '2025-10-16', 'D0', 105, NULL, NULL, 'Intradermal', 14, 41, 144, 'Completed', '2025-10-16 05:15:09', '2025-10-16 05:15:09'),
(46, 70, 63, 4, NULL, 56, 'None', '2025-10-16', NULL, NULL, NULL, 101, 'Intradermal', 14, 42, NULL, 'Completed', '2025-10-16 06:10:19', '2025-10-16 06:10:19'),
(47, 71, 64, 8, NULL, 57, 'Active', '2025-10-16', NULL, 121, NULL, NULL, 'Intradermal', 14, 43, NULL, 'Completed', '2025-10-16 13:11:32', '2025-10-16 13:11:32'),
(48, 71, 65, 8, NULL, 58, 'Active', '2025-10-16', NULL, 121, NULL, NULL, 'Intradermal', 14, 44, NULL, 'Completed', '2025-10-16 13:56:14', '2025-10-16 13:56:14'),
(49, 72, 66, 1, 30, 59, 'Active', '2025-10-17', 'D0', 1, 9, 101, 'Intradermal', 14, 45, 146, 'Completed', '2025-10-17 12:06:12', '2025-10-22 12:29:22'),
(50, 73, 67, 1, 31, 60, 'Passive/Active', '2025-10-17', 'D0', 1, 9, 101, 'Intradermal', 14, 46, 151, 'Completed', '2025-10-17 12:17:16', '2025-10-17 12:17:16'),
(51, 73, 68, 1, 31, 61, 'Passive/Active', '2025-10-17', 'D3', 1, NULL, NULL, 'Intradermal', 14, 47, 152, 'Completed', '2025-10-17 12:45:08', '2025-10-22 12:28:57'),
(52, 74, 69, 4, NULL, 62, 'None', '2025-10-17', NULL, NULL, NULL, 101, 'Intradermal', 14, 48, NULL, 'Completed', '2025-10-17 13:32:56', '2025-10-17 13:32:56'),
(53, 74, 70, 8, NULL, 63, 'Active', '2025-10-17', NULL, 121, NULL, NULL, 'Intradermal', 14, 49, NULL, 'Completed', '2025-10-17 14:16:41', '2025-10-17 14:16:41'),
(54, 73, 71, 1, 31, 64, 'Active', '2025-10-18', 'D7', 1, NULL, NULL, 'Intradermal', 14, 50, 153, 'Completed', '2025-10-18 04:25:27', '2025-10-22 12:37:21'),
(55, 75, 72, 8, NULL, 65, 'Active', '2025-10-18', NULL, 121, NULL, NULL, 'Intradermal', 14, 51, NULL, 'Completed', '2025-10-18 07:07:00', '2025-10-18 07:07:00'),
(56, 75, 73, 8, NULL, 66, 'Active', '2025-10-18', NULL, 123, NULL, NULL, 'Intradermal', 14, 52, NULL, 'Completed', '2025-10-18 07:08:29', '2025-10-18 07:08:29'),
(57, 75, 74, 8, NULL, 67, 'Active', '2025-10-18', NULL, 123, NULL, NULL, 'Intradermal', 14, 53, NULL, 'Completed', '2025-10-18 07:16:12', '2025-10-18 07:16:12'),
(58, 77, 76, 1, 33, 69, 'Passive/Active', '2025-10-18', 'D0', 1, 9, 101, 'Intradermal', 14, 54, 158, 'Completed', '2025-10-18 13:05:20', '2025-10-18 13:05:20'),
(59, 78, 77, 1, 34, 70, 'Passive/Active', '2025-10-18', 'D0', 1, 9, 102, 'Intradermal', 14, 55, 163, 'Completed', '2025-10-18 13:21:31', '2025-10-18 13:21:31'),
(60, 79, 78, 1, 35, 71, 'Passive/Active', '2025-10-18', 'D0', 1, 9, 102, 'Intradermal', 14, 56, 168, 'Completed', '2025-10-18 14:08:12', '2025-10-18 14:08:12'),
(61, 80, 79, 4, NULL, 72, 'None', '2025-10-22', NULL, NULL, NULL, 102, 'Intradermal', 14, 57, NULL, 'Completed', '2025-10-22 12:53:13', '2025-10-22 12:53:13'),
(62, 81, 80, 1, 36, 73, 'Passive/Active', '2025-10-24', 'D0', 1, 9, 102, 'Intradermal', 14, 58, 173, 'Completed', '2025-10-24 13:01:49', '2025-10-24 13:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `patient_immunization_schedule`
--

CREATE TABLE `patient_immunization_schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(12) UNSIGNED NOT NULL,
  `service_sched_id` bigint(12) UNSIGNED DEFAULT NULL,
  `Day` varchar(255) DEFAULT NULL,
  `grouping` int(255) DEFAULT NULL,
  `scheduled_date` date NOT NULL,
  `date_completed` date DEFAULT NULL,
  `dose` decimal(10,2) DEFAULT NULL,
  `administered_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_immunization_schedule`
--

INSERT INTO `patient_immunization_schedule` (`id`, `transaction_id`, `patient_id`, `service_id`, `service_sched_id`, `Day`, `grouping`, `scheduled_date`, `date_completed`, `dose`, `administered_by`, `status`, `created_at`, `updated_at`) VALUES
(139, 60, 69, 1, 1, 'D0', 60, '2025-10-16', '2025-10-16', 0.20, 14, 'Completed', '2025-10-16 04:16:50', '2025-10-16 04:16:50'),
(140, 60, 69, 1, 2, 'D3', 60, '2025-10-19', NULL, NULL, NULL, 'Pending', '2025-10-16 04:16:50', '2025-10-16 04:16:50'),
(141, 60, 69, 1, 3, 'D7', 60, '2025-10-23', NULL, NULL, NULL, 'Pending', '2025-10-16 04:16:50', '2025-10-16 04:16:50'),
(142, 60, 69, 1, 4, 'D14', 60, '2025-10-30', NULL, NULL, NULL, 'Pending', '2025-10-16 04:16:50', '2025-10-16 04:16:50'),
(143, 60, 69, 1, 11, 'D28', 60, '2025-11-13', NULL, NULL, NULL, 'Pending', '2025-10-16 04:16:50', '2025-10-16 04:16:50'),
(144, 62, 70, 3, 9, 'D0', 62, '2025-10-16', '2025-10-16', 0.20, 14, 'Completed', '2025-10-16 05:15:09', '2025-10-16 05:15:09'),
(145, 62, 70, 3, 10, 'D3', 62, '2025-10-19', NULL, NULL, NULL, 'Pending', '2025-10-16 05:15:09', '2025-10-16 05:15:09'),
(146, 66, 72, 1, 1, 'D0', 66, '2025-10-17', '2025-10-17', 0.20, 14, 'Completed', '2025-10-17 12:06:12', '2025-10-17 12:06:12'),
(147, 66, 72, 1, 2, 'D3', 66, '2025-10-20', NULL, NULL, NULL, 'Pending', '2025-10-17 12:06:12', '2025-10-17 12:06:12'),
(148, 66, 72, 1, 3, 'D7', 66, '2025-10-24', NULL, NULL, NULL, 'Pending', '2025-10-17 12:06:12', '2025-10-17 12:06:12'),
(149, 66, 72, 1, 4, 'D14', 66, '2025-10-31', NULL, NULL, NULL, 'Pending', '2025-10-17 12:06:12', '2025-10-17 12:06:12'),
(150, 66, 72, 1, 11, 'D28', 66, '2025-11-14', NULL, NULL, NULL, 'Pending', '2025-10-17 12:06:12', '2025-10-17 12:06:12'),
(151, 67, 73, 1, 1, 'D0', 67, '2025-10-17', '2025-10-17', 0.20, 14, 'Completed', '2025-10-17 12:17:16', '2025-10-17 12:17:16'),
(152, 67, 73, 1, 2, 'D3', 67, '2025-10-20', '2025-10-17', 0.20, 14, 'Completed', '2025-10-17 12:17:16', '2025-10-17 12:45:08'),
(153, 67, 73, 1, 3, 'D7', 67, '2025-10-24', '2025-10-18', 0.20, 14, 'Completed', '2025-10-17 12:17:16', '2025-10-18 04:25:27'),
(154, 67, 73, 1, 4, 'D14', 67, '2025-10-31', NULL, NULL, NULL, 'Pending', '2025-10-17 12:17:16', '2025-10-17 12:17:16'),
(155, 67, 73, 1, 11, 'D28', 67, '2025-11-14', NULL, NULL, NULL, 'Pending', '2025-10-17 12:17:16', '2025-10-17 12:17:16'),
(158, 76, 77, 1, 1, 'D0', 76, '2025-10-18', '2025-10-18', 0.20, 14, 'Completed', '2025-10-18 13:05:20', '2025-10-18 13:05:20'),
(159, 76, 77, 1, 2, 'D3', 76, '2025-10-21', NULL, NULL, NULL, 'Pending', '2025-10-18 13:05:20', '2025-10-18 13:05:20'),
(160, 76, 77, 1, 3, 'D7', 76, '2025-10-25', NULL, NULL, NULL, 'Pending', '2025-10-18 13:05:20', '2025-10-18 13:05:20'),
(161, 76, 77, 1, 4, 'D14', 76, '2025-11-01', NULL, NULL, NULL, 'Pending', '2025-10-18 13:05:20', '2025-10-18 13:05:20'),
(162, 76, 77, 1, 11, 'D28', 76, '2025-11-15', NULL, NULL, NULL, 'Pending', '2025-10-18 13:05:20', '2025-10-18 13:05:20'),
(163, 77, 78, 1, 1, 'D0', 77, '2025-10-18', '2025-10-18', 0.20, 14, 'Completed', '2025-10-18 13:21:31', '2025-10-18 13:21:31'),
(164, 77, 78, 1, 2, 'D3', 77, '2025-10-21', NULL, NULL, NULL, 'Pending', '2025-10-18 13:21:31', '2025-10-18 13:21:31'),
(165, 77, 78, 1, 3, 'D7', 77, '2025-10-25', NULL, NULL, NULL, 'Pending', '2025-10-18 13:21:31', '2025-10-18 13:21:31'),
(166, 77, 78, 1, 4, 'D14', 77, '2025-11-01', NULL, NULL, NULL, 'Pending', '2025-10-18 13:21:31', '2025-10-18 13:21:31'),
(167, 77, 78, 1, 11, 'D28', 77, '2025-11-15', NULL, NULL, NULL, 'Pending', '2025-10-18 13:21:31', '2025-10-18 13:21:31'),
(168, 78, 79, 1, 1, 'D0', 78, '2025-10-18', '2025-10-18', 0.20, 14, 'Completed', '2025-10-18 14:08:12', '2025-10-18 14:08:12'),
(169, 78, 79, 1, 2, 'D3', 78, '2025-10-21', NULL, NULL, NULL, 'Pending', '2025-10-18 14:08:12', '2025-10-18 14:08:12'),
(170, 78, 79, 1, 3, 'D7', 78, '2025-10-25', NULL, NULL, NULL, 'Pending', '2025-10-18 14:08:12', '2025-10-18 14:08:12'),
(171, 78, 79, 1, 4, 'D14', 78, '2025-11-01', NULL, NULL, NULL, 'Pending', '2025-10-18 14:08:12', '2025-10-18 14:08:12'),
(172, 78, 79, 1, 11, 'D28', 78, '2025-11-15', NULL, NULL, NULL, 'Pending', '2025-10-18 14:08:12', '2025-10-18 14:08:12'),
(173, 80, 81, 1, 1, 'D0', 80, '2025-10-24', '2025-10-24', 0.20, 14, 'Completed', '2025-10-24 13:01:49', '2025-10-24 13:01:49'),
(174, 80, 81, 1, 2, 'D3', 80, '2025-10-27', NULL, NULL, NULL, 'Pending', '2025-10-24 13:01:49', '2025-10-24 13:01:49'),
(175, 80, 81, 1, 3, 'D7', 80, '2025-10-31', NULL, NULL, NULL, 'Pending', '2025-10-24 13:01:49', '2025-10-24 13:01:49'),
(176, 80, 81, 1, 4, 'D14', 80, '2025-11-07', NULL, NULL, NULL, 'Pending', '2025-10-24 13:01:49', '2025-10-24 13:01:49'),
(177, 80, 81, 1, 11, 'D28', 80, '2025-11-21', NULL, NULL, NULL, 'Pending', '2025-10-24 13:01:49', '2025-10-24 13:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `patient_previous_anti_rabies`
--

CREATE TABLE `patient_previous_anti_rabies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `immunization_type` varchar(255) DEFAULT NULL,
  `place_of_immunization` text DEFAULT NULL,
  `date_dose_given` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_previous_anti_tetanus`
--

CREATE TABLE `patient_previous_anti_tetanus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `dose_brand` varchar(255) DEFAULT NULL,
  `dose_given` varchar(255) DEFAULT NULL,
  `rn_in_charge` bigint(20) UNSIGNED DEFAULT NULL,
  `date_dose_given` date DEFAULT NULL,
  `year_last_dose_given` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_previous_anti_tetanus`
--

INSERT INTO `patient_previous_anti_tetanus` (`id`, `patient_id`, `dose_brand`, `dose_given`, `rn_in_charge`, `date_dose_given`, `year_last_dose_given`, `created_at`, `updated_at`) VALUES
(30, 69, 'Anti-Tetanus', 'TT1', 14, '2025-10-16', NULL, '2025-10-15 20:16:50', '2025-10-15 20:16:50'),
(31, 70, 'Anti-Tetanus', 'TT1', 14, '2025-10-16', NULL, '2025-10-15 20:21:20', '2025-10-15 20:21:20'),
(32, 70, 'Anti-Tetanus', 'TT1', 14, '2025-10-16', NULL, '2025-10-15 22:10:19', '2025-10-15 22:10:19'),
(33, 72, 'Anti-Tetanus', 'TT1', 14, '2025-10-17', NULL, '2025-10-17 04:06:12', '2025-10-17 04:06:12'),
(34, 73, 'Anti-Tetanus', 'TT1', 14, '2025-10-17', NULL, '2025-10-17 04:17:16', '2025-10-17 04:17:16'),
(35, 74, 'Anti-Tetanus', 'TT1', 14, '2025-10-17', NULL, '2025-10-17 05:32:56', '2025-10-17 05:32:56'),
(37, 77, 'Anti-Tetanus', 'TT1', 14, '2025-10-18', NULL, '2025-10-18 05:05:20', '2025-10-18 05:05:20'),
(38, 78, 'Anti-Tetanus', 'TT1', 14, '2025-10-18', NULL, '2025-10-18 05:21:31', '2025-10-18 05:21:31'),
(39, 79, 'Anti-Tetanus', 'TT1', 14, '2025-10-18', NULL, '2025-10-18 06:08:12', '2025-10-18 06:08:12'),
(40, 80, 'Anti-Tetanus', 'TT1', 14, '2025-10-22', NULL, '2025-10-22 04:53:13', '2025-10-22 04:53:13'),
(41, 81, 'Anti-Tetanus', 'TT1', 14, '2025-10-24', NULL, '2025-10-24 05:01:49', '2025-10-24 05:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `patient_transactions`
--

CREATE TABLE `patient_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(12) UNSIGNED NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `grouping` int(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_transactions`
--

INSERT INTO `patient_transactions` (`id`, `patient_id`, `service_id`, `transaction_date`, `grouping`, `updated_at`, `created_at`) VALUES
(60, 69, 1, '2025-10-16 11:15:00', 60, '2025-10-23 23:35:45', '2025-10-15 20:16:50'),
(61, 70, 4, '2025-10-16 12:20:00', 61, '2025-10-16 04:21:20', '2025-10-15 20:21:20'),
(62, 70, 3, '2025-10-16 13:10:00', 62, '2025-10-16 05:15:09', '2025-10-15 21:15:09'),
(63, 70, 4, '2025-10-16 14:09:00', 63, '2025-10-16 06:10:19', '2025-10-15 22:10:19'),
(64, 71, 8, '2025-10-16 21:09:00', 64, '2025-10-16 13:11:32', '2025-10-16 05:11:32'),
(65, 71, 8, '2025-10-16 21:55:00', 65, '2025-10-16 13:56:14', '2025-10-16 05:56:14'),
(66, 72, 1, '2025-10-17 20:03:00', 66, '2025-10-17 12:06:12', '2025-10-17 04:06:11'),
(67, 73, 1, '2025-10-17 20:13:00', 67, '2025-10-17 12:17:15', '2025-10-17 04:17:15'),
(68, 73, 1, '2025-10-17 20:44:00', 67, '2025-10-17 12:45:08', '2025-10-17 04:45:08'),
(69, 74, 4, '2025-10-17 21:31:00', 69, '2025-10-17 13:32:56', '2025-10-17 05:32:56'),
(70, 74, 8, '2025-10-17 22:15:00', 70, '2025-10-17 14:16:41', '2025-10-17 06:16:41'),
(71, 73, 1, '2025-10-18 12:24:00', 67, '2025-10-18 04:25:27', '2025-10-17 20:25:27'),
(72, 75, 8, '2025-10-18 15:06:00', 72, '2025-10-18 07:07:00', '2025-10-17 23:07:00'),
(73, 75, 8, '2025-10-18 15:08:00', 73, '2025-10-18 07:08:29', '2025-10-17 23:08:29'),
(74, 75, 8, '2025-10-18 15:15:00', 74, '2025-10-18 07:16:12', '2025-10-17 23:16:12'),
(76, 77, 1, '2025-10-18 21:04:00', 76, '2025-10-18 13:05:20', '2025-10-18 05:05:20'),
(77, 78, 1, '2025-10-18 21:20:00', 77, '2025-10-18 13:21:31', '2025-10-18 05:21:31'),
(78, 79, 1, '2025-10-18 22:06:00', 78, '2025-10-18 14:08:12', '2025-10-18 06:08:12'),
(79, 80, 4, '2025-10-22 20:50:00', 79, '2025-10-22 12:53:13', '2025-10-22 04:53:13'),
(80, 81, 1, '2025-10-24 20:57:00', 80, '2025-10-24 13:01:48', '2025-10-24 05:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `patient_vital_signs`
--

CREATE TABLE `patient_vital_signs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(12) UNSIGNED NOT NULL,
  `recorded_date` date NOT NULL DEFAULT current_timestamp(),
  `temperature` decimal(4,1) DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_vital_signs`
--

INSERT INTO `patient_vital_signs` (`id`, `patient_id`, `transaction_id`, `recorded_date`, `temperature`, `blood_pressure`, `weight`, `created_at`, `updated_at`) VALUES
(53, 69, 60, '2025-10-16', 35.7, '120/80', NULL, '2025-10-16 04:16:50', '2025-10-16 04:16:50'),
(54, 70, 61, '2025-10-16', 35.7, '120/80', NULL, '2025-10-16 04:21:20', '2025-10-16 04:21:20'),
(55, 70, 62, '2025-10-16', 35.7, '120/80', NULL, '2025-10-16 05:15:09', '2025-10-16 05:15:09'),
(56, 70, 63, '2025-10-16', 35.7, '120/80', NULL, '2025-10-16 06:10:19', '2025-10-16 06:10:19'),
(57, 71, 64, '2025-10-16', 35.7, '120/80', NULL, '2025-10-16 13:11:32', '2025-10-16 13:11:32'),
(58, 71, 65, '2025-10-16', 36.5, '120/80', NULL, '2025-10-16 13:56:14', '2025-10-16 13:56:14'),
(59, 72, 66, '2025-10-17', 35.7, '120/80', NULL, '2025-10-17 12:06:12', '2025-10-17 12:06:12'),
(60, 73, 67, '2025-10-17', 35.7, '120/80', NULL, '2025-10-17 12:17:15', '2025-10-17 12:17:15'),
(61, 73, 68, '2025-10-17', NULL, NULL, NULL, '2025-10-17 12:45:08', '2025-10-17 12:45:08'),
(62, 74, 69, '2025-10-17', 35.7, '120/80', NULL, '2025-10-17 13:32:56', '2025-10-17 13:32:56'),
(63, 74, 70, '2025-10-17', 36.5, '120/80', NULL, '2025-10-17 14:16:41', '2025-10-17 14:16:41'),
(64, 73, 71, '2025-10-18', NULL, NULL, NULL, '2025-10-18 04:25:27', '2025-10-18 04:25:27'),
(65, 75, 72, '2025-10-18', 35.7, '120/80', NULL, '2025-10-18 07:07:00', '2025-10-18 07:07:00'),
(66, 75, 73, '2025-10-18', NULL, NULL, NULL, '2025-10-18 07:08:29', '2025-10-18 07:08:29'),
(67, 75, 74, '2025-10-18', NULL, NULL, NULL, '2025-10-18 07:16:12', '2025-10-18 07:16:12'),
(69, 77, 76, '2025-10-18', 35.7, '120/80', NULL, '2025-10-18 13:05:20', '2025-10-18 13:05:20'),
(70, 78, 77, '2025-10-18', 35.7, '120/80', NULL, '2025-10-18 13:21:31', '2025-10-18 13:21:31'),
(71, 79, 78, '2025-10-18', 35.7, '120/80', NULL, '2025-10-18 14:08:12', '2025-10-18 14:08:12'),
(72, 80, 79, '2025-10-22', 36.5, '120/80', NULL, '2025-10-22 12:53:13', '2025-10-22 12:53:13'),
(73, 81, 80, '2025-10-24', 36.5, '120/80', NULL, '2025-10-24 13:01:49', '2025-10-24 13:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `payment_invoice`
--

CREATE TABLE `payment_invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` bigint(20) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `issued_by_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_records`
--

CREATE TABLE `payment_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `received_by_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_records`
--

INSERT INTO `payment_records` (`id`, `transaction_id`, `patient_id`, `receipt_number`, `amount_paid`, `received_by_id`, `payment_date`, `created_at`, `updated_at`) VALUES
(39, 60, 69, '2025-74539840', 600.00, 4, '2025-10-16', '2025-10-15 20:16:50', '2025-10-23 15:32:33'),
(40, 61, 70, '2025-95709107', 150.00, 4, '2025-10-16', '2025-10-15 20:21:20', '2025-10-22 09:34:26'),
(41, 62, 70, '2025-88468522', 300.00, 4, '2025-10-16', '2025-10-15 21:15:09', '2025-10-15 21:15:09'),
(42, 63, 70, '2025-92460817', 150.00, 4, '2025-10-16', '2025-10-15 22:10:19', '2025-10-15 22:10:19'),
(43, 64, 71, '2025-78990041', 700.00, 4, '2025-10-16', '2025-10-16 05:11:32', '2025-10-16 05:11:32'),
(44, 65, 71, '2025-96628318', 700.00, 4, '2025-10-16', '2025-10-16 05:56:14', '2025-10-16 05:56:14'),
(45, 66, 72, '2025-09068624', 600.00, 4, '2025-10-17', '2025-10-17 04:06:12', '2025-10-17 04:06:12'),
(46, 67, 73, '2025-62265061', 600.00, 4, '2025-10-17', '2025-10-17 04:17:16', '2025-10-17 04:17:16'),
(47, 68, 73, '2025-30694608', 600.00, 4, '2025-10-17', '2025-10-17 04:45:08', '2025-10-17 04:45:08'),
(48, 69, 74, '2025-02336766', 150.00, 4, '2025-10-17', '2025-10-17 05:32:56', '2025-10-17 05:32:56'),
(49, 70, 74, '2025-23593441', 700.00, 4, '2025-10-17', '2025-10-17 06:16:41', '2025-10-17 06:16:41'),
(50, 71, 73, '2025-75456863', 600.00, 4, '2025-10-18', '2025-10-17 20:25:27', '2025-10-17 20:25:27'),
(51, 72, 75, '2025-29208525', 700.00, 4, '2025-10-18', '2025-10-17 23:07:00', '2025-10-17 23:07:00'),
(52, 73, 75, '2025-80069766', 700.00, 4, '2025-10-18', '2025-10-17 23:08:29', '2025-10-17 23:08:29'),
(53, 74, 75, '2025-10553164', 700.00, 4, '2025-10-18', '2025-10-17 23:16:12', '2025-10-17 23:16:12'),
(54, 76, 77, '2025-98783963', 600.00, 4, '2025-10-18', '2025-10-18 05:05:20', '2025-10-18 05:05:20'),
(55, 77, 78, '2025-49210963', 600.00, 4, '2025-10-18', '2025-10-18 05:21:31', '2025-10-18 05:21:31'),
(56, 78, 79, '2025-50686828', 600.00, 4, '2025-10-18', '2025-10-18 06:08:12', '2025-10-18 06:08:12'),
(57, 79, 80, '2025-60698222', 150.00, 4, '2025-10-22', '2025-10-22 04:53:13', '2025-10-22 04:53:13'),
(58, 80, 81, '2025-62531352', 600.00, 4, '2025-10-24', '2025-10-24 05:01:49', '2025-10-24 05:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `pre_registered_patients`
--

CREATE TABLE `pre_registered_patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `record_id` varchar(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered_patients`
--

CREATE TABLE `registered_patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_initial` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registered_patients`
--

INSERT INTO `registered_patients` (`id`, `first_name`, `middle_initial`, `last_name`, `suffix`, `birthdate`, `age`, `sex`, `contact_number`, `email`, `address`, `registration_date`, `account_id`, `created_at`, `updated_at`) VALUES
(69, 'John', 'K.', 'Doe', NULL, '2004-09-10', 21, 'Male', '0912 345 6677', NULL, 'Albay, Guinobatan, Binogsacan Lower, Purok-2', '2025-10-16', NULL, '2025-10-15 20:16:50', '2025-10-15 20:16:50'),
(70, 'Mark', 'K.', 'Barreda', NULL, '2004-09-18', 21, 'Male', '0966 986 2331', NULL, 'Albay, Guinobatan, Banao, Purok-2', '2025-10-16', NULL, '2025-10-15 20:21:20', '2025-10-20 09:48:04'),
(71, 'Jeron', 'R.', 'Rengie', NULL, '2004-09-10', 21, 'Male', '0966 986 2331', NULL, 'Quezon, Atimonan, Balubad, Purok-2', '2025-10-16', NULL, '2025-10-16 05:11:32', '2025-10-16 05:11:32'),
(72, 'Jervy', 'O.', 'Morales', NULL, '2004-08-12', 21, 'Male', '0966 986 2331', NULL, 'Albay, Jovellar, Rizal Pob. (Bgy. 1), Purok-2', '2025-10-17', NULL, '2025-10-17 04:06:11', '2025-10-17 04:06:11'),
(73, 'Jerome', 'D.', 'Morales', NULL, '2004-08-12', 21, 'Male', '0918 232 1321', NULL, 'Albay, Guinobatan, Banao, Purok-2', '2025-10-17', NULL, '2025-10-17 04:17:15', '2025-10-17 04:17:15'),
(74, 'Juan', 'O.', 'Dela Cruz', NULL, '1999-09-20', 26, 'Male', '0966 986 2331', NULL, 'Bulacan, Baliuag, Barangca, Purok 2', '2025-10-17', NULL, '2025-10-17 05:32:55', '2025-10-17 05:32:55'),
(75, 'Tupac', 'O.', 'Meate', NULL, '2003-09-10', 22, 'Male', '0966 986 2331', NULL, 'Isabela, Aurora, Bagnos, Purok-2', '2025-10-18', NULL, '2025-10-17 23:07:00', '2025-10-17 23:07:00'),
(77, 'Jeriko', 'R.', 'Dela Cruz', NULL, '2003-09-10', 22, 'Male', '0966 986 2331', NULL, 'Ilocos Sur, Banayoyo, Bagbagotot, Purok-2', '2025-10-18', NULL, '2025-10-18 05:05:20', '2025-10-18 05:05:20'),
(78, 'Krishna', 'R.', 'Oabina', NULL, '2003-09-10', 22, 'Male', '0966 986 2331', NULL, 'Albay, Guinobatan, Muladbucad Grande, Purok-2', '2025-10-18', NULL, '2025-10-18 05:21:31', '2025-10-20 03:55:44'),
(79, 'Danica', 'R.', 'Oabina', NULL, '2003-09-10', 22, 'Female', '0966 986 2331', NULL, 'Albay, Guinobatan, Muladbucad Grande, Purok-2', '2025-10-18', NULL, '2025-10-18 06:08:12', '2025-10-22 11:45:17'),
(80, 'Francine', 'L.', 'Collantes', NULL, '2008-08-28', 17, 'Female', '0954 674 5679', 'francine@gmail.com', 'Albay, Guinobatan, Maguiron, Purok-2', '2025-10-22', NULL, '2025-10-22 04:53:13', '2025-10-22 05:09:00'),
(81, 'Jalen', 'K.', 'Williams', NULL, '1990-09-18', 35, 'Male', '0991 686 3623', 'jervyjakemorales07@gmail.com', 'Albay, Guinobatan, Masarawag, Purok-2', '2025-10-24', NULL, '2025-10-24 05:01:48', '2025-10-24 05:01:48');

-- --------------------------------------------------------

--
-- Stand-in structure for view `revenue_expense_summary`
-- (See below for the actual view)
--
CREATE TABLE `revenue_expense_summary` (
`year` int(4)
,`month` varchar(9)
,`total_revenue` decimal(32,2)
,`total_expenses` decimal(32,2)
,`income` decimal(33,2)
,`loss` decimal(33,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(12) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `service_fee` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `service_fee`, `created_at`, `updated_at`) VALUES
(1, 'Post Exposure Prophylaxis', 'Given After an Animal Bite or Scratch, Days 0, 3, 7, 14, and 28', 600.00, '2025-07-30 22:30:17', '2025-09-06 13:02:03'),
(2, 'Pre-Exposure Prophylaxis', 'Given Before Exposure to a Potential Rabid Animal. Day 0, Day 7 and Day 28', 600.00, '2025-07-30 22:30:17', '2025-09-06 15:17:48'),
(3, 'Booster', 'depends on the patient', 300.00, '2025-07-30 22:30:17', '2025-09-06 15:18:13'),
(4, 'Tetanus Toxoid', 'Anti tetanus', 150.00, '2025-07-30 22:30:17', '2025-10-05 16:59:26'),
(8, 'Hepatitis B', 'Hepatitis B Services', 700.00, '2025-10-16 08:08:27', '2025-10-16 08:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `services_schedules`
--

CREATE TABLE `services_schedules` (
  `id` bigint(12) UNSIGNED NOT NULL,
  `service_id` bigint(12) UNSIGNED NOT NULL,
  `day_offset` int(12) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_schedules`
--

INSERT INTO `services_schedules` (`id`, `service_id`, `day_offset`, `label`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'D0', '2025-09-06 13:13:12', '2025-10-12 03:25:59'),
(2, 1, 3, 'D3', '2025-09-06 13:13:12', '2025-10-12 11:26:12'),
(3, 1, 7, 'D7', '2025-09-06 13:13:12', '2025-10-12 11:26:16'),
(4, 1, 14, 'D14', '2025-09-06 13:13:12', '2025-10-12 11:26:20'),
(6, 2, 0, 'D0', '2025-09-06 13:13:12', '2025-10-12 11:26:24'),
(7, 2, 7, 'D7', '2025-09-06 13:13:12', '2025-10-12 11:26:27'),
(8, 2, 28, 'D28', '2025-09-06 13:13:12', '2025-10-12 11:26:35'),
(9, 3, 0, 'D0', '2025-09-06 13:13:12', '2025-10-12 11:26:38'),
(10, 3, 3, 'D3', '2025-09-06 13:13:12', '2025-10-12 11:26:42'),
(11, 1, 28, 'D28', '2025-09-06 13:19:32', '2025-10-12 11:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SCbrL7NaT7C1haygNUXMhtXHFludRrZeaBvxdENb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR05IYmR4bnVqVE1ZMEFjMmk3dWNmTDNLUUEwOUhCMzZoM0pJRVFJNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1761397159);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `role` bigint(12) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_initial` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `default_password` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `two_factor_code` varchar(255) DEFAULT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_id`, `role`, `first_name`, `middle_initial`, `last_name`, `suffix`, `email`, `email_verified_at`, `default_password`, `password`, `remember_token`, `two_factor_code`, `is_disabled`, `created_at`, `updated_at`) VALUES
(3, 'DrCare-2025-0001-0001', 1, 'Jervy Jake', 'O.', 'Morales', NULL, 'thedemonhunter11@gmail.com', NULL, 'DrcareABC2025-0001-0001', '$2y$12$kXFty7Dky1xVhia.KAItl.2O9uDizeX8/3PLgZ4yuVWbNJ7lkwQpa', 'vHsa0SAO5ChgSi7Oziak4rKB66EfSHHqhoc7LW1gRZyTM591dMt298NYbGgv', 'eyJpdiI6IlFuRFZqN0F5UG9tclUyRHZ3TnhiRUE9PSIsInZhbHVlIjoiOEhmWFFQamhCcDh1Y0prN2JwcW5qQT09IiwibWFjIjoiZTQ0OGEwYmI0ZWI3OWQyNWVhOTMxNTAwNTUzODg1MGY4MGNiMTI0OTQyYzIxM2M1ZmZkOTNkNmIzOTBkYzYwYyIsInRhZyI6IiJ9', 0, '2025-07-05 01:29:16', '2025-09-11 07:01:10'),
(4, 'DrCare-2025-0002-0001', 3, 'Jenny', 'C.', 'Doe', NULL, 'geyyyk07@gmail.com', NULL, 'DrCareABC2025-0002-0001', '$2y$12$a4s0BT/QqZIJKHUVzFf1eOKlcVTSGprxifMgTT82zRZzUnaI2d0Q.', NULL, 'eyJpdiI6IndGSjBzR3BlRTBqMHBLbFo4Mk00WFE9PSIsInZhbHVlIjoiYlRKbUk2Nk51ZmRUTlRHbGd3Ly9zUT09IiwibWFjIjoiM2YyMTIzNjZiOGZjNGYzNDUzYmJlOTcyNmUwYzgzNmRmNjhiYjU5ZTBiNmU5NDY4YjA4MjNlNjczZmMwMzk0YyIsInRhZyI6IiJ9', 0, '2025-08-02 02:29:42', '2025-09-27 21:25:21'),
(5, 'DrCare-2025-0003-0001', 3, 'Juan', 'D.', 'Cruz', NULL, 'juancruz@gmail.com', NULL, 'Drcare2025-0003-0001', '$2y$12$cJnE1IrdTid/RA6zaVLxAuIQcjZxCEtdqQat/6nwi5ePSnfcoBFK2', NULL, NULL, 0, '2025-08-02 02:30:03', '2025-09-27 21:08:19'),
(13, 'DrCare-2025-2836-9635', 1, 'Test', 'O.', 'TestLast', 'III.', 'test@gmail.com', NULL, 'DrCareABC-2025-2836-9635', '$2y$12$DjTsRs5eADlOeEFTQuEgsuT0UqBT6glmEcbIoCqb0CQx3AKhaZ4GW', NULL, NULL, 0, '2025-08-20 23:10:26', '2025-08-20 23:10:26'),
(14, 'DrCare-2025-1599-0997', 2, 'Ruby', 'B.', 'Canafe', NULL, 'ruby@gmail.com', NULL, 'DrCareABC-2025-1599-0997', '$2y$12$J5gv4qkSJ1a21pX0SyE0rOaKOsJHDg9xw6haPpMap6ZRl/gFhkCaq', NULL, NULL, 0, '2025-08-21 06:28:06', '2025-08-21 06:28:06'),
(25, 'DrCare-2025-8467-3929', 2, 'Jericko', 'F.', 'Ocfemia', NULL, 'jake123@gmail.com', NULL, 'DrCareABC-2025-8467-3929', '$2y$12$s2V3Eod1HTOnUya5ZeUFw.4dp1C6kAaEnfydHJmKBunQPqqcAWXMK', NULL, NULL, 0, '2025-08-22 23:19:53', '2025-08-23 21:06:25'),
(26, 'DrCare-2025-3470-0102', 1, 'John', 'O.', 'Doe', NULL, 'johndoe12@gmail.com', NULL, 'DrCareABC-2025-3470-0102', '$2y$12$uXVaSg89bRqv639g1bTUI.DX3S5FvSv5XOUOWzzZKyM2neDC6NN1W', NULL, NULL, 0, '2025-08-23 22:39:23', '2025-08-23 22:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_informations`
--

CREATE TABLE `user_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(12) UNSIGNED NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_informations`
--

INSERT INTO `user_informations` (`id`, `user_id`, `role_id`, `contact_number`, `address`, `gender`, `birthdate`, `age`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '0912 233 4455', 'Inamnan Grande, Guinobatan, Albay, Purok-2', 'Male', '2004-04-01', 21, '2025-08-02 02:37:53', '2025-08-24 04:51:06'),
(4, 4, 2, '0912 233 4659', 'purok, barangay, city/municipality, region', 'Female', '2004-01-01', 21, '2025-08-02 02:41:58', '2025-09-10 03:25:24'),
(5, 5, 3, '0954 546 5679', 'Purok, Barangay, City/Municipality, Region', 'Male', '2004-09-16', 20, '2025-08-02 02:43:52', '2025-09-02 00:34:31'),
(10, 13, 1, '09235465768', 'Baclayon, Bacacay, Albay, Purok-2', 'Male', '1990-02-22', 35, '2025-08-20 23:10:26', '2025-08-22 13:31:29'),
(11, 14, 2, '0913 456 7986', 'Labnig, Malinao, Albay, Purok-2', 'Female', '2004-02-03', 21, '2025-08-21 06:28:07', '2025-08-22 13:31:36'),
(22, 25, 2, '0923 546 5768', 'purok-2, Adams, Ilocos Norte, ', 'Male', '2025-08-23', 0, '2025-08-22 23:19:53', '2025-08-23 21:28:20'),
(23, 26, 1, '0954 674 5675', 'Banbanaal, Banayoyo, Ilocos Sur, purok-2', 'male', '0004-02-22', 2021, '2025-08-23 22:39:23', '2025-08-23 22:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(12) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `date_and_time` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `role_id`, `action`, `details`, `date_and_time`, `created_at`, `updated_at`) VALUES
(45, 14, 2, 'Administered Anti-Rabies vaccine to patient', 'Administered Anti-Rabies vaccine to patient Timmy Wood', '2025-10-12 11:27:55', '2025-10-12 11:27:55', NULL),
(46, 4, 3, 'Handled payment for patient', 'Handled payment for patient Timmy Wood', '2025-10-12 11:27:55', '2025-10-12 11:27:55', NULL),
(47, 14, 2, 'Administered Anti-Rabies vaccine to patient', 'Administered Anti-Rabies vaccine to patient Timmy Wood', '2025-10-12 11:46:49', '2025-10-12 11:46:49', NULL),
(48, 4, 3, 'Handled payment for patient', 'Handled payment for patient Timmy Wood', '2025-10-12 11:46:49', '2025-10-12 11:46:49', NULL),
(49, 14, 2, 'Administered Anti-Rabies vaccine to patient', 'Administered Anti-Rabies vaccine to patient Timmy Wood', '2025-10-12 12:16:43', '2025-10-12 12:16:43', NULL),
(50, 4, 3, 'Handled payment for patient', 'Handled payment for patient Timmy Wood', '2025-10-12 12:16:43', '2025-10-12 12:16:43', NULL),
(51, 14, 2, 'Administered Anti-Rabies vaccine to patient', 'Administered Anti-Rabies vaccine to patient Timmy Wood', '2025-10-12 12:27:05', '2025-10-12 12:27:05', NULL),
(52, 4, 3, 'Handled payment for patient', 'Handled payment for patient Timmy Wood', '2025-10-12 12:27:05', '2025-10-12 12:27:05', NULL),
(53, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Timmy Wood', '2025-10-12 12:35:59', '2025-10-12 12:35:59', NULL),
(54, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Timmy Wood', '2025-10-12 12:35:59', '2025-10-12 12:35:59', NULL),
(55, 14, 2, 'Administered Anti-Tetanus to patient', 'Administered Anti-Tetanus to patient John Doe', '2025-10-13 13:17:01', '2025-10-13 13:17:01', NULL),
(56, 4, 3, 'Handled payment for Anti-Tetanus patient', 'Handled payment for Anti-Tetanus patient John Doe', '2025-10-13 13:17:01', '2025-10-13 13:17:01', NULL),
(57, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient John Doe', '2025-10-13 13:41:08', '2025-10-13 13:41:08', NULL),
(58, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient John Doe', '2025-10-13 13:41:08', '2025-10-13 13:41:08', NULL),
(59, 14, 2, 'Administered Anti-Tetanus to patient', 'Administered Anti-Tetanus to patient Mark Doe', '2025-10-13 14:22:43', '2025-10-13 14:22:43', NULL),
(60, 4, 3, 'Handled payment for Anti-Tetanus patient', 'Handled payment for Anti-Tetanus patient Mark Doe', '2025-10-13 14:22:43', '2025-10-13 14:22:43', NULL),
(61, 14, 2, 'Administered PREP to patient', 'Administered PREP to patient Mark Doe', '2025-10-16 03:58:57', '2025-10-16 03:58:57', NULL),
(62, 4, 3, 'Handled payment for PREP patient', 'Handled payment for PREP patient Mark Doe', '2025-10-16 03:58:57', '2025-10-16 03:58:57', NULL),
(63, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient John Doe', '2025-10-16 04:16:50', '2025-10-16 04:16:50', NULL),
(64, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient John Doe', '2025-10-16 04:16:50', '2025-10-16 04:16:50', NULL),
(65, 14, 2, 'Administered Anti-Tetanus to patient', 'Administered Anti-Tetanus to patient Mark Barreda', '2025-10-16 04:21:20', '2025-10-16 04:21:20', NULL),
(66, 4, 3, 'Handled payment for Anti-Tetanus patient', 'Handled payment for Anti-Tetanus patient Mark Barreda', '2025-10-16 04:21:20', '2025-10-16 04:21:20', NULL),
(67, 14, 2, 'Administered Booster to patient', 'Administered Booster to patient Mark Barreda', '2025-10-16 05:15:09', '2025-10-16 05:15:09', NULL),
(68, 4, 3, 'Handled payment for patient', 'Handled payment for patient Mark Barreda', '2025-10-16 05:15:09', '2025-10-16 05:15:09', NULL),
(69, 14, 2, 'Administered Anti-Tetanus to patient', 'Administered Anti-Tetanus to patient Mark Barreda', '2025-10-16 06:10:19', '2025-10-16 06:10:19', NULL),
(70, 4, 3, 'Handled payment for Anti-Tetanus patient', 'Handled payment for Anti-Tetanus patient Mark Barreda', '2025-10-16 06:10:19', '2025-10-16 06:10:19', NULL),
(71, 14, 2, 'Administered Hepatitis B to patient', 'Administered Hepatitis B to patient Jeron Rengie', '2025-10-16 13:11:32', '2025-10-16 13:11:32', NULL),
(72, 4, 3, 'Handled payment for Hepatitis B patient', 'Handled payment for Hepatitis B patient Jeron Rengie', '2025-10-16 13:11:32', '2025-10-16 13:11:32', NULL),
(73, 14, 2, 'Administered Hepatitis B to patient', 'Administered Hepatitis B to patient Jeron Rengie', '2025-10-16 13:56:14', '2025-10-16 13:56:14', NULL),
(74, 4, 3, 'Handled payment for Hepatitis B patient', 'Handled payment for Hepatitis B patient Jeron Rengie', '2025-10-16 13:56:14', '2025-10-16 13:56:14', NULL),
(75, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Jervy Morales', '2025-10-17 12:06:12', '2025-10-17 12:06:12', NULL),
(76, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Jervy Morales', '2025-10-17 12:06:12', '2025-10-17 12:06:12', NULL),
(77, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Jerome Morales', '2025-10-17 12:17:16', '2025-10-17 12:17:16', NULL),
(78, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Jerome Morales', '2025-10-17 12:17:16', '2025-10-17 12:17:16', NULL),
(79, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Jerome Morales', '2025-10-17 12:45:08', '2025-10-17 12:45:08', NULL),
(80, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Jerome Morales', '2025-10-17 12:45:08', '2025-10-17 12:45:08', NULL),
(81, 14, 2, 'Administered Anti-Tetanus to patient', 'Administered Anti-Tetanus to patient Juan Dela Cruz', '2025-10-17 13:32:56', '2025-10-17 13:32:56', NULL),
(82, 4, 3, 'Handled payment for Anti-Tetanus patient', 'Handled payment for Anti-Tetanus patient Juan Dela Cruz', '2025-10-17 13:32:56', '2025-10-17 13:32:56', NULL),
(83, 14, 2, 'Administered Hepatitis B to patient', 'Administered Hepatitis B to patient Juan Dela Cruz', '2025-10-17 14:16:41', '2025-10-17 14:16:41', NULL),
(84, 4, 3, 'Handled payment for Hepatitis B patient', 'Handled payment for Hepatitis B patient Juan Dela Cruz', '2025-10-17 14:16:41', '2025-10-17 14:16:41', NULL),
(85, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Jerome Morales', '2025-10-18 04:25:27', '2025-10-18 04:25:27', NULL),
(86, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Jerome Morales', '2025-10-18 04:25:27', '2025-10-18 04:25:27', NULL),
(87, 14, 2, 'Administered Hepatitis B to patient', 'Administered Hepatitis B to patient Tupac Meate', '2025-10-18 07:07:01', '2025-10-18 07:07:01', NULL),
(88, 4, 3, 'Handled payment for Hepatitis B patient', 'Handled payment for Hepatitis B patient Tupac Meate', '2025-10-18 07:07:01', '2025-10-18 07:07:01', NULL),
(89, 14, 2, 'Administered Hepatitis B to patient', 'Administered Hepatitis B to patient Tupac Meate', '2025-10-18 07:08:29', '2025-10-18 07:08:29', NULL),
(90, 4, 3, 'Handled payment for Hepatitis B patient', 'Handled payment for Hepatitis B patient Tupac Meate', '2025-10-18 07:08:29', '2025-10-18 07:08:29', NULL),
(91, 14, 2, 'Administered Hepatitis B to patient', 'Administered Hepatitis B to patient Tupac Meate', '2025-10-18 07:16:12', '2025-10-18 07:16:12', NULL),
(92, 4, 3, 'Handled payment for Hepatitis B patient', 'Handled payment for Hepatitis B patient Tupac Meate', '2025-10-18 07:16:12', '2025-10-18 07:16:12', NULL),
(93, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Jeriko Dela Cruz', '2025-10-18 13:05:20', '2025-10-18 13:05:20', NULL),
(94, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Jeriko Dela Cruz', '2025-10-18 13:05:20', '2025-10-18 13:05:20', NULL),
(95, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Krishna Oabina', '2025-10-18 13:21:31', '2025-10-18 13:21:31', NULL),
(96, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Krishna Oabina', '2025-10-18 13:21:31', '2025-10-18 13:21:31', NULL),
(97, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Danica Oabina', '2025-10-18 14:08:13', '2025-10-18 14:08:13', NULL),
(98, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Danica Oabina', '2025-10-18 14:08:13', '2025-10-18 14:08:13', NULL),
(99, 14, 2, 'Administered Anti-Tetanus to patient', 'Administered Anti-Tetanus to patient Francine Collantes', '2025-10-22 12:53:13', '2025-10-22 12:53:13', NULL),
(100, 4, 3, 'Handled payment for Anti-Tetanus patient', 'Handled payment for Anti-Tetanus patient Francine Collantes', '2025-10-22 12:53:13', '2025-10-22 12:53:13', NULL),
(101, 14, 2, 'Administered PEP to patient', 'Administered PEP to patient Jalen Williams', '2025-10-24 13:01:49', '2025-10-24 13:01:49', NULL),
(102, 4, 3, 'Handled payment for PEP patient', 'Handled payment for PEP patient Jalen Williams', '2025-10-24 13:01:49', '2025-10-24 13:01:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(12) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`, `created_at`, `modified_at`) VALUES
(1, 'Admin', '2025-07-19 12:02:29', '2025-08-12 14:08:09'),
(2, 'Nurse', '2025-07-31 00:59:08', '2025-08-12 14:08:18'),
(3, 'Staff', '2025-07-31 00:59:18', '2025-08-12 14:08:20');

-- --------------------------------------------------------

--
-- Structure for view `albay_patient_report`
--
DROP TABLE IF EXISTS `albay_patient_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `albay_patient_report`  AS SELECT year(`distinct_patients`.`date_given`) AS `year`, quarter(`distinct_patients`.`date_given`) AS `quarter`, `distinct_patients`.`Localities` AS `Localities`, count(0) AS `patient_count`, sum(case when `distinct_patients`.`sex` = 'Male' then 1 else 0 end) AS `male_count`, sum(case when `distinct_patients`.`sex` = 'Female' then 1 else 0 end) AS `female_count`, sum(case when `distinct_patients`.`age` between 0 and 17 then 1 else 0 end) AS `age_0_17`, sum(case when `distinct_patients`.`age` between 18 and 64 then 1 else 0 end) AS `age_18_64`, sum(case when `distinct_patients`.`age` >= 65 then 1 else 0 end) AS `age_65_plus`, sum(case when `ap`.`species` = 'Dog' then 1 else 0 end) AS `dog_count`, sum(case when `ap`.`species` = 'Cat' then 1 else 0 end) AS `cat_count`, sum(case when `ap`.`species` not in ('Dog','Cat') or `ap`.`species` is null then 1 else 0 end) AS `others_count`, sum(case when `pe`.`bite_category` = 1 then 1 else 0 end) AS `bite_cat_1`, sum(case when `pe`.`bite_category` = 2 then 1 else 0 end) AS `bite_cat_2`, sum(case when `pe`.`bite_category` = 3 then 1 else 0 end) AS `bite_cat_3` FROM (((select distinct `rp`.`id` AS `id`,`rp`.`sex` AS `sex`,`rp`.`age` AS `age`,trim(substring_index(substring_index(`rp`.`address`,'Albay, ',-1),',',1)) AS `Localities`,`pi`.`date_given` AS `date_given` from (`patient_immunizations` `pi` join `registered_patients` `rp` on(`rp`.`id` = `pi`.`patient_id`)) where `pi`.`service_id` = 1 and `rp`.`address` like '%Albay, %') `distinct_patients` left join `patient_exposures` `pe` on(`pe`.`patient_id` = `distinct_patients`.`id`)) left join `animal_profile` `ap` on(`ap`.`id` = `pe`.`animal_profile_id`)) GROUP BY year(`distinct_patients`.`date_given`), quarter(`distinct_patients`.`date_given`), `distinct_patients`.`Localities` ;

-- --------------------------------------------------------

--
-- Structure for view `barangay_patient_report`
--
DROP TABLE IF EXISTS `barangay_patient_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `barangay_patient_report`  AS SELECT year(`pt`.`transaction_date`) AS `year`, quarter(`pt`.`transaction_date`) AS `quarter`, `distinct_patients`.`barangay` AS `barangay`, count(distinct `distinct_patients`.`patient_id`) AS `patient_count`, count(distinct case when `distinct_patients`.`sex` = 'Male' then `distinct_patients`.`patient_id` end) AS `male_count`, count(distinct case when `distinct_patients`.`sex` = 'Female' then `distinct_patients`.`patient_id` end) AS `female_count`, count(distinct case when `distinct_patients`.`age` between 0 and 17 then `distinct_patients`.`patient_id` end) AS `age_0_17`, count(distinct case when `distinct_patients`.`age` between 18 and 64 then `distinct_patients`.`patient_id` end) AS `age_18_64`, count(distinct case when `distinct_patients`.`age` >= 65 then `distinct_patients`.`patient_id` end) AS `age_65_plus`, count(distinct case when `ap`.`species` = 'Dog' then `distinct_patients`.`patient_id` end) AS `dog_count`, count(distinct case when `ap`.`species` = 'Cat' then `distinct_patients`.`patient_id` end) AS `cat_count`, count(distinct case when `ap`.`species` not in ('Dog','Cat') or `ap`.`species` is null then `distinct_patients`.`patient_id` end) AS `others_count`, count(distinct case when `pe`.`bite_category` = 1 then `distinct_patients`.`patient_id` end) AS `bite_cat_1`, count(distinct case when `pe`.`bite_category` = 2 then `distinct_patients`.`patient_id` end) AS `bite_cat_2`, count(distinct case when `pe`.`bite_category` = 3 then `distinct_patients`.`patient_id` end) AS `bite_cat_3` FROM ((((select distinct `rp`.`id` AS `patient_id`,`rp`.`sex` AS `sex`,`rp`.`age` AS `age`,`pi`.`transaction_id` AS `transaction_id`,trim(substring_index(substring_index(`rp`.`address`,'Albay, Guinobatan, ',-1),',',1)) AS `barangay` from (`patient_immunizations` `pi` join `registered_patients` `rp` on(`rp`.`id` = `pi`.`patient_id`)) where `pi`.`service_id` = 1 and `rp`.`address` like '%Albay, Guinobatan, %') `distinct_patients` join `patient_transactions` `pt` on(`pt`.`id` = `distinct_patients`.`transaction_id`)) left join `patient_exposures` `pe` on(`pe`.`patient_id` = `distinct_patients`.`patient_id`)) left join `animal_profile` `ap` on(`ap`.`id` = `pe`.`animal_profile_id`)) GROUP BY year(`pt`.`transaction_date`), quarter(`pt`.`transaction_date`), `distinct_patients`.`barangay` ORDER BY year(`pt`.`transaction_date`) ASC, quarter(`pt`.`transaction_date`) ASC, `distinct_patients`.`barangay` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `inventory_records`
--
DROP TABLE IF EXISTS `inventory_records`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inventory_records`  AS SELECT `i`.`id` AS `id`, `i`.`category` AS `category`, `i`.`brand_name` AS `brand_name`, `i`.`product_type` AS `product_type`, `i`.`immunity_type` AS `immunity_type`, `i`.`stock_status` AS `stock_status`, concat(trim(trailing '.00' from format(`st`.`total_units`,2)),' ',`st`.`unit_type`) AS `total_units`, concat(trim(trailing '.00' from format(`st`.`total_remaining_units`,2)),' ',`st`.`unit_type`) AS `total_unit_remaining`, concat(trim(trailing '.00' from format(sum(case when `u`.`unit_volume` is not null then `u`.`unit_volume` when `u`.`unit_quantity` is not null then `u`.`unit_quantity` else 0 end),2)),' ',max(`u`.`measurement_unit`)) AS `vol_qty_total`, concat(trim(trailing '.00' from format(sum(case when `u`.`remaining_volume` is not null then `u`.`remaining_volume` when `u`.`remaining_quantity` is not null then `u`.`remaining_quantity` else 0 end),2)),' ',max(`u`.`measurement_unit`)) AS `vol_qty_remaining`, `i`.`last_restocked_date` AS `last_restocked_date`, `i`.`created_at` AS `created_at`, `i`.`updated_at` AS `updated_at` FROM (((`inventory_items` `i` left join (select `inventory_stocks`.`item_id` AS `item_id`,sum(`inventory_stocks`.`packages_received`) AS `packages_received`,sum(`inventory_stocks`.`total_units`) AS `total_units`,sum(`inventory_stocks`.`total_remaining_units`) AS `total_remaining_units`,max(`inventory_stocks`.`unit_type`) AS `unit_type` from `inventory_stocks` group by `inventory_stocks`.`item_id`) `st` on(`i`.`id` = `st`.`item_id`)) left join `inventory_stocks` `s` on(`i`.`id` = `s`.`item_id`)) left join `inventory_units` `u` on(`s`.`id` = `u`.`stock_id`)) GROUP BY `i`.`id`, `i`.`category`, `i`.`brand_name`, `i`.`product_type`, `i`.`immunity_type`, `i`.`stock_status`, `st`.`packages_received`, `st`.`total_units`, `st`.`total_remaining_units`, `st`.`unit_type`, `i`.`last_restocked_date`, `i`.`created_at`, `i`.`updated_at` ;

-- --------------------------------------------------------

--
-- Structure for view `revenue_expense_summary`
--
DROP TABLE IF EXISTS `revenue_expense_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `revenue_expense_summary`  AS SELECT `y`.`year` AS `year`, `m`.`month_name` AS `month`, coalesce(sum(`pr`.`amount_paid`),0) AS `total_revenue`, coalesce(sum(`isx`.`total_package_amount`),0) AS `total_expenses`, CASE WHEN coalesce(sum(`pr`.`amount_paid`),0) - coalesce(sum(`isx`.`total_package_amount`),0) > 0 THEN coalesce(sum(`pr`.`amount_paid`),0) - coalesce(sum(`isx`.`total_package_amount`),0) ELSE 0 END AS `income`, CASE WHEN coalesce(sum(`pr`.`amount_paid`),0) - coalesce(sum(`isx`.`total_package_amount`),0) < 0 THEN abs(coalesce(sum(`pr`.`amount_paid`),0) - coalesce(sum(`isx`.`total_package_amount`),0)) ELSE 0 END AS `loss` FROM ((((select distinct year(`payment_records`.`payment_date`) AS `year` from `payment_records` union select distinct year(`inventory_stocks`.`restock_date`) AS `year` from `inventory_stocks`) `y` join (select 1 AS `month_num`,'January' AS `month_name` union all select 2 AS `2`,'February' AS `February` union all select 3 AS `3`,'March' AS `March` union all select 4 AS `4`,'April' AS `April` union all select 5 AS `5`,'May' AS `May` union all select 6 AS `6`,'June' AS `June` union all select 7 AS `7`,'July' AS `July` union all select 8 AS `8`,'August' AS `August` union all select 9 AS `9`,'September' AS `September` union all select 10 AS `10`,'October' AS `October` union all select 11 AS `11`,'November' AS `November` union all select 12 AS `12`,'December' AS `December`) `m`) left join `payment_records` `pr` on(month(`pr`.`payment_date`) = `m`.`month_num` and year(`pr`.`payment_date`) = `y`.`year`)) left join `inventory_stocks` `isx` on(month(`isx`.`restock_date`) = `m`.`month_num` and year(`isx`.`restock_date`) = `y`.`year`)) GROUP BY `y`.`year`, `m`.`month_num`, `m`.`month_name` ORDER BY `y`.`year` ASC, `m`.`month_num` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal_profile`
--
ALTER TABLE `animal_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_slots`
--
ALTER TABLE `appointment_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_stocks`
--
ALTER TABLE `inventory_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventory_items_stock` (`item_id`);

--
-- Indexes for table `inventory_units`
--
ALTER TABLE `inventory_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventory_items` (`item_id`),
  ADD KEY `fk_inventory_stocks_id` (`stock_id`);

--
-- Indexes for table `inventory_usage`
--
ALTER TABLE `inventory_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_used_by` (`used_by`),
  ADD KEY `fk_inventory_units` (`unit_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_patient` (`patient_id`),
  ADD KEY `fk_message_sched` (`immunization_sched_id`),
  ADD KEY `fk_message_sender` (`sender_id`);

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
-- Indexes for table `patient_accounts`
--
ALTER TABLE `patient_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_accounts_email_unique` (`email`),
  ADD UNIQUE KEY `auth_id` (`auth_provider_id`);

--
-- Indexes for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_reference` (`booking_reference`),
  ADD KEY `fk_handled_by` (`handled_by_id`),
  ADD KEY `fk_patient_Accounts` (`patient_account_id`);

--
-- Indexes for table `patient_exposures`
--
ALTER TABLE `patient_exposures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient` (`patient_id`),
  ADD KEY `fk_animal_profile` (`animal_profile_id`),
  ADD KEY `fk_transactions` (`transaction_id`);

--
-- Indexes for table `patient_immunizations`
--
ALTER TABLE `patient_immunizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_info` (`patient_id`),
  ADD KEY `fk_transaction_table` (`transaction_id`),
  ADD KEY `fk_service_Table` (`service_id`),
  ADD KEY `fk_exposure_table` (`exposure_id`),
  ADD KEY `fk_user_table` (`administered_by_id`),
  ADD KEY `fk_immunization_schedule` (`schedule_id`),
  ADD KEY `fk_vital_signs_table` (`vital_signs_id`),
  ADD KEY `fk_inventory_unit_rig` (`rig_used_id`),
  ADD KEY `fk_inventory_unit_vaccine` (`vaccine_used_id`),
  ADD KEY `fk_anti_tetanus_Id` (`anti_tetanus_id`),
  ADD KEY `fk_payment_invoice` (`payment_id`);

--
-- Indexes for table `patient_immunization_schedule`
--
ALTER TABLE `patient_immunization_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_sched` (`patient_id`),
  ADD KEY `fk_immunization_service` (`service_id`),
  ADD KEY `fk_patient_sched_transaction` (`transaction_id`),
  ADD KEY `fk_patient_service_sched` (`service_sched_id`),
  ADD KEY `fk_nurse` (`administered_by`);

--
-- Indexes for table `patient_previous_anti_rabies`
--
ALTER TABLE `patient_previous_anti_rabies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_registered_patient_id` (`patient_id`);

--
-- Indexes for table `patient_previous_anti_tetanus`
--
ALTER TABLE `patient_previous_anti_tetanus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_id` (`patient_id`),
  ADD KEY `fk_tt_nurse_id` (`rn_in_charge`);

--
-- Indexes for table `patient_transactions`
--
ALTER TABLE `patient_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_transactions` (`patient_id`),
  ADD KEY `fk_services_transactions` (`service_id`);

--
-- Indexes for table `patient_vital_signs`
--
ALTER TABLE `patient_vital_signs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patients_vital_signs` (`patient_id`),
  ADD KEY `fk_transactions_vital_signs` (`transaction_id`);

--
-- Indexes for table `payment_invoice`
--
ALTER TABLE `payment_invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`),
  ADD KEY `fk_invoice_transaction` (`transaction_id`),
  ADD KEY `fk_invoice_handler` (`issued_by_id`);

--
-- Indexes for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `0001` (`receipt_number`),
  ADD KEY `fk_payment_handler` (`received_by_id`),
  ADD KEY `fk_transaction_id` (`transaction_id`),
  ADD KEY `fk_registered_patients` (`patient_id`);

--
-- Indexes for table `pre_registered_patients`
--
ALTER TABLE `pre_registered_patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `record_id` (`record_id`),
  ADD UNIQUE KEY `record_id_2` (`record_id`),
  ADD UNIQUE KEY `record_id_3` (`record_id`),
  ADD KEY `fk_pre_patient_Account` (`account_id`);

--
-- Indexes for table `registered_patients`
--
ALTER TABLE `registered_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patients_accounts` (`account_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_schedules`
--
ALTER TABLE `services_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_services` (`service_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_id` (`account_id`),
  ADD UNIQUE KEY `account_id_2` (`account_id`),
  ADD UNIQUE KEY `account_id_3` (`account_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_roles` (`role`);

--
-- Indexes for table `user_informations`
--
ALTER TABLE `user_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_roles` (`role_id`),
  ADD KEY `fk_user_accounts` (`user_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_clinic` (`user_id`),
  ADD KEY `fk_user_role` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal_profile`
--
ALTER TABLE `animal_profile`
  MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `appointment_slots`
--
ALTER TABLE `appointment_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `inventory_stocks`
--
ALTER TABLE `inventory_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `inventory_units`
--
ALTER TABLE `inventory_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `inventory_usage`
--
ALTER TABLE `inventory_usage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_accounts`
--
ALTER TABLE `patient_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient_exposures`
--
ALTER TABLE `patient_exposures`
  MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `patient_immunizations`
--
ALTER TABLE `patient_immunizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `patient_immunization_schedule`
--
ALTER TABLE `patient_immunization_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `patient_previous_anti_rabies`
--
ALTER TABLE `patient_previous_anti_rabies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_previous_anti_tetanus`
--
ALTER TABLE `patient_previous_anti_tetanus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `patient_transactions`
--
ALTER TABLE `patient_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `patient_vital_signs`
--
ALTER TABLE `patient_vital_signs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `payment_invoice`
--
ALTER TABLE `payment_invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_records`
--
ALTER TABLE `payment_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `pre_registered_patients`
--
ALTER TABLE `pre_registered_patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registered_patients`
--
ALTER TABLE `registered_patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services_schedules`
--
ALTER TABLE `services_schedules`
  MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_informations`
--
ALTER TABLE `user_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_stocks`
--
ALTER TABLE `inventory_stocks`
  ADD CONSTRAINT `fk_inventory_items_stock` FOREIGN KEY (`item_id`) REFERENCES `inventory_items` (`id`);

--
-- Constraints for table `inventory_units`
--
ALTER TABLE `inventory_units`
  ADD CONSTRAINT `fk_inventory_items` FOREIGN KEY (`item_id`) REFERENCES `inventory_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventory_stocks_id` FOREIGN KEY (`stock_id`) REFERENCES `inventory_stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_usage`
--
ALTER TABLE `inventory_usage`
  ADD CONSTRAINT `fk_inventory_units` FOREIGN KEY (`unit_id`) REFERENCES `inventory_units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_used_by` FOREIGN KEY (`used_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_message_patient` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`),
  ADD CONSTRAINT `fk_message_sched` FOREIGN KEY (`immunization_sched_id`) REFERENCES `patient_immunization_schedule` (`id`),
  ADD CONSTRAINT `fk_message_sender` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  ADD CONSTRAINT `fk_handled_by` FOREIGN KEY (`handled_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_patient_Accounts` FOREIGN KEY (`patient_account_id`) REFERENCES `patient_accounts` (`id`);

--
-- Constraints for table `patient_exposures`
--
ALTER TABLE `patient_exposures`
  ADD CONSTRAINT `fk_animal_profile` FOREIGN KEY (`animal_profile_id`) REFERENCES `animal_profile` (`id`),
  ADD CONSTRAINT `fk_patient` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`),
  ADD CONSTRAINT `fk_transactions` FOREIGN KEY (`transaction_id`) REFERENCES `patient_transactions` (`id`);

--
-- Constraints for table `patient_immunizations`
--
ALTER TABLE `patient_immunizations`
  ADD CONSTRAINT `fk_anti_tetanus_Id` FOREIGN KEY (`anti_tetanus_id`) REFERENCES `inventory_units` (`id`),
  ADD CONSTRAINT `fk_exposure_table` FOREIGN KEY (`exposure_id`) REFERENCES `patient_exposures` (`id`),
  ADD CONSTRAINT `fk_immunization_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `patient_immunization_schedule` (`id`),
  ADD CONSTRAINT `fk_inventory_unit_rig` FOREIGN KEY (`rig_used_id`) REFERENCES `inventory_units` (`id`),
  ADD CONSTRAINT `fk_inventory_unit_vaccine` FOREIGN KEY (`vaccine_used_id`) REFERENCES `inventory_units` (`id`),
  ADD CONSTRAINT `fk_patient_info` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`),
  ADD CONSTRAINT `fk_payment_invoice` FOREIGN KEY (`payment_id`) REFERENCES `payment_records` (`id`),
  ADD CONSTRAINT `fk_service_Table` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `fk_transaction_table` FOREIGN KEY (`transaction_id`) REFERENCES `patient_transactions` (`id`),
  ADD CONSTRAINT `fk_user_table` FOREIGN KEY (`administered_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_vital_signs_table` FOREIGN KEY (`vital_signs_id`) REFERENCES `patient_vital_signs` (`id`);

--
-- Constraints for table `patient_immunization_schedule`
--
ALTER TABLE `patient_immunization_schedule`
  ADD CONSTRAINT `fk_immunization_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `fk_nurse` FOREIGN KEY (`administered_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_patient_sched` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`),
  ADD CONSTRAINT `fk_patient_sched_transaction` FOREIGN KEY (`transaction_id`) REFERENCES `patient_transactions` (`id`),
  ADD CONSTRAINT `fk_patient_service_sched` FOREIGN KEY (`service_sched_id`) REFERENCES `services_schedules` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `patient_previous_anti_rabies`
--
ALTER TABLE `patient_previous_anti_rabies`
  ADD CONSTRAINT `fk_registered_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`);

--
-- Constraints for table `patient_previous_anti_tetanus`
--
ALTER TABLE `patient_previous_anti_tetanus`
  ADD CONSTRAINT `fk_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`),
  ADD CONSTRAINT `fk_tt_nurse_id` FOREIGN KEY (`rn_in_charge`) REFERENCES `users` (`id`);

--
-- Constraints for table `patient_transactions`
--
ALTER TABLE `patient_transactions`
  ADD CONSTRAINT `fk_patient_transactions` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`),
  ADD CONSTRAINT `fk_services_transactions` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `patient_vital_signs`
--
ALTER TABLE `patient_vital_signs`
  ADD CONSTRAINT `fk_patients_vital_signs` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`),
  ADD CONSTRAINT `fk_transactions_vital_signs` FOREIGN KEY (`transaction_id`) REFERENCES `patient_transactions` (`id`);

--
-- Constraints for table `payment_invoice`
--
ALTER TABLE `payment_invoice`
  ADD CONSTRAINT `fk_invoice_handler` FOREIGN KEY (`issued_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_invoice_transaction` FOREIGN KEY (`transaction_id`) REFERENCES `patient_transactions` (`id`);

--
-- Constraints for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD CONSTRAINT `fk_payment_handler` FOREIGN KEY (`received_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_registered_patients` FOREIGN KEY (`patient_id`) REFERENCES `registered_patients` (`id`),
  ADD CONSTRAINT `fk_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `patient_transactions` (`id`);

--
-- Constraints for table `pre_registered_patients`
--
ALTER TABLE `pre_registered_patients`
  ADD CONSTRAINT `fk_pre_patient_Account` FOREIGN KEY (`account_id`) REFERENCES `patient_accounts` (`id`);

--
-- Constraints for table `registered_patients`
--
ALTER TABLE `registered_patients`
  ADD CONSTRAINT `fk_patients_accounts` FOREIGN KEY (`account_id`) REFERENCES `patient_accounts` (`id`);

--
-- Constraints for table `services_schedules`
--
ALTER TABLE `services_schedules`
  ADD CONSTRAINT `fk_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_roles` FOREIGN KEY (`role`) REFERENCES `user_roles` (`id`);

--
-- Constraints for table `user_informations`
--
ALTER TABLE `user_informations`
  ADD CONSTRAINT `fk_user_accounts` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_roles` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `fk_user_clinic` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
