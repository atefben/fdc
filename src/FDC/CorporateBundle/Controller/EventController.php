<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/69-editions/retrospective")
 */
class EventController extends Controller
{
    /**
     * @Route("/{year}/events")
     * @Template("FDCCorporateBundle:Event:list.html.twig")
     * @param Request $request
     * @return array
     */
    public function getEventsAction(Request $request, $year)
    {
        $locale = $request->getLocale();
        $festival = $this->getFestival($year)->getId();
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        $this->isPageEnabled($request->get('_route'));


        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageEvent')
            ->find($this->getParameter('admin_fdc_page_event_id'))
        ;
        if (!$page) {
            throw $this->createNotFoundException('Page event is not well-configured');
        }

        $events =
            $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Event')
                ->getEvents($festival, $locale)
        ;

        $dates = array();
        $themes = array();
        foreach ($events as $event) {
            if ($event instanceof Event) {
                $key = $event->getPublishedAt()->format('Y-m-d');
                if (!array_key_exists($key, $dates)) {
                    $dates[$key] = $event->getPublishedAt();
                }
                $key = $event->getTheme()->getId();
                if (!array_key_exists($key, $themes)) {
                    $themes[$key] = $event->getTheme();
                }
            }
        }
        $filters['dates'] = $dates;
        $filters['themes'] = $themes;

        return array(
            'page'    => $page,
            'events'  => $events,
            'filters' => $filters,
            'festivals' => $festivals,
        );
    }
}
