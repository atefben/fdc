<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContentTemplateController extends Controller
{
    /**
     * @Route("presentation", name="fdc_marche_du_film_presentation")
     */
    public function indexAction(Request $request)
    {
        return $this->render('FDCMarcheDuFilmBundle:contentTemplate:editionPresentation.html.twig');
    }
}