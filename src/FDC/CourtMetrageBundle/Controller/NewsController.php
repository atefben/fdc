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

        //get associated film to the news
        $associatedFilm = null;
        $associatedProgrammation = null;
        $associatedFilmDuration = null;
        if ($article->getAssociatedFilm() != null) {
            $associatedFilm = $article->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
        }

        //get film projection
        $programmations = array();
        if ($associatedProgrammation != null) {
            foreach ($associatedProgrammation as $projection) {
                if ($projection->getProjection() != null) {
                    $programmations[] = $projection->getProjection();
                }
            }
        }
        $tempProjections = array();
        $now = new \DateTime();
        if ($programmations) {
            foreach ($programmations as $item) {
                if ($item !== null && $item->getStartsAt() && $item->getStartsAt() > $now) {
                    $tempProjections[$item->getStartsAt()->getTimestamp()] = $item->getStartsAt()->format('Y-m-d');
                }
            }
        }
        $nextProjectionDate = '';
        if ($tempProjections) {
            ksort($tempProjections);
            $tempProjections = array_values($tempProjections);
            $nextProjectionDate = $tempProjections[0];
        }

        //get focus articles
        $associatedNews = $newsManager->getNewsFocusArticles($article, $locale);

        //get day articles
        $count = 3;
        if ($article->getPublishedAt()) {
            $newsDate = $article->getPublishedAt();
        } else {
            $newsDate = new \DateTime();
        }
        $sameDayArticles = $newsManager->getSameDayNews($newsDate, $locale, $count, $article->getId(), $associatedNews);

        // next and previous button links
        $prevArticles = $newsManager->getPrevOrNextNews($newsDate, 'prev', $locale);
        $nextArticles = $newsManager->getPrevOrNextNews($newsDate, 'next', $locale);
        
        return $this->render('@FDCCourtMetrage/news/news_details.html.twig', [
            'article'                   => $article,
            'prev'                      => $prevArticles,
            'next'                      => $nextArticles,
            'associatedNews'            => $associatedNews,
            'programmations'            => $programmations,
            'associatedFilm'            => $associatedFilm,
            'sameDayArticles'           => $sameDayArticles,
            'nextProjectionDate'        => $nextProjectionDate,
            'associatedFilmDuration'    => $associatedFilmDuration
        ]);
    }
}
