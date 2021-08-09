-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Aug 2021 um 10:32
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `phprojekt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logindaten`
--

CREATE TABLE `logindaten` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(125) NOT NULL,
  `rolle` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `logindaten`
--

INSERT INTO `logindaten` (`id`, `username`, `password`, `email`, `rolle`) VALUES
(5, 'test', '$2y$10$P4gcbOoB0CMSLDv6PLs9cO7k1LlQ9fRw0yt3H4eun8nSimEOWrBRu', 'test@testmail.de', 'admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userdaten`
--

CREATE TABLE `userdaten` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `vorname` varchar(55) NOT NULL,
  `gebdatum` date NOT NULL,
  `email` varchar(125) NOT NULL,
  `strasse` varchar(100) NOT NULL,
  `hnr` int(5) NOT NULL,
  `plz` int(10) NOT NULL,
  `ort` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `userdaten`
--

INSERT INTO `userdaten` (`id`, `name`, `vorname`, `gebdatum`, `email`, `strasse`, `hnr`, `plz`, `ort`) VALUES
(5, 'Testbaum', 'Theresa', '1995-06-11', 'test@testmail.de', 'Testweg', 25, 69115, 'Heidelberg');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `logindaten`
--
ALTER TABLE `logindaten`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `userdaten`
--
ALTER TABLE `userdaten`
  ADD UNIQUE KEY `UID` (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `logindaten`
--
ALTER TABLE `logindaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
