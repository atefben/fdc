<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Form\Type\LocaleSwitcherType;

use JMS\SecurityExtraBundle\Annotation\Secure;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * DashboardController class.
 * 
 * \@extends Controller
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 *
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{    
    /**
     * setCookieAction function.
     * 
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/set_cookie/{slug}")
     */
    public function setCookieAction($slug)
    {
        $response = new Response();
        $dm = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        
        $site = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug($slug);
        
        if ($site != null) {
            $session->remove('base_site');
            $session->set('base_site', $site);
        } else {
            error_log("Site with slug : {$slug} doesn't exist");
        }
        
         return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
    }

    /**
     * localeSwitcherAction function.
     *
     * We save in _locale session the selected value and use LocaleListener to retrieve this value and swith the request locale
     * 
     * @access public
     * @param Request $request
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/locale_switcher")
     * @Template("BaseAdminBundle:Dashboard:locale_switcher.html.twig")
     */
    public function localeSwitcherAction(Request $request)
    {
        $localesAdmin = $this->getParameter('locales_admin');
        $localesArray = array();
        foreach ($localesAdmin as $locale) {
            $localesArray[$locale] = $locale;
        }
        
        $form = $this->createForm(new LocaleSwitcherType($localesArray, $request->getLocale()));
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            $this->get('session')->set('_locale', $form->get('locales')->getData());
            $redirect = ($request->headers->get('referer') != '') ? $request->headers->get('referer') : $this->generateUrl('sonata_admin_dashboard');

            return $this->redirect($redirect);
        }
        
        return array(
            'form' => $form->createView()
        );
    }
}