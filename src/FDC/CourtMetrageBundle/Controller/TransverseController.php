<?php

namespace FDC\CourtMetrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner;

class TransverseController extends Controller
{
    public function headerAction($routeName, $routeParams, $locale)
    {
        $menuManager = $this->get('ccm.manager.menu');

        $menuPage = $menuManager->getMenuPage();
        $mainNavs = $menuManager->getMainNavs($menuPage);
        $subNavs = $menuManager->getSubNavs($mainNavs);

        $localeSlugs = [];
        if ($routeName == 'fdc_court_metrage_news_detail') {
            $localeSlugs = $this->get('ccm.manager.news')->getLocaleSlugsForNews($routeParams['slug']);
        }

        if ($routeName == 'fdc_court_metrage_technical_characteristics' || $routeName == 'fdc_court_metrage_regulation_detail') {
            $localeSlugs = $this->get('ccm.manager.participate')->getLocaleSlugsForParticipateRegisterProcedure($routeParams['slug']);
        }

        if ($routeName == 'fdc_court_metrage_participer_page') {
            $localeSlugs = $this->get('ccm.manager.participate')->getLocaleSlugsForParticipatePage($routeParams['slug']);
        }

        if ($routeName == 'fdc_court_metrage_sfc_who_are_we') {
            $localeSlugs = $this->get('ccm.manager.sfc')->getLocaleSlugsForSFC($routeParams['slug'], CcmShortFilmCorner::TYPE_WHO_ARE_WE, $locale);
        }

        if ($routeName == 'fdc_court_metrage_sfc_our_events') {
            $localeSlugs = $this->get('ccm.manager.sfc')->getLocaleSlugsForSFC($routeParams['slug'], CcmShortFilmCorner::TYPE_OUR_EVENTS, $locale);
        }

        if ($routeName == 'fdc_court_metrage_sfc_relive_edition') {
            $localeSlugs = $this->get('ccm.manager.sfc')->getLocaleSlugsForSFC($routeParams['slug'], CcmShortFilmCorner::TYPE_RELIVE_EDITION, $locale);
        }

        return $this->render('FDCCourtMetrageBundle::Shared/header.html.twig', array(
                'menuPage' => $menuPage,
                'mainNavs' => $mainNavs,
                'subNavs' => $subNavs,
                'routeName' => $routeName,
                'routeParams' => $routeParams,
                'route_params' => $routeParams,
                'localeSlugs' => $localeSlugs
            )
        );
    }

    public function footerAction()
    {

        return $this->render(
            'FDCCourtMetrageBundle::Shared/footer.html.twig'
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function actualiteAction()
    {
        $homepageManger = $this->get('ccm.manager.homepage');
        $actualites = $homepageManger->getHomepageActualite();

        return $this->render(
            'FDCCourtMetrageBundle::homepage/_actualite.html.twig',
            [
                'actualites' => $actualites,
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function catalogAction()
    {
        $homepageManger = $this->get('ccm.manager.homepage');
        $catalogs = $homepageManger->getCatalogPushes();
        $catalogImage = $homepageManger->getCatalogImage();

        return $this->render(
            'FDCCourtMetrageBundle::homepage/_catalog.html.twig',
            [
                'catalogs' => $catalogs,
                'catalogImage' => $catalogImage,
            ]
        );
    }
}
