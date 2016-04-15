<?php

namespace FDC\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FDC\EventBundle\Component\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Acl\Exception\Exception;

class MobileController extends Controller
{
    /**
     * @Route("/mobile-acces")
     * @Template("FDCEventBundle:Mobile:acces.html.twig")
     */
    public function mobileAccesAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();


        $pratiques = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findOneBy(array(
                'page' => '1',
                'mobile' => true
            ));

        $acces = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findOneBy(array(
                'page' => '2',
                'mobile' => true
            ));


        return array(
            'pratique' => $pratiques,
            'acces' => $acces
        );
    }

    /**
     * @Route("/mobile-guide-presse")
     * @Template("FDCEventBundle:Mobile:guide-press.html.twig")
     */
    public function mobileGuidePressAction(Request $request)
    {

    }

    /**
     * @Route("/mobile-participer")
     * @Template("FDCEventBundle:Mobile:participer.html.twig")
     */
    public function mobileParticiperAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();


        $landing = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findOneBy(array(
                'page' => '3',
                'mobile' => true
            ));

        $medias = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findOneBy(array(
                'page' => '4',
                'mobile' => true
            ));

        $services = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findOneBy(array(
                'page' => '5',
                'mobile' => true
            ));


        return array(
            'landing' => $landing,
            'medias' => $medias,
            'services' => $services,
        );
    }

    /**
     * @Route("/mobile-plan")
     * @Template("FDCEventBundle:Mobile:plan.html.twig")
     */
    public function planAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();


        $plan = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findOneBy(array(
                'page' => '10',
                'mobile' => true
            ));

        return array(
            'plan' => $plan,
        );
    }

    /**
     * @Route("/mobile-se-rendre")
     * @Template("FDCEventBundle:Mobile:se-rendre.html.twig")
     */
    public function seRendreAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();


        $plan = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findOneBy(array(
                'page' => '6',
                'mobile' => true
            ));

        return array(
            'plan' => $plan,
        );
    }
}