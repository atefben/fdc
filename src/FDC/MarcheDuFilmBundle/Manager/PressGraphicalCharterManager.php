<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfPressGraphicalCharterTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfPressGraphicalCharterWidgetTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class PressGraphicalCharterManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getPressGraphicalCharterWidgets()
    {
        return $this->em
            ->getRepository(MdfPressGraphicalCharterWidgetTranslation::class)
            ->getSortedPressGraphicalCharterWidgets($this->requestStack->getMasterRequest()->get('_locale'));
    }

    public function getPressGraphicalCharterContent()
    {
        return $this->em
            ->getRepository(MdfPressGraphicalCharterTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
