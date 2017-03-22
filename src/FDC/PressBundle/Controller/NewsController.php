<?php

namespace FDC\PressBundle\Controller;

use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Entity\StatementArticleTranslation;
use Base\CoreBundle\Entity\InfoArticleTranslation;
use Base\CoreBundle\Entity\Info;

use \DateTime;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\Date;


class NewsController extends Controller
{
    /**
     * @Route("/")
     * @Template("FDCPressBundle:News:home.html.twig")
     * @param Request $request
     * @return array
     */
    public function homeAction(Request $request)
    {
        $translator = $this->get('translator');

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $dateTime = new DateTime();
        $isPress = false;
        $festival = $this->getFestival()->getId();


        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET DAY STATEMENT ARTICLES
        $statements = $em
            ->getRepository('BaseCoreBundle:Statement')
            ->getLastStatements($settings->getFestival()->getId(), $dateTime, $locale, 10);

        //GET ALL STATEMENT ARTICLES
        $infos = $em
            ->getRepository('BaseCoreBundle:Info')
            ->getLastInfos($settings->getFestival()->getId(), $dateTime, $locale, 10);

        $pressNews = array_merge($infos, $statements);

        usort($pressNews, function ($a, $b) {
            if ($a->getPublishedAt()->format('Y-m-d H:i:s') == $b->getPublishedAt()->format('Y-m-d H:i:s')) {
                return 0;
            }
            return ($a->getPublishedAt()->format('Y-m-d H:i:s') > $b->getPublishedAt()->format('Y-m-d H:i:s')) ? -1 : 1;
        });

        // Limit Statements & Infos to 10 post
        $homeNews = array_slice($pressNews, 0, 10);

        if ($homeNews === null) {
            throw new NotFoundHttpException();
        }
        $festivalStartsAt = $settings->getFestival()->getFestivalStartsAt();
        $festivalEndsAt = $settings->getFestival()->getFestivalEndsAt();
        $schedulingDays = range($festivalStartsAt->format('d'), $festivalEndsAt->format('d'));
        $schedulingYear = $festivalStartsAt->format('Y');
        $schedulingMonth = $festivalStartsAt->format('m');

        array_walk($schedulingDays, function (&$value) use(&$schedulingYear, &$schedulingMonth) {
            $value = $schedulingYear ."-". $schedulingMonth ."-". $value;
        });


        //GET PRESS HOMEPAGE
        $homepage = $em->getRepository('BaseCoreBundle:PressHomepage')->findOneById($this->getParameter('admin_press_homepage_id'));

        if ($homepage === null) {
            throw new NotFoundHttpException();
        }


        $festivalStart    = $this->getFestival()->getFestivalStartsAt();
        $festivalEnd      = $this->getFestival()->getFestivalEndsAt();

        if ($request->get('date')) {
            $date = $request->get('date');
        } else {
            $date = new DateTime();

            if ($date < $festivalStart) {
                $date = $festivalStart->format('Y-m-d');
            } else if ($date > $festivalEnd) {
                $date = $festivalEnd->format('Y-m-d');
            } else {
                $date = $date->format('Y-m-d');
            }
        }

        if ($this->get('security.authorization_checker')->isGranted('ROLE_FDC_PRESS_REPORTER')) {
            $isPress = true;
        }

        // get all rooms
        $rooms = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmProjectionRoom')
            ->findAll()
        ;

        if (!$isPress) {
            foreach ($rooms as $key => $room) {
                if ($room->getName() == 'Salle de Conférence de Presse') {
                    unset($rooms[$key]);
                }
            }
        }

        // get projections by room
        foreach ($rooms as $room) {
            $projections[$room->getId()] = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionsByFestivalAndDateAndRoom($festival, $date, $room->getId(), $isPress)
            ;
        }

        $pressProjection = $this->getDoctrineManager()->getRepository('BaseCoreBundle:PressProjection')->findOneById($this->getParameter('admin_press_projection_id'));
        if ($pressProjection === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCPressPagePressHomepageSeo($homepage, $locale);

        return array(
            'homeNews' => $homeNews,
            'schedulingDays' => $this->createDateRangeArray($festivalStartsAt->format('Y-m-d'),$festivalEndsAt->format('Y-m-d')),
            'pressHome' => $homepage,
            'date' => $date,
            'rooms' => $rooms,
            'projections' => $projections,
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
        return $aryRange;
    }
    
    /**
     * @Route("/press-articles/{type}/{format}/{slug}", requirements={"format": "articles|audios|videos|photos", "type": "communique|info"}, options={"expose"=true}))
     * @Template("FDCPressBundle:News:main.html.twig")
     * @param $slug
     * @param $format
     * @param $type
     * @return array
     */
    public function getAction(Request $request, $format, $slug, $type)
    {

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

        if ($type == "communique") {
            $mapper = array_flip(Statement::getTypes());
            $news = $em->getRepository('BaseCoreBundle:Statement')->getStatementBySlug(
                $slug,
                $settings->getFestival()->getId(),
                $locale,
                $isAdmin,
                $mapper[$format]
            );
        }
        else {
            $mapper = array_flip(Info::getTypes());
            $news = $em->getRepository('BaseCoreBundle:Info')->getInfoBySlug(
                $slug,
                $settings->getFestival()->getId(),
                $locale,
                $isAdmin,
                $mapper[$format]
            );
        }

        if ($news === null) {
            throw new NotFoundHttpException();
        }

        if ($type == "communique") {
            $localeSlugs = $news->getLocaleSlugs();
            $isPublished = ($news->findTranslationByLocale('fr')->getStatus() === StatementArticleTranslation::STATUS_PUBLISHED);
        }
        else {
            $localeSlugs = $news->getLocaleSlugs();
            $isPublished = ($news->findTranslationByLocale('fr')->getStatus() === InfoArticleTranslation::STATUS_PUBLISHED);
        }

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
        $focusArticles  = array();

        //get focus articles
        if ($news->getAssociatedStatement() !== null ) {
            foreach ($news->getAssociatedStatement() as $associatedNew) {
                if($associatedNew->getAssociation() != null) {
                    $focusArticles[] = $associatedNew->getAssociation();
                }
            }
        }


        //get day articles
        $count           = 3;
        $newsDate        = $news->getPublishedAt();
        $exclude = $news->getId();

        if ($type == "communique") {
            $sameDayArticles = $em->getRepository('BaseCoreBundle:Statement')->getSameDayStatement($settings->getFestival()->getId(), $locale, $newsDate, $count, $news->getId());
            $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);
            $prevArticlesURL = $em->getRepository('BaseCoreBundle:Statement')->getOlderStatement($locale, $this->getFestival()->getId(), $news->getPublishedAt(), 'site-press', $exclude);
            $prevArticlesURL = $this->removeUnpublishedNewsAudioVideo($prevArticlesURL, $locale);
            $nextArticlesURL = $em->getRepository('BaseCoreBundle:Statement')->getNextStatement($locale, $this->getFestival()->getId(), $news->getPublishedAt(), 'site-press', $exclude);
            $nextArticlesURL = $this->removeUnpublishedNewsAudioVideo($nextArticlesURL, $locale);
        }
        else {
            $sameDayArticles = $em->getRepository('BaseCoreBundle:Info')->getSameDayInfo($settings->getFestival()->getId(), $locale, $newsDate, $count, $news->getId());
            $sameDayArticles = $this->removeUnpublishedNewsAudioVideo($sameDayArticles, $locale, $count);
            $prevArticlesURL = $em->getRepository('BaseCoreBundle:Info')->getOlderInfo($locale, $this->getFestival()->getId(), $news->getPublishedAt(), 'site-press', $exclude);
            $prevArticlesURL = $this->removeUnpublishedNewsAudioVideo($prevArticlesURL, $locale);
            $nextArticlesURL = $em->getRepository('BaseCoreBundle:Info')->getNextInfo($locale, $this->getFestival()->getId(), $news->getPublishedAt(), 'site-press', $exclude);
            $nextArticlesURL = $this->removeUnpublishedNewsAudioVideo($nextArticlesURL, $locale);
        }

        return array(
            'localeSlugs'            => $localeSlugs,
            'focusArticles'          => $focusArticles,
            'programmations'         => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news'                   => $news,
            'prev'                   => $prevArticlesURL,
            'next'                   => $nextArticlesURL,
            'associatedFilm'         => $associatedFilm,
            'sameDayArticles'        => $sameDayArticles
        );
    }

    /**
     *
     * @Route("/press-actu")
     * @Template("FDCPressBundle:News:list.html.twig")
     * @return array
     */
    public function listAction()
    {

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $dateTime = new DateTime();
        // LIST SETTINGS
        $offset = 0;
        $limit = 15;
        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL STATEMENT ARTICLES
        $statements = $em->getRepository('BaseCoreBundle:Statement')->getAllStatement($locale,$settings->getFestival()->getId());
        //$statements = $this->removeUnpublishedNewsAudioVideo($statements, $locale);

        //GET ALL INFO ARTICLES
        $infos = $em->getRepository('BaseCoreBundle:Info')->getAllInfo($locale, $settings->getFestival()->getId());
        //$infos = $this->removeUnpublishedNewsAudioVideo($infos, $locale);

        if ($statements === null && $infos === null) {
            throw new NotFoundHttpException();
        }
        $allPressNews = array_merge($infos, $statements);

        $pressNews = array_slice($allPressNews, $offset, $limit);
        if (count($allPressNews) > $limit ) {
            $pressNewsLeft = $limit;
        }
        else {
            $pressNewsLeft = false;
        }

        usort($pressNews, function ($a, $b) {
            if ($a->getCreatedAt()->format('Y-m-d H:i:s') == $b->getCreatedAt()->format('Y-m-d H:i:s')) {
                return 0;
            }
            return ($a->getCreatedAt()->format('Y-m-d H:i:s') > $b->getCreatedAt()->format('Y-m-d H:i:s')) ? -1 : 1;
        });

        $filters = array();

        $filters['themes'][0] = array(
            'id' => 'all',
            'content' => 'Tous',
        );

        $filters['format'][0] = array(
            'slug' => 'all',
            'content' => 'Tous',
        );

        $statementsTypes = Statement::getTypes();

        $i = 1;
        foreach ($statementsTypes as $statementsType) {
            $filters['format'][$i]['slug'] = $statementsType;
            $filters['format'][$i]['content'] = $statementsType;
            $i++;
        }

        $i = 1;
        $ii = 0;

        $years = array();
        $themes = array();

        foreach ($pressNews as $statement) {

            if (!in_array($statement->getPublishedAt()->format('Y'), $years)) {
                $filters['dates'][$ii]['content'] = $statement->getPublishedAt()->format('Y');

                $years[] = $statement->getPublishedAt()->format('Y');
            }

            $theme = ($statement->getTheme()->findTranslationByLocale($locale)->getSlug()) ? $statement->getTheme()->findTranslationByLocale($locale)->getSlug() : $statement->getTheme()->findTranslationByLocale('fr')->getSlug();
            if (!in_array($theme, $themes)) {
                $filters['themes'][$i]['id'] = $statement->getTheme()->getId();
                $filters['themes'][$i]['content'] = ($statement->getTheme()->findTranslationByLocale($locale)->getName()) ? $statement->getTheme()->findTranslationByLocale($locale)->getName() : $statement->getTheme()->findTranslationByLocale('fr')->getName() ;
                $themes[] = $theme;
            }
            $i++;
            $ii++;
        }

        $pressStatementInfo = $em->getRepository('BaseCoreBundle:PressStatementInfo')->findOneById($this->getParameter('admin_press_statementinfo_id'));
        if ($pressStatementInfo === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCPressPagePressStatementInfoSeo($pressStatementInfo, $locale);

        return array(
            'filters' => $filters,
            'pressNews' => $pressNews,
            'pressNewsLeft' => $pressNewsLeft,
        );

    }

    /**
     *
     * @Route("/press-actu-ajax", options={"expose"=true})
     * @Template("FDCPressBundle:News:list/article-list-ajax.html.twig")
     * @return array
     */
    public function listAjaxAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        if ($request->isXmlHttpRequest()) {

            // LIST SETTINGS
            $offset = $request->get('offset');
            $limit = 15;
            //GET ALL STATEMENT ARTICLES
            $statements = $em->getRepository('BaseCoreBundle:Statement')->getAllStatement($locale, $settings->getFestival()->getId());
            //$statements = $this->removeUnpublishedNewsAudioVideo($statements, $locale);

            //GET ALL INFO ARTICLES
            $infos = $em->getRepository('BaseCoreBundle:Info')->getAllInfo($locale, $settings->getFestival()->getId());
            //$infos = $this->removeUnpublishedNewsAudioVideo($infos, $locale);

            if ($statements === null && $infos === null) {
                throw new NotFoundHttpException();
            }

            $allPressNews = array_merge($infos, $statements);
            $pressNews = array_slice($allPressNews, $offset, $limit);

            if (count($allPressNews) > $offset + $limit) {
                $pressNewsLeft = $offset + $limit;
            } else {
                $pressNewsLeft = false;
            }

            usort($pressNews, function ($a, $b) {
                if ($a->getCreatedAt()->format('Y-m-d H:i:s') == $b->getCreatedAt()->format('Y-m-d H:i:s')) {
                    return 0;
                }
                return ($a->getCreatedAt()->format('Y-m-d H:i:s') > $b->getCreatedAt()->format('Y-m-d H:i:s')) ? -1 : 1;
            });

            return array(
                'pressNews' => $pressNews,
                'pressNewsLeft' => $pressNewsLeft,
            );

        }
    }

}
