<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        
        if (!$newsPageContent) {
            throw new NotFoundHttpException('Page not found');
        }
        
        $newsContent = $contentTemplateManager->getNewsContent();
        $numberOfNews = $contentTemplateManager->countNews(['all']);
        $filters = $themeManager->getAllThemes();
        $contact = $contactManager->getContactInfo();

        return $this->render('FDCMarcheDuFilmBundle::news/show.html.twig', array(
            'newsPageContent' => $newsPageContent,
            'news' => $newsContent,
            'filters' => $filters,
            'contact' => $contact,
            'numberOfNews' => $numberOfNews
        ));
    }

    /**
     * @Route("get_news", options = { "expose" = true }, name="fdc_marche_du_film_get_news")
     */
    public function getNewsAction(Request $request)
    {
        $filtersData = json_decode($request->request->get('filtersData'), true);

        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $themeManager = $this->get('mdf.manager.theme');

        $newsContent = $contentTemplateManager->getNewsContent($filtersData);
        $numberOfNews = $contentTemplateManager->countNews($filtersData);
        $filters = $themeManager->getAllThemes();

        return $this->render('FDCMarcheDuFilmBundle::news/partials/filterListNews.html.twig', array(
            'news' => $newsContent,
            'filters' => $filters,
            'numberOfNews' => $numberOfNews
        ));
    }
}
