<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class JuryController extends Controller
{
    /**
     * @Route("/juries-{section}")
     * @Template("FDCEventBundle:Jury:jury.section.html.twig")
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

        return array(
            'members' => $members,
            'president' => $president
        );

    }

    /**
     * @Route("/artiste-{id}")
     * @Template("FDCEventBundle:Artist:artist.page.html.twig")
     * @param id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArtiste($id)
    {

        $artiste = array(
            'id' => 0,
            'img' => 'img.jpg',
            'name' => 'Francis Coppola',
            'from' => 'Etats-Unis',
            'functions' => 'Réalisateur',
            'bio' => 'Né à Détroit (Etats-Unis) en 1939. Diplômé de la Hofstra University de New York et titulaire, ...',
        );

        $relatedFilms = array(
            array(
                'title' => 'Apocalypse now',
                'date' => '1976',
                'img'  => 'img.jpg',
                'category' => 'Hors compétition',
                'functions' => 'Réalisation, Scénario & Dialogues, Musique',
            ),
            array(
                'title' => 'Apocalypse now',
                'date' => '1976',
                'img'  => 'img.jpg',
                'category' => 'Hors compétition',
                'functions' => 'Réalisation, Scénario & Dialogues, Musique',
            ),
            array(
                'title' => 'Apocalypse now',
                'date' => '1976',
                'img'  => 'img.jpg',
                'category' => 'Hors compétition',
                'functions' => 'Réalisation, Scénario & Dialogues, Musique',
            )
        );

        $relatedPalmares = array(
            array(
                'title' => 'Apocalypse now',
                'date' => '1976',
                'img'  => 'img.jpg',
                'palmares' => 'Palme D\'or - Prix de la critique internationale - F.I.P.E.S.C.I.',
                'category' => 'Hors compétition',
                'functions' => 'Réalisation, Scénario & Dialogues, Musique',
            ),
            array(
                'title' => 'Apocalypse now',
                'date' => '1976',
                'img'  => 'img.jpg',
                'palmares' => 'Palme D\'or - Prix de la critique internationale - F.I.P.E.S.C.I.',
                'category' => 'Hors compétition',
                'functions' => 'Réalisation, Scénario & Dialogues, Musique',
            )
        );

        $relatedRole = array(
            array(
                'title' => 'Président',
                'role' => 'Jury des longs métrages',
                'date' => '1996',
            )
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

        $pagination = $this->getArtistList($id);


        return array(
            'artist' => $artiste,
            'films' => $relatedFilms,
            'palmares' => $relatedPalmares,
            'roles' => $relatedRole,
            'realisateurs' => $allMembers,
            'pagination' => $pagination
        );
    }

    public function getArtistList($id)
    {
        //$artiste->findAll()
        $artistes = array(
            array(
                'id'=>0,
                'name'=> 'Francis Coppola'
            ),
            array(
                'id'=>1,
                'name'=> 'Francis Coppola'
            ),
            array(
                'id'=>2,
                'name'=> 'Francis Coppola'
            ),
            array(
                'id'=>3,
                'name'=> 'Francis Coppola'
            ),
            array(
                'id'=>4,
                'name'=> 'Francis Coppola'
            ),
        );


        //$artiste->findOnebyId($id);
        $artiste = array(
          'id' => 1,
          'name' => 'Jason Statam'
        );

        $max = count($artistes) - 1;
        $current = $artiste['id'];

        $next = $current + 1;
        if ( $next > $max ) {
            $next = 0;
        }
        $prev = $current - 1;
        if ( $prev < 0 ) {
            $prev = $max;
        }
        $pagination = array(
            'prev' => $prev,
            'next' => $next,
        );

        return $pagination;

    }

}