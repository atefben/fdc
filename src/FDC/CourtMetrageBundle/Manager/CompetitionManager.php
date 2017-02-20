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

    public function getJuryTab()
    {
        return $this->em
            ->getRepository(CcmShortFilmCompetitionTabTranslation::class)
            ->findTabByLocaleAndType($this->requestStack->getMasterRequest()->get('_locale'), CcmShortFilmCompetitionTab::TYPE_JURY);
    }

    public function getPalmaresTab()
    {
        return $this->em
            ->getRepository(CcmShortFilmCompetitionTabTranslation::class)
            ->findTabByLocaleAndType($this->requestStack->getMasterRequest()->get('_locale'), CcmShortFilmCompetitionTab::TYPE_PALMARES);
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

    public function getJury($festivalId)
    {
        $selectionSectionId = $this->getJuryTab()->getTranslatable()->getSelectionSection()->getId();

        $juries = $this
            ->em
            ->getRepository('BaseCoreBundle:FilmJury')
            ->getJurysByType($festivalId, $this->requestStack->getMasterRequest()->get('_locale'), $selectionSectionId)
        ;

        $members = array();
        $president = null;
        $hasPresident = false;
        foreach ($juries as $jury) {
            $filmMedia = null;
            if ($jury->getMedias()->count()) {
                foreach ($jury->getMedias() as $media) {
                    $filmMedia = $media;
                }
            }
            if (!$filmMedia && $jury->getPerson() && $jury->getPerson()->getMedias()->count()) {
                foreach ($jury->getPerson()->getMedias() as $media) {
                    $filmMedia = $media->getMedia();
                }
            }
            if (!$hasPresident && in_array($jury->getFunction()->getId(), array(1, 4))) {
                $president = array(
                    'jury'       => $jury,
                    'film_media' => $filmMedia,
                );
                $hasPresident = true;
            } else {
                array_push($members, array(
                    'jury'       => $jury,
                    'film_media' => $filmMedia,
                ));
            }
        }

        return array(
            'members' => $members,
            'president' => $president
        );
    }

    public function getPalmares($festivalId)
    {
        $selectionSectionId = $this->getPalmaresTab()->getTranslatable()->getSelectionSection()->getId();

        $palmares = $this
            ->em
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($festivalId, 'Compétition', $selectionSectionId)
        ;

        return $palmares;
    }
}
