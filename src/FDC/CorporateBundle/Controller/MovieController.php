<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\FilmProjectionProgrammationFilm;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsAudio;
use Base\CoreBundle\Entity\NewsVideo;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/")
 */
class MovieController extends Controller
{
    /**
     * @Route("/films/{slug}")
     * @param $slug
     * @param Request $request
     * @return Response
     */
    public function getAction(Request $request, $slug)
    {
        $locale = $request->getLocale();
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        $movie = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->findOneBy([
                'slug' => $slug,
            ])
        ;

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

        $articles = [];
        $articlesIds = [];
        foreach ($movie->getAssociatedNews() as $associatedNews) {
            if ($associatedNews->getNews()) {
                $article = $associatedNews->getNews();
                if ($article->getPublishedAt() && $this->isPublished($article, $locale) && $article->findTranslationByLocale('fr')->getIsPublishedOnFDCEvent()) {
                    if ($article instanceof NewsAudio) {
                        if ($article->getAudio()->getDisplayedHome()) {
                            continue;
                        }
                    }
                    if ($article instanceof NewsVideo) {
                        if ($article->getVideo()->getDisplayedHome()) {
                            continue;
                        }
                    }
                    if ($this->isNewsPublished($article, $locale)) {
                        $key = $article->getPublishedAt()->getTimestamp();
                        $articles[$key] = $article;
                        $articlesIds[] = $article->getId();
                    }
                }
            }
        }

        foreach ($movie->getNews() as $news) {
            if (!in_array($news->getId(), $articlesIds)) {
                if ($news instanceof NewsAudio) {
                    if ($news->getAudio()->getDisplayedHome()) {
                        continue;
                    }
                }
                if ($news instanceof NewsVideo) {
                    if ($news->getVideo()->getDisplayedHome()) {
                        continue;
                    }
                }
                if ($this->isNewsPublished($news, $locale)) {
                    $key = $news->getPublishedAt()->getTimestamp();
                    $articles[$key] = $news;
                    $articlesIds[] = $news->getId();
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
        $projections = [];
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

        return $this->render('FDCCorporateBundle:Movie:main.html.twig', [
            'movies'             => $movies,
            'movie'              => $movie,
            'articles'           => $articles,
            'prev'               => $prev,
            'next'               => $next,
            'nextProjectionDate' => $nextProjectionDate,
            'festivals'          => $festivals,
        ]);
    }

    protected function isPublished($article, $locale)
    {
        $translation = $article->findTranslationByLocale($locale);
        if (!$translation) {
            return false;
        }
        if ($locale == 'fr') {
            if ($translation->getStatus() === NewsArticleTranslation::STATUS_PUBLISHED) {
                return true;
            }
        } else {
            $fr = $article->findTranslationByLocale($locale);
            $translated = NewsArticleTranslation::STATUS_TRANSLATED;
            if ($fr->getStatus() === $translated) {
                return true;
            }
        }
    }

    protected function isNewsPublished(News $news = null, $locale)
    {
        if ($news) {
            $now = new \DateTime();
            $isPublished = $news->getPublishedAt() && $news->getPublishedAt() <= $now;
            $isPublished = $isPublished && ($news->getPublishEndedAt() === null || $news->getPublishEndedAt() >= $now);
            if ($isPublished) {
                $fr = $news->findTranslationByLocale('fr');
                if ($fr && $fr->getStatus() === TranslateChildInterface::STATUS_PUBLISHED) {
                    if ($locale != 'fr') {
                        $trans = $news->findTranslationByLocale($locale);
                        if ($trans && $trans->getStatus() === TranslateChildInterface::STATUS_TRANSLATED) {
                            return true;
                        }
                    } else {
                        return true;
                    }
                }
            }
        }
    }

    /**
     * @Route("/69-editions/retrospective/{year}/selection/{slug}", requirements={"year" = "\d+"})
     * @param Request $request
     * @param $slug
     * @return Response
     */
    public function selectionAction(Request $request, $slug = null, $year)
    {
        $locale = $request->getLocale();
        $festival = $this->getFestival($year);
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();


        $this->isPageEnabled($request->get('_route'));

        if ($slug == 'cinema-de-la-plage') {
            $page = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FDCPageLaSelectionCinemaPlage')
                ->getBySlug($locale, 'cinema-de-la-plage')
            ;

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

            $selectionSectionTranslation = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmSelectionSectionTranslation')
                ->findOneBy(['locale' => 'fr', 'name' => 'Cinéma de la plage'])
            ;

            $movies = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->getFilmsBySelectionSection($festival, $locale, $selectionSectionTranslation->getTranslatable()->getId())
            ;

            // NEXT SELECTION
            $next = null;
            if (count($selectionTabs) > 0) {
                $next = $selectionTabs[0];
            }

            $cannesClassics = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
                ->getAll($request->getLocale(), $this->getFestival($year))
            ;

            //SEO
            $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($page, $locale);

            return $this->render('FDCCorporateBundle:Movie:cinema_plage.html.twig', [
                'page'            => $page,
                'cinemaDeLaPlage' => $page,
                'projections'     => $projections,
                'movies'     => $movies,
                'cannesClassics'  => $cannesClassics,
                'selectionTabs'   => $selectionTabs,
                'next'            => $next,
                'festivals'       => $festivals,
            ]);
        }


        $waitingPage = $this->isWaitingPage($request);
        if ($waitingPage) {
            return $waitingPage;
        }

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;

        $selectionTabs = [];
        $defaultSlug = null;
        foreach ($pages as $p) {
            $movies = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->getFilmsBySelectionSection($festival, $locale, $p->getSelectionSection()->getId())
            ;
            if ($defaultSlug === null) {
                $defaultSlug = $p->getSelectionSection()->findTranslationByLocale($locale)->getSlug();
            }
            if (count($movies)) {
                $selectionTabs[] = $p;
            }
        }

        if ($slug === null) {
            return $this->redirectToRoute('fdc_corporate_movie_selection', ['slug' => $defaultSlug, 'year' => $year]);
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
                ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
                ->getAll($request->getLocale(), $this->getFestival($year))
            ;
            if ($filters) {
                $next = $filters[0];
                $nextClassics = true;
            }

        }
        if ($selectionTabs && (!$next || $next === true)) {
            $next = reset($pages);
        }

        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($festival, $locale, $page->getSelectionSection()->getId())
        ;

        $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($page, $locale);

        $cannesClassics = null;
        $selectionSectionTrans = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmSelectionSectionTranslation')
            ->findOneBy(['name' => 'Cannes Classics', 'locale' => 'fr'])
        ;
        if ($selectionSectionTrans) {
            $temp = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->getFilmsBySelectionSection($festival, $locale, $selectionSectionTrans->getTranslatable()->getId())
            ;
            if (count($temp)) {
                $cannesClassics = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
                    ->getAll($request->getLocale(), $this->getFestival($year))
                ;
            }
        }

        $cinemaDelaPlage = false;
        $selectionSectionTrans = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmSelectionSectionTranslation')
            ->findOneBy(['name' => 'Cinéma de la plage', 'locale' => 'fr'])
        ;
        if ($selectionSectionTrans) {
            $temp = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->getFilmsBySelectionSection($festival, $locale, $selectionSectionTrans->getTranslatable()->getId())
            ;
            if (count($temp)) {
                $cinemaDelaPlage = true;
            }
        }


        return $this->render('FDCCorporateBundle:Movie:selection.html.twig', [
            'cannesClassics'  => $cannesClassics,
            'cinemaDeLaPlage' => $cinemaDelaPlage,
            'selectionTabs'   => $selectionTabs,
            'page'            => $page,
            'movies'          => $movies,
            'next'            => is_object($next) ? $next : false,
            'next_classics'   => !empty($nextClassics),
            'localeSlugs'     => $localeSlugs,
            'festivals'       => $festivals,
        ]);
    }

    /**
     * @Route("/69-editions/retrospective/{year}/selection/cannes-classics/{slug}")
     * @Template("FDCCorporateBundle:Movie:classics.html.twig")
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function classicsAction(Request $request, $slug, $year)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        $classic = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getBySlug($locale, $slug, $this->getFestival($year));

        if ($classic == null) {
            throw new NotFoundHttpException('Cannes Classic not found');
        }

        $localeSlugs = $classic->getLocaleSlugs();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;

        $filters = $this->getDoctrineManager()->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll($request->getLocale(), $this->getFestival($year));

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

        return [
            'cannesClassics' => $filters,
            'classic'        => $classic,
            'filters'        => $filters,
            'selectionTabs'  => $pages,
            'next'           => is_object($next) ? $next : false,
            'localeSlugs'    => $localeSlugs,
            'festivals'      => $festivals,
        ];
    }
}
