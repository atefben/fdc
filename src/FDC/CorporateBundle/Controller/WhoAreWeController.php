<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\CorpoWhoAreWe;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $equipes = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoTeam')
            ->findOneById(1)
        ;

        if (!$equipes) {
            throw $this->createNotFoundException('There is not available Team.');
        }

        if ($equipes->findTranslationByLocale('fr')->getStatus() == 1) {
            return $this->render('FDCCorporateBundle:WhoAreWe:equipe.html.twig', [
                'datas' => $equipes,
            ]);
        } else {
            throw $this->createNotFoundException('There is not available Team.');
        }

    }

    /**
     * @Route("/nav")
     * @param Request $request
     * @return Response
     */
    public function navAction(Request $request, $slug = null)
    {
        $nav = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoWhoAreWe')
            ->findBy([], ['weight' => 'asc'])
        ;

        $pages = [];
        foreach ($nav as $n) {
            if ($n->findTranslationByLocale('fr')->getStatus() == 1) {
                $pages[] = $n;
            }
        }
        return $this->render('FDCCorporateBundle:WhoAreWe:nav.html.twig', [
            'pages' => $pages,
            'slug'  => $slug
        ]);
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
                        return $this->redirectToRoute('fdc_corporate_whoarewe_show', ['slug' => $slug]);
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

        return $this->render('FDCCorporateBundle:WhoAreWe:index.html.twig', [
            'pages'       => $pages,
            'currentPage' => $page
        ]);
    }

}


