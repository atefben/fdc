<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeamContactWidgetTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeamTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeamWidgetTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class WhoAreWeTeamManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getWhoAreWeTeamContactWidgets()
    {
        return $this->em
            ->getRepository(MdfWhoAreWeTeamContactWidgetTranslation::class)
            ->getSortedWhoAreWeTeamContactWidgets($this->requestStack->getMasterRequest()->get('_locale'));
    }

    public function getWhoAreWeTeamWidgets()
    {
        return $this->em
            ->getRepository(MdfWhoAreWeTeamWidgetTranslation::class)
            ->getSortedWhoAreWeTeamWidgets($this->requestStack->getMasterRequest()->get('_locale'));
    }

    public function getWhoAreWeTeamContent()
    {
        return $this->em
            ->getRepository(MdfWhoAreWeTeamTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function findWhoAreWeTeamByMedia($locale, $type, $id) {
        return $this->em
            ->getRepository(MdfWhoAreWeTeamTranslation::class)
            ->getByMedia(
                $locale,
                array('id' => $id, 'type' => $type)
            );
    }
}
