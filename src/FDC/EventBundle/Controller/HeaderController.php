<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\Date;

class HeaderController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dateAction()
    {
        $dateStart = 11;
        $date = new \DateTime('22-05-2016');

        return $this->render(
            'FDCEventBundle:Header:header.date.html.twig',
            array('date' => $date)
        );

    }

}
