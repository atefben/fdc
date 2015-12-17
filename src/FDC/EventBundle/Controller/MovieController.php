<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class MovieController extends Controller
{

    /**
     * @Route("/movie/{slug}")
     * @Template("FDCEventBundle:Movie:movie.main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction($slug)
    {

        return array();
    }

    /**
     * @Route("/selection/{slug}")
     * @Template("FDCEventBundle:Movie:movie.selection.html.twig")
     * @param $slug
     * @return array
     */
    public function selectionAction($slug)
    {

        return array();
    }
}
