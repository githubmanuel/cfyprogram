-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: lab.pajarraco.com    Database: cfy_base
-- ------------------------------------------------------
-- Server version	5.1.57

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
-- Current Database: `cfy_base`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cfy_base` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cfy_base`;

--
-- Table structure for table `ad_expenses`
--

DROP TABLE IF EXISTS `ad_expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_expenses` (
  `id_expenses` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `type` varchar(5) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_expenses`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_expenses`
--

LOCK TABLES `ad_expenses` WRITE;
/*!40000 ALTER TABLE `ad_expenses` DISABLE KEYS */;
INSERT INTO `ad_expenses` VALUES (1,'13701','hghfgh','gfhfghfghfg','1',5464,'2011-11-04 14:49:57');
/*!40000 ALTER TABLE `ad_expenses` ENABLE KEYS */;
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
INSERT INTO `bk_destination` VALUES (0,'Caracas');
/*!40000 ALTER TABLE `bk_destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bu_profit`
--

DROP TABLE IF EXISTS `bu_profit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bu_profit` (
  `id_profit` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `amount` decimal(2,0) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_profit`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bu_profit`
--

LOCK TABLES `bu_profit` WRITE;
/*!40000 ALTER TABLE `bu_profit` DISABLE KEYS */;
INSERT INTO `bu_profit` VALUES (1,'Porcentaje de Ganancia Accesorios','Porcentaje',25,'2011-11-05 18:09:14'),(2,'Porcentaje de Ganancia Contruccion Cocinas','Porcentaje',30,'2011-11-05 18:09:42');
/*!40000 ALTER TABLE `bu_profit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_expenses`
--

DROP TABLE IF EXISTS `co_expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `co_expenses` (
  `id_expenses` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `type` varchar(5) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_expenses`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_expenses`
--

LOCK TABLES `co_expenses` WRITE;
/*!40000 ALTER TABLE `co_expenses` DISABLE KEYS */;
INSERT INTO `co_expenses` VALUES (1,'1','Luz','Electricidad de Caracas','M',125,'2011-08-29 16:48:15');
/*!40000 ALTER TABLE `co_expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_owners`
--

DROP TABLE IF EXISTS `co_owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `co_owners` (
  `id_owners` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_owners`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_owners`
--

LOCK TABLES `co_owners` WRITE;
/*!40000 ALTER TABLE `co_owners` DISABLE KEYS */;
INSERT INTO `co_owners` VALUES (3,'11663916','Ernesto','La Fontaine','Guarenas','2011-08-29 16:46:56'),(4,'13992530','Alejandra','Del Campo','Guarenas','2011-08-31 19:28:48');
/*!40000 ALTER TABLE `co_owners` ENABLE KEYS */;
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
INSERT INTO `core_module_var` VALUES (4,'payroll','Nomina',0),(99,'home','ConfiguraciÃ³n',0),(3,'admin','AdministraciÃ³n',0),(5,'budget','Presupuesto',0),(7,'booking','Reservaciones',1),(6,'condo','Condominio',1),(2,'cost','Costos',0);
/*!40000 ALTER TABLE `core_module_var` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user`
--

DROP TABLE IF EXISTS `core_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `level` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` date NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user`
--

LOCK TABLES `core_user` WRITE;
/*!40000 ALTER TABLE `core_user` DISABLE KEYS */;
INSERT INTO `core_user` VALUES ('admin','juan316','Administrador','General',0,0,'2011-04-13 14:45:49','2011-01-01'),('general','12345','Usuario','',0,0,'2011-04-13 19:44:42','0000-00-00');
/*!40000 ALTER TABLE `core_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pa_assignment`
--

DROP TABLE IF EXISTS `pa_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pa_assignment` (
  `id_assignment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `amount` decimal(2,0) NOT NULL,
  `period` varchar(10) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_assignment`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pa_assignment`
--

LOCK TABLES `pa_assignment` WRITE;
/*!40000 ALTER TABLE `pa_assignment` DISABLE KEYS */;
INSERT INTO `pa_assignment` VALUES (1,'Vacacaiones','Dias',30,'Anual','2011-08-31 20:34:36'),(2,'LPH','Dias',1,'Mensual','2011-11-04 13:22:34'),(3,'Utilidades','Dias',60,'Anual','2011-11-04 13:23:06'),(4,'Comisiones','Porcentaje',3,'Mensual','2011-11-04 13:41:24');
/*!40000 ALTER TABLE `pa_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pa_employee`
--

DROP TABLE IF EXISTS `pa_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pa_employee` (
  `id_employee` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `started_date` date DEFAULT NULL,
  `income` decimal(10,0) DEFAULT NULL,
  `period` varchar(50) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_employee`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pa_employee`
--

LOCK TABLES `pa_employee` WRITE;
/*!40000 ALTER TABLE `pa_employee` DISABLE KEYS */;
INSERT INTO `pa_employee` VALUES (1,'Ernesto La Fontaine','Presidente','2011-01-01',5500,'Mensual','2011-08-31 17:49:33'),(2,'Alejandra','Vise-Presidente','2011-02-23',4350,'Quincenal','2011-08-31 17:50:08'),(4,'Jose Peres','Asistente','2011-01-01',1500,'Mensual','2011-11-04 13:24:09');
/*!40000 ALTER TABLE `pa_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pa_payroll`
--

DROP TABLE IF EXISTS `pa_payroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pa_payroll` (
  `id_payroll` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` int(11) NOT NULL,
  `id_assignment` int(11) NOT NULL,
  PRIMARY KEY (`id_payroll`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pa_payroll`
--

LOCK TABLES `pa_payroll` WRITE;
/*!40000 ALTER TABLE `pa_payroll` DISABLE KEYS */;
INSERT INTO `pa_payroll` VALUES (1,1,1),(2,2,1),(6,4,2),(5,2,2),(7,4,1),(8,4,3),(9,1,4);
/*!40000 ALTER TABLE `pa_payroll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_pa_payroll`
--

DROP TABLE IF EXISTS `view_pa_payroll`;
/*!50001 DROP VIEW IF EXISTS `view_pa_payroll`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_pa_payroll` (
  `id_payroll` int(11),
  `employee` varchar(200),
  `position` varchar(100),
  `income` decimal(10,0),
  `period` varchar(50),
  `assignment` varchar(100),
  `assignment_amount` decimal(2,0),
  `assignment_period` varchar(10),
  `assignment_type` varchar(10)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Current Database: `cfy_base`
--

USE `cfy_base`;

--
-- Final view structure for view `view_pa_payroll`
--

/*!50001 DROP TABLE IF EXISTS `view_pa_payroll`*/;
/*!50001 DROP VIEW IF EXISTS `view_pa_payroll`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cfyadmin`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_pa_payroll` AS select `pa_payroll`.`id_payroll` AS `id_payroll`,`pa_employee`.`name` AS `employee`,`pa_employee`.`position` AS `position`,`pa_employee`.`income` AS `income`,`pa_employee`.`period` AS `period`,`pa_assignment`.`name` AS `assignment`,`pa_assignment`.`amount` AS `assignment_amount`,`pa_assignment`.`period` AS `assignment_period`,`pa_assignment`.`type` AS `assignment_type` from ((`pa_payroll` join `pa_employee`) join `pa_assignment`) where ((`pa_payroll`.`id_employee` = `pa_employee`.`id_employee`) and (`pa_payroll`.`id_assignment` = `pa_assignment`.`id_assignment`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-11-05 14:08:44
