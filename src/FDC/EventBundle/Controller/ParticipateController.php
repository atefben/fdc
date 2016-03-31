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
     * @Route("/festival")
     * @Template("FDCEventBundle:Participate:festival.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function festivalAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $pageContent = "Contenu de la page";

        return array(
            'content' => $pageContent
        );
    }

    /**
     * @Route("/acces-projection")
     * @Template("FDCEventBundle:Participate:access.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accessAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $pageContent = "Contenu de la page";

        return array(
            'content' => $pageContent
        );

    }

    /**
     * @Route("/partenaires")
     * @Template("FDCEventBundle:Participate:partners.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function partnersAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $partners = array(
            array(
                'type' => 0,
                'img' => 'img.jpg',
                'alt' => 'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr',
                'person_img' => 'img.jpg',
                'person_name' => 'Lorem Ipsum',
                'person_title' => 'President'
            ),
            array(
                'type' => 0,
                'img' => 'img.jpg',
                'alt' => 'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr',
                'person_img' => 'img.jpg',
                'person_name' => 'Lorem Ipsum',
                'person_title' => 'President'
            ),
            array(
                'type' => 0,
                'img' => 'img.jpg',
                'alt' => 'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr',
                'person_img' => '',
                'person_name' => '',
                'person_title' => ''
            ),
            array(
                'type' => 1,
                'img' => 'img.jpg',
                'alt' => 'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr',
                'person_img' => 'img.jpg',
                'person_name' => 'Lorem Ipsum',
                'person_title' => ''
            ),
            array(
                'type' => 1,
                'img' => 'img.jpg',
                'alt' => 'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr',
                'person_img' => 'img.jpg',
                'person_name' => 'Lorem Ipsum',
                'person_title' => 'President'
            )
        );

        return array(
            'partners' => $partners
        );

    }

    /**
     * @Route("/fournisseurs")
     * @Template("FDCEventBundle:Participate:suppliers.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function suppliersAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $suppliers = array(
            array(
                'img' => 'img.jpg',
                'alt' => 'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr'
            ),
            array(
                'img' => 'img.jpg',
                'alt' => 'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr'
            ),
            array(
                'img' => 'img.jpg',
                'alt' => 'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => '',
                'contact' => ''
            ),
        );

        return array(
            'suppliers' => $suppliers
        );

    }

}
