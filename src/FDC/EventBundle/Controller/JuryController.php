<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class JuryController extends Controller
{
    /**
     * @Route("/juries-{section}")
     *
     * @param section
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getJury($section)
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

        return $this->render(
            "FDCEventBundle:Jury:jury.section.html.twig",
            array(
                'members' => $members,
                'president' => $president,
            )
        );

    }

    /**
     * @Route("/artiste-{id}")
     *
     * @param id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArtiste($id)
    {

    }
}