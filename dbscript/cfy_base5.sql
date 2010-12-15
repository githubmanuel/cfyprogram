CREATE DATABASE  IF NOT EXISTS `cfy_base` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cfy_base`;
-- MySQL dump 10.13  Distrib 5.1.40, for Win32 (ia32)
--
-- Host: 192.168.137.50    Database: cfy_base
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.8

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
-- Table structure for table `bk_flight`
--

DROP TABLE IF EXISTS `bk_flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bk_flight` (
  `id` int(11) NOT NULL,
  `number` varchar(45) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cretion_user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bk_flight`
--

LOCK TABLES `bk_flight` WRITE;
/*!40000 ALTER TABLE `bk_flight` DISABLE KEYS */;
INSERT INTO `bk_flight` VALUES (1,'1234','2010-12-15 16:01:48','admin');
/*!40000 ALTER TABLE `bk_flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_client`
--

DROP TABLE IF EXISTS `am_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_client` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_client`
--

LOCK TABLES `am_client` WRITE;
/*!40000 ALTER TABLE `am_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bk_passenger`
--

DROP TABLE IF EXISTS `bk_passenger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bk_passenger` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `birth_date` timestamp NULL DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bk_passenger`
--

LOCK TABLES `bk_passenger` WRITE;
/*!40000 ALTER TABLE `bk_passenger` DISABLE KEYS */;
/*!40000 ALTER TABLE `bk_passenger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bk_route`
--

DROP TABLE IF EXISTS `bk_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bk_route` (
  `id` int(11) NOT NULL,
  `from` varchar(45) DEFAULT NULL,
  `to` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bk_route`
--

LOCK TABLES `bk_route` WRITE;
/*!40000 ALTER TABLE `bk_route` DISABLE KEYS */;
/*!40000 ALTER TABLE `bk_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bk_destination`
--

DROP TABLE IF EXISTS `bk_destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bk_destination` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bk_destination`
--

LOCK TABLES `bk_destination` WRITE;
/*!40000 ALTER TABLE `bk_destination` DISABLE KEYS */;
/*!40000 ALTER TABLE `bk_destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bk_book`
--

DROP TABLE IF EXISTS `bk_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bk_book` (
  `id` int(11) NOT NULL,
  `passenger` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `creration_user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bk_book`
--

LOCK TABLES `bk_book` WRITE;
/*!40000 ALTER TABLE `bk_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `bk_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bk_leg`
--

DROP TABLE IF EXISTS `bk_leg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bk_leg` (
  `id` int(11) NOT NULL,
  `from` varchar(45) DEFAULT NULL,
  `to` varchar(45) DEFAULT NULL,
  `route` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bk_leg`
--

LOCK TABLES `bk_leg` WRITE;
/*!40000 ALTER TABLE `bk_leg` DISABLE KEYS */;
/*!40000 ALTER TABLE `bk_leg` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-12-15 11:52:43
