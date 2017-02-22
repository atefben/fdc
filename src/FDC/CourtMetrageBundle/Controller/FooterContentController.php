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
     * @Route("/{type}", name="fdc_ccm_footer_content")
     */
    public function showAction(Request $request, $type)
    {
        $footerContentManager = $this->get('ccm.manager.footer_content');

        $pageContent = $footerContentManager->getPageContent($type);
        
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
