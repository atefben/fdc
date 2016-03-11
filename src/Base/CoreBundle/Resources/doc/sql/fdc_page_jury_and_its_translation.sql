-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 11 Mars 2016 à 16:22
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
-- Contenu de la table `fdcpage_jury`
--

INSERT INTO `fdcpage_jury` (`id`, `image_id`, `jury_type_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, 46, 1, NULL, NOW(), NOW(), 0, 'a:0:{}', 1),
(2, NULL, NULL, NULL, NOW(), NOW(), 0, 'a:0:{}', 1),
(3, NULL, NULL, NULL, NOW(), NOW(), 0, 'a:0:{}', 1),
(4, NULL, NULL, NULL, NOW(), NOW(), 0, 'a:0:{}', 1);

--
-- Contenu de la table `fdcpage_jury_translation`
--

INSERT INTO `fdcpage_jury_translation` (`id`, `locked_by_id`, `translatable_id`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`, `override_name`, `slug`) VALUES
(1, NULL, 1, NOW(), NOW(), 'fr', 1, NULL, 0, NULL, NULL, 'Longs métrages', 'longs-metrages'),
(2, NULL, 1, NOW(), NOW(), 'en', 0, NULL, 0, NULL, NULL, NULL, NULL),
(3, NULL, 1, NOW(), NOW(), 'es', 0, NULL, 0, NULL, NULL, NULL, NULL),
(4, NULL, 1, NOW(), NOW(), 'zh', 0, NULL, 0, NULL, NULL, NULL, NULL),
(5, NULL, 2, NOW(), NOW(), 'fr', 0, NULL, 0, NULL, NULL, NULL, NULL),
(6, NULL, 2, NOW(), NOW(), 'en', 0, NULL, 0, NULL, NULL, NULL, NULL),
(7, NULL, 2, NOW(), NOW(), 'es', 0, NULL, 0, NULL, NULL, NULL, NULL),
(8, NULL, 2, NOW(), NOW(), 'zh', 0, NULL, 0, NULL, NULL, NULL, NULL),
(9, NULL, 3, NOW(), NOW(), 'fr', 0, NULL, 0, NULL, NULL, NULL, NULL),
(10, NULL, 3, NOW(), NOW(), 'en', 0, NULL, 0, NULL, NULL, NULL, NULL),
(11, NULL, 3, NOW(), NOW(), 'es', 0, NULL, 0, NULL, NULL, NULL, NULL),
(12, NULL, 3, NOW(), NOW(), 'zh', 0, NULL, 0, NULL, NULL, NULL, NULL),
(13, NULL, 4, NOW(), NOW(), 'fr', 0, NULL, 0, NULL, NULL, NULL, NULL),
(14, NULL, 4, NOW(), NOW(), 'en', 0, NULL, 0, NULL, NULL, NULL, NULL),
(15, NULL, 4, NOW(), NOW(), 'es', 0, NULL, 0, NULL, NULL, NULL, NULL),
(16, NULL, 4, NOW(), NOW(), 'zh', 0, NULL, 0, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
