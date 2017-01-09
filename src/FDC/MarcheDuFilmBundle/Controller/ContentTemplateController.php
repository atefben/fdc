<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContentTemplateController extends Controller
{
    /**
     * @Route("presentation", name="fdc_marche_du_film_edition_presentation")
     * @Route("projections", name="fdc_marche_du_film_edition_projections")
     * @Route("industryprogram", name="fdc_marche_du_film_industry_program_home")
     * @Route("quisommesnous/historique", name="fdc_marche_du_film_who_are_we_history")
     * @Route("quisommesnous/chiffrescles", name="fdc_marche_du_film_who_are_we_key_figures")
     * @Route("quisommesnous/demarchesenvironnementales", name="fdc_marche_du_film_who_are_we_environmental_approaches")
     * @Route("mentionslegales", name="fdc_marche_du_film_legal_mentions")
     */
    public function indexAction()
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');

        $request = $this->container->get('request');
        $routeName = $request->get('_route');

        return $this->render('FDCMarcheDuFilmBundle:contentTemplate:contentTemplate.html.twig', $contentTemplateManager->getPageData($routeName));
    }
}
