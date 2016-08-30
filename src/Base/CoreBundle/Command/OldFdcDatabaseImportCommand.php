<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\Gallery;
use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoArticleTranslation;
use Base\CoreBundle\Entity\InfoFilmFilmAssociated;
use Base\CoreBundle\Entity\InfoWidgetAudio;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\InfoWidgetText;
use Base\CoreBundle\Entity\InfoWidgetTextTranslation;
use Base\CoreBundle\Entity\InfoWidgetVideo;
use Base\CoreBundle\Entity\InfoWidgetVideoYoutube;
use Base\CoreBundle\Entity\InfoWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsFilmFilmAssociated;
use Base\CoreBundle\Entity\NewsWidgetAudio;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsWidgetVideo;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutube;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\StatementArticle;
use Base\CoreBundle\Entity\StatementArticleTranslation;
use Base\CoreBundle\Entity\StatementFilmFilmAssociated;
use Base\CoreBundle\Entity\StatementWidgetAudio;
use Base\CoreBundle\Entity\StatementWidgetImage;
use Base\CoreBundle\Entity\StatementWidgetText;
use Base\CoreBundle\Entity\StatementWidgetTextTranslation;
use Base\CoreBundle\Entity\StatementWidgetVideo;
use Base\CoreBundle\Entity\StatementWidgetVideoYoutube;
use Base\CoreBundle\Entity\StatementWidgetVideoYoutubeTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

class OldFdcDatabaseImportCommand extends ContainerAwareCommand
{
    const TYPE_QUOTIDIEN = 23102;
    const TYPE_NEWS_FESTIVAL = 23120;
    const TYPE_NEWS_CONFERENCE = 23121;
    const TYPE_COMMUNIQUE = 23109;

    const MEDIA_GALLERY_QUOTIDIEN_DIAPORAMA = 1;
    const MEDIA_GALLERY_PHOTOGRAPHER_EYES = 2;

    const MEDIA_TYPE_IMAGE = 1;
    const MEDIA_TYPE_AUDIO = 3;

    const MEDIA_QUOTIDIEN_AUDIO = 1;

    const VIDEO_TYPE_FESTIVAL_TV = 1;

    private $langs = array('fr', 'en', 'es', 'zh');
    private $entitiesCount = array();
    private $doNotPublish = false;

    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc')
            ->setDescription('Impot old fdc database data')
            ->addOption(
                'associated-news',
                null,
                InputOption::VALUE_NONE,
                'Import only associated news'
            )
            ->addOption(
                'count',
                null,
                InputOption::VALUE_NONE,
                'Count entities total'
            )
            ->addOption(
                'only-create',
                null,
                InputOption::VALUE_NONE,
                'Create only new entities'
            )
            ->addOption(
                'only-articles',
                null,
                InputOption::VALUE_NONE,
                'Only import articles'
            )
            ->addOption(
                'only-medias',
                null,
                InputOption::VALUE_NONE,
                'Only import medias'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dm = $this->getContainer()->get('doctrine')->getManager();
        $mediaManager = $this->getContainer()->get('sonata.media.manager.media');
        $onlyArticles = $input->getOption('only-articles');
        $onlyMedias = $input->getOption('only-medias');

        if (($onlyMedias == false && $onlyArticles == true) || ($onlyMedias == false && $onlyArticles == false)) {
            $this->importArticleQuotidien($dm, $mediaManager, $output, $input);
            $this->importArticleActualite($dm, $mediaManager, $output, $input);
            $this->importArticleCommunique($dm, $mediaManager, $output, $input);
        }

        if (($onlyMedias == true && $onlyArticles == false) || ($onlyMedias == false && $onlyArticles == false)) {
            $this->importMediaImage($dm, $mediaManager, $output, $input);
            $this->importMediaAudio($dm, $mediaManager, $output, $input);
        }
    }

    private function importMediaAudio($dm, $mediaManager, $output, $input)
    {
        $output->writeln('<info>Import Media Audio ...</info>');

        /*$element = $dm->getRepository('BaseCoreBundle:OldMedia')->findOneById(15626);
        $oldMedias[0] = $element;*/

        // case one
        // Publier dans "Quotidien - Audios"
        // Film associé
        $oldMedias = $dm->getRepository('BaseCoreBundle:OldMedia')->createQueryBuilder('m')
            ->where('m.fileClass = :file_class')
            ->andWhere('m.published = :published')
            ->setParameter('file_class', self::MEDIA_TYPE_AUDIO)
            ->setParameter('published', self::MEDIA_QUOTIDIEN_AUDIO)
            ->getQuery()
            ->getResult();

        $oldMediasSelected = array();
        foreach ($oldMedias as $oldMedia) {
            $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldMediaAssociation')->findBy(array(
                'id' => $oldMedia->getId(),
                'objectClass' => 'Film'
            ));
            if (count($oldArticleAssociations) > 0) {
                $oldMediasSelected[] = $oldMedia;
            }
        }

        $this->importMediaAudioLoop($oldMediasSelected, $dm, $mediaManager, $output, $input, false);
    }

    private function importMediaAudioLoop($oldMedias, $dm, $mediaManager, $output, $input, $addSiteCorporate = true)
    {
        $totalSaved = 0;
        $optionCount = $input->getOption('count');
        $onlyCreate = $input->getOption('only-create');
        $siteFDCCorporate = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-institutionnel');
        $siteFDCEvent = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-evenementiel');
        $entities = array();
        $oldMediasTotal = count($oldMedias);

        foreach ($oldMedias as $oldMediaKey => $oldMedia) {
            $output->writeln('<comment>#'. $oldMedia->getId(). ' - '. ($oldMediaKey + 1). '/'. $oldMediasTotal. '</comment>');
            $output->writeln('<info>#'. $oldMedia->getId(). ' is matching.</info>');

            // old news
            $mediaAudio = $dm->getRepository('BaseCoreBundle:MediaAudio')->findOneByOldMediaId($oldMedia->getId());
            if ($onlyCreate == true && $mediaAudio != null) {
                continue;
            }
            // set values
            if ($mediaAudio == null) {
                $mediaAudio = new MediaAudio();
            }
            $mediaAudio->setOldMediaId($oldMedia->getId());

            $festival = $dm->getRepository('BaseCoreBundle:FilmFestival')->findOneByYear($oldMedia->getCreatedAt()->format('Y'));
            $mediaAudio->setFestival($festival);

            if ($addSiteCorporate == true) {
                if (!$mediaAudio->getSites()->contains($siteFDCCorporate)) {
                    $mediaAudio->addSite($siteFDCCorporate);
                }
            }
            /*if (!$mediaAudio->getSites()->contains($siteFDCEvent)) {
                $mediaAudio->addSite($siteFDCEvent);
            }*/
            /* remove site fdc event after testing
            if ($mediaAudio->getSites()->contains($siteFDCEvent)) {
                $mediaAudio->removeSite($siteFDCEvent);
            }*/

            $dm->persist($mediaAudio);
            $dm->flush();

            $oldMediaTranslations = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findById($oldMedia->getId());
            foreach ($oldMediaTranslations as $oldMediaTrans) {
                $culture = ($oldMediaTrans->getCulture() == 'cn') ? 'zh' : $oldMediaTrans->getCulture();
                if (!in_array($culture, $this->langs)) {
                    continue;
                }
                $audioTrans = $mediaAudio->findTranslationByLocale($culture);

                // file
                if ($oldMediaTrans->getHdFormatFilename() != null) {
                    $code = $oldMediaTrans->getHdFormatFilename();
                    $audioPath = 'http://www.festival-cannes.fr/' . trim($code);
                }

                if ($code != null) {
                    if ($audioTrans != null && $audioTrans->getFile() != null) {
                        $media = $audioTrans->getFile();
                    } else {
                        $media = new Media();
                    }

                    $file = $this->createAudio($audioPath, $output);
                    if ($file == null) {
                        break;
                    }
                    $media->setName($oldMediaTrans->getLabel());
                    $media->setBinaryContent($file);
                    $media->setEnabled(true);
                    $media->setProviderReference($oldMediaTrans->getLabel());
                    $media->setContext('media_audio');
                    $media->setProviderStatus(1);
                    $media->setProviderName('sonata.media.provider.audio');
                    $mediaManager->save($media, 'media_audio', 'sonata.media.provider.audio');

                    if ($audioTrans == null) {
                        $audioTrans = new MediaAudioTranslation();
                    }
                    $audioTrans->setLocale($culture);
                    $audioTrans->setFile($media);
                    $audioTrans->setTranslatable($mediaAudio);
                    $audioTrans->setTitle($oldMediaTrans->getLabel());
                    $audioTrans->setJobMp3State(MediaAudioTranslation::ENCODING_STATE_READY);
                    $audioTrans->setTranslatable($mediaAudio);
                } else {
                    $output->writeln("<error>Audio code not found for Object id #{$oldMediaTrans->getId()}</error>");
                }

                // image
                if ($oldMediaTrans->getFilenameThumbnail() != null) {
                    $url = 'http://www.festival-cannes.fr/assets/Audio/General/thumbnails/' . $oldMediaTrans->getFilenameThumbnail();
                    $file = $this->imagecreatefromfile($url, $output);

                    if ($file !== null) {
                        $mediaImage = $mediaAudio->getImage();

                        if ($mediaImage == null) {
                            $mediaImage = new MediaImage();
                        }
                        if ($mediaImage !== null && $mediaImage->findTranslationByLocale($culture)) {
                            $mediaImageTrans = $mediaImage->findTranslationByLocale($culture);
                        } else {
                            $mediaImageTrans = new MediaImageTranslation();
                            $mediaImageTrans->setLocale($culture);
                            $mediaImageTrans->setTranslatable($mediaImage);
                        }
                        $mediaImageTrans->setCopyright($oldMediaTrans->getThumbnailCopyright());
                        $mediaAudio->setImage($mediaImage);
                        if ($mediaImageTrans->getFile() == null) {
                            $imgTitle = array(
                                'fr' => 'photo',
                                'en' => 'photo',
                                'es' => 'foto',
                                'zh' => '照片'
                            );
                            $media = new Media();
                            $media->setContentType('image/jpeg');
                            $media->setName($imgTitle[$culture]);
                            $media->setBinaryContent($file);
                            $media->setEnabled(true);
                            $media->setProviderReference($oldMediaTrans->getFilenameThumbnail());
                            $media->setContext('media_image');
                            $media->setProviderStatus(1);
                            $media->setProviderName('sonata.media.provider.image');
                            $mediaManager->save($media, 'media_image', 'sonata.media.provider.image');
                            $mediaImageTrans->setFile($media);
                        }
                    }
                }

                $publishedAt = $oldMedia->getPublishFor();
                $mediaAudio->setPublishedAt($publishedAt);
            }

            $oldMediaAssociations = $dm->getRepository('BaseCoreBundle:OldMediaAssociation')->findBy(array(
                'id' => $oldMedia->getId(),
                'objectClass' => 'Film'
            ));

            foreach ($oldMediaAssociations as $oldMediaAssoc) {
                $filmFilm = $dm->getRepository('BaseCoreBundle:FilmFilm')->findOneById($oldMediaAssoc->getObjectId());
                if ($filmFilm == null) {
                    $output->writeln("<error>Film #{$oldMediaAssoc->getObjectId()} not found</error>");
                } else {
                    $found = false;
                    foreach ($mediaAudio->getAssociatedFilms() as $associated) {
                        if ($associated->getAssociation()->getId() == $filmFilm->getId()) {
                            $found = true;
                        }
                    }
                    if ($found == false) {
                        $associated = new MediaAudioFilmFilmAssociated();
                        $associated->setMediaAudio($mediaAudio);
                        $associated->setAssociation($filmFilm);
                        $mediaAudio->addAssociatedFilm($associated);
                    }
                }
            }

            $entities[] = $mediaAudio;
            $output->writeln('<info>To be saved...</info>');
            $totalSaved++;

            if ($totalSaved % 100 == 0) {
                $output->writeln('<info>Saved !</info>');
                $dm->flush();
                $this->updateAcl($entities, 'base.admin.media_audio', $output);
                $entities = array();
            }
        }

        if ($optionCount) {
            dump($this->entitiesCount);
        } else {
            $output->writeln('<info>Total saved: ' . $totalSaved . '</info>');
            $dm->flush();
            $this->updateAcl($entities, 'base.admin.media_audio', $output);
        }
    }


    private function importMediaImage($dm, $mediaManager, $output, $input)
    {
        $output->writeln('<info>Import Media Image...</info>');

        /*$element = $dm->getRepository('BaseCoreBundle:OldArticle')->findOneById(60596);
        $oldArticles[0] = $element;*/

        // case one
        // Galerie Quotidien - Diaporama
        // id > 7816
        $oldMedias = $dm->getRepository('BaseCoreBundle:OldMedia')->createQueryBuilder('m')
            ->where('m.id >= 7816')
            ->andWhere('m.fileClass = :file_class')
            ->andWhere('m.published = :published')
            ->setParameter('file_class', self::MEDIA_TYPE_IMAGE)
            ->setParameter('published', self::MEDIA_GALLERY_QUOTIDIEN_DIAPORAMA)
            ->getQuery()
            ->getResult();
        $this->importMediaImageLoop($oldMedias, $dm, $mediaManager, $output, $input);

        // case third
        // Galerie Oeil du photographe
        // id > 11802
        $oldMedias = $dm->getRepository('BaseCoreBundle:OldMedia')->createQueryBuilder('m')
            ->where('m.id >= 11802')
            ->andWhere('m.published = :published')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter('file_class', self::MEDIA_TYPE_IMAGE)
            ->setParameter('published', self::MEDIA_GALLERY_PHOTOGRAPHER_EYES)
            ->getQuery()
            ->getResult();
        $this->importMediaImageLoop($oldMedias, $dm, $mediaManager, $output, $input);

        // case fourth
        // Galerie Oeil du photographe
        // id < 11802
        $oldMedias = $dm->getRepository('BaseCoreBundle:OldMedia')->createQueryBuilder('m')
            ->where('m.id < 11802')
            ->andWhere('m.published = :published')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter('file_class', self::MEDIA_TYPE_IMAGE)
            ->setParameter('published', self::MEDIA_GALLERY_PHOTOGRAPHER_EYES)
            ->getQuery()
            ->getResult();
        $this->importMediaImageLoop($oldMedias, $dm, $mediaManager, $output, $input, false);
    }


    private function importArticleCommunique($dm, $mediaManager, $output, $input)
    {
        $output->writeln('<info>Import Article Communique...</info>');
        /*$element = $dm->getRepository('BaseCoreBundle:OldArticle')->findOneById(60596);
        $oldArticles[0] = $element;*/

        $oldArticles = $dm->getRepository('BaseCoreBundle:OldArticle')->findBy(array(
            'articleTypeId' => self::TYPE_COMMUNIQUE,
        ), array('id' => 'ASC'));

        $entitiesArray = array(
            'main_entity_parent' => 'BaseCoreBundle:Statement',
            'main_entity' => 'BaseCoreBundle:StatementArticle',
            'main' => new StatementArticle(),
            'main_trans' => new StatementArticleTranslation(),
            'widget_text' => new StatementWidgetText(),
            'widget_text_trans' => new StatementWidgetTextTranslation(),
            'widget_yt' => new StatementWidgetVideoYoutube(),
            'widget_yt_trans' => new StatementWidgetVideoYoutubeTranslation(),
            'widget_yt_entity' => 'StatementWidgetVideoYoutube',
            'widget_image' => new StatementWidgetImage(),
            'widget_audio' => new StatementWidgetAudio(),
            'widget_video' => new StatementWidgetVideo(),
            'association_setter' => 'addAssociatedStatement',
            'association' => new StatementFilmFilmAssociated(),
            'association_film_setter' => 'setStatement',
            'acl_update' => 'base.admin.statement_article',
        );

        $this->importLoop($oldArticles, $dm, $mediaManager, $output, $input, $entitiesArray, 'isCommuniqueMatching');
    }

    private function importArticleActualite($dm, $mediaManager, $output, $input)
    {
        $output->writeln('<info>Import Article Actualite...</info>');
        /*$element = $dm->getRepository('BaseCoreBundle:OldArticle')->findOneById(61347);
        $oldArticles[0] = $element;*/

        $oldArticles = $dm->getRepository('BaseCoreBundle:OldArticle')->findBy(array(
            'articleTypeId' => self::TYPE_NEWS_FESTIVAL,
        ), array('id' => 'ASC'));

        $entitiesArray = array(
            'main_entity_parent' => 'BaseCoreBundle:Info',
            'main_entity' => 'BaseCoreBundle:InfoArticle',
            'main' => new InfoArticle(),
            'main_trans' => new InfoArticleTranslation(),
            'widget_text' => new InfoWidgetText(),
            'widget_text_trans' => new InfoWidgetTextTranslation(),
            'widget_yt' => new InfoWidgetVideoYoutube(),
            'widget_yt_trans' => new InfoWidgetVideoYoutubeTranslation(),
            'widget_yt_entity' => 'InfoWidgetVideoYoutube',
            'widget_image' => new InfoWidgetImage(),
            'widget_audio' => new InfoWidgetAudio(),
            'widget_video' => new InfoWidgetVideo(),
            'association_setter' => 'addAssociatedInfo',
            'association' => new InfoFilmFilmAssociated(),
            'association_film_setter' => 'setInfo',
            'acl_update' => 'base.admin.news_article',
        );

        $this->importLoop($oldArticles, $dm, $mediaManager, $output, $input, $entitiesArray, 'isActualiteMatching');
    }


    private function importArticleQuotidien($dm, $mediaManager, $output, $input)
    {
        $output->writeln('<info>Import Article Quotidien...</info>');
        /*$element = $dm->getRepository('BaseCoreBundle:OldArticle')->findOneById(56042);
        $oldArticles[0] = $element;*/

        $oldArticles = $dm->getRepository('BaseCoreBundle:OldArticle')->findBy(array(
            'articleTypeId' => self::TYPE_QUOTIDIEN,
        ), array('id' => 'ASC'));

        $entitiesArray = array(
            'main_entity_parent' => 'BaseCoreBundle:News',
            'main_entity' => 'BaseCoreBundle:NewsArticle',
            'main' => new NewsArticle(),
            'main_trans' => new NewsArticleTranslation(),
            'widget_text' => new NewsWidgetText(),
            'widget_text_trans' => new NewsWidgetTextTranslation(),
            'widget_yt' => new NewsWidgetVideoYoutube(),
            'widget_yt_entity' => 'NewsWidgetVideoYoutube',
            'widget_yt_trans' => new NewsWidgetVideoYoutubeTranslation(),
            'widget_image' => new NewsWidgetImage(),
            'widget_audio' => new NewsWidgetAudio(),
            'widget_video' => new NewsWidgetVideo(),
            'association_setter' => 'addAssociatedNews',
            'association' => new NewsFilmFilmAssociated(),
            'association_film_setter' => 'setNews',
            'acl_update' => 'base.admin.info_article',
        );

        $this->importLoop($oldArticles, $dm, $mediaManager, $output, $input, $entitiesArray, 'isQuotidienMatching');
    }


    private function importMediaImageLoop($oldMedias, $dm, $mediaManager, $output, $input, $addSiteCorporate = true)
    {
        $totalSaved = 0;
        $optionAssociatedNews = $input->getOption('associated-news');
        $optionCount = $input->getOption('count');
        $onlyCreate = $input->getOption('only-create');
        $siteFDCCorporate = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-institutionnel');
        $siteFDCEvent = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-evenementiel');
        $entities = array();
        $oldMediasTotal = count($oldMedias);

        foreach ($oldMedias as $oldMediaKey => $oldMedia) {
            $output->writeln('<comment>#'. $oldMedia->getId(). ' - '. ($oldMediaKey + 1). '/'. $oldMediasTotal. '</comment>');
            $output->writeln('<info>#'. $oldMedia->getId(). ' is matching.</info>');

            // old news
            $mediaImage = $dm->getRepository('BaseCoreBundle:MediaImage')->findOneByOldMediaId($oldMedia->getId());
            if ($onlyCreate == true && $mediaImage != null) {
                continue;
            }
            // set values
            if ($mediaImage == null) {
                $mediaImage = new MediaImage();
            }

            $url = 'http://www.festival-cannes.fr/assets/Image/General/' . $oldMedia->getFilename();
            $file = $this->imagecreatefromfile($url, $output);

            if ($file != null) {
                $media = ($mediaImage->findTranslationByLocale('fr') != null && $mediaImage->findTranslationByLocale('fr')->getFile() != null) ? $mediaImage->findTranslationByLocale('fr')->getFile() : new Media();
            } else {
                $media = new Media();
            }
            if ($addSiteCorporate == true) {
                if (!$mediaImage->getSites()->contains($siteFDCCorporate)) {
                    $mediaImage->addSite($siteFDCCorporate);
                }
            }
            /*if (!$mediaImage->getSites()->contains($siteFDCEvent)) {
                $mediaImage->addSite($siteFDCEvent);
            }*/
            /* remove site fdc event after testing
            if ($mediaImage->getSites()->contains($siteFDCEvent)) {
                $mediaImage->removeSite($siteFDCEvent);
            }*/
            $mediaImage->setOldMediaId($oldMedia->getId());
            $saved = false;
            if ($media->getId() == null && $oldMedia->getFilename()) {
                $media->setContentType('image/jpeg');
                $media->setName($oldMedia->getFilename());
                $media->setBinaryContent($file);
                $media->setEnabled(true);
                $media->setProviderReference($oldMedia->getFilename());
                $media->setContext('media_image');
                $media->setProviderStatus(1);
                $media->setProviderName('sonata.media.provider.image');
                $mediaManager->save($media, 'media_image', 'sonata.media.provider.image');
                $saved = true;
            }

            $oldMediaTranslations = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findById($oldMedia->getId());
            foreach ($oldMediaTranslations as $oldMediaTrans) {
                $culture = ($oldMediaTrans->getCulture() == 'cn') ? 'zh' : $oldMediaTrans->getCulture();
                if (!in_array($culture, $this->langs)) {
                    continue;
                }
                $imgTrans = $mediaImage->findTranslationByLocale($culture);
                if ($imgTrans == null) {
                    $imgTrans = new MediaImageTranslation();
                    $mediaImage->addTranslation($imgTrans);
                }
                if ($culture == 'fr') {
                    $imgTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                } else {
                    $imgTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                }
                if ($saved == true && $culture == 'fr') {
                    $imgTrans->setFile($media);
                }
                $imgTrans->setTranslatable($mediaImage);
                $imgTitle = array(
                    'fr' => 'photo',
                    'en' => 'photo',
                    'es' => 'foto',
                    'zh' => '照片'
                );
                $imgTrans->setLegend(($oldMediaTrans->getLabel() != null) ? $oldMediaTrans->getLabel() : $imgTitle[$culture]);
                $imgTrans->setCopyright($oldMediaTrans->getCopyright());
                $imgTrans->setLocale($culture);
                $imgTrans->setisPublishedOnFDCEvent(1);

                $publishedAt = $oldMedia->getPublishFor();
                $publishedAt->setTime($oldMedia->getHourOrder(), 0);
                $mediaImage->setPublishedAt($publishedAt);
            }

            if ($mediaImage->getId() == null) {
                $dm->persist($mediaImage);
            }
            $entities[] = $mediaImage;
            $output->writeln('<info>To be saved...</info>');
            $totalSaved++;

            if ($totalSaved % 100 == 0) {
                $output->writeln('<info>Saved !</info>');
                $dm->flush();
                $this->updateAcl($entities, 'base.admin.media_image', $output);
                $entities = array();
            }
        }

        if ($optionCount) {
            dump($this->entitiesCount);
        } else {
            $output->writeln('<info>Total saved: ' . $totalSaved . '</info>');
            $dm->flush();
            $this->updateAcl($entities, 'base.admin.media_image', $output);
        }
    }

    private function importLoop($oldArticles, $dm, $mediaManager, $output, $input, $entitiesArray, $getterMatching)
    {
        $mapperFields = array(
            'resume' => 'introduction'
        );
        $totalSaved = 0;
        $optionAssociatedNews = $input->getOption('associated-news');
        $optionCount = $input->getOption('count');
        $onlyCreate = $input->getOption('only-create');
        $siteFDCCorporate = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-institutionnel');
        $siteFDCEvent = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-evenementiel');
        $entities = array();
        $oldArticlesTotal = count($oldArticles);

        foreach ($oldArticles as $oldArticleKey => $oldArticle) {
            $output->writeln('<comment>#'. $oldArticle->getId(). ' - '. ($oldArticleKey + 1). '/'. $oldArticlesTotal. '</comment>');
            $oldArticleTranslations = $dm->getRepository('BaseCoreBundle:OldArticleI18n')->findById($oldArticle->getId());

            // has french translation
            $hasFrenchTranslation = $this->hasFrenchTranslation($oldArticleTranslations, $output);
            if ($hasFrenchTranslation == false) {
                continue;
            }

            // is valid matching
            $output->writeln('<comment>#'. $oldArticle->getId(). ' verify matching.</comment>');
            $matching = $this->{$getterMatching}($oldArticle, $oldArticleTranslations, $dm, $output, $input);
            if ($matching == false || $optionCount == true) {
                continue;
            }

            $output->writeln('<info>#'. $oldArticle->getId(). ' is matching.</info>');

            // old news
            $news = $dm->getRepository($entitiesArray['main_entity'])->findOneByOldNewsId($oldArticle->getId());
            if ($onlyCreate == true && $news != null) {
                continue;
            }
            // set values
            if ($news == null) {
                $news = clone $entitiesArray['main'];
            }
            $news->setOldNewsTable('OldNews');
            $news->setOldNewsId($oldArticle->getId());
            $news->setPublishedAt(($oldArticle->getStartDate() != null) ? $oldArticle->getStartDate() : $oldArticle->getUpdatedAt());
            $news->setCreatedAt($oldArticle->getUpdatedAt());
            $news->setUpdatedAt($oldArticle->getCreatedAt());
            $news->setIsPublishedOnFdcEvent(1);
            if ($this->doNotPublish === false) {
                if (!$news->getSites()->contains($siteFDCCorporate)) {
                    $news->addSite($siteFDCCorporate);
                }
                if (!$news->getSites()->contains($siteFDCEvent)) {
                    $news->addSite($siteFDCEvent);
                }
                /* remove site fdc event after testing
                if ($news->getSites()->contains($siteFDCEvent)) {
                    $news->removeSite($siteFDCEvent);
                }*/
            }


            $festival = $dm->getRepository('BaseCoreBundle:FilmFestival')->findOneByYear($oldArticle->getCreatedAt()->format('Y'));
            $news->setFestival($festival);

            //$dm->persist($news);
            //$dm->flush();

            // loop translations
            foreach ($oldArticleTranslations as $oldArticleTranslation) {
                $culture = ($oldArticleTranslation->getCulture() == 'cn') ? 'zh' : $oldArticleTranslation->getCulture();
                if (in_array($culture, $this->langs)) {
                    if ($optionAssociatedNews == false) {
                        $output->writeln('<comment>add Translation ' . $culture . '</comment>');
                        $newsTrans = $news->findTranslationByLocale($culture);
                        if ($newsTrans == null) {
                            $newsTrans = clone $entitiesArray['main_trans'];
                            $newsTrans->setLocale($culture);
                            $newsTrans->setCreatedAt($news->getCreatedAt());
                            $newsTrans->setUpdatedAt($news->getCreatedAt());
                            $newsTrans->setIsPublishedOnFDCEvent(true);
                            $news->addTranslation($newsTrans);
                            if ($culture == 'fr') {
                                $newsTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                            } else {
                                $newsTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                            }
                        }

                        $newsTrans->setTitle(strip_tags($oldArticleTranslation->getTitle()));
                        foreach ($mapperFields as $oldField => $field) {
                            $newsTrans->{'set' . ucfirst($field)}($oldArticleTranslation->{'get' . ucfirst($oldField)}());
                        }

                        // Image header / image accroche
                        if ($news->getHeader() == null) {
                            $img = new MediaImage();
                        } else {
                            $img = $news->getHeader();
                        }
                        if ($img->getSites()->count() == 0) {
                            $img->addSite($siteFDCCorporate);
                        }
                        $news->setHeader($img);
                        if ($img != null) {
                            $media = ($img->findTranslationByLocale($culture) != null && $img->findTranslationByLocale($culture)->getFile() != null) ? $img->findTranslationByLocale($culture)->getFile() : new Media();
                        } else {
                            $media = new Media();
                        }
                        if ($media->getId() == null && $oldArticleTranslation->getImageResume()) {
                            $url = 'http://www.festival-cannes.fr/assets/Image/Pages/' . $oldArticleTranslation->getImageResume();
                            $file = $this->imagecreatefromfile($url, $output);
                            $media->setContentType('image/jpeg');
                            $media->setName($oldArticleTranslation->getImageResume());
                            $media->setBinaryContent($file);
                            $media->setEnabled(true);
                            $media->setProviderReference($oldArticleTranslation->getImageResume());
                            $media->setContext('media_image');
                            $media->setProviderStatus(1);
                            $media->setProviderName('sonata.media.provider.image');
                            $mediaManager->save($media, 'media_image', 'sonata.media.provider.image');
                        }
                        $imgTrans = $img->findTranslationByLocale($culture);
                        if ($imgTrans == null) {
                            $imgTrans = new MediaImageTranslation();
                        }
                        if ($culture == 'fr') {
                            $imgTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                        } else {
                            $imgTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                        }
                        $imgTrans->setTranslatable($img);
                        $imgTitle = array(
                            'fr' => 'photo',
                            'en' => 'photo',
                            'es' => 'foto',
                            'zh' => '照片'
                        );
                        $imgTrans->setLegend(($oldArticleTranslation->getTitleImageResume() != null) ? $oldArticleTranslation->getTitleImageResume() : $imgTitle[$culture]);
                        $imgTrans->setLocale($culture);
                        $imgTrans->setisPublishedOnFDCEvent(1);
                        if ($oldArticleTranslation->getImageResume()) {
                            $imgTrans->setFile($media);
                        }
                        if ($img->findTranslationBylocale($culture) == null) {
                            $img->addTranslation($imgTrans);
                        }

                        // widget text / annonce
                        $widgetCount = 0;
                        if ($oldArticleTranslation->getBody() != null) {
                            $widgetCount++;
                            if ($news->getWidgets()->count() == 0) {
                                $widgetText = clone $entitiesArray['widget_text'];
                                $widgetText->setPosition($widgetCount);
                            } else {
                                $widgets = $news->getWidgets();
                                $widgetText = $widgets->get(0);
                            }

                            $widgetTextTranslation = clone $entitiesArray['widget_text_trans'];
                            if ($widgetText->findTranslationByLocale($culture) != null) {
                                $widgetTextTranslation = $widgetText->findTranslationByLocale($culture);
                            }
                            $widgetTextTranslation->setLocale($culture);
                            $widgetTextTranslation->setContent($oldArticleTranslation->getBody());
                            $widgetTextTranslation->setTranslatable($widgetText);
                            $widgetText->addTranslation($widgetTextTranslation);

                            if ($widgetText->getId() == null) {
                                $news->addWidget($widgetText);
                            }
                        }

                        // widget video youtube / youtube link / description
                        if ($oldArticleTranslation->getYoutubeLink() != null ||
                            $oldArticleTranslation->getYoutubeLinkDescription() != null) {
                            $widgetVideoYoutube = clone $entitiesArray['widget_yt'];
                            $widgetCount++;
                            $widgetVideoYoutube->setPosition($widgetCount);
                            foreach ($news->getWidgets() as $widget) {
                                if (strpos(get_class($widget), $entitiesArray['widget_yt_entity'])) {
                                    $widgetVideoYoutube = $widget;
                                    break;
                                }
                            }

                            $widgetVideoYoutubeTranslation = clone $entitiesArray['widget_yt_trans'];
                            if ($widgetVideoYoutube->findTranslationByLocale($culture) != null) {
                                $widgetVideoYoutubeTranslation = $widgetVideoYoutube->findTranslationByLocale($culture);
                            }

                            $widgetVideoYoutubeTranslation->setLocale($culture);
                            $widgetVideoYoutubeTranslation->setUrl($oldArticleTranslation->getYoutubeLink());
                            $widgetVideoYoutubeTranslation->setTitle($oldArticleTranslation->getYoutubeLinkDescription());
                            $widgetVideoYoutubeTranslation->setTranslatable($widgetVideoYoutube);
                            if ($widgetVideoYoutube->getId() == null) {
                                $news->addWidget($widgetVideoYoutube);
                            }
                        }

                        // widget photo / association image
                        $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                            'id' => $oldArticle->getId(),
                            'objectClass' => 'Image'
                        ), array('order' => 'ASC'));
                        if (count($oldArticleAssociations) > 0) {
                            $widgetCount++;
                            $widget = $this->getWidget($news, $widgetCount, clone $entitiesArray['widget_image']);
                            $widget->setPosition($widgetCount);
                            if ($widget->getGallery() == null) {
                                $gallery = new Gallery();
                                $widget->setGallery($gallery);
                            } else {
                                $gallery = $widget->getGallery();
                            }
                            $gallery->setName('Galerie');
                            if ($culture == 'fr') {
                                $gallery->setName($oldArticleTranslation->getMosaiqueTitle());
                            }
                            foreach ($oldArticleAssociations as $associationKey => $association) {
                                $image = $dm->getRepository('BaseCoreBundle:OldMedia')->findOneById($association->getObjectId());
                                $img = new MediaImage();
                                if ($gallery->getMedias()->get($associationKey) != null) {
                                    $img = $gallery->getMedias()->get($associationKey)->getMedia();
                                }
                                if ($img != null) {
                                    $media = ($img->findTranslationByLocale($culture) != null && $img->findTranslationByLocale($culture)->getFile() != null) ? $img->findTranslationByLocale('fr')->getFile() : new Media();
                                } else {
                                    $media = new Media();
                                }
                                if ($img->getSites()->count() == 0) {
                                    $img->addSite($siteFDCCorporate);
                                }
                                $img->setOldMediaId($association->getObjectId());
                                $saved = false;
                                if ($media->getId() == null && $culture == 'fr') {
                                    $file = $this->imagecreatefromfile('http://www.festival-cannes.fr/assets/Image/General/' . trim($image->getFilename()), $output);
                                    $media->setName($image->getFilename());
                                    $media->setBinaryContent($file);
                                    $media->setEnabled(true);
                                    $media->setProviderReference($image->getFilename());
                                    $media->setContext('media_image');
                                    $media->setProviderStatus(1);
                                    $media->setProviderName('sonata.media.provider.image');
                                    $mediaManager->save($media, 'media_image', 'sonata.media.provider.image');
                                    $saved = true;
                                }
                                $imgTrans = $img->findTranslationByLocale($culture);
                                $oldMediaTrans = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findOneBy(array(
                                    'id' => $association->getObjectId(),
                                    'culture' => $oldArticleTranslation->getCulture()
                                ));
                                if ($imgTrans == null) {
                                    $imgTrans = new MediaImageTranslation();
                                    $img->addTranslation($imgTrans);
                                }
                                if ($culture == 'fr') {
                                    $imgTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                                } else {
                                    $imgTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                                }
                                if ($saved == true) {
                                    $imgTrans->setFile($media);
                                }
                                $imgTrans->setTranslatable($img);
                                $imgTitle = array(
                                    'fr' => 'photo',
                                    'en' => 'photo',
                                    'es' => 'foto',
                                    'zh' => '照片'
                                );
                                $imgTrans->setLegend(($oldMediaTrans->getLabel() != null) ? $oldMediaTrans->getLabel() : $imgTitle[$culture]);
                                $imgTrans->setCopyright($oldMediaTrans->getCopyright());
                                $imgTrans->setLocale($culture);
                                $imgTrans->setisPublishedOnFDCEvent(1);
                                if ($gallery->getMedias()->count() != count($oldArticleAssociations)) {
                                    $galleryMedia = new GalleryMedia();
                                    $galleryMedia->setGallery($gallery);
                                    $galleryMedia->setMedia($img);
                                    $galleryMedia->setPosition($associationKey + 1);
                                    $gallery->addMedia($galleryMedia);
                                }
                            }
                            if ($widget->getId() == null) {
                                $news->addWidget($widget);
                            }
                        }

                        // association audios
                        $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                            'id' => $oldArticle->getId(),
                            'objectClass' => 'Audio'
                        ), array('order' => 'asc'));
                        if (count($oldArticleAssociations) > 0) {
                            $output->writeln('Import associated audios');
                            foreach ($oldArticleAssociations as $associationKey => $association) {
                                $widgetCount++;
                                $widget = $this->getWidget($news, $widgetCount, clone $entitiesArray['widget_audio']);
                                $widget->setPosition($widgetCount);

                                if ($widget->getFile() != null) {
                                    $audio = $widget->getFile();
                                } else {
                                    $audio = new MediaAudio();
                                    $widget->setFile($audio);
                                    $dm->persist($audio);
                                }
                                $audio->setOldMediaId($association->getObjectId());

                                $oldAudioAssciations = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findBy(array(
                                    'id' => $association->getObjectId(),
                                    'culture' => $culture
                                ));

                                foreach ($oldAudioAssciations as $oldAudio) {
                                    $audioTrans = new MediaAudioTranslation();
                                    if ($audio->findTranslationByLocale($culture) != null) {
                                        $audioTrans = $audio->findTranslationByLocale($culture);
                                    } else {
                                        $audio->addTranslation($audioTrans);
                                    }
                                    $audioTrans->setLocale($culture);
                                    $audioTrans->setTranslatable($audio);
                                    $audioTitle = array(
                                        'fr' => 'audio',
                                        'en' => 'audio',
                                        'es' => 'audio',
                                        'zh' => '音频'
                                    );
                                    $audioTrans->setTitle(($oldAudio->getLabel() != null) ? $oldAudio->getLabel() : $audioTitle[$culture]);
                                    $audioTrans->setJobMp3State(MediaAudioTranslation::ENCODING_STATE_READY);
                                    if ($audioTrans->getFile() == null) {
                                        $media = new Media();
                                    } else {
                                        $media = $audioTrans->getFile();
                                    }
                                    $code = $oldAudio->getCode();
                                    $audioPath = 'http://www.festival-cannes.fr/mp3/'. trim($code). '.mp3';
                                    if ($oldAudio->getCode() == null) {
                                        $oldAudioBi = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findOneBy(array(
                                            'id' => $association->getObjectId(),
                                            'culture' => 'bi'
                                        ));
                                        if ($oldAudioBi != null && $oldAudioBi->getCode() != null) {
                                            $code = $oldAudioBi->getCode();
                                            $audioPath = 'http://www.festival-cannes.fr/mp3/'. trim($code). '.mp3';
                                        }

                                        if ($code == null && $oldAudio->getHdFormatFilename() != null) {
                                            $code = $oldAudio->getHdFormatFilename();
                                            $audioPath = 'http://www.festival-cannes.fr/'. trim($code);
                                        }

                                        if ($code == null) {
                                            $output->writeln("<error>No path for audio found for OldMediaI18n #{$association->getObjectId()}</error>");
                                            continue;
                                        }
                                    }
                                    if ($code != null) {
                                        $file = $this->createAudio($audioPath, $output);
                                        if ($file == null) {
                                            break;
                                        }
                                        $media->setName($oldAudio->getLabel());
                                        $media->setBinaryContent($file);
                                        $media->setEnabled(true);
                                        $media->setProviderReference($oldAudio->getLabel());
                                        $media->setContext('media_audio');
                                        $media->setProviderStatus(1);
                                        $media->setProviderName('sonata.media.provider.audio');
                                        $mediaManager->save($media, 'media_audio', 'sonata.media.provider.audio');
                                        $audioTrans->setFile($media);
                                        $audioTrans->setTitle($oldAudio->getLabel());
                                        $audioTrans->setJobMp3State(MediaAudioTranslation::ENCODING_STATE_READY);
                                    } else {
                                        $output->writeln("<error>Audio code not found for Object id #{$association->getObjectId()}</error>");
                                    }
                                    $dm->flush();
                                }
                                if ($widget->getId() == null) {
                                    $news->addWidget($widget);
                                }
                            }
                        }

                        // association videos
                        $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                            'id' => $oldArticle->getId(),
                            'objectClass' => 'Video'
                        ), array('order' => 'asc'));
                        if (count($oldArticleAssociations) > 0) {
                            $output->writeln('Import associated videos');
                            foreach ($oldArticleAssociations as $associationKey => $association) {
                                $output->writeln('old video association');
                                $widgetCount++;
                                $widget = $this->getWidget($news, $widgetCount, clone $entitiesArray['widget_video']);
                                $widget->setPosition($widgetCount);

                                if ($widget->getFile() != null) {
                                    $video = $widget->getFile();
                                } else {
                                    $video = new MediaVideo();
                                    $widget->setFile($video);
                                    $dm->persist($video);
                                }
                                $video->setOldMediaId($association->getObjectId());

                                $oldVideoAssociations = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findBy(array(
                                    'id' => $association->getObjectId(),
                                    'culture' => $culture
                                ));

                                foreach ($oldVideoAssociations as $oldVideo) {
                                    $output->writeln('old video translation');
                                    $videoTrans = new MediaVideoTranslation();
                                    if ($video->findTranslationByLocale($culture) != null) {
                                        $videoTrans = $video->findTranslationByLocale($culture);
                                    } else {
                                        $video->addTranslation($videoTrans);
                                    }
                                    $videoTrans->setLocale($culture);
                                    $videoTrans->setTranslatable($video);
                                    $videoTrans->setJobMp4State(MediaVideoTranslation::ENCODING_STATE_READY);
                                    $videoTrans->setJobWebmState(MediaVideoTranslation::ENCODING_STATE_READY);
                                    $videoTitle = array(
                                        'fr' => 'video',
                                        'en' => 'video',
                                        'es' => 'video',
                                        'zh' => '视频'
                                    );
                                    $videoTrans->setTitle(($oldVideo->getLabel() != null) ? $oldVideo->getLabel() : $videoTitle[$culture]);
                                    if ($videoTrans->getFile() == null) {
                                        $media = new Media();
                                    } else {
                                        $media = $videoTrans->getFile();
                                    }
                                    if ($oldVideo->getDeliveryUrl() == null) {
                                        $output->writeln("<error>Delivery url is null for old video #{$oldVideo->getId()}</error>");
                                        continue;
                                    }
                                    $path = $oldVideo->getDeliveryUrl();
                                    $output->writeln('Video delivery url: '. $path);
                                    $pathArray = explode(',', $path);
                                    $path = $pathArray[0]. '80'. $pathArray[count($pathArray) - 1];
                                    $output->writeln('before create video');
                                    $file = $this->createVideo('http://canneshd-a.akamaihd.net/' . trim($path), $output);
                                    $output->writeln('after create video');
                                    if ($file == null) {
                                        break;
                                    }
                                    $media->setName($oldVideo->getLabel());
                                    $media->setBinaryContent($file);
                                    $media->setEnabled(true);
                                    $media->setProviderReference($oldVideo->getLabel());
                                    $media->setContext('media_video');
                                    $media->setProviderStatus(1);
                                    $media->setProviderName('sonata.media.provider.video');
                                    $mediaManager->save($media);
                                    $videoTrans->setFile($media);
                                    break;
                                }
                                if ($widget->getId() == null) {
                                    $news->addWidget($widget);
                                }
                                break;
                            }
                        }

                        // association film
                        $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                            'id' => $oldArticle->getId(),
                            'objectClass' => 'Film'
                        ), array('order' => 'asc'));

                        if (count($oldArticleAssociations) > 0) {
                            $output->writeln('Import associated films');
                            foreach ($oldArticleAssociations as $association) {
                                $filmFilm = $dm->getRepository('BaseCoreBundle:FilmFilm')->findOneById($association->getObjectId());
                                if ($filmFilm == null) {
                                    $output->writeln("<error>Film #{$association->getObjectId()} not found</error>");
                                } else {
                                    if ($news->getAssociatedFilm() == null) {
                                        $news->setAssociatedFilm($filmFilm);
                                    }
                                    $found = false;
                                    foreach ($news->getAssociatedFilms() as $associated) {
                                        if ($associated->getAssociation()->getId() == $filmFilm->getId()) {
                                            $found = true;
                                        }
                                    }
                                    if ($found == false) {
                                        $associated = clone $entitiesArray['association'];
                                        $associated->{$entitiesArray['association_film_setter']}($news);
                                        $associated->setAssociation($filmFilm);
                                        $news->addAssociatedFilm($associated);
                                    }
                                }
                            }
                        }
                    }

                    // association articles
                    $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                        'id' => $oldArticle->getId(),
                        'objectClass' => 'Article'
                    ), array('order' => 'asc'));

                    if (count($oldArticleAssociations) > 0) {
                        $output->writeln('Import associated articles');
                        foreach ($oldArticleAssociations as $association) {
                            $oldNewsId = $association->getObjectId();
                            $associationNews = $dm->getRepository($entitiesArray['main_entity_parent'])->findOneByOldNewsId($oldNewsId);
                            if ($associationNews !== null) {
                                if ($news->contains($associationNews) == false) {
                                    $news->{$entitiesArray['association_setter']}($associationNews);
                                }
                            }
                        }
                    }
                }
            }

            if ($news->getId() == null) {
                $dm->persist($news);
            }
            $entities[] = $news;
            $output->writeln('<info>To be saved...</info>');
            $totalSaved++;

            if ($totalSaved % 100 == 0) {
                $output->writeln('<info>Saved !</info>');
                $dm->flush();
                $this->updateAcl($entities, $entitiesArray['acl_update'], $output);
                $entities = array();
            }
        }

        if ($optionCount) {
            dump($this->entitiesCount);
        } else {
            $output->writeln('<info>Total saved: ' . $totalSaved . '</info>');
            $dm->flush();
            $this->updateAcl($entities, $entitiesArray['acl_update'], $output);
        }
    }

    private function getWidget($news, $pos, $entity)
    {
        if ($news->getWidgets()->get($pos - 1) !== null) {
            return $news->getWidgets()->get($pos - 1);
        }

        return $entity;
    }

    private function isCommuniqueMatching($oldArticle, $oldArticleTranslations, $dm, $output, $input)
    {
        $optionCount = $input->getOption('count');

        // case one
        // Communiqués-Festival de 2001 > 2015
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2001 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $this->updateCount(__FUNCTION__, 1);
            if ($optionCount == false) {
                return true;
            }
        }
    }

    private function isActualiteMatching($oldArticle, $oldArticleTranslations, $dm, $output, $input)
    {
        $optionCount = $input->getOption('count');

        // case one
        // Actualités-Festival de 2010 > 2015
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2010 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $this->updateCount(__FUNCTION__, 1);
            if ($optionCount == false) {
                return true;
            }
        }
    }

    private function updateCount($functionName, $pos)
    {
        $this->entitiesCount[$functionName][$pos] = (isset($this->entitiesCount[$functionName][$pos])) ?
            ($this->entitiesCount[$functionName][$pos] + 1) : 1;
    }


    private function isQuotidienMatching($oldArticle, $oldArticleTranslations, $dm, $output, $input)
    {
        $optionCount = $input->getOption('count');
        $this->doNotPublish = false;

        // case one
        // Communiqués-Festival de 2001 > 2006
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2001 && $oldArticle->getCreatedAt()->format('Y') <= 2006) {
            $this->updateCount(__FUNCTION__, 1);
            if ($optionCount == false) {
                return true;
            }
        }

        // case two
        // Quotidien 2007 > 2015 - Articles Conférence de presse (films / jurys / lauréats)
        // "conférence" dans le titre + film associé
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasConference = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'conference') !== false)) {
                    $hasConference = true;
                }
            }

            if ($hasConference == true) {
                $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findOneBy(array(
                    'id' => $oldArticle->getId(),
                    'objectClass' => 'Film'
                ));

                if (count($oldArticleAssociations) > 0) {
                    $this->updateCount(__FUNCTION__, 2);
                    if ($optionCount == false) {
                        return true;
                    }
                }
            }
        }

        // case third
        $types  = array(
            'competition', 'un certain regard', 'hors competition',
            'seances speciales', 'cinefondation', 'courts metrages',
            'cannes classics', 'cinema de la plage'
        );
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasType = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr') {
                    foreach($types as $type) {
                        if (stripos($title, $type) !== false) {
                            $hasType = true;
                            break 2;
                        }
                    }
                }
            }

            if ($hasType == true) {
                $this->updateCount(__FUNCTION__, 3);
                if ($optionCount == false) {
                    return true;
                }
            }
        }

        // case fourth
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2013 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasFilm = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'palmares') !== false)) {
                    $hasFilm = true;
                }
            }

            if ($hasFilm == true) {
                $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findOneBy(array(
                    'id' => $oldArticle->getId(),
                    'objectClass' => 'Film'
                ));

                if (count($oldArticleAssociations) > 0) {
                    $this->updateCount(__FUNCTION__, 4);
                    if ($optionCount == false) {
                        return true;
                    }
                }
            }
        }

        // case five
        // Quotidien 2007 > 2015 - Articles Palmarès Cinéfondation
        // "Cinéfondation" + "prix" ou "palmarès" dans le titre
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasCinefondation = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'cinefondation') !== false &&
                        (stripos($title, 'prix') !== false || stripos($title, 'palmares') !== false))) {
                    $hasCinefondation = true;
                }
            }

            if ($hasCinefondation == true) {
                $this->updateCount(__FUNCTION__, 5);
                if ($optionCount == false) {
                    return true;
                }
            }
        }

        // case six
        // Quotidien 2007 > 2015 - Articles Palmarès Un Certain Regard
        // "Un Certain Regard" + "prix" ou "palmarès" dans le titre
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasCinefondation = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'un certain regard') !== false &&
                        (stripos($title, 'prix') !== false || stripos($title, 'palmares') !== false))) {
                    $hasCinefondation = true;
                }
            }

            if ($hasCinefondation == true) {
                $this->updateCount(__FUNCTION__, 6);
                if ($optionCount == false) {
                    return true;
                }
            }
        }

        // case seven
        // Quotidien 2007 > 2015 - Articles pratiques
        // "le savez-vous" ou "le saviez-vous" dans le titre
        if ($oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasKnown = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' &&
                        (stripos($title, 'le savez-vous') !== false || stripos($title, 'le saviez-vous') !== false)) {
                    $hasKnown = true;
                }
            }

            if ($hasKnown == true) {
                $this->doNotPublish = true;
                $this->updateCount(__FUNCTION__, 7);
                if ($optionCount == false) {
                    return true;
                }
            }
        }

        // case eight
        // Quotidien 2007 > 2015 - Interview réalisateurs
        // "Rencontre" ou "Interview" ou "entretien" dans le titre
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasCinefondation = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'rencontre') !== false ||
                        (stripos($title, 'interview') !== false || stripos($title, 'entretien') !== false))) {
                    $this->updateCount(__FUNCTION__, 8);
                    if ($optionCount == false) {
                        return true;
                    }
                }
            }
        }

        // case nine - TO DO
        // Quotidien 2007 > 2015 - Interview Jurys
        // - "jury" + "interview" || "jury" + "rencontre" || "jury" + "entretien"
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasJury = false;
            $hasOther = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && stripos($title, 'jury') !== false) {
                    $hasJury = true;
                }
                if ($trans->getCulture() == 'fr' && (stripos($title, 'interview') !== false || stripos($title, 'rencontre') !== false ||
                            stripos($title, 'entretien') !== false)) {
                    $hasOther = true;
                }
            }

            // association videos
            if ($hasJury == false && $hasOther == true) {
                $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                    'id' => $oldArticle->getId(),
                    'objectClass' => 'Video'
                ), array('order' => 'asc'));
                if (count($oldArticleAssociations) > 0) {
                    foreach ($oldArticleAssociations as $oldArticleAssociation) {
                        $oldVideoAssociations = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findBy(array(
                            'id' => $oldArticleAssociation->getObjectId(),
                        ));
                        foreach ($oldVideoAssociations as $oldVideoAssociation) {
                            $title = $this->removeAccents($oldVideoAssociation->getLabel());
                            if (stripos($title, 'jury') !== false) {
                                $hasJury = true;
                            }
                        }
                    }
                }
            }

            if ($hasJury == true && $hasOther == true) {
                $this->updateCount(__FUNCTION__, 9);
                if ($optionCount == false) {
                    return true;
                }
            }
        }

        // case ten
        // Quotidien 2007 > 2015 - Phrases du jour
        // "Phrase du jour" dans le titre
        if ($oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasSentence = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && stripos($title, 'phrase du jour') !== false) {
                    $hasSentence = true;
                }
            }

            if ($hasSentence == true) {
                $this->doNotPublish = true;
                $this->updateCount(__FUNCTION__, 10);
                if ($optionCount == false) {
                    return true;
                }
            }
        }

        // case eleven
        // Quotidien 2007 > 2015 - Présence à Cannes
        // "Présence à Cannes" dans le titre
        if ($oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasSentence = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' &&
                    (stripos($title, 'presence a cannes') !== false || stripos($title, 'presences a cannes') !== false)) {
                    $hasSentence = true;
                }
            }

            if ($hasSentence == true) {
                $this->doNotPublish = true;
                $this->updateCount(__FUNCTION__, 11);
                if ($optionCount == false) {
                    return true;
                }
            }
        }


        // case twelve
        // Quotidien 2007 > 2015 - articles Cérémonies
        // "Cérémonie" dans le titre + "Ouverture" ou "Cloture" dans le titre
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasCinefondation = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'Ceremonie') !== false &&
                        (stripos($title, 'ouverture') !== false || stripos($title, 'cloture') !== false))) {
                    $hasCinefondation = true;
                }
            }

            if ($hasCinefondation == true) {
                $this->updateCount(__FUNCTION__, 12);
                if ($optionCount == false) {
                    return true;
                }
            }
        }

        // case thirteen
        // Quotidien 2007 > 2015 - Leçons
        // "Lecon de cinéma" ou "lecon de musique" ou "lecon d'actrice" dans le titre
        if ($oldArticle->getIsOnline() == true && $oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasCinefondation = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'Lecon de cinema') !== false ||
                        stripos($title, 'Lecon de musique') !== false ||
                        stripos($title, 'Lecon d\'actrice') !== false)) {
                    $hasCinefondation = true;
                }
            }

            if ($hasCinefondation == true) {
                $this->updateCount(__FUNCTION__, 13);
                if ($optionCount == false) {
                    return true;
                }
            }
        }

        $output->writeln('<error>Doesn\'t match</error>');

        return false;
    }

    private function hasFrenchTranslation($oldArticleTranslations, $output)
    {
        foreach ($oldArticleTranslations as $trans) {
            if ($trans->getCulture() == 'fr') {
                return true;
            }
        }

        $output->writeln('<error>Doesn\'t have french translation</error>');

        return false;
    }

    private function removeAccents($string)
    {
        if ( !preg_match('/[\x80-\xff]/', $string) )
            return $string;

        $chars = array(
            // Decompositions for Latin-1 Supplement
            chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
            chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
            chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
            chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
            chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
            chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
            chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
            chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
            chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
            chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
            chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
            chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
            chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
            chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
            chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
            chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
            chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
            chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
            chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
            chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
            chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
            chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
            chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
            chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
            chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
            chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
            chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
            chr(195).chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
            chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
            chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
            chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
            chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
            chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
            chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
            chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
            chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
            chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
            chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
            chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
            chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
            chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
            chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
            chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
            chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
            chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
            chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
            chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
            chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
            chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
            chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
            chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
            chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
            chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
            chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
            chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
            chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
            chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
            chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
            chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
            chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
            chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
            chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
            chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
            chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
            chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
            chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
            chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
            chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
            chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
            chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
            chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
            chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
            chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
            chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
            chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
            chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
            chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
            chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
            chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
            chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
            chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
            chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
            chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
            chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
            chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
            chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
            chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
            chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
            chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
            chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
            chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
        );

        $string = strtr($string, $chars);

        return $string;
    }

    private function imagecreatefromfile($filename, $output) {
        $file = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/old/image/'. md5($filename). '.'. pathinfo( $filename, PATHINFO_EXTENSION);
        $content = @file_get_contents($filename);
        $output->writeln('Creating file: '. $filename);
        if ($content === false) {
            $output->writeln("<error>Cant get file: {$filename}</error>");
            return;
        }
        $im = imagecreatefromstring($content);

        switch (strtolower(pathinfo( $filename, PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($im, $file);
                break;

            case 'png':
                imagepng($im, $file);
                break;

            default:
                $output->writeln("extension doesnt exist {$filename}");
                break;
        }

        return $file;
    }

    private function createVideo($url, $output)
    {
        $path = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/old/video/'. md5($url). '.'. pathinfo($url, PATHINFO_EXTENSION);

        $output->writeln('Video path: '. $path);
        if (!file_exists($path)) {
            $output->writeln('Download video: '. $url);
            $data = @file_get_contents($url);
            if ($data === false) {
                $output->writeln("<error>Cant get file: {$url}</error>");
                return;
            }

            $file = fopen($path, "w+");
            fwrite($file, $data);
            fclose($file);
        }

        return $path;
    }

    private function createAudio($url, $output)
    {
        $path = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/old/audio/'. md5($url). '.'. pathinfo($url, PATHINFO_EXTENSION);

        $output->writeln('Audio path: '. $path);
        if (!file_exists($path)) {
            $output->writeln('Download audio: '. $url);
            $data = @file_get_contents($url);
            if ($data === false) {
                $output->writeln("<error>Cant get file: {$url}</error>");
                return;
            }

            $file = fopen($path, "w+");
            fwrite($file, $data);
            fclose($file);
        }

        return $path;
    }

    private function updateAcl($entities, $service, $output)
    {
        $adminSecurityHandler = $this->getContainer()->get('sonata.admin.security.handler');
        $modelAdmin = $this->getContainer()->get($service);
        $securityInformation = $adminSecurityHandler->buildSecurityInformation($modelAdmin);

        foreach ($entities as $key => $object) {
            $objectIdentity = ObjectIdentity::fromDomainObject($object);
            $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
            if (is_null($acl)) {
                $acl = $adminSecurityHandler->createAcl($objectIdentity);
            }
            $adminSecurityHandler->addObjectClassAces($acl, $securityInformation);
            $adminSecurityHandler->updateAcl($acl);
            $output->writeln('Update Acl for: ' . $object->getId());
            unset($object);
        }
    }
}