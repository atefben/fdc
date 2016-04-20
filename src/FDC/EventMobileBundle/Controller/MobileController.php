<?php

namespace FDC\EventMobileBundle\Controller;

use Base\CoreBundle\Interfaces\FDCPageParticipateSectionInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FDC\EventMobileBundle\Component\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Acl\Exception\Exception;

class MobileController extends Controller
{
    /**
     * @Route("/mobile-acces")
     * @Template("FDCEventMobileBundle:Mobile:mobile.html.twig")
     */
    public function mobileAccesAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();


        $strates = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findBy(
                array(
                'page' => FDCPageParticipateSectionInterface::ACCES_PROJECTION,
                'mobile' => true
                ),
                array('stratePosition' => 'asc')
            );


        return array(
            'strates' => $strates,
        );
    }

    /**
     * @Route("/mobile-guide-presse")
     * @Template("FDCEventMobileBundle:Mobile:mobile.html.twig")
     */
    public function mobileGuidePressAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();


        $strates = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findBy(
                array(
                    'page' => FDCPageParticipateSectionInterface::GUIDE_PRESS,
                    'mobile' => true
                ),
                array('stratePosition' => 'asc')
            );


        return array(
            'strates' => $strates,
        );
    }

    /**
     * @Route("/mobile-participer")
     * @Template("FDCEventMobileBundle:Mobile:mobile.html.twig")
     */
    public function mobileParticiperAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();


        $strates = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findBy(
                array(
                    'page' => FDCPageParticipateSectionInterface::FDC_MODE_EMPLOI,
                    'mobile' => true
                ),
                array('stratePosition' => 'asc')
            );


        return array(
            'strates' => $strates,
        );
    }

    /**
     * @Route("/mobile-plan")
     * @Template("FDCEventMobileBundle:Mobile:mobile.html.twig")
     */
    public function planAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();


        $strates = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findBy(
                array(
                    'page' => FDCPageParticipateSectionInterface::BONNE_PRATIQUES,
                    'mobile' => true
                ),
                array('stratePosition' => 'asc')
            );


        return array(
            'strates' => $strates,
        );
    }

    /**
     * @Route("/mobile-se-rendre")
     * @Template("FDCEventMobileBundle:Mobile:mobile.html.twig")
     */
    public function seRendreAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();

        $strates = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipateSection')
            ->findBy(
                array(
                    'page' => FDCPageParticipateSectionInterface::TYPES_ACCES,
                    'mobile' => true
                ),
                array('stratePosition' => 'asc')
            );


        return array(
            'strates' => $strates,
        );
    }
}