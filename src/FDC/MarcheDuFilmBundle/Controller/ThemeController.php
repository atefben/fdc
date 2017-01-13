<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ThemeController extends Controller
{
    /**
     * @Route("/{theme}/speakers")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function speakersAction(Request $request, $theme)
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');
        $speakersManager = $this->get('mdf.manager.speakers');

        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $contact = $contactManager->getContactInfo();
        $speakersPage = $speakersManager->getSpeakersPageByLocale($theme);
        $speakersTabs = $speakersManager->getSpeakersTabOnPage($speakersPage);
        $speakersList = $speakersManager->getSpeakersList($speakersTabs);

        return $this->render('FDCMarcheDuFilmBundle:themes:speakers.html.twig',
            [
                'speakersPage' => $speakersPage,
                'speakersTabs' => $speakersTabs,
                'speakersList' => $speakersList,
                'news' => $newsContent,
                'contact' => $contact,
            ]);
    }
}
