-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 09 Février 2016 à 01:39
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  5.6.17-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fdc`
--

--
-- Contenu de la table `fdcpage_web_tv_trailers`
--

INSERT INTO `fdcpage_web_tv_trailers` (`id`, `image_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`, `selection_section_id`) VALUES
(1, NULL, NULL, '2016-02-09 00:20:46', '2016-02-17 17:15:26', 0, 'a:0:{}', 1, '3'),
(2, NULL, NULL, '2016-02-09 00:20:46', '2016-02-17 17:16:26', 0, 'a:0:{}', 1, '6'),
(3, NULL, NULL, '2016-02-09 00:20:46', '2016-02-17 17:17:25', 0, 'a:0:{}', 1, '7'),
(4, NULL, NULL, '2016-02-09 00:20:46', '2016-02-17 17:17:42', 0, 'a:0:{}', 1, '24'),
(5, NULL, NULL, '2016-02-09 00:20:46', '2016-02-17 17:18:10', 0, 'a:0:{}', 1, '2'),
(6, NULL, NULL, '2016-02-09 00:20:46', '2016-02-17 17:18:33', 0, 'a:0:{}', 1, '4'),
(7, NULL, NULL, '2016-02-09 00:20:46', '2016-02-17 17:18:57', 0, 'a:0:{}', 1, '1'),
(8, NULL, NULL, '2016-02-09 00:20:46', '2016-02-17 17:19:16', 0, 'a:0:{}', 1, '10');

--
-- Contenu de la table `fdcpage_web_tv_trailers_translation`
--

INSERT INTO `fdcpage_web_tv_trailers_translation` (`id`, `locked_by_id`, `translatable_id`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `seo_title`, `seo_description`, `override_name`, `slug`) VALUES
(1, NULL, 1, '2016-02-09 00:20:46', '2016-02-17 17:15:26', 'fr', 1, NULL, NULL, NULL, 'Compétition', 'competition'),
(2, NULL, 1, '2016-02-09 00:20:46', '2016-02-17 17:15:26', 'en', 0, NULL, NULL, NULL, NULL, ''),
(3, NULL, 1, '2016-02-09 00:20:46', '2016-02-17 17:15:26', 'es', 0, NULL, NULL, NULL, NULL, ''),
(4, NULL, 1, '2016-02-09 00:20:46', '2016-02-17 17:15:26', 'zh', 0, NULL, NULL, NULL, NULL, ''),
(5, NULL, 2, '2016-02-09 00:20:46', '2016-02-17 17:16:26', 'fr', 1, NULL, NULL, NULL, 'Un certain regard', 'un-certain-regard'),
(6, NULL, 2, '2016-02-09 00:20:46', '2016-02-17 17:16:26', 'en', 0, NULL, NULL, NULL, NULL, ''),
(7, NULL, 2, '2016-02-09 00:20:46', '2016-02-17 17:16:26', 'es', 0, NULL, NULL, NULL, NULL, ''),
(8, NULL, 2, '2016-02-09 00:20:46', '2016-02-17 17:16:26', 'zh', 0, NULL, NULL, NULL, NULL, ''),
(9, NULL, 3, '2016-02-09 00:20:46', '2016-02-17 17:17:25', 'fr', 1, NULL, NULL, NULL, 'Hors compétition', 'hors-competition'),
(10, NULL, 3, '2016-02-09 00:20:46', '2016-02-17 17:17:25', 'en', 0, NULL, NULL, NULL, NULL, ''),
(11, NULL, 3, '2016-02-09 00:20:46', '2016-02-17 17:17:25', 'es', 0, NULL, NULL, NULL, NULL, ''),
(12, NULL, 3, '2016-02-09 00:20:46', '2016-02-17 17:17:25', 'zh', 0, NULL, NULL, NULL, NULL, ''),
(13, NULL, 4, '2016-02-09 00:20:46', '2016-02-17 17:17:42', 'fr', 1, NULL, NULL, NULL, 'Séances spéciales', 'seances-speciales'),
(14, NULL, 4, '2016-02-09 00:20:46', '2016-02-17 17:17:42', 'en', 0, NULL, NULL, NULL, NULL, ''),
(15, NULL, 4, '2016-02-09 00:20:46', '2016-02-17 17:17:42', 'es', 0, NULL, NULL, NULL, NULL, ''),
(16, NULL, 4, '2016-02-09 00:20:46', '2016-02-17 17:17:42', 'zh', 0, NULL, NULL, NULL, NULL, ''),
(17, NULL, 5, '2016-02-09 00:20:46', '2016-02-17 17:18:10', 'fr', 1, NULL, NULL, NULL, 'Cinéfondation', 'cinefondation'),
(18, NULL, 5, '2016-02-09 00:20:46', '2016-02-17 17:18:10', 'en', 0, NULL, NULL, NULL, NULL, ''),
(19, NULL, 5, '2016-02-09 00:20:46', '2016-02-17 17:18:10', 'es', 0, NULL, NULL, NULL, NULL, ''),
(20, NULL, 5, '2016-02-09 00:20:46', '2016-02-17 17:18:10', 'zh', 0, NULL, NULL, NULL, NULL, ''),
(21, NULL, 6, '2016-02-09 00:20:46', '2016-02-17 17:18:33', 'fr', 1, NULL, NULL, NULL, 'Courts métrages', 'courts-metrages'),
(22, NULL, 6, '2016-02-09 00:20:46', '2016-02-17 17:18:33', 'en', 0, NULL, NULL, NULL, NULL, ''),
(23, NULL, 6, '2016-02-09 00:20:46', '2016-02-17 17:18:33', 'es', 0, NULL, NULL, NULL, NULL, ''),
(24, NULL, 6, '2016-02-09 00:20:46', '2016-02-17 17:18:33', 'zh', 0, NULL, NULL, NULL, NULL, ''),
(25, NULL, 7, '2016-02-09 00:20:46', '2016-02-17 17:18:57', 'fr', 1, NULL, NULL, NULL, 'Cannes Classics', 'cannes-classics'),
(26, NULL, 7, '2016-02-09 00:20:46', '2016-02-17 17:18:57', 'en', 0, NULL, NULL, NULL, NULL, ''),
(27, NULL, 7, '2016-02-09 00:20:46', '2016-02-17 17:18:57', 'es', 0, NULL, NULL, NULL, NULL, ''),
(28, NULL, 7, '2016-02-09 00:20:46', '2016-02-17 17:18:57', 'zh', 0, NULL, NULL, NULL, NULL, ''),
(29, NULL, 8, '2016-02-09 00:20:46', '2016-02-17 17:19:16', 'fr', 1, NULL, NULL, NULL, 'Cinéma de la plage', 'cinema-de-la-plage'),
(30, NULL, 8, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL, NULL, NULL),
(31, NULL, 8, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL, NULL, NULL),
(32, NULL, 8, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
