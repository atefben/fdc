<?php

namespace FDC\PressBundle\Controller;

use \DateTime;

use FDC\EventBundle\Component\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/programmation")
 * Class AgendaController
 * @package FDC\PressBundle\Controller
 */
class AgendaController extends Controller
{

    /**
     * @Route("/")
     * @Template("FDCPressBundle:Agenda:scheduling.html.twig")
     *
     */
    public function schedulingAction(Request $request)
    {
        $festival = $this->getFestival()->getId();
        $festivalStart    = $this->getFestival()->getFestivalStartsAt();
        $festivalEnd      = $this->getFestival()->getFestivalEndsAt();
        $isPress = false;
        $locale = $this->getRequest()->getLocale();

        if ($this->get('security.authorization_checker')->isGranted('ROLE_FDC_PRESS_REPORTER') &&
            strpos($request->headers->get('refer'), 'press') !== false) {
            $isPress = true;
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
            ->getProjectionsByFestivalAndDateAndRoom($festival, false, false, $isPress);
        $selections = array();
        $types = array();

        foreach ($projectionsAll as $projection) {
            if (array_search($projection->getType(), $types) === false) {
                $types[] = $projection->getType();
            }

            foreach ($projection->getProgrammationFilms() as $projectionProgrammationFilm) {
                $film = $projectionProgrammationFilm->getFilm();
                if ($film != null && $film->getSelectionSection() !== null) {
                    $selections[$film->getSelectionSection()->getId()] = $film->getSelectionSection();
                }
            }
        }

        $schedulingDays = $this->createDateRangeArrayEvent($festivalStart->format('Y-m-d'), $festivalEnd->format('Y-m-d'), false);

        $pressProjection = $this->getDoctrineManager()->getRepository('BaseCoreBundle:PressProjection')->findOneById($this->getParameter('admin_press_projection_id'));
        if ($pressProjection === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCPressPagePressProjectionSeo($pressProjection, $locale);

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
     * @Route("/agenda")
     * @Template("FDCPressBundle:Agenda:agenda.html.twig")
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
     * @Template("FDCPressBundle:Agenda:room.html.twig")
     *
     */
    public function roomAction()
    {

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

        // SEO
        $this->get('base.manager.seo')->setFDCPressPagePressCinemaMapSeo($rooms, $locale);

        return array(
            'rooms' => $rooms
        );

    }
}