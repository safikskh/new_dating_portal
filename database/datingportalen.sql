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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_id_unique` (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin User','admin@admin.com','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL),(2,'Support','support@datingportalen.com','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `portal_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'First announcement','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',1,'2019-04-29 05:08:36','2019-04-29 05:08:36');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `block_by` int(10) unsigned NOT NULL,
  `block_to` int(10) unsigned NOT NULL,
  `portal_id` int(10) unsigned NOT NULL,
  `block_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blocks_id_unique` (`id`),
  KEY `blocks_block_by_index` (`block_by`),
  KEY `blocks_block_to_index` (`block_to`),
  KEY `blocks_portal_id_index` (`portal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `blog_id` int(10) unsigned NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_comments_user_id_index` (`user_id`),
  KEY `blog_comments_blog_id_index` (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comments`
--

LOCK TABLES `blog_comments` WRITE;
/*!40000 ALTER TABLE `blog_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_id_unique` (`id`),
  KEY `blogs_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_room_details`
--

DROP TABLE IF EXISTS `chat_room_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_room_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chatroom_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chatroom_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portal_id` int(10) unsigned DEFAULT NULL,
  `membership_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chat_room_details_id_unique` (`id`),
  KEY `chat_room_details_membership_id_index` (`membership_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_room_details`
--

LOCK TABLES `chat_room_details` WRITE;
/*!40000 ALTER TABLE `chat_room_details` DISABLE KEYS */;
INSERT INTO `chat_room_details` VALUES (2,'København','uploads/chatRoomCoverImages/5c5e8413e9f38logo.png',1,2,'2019-01-28 03:28:01','2019-02-09 01:41:07'),(3,'København','uploads/chatRoomCoverImages/5c5e841f9fc14logo.png',5,2,'2019-01-28 03:28:18','2019-05-10 01:29:35'),(4,'Fyn','uploads/chatRoomCoverImages/5c5e8436444bflogo.png',1,2,'2019-01-28 03:28:33','2019-02-09 01:41:42'),(5,'Storkøbenhavn','uploads/chatRoomCoverImages/5c5e843fe02c6logo.png',1,2,'2019-01-28 03:28:56','2019-02-09 01:41:51'),(8,'Nordsjælland','uploads/chatRoomCoverImages/5c8a5337986625c5e8413e9f38logo.png',1,2,'2019-02-19 03:43:36','2019-03-14 13:12:23'),(9,'Testingroom','uploads/chatRoomCoverImages/5c9b719dcd5701500x500.jpg',4,2,'2019-03-27 12:50:37','2019-03-27 12:50:57'),(10,'FreakChat','uploads/chatRoomCoverImages/5cd3af074143dranveerKapur.jpg',3,2,'2019-05-09 00:39:35','2019-05-09 00:39:35');
/*!40000 ALTER TABLE `chat_room_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_room_join_users`
--

DROP TABLE IF EXISTS `chat_room_join_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_room_join_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `chatRoomDetail_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chat_room_join_users_id_unique` (`id`),
  KEY `chat_room_join_users_user_id_index` (`user_id`),
  KEY `chat_room_join_users_chatroomdetail_id_index` (`chatRoomDetail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_room_join_users`
--

LOCK TABLES `chat_room_join_users` WRITE;
/*!40000 ALTER TABLE `chat_room_join_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_room_join_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_rooms`
--

DROP TABLE IF EXISTS `chat_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(10) unsigned NOT NULL,
  `chatRoomDetail_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chat_rooms_id_unique` (`id`),
  KEY `chat_rooms_chatroomdetail_id_index` (`chatRoomDetail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_rooms`
--

LOCK TABLES `chat_rooms` WRITE;
/*!40000 ALTER TABLE `chat_rooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couple_infos`
--

DROP TABLE IF EXISTS `couple_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couple_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `portalJoinUser_id` int(10) unsigned NOT NULL,
  `sex` enum('Mand','Kvinde') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `sexualOrientation` enum('Heteroseksuel','Biseksuel','Homoseksuel','Transvestit','Transseksuel') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civilStatus` enum('Single','I et forhold','Ikke oplyst','Gift','Separeret','Skilt','Åbent forhold') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` enum('110 cm','111 cm','112 cm','113 cm','114 cm','115 cm','116 cm','117 cm','118 cm','119 cm','120 cm','121 cm','122 cm','123 cm','124 cm','125 cm','126 cm','127 cm','128 cm','129 cm','130 cm','131 cm','132 cm','133 cm','134 cm','135 cm','136 cm','137 cm','138 cm','139 cm','140 cm','141 cm','142 cm','143 cm','144 cm','145 cm','146 cm','147 cm','148 cm','149 cm','150 cm','151 cm','152 cm','153 cm','154 cm','155 cm','156 cm','157 cm','158 cm','159 cm','160 cm','161 cm','162 cm','163 cm','164 cm','165 cm','166 cm','167 cm','168 cm','169 cm','170 cm','171 cm','172 cm','173 cm','174 cm','175 cm','176 cm','177 cm','178 cm','179 cm','180 cm','181 cm','182 cm','183 cm','184 cm','185 cm','186 cm','187 cm','188 cm','189 cm','190 cm','191 cm','192 cm','193 cm','194 cm','195 cm','196 cm','197 cm','198 cm','199 cm','200 cm','201 cm','202 cm','203 cm','204 cm','205 cm','206 cm','207 cm','208 cm','209 cm','210 cm','211 cm','212 cm','213 cm','214 cm','215 cm','216 cm','217 cm','218 cm','219 cm','220 cm','221 cm','222 cm','223 cm','224 cm','225 cm','226 cm','227 cm','228 cm','229 cm','230 cm','231 cm','232 cm') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` enum('40 kg','41 kg','42 kg','43 kg','44 kg','45 kg','46 kg','47 kg','48 kg','49 kg','50 kg','51 kg','52 kg','53 kg','54 kg','55 kg','56 kg','57 kg','58 kg','59 kg','60 kg','61 kg','62 kg','63 kg','64 kg','65 kg','66 kg','67 kg','68 kg','69 kg','70 kg','71 kg','72 kg','73 kg','74 kg','75 kg','76 kg','77 kg','78 kg','79 kg','80 kg','81 kg','82 kg','83 kg','84 kg','85 kg','86 kg','87 kg','88 kg','89 kg','90 kg','91 kg','92 kg','93 kg','94 kg','95 kg','96 kg','97 kg','98 kg','99 kg','100 kg','101 kg','102 kg','103 kg','104 kg','105 kg','106 kg','107 kg','108 kg','109 kg','110 kg','111 kg','112 kg','113 kg','114 kg','115 kg','116 kg','117 kg','118 kg','119 kg','120 kg','121 kg','122 kg','123 kg','124 kg','125 kg','126 kg','127 kg','128 kg','129 kg','130 kg','131 kg','132 kg','133 kg','134 kg','135 kg','136 kg','137 kg','138 kg','139 kg','140 kg','141 kg','142 kg','143 kg','144 kg','145 kg','146 kg','147 kg','148 kg','149 kg','150 kg','151 kg','152 kg','153 kg','154 kg','155 kg','156 kg','157 kg','158 kg','159 kg','160 kg','161 kg','162 kg','163 kg','164 kg','165 kg','166 kg','167 kg','168 kg','169 kg','170 kg','171 kg','172 kg','173 kg','174 kg','175 kg','176 kg','177 kg','178 kg','179 kg','180 kg','181 kg','182 kg','183 kg','184 kg','185 kg','186 kg','187 kg','188 kg','189 kg','190 kg','191 kg','192 kg','193 kg','194 kg','195 kg','196 kg','197 kg','198 kg','199 kg','200 kg','201 kg','202 kg','203 kg','204 kg','205 kg','206 kg','207 kg','208 kg','209 kg','210 kg','211 kg','212 kg','213 kg','214 kg','215 kg','216 kg','217 kg','218 kg','219 kg','220 kg','221 kg','222 kg','223 kg','224 kg','225 kg','226 kg','227 kg','228 kg','229 kg','230 kg','231 kg','232 kg','233 kg','234 kg','235 kg','236 kg','237 kg','238 kg','239 kg','240 kg','241 kg','242 kg','243 kg','244 kg','245 kg','246 kg','247 kg','248 kg','249 kg','250 kg','251 kg','252 kg','253 kg','254 kg','255 kg','256 kg','257 kg','258 kg','259 kg','260 kg','261 kg','262 kg','263 kg','264 kg','265 kg','266 kg','267 kg','268 kg','269 kg','270 kg','271 kg','272 kg','273 kg','274 kg','275 kg','276 kg','277 kg','278 kg','279 kg','280 kg','281 kg','282 kg','283 kg','284 kg','285 kg','286 kg','287 kg','288 kg','289 kg','290 kg','291 kg','292 kg','293 kg','294 kg','295 kg','296 kg','297 kg','298 kg','299 kg','300 kg') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hairColor` enum('Vælg hårfarve','Brunt','Lysebrunt','Mørkeblondt','Hvidt/gråt','Sølv','Rødt','Blond','Sort','Skaldet','Gråt','Andet','Lyst') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eyeColor` enum('Brune','Blå','Grå-grønne','Grå-blå','Grå','Grønne','Nøddebrune','Sorte','Andet') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `searching` text COLLATE utf8mb4_unicode_ci,
  `bodyType` enum('Almindelig','Atletisk','Spinkel','Kraftig','Muskuløs','Buttet') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tattoos` enum('Ja','Nej') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `piercing` enum('Ja','Nej') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `children` enum('Ja','Nej','Ikke oplyst','Hjemmeboende','Ja, udeboende') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking` enum('Ja','Nej','Festryger') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profilePicture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/profilePictures/defaultPicture.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `couple_infos_id_unique` (`id`),
  KEY `couple_infos_portaljoinuser_id_index` (`portalJoinUser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couple_infos`
--

LOCK TABLES `couple_infos` WRITE;
/*!40000 ALTER TABLE `couple_infos` DISABLE KEYS */;
/*!40000 ALTER TABLE `couple_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_click_counts`
--

DROP TABLE IF EXISTS `event_click_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_click_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_click_counts_id_unique` (`id`),
  KEY `event_click_counts_event_id_index` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_click_counts`
--

LOCK TABLES `event_click_counts` WRITE;
/*!40000 ALTER TABLE `event_click_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_click_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_join_users`
--

DROP TABLE IF EXISTS `event_join_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_join_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_join_users_id_unique` (`id`),
  KEY `event_join_users_user_id_index` (`user_id`),
  KEY `event_join_users_event_id_index` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_join_users`
--

LOCK TABLES `event_join_users` WRITE;
/*!40000 ALTER TABLE `event_join_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_join_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_post_comments`
--

DROP TABLE IF EXISTS `event_post_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_post_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `event_post_id` int(10) unsigned NOT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_post_comments_id_unique` (`id`),
  KEY `event_post_comments_user_id_index` (`user_id`),
  KEY `event_post_comments_event_post_id_index` (`event_post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_post_comments`
--

LOCK TABLES `event_post_comments` WRITE;
/*!40000 ALTER TABLE `event_post_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_posts`
--

DROP TABLE IF EXISTS `event_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_posts_id_unique` (`id`),
  KEY `event_posts_user_id_index` (`user_id`),
  KEY `event_posts_event_id_index` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_posts`
--

LOCK TABLES `event_posts` WRITE;
/*!40000 ALTER TABLE `event_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `event_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membership_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_id_unique` (`id`),
  KEY `events_user_id_index` (`user_id`),
  KEY `events_membership_id_index` (`membership_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favourites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `favourite_by` int(10) unsigned NOT NULL,
  `favourite_to` int(10) unsigned NOT NULL,
  `portal_id` int(10) unsigned NOT NULL,
  `favourite_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favourites_id_unique` (`id`),
  KEY `favourites_favourite_by_index` (`favourite_by`),
  KEY `favourites_favourite_to_index` (`favourite_to`),
  KEY `favourites_portal_id_index` (`portal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourites`
--

LOCK TABLES `favourites` WRITE;
/*!40000 ALTER TABLE `favourites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favourites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_uploads`
--

DROP TABLE IF EXISTS `file_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_uploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_uploads_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_uploads`
--

LOCK TABLES `file_uploads` WRITE;
/*!40000 ALTER TABLE `file_uploads` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_join_users`
--

DROP TABLE IF EXISTS `group_join_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_join_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_join_users_id_unique` (`id`),
  KEY `group_join_users_user_id_index` (`user_id`),
  KEY `group_join_users_group_id_index` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_join_users`
--

LOCK TABLES `group_join_users` WRITE;
/*!40000 ALTER TABLE `group_join_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_join_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_type` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membership_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_id_unique` (`id`),
  KEY `groups_user_id_index` (`user_id`),
  KEY `groups_membership_id_index` (`membership_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES (1,'Gratis profil','free','free',0.00,'Gratis','10 years',NULL,NULL),(2,'Dag (24 timer)','day','24hr',20.00,'Engangsbeløb','24 hour',NULL,NULL),(3,' Weekend (Fre-Søn)','weekend','weekends',39.00,'Engangsbeløb','3 day',NULL,NULL),(4,'Uge','ugo','weekly',49.00,'Løbende abonnement','1 week',NULL,NULL),(5,'Uge (2 uge)','2week','2week',1.00,'Løbende abonnement','2 week',NULL,NULL),(6,'Måned','md','monthly',129.00,'Løbende abonnement','1 month',NULL,NULL),(7,'Kvartal (3 måneder)','kvartal','3month',349.00,'Løbende abonnement','3 month',NULL,NULL),(8,'½ årligt','arllg','6month',599.00,'Løbende abonnement','6 month',NULL,NULL),(9,'1 år','ar','1year',999.00,'Løbende abonnement','1 years',NULL,NULL),(10,'Fremhævning (1 time)','profilepromotion','promotion1hr',20.00,'Promotion plan','1 hours',NULL,NULL),(11,'Fremhævning (24 timer)','profilepromotion24hr','promotion24hr',100.00,'Promotion plan','24 hours',NULL,NULL),(12,'Opslag på væggen','status','status24hr',10.00,'Engangsbetaling','24 hours',NULL,NULL),(13,'Topplacering i indbakken','chat','chatintop',5.00,'Chat promotion plan','1 week',NULL,NULL);
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_12_11_202043_create_blogs_table',1),(4,'2018_12_11_202059_create_events_table',1),(5,'2018_12_11_202117_create_event_join_users_table',1),(6,'2018_12_11_202131_create_categories_table',1),(7,'2018_12_11_202213_create_groups_table',1),(8,'2018_12_20_193410_create_memberships_table',1),(9,'2018_12_24_150748_create_group_join_users_table',1),(10,'2018_12_25_073039_create_user_post_on_groups_table',1),(11,'2018_12_25_073757_create_user_likes_on_group_posts_table',1),(12,'2018_12_25_073816_create_user_comments_on_group_posts_table',1),(14,'2018_12_27_200442_create_regions_table',1),(16,'2018_12_29_165218_create_user_chats_table',1),(17,'2019_01_02_192558_create_subscriptions_table',1),(18,'2019_01_02_192630_add_substion_info_to_user_table',1),(20,'2019_01_03_191359_create_portals_table',1),(23,'2019_01_04_185243_create_admins_table',1),(24,'2019_01_05_170049_create_event_click_counts_table',1),(25,'2019_01_07_110513_create_file_uploads_table',1),(26,'2019_01_08_100400_create_chat_rooms_table',1),(27,'2019_01_08_112310_create_chat_room_details_table',1),(28,'2019_01_09_070156_create_chat_room_join_users_table',1),(29,'2019_01_10_212828_create_promo_codes_table',1),(30,'2019_01_26_153705_create_user_promotations_table',1),(31,'2019_02_09_004342_create_ratings_table',1),(32,'2019_02_19_194933_create_notifications_table',1),(33,'2019_03_05_041552_drop_user_table',1),(34,'2018_12_26_202545_create_statuses_table',2),(35,'2018_12_29_143854_create_visited_profiles_table',3),(36,'2019_01_03_182351_create_favourites_table',3),(37,'2019_03_18_231238_create_blog_comments_table',4),(38,'2019_03_22_151116_create_announcements_table',5),(39,'2019_03_29_152003_create_user_reports_table',6),(41,'2019_04_09_005855_create_event_posts_table',8),(42,'2019_04_09_010011_create_event_post_comments_table',8),(43,'2019_01_03_230525_create_blocks_table',9),(44,'2014_10_12_000000_create_users_table',10),(45,'2019_01_03_192018_create_portal_join_users_table',11),(46,'2019_05_01_131206_create_couple_infos_table',12),(47,'2019_05_06_164214_create_jobs_table',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `portal_join_users`
--

DROP TABLE IF EXISTS `portal_join_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portal_join_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `portal_id` int(10) unsigned NOT NULL,
  `membership_id` int(10) unsigned NOT NULL,
  `membership_ends_at` timestamp NULL DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `sexualOrientation` enum('Heteroseksuel','Biseksuel','Homoseksuel','Transvestit','Transseksuel') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` enum('Mand','Kvinde','Par') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civilStatus` enum('Single','I et forhold','Ikke oplyst','Gift','Separeret','Skilt','Åbent forhold') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` enum('110 cm','111 cm','112 cm','113 cm','114 cm','115 cm','116 cm','117 cm','118 cm','119 cm','120 cm','121 cm','122 cm','123 cm','124 cm','125 cm','126 cm','127 cm','128 cm','129 cm','130 cm','131 cm','132 cm','133 cm','134 cm','135 cm','136 cm','137 cm','138 cm','139 cm','140 cm','141 cm','142 cm','143 cm','144 cm','145 cm','146 cm','147 cm','148 cm','149 cm','150 cm','151 cm','152 cm','153 cm','154 cm','155 cm','156 cm','157 cm','158 cm','159 cm','160 cm','161 cm','162 cm','163 cm','164 cm','165 cm','166 cm','167 cm','168 cm','169 cm','170 cm','171 cm','172 cm','173 cm','174 cm','175 cm','176 cm','177 cm','178 cm','179 cm','180 cm','181 cm','182 cm','183 cm','184 cm','185 cm','186 cm','187 cm','188 cm','189 cm','190 cm','191 cm','192 cm','193 cm','194 cm','195 cm','196 cm','197 cm','198 cm','199 cm','200 cm','201 cm','202 cm','203 cm','204 cm','205 cm','206 cm','207 cm','208 cm','209 cm','210 cm','211 cm','212 cm','213 cm','214 cm','215 cm','216 cm','217 cm','218 cm','219 cm','220 cm','221 cm','222 cm','223 cm','224 cm','225 cm','226 cm','227 cm','228 cm','229 cm','230 cm','231 cm','232 cm') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` enum('40 kg','41 kg','42 kg','43 kg','44 kg','45 kg','46 kg','47 kg','48 kg','49 kg','50 kg','51 kg','52 kg','53 kg','54 kg','55 kg','56 kg','57 kg','58 kg','59 kg','60 kg','61 kg','62 kg','63 kg','64 kg','65 kg','66 kg','67 kg','68 kg','69 kg','70 kg','71 kg','72 kg','73 kg','74 kg','75 kg','76 kg','77 kg','78 kg','79 kg','80 kg','81 kg','82 kg','83 kg','84 kg','85 kg','86 kg','87 kg','88 kg','89 kg','90 kg','91 kg','92 kg','93 kg','94 kg','95 kg','96 kg','97 kg','98 kg','99 kg','100 kg','101 kg','102 kg','103 kg','104 kg','105 kg','106 kg','107 kg','108 kg','109 kg','110 kg','111 kg','112 kg','113 kg','114 kg','115 kg','116 kg','117 kg','118 kg','119 kg','120 kg','121 kg','122 kg','123 kg','124 kg','125 kg','126 kg','127 kg','128 kg','129 kg','130 kg','131 kg','132 kg','133 kg','134 kg','135 kg','136 kg','137 kg','138 kg','139 kg','140 kg','141 kg','142 kg','143 kg','144 kg','145 kg','146 kg','147 kg','148 kg','149 kg','150 kg','151 kg','152 kg','153 kg','154 kg','155 kg','156 kg','157 kg','158 kg','159 kg','160 kg','161 kg','162 kg','163 kg','164 kg','165 kg','166 kg','167 kg','168 kg','169 kg','170 kg','171 kg','172 kg','173 kg','174 kg','175 kg','176 kg','177 kg','178 kg','179 kg','180 kg','181 kg','182 kg','183 kg','184 kg','185 kg','186 kg','187 kg','188 kg','189 kg','190 kg','191 kg','192 kg','193 kg','194 kg','195 kg','196 kg','197 kg','198 kg','199 kg','200 kg','201 kg','202 kg','203 kg','204 kg','205 kg','206 kg','207 kg','208 kg','209 kg','210 kg','211 kg','212 kg','213 kg','214 kg','215 kg','216 kg','217 kg','218 kg','219 kg','220 kg','221 kg','222 kg','223 kg','224 kg','225 kg','226 kg','227 kg','228 kg','229 kg','230 kg','231 kg','232 kg','233 kg','234 kg','235 kg','236 kg','237 kg','238 kg','239 kg','240 kg','241 kg','242 kg','243 kg','244 kg','245 kg','246 kg','247 kg','248 kg','249 kg','250 kg','251 kg','252 kg','253 kg','254 kg','255 kg','256 kg','257 kg','258 kg','259 kg','260 kg','261 kg','262 kg','263 kg','264 kg','265 kg','266 kg','267 kg','268 kg','269 kg','270 kg','271 kg','272 kg','273 kg','274 kg','275 kg','276 kg','277 kg','278 kg','279 kg','280 kg','281 kg','282 kg','283 kg','284 kg','285 kg','286 kg','287 kg','288 kg','289 kg','290 kg','291 kg','292 kg','293 kg','294 kg','295 kg','296 kg','297 kg','298 kg','299 kg','300 kg') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hairColor` enum('Vælg hårfarve','Brunt','Lysebrunt','Mørkeblondt','Hvidt/gråt','Sølv','Rødt','Blond','Sort','Skaldet','Gråt','Andet','Lyst') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eyeColor` enum('Brune','Blå','Grå-grønne','Grå-blå','Grå','Grønne','Nøddebrune','Sorte','Andet') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `searching` text COLLATE utf8mb4_unicode_ci,
  `bodyType` enum('Almindelig','Atletisk','Spinkel','Kraftig','Muskuløs','Buttet') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tattoos` enum('Ja','Nej') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `piercing` enum('Ja','Nej') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `children` enum('Ja','Nej','Ikke oplyst','Hjemmeboende','Ja, udeboende') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking` enum('Ja','Nej','Festryger') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matchWords` text COLLATE utf8mb4_unicode_ci,
  `nMatchWords` text COLLATE utf8mb4_unicode_ci,
  `region_id` int(10) unsigned DEFAULT NULL,
  `profilePicture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/profilePictures/defaultPicture.png',
  `profile_detail` longtext COLLATE utf8mb4_unicode_ci,
  `status_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_ends_at` timestamp NULL DEFAULT NULL,
  `isvisible` tinyint(1) NOT NULL DEFAULT '1',
  `isDeactivate` tinyint(1) NOT NULL DEFAULT '0',
  `isDisablePushNotif` tinyint(1) NOT NULL DEFAULT '0',
  `isDisableEmailNotif` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portal_join_users_id_unique` (`id`),
  UNIQUE KEY `portal_join_users_username_unique` (`username`),
  KEY `portal_join_users_user_id_index` (`user_id`),
  KEY `portal_join_users_portal_id_index` (`portal_id`),
  KEY `portal_join_users_membership_id_index` (`membership_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portal_join_users`
--

LOCK TABLES `portal_join_users` WRITE;
/*!40000 ALTER TABLE `portal_join_users` DISABLE KEYS */;
INSERT INTO `portal_join_users` VALUES (1,'rakib1',1,1,9,'2020-05-09 22:52:01','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/1557457715jpeg',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-09 09:32:20','2019-05-09 23:08:35'),(2,'rakib2',2,1,1,'2029-05-09 09:32:20','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]',NULL,19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-09 09:32:20','2019-05-09 09:32:20'),(3,'user1',3,1,1,'2029-05-09 09:32:20','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]',NULL,15,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-09 09:32:20','2019-05-09 09:32:20'),(4,'user2',4,1,1,'2029-05-09 09:32:20','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]',NULL,17,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-09 09:32:20','2019-05-09 09:32:20'),(5,'user3',5,1,1,'2029-05-09 09:32:20','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]',NULL,14,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-09 09:32:20','2019-05-09 09:32:20'),(6,'user4',6,1,1,'2029-05-09 09:32:20','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]',NULL,14,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-09 09:32:20','2019-05-09 09:32:20'),(7,'user5',7,1,1,'2029-05-09 09:32:20','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]',NULL,14,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-09 09:32:20','2019-05-09 09:32:20'),(8,'user6',8,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(9,'user7',9,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(10,'user8',10,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(11,'user9',11,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(12,'user10',12,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(13,'user11',13,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(14,'user12',14,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(15,'user13',15,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(16,'user14',16,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(17,'user15',17,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(18,'user16',18,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(19,'user17',19,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(20,'user18',20,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56'),(21,'user19',21,1,1,'2029-05-10 02:01:56','Mr','S','1995-05-22','Heteroseksuel','Mand','1229','I et forhold','125 cm','56 kg','Andet','Nøddebrune','[\"Mand\",\"Kvinde\"]','Almindelig','Ja','Nej','Ja, udeboende','Nej','[\"\"]','[\"\"]',19,'uploads/profilePictures/defaultPicture.png',NULL,NULL,NULL,NULL,1,0,0,0,'2019-05-10 02:01:56','2019-05-10 02:01:56');
/*!40000 ALTER TABLE `portal_join_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portals`
--

DROP TABLE IF EXISTS `portals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `portalType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portals_id_unique` (`id`),
  UNIQUE KEY `portals_portaltype_unique` (`portalType`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portals`
--

LOCK TABLES `portals` WRITE;
/*!40000 ALTER TABLE `portals` DISABLE KEYS */;
INSERT INTO `portals` VALUES (1,'Dating','2019-01-26 05:29:21','2019-01-26 05:29:21'),(2,'Sugar dating','2019-01-26 05:29:21','2019-01-26 05:29:21'),(3,'Fræk dating','2019-01-26 05:29:21','2019-01-26 05:29:21'),(4,'Badboy dating','2019-01-26 05:29:21','2019-01-26 05:29:21'),(5,'Senior dating','2019-01-26 05:29:21','2019-01-26 05:29:21'),(6,'Regnbue dating','2019-01-26 05:29:21','2019-01-26 05:29:21');
/*!40000 ALTER TABLE `portals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `promoCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isFixed` tinyint(1) NOT NULL,
  `discount` int(10) unsigned NOT NULL,
  `edate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promo_codes_id_unique` (`id`),
  UNIQUE KEY `promo_codes_promocode_unique` (`promoCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_codes`
--

LOCK TABLES `promo_codes` WRITE;
/*!40000 ALTER TABLE `promo_codes` DISABLE KEYS */;
INSERT INTO `promo_codes` VALUES (1,'LESS50%',0,50,'2019-07-30','2019-03-07 07:40:49','2019-03-07 07:40:49'),(2,'FIXED10',1,10,'2019-07-30','2019-03-13 16:39:42','2019-03-13 16:39:42');
/*!40000 ALTER TABLE `promo_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` int(10) unsigned DEFAULT NULL,
  `to_user_id` int(10) unsigned DEFAULT NULL,
  `portal_id` int(11) NOT NULL,
  `rating_value` int(11) DEFAULT '0',
  `rating_status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ratings_id_unique` (`id`),
  KEY `ratings_from_user_id_index` (`from_user_id`),
  KEY `ratings_to_user_id_index` (`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `region_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regions_id_unique` (`id`),
  UNIQUE KEY `regions_region_name_unique` (`region_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (1,'Sjælland','2019-02-19 03:36:19','2019-02-19 03:36:19'),(2,'København','2019-02-19 03:36:27','2019-02-19 03:36:27'),(3,'Storkøbenhavn','2019-02-19 03:36:35','2019-02-19 03:36:35'),(4,'Nordsjælland','2019-02-19 03:36:55','2019-02-19 03:36:55'),(8,'Vestsjælland','2019-02-19 03:37:09','2019-02-19 03:37:09'),(9,'Midtsjælland','2019-02-19 03:37:17','2019-02-19 03:37:17'),(10,'Sydsjælland','2019-02-19 03:37:32','2019-02-19 03:37:32'),(11,'Lolland/Falster/Møn','2019-02-19 03:37:55','2019-02-19 03:37:55'),(12,'Fyn','2019-02-19 03:38:11','2019-02-19 03:38:11'),(13,'Jylland','2019-02-19 03:39:54','2019-02-19 03:39:54'),(14,'Nordjylland','2019-02-19 03:40:16','2019-02-19 03:40:16'),(15,'Midtjylland','2019-02-19 03:40:23','2019-02-19 03:40:23'),(16,'Sønderjylland','2019-02-19 03:40:32','2019-02-19 03:40:32'),(17,'Sydjylland','2019-02-19 03:41:02','2019-02-19 03:41:02'),(18,'Østjylland','2019-02-19 03:41:24','2019-02-19 03:41:24'),(19,'Bornholm','2019-02-19 03:41:48','2019-02-19 03:41:48'),(20,'Færøerne','2019-02-19 03:42:00','2019-02-19 03:42:00'),(21,'Grønland','2019-02-19 03:42:07','2019-02-19 03:42:07');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `portal_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `statuses_id_unique` (`id`),
  KEY `statuses_user_id_index` (`user_id`),
  KEY `statuses_portal_id_index` (`portal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptions_id_unique` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=315 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_chats`
--

DROP TABLE IF EXISTS `user_chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_chats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isPromoted` tinyint(1) NOT NULL DEFAULT '0',
  `portal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_chats_id_unique` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_chats`
--

LOCK TABLES `user_chats` WRITE;
/*!40000 ALTER TABLE `user_chats` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_comments_on_group_posts`
--

DROP TABLE IF EXISTS `user_comments_on_group_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_comments_on_group_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_comments_on_group_posts_id_unique` (`id`),
  KEY `user_comments_on_group_posts_user_id_index` (`user_id`),
  KEY `user_comments_on_group_posts_group_id_index` (`group_id`),
  KEY `user_comments_on_group_posts_post_id_index` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_comments_on_group_posts`
--

LOCK TABLES `user_comments_on_group_posts` WRITE;
/*!40000 ALTER TABLE `user_comments_on_group_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_comments_on_group_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_likes_on_group_posts`
--

DROP TABLE IF EXISTS `user_likes_on_group_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_likes_on_group_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `is_like` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_likes_on_group_posts_id_unique` (`id`),
  KEY `user_likes_on_group_posts_user_id_index` (`user_id`),
  KEY `user_likes_on_group_posts_group_id_index` (`group_id`),
  KEY `user_likes_on_group_posts_post_id_index` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_likes_on_group_posts`
--

LOCK TABLES `user_likes_on_group_posts` WRITE;
/*!40000 ALTER TABLE `user_likes_on_group_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_likes_on_group_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_post_on_groups`
--

DROP TABLE IF EXISTS `user_post_on_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_post_on_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_post_on_groups_id_unique` (`id`),
  KEY `user_post_on_groups_user_id_index` (`user_id`),
  KEY `user_post_on_groups_group_id_index` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_post_on_groups`
--

LOCK TABLES `user_post_on_groups` WRITE;
/*!40000 ALTER TABLE `user_post_on_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_post_on_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_promotations`
--

DROP TABLE IF EXISTS `user_promotations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_promotations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `portal_type` int(10) unsigned NOT NULL,
  `promotionTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_promotations_id_unique` (`id`),
  KEY `user_promotations_user_id_index` (`user_id`),
  KEY `user_promotations_portal_type_index` (`portal_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_promotations`
--

LOCK TABLES `user_promotations` WRITE;
/*!40000 ALTER TABLE `user_promotations` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_promotations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_reports`
--

DROP TABLE IF EXISTS `user_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fron_user_id` int(10) unsigned DEFAULT NULL,
  `to_user_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_reports`
--

LOCK TABLES `user_reports` WRITE;
/*!40000 ALTER TABLE `user_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portalJoinUser_id` int(10) unsigned DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_unique` (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'rakibhasansabbir@outlook.com',1,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa','hGN5SF3gbiAJvRFir6F5Aob4YTBavZhacYO4Jy79Bpc7D2eLOzh5QQ0InOoV','cus_F2GxJldIoy8lNj','Visa','4242',NULL,'2019-05-09 09:32:20','2019-05-10 02:03:02'),(2,'rakibhasansabbir1@gmail.com',2,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(3,'itsumrat@gmail.com',3,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(4,'michaelkock@msn.com',4,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa','qnyBE7G1Pevox4sYXX2Tc4pdJNwWizhLbFLZBjN63OKT8YzDCSMbsrus8RiN',NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-10 02:00:54'),(5,'micbrozek@hotmail.com',5,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(6,'faetter12@hotmail.com',6,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(7,'ldesigndk@gmail.com',7,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(8,'sorensen02@hotmail.com',8,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(9,'luisehegermann@hotmail.com',9,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(10,'nillejulle@hotmail.com',10,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(11,'kierulff.byg@gmail.com',11,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(12,'jetcare4you@hotmail.com',12,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(13,'ingatuneew@hotmail.com',13,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(14,'theplayzone@hotmail.com',14,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(15,'stephanie.a.rosenberg@gmail.com',15,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(16,'andisa@me.com',16,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(17,'air@datingportalen.com',17,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa','e97K7yhZJJkLui6YeWA1tl0GbHD8ynnhLDAKyHFtIagnBn20aJYftutBz1LT',NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(18,'sebastian@ggme.dk',18,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa','PTSsgpg6TI8iIcCogY63qX7454cfSz4uy7SpZHprlMEM5thoj2USDuCZUk8t',NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(19,'ibensandrasvensson@gmail.com',19,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(20,'thesnoozeboy@gmail.com',20,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09'),(21,'grethedamon@me.com',21,'2019-05-09 09:33:09','$2y$10$.EUb8P3unwdUGkNP.fhHr.Q0LHTRL3TMC2oR7yLhC1ja57twNpiJa',NULL,NULL,NULL,NULL,NULL,'2019-05-09 09:32:20','2019-05-09 09:33:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visited_profiles`
--

DROP TABLE IF EXISTS `visited_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visited_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `visited_id` int(10) unsigned NOT NULL,
  `portal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `visited_profiles_id_unique` (`id`),
  KEY `visited_profiles_user_id_index` (`user_id`),
  KEY `visited_profiles_visited_id_index` (`visited_id`),
  KEY `visited_profiles_portal_id_index` (`portal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visited_profiles`
--

LOCK TABLES `visited_profiles` WRITE;
/*!40000 ALTER TABLE `visited_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `visited_profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-10 13:01:16
