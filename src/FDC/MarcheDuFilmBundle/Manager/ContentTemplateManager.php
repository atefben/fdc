<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetFile;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetImage;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetTextTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetVideoTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ContentTemplateManager
{
    protected $em;

    protected $requestStack;

    protected $contactManager;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack, ContactManager $contactManager)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
        $this->contactManager = $contactManager;
    }

    public function getPageData($routeName) {
        $pageType = '';
        $isWhoAreWe = false;
        $isPresentation = false;
        $nextRoute = null;
        $nextRouteLabel = null;
        $backRoute = null;
        $backRouteLabel = null;
        $isConference = null;
        switch ($routeName) {
            case 'fdc_marche_du_film_edition_presentation':
                $pageType = MdfContentTemplate::TYPE_EDITION_PRESENTATION;
                $isPresentation = true;
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
                $nextRoute = 'fdc_marche_du_film_who_are_we_environmental_approaches';
                $nextRouteLabel = 'demarches environnementales';
                break;
            case 'fdc_marche_du_film_who_are_we_environmental_approaches':
                $pageType = MdfContentTemplate::TYPE_WHO_ARE_WE_ENVIRONMENTAL_APPROACHES;
                $isWhoAreWe = true;
                $backRoute = 'fdc_marche_du_film_who_are_we_key_figures';
                $backRouteLabel = 'chiffres cles';
                break;
            case 'fdc_marche_du_film_legal_mentions':
                $pageType = MdfContentTemplate::TYPE_LEGAL_MENTIONS;
                break;
            case 'fdc_marche_du_film_general_conditions':
                $pageType = MdfContentTemplate::TYPE_GENERAL_CONDITIONS;
                break;
            case 'producers-workshop':
                $pageType = MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP;
                $isConference = true;
                break;
            case 'producers-network':
                $pageType = MdfConferenceProgram::TYPE_PRODUCERS_NETWORK;
                $isConference = true;
                break;
            case 'doc-corner':
                $pageType = MdfConferenceProgram::TYPE_DOC_CORNER;
                $isConference = true;
                break;
            case 'next':
                $pageType = MdfConferenceProgram::TYPE_NEXT;
                $isConference = true;
                break;
            case 'mixers':
                $pageType = MdfConferenceProgram::TYPE_MIXERS;
                $isConference = true;
                break;
            case 'goes-to-cannes':
                $pageType = MdfConferenceProgram::TYPE_GOES_TO_CANNES;
                $isConference = true;
                break;
        }

        $titleHeader = $this->getTitleHeaderContent($pageType);
        $pageId = $titleHeader->getTranslatable()->getId();

        $textWidgets = $this->getContentTemplateTextWidgets($pageType);
        $imageWidgets = $this->getContentTemplateImageWidgets($pageType);
        $galleryWidgets = $this->getContentTemplateGalleryWidgets($pageType);
        $fileWidgets = $this->getContentTemplateFileWidgets($pageType);
        $videoWidgets = $this->getContentTemplateVideosByPageId($pageId);

        $widgets = [];
        $widgets = array_merge($widgets, $textWidgets, $imageWidgets, $galleryWidgets, $fileWidgets, $videoWidgets);

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

        $contact = $this->contactManager->getContactInfo();

        return array(
            'titleHeader' => $titleHeader,
            'widgets' => $widgets,
            'isWhoAreWe' => $isWhoAreWe,
            'nextRoute' => $nextRoute,
            'nextRouteLabel' => $nextRouteLabel,
            'backRoute' => $backRoute,
            'backRouteLabel' => $backRouteLabel,
            'isPresentation' => $isPresentation,
            'contact' => $contact,
            'isConference' => $isConference
        );
    }

    public function getNewsPageData($slug) {
        $pageType = MdfContentTemplate::TYPE_NEWS_DETAILS;
        $titleHeader = $this->getTitleHeaderContentBySlug($pageType, $slug);

        if (empty($titleHeader))
            throw $this->createNotFoundException('Empty content');

        $pageId = $titleHeader->getTranslatable()->getId();

        $textWidgets = $this->getContentTemplateTextWidgetsByPageId($pageId);
        $imageWidgets = $this->getContentTemplateImageWidgetsByPageId($pageId);
        $galleryWidgets = $this->getContentTemplateGalleryWidgetsByPageId($pageId);
        $fileWidgets = $this->getContentTemplateFileWidgetsByPageId($pageId);
        $videoWidgets = $this->getContentTemplateVideosByPageId($pageId);
        $contact = $this->contactManager->getContactInfo();

        $widgets = [];
        $widgets = array_merge($widgets, $textWidgets, $imageWidgets, $galleryWidgets, $fileWidgets, $videoWidgets);

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
            'isPresentation' => true,
            'contact' => $contact,
            'isWhoAreWe' => false
        );
    }

    public function getHomepageNewsContent() {
        $pageType = MdfContentTemplate::TYPE_NEWS_DETAILS;

        $news = $this->getHomepageNews($pageType);

        foreach ($news as $key => $newsItem) {
            $newsContent[$key]['content'] = $newsItem;
            $newsContent[$key]['image'] = $this->getContentTemplateImageWidgetsByPageId($newsItem->getTranslatable()->getId());
            $newsContent[$key]['text'] = $this->getContentTemplateTextWidgetsByPageId($newsItem->getTranslatable()->getId());
        }

        return isset($newsContent) ? $newsContent : [];
    }

    public function getNewsContent($filters = ['all']) {
        $pageType = MdfContentTemplate::TYPE_NEWS_DETAILS;

        if (in_array("all", $filters)) {
            $filters = array_diff($filters, array('all'));
            $news = $this->getAllNews($pageType);
        } else {
            $news = $this->getNews($pageType, $filters);
        }

        foreach ($news as $key => $newsItem) {
            $newsContent[$key]['content'] = $newsItem;
            $newsContent[$key]['image'] = $this->getContentTemplateImageWidgetsByPageId($newsItem->getTranslatable()->getId());
            $newsContent[$key]['text'] = $this->getContentTemplateTextWidgetsByPageId($newsItem->getTranslatable()->getId());
        }

        return isset($newsContent) ? $newsContent : [];
    }

    public function getConferenceNewsContent($conference, $offset = false) {
        $pageType = MdfContentTemplate::TYPE_NEWS_DETAILS;

        $news = $this->getConferenceNews($pageType, $conference, $offset);

        foreach ($news as $key => $newsItem) {
            $newsContent[$key]['content'] = $newsItem;
            $newsContent[$key]['image'] = $this->getContentTemplateImageWidgetsByPageId($newsItem->getTranslatable()->getId());
            $newsContent[$key]['text'] = $this->getContentTemplateTextWidgetsByPageId($newsItem->getTranslatable()->getId());
        }

        return isset($newsContent) ? $newsContent : [];
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

    public function getContentTemplateVideosByPageId($pageId) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetVideoTranslation::class)
            ->getYoutubeWidgetsByLocaleAndPageId($this->requestStack->getMasterRequest()->get('_locale'), $pageId);
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

    public function getNews($pageType, $filters) {
        return $this->em
            ->getRepository(MdfContentTemplateTranslation::class)
            ->getNewsByLocaleAndType(
                $this->requestStack->getMasterRequest()->get('_locale'),
                $pageType,
                $filters
            );
    }

    public function getConferenceNews($type, $conference, $offset) {
        return $this->em
            ->getRepository(MdfContentTemplateTranslation::class)
            ->getConferenceNewsByLocaleAndType(
                $this->requestStack->getMasterRequest()->get('_locale'),
                $type,
                $conference,
                $offset
            );
    }

    public function getAllNews($pageType) {
        return $this->em
            ->getRepository(MdfContentTemplateTranslation::class)
            ->getAllNewsByLocaleAndType(
                $this->requestStack->getMasterRequest()->get('_locale'),
                $pageType
            );
    }

    public function countNews($filters) {
        $pageType = MdfContentTemplate::TYPE_NEWS_DETAILS;

        if (in_array("all", $filters)) {
            $nrOfRows = $this->em
                ->getRepository(MdfContentTemplateTranslation::class)
                ->countAllNewsByLocaleAndType(
                    $this->requestStack->getMasterRequest()->get('_locale'),
                    $pageType
                );
        } else {
            $nrOfRows = $this->em
                ->getRepository(MdfContentTemplateTranslation::class)
                ->countNewsByLocaleAndType(
                    $this->requestStack->getMasterRequest()->get('_locale'),
                    $pageType,
                    $filters
                );
        }

        return intval($nrOfRows);
    }
    
    public function showMoreButton($slug)
    {
        if ($this->countNews([$slug]) > 9) {
            return true;
        }
        return false;
    }

    /**
     * Find MdfContentTemplateTranslation by MdfContentTemplateWidget
     * 
     * @param string $locale
     * @param string $type
     * @param int $id
     * 
     * @return array
     */
    public function findContentTemplateByWidget($locale, $type, $id) {
        return $this->em
            ->getRepository(MdfContentTemplateTranslation::class)
            ->getByWidget(
                $locale,
                array('id' => $id, 'type' => $type)
            );
    }
}
