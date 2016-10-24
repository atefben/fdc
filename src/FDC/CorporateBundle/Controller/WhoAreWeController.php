<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\CorpoWhoAreWe;
use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/qui-sommes-nous")
 */
class WhoAreWeController extends Controller
{

    /**
     * @Route("/equipe")
     * @param Request $request
     * @return Response
     */
    public function equipeAction(Request $request)
    {
        $datas = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoTeam')
            ->find(1)
        ;

        if(!$datas) {
            throw $this->createNotFoundException('There is not available Team.');
        }
        return $this->render('FDCCorporateBundle:WhoAreWe:equipe.html.twig', array(
            'datas' => $datas,
        ));
    }

    /**
     * @Route("/nav")
     * @param Request $request
     * @return Response
     */
    public function navAction(Request $request, $slug = null)
    {
        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoWhoAreWe')
            ->findAll()
        ;

        return $this->render('FDCCorporateBundle:WhoAreWe:nav.html.twig', array(
            'pages' => $pages,
            'slug'  => $slug
        ));
    }

    /**
     * @Route("/{slug}")
     * @param Request $request
     * @return Response
     */
    public function showAction(Request $request, $slug = null)
    {
        $locale = $request->getLocale();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoWhoAreWe')
            ->findAll()
        ;
        if ($slug === null) {
            foreach ($pages as $page) {
                if ($page instanceof CorpoWhoAreWe) {
                    if ($page->findTranslationByLocale($locale)) {
                        $slug = $page->findTranslationByLocale($locale)->getSlug();
                    }
                    if ($slug) {
                        return $this->redirectToRoute('fdc_corporate_whoarewe_show', array('slug' => $slug));
                    }
                }
            }
            throw $this->createNotFoundException('There is not available selection.');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoWhoAreWe')
            ->getPageBySlug($locale, $slug)
        ;

        return $this->render('FDCCorporateBundle:WhoAreWe:index.html.twig', array(
            'pages' => $pages,
            'currentPage' => $page
        ));
    }

}


