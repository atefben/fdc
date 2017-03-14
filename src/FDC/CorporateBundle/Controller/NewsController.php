<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\FilmFestival;
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

class NewsController extends Controller
{

    /**
     * @Route("/69-editions/retrospective/{year}/articles")
     * @param Request $request
     * @param null $year
     * @return Response
     */
    public function getArticlesAction(Request $request, $year)
    {
        $this->isPageEnabled($request->get('_route'));
        $locale = $request->getLocale();

        $festival = $this->getFestival($year);

        // SEO
        $id = $this->getParameter('admin_fdc_page_news_articles_id');
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageNewsArticles')
            ->find($id)
        ;

        if (!$page) {
            $this->createNotFoundException('Page not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageAllNewsSeo($page, $locale);

        $parameters = $this->getArticlesAndFilters($festival, $locale);
        return $this->render('FDCCorporateBundle:News/list:article.html.twig', $parameters);
    }

    /**
     * @Route("/69-editions/retrospective/{year}/articles-ajax/{time}", options={"expose"=true})
     * @param Request $request
     * @param $year
     * @param int|null $time
     * @return Response
     */
    public function getArticlesAjaxAction(Request $request, $year, $time = null)
    {
        $locale = $request->getLocale();
        $festival = $this->getFestival($year);

        $parameters = $this->getArticlesAndFilters($festival, $locale, $time);

        return $this->render('FDCCorporateBundle:News/list:articles-ajax.html.twig', $parameters);
    }

    private function getArticlesAndFilters(FilmFestival $festival, $locale, $time = null)
    {
        $before = null;
        if ($time) {
            $before = new DateTime();
            $before->setTimestamp($time);
        }
        $maxResults = 50;

        $articles = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:News')
            ->getNewsRetrospective($locale, $festival, null, $maxResults, $before)
        ;
        $articles = $this->removeUnpublishedNewsAudioVideo($articles, $locale, null, true);

        if (count($articles) > 30) {
            $last = false;
            $articles = array_slice($articles, 0, 30);
        } else {
            $last = true;
        }
        if (!$articles) {
            throw new NotFoundHttpException();
        }

        //set default filters
        $filters = [];
        $filters['dates'][0] = 'all';
        $filters['dateFormated'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $filters['format'][0] = 'all';


        foreach ($articles as $key => $newsArticle) {
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
        }

        $time = null;
        if ($articles && ($lastArticle = end($articles))) {
            if (method_exists($lastArticle, 'getPublishedAt') && $lastArticle->getPublishedAt()) {
                $time = $lastArticle->getPublishedAt()->getTimestamp();
            }
        }

        return [
            'festival' => $festival,
            'articles' => $articles,
            'filters'  => $filters,
            'time'     => $time,
            'last'     => $last,
        ];
    }


    /**
     * @Route("infos-et-communiques")
     * @param Request $request
     * @return Response
     */
    public function infosAndStatementsAction(Request $request)
    {
        $locale = $request->getLocale();


        $id = $this->getParameter('admin_fdc_page_news_articles_id');
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageNewsArticles')
            ->find($id)
        ;

        if (!$page) {
            $this->createNotFoundException('Page not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageAllNewsSeo($page, $locale);

        $parameters = $this->infosAndStatementsFilters($locale);
        return $this->render('FDCCorporateBundle:News:infos-and-statements.html.twig', $parameters);
    }

    /**
     * @Route("/69-editions/retrospective/infos-et-communiques/more/{timestamp}")
     * @param Request $request
     * @return Response
     */
    public function infosAndStatementsMoreAction(Request $request, $timestamp)
    {
        $locale = $request->getLocale();

        $parameters = $this->infosAndStatementsFilters($locale, $timestamp);
        return $this->render('FDCCorporateBundle:News:infos-and-statement-more.html.twig', $parameters);
    }


    private function infosAndStatementsFilters($locale, $time = null)
    {
        $before = null;
        if ($time) {
            $before = new DateTime();
            $before->setTimestamp($time);
        }
        $maxResults = 50;

        $infos = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Info')
            ->getInfoRetrospective($locale, null, null, $maxResults, $before)
        ;

        $statements = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getStatementRetrospective($locale, null, null, $maxResults, $before)
        ;

        $articles = array_merge($infos, $statements);
        $articles = $this->removeUnpublishedNewsAudioVideo($articles, $locale, null, true);
        usort($articles, [$this, 'compareArticle']);
        if (count($articles) > 30) {
            $last = false;
            $articles = array_slice($articles, 0, 30);
        } else {
            $last = true;
        }
        if (!$articles) {
            throw new NotFoundHttpException();
        }

        //set default filters
        $filters = [];
        $filters['dates'][0] = 'all';
        $filters['dateFormated'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $filters['format'][0] = 'all';


        foreach ($articles as $key => $newsArticle) {
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
        }

        $time = null;
        if ($articles && ($lastArticle = end($articles))) {
            if (method_exists($lastArticle, 'getPublishedAt') && $lastArticle->getPublishedAt()) {
                $time = $lastArticle->getPublishedAt()->getTimestamp();
            }
        }

        return [
            'articles' => $articles,
            'filters'  => $filters,
            'time'     => $time,
            'last'     => $last,
            'festivalYear' => $this->getFestival()->getYear()
        ];
    }

    /**
     * @Route("/69-editions/retrospective/{year}/medias")
     * @param Request $request
     * @param $year
     * @return Response
     */
    public function getMediasAction(Request $request, $year)
    {
        $this->isPageEnabled($request->get('_route'));

        $locale = $request->getLocale();
        $festival = $this->getFestival($year);

        // SEO
        $id = $this->getParameter('admin_fdc_page_news_images_id');
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageNewsImages')
            ->find($id)
        ;

        if (!$page) {
            $this->createNotFoundException('Page not found');
        }

        $this->get('base.manager.seo')->setFDCEventPageAllNewsSeo($page, $locale);

        $parameters = $this->getMediasAndFilters($festival, $locale);

        return $this->render('FDCCorporateBundle:News/list:medias.html.twig', $parameters);
    }

    /**
     * @Route("/69-editions/retrospective/{year}/medias-ajax/{page}", options={"expose"=true})
     * @param Request $request
     * @param $year
     * @param int $page
     * @return Response
     */
    public function getMediasAjaxAction(Request $request, $year, $page = 1)
    {
        $locale = $request->getLocale();
        $festival = $this->getFestival($year);

        $parameters = $this->getMediasAndFilters($festival, $locale, $page);

        return $this->render('FDCCorporateBundle:News/list:medias-ajax.html.twig', $parameters);
    }


    /**
     * @param FilmFestival $festival
     * @param $locale
     * @param int $page
     * @return array
     */
    private function getMediasAndFilters(FilmFestival $festival, $locale, $page = 1)
    {
        $medias = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Media')
            ->getRetrospective($locale, $festival, 31, ($page - 1) * 30)
        ;
        if (count($medias) > 30) {
            $medias = array_slice($medias, 0, 30);
            $last = false;
        } else {
            $last = true;
        }

        //set default filters
        $filters = [];
        $filters['dates'][0] = 'all';
        $filters['dateFormated'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $filters['format'][0] = 'all';

        foreach ($medias as $media) {

            //check if filters don't already exist
            $date = $media->getPublishedAt();
            $notin = ['16-05-16', '15-05-16', '14-05-16', '13-05-16', '12-05-16', '11-05-16'];
            if ($date && !array_key_exists($date->format('y-m-d'), $filters['dates']) && !in_array($date->format('d-m-y'), $notin)) {
                $filters['dates'][$date->format('y-m-d')] = $date;
            }
            if ($media->getTheme() && !in_array($media->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $media->getTheme()->getId();
                $filters['themes']['content'][] = $media->getTheme();
            }

            $slugTypes = ['MediaImage' => 'photo', 'MediaVideo' => 'video', 'MediaAudio' => 'audio'];
            if (!in_array($slugTypes[$media->getMediaType()], $filters['format'])) {
                $filters['format'][] = $slugTypes[$media->getMediaType()];
            }
        }

        return [
            'medias'   => $medias,
            'filters'  => $filters,
            'festival' => $festival,
            'page'     => $page,
            'last'     => $last,
        ];
    }

    /**
     * @Route("/69-editions/retrospective/videos")
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
        $filters = [];
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

        return [
            'videos'  => $videos,
            'filters' => $filters,
        ];

    }

    /**
     * @Route("/69-editions/retrospective/audios")
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
        $filters = [];
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

        return [
            'audios'  => $audios,
            'filters' => $filters,
        ];
    }

    /**
     * @Route("/69-editions/retrospective/{year}/actualites/{format}/{slug}", requirements={"format": "articles|audios|videos|photos"},
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
        $programmations = [];
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
        $tempProjections = [];
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
        $focusArticles = [];
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
        $exclude = $news->getId();

        $sameDayArticles = $em->getRepository('BaseCoreBundle:News')->getSameDayNews($festival->getId(), $locale, $newsDate, $count, $news->getId(), null, $focusArticles);
        $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);

        $prevArticlesURL = $em->getRepository('BaseCoreBundle:News')->getOlderNews($locale, null, $newsDate, $siteSlug, $exclude);
        $prevArticlesURL = $this->removeUnpublishedNewsAudioVideo($prevArticlesURL, $locale);

        $nextArticlesURL = $em->getRepository('BaseCoreBundle:News')->getNextNews($locale, null, $newsDate, $siteSlug, $exclude);
        $nextArticlesURL = $this->removeUnpublishedNewsAudioVideo($nextArticlesURL, $locale);
        return $this->render('FDCCorporateBundle:News:main.html.twig', [
            'localeSlugs'            => $localeSlugs,
            'focusArticles'          => $focusArticles,
            'programmations'         => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news'                   => $news,
            'prev'                   => reset($prevArticlesURL),
            'next'                   => reset($nextArticlesURL),
            'associatedFilm'         => $associatedFilm,
            'sameDayArticles'        => $sameDayArticles,
            'nextProjectionDate'     => $nextProjectionDate,
        ]);
    }

    /**
     * @Route("/infos-communiques/{type}/{format}/{slug}", requirements={"type": "communique|info", "format": "articles|audios|videos|photos"}, options={"expose"=true}))
     * @param Request $request
     * @param $type
     * @param $format
     * @param $slug
     * @return Response
     */
    public function pressSingleAction(Request $request, $type, $format, $slug)
    {
        $locale = $request->getLocale();

        $isAdmin = false;
        if ($this->getUser()) {
            $isAdmin = $this->getUser()->hasRole('ROLE_ADMIN');
        }

        // GET FDC SETTINGS
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();


        $format = substr($format, 0, -1);

        if ('communique' == $type) {
            $repository = array_flip(Statement::getTypes())[$format];
            $news = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Statement')
                ->getStatementBySlug($slug, null, $locale, $isAdmin, $repository, 'site-institutionnel')
            ;
        } else {
            $repository = array_flip(Info::getTypes())[$format];
            $news = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Info')
                ->getInfoBySlug($slug, null, $locale, $isAdmin, $repository, 'site-institutionnel')
            ;
        }
        if (!$news) {
            throw $this->createNotFoundException();
        }
        $festival = $news->getFestival();

        $associatedFilm = null;
        $associatedProgrammation = null;
        $associatedFilmDuration = null;
        $typeAssociated = null;
        if ($news->getAssociatedFilm() != null) {
            $associatedFilm = $news->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $typeAssociated = 'film';
        } elseif ($news->getAssociatedEvent() != null) {
            $associatedFilm = $news->getAssociatedEvent()->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $typeAssociated = 'film';
        } elseif ($news->getAssociatedProjections() != null) {
            $associatedProgrammation = $news->getAssociatedProjections();
            $typeAssociated = 'event';
        }
        $programmations = [];
        if ($associatedProgrammation != null) {
            foreach ($associatedProgrammation as $projection) {
                if ($typeAssociated == 'event') {
                    $programmations[] = $projection->getAssociation();
                } else {
                    $programmations[] = $projection->getProjection();
                }

            }
        }
        $focusArticles = [];

        //get focus articles
        if ($news->getAssociatedStatement() !== null) {
            foreach ($news->getAssociatedStatement() as $associatedNew) {
                if ($associatedNew->getAssociation() != null) {
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
        $count = 3;
        $newsDate = $news->getPublishedAt();
        $exclude = $news->getId();

        if ($type == "communique") {
            $sameDayArticles = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Statement')->getSameDayStatement($festival->getId(), $locale, $newsDate, $count, $news->getId());
            $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);
        } else {
            $sameDayArticles = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->getSameDayInfo($festival->getId(), $locale, $newsDate, $count, $news->getId());
            $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);

        }
        $prevStatement = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Statement')->getOlderStatement($locale, null, $newsDate, 'site-institutionnel', $exclude);
        $prevStatement = $this->removeUnpublishedNewsAudioVideo($prevStatement, $locale);
        $prevStatement = reset($prevStatement);
        $nextStatement = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Statement')->getNextStatement($locale, null, $newsDate, 'site-institutionnel', $exclude);
        $nextStatement = $this->removeUnpublishedNewsAudioVideo($nextStatement, $locale);



        $prevInfo = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->getOlderInfo($locale, null, $newsDate, 'site-institutionnel', $exclude);
        $prevInfo = $this->removeUnpublishedNewsAudioVideo($prevInfo, $locale);
        $prevInfo = reset($prevInfo);
        $nextInfo = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->getNextInfo($locale, null, $newsDate, 'site-institutionnel', $exclude);
        $nextInfo = $this->removeUnpublishedNewsAudioVideo($nextInfo, $locale);
        $nextInfo = reset($nextInfo);

        $prev = null;
        if ($prevStatement && $prevInfo) {
            if ($prevStatement->getPublishedAt()->getTimestamp >= $prevInfo->getPublishedAt()->getTimestamp) {
                $prev = $prevStatement;
            } else {
                $prev = $prevInfo;
            }
        } elseif ($prevStatement) {
            $prev = $prevStatement;
        } elseif ($prevInfo) {
            $prev = $prevInfo;
        }

        $next = null;
        if ($nextStatement && $nextInfo) {
            if ($nextStatement->getPublishedAt()->getTimestamp <= $nextInfo->getPublishedAt()->getTimestamp) {
                $next = $nextStatement;
            } else {
                $next = $nextInfo;
            }
        } elseif ($nextStatement) {
            $next = $nextStatement;
        } elseif ($nextInfo) {
            $next = $nextInfo;
        }


        return $this->render('FDCCorporateBundle:News:main.html.twig', [
            'festivals'              => $festivals,
            'localeSlugs'            => $localeSlugs,
            'focusArticles'          => $focusArticles,
            'programmations'         => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news'                   => $news,
            'prev'                   => $prev,
            'next'                   => $next,
            'associatedFilm'         => $associatedFilm,
            'sameDayArticles'        => $sameDayArticles,
            'hideSliderAndMenu'      => true,
        ]);
    }


    /**
     * @param $a
     * @param $b
     * @return int
     */
    private function compareArticle($a, $b)
    {
        $aTime = $a->getPublishedAt()->getTimestamp();
        $bTime = $b->getPublishedAt()->getTimestamp();
        if ($aTime == $bTime) {
            return 0;
        }
        return ($aTime > $bTime) ? -1 : 1;
    }
}
