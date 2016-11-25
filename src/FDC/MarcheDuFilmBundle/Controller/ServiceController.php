<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Repository\ServiceRepository;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends Controller
{
    /**
     * @Route("service/{slug}")
     */
    public function indexAction(Request $request, $slug)
    {
        $locale = $request->getLocale();
        $service = $this->getServiceRepository()->getOnePublished($locale, $slug);

        return $this->render('FDCMarcheDuFilmBundle:Service:show.html.twig', ['service' => $service]);
    }

    /**
     * @return ServiceRepository
     */
    protected function getServiceRepository()
    {
        return $this->getDoctrine()->getRepository('FDCMarcheDuFilmBundle:Service');
    }
}
