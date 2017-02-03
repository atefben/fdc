<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Repository\ServiceRepository;
use FOS\RestBundle\Controller\Annotations\Route;
use Sonata\AdminBundle\Tests\Datagrid\PagerTest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InfoController extends Controller
{
    /**
     * @Route("infos-utiles", name="fdc_marche_du_film_infos_utiles")
     */
    public function informationAction(Request $request)
    {
        $infoManager = $this->get('mdf.manager.info_utiles');
        
        $infoRubriques = $infoManager->getRubriques();
        if (!$infoRubriques) {
            throw new NotFoundHttpException("Page not found");
        }
        $infoQuestionsAnswers = $infoManager->getQuestionsAnswers($infoRubriques);
        
        return $this->render('FDCMarcheDuFilmBundle:information:infoUtiles.html.twig', array(
                'infoRubriques' => $infoRubriques,
                'infoQuestionsAnswers' => $infoQuestionsAnswers
            )
        );
    }
}
