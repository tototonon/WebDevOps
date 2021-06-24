-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Mai 2021 um 13:38
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webentwicklung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `url_key` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(124) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `url_key`, `author`, `text`, `file`) VALUES
(1, 'How to blog', 'how-to-blog', 'Ernie', '\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\nPulvinar fames non phasellus dignissim imperdiet sociosqu magna dictum gravida, tincidunt mattis mauris felis ante montes rhoncus semper, iaculis nisl facilisis malesuada maecenas pharetra metus risus. Ultrices nunc aptent lacus sodales sagittis amet urna viverra ut, elementum habitant at congue rhoncus ultricies nostra vitae bibendum, sed libero vulputate mus dictumst felis imperdiet enim. Quis porta turpis dictumst id venenatis fermentum non vestibulum, imperdiet purus eget iaculis magnis vulputate congue donec, ultrices scelerisque consectetur hac inceptos fringilla adipiscing. Nunc curae praesent turpis molestie commodo torquent sem fringilla malesuada blandit, nec porta consequat litora risus nullam viverra natoque quisque cras vulputate, vitae himenaeos sociosqu facilisis vehicula cum dui a class. Vitae nulla parturient integer turpis fusce senectus nascetur tempus cum natoque quam tristique dictumst congue penatibus, lobortis habitasse malesuada sit dictum aenean hendrerit pretium bibendum diam consequat cubilia himenaeos. Aliquam adipiscing nunc vehicula pulvinar risus vulputate curabitur nisl egestas vitae mus, non ipsum feugiat diam vestibulum nullam dapibus in turpis sodales sociosqu massa, at auctor dolor imperdiet condimentum montes nulla nam posuere arcu.\n\nLigula dui auctor mollis feugiat odio convallis vitae, ac erat pulvinar viverra netus tellus, mus facilisi sem nullam accumsan sapien. Fames tellus nulla pharetra habitasse facilisis nibh, curae dis laoreet neque malesuada. Sit class magna praesent maecenas euismod mi aliquam laoreet dictum, sollicitudin nascetur dapibus rhoncus commodo imperdiet neque inceptos, eros quam egestas ornare posuere cursus dictumst habitasse. Diam feugiat curae in vulputate curabitur nullam volutpat odio donec sagittis laoreet viverra, adipiscing non fames cum auctor facilisi luctus erat maecenas magnis velit tincidunt lectus, quam sed porta lorem rhoncus nisi eros pretium penatibus purus tempor. Porta varius netus nisi consequat neque arcu taciti, ullamcorper ornare accumsan mi aenean imperdiet.\n', ''),
(2, 'MVC made easy', 'mvc-made-easy', 'Bert', '\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\nPulvinar fames non phasellus dignissim imperdiet sociosqu magna dictum gravida, tincidunt mattis mauris felis ante montes rhoncus semper, iaculis nisl facilisis malesuada maecenas pharetra metus risus. Ultrices nunc aptent lacus sodales sagittis amet urna viverra ut, elementum habitant at congue rhoncus ultricies nostra vitae bibendum, sed libero vulputate mus dictumst felis imperdiet enim. Quis porta turpis dictumst id venenatis fermentum non vestibulum, imperdiet purus eget iaculis magnis vulputate congue donec, ultrices scelerisque consectetur hac inceptos fringilla adipiscing. Nunc curae praesent turpis molestie commodo torquent sem fringilla malesuada blandit, nec porta consequat litora risus nullam viverra natoque quisque cras vulputate, vitae himenaeos sociosqu facilisis vehicula cum dui a class. Vitae nulla parturient integer turpis fusce senectus nascetur tempus cum natoque quam tristique dictumst congue penatibus, lobortis habitasse malesuada sit dictum aenean hendrerit pretium bibendum diam consequat cubilia himenaeos. Aliquam adipiscing nunc vehicula pulvinar risus vulputate curabitur nisl egestas vitae mus, non ipsum feugiat diam vestibulum nullam dapibus in turpis sodales sociosqu massa, at auctor dolor imperdiet condimentum montes nulla nam posuere arcu.\n\nLigula dui auctor mollis feugiat odio convallis vitae, ac erat pulvinar viverra netus tellus, mus facilisi sem nullam accumsan sapien. Fames tellus nulla pharetra habitasse facilisis nibh, curae dis laoreet neque malesuada. Sit class magna praesent maecenas euismod mi aliquam laoreet dictum, sollicitudin nascetur dapibus rhoncus commodo imperdiet neque inceptos, eros quam egestas ornare posuere cursus dictumst habitasse. Diam feugiat curae in vulputate curabitur nullam volutpat odio donec sagittis laoreet viverra, adipiscing non fames cum auctor facilisi luctus erat maecenas magnis velit tincidunt lectus, quam sed porta lorem rhoncus nisi eros pretium penatibus purus tempor. Porta varius netus nisi consequat neque arcu taciti, ullamcorper ornare accumsan mi aenean imperdiet.\n', ''),
(85, 'teresa ist hier', 'teresa', 'teresa meglio', 'io sono teresa', ''),
(90, 'friday', 'f', 'hahhaha', 'nasndsnd', 'IMG_20200419_190740.jpg'),
(91, 'fridayYeah', 'fu', 'hahhaha', 'nasndsnd', 'IMG_20200229_181457.jpg'),
(92, 'fridayYeah', 'fu', 'hahhaha', 'nasndsnd', 'IMG_20200229_181457.jpg'),
(93, 'fridayYeah', '.', 'hahhaha', 'nasndsnd', 'IMG_20200229_181457.jpg'),
(94, 'fridayYeah', 'ookk', 'hahhaha', 'nasndsnd', 'IMG_20200229_181457.jpg'),
(95, 'fridayYeah', 'ookk', 'hahhaha', 'nasndsnd', 'IMG_1.jpg'),
(96, 'fridayYeah', 'lol', 'hahhaha', 'nasndsnd', 'IMG_1.jpg'),
(97, 'hallo', 'hel', 'ooo', 'hdhsdh', NULL),
(98, 'hallo', 'helo', 'ooo', 'hdhsdh', 'IMG_20200419_190740.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `media`
--

INSERT INTO `media` (`id`, `file`, `uploaded_on`) VALUES
(4, '.%name', '2021-05-12 22:07:00'),
(5, '.%name', '2021-05-12 22:47:18');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'test1@giemx.de', 'hallo');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT für Tabelle `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;