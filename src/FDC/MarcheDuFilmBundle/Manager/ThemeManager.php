<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\Theme;
use FDC\MarcheDuFilmBundle\Entity\ThemeTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use Symfony\Component\HttpFoundation\RequestStack;

class ThemeManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getAllThemes()
    {
        return $this->em
            ->getRepository(ThemeTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
