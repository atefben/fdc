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
        $juryTab = $competitionManager->getJuryTab();
        $festivalId = $this->getFestival()->getId();

        $films = $competitionManager->getSelectionFilms($festivalId);

        return $this->render('FDCCourtMetrageBundle:Competition:selection.html.twig', array(
            'films' => $films,
            'selectionTab' => $selectionTab,
            'juryTab' => $juryTab
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
        $festival = $this->getFestival();

        $jury = $competitionManager->getJury($festival->getId());

        return $this->render('FDCCourtMetrageBundle:Competition:jury.html.twig', array(
            'selectionTab' => $selectionTab,
            'juryTab' => $juryTab,
            'members' => $jury['members'],
            'president' => $jury['president'],
            'festival' => $festival
        ));
    }
}
