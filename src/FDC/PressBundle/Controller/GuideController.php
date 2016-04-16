<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/")
 */
class GuideController extends Controller
{

    /**
     * @Route("/guide")
     * @Template("FDCPressBundle:Guide:main.html.twig")
     * @return array
     */
    public function mainAction()
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // GET GUIDE PAGE
        $guide = $em->getRepository('BaseCoreBundle:PressGuide')->findOneById($this->getParameter('admin_press_guide_id'));
        if ($guide === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCPressPagePressGuideSeo($guide, $locale);

        return array(
            'guideContent' => $guide,
        );

    }
}
