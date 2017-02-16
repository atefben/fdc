<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsTranslation;
use FOS\RestBundle\Controller\Annotations\Route;
use Sonata\AdminBundle\Tests\Datagrid\PagerTest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProgrammeController extends Controller
{
    /**
     * @Route("global-events", name="fdc_marche_du_film_global_events")
     */
    public function globalEventsAction(Request $request)
    {
        $contactManager = $this->get('mdf.manager.contact');
        $programmeManager = $this->get('mdf.manager.programme');
        $conferenceManager = $this->get('mdf.manager.conference_program');

        $contact = $contactManager->getContactInfo();
        $conferences = $conferenceManager->getAllConferenceTypes();
        $globalEventsPage = $programmeManager->getGlobalEventsPage();

        $pageTranslationStatus = $globalEventsPage->getStatus();
        if(($pageTranslationStatus != MdfGlobalEventsTranslation::STATUS_TRANSLATED) && ($pageTranslationStatus != MdfGlobalEventsTranslation::STATUS_PUBLISHED))
        {
            throw new NotFoundHttpException();
        }

        $globalEventsDays = $programmeManager->getGlobalEventsDays($globalEventsPage);
        $globalEventsSchedules = $programmeManager->getGlobalEventsSchedulesSorted($globalEventsDays);

        return $this->render('FDCMarcheDuFilmBundle:programme:globalEvents.html.twig', array(
            'globalEventsPage' => $globalEventsPage,
            'globalEventsDays' => $globalEventsDays,
            'globalEventsSchedules' => $globalEventsSchedules,
            'conferences' => $conferences,
            'contact' => $contact
        ));
    }
}

