<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\PressCoverageTranslation;
use FDC\MarcheDuFilmBundle\Entity\PressCoverageWidgetTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class PressCoverageManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getPressCoverageWidgets($offset = false)
    {
        return $this->em
            ->getRepository(PressCoverageWidgetTranslation::class)
            ->getSortedPressCoverageWidgets($this->requestStack->getMasterRequest()->get('_locale'), $offset);
    }

    public function getPressCoverageContent()
    {
        return $this->em
            ->getRepository(PressCoverageTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
    
    public function getNumberOfArticles()
    {
        $numberOfArticles = count(
            $this->em
                ->getRepository(PressCoverageWidgetTranslation::class)
                ->getSortedPressCoverageWidgets($this->requestStack->getMasterRequest()->get('_locale'), false, false)
        );

        return $numberOfArticles;
    }
}
