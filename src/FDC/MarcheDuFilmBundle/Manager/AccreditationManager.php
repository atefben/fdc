<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\Accreditation;
use FDC\MarcheDuFilmBundle\Entity\AccreditationTranslation;
use FDC\MarcheDuFilmBundle\Entity\AccreditationWidget;
use FDC\MarcheDuFilmBundle\Entity\AccreditationWidgetTranslation;;
use Symfony\Component\HttpFoundation\RequestStack;

class AccreditationManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getAccreditationWidgets()
    {
        return $this->em
            ->getRepository(AccreditationWidgetTranslation::class)
            ->getAccreditationWidgetsByLocale($this->requestStack->getMasterRequest()->get('_locale'));
    }

    public function getAccreditationContent()
    {
        return $this->em
            ->getRepository(AccreditationTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
