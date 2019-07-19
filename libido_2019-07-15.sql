# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.8-MariaDB)
# Database: libido
# Generation Time: 2019-07-15 08:38:08 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table advertiser_icons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advertiser_icons`;

CREATE TABLE `advertiser_icons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `advertiser_icons` WRITE;
/*!40000 ALTER TABLE `advertiser_icons` DISABLE KEYS */;

INSERT INTO `advertiser_icons` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Test','1553442195324.jpg','2019-03-24 15:43:15','2019-03-24 15:43:15',NULL);

/*!40000 ALTER TABLE `advertiser_icons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table condoms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `condoms`;

CREATE TABLE `condoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table encounter_condoms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `encounter_condoms`;

CREATE TABLE `encounter_condoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `condom_id` int(10) unsigned NOT NULL,
  `encounter_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `encounter_condoms_condom_id_foreign` (`condom_id`),
  KEY `encounter_condoms_encounter_id_foreign` (`encounter_id`),
  CONSTRAINT `encounter_condoms_condom_id_foreign` FOREIGN KEY (`condom_id`) REFERENCES `condoms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounter_condoms_encounter_id_foreign` FOREIGN KEY (`encounter_id`) REFERENCES `encounters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table encounter_orgasams
# ------------------------------------------------------------

DROP TABLE IF EXISTS `encounter_orgasams`;

CREATE TABLE `encounter_orgasams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `encounter_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `partner_id` int(10) unsigned NOT NULL,
  `no_of_orgasams` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `encounter_orgasams_room_id_foreign` (`room_id`),
  KEY `encounter_orgasams_encounter_id_foreign` (`encounter_id`),
  KEY `encounter_orgasams_partner_id_foreign` (`partner_id`),
  CONSTRAINT `encounter_orgasams_encounter_id_foreign` FOREIGN KEY (`encounter_id`) REFERENCES `encounters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounter_orgasams_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounter_orgasams_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `encounter_orgasams` WRITE;
/*!40000 ALTER TABLE `encounter_orgasams` DISABLE KEYS */;

INSERT INTO `encounter_orgasams` (`id`, `encounter_id`, `room_id`, `partner_id`, `no_of_orgasams`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,2,1,7,'2019-02-13 09:25:19','2019-02-13 09:25:19',NULL),
	(2,7,4,3,3,'2019-06-18 12:31:13','2019-06-18 12:31:13',NULL),
	(3,8,4,4,3,'2019-06-18 12:55:55','2019-06-18 12:55:55',NULL);

/*!40000 ALTER TABLE `encounter_orgasams` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table encounter_partners
# ------------------------------------------------------------

DROP TABLE IF EXISTS `encounter_partners`;

CREATE TABLE `encounter_partners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `encounter_id` int(10) unsigned NOT NULL,
  `partner_id` int(10) unsigned NOT NULL,
  `no_of_orgasams` int(11) NOT NULL DEFAULT '0',
  `is_protection_used` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no 1=yes',
  `is_initiated` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=yes 0=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `encounter_partners_encounter_id_foreign` (`encounter_id`),
  KEY `encounter_partners_partner_id_foreign` (`partner_id`),
  CONSTRAINT `encounter_partners_encounter_id_foreign` FOREIGN KEY (`encounter_id`) REFERENCES `encounters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounter_partners_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `encounter_partners` WRITE;
/*!40000 ALTER TABLE `encounter_partners` DISABLE KEYS */;

INSERT INTO `encounter_partners` (`id`, `encounter_id`, `partner_id`, `no_of_orgasams`, `is_protection_used`, `is_initiated`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,1,0,0,1,'2019-02-13 09:21:17','2019-02-13 09:21:51',NULL),
	(2,5,2,0,0,1,'2019-03-15 17:40:46','2019-03-15 17:42:04',NULL),
	(3,7,3,0,0,0,'2019-06-18 12:22:11','2019-06-18 12:28:59',NULL),
	(4,8,4,0,0,0,'2019-06-18 12:55:17','2019-06-18 12:55:25',NULL);

/*!40000 ALTER TABLE `encounter_partners` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table encounter_positions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `encounter_positions`;

CREATE TABLE `encounter_positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL,
  `position_id` int(10) unsigned NOT NULL,
  `encounter_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `encounter_positions_room_id_foreign` (`room_id`),
  KEY `encounter_positions_position_id_foreign` (`position_id`),
  KEY `encounter_positions_encounter_id_foreign` (`encounter_id`),
  CONSTRAINT `encounter_positions_encounter_id_foreign` FOREIGN KEY (`encounter_id`) REFERENCES `encounters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounter_positions_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounter_positions_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `encounter_positions` WRITE;
/*!40000 ALTER TABLE `encounter_positions` DISABLE KEYS */;

INSERT INTO `encounter_positions` (`id`, `room_id`, `position_id`, `encounter_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,2,1,1,'2019-02-13 09:25:13','2019-02-13 09:25:13',NULL),
	(2,4,2,7,'2019-06-18 12:30:58','2019-06-18 12:30:58',NULL),
	(3,4,2,8,'2019-06-18 12:55:44','2019-06-18 12:55:44',NULL);

/*!40000 ALTER TABLE `encounter_positions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table encounter_rooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `encounter_rooms`;

CREATE TABLE `encounter_rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL,
  `encounter_id` int(10) unsigned NOT NULL,
  `how_long` int(11) DEFAULT NULL,
  `no_of_orgasam` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `encounter_rooms_room_id_foreign` (`room_id`),
  KEY `encounter_rooms_encounter_id_foreign` (`encounter_id`),
  CONSTRAINT `encounter_rooms_encounter_id_foreign` FOREIGN KEY (`encounter_id`) REFERENCES `encounters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounter_rooms_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `encounter_rooms` WRITE;
/*!40000 ALTER TABLE `encounter_rooms` DISABLE KEYS */;

INSERT INTO `encounter_rooms` (`id`, `room_id`, `encounter_id`, `how_long`, `no_of_orgasam`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,2,1,80,8,'2019-02-13 09:25:13','2019-02-13 09:25:19',NULL),
	(2,4,7,5,2,'2019-06-18 12:30:58','2019-06-18 12:31:13',NULL),
	(3,4,8,5,0,'2019-06-18 12:55:44','2019-06-18 12:55:55',NULL);

/*!40000 ALTER TABLE `encounter_rooms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table encounter_toys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `encounter_toys`;

CREATE TABLE `encounter_toys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `toy_id` int(10) unsigned NOT NULL,
  `encounter_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `encounter_toys_toy_id_foreign` (`toy_id`),
  KEY `encounter_toys_encounter_id_foreign` (`encounter_id`),
  CONSTRAINT `encounter_toys_encounter_id_foreign` FOREIGN KEY (`encounter_id`) REFERENCES `encounters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounter_toys_toy_id_foreign` FOREIGN KEY (`toy_id`) REFERENCES `toys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table encounters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `encounters`;

CREATE TABLE `encounters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned DEFAULT NULL,
  `is_protection_used` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=yes 0=no',
  `is_toy_used` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=yes 0=no',
  `is_intoxicant_used` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=yes 0=no',
  `is_lublicant_used` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=yes 0=no',
  `session_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=solo 2=single 3=multiple',
  `encounter_date` date NOT NULL,
  `encounter_time` time NOT NULL,
  `no_of_orgasam` int(11) DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step` int(11) NOT NULL DEFAULT '0',
  `is_intercourse` int(11) NOT NULL DEFAULT '0' COMMENT '0=no 1=yes',
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `encounters_user_id_foreign` (`user_id`),
  KEY `encounters_tag_id_foreign` (`tag_id`),
  CONSTRAINT `encounters_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `encounters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `encounters` WRITE;
/*!40000 ALTER TABLE `encounters` DISABLE KEYS */;

INSERT INTO `encounters` (`id`, `user_id`, `tag_id`, `is_protection_used`, `is_toy_used`, `is_intoxicant_used`, `is_lublicant_used`, `session_type`, `encounter_date`, `encounter_time`, `no_of_orgasam`, `duration`, `location`, `country`, `city`, `step`, `is_intercourse`, `timezone`, `offset`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,4,NULL,0,0,1,1,2,'2019-02-13','14:45:00',NULL,NULL,'Delhi, Delhi, India','India','Delhi',8,1,'Asia/Calcutta','-19800','2019-02-13 09:16:07','2019-02-13 09:25:27',NULL),
	(2,3,NULL,0,0,0,0,2,'2019-02-13','22:12:00',NULL,NULL,'Sector 23A, Haryana, India','India','Haryana',1,0,'Asia/Calcutta','-19800','2019-02-13 16:43:01','2019-02-13 16:43:01',NULL),
	(3,5,NULL,0,0,0,0,2,'2019-03-15','16:04:00',NULL,NULL,'Sector 18, Haryana, India','India','Haryana',1,0,'Asia/Calcutta','-19800','2019-03-15 10:35:05','2019-03-15 10:35:05',NULL),
	(4,8,NULL,0,0,0,0,1,'2019-02-13','23:07:00',NULL,NULL,'Delhi, Delhi, India','India','Delhi',1,0,'Asia/Calcutta','-19800','2019-03-15 17:37:46','2019-03-15 17:39:14','2019-03-15 17:39:14'),
	(5,8,NULL,0,0,1,1,3,'2019-02-13','23:07:00',NULL,NULL,'Delhi, Delhi, India','India','Delhi',4,1,'Asia/Calcutta','-19800','2019-03-15 17:39:16','2019-03-15 17:42:39',NULL),
	(6,10,NULL,0,0,0,0,3,'2019-06-07','17:33:00',NULL,NULL,NULL,'India','Jaipur',1,0,'Asia/Calcutta','-19800','2019-06-07 12:04:09','2019-06-07 12:04:09',NULL),
	(7,3,NULL,0,0,0,0,2,'2019-06-18','17:50:00',NULL,NULL,'Gomti Nagar, Uttar Pradesh, India','India','Uttar Pradesh',8,0,'Asia/Calcutta','-19800','2019-06-18 12:20:14','2019-06-18 12:31:24',NULL),
	(8,3,NULL,0,0,0,0,2,'2019-06-18','18:23:00',NULL,NULL,'Gomti Nagar, Uttar Pradesh, India','India','Uttar Pradesh',8,0,'Asia/Calcutta','-19800','2019-06-18 12:54:08','2019-06-18 12:56:05',NULL);

/*!40000 ALTER TABLE `encounters` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table favourite_positions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `favourite_positions`;

CREATE TABLE `favourite_positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `position_id` int(10) unsigned NOT NULL,
  `is_favourite` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=yes 0=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favourite_positions_user_id_foreign` (`user_id`),
  KEY `favourite_positions_position_id_foreign` (`position_id`),
  CONSTRAINT `favourite_positions_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favourite_positions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table favourite_rooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `favourite_rooms`;

CREATE TABLE `favourite_rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `is_favourite` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=yes 0=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favourite_rooms_user_id_foreign` (`user_id`),
  KEY `favourite_rooms_room_id_foreign` (`room_id`),
  CONSTRAINT `favourite_rooms_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favourite_rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`)
VALUES
	(1,'default','{\"displayName\":\"App\\\\Jobs\\\\Emailer\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\Emailer\",\"command\":\"O:16:\\\"App\\\\Jobs\\\\Emailer\\\":8:{s:7:\\\"\\u0000*\\u0000data\\\";a:2:{s:13:\\\"emailTemplate\\\";s:22:\\\"emails.forgot-password\\\";s:9:\\\"emailData\\\";a:5:{s:5:\\\"email\\\";s:16:\\\"alex@yopmail.com\\\";s:4:\\\"name\\\";s:10:\\\"Alex Smith\\\";s:7:\\\"subject\\\";s:21:\\\"Forgot Your Password.\\\";s:4:\\\"link\\\";s:66:\\\"http:\\/\\/libidoapp.com.au\\/user\\/reset-password?token=7277bd1552671111\\\";s:8:\\\"org_name\\\";s:6:\\\"Libido\\\";}}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1552671111,1552671111);

/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2018_08_20_104358_create_advertiser_icon_table',1),
	(4,'2018_08_20_104645_create_survey_questions_table',1),
	(5,'2018_08_20_104654_create_survey_answers_table',1),
	(6,'2018_08_20_112007_create_tags_table',1),
	(7,'2018_08_20_112329_create_encounters_table',1),
	(8,'2018_08_20_113809_create_condoms_table',1),
	(9,'2018_08_21_045948_create_user_devices_table',1),
	(10,'2018_08_22_062103_create_jobs_table',1),
	(11,'2018_08_27_061801_create_rooms_table',1),
	(12,'2018_08_27_061813_create_positions_table',1),
	(13,'2018_08_27_061820_create_toys_table',1),
	(14,'2018_08_27_061944_create_partners_table',1),
	(15,'2018_08_27_061945_create_encounter_partners_table',1),
	(16,'2018_08_27_061946_create_encounter_condoms_table',1),
	(17,'2018_08_27_061955_create_encounter_rooms_table',1),
	(18,'2018_08_27_062003_create_encounter_positions_table',1),
	(19,'2018_08_27_062010_create_encounter_toys_table',1),
	(20,'2018_08_28_090947_edit_encounters_table',1),
	(21,'2018_08_30_035530_edit_encounter_partners_table',1),
	(22,'2018_08_31_045353_edit_encounter_rooms_table',1),
	(23,'2018_08_31_050504_create_encounter_orgasams_table',1),
	(24,'2018_09_13_071322_edit_partner_table',1),
	(25,'2018_09_21_041331_edit_partners_table',1),
	(26,'2018_09_25_052029_edit_encounters_table',1),
	(27,'2018_09_25_100434_create_favourite_rooms_table',1),
	(28,'2018_09_25_100445_create_favourite_positions_table',1),
	(29,'2018_09_26_055540_edit_users_table',1),
	(30,'2018_09_28_055437_edit_rooms_table',1),
	(31,'2018_10_23_092546_create_survey_table',1),
	(32,'2018_11_14_094043_edit_toys_table',1),
	(33,'2018_11_27_041531_edit_encounter_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table partners
# ------------------------------------------------------------

DROP TABLE IF EXISTS `partners`;

CREATE TABLE `partners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `mapped_user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=male 2=female',
  `is_removed` int(11) NOT NULL DEFAULT '0' COMMENT '0=no 1=yes',
  `is_long_term_relation` int(11) NOT NULL DEFAULT '0' COMMENT '0=no 1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partners_user_id_foreign` (`user_id`),
  KEY `partners_mapped_user_id_foreign` (`mapped_user_id`),
  CONSTRAINT `partners_mapped_user_id_foreign` FOREIGN KEY (`mapped_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `partners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;

INSERT INTO `partners` (`id`, `user_id`, `mapped_user_id`, `name`, `image`, `age`, `gender`, `is_removed`, `is_long_term_relation`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,4,NULL,'emily','155004952962724.jpg',22,2,0,1,'2019-02-13 09:18:49','2019-06-19 17:05:59',NULL),
	(2,8,NULL,'jessica','155267163619985.jpg',27,2,0,1,'2019-03-15 17:40:36','2019-03-15 18:10:20',NULL),
	(3,3,NULL,'Martin','156086052199080.jpg',18,2,0,0,'2019-06-18 12:22:01','2019-06-18 12:22:01',NULL),
	(4,3,NULL,'Rebecca','156086250572464.jpg',33,2,0,0,'2019-06-18 12:55:05','2019-06-18 12:55:05',NULL);

/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table positions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `positions_user_id_foreign` (`user_id`),
  CONSTRAINT `positions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;

INSERT INTO `positions` (`id`, `user_id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,4,'random',NULL,'2019-02-13 09:25:03','2019-02-13 09:25:03',NULL),
	(2,3,'COWGIRL',NULL,'2019-06-18 12:30:50','2019-06-18 12:30:50',NULL);

/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_outside` int(11) NOT NULL DEFAULT '0' COMMENT '0=no 1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rooms_user_id_foreign` (`user_id`),
  CONSTRAINT `rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;

INSERT INTO `rooms` (`id`, `user_id`, `name`, `image`, `is_outside`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,4,'bedroom',NULL,0,'2019-02-13 09:24:23','2019-02-13 09:24:23',NULL),
	(2,4,'kitchen',NULL,0,'2019-02-13 09:24:36','2019-02-13 09:24:36',NULL),
	(3,8,'chhat',NULL,0,'2019-03-15 17:43:03','2019-03-15 17:43:03',NULL),
	(4,3,'Bathroom',NULL,0,'2019-06-18 12:30:04','2019-06-18 12:30:04',NULL);

/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table survey_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_answers`;

CREATE TABLE `survey_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `survey_id` int(11) NOT NULL,
  `answers` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=intersted 2=intersted if partner is 3=not intersted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_answers_user_id_foreign` (`user_id`),
  KEY `survey_answers_question_id_foreign` (`question_id`),
  CONSTRAINT `survey_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `survey_questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `survey_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `survey_answers` WRITE;
/*!40000 ALTER TABLE `survey_answers` DISABLE KEYS */;

INSERT INTO `survey_answers` (`id`, `user_id`, `question_id`, `survey_id`, `answers`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(14,3,6,0,3,'2019-06-18 08:24:10','2019-06-18 08:24:10',NULL),
	(15,3,4,0,1,'2019-06-18 08:24:23','2019-06-18 08:24:23',NULL),
	(16,4,1,0,3,'2019-06-19 17:01:00','2019-06-19 17:01:00',NULL),
	(17,4,2,0,1,'2019-06-19 17:01:06','2019-06-19 17:01:06',NULL),
	(18,4,3,0,1,'2019-06-19 17:03:22','2019-06-19 17:03:22',NULL),
	(19,4,4,0,3,'2019-06-19 17:03:24','2019-06-19 17:03:24',NULL),
	(20,4,5,0,1,'2019-06-19 17:04:53','2019-06-19 17:04:53',NULL),
	(21,4,6,0,2,'2019-06-19 17:04:56','2019-06-19 17:04:56',NULL),
	(22,4,7,0,3,'2019-06-19 17:04:58','2019-06-19 17:04:58',NULL),
	(23,4,8,0,1,'2019-06-19 17:05:01','2019-06-19 17:05:01',NULL),
	(24,4,9,0,2,'2019-06-19 17:05:04','2019-06-19 17:05:04',NULL);

/*!40000 ALTER TABLE `survey_answers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table survey_questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_questions`;

CREATE TABLE `survey_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questions` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `survey_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_questions_survey_id_foreign` (`survey_id`),
  CONSTRAINT `survey_questions_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `survey_questions` WRITE;
/*!40000 ALTER TABLE `survey_questions` DISABLE KEYS */;

INSERT INTO `survey_questions` (`id`, `questions`, `survey_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Enter your dating experience',2,'2019-06-11 13:41:07','2019-06-11 13:41:29',NULL),
	(2,'How old our you ?',2,'2019-06-11 13:42:22','2019-06-11 13:42:22',NULL),
	(3,'Name of your girlfriend',2,'2019-06-11 13:42:38','2019-06-11 13:42:38',NULL),
	(4,'Best time for mating ?',2,'2019-06-11 13:43:11','2019-06-11 13:43:11',NULL),
	(5,'First',3,'2019-06-18 08:07:34','2019-06-18 08:07:34',NULL),
	(6,'Second',3,'2019-06-18 08:07:51','2019-06-18 08:07:51',NULL),
	(7,'Third',3,'2019-06-18 08:09:32','2019-06-18 08:09:32',NULL),
	(8,'Fourth',3,'2019-06-18 08:09:46','2019-06-18 08:09:46',NULL),
	(9,'Fifth',3,'2019-06-18 08:09:59','2019-06-18 08:09:59',NULL),
	(10,'1.1',4,'2019-06-18 08:13:24','2019-06-18 08:13:24',NULL),
	(11,'1.2',4,'2019-06-18 08:13:59','2019-06-18 08:13:59',NULL),
	(12,'1.3',4,'2019-06-18 08:14:10','2019-06-18 08:14:10',NULL),
	(13,'1.4',4,'2019-06-18 08:14:19','2019-06-18 08:14:19',NULL),
	(14,'1.5',4,'2019-06-18 08:14:28','2019-06-18 08:14:28',NULL);

/*!40000 ALTER TABLE `survey_questions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table surveys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `surveys`;

CREATE TABLE `surveys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0' COMMENT '0=no 1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;

INSERT INTO `surveys` (`id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Survey 1',0,'2019-06-11 13:40:41','2019-06-24 10:46:57',NULL),
	(2,'Enter your dating experience  222',0,'2019-06-11 13:41:50','2019-06-11 13:42:48','2019-06-11 13:42:48'),
	(3,'Survey 2',0,'2019-06-18 08:07:08','2019-06-24 10:47:58',NULL),
	(4,'Survey 3',0,'2019-06-18 08:13:07','2019-06-24 10:47:54',NULL),
	(5,'happy',0,'2019-06-24 09:35:55','2019-06-24 09:35:55',NULL),
	(6,'wdqwd',0,'2019-06-24 10:19:47','2019-06-24 10:19:47',NULL);

/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table toys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `toys`;

CREATE TABLE `toys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table user_devices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_devices`;

CREATE TABLE `user_devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `device_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=ios 2=android',
  `user_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_devices_user_id_foreign` (`user_id`),
  CONSTRAINT `user_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_devices` WRITE;
/*!40000 ALTER TABLE `user_devices` DISABLE KEYS */;

INSERT INTO `user_devices` (`id`, `user_id`, `device_type`, `user_token`, `device_token`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,2,2,'$2y$10$BYuIURVhJaRRp0Kk8Ep40ubdS5SOiFcVnDV/l8lKfs8PaaR0Kn00e',NULL,'2019-02-13 08:06:59','2019-02-13 08:06:59',NULL),
	(4,5,2,'$2y$10$cJq78Imf5PC8wf09DH4xKeqYESMVz0MewY2xBl9a.m62KGX4Gktdu',NULL,'2019-03-15 10:30:09','2019-03-15 10:30:09',NULL),
	(10,8,2,'$2y$10$6MEmUSi1BPBLYXIgYB1aT.YErK9wi/nQVkblrKmEce4syzrYUI7HO',NULL,'2019-03-15 17:33:44','2019-03-15 17:33:44',NULL),
	(11,9,1,'$2y$10$bnj6nxCHJV5O1jdAVwRwkuQdL.7ngiabf6j2lzKdx9kLe0VIxk1dW',NULL,'2019-03-18 10:28:44','2019-03-18 10:28:44',NULL),
	(12,10,2,'$2y$10$BkS9SBJ2daYa8cqiVaGB9eyylD4xmCAm/v3LAiXf51OTfE/rOAHYC',NULL,'2019-06-07 11:59:05','2019-06-07 11:59:05',NULL),
	(14,3,2,'$2y$10$OV1zjvu75gfJ7uG8f2LE2OzynmAiNJM7XW7gqb5YMkCscorUmF.uG',NULL,'2019-06-18 08:11:04','2019-06-18 08:11:04',NULL),
	(15,4,2,'$2y$10$Sf/uW9nAJINtYl4IHkck2OKQgcDoaaoXNGav81y9Imx/vuAkKhCm.',NULL,'2019-06-19 16:49:30','2019-06-19 16:49:30',NULL);

/*!40000 ALTER TABLE `user_devices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=male 2=female',
  `relationship_status` tinyint(4) NOT NULL DEFAULT '4' COMMENT '1=Its Complecated 2=Married 3=Open Relationship 4=Single 5=Divorced 6=Seprated 7=Widowed',
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_control` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no 1=yes',
  `role` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=admin 2=app user',
  `is_active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=inactive',
  `is_verified` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=verified 0=unverified',
  `verification_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_code_validity` datetime DEFAULT NULL,
  `profile_step` int(11) NOT NULL DEFAULT '0',
  `is_touch_id_enable` int(11) NOT NULL DEFAULT '0' COMMENT '0=no 1=yes',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `image`, `dob`, `gender`, `relationship_status`, `height`, `weight`, `birth_control`, `role`, `is_active`, `is_verified`, `verification_token`, `verify_code_validity`, `profile_step`, `is_touch_id_enable`, `remember_token`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Admin','admin@libido.com','$2y$04$gqQ4RcXsNtkSkGL7mUxAauvYHbgprzGmTRZoLoT34GNSLl6odzX6e','abhineet','baranwal',NULL,NULL,1,4,NULL,NULL,0,1,1,1,NULL,NULL,0,0,'mUE8ZXR8tFmz9KUgchNcC4yDTAnX8MPdgsRNJ2D0TRza9rS77GhrG1OkG0qk','2018-11-29 05:42:05','2019-02-14 22:59:56',NULL),
	(2,NULL,'abhineet123@yopmail.com','$2y$04$3W0Jfg355dC5jjZnPs6/7e/iLORSDzca.3DO0ENmCSAaMhjjunjBO','abhi','baran','155004570366156.jpg','2019-02-04',1,9,'104','45',0,1,1,0,'19db391550045217',NULL,3,1,NULL,'2019-02-13 08:06:59','2019-02-13 08:15:37',NULL),
	(3,NULL,'hm@yopmail.com','$2y$04$CFJdEU/4KiqwVy2R6Qh4ZO3HdRGEFtSLxiAMzCAQ2e.29TyLmacry','himanshu','Verma','15500481031173.jpg','1991-12-20',1,4,'117','56',0,2,1,1,NULL,NULL,3,1,NULL,'2019-02-13 08:53:38','2019-02-14 22:59:56',NULL),
	(4,NULL,'amit@yopmail.com','$2y$04$r8QLEAPRFBaaZyoodEZe4OZgmEcMcblNvG/t3HYYVIxE3oHSL601C','amiy','smith','155004840038118.jpg','1989-02-13',1,16,'111','59',0,2,1,0,'919e201550048313',NULL,3,1,NULL,'2019-02-13 08:58:34','2019-06-19 17:12:06',NULL),
	(5,NULL,'wa1hm@yopmail.com','$2y$04$K96iyvOD.vzkXfT2n1sk3.9COqUsN1TljDRooJjvYdJMgpBDLEafW','George','Smith','155264595290787.jpg','2000-03-01',1,1,'101','51',0,2,1,1,NULL,NULL,3,1,NULL,'2019-03-15 10:30:09','2019-03-15 10:33:40',NULL),
	(6,NULL,'abhineet1@yopmail.com','$2y$04$XXnOkE4jN9w0gQPzGQamz.HL.BHnPJkvOiCJVnDhVSx2AsWEG8WB.','abhineet','baranwal','155264652565936.jpg','1989-12-13',1,2,'153','66',0,2,1,0,'35cbfc1552646467',NULL,3,1,NULL,'2019-03-15 10:41:08','2019-03-15 10:43:26',NULL),
	(7,NULL,'amit@yoxmail.com','$2y$04$Rz0SSho9241H7ST.82Y4nu1GYd4G1QKg29T7X9/Z23dPwAiSzKhjW',NULL,NULL,NULL,NULL,1,4,NULL,NULL,0,2,1,0,'7d40061552670423',NULL,0,0,NULL,'2019-03-15 17:20:25','2019-03-15 17:20:25',NULL),
	(8,'alexsmith','alex@yopmail.com','$2y$04$.YIn4ViYG7xuUkN9eWLnnuMgigCPqW8KAkm9RQzwmg..LQNHd6hfu','alex','Smith','155267085884435.jpg','1968-03-15',1,1,'101','57',0,2,1,1,'7277bd1552671111','2019-03-16 17:31:51',3,1,NULL,'2019-03-15 17:21:12','2019-03-16 08:38:39',NULL),
	(9,NULL,'abhineet@yomail.com','$2y$04$lvHe2JlKrQaqBesgmg.SAOl5cSwr4SmvRHJQKSISAYyFUlM3HEj5a','chbn','ghhh','155290636979333.jpg','2019-03-18',1,1,'100','40',0,2,1,0,'8c7d0a1552904920',NULL,3,1,NULL,'2019-03-18 10:28:44','2019-03-18 10:54:48',NULL),
	(10,NULL,'himan.verma@live.com','$2y$04$CFJdEU/4KiqwVy2R6Qh4ZO3HdRGEFtSLxiAMzCAQ2e.29TyLmacry','Himanshu','Verma','155990883893556.jpg','1991-12-20',1,4,'129','58',0,2,1,0,'845fcd1559908744',NULL,3,0,NULL,'2019-06-07 11:59:04','2019-06-07 12:01:51',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
