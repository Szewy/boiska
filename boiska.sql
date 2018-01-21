-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 21 Sty 2018, 23:13
-- Wersja serwera: 5.6.27
-- Wersja PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `boiska`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `boiska`
--

CREATE TABLE `boiska` (
  `id_boiska` int(10) UNSIGNED NOT NULL,
  `id_typu` int(10) UNSIGNED NOT NULL,
  `powierzchnia` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `boiska`
--

INSERT INTO `boiska` (`id_boiska`, `id_typu`, `powierzchnia`) VALUES
(1, 1, 120),
(2, 2, 80),
(3, 2, 90),
(4, 3, 122),
(5, 5, 32),
(6, 5, 73),
(7, 3, 38),
(8, 4, 43),
(9, 4, 78),
(10, 3, 233),
(11, 2, 100),
(12, 1, 120),
(13, 1, 7140),
(14, 1, 7140),
(15, 2, 288),
(16, 1, 7140),
(17, 2, 500),
(18, 3, 322),
(19, 1, 7140),
(20, 1, 7140),
(21, 1, 21222),
(22, 2, 6999999),
(23, 2, 6999999),
(24, 2, 6999999),
(25, 4, 22222),
(26, 4, 2122),
(27, 1, 4324324),
(28, 2, 454543543);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grafik`
--

CREATE TABLE `grafik` (
  `id_grafiku` int(10) UNSIGNED NOT NULL,
  `id_pracownika` int(10) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `godzina_od` time NOT NULL,
  `godzina_do` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `grafik`
--

INSERT INTO `grafik` (`id_grafiku`, `id_pracownika`, `data`, `godzina_od`, `godzina_do`) VALUES
(1, 1, '2018-01-19', '08:00:00', '22:00:00'),
(2, 1, '2018-01-18', '10:00:00', '18:00:00'),
(6, 1, '2018-01-22', '08:00:00', '09:00:00'),
(7, 1, '2018-01-22', '18:00:00', '22:00:00'),
(8, 1, '2018-01-22', '08:00:00', '09:00:00'),
(9, 1, '2018-01-26', '08:00:00', '09:00:00'),
(10, 2, '2018-01-28', '19:00:00', '22:00:00'),
(11, 1, '2018-01-22', '08:00:00', '22:00:00'),
(12, 1, '2018-01-22', '08:00:00', '09:00:00'),
(13, 1, '2018-01-22', '08:00:00', '09:00:00'),
(14, 1, '2018-01-22', '08:00:00', '09:00:00'),
(15, 1, '2018-01-22', '08:00:00', '09:00:00'),
(16, 1, '2018-01-22', '08:00:00', '09:00:00'),
(17, 1, '2018-01-22', '08:00:00', '09:00:00'),
(18, 1, '2018-01-22', '08:00:00', '09:00:00'),
(19, 1, '2018-01-24', '08:00:00', '09:00:00'),
(20, 1, '2018-01-22', '08:00:00', '09:00:00'),
(21, 1, '2018-01-27', '08:00:00', '09:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id_rezerwacji` int(10) UNSIGNED NOT NULL,
  `id_uzytkownika` int(10) UNSIGNED NOT NULL,
  `id_boiska` int(10) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `godzina_od` time NOT NULL,
  `godzina_do` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rezerwacje`
--

INSERT INTO `rezerwacje` (`id_rezerwacji`, `id_uzytkownika`, `id_boiska`, `data`, `godzina_od`, `godzina_do`) VALUES
(1, 1, 16, '2018-01-19', '09:00:00', '10:00:00'),
(2, 1, 16, '2018-01-19', '18:00:00', '19:00:00'),
(3, 1, 16, '2018-01-19', '13:00:00', '14:00:00'),
(5, 1, 14, '2018-01-19', '20:00:00', '21:00:00'),
(6, 1, 14, '2018-01-19', '12:00:00', '13:00:00'),
(7, 1, 14, '2018-01-19', '13:00:00', '14:00:00'),
(8, 1, 14, '2018-01-19', '14:00:00', '15:00:00'),
(9, 1, 14, '2018-01-19', '15:00:00', '16:00:00'),
(10, 1, 14, '2018-01-19', '16:00:00', '17:00:00'),
(11, 2, 1, '2018-01-19', '08:00:00', '09:00:00'),
(12, 1, 17, '2018-01-19', '17:00:00', '18:00:00'),
(13, 1, 17, '2018-01-19', '12:00:00', '13:00:00'),
(14, 1, 17, '2018-01-19', '14:00:00', '15:00:00'),
(15, 1, 17, '2018-01-19', '13:00:00', '14:00:00'),
(16, 1, 17, '2018-01-19', '11:00:00', '12:00:00'),
(17, 1, 2, '2018-01-19', '21:00:00', '22:00:00'),
(18, 1, 9, '2018-01-19', '21:00:00', '22:00:00'),
(19, 1, 14, '2018-01-18', '13:00:00', '14:00:00'),
(20, 1, 19, '2018-01-19', '15:00:00', '16:00:00'),
(21, 1, 19, '2018-01-19', '19:00:00', '20:00:00'),
(22, 1, 22, '2018-01-19', '10:00:00', '11:00:00'),
(23, 1, 22, '2018-01-19', '12:00:00', '13:00:00'),
(24, 1, 22, '2018-01-19', '20:00:00', '21:00:00'),
(25, 1, 16, '2018-01-18', '17:00:00', '18:00:00'),
(26, 1, 16, '2018-01-18', '16:00:00', '17:00:00'),
(27, 1, 15, '2018-01-18', '13:00:00', '14:00:00'),
(28, 1, 17, '2018-01-18', '13:00:00', '14:00:00'),
(29, 1, 17, '2018-01-18', '14:00:00', '15:00:00'),
(30, 1, 16, '2018-01-18', '13:00:00', '14:00:00'),
(31, 1, 19, '2018-01-18', '16:00:00', '17:00:00'),
(32, 1, 19, '2018-01-18', '13:00:00', '14:00:00'),
(33, 1, 17, '2018-01-18', '12:00:00', '13:00:00'),
(34, 1, 14, '2018-01-18', '10:00:00', '11:00:00'),
(35, 1, 12, '2018-01-18', '10:00:00', '11:00:00'),
(36, 1, 15, '2018-01-18', '10:00:00', '11:00:00'),
(37, 1, 23, '2018-01-18', '14:00:00', '15:00:00'),
(38, 1, 16, '2018-01-18', '12:00:00', '13:00:00'),
(39, 1, 16, '2018-01-22', '08:00:00', '09:00:00'),
(40, 1, 16, '2018-01-22', '13:00:00', '14:00:00'),
(41, 1, 16, '2018-01-22', '14:00:00', '15:00:00'),
(42, 1, 16, '2018-01-18', '10:00:00', '11:00:00'),
(43, 1, 19, '2018-01-18', '15:00:00', '16:00:00'),
(44, 1, 13, '2018-01-18', '12:00:00', '13:00:00'),
(45, 1, 21, '2018-01-18', '17:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typ_boiska`
--

CREATE TABLE `typ_boiska` (
  `id_typu` int(10) UNSIGNED NOT NULL,
  `typ` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `typ_boiska`
--

INSERT INTO `typ_boiska` (`id_typu`, `typ`) VALUES
(1, 'piłka nożna'),
(2, 'siatkówka'),
(3, 'koszykówka'),
(4, 'piłka ręczna'),
(5, 'siatkówka plażowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id_uzytkownika` int(10) UNSIGNED NOT NULL,
  `login` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `pracownik` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id_uzytkownika`, `login`, `haslo`, `imie`, `nazwisko`, `admin`, `pracownik`) VALUES
(1, 'adrian', '12345678', 'Adrian', 'Szewczyk', 1, 1),
(2, 'maciej', '1234', 'Maciek', 'Asdf', 0, 1),
(3, 'darek', '4321', 'Dariusz', 'Fdsa', 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `boiska`
--
ALTER TABLE `boiska`
  ADD PRIMARY KEY (`id_boiska`);

--
-- Indexes for table `grafik`
--
ALTER TABLE `grafik`
  ADD PRIMARY KEY (`id_grafiku`);

--
-- Indexes for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id_rezerwacji`);

--
-- Indexes for table `typ_boiska`
--
ALTER TABLE `typ_boiska`
  ADD PRIMARY KEY (`id_typu`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `boiska`
--
ALTER TABLE `boiska`
  MODIFY `id_boiska` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT dla tabeli `grafik`
--
ALTER TABLE `grafik`
  MODIFY `id_grafiku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id_rezerwacji` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT dla tabeli `typ_boiska`
--
ALTER TABLE `typ_boiska`
  MODIFY `id_typu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id_uzytkownika` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
