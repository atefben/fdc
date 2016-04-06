-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Client :  affif-production.c6wcegemphpj.eu-west-1.rds.amazonaws.com
-- Généré le :  Mer 06 Avril 2016 à 17:47
-- Version du serveur :  5.6.27-log
-- Version de PHP :  5.6.19-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `p_festivalcannes`
--

-- --------------------------------------------------------

--
-- Structure de la table `acl_classes`
--

CREATE TABLE `acl_classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `acl_classes`
--

INSERT INTO `acl_classes` (`id`, `class_type`) VALUES
(4, 'Application\\Sonata\\UserBundle\\Admin\\Entity\\UserAdmin'),
(157, 'Application\\Sonata\\UserBundle\\Entity\\Group'),
(156, 'Application\\Sonata\\UserBundle\\Entity\\User'),
(153, 'Base\\AdminBundle\\Admin\\AmazonRemoteFileAdmin'),
(107, 'Base\\AdminBundle\\Admin\\ContactPageAdmin'),
(8, 'Base\\AdminBundle\\Admin\\ContactThemeAdmin'),
(54, 'Base\\AdminBundle\\Admin\\CountryAdmin'),
(13, 'Base\\AdminBundle\\Admin\\EventAdmin'),
(96, 'Base\\AdminBundle\\Admin\\EventFilmProjectionAssociatedAdmin'),
(56, 'Base\\AdminBundle\\Admin\\EventWidgetAudioDummyAdmin'),
(57, 'Base\\AdminBundle\\Admin\\EventWidgetImageDualAlignDummyAdmin'),
(55, 'Base\\AdminBundle\\Admin\\EventWidgetImageDummyAdmin'),
(58, 'Base\\AdminBundle\\Admin\\EventWidgetQuoteDummyAdmin'),
(62, 'Base\\AdminBundle\\Admin\\EventWidgetSubtitleDummyAdmin'),
(59, 'Base\\AdminBundle\\Admin\\EventWidgetTextDummyAdmin'),
(60, 'Base\\AdminBundle\\Admin\\EventWidgetVideoDummyAdmin'),
(61, 'Base\\AdminBundle\\Admin\\EventWidgetVideoYoutubeDummyAdmin'),
(11, 'Base\\AdminBundle\\Admin\\FDCEventRoutesAdmin'),
(43, 'Base\\AdminBundle\\Admin\\FDCPageAwardAdmin'),
(44, 'Base\\AdminBundle\\Admin\\FDCPageAwardOtherSelectionSectionsAssociatedAdmin'),
(45, 'Base\\AdminBundle\\Admin\\FDCPageEventAdmin'),
(42, 'Base\\AdminBundle\\Admin\\FDCPageJuryAdmin'),
(40, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionAdmin'),
(39, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsAdmin'),
(146, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsWidgetAudioDummyAdmin'),
(148, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsWidgetImageDualAlignDummyAdmin'),
(147, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsWidgetImageDummyAdmin'),
(145, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsWidgetMovieDummyAdmin'),
(149, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsWidgetQuoteDummyAdmin'),
(150, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsWidgetTextDummyAdmin'),
(151, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsWidgetVideoDummyAdmin'),
(152, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCannesClassicsWidgetVideoYoutubeDummyAdmin'),
(41, 'Base\\AdminBundle\\Admin\\FDCPageLaSelectionCinemaPlageAdmin'),
(48, 'Base\\AdminBundle\\Admin\\FDCPageNewsArticlesAdmin'),
(50, 'Base\\AdminBundle\\Admin\\FDCPageNewsAudiosAdmin'),
(49, 'Base\\AdminBundle\\Admin\\FDCPageNewsImagesAdmin'),
(51, 'Base\\AdminBundle\\Admin\\FDCPageNewsVideosAdmin'),
(122, 'Base\\AdminBundle\\Admin\\FDCPageParticipateAdmin'),
(124, 'Base\\AdminBundle\\Admin\\FDCPageParticipateHasSectionAdmin'),
(123, 'Base\\AdminBundle\\Admin\\FDCPageParticipateSectionAdmin'),
(129, 'Base\\AdminBundle\\Admin\\FDCPageParticipateSectionWidgetTypefiveDummyAdmin'),
(128, 'Base\\AdminBundle\\Admin\\FDCPageParticipateSectionWidgetTypefourDummyAdmin'),
(125, 'Base\\AdminBundle\\Admin\\FDCPageParticipateSectionWidgetTypeoneDummyAdmin'),
(127, 'Base\\AdminBundle\\Admin\\FDCPageParticipateSectionWidgetTypethreeDummyAdmin'),
(126, 'Base\\AdminBundle\\Admin\\FDCPageParticipateSectionWidgetTypetwoDummyAdmin'),
(119, 'Base\\AdminBundle\\Admin\\FDCPagePrepareAdmin'),
(121, 'Base\\AdminBundle\\Admin\\FDCPagePrepareWidgetColumnDummyAdmin'),
(120, 'Base\\AdminBundle\\Admin\\FDCPagePrepareWidgetImageDummyAdmin'),
(12, 'Base\\AdminBundle\\Admin\\FDCPageWaitingAdmin'),
(34, 'Base\\AdminBundle\\Admin\\FDCPageWebTvChannelsAdmin'),
(35, 'Base\\AdminBundle\\Admin\\FDCPageWebTvLiveAdmin'),
(37, 'Base\\AdminBundle\\Admin\\FDCPageWebTvLiveMediaVideoAssociatedAdmin'),
(36, 'Base\\AdminBundle\\Admin\\FDCPageWebTvLiveWebTvAssociatedAdmin'),
(38, 'Base\\AdminBundle\\Admin\\FDCPageWebTvTrailersAdmin'),
(32, 'Base\\AdminBundle\\Admin\\FilmAtelierAdmin'),
(30, 'Base\\AdminBundle\\Admin\\FilmFilmAdmin'),
(84, 'Base\\AdminBundle\\Admin\\FilmFilmMediaAdmin'),
(144, 'Base\\AdminBundle\\Admin\\FilmFilmTagAdmin'),
(46, 'Base\\AdminBundle\\Admin\\FilmJuryTypeAdmin'),
(85, 'Base\\AdminBundle\\Admin\\FilmMediaAdmin'),
(33, 'Base\\AdminBundle\\Admin\\FilmPersonAdmin'),
(31, 'Base\\AdminBundle\\Admin\\FilmProjectionAdmin'),
(47, 'Base\\AdminBundle\\Admin\\FilmSelectionSectionAdmin'),
(71, 'Base\\AdminBundle\\Admin\\GalleryAdmin'),
(73, 'Base\\AdminBundle\\Admin\\GalleryDualAlignAdmin'),
(74, 'Base\\AdminBundle\\Admin\\GalleryDualAlignMediaAdmin'),
(72, 'Base\\AdminBundle\\Admin\\GalleryMediaAdmin'),
(52, 'Base\\AdminBundle\\Admin\\HomepageAdmin'),
(66, 'Base\\AdminBundle\\Admin\\HomepageFilmsAssociatedAdmin'),
(53, 'Base\\AdminBundle\\Admin\\HomepageSlideAdmin'),
(75, 'Base\\AdminBundle\\Admin\\HomepageTopVideosAssociatedAdmin'),
(76, 'Base\\AdminBundle\\Admin\\HomepageTopWebTvsAssociatedAdmin'),
(102, 'Base\\AdminBundle\\Admin\\InfoAdmin'),
(18, 'Base\\AdminBundle\\Admin\\InfoArticleAdmin'),
(21, 'Base\\AdminBundle\\Admin\\InfoAudioAdmin'),
(106, 'Base\\AdminBundle\\Admin\\InfoFilmFilmAssociatedAdmin'),
(105, 'Base\\AdminBundle\\Admin\\InfoFilmProjectionAssociatedAdmin'),
(20, 'Base\\AdminBundle\\Admin\\InfoImageAdmin'),
(104, 'Base\\AdminBundle\\Admin\\InfoInfoAssociatedAdmin'),
(103, 'Base\\AdminBundle\\Admin\\InfoTagAdmin'),
(19, 'Base\\AdminBundle\\Admin\\InfoVideoAdmin'),
(99, 'Base\\AdminBundle\\Admin\\InfoWidgetAudioDummyAdmin'),
(98, 'Base\\AdminBundle\\Admin\\InfoWidgetImageDualAlignDummyAdmin'),
(97, 'Base\\AdminBundle\\Admin\\InfoWidgetImageDummyAdmin'),
(100, 'Base\\AdminBundle\\Admin\\InfoWidgetVideoDummyAdmin'),
(101, 'Base\\AdminBundle\\Admin\\InfoWidgetVideoYoutubeDummyAdmin'),
(70, 'Base\\AdminBundle\\Admin\\MediaAdmin'),
(28, 'Base\\AdminBundle\\Admin\\MediaAudioAdmin'),
(83, 'Base\\AdminBundle\\Admin\\MediaAudioFilmFilmAssociatedAdmin'),
(143, 'Base\\AdminBundle\\Admin\\MediaFilmProjectionAssociatedAdmin'),
(26, 'Base\\AdminBundle\\Admin\\MediaImageAdmin'),
(27, 'Base\\AdminBundle\\Admin\\MediaImageSimpleAdmin'),
(69, 'Base\\AdminBundle\\Admin\\MediaTagAdmin'),
(29, 'Base\\AdminBundle\\Admin\\MediaVideoAdmin'),
(82, 'Base\\AdminBundle\\Admin\\MediaVideoFilmFilmAssociatedAdmin'),
(77, 'Base\\AdminBundle\\Admin\\NewsAdmin'),
(22, 'Base\\AdminBundle\\Admin\\NewsArticleAdmin'),
(25, 'Base\\AdminBundle\\Admin\\NewsAudioAdmin'),
(81, 'Base\\AdminBundle\\Admin\\NewsFilmFilmAssociatedAdmin'),
(80, 'Base\\AdminBundle\\Admin\\NewsFilmProjectionAssociatedAdmin'),
(24, 'Base\\AdminBundle\\Admin\\NewsImageAdmin'),
(79, 'Base\\AdminBundle\\Admin\\NewsNewsAssociatedAdmin'),
(78, 'Base\\AdminBundle\\Admin\\NewsTagAdmin'),
(23, 'Base\\AdminBundle\\Admin\\NewsVideoAdmin'),
(63, 'Base\\AdminBundle\\Admin\\NewsWidgetAudioDummyAdmin'),
(65, 'Base\\AdminBundle\\Admin\\NewsWidgetImageDualAlignDummyAdmin'),
(64, 'Base\\AdminBundle\\Admin\\NewsWidgetImageDummyAdmin'),
(67, 'Base\\AdminBundle\\Admin\\NewsWidgetVideoDummyAdmin'),
(68, 'Base\\AdminBundle\\Admin\\NewsWidgetVideoYoutubeDummyAdmin'),
(113, 'Base\\AdminBundle\\Admin\\PressAccreditAdmin'),
(114, 'Base\\AdminBundle\\Admin\\PressAccreditHasProcedureAdmin'),
(115, 'Base\\AdminBundle\\Admin\\PressAccreditProcedureAdmin'),
(136, 'Base\\AdminBundle\\Admin\\PressCinemaMapAdmin'),
(137, 'Base\\AdminBundle\\Admin\\PressCinemaMapRoomAdmin'),
(135, 'Base\\AdminBundle\\Admin\\PressCinemaRoomAdmin'),
(131, 'Base\\AdminBundle\\Admin\\PressDownloadAdmin'),
(133, 'Base\\AdminBundle\\Admin\\PressDownloadHasSectionAdmin'),
(132, 'Base\\AdminBundle\\Admin\\PressDownloadSectionAdmin'),
(141, 'Base\\AdminBundle\\Admin\\PressDownloadSectionWidgetArchiveDummyAdmin'),
(140, 'Base\\AdminBundle\\Admin\\PressDownloadSectionWidgetDocumentDummyAdmin'),
(142, 'Base\\AdminBundle\\Admin\\PressDownloadSectionWidgetFileDummyAdmin'),
(138, 'Base\\AdminBundle\\Admin\\PressDownloadSectionWidgetPhotoDummyAdmin'),
(139, 'Base\\AdminBundle\\Admin\\PressDownloadSectionWidgetVideoDummyAdmin'),
(116, 'Base\\AdminBundle\\Admin\\PressGuideAdmin'),
(118, 'Base\\AdminBundle\\Admin\\PressGuideWidgetColumnDummyAdmin'),
(117, 'Base\\AdminBundle\\Admin\\PressGuideWidgetImageDummyAdmin'),
(109, 'Base\\AdminBundle\\Admin\\PressHomepageAdmin'),
(112, 'Base\\AdminBundle\\Admin\\PressHomepageDownloadAdmin'),
(111, 'Base\\AdminBundle\\Admin\\PressHomepageMediaAdmin'),
(110, 'Base\\AdminBundle\\Admin\\PressHomepageSectionAdmin'),
(130, 'Base\\AdminBundle\\Admin\\PressMediaLibraryAdmin'),
(134, 'Base\\AdminBundle\\Admin\\PressProjectionAdmin'),
(108, 'Base\\AdminBundle\\Admin\\PressStatementInfoAdmin'),
(9, 'Base\\AdminBundle\\Admin\\SocialWallAdmin'),
(89, 'Base\\AdminBundle\\Admin\\StatementAdmin'),
(14, 'Base\\AdminBundle\\Admin\\StatementArticleAdmin'),
(17, 'Base\\AdminBundle\\Admin\\StatementAudioAdmin'),
(93, 'Base\\AdminBundle\\Admin\\StatementFilmFilmAssociatedAdmin'),
(92, 'Base\\AdminBundle\\Admin\\StatementFilmProjectionAssociatedAdmin'),
(16, 'Base\\AdminBundle\\Admin\\StatementImageAdmin'),
(91, 'Base\\AdminBundle\\Admin\\StatementStatementAssociatedAdmin'),
(90, 'Base\\AdminBundle\\Admin\\StatementTagAdmin'),
(15, 'Base\\AdminBundle\\Admin\\StatementVideoAdmin'),
(88, 'Base\\AdminBundle\\Admin\\StatementWidgetAudioDummyAdmin'),
(87, 'Base\\AdminBundle\\Admin\\StatementWidgetImageDualAlignDummyAdmin'),
(86, 'Base\\AdminBundle\\Admin\\StatementWidgetImageDummyAdmin'),
(94, 'Base\\AdminBundle\\Admin\\StatementWidgetVideoDummyAdmin'),
(95, 'Base\\AdminBundle\\Admin\\StatementWidgetVideoYoutubeDummyAdmin'),
(6, 'Base\\AdminBundle\\Admin\\TagAdmin'),
(10, 'Base\\AdminBundle\\Admin\\ThemeAdmin'),
(7, 'Base\\AdminBundle\\Admin\\WebTvAdmin'),
(154, 'Base\\AdminBundle\\Admin\\WidgetMovieAdmin'),
(155, 'Base\\AdminBundle\\Admin\\WidgetMovieFilmFilmAdmin'),
(169, 'Base\\CoreBundle\\Entity\\ContactPage'),
(158, 'Base\\CoreBundle\\Entity\\FDCEventRoutes'),
(180, 'Base\\CoreBundle\\Entity\\FDCPageAward'),
(163, 'Base\\CoreBundle\\Entity\\FDCPageEvent'),
(179, 'Base\\CoreBundle\\Entity\\FDCPageJury'),
(161, 'Base\\CoreBundle\\Entity\\FDCPageLaSelection'),
(162, 'Base\\CoreBundle\\Entity\\FDCPageLaSelectionCinemaPlage'),
(164, 'Base\\CoreBundle\\Entity\\FDCPageNewsArticles'),
(166, 'Base\\CoreBundle\\Entity\\FDCPageNewsAudios'),
(165, 'Base\\CoreBundle\\Entity\\FDCPageNewsImages'),
(167, 'Base\\CoreBundle\\Entity\\FDCPageNewsVideos'),
(181, 'Base\\CoreBundle\\Entity\\FDCPagePrepare'),
(159, 'Base\\CoreBundle\\Entity\\FDCPageWebTvChannels'),
(160, 'Base\\CoreBundle\\Entity\\FDCPageWebTvLive'),
(168, 'Base\\CoreBundle\\Entity\\Homepage'),
(176, 'Base\\CoreBundle\\Entity\\PressAccredit'),
(177, 'Base\\CoreBundle\\Entity\\PressCinemaMap'),
(174, 'Base\\CoreBundle\\Entity\\PressDownload'),
(170, 'Base\\CoreBundle\\Entity\\PressGuide'),
(172, 'Base\\CoreBundle\\Entity\\PressHomepage'),
(175, 'Base\\CoreBundle\\Entity\\PressMediaLibrary'),
(178, 'Base\\CoreBundle\\Entity\\PressProjection'),
(173, 'Base\\CoreBundle\\Entity\\PressStatementInfo'),
(171, 'Base\\CoreBundle\\Entity\\Tag'),
(2, 'Sonata\\MediaBundle\\Admin\\GalleryAdmin'),
(3, 'Sonata\\MediaBundle\\Admin\\GalleryHasMediaAdmin'),
(1, 'Sonata\\MediaBundle\\Admin\\ORM\\MediaAdmin'),
(5, 'Sonata\\UserBundle\\Admin\\Entity\\GroupAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `acl_entries`
--

CREATE TABLE `acl_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `object_identity_id` int(10) UNSIGNED DEFAULT NULL,
  `security_identity_id` int(10) UNSIGNED NOT NULL,
  `field_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ace_order` smallint(5) UNSIGNED NOT NULL,
  `mask` int(11) NOT NULL,
  `granting` tinyint(1) NOT NULL,
  `granting_strategy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `audit_success` tinyint(1) NOT NULL,
  `audit_failure` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `acl_entries`
--

INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES
(1, 1, NULL, 1, NULL, 0, 12346, 1, 'all', 0, 0),
(2, 1, NULL, 2, NULL, 1, 12288, 1, 'all', 0, 0),
(3, 1, NULL, 3, NULL, 2, 4096, 1, 'all', 0, 0),
(4, 1, NULL, 4, NULL, 3, 4154, 1, 'all', 0, 0),
(5, 1, NULL, 5, NULL, 4, 4130, 1, 'all', 0, 0),
(6, 2, NULL, 6, NULL, 0, 12346, 1, 'all', 0, 0),
(7, 2, NULL, 7, NULL, 1, 12288, 1, 'all', 0, 0),
(8, 2, NULL, 8, NULL, 2, 4096, 1, 'all', 0, 0),
(9, 2, NULL, 9, NULL, 3, 4154, 1, 'all', 0, 0),
(10, 2, NULL, 10, NULL, 4, 4130, 1, 'all', 0, 0),
(11, 3, NULL, 11, NULL, 0, 12346, 1, 'all', 0, 0),
(12, 3, NULL, 12, NULL, 1, 12288, 1, 'all', 0, 0),
(13, 3, NULL, 13, NULL, 2, 4096, 1, 'all', 0, 0),
(14, 3, NULL, 14, NULL, 3, 4154, 1, 'all', 0, 0),
(15, 3, NULL, 15, NULL, 4, 4130, 1, 'all', 0, 0),
(16, 4, NULL, 16, NULL, 0, 12346, 1, 'all', 0, 0),
(17, 4, NULL, 17, NULL, 1, 12288, 1, 'all', 0, 0),
(18, 4, NULL, 18, NULL, 2, 4096, 1, 'all', 0, 0),
(19, 4, NULL, 19, NULL, 3, 4154, 1, 'all', 0, 0),
(20, 4, NULL, 20, NULL, 4, 4130, 1, 'all', 0, 0),
(21, 5, NULL, 21, NULL, 0, 12346, 1, 'all', 0, 0),
(22, 5, NULL, 22, NULL, 1, 12288, 1, 'all', 0, 0),
(23, 5, NULL, 23, NULL, 2, 4096, 1, 'all', 0, 0),
(24, 5, NULL, 24, NULL, 3, 4154, 1, 'all', 0, 0),
(25, 5, NULL, 25, NULL, 4, 4130, 1, 'all', 0, 0),
(26, 6, NULL, 26, NULL, 0, 12346, 1, 'all', 0, 0),
(27, 6, NULL, 27, NULL, 1, 12288, 1, 'all', 0, 0),
(28, 6, NULL, 28, NULL, 2, 4096, 1, 'all', 0, 0),
(29, 6, NULL, 29, NULL, 3, 4154, 1, 'all', 0, 0),
(30, 6, NULL, 30, NULL, 4, 4130, 1, 'all', 0, 0),
(31, 7, NULL, 31, NULL, 0, 12346, 1, 'all', 0, 0),
(32, 7, NULL, 32, NULL, 1, 12288, 1, 'all', 0, 0),
(33, 7, NULL, 33, NULL, 2, 4096, 1, 'all', 0, 0),
(34, 7, NULL, 34, NULL, 3, 4154, 1, 'all', 0, 0),
(35, 7, NULL, 35, NULL, 4, 4130, 1, 'all', 0, 0),
(36, 8, NULL, 36, NULL, 0, 12346, 1, 'all', 0, 0),
(37, 8, NULL, 37, NULL, 1, 12288, 1, 'all', 0, 0),
(38, 8, NULL, 38, NULL, 2, 4096, 1, 'all', 0, 0),
(39, 8, NULL, 39, NULL, 3, 4154, 1, 'all', 0, 0),
(40, 8, NULL, 40, NULL, 4, 4130, 1, 'all', 0, 0),
(41, 9, NULL, 41, NULL, 0, 12346, 1, 'all', 0, 0),
(42, 9, NULL, 42, NULL, 1, 12288, 1, 'all', 0, 0),
(43, 9, NULL, 43, NULL, 2, 4096, 1, 'all', 0, 0),
(44, 9, NULL, 44, NULL, 3, 4154, 1, 'all', 0, 0),
(45, 9, NULL, 45, NULL, 4, 4130, 1, 'all', 0, 0),
(46, 10, NULL, 46, NULL, 0, 12346, 1, 'all', 0, 0),
(47, 10, NULL, 47, NULL, 1, 12288, 1, 'all', 0, 0),
(48, 10, NULL, 48, NULL, 2, 4096, 1, 'all', 0, 0),
(49, 10, NULL, 49, NULL, 3, 4154, 1, 'all', 0, 0),
(50, 10, NULL, 50, NULL, 4, 4130, 1, 'all', 0, 0),
(51, 11, NULL, 51, NULL, 0, 12346, 1, 'all', 0, 0),
(52, 11, NULL, 52, NULL, 1, 12288, 1, 'all', 0, 0),
(53, 11, NULL, 53, NULL, 2, 4096, 1, 'all', 0, 0),
(54, 11, NULL, 54, NULL, 3, 4154, 1, 'all', 0, 0),
(55, 11, NULL, 55, NULL, 4, 4130, 1, 'all', 0, 0),
(56, 12, NULL, 56, NULL, 0, 12346, 1, 'all', 0, 0),
(57, 12, NULL, 57, NULL, 1, 12288, 1, 'all', 0, 0),
(58, 12, NULL, 58, NULL, 2, 4096, 1, 'all', 0, 0),
(59, 12, NULL, 59, NULL, 3, 4154, 1, 'all', 0, 0),
(60, 12, NULL, 60, NULL, 4, 4130, 1, 'all', 0, 0),
(61, 13, NULL, 61, NULL, 0, 12346, 1, 'all', 0, 0),
(62, 13, NULL, 62, NULL, 1, 12288, 1, 'all', 0, 0),
(63, 13, NULL, 63, NULL, 2, 4096, 1, 'all', 0, 0),
(64, 13, NULL, 64, NULL, 3, 4154, 1, 'all', 0, 0),
(65, 13, NULL, 65, NULL, 4, 4130, 1, 'all', 0, 0),
(66, 14, NULL, 66, NULL, 0, 12346, 1, 'all', 0, 0),
(67, 14, NULL, 67, NULL, 1, 12288, 1, 'all', 0, 0),
(68, 14, NULL, 68, NULL, 2, 4096, 1, 'all', 0, 0),
(69, 14, NULL, 69, NULL, 3, 4154, 1, 'all', 0, 0),
(70, 14, NULL, 70, NULL, 4, 4130, 1, 'all', 0, 0),
(71, 15, NULL, 71, NULL, 0, 12346, 1, 'all', 0, 0),
(72, 15, NULL, 72, NULL, 1, 12288, 1, 'all', 0, 0),
(73, 15, NULL, 73, NULL, 2, 4096, 1, 'all', 0, 0),
(74, 15, NULL, 74, NULL, 3, 4154, 1, 'all', 0, 0),
(75, 15, NULL, 75, NULL, 4, 4130, 1, 'all', 0, 0),
(76, 16, NULL, 76, NULL, 0, 12346, 1, 'all', 0, 0),
(77, 16, NULL, 77, NULL, 1, 12288, 1, 'all', 0, 0),
(78, 16, NULL, 78, NULL, 2, 4096, 1, 'all', 0, 0),
(79, 16, NULL, 79, NULL, 3, 4154, 1, 'all', 0, 0),
(80, 16, NULL, 80, NULL, 4, 4130, 1, 'all', 0, 0),
(81, 17, NULL, 81, NULL, 0, 12346, 1, 'all', 0, 0),
(82, 17, NULL, 82, NULL, 1, 12288, 1, 'all', 0, 0),
(83, 17, NULL, 83, NULL, 2, 4096, 1, 'all', 0, 0),
(84, 17, NULL, 84, NULL, 3, 4154, 1, 'all', 0, 0),
(85, 17, NULL, 85, NULL, 4, 4130, 1, 'all', 0, 0),
(86, 18, NULL, 86, NULL, 0, 12346, 1, 'all', 0, 0),
(87, 18, NULL, 87, NULL, 1, 12288, 1, 'all', 0, 0),
(88, 18, NULL, 88, NULL, 2, 4096, 1, 'all', 0, 0),
(89, 18, NULL, 89, NULL, 3, 4154, 1, 'all', 0, 0),
(90, 18, NULL, 90, NULL, 4, 4130, 1, 'all', 0, 0),
(91, 19, NULL, 91, NULL, 0, 12346, 1, 'all', 0, 0),
(92, 19, NULL, 92, NULL, 1, 12288, 1, 'all', 0, 0),
(93, 19, NULL, 93, NULL, 2, 4096, 1, 'all', 0, 0),
(94, 19, NULL, 94, NULL, 3, 4154, 1, 'all', 0, 0),
(95, 19, NULL, 95, NULL, 4, 4130, 1, 'all', 0, 0),
(96, 20, NULL, 96, NULL, 0, 12346, 1, 'all', 0, 0),
(97, 20, NULL, 97, NULL, 1, 12288, 1, 'all', 0, 0),
(98, 20, NULL, 98, NULL, 2, 4096, 1, 'all', 0, 0),
(99, 20, NULL, 99, NULL, 3, 4154, 1, 'all', 0, 0),
(100, 20, NULL, 100, NULL, 4, 4130, 1, 'all', 0, 0),
(101, 21, NULL, 101, NULL, 0, 12346, 1, 'all', 0, 0),
(102, 21, NULL, 102, NULL, 1, 12288, 1, 'all', 0, 0),
(103, 21, NULL, 103, NULL, 2, 4096, 1, 'all', 0, 0),
(104, 21, NULL, 104, NULL, 3, 4154, 1, 'all', 0, 0),
(105, 21, NULL, 105, NULL, 4, 4130, 1, 'all', 0, 0),
(106, 22, NULL, 106, NULL, 0, 12346, 1, 'all', 0, 0),
(107, 22, NULL, 107, NULL, 1, 12288, 1, 'all', 0, 0),
(108, 22, NULL, 108, NULL, 2, 4096, 1, 'all', 0, 0),
(109, 22, NULL, 109, NULL, 3, 4154, 1, 'all', 0, 0),
(110, 22, NULL, 110, NULL, 4, 4130, 1, 'all', 0, 0),
(111, 23, NULL, 111, NULL, 0, 12346, 1, 'all', 0, 0),
(112, 23, NULL, 112, NULL, 1, 12288, 1, 'all', 0, 0),
(113, 23, NULL, 113, NULL, 2, 4096, 1, 'all', 0, 0),
(114, 23, NULL, 114, NULL, 3, 4154, 1, 'all', 0, 0),
(115, 23, NULL, 115, NULL, 4, 4130, 1, 'all', 0, 0),
(116, 24, NULL, 116, NULL, 0, 12346, 1, 'all', 0, 0),
(117, 24, NULL, 117, NULL, 1, 12288, 1, 'all', 0, 0),
(118, 24, NULL, 118, NULL, 2, 4096, 1, 'all', 0, 0),
(119, 24, NULL, 119, NULL, 3, 4154, 1, 'all', 0, 0),
(120, 24, NULL, 120, NULL, 4, 4130, 1, 'all', 0, 0),
(121, 25, NULL, 121, NULL, 0, 12346, 1, 'all', 0, 0),
(122, 25, NULL, 122, NULL, 1, 12288, 1, 'all', 0, 0),
(123, 25, NULL, 123, NULL, 2, 4096, 1, 'all', 0, 0),
(124, 25, NULL, 124, NULL, 3, 4154, 1, 'all', 0, 0),
(125, 25, NULL, 125, NULL, 4, 4130, 1, 'all', 0, 0),
(126, 26, NULL, 126, NULL, 0, 12346, 1, 'all', 0, 0),
(127, 26, NULL, 127, NULL, 1, 12288, 1, 'all', 0, 0),
(128, 26, NULL, 128, NULL, 2, 4096, 1, 'all', 0, 0),
(129, 26, NULL, 129, NULL, 3, 4154, 1, 'all', 0, 0),
(130, 26, NULL, 130, NULL, 4, 4130, 1, 'all', 0, 0),
(131, 27, NULL, 131, NULL, 0, 12346, 1, 'all', 0, 0),
(132, 27, NULL, 132, NULL, 1, 12288, 1, 'all', 0, 0),
(133, 27, NULL, 133, NULL, 2, 4096, 1, 'all', 0, 0),
(134, 27, NULL, 134, NULL, 3, 4154, 1, 'all', 0, 0),
(135, 27, NULL, 135, NULL, 4, 4130, 1, 'all', 0, 0),
(136, 28, NULL, 136, NULL, 0, 12346, 1, 'all', 0, 0),
(137, 28, NULL, 137, NULL, 1, 12288, 1, 'all', 0, 0),
(138, 28, NULL, 138, NULL, 2, 4096, 1, 'all', 0, 0),
(139, 28, NULL, 139, NULL, 3, 4154, 1, 'all', 0, 0),
(140, 28, NULL, 140, NULL, 4, 4130, 1, 'all', 0, 0),
(141, 29, NULL, 141, NULL, 0, 12346, 1, 'all', 0, 0),
(142, 29, NULL, 142, NULL, 1, 12288, 1, 'all', 0, 0),
(143, 29, NULL, 143, NULL, 2, 4096, 1, 'all', 0, 0),
(144, 29, NULL, 144, NULL, 3, 4154, 1, 'all', 0, 0),
(145, 29, NULL, 145, NULL, 4, 4130, 1, 'all', 0, 0),
(146, 30, NULL, 146, NULL, 0, 12346, 1, 'all', 0, 0),
(147, 30, NULL, 147, NULL, 1, 12288, 1, 'all', 0, 0),
(148, 30, NULL, 148, NULL, 2, 4096, 1, 'all', 0, 0),
(149, 30, NULL, 149, NULL, 3, 4154, 1, 'all', 0, 0),
(150, 30, NULL, 150, NULL, 4, 4130, 1, 'all', 0, 0),
(151, 31, NULL, 151, NULL, 0, 12346, 1, 'all', 0, 0),
(152, 31, NULL, 152, NULL, 1, 12288, 1, 'all', 0, 0),
(153, 31, NULL, 153, NULL, 2, 4096, 1, 'all', 0, 0),
(154, 31, NULL, 154, NULL, 3, 4154, 1, 'all', 0, 0),
(155, 31, NULL, 155, NULL, 4, 4130, 1, 'all', 0, 0),
(156, 32, NULL, 156, NULL, 0, 12346, 1, 'all', 0, 0),
(157, 32, NULL, 157, NULL, 1, 12288, 1, 'all', 0, 0),
(158, 32, NULL, 158, NULL, 2, 4096, 1, 'all', 0, 0),
(159, 32, NULL, 159, NULL, 3, 4154, 1, 'all', 0, 0),
(160, 32, NULL, 160, NULL, 4, 4130, 1, 'all', 0, 0),
(161, 33, NULL, 161, NULL, 0, 12346, 1, 'all', 0, 0),
(162, 33, NULL, 162, NULL, 1, 12288, 1, 'all', 0, 0),
(163, 33, NULL, 163, NULL, 2, 4096, 1, 'all', 0, 0),
(164, 33, NULL, 164, NULL, 3, 4154, 1, 'all', 0, 0),
(165, 33, NULL, 165, NULL, 4, 4130, 1, 'all', 0, 0),
(166, 34, NULL, 166, NULL, 0, 12346, 1, 'all', 0, 0),
(167, 34, NULL, 167, NULL, 1, 12288, 1, 'all', 0, 0),
(168, 34, NULL, 168, NULL, 2, 4096, 1, 'all', 0, 0),
(169, 34, NULL, 169, NULL, 3, 4154, 1, 'all', 0, 0),
(170, 34, NULL, 170, NULL, 4, 4130, 1, 'all', 0, 0),
(171, 35, NULL, 171, NULL, 0, 12346, 1, 'all', 0, 0),
(172, 35, NULL, 172, NULL, 1, 12288, 1, 'all', 0, 0),
(173, 35, NULL, 173, NULL, 2, 4096, 1, 'all', 0, 0),
(174, 35, NULL, 174, NULL, 3, 4154, 1, 'all', 0, 0),
(175, 35, NULL, 175, NULL, 4, 4130, 1, 'all', 0, 0),
(176, 36, NULL, 176, NULL, 0, 12346, 1, 'all', 0, 0),
(177, 36, NULL, 177, NULL, 1, 12288, 1, 'all', 0, 0),
(178, 36, NULL, 178, NULL, 2, 4096, 1, 'all', 0, 0),
(179, 36, NULL, 179, NULL, 3, 4154, 1, 'all', 0, 0),
(180, 36, NULL, 180, NULL, 4, 4130, 1, 'all', 0, 0),
(181, 37, NULL, 181, NULL, 0, 12346, 1, 'all', 0, 0),
(182, 37, NULL, 182, NULL, 1, 12288, 1, 'all', 0, 0),
(183, 37, NULL, 183, NULL, 2, 4096, 1, 'all', 0, 0),
(184, 37, NULL, 184, NULL, 3, 4154, 1, 'all', 0, 0),
(185, 37, NULL, 185, NULL, 4, 4130, 1, 'all', 0, 0),
(186, 38, NULL, 186, NULL, 0, 12346, 1, 'all', 0, 0),
(187, 38, NULL, 187, NULL, 1, 12288, 1, 'all', 0, 0),
(188, 38, NULL, 188, NULL, 2, 4096, 1, 'all', 0, 0),
(189, 38, NULL, 189, NULL, 3, 4154, 1, 'all', 0, 0),
(190, 38, NULL, 190, NULL, 4, 4130, 1, 'all', 0, 0),
(191, 39, NULL, 191, NULL, 0, 12346, 1, 'all', 0, 0),
(192, 39, NULL, 192, NULL, 1, 12288, 1, 'all', 0, 0),
(193, 39, NULL, 193, NULL, 2, 4096, 1, 'all', 0, 0),
(194, 39, NULL, 194, NULL, 3, 4154, 1, 'all', 0, 0),
(195, 39, NULL, 195, NULL, 4, 4130, 1, 'all', 0, 0),
(196, 40, NULL, 196, NULL, 0, 12346, 1, 'all', 0, 0),
(197, 40, NULL, 197, NULL, 1, 12288, 1, 'all', 0, 0),
(198, 40, NULL, 198, NULL, 2, 4096, 1, 'all', 0, 0),
(199, 40, NULL, 199, NULL, 3, 4154, 1, 'all', 0, 0),
(200, 40, NULL, 200, NULL, 4, 4130, 1, 'all', 0, 0),
(201, 41, NULL, 201, NULL, 0, 12346, 1, 'all', 0, 0),
(202, 41, NULL, 202, NULL, 1, 12288, 1, 'all', 0, 0),
(203, 41, NULL, 203, NULL, 2, 4096, 1, 'all', 0, 0),
(204, 41, NULL, 204, NULL, 3, 4154, 1, 'all', 0, 0),
(205, 41, NULL, 205, NULL, 4, 4130, 1, 'all', 0, 0),
(206, 42, NULL, 206, NULL, 0, 12346, 1, 'all', 0, 0),
(207, 42, NULL, 207, NULL, 1, 12288, 1, 'all', 0, 0),
(208, 42, NULL, 208, NULL, 2, 4096, 1, 'all', 0, 0),
(209, 42, NULL, 209, NULL, 3, 4154, 1, 'all', 0, 0),
(210, 42, NULL, 210, NULL, 4, 4130, 1, 'all', 0, 0),
(211, 43, NULL, 211, NULL, 0, 12346, 1, 'all', 0, 0),
(212, 43, NULL, 212, NULL, 1, 12288, 1, 'all', 0, 0),
(213, 43, NULL, 213, NULL, 2, 4096, 1, 'all', 0, 0),
(214, 43, NULL, 214, NULL, 3, 4154, 1, 'all', 0, 0),
(215, 43, NULL, 215, NULL, 4, 4130, 1, 'all', 0, 0),
(216, 44, NULL, 216, NULL, 0, 12346, 1, 'all', 0, 0),
(217, 44, NULL, 217, NULL, 1, 12288, 1, 'all', 0, 0),
(218, 44, NULL, 218, NULL, 2, 4096, 1, 'all', 0, 0),
(219, 44, NULL, 219, NULL, 3, 4154, 1, 'all', 0, 0),
(220, 44, NULL, 220, NULL, 4, 4130, 1, 'all', 0, 0),
(221, 45, NULL, 221, NULL, 0, 12346, 1, 'all', 0, 0),
(222, 45, NULL, 222, NULL, 1, 12288, 1, 'all', 0, 0),
(223, 45, NULL, 223, NULL, 2, 4096, 1, 'all', 0, 0),
(224, 45, NULL, 224, NULL, 3, 4154, 1, 'all', 0, 0),
(225, 45, NULL, 225, NULL, 4, 4130, 1, 'all', 0, 0),
(226, 46, NULL, 226, NULL, 0, 12346, 1, 'all', 0, 0),
(227, 46, NULL, 227, NULL, 1, 12288, 1, 'all', 0, 0),
(228, 46, NULL, 228, NULL, 2, 4096, 1, 'all', 0, 0),
(229, 46, NULL, 229, NULL, 3, 4154, 1, 'all', 0, 0),
(230, 46, NULL, 230, NULL, 4, 4130, 1, 'all', 0, 0),
(231, 47, NULL, 231, NULL, 0, 12346, 1, 'all', 0, 0),
(232, 47, NULL, 232, NULL, 1, 12288, 1, 'all', 0, 0),
(233, 47, NULL, 233, NULL, 2, 4096, 1, 'all', 0, 0),
(234, 47, NULL, 234, NULL, 3, 4154, 1, 'all', 0, 0),
(235, 47, NULL, 235, NULL, 4, 4130, 1, 'all', 0, 0),
(236, 48, NULL, 236, NULL, 0, 12346, 1, 'all', 0, 0),
(237, 48, NULL, 237, NULL, 1, 12288, 1, 'all', 0, 0),
(238, 48, NULL, 238, NULL, 2, 4096, 1, 'all', 0, 0),
(239, 48, NULL, 239, NULL, 3, 4154, 1, 'all', 0, 0),
(240, 48, NULL, 240, NULL, 4, 4130, 1, 'all', 0, 0),
(241, 49, NULL, 241, NULL, 0, 12346, 1, 'all', 0, 0),
(242, 49, NULL, 242, NULL, 1, 12288, 1, 'all', 0, 0),
(243, 49, NULL, 243, NULL, 2, 4096, 1, 'all', 0, 0),
(244, 49, NULL, 244, NULL, 3, 4154, 1, 'all', 0, 0),
(245, 49, NULL, 245, NULL, 4, 4130, 1, 'all', 0, 0),
(246, 50, NULL, 246, NULL, 0, 12346, 1, 'all', 0, 0),
(247, 50, NULL, 247, NULL, 1, 12288, 1, 'all', 0, 0),
(248, 50, NULL, 248, NULL, 2, 4096, 1, 'all', 0, 0),
(249, 50, NULL, 249, NULL, 3, 4154, 1, 'all', 0, 0),
(250, 50, NULL, 250, NULL, 4, 4130, 1, 'all', 0, 0),
(251, 51, NULL, 251, NULL, 0, 12346, 1, 'all', 0, 0),
(252, 51, NULL, 252, NULL, 1, 12288, 1, 'all', 0, 0),
(253, 51, NULL, 253, NULL, 2, 4096, 1, 'all', 0, 0),
(254, 51, NULL, 254, NULL, 3, 4154, 1, 'all', 0, 0),
(255, 51, NULL, 255, NULL, 4, 4130, 1, 'all', 0, 0),
(256, 52, NULL, 256, NULL, 0, 12346, 1, 'all', 0, 0),
(257, 52, NULL, 257, NULL, 1, 12288, 1, 'all', 0, 0),
(258, 52, NULL, 258, NULL, 2, 4096, 1, 'all', 0, 0),
(259, 52, NULL, 259, NULL, 3, 4154, 1, 'all', 0, 0),
(260, 52, NULL, 260, NULL, 4, 4130, 1, 'all', 0, 0),
(261, 53, NULL, 261, NULL, 0, 12346, 1, 'all', 0, 0),
(262, 53, NULL, 262, NULL, 1, 12288, 1, 'all', 0, 0),
(263, 53, NULL, 263, NULL, 2, 4096, 1, 'all', 0, 0),
(264, 53, NULL, 264, NULL, 3, 4154, 1, 'all', 0, 0),
(265, 53, NULL, 265, NULL, 4, 4130, 1, 'all', 0, 0),
(266, 54, NULL, 266, NULL, 0, 12346, 1, 'all', 0, 0),
(267, 54, NULL, 267, NULL, 1, 12288, 1, 'all', 0, 0),
(268, 54, NULL, 268, NULL, 2, 4096, 1, 'all', 0, 0),
(269, 54, NULL, 269, NULL, 3, 4154, 1, 'all', 0, 0),
(270, 54, NULL, 270, NULL, 4, 4130, 1, 'all', 0, 0),
(271, 55, NULL, 271, NULL, 0, 12346, 1, 'all', 0, 0),
(272, 55, NULL, 272, NULL, 1, 12288, 1, 'all', 0, 0),
(273, 55, NULL, 273, NULL, 2, 4096, 1, 'all', 0, 0),
(274, 55, NULL, 274, NULL, 3, 4154, 1, 'all', 0, 0),
(275, 55, NULL, 275, NULL, 4, 4130, 1, 'all', 0, 0),
(276, 56, NULL, 276, NULL, 0, 12346, 1, 'all', 0, 0),
(277, 56, NULL, 277, NULL, 1, 12288, 1, 'all', 0, 0),
(278, 56, NULL, 278, NULL, 2, 4096, 1, 'all', 0, 0),
(279, 56, NULL, 279, NULL, 3, 4154, 1, 'all', 0, 0),
(280, 56, NULL, 280, NULL, 4, 4130, 1, 'all', 0, 0),
(281, 57, NULL, 281, NULL, 0, 12346, 1, 'all', 0, 0),
(282, 57, NULL, 282, NULL, 1, 12288, 1, 'all', 0, 0),
(283, 57, NULL, 283, NULL, 2, 4096, 1, 'all', 0, 0),
(284, 57, NULL, 284, NULL, 3, 4154, 1, 'all', 0, 0),
(285, 57, NULL, 285, NULL, 4, 4130, 1, 'all', 0, 0),
(286, 58, NULL, 286, NULL, 0, 12346, 1, 'all', 0, 0),
(287, 58, NULL, 287, NULL, 1, 12288, 1, 'all', 0, 0),
(288, 58, NULL, 288, NULL, 2, 4096, 1, 'all', 0, 0),
(289, 58, NULL, 289, NULL, 3, 4154, 1, 'all', 0, 0),
(290, 58, NULL, 290, NULL, 4, 4130, 1, 'all', 0, 0),
(291, 59, NULL, 291, NULL, 0, 12346, 1, 'all', 0, 0),
(292, 59, NULL, 292, NULL, 1, 12288, 1, 'all', 0, 0),
(293, 59, NULL, 293, NULL, 2, 4096, 1, 'all', 0, 0),
(294, 59, NULL, 294, NULL, 3, 4154, 1, 'all', 0, 0),
(295, 59, NULL, 295, NULL, 4, 4130, 1, 'all', 0, 0),
(296, 60, NULL, 296, NULL, 0, 12346, 1, 'all', 0, 0),
(297, 60, NULL, 297, NULL, 1, 12288, 1, 'all', 0, 0),
(298, 60, NULL, 298, NULL, 2, 4096, 1, 'all', 0, 0),
(299, 60, NULL, 299, NULL, 3, 4154, 1, 'all', 0, 0),
(300, 60, NULL, 300, NULL, 4, 4130, 1, 'all', 0, 0),
(301, 61, NULL, 301, NULL, 0, 12346, 1, 'all', 0, 0),
(302, 61, NULL, 302, NULL, 1, 12288, 1, 'all', 0, 0),
(303, 61, NULL, 303, NULL, 2, 4096, 1, 'all', 0, 0),
(304, 61, NULL, 304, NULL, 3, 4154, 1, 'all', 0, 0),
(305, 61, NULL, 305, NULL, 4, 4130, 1, 'all', 0, 0),
(306, 62, NULL, 306, NULL, 0, 12346, 1, 'all', 0, 0),
(307, 62, NULL, 307, NULL, 1, 12288, 1, 'all', 0, 0),
(308, 62, NULL, 308, NULL, 2, 4096, 1, 'all', 0, 0),
(309, 62, NULL, 309, NULL, 3, 4154, 1, 'all', 0, 0),
(310, 62, NULL, 310, NULL, 4, 4130, 1, 'all', 0, 0),
(311, 63, NULL, 311, NULL, 0, 12346, 1, 'all', 0, 0),
(312, 63, NULL, 312, NULL, 1, 12288, 1, 'all', 0, 0),
(313, 63, NULL, 313, NULL, 2, 4096, 1, 'all', 0, 0),
(314, 63, NULL, 314, NULL, 3, 4154, 1, 'all', 0, 0),
(315, 63, NULL, 315, NULL, 4, 4130, 1, 'all', 0, 0),
(316, 64, NULL, 316, NULL, 0, 12346, 1, 'all', 0, 0),
(317, 64, NULL, 317, NULL, 1, 12288, 1, 'all', 0, 0),
(318, 64, NULL, 318, NULL, 2, 4096, 1, 'all', 0, 0),
(319, 64, NULL, 319, NULL, 3, 4154, 1, 'all', 0, 0),
(320, 64, NULL, 320, NULL, 4, 4130, 1, 'all', 0, 0),
(321, 65, NULL, 321, NULL, 0, 12346, 1, 'all', 0, 0),
(322, 65, NULL, 322, NULL, 1, 12288, 1, 'all', 0, 0),
(323, 65, NULL, 323, NULL, 2, 4096, 1, 'all', 0, 0),
(324, 65, NULL, 324, NULL, 3, 4154, 1, 'all', 0, 0),
(325, 65, NULL, 325, NULL, 4, 4130, 1, 'all', 0, 0),
(326, 66, NULL, 326, NULL, 0, 12346, 1, 'all', 0, 0),
(327, 66, NULL, 327, NULL, 1, 12288, 1, 'all', 0, 0),
(328, 66, NULL, 328, NULL, 2, 4096, 1, 'all', 0, 0),
(329, 66, NULL, 329, NULL, 3, 4154, 1, 'all', 0, 0),
(330, 66, NULL, 330, NULL, 4, 4130, 1, 'all', 0, 0),
(331, 67, NULL, 331, NULL, 0, 12346, 1, 'all', 0, 0),
(332, 67, NULL, 332, NULL, 1, 12288, 1, 'all', 0, 0),
(333, 67, NULL, 333, NULL, 2, 4096, 1, 'all', 0, 0),
(334, 67, NULL, 334, NULL, 3, 4154, 1, 'all', 0, 0),
(335, 67, NULL, 335, NULL, 4, 4130, 1, 'all', 0, 0),
(336, 68, NULL, 336, NULL, 0, 12346, 1, 'all', 0, 0),
(337, 68, NULL, 337, NULL, 1, 12288, 1, 'all', 0, 0),
(338, 68, NULL, 338, NULL, 2, 4096, 1, 'all', 0, 0),
(339, 68, NULL, 339, NULL, 3, 4154, 1, 'all', 0, 0),
(340, 68, NULL, 340, NULL, 4, 4130, 1, 'all', 0, 0),
(341, 69, NULL, 341, NULL, 0, 12346, 1, 'all', 0, 0),
(342, 69, NULL, 342, NULL, 1, 12288, 1, 'all', 0, 0),
(343, 69, NULL, 343, NULL, 2, 4096, 1, 'all', 0, 0),
(344, 69, NULL, 344, NULL, 3, 4154, 1, 'all', 0, 0),
(345, 69, NULL, 345, NULL, 4, 4130, 1, 'all', 0, 0),
(346, 70, NULL, 346, NULL, 0, 12346, 1, 'all', 0, 0),
(347, 70, NULL, 347, NULL, 1, 12288, 1, 'all', 0, 0),
(348, 70, NULL, 348, NULL, 2, 4096, 1, 'all', 0, 0),
(349, 70, NULL, 349, NULL, 3, 4154, 1, 'all', 0, 0),
(350, 70, NULL, 350, NULL, 4, 4130, 1, 'all', 0, 0),
(351, 71, NULL, 351, NULL, 0, 12346, 1, 'all', 0, 0),
(352, 71, NULL, 352, NULL, 1, 12288, 1, 'all', 0, 0),
(353, 71, NULL, 353, NULL, 2, 4096, 1, 'all', 0, 0),
(354, 71, NULL, 354, NULL, 3, 4154, 1, 'all', 0, 0),
(355, 71, NULL, 355, NULL, 4, 4130, 1, 'all', 0, 0),
(356, 72, NULL, 356, NULL, 0, 12346, 1, 'all', 0, 0),
(357, 72, NULL, 357, NULL, 1, 12288, 1, 'all', 0, 0),
(358, 72, NULL, 358, NULL, 2, 4096, 1, 'all', 0, 0),
(359, 72, NULL, 359, NULL, 3, 4154, 1, 'all', 0, 0),
(360, 72, NULL, 360, NULL, 4, 4130, 1, 'all', 0, 0),
(361, 73, NULL, 361, NULL, 0, 12346, 1, 'all', 0, 0),
(362, 73, NULL, 362, NULL, 1, 12288, 1, 'all', 0, 0),
(363, 73, NULL, 363, NULL, 2, 4096, 1, 'all', 0, 0),
(364, 73, NULL, 364, NULL, 3, 4154, 1, 'all', 0, 0),
(365, 73, NULL, 365, NULL, 4, 4130, 1, 'all', 0, 0),
(366, 74, NULL, 366, NULL, 0, 12346, 1, 'all', 0, 0),
(367, 74, NULL, 367, NULL, 1, 12288, 1, 'all', 0, 0),
(368, 74, NULL, 368, NULL, 2, 4096, 1, 'all', 0, 0),
(369, 74, NULL, 369, NULL, 3, 4154, 1, 'all', 0, 0),
(370, 74, NULL, 370, NULL, 4, 4130, 1, 'all', 0, 0),
(371, 75, NULL, 371, NULL, 0, 12346, 1, 'all', 0, 0),
(372, 75, NULL, 372, NULL, 1, 12288, 1, 'all', 0, 0),
(373, 75, NULL, 373, NULL, 2, 4096, 1, 'all', 0, 0),
(374, 75, NULL, 374, NULL, 3, 4154, 1, 'all', 0, 0),
(375, 75, NULL, 375, NULL, 4, 4130, 1, 'all', 0, 0),
(376, 76, NULL, 376, NULL, 0, 12346, 1, 'all', 0, 0),
(377, 76, NULL, 377, NULL, 1, 12288, 1, 'all', 0, 0),
(378, 76, NULL, 378, NULL, 2, 4096, 1, 'all', 0, 0),
(379, 76, NULL, 379, NULL, 3, 4154, 1, 'all', 0, 0),
(380, 76, NULL, 380, NULL, 4, 4130, 1, 'all', 0, 0),
(381, 77, NULL, 381, NULL, 0, 12346, 1, 'all', 0, 0),
(382, 77, NULL, 382, NULL, 1, 12288, 1, 'all', 0, 0),
(383, 77, NULL, 383, NULL, 2, 4096, 1, 'all', 0, 0),
(384, 77, NULL, 384, NULL, 3, 4154, 1, 'all', 0, 0),
(385, 77, NULL, 385, NULL, 4, 4130, 1, 'all', 0, 0),
(386, 78, NULL, 386, NULL, 0, 12346, 1, 'all', 0, 0),
(387, 78, NULL, 387, NULL, 1, 12288, 1, 'all', 0, 0),
(388, 78, NULL, 388, NULL, 2, 4096, 1, 'all', 0, 0),
(389, 78, NULL, 389, NULL, 3, 4154, 1, 'all', 0, 0),
(390, 78, NULL, 390, NULL, 4, 4130, 1, 'all', 0, 0),
(391, 79, NULL, 391, NULL, 0, 12346, 1, 'all', 0, 0),
(392, 79, NULL, 392, NULL, 1, 12288, 1, 'all', 0, 0),
(393, 79, NULL, 393, NULL, 2, 4096, 1, 'all', 0, 0),
(394, 79, NULL, 394, NULL, 3, 4154, 1, 'all', 0, 0),
(395, 79, NULL, 395, NULL, 4, 4130, 1, 'all', 0, 0),
(396, 80, NULL, 396, NULL, 0, 12346, 1, 'all', 0, 0),
(397, 80, NULL, 397, NULL, 1, 12288, 1, 'all', 0, 0),
(398, 80, NULL, 398, NULL, 2, 4096, 1, 'all', 0, 0),
(399, 80, NULL, 399, NULL, 3, 4154, 1, 'all', 0, 0),
(400, 80, NULL, 400, NULL, 4, 4130, 1, 'all', 0, 0),
(401, 81, NULL, 401, NULL, 0, 12346, 1, 'all', 0, 0),
(402, 81, NULL, 402, NULL, 1, 12288, 1, 'all', 0, 0),
(403, 81, NULL, 403, NULL, 2, 4096, 1, 'all', 0, 0),
(404, 81, NULL, 404, NULL, 3, 4154, 1, 'all', 0, 0),
(405, 81, NULL, 405, NULL, 4, 4130, 1, 'all', 0, 0),
(406, 82, NULL, 406, NULL, 0, 12346, 1, 'all', 0, 0),
(407, 82, NULL, 407, NULL, 1, 12288, 1, 'all', 0, 0),
(408, 82, NULL, 408, NULL, 2, 4096, 1, 'all', 0, 0),
(409, 82, NULL, 409, NULL, 3, 4154, 1, 'all', 0, 0),
(410, 82, NULL, 410, NULL, 4, 4130, 1, 'all', 0, 0),
(411, 83, NULL, 411, NULL, 0, 12346, 1, 'all', 0, 0),
(412, 83, NULL, 412, NULL, 1, 12288, 1, 'all', 0, 0),
(413, 83, NULL, 413, NULL, 2, 4096, 1, 'all', 0, 0),
(414, 83, NULL, 414, NULL, 3, 4154, 1, 'all', 0, 0),
(415, 83, NULL, 415, NULL, 4, 4130, 1, 'all', 0, 0),
(416, 84, NULL, 416, NULL, 0, 12346, 1, 'all', 0, 0),
(417, 84, NULL, 417, NULL, 1, 12288, 1, 'all', 0, 0),
(418, 84, NULL, 418, NULL, 2, 4096, 1, 'all', 0, 0),
(419, 84, NULL, 419, NULL, 3, 4154, 1, 'all', 0, 0),
(420, 84, NULL, 420, NULL, 4, 4130, 1, 'all', 0, 0),
(421, 85, NULL, 421, NULL, 0, 12346, 1, 'all', 0, 0),
(422, 85, NULL, 422, NULL, 1, 12288, 1, 'all', 0, 0),
(423, 85, NULL, 423, NULL, 2, 4096, 1, 'all', 0, 0),
(424, 85, NULL, 424, NULL, 3, 4154, 1, 'all', 0, 0),
(425, 85, NULL, 425, NULL, 4, 4130, 1, 'all', 0, 0),
(426, 86, NULL, 426, NULL, 0, 12346, 1, 'all', 0, 0),
(427, 86, NULL, 427, NULL, 1, 12288, 1, 'all', 0, 0),
(428, 86, NULL, 428, NULL, 2, 4096, 1, 'all', 0, 0),
(429, 86, NULL, 429, NULL, 3, 4154, 1, 'all', 0, 0),
(430, 86, NULL, 430, NULL, 4, 4130, 1, 'all', 0, 0),
(431, 87, NULL, 431, NULL, 0, 12346, 1, 'all', 0, 0),
(432, 87, NULL, 432, NULL, 1, 12288, 1, 'all', 0, 0),
(433, 87, NULL, 433, NULL, 2, 4096, 1, 'all', 0, 0),
(434, 87, NULL, 434, NULL, 3, 4154, 1, 'all', 0, 0),
(435, 87, NULL, 435, NULL, 4, 4130, 1, 'all', 0, 0),
(436, 88, NULL, 436, NULL, 0, 12346, 1, 'all', 0, 0),
(437, 88, NULL, 437, NULL, 1, 12288, 1, 'all', 0, 0),
(438, 88, NULL, 438, NULL, 2, 4096, 1, 'all', 0, 0),
(439, 88, NULL, 439, NULL, 3, 4154, 1, 'all', 0, 0),
(440, 88, NULL, 440, NULL, 4, 4130, 1, 'all', 0, 0),
(441, 89, NULL, 441, NULL, 0, 12346, 1, 'all', 0, 0),
(442, 89, NULL, 442, NULL, 1, 12288, 1, 'all', 0, 0),
(443, 89, NULL, 443, NULL, 2, 4096, 1, 'all', 0, 0),
(444, 89, NULL, 444, NULL, 3, 4154, 1, 'all', 0, 0),
(445, 89, NULL, 445, NULL, 4, 4130, 1, 'all', 0, 0),
(446, 90, NULL, 446, NULL, 0, 12346, 1, 'all', 0, 0),
(447, 90, NULL, 447, NULL, 1, 12288, 1, 'all', 0, 0),
(448, 90, NULL, 448, NULL, 2, 4096, 1, 'all', 0, 0),
(449, 90, NULL, 449, NULL, 3, 4154, 1, 'all', 0, 0),
(450, 90, NULL, 450, NULL, 4, 4130, 1, 'all', 0, 0),
(451, 91, NULL, 451, NULL, 0, 12346, 1, 'all', 0, 0),
(452, 91, NULL, 452, NULL, 1, 12288, 1, 'all', 0, 0),
(453, 91, NULL, 453, NULL, 2, 4096, 1, 'all', 0, 0),
(454, 91, NULL, 454, NULL, 3, 4154, 1, 'all', 0, 0),
(455, 91, NULL, 455, NULL, 4, 4130, 1, 'all', 0, 0),
(456, 92, NULL, 456, NULL, 0, 12346, 1, 'all', 0, 0),
(457, 92, NULL, 457, NULL, 1, 12288, 1, 'all', 0, 0),
(458, 92, NULL, 458, NULL, 2, 4096, 1, 'all', 0, 0),
(459, 92, NULL, 459, NULL, 3, 4154, 1, 'all', 0, 0),
(460, 92, NULL, 460, NULL, 4, 4130, 1, 'all', 0, 0),
(461, 93, NULL, 461, NULL, 0, 12346, 1, 'all', 0, 0),
(462, 93, NULL, 462, NULL, 1, 12288, 1, 'all', 0, 0),
(463, 93, NULL, 463, NULL, 2, 4096, 1, 'all', 0, 0),
(464, 93, NULL, 464, NULL, 3, 4154, 1, 'all', 0, 0),
(465, 93, NULL, 465, NULL, 4, 4130, 1, 'all', 0, 0),
(466, 94, NULL, 466, NULL, 0, 12346, 1, 'all', 0, 0),
(467, 94, NULL, 467, NULL, 1, 12288, 1, 'all', 0, 0),
(468, 94, NULL, 468, NULL, 2, 4096, 1, 'all', 0, 0),
(469, 94, NULL, 469, NULL, 3, 4154, 1, 'all', 0, 0),
(470, 94, NULL, 470, NULL, 4, 4130, 1, 'all', 0, 0),
(471, 95, NULL, 471, NULL, 0, 12346, 1, 'all', 0, 0),
(472, 95, NULL, 472, NULL, 1, 12288, 1, 'all', 0, 0),
(473, 95, NULL, 473, NULL, 2, 4096, 1, 'all', 0, 0),
(474, 95, NULL, 474, NULL, 3, 4154, 1, 'all', 0, 0),
(475, 95, NULL, 475, NULL, 4, 4130, 1, 'all', 0, 0),
(476, 96, NULL, 476, NULL, 0, 12346, 1, 'all', 0, 0),
(477, 96, NULL, 477, NULL, 1, 12288, 1, 'all', 0, 0),
(478, 96, NULL, 478, NULL, 2, 4096, 1, 'all', 0, 0),
(479, 96, NULL, 479, NULL, 3, 4154, 1, 'all', 0, 0),
(480, 96, NULL, 480, NULL, 4, 4130, 1, 'all', 0, 0),
(481, 97, NULL, 481, NULL, 0, 12346, 1, 'all', 0, 0),
(482, 97, NULL, 482, NULL, 1, 12288, 1, 'all', 0, 0),
(483, 97, NULL, 483, NULL, 2, 4096, 1, 'all', 0, 0),
(484, 97, NULL, 484, NULL, 3, 4154, 1, 'all', 0, 0),
(485, 97, NULL, 485, NULL, 4, 4130, 1, 'all', 0, 0),
(486, 98, NULL, 486, NULL, 0, 12346, 1, 'all', 0, 0),
(487, 98, NULL, 487, NULL, 1, 12288, 1, 'all', 0, 0),
(488, 98, NULL, 488, NULL, 2, 4096, 1, 'all', 0, 0),
(489, 98, NULL, 489, NULL, 3, 4154, 1, 'all', 0, 0),
(490, 98, NULL, 490, NULL, 4, 4130, 1, 'all', 0, 0),
(491, 99, NULL, 491, NULL, 0, 12346, 1, 'all', 0, 0),
(492, 99, NULL, 492, NULL, 1, 12288, 1, 'all', 0, 0),
(493, 99, NULL, 493, NULL, 2, 4096, 1, 'all', 0, 0),
(494, 99, NULL, 494, NULL, 3, 4154, 1, 'all', 0, 0),
(495, 99, NULL, 495, NULL, 4, 4130, 1, 'all', 0, 0),
(496, 100, NULL, 496, NULL, 0, 12346, 1, 'all', 0, 0),
(497, 100, NULL, 497, NULL, 1, 12288, 1, 'all', 0, 0),
(498, 100, NULL, 498, NULL, 2, 4096, 1, 'all', 0, 0),
(499, 100, NULL, 499, NULL, 3, 4154, 1, 'all', 0, 0),
(500, 100, NULL, 500, NULL, 4, 4130, 1, 'all', 0, 0),
(501, 101, NULL, 501, NULL, 0, 12346, 1, 'all', 0, 0),
(502, 101, NULL, 502, NULL, 1, 12288, 1, 'all', 0, 0),
(503, 101, NULL, 503, NULL, 2, 4096, 1, 'all', 0, 0),
(504, 101, NULL, 504, NULL, 3, 4154, 1, 'all', 0, 0),
(505, 101, NULL, 505, NULL, 4, 4130, 1, 'all', 0, 0),
(506, 102, NULL, 506, NULL, 0, 12346, 1, 'all', 0, 0),
(507, 102, NULL, 507, NULL, 1, 12288, 1, 'all', 0, 0),
(508, 102, NULL, 508, NULL, 2, 4096, 1, 'all', 0, 0),
(509, 102, NULL, 509, NULL, 3, 4154, 1, 'all', 0, 0),
(510, 102, NULL, 510, NULL, 4, 4130, 1, 'all', 0, 0),
(511, 103, NULL, 511, NULL, 0, 12346, 1, 'all', 0, 0),
(512, 103, NULL, 512, NULL, 1, 12288, 1, 'all', 0, 0),
(513, 103, NULL, 513, NULL, 2, 4096, 1, 'all', 0, 0),
(514, 103, NULL, 514, NULL, 3, 4154, 1, 'all', 0, 0),
(515, 103, NULL, 515, NULL, 4, 4130, 1, 'all', 0, 0),
(516, 104, NULL, 516, NULL, 0, 12346, 1, 'all', 0, 0),
(517, 104, NULL, 517, NULL, 1, 12288, 1, 'all', 0, 0),
(518, 104, NULL, 518, NULL, 2, 4096, 1, 'all', 0, 0),
(519, 104, NULL, 519, NULL, 3, 4154, 1, 'all', 0, 0),
(520, 104, NULL, 520, NULL, 4, 4130, 1, 'all', 0, 0),
(521, 105, NULL, 521, NULL, 0, 12346, 1, 'all', 0, 0),
(522, 105, NULL, 522, NULL, 1, 12288, 1, 'all', 0, 0),
(523, 105, NULL, 523, NULL, 2, 4096, 1, 'all', 0, 0),
(524, 105, NULL, 524, NULL, 3, 4154, 1, 'all', 0, 0),
(525, 105, NULL, 525, NULL, 4, 4130, 1, 'all', 0, 0),
(526, 106, NULL, 526, NULL, 0, 12346, 1, 'all', 0, 0),
(527, 106, NULL, 527, NULL, 1, 12288, 1, 'all', 0, 0),
(528, 106, NULL, 528, NULL, 2, 4096, 1, 'all', 0, 0),
(529, 106, NULL, 529, NULL, 3, 4154, 1, 'all', 0, 0),
(530, 106, NULL, 530, NULL, 4, 4130, 1, 'all', 0, 0),
(531, 107, NULL, 531, NULL, 0, 12346, 1, 'all', 0, 0),
(532, 107, NULL, 532, NULL, 1, 12288, 1, 'all', 0, 0),
(533, 107, NULL, 533, NULL, 2, 4096, 1, 'all', 0, 0),
(534, 107, NULL, 534, NULL, 3, 4154, 1, 'all', 0, 0),
(535, 107, NULL, 535, NULL, 4, 4130, 1, 'all', 0, 0),
(536, 108, NULL, 536, NULL, 0, 12346, 1, 'all', 0, 0),
(537, 108, NULL, 537, NULL, 1, 12288, 1, 'all', 0, 0),
(538, 108, NULL, 538, NULL, 2, 4096, 1, 'all', 0, 0),
(539, 108, NULL, 539, NULL, 3, 4154, 1, 'all', 0, 0),
(540, 108, NULL, 540, NULL, 4, 4130, 1, 'all', 0, 0),
(541, 109, NULL, 541, NULL, 0, 12346, 1, 'all', 0, 0),
(542, 109, NULL, 542, NULL, 1, 12288, 1, 'all', 0, 0),
(543, 109, NULL, 543, NULL, 2, 4096, 1, 'all', 0, 0),
(544, 109, NULL, 544, NULL, 3, 4154, 1, 'all', 0, 0),
(545, 109, NULL, 545, NULL, 4, 4130, 1, 'all', 0, 0),
(546, 110, NULL, 546, NULL, 0, 12346, 1, 'all', 0, 0),
(547, 110, NULL, 547, NULL, 1, 12288, 1, 'all', 0, 0),
(548, 110, NULL, 548, NULL, 2, 4096, 1, 'all', 0, 0),
(549, 110, NULL, 549, NULL, 3, 4154, 1, 'all', 0, 0),
(550, 110, NULL, 550, NULL, 4, 4130, 1, 'all', 0, 0),
(551, 111, NULL, 551, NULL, 0, 12346, 1, 'all', 0, 0),
(552, 111, NULL, 552, NULL, 1, 12288, 1, 'all', 0, 0),
(553, 111, NULL, 553, NULL, 2, 4096, 1, 'all', 0, 0),
(554, 111, NULL, 554, NULL, 3, 4154, 1, 'all', 0, 0),
(555, 111, NULL, 555, NULL, 4, 4130, 1, 'all', 0, 0),
(556, 112, NULL, 556, NULL, 0, 12346, 1, 'all', 0, 0),
(557, 112, NULL, 557, NULL, 1, 12288, 1, 'all', 0, 0),
(558, 112, NULL, 558, NULL, 2, 4096, 1, 'all', 0, 0),
(559, 112, NULL, 559, NULL, 3, 4154, 1, 'all', 0, 0),
(560, 112, NULL, 560, NULL, 4, 4130, 1, 'all', 0, 0),
(561, 113, NULL, 561, NULL, 0, 12346, 1, 'all', 0, 0),
(562, 113, NULL, 562, NULL, 1, 12288, 1, 'all', 0, 0),
(563, 113, NULL, 563, NULL, 2, 4096, 1, 'all', 0, 0),
(564, 113, NULL, 564, NULL, 3, 4154, 1, 'all', 0, 0),
(565, 113, NULL, 565, NULL, 4, 4130, 1, 'all', 0, 0),
(566, 114, NULL, 566, NULL, 0, 12346, 1, 'all', 0, 0),
(567, 114, NULL, 567, NULL, 1, 12288, 1, 'all', 0, 0),
(568, 114, NULL, 568, NULL, 2, 4096, 1, 'all', 0, 0),
(569, 114, NULL, 569, NULL, 3, 4154, 1, 'all', 0, 0),
(570, 114, NULL, 570, NULL, 4, 4130, 1, 'all', 0, 0),
(571, 115, NULL, 571, NULL, 0, 12346, 1, 'all', 0, 0),
(572, 115, NULL, 572, NULL, 1, 12288, 1, 'all', 0, 0),
(573, 115, NULL, 573, NULL, 2, 4096, 1, 'all', 0, 0),
(574, 115, NULL, 574, NULL, 3, 4154, 1, 'all', 0, 0),
(575, 115, NULL, 575, NULL, 4, 4130, 1, 'all', 0, 0),
(576, 116, NULL, 576, NULL, 0, 12346, 1, 'all', 0, 0),
(577, 116, NULL, 577, NULL, 1, 12288, 1, 'all', 0, 0),
(578, 116, NULL, 578, NULL, 2, 4096, 1, 'all', 0, 0),
(579, 116, NULL, 579, NULL, 3, 4154, 1, 'all', 0, 0),
(580, 116, NULL, 580, NULL, 4, 4130, 1, 'all', 0, 0),
(581, 117, NULL, 581, NULL, 0, 12346, 1, 'all', 0, 0),
(582, 117, NULL, 582, NULL, 1, 12288, 1, 'all', 0, 0),
(583, 117, NULL, 583, NULL, 2, 4096, 1, 'all', 0, 0),
(584, 117, NULL, 584, NULL, 3, 4154, 1, 'all', 0, 0),
(585, 117, NULL, 585, NULL, 4, 4130, 1, 'all', 0, 0),
(586, 118, NULL, 586, NULL, 0, 12346, 1, 'all', 0, 0),
(587, 118, NULL, 587, NULL, 1, 12288, 1, 'all', 0, 0),
(588, 118, NULL, 588, NULL, 2, 4096, 1, 'all', 0, 0),
(589, 118, NULL, 589, NULL, 3, 4154, 1, 'all', 0, 0),
(590, 118, NULL, 590, NULL, 4, 4130, 1, 'all', 0, 0),
(591, 119, NULL, 591, NULL, 0, 12346, 1, 'all', 0, 0),
(592, 119, NULL, 592, NULL, 1, 12288, 1, 'all', 0, 0),
(593, 119, NULL, 593, NULL, 2, 4096, 1, 'all', 0, 0),
(594, 119, NULL, 594, NULL, 3, 4154, 1, 'all', 0, 0),
(595, 119, NULL, 595, NULL, 4, 4130, 1, 'all', 0, 0),
(596, 120, NULL, 596, NULL, 0, 12346, 1, 'all', 0, 0),
(597, 120, NULL, 597, NULL, 1, 12288, 1, 'all', 0, 0),
(598, 120, NULL, 598, NULL, 2, 4096, 1, 'all', 0, 0),
(599, 120, NULL, 599, NULL, 3, 4154, 1, 'all', 0, 0),
(600, 120, NULL, 600, NULL, 4, 4130, 1, 'all', 0, 0),
(601, 121, NULL, 601, NULL, 0, 12346, 1, 'all', 0, 0),
(602, 121, NULL, 602, NULL, 1, 12288, 1, 'all', 0, 0),
(603, 121, NULL, 603, NULL, 2, 4096, 1, 'all', 0, 0),
(604, 121, NULL, 604, NULL, 3, 4154, 1, 'all', 0, 0),
(605, 121, NULL, 605, NULL, 4, 4130, 1, 'all', 0, 0),
(606, 122, NULL, 606, NULL, 0, 12346, 1, 'all', 0, 0),
(607, 122, NULL, 607, NULL, 1, 12288, 1, 'all', 0, 0),
(608, 122, NULL, 608, NULL, 2, 4096, 1, 'all', 0, 0),
(609, 122, NULL, 609, NULL, 3, 4154, 1, 'all', 0, 0),
(610, 122, NULL, 610, NULL, 4, 4130, 1, 'all', 0, 0),
(611, 123, NULL, 611, NULL, 0, 12346, 1, 'all', 0, 0),
(612, 123, NULL, 612, NULL, 1, 12288, 1, 'all', 0, 0),
(613, 123, NULL, 613, NULL, 2, 4096, 1, 'all', 0, 0),
(614, 123, NULL, 614, NULL, 3, 4154, 1, 'all', 0, 0),
(615, 123, NULL, 615, NULL, 4, 4130, 1, 'all', 0, 0),
(616, 124, NULL, 616, NULL, 0, 12346, 1, 'all', 0, 0),
(617, 124, NULL, 617, NULL, 1, 12288, 1, 'all', 0, 0),
(618, 124, NULL, 618, NULL, 2, 4096, 1, 'all', 0, 0),
(619, 124, NULL, 619, NULL, 3, 4154, 1, 'all', 0, 0),
(620, 124, NULL, 620, NULL, 4, 4130, 1, 'all', 0, 0),
(621, 125, NULL, 621, NULL, 0, 12346, 1, 'all', 0, 0),
(622, 125, NULL, 622, NULL, 1, 12288, 1, 'all', 0, 0),
(623, 125, NULL, 623, NULL, 2, 4096, 1, 'all', 0, 0),
(624, 125, NULL, 624, NULL, 3, 4154, 1, 'all', 0, 0),
(625, 125, NULL, 625, NULL, 4, 4130, 1, 'all', 0, 0),
(626, 126, NULL, 626, NULL, 0, 12346, 1, 'all', 0, 0),
(627, 126, NULL, 627, NULL, 1, 12288, 1, 'all', 0, 0),
(628, 126, NULL, 628, NULL, 2, 4096, 1, 'all', 0, 0),
(629, 126, NULL, 629, NULL, 3, 4154, 1, 'all', 0, 0),
(630, 126, NULL, 630, NULL, 4, 4130, 1, 'all', 0, 0),
(631, 127, NULL, 631, NULL, 0, 12346, 1, 'all', 0, 0),
(632, 127, NULL, 632, NULL, 1, 12288, 1, 'all', 0, 0),
(633, 127, NULL, 633, NULL, 2, 4096, 1, 'all', 0, 0),
(634, 127, NULL, 634, NULL, 3, 4154, 1, 'all', 0, 0),
(635, 127, NULL, 635, NULL, 4, 4130, 1, 'all', 0, 0),
(636, 128, NULL, 636, NULL, 0, 12346, 1, 'all', 0, 0),
(637, 128, NULL, 637, NULL, 1, 12288, 1, 'all', 0, 0),
(638, 128, NULL, 638, NULL, 2, 4096, 1, 'all', 0, 0),
(639, 128, NULL, 639, NULL, 3, 4154, 1, 'all', 0, 0),
(640, 128, NULL, 640, NULL, 4, 4130, 1, 'all', 0, 0),
(641, 129, NULL, 641, NULL, 0, 12346, 1, 'all', 0, 0),
(642, 129, NULL, 642, NULL, 1, 12288, 1, 'all', 0, 0),
(643, 129, NULL, 643, NULL, 2, 4096, 1, 'all', 0, 0),
(644, 129, NULL, 644, NULL, 3, 4154, 1, 'all', 0, 0),
(645, 129, NULL, 645, NULL, 4, 4130, 1, 'all', 0, 0),
(646, 130, NULL, 646, NULL, 0, 12346, 1, 'all', 0, 0),
(647, 130, NULL, 647, NULL, 1, 12288, 1, 'all', 0, 0),
(648, 130, NULL, 648, NULL, 2, 4096, 1, 'all', 0, 0),
(649, 130, NULL, 649, NULL, 3, 4154, 1, 'all', 0, 0),
(650, 130, NULL, 650, NULL, 4, 4130, 1, 'all', 0, 0),
(651, 131, NULL, 651, NULL, 0, 12346, 1, 'all', 0, 0),
(652, 131, NULL, 652, NULL, 1, 12288, 1, 'all', 0, 0),
(653, 131, NULL, 653, NULL, 2, 4096, 1, 'all', 0, 0),
(654, 131, NULL, 654, NULL, 3, 4154, 1, 'all', 0, 0),
(655, 131, NULL, 655, NULL, 4, 4130, 1, 'all', 0, 0),
(656, 132, NULL, 656, NULL, 0, 12346, 1, 'all', 0, 0),
(657, 132, NULL, 657, NULL, 1, 12288, 1, 'all', 0, 0),
(658, 132, NULL, 658, NULL, 2, 4096, 1, 'all', 0, 0),
(659, 132, NULL, 659, NULL, 3, 4154, 1, 'all', 0, 0),
(660, 132, NULL, 660, NULL, 4, 4130, 1, 'all', 0, 0),
(661, 133, NULL, 661, NULL, 0, 12346, 1, 'all', 0, 0),
(662, 133, NULL, 662, NULL, 1, 12288, 1, 'all', 0, 0),
(663, 133, NULL, 663, NULL, 2, 4096, 1, 'all', 0, 0),
(664, 133, NULL, 664, NULL, 3, 4154, 1, 'all', 0, 0),
(665, 133, NULL, 665, NULL, 4, 4130, 1, 'all', 0, 0),
(666, 134, NULL, 666, NULL, 0, 12346, 1, 'all', 0, 0),
(667, 134, NULL, 667, NULL, 1, 12288, 1, 'all', 0, 0),
(668, 134, NULL, 668, NULL, 2, 4096, 1, 'all', 0, 0),
(669, 134, NULL, 669, NULL, 3, 4154, 1, 'all', 0, 0),
(670, 134, NULL, 670, NULL, 4, 4130, 1, 'all', 0, 0),
(671, 135, NULL, 671, NULL, 0, 12346, 1, 'all', 0, 0),
(672, 135, NULL, 672, NULL, 1, 12288, 1, 'all', 0, 0),
(673, 135, NULL, 673, NULL, 2, 4096, 1, 'all', 0, 0),
(674, 135, NULL, 674, NULL, 3, 4154, 1, 'all', 0, 0),
(675, 135, NULL, 675, NULL, 4, 4130, 1, 'all', 0, 0),
(676, 136, NULL, 676, NULL, 0, 12346, 1, 'all', 0, 0),
(677, 136, NULL, 677, NULL, 1, 12288, 1, 'all', 0, 0),
(678, 136, NULL, 678, NULL, 2, 4096, 1, 'all', 0, 0),
(679, 136, NULL, 679, NULL, 3, 4154, 1, 'all', 0, 0),
(680, 136, NULL, 680, NULL, 4, 4130, 1, 'all', 0, 0),
(681, 137, NULL, 681, NULL, 0, 12346, 1, 'all', 0, 0),
(682, 137, NULL, 682, NULL, 1, 12288, 1, 'all', 0, 0),
(683, 137, NULL, 683, NULL, 2, 4096, 1, 'all', 0, 0),
(684, 137, NULL, 684, NULL, 3, 4154, 1, 'all', 0, 0),
(685, 137, NULL, 685, NULL, 4, 4130, 1, 'all', 0, 0),
(686, 138, NULL, 686, NULL, 0, 12346, 1, 'all', 0, 0),
(687, 138, NULL, 687, NULL, 1, 12288, 1, 'all', 0, 0),
(688, 138, NULL, 688, NULL, 2, 4096, 1, 'all', 0, 0),
(689, 138, NULL, 689, NULL, 3, 4154, 1, 'all', 0, 0),
(690, 138, NULL, 690, NULL, 4, 4130, 1, 'all', 0, 0),
(691, 139, NULL, 691, NULL, 0, 12346, 1, 'all', 0, 0),
(692, 139, NULL, 692, NULL, 1, 12288, 1, 'all', 0, 0),
(693, 139, NULL, 693, NULL, 2, 4096, 1, 'all', 0, 0),
(694, 139, NULL, 694, NULL, 3, 4154, 1, 'all', 0, 0),
(695, 139, NULL, 695, NULL, 4, 4130, 1, 'all', 0, 0),
(696, 140, NULL, 696, NULL, 0, 12346, 1, 'all', 0, 0),
(697, 140, NULL, 697, NULL, 1, 12288, 1, 'all', 0, 0),
(698, 140, NULL, 698, NULL, 2, 4096, 1, 'all', 0, 0),
(699, 140, NULL, 699, NULL, 3, 4154, 1, 'all', 0, 0),
(700, 140, NULL, 700, NULL, 4, 4130, 1, 'all', 0, 0),
(701, 141, NULL, 701, NULL, 0, 12346, 1, 'all', 0, 0),
(702, 141, NULL, 702, NULL, 1, 12288, 1, 'all', 0, 0),
(703, 141, NULL, 703, NULL, 2, 4096, 1, 'all', 0, 0),
(704, 141, NULL, 704, NULL, 3, 4154, 1, 'all', 0, 0),
(705, 141, NULL, 705, NULL, 4, 4130, 1, 'all', 0, 0),
(706, 142, NULL, 706, NULL, 0, 12346, 1, 'all', 0, 0),
(707, 142, NULL, 707, NULL, 1, 12288, 1, 'all', 0, 0),
(708, 142, NULL, 708, NULL, 2, 4096, 1, 'all', 0, 0),
(709, 142, NULL, 709, NULL, 3, 4154, 1, 'all', 0, 0),
(710, 142, NULL, 710, NULL, 4, 4130, 1, 'all', 0, 0),
(711, 143, NULL, 711, NULL, 0, 12346, 1, 'all', 0, 0),
(712, 143, NULL, 712, NULL, 1, 12288, 1, 'all', 0, 0),
(713, 143, NULL, 713, NULL, 2, 4096, 1, 'all', 0, 0),
(714, 143, NULL, 714, NULL, 3, 4154, 1, 'all', 0, 0),
(715, 143, NULL, 715, NULL, 4, 4130, 1, 'all', 0, 0),
(716, 144, NULL, 716, NULL, 0, 12346, 1, 'all', 0, 0),
(717, 144, NULL, 717, NULL, 1, 12288, 1, 'all', 0, 0),
(718, 144, NULL, 718, NULL, 2, 4096, 1, 'all', 0, 0),
(719, 144, NULL, 719, NULL, 3, 4154, 1, 'all', 0, 0),
(720, 144, NULL, 720, NULL, 4, 4130, 1, 'all', 0, 0),
(721, 145, NULL, 721, NULL, 0, 12346, 1, 'all', 0, 0),
(722, 145, NULL, 722, NULL, 1, 12288, 1, 'all', 0, 0),
(723, 145, NULL, 723, NULL, 2, 4096, 1, 'all', 0, 0),
(724, 145, NULL, 724, NULL, 3, 4154, 1, 'all', 0, 0),
(725, 145, NULL, 725, NULL, 4, 4130, 1, 'all', 0, 0),
(726, 146, NULL, 726, NULL, 0, 12346, 1, 'all', 0, 0),
(727, 146, NULL, 727, NULL, 1, 12288, 1, 'all', 0, 0),
(728, 146, NULL, 728, NULL, 2, 4096, 1, 'all', 0, 0),
(729, 146, NULL, 729, NULL, 3, 4154, 1, 'all', 0, 0),
(730, 146, NULL, 730, NULL, 4, 4130, 1, 'all', 0, 0),
(731, 147, NULL, 731, NULL, 0, 12346, 1, 'all', 0, 0),
(732, 147, NULL, 732, NULL, 1, 12288, 1, 'all', 0, 0),
(733, 147, NULL, 733, NULL, 2, 4096, 1, 'all', 0, 0),
(734, 147, NULL, 734, NULL, 3, 4154, 1, 'all', 0, 0),
(735, 147, NULL, 735, NULL, 4, 4130, 1, 'all', 0, 0),
(736, 148, NULL, 736, NULL, 0, 12346, 1, 'all', 0, 0),
(737, 148, NULL, 737, NULL, 1, 12288, 1, 'all', 0, 0),
(738, 148, NULL, 738, NULL, 2, 4096, 1, 'all', 0, 0),
(739, 148, NULL, 739, NULL, 3, 4154, 1, 'all', 0, 0),
(740, 148, NULL, 740, NULL, 4, 4130, 1, 'all', 0, 0),
(741, 149, NULL, 741, NULL, 0, 12346, 1, 'all', 0, 0),
(742, 149, NULL, 742, NULL, 1, 12288, 1, 'all', 0, 0),
(743, 149, NULL, 743, NULL, 2, 4096, 1, 'all', 0, 0),
(744, 149, NULL, 744, NULL, 3, 4154, 1, 'all', 0, 0),
(745, 149, NULL, 745, NULL, 4, 4130, 1, 'all', 0, 0),
(746, 150, NULL, 746, NULL, 0, 12346, 1, 'all', 0, 0),
(747, 150, NULL, 747, NULL, 1, 12288, 1, 'all', 0, 0),
(748, 150, NULL, 748, NULL, 2, 4096, 1, 'all', 0, 0),
(749, 150, NULL, 749, NULL, 3, 4154, 1, 'all', 0, 0),
(750, 150, NULL, 750, NULL, 4, 4130, 1, 'all', 0, 0),
(751, 151, NULL, 751, NULL, 0, 12346, 1, 'all', 0, 0),
(752, 151, NULL, 752, NULL, 1, 12288, 1, 'all', 0, 0),
(753, 151, NULL, 753, NULL, 2, 4096, 1, 'all', 0, 0),
(754, 151, NULL, 754, NULL, 3, 4154, 1, 'all', 0, 0),
(755, 151, NULL, 755, NULL, 4, 4130, 1, 'all', 0, 0),
(756, 152, NULL, 756, NULL, 0, 12346, 1, 'all', 0, 0),
(757, 152, NULL, 757, NULL, 1, 12288, 1, 'all', 0, 0),
(758, 152, NULL, 758, NULL, 2, 4096, 1, 'all', 0, 0),
(759, 152, NULL, 759, NULL, 3, 4154, 1, 'all', 0, 0),
(760, 152, NULL, 760, NULL, 4, 4130, 1, 'all', 0, 0),
(761, 153, NULL, 761, NULL, 0, 12346, 1, 'all', 0, 0),
(762, 153, NULL, 762, NULL, 1, 12288, 1, 'all', 0, 0),
(763, 153, NULL, 763, NULL, 2, 4096, 1, 'all', 0, 0),
(764, 153, NULL, 764, NULL, 3, 4154, 1, 'all', 0, 0),
(765, 153, NULL, 765, NULL, 4, 4130, 1, 'all', 0, 0),
(766, 154, NULL, 766, NULL, 0, 12346, 1, 'all', 0, 0),
(767, 154, NULL, 767, NULL, 1, 12288, 1, 'all', 0, 0),
(768, 154, NULL, 768, NULL, 2, 4096, 1, 'all', 0, 0),
(769, 154, NULL, 769, NULL, 3, 4154, 1, 'all', 0, 0),
(770, 154, NULL, 770, NULL, 4, 4130, 1, 'all', 0, 0),
(771, 155, NULL, 771, NULL, 0, 12346, 1, 'all', 0, 0),
(772, 155, NULL, 772, NULL, 1, 12288, 1, 'all', 0, 0),
(773, 155, NULL, 773, NULL, 2, 4096, 1, 'all', 0, 0),
(774, 155, NULL, 774, NULL, 3, 4154, 1, 'all', 0, 0),
(775, 155, NULL, 775, NULL, 4, 4130, 1, 'all', 0, 0),
(776, 156, NULL, 16, NULL, 0, 61, 1, 'all', 0, 0),
(777, 156, NULL, 17, NULL, 1, 5, 1, 'all', 0, 0),
(778, 156, NULL, 19, NULL, 2, 61, 1, 'all', 0, 0),
(779, 156, NULL, 20, NULL, 3, 37, 1, 'all', 0, 0),
(780, 157, NULL, 21, NULL, 0, 61, 1, 'all', 0, 0),
(781, 157, NULL, 22, NULL, 1, 5, 1, 'all', 0, 0),
(782, 157, NULL, 24, NULL, 2, 61, 1, 'all', 0, 0),
(783, 157, NULL, 25, NULL, 3, 37, 1, 'all', 0, 0),
(784, 158, NULL, 51, NULL, 0, 61, 1, 'all', 0, 0),
(785, 158, NULL, 52, NULL, 1, 5, 1, 'all', 0, 0),
(786, 158, NULL, 54, NULL, 2, 61, 1, 'all', 0, 0),
(787, 158, NULL, 55, NULL, 3, 37, 1, 'all', 0, 0),
(788, 159, NULL, 166, NULL, 0, 61, 1, 'all', 0, 0),
(789, 159, NULL, 167, NULL, 1, 5, 1, 'all', 0, 0),
(790, 159, NULL, 169, NULL, 2, 61, 1, 'all', 0, 0),
(791, 159, NULL, 170, NULL, 3, 37, 1, 'all', 0, 0),
(792, 160, NULL, 171, NULL, 0, 61, 1, 'all', 0, 0),
(793, 160, NULL, 172, NULL, 1, 5, 1, 'all', 0, 0),
(794, 160, NULL, 174, NULL, 2, 61, 1, 'all', 0, 0),
(795, 160, NULL, 175, NULL, 3, 37, 1, 'all', 0, 0),
(796, 161, NULL, 196, NULL, 0, 61, 1, 'all', 0, 0),
(797, 161, NULL, 197, NULL, 1, 5, 1, 'all', 0, 0),
(798, 161, NULL, 199, NULL, 2, 61, 1, 'all', 0, 0),
(799, 161, NULL, 200, NULL, 3, 37, 1, 'all', 0, 0),
(800, 162, NULL, 201, NULL, 0, 61, 1, 'all', 0, 0),
(801, 162, NULL, 202, NULL, 1, 5, 1, 'all', 0, 0),
(802, 162, NULL, 204, NULL, 2, 61, 1, 'all', 0, 0),
(803, 162, NULL, 205, NULL, 3, 37, 1, 'all', 0, 0),
(804, 163, NULL, 221, NULL, 0, 61, 1, 'all', 0, 0),
(805, 163, NULL, 222, NULL, 1, 5, 1, 'all', 0, 0),
(806, 163, NULL, 224, NULL, 2, 61, 1, 'all', 0, 0),
(807, 163, NULL, 225, NULL, 3, 37, 1, 'all', 0, 0),
(808, 164, NULL, 236, NULL, 0, 61, 1, 'all', 0, 0),
(809, 164, NULL, 237, NULL, 1, 5, 1, 'all', 0, 0),
(810, 164, NULL, 239, NULL, 2, 61, 1, 'all', 0, 0),
(811, 164, NULL, 240, NULL, 3, 37, 1, 'all', 0, 0),
(812, 165, NULL, 241, NULL, 0, 61, 1, 'all', 0, 0),
(813, 165, NULL, 242, NULL, 1, 5, 1, 'all', 0, 0),
(814, 165, NULL, 244, NULL, 2, 61, 1, 'all', 0, 0),
(815, 165, NULL, 245, NULL, 3, 37, 1, 'all', 0, 0),
(816, 166, NULL, 246, NULL, 0, 61, 1, 'all', 0, 0),
(817, 166, NULL, 247, NULL, 1, 5, 1, 'all', 0, 0),
(818, 166, NULL, 249, NULL, 2, 61, 1, 'all', 0, 0),
(819, 166, NULL, 250, NULL, 3, 37, 1, 'all', 0, 0),
(820, 167, NULL, 251, NULL, 0, 61, 1, 'all', 0, 0),
(821, 167, NULL, 252, NULL, 1, 5, 1, 'all', 0, 0),
(822, 167, NULL, 254, NULL, 2, 61, 1, 'all', 0, 0),
(823, 167, NULL, 255, NULL, 3, 37, 1, 'all', 0, 0),
(824, 168, NULL, 256, NULL, 0, 61, 1, 'all', 0, 0),
(825, 168, NULL, 257, NULL, 1, 5, 1, 'all', 0, 0),
(826, 168, NULL, 259, NULL, 2, 61, 1, 'all', 0, 0),
(827, 168, NULL, 260, NULL, 3, 37, 1, 'all', 0, 0),
(828, 169, NULL, 531, NULL, 0, 61, 1, 'all', 0, 0),
(829, 169, NULL, 532, NULL, 1, 5, 1, 'all', 0, 0),
(830, 169, NULL, 534, NULL, 2, 61, 1, 'all', 0, 0),
(831, 169, NULL, 535, NULL, 3, 37, 1, 'all', 0, 0),
(832, 170, NULL, 576, NULL, 0, 61, 1, 'all', 0, 0),
(833, 170, NULL, 577, NULL, 1, 5, 1, 'all', 0, 0),
(834, 170, NULL, 579, NULL, 2, 61, 1, 'all', 0, 0),
(835, 170, NULL, 580, NULL, 3, 37, 1, 'all', 0, 0),
(836, 171, NULL, 26, NULL, 0, 61, 1, 'all', 0, 0),
(837, 171, NULL, 27, NULL, 1, 5, 1, 'all', 0, 0),
(838, 171, NULL, 29, NULL, 2, 61, 1, 'all', 0, 0),
(839, 171, NULL, 30, NULL, 3, 37, 1, 'all', 0, 0),
(840, 171, 233, 776, NULL, 0, 128, 1, 'all', 0, 0),
(841, 171, 234, 776, NULL, 0, 128, 1, 'all', 0, 0),
(842, 172, NULL, 541, NULL, 0, 61, 1, 'all', 0, 0),
(843, 172, NULL, 542, NULL, 1, 5, 1, 'all', 0, 0),
(844, 172, NULL, 544, NULL, 2, 61, 1, 'all', 0, 0),
(845, 172, NULL, 545, NULL, 3, 37, 1, 'all', 0, 0),
(846, 172, 235, 776, NULL, 0, 128, 1, 'all', 0, 0),
(847, 173, NULL, 536, NULL, 0, 61, 1, 'all', 0, 0),
(848, 173, NULL, 537, NULL, 1, 5, 1, 'all', 0, 0),
(849, 173, NULL, 539, NULL, 2, 61, 1, 'all', 0, 0),
(850, 173, NULL, 540, NULL, 3, 37, 1, 'all', 0, 0),
(851, 173, 236, 776, NULL, 0, 128, 1, 'all', 0, 0),
(852, 174, NULL, 651, NULL, 0, 61, 1, 'all', 0, 0),
(853, 174, NULL, 652, NULL, 1, 5, 1, 'all', 0, 0),
(854, 174, NULL, 654, NULL, 2, 61, 1, 'all', 0, 0),
(855, 174, NULL, 655, NULL, 3, 37, 1, 'all', 0, 0),
(856, 174, 237, 776, NULL, 0, 128, 1, 'all', 0, 0),
(857, 175, NULL, 646, NULL, 0, 61, 1, 'all', 0, 0),
(858, 175, NULL, 647, NULL, 1, 5, 1, 'all', 0, 0),
(859, 175, NULL, 649, NULL, 2, 61, 1, 'all', 0, 0),
(860, 175, NULL, 650, NULL, 3, 37, 1, 'all', 0, 0),
(861, 175, 238, 776, NULL, 0, 128, 1, 'all', 0, 0),
(862, 176, NULL, 561, NULL, 0, 61, 1, 'all', 0, 0),
(863, 176, NULL, 562, NULL, 1, 5, 1, 'all', 0, 0),
(864, 176, NULL, 564, NULL, 2, 61, 1, 'all', 0, 0),
(865, 176, NULL, 565, NULL, 3, 37, 1, 'all', 0, 0),
(866, 176, 239, 776, NULL, 0, 128, 1, 'all', 0, 0),
(867, 177, NULL, 676, NULL, 0, 61, 1, 'all', 0, 0),
(868, 177, NULL, 677, NULL, 1, 5, 1, 'all', 0, 0),
(869, 177, NULL, 679, NULL, 2, 61, 1, 'all', 0, 0),
(870, 177, NULL, 680, NULL, 3, 37, 1, 'all', 0, 0),
(871, 177, 240, 776, NULL, 0, 128, 1, 'all', 0, 0),
(872, 178, NULL, 666, NULL, 0, 61, 1, 'all', 0, 0),
(873, 178, NULL, 667, NULL, 1, 5, 1, 'all', 0, 0),
(874, 178, NULL, 669, NULL, 2, 61, 1, 'all', 0, 0),
(875, 178, NULL, 670, NULL, 3, 37, 1, 'all', 0, 0),
(876, 178, 241, 776, NULL, 0, 128, 1, 'all', 0, 0),
(877, 179, NULL, 206, NULL, 0, 61, 1, 'all', 0, 0),
(878, 179, NULL, 207, NULL, 1, 5, 1, 'all', 0, 0),
(879, 179, NULL, 209, NULL, 2, 61, 1, 'all', 0, 0),
(880, 179, NULL, 210, NULL, 3, 37, 1, 'all', 0, 0),
(881, 179, 242, 776, NULL, 0, 128, 1, 'all', 0, 0),
(882, 179, 243, 776, NULL, 0, 128, 1, 'all', 0, 0),
(883, 179, 244, 776, NULL, 0, 128, 1, 'all', 0, 0),
(884, 179, 245, 776, NULL, 0, 128, 1, 'all', 0, 0),
(885, 180, NULL, 211, NULL, 0, 61, 1, 'all', 0, 0),
(886, 180, NULL, 212, NULL, 1, 5, 1, 'all', 0, 0),
(887, 180, NULL, 214, NULL, 2, 61, 1, 'all', 0, 0),
(888, 180, NULL, 215, NULL, 3, 37, 1, 'all', 0, 0),
(889, 180, 246, 776, NULL, 0, 128, 1, 'all', 0, 0),
(890, 180, 247, 776, NULL, 0, 128, 1, 'all', 0, 0),
(891, 180, 248, 776, NULL, 0, 128, 1, 'all', 0, 0),
(892, 180, 249, 776, NULL, 0, 128, 1, 'all', 0, 0),
(893, 181, NULL, 591, NULL, 0, 61, 1, 'all', 0, 0),
(894, 181, NULL, 592, NULL, 1, 5, 1, 'all', 0, 0),
(895, 181, NULL, 594, NULL, 2, 61, 1, 'all', 0, 0),
(896, 181, NULL, 595, NULL, 3, 37, 1, 'all', 0, 0),
(897, 181, 250, 776, NULL, 0, 128, 1, 'all', 0, 0),
(898, 180, 251, 776, NULL, 0, 128, 1, 'all', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `acl_object_identities`
--

CREATE TABLE `acl_object_identities` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_object_identity_id` int(10) UNSIGNED DEFAULT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `object_identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entries_inheriting` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `acl_object_identities`
--

INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES
(1, NULL, 1, 'sonata.media.admin.media', 1),
(2, NULL, 2, 'sonata.media.admin.gallery', 1),
(3, NULL, 3, 'sonata.media.admin.gallery_has_media', 1),
(4, NULL, 4, 'sonata.user.admin.user', 1),
(5, NULL, 5, 'sonata.user.admin.group', 1),
(6, NULL, 6, 'base.admin.tag', 1),
(7, NULL, 7, 'base.admin.web_tv', 1),
(8, NULL, 8, 'base.admin.contact_theme', 1),
(9, NULL, 9, 'base.admin.social_wall', 1),
(10, NULL, 10, 'base.admin.theme', 1),
(11, NULL, 11, 'base.admin.fdc_event_routes', 1),
(12, NULL, 12, 'base.admin.fdc_page_waiting', 1),
(13, NULL, 13, 'base.admin.event', 1),
(14, NULL, 14, 'base.admin.statement_article', 1),
(15, NULL, 15, 'base.admin.statement_video', 1),
(16, NULL, 16, 'base.admin.statement_image', 1),
(17, NULL, 17, 'base.admin.statement_audio', 1),
(18, NULL, 18, 'base.admin.info_article', 1),
(19, NULL, 19, 'base.admin.info_video', 1),
(20, NULL, 20, 'base.admin.info_image', 1),
(21, NULL, 21, 'base.admin.info_audio', 1),
(22, NULL, 22, 'base.admin.news_article', 1),
(23, NULL, 23, 'base.admin.news_video', 1),
(24, NULL, 24, 'base.admin.news_image', 1),
(25, NULL, 25, 'base.admin.news_audio', 1),
(26, NULL, 26, 'base.admin.media_image', 1),
(27, NULL, 27, 'base.admin.media_image_simple', 1),
(28, NULL, 28, 'base.admin.media_audio', 1),
(29, NULL, 29, 'base.admin.media_video', 1),
(30, NULL, 30, 'base.admin.film_film', 1),
(31, NULL, 31, 'base.admin.film_projection', 1),
(32, NULL, 32, 'base.admin.film_atelier', 1),
(33, NULL, 33, 'base.admin.film_person', 1),
(34, NULL, 34, 'base.admin.fdc_page_web_tv_channels', 1),
(35, NULL, 35, 'base.admin.fdc_page_web_tv_live', 1),
(36, NULL, 36, 'base.admin.fdc_page_web_tv_live_web_tv_associated', 1),
(37, NULL, 37, 'base.admin.fdc_page_web_tv_live_media_video_associated', 1),
(38, NULL, 38, 'base.admin.fdc_page_web_tv_trailers', 1),
(39, NULL, 39, 'base.admin.fdc_page_la_selection_cannes_classics', 1),
(40, NULL, 40, 'base.admin.fdc_page_la_selection', 1),
(41, NULL, 41, 'base.admin.fdc_page_la_selection_cinema_plage', 1),
(42, NULL, 42, 'base.admin.fdc_page_jury', 1),
(43, NULL, 43, 'base.admin.fdc_page_award', 1),
(44, NULL, 44, 'base.admin.fdc_page_award_other_selection_sections_associated', 1),
(45, NULL, 45, 'base.admin.fdc_page_event', 1),
(46, NULL, 46, 'base.admin.film_jury_type', 1),
(47, NULL, 47, 'base.admin.film_selection_section', 1),
(48, NULL, 48, 'base.admin.fdc_page_news_articles', 1),
(49, NULL, 49, 'base.admin.fdc_page_news_images', 1),
(50, NULL, 50, 'base.admin.fdc_page_news_audios', 1),
(51, NULL, 51, 'base.admin.fdc_page_news_videos', 1),
(52, NULL, 52, 'base.admin.homepage', 1),
(53, NULL, 53, 'base.admin.homepage_slide', 1),
(54, NULL, 54, 'base.admin.country', 1),
(55, NULL, 55, 'base.admin.event_widget_image_dummy', 1),
(56, NULL, 56, 'base.admin.event_widget_audio_dummy', 1),
(57, NULL, 57, 'base.admin.event_widget_image_dual_align_dummy', 1),
(58, NULL, 58, 'base.admin.event_widget_quote_dummy', 1),
(59, NULL, 59, 'base.admin.event_widget_text_dummy', 1),
(60, NULL, 60, 'base.admin.event_widget_video_dummy', 1),
(61, NULL, 61, 'base.admin.event_widget_video_youtube_dummy', 1),
(62, NULL, 62, 'base.admin.event_widget_subtitle_dummy', 1),
(63, NULL, 63, 'base.admin.news_widget_audio_dummy', 1),
(64, NULL, 64, 'base.admin.news_widget_image_dummy', 1),
(65, NULL, 65, 'base.admin.news_widget_image_dual_align_dummy', 1),
(66, NULL, 66, 'base.admin.homepage_films_associated', 1),
(67, NULL, 67, 'base.admin.news_widget_video_dummy', 1),
(68, NULL, 68, 'base.admin.news_widget_video_youtube_dummy', 1),
(69, NULL, 69, 'base.admin.media_tag', 1),
(70, NULL, 70, 'base.admin.media', 1),
(71, NULL, 71, 'base.admin.gallery', 1),
(72, NULL, 72, 'base.admin.gallery_media', 1),
(73, NULL, 73, 'base.admin.gallery_dual_align', 1),
(74, NULL, 74, 'base.admin.gallery_dual_align_media', 1),
(75, NULL, 75, 'base.admin.homepage_top_videos_associated', 1),
(76, NULL, 76, 'base.admin.homepage_top_web_tvs_associated', 1),
(77, NULL, 77, 'base.admin.news', 1),
(78, NULL, 78, 'base.admin.news_tag', 1),
(79, NULL, 79, 'base.admin.news_news_associated', 1),
(80, NULL, 80, 'base.admin.news_film_projection_associated', 1),
(81, NULL, 81, 'base.admin.news_film_film_associated', 1),
(82, NULL, 82, 'base.admin.media_video_film_film_associated', 1),
(83, NULL, 83, 'base.admin.media_audio_film_film_associated', 1),
(84, NULL, 84, 'base.admin.film_film_media', 1),
(85, NULL, 85, 'base.admin.film_media', 1),
(86, NULL, 86, 'base.admin.statement_widget_image_dummy', 1),
(87, NULL, 87, 'base.admin.statement_widget_image_dual_align_dummy', 1),
(88, NULL, 88, 'base.admin.statement_widget_audio_dummy', 1),
(89, NULL, 89, 'base.admin.statement', 1),
(90, NULL, 90, 'base.admin.statement_tag', 1),
(91, NULL, 91, 'base.admin.statement_statement_associated', 1),
(92, NULL, 92, 'base.admin.statement_film_projection_associated', 1),
(93, NULL, 93, 'base.admin.statement_film_film_associated', 1),
(94, NULL, 94, 'base.admin.statement_widget_video_dummy', 1),
(95, NULL, 95, 'base.admin.statement_widget_video_youtube_dummy', 1),
(96, NULL, 96, 'base.admin.event_film_projection_associated', 1),
(97, NULL, 97, 'base.admin.info_widget_image_dummy', 1),
(98, NULL, 98, 'base.admin.info_widget_image_dual_align_dummy', 1),
(99, NULL, 99, 'base.admin.info_widget_audio_dummy', 1),
(100, NULL, 100, 'base.admin.info_widget_video_dummy', 1),
(101, NULL, 101, 'base.admin.info_widget_video_youtube_dummy', 1),
(102, NULL, 102, 'base.admin.info', 1),
(103, NULL, 103, 'base.admin.info_tag', 1),
(104, NULL, 104, 'base.admin.info_info_associated', 1),
(105, NULL, 105, 'base.admin.info_film_projection_associated', 1),
(106, NULL, 106, 'base.admin.info_film_film_associated', 1),
(107, NULL, 107, 'base.admin.contact_page', 1),
(108, NULL, 108, 'base.admin.press_statement_info', 1),
(109, NULL, 109, 'base.admin.press_homepage', 1),
(110, NULL, 110, 'base.admin.press_homepage_section', 1),
(111, NULL, 111, 'base.admin.press_homepage_media', 1),
(112, NULL, 112, 'base.admin.press_homepage_download', 1),
(113, NULL, 113, 'base.admin.press_accredit', 1),
(114, NULL, 114, 'base.admin.press_accredit_has_procedure', 1),
(115, NULL, 115, 'base.admin.press_accredit_procedure', 1),
(116, NULL, 116, 'base.admin.press_guide', 1),
(117, NULL, 117, 'base.admin.press_guide_widget_image_dummy', 1),
(118, NULL, 118, 'base.admin.press_guide_widget_column_dummy', 1),
(119, NULL, 119, 'base.admin.fdc_page_prepare', 1),
(120, NULL, 120, 'base.admin.fdc_page_prepare_widget_image_dummy', 1),
(121, NULL, 121, 'base.admin.fdc_page_prepare_widget_column_dummy', 1),
(122, NULL, 122, 'base.admin.fdc_page_participate', 1),
(123, NULL, 123, 'base.admin.fdc_page_participate_section', 1),
(124, NULL, 124, 'base.admin.fdc_page_participate_has_section', 1),
(125, NULL, 125, 'base.admin.fdc_page_participate_section_widget_typeone_dummy', 1),
(126, NULL, 126, 'base.admin.fdc_page_participate_section_widget_typetwo_dummy', 1),
(127, NULL, 127, 'base.admin.fdc_page_participate_section_widget_typethree_dummy', 1),
(128, NULL, 128, 'base.admin.fdc_page_participate_section_widget_typefour_dummy', 1),
(129, NULL, 129, 'base.admin.fdc_page_participate_section_widget_typefive_dummy', 1),
(130, NULL, 130, 'base.admin.press_media_library', 1),
(131, NULL, 131, 'base.admin.press_download', 1),
(132, NULL, 132, 'base.admin.press_download_section', 1),
(133, NULL, 133, 'base.admin.press_download_has_section', 1),
(134, NULL, 134, 'base.admin.press_projection', 1),
(135, NULL, 135, 'base.admin.press_cinema_room', 1),
(136, NULL, 136, 'base.admin.press_cinema_map', 1),
(137, NULL, 137, 'base.admin.press_cinema_map_room', 1),
(138, NULL, 138, 'base.admin.press_download_section_widget_photo_dummy', 1),
(139, NULL, 139, 'base.admin.press_download_section_widget_video_dummy', 1),
(140, NULL, 140, 'base.admin.press_download_section_widget_document_dummy', 1),
(141, NULL, 141, 'base.admin.press_download_section_widget_archive_dummy', 1),
(142, NULL, 142, 'base.admin.press_download_section_widget_file_dummy', 1),
(143, NULL, 143, 'base_admin.media_film_projection_associated', 1),
(144, NULL, 144, 'base.admin.film_film_tag', 1),
(145, NULL, 145, 'base.admin.fdc_page_la_selection_cannes_classics_widget_movie_dummy', 1),
(146, NULL, 146, 'base.admin.fdc_page_la_selection_cannes_classics_widget_audio_dummy', 1),
(147, NULL, 147, 'base.admin.fdc_page_la_selection_cannes_classics_widget_image_dummy', 1),
(148, NULL, 148, 'base.admin.fdc_page_la_selection_cannes_classics_widget_image_dual_align_dummy', 1),
(149, NULL, 149, 'base.admin.fdc_page_la_selection_cannes_classics_widget_quote_dummy', 1),
(150, NULL, 150, 'base.admin.fdc_page_la_selection_cannes_classics_widget_text_dummy', 1),
(151, NULL, 151, 'base.admin.fdc_page_la_selection_cannes_classics_widget_video_dummy', 1),
(152, NULL, 152, 'base.admin.fdc_page_la_selection_cannes_classics_widget_video_youtube_dummy', 1),
(153, NULL, 153, 'base.admin.amazon_remote_file', 1),
(154, NULL, 154, 'base.admin.widget_movie', 1),
(155, NULL, 155, 'base.admin.widget_movie_film_film', 1),
(156, NULL, 156, '1', 1),
(157, NULL, 156, '2', 1),
(158, NULL, 156, '3', 1),
(159, NULL, 156, '4', 1),
(160, NULL, 156, '5', 1),
(161, NULL, 157, '2', 1),
(162, NULL, 157, '4', 1),
(163, NULL, 157, '6', 1),
(164, NULL, 157, '7', 1),
(165, NULL, 157, '8', 1),
(166, NULL, 157, '9', 1),
(167, NULL, 157, '10', 1),
(168, NULL, 157, '11', 1),
(169, NULL, 157, '12', 1),
(170, NULL, 157, '13', 1),
(171, NULL, 157, '14', 1),
(172, NULL, 157, '15', 1),
(173, NULL, 157, '16', 1),
(174, NULL, 158, '1', 1),
(175, NULL, 158, '2', 1),
(176, NULL, 158, '3', 1),
(177, NULL, 158, '4', 1),
(178, NULL, 158, '5', 1),
(179, NULL, 158, '6', 1),
(180, NULL, 158, '7', 1),
(181, NULL, 158, '8', 1),
(182, NULL, 158, '9', 1),
(183, NULL, 158, '10', 1),
(184, NULL, 158, '11', 1),
(185, NULL, 158, '12', 1),
(186, NULL, 158, '13', 1),
(187, NULL, 158, '14', 1),
(188, NULL, 158, '15', 1),
(189, NULL, 158, '16', 1),
(190, NULL, 158, '17', 1),
(191, NULL, 158, '18', 1),
(192, NULL, 158, '19', 1),
(193, NULL, 158, '20', 1),
(194, NULL, 158, '21', 1),
(195, NULL, 158, '22', 1),
(196, NULL, 158, '23', 1),
(197, NULL, 158, '24', 1),
(198, NULL, 158, '25', 1),
(199, NULL, 158, '26', 1),
(200, NULL, 158, '27', 1),
(201, NULL, 158, '28', 1),
(202, NULL, 158, '29', 1),
(203, NULL, 158, '30', 1),
(204, NULL, 158, '31', 1),
(205, NULL, 158, '32', 1),
(206, NULL, 158, '33', 1),
(207, NULL, 158, '34', 1),
(208, NULL, 158, '35', 1),
(209, NULL, 158, '36', 1),
(210, NULL, 158, '37', 1),
(211, NULL, 158, '38', 1),
(212, NULL, 158, '39', 1),
(213, NULL, 158, '40', 1),
(214, NULL, 158, '41', 1),
(215, NULL, 158, '42', 1),
(216, NULL, 159, '1', 1),
(217, NULL, 160, '1', 1),
(218, NULL, 161, '1', 1),
(219, NULL, 161, '2', 1),
(220, NULL, 161, '3', 1),
(221, NULL, 161, '4', 1),
(222, NULL, 161, '5', 1),
(223, NULL, 161, '6', 1),
(224, NULL, 162, '1', 1),
(225, NULL, 163, '1', 1),
(226, NULL, 164, '1', 1),
(227, NULL, 165, '1', 1),
(228, NULL, 166, '1', 1),
(229, NULL, 167, '1', 1),
(230, NULL, 168, '1', 1),
(231, NULL, 169, '1', 1),
(232, NULL, 170, '1', 1),
(233, NULL, 171, '1', 1),
(234, NULL, 171, '2', 1),
(235, NULL, 172, '1', 1),
(236, NULL, 173, '1', 1),
(237, NULL, 174, '1', 1),
(238, NULL, 175, '1', 1),
(239, NULL, 176, '1', 1),
(240, NULL, 177, '1', 1),
(241, NULL, 178, '1', 1),
(242, NULL, 179, '1', 1),
(243, NULL, 179, '2', 1),
(244, NULL, 179, '3', 1),
(245, NULL, 179, '4', 1),
(246, NULL, 180, '1', 1),
(247, NULL, 180, '2', 1),
(248, NULL, 180, '3', 1),
(249, NULL, 180, '4', 1),
(250, NULL, 181, '1', 1),
(251, NULL, 180, '5', 1);

-- --------------------------------------------------------

--
-- Structure de la table `acl_object_identity_ancestors`
--

CREATE TABLE `acl_object_identity_ancestors` (
  `object_identity_id` int(10) UNSIGNED NOT NULL,
  `ancestor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `acl_object_identity_ancestors`
--

INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38),
(39, 39),
(40, 40),
(41, 41),
(42, 42),
(43, 43),
(44, 44),
(45, 45),
(46, 46),
(47, 47),
(48, 48),
(49, 49),
(50, 50),
(51, 51),
(52, 52),
(53, 53),
(54, 54),
(55, 55),
(56, 56),
(57, 57),
(58, 58),
(59, 59),
(60, 60),
(61, 61),
(62, 62),
(63, 63),
(64, 64),
(65, 65),
(66, 66),
(67, 67),
(68, 68),
(69, 69),
(70, 70),
(71, 71),
(72, 72),
(73, 73),
(74, 74),
(75, 75),
(76, 76),
(77, 77),
(78, 78),
(79, 79),
(80, 80),
(81, 81),
(82, 82),
(83, 83),
(84, 84),
(85, 85),
(86, 86),
(87, 87),
(88, 88),
(89, 89),
(90, 90),
(91, 91),
(92, 92),
(93, 93),
(94, 94),
(95, 95),
(96, 96),
(97, 97),
(98, 98),
(99, 99),
(100, 100),
(101, 101),
(102, 102),
(103, 103),
(104, 104),
(105, 105),
(106, 106),
(107, 107),
(108, 108),
(109, 109),
(110, 110),
(111, 111),
(112, 112),
(113, 113),
(114, 114),
(115, 115),
(116, 116),
(117, 117),
(118, 118),
(119, 119),
(120, 120),
(121, 121),
(122, 122),
(123, 123),
(124, 124),
(125, 125),
(126, 126),
(127, 127),
(128, 128),
(129, 129),
(130, 130),
(131, 131),
(132, 132),
(133, 133),
(134, 134),
(135, 135),
(136, 136),
(137, 137),
(138, 138),
(139, 139),
(140, 140),
(141, 141),
(142, 142),
(143, 143),
(144, 144),
(145, 145),
(146, 146),
(147, 147),
(148, 148),
(149, 149),
(150, 150),
(151, 151),
(152, 152),
(153, 153),
(154, 154),
(155, 155),
(156, 156),
(157, 157),
(158, 158),
(159, 159),
(160, 160),
(161, 161),
(162, 162),
(163, 163),
(164, 164),
(165, 165),
(166, 166),
(167, 167),
(168, 168),
(169, 169),
(170, 170),
(171, 171),
(172, 172),
(173, 173),
(174, 174),
(175, 175),
(176, 176),
(177, 177),
(178, 178),
(179, 179),
(180, 180),
(181, 181),
(182, 182),
(183, 183),
(184, 184),
(185, 185),
(186, 186),
(187, 187),
(188, 188),
(189, 189),
(190, 190),
(191, 191),
(192, 192),
(193, 193),
(194, 194),
(195, 195),
(196, 196),
(197, 197),
(198, 198),
(199, 199),
(200, 200),
(201, 201),
(202, 202),
(203, 203),
(204, 204),
(205, 205),
(206, 206),
(207, 207),
(208, 208),
(209, 209),
(210, 210),
(211, 211),
(212, 212),
(213, 213),
(214, 214),
(215, 215),
(216, 216),
(217, 217),
(218, 218),
(219, 219),
(220, 220),
(221, 221),
(222, 222),
(223, 223),
(224, 224),
(225, 225),
(226, 226),
(227, 227),
(228, 228),
(229, 229),
(230, 230),
(231, 231),
(232, 232),
(233, 233),
(234, 234),
(235, 235),
(236, 236),
(237, 237),
(238, 238),
(239, 239),
(240, 240),
(241, 241),
(242, 242),
(243, 243),
(244, 244),
(245, 245),
(246, 246),
(247, 247),
(248, 248),
(249, 249),
(250, 250),
(251, 251);

-- --------------------------------------------------------

--
-- Structure de la table `acl_security_identities`
--

CREATE TABLE `acl_security_identities` (
  `id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `acl_security_identities`
--

INSERT INTO `acl_security_identities` (`id`, `identifier`, `username`) VALUES
(776, 'Application\\Sonata\\UserBundle\\Entity\\User-all-admin', 1),
(761, 'ROLE_BASE_ADMIN_AMAZON_REMOTE_FILE_ADMIN', 0),
(764, 'ROLE_BASE_ADMIN_AMAZON_REMOTE_FILE_EDITOR', 0),
(763, 'ROLE_BASE_ADMIN_AMAZON_REMOTE_FILE_LIST', 0),
(762, 'ROLE_BASE_ADMIN_AMAZON_REMOTE_FILE_TRANSLATOR', 0),
(765, 'ROLE_BASE_ADMIN_AMAZON_REMOTE_FILE_WRITER', 0),
(531, 'ROLE_BASE_ADMIN_CONTACT_PAGE_ADMIN', 0),
(534, 'ROLE_BASE_ADMIN_CONTACT_PAGE_EDITOR', 0),
(533, 'ROLE_BASE_ADMIN_CONTACT_PAGE_LIST', 0),
(532, 'ROLE_BASE_ADMIN_CONTACT_PAGE_TRANSLATOR', 0),
(535, 'ROLE_BASE_ADMIN_CONTACT_PAGE_WRITER', 0),
(36, 'ROLE_BASE_ADMIN_CONTACT_THEME_ADMIN', 0),
(39, 'ROLE_BASE_ADMIN_CONTACT_THEME_EDITOR', 0),
(38, 'ROLE_BASE_ADMIN_CONTACT_THEME_LIST', 0),
(37, 'ROLE_BASE_ADMIN_CONTACT_THEME_TRANSLATOR', 0),
(40, 'ROLE_BASE_ADMIN_CONTACT_THEME_WRITER', 0),
(266, 'ROLE_BASE_ADMIN_COUNTRY_ADMIN', 0),
(269, 'ROLE_BASE_ADMIN_COUNTRY_EDITOR', 0),
(268, 'ROLE_BASE_ADMIN_COUNTRY_LIST', 0),
(267, 'ROLE_BASE_ADMIN_COUNTRY_TRANSLATOR', 0),
(270, 'ROLE_BASE_ADMIN_COUNTRY_WRITER', 0),
(61, 'ROLE_BASE_ADMIN_EVENT_ADMIN', 0),
(64, 'ROLE_BASE_ADMIN_EVENT_EDITOR', 0),
(476, 'ROLE_BASE_ADMIN_EVENT_FILM_PROJECTION_ASSOCIATED_ADMIN', 0),
(479, 'ROLE_BASE_ADMIN_EVENT_FILM_PROJECTION_ASSOCIATED_EDITOR', 0),
(478, 'ROLE_BASE_ADMIN_EVENT_FILM_PROJECTION_ASSOCIATED_LIST', 0),
(477, 'ROLE_BASE_ADMIN_EVENT_FILM_PROJECTION_ASSOCIATED_TRANSLATOR', 0),
(480, 'ROLE_BASE_ADMIN_EVENT_FILM_PROJECTION_ASSOCIATED_WRITER', 0),
(63, 'ROLE_BASE_ADMIN_EVENT_LIST', 0),
(62, 'ROLE_BASE_ADMIN_EVENT_TRANSLATOR', 0),
(276, 'ROLE_BASE_ADMIN_EVENT_WIDGET_AUDIO_DUMMY_ADMIN', 0),
(279, 'ROLE_BASE_ADMIN_EVENT_WIDGET_AUDIO_DUMMY_EDITOR', 0),
(278, 'ROLE_BASE_ADMIN_EVENT_WIDGET_AUDIO_DUMMY_LIST', 0),
(277, 'ROLE_BASE_ADMIN_EVENT_WIDGET_AUDIO_DUMMY_TRANSLATOR', 0),
(280, 'ROLE_BASE_ADMIN_EVENT_WIDGET_AUDIO_DUMMY_WRITER', 0),
(281, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_ADMIN', 0),
(284, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_EDITOR', 0),
(283, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_LIST', 0),
(282, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_TRANSLATOR', 0),
(285, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_WRITER', 0),
(271, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUMMY_ADMIN', 0),
(274, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUMMY_EDITOR', 0),
(273, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUMMY_LIST', 0),
(272, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUMMY_TRANSLATOR', 0),
(275, 'ROLE_BASE_ADMIN_EVENT_WIDGET_IMAGE_DUMMY_WRITER', 0),
(286, 'ROLE_BASE_ADMIN_EVENT_WIDGET_QUOTE_DUMMY_ADMIN', 0),
(289, 'ROLE_BASE_ADMIN_EVENT_WIDGET_QUOTE_DUMMY_EDITOR', 0),
(288, 'ROLE_BASE_ADMIN_EVENT_WIDGET_QUOTE_DUMMY_LIST', 0),
(287, 'ROLE_BASE_ADMIN_EVENT_WIDGET_QUOTE_DUMMY_TRANSLATOR', 0),
(290, 'ROLE_BASE_ADMIN_EVENT_WIDGET_QUOTE_DUMMY_WRITER', 0),
(306, 'ROLE_BASE_ADMIN_EVENT_WIDGET_SUBTITLE_DUMMY_ADMIN', 0),
(309, 'ROLE_BASE_ADMIN_EVENT_WIDGET_SUBTITLE_DUMMY_EDITOR', 0),
(308, 'ROLE_BASE_ADMIN_EVENT_WIDGET_SUBTITLE_DUMMY_LIST', 0),
(307, 'ROLE_BASE_ADMIN_EVENT_WIDGET_SUBTITLE_DUMMY_TRANSLATOR', 0),
(310, 'ROLE_BASE_ADMIN_EVENT_WIDGET_SUBTITLE_DUMMY_WRITER', 0),
(291, 'ROLE_BASE_ADMIN_EVENT_WIDGET_TEXT_DUMMY_ADMIN', 0),
(294, 'ROLE_BASE_ADMIN_EVENT_WIDGET_TEXT_DUMMY_EDITOR', 0),
(293, 'ROLE_BASE_ADMIN_EVENT_WIDGET_TEXT_DUMMY_LIST', 0),
(292, 'ROLE_BASE_ADMIN_EVENT_WIDGET_TEXT_DUMMY_TRANSLATOR', 0),
(295, 'ROLE_BASE_ADMIN_EVENT_WIDGET_TEXT_DUMMY_WRITER', 0),
(296, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_DUMMY_ADMIN', 0),
(299, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_DUMMY_EDITOR', 0),
(298, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_DUMMY_LIST', 0),
(297, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_DUMMY_TRANSLATOR', 0),
(300, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_DUMMY_WRITER', 0),
(301, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_YOUTUBE_DUMMY_ADMIN', 0),
(304, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_YOUTUBE_DUMMY_EDITOR', 0),
(303, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_YOUTUBE_DUMMY_LIST', 0),
(302, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_YOUTUBE_DUMMY_TRANSLATOR', 0),
(305, 'ROLE_BASE_ADMIN_EVENT_WIDGET_VIDEO_YOUTUBE_DUMMY_WRITER', 0),
(65, 'ROLE_BASE_ADMIN_EVENT_WRITER', 0),
(51, 'ROLE_BASE_ADMIN_FDC_EVENT_ROUTES_ADMIN', 0),
(54, 'ROLE_BASE_ADMIN_FDC_EVENT_ROUTES_EDITOR', 0),
(53, 'ROLE_BASE_ADMIN_FDC_EVENT_ROUTES_LIST', 0),
(52, 'ROLE_BASE_ADMIN_FDC_EVENT_ROUTES_TRANSLATOR', 0),
(55, 'ROLE_BASE_ADMIN_FDC_EVENT_ROUTES_WRITER', 0),
(211, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_ADMIN', 0),
(214, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_EDITOR', 0),
(213, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_LIST', 0),
(216, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_OTHER_SELECTION_SECTIONS_ASSOCIATED_ADMIN', 0),
(219, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_OTHER_SELECTION_SECTIONS_ASSOCIATED_EDITOR', 0),
(218, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_OTHER_SELECTION_SECTIONS_ASSOCIATED_LIST', 0),
(217, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_OTHER_SELECTION_SECTIONS_ASSOCIATED_TRANSLATOR', 0),
(220, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_OTHER_SELECTION_SECTIONS_ASSOCIATED_WRITER', 0),
(212, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_TRANSLATOR', 0),
(215, 'ROLE_BASE_ADMIN_FDC_PAGE_AWARD_WRITER', 0),
(221, 'ROLE_BASE_ADMIN_FDC_PAGE_EVENT_ADMIN', 0),
(224, 'ROLE_BASE_ADMIN_FDC_PAGE_EVENT_EDITOR', 0),
(223, 'ROLE_BASE_ADMIN_FDC_PAGE_EVENT_LIST', 0),
(222, 'ROLE_BASE_ADMIN_FDC_PAGE_EVENT_TRANSLATOR', 0),
(225, 'ROLE_BASE_ADMIN_FDC_PAGE_EVENT_WRITER', 0),
(206, 'ROLE_BASE_ADMIN_FDC_PAGE_JURY_ADMIN', 0),
(209, 'ROLE_BASE_ADMIN_FDC_PAGE_JURY_EDITOR', 0),
(208, 'ROLE_BASE_ADMIN_FDC_PAGE_JURY_LIST', 0),
(207, 'ROLE_BASE_ADMIN_FDC_PAGE_JURY_TRANSLATOR', 0),
(210, 'ROLE_BASE_ADMIN_FDC_PAGE_JURY_WRITER', 0),
(196, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_ADMIN', 0),
(191, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_ADMIN', 0),
(194, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_EDITOR', 0),
(193, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_LIST', 0),
(192, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_TRANSLATOR', 0),
(726, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_AUDIO_DUMMY_ADMIN', 0),
(729, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_AUDIO_DUMMY_EDITOR', 0),
(728, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_AUDIO_DUMMY_LIST', 0),
(727, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_AUDIO_DUMMY_TRANSLATOR', 0),
(730, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_AUDIO_DUMMY_WRITER', 0),
(736, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_ADMIN', 0),
(739, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_EDITOR', 0),
(738, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_LIST', 0),
(737, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_TRANSLATOR', 0),
(740, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_WRITER', 0),
(731, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUMMY_ADMIN', 0),
(734, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUMMY_EDITOR', 0),
(733, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUMMY_LIST', 0),
(732, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUMMY_TRANSLATOR', 0),
(735, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_IMAGE_DUMMY_WRITER', 0),
(721, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_MOVIE_DUMMY_ADMIN', 0),
(724, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_MOVIE_DUMMY_EDITOR', 0),
(723, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_MOVIE_DUMMY_LIST', 0),
(722, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_MOVIE_DUMMY_TRANSLATOR', 0),
(725, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_MOVIE_DUMMY_WRITER', 0),
(741, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_QUOTE_DUMMY_ADMIN', 0),
(744, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_QUOTE_DUMMY_EDITOR', 0),
(743, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_QUOTE_DUMMY_LIST', 0),
(742, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_QUOTE_DUMMY_TRANSLATOR', 0),
(745, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_QUOTE_DUMMY_WRITER', 0),
(746, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_TEXT_DUMMY_ADMIN', 0),
(749, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_TEXT_DUMMY_EDITOR', 0),
(748, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_TEXT_DUMMY_LIST', 0),
(747, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_TEXT_DUMMY_TRANSLATOR', 0),
(750, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_TEXT_DUMMY_WRITER', 0),
(751, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_DUMMY_ADMIN', 0),
(754, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_DUMMY_EDITOR', 0),
(753, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_DUMMY_LIST', 0),
(752, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_DUMMY_TRANSLATOR', 0),
(755, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_DUMMY_WRITER', 0),
(756, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_YOUTUBE_DUMMY_ADMIN', 0),
(759, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_YOUTUBE_DUMMY_EDITOR', 0),
(758, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_YOUTUBE_DUMMY_LIST', 0),
(757, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_YOUTUBE_DUMMY_TRANSLATOR', 0),
(760, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WIDGET_VIDEO_YOUTUBE_DUMMY_WRITER', 0),
(195, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CANNES_CLASSICS_WRITER', 0),
(201, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CINEMA_PLAGE_ADMIN', 0),
(204, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CINEMA_PLAGE_EDITOR', 0),
(203, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CINEMA_PLAGE_LIST', 0),
(202, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CINEMA_PLAGE_TRANSLATOR', 0),
(205, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_CINEMA_PLAGE_WRITER', 0),
(199, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_EDITOR', 0),
(198, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_LIST', 0),
(197, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_TRANSLATOR', 0),
(200, 'ROLE_BASE_ADMIN_FDC_PAGE_LA_SELECTION_WRITER', 0),
(236, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_ARTICLES_ADMIN', 0),
(239, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_ARTICLES_EDITOR', 0),
(238, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_ARTICLES_LIST', 0),
(237, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_ARTICLES_TRANSLATOR', 0),
(240, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_ARTICLES_WRITER', 0),
(246, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_AUDIOS_ADMIN', 0),
(249, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_AUDIOS_EDITOR', 0),
(248, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_AUDIOS_LIST', 0),
(247, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_AUDIOS_TRANSLATOR', 0),
(250, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_AUDIOS_WRITER', 0),
(241, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_IMAGES_ADMIN', 0),
(244, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_IMAGES_EDITOR', 0),
(243, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_IMAGES_LIST', 0),
(242, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_IMAGES_TRANSLATOR', 0),
(245, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_IMAGES_WRITER', 0),
(251, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_VIDEOS_ADMIN', 0),
(254, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_VIDEOS_EDITOR', 0),
(253, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_VIDEOS_LIST', 0),
(252, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_VIDEOS_TRANSLATOR', 0),
(255, 'ROLE_BASE_ADMIN_FDC_PAGE_NEWS_VIDEOS_WRITER', 0),
(606, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_ADMIN', 0),
(609, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_EDITOR', 0),
(616, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_HAS_SECTION_ADMIN', 0),
(619, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_HAS_SECTION_EDITOR', 0),
(618, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_HAS_SECTION_LIST', 0),
(617, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_HAS_SECTION_TRANSLATOR', 0),
(620, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_HAS_SECTION_WRITER', 0),
(608, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_LIST', 0),
(611, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_ADMIN', 0),
(614, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_EDITOR', 0),
(613, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_LIST', 0),
(612, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_TRANSLATOR', 0),
(641, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFIVE_DUMMY_ADMIN', 0),
(644, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFIVE_DUMMY_EDITOR', 0),
(643, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFIVE_DUMMY_LIST', 0),
(642, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFIVE_DUMMY_TRANSLATOR', 0),
(645, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFIVE_DUMMY_WRITER', 0),
(636, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFOUR_DUMMY_ADMIN', 0),
(639, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFOUR_DUMMY_EDITOR', 0),
(638, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFOUR_DUMMY_LIST', 0),
(637, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFOUR_DUMMY_TRANSLATOR', 0),
(640, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEFOUR_DUMMY_WRITER', 0),
(621, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEONE_DUMMY_ADMIN', 0),
(624, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEONE_DUMMY_EDITOR', 0),
(623, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEONE_DUMMY_LIST', 0),
(622, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEONE_DUMMY_TRANSLATOR', 0),
(625, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPEONE_DUMMY_WRITER', 0),
(631, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETHREE_DUMMY_ADMIN', 0),
(634, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETHREE_DUMMY_EDITOR', 0),
(633, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETHREE_DUMMY_LIST', 0),
(632, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETHREE_DUMMY_TRANSLATOR', 0),
(635, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETHREE_DUMMY_WRITER', 0),
(626, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETWO_DUMMY_ADMIN', 0),
(629, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETWO_DUMMY_EDITOR', 0),
(628, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETWO_DUMMY_LIST', 0),
(627, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETWO_DUMMY_TRANSLATOR', 0),
(630, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WIDGET_TYPETWO_DUMMY_WRITER', 0),
(615, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_SECTION_WRITER', 0),
(607, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_TRANSLATOR', 0),
(610, 'ROLE_BASE_ADMIN_FDC_PAGE_PARTICIPATE_WRITER', 0),
(591, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_ADMIN', 0),
(594, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_EDITOR', 0),
(593, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_LIST', 0),
(592, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_TRANSLATOR', 0),
(601, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_COLUMN_DUMMY_ADMIN', 0),
(604, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_COLUMN_DUMMY_EDITOR', 0),
(603, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_COLUMN_DUMMY_LIST', 0),
(602, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_COLUMN_DUMMY_TRANSLATOR', 0),
(605, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_COLUMN_DUMMY_WRITER', 0),
(596, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_IMAGE_DUMMY_ADMIN', 0),
(599, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_IMAGE_DUMMY_EDITOR', 0),
(598, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_IMAGE_DUMMY_LIST', 0),
(597, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_IMAGE_DUMMY_TRANSLATOR', 0),
(600, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WIDGET_IMAGE_DUMMY_WRITER', 0),
(595, 'ROLE_BASE_ADMIN_FDC_PAGE_PREPARE_WRITER', 0),
(56, 'ROLE_BASE_ADMIN_FDC_PAGE_WAITING_ADMIN', 0),
(59, 'ROLE_BASE_ADMIN_FDC_PAGE_WAITING_EDITOR', 0),
(58, 'ROLE_BASE_ADMIN_FDC_PAGE_WAITING_LIST', 0),
(57, 'ROLE_BASE_ADMIN_FDC_PAGE_WAITING_TRANSLATOR', 0),
(60, 'ROLE_BASE_ADMIN_FDC_PAGE_WAITING_WRITER', 0),
(166, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_CHANNELS_ADMIN', 0),
(169, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_CHANNELS_EDITOR', 0),
(168, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_CHANNELS_LIST', 0),
(167, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_CHANNELS_TRANSLATOR', 0),
(170, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_CHANNELS_WRITER', 0),
(171, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_ADMIN', 0),
(174, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_EDITOR', 0),
(173, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_LIST', 0),
(181, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_MEDIA_VIDEO_ASSOCIATED_ADMIN', 0),
(184, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_MEDIA_VIDEO_ASSOCIATED_EDITOR', 0),
(183, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_MEDIA_VIDEO_ASSOCIATED_LIST', 0),
(182, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_MEDIA_VIDEO_ASSOCIATED_TRANSLATOR', 0),
(185, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_MEDIA_VIDEO_ASSOCIATED_WRITER', 0),
(172, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_TRANSLATOR', 0),
(176, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_WEB_TV_ASSOCIATED_ADMIN', 0),
(179, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_WEB_TV_ASSOCIATED_EDITOR', 0),
(178, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_WEB_TV_ASSOCIATED_LIST', 0),
(177, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_WEB_TV_ASSOCIATED_TRANSLATOR', 0),
(180, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_WEB_TV_ASSOCIATED_WRITER', 0),
(175, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_LIVE_WRITER', 0),
(186, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_TRAILERS_ADMIN', 0),
(189, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_TRAILERS_EDITOR', 0),
(188, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_TRAILERS_LIST', 0),
(187, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_TRAILERS_TRANSLATOR', 0),
(190, 'ROLE_BASE_ADMIN_FDC_PAGE_WEB_TV_TRAILERS_WRITER', 0),
(156, 'ROLE_BASE_ADMIN_FILM_ATELIER_ADMIN', 0),
(159, 'ROLE_BASE_ADMIN_FILM_ATELIER_EDITOR', 0),
(158, 'ROLE_BASE_ADMIN_FILM_ATELIER_LIST', 0),
(157, 'ROLE_BASE_ADMIN_FILM_ATELIER_TRANSLATOR', 0),
(160, 'ROLE_BASE_ADMIN_FILM_ATELIER_WRITER', 0),
(146, 'ROLE_BASE_ADMIN_FILM_FILM_ADMIN', 0),
(149, 'ROLE_BASE_ADMIN_FILM_FILM_EDITOR', 0),
(148, 'ROLE_BASE_ADMIN_FILM_FILM_LIST', 0),
(416, 'ROLE_BASE_ADMIN_FILM_FILM_MEDIA_ADMIN', 0),
(419, 'ROLE_BASE_ADMIN_FILM_FILM_MEDIA_EDITOR', 0),
(418, 'ROLE_BASE_ADMIN_FILM_FILM_MEDIA_LIST', 0),
(417, 'ROLE_BASE_ADMIN_FILM_FILM_MEDIA_TRANSLATOR', 0),
(420, 'ROLE_BASE_ADMIN_FILM_FILM_MEDIA_WRITER', 0),
(716, 'ROLE_BASE_ADMIN_FILM_FILM_TAG_ADMIN', 0),
(719, 'ROLE_BASE_ADMIN_FILM_FILM_TAG_EDITOR', 0),
(718, 'ROLE_BASE_ADMIN_FILM_FILM_TAG_LIST', 0),
(717, 'ROLE_BASE_ADMIN_FILM_FILM_TAG_TRANSLATOR', 0),
(720, 'ROLE_BASE_ADMIN_FILM_FILM_TAG_WRITER', 0),
(147, 'ROLE_BASE_ADMIN_FILM_FILM_TRANSLATOR', 0),
(150, 'ROLE_BASE_ADMIN_FILM_FILM_WRITER', 0),
(226, 'ROLE_BASE_ADMIN_FILM_JURY_TYPE_ADMIN', 0),
(229, 'ROLE_BASE_ADMIN_FILM_JURY_TYPE_EDITOR', 0),
(228, 'ROLE_BASE_ADMIN_FILM_JURY_TYPE_LIST', 0),
(227, 'ROLE_BASE_ADMIN_FILM_JURY_TYPE_TRANSLATOR', 0),
(230, 'ROLE_BASE_ADMIN_FILM_JURY_TYPE_WRITER', 0),
(421, 'ROLE_BASE_ADMIN_FILM_MEDIA_ADMIN', 0),
(424, 'ROLE_BASE_ADMIN_FILM_MEDIA_EDITOR', 0),
(423, 'ROLE_BASE_ADMIN_FILM_MEDIA_LIST', 0),
(422, 'ROLE_BASE_ADMIN_FILM_MEDIA_TRANSLATOR', 0),
(425, 'ROLE_BASE_ADMIN_FILM_MEDIA_WRITER', 0),
(161, 'ROLE_BASE_ADMIN_FILM_PERSON_ADMIN', 0),
(164, 'ROLE_BASE_ADMIN_FILM_PERSON_EDITOR', 0),
(163, 'ROLE_BASE_ADMIN_FILM_PERSON_LIST', 0),
(162, 'ROLE_BASE_ADMIN_FILM_PERSON_TRANSLATOR', 0),
(165, 'ROLE_BASE_ADMIN_FILM_PERSON_WRITER', 0),
(151, 'ROLE_BASE_ADMIN_FILM_PROJECTION_ADMIN', 0),
(154, 'ROLE_BASE_ADMIN_FILM_PROJECTION_EDITOR', 0),
(153, 'ROLE_BASE_ADMIN_FILM_PROJECTION_LIST', 0),
(152, 'ROLE_BASE_ADMIN_FILM_PROJECTION_TRANSLATOR', 0),
(155, 'ROLE_BASE_ADMIN_FILM_PROJECTION_WRITER', 0),
(231, 'ROLE_BASE_ADMIN_FILM_SELECTION_SECTION_ADMIN', 0),
(234, 'ROLE_BASE_ADMIN_FILM_SELECTION_SECTION_EDITOR', 0),
(233, 'ROLE_BASE_ADMIN_FILM_SELECTION_SECTION_LIST', 0),
(232, 'ROLE_BASE_ADMIN_FILM_SELECTION_SECTION_TRANSLATOR', 0),
(235, 'ROLE_BASE_ADMIN_FILM_SELECTION_SECTION_WRITER', 0),
(351, 'ROLE_BASE_ADMIN_GALLERY_ADMIN', 0),
(361, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_ADMIN', 0),
(364, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_EDITOR', 0),
(363, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_LIST', 0),
(366, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_MEDIA_ADMIN', 0),
(369, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_MEDIA_EDITOR', 0),
(368, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_MEDIA_LIST', 0),
(367, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_MEDIA_TRANSLATOR', 0),
(370, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_MEDIA_WRITER', 0),
(362, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_TRANSLATOR', 0),
(365, 'ROLE_BASE_ADMIN_GALLERY_DUAL_ALIGN_WRITER', 0),
(354, 'ROLE_BASE_ADMIN_GALLERY_EDITOR', 0),
(353, 'ROLE_BASE_ADMIN_GALLERY_LIST', 0),
(356, 'ROLE_BASE_ADMIN_GALLERY_MEDIA_ADMIN', 0),
(359, 'ROLE_BASE_ADMIN_GALLERY_MEDIA_EDITOR', 0),
(358, 'ROLE_BASE_ADMIN_GALLERY_MEDIA_LIST', 0),
(357, 'ROLE_BASE_ADMIN_GALLERY_MEDIA_TRANSLATOR', 0),
(360, 'ROLE_BASE_ADMIN_GALLERY_MEDIA_WRITER', 0),
(352, 'ROLE_BASE_ADMIN_GALLERY_TRANSLATOR', 0),
(355, 'ROLE_BASE_ADMIN_GALLERY_WRITER', 0),
(256, 'ROLE_BASE_ADMIN_HOMEPAGE_ADMIN', 0),
(259, 'ROLE_BASE_ADMIN_HOMEPAGE_EDITOR', 0),
(326, 'ROLE_BASE_ADMIN_HOMEPAGE_FILMS_ASSOCIATED_ADMIN', 0),
(329, 'ROLE_BASE_ADMIN_HOMEPAGE_FILMS_ASSOCIATED_EDITOR', 0),
(328, 'ROLE_BASE_ADMIN_HOMEPAGE_FILMS_ASSOCIATED_LIST', 0),
(327, 'ROLE_BASE_ADMIN_HOMEPAGE_FILMS_ASSOCIATED_TRANSLATOR', 0),
(330, 'ROLE_BASE_ADMIN_HOMEPAGE_FILMS_ASSOCIATED_WRITER', 0),
(258, 'ROLE_BASE_ADMIN_HOMEPAGE_LIST', 0),
(261, 'ROLE_BASE_ADMIN_HOMEPAGE_SLIDE_ADMIN', 0),
(264, 'ROLE_BASE_ADMIN_HOMEPAGE_SLIDE_EDITOR', 0),
(263, 'ROLE_BASE_ADMIN_HOMEPAGE_SLIDE_LIST', 0),
(262, 'ROLE_BASE_ADMIN_HOMEPAGE_SLIDE_TRANSLATOR', 0),
(265, 'ROLE_BASE_ADMIN_HOMEPAGE_SLIDE_WRITER', 0),
(371, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_VIDEOS_ASSOCIATED_ADMIN', 0),
(374, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_VIDEOS_ASSOCIATED_EDITOR', 0),
(373, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_VIDEOS_ASSOCIATED_LIST', 0),
(372, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_VIDEOS_ASSOCIATED_TRANSLATOR', 0),
(375, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_VIDEOS_ASSOCIATED_WRITER', 0),
(376, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_WEB_TVS_ASSOCIATED_ADMIN', 0),
(379, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_WEB_TVS_ASSOCIATED_EDITOR', 0),
(378, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_WEB_TVS_ASSOCIATED_LIST', 0),
(377, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_WEB_TVS_ASSOCIATED_TRANSLATOR', 0),
(380, 'ROLE_BASE_ADMIN_HOMEPAGE_TOP_WEB_TVS_ASSOCIATED_WRITER', 0),
(257, 'ROLE_BASE_ADMIN_HOMEPAGE_TRANSLATOR', 0),
(260, 'ROLE_BASE_ADMIN_HOMEPAGE_WRITER', 0),
(506, 'ROLE_BASE_ADMIN_INFO_ADMIN', 0),
(86, 'ROLE_BASE_ADMIN_INFO_ARTICLE_ADMIN', 0),
(89, 'ROLE_BASE_ADMIN_INFO_ARTICLE_EDITOR', 0),
(88, 'ROLE_BASE_ADMIN_INFO_ARTICLE_LIST', 0),
(87, 'ROLE_BASE_ADMIN_INFO_ARTICLE_TRANSLATOR', 0),
(90, 'ROLE_BASE_ADMIN_INFO_ARTICLE_WRITER', 0),
(101, 'ROLE_BASE_ADMIN_INFO_AUDIO_ADMIN', 0),
(104, 'ROLE_BASE_ADMIN_INFO_AUDIO_EDITOR', 0),
(103, 'ROLE_BASE_ADMIN_INFO_AUDIO_LIST', 0),
(102, 'ROLE_BASE_ADMIN_INFO_AUDIO_TRANSLATOR', 0),
(105, 'ROLE_BASE_ADMIN_INFO_AUDIO_WRITER', 0),
(509, 'ROLE_BASE_ADMIN_INFO_EDITOR', 0),
(526, 'ROLE_BASE_ADMIN_INFO_FILM_FILM_ASSOCIATED_ADMIN', 0),
(529, 'ROLE_BASE_ADMIN_INFO_FILM_FILM_ASSOCIATED_EDITOR', 0),
(528, 'ROLE_BASE_ADMIN_INFO_FILM_FILM_ASSOCIATED_LIST', 0),
(527, 'ROLE_BASE_ADMIN_INFO_FILM_FILM_ASSOCIATED_TRANSLATOR', 0),
(530, 'ROLE_BASE_ADMIN_INFO_FILM_FILM_ASSOCIATED_WRITER', 0),
(521, 'ROLE_BASE_ADMIN_INFO_FILM_PROJECTION_ASSOCIATED_ADMIN', 0),
(524, 'ROLE_BASE_ADMIN_INFO_FILM_PROJECTION_ASSOCIATED_EDITOR', 0),
(523, 'ROLE_BASE_ADMIN_INFO_FILM_PROJECTION_ASSOCIATED_LIST', 0),
(522, 'ROLE_BASE_ADMIN_INFO_FILM_PROJECTION_ASSOCIATED_TRANSLATOR', 0),
(525, 'ROLE_BASE_ADMIN_INFO_FILM_PROJECTION_ASSOCIATED_WRITER', 0),
(96, 'ROLE_BASE_ADMIN_INFO_IMAGE_ADMIN', 0),
(99, 'ROLE_BASE_ADMIN_INFO_IMAGE_EDITOR', 0),
(98, 'ROLE_BASE_ADMIN_INFO_IMAGE_LIST', 0),
(97, 'ROLE_BASE_ADMIN_INFO_IMAGE_TRANSLATOR', 0),
(100, 'ROLE_BASE_ADMIN_INFO_IMAGE_WRITER', 0),
(516, 'ROLE_BASE_ADMIN_INFO_INFO_ASSOCIATED_ADMIN', 0),
(519, 'ROLE_BASE_ADMIN_INFO_INFO_ASSOCIATED_EDITOR', 0),
(518, 'ROLE_BASE_ADMIN_INFO_INFO_ASSOCIATED_LIST', 0),
(517, 'ROLE_BASE_ADMIN_INFO_INFO_ASSOCIATED_TRANSLATOR', 0),
(520, 'ROLE_BASE_ADMIN_INFO_INFO_ASSOCIATED_WRITER', 0),
(508, 'ROLE_BASE_ADMIN_INFO_LIST', 0),
(511, 'ROLE_BASE_ADMIN_INFO_TAG_ADMIN', 0),
(514, 'ROLE_BASE_ADMIN_INFO_TAG_EDITOR', 0),
(513, 'ROLE_BASE_ADMIN_INFO_TAG_LIST', 0),
(512, 'ROLE_BASE_ADMIN_INFO_TAG_TRANSLATOR', 0),
(515, 'ROLE_BASE_ADMIN_INFO_TAG_WRITER', 0),
(507, 'ROLE_BASE_ADMIN_INFO_TRANSLATOR', 0),
(91, 'ROLE_BASE_ADMIN_INFO_VIDEO_ADMIN', 0),
(94, 'ROLE_BASE_ADMIN_INFO_VIDEO_EDITOR', 0),
(93, 'ROLE_BASE_ADMIN_INFO_VIDEO_LIST', 0),
(92, 'ROLE_BASE_ADMIN_INFO_VIDEO_TRANSLATOR', 0),
(95, 'ROLE_BASE_ADMIN_INFO_VIDEO_WRITER', 0),
(491, 'ROLE_BASE_ADMIN_INFO_WIDGET_AUDIO_DUMMY_ADMIN', 0),
(494, 'ROLE_BASE_ADMIN_INFO_WIDGET_AUDIO_DUMMY_EDITOR', 0),
(493, 'ROLE_BASE_ADMIN_INFO_WIDGET_AUDIO_DUMMY_LIST', 0),
(492, 'ROLE_BASE_ADMIN_INFO_WIDGET_AUDIO_DUMMY_TRANSLATOR', 0),
(495, 'ROLE_BASE_ADMIN_INFO_WIDGET_AUDIO_DUMMY_WRITER', 0),
(486, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_ADMIN', 0),
(489, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_EDITOR', 0),
(488, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_LIST', 0),
(487, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_TRANSLATOR', 0),
(490, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_WRITER', 0),
(481, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUMMY_ADMIN', 0),
(484, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUMMY_EDITOR', 0),
(483, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUMMY_LIST', 0),
(482, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUMMY_TRANSLATOR', 0),
(485, 'ROLE_BASE_ADMIN_INFO_WIDGET_IMAGE_DUMMY_WRITER', 0),
(496, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_DUMMY_ADMIN', 0),
(499, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_DUMMY_EDITOR', 0),
(498, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_DUMMY_LIST', 0),
(497, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_DUMMY_TRANSLATOR', 0),
(500, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_DUMMY_WRITER', 0),
(501, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_YOUTUBE_DUMMY_ADMIN', 0),
(504, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_YOUTUBE_DUMMY_EDITOR', 0),
(503, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_YOUTUBE_DUMMY_LIST', 0),
(502, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_YOUTUBE_DUMMY_TRANSLATOR', 0),
(505, 'ROLE_BASE_ADMIN_INFO_WIDGET_VIDEO_YOUTUBE_DUMMY_WRITER', 0),
(510, 'ROLE_BASE_ADMIN_INFO_WRITER', 0),
(346, 'ROLE_BASE_ADMIN_MEDIA_ADMIN', 0),
(136, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_ADMIN', 0),
(139, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_EDITOR', 0),
(411, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_FILM_FILM_ASSOCIATED_ADMIN', 0),
(414, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_FILM_FILM_ASSOCIATED_EDITOR', 0),
(413, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_FILM_FILM_ASSOCIATED_LIST', 0),
(412, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_FILM_FILM_ASSOCIATED_TRANSLATOR', 0),
(415, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_FILM_FILM_ASSOCIATED_WRITER', 0),
(138, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_LIST', 0),
(137, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_TRANSLATOR', 0),
(140, 'ROLE_BASE_ADMIN_MEDIA_AUDIO_WRITER', 0),
(349, 'ROLE_BASE_ADMIN_MEDIA_EDITOR', 0),
(711, 'ROLE_BASE_ADMIN_MEDIA_FILM_PROJECTION_ASSOCIATED_ADMIN', 0),
(714, 'ROLE_BASE_ADMIN_MEDIA_FILM_PROJECTION_ASSOCIATED_EDITOR', 0),
(713, 'ROLE_BASE_ADMIN_MEDIA_FILM_PROJECTION_ASSOCIATED_LIST', 0),
(712, 'ROLE_BASE_ADMIN_MEDIA_FILM_PROJECTION_ASSOCIATED_TRANSLATOR', 0),
(715, 'ROLE_BASE_ADMIN_MEDIA_FILM_PROJECTION_ASSOCIATED_WRITER', 0),
(126, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_ADMIN', 0),
(129, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_EDITOR', 0),
(128, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_LIST', 0),
(131, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_SIMPLE_ADMIN', 0),
(134, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_SIMPLE_EDITOR', 0),
(133, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_SIMPLE_LIST', 0),
(132, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_SIMPLE_TRANSLATOR', 0),
(135, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_SIMPLE_WRITER', 0),
(127, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_TRANSLATOR', 0),
(130, 'ROLE_BASE_ADMIN_MEDIA_IMAGE_WRITER', 0),
(348, 'ROLE_BASE_ADMIN_MEDIA_LIST', 0),
(341, 'ROLE_BASE_ADMIN_MEDIA_TAG_ADMIN', 0),
(344, 'ROLE_BASE_ADMIN_MEDIA_TAG_EDITOR', 0),
(343, 'ROLE_BASE_ADMIN_MEDIA_TAG_LIST', 0),
(342, 'ROLE_BASE_ADMIN_MEDIA_TAG_TRANSLATOR', 0),
(345, 'ROLE_BASE_ADMIN_MEDIA_TAG_WRITER', 0),
(347, 'ROLE_BASE_ADMIN_MEDIA_TRANSLATOR', 0),
(141, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_ADMIN', 0),
(144, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_EDITOR', 0),
(406, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_FILM_FILM_ASSOCIATED_ADMIN', 0),
(409, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_FILM_FILM_ASSOCIATED_EDITOR', 0),
(408, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_FILM_FILM_ASSOCIATED_LIST', 0),
(407, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_FILM_FILM_ASSOCIATED_TRANSLATOR', 0),
(410, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_FILM_FILM_ASSOCIATED_WRITER', 0),
(143, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_LIST', 0),
(142, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_TRANSLATOR', 0),
(145, 'ROLE_BASE_ADMIN_MEDIA_VIDEO_WRITER', 0),
(350, 'ROLE_BASE_ADMIN_MEDIA_WRITER', 0),
(381, 'ROLE_BASE_ADMIN_NEWS_ADMIN', 0),
(106, 'ROLE_BASE_ADMIN_NEWS_ARTICLE_ADMIN', 0),
(109, 'ROLE_BASE_ADMIN_NEWS_ARTICLE_EDITOR', 0),
(108, 'ROLE_BASE_ADMIN_NEWS_ARTICLE_LIST', 0),
(107, 'ROLE_BASE_ADMIN_NEWS_ARTICLE_TRANSLATOR', 0),
(110, 'ROLE_BASE_ADMIN_NEWS_ARTICLE_WRITER', 0),
(121, 'ROLE_BASE_ADMIN_NEWS_AUDIO_ADMIN', 0),
(124, 'ROLE_BASE_ADMIN_NEWS_AUDIO_EDITOR', 0),
(123, 'ROLE_BASE_ADMIN_NEWS_AUDIO_LIST', 0),
(122, 'ROLE_BASE_ADMIN_NEWS_AUDIO_TRANSLATOR', 0),
(125, 'ROLE_BASE_ADMIN_NEWS_AUDIO_WRITER', 0),
(384, 'ROLE_BASE_ADMIN_NEWS_EDITOR', 0),
(401, 'ROLE_BASE_ADMIN_NEWS_FILM_FILM_ASSOCIATED_ADMIN', 0),
(404, 'ROLE_BASE_ADMIN_NEWS_FILM_FILM_ASSOCIATED_EDITOR', 0),
(403, 'ROLE_BASE_ADMIN_NEWS_FILM_FILM_ASSOCIATED_LIST', 0),
(402, 'ROLE_BASE_ADMIN_NEWS_FILM_FILM_ASSOCIATED_TRANSLATOR', 0),
(405, 'ROLE_BASE_ADMIN_NEWS_FILM_FILM_ASSOCIATED_WRITER', 0),
(396, 'ROLE_BASE_ADMIN_NEWS_FILM_PROJECTION_ASSOCIATED_ADMIN', 0),
(399, 'ROLE_BASE_ADMIN_NEWS_FILM_PROJECTION_ASSOCIATED_EDITOR', 0),
(398, 'ROLE_BASE_ADMIN_NEWS_FILM_PROJECTION_ASSOCIATED_LIST', 0),
(397, 'ROLE_BASE_ADMIN_NEWS_FILM_PROJECTION_ASSOCIATED_TRANSLATOR', 0),
(400, 'ROLE_BASE_ADMIN_NEWS_FILM_PROJECTION_ASSOCIATED_WRITER', 0),
(116, 'ROLE_BASE_ADMIN_NEWS_IMAGE_ADMIN', 0),
(119, 'ROLE_BASE_ADMIN_NEWS_IMAGE_EDITOR', 0),
(118, 'ROLE_BASE_ADMIN_NEWS_IMAGE_LIST', 0),
(117, 'ROLE_BASE_ADMIN_NEWS_IMAGE_TRANSLATOR', 0),
(120, 'ROLE_BASE_ADMIN_NEWS_IMAGE_WRITER', 0),
(383, 'ROLE_BASE_ADMIN_NEWS_LIST', 0),
(391, 'ROLE_BASE_ADMIN_NEWS_NEWS_ASSOCIATED_ADMIN', 0),
(394, 'ROLE_BASE_ADMIN_NEWS_NEWS_ASSOCIATED_EDITOR', 0),
(393, 'ROLE_BASE_ADMIN_NEWS_NEWS_ASSOCIATED_LIST', 0),
(392, 'ROLE_BASE_ADMIN_NEWS_NEWS_ASSOCIATED_TRANSLATOR', 0),
(395, 'ROLE_BASE_ADMIN_NEWS_NEWS_ASSOCIATED_WRITER', 0),
(386, 'ROLE_BASE_ADMIN_NEWS_TAG_ADMIN', 0),
(389, 'ROLE_BASE_ADMIN_NEWS_TAG_EDITOR', 0),
(388, 'ROLE_BASE_ADMIN_NEWS_TAG_LIST', 0),
(387, 'ROLE_BASE_ADMIN_NEWS_TAG_TRANSLATOR', 0),
(390, 'ROLE_BASE_ADMIN_NEWS_TAG_WRITER', 0),
(382, 'ROLE_BASE_ADMIN_NEWS_TRANSLATOR', 0),
(111, 'ROLE_BASE_ADMIN_NEWS_VIDEO_ADMIN', 0),
(114, 'ROLE_BASE_ADMIN_NEWS_VIDEO_EDITOR', 0),
(113, 'ROLE_BASE_ADMIN_NEWS_VIDEO_LIST', 0),
(112, 'ROLE_BASE_ADMIN_NEWS_VIDEO_TRANSLATOR', 0),
(115, 'ROLE_BASE_ADMIN_NEWS_VIDEO_WRITER', 0),
(311, 'ROLE_BASE_ADMIN_NEWS_WIDGET_AUDIO_DUMMY_ADMIN', 0),
(314, 'ROLE_BASE_ADMIN_NEWS_WIDGET_AUDIO_DUMMY_EDITOR', 0),
(313, 'ROLE_BASE_ADMIN_NEWS_WIDGET_AUDIO_DUMMY_LIST', 0),
(312, 'ROLE_BASE_ADMIN_NEWS_WIDGET_AUDIO_DUMMY_TRANSLATOR', 0),
(315, 'ROLE_BASE_ADMIN_NEWS_WIDGET_AUDIO_DUMMY_WRITER', 0),
(321, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_ADMIN', 0),
(324, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_EDITOR', 0),
(323, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_LIST', 0),
(322, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_TRANSLATOR', 0),
(325, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_WRITER', 0),
(316, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUMMY_ADMIN', 0),
(319, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUMMY_EDITOR', 0),
(318, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUMMY_LIST', 0),
(317, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUMMY_TRANSLATOR', 0),
(320, 'ROLE_BASE_ADMIN_NEWS_WIDGET_IMAGE_DUMMY_WRITER', 0),
(331, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_DUMMY_ADMIN', 0),
(334, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_DUMMY_EDITOR', 0),
(333, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_DUMMY_LIST', 0),
(332, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_DUMMY_TRANSLATOR', 0),
(335, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_DUMMY_WRITER', 0),
(336, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_YOUTUBE_DUMMY_ADMIN', 0),
(339, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_YOUTUBE_DUMMY_EDITOR', 0),
(338, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_YOUTUBE_DUMMY_LIST', 0),
(337, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_YOUTUBE_DUMMY_TRANSLATOR', 0),
(340, 'ROLE_BASE_ADMIN_NEWS_WIDGET_VIDEO_YOUTUBE_DUMMY_WRITER', 0),
(385, 'ROLE_BASE_ADMIN_NEWS_WRITER', 0),
(561, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_ADMIN', 0),
(564, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_EDITOR', 0),
(566, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_HAS_PROCEDURE_ADMIN', 0),
(569, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_HAS_PROCEDURE_EDITOR', 0),
(568, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_HAS_PROCEDURE_LIST', 0),
(567, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_HAS_PROCEDURE_TRANSLATOR', 0),
(570, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_HAS_PROCEDURE_WRITER', 0),
(563, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_LIST', 0),
(571, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_PROCEDURE_ADMIN', 0),
(574, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_PROCEDURE_EDITOR', 0),
(573, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_PROCEDURE_LIST', 0),
(572, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_PROCEDURE_TRANSLATOR', 0),
(575, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_PROCEDURE_WRITER', 0),
(562, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_TRANSLATOR', 0),
(565, 'ROLE_BASE_ADMIN_PRESS_ACCREDIT_WRITER', 0),
(676, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_ADMIN', 0),
(679, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_EDITOR', 0),
(678, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_LIST', 0),
(681, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_ROOM_ADMIN', 0),
(684, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_ROOM_EDITOR', 0),
(683, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_ROOM_LIST', 0),
(682, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_ROOM_TRANSLATOR', 0),
(685, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_ROOM_WRITER', 0),
(677, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_TRANSLATOR', 0),
(680, 'ROLE_BASE_ADMIN_PRESS_CINEMA_MAP_WRITER', 0),
(671, 'ROLE_BASE_ADMIN_PRESS_CINEMA_ROOM_ADMIN', 0),
(674, 'ROLE_BASE_ADMIN_PRESS_CINEMA_ROOM_EDITOR', 0),
(673, 'ROLE_BASE_ADMIN_PRESS_CINEMA_ROOM_LIST', 0),
(672, 'ROLE_BASE_ADMIN_PRESS_CINEMA_ROOM_TRANSLATOR', 0),
(675, 'ROLE_BASE_ADMIN_PRESS_CINEMA_ROOM_WRITER', 0),
(651, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_ADMIN', 0),
(654, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_EDITOR', 0),
(661, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_HAS_SECTION_ADMIN', 0),
(664, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_HAS_SECTION_EDITOR', 0),
(663, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_HAS_SECTION_LIST', 0),
(662, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_HAS_SECTION_TRANSLATOR', 0),
(665, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_HAS_SECTION_WRITER', 0),
(653, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_LIST', 0),
(656, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_ADMIN', 0),
(659, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_EDITOR', 0),
(658, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_LIST', 0),
(657, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_TRANSLATOR', 0),
(701, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_ARCHIVE_DUMMY_ADMIN', 0),
(704, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_ARCHIVE_DUMMY_EDITOR', 0),
(703, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_ARCHIVE_DUMMY_LIST', 0),
(702, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_ARCHIVE_DUMMY_TRANSLATOR', 0),
(705, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_ARCHIVE_DUMMY_WRITER', 0),
(696, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_DOCUMENT_DUMMY_ADMIN', 0),
(699, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_DOCUMENT_DUMMY_EDITOR', 0),
(698, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_DOCUMENT_DUMMY_LIST', 0),
(697, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_DOCUMENT_DUMMY_TRANSLATOR', 0),
(700, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_DOCUMENT_DUMMY_WRITER', 0),
(706, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_FILE_DUMMY_ADMIN', 0),
(709, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_FILE_DUMMY_EDITOR', 0),
(708, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_FILE_DUMMY_LIST', 0),
(707, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_FILE_DUMMY_TRANSLATOR', 0),
(710, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_FILE_DUMMY_WRITER', 0),
(686, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_PHOTO_DUMMY_ADMIN', 0),
(689, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_PHOTO_DUMMY_EDITOR', 0),
(688, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_PHOTO_DUMMY_LIST', 0),
(687, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_PHOTO_DUMMY_TRANSLATOR', 0),
(690, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_PHOTO_DUMMY_WRITER', 0),
(691, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_VIDEO_DUMMY_ADMIN', 0),
(694, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_VIDEO_DUMMY_EDITOR', 0),
(693, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_VIDEO_DUMMY_LIST', 0),
(692, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_VIDEO_DUMMY_TRANSLATOR', 0),
(695, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WIDGET_VIDEO_DUMMY_WRITER', 0),
(660, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_SECTION_WRITER', 0),
(652, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_TRANSLATOR', 0),
(655, 'ROLE_BASE_ADMIN_PRESS_DOWNLOAD_WRITER', 0),
(576, 'ROLE_BASE_ADMIN_PRESS_GUIDE_ADMIN', 0),
(579, 'ROLE_BASE_ADMIN_PRESS_GUIDE_EDITOR', 0),
(578, 'ROLE_BASE_ADMIN_PRESS_GUIDE_LIST', 0),
(577, 'ROLE_BASE_ADMIN_PRESS_GUIDE_TRANSLATOR', 0),
(586, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_COLUMN_DUMMY_ADMIN', 0),
(589, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_COLUMN_DUMMY_EDITOR', 0),
(588, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_COLUMN_DUMMY_LIST', 0),
(587, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_COLUMN_DUMMY_TRANSLATOR', 0),
(590, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_COLUMN_DUMMY_WRITER', 0),
(581, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_IMAGE_DUMMY_ADMIN', 0),
(584, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_IMAGE_DUMMY_EDITOR', 0),
(583, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_IMAGE_DUMMY_LIST', 0),
(582, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_IMAGE_DUMMY_TRANSLATOR', 0),
(585, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WIDGET_IMAGE_DUMMY_WRITER', 0),
(580, 'ROLE_BASE_ADMIN_PRESS_GUIDE_WRITER', 0),
(541, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_ADMIN', 0),
(556, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_DOWNLOAD_ADMIN', 0),
(559, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_DOWNLOAD_EDITOR', 0),
(558, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_DOWNLOAD_LIST', 0),
(557, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_DOWNLOAD_TRANSLATOR', 0),
(560, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_DOWNLOAD_WRITER', 0),
(544, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_EDITOR', 0),
(543, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_LIST', 0),
(551, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_MEDIA_ADMIN', 0),
(554, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_MEDIA_EDITOR', 0),
(553, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_MEDIA_LIST', 0),
(552, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_MEDIA_TRANSLATOR', 0),
(555, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_MEDIA_WRITER', 0),
(546, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_SECTION_ADMIN', 0),
(549, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_SECTION_EDITOR', 0),
(548, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_SECTION_LIST', 0),
(547, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_SECTION_TRANSLATOR', 0),
(550, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_SECTION_WRITER', 0),
(542, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_TRANSLATOR', 0),
(545, 'ROLE_BASE_ADMIN_PRESS_HOMEPAGE_WRITER', 0),
(646, 'ROLE_BASE_ADMIN_PRESS_MEDIA_LIBRARY_ADMIN', 0),
(649, 'ROLE_BASE_ADMIN_PRESS_MEDIA_LIBRARY_EDITOR', 0),
(648, 'ROLE_BASE_ADMIN_PRESS_MEDIA_LIBRARY_LIST', 0),
(647, 'ROLE_BASE_ADMIN_PRESS_MEDIA_LIBRARY_TRANSLATOR', 0),
(650, 'ROLE_BASE_ADMIN_PRESS_MEDIA_LIBRARY_WRITER', 0),
(666, 'ROLE_BASE_ADMIN_PRESS_PROJECTION_ADMIN', 0),
(669, 'ROLE_BASE_ADMIN_PRESS_PROJECTION_EDITOR', 0),
(668, 'ROLE_BASE_ADMIN_PRESS_PROJECTION_LIST', 0),
(667, 'ROLE_BASE_ADMIN_PRESS_PROJECTION_TRANSLATOR', 0),
(670, 'ROLE_BASE_ADMIN_PRESS_PROJECTION_WRITER', 0),
(536, 'ROLE_BASE_ADMIN_PRESS_STATEMENT_INFO_ADMIN', 0),
(539, 'ROLE_BASE_ADMIN_PRESS_STATEMENT_INFO_EDITOR', 0),
(538, 'ROLE_BASE_ADMIN_PRESS_STATEMENT_INFO_LIST', 0),
(537, 'ROLE_BASE_ADMIN_PRESS_STATEMENT_INFO_TRANSLATOR', 0),
(540, 'ROLE_BASE_ADMIN_PRESS_STATEMENT_INFO_WRITER', 0),
(41, 'ROLE_BASE_ADMIN_SOCIAL_WALL_ADMIN', 0),
(44, 'ROLE_BASE_ADMIN_SOCIAL_WALL_EDITOR', 0),
(43, 'ROLE_BASE_ADMIN_SOCIAL_WALL_LIST', 0),
(42, 'ROLE_BASE_ADMIN_SOCIAL_WALL_TRANSLATOR', 0),
(45, 'ROLE_BASE_ADMIN_SOCIAL_WALL_WRITER', 0),
(441, 'ROLE_BASE_ADMIN_STATEMENT_ADMIN', 0),
(66, 'ROLE_BASE_ADMIN_STATEMENT_ARTICLE_ADMIN', 0),
(69, 'ROLE_BASE_ADMIN_STATEMENT_ARTICLE_EDITOR', 0),
(68, 'ROLE_BASE_ADMIN_STATEMENT_ARTICLE_LIST', 0),
(67, 'ROLE_BASE_ADMIN_STATEMENT_ARTICLE_TRANSLATOR', 0),
(70, 'ROLE_BASE_ADMIN_STATEMENT_ARTICLE_WRITER', 0),
(81, 'ROLE_BASE_ADMIN_STATEMENT_AUDIO_ADMIN', 0),
(84, 'ROLE_BASE_ADMIN_STATEMENT_AUDIO_EDITOR', 0),
(83, 'ROLE_BASE_ADMIN_STATEMENT_AUDIO_LIST', 0),
(82, 'ROLE_BASE_ADMIN_STATEMENT_AUDIO_TRANSLATOR', 0),
(85, 'ROLE_BASE_ADMIN_STATEMENT_AUDIO_WRITER', 0),
(444, 'ROLE_BASE_ADMIN_STATEMENT_EDITOR', 0),
(461, 'ROLE_BASE_ADMIN_STATEMENT_FILM_FILM_ASSOCIATED_ADMIN', 0),
(464, 'ROLE_BASE_ADMIN_STATEMENT_FILM_FILM_ASSOCIATED_EDITOR', 0),
(463, 'ROLE_BASE_ADMIN_STATEMENT_FILM_FILM_ASSOCIATED_LIST', 0),
(462, 'ROLE_BASE_ADMIN_STATEMENT_FILM_FILM_ASSOCIATED_TRANSLATOR', 0),
(465, 'ROLE_BASE_ADMIN_STATEMENT_FILM_FILM_ASSOCIATED_WRITER', 0),
(456, 'ROLE_BASE_ADMIN_STATEMENT_FILM_PROJECTION_ASSOCIATED_ADMIN', 0),
(459, 'ROLE_BASE_ADMIN_STATEMENT_FILM_PROJECTION_ASSOCIATED_EDITOR', 0),
(458, 'ROLE_BASE_ADMIN_STATEMENT_FILM_PROJECTION_ASSOCIATED_LIST', 0),
(457, 'ROLE_BASE_ADMIN_STATEMENT_FILM_PROJECTION_ASSOCIATED_TRANSLATOR', 0),
(460, 'ROLE_BASE_ADMIN_STATEMENT_FILM_PROJECTION_ASSOCIATED_WRITER', 0),
(76, 'ROLE_BASE_ADMIN_STATEMENT_IMAGE_ADMIN', 0),
(79, 'ROLE_BASE_ADMIN_STATEMENT_IMAGE_EDITOR', 0),
(78, 'ROLE_BASE_ADMIN_STATEMENT_IMAGE_LIST', 0),
(77, 'ROLE_BASE_ADMIN_STATEMENT_IMAGE_TRANSLATOR', 0),
(80, 'ROLE_BASE_ADMIN_STATEMENT_IMAGE_WRITER', 0),
(443, 'ROLE_BASE_ADMIN_STATEMENT_LIST', 0),
(451, 'ROLE_BASE_ADMIN_STATEMENT_STATEMENT_ASSOCIATED_ADMIN', 0),
(454, 'ROLE_BASE_ADMIN_STATEMENT_STATEMENT_ASSOCIATED_EDITOR', 0),
(453, 'ROLE_BASE_ADMIN_STATEMENT_STATEMENT_ASSOCIATED_LIST', 0),
(452, 'ROLE_BASE_ADMIN_STATEMENT_STATEMENT_ASSOCIATED_TRANSLATOR', 0),
(455, 'ROLE_BASE_ADMIN_STATEMENT_STATEMENT_ASSOCIATED_WRITER', 0),
(446, 'ROLE_BASE_ADMIN_STATEMENT_TAG_ADMIN', 0),
(449, 'ROLE_BASE_ADMIN_STATEMENT_TAG_EDITOR', 0),
(448, 'ROLE_BASE_ADMIN_STATEMENT_TAG_LIST', 0),
(447, 'ROLE_BASE_ADMIN_STATEMENT_TAG_TRANSLATOR', 0),
(450, 'ROLE_BASE_ADMIN_STATEMENT_TAG_WRITER', 0),
(442, 'ROLE_BASE_ADMIN_STATEMENT_TRANSLATOR', 0),
(71, 'ROLE_BASE_ADMIN_STATEMENT_VIDEO_ADMIN', 0),
(74, 'ROLE_BASE_ADMIN_STATEMENT_VIDEO_EDITOR', 0),
(73, 'ROLE_BASE_ADMIN_STATEMENT_VIDEO_LIST', 0),
(72, 'ROLE_BASE_ADMIN_STATEMENT_VIDEO_TRANSLATOR', 0),
(75, 'ROLE_BASE_ADMIN_STATEMENT_VIDEO_WRITER', 0),
(436, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_AUDIO_DUMMY_ADMIN', 0),
(439, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_AUDIO_DUMMY_EDITOR', 0),
(438, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_AUDIO_DUMMY_LIST', 0),
(437, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_AUDIO_DUMMY_TRANSLATOR', 0),
(440, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_AUDIO_DUMMY_WRITER', 0),
(431, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_ADMIN', 0),
(434, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_EDITOR', 0),
(433, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_LIST', 0),
(432, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_TRANSLATOR', 0),
(435, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUAL_ALIGN_DUMMY_WRITER', 0),
(426, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUMMY_ADMIN', 0),
(429, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUMMY_EDITOR', 0),
(428, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUMMY_LIST', 0),
(427, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUMMY_TRANSLATOR', 0),
(430, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_IMAGE_DUMMY_WRITER', 0),
(466, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_DUMMY_ADMIN', 0),
(469, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_DUMMY_EDITOR', 0),
(468, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_DUMMY_LIST', 0),
(467, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_DUMMY_TRANSLATOR', 0),
(470, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_DUMMY_WRITER', 0),
(471, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_YOUTUBE_DUMMY_ADMIN', 0),
(474, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_YOUTUBE_DUMMY_EDITOR', 0),
(473, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_YOUTUBE_DUMMY_LIST', 0),
(472, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_YOUTUBE_DUMMY_TRANSLATOR', 0),
(475, 'ROLE_BASE_ADMIN_STATEMENT_WIDGET_VIDEO_YOUTUBE_DUMMY_WRITER', 0),
(445, 'ROLE_BASE_ADMIN_STATEMENT_WRITER', 0),
(26, 'ROLE_BASE_ADMIN_TAG_ADMIN', 0),
(29, 'ROLE_BASE_ADMIN_TAG_EDITOR', 0),
(28, 'ROLE_BASE_ADMIN_TAG_LIST', 0),
(27, 'ROLE_BASE_ADMIN_TAG_TRANSLATOR', 0),
(30, 'ROLE_BASE_ADMIN_TAG_WRITER', 0),
(46, 'ROLE_BASE_ADMIN_THEME_ADMIN', 0),
(49, 'ROLE_BASE_ADMIN_THEME_EDITOR', 0),
(48, 'ROLE_BASE_ADMIN_THEME_LIST', 0),
(47, 'ROLE_BASE_ADMIN_THEME_TRANSLATOR', 0),
(50, 'ROLE_BASE_ADMIN_THEME_WRITER', 0),
(31, 'ROLE_BASE_ADMIN_WEB_TV_ADMIN', 0),
(34, 'ROLE_BASE_ADMIN_WEB_TV_EDITOR', 0),
(33, 'ROLE_BASE_ADMIN_WEB_TV_LIST', 0),
(32, 'ROLE_BASE_ADMIN_WEB_TV_TRANSLATOR', 0),
(35, 'ROLE_BASE_ADMIN_WEB_TV_WRITER', 0),
(766, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_ADMIN', 0),
(769, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_EDITOR', 0),
(771, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_FILM_FILM_ADMIN', 0),
(774, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_FILM_FILM_EDITOR', 0),
(773, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_FILM_FILM_LIST', 0),
(772, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_FILM_FILM_TRANSLATOR', 0),
(775, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_FILM_FILM_WRITER', 0),
(768, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_LIST', 0),
(767, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_TRANSLATOR', 0),
(770, 'ROLE_BASE_ADMIN_WIDGET_MOVIE_WRITER', 0),
(6, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_ADMIN', 0),
(9, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_EDITOR', 0),
(11, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_HAS_MEDIA_ADMIN', 0),
(14, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_HAS_MEDIA_EDITOR', 0),
(13, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_HAS_MEDIA_LIST', 0),
(12, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_HAS_MEDIA_TRANSLATOR', 0),
(15, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_HAS_MEDIA_WRITER', 0),
(8, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_LIST', 0),
(7, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_TRANSLATOR', 0),
(10, 'ROLE_SONATA_MEDIA_ADMIN_GALLERY_WRITER', 0),
(1, 'ROLE_SONATA_MEDIA_ADMIN_MEDIA_ADMIN', 0),
(4, 'ROLE_SONATA_MEDIA_ADMIN_MEDIA_EDITOR', 0),
(3, 'ROLE_SONATA_MEDIA_ADMIN_MEDIA_LIST', 0),
(2, 'ROLE_SONATA_MEDIA_ADMIN_MEDIA_TRANSLATOR', 0),
(5, 'ROLE_SONATA_MEDIA_ADMIN_MEDIA_WRITER', 0),
(21, 'ROLE_SONATA_USER_ADMIN_GROUP_ADMIN', 0),
(24, 'ROLE_SONATA_USER_ADMIN_GROUP_EDITOR', 0),
(23, 'ROLE_SONATA_USER_ADMIN_GROUP_LIST', 0),
(22, 'ROLE_SONATA_USER_ADMIN_GROUP_TRANSLATOR', 0),
(25, 'ROLE_SONATA_USER_ADMIN_GROUP_WRITER', 0),
(16, 'ROLE_SONATA_USER_ADMIN_USER_ADMIN', 0),
(19, 'ROLE_SONATA_USER_ADMIN_USER_EDITOR', 0),
(18, 'ROLE_SONATA_USER_ADMIN_USER_LIST', 0),
(17, 'ROLE_SONATA_USER_ADMIN_USER_TRANSLATOR', 0),
(20, 'ROLE_SONATA_USER_ADMIN_USER_WRITER', 0);

-- --------------------------------------------------------

--
-- Structure de la table `amazon_remote_file`
--

CREATE TABLE `amazon_remote_file` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cinef_person`
--

CREATE TABLE `cinef_person` (
  `id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reception_date` datetime DEFAULT NULL,
  `duration` decimal(5,2) DEFAULT NULL,
  `internet` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `selection` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio_film_vf` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio_film_va` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cinef_session`
--

CREATE TABLE `cinef_session` (
  `id` int(11) NOT NULL,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `season` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact_page`
--

CREATE TABLE `contact_page` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `contact_page`
--

INSERT INTO `contact_page` (`id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, '2016-02-12 12:38:26', '2016-02-12 12:38:26', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact_page_translation`
--

CREATE TABLE `contact_page_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_column` longtext COLLATE utf8_unicode_ci,
  `second_column` longtext COLLATE utf8_unicode_ci,
  `third_column` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `contact_page_translation`
--

INSERT INTO `contact_page_translation` (`id`, `locked_by_id`, `translatable_id`, `title`, `first_column`, `second_column`, `third_column`, `created_at`, `updated_at`, `status`, `locked_at`, `is_published_on_fdcevent`, `locale`) VALUES
(1, NULL, 1, 'Contactez-nous', NULL, NULL, NULL, '2016-02-12 12:38:26', '2016-03-08 12:57:36', 1, NULL, 0, 'fr'),
(2, NULL, 1, NULL, NULL, NULL, NULL, '2016-02-12 12:38:26', '2016-02-12 12:38:26', 0, NULL, 0, 'en'),
(3, NULL, 1, NULL, NULL, NULL, NULL, '2016-02-12 12:38:26', '2016-02-12 12:38:26', 0, NULL, 0, 'es'),
(4, NULL, 1, NULL, NULL, NULL, NULL, '2016-02-12 12:38:26', '2016-02-12 12:38:26', 0, NULL, 0, 'zh');

-- --------------------------------------------------------

--
-- Structure de la table `contact_theme`
--

CREATE TABLE `contact_theme` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact_theme_translation`
--

CREATE TABLE `contact_theme_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `country_translation`
--

CREATE TABLE `country_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `header_id` int(11) DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `displayed_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `publish_ended_at` datetime DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_film_projection_associated`
--

CREATE TABLE `event_film_projection_associated` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_site`
--

CREATE TABLE `event_site` (
  `event_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_translation`
--

CREATE TABLE `event_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget`
--

CREATE TABLE `event_widget` (
  `id` int(11) NOT NULL,
  `events_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_audio`
--

CREATE TABLE `event_widget_audio` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_image`
--

CREATE TABLE `event_widget_image` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_image_dual_align`
--

CREATE TABLE `event_widget_image_dual_align` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_quote`
--

CREATE TABLE `event_widget_quote` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_quote_translation`
--

CREATE TABLE `event_widget_quote_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_subtitle`
--

CREATE TABLE `event_widget_subtitle` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_subtitle_translation`
--

CREATE TABLE `event_widget_subtitle_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_text`
--

CREATE TABLE `event_widget_text` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_text_translation`
--

CREATE TABLE `event_widget_text_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_video`
--

CREATE TABLE `event_widget_video` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_video_youtube`
--

CREATE TABLE `event_widget_video_youtube` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_widget_video_youtube_translation`
--

CREATE TABLE `event_widget_video_youtube_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcevent_routes`
--

CREATE TABLE `fdcevent_routes` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `has_waiting_page` tinyint(1) NOT NULL,
  `site` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trans_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `lft` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcevent_routes`
--

INSERT INTO `fdcevent_routes` (`id`, `parent_id`, `route`, `has_waiting_page`, `site`, `type`, `name`, `trans_name`, `enabled`, `lft`, `lvl`, `rgt`, `root`, `hidden`, `slug`, `position`, `created_at`, `updated_at`) VALUES
(1, NULL, 'fdc_event_news_index', 0, 1, 1, 'L\'actualité', 'header.mainnav.nav.lactualite', 1, 1, 0, 12, 1, 0, 'fdc-event-news-index', 0, '2016-02-15 18:14:31', '2016-03-09 15:05:26'),
(2, NULL, 'fdc_event_television_live', 0, 1, 1, 'Web Tv', 'header.mainnav.nav.webtv', 1, 1, 0, 8, 2, 0, 'fdc-event-television-live', 1, '2016-02-15 18:16:32', '2016-03-01 23:07:44'),
(3, NULL, 'fdc_event_movie_selection', 0, 1, 1, 'La sélection', 'header.mainnav.nav.laselection', 1, 1, 0, 2, 3, 0, 'fdc-event-movie-selection-1', 2, '2016-02-15 18:16:33', '2016-03-01 23:07:46'),
(4, NULL, 'fdc_event_jury_get', 1, 1, 1, 'Les jurys', 'header.mainnav.nav.lesjurys', 1, 1, 0, 2, 4, 0, 'fdc-event-jury-get', 3, '2016-02-15 18:17:48', '2016-03-07 14:32:33'),
(5, NULL, 'fdc_event_palmares_get', 1, 1, 1, 'Le palmarès', 'header.mainnav.nav.lepalmares', 1, 1, 0, 2, 5, 0, 'fdc-event-palmares-get', 4, '2016-02-15 18:19:06', '2016-03-07 14:32:51'),
(6, NULL, 'fdc_event_event_getevents', 0, 1, 1, 'Les évènements', 'header.mainnav.nav.lesevenements', 1, 1, 0, 2, 6, 0, 'fdc-event-event-getevents', 5, '2016-02-15 18:19:29', '2016-03-02 14:13:15'),
(7, NULL, 'fdc_event_agenda_scheduling', 0, 1, 1, 'Programmation', 'header.mainnav.nav.programmation', 1, 1, 0, 8, 7, 0, 'fdc-event-agenda-scheduling', 6, '2016-02-15 18:19:43', '2016-03-09 15:10:18'),
(8, NULL, 'fdc_event_participate_prepare', 0, 1, 1, 'Participer', 'header.mainnav.nav.participer', 1, 1, 0, 12, 8, 0, 'fdc-event-participate-prepare', 7, '2016-02-15 18:19:55', '2016-03-01 23:07:59'),
(9, 1, 'fdc_event_news_index', 0, 1, 1, 'Jour après jour', 'header.mainnav.nav.jourapresjour', 1, 2, 1, 3, 1, 0, 'fdc-event-news-index/fdc-event-news-index-1', 0, '2016-02-15 18:20:42', '2016-03-01 23:11:32'),
(10, 1, 'fdc_event_news_getarticles', 0, 1, 1, 'Articles', 'header.mainnav.nav.articles', 1, 4, 1, 5, 1, 0, 'fdc-event-news-index/fdc-event-news-getarticles', 4, '2016-02-15 18:21:15', '2016-03-01 23:12:15'),
(11, 1, 'fdc_event_news_getphotos', 0, 1, 1, 'Photos', 'header.mainnav.nav.photos', 1, 6, 1, 7, 1, 0, 'fdc-event-news-index/fdc-event-news-getphotos', 2, '2016-02-16 15:51:34', '2016-03-01 23:12:28'),
(12, 1, 'fdc_event_news_getvideos', 0, 1, 1, 'Vidéos', 'header.mainnav.nav.videos', 1, 8, 1, 9, 1, 0, 'fdc-event-news-index/fdc-event-news-getvideos', 3, '2016-02-16 15:52:25', '2016-03-01 23:12:32'),
(13, 1, 'fdc_event_news_getaudios', 0, 1, 1, 'Audios', 'header.mainnav.nav.audios', 1, 10, 1, 11, 1, 0, 'fdc-event-news-index/fdc-event-news-getaudios', 1, '2016-02-16 15:53:11', '2016-03-01 23:12:35'),
(14, 2, 'fdc_event_television_live', 0, 1, 1, 'Direct', 'header.mainnav.nav.direct', 1, 2, 1, 3, 2, 0, 'fdc-event-television-live/fdc-event-television-live-1', 0, '2016-02-16 15:54:46', '2016-03-01 23:28:15'),
(15, 2, 'fdc_event_television_channels', 0, 1, 1, 'Chaines', 'header.mainnav.nav.chaines', 1, 4, 1, 5, 2, 0, 'fdc-event-television-live/fdc-event-television-channels', 1, '2016-02-16 15:55:23', '2016-03-01 23:28:17'),
(16, 2, 'fdc_event_television_trailers', 0, 1, 1, 'Bandes Annonces', 'header.mainnav.nav.bandesannonces', 1, 6, 1, 7, 2, 0, 'fdc-event-television-live/fdc-event-television-trailers', 2, '2016-02-16 15:57:05', '2016-03-01 23:28:18'),
(17, 7, 'fdc_event_agenda_scheduling', 0, 1, 1, 'Programmation', 'header.mainnav.nav.programmation', 1, 2, 1, 3, 7, 0, 'fdc-event-agenda-scheduling/fdc-event-agenda-scheduling-1', 0, '2016-02-16 15:57:46', '2016-03-01 23:29:28'),
(18, 7, 'fdc_event_agenda_get', 0, 1, 1, 'Agenda', 'header.mainnav.nav.agenda', 1, 4, 1, 5, 7, 0, 'fdc-event-agenda-scheduling/fdc-event-agenda-get', 1, '2016-02-16 15:58:09', '2016-03-01 23:29:28'),
(19, 7, 'fdc_event_agenda_room', 0, 1, 1, 'Plan des salles', 'header.mainnav.nav.plandessalles', 1, 6, 1, 7, 7, 0, 'fdc-event-agenda-scheduling/fdc-event-agenda-room', 2, '2016-02-16 15:58:40', '2016-03-01 23:29:30'),
(20, 8, 'fdc_event_participate_prepare', 0, 1, 1, 'Préparer son séjour', 'header.mainnav.nav.preparersejour', 1, 2, 1, 3, 8, 0, 'fdc-event-participate-prepare/fdc-event-participate-prepare-1', 0, '2016-02-16 15:59:46', '2016-03-01 23:30:25'),
(21, 8, 'fdc_event_participate_festival', 0, 1, 1, 'Festival mode d\'emploi', 'header.mainnav.nav.festivalmodeemploi', 1, 4, 1, 5, 8, 0, 'fdc-event-participate-prepare/fdc-event-participate-festival', 1, '2016-02-16 16:00:23', '2016-03-01 23:30:28'),
(22, 8, 'fdc_event_participate_access', 0, 1, 1, 'Accès aux projections', 'header.mainnav.nav.accesprojection', 1, 6, 1, 7, 8, 0, 'fdc-event-participate-prepare/fdc-event-participate-access', 2, '2016-02-16 16:01:13', '2016-03-01 23:30:31'),
(23, 8, 'fdc_event_participate_partners', 0, 1, 1, 'Partenaires', 'header.mainnav.nav.partenaires', 1, 8, 1, 9, 8, 0, 'fdc-event-participate-prepare/fdc-event-participate-partners', 3, '2016-02-16 16:01:47', '2016-03-01 23:30:33'),
(24, 8, 'fdc_event_participate_suppliers', 0, 1, 1, 'Fournisseurs', 'header.mainnav.nav.fournisseurs', 1, 10, 1, 11, 8, 0, 'fdc-event-participate-prepare/fdc-event-participate-suppliers', 4, '2016-02-16 16:02:16', '2016-03-01 23:30:35'),
(25, NULL, 'fdc_press_news_home', 0, 1, 1, 'Espace Presse', 'header.mainnav.nav.espacepresse', 1, 1, 0, 2, 25, 0, 'fdc-press-news-home', 8, '2016-03-03 18:34:14', '2016-03-09 15:10:26'),
(26, NULL, 'fdc_event_footer_contact', 0, 1, 2, 'Contact', 'footer.nav.contact', 1, 1, 0, 2, 26, 0, 'fdc-event-footer-contact', 0, '2016-03-09 15:49:03', '2016-03-09 15:49:03'),
(27, NULL, 'fdc_event_footer_static', 0, 1, 2, 'FAQ', 'footer.nav.faq', 1, 1, 0, 2, 27, 0, 'fdc-event-footer-static', 1, '2016-03-09 15:53:10', '2016-03-09 17:15:21'),
(28, NULL, 'fdc_event_footer_static', 0, 1, 2, 'Crédits', 'footer.nav.credit', 1, 1, 0, 2, 28, 0, 'fdc-event-footer-static-1', 2, '2016-03-09 15:53:55', '2016-03-09 15:53:55'),
(29, NULL, 'fdc_event_footer_static', 0, 1, 2, 'Mentions Légales', 'footer.nav.mentionslegales', 1, 1, 0, 2, 29, 0, 'fdc-event-footer-static-5', 3, '2016-03-09 15:54:30', '2016-03-09 17:25:58'),
(30, NULL, 'fdc_event_footer_static', 0, 1, 2, 'Nous rejoindre', 'footer.nav.nousrejoindre', 1, 1, 0, 2, 30, 0, 'fdc-event-footer-static-2', 4, '2016-03-09 15:55:07', '2016-03-09 15:55:07'),
(31, NULL, 'fdc_event_footer_static', 0, 1, 2, 'Plan du site', 'footer.nav.plandusite', 1, 1, 0, 2, 31, 0, 'fdc-event-footer-static-3', 5, '2016-03-09 15:58:41', '2016-03-09 17:15:47'),
(32, NULL, 'fdc_event_footer_static', 0, 1, 2, 'Politique de confidentialité', 'footer.nav.politiqueconfidentialite', 1, 1, 0, 2, 32, 0, 'fdc-event-footer-static-4', 7, '2016-03-09 17:17:35', '2016-03-09 17:17:35'),
(33, NULL, 'fdc_press_news_home', 0, 2, 1, 'Accueil', 'header.mainnav.nav.accueil', 1, 1, 0, 2, 33, 0, 'fdc-press-news-home-1', 0, '2016-03-09 17:46:40', '2016-03-09 17:46:40'),
(34, NULL, 'fdc_press_news_list', 0, 2, 1, 'Communiqués', 'header.mainnav.nav.communiques', 1, 1, 0, 2, 34, 0, 'fdc-press-news-list', 1, '2016-03-09 17:47:10', '2016-03-09 18:10:32'),
(35, NULL, 'fdc_press_accredit_main', 0, 2, 1, 'Accréditer', 'header.mainnav.nav.accrediter', 1, 1, 0, 2, 35, 0, 'fdc-press-accredit-main', 2, '2016-03-09 17:47:31', '2016-03-09 17:47:31'),
(36, NULL, 'fdc_press_guide_main', 0, 2, 1, 'Guide', 'header.mainnav.nav.guide', 1, 1, 0, 2, 36, 0, 'fdc-press-guide-main', -6, '2016-03-09 17:48:01', '2016-03-09 17:48:01'),
(37, NULL, 'fdc_press_agenda_scheduling', 0, 2, 1, 'Programmation', 'header.mainnav.nav.programmation', 1, 1, 0, 8, 37, 0, 'fdc-press-agenda-scheduling', 4, '2016-03-09 17:49:01', '2016-03-09 17:49:01'),
(38, 37, 'fdc_press_agenda_scheduling', 0, 2, 1, 'Programmation', 'header.mainnav.nav.programmation', 1, 2, 1, 3, 37, 0, 'fdc-press-agenda-scheduling/fdc-press-agenda-scheduling-1', 0, '2016-03-09 17:50:03', '2016-03-09 17:50:03'),
(39, 37, 'fdc_press_agenda_get', 0, 2, 1, 'Agenda', 'header.mainnav.nav.agenda', 1, 4, 1, 5, 37, 0, 'fdc-press-agenda-scheduling/fdc-press-agenda-get', 1, '2016-03-09 17:50:40', '2016-03-09 17:50:40'),
(40, 37, 'fdc_press_agenda_room', 0, 2, 1, 'Plan des salles', 'header.mainnav.nav.plandessalles', 1, 6, 1, 7, 37, 0, 'fdc-press-agenda-scheduling/fdc-press-agenda-room', 3, '2016-03-09 17:51:16', '2016-03-09 17:51:16'),
(41, NULL, 'fdc_press_media_main', 0, 2, 1, 'Médiathèque', 'header.mainnav.nav.mediatheque', 1, 1, 0, 2, 41, 0, 'fdc-press-media-main', 4, '2016-03-09 17:52:05', '2016-03-09 17:53:27'),
(42, NULL, 'fdc_press_media_download', 0, 2, 1, 'Télécharger', 'header.mainnav.nav.telecharger', 1, 1, 0, 2, 42, 0, 'fdc-press-media-download', 5, '2016-03-09 17:52:54', '2016-03-09 17:52:54');

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_award`
--

CREATE TABLE `fdcpage_award` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `selection_longs_metrages_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `selection_courts_metrages_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_award`
--

INSERT INTO `fdcpage_award` (`id`, `image_id`, `selection_longs_metrages_id`, `selection_courts_metrages_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, NULL, '2016-04-06 17:42:00', '2016-04-06 17:42:00', 0, 'a:0:{}', 1),
(2, NULL, NULL, NULL, NULL, '2016-04-06 17:42:20', '2016-04-06 17:42:20', 0, 'a:0:{}', 1),
(3, NULL, NULL, NULL, NULL, '2016-04-06 17:42:32', '2016-04-06 17:42:32', 0, 'a:0:{}', 1),
(4, NULL, NULL, NULL, NULL, '2016-04-06 17:42:47', '2016-04-06 17:42:47', 0, 'a:0:{}', 1),
(5, NULL, NULL, NULL, NULL, '2016-04-06 17:45:42', '2016-04-06 17:45:42', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_award_other_selection_sections_associated`
--

CREATE TABLE `fdcpage_award_other_selection_sections_associated` (
  `id` int(11) NOT NULL,
  `fdcpage_award_id` int(11) DEFAULT NULL,
  `association_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_award_translation`
--

CREATE TABLE `fdcpage_award_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_longs_metrages` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_courts_metrages` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_en_competition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_award_translation`
--

INSERT INTO `fdcpage_award_translation` (`id`, `locked_by_id`, `translatable_id`, `name`, `name_longs_metrages`, `name_courts_metrages`, `name_en_competition`, `header`, `slug`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:00', '2016-04-06 17:42:00', 'fr', 1, NULL, 0, NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:00', '2016-04-06 17:42:00', 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:00', '2016-04-06 17:42:00', 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:00', '2016-04-06 17:42:00', 'zh', 0, NULL, 0, NULL, NULL),
(5, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:20', '2016-04-06 17:42:20', 'fr', 1, NULL, 0, NULL, NULL),
(6, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:20', '2016-04-06 17:42:20', 'en', 0, NULL, 0, NULL, NULL),
(7, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:20', '2016-04-06 17:42:20', 'es', 0, NULL, 0, NULL, NULL),
(8, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:20', '2016-04-06 17:42:20', 'zh', 0, NULL, 0, NULL, NULL),
(9, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:32', '2016-04-06 17:42:32', 'fr', 1, NULL, 0, NULL, NULL),
(10, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:32', '2016-04-06 17:42:32', 'en', 0, NULL, 0, NULL, NULL),
(11, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:32', '2016-04-06 17:42:32', 'es', 0, NULL, 0, NULL, NULL),
(12, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:32', '2016-04-06 17:42:32', 'zh', 0, NULL, 0, NULL, NULL),
(13, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:47', '2016-04-06 17:42:47', 'fr', 1, NULL, 0, NULL, NULL),
(14, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:47', '2016-04-06 17:42:47', 'en', 0, NULL, 0, NULL, NULL),
(15, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:47', '2016-04-06 17:42:47', 'es', 0, NULL, 0, NULL, NULL),
(16, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:42:47', '2016-04-06 17:42:47', 'zh', 0, NULL, 0, NULL, NULL),
(17, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:45:42', '2016-04-06 17:45:42', 'fr', 1, NULL, 0, NULL, NULL),
(18, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:45:42', '2016-04-06 17:45:42', 'en', 0, NULL, 0, NULL, NULL),
(19, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:45:42', '2016-04-06 17:45:42', 'es', 0, NULL, 0, NULL, NULL),
(20, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 17:45:42', '2016-04-06 17:45:42', 'zh', 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_event`
--

CREATE TABLE `fdcpage_event` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_event`
--

INSERT INTO `fdcpage_event` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-04-06 15:24:24', '2016-04-06 15:24:24', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_event_translation`
--

CREATE TABLE `fdcpage_event_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_event_translation`
--

INSERT INTO `fdcpage_event_translation` (`id`, `locked_by_id`, `translatable_id`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, '2016-04-06 15:24:24', '2016-04-06 15:24:24', 'fr', 0, NULL, 0, NULL, NULL),
(2, NULL, 1, '2016-04-06 15:24:24', '2016-04-06 15:24:24', 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, '2016-04-06 15:24:24', '2016-04-06 15:24:24', 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, '2016-04-06 15:24:24', '2016-04-06 15:24:24', 'zh', 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_jury`
--

CREATE TABLE `fdcpage_jury` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `jury_type_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_jury`
--

INSERT INTO `fdcpage_jury` (`id`, `image_id`, `jury_type_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, '2016-04-06 17:40:29', '2016-04-06 17:40:29', 0, 'a:0:{}', 1),
(2, NULL, NULL, NULL, '2016-04-06 17:40:55', '2016-04-06 17:40:55', 0, 'a:0:{}', 1),
(3, NULL, NULL, NULL, '2016-04-06 17:41:20', '2016-04-06 17:41:20', 0, 'a:0:{}', 1),
(4, NULL, NULL, NULL, '2016-04-06 17:41:35', '2016-04-06 17:41:35', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_jury_translation`
--

CREATE TABLE `fdcpage_jury_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `override_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_jury_translation`
--

INSERT INTO `fdcpage_jury_translation` (`id`, `locked_by_id`, `translatable_id`, `override_name`, `slug`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, NULL, '2016-04-06 17:40:29', '2016-04-06 17:40:29', 'fr', 1, NULL, 0, NULL, NULL),
(2, NULL, 1, NULL, NULL, '2016-04-06 17:40:29', '2016-04-06 17:40:29', 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, NULL, NULL, '2016-04-06 17:40:29', '2016-04-06 17:40:29', 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, NULL, NULL, '2016-04-06 17:40:29', '2016-04-06 17:40:29', 'zh', 0, NULL, 0, NULL, NULL),
(5, NULL, 2, NULL, NULL, '2016-04-06 17:40:55', '2016-04-06 17:40:55', 'fr', 1, NULL, 0, NULL, NULL),
(6, NULL, 2, NULL, NULL, '2016-04-06 17:40:55', '2016-04-06 17:40:55', 'en', 0, NULL, 0, NULL, NULL),
(7, NULL, 2, NULL, NULL, '2016-04-06 17:40:55', '2016-04-06 17:40:55', 'es', 0, NULL, 0, NULL, NULL),
(8, NULL, 2, NULL, NULL, '2016-04-06 17:40:55', '2016-04-06 17:40:55', 'zh', 0, NULL, 0, NULL, NULL),
(9, NULL, 3, NULL, NULL, '2016-04-06 17:41:20', '2016-04-06 17:41:20', 'fr', 1, NULL, 0, NULL, NULL),
(10, NULL, 3, NULL, NULL, '2016-04-06 17:41:20', '2016-04-06 17:41:20', 'en', 0, NULL, 0, NULL, NULL),
(11, NULL, 3, NULL, NULL, '2016-04-06 17:41:20', '2016-04-06 17:41:20', 'es', 0, NULL, 0, NULL, NULL),
(12, NULL, 3, NULL, NULL, '2016-04-06 17:41:20', '2016-04-06 17:41:20', 'zh', 0, NULL, 0, NULL, NULL),
(13, NULL, 4, NULL, NULL, '2016-04-06 17:41:35', '2016-04-06 17:41:35', 'fr', 1, NULL, 0, NULL, NULL),
(14, NULL, 4, NULL, NULL, '2016-04-06 17:41:35', '2016-04-06 17:41:35', 'en', 0, NULL, 0, NULL, NULL),
(15, NULL, 4, NULL, NULL, '2016-04-06 17:41:35', '2016-04-06 17:41:35', 'es', 0, NULL, 0, NULL, NULL),
(16, NULL, 4, NULL, NULL, '2016-04-06 17:41:35', '2016-04-06 17:41:35', 'zh', 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection`
--

CREATE TABLE `fdcpage_la_selection` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `selection_section_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_la_selection`
--

INSERT INTO `fdcpage_la_selection` (`id`, `image_id`, `selection_section_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, '2016-03-10 15:03:43', '2016-03-10 15:03:43', 1, 'a:0:{}', 1),
(2, NULL, NULL, NULL, '2016-03-10 15:08:40', '2016-03-10 15:08:40', 0, 'a:0:{}', 1),
(3, NULL, NULL, NULL, '2016-03-10 15:13:23', '2016-03-10 15:13:23', 0, 'a:0:{}', 1),
(4, NULL, NULL, NULL, '2016-03-10 15:14:43', '2016-03-10 15:14:43', 0, 'a:0:{}', 1),
(5, NULL, NULL, NULL, '2016-03-10 15:15:43', '2016-03-10 15:15:43', 0, 'a:0:{}', 1),
(6, NULL, NULL, NULL, '2016-03-10 15:16:40', '2016-03-10 15:16:40', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_translation`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title_nav` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget` (
  `id` int(11) NOT NULL,
  `fdcpage_la_selection_cannes_classics_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_audio`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_audio` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_image`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_image` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_image_dual_align`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_image_dual_align` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_intro`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_intro` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_intro_translation`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_intro_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_movie`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_movie` (
  `id` int(11) NOT NULL,
  `widget_movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_quote`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_quote` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_quote_translation`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_quote_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_subtitle`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_subtitle` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_subtitle_translation`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_subtitle_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `subtitle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `paragraph` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_text`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_text` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_text_translation`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_text_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_video`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_video` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cannes_classics_widget_video_youtube`
--

CREATE TABLE `fdcpage_la_selection_cannes_classics_widget_video_youtube` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cinema_plage`
--

CREATE TABLE `fdcpage_la_selection_cinema_plage` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_la_selection_cinema_plage`
--

INSERT INTO `fdcpage_la_selection_cinema_plage` (`id`, `image_id`, `created_by_id`, `updated_by_id`, `seo_file_id`, `title`, `slug`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, NULL, 'Cinéma de la plage', 'cinema-de-la-plage', '2016-04-02 11:38:38', '2016-04-02 11:38:38', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_cinema_plage_translation`
--

CREATE TABLE `fdcpage_la_selection_cinema_plage_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_la_selection_cinema_plage_translation`
--

INSERT INTO `fdcpage_la_selection_cinema_plage_translation` (`id`, `locked_by_id`, `translatable_id`, `subtitle`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, '2016-04-02 11:38:38', '2016-04-02 11:42:59', 'fr', 1, '2016-04-02 11:42:59', 0, NULL, NULL),
(2, NULL, 1, NULL, '2016-04-02 11:38:38', '2016-04-02 11:42:59', 'en', 0, '2016-04-02 11:42:59', 0, NULL, NULL),
(3, NULL, 1, NULL, '2016-04-02 11:38:38', '2016-04-02 11:42:59', 'es', 0, '2016-04-02 11:42:59', 0, NULL, NULL),
(4, NULL, 1, NULL, '2016-04-02 11:38:38', '2016-04-02 11:42:59', 'zh', 0, '2016-04-02 11:42:59', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_la_selection_translation`
--

CREATE TABLE `fdcpage_la_selection_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `override_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_la_selection_translation`
--

INSERT INTO `fdcpage_la_selection_translation` (`id`, `locked_by_id`, `translatable_id`, `override_name`, `slug`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, 'Compétition', 'competition', '2016-03-10 15:03:43', '2016-03-10 15:03:43', 'fr', 0, NULL, 0, NULL, NULL),
(2, NULL, 1, NULL, NULL, '2016-03-10 15:03:43', '2016-03-10 15:03:43', 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, NULL, NULL, '2016-03-10 15:03:43', '2016-03-10 15:03:43', 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, NULL, NULL, '2016-03-10 15:03:43', '2016-03-10 15:03:43', 'zh', 0, NULL, 0, NULL, NULL),
(5, NULL, 2, 'Un Certain Regard', 'un-certain-regard', '2016-03-10 15:08:40', '2016-03-10 15:08:40', 'fr', 0, NULL, 0, NULL, NULL),
(6, NULL, 2, NULL, NULL, '2016-03-10 15:08:40', '2016-03-10 15:08:40', 'en', 0, NULL, 0, NULL, NULL),
(7, NULL, 2, NULL, NULL, '2016-03-10 15:08:40', '2016-03-10 15:08:40', 'es', 0, NULL, 0, NULL, NULL),
(8, NULL, 2, NULL, NULL, '2016-03-10 15:08:40', '2016-03-10 15:08:40', 'zh', 0, NULL, 0, NULL, NULL),
(9, NULL, 3, 'Hors Compétition', 'hors-competition', '2016-03-10 15:13:23', '2016-03-10 15:13:23', 'fr', 0, NULL, 0, NULL, NULL),
(10, NULL, 3, NULL, NULL, '2016-03-10 15:13:23', '2016-03-10 15:13:23', 'en', 0, NULL, 0, NULL, NULL),
(11, NULL, 3, NULL, NULL, '2016-03-10 15:13:23', '2016-03-10 15:13:23', 'es', 0, NULL, 0, NULL, NULL),
(12, NULL, 3, NULL, NULL, '2016-03-10 15:13:23', '2016-03-10 15:13:23', 'zh', 0, NULL, 0, NULL, NULL),
(13, NULL, 4, 'Séances spéciales', 'seances-speciales', '2016-03-10 15:14:43', '2016-03-10 15:14:43', 'fr', 0, NULL, 0, NULL, NULL),
(14, NULL, 4, NULL, NULL, '2016-03-10 15:14:43', '2016-03-10 15:14:43', 'en', 0, NULL, 0, NULL, NULL),
(15, NULL, 4, NULL, NULL, '2016-03-10 15:14:43', '2016-03-10 15:14:43', 'es', 0, NULL, 0, NULL, NULL),
(16, NULL, 4, NULL, NULL, '2016-03-10 15:14:43', '2016-03-10 15:14:43', 'zh', 0, NULL, 0, NULL, NULL),
(17, NULL, 5, 'Cinéfondation', 'cinefondation', '2016-03-10 15:15:43', '2016-03-10 15:15:43', 'fr', 0, NULL, 0, NULL, NULL),
(18, NULL, 5, NULL, NULL, '2016-03-10 15:15:43', '2016-03-10 15:15:43', 'en', 0, NULL, 0, NULL, NULL),
(19, NULL, 5, NULL, NULL, '2016-03-10 15:15:43', '2016-03-10 15:15:43', 'es', 0, NULL, 0, NULL, NULL),
(20, NULL, 5, NULL, NULL, '2016-03-10 15:15:43', '2016-03-10 15:15:43', 'zh', 0, NULL, 0, NULL, NULL),
(21, NULL, 6, 'Courts métrages', 'courts-metrages', '2016-03-10 15:16:40', '2016-03-10 15:16:40', 'fr', 0, NULL, 0, NULL, NULL),
(22, NULL, 6, NULL, NULL, '2016-03-10 15:16:40', '2016-03-10 15:16:40', 'en', 0, NULL, 0, NULL, NULL),
(23, NULL, 6, NULL, NULL, '2016-03-10 15:16:40', '2016-03-10 15:16:40', 'es', 0, NULL, 0, NULL, NULL),
(24, NULL, 6, NULL, NULL, '2016-03-10 15:16:40', '2016-03-10 15:16:40', 'zh', 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_news_articles`
--

CREATE TABLE `fdcpage_news_articles` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_news_articles`
--

INSERT INTO `fdcpage_news_articles` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-03-08 18:35:02', '2016-03-08 18:35:02', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_news_articles_translation`
--

CREATE TABLE `fdcpage_news_articles_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_news_audios`
--

CREATE TABLE `fdcpage_news_audios` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_news_audios`
--

INSERT INTO `fdcpage_news_audios` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-03-08 18:35:02', '2016-03-08 18:35:02', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_news_audios_translation`
--

CREATE TABLE `fdcpage_news_audios_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_news_images`
--

CREATE TABLE `fdcpage_news_images` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_news_images`
--

INSERT INTO `fdcpage_news_images` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-03-08 18:35:02', '2016-03-08 18:35:02', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_news_images_translation`
--

CREATE TABLE `fdcpage_news_images_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_news_videos`
--

CREATE TABLE `fdcpage_news_videos` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_news_videos`
--

INSERT INTO `fdcpage_news_videos` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-03-08 18:35:02', '2016-03-08 18:35:02', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_news_videos_translation`
--

CREATE TABLE `fdcpage_news_videos_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate`
--

CREATE TABLE `fdcpage_participate` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_has_section`
--

CREATE TABLE `fdcpage_participate_has_section` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `download_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section`
--

CREATE TABLE `fdcpage_participate_section` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_translation`
--

CREATE TABLE `fdcpage_participate_section_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget`
--

CREATE TABLE `fdcpage_participate_section_widget` (
  `id` int(11) NOT NULL,
  `press_download_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `locked_content` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typefive`
--

CREATE TABLE `fdcpage_participate_section_widget_typefive` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typefive_translation`
--

CREATE TABLE `fdcpage_participate_section_widget_typefive_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `one_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `one_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `one_description` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `two_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `two_description` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `three_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `three_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `three_description` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `four_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `four_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `four_description` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typefour`
--

CREATE TABLE `fdcpage_participate_section_widget_typefour` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typefour_translation`
--

CREATE TABLE `fdcpage_participate_section_widget_typefour_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typeone`
--

CREATE TABLE `fdcpage_participate_section_widget_typeone` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typeone_translation`
--

CREATE TABLE `fdcpage_participate_section_widget_typeone_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typethree`
--

CREATE TABLE `fdcpage_participate_section_widget_typethree` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typethree_translation`
--

CREATE TABLE `fdcpage_participate_section_widget_typethree_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typetwo`
--

CREATE TABLE `fdcpage_participate_section_widget_typetwo` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `sponsor_image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_section_widget_typetwo_translation`
--

CREATE TABLE `fdcpage_participate_section_widget_typetwo_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_participate_translation`
--

CREATE TABLE `fdcpage_participate_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare`
--

CREATE TABLE `fdcpage_prepare` (
  `id` int(11) NOT NULL,
  `main_image_id` int(11) DEFAULT NULL,
  `meeting_file_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `guide_main_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `guide_arrive_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `guide_meeting_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `guide_information_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `guide_service_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_prepare`
--

INSERT INTO `fdcpage_prepare` (`id`, `main_image_id`, `meeting_file_id`, `seo_file_id`, `guide_main_icon`, `guide_arrive_icon`, `guide_meeting_icon`, `guide_information_icon`, `guide_service_icon`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, 'icon_palme', 'icon_se-rendre-a-cannes', 'icon_se-rendre-a-cannes', 'icon_se-rendre-a-cannes', 'icon_se-rendre-a-cannes', '2016-04-06 17:43:35', '2016-04-06 17:43:35', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare_translation`
--

CREATE TABLE `fdcpage_prepare_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `guide_main_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_main_description` longtext COLLATE utf8_unicode_ci,
  `guide_arrive_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_meeting_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_information_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_information_description` longtext COLLATE utf8_unicode_ci,
  `guide_meeting_description` longtext COLLATE utf8_unicode_ci,
  `guide_meeting_label` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_meeting_url` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_service_description` longtext COLLATE utf8_unicode_ci,
  `guide_service_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_prepare_translation`
--

INSERT INTO `fdcpage_prepare_translation` (`id`, `locked_by_id`, `translatable_id`, `guide_main_title`, `guide_main_description`, `guide_arrive_title`, `guide_meeting_title`, `guide_information_title`, `guide_information_description`, `guide_meeting_description`, `guide_meeting_label`, `guide_meeting_url`, `guide_service_description`, `guide_service_title`, `status`, `locked_at`, `is_published_on_fdcevent`, `created_at`, `updated_at`, `locale`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2016-04-06 17:43:35', '2016-04-06 17:43:35', 'fr', NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-04-06 17:43:35', '2016-04-06 17:43:35', 'en', NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-04-06 17:43:35', '2016-04-06 17:43:35', 'es', NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-04-06 17:43:35', '2016-04-06 17:43:35', 'zh', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare_widget`
--

CREATE TABLE `fdcpage_prepare_widget` (
  `id` int(11) NOT NULL,
  `fdcpage_prepare_arrive_id` int(11) DEFAULT NULL,
  `fdcpage_prepare_meeting_id` int(11) DEFAULT NULL,
  `fdcpage_prepare_information_id` int(11) DEFAULT NULL,
  `fdcpage_prepare_service_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare_widget_column`
--

CREATE TABLE `fdcpage_prepare_widget_column` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare_widget_column_translation`
--

CREATE TABLE `fdcpage_prepare_widget_column_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare_widget_image`
--

CREATE TABLE `fdcpage_prepare_widget_image` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare_widget_image_translation`
--

CREATE TABLE `fdcpage_prepare_widget_image_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare_widget_picto`
--

CREATE TABLE `fdcpage_prepare_widget_picto` (
  `id` int(11) NOT NULL,
  `press_guide_widget_picto_icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_prepare_widget_picto_translation`
--

CREATE TABLE `fdcpage_prepare_widget_picto_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `press_guide_widget_picto_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `press_guide_widget_column_text` longtext COLLATE utf8_unicode_ci,
  `btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_waiting`
--

CREATE TABLE `fdcpage_waiting` (
  `id` int(11) NOT NULL,
  `banner_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_waiting_translation`
--

CREATE TABLE `fdcpage_waiting_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_web_tv_channels`
--

CREATE TABLE `fdcpage_web_tv_channels` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `sticky_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_web_tv_channels`
--

INSERT INTO `fdcpage_web_tv_channels` (`id`, `image_id`, `sticky_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, '2016-02-03 14:04:47', '2016-02-03 14:45:27', 0, 'N;', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_web_tv_channels_translation`
--

CREATE TABLE `fdcpage_web_tv_channels_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_web_tv_channels_translation`
--

INSERT INTO `fdcpage_web_tv_channels_translation` (`id`, `locked_by_id`, `translatable_id`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, '2016-02-03 14:04:47', '2016-02-03 14:33:46', 'fr', 1, NULL, 0, 'WebTV - Toutes les chaînes - Festival de Cannes 2016', 'Retrouvez toutes les chaînes de la webTV du Festival de Cannes 2016'),
(2, NULL, 1, '2016-02-03 14:04:47', '2016-02-03 14:04:47', 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, '2016-02-03 14:04:47', '2016-02-03 14:04:47', 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, '2016-02-03 14:04:47', '2016-02-03 14:04:47', 'zh', 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_web_tv_live`
--

CREATE TABLE `fdcpage_web_tv_live` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `live` int(11) DEFAULT NULL,
  `do_not_display_web_tv_area` tinyint(1) NOT NULL,
  `do_not_display_trailer_area` tinyint(1) NOT NULL,
  `do_not_display_last_videos_area` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_web_tv_live`
--

INSERT INTO `fdcpage_web_tv_live` (`id`, `image_id`, `seo_file_id`, `live`, `do_not_display_web_tv_area`, `do_not_display_trailer_area`, `do_not_display_last_videos_area`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, 0, 0, 0, 0, '2016-02-08 18:50:40', '2016-02-22 10:30:56', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_web_tv_live_media_video_associated`
--

CREATE TABLE `fdcpage_web_tv_live_media_video_associated` (
  `id` int(11) NOT NULL,
  `fdcpage_web_tv_live_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_web_tv_live_translation`
--

CREATE TABLE `fdcpage_web_tv_live_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_sub_head` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_sub_head` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direct_url` longtext COLLATE utf8_unicode_ci,
  `teaser_url` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fdcpage_web_tv_live_translation`
--

INSERT INTO `fdcpage_web_tv_live_translation` (`id`, `locked_by_id`, `translatable_id`, `title`, `first_sub_head`, `second_sub_head`, `direct_url`, `teaser_url`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, 'Live Festival', NULL, NULL, NULL, NULL, '2016-02-08 18:50:40', '2016-02-08 19:53:37', 'fr', 1, NULL, 0, NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2016-02-08 18:50:40', '2016-02-08 19:51:59', 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2016-02-08 18:50:40', '2016-02-08 18:50:40', 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2016-02-08 18:50:40', '2016-02-08 18:50:40', 'zh', 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_web_tv_live_web_tv_associated`
--

CREATE TABLE `fdcpage_web_tv_live_web_tv_associated` (
  `id` int(11) NOT NULL,
  `fdcpage_web_tv_live_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_web_tv_trailers`
--

CREATE TABLE `fdcpage_web_tv_trailers` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `selection_section_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdcpage_web_tv_trailers_translation`
--

CREATE TABLE `fdcpage_web_tv_trailers_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `override_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fdc_page_la_selection_cc_widget_video_yb_translation`
--

CREATE TABLE `fdc_page_la_selection_cc_widget_video_yb_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_address`
--

CREATE TABLE `film_address` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_address_translation`
--

CREATE TABLE `film_address_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier`
--

CREATE TABLE `film_atelier` (
  `id` int(11) NOT NULL,
  `selection_section_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `production_company_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_vo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `production_year` int(11) DEFAULT NULL,
  `budget_estimation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filming_date` datetime DEFAULT NULL,
  `filming_place` longtext COLLATE utf8_unicode_ci,
  `duration` decimal(22,2) DEFAULT NULL,
  `session_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `budget_acquired` longtext COLLATE utf8_unicode_ci,
  `cinando_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier_country`
--

CREATE TABLE `film_atelier_country` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier_language`
--

CREATE TABLE `film_atelier_language` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier_person`
--

CREATE TABLE `film_atelier_person` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier_person_function`
--

CREATE TABLE `film_atelier_person_function` (
  `id` int(11) NOT NULL,
  `function_id` int(11) DEFAULT NULL,
  `film_atelier_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier_production_company`
--

CREATE TABLE `film_atelier_production_company` (
  `id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier_production_company_address`
--

CREATE TABLE `film_atelier_production_company_address` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier_production_company_address_translation`
--

CREATE TABLE `film_atelier_production_company_address_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_atelier_translation`
--

CREATE TABLE `film_atelier_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `synopsis` longtext COLLATE utf8_unicode_ci,
  `applicant_note` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_award`
--

CREATE TABLE `film_award` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `prize_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `film_mutual` tinyint(1) DEFAULT NULL,
  `person_mutual` tinyint(1) DEFAULT NULL,
  `ex_aequo` tinyint(1) DEFAULT NULL,
  `unanimity` tinyint(1) DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_award_association`
--

CREATE TABLE `film_award_association` (
  `id` int(11) NOT NULL,
  `award_id` int(11) DEFAULT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_contact`
--

CREATE TABLE `film_contact` (
  `id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_contact_film_contact`
--

CREATE TABLE `film_contact_film_contact` (
  `film_contact_source` int(11) NOT NULL,
  `film_contact_target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_contact_person`
--

CREATE TABLE `film_contact_person` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_contact_person_film_contact_person`
--

CREATE TABLE `film_contact_person_film_contact_person` (
  `film_contact_person_source` int(11) NOT NULL,
  `film_contact_person_target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_event`
--

CREATE TABLE `film_event` (
  `id` int(11) NOT NULL,
  `event_type_id` int(11) DEFAULT NULL,
  `starts_at` datetime DEFAULT NULL,
  `festival_year` int(10) UNSIGNED NOT NULL,
  `title_vf` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_va` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `description_vf` longtext COLLATE utf8_unicode_ci,
  `description_va` longtext COLLATE utf8_unicode_ci,
  `description_vf2` longtext COLLATE utf8_unicode_ci,
  `description_va2` longtext COLLATE utf8_unicode_ci,
  `description_vf3` longtext COLLATE utf8_unicode_ci,
  `description_va3` longtext COLLATE utf8_unicode_ci,
  `description_vf4` longtext COLLATE utf8_unicode_ci,
  `description_va4` longtext COLLATE utf8_unicode_ci,
  `position` decimal(22,0) DEFAULT NULL,
  `internet` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_event_type`
--

CREATE TABLE `film_event_type` (
  `id` int(11) NOT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` decimal(22,0) DEFAULT NULL,
  `internet` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `program` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_festival`
--

CREATE TABLE `film_festival` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `festival_starts_at` datetime DEFAULT NULL,
  `festival_ends_at` datetime DEFAULT NULL,
  `marche_du_film_starts_at` datetime DEFAULT NULL,
  `marchedu_film_ends_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_festival_poster`
--

CREATE TABLE `film_festival_poster` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `soif_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_festival_poster_translation`
--

CREATE TABLE `film_festival_poster_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film`
--

CREATE TABLE `film_film` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `selection_id` int(11) DEFAULT NULL,
  `selection_section_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `image_main_id` int(11) DEFAULT NULL,
  `image_cover_id` int(11) DEFAULT NULL,
  `video_main_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `director_first` tinyint(1) NOT NULL,
  `restored` tinyint(1) NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `title_vo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_voalphabet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `production_year` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` decimal(22,2) NOT NULL,
  `casting_commentary` longtext COLLATE utf8_unicode_ci,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gala_id` int(11) DEFAULT NULL,
  `gala_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film_country`
--

CREATE TABLE `film_film_country` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film_film_contact`
--

CREATE TABLE `film_film_film_contact` (
  `film_film_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `film_contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film_media`
--

CREATE TABLE `film_film_media` (
  `id` int(11) NOT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_id` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film_person`
--

CREATE TABLE `film_film_person` (
  `id` int(11) NOT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film_person_function`
--

CREATE TABLE `film_film_person_function` (
  `id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `film_person_id` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film_person_translation`
--

CREATE TABLE `film_film_person_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film_tag`
--

CREATE TABLE `film_film_tag` (
  `id` int(11) NOT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_film_translation`
--

CREATE TABLE `film_film_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dialog` longtext COLLATE utf8_unicode_ci,
  `synopsis` longtext COLLATE utf8_unicode_ci,
  `info_restauration` longtext COLLATE utf8_unicode_ci,
  `program_section` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_function`
--

CREATE TABLE `film_function` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_function_translation`
--

CREATE TABLE `film_function_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_jury`
--

CREATE TABLE `film_jury` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `function_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_jury_function`
--

CREATE TABLE `film_jury_function` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_jury_function_translation`
--

CREATE TABLE `film_jury_function_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_jury_translation`
--

CREATE TABLE `film_jury_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `biography` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_jury_type`
--

CREATE TABLE `film_jury_type` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_jury_type_translation`
--

CREATE TABLE `film_jury_type_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_language`
--

CREATE TABLE `film_language` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_media`
--

CREATE TABLE `film_media` (
  `id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `jury_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `film_atelier_id` int(11) DEFAULT NULL,
  `cinef_person_id` int(11) DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note_vf` longtext COLLATE utf8_unicode_ci,
  `note_va` longtext COLLATE utf8_unicode_ci,
  `copyright` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credits` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `internet` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_vf` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_va` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_media_category`
--

CREATE TABLE `film_media_category` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_media_category_translation`
--

CREATE TABLE `film_media_category_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_minor_production`
--

CREATE TABLE `film_minor_production` (
  `id` int(11) NOT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_person`
--

CREATE TABLE `film_person` (
  `id` int(11) NOT NULL,
  `portrait_image_id` int(11) DEFAULT NULL,
  `landscape_image_id` int(11) DEFAULT NULL,
  `president_jury_image_id` int(11) DEFAULT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `nationality2_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `displayed_image` bigint(20) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asian_name` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_person_media`
--

CREATE TABLE `film_person_media` (
  `id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `media_id` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_person_translation`
--

CREATE TABLE `film_person_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` longtext COLLATE utf8_unicode_ci,
  `gender` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_prize`
--

CREATE TABLE `film_prize` (
  `id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_prize_translation`
--

CREATE TABLE `film_prize_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection`
--

CREATE TABLE `film_projection` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `programmation_section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `soif_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection_media`
--

CREATE TABLE `film_projection_media` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `projection_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection_programmation_dynamic`
--

CREATE TABLE `film_projection_programmation_dynamic` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `projection_id` int(11) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection_programmation_film`
--

CREATE TABLE `film_projection_programmation_film` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `projection_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection_programmation_film_list`
--

CREATE TABLE `film_projection_programmation_film_list` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `projection_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection_programmation_film_list_film_film`
--

CREATE TABLE `film_projection_programmation_film_list_film_film` (
  `film_projection_programmation_film_list_id` int(11) NOT NULL,
  `film_film_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection_programmation_type`
--

CREATE TABLE `film_projection_programmation_type` (
  `id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection_room`
--

CREATE TABLE `film_projection_room` (
  `id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_projection_translation`
--

CREATE TABLE `film_projection_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `program_section` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_selection`
--

CREATE TABLE `film_selection` (
  `id` int(11) NOT NULL,
  `code_signup` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_selection_section`
--

CREATE TABLE `film_selection_section` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `selection_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_selection_section_translation`
--

CREATE TABLE `film_selection_section_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_selection_subsection`
--

CREATE TABLE `film_selection_subsection` (
  `id` int(11) NOT NULL,
  `selection_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_selection_subsection_translation`
--

CREATE TABLE `film_selection_subsection_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user_group`
--

CREATE TABLE `fos_user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fos_user_group`
--

INSERT INTO `fos_user_group` (`id`, `name`, `roles`) VALUES
(2, 'Admin All', 'a:1:{i:0;s:14:"ROLE_ALL_ADMIN";}'),
(4, 'Admin FDC', 'a:1:{i:0;s:14:"ROLE_ADMIN_FDC";}'),
(6, 'Super Admin', 'a:3:{i:0;s:10:"ROLE_ADMIN";i:1;s:17:"ROLE_SONATA_ADMIN";i:2;s:16:"ROLE_SUPER_ADMIN";}'),
(7, 'Journaliste', 'a:1:{i:0;s:15:"ROLE_JOURNALIST";}'),
(8, 'Traducteur en chef', 'a:1:{i:0;s:22:"ROLE_TRANSLATOR_MASTER";}'),
(9, 'Traducteur FR', 'a:1:{i:0;s:18:"ROLE_TRANSLATOR_FR";}'),
(10, 'Traducteur EN', 'a:1:{i:0;s:18:"ROLE_TRANSLATOR_EN";}'),
(11, 'Traducteur CH', 'a:1:{i:0;s:18:"ROLE_TRANSLATOR_ZH";}'),
(12, 'Traducteur ES', 'a:1:{i:0;s:18:"ROLE_TRANSLATOR_ES";}'),
(13, 'Orange', 'a:1:{i:0;s:11:"ROLE_ORANGE";}'),
(14, 'Community manager', 'a:1:{i:0;s:22:"ROLE_COMMUNITY_MANAGER";}'),
(15, 'Contributeur vidéos / audio', 'a:1:{i:0;s:30:"ROLE_CONTRIBUTOR_VIDEOS_AUDIOS";}'),
(16, 'Contributeur photos', 'a:1:{i:0;s:23:"ROLE_CONTRIBUTOR_PHOTOS";}');

-- --------------------------------------------------------

--
-- Structure de la table `fos_user_user`
--

CREATE TABLE `fos_user_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `twitter_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `gplus_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_step_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fos_user_user`
--

INSERT INTO `fos_user_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `created_at`, `updated_at`, `date_of_birth`, `firstname`, `lastname`, `website`, `biography`, `gender`, `locale`, `timezone`, `phone`, `facebook_uid`, `facebook_name`, `facebook_data`, `twitter_uid`, `twitter_name`, `twitter_data`, `gplus_uid`, `gplus_name`, `gplus_data`, `token`, `two_step_code`) VALUES
(1, 'all-admin', 'all-admin', 'admin-all@yopmail.fr', 'admin-all@yopmail.fr', 1, 'g0ol672q9uogc8kggcwkgkssggscs80', '$2y$13$g0ol672q9uogc8kggcwkgeAgLChmsTTqSIpa8J1YY4rq0cKFsnlD2', '2016-04-06 17:27:16', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-04-06 15:22:00', '2016-04-06 17:27:16', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
(2, 'fdc-admin', 'fdc-admin', 'admin-fdc@yopmail.fr', 'admin-fdc@yopmail.fr', 1, 'or97ktdergg0wgkkwo80wwkkk0swc4w', '$2y$13$or97ktdergg0wgkkwo80wuJ43ZK4Y6YWXZI8HYwuIU8XAAs2jF3a2', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-04-06 15:22:01', '2016-04-06 15:22:01', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
(3, 'fdc-writer', 'fdc-writer', 'fdc-writer@yopmail.fr', 'fdc-writer@yopmail.fr', 1, 'i0bvot5xw288kw8osgoo8go4co8ks8s', '$2y$13$i0bvot5xw288kw8osgoo8efPWVz5FOQq0tUzbkLbBCc0VWuGJTYx2', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-04-06 15:22:01', '2016-04-06 15:22:01', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
(4, 'all-translator', 'all-translator', 'admin-translator@yopmail.fr', 'admin-translator@yopmail.fr', 1, 'rs4n0ncbosg448sc40swokkc8skokwc', '$2y$13$rs4n0ncbosg448sc40swoeQsl7cA4byggnmBPRHVil8kEjCGXB5EG', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-04-06 15:22:02', '2016-04-06 15:22:02', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
(5, 'press', 'press', 'press@yopmail.fr', 'press@yopmail.fr', 1, '7otdtnhoo9440gksc4ww84w0k0owwo0', '$2y$13$7otdtnhoo9440gksc4ww8uY0tjuaGcSb8ckoN66Wlxu/GDW1SRLRO', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:23:"ROLE_FDC_PRESS_REPORTER";}', 0, NULL, '2016-04-06 15:22:03', '2016-04-06 15:22:03', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user_user_group`
--

CREATE TABLE `fos_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fos_user_user_group`
--

INSERT INTO `fos_user_user_group` (`user_id`, `group_id`) VALUES
(1, 2),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gallery_dual_align`
--

CREATE TABLE `gallery_dual_align` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gallery_dual_align_media`
--

CREATE TABLE `gallery_dual_align_media` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gallery_media`
--

CREATE TABLE `gallery_media` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `pushs_main_image1_id` int(11) DEFAULT NULL,
  `pushs_main_image2_id` int(11) DEFAULT NULL,
  `pushs_main_image3_id` int(11) DEFAULT NULL,
  `pushs_secondary_image1_id` int(11) DEFAULT NULL,
  `pushs_secondary_image2_id` int(11) DEFAULT NULL,
  `pushs_secondary_image3_id` int(11) DEFAULT NULL,
  `pushs_secondary_image4_id` int(11) DEFAULT NULL,
  `pushs_secondary_image5_id` int(11) DEFAULT NULL,
  `pushs_secondary_image6_id` int(11) DEFAULT NULL,
  `pushs_secondary_image7_id` int(11) DEFAULT NULL,
  `pushs_secondary_image8_id` int(11) DEFAULT NULL,
  `prefooter_image1_id` int(11) DEFAULT NULL,
  `prefooter_image2_id` int(11) DEFAULT NULL,
  `prefooter_image3_id` int(11) DEFAULT NULL,
  `prefooter_image4_id` int(11) DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `top_news_type` int(11) DEFAULT NULL,
  `social_graph_hashtag_twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_wall_hashtags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayed_slider` tinyint(1) NOT NULL,
  `displayed_top_news` tinyint(1) NOT NULL,
  `displayed_social_wall` tinyint(1) NOT NULL,
  `displayed_top_videos` tinyint(1) NOT NULL,
  `displayed_top_web_tv` tinyint(1) NOT NULL,
  `displayed_films` tinyint(1) NOT NULL,
  `displayed_pushs_main` tinyint(1) NOT NULL,
  `displayed_pushs_secondary` tinyint(1) NOT NULL,
  `displayed_prefooters` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `homepage`
--

INSERT INTO `homepage` (`id`, `pushs_main_image1_id`, `pushs_main_image2_id`, `pushs_main_image3_id`, `pushs_secondary_image1_id`, `pushs_secondary_image2_id`, `pushs_secondary_image3_id`, `pushs_secondary_image4_id`, `pushs_secondary_image5_id`, `pushs_secondary_image6_id`, `pushs_secondary_image7_id`, `pushs_secondary_image8_id`, `prefooter_image1_id`, `prefooter_image2_id`, `prefooter_image3_id`, `prefooter_image4_id`, `festival_id`, `seo_file_id`, `top_news_type`, `social_graph_hashtag_twitter`, `social_wall_hashtags`, `displayed_slider`, `displayed_top_news`, `displayed_social_wall`, `displayed_top_videos`, `displayed_top_web_tv`, `displayed_films`, `displayed_pushs_main`, `displayed_pushs_secondary`, `displayed_prefooters`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-02-17 13:34:01', '2016-02-17 13:34:14');

-- --------------------------------------------------------

--
-- Structure de la table `homepage_films_associated`
--

CREATE TABLE `homepage_films_associated` (
  `id` int(11) NOT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `tablet_image_id` int(11) DEFAULT NULL,
  `mobile_image_id` int(11) DEFAULT NULL,
  `association_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `homepage_slide`
--

CREATE TABLE `homepage_slide` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `infos_id` int(11) DEFAULT NULL,
  `statement_id` int(11) DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `homepage_top_videos_associated`
--

CREATE TABLE `homepage_top_videos_associated` (
  `id` int(11) NOT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `homepage_top_web_tvs_associated`
--

CREATE TABLE `homepage_top_web_tvs_associated` (
  `id` int(11) NOT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `homepage_translation`
--

CREATE TABLE `homepage_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `primary_push_title1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_push_title2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_push_title3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_title1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_title2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_title3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_title4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_title5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_title6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_title7` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_title8` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_push_url1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_push_url2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_push_url3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_url1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_url2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_url3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_url4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_url5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_url6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_url7` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_push_url8` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefooter_title1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefooter_title2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefooter_title3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefooter_title4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefooter_url1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefooter_url2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefooter_url3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefooter_url4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `associated_film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `associated_event_id` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `displayed_home` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `publish_ended_at` datetime DEFAULT NULL,
  `hide_same_day` tinyint(1) NOT NULL DEFAULT '0',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_article`
--

CREATE TABLE `info_article` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_article_translation`
--

CREATE TABLE `info_article_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_audio`
--

CREATE TABLE `info_audio` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL,
  `audio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_audio_translation`
--

CREATE TABLE `info_audio_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_film_film_associated`
--

CREATE TABLE `info_film_film_associated` (
  `id` int(11) NOT NULL,
  `info_id` int(11) DEFAULT NULL,
  `association_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_film_projection_associated`
--

CREATE TABLE `info_film_projection_associated` (
  `id` int(11) NOT NULL,
  `info_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_image`
--

CREATE TABLE `info_image` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_image_translation`
--

CREATE TABLE `info_image_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_info_associated`
--

CREATE TABLE `info_info_associated` (
  `id` int(11) NOT NULL,
  `info_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_site`
--

CREATE TABLE `info_site` (
  `info_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_tag`
--

CREATE TABLE `info_tag` (
  `id` int(11) NOT NULL,
  `info_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_video`
--

CREATE TABLE `info_video` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_video_translation`
--

CREATE TABLE `info_video_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget`
--

CREATE TABLE `info_widget` (
  `id` int(11) NOT NULL,
  `info_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_audio`
--

CREATE TABLE `info_widget_audio` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_image`
--

CREATE TABLE `info_widget_image` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_image_dual_align`
--

CREATE TABLE `info_widget_image_dual_align` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_quote`
--

CREATE TABLE `info_widget_quote` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_quote_translation`
--

CREATE TABLE `info_widget_quote_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_text`
--

CREATE TABLE `info_widget_text` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_text_translation`
--

CREATE TABLE `info_widget_text_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_video`
--

CREATE TABLE `info_widget_video` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_video_youtube`
--

CREATE TABLE `info_widget_video_youtube` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_widget_video_youtube_translation`
--

CREATE TABLE `info_widget_video_youtube_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `associated_film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `associated_event_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `publish_ended_at` datetime DEFAULT NULL,
  `displayed_all` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_home` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_audio`
--

CREATE TABLE `media_audio` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `homepage_news_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_audio_film_film_associated`
--

CREATE TABLE `media_audio_film_film_associated` (
  `id` int(11) NOT NULL,
  `media_audio_id` int(11) DEFAULT NULL,
  `association_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_audio_translation`
--

CREATE TABLE `media_audio_translation` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_mp3state` int(11) DEFAULT '0',
  `job_mp3id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mp3url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_film_projection_associated`
--

CREATE TABLE `media_film_projection_associated` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_image`
--

CREATE TABLE `media_image` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_image_simple`
--

CREATE TABLE `media_image_simple` (
  `id` int(11) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_image_simple_site`
--

CREATE TABLE `media_image_simple_site` (
  `media_image_simple_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_image_simple_translation`
--

CREATE TABLE `media_image_simple_translation` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_image_simple_translation_site`
--

CREATE TABLE `media_image_simple_translation_site` (
  `media_image_simple_translation_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_image_translation`
--

CREATE TABLE `media_image_translation` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `legend` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_image_translation_site`
--

CREATE TABLE `media_image_translation_site` (
  `media_image_translation_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_site`
--

CREATE TABLE `media_site` (
  `media_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_tag`
--

CREATE TABLE `media_tag` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_video`
--

CREATE TABLE `media_video` (
  `id` int(11) NOT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `web_tv_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `homepage_news_id` int(11) DEFAULT NULL,
  `displayed_web_tv` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_trailer` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_video_film_film_associated`
--

CREATE TABLE `media_video_film_film_associated` (
  `id` int(11) NOT NULL,
  `media_video_id` int(11) DEFAULT NULL,
  `association_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_video_translation`
--

CREATE TABLE `media_video_translation` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `amazon_remote_file_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_amazon_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_webm_state` int(11) DEFAULT '0',
  `job_mp4state` int(11) DEFAULT '0',
  `job_mp4id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_webm_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mp4url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `webm_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media__gallery`
--

CREATE TABLE `media__gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `default_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media__gallery_media`
--

CREATE TABLE `media__gallery_media` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media__media`
--

CREATE TABLE `media__media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_metadata` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_size` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) DEFAULT NULL,
  `cdn_flush_at` datetime DEFAULT NULL,
  `cdn_status` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `soif_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `associated_film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `associated_event_id` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `homepage_media_audio_id` int(11) DEFAULT NULL,
  `homepage_media_video_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `hide_same_day` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_home` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `publish_ended_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_article`
--

CREATE TABLE `news_article` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_article_translation`
--

CREATE TABLE `news_article_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_audio`
--

CREATE TABLE `news_audio` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL,
  `audio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_audio_translation`
--

CREATE TABLE `news_audio_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_film_film_associated`
--

CREATE TABLE `news_film_film_associated` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `association_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_film_projection_associated`
--

CREATE TABLE `news_film_projection_associated` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_image`
--

CREATE TABLE `news_image` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_image_translation`
--

CREATE TABLE `news_image_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_news_associated`
--

CREATE TABLE `news_news_associated` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_site`
--

CREATE TABLE `news_site` (
  `news_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_tag`
--

CREATE TABLE `news_tag` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_video`
--

CREATE TABLE `news_video` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_video_translation`
--

CREATE TABLE `news_video_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget`
--

CREATE TABLE `news_widget` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_audio`
--

CREATE TABLE `news_widget_audio` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_image`
--

CREATE TABLE `news_widget_image` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_image_dual_align`
--

CREATE TABLE `news_widget_image_dual_align` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_quote`
--

CREATE TABLE `news_widget_quote` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_quote_translation`
--

CREATE TABLE `news_widget_quote_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_text`
--

CREATE TABLE `news_widget_text` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_text_translation`
--

CREATE TABLE `news_widget_text_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_video`
--

CREATE TABLE `news_widget_video` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_video_youtube`
--

CREATE TABLE `news_widget_video_youtube` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news_widget_video_youtube_translation`
--

CREATE TABLE `news_widget_video_youtube_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prefooter`
--

CREATE TABLE `prefooter` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `homepage_translation_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_accredit`
--

CREATE TABLE `press_accredit` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_accredit`
--

INSERT INTO `press_accredit` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-04-06 17:37:27', '2016-04-06 17:37:27', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `press_accredit_has_procedure`
--

CREATE TABLE `press_accredit_has_procedure` (
  `id` int(11) NOT NULL,
  `procedure_id` int(11) DEFAULT NULL,
  `accredit_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_accredit_procedure`
--

CREATE TABLE `press_accredit_procedure` (
  `id` int(11) NOT NULL,
  `procedure_file_id` int(11) DEFAULT NULL,
  `procedure_second_file_id` int(11) DEFAULT NULL,
  `procedure_link` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_accredit_procedure_translation`
--

CREATE TABLE `press_accredit_procedure_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedure_content` longtext COLLATE utf8_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_accredit_translation`
--

CREATE TABLE `press_accredit_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `common_content` longtext COLLATE utf8_unicode_ci,
  `btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btn_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btn_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_accredit_translation`
--

INSERT INTO `press_accredit_translation` (`id`, `locked_by_id`, `translatable_id`, `common_content`, `btn_label`, `btn_link`, `btn_text`, `created_at`, `updated_at`, `status`, `locked_at`, `is_published_on_fdcevent`, `locale`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, '2016-04-06 17:37:27', '2016-04-06 17:37:27', 1, NULL, 0, 'fr', NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, '2016-04-06 17:37:27', '2016-04-06 17:37:27', 0, NULL, 0, 'en', NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, '2016-04-06 17:37:27', '2016-04-06 17:37:27', 0, NULL, 0, 'es', NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, '2016-04-06 17:37:27', '2016-04-06 17:37:27', 0, NULL, 0, 'zh', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `press_cinema_map`
--

CREATE TABLE `press_cinema_map` (
  `id` int(11) NOT NULL,
  `default_room_image_id` int(11) DEFAULT NULL,
  `default_zone_image_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_cinema_map`
--

INSERT INTO `press_cinema_map` (`id`, `default_room_image_id`, `default_zone_image_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, '2016-04-06 17:37:55', '2016-04-06 17:37:55', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `press_cinema_map_room`
--

CREATE TABLE `press_cinema_map_room` (
  `id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `room_map_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_cinema_map_translation`
--

CREATE TABLE `press_cinema_map_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `cinema_map_zone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_cinema_map_translation`
--

INSERT INTO `press_cinema_map_translation` (`id`, `locked_by_id`, `translatable_id`, `cinema_map_zone`, `created_at`, `updated_at`, `status`, `locked_at`, `is_published_on_fdcevent`, `locale`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, '2016-04-06 17:37:55', '2016-04-06 17:37:55', 1, NULL, 0, 'fr', NULL, NULL),
(2, NULL, 1, NULL, '2016-04-06 17:37:55', '2016-04-06 17:37:55', 0, NULL, 0, 'en', NULL, NULL),
(3, NULL, 1, NULL, '2016-04-06 17:37:55', '2016-04-06 17:37:55', 0, NULL, 0, 'es', NULL, NULL),
(4, NULL, 1, NULL, '2016-04-06 17:37:55', '2016-04-06 17:37:55', 0, NULL, 0, 'zh', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `press_cinema_room`
--

CREATE TABLE `press_cinema_room` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `zone_image_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_cinema_room_translation`
--

CREATE TABLE `press_cinema_room_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `cinema_room_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download`
--

CREATE TABLE `press_download` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_download`
--

INSERT INTO `press_download` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-04-06 17:36:12', '2016-04-06 17:36:12', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `press_download_has_section`
--

CREATE TABLE `press_download_has_section` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `download_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section`
--

CREATE TABLE `press_download_section` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_translation`
--

CREATE TABLE `press_download_section_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget`
--

CREATE TABLE `press_download_section_widget` (
  `id` int(11) NOT NULL,
  `press_download_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `locked_content` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_archive`
--

CREATE TABLE `press_download_section_widget_archive` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_archive_translation`
--

CREATE TABLE `press_download_section_widget_archive_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_document`
--

CREATE TABLE `press_download_section_widget_document` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `second_file_id` int(11) DEFAULT NULL,
  `third_file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_document_translation`
--

CREATE TABLE `press_download_section_widget_document_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `third_btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_file`
--

CREATE TABLE `press_download_section_widget_file` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `second_file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_file_translation`
--

CREATE TABLE `press_download_section_widget_file_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_photo`
--

CREATE TABLE `press_download_section_widget_photo` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_video`
--

CREATE TABLE `press_download_section_widget_video` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `second_file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_section_widget_video_translation`
--

CREATE TABLE `press_download_section_widget_video_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_btn_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_download_translation`
--

CREATE TABLE `press_download_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_download_translation`
--

INSERT INTO `press_download_translation` (`id`, `locked_by_id`, `translatable_id`, `created_at`, `updated_at`, `status`, `locked_at`, `is_published_on_fdcevent`, `locale`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, '2016-04-06 17:36:12', '2016-04-06 17:36:12', 1, NULL, 0, 'fr', NULL, NULL),
(2, NULL, 1, '2016-04-06 17:36:12', '2016-04-06 17:36:12', 0, NULL, 0, 'en', NULL, NULL),
(3, NULL, 1, '2016-04-06 17:36:12', '2016-04-06 17:36:12', 0, NULL, 0, 'es', NULL, NULL),
(4, NULL, 1, '2016-04-06 17:36:12', '2016-04-06 17:36:12', 0, NULL, 0, 'zh', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `press_guide`
--

CREATE TABLE `press_guide` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `guide_arrive_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `guide_meeting_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `guide_information_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `guide_service_icon` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_guide`
--

INSERT INTO `press_guide` (`id`, `seo_file_id`, `guide_arrive_icon`, `guide_meeting_icon`, `guide_information_icon`, `guide_service_icon`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, 'icon_a-votre-service', 'icon_a-votre-service', 'icon_a-votre-service', 'icon_a-votre-service', '2016-03-07 11:48:15', '2016-03-07 11:48:15', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `press_guide_translation`
--

CREATE TABLE `press_guide_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `guide_arrive_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_meeting_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_information_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_service_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_guide_translation`
--

INSERT INTO `press_guide_translation` (`id`, `locked_by_id`, `translatable_id`, `guide_arrive_title`, `guide_meeting_title`, `guide_information_title`, `guide_service_title`, `status`, `locked_at`, `is_published_on_fdcevent`, `created_at`, `updated_at`, `locale`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, 0, '2016-03-07 11:48:15', '2016-03-07 11:48:15', 'fr', NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-03-07 11:48:15', '2016-03-07 11:48:15', 'en', NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-03-07 11:48:15', '2016-03-07 11:48:15', 'es', NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-03-07 11:48:15', '2016-03-07 11:48:15', 'zh', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `press_guide_widget`
--

CREATE TABLE `press_guide_widget` (
  `id` int(11) NOT NULL,
  `press_guide_arrive_id` int(11) DEFAULT NULL,
  `press_guide_meeting_id` int(11) DEFAULT NULL,
  `press_guide_information_id` int(11) DEFAULT NULL,
  `press_guide_service_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_guide_widget_column`
--

CREATE TABLE `press_guide_widget_column` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_guide_widget_column_translation`
--

CREATE TABLE `press_guide_widget_column_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `press_guide_widget_column_first` longtext COLLATE utf8_unicode_ci,
  `press_guide_widget_column_second` longtext COLLATE utf8_unicode_ci,
  `press_guide_widget_column_third` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_guide_widget_image`
--

CREATE TABLE `press_guide_widget_image` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_guide_widget_image_translation`
--

CREATE TABLE `press_guide_widget_image_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_guide_widget_picto`
--

CREATE TABLE `press_guide_widget_picto` (
  `id` int(11) NOT NULL,
  `press_guide_widget_picto_icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_guide_widget_picto_translation`
--

CREATE TABLE `press_guide_widget_picto_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `press_guide_widget_picto_title` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL,
  `press_guide_widget_column_text` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_homepage`
--

CREATE TABLE `press_homepage` (
  `id` int(11) NOT NULL,
  `push_main_image_id` int(11) DEFAULT NULL,
  `push_secondary_image_id` int(11) DEFAULT NULL,
  `stat_image_id` int(11) DEFAULT NULL,
  `stat_image2_id` int(11) DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `section_statement_info_display` tinyint(1) NOT NULL,
  `section_scheduling_display` tinyint(1) NOT NULL,
  `section_media_display` tinyint(1) NOT NULL,
  `section_download_display` tinyint(1) NOT NULL,
  `section_statistic_display` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_homepage`
--

INSERT INTO `press_homepage` (`id`, `push_main_image_id`, `push_secondary_image_id`, `stat_image_id`, `stat_image2_id`, `festival_id`, `seo_file_id`, `section_statement_info_display`, `section_scheduling_display`, `section_media_display`, `section_download_display`, `section_statistic_display`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, '2016-04-06 17:32:01', '2016-04-06 17:32:01', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `press_homepage_download`
--

CREATE TABLE `press_homepage_download` (
  `id` int(11) NOT NULL,
  `download_id` int(11) DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_homepage_media`
--

CREATE TABLE `press_homepage_media` (
  `id` int(11) NOT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_homepage_section`
--

CREATE TABLE `press_homepage_section` (
  `id` int(11) NOT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `press_homepage_translation`
--

CREATE TABLE `press_homepage_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `section_statement_info_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_scheduling_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_media_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_media_subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_download_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_statistic_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_statistic_subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_statistic_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `push_main_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `push_main_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `push_secondary_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `push_secondary_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_homepage_translation`
--

INSERT INTO `press_homepage_translation` (`id`, `locked_by_id`, `translatable_id`, `section_statement_info_title`, `section_scheduling_title`, `section_media_title`, `section_media_subtitle`, `section_download_title`, `section_statistic_title`, `section_statistic_subtitle`, `section_statistic_description`, `push_main_title`, `push_main_link`, `push_secondary_title`, `push_secondary_link`, `status`, `locked_at`, `is_published_on_fdcevent`, `created_at`, `updated_at`, `locale`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2016-04-06 17:32:01', '2016-04-06 17:32:01', 'fr', NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-04-06 17:32:01', '2016-04-06 17:32:01', 'en', NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-04-06 17:32:01', '2016-04-06 17:32:01', 'es', NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2016-04-06 17:32:01', '2016-04-06 17:32:01', 'zh', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `press_media_library`
--

CREATE TABLE `press_media_library` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_media_library`
--

INSERT INTO `press_media_library` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-04-06 17:36:38', '2016-04-06 17:36:38', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `press_media_library_translation`
--

CREATE TABLE `press_media_library_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_media_library_translation`
--

INSERT INTO `press_media_library_translation` (`id`, `locked_by_id`, `translatable_id`, `seo_title`, `seo_description`, `status`, `locked_at`, `is_published_on_fdcevent`, `created_at`, `updated_at`, `locale`) VALUES
(1, NULL, 1, NULL, NULL, 1, NULL, 0, '2016-04-06 17:36:38', '2016-04-06 17:36:38', 'fr'),
(2, NULL, 1, NULL, NULL, 0, NULL, 0, '2016-04-06 17:36:38', '2016-04-06 17:36:38', 'en'),
(3, NULL, 1, NULL, NULL, 0, NULL, 0, '2016-04-06 17:36:38', '2016-04-06 17:36:38', 'es'),
(4, NULL, 1, NULL, NULL, 0, NULL, 0, '2016-04-06 17:36:38', '2016-04-06 17:36:38', 'zh');

-- --------------------------------------------------------

--
-- Structure de la table `press_projection`
--

CREATE TABLE `press_projection` (
  `id` int(11) NOT NULL,
  `scheduling_id` int(11) DEFAULT NULL,
  `press_scheduling_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_projection`
--

INSERT INTO `press_projection` (`id`, `scheduling_id`, `press_scheduling_id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, NULL, NULL, '2016-04-06 17:38:13', '2016-04-06 17:38:13', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `press_projection_translation`
--

CREATE TABLE `press_projection_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `scheduling_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `press_scheduling_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_projection_translation`
--

INSERT INTO `press_projection_translation` (`id`, `locked_by_id`, `translatable_id`, `scheduling_label`, `press_scheduling_label`, `status`, `locked_at`, `is_published_on_fdcevent`, `created_at`, `updated_at`, `locale`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, NULL, NULL, 1, NULL, 0, '2016-04-06 17:38:13', '2016-04-06 17:38:13', 'fr', NULL, NULL),
(2, NULL, 1, NULL, NULL, 0, NULL, 0, '2016-04-06 17:38:13', '2016-04-06 17:38:13', 'en', NULL, NULL),
(3, NULL, 1, NULL, NULL, 0, NULL, 0, '2016-04-06 17:38:13', '2016-04-06 17:38:13', 'es', NULL, NULL),
(4, NULL, 1, NULL, NULL, 0, NULL, 0, '2016-04-06 17:38:13', '2016-04-06 17:38:13', 'zh', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `press_statement_info`
--

CREATE TABLE `press_statement_info` (
  `id` int(11) NOT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_statement_info`
--

INSERT INTO `press_statement_info` (`id`, `seo_file_id`, `created_at`, `updated_at`, `translate`, `translate_options`, `priority_status`) VALUES
(1, NULL, '2016-04-06 17:33:29', '2016-04-06 17:33:29', 0, 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `press_statement_info_translation`
--

CREATE TABLE `press_statement_info_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `press_statement_info_translation`
--

INSERT INTO `press_statement_info_translation` (`id`, `locked_by_id`, `translatable_id`, `created_at`, `updated_at`, `locale`, `status`, `locked_at`, `is_published_on_fdcevent`, `seo_title`, `seo_description`) VALUES
(1, NULL, 1, '2016-04-06 17:33:29', '2016-04-06 17:33:29', 'fr', 1, NULL, 0, NULL, NULL),
(2, NULL, 1, '2016-04-06 17:33:29', '2016-04-06 17:33:29', 'en', 0, NULL, 0, NULL, NULL),
(3, NULL, 1, '2016-04-06 17:33:29', '2016-04-06 17:33:29', 'es', 0, NULL, 0, NULL, NULL),
(4, NULL, 1, '2016-04-06 17:33:29', '2016-04-06 17:33:29', 'zh', 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `sess_id` varbinary(128) NOT NULL,
  `sess_data` blob NOT NULL,
  `sess_time` int(10) UNSIGNED NOT NULL,
  `sess_lifetime` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `sessions`
--

INSERT INTO `sessions` (`sess_id`, `sess_data`, `sess_time`, `sess_lifetime`) VALUES
(0x6574753137726d6d763576356d366a346965686e383734666e37, 0x5f7366325f617474726962757465737c613a37393a7b733a373a225f6c6f63616c65223b733a323a226672223b733a31343a225f73656375726974795f75736572223b733a3638353a22433a37343a2253796d666f6e795c436f6d706f6e656e745c53656375726974795c436f72655c41757468656e7469636174696f6e5c546f6b656e5c557365726e616d6550617373776f7264546f6b656e223a3539373a7b613a333a7b693a303b4e3b693a313b733a353a2261646d696e223b693a323b733a3535363a22613a343a7b693a303b433a34313a224170706c69636174696f6e5c536f6e6174615c5573657242756e646c655c456e746974795c55736572223a3230313a7b613a393a7b693a303b733a36303a222432792431332467306f6c3637327139756f6763386b676763776b676541674c43686d7354547153497061384a31595934727130634b46736e6c4432223b693a313b733a33313a2267306f6c3637327139756f6763386b676763776b676b737367677363733830223b693a323b733a393a22616c6c2d61646d696e223b693a333b733a393a22616c6c2d61646d696e223b693a343b623a303b693a353b623a303b693a363b623a303b693a373b623a313b693a383b693a313b7d7d693a313b623a313b693a323b613a323a7b693a303b4f3a34313a2253796d666f6e795c436f6d706f6e656e745c53656375726974795c436f72655c526f6c655c526f6c65223a313a7b733a34373a220053796d666f6e795c436f6d706f6e656e745c53656375726974795c436f72655c526f6c655c526f6c6500726f6c65223b733a31343a22524f4c455f414c4c5f41444d494e223b7d693a313b4f3a34313a2253796d666f6e795c436f6d706f6e656e745c53656375726974795c436f72655c526f6c655c526f6c65223a313a7b733a34373a220053796d666f6e795c436f6d706f6e656e745c53656375726974795c436f72655c526f6c655c526f6c6500726f6c65223b733a393a22524f4c455f55534552223b7d7d693a333b613a303a7b7d7d223b7d7d223b733a31383a225f637372662f736f6e6174612e6261746368223b733a34333a22515f73786359742d666c535376345073364b655348525859523856774a6f76475964377963386f49366749223b733a32303a225f637372662f7335373035326235316630333161223b733a34333a225731435f6b4f53467350587842514e727366384d662d425a4c6555394b43774d3352684f54533552563673223b733a32303a225f637372662f7335373035326235363331663163223b733a34333a22654769706e617673727263744131784362585f3573665852694837786e4a4250764e6d502d365242702d77223b733a32303a225f637372662f7335373035326262316233303838223b733a34333a22354436565741425565677066766a4a636c595a445757423367416f3862516d324f7572647a52522d386e6f223b733a32303a225f637372662f7335373035326265626435383734223b733a34333a22626774506f566e717145466857706f507a6e676434584a5430356c5473436e63615f316a736e667a6d6849223b733a32303a225f637372662f7335373035326266323563663865223b733a34333a224e366a5837326b7358466b4d564a57525574367a6e6e47484c66433441752d557644636a7170574c653067223b733a32303a225f637372662f7335373035326266663262376337223b733a34333a22794a474d634b30524e314b455539344a4d35376e3856543651794f4277524b6577786f59514a42596e7251223b733a32303a225f637372662f7335373035326331393835663335223b733a34333a225132326d656c786c6b6f67444a4c575942652d596262705963597954755175453254445a5a496c30774849223b733a32303a225f637372662f7335373035326333313033336165223b733a34333a2275314e63336e43756c704b6650787555766e464f487578785a677a614a4e2d646c684e7262594845323941223b733a32303a225f637372662f7335373035326334313664623730223b733a34333a226e795542484d666474695444594d396254363433513975786a62644532626549454d586a74366d2d303955223b733a32303a225f637372662f7335373035326334396435653635223b733a34333a225a3362596a4d6772566444447a797a4634747778417373514669695039584336346354333232706d514c73223b733a32303a225f637372662f7335373035326336326364663861223b733a34333a226d57434b666c66657363306a5a373677416779304d6739507672567a4f616a4b69416c3059735476614b73223b733a32303a225f637372662f7335373035326336336261303561223b733a34333a2263634a36693953564d70364e4e52316f553934512d33475a573534675a45316433463365566b34554c6749223b733a32303a225f637372662f7335373035326337353631656566223b733a34333a226130464a31716f327443746a3348636f467a6b7a753953675a5267304a544d674a4e4f51364661426c3077223b733a32303a225f637372662f7335373035326337373335663231223b733a34333a224b385f426e346861674a7a4d764f4b4742796c43525f744e6272767262435158634133496d493149446363223b733a32303a225f637372662f7335373035326337383461386638223b733a34333a226e734e584377355335474c454a314243726779754138434f4b5239764b3251507558515f457a79744e5f4d223b733a32303a225f637372662f7335373035326337613139306465223b733a34333a22364e3533317147736652745633467764464a574a6367536b414f52514c6d5a4e5a346d386f5542572d6463223b733a32303a225f637372662f7335373035326337623163333662223b733a34333a22446558326b5066594b5936695269564339723377754b755275505f5442383078724f76774746424346394d223b733a32303a225f637372662f7335373035326363303465646136223b733a34333a224643396b4d6e31745964446c4b71416f7441425a5953413939675553365358585f57317653506f7a415634223b733a32303a225f637372662f7335373035326364363633396665223b733a34333a2236464c52706a7a664d415a6171337947466d486f69476d6e3152775a534649536b4d456f6f753352584834223b733a32303a225f637372662f7335373035326365386333383431223b733a34333a2248636b2d4b43583166463852776a6e576c7137347278306b65736b693077686b70664862564b7736716538223b733a32303a225f637372662f7335373035326365643539616264223b733a34333a227a5f5f4c454a4373504d5768456d50665879776b374d494d72435565456f576f6d594b737954463530646b223b733a32303a225f637372662f7335373035326366663736376232223b733a34333a227670532d386e6c4c4d775a4e41496a2d7858444a3875736874504e61744c364d6b6d6f6d334c7732513334223b733a32303a225f637372662f7335373035326430363834663133223b733a34333a22746c4c6444724d5a576769546d43674b524d6d453343444e63395550616f67646142774c4e484465387277223b733a32303a225f637372662f7335373035326432333337306465223b733a34333a22784269786935313452667757766d476341674c44725053305f6f5370596b687749706633476f41414d4749223b733a32303a225f637372662f7335373035326432663431623431223b733a34333a224a734c6d326c39336d5a6854366556377036435735396c6145326d5f33686874395243317553415541706b223b733a32303a225f637372662f7335373035326433376530313331223b733a34333a226a436e6176357944684b4573457142456e73324d714467704358584e596c61616b48574e70583742353167223b733a32303a225f637372662f7335373035326434393230663535223b733a34333a22353948513349545376444838554e3555714e524a5151597763554f734c59433548694831614a6f36596b38223b733a32303a225f637372662f7335373035326434653233303930223b733a34333a2251653957472d71455056695641464b7a344232555561393179436863592d4c747755746546763733706251223b733a32303a225f637372662f7335373035326435336266373035223b733a34333a22507a5f4d38633730534231446d47524c4679576c754863702d39543448485953574e6f61466e74775a7630223b733a32303a225f637372662f7335373035326435666631306230223b733a34333a2241782d50574668585646416f384a49775f704d4b52695862534233496e4b7965424f304671435953504730223b733a32303a225f637372662f7335373035326436356265653932223b733a34333a22495875727657693634476437335232744a7950674a6553744474545275565a36427074435757434a444438223b733a32303a225f637372662f7335373035326437373038313530223b733a34333a226b5f765f616e496c6569307a487272653438767259545f5a347453325f4b3341584e337150674344625634223b733a32303a225f637372662f7335373035326437376466356631223b733a34333a226474464f4f61644b675656574f56734131763277374b702d33364f7066705f78667141654a5a5155646e6f223b733a32303a225f637372662f7335373035326437393634326336223b733a34333a2246684f2d737a366b4770366b6478556f436b42676e497436366c614264645842534c39345763744143506f223b733a32303a225f637372662f7335373035326437616632366562223b733a34333a224834516e4f4d30616d5277443368435743584e4d7a412d6c5f5a656248615934317449424134386c744463223b733a32303a225f637372662f7335373035326439633035356265223b733a34333a224a45777531414554764b716b735858466c377959564e614f744c6f4d6661303132656f61425f68452d4a45223b733a32303a225f637372662f7335373035326439643932386561223b733a34333a224f393857306b5f646f496d4a32594d7337677344597a565f355632556b6e4675467779457032646f4e6d73223b733a32303a225f637372662f7335373035326439656537366566223b733a34333a22333654624e366d6b456c4b61634431704d7249794c79576446354a3348566d5f53586c7161772d32464c6f223b733a32303a225f637372662f7335373035326461313339636239223b733a34333a22795a364b78507474656a716a3342497a34564178566e766d62514e5363595345584a4f4671526e2d6e4b51223b733a32303a225f637372662f7335373035326461323366356633223b733a34333a226d2d70716551596c5349756a587479534a51642d545767385f30794c6f464b515774467072387073316151223b733a32303a225f637372662f7335373035326461333730653861223b733a34333a227a4f79653042584433565f45414635637463546d784a3375353947643979444f72475336306f5377794b6b223b733a32303a225f637372662f7335373035326462613939313865223b733a34333a22347954544c6a6a7a546e7566424a41615f5f4b336a4878336f694750615346437048546b73655f48775155223b733a32303a225f637372662f7335373035326464643933376430223b733a34333a22536e794f56444a704931376e5758444542374e4d783155566e3132424f6d5977432d3632766f6366496467223b733a32303a225f637372662f7335373035326465646135393661223b733a34333a223265614263706b396f703543524a6132515a63716e476a5f306b4b6243324e6c4e5a6e4773385433304a30223b733a32303a225f637372662f7335373035326466653362613939223b733a34333a2252474c3162794f4678752d715f634a69546c6a6f304f78433461474b64555f506d73717163736e70554a49223b733a32303a225f637372662f7335373035326530376132306266223b733a34333a224a76686e516876656671597a674436387571573178676a6e4e5f385468364233396f433769494e77477a38223b733a32303a225f637372662f7335373035326530613761623236223b733a34333a22577a5f54565747616b73703166534863783654526957486c506b57697977636e384d4a775a4e4742383530223b733a32303a225f637372662f7335373035326531383736643936223b733a34333a226d49544f5967504f4377534c754b344c544763395a514c7a5f4d2d3876544c536932514e384f346a484c4d223b733a32303a225f637372662f7335373035326532313466383635223b733a34333a22446b7266545531454d7a48455f2d4662687a78535441462d6f556b5346495f68556e76393138356f4b5938223b733a32303a225f637372662f7335373035326532346335386635223b733a34333a223242427779783150755478465a346345366f41475f6b736443523650556d5832353956397666367a343659223b733a32303a225f637372662f7335373035326532373065663365223b733a34333a2245563578765458376e666d4c68584343695a353075705f5350506538646b57456c5f424730524a53593838223b733a32303a225f637372662f7335373035326533303233383433223b733a34333a22514b55646f536453734c726c5646666b5f617237692d476274466e6754786e62665958615556356c45694d223b733a32303a225f637372662f7335373035326533353231376665223b733a34333a226277747a566f52306339516b3569414a564d4b4f6f48495344583963494970555f6e6664416e5962563177223b733a32303a225f637372662f7335373035326534303230346332223b733a34333a22505f4848395f445466345a7756363651634a5f3048727342525133443970666b6e6337313976716c35534d223b733a32303a225f637372662f7335373035326534383939373064223b733a34333a226e7a30782d6d586f30616e396d6a4933777049776a4559396959316c6b5a596873384c57754d3174526a6b223b733a32303a225f637372662f7335373035326534633562653730223b733a34333a2261387a3748444632384d7a5469776f7939373632463934394535342d4b4b74647542646c446a47434f3159223b733a32303a225f637372662f7335373035326535323535373131223b733a34333a22566443307674575163565f683348587457756454326b504b4b65314d4b4d53474c6a793239317532546e49223b733a32303a225f637372662f7335373035326535643465386631223b733a34333a225261752d464546454477673766467052737278437444423749784a476f494a4c5746754e46624e50304a49223b733a32303a225f637372662f7335373035326536326563343639223b733a34333a22694c4a6a6b6d6833416e714e676a315268366c436a65704d77536b6c35776d494e6951505a597654386c63223b733a32303a225f637372662f7335373035326536393134303563223b733a34333a2276554e4e66524b427677384b5f554c326d7763666f47696a5957675f7a4c44706453423952367351654a59223b733a32303a225f637372662f7335373035326536613538306533223b733a34333a226d66314571534c54744a363862453857485f725334614a7551586d4a6f543879376e5f35597a4641532d67223b733a32303a225f637372662f7335373035326537313030376235223b733a34333a2243483973684a7a78463839596448534e4e2d73647232646f4171775f523145417132305755726270705634223b733a32303a225f637372662f7335373035326537383736613239223b733a34333a2236617a794c7164445a38666d43784a6e4e4b42396c41734d556f5f4c33515438747359657267525f413338223b733a32303a225f637372662f7335373035326537623466383166223b733a34333a225a7863687741784947425537716975393331536e377a2d623539424f563744567739735768307541363673223b733a32303a225f637372662f7335373035326538373164636430223b733a34333a22524a6f376c695044717939303878556e4575493343546b34536535423032525f44654e614f353142766777223b733a32303a225f637372662f7335373035326538376561373066223b733a34333a22312d4747506a734753695636313535616c53567a4b77516f745257503179416d546232306b5336724e5973223b733a32303a225f637372662f7335373035326539663964343663223b733a34333a224459752d7775655a50357066634a4a6d6432306f47473952727a5f653835426b594b354264634b38357559223b733a32303a225f637372662f7335373035326561376365346235223b733a34333a224d6f58475056306f6479356b70654c736962503063545a6773656e6931324f6a6458483451307750435f45223b733a32303a225f637372662f7335373035326563303630386434223b733a34333a2259334e6c7a7a2d63597a3771775a6266786b5550326346325968784b4a4f723438443772515a5937667055223b733a32303a225f637372662f7335373035326563616162376139223b733a34333a22484f31434f72366e796134376d534b3939443436737959773659394d6e39706d57746139395742614e4f30223b733a32303a225f637372662f7335373035326564396531313239223b733a34333a22584a6243714c55444645375f582d6a6b4c73525a5f644b4c496750725a704c32774c313444714d43476c41223b733a32303a225f637372662f7335373035326565383537323736223b733a34333a2262616471367254736e3462477a376d4d46614e48525a366f562d524569566d7a4b574161414e58364b516f223b733a32303a225f637372662f7335373035326631623763613838223b733a34333a226b446c41525156432d377a467a4148777a4c324b7a515a725532346b6b71315970755a754d343668523830223b733a32303a225f637372662f7335373035326632373536323037223b733a34333a227959675a50614e343235687079766d7830644b365f3430506a726c754c73786772746c474b2d5076703641223b733a32303a225f637372662f7335373035326633626364363263223b733a34333a2279715a73507a36665f724c6d467a7548386d596a3630786a5355394b6e6e43375f353236336f7638417855223b733a32303a225f637372662f7335373035326634653363393930223b733a34333a22695a627a5743634f4f4379796b4373696f764c347746326b454b67444c446d6e70436334615970564b6334223b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313435393935373630353b733a313a2263223b693a313435393935363433363b733a313a226c223b733a313a2230223b7d, 1459957605, 1440);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `settings`
--

INSERT INTO `settings` (`id`, `festival_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, NULL, 'FDC year', 'fdc-year', '2016-04-06 15:22:03', '2016-04-06 15:22:03'),
(2, NULL, 'FDC Api year', 'fdc-api-year', '2016-04-06 15:22:03', '2016-04-06 15:22:03');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `site`
--

INSERT INTO `site` (`id`, `name`, `class_color`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Site événementiel', 'red-light', 'site-evenementiel', '2016-04-06 15:22:00', '2016-04-06 15:22:00');

-- --------------------------------------------------------

--
-- Structure de la table `social_graph`
--

CREATE TABLE `social_graph` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `count` int(11) NOT NULL,
  `last_tweet_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `social_wall`
--

CREATE TABLE `social_wall` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `network` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled_mobile` tinyint(1) NOT NULL,
  `enabled_desktop` tinyint(1) NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_id_twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tumblr_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_id_instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `soif_task`
--

CREATE TABLE `soif_task` (
  `id` int(11) NOT NULL,
  `end_timestamp` datetime NOT NULL,
  `task_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement`
--

CREATE TABLE `statement` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `associated_film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `associated_event_id` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `displayed_home` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `publish_ended_at` datetime DEFAULT NULL,
  `hide_same_day` tinyint(1) NOT NULL DEFAULT '0',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_article`
--

CREATE TABLE `statement_article` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_article_translation`
--

CREATE TABLE `statement_article_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_audio`
--

CREATE TABLE `statement_audio` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL,
  `audio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_audio_translation`
--

CREATE TABLE `statement_audio_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_film_film_associated`
--

CREATE TABLE `statement_film_film_associated` (
  `id` int(11) NOT NULL,
  `statement_id` int(11) DEFAULT NULL,
  `association_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_film_projection_associated`
--

CREATE TABLE `statement_film_projection_associated` (
  `id` int(11) NOT NULL,
  `statement_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_image`
--

CREATE TABLE `statement_image` (
  `id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_image_translation`
--

CREATE TABLE `statement_image_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_site`
--

CREATE TABLE `statement_site` (
  `statement_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_statement_associated`
--

CREATE TABLE `statement_statement_associated` (
  `id` int(11) NOT NULL,
  `statement_id` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_tag`
--

CREATE TABLE `statement_tag` (
  `id` int(11) NOT NULL,
  `statement_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_video`
--

CREATE TABLE `statement_video` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_video_translation`
--

CREATE TABLE `statement_video_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget`
--

CREATE TABLE `statement_widget` (
  `id` int(11) NOT NULL,
  `statement_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_audio`
--

CREATE TABLE `statement_widget_audio` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_image`
--

CREATE TABLE `statement_widget_image` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_image_dual_align`
--

CREATE TABLE `statement_widget_image_dual_align` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_quote`
--

CREATE TABLE `statement_widget_quote` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_quote_translation`
--

CREATE TABLE `statement_widget_quote_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_text`
--

CREATE TABLE `statement_widget_text` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_text_translation`
--

CREATE TABLE `statement_widget_text_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_video`
--

CREATE TABLE `statement_widget_video` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_video_youtube`
--

CREATE TABLE `statement_widget_video_youtube` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statement_widget_video_youtube_translation`
--

CREATE TABLE `statement_widget_video_youtube_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag_translation`
--

CREATE TABLE `tag_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme_translation`
--

CREATE TABLE `theme_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_site`
--

CREATE TABLE `user_site` (
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_site`
--

INSERT INTO `user_site` (`user_id`, `site_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `web_tv`
--

CREATE TABLE `web_tv` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `seo_file_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `translate_options` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `priority_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `web_tv_translation`
--

CREATE TABLE `web_tv_translation` (
  `id` int(11) NOT NULL,
  `locked_by_id` int(11) DEFAULT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `locked_at` datetime DEFAULT NULL,
  `is_published_on_fdcevent` tinyint(1) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `widget_movie`
--

CREATE TABLE `widget_movie` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `widget_movie_film_film`
--

CREATE TABLE `widget_movie_film_film` (
  `id` int(11) NOT NULL,
  `film_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `widget_movie_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acl_classes`
--
ALTER TABLE `acl_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_69DD750638A36066` (`class_type`);

--
-- Index pour la table `acl_entries`
--
ALTER TABLE `acl_entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4` (`class_id`,`object_identity_id`,`field_name`,`ace_order`),
  ADD KEY `IDX_46C8B806EA000B103D9AB4A6DF9183C9` (`class_id`,`object_identity_id`,`security_identity_id`),
  ADD KEY `IDX_46C8B806EA000B10` (`class_id`),
  ADD KEY `IDX_46C8B8063D9AB4A6` (`object_identity_id`),
  ADD KEY `IDX_46C8B806DF9183C9` (`security_identity_id`);

--
-- Index pour la table `acl_object_identities`
--
ALTER TABLE `acl_object_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9407E5494B12AD6EA000B10` (`object_identifier`,`class_id`),
  ADD KEY `IDX_9407E54977FA751A` (`parent_object_identity_id`);

--
-- Index pour la table `acl_object_identity_ancestors`
--
ALTER TABLE `acl_object_identity_ancestors`
  ADD PRIMARY KEY (`object_identity_id`,`ancestor_id`),
  ADD KEY `IDX_825DE2993D9AB4A6` (`object_identity_id`),
  ADD KEY `IDX_825DE299C671CEA1` (`ancestor_id`);

--
-- Index pour la table `acl_security_identities`
--
ALTER TABLE `acl_security_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8835EE78772E836AF85E0677` (`identifier`,`username`);

--
-- Index pour la table `amazon_remote_file`
--
ALTER TABLE `amazon_remote_file`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cinef_person`
--
ALTER TABLE `cinef_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_905D60B5217BBB47` (`person_id`),
  ADD KEY `IDX_905D60B5613FECDF` (`session_id`);

--
-- Index pour la table `cinef_session`
--
ALTER TABLE `cinef_session`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact_page`
--
ALTER TABLE `contact_page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact_page_translation`
--
ALTER TABLE `contact_page_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_622F11892C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_622F11897A88E00` (`locked_by_id`),
  ADD KEY `IDX_622F11892C2AC5D3` (`translatable_id`);

--
-- Index pour la table `contact_theme`
--
ALTER TABLE `contact_theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact_theme_translation`
--
ALTER TABLE `contact_theme_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_ABE1FB372C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_ABE1FB377A88E00` (`locked_by_id`),
  ADD KEY `IDX_ABE1FB372C2AC5D3` (`translatable_id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `country_translation`
--
ALTER TABLE `country_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A1FE6FA42C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_A1FE6FA47A88E00` (`locked_by_id`),
  ADD KEY `IDX_A1FE6FA42C2AC5D3` (`translatable_id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA759027487` (`theme_id`),
  ADD KEY `IDX_3BAE0AA72EF91FD8` (`header_id`),
  ADD KEY `IDX_3BAE0AA78AEBAF57` (`festival_id`),
  ADD KEY `IDX_3BAE0AA7B03A8386` (`created_by_id`),
  ADD KEY `IDX_3BAE0AA7896DBBDE` (`updated_by_id`),
  ADD KEY `IDX_3BAE0AA73AF24327` (`seo_file_id`);

--
-- Index pour la table `event_film_projection_associated`
--
ALTER TABLE `event_film_projection_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5B2CDC6871F7E88B` (`event_id`),
  ADD KEY `IDX_5B2CDC68EFB9C8A5` (`association_id`);

--
-- Index pour la table `event_site`
--
ALTER TABLE `event_site`
  ADD PRIMARY KEY (`event_id`,`site_id`),
  ADD KEY `IDX_7688454F71F7E88B` (`event_id`),
  ADD KEY `IDX_7688454FF6BD1646` (`site_id`);

--
-- Index pour la table `event_translation`
--
ALTER TABLE `event_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1FE096EF989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_1FE096EF2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_1FE096EF7A88E00` (`locked_by_id`),
  ADD KEY `IDX_1FE096EF2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `event_widget`
--
ALTER TABLE `event_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B76069829D6A1065` (`events_id`);

--
-- Index pour la table `event_widget_audio`
--
ALTER TABLE `event_widget_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AE28657093CB796C` (`file_id`);

--
-- Index pour la table `event_widget_image`
--
ALTER TABLE `event_widget_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_736857BA4E7AF8F` (`gallery_id`);

--
-- Index pour la table `event_widget_image_dual_align`
--
ALTER TABLE `event_widget_image_dual_align`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7EECDF274E7AF8F` (`gallery_id`);

--
-- Index pour la table `event_widget_quote`
--
ALTER TABLE `event_widget_quote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `event_widget_quote_translation`
--
ALTER TABLE `event_widget_quote_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BD4343D72C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_BD4343D72C2AC5D3` (`translatable_id`);

--
-- Index pour la table `event_widget_subtitle`
--
ALTER TABLE `event_widget_subtitle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `event_widget_subtitle_translation`
--
ALTER TABLE `event_widget_subtitle_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7B940C4E2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_7B940C4E2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `event_widget_text`
--
ALTER TABLE `event_widget_text`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `event_widget_text_translation`
--
ALTER TABLE `event_widget_text_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_88322C8B2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_88322C8B2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `event_widget_video`
--
ALTER TABLE `event_widget_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CA9289C993CB796C` (`file_id`);

--
-- Index pour la table `event_widget_video_youtube`
--
ALTER TABLE `event_widget_video_youtube`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5CCC463DA5256D` (`image_id`);

--
-- Index pour la table `event_widget_video_youtube_translation`
--
ALTER TABLE `event_widget_video_youtube_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E2A8F2212C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_E2A8F2212C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcevent_routes`
--
ALTER TABLE `fdcevent_routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EAC657DA727ACA70` (`parent_id`);

--
-- Index pour la table `fdcpage_award`
--
ALTER TABLE `fdcpage_award`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4C505D083DA5256D` (`image_id`),
  ADD KEY `IDX_4C505D086ABBE443` (`selection_longs_metrages_id`),
  ADD KEY `IDX_4C505D08B38AC4F3` (`selection_courts_metrages_id`),
  ADD KEY `IDX_4C505D083AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_award_other_selection_sections_associated`
--
ALTER TABLE `fdcpage_award_other_selection_sections_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A57058A2C2CE629` (`fdcpage_award_id`),
  ADD KEY `IDX_A57058A2EFB9C8A5` (`association_id`);

--
-- Index pour la table `fdcpage_award_translation`
--
ALTER TABLE `fdcpage_award_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DE4067172C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_DE4067177A88E00` (`locked_by_id`),
  ADD KEY `IDX_DE4067172C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_event`
--
ALTER TABLE `fdcpage_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FDA579483AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_event_translation`
--
ALTER TABLE `fdcpage_event_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_711CBFB12C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_711CBFB17A88E00` (`locked_by_id`),
  ADD KEY `IDX_711CBFB12C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_jury`
--
ALTER TABLE `fdcpage_jury`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_149FED163DA5256D` (`image_id`),
  ADD KEY `IDX_149FED164C5F2E1B` (`jury_type_id`),
  ADD KEY `IDX_149FED163AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_jury_translation`
--
ALTER TABLE `fdcpage_jury_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_24DC91342C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_24DC91347A88E00` (`locked_by_id`),
  ADD KEY `IDX_24DC91342C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_la_selection`
--
ALTER TABLE `fdcpage_la_selection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A3CC42F83DA5256D` (`image_id`),
  ADD KEY `IDX_A3CC42F8C0EC7461` (`selection_section_id`),
  ADD KEY `IDX_A3CC42F83AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4E15E63A3DA5256D` (`image_id`),
  ADD KEY `IDX_4E15E63AB03A8386` (`created_by_id`),
  ADD KEY `IDX_4E15E63A896DBBDE` (`updated_by_id`),
  ADD KEY `IDX_4E15E63A3AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C9DD229989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_C9DD2292C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_C9DD2297A88E00` (`locked_by_id`),
  ADD KEY `IDX_C9DD2292C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_630FCC2C2A4415B9` (`fdcpage_la_selection_cannes_classics_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_audio`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DC3C7FB193CB796C` (`file_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_image`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_17C4D7B4E7AF8F` (`gallery_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_image_dual_align`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_image_dual_align`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_311EB8264E7AF8F` (`gallery_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_intro`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_intro`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_intro_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_intro_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DFBD56C72C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_DFBD56C72C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_movie`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D91FBB4B63FE6BDD` (`widget_movie_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_quote`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_quote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_quote_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_quote_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CA0B81262C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_CA0B81262C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_subtitle`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_subtitle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_subtitle_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_subtitle_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4E5969B02C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_4E5969B02C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_text`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_text`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_text_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_text_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C7C04B8A2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_C7C04B8A2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_video`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B886930893CB796C` (`file_id`);

--
-- Index pour la table `fdcpage_la_selection_cannes_classics_widget_video_youtube`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_video_youtube`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_61ABBB4D3DA5256D` (`image_id`);

--
-- Index pour la table `fdcpage_la_selection_cinema_plage`
--
ALTER TABLE `fdcpage_la_selection_cinema_plage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B4BCC792989D9B62` (`slug`),
  ADD KEY `IDX_B4BCC7923DA5256D` (`image_id`),
  ADD KEY `IDX_B4BCC792B03A8386` (`created_by_id`),
  ADD KEY `IDX_B4BCC792896DBBDE` (`updated_by_id`),
  ADD KEY `IDX_B4BCC7923AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_la_selection_cinema_plage_translation`
--
ALTER TABLE `fdcpage_la_selection_cinema_plage_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_63E028C72C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_63E028C77A88E00` (`locked_by_id`),
  ADD KEY `IDX_63E028C72C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_la_selection_translation`
--
ALTER TABLE `fdcpage_la_selection_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_99DB9F532C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_99DB9F537A88E00` (`locked_by_id`),
  ADD KEY `IDX_99DB9F532C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_news_articles`
--
ALTER TABLE `fdcpage_news_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7D0182FA3AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_news_articles_translation`
--
ALTER TABLE `fdcpage_news_articles_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_85CD32062C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_85CD32067A88E00` (`locked_by_id`),
  ADD KEY `IDX_85CD32062C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_news_audios`
--
ALTER TABLE `fdcpage_news_audios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C9948393AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_news_audios_translation`
--
ALTER TABLE `fdcpage_news_audios_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D45553992C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_D45553997A88E00` (`locked_by_id`),
  ADD KEY `IDX_D45553992C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_news_images`
--
ALTER TABLE `fdcpage_news_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_77F523A53AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_news_images_translation`
--
ALTER TABLE `fdcpage_news_images_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7758348E2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_7758348E7A88E00` (`locked_by_id`),
  ADD KEY `IDX_7758348E2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_news_videos`
--
ALTER TABLE `fdcpage_news_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE40F9FD3AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_news_videos_translation`
--
ALTER TABLE `fdcpage_news_videos_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DC645D2D2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_DC645D2D7A88E00` (`locked_by_id`),
  ADD KEY `IDX_DC645D2D2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_participate`
--
ALTER TABLE `fdcpage_participate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1641EF833DA5256D` (`image_id`),
  ADD KEY `IDX_1641EF833AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_participate_has_section`
--
ALTER TABLE `fdcpage_participate_has_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_19091DDED823E37A` (`section_id`),
  ADD KEY `IDX_19091DDEC667AEAB` (`download_id`);

--
-- Index pour la table `fdcpage_participate_section`
--
ALTER TABLE `fdcpage_participate_section`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fdcpage_participate_section_translation`
--
ALTER TABLE `fdcpage_participate_section_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4D0422502C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_4D0422507A88E00` (`locked_by_id`),
  ADD KEY `IDX_4D0422502C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_participate_section_widget`
--
ALTER TABLE `fdcpage_participate_section_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9636FFB4F61B0E32` (`press_download_id`),
  ADD KEY `IDX_9636FFB43AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typefive`
--
ALTER TABLE `fdcpage_participate_section_widget_typefive`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typefive_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typefive_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_171D255F2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_171D255F2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typefour`
--
ALTER TABLE `fdcpage_participate_section_widget_typefour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C2322E473DA5256D` (`image_id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typefour_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typefour_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_80F274F42C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_80F274F42C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typeone`
--
ALTER TABLE `fdcpage_participate_section_widget_typeone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E1C68A423DA5256D` (`image_id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typeone_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typeone_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FB2E58AB2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_FB2E58AB2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typethree`
--
ALTER TABLE `fdcpage_participate_section_widget_typethree`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typethree_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typethree_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_16F1C51C2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_16F1C51C2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typetwo`
--
ALTER TABLE `fdcpage_participate_section_widget_typetwo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8A6086D53DA5256D` (`image_id`),
  ADD KEY `IDX_8A6086D5A53D6BDF` (`sponsor_image_id`);

--
-- Index pour la table `fdcpage_participate_section_widget_typetwo_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typetwo_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9303C4102C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_9303C4102C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_participate_translation`
--
ALTER TABLE `fdcpage_participate_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E7E24A85989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_E7E24A852C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_E7E24A857A88E00` (`locked_by_id`),
  ADD KEY `IDX_E7E24A852C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_prepare`
--
ALTER TABLE `fdcpage_prepare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_742DDD24E4873418` (`main_image_id`),
  ADD KEY `IDX_742DDD24B1931E1` (`meeting_file_id`),
  ADD KEY `IDX_742DDD243AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_prepare_translation`
--
ALTER TABLE `fdcpage_prepare_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_22C4A8132C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_22C4A8137A88E00` (`locked_by_id`),
  ADD KEY `IDX_22C4A8132C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_prepare_widget`
--
ALTER TABLE `fdcpage_prepare_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_349437536034A12E` (`fdcpage_prepare_arrive_id`),
  ADD KEY `IDX_34943753C306CFD6` (`fdcpage_prepare_meeting_id`),
  ADD KEY `IDX_3494375330ACF257` (`fdcpage_prepare_information_id`),
  ADD KEY `IDX_3494375349195BAC` (`fdcpage_prepare_service_id`),
  ADD KEY `IDX_349437533AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_prepare_widget_column`
--
ALTER TABLE `fdcpage_prepare_widget_column`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D4ED4AE43DA5256D` (`image_id`),
  ADD KEY `IDX_D4ED4AE493CB796C` (`file_id`);

--
-- Index pour la table `fdcpage_prepare_widget_column_translation`
--
ALTER TABLE `fdcpage_prepare_widget_column_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1E5718992C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_1E5718992C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_prepare_widget_image`
--
ALTER TABLE `fdcpage_prepare_widget_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C75ECDB34E7AF8F` (`gallery_id`);

--
-- Index pour la table `fdcpage_prepare_widget_image_translation`
--
ALTER TABLE `fdcpage_prepare_widget_image_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F8E2C5882C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_F8E2C5882C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_prepare_widget_picto`
--
ALTER TABLE `fdcpage_prepare_widget_picto`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fdcpage_prepare_widget_picto_translation`
--
ALTER TABLE `fdcpage_prepare_widget_picto_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D23E5AAF2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_D23E5AAF2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_waiting`
--
ALTER TABLE `fdcpage_waiting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_78308400684EC833` (`banner_id`),
  ADD KEY `IDX_78308400C4663E4` (`page_id`),
  ADD KEY `IDX_783084003AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_waiting_translation`
--
ALTER TABLE `fdcpage_waiting_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E6452792C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_E6452797A88E00` (`locked_by_id`),
  ADD KEY `IDX_E6452792C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_web_tv_channels`
--
ALTER TABLE `fdcpage_web_tv_channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_11A1E5A03DA5256D` (`image_id`),
  ADD KEY `IDX_11A1E5A0F6A6B57E` (`sticky_id`),
  ADD KEY `IDX_11A1E5A03AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_web_tv_channels_translation`
--
ALTER TABLE `fdcpage_web_tv_channels_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_39617BB12C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_39617BB17A88E00` (`locked_by_id`),
  ADD KEY `IDX_39617BB12C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_web_tv_live`
--
ALTER TABLE `fdcpage_web_tv_live`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_63D49E163DA5256D` (`image_id`),
  ADD KEY `IDX_63D49E163AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_web_tv_live_media_video_associated`
--
ALTER TABLE `fdcpage_web_tv_live_media_video_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6F18B9EF1096ABC8` (`fdcpage_web_tv_live_id`),
  ADD KEY `IDX_6F18B9EFEFB9C8A5` (`association_id`);

--
-- Index pour la table `fdcpage_web_tv_live_translation`
--
ALTER TABLE `fdcpage_web_tv_live_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B184F78D2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_B184F78D7A88E00` (`locked_by_id`),
  ADD KEY `IDX_B184F78D2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdcpage_web_tv_live_web_tv_associated`
--
ALTER TABLE `fdcpage_web_tv_live_web_tv_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2C8001BA1096ABC8` (`fdcpage_web_tv_live_id`),
  ADD KEY `IDX_2C8001BAEFB9C8A5` (`association_id`);

--
-- Index pour la table `fdcpage_web_tv_trailers`
--
ALTER TABLE `fdcpage_web_tv_trailers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_681935563DA5256D` (`image_id`),
  ADD KEY `IDX_68193556C0EC7461` (`selection_section_id`),
  ADD KEY `IDX_681935563AF24327` (`seo_file_id`);

--
-- Index pour la table `fdcpage_web_tv_trailers_translation`
--
ALTER TABLE `fdcpage_web_tv_trailers_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5CAF66BD2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_5CAF66BD7A88E00` (`locked_by_id`),
  ADD KEY `IDX_5CAF66BD2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fdc_page_la_selection_cc_widget_video_yb_translation`
--
ALTER TABLE `fdc_page_la_selection_cc_widget_video_yb_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CA7BFAE02C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_CA7BFAE02C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_address`
--
ALTER TABLE `film_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EDF074A2F92F3E70` (`country_id`);

--
-- Index pour la table `film_address_translation`
--
ALTER TABLE `film_address_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_EBD716422C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_EBD716427A88E00` (`locked_by_id`),
  ADD KEY `IDX_EBD716422C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_atelier`
--
ALTER TABLE `film_atelier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1050300989D9B62` (`slug`),
  ADD KEY `IDX_1050300C0EC7461` (`selection_section_id`),
  ADD KEY `IDX_10503008AEBAF57` (`festival_id`),
  ADD KEY `IDX_1050300F13ABE4D` (`production_company_id`);

--
-- Index pour la table `film_atelier_country`
--
ALTER TABLE `film_atelier_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7B7E8A85F92F3E70` (`country_id`),
  ADD KEY `IDX_7B7E8A85567F5183` (`film_id`);

--
-- Index pour la table `film_atelier_language`
--
ALTER TABLE `film_atelier_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EDF0CF34F92F3E70` (`country_id`),
  ADD KEY `IDX_EDF0CF34567F5183` (`film_id`);

--
-- Index pour la table `film_atelier_person`
--
ALTER TABLE `film_atelier_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3B27AC4E567F5183` (`film_id`),
  ADD KEY `IDX_3B27AC4E217BBB47` (`person_id`);

--
-- Index pour la table `film_atelier_person_function`
--
ALTER TABLE `film_atelier_person_function`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6B7B8977670488013D06627D` (`function_id`,`film_atelier_id`),
  ADD KEY `IDX_6B7B897767048801` (`function_id`),
  ADD KEY `IDX_6B7B89773D06627D` (`film_atelier_id`);

--
-- Index pour la table `film_atelier_production_company`
--
ALTER TABLE `film_atelier_production_company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4A2C6323F5B7AF75` (`address_id`);

--
-- Index pour la table `film_atelier_production_company_address`
--
ALTER TABLE `film_atelier_production_company_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D68C3894F92F3E70` (`country_id`);

--
-- Index pour la table `film_atelier_production_company_address_translation`
--
ALTER TABLE `film_atelier_production_company_address_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8C8035972C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_8C8035977A88E00` (`locked_by_id`),
  ADD KEY `IDX_8C8035972C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_atelier_translation`
--
ALTER TABLE `film_atelier_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_82644E972C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_82644E977A88E00` (`locked_by_id`),
  ADD KEY `IDX_82644E972C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_award`
--
ALTER TABLE `film_award`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1337D0B78AEBAF57` (`festival_id`),
  ADD KEY `IDX_1337D0B7BBE43214` (`prize_id`);

--
-- Index pour la table `film_award_association`
--
ALTER TABLE `film_award_association`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B3732C173D5282CF` (`award_id`),
  ADD KEY `IDX_B3732C17567F5183` (`film_id`),
  ADD KEY `IDX_B3732C17217BBB47` (`person_id`);

--
-- Index pour la table `film_contact`
--
ALTER TABLE `film_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ACDCFD1BF5B7AF75` (`address_id`),
  ADD KEY `IDX_ACDCFD1B217BBB47` (`person_id`);

--
-- Index pour la table `film_contact_film_contact`
--
ALTER TABLE `film_contact_film_contact`
  ADD PRIMARY KEY (`film_contact_source`,`film_contact_target`),
  ADD KEY `IDX_C94AF91221D46EE6` (`film_contact_source`),
  ADD KEY `IDX_C94AF91238313E69` (`film_contact_target`);

--
-- Index pour la table `film_contact_person`
--
ALTER TABLE `film_contact_person`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_contact_person_film_contact_person`
--
ALTER TABLE `film_contact_person_film_contact_person`
  ADD PRIMARY KEY (`film_contact_person_source`,`film_contact_person_target`),
  ADD KEY `IDX_CE6E173FBA966165` (`film_contact_person_source`),
  ADD KEY `IDX_CE6E173FA37331EA` (`film_contact_person_target`);

--
-- Index pour la table `film_event`
--
ALTER TABLE `film_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A2C2F4F7401B253C` (`event_type_id`);

--
-- Index pour la table `film_event_type`
--
ALTER TABLE `film_event_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_festival`
--
ALTER TABLE `film_festival`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_festival_poster`
--
ALTER TABLE `film_festival_poster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D09388568AEBAF57` (`festival_id`),
  ADD KEY `IDX_D093885693CB796C` (`file_id`);

--
-- Index pour la table `film_festival_poster_translation`
--
ALTER TABLE `film_festival_poster_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CA2BAE742C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_CA2BAE747A88E00` (`locked_by_id`),
  ADD KEY `IDX_CA2BAE742C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_film`
--
ALTER TABLE `film_film`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E7EB5421989D9B62` (`slug`),
  ADD KEY `IDX_E7EB5421E48EFE78` (`selection_id`),
  ADD KEY `IDX_E7EB5421C0EC7461` (`selection_section_id`),
  ADD KEY `IDX_E7EB54218AEBAF57` (`festival_id`),
  ADD KEY `IDX_E7EB5421F76EF056` (`image_main_id`),
  ADD KEY `IDX_E7EB54211DD7A841` (`image_cover_id`),
  ADD KEY `IDX_E7EB542187934E27` (`video_main_id`);

--
-- Index pour la table `film_film_country`
--
ALTER TABLE `film_film_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_230A77F9F92F3E70` (`country_id`),
  ADD KEY `IDX_230A77F9567F5183` (`film_id`);

--
-- Index pour la table `film_film_film_contact`
--
ALTER TABLE `film_film_film_contact`
  ADD PRIMARY KEY (`film_film_id`,`film_contact_id`),
  ADD KEY `IDX_76385E5AB6C14AA0` (`film_film_id`),
  ADD KEY `IDX_76385E5A58458802` (`film_contact_id`);

--
-- Index pour la table `film_film_media`
--
ALTER TABLE `film_film_media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `film_film_media` (`film_id`,`media_id`),
  ADD KEY `IDX_4CA4F214567F5183` (`film_id`),
  ADD KEY `IDX_4CA4F214EA9FDD75` (`media_id`);

--
-- Index pour la table `film_film_person`
--
ALTER TABLE `film_film_person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2796C173567F5183217BBB47` (`film_id`,`person_id`),
  ADD KEY `IDX_2796C173567F5183` (`film_id`),
  ADD KEY `IDX_2796C173217BBB47` (`person_id`);

--
-- Index pour la table `film_film_person_function`
--
ALTER TABLE `film_film_person_function`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DFD9D6C6704880115B7E574` (`function_id`,`film_person_id`),
  ADD KEY `IDX_DFD9D6C67048801` (`function_id`),
  ADD KEY `IDX_DFD9D6C15B7E574` (`film_person_id`);

--
-- Index pour la table `film_film_person_translation`
--
ALTER TABLE `film_film_person_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F30240E12C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_F30240E17A88E00` (`locked_by_id`),
  ADD KEY `IDX_F30240E12C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_film_tag`
--
ALTER TABLE `film_film_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE3DBDB2567F5183` (`film_id`),
  ADD KEY `IDX_BE3DBDB2BAD26311` (`tag_id`);

--
-- Index pour la table `film_film_translation`
--
ALTER TABLE `film_film_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3072D4042C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_3072D4047A88E00` (`locked_by_id`),
  ADD KEY `IDX_3072D4042C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_function`
--
ALTER TABLE `film_function`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_function_translation`
--
ALTER TABLE `film_function_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F5484B7A2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_F5484B7A7A88E00` (`locked_by_id`),
  ADD KEY `IDX_F5484B7A2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_jury`
--
ALTER TABLE `film_jury`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_769A5A2F8AEBAF57` (`festival_id`),
  ADD KEY `IDX_769A5A2F217BBB47` (`person_id`),
  ADD KEY `IDX_769A5A2FC54C8C93` (`type_id`),
  ADD KEY `IDX_769A5A2F67048801` (`function_id`);

--
-- Index pour la table `film_jury_function`
--
ALTER TABLE `film_jury_function`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_jury_function_translation`
--
ALTER TABLE `film_jury_function_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6B0C226A2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_6B0C226A7A88E00` (`locked_by_id`),
  ADD KEY `IDX_6B0C226A2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_jury_translation`
--
ALTER TABLE `film_jury_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4F5094C72C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_4F5094C77A88E00` (`locked_by_id`),
  ADD KEY `IDX_4F5094C72C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_jury_type`
--
ALTER TABLE `film_jury_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_jury_type_translation`
--
ALTER TABLE `film_jury_type_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FD3D7E3C2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_FD3D7E3C7A88E00` (`locked_by_id`),
  ADD KEY `IDX_FD3D7E3C2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_language`
--
ALTER TABLE `film_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_765CBEDCF92F3E70` (`country_id`),
  ADD KEY `IDX_765CBEDC567F5183` (`film_id`);

--
-- Index pour la table `film_media`
--
ALTER TABLE `film_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F3405F5C8AEBAF57` (`festival_id`),
  ADD KEY `IDX_F3405F5C93CB796C` (`file_id`),
  ADD KEY `IDX_F3405F5C12469DE2` (`category_id`),
  ADD KEY `IDX_F3405F5CE560103C` (`jury_id`),
  ADD KEY `IDX_F3405F5C71F7E88B` (`event_id`),
  ADD KEY `IDX_F3405F5C3D06627D` (`film_atelier_id`),
  ADD KEY `IDX_F3405F5CD5F3BFB5` (`cinef_person_id`);

--
-- Index pour la table `film_media_category`
--
ALTER TABLE `film_media_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_media_category_translation`
--
ALTER TABLE `film_media_category_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5F11E3702C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_5F11E3707A88E00` (`locked_by_id`),
  ADD KEY `IDX_5F11E3702C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_minor_production`
--
ALTER TABLE `film_minor_production`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_69CA50BE567F5183` (`film_id`);

--
-- Index pour la table `film_person`
--
ALTER TABLE `film_person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5F2EEC7C989D9B62` (`slug`),
  ADD KEY `IDX_5F2EEC7CFE19244` (`portrait_image_id`),
  ADD KEY `IDX_5F2EEC7C13AB50FB` (`landscape_image_id`),
  ADD KEY `IDX_5F2EEC7CD44A1F79` (`president_jury_image_id`),
  ADD KEY `IDX_5F2EEC7C1C9DA55` (`nationality_id`),
  ADD KEY `IDX_5F2EEC7CDFD9EEDC` (`nationality2_id`),
  ADD KEY `IDX_5F2EEC7CF5B7AF75` (`address_id`);

--
-- Index pour la table `film_person_media`
--
ALTER TABLE `film_person_media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `film_person_media` (`person_id`,`media_id`),
  ADD KEY `IDX_56DD1B74217BBB47` (`person_id`),
  ADD KEY `IDX_56DD1B74EA9FDD75` (`media_id`);

--
-- Index pour la table `film_person_translation`
--
ALTER TABLE `film_person_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1AC4B7402C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_1AC4B7407A88E00` (`locked_by_id`),
  ADD KEY `IDX_1AC4B7402C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_prize`
--
ALTER TABLE `film_prize`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_prize_translation`
--
ALTER TABLE `film_prize_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3177CCA82C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_3177CCA87A88E00` (`locked_by_id`),
  ADD KEY `IDX_3177CCA82C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_projection`
--
ALTER TABLE `film_projection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3FE0656E8AEBAF57` (`festival_id`),
  ADD KEY `IDX_3FE0656E54177093` (`room_id`);

--
-- Index pour la table `film_projection_media`
--
ALTER TABLE `film_projection_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7A70381293CB796C` (`file_id`),
  ADD KEY `IDX_7A7038125ECF66BD` (`projection_id`);

--
-- Index pour la table `film_projection_programmation_dynamic`
--
ALTER TABLE `film_projection_programmation_dynamic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D272BA41C54C8C93` (`type_id`),
  ADD KEY `IDX_D272BA415ECF66BD` (`projection_id`);

--
-- Index pour la table `film_projection_programmation_film`
--
ALTER TABLE `film_projection_programmation_film`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_film_projection_uniqueness` (`type_id`,`film_id`,`projection_id`),
  ADD KEY `IDX_65A696F6C54C8C93` (`type_id`),
  ADD KEY `IDX_65A696F6567F5183` (`film_id`),
  ADD KEY `IDX_65A696F65ECF66BD` (`projection_id`);

--
-- Index pour la table `film_projection_programmation_film_list`
--
ALTER TABLE `film_projection_programmation_film_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_83CD2DB6C54C8C93` (`type_id`),
  ADD KEY `IDX_83CD2DB65ECF66BD` (`projection_id`);

--
-- Index pour la table `film_projection_programmation_film_list_film_film`
--
ALTER TABLE `film_projection_programmation_film_list_film_film`
  ADD PRIMARY KEY (`film_projection_programmation_film_list_id`,`film_film_id`),
  ADD KEY `IDX_27CC93F626DA3F3` (`film_projection_programmation_film_list_id`),
  ADD KEY `IDX_27CC93FB6C14AA0` (`film_film_id`);

--
-- Index pour la table `film_projection_programmation_type`
--
ALTER TABLE `film_projection_programmation_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_projection_room`
--
ALTER TABLE `film_projection_room`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_projection_translation`
--
ALTER TABLE `film_projection_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CC5E708F2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_CC5E708F7A88E00` (`locked_by_id`),
  ADD KEY `IDX_CC5E708F2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_selection`
--
ALTER TABLE `film_selection`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_selection_section`
--
ALTER TABLE `film_selection_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CFF7DAF38AEBAF57` (`festival_id`),
  ADD KEY `IDX_CFF7DAF3E48EFE78` (`selection_id`);

--
-- Index pour la table `film_selection_section_translation`
--
ALTER TABLE `film_selection_section_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A1D920332C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_A1D920337A88E00` (`locked_by_id`),
  ADD KEY `IDX_A1D920332C2AC5D3` (`translatable_id`);

--
-- Index pour la table `film_selection_subsection`
--
ALTER TABLE `film_selection_subsection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_37FF7306E48EFE78` (`selection_id`);

--
-- Index pour la table `film_selection_subsection_translation`
--
ALTER TABLE `film_selection_subsection_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C93E1C8C2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_C93E1C8C7A88E00` (`locked_by_id`),
  ADD KEY `IDX_C93E1C8C2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `fos_user_group`
--
ALTER TABLE `fos_user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_583D1F3E5E237E06` (`name`);

--
-- Index pour la table `fos_user_user`
--
ALTER TABLE `fos_user_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C560D76192FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_C560D761A0D96FBF` (`email_canonical`);

--
-- Index pour la table `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `IDX_B3C77447A76ED395` (`user_id`),
  ADD KEY `IDX_B3C77447FE54D947` (`group_id`);

--
-- Index pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gallery_dual_align`
--
ALTER TABLE `gallery_dual_align`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gallery_dual_align_media`
--
ALTER TABLE `gallery_dual_align_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_797B2648EA9FDD75` (`media_id`),
  ADD KEY `IDX_797B26484E7AF8F` (`gallery_id`);

--
-- Index pour la table `gallery_media`
--
ALTER TABLE `gallery_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8EB1712FEA9FDD75` (`media_id`),
  ADD KEY `IDX_8EB1712F4E7AF8F` (`gallery_id`);

--
-- Index pour la table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CB24D5EE8A8D6F1` (`pushs_main_image1_id`),
  ADD KEY `IDX_CB24D5EE1A1D791F` (`pushs_main_image2_id`),
  ADD KEY `IDX_CB24D5EEA2A11E7A` (`pushs_main_image3_id`),
  ADD KEY `IDX_CB24D5EE24BFDBE2` (`pushs_secondary_image1_id`),
  ADD KEY `IDX_CB24D5EE360A740C` (`pushs_secondary_image2_id`),
  ADD KEY `IDX_CB24D5EE8EB61369` (`pushs_secondary_image3_id`),
  ADD KEY `IDX_CB24D5EE13612BD0` (`pushs_secondary_image4_id`),
  ADD KEY `IDX_CB24D5EEABDD4CB5` (`pushs_secondary_image5_id`),
  ADD KEY `IDX_CB24D5EEB968E35B` (`pushs_secondary_image6_id`),
  ADD KEY `IDX_CB24D5EE1D4843E` (`pushs_secondary_image7_id`),
  ADD KEY `IDX_CB24D5EE59B79468` (`pushs_secondary_image8_id`),
  ADD KEY `IDX_CB24D5EE68A8CFD2` (`prefooter_image1_id`),
  ADD KEY `IDX_CB24D5EE7A1D603C` (`prefooter_image2_id`),
  ADD KEY `IDX_CB24D5EEC2A10759` (`prefooter_image3_id`),
  ADD KEY `IDX_CB24D5EE5F763FE0` (`prefooter_image4_id`),
  ADD KEY `IDX_CB24D5EE8AEBAF57` (`festival_id`),
  ADD KEY `IDX_CB24D5EE3AF24327` (`seo_file_id`);

--
-- Index pour la table `homepage_films_associated`
--
ALTER TABLE `homepage_films_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_95278A99571EDDA` (`homepage_id`),
  ADD KEY `IDX_95278A9929C1004E` (`video_id`),
  ADD KEY `IDX_95278A99229BF7D0` (`tablet_image_id`),
  ADD KEY `IDX_95278A99F0928933` (`mobile_image_id`),
  ADD KEY `IDX_95278A99EFB9C8A5` (`association_id`);

--
-- Index pour la table `homepage_slide`
--
ALTER TABLE `homepage_slide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2726C9EDB5A459A0` (`news_id`),
  ADD KEY `IDX_2726C9ED544A4CCA` (`infos_id`),
  ADD KEY `IDX_2726C9ED849CB65B` (`statement_id`),
  ADD KEY `IDX_2726C9ED571EDDA` (`homepage_id`);

--
-- Index pour la table `homepage_top_videos_associated`
--
ALTER TABLE `homepage_top_videos_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CD16BC5F571EDDA` (`homepage_id`),
  ADD KEY `IDX_CD16BC5FEFB9C8A5` (`association_id`);

--
-- Index pour la table `homepage_top_web_tvs_associated`
--
ALTER TABLE `homepage_top_web_tvs_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F0911BE571EDDA` (`homepage_id`),
  ADD KEY `IDX_8F0911BEEFB9C8A5` (`association_id`);

--
-- Index pour la table `homepage_translation`
--
ALTER TABLE `homepage_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_495C5DA12C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_495C5DA12C2AC5D3` (`translatable_id`);

--
-- Index pour la table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CB89315759027487` (`theme_id`),
  ADD KEY `IDX_CB8931578AEBAF57` (`festival_id`),
  ADD KEY `IDX_CB893157571EDDA` (`homepage_id`),
  ADD KEY `IDX_CB8931574D36AEC7` (`associated_film_id`),
  ADD KEY `IDX_CB8931575D24FD` (`associated_event_id`),
  ADD KEY `IDX_CB893157B03A8386` (`created_by_id`),
  ADD KEY `IDX_CB893157896DBBDE` (`updated_by_id`),
  ADD KEY `IDX_CB8931573AF24327` (`seo_file_id`);

--
-- Index pour la table `info_article`
--
ALTER TABLE `info_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_80FF27F82EF91FD8` (`header_id`);

--
-- Index pour la table `info_article_translation`
--
ALTER TABLE `info_article_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_80E02274989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_80E022742C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_80E022747A88E00` (`locked_by_id`),
  ADD KEY `IDX_80E022742C2AC5D3` (`translatable_id`);

--
-- Index pour la table `info_audio`
--
ALTER TABLE `info_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1224F3602EF91FD8` (`header_id`),
  ADD KEY `IDX_1224F3603A3123C7` (`audio_id`);

--
-- Index pour la table `info_audio_translation`
--
ALTER TABLE `info_audio_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_162753A9989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_162753A92C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_162753A97A88E00` (`locked_by_id`),
  ADD KEY `IDX_162753A92C2AC5D3` (`translatable_id`);

--
-- Index pour la table `info_film_film_associated`
--
ALTER TABLE `info_film_film_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2F18D2DF5D8BC1F8` (`info_id`),
  ADD KEY `IDX_2F18D2DFEFB9C8A5` (`association_id`);

--
-- Index pour la table `info_film_projection_associated`
--
ALTER TABLE `info_film_projection_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_937BCD885D8BC1F8` (`info_id`),
  ADD KEY `IDX_937BCD88EFB9C8A5` (`association_id`);

--
-- Index pour la table `info_image`
--
ALTER TABLE `info_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CF64C1AA2EF91FD8` (`header_id`),
  ADD KEY `IDX_CF64C1AA4E7AF8F` (`gallery_id`);

--
-- Index pour la table `info_image_translation`
--
ALTER TABLE `info_image_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A74030CB989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_A74030CB2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_A74030CB7A88E00` (`locked_by_id`),
  ADD KEY `IDX_A74030CB2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `info_info_associated`
--
ALTER TABLE `info_info_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_613CDA035D8BC1F8` (`info_id`),
  ADD KEY `IDX_613CDA03EFB9C8A5` (`association_id`);

--
-- Index pour la table `info_site`
--
ALTER TABLE `info_site`
  ADD PRIMARY KEY (`info_id`,`site_id`),
  ADD KEY `IDX_3028DB6A5D8BC1F8` (`info_id`),
  ADD KEY `IDX_3028DB6AF6BD1646` (`site_id`);

--
-- Index pour la table `info_tag`
--
ALTER TABLE `info_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB662EFF5D8BC1F8` (`info_id`),
  ADD KEY `IDX_DB662EFFBAD26311` (`tag_id`);

--
-- Index pour la table `info_video`
--
ALTER TABLE `info_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_769E1FD929C1004E` (`video_id`),
  ADD KEY `IDX_769E1FD93DA5256D` (`image_id`);

--
-- Index pour la table `info_video_translation`
--
ALTER TABLE `info_video_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4A14CAE4989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_4A14CAE42C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_4A14CAE47A88E00` (`locked_by_id`),
  ADD KEY `IDX_4A14CAE42C2AC5D3` (`translatable_id`);

--
-- Index pour la table `info_widget`
--
ALTER TABLE `info_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_482441865D8BC1F8` (`info_id`);

--
-- Index pour la table `info_widget_audio`
--
ALTER TABLE `info_widget_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EE6B82493CB796C` (`file_id`);

--
-- Index pour la table `info_widget_image`
--
ALTER TABLE `info_widget_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B3A68AEE4E7AF8F` (`gallery_id`);

--
-- Index pour la table `info_widget_image_dual_align`
--
ALTER TABLE `info_widget_image_dual_align`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_16C7EA954E7AF8F` (`gallery_id`);

--
-- Index pour la table `info_widget_quote`
--
ALTER TABLE `info_widget_quote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `info_widget_quote_translation`
--
ALTER TABLE `info_widget_quote_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9844BA422C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_9844BA422C2AC5D3` (`translatable_id`);

--
-- Index pour la table `info_widget_text`
--
ALTER TABLE `info_widget_text`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `info_widget_text_translation`
--
ALTER TABLE `info_widget_text_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E01919392C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_E01919392C2AC5D3` (`translatable_id`);

--
-- Index pour la table `info_widget_video`
--
ALTER TABLE `info_widget_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A5C549D93CB796C` (`file_id`);

--
-- Index pour la table `info_widget_video_youtube`
--
ALTER TABLE `info_widget_video_youtube`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D6D3C4E03DA5256D` (`image_id`);

--
-- Index pour la table `info_widget_video_youtube_translation`
--
ALTER TABLE `info_widget_video_youtube_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_600AA7722C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_600AA7722C2AC5D3` (`translatable_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6A2CA10C59027487` (`theme_id`),
  ADD KEY `IDX_6A2CA10C8AEBAF57` (`festival_id`),
  ADD KEY `IDX_6A2CA10CB03A8386` (`created_by_id`),
  ADD KEY `IDX_6A2CA10C896DBBDE` (`updated_by_id`),
  ADD KEY `IDX_6A2CA10C4D36AEC7` (`associated_film_id`),
  ADD KEY `IDX_6A2CA10C5D24FD` (`associated_event_id`),
  ADD KEY `IDX_6A2CA10C3AF24327` (`seo_file_id`);

--
-- Index pour la table `media_audio`
--
ALTER TABLE `media_audio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_764F224ACB53D86` (`homepage_news_id`),
  ADD KEY `IDX_764F2243DA5256D` (`image_id`);

--
-- Index pour la table `media_audio_film_film_associated`
--
ALTER TABLE `media_audio_film_film_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_43C2BAB135500D75` (`media_audio_id`),
  ADD KEY `IDX_43C2BAB1EFB9C8A5` (`association_id`);

--
-- Index pour la table `media_audio_translation`
--
ALTER TABLE `media_audio_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9C21007893CB796C` (`file_id`),
  ADD UNIQUE KEY `UNIQ_9C2100782C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_9C2100787A88E00` (`locked_by_id`),
  ADD KEY `IDX_9C2100782C2AC5D3` (`translatable_id`);

--
-- Index pour la table `media_film_projection_associated`
--
ALTER TABLE `media_film_projection_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_97556E53EA9FDD75` (`media_id`),
  ADD KEY `IDX_97556E53EFB9C8A5` (`association_id`);

--
-- Index pour la table `media_image`
--
ALTER TABLE `media_image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `media_image_simple`
--
ALTER TABLE `media_image_simple`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_797C946B03A8386` (`created_by_id`),
  ADD KEY `IDX_797C946896DBBDE` (`updated_by_id`);

--
-- Index pour la table `media_image_simple_site`
--
ALTER TABLE `media_image_simple_site`
  ADD PRIMARY KEY (`media_image_simple_id`,`site_id`),
  ADD KEY `IDX_5F8D4D2866055EA5` (`media_image_simple_id`),
  ADD KEY `IDX_5F8D4D28F6BD1646` (`site_id`);

--
-- Index pour la table `media_image_simple_translation`
--
ALTER TABLE `media_image_simple_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A878092D93CB796C` (`file_id`),
  ADD UNIQUE KEY `UNIQ_A878092D2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_A878092D7A88E00` (`locked_by_id`),
  ADD KEY `IDX_A878092D2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `media_image_simple_translation_site`
--
ALTER TABLE `media_image_simple_translation_site`
  ADD PRIMARY KEY (`media_image_simple_translation_id`,`site_id`),
  ADD KEY `IDX_4C03D2C9D9C8526C` (`media_image_simple_translation_id`),
  ADD KEY `IDX_4C03D2C9F6BD1646` (`site_id`);

--
-- Index pour la table `media_image_translation`
--
ALTER TABLE `media_image_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2D46631A93CB796C` (`file_id`),
  ADD UNIQUE KEY `UNIQ_2D46631A2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_2D46631A7A88E00` (`locked_by_id`),
  ADD KEY `IDX_2D46631A2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `media_image_translation_site`
--
ALTER TABLE `media_image_translation_site`
  ADD PRIMARY KEY (`media_image_translation_id`,`site_id`),
  ADD KEY `IDX_639805ACA69F3F7A` (`media_image_translation_id`),
  ADD KEY `IDX_639805ACF6BD1646` (`site_id`);

--
-- Index pour la table `media_site`
--
ALTER TABLE `media_site`
  ADD PRIMARY KEY (`media_id`,`site_id`),
  ADD KEY `IDX_AA04D637EA9FDD75` (`media_id`),
  ADD KEY `IDX_AA04D637F6BD1646` (`site_id`);

--
-- Index pour la table `media_tag`
--
ALTER TABLE `media_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_48D8C57EEA9FDD75` (`media_id`),
  ADD KEY `IDX_48D8C57EBAD26311` (`tag_id`);

--
-- Index pour la table `media_video`
--
ALTER TABLE `media_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_63DE1E9D571EDDA` (`homepage_id`),
  ADD KEY `IDX_63DE1E9DD03756EE` (`web_tv_id`),
  ADD KEY `IDX_63DE1E9D3DA5256D` (`image_id`),
  ADD KEY `IDX_63DE1E9DACB53D86` (`homepage_news_id`);

--
-- Index pour la table `media_video_film_film_associated`
--
ALTER TABLE `media_video_film_film_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE17867826A02EFC` (`media_video_id`),
  ADD KEY `IDX_BE178678EFB9C8A5` (`association_id`);

--
-- Index pour la table `media_video_translation`
--
ALTER TABLE `media_video_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C012993593CB796C` (`file_id`),
  ADD UNIQUE KEY `UNIQ_C01299352C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_C0129935336F1CBB` (`amazon_remote_file_id`),
  ADD KEY `IDX_C012993559027487` (`theme_id`),
  ADD KEY `IDX_C01299357A88E00` (`locked_by_id`),
  ADD KEY `IDX_C01299352C2AC5D3` (`translatable_id`);

--
-- Index pour la table `media__gallery`
--
ALTER TABLE `media__gallery`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_80D4C5414E7AF8F` (`gallery_id`),
  ADD KEY `IDX_80D4C541EA9FDD75` (`media_id`);

--
-- Index pour la table `media__media`
--
ALTER TABLE `media__media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1DD399507AC9EAB8` (`homepage_media_audio_id`),
  ADD UNIQUE KEY `UNIQ_1DD399506939C931` (`homepage_media_video_id`),
  ADD KEY `IDX_1DD3995059027487` (`theme_id`),
  ADD KEY `IDX_1DD399508AEBAF57` (`festival_id`),
  ADD KEY `IDX_1DD39950571EDDA` (`homepage_id`),
  ADD KEY `IDX_1DD399504D36AEC7` (`associated_film_id`),
  ADD KEY `IDX_1DD399505D24FD` (`associated_event_id`),
  ADD KEY `IDX_1DD39950B03A8386` (`created_by_id`),
  ADD KEY `IDX_1DD39950896DBBDE` (`updated_by_id`),
  ADD KEY `IDX_1DD399503AF24327` (`seo_file_id`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7E8585C8F6BD1646` (`site_id`);

--
-- Index pour la table `news_article`
--
ALTER TABLE `news_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_55DE12802EF91FD8` (`header_id`);

--
-- Index pour la table `news_article_translation`
--
ALTER TABLE `news_article_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5945EB8989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_5945EB82C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_5945EB87A88E00` (`locked_by_id`),
  ADD KEY `IDX_5945EB82C2AC5D3` (`translatable_id`);

--
-- Index pour la table `news_audio`
--
ALTER TABLE `news_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62C2B1CB2EF91FD8` (`header_id`),
  ADD KEY `IDX_62C2B1CB3A3123C7` (`audio_id`);

--
-- Index pour la table `news_audio_translation`
--
ALTER TABLE `news_audio_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5B385D72989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_5B385D722C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_5B385D727A88E00` (`locked_by_id`),
  ADD KEY `IDX_5B385D722C2AC5D3` (`translatable_id`);

--
-- Index pour la table `news_film_film_associated`
--
ALTER TABLE `news_film_film_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BD4F2838B5A459A0` (`news_id`),
  ADD KEY `IDX_BD4F2838EFB9C8A5` (`association_id`);

--
-- Index pour la table `news_film_projection_associated`
--
ALTER TABLE `news_film_projection_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_32F3F5CBB5A459A0` (`news_id`),
  ADD KEY `IDX_32F3F5CBEFB9C8A5` (`association_id`);

--
-- Index pour la table `news_image`
--
ALTER TABLE `news_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BF8283012EF91FD8` (`header_id`),
  ADD KEY `IDX_BF8283014E7AF8F` (`gallery_id`);

--
-- Index pour la table `news_image_translation`
--
ALTER TABLE `news_image_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_EA5F3E10989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_EA5F3E102C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_EA5F3E107A88E00` (`locked_by_id`),
  ADD KEY `IDX_EA5F3E102C2AC5D3` (`translatable_id`);

--
-- Index pour la table `news_news_associated`
--
ALTER TABLE `news_news_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DD8D17BCB5A459A0` (`news_id`),
  ADD KEY `IDX_DD8D17BCEFB9C8A5` (`association_id`);

--
-- Index pour la table `news_site`
--
ALTER TABLE `news_site`
  ADD PRIMARY KEY (`news_id`,`site_id`),
  ADD KEY `IDX_BC9EFF6FB5A459A0` (`news_id`),
  ADD KEY `IDX_BC9EFF6FF6BD1646` (`site_id`);

--
-- Index pour la table `news_tag`
--
ALTER TABLE `news_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE3ED8A1B5A459A0` (`news_id`),
  ADD KEY `IDX_BE3ED8A1BAD26311` (`tag_id`);

--
-- Index pour la table `news_video`
--
ALTER TABLE `news_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6785D7229C1004E` (`video_id`),
  ADD KEY `IDX_6785D723DA5256D` (`image_id`);

--
-- Index pour la table `news_video_translation`
--
ALTER TABLE `news_video_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_70BC43F989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_70BC43F2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_70BC43F7A88E00` (`locked_by_id`),
  ADD KEY `IDX_70BC43F2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `news_widget`
--
ALTER TABLE `news_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_950DDA4B5A459A0` (`news_id`);

--
-- Index pour la table `news_widget_audio`
--
ALTER TABLE `news_widget_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A571063493CB796C` (`file_id`);

--
-- Index pour la table `news_widget_image`
--
ALTER TABLE `news_widget_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_783134FE4E7AF8F` (`gallery_id`);

--
-- Index pour la table `news_widget_image_dual_align`
--
ALTER TABLE `news_widget_image_dual_align`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A136E1424E7AF8F` (`gallery_id`);

--
-- Index pour la table `news_widget_quote`
--
ALTER TABLE `news_widget_quote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news_widget_quote_translation`
--
ALTER TABLE `news_widget_quote_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_80440C3E2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_80440C3E2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `news_widget_text`
--
ALTER TABLE `news_widget_text`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news_widget_text_translation`
--
ALTER TABLE `news_widget_text_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_57E812EE2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_57E812EE2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `news_widget_video`
--
ALTER TABLE `news_widget_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C1CBEA8D93CB796C` (`file_id`);

--
-- Index pour la table `news_widget_video_youtube`
--
ALTER TABLE `news_widget_video_youtube`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_44843E073DA5256D` (`image_id`);

--
-- Index pour la table `news_widget_video_youtube_translation`
--
ALTER TABLE `news_widget_video_youtube_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_88C085742C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_88C085742C2AC5D3` (`translatable_id`);

--
-- Index pour la table `prefooter`
--
ALTER TABLE `prefooter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_72A2862493CB796C` (`file_id`),
  ADD KEY `IDX_72A28624D333CCE8` (`homepage_translation_id`);

--
-- Index pour la table `press_accredit`
--
ALTER TABLE `press_accredit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8DC4A59B3AF24327` (`seo_file_id`);

--
-- Index pour la table `press_accredit_has_procedure`
--
ALTER TABLE `press_accredit_has_procedure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_59DCC01B1624BCD2` (`procedure_id`),
  ADD KEY `IDX_59DCC01BE8027C30` (`accredit_id`);

--
-- Index pour la table `press_accredit_procedure`
--
ALTER TABLE `press_accredit_procedure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_51F56B40C2839385` (`procedure_file_id`),
  ADD KEY `IDX_51F56B40BE5C596E` (`procedure_second_file_id`);

--
-- Index pour la table `press_accredit_procedure_translation`
--
ALTER TABLE `press_accredit_procedure_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3A0E43F52C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_3A0E43F57A88E00` (`locked_by_id`),
  ADD KEY `IDX_3A0E43F52C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_accredit_translation`
--
ALTER TABLE `press_accredit_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_91FD8E4A2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_91FD8E4A7A88E00` (`locked_by_id`),
  ADD KEY `IDX_91FD8E4A2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_cinema_map`
--
ALTER TABLE `press_cinema_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_13906FFAAB6279BA` (`default_room_image_id`),
  ADD KEY `IDX_13906FFA233835E3` (`default_zone_image_id`),
  ADD KEY `IDX_13906FFA3AF24327` (`seo_file_id`);

--
-- Index pour la table `press_cinema_map_room`
--
ALTER TABLE `press_cinema_map_room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D287774B54177093` (`room_id`),
  ADD KEY `IDX_D287774B128B99A5` (`room_map_id`);

--
-- Index pour la table `press_cinema_map_translation`
--
ALTER TABLE `press_cinema_map_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D3A465472C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_D3A465477A88E00` (`locked_by_id`),
  ADD KEY `IDX_D3A465472C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_cinema_room`
--
ALTER TABLE `press_cinema_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_73C41D583DA5256D` (`image_id`),
  ADD KEY `IDX_73C41D581519A9F0` (`zone_image_id`);

--
-- Index pour la table `press_cinema_room_translation`
--
ALTER TABLE `press_cinema_room_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DBB03642C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_DBB03647A88E00` (`locked_by_id`),
  ADD KEY `IDX_DBB03642C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_download`
--
ALTER TABLE `press_download`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9BE0C1823AF24327` (`seo_file_id`);

--
-- Index pour la table `press_download_has_section`
--
ALTER TABLE `press_download_has_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_87C67397D823E37A` (`section_id`),
  ADD KEY `IDX_87C67397C667AEAB` (`download_id`);

--
-- Index pour la table `press_download_section`
--
ALTER TABLE `press_download_section`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `press_download_section_translation`
--
ALTER TABLE `press_download_section_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2ED7F93E989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_2ED7F93E2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_2ED7F93E7A88E00` (`locked_by_id`),
  ADD KEY `IDX_2ED7F93E2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_download_section_widget`
--
ALTER TABLE `press_download_section_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_19D8D06DF61B0E32` (`press_download_id`),
  ADD KEY `IDX_19D8D06D3AF24327` (`seo_file_id`);

--
-- Index pour la table `press_download_section_widget_archive`
--
ALTER TABLE `press_download_section_widget_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D204617F3DA5256D` (`image_id`),
  ADD KEY `IDX_D204617F93CB796C` (`file_id`);

--
-- Index pour la table `press_download_section_widget_archive_translation`
--
ALTER TABLE `press_download_section_widget_archive_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1E4A69292C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_1E4A69292C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_download_section_widget_document`
--
ALTER TABLE `press_download_section_widget_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E16DC1883DA5256D` (`image_id`),
  ADD KEY `IDX_E16DC18893CB796C` (`file_id`),
  ADD KEY `IDX_E16DC1888489F901` (`second_file_id`),
  ADD KEY `IDX_E16DC18816C20AE` (`third_file_id`);

--
-- Index pour la table `press_download_section_widget_document_translation`
--
ALTER TABLE `press_download_section_widget_document_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E56C07572C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_E56C07572C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_download_section_widget_file`
--
ALTER TABLE `press_download_section_widget_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8ED681FE93CB796C` (`file_id`),
  ADD KEY `IDX_8ED681FE8489F901` (`second_file_id`);

--
-- Index pour la table `press_download_section_widget_file_translation`
--
ALTER TABLE `press_download_section_widget_file_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D9F04172C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_D9F04172C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_download_section_widget_photo`
--
ALTER TABLE `press_download_section_widget_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_530702D04E7AF8F` (`gallery_id`);

--
-- Index pour la table `press_download_section_widget_video`
--
ALTER TABLE `press_download_section_widget_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3B775CE43DA5256D` (`image_id`),
  ADD KEY `IDX_3B775CE429C1004E` (`video_id`),
  ADD KEY `IDX_3B775CE493CB796C` (`file_id`),
  ADD KEY `IDX_3B775CE48489F901` (`second_file_id`);

--
-- Index pour la table `press_download_section_widget_video_translation`
--
ALTER TABLE `press_download_section_widget_video_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6B12400B2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_6B12400B2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_download_translation`
--
ALTER TABLE `press_download_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_792D24CC2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_792D24CC7A88E00` (`locked_by_id`),
  ADD KEY `IDX_792D24CC2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_guide`
--
ALTER TABLE `press_guide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7FD6A49E3AF24327` (`seo_file_id`);

--
-- Index pour la table `press_guide_translation`
--
ALTER TABLE `press_guide_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_538B9C532C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_538B9C537A88E00` (`locked_by_id`),
  ADD KEY `IDX_538B9C532C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_guide_widget`
--
ALTER TABLE `press_guide_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_74599DF95E693B6` (`press_guide_arrive_id`),
  ADD KEY `IDX_74599DF93DB70692` (`press_guide_meeting_id`),
  ADD KEY `IDX_74599DF91D7FD010` (`press_guide_information_id`),
  ADD KEY `IDX_74599DF9B7A892E8` (`press_guide_service_id`),
  ADD KEY `IDX_74599DF93AF24327` (`seo_file_id`);

--
-- Index pour la table `press_guide_widget_column`
--
ALTER TABLE `press_guide_widget_column`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_520801B4E7AF8F` (`gallery_id`);

--
-- Index pour la table `press_guide_widget_column_translation`
--
ALTER TABLE `press_guide_widget_column_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E575CD632C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_E575CD632C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_guide_widget_image`
--
ALTER TABLE `press_guide_widget_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B1F3C3174E7AF8F` (`gallery_id`);

--
-- Index pour la table `press_guide_widget_image_translation`
--
ALTER TABLE `press_guide_widget_image_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E7B5AD72C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_E7B5AD72C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_guide_widget_picto`
--
ALTER TABLE `press_guide_widget_picto`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `press_guide_widget_picto_translation`
--
ALTER TABLE `press_guide_widget_picto_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_24A7C5F02C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_24A7C5F02C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_homepage`
--
ALTER TABLE `press_homepage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_28DE961CDF1CFA84` (`push_main_image_id`),
  ADD KEY `IDX_28DE961CE9941226` (`push_secondary_image_id`),
  ADD KEY `IDX_28DE961CB492F4FA` (`stat_image_id`),
  ADD KEY `IDX_28DE961C99050B8B` (`stat_image2_id`),
  ADD KEY `IDX_28DE961C8AEBAF57` (`festival_id`),
  ADD KEY `IDX_28DE961C3AF24327` (`seo_file_id`);

--
-- Index pour la table `press_homepage_download`
--
ALTER TABLE `press_homepage_download`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E5C23440C667AEAB` (`download_id`),
  ADD KEY `IDX_E5C23440571EDDA` (`homepage_id`);

--
-- Index pour la table `press_homepage_media`
--
ALTER TABLE `press_homepage_media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3A938432567F5183` (`film_id`),
  ADD KEY `IDX_3A938432571EDDA` (`homepage_id`);

--
-- Index pour la table `press_homepage_section`
--
ALTER TABLE `press_homepage_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_27B2E56A571EDDA` (`homepage_id`);

--
-- Index pour la table `press_homepage_translation`
--
ALTER TABLE `press_homepage_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_AA95F3BA2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_AA95F3BA7A88E00` (`locked_by_id`),
  ADD KEY `IDX_AA95F3BA2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_media_library`
--
ALTER TABLE `press_media_library`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B602BC323AF24327` (`seo_file_id`);

--
-- Index pour la table `press_media_library_translation`
--
ALTER TABLE `press_media_library_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_78DCDA642C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_78DCDA647A88E00` (`locked_by_id`),
  ADD KEY `IDX_78DCDA642C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_projection`
--
ALTER TABLE `press_projection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_495BB8C9157E7D92` (`scheduling_id`),
  ADD KEY `IDX_495BB8C9632BDF55` (`press_scheduling_id`),
  ADD KEY `IDX_495BB8C93AF24327` (`seo_file_id`);

--
-- Index pour la table `press_projection_translation`
--
ALTER TABLE `press_projection_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F15442352C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_F15442357A88E00` (`locked_by_id`),
  ADD KEY `IDX_F15442352C2AC5D3` (`translatable_id`);

--
-- Index pour la table `press_statement_info`
--
ALTER TABLE `press_statement_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DCDF33CA3AF24327` (`seo_file_id`);

--
-- Index pour la table `press_statement_info_translation`
--
ALTER TABLE `press_statement_info_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BDE68C142C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_BDE68C147A88E00` (`locked_by_id`),
  ADD KEY `IDX_BDE68C142C2AC5D3` (`translatable_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sess_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E545A0C5989D9B62` (`slug`),
  ADD KEY `IDX_E545A0C58AEBAF57` (`festival_id`);

--
-- Index pour la table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_694309E4989D9B62` (`slug`);

--
-- Index pour la table `social_graph`
--
ALTER TABLE `social_graph`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_43D5B14E8AEBAF57` (`festival_id`);

--
-- Index pour la table `social_wall`
--
ALTER TABLE `social_wall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5CE43C928AEBAF57` (`festival_id`);

--
-- Index pour la table `soif_task`
--
ALTER TABLE `soif_task`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statement`
--
ALTER TABLE `statement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C0DB517659027487` (`theme_id`),
  ADD KEY `IDX_C0DB51768AEBAF57` (`festival_id`),
  ADD KEY `IDX_C0DB5176571EDDA` (`homepage_id`),
  ADD KEY `IDX_C0DB51764D36AEC7` (`associated_film_id`),
  ADD KEY `IDX_C0DB51765D24FD` (`associated_event_id`),
  ADD KEY `IDX_C0DB5176B03A8386` (`created_by_id`),
  ADD KEY `IDX_C0DB5176896DBBDE` (`updated_by_id`),
  ADD KEY `IDX_C0DB51763AF24327` (`seo_file_id`);

--
-- Index pour la table `statement_article`
--
ALTER TABLE `statement_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_80391382EF91FD8` (`header_id`);

--
-- Index pour la table `statement_article_translation`
--
ALTER TABLE `statement_article_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B08780E4989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_B08780E42C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_B08780E47A88E00` (`locked_by_id`),
  ADD KEY `IDX_B08780E42C2AC5D3` (`translatable_id`);

--
-- Index pour la table `statement_audio`
--
ALTER TABLE `statement_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2AB77A762EF91FD8` (`header_id`),
  ADD KEY `IDX_2AB77A763A3123C7` (`audio_id`);

--
-- Index pour la table `statement_audio_translation`
--
ALTER TABLE `statement_audio_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_46DB418F989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_46DB418F2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_46DB418F7A88E00` (`locked_by_id`),
  ADD KEY `IDX_46DB418F2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `statement_film_film_associated`
--
ALTER TABLE `statement_film_film_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DF272639849CB65B` (`statement_id`),
  ADD KEY `IDX_DF272639EFB9C8A5` (`association_id`);

--
-- Index pour la table `statement_film_projection_associated`
--
ALTER TABLE `statement_film_projection_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F35E58AD849CB65B` (`statement_id`),
  ADD KEY `IDX_F35E58ADEFB9C8A5` (`association_id`);

--
-- Index pour la table `statement_image`
--
ALTER TABLE `statement_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F7F748BC2EF91FD8` (`header_id`),
  ADD KEY `IDX_F7F748BC4E7AF8F` (`gallery_id`);

--
-- Index pour la table `statement_image_translation`
--
ALTER TABLE `statement_image_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F7BC22ED989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_F7BC22ED2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_F7BC22ED7A88E00` (`locked_by_id`),
  ADD KEY `IDX_F7BC22ED2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `statement_site`
--
ALTER TABLE `statement_site`
  ADD PRIMARY KEY (`statement_id`,`site_id`),
  ADD KEY `IDX_7B6309C8849CB65B` (`statement_id`),
  ADD KEY `IDX_7B6309C8F6BD1646` (`site_id`);

--
-- Index pour la table `statement_statement_associated`
--
ALTER TABLE `statement_statement_associated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B5098E47849CB65B` (`statement_id`),
  ADD KEY `IDX_B5098E47EFB9C8A5` (`association_id`);

--
-- Index pour la table `statement_tag`
--
ALTER TABLE `statement_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9460CBDA849CB65B` (`statement_id`),
  ADD KEY `IDX_9460CBDABAD26311` (`tag_id`);

--
-- Index pour la table `statement_video`
--
ALTER TABLE `statement_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4E0D96CF29C1004E` (`video_id`),
  ADD KEY `IDX_4E0D96CF3DA5256D` (`image_id`);

--
-- Index pour la table `statement_video_translation`
--
ALTER TABLE `statement_video_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1AE8D8C2989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_1AE8D8C22C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_1AE8D8C27A88E00` (`locked_by_id`),
  ADD KEY `IDX_1AE8D8C22C2AC5D3` (`translatable_id`);

--
-- Index pour la table `statement_widget`
--
ALTER TABLE `statement_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BCC8675E849CB65B` (`statement_id`);

--
-- Index pour la table `statement_widget_audio`
--
ALTER TABLE `statement_widget_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F06ED94E93CB796C` (`file_id`);

--
-- Index pour la table `statement_widget_image`
--
ALTER TABLE `statement_widget_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2D2EEB844E7AF8F` (`gallery_id`);

--
-- Index pour la table `statement_widget_image_dual_align`
--
ALTER TABLE `statement_widget_image_dual_align`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7D1E4FF34E7AF8F` (`gallery_id`);

--
-- Index pour la table `statement_widget_quote`
--
ALTER TABLE `statement_widget_quote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statement_widget_quote_translation`
--
ALTER TABLE `statement_widget_quote_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3CFEA78A2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_3CFEA78A2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `statement_widget_text`
--
ALTER TABLE `statement_widget_text`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statement_widget_text_translation`
--
ALTER TABLE `statement_widget_text_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8BC0BC5F2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_8BC0BC5F2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `statement_widget_video`
--
ALTER TABLE `statement_widget_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_94D435F793CB796C` (`file_id`);

--
-- Index pour la table `statement_widget_video_youtube`
--
ALTER TABLE `statement_widget_video_youtube`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_26EC30063DA5256D` (`image_id`);

--
-- Index pour la table `statement_widget_video_youtube_translation`
--
ALTER TABLE `statement_widget_video_youtube_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F1B60FBB2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_F1B60FBB2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag_translation`
--
ALTER TABLE `tag_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A8A03F8F2C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_A8A03F8F7A88E00` (`locked_by_id`),
  ADD KEY `IDX_A8A03F8F2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `theme_translation`
--
ALTER TABLE `theme_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5C425660989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_5C4256602C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_5C4256607A88E00` (`locked_by_id`),
  ADD KEY `IDX_5C4256602C2AC5D3` (`translatable_id`);

--
-- Index pour la table `user_site`
--
ALTER TABLE `user_site`
  ADD PRIMARY KEY (`user_id`,`site_id`),
  ADD KEY `IDX_13C2452DA76ED395` (`user_id`),
  ADD KEY `IDX_13C2452DF6BD1646` (`site_id`);

--
-- Index pour la table `web_tv`
--
ALTER TABLE `web_tv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F2CD5A198AEBAF57` (`festival_id`),
  ADD KEY `IDX_F2CD5A19571EDDA` (`homepage_id`),
  ADD KEY `IDX_F2CD5A193DA5256D` (`image_id`),
  ADD KEY `IDX_F2CD5A193AF24327` (`seo_file_id`);

--
-- Index pour la table `web_tv_translation`
--
ALTER TABLE `web_tv_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D435CB51989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_D435CB512C2AC5D34180C698` (`translatable_id`,`locale`),
  ADD KEY `IDX_D435CB517A88E00` (`locked_by_id`),
  ADD KEY `IDX_D435CB512C2AC5D3` (`translatable_id`);

--
-- Index pour la table `widget_movie`
--
ALTER TABLE `widget_movie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `widget_movie_film_film`
--
ALTER TABLE `widget_movie_film_film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4E5F2D82567F5183` (`film_id`),
  ADD KEY `IDX_4E5F2D8263FE6BDD` (`widget_movie_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `acl_classes`
--
ALTER TABLE `acl_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT pour la table `acl_entries`
--
ALTER TABLE `acl_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=899;
--
-- AUTO_INCREMENT pour la table `acl_object_identities`
--
ALTER TABLE `acl_object_identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;
--
-- AUTO_INCREMENT pour la table `acl_security_identities`
--
ALTER TABLE `acl_security_identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=777;
--
-- AUTO_INCREMENT pour la table `cinef_person`
--
ALTER TABLE `cinef_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `contact_page`
--
ALTER TABLE `contact_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `contact_page_translation`
--
ALTER TABLE `contact_page_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `contact_theme`
--
ALTER TABLE `contact_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `contact_theme_translation`
--
ALTER TABLE `contact_theme_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `country_translation`
--
ALTER TABLE `country_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event_film_projection_associated`
--
ALTER TABLE `event_film_projection_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event_translation`
--
ALTER TABLE `event_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event_widget`
--
ALTER TABLE `event_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event_widget_quote_translation`
--
ALTER TABLE `event_widget_quote_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event_widget_subtitle_translation`
--
ALTER TABLE `event_widget_subtitle_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event_widget_text_translation`
--
ALTER TABLE `event_widget_text_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event_widget_video_youtube_translation`
--
ALTER TABLE `event_widget_video_youtube_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcevent_routes`
--
ALTER TABLE `fdcevent_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `fdcpage_award`
--
ALTER TABLE `fdcpage_award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `fdcpage_award_other_selection_sections_associated`
--
ALTER TABLE `fdcpage_award_other_selection_sections_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_award_translation`
--
ALTER TABLE `fdcpage_award_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `fdcpage_event`
--
ALTER TABLE `fdcpage_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_event_translation`
--
ALTER TABLE `fdcpage_event_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fdcpage_jury`
--
ALTER TABLE `fdcpage_jury`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fdcpage_jury_translation`
--
ALTER TABLE `fdcpage_jury_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection`
--
ALTER TABLE `fdcpage_la_selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cannes_classics`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cannes_classics_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cannes_classics_widget`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cannes_classics_widget_intro_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_intro_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cannes_classics_widget_quote_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_quote_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cannes_classics_widget_subtitle_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_subtitle_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cannes_classics_widget_text_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_text_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cinema_plage`
--
ALTER TABLE `fdcpage_la_selection_cinema_plage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_cinema_plage_translation`
--
ALTER TABLE `fdcpage_la_selection_cinema_plage_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fdcpage_la_selection_translation`
--
ALTER TABLE `fdcpage_la_selection_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `fdcpage_news_articles`
--
ALTER TABLE `fdcpage_news_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_news_articles_translation`
--
ALTER TABLE `fdcpage_news_articles_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_news_audios`
--
ALTER TABLE `fdcpage_news_audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_news_audios_translation`
--
ALTER TABLE `fdcpage_news_audios_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_news_images`
--
ALTER TABLE `fdcpage_news_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_news_images_translation`
--
ALTER TABLE `fdcpage_news_images_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_news_videos`
--
ALTER TABLE `fdcpage_news_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_news_videos_translation`
--
ALTER TABLE `fdcpage_news_videos_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate`
--
ALTER TABLE `fdcpage_participate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_has_section`
--
ALTER TABLE `fdcpage_participate_has_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_section`
--
ALTER TABLE `fdcpage_participate_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_section_translation`
--
ALTER TABLE `fdcpage_participate_section_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_section_widget`
--
ALTER TABLE `fdcpage_participate_section_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_section_widget_typefive_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typefive_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_section_widget_typefour_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typefour_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_section_widget_typeone_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typeone_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_section_widget_typethree_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typethree_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_section_widget_typetwo_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typetwo_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_participate_translation`
--
ALTER TABLE `fdcpage_participate_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_prepare`
--
ALTER TABLE `fdcpage_prepare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_prepare_translation`
--
ALTER TABLE `fdcpage_prepare_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fdcpage_prepare_widget`
--
ALTER TABLE `fdcpage_prepare_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_prepare_widget_column_translation`
--
ALTER TABLE `fdcpage_prepare_widget_column_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_prepare_widget_image_translation`
--
ALTER TABLE `fdcpage_prepare_widget_image_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_prepare_widget_picto_translation`
--
ALTER TABLE `fdcpage_prepare_widget_picto_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_waiting`
--
ALTER TABLE `fdcpage_waiting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_waiting_translation`
--
ALTER TABLE `fdcpage_waiting_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_web_tv_channels`
--
ALTER TABLE `fdcpage_web_tv_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_web_tv_channels_translation`
--
ALTER TABLE `fdcpage_web_tv_channels_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fdcpage_web_tv_live`
--
ALTER TABLE `fdcpage_web_tv_live`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fdcpage_web_tv_live_media_video_associated`
--
ALTER TABLE `fdcpage_web_tv_live_media_video_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_web_tv_live_translation`
--
ALTER TABLE `fdcpage_web_tv_live_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fdcpage_web_tv_live_web_tv_associated`
--
ALTER TABLE `fdcpage_web_tv_live_web_tv_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_web_tv_trailers`
--
ALTER TABLE `fdcpage_web_tv_trailers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdcpage_web_tv_trailers_translation`
--
ALTER TABLE `fdcpage_web_tv_trailers_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fdc_page_la_selection_cc_widget_video_yb_translation`
--
ALTER TABLE `fdc_page_la_selection_cc_widget_video_yb_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_address`
--
ALTER TABLE `film_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_address_translation`
--
ALTER TABLE `film_address_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_atelier_country`
--
ALTER TABLE `film_atelier_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_atelier_language`
--
ALTER TABLE `film_atelier_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_atelier_person`
--
ALTER TABLE `film_atelier_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_atelier_person_function`
--
ALTER TABLE `film_atelier_person_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_atelier_production_company`
--
ALTER TABLE `film_atelier_production_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_atelier_production_company_address`
--
ALTER TABLE `film_atelier_production_company_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_atelier_production_company_address_translation`
--
ALTER TABLE `film_atelier_production_company_address_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_atelier_translation`
--
ALTER TABLE `film_atelier_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_award_association`
--
ALTER TABLE `film_award_association`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_event`
--
ALTER TABLE `film_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_event_type`
--
ALTER TABLE `film_event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_festival_poster_translation`
--
ALTER TABLE `film_festival_poster_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_film_country`
--
ALTER TABLE `film_film_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_film_media`
--
ALTER TABLE `film_film_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_film_person`
--
ALTER TABLE `film_film_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_film_person_function`
--
ALTER TABLE `film_film_person_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_film_person_translation`
--
ALTER TABLE `film_film_person_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_film_tag`
--
ALTER TABLE `film_film_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_film_translation`
--
ALTER TABLE `film_film_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_function_translation`
--
ALTER TABLE `film_function_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_jury_function_translation`
--
ALTER TABLE `film_jury_function_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_jury_translation`
--
ALTER TABLE `film_jury_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_jury_type_translation`
--
ALTER TABLE `film_jury_type_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_language`
--
ALTER TABLE `film_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_media_category_translation`
--
ALTER TABLE `film_media_category_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_minor_production`
--
ALTER TABLE `film_minor_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_person_media`
--
ALTER TABLE `film_person_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_person_translation`
--
ALTER TABLE `film_person_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_prize_translation`
--
ALTER TABLE `film_prize_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_projection_media`
--
ALTER TABLE `film_projection_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_projection_programmation_dynamic`
--
ALTER TABLE `film_projection_programmation_dynamic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_projection_programmation_film`
--
ALTER TABLE `film_projection_programmation_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_projection_programmation_film_list`
--
ALTER TABLE `film_projection_programmation_film_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_projection_translation`
--
ALTER TABLE `film_projection_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_selection`
--
ALTER TABLE `film_selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_selection_section_translation`
--
ALTER TABLE `film_selection_section_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_selection_subsection`
--
ALTER TABLE `film_selection_subsection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `film_selection_subsection_translation`
--
ALTER TABLE `film_selection_subsection_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fos_user_group`
--
ALTER TABLE `fos_user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `fos_user_user`
--
ALTER TABLE `fos_user_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `gallery_dual_align`
--
ALTER TABLE `gallery_dual_align`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `gallery_dual_align_media`
--
ALTER TABLE `gallery_dual_align_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `gallery_media`
--
ALTER TABLE `gallery_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `homepage_films_associated`
--
ALTER TABLE `homepage_films_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `homepage_slide`
--
ALTER TABLE `homepage_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `homepage_top_videos_associated`
--
ALTER TABLE `homepage_top_videos_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `homepage_top_web_tvs_associated`
--
ALTER TABLE `homepage_top_web_tvs_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `homepage_translation`
--
ALTER TABLE `homepage_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_article_translation`
--
ALTER TABLE `info_article_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_audio_translation`
--
ALTER TABLE `info_audio_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_film_film_associated`
--
ALTER TABLE `info_film_film_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_film_projection_associated`
--
ALTER TABLE `info_film_projection_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_image_translation`
--
ALTER TABLE `info_image_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_info_associated`
--
ALTER TABLE `info_info_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_tag`
--
ALTER TABLE `info_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_video_translation`
--
ALTER TABLE `info_video_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_widget`
--
ALTER TABLE `info_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_widget_quote_translation`
--
ALTER TABLE `info_widget_quote_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_widget_text_translation`
--
ALTER TABLE `info_widget_text_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_widget_video_youtube_translation`
--
ALTER TABLE `info_widget_video_youtube_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_audio_film_film_associated`
--
ALTER TABLE `media_audio_film_film_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_audio_translation`
--
ALTER TABLE `media_audio_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_film_projection_associated`
--
ALTER TABLE `media_film_projection_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_image_simple`
--
ALTER TABLE `media_image_simple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_image_simple_translation`
--
ALTER TABLE `media_image_simple_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_image_translation`
--
ALTER TABLE `media_image_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_tag`
--
ALTER TABLE `media_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_video_film_film_associated`
--
ALTER TABLE `media_video_film_film_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media_video_translation`
--
ALTER TABLE `media_video_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media__gallery`
--
ALTER TABLE `media__gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media__media`
--
ALTER TABLE `media__media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_article_translation`
--
ALTER TABLE `news_article_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_audio_translation`
--
ALTER TABLE `news_audio_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_film_film_associated`
--
ALTER TABLE `news_film_film_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_film_projection_associated`
--
ALTER TABLE `news_film_projection_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_image_translation`
--
ALTER TABLE `news_image_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_news_associated`
--
ALTER TABLE `news_news_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_tag`
--
ALTER TABLE `news_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_video_translation`
--
ALTER TABLE `news_video_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_widget`
--
ALTER TABLE `news_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_widget_quote_translation`
--
ALTER TABLE `news_widget_quote_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_widget_text_translation`
--
ALTER TABLE `news_widget_text_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `news_widget_video_youtube_translation`
--
ALTER TABLE `news_widget_video_youtube_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prefooter`
--
ALTER TABLE `prefooter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_accredit`
--
ALTER TABLE `press_accredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `press_accredit_has_procedure`
--
ALTER TABLE `press_accredit_has_procedure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_accredit_procedure`
--
ALTER TABLE `press_accredit_procedure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_accredit_procedure_translation`
--
ALTER TABLE `press_accredit_procedure_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_accredit_translation`
--
ALTER TABLE `press_accredit_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `press_cinema_map`
--
ALTER TABLE `press_cinema_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `press_cinema_map_room`
--
ALTER TABLE `press_cinema_map_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_cinema_map_translation`
--
ALTER TABLE `press_cinema_map_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `press_cinema_room`
--
ALTER TABLE `press_cinema_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_cinema_room_translation`
--
ALTER TABLE `press_cinema_room_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download`
--
ALTER TABLE `press_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `press_download_has_section`
--
ALTER TABLE `press_download_has_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download_section`
--
ALTER TABLE `press_download_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download_section_translation`
--
ALTER TABLE `press_download_section_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download_section_widget`
--
ALTER TABLE `press_download_section_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download_section_widget_archive_translation`
--
ALTER TABLE `press_download_section_widget_archive_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download_section_widget_document_translation`
--
ALTER TABLE `press_download_section_widget_document_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download_section_widget_file_translation`
--
ALTER TABLE `press_download_section_widget_file_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download_section_widget_video_translation`
--
ALTER TABLE `press_download_section_widget_video_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_download_translation`
--
ALTER TABLE `press_download_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `press_guide`
--
ALTER TABLE `press_guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `press_guide_translation`
--
ALTER TABLE `press_guide_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `press_guide_widget`
--
ALTER TABLE `press_guide_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_guide_widget_column_translation`
--
ALTER TABLE `press_guide_widget_column_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_guide_widget_image_translation`
--
ALTER TABLE `press_guide_widget_image_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_guide_widget_picto_translation`
--
ALTER TABLE `press_guide_widget_picto_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_homepage`
--
ALTER TABLE `press_homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `press_homepage_download`
--
ALTER TABLE `press_homepage_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_homepage_media`
--
ALTER TABLE `press_homepage_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_homepage_section`
--
ALTER TABLE `press_homepage_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `press_homepage_translation`
--
ALTER TABLE `press_homepage_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `press_media_library`
--
ALTER TABLE `press_media_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `press_media_library_translation`
--
ALTER TABLE `press_media_library_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `press_projection`
--
ALTER TABLE `press_projection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `press_projection_translation`
--
ALTER TABLE `press_projection_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `press_statement_info`
--
ALTER TABLE `press_statement_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `press_statement_info_translation`
--
ALTER TABLE `press_statement_info_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `social_graph`
--
ALTER TABLE `social_graph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `social_wall`
--
ALTER TABLE `social_wall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `soif_task`
--
ALTER TABLE `soif_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement`
--
ALTER TABLE `statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_article_translation`
--
ALTER TABLE `statement_article_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_audio_translation`
--
ALTER TABLE `statement_audio_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_film_film_associated`
--
ALTER TABLE `statement_film_film_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_film_projection_associated`
--
ALTER TABLE `statement_film_projection_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_image_translation`
--
ALTER TABLE `statement_image_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_statement_associated`
--
ALTER TABLE `statement_statement_associated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_tag`
--
ALTER TABLE `statement_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_video_translation`
--
ALTER TABLE `statement_video_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_widget`
--
ALTER TABLE `statement_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_widget_quote_translation`
--
ALTER TABLE `statement_widget_quote_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_widget_text_translation`
--
ALTER TABLE `statement_widget_text_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statement_widget_video_youtube_translation`
--
ALTER TABLE `statement_widget_video_youtube_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tag_translation`
--
ALTER TABLE `tag_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `theme_translation`
--
ALTER TABLE `theme_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `web_tv`
--
ALTER TABLE `web_tv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `web_tv_translation`
--
ALTER TABLE `web_tv_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `widget_movie`
--
ALTER TABLE `widget_movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `widget_movie_film_film`
--
ALTER TABLE `widget_movie_film_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acl_entries`
--
ALTER TABLE `acl_entries`
  ADD CONSTRAINT `FK_46C8B8063D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_46C8B806DF9183C9` FOREIGN KEY (`security_identity_id`) REFERENCES `acl_security_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_46C8B806EA000B10` FOREIGN KEY (`class_id`) REFERENCES `acl_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `acl_object_identities`
--
ALTER TABLE `acl_object_identities`
  ADD CONSTRAINT `FK_9407E54977FA751A` FOREIGN KEY (`parent_object_identity_id`) REFERENCES `acl_object_identities` (`id`);

--
-- Contraintes pour la table `acl_object_identity_ancestors`
--
ALTER TABLE `acl_object_identity_ancestors`
  ADD CONSTRAINT `FK_825DE2993D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_825DE299C671CEA1` FOREIGN KEY (`ancestor_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cinef_person`
--
ALTER TABLE `cinef_person`
  ADD CONSTRAINT `FK_905D60B5217BBB47` FOREIGN KEY (`person_id`) REFERENCES `film_person` (`id`),
  ADD CONSTRAINT `FK_905D60B5613FECDF` FOREIGN KEY (`session_id`) REFERENCES `cinef_session` (`id`);

--
-- Contraintes pour la table `contact_page_translation`
--
ALTER TABLE `contact_page_translation`
  ADD CONSTRAINT `FK_622F11892C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `contact_page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_622F11897A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `contact_theme_translation`
--
ALTER TABLE `contact_theme_translation`
  ADD CONSTRAINT `FK_ABE1FB372C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `contact_theme` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ABE1FB377A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `country_translation`
--
ALTER TABLE `country_translation`
  ADD CONSTRAINT `FK_A1FE6FA42C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `country` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A1FE6FA47A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA72EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA73AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA759027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA78AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `event_film_projection_associated`
--
ALTER TABLE `event_film_projection_associated`
  ADD CONSTRAINT `FK_5B2CDC6871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_5B2CDC68EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_projection` (`id`);

--
-- Contraintes pour la table `event_site`
--
ALTER TABLE `event_site`
  ADD CONSTRAINT `FK_7688454F71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7688454FF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_translation`
--
ALTER TABLE `event_translation`
  ADD CONSTRAINT `FK_1FE096EF2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1FE096EF7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `event_widget`
--
ALTER TABLE `event_widget`
  ADD CONSTRAINT `FK_B76069829D6A1065` FOREIGN KEY (`events_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `event_widget_audio`
--
ALTER TABLE `event_widget_audio`
  ADD CONSTRAINT `FK_AE28657093CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_AE286570BF396750` FOREIGN KEY (`id`) REFERENCES `event_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_image`
--
ALTER TABLE `event_widget_image`
  ADD CONSTRAINT `FK_736857BA4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_736857BABF396750` FOREIGN KEY (`id`) REFERENCES `event_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_image_dual_align`
--
ALTER TABLE `event_widget_image_dual_align`
  ADD CONSTRAINT `FK_7EECDF274E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_7EECDF27BF396750` FOREIGN KEY (`id`) REFERENCES `event_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_quote`
--
ALTER TABLE `event_widget_quote`
  ADD CONSTRAINT `FK_DD249811BF396750` FOREIGN KEY (`id`) REFERENCES `event_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_quote_translation`
--
ALTER TABLE `event_widget_quote_translation`
  ADD CONSTRAINT `FK_BD4343D72C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `event_widget_quote` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_subtitle`
--
ALTER TABLE `event_widget_subtitle`
  ADD CONSTRAINT `FK_743B2EA0BF396750` FOREIGN KEY (`id`) REFERENCES `event_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_subtitle_translation`
--
ALTER TABLE `event_widget_subtitle_translation`
  ADD CONSTRAINT `FK_7B940C4E2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `event_widget_subtitle` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_text`
--
ALTER TABLE `event_widget_text`
  ADD CONSTRAINT `FK_8F57FF8BF396750` FOREIGN KEY (`id`) REFERENCES `event_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_text_translation`
--
ALTER TABLE `event_widget_text_translation`
  ADD CONSTRAINT `FK_88322C8B2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `event_widget_text` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_video`
--
ALTER TABLE `event_widget_video`
  ADD CONSTRAINT `FK_CA9289C993CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_CA9289C9BF396750` FOREIGN KEY (`id`) REFERENCES `event_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_video_youtube`
--
ALTER TABLE `event_widget_video_youtube`
  ADD CONSTRAINT `FK_F5CCC463DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_F5CCC46BF396750` FOREIGN KEY (`id`) REFERENCES `event_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_widget_video_youtube_translation`
--
ALTER TABLE `event_widget_video_youtube_translation`
  ADD CONSTRAINT `FK_E2A8F2212C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `event_widget_video_youtube` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcevent_routes`
--
ALTER TABLE `fdcevent_routes`
  ADD CONSTRAINT `FK_EAC657DA727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `fdcevent_routes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_award`
--
ALTER TABLE `fdcpage_award`
  ADD CONSTRAINT `FK_4C505D083AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_4C505D083DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_4C505D086ABBE443` FOREIGN KEY (`selection_longs_metrages_id`) REFERENCES `film_selection_section` (`id`),
  ADD CONSTRAINT `FK_4C505D08B38AC4F3` FOREIGN KEY (`selection_courts_metrages_id`) REFERENCES `film_selection_section` (`id`);

--
-- Contraintes pour la table `fdcpage_award_other_selection_sections_associated`
--
ALTER TABLE `fdcpage_award_other_selection_sections_associated`
  ADD CONSTRAINT `FK_A57058A2C2CE629` FOREIGN KEY (`fdcpage_award_id`) REFERENCES `fdcpage_award` (`id`),
  ADD CONSTRAINT `FK_A57058A2EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_selection_section` (`id`);

--
-- Contraintes pour la table `fdcpage_award_translation`
--
ALTER TABLE `fdcpage_award_translation`
  ADD CONSTRAINT `FK_DE4067172C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_award` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DE4067177A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_event`
--
ALTER TABLE `fdcpage_event`
  ADD CONSTRAINT `FK_FDA579483AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `fdcpage_event_translation`
--
ALTER TABLE `fdcpage_event_translation`
  ADD CONSTRAINT `FK_711CBFB12C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_711CBFB17A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_jury`
--
ALTER TABLE `fdcpage_jury`
  ADD CONSTRAINT `FK_149FED163AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_149FED163DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_149FED164C5F2E1B` FOREIGN KEY (`jury_type_id`) REFERENCES `film_jury_type` (`id`);

--
-- Contraintes pour la table `fdcpage_jury_translation`
--
ALTER TABLE `fdcpage_jury_translation`
  ADD CONSTRAINT `FK_24DC91342C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_jury` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_24DC91347A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_la_selection`
--
ALTER TABLE `fdcpage_la_selection`
  ADD CONSTRAINT `FK_A3CC42F83AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_A3CC42F83DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_A3CC42F8C0EC7461` FOREIGN KEY (`selection_section_id`) REFERENCES `film_selection_section` (`id`);

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics`
  ADD CONSTRAINT `FK_4E15E63A3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_4E15E63A3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_4E15E63A896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_4E15E63AB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_translation`
  ADD CONSTRAINT `FK_C9DD2292C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_la_selection_cannes_classics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C9DD2297A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget`
  ADD CONSTRAINT `FK_630FCC2C2A4415B9` FOREIGN KEY (`fdcpage_la_selection_cannes_classics_id`) REFERENCES `fdcpage_la_selection_cannes_classics` (`id`);

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_audio`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_audio`
  ADD CONSTRAINT `FK_DC3C7FB193CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_DC3C7FB1BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_image`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_image`
  ADD CONSTRAINT `FK_17C4D7B4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_17C4D7BBF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_image_dual_align`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_image_dual_align`
  ADD CONSTRAINT `FK_311EB8264E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery_dual_align` (`id`),
  ADD CONSTRAINT `FK_311EB826BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_intro`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_intro`
  ADD CONSTRAINT `FK_DE448C04BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_intro_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_intro_translation`
  ADD CONSTRAINT `FK_DFBD56C72C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget_intro` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_movie`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_movie`
  ADD CONSTRAINT `FK_D91FBB4B63FE6BDD` FOREIGN KEY (`widget_movie_id`) REFERENCES `widget_movie` (`id`),
  ADD CONSTRAINT `FK_D91FBB4BBF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_quote`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_quote`
  ADD CONSTRAINT `FK_AF3082D0BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_quote_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_quote_translation`
  ADD CONSTRAINT `FK_CA0B81262C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget_quote` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_subtitle`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_subtitle`
  ADD CONSTRAINT `FK_4EA1FC03BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_subtitle_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_subtitle_translation`
  ADD CONSTRAINT `FK_4E5969B02C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget_subtitle` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_text`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_text`
  ADD CONSTRAINT `FK_1B883B3EBF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_text_translation`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_text_translation`
  ADD CONSTRAINT `FK_C7C04B8A2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget_text` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_video`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_video`
  ADD CONSTRAINT `FK_B886930893CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_B8869308BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cannes_classics_widget_video_youtube`
--
ALTER TABLE `fdcpage_la_selection_cannes_classics_widget_video_youtube`
  ADD CONSTRAINT `FK_61ABBB4D3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_61ABBB4DBF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_la_selection_cinema_plage`
--
ALTER TABLE `fdcpage_la_selection_cinema_plage`
  ADD CONSTRAINT `FK_B4BCC7923AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_B4BCC7923DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_B4BCC792896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_B4BCC792B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_la_selection_cinema_plage_translation`
--
ALTER TABLE `fdcpage_la_selection_cinema_plage_translation`
  ADD CONSTRAINT `FK_63E028C72C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_la_selection_cinema_plage` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_63E028C77A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_la_selection_translation`
--
ALTER TABLE `fdcpage_la_selection_translation`
  ADD CONSTRAINT `FK_99DB9F532C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_la_selection` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_99DB9F537A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_news_articles`
--
ALTER TABLE `fdcpage_news_articles`
  ADD CONSTRAINT `FK_7D0182FA3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `fdcpage_news_articles_translation`
--
ALTER TABLE `fdcpage_news_articles_translation`
  ADD CONSTRAINT `FK_85CD32062C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_news_articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_85CD32067A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_news_audios`
--
ALTER TABLE `fdcpage_news_audios`
  ADD CONSTRAINT `FK_C9948393AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `fdcpage_news_audios_translation`
--
ALTER TABLE `fdcpage_news_audios_translation`
  ADD CONSTRAINT `FK_D45553992C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_news_audios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D45553997A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_news_images`
--
ALTER TABLE `fdcpage_news_images`
  ADD CONSTRAINT `FK_77F523A53AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `fdcpage_news_images_translation`
--
ALTER TABLE `fdcpage_news_images_translation`
  ADD CONSTRAINT `FK_7758348E2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_news_images` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7758348E7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_news_videos`
--
ALTER TABLE `fdcpage_news_videos`
  ADD CONSTRAINT `FK_BE40F9FD3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `fdcpage_news_videos_translation`
--
ALTER TABLE `fdcpage_news_videos_translation`
  ADD CONSTRAINT `FK_DC645D2D2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_news_videos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DC645D2D7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_participate`
--
ALTER TABLE `fdcpage_participate`
  ADD CONSTRAINT `FK_1641EF833AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_1641EF833DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `fdcpage_participate_has_section`
--
ALTER TABLE `fdcpage_participate_has_section`
  ADD CONSTRAINT `FK_19091DDEC667AEAB` FOREIGN KEY (`download_id`) REFERENCES `fdcpage_participate` (`id`),
  ADD CONSTRAINT `FK_19091DDED823E37A` FOREIGN KEY (`section_id`) REFERENCES `fdcpage_participate_section` (`id`);

--
-- Contraintes pour la table `fdcpage_participate_section_translation`
--
ALTER TABLE `fdcpage_participate_section_translation`
  ADD CONSTRAINT `FK_4D0422502C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_participate_section` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4D0422507A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_participate_section_widget`
--
ALTER TABLE `fdcpage_participate_section_widget`
  ADD CONSTRAINT `FK_9636FFB43AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_9636FFB4F61B0E32` FOREIGN KEY (`press_download_id`) REFERENCES `fdcpage_participate_section` (`id`);

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typefive`
--
ALTER TABLE `fdcpage_participate_section_widget_typefive`
  ADD CONSTRAINT `FK_6E4184F1BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_participate_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typefive_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typefive_translation`
  ADD CONSTRAINT `FK_171D255F2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_participate_section_widget_typefive` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typefour`
--
ALTER TABLE `fdcpage_participate_section_widget_typefour`
  ADD CONSTRAINT `FK_C2322E473DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_C2322E47BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_participate_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typefour_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typefour_translation`
  ADD CONSTRAINT `FK_80F274F42C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_participate_section_widget_typefour` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typeone`
--
ALTER TABLE `fdcpage_participate_section_widget_typeone`
  ADD CONSTRAINT `FK_E1C68A423DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_E1C68A42BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_participate_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typeone_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typeone_translation`
  ADD CONSTRAINT `FK_FB2E58AB2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_participate_section_widget_typeone` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typethree`
--
ALTER TABLE `fdcpage_participate_section_widget_typethree`
  ADD CONSTRAINT `FK_809BF20FBF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_participate_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typethree_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typethree_translation`
  ADD CONSTRAINT `FK_16F1C51C2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_participate_section_widget_typethree` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typetwo`
--
ALTER TABLE `fdcpage_participate_section_widget_typetwo`
  ADD CONSTRAINT `FK_8A6086D53DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_8A6086D5A53D6BDF` FOREIGN KEY (`sponsor_image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_8A6086D5BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_participate_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_section_widget_typetwo_translation`
--
ALTER TABLE `fdcpage_participate_section_widget_typetwo_translation`
  ADD CONSTRAINT `FK_9303C4102C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_participate_section_widget_typetwo` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_participate_translation`
--
ALTER TABLE `fdcpage_participate_translation`
  ADD CONSTRAINT `FK_E7E24A852C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_participate` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E7E24A857A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_prepare`
--
ALTER TABLE `fdcpage_prepare`
  ADD CONSTRAINT `FK_742DDD243AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_742DDD24B1931E1` FOREIGN KEY (`meeting_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_742DDD24E4873418` FOREIGN KEY (`main_image_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `fdcpage_prepare_translation`
--
ALTER TABLE `fdcpage_prepare_translation`
  ADD CONSTRAINT `FK_22C4A8132C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_prepare` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_22C4A8137A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_prepare_widget`
--
ALTER TABLE `fdcpage_prepare_widget`
  ADD CONSTRAINT `FK_3494375330ACF257` FOREIGN KEY (`fdcpage_prepare_information_id`) REFERENCES `fdcpage_prepare` (`id`),
  ADD CONSTRAINT `FK_349437533AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_3494375349195BAC` FOREIGN KEY (`fdcpage_prepare_service_id`) REFERENCES `fdcpage_prepare` (`id`),
  ADD CONSTRAINT `FK_349437536034A12E` FOREIGN KEY (`fdcpage_prepare_arrive_id`) REFERENCES `fdcpage_prepare` (`id`),
  ADD CONSTRAINT `FK_34943753C306CFD6` FOREIGN KEY (`fdcpage_prepare_meeting_id`) REFERENCES `fdcpage_prepare` (`id`);

--
-- Contraintes pour la table `fdcpage_prepare_widget_column`
--
ALTER TABLE `fdcpage_prepare_widget_column`
  ADD CONSTRAINT `FK_D4ED4AE43DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_D4ED4AE493CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_D4ED4AE4BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_prepare_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_prepare_widget_column_translation`
--
ALTER TABLE `fdcpage_prepare_widget_column_translation`
  ADD CONSTRAINT `FK_1E5718992C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_prepare_widget_column` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_prepare_widget_image`
--
ALTER TABLE `fdcpage_prepare_widget_image`
  ADD CONSTRAINT `FK_C75ECDB34E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_C75ECDB3BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_prepare_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_prepare_widget_image_translation`
--
ALTER TABLE `fdcpage_prepare_widget_image_translation`
  ADD CONSTRAINT `FK_F8E2C5882C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_prepare_widget_image` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_prepare_widget_picto`
--
ALTER TABLE `fdcpage_prepare_widget_picto`
  ADD CONSTRAINT `FK_A772D3F5BF396750` FOREIGN KEY (`id`) REFERENCES `fdcpage_prepare_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_prepare_widget_picto_translation`
--
ALTER TABLE `fdcpage_prepare_widget_picto_translation`
  ADD CONSTRAINT `FK_D23E5AAF2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_prepare_widget_picto` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fdcpage_waiting`
--
ALTER TABLE `fdcpage_waiting`
  ADD CONSTRAINT `FK_783084003AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_78308400684EC833` FOREIGN KEY (`banner_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_78308400C4663E4` FOREIGN KEY (`page_id`) REFERENCES `fdcevent_routes` (`id`);

--
-- Contraintes pour la table `fdcpage_waiting_translation`
--
ALTER TABLE `fdcpage_waiting_translation`
  ADD CONSTRAINT `FK_E6452792C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_waiting` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E6452797A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_web_tv_channels`
--
ALTER TABLE `fdcpage_web_tv_channels`
  ADD CONSTRAINT `FK_11A1E5A03AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_11A1E5A03DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_11A1E5A0F6A6B57E` FOREIGN KEY (`sticky_id`) REFERENCES `web_tv` (`id`);

--
-- Contraintes pour la table `fdcpage_web_tv_channels_translation`
--
ALTER TABLE `fdcpage_web_tv_channels_translation`
  ADD CONSTRAINT `FK_39617BB12C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_web_tv_channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_39617BB17A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_web_tv_live`
--
ALTER TABLE `fdcpage_web_tv_live`
  ADD CONSTRAINT `FK_63D49E163AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_63D49E163DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `fdcpage_web_tv_live_media_video_associated`
--
ALTER TABLE `fdcpage_web_tv_live_media_video_associated`
  ADD CONSTRAINT `FK_6F18B9EF1096ABC8` FOREIGN KEY (`fdcpage_web_tv_live_id`) REFERENCES `fdcpage_web_tv_live` (`id`),
  ADD CONSTRAINT `FK_6F18B9EFEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `media_video` (`id`);

--
-- Contraintes pour la table `fdcpage_web_tv_live_translation`
--
ALTER TABLE `fdcpage_web_tv_live_translation`
  ADD CONSTRAINT `FK_B184F78D2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_web_tv_live` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B184F78D7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdcpage_web_tv_live_web_tv_associated`
--
ALTER TABLE `fdcpage_web_tv_live_web_tv_associated`
  ADD CONSTRAINT `FK_2C8001BA1096ABC8` FOREIGN KEY (`fdcpage_web_tv_live_id`) REFERENCES `fdcpage_web_tv_live` (`id`),
  ADD CONSTRAINT `FK_2C8001BAEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `web_tv` (`id`);

--
-- Contraintes pour la table `fdcpage_web_tv_trailers`
--
ALTER TABLE `fdcpage_web_tv_trailers`
  ADD CONSTRAINT `FK_681935563AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_681935563DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_68193556C0EC7461` FOREIGN KEY (`selection_section_id`) REFERENCES `film_selection_section` (`id`);

--
-- Contraintes pour la table `fdcpage_web_tv_trailers_translation`
--
ALTER TABLE `fdcpage_web_tv_trailers_translation`
  ADD CONSTRAINT `FK_5CAF66BD2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_web_tv_trailers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5CAF66BD7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fdc_page_la_selection_cc_widget_video_yb_translation`
--
ALTER TABLE `fdc_page_la_selection_cc_widget_video_yb_translation`
  ADD CONSTRAINT `FK_CA7BFAE02C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `fdcpage_la_selection_cannes_classics_widget_video_youtube` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `film_address`
--
ALTER TABLE `film_address`
  ADD CONSTRAINT `FK_EDF074A2F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `film_address_translation`
--
ALTER TABLE `film_address_translation`
  ADD CONSTRAINT `FK_EBD716422C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_address` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EBD716427A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_atelier`
--
ALTER TABLE `film_atelier`
  ADD CONSTRAINT `FK_10503008AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_1050300C0EC7461` FOREIGN KEY (`selection_section_id`) REFERENCES `film_selection_section` (`id`),
  ADD CONSTRAINT `FK_1050300F13ABE4D` FOREIGN KEY (`production_company_id`) REFERENCES `film_atelier_production_company` (`id`);

--
-- Contraintes pour la table `film_atelier_country`
--
ALTER TABLE `film_atelier_country`
  ADD CONSTRAINT `FK_7B7E8A85567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_atelier` (`id`),
  ADD CONSTRAINT `FK_7B7E8A85F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `film_atelier_language`
--
ALTER TABLE `film_atelier_language`
  ADD CONSTRAINT `FK_EDF0CF34567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_atelier` (`id`),
  ADD CONSTRAINT `FK_EDF0CF34F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `film_atelier_person`
--
ALTER TABLE `film_atelier_person`
  ADD CONSTRAINT `FK_3B27AC4E217BBB47` FOREIGN KEY (`person_id`) REFERENCES `film_person` (`id`),
  ADD CONSTRAINT `FK_3B27AC4E567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_atelier` (`id`);

--
-- Contraintes pour la table `film_atelier_person_function`
--
ALTER TABLE `film_atelier_person_function`
  ADD CONSTRAINT `FK_6B7B89773D06627D` FOREIGN KEY (`film_atelier_id`) REFERENCES `film_atelier_person` (`id`),
  ADD CONSTRAINT `FK_6B7B897767048801` FOREIGN KEY (`function_id`) REFERENCES `film_function` (`id`);

--
-- Contraintes pour la table `film_atelier_production_company`
--
ALTER TABLE `film_atelier_production_company`
  ADD CONSTRAINT `FK_4A2C6323F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `film_atelier_production_company_address` (`id`);

--
-- Contraintes pour la table `film_atelier_production_company_address`
--
ALTER TABLE `film_atelier_production_company_address`
  ADD CONSTRAINT `FK_D68C3894F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `film_atelier_production_company_address_translation`
--
ALTER TABLE `film_atelier_production_company_address_translation`
  ADD CONSTRAINT `FK_8C8035972C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_atelier_production_company_address` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8C8035977A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_atelier_translation`
--
ALTER TABLE `film_atelier_translation`
  ADD CONSTRAINT `FK_82644E972C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_atelier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_82644E977A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_award`
--
ALTER TABLE `film_award`
  ADD CONSTRAINT `FK_1337D0B78AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_1337D0B7BBE43214` FOREIGN KEY (`prize_id`) REFERENCES `film_prize` (`id`);

--
-- Contraintes pour la table `film_award_association`
--
ALTER TABLE `film_award_association`
  ADD CONSTRAINT `FK_B3732C17217BBB47` FOREIGN KEY (`person_id`) REFERENCES `film_person` (`id`),
  ADD CONSTRAINT `FK_B3732C173D5282CF` FOREIGN KEY (`award_id`) REFERENCES `film_award` (`id`),
  ADD CONSTRAINT `FK_B3732C17567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`);

--
-- Contraintes pour la table `film_contact`
--
ALTER TABLE `film_contact`
  ADD CONSTRAINT `FK_ACDCFD1B217BBB47` FOREIGN KEY (`person_id`) REFERENCES `film_contact_person` (`id`),
  ADD CONSTRAINT `FK_ACDCFD1BF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `film_address` (`id`);

--
-- Contraintes pour la table `film_contact_film_contact`
--
ALTER TABLE `film_contact_film_contact`
  ADD CONSTRAINT `FK_C94AF91221D46EE6` FOREIGN KEY (`film_contact_source`) REFERENCES `film_contact` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C94AF91238313E69` FOREIGN KEY (`film_contact_target`) REFERENCES `film_contact` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `film_contact_person_film_contact_person`
--
ALTER TABLE `film_contact_person_film_contact_person`
  ADD CONSTRAINT `FK_CE6E173FA37331EA` FOREIGN KEY (`film_contact_person_target`) REFERENCES `film_contact_person` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CE6E173FBA966165` FOREIGN KEY (`film_contact_person_source`) REFERENCES `film_contact_person` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `film_event`
--
ALTER TABLE `film_event`
  ADD CONSTRAINT `FK_A2C2F4F7401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `film_event_type` (`id`);

--
-- Contraintes pour la table `film_festival_poster`
--
ALTER TABLE `film_festival_poster`
  ADD CONSTRAINT `FK_D09388568AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_D093885693CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `film_festival_poster_translation`
--
ALTER TABLE `film_festival_poster_translation`
  ADD CONSTRAINT `FK_CA2BAE742C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_festival_poster` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CA2BAE747A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_film`
--
ALTER TABLE `film_film`
  ADD CONSTRAINT `FK_E7EB54211DD7A841` FOREIGN KEY (`image_cover_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_E7EB542187934E27` FOREIGN KEY (`video_main_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_E7EB54218AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_E7EB5421C0EC7461` FOREIGN KEY (`selection_section_id`) REFERENCES `film_selection_section` (`id`),
  ADD CONSTRAINT `FK_E7EB5421E48EFE78` FOREIGN KEY (`selection_id`) REFERENCES `film_selection` (`id`),
  ADD CONSTRAINT `FK_E7EB5421F76EF056` FOREIGN KEY (`image_main_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `film_film_country`
--
ALTER TABLE `film_film_country`
  ADD CONSTRAINT `FK_230A77F9567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_230A77F9F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `film_film_film_contact`
--
ALTER TABLE `film_film_film_contact`
  ADD CONSTRAINT `FK_76385E5A58458802` FOREIGN KEY (`film_contact_id`) REFERENCES `film_contact` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_76385E5AB6C14AA0` FOREIGN KEY (`film_film_id`) REFERENCES `film_film` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `film_film_media`
--
ALTER TABLE `film_film_media`
  ADD CONSTRAINT `FK_4CA4F214567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_4CA4F214EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `film_media` (`id`);

--
-- Contraintes pour la table `film_film_person`
--
ALTER TABLE `film_film_person`
  ADD CONSTRAINT `FK_2796C173217BBB47` FOREIGN KEY (`person_id`) REFERENCES `film_person` (`id`),
  ADD CONSTRAINT `FK_2796C173567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`);

--
-- Contraintes pour la table `film_film_person_function`
--
ALTER TABLE `film_film_person_function`
  ADD CONSTRAINT `FK_DFD9D6C15B7E574` FOREIGN KEY (`film_person_id`) REFERENCES `film_film_person` (`id`),
  ADD CONSTRAINT `FK_DFD9D6C67048801` FOREIGN KEY (`function_id`) REFERENCES `film_function` (`id`);

--
-- Contraintes pour la table `film_film_person_translation`
--
ALTER TABLE `film_film_person_translation`
  ADD CONSTRAINT `FK_F30240E12C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_film_person` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F30240E17A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_film_tag`
--
ALTER TABLE `film_film_tag`
  ADD CONSTRAINT `FK_BE3DBDB2567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_BE3DBDB2BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `film_film_translation`
--
ALTER TABLE `film_film_translation`
  ADD CONSTRAINT `FK_3072D4042C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_film` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3072D4047A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_function_translation`
--
ALTER TABLE `film_function_translation`
  ADD CONSTRAINT `FK_F5484B7A2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_function` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F5484B7A7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_jury`
--
ALTER TABLE `film_jury`
  ADD CONSTRAINT `FK_769A5A2F217BBB47` FOREIGN KEY (`person_id`) REFERENCES `film_person` (`id`),
  ADD CONSTRAINT `FK_769A5A2F67048801` FOREIGN KEY (`function_id`) REFERENCES `film_jury_function` (`id`),
  ADD CONSTRAINT `FK_769A5A2F8AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_769A5A2FC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `film_jury_type` (`id`);

--
-- Contraintes pour la table `film_jury_function_translation`
--
ALTER TABLE `film_jury_function_translation`
  ADD CONSTRAINT `FK_6B0C226A2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_jury_function` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6B0C226A7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_jury_translation`
--
ALTER TABLE `film_jury_translation`
  ADD CONSTRAINT `FK_4F5094C72C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_jury` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4F5094C77A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_jury_type_translation`
--
ALTER TABLE `film_jury_type_translation`
  ADD CONSTRAINT `FK_FD3D7E3C2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_jury_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FD3D7E3C7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_language`
--
ALTER TABLE `film_language`
  ADD CONSTRAINT `FK_765CBEDC567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_765CBEDCF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `film_media`
--
ALTER TABLE `film_media`
  ADD CONSTRAINT `FK_F3405F5C12469DE2` FOREIGN KEY (`category_id`) REFERENCES `film_media_category` (`id`),
  ADD CONSTRAINT `FK_F3405F5C3D06627D` FOREIGN KEY (`film_atelier_id`) REFERENCES `film_atelier` (`id`),
  ADD CONSTRAINT `FK_F3405F5C71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `film_event` (`id`),
  ADD CONSTRAINT `FK_F3405F5C8AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_F3405F5C93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_F3405F5CD5F3BFB5` FOREIGN KEY (`cinef_person_id`) REFERENCES `cinef_person` (`id`),
  ADD CONSTRAINT `FK_F3405F5CE560103C` FOREIGN KEY (`jury_id`) REFERENCES `film_jury` (`id`);

--
-- Contraintes pour la table `film_media_category_translation`
--
ALTER TABLE `film_media_category_translation`
  ADD CONSTRAINT `FK_5F11E3702C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_media_category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5F11E3707A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_minor_production`
--
ALTER TABLE `film_minor_production`
  ADD CONSTRAINT `FK_69CA50BE567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`);

--
-- Contraintes pour la table `film_person`
--
ALTER TABLE `film_person`
  ADD CONSTRAINT `FK_5F2EEC7C13AB50FB` FOREIGN KEY (`landscape_image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_5F2EEC7C1C9DA55` FOREIGN KEY (`nationality_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `FK_5F2EEC7CD44A1F79` FOREIGN KEY (`president_jury_image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_5F2EEC7CDFD9EEDC` FOREIGN KEY (`nationality2_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `FK_5F2EEC7CF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `film_function` (`id`),
  ADD CONSTRAINT `FK_5F2EEC7CFE19244` FOREIGN KEY (`portrait_image_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `film_person_media`
--
ALTER TABLE `film_person_media`
  ADD CONSTRAINT `FK_56DD1B74217BBB47` FOREIGN KEY (`person_id`) REFERENCES `film_person` (`id`),
  ADD CONSTRAINT `FK_56DD1B74EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `film_media` (`id`);

--
-- Contraintes pour la table `film_person_translation`
--
ALTER TABLE `film_person_translation`
  ADD CONSTRAINT `FK_1AC4B7402C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_person` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1AC4B7407A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_prize_translation`
--
ALTER TABLE `film_prize_translation`
  ADD CONSTRAINT `FK_3177CCA82C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_prize` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3177CCA87A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_projection`
--
ALTER TABLE `film_projection`
  ADD CONSTRAINT `FK_3FE0656E54177093` FOREIGN KEY (`room_id`) REFERENCES `film_projection_room` (`id`),
  ADD CONSTRAINT `FK_3FE0656E8AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`);

--
-- Contraintes pour la table `film_projection_media`
--
ALTER TABLE `film_projection_media`
  ADD CONSTRAINT `FK_7A7038125ECF66BD` FOREIGN KEY (`projection_id`) REFERENCES `film_projection` (`id`),
  ADD CONSTRAINT `FK_7A70381293CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `film_projection_programmation_dynamic`
--
ALTER TABLE `film_projection_programmation_dynamic`
  ADD CONSTRAINT `FK_D272BA415ECF66BD` FOREIGN KEY (`projection_id`) REFERENCES `film_projection` (`id`),
  ADD CONSTRAINT `FK_D272BA41C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `film_projection_programmation_type` (`id`);

--
-- Contraintes pour la table `film_projection_programmation_film`
--
ALTER TABLE `film_projection_programmation_film`
  ADD CONSTRAINT `FK_65A696F6567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_65A696F65ECF66BD` FOREIGN KEY (`projection_id`) REFERENCES `film_projection` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_65A696F6C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `film_projection_programmation_type` (`id`);

--
-- Contraintes pour la table `film_projection_programmation_film_list`
--
ALTER TABLE `film_projection_programmation_film_list`
  ADD CONSTRAINT `FK_83CD2DB65ECF66BD` FOREIGN KEY (`projection_id`) REFERENCES `film_projection` (`id`),
  ADD CONSTRAINT `FK_83CD2DB6C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `film_projection_programmation_type` (`id`);

--
-- Contraintes pour la table `film_projection_programmation_film_list_film_film`
--
ALTER TABLE `film_projection_programmation_film_list_film_film`
  ADD CONSTRAINT `FK_27CC93F626DA3F3` FOREIGN KEY (`film_projection_programmation_film_list_id`) REFERENCES `film_projection_programmation_film_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_27CC93FB6C14AA0` FOREIGN KEY (`film_film_id`) REFERENCES `film_film` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `film_projection_translation`
--
ALTER TABLE `film_projection_translation`
  ADD CONSTRAINT `FK_CC5E708F2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_projection` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CC5E708F7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_selection_section`
--
ALTER TABLE `film_selection_section`
  ADD CONSTRAINT `FK_CFF7DAF38AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_CFF7DAF3E48EFE78` FOREIGN KEY (`selection_id`) REFERENCES `film_selection` (`id`);

--
-- Contraintes pour la table `film_selection_section_translation`
--
ALTER TABLE `film_selection_section_translation`
  ADD CONSTRAINT `FK_A1D920332C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_selection_section` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A1D920337A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `film_selection_subsection`
--
ALTER TABLE `film_selection_subsection`
  ADD CONSTRAINT `FK_37FF7306E48EFE78` FOREIGN KEY (`selection_id`) REFERENCES `film_selection` (`id`);

--
-- Contraintes pour la table `film_selection_subsection_translation`
--
ALTER TABLE `film_selection_subsection_translation`
  ADD CONSTRAINT `FK_C93E1C8C2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `film_selection_subsection` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C93E1C8C7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_user_group` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gallery_dual_align_media`
--
ALTER TABLE `gallery_dual_align_media`
  ADD CONSTRAINT `FK_797B26484E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery_dual_align` (`id`),
  ADD CONSTRAINT `FK_797B2648EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_image` (`id`);

--
-- Contraintes pour la table `gallery_media`
--
ALTER TABLE `gallery_media`
  ADD CONSTRAINT `FK_8EB1712F4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_8EB1712FEA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_image` (`id`);

--
-- Contraintes pour la table `homepage`
--
ALTER TABLE `homepage`
  ADD CONSTRAINT `FK_CB24D5EE13612BD0` FOREIGN KEY (`pushs_secondary_image4_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE1A1D791F` FOREIGN KEY (`pushs_main_image2_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE1D4843E` FOREIGN KEY (`pushs_secondary_image7_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE24BFDBE2` FOREIGN KEY (`pushs_secondary_image1_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE360A740C` FOREIGN KEY (`pushs_secondary_image2_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE59B79468` FOREIGN KEY (`pushs_secondary_image8_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE5F763FE0` FOREIGN KEY (`prefooter_image4_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE68A8CFD2` FOREIGN KEY (`prefooter_image1_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE7A1D603C` FOREIGN KEY (`prefooter_image2_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE8A8D6F1` FOREIGN KEY (`pushs_main_image1_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE8AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_CB24D5EE8EB61369` FOREIGN KEY (`pushs_secondary_image3_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EEA2A11E7A` FOREIGN KEY (`pushs_main_image3_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EEABDD4CB5` FOREIGN KEY (`pushs_secondary_image5_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EEB968E35B` FOREIGN KEY (`pushs_secondary_image6_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_CB24D5EEC2A10759` FOREIGN KEY (`prefooter_image3_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `homepage_films_associated`
--
ALTER TABLE `homepage_films_associated`
  ADD CONSTRAINT `FK_95278A99229BF7D0` FOREIGN KEY (`tablet_image_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_95278A9929C1004E` FOREIGN KEY (`video_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_95278A99571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_95278A99EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_95278A99F0928933` FOREIGN KEY (`mobile_image_id`) REFERENCES `media_image` (`id`);

--
-- Contraintes pour la table `homepage_slide`
--
ALTER TABLE `homepage_slide`
  ADD CONSTRAINT `FK_2726C9ED544A4CCA` FOREIGN KEY (`infos_id`) REFERENCES `info` (`id`),
  ADD CONSTRAINT `FK_2726C9ED571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_2726C9ED849CB65B` FOREIGN KEY (`statement_id`) REFERENCES `statement` (`id`),
  ADD CONSTRAINT `FK_2726C9EDB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`);

--
-- Contraintes pour la table `homepage_top_videos_associated`
--
ALTER TABLE `homepage_top_videos_associated`
  ADD CONSTRAINT `FK_CD16BC5F571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_CD16BC5FEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `media_video` (`id`);

--
-- Contraintes pour la table `homepage_top_web_tvs_associated`
--
ALTER TABLE `homepage_top_web_tvs_associated`
  ADD CONSTRAINT `FK_8F0911BE571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_8F0911BEEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `web_tv` (`id`);

--
-- Contraintes pour la table `homepage_translation`
--
ALTER TABLE `homepage_translation`
  ADD CONSTRAINT `FK_495C5DA12C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `homepage` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `FK_CB8931573AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_CB8931574D36AEC7` FOREIGN KEY (`associated_film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_CB893157571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_CB89315759027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_CB8931575D24FD` FOREIGN KEY (`associated_event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_CB893157896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_CB8931578AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_CB893157B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `info_article`
--
ALTER TABLE `info_article`
  ADD CONSTRAINT `FK_80FF27F82EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_80FF27F8BF396750` FOREIGN KEY (`id`) REFERENCES `info` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_article_translation`
--
ALTER TABLE `info_article_translation`
  ADD CONSTRAINT `FK_80E022742C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `info_article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_80E022747A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `info_audio`
--
ALTER TABLE `info_audio`
  ADD CONSTRAINT `FK_1224F3602EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_1224F3603A3123C7` FOREIGN KEY (`audio_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_1224F360BF396750` FOREIGN KEY (`id`) REFERENCES `info` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_audio_translation`
--
ALTER TABLE `info_audio_translation`
  ADD CONSTRAINT `FK_162753A92C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `info_audio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_162753A97A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `info_film_film_associated`
--
ALTER TABLE `info_film_film_associated`
  ADD CONSTRAINT `FK_2F18D2DF5D8BC1F8` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`),
  ADD CONSTRAINT `FK_2F18D2DFEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_film` (`id`);

--
-- Contraintes pour la table `info_film_projection_associated`
--
ALTER TABLE `info_film_projection_associated`
  ADD CONSTRAINT `FK_937BCD885D8BC1F8` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`),
  ADD CONSTRAINT `FK_937BCD88EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_projection` (`id`);

--
-- Contraintes pour la table `info_image`
--
ALTER TABLE `info_image`
  ADD CONSTRAINT `FK_CF64C1AA2EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_CF64C1AA4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_CF64C1AABF396750` FOREIGN KEY (`id`) REFERENCES `info` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_image_translation`
--
ALTER TABLE `info_image_translation`
  ADD CONSTRAINT `FK_A74030CB2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `info_image` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A74030CB7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `info_info_associated`
--
ALTER TABLE `info_info_associated`
  ADD CONSTRAINT `FK_613CDA035D8BC1F8` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`),
  ADD CONSTRAINT `FK_613CDA03EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `info` (`id`);

--
-- Contraintes pour la table `info_site`
--
ALTER TABLE `info_site`
  ADD CONSTRAINT `FK_3028DB6A5D8BC1F8` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3028DB6AF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_tag`
--
ALTER TABLE `info_tag`
  ADD CONSTRAINT `FK_DB662EFF5D8BC1F8` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`),
  ADD CONSTRAINT `FK_DB662EFFBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `info_video`
--
ALTER TABLE `info_video`
  ADD CONSTRAINT `FK_769E1FD929C1004E` FOREIGN KEY (`video_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_769E1FD93DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_769E1FD9BF396750` FOREIGN KEY (`id`) REFERENCES `info` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_video_translation`
--
ALTER TABLE `info_video_translation`
  ADD CONSTRAINT `FK_4A14CAE42C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `info_video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4A14CAE47A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `info_widget`
--
ALTER TABLE `info_widget`
  ADD CONSTRAINT `FK_482441865D8BC1F8` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`);

--
-- Contraintes pour la table `info_widget_audio`
--
ALTER TABLE `info_widget_audio`
  ADD CONSTRAINT `FK_6EE6B82493CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_6EE6B824BF396750` FOREIGN KEY (`id`) REFERENCES `info_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_image`
--
ALTER TABLE `info_widget_image`
  ADD CONSTRAINT `FK_B3A68AEE4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_B3A68AEEBF396750` FOREIGN KEY (`id`) REFERENCES `info_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_image_dual_align`
--
ALTER TABLE `info_widget_image_dual_align`
  ADD CONSTRAINT `FK_16C7EA954E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery_dual_align` (`id`),
  ADD CONSTRAINT `FK_16C7EA95BF396750` FOREIGN KEY (`id`) REFERENCES `info_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_quote`
--
ALTER TABLE `info_widget_quote`
  ADD CONSTRAINT `FK_1DEA4545BF396750` FOREIGN KEY (`id`) REFERENCES `info_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_quote_translation`
--
ALTER TABLE `info_widget_quote_translation`
  ADD CONSTRAINT `FK_9844BA422C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `info_widget_quote` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_text`
--
ALTER TABLE `info_widget_text`
  ADD CONSTRAINT `FK_7C448687BF396750` FOREIGN KEY (`id`) REFERENCES `info_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_text_translation`
--
ALTER TABLE `info_widget_text_translation`
  ADD CONSTRAINT `FK_E01919392C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `info_widget_text` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_video`
--
ALTER TABLE `info_widget_video`
  ADD CONSTRAINT `FK_A5C549D93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_A5C549DBF396750` FOREIGN KEY (`id`) REFERENCES `info_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_video_youtube`
--
ALTER TABLE `info_widget_video_youtube`
  ADD CONSTRAINT `FK_D6D3C4E03DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_D6D3C4E0BF396750` FOREIGN KEY (`id`) REFERENCES `info_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_widget_video_youtube_translation`
--
ALTER TABLE `info_widget_video_youtube_translation`
  ADD CONSTRAINT `FK_600AA7722C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `info_widget_video_youtube` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_6A2CA10C4D36AEC7` FOREIGN KEY (`associated_film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_6A2CA10C59027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_6A2CA10C5D24FD` FOREIGN KEY (`associated_event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_6A2CA10C896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_6A2CA10C8AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_6A2CA10CB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `media_audio`
--
ALTER TABLE `media_audio`
  ADD CONSTRAINT `FK_764F2243DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_764F224ACB53D86` FOREIGN KEY (`homepage_news_id`) REFERENCES `news_audio` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_764F224BF396750` FOREIGN KEY (`id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media_audio_film_film_associated`
--
ALTER TABLE `media_audio_film_film_associated`
  ADD CONSTRAINT `FK_43C2BAB135500D75` FOREIGN KEY (`media_audio_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_43C2BAB1EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_film` (`id`);

--
-- Contraintes pour la table `media_audio_translation`
--
ALTER TABLE `media_audio_translation`
  ADD CONSTRAINT `FK_9C2100782C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `media_audio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9C2100787A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_9C21007893CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `media_film_projection_associated`
--
ALTER TABLE `media_film_projection_associated`
  ADD CONSTRAINT `FK_97556E53EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `FK_97556E53EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_projection` (`id`);

--
-- Contraintes pour la table `media_image`
--
ALTER TABLE `media_image`
  ADD CONSTRAINT `FK_DA24C0EEBF396750` FOREIGN KEY (`id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media_image_simple`
--
ALTER TABLE `media_image_simple`
  ADD CONSTRAINT `FK_797C946896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_797C946B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `media_image_simple_site`
--
ALTER TABLE `media_image_simple_site`
  ADD CONSTRAINT `FK_5F8D4D2866055EA5` FOREIGN KEY (`media_image_simple_id`) REFERENCES `media_image_simple` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5F8D4D28F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media_image_simple_translation`
--
ALTER TABLE `media_image_simple_translation`
  ADD CONSTRAINT `FK_A878092D2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `media_image_simple` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A878092D7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_A878092D93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `media_image_simple_translation_site`
--
ALTER TABLE `media_image_simple_translation_site`
  ADD CONSTRAINT `FK_4C03D2C9D9C8526C` FOREIGN KEY (`media_image_simple_translation_id`) REFERENCES `media_image_simple_translation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4C03D2C9F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media_image_translation`
--
ALTER TABLE `media_image_translation`
  ADD CONSTRAINT `FK_2D46631A2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `media_image` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2D46631A7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_2D46631A93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `media_image_translation_site`
--
ALTER TABLE `media_image_translation_site`
  ADD CONSTRAINT `FK_639805ACA69F3F7A` FOREIGN KEY (`media_image_translation_id`) REFERENCES `media_image_translation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_639805ACF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media_site`
--
ALTER TABLE `media_site`
  ADD CONSTRAINT `FK_AA04D637EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AA04D637F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media_tag`
--
ALTER TABLE `media_tag`
  ADD CONSTRAINT `FK_48D8C57EBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `FK_48D8C57EEA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `media_video`
--
ALTER TABLE `media_video`
  ADD CONSTRAINT `FK_63DE1E9D3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_63DE1E9D571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_63DE1E9DACB53D86` FOREIGN KEY (`homepage_news_id`) REFERENCES `news_video` (`id`),
  ADD CONSTRAINT `FK_63DE1E9DBF396750` FOREIGN KEY (`id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_63DE1E9DD03756EE` FOREIGN KEY (`web_tv_id`) REFERENCES `web_tv` (`id`);

--
-- Contraintes pour la table `media_video_film_film_associated`
--
ALTER TABLE `media_video_film_film_associated`
  ADD CONSTRAINT `FK_BE17867826A02EFC` FOREIGN KEY (`media_video_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_BE178678EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_film` (`id`);

--
-- Contraintes pour la table `media_video_translation`
--
ALTER TABLE `media_video_translation`
  ADD CONSTRAINT `FK_C01299352C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `media_video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C0129935336F1CBB` FOREIGN KEY (`amazon_remote_file_id`) REFERENCES `amazon_remote_file` (`id`),
  ADD CONSTRAINT `FK_C012993559027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_C01299357A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_C012993593CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`),
  ADD CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_1DD399503AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_1DD399504D36AEC7` FOREIGN KEY (`associated_film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_1DD39950571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_1DD3995059027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_1DD399505D24FD` FOREIGN KEY (`associated_event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_1DD399506939C931` FOREIGN KEY (`homepage_media_video_id`) REFERENCES `media_video` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_1DD399507AC9EAB8` FOREIGN KEY (`homepage_media_audio_id`) REFERENCES `media_audio` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_1DD39950896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_1DD399508AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_1DD39950B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `FK_7E8585C8F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `news_article`
--
ALTER TABLE `news_article`
  ADD CONSTRAINT `FK_55DE12802EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_55DE1280BF396750` FOREIGN KEY (`id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_article_translation`
--
ALTER TABLE `news_article_translation`
  ADD CONSTRAINT `FK_5945EB82C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `news_article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5945EB87A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `news_audio`
--
ALTER TABLE `news_audio`
  ADD CONSTRAINT `FK_62C2B1CB2EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_62C2B1CB3A3123C7` FOREIGN KEY (`audio_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_62C2B1CBBF396750` FOREIGN KEY (`id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_audio_translation`
--
ALTER TABLE `news_audio_translation`
  ADD CONSTRAINT `FK_5B385D722C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `news_audio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5B385D727A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `news_film_film_associated`
--
ALTER TABLE `news_film_film_associated`
  ADD CONSTRAINT `FK_BD4F2838B5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `FK_BD4F2838EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_film` (`id`);

--
-- Contraintes pour la table `news_film_projection_associated`
--
ALTER TABLE `news_film_projection_associated`
  ADD CONSTRAINT `FK_32F3F5CBB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `FK_32F3F5CBEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_projection` (`id`);

--
-- Contraintes pour la table `news_image`
--
ALTER TABLE `news_image`
  ADD CONSTRAINT `FK_BF8283012EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_BF8283014E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_BF828301BF396750` FOREIGN KEY (`id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_image_translation`
--
ALTER TABLE `news_image_translation`
  ADD CONSTRAINT `FK_EA5F3E102C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `news_image` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EA5F3E107A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `news_news_associated`
--
ALTER TABLE `news_news_associated`
  ADD CONSTRAINT `FK_DD8D17BCB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DD8D17BCEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_site`
--
ALTER TABLE `news_site`
  ADD CONSTRAINT `FK_BC9EFF6FB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BC9EFF6FF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_tag`
--
ALTER TABLE `news_tag`
  ADD CONSTRAINT `FK_BE3ED8A1B5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `FK_BE3ED8A1BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `news_video`
--
ALTER TABLE `news_video`
  ADD CONSTRAINT `FK_6785D7229C1004E` FOREIGN KEY (`video_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_6785D723DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_6785D72BF396750` FOREIGN KEY (`id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_video_translation`
--
ALTER TABLE `news_video_translation`
  ADD CONSTRAINT `FK_70BC43F2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `news_video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_70BC43F7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `news_widget`
--
ALTER TABLE `news_widget`
  ADD CONSTRAINT `FK_950DDA4B5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`);

--
-- Contraintes pour la table `news_widget_audio`
--
ALTER TABLE `news_widget_audio`
  ADD CONSTRAINT `FK_A571063493CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_A5710634BF396750` FOREIGN KEY (`id`) REFERENCES `news_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_image`
--
ALTER TABLE `news_widget_image`
  ADD CONSTRAINT `FK_783134FE4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_783134FEBF396750` FOREIGN KEY (`id`) REFERENCES `news_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_image_dual_align`
--
ALTER TABLE `news_widget_image_dual_align`
  ADD CONSTRAINT `FK_A136E1424E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery_dual_align` (`id`),
  ADD CONSTRAINT `FK_A136E142BF396750` FOREIGN KEY (`id`) REFERENCES `news_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_quote`
--
ALTER TABLE `news_widget_quote`
  ADD CONSTRAINT `FK_D67DFB55BF396750` FOREIGN KEY (`id`) REFERENCES `news_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_quote_translation`
--
ALTER TABLE `news_widget_quote_translation`
  ADD CONSTRAINT `FK_80440C3E2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `news_widget_quote` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_text`
--
ALTER TABLE `news_widget_text`
  ADD CONSTRAINT `FK_8A491A37BF396750` FOREIGN KEY (`id`) REFERENCES `news_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_text_translation`
--
ALTER TABLE `news_widget_text_translation`
  ADD CONSTRAINT `FK_57E812EE2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `news_widget_text` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_video`
--
ALTER TABLE `news_widget_video`
  ADD CONSTRAINT `FK_C1CBEA8D93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_C1CBEA8DBF396750` FOREIGN KEY (`id`) REFERENCES `news_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_video_youtube`
--
ALTER TABLE `news_widget_video_youtube`
  ADD CONSTRAINT `FK_44843E073DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_44843E07BF396750` FOREIGN KEY (`id`) REFERENCES `news_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news_widget_video_youtube_translation`
--
ALTER TABLE `news_widget_video_youtube_translation`
  ADD CONSTRAINT `FK_88C085742C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `news_widget_video_youtube` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `prefooter`
--
ALTER TABLE `prefooter`
  ADD CONSTRAINT `FK_72A2862493CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_72A28624D333CCE8` FOREIGN KEY (`homepage_translation_id`) REFERENCES `homepage_translation` (`id`);

--
-- Contraintes pour la table `press_accredit`
--
ALTER TABLE `press_accredit`
  ADD CONSTRAINT `FK_8DC4A59B3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `press_accredit_has_procedure`
--
ALTER TABLE `press_accredit_has_procedure`
  ADD CONSTRAINT `FK_59DCC01B1624BCD2` FOREIGN KEY (`procedure_id`) REFERENCES `press_accredit_procedure` (`id`),
  ADD CONSTRAINT `FK_59DCC01BE8027C30` FOREIGN KEY (`accredit_id`) REFERENCES `press_accredit` (`id`);

--
-- Contraintes pour la table `press_accredit_procedure`
--
ALTER TABLE `press_accredit_procedure`
  ADD CONSTRAINT `FK_51F56B40BE5C596E` FOREIGN KEY (`procedure_second_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_51F56B40C2839385` FOREIGN KEY (`procedure_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `press_accredit_procedure_translation`
--
ALTER TABLE `press_accredit_procedure_translation`
  ADD CONSTRAINT `FK_3A0E43F52C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_accredit_procedure` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3A0E43F57A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_accredit_translation`
--
ALTER TABLE `press_accredit_translation`
  ADD CONSTRAINT `FK_91FD8E4A2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_accredit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_91FD8E4A7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_cinema_map`
--
ALTER TABLE `press_cinema_map`
  ADD CONSTRAINT `FK_13906FFA233835E3` FOREIGN KEY (`default_zone_image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_13906FFA3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_13906FFAAB6279BA` FOREIGN KEY (`default_room_image_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `press_cinema_map_room`
--
ALTER TABLE `press_cinema_map_room`
  ADD CONSTRAINT `FK_D287774B128B99A5` FOREIGN KEY (`room_map_id`) REFERENCES `press_cinema_map` (`id`),
  ADD CONSTRAINT `FK_D287774B54177093` FOREIGN KEY (`room_id`) REFERENCES `press_cinema_room` (`id`);

--
-- Contraintes pour la table `press_cinema_map_translation`
--
ALTER TABLE `press_cinema_map_translation`
  ADD CONSTRAINT `FK_D3A465472C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_cinema_map` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D3A465477A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_cinema_room`
--
ALTER TABLE `press_cinema_room`
  ADD CONSTRAINT `FK_73C41D581519A9F0` FOREIGN KEY (`zone_image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_73C41D583DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `press_cinema_room_translation`
--
ALTER TABLE `press_cinema_room_translation`
  ADD CONSTRAINT `FK_DBB03642C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_cinema_room` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DBB03647A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_download`
--
ALTER TABLE `press_download`
  ADD CONSTRAINT `FK_9BE0C1823AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `press_download_has_section`
--
ALTER TABLE `press_download_has_section`
  ADD CONSTRAINT `FK_87C67397C667AEAB` FOREIGN KEY (`download_id`) REFERENCES `press_download` (`id`),
  ADD CONSTRAINT `FK_87C67397D823E37A` FOREIGN KEY (`section_id`) REFERENCES `press_download_section` (`id`);

--
-- Contraintes pour la table `press_download_section_translation`
--
ALTER TABLE `press_download_section_translation`
  ADD CONSTRAINT `FK_2ED7F93E2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_download_section` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2ED7F93E7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_download_section_widget`
--
ALTER TABLE `press_download_section_widget`
  ADD CONSTRAINT `FK_19D8D06D3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_19D8D06DF61B0E32` FOREIGN KEY (`press_download_id`) REFERENCES `press_download_section` (`id`);

--
-- Contraintes pour la table `press_download_section_widget_archive`
--
ALTER TABLE `press_download_section_widget_archive`
  ADD CONSTRAINT `FK_D204617F3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_D204617F93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_D204617FBF396750` FOREIGN KEY (`id`) REFERENCES `press_download_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_section_widget_archive_translation`
--
ALTER TABLE `press_download_section_widget_archive_translation`
  ADD CONSTRAINT `FK_1E4A69292C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_download_section_widget_archive` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_section_widget_document`
--
ALTER TABLE `press_download_section_widget_document`
  ADD CONSTRAINT `FK_E16DC18816C20AE` FOREIGN KEY (`third_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_E16DC1883DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_E16DC1888489F901` FOREIGN KEY (`second_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_E16DC18893CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_E16DC188BF396750` FOREIGN KEY (`id`) REFERENCES `press_download_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_section_widget_document_translation`
--
ALTER TABLE `press_download_section_widget_document_translation`
  ADD CONSTRAINT `FK_E56C07572C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_download_section_widget_document` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_section_widget_file`
--
ALTER TABLE `press_download_section_widget_file`
  ADD CONSTRAINT `FK_8ED681FE8489F901` FOREIGN KEY (`second_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_8ED681FE93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_8ED681FEBF396750` FOREIGN KEY (`id`) REFERENCES `press_download_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_section_widget_file_translation`
--
ALTER TABLE `press_download_section_widget_file_translation`
  ADD CONSTRAINT `FK_D9F04172C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_download_section_widget_file` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_section_widget_photo`
--
ALTER TABLE `press_download_section_widget_photo`
  ADD CONSTRAINT `FK_530702D04E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_530702D0BF396750` FOREIGN KEY (`id`) REFERENCES `press_download_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_section_widget_video`
--
ALTER TABLE `press_download_section_widget_video`
  ADD CONSTRAINT `FK_3B775CE429C1004E` FOREIGN KEY (`video_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_3B775CE43DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_3B775CE48489F901` FOREIGN KEY (`second_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_3B775CE493CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_3B775CE4BF396750` FOREIGN KEY (`id`) REFERENCES `press_download_section_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_section_widget_video_translation`
--
ALTER TABLE `press_download_section_widget_video_translation`
  ADD CONSTRAINT `FK_6B12400B2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_download_section_widget_video` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_download_translation`
--
ALTER TABLE `press_download_translation`
  ADD CONSTRAINT `FK_792D24CC2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_download` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_792D24CC7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_guide`
--
ALTER TABLE `press_guide`
  ADD CONSTRAINT `FK_7FD6A49E3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `press_guide_translation`
--
ALTER TABLE `press_guide_translation`
  ADD CONSTRAINT `FK_538B9C532C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_guide` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_538B9C537A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_guide_widget`
--
ALTER TABLE `press_guide_widget`
  ADD CONSTRAINT `FK_74599DF91D7FD010` FOREIGN KEY (`press_guide_information_id`) REFERENCES `press_guide` (`id`),
  ADD CONSTRAINT `FK_74599DF93AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_74599DF93DB70692` FOREIGN KEY (`press_guide_meeting_id`) REFERENCES `press_guide` (`id`),
  ADD CONSTRAINT `FK_74599DF95E693B6` FOREIGN KEY (`press_guide_arrive_id`) REFERENCES `press_guide` (`id`),
  ADD CONSTRAINT `FK_74599DF9B7A892E8` FOREIGN KEY (`press_guide_service_id`) REFERENCES `press_guide` (`id`);

--
-- Contraintes pour la table `press_guide_widget_column`
--
ALTER TABLE `press_guide_widget_column`
  ADD CONSTRAINT `FK_520801B4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_520801BBF396750` FOREIGN KEY (`id`) REFERENCES `press_guide_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_guide_widget_column_translation`
--
ALTER TABLE `press_guide_widget_column_translation`
  ADD CONSTRAINT `FK_E575CD632C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_guide_widget_column` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_guide_widget_image`
--
ALTER TABLE `press_guide_widget_image`
  ADD CONSTRAINT `FK_B1F3C3174E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_B1F3C317BF396750` FOREIGN KEY (`id`) REFERENCES `press_guide_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_guide_widget_image_translation`
--
ALTER TABLE `press_guide_widget_image_translation`
  ADD CONSTRAINT `FK_E7B5AD72C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_guide_widget_image` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_guide_widget_picto`
--
ALTER TABLE `press_guide_widget_picto`
  ADD CONSTRAINT `FK_D1DFDD51BF396750` FOREIGN KEY (`id`) REFERENCES `press_guide_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_guide_widget_picto_translation`
--
ALTER TABLE `press_guide_widget_picto_translation`
  ADD CONSTRAINT `FK_24A7C5F02C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_guide_widget_picto` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `press_homepage`
--
ALTER TABLE `press_homepage`
  ADD CONSTRAINT `FK_28DE961C3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_28DE961C8AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_28DE961C99050B8B` FOREIGN KEY (`stat_image2_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_28DE961CB492F4FA` FOREIGN KEY (`stat_image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_28DE961CDF1CFA84` FOREIGN KEY (`push_main_image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_28DE961CE9941226` FOREIGN KEY (`push_secondary_image_id`) REFERENCES `media_image_simple` (`id`);

--
-- Contraintes pour la table `press_homepage_download`
--
ALTER TABLE `press_homepage_download`
  ADD CONSTRAINT `FK_E5C23440571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `press_homepage` (`id`),
  ADD CONSTRAINT `FK_E5C23440C667AEAB` FOREIGN KEY (`download_id`) REFERENCES `press_download_section` (`id`);

--
-- Contraintes pour la table `press_homepage_media`
--
ALTER TABLE `press_homepage_media`
  ADD CONSTRAINT `FK_3A938432567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_3A938432571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `press_homepage` (`id`);

--
-- Contraintes pour la table `press_homepage_section`
--
ALTER TABLE `press_homepage_section`
  ADD CONSTRAINT `FK_27B2E56A571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `press_homepage` (`id`);

--
-- Contraintes pour la table `press_homepage_translation`
--
ALTER TABLE `press_homepage_translation`
  ADD CONSTRAINT `FK_AA95F3BA2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_homepage` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AA95F3BA7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_media_library`
--
ALTER TABLE `press_media_library`
  ADD CONSTRAINT `FK_B602BC323AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `press_media_library_translation`
--
ALTER TABLE `press_media_library_translation`
  ADD CONSTRAINT `FK_78DCDA642C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_media_library` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_78DCDA647A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_projection`
--
ALTER TABLE `press_projection`
  ADD CONSTRAINT `FK_495BB8C9157E7D92` FOREIGN KEY (`scheduling_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_495BB8C93AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_495BB8C9632BDF55` FOREIGN KEY (`press_scheduling_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `press_projection_translation`
--
ALTER TABLE `press_projection_translation`
  ADD CONSTRAINT `FK_F15442352C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_projection` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F15442357A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `press_statement_info`
--
ALTER TABLE `press_statement_info`
  ADD CONSTRAINT `FK_DCDF33CA3AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `press_statement_info_translation`
--
ALTER TABLE `press_statement_info_translation`
  ADD CONSTRAINT `FK_BDE68C142C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `press_statement_info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BDE68C147A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `FK_E545A0C58AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`);

--
-- Contraintes pour la table `social_graph`
--
ALTER TABLE `social_graph`
  ADD CONSTRAINT `FK_43D5B14E8AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`);

--
-- Contraintes pour la table `social_wall`
--
ALTER TABLE `social_wall`
  ADD CONSTRAINT `FK_5CE43C928AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`);

--
-- Contraintes pour la table `statement`
--
ALTER TABLE `statement`
  ADD CONSTRAINT `FK_C0DB51763AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_C0DB51764D36AEC7` FOREIGN KEY (`associated_film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_C0DB5176571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_C0DB517659027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_C0DB51765D24FD` FOREIGN KEY (`associated_event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_C0DB5176896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `fos_user_user` (`id`),
  ADD CONSTRAINT `FK_C0DB51768AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`),
  ADD CONSTRAINT `FK_C0DB5176B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `statement_article`
--
ALTER TABLE `statement_article`
  ADD CONSTRAINT `FK_80391382EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_8039138BF396750` FOREIGN KEY (`id`) REFERENCES `statement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_article_translation`
--
ALTER TABLE `statement_article_translation`
  ADD CONSTRAINT `FK_B08780E42C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `statement_article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B08780E47A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `statement_audio`
--
ALTER TABLE `statement_audio`
  ADD CONSTRAINT `FK_2AB77A762EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_2AB77A763A3123C7` FOREIGN KEY (`audio_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_2AB77A76BF396750` FOREIGN KEY (`id`) REFERENCES `statement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_audio_translation`
--
ALTER TABLE `statement_audio_translation`
  ADD CONSTRAINT `FK_46DB418F2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `statement_audio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_46DB418F7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `statement_film_film_associated`
--
ALTER TABLE `statement_film_film_associated`
  ADD CONSTRAINT `FK_DF272639849CB65B` FOREIGN KEY (`statement_id`) REFERENCES `statement` (`id`),
  ADD CONSTRAINT `FK_DF272639EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_film` (`id`);

--
-- Contraintes pour la table `statement_film_projection_associated`
--
ALTER TABLE `statement_film_projection_associated`
  ADD CONSTRAINT `FK_F35E58AD849CB65B` FOREIGN KEY (`statement_id`) REFERENCES `statement` (`id`),
  ADD CONSTRAINT `FK_F35E58ADEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `film_projection` (`id`);

--
-- Contraintes pour la table `statement_image`
--
ALTER TABLE `statement_image`
  ADD CONSTRAINT `FK_F7F748BC2EF91FD8` FOREIGN KEY (`header_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_F7F748BC4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_F7F748BCBF396750` FOREIGN KEY (`id`) REFERENCES `statement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_image_translation`
--
ALTER TABLE `statement_image_translation`
  ADD CONSTRAINT `FK_F7BC22ED2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `statement_image` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F7BC22ED7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `statement_site`
--
ALTER TABLE `statement_site`
  ADD CONSTRAINT `FK_7B6309C8849CB65B` FOREIGN KEY (`statement_id`) REFERENCES `statement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7B6309C8F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_statement_associated`
--
ALTER TABLE `statement_statement_associated`
  ADD CONSTRAINT `FK_B5098E47849CB65B` FOREIGN KEY (`statement_id`) REFERENCES `statement` (`id`),
  ADD CONSTRAINT `FK_B5098E47EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `statement` (`id`);

--
-- Contraintes pour la table `statement_tag`
--
ALTER TABLE `statement_tag`
  ADD CONSTRAINT `FK_9460CBDA849CB65B` FOREIGN KEY (`statement_id`) REFERENCES `statement` (`id`),
  ADD CONSTRAINT `FK_9460CBDABAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `statement_video`
--
ALTER TABLE `statement_video`
  ADD CONSTRAINT `FK_4E0D96CF29C1004E` FOREIGN KEY (`video_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_4E0D96CF3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image` (`id`),
  ADD CONSTRAINT `FK_4E0D96CFBF396750` FOREIGN KEY (`id`) REFERENCES `statement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_video_translation`
--
ALTER TABLE `statement_video_translation`
  ADD CONSTRAINT `FK_1AE8D8C22C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `statement_video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1AE8D8C27A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `statement_widget`
--
ALTER TABLE `statement_widget`
  ADD CONSTRAINT `FK_BCC8675E849CB65B` FOREIGN KEY (`statement_id`) REFERENCES `statement` (`id`);

--
-- Contraintes pour la table `statement_widget_audio`
--
ALTER TABLE `statement_widget_audio`
  ADD CONSTRAINT `FK_F06ED94E93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_audio` (`id`),
  ADD CONSTRAINT `FK_F06ED94EBF396750` FOREIGN KEY (`id`) REFERENCES `statement_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_image`
--
ALTER TABLE `statement_widget_image`
  ADD CONSTRAINT `FK_2D2EEB844E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `FK_2D2EEB84BF396750` FOREIGN KEY (`id`) REFERENCES `statement_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_image_dual_align`
--
ALTER TABLE `statement_widget_image_dual_align`
  ADD CONSTRAINT `FK_7D1E4FF34E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery_dual_align` (`id`),
  ADD CONSTRAINT `FK_7D1E4FF3BF396750` FOREIGN KEY (`id`) REFERENCES `statement_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_quote`
--
ALTER TABLE `statement_widget_quote`
  ADD CONSTRAINT `FK_8362242FBF396750` FOREIGN KEY (`id`) REFERENCES `statement_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_quote_translation`
--
ALTER TABLE `statement_widget_quote_translation`
  ADD CONSTRAINT `FK_3CFEA78A2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `statement_widget_quote` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_text`
--
ALTER TABLE `statement_widget_text`
  ADD CONSTRAINT `FK_90B04F80BF396750` FOREIGN KEY (`id`) REFERENCES `statement_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_text_translation`
--
ALTER TABLE `statement_widget_text_translation`
  ADD CONSTRAINT `FK_8BC0BC5F2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `statement_widget_text` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_video`
--
ALTER TABLE `statement_widget_video`
  ADD CONSTRAINT `FK_94D435F793CB796C` FOREIGN KEY (`file_id`) REFERENCES `media_video` (`id`),
  ADD CONSTRAINT `FK_94D435F7BF396750` FOREIGN KEY (`id`) REFERENCES `statement_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_video_youtube`
--
ALTER TABLE `statement_widget_video_youtube`
  ADD CONSTRAINT `FK_26EC30063DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_26EC3006BF396750` FOREIGN KEY (`id`) REFERENCES `statement_widget` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `statement_widget_video_youtube_translation`
--
ALTER TABLE `statement_widget_video_youtube_translation`
  ADD CONSTRAINT `FK_F1B60FBB2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `statement_widget_video_youtube` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tag_translation`
--
ALTER TABLE `tag_translation`
  ADD CONSTRAINT `FK_A8A03F8F2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A8A03F8F7A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `theme_translation`
--
ALTER TABLE `theme_translation`
  ADD CONSTRAINT `FK_5C4256602C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `theme` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5C4256607A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `user_site`
--
ALTER TABLE `user_site`
  ADD CONSTRAINT `FK_13C2452DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_13C2452DF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `web_tv`
--
ALTER TABLE `web_tv`
  ADD CONSTRAINT `FK_F2CD5A193AF24327` FOREIGN KEY (`seo_file_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_F2CD5A193DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media_image_simple` (`id`),
  ADD CONSTRAINT `FK_F2CD5A19571EDDA` FOREIGN KEY (`homepage_id`) REFERENCES `homepage` (`id`),
  ADD CONSTRAINT `FK_F2CD5A198AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `film_festival` (`id`);

--
-- Contraintes pour la table `web_tv_translation`
--
ALTER TABLE `web_tv_translation`
  ADD CONSTRAINT `FK_D435CB512C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `web_tv` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D435CB517A88E00` FOREIGN KEY (`locked_by_id`) REFERENCES `fos_user_user` (`id`);

--
-- Contraintes pour la table `widget_movie_film_film`
--
ALTER TABLE `widget_movie_film_film`
  ADD CONSTRAINT `FK_4E5F2D82567F5183` FOREIGN KEY (`film_id`) REFERENCES `film_film` (`id`),
  ADD CONSTRAINT `FK_4E5F2D8263FE6BDD` FOREIGN KEY (`widget_movie_id`) REFERENCES `widget_movie` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
