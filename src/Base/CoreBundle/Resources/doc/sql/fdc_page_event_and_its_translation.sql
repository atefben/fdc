-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 21 Mars 2016 à 14:46
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
-- Contenu de la table `fdcpage_event`
--

INSERT INTO `fdcpage_event` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NOW(), NOW(), 0, 'a:0:{}', 1);

--
-- Contenu de la table `fdcpage_event_translation`
--

INSERT INTO `fdcpage_event_translation` (`id`, `locked_by_id`, `translatable_id`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NOW(), NOW(), 'fr', 0, NULL, 0, NULL, NULL),
(2, NULL, 1, NOW(), NOW(), 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, NOW(), NOW(), 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, NOW(), NOW(), 'zh', 0, NULL, 0, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
