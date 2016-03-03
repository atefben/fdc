<?php

namespace FDC\PressBundle\Controller;

use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Entity\Info;

use \DateTime;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $headerInfo = array(
            'title' => 'Accueil',
            'description' => 'L\'espace presse met également à la disposition du grand public des contenus en libre
                              accès. Journalistes, pour visualiser les contenus et services qui vous sont exclusivement
                              réservés, nous vous invitons à saisir le code qui vous a été délivré par le
                              <a href="#" class="service-presse">service de presse</a>'
        );

        $translator = $this->get('translator');

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $dateTime = new DateTime();

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

        $date = new \DateTime;
        if (in_array($date->format('Ymd'), $schedulingDays)) {

            $dayProjection = $em->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionByDate($date->format('Ymd'));

        }
        else {

            $dayProjection = $em->getRepository('BaseCoreBundle:FilmProjection')
                ->getProjectionByDate($festivalStartsAt->format('Ymd'));

        }

        //GET PRESS HOMEPAGE
        $homepage = $em->getRepository('BaseCoreBundle:PressHomepage')->findOneById($this->getParameter('admin_press_homepage_id'));

        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

        return array(
            'headerInfo' => $headerInfo,
            'homeNews' => $homeNews,
            'schedulingDays' => $this->createDateRangeArray($festivalStartsAt->format('Y-m-d'),$festivalEndsAt->format('Y-m-d')),
            'dayProjection' => $dayProjection,
            'pressHome' => $homepage
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
     * @Route("/press-articles/{type}/{format}/{slug}", requirements={"format": "articles|audios|videos|photos", "type": "statement|info"}, options={"expose"=true}))
     * @Template("FDCPressBundle:News:main.html.twig")
     * @param $slug
     * @param $format
     * @param $type
     * @return array
     */
    public function getAction($format, $slug, $type)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        $isAdmin = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $format = substr($format, 0, -1);

        // GET STATEMENT / INFO
        if ($type == "statement") {
            $mapper = array_flip(Statement::getTypes());
            if (!isset($mapper[$format])) {
                throw  new NotFoundHttpException();
            }
            $statement = $em->getRepository('BaseCoreBundle:Statement')->getStatementBySlug(
                $slug,
                $settings->getFestival()->getId(),
                $locale,
                $isAdmin,
                $mapper[$format]
            );
        }
        else {
            $mapper = array_flip(Info::getTypes());
            if (!isset($mapper[$format])) {
                throw  new NotFoundHttpException();
            }
            $statement = $em->getRepository('BaseCoreBundle:Info')->getInfoBySlug(
                $slug,
                $settings->getFestival()->getId(),
                $locale,
                $isAdmin,
                $mapper[$format]
            );
        }

        if ($statement == null) {
            throw  new NotFoundHttpException();
        }

        //get associated film to the news
        $associatedFilm = null;
        $associatedProgrammation = null;
        $associatedFilmDuration = null;
        $type = null;
        if ($statement->getAssociatedFilm() != null) {
            $associatedFilm = $statement->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $type = 'film';
        } elseif ($statement->getAssociatedEvent() != null) {
            $associatedFilm = $statement->getAssociatedEvent()->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $type = 'film';
        } elseif ($statement->getAssociatedProjections() != null) {
            $associatedProgrammation = $statement->getAssociatedProjections();
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
        if($statement instanceof Statement) {
            $associatedNews = $statement->getAssociatedStatement();
            $focusArticles  = array();
            foreach ($associatedNews as $associatedNew) {
                if($associatedNew->getAssociation() != null) {
                    $focusArticles[] = $associatedNew->getAssociation();
                }
            }
        }
        else {
            $associatedNews = $statement->getAssociatedInfo();
            $focusArticles  = array();
            foreach ($associatedNews as $associatedNew) {
                if($associatedNew->getAssociation() != null) {
                    $focusArticles[] = $associatedNew->getAssociation();
                }
            }
        }


        //get day articles
        $count = 3;
        $statementDate = $statement->getPublishedAt();

        if($statement instanceof Statement) {
            $sameDayArticles = $em->getRepository('BaseCoreBundle:Statement')
                ->getSameDayStatement(
                    $settings->getFestival()->getId(),
                    $locale,
                    $statementDate,
                    $count,
                    $statement->getId()
                );
        }
        else {
            $sameDayArticles = $em->getRepository('BaseCoreBundle:Info')
                ->getSameDayInfo(
                    $settings->getFestival()->getId(),
                    $locale,
                    $statementDate,
                    $count,
                    $statement->getId()
                );
        }

        return array(
            'focusArticles' => $focusArticles,
            'programmations' => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news' => $statement,
            'associatedFilm' => $associatedFilm,
            'sameDayArticles' => $sameDayArticles,
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

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL STATEMENT ARTICLES
        $statements = $em->getRepository('BaseCoreBundle:Statement')->getStatements($settings->getFestival()->getId(), $dateTime, $locale);

        //GET ALL INFO ARTICLES
        $infos = $em->getRepository('BaseCoreBundle:Info')->getInfos($settings->getFestival()->getId(), $dateTime, $locale);

        if ($statements === null && $infos === null) {
            throw new NotFoundHttpException();
        }
        $pressNews = array_merge($infos, $statements);

        usort($pressNews, function ($a, $b) {
            if ($a->getCreatedAt()->format('Y-m-d H:i:s') == $b->getCreatedAt()->format('Y-m-d H:i:s')) {
                return 0;
            }
            return ($a->getCreatedAt()->format('Y-m-d H:i:s') > $b->getCreatedAt()->format('Y-m-d H:i:s')) ? -1 : 1;
        });

        $filters = array();
        $filters['dates'][0] = array(
            'slug' => 'all',
            'content' => 'Toutes',
        );

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

        $years = array();
        $themes = array();

        foreach ($pressNews as $statement) {

            if (!in_array($statement->getPublishedAt()->format('Y'), $years)) {
                $filters['dates'][$i]['slug'] = $statement->getPublishedAt()->format('Y');
                $filters['dates'][$i]['content'] = $statement->getPublishedAt()->format('Y');

                $years[] = $statement->getPublishedAt()->format('Y');
            }
            if (!in_array($statement->getTheme()->getSlug(), $themes)) {
                $filters['themes'][$i]['id'] = $statement->getTheme()->getId();
                $filters['themes'][$i]['content'] = $statement->getTheme()->getName();

                $themes[] = $statement->getTheme()->getSlug();
            }
            $i++;
        }

        return array(
            'filters' => $filters,
            'pressNews' => $pressNews,
        );

    }

}
