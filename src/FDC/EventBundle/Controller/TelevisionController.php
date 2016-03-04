<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\FDCPageWebTvChannels;
use Base\CoreBundle\Entity\FDCPageWebTvLive;
use Base\CoreBundle\Entity\FDCPageWebTvLiveMediaVideoAssociated;
use Base\CoreBundle\Entity\FDCPageWebTvLiveWebTvAssociated;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMediaInterface;
use Base\CoreBundle\Entity\FilmFilmTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\WebTv;
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
        $this->isPageEnabled($request->get('_route'));
        $locale = $request->getLocale();
        $festival = $this->getSettings()->getFestival();

        $id = $this->get('twig')->getGlobals()['admin_fdc_page_web_tv_live_id'];
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageWebTvLive')
            ->find($id)
        ;

        if ($page instanceof FDCPageWebTvLive) {
            $this->createNotFoundException('Page Live not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageFDCPageWebTvLiveSeo($page, $locale);

        $sliderChosenChannels = array();
        $sliderOtherChannels = array();
        if (!$page->getDoNotDisplayWebTvArea()) {
            $in = array();
            foreach ($page->getAssociatedWebTvs() as $associatedWebTv) {
                if ($associatedWebTv->getAssociation()) {
                    $in[] = $associatedWebTv->getAssociation()->getId();
                }
            }

            $chosenChannels = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:WebTv')
                ->getLiveWebTvs($locale, $festival->getId(), array(), $in)
            ;

            $inFlipped = array_flip($in);

            foreach ($chosenChannels as $chosenChannel) {
                $channelVideos = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:MediaVideo')
                    ->getAvailableMediaVideosByWebTv($festival, $locale, $chosenChannel->getId())
                ;
                if ($channelVideos) {
                    $sliderChosenChannels[$inFlipped[$chosenChannel->getId()]] = array(
                        'channel'       => $chosenChannel,
                        'channelVideos' => $channelVideos,
                    );
                }
            }
            ksort($sliderChosenChannels);

            $otherChannels = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:WebTv')
                ->getLiveWebTvs($locale, $festival->getId(), $in)
            ;

            foreach ($otherChannels as $otherChannel) {
                $channelVideos = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:MediaVideo')
                    ->getAvailableMediaVideosByWebTv($festival, $locale, $otherChannel->getId())
                ;
                if ($channelVideos) {
                    $sliderOtherChannels[] = array(
                        'channel'       => $otherChannel,
                        'channelVideos' => $channelVideos,
                    );
                }
            }
        }

        $trailers = array();
        if (!$page->getDoNotDisplayTrailerArea()) {
            foreach ($page->getAssociatedMediaVideos() as $associatedMediaVideo) {
                if ($associatedMediaVideo->getAssociation()) {
                    $mediaVideo = $associatedMediaVideo->getAssociation();
                    if ($mediaVideo instanceof MediaVideo) {
                        $isPublished = $mediaVideo->findTranslationByLocale('fr')->getStatus() == MediaVideoTranslation::STATUS_PUBLISHED;
                        if ($locale !== 'fr') {
                            $isPublished = $isPublished && $mediaVideo->findTranslationByLocale($locale)->getStatus() == MediaVideoTranslation::STATUS_TRANSLATED;
                        }
                        $isTrailer = $isPublished && $mediaVideo->getDisplayedTrailer();
                        $hasFilms = $isTrailer && $mediaVideo->getAssociatedFilms()->count();
                        $associatedFilms = $mediaVideo->getAssociatedFilms();
                        $firstFilm = $associatedFilms[0]->getAssociation();
                        if ($hasFilms && $firstFilm) {
                            $trailers[$mediaVideo->getId()] = $mediaVideo;
                        }
                    }
                }
            }
        }

        if ($page->getDoNotDisplayLastVideosArea()) {
            $lastVideos = array();
        } else {
            $lastVideos = $this
                ->getBaseCoreMediaVideoRepository()
                ->get2VideosFromTheLast10($festival->getId(), $locale)
            ;
        }

        $videoUrl = null;
        if ($page->getLive() && $page->findTranslationByLocale($locale)->getDirectUrl()) {
            $videoUrl = $page->findTranslationByLocale($locale)->getDirectUrl();

        } elseif (!$page->getLive() && $page->findTranslationByLocale($locale)->getTeaserUrl()) {
            $videoUrl = $page->findTranslationByLocale($locale)->getTeaserUrl();
        }

        return array(
            'page'                 => $page,
            'sliderChosenChannels' => $sliderChosenChannels,
            'sliderOtherChannels'  => $sliderOtherChannels,
            'trailers'             => $trailers,
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
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaVideo')
            ->getAvailableMediaVideosByWebTv($festival, $locale, $webTv->getId())
        ;

        if (!$webTvVideos) {
            throw $this->createNotFoundException('There is no videos for this channel');
        }

        $otherVideos = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaVideo')
            ->get2VideosFromTheLast10($festival, $locale, $webTv->getId())
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
        $this->isPageEnabled($request->get('_route'));

        $festival = $this->getSettings()->getFestival()->getId();
        $locale = $request->getLocale();

        $id = $this->get('twig')->getGlobals()['admin_fdc_page_web_tv_channels_id'];
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageWebTvChannels')
            ->find($id)
        ;

        if (!($page instanceof FDCPageWebTvChannels)) {
            throw $this->createNotFoundException('Page channeles not found');
        }

        $stickyId = false;
        if ($page->getSticky()) {
            $stickyId = $page->getSticky()->getId();
        }

        $channels = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:WebTv')
            ->getWebTvByLocale($locale, $festival)
        ;

        $channelsIds = array();
        foreach ($channels as $channel) {
            $channelsIds[$channel->getId()] = $channel;
        }

        $groups = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaVideo')
            ->getLastMediaVideoOfEachWebTv($festival, $locale, array_keys($channelsIds))
        ;


        $channelsVideos = array();
        foreach ($groups as $key => $group) {
            if ($stickyId == $group['channel']) {
                $nbVideos = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:MediaVideo')
                    ->getAvailableMediaVideosByWebTv($festival, $locale, $group['channel'])
                ;
                $stickyChannelVideo = array(
                    'channel'  => $channelsIds[$group['channel']],
                    'video'    => $group['lastVideo'],
                    'nbVideos' => count($nbVideos),

                );
            } else if (array_key_exists($group['channel'], $channelsIds)) {
                $nbVideos = $this
                    ->getDoctrineManager()
                    ->getRepository('BaseCoreBundle:MediaVideo')
                    ->getAvailableMediaVideosByWebTv($festival, $locale, $group['channel'])
                ;
                $channelsVideos[] = array(
                    'channel'  => $channelsIds[$group['channel']],
                    'video'    => $group['lastVideo'],
                    'nbVideos' => count($nbVideos),
                );
            }
        }

        if (isset($stickyChannelVideo)) {
            array_unshift($channelsVideos, $stickyChannelVideo);
        }

        $this->get('base.manager.seo')->setFDCEventPageFDCPageWebTvChannelsSeo($page, $locale);

        return array(
            'channelsVideos' => $channelsVideos,
            'channels'       => $channels,
            'page'           => $page,
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
        $this->isPageEnabled($request->get('_route'));
        $locale = $request->getLocale();
        $festival = $this->getFestival()->getId();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageWebTvTrailers')
            ->getAllTrailersPage($festival, $locale)
        ;

        if ($slug === null) {
            $translation = current($pages)->findTranslationByLocale($request->getLocale());
            if ($translation) {
                if (!$translation->getSlug()) {
                    throw $this->createNotFoundException();
                }
                return $this->redirectToRoute('fdc_event_television_trailers', array(
                    'slug' => $translation->getSlug(),
                ));
            }
        }

        $pageTranslation = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageWebTvTrailersTranslation')
            ->findOneBySlug($slug)
        ;

        if (!$pageTranslation) {
            throw $this->createNotFoundException('Page Translation not found');
        }

        $page = $pageTranslation->getTranslatable();

        $this->get('base.manager.seo')->setFDCEventPageFDCPageWebTvTrailersSeo($page, $locale);

        $sectionSection = $page->getSelectionSection()->getId();

        $filmsTrailers = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaVideo')
            ->getLastMediaVideoTrailerOfEachFilmFilm($festival, $locale, null, $sectionSection)
        ;

        $groups = array();
        foreach ($filmsTrailers as $filmTrailer) {
            $groups[$filmTrailer['film_id']] = array(
                'video' => $filmTrailer['lastVideo'],
            );
        }

        $films = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsByIds(array_keys($groups))
        ;

        foreach ($films as $film) {
            $groups[$film->getId()]['film'] = $film;
        }

        return array(
            'page'   => $page,
            'pages'  => $pages,
            'groups' => $groups,
        );
    }

    /**
     * @param Request $request
     * @param $slug
     * @return array
     * @Route("/trailer/{slug}/{video}")
     * @Template("FDCEventBundle:Television:trailer.html.twig")
     */
    public function getTrailerAction(Request $request, $slug, $video = null)
    {
        $locale = $request->getLocale();
        $festivalId = $this->getFestival()->getId();

        $film = $this
            ->getBaseCoreFilmFilmRepository()
            ->findOneBySlug($slug)
        ;

        if (!($film instanceof FilmFilm)) {
            throw $this->createNotFoundException('FilmFilmTranslation not found.');
        }

        $filmTranslation = $film->findTranslationByLocale($locale);

        /************* Trailers **************/
        $videos = $this
            ->getBaseCoreMediaVideoRepository()
            ->getAvailableTrailersByFilm($festivalId, $locale, $film->getId())
        ;

        $poster = null;
        foreach ($film->getMedias() as $media) {
            if ($media->getType() === FilmFilmMediaInterface::TYPE_POSTER && $media->getMedia()->getFile()) {
                $poster = $media->getMedia()->getFile();
            }
        }


        $videos = $this->getBaseCoreMediaVideoRepository()->getFilmTrailersMediaVideos($festivalId, $locale, $film->getId());


        /************* NextFilms **************/
        $filmsTrailers = $this
            ->getBaseCoreMediaVideoRepository()
            ->getLastMediaVideoTrailerOfEachFilmFilm($festivalId, $locale, null, null)
        ;

        $groups = array();
        foreach ($filmsTrailers as $filmTrailer) {
            $groups[$filmTrailer['film_id']] = array(
                'video' => $filmTrailer['lastVideo'],
            );
        }

        $films = $this->getBaseCoreFilmFilmRepository()->getFilmsByIds(array_keys($groups));

        foreach ($films as $item) {
            $groups[$item->getId()]['film'] = $item;
        }

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
        if (!($next instanceof FilmFilm) && $films) {
            $next = reset($films);
        }

        $posterNext = null;
        if ($next instanceof FilmFilm) {
            foreach ($next->getMedias() as $media) {
                if ($media->getType() === FilmFilmMediaInterface::TYPE_POSTER && $media->getMedia() && $media->getMedia()->getFile()) {
                    $posterNext = $media->getMedia()->getFile();
                    $posterNextFormat = 'small';
                }
            }
        }
        if ($posterNext === null) {
            $posterNext = $groups[$next->getId()]['video']->getImage();
            $posterNextFormat = '640x404';
        }

        /************* Projections **************/
        $projections = $this->getBaseCoreFilmProjectionRepository()->getNextProjectionByFilm($film);

        $filmShowings = array();
        foreach ($projections as $projection) {
            $filmShowings[] = array(
                'type'  => $projection->getType(),
                'date'  => $projection->getStartAt(),
                'place' => $projection->getRoom()->getName(),
            );
        }

        /************* SEO **************/
        $route = $request->get('_route');
        $routeParams = $request->get('_route_params');
        $path = $this->generateUrl($route, $routeParams, UrlGeneratorInterface::ABSOLUTE_URL);

        $filmTitle = $filmTranslation->getTitle() ? $filmTranslation->getTitle() : $film->getTitleVO();
        $title = $this
            ->get('translator')
            ->trans('seo.trailer.title', array('%film_title%' => $filmTitle), 'FDCEventBundle')
        ;

        $description = $this
            ->get('translator')
            ->trans('seo.trailer.description', array('%film_title%' => $filmTranslation->getTitle()), 'FDCEventBundle')
        ;

        $updatedAt = end($videos)->getUpdatedAt();
        $image = $film->getImage();

        $this
            ->get('base.manager.seo')
            ->setFDCEventPageFDCPageWebTvTrailerSeo($path, $title, $description, $updatedAt, $image)
        ;
        return array(
            'film'         => $film,
            'videos'       => array_values($videos),
            'filmShowings' => $filmShowings,
            'poster'       => $poster,
            'next'         => $next instanceof FilmFilm ? $next : null,
            'posterNext'   => $posterNext,
            'posterNextFormat'   => $posterNextFormat,
        );
    }
}
