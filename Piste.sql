-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Dic 15, 2021 alle 19:03
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
-- Database: `rcontin`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Piste`
--

CREATE TABLE `Piste` (
  `numero` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `difficoltà` enum('Blu','Rossa','Nera') NOT NULL,
  `lunghezza` int(11) NOT NULL,
  `dislivello` int(11) NOT NULL,
  `descrizione` longtext DEFAULT NULL,
  `stato` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Piste`
--

INSERT INTO `Piste` (`numero`, `nome`, `difficoltà`, `lunghezza`, `dislivello`, `descrizione`, `stato`) VALUES
(72, 'Baby 1', 'Blu', 150, 20, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 1),
(73, 'Red 1', 'Rossa', 800, 235, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(74, 'Baby 2', 'Blu', 4500, 550, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(75, 'Red 2', 'Rossa', 700, 75, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(76, 'Baby 3', 'Blu', 800, 42, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(77, 'Baby 4', 'Blu', 1200, 200, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(78, 'Baby 5', 'Blu', 1500, 105, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(79, 'Red 3', 'Rossa', 1700, 320, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(80, 'Black 1', 'Nera', 1700, 320, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(81, 'Black 2', 'Nera', 3000, 625, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(82, 'Red 4', 'Rossa', 2400, 490, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(83, 'Red 5', 'Rossa', 1900, 390, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(84, 'Baby 6', 'Blu', 1750, 30, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(85, 'Baby 7', 'Blu', 150, 25, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(86, 'Baby 8', 'Blu', 1000, 100, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(87, 'Red 6', 'Rossa', 2500, 420, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0),
(88, 'Red 7', 'Rossa', 600, 190, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Piste`
--
ALTER TABLE `Piste`
  ADD PRIMARY KEY (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
