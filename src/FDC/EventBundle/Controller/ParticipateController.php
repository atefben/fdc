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

        $pageContent = "Contenu de la page";

        return $this->render(
            "FDCEventBundle:Participate:participate.partners.html.twig",
            array('content' => $pageContent)
        );

    }

    /**
     * @Route("/fournisseurs")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function suppliersAction()
    {

        $pageContent = "Contenu de la page";

        return $this->render(
            "FDCEventBundle:Participate:participate.suppliers.html.twig",
            array('content' => $pageContent)
        );

    }

}
