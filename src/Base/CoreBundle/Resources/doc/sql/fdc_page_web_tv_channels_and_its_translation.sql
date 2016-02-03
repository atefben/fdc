-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 03 Février 2016 à 16:04
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  5.6.17-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `s_festivalcannes`
--

--
-- Contenu de la table `fdcpage_web_tv_channels`
--

INSERT INTO `fdcpage_web_tv_channels` (`id`, `image_id`, `sticky_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`, `seo_file_id`) VALUES
(1, 1, 6, '2016-02-03 14:04:47', '2016-02-03 14:45:27', 0, 'N;', 1, NULL);

--
-- Contenu de la table `fdcpage_web_tv_channels_translation`
--

INSERT INTO `fdcpage_web_tv_channels_translation` (`id`, `translatable_id`, `created_at`, `updated_at`, `locale`, `seo_title`, `seo_description`, `locked_by_id`, `status`, `locked_at`) VALUES
(1, 1, '2016-02-03 14:04:47', '2016-02-03 14:33:46', 'fr', 'WebTV - Toutes les chaînes - Festival de Cannes 2016', 'Retrouvez toutes les chaînes de la webTV du Festival de Cannes 2016', NULL, 1, NULL),
(2, 1, '2016-02-03 14:04:47', '2016-02-03 14:04:47', 'en', NULL, NULL, NULL, 0, NULL),
(3, 1, '2016-02-03 14:04:47', '2016-02-03 14:04:47', 'es', NULL, NULL, NULL, 0, NULL),
(4, 1, '2016-02-03 14:04:47', '2016-02-03 14:04:47', 'zh', NULL, NULL, NULL, 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
