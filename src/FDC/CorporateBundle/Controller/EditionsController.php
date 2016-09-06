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

        return array('posters' => $posters, 'festival' => $festival, 'festivals' => $festivals);
    }
}
