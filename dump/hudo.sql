-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 17 2011 г., 17:19
-- Версия сервера: 5.1.54
-- Версия PHP: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `hudo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `c_id` int(4) NOT NULL AUTO_INCREMENT,
  `type_id` int(3) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `i_id` int(5) NOT NULL AUTO_INCREMENT,
  `type_id` int(3) NOT NULL,
  `category_id` int(4) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `left_items`
--

CREATE TABLE IF NOT EXISTS `left_items` (
  `left_item_id` int(5) NOT NULL AUTO_INCREMENT,
  `item_id` int(4) NOT NULL,
  `amount` int(4) NOT NULL,
  `date` int(12) NOT NULL,
  PRIMARY KEY (`left_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `masters`
--

CREATE TABLE IF NOT EXISTS `masters` (
  `m_id` int(3) NOT NULL AUTO_INCREMENT,
  `master_fio` varchar(255) NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `materials_out`
--

CREATE TABLE IF NOT EXISTS `materials_out` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `master_id` int(5) NOT NULL,
  `material_id` int(5) NOT NULL,
  `amount` int(5) unsigned NOT NULL,
  `giver` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` int(12) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `payments_history`
--

CREATE TABLE IF NOT EXISTS `payments_history` (
  `h_id` int(5) NOT NULL AUTO_INCREMENT,
  `payment_number` int(12) NOT NULL COMMENT 'номер блока платежа',
  `master_id` int(5) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `amount` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_author` varchar(150) NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `plan_id` int(10) NOT NULL AUTO_INCREMENT,
  `plan_number` int(10) NOT NULL COMMENT 'все, что относится к одному номеру плана, выводится в одном плане. удивительно, но факт.',
  `item_id` int(5) NOT NULL,
  `price` int(6) NOT NULL,
  `amount_to_make` int(4) NOT NULL,
  `amount_made` int(4) NOT NULL DEFAULT '0',
  `date` int(12) NOT NULL,
  `date_to` int(12) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `p_id` int(5) NOT NULL AUTO_INCREMENT,
  `category_id` int(4) NOT NULL,
  `type_id` int(3) NOT NULL,
  `item_id` int(5) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `t_id` int(3) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(3) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `upass` varchar(255) NOT NULL,
  `user_info` varchar(255) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
