<?php

namespace FDC\EventBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/mobile")
 */
class MobileController extends Controller
{

    /**
     * @Route("/")
     * @Template("FDCEventBundle:Mobile:main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $festival = $this->getFestival();

        return array();
    }
}
