<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetFile;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetImage;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetTextTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ContentTemplateManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getPageData($routeName) {
        $pageType = '';
        $isWhoAreWe = false;
        $nextRoute = null;
        $backRoute = null;
        switch ($routeName) {
            case 'fdc_marche_du_film_edition_presentation':
                $pageType = MdfContentTemplate::TYPE_EDITION_PRESENTATION;
                break;
            case 'fdc_marche_du_film_edition_projections':
                $pageType = MdfContentTemplate::TYPE_EDITION_PROJECTIONS;
                break;
            case 'fdc_marche_du_film_industry_program_home':
                $pageType = MdfContentTemplate::TYPE_INDUSTRY_PROGRAM_HOME;
                break;
            case 'fdc_marche_du_film_who_are_we_history':
                $pageType = MdfContentTemplate::TYPE_WHO_ARE_WE_HISTORY;
                $isWhoAreWe = true;
                break;
            case 'fdc_marche_du_film_who_are_we_key_figures':
                $pageType = MdfContentTemplate::TYPE_WHO_ARE_WE_KEY_FIGURES;
                $isWhoAreWe = true;
                break;
            case 'fdc_marche_du_film_who_are_we_environmental_approaches':
                $pageType = MdfContentTemplate::TYPE_WHO_ARE_WE_ENVIRONMENTAL_APPROACHES;
                $isWhoAreWe = true;
                break;
            case 'fdc_marche_du_film_legal_mentions':
                $pageType = MdfContentTemplate::TYPE_LEGAL_MENTIONS;
                break;
            case 'fdc_marche_du_film_general_conditions':
                $pageType = MdfContentTemplate::TYPE_GENERAL_CONDITIONS;
                break;
        }

        $titleHeader = $this->getTitleHeaderContent($pageType);
        $textWidgets = $this->getContentTemplateTextWidgets($pageType);
        $imageWidgets = $this->getContentTemplateImageWidgets($pageType);
        $galleryWidgets = $this->getContentTemplateGalleryWidgets($pageType);
        $fileWidgets = $this->getContentTemplateFileWidgets($pageType);

        $widgets = [];
        $widgets = array_merge($widgets, $textWidgets, $imageWidgets, $galleryWidgets, $fileWidgets);

        usort($widgets, function($a, $b)
        {
            if (property_exists($a, 'translatable') && property_exists($b, 'translatable')) {
                return strcmp($a->getTranslatable()->getPosition(), $b->getTranslatable()->getPosition());
            } else if (property_exists($a, 'translatable') && !property_exists($b, 'translatable')) {
                return strcmp($a->getTranslatable()->getPosition(), $b->getPosition());
            } else if (!property_exists($a, 'translatable') && property_exists($b, 'translatable')) {
                return strcmp($a->getPosition(), $b->getTranslatable()->getPosition());
            } else if (!property_exists($a, 'translatable') && !property_exists($b, 'translatable')) {
                return strcmp($a->getPosition(), $b->getPosition());
            }
        });

        return array(
            'titleHeader' => $titleHeader,
            'widgets' => $widgets,
            'isWhoAreWe' => $isWhoAreWe,
            'nextRoute' => $nextRoute,
            'backRoute' => $backRoute
        );
    }

    public function getTitleHeaderContent($pageType) {
        return $this->em
            ->getRepository(MdfContentTemplateTranslation::class)
            ->getTitleHeaderByLocaleAndType($this->requestStack->getMasterRequest()->get('_locale'), $pageType);
    }

    public function getContentTemplateTextWidgets($pageType) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetTextTranslation::class)
            ->getTextWidgetsByLocaleAndPageType($this->requestStack->getMasterRequest()->get('_locale'), $pageType);
    }

    public function getContentTemplateImageWidgets($pageType) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetImage::class)
            ->getImageWidgetsByPageType($pageType);
    }

    public function getContentTemplateGalleryWidgets($pageType) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetGallery::class)
            ->getGalleryWidgetsByPageType($pageType);
    }

    public function getContentTemplateFileWidgets($pageType) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetFile::class)
            ->getFileWidgetsByPageType($pageType);
    }

    public function getTitleHeaderContentBySlug($pageType, $slug) {
        return $this->em
            ->getRepository(MdfContentTemplateTranslation::class)
            ->getTitleHeaderByLocaleAndTypeAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $pageType, $slug);
    }

    public function getContentTemplateTextWidgetsByPageId($pageId) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetTextTranslation::class)
            ->getTextWidgetsByLocaleAndPageId($this->requestStack->getMasterRequest()->get('_locale'), $pageId);
    }

    public function getContentTemplateImageWidgetsByPageId($pageId) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetImage::class)
            ->getImageWidgetsByPageId($pageId);
    }

    public function getContentTemplateGalleryWidgetsByPageId($pageId) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetGallery::class)
            ->getGalleryWidgetsByPageId($pageId);
    }

    public function getContentTemplateFileWidgetsByPageId($pageId) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetFile::class)
            ->getFileWidgetsByPageId($pageId);
    }

    public function getHomepageNews($pageType) {
        return $this->em
            ->getRepository(MdfContentTemplateTranslation::class)
            ->getHomepageNewsByLocaleAndType(
                $this->requestStack->getMasterRequest()->get('_locale'),
                $pageType
            );
    }
}
