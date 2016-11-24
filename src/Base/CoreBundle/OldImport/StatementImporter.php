<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Base\CoreBundle\Entity\StatementArticle;
use Base\CoreBundle\Entity\StatementArticleTranslation;
use Base\CoreBundle\Entity\StatementFilmFilmAssociated;
use Base\CoreBundle\Entity\StatementStatementAssociated;
use Base\CoreBundle\Entity\StatementWidgetAudio;
use Base\CoreBundle\Entity\StatementWidgetImage;
use Base\CoreBundle\Entity\StatementWidgetText;
use Base\CoreBundle\Entity\StatementWidgetTextTranslation;
use Base\CoreBundle\Entity\StatementWidgetVideo;
use Base\CoreBundle\Entity\StatementWidgetVideoYoutube;
use Base\CoreBundle\Entity\StatementWidgetVideoYoutubeTranslation;
use Symfony\Component\Console\Helper\ProgressBar;

class StatementImporter extends Importer
{
    protected $widgetPosition = 0;

    public function importStatements()
    {
        $this->output->writeln('<info>Import statements...</info>');

        $count = $this->countStatements();

        $pages = ceil($count / 50);

        $progress = new ProgressBar($this->output, $count);
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();

        for ($page = 1; $page <= $pages; $page++) {
            $oldArticles = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldArticle')
                ->findBy(['articleTypeId' => static::TYPE_COMMUNIQUE], ['id' => 'asc'], 50, ($page - 1) * 50)
            ;

            foreach ($oldArticles as $oldArticle) {
                $progress->advance();
                $statement = $this->importItem($oldArticle);
                if ($statement) {
                    foreach ($this->langs as $lang) {
                        $translation = $statement->findTranslationByLocale($lang);
                    }
                }
            }
            $this->getManager()->clear();
            unset($oldArticles);
            $this->getSiteEvent(true);
            $this->getSiteCorporate(true);
        }
        $progress->finish();


        return $this;
    }

    protected function countStatements()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->createQueryBuilder('o')
            ->select('count(o)')
            ->andWhere('o.articleTypeId = :type')
            ->setParameter(':type', static::TYPE_COMMUNIQUE)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param OldArticle $oldArticle
     * @return StatementArticle
     */
    protected function importItem(OldArticle $oldArticle)
    {
        $oldTranslations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleI18n')
            ->findBy(['id' => $oldArticle->getId()])
        ;

        if (!$oldTranslations) {
            return null;
        }

        // has french translation
        $hasFrenchTranslation = $this->hasFrenchTranslation($oldTranslations);
        if (!$hasFrenchTranslation) {
            return null;
        }

        $matching = $this->isStatementMatching($oldArticle);
        if (!$matching) {
            return null;
        }

        $statement = $this->buildStatementArticle($oldArticle);

        foreach ($oldTranslations as $oldTranslation) {
            $translation = $this->buildStatementArticleTranslation($statement, $oldTranslation);
            if ($translation) {
                $this->buildStatementWidgetText($statement, $translation, $oldTranslation);
                $this->buildStatementWidgetYoutube($statement, $translation, $oldTranslation);
                $this->buildStatementWidgetImage($statement, $translation, $oldTranslation);
                $this->buildStatementWidgetsAudio($statement, $translation, $oldTranslation);
                $this->buildStatementWidgetsVideo($statement, $translation, $oldTranslation);
                $this->buildAssociatedFilms($statement, $oldArticle);
                $this->buildAssociatedStatements($statement, $oldArticle);
            }
        }

        return $statement;
    }

    /**
     * @param OldArticle $oldArticle
     * @return StatementArticle
     */
    protected function buildStatementArticle(OldArticle $oldArticle)
    {
        $statement = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:StatementArticle')
            ->findOneBy(['oldNewsId' => $oldArticle->getId()])
        ;

        if (!$statement) {
            $statement = new StatementArticle();
            $statement
                ->setOldNewsId($oldArticle->getId())
                ->setOldNewsTable('OldNews')
                ->setPublishedAt($oldArticle->getStartDate() ?: $oldArticle->getUpdatedAt())
                ->setCreatedAt($oldArticle->getCreatedAt())
                ->setUpdatedAt($oldArticle->getUpdatedAt())
                ->setFestival($this->getFestival($oldArticle))
                ->setTheme($this->defaultTheme)
                ->setIsPublishedOnFDCEvent(true) // test if works
            ;
            $this->getManager()->persist($statement);
        }


        if ($this->doNotPublish) {
            if (!$statement->getSites()->contains($this->getSiteCorporate())) {
                $statement->addSite($this->getSiteCorporate());
            }
            if (!$statement->getSites()->contains($this->getSiteEvent())) {
                $statement->addSite($this->getSiteEvent());
            }
        }

        $this->getManager()->flush();

        return $statement;
    }

    /**
     * @param StatementArticle $statement
     * @param OldArticleI18n $oldTranslation
     * @return StatementArticleTranslation
     */
    protected function buildStatementArticleTranslation(StatementArticle $statement, OldArticleI18n $oldTranslation)
    {
        $mapperFields = array(
            'resume' => 'introduction',
        );

        $locale = $oldTranslation->getCulture() == 'cn' ? 'zh' : $oldTranslation->getCulture();
        if (in_array($locale, $this->langs)) {
            $translation = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:StatementArticleTranslation')
                ->findOneBy(['locale' => $locale, 'translatable' => $statement])
            ;

            if (!$translation) {
                $translation = new StatementArticleTranslation();
                $translation
                    ->setCreatedAt($statement->getCreatedAt())
                    ->setUpdatedAt($statement->getCreatedAt())
                    ->setTranslatable($statement)
                    ->setLocale($locale)
                    ->setIsPublishedOnFDCEvent(true)
                ;
                $this->getManager()->persist($translation);

                if ($locale == 'fr') {
                    $translation->setStatus(StatementArticleTranslation::STATUS_PUBLISHED);
                } else {
                    $translation->setStatus(StatementArticleTranslation::STATUS_TRANSLATED);
                }
            }

            $translation->setTitle(strip_tags($oldTranslation->getTitle()));

            foreach ($mapperFields as $oldField => $field) {
                $translation->{'set' . ucfirst($field)}($oldTranslation->{'get' . ucfirst($oldField)}());
            }
            $this->getManager()->flush();
            return $translation;
        }
    }

    protected function buildStatementWidgetText(StatementArticle $statement, StatementArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getBody()) {
            return null;
        }
        $widget = null;
        foreach ($statement->getWidgets() as $item) {
            if ($item instanceof StatementWidgetText && $item->getOldImportReference() == 'body') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new StatementWidgetText();
            $widget
                ->setStatement($statement)
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new StatementWidgetTextTranslation();
            $widgetTranslation
                ->setTranslatable($widget)
                ->setLocale($translation->getLocale())
            ;
            $this->getManager()->persist($widgetTranslation);
        }

        $widgetTranslation->setContent($oldTranslation->getBody());

        $this->getManager()->flush();
        return $widget;
    }

    protected function buildStatementWidgetYoutube(StatementArticle $statement, StatementArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getYoutubeLink() || !$oldTranslation->getYoutubeLinkDescription()) {
            return null;
        }

        $widget = null;
        foreach ($statement->getWidgets() as $item) {
            if ($item instanceof StatementWidgetVideoYoutube && $item->getOldImportReference() == 'youtube') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new StatementWidgetVideoYoutube();
            $widget
                ->setStatement($statement)
                ->setOldImportReference('youtube')
                ->setPosition($this->getWidgetPosition())
            ;
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new StatementWidgetVideoYoutubeTranslation();
            $widgetTranslation
                ->setTranslatable($widget)
                ->setLocale($translation->getLocale())
            ;
            $this->getManager()->persist($widgetTranslation);
        }

        $widgetTranslation->setUrl($oldTranslation->getYoutubeLink());
        $widgetTranslation->setTitle($oldTranslation->getYoutubeLinkDescription());

        $this->getManager()->flush();

        return $widget;
    }

    protected function buildStatementWidgetImage(StatementArticle $statement, StatementArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        $imgTitle = array(
            'fr' => 'photo',
            'en' => 'photo',
            'es' => 'foto',
            'zh' => '照片',
        );

        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')
            ->findBy(['id' => $oldTranslation->getId(), 'objectClass' => 'Image'], ['order' => 'ASC'])
        ;

        if (!$oldArticleAssociations) {
            return null;
        }

        $widget = null;
        foreach ($statement->getWidgets() as $item) {
            if ($item instanceof StatementWidgetImage && $item->getOldImportReference() == 'image') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new StatementWidgetImage();
            $widget
                ->setStatement($statement)
                ->setOldImportReference('image')
                ->setPosition($this->getWidgetPosition())
            ;
            $this->getManager()->persist($widget);
        }

        $gallery = $widget->getGallery();
        if (!$gallery) {
            $gallery = new Gallery();
            $this->getManager()->persist($gallery);
            $widget->setGallery($gallery);
            $gallery
                ->setDisplayedHomeCorpo(false);
        }

        if ($translation->getLocale() == 'fr') {
            $gallery->setName($oldTranslation->getMosaiqueTitle());
        } else {
            $gallery->setName('Gallerie');
        }


        foreach ($oldArticleAssociations as $position => $oldArticleAssociation) {
            $oldMediaTrans = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldMediaI18n')
                ->findOneBy(['id' => $oldArticleAssociation->getObjectId(), 'culture' => $oldTranslation->getCulture()])
            ;
            if (!$oldMediaTrans) {
                continue;
            }

            $oldMedia = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldMedia')
                ->findOneBy(['id' => $oldArticleAssociation->getObjectId()])
            ;
            $mediaImage = null;
            $galleryMedia = null;
            if ($gallery->getMedias()->count()) {
                foreach ($gallery->getMedias() as $galleryMediaItem) {
                    if ($galleryMediaItem->getMedia()->getOldMediaId() == $oldArticleAssociation->getObjectId()) {
                        $mediaImage = $galleryMediaItem->getMedia();
                        $galleryMedia = $galleryMediaItem;
                    }
                }
            }
            if (!$mediaImage) {
                $mediaImage = new MediaImage();
                $mediaImage
                    ->addSite($this->getSiteCorporate())
                    ->setOldMediaId($oldArticleAssociation->getObjectId())
                    ->setTheme($this->defaultTheme)
                ;
                $this->getManager()->persist($mediaImage);
                $mediaImage->setPublishedAt($translation->getTranslatable()->getCreatedAt());
                $mediaImage->setCreatedAt($translation->getTranslatable()->getCreatedAt());
                $mediaImage->setUpdatedAt($translation->getTranslatable()->getCreatedAt());
            }

            $mediaImageTranslation = $mediaImage->findTranslationByLocale($translation->getLocale());

            if (!$mediaImageTranslation) {
                $mediaImageTranslation = new MediaImageTranslation();
                $mediaImageTranslation
                    ->setLocale($translation->getLocale())
                    ->setTranslatable($mediaImage)
                ;
                $this->getManager()->persist($mediaImageTranslation);
            }

            $media = $mediaImageTranslation->getFile();

            if (!$media) {
                $media = new Media();
                $file = $this->createImage('http://www.festival-cannes.fr/assets/Image/General/' . trim($oldMedia->getFilename()));
                $media->setName($oldMedia->getFilename());
                $media->setBinaryContent($file);
                $media->setEnabled(true);
                $media->setProviderReference($oldMedia->getFilename());
                $media->setContext('media_image');
                $media->setProviderStatus(1);
                $media->setProviderName('sonata.media.provider.image');
                $media->setCreatedAt($translation->getTranslatable()->getCreatedAt());
                $this->getMediaManager()->save($media, false);

                $mediaImageTranslation->setFile($media);
            }

            if ($translation->getLocale() == 'fr') {
                $mediaImageTranslation->setStatus(StatementArticleTranslation::STATUS_PUBLISHED);
            } else {
                $mediaImageTranslation->setStatus(StatementArticleTranslation::STATUS_TRANSLATED);
            }

            $mediaImageTranslation
                ->setLegend($oldMediaTrans->getLabel() ?: $imgTitle[$translation->getLocale()])
                ->setCopyright($oldMediaTrans->getCopyright())
                ->setIsPublishedOnFDCEvent(true)
            ;

            if (!$galleryMedia) {
                $galleryMedia = new GalleryMedia();
                $galleryMedia
                    ->setMedia($mediaImage)
                    ->setPosition($position)
                    ->setGallery($gallery)
                ;
                $this->getManager()->persist($galleryMedia);
            }
        }

        $this->getManager()->flush();

        return $widget;
    }

    protected function buildStatementWidgetsAudio(StatementArticle $statement, StatementArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        $audioTitle = array(
            'fr' => 'audio',
            'en' => 'audio',
            'es' => 'audio',
            'zh' => '音频',
        );
        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')
            ->findBy(['id' => $oldTranslation->getId(), 'objectClass' => 'Audio'], ['order' => 'ASC'])
        ;

        if (!$oldArticleAssociations) {
            return null;
        }

        foreach ($oldArticleAssociations as $oldArticleAssociation) {
            $oldAudioTrans = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldMediaI18n')
                ->findOneBy([
                    'id'      => $oldArticleAssociation->getObjectId(),
                    'culture' => $translation->getLocale(),
                ])
            ;

            if (!$oldAudioTrans) {
                continue;
            }

            $code = $oldAudioTrans->getCode();

            if (!$code) {
                $duplicate = $this->getManager()->getRepository('BaseCoreBundle:OldMediaI18n')->findOneBy(array(
                    'id'      => $oldArticleAssociation->getObjectId(),
                    'culture' => 'bi',
                ))
                ;
                if ($duplicate && $duplicate->getCode()) {
                    $code = $duplicate->getCode();
                    $audioPath = 'http://www.festival-cannes.fr/mp3/' . trim($code) . '.mp3';
                }
                if ($duplicate && !$duplicate->getCode() && $oldAudioTrans->getHdFormatFilename()) {
                    $code = $oldAudioTrans->getCode();
                    $audioPath = 'http://www.festival-cannes.fr/' . trim($code);
                }
                if (!$code) {
                    continue;
                }


            } else {
                $audioPath = 'http://www.festival-cannes.fr/mp3/' . trim($code) . '.mp3';
            }

            $file = $this->createAudio($audioPath);
            if (!$file) {
                continue;
            }

            $widget = null;
            $reference = 'audio' . $oldArticleAssociation->getObjectId();
            foreach ($statement->getWidgets() as $item) {
                if ($item instanceof StatementWidgetAudio && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new StatementWidgetAudio();
                $widget
                    ->setStatement($statement)
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $this->getManager()->persist($widget);
            }

            $mediaAudio = $widget->getFile();
            if (!$mediaAudio) {
                $mediaAudio = new MediaAudio();
                $widget->setFile($mediaAudio);
                $this->getManager()->persist($mediaAudio);
                $mediaAudio
                    ->setOldMediaId($oldArticleAssociation->getObjectId())
                    ->setTheme($this->defaultTheme)
                ;
            }

            $mediaAudioTranslation = $mediaAudio->findTranslationByLocale($translation->getLocale());

            if (!$mediaAudioTranslation) {
                $mediaAudioTranslation = new MediaAudioTranslation();
                $mediaAudioTranslation
                    ->setLocale($translation->getLocale())
                    ->setTranslatable($mediaAudio)
                ;
                $this->getManager()->persist($mediaAudioTranslation);
            }
            $mediaAudioTranslation
                ->setTitle($oldAudioTrans->getLabel() ?: $audioTitle[$translation->getLocale()])
                ->setJobMp3Id(MediaAudioTranslation::ENCODING_STATE_READY)
            ;

            $media = $mediaAudioTranslation->getFile();
            if (!$media) {
                $media = new Media();
                $media->setName($mediaAudioTranslation->getTitle());
                $media->setBinaryContent($file);
                $media->setEnabled(true);
                $media->setProviderReference($mediaAudioTranslation->getTitle());
                $media->setContext('media_audio');
                $media->setProviderStatus(1);
                $media->setProviderName('sonata.media.provider.audio');
                if ($media->getId() == null) {
                    $this->getMediaManager()->save($media, 'media_audio', 'sonata.media.provider.audio');
                }

                $this->getManager()->persist($media);
                $mediaAudioTranslation->setFile($media);

            }

            $this->getManager()->flush();
        }
    }

    protected function buildStatementWidgetsVideo(StatementArticle $statement, StatementArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        $videoTitle = array(
            'fr' => 'video',
            'en' => 'video',
            'es' => 'video',
            'zh' => '视频',
        );

        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')
            ->findBy(['id' => $oldTranslation->getId(), 'objectClass' => 'Video'], ['order' => 'ASC'])
        ;

        if (!$oldArticleAssociations) {
            return null;
        }

        foreach ($oldArticleAssociations as $oldArticleAssociation) {
            $oldVideoTrans = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldMediaI18n')
                ->findOneBy([
                    'id'      => $oldArticleAssociation->getObjectId(),
                    'culture' => $translation->getLocale(),
                ])
            ;

            if (!$oldVideoTrans) {
                continue;
            }

            $path = $oldVideoTrans->getDeliveryUrl();
            $pathArray = explode(',', $path);
            $path = $pathArray[0] . '80' . $pathArray[count($pathArray) - 1];
            $file = $this->createVideo('http://canneshd-a.akamaihd.net/' . trim($path));
            if ($file == null) {
                continue;
            }

            $widget = null;
            $reference = 'video' . $oldArticleAssociation->getObjectId();
            foreach ($statement->getWidgets() as $item) {
                if ($item instanceof StatementWidgetVideo && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new StatementWidgetVideo();
                $widget
                    ->setStatement($statement)
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $this->getManager()->persist($widget);
            }

            $mediaVideo = $widget->getFile();
            if (!$mediaVideo) {
                $mediaVideo = new MediaVideo();
                $mediaVideo->setDisplayedHomeCorpo(false);
                $widget->setFile($mediaVideo);
                $this->getManager()->persist($mediaVideo);
                $mediaVideo
                    ->setOldMediaId($oldArticleAssociation->getObjectId())
                    ->setTheme($this->defaultTheme)
                ;
            }

            $mediaVideoTranslation = $mediaVideo->findTranslationByLocale($translation->getLocale());

            if (!$mediaVideoTranslation) {
                $mediaVideoTranslation = new MediaVideoTranslation();
                $mediaVideoTranslation
                    ->setLocale($translation->getLocale())
                    ->setTranslatable($mediaVideo)
                ;
                $this->getManager()->persist($mediaVideoTranslation);
            }
            $mediaVideoTranslation
                ->setTitle($oldVideoTrans->getLabel() ?: $videoTitle[$translation->getLocale()])
                ->setJobMp4State(MediaVideoTranslation::ENCODING_STATE_READY)
                ->setJobWebmState(MediaVideoTranslation::ENCODING_STATE_READY)
            ;

            $media = $mediaVideoTranslation->getFile();
            if (!$media) {
                $media = new Media();
                $media->setName($oldVideoTrans->getLabel());
                $media->setBinaryContent($file);
                $media->setEnabled(true);
                $media->setProviderReference($oldVideoTrans->getLabel());
                $media->setContext('media_video');
                $media->setProviderStatus(1);
                $media->setProviderName('sonata.media.provider.video');
                if ($media->getId() == null) {
                    $this->getMediaManager()->save($media);
                }
                $mediaVideoTranslation->setFile($media);

                $this->getManager()->persist($media);
                $mediaVideoTranslation->setFile($media);

            }

            $this->getManager()->flush();
        }
    }

    protected function buildAssociatedFilms(StatementArticle $statement, OldArticle $oldArticle)
    {
        // association film
        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')
            ->findBy(['id' => $oldArticle->getId(), 'objectClass' => 'Film'], ['order' => 'asc'])
        ;

        foreach ($oldArticleAssociations as $oldArticleAssociation) {
            $film = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->find($oldArticleAssociation->getObjectId())
            ;
            if ($film) {
                if (!$statement->getAssociatedFilm()) {
                    $statement->setAssociatedFilm($film);
                }

                $found = false;
                foreach ($statement->getAssociatedFilms() as $associatedFilm) {
                    if ($associatedFilm->getAssociation()->getId() == $film->getId()) {
                        $found = true;
                    }
                }
                if (!$found) {
                    $associatedFilm = new StatementFilmFilmAssociated();
                    $associatedFilm
                        ->setStatement($statement)
                        ->setAssociation($film)
                    ;
                    $this->getManager()->persist($film);
                }
            }
            $this->getManager()->flush();
        }
    }

    protected function buildAssociatedStatements(StatementArticle $statement, OldArticle $oldArticle)
    {
        // association film
        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')
            ->findBy(['id' => $oldArticle->getId(), 'objectClass' => 'Article'], ['order' => 'asc'])
        ;

        foreach ($oldArticleAssociations as $oldArticleAssociation) {
            $item = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:StatementArticle')
                ->findOneBy(['oldNewsId' => $oldArticleAssociation->getObjectId()])
            ;
            if ($item) {
                $found = false;
                foreach ($statement->getAssociatedStatement() as $associatedStatement) {
                    if ($associatedStatement->getAssociation()->getId() == $item->getId()) {
                        $found = true;
                    }
                }
                if (!$found) {
                    $associatedStatement = new StatementStatementAssociated();
                    $associatedStatement
                        ->setStatement($statement)
                        ->setAssociation($item)
                    ;
                    $this->getManager()->persist($associatedStatement);
                }
            }
            $this->getManager()->flush();
        }
    }


    protected function getWidgetPosition()
    {
        return $this->widgetPosition++;
    }

    protected function isStatementMatching(OldArticle $oldArticle)
    {

        // Communiqués-Festival de 2001 > 2015
        $isAvailable = $oldArticle->getIsOnline() && $oldArticle->getCreatedAt();
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2001;
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2015;
        if ($isAvailable) {
            return true;
        }
    }
}