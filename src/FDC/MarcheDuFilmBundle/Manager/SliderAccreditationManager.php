<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfSliderAccreditationPageTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfSliderAccreditationTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class SliderAccreditationManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getAllSlidersAccreditation()
    {
        $sliderAccreditionPge = $this->em
            ->getRepository(MdfSliderAccreditationPageTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
        
        if ($sliderAccreditionPge) {
            return $this->em
                ->getRepository(MdfSliderAccreditationTranslation::class)
                ->getLocaleSortedSlidersOnPage($this->requestStack->getMasterRequest()->get('_locale'), $sliderAccreditionPge->getTranslatable()->getId());
        }
        
        return [];
    }
}
