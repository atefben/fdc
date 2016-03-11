<?php

namespace FDC\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FDC\EventBundle\Component\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Acl\Exception\Exception;

class JuryController extends Controller
{
    /**
     * @Route("/juries/{slug}")
     * @Template("FDCEventBundle:Jury:section.html.twig")
     * @param Request $request
     * @param type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Request $request, $slug = null)
    {
        $this->isPageEnabled($request->get('_route'));
        $festival = $this->getFestival()->getId();
        $locale = $request->getLocale();

        $waitingPage = $this->isWaitingPage($request);
        if ($waitingPage) {
            return $waitingPage;
        }

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageJury')
            ->getPages($locale)
        ;

        if ($slug === null) {
            foreach ($pages as $page) {
                if ($page->findTranslationByLocale($locale)) {
                    $slug = $page->findTranslationByLocale($locale)->getSlug();
                }
                if ($slug) {
                    return $this->redirectToRoute('fdc_event_jury_get', array('slug' => $slug));
                }

            }
            throw $this->createNotFoundException('Page Jury not found');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageJury')
            ->getPageBySlug($locale, $slug)
        ;

        // find all juries by type
        $juries = $this->getDoctrineManager()->getRepository('BaseCoreBundle:FilmJury')->findBy(
            array(
                'type' => 1,
                'festival' => $festival
            )
        );

//        // find all juries by type
//        $juries = $this
//            ->getDoctrineManager()
//            ->getRepository('BaseCoreBundle:FilmJury')
//            ->getJurysByType($festival, $locale, $page->getJuryType()->getId())
//        ;

        $members = array();
        $president = null;
        $hasPresident = false;
        foreach ($juries as $jury) {
            if (!$hasPresident && $jury->getFunction()->getId() == 1) {
                $president = $jury;
                $hasPresident = true;
            } else {
                array_push($members, $jury);
            }
        }


        return array(
            'page'      => $page,
            'pages'     => $pages,
            'members'   => $members,
            'president' => $president,
        );

    }
}