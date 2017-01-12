<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\NewsPage;
use FDC\MarcheDuFilmBundle\Entity\NewsPageTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use Symfony\Component\HttpFoundation\RequestStack;

class NewsManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getNewsPageTitle()
    {
        return $this->em
            ->getRepository(NewsPageTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
