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

INSERT INTO `fdcpage_web_tv_trailers` (`id`, `image_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`, `slug`) VALUES
(1, NULL, NULL, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 0, 'N;', 1, 'competition'),
(2, NULL, NULL, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 0, 'N;', 1, 'certain-regard'),
(3, NULL, NULL, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 0, 'N;', 1, 'hors-competition'),
(4, NULL, NULL, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 0, 'N;', 1, 'seances-speciales'),
(5, NULL, NULL, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 0, 'N;', 1, 'cinefondation'),
(6, NULL, NULL, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 0, 'N;', 1, 'courts-metrages'),
(7, NULL, NULL, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 0, 'N;', 1, 'cannes-classics'),
(8, NULL, NULL, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 0, 'N;', 1, 'cinema-de-la-plage');

--
-- Contenu de la table `fdcpage_web_tv_trailers_translation`
--

INSERT INTO `fdcpage_web_tv_trailers_translation` (`id`, `locked_by_id`, `translatable_id`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'fr', 1, NULL, NULL, NULL),
(2, NULL, 1, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL),
(3, NULL, 1, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL),
(4, NULL, 1, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL),
(5, NULL, 2, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'fr', 1, NULL, NULL, NULL),
(6, NULL, 2, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL),
(7, NULL, 2, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL),
(8, NULL, 2, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL),
(9, NULL, 3, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'fr', 1, NULL, NULL, NULL),
(10, NULL, 3, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL),
(11, NULL, 3, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL),
(12, NULL, 3, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL),
(13, NULL, 4, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'fr', 1, NULL, NULL, NULL),
(14, NULL, 4, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL),
(15, NULL, 4, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL),
(16, NULL, 4, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL),
(17, NULL, 5, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'fr', 1, NULL, NULL, NULL),
(18, NULL, 5, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL),
(19, NULL, 5, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL),
(20, NULL, 5, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL),
(21, NULL, 6, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'fr', 1, NULL, NULL, NULL),
(22, NULL, 6, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL),
(23, NULL, 6, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL),
(24, NULL, 6, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL),
(25, NULL, 7, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'fr', 1, NULL, NULL, NULL),
(26, NULL, 7, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL),
(27, NULL, 7, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL),
(28, NULL, 7, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL),
(29, NULL, 8, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'fr', 1, NULL, NULL, NULL),
(30, NULL, 8, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'en', 0, NULL, NULL, NULL),
(31, NULL, 8, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'es', 0, NULL, NULL, NULL),
(32, NULL, 8, '2016-02-09 00:20:46', '2016-02-09 00:20:46', 'zh', 0, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
