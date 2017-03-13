<?php

namespace FDC\CourtMetrageBundle\Manager;

use FDC\CourtMetrageBundle\Entity\CcmWaitingPageTranslation;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTabTranslation;

/**
 * Class CompetitionManager
 *
 * @package FDC\CourtMetrageBundle\Manager
 */
class CompetitionManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * CompetitionManager constructor.
     *
     * @param EntityManager $entityManager
     * @param RequestStack  $requestStack
     */
    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * @return mixed
     */
    public function getSelectionTab()
    {
        return $this->em
            ->getRepository(CcmShortFilmCompetitionTabTranslation::class)
            ->findTabByLocaleAndType($this->requestStack->getMasterRequest()->get('_locale'), CcmShortFilmCompetitionTab::TYPE_SELECTION);
    }

    /**
     * @return mixed
     */
    public function getJuryTab($year = null)
    {
        return $this->em
            ->getRepository(CcmShortFilmCompetitionTabTranslation::class)
            ->findTabByLocaleAndType($this->requestStack->getMasterRequest()->get('_locale'), CcmShortFilmCompetitionTab::TYPE_JURY, $year?:date("Y"));
    }

    /**
     * @return mixed
     */
    public function getPalmaresTab()
    {
        return $this->em
            ->getRepository(CcmShortFilmCompetitionTabTranslation::class)
            ->findTabByLocaleAndType($this->requestStack->getMasterRequest()->get('_locale'), CcmShortFilmCompetitionTab::TYPE_PALMARES);
    }

    /**
     * @param $festivalId
     *
     * @return mixed
     */
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

    /**
     * @param $festivalId
     *
     * @return array
     */
    public function getJury($festivalId, $juryTab)
    {
        $juries = $this
            ->em
            ->getRepository('BaseCoreBundle:FilmJury')
            ->getJurysByType($festivalId, $this->requestStack->getMasterRequest()->get('_locale'), $juryTab->getTranslatable()->getJuryType()->getId())
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

    /**
     * @param $festivalId
     *
     * @return mixed
     */
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

    /**
     * @param $selectionTab
     *
     * @return bool
     */
    public function checkWaitingPage($selectionTab)
    {
        $waitingPage = $this
            ->em
            ->getRepository(CcmWaitingPageTranslation::class)
            ->findPageByLocaleAndTab($this->requestStack->getMasterRequest()->get('_locale'), $selectionTab->getTranslatable());

        if($waitingPage && $waitingPage->getTranslatable()->isEnabled())
        {
            return $waitingPage;
        }

        return false;
    }
}
