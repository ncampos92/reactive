-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: reactive
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `appform`
--

DROP TABLE IF EXISTS `appform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_319157722B36786B` (`title`),
  KEY `IDX_31915772A76ED395` (`user_id`),
  CONSTRAINT `FK_31915772A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appform`
--

LOCK TABLES `appform` WRITE;
/*!40000 ALTER TABLE `appform` DISABLE KEYS */;
INSERT INTO `appform` VALUES (4,1,'Habilidades de Programación','Formulario para conocer las habilidades de programación.'),(5,1,'Actividades Deportivas','Reconocer las actividades deportivas realizadas por los participantes.');
/*!40000 ALTER TABLE `appform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formanswer`
--

DROP TABLE IF EXISTS `formanswer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formanswer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `appform_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D3A2027AA76ED395` (`user_id`),
  KEY `IDX_D3A2027A43C6117E` (`appform_id`),
  CONSTRAINT `FK_D3A2027A43C6117E` FOREIGN KEY (`appform_id`) REFERENCES `appform` (`id`),
  CONSTRAINT `FK_D3A2027AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formanswer`
--

LOCK TABLES `formanswer` WRITE;
/*!40000 ALTER TABLE `formanswer` DISABLE KEYS */;
INSERT INTO `formanswer` VALUES (1,1,4),(2,1,4),(3,1,4),(4,1,4),(5,1,4),(6,1,4),(7,1,4),(8,1,4),(9,1,4),(10,1,4),(11,1,5),(12,1,5),(13,1,5),(14,1,5),(15,1,5),(16,1,5),(17,1,5),(18,1,5);
/*!40000 ALTER TABLE `formanswer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appform_id` int(11) DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E43C6117E` (`appform_id`),
  CONSTRAINT `FK_B6F7494E43C6117E` FOREIGN KEY (`appform_id`) REFERENCES `appform` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (11,4,'¿Sabes programar en Java?'),(12,4,'¿Sabes programar en Python?'),(13,4,'¿Eres desarrollador web?'),(14,4,'¿Tienes conocimientos en UI/UX?'),(15,4,'¿Sabes programar en PHP?'),(16,4,'¿Tienes conocimiento en desarrollo móvil?'),(17,5,'¿Realizas deporte de manera regular?'),(18,5,'¿Participas en torneos a nivel amateur en las disciplinas que realizas?'),(19,5,'¿Has realizado o realizas deporte a nivel profesional?');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionanswer`
--

DROP TABLE IF EXISTS `questionanswer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionanswer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `form_answer_id` int(11) DEFAULT NULL,
  `value` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_answer` (`question_id`,`form_answer_id`),
  KEY `IDX_600EB7BD1E27F6BF` (`question_id`),
  KEY `IDX_600EB7BDDB33F70B` (`form_answer_id`),
  CONSTRAINT `FK_600EB7BDDB33F70B` FOREIGN KEY (`form_answer_id`) REFERENCES `formanswer` (`id`),
  CONSTRAINT `FK_600EB7BD1E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionanswer`
--

LOCK TABLES `questionanswer` WRITE;
/*!40000 ALTER TABLE `questionanswer` DISABLE KEYS */;
INSERT INTO `questionanswer` VALUES (1,11,1,'cu'),(2,12,1,'nc'),(3,13,1,'nc'),(4,14,1,'na'),(5,15,1,'cu'),(6,16,1,'nc'),(7,11,2,'nc'),(8,12,2,'cu'),(9,13,2,'cu'),(10,14,2,'nc'),(11,15,2,'cu'),(12,16,2,'nc'),(13,11,3,'nc'),(14,12,3,'cu'),(15,13,3,'na'),(16,14,3,'nc'),(17,15,3,'nc'),(18,16,3,'na'),(19,11,4,'cu'),(20,12,4,'cu'),(21,13,4,'na'),(22,14,4,'nc'),(23,15,4,'na'),(24,16,4,'nc'),(25,11,5,'cu'),(26,12,5,'cu'),(27,13,5,'nc'),(28,14,5,'nc'),(29,15,5,'na'),(30,16,5,'nc'),(31,11,6,'na'),(32,12,6,'nc'),(33,13,6,'na'),(34,14,6,'cu'),(35,15,6,'nc'),(36,16,6,'cu'),(37,11,7,'nc'),(38,12,7,'nc'),(39,13,7,'nc'),(40,14,7,'cu'),(41,15,7,'nc'),(42,16,7,'na'),(43,11,8,'na'),(44,12,8,'nc'),(45,13,8,'na'),(46,14,8,'na'),(47,15,8,'nc'),(48,16,8,'nc'),(49,11,9,'cu'),(50,12,9,'na'),(51,13,9,'cu'),(52,14,9,'nc'),(53,15,9,'cu'),(54,16,9,'cu'),(55,11,10,'na'),(56,12,10,'cu'),(57,13,10,'cu'),(58,14,10,'cu'),(59,15,10,'cu'),(60,16,10,'nc'),(61,17,11,'cu'),(62,18,11,'nc'),(63,19,11,'na'),(64,17,12,'na'),(65,18,12,'cu'),(66,19,12,'nc'),(67,17,13,'nc'),(68,18,13,'na'),(69,19,13,'cu'),(70,17,14,'cu'),(71,18,14,'cu'),(72,19,14,'cu'),(73,17,15,'nc'),(74,18,15,'cu'),(75,19,15,'nc'),(76,17,16,'cu'),(77,18,16,'nc'),(78,19,16,'nc'),(79,17,17,'nc'),(80,18,17,'cu'),(81,19,17,'cu'),(82,17,18,'nc'),(83,18,18,'cu'),(84,19,18,'na');
/*!40000 ALTER TABLE `questionanswer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'$2y$13$53IZXF6wWtGq0GsqPcmqsOjHWn3c0tqOBxfPBiZdTUtvNp7Gcu0WO','nlcampos@uc.cl');
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

-- Dump completed on 2017-03-26 20:45:59
