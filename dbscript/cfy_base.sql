-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2011 at 12:30 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfy_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `am_client`
--

DROP TABLE IF EXISTS `am_client`;
CREATE TABLE IF NOT EXISTS `am_client` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `am_client`
--


-- --------------------------------------------------------

--
-- Table structure for table `bk_destination`
--

DROP TABLE IF EXISTS `bk_destination`;
CREATE TABLE IF NOT EXISTS `bk_destination` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bk_destination`
--


-- --------------------------------------------------------

--
-- Table structure for table `core_chat`
--

DROP TABLE IF EXISTS `core_chat`;
CREATE TABLE IF NOT EXISTS `core_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recd` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `core_chat`
--

INSERT INTO `core_chat` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
(1, 'admin', 'general', 'jshdfjsd hfsdj', '2011-01-31 16:00:58', 0),
(2, 'general', 'admin', 'jdhsdfjsdj', '2011-02-01 15:08:39', 0),
(3, 'rer', 'ere', 'erer', '2011-02-01 15:21:19', 0),
(4, 'admin', 'general', 'dksdkfk', '2011-02-01 15:29:07', 0),
(5, 'effef', 'efef', 'efefe', '2011-02-01 15:32:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_module_var`
--

DROP TABLE IF EXISTS `core_module_var`;
CREATE TABLE IF NOT EXISTS `core_module_var` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `print_name` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`name`),
  KEY `print_name` (`print_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_module_var`
--

INSERT INTO `core_module_var` (`id`, `name`, `print_name`, `status`) VALUES
(2, 'payroll', 'Nomina', 0),
(99, 'home', 'ConfiguraciÃ³n', 0),
(3, 'admin', 'AdministraciÃ³n', 0),
(5, 'budget', 'Presupuesto', 0),
(4, 'booking', 'Reservaciones', 0),
(6, 'condo', 'Condominio', 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_user`
--

DROP TABLE IF EXISTS `core_user`;
CREATE TABLE IF NOT EXISTS `core_user` (
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

--
-- Dumping data for table `core_user`
--

INSERT INTO `core_user` (`username`, `password`, `name`, `lastname`, `level`, `status`, `online`, `creation_date`) VALUES
('admin', 'juan316', 'Administrador', 'General', 0, 0, '2011-04-13 10:15:49', '2011-01-01'),
('general', '12345', 'Usuario', '', 0, 0, '2011-04-13 15:14:42', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `co_expenses`
--

DROP TABLE IF EXISTS `co_expenses`;
CREATE TABLE IF NOT EXISTS `co_expenses` (
  `id_expenses` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `type` varchar(5) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_expenses`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `co_expenses`
--

INSERT INTO `co_expenses` (`id_expenses`, `code`, `name`, `description`, `type`, `amount`, `creation_date`) VALUES
(0, '1', 'Luz', 'Electricidad de Caracas', 'M', 125, '2011-08-29 12:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `co_owners`
--

DROP TABLE IF EXISTS `co_owners`;
CREATE TABLE IF NOT EXISTS `co_owners` (
  `id_owners` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_owners`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `co_owners`
--

INSERT INTO `co_owners` (`id_owners`, `id_doc`, `name`, `lastname`, `address`, `creation_date`) VALUES
(3, '11663916', 'Ernesto', 'La Fontaine', 'Guarenas', '2011-08-29 12:16:56'),
(4, '13992530', 'Alejandra', 'Del Campo', 'Guarenas', '2011-08-29 12:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `pa_employee`
--

DROP TABLE IF EXISTS `pa_employee`;
CREATE TABLE IF NOT EXISTS `pa_employee` (
  `id_employee` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `started_date` date DEFAULT NULL,
  `income` decimal(10,0) DEFAULT NULL,
  `period` varchar(50) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_employee`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pa_employee`
--

