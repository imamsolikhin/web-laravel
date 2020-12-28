/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80020
 Source Host           : 127.0.0.1:3306
 Source Schema         : db_hpi

 Target Server Type    : MySQL
 Target Server Version : 80020
 File Encoding         : 65001

 Date: 29/10/2020 14:00:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for client_groups
-- ----------------------------
DROP TABLE IF EXISTS `client_groups`;
CREATE TABLE `client_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of client_groups
-- ----------------------------
BEGIN;
INSERT INTO `client_groups` VALUES (1, '01', 'Demo Group', 0, '2020-10-10 08:37:06', '2020-10-10 08:37:06', NULL);
COMMIT;

-- ----------------------------
-- Table structure for client_notices
-- ----------------------------
DROP TABLE IF EXISTS `client_notices`;
CREATE TABLE `client_notices` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_notices_client_id_index` (`client_id`),
  CONSTRAINT `client_notices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for client_properties
-- ----------------------------
DROP TABLE IF EXISTS `client_properties`;
CREATE TABLE `client_properties` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_group_id` int unsigned NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` enum('Mall','Hotel','Residence','Restaurant','Community','Departement Store','Supermarket','Retail','Entertainment','Others','Transportation','Telecommunication','Bank','Oil & Gas','Goverment','e-commerce','Medicine','Hospital','BUMN / BUMD','Tourist Attraction','Tour & Travel','Insurrance','SaaS','Manufacture') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_properties_client_group_id_index` (`client_group_id`),
  CONSTRAINT `client_properties_client_group_id_foreign` FOREIGN KEY (`client_group_id`) REFERENCES `client_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of client_properties
-- ----------------------------
BEGIN;
INSERT INTO `client_properties` VALUES (1, 1, '0101', 'Mall', '2020-10-10 08:37:06', '2020-10-10 08:37:06', NULL);
COMMIT;

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_group_id` int unsigned NOT NULL,
  `client_property_id` int unsigned NOT NULL,
  `scope_of_level` enum('client-group','client-property','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `code` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL COMMENT '-180 until 180',
  `latitude` decimal(8,6) DEFAULT NULL COMMENT '-90 until 90',
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_client_group_id_index` (`client_group_id`),
  KEY `clients_client_property_id_index` (`client_property_id`),
  CONSTRAINT `clients_client_group_id_foreign` FOREIGN KEY (`client_group_id`) REFERENCES `client_groups` (`id`),
  CONSTRAINT `clients_client_property_id_foreign` FOREIGN KEY (`client_property_id`) REFERENCES `client_properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clients
-- ----------------------------
BEGIN;
INSERT INTO `clients` VALUES (1, 1, 1, 'client', '010101', 'Demo Mall I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-10-10 08:37:06', '2020-10-10 08:37:06', NULL);
INSERT INTO `clients` VALUES (2, 1, 1, 'client', '010102', 'Demo Mall II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-10-10 08:37:06', '2020-10-10 08:37:06', NULL);
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_type` enum('Image','Video','Youtube') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Image',
  `default` tinyint(1) NOT NULL DEFAULT '1',
  `order` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_entity_type_entity_id_index` (`entity_type`,`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_11_000000_create_client_groups_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_11_000001_create_client_properties_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_11_000002_create_clients_table', 1);
INSERT INTO `migrations` VALUES (4, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (5, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (6, '2016_06_01_000001_create_oauth_auth_codes_table', 1);
INSERT INTO `migrations` VALUES (7, '2016_06_01_000002_create_oauth_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (8, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1);
INSERT INTO `migrations` VALUES (9, '2016_06_01_000004_create_oauth_clients_table', 1);
INSERT INTO `migrations` VALUES (10, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
INSERT INTO `migrations` VALUES (11, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_08_09_131722_create_user_login_histories_table', 1);
INSERT INTO `migrations` VALUES (13, '2020_08_10_122456_create_client_notices_table', 1);
INSERT INTO `migrations` VALUES (14, '2020_08_10_122600_create_images_table', 1);
INSERT INTO `migrations` VALUES (15, '2020_08_10_131029_laratrust_setup_tables', 1);
COMMIT;

-- ----------------------------
-- Table structure for mst_advertise
-- ----------------------------
DROP TABLE IF EXISTS `mst_advertise`;
CREATE TABLE `mst_advertise` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mst_advertise
-- ----------------------------
BEGIN;
INSERT INTO `mst_advertise` VALUES ('asd', 'JKT', 'JKT-B', 'asd', 1, '2020-10-18 14:03:25', NULL, '2020-10-18 14:03:25', NULL);
INSERT INTO `mst_advertise` VALUES ('asm,dn', 'JKT', 'JKT-B', 'mas df', 1, '2020-10-18 14:03:38', NULL, '2020-10-18 14:03:38', NULL);
INSERT INTO `mst_advertise` VALUES ('masd', 'JKT', 'JKT-B', 'kads', 1, '2020-10-18 14:03:34', NULL, '2020-10-18 14:03:34', NULL);
COMMIT;

-- ----------------------------
-- Table structure for mst_bank
-- ----------------------------
DROP TABLE IF EXISTS `mst_bank`;
CREATE TABLE `mst_bank` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mst_bank
-- ----------------------------
BEGIN;
INSERT INTO `mst_bank` VALUES ('123', 'JKT', 'JKT-B', '123', 1, '2020-10-18 11:47:24', NULL, '2020-10-18 11:47:24', NULL);
COMMIT;

-- ----------------------------
-- Table structure for mst_branch
-- ----------------------------
DROP TABLE IF EXISTS `mst_branch`;
CREATE TABLE `mst_branch` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_city
-- ----------------------------
DROP TABLE IF EXISTS `mst_city`;
CREATE TABLE `mst_city` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mst_city
-- ----------------------------
BEGIN;
INSERT INTO `mst_city` VALUES ('BND', 'JKT-B', 'JKT', 'Bandung', 1, '2020-10-17 19:54:16', NULL, '2020-10-17 19:54:16', NULL);
INSERT INTO `mst_city` VALUES ('TNG', 'JKT-B', 'JKT', 'Tangerang', 0, '2020-10-11 04:25:08', NULL, '2020-10-12 02:45:25', NULL);
COMMIT;

-- ----------------------------
-- Table structure for mst_clinic
-- ----------------------------
DROP TABLE IF EXISTS `mst_clinic`;
CREATE TABLE `mst_clinic` (
  `id` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_company
-- ----------------------------
DROP TABLE IF EXISTS `mst_company`;
CREATE TABLE `mst_company` (
  `id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mst_company
-- ----------------------------
BEGIN;
INSERT INTO `mst_company` VALUES ('DEV', 'DEV OPS', 1, 'DEV-ADM', '2020-06-14 10:23:36');
COMMIT;

-- ----------------------------
-- Table structure for mst_confirmation
-- ----------------------------
DROP TABLE IF EXISTS `mst_confirmation`;
CREATE TABLE `mst_confirmation` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mst_confirmation
-- ----------------------------
BEGIN;
INSERT INTO `mst_confirmation` VALUES ('asd', 'JKT', 'JKT-B', 'asd', 1, '2020-10-18 11:57:21', NULL, '2020-10-18 11:57:21', NULL);
COMMIT;

-- ----------------------------
-- Table structure for mst_courier
-- ----------------------------
DROP TABLE IF EXISTS `mst_courier`;
CREATE TABLE `mst_courier` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mst_courier
-- ----------------------------
BEGIN;
INSERT INTO `mst_courier` VALUES ('123', 'JKT', 'JKT-B', 'eqwe', 1, '2020-10-18 12:06:46', NULL, '2020-10-18 12:06:46', NULL);
COMMIT;

-- ----------------------------
-- Table structure for mst_gender
-- ----------------------------
DROP TABLE IF EXISTS `mst_gender`;
CREATE TABLE `mst_gender` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mst_gender
-- ----------------------------
BEGIN;
INSERT INTO `mst_gender` VALUES ('1', 'JKT', 'JKT-B', 'Bapak', 1, '2020-10-18 14:15:40', NULL, '2020-10-18 14:15:40', NULL);
INSERT INTO `mst_gender` VALUES ('2', 'JKT', 'JKT-B', 'Ibu', 1, '2020-10-18 14:15:45', NULL, '2020-10-18 14:15:45', NULL);
COMMIT;

-- ----------------------------
-- Table structure for mst_interaction
-- ----------------------------
DROP TABLE IF EXISTS `mst_interaction`;
CREATE TABLE `mst_interaction` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mst_interaction
-- ----------------------------
BEGIN;
INSERT INTO `mst_interaction` VALUES ('1', 'JKT', 'JKT-B', 'fb', 1, '2020-10-18 14:15:15', NULL, '2020-10-18 14:15:15', NULL);
INSERT INTO `mst_interaction` VALUES ('2', 'JKT', 'JKT-B', 'sosmed', 1, '2020-10-18 14:15:27', NULL, '2020-10-18 14:15:27', NULL);
COMMIT;

-- ----------------------------
-- Table structure for mst_item_price
-- ----------------------------
DROP TABLE IF EXISTS `mst_item_price`;
CREATE TABLE `mst_item_price` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_market
-- ----------------------------
DROP TABLE IF EXISTS `mst_market`;
CREATE TABLE `mst_market` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_payment_type
-- ----------------------------
DROP TABLE IF EXISTS `mst_payment_type`;
CREATE TABLE `mst_payment_type` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_periode
-- ----------------------------
DROP TABLE IF EXISTS `mst_periode`;
CREATE TABLE `mst_periode` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_produk
-- ----------------------------
DROP TABLE IF EXISTS `mst_produk`;
CREATE TABLE `mst_produk` (
  `id` varchar(50) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_ship_work
-- ----------------------------
DROP TABLE IF EXISTS `mst_ship_work`;
CREATE TABLE `mst_ship_work` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL,
  `CreatedDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedBy` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permission_user
-- ----------------------------
DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user` (
  `permission_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`user_id`,`user_type`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_on` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hide_on` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
BEGIN;
INSERT INTO `role_user` VALUES (1, 1, 'App\\Models\\User');
INSERT INTO `role_user` VALUES (2, 1, 'App\\Models\\User');
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_group_id` int unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_client_group_id_index` (`client_group_id`),
  CONSTRAINT `roles_client_group_id_foreign` FOREIGN KEY (`client_group_id`) REFERENCES `client_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 1, 'admin', 'Administrator', NULL, '2020-10-10 08:37:06', '2020-10-10 08:37:06');
INSERT INTO `roles` VALUES (2, 1, 'supervisor', 'Supervisor', NULL, '2020-10-10 08:37:06', '2020-10-10 08:37:06');
INSERT INTO `roles` VALUES (3, 1, 'cs', 'Customer Service', NULL, '2020-10-10 08:37:06', '2020-10-10 08:37:06');
COMMIT;

-- ----------------------------
-- Table structure for sls_clinic_patient
-- ----------------------------
DROP TABLE IF EXISTS `sls_clinic_patient`;
CREATE TABLE `sls_clinic_patient` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ShipWorkCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `AdvertiseCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `InteractionCode` varchar(100) DEFAULT NULL,
  `GenderCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `FullName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Age` int DEFAULT NULL,
  `Phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Consultation` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `Address` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `CityCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Schedule` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `LockStatus` tinyint(1) DEFAULT NULL,
  `ConfirmationCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `closing_status` tinyint(1) DEFAULT NULL,
  `ClosingBy` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ClosingDate` datetime DEFAULT NULL,
  `ImgPatient` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `ImgReservation` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `ImgConference` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `ImgClosing` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `SalesCode` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ActiveStatus` tinyint(1) DEFAULT NULL,
  `CreatedBy` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `FollowupStatus` tinyint(1) DEFAULT NULL,
  `FollowupDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sls_clinic_patient
-- ----------------------------
BEGIN;
INSERT INTO `sls_clinic_patient` VALUES ('JKTJKT-B5EJPO', NULL, NULL, NULL, 'masd', NULL, '2', 'Usna', NULL, '213', 'qweasd', NULL, NULL, '2020-10-18 17:31:00', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2020-10-18 17:32:36', NULL, '2020-10-18 17:32:46', NULL, NULL);
INSERT INTO `sls_clinic_patient` VALUES ('JKTJKT-B6GZHY', '1', NULL, NULL, 'asm,dn', '2', '1', '123', 12, '213', '123123123', '213', '123', '2041-02-27 00:25:00', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-10-18 17:31:34', 1, '2020-10-18 17:15:00');
INSERT INTO `sls_clinic_patient` VALUES ('JKTJKT-BMLWDJ', '1', NULL, NULL, 'asm,dn', '2', '1', '123', 12, '213', '123123123', '213', '123', '2041-02-27 00:25:00', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-10-18 17:34:01', 1, '2020-10-18 17:34:00');
INSERT INTO `sls_clinic_patient` VALUES ('JKTJKT-BTYSLW', '1', NULL, NULL, 'asm,dn', '2', '1', '123', 12, '213', '123123123', '213', '123', '2041-02-27 00:25:00', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-10-18 17:33:02', 1, '2020-10-18 17:15:00');
INSERT INTO `sls_clinic_patient` VALUES ('JKTJKT-BUK06X', NULL, NULL, NULL, NULL, NULL, 'Ibu', 'as', NULL, '12', NULL, NULL, NULL, '2020-10-18 04:44:00', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2020-10-18 04:44:32', NULL, '2020-10-18 17:16:38', 1, '2020-10-18 17:16:00');
COMMIT;

-- ----------------------------
-- Table structure for sls_clinic_visitor
-- ----------------------------
DROP TABLE IF EXISTS `sls_clinic_visitor`;
CREATE TABLE `sls_clinic_visitor` (
  `Code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CompanyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `BranchCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ShipWorkCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `AdvertiseCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `InteractionCode` varchar(100) DEFAULT NULL,
  `GenderCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `FullName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Age` int DEFAULT NULL,
  `Phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Consultation` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `Address` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `CityCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Schedule` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `LockStatus` tinyint(1) DEFAULT NULL,
  `ConfirmationCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `closing_status` tinyint(1) DEFAULT NULL,
  `ClosingBy` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ClosingDate` datetime DEFAULT NULL,
  `ImgPatient` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `ImgReservation` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `ImgConference` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `ImgClosing` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `SalesCode` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ActiveStatus` tinyint(1) DEFAULT NULL,
  `CreatedBy` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `FollowupBy` varchar(100) DEFAULT NULL,
  `FollowupDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sls_clinic_visitor
-- ----------------------------
BEGIN;
INSERT INTO `sls_clinic_visitor` VALUES ('JKTJKT-B5EJPO', NULL, NULL, NULL, 'masd', NULL, '2', 'Usna', NULL, '213', 'qweasd', NULL, NULL, '2020-10-18 17:31:00', 0, 1, 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2020-10-18 17:32:36', NULL, '2020-10-18 17:33:02', NULL, NULL);
INSERT INTO `sls_clinic_visitor` VALUES ('JKTJKT-BDNROQ', '1', NULL, NULL, 'asm,dn', '2', '1', '123', 12, '213', '123123123', '213', '123', '2041-02-27 00:25:00', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-10-18 17:34:01', 'Imam', '2020-10-18 17:34:00');
INSERT INTO `sls_clinic_visitor` VALUES ('JKTJKT-BHESIB', NULL, NULL, NULL, NULL, NULL, 'Ibu', 'as', NULL, '12', NULL, NULL, NULL, '2020-10-18 04:44:00', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2020-10-18 04:44:32', NULL, '2020-10-18 17:16:38', 'Imam', '2020-10-18 17:16:00');
COMMIT;

-- ----------------------------
-- Table structure for sls_product_customer
-- ----------------------------
DROP TABLE IF EXISTS `sls_product_customer`;
CREATE TABLE `sls_product_customer` (
  `id` varchar(50) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `ship_work` varchar(50) DEFAULT NULL,
  `product` varchar(50) DEFAULT NULL,
  `advertise` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `consultation` text,
  `status` tinyint(1) DEFAULT NULL,
  `sales_id` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sls_product_customer_address
-- ----------------------------
DROP TABLE IF EXISTS `sls_product_customer_address`;
CREATE TABLE `sls_product_customer_address` (
  `id` varchar(50) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `ship_work` varchar(50) DEFAULT NULL,
  `product` varchar(50) DEFAULT NULL,
  `advertise` varchar(50) DEFAULT NULL,
  `customer_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` text,
  `address_no` text,
  `rt` text,
  `rw` text,
  `village` text,
  `sub_district` text,
  `benchmark` text,
  `district` text,
  `city` text,
  `province` text,
  `postal_code` text,
  `sales_id` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sls_product_transaction
-- ----------------------------
DROP TABLE IF EXISTS `sls_product_transaction`;
CREATE TABLE `sls_product_transaction` (
  `id` varchar(50) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `ship_work` varchar(50) DEFAULT NULL,
  `product` varchar(50) DEFAULT NULL,
  `advertise` varchar(50) DEFAULT NULL,
  `customer_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `customer_address_id` varchar(100) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `courier_cost` varchar(50) DEFAULT NULL,
  `insurance` varchar(50) DEFAULT NULL,
  `market` varchar(50) DEFAULT NULL,
  `courier` varchar(50) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `transaction_at` datetime DEFAULT NULL,
  `delivery_at` datetime DEFAULT NULL,
  `confirm_status` tinyint(1) DEFAULT NULL,
  `confirm_by` varchar(100) DEFAULT NULL,
  `confirm_at` datetime DEFAULT NULL,
  `warehouse_status` tinyint(1) DEFAULT NULL,
  `warehouse_by` varchar(100) DEFAULT NULL,
  `warehouse_at` datetime DEFAULT NULL,
  `closing_status` tinyint(1) DEFAULT NULL,
  `closing_by` varchar(100) DEFAULT NULL,
  `closing_at` datetime DEFAULT NULL,
  `img_transaction` text,
  `img_packing` text,
  `img_delivery` text,
  `sales_id` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sls_product_visitor
-- ----------------------------
DROP TABLE IF EXISTS `sls_product_visitor`;
CREATE TABLE `sls_product_visitor` (
  `id` varchar(50) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `ship_work` varchar(50) DEFAULT NULL,
  `product` varchar(50) DEFAULT NULL,
  `advertise` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `sales_id` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `link_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `page_id` int NOT NULL DEFAULT '0',
  `module_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `url` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `uri` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `dyn_group_id` int NOT NULL DEFAULT '0',
  `position` int NOT NULL DEFAULT '0',
  `target` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `show_menu` tinyint(1) NOT NULL DEFAULT '1',
  `fa_icon` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=60006 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
BEGIN;
INSERT INTO `sys_menu` VALUES (1000, 'Dashboard', 'page', 34, 'klinik', '#', '', 0, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Layout\\Layout-4-blocks.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" x=\"4\" y=\"4\" width=\"7\" height=\"7\" rx=\"1.5\"/>\n        <path d=\"M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z\" fill=\"#000000\" opacity=\"0.3\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (1001, 'Dashboard Klinik', 'page', 35, 'klinik', 'klinik-DashboardKlinik', '', 0, 0, NULL, 1000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (1002, 'Dashboard Iklan', 'page', 36, 'klinik', 'klinik-DashboardIklan', '', 0, 0, NULL, 1000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (1003, 'Dashboard Management', 'page', 37, 'klinik', 'klinik-DashboardManagement', '', 0, 0, NULL, 1000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (1004, 'Dashboard HRD', 'page', 38, 'klinik', 'klinik-DashboardHRD', '', 0, 0, NULL, 1000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (1005, 'Dashboard Manajer', 'page', 39, 'klinik', 'klinik-DashboardManajer', '', 0, 0, NULL, 1000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (2000, 'Marketing', 'folder', 40, '', '#', '', 1, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Communication\\Chat-check.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <path d=\"M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z\" fill=\"#000000\" fill-rule=\"nonzero\" opacity=\"0.3\"/>\n        <path d=\"M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z\" fill=\"#000000\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (2001, 'Interaksi', 'page', 41, 'klinik-marketing', 'klinik-marketing-Interaksi', '', 0, 0, NULL, 2000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (2002, 'Follow Up', 'page', 43, 'klinik-marketing', 'klinik-marketing-FollowUp', '', 0, 0, NULL, 2000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (2003, 'Closing Pasien', 'page', 44, 'klinik-marketing', 'klinik-marketing-ClosingPasien', '', 0, 0, NULL, 2000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (3000, 'Management Klinik', 'folder', 45, '', '#', '', 1, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Home\\Building.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <path d=\"M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z\" fill=\"#000000\"/>\n        <rect fill=\"#FFFFFF\" x=\"13\" y=\"8\" width=\"3\" height=\"3\" rx=\"1\"/>\n        <path d=\"M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z\" fill=\"#000000\" opacity=\"0.3\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (3001, 'Performance', 'page', 46, 'klinik-management', 'klinik-management-Performance', '', 0, 0, NULL, 3000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (3002, 'Statistic', 'page', 47, 'klinik-management', 'klinik-management-Statistic', '', 0, 0, NULL, 3000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (4000, 'Report Klinik', 'folder', 48, '', '#', '', 1, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Communication\\Clipboard-list.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <path d=\"M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z\" fill=\"#000000\" opacity=\"0.3\"/>\n        <path d=\"M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z\" fill=\"#000000\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"10\" y=\"9\" width=\"7\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"7\" y=\"9\" width=\"2\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"7\" y=\"13\" width=\"2\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"10\" y=\"13\" width=\"7\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"7\" y=\"17\" width=\"2\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"10\" y=\"17\" width=\"7\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (4001, 'Closing Pasien', 'page', 49, 'klinik-report', 'klinik-report-ClosingPasien', '', 0, 0, NULL, 4000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (4002, 'Data Interaksi', 'page', 50, 'klinik-report', 'klinik-report-DataInteraksi', '', 0, 0, NULL, 4000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (10000, 'Dashboard', 'page', 1, 'produk', '#', '', 0, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Layout\\Layout-4-blocks.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" x=\"4\" y=\"4\" width=\"7\" height=\"7\" rx=\"1.5\"/>\n        <path d=\"M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z\" fill=\"#000000\" opacity=\"0.3\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (10001, 'Dashboard Produk', 'page', 2, 'produk', 'produk-DashboardProduk', '', 0, 0, NULL, 10000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (10002, 'Dashboard Admin', 'page', 4, 'produk', 'produk-DashboardAdmin', '', 0, 0, NULL, 10000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (10003, 'Dashboard Gudang', 'page', 5, 'produk', 'produk-DashboardGudang', '', 0, 0, NULL, 10000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (10004, 'Dashboard Iklan', 'page', 6, 'produk', 'produk-DashboardIklan', '', 0, 0, NULL, 10000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (10005, 'Dashboard Management', 'page', 7, 'produk', 'produk-DashboardManagement', '', 0, 0, NULL, 10000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (10006, 'Dashboard HRD', 'page', 8, 'produk', 'produk-DashboardHRD', '', 0, 0, NULL, 10000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (10008, 'Dashboard Manajer', 'page', 9, 'produk', 'produk-DashboardManajer', '', 0, 0, NULL, 10000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Media\\Equalizer.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"13\" y=\"4\" width=\"3\" height=\"16\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"8\" y=\"9\" width=\"3\" height=\"11\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"18\" y=\"11\" width=\"3\" height=\"9\" rx=\"1.5\"/>\n        <rect fill=\"#000000\" x=\"3\" y=\"13\" width=\"3\" height=\"7\" rx=\"1.5\"/>\n    </g>\n</svg><!--end::Svg Icon--></span></svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (20000, 'Marketing Produk', 'folder', 10, '', '#', '', 1, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Shopping\\Bag1.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <path d=\"M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z\" fill=\"#000000\" fill-rule=\"nonzero\" opacity=\"0.3\"/>\n        <path d=\"M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z\" fill=\"#000000\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (20001, 'Interaksi', 'page', 11, 'produk-marketing', 'produk-marketing-Interaksi', '', 0, 0, NULL, 20000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (20002, 'Follow Up', 'page', 12, 'produk-marketing', 'produk-marketing-FollowUp', '', 0, 0, NULL, 20000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (20003, 'Closing Reqs', 'page', 12, 'produk-marketing', 'produk-marketing-ClosingReqs', '', 0, 0, NULL, 20000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (20004, 'Closing Approved', 'page', 13, 'produk-marketing', 'produk-marketing-ClosingApproved', '', 0, 0, NULL, 20000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (20005, 'Closing Delivery', 'page', 14, 'produk-marketing', 'produk-marketing-ClosingDelivery', '', 0, 0, NULL, 20000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (30000, 'Management Produk', 'folder', 15, '', '#', '', 1, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Home\\Building.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <path d=\"M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z\" fill=\"#000000\"/>\n        <rect fill=\"#FFFFFF\" x=\"13\" y=\"8\" width=\"3\" height=\"3\" rx=\"1\"/>\n        <path d=\"M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z\" fill=\"#000000\" opacity=\"0.3\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (30001, 'Performance', 'page', 16, 'produk-management', 'produk-management-Performance', '', 0, 0, NULL, 30000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (30002, 'Statistic', 'page', 17, 'produk-management', 'produk-management-Statistic', '', 0, 0, NULL, 30000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (40000, 'Report Produk', 'folder', 18, '', '#', '', 1, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Communication\\Clipboard-list.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <path d=\"M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z\" fill=\"#000000\" opacity=\"0.3\"/>\n        <path d=\"M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z\" fill=\"#000000\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"10\" y=\"9\" width=\"7\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"7\" y=\"9\" width=\"2\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"7\" y=\"13\" width=\"2\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"10\" y=\"13\" width=\"7\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"7\" y=\"17\" width=\"2\" height=\"2\" rx=\"1\"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"10\" y=\"17\" width=\"7\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (40001, 'Order Produk', 'page', 19, 'produk-report', 'produk-report-OrderProduk', '', 0, 0, NULL, 40000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (40002, 'Closing Produk', 'page', 20, 'produk-report', 'produk-report-ClosingProduk', '', 0, 0, NULL, 40000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (40003, 'Bonus Produk', 'page', 21, 'produk-report', 'produk-report-BonusProduk', '', 0, 0, NULL, 40000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (40004, 'Omset Produk', 'page', 22, 'produk-report', 'produk-report-OmsetProduk', '', 0, 0, NULL, 40000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (50000, 'Admin Produk', 'folder', 23, '', '#', '', 1, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Communication\\Chat-check.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <path d=\"M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z\" fill=\"#000000\" fill-rule=\"nonzero\" opacity=\"0.3\"/>\n        <path d=\"M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z\" fill=\"#000000\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (50001, 'Interaksi Customer', 'page', 24, 'produk-admin', 'produk-admin-InteraksiCustomer', '', 0, 0, NULL, 50000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (50002, 'Order Produk', 'page', 25, 'produk-admin', 'produk-admin-OrderProduk', '', 0, 0, NULL, 50000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (50003, 'Closing Produk', 'page', 26, 'produk-admin', 'produk-admin-ClosingProduk', '', 0, 0, NULL, 50000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (50004, 'Bank', 'page', 27, 'produk-admin', 'produk-admin-Bank', '', 0, 0, NULL, 50000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (60000, 'Gudang Produk', 'folder', 28, '', '#', '', 1, 0, NULL, 0, 1, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Shopping\\Box3.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <rect x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\n        <path d=\"M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z\" fill=\"#000000\" opacity=\"0.3\"/>\n        <polygon fill=\"#000000\" points=\"14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (60001, 'Delivery Order', 'page', 29, 'produk-gudang', 'produk-gudang-DeliveryOrder', '', 0, 0, NULL, 60000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (60002, 'Return Order', 'page', 30, 'produk-gudang', 'produk-gudang-ReturnOrder', '', 0, 0, NULL, 60000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (60003, 'Stock In', 'page', 31, 'produk-gudang', 'produk-gudang-StockIn', '', 0, 0, NULL, 60000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (60004, 'Stock Out', 'page', 32, 'produk-gudang', 'produk-gudang-StockOut', '', 0, 0, NULL, 60000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
INSERT INTO `sys_menu` VALUES (60005, 'Stock Opname', 'page', 33, 'produk-gudang', 'produk-gudang-StockOpname', '', 0, 0, NULL, 60000, 0, 1, '<span class=\"svg-icon svg-icon-primary svg-icon-2x\"><!--begin::Svg Icon | path:C:\\wamp64\\www\\keenthemes\\themes\\metronic\\theme\\html\\demo1\\dist/../src/media/svg/icons\\Code\\Terminal.svg--><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\">\n    <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\n        <polygon points=\"0 0 24 0 24 24 0 24\"/>\n        <path d=\"M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) \"/>\n        <rect fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"17\" width=\"10\" height=\"2\" rx=\"1\"/>\n    </g>\n</svg><!--end::Svg Icon--></span>');
COMMIT;

-- ----------------------------
-- Table structure for sys_setup
-- ----------------------------
DROP TABLE IF EXISTS `sys_setup`;
CREATE TABLE `sys_setup` (
  `id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hostname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `branch_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `logo_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `bg_login_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `icon_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_setup
-- ----------------------------
BEGIN;
INSERT INTO `sys_setup` VALUES ('SYS', 'localhost', 'HPI MANAGEMENT', 'HPI MANAGEMENT', 'images/logo-tacyon.jpg', 'images/background/bg-network.jpg', 'images/background/logo-tacyon.jpg');
COMMIT;

-- ----------------------------
-- Table structure for user_login_histories
-- ----------------------------
DROP TABLE IF EXISTS `user_login_histories`;
CREATE TABLE `user_login_histories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_group_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_login_histories_user_id_foreign` (`user_id`),
  KEY `user_login_histories_client_group_id_index` (`client_group_id`),
  CONSTRAINT `user_login_histories_client_group_id_foreign` FOREIGN KEY (`client_group_id`) REFERENCES `client_groups` (`id`),
  CONSTRAINT `user_login_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_login_histories
-- ----------------------------
BEGIN;
INSERT INTO `user_login_histories` VALUES (1, 1, 2, '::1', 'Chrome', 'OS X', '2020-10-11 03:56:21', '2020-10-11 03:56:21');
INSERT INTO `user_login_histories` VALUES (2, 1, 2, '::1', 'Chrome', 'OS X', '2020-10-12 02:44:38', '2020-10-12 02:44:38');
INSERT INTO `user_login_histories` VALUES (3, 1, 2, '::1', 'Chrome', 'OS X', '2020-10-17 19:21:55', '2020-10-17 19:21:55');
INSERT INTO `user_login_histories` VALUES (4, 1, 2, '::1', 'Chrome', 'OS X', '2020-10-18 04:29:14', '2020-10-18 04:29:14');
INSERT INTO `user_login_histories` VALUES (5, 1, 2, '::1', 'Chrome', 'OS X', '2020-10-18 08:07:58', '2020-10-18 08:07:58');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_group_id` int unsigned NOT NULL,
  `client_property_id` int unsigned DEFAULT NULL,
  `client_id` int unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `billing_recipient` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forgot_password_token` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_client_group_id_index` (`client_group_id`),
  KEY `users_client_property_id_index` (`client_property_id`),
  KEY `users_client_id_index` (`client_id`),
  KEY `users_email_index` (`email`),
  KEY `users_username_index` (`username`),
  CONSTRAINT `users_client_group_id_foreign` FOREIGN KEY (`client_group_id`) REFERENCES `client_groups` (`id`),
  CONSTRAINT `users_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `users_client_property_id_foreign` FOREIGN KEY (`client_property_id`) REFERENCES `client_properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 1, NULL, NULL, 'global admin demo', 'globaladmin@demo.com', 'globaladmindemo', '$2y$10$Alsxvfxs6njBdOnsVCNN5eRbr4NMcsXaU3O7K8Wlx7MhZsYf4mHt2', 1, 1, NULL, NULL, NULL, NULL, '2020-10-10 08:37:06', '2020-10-10 08:37:06', NULL);
INSERT INTO `users` VALUES (2, 1, 1, 1, 'Fandy Kurniawan', 'admin@admin.com', 'admin', '$2y$10$PkKENgJBk3U4mX3R8Pv8CeZmCCiOlRvaXIFKr.sUUzdFVyJyFZ/AC', 1, 0, '2020-10-18 08:07:58', NULL, NULL, NULL, '2020-10-10 08:37:06', '2020-10-18 08:07:58', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
