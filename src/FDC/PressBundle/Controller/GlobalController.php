<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/")
 */
class GlobalController extends Controller
{

    /**
     * @Route("/press-contact")
     * @Template("FDCPressBundle:Global:contact.html.twig")
     * @return array
     * @throws NotFoundHttpException
     */
    public function contactAction()
    {

        $em = $this->getDoctrine()->getManager();

        // GET FDC SETTINGS
        $contactPage = array();
        $contact = $em->getRepository('BaseCoreBundle:ContactPage')->findAll();

        if ( empty($contact) ) {
            throw new NotFoundHttpException();
        }
        else {
            $contactPage = $contact[0];
        }

        return array(
            'pressContact' => $contactPage
        );

    }

}
