
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sandal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `data`
--

CREATE TABLE `data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `garage_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `data` bigint(20) DEFAULT NULL,
  `paid` bigint(20) DEFAULT NULL,
  `prepaid` bigint(20) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `garages`
--

CREATE TABLE `garages` (
  `id` int(11) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `name` text,
  `address` text NOT NULL,
  `phone` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `general`
--

CREATE TABLE `general` (
  `id` int(11) UNSIGNED NOT NULL,
  `quarter` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `data` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `garage_id` (`garage_id`),
  ADD KEY `quarter` (`quarter`),
  ADD KEY `year` (`year`);

--
-- Индексы таблицы `garages`
--
ALTER TABLE `garages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `number` (`number`);

--
-- Индексы таблицы `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quarter` (`quarter`),
  ADD KEY `year` (`year`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `data`
--
ALTER TABLE `data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT для таблицы `garages`
--
ALTER TABLE `garages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `general`
--
ALTER TABLE `general`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `garage_id` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
