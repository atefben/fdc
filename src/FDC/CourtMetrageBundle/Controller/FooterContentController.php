<?php

namespace FDC\CourtMetrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class FooterContentController
 * @package FDC\CourtMetrageBundle\Controller
 */
class FooterContentController extends Controller
{
    /**
     * Retrieve data for Mentions Légales / Crédits / Politique de confidentialité page
     * @param Request $request
     *
     * @Route("/mentions-legales", name="fdc_ccm_footer_mentions_legales")
     * @Route("/credits", name="fdc_ccm_footer_credits")
     * @Route("/politique-de-confidentialite", name="fdc_ccm_footer_politique_de_confidentialite")
     */
    public function showAction(Request $request)
    {
        $footerContentManager = $this->get('ccm.manager.footer_content');
        $routeName = $request->get('_route');
        $pageContent = $footerContentManager->getPageContent($routeName);
        
        if (!$pageContent) {
            throw new NotFoundHttpException();
        }
        
        $pageDescription = $footerContentManager->getPageDescription($pageContent);
        
        return $this->render('FDCCourtMetrageBundle:Footer:footerContentPage.html.twig', [
                'pageContent' => $pageContent,
                'pageDescription' => $pageDescription,
            ]
        );
    }
}
