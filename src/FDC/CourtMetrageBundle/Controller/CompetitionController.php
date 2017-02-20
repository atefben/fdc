<?php

namespace FDC\CourtMetrageBundle\Controller;

use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTabTranslation;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CompetitionController extends CcmController
{
    /**
     * @Route("selection", name="fdc_court_metrage_competition_selection")
     */
    public function selectionMoviesAction()
    {

        $competitionManager = $this->get('ccm.manager.competition');

        $selectionTab = $competitionManager->getSelectionTab();
        $translationStatus = $selectionTab->getStatus();
        if(!$selectionTab || ($translationStatus != CcmShortFilmCompetitionTabTranslation::STATUS_PUBLISHED && $translationStatus != CcmShortFilmCompetitionTabTranslation::STATUS_TRANSLATED)) {
            throw new NotFoundHttpException();
        }
        $juryTab = $competitionManager->getJuryTab();
        $palmaresTab = $competitionManager->getPalmaresTab();
        $festivalId = $this->getFestival()->getId();

        $films = $competitionManager->getSelectionFilms($festivalId);

        return $this->render('FDCCourtMetrageBundle:Competition:selection.html.twig', array(
            'films' => $films,
            'selectionTab' => $selectionTab,
            'juryTab' => $juryTab,
            'palmaresTab' => $palmaresTab,
        ));
    }

    /**
     * @Route("jury", name="fdc_court_metrage_competition_jury")
     */
    public function juryAction()
    {
        $competitionManager = $this->get('ccm.manager.competition');

        $selectionTab = $competitionManager->getSelectionTab();
        $juryTab = $competitionManager->getJuryTab();

        $translationStatus = $juryTab->getStatus();
        if(!$juryTab || ($translationStatus != CcmShortFilmCompetitionTabTranslation::STATUS_PUBLISHED && $translationStatus != CcmShortFilmCompetitionTabTranslation::STATUS_TRANSLATED)) {
            throw new NotFoundHttpException();
        }

        $palmaresTab = $competitionManager->getPalmaresTab();

        $festival = $this->getFestival();

        $jury = $competitionManager->getJury($festival->getId());

        return $this->render('FDCCourtMetrageBundle:Competition:jury.html.twig', array(
            'selectionTab' => $selectionTab,
            'juryTab' => $juryTab,
            'palmaresTab' => $palmaresTab,
            'members' => $jury['members'],
            'president' => $jury['president'],
            'festival' => $festival
        ));
    }

    /**
     * @Route("palmares", name="fdc_court_metrage_competition_palmares")
     */
    public function palmaresAction()
    {
        $competitionManager = $this->get('ccm.manager.competition');

        $selectionTab = $competitionManager->getSelectionTab();
        $juryTab = $competitionManager->getJuryTab();
        $palmaresTab = $competitionManager->getPalmaresTab();

        $translationStatus = $palmaresTab->getStatus();
        if(!$palmaresTab || ($translationStatus != CcmShortFilmCompetitionTabTranslation::STATUS_PUBLISHED && $translationStatus != CcmShortFilmCompetitionTabTranslation::STATUS_TRANSLATED)) {
            throw new NotFoundHttpException();
        }

        $festival = $this->getFestival();

        $palmares = $competitionManager->getPalmares($festival->getId());

        return $this->render('FDCCourtMetrageBundle:Competition:palmares.html.twig', array(
            'selectionTab' => $selectionTab,
            'juryTab' => $juryTab,
            'palmaresTab' => $palmaresTab,
            'award_associations' => $palmares
        ));
    }
}
