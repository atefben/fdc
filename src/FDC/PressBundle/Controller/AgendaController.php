<?php

namespace FDC\PressBundle\Controller;

use Base\CoreBundle\Entity\PressProjection;
use Base\CoreBundle\Entity\PressProjectionScheduling;
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

        if (in_array($date->format('Ymd'), $schedulingDays)) {
            // GET DAY PROJECTIONS
            $homeProjection = $em->getRepository('BaseCoreBundle:PressProjectionScheduling')
                ->getProjectionByDate($date->format('Ymd'));

            // GET DAY PROJECTIONS
            $homePressProjection = $em->getRepository('BaseCoreBundle:PressProjectionPressScheduling')
                ->getProjectionByDate($date->format('Ymd'));
        }
        else {
            // GET DAY PROJECTIONS
            $homeProjection = $em->getRepository('BaseCoreBundle:PressProjectionScheduling')
                ->getProjectionByDate($festivalStartsAt->format('Ymd'));

            // GET DAY PROJECTIONS
            $homePressProjection = $em->getRepository('BaseCoreBundle:PressProjectionPressScheduling')
                ->getProjectionByDate($festivalStartsAt->format('Ymd'));
        }

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
            'homePressProjection' => $homePressProjection,
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