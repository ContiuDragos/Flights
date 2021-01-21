-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 03, 2021 la 09:47 PM
-- Versiune server: 10.4.16-MariaDB
-- Versiune PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `colocviu_final`
--

DELIMITER $$
--
-- Proceduri
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Procedure_5a` (IN `clasa_efectiva` VARCHAR(255))  BEGIN
	SELECT nume
			  FROM clienti NATURAL JOIN Bilete
			  WHERE clasa=clasa_efectiva AND valoare<=ALL(SELECT valoare FROM bilete WHERE clasa=clasa_efectiva);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `bilete`
--

CREATE TABLE `bilete` (
  `nr_bilet` int(6) NOT NULL,
  `clasa` varchar(20) DEFAULT NULL,
  `valoare` int(6) DEFAULT NULL,
  `sursa` varchar(20) DEFAULT NULL,
  `destinatia` varchar(20) DEFAULT NULL,
  `id_client` int(6) DEFAULT NULL
) ;

--
-- Eliminarea datelor din tabel `bilete`
--

INSERT INTO `bilete` (`nr_bilet`, `clasa`, `valoare`, `sursa`, `destinatia`, `id_client`) VALUES
(100, 'Economic', 590, 'Roma', 'Cluj-Napoca', 1),
(101, 'Economic', 320, 'Cluj-Napoca', 'Madrid', 2),
(102, 'Business', 570, 'Roma', 'Madrid', 3),
(103, 'Business', 770, 'Munchen', 'Cluj-Napoca', 4),
(104, 'Economic', 245, 'Cluj-Napoca', 'Roma', 5),
(105, 'Economic', 260, 'Munchen', 'Madrid', 4),
(106, 'Business', 569, 'A', 'B', 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `clienti`
--

CREATE TABLE `clienti` (
  `id_client` int(6) NOT NULL,
  `nume` varchar(20) DEFAULT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `adresa` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `clienti`
--

INSERT INTO `clienti` (`id_client`, `nume`, `statut`, `adresa`, `email`) VALUES
(1, 'Jean Radu', 'C', 'Str. Parang, Nr. 55, Cluj-Napoca', 'jean@yahoo.com'),
(2, 'Carol George', 'C', 'Str. Pacii, Nr. 81, Alba Iulia', 'carol@yahoo.ro'),
(3, 'Marin Marius', 'VIP', 'Str. Plutei, Nr. 11, Satu Mare', 'marin@gmail.com'),
(4, 'Petru Rares', 'VIP', 'Str. Armoniei, Nr. 57, Craiova', 'petru@gmail.com'),
(5, 'Antochi Grigore', 'C', 'Str. Ceahlau, Nr. 30, Timisoara', 'antochi@yahoo.ro'),
(6, 'Berbec Petru', 'C', 'Str. Giurgiu Nr.77 Arad', 'Berbec@gmail.com');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cupoane`
--

CREATE TABLE `cupoane` (
  `nr_bilet` int(6) NOT NULL,
  `nr_zbor` varchar(10) NOT NULL,
  `plecare` datetime NOT NULL,
  `clasa_efectiva` varchar(20) DEFAULT NULL,
  `loc` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `cupoane`
--

INSERT INTO `cupoane` (`nr_bilet`, `nr_zbor`, `plecare`, `clasa_efectiva`, `loc`) VALUES
(100, 'FSZ111', '2019-12-12 19:00:00', 'Economic', 14),
(100, 'LHP547', '2019-12-12 23:00:00', 'Economic', 23),
(102, 'FSZ111', '2019-12-12 19:00:00', 'Business', 45),
(102, 'LHP547', '2019-12-12 23:00:00', 'Business', 93),
(103, 'LHA243', '2019-12-12 11:00:00', 'Economic', 57),
(103, 'LHP547', '2019-12-12 23:00:00', 'Business', 9),
(105, 'AIF213', '2019-09-15 14:15:00', 'Economic', 11),
(106, 'AIF213', '2019-09-15 14:15:00', 'Business', 63);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `zboruri`
--

CREATE TABLE `zboruri` (
  `nr_zbor` varchar(10) NOT NULL,
  `plecare` datetime NOT NULL,
  `sosire` datetime DEFAULT NULL,
  `de_la` varchar(20) DEFAULT NULL,
  `la` varchar(20) DEFAULT NULL,
  `aparat_zbor` varchar(20) DEFAULT NULL,
  `nr_locuri` int(6) DEFAULT NULL
) ;

--
-- Eliminarea datelor din tabel `zboruri`
--

INSERT INTO `zboruri` (`nr_zbor`, `plecare`, `sosire`, `de_la`, `la`, `aparat_zbor`, `nr_locuri`) VALUES
('AIF213', '2019-09-15 14:15:00', '2019-09-15 16:15:00', 'A', 'B', 'BOEING777', 300),
('AIF213', '2019-09-30 14:00:00', '2019-09-30 16:25:00', 'A', 'B', 'AIRBUS 310-325', 100),
('FSZ111', '2019-12-12 19:00:00', '2019-12-12 21:00:00', 'Roma', 'Munchen', 'BOEING779', 300),
('LHA243', '2019-12-12 11:00:00', '2019-12-12 14:00:00', 'Cluj-Napoca', 'Roma', 'AIRBUS330', 215),
('LHP547', '2019-12-12 23:00:00', '0000-00-00 00:00:00', 'Munchen', 'Cluj-Napoca', 'AIRBUS330', 215),
('PRS451', '2019-12-12 13:00:00', '2019-12-12 15:00:00', 'Cluj-Napoca', 'Madrid', 'BOEING779', 300),
('PSN159', '2019-12-12 23:30:00', '2019-12-13 01:30:00', 'Munchen', 'Roma', 'BOEING750', 290),
('TGI739', '2019-12-13 05:00:00', '2019-12-13 07:00:00', 'Madrid', 'Roma', 'BOEING750', 290);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `bilete`
--
ALTER TABLE `bilete`
  ADD PRIMARY KEY (`nr_bilet`);

--
-- Indexuri pentru tabele `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexuri pentru tabele `cupoane`
--
ALTER TABLE `cupoane`
  ADD PRIMARY KEY (`nr_bilet`,`nr_zbor`,`plecare`),
  ADD KEY `cupoane_fk` (`nr_zbor`,`plecare`);

--
-- Indexuri pentru tabele `zboruri`
--
ALTER TABLE `zboruri`
  ADD PRIMARY KEY (`nr_zbor`,`plecare`);

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `cupoane`
--
ALTER TABLE `cupoane`
  ADD CONSTRAINT `cupoane_fk` FOREIGN KEY (`nr_zbor`,`plecare`) REFERENCES `zboruri` (`nr_zbor`, `plecare`),
  ADD CONSTRAINT `cupoane_nr_bilet_fk` FOREIGN KEY (`nr_bilet`) REFERENCES `bilete` (`nr_bilet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
