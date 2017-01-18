<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        if(!$speakersPage) {
            throw new NotFoundHttpException();
        }

        $speakersTabs = $speakersManager->getSpeakersTabOnPage($speakersPage);
        $speakersList = $speakersManager->getSpeakersList($speakersTabs);

        return $this->render('FDCMarcheDuFilmBundle:conference:speakers.html.twig', [
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
        $contactManager = $this->get('mdf.manager.contact');

        $conferenceProgramPage = $conferenceProgramManager->getConferenceProgramPageBySlug($slug);

        if(!$conferenceProgramPage) {
            throw new NotFoundHttpException();
        }

        $contentTemplateWidgets = $conferenceProgramManager->getContentTemplateConferenceProgramePageData($conferenceProgramPage);

        $programDays = $conferenceProgramManager->getConferenceProgramDaysWidgets($conferenceProgramPage);
        $programDaysEvents = $conferenceProgramManager->getEventsPerDays($programDays);
        $eventsSpeakers = $conferenceProgramManager->getSpeakersPerEvent($programDaysEvents);

        $contact = $contactManager->getContactInfo();

        return $this->render('FDCMarcheDuFilmBundle:conference:program.html.twig', [
                 'conferenceProgram' => $conferenceProgramPage,
                 'contentTemplateWidgets' => $contentTemplateWidgets,
                 'programDays' => $programDays,
                 'programDaysEvents' => $programDaysEvents,
                 'eventsSpeakers' => $eventsSpeakers,
                 'contact' => $contact
             ]
        );
    }

    /**
     * @Route("/{slug}/partenaires")
     *
     * @param Request $request
     * @param         $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function partnerAction(Request $request, $slug)
    {
        $conferencePartnerManager = $this->get('mdf.manager.conference_partner');
        $contactManager = $this->get('mdf.manager.contact');

        $conferencePartnersPage = $conferencePartnerManager->getConferencePartnerPageBySlug($slug);

        if(!$conferencePartnersPage) {
            throw new NotFoundHttpException();
        }

        $conferencePartnersTabs = $conferencePartnerManager->getConferencePartnerTabWidgets($conferencePartnersPage);
        $conferencePartnersLogos = $conferencePartnerManager->getLogosPerTabs($conferencePartnersTabs);

        $contact = $contactManager->getContactInfo();

        return $this->render('FDCMarcheDuFilmBundle:conference:partners.html.twig', [
                 'conferencePartnersPage' => $conferencePartnersPage,
                 'conferencePartnersTabs' => $conferencePartnersTabs,
                 'conferencePartnersLogos' => $conferencePartnersLogos,
                 'contact' => $contact
             ]
        );
    }

    /**
     * @Route("/{slug}/actualite")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newsAction(Request $request, $slug)
    {
        $conferenceNewsPageManager = $this->get('mdf.manager.conference_news_page');
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');

        $conferenceNewsPage = $conferenceNewsPageManager->getConferenceNewsPageBySlug($slug);
        $newsContent = $contentTemplateManager->getNewsContent([$slug]);
        $contact = $contactManager->getContactInfo();

        if(!$conferenceNewsPage) {
            throw new NotFoundHttpException();
        }

        return $this->render('FDCMarcheDuFilmBundle:conference:news/show.html.twig', [
                'newsPageContent' => $conferenceNewsPage,
                'news' => $newsContent,
                'conferenceTitle' => $slug,
                'contact' => $contact,
            ]
        );
    }
}
