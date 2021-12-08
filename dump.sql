-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Dic 08, 2021 alle 11:50
-- Versione del server: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- Versione PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcazzaro`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Impianti`
--

DROP TABLE IF EXISTS `Impianti`;
CREATE TABLE IF NOT EXISTS `Impianti` (
  `Impianto` varchar(15) NOT NULL,
  `Aperto` tinyint(1) NOT NULL,
  `Tipo` enum('Skilift','Seggiovia','Funivia','Ovovia') NOT NULL,
  PRIMARY KEY (`Impianto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Svuota la tabella prima dell'inserimento `Impianti`
--

TRUNCATE TABLE `Impianti`;
--
-- Dump dei dati per la tabella `Impianti`
--

INSERT INTO `Impianti` (`Impianto`, `Aperto`, `Tipo`) VALUES
('5 Torri', 0, 'Seggiovia'),
('Civettina', 0, 'Skilift'),
('Col Ripido', 1, 'Seggiovia'),
('Il Veloce', 1, 'Ovovia'),
('La Parete', 1, 'Funivia');

-- --------------------------------------------------------

--
-- Struttura della tabella `Piste`
--

DROP TABLE IF EXISTS `Piste`;
CREATE TABLE IF NOT EXISTS `Piste` (
  `Pista` varchar(15) NOT NULL,
  `Lunghezza` double NOT NULL,
  `Aperta` tinyint(1) NOT NULL,
  `Difficolta` enum('Blu','Rossa','Nera') NOT NULL,
  PRIMARY KEY (`Pista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Svuota la tabella prima dell'inserimento `Piste`
--

TRUNCATE TABLE `Piste`;
--
-- Dump dei dati per la tabella `Piste`
--

INSERT INTO `Piste` (`Pista`, `Lunghezza`, `Aperta`, `Difficolta`) VALUES
('Baby', 0.8, 1, 'Blu'),
('Diretta Valle', 2.8, 0, 'Nera'),
('Il muro', 3.4, 1, 'Nera'),
('Panoramica 1', 5.6, 0, 'Blu'),
('Sas Lung', 4.6, 1, 'Rossa'),
('Stella Alpina', 7.1, 0, 'Rossa');

-- --------------------------------------------------------

--
-- Struttura della tabella `Skipass`
--

DROP TABLE IF EXISTS `Skipass`;
CREATE TABLE IF NOT EXISTS `Skipass` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(20) NOT NULL,
  `Prezzo` double NOT NULL,
  `Durata` int(11) NOT NULL,
  `Tipo` enum('Intero','Ridotto') NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Svuota la tabella prima dell'inserimento `Skipass`
--

TRUNCATE TABLE `Skipass`;
--
-- Dump dei dati per la tabella `Skipass`
--

INSERT INTO `Skipass` (`Id`, `Nome`, `Prezzo`, `Durata`, `Tipo`) VALUES
(1, 'Giornaliero', 45, 1, 'Intero'),
(2, 'Giornaliero ridotto', 35, 1, 'Ridotto'),
(3, 'Tre giorni', 120, 3, 'Intero'),
(4, 'Tre giorni', 100, 3, 'Ridotto'),
(5, 'Settimanale', 260, 7, 'Intero'),
(6, 'Settimanale ridotto', 210, 7, 'Ridotto');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

DROP TABLE IF EXISTS `Utenti`;
CREATE TABLE IF NOT EXISTS `Utenti` (
  `Username` varchar(20) NOT NULL,
  `Password` char(64) NOT NULL,
  `Privilegi` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Svuota la tabella prima dell'inserimento `Utenti`
--

TRUNCATE TABLE `Utenti`;
--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`Username`, `Password`, `Privilegi`) VALUES
('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1),
('user', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;