<?php

namespace FDC\CorporateBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Route("/more", name="fdc_corporate_media_index_ajax")
     * @Template("FDCCorporateBundle:Media:index.html.twig")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoMediatheque')
            ->find(1)
        ;
        $locale = $request->getLocale();

        $noresults = false;
        $moreresults = true;

        if ($request->isMethod('POST')) {
            $search = $request->request->get('search');
            $photo = $request->request->get('photo') ? true : false;
            $video = $request->request->get('video') ? true : false;
            $audio = $request->request->get('audio') ? true : false;
            $pg = $request->request->get('pg') ? $request->get('pg') : 1;
            $yearStart = $request->request->get('year-start');
            $yearEnd = $request->request->get('year-end');

            if (!$photo && !$video && !$audio) {
                $photo = true;
                $video = true;
                $audio = true;
            }

            if (!$request->get('ajax')) {
                return $this->redirectToRoute('fdc_corporate_media_index', [
                    'search'    => $search,
                    'photo'     => $photo,
                    'video'     => $video,
                    'audio'     => $audio,
                    'pg'        => $pg,
                    'yearStart' => $yearStart,
                    'yearEnd'   => $yearEnd,
                    'getsearch' => true
                ]);
            }

            //multi type does not work, doing it manually with single type
            $medias = [];
            if ($photo) {
                //MediaImage
                $items = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:Media')
                    ->searchMedias($locale, $search, true, false, false, $yearStart, $yearEnd, 30)
                ;
                $medias = array_merge($medias, $items);

                //FilmFilmMedia
                $items = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:FilmFilmMedia')
                    ->getMedias($search, $yearStart, $yearEnd);
                $medias = array_merge($medias, $items);

                //FilmPersonMedia
                $items = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:FilmPersonMedia')
                    ->getMedias($search, $yearStart, $yearEnd);
                $medias = array_merge($medias, $items);
            }

            if ($video) {
                $items = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:Media')
                    ->searchMedias($locale, $search, false, true, false, $yearStart, $yearEnd, 30);
                $medias = array_merge($medias, $items);
            }

            if ($audio) {
                $items = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:Media')
                    ->searchMedias($locale, $search, false, false, true, $yearStart, $yearEnd, 30);
                $medias = array_merge($medias, $items);
            }

            $items = 30;
            $pageMedias = [];
            $start = $pg != 1 ? $pg * $items : 0;
            $end = count($medias) > ($start + $items) ? $start + $items : count($medias) - 1;
            for ($i = $start; $i <= $end; $i++) {
                $pageMedias[] = $medias[$i];
            }

            if ($end == count($medias) - 1) {
                $moreresults = false;
            }

            $medias = $pageMedias;

            if (count($medias) == 0) {
                $noresults = true;
            }

        }
        if ($noresults) {
            if (!$page->getDisplayedSelection()) {
                $medias = $page->getMediasSelection();
            } else {
                $medias = [];
            }
            $moreresults = false;
        } elseif (!$request->isMethod('POST')) {

            $search = $request->get('search');
            $photo = $request->get('photo') ? true : false;
            $video = $request->get('video') ? true : false;
            $audio = $request->get('audio') ? true : false;
            $pg = $request->get('pg') ? $request->get('pg') : 1;
            $yearStart = $request->get('yearStart');
            $yearEnd = $request->get('yearEnd');

            if (!$photo && !$video && !$audio) {
                $photo = true;
                $video = true;
                $audio = true;
            }

            //multi type does not work, doing it manually with single type
            $medias = [];
            if ($photo) {
                //MediaImage
                $photos = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, true, false, false, $yearStart, $yearEnd, 30);
                foreach ($photos as $p) {
                    $medias[] = $p;
                }

                //FilmFilmMedia
                $photosFilm = $em->getRepository('BaseCoreBundle:FilmFilmMedia')->getMedias($search, $yearStart, $yearEnd);
                foreach ($photosFilm as $p) {
                    $medias[] = $p;
                }

                //FilmPersonMedia
                $photosPerson = $em->getRepository('BaseCoreBundle:FilmPersonMedia')->getMedias($search, $yearStart, $yearEnd);
                foreach ($photosPerson as $p) {
                    $medias[] = $p;
                }


            }

            if ($video) {
                $videos = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, false, true, false, $yearStart, $yearEnd, 30);
                foreach ($videos as $video) {
                    $medias[] = $video;
                }
            }

            if ($audio) {
                $audios = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, false, false, true, $yearStart, $yearEnd, 30);
                foreach ($audios as $audio) {
                    $medias[] = $audio;
                }
            }

            $items = 30;
            $pageMedias = [];
            $start = $pg != 1 ? $pg * $items : 0;
            $end = count($medias) > ($start + $items) ? $start + $items : count($medias) - 1;
            for ($i = $start; $i <= $end; $i++) {
                $pageMedias[] = $medias[$i];
            }

            if ($end == count($medias) - 1) {
                $moreresults = false;
            }

            $medias = $pageMedias;

            if (count($medias) == 0) {
                $noresults = true;
            }


//            $finalMedias = array();
//            foreach ($medias as $media) {
//                if(get_class($media) == 'Base\CoreBundle\Entity\FilmFilmMedia') {
//                    $finalMedias[$media->getFilm()->getFestival()->getFestivalStartsAt()->getTimestamp().'-'.$media->getId().'-'.get_class($media)] = $media;
//                }
//                if(get_class($media) == 'Base\CoreBundle\Entity\FilmPersonMedia') {
//                    $finalMedias[$media->getMedia()->getFestival()->getFestivalStartsAt()->getTimestamp().'-'.$media->getId().'-'.get_class($media)] = $media;
//                }
//                if(get_class($media) == 'Base\CoreBundle\Entity\MediaVideo') {
//                    $finalMedias[$media->getPublishedAt()->getTimestamp().'-'.$media->getId().'-'.get_class($media)] = $media;
//                }
//            }
//            ksort($finalMedias);
//            dump($finalMedias);exit;
        }

        if ($request->get('_route') == 'fdc_corporate_media_index_ajax') {
            return $this->render('FDCCorporateBundle:Media:components/medias.html.twig', ['medias' => $medias]);
        } else {
            return $this->render(
                'FDCCorporateBundle:Media:index.html.twig',
                [
                    'page'        => $page,
                    'medias'      => $medias,
                    'noresults'   => $noresults,
                    'moreresults' => $moreresults
                ]
            );
        }
    }
}