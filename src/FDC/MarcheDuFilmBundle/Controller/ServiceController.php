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
        $dispatchDeServiceManager = $this->get('mdf.manager.dispatch_de_service');
        $newsManager = $this->get('mdf.manager.news');
        $contactManager = $this->get('mdf.manager.contact');

        $dispatchDeServiceContent = $dispatchDeServiceManager->getDispatchDeServiceContent();
        $dispatchDeServiceWidgets = $dispatchDeServiceManager->getDispatchDeServiceWidgets();
        $dispatchDeServiceContact = $dispatchDeServiceManager->getDispatchDeServiceContact();
        $news = $newsManager->getHomepageNews();
        $contact = $contactManager->getContactInfo();


        return $this->render('FDCMarcheDuFilmBundle:services:show.html.twig', array(
            'serviceContent' => $dispatchDeServiceContent,
            'serviceWidgets' => $dispatchDeServiceWidgets,
            'serviceContact' => $dispatchDeServiceContact,
            'news' => $news,
            'contact' => $contact
        ));
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
