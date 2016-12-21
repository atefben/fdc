<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Repository\ServiceRepository;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends Controller
{
    /**
     * @Route("services", name="fdc_marche_du_film_services")
     */
    public function indexAction(Request $request)
    {
        return $this->render('FDCMarcheDuFilmBundle:services:show.html.twig');
    }

    /**
     * @Route("services/{slug}")
     */
    public function serviceAction(Request $request, $slug)
    {
        $locale = $request->getLocale();
        $service = $this->getServiceRepository()->getOnePublished($locale, $slug);

        return $this->render('FDCMarcheDuFilmBundle:services:show_service.html.twig', ['service' => $service]);
    }

    /**
     * @return ServiceRepository
     */
    protected function getServiceRepository()
    {
        return $this->getDoctrine()->getRepository('FDCMarcheDuFilmBundle:Service');
    }
}
