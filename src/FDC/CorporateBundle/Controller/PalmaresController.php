<?php

namespace FDC\CorporateBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/69-editions/retrospective")
 */
class PalmaresController extends Controller
{
    /**
     * @Route("/{year}/palmares/{slug}")
     * @param Request $request
     * @param $year
     * @param $slug
     * @return Response
     */
    public function getAction(Request $request, $year, $slug = null)
    {
        if($year == '2017') {
            throw $this->createNotFoundException();
        }
        $this->isPageEnabled($request->get('_route'));

        $festival = $this->getFestival($year)->getId();
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();
        $locale = $request->getLocale();
        $waitingPage = null;

        try {
            $isAdmin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        } catch (\Exception $e) {
            $isAdmin = false;
        }

        $tabs = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageAward')
            ->getPages($locale)
        ;

        if ($slug === null) {
            foreach ($tabs as $page) {
                if ($page->findTranslationByLocale($locale)) {
                    $slug = $page->findTranslationByLocale($locale)->getSlug();
                }
                if ($slug) {
                    return $this->redirectToRoute('fdc_corporate_palmares_get', array('slug' => $slug, 'year' => $year));
                }

            }
            throw $this->createNotFoundException('Page palmares not found');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageAward')
            ->getPageBySlug($locale, $slug)
        ;

        if ($page === null) {
            throw $this->createNotFoundException('Page palmares not found');
        }

        // waiting page for everyone except bo domain and admin roles
        if ($page->getWaitingPage() !== null && $page->getWaitingPage()->getEnabled() === true) {
            $waitingPage = $page->getWaitingPage();
        }

        if ($isAdmin == true && isset($_SERVER) &&
            isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == 'bo.festival-cannes.com') {
            $waitingPage = null;
        }

        $localeSlugs = $page->getLocaleSlugs();

        $parameters = array(
            'pages'    => $tabs,
            'page'     => $page,
            'category' => $page->getCategory(),
            'festival' => $festival,
            'festivals' => $festivals,
            'localeSlugs' => $localeSlugs,
            'waitingPage' => $waitingPage
        );

        //SEO
        $this->get('base.manager.seo')->setFDCEventPageAwardSeo($page, $locale);

        if ($page->getId() == 1) {
            $this->competitionParameters($parameters);
        } elseif ($page->getId() == 4) {
            $this->cameraDOrParameters($parameters);
        } elseif ($page->getId() == 5) {
            $parameters['subpages'] = array();
            foreach ($tabs as $subPage) {
                if ($subPage->getId() == 1) { // competition
                    $subParameters = array(
                        'festival' => $festival,
                        'category' => $subPage->getCategory(),
                        'page'     => $subPage,

                    );
                    $this->competitionParameters($subParameters);
                    $parameters['subpages']['competition'] = $subParameters;
                } elseif ($subPage->getId() == 2) { // un certain regard
                    $subParameters = array(
                        'festival' => $festival,
                        'category' => $subPage->getCategory(),
                        'page'     => $subPage,

                    );
                    $this->defaultParameters($subParameters);
                    $parameters['subpages']['certain_regard'] = $subParameters;
                } elseif ($subPage->getId() == 3) { // cinefondation
                    $subParameters = array(
                        'festival' => $festival,
                        'category' => $subPage->getCategory(),
                        'page'     => $subPage,

                    );
                    $this->defaultParameters($subParameters);
                    $parameters['subpages']['cinefondation'] = $subParameters;
                } elseif ($subPage->getId() == 4) { // caméra d'or
                    $subParameters = array(
                        'festival' => $festival,
                        'category' => $subPage->getCategory(),
                        'page'     => $subPage,

                    );
                    $this->cameraDOrParameters($subParameters);
                    $parameters['subpages']['camera_d_or'] = $subParameters;
                }
            }
        } else {
            $this->defaultParameters($parameters);
        }
        $this->commonParameters($parameters);

        $template = 'FDCCorporateBundle:Palmares:award.html.twig';
        return $this->render($template, $parameters);

    }

    private function commonParameters(&$parameters)
    {
        $next = null;
        if (count($parameters['pages']) > 1) {
            foreach ($parameters['pages'] as $item) {
                if ($next) {
                    $next = $item;
                    break;
                }
                if ($item->getId() == $parameters['page']->getId()) {
                    $next = true;
                }
            }
            if ($next === true) {
                if ($parameters['pages'][0]->getId() !== $parameters['page']->getId()) {
                    $next = $parameters['pages'][0];
                } else {
                    $next = $parameters['pages'][1];
                }
            }
        }
        $parameters['next'] = $next;
    }

    private function defaultParameters(&$parameters)
    {
        $parameters['award_associations'] = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($parameters['festival'], $parameters['category'])
        ;
    }

    private function competitionParameters(&$parameters)
    {
        $selectionSectionId = $parameters['page']->getSelectionLongsMetrages()->getId();
        $parameters['award_associations'][$selectionSectionId] = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($parameters['festival'], $parameters['category'], $selectionSectionId)
        ;

        $selectionSectionId = $parameters['page']->getSelectioncourtsMetrages()->getId();
        $parameters['award_associations'][$selectionSectionId] = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($parameters['festival'], $parameters['category'], $selectionSectionId)
        ;
    }

    public function cameraDOrParameters(&$parameters)
    {
        $parameters['award_associations']['camerador'] = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getCameraDorWithAward($parameters['festival'])
        ;
        $competitionIds = array(
            $parameters['page']->getSelectionLongsMetrages()->getId(),
            $parameters['page']->getSelectioncourtsMetrages()->getId(),
        );
        $parameters['award_associations']['competition'] = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getPalmaresCameraDOr($parameters['festival'], $competitionIds, $parameters['award_associations']['camerador'])
        ;

        $parameters['award_associations']['others'] = array();
        foreach ($parameters['page']->getOtherSelectionSectionsAssociated() as $associated) {
            if (!$associated->getAssociation()) {
                continue;
            }
            $selectionSectionId = $associated->getAssociation()->getId();
            $movies = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->getPalmaresCameraDOr($parameters['festival'], array($selectionSectionId), $parameters['award_associations']['camerador'])
            ;
            if ($movies) {
                $parameters['award_associations']['others'][] = array(
                    'selection' => $associated->getAssociation(),
                    'movies' => $movies,
                );
            }
        }
    }
}
