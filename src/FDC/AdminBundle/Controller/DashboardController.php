<?php

namespace FDC\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/set_cookie/{slug}")
     */
    public function setCookieAction($slug)
    {
        $response = new Response();
        $dm = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        
        $site = $dm->getRepository('FDCCoreBundle:Site')->findOneBySlug($slug);
        
        if ($site != null) {
            $session->remove('fdc_site');
            $session->set('fdc_site', $site);
        } else {
            error_log("Site with slug : {$slug} doesn't exist");
        }
        
         return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
    }
}