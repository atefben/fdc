<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\HomepagePushTranslation;
use FDC\CourtMetrageBundle\Entity\HomepageSliderTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class HomepageManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;

    }

    public function getSliders()
    {
        return $this->em
            ->getRepository(HomepageSliderTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getPushes()
    {
        return $this->em
            ->getRepository(HomepagePushTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
