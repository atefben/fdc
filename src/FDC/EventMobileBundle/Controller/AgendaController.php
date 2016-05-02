<?php

namespace FDC\EventMobileBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FDC\EventMobileBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/programmation")
 * Class AgendaController
 * @package FDC\EventMobileBundle\Controller
 */
class AgendaController extends Controller
{

    /**
     * @Route("/")
     * @Template("FDCEventMobileBundle:Agenda:scheduling.html.twig")
     *
     */
    public function schedulingAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $schedulingDays = array(
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            )
        );

        $selectionFilters = array(
            array(
                'name' => 'Toutes',
                'slug' => 'all'
            ),
            array(
                'name' => 'Compétitions',
                'slug' => 'competition'
            ),
            array(
                'name' => 'Hors compétitions',
                'slug' => 'hors-competition'
            ),
            array(
                'name' => 'Un certain regard',
                'slug' => 'certain-regard'
            )
        );

        $typeFilters = array(
            array(
                'name' => 'Tout',
                'slug' => 'all'
            ),
            array(
                'name' => 'Séances',
                'slug' => 'seances'
            ),
            array(
                'name' => 'Evenements',
                'slug' => 'evenements'
            ),
        );

        $events = array(
            'place' => array(
                'grandTheatre' => array(
                    'events' => array(
                        array(
                            'id' => 3,
                            'title' => 'Orson welles, autopsie d’une légende',
                            'author' => array(
                                'fullName' => 'Elisabet KAPNIST'
                            ),
                            'category' => array(
                                'name' => 'Séance de reprise',
                                'slug' => 'reprise'
                            ),
                            'startAt' => new \DateTime(),
                            'endAt' => new \DateTime(),
                            'duration' => 120,
                            'image' => array(
                                'path' => '//dummyimage.com/46x64/000/fff'
                            ),
                            'place' => 'Grand Théatre Lumière',
                            'competition' => 'Hors compétition'
                        ),
                    )
                ),
                'salleBunuel' => array(
                    'events' => array(
                        array(
                            'id' => 5,
                            'title' => 'Mad max, fury road',
                            'author' => array(
                                'fullName' => 'Elisabet KAPNIST'
                            ),
                            'category' => array(
                                'name' => 'conférence de presse',
                                'slug' => 'presse'
                            ),
                            'startAt' => new \DateTime(),
                            'endAt' => new \DateTime(),
                            'duration' => 60,
                            'image' => array(
                                'path' => '//dummyimage.com/46x64/000/fff'
                            ),
                            'place' => 'Grand Théatre Lumière',
                            'competition' => 'Hors compétition'
                        ),
                    )
                ),
            )
        );

        return array(
            'schedulingDays' => $schedulingDays,
            'schedulingEvents' => $events,
            'typeFilters' => $typeFilters,
            'selectionFilters' => $selectionFilters,
        );

    }

    /**
     * @Route("/day", options={"expose"=true})
     * @Template("FDCEventBundle:Global:projection.html.twig")
     * @param Request $request
     * @return array
     */
    public function getDayProjectionsAction(Request $request)
    {

        $festival = $this->getFestival()->getId();
        $date = $request->get('date');
        $isPress = false;

        if ($this->get('security.authorization_checker')->isGranted('ROLE_FDC_PRESS_REPORTER') &&
            strpos($request->headers->get('referer'), 'press') !== false) {
            $isPress = true;
        }

        // get all rooms
        $rooms = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjectionRoom')
            ->findAll()
        ;

        if (!$isPress) {
            foreach ($rooms as $key => $room) {
                if ($room->getName() == 'Salle de Conférence de Presse') {
                    unset($rooms[$key]);
                }
            }
        }

        // get projections by room
        foreach ($rooms as $room) {
            $projections[$room->getId()] = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionsByFestivalAndDateAndRoom($festival, $date, $room->getId(), $isPress)
            ;
        }

        return array(
            'rooms' => $rooms,
            'projections' => $projections
        );
    }

    /**
     * @Route("/projection/{id}", options={"expose"=true})
     * @Template("FDCEventBundle:Global:projection-single.html.twig")
     * @param Request $request
     * @return array
     */
    public function getProjectionAction(Request $request, $id)
    {
        $festival = $this->getFestival()->getId();

        // get projection
        $projection = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjection')
            ->findOneById($id)
        ;

        $filmIds = array();
        foreach ($projection->getProgrammationFilms() as $programmationFilm) {
            if (!in_array($programmationFilm->getFilm()->getId(), $filmIds)) {
                $filmIds[] = $programmationFilm->getFilm()->getId();
            }
        }

        $seances = array();
        $conferences = array();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_FDC_PRESS_REPORTER')) {
            // seance de presse
            $seances = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmProjection')
                ->findByType('Séance de presse')
            ;

            // remove seances not matching current films
            foreach($seances as $key => $seance) {
                foreach ($seance->getProgrammationFilms() as $programmationFilm) {
                    if (!in_array($programmationFilm->getFilm()->getId(), $filmIds)) {
                        unset($seances[$key]);
                    }
                }
            }

            // conférence de presse
            $conferences = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmProjection')
                ->findByType('Conférence de presse')
            ;

            // remove conference not matching current films
            foreach($conferences as $key => $conference) {
                foreach ($conference->getProgrammationFilms() as $programmationFilm) {
                    if (!in_array($programmationFilm->getFilm()->getId(), $filmIds)) {
                        unset($conferences[$key]);
                    }
                }
            }
        }


        // projections (everything except the 2 two other type)
       $relatedProjections = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjection')
            ->getAllExceptTypes($festival, array('Séance de presse', 'Conférence de presse'))
        ;

        // remove conference not matching current films
        foreach($relatedProjections as $key => $relatedProjection) {
            foreach ($relatedProjection->getProgrammationFilms() as $programmationFilm) {
                if ($programmationFilm->getFilm() == null || !in_array($programmationFilm->getFilm()->getId(), $filmIds)) {
                    unset($relatedProjections[$key]);
                }
            }
        }

        return array(
            'projection' => $projection,
            'seances' => $seances,
            'conferences' => $conferences,
            'relatedProjections' => $relatedProjections
        );
    }

    /**
     * @Route("/agenda")
     * @Template("FDCEventMobileBundle:Agenda:agenda.html.twig")
     *
     */
    public function getAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $agenda = array();

        return array(
            'agenda' => $agenda
        );

    }

    /**
     * @Route("/room")
     * @Template("FDCEventMobileBundle:Agenda:room.html.twig")
     *
     */
    public function roomAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $rooms = array(
            array(
                'name' => 'Grand Théatre Lumière',
                'slug' => 'grand-theatre',
                'image' => array(
                    'zone' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/festival-map.png',
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/theatre-lumiere.jpg',
                )
            ),
            array(
                'name' => 'Salle Debussy',
                'slug' => 'salle-debussy',
                'image' => array(
                    'zone' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/festival-map.png',
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/theatre-lumiere.jpg',
                )
            ),
            array(
                'name' => 'Salle du 60e',
                'slug' => 'salle-60e',
                'image' => array(
                    'zone' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/festival-map.png',
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/theatre-lumiere.jpg',
                )
            ),
            array(
                'name' => 'Salle Bunuel',
                'slug' => 'salle-bunuel',
                'image' => array(
                    'zone' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/festival-map.png',
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/theatre-lumiere.jpg',
                )
            ),
            array(
                'name' => 'Salle bazin',
                'slug' => 'salle-bazin',
                'image' => array(
                    'zone' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/festival-map.png',
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/theatre-lumiere.jpg',
                )
            ),
            array(
                'name' => 'Salle de presse',
                'slug' => 'salle-presse',
                'image' => array(
                    'zone' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/festival-map.png',
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/seating-chart/theatre-lumiere.jpg',
                )
            ),
        );

        return array(
            'rooms' => $rooms
        );

    }
}