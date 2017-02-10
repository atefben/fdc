<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfSitePlanTranslation;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="fdc_marche_du_film_homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $homepageManager = $this->get('mdf.manager.homepage');
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');

        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $slidersTop = $homepageManager->getSlidersTop();
        $sliders = $homepageManager->getSliders();
        $homepageContent = $homepageManager->getHomepageContent();
        $contact = $contactManager->getContactInfo();
        $services = $homepageManager->getHomepageServices();

        return $this->render('FDCMarcheDuFilmBundle::homepage/homepage.html.twig', array(
            'sliderTop' => $slidersTop,
            'slider' => $sliders,
            'homepageContent' => $homepageContent,
            'news' => $newsContent,
            'contact' => $contact,
            'services' => $services
        ));
    }

    /**
     * @Route("/plan-du-site", name="fdc_marche_du_film_site_plan")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sitePlanAction()
    {
        $sitePlanManager = $this->get('mdf.manager.site_plan');

        $sitePlanPage = $sitePlanManager->getSitePlanPage();

        if (!$sitePlanPage) {
            throw new NotFoundHttpException('Page Not Found');
        }

        $servicesPages = $sitePlanManager->getServicesPages();

        return $this->render('FDCMarcheDuFilmBundle::sitePlan/sitePlan.html.twig', array(
            'sitePlanPage' => $sitePlanPage,
            'servicesPages' => $servicesPages
        ));
    }
}
