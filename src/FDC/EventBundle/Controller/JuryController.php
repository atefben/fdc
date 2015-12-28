<?php

namespace FDC\EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JuryController extends Controller
{
    /**
     * @Route("/juries/{type}")
     * @Template("FDCEventBundle:Jury:section.html.twig")
     * @param type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($type)
    {
        $festivalId = 54;

        $em = $this->getDoctrine()->getManager();

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