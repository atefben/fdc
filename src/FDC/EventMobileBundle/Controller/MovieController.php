<?php

namespace FDC\EventMobileBundle\Controller;

use Base\CoreBundle\Entity\FDCPageLaSelection;
use Base\CoreBundle\Entity\FilmProjectionProgrammationFilm;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsFilmFilmAssociated;
use FDC\EventMobileBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/")
 */
class MovieController extends Controller
{

    /**
     * @Route("/films/{slug}")
     * @Template("FDCEventMobileBundle:Movie:main.html.twig")
     * @param $slug
     * @param Request $request
     * @return array
     */
    public function getAction(Request $request, $slug)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();

        try {
            $isAdmin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        } catch (\Exception $e) {
            $isAdmin = false;
        }

        // GET MOVIE
        if ($isAdmin) {
            $movie = $em->getRepository('BaseCoreBundle:FilmFilm')->findOneBy(array(
                'slug' => $slug
            ))
            ;
        } else {
            $movie = $em->getRepository('BaseCoreBundle:FilmFilm')->findOneBy(array(
                'slug'     => $slug,
                'festival' => $this->getFestival()
            ))
            ;

        }

        if ($movie === null) {
            throw new NotFoundHttpException('Movie not found');
        }

        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($movie->getFestival()->getId(), $locale, $movie->getSelectionSection()->getId(), $movie->getId())
        ;

        $moviesAll = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($movie->getFestival()->getId(), $locale, $movie->getSelectionSection()->getId())
        ;

        $articles = array();
        foreach ($movie->getAssociatedNews() as $associatedNews) {
            if ($associatedNews->getNews()) {
                $article = $associatedNews->getNews();
                if ($article->getPublishedAt() && $this->isPublished($article, $locale) && $article->findTranslationByLocale('fr')->getIsPublishedOnFDCEvent()) {
                    $key = $article->getPublishedAt()->getTimestamp();
                    $articles[$key] = $article;
                }
            }
        }
        foreach ($movie->getAssociatedInfo() as $associatedInfo) {
            if ($associatedInfo->getInfo()) {
                $article = $associatedInfo->getInfo();
                if ($article->getPublishedAt() && $this->isPublished($article, $locale) && $article->findTranslationByLocale('fr')->getIsPublishedOnFDCEvent()) {
                    $key = $article->getPublishedAt()->getTimestamp();
                    $articles[$key] = $article;
                }
            }
        }
        foreach ($movie->getAssociatedStatement() as $associatedStatement) {
            if ($associatedStatement->getStatement()) {
                $article = $associatedStatement->getStatement();
                if ($article->getPublishedAt() && $this->isPublished($article, $locale) && $article->findTranslationByLocale('fr')->getIsPublishedOnFDCEvent()) {
                    $key = $article->getPublishedAt()->getTimestamp();
                    $articles[$key] = $article;
                }
            }
        }

        krsort($articles);

        $prev = null;
        $next = null;
        foreach ($moviesAll as $key => $tmp) {
            if ($tmp->getId() == $movie->getId()) {
                if ($key == 0) {
                    $prev = $movies[count($movies) - 1];
                    $next = $movies[1];
                } elseif ($key == count($movies) - 1) {
                    $prev = $movies[count($movies) - 2];
                    $next = $movies[0];
                } else {
                    if (isset($movies[$key - 1])) {
                        $prev = $movies[$key - 1];
                    }
                    if (isset($movies[$key])) {
                        $next = $movies[$key];
                    }
                }
                break;
            }
        }

        $now = new \DateTime();
        $projections = array();
        foreach ($movie->getProjectionProgrammationFilms() as $projectionProgrammationFilm) {
            if ($projectionProgrammationFilm instanceof FilmProjectionProgrammationFilm && $projectionProgrammationFilm->getProjection()) {
                $projection = $projectionProgrammationFilm->getProjection();
                if ($projection->getStartsAt() && $projection->getStartsAt() > $now) {
                    $projections[$projection->getStartsAt()->getTimestamp()] = $projection->getStartsAt()->format('Y-m-d');
                }
            }
        }
        ksort($projections);
        $nextProjectionDate = '';
        if ($projections) {
            $projections = array_values($projections);
            $nextProjectionDate = $projections[0];
        }


        return array(
            'movies'   => $movies,
            'movie'    => $movie,
            'articles' => $articles,
            'prev'     => $prev,
            'next'     => $next,
            'nextProjectionDate' => $nextProjectionDate,
        );
    }

    protected function isPublished($article, $locale)
    {
        $translation = $article->findTranslationByLocale($locale);
        if ($locale == 'fr') {
            if ($translation->getStatus() === NewsArticleTranslation::STATUS_PUBLISHED) {
                return true;
            }
        } else {
            $fr = $article->findTranslationByLocale($locale);
            $published = NewsArticleTranslation::STATUS_PUBLISHED;
            $translated = NewsArticleTranslation::STATUS_TRANSLATED;
            if ($fr->getStatus() === $published) {
                return true;
            }
        }
    }

    /**
     * @Route("/selection/{slug}")
     *
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function selectionAction(Request $request, $slug = null)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $festival = $this->getFestival()->getId();

        $this->isPageEnabled($request->get('_route'));

        if ($slug == 'cinema-de-la-plage') {
            $page = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCinemaPlage')->getBySlug($locale, 'cinema-de-la-plage');

            if ($page == null) {
                throw new NotFoundHttpException('Cinema de la plage not found');
            }

            // ALL SELECTION
            $selectionTabs = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FDCPageLaSelection')
                ->getPagesOrdoredBySelectionSectionOrder($locale)
            ;

            $projections = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionsByFestivalYearAndProgrammationSection($festival, $page->getTitle())
            ;

            // NEXT SELECTION
            $next = null;
            if (count($selectionTabs) > 0) {
                $next = $selectionTabs[0];
            }

            $cannesClassics = $this->getDoctrineManager()->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll($locale, true);

            //SEO
            $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($page, $locale);

            return $this->render('FDCEventMobileBundle:Movie:cinema_plage.html.twig', array(
                'page'           => $page,
                'projections'    => $projections,
                'cannesClassics' => $cannesClassics,
                'selectionTabs'  => $selectionTabs,
                'next'           => $next,
            ));
        }


        $waitingPage = $this->isWaitingPage($request, 'fdc_event_movie_selection');
        if ($waitingPage) {
            return $waitingPage;
        }

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;
        if ($slug === null) {
            foreach ($pages as $page) {
                if ($page instanceof FDCPageLaSelection) {
                    if ($page->findTranslationByLocale($locale)) {
                        $slug = $page->findTranslationByLocale($locale)->getSlug();
                    }
                    if (!$slug) {
                        $page->getSelectionSection()->findTranslationByLocale($locale)->getSlug();
                    }
                    if ($slug) {
                        return $this->redirectToRoute('fdc_eventmobile_movie_selection', array('slug' => $slug));
                    }
                }
            }
            throw $this->createNotFoundException('There is not available selection.');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPageBySlug($locale, $slug)
        ;

        if (!$page || !$page->getSelectionSection()) {
            throw  $this->createNotFoundException('Page Selection not found');
        }

        $localeSlugs = $page->getLocaleSlugs();

        $next = false;
        foreach ($pages as $item) {
            if ($next) {
                $next = $item;
                break;
            }
            if ($item->getId() == $page->getId()) {
                $next = true;
            }
        }

        if ($next === true) {
            $filters = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll($locale, true)
            ;
            if ($filters) {
                $next = $filters[0];
                $nextClassics = true;
            }

        }
        if ($pages && (!$next || $next === true)) {
            $next = reset($pages);
        }

        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($festival, $locale, $page->getSelectionSection()->getId())
        ;

        $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($page, $locale);

        $cannesClassics = $this->getDoctrineManager()->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll($locale, true);

        return $this->render('FDCEventMobileBundle:Movie:selection.html.twig', array(
            'cannesClassics' => $cannesClassics,
            'selectionTabs'  => $pages,
            'page'           => $page,
            'movies'         => $movies,
            'next'           => is_object($next) ? $next : false,
            'next_classics'  => !empty($nextClassics),
            'localeSlugs'    => $localeSlugs,
        ));
    }

    /**
     * @Route("/selection/cannes-classics/{slug}")
     * @Template("FDCEventMobileBundle:Movie:classics.html.twig")
     * @param $slug
     * @return array
     */
    public function classicsAction(Request $request, $slug)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();

        $festivalId = null;
        $settings = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings != null) {
            $festival = $this->getSettings()->getFestival();
            if ($festival != null) {
                $festivalId = $festival->getId();
            }
        }
        $classic = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getBySlug($locale, $slug, $festivalId);

        if ($classic == null) {
            throw new NotFoundHttpException('Cannes Classic not found');
        }

        $localeSlugs = $classic->getLocaleSlugs();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;

        $filters = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll($locale,true);

        //SEO
        $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($classic, $locale);


        $next = null;

        foreach ($filters as $item) {
            if ($next) {
                $next = $item;
                break;
            }
            if ($item->getId() == $classic->getId()) {
                $next = true;
            }
        }
        if ($filters && (!$next || $next === true)) {
            $next = reset($filters);
        }

        return array(
            'cannesClassics' => $filters,
            'classic'        => $classic,
            'filters'        => $filters,
            'selectionTabs'  => $pages,
            'next'           => is_object($next) ? $next : false,
            'localeSlugs'   => $localeSlugs,
        );
    }

}
