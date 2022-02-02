-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Feb 02, 2022 alle 16:25
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
-- Struttura della tabella `Carrelli`
--

CREATE TABLE `Carrelli` (
  `utente` varchar(20) NOT NULL,
  `tipo_skipass` varchar(20) NOT NULL,
  `durata_skipass` int(11) NOT NULL,
  `data_inizio` date NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Carrelli`
--

INSERT INTO `Carrelli` (`utente`, `tipo_skipass`, `durata_skipass`, `data_inizio`, `quantita`) VALUES
('user', 'Intero', 1, '2022-02-02', 1),
('user', 'Intero', 1, '2022-02-04', 1),
('user', 'Intero', 3, '2022-01-23', 3),
('user', 'Ridotto', 1, '2022-02-04', 0),
('user', 'Ridotto', 3, '2022-01-23', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `DurataSkipass`
--

CREATE TABLE `DurataSkipass` (
  `durata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `DurataSkipass`
--

INSERT INTO `DurataSkipass` (`durata`) VALUES
(1),
(3),
(7);

-- --------------------------------------------------------

--
-- Struttura della tabella `Impianti`
--

CREATE TABLE `Impianti` (
  `numero` varchar(15) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `stato` tinyint(1) NOT NULL,
  `tipo` enum('Skilift','Seggiovia','Funivia','Ovovia') NOT NULL,
  `lunghezza` int(11) NOT NULL,
  `dislivello` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Impianti`
--

INSERT INTO `Impianti` (`numero`, `nome`, `stato`, `tipo`, `lunghezza`, `dislivello`) VALUES
('1', 'Valle Bianca', 1, 'Ovovia', 560, 2000),
('1a', 'Valle Bianca Piste', 1, 'Ovovia', 2200, 2000),
('2', 'Cermis', 0, 'Ovovia', 2440, 2400),
('3', 'Costabella', 0, 'Seggiovia', 1700, 2200),
('4', 'Lagorai', 1, 'Seggiovia', 1050, 2000),
('5', 'Prafiorì', 1, 'Seggiovia', 1750, 1800),
('6', 'Baby Skilift', 1, 'Skilift', 160, 25);

-- --------------------------------------------------------

--
-- Struttura della tabella `Ordini`
--

CREATE TABLE `Ordini` (
  `id` int(11) NOT NULL,
  `utente` varchar(20) NOT NULL,
  `data_ordine` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Ordini`
--

INSERT INTO `Ordini` (`id`, `utente`, `data_ordine`) VALUES
(7, 'leo', '2022-01-05 13:28:31'),
(8, 'leo', '2022-01-05 13:31:09'),
(9, 'user', '2022-01-14 12:58:25'),
(10, 'user', '2022-01-14 12:58:27'),
(11, 'user', '2022-01-14 12:58:29'),
(12, 'admin', '2022-01-19 14:35:36'),
(13, 'admin', '2022-01-19 14:41:49'),
(14, 'admin', '2022-01-19 14:41:52'),
(15, 'admin', '2022-01-19 14:41:52'),
(16, 'admin', '2022-01-19 14:41:53'),
(17, 'admin', '2022-01-19 14:42:05'),
(18, 'admin', '2022-01-19 14:42:06'),
(19, 'admin', '2022-01-19 14:42:08'),
(20, 'admin', '2022-01-19 14:42:11'),
(21, 'admin', '2022-01-20 00:17:07'),
(22, 'admin', '2022-01-26 12:02:15'),
(23, 'admin', '2022-01-26 12:06:05'),
(24, 'admin', '2022-01-26 12:06:11'),
(25, 'admin', '2022-01-26 12:06:43'),
(26, 'admin', '2022-01-30 10:48:37'),
(27, 'admin', '2022-01-31 14:04:11'),
(28, 'admin', '2022-01-31 14:05:15'),
(29, 'admin', '2022-01-31 14:05:31'),
(30, 'admin', '2022-01-31 14:53:42'),
(31, 'admin', '2022-01-31 15:07:30'),
(32, 'admin', '2022-01-31 16:35:59'),
(33, 'admin', '2022-01-31 16:36:07'),
(34, 'admin', '2022-01-31 16:37:05'),
(35, 'admin', '2022-01-31 16:54:37'),
(36, 'admin', '2022-02-01 18:05:27'),
(37, 'admin', '2022-02-02 13:10:08');

-- --------------------------------------------------------

--
-- Struttura della tabella `Piste`
--

CREATE TABLE `Piste` (
  `numero` varchar(11) NOT NULL,
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
('72', 'Campo Scuola Valle Bianca', 'Blu', 150, 20, 'Questa è la prima piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 1),
('73', 'Carlo Donei', 'Rossa', 800, 235, 'Questa pista è molto divertente perché contiene alcuni tratti pendenti che permettono di accumulare un bel po\' di velocità. La pista rimane comunque non particolarmente complicata anche se per i principianti è necessario procedere con cautela.', 0),
('74', 'Via del Bosco', 'Blu', 4500, 550, 'Pista meravigliosa che attraversa un bosco pieno di alberi di varie dimensioni e che alterna tratti divertenti a tratti più pianeggianti. Quest\'ultimi permettono di osservare la flora e la fauna che in alcune giornate risulta sorprendente.', 0),
('75', 'Forcella Bombasel', 'Rossa', 700, 75, 'Questa breve pista è adatta a tutti e consente di raggiungere Lo Chalet, uno degli ottimi punti di ristoro che offre la Valle Bianca. La pista successivamente si collega a due piste fantastiche: Busabella e Prafiorì.', 1),
('76', 'Prafiorì-Costabella', 'Blu', 800, 42, 'Questo collegamento permette di tornare alla seggiovia Costabella, offrendo allo stesso tempo una pista rilassante e molto semplice.', 1),
('77', 'Lagorai', 'Blu', 1200, 200, 'Se una visuale mozzafiato non vuoi perderti, questa è la pista che devi fare.\r\nUna bellissima panoramica che non annoia e che invita a sciare con la testa alta.', 0),
('78', 'Variante dei Cirmi', 'Blu', 1500, 105, 'Se la Lagorai ti stanca questa variante fa al caso tuo. Pista meno panoramica e più veloce ma adatta a tutti.', 1),
('79', 'Costabella', 'Rossa', 1700, 320, 'Questa è una versione semplificata della Olimpia che in un tratto passa sotto l\'omonima seggiovia. Attenzione al bivio, da una parte continua la pista, dall\'altra si raggiunge l\'Olimpia.', 1),
('80', 'Olimpia', 'Nera', 1700, 320, 'Questa pista è consigliata ai sciatori esperti. Presenta dei tratti in cui si raccomanda di sciare con attenzione per sé stessi e per gli altri senza esagerare. ', 1),
('81', 'Olimpia 2', 'Nera', 3000, 625, 'Se terminata l\'Olimpia avete ancora energia c\'è la possibilità di proseguire nella sua seconda parte meno impegnativa ma con tratti non adatti a tutti. I primi metri permettono anche di raggiungere un collegamento per la Via del Bosco.', 1),
('82', 'Prafiorì', 'Rossa', 2400, 490, 'Pista molto divertente che permette di fare diverse scelte, infatti, si può proseguire fino alla fine, si può raggiungere Costabella tramite Prafiorì-Costabella e si può deviare verso Salera.', 0),
('83', 'Salera', 'Rossa', 1900, 390, 'Pista mozzafiato da fare senza pause per godersela al massimo prestando attenzione alla fine a chi arriva da Prafiorì.', 1),
('84', 'Costabella-Prafiorì', 'Blu', 1750, 30, 'Collegamento parallelo e di senso opposto per raggiungere Prafiorì da Costabella. Pista breve e quasi pianeggiante ma che non obbliga a fare fatica.', 1),
('85', 'Campo Scuola Cermis', 'Blu', 150, 25, 'Questa è la seconda piccola pista consigliata a tutti coloro che non hanno mai usato l\'attrezzatura da sci o a coloro che vogliono fare un po\' di riscaldamento.\r\nDedicata principalmente a bambini e principianti, meglio se accompagnati dai nostri maestri.', 1),
('86', 'Lagorai-Costabella', 'Blu', 1000, 100, 'Questa è il collegamento per raggiungere Costabella dopo aver fatto più volte la panoramica e la sua variante. ', 1),
('87', 'Olimpia 3', 'Rossa', 2500, 420, 'Unica pista che consente di tornare al punto di partenza. La sua peculiarità è che in alcuni periodi permette lo sci notturno per un\'esperienza imperdibile.', 0),
('88', 'Busabella', 'Rossa', 600, 190, 'Breve pista che si collega a Prafiorì. Come difficoltà è quasi una nera ma la sua larghezza consente di venire giù senza alcun problema. ', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Skipass`
--

CREATE TABLE `Skipass` (
  `Prezzo` double NOT NULL,
  `Durata` int(11) NOT NULL,
  `Tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Skipass`
--

INSERT INTO `Skipass` (`Prezzo`, `Durata`, `Tipo`) VALUES
(64, 1, 'Intero'),
(58, 1, 'Ridotto'),
(130, 3, 'Intero'),
(100, 3, 'Ridotto'),
(248.99, 7, 'Intero'),
(220.11, 7, 'Ridotto');

-- --------------------------------------------------------

--
-- Struttura della tabella `SkipassOrdinati`
--

CREATE TABLE `SkipassOrdinati` (
  `id_ordine` int(11) NOT NULL,
  `tipo_skipass` varchar(20) NOT NULL,
  `durata_skipass` int(11) NOT NULL,
  `data_inizio` date NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `SkipassOrdinati`
--

INSERT INTO `SkipassOrdinati` (`id_ordine`, `tipo_skipass`, `durata_skipass`, `data_inizio`, `quantita`) VALUES
(7, 'Intero', 3, '2021-01-05', 32),
(7, 'Intero', 3, '2022-01-05', 4),
(7, 'Intero', 3, '2022-01-06', 5),
(7, 'Intero', 3, '2022-01-07', 1),
(7, 'Intero', 3, '2022-01-13', 5),
(7, 'Intero', 3, '2022-01-15', 3),
(7, 'Intero', 7, '2022-01-13', 3),
(7, 'Intero', 7, '2022-01-20', 0),
(7, 'Intero', 7, '2022-01-27', 2),
(7, 'Ridotto', 3, '2021-01-05', 3),
(7, 'Ridotto', 3, '2022-01-05', 1),
(7, 'Ridotto', 3, '2022-01-06', 1),
(7, 'Ridotto', 3, '2022-01-07', 0),
(7, 'Ridotto', 3, '2022-01-15', 0),
(7, 'Ridotto', 7, '2022-01-02', 20),
(7, 'Ridotto', 7, '2022-01-13', 6),
(7, 'Ridotto', 7, '2022-01-20', 3),
(7, 'Ridotto', 7, '2022-01-27', 2),
(8, 'Intero', 1, '2022-01-20', 0),
(8, 'Intero', 3, '2022-01-07', 4),
(8, 'Intero', 7, '2022-01-07', 9),
(8, 'Ridotto', 1, '2022-01-20', 13),
(8, 'Ridotto', 3, '2022-01-07', 1),
(8, 'Ridotto', 7, '2022-01-07', 0),
(9, 'Intero', 1, '2022-01-13', 3),
(9, 'Ridotto', 1, '2022-01-13', 1),
(12, 'Intero', 1, '2022-01-06', 2),
(12, 'Intero', 1, '2022-01-11', 1),
(12, 'Intero', 3, '2021-12-30', 2),
(12, 'Intero', 3, '2021-12-31', 4),
(12, 'Intero', 3, '2022-01-06', 49),
(12, 'Intero', 3, '2022-01-07', 9),
(12, 'Intero', 3, '2022-01-12', 21),
(12, 'Intero', 3, '2022-01-13', 3),
(12, 'Intero', 7, '2022-01-20', 5),
(12, 'Ridotto', 1, '2022-01-06', 0),
(12, 'Ridotto', 3, '2021-12-30', 1),
(12, 'Ridotto', 3, '2021-12-31', 8),
(12, 'Ridotto', 3, '2022-01-06', 16),
(12, 'Ridotto', 3, '2022-01-07', 3),
(12, 'Ridotto', 7, '2022-01-20', 1),
(13, 'Intero', 1, '2022-01-27', 1),
(13, 'Ridotto', 1, '2022-01-27', 1),
(21, 'Intero', 3, '2022-01-21', 5),
(21, 'Intero', 3, '2022-01-27', 2),
(21, 'Ridotto', 3, '2022-01-21', 11),
(21, 'Ridotto', 3, '2022-01-27', 0),
(22, 'Intero', 1, '2022-01-27', 1),
(22, 'Intero', 1, '2222-02-22', 1),
(22, 'Intero', 3, '2022-01-29', 6),
(22, 'Intero', 7, '2022-01-22', 2),
(22, 'Ridotto', 1, '2022-01-27', 0),
(22, 'Ridotto', 1, '2222-02-22', 0),
(22, 'Ridotto', 3, '2022-01-29', 0),
(22, 'Ridotto', 7, '2022-01-22', 5),
(23, 'Intero', 3, '2022-01-28', 2),
(23, 'Ridotto', 3, '2022-01-28', 0),
(25, 'Intero', 3, '2022-01-28', 2),
(25, 'Ridotto', 3, '2022-01-28', 0),
(26, 'Intero', 1, '2022-01-29', 3),
(26, 'Intero', 3, '2022-01-29', 6),
(26, 'Ridotto', 1, '2022-01-29', 1),
(26, 'Ridotto', 3, '2022-01-29', 0),
(27, 'Intero', 3, '2022-03-10', 3),
(27, 'Ridotto', 3, '2022-03-10', 0),
(28, 'Intero', 3, '2022-02-03', 3),
(28, 'Ridotto', 3, '2022-02-03', 0),
(29, 'Intero', 3, '2022-02-03', 3),
(30, 'Ridotto', 1, '2022-02-04', 3),
(31, 'Intero', 1, '2022-02-05', 2),
(31, 'Ridotto', 1, '2022-02-05', 3),
(32, 'Intero', 1, '2022-02-25', 2),
(32, 'Intero', 3, '2022-02-04', 2),
(32, 'Intero', 3, '2022-02-19', 5),
(32, 'Intero', 7, '2022-02-23', 4),
(32, 'Ridotto', 1, '2022-02-25', 3),
(32, 'Ridotto', 7, '2022-02-23', 7),
(34, 'Intero', 1, '2022-02-05', 1),
(34, 'Intero', 3, '2022-02-05', 3),
(34, 'Intero', 7, '2022-02-05', 3),
(34, 'Ridotto', 1, '2022-02-05', 3),
(34, 'Ridotto', 7, '2022-02-05', 4),
(35, 'Intero', 1, '2022-02-19', 5),
(35, 'Intero', 3, '2022-02-19', 3),
(35, 'Intero', 7, '2022-02-19', 2),
(35, 'Ridotto', 1, '2022-02-19', 2),
(35, 'Ridotto', 3, '2022-02-19', 2),
(35, 'Ridotto', 7, '2022-02-19', 5),
(36, 'Intero', 3, '2022-02-18', 2),
(36, 'Intero', 3, '2023-03-01', 3),
(36, 'Ridotto', 3, '2023-03-01', 1),
(37, 'Intero', 1, '2022-02-02', 3),
(37, 'Intero', 3, '2022-02-01', 1),
(37, 'Ridotto', 1, '2022-02-02', 1),
(37, 'Ridotto', 3, '2022-02-01', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `TipoSkipass`
--

CREATE TABLE `TipoSkipass` (
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `TipoSkipass`
--

INSERT INTO `TipoSkipass` (`tipo`) VALUES
('Intero'),
('Ridotto');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `Username` varchar(20) NOT NULL,
  `Password` char(64) NOT NULL,
  `Privilegi` tinyint(1) NOT NULL DEFAULT 0,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`Username`, `Password`, `Privilegi`, `Email`) VALUES
('1234', '$2y$10$sLwd32Qj3o.TdJWvB4DtouoJXVjJVz.0o/gRnNw.Ca145OaksHIm.', 0, 'email@emailvuota.it'),
('admin', '$2y$10$hcm3TRCYlYdV2r4Ys65GAuNAOthOgB0j0GN69Ud1tY2U3BMPIWgoS', 1, 'admin@vallebianca.it'),
('Ciaomondo1!', '$2y$10$JpxsTT/D5XgoA7Mz8g0uo.uWrsuydqpKoMZyKxg1JJM.5/oP4AFfe', 0, 'ciaomondo@ciao.it'),
('jesus', '$2y$10$/7JWDZzuSryvXyeNY7diSu.yNUPcrTpzWKVbXTCrP48RLV6uba0aC', 0, 'email@emailvuota2.it'),
('leo', '$2y$10$kmK8r0HoEf9cPIM061eEPuMJ6QsnOOzzE3FBYE.4e4xGeRHjelGDi', 0, 'email@emailvuota2.it'),
('marioneGiudaco1', '$2y$10$nIXaDkbVoCVh7YFWHEuBdu.OSVnHOscZqY8HljnFSoCodYHQKF35u', 0, 'email@emailvuota4.it'),
('testUser1', '$2y$10$KAx3LD7NaB57gxbiaURVI.v1A/GmHXD/IGUOTQq4azSuF1XYlosQG', 0, 'marionegiudone2@gmao.it'),
('user', '$2y$10$uuN7skVSPfpoUolt80NSnOzK/BTdAsyyvYH.xrwLFzGiqgJBUnxDy', 0, 'user@gmail.com'),
('utenteProva1', '$2y$10$vi3K7e3LmvMbIDJxEOxgVOejDf91yKy/hkZWIW1rENePLOhkYnBUe', 0, 'email@emailvuota5.it'),
('utenteProva2', '$2y$10$BrcbEwkEZhc4F8ixTvlPH.DkiIDGGoMdKbS0.e9Q78cFN1J4V9v5S', 0, 'email@emailvuota6.it');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Carrelli`
--
ALTER TABLE `Carrelli`
  ADD PRIMARY KEY (`utente`,`tipo_skipass`,`durata_skipass`,`data_inizio`),
  ADD KEY `tipo_skipass` (`tipo_skipass`,`durata_skipass`);

--
-- Indici per le tabelle `DurataSkipass`
--
ALTER TABLE `DurataSkipass`
  ADD PRIMARY KEY (`durata`);

--
-- Indici per le tabelle `Impianti`
--
ALTER TABLE `Impianti`
  ADD PRIMARY KEY (`numero`);

--
-- Indici per le tabelle `Ordini`
--
ALTER TABLE `Ordini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente` (`utente`);

--
-- Indici per le tabelle `Piste`
--
ALTER TABLE `Piste`
  ADD PRIMARY KEY (`numero`);

--
-- Indici per le tabelle `Skipass`
--
ALTER TABLE `Skipass`
  ADD PRIMARY KEY (`Durata`,`Tipo`),
  ADD KEY `Tipo` (`Tipo`);

--
-- Indici per le tabelle `SkipassOrdinati`
--
ALTER TABLE `SkipassOrdinati`
  ADD PRIMARY KEY (`id_ordine`,`tipo_skipass`,`durata_skipass`,`data_inizio`),
  ADD KEY `durata_skipass` (`durata_skipass`),
  ADD KEY `tipo_skipass` (`tipo_skipass`,`durata_skipass`);

--
-- Indici per le tabelle `TipoSkipass`
--
ALTER TABLE `TipoSkipass`
  ADD PRIMARY KEY (`tipo`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Ordini`
--
ALTER TABLE `Ordini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Carrelli`
--
ALTER TABLE `Carrelli`
  ADD CONSTRAINT `Carrelli_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `Utenti` (`Username`),
  ADD CONSTRAINT `Carrelli_ibfk_2` FOREIGN KEY (`tipo_skipass`,`durata_skipass`) REFERENCES `Skipass` (`Tipo`, `Durata`);

--
-- Limiti per la tabella `Ordini`
--
ALTER TABLE `Ordini`
  ADD CONSTRAINT `Ordini_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `Utenti` (`Username`);

--
-- Limiti per la tabella `Skipass`
--
ALTER TABLE `Skipass`
  ADD CONSTRAINT `Skipass_ibfk_1` FOREIGN KEY (`Tipo`) REFERENCES `TipoSkipass` (`tipo`),
  ADD CONSTRAINT `Skipass_ibfk_2` FOREIGN KEY (`Durata`) REFERENCES `DurataSkipass` (`durata`);

--
-- Limiti per la tabella `SkipassOrdinati`
--
ALTER TABLE `SkipassOrdinati`
  ADD CONSTRAINT `SkipassOrdinati_ibfk_3` FOREIGN KEY (`id_ordine`) REFERENCES `Ordini` (`id`),
  ADD CONSTRAINT `SkipassOrdinati_ibfk_4` FOREIGN KEY (`tipo_skipass`,`durata_skipass`) REFERENCES `Skipass` (`Tipo`, `Durata`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
