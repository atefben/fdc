<?php

namespace FDC\CorporateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use DateTime;

class DefaultController extends Controller
{
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

        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      SLIDER      //////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////

        $slides = $em->getRepository('BaseCoreBundle:HomepageCorporateSlide')->getAllSlide($locale, $dateTime);

        $displayHomeSlider = $homepage->getDisplayedSlider();
        $homeSlider = array();
        foreach ($slides as $slide) {
            if ($slide->getInfo() != null) {
                $homeSlider[] = $slide->getInfo();
            } elseif ($slide->getStatement() != null) {
                $homeSlider[] = $slide->getStatement();
            }
        }

        //set default filters
        $filters = array();
        $filters['format'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';


        return array(
            'homepage'           => $homepage,
            'displayHomeSlider'  => $displayHomeSlider,
            'homeSlider'         => $homeSlider,
            'festivalStartsAt'      => $homepage->getFestivalStartsAt(),
            'filters'            => $filters
        );
    }
}
