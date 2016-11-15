<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoArticleTranslation;
use Base\CoreBundle\Entity\InfoFilmFilmAssociated;
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
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsFilmFilmAssociated;
use Base\CoreBundle\Entity\NewsWidgetAudio;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsWidgetVideo;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutube;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Base\CoreBundle\Entity\StatementArticle;
use Base\CoreBundle\Entity\StatementArticleTranslation;
use Base\CoreBundle\Entity\StatementFilmFilmAssociated;
use Base\CoreBundle\Entity\StatementWidgetAudio;
use Base\CoreBundle\Entity\StatementWidgetImage;
use Base\CoreBundle\Entity\StatementWidgetText;
use Base\CoreBundle\Entity\StatementWidgetTextTranslation;
use Base\CoreBundle\Entity\StatementWidgetVideo;
use Base\CoreBundle\Entity\StatementWidgetVideoYoutube;
use Base\CoreBundle\Entity\StatementWidgetVideoYoutubeTranslation;

class ArticleImporter extends Importer
{

    public function importStatements()
    {
        $this->output->writeln('<info>Import Statements...</info>');

        $oldArticles = $this->getManager()->getRepository('BaseCoreBundle:OldArticle')->findBy(array(
            'articleTypeId' => self::TYPE_COMMUNIQUE,
        ), array('id' => 'ASC'))
        ;

        $entitiesArray = array(
            'main_entity_parent'      => 'BaseCoreBundle:Statement',
            'main_entity'             => 'BaseCoreBundle:StatementArticle',
            'main'                    => new StatementArticle(),
            'main_trans'              => new StatementArticleTranslation(),
            'widget_text'             => new StatementWidgetText(),
            'widget_text_trans'       => new StatementWidgetTextTranslation(),
            'widget_yt'               => new StatementWidgetVideoYoutube(),
            'widget_yt_trans'         => new StatementWidgetVideoYoutubeTranslation(),
            'widget_yt_entity'        => 'StatementWidgetVideoYoutube',
            'widget_image'            => new StatementWidgetImage(),
            'widget_audio'            => new StatementWidgetAudio(),
            'widget_video'            => new StatementWidgetVideo(),
            'association_setter'      => 'addAssociatedStatement',
            'association'             => new StatementFilmFilmAssociated(),
            'association_film_setter' => 'setStatement',
            'acl_update'              => 'base.admin.statement_article',
        );
        $this->importLoop($oldArticles, $entitiesArray, 'isStatementMatching');

        return $this;
    }


    public function importInfos()
    {
        $this->output->writeln('<info>Import infos...</info>');

        $oldArticles = $this->getManager()->getRepository('BaseCoreBundle:OldArticle')->findBy(array(
            'articleTypeId' => self::TYPE_NEWS_FESTIVAL,
        ), array('id' => 'ASC'))
        ;

        $entitiesArray = array(
            'main_entity_parent'      => 'BaseCoreBundle:Info',
            'main_entity'             => 'BaseCoreBundle:InfoArticle',
            'main'                    => new InfoArticle(),
            'main_trans'              => new InfoArticleTranslation(),
            'widget_text'             => new InfoWidgetText(),
            'widget_text_trans'       => new InfoWidgetTextTranslation(),
            'widget_yt'               => new InfoWidgetVideoYoutube(),
            'widget_yt_trans'         => new InfoWidgetVideoYoutubeTranslation(),
            'widget_yt_entity'        => 'InfoWidgetVideoYoutube',
            'widget_image'            => new InfoWidgetImage(),
            'widget_audio'            => new InfoWidgetAudio(),
            'widget_video'            => new InfoWidgetVideo(),
            'association_setter'      => 'addAssociatedInfo',
            'association'             => new InfoFilmFilmAssociated(),
            'association_film_setter' => 'setInfo',
            'acl_update'              => 'base.admin.news_article',
        );

        $this->importLoop($oldArticles, $entitiesArray, 'isInfoMatching');

        return $this;
    }

    public function importNews()
    {
        $this->output->writeln('<info>Import news...</info>');

        $oldArticles = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->findBy(['articleTypeId' => static::TYPE_QUOTIDIEN], ['id' => 'asc'], 1)
        ;

        $entitiesArray = array(
            'main_entity_parent'      => 'BaseCoreBundle:News',
            'main_entity'             => 'BaseCoreBundle:NewsArticle',
            'main'                    => new NewsArticle(),
            'main_trans'              => new NewsArticleTranslation(),
            'widget_text'             => new NewsWidgetText(),
            'widget_text_trans'       => new NewsWidgetTextTranslation(),
            'widget_yt'               => new NewsWidgetVideoYoutube(),
            'widget_yt_entity'        => 'NewsWidgetVideoYoutube',
            'widget_yt_trans'         => new NewsWidgetVideoYoutubeTranslation(),
            'widget_image'            => new NewsWidgetImage(),
            'widget_audio'            => new NewsWidgetAudio(),
            'widget_video'            => new NewsWidgetVideo(),
            'association_setter'      => 'addAssociatedNews',
            'association'             => new NewsFilmFilmAssociated(),
            'association_film_setter' => 'setNews',
            'acl_update'              => 'base.admin.info_article',
        );


        $this->importLoop($oldArticles, $entitiesArray, 'isNewsMatching');

        return $this;
    }

    /**
     * @param OldArticle[] $oldArticles
     * @param array $entitiesArray
     * @param string $getterMatching
     */
    private function importLoop($oldArticles, $entitiesArray, $getterMatching)
    {
        $mapperFields = array(
            'resume' => 'introduction',
        );

        $totalSaved = 0;
        $optionAssociatedNews = $this->input->getOption('associated-news');
        $optionCount = $this->input->getOption('count');
        $onlyCreate = $this->input->getOption('only-create');

        $siteFDCCorporate = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:Site')
            ->findOneBy(['slug' => 'site-institutionnel'])
        ;

        $siteFDCEvent = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:Site')
            ->findOneBy(['slug' => 'site-evenementiel'])
        ;

        $entities = array();
        $oldArticlesTotal = count($oldArticles);

        foreach ($oldArticles as $oldArticleKey => $oldArticle) {
            $this->output->writeln('<comment>#' . $oldArticle->getId() . ' - ' . ($oldArticleKey + 1) . '/' . $oldArticlesTotal . '</comment>');
            $oldArticleTranslations = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldArticleI18n')
                ->findBy(['id' => $oldArticle->getId()])
            ;
            // has french translation
            $hasFrenchTranslation = $this->hasFrenchTranslation($oldArticleTranslations);
            if ($hasFrenchTranslation == false) {
                continue;
            }

            // is valid matching
            $this->output->writeln('<comment>#' . $oldArticle->getId() . ' verify matching.</comment>');

            $matching = $this->{$getterMatching}($oldArticle, $oldArticleTranslations);
            if ($matching == false || $optionCount == true) {
                continue;
            }

            $this->output->writeln('<info>#' . $oldArticle->getId() . ' is matching.</info>');

            // old news
            $news = $this
                ->getManager()
                ->getRepository($entitiesArray['main_entity'])
                ->findOneBy(['oldNewsId' => $oldArticle->getId()])
            ;
            if ($onlyCreate == true && $news != null) {
                continue;
            }
            // set values
            if ($news == null) {
                $news = clone $entitiesArray['main'];
                $this->getManager()->persist($news);
            }

            if ($news instanceof Info) {
                $news->setHideSameDay(false);
            }
            $news->setOldNewsTable('OldNews');
            $news->setOldNewsId($oldArticle->getId());
            $news->setPublishedAt($oldArticle->getStartDate() ?: $oldArticle->getUpdatedAt());
            $news->setCreatedAt($oldArticle->getUpdatedAt());
            $news->setUpdatedAt($oldArticle->getCreatedAt());
            $news->setIsPublishedOnFdcEvent(1);
            if ($this->doNotPublish === false) {
                if (!$news->getSites()->contains($siteFDCCorporate)) {
                    $news->addSite($siteFDCCorporate);
                }
                if (!$news->getSites()->contains($siteFDCEvent)) {
                    $news->addSite($siteFDCEvent);
                }
            }

            $festival = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:FilmFestival')
                ->findOneBy(['year' => $oldArticle->getCreatedAt()->format('Y')])
            ;
            $news->setFestival($festival);

            //$this->getManager()->persist($news);
            //$this->getManager()->flush();

            // loop translations
            foreach ($oldArticleTranslations as $oldArticleTranslation) {
                $culture = ($oldArticleTranslation->getCulture() == 'cn') ? 'zh' : $oldArticleTranslation->getCulture();
                if (in_array($culture, $this->langs)) {
                    if ($optionAssociatedNews == false) {
                        $this->output->writeln('<comment>add Translation ' . $culture . '</comment>');
                        $newsTrans = $news->findTranslationByLocale($culture);
                        if (!$newsTrans) {
                            dump('new');
                            $newsTrans = clone $entitiesArray['main_trans'];
                            $newsTrans->setLocale($culture);
                            $newsTrans->setCreatedAt($news->getCreatedAt());
                            $newsTrans->setUpdatedAt($news->getCreatedAt());
                            $newsTrans->setIsPublishedOnFDCEvent(true);
                            $newsTrans->setTranslatable($news);
                            $news->addTranslation($newsTrans);
                            $this->getManager()->persist($newsTrans);;

                            if ($culture == 'fr') {
                                $newsTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                            } else {
                                $newsTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                            }
                        }

                        $newsTrans->setTitle(strip_tags($oldArticleTranslation->getTitle()));
                        foreach ($mapperFields as $oldField => $field) {
                            $newsTrans->{'set' . ucfirst($field)}($oldArticleTranslation->{'get' . ucfirst($oldField)}());
                        }

                        // Image header / image accroche
                        if ($news->getHeader()) {
                            $img = $news->getHeader();
                        } else {
                            $img = new MediaImage();
                        }
                        if ($img->getSites()->count() == 0) {
                            $img->addSite($siteFDCCorporate);
                        }
                        $news->setHeader($img);
                        if ($img != null) {
                            if ($img->findTranslationByLocale($culture) && $img->findTranslationByLocale($culture)->getFile()) {
                                $media = $img->findTranslationByLocale($culture)->getFile();
                            } else {
                                $media = new Media();
                            }
                        } else {
                            $media = new Media();
                        }
                        if ($media->getId() == null && $oldArticleTranslation->getImageResume()) {
                            $url = 'http://www.festival-cannes.fr/assets/Image/Pages/' . $oldArticleTranslation->getImageResume();
                            $file = $this->imagecreatefromfile($url, $this->output);
                            $media->setContentType('image/jpeg');
                            $media->setName($oldArticleTranslation->getImageResume());
                            $media->setBinaryContent($file);
                            $media->setEnabled(true);
                            $media->setProviderReference($oldArticleTranslation->getImageResume());
                            $media->setContext('media_image');
                            $media->setProviderStatus(1);
                            $media->setProviderName('sonata.media.provider.image');
                            $this->getMediaManager()->save($media, 'media_image', 'sonata.media.provider.image');
                        }
                        $imgTrans = $img->findTranslationByLocale($culture);

                        if (!$imgTrans) {
                            $imgTrans = new MediaImageTranslation();
                            $img->addTranslation($imgTrans);
                        }
                        if ($culture == 'fr') {
                            $imgTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                        } else {
                            $imgTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                        }
                        $imgTrans->setTranslatable($img);
                        $imgTitle = array(
                            'fr' => 'photo',
                            'en' => 'photo',
                            'es' => 'foto',
                            'zh' => '照片',
                        );
                        $imgTrans->setLegend(($oldArticleTranslation->getTitleImageResume() != null) ? $oldArticleTranslation->getTitleImageResume() : $imgTitle[$culture]);
                        $imgTrans->setLocale($culture);
                        $imgTrans->setisPublishedOnFDCEvent(1);
                        if ($oldArticleTranslation->getImageResume()) {
                            $imgTrans->setFile($media);
                        }
                        if ($img->findTranslationBylocale($culture) == null) {
                            $img->addTranslation($imgTrans);
                        }

                        // widget text / annonce
                        $widgetCount = 0;
                        if ($oldArticleTranslation->getBody() != null) {
                            $widgetCount++;
                            if ($news->getWidgets()->count() == 0) {
                                $widgetText = clone $entitiesArray['widget_text'];
                                $widgetText->setPosition($widgetCount);
                            } else {
                                $widgets = $news->getWidgets();
                                foreach ($widgets as $widgetTemp) {
                                    if ($widgetTemp instanceof NewsWidgetText) {
                                        $widgetText = $widgetTemp;
                                    }
                                }
                            }

                            if (isset($widgetText) && $widgetText) {
                                $widgetTextTranslation = clone $entitiesArray['widget_text_trans'];
                                if ($widgetText->findTranslationByLocale($culture) != null) {
                                    $widgetTextTranslation = $widgetText->findTranslationByLocale($culture);
                                }
                                $widgetTextTranslation->setLocale($culture);
                                $widgetTextTranslation->setContent($oldArticleTranslation->getBody());
                                $widgetTextTranslation->setTranslatable($widgetText);
                                $widgetText->addTranslation($widgetTextTranslation);

                                if ($widgetText->getId() == null) {
                                    $news->addWidget($widgetText);
                                }
                            }
                        }

                        // widget video youtube / youtube link / description
                        if ($oldArticleTranslation->getYoutubeLink() != null ||
                            $oldArticleTranslation->getYoutubeLinkDescription() != null
                        ) {
                            $widgetCount++;
                            $widgetVideoYoutube = $this->getWidget($news, $widgetCount, clone $entitiesArray['widget_yt_entity']);
                            $widgetVideoYoutube->setPosition($widgetCount);

                            $widgetVideoYoutubeTranslation = clone $entitiesArray['widget_yt_trans'];
                            if ($widgetVideoYoutube->findTranslationByLocale($culture) != null) {
                                $widgetVideoYoutubeTranslation = $widgetVideoYoutube->findTranslationByLocale($culture);
                            }

                            $widgetVideoYoutubeTranslation->setLocale($culture);
                            $widgetVideoYoutubeTranslation->setUrl($oldArticleTranslation->getYoutubeLink());
                            $widgetVideoYoutubeTranslation->setTitle($oldArticleTranslation->getYoutubeLinkDescription());
                            $widgetVideoYoutubeTranslation->setTranslatable($widgetVideoYoutube);
                            if ($widgetVideoYoutube->getId() == null) {
                                $news->addWidget($widgetVideoYoutube);
                            }
                        }

                        // widget photo / association image
                        $oldArticleAssociations = $this->getManager()->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                            'id'          => $oldArticle->getId(),
                            'objectClass' => 'Image',
                        ), array('order' => 'ASC'))
                        ;
                        if (count($oldArticleAssociations) > 0) {
                            $widgetCount++;
                            $widget = $this->getWidget($news, $widgetCount, clone $entitiesArray['widget_image']);
                            $widget->setPosition($widgetCount);
                            if (!$widget->getGallery()) {
                                $gallery = new Gallery();
                                $widget->setGallery($gallery);
                                $gallery->setDisplayedHomeCorpo(false);
                            } else {
                                $gallery = $widget->getGallery();
                            }
                            $gallery->setName('Galerie');
                            if ($culture == 'fr') {
                                $gallery->setName($oldArticleTranslation->getMosaiqueTitle());
                            }
                            foreach ($oldArticleAssociations as $associationKey => $association) {
                                $image = $this->getManager()->getRepository('BaseCoreBundle:OldMedia')->findOneById($association->getObjectId());
                                $img = null;
                                if ($gallery->getMedias()) {
                                    foreach ($gallery->getMedias() as $media) {
                                        if ($media->getMedia()->getOldId() == $association->getObjectId()) {
                                            $img = $gallery->getMedias()->get($associationKey)->getMedia();
                                        }
                                    }
                                }
                                if (!$img) {
                                    $img = new MediaImage();
                                }
                                if ($img != null) {
                                    $media = ($img->findTranslationByLocale($culture) != null && $img->findTranslationByLocale($culture)->getFile() != null) ? $img->findTranslationByLocale('fr')->getFile() : new Media();
                                } else {
                                    $media = new Media();
                                }
                                if ($img->getSites()->count() == 0) {
                                    $img->addSite($siteFDCCorporate);
                                }
                                $img->setOldMediaId($association->getObjectId());
                                $saved = false;
                                if ($media->getId() == null && $culture == 'fr') {
                                    $file = $this->imagecreatefromfile('http://www.festival-cannes.fr/assets/Image/General/' . trim($image->getFilename()));
                                    $media->setName($image->getFilename());
                                    $media->setBinaryContent($file);
                                    $media->setEnabled(true);
                                    $media->setProviderReference($image->getFilename());
                                    $media->setContext('media_image');
                                    $media->setProviderStatus(1);
                                    $media->setProviderName('sonata.media.provider.image');
                                    $this->getMediaManager()->save($media, 'media_image', 'sonata.media.provider.image');
                                    $saved = true;
                                }
                                $imgTrans = $img->findTranslationByLocale($culture);
                                $oldMediaTrans = $this->getManager()->getRepository('BaseCoreBundle:OldMediaI18n')->findOneBy(array(
                                    'id'      => $association->getObjectId(),
                                    'culture' => $oldArticleTranslation->getCulture(),
                                ))
                                ;

                                if ($oldMediaTrans) {

                                    if (!$imgTrans) {
                                        $imgTrans = new MediaImageTranslation();
                                        $img->addTranslation($imgTrans);
                                    }
                                    if ($culture == 'fr') {
                                        $imgTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                                    } else {
                                        $imgTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                                    }
                                    if ($saved == true) {
                                        $imgTrans->setFile($media);
                                    }
                                    $imgTrans->setTranslatable($img);
                                    $imgTitle = array(
                                        'fr' => 'photo',
                                        'en' => 'photo',
                                        'es' => 'foto',
                                        'zh' => '照片',
                                    );
                                    $imgTrans->setLegend(($oldMediaTrans->getLabel() != null) ? $oldMediaTrans->getLabel() : $imgTitle[$culture]);
                                    $imgTrans->setCopyright($oldMediaTrans->getCopyright());
                                    $imgTrans->setLocale($culture);
                                    $imgTrans->setisPublishedOnFDCEvent(1);
                                    if ($gallery->getMedias()->count() != count($oldArticleAssociations)) {
                                        $galleryMedia = new GalleryMedia();
                                        $galleryMedia->setGallery($gallery);
                                        $galleryMedia->setMedia($img);
                                        $galleryMedia->setPosition($associationKey + 1);
                                        $gallery->addMedia($galleryMedia);
                                    }
                                }
                            }
                            if ($widget->getId() == null) {
                                $news->addWidget($widget);
                            }
                        }

                        // association audios
                        $oldArticleAssociations = $this->getManager()->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                            'id'          => $oldArticle->getId(),
                            'objectClass' => 'Audio',
                        ), array('order' => 'asc'))
                        ;
                        if (count($oldArticleAssociations) > 0) {
                            $this->output->writeln('Import associated audios');
                            foreach ($oldArticleAssociations as $associationKey => $association) {
                                $widgetCount++;
                                $widget = $this->getWidget($news, $widgetCount, clone $entitiesArray['widget_audio']);
                                $widget->setPosition($widgetCount);

                                if (method_exists($widget, 'getFile')  && $widget->getFile() != null) {
                                    $audio = $widget->getFile();
                                } else {
                                    $audio = new MediaAudio();
                                    $widget->setFile($audio);
                                    $this->getManager()->persist($audio);
                                }
                                $audio->setOldMediaId($association->getObjectId());

                                $oldAudioAssciations = $this->getManager()->getRepository('BaseCoreBundle:OldMediaI18n')->findBy(array(
                                    'id'      => $association->getObjectId(),
                                    'culture' => $culture,
                                ))
                                ;

                                foreach ($oldAudioAssciations as $oldAudio) {
                                    $audioTrans = new MediaAudioTranslation();
                                    if ($audio->findTranslationByLocale($culture) != null) {
                                        $audioTrans = $audio->findTranslationByLocale($culture);
                                    } else {
                                        $audio->addTranslation($audioTrans);
                                    }
                                    $audioTrans->setLocale($culture);
                                    $audioTrans->setTranslatable($audio);
                                    $audioTitle = array(
                                        'fr' => 'audio',
                                        'en' => 'audio',
                                        'es' => 'audio',
                                        'zh' => '音频',
                                    );
                                    $audioTrans->setTitle(($oldAudio->getLabel() != null) ? $oldAudio->getLabel() : $audioTitle[$culture]);
                                    $audioTrans->setJobMp3State(MediaAudioTranslation::ENCODING_STATE_READY);
                                    if ($audioTrans->getFile() == null) {
                                        $media = new Media();
                                    } else {
                                        $media = $audioTrans->getFile();
                                    }
                                    $code = $oldAudio->getCode();
                                    $audioPath = 'http://www.festival-cannes.fr/mp3/' . trim($code) . '.mp3';
                                    if ($oldAudio->getCode() == null) {
                                        $oldAudioBi = $this->getManager()->getRepository('BaseCoreBundle:OldMediaI18n')->findOneBy(array(
                                            'id'      => $association->getObjectId(),
                                            'culture' => 'bi',
                                        ))
                                        ;
                                        if ($oldAudioBi != null && $oldAudioBi->getCode() != null) {
                                            $code = $oldAudioBi->getCode();
                                            $audioPath = 'http://www.festival-cannes.fr/mp3/' . trim($code) . '.mp3';
                                        }

                                        if ($code == null && $oldAudio->getHdFormatFilename() != null) {
                                            $code = $oldAudio->getHdFormatFilename();
                                            $audioPath = 'http://www.festival-cannes.fr/' . trim($code);
                                        }

                                        if ($code == null) {
                                            $this->output->writeln("<error>No path for audio found for OldMediaI18n #{$association->getObjectId()}</error>");
                                            continue;
                                        }
                                    }
                                    if ($code != null) {
                                        $file = $this->createAudio($audioPath, $this->output);
                                        if ($file == null) {
                                            break;
                                        }
                                        $media->setName($oldAudio->getLabel());
                                        $media->setBinaryContent($file);
                                        $media->setEnabled(true);
                                        $media->setProviderReference($oldAudio->getLabel());
                                        $media->setContext('media_audio');
                                        $media->setProviderStatus(1);
                                        $media->setProviderName('sonata.media.provider.audio');
                                        if ($media->getId() == null) {
                                            $this->getMediaManager()->save($media, 'media_audio', 'sonata.media.provider.audio');
                                        }
                                        $audioTrans->setFile($media);
                                        $audioTrans->setTitle($oldAudio->getLabel());
                                        $audioTrans->setJobMp3State(MediaAudioTranslation::ENCODING_STATE_READY);
                                    } else {
                                        $this->output->writeln("<error>Audio code not found for Object id #{$association->getObjectId()}</error>");
                                    }
                                    $this->getManager()->flush();
                                }
                                if ($widget->getId() == null) {
                                    $news->addWidget($widget);
                                }
                            }
                        }

                        // association videos
                        $oldArticleAssociations = $this->getManager()->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                            'id'          => $oldArticle->getId(),
                            'objectClass' => 'Video',
                        ), array('order' => 'asc'))
                        ;
                        if (count($oldArticleAssociations) > 0) {
                            $this->output->writeln('Import associated videos');
                            foreach ($oldArticleAssociations as $associationKey => $association) {
                                $this->output->writeln('old video association');
                                $widgetCount++;
                                $widget = $this->getWidget($news, $widgetCount, clone $entitiesArray['widget_video']);
                                $widget->setPosition($widgetCount);

                                if ($widget->getFile() != null) {
                                    $video = $widget->getFile();
                                    $video->setDisplayedHomeCorpo(false);
                                } else {
                                    $video = new MediaVideo();
                                    $video->setDisplayedHomeCorpo(false);
                                    $widget->setFile($video);
                                    $this->getManager()->persist($video);
                                }
                                $video->setOldMediaId($association->getObjectId());

                                $oldVideoAssociations = $this->getManager()->getRepository('BaseCoreBundle:OldMediaI18n')->findBy(array(
                                    'id'      => $association->getObjectId(),
                                    'culture' => $culture,
                                ))
                                ;

                                foreach ($oldVideoAssociations as $oldVideo) {
                                    $this->output->writeln("old video translation for {$culture}");
                                    $videoTrans = new MediaVideoTranslation();
                                    if ($video->findTranslationByLocale($culture) != null) {
                                        $videoTrans = $video->findTranslationByLocale($culture);
                                    } else {
                                        $video->addTranslation($videoTrans);
                                    }
                                    $videoTrans->setLocale($culture);
                                    $videoTrans->setTranslatable($video);
                                    $videoTrans->setJobMp4State(MediaVideoTranslation::ENCODING_STATE_READY);
                                    $videoTrans->setJobWebmState(MediaVideoTranslation::ENCODING_STATE_READY);
                                    $videoTitle = array(
                                        'fr' => 'video',
                                        'en' => 'video',
                                        'es' => 'video',
                                        'zh' => '视频',
                                    );
                                    $videoTrans->setTitle(($oldVideo->getLabel() != null) ? $oldVideo->getLabel() : $videoTitle[$culture]);
                                    if ($videoTrans->getFile() == null) {
                                        $media = new Media();
                                    } else {
                                        $media = $videoTrans->getFile();
                                    }
                                    if ($oldVideo->getDeliveryUrl() == null) {
                                        $this->output->writeln("<error>Delivery url is null for old video #{$oldVideo->getId()}</error>");
                                        continue;
                                    }
                                    $path = $oldVideo->getDeliveryUrl();
                                    $this->output->writeln('Video delivery url: ' . $path);
                                    $pathArray = explode(',', $path);
                                    $path = $pathArray[0] . '80' . $pathArray[count($pathArray) - 1];
                                    $this->output->writeln('before create video');
                                    $file = $this->createVideo('http://canneshd-a.akamaihd.net/' . trim($path), $this->output);
                                    if ($file == null) {
                                        break;
                                    }
                                    $media->setName($oldVideo->getLabel());
                                    $media->setBinaryContent($file);
                                    $media->setEnabled(true);
                                    $media->setProviderReference($oldVideo->getLabel());
                                    $media->setContext('media_video');
                                    $media->setProviderStatus(1);
                                    $media->setProviderName('sonata.media.provider.video');
                                    if ($media->getId() == null) {
                                        $this->getMediaManager()->save($media);
                                    }
                                    $videoTrans->setFile($media);
                                    // must be set to avoid duplicate constraint
                                    $this->getManager()->flush();
                                }
                                if ($widget->getId() == null) {
                                    $news->addWidget($widget);
                                }
                            }
                        }

                        // association film
                        $oldArticleAssociations = $this->getManager()->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                            'id'          => $oldArticle->getId(),
                            'objectClass' => 'Film',
                        ), array('order' => 'asc'))
                        ;

                        if (count($oldArticleAssociations) > 0) {
                            $this->output->writeln('Import associated films');
                            foreach ($oldArticleAssociations as $association) {
                                $filmFilm = $this->getManager()->getRepository('BaseCoreBundle:FilmFilm')->findOneById($association->getObjectId());
                                if ($filmFilm == null) {
                                    $this->output->writeln("<error>Film #{$association->getObjectId()} not found</error>");
                                } else {
                                    if ($news->getAssociatedFilm() == null) {
                                        $news->setAssociatedFilm($filmFilm);
                                    }
                                    $found = false;
                                    foreach ($news->getAssociatedFilms() as $associated) {
                                        if ($associated->getAssociation()->getId() == $filmFilm->getId()) {
                                            $found = true;
                                        }
                                    }
                                    if ($found == false) {
                                        $associated = clone $entitiesArray['association'];
                                        $associated->{$entitiesArray['association_film_setter']}($news);
                                        $associated->setAssociation($filmFilm);
                                        $news->addAssociatedFilm($associated);
                                    }
                                }
                            }
                        }
                    }

                    // association articles
                    $oldArticleAssociations = $this->getManager()->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                        'id'          => $oldArticle->getId(),
                        'objectClass' => 'Article',
                    ), array('order' => 'asc'))
                    ;

                    if (count($oldArticleAssociations) > 0) {
                        $this->output->writeln('Import associated articles');
                        foreach ($oldArticleAssociations as $association) {
                            $oldNewsId = $association->getObjectId();
                            $associationNews = $this->getManager()->getRepository($entitiesArray['main_entity_parent'])->findOneByOldNewsId($oldNewsId);
                            if ($associationNews !== null) {
                                if ($news->contains($associationNews) == false) {
                                    $news->{$entitiesArray['association_setter']}($associationNews);
                                }
                            }
                        }
                    }
                    // must be set to avoid widgets duplication
                    $this->output->writeln("Saving lang: {$culture} of #{$oldArticle->getId()}");
                    $this->getManager()->flush();

                    dump($newsTrans->getId());
                }
            }

            if ($news->getId() == null) {
                $this->getManager()->persist($news);
            }
            $entities[] = $news;
            $this->output->writeln('<info>To be saved...</info>');
            $totalSaved++;

            //if ($totalSaved % 100 == 0) {
            $this->output->writeln('<info>Saved !</info>');
            dump(str_repeat('-', 100));
            $this->getManager()->flush();
            $this->updateAcl($entities, $entitiesArray['acl_update'], $this->output);
            $entities = array();
            //}
        }

        if ($optionCount) {
            dump($this->entitiesCount);
        } else {
            $this->output->writeln('<info>Total saved: ' . $totalSaved . '</info>');
            $this->getManager()->flush();
            $this->updateAcl($entities, $entitiesArray['acl_update'], $this->output);
        }
    }

    /**
     * @param OldArticleI18n[] $oldArticleTranslations
     * @return bool
     */
    private function hasFrenchTranslation($oldArticleTranslations)
    {
        foreach ($oldArticleTranslations as $trans) {
            if ($trans->getCulture() == 'fr') {
                return true;
            }
        }

        $this->output->writeln('<error>Doesn\'t have french translation</error>');
        return false;
    }

    /**
     * @param OldArticle $oldArticle
     * @param OldArticleI18n[] $oldArticleTranslations
     * @return bool
     */
    protected function isNewsMatching(OldArticle $oldArticle, $oldArticleTranslations)
    {
        $optionCount = $this->input->getOption('count');
        $this->doNotPublish = false;

        // case one
        // Communiqués-Festival de 2001 > 2006
        $condIsAvailable = $oldArticle->getIsOnline() && $oldArticle->getCreatedAt();
        $condIsAvailable = $condIsAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2001;
        $condIsAvailable = $condIsAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2006;
        if ($condIsAvailable) {
            $this->updateCount(__FUNCTION__, 1);
            if ($optionCount == false) {
                return true;
            }
        }

        // case two
        // Quotidien 2007 > 2015 - Articles Conférence de presse (films / jurys / lauréats)
        // "conférence" dans le titre + film associé
        $isAvailable = $oldArticle->getIsOnline() && $oldArticle->getCreatedAt();
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2007;
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2015;
        if ($isAvailable) {
            $hasConference = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'conference') !== false)) {
                    $hasConference = true;
                }
            }

            if ($hasConference == true) {
                $oldArticleAssociations = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:OldArticleAssociation')
                    ->findOneBy(['id' => $oldArticle->getId(), 'objectClass' => 'Film'])
                ;

                if (count($oldArticleAssociations) > 0) {
                    $this->updateCount(__FUNCTION__, 2);
                    if ($optionCount == false) {
                        return true;
                    }
                }
            }
        }
    }

    protected function isStatementMatching(OldArticle $oldArticle)
    {
        $optionCount = $this->input->getOption('count');

        // Communiqués-Festival de 2001 > 2015
        $isAvailable = $oldArticle->getIsOnline() && $oldArticle->getCreatedAt();
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2001;
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2015;
        if ($isAvailable) {
            $this->updateCount(__FUNCTION__, 1);
            if ($optionCount == false) {
                return true;
            }
        }
    }

    protected function isInfoMatching(OldArticle $oldArticle)
    {
        $optionCount = $this->input->getOption('count');

        // Actualités-Festival de 2010 > 2015
        $isAvailable = $oldArticle->getIsOnline() && $oldArticle->getCreatedAt();
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') >= 2010;
        $isAvailable = $isAvailable && $oldArticle->getCreatedAt()->format('Y') <= 2015;
        if ($isAvailable) {
            $this->updateCount(__FUNCTION__, 1);
            if ($optionCount == false) {
                return true;
            }
        }
    }
}