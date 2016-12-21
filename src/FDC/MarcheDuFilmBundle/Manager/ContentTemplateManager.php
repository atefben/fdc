<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateTranslation;
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
}
