-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2010 at 04:44 PM
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
-- DROP DATABASE `cfy_base`;
-- CREATE DATABASE `cfy_base` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
-- USE `cfy_base`;
-- --------------------------------------------------------

--
-- Table structure for table `core_module_var`
--

DROP TABLE IF EXISTS `core_module_var`;
CREATE TABLE IF NOT EXISTS `core_module_var` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `print` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`name`),
  KEY `print` (`print`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_module_var`
--

INSERT INTO `core_module_var` (`id`, `name`, `print`) VALUES
(3, 'payroll', 'Nomina'),
(1, 'home', 'Inicio'),
(2, 'admin', 'Administracion'),
(4, 'budget', 'Presupuesto');

-- --------------------------------------------------------

--
-- Table structure for table `core_user`
--

DROP TABLE IF EXISTS `core_user`;
CREATE TABLE IF NOT EXISTS `core_user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_user`
--

INSERT INTO `core_user` (`username`, `password`, `level`, `creation_date`, `status`) VALUES
('admin', 'juan316', 0, '2010-10-05 01:01:01', 0),
('general', '12345', 0, '2010-10-05 04:48:00', 0);
