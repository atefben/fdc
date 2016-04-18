INSERT INTO `fdcpage_footer` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-04-08 17:32:32', '2016-04-08 17:32:32', 0, 'a:0:{}', 1),
(2, NULL, '2016-04-08 17:50:09', '2016-04-08 17:50:09', 0, 'a:0:{}', 1),
(3, NULL, '2016-04-08 17:50:22', '2016-04-08 17:50:22', 0, 'a:0:{}', 1);


INSERT INTO `fdcpage_footer_translation` (`id`, `locked_by_id`, `translatable_id`, `title`, `content`, `slug`, `seo_title`, `seo_description`, `status`, `locked_at`, `is_published_on_fdcevent`, `created_at`, `updated_at`, `locale`) VALUES
(1, NULL, 1, 'test', NULL, 'test', NULL, NULL, 1, NULL, 0, '2016-04-08 17:32:32', '2016-04-08 17:40:34', 'fr'),
(2, NULL, 1, NULL, NULL, '', NULL, NULL, 0, NULL, 0, '2016-04-08 17:32:32', '2016-04-08 17:40:34', 'en'),
(3, NULL, 1, NULL, NULL, '-1', NULL, NULL, 0, NULL, 0, '2016-04-08 17:32:32', '2016-04-08 17:40:34', 'es'),
(4, NULL, 1, NULL, NULL, '-2', NULL, NULL, 0, NULL, 0, '2016-04-08 17:32:32', '2016-04-08 17:40:34', 'zh'),
(5, NULL, 2, 'tst', '<p>dsqd</p>\r\n\r\n<p><strong>dsq</strong></p>\r\n\r\n<div class="big-quote"><strong>hey test</strong></div>', 'tst', NULL, NULL, 1, NULL, 0, '2016-04-08 17:50:09', '2016-04-08 18:45:15', 'fr'),
(6, NULL, 2, NULL, NULL, '-3', NULL, NULL, 0, NULL, 0, '2016-04-08 17:50:09', '2016-04-08 18:45:15', 'en'),
(7, NULL, 2, NULL, NULL, '-4', NULL, NULL, 0, NULL, 0, '2016-04-08 17:50:09', '2016-04-08 18:45:15', 'es'),
(8, NULL, 2, NULL, NULL, '-5', NULL, NULL, 0, NULL, 0, '2016-04-08 17:50:09', '2016-04-08 18:45:15', 'zh'),
(9, NULL, 3, 'tst', '<p>ds</p>', 'tst-1', NULL, NULL, 1, NULL, 0, '2016-04-08 17:50:22', '2016-04-08 17:50:22', 'fr'),
(10, NULL, 3, NULL, NULL, '-6', NULL, NULL, 0, NULL, 0, '2016-04-08 17:50:22', '2016-04-08 17:50:22', 'en'),
(11, NULL, 3, NULL, NULL, '-7', NULL, NULL, 0, NULL, 0, '2016-04-08 17:50:22', '2016-04-08 17:50:22', 'es'),
(12, NULL, 3, NULL, NULL, '-8', NULL, NULL, 0, NULL, 0, '2016-04-08 17:50:22', '2016-04-08 17:50:22', 'zh');