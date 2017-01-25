<?php

namespace FDC\CorporateBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/homepagecorporate/gallery")
     * @Template("BaseAdminBundle:Gallery:show.html.twig")
     */
    public function galleryCorpoAction(Request $request)
    {
        $gallery = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:Gallery')->findOneBy(array('displayedHomeCorpo' => 1), array('id' => 'DESC'));

        return array('gallery' => $gallery);
    }

    /**
     * @Route("/homepagecorporate/mediavideo")
     * @Template("BaseAdminBundle:MediaVideo:show.html.twig")
     */
    public function videoCorpoAction(Request $request)
    {
        $video = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:MediaVideo')->findOneBy(array('displayedHomeCorpo' => 1), array('id' => 'DESC'));

        return array('video' => $video);
    }

    /**
     * @Route("/")
     * @Template("FDCCorporateBundle:News:home.html.twig")
     */
    public function homeAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $dateTime = new DateTime();
        $locale = $request->getLocale();

        // GET HOMEPAGE SETTINGS
        $homepage = $em->getRepository('BaseCoreBundle:HomepageCorporate')->find(1);
        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      SLIDER      //////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////

        $slides = $em->getRepository('BaseCoreBundle:HomepageCorporateSlide')->getAllSlide($locale, $dateTime);

        $displayHomeSlider = $homepage->getDisplayedSlider();
        $homeSlider = array();
        foreach ($slides as $slide) {
            if ($slide->getInfo() != null) {
                $homeSlider[] = $slide->getInfo();
            } elseif ($slide->getStatement() != null) {
                $homeSlider[] = $slide->getStatement();
            }
        }


        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      INFOS AND STATEMENTS      ////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////
        $lastFestival = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:FilmFestival')->findOneBy(array(), array('id' => 'DESC'));
        $homeInfos = $em->getRepository('BaseCoreBundle:Info')->getInfosByDate($locale, $lastFestival->getId(), $dateTime);
        $homeStatement = $em->getRepository('BaseCoreBundle:Statement')->getStatementByDate($locale, $lastFestival->getId(), $dateTime);
        $homeContents = array_merge($homeInfos, $homeStatement);

        $homeContents = $this->removeUnpublishedNewsAudioVideo($homeContents, $locale, 6);

        //set default filters
        $filters = array();
        $filters['format'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';

        foreach ($homeContents as $key => $homeContent) {
            $homeContent->setTheme($homeContent->getTheme());

            if (($key % 3) == 0) {
                $homeContent->double = true;
            }

            //check if filters don't already exist
            if (!in_array($homeContent->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $homeContent->getTheme()->getId();
                $filters['themes']['content'][] = $homeContent->getTheme();
            }

            if (!in_array($homeContent->getTypeClone(), $filters['format'])) {
                $filters['format'][] = $homeContent->getTypeClone();
            }
        }

        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      FEATURED VIDEO      //////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////
        $featuredVideo = $homepage->getVideoUne();


        $gallery = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:Gallery')->findOneBy(array('displayedHomeCorpo' => 1), array('id' => 'DESC'));
        $glry = array();
        foreach($gallery->getMedias() as $m) {
            if( $m->getMedia() && $m->getMedia()->findTranslationByLocale('fr')->getStatus() == 1 && $m->getMedia()->getPublishedAt() <= new \DateTime()) {
                $glry['medias'][] = $m;
            }
        }


        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      CANNES RELEASES      /////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////
        $movies = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:FilmFilm')->getFilmsReleases($dateTime);
        //$movies = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:FilmFilm')->findBy(array(), array('publishedAt' => 'DESC'), 10);

        return array(
            'homepage'           => $homepage,
            'displayHomeSlider'  => $displayHomeSlider,
            'filmReleases'       => $movies,
            'homeSlider'         => $homeSlider,
            'homeContents'       => $homeContents,
            'featuredVideo'      => $featuredVideo,
            'festivalStartsAt'   => $homepage->getFestivalStartsAt(),
            'gallery'            => $gallery,
            'glry'               => $glry,
            'filters'            => $filters
        );
    }
    
    /**
     * @Route("/home-more-infos")
     * @Template("FDCCorporateBundle:News:widgets/article-home-ajax.html.twig")
     * @param Request $request
     * @return array
     */
    public function getArticlesFromAction(Request $request)
    {

        $timestamp = $request->query->get('timestamp') - 1;
        $nextDay = $request->query->get('end');
        $type = $request->query->get('type');

        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();

        // GET HOMEPAGE SETTINGS
        $homepage = $em->getRepository('BaseCoreBundle:Homepage')->findOneBy(array(
            'festival' => $this->getFestival(),
        )) 
       ;

        
        $date = new DateTime();
        $dateTime = $date->setTimestamp($timestamp);
        $count = 7;
        $countNext = 2;

        $endOfArticles = false;
        $homeArticlesNext = false;

        if ($nextDay == 1) {
            $dateTime = $dateTime->modify('-1 day');
            if ($homepage->getTopNewsType() == false) {
                $homeArticles = $em->getRepository('BaseCoreBundle:News')->getOlderNewsButSameDay($locale, $this->getFestival()->getId(), $dateTime, $count);
                $homeArticles = $this->removeUnpublishedNewsAudioVideo($homeArticles, $locale, $count);
            } else {
                $homeInfos = $em->getRepository('BaseCoreBundle:Info')->getInfosByDate($locale, $this->getFestival()->getId(), $dateTime, $count);
                $homeStatement = $em->getRepository('BaseCoreBundle:Statement')->getStatementByDate($locale, $this->getFestival()->getId(), $dateTime, $count);
                $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime, $count);

                $homeArticles = array_merge($homeInfos, $homeStatement, $homeArticles);
                $homeArticles = $this->removeUnpublishedNewsAudioVideo($homeArticles, $locale, $count);
            }
            $homeArticles = $this->removeUnpublishedNewsAudioVideo($homeArticles, $locale, $count);

        } else {
            if ($homepage->getTopNewsType() == false) {
                $homeArticles = $em->getRepository('BaseCoreBundle:News')->getOlderNewsButSameDay($locale, $this->getFestival()->getId(), $dateTime, $count);
                $homeArticles = $this->removeUnpublishedNewsAudioVideo($homeArticles, $locale, $count);
            } else {
                $homeInfos = $em->getRepository('BaseCoreBundle:Info')->getInfosByDate($locale, $this->getFestival()->getId(), $dateTime, $count);
                $homeStatement = $em->getRepository('BaseCoreBundle:Statement')->getStatementByDate($locale, $this->getFestival()->getId(), $dateTime, $count);
                $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime, $count);


                $homeArticles = array_merge($homeInfos, $homeStatement, $homeArticles);
                $homeArticles = $this->removeUnpublishedNewsAudioVideo($homeArticles, $locale, $count);
            }
        }

        if (sizeof($homeArticles) < $count || $homeArticles == null) {
            $endOfArticles = true;
            if ($homepage->getTopNewsType() == false) {
                $dateTimeNext = $dateTime->modify('-1 day');
                $homeArticlesNext = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTimeNext, $countNext);
            } else {
                $homeArticlesNext = array();
            }
            if ($homeArticles != null) {
                $homeArticlesNext = $this->removeUnpublishedNewsAudioVideo($homeArticlesNext, $locale, $countNext);
            }
        }

        //get images for slider articles
        if (!isset($nextDay)) {
            $homeArticlesSlider = $em->getRepository('BaseCoreBundle:Media')->getImageMediaByDay($locale, $this->getFestival()->getId(), $date->setTimestamp($timestamp));
        } else {
            $homeArticlesSlider = null;
        }

        //set default filters
        $filters = array();
        $filters['format'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';

        foreach ($homeArticles as $key => $homeArticle) {
            $homeArticle->setTheme($homeArticle->getTheme());

            if (($key % 3) == 0) {
                $homeArticle->double = true;
            }

            if (!in_array($homeArticle->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $homeArticle->getTheme()->getId();
                $filters['themes']['content'][] = $homeArticle->getTheme();
            }

            if (!in_array($homeArticle->getNewsType(), $filters['format'])) {
                $filters['format'][] = $homeArticle->getNewsType();
            }
        }
        

        if (count($homeArticles) > 6) {
            unset($homeArticles[6]);
        }

        return array(
            'homeArticlesSlider' => $homeArticlesSlider,
            'endOfArticles'      => $endOfArticles,
            'homeArticles'       => $homeArticles,
            'homeArticlesNext'   => $homeArticlesNext,
            'filters'            => $filters,
        );
    }
}
