<?php

namespace FDC\PressBundle\Controller;

use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;
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
     * @Route("/menu")
     * @Template("FDCPressBundle:Global:nav.html.twig")
     * @return array
     */
    public function menuAction($route) {

        $em = $this->get('doctrine')->getManager();
        $menus = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->childrenHierarchy();
        $displayedMenus = array();
        foreach($menus as $menu){
            if($menu['site'] == FDCEventRoutesInterface::PRESS) {
                $displayedMenus[] = $menu;
            }
        }

        usort($displayedMenus, function($a, $b) {
            if ($a["position"] == $b["position"]) {
                return 0;
            }
            return ($a["position"] < $b["position"]) ? -1 : 1;
        });

        foreach ($displayedMenus as $key => $menu) {
            usort($displayedMenus[$key]['__children'], function($a, $b) {
                if ($a["position"] == $b["position"]) {
                    return 0;
                }
                return ($a["position"] < $b["position"]) ? -1 : 1;
            });
        }

        return array(
            'menus' => $displayedMenus,
            'route' => $route
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
