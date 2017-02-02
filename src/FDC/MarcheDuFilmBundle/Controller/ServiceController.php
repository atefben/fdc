<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Repository\ServiceRepository;
use FOS\RestBundle\Controller\Annotations\Route;
use Sonata\AdminBundle\Tests\Datagrid\PagerTest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServiceController extends Controller
{
    /**
     * @Route("services", name="fdc_marche_du_film_services")
     */
    public function indexAction(Request $request)
    {
        $dispatchDeServiceManager = $this->get('mdf.manager.dispatch_de_service');
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');

        $dispatchDeServiceContent = $dispatchDeServiceManager->getDispatchDeServiceContent();
        $dispatchDeServiceWidgets = $dispatchDeServiceManager->getDispatchDeServiceWidgets();
        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $contact = $contactManager->getContactInfo();


        return $this->render('FDCMarcheDuFilmBundle:services:show.html.twig', array(
            'serviceContent' => $dispatchDeServiceContent,
            'serviceWidgets' => $dispatchDeServiceWidgets,
            'news' => $newsContent,
            'contact' => $contact
        ));
    }

    /**
     * @Route("services/{slug}", name="fdc_marche_du_film_services_widgets")
     */
    public function serviceAction(Request $request, $slug)
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');
        $servicesManager = $this->get('mdf.manager.services');

        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $contact = $contactManager->getContactInfo();
        $navServices = $servicesManager->getNavServices();
        $navArrowsServices = $servicesManager->getNavArrowsServices($navServices);
        $service = $servicesManager->getService($slug);

        /* If slug is not found redirect to 404 */
        if (!$service) {
            throw new NotFoundHttpException("Page not found");
        }

        $serviceWidgets = $servicesManager->getServiceWidgets($service);
        $serviceWidgetProducts = $servicesManager->getServiceWidgetProducts($serviceWidgets);

        return $this->render('FDCMarcheDuFilmBundle:services:show_service.html.twig',
            [
                'navServices' => $navServices,
                'navArrowsServices' => $navArrowsServices,
                'service' => $service,
                'serviceWidgets' => $serviceWidgets,
                'serviceWidgetProducts' => $serviceWidgetProducts,
                'news' => $newsContent,
                'contact' => $contact,
            ]);
    }
}
