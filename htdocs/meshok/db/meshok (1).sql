-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 08 2016 г., 13:55
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `meshok`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bids`
--

INSERT INTO `bids` (`id`, `order_id`, `user_id`, `price`, `created_at`, `is_deleted`) VALUES
(4, 14, 7, 50, '2016-04-07 15:34:23', 1),
(7, 14, 9, 46, '2016-04-07 18:07:31', 1),
(8, 14, 9, 46, '2016-04-07 18:24:37', 1),
(9, 14, 9, 46, '2016-04-07 18:25:51', 1),
(10, 14, 9, 46, '2016-04-07 18:27:24', 1),
(11, 14, 9, 64, '2016-04-07 18:27:31', 1),
(12, 14, 9, 46, '2016-04-07 18:27:45', 1),
(13, 7, 7, 105, '2016-04-07 23:06:57', 1),
(14, 7, 7, 50, '2016-04-08 09:27:44', 1),
(15, 9, 7, 24, '2016-04-08 17:01:09', 0),
(16, 14, 7, 46, '2016-04-08 17:23:08', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `type`) VALUES
(7, 'ÐºÐ°Ñ€Ñ‚Ð¾ÑˆÐºÐ°', 'Ð¾Ð²Ð¾Ñ‰Ð¸'),
(8, 'Ð¼Ð¾Ñ€ÐºÐ¾Ð²ÑŒ', 'Ð¾Ð²Ð¾Ñ‰Ð¸'),
(9, 'Ð»ÑƒÐº', 'Ð¾Ð²Ð¾Ñ‰Ð¸'),
(10, 'ÑÐ°Ñ…Ð°Ñ€', 'Ð¿Ð¸Ñ‰ÐµÐ²Ñ‹Ðµ Ð´Ð¾Ð±Ð°Ð²ÐºÐ¸');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `created_user_id`, `name`, `created_at`, `is_deleted`) VALUES
(47, 6, 'akparGroup', '2016-04-05 15:09:49', 0),
(48, 6, 'BestTeam', '2016-04-05 15:37:47', 0),
(50, 5, 'Group49 ', '2016-04-06 21:42:57', 0),
(51, 5, 'Group51 ', '2016-04-06 21:43:55', 0),
(52, 4, 'Group52 ', '2016-04-06 22:07:01', 0),
(53, 6, 'Group53 ', '2016-04-08 14:11:55', 1),
(54, 6, 'Group54 ', '2016-04-08 16:52:23', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `good_id`, `group_id`, `created_at`, `quantity`, `price`, `payment`, `is_deleted`) VALUES
(1, 7, 47, '2016-04-05 00:00:00', 123, 45, 'WebMoney', 0),
(2, 9, 47, '2016-04-05 21:31:55', 61, 35, 'WebMoney', 0),
(3, 10, 48, '2016-04-05 21:40:17', 100, 210, 'Qiwi', 0),
(4, 8, 47, '2016-04-05 21:41:50', 144, 44, 'Yandex', 0),
(5, 8, 47, '2016-04-05 21:42:12', 100, 55, 'WebMoney', 0),
(6, 10, 47, '2016-04-06 16:31:51', 80, 44, 'Visa', 0),
(7, 8, 48, '2016-04-06 16:34:19', 98, 100, 'Yandex', 0),
(8, 7, 48, '2016-04-06 21:08:22', 142, 23, 'WebMoney', 0),
(9, 8, 48, '2016-04-06 21:08:38', 515, 23, 'Visa', 0),
(10, 10, 48, '2016-04-06 21:08:48', 146, 23, 'WebMoney', 0),
(11, 7, 48, '2016-04-06 21:09:02', 100, 41, 'Qiwi', 0),
(12, 10, 47, '2016-04-06 21:09:15', 152, 150, 'Qiwi', 0),
(13, 7, 52, '2016-04-06 22:07:27', 51, 46, 'Qiwi', 0),
(14, 9, 50, '2016-04-07 11:08:01', 100, 45, 'ÐÐ°Ð»Ð¸Ñ‡Ð½Ñ‹Ðµ', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `fname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `address` varchar(50) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(50) CHARACTER SET latin1 NOT NULL,
  `raiting` int(11) NOT NULL,
  `raiting_num` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`, `created_at`, `fname`, `lname`, `email`, `address`, `phone`, `raiting`, `raiting_num`, `is_deleted`) VALUES
(4, 'sasha', 'sasha', 2, '2016-03-23 22:34:13', 'Sasha', 'Rodionova', 'rodionova@mail.ru', 'Prokofeva 53-3', '7774842122', 0, 0, 0),
(5, 'masha', 'masha', 2, '2016-03-23 22:35:43', 'Masha', 'Korotkova', 'favourite-best@mail.ru', 'Tlendieva 54-8', '7774842122', 0, 0, 0),
(6, 'akpar', 'akpar', 2, '2016-03-23 22:36:14', 'Akpar', 'Aryn', 'aryn11@mail.ru', 'Tlendieva 54-8', '7074842108', 0, 0, 0),
(7, 'saule', 'saule', 1, '2016-03-23 22:45:06', 'Ð¡Ð°ÑƒÐ»Ðµ', 'ÐÐºÐ¸ÑˆÐµÐ²Ð°', 'saulesha@mail.ru', 'Shevchenko 12-5', '7787759656', 0, 0, 0),
(9, 'olya', 'olya', 1, '2016-04-06 20:34:21', 'ÐžÐ»Ñ', 'ÐšÐ¾Ð²Ñ‚ÑƒÐ½', 'olya@mail.ru', 'Ð¢Ð°ÑˆÐºÐµÐ½Ñ‚ÑÐºÐ°Ñ 18', '7774842100', 0, 0, 0),
(11, 'admin', 'admin', 3, '2016-04-07 19:29:24', 'ÐœÐ°Ñ€Ð¸Ñ', 'ÐšÐ¾Ñ€Ð¾Ñ‚ÐºÐ¾Ð²Ð°', 'favourite-best@mail.ru', 'Ð‘Ð¾Ð³ÐµÐ½Ð±Ð°Ð¹ Ð±Ð°Ñ‚Ñ‹Ñ€Ð°, 237', '7089030888', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users_in_groups`
--

CREATE TABLE `users_in_groups` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users_in_groups`
--

INSERT INTO `users_in_groups` (`id`, `group_id`, `user_id`, `user_login`) VALUES
(26, 47, 6, 'akpar'),
(27, 47, 5, 'masha'),
(28, 48, 6, 'akpar'),
(29, 48, 4, 'sasha'),
(30, 48, 5, 'masha'),
(42, 50, 5, 'masha'),
(43, 50, 4, 'sasha'),
(44, 50, 6, 'akpar'),
(45, 51, 5, 'masha'),
(47, 52, 4, 'sasha'),
(48, 52, 6, 'akpar'),
(49, 53, 6, 'akpar'),
(50, 54, 6, 'akpar');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_in_groups`
--
ALTER TABLE `users_in_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `users_in_groups`
--
ALTER TABLE `users_in_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
