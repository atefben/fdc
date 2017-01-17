<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ThemeController extends Controller
{
    /**
     * @Route("/{slug}/speakers")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function speakersAction(Request $request, $slug)
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');
        $speakersManager = $this->get('mdf.manager.speakers');

        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $contact = $contactManager->getContactInfo();
        $speakersPage = $speakersManager->getSpeakersPageByLocale($slug);
        $speakersTabs = $speakersManager->getSpeakersTabOnPage($speakersPage);
        $speakersList = $speakersManager->getSpeakersList($speakersTabs);

        return $this->render('FDCMarcheDuFilmBundle:conference:speakers.html.twig',
            [
                'speakersPage' => $speakersPage,
                'speakersTabs' => $speakersTabs,
                'speakersList' => $speakersList,
                'news' => $newsContent,
                'contact' => $contact,
            ]
        );
    }

    /**
     * @Route("/{slug}/programme")
     * @param Request $request
     * @param         $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function programAction(Request $request, $slug)
    {
        $conferenceProgramManager = $this->get('mdf.manager.conference_program');

        $conferenceProgramPage = $conferenceProgramManager->getConferenceProgramPageBySlug($slug);
        $contentTemplateWidgets = $conferenceProgramManager->getContentTemplateConferenceProgramePageData($conferenceProgramPage);

        $programDays = $conferenceProgramManager->getConferenceProgramDaysWidgets($conferenceProgramPage);
        $programDaysEvents = $conferenceProgramManager->getEventsPerDays($programDays);
        $eventsSpeakers = $conferenceProgramManager->getSpeakersPerEvent($programDaysEvents);

        return $this->render('FDCMarcheDuFilmBundle:conference:program.html.twig',
             [
                 'conferenceProgram' => $conferenceProgramPage,
                 'contentTemplateWidgets' => $contentTemplateWidgets,
                 'programDays' => $programDays,
                 'programDaysEvents' => $programDaysEvents,
                 'eventsSpeakers' => $eventsSpeakers
             ]
        );
    }
}
