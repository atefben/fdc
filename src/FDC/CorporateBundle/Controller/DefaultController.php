<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\Statement;
use DateTime;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/homepagecorporate/gallery")
     * @Template("BaseAdminBundle:Gallery:show.html.twig")
     */
    public function galleryCorpoAction(Request $request)
    {
        $gallery = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:Gallery')->findOneBy(['displayedHomeCorpo' => 1], ['id' => 'DESC']);

        return ['gallery' => $gallery];
    }

    /**
     * @Route("/homepagecorporate/mediavideo")
     * @Template("BaseAdminBundle:MediaVideo:show.html.twig")
     */
    public function videoCorpoAction(Request $request)
    {
        $video = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:MediaVideo')->findOneBy(['displayedHomeCorpo' => 1], ['id' => 'DESC']);

        return ['video' => $video];
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

        // Slider
        $slides = $em->getRepository('BaseCoreBundle:HomepageCorporateSlide')->getAllSlide($locale, $dateTime);

        $displayHomeSlider = $homepage->getDisplayedSlider();
        $homeSlider = [];
        foreach ($slides as $slide) {
            if ($slide->getInfo() != null) {
                $homeSlider[] = $slide->getInfo();
            } elseif ($slide->getStatement() != null) {
                $homeSlider[] = $slide->getStatement();
            }
        }

        // Infos and statements
        $homeContents = [];
        $homeInfos = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Info')
            ->getInfosByDate($locale, null, $dateTime, null, 'site-institutionnel')
        ;
        $homeStatement = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getStatementByDate($locale, null, $dateTime, null, 'site-institutionnel')
        ;
        $homeContents = array_merge($homeInfos, $homeStatement);
        $this->sortByDate($homeContents);
        $homeContents = $this->removeUnpublishedNewsAudioVideo($homeContents, $locale, 6);

        //set default filters
        $filters = [];
        $filters['format'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';

        foreach ($homeContents as $key => $homeContent) {
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

        $featuredVideo = $homepage->getVideoUne();

        $gallery = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Gallery')
            ->findOneBy(['displayedHomeCorpo' => 1], ['id' => 'DESC'])
        ;
        $galleryMedias = [];
        foreach ($gallery->getMedias() as $m) {
            if ($m->getMedia() && $m->getMedia()->findTranslationByLocale('fr')->getStatus() == 1 && $m->getMedia()->getPublishedAt() <= new \DateTime()) {
                $galleryMedias[] = $m;
            }
        }


        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsReleases($dateTime)
        ;

        return [
            'homepage'          => $homepage,
            'displayHomeSlider' => $displayHomeSlider,
            'filmReleases'      => $movies,
            'homeSlider'        => $homeSlider,
            'homeContents'      => $homeContents,
            'featuredVideo'     => $featuredVideo,
            'festivalStartsAt'  => $homepage->getFestivalStartsAt(),
            'gallery'           => $gallery,
            'galleryMedias'     => $galleryMedias,
            'filters'           => $filters
        ];
    }

    protected function sortByDate(&$items)
    {
        $sort = [];
        foreach ($items as $item) {
            if ($item instanceof Info) {
                $key = $item->getPublishedAt()->getTimestamp() . '-info' . $item->getId();
                $sort[] = $item;
            }
            elseif ($item instanceof Statement) {
                $key = $item->getPublishedAt()->getTimestamp() . '-statement' . $item->getId();
                $sort[] = $item;
            }
        }
        krsort($sort);
        $items = array_values($sort);
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
        $homepage = $em->getRepository('BaseCoreBundle:Homepage')->findOneBy([
            'festival' => $this->getFestival(),
        ])
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
                $homeArticlesNext = [];
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
        $filters = [];
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

        return [
            'homeArticlesSlider' => $homeArticlesSlider,
            'endOfArticles'      => $endOfArticles,
            'homeArticles'       => $homeArticles,
            'homeArticlesNext'   => $homeArticlesNext,
            'filters'            => $filters,
        ];
    }
}
