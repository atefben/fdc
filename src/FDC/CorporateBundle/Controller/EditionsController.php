<?php

namespace FDC\CorporateBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/69-editions")
 */
class EditionsController extends Controller
{
    /**
     * @Route("/retrospective")
     * @Template("FDCCorporateBundle:Retrospective:years_slider.html.twig")
     */
    public function retrospectiveAction()
    {
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        return array('festivals' => $festivals);
    }



    /**
     * @Route("/retrospective/{year}", requirements={"year" = "\d+"})
     * @Template("FDCCorporateBundle:Retrospective:year.html.twig")
     */
    public function yearAction($year)
    {
        $festival = $this->getFestival($year);

        return array('festival' => $festival);
    }

    /**
     * @Route("/retrospective/{year}/affiche", requirements={"year" = "\d+"})
     * @Template("FDCCorporateBundle:Retrospective:affiche.html.twig")
     * @param Request $request
     * @param $year
     * @return array
     */
    public function afficheAction(Request $request, $year)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $festival = $this->getFestival($year);
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        $posters = $em->getRepository('BaseCoreBundle:FilmFestivalPoster')
            ->findByFestival($festival);

        return array('posters' => $posters, 'festivals' => $festivals);
    }

    /**
     * @Route("/retrospective/{year}/selection/{slug}", requirements={"year" = "\d+"})
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function selectionAction(Request $request, $slug = null, $year)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $festival = $this->getFestival($year);
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();


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
                ->getPagesOrdoredBySelectionSectionOrder($locale, $festival)
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

            return $this->render('FDCCorporateBundle:Movie:cinema_plage.html.twig', array(
                'page'           => $page,
                'projections'    => $projections,
                'cannesClassics' => $cannesClassics,
                'selectionTabs'  => $selectionTabs,
                'next'           => $next,
                'festivals'      => $festivals
            ));
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

        return $this->render('FDCCorporateBundle:Movie:selection.html.twig', array(
            'cannesClassics' => $cannesClassics,
            'selectionTabs'  => $pages,
            'page'           => $page,
            'movies'         => $movies,
            'next'           => is_object($next) ? $next : false,
            'next_classics'  => !empty($nextClassics),
            'localeSlugs'    => $localeSlugs,
            'festivals'      => $festivals
        ));
    }

    /**
     * @Route("/retrospective/{year}/selection/cannes-classics/{slug}")
     * @Template("FDCCorporateBundle:Movie:classics.html.twig")
     * @param $year
     * @param $slug
     * @return array
     */
    public function classicsAction(Request $request, $slug)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        $classic = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getBySlug($locale, $slug);

        if ($classic == null) {
            throw new NotFoundHttpException('Cannes Classic not found');
        }

        $localeSlugs = $classic->getLocaleSlugs();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;

        $filters = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll($locale, true);

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
            'localeSlugs'    => $localeSlugs,
            'festivals'      => $festivals
        );
    }

    /**
     * @Route("/retrospective/{year}/juries/{slug}", requirements={"year" = "\d+"})
     * @Template("FDCCorporateBundle:Jury:section.html.twig")
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function juriesAction(Request $request, $year = null, $slug = null)
    {
        $this->isPageEnabled($request->get('_route'));
        $festival = $this->getFestival($year)->getId();
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();
        $locale = $request->getLocale();

        $waitingPage = $this->isWaitingPage($request);
        if ($waitingPage) {
            return $waitingPage;
        }

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageJury')
            ->getPages($locale)
        ;

        if ($slug === null) {
            foreach ($pages as $page) {
                if ($page->findTranslationByLocale($locale)) {
                    $slug = $page->findTranslationByLocale($locale)->getSlug();
                }
                if ($slug) {
                    return $this->redirectToRoute('fdc_corporate_editions_juries', array('slug' => $slug));
                }

            }
            throw $this->createNotFoundException('Page Jury not found');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageJury')
            ->getPageBySlug($locale, $slug)
        ;

        if ($page == null) {
            throw new NotFoundHttpException("Page Jury {$slug} not found");
        }

        $localeSlugs = $page->getLocaleSlugs();

        //SEO
        $this->get('base.manager.seo')->setFDCEventPageJurySeo($page, $locale);

        // find all juries by type
        $juries = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmJury')
            ->getJurysByType($festival, $locale, $page->getJuryType()->getId())
        ;

        $members = array();
        $president = null;
        $hasPresident = false;
        foreach ($juries as $jury) {
            $filmMedia = null;
            if ($jury->getMedias()->count()) {
                foreach ($jury->getMedias() as $media) {
                    $filmMedia = $media;
                }
            }
            if (!$filmMedia && $jury->getPerson() && $jury->getPerson()->getMedias()->count()) {
                foreach ($jury->getPerson()->getMedias() as $media) {
                    $filmMedia = $media->getMedia();
                }
            }
            if (!$hasPresident && in_array($jury->getFunction()->getId(), array(1, 4))) {
                $president = array(
                    'jury'       => $jury,
                    'film_media' => $filmMedia,
                );
                $hasPresident = true;
            } else {
                array_push($members, array(
                    'jury'       => $jury,
                    'film_media' => $filmMedia,
                ));
            }
        }

        $next = null;
        if (count($pages) > 1) {
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
                if ($pages[0]->getId() !== $page->getId()) {
                    $next = $pages[0];
                } else {
                    $next = $pages[1];
                }
            }
        }

        return array(
            'page'      => $page,
            'pages'     => $pages,
            'next'      => is_object($next) ? $next : false,
            'members'   => $members,
            'president' => $president,
            'localeSlugs' => $localeSlugs,
            'festivals'      => $festivals
        );

    }
}
