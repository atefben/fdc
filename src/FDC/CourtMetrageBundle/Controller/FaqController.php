<?php

namespace FDC\CourtMetrageBundle\Controller;

use FDC\MarcheDuFilmBundle\Repository\ServiceRepository;
use FOS\RestBundle\Controller\Annotations\Route;
use Sonata\AdminBundle\Tests\Datagrid\PagerTest;
use FDC\CourtMetrageBundle\Component\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FaqController extends Controller
{
    /**
     * @Route("faq", name="fdc_courtmetrage_faq")
     */
    public function faqAction(Request $request)
    {
        $faqManager = $this->get('ccm.manager.faq');
        
        $faqRubriques = $faqManager->getRubriques();
        if (!$faqRubriques) {
            throw new NotFoundHttpException("Page not found");
        }
        $faqQuestionsAnswers = $faqManager->getQuestionsAnswers($faqRubriques);
        
        return $this->render('FDCCourtMetrageBundle:faq:index.html.twig', array(
                'faqRubriques' => $faqRubriques,
                'faqQuestionsAnswers' => $faqQuestionsAnswers
            )
        );
    }
}
