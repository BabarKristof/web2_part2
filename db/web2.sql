-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 25. 20:52
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `web2`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `helyseg`
--

CREATE TABLE `helyseg` (
  `az` int(50) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `orszag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `helyseg`
--

INSERT INTO `helyseg` (`az`, `nev`, `orszag`) VALUES
(1, 'Sousse', 'Tunézia'),
(2, 'Djerba', 'Tunézia'),
(3, 'Sharm El Sheikh', 'Egyiptom'),
(4, 'Hurghada', 'Egyiptom');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motor_blokkok`
--

CREATE TABLE `motor_blokkok` (
  `mb_id` int(11) NOT NULL,
  `mb_sorrend` int(11) NOT NULL,
  `mb_cim` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `mb_jogok` varchar(5) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `motor_blokkok`
--

INSERT INTO `motor_blokkok` (`mb_id`, `mb_sorrend`, `mb_cim`, `mb_jogok`) VALUES
(1, 1, 'Kedvencek', '111');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motor_felhasznalok`
--

CREATE TABLE `motor_felhasznalok` (
  `fh_id` int(11) NOT NULL,
  `fh_fnev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `fh_jelszo` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `fh_tnev` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `fh_email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `fh_aktiv` smallint(6) NOT NULL,
  `fh_szint` int(11) NOT NULL,
  `fh_lastlogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `motor_felhasznalok`
--

INSERT INTO `motor_felhasznalok` (`fh_id`, `fh_fnev`, `fh_jelszo`, `fh_tnev`, `fh_email`, `fh_aktiv`, `fh_szint`, `fh_lastlogin`) VALUES
(1, 'admin', '$2y$10$l1xcca9GOUbjsOedkOqsQ.m2qM6iYvwok9wGeyBVwQdsjgrI02q1m', 'admin', 'admin@admin.hu', 1, 3, '2021-11-25 06:51:53'),
(2, 'test', '$2y$10$aShP4sMtXyyD48wWbk8Poe.mZsi.DR4yg1Rmjnt5akEIWObL4Oo0a', 'Test User', 'test@test.test', 1, 2, '2021-11-25 06:52:27'),
(3, 'test2', '$2y$10$GGskF.8/O9rmewJ4fsNnreEFdpPU0W6v6EHdAoSjadFZGshqq62Wu', 'Test User 2', 'test2@test.test', 1, 2, '2021-11-25 06:52:51');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motor_oldalak`
--

CREATE TABLE `motor_oldalak` (
  `mo_id` int(11) NOT NULL,
  `mo_alias` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `mo_cim` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `mo_sorrend` int(11) NOT NULL,
  `mo_felettes` int(11) NOT NULL,
  `mo_aktiv` int(11) NOT NULL,
  `mo_pubdate` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `mo_unpubdate` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `mo_fk_blokkid` int(11) NOT NULL,
  `mo_bsorrend` int(11) NOT NULL,
  `mo_jogok` varchar(5) COLLATE utf8_hungarian_ci NOT NULL,
  `mo_hozzaszolas` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `motor_oldalak`
--

INSERT INTO `motor_oldalak` (`mo_id`, `mo_alias`, `mo_cim`, `mo_sorrend`, `mo_felettes`, `mo_aktiv`, `mo_pubdate`, `mo_unpubdate`, `mo_fk_blokkid`, `mo_bsorrend`, `mo_jogok`, `mo_hozzaszolas`) VALUES
(1, 'nyitolap', 'Nyitólap', 1, 0, 1, '2011-03-11 00:00:00', '2111-03-11 00:00:00', 1, 1, '111', 1),
(2, 'elerhetoseg', 'Elérhetőség', 10, 0, 1, '2011-03-11 00:00:00', '2111-03-11 00:00:00', 1, 2, '100', 0),
(3, 'regisztracio', 'Regisztráció', 20, 0, 1, '2011-03-11 00:00:00', '2111-03-11 00:00:00', 0, 0, '111', 0),
(4, 'alapinfok', 'Alapinfók', 1, 1, 1, '2011-03-11 00:00:00', '2111-03-11 00:00:00', 0, 0, '111', 0),
(5, 'ajax_lekerdezes', 'Ajax Lekérdezés', 2, 1, 1, '2011-03-11 00:00:00', '2111-03-11 00:00:00', 1, 3, '011', 0),
(6, 'belepes', 'Belépés', 99, 0, 1, '2011-03-11 00:00:00', '2111-03-11 00:00:00', 1, 4, '100', 0),
(7, 'kilepes', 'Kilépés', 99, 0, 1, '2012-03-01 00:00:00', '2112-03-01 00:00:00', 1, 4, '011', 0),
(8, 'admin', 'Admin', 90, 0, 1, '2012-01-01 00:00:00', '2100-12-31 23:59:59', 0, 0, '001', 0),
(404, 'hiba', '', 0, 0, 1, '2011-01-01 00:00:00', '2111-01-01 00:00:00', 0, 0, '111', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motor_szintek`
--

CREATE TABLE `motor_szintek` (
  `msz_id` int(11) NOT NULL,
  `msz_nev` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `msz_rovid` varchar(10) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `motor_szintek`
--

INSERT INTO `motor_szintek` (`msz_id`, `msz_nev`, `msz_rovid`) VALUES
(1, 'latogato', 'la'),
(2, 'regisztralt latogato', 'rl'),
(3, 'admin', 'ad');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szalloda`
--

CREATE TABLE `szalloda` (
  `az` varchar(50) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `besorolas` int(10) NOT NULL,
  `helyseg_az` int(50) NOT NULL,
  `tengerpart_tav` int(50) NOT NULL,
  `repter_tav` int(50) NOT NULL,
  `felpanzio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `szalloda`
--

INSERT INTO `szalloda` (`az`, `nev`, `besorolas`, `helyseg_az`, `tengerpart_tav`, `repter_tav`, `felpanzio`) VALUES
('BS', 'Baron Resort', 5, 3, 0, 15, 1),
('CL', 'Charm Life', 3, 4, 0, 33, 0),
('CP', 'Cesar Palace', 5, 2, 250, 27, 1),
('CW', 'Caribbean World Soma Bay', 5, 4, 0, 55, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tavasz`
--

CREATE TABLE `tavasz` (
  `sorszam` int(11) NOT NULL,
  `szalloda_az` varchar(50) NOT NULL,
  `indulas` date NOT NULL,
  `idotartam` int(50) NOT NULL,
  `ar` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `tavasz`
--

INSERT INTO `tavasz` (`sorszam`, `szalloda_az`, `indulas`, `idotartam`, `ar`) VALUES
(1, 'BS', '2011-01-05', 8, 244900),
(2, 'BS', '2011-01-05', 15, 358900),
(3, 'BS', '2011-01-12', 8, 157900),
(4, 'BS', '2011-01-12', 15, 265900);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `helyseg`
--
ALTER TABLE `helyseg`
  ADD PRIMARY KEY (`az`);

--
-- A tábla indexei `motor_blokkok`
--
ALTER TABLE `motor_blokkok`
  ADD PRIMARY KEY (`mb_id`);

--
-- A tábla indexei `motor_felhasznalok`
--
ALTER TABLE `motor_felhasznalok`
  ADD PRIMARY KEY (`fh_id`);

--
-- A tábla indexei `motor_oldalak`
--
ALTER TABLE `motor_oldalak`
  ADD PRIMARY KEY (`mo_id`);

--
-- A tábla indexei `motor_szintek`
--
ALTER TABLE `motor_szintek`
  ADD PRIMARY KEY (`msz_id`);

--
-- A tábla indexei `szalloda`
--
ALTER TABLE `szalloda`
  ADD PRIMARY KEY (`az`),
  ADD KEY `helyseg_az` (`helyseg_az`);

--
-- A tábla indexei `tavasz`
--
ALTER TABLE `tavasz`
  ADD PRIMARY KEY (`sorszam`),
  ADD KEY `szalloda_az` (`szalloda_az`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `motor_felhasznalok`
--
ALTER TABLE `motor_felhasznalok`
  MODIFY `fh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `tavasz`
--
ALTER TABLE `tavasz`
  MODIFY `sorszam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `szalloda`
--
ALTER TABLE `szalloda`
  ADD CONSTRAINT `szalloda_ibfk_1` FOREIGN KEY (`helyseg_az`) REFERENCES `helyseg` (`az`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `tavasz`
--
ALTER TABLE `tavasz`
  ADD CONSTRAINT `tavasz_ibfk_1` FOREIGN KEY (`szalloda_az`) REFERENCES `szalloda` (`az`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
