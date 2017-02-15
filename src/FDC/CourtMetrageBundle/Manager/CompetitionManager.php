<?php

namespace FDC\CourtMetrageBundle\Manager;

use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTabTranslation;

class CompetitionManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getSelectionTab()
    {
        return $this->em
            ->getRepository(CcmShortFilmCompetitionTabTranslation::class)
            ->findTabByLocaleAndType($this->requestStack->getMasterRequest()->get('_locale'), CcmShortFilmCompetitionTab::TYPE_SELECTION);
    }

    public function getSelectionFilms($festivalId)
    {
        $selectionSectionId = $this->getSelectionTab()->getTranslatable()->getSelectionSection()->getId();

        $films = $this
            ->em
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($festivalId, $this->requestStack->getMasterRequest()->get('_locale'), $selectionSectionId)
        ;

        return $films;
    }
}
