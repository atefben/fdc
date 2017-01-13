<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfTheme;
use FDC\MarcheDuFilmBundle\Entity\MdfThemeTranslation;
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
            ->getRepository(MdfThemeTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
