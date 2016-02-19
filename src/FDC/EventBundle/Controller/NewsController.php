<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;
use \DateTime;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("")
 * Class NewsController
 * @package FDC\EventBundle\Controller
 */
class NewsController extends Controller {

    /**
     * @Route("/")
     * @Template("FDCEventBundle:News:home.html.twig")
     */
    public function indexAction(Request $request) {

        $em = $this->get('doctrine')->getManager();
        $dateTime = new DateTime();
        $locale = $request->getLocale();
        $isAdmin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // GET HOMEPAGE SETTINGS
        $homepage = $em->getRepository('BaseCoreBundle:Homepage')->findOneBy(array(
            'festival' => $this->getFestival()
        ));
        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

        $festivalStart = $this->getFestival()->getFestivalStartsAt();
        $festivalEnd =  $this->getFestival()->getFestivalEndsAt();
        $festivalInterval = $this->createDateRangeArray($festivalStart->format('Y-m-d'),$festivalEnd->format('Y-m-d'));

           /////////////////////////////////////////////////////////////////////////////////////
          /////////////////////////      SLIDER      //////////////////////////////////////////
         /////////////////////////////////////////////////////////////////////////////////////

        $slides = $em->getRepository('BaseCoreBundle:HomepageSlide')->findBy(
            array(),
            array('id' => 'DESC'),
            6,
            0
        );

        $displayHomeSlider = $homepage->getDisplayedSlider();

        $homeSlider= array();
        foreach($slides as $slide) {
            if($slide->getNews() != null) {
                $homeSlider[] = $slide->getNews();
            } elseif($slide->getInfos() != null) {
                $homeSlider[] = $slide->getInfos();
            } elseif($slide->getStatement() != null){
                $homeSlider[] = $slide->getStatement();
            }
        }

          ////////////////////////////////////////////////////////////////////////////////////
         /////////////////////////      SOCIAL GRAPH          ///////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $timeline = $em->getRepository('BaseCoreBundle:SocialGraph')->findBy(array(
            'festival' => $this->getFestival()
        ), array(
            'date' => 'ASC'
        ), 12, null);

        $socialGraphTimeline      = array();
        $socialGraphTimelineCount = array();
        $socialGraph              = array();

        foreach ($timeline as $key => $timelineDate) {
            $socialGraphTimeline[]['date'] = $timelineDate->getDate();
            $socialGraphTimelineCount[]    = $timelineDate->getCount();
        }

        $socialGraph['timeline']      = $socialGraphTimeline;
        $socialGraph['timelineCount'] = json_encode($socialGraphTimelineCount);

          ////////////////////////////////////////////////////////////////////////////////////
         /////////////////////////       ARTICLE HOME         ///////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $count = 6;
        $countArticles = 0;
        $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime , $count);

        while (count($homeArticles) === 0 && $dateTime > $festivalStart) {
            $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime->modify('-1 day'), $count);
        }

        $endOfArticles = false;
        if(sizeof($homeArticles) < $count || $homeArticles == null){
            $endOfArticles = true;
        }

        //set default filters
        $filters                         = array();
        $filters['format'][0]            = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0]      = 'all';

        foreach ($homeArticles as $key => $homeArticle) {
            $homeArticle->theme = $homeArticle->getTheme();

            if(($key % 3) == 0){
                $homeArticle->double = true;
            }

            //check if filters don't already exist
            if (!in_array($homeArticle->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][]    = $homeArticle->getTheme()->getId();
                $filters['themes']['content'][] = $homeArticle->getTheme();
            }

        }

        if(!empty($homeArticles)) {
            $format = $homeArticles[0]->getTypes();
            $filters['format'] = array_merge($filters['format'], array_values($format));
        }

        //split articles in two array
        if(count($homeArticles) > 3){
            $homeArticles = $this->partition($homeArticles, 2);
            $homeArticlesBottom = $homeArticles[1];
            foreach($homeArticlesBottom as $bottom) {
                $bottom->double = false;
            }

            $homeArticles = $homeArticles[0];
        } else {
            $homeArticlesBottom = null;
        }

        //get images for slider articles
        $dateArticleSlide = new DateTime();
        $homeArticlesSlider = $em->getRepository('BaseCoreBundle:Media')->getImageMediaByDay($locale, $this->getFestival()->getId(), $dateArticleSlide);

          ////////////////////////////////////////////////////////////////////////////////////
         /////////////////////////       WEBTV        ///////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $videos = $homepage->getTopVideosAssociated();
        $channels = $homepage->getTopWebTvsAssociated();

          ////////////////////////////////////////////////////////////////////////////////////
         /////////////////////////       FILMS        ///////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $films = $homepage->getFilmsAssociated();

        // TODO: clean this

        $wallPosts = array(
            array(
                'big' => true
            ),
            array(
                'big' => true
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            )
        );

        return array(
            'homepage' => $homepage,
            'socialGraph' => $socialGraph,
            'homeArticles' => $homeArticles,
            'homeArticlesBottom' => $homeArticlesBottom,
            'homeArticlesSlider' => $homeArticlesSlider,
            'displayHomeSlider'  => $displayHomeSlider,
            'homeSlider' => $homeSlider,
            'festivalStart' => strtotime($festivalStart->format('Y-m-d')),
            'festivalEnd' => strtotime($festivalEnd->format('Y-m-d')),
            'festivalInterval' => $festivalInterval,
            'filters' => $filters,
            'videos' => $videos,
            'channels' => $channels,
            'films' => $films,
            'endOfArticles' => $endOfArticles,
            // TODO: clean this
            'wallPosts' => $wallPosts
        );
    }

    function createDateRangeArray($strDateFrom,$strDateTo)
    {
        $aryRange=array();
        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),substr($strDateTo,8,2),substr($strDateTo,0,4));
        if ($iDateTo>=$iDateFrom) {
            array_push($aryRange,date('Y-m-d',$iDateFrom));
            while ($iDateFrom<$iDateTo) {
                $iDateFrom+=86400;
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return array_reverse($aryRange);
    }

    /**
     * @Route("/homepage-articles")
     * @Template("FDCEventBundle:News:widgets/article-home-ajax.html.twig")
     * @return array
     */
    public function getArticlesFromAction(Request $request) {

        $timestamp = $request->query->get('timestamp');
        $nextDay = $request->query->get('end');

        $em = $this->get('doctrine')->getManager();
        $locale = $this->getRequest()->getLocale();

        $date = new DateTime();
        $dateTime = $date->setTimestamp($timestamp);
        $count = 6;

        $endOfArticles = false;
        $homeArticles = $em->getRepository('BaseCoreBundle:News')->getOlderNewsButSameDay($locale, $this->getFestival()->getId(), $dateTime , $count);

        if (sizeof($homeArticles) < $count || $homeArticles == null){
            $endOfArticles = true;
        }

        if ($nextDay == true && $homeArticles == null) {
            $dateTime = $dateTime->modify('-1 day');
            $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime , $count);
        }

        return array(
            'endOfArticles' => $endOfArticles,
            'homeArticles' => $homeArticles
        );
    }

    /**
     * @Route("/actualites/{format}/{slug}", requirements={"format": "articles|audios|videos|photos"})
     * @Template("FDCEventBundle:News:main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction(Request $request,$format, $slug) {

        $this->isPageEnabled($request->get('_route'));
        $em       = $this->getDoctrine()->getManager();
        $locale   = $this->getRequest()->getLocale();
        $isAdmin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $format = substr($format, 0, -1);
        $mapper = array_flip(News::getTypes());

        if (!isset($mapper[$format])) {
            throw  new NotFoundHttpException();
        }

        // GET NEWS
        $news = $em->getRepository('BaseCoreBundle:News')->getNewsBySlug(
            $slug,
            $settings->getFestival()->getId(),
            $locale,
            $isAdmin,
            $mapper[$format]
        );

        if ($news === null) {
            throw new NotFoundHttpException();
        }

        $localeSlugs = $news->getLocaleSlugs();
        $isPublished = ($news->findTranslationByLocale('fr')->getStatus() === NewsArticleTranslation::STATUS_PUBLISHED);

        if (!$isAdmin && !$isPublished) {
            throw new NotFoundHttpException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCEventPageNewsSeo($news, $locale);

        //get associated film to the news
        $associatedFilm = null;
        $associatedProgrammation = null;
        $associatedFilmDuration = null;
        $type = null;
        if ($news->getAssociatedFilm() != null) {
            $associatedFilm = $news->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $type = 'film';
        } elseif ($news->getAssociatedEvent() != null) {
            $associatedFilm = $news->getAssociatedEvent()->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $type = 'film';
        } elseif ($news->getAssociatedProjections() != null) {
            $associatedProgrammation = $news->getAssociatedProjections();
            $type = 'event';
        }

        //get film projection
        $programmations = array();
        if ($associatedProgrammation != null) {
            foreach ($associatedProgrammation as $projection) {
                if($type == 'event') {
                    $programmations[] = $projection->getAssociation();
                } else {
                    $programmations[] = $projection->getProjection();
                }

            }
        }

        //get focus articles
        $associatedNews = $news->getAssociatedNews();
        $focusArticles  = array();
        foreach ($associatedNews as $associatedNew) {
            if($associatedNew->getAssociation() != null) {
                $focusArticles[] = $associatedNew->getAssociation();
            }
        }

        //get day articles
        $count           = 3;
        $newsDate        = $news->getPublishedAt();
        $sameDayArticles = $em->getRepository('BaseCoreBundle:News')->getSameDayNews($settings->getFestival()->getId(), $locale, $newsDate, $count, $news->getId());

        return array(
            'localeSlugs' => $localeSlugs,
            'focusArticles' => $focusArticles,
            'programmations' => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news' => $news,
            'associatedFilm' => $associatedFilm,
            'sameDayArticles' => $sameDayArticles
        );
    }

    /**
     * @Route("/articles")
     *
     * @Template("FDCEventBundle:News/list:article.html.twig")
     */
    public function getArticlesAction(Request $request) {
        //$offset = 30;
        $this->isPageEnabled($request->get('_route'));

        $dateTime = new DateTime();

        $em     = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL NEWS ARTICLES
        $newsArticles = $em->getRepository('BaseCoreBundle:News')->getNewsArticles($locale, $settings->getFestival()->getId(), $dateTime);
        if ($newsArticles === null) {
            throw new NotFoundHttpException();
        }

        //set default filters
        $filters                         = array();
        $filters['dates'][0]             = 'all';
        $filters['dateFormated'][0]      = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0]      = 'all';


        foreach ($newsArticles as $key => $newsArticle) {
            $isPublished = ($newsArticles !== null) ? ($newsArticle->findTranslationByLocale('fr')->getStatus() === NewsArticleTranslation::STATUS_PUBLISHED) : false;
            if($isPublished) {
                $newsArticle->image = $newsArticle->getHeader();
                $newsArticle->theme = $newsArticle->getTheme();

                if(($key % 3) == 0){
                    $newsArticle->double = true;
                }

                //check if filters don't already exist
                $date = $newsArticle->getPublishedAt();
                if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates'])) {
                    $filters['dates'][$date->format('y-m-d')] = $date;
                }

                if (!in_array($newsArticle->getTheme()->getId(), $filters['themes']['id'])) {
                    $filters['themes']['id'][]    = $newsArticle->getTheme()->getId();
                    $filters['themes']['content'][] = $newsArticle->getTheme();
                }
            } else {
                unset($newsArticles[$key]);
            }
        }

        return array(
            'articles' => $newsArticles,
            'filters' => $filters
        );
    }

    /**
     * @param Request $request
     * @return array
     *
     * @Route("/photos")
     * @Template("FDCEventBundle:News/list:photo.html.twig")
     */
    public function getPhotosAction(Request $request) {

        $this->isPageEnabled($request->get('_route'));

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $request->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL MEDIA PHOTOS
        $photos = $em
            ->getRepository('BaseCoreBundle:Media')
            ->getImageMedia($locale, $settings->getFestival()->getId(), $dateTime);

        //set default filters
        $filters                         = array();
        $filters['dates'][0]             = 'all';
        $filters['dateFormated'][0]      = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0]      = 'all';

        foreach ($photos as $key => $photo) {
            $photo->theme = $photo->getTheme();

            if(($key % 3) == 0){
                $photo->double = true;
            }

            //check if filters don't already exist
            $date = $photo->getPublishedAt();
            if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates'])) {
                $filters['dates'][$date->format('y-m-d')] = $date;
            }

            if (!in_array($photo->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $photo->getTheme()->getId();
                $filters['themes']['content'][] = $photo->getTheme();
            }
        }

        return array(
            'photos' => $photos,
            'filters' => $filters
        );
    }

    /**
     * @Route("/videos")
     * @Template("FDCEventBundle:News/list:video.html.twig")
     */
    public function getVideosAction(Request $request) {

        $this->isPageEnabled($request->get('_route'));

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL MEDIA AUDIOS
        $videos = $em->getRepository('BaseCoreBundle:Media')->getVideoMedia($locale, $settings->getFestival()->getId(), $dateTime);

        //set default filters
        $filters                         = array();
        $filters['dates'][0]             = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0]    = 'all';

        foreach ($videos as $key => $video) {
            $video->theme = $video->getTheme();

            if(($key % 3) == 0){
                $video->double = true;
            }

            //check if filters don't already exist
            $date = $video->getPublishedAt();
            if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates'])) {
                $filters['dates'][$date->format('y-m-d')] = $date;
            }

            if (!in_array($video->getTheme()->getName(), $filters['themes']['content'])) {
                $filters['themes']['slug'][]    = $video->getTheme()->getName();
                $filters['themes']['content'][] = $video->getTheme();
            }
        }

        return array(
            'videos' => $videos,
            'filters' => $filters
        );

    }

    /**
     * @Route("/audios")
     * @Template("FDCEventBundle:News/list:audio.html.twig")
     */
    public function getAudiosAction(Request $request) {

        $this->isPageEnabled($request->get('_route'));

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL MEDIA AUDIOS
        $audios = $em->getRepository('BaseCoreBundle:Media')->getAudioMedia($locale, $settings->getFestival()->getId(), $dateTime);

        //set default filters
        $filters                         = array();
        $filters['dates'][0]             = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0]    = 'all';

        foreach ($audios as $key => $audio) {
            $audio->theme = $audio->getTheme();

            if(($key % 3) == 0){
                $audio->double = true;
            }

            //check if filters don't already exist
            $date = $audio->getPublishedAt();
            if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates'])) {
                $filters['dates'][$date->format('y-m-d')] = $date;
            }

            if (!in_array($audio->getTheme()->getName(), $filters['themes']['content'])) {
                $filters['themes']['slug'][] = $audio->getTheme()->getName();
                $filters['themes']['content'][] = $audio->getTheme();
            }

        }

        return array(
            'audios' => $audios,
            'filters' => $filters,
        );
    }


    /**
     * split array
     *
     * @param $list
     * @param $p
     * @return array
     */
    private function partition($list, $p ) {
        $listlen = count( $list );
        $partlen = floor( $listlen / $p );
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice( $list, $mark, $incr );
            $mark += $incr;
        }
        return $partition;
    }

}
