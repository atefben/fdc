<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    private function sortByFirstChar($a, $b)
    {
        if (ord($a->getFirstname()[0]) == ord($b->getFirstname()[0])) {
            return 0;
        }

        return (ord($a->getFirstname()[0]) < ord($b->getFirstname()[0])) ? -1 : 1;
    }

    /**
     * @Route("/{slug}")
     * @Template("FDCEventBundle:Artist:page.html.twig")
     *
     * @param  string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $count = 8;

        // find the artist info with the current locale
        $artist = $em->getRepository('BaseCoreBundle:FilmPerson')->getArtist($locale, $slug);
        if ($artist === null) {
            throw new NotFoundHttpException();
        }

        // find directors randomly, order them after by firstname (cant use mysql, doesnt work)
        $directors = $em->getRepository('BaseCoreBundle:FilmPerson')->getDirectorsRandomly($count);
        usort($directors, array($this, 'sortByFirstChar'));

        return array(
            'artist' => $artist,
            'directors' => $directors
        );

    }
}