<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
    public function prepareAction()
    {

        $pageContent = "Contenu de la page";

        return array(
            'content' => $pageContent
        );
    }

    /**
     * @Route("/festival")
     * @Template("FDCEventBundle:Participate:festival.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function festivalAction()
    {

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
    public function accessAction()
    {

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
    public function partnersAction()
    {

        $partners = array(
            array(
                'type' => 0,
                'img' => 'img.jpg',
                'alt' =>  'alt',
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
                'alt' =>  'alt',
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
                'alt' =>  'alt',
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
                'alt' =>  'alt',
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
                'alt' =>  'alt',
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
    public function suppliersAction()
    {

        $suppliers = array(
            array(
                'img' => 'img.jpg',
                'alt' =>  'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr'
            ),
            array(
                'img' => 'img.jpg',
                'alt' =>  'alt',
                'title' => 'title',
                'description' => 'lorem ipsum',
                'website' => 'http://google.fr',
                'contact' => 'a.mineau@ohwee.fr'
            ),
            array(
                'img' => 'img.jpg',
                'alt' =>  'alt',
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
