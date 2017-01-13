<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    /**
     * @Route("actualite", name="fdc_marche_du_film_news")
     */
    public function indexAction()
    {
        $newsManager = $this->get('mdf.manager.news');
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');
        $themeManager = $this->get('mdf.manager.theme');

        $newsPageContent = $newsManager->getNewsPageTitle();
        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $filters = $themeManager->getAllThemes();
        $contact = $contactManager->getContactInfo();

        return $this->render('FDCMarcheDuFilmBundle::news/show.html.twig', array(
            'newsPageContent' => $newsPageContent,
            'news' => $newsContent,
            'filters' => $filters,
            'contact' => $contact
        ));
    }
}
