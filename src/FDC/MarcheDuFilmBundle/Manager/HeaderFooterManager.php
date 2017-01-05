<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\HeaderFooter;
use FDC\MarcheDuFilmBundle\Entity\HeaderFooterTranslation;
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

    public function getHeaderBanner() {
        return $this->em
            ->getRepository(HeaderFooterTranslation::class)
            ->findOneBy(
                [
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
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
}
