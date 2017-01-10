<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsTranslation;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetAudio;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetImage;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetText;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetTextTranslation;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetVideo;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetVideoYoutube;
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
use Base\CoreBundle\Entity\StatementWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class ClassicsImporter extends Importer
{
    protected $widgetPosition = 0;

    public function importClassics()
    {
        $this->output->writeln('<info>Import classics...</info>');

        $count = $this->countClassics();

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
                $classics = $this->importItem($oldArticle);
                if ($classics) {
                    foreach ($this->langs as $lang) {
                        $translation = $classics->findTranslationByLocale($lang);
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

    public function countClassics()
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

        $matching = $this->isClassicMatching($oldArticle);
        if (!$matching) {
            return null;
        }

        $classics = $this->buildClassics($oldArticle);

        foreach ($oldTranslations as $oldTranslation) {
            $translation = $this->buildClassicsArticleTranslation($classics, $oldTranslation);
            if ($translation) {
                $this->buildClassicsWidgetText($classics, $translation, $oldTranslation);
                $this->buildClassicsWidgetYoutube($classics, $translation, $oldTranslation);
                $this->buildClassicsWidgetImage($classics, $translation, $oldTranslation);
                $this->buildClassicsWidgetsAudio($classics, $translation, $oldTranslation);
                $this->buildClassicsWidgetsVideo($classics, $translation, $oldTranslation);
            }
        }

        return $classics;
    }

    /**
     * @param OldArticle $oldArticle
     * @return StatementArticle
     */
    protected function buildClassics(OldArticle $oldArticle)
    {
        $classics = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
            ->findOneBy(['oldNewsId' => $oldArticle->getId()])
        ;

        if (!$classics) {
            $classics = new FDCPageLaSelectionCannesClassics();
            $classics
                ->setOldNewsId($oldArticle->getId())
                ->setOldNewsTable('OldNews')
                ->setWeight(0)
            ;
            $this->getManager()->persist($classics);
        }
        if (!$classics->getSites()->contains($this->getSiteCorporate())) {
            $classics->addSite($this->getSiteCorporate());
        }
        $classics
            ->setFestival($this->getFestival($oldArticle))
            ->setPublishedAt($oldArticle->getStartDate() ?: $oldArticle->getUpdatedAt())
            ->setCreatedAt($oldArticle->getCreatedAt())
            ->setUpdatedAt($oldArticle->getUpdatedAt())
        ;

        $this->getManager()->flush();

        return $classics;
    }

    /**
     * @param FDCPageLaSelectionCannesClassics $classics
     * @param OldArticleI18n $oldTranslation
     * @return StatementArticleTranslation
     */
    protected function buildClassicsArticleTranslation(FDCPageLaSelectionCannesClassics $classics, OldArticleI18n $oldTranslation)
    {
        $mapperFields = array(//'resume' => 'introduction',
        );

        $locale = $oldTranslation->getCulture() == 'cn' ? 'zh' : $oldTranslation->getCulture();
        if (in_array($locale, $this->langs)) {
            $translation = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassicsTranslation')
                ->findOneBy(['locale' => $locale, 'translatable' => $classics])
            ;

            if (!$translation) {
                $translation = new FDCPageLaSelectionCannesClassicsTranslation();
                $translation
                    ->setCreatedAt($classics->getCreatedAt())
                    ->setUpdatedAt($classics->getCreatedAt())
                    ->setTranslatable($classics)
                    ->setLocale($locale)
                    ->setIsPublishedOnFDCEvent(true)
                ;
                $this->getManager()->persist($translation);
            }


            if ($locale == 'fr') {
                $translation->setStatus(StatementArticleTranslation::STATUS_DEACTIVATED);
            } else {
                $translation->setStatus(StatementArticleTranslation::STATUS_TRANSLATED);
            }

            if ($oldTranslation->getImageResume()) {
                $file = $this->createImage('http://www.festival-cannes.fr/assets/Image/Pages/' . trim($oldTranslation->getImageResume()));
                if ($file) {
                    $header = $classics->getImage();
                    if (!$header) {
                        $header = new MediaImage();
                        $this->getManager()->persist($header);

                        $classics->setImage($header);
                    }

                    $header
                        ->setTheme($this->getDefaultTheme())
                        ->setFestival($classics->getFestival())
                        ->setDisplayedAll(true)
                        ->setPublishedAt($classics->getPublishedAt())
                        ->setPublishEndedAt($classics->getPublishEndedAt())
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
                        $media->setCreatedAt($classics->getCreatedAt());
                        $this->getMediaManager()->save($media, false);

                        $headerTrans->setFile($media);
                    }
                }
            }

            $translation->setTitle(html_entity_decode(strip_tags($oldTranslation->getTitle())));
            $translation->setTitleNav(html_entity_decode(strip_tags($oldTranslation->getTitle())));

            //foreach ($mapperFields as $oldField => $field) {
            //    $translation->{'set' . ucfirst($field)}($oldTranslation->{'get' . ucfirst($oldField)}());
            //}
            $this->getManager()->flush();
            return $translation;
        }
    }

    protected function buildClassicsWidgetText(FDCPageLaSelectionCannesClassics $classics, FDCPageLaSelectionCannesClassicsTranslation $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getBody()) {
            return null;
        }
        $widget = null;
        foreach ($classics->getWidgets() as $item) {
            if ($item instanceof FDCPageLaSelectionCannesClassicsWidgetText && $item->getOldImportReference() == 'body') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new FDCPageLaSelectionCannesClassicsWidgetText();
            $widget
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
            $classics->addWidget($widget);
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new FDCPageLaSelectionCannesClassicsWidgetTextTranslation();
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

    protected function buildClassicsWidgetYoutube(FDCPageLaSelectionCannesClassics $classics, FDCPageLaSelectionCannesClassicsTranslation $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getYoutubeLink() || !$oldTranslation->getYoutubeLinkDescription()) {
            return null;
        }

        $widget = null;
        foreach ($classics->getWidgets() as $item) {
            if ($item instanceof FDCPageLaSelectionCannesClassicsWidgetVideoYoutube && $item->getOldImportReference() == 'youtube') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new FDCPageLaSelectionCannesClassicsWidgetVideoYoutube();
            $widget
                ->setOldImportReference('youtube')
                ->setPosition($this->getWidgetPosition())
            ;
            $classics->addWidget($widget);
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

    protected function buildClassicsWidgetImage(FDCPageLaSelectionCannesClassics $classics, FDCPageLaSelectionCannesClassicsTranslation $translation, OldArticleI18n $oldTranslation)
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
        foreach ($classics->getWidgets() as $item) {
            if ($item instanceof FDCPageLaSelectionCannesClassicsWidgetImage && $item->getOldImportReference() == 'image') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new FDCPageLaSelectionCannesClassicsWidgetImage();
            $widget
                ->setOldImportReference('image')
                ->setPosition($this->getWidgetPosition())
            ;
            $classics->addWidget($widget);
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
                                    ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassicsWidgetImage')
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

    protected function buildClassicsWidgetsAudio(FDCPageLaSelectionCannesClassics $classics, FDCPageLaSelectionCannesClassicsTranslation $translation, OldArticleI18n $oldTranslation)
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
                    ->findOneBy(['oldMediaId' => $oldArticleAssociation->getObjectId()])
                ;

                if ($mediaAudio) {
                    $widgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassicsWidgetAudio')
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
            $reference = 'audio' . $oldArticleAssociation->getObjectId();
            foreach ($classics->getWidgets() as $item) {
                if ($item instanceof FDCPageLaSelectionCannesClassicsWidgetAudio && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new FDCPageLaSelectionCannesClassicsWidgetAudio();
                $widget
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $classics->addWidget($widget);
                $this->getManager()->persist($widget);
            }

            $widget->setFile($mediaAudio);
            $this->getManager()->flush();
        }
    }

    protected function buildClassicsWidgetsVideo(FDCPageLaSelectionCannesClassics $classics, FDCPageLaSelectionCannesClassicsTranslation $translation, OldArticleI18n $oldTranslation)
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
                        ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassicsWidgetVideo')
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
            foreach ($classics->getWidgets() as $item) {
                if ($item instanceof FDCPageLaSelectionCannesClassicsWidgetVideo && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new FDCPageLaSelectionCannesClassicsWidgetVideo();
                $widget
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $classics->addWidget($widget);
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

    protected function isClassicMatching(OldArticle $oldArticle)
    {
        // copies restaurees
        $ids = [61333, 60588, 59714, 59046, 58130, 57154, 61336, 60589, 59713, 59047, 58129, 57157, 61332, 58131, 59715, 59048, 58186, 57156, 61331];
        //  Titre et id 61336, 60589, 59713, 59047, 58129, 57157
        //Titre et id 61332, 58131
        //Titre et id 59715, 59048, 58186, 57156
        //Titre et id 61331
        return in_array($oldArticle->getId(), $ids);
    }
}