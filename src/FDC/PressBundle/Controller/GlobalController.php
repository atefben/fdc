<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;


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

    /**
     * @Route("/programmation/day-projections", options={"expose"=true}))
     * @Template("FDCEventBundle:Global:projection.html.twig")
     * @param Request $request
     * @return array
     */
    public function getDayProjectionsAction(Request $request) {

        $em = $this->get('doctrine')->getManager();

        $date = $request->get('date');

        $projection = array();
        if ( $request->headers->get('host') == $this->getParameter('fdc_press_domain') ) {
            // GET DAY PROJECTIONS
            $projection = $em->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionByDate($date);

        }
        else {
            // Grab Event Site projections
        }
        return array(
            'dayProjection' => $projection,
        );
    }

}
