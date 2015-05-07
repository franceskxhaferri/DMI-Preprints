-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mag 07, 2015 alle 22:26
-- Versione del server: 5.6.24-0ubuntu2
-- PHP Version: 5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dmipreprints`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `AUTORI`
--

CREATE TABLE IF NOT EXISTS `AUTORI` (
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `AUTORI_BACKUP`
--

CREATE TABLE IF NOT EXISTS `AUTORI_BACKUP` (
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `DATA_ULTIMO_LANCIO`
--

CREATE TABLE IF NOT EXISTS `DATA_ULTIMO_LANCIO` (
  `data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `DATA_ULTIMO_LANCIO`
--

INSERT INTO `DATA_ULTIMO_LANCIO` (`data`) VALUES
('2015-05-07 22:23');

-- --------------------------------------------------------

--
-- Struttura della tabella `PREPRINTS`
--

CREATE TABLE IF NOT EXISTS `PREPRINTS` (
  `id_pubblicazione` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `titolo` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_pubblicazione` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `autori` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `referenze` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `commenti` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `abstract` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bin_data` longblob,
  `Filename` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Filesize` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Filetype` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `PREPRINTS_ARCHIVIATI`
--

CREATE TABLE IF NOT EXISTS `PREPRINTS_ARCHIVIATI` (
  `id_pubblicazione` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `titolo` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_pubblicazione` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `autori` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `referenze` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `commenti` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `abstract` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bin_data` longblob,
  `Filename` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Filesize` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Filetype` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione`
--

CREATE TABLE IF NOT EXISTS `sessione` (
  `attivo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sessione`
--

INSERT INTO `sessione` (`attivo`) VALUES
('0');

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione_data`
--

CREATE TABLE IF NOT EXISTS `sessione_data` (
  `data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sessione_data`
--

INSERT INTO `sessione_data` (`data`) VALUES
('20150507');

-- --------------------------------------------------------

--
-- Struttura della tabella `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AUTORI`
--
ALTER TABLE `AUTORI`
 ADD PRIMARY KEY (`nome`);

--
-- Indexes for table `AUTORI_BACKUP`
--
ALTER TABLE `AUTORI_BACKUP`
 ADD PRIMARY KEY (`nome`);

--
-- Indexes for table `DATA_ULTIMO_LANCIO`
--
ALTER TABLE `DATA_ULTIMO_LANCIO`
 ADD PRIMARY KEY (`data`);

--
-- Indexes for table `PREPRINTS`
--
ALTER TABLE `PREPRINTS`
 ADD PRIMARY KEY (`id_pubblicazione`);

--
-- Indexes for table `PREPRINTS_ARCHIVIATI`
--
ALTER TABLE `PREPRINTS_ARCHIVIATI`
 ADD PRIMARY KEY (`id_pubblicazione`);

--
-- Indexes for table `sessione`
--
ALTER TABLE `sessione`
 ADD PRIMARY KEY (`attivo`);

--
-- Indexes for table `sessione_data`
--
ALTER TABLE `sessione_data`
 ADD PRIMARY KEY (`data`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
 ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
