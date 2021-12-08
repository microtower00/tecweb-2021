-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Dic 08, 2021 alle 10:37
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

CREATE TABLE `Impianti` (
  `Impianto` varchar(15) NOT NULL,
  `Aperto` tinyint(1) NOT NULL,
  `Tipo` enum('Skilift','Seggiovia','Funivia','Ovovia') NOT NULL
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

CREATE TABLE `Piste` (
  `Pista` varchar(15) NOT NULL,
  `Lunghezza` double NOT NULL,
  `Aperta` tinyint(1) NOT NULL,
  `Difficolta` enum('Blu','Rossa','Nera') NOT NULL
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

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Impianti`
--
ALTER TABLE `Impianti`
  ADD PRIMARY KEY (`Impianto`);

--
-- Indici per le tabelle `Piste`
--
ALTER TABLE `Piste`
  ADD PRIMARY KEY (`Pista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;