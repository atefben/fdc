<?php

namespace FDC\CorporateBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
        $page = $em->getRepository('BaseCoreBundle:CorpoMediatheque')->find(1);
        $locale = $request->getLocale();

        $noresults = false;

        if($request->isMethod('POST')) {
            $search = $request->get('search');
            $photo = $request->get('photo') ? true : false;
            $video = $request->get('video') ? true : false;
            $audio = $request->get('audio') ? true : false;
            $pg = $request->get('pg') ? $request->get('pg') : 1;
            $yearStart = $request->get('year-start');
            $yearEnd = $request->get('year-end');

            if(!$photo && !$video && !$audio) {
                $photo = true;
                $video = true;
                $audio = true;
            }

            //multi type does not work, doing it manually with single type
            $medias = array();
            if($photo) {
                //MediaImage
                $photos = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, true, false, false, $yearStart, $yearEnd, 30);
                foreach($photos as $p) {
                    $medias[] = $p;
                }

                //FilmFilmMedia
                $photosFilm = $em->getRepository('BaseCoreBundle:FilmFilmMedia')->getMedias($search, $yearStart, $yearEnd);
                foreach($photosFilm as $p) {
                    $medias[] = $p;
                }

                //FilmPersonMedia
                $photosPerson = $em->getRepository('BaseCoreBundle:FilmPersonMedia')->getMedias($search, $yearStart, $yearEnd);
                foreach($photosPerson as $p) {
                    $medias[] = $p;
                }
                
                
            }

            if($video) {
                $videos = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, false, true, false, $yearStart, $yearEnd, 30);
                foreach($videos as $video) {
                    $medias[] = $video;
                }
            }

            if($audio) {
                $audios = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, false, false, true, $yearStart, $yearEnd, 30);
                foreach($audios as $audio) {
                    $medias[] = $audio;
                }
            }

            $items = 30;
            $pageMedias = array();
            $start = $pg != 1 ? $pg * $items : 0;
            $end = count($medias) > ($start+$items) ? $start + $items : count($medias)-1;
            for($i=$start; $i<=$end; $i++) {
                $pageMedias[] = $medias[$i];
            }

            $medias = $pageMedias;

            if(count($medias) == 0) {
                $noresults = true;
            }
        }

        if($noresults || !$request->isMethod('POST')) {
            if(!$page->getDisplayedSelection()) {
                $medias = $page->getMediasSelection();
            } else {
                $medias = array();
            }
        }

        if($request->get('_route') == 'fdc_corporate_media_index_ajax') {
            return $this->render('FDCCorporateBundle:Media:medias.html.twig', array('medias' => $medias));
        } else {
            return $this->render('FDCCorporateBundle:Media:index.html.twig', array('page' => $page, 'medias' => $medias, 'noresults' => $noresults));
        }
    }
}