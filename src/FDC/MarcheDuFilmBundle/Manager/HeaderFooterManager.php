<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\HeaderFooter;
use FDC\MarcheDuFilmBundle\Entity\HeaderFooterTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfMenu;
use Symfony\Component\HttpFoundation\RequestStack;

class HeaderFooterManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getHeaderBanner($locale = null) {

        if(!$locale)
        {
            $locale = $this->requestStack->getMasterRequest()->get('_locale');
        }

        return $this->em
            ->getRepository(HeaderFooterTranslation::class)
            ->findOneBy(
                [
                    'locale' => $locale
                ]
            );
    }

    public function getFooterUrls() {
        return $this->em
            ->getRepository(HeaderFooterTranslation::class)
            ->findOneBy(
                [
                   'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                ]
            );
    }

    public function getMenuAvailability()
    {
        $menuTranslation = $this->em
            ->getRepository(MdfMenu::class)
            ->findAll();

        if ($menuTranslation) {
            return $menuTranslation[0];
        }
        return null; 
    }
}
