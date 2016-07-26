<?php

namespace FDC\EventMobileBundle\Controller;

use FDC\EventMobileBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/artist")
 * Class ArtistController
 * @package FDC\EventMobileBundle\Controller
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
     * @Template("FDCEventMobileBundle:Artist:page.html.twig")
     * @param  string $slug
     * @return Response
     */
    public function getAction($slug)
    {
        $count = 10;
        $festival = $this->getFestival()->getId();

        $artist = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->getArtist($slug)
        ;
        if ($artist === null) {
            throw $this->createNotFoundException();
        }

        if ($artist->getDuplicate() === true && $artist->getOwner() !== null) {
            return $this->redirectToRoute('fdc_event_artist_get', array('slug' => $artist->getOwner()->getSlug()));
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
            'festival'    => $festival,
            'artist'    => $artist,
            'directors' => $directors,
        );

    }
}