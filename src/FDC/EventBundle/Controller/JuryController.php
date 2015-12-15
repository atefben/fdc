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
     * Sort objects by firstname char
     *
     * @param $a
     * @param $b
     * @return int
     */
    private function sortByFirstChar($a, $b)
    {
        if (ord($a->getFirstname()[0]) == ord($b->getFirstname()[0])) {
            return 0;
        }

        return (ord($a->getFirstname()[0]) < ord($b->getFirstname()[0])) ? -1 : 1;
    }

    /**
     * @Route("/artist/{slug}")
     * @Template("FDCEventBundle:Jury:jury.artiste.html.twig")
     *
     * @param  string slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArtist($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $count = 8;

        // find the artist info with the current locale
        $artist = $em->getRepository('BaseCoreBundle:FilmPerson')->getArtist($locale, $slug);

        // find directors randomly, order them after by firstname (cant use mysql, doesnt work)
        $directors = $em->getRepository('BaseCoreBundle:FilmPerson')->getDirectorsRandomly($count);
        usort($directors, array($this, 'sortByFirstChar'));

        return array(
            'artist' => $artist,
            'directors' => $directors
        );
    }

}