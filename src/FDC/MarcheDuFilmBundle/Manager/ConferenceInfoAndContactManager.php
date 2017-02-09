<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContactTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContactWidgetTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ConferenceInfoAndContactManager
 *
 * @package FDC\MarcheDuFilmBundle\Manager
 */
class ConferenceInfoAndContactManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getConferenceInfoAndContactPageBySlug($slug)
    {
        return $this->em
            ->getRepository(MdfConferenceInfoAndContactTranslation::class)
            ->getConferenceInfoAndContactPageByLocaleAndSlug(
                $this->requestStack->getMasterRequest()->get('_locale'),
                $slug
            );
    }

    public function getConferenceInfoAndContactWidgets($id)
    {
        return $this->em
            ->getRepository(MdfConferenceInfoAndContactWidgetTranslation::class)
            ->getConferenceInfoAndContactWidgetsByLocaleAndId(
                $this->requestStack->getMasterRequest()->get('_locale'),
                $id
            );
    }

    public function findConferenceInfoAndContactByMedia($locale, $type, $id) {
        return $this->em
            ->getRepository(MdfConferenceInfoAndContactTranslation::class)
            ->getByMedia(
                $locale,
                array('id' => $id, 'type' => $type)
            );
    }
}
