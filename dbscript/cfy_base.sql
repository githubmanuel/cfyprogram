-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
--
-- Host: localhost
-- Generation Time: Sep 10, 2010 at 12:38 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `cfy_base`
--
DROP DATABASE `cfy_base`;
CREATE DATABASE `cfy_base` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cfy_base`;

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
('admin', '12345', 0, '2010-09-01 17:19:24', 0);
