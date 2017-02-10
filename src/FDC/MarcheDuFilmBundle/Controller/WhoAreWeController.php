<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeamTranslation;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WhoAreWeController
 *
 * @package FDC\MarcheDuFilmBundle\Controller
 */
class WhoAreWeController extends Controller
{
    /**
     * @Route("/quisommesnous/equipe", name="fdc_marche_du_film_who_are_we_team")
     */
    public function whoAreWeTeamAction()
    {
        $whoAreWeTeamManager = $this->get('mdf.manager.who_are_we_team');

        $whoAreWeTeamContent = $whoAreWeTeamManager->getWhoAreWeTeamContent();

        $pageTranslationStatus = $whoAreWeTeamContent->getStatus();
        if(($pageTranslationStatus != MdfWhoAreWeTeamTranslation::STATUS_TRANSLATED) && ($pageTranslationStatus != MdfWhoAreWeTeamTranslation::STATUS_PUBLISHED))
        {
            throw new NotFoundHttpException();
        }

        $whoAreWeTeamContactWidgets = $whoAreWeTeamManager->getWhoAreWeTeamContactWidgets();
        $whoAreWeTeamWidgets = $whoAreWeTeamManager->getWhoAreWeTeamWidgets();

        return $this->render('FDCMarcheDuFilmBundle:whoAreWe:whoAreWeTeam.html.twig', array(
            'whoAreWeTeamContent' => $whoAreWeTeamContent,
            'whoAreWeTeamContactWidgets' => $whoAreWeTeamContactWidgets,
            'whoAreWeTeamWidgets' => $whoAreWeTeamWidgets
        ));
    }
}
