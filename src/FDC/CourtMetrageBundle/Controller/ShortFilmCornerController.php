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
     * @Route("quisommesnous", name="ccm_sfc_who_are_we")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function whoAreWeAction(Request $request)
    {
        $locale = $request->get('_locale', 'fr');
        
        $pageData = $this->get('ccm.manager.sfc')->getPageData(CcmShortFilmCorner::TYPE_WHO_ARE_WE, $locale);
        
        if ($pageData == null) {
            throw $this->createNotFoundException();
        }
        
        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }
    
    /**
     * @Route("nosevenements", name="ccm_sfc_our_events")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ourEventsAction(Request $request)
    {
        $locale = $request->get('_locale', 'fr');
        
        $pageData = $this->get('ccm.manager.sfc')->getPageData(CcmShortFilmCorner::TYPE_OUR_EVENTS, $locale);
        
        if ($pageData == null) {
            throw $this->createNotFoundException();
        }
        
        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }
    
    /**
     * @Route("revivezledition", name="ccm_sfc_relive_edition")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $locale = $request->get('_locale', 'fr');
        
        $pageData = $this->get('ccm.manager.sfc')->getPageData(CcmShortFilmCorner::TYPE_RELIVE_EDITION, $locale);
        
        if ($pageData == null) {
            throw $this->createNotFoundException();
        }
        
        return $this->render('@FDCCourtMetrage/shortfilmcorner/show.html.twig', $pageData);
    }
}
