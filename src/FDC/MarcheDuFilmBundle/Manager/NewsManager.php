<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\NewsTranslation;
use FDC\MarcheDuFilmBundle\Entity\News;
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

    public function getHomepageNews()
    {
        return $this->em
            ->getRepository(NewsTranslation::class)
            ->getHomepageNewsByLocale(
                $this->requestStack->getMasterRequest()->get('_locale')
            );
    }
}
