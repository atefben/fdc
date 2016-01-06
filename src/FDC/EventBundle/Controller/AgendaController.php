<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/programmation")
 * Class AgendaController
 * @package FDC\EventBundle\Controller
 */
class AgendaController extends Controller
{

    /**
     * @Route("/")
     * @Template("FDCEventBundle:Agenda:scheduling.html.twig")
     *
     */
    public function schedulingAction()
    {
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

        return array(
            'schedulingDays' => $schedulingDays,
            'typeFilters' => $typeFilters,
            'selectionFilters' => $selectionFilters,
        );

    }

    /**
     * @Route("/agenda")
     * @Template("FDCEventBundle:Agenda:agenda.html.twig")
     *
     */
    public function getAction()
    {
        $agenda = array();

        return array(
            'agenda' => $agenda
        );

    }

    /**
     * @Route("/room")
     * @Template("FDCEventBundle:Agenda:room.html.twig")
     *
     */
    public function roomAction()
    {
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