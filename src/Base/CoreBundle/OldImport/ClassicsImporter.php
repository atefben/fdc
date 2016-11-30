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

class ClassicsImporter extends Importer
{
    protected $widgetPosition = 0;

    public function importClassics()
    {
        $this->output->writeln('<info>Import statements...</info>');

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

    protected function countClassics()
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
                ->setCreatedAt($oldArticle->getCreatedAt())
                ->setUpdatedAt($oldArticle->getUpdatedAt())
                ->setWeight(0)
            ;
            $this->getManager()->persist($classics);
        }

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
        $mapperFields = array(
            //'resume' => 'introduction',
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

                if ($locale == 'fr') {
                    $translation->setStatus(StatementArticleTranslation::STATUS_PUBLISHED);
                } else {
                    $translation->setStatus(StatementArticleTranslation::STATUS_TRANSLATED);
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
                ->setFDCPageLaSelectionCannesClassics($classics)
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
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
                ->setFDCPageLaSelectionCannesClassics($classics)
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

    protected function buildClassicsWidgetImage(FDCPageLaSelectionCannesClassics $classics, FDCPageLaSelectionCannesClassicsTranslation $translation, OldArticleI18n $oldTranslation)
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
        foreach ($classics->getWidgets() as $item) {
            if ($item instanceof FDCPageLaSelectionCannesClassicsWidgetImage && $item->getOldImportReference() == 'image') {
                $widget = $item;
            }
        }

        if (!$widget) {
            $widget = new FDCPageLaSelectionCannesClassicsWidgetImage();
            $widget
                ->setFDCPageLaSelectionCannesClassics($classics)
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

    protected function buildClassicsWidgetsAudio(FDCPageLaSelectionCannesClassics $classics, FDCPageLaSelectionCannesClassicsTranslation $translation, OldArticleI18n $oldTranslation)
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
            foreach ($classics->getWidgets() as $item) {
                if ($item instanceof FDCPageLaSelectionCannesClassicsWidgetAudio && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new FDCPageLaSelectionCannesClassicsWidgetAudio();
                $widget
                    ->setFDCPageLaSelectionCannesClassics($classics)
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

    protected function buildClassicsWidgetsVideo(FDCPageLaSelectionCannesClassics $classics, FDCPageLaSelectionCannesClassicsTranslation $translation, OldArticleI18n $oldTranslation)
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
            foreach ($classics->getWidgets() as $item) {
                if ($item instanceof FDCPageLaSelectionCannesClassicsWidgetVideo && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
            }

            if (!$widget) {
                $widget = new FDCPageLaSelectionCannesClassicsWidgetVideo();
                $widget
                    ->setFDCPageLaSelectionCannesClassics($classics)
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



    protected function getWidgetPosition()
    {
        return $this->widgetPosition++;
    }

    protected function isClassicMatching(OldArticle $oldArticle)
    {
        $ids = [61333, 60588, 59714, 59046, 58130, 57154];
        return in_array($oldArticle->getId(), $ids);
    }
}