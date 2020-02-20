-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `elect`;
CREATE DATABASE `elect` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `elect`;

DROP TABLE IF EXISTS `rollnos`;
CREATE TABLE `rollnos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Rollno` varchar(100) NOT NULL,
  `Time` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Rollno` (`Rollno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `ink` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `person` varchar(100) NOT NULL,
  `place` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `votesperpost`;
CREATE TABLE `votesperpost` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Post` varchar(100) NOT NULL,
  `Count` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- 2018-03-14 06:12:21
