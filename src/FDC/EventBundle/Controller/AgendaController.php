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
        $isPress = ($request->headers->get('host') == $this->getParameter('fdc_press_domain')) ? true : false;

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

        // get all rooms
        $rooms = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjectionRoom')
            ->findAll()
        ;

        // get projections by room
        foreach ($rooms as $room) {
            $projections[$room->getId()] = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionsByFestivalAndDateAndRoom($festival, $date, $room->getId(), $isPress)
            ;
        }

        // get all selections - filter selection
        $projectionsAll = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjection')
            ->getProjectionsByFestivalAndDateAndRoom($festival, $date, false, $isPress);
        $selections = array();
        foreach ($projectionsAll as $projection) {
            foreach ($projection->getProgrammationFilms() as $projectionProgrammationFilm) {
                $film = $projectionProgrammationFilm->getFilm();
                $selections[$film->getSelectionSection()->getId()] = $film->getSelectionSection();
            }
        }

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

       /* $selectionFilters = array(
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
        );*/

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
            'rooms' => $rooms,
            'projections' => $projections,
            'typeFilters' => $typeFilters,
            'selections' => $selections,
            'festival' => $festival,
            'date' => $date
        );

    }

    /**
     * @Route("/day", options={"expose"=true})
     * @Template("FDCEventBundle:Global:projection.html.twig")
     * @param Request $request
     * @return array
     */
    public function getDayProjectionsAction(Request $request) {

        $festival = $this->getFestival()->getId();
        $date = $request->get('date');
        $isPress = ($request->headers->get('host') == $this->getParameter('fdc_press_domain')) ? true : false;

        // get all rooms
        $rooms = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjectionRoom')
            ->findAll()
        ;

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