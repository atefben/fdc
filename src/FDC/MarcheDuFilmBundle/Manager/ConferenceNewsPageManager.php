<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPageTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ConferenceNewsPageManager
 *
 * @package FDC\MarcheDuFilmBundle\Manager
 */
class ConferenceNewsPageManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getConferenceNewsPageBySlug($slug)
    {
        return $this->em
            ->getRepository(MdfConferenceNewsPageTranslation::class)
            ->getConferenceNewsPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);
    }
}
