<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Base\CoreBundle\Entity\Media;
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

        $search = $request->get('search');
        $photo = (bool)$request->get('photo');
        $video = (bool)$request->get('video');
        $audio = (bool)$request->get('audio');
        $pg = $request->get('pg', 1);
        $yearStart = $request->get('yearStart');
        $yearStart = $request->get('yearStart');
        $yearEnd = $request->get('yearEnd');

        $parameters = $this->getMediasParameters($locale, $search, $photo, $video, $audio, $yearStart, $yearEnd, $pg);

        if (!$parameters['medias'] && !$page->getDisplayedSelection()) {
            $parameters['medias'] = $page->getMediasSelection();
            $parameters['last'] = true;
            $parameters['noResult'] = true;
        } else {
            $parameters['noResult'] = false;
        }
        $parameters = array_merge($parameters, ['page' => $page]);

        return $this->render('FDCCorporateBundle:Media:index.html.twig', $parameters);
    }

    /**
     * @Route("/more", name="fdc_corporate_media_index_ajax")
     * @param Request $request
     * @return Response
     */
    public function indexAjaxAction(Request $request)
    {
        $locale = $request->getLocale();
        $search = $request->request->get('search');
        $photo = (bool)$request->request->get('photo');
        $video = (bool)$request->request->get('video');
        $audio = (bool)$request->request->get('audio');
        $pg = $request->request->get('pg', 1);
        $yearStart = $request->request->get('year-start');
        $yearEnd = $request->request->get('year-end');

        $parameters = $this->getMediasParameters($locale, $search, $photo, $video, $audio, $yearStart, $yearEnd, $pg);
        return $this->render('FDCCorporateBundle:Media:components/medias.html.twig', $parameters);
    }

    /**
     * @param $locale
     * @param $search
     * @param $photo
     * @param $video
     * @param $audio
     * @param $yearStart
     * @param $yearEnd
     * @param int $page
     * @return array
     */
    private function getMediasParameters($locale, $search, $photo, $video, $audio, $yearStart, $yearEnd, $page = 1)
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
                ->searchMedias($locale, $search, true, false, false, $yearStart, $yearEnd, 31)
            ;
            $medias = array_merge($medias, $items);

            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilmMedia')
                ->getMedias($search, $yearStart, $yearEnd)
            ;
            $medias = array_merge($medias, $items);

            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFestivalPoster')
                ->getMedias($locale, $search, $yearStart, $yearEnd)
            ;
            $medias = array_merge($medias, $items);

            //FilmPersonMedia
            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmPersonMedia')
                ->getMedias($search, $yearStart, $yearEnd)
            ;
            $medias = array_merge($medias, $items);
        }

        if ($video) {
            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Media')
                ->searchMedias($locale, $search, false, true, false, $yearStart, $yearEnd, 31)
            ;
            $medias = array_merge($medias, $items);
        }

        if ($audio) {
            $items = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Media')
                ->searchMedias($locale, $search, false, false, true, $yearStart, $yearEnd, 31)
            ;
            $medias = array_merge($medias, $items);
        }
        usort($medias, [$this, 'sortMedias']);
        return [
            'medias' => array_slice($medias, ($page - 1) * 30, 30),
            'last'   => !(bool)count($medias) > 30,
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
        }
    }


}