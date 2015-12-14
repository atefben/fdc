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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function prepareAction()
    {

        $pageContent = "Contenu de la page";

        return $this->render(
            "FDCEventBundle:Participate:participate.prepare.html.twig",
            array('content' => $pageContent)
        );
    }

    /**
     * @Route("/festival")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function festivalAction()
    {

        $pageContent = "Contenu de la page";

        return $this->render(
            "FDCEventBundle:Participate:participate.festival.html.twig",
            array('content' => $pageContent)
        );
    }

    /**
     * @Route("/acces-projection")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accessAction()
    {

        $pageContent = "Contenu de la page";

        return $this->render(
            "FDCEventBundle:Participate:participate.access.html.twig",
            array('content' => $pageContent)
        );

    }

    /**
     * @Route("/partenaires")
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

        return $this->render(
            "FDCEventBundle:Participate:participate.partners.html.twig",
            array('partners' => $partners)
        );

    }

    /**
     * @Route("/fournisseurs")
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

        return $this->render(
            "FDCEventBundle:Participate:participate.suppliers.html.twig",
            array('suppliers' => $suppliers)
        );

    }

}
