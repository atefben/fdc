-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 10 Mars 2016 à 18:41
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  5.6.17-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fdc_dev`
--

--
-- Contenu de la table `fdcpage_la_selection`
--

INSERT INTO `fdcpage_la_selection` (`id`, `image_id`, `selection_section_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, 5, '3', NULL, '2016-03-10 15:03:43', '2016-03-10 15:03:43', 1, 'a:0:{}', 1),
(2, 4, '6', NULL, '2016-03-10 15:08:40', '2016-03-10 15:08:40', 0, 'a:0:{}', 1),
(3, 4, '7', NULL, '2016-03-10 15:13:23', '2016-03-10 15:13:23', 0, 'a:0:{}', 1),
(4, 11, '24', NULL, '2016-03-10 15:14:43', '2016-03-10 15:14:43', 0, 'a:0:{}', 1),
(5, 7, '2', NULL, '2016-03-10 15:15:43', '2016-03-10 15:15:43', 0, 'a:0:{}', 1),
(6, 10, '4', NULL, '2016-03-10 15:16:40', '2016-03-10 15:16:40', 0, 'a:0:{}', 1);

--
-- Contenu de la table `fdcpage_la_selection_translation`
--

INSERT INTO `fdcpage_la_selection_translation` (`id`, `locked_by_id`, `translatable_id`, `override_name`, `slug`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, 'Compétition', 'competition', '2016-03-10 15:03:43', '2016-03-10 15:03:43', 'fr', 0, NULL, 0, NULL, NULL),
(2, NULL, 1, NULL, NULL, '2016-03-10 15:03:43', '2016-03-10 15:03:43', 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, NULL, NULL, '2016-03-10 15:03:43', '2016-03-10 15:03:43', 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, NULL, NULL, '2016-03-10 15:03:43', '2016-03-10 15:03:43', 'zh', 0, NULL, 0, NULL, NULL),
(5, NULL, 2, 'Un Certain Regard', 'un-certain-regard', '2016-03-10 15:08:40', '2016-03-10 15:08:40', 'fr', 0, NULL, 0, NULL, NULL),
(6, NULL, 2, NULL, NULL, '2016-03-10 15:08:40', '2016-03-10 15:08:40', 'en', 0, NULL, 0, NULL, NULL),
(7, NULL, 2, NULL, NULL, '2016-03-10 15:08:40', '2016-03-10 15:08:40', 'es', 0, NULL, 0, NULL, NULL),
(8, NULL, 2, NULL, NULL, '2016-03-10 15:08:40', '2016-03-10 15:08:40', 'zh', 0, NULL, 0, NULL, NULL),
(9, NULL, 3, 'Hors Compétition', 'hors-competition', '2016-03-10 15:13:23', '2016-03-10 15:13:23', 'fr', 0, NULL, 0, NULL, NULL),
(10, NULL, 3, NULL, NULL, '2016-03-10 15:13:23', '2016-03-10 15:13:23', 'en', 0, NULL, 0, NULL, NULL),
(11, NULL, 3, NULL, NULL, '2016-03-10 15:13:23', '2016-03-10 15:13:23', 'es', 0, NULL, 0, NULL, NULL),
(12, NULL, 3, NULL, NULL, '2016-03-10 15:13:23', '2016-03-10 15:13:23', 'zh', 0, NULL, 0, NULL, NULL),
(13, NULL, 4, 'Séances spéciales', 'seances-speciales', '2016-03-10 15:14:43', '2016-03-10 15:14:43', 'fr', 0, NULL, 0, NULL, NULL),
(14, NULL, 4, NULL, NULL, '2016-03-10 15:14:43', '2016-03-10 15:14:43', 'en', 0, NULL, 0, NULL, NULL),
(15, NULL, 4, NULL, NULL, '2016-03-10 15:14:43', '2016-03-10 15:14:43', 'es', 0, NULL, 0, NULL, NULL),
(16, NULL, 4, NULL, NULL, '2016-03-10 15:14:43', '2016-03-10 15:14:43', 'zh', 0, NULL, 0, NULL, NULL),
(17, NULL, 5, 'Cinéfondation', 'cinefondation', '2016-03-10 15:15:43', '2016-03-10 15:15:43', 'fr', 0, NULL, 0, NULL, NULL),
(18, NULL, 5, NULL, NULL, '2016-03-10 15:15:43', '2016-03-10 15:15:43', 'en', 0, NULL, 0, NULL, NULL),
(19, NULL, 5, NULL, NULL, '2016-03-10 15:15:43', '2016-03-10 15:15:43', 'es', 0, NULL, 0, NULL, NULL),
(20, NULL, 5, NULL, NULL, '2016-03-10 15:15:43', '2016-03-10 15:15:43', 'zh', 0, NULL, 0, NULL, NULL),
(21, NULL, 6, 'Courts métrages', 'courts-metrages', '2016-03-10 15:16:40', '2016-03-10 15:16:40', 'fr', 0, NULL, 0, NULL, NULL),
(22, NULL, 6, NULL, NULL, '2016-03-10 15:16:40', '2016-03-10 15:16:40', 'en', 0, NULL, 0, NULL, NULL),
(23, NULL, 6, NULL, NULL, '2016-03-10 15:16:40', '2016-03-10 15:16:40', 'es', 0, NULL, 0, NULL, NULL),
(24, NULL, 6, NULL, NULL, '2016-03-10 15:16:40', '2016-03-10 15:16:40', 'zh', 0, NULL, 0, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
