<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ThemeController extends Controller
{
    /**
     * @Route("/{slug}/speakers", name="fdc_marche_du_film_conference_speakers")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function speakersAction(Request $request, $slug)
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');
        $speakersManager = $this->get('mdf.manager.speakers');
        $conferencePagesManager = $this->get('mdf.manager.conference_pages');

        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $contact = $contactManager->getContactInfo();
        $speakersPage = $speakersManager->getSpeakersPageByLocale($slug);

        if(!$speakersPage) {
            throw new NotFoundHttpException();
        }

        $speakersTabs = $speakersManager->getSpeakersTabOnPage($speakersPage);
        $speakersList = $speakersManager->getSpeakersList($speakersTabs);

        $pageData = array(
            'speakersPage' => $speakersPage,
            'speakersTabs' => $speakersTabs,
            'speakersList' => $speakersList,
            'news' => $newsContent,
            'contact' => $contact,
        );

        $pageData = array_merge($pageData, $conferencePagesManager->getPagesStatus($slug));

        return $this->render('FDCMarcheDuFilmBundle:conference:speakers.html.twig', $pageData);
    }

    /**
     * @Route("/{slug}/programme", name="fdc_marche_du_film_conference_program")
     * @param Request $request
     * @param         $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function programAction(Request $request, $slug)
    {
        $conferenceProgramManager = $this->get('mdf.manager.conference_program');
        $contactManager = $this->get('mdf.manager.contact');
        $conferencePagesManager = $this->get('mdf.manager.conference_pages');

        $conferenceProgramPage = $conferenceProgramManager->getConferenceProgramPageBySlug($slug);

        if(!$conferenceProgramPage) {
            throw new NotFoundHttpException();
        }

        $contentTemplateWidgets = $conferenceProgramManager->getContentTemplateConferenceProgramePageData($conferenceProgramPage);

        $programDays = $conferenceProgramManager->getConferenceProgramDaysWidgets($conferenceProgramPage);
        $programDaysEvents = $conferenceProgramManager->getEventsPerDays($programDays);
        $eventsSpeakers = $conferenceProgramManager->getSpeakersPerEvent($programDaysEvents);

        $contact = $contactManager->getContactInfo();
        $pageData = array(
            'conferenceProgram' => $conferenceProgramPage,
            'contentTemplateWidgets' => $contentTemplateWidgets,
            'programDays' => $programDays,
            'programDaysEvents' => $programDaysEvents,
            'eventsSpeakers' => $eventsSpeakers,
            'contact' => $contact
        );

        $pageData = array_merge($pageData, $conferencePagesManager->getPagesStatus($slug));

        return $this->render('FDCMarcheDuFilmBundle:conference:program.html.twig', $pageData);
    }

    /**
     * @Route("/{slug}/partenaires", name="fdc_marche_du_film_conference_partners")
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
        $conferencePagesManager = $this->get('mdf.manager.conference_pages');

        $conferencePartnersPage = $conferencePartnerManager->getConferencePartnerPageBySlug($slug);

        if(!$conferencePartnersPage) {
            throw new NotFoundHttpException();
        }

        $conferencePartnersTabs = $conferencePartnerManager->getConferencePartnerTabWidgets($conferencePartnersPage);
        $conferencePartnersLogos = $conferencePartnerManager->getLogosPerTabs($conferencePartnersTabs);

        $contact = $contactManager->getContactInfo();

        $pageData = array(
            'conferencePartnersPage' => $conferencePartnersPage,
            'conferencePartnersTabs' => $conferencePartnersTabs,
            'conferencePartnersLogos' => $conferencePartnersLogos,
            'contact' => $contact
        );

        $pageData = array_merge($pageData, $conferencePagesManager->getPagesStatus($slug));

        return $this->render('FDCMarcheDuFilmBundle:conference:partners.html.twig', $pageData);
    }

    /**
     * @Route("/{slug}/home", name="fdc_marche_du_film_conference_home")
     */
    public function homeAction(Request $request, $slug)
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $conferencePagesManager = $this->get('mdf.manager.conference_pages');

        $pageData = array_merge($contentTemplateManager->getPageData($slug), $conferencePagesManager->getPagesStatus($slug));

        return $this->render('FDCMarcheDuFilmBundle:contentTemplate:contentTemplate.html.twig', $pageData);
    }

    /**
     * @Route("/{slug}/actualite", name="fdc_marche_du_film_conference_news")
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
