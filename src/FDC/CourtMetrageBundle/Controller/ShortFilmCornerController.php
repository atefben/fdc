<?php

namespace FDC\CourtMetrageBundle\Controller;

use FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner;
use FDC\CourtMetrageBundle\Manager\ShortFilmCornerManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ShortFilmCornerController
 * @package FDC\CourtMetrageBundle\Controller
 */
class ShortFilmCornerController extends Controller
{
    /**
     * @Route("quisommesnous/{slug}", name="fdc_court_metrage_sfc_who_are_we", defaults={"slug"=null})
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function whoAreWeAction($slug, Request $request)
    {
        $pageData = null;
        $locale = $request->get('_locale', 'fr');
        /** @var ShortFilmCornerManager $manager */
        $manager = $this->get('ccm.manager.sfc');
        
        if ($slug != null) {
            $pageData = $manager->getPageData(CcmShortFilmCorner::TYPE_WHO_ARE_WE, $locale, $slug);
        } else {
            /**
             * if no slug is provided we find the first chronological page
             * and redirect to it
             */
            if (($slug = $manager->getFirstSFCPageSlug(CcmShortFilmCorner::TYPE_WHO_ARE_WE, $locale)) !== null) {

                return $this->redirectToRoute('fdc_court_metrage_sfc_who_are_we', ['slug' => $slug]);
            }
        }

        if ($pageData == null) throw $this->createNotFoundException();
        
        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }

    /**
     * @Route("nosevenements/{slug}", name="fdc_court_metrage_sfc_our_events", defaults={"slug"=null})
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ourEventsAction($slug, Request $request)
    {
        $pageData = null;
        $locale = $request->get('_locale', 'fr');

        /** @var ShortFilmCornerManager $manager */
        $manager = $this->get('ccm.manager.sfc');

        if ($slug != null) {
            $pageData = $manager->getPageData(CcmShortFilmCorner::TYPE_OUR_EVENTS, $locale, $slug);
        } else {
            /**
             * if no slug is provided we find the first chronological page
             * and redirect to it
             */
            if (($slug = $manager->getFirstSFCPageSlug(CcmShortFilmCorner::TYPE_OUR_EVENTS, $locale)) !== null) {

                return $this->redirectToRoute('fdc_court_metrage_sfc_our_events', ['slug' => $slug]);
            }
        }

        if ($pageData == null) throw $this->createNotFoundException();

        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }

    /**
     * @Route("revivezledition/{slug}", name="fdc_court_metrage_sfc_relive_edition", defaults={"slug"=null})
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($slug, Request $request)
    {
        $pageData = null;
        $locale = $request->get('_locale', 'fr');

        /** @var ShortFilmCornerManager $manager */
        $manager = $this->get('ccm.manager.sfc');

        if ($slug != null) {
            $pageData = $manager->getPageData(CcmShortFilmCorner::TYPE_RELIVE_EDITION, $locale, $slug);
        } else {
            /**
             * if no slug is provided we find the first chronological page
             * and redirect to it
             */
            if (($slug = $manager->getFirstSFCPageSlug(CcmShortFilmCorner::TYPE_RELIVE_EDITION, $locale)) !== null) {

                return $this->redirectToRoute('fdc_court_metrage_sfc_relive_edition', ['slug' => $slug]);
            }
        }

        if ($pageData == null) throw $this->createNotFoundException();

        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }
}
