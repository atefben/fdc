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
     * @param Request $request
     * @param type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Request $request, $type)
    {
        $this->isPageEnabled($request->get('_route'));
        $festivalId = 54;
        $locale   = $request->getLocale();
        $em = $this->getDoctrine()->getManager();

        $waitingPage = $this->isWaitingPage($request);
        if ($waitingPage) {
            return $waitingPage;
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