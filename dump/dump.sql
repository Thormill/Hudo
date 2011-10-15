-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 15 2011 г., 20:58
-- Версия сервера: 5.1.40
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `hudo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `left_items`
--

CREATE TABLE IF NOT EXISTS `left_items` (
  `left_item_id` int(5) NOT NULL AUTO_INCREMENT,
  `item_id` int(4) NOT NULL,
  `amount` int(4) unsigned NOT NULL,
  `date` int(12) NOT NULL,
  PRIMARY KEY (`left_item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `left_items`
--

INSERT INTO `left_items` (`left_item_id`, `item_id`, `amount`, `date`) VALUES
(1, 94, 1, 0),
(2, 12, 1, 0),
(3, 7, 0, 0),
(4, 7, 0, 0),
(5, 10, 0, 0),
(6, 1, 43, 0),
(7, 29, 0, 0),
(8, 7, 0, 0),
(9, 15, 4, 0);
