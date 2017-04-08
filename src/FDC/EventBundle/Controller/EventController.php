<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class EventController extends Controller
{
    /**
     * @Route("/event/{slug}")
     * @Template("FDCEventBundle:Event:page.html.twig")
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function getAction(Request $request, $slug)
    {
        $festival = $this->getFestival()->getId();
        $locale = $request->getLocale();

        $event = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Event')
            ->getEventBySlug($festival, $locale, $slug)
        ;
        $this->throwNotFoundExceptionOnNullObject($event);

        $programmations = array();
        foreach ($event->getAssociatedProjections() as $projection) {
            if ($projection->getAssociation()) {
                $programmations[] = $projection->getAssociation();
            }
        }

        $events =
            $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Event')
                ->getEvents($festival, $locale)
        ;

        $prev = null;
        $next = null;
        $countEvents = count($events);
        foreach ($events as $key => $tmp) {
            if ($tmp->getId() == $event->getId()) {
                if ($key == 0) {
                    $prev = $events[$countEvents - 1];
                    $next = $events[1];
                } elseif ($key == $countEvents - 1) {
                    $prev = $events[$countEvents - 2];
                    $next = $events[0];
                } else {
                    if (isset($events[$key - 1])) {
                        $prev = $events[$key - 1];
                    }
                    if (isset($events[$key + 1])) {
                        $next = $events[$key + 1];
                    }
                }
                break;
            }
        }

        return array(
            'prev' => $prev,
            'next' => $next,
            'event'   => $event,
            'programmations'   => $programmations,
            'localeSlugs' => $event->getLocaleSlugs(),
        );
    }


    /**
     * @Route("/events")
     * @Template("FDCEventBundle:Event:list.html.twig")
     * @param Request $request
     * @return array
     */
    public function getEventsAction(Request $request)
    {
        $locale = $request->getLocale();
        $festival = $this->getFestival()->getId();

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
        );
    }
}
