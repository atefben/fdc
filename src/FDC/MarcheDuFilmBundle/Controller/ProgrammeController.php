<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Sonata\AdminBundle\Tests\Datagrid\PagerTest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProgrammeController extends Controller
{
    /**
     * @Route("global-events", name="fdc_marche_du_film_global_events")
     */
    public function globalEventsAction(Request $request)
    {
        $contactManager = $this->get('mdf.manager.contact');
        $programmeManager = $this->get('mdf.manager.programme');
        $themeManager = $this->get('mdf.manager.theme');

        $contact = $contactManager->getContactInfo();
        $themes = $themeManager->getAllThemes();
        $globalEventsPage = $programmeManager->getGlobalEventsPage();
        $globalEventsDays = $programmeManager->getGlobalEventsDays($globalEventsPage);
        $globalEventsSchedules = $programmeManager->getGlobalEventsSchedulesSorted($globalEventsDays);

        return $this->render('FDCMarcheDuFilmBundle:programme:globalEvents.html.twig', array(
            'globalEventsPage' => $globalEventsPage,
            'globalEventsDays' => $globalEventsDays,
            'globalEventsSchedules' => $globalEventsSchedules,
            'themes' => $themes,
            'contact' => $contact
        ));
    }
}

