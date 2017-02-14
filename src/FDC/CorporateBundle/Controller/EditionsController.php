<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\CorpoPalmeOr;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/69-editions")
 */
class EditionsController extends Controller
{
    /**
     * @Route("/retrospective/")
     * @return Response
     */
    public function retrospectiveAction()
    {
        return $this->render('FDCCorporateBundle:Retrospective:years_slider.html.twig');
    }

    /**
     * @Route("/retrospective/menu")
     * @param Request $request
     * @param $year
     * @param $route
     * @return Response
     */
    public function menuAction(Request $request, $year, $route)
    {
        $festival = $this->getFestival($year);
        $locale = $request->getLocale();

        //posters
        $posters = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFestivalPoster')
            ->findBy(['festival' => $festival])
        ;

        //photos
        $medias = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Media')
            ->getImageMedia($locale, $festival->getId())
        ;

        //news
        $news = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:News')
            ->getAllNews($locale, $festival->getId())
        ;
        $news = $this->removeUnpublishedNewsAudioVideo($news, $locale, null, true);

        //events
        $events = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Event')
            ->getEvents($festival, $locale)
        ;

        return $this->render('FDCCorporateBundle:Retrospective:components/menu.html.twig', [
            'posters' => $posters,
            'medias'  => $medias,
            'news'    => $news,
            'events'  => $events,
            'route'   => $route,
        ]);

    }

    /**
     * @Route("/retrospective/{year}/affiche", requirements={"year" = "\d+"})
     * @param Request $request
     * @param $year
     * @return Response
     */
    public function afficheAction(Request $request, $year)
    {
        $festival = $this->getFestival($year);

        $posters = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFestivalPoster')
            ->findBy(['festival' => $festival])
        ;

        $bitlyManager = $this->get('base.manager.bitly');
        $params = [
            'access_token' => '1471b10911b48ad79ad042b02a15711ea71fc6c0',
            'longUrl'      => $request->getUri(),
        ];
        $results = $bitlyManager->bitly_get('shorten', $params);

        return $this->render('FDCCorporateBundle:Retrospective:affiche.html.twig', [
            'posters'   => $posters,
            'festival'  => $festival,
            'urlshare'  => $results['data']['url'],
            'year'  => $year,
        ]);
    }

    /**
     * @Route("/retrospective/{year}/", requirements={"year" = "\d+"})
     * @param $year
     * @return RedirectResponse
     */
    public function yearAction($year)
    {
        return $this->redirectToRoute('fdc_corporate_movie_selection', ['year' => $year]);
    }

    /**
     * @Route("/history")
     * @return Response
     */
    public function historyAction()
    {
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoFestivalHistory')
            ->find(1)
        ;

        if ($page->findTranslationByLocale('fr')->getStatus() == 1) {
            return $this->render('FDCCorporateBundle:Retrospective:history.html.twig', [
                'currentPage' => $page,
            ]);
        } else {
            throw $this->createNotFoundException('There is not available selection.');
        }
    }

    /**
     * @Route("/archives")
     * @param Request $request
     * @return Response
     */
    public function archivesAction(Request $request)
    {
        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoPalmeOr')
            ->find(3)
        ;

        $cond = !$page || !$page->findTranslationByLocale('fr');
        $cond = $cond || $page->findTranslationByLocale('fr')->getStatus() !== TranslateChildInterface::STATUS_PUBLISHED;
        if ($cond) {
            throw $this->createNotFoundException('There is not available selection.');
        }

        return $this->render('FDCCorporateBundle:Retrospective:palme.html.twig', [
            'currentPage' => $page,
            'archives'    => true,
        ]);
    }

    /**
     * @Route("/palme/{slug}")
     * @param Request $request
     * @param null $slug
     * @return RedirectResponse|Response
     */
    public function PalmeAction(Request $request, $slug = null)
    {
        $locale = $request->getLocale();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoPalmeOr')
            ->getAllPagesByLocale($locale)
        ;

        if ($slug === null) {
            foreach ($pages as $page) {
                if ($page instanceof CorpoPalmeOr) {
                    if ($page->findTranslationByLocale($locale)) {
                        $slug = $page->findTranslationByLocale($locale)->getSlug();
                    }
                    if ($slug) {
                        return $this->redirectToRoute('fdc_corporate_editions_palme', ['slug' => $slug]);
                    }
                }
            }
            throw $this->createNotFoundException('There is not available selection.');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoPalmeOr')
            ->getPageBySlug($locale, $slug)
        ;

        return $this->render('FDCCorporateBundle:Retrospective:palme.html.twig', [
            'pages'       => $pages,
            'currentPage' => $page,
        ]);
    }

}
