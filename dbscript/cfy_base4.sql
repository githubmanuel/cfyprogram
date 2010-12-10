-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2010 at 11:47 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.5

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
-- Table structure for table `core_module_var`
--

DROP TABLE IF EXISTS `core_module_var`;
CREATE TABLE IF NOT EXISTS `core_module_var` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `print_name` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `print_name` (`print_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_module_var`
--

INSERT INTO `core_module_var` (`id`, `name`, `print_name`, `status`) VALUES
(2, 'payroll', 'Personal', 0),
(1, 'home', 'Inicio', 0),
(3, 'admin', 'AdministraciÃ³n', 0),
(5, 'budget', 'Presupuesto', 0),
(4, 'booking', 'Reservaciones', 0);
