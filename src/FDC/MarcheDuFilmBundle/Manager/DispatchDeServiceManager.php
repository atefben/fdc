<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceTranslation;
use FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceWidgetTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class DispatchDeServiceManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getDispatchDeServiceWidgets()
    {
        return $this->em
            ->getRepository(DispatchDeServiceWidgetTranslation::class)
            ->getSortedServices($this->requestStack->getMasterRequest()->get('_locale'));
    }

    public function getDispatchDeServiceContent()
    {
        return $this->em
            ->getRepository(DispatchDeServiceTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function findDispatchDeServiceByMedia($locale, $type, $id) {
        return $this->em
            ->getRepository(DispatchDeServiceTranslation::class)
            ->getByMedia(
                $locale,
                array('id' => $id, 'type' => $type)
            );
    }
}
