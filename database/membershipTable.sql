-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: datingDB
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memberships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` double(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `memberships_id_unique` (`id`),
  UNIQUE KEY `memberships_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES (1,'Gratis profil','free','free',0.00,'Gratis','10 years',NULL,NULL),(2,'Dag (24 timer)','day','24hr',20.00,'Engangsbeløb','24 hour',NULL,'2019-05-01 01:34:12'),(3,' Weekend (Fre-Søn)','weekend','weekends',39.00,'Engangsbeløb','3 day',NULL,'2019-05-02 01:34:12'),(4,'Uge','ugo','weekly',49.00,'Løbende abonnement','1 week',NULL,'2019-05-03 01:34:12'),(5,'Uge (2 uge)','2week','2week',1.00,'Løbende abonnement','2 week',NULL,'2019-05-04 01:34:12'),(6,'Måned','md','monthly',129.00,'Løbende abonnement','1 month',NULL,'2019-05-05 01:34:12'),(7,'Kvartal (3 måneder)','kvartal','3month',349.00,'Løbende abonnement','3 month',NULL,'2019-05-11 01:34:12'),(8,'½ årligt','arllg','6month',599.00,'Løbende abonnement','6 month',NULL,'2019-05-12 01:34:12'),(9,'1 år','ar','1year',999.00,'Løbende abonnement','1 years',NULL,'2019-05-13 01:34:12'),(10,'Fremhævning (1 time)','profilepromotion','promotion1hr',20.00,'Promotion plan','1 hours',NULL,'2019-06-01 01:34:12'),(11,'Fremhævning (24 timer)','profilepromotion24hr','promotion24hr',100.00,'Promotion plan','24 hours',NULL,'2019-06-02 01:34:12'),(12,'Opslag på væggen','status','status24hr',10.00,'Engangsbetaling','24 hours',NULL,'2019-06-03 01:34:12'),(13,'Topplacering i indbakken','chat','chatintop',5.00,'Chat promotion plan','1 week',NULL,'2019-06-04 01:34:12'),(14,'Måned','md2nd','monthly2nd',109.00,'Løbende abonnement','1 month',NULL,'2019-05-06 01:34:12'),(15,'Måned','md3rd','monthly3rd',89.00,'Løbende abonnement','1 month',NULL,'2019-05-07 01:34:12');
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-20 11:26:14
