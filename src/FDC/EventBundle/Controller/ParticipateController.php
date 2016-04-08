<?php

namespace FDC\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/participer")
 * Class ParticipateController
 * @package FDC\EventBundle\Controller
 */
class ParticipateController extends Controller
{
    /**
     * @Route("/prepare")
     * @Template("FDCEventBundle:Participate:prepare.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function prepareAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET PARTICIPATE PAGE
        $content = $em->getRepository('BaseCoreBundle:FDCPagePrepare')->findOneById($this->getParameter('admin_fdc_page_prepare_id'));
        if ($content === null) {
            throw new NotFoundHttpException();
        }

        // SEO
         $this->get('base.manager.seo')->setFDCPagePrepareSeo($content, $locale);

        return array(
            'content' => $content,
        );
    }

    /**
     * @Route("/{slug}")
     * @Template("FDCEventBundle:Participate:participate.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function getPageAction(Request $request, $slug)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET PARTICIPATE PAGE
        $page = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipate')
            ->getFDCPageParticipateBySlug($slug,$locale);

        if ($page === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCPageParticipateSeo($page, $locale);

        return array(
            'participatePage' => $page
        );
    }

}
