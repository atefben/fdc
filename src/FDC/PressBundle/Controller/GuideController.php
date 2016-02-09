<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/")
 */
class GuideController extends Controller
{

    /**
     * @Route("/guide")
     * @Template("FDCPressBundle:Guide:main.html.twig")
     * @return array
     */
    public function mainAction()
    {
        $em = $this->getDoctrine()->getManager();
        // GET GUIDE PAGE
        $guide = $em->getRepository('BaseCoreBundle:PressGuide')->findOneById(9);

        if ($guide === null) {
            throw new NotFoundHttpException();
        }

        $headerInfo = array(
            'title' => 'Guide pratique',
            'description' => ''
        );

        return array(
            'headerInfo' => $headerInfo,
            'guideContent' => $guide,
        );

    }
}
