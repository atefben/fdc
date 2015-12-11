<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class JuryController extends Controller
{
    /**
     * @Route("/juries")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}