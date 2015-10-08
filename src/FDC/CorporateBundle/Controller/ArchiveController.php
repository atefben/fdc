<?php

namespace FDC\CorporateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArchiveController extends Controller
{
    /**
     * @Route("/archives")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
