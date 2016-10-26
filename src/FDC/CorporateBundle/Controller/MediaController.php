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

        if($request->isMethod('POST')) {
            $search = $request->get('search');
            $photo = $request->get('photo') ? true : false;
            $video = $request->get('video') ? true : false;
            $audio = $request->get('audio') ? true : false;
            $yearStart = $request->query->get('year-start');
            $yearEnd = $request->query->get('year-end');

            if(!$photo && !$video && !$audio) {
                $photo = true;
                $video = true;
                $audio = true;
            }

            //multi type does not work, doing it manually with single type
            $medias = array();
            if($photo) {
                $photos = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, true, false, false, $yearStart, $yearEnd, 30);
                foreach($photos as $photo) {
                    $medias[$photo->getId()] = $photo;
                }
            }

            if($video) {
                $videos = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, false, true, false, $yearStart, $yearEnd, 30);
                foreach($videos as $video) {
                    $medias[$video->getId()] = $video;
                }
            }

            if($audio) {
                $audios = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, false, false, true, $yearStart, $yearEnd, 30);
                foreach($audios as $audio) {
                    $medias[$audio->getId()] = $audio;
                }
            }

            ksort($medias);
        } else {
            if(!$page->getDisplayedSelection()) {
                $medias = $page->getMediasSelection();
            } else {
                $medias = array();
            }
        }

        if($request->get('_route') == 'fdc_corporate_media_index_ajax') {
            return $this->render('FDCCorporateBundle:Media:medias.html.twig', array('medias' => $medias));
        } else {
            return $this->render('FDCCorporateBundle:Media:index.html.twig', array('page' => $page, 'medias' => $medias));
        }
    }
}