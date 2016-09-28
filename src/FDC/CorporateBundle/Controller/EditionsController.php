<?php

namespace FDC\CorporateBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Base\CoreBundle\Entity\FDCPageLaSelection;

/**
 * @Route("/69-editions/retrospective")
 */
class EditionsController extends Controller
{
    /**
     * @Route("/")
     * @Template("FDCCorporateBundle:Retrospective:years_slider.html.twig")
     */
    public function retrospectiveAction()
    {
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        return array('festivals' => $festivals);
    }

    /**
     * @Route("/menu")
     * @Template("FDCCorporateBundle:Retrospective:components/menu.html.twig")
     * @return array
     */
    public function menuAction(Request $request, $year, $route) {
        $em = $this->get('doctrine')->getManager();
        $festival = $this->getFestival($year);
        $locale = $request->getLocale();

        //posters
        $posters = $em->getRepository('BaseCoreBundle:FilmFestivalPoster')
            ->findByFestival($festival);

        //photos
        $medias = $em->getRepository('BaseCoreBundle:Media')->getImageMedia($locale, $festival->getId());

        //news
        $news = $em->getRepository('BaseCoreBundle:News')->getAllNews($locale, $festival->getId());
        $news = $this->removeUnpublishedNewsAudioVideo($news, $locale, null, true);
        
        //events
        $events =
            $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:Event')
                ->getEvents($festival, $locale)
        ;

        return array(
            'posters' => $posters,
            'medias' => $medias,
            'news' => $news,
            'events' => $events,
            'route' => $route
        );

    }

    /**
     * @Route("/{year}/", requirements={"year" = "\d+"})
     */
    public function yearAction(Request $request, $year)
    {
        $locale = $request->getLocale();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale);

        foreach ($pages as $page) {
            if ($page instanceof FDCPageLaSelection) {
                if ($page->findTranslationByLocale($locale)) {
                    $slug = $page->findTranslationByLocale($locale)->getSlug();
                }
                if (!$slug) {
                    $page->getSelectionSection()->findTranslationByLocale($locale)->getSlug();
                }
                if ($slug) {
                    return $this->redirectToRoute('fdc_corporate_movie_selection', array('slug' => $slug, 'year' => $year));
                }
            }
        }
        throw $this->createNotFoundException('There is not available selection.');
    }


    /**
     * @Route("/{year}/affiche", requirements={"year" = "\d+"})
     * @Template("FDCCorporateBundle:Retrospective:affiche.html.twig")
     * @param Request $request
     * @param $year
     * @return array
     */
    public function afficheAction(Request $request, $year)
    {
        $em = $this->get('doctrine')->getManager();

        $festival = $this->getFestival($year);
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        $posters = $em->getRepository('BaseCoreBundle:FilmFestivalPoster')
            ->findByFestival($festival);

        $bitlyManager = $this->get('base.manager.bitly');
        $params['access_token'] = '1471b10911b48ad79ad042b02a15711ea71fc6c0';
        $params['longUrl'] = $request->getUri();
        $results = $bitlyManager->bitly_get('shorten', $params);

        return array('posters' => $posters, 'festival' => $festival, 'festivals' => $festivals, 'urlshare' => $results['data']['url']);
    }
}
