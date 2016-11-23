<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutube;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Symfony\Component\Console\Helper\ProgressBar;

class NewsImporter extends Importer
{
    protected $widgetPosition = 0;

    public function importNews()
    {
        $this->output->writeln('<info>Import news...</info>');

        $count = $this->countNews();

        $pages = ceil($count / 50);

        $progress = new ProgressBar($this->output, $count);
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();

        for ($page = 11; $page <= $pages; $page++) {
            $oldArticles = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldArticle')
                ->findBy(['articleTypeId' => static::TYPE_QUOTIDIEN], ['id' => 'asc'], 50, ($page - 1) * 50)
            ;

            foreach ($oldArticles as $oldArticle) {
                $progress->advance();
                $news = $this->importItem($oldArticle);
                if ($news) {
                    foreach ($this->langs as $lang) {
                        $translation = $news->findTranslationByLocale($lang);
                        if ($translation) {
                        }
                    }
                }
            }
            $this->getManager()->clear();
        }
        $progress->finish();


        return $this;
    }

    protected function countNews()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->createQueryBuilder('o')
            ->select('count(o)')
            ->andWhere('o.articleTypeId = :type')
            ->setParameter(':type', static::TYPE_QUOTIDIEN)
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
        $news = $this->buildNewsArticle($oldArticle);

        foreach ($oldTranslations as $oldTranslation) {
            $translation = $this->buildNewsArticleTranslation($news, $oldTranslation);
            if ($translation) {
                $this->buildNewsWidgetText($news, $translation, $oldTranslation);
                $this->buildNewsWidgetYoutube($news, $translation, $oldTranslation);
                $this->buildNewsWidgetsImage($news, $translation, $oldTranslation);
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
                ->setIsPublishedOnFDCEvent(true) // test if works
            ;
            $this->getManager()->persist($news);
        }


        if ($this->doNotPublish) {
            if (!$news->getSites()->contains($this->getSiteCorporate())) {
                $news->addSite($this->getSiteCorporate());
            }
            if (!$news->getSites()->contains($this->getSiteEvent())) {
                $news->addSite($this->getSiteEvent());
            }
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
                    $translation->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                } else {
                    $translation->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
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
                ->setNews($news)
                ->setOldImportReference('body')
                ->setPosition($this->getWidgetPosition())
            ;
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
                ->setNews($news)
                ->setOldImportReference('youtube')
                ->setPosition($this->getWidgetPosition())
            ;
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

    protected function buildNewsWidgetsImage(NewsArticle $news, NewsArticleTranslation $translation, OldArticleI18n $oldTranslation)
    {
        $imgTitle = array(
            'fr' => 'photo',
            'en' => 'photo',
            'es' => 'foto',
            'zh' => '照片',
        );

        $oldArticleAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleAssociation')->
            findBy(['id' => $oldTranslation->getId(), 'objectClass' => 'Image'], ['order' => 'ASC'])
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
                ->setNews($news)
                ->setOldImportReference('image')
                ->setPosition($this->getWidgetPosition())
            ;
            $this->getManager()->persist($widget);
        }

        $gallery = $widget->getGallery();
        if (!$gallery) {
            $gallery = new Gallery();
            $this->getManager()->persist($gallery);
            $widget
                ->setGallery($gallery);
            $gallery->setDateHomeCorpo(false);
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
                $file = $this->imagecreatefromfile('http://www.festival-cannes.fr/assets/Image/General/' . trim($oldMedia->getFilename()));
                $media->setName($oldMedia->getFilename());
                $media->setBinaryContent($file);
                $media->setEnabled(true);
                $media->setProviderReference($oldMedia->getFilename());
                $media->setContext('media_image');
                $media->setProviderStatus(1);
                $media->setProviderName('sonata.media.provider.image');
                $media->setCreatedAt($translation->getTranslatable()->getCreatedAt());
                $this->getMediaManager()->save($media, 'media_image', 'sonata.media.provider.image');

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
                    ->setGallery($gallery)
                    ->setMedia($mediaImage)
                    ->setPosition($position)
                    ->setGallery($gallery)
                ;
                $this->getManager()->persist($galleryMedia);
            }
        }

        $this->getManager()->flush();

        $this->output->writeln('<comment>Widget Image ' . $widget->getId() . ' for news ' . $translation->getTranslatable()->getId() . '</comment>');

        return $widget;
    }

    protected function getWidgetPosition()
    {
        return $this->widgetPosition++;
    }
}