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
        $contact = $em->getRepository('BaseCoreBundle:ContactPage')->findOneById($this->getParameter('admin_press_contact_id'));

        if ( empty($contact) ) {
            throw new NotFoundHttpException();
        }

        return array(
            'pressContact' => $contact
        );

    }

}
