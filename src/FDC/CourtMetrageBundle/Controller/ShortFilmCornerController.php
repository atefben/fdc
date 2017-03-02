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
     * @Route("quisommesnous/{slug}", name="ccm_sfc_who_are_we", defaults={"slug"=null})
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function whoAreWeAction($slug, Request $request)
    {
        $homepageManger = $this->get('ccm.manager.homepage');
        $sejour = $homepageManger->getSejouresFromShortFilm();

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
            if (($slug = $manager->getFirstWhoAreWePageSlug($locale)) !== null) {

                return $this->redirectToRoute('ccm_sfc_who_are_we', ['slug' => $slug]);
            }
        }

        if ($pageData == null) throw $this->createNotFoundException();

        $pageData = array_merge(
            $pageData,
            [
                'sejour' => $sejour,
            ]
        );
        
        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }
    
    /**
     * @Route("nosevenements", name="ccm_sfc_our_events")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ourEventsAction(Request $request)
    {
        $homepageManger = $this->get('ccm.manager.homepage');
        $sejour = $homepageManger->getSejouresFromShortFilm();

        $locale = $request->get('_locale', 'fr');

        $pageData = $this->get('ccm.manager.sfc')->getPageData(CcmShortFilmCorner::TYPE_OUR_EVENTS, $locale);

        if ($pageData == null) {
            throw $this->createNotFoundException();
        }

        $pageData = array_merge(
            $pageData,
            [
                'sejour' => $sejour,
            ]
        );

        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }
    
    /**
     * @Route("revivezledition", name="ccm_sfc_relive_edition")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $homepageManger = $this->get('ccm.manager.homepage');
        $sejour = $homepageManger->getSejouresFromShortFilm();

        $locale = $request->get('_locale', 'fr');
        
        $pageData = $this->get('ccm.manager.sfc')->getPageData(CcmShortFilmCorner::TYPE_RELIVE_EDITION, $locale);
        
        if ($pageData == null) {
            throw $this->createNotFoundException();
        }

        $pageData = array_merge(
            $pageData,
            [
                'sejour' => $sejour,
            ]
        );

        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }
}
