<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\FilmPerson;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/artist")
 * Class ArtistController
 * @package FDC\CorporateBundle\Controller
 */
class ArtistController extends Controller
{

    /**
     * @Route("/{slug}")
     * @param $slug
     * @return RedirectResponse|Response
     */
    public function getAction($slug)
    {
        $count = 10;
        $festival = $this->getFestival()->getId();
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        $artist = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->getArtist($slug)
        ;

        if (!$artist) {
            throw $this->createNotFoundException();
        }

        if ($artist->getDuplicate() && !$artist->getOwner()) {
            return $this->redirectToRoute('fdc_corporate_artist_get', ['slug' => $artist->getOwner()->getSlug()], 301);
        }

        // find directors randomly, order them after by firstname
        $directors = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->getDirectorsRandomly($festival,  $count, $artist->getId())
        ;
        usort($directors, array($this, 'sortByFirstname'));

        return $this->render('FDCCorporateBundle:Artist:page.html.twig', [
            'festival'  => $festival,
            'festivals' => $festivals,
            'artist'    => $artist,
            'directors' => $directors,
        ]);
    }

    /**
     * Sort objects by firstname char
     * @param FilmPerson $a
     * @param FilmPerson $b
     * @return int
     */
    private function sortByFirstname(FilmPerson $a, FilmPerson $b)
    {
        return strcasecmp($a->getFirstname()[0], $b->getFirstname()[0]);
    }
}