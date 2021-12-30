-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: database:3306
-- Время создания: Дек 30 2021 г., 12:30
-- Версия сервера: 5.7.36
-- Версия PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `many_chat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL COMMENT 'Название',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Дата обновления',
  `is_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `name`, `created_at`, `updated_at`, `is_delete`) VALUES
(1, 'IT', '2021-12-29 14:07:08', NULL, 0),
(2, 'Отдел продаж', '2021-12-29 14:07:27', NULL, 0),
(3, 'Руководство', '2021-12-29 14:07:41', NULL, 0),
(4, 'Бухгалтерия', '2021-12-29 15:02:32', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL COMMENT 'Название',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_delete` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `name`, `created_at`, `updated_at`, `is_delete`) VALUES
(1, 'Разработка', '2021-12-29 14:08:10', NULL, 0),
(2, 'Продажа рекламы', '2021-12-29 14:08:24', NULL, 0),
(3, 'Продажа товаров', '2021-12-29 14:08:36', NULL, 0),
(4, 'Начисление зарплаты', '2021-12-29 15:03:18', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Имя',
  `surname` varchar(100) NOT NULL COMMENT 'Фамилия',
  `gender` int(1) NOT NULL COMMENT 'Пол',
  `salary` int(11) DEFAULT NULL COMMENT 'Зарплата',
  `birthday` varchar(200) NOT NULL,
  `department_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `name`, `surname`, `gender`, `salary`, `birthday`, `department_id`, `project_id`, `created_at`, `updated_at`, `is_delete`) VALUES
(1, 'Алексей', 'Смирнов', 1, 100000, '2021-12-29', 1, 1, '2021-12-29 14:16:31', NULL, 0),
(2, 'Сергей', 'Володин', 1, 90000, '2021-12-29', 2, 2, '2021-12-29 14:17:42', NULL, 0),
(3, 'Ирина', 'Чехова', 2, 85000, '2021-12-29', 2, 3, '2021-12-29 14:18:42', NULL, 0),
(4, 'Александр', 'Крутой', 1, 200000, '2021-12-29', 1, 1, '2021-12-29 14:41:21', NULL, 0),
(5, 'Татьяна', 'Безденежных', 2, 50000, '2021-12-29', 4, 4, '2021-12-29 15:05:07', NULL, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
