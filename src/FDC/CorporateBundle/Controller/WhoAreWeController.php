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
     * @Route("/{slug}")
     * @param Request $request
     * @return Response
     */
    public function showAction(Request $request, $slug = null)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $festival = $this->getFestival()->getId();

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

        $localeSlugs = $page->getLocaleSlugs();

        return $this->render('FDCCorporateBundle:WhoAreWe:index.html.twig', array(
            'pages' => $pages,
            'currentPage' => $page
        ));
    }
}
