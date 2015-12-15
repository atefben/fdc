<?php

namespace FDC\EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JuryController extends Controller
{
    /**
     * @Route("/juries-{section}")
     * @Template("FDCEventBundle:Jury:jury.section.html.twig")
     * @param section
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($section)
    {
        $president= array();
        $members= array();

        $allPresident = array(
            'id' => 0,
            'img' => 'img.jpg',
            'name' => 'Jane Campion',
            'description' => 'lorem ipsum',
            'functions' => 'Réalisatrice, Scénariste, Productrice'
        );

        $allMembers = array(
            array(
                'id' => 0,
                'img' => 'img.jpg',
                'name' => 'Jane Campion',
                'functions' => 'Réalisatrice, Scénariste, Productrice'
            ),
            array(
                'id' => 0,
                'img' => 'img.jpg',
                'name' => 'Jane Campion',
                'functions' => 'Réalisatrice, Scénariste, Productrice'
            ),
            array(
                'id' => 0,
                'img' => 'img.jpg',
                'name' => 'Jane Campion',
                'functions' => 'Réalisatrice, Scénariste, Productrice'
            ),
            array(
                'id' => 0,
                'img' => 'img.jpg',
                'name' => 'Jane Campion',
                'functions' => 'Réalisatrice, Scénariste, Productrice'
            ),
            array(
                'id' => 0,
                'img' => 'img.jpg',
                'name' => 'Jane Campion',
                'functions' => 'Réalisatrice, Scénariste, Productrice'
            )
        );

        switch ($section) {
            case 'longs-metrages':
                $members = $allMembers;
                $president = $allPresident;
                break;
            case 'cinefondation':
                $members = $allMembers;
                $president = $allPresident;
                break;
            case 'certain-regard':
                $members = $allMembers;
                $president = $allPresident;
                break;
            case 'camera-dor':
                $members = $allMembers;
                $president = $allPresident;
                break;
        }

        return array(
            'members' => $members,
            'president' => $president
        );

    }
}