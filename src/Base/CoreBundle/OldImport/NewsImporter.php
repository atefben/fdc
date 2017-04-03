<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Component\Interfaces\NodeArticleInterface;
use Base\CoreBundle\Component\Interfaces\NodeImageInterface;
use Base\CoreBundle\Component\Interfaces\NodeTranslationInterface;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsFilmFilmAssociated;
use Base\CoreBundle\Entity\NewsImage;
use Base\CoreBundle\Entity\NewsImageTranslation;
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
    protected $isNewsImage = false;

    protected function getTypes()
    {
        return [
            static::TYPE_QUOTIDIEN,
            static::TYPE_WALL,
            static::TYPE_TOO,
            static::TYPE_PHOTOPGRAH_EYE,
            static::TYPE_EDITO,
        ];
    }

    public function importOneNews($id)
    {
        $oldArticle = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->createQueryBuilder('o')
            ->andWhere('o.articleTypeId in (:types)')
            ->setParameter(':types', $this->getTypes())
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

        $this->getSiteEvent(true);
        $this->getSiteCorporate(true);
        $this->getDefaultTheme(true);
    }

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
                ->setParameter(':types', $this->getTypes())
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
            ->setParameter(':types', $this->getTypes())
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
     * @return News
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
                if ($this->input->getOption('update-films-only')) {
                    $this->buildAssociatedFilms($news, $oldArticle);
                } else {
                    $this->buildNewsWidgetText($news, $translation, $oldTranslation);
                    $this->buildNewsWidgetYoutube($news, $translation, $oldTranslation);
                    $this->buildNewsWidgetImage($news, $translation, $oldTranslation);
                    $this->buildNewsWidgetsAudio($news, $translation, $oldTranslation);
                    $this->buildNewsWidgetsVideo($news, $translation, $oldTranslation);
                    $this->buildAssociatedFilms($news, $oldArticle);
                    $this->buildAssociatedNews($news, $oldArticle);
                }

            }
        }

        return $news;
    }

    /**
     * @param OldArticle $oldArticle
     * @return News
     */
    protected function buildNewsArticle(OldArticle $oldArticle)
    {
        if ($this->isNewsImage) {
            $classNews = NewsImage::class;
            $this->removeNews($oldArticle->getId());
        } else {
            $classNews = NewsArticle::class;
        }

        $news = $this
            ->getManager()
            ->getRepository($classNews)
            ->findOneBy(['oldNewsId' => $oldArticle->getId()])
        ;

        if (!$news) {
            $news = new $classNews();
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


    protected function buildNewsArticleTranslation(News $news, OldArticleI18n $oldTranslation)
    {
        if ($this->isNewsImage) {
            $classNewsTranslation = NewsImageTranslation::class;
        } else {
            $classNewsTranslation = NewsArticleTranslation::class;
        }
        $mapperFields = [
            'resume' => 'introduction',
        ];

        $locale = $oldTranslation->getCulture() == 'cn' ? 'zh' : $oldTranslation->getCulture();
        if (in_array($locale, $this->langs)) {
            $translation = $this
                ->getManager()
                ->getRepository($classNewsTranslation)
                ->findOneBy(['locale' => $locale, 'translatable' => $news])
            ;

            if (!$translation) {
                $translation = new $classNewsTranslation();
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
                        $translation->setStatus(TranslateChildInterface::STATUS_PUBLISHED);
                    }
                } else {
                    $translation->setStatus(TranslateChildInterface::STATUS_TRANSLATED);
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

    protected function buildNewsWidgetText(News $news, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
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

    protected function buildNewsWidgetYoutube(News $news, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
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

    protected function buildNewsWidgetImage(News $news, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
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
                                    ->getRepository('BaseCoreBundle:NewsWidgetImage')
                                    ->findOneBy(['gallery' => $gallery->getId()])
                                ;
                                if ($widget) {
                                    $widget->setGallery(null);
//                                    $this->getManager()->remove($mediaImage);
                                }
//                                $this->getManager()->remove($gallery);
                            }
                        }
                    }

//                    $this->getManager()->remove($mediaImage);
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

    protected function buildNewsWidgetsAudio(News $news, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
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
                        ->getRepository('BaseCoreBundle:NewsWidgetAudio')
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

            $widget->setFile($mediaAudio);
            $this->getManager()->flush();
        }
    }

    protected function buildNewsWidgetsVideo(News $news, NodeTranslationInterface $translation, OldArticleI18n $oldTranslation)
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
                    ->findOneBy(['oldMediaId' => $objectId])
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

//                    $this->getManager()->remove($mediaVideo);
                    $this->getManager()->flush();
                }
                continue;
            }

            $widget = null;
            $reference = 'video' . $oldArticleAssociation->getObjectId();
            foreach ($news->getWidgets() as $item) {
                if ($item instanceof NewsWidgetVideo && $item->getOldImportReference() == $reference) {
                    $widget = $item;
                }
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

            $widget->setFile($mediaVideo);
            $this->getManager()->flush();
        }
    }

    protected function buildAssociatedFilms(News $news, OldArticle $oldArticle)
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
            $news->setAssociatedFilm(reset($films));
            foreach ($news->getAssociatedFilms() as $associatedFilm) {
                $news->removeAssociatedFilm($associatedFilm);
                $this->getManager()->remove($associatedFilm);
            }
        } else {
            $news->setAssociatedFilm(null);
            foreach ($films as $film) {
                $found = false;
                foreach ($news->getAssociatedFilms() as $associatedFilm) {
                    if ($associatedFilm->getAssociation()->getId() == $film->getId()) {
                        $found = true;
                    }
                }
                if (!$found) {
                    $associatedFilm = new NewsFilmFilmAssociated();
                    $associatedFilm->setAssociation($film);
                    $news->addAssociatedFilm($associatedFilm);
                    $this->getManager()->persist($associatedFilm);
                }

            }
        }
        $this->getManager()->flush();

    }

    protected function buildAssociatedNews(News $news, OldArticle $oldArticle)
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

        if ($oldArticle->getDisplayAsPortfolio()) {
            $this->isNewsImage = true;
        } else {
            $this->isNewsImage = false;
        }

        if ($oldArticle->getArticleTypeId() == static::TYPE_EDITO) {
            if ($oldArticle->getIsOnline()) {
                $this->status = TranslateChildInterface::STATUS_DEACTIVATED;
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


        if ($oldArticle->getArticleTypeId() == static::TYPE_TOO) {
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

        if ($oldArticle->getArticleTypeId() == static::TYPE_PHOTOPGRAH_EYE) {
            $this->status = TranslateChildInterface::STATUS_DEACTIVATED;
            return true;
        }
        return false;
    }

    /**
     * @param $oldArticleId
     * @return null
     */
    public function removeNews($oldArticleId)
    {
        $newsArticle = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsArticle')
            ->findOneBy(['oldNewsId' => $oldArticleId])
        ;
        if (!$newsArticle) {
            return null;
        }
        $fields = $this->getManager()->getClassMetadata('BaseCoreBundle:NewsArticle')->getAssociationNames();
        foreach ($newsArticle->getTranslations() as $translation) {
            $newsArticle->getTranslations()->removeElement($translation);
            $this->getManager()->remove($translation);
        }
        foreach ($newsArticle->getAssociatedNews() as $newsAssociated) {
            if ($newsAssociated instanceof NewsNewsAssociated) {
                $newsAssociated->setAssociation(null);
                $newsAssociated->setNews(null);
                $this->getManager()->remove($newsAssociated);
                $this->getManager()->flush();
                $newsArticle->removeAssociatedNew($newsAssociated);
            }
        }
        $newsNewsAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsNewsAssociated')
            ->findBy(['association' => $newsArticle->getId()])
        ;
        foreach ($newsNewsAssociations as $newsAssociated) {
            $newsAssociated->setAssociation(null);
            $newsAssociated->setNews(null);
            $this->getManager()->remove($newsAssociated);
            $this->getManager()->flush();
            $newsArticle->removeAssociatedNew($newsAssociated);
        }
        foreach ($fields as $field) {
            $association = $this
                ->getManager()
                ->getClassMetadata('BaseCoreBundle:NewsArticle')
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