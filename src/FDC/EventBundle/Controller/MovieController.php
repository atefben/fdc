<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\FDCPageLaSelection;
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

class MovieController extends Controller
{

    /**
     * @Route("/archives/ficheFilm/id/{id}.html")
     * @Route("/archives/ficheFilm/id/{id}/year/{year}.html")
     */
    public function archiveGetAction(Request $request, $id, $year = null)
    {

        $locale = $request->getLocale();
        if ($request->getLocale() == 'cn') {
            $locale = 'zh';
        }

        $movie = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->find($id)
        ;

        if (!$movie) {
            $oldFilmAssoc = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:OldFilmsassoc')
                ->findOneBy(['idselfkit' => $id])
            ;

            if ($oldFilmAssoc) {
                $movie = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:FilmFilm')
                    ->find($oldFilmAssoc->getIdSoif())
                ;
            }
        }

        if (!$movie) {
            throw $this->createNotFoundException("Artist $id not found");
        }

        return $this->redirectToRoute('fdc_corporate_movie_get', ['_locale' => $locale, 'slug' => $movie->getSlug()], 301);
    }

    /**
     * @Route("/films/{slug}")
     * @param $slug
     * @param Request $request
     * @return Response
     */
    public function getAction(Request $request, $slug)
    {
        $locale = $request->getLocale();

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

        return $this->render('FDCEventBundle:Movie:main.html.twig', [
            'movies'             => $movies,
            'movie'              => $movie,
            'articles'           => $articles,
            'prev'               => $prev,
            'next'               => $next,
            'nextProjectionDate' => $nextProjectionDate,
        ]);
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

    protected function isPublished($article, $locale)
    {
        $translation = $article->findTranslationByLocale($locale);
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

    /**
     * @Route("/selection/{slug}")
     * @param Request $request
     * @param $slug
     * @return Response
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

            $cannesClassics = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
                ->getAll($locale, $festival, true)
            ;
            //SEO
            $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($page, $locale);

            return $this->render('FDCEventBundle:Movie:cinema_plage.html.twig', [
                'page'           => $page,
                'projections'    => $projections,
                'cannesClassics' => $cannesClassics,
                'selectionTabs'  => $selectionTabs,
                'next'           => $next,
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
                        return $this->redirectToRoute('fdc_event_movie_selection', ['slug' => $slug]);
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
                ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
                ->getAll($locale, $festival, true)
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

        $cannesClassics = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
            ->getAll($locale, $festival, true)
        ;

        return $this->render('FDCEventBundle:Movie:selection.html.twig', [
            'cannesClassics' => $cannesClassics,
            'selectionTabs'  => $pages,
            'page'           => $page,
            'movies'         => $movies,
            'next'           => is_object($next) ? $next : false,
            'next_classics'  => !empty($nextClassics),
            'localeSlugs'    => $localeSlugs,
        ]);
    }

    /**
     * @Route("/selection/cannes-classics/{slug}")
     * @Template("FDCEventBundle:Movie:classics.html.twig")
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function classicsAction(Request $request, $slug)
    {
        $locale = $request->getLocale();
        $festival = $this->getFestival();


        $classic = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
            ->getBySlug($locale, $slug, $festival)
        ;

        if ($classic == null) {
            throw new NotFoundHttpException('Cannes Classic not found');
        }

        $localeSlugs = $classic->getLocaleSlugs();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;

        $filters = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
            ->getAll($locale, $festival, true)
        ;

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
        ];
    }

}
