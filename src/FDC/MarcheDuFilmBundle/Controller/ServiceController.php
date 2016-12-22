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
        $news = $newsManager->getHomepageNews();
        $contact = $contactManager->getContactInfo();


        return $this->render('FDCMarcheDuFilmBundle:services:show.html.twig', array(
            'serviceContent' => $dispatchDeServiceContent,
            'serviceWidgets' => $dispatchDeServiceWidgets,
            'news' => $news,
            'contact' => $contact
        ));
    }

    /**
     * @Route("services/{slug}")
     */
    public function serviceAction(Request $request, $slug)
    {
        $newsManager = $this->get('mdf.manager.news');
        $contactManager = $this->get('mdf.manager.contact');

        $news = $newsManager->getHomepageNews();
        $contact = $contactManager->getContactInfo();

        $locale = $request->getLocale();
        $service = $this->getServiceRepository()->getOnePublished($locale, $slug);

        return $this->render('FDCMarcheDuFilmBundle:services:show_service.html.twig',
            [
                'service' => $service,
                'news' => $news,
                'contact' => $contact,
            ]);
    }

    /**
     * @return ServiceRepository
     */
    protected function getServiceRepository()
    {
        return $this->getDoctrine()->getRepository('FDCMarcheDuFilmBundle:Service');
    }
}
