<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use DateTime;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @param Request $request
     * @return Response
     */
    public function homeAction(Request $request)
    {
        $dateTime = new DateTime();
        $locale = $request->getLocale();
        $settings = $this->getSettings();
        $festivalId = $settings->getFestival()->getId();

        // GET HOMEPAGE SETTINGS
        $homepage = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:HomepageCorporate')
            ->find(1)
        ;
        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

        // Slider
        $slides = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:HomepageCorporateSlide')
            ->getAllSlide($locale, $dateTime)
        ;

        $displayHomeSlider = $homepage->getDisplayedSlider();
        $homeSlider = [];
        foreach ($slides as $slide) {
            if ($slide->getInfo() != null) {
                $homeSlider[] = $slide->getInfo();
            } elseif ($slide->getStatement() != null) {
                $homeSlider[] = $slide->getStatement();
            }
        }

        $filters = [
            'festival'             => $festivalId,
            'displayedOnCorpoHome' => true,
        ];
        $nodes = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getHomeStatementsAndInfos($locale, 100, 'site-institutionnel', 0, $filters)
        ;
        $homeContents = [];
        foreach ($nodes as $node) {
            $homeContents[] = $this->getDoctrineManager()->getRepository($node->getEntityClass())->find($node->getEntityId());
        }
        $homeContents = $this->removeUnpublishedNewsAudioVideo($homeContents, $locale);
        if (count($homeContents) > 6) {
            $last = false;
            $homeContents = array_slice($homeContents, 0, 6);
        } else {
            $last = true;
        }

        //set default filters
        $filters = [];
        $filters['format'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        foreach ($homeContents as $key => $homeContent) {
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
        if ($gallery) {
            foreach ($gallery->getMedias() as $m) {
                $available = $m->getMedia() && $m->getMedia()->findTranslationByLocale('fr');
                if ($available) {
                    $trans = $m->getMedia()->findTranslationByLocale('fr');
                }
                $available = $available && $trans->getStatus() == TranslateChildInterface::STATUS_PUBLISHED;
                $available = $available && $m->getMedia()->getPublishedAt() <= new \DateTime();
                if ($available) {
                    $galleryMedias[] = $m;
                }
            }
        }

        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsReleases($dateTime, 'site-institutionnel')
        ;

        return $this->render('FDCCorporateBundle:News:home.html.twig', [
            'homepage'          => $homepage,
            'displayHomeSlider' => $displayHomeSlider,
            'filmReleases'      => $movies,
            'homeSlider'        => $homeSlider,
            'homeContents'      => $homeContents,
            'featuredVideo'     => $featuredVideo,
            'festivalStartsAt'  => $homepage->getFestivalStartsAt(),
            'gallery'           => $gallery,
            'galleryMedias'     => $galleryMedias,
            'filters'           => $filters,
            'last'              => $last,
            'page'              => 2,
            'festivalYear'      => $this->getFestival()->getYear(),
        ]);
    }

    protected function sortByDate(&$items)
    {
        $sort = [];
        foreach ($items as $item) {
            if ($item instanceof Info) {
                $key = $item->getPublishedAt()->getTimestamp() . '-info' . $item->getId();
                $sort[$key] = $item;
            } elseif ($item instanceof Statement) {
                $key = $item->getPublishedAt()->getTimestamp() . '-statement' . $item->getId();
                $sort[$key] = $item;
            }
        }
        krsort($sort);
        $items = array_values($sort);
    }

    /**
     * @Route("/home-more-infos")
     * @param Request $request
     * @return Response
     */
    public function getArticlesFromAction(Request $request)
    {

        $locale = $request->getLocale();
        $settings = $this->getSettings();
        $festivalId = $settings->getFestival()->getId();
        $page = $request->query->get('page', 1);
        $filters = [
            'festival'             => $festivalId,
            'displayedOnCorpoHome' => true,
        ];
        if ($request->query->has('theme') && $request->query->get('theme')) {
            $themeTranslation = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:ThemeTranslation')
                ->findOneBy(['slug' => $request->query->get('theme')])
            ;
            if ($themeTranslation) {
                $filters['theme'] = $themeTranslation->getTranslatable()->getId();
            }
        }
        if ($request->query->get('format') && $request->query->get('format') != 'all') {
            $filters['format'] = $request->query->get('format');

        }

        $nodes = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Node')
            ->getHomeStatementsAndInfos($locale, 100, 'site-institutionnel', ($page - 1) * 6, $filters)
        ;
        $homeContents = [];
        foreach ($nodes as $node) {
            $homeContents[] = $this->getDoctrineManager()->getRepository($node->getEntityClass())->find($node->getEntityId());
        }

        $this->sortByDate($homeContents);
        $homeContents = $this->removeUnpublishedNewsAudioVideo($homeContents, $locale);
        if (count($homeContents) > 6) {
            $last = false;
            $homeContents = array_slice($homeContents, 0, 6);
        } else {
            $last = true;
        }

        //set default filters
        $filters = [];
        $filters['format'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';
        $lastPublishedAt = null;
        foreach ($homeContents as $key => $homeContent) {
            if (!in_array($homeContent->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $homeContent->getTheme()->getId();
                $filters['themes']['content'][] = $homeContent->getTheme();
            }

            if (!in_array($homeContent->getTypeClone(), $filters['format'])) {
                $filters['format'][] = $homeContent->getTypeClone();
            }
        }
        $lastContent = end($homeContents);
        if ($lastContent) {
            $lastPublishedAt = $homeContent->getPublishedAt()->getTimestamp();
            unset($lastContent);
        }

        return $this->render("FDCCorporateBundle:News:widgets/article-home-ajax.html.twig", [
            'homeArticles' => $homeContents,
            'filters'      => $filters,
            'page'         => $page + 1,
            'festivalYear' => $settings->getFestival()->getYear(),
            'last'         => $last,
        ]);
    }
}
