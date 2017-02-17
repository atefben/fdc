<?php

namespace FDC\CourtMetrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use FDC\MarcheDuFilmBundle\Form\Type\ContactFormType;

class TransverseController extends Controller
{
    public function headerAction($routeName, $routeParams)
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
            )
        );
    }

    public function footerAction()
    {

        return $this->render(
            'FDCCourtMetrageBundle::Shared/footer.html.twig'
        );
    }
}
