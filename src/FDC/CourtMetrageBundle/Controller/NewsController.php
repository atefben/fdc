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
     * @Route("news", name="ccm_news")
     * @param Request $request
     * @return Response
     */
    public function newsAction(Request $request)
    {
        $locale = $request->get('_locale', 'fr');
        /** @var NewsManager $newsManager */
        $newsManager = $this->get('ccm.manager.news');
        
        $filters = $newsManager->getAvailableFilters($locale);
        dump($filters);die;
        
        return $this->render('@FDCCourtMetrage/news/news.html.twig');
    }
}
