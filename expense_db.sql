-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: expensemanagement
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `budgets`
--

DROP TABLE IF EXISTS `budgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budgets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `budgetamount` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_date_unique` (`user_id`,`date`),
  CONSTRAINT `budgets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budgets`
--

LOCK TABLES `budgets` WRITE;
/*!40000 ALTER TABLE `budgets` DISABLE KEYS */;
INSERT INTO `budgets` VALUES (3,2,'2025-05-01 00:00:00','1900','2025-05-01 14:29:46','2025-05-01 14:29:46'),(4,2,'2025-04-01 00:00:00','2000','2025-05-01 14:30:18','2025-05-01 14:30:18');
/*!40000 ALTER TABLE `budgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Food','2025-04-30 01:15:21','2025-04-30 01:15:21'),(2,'Travel','2025-04-30 01:15:21','2025-04-30 01:15:21'),(3,'Utilities','2025-04-30 01:15:21','2025-04-30 01:15:21'),(4,'Rent','2025-04-30 01:15:21','2025-04-30 01:15:21'),(5,'Entertainment','2025-04-30 01:15:21','2025-04-30 01:15:21');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_user_id_foreign` (`user_id`),
  KEY `expenses_category_id_foreign` (`category_id`),
  CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,1,1,700.00,'2025-03-30','For food','2025-04-30 04:33:26','2025-04-30 04:51:12'),(3,1,3,120.00,'2025-04-30',NULL,'2025-04-30 04:53:38','2025-04-30 04:53:38'),(4,1,1,100.00,'2025-04-01','During travel','2025-04-30 05:09:22','2025-04-30 05:09:22'),(5,1,4,500.00,'2025-04-10',NULL,'2025-04-30 11:12:53','2025-04-30 11:12:53'),(6,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:33:04','2025-04-30 11:33:04'),(7,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:33:58','2025-04-30 11:33:58'),(8,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:36:41','2025-04-30 11:36:41'),(9,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:40:07','2025-04-30 11:40:07'),(10,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:40:40','2025-04-30 11:40:40'),(11,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:43:48','2025-04-30 11:43:48'),(12,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:47:17','2025-04-30 11:47:17'),(13,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:52:50','2025-04-30 11:52:50'),(14,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:55:35','2025-04-30 11:55:35'),(15,1,5,200.00,'2025-04-08',NULL,'2025-04-30 11:59:39','2025-04-30 11:59:39'),(16,1,5,200.00,'2025-04-08',NULL,'2025-04-30 12:00:50','2025-04-30 12:00:50'),(17,1,5,1100.00,'2025-04-08',NULL,'2025-04-30 12:00:55','2025-04-30 12:00:55'),(18,1,5,1100.00,'2025-04-08',NULL,'2025-04-30 12:02:10','2025-04-30 12:02:10'),(19,1,5,1100.00,'2025-04-08',NULL,'2025-04-30 12:04:40','2025-04-30 12:04:40'),(20,1,5,1100.00,'2025-04-08',NULL,'2025-04-30 12:06:31','2025-04-30 12:06:31'),(21,1,5,1100.00,'2025-04-08',NULL,'2025-04-30 12:07:07','2025-04-30 12:07:07'),(22,1,5,1100.00,'2025-04-08',NULL,'2025-04-30 12:14:30','2025-04-30 12:14:30'),(23,1,5,2000.00,'2025-04-30',NULL,'2025-04-30 12:15:48','2025-04-30 12:15:48'),(24,1,1,2000.00,'2025-04-30',NULL,'2025-04-30 12:24:14','2025-04-30 12:24:14'),(25,1,5,1000.00,'2025-04-30',NULL,'2025-04-30 12:29:45','2025-04-30 12:29:45'),(26,1,2,2000.00,'2025-04-30',NULL,'2025-04-30 12:35:26','2025-04-30 12:35:26'),(27,1,2,2000.00,'2025-04-30',NULL,'2025-04-30 12:36:37','2025-04-30 12:36:37'),(28,1,2,2000.00,'2025-04-30',NULL,'2025-04-30 12:37:30','2025-04-30 12:37:30'),(29,1,2,2000.00,'2025-04-30',NULL,'2025-04-30 12:38:02','2025-04-30 12:38:02'),(30,1,2,100.00,'2025-04-30',NULL,'2025-04-30 12:42:21','2025-04-30 12:42:21'),(31,1,2,100.00,'2025-04-30',NULL,'2025-04-30 12:48:03','2025-04-30 12:48:03'),(33,2,5,500.00,'2025-05-01',NULL,'2025-04-30 13:27:19','2025-04-30 13:27:19'),(35,2,1,100.00,'2025-05-01',NULL,'2025-04-30 13:46:46','2025-04-30 13:46:46'),(36,2,3,800.00,'2024-09-09',NULL,'2025-05-01 10:13:37','2025-05-01 10:13:37'),(37,4,1,8000.00,'2025-05-01',NULL,'2025-05-01 10:17:53','2025-05-01 10:17:53'),(38,4,2,2000.00,'2025-05-01',NULL,'2025-05-01 10:18:21','2025-05-01 10:18:21'),(39,4,4,10000.00,'2025-05-01',NULL,'2025-05-01 10:18:57','2025-05-01 10:18:57'),(40,2,1,800.00,'2025-02-19',NULL,'2025-05-01 12:36:28','2025-05-01 12:36:28'),(42,2,2,100.00,'2025-02-03',NULL,'2025-05-01 13:28:29','2025-05-01 13:51:00');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2025_04_30_063917_create_users_table',1),(5,'2025_04_30_064040_create_categories_table',1),(6,'2025_04_30_064143_create_expenses_table',1),(8,'2025_05_01_161304_create_budget_table',2),(9,'2025_05_01_171403_create_budgets_table',3),(10,'2025_05_01_174940_add_unique_user_date_to_budgets_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `monthly_budget` decimal(10,2) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Karthi','karthi@gmail.com',NULL,'$2y$10$c4PUiR25mDE8Uh0vWjAY/eBAR4NmvVx.4Uy.Y1cO5w4dofcw.RBwC',1000.00,NULL,'2025-04-30 04:19:26','2025-04-30 04:19:26'),(2,'Habitha','habithakkl@gmail.com',NULL,'$2y$10$3495uzoKwIQaeNQ3IcqSuO2/BskTkF5zw7OyIGJQURS6cC3zQGnli',1500.00,NULL,'2025-04-30 13:26:11','2025-04-30 13:26:11'),(3,'John','john@gmail.com',NULL,'$2y$10$uOdjpEZFgB9RMNCPuVShSu0cpyyU7acBgdPdUBvzsghAFtVtIDNgG',10000.00,NULL,'2025-04-30 15:36:31','2025-04-30 15:36:31'),(4,'Naveenraj','naveenraj.jeee@gmail.com',NULL,'$2y$10$AU17q5wdk1WTvGQg2FznLOlAfGyQ7D6l8HwDsqKXUiKc94hugLKLa',25000.00,NULL,'2025-05-01 10:17:16','2025-05-01 10:17:16'),(5,'admin','admin123@gmail.com',NULL,'$2y$10$bA5krNwlXWFQ2dv44CqjIOz4zcCZyEuhV1R7SoEeanUstJhAkKFZ.',NULL,NULL,'2025-05-01 10:30:56','2025-05-01 10:30:56');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-02 14:06:35
