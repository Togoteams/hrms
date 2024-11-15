-- MySQL dump 10.13  Distrib 8.3.0, for macos14.2 (arm64)
--
-- Host: 127.0.0.1    Database: hrms_testing
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'95212352401001','Salaries','salaries','office','0','This  Account is for  Employee Basic Salary',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(2,'95212352401010','Entertainment','entertainment','office','0','This  Account is for  Entertainment Amount',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(3,'95212352451009','Education','education','office','0','This  Account is for  Education Amount',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(4,'95212352451010','House up keep','house_up_keep','office','0','This  Account is for  House up keep Amount',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(5,'95212352471001','Medical exp For Local','bomaid_local','office','0','This  Account is for  Medical Expense of Local Amount',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(6,'95212352471003','Medical exp For EXPATRIATE','bomaid_ibo','office','0','This  Account is for  Medical Expense of EXPATRIATE Amount',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(7,'test','PF Bank Contribution','pf_bank_contribution','office','0','This Account is for  Pf Contribution',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(8,'95212352461006','Bank\'s Conti to Pension','banks_conti_to_pension','office','0','This  Account  is for Bank\'s Conti to Pension Amount',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(9,'95212313201004','Sundry Dep-Pension EFT ','sundry_dep_pension_eft','office','1','This  Account is for  Sundry Dep-Pension{EFT}',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(10,'95212315106004','B.B.E.U  {Banker Chq}','B_B_E_U_Banker_Chq','office','1','This  Account is for  B.B.E.U  {Banker Chq}',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(11,'95212322203001','EFT to FNB Bank','eft_to_fnb_bank','office','1','This  Account  is for EFT to FNB Bank',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(12,'95212352461009','Cont. PF','pf_contribution','office','1','This  Account  is for Pf Contribution',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(13,'95212354511016','Vehicle exp','vehicle_expenses','office','1','This  Account is for  Vehicle exp',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(14,'95212352451013','Income tax','income_tax','office','1','This is Account  of Income tax',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(15,'95212326681010','SPECIAL ADVANCE TO STAFF','special_advance_to_staff','office','1','This is Account for SPECIAL ADVANCE TO STAFF',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(16,'2232323232323','Sanjay Sir','sanjay-sir','employee','1','This is Sanjay Sir Salary Account ',NULL,'active','2024-06-05 18:24:14','2024-06-05 18:24:14'),(17,'15555855111111','Personal_Loan of Rohit','personal_loan','employee','1','Personal_loan of Rohit',3,'active','2024-06-07 07:50:55','2024-06-07 07:50:55'),(18,'2232323232323232','Rohit','rohit','employee','1','This is Rohit Salary Account ',NULL,'active','2024-06-07 07:51:33','2024-06-07 07:51:33');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `award_details`
--

DROP TABLE IF EXISTS `award_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `award_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `award_details`
--

LOCK TABLES `award_details` WRITE;
/*!40000 ALTER TABLE `award_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `award_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_main_branch` tinyint DEFAULT '0',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'Gaborone, Main Mall','9521',1,'none','','','','none','active','none',NULL,NULL,NULL),(2,'Francistown','9522',0,'none','','','','none','active','none',NULL,NULL,NULL),(3,'G-west','9523',0,'none','','','','none','active','none',NULL,NULL,NULL),(4,'Palapye','9524',0,'none','','','','none','active','none',NULL,NULL,NULL);
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `std_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Botswana','+267',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(2,'India','+91',NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency_settings`
--

DROP TABLE IF EXISTS `currency_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currency_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `currency_name_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_name_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_amount_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_amount_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency_settings`
--

LOCK TABLES `currency_settings` WRITE;
/*!40000 ALTER TABLE `currency_settings` DISABLE KEYS */;
INSERT INTO `currency_settings` VALUES (1,'usd','pula','1','13.73','active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(2,'usd','inr','1','83.01','active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(3,'pula','inr','1','6.19','active','2024-06-05 12:44:41','2024-06-05 12:44:41');
/*!40000 ALTER TABLE `currency_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_b_backups`
--

DROP TABLE IF EXISTS `d_b_backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `d_b_backups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backup_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_b_backups`
--

LOCK TABLES `d_b_backups` WRITE;
/*!40000 ALTER TABLE `d_b_backups` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_b_backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'HR','hr','inactive',NULL,'2024-06-07 11:19:57',NULL),(2,'Finance','finance','active',NULL,NULL,NULL),(3,'Marketing','marketing','active',NULL,NULL,NULL),(4,'IT','it','active',NULL,NULL,NULL),(5,'credit','credit','active',NULL,NULL,NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `designations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `designations_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `designations`
--

LOCK TABLES `designations` WRITE;
/*!40000 ALTER TABLE `designations` DISABLE KEYS */;
INSERT INTO `designations` VALUES (1,'Managing Director','managing_director','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(2,'Chief Manager','chief_manager','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(3,'Senior Manager','senior_manager','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(4,'General Manager','general_manager','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(5,'Assistant General Manager','assistant_general_manager','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(6,'Manager','manager','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(7,'Assistant Manager','assistant_manager','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(8,'Supervisor','supervisor','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(9,'Teller','teller','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(10,'Clerk/Assistant','clerk_assistant','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(11,'Tea Lady','tea_lady','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(12,'Messenger/Driver','messenger_driver','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(13,'SHE Staff','she_staff','none','active','2024-06-05 12:44:41','2024-06-05 12:44:41',NULL);
/*!40000 ALTER TABLE `designations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_emps`
--

DROP TABLE IF EXISTS `document_emps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_emps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_id` bigint unsigned DEFAULT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_emps_document_id_foreign` (`document_id`),
  CONSTRAINT `document_emps_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_emps`
--

LOCK TABLES `document_emps` WRITE;
/*!40000 ALTER TABLE `document_emps` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_emps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_types`
--

DROP TABLE IF EXISTS `document_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_types`
--

LOCK TABLES `document_types` WRITE;
/*!40000 ALTER TABLE `document_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp13th_cheques`
--

DROP TABLE IF EXISTS `emp13th_cheques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp13th_cheques` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `amount` double DEFAULT NULL,
  `cheques_month_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp13th_cheques`
--

LOCK TABLES `emp13th_cheques` WRITE;
/*!40000 ALTER TABLE `emp13th_cheques` DISABLE KEYS */;
/*!40000 ALTER TABLE `emp13th_cheques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_addresses`
--

DROP TABLE IF EXISTS `emp_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_box` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_addresses`
--

LOCK TABLES `emp_addresses` WRITE;
/*!40000 ALTER TABLE `emp_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `emp_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_current_leaves`
--

DROP TABLE IF EXISTS `emp_current_leaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_current_leaves` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `employee_id` bigint unsigned DEFAULT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_type_id` int DEFAULT NULL,
  `leave_count` int DEFAULT NULL,
  `leave_count_decimal` double DEFAULT NULL,
  `leave_rounded_value` double DEFAULT '0',
  `action_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_current_leaves`
--

LOCK TABLES `emp_current_leaves` WRITE;
/*!40000 ALTER TABLE `emp_current_leaves` DISABLE KEYS */;
INSERT INTO `emp_current_leaves` VALUES (1,2,1,'expatriate',6,40,20,0,'2024-06-05','active','2024-06-05 06:18:52','2024-06-07 09:23:13',1,1),(2,2,1,'expatriate',7,0,0,0,'2024-06-05','active','2024-06-05 06:18:52','2024-06-05 06:18:52',1,1),(3,2,1,'expatriate',9,22,22,0,'2024-06-05','active','2024-06-05 06:18:52','2024-06-05 06:18:52',1,1),(4,2,1,'expatriate',10,30,30,0,'2024-06-05','active','2024-06-05 06:18:52','2024-06-05 06:18:52',1,1);
/*!40000 ALTER TABLE `emp_current_leaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_department_histories`
--

DROP TABLE IF EXISTS `emp_department_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_department_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_department_histories`
--

LOCK TABLES `emp_department_histories` WRITE;
/*!40000 ALTER TABLE `emp_department_histories` DISABLE KEYS */;
INSERT INTO `emp_department_histories` VALUES (1,3,'Finance','2024-06-18',NULL,'ssd',NULL,'2024-06-06 23:32:07',NULL);
/*!40000 ALTER TABLE `emp_department_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_driving_licenses`
--

DROP TABLE IF EXISTS `emp_driving_licenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_driving_licenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `license_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_driving_licenses`
--

LOCK TABLES `emp_driving_licenses` WRITE;
/*!40000 ALTER TABLE `emp_driving_licenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `emp_driving_licenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_loan_histories`
--

DROP TABLE IF EXISTS `emp_loan_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_loan_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `employee_id` bigint unsigned NOT NULL,
  `loan_types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_amount` double NOT NULL,
  `emi_amount` double NOT NULL,
  `emi_start_date` date DEFAULT NULL,
  `emi_end_date` date DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active,completed,in-progress',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_loan_histories`
--

LOCK TABLES `emp_loan_histories` WRITE;
/*!40000 ALTER TABLE `emp_loan_histories` DISABLE KEYS */;
INSERT INTO `emp_loan_histories` VALUES (1,'52cca4de-07ed-44c2-a652-9c284de11de2',3,2,'personal_loan','15555855111111','',1000,500,'2024-03-01','2024-10-28','dfdf',NULL,'active',1,1,'2024-06-07 07:50:55','2024-06-07 07:50:55');
/*!40000 ALTER TABLE `emp_loan_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_medical_insurances`
--

DROP TABLE IF EXISTS `emp_medical_insurances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_medical_insurances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `medical_card_id` bigint unsigned DEFAULT NULL,
  `amount` bigint unsigned DEFAULT NULL,
  `medical_insurances_date` date DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insurance_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_medical_insurances_medical_card_id_foreign` (`medical_card_id`),
  CONSTRAINT `emp_medical_insurances_medical_card_id_foreign` FOREIGN KEY (`medical_card_id`) REFERENCES `medical_cards` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_medical_insurances`
--

LOCK TABLES `emp_medical_insurances` WRITE;
/*!40000 ALTER TABLE `emp_medical_insurances` DISABLE KEYS */;
/*!40000 ALTER TABLE `emp_medical_insurances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_passport_omangs`
--

DROP TABLE IF EXISTS `emp_passport_omangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_passport_omangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_issue_date` date DEFAULT NULL,
  `certificate_expiry_date` date DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_passport_omangs`
--

LOCK TABLES `emp_passport_omangs` WRITE;
/*!40000 ALTER TABLE `emp_passport_omangs` DISABLE KEYS */;
INSERT INTO `emp_passport_omangs` VALUES (1,3,'passport','333333232','2024-06-02','2024-06-28','Botswana',NULL,NULL,NULL);
/*!40000 ALTER TABLE `emp_passport_omangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_salaries`
--

DROP TABLE IF EXISTS `emp_salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_salaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `basic` decimal(8,2) NOT NULL,
  `hra` decimal(8,2) NOT NULL,
  `overtime` decimal(8,2) NOT NULL,
  `arrear` decimal(8,2) NOT NULL,
  `union_membership` bigint NOT NULL,
  `pf_per` int NOT NULL,
  `pf_amount` decimal(8,2) NOT NULL,
  `pension_per` int NOT NULL,
  `pension_amount` decimal(8,2) NOT NULL,
  `loans_deduction` decimal(8,2) NOT NULL,
  `no_of_working_days` int NOT NULL,
  `no_of_paid_leaves` int NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_hours_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_hours_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_payable_days` int NOT NULL,
  `conveyance` decimal(8,2) NOT NULL,
  `special` decimal(8,2) NOT NULL,
  `mobile` decimal(8,2) NOT NULL,
  `bonus` decimal(8,2) NOT NULL,
  `transportation` decimal(8,2) NOT NULL,
  `food` decimal(8,2) NOT NULL,
  `medical` decimal(8,2) NOT NULL,
  `gross_earning` decimal(8,2) NOT NULL,
  `esi_per` int NOT NULL,
  `esi_amount` decimal(8,2) NOT NULL,
  `income_tax_deductions` decimal(8,2) NOT NULL,
  `penalty_deductions` decimal(8,2) NOT NULL,
  `fixed_deductions` decimal(8,2) NOT NULL,
  `other_deductions` decimal(8,2) NOT NULL,
  `net_take_home` decimal(8,2) NOT NULL,
  `total_deduction` decimal(8,2) NOT NULL,
  `ctc` decimal(8,2) NOT NULL,
  `total_employer_contribution` decimal(8,2) NOT NULL,
  `created_by` bigint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_salaries`
--

LOCK TABLES `emp_salaries` WRITE;
/*!40000 ALTER TABLE `emp_salaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `emp_salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emplooye_loans`
--

DROP TABLE IF EXISTS `emplooye_loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emplooye_loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `employee_id` bigint unsigned NOT NULL,
  `loan_types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emi_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emi_start_date` date NOT NULL,
  `emi_end_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active,completed,in-progress',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emplooye_loans_created_by_foreign` (`created_by`),
  KEY `emplooye_loans_updated_by_foreign` (`updated_by`),
  KEY `emplooye_loans_user_id_foreign` (`user_id`),
  KEY `emplooye_loans_employee_id_foreign` (`employee_id`),
  CONSTRAINT `emplooye_loans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `emplooye_loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `emplooye_loans_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `emplooye_loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emplooye_loans`
--

LOCK TABLES `emplooye_loans` WRITE;
/*!40000 ALTER TABLE `emplooye_loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `emplooye_loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_kras`
--

DROP TABLE IF EXISTS `employee_kras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_kras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `employee_id` bigint unsigned NOT NULL,
  `attribute_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commects` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_marks` int NOT NULL,
  `min_marks` int NOT NULL,
  `marks_by_reporting_autheority` int NOT NULL,
  `marks_by_review_autheority` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_kras_created_by_foreign` (`created_by`),
  KEY `employee_kras_updated_by_foreign` (`updated_by`),
  KEY `employee_kras_deleted_by_foreign` (`deleted_by`),
  KEY `employee_kras_user_id_foreign` (`user_id`),
  CONSTRAINT `employee_kras_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `employee_kras_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `employee_kras_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `employee_kras_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_kras`
--

LOCK TABLES `employee_kras` WRITE;
/*!40000 ALTER TABLE `employee_kras` DISABLE KEYS */;
INSERT INTO `employee_kras` VALUES (2,'17576dda-cf4d-4989-9b51-cc454b9241df',2,1,'Amit','sdsd','sdsdsd',222,0,12,23,'inactive',1,NULL,NULL,'2024-06-06 13:14:49','2024-06-07 12:09:24',NULL);
/*!40000 ALTER TABLE `employee_kras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_transfers`
--

DROP TABLE IF EXISTS `employee_transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_transfers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` bigint unsigned DEFAULT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  `branch_id` bigint unsigned DEFAULT NULL,
  `transfer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `transfer_request_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_transfers_emp_id_foreign` (`emp_id`),
  KEY `employee_transfers_department_id_foreign` (`department_id`),
  KEY `employee_transfers_branch_id_foreign` (`branch_id`),
  CONSTRAINT `employee_transfers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `employee_transfers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `designations` (`id`),
  CONSTRAINT `employee_transfers_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_transfers`
--

LOCK TABLES `employee_transfers` WRITE;
/*!40000 ALTER TABLE `employee_transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `designation_id` bigint unsigned DEFAULT NULL,
  `employment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ec_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `std_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `birth_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_domicile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `branch_id` bigint unsigned DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_authority` bigint DEFAULT NULL,
  `reporting_authority` bigint DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_emp_id_unique` (`emp_id`),
  UNIQUE KEY `employees_user_id_unique` (`user_id`),
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'emp-2024-1',2,1,'expatriate','123456432333','male','single','+91','7906052655',NULL,NULL,'1990-01-05',NULL,NULL,NULL,'2024-04-07',1,NULL,'2232323232323',NULL,NULL,'active',NULL,'2024-06-05 18:16:47'),(2,'emp-2024-2',3,4,'local','12345643','male','single','+267','7062545',NULL,NULL,'1995-08-18',NULL,NULL,NULL,'2024-04-07',2,NULL,'2232323232323232',2,2,'active',NULL,'2024-06-07 07:47:38');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employment_histories`
--

DROP TABLE IF EXISTS `employment_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employment_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `designation_id` bigint unsigned DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employment_histories_designation_id_foreign` (`designation_id`),
  CONSTRAINT `employment_histories_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employment_histories`
--

LOCK TABLES `employment_histories` WRITE;
/*!40000 ALTER TABLE `employment_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `employment_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `family_details`
--

DROP TABLE IF EXISTS `family_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `family_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depended` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_income` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_of_baroda_employee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line1` text COLLATE utf8mb4_unicode_ci,
  `address_line2` text COLLATE utf8mb4_unicode_ci,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `std_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `family_details`
--

LOCK TABLES `family_details` WRITE;
/*!40000 ALTER TABLE `family_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `family_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `holidays` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_optional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kra_attributes`
--

DROP TABLE IF EXISTS `kra_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kra_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_marks` int NOT NULL,
  `min_marks` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kra_attributes_created_by_foreign` (`created_by`),
  KEY `kra_attributes_updated_by_foreign` (`updated_by`),
  KEY `kra_attributes_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `kra_attributes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `kra_attributes_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `kra_attributes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kra_attributes`
--

LOCK TABLES `kra_attributes` WRITE;
/*!40000 ALTER TABLE `kra_attributes` DISABLE KEYS */;
INSERT INTO `kra_attributes` VALUES (1,'eedb3f23-9cea-4b39-ad15-719eb0ecdbdc','Amit','sdsd',222,22,'active',1,NULL,NULL,'2024-06-06 13:10:45','2024-06-06 13:10:45',NULL);
/*!40000 ALTER TABLE `kra_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_activity_logs`
--

DROP TABLE IF EXISTS `leave_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `leave_type_id` bigint NOT NULL,
  `is_credit` tinyint DEFAULT '0',
  `is_adjustment` tinyint DEFAULT '0',
  `leave_count` double(8,2) DEFAULT '0.00',
  `activity_at` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_update_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_activity_logs`
--

LOCK TABLES `leave_activity_logs` WRITE;
/*!40000 ALTER TABLE `leave_activity_logs` DISABLE KEYS */;
INSERT INTO `leave_activity_logs` VALUES (1,2,6,1,0,20.00,'2024-06-05','Sanjay Sir 20 SICK LEAVE Leave is credited on 05-06-2024',NULL,'2024-06-05 18:18:52','2024-06-05 18:18:52'),(2,2,7,1,0,0.00,'2024-06-05','Sanjay Sir 0 MATERNITY LEAVE Leave is credited on 05-06-2024',NULL,'2024-06-05 18:18:52','2024-06-05 18:18:52'),(3,2,9,1,0,22.00,'2024-06-05','Sanjay Sir 22 CASUAL LEAVE Leave is credited on 05-06-2024',NULL,'2024-06-05 18:18:52','2024-06-05 18:18:52'),(4,2,10,1,0,30.00,'2024-06-05','Sanjay Sir 30 PRIVILEGED LEAVE Leave is credited on 05-06-2024',NULL,'2024-06-05 18:18:52','2024-06-05 18:18:52'),(5,2,6,0,0,2.00,'2024-06-05','Sanjay Sir is avail 2 SICK LEAVE Leave on 05-06-2024',NULL,'2024-06-05 18:20:30','2024-06-05 18:20:30'),(6,2,6,0,1,2.00,'2024-06-05','Sanjay Sir 2 SICK LEAVE Leave is adjusted on 05-06-2024',NULL,'2024-06-05 18:21:51','2024-06-05 18:21:51'),(7,2,6,1,0,20.00,'2024-06-07','Sanjay Sir 20 SICK LEAVE Leave is credited on 07-06-2024After Deletion Of Applied Leave',NULL,'2024-06-07 09:23:13','2024-06-07 09:23:13');
/*!40000 ALTER TABLE `leave_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_applies`
--

DROP TABLE IF EXISTS `leave_applies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_applies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_type_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `leave_applies_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_approved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `approved_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_authority` bigint DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `is_paid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_leave_counted_on_holiday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `leave_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_date` date DEFAULT NULL,
  `reversal_at` timestamp NULL DEFAULT NULL,
  `is_reversal` tinyint DEFAULT '0',
  `reversal_approved_by` bigint DEFAULT '0',
  `remaining_leave` int DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `doc` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_applies_created_by_foreign` (`created_by`),
  KEY `leave_applies_updated_by_foreign` (`updated_by`),
  KEY `leave_applies_leave_type_id_foreign` (`leave_type_id`),
  KEY `leave_applies_user_id_foreign` (`user_id`),
  CONSTRAINT `leave_applies_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `leave_applies_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_settings` (`id`),
  CONSTRAINT `leave_applies_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `leave_applies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_applies`
--

LOCK TABLES `leave_applies` WRITE;
/*!40000 ALTER TABLE `leave_applies` DISABLE KEYS */;
INSERT INTO `leave_applies` VALUES (1,'0d4cc0a6-199e-4f16-8160-c2781c2de057',6,2,'2','half_pay','2024-06-02','2024-06-03','1','1',NULL,'2024-06-05 18:20:30','paid','1','sd',NULL,NULL,0,0,20,NULL,'Aprroved','approved','','2024-06-05 06:26:49','2024-06-05 18:20:30',NULL,1,NULL),(3,'0d4cc0a6-199e-4f16-8160-c2781c2de057',6,2,'2','half_pay','2024-07-01','2024-07-02','0',NULL,NULL,NULL,'paid','1','sdsd',NULL,NULL,0,0,38,'erer',NULL,'pending','','2024-06-06 22:38:08','2024-06-07 10:56:11',NULL,1,NULL);
/*!40000 ALTER TABLE `leave_applies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_dates`
--

DROP TABLE IF EXISTS `leave_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_dates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `leave_id` bigint NOT NULL,
  `leave_date` date NOT NULL,
  `is_holiday` tinyint DEFAULT '0',
  `pay_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_dates`
--

LOCK TABLES `leave_dates` WRITE;
/*!40000 ALTER TABLE `leave_dates` DISABLE KEYS */;
INSERT INTO `leave_dates` VALUES (1,1,'2024-06-02',1,'half_pay','2024-06-05 18:20:18','2024-06-05 18:20:18'),(2,1,'2024-06-03',0,'half_pay','2024-06-05 18:20:18','2024-06-05 18:20:18'),(23,3,'2024-07-01',0,'half_pay','2024-06-07 10:38:35','2024-06-07 10:38:35'),(24,3,'2024-07-02',0,'half_pay','2024-06-07 10:38:35','2024-06-07 10:38:35');
/*!40000 ALTER TABLE `leave_dates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_encashments`
--

DROP TABLE IF EXISTS `leave_encashments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_encashments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `employee_id` bigint unsigned NOT NULL,
  `balance_leave` double NOT NULL,
  `request_leave_for_encashement` double NOT NULL,
  `apply_frequency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_leave_for_encashment` double NOT NULL,
  `requested_at` double NOT NULL,
  `leave_type_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status_remarks` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_by` bigint unsigned NOT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  `rejected_by` bigint unsigned DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `approval_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_encashments_created_by_foreign` (`created_by`),
  KEY `leave_encashments_updated_by_foreign` (`updated_by`),
  KEY `leave_encashments_user_id_foreign` (`user_id`),
  KEY `leave_encashments_employee_id_foreign` (`employee_id`),
  CONSTRAINT `leave_encashments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `leave_encashments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `leave_encashments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `leave_encashments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_encashments`
--

LOCK TABLES `leave_encashments` WRITE;
/*!40000 ALTER TABLE `leave_encashments` DISABLE KEYS */;
INSERT INTO `leave_encashments` VALUES (1,'0d4cc0a6-199e-4f16-8160-c2781c2de057',2,1,30,15,NULL,15,2024,10,'dfdf',NULL,NULL,'pending',1,NULL,NULL,NULL,NULL,NULL,'2024-06-07 01:01:00',NULL);
/*!40000 ALTER TABLE `leave_encashments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_settings`
--

DROP TABLE IF EXISTS `leave_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>local, 0=>ibo',
  `total_leave_year` double NOT NULL DEFAULT '0',
  `max_leave_at_time` double NOT NULL DEFAULT '0',
  `extended_leaves_year` double NOT NULL DEFAULT '0',
  `is_accumulated` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>yes, 0=>no',
  `is_accumulated_max_value` double NOT NULL DEFAULT '0',
  `is_pro_data` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>yes, 0=>no',
  `is_salary_deduction` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>yes, 0=>no',
  `salary_deduction_per` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>yes, 0=>no',
  `extended_leaves_deduction_per` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>yes, 0=>no',
  `starting_date` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>DOJ, 0=>Other Date',
  `is_count_holyday` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>yes, 0=>no',
  `is_leave_encash` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>yes, 0=>no',
  `is_certificate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>yes, 0=>no',
  `expiry_date_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_settings`
--

LOCK TABLES `leave_settings` WRITE;
/*!40000 ALTER TABLE `leave_settings` DISABLE KEYS */;
INSERT INTO `leave_settings` VALUES (1,'SICK LEAVE','sick-leave',1,20,0,0,0,0,0,0,0,0,0,0,0,1,'20 days will be credited after completion of one year from date of joining or preious year credit and will expired if not utilized with in one year','2024-06-05 12:44:41','2024-06-05 12:44:41'),(2,'EARNED LEAVE','earned-leave',1,18,0,0,1,54,0,0,0,0,1,0,0,0,'1.50 days leave in a month and  total 18 leaves in a year and balance will carry forward to another year untill 3 years','2024-06-05 12:44:41','2024-06-05 12:44:41'),(3,'BEREAVEMENT LEAVE','bereavement-leave',1,0,3,0,1,0,0,0,0,0,1,0,0,0,'Total 3 days as and when required in case of close family (mother/father/brother/sister/wife / husband/ children)menber and 1 day for extended family (uncle/aunty/Grand father/ Grand mother/ Cousin','2024-06-05 12:44:41','2024-06-05 12:44:41'),(4,'LEAVE WITHOUT PAY','leave-without-pay',1,0,0,0,1,0,0,1,100,0,1,1,0,0,'','2024-06-05 12:44:41','2024-06-05 12:44:41'),(5,'MATERNITY LEAVE','maternity-leave',1,84,0,14,1,0,0,1,50,75,1,0,0,1,'','2024-06-05 12:44:41','2024-06-05 12:44:41'),(6,'SICK LEAVE','sick-leave',0,15,0,0,1,0,0,0,0,0,1,1,0,1,'','2024-06-05 12:44:41','2024-06-05 12:44:41'),(7,'MATERNITY LEAVE','maternity-leave',0,84,0,14,0,0,0,1,50,75,0,1,0,1,'','2024-06-05 12:44:41','2024-06-05 12:44:41'),(8,'LEAVE WITHOUT PAY','leave-without-pay',0,0,0,0,0,0,0,1,100,0,0,1,0,0,'','2024-06-05 12:44:41','2024-06-05 12:44:41'),(9,'CASUAL LEAVE','casual-leave',0,12,4,0,0,0,1,0,0,0,0,0,0,0,'','2024-06-05 12:44:41','2024-06-05 12:44:41'),(10,'PRIVILEGED LEAVE','privileged-leave',0,30,0,0,1,0,1,0,0,0,1,1,1,0,'','2024-06-05 12:44:41','2024-06-05 12:44:41');
/*!40000 ALTER TABLE `leave_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_time_approvels`
--

DROP TABLE IF EXISTS `leave_time_approvels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_time_approvels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `leave_type_id` bigint unsigned DEFAULT NULL,
  `approval_authority` bigint unsigned DEFAULT NULL,
  `request_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_time_approvels_user_id_foreign` (`user_id`),
  KEY `leave_time_approvels_leave_type_id_foreign` (`leave_type_id`),
  CONSTRAINT `leave_time_approvels_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_settings` (`id`),
  CONSTRAINT `leave_time_approvels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_time_approvels`
--

LOCK TABLES `leave_time_approvels` WRITE;
/*!40000 ALTER TABLE `leave_time_approvels` DISABLE KEYS */;
/*!40000 ALTER TABLE `leave_time_approvels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loans_created_by_foreign` (`created_by`),
  KEY `loans_updated_by_foreign` (`updated_by`),
  CONSTRAINT `loans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `loans_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_id` bigint DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `default` tinyint DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_cards`
--

DROP TABLE IF EXISTS `medical_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medical_cards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_cards`
--

LOCK TABLES `medical_cards` WRITE;
/*!40000 ALTER TABLE `medical_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `medical_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memberships` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membership_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES (1,'test',300.00,'all','none','002',NULL,NULL,NULL),(2,'tes1',500.00,'all','none','002',NULL,NULL,NULL),(3,'tes2',600.00,'all','none','002',NULL,NULL,NULL),(4,'tes3',300.00,'all','none','002',NULL,NULL,NULL);
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_01_23_082424_create_roles_table',1),(6,'2023_02_08_181723_create_media_table',1),(7,'2023_02_19_120029_create_permissions_table',1),(8,'2023_02_19_120204_create_user_permissions_table',1),(9,'2023_03_02_043010_create_role_permissions_table',1),(10,'2023_03_08_145216_create_users_roles_table',1),(11,'2023_03_29_150100_create_employees_table',1),(12,'2023_04_05_182219_create_holidays_table',1),(13,'2023_04_08_105335_create_leave_settings_table',1),(14,'2023_04_08_151412_create_designations_table',1),(15,'2023_04_09_064449_create_memberships_table',1),(16,'2023_04_09_083544_create_branches_table',1),(17,'2023_04_21_083024_create_taxes_table',1),(18,'2023_04_21_091924_create_leave_applies_table',1),(19,'2023_04_21_130224_create_loans_table',1),(20,'2023_04_21_131433_create_emplooye_loans_table',1),(21,'2023_04_30_073102_create_leave_encashments_table',1),(22,'2023_05_15_082911_create_qualifications_table',1),(23,'2023_05_17_130054_create_emp_salaries_table',1),(24,'2023_06_13_090007_create_emp_driving_licenses_table',1),(25,'2023_06_13_090215_create_employment_histories_table',1),(26,'2023_06_13_090325_create_emp_passport_omangs_table',1),(27,'2023_06_21_082212_create_emp_addresses_table',1),(28,'2023_06_26_111453_create_emp_department_histories_table',1),(29,'2023_07_12_164007_create_kra_attributes_table',1),(30,'2023_07_12_164522_create_employee_kras_table',1),(31,'2023_07_20_180139_create_payroll_heads_table',1),(32,'2023_07_21_170829_create_pay_roll_payscales_table',1),(33,'2023_07_22_211301_create_payroll_payscale_heads_table',1),(34,'2023_07_25_181731_create_payroll_salaries_table',1),(35,'2023_07_25_182559_create_payroll_salary_heads_table',1),(36,'2023_07_29_085017_create_reimbursement_types_table',1),(37,'2023_07_30_115214_create_reimbursements_table',1),(38,'2023_08_01_174418_create_tax_slab_settings_table',1),(39,'2023_08_02_081616_create_payroll_salary_increments_table',1),(40,'2023_08_10_062922_create_documents_table',1),(41,'2023_08_14_194020_create_employee_transfers_table',1),(42,'2023_08_17_045713_create_departments_table',1),(43,'2023_08_18_043412_create_document_emps_table',1),(44,'2023_08_19_110118_create_overtime_settings_table',1),(45,'2023_08_24_045028_create_family_details_table',1),(46,'2023_08_25_073135_create_training_details_table',1),(47,'2023_08_26_090834_create_medical_cards_table',1),(48,'2023_08_27_085925_create_emp_medical_insurances_table',1),(49,'2023_08_29_080638_create_award_details_table',1),(50,'2023_09_23_105702_create_accounts_table',1),(51,'2023_09_24_122938_create_payroll_ttum_salary_reports_table',1),(52,'2023_09_26_064652_create_currency_settings_table',1),(53,'2023_10_31_062903_create_document_types_table',1),(54,'2023_11_03_095932_create_countries_table',1),(55,'2023_11_03_140657_create_leave_time_approvels_table',1),(56,'2023_11_16_011317_create_leave_dates_table',1),(57,'2023_12_01_112922_create_payroll_ibo_taxes_table',1),(58,'2023_12_19_115937_create_salary_settings_table',1),(59,'2023_12_21_074447_create_notifications_table',1),(60,'2024_01_03_133438_create_salary_histories_table',1),(61,'2024_01_24_080454_create_emp13th_cheques_table',1),(62,'2024_04_12_115955_create_d_b_backups_table',1),(63,'2024_04_19_133130_create_emp_current_leaves_table',1),(64,'2024_04_20_160050_create_emp_loan_histories_table',1),(65,'2024_06_04_071445_create_leave_activity_logs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `notifi_from_user_id` bigint NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `notify_at` timestamp NOT NULL,
  `is_view` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_reference_type_reference_id_index` (`reference_type`,`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'Leave Approved','leave_approval',2,1,'Dear Sanjay Sir Your SICK LEAVE is Approved On Date 02-06-2024 between 03-06-2024','App\\Models\\LeaveApply',1,'0000-00-00 00:00:00',0,'2024-06-05 18:20:30','2024-06-05 18:20:30');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `overtime_settings`
--

DROP TABLE IF EXISTS `overtime_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `overtime_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `working_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_min` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overtime_type` enum('holiday','over time') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Active',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `overtime_settings_user_id_foreign` (`user_id`),
  CONSTRAINT `overtime_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `overtime_settings`
--

LOCK TABLES `overtime_settings` WRITE;
/*!40000 ALTER TABLE `overtime_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `overtime_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_heads`
--

DROP TABLE IF EXISTS `payroll_heads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payroll_heads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeholder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'deduction,income',
  `for` enum('payscale','salary','both') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_dropdown` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payroll_heads_created_by_foreign` (`created_by`),
  KEY `payroll_heads_updated_by_foreign` (`updated_by`),
  KEY `payroll_heads_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `payroll_heads_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_heads_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_heads_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_heads`
--

LOCK TABLES `payroll_heads` WRITE;
/*!40000 ALTER TABLE `payroll_heads` DISABLE KEYS */;
INSERT INTO `payroll_heads` VALUES (1,'BoMaid','bomaid_bank','Bomaid Bank Contributtion','local','income','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(2,'BoMaid Fund','bomaid','BoMaid','local','deduction','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(3,'Pension Fund','pension_own','Pension Own contribution','local','deduction','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(4,'Pension','pension_bank','Pension Bank Contributtion','local','income','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(5,'Union Fee','union_fee','Union Fee','local','deduction','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(6,'Other Deductions','other_deductions','Other deductions','both','deduction','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(7,'Tax','tax','Tax','local','deduction','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(8,'Allowance','allowance','Allowance','local','income','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(9,'Personal Loan','personal_loan','Personal Loan','both','deduction','salary','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(10,'Car Loan','car_loan','Car Loan','both','deduction','salary','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(11,'Mortgage Loan','mortgage_loan','Mortgage Loan','both','deduction','salary','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(12,'Salary advance','salary_advance','Salary advance','both','deduction','salary','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(13,'Others/Arrears','others_arrears','Others/Arrears','local','income','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(14,'Over Time','over_time','Over Time','local','income','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(15,'Entertainment Expenses','entertainment_expenses','Entertainment Expenses','expatriate','income','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(16,'House Up Keep Allow','house_up_keep_allow','House Up Keep Allow','expatriate','income','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(17,'Provident Fund','provident_fund','Provident Fund','expatriate','deduction','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(18,'Education Allowance For IND','education_allowance','Education Allowance','expatriate','income','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL),(19,'Recovery for Car','recovery_for_car','Recovery for Car','expatriate','deduction','payscale','no','active',1,NULL,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL);
/*!40000 ALTER TABLE `payroll_heads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_ibo_taxes`
--

DROP TABLE IF EXISTS `payroll_ibo_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payroll_ibo_taxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `financial_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `gross_salary` decimal(8,3) NOT NULL,
  `reimbursement_amount` decimal(8,3) NOT NULL,
  `taxable_amount` decimal(8,3) NOT NULL,
  `tax_amount` decimal(8,3) NOT NULL,
  `calculated_at` timestamp NULL DEFAULT NULL,
  `calculated_by` bigint DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_ibo_taxes`
--

LOCK TABLES `payroll_ibo_taxes` WRITE;
/*!40000 ALTER TABLE `payroll_ibo_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `payroll_ibo_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_payscale_heads`
--

DROP TABLE IF EXISTS `payroll_payscale_heads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payroll_payscale_heads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payroll_payscale_id` bigint unsigned NOT NULL,
  `payroll_head_id` bigint unsigned NOT NULL,
  `value` double(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payroll_payscale_heads_created_by_foreign` (`created_by`),
  KEY `payroll_payscale_heads_updated_by_foreign` (`updated_by`),
  KEY `payroll_payscale_heads_deleted_by_foreign` (`deleted_by`),
  KEY `payroll_payscale_heads_payroll_payscale_id_foreign` (`payroll_payscale_id`),
  KEY `payroll_payscale_heads_payroll_head_id_foreign` (`payroll_head_id`),
  CONSTRAINT `payroll_payscale_heads_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_payscale_heads_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_payscale_heads_payroll_head_id_foreign` FOREIGN KEY (`payroll_head_id`) REFERENCES `payroll_heads` (`id`),
  CONSTRAINT `payroll_payscale_heads_payroll_payscale_id_foreign` FOREIGN KEY (`payroll_payscale_id`) REFERENCES `payroll_payscales` (`id`),
  CONSTRAINT `payroll_payscale_heads_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_payscale_heads`
--

LOCK TABLES `payroll_payscale_heads` WRITE;
/*!40000 ALTER TABLE `payroll_payscale_heads` DISABLE KEYS */;
INSERT INTO `payroll_payscale_heads` VALUES (1,1,15,0.00,'active',1,NULL,NULL,'2024-06-05 18:23:36','2024-06-05 18:23:36',NULL),(2,1,16,250.00,'active',1,NULL,NULL,'2024-06-05 18:23:36','2024-06-05 18:23:36',NULL),(3,1,18,0.00,'active',1,NULL,NULL,'2024-06-05 18:23:36','2024-06-05 18:23:36',NULL),(4,1,6,0.00,'active',1,NULL,NULL,'2024-06-05 18:23:36','2024-06-05 18:23:36',NULL),(5,1,17,144.56,'active',1,NULL,NULL,'2024-06-05 18:23:36','2024-06-05 18:23:36',NULL),(6,1,19,0.00,'active',1,NULL,NULL,'2024-06-05 18:23:36','2024-06-05 18:23:36',NULL),(7,2,15,0.00,'active',1,NULL,NULL,'2024-06-05 18:40:41','2024-06-05 18:40:41',NULL),(8,2,16,275.00,'active',1,NULL,NULL,'2024-06-05 18:40:41','2024-06-05 18:40:41',NULL),(9,2,18,0.00,'active',1,NULL,NULL,'2024-06-05 18:40:41','2024-06-05 18:40:41',NULL),(10,2,6,0.00,'active',1,NULL,NULL,'2024-06-05 18:40:41','2024-06-05 18:40:41',NULL),(11,2,17,144.56,'active',1,NULL,NULL,'2024-06-05 18:40:41','2024-06-05 18:40:41',NULL),(12,2,19,0.00,'active',1,NULL,NULL,'2024-06-05 18:40:41','2024-06-05 18:40:41',NULL),(13,3,1,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(14,3,4,375.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(15,3,8,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(16,3,13,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(17,3,14,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(18,3,2,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(19,3,3,500.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(20,3,5,25.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(21,3,6,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL),(22,3,7,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL);
/*!40000 ALTER TABLE `payroll_payscale_heads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_payscales`
--

DROP TABLE IF EXISTS `payroll_payscales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payroll_payscales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `basic` double(8,3) NOT NULL,
  `payscale_date` date DEFAULT NULL,
  `net_take_home` double NOT NULL,
  `total_deduction` double(8,3) NOT NULL,
  `gross_earning` double(8,3) NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `branch_id` bigint unsigned DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payroll_payscales_user_id_foreign` (`user_id`),
  KEY `payroll_payscales_created_by_foreign` (`created_by`),
  KEY `payroll_payscales_updated_by_foreign` (`updated_by`),
  KEY `payroll_payscales_deleted_by_foreign` (`deleted_by`),
  KEY `payroll_payscales_branch_id_foreign` (`branch_id`),
  CONSTRAINT `payroll_payscales_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `payroll_payscales_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_payscales_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_payscales_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_payscales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_payscales`
--

LOCK TABLES `payroll_payscales` WRITE;
/*!40000 ALTER TABLE `payroll_payscales` DISABLE KEYS */;
INSERT INTO `payroll_payscales` VALUES (1,1,2,'active',2500.000,'2024-06-05',2605.44,144.560,2750.000,NULL,NULL,1,1,'2024-06-05 18:23:36','2024-06-05 18:23:36',NULL),(2,1,2,'active',2750.000,'2024-11-01',2880.44,144.560,3025.000,NULL,NULL,1,1,'2024-06-05 18:40:41','2024-06-05 18:40:41',NULL),(3,2,3,'active',2500.000,'2024-06-07',2350,525.000,2875.000,NULL,NULL,2,1,'2024-06-07 07:51:18','2024-06-07 07:51:18',NULL);
/*!40000 ALTER TABLE `payroll_payscales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_salaries`
--

DROP TABLE IF EXISTS `payroll_salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payroll_salaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `employment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `pay_for_month_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_date_pay_for` date DEFAULT NULL,
  `basic` double(10,2) NOT NULL,
  `total_working_days` double NOT NULL DEFAULT '0',
  `no_of_payable_days` double NOT NULL DEFAULT '0',
  `annual_balanced_leave` double NOT NULL DEFAULT '0',
  `no_availed_leave` double NOT NULL DEFAULT '0',
  `no_of_persent_days` double NOT NULL DEFAULT '0',
  `total_loss_of_pay` double NOT NULL DEFAULT '0',
  `net_take_home` double(10,2) NOT NULL,
  `net_take_home_in_pula` double(10,2) DEFAULT NULL,
  `usd_pula_currency_amount` double(10,2) DEFAULT NULL,
  `usd_inr_currency_amount` double(10,2) DEFAULT NULL,
  `pula_inr_currency_amount` double(10,2) DEFAULT NULL,
  `total_deduction` double(10,2) NOT NULL,
  `leave_encashment_amount` double(10,2) DEFAULT '0.00',
  `emp_13_cheque_amount` double(10,2) DEFAULT '0.00',
  `leave_encashment_days` bigint DEFAULT '0',
  `gross_earning` double(10,2) NOT NULL,
  `education_allowance_for_ind_in_pula` double(10,2) DEFAULT '0.00',
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `branch_id` bigint unsigned DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payroll_salaries_user_id_foreign` (`user_id`),
  KEY `payroll_salaries_created_by_foreign` (`created_by`),
  KEY `payroll_salaries_updated_by_foreign` (`updated_by`),
  KEY `payroll_salaries_deleted_by_foreign` (`deleted_by`),
  KEY `payroll_salaries_branch_id_foreign` (`branch_id`),
  CONSTRAINT `payroll_salaries_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `payroll_salaries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_salaries_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_salaries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_salaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_salaries`
--

LOCK TABLES `payroll_salaries` WRITE;
/*!40000 ALTER TABLE `payroll_salaries` DISABLE KEYS */;
INSERT INTO `payroll_salaries` VALUES (1,1,2,'expatriate','active','2024-07','2024-07-05',2500.00,30,30,72,0,30,0,2605.44,35772.69,13.73,83.01,6.19,144.56,NULL,0.00,NULL,2750.00,0.00,NULL,NULL,1,1,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(2,1,2,'expatriate','active','2024-07','2024-07-06',2500.00,30,30,72,0,30,0,2605.44,35772.69,13.73,83.01,6.19,144.56,NULL,0.00,NULL,2750.00,0.00,NULL,NULL,1,1,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(3,1,2,'expatriate','active','2024-08','2024-08-06',2500.00,30,30,72,0,30,0,2605.44,35772.69,13.73,83.01,6.19,144.56,NULL,0.00,NULL,2750.00,0.00,NULL,NULL,1,1,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(4,2,3,'local','active','2024-07','2024-07-07',2500.00,24,24,0,0,24,0,1850.00,1850.00,1.00,83.01,6.19,1025.00,NULL,0.00,NULL,2875.00,NULL,NULL,NULL,2,1,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL);
/*!40000 ALTER TABLE `payroll_salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_salary_heads`
--

DROP TABLE IF EXISTS `payroll_salary_heads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payroll_salary_heads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payroll_salary_id` bigint unsigned NOT NULL,
  `payroll_head_id` bigint unsigned NOT NULL,
  `value` double(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payroll_salary_heads_payroll_salary_id_foreign` (`payroll_salary_id`),
  KEY `payroll_salary_heads_payroll_head_id_foreign` (`payroll_head_id`),
  KEY `payroll_salary_heads_created_by_foreign` (`created_by`),
  KEY `payroll_salary_heads_updated_by_foreign` (`updated_by`),
  KEY `payroll_salary_heads_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `payroll_salary_heads_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_salary_heads_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `payroll_salary_heads_payroll_head_id_foreign` FOREIGN KEY (`payroll_head_id`) REFERENCES `payroll_heads` (`id`),
  CONSTRAINT `payroll_salary_heads_payroll_salary_id_foreign` FOREIGN KEY (`payroll_salary_id`) REFERENCES `payroll_salaries` (`id`),
  CONSTRAINT `payroll_salary_heads_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_salary_heads`
--

LOCK TABLES `payroll_salary_heads` WRITE;
/*!40000 ALTER TABLE `payroll_salary_heads` DISABLE KEYS */;
INSERT INTO `payroll_salary_heads` VALUES (1,1,15,0.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(2,1,16,250.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(3,1,18,0.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(4,1,6,0.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(5,1,9,0.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(6,1,10,0.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(7,1,11,0.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(8,1,12,0.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(9,1,17,144.56,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(10,1,19,0.00,'active',1,NULL,NULL,'2024-06-05 18:24:14','2024-06-05 18:24:14',NULL),(11,2,15,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(12,2,16,250.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(13,2,18,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(14,2,6,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(15,2,9,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(16,2,10,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(17,2,11,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(18,2,12,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(19,2,17,144.56,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(20,2,19,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:33','2024-06-05 18:36:33',NULL),(21,3,15,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(22,3,16,250.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(23,3,18,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(24,3,6,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(25,3,9,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(26,3,10,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(27,3,11,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(28,3,12,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(29,3,17,144.56,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(30,3,19,0.00,'active',1,NULL,NULL,'2024-06-05 18:36:49','2024-06-05 18:36:49',NULL),(31,4,1,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(32,4,4,375.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(33,4,8,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(34,4,13,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(35,4,14,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(36,4,2,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(37,4,3,500.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(38,4,5,25.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(39,4,6,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(40,4,7,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(41,4,9,500.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(42,4,10,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(43,4,11,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL),(44,4,12,0.00,'active',1,NULL,NULL,'2024-06-07 07:51:33','2024-06-07 07:51:33',NULL);
/*!40000 ALTER TABLE `payroll_salary_heads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_salary_increments`
--

DROP TABLE IF EXISTS `payroll_salary_increments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payroll_salary_increments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `increment_percentage` int DEFAULT NULL,
  `employment_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_increment_date` date DEFAULT NULL,
  `effective_from` date DEFAULT NULL,
  `effective_to` date DEFAULT NULL,
  `financial_year` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_salary_increments`
--

LOCK TABLES `payroll_salary_increments` WRITE;
/*!40000 ALTER TABLE `payroll_salary_increments` DISABLE KEYS */;
INSERT INTO `payroll_salary_increments` VALUES (1,10,'expatriate','2024-06-06','2024-04-01','2024-10-31','2024-2025','active','2024-06-05 18:37:44','2024-06-05 18:37:44');
/*!40000 ALTER TABLE `payroll_salary_increments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_ttum_salary_reports`
--

DROP TABLE IF EXISTS `payroll_ttum_salary_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payroll_ttum_salary_reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'credit,debit',
  `transaction_amount` decimal(10,2) NOT NULL,
  `transaction_currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttum_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refrence_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_ttum_salary_reports`
--

LOCK TABLES `payroll_ttum_salary_reports` WRITE;
/*!40000 ALTER TABLE `payroll_ttum_salary_reports` DISABLE KEYS */;
INSERT INTO `payroll_ttum_salary_reports` VALUES (1,1,'debit',71150.00,'BWP','2024-07','Salaries for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(2,2,'debit',0.00,'BWP','2024-07','Entertainment for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(3,3,'debit',0.00,'BWP','2024-07','Education for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(4,4,'debit',6865.00,'BWP','2024-07','House up keep for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(5,5,'debit',0.00,'BWP','2024-07','Medical exp For Local for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(6,6,'debit',0.00,'BWP','2024-07','Medical exp For EXPATRIATE for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(7,7,'debit',0.00,'BWP','2024-07','PF Bank Contribution for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(8,8,'debit',375.00,'BWP','2024-07','Bank\'s Conti to Pension for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(9,9,'credit',500.00,'BWP','2024-07','Sundry Dep-Pension EFT  for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(10,10,'credit',25.00,'BWP','2024-07','B.B.E.U  {Banker Chq} for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(11,11,'credit',10.00,'BWP','2024-07','EFT to FNB Bank for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(12,12,'credit',3969.62,'BWP','2024-07','Cont. PF for Jul-2024',0,'2024-06-05 18:24:14','2024-06-05 18:36:33'),(13,13,'credit',0.00,'BWP','2024-07','Vehicle exp for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(14,14,'credit',0.00,'BWP','2024-07','Income tax for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(15,15,'credit',0.00,'BWP','2024-07','SPECIAL ADVANCE TO STAFF for Jul-2024',0,'2024-06-05 18:24:14','2024-06-07 07:51:33'),(16,16,'credit',71545.38,'BWP','2024-07','Sanjay Sir for Jul-2024',0,'2024-06-05 18:24:14','2024-06-05 18:36:33'),(17,1,'debit',34325.00,'BWP','2024-08','Salaries for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(18,2,'debit',0.00,'BWP','2024-08','Entertainment for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(19,3,'debit',0.00,'BWP','2024-08','Education for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(20,4,'debit',3432.50,'BWP','2024-08','House up keep for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(21,5,'debit',0.00,'BWP','2024-08','Medical exp For Local for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(22,6,'debit',0.00,'BWP','2024-08','Medical exp For EXPATRIATE for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(23,7,'debit',0.00,'BWP','2024-08','PF Bank Contribution for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(24,8,'debit',0.00,'BWP','2024-08','Bank\'s Conti to Pension for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(25,9,'credit',0.00,'BWP','2024-08','Sundry Dep-Pension EFT  for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(26,10,'credit',0.00,'BWP','2024-08','B.B.E.U  {Banker Chq} for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(27,11,'credit',5.00,'BWP','2024-08','EFT to FNB Bank for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(28,12,'credit',1984.81,'BWP','2024-08','Cont. PF for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(29,13,'credit',0.00,'BWP','2024-08','Vehicle exp for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(30,14,'credit',0.00,'BWP','2024-08','Income tax for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(31,15,'credit',0.00,'BWP','2024-08','SPECIAL ADVANCE TO STAFF for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(32,16,'credit',35772.69,'BWP','2024-08','Sanjay Sir for Aug-2024',0,'2024-06-05 18:36:49','2024-06-05 18:36:49'),(33,17,'credit',500.00,'BWP','2024-07','Personal_Loan of Rohit for Jul-2024',0,'2024-06-07 07:51:33','2024-06-07 07:51:33'),(34,18,'credit',1850.00,'BWP','2024-07','Rohit for Jul-2024',0,'2024-06-07 07:51:33','2024-06-07 07:51:33');
/*!40000 ALTER TABLE `payroll_ttum_salary_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions_for` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'View Dashboard','view-dashboard','Dashboard','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(2,'Add Roles','add-roles','Roles','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(3,'Edit Roles','edit-roles','Roles','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(4,'Delete Roles','delete-roles','Roles','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(5,'View Roles','view-roles','Roles','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(6,'Add Holidays','add-holidays','Holidays','[\"admin\", \"hr_head\", \"branch_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(7,'Edit Holidays','edit-holidays','Holidays','[\"admin\", \"hr_head\", \"branch_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(8,'Delete Holidays','delete-holidays','Holidays','[\"admin\", \"hr_head\", \"branch_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(9,'View Holidays','view-holidays','Holidays','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(10,'Add Employees','add-employees','Employees','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(11,'Edit Employees','edit-employees','Employees','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(12,'View Employees','view-employees','Employees','[\"admin\", \"branch_supervisor\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(13,'Change Employees Status ','change-employees-status','Employees','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(14,'Add Branch','add-branch','Branch','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(15,'Edit Branch','edit-branch','Branch','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(16,'View Branch','view-branch','Branch','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(17,'Delete Branch','delete-branch','Branch','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(18,'Change Branch Status','change-branch-status','Branch','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(19,'Add Designations','add-designations','Designations','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(20,'Edit Designations','edit-designations','Designations','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(21,'View Designations','view-designations','Designations','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(22,'Delete Designations','delete-designations','Designations','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(23,'Profile Update','profile-update','Profile Update','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(24,'Change Password','change-password','Change Password','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(25,'Add Leave','add-leave','Leave','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(26,'Edit Leave','edit-leave','Leave','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(27,'View Leave','view-leave','Leave','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(28,'Delete Leave','delete-leave','Leave','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(29,'Add Department','add-department','Department','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(30,'Edit Department','edit-department','Department','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(31,'View Department','view-department','Department','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(32,'Delete Department','delete-department','Department','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(33,'Add Employee Transfer','add-employee-transfer','Employee Transfer','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(34,'Edit Employee Transfer','edit-employee-transfer','Employee Transfer','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(35,'View Employee Transfer','view-employee-transfer','Employee Transfer','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(36,'Delete Employee Transfer','delete-employee-transfer','Employee Transfer','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(37,'Add Document Management','add-document-management','Document Management','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(38,'Edit Document Management','edit-document-management','Document Management','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(39,'View Document Management','view-document-management','Document Management','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(40,'Delete Document Management','delete-document-management','Document Management','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(41,'Add Medical card Type','add-medical-card-type','Medical card Type','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(42,'Edit Medical card Type','edit-medical-card-type','Medical card Type','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(43,'View Medical card Type','view-medical-card-type','Medical card Type','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(44,'Delete Medical card Type','delete-medical-card-type','Medical card Type','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(45,'Add Overtime Setting','add-overtime-setting','Overtime Setting','[\"admin\", \"hr_head\", \"chief_manager\", \"branch_supervisor\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(46,'Edit Overtime Setting','edit-overtime-setting','Overtime Setting','[\"admin\", \"hr_head\", \"chief_manager\", \"branch_supervisor\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(47,'View Overtime Setting','view-overtime-setting','Overtime Setting','[\"admin\", \"hr_head\", \"chief_manager\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(48,'Delete Overtime Setting','delete-overtime-setting','Overtime Setting','[\"admin\", \"hr_head\", \"chief_manager\", \"branch_supervisor\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(49,'Add Kra','add-kra','Kra','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(50,'Edit Kra','edit-kra','Kra','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(51,'View Kra','view-kra','Kra','[\"admin\", \"hr_head\", \"chief_manager\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(52,'Delete Kra','delete-kra','Kra','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(53,'Add Attributes','add-attributes','Kra Attributes','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(54,'Edit Attributes','edit-attributes','Kra Attributes','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(55,'View Attributes','view-attributes',' Kra Attributes','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(56,'Delete Attributes','delete-attributes',' Kra Attributes','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(57,'Change Status Attributes','change-status-attributes','Kra Attributes','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(58,'Add Employee Kra','add-employee-kra','Employee Kra','[\"admin\", \"branch_supervisor\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(59,'Edit Employee Kra','edit-employee-kra','Employee Kra','[\"admin\", \"branch_supervisor\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(60,'View Employee Kra','view-employee-kra','Employee Kra','[\"admin\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(61,'Delete Employee Kra','delete-employee-kra','Employee Kra','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(62,'Change Status Employee Kra','change-status-employee-kra','Employee Kra','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(63,'Print Employee Kra','print-employee-kra','Employee Kra','[\"admin\", \"branch_supervisor\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(64,'Add Leave Apply','add-leave-apply','Leave Apply','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(65,'Edit Leave Apply','edit-leave-apply','Leave Apply','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(66,'View Leave Apply','view-leave-apply','Leave Apply','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(67,'Delete Leave Apply','delete-leave-apply','Leave Apply','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(68,'Leave Approval','leave-approval','Leave Apply','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(69,'Change Status Leave Apply','change-status-leave-apply','Leave Apply','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(70,'Add Leave Encashment','add-leave-encashment','Leave Encashment','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(71,'Edit Leave Encashment','edit-leave-encashment','Leave Encashment','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(72,'View Leave Encashment','view-leave-encashment','Leave Encashment','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(73,'Delete Leave Encashment','delete-leave-encashment','Leave Encashment','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(74,'Add Leave Balance Report','add-leave-balance-report','Leave Balance Report','[\"admin\", \"employee\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(75,'Edit Leave Balance Report','edit-leave-balance-report','Leave Balance Report','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(76,'View Leave Balance Report','view-leave-balance-report','Leave Balance Report','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(77,'Delete Leave Balance Report','delete-leave-balance-report','Leave Balance Report','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(78,'Add Leave Request History','add-leave-request-history','Leave Request History','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(79,'Edit Leave Request History','edit-leave-request-history','Leave Request History','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(80,'View Leave Request History','view-leave-request-history','Leave Request History','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(81,'Delete Leave Request History','delete-leave-request-history','Leave Request History','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(82,'Add Leave Request Rejected','add-leave-request-rejected','Leave Request Rejected','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(83,'Edit Leave Request Rejected','edit-leave-request-rejected','Leave Request Rejected','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(84,'View Leave Request Rejected','view-leave-request-rejected','Leave Request Rejected','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(85,'Delete Leave Request Rejected','delete-leave-request-rejected','Leave Request Rejected','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(86,'Add Leave Reports','add-leave-reports','Leave Reports','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(87,'Edit Leave Reports','edit-leave-reports','Leave Reports','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(88,'View Leave Reports','view-leave-reports','Leave Reports','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(89,'Delete Leave Reports','delete-leave-reports','Leave Reports','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(90,'Add Leave Settings','add-leave-settings','Leave Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(91,'Edit Leave Settings','edit-leave-settings','Leave Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(92,'View Leave Settings','view-leave-settings','Leave Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(93,'Delete Leave Settings','delete-leave-settings','Leave Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(94,'Add Tax Slab Settings','add-tax-slab-settings','Tax Slab Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(95,'Edit Tax Slab Settings','edit-tax-slab-settings','Tax Slab Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(96,'View Tax Slab Settings','view-tax-slab-settings','Tax Slab Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(97,'Delete Tax Slab Settings','delete-tax-slab-settings','Tax Slab Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(98,'Add Salary Increment Settings','add-salary-increment-settings','Salary Increment Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(99,'Edit Salary Increment Settings','edit-salary-increment-settings','Salary Increment Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(100,'View Salary Increment Settings','view-salary-increment-settings','Salary Increment Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(101,'Delete Salary Increment Settings','delete-salary-increment-settings','Salary Increment Settings','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(102,'Add Salary Increment Reporting','add-salary-increment-reporting','Salary Increment Reporting','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(103,'Edit Salary Increment Reporting','edit-salary-increment-reporting','Salary Increment Reporting','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(104,'View Salary Increment Reporting','view-salary-increment-reporting','Salary Increment Reporting','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(105,'Delete Salary Increment Reporting','delete-salary-increment-reporting','Salary Increment Reporting','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(106,'Add Payroll Head','add-payroll-head','Payroll Head','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(107,'Edit Payroll Head','edit-payroll-head','Payroll Head','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(108,'View Payroll Head','view-payroll-head','Payroll Head','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(109,'Delete Payroll Head','delete-payroll-head','Payroll Head','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(110,'Change Status Payroll Head','change-status-payroll-head','Payroll Head','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(111,'Salary Setting','salary-setting','Payroll','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(112,'Add Pay Scale','add-pay-scale','Payscale','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(113,'Edit Pay Scale','edit-pay-scale','Payscale','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(114,'View Pay Scale','view-pay-scale','Payscale','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(115,'Delete Pay Scale','delete-pay-scale','Payscale','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(116,'Add Salary','add-salary','Salary','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(117,'Edit Salary','edit-salary','Salary','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(118,'View Salary','view-salary','Salary','[\"admin\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(119,'Delete Salary','delete-salary','Salary','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(120,'Print Salary','print-salary','Salary','[\"admin\", \"branch_supervisor\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(121,'Add Reimbursement Type','add-reimbursement-type','Reimbursement Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(122,'Edit Reimbursement Type','edit-reimbursement-type','Reimbursement Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(123,'View Reimbursement Type','view-reimbursement-type','Reimbursement Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(124,'Delete Reimbursement Type','delete-reimbursement-type','Reimbursement Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(125,'Add Reimbursement','add-reimbursement','Reimbursement','[\"admin\", \"chief_manager\", \"hr_head\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(126,'Edit Reimbursement','edit-reimbursement','Reimbursement','[\"admin\", \"chief_manager\", \"hr_head\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(127,'View Reimbursement','view-reimbursement','Reimbursement','[\"admin\", \"chief_manager\", \"hr_head\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(128,'Delete Reimbursement','delete-reimbursement','Reimbursement','[\"admin\", \"chief_manager\", \"hr_head\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(129,'Change Status Reimbursement','change-status-reimbursement','Reimbursement','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(130,'Add Manage Tax','add-manage-tax','Manage Tax','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(131,'Edit Manage Tax','edit-manage-tax','Manage Tax','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(132,'View Manage Tax','view-manage-tax','Manage Tax','[\"admin\", \"chief_manager\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(133,'Delete Manage Tax','delete-manage-tax','Manage Tax','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(134,'Add Account','add-account','Account','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(135,'Edit Account','edit-account','Account','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(136,'View Account','view-account','Account','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(137,'Delete Account','delete-account','Account','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(138,'Change Status Account','change-status-account','Account','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(139,'Add Currency Settings','add-currency-settings','Currency Settings','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(140,'Edit Currency Settings','edit-currency-settings','Currency Settings','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(141,'View Currency Settings','view-currency-settings','Currency Settings','[\"admin\", \"hr_head\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(142,'Delete Currency Settings','delete-currency-settings','Currency Settings','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(143,'Change Status Currency Settings','change-status-currency-settings','Currency Settings','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(144,'Add TTUM Report','add-ttum-report','TTUM Report','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(145,'Edit TTUM Report','edit-ttum-report','TTUM Report','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(146,'View TTUM Report','view-ttum-report','TTUM Report','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(147,'Delete TTUM Report','delete-ttum-report','TTUM Report','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(148,' Export Report TTUM Report','export-report-ttum-report','TTUM Report','[\"admin\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(149,'Add Leave Type Approval','add-leave-type-approval','Leave Type Approval','[\"admin\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(150,'Edit Leave Type Approval','edit-leave-type-approval','Leave Type Approval','[\"admin\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(151,'View Leave Type Approval','view-leave-type-approval','Leave Type Approval','[\"admin\", \"branch_supervisor\", \"employee\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(152,'Delete Leave Type Approval','delete-leave-type-approval','Leave Type Approval','[\"admin\", \"branch_supervisor\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(153,'Change Status Leave Type Approval','change-status-leave-type-approval','Leave Type Approval','[\"admin\", \"branch_supervisor\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(154,'Add Document Type','add-document-type','Document Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(155,'Edit Document Type','edit-document-type','Document Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(156,'View Document Type','view-document-type','Document Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(157,'Delete Document Type','delete-document-type','Document Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(158,'Change Status Document Type','change-status-document-type','Document Type','[\"admin\", \"hr_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(159,'Add Country','add-country','Country','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(160,'Edit Country','edit-country','Country','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(161,'View Country','view-country','Country','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(162,'Delete Country','delete-country','Country','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(163,'Report','report','Report','[\"admin\", \"chief_manager\", \"hr_head\", \"branch_head\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(164,'Delete Country','delete-country-2','Country','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(165,'Delete Country','delete-country-3','Country','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(166,'Delete Country','delete-country-4','Country','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41'),(167,'Change Status Country','change-status-country','Country','[\"admin\", \"chief_manager\"]','2024-06-05 12:44:41','2024-06-05 12:44:41');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `qualifications`
--

DROP TABLE IF EXISTS `qualifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qualifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `exam_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_passing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qualifications`
--

LOCK TABLES `qualifications` WRITE;
/*!40000 ALTER TABLE `qualifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `qualifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reimbursement_types`
--

DROP TABLE IF EXISTS `reimbursement_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reimbursement_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reimbursement_types`
--

LOCK TABLES `reimbursement_types` WRITE;
/*!40000 ALTER TABLE `reimbursement_types` DISABLE KEYS */;
INSERT INTO `reimbursement_types` VALUES (1,'Car fule','car_fule','active','2024-06-07 08:40:21','2024-06-07 08:40:21',NULL);
/*!40000 ALTER TABLE `reimbursement_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reimbursements`
--

DROP TABLE IF EXISTS `reimbursements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reimbursements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `expenses_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `financial_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expenses_amount` decimal(10,3) DEFAULT NULL,
  `claim_date` date DEFAULT NULL,
  `claim_from_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claim_to_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reimbursement_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reimbursement_amount` decimal(10,3) DEFAULT NULL,
  `reimbursement_notes` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reimbursement_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reimbursements_type_id_foreign` (`type_id`),
  KEY `reimbursements_user_id_foreign` (`user_id`),
  CONSTRAINT `reimbursements_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `reimbursement_types` (`id`),
  CONSTRAINT `reimbursements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reimbursements`
--

LOCK TABLES `reimbursements` WRITE;
/*!40000 ALTER TABLE `reimbursements` DISABLE KEYS */;
INSERT INTO `reimbursements` VALUES (1,1,2,'pula','2023-2024',1000.000,'2024-06-07','2','6','usd',150.000,'SDSDSD',NULL,'1',NULL,'1','approved','2024-06-06 20:41:22',NULL,'2024-06-07 08:40:58','2024-06-07 08:41:22');
/*!40000 ALTER TABLE `reimbursements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_type` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_system_define` tinyint DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'654dfb58-93ea-47e1-a1f1-f972d274003d','MANAGING DIRECTOR','managing-director','MD','admin',1,NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(2,'7a27241c-8cf6-4e1a-9f32-5bd4e1842d17','CHIEF MANAGER HO','chief-manager-ho','CM','chief_manager',1,NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(3,'56b5f8c7-9bed-4318-953b-03f2af111b0b','HR HEAD HO','hr-head-ho','HH','hr_head',1,NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(4,'336555eb-a174-4630-beca-fb2b8a0953cc','BRANCH HEAD','branch-head','BH','branch_head',1,NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(5,'929392a2-6115-49fc-b683-0f6151073d9c','BRANCH SUPERVISOR ','branch-supervisor','BS','branch_supervisor',1,NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41'),(6,'74c53ae4-a6de-4aa6-99f5-ec57d814a99b','EMPLOYEE','employee','E','employee',1,NULL,'active','2024-06-05 12:44:41','2024-06-05 12:44:41');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_permissions`
--

DROP TABLE IF EXISTS `roles_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles_permissions` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `roles_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_permissions`
--

LOCK TABLES `roles_permissions` WRITE;
/*!40000 ALTER TABLE `roles_permissions` DISABLE KEYS */;
INSERT INTO `roles_permissions` VALUES (1,1),(1,2),(3,2),(1,3),(3,3),(1,4),(1,5),(2,5),(3,5),(1,6),(3,6),(4,6),(1,7),(3,7),(4,7),(1,8),(3,8),(4,8),(1,9),(2,9),(3,9),(4,9),(5,9),(6,9),(1,10),(2,10),(3,10),(1,11),(2,11),(3,11),(1,12),(2,12),(3,12),(5,12),(1,13),(2,13),(3,13),(1,14),(2,14),(1,15),(2,15),(1,16),(2,16),(1,17),(2,17),(1,18),(2,18),(1,19),(2,19),(3,19),(1,20),(2,20),(3,20),(1,21),(2,21),(3,21),(1,22),(2,22),(3,22),(1,23),(2,23),(3,23),(4,23),(5,23),(6,23),(1,24),(2,24),(3,24),(4,24),(5,24),(6,24),(1,25),(2,25),(3,25),(4,25),(5,25),(6,25),(1,26),(2,26),(3,26),(4,26),(5,26),(6,26),(1,27),(2,27),(3,27),(4,27),(5,27),(6,27),(1,28),(2,28),(3,28),(4,28),(5,28),(6,28),(1,29),(2,29),(1,30),(2,30),(1,31),(2,31),(1,32),(2,32),(1,33),(3,33),(1,34),(3,34),(1,35),(3,35),(1,36),(3,36),(1,37),(2,37),(3,37),(1,38),(2,38),(3,38),(1,39),(2,39),(3,39),(4,39),(5,39),(6,39),(1,40),(2,40),(3,40),(1,41),(2,41),(3,41),(1,42),(2,42),(3,42),(1,43),(2,43),(3,43),(1,44),(2,44),(3,44),(1,45),(2,45),(3,45),(5,45),(1,46),(2,46),(3,46),(5,46),(1,47),(2,47),(3,47),(5,47),(6,47),(1,48),(2,48),(3,48),(5,48),(1,49),(2,49),(3,49),(1,50),(2,50),(3,50),(1,51),(2,51),(3,51),(6,51),(1,52),(2,52),(3,52),(1,53),(1,54),(1,55),(1,56),(1,57),(1,58),(5,58),(1,59),(5,59),(1,60),(6,60),(1,61),(1,62),(1,63),(2,63),(3,63),(5,63),(1,64),(2,64),(3,64),(4,64),(5,64),(6,64),(1,65),(2,65),(3,65),(4,65),(5,65),(6,65),(1,66),(2,66),(3,66),(4,66),(5,66),(6,66),(1,67),(2,67),(3,67),(4,67),(5,67),(6,67),(1,68),(2,68),(3,68),(4,68),(5,68),(6,68),(1,69),(3,69),(1,70),(2,70),(3,70),(4,70),(5,70),(6,70),(1,71),(2,71),(3,71),(4,71),(5,71),(6,71),(1,72),(2,72),(3,72),(4,72),(5,72),(6,72),(1,73),(2,73),(3,73),(4,73),(5,73),(6,73),(1,74),(3,74),(6,74),(1,75),(1,76),(1,77),(1,78),(1,79),(1,80),(1,81),(1,82),(1,83),(1,84),(1,85),(1,86),(1,87),(1,88),(1,89),(1,90),(1,91),(1,92),(1,93),(1,94),(1,95),(1,96),(1,97),(1,98),(1,99),(1,100),(1,101),(1,102),(1,103),(1,104),(1,105),(1,106),(1,107),(1,108),(1,109),(1,110),(1,111),(1,112),(1,113),(1,114),(1,115),(1,116),(1,117),(1,118),(6,118),(1,119),(2,119),(1,120),(2,120),(3,120),(5,120),(1,121),(3,121),(1,122),(3,122),(1,123),(3,123),(1,124),(3,124),(1,125),(2,125),(3,125),(6,125),(1,126),(2,126),(3,126),(6,126),(1,127),(2,127),(3,127),(6,127),(1,128),(2,128),(3,128),(6,128),(1,129),(3,129),(1,130),(2,130),(1,131),(2,131),(1,132),(2,132),(6,132),(1,133),(2,133),(1,134),(2,134),(1,135),(2,135),(1,136),(2,136),(1,137),(2,137),(1,138),(2,138),(1,139),(2,139),(3,139),(1,140),(2,140),(3,140),(1,141),(2,141),(3,141),(1,142),(2,142),(1,143),(2,143),(1,144),(1,145),(1,146),(1,147),(1,148),(1,149),(5,149),(6,149),(1,150),(5,150),(6,150),(1,151),(5,151),(6,151),(1,152),(5,152),(1,153),(5,153),(1,154),(3,154),(1,155),(3,155),(1,156),(3,156),(1,157),(3,157),(1,158),(3,158),(1,159),(2,159),(1,160),(2,160),(1,161),(2,161),(1,162),(2,162),(1,163),(2,163),(3,163),(4,163),(1,164),(2,164),(1,165),(2,165),(1,166),(2,166),(1,167),(2,167);
/*!40000 ALTER TABLE `roles_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary_histories`
--

DROP TABLE IF EXISTS `salary_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salary_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `currency_salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_salary` decimal(10,2) DEFAULT NULL,
  `salary_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `da` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_salary_for_india` decimal(10,2) DEFAULT NULL,
  `currency_salary_for_india` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inr',
  `date_of_current_basic` date DEFAULT NULL,
  `pension_contribution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_medical_insuarance` tinyint DEFAULT '0',
  `pension_opt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `union_membership_id` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary_histories`
--

LOCK TABLES `salary_histories` WRITE;
/*!40000 ALTER TABLE `salary_histories` DISABLE KEYS */;
INSERT INTO `salary_histories` VALUES (1,2,'usd',2500.00,'pf',NULL,120000.00,'inr','2024-06-05','no',1,NULL,'active','no',NULL,NULL),(2,2,'usd',2750.00,'pf',NULL,120000.00,'inr','2024-10-01','no',1,NULL,'active','yes',NULL,NULL),(3,3,'pula',2500.00,NULL,NULL,NULL,'inr','2024-05-01','yes',1,'5','active','yes',NULL,NULL);
/*!40000 ALTER TABLE `salary_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary_settings`
--

DROP TABLE IF EXISTS `salary_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salary_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bank_pension_contribution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_bank_bomaid_contribution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ibo_bank_bomaid_contribution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary_settings`
--

LOCK TABLES `salary_settings` WRITE;
/*!40000 ALTER TABLE `salary_settings` DISABLE KEYS */;
INSERT INTO `salary_settings` VALUES (1,'15','50','100','20','2024-06-05 12:44:41','2024-06-05 12:44:41');
/*!40000 ALTER TABLE `salary_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_slab_settings`
--

DROP TABLE IF EXISTS `tax_slab_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tax_slab_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from` double NOT NULL,
  `to` double NOT NULL,
  `ibo_tax_per` double NOT NULL,
  `local_tax_per` double NOT NULL,
  `additional_ibo_amount` double NOT NULL,
  `additional_local_amount` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_slab_settings`
--

LOCK TABLES `tax_slab_settings` WRITE;
/*!40000 ALTER TABLE `tax_slab_settings` DISABLE KEYS */;
INSERT INTO `tax_slab_settings` VALUES (1,0,48000,5,0,0,0,'none','active',NULL,NULL,NULL,NULL,NULL),(2,48001,84000,5,5,0,0,'none','active',NULL,NULL,NULL,NULL,NULL),(3,84001,120000,12.5,12.5,4200,1800,'none','active',NULL,NULL,NULL,NULL,NULL),(4,120000,156000,18.75,18.75,8700,6300,'none','active',NULL,NULL,NULL,NULL,NULL),(5,156000,15600000,25,25,15450,13050,'none','active',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tax_slab_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `taxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `taxes_name_unique` (`name`),
  KEY `taxes_created_by_foreign` (`created_by`),
  KEY `taxes_updated_by_foreign` (`updated_by`),
  CONSTRAINT `taxes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `taxes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taxes`
--

LOCK TABLES `taxes` WRITE;
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_details`
--

DROP TABLE IF EXISTS `training_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `skill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training_details`
--

LOCK TABLES `training_details` WRITE;
/*!40000 ALTER TABLE `training_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `training_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `unique_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_key_generated_at` timestamp NULL DEFAULT NULL,
  `password_is_changed` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salutation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'66ada1c3-34f4-4d06-84f4-c184d8b3ae32','Admin','admin@bobhrms.com','9999988888','1975-06-13 10:01:57','$2y$10$GqdWYBjVXmytaVKmvuz1uueKmYtgbPN.kkBatGdHZP8eTtzLYK726','active',NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,'2024-06-05 12:44:41','2024-06-05 12:44:41',NULL,NULL),(2,'0d4cc0a6-199e-4f16-8160-c2781c2de057','Sanjay Sir','sanjay@gmail.com','7909899',NULL,'$2y$10$VaEk9REVWRZZ.G84n58IZ.pTD1pa1OI/r1C6QT76vFb9wvDjVNlDu','active',NULL,NULL,0,NULL,NULL,NULL,NULL,1,NULL,'2024-06-05 18:16:27','2024-06-05 18:16:27',NULL,NULL),(3,'50f1fb20-5afe-41f9-9962-acc0b0d27b64','Rohit','rohit@gmail.com','7903609',NULL,'$2y$10$wcIlkCwNJvmtVKRl4XrTfuXy1bFqRazu5f3Cyt0sgpWc7QLsL1SpG','active',NULL,NULL,0,NULL,NULL,NULL,NULL,1,NULL,'2024-06-07 07:47:10','2024-06-07 07:47:10',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_permissions`
--

DROP TABLE IF EXISTS `users_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_permissions` (
  `user_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `users_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_permissions`
--

LOCK TABLES `users_permissions` WRITE;
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;
INSERT INTO `users_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,47),(1,48),(1,49),(1,50),(1,51),(1,52),(1,53),(1,54),(1,55),(1,56),(1,57),(1,58),(1,59),(1,60),(1,61),(1,62),(1,63),(1,64),(1,65),(1,66),(1,67),(1,68),(1,69),(1,70),(1,71),(1,72),(1,73),(1,74),(1,75),(1,76),(1,77),(1,78),(1,79),(1,80),(1,81),(1,82),(1,83),(1,84),(1,85),(1,86),(1,87),(1,88),(1,89),(1,90),(1,91),(1,92),(1,93),(1,94),(1,95),(1,96),(1,97),(1,98),(1,99),(1,100),(1,101),(1,102),(1,103),(1,104),(1,105),(1,106),(1,107),(1,108),(1,109),(1,110),(1,111),(1,112),(1,113),(1,114),(1,115),(1,116),(1,117),(1,118),(1,119),(1,120),(1,121),(1,122),(1,123),(1,124),(1,125),(1,126),(1,127),(1,128),(1,129),(1,130),(1,131),(1,132),(1,133),(1,134),(1,135),(1,136),(1,137),(1,138),(1,139),(1,140),(1,141),(1,142),(1,143),(1,144),(1,145),(1,146),(1,147),(1,148),(1,149),(1,150),(1,151),(1,152),(1,153),(1,154),(1,155),(1,156),(1,157),(1,158),(1,159),(1,160),(1,161),(1,162),(1,163),(1,164),(1,165),(1,166),(1,167);
/*!40000 ALTER TABLE `users_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_roles_user_id_foreign` (`user_id`),
  KEY `users_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_roles`
--

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` VALUES (1,2,1),(2,3,4);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-07 18:30:16
