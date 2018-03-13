-- phpMyAdmin SQL 1Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 14 2018 г., 01:40
-- Версия сервера: 5.7.13
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testBD`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `date_create` timestamp NOT NULL,
  `description` text NOT NULL,
  `is_active` enum('0','1','2') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`article_id`, `name`, `date_create`, `description`, `is_active`) VALUES
(1, 'Руслан и людмила', '2018-03-13 22:15:37', 'поэма', '1'),
(2, 'Мцыри', '2018-03-13 22:15:37', 'поэма', '0'),
(3, 'Старик и море', '2018-03-13 22:18:52', 'повесть', '1'),
(4, 'Война и мир', '2018-03-13 22:16:39', 'роман', '2'),
(5, 'Евгений Онегин', '2018-03-13 22:28:51', 'роман в стихах', '1'),
(6, 'Князь Серебрянный', '2018-03-13 22:28:51', 'повесть времен Ивана Грозного', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `date_create` timestamp NOT NULL,
  `description` text NOT NULL,
  `is_active` enum('0','1','2') NOT NULL,
  `article_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`author_id`, `name`, `date_create`, `description`, `is_active`, `article_id`) VALUES
(1, 'Пушкин А.С.', '2018-03-13 22:29:40', 'поэт', '1', 1),
(2, 'Лермонтов', '2018-03-13 22:38:11', 'поэт', '1', 2),
(3, 'Толстой Л.Н.', '2018-03-13 22:39:04', 'писатель', '1', 4),
(4, 'Хэменгуй Эрнест', '2018-03-13 22:38:36', 'писатель', '1', 3),
(7, 'Пушкин А.С.', '2018-03-13 22:32:18', 'поэт', '1', 5),
(8, 'Толстой Л.Н,', '2018-03-13 22:32:18', 'писатель', '1', 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `article_id` (`article_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
