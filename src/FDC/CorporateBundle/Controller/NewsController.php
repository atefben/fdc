<?php

namespace FDC\CorporateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class NewsController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function homeAction()
    {
        return array();
    }
}
