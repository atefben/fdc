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
        $festival = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findOneByYear($year);

        return array('festival' => $festival);
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

        return $this->render('FDCEventBundle:Movie:selection.html.twig', array(
            'cannesClassics' => $cannesClassics,
            'selectionTabs'  => $pages,
            'page'           => $page,
            'movies'         => $movies,
            'next'           => is_object($next) ? $next : false,
            'next_classics'  => !empty($nextClassics),
            'localeSlugs'    => $localeSlugs,
        ));
    }
}
