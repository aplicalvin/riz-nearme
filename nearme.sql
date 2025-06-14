-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: Nearme
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `hotel_id` int unsigned NOT NULL,
  `room_type_id` int unsigned NOT NULL,
  `payment_method_id` int unsigned DEFAULT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `adults` int NOT NULL DEFAULT '1',
  `children` int NOT NULL DEFAULT '0',
  `total_price` decimal(12,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed','no_show') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `payment_proof` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `special_requests` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_hotel_id_foreign` (`hotel_id`),
  KEY `bookings_room_type_id_foreign` (`room_type_id`),
  KEY `bookings_payment_method_id_foreign` (`payment_method_id`),
  KEY `check_in_date_check_out_date` (`check_in_date`,`check_out_date`),
  KEY `status` (`status`),
  CONSTRAINT `bookings_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  CONSTRAINT `bookings_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `bookings_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`),
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,1,1,1,1,'2025-06-15','2025-06-18',2,0,3600000.00,'cancelled','paid','proof1.jpg','Mohon kamar di lantai tinggi dengan pemandangan kota','2025-05-16 13:40:07','2025-05-16 21:17:32'),(2,1,2,4,3,'2025-07-20','2025-07-25',2,1,17500000.00,'pending','pending','1748587478_2079ce423cce201e590c.jpeg','Membutuhkan baby cot untuk anak kami','2025-05-16 13:40:07','2025-05-29 23:44:38'),(3,2,1,2,5,'2025-06-01','2025-06-03',2,0,5000000.00,'completed','paid','proof2.jpg','Perayaan anniversary, mohon dekorasi kamar','2025-05-16 13:40:07','2025-05-16 13:40:07'),(4,3,2,5,6,'2025-08-10','2025-08-15',1,0,9000000.00,'confirmed','pending',NULL,'Vegetarian, mohon tidak ada produk hewani di kamar','2025-05-16 13:40:07','2025-05-16 13:40:07'),(5,1,1,2,1,'2025-05-28','2025-05-30',1,0,5000000.00,'confirmed','pending',NULL,'','2025-05-26 10:08:20','2025-05-26 10:20:33'),(6,1,2,6,3,'2025-05-29','2025-05-30',2,0,2800000.00,'cancelled','pending','1748363501_4510ab5da19ff8e26b41.png','','2025-05-26 10:16:20','2025-05-29 21:55:56'),(7,1,2,5,2,'2025-06-01','2025-06-07',1,0,10800000.00,'cancelled','pending',NULL,'','2025-05-29 21:58:05','2025-05-29 21:58:15'),(8,1,1,8,2,'2025-06-02','2025-06-04',1,0,2000000.00,'cancelled','pending',NULL,'','2025-05-29 22:04:18','2025-05-29 22:04:37'),(9,1,1,1,3,'2025-06-05','2025-06-07',2,1,2400000.00,'confirmed','pending',NULL,'','2025-05-30 02:02:21','2025-05-30 02:08:50'),(10,41,7,10,1,'2025-07-01','2025-07-03',2,0,1500000.00,'confirmed','paid','proof_booking_1.jpg','Kamar non-smoking, lantai atas jika memungkinkan.','2025-06-03 01:47:29','2025-06-03 01:47:29'),(11,42,12,25,3,'2025-08-10','2025-08-12',1,1,2400000.00,'pending','pending',NULL,'Extra bed untuk anak.','2025-06-03 01:47:29','2025-06-03 01:47:29'),(12,43,17,41,5,'2025-09-05','2025-09-10',2,1,7500000.00,'confirmed','paid','proof_booking_3.jpg','Dekorasi honeymoon.','2025-06-03 01:47:29','2025-06-03 01:47:29'),(13,44,22,56,2,'2025-07-15','2025-07-17',2,0,2000000.00,'completed','paid','proof_booking_4.jpg',NULL,'2025-06-03 01:47:29','2025-06-03 01:47:29'),(14,45,27,71,4,'2025-10-01','2025-10-04',1,0,3600000.00,'confirmed','pending',NULL,'Early check-in jika tersedia.','2025-06-03 01:47:29','2025-06-03 01:47:29'),(15,41,32,85,1,'2025-11-11','2025-11-13',2,0,1300000.00,'pending','pending',NULL,'View yang bagus.','2025-06-03 01:47:29','2025-06-03 01:47:29'),(16,46,8,14,6,'2025-12-01','2025-12-03',2,2,3000000.00,'confirmed','paid','proof_booking_7.jpg','Kamar berdekatan jika booking 2 kamar (contoh).','2025-06-03 01:47:29','2025-06-03 01:47:29'),(17,47,13,29,3,'2026-01-05','2026-01-08',1,0,4200000.00,'cancelled','refunded','proof_booking_8.jpg','Request pembatalan.','2025-06-03 01:47:29','2025-06-03 01:47:29'),(18,48,18,44,5,'2026-02-14','2026-02-18',2,0,12000000.00,'confirmed','pending',NULL,'Valentine setup.','2025-06-03 01:47:29','2025-06-03 01:47:29'),(19,49,23,58,2,'2026-03-10','2026-03-12',2,1,1600000.00,'completed','paid','proof_booking_10.jpg','Baby cot.','2025-06-03 01:47:29','2025-06-03 01:47:29'),(20,50,9,17,1,'2026-04-01','2026-04-03',2,0,2600000.00,'confirmed','paid','proof_booking_11.jpg','Kamar dengan pemandangan taman jika ada.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(21,41,14,32,3,'2026-04-10','2026-04-12',1,0,3200000.00,'pending','pending',NULL,'Request lantai bebas asap rokok.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(22,42,19,46,5,'2026-05-05','2026-05-10',2,1,5000000.00,'confirmed','paid','proof_booking_13.jpg','Dekat dengan kolam renang.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(23,43,24,61,2,'2026-05-15','2026-05-17',2,0,1000000.00,'completed','paid','proof_booking_14.jpg',NULL,'2025-06-03 06:21:04','2025-06-03 06:21:04'),(24,44,29,77,4,'2026-06-01','2026-06-04',1,0,2400000.00,'confirmed','pending',NULL,'Late check-out jika memungkinkan.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(25,45,34,92,1,'2026-06-11','2026-06-13',2,0,3600000.00,'pending','pending',NULL,'Quiet room.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(26,46,7,11,6,'2026-07-01','2026-07-03',2,2,2400000.00,'confirmed','paid','proof_booking_17.jpg','Connecting room jika tersedia dengan booking lain.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(27,47,12,26,3,'2026-07-05','2026-07-08',1,0,5400000.00,'cancelled','pending',NULL,'Perubahan jadwal, mohon dibatalkan.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(28,48,17,40,5,'2026-08-14','2026-08-18',2,0,10000000.00,'confirmed','pending',NULL,'Request pemandangan laut terbaik.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(29,49,22,55,2,'2026-08-10','2026-08-12',2,1,1200000.00,'completed','paid','proof_booking_20.jpg','Extra handuk.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(30,50,28,74,1,'2026-09-01','2026-09-03',2,0,3400000.00,'confirmed','paid','proof_booking_21.jpg','Ulang tahun, mohon kue kecil jika memungkinkan.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(31,41,33,89,4,'2026-09-10','2026-09-12',1,1,2400000.00,'pending','pending',NULL,'Alergi debu, mohon kamar dibersihkan ekstra.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(32,42,10,20,5,'2026-10-05','2026-10-10',2,0,3500000.00,'confirmed','paid','proof_booking_23.jpg','Twin beds, bukan double.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(33,43,15,35,2,'2026-10-15','2026-10-17',2,2,2600000.00,'completed','paid','proof_booking_24.jpg','Dekat taman bermain anak.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(34,44,20,50,6,'2026-11-01','2026-11-04',1,0,2400000.00,'confirmed','pending',NULL,'Saya akan datang terlambat, sekitar pukul 10 malam.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(35,45,25,65,1,'2026-11-11','2026-11-13',2,1,3000000.00,'pending','pending',NULL,NULL,'2025-06-03 06:21:04','2025-06-03 06:21:04'),(36,46,30,80,3,'2026-12-01','2026-12-03',2,0,2600000.00,'confirmed','paid','proof_booking_27.jpg','Kamar yang tenang, jauh dari lift.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(37,47,35,95,5,'2027-01-05','2027-01-08',1,0,1050000.00,'cancelled','refunded','proof_booking_28.jpg','Batal karena urusan mendadak.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(38,48,8,15,2,'2027-02-14','2027-02-18',2,1,10000000.00,'confirmed','pending',NULL,'Rayakan ulang tahun anak.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(39,49,13,30,6,'2027-03-10','2027-03-12',2,0,4400000.00,'completed','paid','proof_booking_30.jpg','Check-in pagi jika bisa.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(40,50,18,45,1,'2027-04-01','2027-04-05',1,0,4800000.00,'pending','pending',NULL,'Saya vegetarian.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(41,41,23,60,4,'2027-04-15','2027-04-19',2,0,8000000.00,'confirmed','paid','proof_booking_32.jpg',NULL,'2025-06-03 06:21:04','2025-06-03 06:21:04'),(42,42,29,76,2,'2027-05-02','2027-05-04',2,1,1200000.00,'confirmed','pending',NULL,'Sediakan bantal tambahan.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(43,43,34,91,5,'2027-05-20','2027-05-23',1,0,3300000.00,'pending','pending','proof_booking_34.jpg','Honeymoon.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(44,44,11,24,1,'2027-06-07','2027-06-09',2,0,3200000.00,'confirmed','paid',NULL,'Saya butuh meja kerja yang nyaman.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(45,45,16,38,3,'2027-06-15','2027-06-18',2,0,3300000.00,'confirmed','paid','proof_booking_36.jpg','Kamar di lantai yang tinggi.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(46,46,21,53,5,'2027-07-01','2027-07-05',1,0,6400000.00,'pending','pending',NULL,'Saya butuh akses internet yang stabil untuk kerja.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(47,47,26,68,2,'2027-07-10','2027-07-12',2,1,1900000.00,'completed','paid','proof_booking_38.jpg','Mohon disediakan baby cot.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(48,48,31,83,4,'2027-08-01','2027-08-02',1,0,700000.00,'confirmed','pending',NULL,'Transit singkat, butuh dekat bandara.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(49,49,36,98,1,'2027-08-15','2027-08-17',2,0,1300000.00,'pending','pending',NULL,'Pemandangan pelabuhan jika memungkinkan.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(50,50,7,12,6,'2027-09-01','2027-09-04',2,2,6000000.00,'confirmed','paid','proof_booking_41.jpg','Perayaan ulang tahun pernikahan.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(51,41,12,27,3,'2027-09-10','2027-09-13',4,1,9000000.00,'cancelled','pending',NULL,'Rencana berubah.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(52,42,17,42,5,'2027-10-05','2027-10-12',5,0,28000000.00,'confirmed','pending',NULL,'Grup keluarga besar.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(53,43,22,57,2,'2027-10-15','2027-10-18',2,0,5400000.00,'completed','paid','proof_booking_44.jpg','Minta rekomendasi tempat makan enak di sekitar.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(54,44,27,72,4,'2027-11-01','2027-11-05',3,0,7600000.00,'confirmed','paid',NULL,'Perjalanan bisnis, butuh kwitansi resmi.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(55,45,32,87,1,'2027-11-11','2027-11-14',2,2,5100000.00,'pending','pending','proof_booking_46.jpg','Apakah ada fasilitas penitipan anak?','2025-06-03 06:21:04','2025-06-03 06:21:04'),(56,46,9,18,6,'2027-12-01','2027-12-04',2,0,6600000.00,'confirmed','paid','proof_booking_47.jpg','Late arrival, sekitar jam 11 malam.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(57,47,14,33,3,'2028-01-05','2028-01-09',2,1,8000000.00,'confirmed','pending',NULL,'Mohon kamar dengan view terbaik.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(58,48,19,48,5,'2028-02-14','2028-02-19',2,0,14000000.00,'completed','paid','proof_booking_49.jpg','Paket honeymoon, tolong dekorasi spesial.','2025-06-03 06:21:04','2025-06-03 06:21:04'),(59,49,24,63,2,'2028-03-10','2028-03-13',2,0,3900000.00,'confirmed','paid',NULL,'Saya seorang seniman, mencari inspirasi.','2025-06-03 06:21:04','2025-06-03 06:21:04');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `icon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Indonesia',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Jakarta','DKI Jakarta','Indonesia'),(2,'Bandung','Jawa Barat','Indonesia'),(3,'Denpasar','Bali','Indonesia'),(4,'Yogyakarta','DI Yogyakarta','Indonesia'),(5,'Surabaya','Jawa Timur','Indonesia'),(6,'Semarang','Jawa Tengah','Indonesia');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complaints` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `hotel_id` int unsigned NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('open','resolved') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `complaints_user_id_foreign` (`user_id`),
  KEY `complaints_hotel_id_foreign` (`hotel_id`),
  CONSTRAINT `complaints_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `complaints_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES (1,41,7,'AC di kamar 101 kurang dingin dan berisik. Mohon diperbaiki.','open','2025-06-03 01:47:29'),(2,42,12,'Sarapan pagi variasinya kurang banyak untuk harga segitu.','resolved','2025-06-03 01:47:29'),(3,44,22,'Air panas di kamar mandi sering mati sendiri.','open','2025-06-03 01:47:29'),(4,45,27,'Proses check-in agak lama padahal sudah booking online.','open','2025-06-03 01:47:29'),(5,49,23,'WiFi di lantai 3 sangat lambat dan sering terputus.','resolved','2025-06-03 01:47:29');
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facilities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `icon` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facilities_hotel_id_foreign` (`hotel_id`),
  CONSTRAINT `facilities_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facilities`
--

LOCK TABLES `facilities` WRITE;
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT INTO `facilities` VALUES (1,1,'Kolam Renang','Kolam renang outdoor dengan pemandangan kota','pool'),(2,1,'Spa & Wellness','Layanan spa lengkap dengan pijat tradisional','spa'),(3,1,'Restoran','Restoran mewah dengan berbagai menu internasional','restaurant'),(4,1,'Gym','Fasilitas gym lengkap dengan pelatih pribadi','gym'),(5,1,'Parkir Valet','Layanan parkir valet 24 jam','parking'),(6,2,'Private Beach','Pantai pribadi dengan pasir putih dan air jernih','beach'),(7,2,'Water Sports','Aneka aktivitas air seperti snorkeling dan kayak','watersports'),(8,2,'Beach Bar','Bar tepi pantai dengan minuman tropis','bar'),(9,2,'Kids Club','Area bermain dan aktivitas khusus untuk anak-anak','kids'),(10,2,'Bicycle Rental','Sewa sepeda untuk menjelajahi sekitar resort','bicycle'),(11,1,'Kolam Renang','Kolam renang outdoor dengan pemandangan kota','pool'),(12,1,'Spa & Wellness','Layanan spa lengkap dengan pijat tradisional','spa'),(13,1,'Restoran','Restoran mewah dengan berbagai menu internasional','restaurant'),(14,1,'Gym','Fasilitas gym lengkap dengan pelatih pribadi','gym'),(15,1,'Parkir Valet','Layanan parkir valet 24 jam','parking'),(16,2,'Private Beach','Pantai pribadi dengan pasir putih dan air jernih','beach'),(17,2,'Water Sports','Aneka aktivitas air seperti snorkeling dan kayak','watersports'),(18,2,'Beach Bar','Bar tepi pantai dengan minuman tropis','bar'),(19,2,'Kids Club','Area bermain dan aktivitas khusus untuk anak-anak','kids'),(20,2,'Bicycle Rental','Sewa sepeda untuk menjelajahi sekitar resort','bicycle'),(21,7,'Kolam Renang','Kolam renang outdoor','pool'),(22,7,'Restoran','Restoran 24 jam','restaurant'),(23,7,'WiFi Gratis','WiFi di semua area','wifi'),(24,7,'Parkir','Parkir luas','parking'),(25,8,'Kolam Renang','Kolam renang rooftop','pool'),(26,8,'Restoran Mewah','Fine dining restaurant','restaurant'),(27,8,'Gym Lengkap','Pusat kebugaran','gym'),(28,8,'WiFi Gratis','WiFi Cepat','wifi'),(29,8,'Parkir Valet','Layanan parkir valet','parking'),(30,9,'Kolam Renang Indoor','Kolam renang dalam ruangan','pool'),(31,9,'Cafe Artsy','Cafe dengan nuansa seni','restaurant'),(32,9,'WiFi Gratis','WiFi kencang','wifi'),(33,9,'Parkir Terbatas','Area parkir terbatas','parking'),(34,10,'Restoran Sederhana','Warung makan di hotel','restaurant'),(35,10,'WiFi Gratis','WiFi standar','wifi'),(36,10,'Parkir Motor','Parkir khusus motor','parking'),(37,11,'Shuttle Bandara','Antar jemput bandara','airport_shuttle'),(38,11,'Restoran 24 Jam','Restoran buka 24 jam','restaurant'),(39,11,'WiFi Gratis','WiFi di kamar','wifi'),(40,11,'Parkir Inap','Parkir untuk tamu menginap','parking'),(41,12,'Infinity Pool','Kolam renang dengan pemandangan','pool'),(42,12,'Sky Resto Bandung','Restoran di ketinggian','restaurant'),(43,12,'Spa Alam','Spa dengan nuansa alam','spa'),(44,12,'WiFi Gratis','WiFi di semua area','wifi'),(45,12,'Parkir Luas','Parkir Aman','parking'),(46,13,'Kolam Renang Klasik','Kolam renang gaya lama','pool'),(47,13,'Restoran Kolonial','Restoran masakan tempo doeloe','restaurant'),(48,13,'WiFi Gratis','WiFi Cepat','wifi'),(49,13,'Parkir Tengah Kota','Parkir di pusat kota','parking'),(50,14,'Kolam Renang Alam','Kolam renang alami','pool'),(51,14,'Resto Organik','Restoran bahan organik','restaurant'),(52,14,'Outbound Area','Area kegiatan outbound','tree'),(53,14,'WiFi Gratis','WiFi di area publik','wifi'),(54,14,'Parkir Alam','Parkir di alam terbuka','parking'),(55,15,'Pemandian Air Panas','Kolam air panas alami','hot_tub'),(56,15,'Restoran Sunda','Masakan khas Sunda','restaurant'),(57,15,'Taman Bermain Anak','Area bermain anak','kids'),(58,15,'WiFi Terbatas','WiFi di lobi','wifi'),(59,15,'Parkir Umum','Parkir untuk pengunjung','parking'),(60,16,'Rooftop Pool & Bar','Kolam renang dan bar di atap','pool'),(61,16,'Grab & Go Cafe','Cafe cepat saji','restaurant'),(62,16,'Co-working Space','Ruang kerja bersama','work'),(63,16,'WiFi Kencang','Internet super cepat','wifi'),(64,16,'Parkir Basement','Parkir di bawah gedung','parking'),(65,17,'Private Beach','Akses pantai pribadi','beach_access'),(66,17,'Beach Bar & Grill','Bar dan grill tepi pantai','restaurant'),(67,17,'Water Sports Center','Pusat olahraga air','waves'),(68,17,'Spa by the Sea','Spa dengan pemandangan laut','spa'),(69,17,'WiFi Gratis','WiFi kencang','wifi'),(70,17,'Parkir Resort','Parkir area resort','parking'),(71,18,'Yoga Shala','Studio yoga terbuka','self_improvement'),(72,18,'Organic Restaurant','Masakan sehat organik','restaurant'),(73,18,'Jungle Pool','Kolam renang di tengah hutan','pool'),(74,18,'Meditation Garden','Taman untuk meditasi','park'),(75,18,'WiFi Alami','WiFi dengan sinyal alam','wifi'),(76,18,'Parkir Hijau','Parkir ramah lingkungan','parking'),(77,19,'Rooftop Pool Club','Klub kolam renang atap','pool'),(78,19,'Fashion Cafe','Cafe dengan tema fashion','restaurant'),(79,19,'DJ Nights','Acara DJ malam hari','music_note'),(80,19,'In-house Boutique','Butik di dalam hotel','store'),(81,19,'WiFi Gaul','WiFi untuk anak muda','wifi'),(82,19,'Parkir Valet Seminyak','Parkir valet area Seminyak','parking'),(83,20,'Surf School','Sekolah selancar di hotel','surfing'),(84,20,'Reggae Bar','Bar dengan musik reggae','restaurant'),(85,20,'Board Rental','Sewa papan selancar','sports'),(86,20,'Community Pool','Kolam renang umum','pool'),(87,20,'WiFi Santai','WiFi untuk bersantai','wifi'),(88,20,'Parkir Motor Pantai','Parkir motor dekat pantai','motorcycle'),(89,21,'Skate Bowl','Area bermain skateboard','skateboarding'),(90,21,'Vegan Cafe','Kafe makanan vegan','restaurant'),(91,21,'Tattoo Studio','Studio tato di hotel','brush'),(92,21,'Communal Kitchen','Dapur bersama','kitchen'),(93,21,'WiFi Komunitas','WiFi untuk tamu','wifi'),(94,21,'Parkir Sepeda','Parkir khusus sepeda','pedal_bike'),(95,22,'Kolam Renang Taman','Kolam renang dengan taman asri','pool'),(96,22,'Restoran Angkringan Modern','Angkringan dengan konsep modern','restaurant'),(97,22,'Penyewaan Sepeda Ontel','Sewa sepeda klasik','pedal_bike'),(98,22,'WiFi Gratis','WiFi di seluruh area','wifi'),(99,22,'Parkir Luas','Parkir aman dan luas','parking'),(100,23,'Kolam Renang Pemandangan Candi','Kolam dengan view candi','pool'),(101,23,'Restoran Jawa Kuno','Masakan otentik Jawa','restaurant'),(102,23,'Layanan Tur Candi','Tur ke Prambanan & Borobudur','hiking'),(103,23,'WiFi Gratis','WiFi kencang','wifi'),(104,23,'Parkir Wisatawan','Parkir untuk bus wisata','parking'),(105,24,'Art Workshop Space','Ruang workshop seni','palette'),(106,24,'Indie Coffee Shop','Kedai kopi independen','coffee'),(107,24,'Bike Rental','Sewa sepeda keliling Jogja','directions_bike'),(108,24,'WiFi Inspirasi','WiFi untuk berkarya','wifi'),(109,24,'Parkir Kreatif','Parkir untuk seniman','parking'),(110,25,'Beach Access Path','Jalur langsung ke pantai','beach_access'),(111,25,'Seafood Grill Restaurant','Restoran bakar ikan laut','restaurant_menu'),(112,25,'Surfboard Storage','Penyimpanan papan selancar','surfing'),(113,25,'WiFi Pantai','WiFi di area pantai','wifi'),(114,25,'Parkir Pasir','Parkir di area berpasir','parking'),(115,26,'Hiking Trail Access','Akses jalur pendakian Merapi','hiking'),(116,26,'Warung Kopi Lereng','Warung kopi di lereng gunung','local_cafe'),(117,26,'Campfire Area','Area api unggun','campfire'),(118,26,'WiFi Sejuk','WiFi di udara sejuk','wifi'),(119,26,'Parkir Vila','Parkir area vila','parking'),(120,27,'Meeting Rooms','Fasilitas ruang pertemuan lengkap','meeting_room'),(121,27,'Business Center','Pusat layanan bisnis','business_center'),(122,27,'Sky Lounge','Lounge dengan pemandangan kota','nightlife'),(123,27,'WiFi Bisnis','WiFi kecepatan tinggi untuk bisnis','wifi'),(124,27,'Parkir Valet Bisnis','Layanan parkir valet','local_parking'),(125,28,'Rooftop Infinity Pool','Kolam renang di atap','pool'),(126,28,'Fine Dining Restaurant','Restoran mewah','restaurant'),(127,28,'Fitness Center 24/7','Gym buka 24 jam','fitness_center'),(128,28,'WiFi Premium','WiFi super cepat','wifi'),(129,28,'Secure Parking','Parkir aman 24 jam','local_parking'),(130,29,'Courtyard Cafe','Kafe di halaman tengah','local_cafe'),(131,29,'Antique Gallery','Galeri barang antik','museum'),(132,29,'Library','Perpustakaan kecil','local_library'),(133,29,'WiFi Klasik','WiFi di area tertentu','wifi'),(134,29,'Parkir Nostalgia','Parkir dengan nuansa lama','local_parking'),(135,30,'Outdoor Pool','Kolam renang outdoor','pool'),(136,30,'All-day Dining','Restoran buka sepanjang hari','restaurant'),(137,30,'Kids Play Area','Area bermain anak','child_friendly'),(138,30,'WiFi Andal','WiFi yang bisa diandalkan','wifi'),(139,30,'Parkir Keluarga','Parkir untuk keluarga','local_parking'),(140,31,'Airport Shuttle Service','Layanan antar jemput bandara','airport_shuttle'),(141,31,'24hr Cafe','Kafe buka 24 jam','local_cafe'),(142,31,'Luggage Storage','Penyimpanan bagasi','luggage'),(143,31,'WiFi Cepat Transit','WiFi untuk tamu transit','wifi'),(144,31,'Parkir Bandara','Parkir dekat bandara','local_parking'),(145,32,'Rooftop Pool','Kolam renang di atap','pool'),(146,32,'Restaurant Pandanaran','Restoran khas Semarang','restaurant'),(147,32,'Fitness Center','Pusat kebugaran','fitness_center'),(148,32,'WiFi Seluruh Area','WiFi gratis','wifi'),(149,32,'Parkir Pusat Kota','Parkir di tengah kota','local_parking'),(150,33,'Courtyard Restaurant','Restoran di halaman tengah','restaurant'),(151,33,'Historical Tour Desk','Meja layanan tur Kota Lama','tour'),(152,33,'Art Gallery','Galeri seni lokal','palette'),(153,33,'WiFi Antik','WiFi dengan nuansa antik','wifi'),(154,33,'Parkir Kota Lama','Parkir di area Kota Lama','local_parking'),(155,34,'Infinity Edge Pool','Kolam renang tepi jurang','pool'),(156,34,'Cliffside Restaurant','Restoran di tebing','restaurant'),(157,34,'Spa & Wellness Center','Pusat spa dan kebugaran','spa'),(158,34,'WiFi Alam','WiFi di tengah alam','wifi'),(159,34,'Parkir Resort Luas','Parkir luas untuk tamu resort','local_parking'),(160,35,'Communal Kitchen & Lounge','Dapur dan lounge bersama','kitchen'),(161,35,'Laundry Self-service','Layanan cuci mandiri','local_laundry_service'),(162,35,'Lockers','Loker penyimpanan','lock'),(163,35,'WiFi Gratis Dasar','WiFi dasar gratis','wifi'),(164,35,'Parkir Motor','Parkir untuk motor','motorcycle'),(165,36,'Seafood Restaurant','Restoran hidangan laut segar','ramen_dining'),(166,36,'Shuttle to Port','Antar jemput ke pelabuhan','directions_boat'),(167,36,'Business Corner','Sudut bisnis kecil','business_center'),(168,36,'WiFi Pelabuhan','WiFi di area hotel','wifi'),(169,36,'Parkir Truk & Mobil','Parkir untuk kendaraan besar','local_shipping');
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `user_id` int unsigned NOT NULL,
  `hotel_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`hotel_id`),
  KEY `favorites_hotel_id_foreign` (`hotel_id`),
  CONSTRAINT `favorites_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (1,1,'2025-05-30 01:59:18'),(1,2,'2025-05-30 01:59:04'),(41,7,'2025-06-03 01:47:29'),(41,12,'2025-06-03 01:47:29'),(41,17,'2025-06-03 01:47:29'),(42,8,'2025-06-03 01:47:29'),(42,22,'2025-06-03 01:47:29'),(43,27,'2025-06-03 01:47:29'),(43,32,'2025-06-03 01:47:29'),(44,10,'2025-06-03 01:47:29'),(45,15,'2025-06-03 01:47:29'),(46,36,'2025-06-03 01:47:29');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_categories`
--

DROP TABLE IF EXISTS `hotel_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotel_categories` (
  `hotel_id` int unsigned NOT NULL,
  `category_id` int unsigned NOT NULL,
  PRIMARY KEY (`hotel_id`,`category_id`),
  KEY `hotel_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `hotel_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hotel_categories_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_categories`
--

LOCK TABLES `hotel_categories` WRITE;
/*!40000 ALTER TABLE `hotel_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotel_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_galleries`
--

DROP TABLE IF EXISTS `hotel_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotel_galleries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hotel_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `hotel_galleries_hotel_id_foreign` (`hotel_id`),
  CONSTRAINT `hotel_galleries_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_galleries`
--

LOCK TABLES `hotel_galleries` WRITE;
/*!40000 ALTER TABLE `hotel_galleries` DISABLE KEYS */;
INSERT INTO `hotel_galleries` VALUES (1,'1748314080_d913656c626f7022030f.jpeg',1,'2025-05-27 02:48:00'),(3,'1748315461_538541a092e86f5ef2d4.jpg',1,'2025-05-27 03:11:01');
/*!40000 ALTER TABLE `hotel_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotels` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `city_id` int unsigned NOT NULL,
  `admin_id` int unsigned NOT NULL,
  `star_rating` tinyint DEFAULT NULL,
  `cover_photo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `hotels_city_id_foreign` (`city_id`),
  KEY `hotels_admin_id_foreign` (`admin_id`),
  CONSTRAINT `hotels_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  CONSTRAINT `hotels_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (1,'Grand Luxury Hotel','Ini Hotel bintang 5 dengan fasilitas mewah dan pelayanan terbaik di jantung kota','Dk. Bata Putih No. 236, Tasikmalaya 91613',1,4,5,'1747411177_ccb5ba116d087875c375.jpg','2025-05-09 04:11:02','2025-05-26 09:07:52'),(2,'Sunset Beach Resort','Resort tepi pantai dengan pemandangan matahari terbenam yang menakjubkan','Dk. Dipatiukur No. 785, Bontang 85925, Babel',3,5,5,'1747412656_cfcc57e5fd9b5431a4d5.jpg','2025-05-09 04:11:02','2025-05-16 09:24:16'),(6,'Hotel Dian Nuswantoro','Hotel Dian Nuswantoro merupakan hotel terbaik di kotanya','Jl. Imam Bonjol',4,10,4,'1749312944_be41a24190038b044cc0.jpg','2025-05-30 02:20:26','2025-06-07 09:15:44'),(7,'Jakarta Central Inn','Comfortable stay in the heart of Jakarta.','Jl. Jakarta Pusat No. 1',1,11,4,'cover_jakarta_1.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(8,'Grand Jakarta View','Hotel with stunning city views.','Jl. Jakarta Tinggi No. 2',1,12,5,'cover_jakarta_2.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(9,'Jakarta Boutique Hotel','Unique and stylish boutique hotel.','Jl. Jakarta Selatan No. 3',1,13,4,'cover_jakarta_3.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(10,'Budget Stay Jakarta','Affordable and clean hotel.','Jl. Jakarta Utara No. 4',1,14,3,'cover_jakarta_4.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(11,'Airport Hotel Jakarta','Convenient hotel near the airport.','Jl. Bandara Soetta No. 5',1,15,4,'cover_jakarta_5.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(12,'Bandung Highland Resort','Resort with mountain views.','Jl. Dago Atas No. 1',2,16,5,'cover_bandung_1.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(13,'Heritage Hotel Bandung','Historic hotel in Bandung city center.','Jl. Braga No. 2',2,17,4,'cover_bandung_2.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(14,'Lembang Green Resort','Eco-friendly resort in Lembang.','Jl. Lembang Asri No. 3',2,18,4,'cover_bandung_3.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(15,'Ciwidey Valley Hotspring Hotel','Hotel with natural hot springs.','Jl. Ciwidey Raya No. 4',2,19,3,'cover_bandung_4.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(16,'Urban Express Bandung','Modern hotel for city explorers.','Jl. Cihampelas No. 5',2,20,4,'cover_bandung_5.jpg','2025-06-03 01:47:28','2025-06-03 01:47:28'),(17,'Denpasar Beachfront Resort','Resort right on the beach.','Jl. Sanur Beach No. 1',3,21,5,'cover_denpasar_1.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(18,'Ubud Serene Villas','Peaceful villas in Ubud style.','Jl. Monkey Forest No. 2',3,22,4,'cover_denpasar_2.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(19,'Seminyak Chic Stay','Trendy hotel in Seminyak.','Jl. Kayu Aya No. 3',3,23,4,'cover_denpasar_3.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(20,'Kuta Surfers Paradise','Hotel for surf lovers in Kuta.','Jl. Legian No. 4',3,24,3,'cover_denpasar_4.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(21,'Canggu Hipster Hideout','Cool and calm place in Canggu.','Jl. Batu Bolong No. 5',3,25,4,'cover_denpasar_5.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(22,'Malioboro Heritage Inn','Classic inn near Malioboro street.','Jl. Malioboro No. 101',4,26,4,'cover_yogya_1.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(23,'Prambanan View Hotel','Hotel with views of Prambanan temple.','Jl. Solo Km. 16',4,27,4,'cover_yogya_2.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(24,'Jogja Art House','Artistic guesthouse in Yogyakarta.','Jl. Prawirotaman No. 12',4,28,3,'cover_yogya_3.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(25,'South Coast Resort Yogya','Resort near the southern beaches.','Jl. Parangtritis Km. 25',4,29,4,'cover_yogya_4.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(26,'Kaliurang Green Hills','Hotel in the cool Kaliurang highlands.','Jl. Kaliurang Km. 20',4,30,3,'cover_yogya_5.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(27,'Surabaya Business Hub Hotel','Strategic hotel for business travelers.','Jl. Basuki Rahmat No. 1',5,31,4,'cover_surabaya_1.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(28,'Surabaya City Lights Hotel','Modern hotel with city views.','Jl. Tunjungan Plaza No. 2',5,32,5,'cover_surabaya_2.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(29,'Old Town Charm Surabaya','Hotel with colonial charm in old Surabaya.','Jl. Kembang Jepun No. 3',5,33,3,'cover_surabaya_3.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(30,'Surabaya Eastside Inn','Comfortable inn in East Surabaya.','Jl. Dharmahusada Indah No. 4',5,34,4,'cover_surabaya_4.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(31,'Airport Transit Surabaya','Hotel for transit near Juanda Airport.','Jl. Raya Juanda No. 5',5,35,3,'cover_surabaya_5.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(32,'Simpang Lima Residence','Hotel near the iconic Simpang Lima.','Jl. Simpang Lima No. 1',6,36,4,'cover_semarang_1.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(33,'Kota Lama Heritage Hotel','Boutique hotel in Semarang Old Town.','Jl. Letjend Suprapto No. 22',6,37,4,'cover_semarang_2.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(34,'Semarang Hills View Resort','Resort with panoramic hill views.','Jl. Gombel Lama No. 33',6,38,5,'cover_semarang_3.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(35,'Budget Traveler Semarang','Affordable option for backpackers.','Jl. Pemuda No. 44',6,39,2,'cover_semarang_4.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29'),(36,'Semarang Portside Hotel','Convenient hotel near the port.','Jl. Tanjung Emas No. 55',6,40,3,'cover_semarang_5.jpg','2025-06-03 01:47:29','2025-06-03 01:47:29');
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025-05-09-035830','App\\Database\\Migrations\\Cities','default','App',1746763289,1),(2,'2025-05-09-035831','App\\Database\\Migrations\\Users','default','App',1746763289,1),(3,'2025-05-09-035833','App\\Database\\Migrations\\Hotels','default','App',1746763289,1),(4,'2025-05-09-035834','App\\Database\\Migrations\\HotelGalleries','default','App',1746763289,1),(5,'2025-05-09-035835','App\\Database\\Migrations\\RoomTypes','default','App',1746763289,1),(6,'2025-05-09-035837','App\\Database\\Migrations\\RoomGalleries','default','App',1746763289,1),(7,'2025-05-09-035838','App\\Database\\Migrations\\Categories','default','App',1746763289,1),(8,'2025-05-09-035839','App\\Database\\Migrations\\HotelCategories','default','App',1746763289,1),(9,'2025-05-09-035841','App\\Database\\Migrations\\Facilities','default','App',1746763289,1),(10,'2025-05-09-035842','App\\Database\\Migrations\\PaymentMethods','default','App',1746763289,1),(11,'2025-05-09-035843','App\\Database\\Migrations\\Bookings','default','App',1746763289,1),(12,'2025-05-09-035845','App\\Database\\Migrations\\Reviews','default','App',1746763290,1),(13,'2025-05-09-035846','App\\Database\\Migrations\\Favorites','default','App',1746763290,1),(14,'2025-05-09-035848','App\\Database\\Migrations\\Complaints','default','App',1746763290,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_methods` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('bank_transfer','e_wallet','credit_card','cash') COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `icon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` VALUES (1,'Bank Transfer - BCA','BCA','bank_transfer',1,'bca.png'),(2,'Bank Transfer - Mandiri','MANDIRI','bank_transfer',1,'mandiri.png'),(3,'Gopay','GOPAY','e_wallet',1,'gopay.png'),(4,'OVO','OVO','e_wallet',1,'ovo.png'),(5,'Credit Card - Visa/Mastercard','CC','credit_card',1,'credit_card.png'),(6,'Cash on Arrival','CASH','cash',1,'cash.png');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `hotel_id` int unsigned NOT NULL,
  `rating` tinyint NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reviews_booking_id_foreign` (`booking_id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_hotel_id_foreign` (`hotel_id`),
  CONSTRAINT `reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `reviews_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `chk_rating_range` CHECK ((`rating` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,10,41,7,4,'Hotelnya bersih dan nyaman, lokasi strategis. Pelayanan cukup baik.','2025-06-03 06:21:04'),(2,11,42,12,5,'Pemandangan dari kamar luar biasa! Fasilitas resort juga lengkap. Sangat puas!','2025-06-03 06:21:04'),(3,12,43,17,5,'Dekorasi honeymoonnya bagus, pantainya indah. Staf ramah dan sangat membantu. Recommended!','2025-06-03 06:21:04'),(4,13,44,22,3,'Cukup baik untuk harga segitu. Lokasi dekat Malioboro jadi nilai plus.','2025-06-03 06:21:04'),(5,14,45,27,4,'Hotel bisnis yang bagus, kamar bersih dan fasilitas meeting memadai.','2025-06-03 06:21:04'),(6,15,41,32,4,'View kota dari kamar oke. Sarapan variasinya lumayan.','2025-06-03 06:21:04'),(7,16,46,8,5,'Hotel mewah dengan pelayanan prima. Anak-anak senang dengan kolam renangnya.','2025-06-03 06:21:04'),(8,17,47,13,2,'Sayang sekali harus dibatalkan, tapi proses refund agak lama.','2025-06-03 06:21:04'),(9,18,48,18,5,'Suasana villa sangat tenang dan romantis, cocok untuk pasangan. Valentine setupnya oke.','2025-06-03 06:21:04'),(10,19,49,23,4,'Hotel dengan view candi yang menakjubkan. Kamar bersih dan stafnya informatif.','2025-06-03 06:21:04'),(11,20,50,9,4,'Desain hotelnya unik dan Instagramable. Kamar nyaman.','2025-06-03 06:21:04'),(12,21,41,14,3,'Konsep eco-friendlynya bagus, tapi beberapa fasilitas perlu perawatan lebih.','2025-06-03 06:21:05'),(13,22,42,19,5,'Lokasi di Seminyak sangat strategis, dekat kemana-mana. Hotelnya chic dan modern.','2025-06-03 06:21:05'),(14,23,43,24,4,'Tempatnya artistik banget, cocok buat yang suka seni. Stafnya juga asik.','2025-06-03 06:21:05'),(15,25,45,34,5,'Resort dengan pemandangan bukit yang spektakuler! Sangat menenangkan.','2025-06-03 06:21:05'),(16,26,46,7,4,'Menginap lagi di sini, pelayanan tetap konsisten baik.','2025-06-03 06:21:05'),(17,27,47,12,1,'Tidak jadi menginap, proses pembatalan mengecewakan.','2025-06-03 06:21:05'),(18,28,48,17,5,'Sangat menikmati private beach dan fasilitas water sportsnya.','2025-06-03 06:21:05'),(19,29,49,22,4,'Sarapannya enak, banyak pilihan makanan tradisional.','2025-06-03 06:21:05'),(20,30,50,28,5,'Kue ulang tahunnya kejutan yang menyenangkan! Hotelnya mewah dan viewnya bagus.','2025-06-03 06:21:05'),(21,31,41,33,3,'Lokasi di Kota Lama menarik, tapi kamar mandinya perlu perbaikan.','2025-06-03 06:21:05'),(22,32,42,10,4,'Hotel budget yang melebihi ekspektasi. Bersih dan stafnya ramah.','2025-06-03 06:21:05'),(23,33,43,15,4,'Anak-anak suka pemandian air panasnya. Kamar keluarga cukup luas.','2025-06-03 06:21:05'),(24,35,45,25,4,'Akses ke pantai selatan mudah. Bungalownya nyaman.','2025-06-03 06:21:05'),(25,36,46,30,5,'Kamar tenang sesuai permintaan. Tidur jadi nyenyak. Terima kasih!','2025-06-03 06:21:05'),(26,37,47,35,2,'Karena urusan mendadak jadi batal. Pengalaman standar.','2025-06-03 06:21:05'),(27,38,48,8,5,'Perayaan ulang tahun anak berjalan lancar, staf sangat kooperatif.','2025-06-03 06:21:05'),(28,39,49,13,4,'Check-in pagi dilayani dengan baik. Hotel heritage yang terawat.','2025-06-03 06:21:05'),(29,40,50,18,4,'Pilihan makanan vegetariannya ada, meskipun tidak banyak. Suasana villa sangat damai.','2025-06-03 06:21:05'),(30,41,41,23,5,'Sunrise dari suite sangat indah! Pengalaman tak terlupakan.','2025-06-03 06:21:05'),(31,42,42,29,3,'Hotel tua yang punya karakter. Bantal tambahan diberikan sesuai request.','2025-06-03 06:21:05'),(32,43,43,34,5,'Honeymoon kami jadi makin spesial di sini. Pemandangannya romantis banget!','2025-06-03 06:21:05'),(33,44,44,11,4,'Meja kerja di kamar cukup nyaman untuk bekerja. Lokasi dekat bandara praktis.','2025-06-03 06:21:05'),(34,45,45,16,4,'Kamar di lantai tinggi sesuai permintaan. View kota Bandung malam hari bagus.','2025-06-03 06:21:05'),(35,47,47,26,5,'Baby cot disediakan dan bersih. Anak kami tidur nyenyak. Terima kasih!','2025-06-03 06:21:05'),(36,48,48,31,4,'Sangat praktis untuk transit, shuttle bandara tepat waktu.','2025-06-03 06:21:05'),(37,49,49,36,3,'Pemandangan pelabuhan biasa saja, tapi kamar cukup bersih.','2025-06-03 06:21:05'),(38,50,50,7,5,'Staf sangat membantu dalam perayaan ulang tahun pernikahan kami. Luar biasa!','2025-06-03 06:21:05'),(39,51,41,12,2,'Kecewa karena rencana berubah dan pembatalan agak ribet.','2025-06-03 06:21:05'),(40,52,42,17,5,'Cocok untuk grup keluarga besar, semua anggota keluarga senang!','2025-06-03 06:21:05'),(41,53,43,22,4,'Rekomendasi tempat makannya oke-oke. Hotelnya juga nyaman.','2025-06-03 06:21:05'),(42,54,44,27,4,'Kwitansi resmi diberikan, sangat membantu untuk klaim kantor. Hotelnya profesional.','2025-06-03 06:21:05'),(43,56,46,9,4,'Meskipun datang malam, proses check-in tetap cepat. Kamar unik dan bersih.','2025-06-03 06:21:05'),(44,57,47,14,5,'Dapat kamar dengan view terbaik sesuai request. Sangat puas dengan pelayanannya!','2025-06-03 06:21:05'),(45,58,48,19,5,'Dekorasi honeymoon sangat romantis dan berkesan. Terima kasih banyak!','2025-06-03 06:21:05'),(46,59,49,24,4,'Sebagai seniman, saya menemukan banyak inspirasi di sini. Suasananya mendukung kreativitas.','2025-06-03 06:21:05');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_galleries`
--

DROP TABLE IF EXISTS `room_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room_galleries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `room_type_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `room_galleries_room_type_id_foreign` (`room_type_id`),
  CONSTRAINT `room_galleries_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_galleries`
--

LOCK TABLES `room_galleries` WRITE;
/*!40000 ALTER TABLE `room_galleries` DISABLE KEYS */;
INSERT INTO `room_galleries` VALUES (1,'1748328009_f5ac3b1499aed499dabf.png',1,'2025-05-27 06:40:09'),(2,'1748328030_a5355afbed7084007672.jpg',1,'2025-05-27 06:40:30'),(3,'1748396802_8da9e6b9a376253dbc48.png',1,'2025-05-28 01:46:42'),(4,'1748578261_8531af4be806beac0d4f.png',1,'2025-05-30 04:11:01'),(5,'1748595847_65fd36d838e783391c37.jpeg',2,'2025-05-30 09:04:07'),(7,'1748596026_36ad4286bc6043393466.jpg',9,'2025-05-30 09:07:06'),(8,'1748596093_8b29e4ad2e62401c74ff.png',9,'2025-05-30 09:08:13');
/*!40000 ALTER TABLE `room_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_types`
--

DROP TABLE IF EXISTS `room_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `base_price` decimal(12,2) NOT NULL,
  `capacity` int NOT NULL DEFAULT '2',
  `available_rooms` int NOT NULL DEFAULT '0',
  `photo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_types_hotel_id_foreign` (`hotel_id`),
  CONSTRAINT `room_types_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_types`
--

LOCK TABLES `room_types` WRITE;
/*!40000 ALTER TABLE `room_types` DISABLE KEYS */;
INSERT INTO `room_types` VALUES (1,1,'Deluxe Room','Kamar luas dengan tempat tidur king size, AC, dan kamar mandi mewah',1200000.00,2,10,'1747411063_e25f375557328cdfbf41.jpg'),(2,1,'Executive Suite','Suite mewah dengan ruang tamu terpisah, mini bar, dan pemandangan kota',2500000.00,2,5,'1747456970_42d66bd5f7dad73e8016.jpg'),(3,1,'Presidential Suite','Suite terluas dengan fasilitas terbaik, butler service, dan pemandangan spektakuler',5000000.00,4,2,'1747456992_49da46292797287e58fa.png'),(4,2,'Beachfront Villa','Villa pribadi dengan akses langsung ke pantai dan kolam renang pribadi',3500000.00,4,8,'1747413057_2788b02b24b12cd293da.jpg'),(5,2,'Garden View Bungalow','Bungalow nyaman dengan taman tropis dan jarak dekat ke pantai',1800000.00,2,12,'1747413116_80a169d60dd2aa22dd39.jpeg'),(6,2,'Family Suite','Suite luas dengan 2 kamar tidur, cocok untuk keluarga',2800000.00,6,4,'1747413254_34be0df901278eace48d.jpg'),(7,1,'Kamar Tambahan','Kamar tambahan memiliki tambahan',1200000.00,2,10,'1747410636_89bc55eadda57e3b9bad.png'),(8,1,'Kamar Ketiga','Kamar ketiga',1000000.00,1,10,'1747410713_ad64c094b400100a3838.png'),(9,1,'Kamar keramat','Kamar mayat',1000000.00,4,10,'1748595919_43e4c568d026eefd9c52.jpg'),(10,7,'Standard Room Jakarta 1','Cozy standard room',750000.00,2,20,'room_jkt1_std.jpg'),(11,7,'Deluxe Room Jakarta 1','Spacious deluxe room',1200000.00,2,10,'room_jkt1_dlx.jpg'),(12,7,'Suite Jakarta 1','Luxurious suite',2000000.00,4,5,'room_jkt1_suite.jpg'),(13,8,'Superior Room Jakarta 2','Modern superior room',900000.00,2,15,'room_jkt2_sup.jpg'),(14,8,'Executive Room Jakarta 2','Room for business travelers',1500000.00,2,10,'room_jkt2_exec.jpg'),(15,8,'Family Suite Jakarta 2','Suite for families',2500000.00,4,5,'room_jkt2_fam.jpg'),(16,9,'Chic Room Jakarta 3','Stylish chic room',800000.00,2,10,'room_jkt3_chic.jpg'),(17,9,'Urban Deluxe Jakarta 3','Deluxe room with urban design',1300000.00,2,8,'room_jkt3_urban.jpg'),(18,9,'Loft Suite Jakarta 3','Spacious loft suite',2200000.00,3,4,'room_jkt3_loft.jpg'),(19,10,'Economy Room Jakarta 4','Simple economy room',500000.00,2,25,'room_jkt4_eco.jpg'),(20,10,'Standard Twin Jakarta 4','Standard room with twin beds',700000.00,2,15,'room_jkt4_twin.jpg'),(21,10,'Family Room Jakarta 4','Room for small families',1000000.00,4,10,'room_jkt4_fam.jpg'),(22,11,'Transit Room Jakarta 5','Room for short transits',600000.00,1,30,'room_jkt5_transit.jpg'),(23,11,'Comfort Room Jakarta 5','Comfortable room for longer stays',950000.00,2,20,'room_jkt5_comfort.jpg'),(24,11,'Business Suite Jakarta 5','Suite with working desk',1600000.00,2,10,'room_jkt5_biz.jpg'),(25,12,'Mountain View Room BDG 1','Room with beautiful mountain scenery',1200000.00,2,15,'room_bdg1_mount.jpg'),(26,12,'Valley Deluxe BDG 1','Deluxe room overlooking the valley',1800000.00,2,10,'room_bdg1_valley.jpg'),(27,12,'Family Villa BDG 1','Spacious villa for families',3000000.00,6,5,'room_bdg1_villa.jpg'),(28,13,'Classic Room BDG 2','Room with classic colonial design',900000.00,2,20,'room_bdg2_classic.jpg'),(29,13,'Braga View Deluxe BDG 2','Deluxe room with Braga street view',1400000.00,2,10,'room_bdg2_braga.jpg'),(30,13,'Historical Suite BDG 2','Suite with historical artifacts',2200000.00,3,5,'room_bdg2_hist.jpg'),(31,14,'Garden Bungalow BDG 3','Bungalow with private garden',1100000.00,2,12,'room_bdg3_garden.jpg'),(32,14,'Forest View Room BDG 3','Room overlooking the forest',1600000.00,2,8,'room_bdg3_forest.jpg'),(33,14,'Wooden Cabin BDG 3','Cozy wooden cabin',2000000.00,4,6,'room_bdg3_cabin.jpg'),(34,15,'Hotspring Access Room BDG 4','Room with direct hot spring access',850000.00,2,20,'room_bdg4_hotspring.jpg'),(35,15,'Family Cottage BDG 4','Cottage for family near springs',1300000.00,4,10,'room_bdg4_cottage.jpg'),(36,15,'Tea Plantation View BDG 4','Room with tea plantation view',1000000.00,2,15,'room_bdg4_tea.jpg'),(37,16,'Compact Smart Room BDG 5','Small and smart room design',700000.00,2,25,'room_bdg5_smart.jpg'),(38,16,'City View Deluxe BDG 5','Deluxe room with city skyline',1100000.00,2,15,'room_bdg5_citydeluxe.jpg'),(39,16,'Studio Apartment BDG 5','Studio with kitchenette',1500000.00,3,8,'room_bdg5_studio.jpg'),(40,17,'Ocean View Villa DPS 1','Villa with direct ocean view',2500000.00,2,10,'room_dps1_oceanvilla.jpg'),(41,17,'Garden Bungalow DPS 1','Bungalow in lush gardens',1500000.00,2,15,'room_dps1_gardenbung.jpg'),(42,17,'Family Beach House DPS 1','House for families by the beach',4000000.00,6,5,'room_dps1_beachhouse.jpg'),(43,18,'Rice Paddy View Villa DPS 2','Villa overlooking rice paddies',1800000.00,2,12,'room_dps2_ricepaddy.jpg'),(44,18,'Private Pool Villa DPS 2','Villa with private pool',3000000.00,2,8,'room_dps2_privatepool.jpg'),(45,18,'Yoga Retreat Room DPS 2','Room for yoga enthusiasts',1200000.00,1,10,'room_dps2_yoga.jpg'),(46,19,'Stylish Studio DPS 3','Studio modern dan bergaya',1000000.00,2,20,'room_dps3_studio.jpg'),(47,19,'Pool Access Deluxe DPS 3','Deluxe room dengan akses kolam',1700000.00,2,10,'room_dps3_poolaccess.jpg'),(48,19,'Rooftop Suite DPS 3','Suite dengan pemandangan dari atap',2800000.00,3,5,'room_dps3_rooftop.jpg'),(49,20,'Surf Shack Room DPS 4','Kamar tema surfer',600000.00,2,25,'room_dps4_surfshack.jpg'),(50,20,'Board Riders Twin DPS 4','Kamar twin untuk peselancar',800000.00,2,15,'room_dps4_boardriders.jpg'),(51,20,'Sunset View Balcony DPS 4','Kamar dengan balkon pemandangan sunset',1200000.00,2,10,'room_dps4_sunset.jpg'),(52,21,'Minimalist Room DPS 5','Kamar desain minimalis',900000.00,2,18,'room_dps5_minimalist.jpg'),(53,21,'Artistic Loft DPS 5','Loft dengan sentuhan seni',1600000.00,2,10,'room_dps5_loft.jpg'),(54,21,'Shared Dormitory DPS 5','Kamar dormitory untuk backpacker',300000.00,6,5,'room_dps5_dorm.jpg'),(55,22,'Javanese Standard Room YGY 1','Standard room with Javanese touch',600000.00,2,20,'room_ygy1_std.jpg'),(56,22,'Keraton View Deluxe YGY 1','Deluxe room facing the Keraton area',1000000.00,2,10,'room_ygy1_keraton.jpg'),(57,22,'Pendopo Suite YGY 1','Suite with a private pendopo style balcony',1800000.00,4,5,'room_ygy1_pendopo.jpg'),(58,23,'Temple Balcony Room YGY 2','Room with temple view balcony',800000.00,2,15,'room_ygy2_temple.jpg'),(59,23,'Cultural Deluxe YGY 2','Deluxe room with cultural decor',1200000.00,2,10,'room_ygy2_cultural.jpg'),(60,23,'Sunrise Suite YGY 2','Suite to watch sunrise over temple',2000000.00,3,5,'room_ygy2_sunrise.jpg'),(61,24,'Graffiti Room YGY 3','Room with graffiti art',500000.00,2,10,'room_ygy3_graffiti.jpg'),(62,24,'Batik Studio YGY 3','Studio with batik making tools',750000.00,2,8,'room_ygy3_batik.jpg'),(63,24,'Gallery Suite YGY 3','Suite surrounded by art',1300000.00,3,4,'room_ygy3_gallery.jpg'),(64,25,'Sea Breeze Room YGY 4','Room with fresh sea breeze',900000.00,2,15,'room_ygy4_seabreeze.jpg'),(65,25,'Oceanfront Bungalow YGY 4','Bungalow facing the ocean',1500000.00,4,7,'room_ygy4_oceanfront.jpg'),(66,25,'Surfer Nook YGY 4','Small room for surfers',650000.00,1,10,'room_ygy4_surfernook.jpg'),(67,26,'Mountain Cabin YGY 5','Cabin with mountain air',700000.00,2,12,'room_ygy5_cabin.jpg'),(68,26,'Forest Retreat Room YGY 5','Room for a quiet forest retreat',950000.00,2,9,'room_ygy5_forest.jpg'),(69,26,'Family Villa Kaliurang YGY 5','Villa for family vacation',1600000.00,5,6,'room_ygy5_villa.jpg'),(70,27,'Corporate Standard SBY 1','Standard room for corporate guests',700000.00,1,25,'room_sby1_corpstd.jpg'),(71,27,'Executive Plus SBY 1','Spacious executive room with perks',1200000.00,2,15,'room_sby1_execplus.jpg'),(72,27,'Boardroom Suite SBY 1','Suite with a small meeting area',1900000.00,4,5,'room_sby1_boardroom.jpg'),(73,28,'Urban Deluxe SBY 2','Deluxe room with urban decor',950000.00,2,20,'room_sby2_urban.jpg'),(74,28,'Panoramic Suite SBY 2','Suite with panoramic city views',1700000.00,2,10,'room_sby2_panoramic.jpg'),(75,28,'Penthouse SBY 2','Luxurious penthouse',3500000.00,4,3,'room_sby2_penthouse.jpg'),(76,29,'Heritage Room SBY 3','Room with historical ambiance',600000.00,2,15,'room_sby3_heritage.jpg'),(77,29,'Classic Twin SBY 3','Classic twin bed room',800000.00,2,10,'room_sby3_twin.jpg'),(78,29,'Colonial Suite SBY 3','Spacious suite with colonial furniture',1400000.00,3,5,'room_sby3_colonial.jpg'),(79,30,'Comfort Double SBY 4','Comfortable double bed room',750000.00,2,18,'room_sby4_double.jpg'),(80,30,'Family Connect SBY 4','Connecting rooms for family',1300000.00,4,8,'room_sby4_connect.jpg'),(81,30,'Junior Suite SBY 4','Smaller suite with good amenities',1100000.00,2,6,'room_sby4_junior.jpg'),(82,31,'Short Stay Single SBY 5','Single room for short transit',500000.00,1,20,'room_sby5_single.jpg'),(83,31,'Layover Double SBY 5','Double room for layover',700000.00,2,15,'room_sby5_layover.jpg'),(84,31,'Quiet Zone Suite SBY 5','Suite in a quiet zone for rest',1000000.00,2,7,'room_sby5_quiet.jpg'),(85,32,'City View Standard SMG 1','Standard room with city view',650000.00,2,20,'room_smg1_std.jpg'),(86,32,'Deluxe Corner SMG 1','Corner deluxe room, more space',1000000.00,2,10,'room_smg1_corner.jpg'),(87,32,'Family Suite Simpang Lima SMG 1','Family suite overlooking Simpang Lima',1700000.00,4,5,'room_smg1_familysuite.jpg'),(88,33,'Vintage Room SMG 2','Room with vintage decor',800000.00,2,15,'room_smg2_vintage.jpg'),(89,33,'Old Town Deluxe SMG 2','Deluxe room in historical building',1200000.00,2,8,'room_smg2_deluxe.jpg'),(90,33,'Dutch Colonial Suite SMG 2','Suite with Dutch colonial architecture',1900000.00,3,4,'room_smg2_dutchsuite.jpg'),(91,34,'Hillside Bungalow SMG 3','Bungalow di lereng bukit',1100000.00,2,12,'room_smg3_hillside.jpg'),(92,34,'Valley View Suite SMG 3','Suite dengan pemandangan lembah',1800000.00,2,7,'room_smg3_valley.jpg'),(93,34,'Private Villa with Pool SMG 3','Villa pribadi dengan kolam renang',3000000.00,4,3,'room_smg3_privatevilla.jpg'),(94,35,'Dormitory Bed SMG 4','Tempat tidur di kamar dormitory',150000.00,1,30,'room_smg4_dorm.jpg'),(95,35,'Basic Private Room SMG 4','Kamar pribadi dasar',350000.00,2,10,'room_smg4_basic.jpg'),(96,35,'Twin Sharing SMG 4','Kamar twin untuk berbagi',400000.00,2,8,'room_smg4_twinshare.jpg'),(97,36,'Mariners Rest SMG 5','Kamar istirahat untuk pelaut',500000.00,1,20,'room_smg5_mariner.jpg'),(98,36,'Cargo Twin SMG 5','Kamar twin dekat area kargo',650000.00,2,15,'room_smg5_cargo.jpg'),(99,36,'Harbor View Double SMG 5','Kamar double dengan pemandangan pelabuhan',850000.00,2,10,'room_smg5_harbor.jpg');
/*!40000 ALTER TABLE `room_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(140) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.jpg',
  `role` enum('user','hotel','admin') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user1','user1@example.com','$2y$12$1ues4/OK3wteO/1gbbKc4ePyEJtrHoqllxYLcho2XNGOmVIcvapje','Edward Nur Adin','078525489533','1748595514_aa28b391b9666a541f72.jpeg','user','2025-05-09 04:11:01','2025-05-30 08:58:34'),(2,'user2','user2@example.com','$2y$12$.GrMTpyBZsar9dPsIm/D3eAHmTfb6F9nhpfeVRtZLSY/iCtOYE3Oq','Wardi Sitompul, S.Kom','095925941265','default.jpg','user','2025-05-09 04:11:01','2025-05-30 09:10:55'),(3,'user3','user3@example.com','$2y$12$QXW7XZV10P/RZecRPqO1POyg/VehmTNIQK8eQpaQJ6os9UvMZR.IO','Viktor Marpaung','0357 1884 287','default.jpg','user','2025-05-09 04:11:01','2025-05-30 09:11:03'),(4,'hotel_manager1','manager1@hotel.com','$2y$12$cthIkJQ7/zZO2sEqXU7hjOMQP2v7zTKYNAxKECn2nQqq7KWrIpcY6','Balijan Budiyanto','0749 2411 557','default.jpg','hotel','2025-05-09 04:11:01','2025-05-09 04:11:01'),(5,'hotel_manager2','manager2@hotel.com','$2y$12$JLurcDDyS8lvh9l6CvA8M.06Sf.WEC/bdD0LjkcTGmYBlJk2WxoPm','Purwanto Tirta Zulkarnain','0717 6871 043','default.jpg','hotel','2025-05-09 04:11:01','2025-05-09 04:11:01'),(6,'admin','admin@hotelbooking.com','$2y$12$GJAnDIR0UY0QIZVtaFwE6OFWzxBjgiRRcD.kH1T3t2luHPe.IlG3q','System Administrator','0946 4655 090','default.jpg','admin','2025-05-09 04:11:01','2025-05-09 04:11:01'),(7,'abdulsirait','manager3@hotel.com','$2y$12$i47NqPUgdlvXd164pG0h.eAJNMXfhToXsbUf7zAAh7Ssu.K/lvhh.','Abdul Sirait','0812081220812','default.jpg','hotel','2025-05-17 17:08:16','2025-05-17 17:08:16'),(9,'dzakirgans','user4@example.com','$2y$12$5K6esusLA2lMXO0WGT3v7OnrI/f2Mw5mVLYrg85WEjmj8f0akII0a','Abdullah Sinaga','0812081220812','1747583603_b1747b8861e022e3f979.jpg','user','2025-05-17 17:44:35','2025-05-18 15:53:23'),(10,'adminsatu','manager7@hotel.com','$2y$12$gLBPlRYDqosd0jBuJ7P3q.dYhD/.ZzwnOZAdZnbpRffQ7DQ/BEIVe','Admin satu','08123123123','default.jpg','hotel','2025-05-30 09:18:18','2025-05-30 09:18:18'),(11,'hoteladmin1','hotel001@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Jakarta 1','0811000001','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(12,'hoteladmin2','hotel002@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Jakarta 2','0811000002','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(13,'hoteladmin3','hotel003@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Jakarta 3','0811000003','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(14,'hoteladmin4','hotel004@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Jakarta 4','0811000004','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(15,'hoteladmin5','hotel005@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Jakarta 5','0811000005','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(16,'hoteladmin6','hotel006@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Bandung 1','0812000001','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(17,'hoteladmin7','hotel007@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Bandung 2','0812000002','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(18,'hoteladmin8','hotel008@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Bandung 3','0812000003','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(19,'hoteladmin9','hotel009@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Bandung 4','0812000004','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(20,'hoteladmin10','hotel010@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Bandung 5','0812000005','default.jpg','hotel','2025-06-03 01:47:28','2025-06-03 01:47:28'),(21,'hoteladmin11','hotel011@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Denpasar 1','0813000001','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(22,'hoteladmin12','hotel012@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Denpasar 2','0813000002','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(23,'hoteladmin13','hotel013@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Denpasar 3','0813000003','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(24,'hoteladmin14','hotel014@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Denpasar 4','0813000004','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(25,'hoteladmin15','hotel015@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Denpasar 5','0813000005','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(26,'hoteladmin16','hotel016@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Yogyakarta 1','0814000001','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(27,'hoteladmin17','hotel017@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Yogyakarta 2','0814000002','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(28,'hoteladmin18','hotel018@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Yogyakarta 3','0814000003','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(29,'hoteladmin19','hotel019@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Yogyakarta 4','0814000004','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(30,'hoteladmin20','hotel020@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Yogyakarta 5','0814000005','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(31,'hoteladmin21','hotel021@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Surabaya 1','0815000001','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(32,'hoteladmin22','hotel022@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Surabaya 2','0815000002','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(33,'hoteladmin23','hotel023@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Surabaya 3','0815000003','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(34,'hoteladmin24','hotel024@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Surabaya 4','0815000004','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(35,'hoteladmin25','hotel025@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Surabaya 5','0815000005','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(36,'hoteladmin26','hotel026@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Semarang 1','0816000001','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(37,'hoteladmin27','hotel027@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Semarang 2','0816000002','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(38,'hoteladmin28','hotel028@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Semarang 3','0816000003','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(39,'hoteladmin29','hotel029@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Semarang 4','0816000004','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(40,'hoteladmin30','hotel030@nearme.com','$2y$10$2.yqfYvjWkydAR1yop4TouJPnEqD6nnYJ5OrMxZPTqOPT35PE7Zsq','Admin Hotel Semarang 5','0816000005','default.jpg','hotel','2025-06-03 01:47:29','2025-06-03 01:47:29'),(41,'travelbug01','user01@example.com','$2y$12$T6lG9IKw.mMCP4NQlk9Hk.Od/rD8Enmk2gHbsA0.WIEq4QhR0F0L6','Budi Santoso','082112345670','1748932484_19fcc2b65a86f9a8eaef.jpg','user','2025-06-03 01:47:29','2025-06-03 06:34:44'),(42,'wanderlust_ana','user02@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Ana Putri','082112345671','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29'),(43,'globetrotter_jaya','user03@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Jaya Perkasa','082112345672','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29'),(44,'siti_explorer','user04@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Siti Aminah','082112345673','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29'),(45,'ahmad_journey','user05@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Ahmad Dahlan','082112345674','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29'),(46,'dewi_backpacker','user06@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Dewi Lestari','082112345675','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29'),(47,'eko_voyager','user07@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Eko Prasetyo','082112345676','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29'),(48,'rina_adventurer','user08@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Rina Wulandari','082112345677','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29'),(49,'yusuf_nomad','user09@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Yusuf Ibrahim','082112345678','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29'),(50,'fitri_traveler','user10@example.com','$2y$10$36bZ.48NQ/ZSEb8aovbw8.H8sDqR/BDVGYBRUQwlnlYXNQp7IvQQm','Fitriani Rahayu','082112345679','default.jpg','user','2025-06-03 01:47:29','2025-06-03 01:47:29');
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

-- Dump completed on 2025-06-07 23:39:21
