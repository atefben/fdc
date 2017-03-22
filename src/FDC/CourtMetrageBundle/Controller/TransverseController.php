<?php

namespace FDC\CourtMetrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use FDC\MarcheDuFilmBundle\Form\Type\ContactFormType;

class TransverseController extends Controller
{
    public function headerAction($routeName, $routeParams, $route_params)
    {
        $menuManager = $this->get('ccm.manager.menu');

        $menuPage = $menuManager->getMenuPage();
        $mainNavs = $menuManager->getMainNavs($menuPage);
        $subNavs = $menuManager->getSubNavs($mainNavs);

        return $this->render('FDCCourtMetrageBundle::Shared/header.html.twig', array(
                'menuPage' => $menuPage,
                'mainNavs' => $mainNavs,
                'subNavs' => $subNavs,
                'routeName' => $routeName,
                'routeParams' => $routeParams,
                'route_params' => $routeParams,
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