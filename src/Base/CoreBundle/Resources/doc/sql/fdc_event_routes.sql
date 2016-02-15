-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Lun 15 Février 2016 à 18:51
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `s_festivalcannes`
--

-- --------------------------------------------------------

--
-- Structure de la table `fdcevent_routes`
--

CREATE TABLE `fdcevent_routes` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcevent_routes`
--

INSERT INTO `fdcevent_routes` (`id`, `created_at`, `updated_at`, `route`, `enabled`, `parent_id`, `lft`, `lvl`, `rgt`, `root`, `slug`, `position`, `name`) VALUES
(1, '2016-02-15 18:14:31', '2016-02-15 18:46:17', 'fdc_event_news_index', 1, NULL, 1, 0, 6, 1, 'fdc-event-news-index', 0, 'L''actualité'),
(2, '2016-02-15 18:16:32', '2016-02-15 18:46:49', 'fdc_event_television_live', 1, NULL, 1, 0, 2, 2, 'fdc-event-television-live', 0, 'Web Tv'),
(3, '2016-02-15 18:16:33', '2016-02-15 18:46:59', 'fdc_event_movie_selection', 1, NULL, 1, 0, 2, 3, 'fdc-event-movie-selection-1', 0, 'La sélection'),
(4, '2016-02-15 18:17:48', '2016-02-15 18:47:05', 'fdc_event_jury_get', 1, NULL, 1, 0, 2, 4, 'fdc-event-jury-get', 0, 'Les jurys'),
(5, '2016-02-15 18:19:06', '2016-02-15 18:47:13', 'fdc_event_palmares_get', 1, NULL, 1, 0, 2, 5, 'fdc-event-palmares-get', 0, 'Le palmarès'),
(6, '2016-02-15 18:19:29', '2016-02-15 18:47:24', 'fdc_event_event_getevents', 1, NULL, 1, 0, 2, 6, 'fdc-event-event-getevents', 0, 'Les évènements'),
(7, '2016-02-15 18:19:43', '2016-02-15 18:47:30', 'fdc_event_agenda_scheduling', 1, NULL, 1, 0, 2, 7, 'fdc-event-agenda-scheduling', 0, 'Programmation'),
(8, '2016-02-15 18:19:55', '2016-02-15 18:47:34', 'fdc_event_participate_prepare', 1, NULL, 1, 0, 2, 8, 'fdc-event-participate-prepare', 0, 'Participer'),
(9, '2016-02-15 18:20:42', '2016-02-15 18:47:39', 'fdc_event_news_index', 1, 1, 2, 1, 3, 1, 'fdc-event-news-index/fdc-event-news-index-1', 0, 'Espace presse'),
(10, '2016-02-15 18:21:15', '2016-02-15 18:47:47', 'fdc_event_news_getarticles', 1, 1, 4, 1, 5, 1, 'fdc-event-news-index/fdc-event-news-getarticles', 0, 'Jour après jour');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `fdcevent_routes`
--
ALTER TABLE `fdcevent_routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EAC657DA727ACA70` (`parent_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `fdcevent_routes`
--
ALTER TABLE `fdcevent_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fdcevent_routes`
--
ALTER TABLE `fdcevent_routes`
  ADD CONSTRAINT `FK_EAC657DA727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `fdcevent_routes` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
