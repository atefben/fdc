<?php

namespace FDC\EventBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/artist")
 * Class ArtistController
 * @package FDC\EventBundle\Controller
 */
class ArtistController extends Controller
{
    /**
     * Sort objects by firstname char
     *
     * @param $a
     * @param $b
     * @return int
     */
    private function sortByFirstname($a, $b)
    {
        if (ord($a->getFirstname()[0]) == ord($b->getFirstname()[0])) {
            return 0;
        }

        return (ord($a->getFirstname()[0]) < ord($b->getFirstname()[0])) ? -1 : 1;
    }

    /**
     * @Route("/{slug}")
     * @Template("FDCEventBundle:Artist:page.html.twig")
     * @param  string $slug
     * @return Response
     */
    public function getAction($slug)
    {
        $count = 8;
        $festival = $this->getFestival()->getId();

        $artist = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->getArtist($slug)
        ;
        if ($artist === null) {
            throw $this->createNotFoundException();
        }

        // find directors randomly, order them after by firstname
        // (cant use mysql, doesnt work)
        $directors = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->getDirectorsRandomly($festival,  $count, $artist->getId())
        ;
        usort($directors, array($this, 'sortByFirstname'));

        return array(
            'artist'    => $artist,
            'directors' => $directors,
        );

    }
}