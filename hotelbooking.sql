-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hotelbooking
-- ------------------------------------------------------
-- Server version	5.7.33

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
-- Table structure for table `chosen_room`
--

DROP TABLE IF EXISTS `chosen_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chosen_room` (
  `reservation_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`reservation_id`,`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chosen_room`
--

LOCK TABLES `chosen_room` WRITE;
/*!40000 ALTER TABLE `chosen_room` DISABLE KEYS */;
INSERT INTO `chosen_room` VALUES (14,4),(14,10),(22,10),(22,13),(23,11),(24,14),(25,11),(26,4),(26,12),(26,13),(26,14),(27,11),(27,12),(28,16),(29,4),(29,12),(29,14),(30,11),(30,12),(31,11),(31,12),(32,12),(33,4);
/*!40000 ALTER TABLE `chosen_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chosen_service`
--

DROP TABLE IF EXISTS `chosen_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chosen_service` (
  `reservation_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`reservation_id`,`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chosen_service`
--

LOCK TABLES `chosen_service` WRITE;
/*!40000 ALTER TABLE `chosen_service` DISABLE KEYS */;
INSERT INTO `chosen_service` VALUES (1,5),(11,4),(12,4),(12,5),(13,4),(14,6),(15,4),(15,5),(16,4),(16,5),(16,6),(16,8),(16,9),(16,10),(16,11),(21,4),(22,6),(23,8),(24,9),(25,5),(25,6),(26,5),(26,6),(27,4),(28,4),(29,5),(29,6),(29,8),(30,4),(30,5),(31,4),(31,5),(32,5),(32,6),(32,8),(32,11),(33,4),(33,5),(33,6);
/*!40000 ALTER TABLE `chosen_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `rate` tinyint(1) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,4,14,5,'Hay',_binary '\0','2023-11-20 14:10:40'),(2,1,27,5,'ok',_binary '\0','2023-12-02 08:16:50'),(3,1,27,3,'okay',_binary '\0','2023-12-04 12:33:21');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `room_total` int(15) NOT NULL,
  `service_total` int(15) NOT NULL,
  `final_total` int(15) NOT NULL,
  `method` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (28,28,770,20,790,'Tiá»n máº·t','2023-12-06 12:48:04'),(36,26,6600,1330,7930,'Tiá»n máº·t','2023-12-11 14:08:28'),(37,27,1540,1000,2540,'Tiá»n máº·t','2023-12-13 05:30:14'),(39,29,4050,917,4967,'Tiá»n máº·t','2023-12-13 08:02:16');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `no_room` int(11) NOT NULL,
  `no_guess` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `no_day` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (26,3,4,14,'2023-11-30','2023-12-03',4,1,'khÃ´ng cÃ³','2023-11-29 14:24:23'),(27,1,2,5,'2023-11-29','2023-11-30',2,1,'456789','2023-11-29 15:12:06'),(28,1,1,4,'2023-11-30','2023-11-30',1,0,'khÃ´ng cÃ³','2023-11-30 04:02:39'),(29,1,3,7,'2023-12-11','2023-12-13',3,1,'','2023-12-11 12:49:15'),(32,1,1,1,'2023-12-13','2023-12-13',1,0,'','2023-12-13 05:41:32'),(33,4,1,1,'2023-12-13','2023-12-13',1,0,'','2023-12-13 06:21:01');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `no_bed` int(11) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (4,1,'404.H1',4,'phÃ²ng hai giÆ°á»ng Ä‘Ã´i',1),(11,3,'505.H1',2,'456',1),(12,1,'admin',3,'',1),(13,2,'405.H3',3,'khÃ´ng cÃ³',1),(14,1,'sui',4,'',1),(16,1,'sasa',1,'',2);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_type`
--

DROP TABLE IF EXISTS `room_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `price` int(15) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_type`
--

LOCK TABLES `room_type` WRITE;
/*!40000 ALTER TABLE `room_type` DISABLE KEYS */;
INSERT INTO `room_type` VALUES (1,'superior','hotel1photo.webp','vip',450,_binary ''),(2,'deluxe',' ','ok luÃ´n',305,_binary ''),(3,'guest',' ','ok 2',320,_binary ''),(4,'single',' ','normal',250,_binary '');
/*!40000 ALTER TABLE `room_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` int(15) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (4,'Taxi','taxi.png',200,'ThuÃª taxi',_binary ''),(5,'Giáº·t lÃ ','laundry.png',35,'giáº·t khÃ´ lÃ  hÆ¡i',_binary ''),(6,'spa','spa.png',60,'',_binary ''),(8,'há»“ bÆ¡i',' ',36,'',_binary ''),(11,'SÃ¢n tenis','f',4242,'',_binary '\0'),(12,'PhÃ²ng xÃ´ng hÆ¡i','sauna.png',1234,'',_binary '');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (5,'Nguyá»…n HoÃ ng DÆ°Æ¡ng','Admin','HÃ  Ná»™i','0123456789','admin@gmail.com','123456'),(7,'huá»‡','Lá»… tÃ¢n','TP. HCM','0123456000','Rio_de_Janeiro@gmail.com','15454848'),(8,'LÃª Trung Hiáº¿u','Admin','HÃ  Ná»™i','0345708107','letrunghieuconj@gmail.com','123456'),(10,'Adam','Táº¡p vá»¥','','0135477800','Rio_de_Janeiro@gmail.com','123789asd');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'LÃª Trung Hiáº¿u','HBT, HÃ  Ná»™i','0345708107','letrunghieuconj@gmail.com','123456'),(3,'Vinh','TP. HCM','0123455421','johnny123@gmail.com','dffjikokj'),(4,'anhbinh','HÃ  Ná»™i','0123456789','Rio_de_Janeiro@gmail.com','123456'),(6,'Nguyá»…n Thá»‹ Nhung','HÃ  Ná»™i','0345154875','letrunghieuconj@gmail.com','123');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-13 19:56:08
