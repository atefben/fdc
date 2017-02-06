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

        $pagesStatus = $conferencePagesManager->getPagesStatus($slug);
        $nextBackUrls = $conferencePagesManager->getNextAndBackUrl($pagesStatus, 'speakersIsActive');

        $pageData = array_merge($pageData, $pagesStatus, $nextBackUrls);

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
            'contact' => $contact,
            'files' => $conferenceProgramManager->getFiles($conferenceProgramPage->getTranslatable()->getId())
        );

        $pagesStatus = $conferencePagesManager->getPagesStatus($slug);
        $nextBackUrls = $conferencePagesManager->getNextAndBackUrl($pagesStatus, 'programIsActive');

        $pageData = array_merge($pageData, $pagesStatus, $nextBackUrls);

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

        $pagesStatus = $conferencePagesManager->getPagesStatus($slug);
        $nextBackUrls = $conferencePagesManager->getNextAndBackUrl($pagesStatus, 'partnersIsActive');

        $pageData = array_merge($pageData, $pagesStatus, $nextBackUrls);

        return $this->render('FDCMarcheDuFilmBundle:conference:partners.html.twig', $pageData);
    }

    /**
     * @Route("/{slug}/home", name="fdc_marche_du_film_conference_home")
     */
    public function homeAction(Request $request, $slug)
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $conferencePagesManager = $this->get('mdf.manager.conference_pages');

        $pagesStatus = $conferencePagesManager->getPagesStatus($slug);
        $nextUrl = $conferencePagesManager->getHomeNextUrl($pagesStatus);

//        var_dump($contentTemplateManager->getPageData($slug));die;

        $contentTemplatePageData = $contentTemplateManager->getPageData($slug);

        if($contentTemplatePageData['titleHeader'] == null && empty($contentTemplatePageData['widgets']))
        {
            throw new NotFoundHttpException();
        }

        $pageData = array_merge($contentTemplateManager->getPageData($slug), $pagesStatus, $nextUrl);

        return $this->render('FDCMarcheDuFilmBundle:contentTemplate:contentTemplate.html.twig', $pageData);
    }

    /**
     * @Route("/{slug}/actualite", options = { "expose" = true }, name="fdc_marche_du_film_conference_news")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newsAction(Request $request, $slug)
    {
        $conferenceNewsPageManager = $this->get('mdf.manager.conference_news_page');
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');
        $conferencePagesManager = $this->get('mdf.manager.conference_pages');

        if ($offset = $request->request->get('numberOfArticles')) {
            $newsContent = $contentTemplateManager->getConferenceNewsContent($slug, $offset);
            
            return $this->render('FDCMarcheDuFilmBundle::conference/news/partials/newsBlock.html.twig', array(
                    'news' => $newsContent
                )
            );

        } else {
            $conferenceNewsPage = $conferenceNewsPageManager->getConferenceNewsPageBySlug($slug);
            $newsContent = $contentTemplateManager->getConferenceNewsContent($slug);
            $contact = $contactManager->getContactInfo();

            if(!$conferenceNewsPage) {
                throw new NotFoundHttpException();
            }

            $pageData = array(
                'newsPageContent' => $conferenceNewsPage,
                'news' => $newsContent,
                'conferenceTitle' => $slug,
                'contact' => $contact,
            );

            $pagesStatus = $conferencePagesManager->getPagesStatus($slug);
            $nextBackUrls = $conferencePagesManager->getNextAndBackUrl($pagesStatus, 'newsIsActive');

            $pageData = array_merge($pageData, $pagesStatus, $nextBackUrls);

            return $this->render('FDCMarcheDuFilmBundle:conference:news/show.html.twig', $pageData);
        }
    }

    /**
     * @Route("/{slug}/infos-et-contacts", name="fdc_marche_du_film_conference_infos_and_contacts")
     *
     * @param Request $request
     * @param         $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function infoAndContactAction(Request $request, $slug)
    {
        $conferenceInfoAndContactManager = $this->get('mdf.manager.conference_info_and_contact');
        $contactManager = $this->get('mdf.manager.contact');
        $conferencePagesManager = $this->get('mdf.manager.conference_pages');

        $conferenceInfoAndContactPage = $conferenceInfoAndContactManager->getConferenceInfoAndContactPageBySlug($slug);

        if(!$conferenceInfoAndContactPage) {
            throw new NotFoundHttpException();
        }

        $conferenceInfoAndContactWidgets = $conferenceInfoAndContactManager
            ->getConferenceInfoAndContactWidgets(
                $conferenceInfoAndContactPage->getTranslatable()->getId()
            );

        $contact = $contactManager->getContactInfo();

        $pageData = array(
            'conferenceInfoAndContactPage' => $conferenceInfoAndContactPage,
            'conferenceInfoAndContactWidgets' => $conferenceInfoAndContactWidgets,
            'contact' => $contact
        );

        $pagesStatus = $conferencePagesManager->getPagesStatus($slug);
        $nextBackUrls = $conferencePagesManager->getNextAndBackUrl($pagesStatus, 'infoAndContactIsActive');

        $pageData = array_merge($pageData, $pagesStatus, $nextBackUrls);

        return $this->render('FDCMarcheDuFilmBundle:conference:infoAndContact.html.twig', $pageData);
    }
}
