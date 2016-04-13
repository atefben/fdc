<?php

namespace FDC\EventBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use \DateTime;

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
    public function schedulingAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $festival = $this->getFestival()->getId();
        $date = $request->get('date') ?: new DateTime();
        $festivalStart    = $this->getFestival()->getFestivalStartsAt();
        $festivalEnd      = $this->getFestival()->getFestivalEndsAt();

        if ($request->get('date')) {
           $date = $request->get('date');
        } else {
            $date = new DateTime();

            if ($date < $festivalStart) {
                $date = $festivalStart->format('Y-m-d');
            } else if ($date > $festivalEnd) {
                $date = $festivalEnd->format('Y-m-d');
            } else {
                $date = $date->format('Y-m-d');
            }
        }

        $rooms = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjectionRoom')
            ->findAll()
        ;

        foreach ($rooms as $room) {
            $projections[$room->getId()] = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionsByFestivalAndDateAndRoom($festival, $date, $room->getId())
            ;
            var_dump(count($projections[$room->getId()]));
        }

        // remove projection not matching current festival
        /*foreach ($rooms as $room) {
            foreach ($room->getProjections() as $projection) {
                if ($projection->getFestival() && $projection->getFestival()->getId() != $festival &&
                    ($projection->getStartsAt() <= $date. ' 00:00:00' ||  $projection->getEndsat() >= $date. ' 23:59:59')) {
                    $room->removeProjection($projection);
                }
            }
        }*/

        $schedulingDays = $this->createDateRangeArrayEvent($festivalStart->format('Y-m-d'), $festivalEnd->format('Y-m-d'), false);


        /*$schedulingDays = array(
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
        );*/

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

        /*$events = array(
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
        );*/

        return array(
            'schedulingDays' => $schedulingDays,
            'rooms' => $rooms,
            'projections' => $projections,
            'typeFilters' => $typeFilters,
            'selectionFilters' => $selectionFilters,
            'festival' => $festival
        );

    }

    /**
     * @Route("/agenda")
     * @Template("FDCEventBundle:Agenda:agenda.html.twig")
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
     * @Template("FDCEventBundle:Agenda:room.html.twig")
     *
     */
    public function roomAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));

        $translator = $this->get('translator');

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET PressCinemaMap PAGE
        $rooms = $em->getRepository('BaseCoreBundle:PressCinemaMap')->findOneById($this->getParameter('admin_press_cinemamap_id'));
        if ($rooms === null) {
            throw new NotFoundHttpException();
        }

        return array(
            'rooms' => $rooms
        );

    }
}