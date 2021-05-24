-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 24 2021 г., 12:54
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `e-dime`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `shop_id`, `users_id`) VALUES
(138, 1, 54),
(139, 2, 54),
(141, 4, 54),
(142, 5, 54);

-- --------------------------------------------------------

--
-- Структура таблицы `comp`
--

CREATE TABLE `comp` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `place` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `dist` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comp`
--

INSERT INTO `comp` (`id`, `name`, `place`, `date`, `time`, `dist`, `status`) VALUES
(12, 'Полежаевская лыжня', 'Полежаевский', '2021-06-05', '17:00:00', 5, 1),
(14, 'Чемпионат райкомовских сусликов', 'Поселок Свердлова', '2021-06-02', '20:10:00', 10, 1),
(16, 'Лыжня РАНХИГС', 'Магнитогорсая', '2021-06-03', '16:50:00', 15, 0),
(17, 'Тур де Гатчина', 'Гатчина', '2021-04-30', '11:15:00', 5, 0),
(18, 'Чемпионат Политеха', 'Политех', '2021-06-02', '19:30:00', 50, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `part`
--

CREATE TABLE `part` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `result` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `part`
--

INSERT INTO `part` (`id`, `users_id`, `comp_id`, `result`) VALUES
(7, 4, 12, '15:03:13'),
(8, 4, 16, NULL),
(9, 4, 14, '12:41:04'),
(10, 20, 12, '12:38:57'),
(11, 24, 16, NULL),
(12, 44, 14, '13:46:06'),
(13, 24, 12, '18:18:57'),
(14, 20, 16, NULL),
(17, 49, 16, NULL),
(19, 53, 12, '05:25:30'),
(20, 52, 16, NULL),
(23, 53, 16, NULL),
(24, 46, 14, NULL),
(25, 20, 14, '13:46:06'),
(28, 20, 18, '19:56:52'),
(29, 54, 12, '14:08:30'),
(30, 54, 17, NULL),
(31, 55, 18, '12:15:15'),
(32, 55, 17, NULL),
(35, 54, 18, '05:08:20'),
(36, 54, 14, NULL),
(38, 56, 12, '09:37:50'),
(40, 57, 17, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `qual`
--

CREATE TABLE `qual` (
  `id` int(11) NOT NULL,
  `qual` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qual`
--

INSERT INTO `qual` (`id`, `qual`) VALUES
(6, '1 взрослый'),
(7, '2 взрослый'),
(8, '3 взрослый'),
(9, '1 юношеский'),
(10, '2 юношеский'),
(11, '3 юношеский'),
(12, 'нет разряда');

-- --------------------------------------------------------

--
-- Структура таблицы `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `cost` int(11) NOT NULL,
  `picture` varchar(25) NOT NULL,
  `skate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop`
--

INSERT INTO `shop` (`id`, `name`, `cost`, `picture`, `skate`) VALUES
(1, 'Лыжная мазь (5 шт.)', 350, 'maz.jpg', 0),
(2, 'Пробка', 150, 'probka.jpg', 0),
(3, 'Скребок', 100, 'skrebok.jpg', 2),
(4, 'Тряпочка', 50, 'trapka.jpg', 2),
(5, 'Смывка мази/парафина', 400, 'smivka.jpg', 2),
(6, 'Парафин (3 шт.)', 400, 'wax.jpg', 1),
(7, 'Щётка нейлоновая', 500, 'nelon.jpg', 1),
(8, 'Щётка бронзовая', 700, 'bronza.jpg', 1),
(9, 'Утюг лыжный \"SWIX\"', 1500, 'warm.png', 1),
(10, 'Цикля металлическая', 400, 'cicla.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `birth` date NOT NULL,
  `place` varchar(25) NOT NULL,
  `qual_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `phone`, `birth`, `place`, `qual_id`) VALUES
(4, 'Михаил Раухенгаузен', 'давид', '648b188ec362b2e1d3d24986b2b15173', '', '2021-04-28', 'свердлова', 7),
(20, 'Виталий', '+7 981 950-15-77', '1f32aa4c9a1d2ea010adcf2348166a04', '', '2021-05-04', 'спб', 6),
(24, 'Виталий Соломин', 'карась', '0c0c36b2c48b86656fdca4d6d463e089', '', '2021-04-29', 'спб', 8),
(44, 'Михаил Ломоносов', 'lom', 'e21e03d22217f86b7afeb800a6dff9dd', '', '2021-05-03', 'Санкт-Петербург', 7),
(46, 'Александр Сыроежкин', 'alsir', 'b612a973242b630cb74d9ff0860f0826', '', '2021-04-27', 'Гатчина', 12),
(47, 'Михаил Раухенгаузен', 'mic', 'd9b1d7db4cd6e70935368a1efb10e377', 'a6624515b278efe7280328025', '2021-04-27', 'Поселок Свердлова', 12),
(49, 'Саша Гуськов', 'gus', '7a17809ff64a1fb6b7f20588879d5ec1', '7a17809ff64a1fb6b7f205888', '2021-05-05', 'Гатчина', 6),
(50, 'Михаил Гуськов', 'admin', '89819501577', 'e383f0fed59774819c531e36c', '2021-06-01', 'Санкт-Петербург', 6),
(52, 'Саша Гуськов', 'sug', '123', '6456e85d075945728f312ae62', '2021-06-01', 'Санкт-Петербург', 6),
(53, 'Виталий', 'sug4', '7045c33a24b9206d1ea9a78ad246563d', '123', '2021-05-04', 'спб', 7),
(54, 'Антон Вишнёв', 'anton', '7045c33a24b9206d1ea9a78ad246563d', '7511941', '2021-06-02', 'Красное село', 12),
(55, 'Нильс Бор', 'atom', 'c8f23ee061c2607185dabe8deedc3cef', '756890', '2021-04-28', 'заграница', 6),
(56, 'Сидор Булкин', 'sidor', '37392bcd2374adde364ed640199f6d60', '5678976', '1994-01-24', 'деревня Монино', 9),
(57, 'Эрнест Резерфорд', 'rez', '259125c6ecb1d90559d2e1c7cd00647e', '67890', '2021-04-28', 'Лондон', 7),
(58, 'Сыроежкин', '567', '4c1f9c630b465746737f842b047b77b4', '89819501577', '2021-04-27', 'спб', 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basket_ibfk_1` (`shop_id`),
  ADD KEY `basket_ibfk_2` (`users_id`);

--
-- Индексы таблицы `comp`
--
ALTER TABLE `comp`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_ibfk_1` (`users_id`),
  ADD KEY `part_ibfk_2` (`comp_id`);

--
-- Индексы таблицы `qual`
--
ALTER TABLE `qual`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qual_id` (`qual_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT для таблицы `comp`
--
ALTER TABLE `comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `part`
--
ALTER TABLE `part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `qual`
--
ALTER TABLE `qual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `part_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `part_ibfk_2` FOREIGN KEY (`comp_id`) REFERENCES `comp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`qual_id`) REFERENCES `qual` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
