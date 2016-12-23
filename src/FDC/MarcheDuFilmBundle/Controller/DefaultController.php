<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $homepageManager = $this->get('mdf.manager.homepage');
        $newsManager = $this->get('mdf.manager.news');
        $contactManager = $this->get('mdf.manager.contact');

        $slidersTop = $homepageManager->getSlidersTop();
        $sliders = $homepageManager->getSliders();
        $homepageContent = $homepageManager->getHomepageContent();
//        $contentBlockSlider = $homepageManager->getContentBlockSlider();
        $news = $newsManager->getHomepageNews();
        $contact = $contactManager->getContactInfo();
        $services = $homepageManager->getHomepageServices();

        return $this->render('FDCMarcheDuFilmBundle::homepage/homepage.html.twig', array(
            'sliderTop' => $slidersTop,
            'slider' => $sliders,
            'homepageContent' => $homepageContent,
            'contentBlockSlider' => null,
            'news' => $news,
            'contact' => $contact,
            'services' => $services
        ));
    }
}
