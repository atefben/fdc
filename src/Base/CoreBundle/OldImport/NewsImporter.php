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
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsFilmFilmAssociated;
use Base\CoreBundle\Entity\NewsNewsAssociated;
use Base\CoreBundle\Entity\NewsWidgetAudio;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsWidgetVideo;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutube;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class NewsImporter extends Importer
{
    protected $widgetPosition = 0;

    protected $status;

    public function importNews($paginate = null)
    {
        $this->output->writeln('<info>Import news...</info>');
        if ($paginate) {
            $this->output->writeln("<comment>Page $paginate</comment>");
            $pages = 1;
            $count = $this->countNews($paginate);
        } else {
            $count = $this->countNews();
            $pages = ceil($count / 100);
        }
        $progress = new ProgressBar($this->output, $count);
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();

        for ($page = 1; $page <= $pages; $page++) {
            $oldArticles = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldArticle')
                ->createQueryBuilder('o')
                ->andWhere('o.articleTypeId in (:types)')
                ->setParameter(':types', [static::TYPE_QUOTIDIEN, static::TYPE_WALL, static::TYPE_TOO, static::TYPE_PHOTOPGRAH_EYE])
                ->addOrderBy('o.id', 'asc')
                ->setMaxResults(100)
                ->setFirstResult((($paginate ?: $page) - 1) * 100)
                ->getQuery()
                ->getResult()
            ;

            foreach ($oldArticles as $oldArticle) {
                $progress->advance();
                $news = $this->importItem($oldArticle);
                if ($news) {
                    foreach ($this->langs as $lang) {
                        $translation = $news->findTranslationByLocale($lang);
                    }
                }
            }

            //$this->getManager()->clear();
            //unset($oldArticles);

            $this->getSiteEvent(true);
            $this->getSiteCorporate(true);
            $this->getDefaultTheme(true);
        }
        $progress->finish();
        $this->output->writeln('');

        return $this;
    }

    public function countNews($paginate = null)
    {
        $qb = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->createQueryBuilder('o')
            ->select('count(o)')
            ->andWhere('o.articleTypeId in (:types)')
            ->setParameter(':types', [static::TYPE_QUOTIDIEN, static::TYPE_WALL, static::TYPE_TOO, static::TYPE_PHOTOPGRAH_EYE])
        ;

        if ($paginate) {
            return count($qb
                ->select('o')
                ->setFirstResult(($paginate - 1) * 100)
                ->setMaxResults(100)
                ->getQuery()
                ->getResult()
            );
        }

        return $qb
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param OldArticle $oldArticle
     * @return NewsArticle
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

        $matching = $this->isNewsMatching($oldArticle, $oldTranslations);
        if (!$matching) {
            return null;
        }

        $news = $this->buildNewsArticle($oldArticle);

        foreach ($oldTranslations as $oldTranslation) {
            $translation = $this->buildNewsArticleTranslation($news, $oldTranslation);
            if ($translation) {
                $this->buildNewsWidgetText($news, $translation, $oldTranslation);
                $this->buildNewsWidgetYoutube($news, $translation, $oldTranslation);
                $this->buildNewsWidgetImage($news, $translation, $oldTranslation);
                $this->buildNewsWidgetsAudio($news, $translation, $oldTranslation);
                $this->buildNewsWidgetsVideo($news, $translation, $oldTranslation);
                $this->buildAssociatedFilms($news, $oldArticle);
                $this->buildAssociatedNews($news, $oldArticle);
            }
        }

        return $news;
    }

    /**
     * @param OldArticle $oldArticle
     * @return NewsArticle
     */
    protected function buildNewsArticle(OldArticle $oldArticle)
    {
        $news = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsArticle')
            ->findOneBy(['oldNewsId' => $oldArticle->getId()])
        ;

        if (!$news) {
            $news = new NewsArticle();
            $news
                ->setOldNewsId($oldArticle->getId())
                ->setOldNewsTable('OldNews')
                ->setPublishedAt($oldArticle->getStartDate() ?: $oldArticle->getUpdatedAt())
                ->setCreatedAt($oldArticle->getCreatedAt())
                ->setUpdatedAt($oldArticle->getUpdatedAt())
                ->setFestival($this->getFestival($oldArticle))
                ->setTheme($this->defaultTheme)
                ->setIsPublishedOnFDCEvent(true) // test if works
            ;
            $this->getManager()->persist($news);
        }


        if (!$news->getSites()->contains($this->getSiteCorporate())) {
            $news->addSite($this->getSiteCorporate());
        }

        $this->getManager()->flush();

        return $news;
    }


    protected function buildNewsArticleTranslation(NewsArticle $news, OldArticleI18n $oldTranslation)
    {
        $mapperFields = array(
            'resume' => 'introduction',
        );

        $locale = $oldTranslation->getCulture() == 'cn' ? 'zh' : $oldTranslation->getCulture();
        if (in_array($locale, $this->langs)) {
            $translation = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:NewsArticleTranslation')
                ->findOneBy(['locale' => $locale, 'translatable' => $news])
            ;

            if (!$translation) {
                $translation = new NewsArticleTranslation();
                $translation
                    ->setCreatedAt($news->getCreatedAt())
                    ->setUpdatedAt($news->getCreatedAt())
                    ->setTranslatable($news)
                    ->setLocale($locale)
                    ->setIsPublishedOnFDCEvent(true)
                ;
                $this->getManager()->persist($translation);

                if ($locale == 'fr') {
                    if ($this->status) {
                        $translation->setStatus($this->status);
                    } else {
                        $translation->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                    }
                } else {
                    $translation->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                }
            }

            if ($oldTranslation->getImageResume()) {
                $file = $this->createImage('http://www.festival-cannes.fr/assets/Image/Pages/' . trim($oldTranslation->getImageResume()));
                if ($file) {
                    $header = $news->getHeader();
                    if (!$header) {
                        $header = new MediaImage();
                        $this->getManager()->persist($header);

                        $news->setHeader($header);
                    }
                    $header
                        ->setTheme($this->getDefaultTheme())
                        ->setFestival($news->getFestival())
                        ->setDisplayedAll(true)
                        ->setPublishedAt($news->getPublishedAt())
                        ->setPublishEndedAt($news->getPublishEndedAt())
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
                        $media->setCreatedAt($news->getCreatedAt());
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

    protected function buildNewsWidgetText(NewsArticle $news, NewsArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getBody()) {
            return null;
        }
        $widget = null;
        foreach ($news->getWidgets() as $item) {
            if ($item instanceof NewsWidgetText && $item->getOldImportReference() == 'body') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new NewsWidgetText();
            $widget
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
            $news->addWidget($widget);
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new NewsWidgetTextTranslation();
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

    protected function buildNewsWidgetYoutube(NewsArticle $news, NewsArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        if (!$oldTranslation->getYoutubeLink() || !$oldTranslation->getYoutubeLinkDescription()) {
            return null;
        }

        $widget = null;
        foreach ($news->getWidgets() as $item) {
            if ($item instanceof NewsWidgetVideoYoutube && $item->getOldImportReference() == 'youtube') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new NewsWidgetVideoYoutube();
            $widget
                ->setOldImportReference('youtube')
                ->setPosition($this->getWidgetPosition())
            ;
            $news->addWidget($widget);
            $this->getManager()->persist($widget);
        }

        $widgetTranslation = $widget->findTranslationByLocale($translation->getLocale());
        if (!$widgetTranslation) {
            $widgetTranslation = new NewsWidgetVideoYoutubeTranslation();
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

    protected function buildNewsWidgetImage(NewsArticle $news, NewsArticleTranslation $translation, OldArticleI18n $oldTranslation)
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
        foreach ($news->getWidgets() as $item) {
            if ($item instanceof NewsWidgetImage && $item->getOldImportReference() == 'image') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new NewsWidgetImage();
            $widget
                ->setOldImportReference('image')
                ->setPosition($this->getWidgetPosition())
            ;
            $news->addWidget($widget);
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

            $file = $this->createImage('http://www.festival-cannes.fr/assets/Image/General/' . trim($oldMedia->getFilename()));
            if (!$file) {
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
                                    ->getRepository('BaseCoreBundle:NewsWidgetImage')
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
                $mediaImage->setOldMediaId($oldArticleAssociation->getObjectId());
                $this->getManager()->persist($mediaImage);
            }

            $mediaImage
                ->setTheme($this->defaultTheme)
                ->setDisplayedAll(true)
                ->setPublishedAt($oldMedia->getPublishFor())
                ->setCreatedAt($oldMedia->getCreatedAt())
                ->setUpdatedAt($oldMedia->getUpdatedAt())
            ;

            if (!$mediaImage->getSites()->contains($this->getSiteCorporate())) {
                $mediaImage->addSite($this->getSiteCorporate());
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
                $mediaImageTranslation->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
            } else {
                $mediaImageTranslation->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
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

    protected function buildNewsWidgetsAudio(NewsArticle $news, NewsArticleTranslation $translation, OldArticleI18n $oldTranslation)
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

            $oldMedia = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldMedia')
                ->findOneBy(['id' => $oldArticleAssociation->getObjectId()])
            ;

            if (!$oldAudioTrans || !$oldMedia) {
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
                $mediaAudio = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:MediaAudio')
                    ->findOneBy(['oldMediaId' => $oldArticleAssociation->getObjectId()])
                ;

                if ($mediaAudio) {
                    $widgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:NewsWidgetAudio')
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
            foreach ($news->getWidgets() as $item) {
                if ($item instanceof NewsWidgetAudio && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new NewsWidgetAudio();
                $widget
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $news->addWidget($widget);
                $this->getManager()->persist($widget);
            }

            $mediaAudio = $widget->getFile();
            if (!$mediaAudio) {
                $mediaAudio = new MediaAudio();
                $mediaAudio->setOldMediaId($oldArticleAssociation->getObjectId());
                $this->getManager()->persist($mediaAudio);

                $widget->setFile($mediaAudio);
            }

            $mediaAudio
                ->setTheme($this->defaultTheme)
                ->setDisplayedAll(true)
                ->setPublishedAt($oldMedia->getPublishFor())
                ->setCreatedAt($oldMedia->getCreatedAt())
                ->setUpdatedAt($oldMedia->getUpdatedAt())
            ;

            if (!$mediaAudio->getSites()->contains($this->getSiteCorporate())) {
                $mediaAudio->addSite($this->getSiteCorporate());
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

    protected function buildNewsWidgetsVideo(NewsArticle $news, NewsArticleTranslation $translation, OldArticleI18n $oldTranslation)
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

            $oldMedia = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldMedia')
                ->findOneBy(['id' => $oldArticleAssociation->getObjectId()])
            ;

            if (!$oldVideoTrans || !$oldMedia) {
                continue;
            }


            $widget = null;
            $reference = 'video' . $oldArticleAssociation->getObjectId();
            foreach ($news->getWidgets() as $item) {
                if ($item instanceof NewsWidgetVideo && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            $path = $oldVideoTrans->getDeliveryUrl();
            $pathArray = explode(',', $path);
            $path = $pathArray[0] . '80' . $pathArray[count($pathArray) - 1];
            $file = $this->createVideo('http://canneshd-a.akamaihd.net/' . trim($path));
            if (!$file) {
                $mediaVideo = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:MediaVideo')
                    ->findOneBy(['oldMediaId' => $oldArticleAssociation->getObjectId()])
                ;
                if ($mediaVideo) {
                    $widgets = $this
                        ->getManager()
                        ->getRepository('BaseCoreBundle:NewsWidgetVideo')
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

            if (!$widget) {
                $widget = new NewsWidgetVideo();
                $widget
                    ->setOldImportReference($reference)
                    ->setPosition($this->getWidgetPosition())
                ;
                $news->addWidget($widget);
                $this->getManager()->persist($widget);
            }

            $mediaVideo = $widget->getFile();
            if (!$mediaVideo) {
                $mediaVideo = new MediaVideo();
                $mediaVideo->setOldMediaId($oldArticleAssociation->getObjectId());
                $this->getManager()->persist($mediaVideo);

                $widget->setFile($mediaVideo);
            }

            $mediaVideo
                ->setDisplayedHomeCorpo(false)
                ->setTheme($this->defaultTheme)
                ->setDisplayedAll(true)
                ->setPublishedAt($oldMedia->getPublishFor())
                ->setCreatedAt($oldMedia->getCreatedAt())
                ->setUpdatedAt($oldMedia->getUpdatedAt())
            ;

            if (!$mediaVideo->getSites()->contains($this->getSiteCorporate())) {
                $mediaVideo->addSite($this->getSiteCorporate());
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

    protected function buildAssociatedFilms(NewsArticle $news, OldArticle $oldArticle)
    {
        if (!$this->associateMovie) {
            foreach ($news->getAssociatedFilms() as $associatedFilm) {
                $news->removeAssociatedFilm($associatedFilm);
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

        foreach ($oldArticleAssociations as $oldArticleAssociation) {
            $film = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->find($oldArticleAssociation->getObjectId())
            ;
            if ($film) {
                if (!$news->getAssociatedFilm()) {
                    $news->setAssociatedFilm($film);
                }

                $found = false;
                foreach ($news->getAssociatedFilms() as $associatedFilm) {
                    if ($associatedFilm->getAssociation()->getId() == $film->getId()) {
                        $found = true;
                    }
                }
                if (!$found) {
                    $associatedFilm = new NewsFilmFilmAssociated();
                    $associatedFilm
                        ->setNews($news)
                        ->setAssociation($film)
                    ;
                    $this->getManager()->persist($film);
                }
            }
            $this->getManager()->flush();
        }
    }

    protected function buildAssociatedNews(NewsArticle $news, OldArticle $oldArticle)
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
                ->getRepository('BaseCoreBundle:News')
                ->findOneBy(['oldNewsId' => $oldArticleAssociation->getObjectId()])
            ;
            if ($item) {
                $found = false;
                foreach ($news->getAssociatedNews() as $associatedNews) {
                    if ($associatedNews->getAssociation() && $associatedNews->getAssociation()->getId() == $item->getId()) {
                        $found = true;
                    }
                }
                if (!$found) {
                    $associatedNews = new NewsNewsAssociated();
                    $associatedNews
                        ->setNews($news)
                        ->setAssociation($item)
                    ;
                    $this->getManager()->persist($associatedNews);
                }
            }
            $this->getManager()->flush();
        }
    }


    protected function getWidgetPosition()
    {
        return $this->widgetPosition++;
    }

    /**
     * @param OldArticle $oldArticle
     * @param OldArticleI18n[] $oldArticleTranslations
     * @return bool
     */
    protected function isNewsMatching(OldArticle $oldArticle, $oldArticleTranslations)
    {
        $this->doNotPublish = false;
        $this->associateMovie = true;

        if ($oldArticle->getArticleTypeId() == static::TYPE_QUOTIDIEN) {
            // case one
            // Communiqués-Festival de 2001 > 2006
            $condIsAvailable = $oldArticle->getIsOnline() && $oldArticle->getCreatedAt();
            $condIsAvailable = $condIsAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2001;
            $condIsAvailable = $condIsAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2006;
            if ($condIsAvailable) {
                $this->status = TranslateChildInterface::STATUS_DEACTIVATED;
                $this->associateMovie = false;
                return true;
            }

            // case two
            // Quotidien 2007 > 2015 - Articles Conférence de presse (films / jurys / lauréats)
            $isAvailable = $oldArticle->getCreatedAt();
            $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2007;
            $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2015;

            $words = [
                'marches',
                'le savez-vous',
                'le saviez-vous',
                'phrase du jour',
                'presence a cannes',
            ];

            if ($isAvailable) {
                $hasWord = false;
                foreach ($oldArticleTranslations as $trans) {
                    $title = $this->removeAccents($trans->getTitle());
                    foreach ($words as $word) {
                        if ($trans->getCulture() == 'fr' && (stripos($title, $word) !== false)) {
                            $hasWord = true;
                        }
                    }
                }
                if ($hasWord || !$oldArticle->getIsOnline()) {
                    $this->status = TranslateChildInterface::STATUS_DEACTIVATED;
                } else {
                    $this->status = TranslateChildInterface::STATUS_PUBLISHED;
                }
                return true;
            }

        }
        if ($oldArticle->getArticleTypeId() == static::TYPE_WALL) {
            $condIsAvailable = $oldArticle->getIsOnline() && $oldArticle->getId() >= 58030 && $oldArticle->getId() <= 60452;
            if ($condIsAvailable) {
                $this->status = TranslateChildInterface::STATUS_DEACTIVATED;
                return true;
            }
        }


        if (in_array($oldArticle->getArticleTypeId(), [static::TYPE_TOO, static::TYPE_PHOTOPGRAH_EYE])) {
            $words = ['le savez-vous', 'présence à Cannes'];
            $condIsAvailable = !$oldArticle->getIsOnline();
            if ($condIsAvailable) {
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
        return false;
    }
}