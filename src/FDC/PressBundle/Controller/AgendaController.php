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

        $homeProjection = $em->getRepository('BaseCoreBundle:FilmProjection')
            ->findByFestival($settings->getFestival()->getId());

        $typeFilters = array();
        $selectionFilters = array();
        $type = array();
        $selection = array();

        $i = 0;

        foreach ($homeProjection as $projection) {

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

        return array(
            'schedulingDays' => $schedulingDays,
            'typeFilters' => $typeFilters,
            'selectionFilters' => $selectionFilters,
            'homeProjection' => $homeProjection,
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

        //GET PRESS HOMEPAGE
        $rooms = $em->getRepository('BaseCoreBundle:PressCinemaMap')->findOneBy(array(
            'festival' => $settings->getFestival()->getId()
        ));

        return array(
            'rooms' => $rooms
        );

    }
}