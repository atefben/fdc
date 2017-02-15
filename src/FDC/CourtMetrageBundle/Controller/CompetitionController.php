<?php

namespace FDC\CourtMetrageBundle\Controller;

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
        $festivalId = $this->getFestival()->getId();

        $films = $competitionManager->getSelectionFilms($festivalId);

        return $this->render('FDCCourtMetrageBundle:Competition:selection.html.twig', array(
            'films' => $films,
            'selectionTab' => $selectionTab
        ));
    }

    /**
     * @Route("jury", name="fdc_court_metrage_competition_jury")
     */
    public function juryAction()
    {
        $competitionManager = $this->get('ccm.manager.competition');

        $selectionTab = $competitionManager->getSelectionTab();
        $festivalId = $this->getFestival()->getId();

        return $this->render('FDCCourtMetrageBundle:Competition:jury.html.twig', array(
            'selectionTab' => $selectionTab
        ));
    }
}
