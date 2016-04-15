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

        // filter selection
        $selections = array();
        foreach ($projections as $tmp) {
            foreach ($tmp as $projection) {
                foreach ($projection->getProgrammationFilms() as $projectionProgrammationFilm) {
                    $film = $projectionProgrammationFilm->getFilm();
                    $selections[$film->getSelectionSection()->getId()] = $film->getSelectionSection();
                }
            }
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
     * @Route("/day", options={"expose"=true}))
     * @Template("FDCEventBundle:Global:projection.html.twig")
     * @param Request $request
     * @return array
     */
    public function getDayProjectionsAction(Request $request) {

        $em = $this->get('doctrine')->getManager();

        $date = $request->get('date');

        $dayProjection = array();
        if ($request->headers->get('host') == $this->getParameter('fdc_press_domain') ) {

            // GET DAY PROJECTIONS
            /*$dayProjection = $em->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionByDate($date);

            $path = $request->headers->get('referer');
            if ($path !== null) {
                $path = parse_url($path)['path'];
                if (strpos($path, '/app_dev.php') !== false) {
                    $path = explode('/', $path);
                    unset($path[1]);
                    $path = implode('/', $path);
                }
                $router = $this->get('router');
                $route = $router->match($path)['_route'];
                // If we are on homepage
                if ($route == 'fdc_press_news_home') {
                    // Event have to be in 5h max
                    $hourRange = array();
                    $newDate = new \DateTime;
                    $endHour = $newDate->modify('+ 5 hour')->format('H');

                    while ($date->format('H') <= $endHour) {

                        array_push($hourRange, $date->format('H'));
                        $date->modify('+ 1 hour')->format('H');
                    }

                    foreach ( $dayProjection as $key => $projection ) {
                        if (!in_array($projection->getStartsAt()->format('H'), $hourRange)) {
                            unset($dayProjection[$key]);
                        }
                    }
                }
            }*/
        }
        else {
            // Grab Event Site projections
        }
        return array(
            'dayProjection' => $dayProjection,
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