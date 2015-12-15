<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/article")
 * Class ArticleController
 * @package FDC\EventBundle\Controller
 */
class ArticleController extends Controller
{

    /**
     * @Route("/articles")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

}
