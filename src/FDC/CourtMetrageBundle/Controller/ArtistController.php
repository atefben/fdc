<?php

namespace FDC\CourtMetrageBundle\Controller;


use Base\CoreBundle\Entity\FilmPerson;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArtistController
 *
 * @package FDC\CourtMetrageBundle\Controller
 */
class ArtistController extends CcmController
{

    /**
     * @Route("artist/{slug}", name="fdc_court_metrage_artist")
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

        if (!$artist) {
            throw $this->createNotFoundException();
        }

        if ($artist->getDuplicate() && !$artist->getOwner()) {
            return $this->redirectToRoute('fdc_event_artist_get', ['slug' => $artist->getOwner()->getSlug()], 301);
        }

        $competitionManager = $this->get('ccm.manager.competition');
        $selectionTab = $competitionManager->getSelectionTab($this->getFestival()->getYear());

        // find directors randomly, order them after by firstname
        $directors = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->getDirectorsRandomlyCcm($festival, $count, $artist->getId(), $selectionTab->getTranslatable()->getSelectionSection())
        ;
        usort($directors, array($this, 'sortByFirstname'));

        return $this->render('FDCCourtMetrageBundle:artist:artist.html.twig', [
            'festival'  => $festival,
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
