<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetFile;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetImage;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetTextTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfThemeTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ConferenceProgramManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getContentTemplateConferenceProgramePageData($conferenceProgramPage)
    {
        $textWidgets = $this->getContentTemplateTextWidgets($conferenceProgramPage);
        $imageWidgets = $this->getContentTemplateImageWidgets($conferenceProgramPage);
        $galleryWidgets = $this->getContentTemplateGalleryWidgets($conferenceProgramPage);

        $widgets = [];
        $widgets = array_merge($widgets, $textWidgets, $imageWidgets, $galleryWidgets);

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

        return $widgets;
    }

    public function getConferenceProgramPageByTheme($theme)
    {
        $theme = $this->em
            ->getRepository(MdfThemeTranslation::class)
            ->findBy(
                array(
                    'slug' => $theme
                )
            );

        if ($theme) {
            return $this->em
                ->getRepository(MdfConferenceProgramTranslation::class)
                ->getConferenceProgramPageByLocaleAndTheme($this->requestStack->getMasterRequest()->get('_locale'), $theme);
        }
        return null;
    }

    public function getContentTemplateTextWidgets($page) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetTextTranslation::class)
            ->getConferenceProgramTextWidgetsByLocaleAndPageId($this->requestStack->getMasterRequest()->get('_locale'), $page->getTranslatable()->getId());
    }

    public function getContentTemplateImageWidgets($page) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetImage::class)
            ->getConferenceProgramImageWidgetsByPageId($page->getTranslatable()->getId());
    }

    public function getContentTemplateGalleryWidgets($page) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetGallery::class)
            ->getConferenceProgramGalleryWidgetsByPageId($page->getTranslatable()->getId());
    }
}
