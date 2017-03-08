<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use DateTime;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("")
 * Class NewsController
 * @package FDC\EventBundle\Controller
 */
class NewsController extends Controller
{
    /**
     * @Route("/", options={"i18n": "false"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function preHomeAction()
    {
        return $this->redirect($this->generateUrl('fdc_event_news_index', ['_locale' => 'fr']), 301);
    }

    /**
     * @Route("/")
     * @Template("FDCEventBundle:News:home.html.twig")
     */
    public function indexAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $dateTime = new DateTime();
        $locale = $request->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException('Festival year settings not set');
        }

        // GET HOMEPAGE SETTINGS
        $homepage = $em->getRepository('BaseCoreBundle:Homepage')->findOneBy(array(
            'festival' => $this->getFestival(),
        ))
        ;
        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

        $festivalStart = $this->getFestival()->getFestivalStartsAt();
        $festivalEnd = $this->getFestival()->getFestivalEndsAt();
        $festivalInterval = $this->createDateRangeArrayEvent($festivalStart->format('Y-m-d'), $festivalEnd->format('Y-m-d'));

        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      SLIDER      //////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////

        $slides = $em->getRepository('BaseCoreBundle:HomepageSlide')->getAllSlide($locale, $dateTime);

        $displayHomeSlider = $homepage->getDisplayedSlider();
        $homeSlider = array();
        foreach ($slides as $slide) {
            if ($slide->getNews() != null) {
                $homeSlider[] = $slide->getNews();
            } elseif ($slide->getInfos() != null) {
                $homeSlider[] = $slide->getInfos();
            } elseif ($slide->getStatement() != null) {
                $homeSlider[] = $slide->getStatement();
            }
        }
        ////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      SOCIAL GRAPH          ///////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $timeline = $em->getRepository('BaseCoreBundle:SocialGraph')->findBy(
            array(
            'festival' => $this->getFestival(),
            ), array(
                'date' => 'DESC',
            ), 12, null)
        ;

        $socialGraphTimeline = array();
        $socialGraphTimelineCount = array();
        $socialGraph = array();

        foreach ($timeline as $key => $timelineDate) {
            $socialGraphTimeline[]['date'] = $timelineDate->getDate();
            $socialGraphTimelineCount[] = $timelineDate->getCount();
        }

        $socialGraphTimeline = array_reverse($socialGraphTimeline);

        $socialGraph['timeline'] = $socialGraphTimeline;
        $socialGraph['timelineCount'] = json_encode(array_reverse($socialGraphTimelineCount));

        ////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////       ARTICLE HOME         ///////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $count = 7;
        $homeArticles = array();
        if ($homepage->getTopNewsType() == false) {
            $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime, $count);
        } else {
            $homeInfos = $em->getRepository('BaseCoreBundle:Info')->getInfosByDate($locale, $this->getFestival()->getId(), $dateTime, $count);
            $homeStatement = $em->getRepository('BaseCoreBundle:Statement')->getStatementByDate($locale, $this->getFestival()->getId(), $dateTime, $count);
            $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime, $count);
            $homeArticles = array_merge($homeInfos, $homeStatement, $homeArticles);
            error_log(print_r($homeArticles, true));
            ksort($homeArticles);
        }

        $homeArticles = $this->removeUnpublishedNewsAudioVideo($homeArticles, $locale, $count);

        while (count($homeArticles) === 0 && $dateTime > $festivalStart) {
            if ($homepage->getTopNewsType() == false) {
                $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime->modify('-1 day'), $count);
            }
            $homeArticles = $this->removeUnpublishedNewsAudioVideo($homeArticles, $locale, $count);
        }

        $countNext = 2;
        $endOfArticles = false;
        $homeArticlesNext = false;

        if (sizeof($homeArticles) < $count || $homeArticles == null) {
            $endOfArticles = true;
            $tmp = clone $dateTime;
            if ($homepage->getTopNewsType() == false) {
                $dateTimeNext = $tmp->modify('-1 day');
                $homeArticlesNext = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTimeNext, $countNext);
            } else {
                $dateTimeNext = $homeArticles[count($homeArticles) - 1]->getPublishedAt();
                $homeInfos = $em->getRepository('BaseCoreBundle:Info')->getInfosByDate($locale, $this->getFestival()->getId(), $dateTimeNext, $countNext);
                $homeStatement = $em->getRepository('BaseCoreBundle:Statement')->getStatementByDate($locale, $this->getFestival()->getId(), $dateTimeNext, $countNext);
                $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $this->getFestival()->getId(), $dateTime, $count);

                $homeArticlesNext = array_merge($homeInfos, $homeStatement, $homeArticles);
            }
            $homeArticlesNext = $this->removeUnpublishedNewsAudioVideo($homeArticlesNext, $locale, $count);
        }

        if (sizeof($homeArticles) == $count) {
            array_pop($homeArticles);
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

            //check if filters don't already exist
            if (!in_array($homeArticle->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $homeArticle->getTheme()->getId();
                $filters['themes']['content'][] = $homeArticle->getTheme();
            }

            if (!in_array($homeArticle->getNewsType(), $filters['format'])) {
                $filters['format'][] = $homeArticle->getNewsType();
            }
        }

        $homeArticlesTop = array();
        $homeArticlesBottom = array();
        //split articles in two array
        foreach ($homeArticles as $key => $homeArticle) {
            if ($key < 3) {
                $homeArticlesTop[$key] = $homeArticle;
            }
            if ($key >= 3) {
                $homeArticlesBottom[$key] = $homeArticle;
                $homeArticlesBottom[$key]->double = false;;
            }
        }

        //get images for slider articles / if current date inferior than festivalStart or superior than festivalEnd use thoses values
        if ($dateTime < $festivalStart) {
            $currentFestivalDate = $festivalStart;
        } else if ($dateTime > $festivalEnd) {
            $currentFestivalDate = $festivalEnd;
        } else {
            $currentFestivalDate = $dateTime;
        }
        $homeArticlesSlider = $em->getRepository('BaseCoreBundle:Media')->getImageMediaByDay($locale, $this->getFestival()->getId(), $currentFestivalDate);

        ////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////       WEBTV        ///////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $videos = $homepage->getTopVideosAssociated();
        $channels = $homepage->getTopWebTvsAssociated();
        $channelsIds = array();
        $positions = array();
        foreach ($channels as $channel) {
            if ($channel->getAssociation()) {
                $channelsIds[$channel->getAssociation()->getId()] = $channel->getAssociation();
                $positions[$channel->getAssociation()->getId()] = $channel->getPosition();
            }
        }

        $groups = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaVideo')
            ->getLastMediaVideoOfEachWebTv($this->getFestival()->getId(), $locale, array_keys($channelsIds))
        ;

        $channelsVideos = array();
        foreach ($groups as $key => $group) {
            $lastVideo = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaVideo')
                ->getLastMediaVideoByWebTv($this->getFestival()->getId(), $channelsIds[$group['channel']])
            ;
            $nbVideos = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaVideo')
                ->getAvailableMediaVideosByWebTv($this->getFestival()->getId(), $locale, $group['channel'])
            ;
            if ($nbVideos) {
                $channelsVideos[$positions[$group['channel']]] = array(
                    'channel'  => $channelsIds[$group['channel']],
                    'video'    => $lastVideo,
                    'nbVideos' => count($nbVideos),
                );
            }
        }
        ksort($channelsVideos);

        ////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////       FILMS        ///////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $films = $homepage->getFilmsAssociated();

        // SEO
        $this->get('base.manager.seo')->setFDCEventPageHomepageSeo($homepage, $locale);

        return array(
            'homepage'           => $homepage,
            'socialGraph'        => $socialGraph,
            'homeArticles'       => $homeArticlesTop,
            'homeArticlesBottom' => $homeArticlesBottom,
            'homeArticlesSlider' => $homeArticlesSlider,
            'homeArticlesNext'   => $homeArticlesNext,
            'displayHomeSlider'  => $displayHomeSlider,
            'homeSlider'         => $homeSlider,
            'festivalStart'      => strtotime($festivalStart->format('Y-m-d')),
            'festivalEnd'        => strtotime($festivalEnd->format('Y-m-d')),
            'festivalInterval'   => $festivalInterval,
            'filters'            => $filters,
            'videos'             => $videos,
            'channels'           => $channels,
            'channelsVideos'     => array_values($channelsVideos),
            'films'              => $films,
            'endOfArticles'      => $endOfArticles,
        );
    }

    /**
     * @Route("/homepage-articles")
     * @Template("FDCEventBundle:News:widgets/article-home-ajax.html.twig")
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

    /**
     * @Route("/actualites/{format}/{slug}", requirements={"format": "articles|audios|videos|photos"},options={"expose"=true})
     * @Template("FDCEventBundle:News:main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction(Request $request, $format, $slug)
    {

        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        try {
            $isAdmin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        } catch (\Exception $e) {
            $isAdmin = false;
        }

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $format = substr($format, 0, -1);
        $mapper = array_flip(News::getTypes());

        if (!isset($mapper[$format])) {
            throw new NotFoundHttpException();
        }

        // GET NEWS
        $news = $em->getRepository('BaseCoreBundle:News')->getNewsBySlug($slug, $settings->getFestival()->getId(), $locale, $isAdmin, $mapper[$format]);

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
        } elseif ($news->getAssociatedEvent() != null && $news->getAssociatedEvent()->getAssociatedFilm()) {
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
                if ($type == 'event') {
                    if ($projection->getAssociation() != null) {
                        $programmations[] = $projection->getAssociation();
                    }
                } else {
                    if ($projection->getProjection() != null) {
                        $programmations[] = $projection->getProjection();
                    }
                }

            }
        }
        $tempProjections = array();
        $now = new DateTime();
        if ($programmations) {
            foreach ($programmations as $item) {
                if ($item !== null && $item->getStartsAt() && $item->getStartsAt() > $now) {
                    $tempProjections[$item->getStartsAt()->getTimestamp()] = $item->getStartsAt()->format('Y-m-d');
                }
            }
        }
        $nextProjectionDate = '';
        if ($tempProjections) {
            ksort($tempProjections);
            $tempProjections = array_values($tempProjections);
            $nextProjectionDate = $tempProjections[0];
        }

        //get focus articles
        $associatedNews = $news->getAssociatedNews();
        $focusArticles = array();
        foreach ($associatedNews as $associatedNew) {
            if ($associatedNew->getAssociation() != null) {
                $focusArticles[] = $associatedNew->getAssociation();
            }
        }

        //get day articles
        $count = 3;
        if ($news->getPublishedAt()) {
            $newsDate = $news->getPublishedAt();
        } else {
            $newsDate = new DateTime();
        }

        $sameDayArticles = $em->getRepository('BaseCoreBundle:News')->getSameDayNews($settings->getFestival()->getId(), $locale, $newsDate, $count, $news->getId(),null,$focusArticles);
        $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);

        $prevArticlesURL = $em->getRepository('BaseCoreBundle:News')->getOlderNews($locale, $this->getFestival()->getId(), $newsDate);
        $prevArticlesURL = $this->removeUnpublishedNewsAudioVideo($prevArticlesURL, $locale);

        $nextArticlesURL = $em->getRepository('BaseCoreBundle:News')->getNextNews($locale, $this->getFestival()->getId(), $newsDate);
        $nextArticlesURL = $this->removeUnpublishedNewsAudioVideo($nextArticlesURL, $locale);

        return array(
            'localeSlugs'            => $localeSlugs,
            'focusArticles'          => $focusArticles,
            'programmations'         => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news'                   => $news,
            'prev'                   => $prevArticlesURL,
            'next'                   => $nextArticlesURL,
            'associatedFilm'         => $associatedFilm,
            'sameDayArticles'        => $sameDayArticles,
            'nextProjectionDate'     => $nextProjectionDate,
        );
    }

    /**
     * @Route("/articles")
     * @Template("FDCEventBundle:News/list:article.html.twig")
     */
    public function getArticlesAction(Request $request)
    {
        //$offset = 30;
        $this->isPageEnabled($request->get('_route'));

        $dateTime = new DateTime();

        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $id = $this->getParameter('admin_fdc_page_news_articles_id');
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageNewsArticles')
            ->find($id)
        ;

        if ($page == NULL) {
            throw $this->createNotFoundException('Page not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageAllNewsSeo($page, $locale);

        //GET ALL NEWS ARTICLES
        $newsArticles = $em->getRepository('BaseCoreBundle:News')->getAllNews($locale, $settings->getFestival()->getId());
        $newsArticles = $this->removeUnpublishedNewsAudioVideo($newsArticles, $locale, null, true);
        if ($newsArticles === null || count($newsArticles) == 0) {
            throw new NotFoundHttpException();
        }

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['dateFormated'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';


        foreach ($newsArticles as $key => $newsArticle) {
            $isPublished = ($newsArticles !== null) ? ($newsArticle->findTranslationByLocale('fr')->getStatus() === NewsArticleTranslation::STATUS_PUBLISHED) : false;
            if ($isPublished) {

                if (($key % 3) == 0) {
                    $newsArticle->double = true;
                }

                //check if filters don't already exist
                $date = $newsArticle->getPublishedAt();
                if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates'])) {
                    $filters['dates'][$date->format('y-m-d')] = $date;
                }

                if (!in_array($newsArticle->getTheme()->getId(), $filters['themes']['id'])) {
                    $filters['themes']['id'][] = $newsArticle->getTheme()->getId();
                    $filters['themes']['content'][] = $newsArticle->getTheme();
                }
            } else {
                unset($newsArticles[$key]);
            }
        }

        return array(
            'articles' => $newsArticles,
            'filters'  => $filters,
        );
    }

    /**
     * @param Request $request
     * @return array
     * @Route("/photos")
     * @Template("FDCEventBundle:News/list:photo.html.twig")
     */
    public function getPhotosAction(Request $request)
    {

        $this->isPageEnabled($request->get('_route'));

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $request->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $id = $this->getParameter('admin_fdc_page_news_images_id');
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageNewsImages')
            ->find($id)
        ;

        if ($page === null) {
            $this->createNotFoundException('Page not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageAllNewsSeo($page, $locale);

        //GET ALL MEDIA PHOTOS
        $currentFestivalId = $settings->getFestival()->getId();
        $photos = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Media')
            ->getImageMedia($locale, $currentFestivalId)
        ;
        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['dateFormated'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';

        foreach ($photos as $key => $photo) {
            $photo->setTheme($photo->getTheme());

            if (($key % 3) == 0) {
                $photo->double = true;
            }

            //check if filters don't already exist
            $date = $photo->getPublishedAt();
            if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates'])) {
                $filters['dates'][$date->format('y-m-d')] = $date;
            }

            if ($photo->getTheme() && !in_array($photo->getTheme()->getName(), $filters['themes']['content'])) {
                $filters['themes']['slug'][] = $photo->getTheme()->getName();
                $filters['themes']['content'][] = $photo->getTheme();
            }
        }

        return array(
            'photos'  => $photos,
            'filters' => $filters,
        );
    }

    /**
     * @Route("/videos")
     * @Template("FDCEventBundle:News/list:video.html.twig")
     */
    public function getVideosAction(Request $request)
    {

        $this->isPageEnabled($request->get('_route'));

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $id = $this->getParameter('admin_fdc_page_news_videos_id');
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageNewsVideos')
            ->find($id)
        ;

        if ($page === null) {
            $this->createNotFoundException('Page not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageAllNewsSeo($page, $locale);

        //GET ALL MEDIA VIDEOS
        $videos = $em->getRepository('BaseCoreBundle:Media')->getVideoMedia($locale, $settings->getFestival()->getId(), $dateTime);

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0] = 'all';

        foreach ($videos as $key => $video) {
            $video->setTheme($video->getTheme());

            if (($key % 3) == 0) {
                $video->double = true;
            }

            //check if filters don't already exist
            $date = $video->getPublishedAt();
            if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates'])) {
                $filters['dates'][$date->format('y-m-d')] = $date;
            }

            if (!in_array($video->getTheme()->getName(), $filters['themes']['content'])) {
                $filters['themes']['slug'][] = $video->getTheme()->getName();
                $filters['themes']['content'][] = $video->getTheme();
            }
        }

        return array(
            'videos'  => $videos,
            'filters' => $filters,
        );

    }

    /**
     * @Route("/audios")
     * @Template("FDCEventBundle:News/list:audio.html.twig")
     */
    public function getAudiosAction(Request $request)
    {

        $this->isPageEnabled($request->get('_route'));

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $id = $this->getParameter('admin_fdc_page_news_audios_id');
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageNewsAudios')
            ->find($id)
        ;

        if ($page === null) {
            $this->createNotFoundException('Page not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageAllNewsSeo($page, $locale);

        //GET ALL MEDIA AUDIOS
        $audios = $em->getRepository('BaseCoreBundle:Media')->getAudioMedia($locale, $settings->getFestival()->getId(), $dateTime);

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0] = 'all';

        foreach ($audios as $key => $audio) {
            $audio->setTheme($audio->getTheme());

            if (($key % 3) == 0) {
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
            'audios'  => $audios,
            'filters' => $filters,
        );
    }


    /**
     * split array
     * @param $list
     * @param $p
     * @return array
     */
    private function partition($list, $p)
    {
        $listlen = count($list);
        $partlen = floor($listlen / $p);
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice($list, $mark, $incr);
            $mark += $incr;
        }
        return $partition;
    }

}
