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
     * @Template("FDCPressBundle:Global:projection.html.twig")
     * @param Request $request
     * @return array
     */
    public function getDayProjectionsAction(Request $request) {

        $em = $this->get('doctrine')->getManager();

        $date = $request->get('date');

        $dayProjection = array();
        if ( $request->headers->get('host') == $this->getParameter('fdc_press_domain') ) {

            // GET DAY PROJECTIONS
            $dayProjection = $em->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionByDate($date);

            $path = $request->headers->get('referer');
            if ($path !== null) {
                $path = parse_url($path)['path'];
                if (strpos($path, '/app_dev.php') !== false) {
                    $path = explode('/', $path);
                    unset($path[1]);
                    $path = implode('/', $path);
                }
                $router = $this->get('router');
                $route = $router->match($path)['_route'];
                // If we are on homepage
                if ($route == 'fdc_press_news_home') {
                    // Event have to be in 5h max
                    $hourRange = array();
                    $newDate = new \DateTime;
                    $endHour = $newDate->modify('+ 5 hour')->format('H');

                    while ($date->format('H') <= $endHour) {

                        array_push($hourRange, $date->format('H'));
                        $date->modify('+ 1 hour')->format('H');
                    }

                    foreach ( $dayProjection as $key => $projection ) {
                        if (!in_array($projection->getStartsAt()->format('H'), $hourRange)) {
                            unset($dayProjection[$key]);
                        }
                    }
                }
            }
        }
        else {
            // Grab Event Site projections
        }
        return array(
            'dayProjection' => $dayProjection,
        );
    }

}
