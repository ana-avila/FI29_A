-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Jul 2020 um 09:39
-- Server-Version: 10.1.40-MariaDB
-- PHP-Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `kursplanung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admins`
--

CREATE TABLE `admins` (
  `admindid` int(10) UNSIGNED NOT NULL,
  `vorname` varchar(100) NOT NULL,
  `nachname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwhash` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kurse`
--

CREATE TABLE `kurse` (
  `kursid` int(10) UNSIGNED NOT NULL,
  `klassenname` varchar(100) NOT NULL,
  `startdatum` date NOT NULL,
  `kursvorlageid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kurseurlaub`
--

CREATE TABLE `kurseurlaub` (
  `id` int(10) UNSIGNED NOT NULL,
  `kursid` int(10) UNSIGNED NOT NULL,
  `urlaubsstart` date NOT NULL,
  `urlaubende` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kurstrainer`
--

CREATE TABLE `kurstrainer` (
  `id` int(10) UNSIGNED NOT NULL,
  `kursid` int(10) UNSIGNED NOT NULL,
  `trainerid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kursvorlage`
--

CREATE TABLE `kursvorlage` (
  `kursvorlageid` int(10) UNSIGNED NOT NULL,
  `kursvorlagenname` varchar(100) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kursvorlagemodule`
--

CREATE TABLE `kursvorlagemodule` (
  `id` int(10) UNSIGNED NOT NULL,
  `kursvorlageid` int(10) UNSIGNED NOT NULL,
  `modulid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lernfelder`
--

CREATE TABLE `lernfelder` (
  `lernfeldid` int(10) UNSIGNED NOT NULL,
  `lernfeldname` varchar(100) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lernfelderschwerpunktthemen`
--

CREATE TABLE `lernfelderschwerpunktthemen` (
  `id` int(10) UNSIGNED NOT NULL,
  `lernfeldid` int(10) UNSIGNED NOT NULL,
  `schwerpunktthemenid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modul`
--

CREATE TABLE `modul` (
  `modulid` int(10) UNSIGNED NOT NULL,
  `modulname` varchar(100) NOT NULL,
  `dauerid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `moduldauer`
--

CREATE TABLE `moduldauer` (
  `dauerid` int(10) UNSIGNED NOT NULL,
  `dauer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modullernfelder`
--

CREATE TABLE `modullernfelder` (
  `id` int(10) UNSIGNED NOT NULL,
  `modulid` int(10) UNSIGNED NOT NULL,
  `lernfeldid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schwerpunktthemen`
--

CREATE TABLE `schwerpunktthemen` (
  `schwerpunktthemenid` int(10) UNSIGNED NOT NULL,
  `schwerpunktthemenname` varchar(100) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trainer`
--

CREATE TABLE `trainer` (
  `trainerid` int(10) UNSIGNED NOT NULL,
  `vorname` varchar(100) NOT NULL,
  `nachname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trainerlernfelder`
--

CREATE TABLE `trainerlernfelder` (
  `id` int(10) UNSIGNED NOT NULL,
  `trainerid` int(10) UNSIGNED NOT NULL,
  `lernfeldid` int(10) UNSIGNED NOT NULL,
  `lernfeldtyp` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trainerschwerpunktthemen`
--

CREATE TABLE `trainerschwerpunktthemen` (
  `id` int(10) UNSIGNED NOT NULL,
  `trainerid` int(10) UNSIGNED NOT NULL,
  `schwerpunktthemenid` int(10) UNSIGNED NOT NULL,
  `schwerpunktthementyp` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trainerurlaub`
--

CREATE TABLE `trainerurlaub` (
  `id` int(10) UNSIGNED NOT NULL,
  `trainerid` int(10) UNSIGNED NOT NULL,
  `urlaubstart` date NOT NULL,
  `urlaubende` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trainerzeitzuweisung`
--

CREATE TABLE `trainerzeitzuweisung` (
  `id` int(10) UNSIGNED NOT NULL,
  `trainerid` int(10) UNSIGNED NOT NULL,
  `kursid` int(10) UNSIGNED NOT NULL,
  `zeitzuweisungid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeitzuweisung`
--

CREATE TABLE `zeitzuweisung` (
  `zeitzuweisungid` int(10) UNSIGNED NOT NULL,
  `startdatum` date NOT NULL,
  `enddatum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admindid`);

--
-- Indizes für die Tabelle `kurse`
--
ALTER TABLE `kurse`
  ADD PRIMARY KEY (`kursid`),
  ADD KEY `kursvorlageid` (`kursvorlageid`);

--
-- Indizes für die Tabelle `kurseurlaub`
--
ALTER TABLE `kurseurlaub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kursid` (`kursid`);

--
-- Indizes für die Tabelle `kurstrainer`
--
ALTER TABLE `kurstrainer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kursid` (`kursid`),
  ADD KEY `trainerid` (`trainerid`);

--
-- Indizes für die Tabelle `kursvorlage`
--
ALTER TABLE `kursvorlage`
  ADD PRIMARY KEY (`kursvorlageid`);

--
-- Indizes für die Tabelle `kursvorlagemodule`
--
ALTER TABLE `kursvorlagemodule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kursvorlageid` (`kursvorlageid`),
  ADD KEY `modulid` (`modulid`);

--
-- Indizes für die Tabelle `lernfelder`
--
ALTER TABLE `lernfelder`
  ADD PRIMARY KEY (`lernfeldid`);

--
-- Indizes für die Tabelle `lernfelderschwerpunktthemen`
--
ALTER TABLE `lernfelderschwerpunktthemen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lernfeldid` (`lernfeldid`),
  ADD KEY `schwerpunktthemenid` (`schwerpunktthemenid`);

--
-- Indizes für die Tabelle `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`modulid`),
  ADD KEY `dauerid` (`dauerid`);

--
-- Indizes für die Tabelle `moduldauer`
--
ALTER TABLE `moduldauer`
  ADD PRIMARY KEY (`dauerid`);

--
-- Indizes für die Tabelle `modullernfelder`
--
ALTER TABLE `modullernfelder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulid` (`modulid`),
  ADD KEY `lernfeldid` (`lernfeldid`);

--
-- Indizes für die Tabelle `schwerpunktthemen`
--
ALTER TABLE `schwerpunktthemen`
  ADD PRIMARY KEY (`schwerpunktthemenid`);

--
-- Indizes für die Tabelle `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainerid`);

--
-- Indizes für die Tabelle `trainerlernfelder`
--
ALTER TABLE `trainerlernfelder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lernfeldid` (`lernfeldid`),
  ADD KEY `trainerid` (`trainerid`);

--
-- Indizes für die Tabelle `trainerschwerpunktthemen`
--
ALTER TABLE `trainerschwerpunktthemen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainerid` (`trainerid`),
  ADD KEY `schwerpunktthemenid` (`schwerpunktthemenid`);

--
-- Indizes für die Tabelle `trainerurlaub`
--
ALTER TABLE `trainerurlaub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainerid` (`trainerid`);

--
-- Indizes für die Tabelle `trainerzeitzuweisung`
--
ALTER TABLE `trainerzeitzuweisung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zeitzuweisungid` (`zeitzuweisungid`),
  ADD KEY `trainerid` (`trainerid`);

--
-- Indizes für die Tabelle `zeitzuweisung`
--
ALTER TABLE `zeitzuweisung`
  ADD PRIMARY KEY (`zeitzuweisungid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admins`
--
ALTER TABLE `admins`
  MODIFY `admindid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kurse`
--
ALTER TABLE `kurse`
  MODIFY `kursid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kurseurlaub`
--
ALTER TABLE `kurseurlaub`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kurstrainer`
--
ALTER TABLE `kurstrainer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kursvorlage`
--
ALTER TABLE `kursvorlage`
  MODIFY `kursvorlageid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kursvorlagemodule`
--
ALTER TABLE `kursvorlagemodule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `lernfelder`
--
ALTER TABLE `lernfelder`
  MODIFY `lernfeldid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `lernfelderschwerpunktthemen`
--
ALTER TABLE `lernfelderschwerpunktthemen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `modul`
--
ALTER TABLE `modul`
  MODIFY `modulid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `moduldauer`
--
ALTER TABLE `moduldauer`
  MODIFY `dauerid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `modullernfelder`
--
ALTER TABLE `modullernfelder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `schwerpunktthemen`
--
ALTER TABLE `schwerpunktthemen`
  MODIFY `schwerpunktthemenid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainerid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `trainerlernfelder`
--
ALTER TABLE `trainerlernfelder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `trainerschwerpunktthemen`
--
ALTER TABLE `trainerschwerpunktthemen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `trainerurlaub`
--
ALTER TABLE `trainerurlaub`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `trainerzeitzuweisung`
--
ALTER TABLE `trainerzeitzuweisung`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zeitzuweisung`
--
ALTER TABLE `zeitzuweisung`
  MODIFY `zeitzuweisungid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `kurse`
--
ALTER TABLE `kurse`
  ADD CONSTRAINT `kurse_ibfk_1` FOREIGN KEY (`kursvorlageid`) REFERENCES `kursvorlage` (`kursvorlageid`);

--
-- Constraints der Tabelle `kurseurlaub`
--
ALTER TABLE `kurseurlaub`
  ADD CONSTRAINT `kurseurlaub_ibfk_1` FOREIGN KEY (`kursid`) REFERENCES `kurse` (`kursid`);

--
-- Constraints der Tabelle `kurstrainer`
--
ALTER TABLE `kurstrainer`
  ADD CONSTRAINT `kurstrainer_ibfk_1` FOREIGN KEY (`kursid`) REFERENCES `kurse` (`kursid`),
  ADD CONSTRAINT `kurstrainer_ibfk_2` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`);

--
-- Constraints der Tabelle `kursvorlagemodule`
--
ALTER TABLE `kursvorlagemodule`
  ADD CONSTRAINT `kursvorlagemodule_ibfk_1` FOREIGN KEY (`kursvorlageid`) REFERENCES `kursvorlage` (`kursvorlageid`),
  ADD CONSTRAINT `kursvorlagemodule_ibfk_2` FOREIGN KEY (`modulid`) REFERENCES `modul` (`modulid`);

--
-- Constraints der Tabelle `lernfelderschwerpunktthemen`
--
ALTER TABLE `lernfelderschwerpunktthemen`
  ADD CONSTRAINT `lernfelderschwerpunktthemen_ibfk_1` FOREIGN KEY (`lernfeldid`) REFERENCES `lernfelder` (`lernfeldid`),
  ADD CONSTRAINT `lernfelderschwerpunktthemen_ibfk_2` FOREIGN KEY (`schwerpunktthemenid`) REFERENCES `schwerpunktthemen` (`schwerpunktthemenid`);

--
-- Constraints der Tabelle `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`dauerid`) REFERENCES `moduldauer` (`dauerid`);

--
-- Constraints der Tabelle `modullernfelder`
--
ALTER TABLE `modullernfelder`
  ADD CONSTRAINT `modullernfelder_ibfk_1` FOREIGN KEY (`modulid`) REFERENCES `modul` (`modulid`),
  ADD CONSTRAINT `modullernfelder_ibfk_2` FOREIGN KEY (`lernfeldid`) REFERENCES `lernfelder` (`lernfeldid`);

--
-- Constraints der Tabelle `trainerlernfelder`
--
ALTER TABLE `trainerlernfelder`
  ADD CONSTRAINT `trainerlernfelder_ibfk_1` FOREIGN KEY (`lernfeldid`) REFERENCES `lernfelder` (`lernfeldid`),
  ADD CONSTRAINT `trainerlernfelder_ibfk_2` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`);

--
-- Constraints der Tabelle `trainerschwerpunktthemen`
--
ALTER TABLE `trainerschwerpunktthemen`
  ADD CONSTRAINT `trainerschwerpunktthemen_ibfk_1` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`),
  ADD CONSTRAINT `trainerschwerpunktthemen_ibfk_2` FOREIGN KEY (`schwerpunktthemenid`) REFERENCES `schwerpunktthemen` (`schwerpunktthemenid`);

--
-- Constraints der Tabelle `trainerurlaub`
--
ALTER TABLE `trainerurlaub`
  ADD CONSTRAINT `trainerurlaub_ibfk_1` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`);

--
-- Constraints der Tabelle `trainerzeitzuweisung`
--
ALTER TABLE `trainerzeitzuweisung`
  ADD CONSTRAINT `trainerzeitzuweisung_ibfk_1` FOREIGN KEY (`zeitzuweisungid`) REFERENCES `zeitzuweisung` (`zeitzuweisungid`),
  ADD CONSTRAINT `trainerzeitzuweisung_ibfk_2` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
