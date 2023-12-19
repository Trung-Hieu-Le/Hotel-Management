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
INSERT INTO `chosen_room` VALUES (14,4),(14,10),(22,10),(22,13),(23,11),(24,14),(25,11),(26,4),(26,12),(26,13),(26,14),(27,11),(27,12),(29,4),(29,12),(29,14),(30,11),(30,12),(31,11),(31,12),(33,4),(34,13),(34,14),(35,4),(35,16),(36,13),(37,4),(38,12),(38,14),(39,11),(42,4),(43,25),(44,20),(45,22),(46,4),(47,33),(47,34),(48,18),(48,25),(49,4),(49,23);
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
INSERT INTO `chosen_service` VALUES (1,5),(11,4),(12,4),(12,5),(13,4),(14,6),(15,4),(15,5),(16,4),(16,5),(16,6),(16,8),(16,9),(16,10),(16,11),(21,4),(22,6),(23,8),(24,9),(25,5),(25,6),(26,5),(26,6),(27,4),(29,6),(29,8),(30,4),(30,5),(31,4),(31,5),(33,4),(33,5),(33,6),(34,4),(34,5),(35,6),(35,8),(36,4),(36,5),(37,4),(37,5),(38,4),(38,5),(38,6),(38,8),(38,12),(39,5),(39,8),(39,12),(42,4),(42,6),(44,13),(44,14),(45,4),(45,13),(45,14),(46,4),(48,4),(48,8);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,4,14,3,'Hay',_binary '\0','2023-11-20 14:10:40'),(2,1,27,3,'ok',_binary '\0','2023-12-02 08:16:50'),(4,3,38,5,'Chuyáº¿n Ä‘i ráº¥t tá»‘t, phá»¥c vá»¥ 5 sao',_binary '','2023-12-14 06:05:30'),(5,4,38,5,'Nice service!',_binary '','2023-12-14 06:05:47'),(6,9,28,5,'Beautiful scene',_binary '','2023-12-14 06:07:10'),(7,12,27,5,'Phong sach se',_binary '','2023-12-14 06:07:13'),(8,11,27,5,'Khach san xung dang 5 sao!',_binary '','2023-12-14 06:08:00'),(9,6,29,5,'Hay',_binary '','2023-12-14 06:08:11'),(10,8,32,5,'OK',_binary '','2023-12-14 06:10:49'),(11,7,26,5,'Phong dep lam shop',_binary '\0','2023-12-14 06:19:13'),(12,1,26,5,'Chuyáº¿n Ä‘i thá»±c sá»± Ä‘Ã¡ng vá»›i sá»‘ tiá»n bá» ra',_binary '','2023-12-19 11:55:44');
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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (68,26,66000000,10500000,76500000,'Tiá»n máº·t','2023-11-25 05:25:30'),(69,27,13000000,250000,13250000,'Tiá»n máº·t','2023-11-30 05:25:34'),(72,33,4500000,800000,5300000,'Chuyá»ƒn khoáº£n','2023-12-01 05:25:53'),(73,34,7500000,2450000,9950000,'Chuyá»ƒn khoáº£n','2023-12-01 05:26:07'),(74,35,9000000,550000,9550000,'Tiá»n máº·t','2023-12-13 05:26:12'),(75,36,12000000,1050000,13050000,'Chuyá»ƒn khoáº£n','2023-12-13 05:26:16'),(76,42,9000000,2000000,11000000,'Chuyá»ƒn khoáº£n','2023-12-13 05:26:35'),(78,29,40500000,3850000,44350000,'Tiá»n máº·t','2023-12-17 11:09:25'),(81,43,4800000,0,4800000,'Chuyá»ƒn khoáº£n','2023-12-19 11:18:49'),(82,46,27000000,100000,27100000,'Tiá»n máº·t','2023-12-19 11:28:28'),(83,49,18000000,0,18000000,'Chuyá»ƒn khoáº£n','2023-12-19 11:30:54');
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (26,1,4,14,'2023-11-30','2023-12-03',4,1,'','2023-11-29 14:24:23'),(27,1,2,5,'2023-11-29','2023-11-30',2,1,'','2023-11-29 15:12:06'),(29,8,3,7,'2023-12-24','2023-12-26',3,1,'','2023-12-11 12:49:15'),(33,3,1,1,'2023-12-13','2023-12-13',1,1,'','2023-12-13 06:21:01'),(34,6,2,7,'2023-12-13','2023-12-13',1,1,'','2023-12-13 13:24:16'),(35,4,2,1,'2023-12-13','2023-12-13',1,1,'','2023-12-13 13:59:33'),(36,1,1,3,'2023-12-13','2023-12-16',4,1,'khÃ´ng cÃ³','2023-12-13 14:09:32'),(37,11,1,4,'2023-12-14','2023-12-15',2,2,'','2023-12-14 05:47:05'),(38,1,2,6,'2023-12-14','2023-12-24',11,0,'','2023-12-14 05:48:42'),(39,7,1,2,'2023-12-31','2024-01-01',2,2,'','2023-12-14 06:50:50'),(42,8,1,4,'2023-12-31','2024-01-01',2,1,'','2023-12-18 05:22:15'),(43,4,1,2,'2023-12-30','2024-01-02',4,1,'khÃ´ng cÃ³','2023-12-19 05:44:49'),(44,10,1,4,'2024-01-20','2024-01-24',5,0,'','2023-12-19 11:12:56'),(45,11,1,2,'2024-02-08','2024-02-14',7,0,'','2023-12-19 11:20:26'),(46,9,1,2,'2023-12-03','2023-12-08',6,1,'','2023-12-19 11:23:06'),(47,1,2,6,'2023-12-02','2023-12-16',15,0,'','2023-12-19 11:24:18'),(48,10,2,4,'2023-12-24','2023-12-26',3,0,'','2023-12-19 11:29:43'),(49,4,2,8,'2023-12-16','2023-12-17',2,1,'','2023-12-19 11:30:27');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (4,1,'SUI104',4,'phÃ²ng hai giÆ°á»ng Ä‘Ã´i',1),(11,3,'SUP108',2,'',1),(12,1,'SUI105',3,'',2),(13,2,'DEL212',3,'',1),(14,1,'SUI410',4,'',2),(16,1,'SUI402',2,'',1),(17,4,'STA202',3,'',1),(18,4,'STA203',2,'',2),(19,2,'DEL213',4,'',1),(20,3,'SUP300',4,'',2),(21,2,'DEL209',1,'',1),(22,1,'SUI200',2,'view biá»ƒn',2),(23,1,'SUI208',4,'',1),(24,2,'DEL311',3,'',1),(25,4,'STA212',2,NULL,2),(26,4,'STA111',1,NULL,1),(27,2,'DEL306',3,NULL,1),(28,1,'SUI314',4,NULL,1),(29,1,'SUI315',4,NULL,1),(30,3,'SUP207',2,NULL,1),(31,3,'SUP308',1,'',1),(32,3,'SUP113',1,'',1),(33,3,'SUP115',3,'',2),(34,2,'DEL315',3,'',2),(35,1,'SUI213',2,'Äang báº£o trÃ¬ mÃ¡y láº¡nh',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_type`
--

LOCK TABLES `room_type` WRITE;
/*!40000 ALTER TABLE `room_type` DISABLE KEYS */;
INSERT INTO `room_type` VALUES (1,'Suite ','suite.jpg','PhÃ²ng Suite thÆ°á»ng Ä‘Æ°á»£c bá»‘ trÃ­ náº±m á»Ÿ táº§ng cao nháº¥t cá»§a khÃ¡ch sáº¡n hay cÃ¡c cÄƒn há»™ sang trá»ng, Ä‘áº³ng cáº¥p nháº¥t táº¡i cÃ¡c resort. ÄÃ¢y lÃ  vá»‹ trÃ­ vÃ´ cÃ¹ng Ä‘áº¯c Ä‘á»‹a, giÃºp khÃ¡ch hÃ ng cÃ³ Ä‘Æ°á»£c táº§m nhÃ¬n Ä‘áº¹p nháº¥t.Má»™t cÄƒn phÃ²ng Suite trong khÃ¡ch sáº¡n thÆ°á»ng cÃ³ diá»‡n tÃ­ch dao Ä‘á»™ng tá»« 60 â€“ 120m2 tÃ¹y theo phong cÃ¡ch thiáº¿t káº¿ cá»§a khÃ¡ch sáº¡n. CÃ³ thá»ƒ coi diá»‡n tÃ­ch chÃ­nh lÃ  yáº¿u tá»‘ hÃ ng Ä‘áº§u chi phá»‘i Ä‘áº¿n cÆ¡ cáº¥u cá»§a má»™t cÄƒn phÃ²ng Suite. Má»—i má»™t phÃ²ng Suite sáº½ bao gá»“m: 1 phÃ²ng khÃ¡ch, 1 phÃ²ng ngá»§ riÃªng biá»‡t. NgoÃ i ra cÃ²n cÃ³ thÃªm khu vá»±c báº¿p, phÃ²ng Äƒn, thÆ° viá»‡n, khÃ´ng gian ban cÃ´ng rá»™ng rÃ£i Ä‘á»‘i vá»›i cÃ¡c khÃ¡ch sáº¡n cÃ³ quy mÃ´ lá»›n. Thiáº¿t káº¿ cá»§a cÄƒn phÃ²ng Suite Ä‘Æ°á»£c chÃº trá»ng Ä‘áº¿n tá»«ng chi tiáº¿t. CÃ¡c váº­t dá»¥ng Ä‘Æ°á»£c sá»­ dá»¥ng trong cÄƒn phÃ²ng Ä‘á»u Ä‘áº£m báº£o Ä‘á»™ tháº©m má»¹ cao nháº¥t. DÃ¹ mang nÃ©t Ä‘áº·c trÆ°ng riÃªng nhÆ°ng váº«n hÃ i hÃ²a vá»›i tá»•ng thá»ƒ khÃ´ng gian chung. VÃ  phÃ¹ há»£p vá»›i phong cÃ¡ch thiáº¿t káº¿ cá»§a khÃ¡ch sáº¡n. GiÃºp khÃ¡ch hÃ ng cáº£m nháº­n Ä‘Æ°á»£c sá»± áº¥m cÃºng vÃ  thÆ° giÃ£n.',4500000,_binary ''),(2,'Deluxe ','deluxe.png','Deluxe (viáº¿t táº¯t lÃ  DLX) lÃ  má»™t loáº¡i phÃ²ng cao cáº¥p, loáº¡i phÃ²ng nÃ y cÃ³ cháº¥t lÆ°á»£ng sá»­ dá»¥ng tá»‘t hÆ¡n loáº¡i phÃ²ng Superior vá»›i diá»‡n tÃ­ch phÃ²ng lá»›n hÆ¡n cÃ¹ng nhiá»u ná»™i tháº¥t tiá»‡n nghi. PhÃ²ng Deluxe thÆ°á»ng náº±m á»Ÿ táº§ng trÃªn cao, diá»‡n tÃ­ch sá»­ dá»¥ng rá»™ng khoáº£ng tá»« 40 â€“ 60m2. CÃ¡c loáº¡i phÃ²ng deluxe cÃ³ lá»£i tháº¿ vá» thiáº¿t káº¿ Ä‘áº£m báº£o khung cáº£nh Ä‘áº¹p, khÃ´ng gian thoÃ¡ng Ä‘Ã£ng cÃ¹ng Ä‘áº§y Ä‘á»§ tiá»‡n nghi sang trá»ng kÃ¨m theo má»©c giÃ¡ há»£p lÃ½. Do lÃ  háº¡ng phÃ²ng cao cáº¥p nÃªn nhá»¯ng Ä‘á»“ váº­t trang trÃ­ trong phÃ²ng hay nhá»¯ng váº­t dá»¥ng sá»­ dá»¥ng trong phÃ²ng táº¥t cáº£ Ä‘á»u lÃ  cÃ¡c mÃ³n Ä‘á»“ tiá»‡n nghi cao cáº¥p nhÆ° bá»“n táº¯m Ä‘Æ°á»£c bá»‘ trÃ­ trong phÃ²ng (tÃ¹y phÃ²ng), tá»§ láº¡nh mini, mÃ¡y pha cafe, há»‡ thá»‘ng Ã¢m thanh, tivi giáº£i trÃ­ cháº¥t lÆ°á»£ng cao,â€¦',3000000,_binary ''),(3,'Superior ','superior.jpg','PhÃ²ng Superior hay cÃ²n gá»i lÃ  phÃ²ng SUP lÃ  loáº¡i phÃ²ng khÃ¡ch sáº¡n cÃ³ phong cÃ¡ch thiáº¿t káº¿ Ä‘Æ¡n giáº£n. So vá»›i phÃ²ng Standard thÃ¬ Superior cÃ³ diá»‡n tÃ­ch lá»›n hÆ¡n tá»« 20m2 trá»Ÿ lÃªn vÃ  thÆ°á»ng cÃ³ view Ä‘áº¹p cÃ³ ban cÃ´ng, cá»­a sá»• cÃ¹ng nhiá»u thiáº¿t bá»‹ hiá»‡n Ä‘áº¡i. VÃ¬ váº­y giÃ¡ thuÃª phÃ²ng SUP luÃ´n cao hÆ¡n phÃ²ng Standard.  PhÃ²ng SUP phÃ¹ há»£p vá»›i nhá»¯ng khÃ¡ch hÃ ng cÃ³ nhu cáº§u Ä‘i du lá»‹ch, cÃ´ng tÃ¡c lÆ°u trÃº ngáº¯n ngÃ y. Loáº¡i phÃ²ng nÃ y hiá»‡n nÃ y ráº¥t phá»• biáº¿n táº¡i cÃ¡c khÃ¡ch sáº¡n vÃ  tÃ¹y thuá»™c vÃ o háº¡ng sao cá»§a khÃ¡ch sáº¡n mÃ  tiÃªu chuáº©n thiáº¿t káº¿ sáº½ cÃ³ sá»± khÃ¡c nhau.',2000000,_binary ''),(4,'Standard','standard.jpg','PhÃ²ng Standard phá»• biáº¿n nháº¥t á»Ÿ cÃ¡c khÃ¡ch sáº¡n nhá», bÃ¬nh dÃ¢n. CÃ²n Ä‘á»‘i vá»›i cÃ¡c khÃ¡ch sáº¡n cao cáº¥p chá»‰ phá»¥c vá»¥ sá»‘ lÆ°á»£ng nhá» Ä‘á»ƒ Ä‘á»§ háº¡ng phÃ²ng khÃ¡ch sáº¡n chá»© sá»‘ lÆ°á»£ng phÃ²ng khÃ´ng quÃ¡ lá»›n.  GiÃ¡ thuÃª phÃ²ng khÃ¡ch sáº¡n Standard thÆ°á»ng á»•n, phÃ¹ há»£p nhiá»u Ä‘á»‘i tÆ°á»£ng khÃ¡ch hÃ ng khÃ¡c nhau. Chi phÃ­ Ä‘áº§u tÆ° thiáº¿t káº¿ thi cÃ´ng trang trÃ­ ná»™i tháº¥t loáº¡i phÃ²ng khÃ¡ch sáº¡n Standard cÅ©ng ráº» hÆ¡n nhiá»u so vá»›i viá»‡c Ä‘áº§u tÆ° cÃ¡c háº¡ng phÃ²ng khÃ¡ch sáº¡n khÃ¡c.',1200000,_binary '');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (4,'Taxi','taxi.jpg',50000,'ThuÃª taxi',_binary ''),(5,'Giáº·t lÃ ','laundry.png',300000,'giáº·t khÃ´ lÃ  hÆ¡i',_binary ''),(6,'Spa','spa.png',450000,'',_binary ''),(8,'Há»“ bÆ¡i','pool.jpg',100000,'',_binary ''),(11,'SÃ¢n tenis','tennis.jpg',700000,'',_binary '\0'),(12,'PhÃ²ng xÃ´ng hÆ¡i','sauna.jpg',200000,'',_binary ''),(13,'Ä‚n sÃ¡ng','breakfast.jpg',150000,'',_binary ''),(14,'Ä‚n tá»‘i','dinner.jpg',250000,'Phá»¥c vá»¥ bá»¯a tá»‘i',_binary ''),(15,'PhÃ²ng thá»ƒ hÃ¬nh','gym.jpg',250000,'',_binary '');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (5,'Nguyá»…n HoÃ ng DÆ°Æ¡ng','Admin','HÃ  Ná»™i','0123456789','admin@gmail.com','123456'),(7,'Nguyá»…n Thá»‹ ThÃ¹y Dung','Lá»… tÃ¢n','TP. HCM','0123456000','Rio_de_Janeiro@gmail.com','123456'),(8,'LÃª Trung Hiáº¿u','Admin','HÃ  Ná»™i','0345708107','letrunghieuconj@gmail.com','123456'),(10,'Not Adam Smith','Báº£o vá»‡','','0135477800','','123789asd'),(11,'XuÃ¢n Mai','Äáº§u báº¿p','','0123456704','springmike@gmail.com','123456'),(12,'Trá»‹nh Anh VÆ°á»£ng','Táº¡p vá»¥','Háº¡ Long, Quáº£ng Ninh','0124545787','','vua123'),(13,'Äinh VÄƒn Doanh','Ban Ä‘iá»u hÃ nh','','0456897210','dvd@gmail.com','dvd123'),(14,'Kim Chi','Lá»… tÃ¢n','','0155777666','','4567890');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'LÃª Trung HiÃªu','Hai BÃ  TrÆ°ng, HÃ  Ná»™i','0345708107','lthieu@gmail.com','123456'),(3,'Anh Vinh','TP. HCM','0123455421','johnny123@gmail.com','dffjikokj'),(4,'VÄƒn BÃ¬nh','HÃ  Ná»™i','0123456789','Rio_de_Janeiro@gmail.com','123456'),(6,'Nguyá»…n Thá»‹ Nhung','HÃ  Ná»™i','0345154875','ntnhung@gmail.com','123'),(7,'Trá»‹nh Gia HÆ°ng','Thá»«a ThiÃªn - Huáº¿','0123789400','hungk66@gmail.com','hung123'),(8,'Cristian Nolan','','0789542132','lolan@gmail.com','nolan123'),(9,'Nguyá»…n Thá»‹ ThÃ¹y Trang','','0456178985','trangpage@gmail.com','123456'),(10,'LÃª Gia HÃ¢n','','0128456722','hann@gmail.com','123456'),(11,'Äinh Trung DÅ©ng','Há»™i An','0123456780','dtt@gmail.com','123456'),(12,'Mister Bean','USUK','0123456048','bean123@gmail.com','mrbean123');
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

-- Dump completed on 2023-12-19 20:03:56
