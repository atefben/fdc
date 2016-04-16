-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 08 Février 2016 à 22:58
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
-- Contenu de la table `fdcpage_web_tv_live`
--

INSERT INTO `fdcpage_web_tv_live` (`id`, `image_id`, `seo_file_id`, `live`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`, `do_not_display_web_tv_area`, `do_not_display_trailer_area`, `do_not_display_last_videos_area`) VALUES
(1, NULL, NULL, 0, '2016-02-08 18:50:40', '2016-02-22 10:30:56', 0, 'a:0:{}', 1, 0, 0, 0);

--
-- Contenu de la table `fdcpage_web_tv_live_translation`
--

INSERT INTO `fdcpage_web_tv_live_translation` (`id`, `locked_by_id`, `translatable_id`, `title`, `first_sub_head`, `second_sub_head`, `direct_url`, `teaser_url`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, 'Live Festival', NULL, NULL, NULL, NULL, '2016-02-08 18:50:40', '2016-02-08 19:53:37', 'fr', 1, NULL, NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2016-02-08 18:50:40', '2016-02-08 19:51:59', 'en', 0, NULL, NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2016-02-08 18:50:40', '2016-02-08 18:50:40', 'es', 0, NULL, NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2016-02-08 18:50:40', '2016-02-08 18:50:40', 'zh', 0, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
