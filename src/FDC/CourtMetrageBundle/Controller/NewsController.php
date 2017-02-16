<?php

namespace FDC\CourtMetrageBundle\Controller;


use FDC\CourtMetrageBundle\Manager\NewsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NewsController
 * @package FDC\CourtMetrageBundle\Controller
 */
class NewsController extends Controller
{
    /**
     * @Route("actualites", name="ccm_news")
     * @param Request $request
     * @return Response
     */
    public function newsAction(Request $request)
    {
        $locale = $request->get('_locale', 'fr');
        /** @var NewsManager $newsManager */
        $newsManager = $this->get('ccm.manager.news');
        
        $filters = $newsManager->getAvailableListFilters($locale);
        $news = $newsManager->getNewsArticlesForListPage($locale);

        return $this->render('@FDCCourtMetrage/news/news.html.twig', [
            'news'    => $news,  
            'filters' => $filters
        ]);
    }

    /**
     * @Route("actualites/{slug}", name="ccm_news_detail")
     * @param $slug
     * @param Request $request
     * @return Response
     */
    public function newsDetailAction($slug, Request $request)
    {
        $locale = $request->get('_locale', 'fr');
        /** @var NewsManager $newsManager */
        $newsManager = $this->get('ccm.manager.news');
        
        $article = $newsManager->getNewsArticleBySlugAndLocale($slug, $locale);

        if ($article == null) {
            throw $this->createNotFoundException();
        }
        
        return $this->render('@FDCCourtMetrage/news/news_details.html.twig', [
            'article' => $article
        ]);
    }
}
