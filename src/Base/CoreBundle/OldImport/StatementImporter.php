<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
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
            $this->getDefaultTheme(true);
        }
        $progress->finish();


        return $this;
    }

    public function countStatements()
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
                if ($this->input->getOption('update-films-only')) {
                    $this->buildAssociatedFilms($statement, $oldArticle);
                } else {
                    $this->buildStatementWidgetText($statement, $translation, $oldTranslation);
                    $this->buildStatementWidgetYoutube($statement, $translation, $oldTranslation);
                    $this->buildStatementWidgetImage($statement, $translation, $oldTranslation);
                    $this->buildStatementWidgetsAudio($statement, $translation, $oldTranslation);
                    $this->buildStatementWidgetsVideo($statement, $translation, $oldTranslation);
                    $this->buildAssociatedFilms($statement, $oldArticle);
                    $this->buildAssociatedStatements($statement, $oldArticle);
                }
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

        if (!$statement->getSites()->contains($this->getSiteCorporate())) {
            $statement->addSite($this->getSiteCorporate());
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
        $mapperFields = [
            'resume' => 'introduction',
        ];

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


            if ($oldTranslation->getImageResume()) {
                $file = $this->createImage('http://www.festival-cannes.fr/assets/Image/Pages/' . trim($oldTranslation->getImageResume()));
                if ($file) {
                    $header = $statement->getHeader();
                    if (!$header) {
                        $header = new MediaImage();
                        $this->getManager()->persist($header);
                        $statement->setHeader($header);
                    }

                    $header
                        ->setTheme($this->getDefaultTheme())
                        ->setFestival($statement->getFestival())
                        ->setCreatedAt($statement->getCreatedAt())
                        ->setUpdatedAt($statement->getUpdatedAt())
                        ->setDisplayedAll(true)
                        ->setPublishedAt($statement->getPublishedAt())
                        ->setPublishEndedAt($statement->getPublishEndedAt())
                    ;

                    if (!$header->getSites()->contains($this->getSiteCorporate())) {
                        $header->addSite($this->getSiteCorporate());
                    }

                    $headerTrans = $header->findTranslationByLocale($locale);
                    if (!$headerTrans) {
                        $headerTrans = new MediaImageTranslation();
                        $headerTrans
                            ->setTranslatable($header)
                            ->setLocale($locale)
                        ;
                        $this->getManager()->persist($headerTrans);
                    }

                    $media = $headerTrans->getFile();
                    if (!$media) {
                        $media = new Media();
                        $media->setName($translation->getTitle());
                        $media->setBinaryContent($file);
                        $media->setEnabled(true);
                        $media->setProviderReference($oldTranslation->getImageResume());
                        $media->setContext('media_image');
                        $media->setProviderStatus(1);
                        $media->setProviderName('sonata.media.provider.image');
                        $media->setCreatedAt($statement->getCreatedAt());
                        $this->getMediaManager()->save($media, false);

                        $headerTrans->setFile($media);
                    }
                }
            }

            $translation->setTitle(html_entity_decode(strip_tags($oldTranslation->getTitle())));

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
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
            $statement->addWidget($widget);
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
                ->setOldImportReference('youtube')
                ->setPosition($this->getWidgetPosition())
            ;
            $statement->addWidget($widget);
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
                ->setOldImportReference('image')
                ->setPosition($this->getWidgetPosition())
            ;
            $statement->addWidget($widget);
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

        if ($translation->getLocale() == 'fr' && $oldTranslation->getMosaiqueTitle()) {
            $gallery->setName($oldTranslation->getMosaiqueTitle());
        } else {
            $gallery->setName('Gallerie');
        }


        foreach ($oldArticleAssociations as $position => $oldArticleAssociation) {
            $objectId = $oldArticleAssociation->getObjectId();
            $mediaImage = $this->createMediaImageFromOldMedia($objectId, $translation->getLocale());

            if (!$mediaImage) {
                $mediaImage = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:MediaImage')
                    ->findOneBy(['oldMediaId' => $oldArticleAssociation->getObjectId()])
                ;

                if ($mediaImage) {
                    foreach ($mediaImage->getGalleries() as $galleryMedia) {
                        if ($galleryMedia instanceof GalleryMedia) {
                            $galleryMedia->setMedia(null);
                            $gallery = $galleryMedia->getGallery();
                            $gallery->removeMedia($galleryMedia);
                            if (!$gallery->getMedias()->count()) {
                                $widget = $this
                                    ->getManager()
                                    ->getRepository('BaseCoreBundle:StatementWidgetImage')
                                    ->findOneBy(['gallery' => $gallery->getId()])
                                ;
                                if ($widget) {
                                    $widget->setGallery(null);
                                    $this->getManager()->remove($mediaImage);
                                }
                                $this->getManager()->remove($gallery);
                            }
                        }
                    }

                    $this->getManager()->remove($mediaImage);
                    $this->getManager()->flush();
                }
                continue;
            }

            $galleryMedia = null;
            if ($gallery->getMedias()->count()) {
                foreach ($gallery->getMedias() as $galleryMediaItem) {
                    if ($galleryMediaItem->getMedia()->getOldMediaId() == $oldArticleAssociation->getObjectId()) {
                        $galleryMedia = $galleryMediaItem;
                    }
                }
            }

            if (!$galleryMedia) {
                $galleryMedia = new GalleryMedia();
                $galleryMedia
                    ->setPosition($position)
                    ->setGallery($gallery)
                ;
                $this->getManager()->persist($galleryMedia);
            }

            $galleryMedia->setMedia($mediaImage);
        }

        $this->getManager()->flush();

        return $widget;
    }

    protected function buildStatementWidgetsAudio(StatementArticle $statement, StatementArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')
            ->findBy(['id' => $oldTranslation->getId(), 'objectClass' => 'Audio'], ['order' => 'ASC'])
        ;

        if (!$oldArticleAssociations) {
            return null;
        }

        foreach ($oldArticleAssociations as $oldArticleAssociation) {
            $objectId = $oldArticleAssociation->getObjectId();
            $mediaAudio = $this->createMediaAudioFromOldMedia($objectId, $translation->getLocale());

            if (!$mediaAudio) {
                $mediaAudio = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:MediaAudio')
                    ->findOneBy(['oldMediaId' => $objectId])
                ;

                if ($mediaAudio) {
                    $widgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:StatementWidgetAudio')
                        ->findBy(['file' => $mediaAudio->getId()])
                    ;

                    if ($widgets) {
                        foreach ($widgets as $widgetToRemove) {
                            $widgetToRemove->setFile(null);
                            $this->getManager()->remove($widgetToRemove);
                        }
                    }

                    $this->getManager()->remove($mediaAudio);
                    $this->getManager()->flush();
                }
                continue;
            }

            $widget = null;
            $reference = 'audio' . $objectId;
            foreach ($statement->getWidgets() as $item) {
                if ($item instanceof StatementWidgetAudio && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            $widget->setFile($mediaAudio);
            $this->getManager()->flush();
        }
    }

    protected function buildStatementWidgetsVideo(StatementArticle $statement, StatementArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')
            ->findBy(['id' => $oldTranslation->getId(), 'objectClass' => 'Video'], ['order' => 'ASC'])
        ;

        if (!$oldArticleAssociations) {
            return null;
        }

        foreach ($oldArticleAssociations as $oldArticleAssociation) {
            $objectId = $oldArticleAssociation->getObjectId();
            $mediaVideo = $this->createMediaVideoFromOldMedia($objectId, $translation->getLocale());

            if (!$mediaVideo) {
                $mediaVideo = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:MediaVideo')
                    ->findOneBy(['oldMediaId' => $oldArticleAssociation->getObjectId()])
                ;

                if ($mediaVideo) {
                    $widgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:StatementWidgetVideo')
                        ->findBy(['file' => $mediaVideo->getId()])
                    ;

                    if ($widgets) {
                        foreach ($widgets as $widgetToRemove) {
                            $widgetToRemove->setFile(null);
                            $this->getManager()->remove($widgetToRemove);
                        }
                    }

                    $this->getManager()->remove($mediaVideo);
                    $this->getManager()->flush();
                }
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
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $statement->addWidget($widget);
                $this->getManager()->persist($widget);
            }

            $widget->setFile($mediaVideo);
            $this->getManager()->flush();
        }
    }

    protected function buildAssociatedFilms(StatementArticle $statement, OldArticle $oldArticle)
    {
        if (!$this->associateMovie) {
            foreach ($statement->getAssociatedFilms() as $associatedFilm) {
                $statement->removeAssociatedFilm($associatedFilm);
                $this->getManager()->remove($associatedFilm);
            }
            $this->getManager()->flush();
            return;
        }

        // association film
        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')
            ->findBy(['id' => $oldArticle->getId(), 'objectClass' => 'Film'], ['order' => 'asc'])
        ;

        $films = [];
        foreach ($oldArticleAssociations as $oldArticleAssociation) {
            $film = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->find($oldArticleAssociation->getObjectId())
            ;
            if ($film) {
                $films[] = $film;
            }
        }
        if (count($films) === 1) {
            $statement->setAssociatedFilm(reset($films));
            foreach ($statement->getAssociatedFilms() as $associatedFilm) {
                $statement->removeAssociatedFilm($associatedFilm);
                $this->getManager()->remove($associatedFilm);
            }
        } else {
            $statement->setAssociatedFilm(null);
            foreach ($films as $film) {
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
                    $this->getManager()->persist($associatedFilm);
                }

            }
        }
        $this->getManager()->flush();

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
                    if ($associatedStatement->getAssociation() && $associatedStatement->getAssociation()->getId() == $item->getId()) {
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