-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Mar 16 Février 2016 à 18:34
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `festival_cannes_local2`
--

-- --------------------------------------------------------

--
-- Structure de la table `fdcevent_routes`
--

CREATE TABLE `fdcevent_routes` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `lft` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `trans_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcevent_routes`
--

INSERT INTO `fdcevent_routes` (`id`, `parent_id`, `route`, `name`, `enabled`, `lft`, `lvl`, `rgt`, `root`, `slug`, `position`, `created_at`, `updated_at`, `trans_name`) VALUES
(1, NULL, 'fdc_event_news_index', 'L''actualité', 1, 1, 0, 12, 1, 'fdc-event-news-index', 1, '2016-02-15 18:14:31', '2016-02-16 18:21:31', 'header.mainnav.nav.lactualite'),
(2, NULL, 'fdc_event_television_live', 'Web Tv', 1, 1, 0, 8, 2, 'fdc-event-television-live', 0, '2016-02-15 18:16:32', '2016-02-16 15:47:20', 'header.mainnav.nav.webtv'),
(3, NULL, 'fdc_event_movie_selection', 'La sélection', 1, 1, 0, 2, 3, 'fdc-event-movie-selection-1', 2, '2016-02-15 18:16:33', '2016-02-16 18:22:02', 'header.mainnav.nav.laselection'),
(4, NULL, 'fdc_event_jury_get', 'Les jurys', 1, 1, 0, 2, 4, 'fdc-event-jury-get', 3, '2016-02-15 18:17:48', '2016-02-16 18:22:14', 'header.mainnav.nav.lesjurys'),
(5, NULL, 'fdc_event_palmares_get', 'Le palmarès', 1, 1, 0, 2, 5, 'fdc-event-palmares-get', 4, '2016-02-15 18:19:06', '2016-02-16 18:22:26', 'header.mainnav.nav.lepalmares'),
(6, NULL, 'fdc_event_event_getevents', 'Les évènements', 1, 1, 0, 2, 6, 'fdc-event-event-getevents', 5, '2016-02-15 18:19:29', '2016-02-16 18:22:36', 'header.mainnav.nav.lesevenements'),
(7, NULL, 'fdc_event_agenda_scheduling', 'Programmation', 1, 1, 0, 8, 7, 'fdc-event-agenda-scheduling', 6, '2016-02-15 18:19:43', '2016-02-16 18:22:54', 'header.mainnav.nav.programmation'),
(8, NULL, 'fdc_event_participate_prepare', 'Participer', 1, 1, 0, 12, 8, 'fdc-event-participate-prepare', 7, '2016-02-15 18:19:55', '2016-02-16 18:23:06', 'header.mainnav.nav.participer'),
(9, 1, 'fdc_event_news_index', 'Jour après jour', 1, 2, 1, 3, 1, 'fdc-event-news-index/fdc-event-news-index-1', 0, '2016-02-15 18:20:42', '2016-02-16 15:50:12', 'header.mainnav.nav.jourapresjour'),
(10, 1, 'fdc_event_news_getarticles', 'Articles', 1, 4, 1, 5, 1, 'fdc-event-news-index/fdc-event-news-getarticles', 4, '2016-02-15 18:21:15', '2016-02-16 18:06:18', 'header.mainnav.nav.articles'),
(11, 1, 'fdc_event_news_getphotos', 'Photos', 1, 6, 1, 7, 1, 'fdc-event-news-index/fdc-event-news-getphotos', 2, '2016-02-16 15:51:34', '2016-02-16 15:51:34', 'header.mainnav.nav.photos'),
(12, 1, 'fdc_event_news_getvideos', 'Vidéos', 1, 8, 1, 9, 1, 'fdc-event-news-index/fdc-event-news-getvideos', 3, '2016-02-16 15:52:25', '2016-02-16 15:52:25', 'header.mainnav.nav.videos'),
(13, 1, 'fdc_event_news_getaudios', 'Audios', 1, 10, 1, 11, 1, 'fdc-event-news-index/fdc-event-news-getaudios', 1, '2016-02-16 15:53:11', '2016-02-16 18:05:53', 'header.mainnav.nav.audios'),
(14, 2, 'fdc_event_television_live', 'Direct', 1, 2, 1, 3, 2, 'fdc-event-television-live/fdc-event-television-live-1', 0, '2016-02-16 15:54:46', '2016-02-16 15:54:46', 'header.mainnav.nav.direct'),
(15, 2, 'fdc_event_television_channels', 'Chaines', 1, 4, 1, 5, 2, 'fdc-event-television-live/fdc-event-television-channels', 1, '2016-02-16 15:55:23', '2016-02-16 15:55:23', 'header.mainnav.nav.chaines'),
(16, 2, 'fdc_event_television_trailers', 'Bandes Annonces', 1, 6, 1, 7, 2, 'fdc-event-television-live/fdc-event-television-trailers', 2, '2016-02-16 15:57:05', '2016-02-16 15:57:05', 'header.mainnav.nav.bandesannonces'),
(17, 7, 'fdc_event_agenda_scheduling', 'Programmation', 1, 2, 1, 3, 7, 'fdc-event-agenda-scheduling/fdc-event-agenda-scheduling-1', 0, '2016-02-16 15:57:46', '2016-02-16 15:57:46', 'header.mainnav.nav.programmation'),
(18, 7, 'fdc_event_agenda_get', 'Agenda', 1, 4, 1, 5, 7, 'fdc-event-agenda-scheduling/fdc-event-agenda-get', 1, '2016-02-16 15:58:09', '2016-02-16 15:58:09', 'header.mainnav.nav.agenda'),
(19, 7, 'fdc_event_agenda_room', 'Plan des salles', 1, 6, 1, 7, 7, 'fdc-event-agenda-scheduling/fdc-event-agenda-room', 2, '2016-02-16 15:58:40', '2016-02-16 15:58:40', 'header.mainnav.nav.plandessalles'),
(20, 8, 'fdc_event_participate_prepare', 'Préparer son séjour', 1, 2, 1, 3, 8, 'fdc-event-participate-prepare/fdc-event-participate-prepare-1', 0, '2016-02-16 15:59:46', '2016-02-16 15:59:46', 'header.mainnav.nav.preparersejour'),
(21, 8, 'fdc_event_participate_festival', 'Festival mode d''emploi', 1, 4, 1, 5, 8, 'fdc-event-participate-prepare/fdc-event-participate-festival', 1, '2016-02-16 16:00:23', '2016-02-16 16:00:23', 'header.mainnav.nav.festivalmodeemploi'),
(22, 8, 'fdc_event_participate_access', 'Accès aux projections', 1, 6, 1, 7, 8, 'fdc-event-participate-prepare/fdc-event-participate-access', 2, '2016-02-16 16:01:13', '2016-02-16 16:01:13', 'header.mainnav.nav.accesprojection'),
(23, 8, 'fdc_event_participate_partners', 'Partenaires', 1, 8, 1, 9, 8, 'fdc-event-participate-prepare/fdc-event-participate-partners', 3, '2016-02-16 16:01:47', '2016-02-16 16:01:47', 'header.mainnav.nav.partenaires'),
(24, 8, 'fdc_event_participate_suppliers', 'Fournisseurs', 1, 10, 1, 11, 8, 'fdc-event-participate-prepare/fdc-event-participate-suppliers', 4, '2016-02-16 16:02:16', '2016-02-16 16:02:16', 'header.mainnav.nav.fournisseurs');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
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
