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

INSERT INTO `fdcevent_routes` (`id`, `parent_id`, `route`, `name`, `enabled`, `lft`, `lvl`, `rgt`, `root`, `slug`, `position`, `created_at`, `updated_at`, `trans_name`, `hidden`, `has_waiting_page`, `site`, `type`) VALUES
(1, NULL, 'fdc_event_news_index', 'L''actualité', 1, 1, 0, 12, 1, 'fdc-event-news-index', 0, '2016-02-15 18:14:31', '2016-03-09 15:05:26', 'header.mainnav.nav.lactualite', 0, 0, 1, 1),
(2, NULL, 'fdc_event_television_live', 'Web Tv', 1, 1, 0, 8, 2, 'fdc-event-television-live', 1, '2016-02-15 18:16:32', '2016-03-01 23:07:44', 'header.mainnav.nav.webtv', 0, 0, 1, 1),
(3, NULL, 'fdc_event_movie_selection', 'La sélection', 1, 1, 0, 2, 3, 'fdc-event-movie-selection-1', 2, '2016-02-15 18:16:33', '2016-03-01 23:07:46', 'header.mainnav.nav.laselection', 0, 0, 1, 1),
(4, NULL, 'fdc_event_jury_get', 'Les jurys', 1, 1, 0, 2, 4, 'fdc-event-jury-get', 3, '2016-02-15 18:17:48', '2016-03-07 14:32:33', 'header.mainnav.nav.lesjurys', 0, 1, 1, 1),
(5, NULL, 'fdc_event_palmares_get', 'Le palmarès', 1, 1, 0, 2, 5, 'fdc-event-palmares-get', 4, '2016-02-15 18:19:06', '2016-03-07 14:32:51', 'header.mainnav.nav.lepalmares', 0, 1, 1, 1),
(6, NULL, 'fdc_event_event_getevents', 'Les évènements', 1, 1, 0, 2, 6, 'fdc-event-event-getevents', 5, '2016-02-15 18:19:29', '2016-03-02 14:13:15', 'header.mainnav.nav.lesevenements', 0, 0, 1, 1),
(7, NULL, 'fdc_event_agenda_scheduling', 'Programmation', 1, 1, 0, 8, 7, 'fdc-event-agenda-scheduling', 6, '2016-02-15 18:19:43', '2016-03-09 15:10:18', 'header.mainnav.nav.programmation', 0, 0, 1, 1),
(8, NULL, 'fdc_event_participate_prepare', 'Participer', 1, 1, 0, 12, 8, 'fdc-event-participate-prepare', 7, '2016-02-15 18:19:55', '2016-03-01 23:07:59', 'header.mainnav.nav.participer', 0, 0, 1, 1),
(9, 1, 'fdc_event_news_index', 'Jour après jour', 1, 2, 1, 3, 1, 'fdc-event-news-index/fdc-event-news-index-1', 0, '2016-02-15 18:20:42', '2016-03-01 23:11:32', 'header.mainnav.nav.jourapresjour', 0, 0, 1, 1),
(10, 1, 'fdc_event_news_getarticles', 'Articles', 1, 4, 1, 5, 1, 'fdc-event-news-index/fdc-event-news-getarticles', 4, '2016-02-15 18:21:15', '2016-03-01 23:12:15', 'header.mainnav.nav.articles', 0, 0, 1, 1),
(11, 1, 'fdc_event_news_getphotos', 'Photos', 1, 6, 1, 7, 1, 'fdc-event-news-index/fdc-event-news-getphotos', 2, '2016-02-16 15:51:34', '2016-03-01 23:12:28', 'header.mainnav.nav.photos', 0, 0, 1, 1),
(12, 1, 'fdc_event_news_getvideos', 'Vidéos', 1, 8, 1, 9, 1, 'fdc-event-news-index/fdc-event-news-getvideos', 3, '2016-02-16 15:52:25', '2016-03-01 23:12:32', 'header.mainnav.nav.videos', 0, 0, 1, 1),
(13, 1, 'fdc_event_news_getaudios', 'Audios', 1, 10, 1, 11, 1, 'fdc-event-news-index/fdc-event-news-getaudios', 1, '2016-02-16 15:53:11', '2016-03-01 23:12:35', 'header.mainnav.nav.audios', 0, 0, 1, 1),
(14, 2, 'fdc_event_television_live', 'Direct', 1, 2, 1, 3, 2, 'fdc-event-television-live/fdc-event-television-live-1', 0, '2016-02-16 15:54:46', '2016-03-01 23:28:15', 'header.mainnav.nav.direct', 0, 0, 1, 1),
(15, 2, 'fdc_event_television_channels', 'Chaines', 1, 4, 1, 5, 2, 'fdc-event-television-live/fdc-event-television-channels', 1, '2016-02-16 15:55:23', '2016-03-01 23:28:17', 'header.mainnav.nav.chaines', 0, 0, 1, 1),
(16, 2, 'fdc_event_television_trailers', 'Bandes Annonces', 1, 6, 1, 7, 2, 'fdc-event-television-live/fdc-event-television-trailers', 2, '2016-02-16 15:57:05', '2016-03-01 23:28:18', 'header.mainnav.nav.bandesannonces', 0, 0, 1, 1),
(17, 7, 'fdc_event_agenda_scheduling', 'Programmation', 1, 2, 1, 3, 7, 'fdc-event-agenda-scheduling/fdc-event-agenda-scheduling-1', 0, '2016-02-16 15:57:46', '2016-03-01 23:29:28', 'header.mainnav.nav.programmation', 0, 0, 1, 1),
(18, 7, 'fdc_event_agenda_get', 'Agenda', 1, 4, 1, 5, 7, 'fdc-event-agenda-scheduling/fdc-event-agenda-get', 1, '2016-02-16 15:58:09', '2016-03-01 23:29:28', 'header.mainnav.nav.agenda', 0, 0, 1, 1),
(19, 7, 'fdc_event_agenda_room', 'Plan des salles', 1, 6, 1, 7, 7, 'fdc-event-agenda-scheduling/fdc-event-agenda-room', 2, '2016-02-16 15:58:40', '2016-03-01 23:29:30', 'header.mainnav.nav.plandessalles', 0, 0, 1, 1),
(20, 8, 'fdc_event_participate_prepare', 'Préparer son séjour', 1, 2, 1, 3, 8, 'fdc-event-participate-prepare/fdc-event-participate-prepare-1', 0, '2016-02-16 15:59:46', '2016-03-01 23:30:25', 'header.mainnav.nav.preparersejour', 0, 0, 1, 1),
(21, 8, 'fdc_event_participate_festival', 'Festival mode d''emploi', 1, 4, 1, 5, 8, 'fdc-event-participate-prepare/fdc-event-participate-festival', 1, '2016-02-16 16:00:23', '2016-03-01 23:30:28', 'header.mainnav.nav.festivalmodeemploi', 0, 0, 1, 1),
(22, 8, 'fdc_event_participate_access', 'Accès aux projections', 1, 6, 1, 7, 8, 'fdc-event-participate-prepare/fdc-event-participate-access', 2, '2016-02-16 16:01:13', '2016-03-01 23:30:31', 'header.mainnav.nav.accesprojection', 0, 0, 1, 1),
(23, 8, 'fdc_event_participate_partners', 'Partenaires', 1, 8, 1, 9, 8, 'fdc-event-participate-prepare/fdc-event-participate-partners', 3, '2016-02-16 16:01:47', '2016-03-01 23:30:33', 'header.mainnav.nav.partenaires', 0, 0, 1, 1),
(24, 8, 'fdc_event_participate_suppliers', 'Fournisseurs', 1, 10, 1, 11, 8, 'fdc-event-participate-prepare/fdc-event-participate-suppliers', 4, '2016-02-16 16:02:16', '2016-03-01 23:30:35', 'header.mainnav.nav.fournisseurs', 0, 0, 1, 1),
(25, NULL, 'fdc_press_news_home', 'Espace Presse', 1, 1, 0, 2, 25, 'fdc-press-news-home', 8, '2016-03-03 18:34:14', '2016-03-09 15:10:26', 'header.mainnav.nav.espacepresse', 0, 0, 1, 1),
(26, NULL, 'fdc_event_footer_contact', 'Contact', 1, 1, 0, 2, 26, 'fdc-event-footer-contact', 0, '2016-03-09 15:49:03', '2016-03-09 15:49:03', 'footer.nav.contact', 0, 0, 1, 2),
(27, NULL, 'fdc_event_footer_static', 'FAQ', 1, 1, 0, 2, 27, 'fdc-event-footer-static', 1, '2016-03-09 15:53:10', '2016-03-09 17:15:21', 'footer.nav.faq', 0, 0, 1, 2),
(28, NULL, 'fdc_event_footer_static', 'Crédits', 1, 1, 0, 2, 28, 'fdc-event-footer-static-1', 2, '2016-03-09 15:53:55', '2016-03-09 15:53:55', 'footer.nav.credit', 0, 0, 1, 2),
(29, NULL, 'fdc_event_footer_static', 'Mentions Légales', 1, 1, 0, 2, 29, 'fdc-event-footer-static-5', 3, '2016-03-09 15:54:30', '2016-03-09 17:25:58', 'footer.nav.mentionslegales', 0, 0, 1, 2),
(30, NULL, 'fdc_event_footer_static', 'Nous rejoindre', 1, 1, 0, 2, 30, 'fdc-event-footer-static-2', 4, '2016-03-09 15:55:07', '2016-03-09 15:55:07', 'footer.nav.nousrejoindre', 0, 0, 1, 2),
(31, NULL, 'fdc_event_footer_static', 'Plan du site', 1, 1, 0, 2, 31, 'fdc-event-footer-static-3', 5, '2016-03-09 15:58:41', '2016-03-09 17:15:47', 'footer.nav.plandusite', 0, 0, 1, 2),
(32, NULL, 'fdc_event_footer_static', 'Politique de confidentialité', 1, 1, 0, 2, 32, 'fdc-event-footer-static-4', 7, '2016-03-09 17:17:35', '2016-03-09 17:17:35', 'footer.nav.politiqueconfidentialite', 0, 0, 1, 2),
(33, NULL, 'fdc_press_news_home', 'Accueil', 1, 1, 0, 2, 33, 'fdc-press-news-home-1', 0, '2016-03-09 17:46:40', '2016-03-09 17:46:40', 'header.mainnav.nav.accueil', 0, 0, 2, 1),
(34, NULL, 'fdc_press_news_list', 'Communiqués', 1, 1, 0, 2, 34, 'fdc-press-news-list', 1, '2016-03-09 17:47:10', '2016-03-09 18:10:32', 'header.mainnav.nav.communiques', 0, 0, 2, 1),
(35, NULL, 'fdc_press_accredit_main', 'Accréditer', 1, 1, 0, 2, 35, 'fdc-press-accredit-main', 2, '2016-03-09 17:47:31', '2016-03-09 17:47:31', 'header.mainnav.nav.accrediter', 0, 0, 2, 1),
(36, NULL, 'fdc_press_guide_main', 'Guide', 1, 1, 0, 2, 36, 'fdc-press-guide-main', -6, '2016-03-09 17:48:01', '2016-03-09 17:48:01', 'header.mainnav.nav.guide', 0, 0, 2, 1),
(37, NULL, 'fdc_press_agenda_scheduling', 'Programmation', 1, 1, 0, 8, 37, 'fdc-press-agenda-scheduling', 4, '2016-03-09 17:49:01', '2016-03-09 17:49:01', 'header.mainnav.nav.programmation', 0, 0, 2, 1),
(38, 37, 'fdc_press_agenda_scheduling', 'Programmation', 1, 2, 1, 3, 37, 'fdc-press-agenda-scheduling/fdc-press-agenda-scheduling-1', 0, '2016-03-09 17:50:03', '2016-03-09 17:50:03', 'header.mainnav.nav.programmation', 0, 0, 2, 1),
(39, 37, 'fdc_press_agenda_get', 'Agenda', 1, 4, 1, 5, 37, 'fdc-press-agenda-scheduling/fdc-press-agenda-get', 1, '2016-03-09 17:50:40', '2016-03-09 17:50:40', 'header.mainnav.nav.agenda', 0, 0, 2, 1),
(40, 37, 'fdc_press_agenda_room', 'Plan des salles', 1, 6, 1, 7, 37, 'fdc-press-agenda-scheduling/fdc-press-agenda-room', 3, '2016-03-09 17:51:16', '2016-03-09 17:51:16', 'header.mainnav.nav.plandessalles', 0, 0, 2, 1),
(41, NULL, 'fdc_press_media_main', 'Médiathèque', 1, 1, 0, 2, 41, 'fdc-press-media-main', 4, '2016-03-09 17:52:05', '2016-03-09 17:53:27', 'header.mainnav.nav.mediatheque', 0, 0, 2, 1),
(42, NULL, 'fdc_press_media_download', 'Télécharger', 1, 1, 0, 2, 42, 'fdc-press-media-download', 5, '2016-03-09 17:52:54', '2016-03-09 17:52:54', 'header.mainnav.nav.telecharger', 0, 0, 2, 1);

