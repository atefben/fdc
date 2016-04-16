INSERT INTO `press_guide` (`id`, `guide_arrive_icon`, `guide_meeting_icon`, `guide_information_icon`, `guide_service_icon`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`, `seo_file_id`) VALUES
(1, 'icon_a-votre-service', 'icon_a-votre-service', 'icon_a-votre-service', 'icon_a-votre-service', '2016-03-07 11:48:15', '2016-03-07 11:48:15', 0, 'a:0:{}', 1, NULL);

INSERT INTO `press_guide_translation` (`id`, `locked_by_id`, `translatable_id`, `guide_arrive_title`, `guide_meeting_title`, `guide_information_title`, `guide_service_title`, `status`, `locked_at`, `created_at`, `updated_at`, `locale`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, '2016-03-07 11:48:15', '2016-03-07 11:48:15', 'fr', NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, '2016-03-07 11:48:15', '2016-03-07 11:48:15', 'en', NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, '2016-03-07 11:48:15', '2016-03-07 11:48:15', 'es', NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, '2016-03-07 11:48:15', '2016-03-07 11:48:15', 'zh', NULL, NULL);
