<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\Date;

class HeaderController extends Controller
{

    /**
     * @Template("FDCEventBundle:Header:date.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('BaseCoreBundle:Settings')->getFestivalDate();

        if (count($settings) == 1) {
            $settings = $settings[0];
        }

        return array(
            'settings' => $settings
        );

    }

}
