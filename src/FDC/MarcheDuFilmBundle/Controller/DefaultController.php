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

        $slidersTop = $homepageManager->getSlidersTop();
        $sliders = $homepageManager->getSliders();
        $contentBlock = $homepageManager->getContentBlock();
        $contentBlockSlider = $homepageManager->getContentBlockSlider();
        $news = $newsManager->getHomepageNews();

        return $this->render('FDCMarcheDuFilmBundle::homepage/homepage.html.twig', array(
            'sliderTop' => $slidersTop,
            'slider' => $sliders,
            'contentBlock' => $contentBlock,
            'contentBlockSlider' => $contentBlockSlider,
            'news' => $news
        ));
    }
}
