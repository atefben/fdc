<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use DateTime;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/69-editions/retrospective")
 */
class NewsController extends Controller
{
    public function compareArticle($a, $b)
    {
        if ($a->getPublishedAt()->getTimestamp() == $b->getPublishedAt()->getTimestamp()) {
            return 0;
        }
        return ($a->getPublishedAt()->getTimestamp() > $b->getPublishedAt()->getTimestamp()) ? -1 : 1;
    }

    /**
     * @Route("/{year}/articles")
     * @Template("FDCCorporateBundle:News/list:article.html.twig")
     */
    public function getArticlesAction(Request $request, $year)
    {
        //$offset = 30;
        $this->isPageEnabled($request->get('_route'));

        $dateTime = new DateTime();

        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();

        $festival = $this->getFestival($year);
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

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
        $newsArticles = $em->getRepository('BaseCoreBundle:News')->getNewsRetrospective($locale, $festival->getId(), $festival->getFestivalStartsAt(), $festival->getFestivalEndsAt());
        $statementArticles = $em->getRepository('BaseCoreBundle:Statement')->getStatementRetrospective($locale, $festival->getId(), $festival->getFestivalStartsAt(), $festival->getFestivalEndsAt());
        $infoArticles = $em->getRepository('BaseCoreBundle:Info')->getInfoRetrospective($locale, $festival->getId(), $festival->getFestivalStartsAt(), $festival->getFestivalEndsAt());

        $articles = array_merge($newsArticles, $statementArticles, $infoArticles);
        usort($articles, [$this, 'compareArticle']);


        $articles = $this->removeUnpublishedNewsAudioVideo($articles, $locale, null, true);
        if ($articles === null || count($articles) == 0) {
            throw new NotFoundHttpException();
        }

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['dateFormated'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $filters['format'][0] = 'all';


        foreach ($articles as $key => $newsArticle) {
            $isPublished = ($articles !== null) ? ($newsArticle->findTranslationByLocale('fr')->getStatus() === NewsArticleTranslation::STATUS_PUBLISHED) : false;
            if ($isPublished) {
                if (($key % 3) == 0) {
                    $newsArticle->double = true;
                }

                //check if filters don't already exist
                $date = $newsArticle->getPublishedAt();
                if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates'])) {
                    $filters['dates'][$date->format('y-m-d')] = $date;
                }

                if (!is_null($newsArticle->getTheme()) && !in_array($newsArticle->getTheme()->getId(), $filters['themes']['id'])) {
                    $filters['themes']['id'][] = $newsArticle->getTheme()->getId();
                    $filters['themes']['content'][] = $newsArticle->getTheme();
                }

                if (!in_array($newsArticle->getNewsType(), $filters['format'])) {
                    $filters['format'][] = $newsArticle->getNewsType();
                }
            } else {
                unset($articles[$key]);
            }
        }

        return array(
            'articles'  => $articles,
            'filters'   => $filters,
            'festivals' => $festivals,
            'festival'  => $festival,
        );
    }

    /**
     * @param Request $request
     * @return array
     * @Route("/{year}/medias")
     * @Template("FDCCorporateBundle:News/list:medias.html.twig")
     */
    public function getMediasAction(Request $request, $year)
    {
        $this->isPageEnabled($request->get('_route'));

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $request->getLocale();
        $festival = $this->getFestival($year);
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

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

        $site = $this->getDoctrine()->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-institutionnel');

        //GET ALL MEDIA
        /*if($festival->getYear() < 2016) {
            $medias = $em->getRepository('BaseCoreBundle:Media')->getOldMedia($locale, $festival->getId(), $site);
        } else {
            $medias = $em->getRepository('BaseCoreBundle:Media')->getMedia($locale, $festival->getId(), null);
        }*/

        $images = $em->getRepository('BaseCoreBundle:Media')->getImageMedia($locale, $festival->getId(), $festival->getFestivalStartsAt(), $festival->getFestivalEndsAt());
        $videos = $em->getRepository('BaseCoreBundle:Media')->getVideoMedia($locale, $festival->getId(), $festival->getFestivalStartsAt(), $festival->getFestivalEndsAt());
        $audios = $em->getRepository('BaseCoreBundle:Media')->getAudioMedia($locale, $festival->getId(), $festival->getFestivalStartsAt(), $festival->getFestivalEndsAt());

        $medias = array();
        $medias = array_merge($medias, $images);
        $medias = array_merge($medias, $videos);
        $medias = array_merge($medias, $audios);


        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['dateFormated'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $filters['format'][0] = 'all';

        foreach ($medias as $key => $media) {
            $media->setTheme($media->getTheme());

            if (($key % 3) == 0) {
                $media->double = true;
            }

            //check if filters don't already exist
            $date = $media->getPublishedAt();
            $notin = array('16-05-16', '15-05-16', '14-05-16', '13-05-16', '12-05-16', '11-05-16');
            if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates']) && !in_array($date->format('d-m-y'), $notin)) {
                $filters['dates'][$date->format('y-m-d')] = $date;
            }
            if ($media->getTheme() && !in_array($media->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $media->getTheme()->getId();
                $filters['themes']['content'][] = $media->getTheme();
            }

            $slugTypes = array('MediaImage' => 'photo', 'MediaVideo' => 'video', 'MediaAudio' => 'audio');
            if (!in_array($slugTypes[$media->getMediaType()], $filters['format'])) {
                $filters['format'][] = $slugTypes[$media->getMediaType()];
            }
        }

        shuffle($medias);

        return array(
            'medias'    => $medias,
            'filters'   => $filters,
            'festivals' => $festivals,
        );
    }

    /**
     * @Route("/videos")
     * @Template("FDCCorporateBundle:News/list:video.html.twig")
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
            $video->theme = $video->getTheme();

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
     * @Template("FDCCorporateBundle:News/list:audio.html.twig")
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
            $audio->theme = $audio->getTheme();

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
     * @Route("/{year}/actualites/{format}/{slug}", requirements={"format": "articles|audios|videos|photos"},
     *     options={"expose"=true})
     * @param Request $request
     * @param $year
     * @param $format
     * @param $slug
     * @return Response
     */
    public function getAction(Request $request, $year, $format, $slug)
    {

        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        $festival = $this->getFestival($year);
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        try {
            $isAdmin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        } catch (\Exception $e) {
            $isAdmin = false;
        }

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $festival === null) {
            throw new NotFoundHttpException();
        }

        $format = substr($format, 0, -1);
        $mapper = array_flip(News::getTypes());

        if (!isset($mapper[$format])) {
            throw new NotFoundHttpException();
        }

        // GET NEWS
        $siteSlug = 'site-institutionnel';
        $news = $this->getDoctrineManager()
                     ->getRepository('BaseCoreBundle:News')
                     ->getNewsBySlug($slug, $festival->getId(), $locale, $isAdmin, $mapper[$format], $siteSlug)
        ;

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

        $sameDayArticles = $em->getRepository('BaseCoreBundle:News')->getSameDayNews($festival->getId(), $locale, $newsDate, $count, $news->getId(), null, $focusArticles);
        $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);

        $prevArticlesURL = $em->getRepository('BaseCoreBundle:News')->getOlderNews($locale, $festival->getId(), $newsDate);
        $prevArticlesURL = $this->removeUnpublishedNewsAudioVideo($prevArticlesURL, $locale);

        $nextArticlesURL = $em->getRepository('BaseCoreBundle:News')->getNextNews($locale, $festival->getId(), $newsDate);
        $nextArticlesURL = $this->removeUnpublishedNewsAudioVideo($nextArticlesURL, $locale);

        $this->render('FDCCorporateBundle:News:main.html.twig', [
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
            'festivals'              => $festivals,
        ]);
    }

    /**
     * @Route("/{year}/{type}/{format}/{slug}", requirements={"format": "communique|info", "format": "articles|audios|videos|photos"}, options={"expose"=true}))
     * @param Request $request
     * @param $year
     * @param $type
     * @param $format
     * @param $slug
     * @return Response
     */
    public function pressSingleAction(Request $request, $year, $type, $format, $slug)
    {
        $locale = $request->getLocale();

        $isAdmin = false;
        if ($this->getUser()) {
            $isAdmin = $this->getUser()->hasRole('ROLE_ADMIN');
        }

        // GET FDC SETTINGS
        $festival = $this->getFestival($year);
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        if ($festival === null) {
            throw $this->createNotFoundException();
        }

        $festivalId = $festival->getId();
        $format = substr($format, 0, -1);

        if ('communique' == $type) {
            $repository = array_flip(Statement::getTypes())[$format];
            $news = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Statement')
                ->getStatementBySlug($slug, $festivalId, $locale, $isAdmin, $repository)
            ;
        } else {
            $repository = array_flip(Info::getTypes())[$format];
            $news = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Info')
                ->getInfoBySlug($slug, $festivalId, $locale, $isAdmin, $repository, 'site-institutionnel')
            ;
        }
        if (!$news) {
            throw $this->createNotFoundException();
        }

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
        $focusArticles  = array();

        //get focus articles
        if ($news->getAssociatedStatement() !== null ) {
            foreach ($news->getAssociatedStatement() as $associatedNew) {
                if($associatedNew->getAssociation() != null) {
                    $focusArticles[] = $associatedNew->getAssociation();
                }
            }
        }

        if ($news === null) {
            throw $this->createNotFoundException();
        }

        $localeSlugs = $news->getLocaleSlugs();
        $isPublished = $news->findTranslationByLocale('fr')->getStatus() === TranslateChildInterface::STATUS_PUBLISHED;

        if (!$isAdmin && !$isPublished) {
            throw $this->createNotFoundException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCEventPageNewsSeo($news, $locale);//get day articles
        $count           = 3;
        $newsDate        = $news->getPublishedAt();

        if ($type == "communique") {
            $sameDayArticles = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Statement')->getSameDayStatement($festival->getId(), $locale, $newsDate, $count, $news->getId());
            $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);
            $prevArticlesURL = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Statement')->getOlderStatement($locale, $this->getFestival()->getId() , $news->getPublishedAt());
            $prevArticlesURL = $this->removeUnpublishedNewsAudioVideo($prevArticlesURL, $locale);
            $nextArticlesURL = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Statement')->getNextStatement($locale, $this->getFestival()->getId() , $news->getPublishedAt());
            $nextArticlesURL = $this->removeUnpublishedNewsAudioVideo($nextArticlesURL, $locale);
        }
        else {
            $sameDayArticles = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->getSameDayInfo($festival->getId(), $locale, $newsDate, $count, $news->getId());
            $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);
            $prevArticlesURL = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->getOlderInfo($locale, $this->getFestival()->getId() , $news->getPublishedAt());
            $prevArticlesURL = $this->removeUnpublishedNewsAudioVideo($prevArticlesURL, $locale);
            $nextArticlesURL = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->getNextInfo($locale, $this->getFestival()->getId() , $news->getPublishedAt());
            $nextArticlesURL = $this->removeUnpublishedNewsAudioVideo($nextArticlesURL, $locale);
        }

        return $this->render('FDCCorporateBundle:News:main.html.twig', [
            'festivals'        => $festivals,
            'localeSlugs'            => $localeSlugs,
            'focusArticles'          => $focusArticles,
            'programmations'         => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news'                   => $news,
            'prev'                   => $prevArticlesURL,
            'next'                   => $nextArticlesURL,
            'associatedFilm'         => $associatedFilm,
            'sameDayArticles'        => $sameDayArticles
        ]);
    }

}
