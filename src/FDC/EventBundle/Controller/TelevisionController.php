<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\FDCPageWebTvLiveMediaVideoAssociated;
use Base\CoreBundle\Entity\FDCPageWebTvLiveWebTvAssociated;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMediaInterface;
use Base\CoreBundle\Entity\FilmFilmTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\NewsArticle;
use FDC\EventBundle\Component\Controller\Controller;
use Gedmo\Sluggable\SluggableListener;
use Gedmo\Sluggable\Util\Urlizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/web-tv")
 */
class TelevisionController extends Controller
{
    /**
     * @param Request $request
     * @Route("/live")
     * @Template("FDCEventBundle:Television:live.html.twig")
     * @return array
     */
    public function liveAction(Request $request)
    {
        $locale = $request->getLocale();
        $festival = $this->getSettings()->getFestival();

        $id = $this->get('twig')->getGlobals()['admin_fdc_page_web_tv_live_id'];
        $page = $this
            ->getBaseCoreFDCPageWebTvLiveRepository()
            ->find($id)
        ;

        if (!$page) {
            $this->createNotFoundException('Page Live not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageFDCPageWebTvLiveSeo($page, $locale);

        $sliderChosenChannels = array();
        foreach ($page->getAssociatedWebTvs() as $associatedWebTv) {
            if ($associatedWebTv->getAssociation()) {
                $sliderChosenChannels[$associatedWebTv->getAssociation()->getId()] = $associatedWebTv->getAssociation();
            }
        }

        $sliderOtherChannels = $this
            ->getBaseCoreWebTvRepository()
            ->getRandomWebTvs($locale, $festival->getId(), array_keys($sliderChosenChannels))
        ;

        $films = array();
        foreach ($page->getAssociatedFilmFilms() as $associatedFilmFilm) {
            if ($associatedFilmFilm->getAssociation()) {
                $films[$associatedFilmFilm->getAssociation()->getId()] = $associatedFilmFilm->getAssociation();
            }
        }

        $lastVideos = $this
            ->getBaseCoreMediaVideoRepository()
            ->get2VideosFromTheLast10($locale, $festival->getId())
        ;

        $videoUrl = null;
        if ($page->getLive() && $page->getDirectUrl()) {
            $videoUrl = $page->getDirectUrl();
        } elseif (!$page->getLive() && $page->getTeaserUrl()) {
            $videoUrl = $page->getTeaserUrl();
        }

        return array(
            'page'                 => $page,
            'sliderChosenChannels' => $sliderChosenChannels,
            'sliderOtherChannels'  => $sliderOtherChannels,
            'films'                => $films,
            'videoUrl'             => $videoUrl,
            'lastVideos'           => $lastVideos,
        );
    }

    /**
     * @param Request $request
     * @param $slug
     * @return array
     * @throws NotFoundHttpException
     *
     * @Route("/channel/{slug}")
     * @Template("FDCEventBundle:Television:channel.html.twig")
     */
    public function getChannelAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $festival = $this->getFestival();
        $locale = $request->getLocale();

        $webTv = $em->getRepository('BaseCoreBundle:WebTv')->getWebTvBySlug($slug, $locale, $festival);


        if (!$webTv || !$webTv->getMediaVideos()->count()) {
            throw $this->createNotFoundException('Web TV not found');
        }

        $webTvVideos = $this
            ->getBaseCoreMediaVideoRepository()
            ->getWebTvPublishedVideos($locale, $festival->getId(), $webTv->getId())
        ;

        if (!$webTvVideos) {
            throw $this->createNotFoundException('There is no videos for this channel');
        }

        $otherVideos = $this
            ->getBaseCoreMediaVideoRepository()
            ->get2VideosFromTheLast10($locale, $festival->getId(), $webTv->getId())
        ;

        $this->get('base.manager.seo')->setFDCEventPageWebTvSeo($webTv, $locale);

        return array(
            'channel'     => $webTv,
            'webTvVideos' => $webTvVideos,
            'otherVideos' => $otherVideos,
        );
    }

    /**
     * @param Request $request
     * @return array
     * @Route("/channels")
     * @Template("FDCEventBundle:Television:channels.html.twig")
     */
    public function channelsAction(Request $request)
    {
        $festival = $this->getSettings()->getFestival();
        $id = $this->get('twig')->getGlobals()['admin_fdc_page_web_tv_channels_id'];
        $FDCPageWebTvChannels = $this
            ->getBaseCoreFDCPageWebTvChannelsRepository()
            ->find($id)
        ;

        if (!$FDCPageWebTvChannels) {
            throw $this->createNotFoundException();
        }

        $locale = $request->getLocale();

        $channels = $this->getBaseCoreWebTvRepository()->getWebTvByLocale($locale, $festival);

        $hasSticky = (bool)$FDCPageWebTvChannels->getSticky();
        $stickyIsValid = $hasSticky && $FDCPageWebTvChannels->getSticky()->findTranslationByLocale($locale);
        $stickyHasVideos = $stickyIsValid && $FDCPageWebTvChannels->getSticky()->getVideos();
        if ($stickyHasVideos) {
            array_unshift($channels, $FDCPageWebTvChannels->getSticky());
        }

        $this->get('base.manager.seo')->setFDCEventPageFDCPageWebTvChannelsSeo($FDCPageWebTvChannels, $locale);

        return array(
            'channels'             => $channels,
            'FDCPageWebTvChannels' => $FDCPageWebTvChannels,
        );
    }

    /**
     * @param Request $request
     * @param null $slug
     * @return array
     * @Route("/trailers/{slug}")
     * @Template("FDCEventBundle:Television:trailers.html.twig")
     */
    public function trailersAction(Request $request, $slug = null)
    {
        $locale = $request->getLocale();

        if ($slug === null) {
            $page = $this->getBaseCoreFDCPageWebTvTrailersRepository()->findBy(array(), null, 1);
            $translation = current($page)->findTranslationByLocale($request->getLocale());
            if ($translation) {
                return $this->redirectToRoute('fdc_event_television_trailers', array(
                    'slug' => $translation->getSlug(),
                ));
            }
        }
        $pageTranslation = $this
            ->getBaseCoreFDCPageWebTvTrailersTranslationRepository()
            ->findOneBySlug($slug)
        ;

        if (!$pageTranslation) {
            throw $this->createNotFoundException('Page Translation not found');
        }

        $page = $pageTranslation->getTranslatable();

        $this->get('base.manager.seo')->setFDCEventPageFDCPageWebTvTrailersSeo($page, $locale);

        $pages = $this->getBaseCoreFDCPageWebTvTrailersRepository()->findAll();

        $festivalId = $this->getFestival()->getId();

        $sectionId = $page->getSelectionSection()->getId();

        $films = $this->getBaseCoreFilmFilmRepository()->getFilmsThatHaveTrailers($festivalId, $locale, $sectionId);
        dump($films);
        return array(
            'page'  => $page,
            'pages' => $pages,
            'films' => $films,
        );
    }

    /**
     * @param Request $request
     * @param $slug
     * @return array
     * @Route("/trailer/{slug}")
     * @Template("FDCEventBundle:Television:trailer.html.twig")
     */
    public function getTrailerAction(Request $request, $slug)
    {
        $locale = $request->getLocale();

        $filmTranslation = $this
            ->getBaseCoreFilmFilmTranslationRepository()
            ->findOneBySlug($slug)
        ;

        if (!($filmTranslation instanceof FilmFilmTranslation)) {
            throw $this->createNotFoundException('FilmFilmTranslation not found.');
        }

        $film = $filmTranslation->getTranslatable();

        $festivalId = $this->getFestival()->getId();
        $sectionId = $film->getSelectionSection()->getId();

        $films = $this->getBaseCoreFilmFilmRepository()->getFilmsThatHaveTrailers($festivalId, $locale, $sectionId);


        $poster = null;
        foreach ($film->getMedias() as $media) {
            if ($media->getType() === FilmFilmMediaInterface::TYPE_POSTER) {
                $poster = $media->getFilmMedia();
            }
        }

        $videos = $this->getBaseCoreMediaVideoRepository()->getFilmTrailersMediaVideos($locale, $film->getId());

        $route = $this->generateUrl($request->get('_route'), $request->get('_route_params'), UrlGeneratorInterface::ABSOLUTE_URL);
        $title = $this
            ->get('translator')
            ->trans('seo.trailer.title', array('%film_title%' => $filmTranslation->getTitle()), 'FDCEventBundle');

        $description = $this
            ->get('translator')
            ->trans('seo.trailer.description', array('%film_title%' => $filmTranslation->getTitle()), 'FDCEventBundle');
        $updatedAt = end($films)->getUpdatedAt();
        $image = $film->getImage();

        $this
            ->get('base.manager.seo')
            ->setFDCEventPageFDCPageWebTvTrailerSeo($route, $title, $description, $updatedAt, $image)
        ;

        $next = null;
        foreach ($films as $key => $value) {
            if ($next) {
                $next = $value;
                break;
            }
            if ($value->getId() == $film->getId()) {
                $next = true;
            }
        }

        $posterNext = null;
        if ($next instanceof FilmFilm) {
            foreach ($next->getMedias() as $media) {
                if ($media->getType() === FilmFilmMediaInterface::TYPE_POSTER) {
                    $poster = $media->getFilmMedia();
                }
            }
        }
        $filmShowings = array(
            array(
                'date'  => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            ),
            array(
                'date'  => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            ),
            array(
                'date'  => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            ),
            array(
                'date'  => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            ),
            array(
                'date'  => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            )
        );

        return array(
            'film'         => $film,
            'videos'       => array_values($videos),
            'filmShowings' => $filmShowings,
            'poster'       => $poster,
            'next'         => $next instanceof FilmFilm ? $next : null,
            'posterNext'   => $posterNext,
        );
    }
}
