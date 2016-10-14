<?php

namespace FDC\CorporateBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
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


        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      INFOS AND STATEMENTS      ////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////
        $lastFestival = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:FilmFestival')->findOneBy(array(), array('id' => 'DESC'));
        $homeInfos = $em->getRepository('BaseCoreBundle:Info')->getInfosByDate($locale, $lastFestival->getId(), $dateTime);
        $homeStatement = $em->getRepository('BaseCoreBundle:Statement')->getStatementByDate($locale, $lastFestival->getId(), $dateTime);
        $homeContents = array_merge($homeInfos, $homeStatement);

        $homeContents = $this->removeUnpublishedNewsAudioVideo($homeContents, $locale, 6);

        //set default filters
        $filters = array();
        $filters['format'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0] = 'all';

        foreach ($homeContents as $key => $homeContent) {
            $homeContent->theme = $homeContent->getTheme();

            if (($key % 3) == 0) {
                $homeContent->double = true;
            }

            //check if filters don't already exist
            if (!in_array($homeContent->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][] = $homeContent->getTheme()->getId();
                $filters['themes']['content'][] = $homeContent->getTheme();
            }

            if (!in_array($homeContent->getNewsType(), $filters['format'])) {
                $filters['format'][] = $homeContent->getNewsType();
            }
        }


        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////      FEATURED VIDEO      //////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////
        $featuredVideo = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:MediaVideo')->findOneBy(array('displayedHomeCorpo' => 1), array('id' => 'DESC'));

        return array(
            'homepage'           => $homepage,
            'displayHomeSlider'  => $displayHomeSlider,
            'homeSlider'         => $homeSlider,
            'homeContents'       => $homeContents,
            'featuredVideo'      => $featuredVideo,
            'festivalStartsAt'   => $homepage->getFestivalStartsAt(),
            'filters'            => $filters
        );
    }
}
