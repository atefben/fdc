<?php

namespace FDC\CorporateBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/press")
 */
class PressController extends Controller
{
    /**
     * @Route("/")
     * @param Request $request
     * @return Response
     */
    public function showAction(Request $request)
    {
        die('press');
    }
}
