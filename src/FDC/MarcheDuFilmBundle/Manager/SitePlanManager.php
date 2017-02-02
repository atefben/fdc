<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfSitePlanTranslation;
use FDC\MarcheDuFilmBundle\Entity\ServiceTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class SitePlanManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getSitePlanPage()
    {
        return $this->em
            ->getRepository(MdfSitePlanTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getServicesPages()
    {
        return $this->em
            ->getRepository(ServiceTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
