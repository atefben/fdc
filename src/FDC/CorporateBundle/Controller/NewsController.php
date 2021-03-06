<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Entity\Theme;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use DateTime;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        $exclude = $request->query->get('exclude', null);
        $theme = $request->query->get('theme', null);
        $format = $request->query->get('format', null);
        if ($format == 'all') {
            $format = null;
        }
        if ($theme) {
            $themeTrans = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:ThemeTranslation')
                ->findOneBy(['slug' => $theme])
            ;
            if ($themeTrans) {
                $theme = $themeTrans->getTranslatable();
            } else {
                $theme = null;
            }
        }

        $parameters = $this->getArticlesAndFilters($festival, $locale, $time, $exclude, $theme, $format);
        return $this->render('FDCCorporateBundle:News/list:articles-ajax.html.twig', $parameters);
    }

    /**
     * @param FilmFestival $festival
     * @param $locale
     * @param null $time
     * @param null $exclude
     * @param null $theme
     * @param null $format
     * @return array
     */
    private function getArticlesAndFilters(FilmFestival $festival, $locale, $time = null, $exclude = null, $theme = null, $format = null)
    {
        $before = null;
        if ($time) {
            $before = new DateTime();
            $before->setTimestamp($time);
        }
        $maxResults = 31;
        $filters = [];

        if ($format) {
            $filters['typeClone'] = $format;
        }

        if ($theme) {
            $filters['theme'] = $theme->getId();
        }

        $nodes = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getNewsRetrospective($locale, $festival, 'site-institutionnel', $exclude, $before, $filters, $maxResults)
        ;

        if (count($nodes) > 30) {
            $last = false;
            $nodes = array_slice($nodes, 0, 30);
        } else {
            $last = true;
        }

        $articles = [];
        foreach ($nodes as $node) {
            $articles[] = $this
                ->getDoctrineManager()
                ->getRepository($node->getEntityClass())
                ->find($node->getEntityId())
            ;
        }

        if (!$articles) {
            throw new NotFoundHttpException();
        }

        //set default filters
        $filters = [];
        $filters['dates'][0] = 'all';
        $filters['dateFormated'][0] = 'all';
        $filters['format'][0] = 'all';

        foreach ($articles as $key => $newsArticle) {
            if (($key % 3) == 0) {
                $newsArticle->double = true;
            }
        }

        $formatsResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getFormatsNewsRetrospective($locale, 'site-institutionnel', $festival)
        ;
        if (count($formatsResults) > 1) {
            $filters['format'][0] = 'all';

            foreach ($formatsResults as $formatResult) {
                $format = reset($formatResult);
                $filters['format'][] = $format;
            }
        }

        $filters['dates'][0] = 'all';
        $yearsResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getDatesNewsRetrospective($locale, 'site-institutionnel', $festival)
        ;
        foreach ($yearsResults as $yearResult) {
            $date = reset($yearResult);
            if ($date && !array_key_exists($date, $filters['dates'])) {
                list($day, $month, $year) = explode('-', $date);
                $dateTime = new DateTime();
                $dateTime->setDate($year, $month, $day);
                $dateTime->setTime(0, 0, 0);
                $filters['dates'][$date] = $dateTime;
            }
        }

        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $themesResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getThemesNewsRetrospective($locale, 'site-institutionnel', $festival)
        ;
        foreach ($themesResults as $themeResult) {
            $theme = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Theme')->find($themeResult['id']);
            if ($theme instanceof Theme && !in_array($theme->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $theme->getId();
                $filters['themes']['content'][] = $theme;
            }
        }

        $time = null;
        $exclude = null;
        if ($articles && ($lastArticle = end($articles))) {
            if (method_exists($lastArticle, 'getPublishedAt') && $lastArticle->getPublishedAt()) {
                $time = $lastArticle->getPublishedAt()->getTimestamp();
                $exclude = $lastArticle->getId();
            }
        }

        return [
            'festival' => $festival,
            'articles' => $articles,
            'filters'  => $filters,
            'time'     => $time,
            'last'     => $last,
            'exclude'  => $exclude,
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
     * @Route("/infos-et-communiques/more/{timestamp}")
     * @param Request $request
     * @return Response
     */
    public function infosAndStatementsMoreAction(Request $request, $timestamp = null)
    {
        $locale = $request->getLocale();

        $theme = $request->query->get('theme', null);
        $format = $request->query->get('format', null);
        $type = $request->query->get('type', null);
        $exclude = $request->query->get('exclude', null);

        if ($format == 'all') {
            $format = null;
        }
        $day = $request->query->get('date', null);
        $day = str_replace('date-', '', $day);

        if ($theme) {
            $themeTrans = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:ThemeTranslation')
                ->findOneBy(['slug' => $theme])
            ;
            if ($themeTrans) {
                $theme = $themeTrans->getTranslatable();
            } else {
                $theme = null;
            }
        }

        $parameters = $this->infosAndStatementsFilters($locale, $timestamp, $day, $theme, $format, $type, $exclude);
        return $this->render('FDCCorporateBundle:News:infos-and-statement-more.html.twig', $parameters);
    }


    private function infosAndStatementsFilters($locale, $time = null, $festivalYear = null, Theme $theme = null, $format = null, $type = null, $exclude = null)
    {
        $before = null;
        if ($time) {
            $before = new DateTime();
            $before->setTimestamp($time);
        }
        $maxResults = 31;

        $filters = [];

        $festival = null;
        if ($festivalYear) {
            $festival = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFestival')
                ->findOneBy(['year' => $festivalYear])
            ;
            if ($festival) {
                $filters['festival'] = $festival->getId();
            }
        }

        if ($format) {
            $filters['typeClone'] = $format;
        }

        if ($theme) {
            $filters['theme'] = $theme->getId();
        }


        $nodes = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getStatementsAndInfos($locale, 'site-institutionnel', $type, $exclude, $before, $filters, $maxResults)
        ;

        if (count($nodes) > 30) {
            $last = false;
            $nodes = array_slice($nodes, 0, 30);
        } else {
            $last = true;
        }

        $exclude = null;
        $time = null;
        if ($nodes && ($lastArticle = end($nodes))) {
            if (method_exists($lastArticle, 'getPublishedAt') && $lastArticle->getPublishedAt()) {
                $time = $lastArticle->getPublishedAt()->getTimestamp();
                $exclude = $lastArticle->getId();
            }
        }

        $articles = [];
        foreach ($nodes as $node) {
            $articles[] = $this
                ->getDoctrineManager()
                ->getRepository($node->getEntityClass())
                ->find($node->getEntityId())
            ;
        }

        //set default filters
        $filters = [];
        $filters['types']['all'] = 'all';
        foreach ($articles as $key => $article) {
            if ($article instanceof Info) {
                $filters['types']['info'] = 'filters.type.info';
            } elseif ($article instanceof Statement) {
                $filters['types']['communique'] = 'filters.type.statement';
            }
        }

        $filters['format'][0] = 'all';
        $formatsResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getFormatsStatementsAndInfos($locale, 'site-institutionnel')
        ;
        foreach ($formatsResults as $formatResult) {
            $format = reset($formatResult);
            $filters['format'][] = $format;
        }


        $filters['editions'][0] = 'all';
        $yearsResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getYearsStatementsAndInfos($locale, 'site-institutionnel')
        ;
        foreach ($yearsResults as $yearResult) {
            $date = reset($yearResult);
            if ($date && !array_key_exists($date, $filters['editions'])) {
                $filters['editions'][$date] = $date;
            }
        }


        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $themesResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getThemesStatementsAndInfos($locale, 'site-institutionnel')
        ;
        foreach ($themesResults as $themeResult) {
            $theme = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Theme')->find($themeResult['id']);
            if ($theme instanceof Theme && !in_array($theme->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $theme->getId();
                $filters['themes']['content'][] = $theme;
            }
        }

        return [
            'articles'     => $articles,
            'filters'      => $filters,
            'time'         => $time,
            'last'         => $last,
            'exclude'      => $exclude,
            'festivalYear' => $this->getFestival()->getYear(),
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
        $theme = $request->query->get('theme', null);
        $format = $request->query->get('format', null);
        if ($format == 'all') {
            $format = null;
        }
        if ($theme) {
            $themeTrans = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:ThemeTranslation')
                ->findOneBy(['slug' => $theme])
            ;
            if ($themeTrans) {
                $theme = $themeTrans->getTranslatable();
            } else {
                $theme = null;
            }
        }


        $parameters = $this->getMediasAndFilters($festival, $locale, $page, $format, $theme);

        return $this->render('FDCCorporateBundle:News/list:medias-ajax.html.twig', $parameters);
    }


    /**
     * @param FilmFestival $festival
     * @param $locale
     * @param int $page
     * @param null $format
     * @param null $theme
     * @return array
     */
    private function getMediasAndFilters(FilmFestival $festival, $locale, $page = 1, $format = null, $theme = null)
    {
        $filters = [];

        if ($format) {
            $filters['typeClone'] = $format;
        }

        if ($theme) {
            $filters['theme'] = $theme->getId();
        }


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

        $filters = [];
        $formatsResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Media')
            ->getFormatsRetrospective($locale, $festival)
        ;
        if (count($formatsResults) > 1) {
            $filters['format'][0] = 'all';

            foreach ($formatsResults as $formatResult) {
                $format = reset($formatResult);
                $filters['format'][] = $format;
            }
        }

        $filters['dates'][0] = 'all';
        $yearsResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Media')
            ->getDatesRetrospective($locale, $festival)
        ;
        foreach ($yearsResults as $yearResult) {
            $date = reset($yearResult);
            if ($date && !array_key_exists($date, $filters['dates'])) {
                list($day, $month, $year) = explode('-', $date);
                $dateTime = new DateTime();
                $dateTime->setDate($year, $month, $day);
                $dateTime->setTime(0, 0, 0);
                $filters['dates'][$date] = $dateTime;
            }
        }

        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $themesResults = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Media')
            ->getThemesRetrospective($locale, $festival)
        ;
        foreach ($themesResults as $themeResult) {
            $theme = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Theme')->find($themeResult['id']);
            if ($theme instanceof Theme && !in_array($theme->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $theme->getId();
                $filters['themes']['content'][] = $theme;
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

        $isAdmin = false;
        if ($this->getUser()) {
            $isAdmin = $this->getUser()->hasRole('ROLE_ADMIN') || $this->getUser()->hasRole('ROLE_ALL_ADMIN');
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
            'focusArticles'          => array_slice($focusArticles, 0, 2),
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
            $isAdmin = $this->getUser()->hasRole('ROLE_ADMIN') || $this->getUser()->hasRole('ROLE_ALL_ADMIN');
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
        if ($news instanceof Statement) {
            if ($news->getAssociatedStatement() !== null) {
                foreach ($news->getAssociatedStatement() as $associatedStatement) {
                    if ($associatedStatement->getAssociation() != null) {
                        $focusArticles[] = $associatedStatement->getAssociation();
                    }
                }
            }
        } elseif ($news instanceof Info) {
            if ($news->getAssociatedInfo() !== null) {
                foreach ($news->getAssociatedInfo() as $associatedInfo) {
                    if ($associatedInfo->getAssociation() != null) {
                        $focusArticles[] = $associatedInfo->getAssociation();
                    }
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
        $nextStatement = reset($nextStatement);


        $prevInfo = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->getOlderInfo($locale, null, $newsDate, 'site-institutionnel', $exclude);
        $prevInfo = $this->removeUnpublishedNewsAudioVideo($prevInfo, $locale);
        $prevInfo = reset($prevInfo);
        $nextInfo = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->getNextInfo($locale, null, $newsDate, 'site-institutionnel', $exclude);
        $nextInfo = $this->removeUnpublishedNewsAudioVideo($nextInfo, $locale);
        $nextInfo = reset($nextInfo);

        $prev = null;
        if ($prevStatement && $prevInfo) {
            if ($prevStatement->getPublishedAt()->getTimestamp() >= $prevInfo->getPublishedAt()->getTimestamp()) {
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
            if ($nextStatement->getPublishedAt()->getTimestamp() <= $nextInfo->getPublishedAt()->getTimestamp()) {
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
}
