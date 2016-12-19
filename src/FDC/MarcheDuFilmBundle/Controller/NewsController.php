<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/news")
 *
 * @return \Symfony\Component\HttpFoundation\Response
 */
class NewsController extends Controller
{
    public function indexAction()
    {
        $newsManager = $this->get('mdf.manager.news');

        return $this->render(
            'FDCMarcheDuFilmBundle::partials/newsBlock.html.twig',
            [
                'news' => $newsManager->getHomepageNews()
            ]
        );
    }
}
