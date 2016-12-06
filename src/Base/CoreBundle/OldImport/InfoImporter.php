<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoArticleTranslation;
use Base\CoreBundle\Entity\InfoFilmFilmAssociated;
use Base\CoreBundle\Entity\InfoInfoAssociated;
use Base\CoreBundle\Entity\InfoWidgetAudio;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\InfoWidgetText;
use Base\CoreBundle\Entity\InfoWidgetTextTranslation;
use Base\CoreBundle\Entity\InfoWidgetVideo;
use Base\CoreBundle\Entity\InfoWidgetVideoYoutube;
use Base\CoreBundle\Entity\InfoWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class InfoImporter extends Importer
{
    protected $widgetPosition = 0;

    protected $status;

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
     * @return InfoArticle
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
                $this->buildInfoWidgetText($info, $translation, $oldTranslation);
                $this->buildInfoWidgetYoutube($info, $translation, $oldTranslation);
                $this->buildInfoWidgetImage($info, $translation, $oldTranslation);
                $this->buildInfoWidgetsAudio($info, $translation, $oldTranslation);
                $this->buildInfoWidgetsVideo($info, $translation, $oldTranslation);
                $this->buildAssociatedFilms($info, $oldArticle);
                $this->buildAssociatedInfos($info, $oldArticle);
            }
        }

        return $info;
    }

    /**
     * @param OldArticle $oldArticle
     * @return InfoArticle
     */
    protected function buildInfoArticle(OldArticle $oldArticle)
    {
        $info = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:InfoArticle')
            ->findOneBy(['oldNewsId' => $oldArticle->getId()])
        ;

        if (!$info) {
            $info = new InfoArticle();
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
     * @param InfoArticle $info
     * @param OldArticleI18n $oldTranslation
     * @return InfoArticleTranslation
     */
    protected function buildInfoArticleTranslation(InfoArticle $info, OldArticleI18n $oldTranslation)
    {
        $mapperFields = array(
            'resume' => 'introduction',
        );

        $locale = $oldTranslation->getCulture() == 'cn' ? 'zh' : $oldTranslation->getCulture();
        if (in_array($locale, $this->langs)) {
            $translation = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:InfoArticleTranslation')
                ->findOneBy(['locale' => $locale, 'translatable' => $info])
            ;

            if (!$translation) {
                $translation = new InfoArticleTranslation();
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
                        $translation->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                    }
                } else {
                    $translation->setStatus(InfoArticleTranslation::STATUS_TRANSLATED);
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

    protected function buildInfoWidgetText(InfoArticle $info, InfoArticleTranslation $translation, OldArticleI18n $oldTranslation)
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
                ->setInfo($info)
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
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
     * @param InfoArticle $info
     * @param InfoArticleTranslation $translation
     * @param OldArticleI18n $oldTranslation
     * @return InfoWidgetVideoYoutube|mixed|null
     */
    protected function buildInfoWidgetYoutube(InfoArticle $info, InfoArticleTranslation $translation, OldArticleI18n $oldTranslation)
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
                ->setInfo($info)
                ->setOldImportReference('youtube')
                ->setPosition($this->getWidgetPosition())
            ;
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

    protected function buildInfoWidgetImage(InfoArticle $info, InfoArticleTranslation $translation, OldArticleI18n $oldTranslation)
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
        foreach ($info->getWidgets() as $item) {
            if ($item instanceof InfoWidgetImage && $item->getOldImportReference() == 'image') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new InfoWidgetImage();
            $widget
                ->setInfo($info)
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
                $mediaImageTranslation->setStatus(InfoArticleTranslation::STATUS_PUBLISHED);
            } else {
                $mediaImageTranslation->setStatus(InfoArticleTranslation::STATUS_TRANSLATED);
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

    protected function buildInfoWidgetsAudio(InfoArticle $info, InfoArticleTranslation $translation, OldArticleI18n $oldTranslation)
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
            foreach ($info->getWidgets() as $item) {
                if ($item instanceof InfoWidgetAudio && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new InfoWidgetAudio();
                $widget
                    ->setInfo($info)
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

    protected function buildInfoWidgetsVideo(InfoArticle $info, InfoArticleTranslation $translation, OldArticleI18n $oldTranslation)
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
            foreach ($info->getWidgets() as $item) {
                if ($item instanceof InfoWidgetVideo && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new InfoWidgetVideo();
                $widget
                    ->setInfo($info)
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

    protected function buildAssociatedFilms(InfoArticle $info, OldArticle $oldArticle)
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
                if (!$info->getAssociatedFilm()) {
                    $info->setAssociatedFilm($film);
                }

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
                    $this->getManager()->persist($film);
                }
            }
            $this->getManager()->flush();
        }
    }

    protected function buildAssociatedInfos(InfoArticle $info, OldArticle $oldArticle)
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
}