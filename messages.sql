-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Апр 26 2021 г., 01:43
-- Версия сервера: 10.3.25-MariaDB-0ubuntu1
-- Версия PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `guestbook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `answered_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `name`, `image`, `answer`, `user_id`, `answered_id`, `created_at`, `updated_at`) VALUES
(42, 'Париж', 'uploads/e2c420d928d4bf8ce0ff2ec19b371514.jpeg', 0, 1, 0, '2021-04-25 18:27:25', '2021-04-25 18:27:25'),
(43, 'БМВ', 'uploads/70efdf2ec9b086079795c442636b55fb.png', 0, 1, 0, '2021-04-25 19:05:10', '2021-04-25 19:26:17'),
(47, 'И че че бмв', NULL, 0, 1, 43, '2021-04-25 19:26:29', '2021-04-25 19:26:29'),
(48, 'куку', NULL, 0, 2, 42, '2021-04-25 19:33:05', '2021-04-25 19:33:05'),
(49, 'А че не мерседес', 'uploads/91I6mDoTJBY5UhcXZhSBFWpfl3zhbZT7jmbG0Yxu.jpg', 0, 2, 47, '2021-04-25 19:33:53', '2021-04-25 19:33:53'),
(50, 'Да ниче', 'uploads/fbd7939d674997cdb4692d34de8633c4.jpeg', 0, 1, 49, '2021-04-25 19:34:35', '2021-04-25 19:39:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
