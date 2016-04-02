<?php

namespace FDC\EventBundle\Controller;

use \DateTime;

use Base\CoreBundle\Entity\FDCPageLaSelection;

use FDC\EventBundle\Component\Controller\Controller;

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
     * @Template("FDCEventBundle:Movie:main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction(Request $request, $slug)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $isAdmin  = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

        // GET MOVIE
        if ($isAdmin) {
            $movie = $em->getRepository('BaseCoreBundle:FilmFilm')->findOneBy(array(
                'slug' => $slug
            ));
        } else {
            $movie = $em->getRepository('BaseCoreBundle:FilmFilm')->findOneBy(array(
                'slug' => $slug,
                'festival' => $this->getFestival()
            ));

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
                    $prev = $movies[$key - 1];
                    $next = $movies[$key + 1];
                }
                break;
            }
        }

        return array(
            'movies' => $movies,
            'movie'  => $movie,
            'prev' => $prev,
            'next' => $next
        );
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

            // NEXT SELECTION
            $next = null;
            if (count($selectionTabs) > 0) {
                $next = $selectionTabs[0];
            }

            $cannesClassics = $this->getDoctrineManager()->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll();

            //SEO
            $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($page, $locale);

            return $this->render('FDCEventBundle:Movie:cinema_plage.html.twig', array(
                'page' => $page,
                'cannesClassics' => $cannesClassics,
                'selectionTabs' => $selectionTabs,
                'next' => $next
            ));
        }

        $this->isPageEnabled($request->get('_route'));
        $locale = $request->getLocale();
        $festival = $this->getFestival()->getId();

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
                        return $this->redirectToRoute('fdc_event_movie_selection', array('slug' => $slug));
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
        if (!$next) {
            $next = reset($pages);
        }

        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($festival, $locale, $page->getSelectionSection()->getId())
        ;

        $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($page, $locale);

        $cannesClassics = $this->getDoctrineManager()->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll();

        return $this->render('FDCEventBundle:Movie:selection.html.twig', array(
            'cannesClassics' => $cannesClassics,
            'selectionTabs' => $pages,
            'page'          => $page,
            'movies'        => $movies,
            'next'          => is_object($next) ? $next : false,
        ));
    }

    /**
     * @Route("/selection/cannes-classics/{slug}")
     * @Template("FDCEventBundle:Movie:classics.html.twig")
     * @param $slug
     * @return array
     */
    public function classicsAction(Request $request, $slug)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();

        $classic = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getBySlug($locale, $slug);

        if ($classic == null) {
            throw new NotFoundHttpException('Cannes Classic not found');
        }

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;

        $filters = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll();

        //SEO
        $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($classic, $locale);

        return array(
            'cannesClassics' => $filters,
            'classic' => $classic,
            'filters' => $filters,
            'selectionTabs' => $pages
        );
    }
}
