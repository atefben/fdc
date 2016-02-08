<?php

namespace FDC\EventBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/web-tv")
 */
class TelevisionController extends Controller
{
    /**
     * @Route("/live")
     * @Template("FDCEventBundle:Television:live.html.twig")
     */
    public function liveAction()
    {

        $channels = array(
            array(
                'most_viewed' => true,
                'image'       => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => true,
                'image'       => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image'       => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image'       => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image'       => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image'       => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image'       => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum'
            )
        );

        $videos = array(
            array(
                'image'     => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'  => 5,
                'theme'     => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title'     => 'Lorem ipsum'
            ),
            array(
                'image'     => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos'  => 5,
                'theme'     => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title'     => 'Lorem ipsum'
            ),
        );
        return array(
            'channels' => $channels,
            'trailers' => $channels,
            'videos'   => $videos,
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
            throw $this->createNotFoundException();
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
     * @Route("/channels")
     * @Template("FDCEventBundle:Television:channels.html.twig")
     */
    public function channelsAction(Request $request)
    {
        $festival = $this->getSettings()->getFestival();

        $FDCPageWebTvChannels = $this->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageWebTvChannels')
            ->find($this->get('twig')->getGlobals()['admin_fdc_page_web_tv_channels_id'])
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
     * @Route("/trailers/{slug}")
     * @Template("FDCEventBundle:Television:trailers.html.twig")
     */
    public function trailersAction($slug)
    {

        $trailers = array(
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'  => 'img.jpg',
                    'src'   => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large' => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'  => 'img.jpg',
                    'src'   => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large' => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'  => 'img.jpg',
                    'src'   => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large' => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'  => 'img.jpg',
                    'src'   => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large' => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'  => 'img.jpg',
                    'src'   => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large' => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'  => 'img.jpg',
                    'src'   => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large' => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            )
        );

        return array(
            'trailers' => $trailers,
        );
    }

    /**
     * @Route("/trailer/{id}")
     * @Template("FDCEventBundle:Television:trailer.html.twig")
     */
    public function getTrailerAction($id)
    {
        $trailer = array(
            'id'          => 1,
            'author'      => array(
                'fullName' => 'Olivier ASSAYAS',
            ),
            'most_viewed' => true,
            'image'       => array(
                'path' => 'img.jpg',
                'src'  => 'http://dummyimage.com/640x404/000/fff.png',
            ),
            'nbVideos'    => 5,
            'theme'       => 'les plus vues',
            'createdAt'   => new \DateTime(),
            'filter'      => array(
                'date'  => 'date1',
                'theme' => 'theme1',
            ),
            'film'        => array(
                'type'  => 'Bande annonce',
                'title' => 'Lorem Ipsum'
            ),
        );
        $channels = array(
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'   => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
                    'src'    => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset' => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'   => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
                    'src'    => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset' => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'   => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
                    'src'    => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset' => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'   => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
                    'src'    => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset' => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'   => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
                    'src'    => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset' => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id'          => 1,
                'author'      => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image'       => array(
                    'path'   => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
                    'src'    => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset' => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos'    => 5,
                'theme'       => 'les plus vues',
                'createdAt'   => new \DateTime(),
                'title'       => 'Lorem ipsum',
                'filter'      => array(
                    'date'  => 'date1',
                    'theme' => 'theme1',
                ),
            ),
        );

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
            'trailer'      => $trailer,
            'channels'     => $channels,
            'filmShowings' => $filmShowings
        );
    }
}
