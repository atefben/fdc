<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\Event;
use Base\CoreBundle\Entity\EventEventAssociated;
use Base\CoreBundle\Entity\EventFilmFilmAssociated;
use Base\CoreBundle\Entity\EventTranslation;
use Base\CoreBundle\Entity\EventWidgetAudio;
use Base\CoreBundle\Entity\EventWidgetImage;
use Base\CoreBundle\Entity\EventWidgetText;
use Base\CoreBundle\Entity\EventWidgetTextTranslation;
use Base\CoreBundle\Entity\EventWidgetVideo;
use Base\CoreBundle\Entity\EventWidgetVideoYoutube;
use Base\CoreBundle\Entity\EventWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class EventImporter extends Importer
{
    protected $widgetPosition = 0;

    protected $status;

    public function importOneEvent($id)
    {
        $this->getSiteEvent(true);
        $this->getSiteCorporate(true);
        $this->getDefaultTheme(true);

        $oldArticle = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->createQueryBuilder('o')
            ->andWhere('o.articleTypeId in (:types)')
            ->setParameter(':types', [static::TYPE_WEB_PAGE])
            ->andWhere('o.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $news = $this->importItem($oldArticle);
        if ($news) {
            foreach ($this->langs as $lang) {
                $news->findTranslationByLocale($lang);
            }
        }
    }

    public function importEvents()
    {
        $this->output->writeln('<event>Import events...</event>');
        $this->getDefaultTheme(true);

        $count = $this->countEvents();

        $pages = ceil($count / 50);

        $progress = new ProgressBar($this->output, $count);
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();

        for ($page = 1; $page <= $pages; $page++) {
            $oldArticles = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldArticle')
                ->findBy(['articleTypeId' => static::TYPE_WEB_PAGE], ['id' => 'asc'], 50, ($page - 1) * 50)
            ;

            foreach ($oldArticles as $oldArticle) {
                $progress->advance();
                $event = $this->importItem($oldArticle);
                if ($event) {
                    foreach ($this->langs as $lang) {
                        $translation = $event->findTranslationByLocale($lang);
                    }
                }
            }

            //$this->getManager()->clear();
            unset($oldArticles);

            //$this->getSiteEvent(true);
            //$this->getSiteCorporate(true);
            //$this->getDefaultTheme(true);
        }
        $progress->finish();


        return $this;
    }

    public function countEvents()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->createQueryBuilder('o')
            ->select('count(o)')
            ->andWhere('o.articleTypeId = :type')
            ->setParameter(':type', static::TYPE_WEB_PAGE)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param OldArticle $oldArticle
     * @return Event
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

        $matching = $this->isEventMatching($oldArticle, $oldTranslations);
        if (!$matching) {
            return null;
        }
        static $countEvents = 0;
        ++$countEvents;
        echo PHP_EOL;
        $event = $this->buildEvent($oldArticle);

        foreach ($oldTranslations as $oldTranslation) {
            $translation = $this->buildEventTranslation($event, $oldTranslation);
            if ($translation) {
                $this->buildEventWidgetText($event, $translation, $oldTranslation);
                $this->buildEventWidgetYoutube($event, $translation, $oldTranslation);
                $this->buildEventWidgetImage($event, $translation, $oldTranslation);
                $this->buildEventWidgetsAudio($event, $translation, $oldTranslation);
                $this->buildEventWidgetsVideo($event, $translation, $oldTranslation);
            }
        }

        return $event;
    }

    /**
     * @param OldArticle $oldArticle
     * @return Event
     */
    protected function buildEvent(OldArticle $oldArticle)
    {
        $event = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:Event')
            ->findOneBy(['oldNewsId' => $oldArticle->getId()])
        ;

        if (!$event) {
            $event = new Event();
            $event
                ->setOldNewsId($oldArticle->getId())
                ->setOldNewsTable('OldNews')
                ->setPublishedAt($oldArticle->getStartDate() ?: $oldArticle->getUpdatedAt())
                ->setCreatedAt($oldArticle->getCreatedAt())
                ->setUpdatedAt($oldArticle->getUpdatedAt())
                ->setFestival($this->getFestival($oldArticle))
                ->setTheme($this->defaultTheme)
            ;
            $this->getManager()->persist($event);
        }

        if (!$event->getSites()->contains($this->getSiteCorporate())) {
            $event->addSite($this->getSiteCorporate());
        }

        $this->getManager()->flush();
        return $event;
    }


    /**
     * @param Event $event
     * @param OldArticleI18n $oldTranslation
     * @return EventTranslation
     */
    protected function buildEventTranslation(Event $event, OldArticleI18n $oldTranslation)
    {
        $mapperFields = [
            'resume' => 'introduction',
        ];

        $locale = $oldTranslation->getCulture() == 'cn' ? 'zh' : $oldTranslation->getCulture();
        if (in_array($locale, $this->langs)) {
            $translation = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:EventTranslation')
                ->findOneBy(['locale' => $locale, 'translatable' => $event])
            ;

            if (!$translation) {
                $translation = new EventTranslation();
                $translation
                    ->setCreatedAt($event->getCreatedAt())
                    ->setUpdatedAt($event->getCreatedAt())
                    ->setTranslatable($event)
                    ->setLocale($locale)
                    ->setIsPublishedOnFDCEvent(false)
                ;
                $this->getManager()->persist($translation);

                if ($locale == 'fr') {
                    if ($this->status) {
                        $translation->setStatus($this->status);
                    } else {
                        $translation->setStatus(EventTranslation::STATUS_PUBLISHED);
                    }
                } else {
                    $translation->setStatus(EventTranslation::STATUS_TRANSLATED);
                }
            }

            if ($oldTranslation->getImageResume()) {
                $file = $this->createImage('http://www.festival-cannes.fr/assets/Image/Pages/' . trim($oldTranslation->getImageResume()));
                if ($file) {
                    $header = $event->getHeader();
                    if (!$header) {
                        $header = new MediaImage();
                        $this->getManager()->persist($header);
                        $event->setHeader($header);
                    }

                    $header
                        ->setTheme($this->getDefaultTheme())
                        ->setFestival($event->getFestival())
                        ->setCreatedAt($event->getCreatedAt())
                        ->setUpdatedAt($event->getUpdatedAt())
                        ->setDisplayedAll(true)
                        ->setPublishedAt($event->getPublishedAt())
                        ->setPublishEndedAt($event->getPublishEndedAt())
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
                        $media->setCreatedAt($event->getCreatedAt());
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

    protected function buildEventWidgetText(Event $event, EventTranslation $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getBody()) {
            return null;
        }
        $widget = null;
        foreach ($event->getWidgets() as $item) {
            if ($item instanceof EventWidgetText && $item->getOldImportReference() == 'body') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new EventWidgetText();
            $widget
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
            $event->addWidget($widget);
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new EventWidgetTextTranslation();
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

    /**
     * @param Event $event
     * @param EventTranslation $translation
     * @param OldArticleI18n $oldTranslation
     * @return EventWidgetVideoYoutube|mixed|null
     */
    protected function buildEventWidgetYoutube(Event $event, EventTranslation $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getYoutubeLink() || !$oldTranslation->getYoutubeLinkDescription()) {
            return null;
        }

        $widget = null;
        foreach ($event->getWidgets() as $item) {
            if ($item instanceof EventWidgetVideoYoutube && $item->getOldImportReference() == 'youtube') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new EventWidgetVideoYoutube();
            $widget
                ->setOldImportReference('youtube')
                ->setPosition($this->getWidgetPosition())
            ;
            $event->addWidget($widget);
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new EventWidgetVideoYoutubeTranslation();
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

    protected function buildEventWidgetImage(Event $event, EventTranslation $translation, OldArticleI18n $oldTranslation)
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
        foreach ($event->getWidgets() as $item) {
            if ($item instanceof EventWidgetImage && $item->getOldImportReference() == 'image') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new EventWidgetImage();
            $widget
                ->setOldImportReference('image')
                ->setPosition($this->getWidgetPosition())
            ;
            $event->addWidget($widget);
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
                                    ->getRepository('BaseCoreBundle:EventWidgetImage')
                                    ->findOneBy(['gallery' => $gallery->getId()])
                                ;
                                if ($widget) {
                                    $widget->setGallery(null);
                                    $this->getManager()->remove($widget);
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

    protected function buildEventWidgetsAudio(Event $event, EventTranslation $translation, OldArticleI18n $oldTranslation)
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
                        ->getRepository('BaseCoreBundle:EventWidgetAudio')
                        ->findBy(['file' => $mediaAudio->getId()])
                    ;

                    if ($widgets) {
                        foreach ($widgets as $widgetToRemove) {
                            $widgetToRemove->setFile(null);
                            $this->getManager()->remove($widgetToRemove);
                        }
                    }
                    $newsWidgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:NewsWidgetAudio')
                        ->findBy(['file' => $mediaAudio->getId()])
                    ;
                    $infosWidgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:InfoWidgetAudio')
                        ->findBy(['file' => $mediaAudio->getId()])
                    ;
                    $statementsWidgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:StatementWidgetAudio')
                        ->findBy(['file' => $mediaAudio->getId()])
                    ;
                    $classicsWidgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassicsWidgetAudio')
                        ->findBy(['file' => $mediaAudio->getId()])
                    ;

                    if (!$newsWidgets && !$infosWidgets && !$statementsWidgets && !$classicsWidgets) {
                        $this->getManager()->remove($mediaAudio);
                    }

                    $this->getManager()->flush();
                }
                continue;
            }

            $widget = null;
            $reference = 'audio' . $objectId;
            foreach ($event->getWidgets() as $item) {
                if ($item instanceof EventWidgetAudio && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new EventWidgetAudio();
                $widget
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $event->addWidget($widget);
                $this->getManager()->persist($widget);
            }

            $widget->setFile($mediaAudio);
            $this->getManager()->flush();
        }
    }

    protected function buildEventWidgetsVideo(Event $event, EventTranslation $translation, OldArticleI18n $oldTranslation)
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
                        ->getRepository('BaseCoreBundle:EventWidgetVideo')
                        ->findBy(['file' => $mediaVideo->getId()])
                    ;

                    if ($widgets) {
                        foreach ($widgets as $widgetToRemove) {
                            $widgetToRemove->setFile(null);
                            $this->getManager()->remove($widgetToRemove);
                        }
                    }

                    $newsWidgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:NewsWidgetVideo')
                        ->findBy(['file' => $mediaVideo->getId()])
                    ;
                    $infosWidgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:InfoWidgetVideo')
                        ->findBy(['file' => $mediaVideo->getId()])
                    ;
                    $statementsWidgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:StatementWidgetVideo')
                        ->findBy(['file' => $mediaVideo->getId()])
                    ;
                    $classicsWidgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassicsWidgetVideo')
                        ->findBy(['file' => $mediaVideo->getId()])
                    ;

                    if (!$newsWidgets && !$infosWidgets && !$statementsWidgets && !$classicsWidgets) {
                        $this->getManager()->remove($mediaVideo);
                    }
                    $this->getManager()->flush();
                }
                continue;
            }

            $widget = null;
            $reference = 'video' . $oldArticleAssociation->getObjectId();
            foreach ($event->getWidgets() as $item) {
                if ($item instanceof EventWidgetVideo && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new EventWidgetVideo();
                $widget
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $event->addWidget($widget);
                $this->getManager()->persist($widget);
            }

            $widget->setFile($mediaVideo);
            $this->getManager()->flush();
        }
    }

    protected function getWidgetPosition()
    {
        return $this->widgetPosition++;
    }

    protected function isEventMatching(OldArticle $oldArticle, $oldArticleTranslations)
    {
        static $countEvents = 0;
        $isAvailable = $oldArticle->getCreatedAt();
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2010;

        if ($isAvailable) {

            // published
            if (in_array($oldArticle->getId(), [57610, 58049, 59042, 59675, 60062, 61390, 58232, 59120, 58048, 58286])) {

                foreach ($oldArticleTranslations as $trans) {
                    if ($trans->getCulture() == 'fr' && $oldArticle->getIsOnline()) {
                        $this->status = TranslateChildInterface::STATUS_PUBLISHED;
                        ++$countEvents;
                        return true;
                    }
                }
            }

            $words = ['lecon', 'palme', 'europe'];

            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                foreach ($words as $word) {
                    if ($trans->getCulture() == 'fr' && (stripos($title, $word) !== false) && $oldArticle->getIsOnline()) {
                        $this->status = TranslateChildInterface::STATUS_PUBLISHED;
                        ++$countEvents;
                        return true;
                    }
                }
            }

            $words = ['camera d\'or', 'cinema de la plage', 'village'];
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                foreach ($words as $word) {
                    if ($trans->getCulture() == 'fr' && (stripos($title, $word) !== false)) {
                        $this->status = TranslateChildInterface::STATUS_DEACTIVATED;
                        ++$countEvents;
                        return true;
                    }
                }
            }
        }
    }
}