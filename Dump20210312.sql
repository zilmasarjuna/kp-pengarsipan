-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: pengarsipan
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `fullname` varchar(55) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `no_telp` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_ibfk_1` (`user_id`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (8,19,'Clapping Ape','Tendean','081293373212'),(9,21,'Yamaha','Gg Bekasi','081293373212'),(10,23,'Toyota','Karawan','081293373212');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `task_id` int DEFAULT NULL,
  `path_name` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `show_client` tinyint(1) DEFAULT '0',
  `file_client` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `files_ibfk_1` (`task_id`),
  KEY `files_ibfk_2_idx` (`user_id`),
  CONSTRAINT `files_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `files_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (44,'Laporan Tahunan - Berkas.pdf','2021-03-05 15:41:38',23,'/file/task/Laporan Tahunan - Berkas.pdf',23,0,1),(45,'Laporan Tahunan.pdf','2021-03-05 15:42:57',23,'/file/task/Laporan Tahunan.pdf',18,1,0),(46,'Laporan Tahunan - Version1.pdf','2021-03-05 15:45:48',23,'/file/task/Laporan Tahunan - Version1.pdf',1,1,0),(47,'Laporan Tahunan - Berkas.pdf','2021-03-05 20:47:49',24,'/file/task/Laporan Tahunan - Berkas.pdf',23,0,1),(48,'Laporan Tahunan - Berkas.pdf','2021-03-05 20:50:07',24,'/file/task/Laporan Tahunan - Berkas.pdf',23,0,1),(49,'Laporan Tahunan.pdf','2021-03-05 20:50:27',24,'/file/task/Laporan Tahunan.pdf',20,1,0),(50,'Laporan Tahunan - Berkas.pdf','2021-03-05 20:58:50',25,'/file/task/Laporan Tahunan - Berkas.pdf',23,0,1),(51,'Laporan Tahunan.pdf','2021-03-05 20:59:46',25,'/file/task/Laporan Tahunan.pdf',20,1,0),(52,'Laporan Tahunan - Version1.pdf','2021-03-05 21:01:49',25,'/file/task/Laporan Tahunan - Version1.pdf',1,1,0),(53,'Laporan Tahunan - Berkas.pdf','2021-03-12 00:05:43',26,'/file/task/Laporan Tahunan - Berkas.pdf',23,0,1),(54,'Laporan Tahunan.pdf','2021-03-12 00:06:52',26,'/file/task/Laporan Tahunan.pdf',18,1,0),(55,'Laporan Tahunan - Version1.pdf','2021-03-12 00:10:03',26,'/file/task/Laporan Tahunan - Version1.pdf',1,1,0);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `task_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`task_id`),
  CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES (6,'minta tambahan column laba',23),(7,'Minta tolong tambahkan column rugi',25),(8,'Tambahkan column laba rugi',26);
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'konsultan'),(2,'staff'),(3,'clients');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `fullname` varchar(55) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `no_telp` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staffs_ibfk_1` (`user_id`),
  CONSTRAINT `staffs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffs`
--

LOCK TABLES `staffs` WRITE;
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
INSERT INTO `staffs` VALUES (10,18,'Zilmas Arjuna Brata S','Gg Bekasi','081293373212'),(11,20,'Andi Setiawan','Gg Bekasi','081293373212'),(12,22,'Yuda Widiautama','Gg Bekasi','081293373212');
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `description` varchar(55) DEFAULT NULL,
  `tgl_deadline` date DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` enum('Di Buat','Menunggu Berkas','Siap diproses','Sedang diproses','Siap dicek','Revisi','Selesai') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`),
  KEY `tasks_ibfk_1` (`client_id`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (22,'Laporan Pajak Tahunan (2021)','Laporan Pajak Tahunan','2021-03-26',10,10,'2021-03-05 15:35:37','Menunggu Berkas'),(23,'Laporan Pajak Tahunan (2020)','Laporan Pajak Tahunan 2020','2021-03-27',10,10,'2021-03-05 15:40:39','Selesai'),(24,'Laporan Laba Rugi (Maret)','Laporan Laba Rugi','2021-04-03',10,11,'2021-03-05 20:47:09','Siap dicek'),(25,'Laporan Laba Rugi (April)','Laporan Laba Rugi','2021-04-10',10,11,'2021-03-05 20:58:18','Selesai'),(26,'Laporan Pajak Tahunan (2019)','Laporan Pajak','2021-03-27',10,10,'2021-03-12 00:04:43','Selesai');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `pasword` varchar(50) NOT NULL,
  `role_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `users_ibfk_1` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'konsultan','123456',1),(18,'zilmas','123456',2),(19,'clappingape','123456',3),(20,'andi','123456',2),(21,'yamaha','123456',3),(22,'yudha','123456',2),(23,'toyota','123456',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'pengarsipan'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-12  0:28:20
