<?php

namespace Base\CoreBundle\OldImport;

use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutube;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;

class NewsImporter extends Importer
{
    protected $widgetPosition = 0;

    public function importNews()
    {
        $this->output->writeln('<info>Import news...</info>');

        $oldArticles = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticle')
            ->findBy(['articleTypeId' => static::TYPE_QUOTIDIEN], ['id' => 'asc'], 10)
        ;

        foreach ($oldArticles as $oldArticle) {
            $news = $this->importItem($oldArticle);
            dump($news->getId());
            foreach ($this->langs as $lang) {
                $translation = $news->findTranslationByLocale($lang);
                if ($translation) {
                    dump($translation->getLocale() . ' : ' . $translation->getId());
                }
            }
        }

        return $this;
    }

    /**
     * @param OldArticle $oldArticle
     * @return NewsArticle
     */
    protected function importItem(OldArticle $oldArticle)
    {
        $news = $this->buildNewsArticle($oldArticle);

        $oldTranslations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleI18n')
            ->findBy(['id' => $oldArticle->getId()])
        ;

        foreach ($oldTranslations as $oldTranslation) {
            $translation = $this->buildNewsArticleTranslation($news, $oldTranslation);
            if ($translation) {
                $this->buildNewsWidgetText($news, $translation, $oldTranslation);
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

    protected function getWidgetPosition()
    {
        return $this->widgetPosition++;
    }
}