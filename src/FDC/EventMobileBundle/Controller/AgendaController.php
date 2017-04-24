<?php

namespace FDC\EventMobileBundle\Controller;

use \DateTime;

use FDC\EventMobileBundle\Component\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $festival = $this->getFestival()->getId();
        $festivalStart    = $this->getFestival()->getFestivalStartsAt();
        $festivalEnd      = $this->getFestival()->getFestivalEndsAt();
        $locale = $this->getRequest()->getLocale();
        $isPress = false;

        $waitingPage = $this->isWaitingPage($request, 'fdc_event_agenda_scheduling');
        if ($waitingPage) {
            return $waitingPage;
        }

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

        if (!$isPress) {
            foreach ($rooms as $key => $room) {
                if ($room->getName() == 'Salle de Conférence de Presse') {
                    unset($rooms[$key]);
                }
            }
        }

        // get projections by room
        $projections = array();
        foreach ($rooms as $room) {
            $projections[$room->getId()] = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionsByFestivalAndDateAndRoom($festival, $date, $room->getId(), $isPress)
            ;
        }

        // get all selections
        $selectionsIds = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjection')
            ->getAllSelectionsIds($festival, $locale);
        $selections = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmSelectionSection')
            ->findBy(array('id' => $selectionsIds));
        // get all types
        $types = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjection')
            ->getAllTypes($festival);

        $schedulingDays = $this->createDateRangeArrayEvent($festivalStart->format('Y-m-d'), $festivalEnd->format('Y-m-d'), false);

        $pressProjection = $this->getDoctrineManager()->getRepository('BaseCoreBundle:PressProjection')->findOneById($this->getParameter('admin_press_projection_id'));

        return array(
            'pressProjection' => $pressProjection,
            'schedulingDays' => $schedulingDays,
            'rooms' => $rooms,
            'projections' => $projections,
            'types' => $types,
            'selections' => $selections,
            'festival' => $festival,
            'date' => $date
        );

    }

    /**
     * @Route("/day", options={"expose"=true})
     * @Template("FDCEventMobileBundle:Global:projection.html.twig")
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
                if (trim($room->getName()) == 'Salle de Conférence de Presse') {
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
     * @Template("FDCEventMobileBundle:Global:projection-single.html.twig")
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
                ->findBy(
                    array('type' => 'Séance de presse'),
                    array('startsAt' => 'ASC')
                )
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
                ->findBy(
                    array('type' => 'Conférence de presse'),
                    array('startsAt' => 'ASC')
                )
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