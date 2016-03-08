<?php

namespace FDC\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FDC\EventBundle\Component\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JuryController extends Controller
{
    /**
     * @Route("/juries/{type}")
     * @Template("FDCEventBundle:Jury:section.html.twig")
     * @param type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Request $request, $type)
    {
        $this->isPageEnabled($request->get('_route'));
        $festivalId = 54;
        $locale   = $request->getLocale();
        $em = $this->getDoctrine()->getManager();

        // check if waiting page is enabled
        $waitingPage = $em->getRepository('BaseCoreBundle:FDCPageWaiting')->findBy(array('enabled' => true));
        foreach($waitingPage as $waiting) {
            if($waiting->getPage()->getRoute() == $request->get('_route')){
                return $this->render('FDCEventBundle:Global:waiting-page.html.twig',array(
                    'waitingPage' => $waiting
                ));
            }
        }

        // find all juries by type
        $juries = $em->getRepository('BaseCoreBundle:FilmJury')->findBy(
            array(
                'type' => $type,
                'festival' => $festivalId
            )
        );

        $members = array();
        $president = "";

        foreach ($juries as $jury) {
            if ($jury->getFunction()->getId() == 1) {
                $president = $jury;
            }
            else {
                array_push($members, $jury);
            }
        }


        return array(
            'members' => $members,
            'president' => $president
        );

    }
}