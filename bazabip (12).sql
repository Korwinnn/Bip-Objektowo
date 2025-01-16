-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 16, 2025 at 11:11 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazabip`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `changes_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `content`, `created_by`, `updated_by`, `changes_count`, `created_at`, `updated_at`, `display_order`) VALUES
(20, NULL, 'Centrum Kształcenia Zawodowego i Ustawicznego', NULL, 1, 1, 0, '2025-01-16 20:58:31', '2025-01-16 20:58:31', 0),
(21, 20, 'UCHWAŁA NR XVIII / 95 / 2016', '<p>RADY POWIATU W BRODNICY<br>z dnia 3 marca 2016</p>\r\n<p>w sprawie rozwiązania Zespołu Szk&oacute;ł Zawodowych w Brodnicy,<br>Zespołu Szk&oacute;ł Rolniczych w Brodnicy oraz<br>Regionalnego Centrum Kształcenia Praktycznego i Ustawicznego<br>i utworzenia&nbsp;<strong>Centrum Kształcenia Zawodowego i Ustawicznego w Brodnicy.</strong></p>\r\n<p>Załącznik Nr1 do uchwały Nr XVIII / 95 / 2016<br>Rady Powiatu w Brodnicy<br>z dnia 3 marca 2016 r.<br><strong>AKT ZAŁOŻYCIELSKI&nbsp;</strong><strong>Centrum Kształcenia Zawodowego i Ustawicznego w Brodnicy</strong></p>\r\n<p>Załącznik Nr2 do uchwały Nr XVIII / 95 / 2016<br>Rady Powiatu w Brodnicy<br>z dnia 3 marca 2016 r.<br><strong>STATUT Centrum Kształcenia Zawodowego i Ustawicznego w Brodnicy</strong></p>', 1, 1, 0, '2025-01-16 20:59:09', '2025-01-16 20:59:09', 0),
(22, 20, 'Dane adresowe', '<blockquote>\r\n<p><strong>Centrum Kształcenia Zawodowego i Ustawicznego<br>w Brodnicy<br>NIP: 874-177-98-25<br>REGON: 364986594</strong></p>\r\n</blockquote>\r\n<p><strong>Technikum<br>Zasadnicza Szkoła Zawodowa</strong><br><em>ul. Mazurska 28, 87-300 Brodnica, woj. kujawsko-pomorskie<br>Sekretariat: tel.: 56 498-24-66/7&nbsp; fax:&nbsp; 56 697-15-22</em></p>\r\n<hr>\r\n<p><strong>Technikum im. Zesłańc&oacute;w Sybiru<br>Zasadnicza Szkoła Zawodowa im. Zesłańc&oacute;w Sybiru</strong><br><em>ul. Karbowska 29, 87-300 Brodnica, woj. kujawsko-pomorskie<br>Sekretariat: tel.: 56 49 849 01<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; fax:&nbsp; 56 49 838 14</em></p>\r\n<hr>\r\n<p><strong>Centrum Kształcenia Zawodowego<br>Szkoła Podstawowowa dla Dorosłych<br>Liceum Og&oacute;lnokształcące dla Dorosłych<br>Szkoła Policealna dla Dorosłych</strong><br><em>ul. Karbowska 29, 87-300 Brodnica, woj. kujawsko-pomorskie</em><br><em>oraz</em></p>\r\n<p><em>ul. Aleja Leśna 2, 87-300 Brodnica, woj. kujawsko-pomorskie</em></p>\r\n<p><em>Sekretariat: tel.:&nbsp; 56 49 849 01<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; fax: 56 49 838 14</em></p>\r\n<p>ePUAP:/jgniadkowski2/Domyślna</p>\r\n<hr>\r\n<p><strong>Internat</strong><br><em>ul. Mazurska 16, 87-300 Brodnica, woj.kujawsko-pomorskie</em></p>', 1, 1, 0, '2025-01-16 20:59:24', '2025-01-16 20:59:24', 0),
(23, 20, 'Dyrektor, wicedyrektorzy i kierownicy', '<blockquote>\r\n<p><strong>DYREKTOR</strong></p>\r\n<p>ul. Mazurska 28<br>mgr inż. Jacek Gniadkowski&nbsp;</p>\r\n</blockquote>\r\n<p><strong>WICEDYREKTORZY:</strong></p>\r\n<p><span style=\"margin: 0px; padding: 0px; box-sizing: border-box; font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif; text-decoration: underline;\"><strong><em>ul. Mazurska 28</em></strong></span><br>mgr Violetta Sternicka-Twarogowska<br>mgr Alicja Wiśniewska</p>\r\n<p><strong><em><span style=\"margin: 0px; padding: 0px; box-sizing: border-box; font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif; text-decoration: underline;\">ul. Karbowska 29</span></em></strong><br>mgr Iwona Mazurkiewicz-Krajewska<br>mgr Jarosław Hiszpański&nbsp;</p>\r\n<p><span style=\"margin: 0px; padding: 0px; box-sizing: border-box; font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif; text-decoration: underline;\"><strong><em>ul. Aleja Leśna 2</em></strong></span><br>mgr inż.&nbsp; Lidia Czewińska<br>mgr&nbsp;Andrzej Wiśniewski</p>\r\n<p><strong>KIEROWNICY:</strong></p>\r\n<p>Kierownik Centrum Kształcenia Praktycznego<br>oraz Ośrodka Dokształcania i Doskonalenia Zawodowego<br>ul. Aleja Leśna 2<br>mgr Jarosław Skarżyński<br><br>Kierownik internatu<br>ul. Mazurska 16<br>mgr&nbsp; Anna Krawulska</p>', 1, 1, 0, '2025-01-16 21:01:15', '2025-01-16 21:01:15', 0),
(24, 20, 'Telefony wewnętrzne', '<p><strong>Telefony w budynkach:</strong></p>\r\n<p><strong>ul. Mazurska 28</strong></p>\r\n<blockquote>\r\n<p><strong>Połączenia przez centralę:</strong><br>centrala: 56 4982466,&nbsp; 56 4982467<br>15 - gabinet dyrektora - Jacek Gniadkowski<br>10 - gabinet wicedyrektora - Violetta Sternicka<br>21 - gabinet wicedyrektora - Alicja Wiśniewska<br>20 - gabinet pedagoga - A. Krawulska<br>22 - gabinet kierownika gospodarczego - Marzena Bronclik<br>24 - gabinet pielęgniarki<br>25 - biblioteka<br>19 - pok&oacute;j nauczycielski<br>12 - sekretariat/kasa<br>11 - portiernia<br>16 - fax</p>\r\n<p><strong>Połączenia poprzez bezpośrednie numery zewnętrzne:</strong><br>566971523 - gabinet dyrektora - Jacek Gniadkowski<br>566498510&nbsp; - gabinet wicedyrektora - Violetta Sternicka<br>566498521 - gabinet wicedyrektora - Alicja Wiśniewska<br>566498520 - gabinet pedagoga - Anna Krawulska<br>566498522 - gabinet kierownika gospodarczego - Marzena Bronclik<br>566498524 - gabinet pielęgniarki<br>566498525 - biblioteka<br>566498519 - pok&oacute;j nauczycielski<br>566498512 - sekretariat/kasa<br>566498511 - portiernia<br>566498522 - fax</p>\r\n</blockquote>\r\n<p><strong>ul. Karbowska 29</strong></p>\r\n<blockquote>\r\n<p>centrala: 56 4984901<br>33 - gabinet wicedyrektora - Jarosław Hiszpański<br>34 - gabinet referenta administracyjno-biurowego<br>35 - gabinet wicedyrektora - Iwona Krajewska<br>38 - pok&oacute;j nauczycielski<br>39 - hala widowiskowo-sportowa<br>44 - biblioteka - Elżbieta Gaca</p>\r\n</blockquote>\r\n<p><strong>ul. Aleja Leśna</strong></p>\r\n<blockquote>\r\n<p>tel./ fax 56498-32-91,</p>\r\n<p>tel. 783-997-420</p>\r\n<p>wewn.&nbsp; 21- sekretariat</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23- kierownik - Jarosław Skarżyński</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 29- portiernia</p>\r\n</blockquote>', 1, 1, 0, '2025-01-16 21:01:59', '2025-01-16 21:01:59', 0),
(26, NULL, 'Informacje o CKZiU', NULL, 1, 1, 0, '2025-01-16 21:02:44', '2025-01-16 21:02:44', 0),
(27, 26, 'Pomieszczenia', '<p><strong>ul. Mazurska 28</strong></p>\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<thead>\r\n<tr>\r\n<th scope=\"col\"><strong>rodzaj</strong></th>\r\n<th scope=\"col\"><strong>funkcja</strong></th>\r\n<th scope=\"col\"><strong>liczba</strong></th>\r\n<th scope=\"col\"><strong>powierzchnia m2</strong></th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>pracownia językowa</td>\r\n<td>pracownia językowa</td>\r\n<td>9</td>\r\n<td>278,20</td>\r\n</tr>\r\n<tr>\r\n<td>pracownia komputerowa</td>\r\n<td>pracownia komputerowa</td>\r\n<td>4</td>\r\n<td>172,40</td>\r\n</tr>\r\n<tr>\r\n<td>pracownia szkolna</td>\r\n<td>sala lekcyjna</td>\r\n<td>18</td>\r\n<td>864,70</td>\r\n</tr>\r\n<tr>\r\n<td>gabinet</td>\r\n<td>gabinet pomocy przedlekarskiej</td>\r\n<td>1</td>\r\n<td>12,60</td>\r\n</tr>\r\n<tr>\r\n<td>gabinet</td>\r\n<td>gabinet psychologa</td>\r\n<td>1</td>\r\n<td>12,60</td>\r\n</tr>\r\n<tr>\r\n<td>gabinet</td>\r\n<td>gabinet pedagoga</td>\r\n<td>1</td>\r\n<td>17,00</td>\r\n</tr>\r\n<tr>\r\n<td>sala gimnastyczna</td>\r\n<td>sala gimnastyczna</td>\r\n<td>1</td>\r\n<td>155,20</td>\r\n</tr>\r\n<tr>\r\n<td>biblioteka</td>\r\n<td>biblioteka (4 pomieszczenia)</td>\r\n<td>1</td>\r\n<td>138,30</td>\r\n</tr>\r\n<tr>\r\n<td>pozostałe pomieszczenia</td>\r\n<td>&nbsp;</td>\r\n<td>50</td>\r\n<td>2 815,00</td>\r\n</tr>\r\n<tr>\r\n<td>Razem</td>\r\n<td>&nbsp;</td>\r\n<td>89</td>\r\n<td>4 466,00</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr>\r\n<p><strong>ul. Karbowska 29</strong></p>\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<thead>\r\n<tr>\r\n<th scope=\"col\"><strong>rodzaj</strong></th>\r\n<th scope=\"col\"><strong>funkcja</strong></th>\r\n<th scope=\"col\"><strong>liczba</strong></th>\r\n<th scope=\"col\"><strong>powierzchnia m2</strong></th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>pracownia językowa</td>\r\n<td>pracownia językowa</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pracownia komputerowa</td>\r\n<td>pracownia komputerowa</td>\r\n<td>2</td>\r\n<td>72,00</td>\r\n</tr>\r\n<tr>\r\n<td>pracownia szkolna</td>\r\n<td>pracownia ŻiUG</td>\r\n<td>2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pracownia szkolna</td>\r\n<td>sala lekcyjna</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>gabinet</td>\r\n<td>gabinet pomocy przedlekarskiej</td>\r\n<td>1</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>gabinet</td>\r\n<td>gabinet pedagoga</td>\r\n<td>1</td>\r\n<td>12.00</td>\r\n</tr>\r\n<tr>\r\n<td>sala widowiskowo-sportowa</td>\r\n<td>sala gimnastyczna</td>\r\n<td>1</td>\r\n<td>2565,92</td>\r\n</tr>\r\n<tr>\r\n<td>biblioteka</td>\r\n<td>biblioteka (3 pomieszczenia)</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pomieszczenia dla nauczycieli</td>\r\n<td>pok&oacute;j nauczycielski</td>\r\n<td>1</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pomieszczenia biurowe</td>\r\n<td>biura, archiwa</td>\r\n<td>8</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pozostałe pomieszczenia</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Razem</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr>\r\n<p><strong>ul. Alej Leśna 2</strong></p>\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<thead>\r\n<tr>\r\n<th scope=\"col\"><strong>rodzaj</strong></th>\r\n<th scope=\"col\"><strong>funkcja</strong></th>\r\n<th scope=\"col\"><strong>liczba</strong></th>\r\n<th scope=\"col\"><strong>powierzchnia m2</strong></th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>pracownia językowa</td>\r\n<td>pracownia językowa</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pracownia komputerowa</td>\r\n<td>pracownia komputerowa</td>\r\n<td>1</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pracownia szkolna</td>\r\n<td>sala lekcyjna</td>\r\n<td>12</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pracownia szkolna</td>\r\n<td>\r\n<p>pracownia sprzedaży<br>pracownia elektryczna<br>pracownia mechaniczna<br>kuźnia<br>spawalnia<br>magazyn<br>pracownia fryzjerska<br>praacownia kosmetyczna<br>pracownia rolniczo-samochodowa</p>\r\n</td>\r\n<td>1<br>1<br>1<br>1<br>1<br>1<br>2<br>1<br>1</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>gabinet</td>\r\n<td>gabinet pomocy przedlekarskiej</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>biblioteka</td>\r\n<td>biblioteka</td>\r\n<td>1</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>inne pomieszczenia</td>\r\n<td>stoł&oacute;wka dla uczni&oacute;w<br>szatnia</td>\r\n<td>2<br>3</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pomieszczenia gospodarcze</td>\r\n<td>pomieszczenia gosp. dla uczni&oacute;w<br>pomieszczenia gosp. dla nauczycieli</td>\r\n<td>1<br>1</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pomieszczenia dla nauczycieli</td>\r\n<td>pok&oacute;j nauczycielski</td>\r\n<td>1</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pozostałe pomieszczenia</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Razem</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 1, 1, 0, '2025-01-16 21:03:02', '2025-01-16 21:03:02', 0),
(28, 26, 'Sprzęt i pomoce naukowe', NULL, 1, 1, 0, '2025-01-16 21:03:29', '2025-01-16 21:03:29', 0),
(29, 26, 'Powierzchnie działek', '<p>ul. Mazurska 28</p>\r\n<p>ul. Karbowska 29</p>\r\n<blockquote>\r\n<p>1,4956 ha</p>\r\n</blockquote>\r\n<p>ul. Aleja Leśna 2</p>\r\n<blockquote>\r\n<p>0,6862 ha</p>\r\n</blockquote>', 1, 1, 0, '2025-01-16 21:04:10', '2025-01-16 21:04:10', 0),
(30, NULL, 'Rada Rodziców', NULL, 1, 1, 0, '2025-01-16 21:04:40', '2025-01-16 21:04:40', 0),
(31, NULL, 'Sprawozdania finansowe CKZiU w Brodnicy', '<p>Sprawozdania są publikowane na stronie&nbsp;<a href=\"http://www.pco-brodnica.biuletyn.net/\"><strong>BIP&nbsp; Powiatowego Centrum Obsługi</strong></a>&nbsp;w zakładce \"Sprawozdania finansowe jednostek\".</p>\r\n<p>Adres&nbsp;<a href=\"http://www.pco-brodnica.biuletyn.net/\">http://www.pco-brodnica.biuletyn.net</a></p>', 1, 1, 0, '2025-01-16 21:05:04', '2025-01-16 21:05:04', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_history`
--

CREATE TABLE `category_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `old_content` text DEFAULT NULL,
  `new_content` text DEFAULT NULL,
  `old_name` varchar(255) DEFAULT NULL,
  `new_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_visits`
--

CREATE TABLE `category_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `visited_at` datetime NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_visits`
--

INSERT INTO `category_visits` (`id`, `category_id`, `visited_at`, `ip_address`, `created_at`, `updated_at`) VALUES
(211, 20, '2025-01-16 21:58:33', '127.0.0.1', '2025-01-16 20:58:33', '2025-01-16 20:58:33'),
(212, 22, '2025-01-16 22:00:19', '127.0.0.1', '2025-01-16 21:00:19', '2025-01-16 21:00:19'),
(214, 26, '2025-01-16 22:02:45', '127.0.0.1', '2025-01-16 21:02:45', '2025-01-16 21:02:45'),
(215, 26, '2025-01-16 22:03:03', '127.0.0.1', '2025-01-16 21:03:03', '2025-01-16 21:03:03'),
(216, 27, '2025-01-16 22:03:05', '127.0.0.1', '2025-01-16 21:03:05', '2025-01-16 21:03:05'),
(217, 28, '2025-01-16 22:03:32', '127.0.0.1', '2025-01-16 21:03:32', '2025-01-16 21:03:32'),
(218, 29, '2025-01-16 22:04:12', '127.0.0.1', '2025-01-16 21:04:12', '2025-01-16 21:04:12'),
(219, 20, '2025-01-16 22:27:26', '127.0.0.1', '2025-01-16 21:27:26', '2025-01-16 21:27:26'),
(220, 21, '2025-01-16 22:27:28', '127.0.0.1', '2025-01-16 21:27:28', '2025-01-16 21:27:28'),
(221, 20, '2025-01-16 22:33:47', '127.0.0.1', '2025-01-16 21:33:47', '2025-01-16 21:33:47'),
(222, 26, '2025-01-16 22:34:11', '127.0.0.1', '2025-01-16 21:34:11', '2025-01-16 21:34:11'),
(223, 30, '2025-01-16 22:34:14', '127.0.0.1', '2025-01-16 21:34:14', '2025-01-16 21:34:14'),
(224, 31, '2025-01-16 22:34:15', '127.0.0.1', '2025-01-16 21:34:15', '2025-01-16 21:34:15'),
(225, 20, '2025-01-16 22:34:17', '127.0.0.1', '2025-01-16 21:34:17', '2025-01-16 21:34:17'),
(226, 20, '2025-01-16 22:36:58', '127.0.0.1', '2025-01-16 21:36:58', '2025-01-16 21:36:58'),
(227, 21, '2025-01-16 22:37:01', '127.0.0.1', '2025-01-16 21:37:01', '2025-01-16 21:37:01'),
(228, 20, '2025-01-16 22:37:03', '127.0.0.1', '2025-01-16 21:37:03', '2025-01-16 21:37:03'),
(229, 22, '2025-01-16 22:37:03', '127.0.0.1', '2025-01-16 21:37:03', '2025-01-16 21:37:03'),
(230, 20, '2025-01-16 22:37:04', '127.0.0.1', '2025-01-16 21:37:04', '2025-01-16 21:37:04'),
(231, 23, '2025-01-16 22:37:05', '127.0.0.1', '2025-01-16 21:37:05', '2025-01-16 21:37:05'),
(232, 20, '2025-01-16 22:37:05', '127.0.0.1', '2025-01-16 21:37:05', '2025-01-16 21:37:05'),
(233, 24, '2025-01-16 22:37:06', '127.0.0.1', '2025-01-16 21:37:06', '2025-01-16 21:37:06'),
(234, 20, '2025-01-16 22:37:06', '127.0.0.1', '2025-01-16 21:37:06', '2025-01-16 21:37:06'),
(235, 21, '2025-01-16 22:37:08', '127.0.0.1', '2025-01-16 21:37:08', '2025-01-16 21:37:08'),
(236, 20, '2025-01-16 22:37:09', '127.0.0.1', '2025-01-16 21:37:09', '2025-01-16 21:37:09'),
(237, 20, '2025-01-16 22:37:40', '127.0.0.1', '2025-01-16 21:37:40', '2025-01-16 21:37:40'),
(238, 20, '2025-01-16 22:39:39', '127.0.0.1', '2025-01-16 21:39:39', '2025-01-16 21:39:39'),
(239, 20, '2025-01-16 22:39:54', '127.0.0.1', '2025-01-16 21:39:54', '2025-01-16 21:39:54'),
(240, 20, '2025-01-16 22:39:55', '127.0.0.1', '2025-01-16 21:39:55', '2025-01-16 21:39:55'),
(241, 20, '2025-01-16 22:39:55', '127.0.0.1', '2025-01-16 21:39:55', '2025-01-16 21:39:55'),
(242, 20, '2025-01-16 22:39:56', '127.0.0.1', '2025-01-16 21:39:56', '2025-01-16 21:39:56'),
(243, 26, '2025-01-16 22:40:01', '127.0.0.1', '2025-01-16 21:40:01', '2025-01-16 21:40:01'),
(244, 30, '2025-01-16 22:40:02', '127.0.0.1', '2025-01-16 21:40:02', '2025-01-16 21:40:02'),
(245, 31, '2025-01-16 22:40:02', '127.0.0.1', '2025-01-16 21:40:02', '2025-01-16 21:40:02'),
(246, 30, '2025-01-16 22:40:04', '127.0.0.1', '2025-01-16 21:40:04', '2025-01-16 21:40:04'),
(247, 26, '2025-01-16 22:40:05', '127.0.0.1', '2025-01-16 21:40:05', '2025-01-16 21:40:05'),
(248, 20, '2025-01-16 22:40:06', '127.0.0.1', '2025-01-16 21:40:06', '2025-01-16 21:40:06'),
(249, 21, '2025-01-16 22:40:07', '127.0.0.1', '2025-01-16 21:40:07', '2025-01-16 21:40:07'),
(250, 20, '2025-01-16 22:40:08', '127.0.0.1', '2025-01-16 21:40:08', '2025-01-16 21:40:08'),
(251, 22, '2025-01-16 22:40:09', '127.0.0.1', '2025-01-16 21:40:09', '2025-01-16 21:40:09'),
(252, 20, '2025-01-16 22:40:10', '127.0.0.1', '2025-01-16 21:40:10', '2025-01-16 21:40:10'),
(253, 21, '2025-01-16 22:40:11', '127.0.0.1', '2025-01-16 21:40:11', '2025-01-16 21:40:11'),
(254, 20, '2025-01-16 22:40:12', '127.0.0.1', '2025-01-16 21:40:12', '2025-01-16 21:40:12'),
(255, 21, '2025-01-16 22:40:12', '127.0.0.1', '2025-01-16 21:40:12', '2025-01-16 21:40:12'),
(256, 20, '2025-01-16 22:40:19', '127.0.0.1', '2025-01-16 21:40:19', '2025-01-16 21:40:19'),
(257, 30, '2025-01-16 22:43:34', '127.0.0.1', '2025-01-16 21:43:34', '2025-01-16 21:43:34'),
(258, 31, '2025-01-16 22:43:35', '127.0.0.1', '2025-01-16 21:43:35', '2025-01-16 21:43:35'),
(259, 26, '2025-01-16 22:43:36', '127.0.0.1', '2025-01-16 21:43:36', '2025-01-16 21:43:36'),
(260, 20, '2025-01-16 22:43:36', '127.0.0.1', '2025-01-16 21:43:36', '2025-01-16 21:43:36'),
(261, 20, '2025-01-16 22:43:53', '127.0.0.1', '2025-01-16 21:43:53', '2025-01-16 21:43:53'),
(264, 20, '2025-01-16 22:46:34', '127.0.0.1', '2025-01-16 21:46:34', '2025-01-16 21:46:34'),
(265, 26, '2025-01-16 22:47:59', '127.0.0.1', '2025-01-16 21:47:59', '2025-01-16 21:47:59'),
(266, 26, '2025-01-16 22:48:02', '127.0.0.1', '2025-01-16 21:48:02', '2025-01-16 21:48:02'),
(267, 26, '2025-01-16 22:51:51', '127.0.0.1', '2025-01-16 21:51:51', '2025-01-16 21:51:51'),
(268, 26, '2025-01-16 22:52:15', '127.0.0.1', '2025-01-16 21:52:15', '2025-01-16 21:52:15'),
(269, 26, '2025-01-16 22:52:19', '127.0.0.1', '2025-01-16 21:52:19', '2025-01-16 21:52:19'),
(270, 26, '2025-01-16 22:52:22', '127.0.0.1', '2025-01-16 21:52:22', '2025-01-16 21:52:22'),
(271, 26, '2025-01-16 22:53:13', '127.0.0.1', '2025-01-16 21:53:13', '2025-01-16 21:53:13'),
(272, 26, '2025-01-16 22:53:29', '127.0.0.1', '2025-01-16 21:53:29', '2025-01-16 21:53:29'),
(273, 30, '2025-01-16 22:53:30', '127.0.0.1', '2025-01-16 21:53:30', '2025-01-16 21:53:30'),
(274, 31, '2025-01-16 22:53:31', '127.0.0.1', '2025-01-16 21:53:31', '2025-01-16 21:53:31'),
(275, 30, '2025-01-16 22:53:31', '127.0.0.1', '2025-01-16 21:53:31', '2025-01-16 21:53:31'),
(276, 30, '2025-01-16 22:56:17', '127.0.0.1', '2025-01-16 21:56:17', '2025-01-16 21:56:17'),
(277, 30, '2025-01-16 22:56:42', '127.0.0.1', '2025-01-16 21:56:42', '2025-01-16 21:56:42'),
(278, 30, '2025-01-16 22:57:39', '127.0.0.1', '2025-01-16 21:57:39', '2025-01-16 21:57:39'),
(279, 30, '2025-01-16 22:59:44', '127.0.0.1', '2025-01-16 21:59:44', '2025-01-16 21:59:44'),
(280, 30, '2025-01-16 23:00:06', '127.0.0.1', '2025-01-16 22:00:06', '2025-01-16 22:00:06'),
(281, 30, '2025-01-16 23:01:13', '127.0.0.1', '2025-01-16 22:01:13', '2025-01-16 22:01:13'),
(282, 30, '2025-01-16 23:02:00', '127.0.0.1', '2025-01-16 22:02:00', '2025-01-16 22:02:00'),
(283, 30, '2025-01-16 23:02:17', '127.0.0.1', '2025-01-16 22:02:17', '2025-01-16 22:02:17'),
(284, 30, '2025-01-16 23:02:43', '127.0.0.1', '2025-01-16 22:02:43', '2025-01-16 22:02:43'),
(285, 30, '2025-01-16 23:02:44', '127.0.0.1', '2025-01-16 22:02:44', '2025-01-16 22:02:44'),
(286, 30, '2025-01-16 23:02:45', '127.0.0.1', '2025-01-16 22:02:45', '2025-01-16 22:02:45'),
(287, 20, '2025-01-16 23:03:00', '127.0.0.1', '2025-01-16 22:03:00', '2025-01-16 22:03:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_29_233940_create_categories_table', 1),
(5, '2024_12_30_204810_update_users_table_for_login_with_username', 1),
(6, '2025_01_04_223313_create_settings_table', 1),
(7, '2025_01_06_203900_add_user_tracking_to_categories', 1),
(8, '2025_01_06_205946_add_changes_count_to_categories', 1),
(9, '2025_01_06_210119_create_category_history_table', 1),
(10, '2025_01_10_221551_change_user_reference_columns_in_categories_table', 2),
(12, '2025_01_10_233305_create_category_visits_table', 3),
(13, '2025_01_16_220753_add_display_order_to_categories', 4),
(14, '2025_01_16_221149_add_display_order_column_to_categories_table', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('t2EYCsOKzV9HvLVt3VbKsihfShuWECDoh3qFfhpJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzhCWm9iWDNCczVkNldOcDE0WE1LVUNFZ09LNVpCUmw4UjJzSmdRNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdGF0aXN0aWNzIjt9fQ==', 1737065021);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'institution_name', 'Centrum Kształcenia Zawodowego i Ustawicznego w Brodnicy', '2025-01-08 21:49:09', '2025-01-16 21:31:10'),
(2, 'institution_logo', 'institution_logo.png', '2025-01-09 17:54:08', '2025-01-09 17:54:08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'admin@example.com', NULL, '$2y$12$wbrdIbX40HTaO.gXhExOKu3OFvcnE9S/vC5ThjhkcDPEjKsFiBtS2', NULL, '2025-01-08 22:45:40', '2025-01-08 21:47:05');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeksy dla tabeli `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_updated_by_foreign` (`updated_by`);

--
-- Indeksy dla tabeli `category_history`
--
ALTER TABLE `category_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_history_category_id_foreign` (`category_id`),
  ADD KEY `category_history_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `category_visits`
--
ALTER TABLE `category_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_visits_category_id_foreign` (`category_id`),
  ADD KEY `category_visits_visited_at_index` (`visited_at`);

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeksy dla tabeli `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeksy dla tabeli `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeksy dla tabeli `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeksy dla tabeli `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `category_history`
--
ALTER TABLE `category_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category_visits`
--
ALTER TABLE `category_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `category_history`
--
ALTER TABLE `category_history`
  ADD CONSTRAINT `category_history_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `category_visits`
--
ALTER TABLE `category_visits`
  ADD CONSTRAINT `category_visits_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
