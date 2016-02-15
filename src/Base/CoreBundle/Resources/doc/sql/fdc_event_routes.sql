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