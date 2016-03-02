<?php

namespace FDC\PressBundle\Controller;

use Base\CoreBundle\Entity\PressProjection;
use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\DateTime;

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
    public function schedulingAction()
    {

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $festivalStartsAt = $settings->getFestival()->getFestivalStartsAt();
        $festivalEndsAt = $settings->getFestival()->getFestivalEndsAt();
        $schedulingDays = range($festivalStartsAt->format('d'), $festivalEndsAt->format('d'));
        $schedulingYear = $festivalStartsAt->format('Y');
        $schedulingMonth = $festivalStartsAt->format('m');

        array_walk($schedulingDays, function (&$value) use(&$schedulingYear, &$schedulingMonth) {
            $value = $schedulingYear ."-". $schedulingMonth ."-". $value;
        });

        $date = new \DateTime;

        $date = new \DateTime;
        if (in_array($date->format('Ymd'), $schedulingDays)) {

            $dayProjection = $em->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionByDate($date->format('Ymd'));

        }
        else {

            $dayProjection = $em->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionByDate($festivalStartsAt->format('Ymd'));

        }

        $typeFilters = array();
        $selectionFilters = array();
        $type = array();
        $selection = array();

        $i = 0;

        foreach ($dayProjection as $projection) {

            if (!in_array($projection->getType(), $type)) {
                $typeFilters[$i]['name'] = $projection->getType();
                $typeFilters[$i]['slug'] = mb_strtolower(preg_replace('/\s*/', '', $projection->getType()), mb_detect_encoding($projection->getType()));

                $type[] = $projection->getType();
            }
            if (!in_array($projection->getProgrammationSection(), $selection)) {
                $selectionFilters[$i]['name'] = $projection->getProgrammationSection();
                $selectionFilters[$i]['slug'] = mb_strtolower(preg_replace('/\s*/', '', $projection->getProgrammationSection()), mb_detect_encoding($projection->getProgrammationSection()));

                $selection[] = $projection->getProgrammationSection();
            }
            $i++;
        }

        $pressProjection = $em->getRepository('BaseCoreBundle:PressProjection')->findOneById($this->getParameter('admin_press_projection_id'));
        if ($pressProjection === null) {
            throw new NotFoundHttpException();
        }
        return array(
            'schedulingDays' => $schedulingDays,
            'typeFilters' => $typeFilters,
            'selectionFilters' => $selectionFilters,
            'dayProjection' => $dayProjection,
            'pressProjection' => $pressProjection
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

        return array(
            'rooms' => $rooms
        );

    }
}