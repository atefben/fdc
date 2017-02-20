<?php

namespace FDC\CourtMetrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use FDC\MarcheDuFilmBundle\Form\Type\ContactFormType;

class ProsController extends Controller
{

    /**
     * @Route("/pros-du-court", name="fdc_ccm_pros_du_court")
     * @param Request $request
     */
    public function showAction(Request $request)
    {
        $prosManager = $this->get('ccm.manager.pros');
        
        $prosPage = $prosManager->getProsPageByLocale();
        $prosList = $prosManager->getProsByLocale();
        $prosDomains = $prosManager->getDomains($prosList);
        $hasSFC = $prosManager->hasSFC($prosList);
        
        return $this->render('FDCCourtMetrageBundle:Pros:show.html.twig', [
                'prosPage' => $prosPage,
                'prosList' => $prosList,
                'prosDomains' => $prosDomains,
                'hasSFC' => $hasSFC,
            ]
        );
    }
}
