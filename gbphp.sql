-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Фев 12 2019 г., 06:15
-- Версия сервера: 8.0.12
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gbphp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `info` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `url` varchar(30) NOT NULL,
  `CountClick` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `info`, `price`, `url`, `CountClick`) VALUES
(1, 'Товар 1', 'Это хороший товар.', 200, '1.jpg', 38),
(2, 'Товар 2', 'Очень хороший товар.', 300, '2.jpg', 15),
(3, 'Товар 3', 'Товар.', 260, '3.jpg', 3),
(4, 'Товар 4', 'Очень хороший товар. Очень хороший товар. Очень хороший товар. Очень хороший товар.', 4560, '4.jpg', 5),
(5, 'Товар 5', 'Нужный товар.', 2345, '5.jpg', 1),
(6, 'Товар 6', 'Новый товар.', 1355, '6.jpg', 1),
(7, 'Товар 7', 'Самый новый товар.', 32445, '7.jpg', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `num` int(11) NOT NULL COMMENT 'номер отзыва',
  `id_images` int(11) NOT NULL,
  `name` text NOT NULL COMMENT 'имя',
  `review` text NOT NULL COMMENT 'отзыв'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`num`, `id_images`, `name`, `review`) VALUES
(23, 2, 'wetewtwt', 'e'),
(27, 2, 'ADadA', 'ADadAD'),
(31, 7, 'eqwqwe', 'wqeqwe'),
(32, 6, '4234234', '23423423'),
(33, 4, 'eqwetwet', 'eq'),
(35, 4, 'qwrqr', 'wqrqwr'),
(37, 5, 'safasf', '124214124'),
(40, 7, 'werewrwerwer', 'ewrwerwe'),
(41, 5, '142352315', '3253253253252'),
(42, 3, '1242412', '412412412'),
(43, 5, '3463443634', '634634634634'),
(44, 6, 'wqrqwqw', 'wqrqwr'),
(45, 3, '32523', '5235235'),
(49, 1, 'ФВфв', 'ФВФВ'),
(63, 1, 'sdshsdhdshsdh', 'sdhsdhsdhsdddddddddddddddddddddddddddddddddddddddddddddddddddddddd'),
(67, 1, '1421414', '124124142'),
(68, 1, 'ASDASFAFASF', 'SAFASFASFAFAFSAFAF'),
(83, 1, 'sfzzdf', 'dafsdfsdfsd'),
(84, 1, '2311123', '3123123123');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `typeUser` int(1) DEFAULT '0' COMMENT '0 - user 1 - admin',
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `typeUser`, `dob`) VALUES
(2, 'vas', '94d45872fa08212b232ea27c99e6bf9f', 'Василий Петров', 0, '2019-02-05'),
(5, 'admin', '59af9df1649375f89d4250ea39155332', 'admin', 1, '2019-02-12');

-- --------------------------------------------------------

--
-- Структура таблицы `zakaz`
--

CREATE TABLE `zakaz` (
  `id` int(11) NOT NULL,
  `fio` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `info` text NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `status` varchar(11) NOT NULL DEFAULT '0' COMMENT '0 - не выполнен, 1 - в обработке, 2 - выполнен'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `zakaz`
--

INSERT INTO `zakaz` (`id`, `fio`, `tel`, `address`, `info`, `login`, `status`) VALUES
(1, 'фыв', 'фыв', 'фыв', '[{\"price\":\"300\",\"name\":\"Товар 2\",\"count\":1}]', '0', '1'),
(2, 'Фио', '+85056564', 'Мой адрес', '[{\"price\":\"300\",\"name\":\"Товар 2\",\"count\":2},{\"price\":\"230\",\"name\":\"Товар 3\",\"count\":3}]', '0', '0'),
(5, 'Василий', '856463634', 'ул. Такая то', '[{\"price\":\"200\",\"name\":\"Товар 1\",\"priceSum\":600,\"count\":3,\"url\":\"1.jpg\"},{\"price\":\"300\",\"name\":\"Товар 2\",\"priceSum\":900,\"count\":3,\"url\":\"2.jpg\"}]', 'vas', '2'),
(6, 'Вася', '898765', 'д356', '[{\"price\":\"300\",\"name\":\"Товар 2\",\"priceSum\":900,\"count\":3,\"url\":\"2.jpg\"},{\"price\":\"4560\",\"name\":\"Товар 4\",\"priceSum\":13680,\"count\":3,\"url\":\"4.jpg\"}]', 'vas', '0'),
(8, 'sdgsd', 'gsdgsdg', 'dsgdg', '[{\"price\":\"300\",\"name\":\"Товар 2\",\"priceSum\":900,\"count\":3,\"url\":\"2.jpg\"},{\"price\":\"32445\",\"name\":\"Товар 7\",\"priceSum\":129780,\"count\":4,\"url\":\"7.jpg\"}]', '', '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`num`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zakaz`
--
ALTER TABLE `zakaz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT COMMENT 'номер отзыва', AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `zakaz`
--
ALTER TABLE `zakaz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
