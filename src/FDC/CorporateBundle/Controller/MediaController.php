<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\FilmFestivalPoster;
use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Base\CoreBundle\Entity\Media;
use FDC\CorporateBundle\Entity\CorpoMediaLibraryItem;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/mediatheque")
 * Class MediaController
 * @package FDC\EventBundle\Controller
 */
class MediaController extends Controller
{
    /**
     * @Route("/", name="fdc_corporate_media_index")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoMediatheque')
            ->find(1)
        ;

        if (!$page) {
            throw $this->createNotFoundException();
        }

        $locale = $request->getLocale();

        $parameters = ['medias' => []];
        if ($request->query->has('search')) {
            $search = $request->get('search');
            $photo = (bool)$request->get('photo');
            $video = (bool)$request->get('video');
            $audio = (bool)$request->get('audio');
            $yearStart = $request->get('yearStart');
            $yearEnd = $request->get('yearEnd');
            $parameters = $this->getCorpoMediaLibraryItemParameters($locale, $search, $photo, $video, $audio, $yearStart, $yearEnd);
        }

        if (!$parameters['medias'] && !$page->getDisplayedSelection()) {
            $parameters['medias'] = $page->getMediasSelection();
            $parameters['ourSelection'] = true;
            $parameters['last'] = true;
            $parameters['noResult'] = false;
            if ($request->query->has('search')) {
                $parameters['noResult'] = true;
            }
        } else {
            $parameters['noResult'] = false;
        }
        $parameters = array_merge($parameters, ['page' => $page]);

        return $this->render('FDCCorporateBundle:Media:index.html.twig', $parameters);
    }

    /**
     * @Route("/more/{since}", name="fdc_corporate_media_index_ajax")
     * @param Request $request
     * @return Response
     */
    public function indexAjaxAction(Request $request, $since)
    {
        $locale = $request->getLocale();
        $search = $request->request->get('search');
        $photo = (bool)$request->request->get('photo');
        $video = (bool)$request->request->get('video');
        $audio = (bool)$request->request->get('audio');
        $start = $request->request->get('yearStart');
        $end = $request->request->get('yearEnd');

        $parameters = $this->getCorpoMediaLibraryItemParameters($locale, $search, $photo, $video, $audio, $start, $end, $since);
        return $this->render('FDCCorporateBundle:Media:index.more.html.twig', $parameters);
    }

    /**
     * @param $locale
     * @param $search
     * @param $photo
     * @param $video
     * @param $audio
     * @param $yearStart
     * @param $yearEnd
     * @param $since
     * @return array
     */
    private function getMediasParameters($locale, $search, $photo, $video, $audio, $yearStart, $yearEnd, $since = null)
    {
        if (!$photo && !$video && !$audio) {
            $photo = true;
            $video = true;
            $audio = true;
        }
        $medias = [];
        if ($photo) {
            //MediaImage
            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Media')
                ->searchMedias($locale, $search, 'image', $yearStart, $yearEnd, 31, $since)
            ;
            $medias = array_merge($medias, $items);

            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilmMedia')
                ->getMedias($search, $yearStart, $yearEnd, $since)
            ;
            $medias = array_merge($medias, $items);

            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFestivalPoster')
                ->getMedias($locale, $search, $yearStart, $yearEnd, $since)
            ;
            $medias = array_merge($medias, $items);

            //FilmPersonMedia
            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmPersonMedia')
                ->getMedias($search, $yearStart, $yearEnd, $since)
            ;
            $medias = array_merge($medias, $items);
        }

        if ($video) {
            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Media')
                ->searchMedias($locale, $search, 'video', $yearStart, $yearEnd, 31, $since)
            ;
            $medias = array_merge($medias, $items);
        }

        if ($audio) {
            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Media')
                ->searchMedias($locale, $search, 'audio', $yearStart, $yearEnd, 31, $since)
            ;
            $medias = array_merge($medias, $items);
        }

        usort($medias, [$this, 'sortMedias']);

        $last = true;
        $since = false;
        if (count($medias) > 30) {
            $last = false;
        }
        $medias = array_slice($medias, 0, 30);
        $lastItem = end($medias);
        if ($lastItem) {
            $since = $this->getDateItem($lastItem);
        }
        $filters = [];
        if ($search) {
            $filters['search'] = $search;
        }
        if ($photo) {
            $filters['photo'] = 'on';
        }
        if ($video) {
            $filters['video'] = 'on';
        }
        if ($audio) {
            $filters['audio'] = 'on';
        }
        if ($yearStart) {
            $filters['yearStart'] = $yearStart;
        }
        if ($yearEnd) {
            $filters['yearEnd'] = $yearEnd;
        }
        $filtersString = '';
        foreach ($filters as $key => $value) {
            $filtersString .= ($filtersString ? '&' : '?') . "$key=$value";
        }
        return [
            'medias'        => $medias,
            'last'          => $last,
            'since'         => $since,
            'filtersString' => $filtersString,
        ];
    }

    private function sortMedias($a, $b)
    {
        $aTime = $this->getDateItem($a)->getTimestamp();
        $bTime = $this->getDateItem($b)->getTimestamp();
        if ($aTime == $bTime) {
            return 0;
        }
        return ($aTime > $bTime) ? -1 : 1;
    }

    /**
     * @param $item
     * @return \DateTime
     */
    private function getDateItem($item)
    {
        if ($item instanceof Media) {
            return $item->getPublishedAt();
        } elseif ($item instanceof FilmFilmMedia) {
            return $item->getUpdatedAt();
        } elseif ($item instanceof FilmPersonMedia) {
            return $item->getUpdatedAt();
        } elseif ($item instanceof FilmFestivalPoster) {
            return $item->getUpdatedAt();
        }
    }

    private function getCorpoMediaLibraryItemParameters($locale, $search, $photo, $video, $audio, $yearStart, $yearEnd, $page = 1)
    {
        if (!$photo && !$video && !$audio) {
            $photo = true;
            $video = true;
            $audio = true;
        }
        $items = $this
            ->getDoctrineManager()
            ->getRepository('FDCCorporateBundle:CorpoMediaLibraryItem')
            ->getItems($locale, $search, $photo, $video, $audio, $yearStart, $yearEnd)
        ;

        $filters = [];
        $filters['search'] = $search;
        if ($photo) {
            $filters['photo'] = 'on';
        }
        if ($video) {
            $filters['video'] = 'on';
        }
        if ($audio) {
            $filters['audio'] = 'on';
        }
        if ($yearStart) {
            $filters['yearStart'] = $yearStart;
        }
        if ($yearEnd) {
            $filters['yearEnd'] = $yearEnd;
        }
        $filtersString = '';
        foreach ($filters as $key => $value) {
            $filtersString .= ($filtersString ? '&' : '?') . "$key=$value";
        }

        return [
            'last'          => count($items) < 31,
            'medias'        => $this->loadMedias(array_slice($items, 0, 30)),
            'since'         => $page + 1,
            'filtersString' => $filtersString,
        ];
    }

    private function loadMedias($items)
    {
        $medias = [];
        foreach ($items as $item) {
            if ($item instanceof CorpoMediaLibraryItem) {
                $medias[] = $this
                    ->getDoctrineManager()
                    ->getRepository($item->getEntityClass())
                    ->find($item->getEntityId())
                ;
            }
        }
        return $medias;
    }

}