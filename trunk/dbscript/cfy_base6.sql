CREATE DATABASE  IF NOT EXISTS `cfy_base` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cfy_base`;
-- MySQL dump 10.13  Distrib 5.1.40, for Win32 (ia32)
--
-- Host: localhost    Database: cfy_base
-- ------------------------------------------------------
-- Server version	5.1.41

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
-- Table structure for table `core_user`
--

DROP TABLE IF EXISTS `core_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user`
--

LOCK TABLES `core_user` WRITE;
/*!40000 ALTER TABLE `core_user` DISABLE KEYS */;
INSERT INTO `core_user` VALUES ('admin','juan316',0,'2010-10-05 01:01:01',0,'2011-02-01 14:36:35'),('general','12345',0,'2010-10-05 04:48:00',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `core_user` ENABLE KEYS */;
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
-- Table structure for table `core_chat`
--

DROP TABLE IF EXISTS `core_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recd` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_chat`
--

LOCK TABLES `core_chat` WRITE;
/*!40000 ALTER TABLE `core_chat` DISABLE KEYS */;
INSERT INTO `core_chat` VALUES (1,'admin','general','jshdfjsd hfsdj','2011-01-31 20:30:58',0),(2,'general','admin','jdhsdfjsdj','2011-02-01 19:38:39',0),(3,'rer','ere','erer','2011-02-01 19:51:19',0),(4,'admin','general','dksdkfk','2011-02-01 19:59:07',0),(5,'effef','efef','efefe','2011-02-01 20:02:24',0);
/*!40000 ALTER TABLE `core_chat` ENABLE KEYS */;
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
-- Table structure for table `core_module_var`
--

DROP TABLE IF EXISTS `core_module_var`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_module_var` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `print_name` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`name`),
  KEY `print_name` (`print_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_module_var`
--

LOCK TABLES `core_module_var` WRITE;
/*!40000 ALTER TABLE `core_module_var` DISABLE KEYS */;
INSERT INTO `core_module_var` VALUES (2,'payroll','Nomina',0),(1,'home','Inicio',0),(3,'admin','Administracion',0),(5,'budget','Presupuesto',0),(4,'booking','Reservaciones',0);
/*!40000 ALTER TABLE `core_module_var` ENABLE KEYS */;
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

-- Dump completed on 2011-02-01 15:51:11
