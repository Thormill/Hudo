-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2011 at 10:20 AM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hudo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `c_id` int(4) NOT NULL AUTO_INCREMENT,
  `type_id` int(3) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `h_id` int(5) NOT NULL AUTO_INCREMENT,
  `artist_id` int(5) NOT NULL,
  `type_id` int(3) NOT NULL,
  `category_id` int(4) NOT NULL,
  `item_id` int(5) NOT NULL,
  `amount` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `history`
--


-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `i_id` int(5) NOT NULL AUTO_INCREMENT,
  `type_id` int(3) NOT NULL,
  `category_id` int(4) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `items`
--


-- --------------------------------------------------------

--
-- Table structure for table `masters`
--

CREATE TABLE IF NOT EXISTS `masters` (
  `m_id` int(3) NOT NULL AUTO_INCREMENT,
  `fio` varchar(255) NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `masters`
--


-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `p_id` int(5) NOT NULL AUTO_INCREMENT,
  `category_id` int(4) NOT NULL,
  `type_id` int(3) NOT NULL,
  `item_id` int(5) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prices`
--


-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `t_id` int(3) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `types`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(3) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `upass` varchar(255) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--

