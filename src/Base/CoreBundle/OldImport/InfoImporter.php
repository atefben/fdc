<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Component\Interfaces\NodeTranslationInterface;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoArticleTranslation;
use Base\CoreBundle\Entity\InfoFilmFilmAssociated;
use Base\CoreBundle\Entity\InfoImage;
use Base\CoreBundle\Entity\InfoImageTranslation;
use Base\CoreBundle\Entity\InfoInfoAssociated;
use Base\CoreBundle\Entity\InfoWidgetAudio;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\InfoWidgetText;
use Base\CoreBundle\Entity\InfoWidgetTextTranslation;
use Base\CoreBundle\Entity\InfoWidgetVideo;
use Base\CoreBundle\Entity\InfoWidgetVideoYoutube;
use Base\CoreBundle\Entity\InfoWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class InfoImporter extends Importer
{
    protected $widgetPosition = 0;

    protected $status;
    protected $isInfoImage = false;

    public function importInfos()
    {
        $this->output->writeln('<info>Import infos...</info>');

        $count = $this->countInfos();

        $pages = ceil($count / 50);

        $progress = new ProgressBar($this->output, $count);
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();

        for ($page = 1; $page <= $pages; $page++) {
            $oldArticles = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldArticle')
                ->findBy(['articleTypeId' => static::TYPE_NEWS_FESTIVAL], ['id' => 'asc'], 50, ($page - 1) * 50)
            ;

            foreach ($oldArticles as $oldArticle) {
                $progress->advance();
                $info = $this->importItem($oldArticle);
                if ($info) {
                    foreach ($this->langs as $lang) {
                        $translation = $info->findTranslationByLocale($lang);
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

    public function countInfos()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->createQueryBuilder('o')
            ->select('count(o)')
            ->andWhere('o.articleTypeId = :type')
            ->setParameter(':type', static::TYPE_NEWS_FESTIVAL)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param OldArticle $oldArticle
     * @return Info
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

        $matching = $this->isInfoMatching($oldArticle, $oldTranslations);
        if (!$matching) {
            return null;
        }
        $info = $this->buildInfoArticle($oldArticle);

        foreach ($oldTranslations as $oldTranslation) {
            $translation = $this->buildInfoArticleTranslation($info, $oldTranslation);
            if ($translation) {
                if ($this->input->getOption('update-films-only')) {
                    $this->buildAssociatedFilms($info, $oldArticle);
                } else {
                    $this->buildInfoWidgetText($info, $translation, $oldTranslation);
                    $this->buildInfoWidgetYoutube($info, $translation, $oldTranslation);
                    $this->buildInfoWidgetImage($info, $translation, $oldTranslation);
                    $this->buildInfoWidgetsAudio($info, $translation, $oldTranslation);
                    $this->buildInfoWidgetsVideo($info, $translation, $oldTranslation);
                    $this->buildAssociatedFilms($info, $oldArticle);
                    $this->buildAssociatedInfos($info, $oldArticle);
                }
            }
        }

        return $info;
    }

    /**
     * @param OldArticle $oldArticle
     * @return Info
     */
    protected function buildInfoArticle(OldArticle $oldArticle)
    {
        if ($this->isInfoImage) {
            $classInfo = InfoImage::class;
            $this->removeInfo($oldArticle->getId());
        } else {
            $classInfo = InfoArticle::class;
        }
        
        $info = $this
            ->getManager()
            ->getRepository($classInfo)
            ->findOneBy(['oldNewsId' => $oldArticle->getId()])
        ;

        if (!$info) {
            $info = new $classInfo();
            $info
                ->setOldNewsId($oldArticle->getId())
                ->setOldNewsTable('OldNews')
                ->setPublishedAt($oldArticle->getStartDate() ?: $oldArticle->getUpdatedAt())
                ->setCreatedAt($oldArticle->getCreatedAt())
                ->setUpdatedAt($oldArticle->getUpdatedAt())
                ->setFestival($this->getFestival($oldArticle))
                ->setHideSameDay(false)
                ->setDisplayedHome(false)
                ->setTheme($this->defaultTheme)
            ;
            $this->getManager()->persist($info);
        }

        if (!$info->getSites()->contains($this->getSiteCorporate())) {
            $info->addSite($this->getSiteCorporate());
        }

        $this->getManager()->flush();
        return $info;
    }


    /**
     * @param Info $info
     * @param OldArticleI18n $oldTranslation
     * @return NodeTranslationInterface
     */
    protected function buildInfoArticleTranslation(Info $info, OldArticleI18n $oldTranslation)
    {
        if ($this->isInfoImage) {
            $classInfoTranslation = InfoImageTranslation::class;
        } else {
            $classInfoTranslation = InfoArticleTranslation::class;
        }

        $mapperFields = [
            'resume' => 'introduction',
        ];

        $locale = $oldTranslation->getCulture() == 'cn' ? 'zh' : $oldTranslation->getCulture();
        if (in_array($locale, $this->langs)) {
            $translation = $this
                ->getManager()
                ->getRepository($classInfoTranslation)
                ->findOneBy(['locale' => $locale, 'translatable' => $info])
            ;

            if (!$translation) {
                $translation = new $classInfoTranslation();
                $translation
                    ->setCreatedAt($info->getCreatedAt())
                    ->setUpdatedAt($info->getCreatedAt())
                    ->setTranslatable($info)
                    ->setLocale($locale)
                    ->setIsPublishedOnFDCEvent(false)
                ;
                $this->getManager()->persist($translation);

                if ($locale == 'fr') {
                    if ($this->status) {
                        $translation->setStatus($this->status);
                    } else {
                        $translation->setStatus(TranslateChildInterface::STATUS_PUBLISHED);
                    }
                } else {
                    $translation->setStatus(TranslateChildInterface::STATUS_TRANSLATED);
                }
            }

            if ($oldTranslation->getImageResume()) {
                $file = $this->createImage('http://www.festival-cannes.fr/assets/Image/Pages/' . trim($oldTranslation->getImageResume()));
                if ($file) {
                    $header = $info->getHeader();
                    if (!$header) {
                        $header = new MediaImage();
                        $this->getManager()->persist($header);
                        $info->setHeader($header);
                    }

                    $header
                        ->setTheme($this->getDefaultTheme())
                        ->setFestival($info->getFestival())
                        ->setCreatedAt($info->getCreatedAt())
                        ->setUpdatedAt($info->getUpdatedAt())
                        ->setDisplayedAll(true)
                        ->setPublishedAt($info->getPublishedAt())
                        ->setPublishEndedAt($info->getPublishEndedAt())
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
                        $media->setCreatedAt($info->getCreatedAt());
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

    protected function buildInfoWidgetText(Info $info, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getBody()) {
            return null;
        }
        $widget = null;
        foreach ($info->getWidgets() as $item) {
            if ($item instanceof InfoWidgetText && $item->getOldImportReference() == 'body') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new InfoWidgetText();
            $widget
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
            $info->addWidget($widget);
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new InfoWidgetTextTranslation();
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
     * @param Info $info
     * @param NodeTranslationInterface $translation
     * @param OldArticleI18n $oldTranslation
     * @return InfoWidgetVideoYoutube|mixed|null
     */
    protected function buildInfoWidgetYoutube(Info $info, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getYoutubeLink() || !$oldTranslation->getYoutubeLinkDescription()) {
            return null;
        }

        $widget = null;
        foreach ($info->getWidgets() as $item) {
            if ($item instanceof InfoWidgetVideoYoutube && $item->getOldImportReference() == 'youtube') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new InfoWidgetVideoYoutube();
            $widget
                ->setOldImportReference('youtube')
                ->setPosition($this->getWidgetPosition())
            ;
            $info->addWidget($widget);
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new InfoWidgetVideoYoutubeTranslation();
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

    protected function buildInfoWidgetImage(Info $info, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
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
        foreach ($info->getWidgets() as $item) {
            if ($item instanceof InfoWidgetImage && $item->getOldImportReference() == 'image') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new InfoWidgetImage();
            $widget
                ->setOldImportReference('image')
                ->setPosition($this->getWidgetPosition())
            ;
            $info->addWidget($widget);
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
                                    ->getRepository('BaseCoreBundle:InfoWidgetImage')
                                    ->findOneBy(['gallery' => $gallery->getId()])
                                ;
                                if ($widget) {
                                    $widget->setGallery(null);
//                                    $this->getManager()->remove($mediaImage);
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

    protected function buildInfoWidgetsAudio(Info $info, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
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
                        ->getRepository('BaseCoreBundle:InfoWidgetAudio')
                        ->findBy(['file' => $mediaAudio->getId()])
                    ;

                    if ($widgets) {
                        foreach ($widgets as $widgetToRemove) {
                            $widgetToRemove->setFile(null);
                            $this->getManager()->remove($widgetToRemove);
                        }
                    }

//                    $this->getManager()->remove($mediaAudio);
                    $this->getManager()->flush();
                }
                continue;
            }

            $widget = null;
            $reference = 'audio' . $objectId;
            foreach ($info->getWidgets() as $item) {
                if ($item instanceof InfoWidgetAudio && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new InfoWidgetAudio();
                $widget
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $info->addWidget($widget);
                $this->getManager()->persist($widget);
            }

            $widget->setFile($mediaAudio);
            $this->getManager()->flush();
        }
    }

    protected function buildInfoWidgetsVideo(Info $info, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
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
                        ->getRepository('BaseCoreBundle:InfoWidgetVideo')
                        ->findBy(['file' => $mediaVideo->getId()])
                    ;

                    if ($widgets) {
                        foreach ($widgets as $widgetToRemove) {
                            $widgetToRemove->setFile(null);
                            $this->getManager()->remove($widgetToRemove);
                        }
                    }

//                    $this->getManager()->remove($mediaVideo);
                    $this->getManager()->flush();
                }
                continue;
            }

            $widget = null;
            $reference = 'video' . $oldArticleAssociation->getObjectId();
            foreach ($info->getWidgets() as $item) {
                if ($item instanceof InfoWidgetVideo && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new InfoWidgetVideo();
                $widget
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $info->addWidget($widget);
                $this->getManager()->persist($widget);
            }

            $widget->setFile($mediaVideo);
            $this->getManager()->flush();
        }
    }

    protected function buildAssociatedFilms(Info $info, OldArticle $oldArticle)
    {
        if (!$this->associateMovie) {
            foreach ($info->getAssociatedFilms() as $associatedFilm) {
                $info->removeAssociatedFilm($associatedFilm);
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
        if (count($films) == 1) {
            $info->setAssociatedFilm(reset($films));
            foreach ($info->getAssociatedFilms() as $associatedFilm) {
                $info->removeAssociatedFilm($associatedFilm);
                $this->getManager()->remove($associatedFilm);
            }
        } else {
            $info->setAssociatedFilm(null);
            foreach ($films as $film) {
                $found = false;
                foreach ($info->getAssociatedFilms() as $associatedFilm) {
                    if ($associatedFilm->getAssociation()->getId() == $film->getId()) {
                        $found = true;
                    }
                }
                if (!$found) {
                    $associatedFilm = new InfoFilmFilmAssociated();
                    $associatedFilm
                        ->setInfo($info)
                        ->setAssociation($film)
                    ;
                    $this->getManager()->persist($associatedFilm);
                }
            }
        }
        $this->getManager()->flush();

    }

    protected function buildAssociatedInfos(Info $info, OldArticle $oldArticle)
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
                ->getRepository('BaseCoreBundle:Info')
                ->findOneBy(['oldNewsId' => $oldArticleAssociation->getObjectId()])
            ;
            if ($item) {
                $found = false;
                foreach ($info->getAssociatedInfo() as $associatedInfo) {
                    if ($associatedInfo->getAssociation() && $associatedInfo->getAssociation()->getId() == $item->getId()) {
                        $found = true;
                    }
                }
                if (!$found) {
                    $associatedInfo = new InfoInfoAssociated();
                    $associatedInfo
                        ->setInfo($info)
                        ->setAssociation($item)
                    ;
                    $this->getManager()->persist($associatedInfo);
                }
            }
            $this->getManager()->flush();
        }
    }


    protected function getWidgetPosition()
    {
        return $this->widgetPosition++;
    }

    protected function isInfoMatching(OldArticle $oldArticle, $oldArticleTranslations)
    {
        if ($oldArticle->getDisplayAsPortfolio()) {
            $this->isInfoImage = true;
        } else {
            $this->isInfoImage = false;
        }

        // Actualités-Festival de 2010 > 2015
        $isAvailable = $oldArticle->getIsOnline() && $oldArticle->getCreatedAt();
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2010;
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2015;
        if ($isAvailable) {
            $hasWord = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'marches') !== false)) {
                    $hasWord = true;
                }
            }
            if ($hasWord) {
                $this->status = TranslateChildInterface::STATUS_DEACTIVATED;
            } else {
                $this->status = TranslateChildInterface::STATUS_PUBLISHED;
            }

            return true;
        }

        $isAvailable = !$oldArticle->getIsOnline() && $oldArticle->getCreatedAt();
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2010;
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2015;
        $words = [
            'marches',
            'le savez-vous',
            'le saviez-vous',
            'phrase du jour',
            'presence a cannes',
        ];

        if ($isAvailable) {
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                foreach ($words as $word) {
                    if ($trans->getCulture() == 'fr' && (stripos($title, $word) !== false)) {
                        $this->status = TranslateChildInterface::STATUS_DEACTIVATED;
                        return true;
                    }
                }
            }
        }
    }

    /**
     * @param $oldArticleId
     * @return null
     */
    public function removeInfo($oldArticleId)
    {
        $newsArticle = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:InfoArticle')
            ->findOneBy(['oldNewsId' => $oldArticleId])
        ;
        if (!$newsArticle) {
            return null;
        }
        $fields = $this->getManager()->getClassMetadata('BaseCoreBundle:InfoArticle')->getAssociationNames();
        foreach ($newsArticle->getTranslations() as $translation) {
            $newsArticle->getTranslations()->removeElement($translation);
            $this->getManager()->remove($translation);
        }
        foreach ($newsArticle->getAssociatedInfo() as $infoAssociated) {
            if ($infoAssociated instanceof InfoInfoAssociated) {
                $infoAssociated->setAssociation(null);
                $infoAssociated->setInfo(null);
                $this->getManager()->remove($infoAssociated);
                $this->getManager()->flush();
                $newsArticle->removeAssociatedInfo($infoAssociated);
            }
        }
        foreach ($fields as $field) {
            $association = $this
                ->getManager()
                ->getClassMetadata('BaseCoreBundle:InfoArticle')
                ->isCollectionValuedAssociation($field)
            ;
            $getter = 'get' . ucfirst($field);
            $setter = 'set' . ucfirst($field);
            if ($association) {
                foreach ($newsArticle->$getter() as $item) {
                    $newsArticle->$getter()->removeElement($item);
                }
            } else {
                $newsArticle->$setter(null);
            }
        }

        $this->getManager()->remove($newsArticle);
        $this->getManager()->flush();
    }
}