<?php

namespace FDC\EventMobileBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FDC\EventMobileBundle\Component\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Acl\Exception\Exception;

class JuryController extends Controller
{
    /**
     * @Route("/juries/{slug}")
     * @Template("FDCEventMobileBundle:Jury:section.html.twig")
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

        //SEO
        $this->get('base.manager.seo')->setFDCEventPageJurySeo($page, $locale);

        // find all juries by type
        $juries = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmJury')
            ->getJurysByType($festival, $locale, $page->getJuryType()->getId())
        ;

        $members = array();
        $president = null;
        $hasPresident = false;
        foreach ($juries as $jury) {
            $filmMedia = null;
            if ($jury->getMedias()->count()) {
                foreach ($jury->getMedias() as $media) {
                    $filmMedia = $media;
                }
            }
            if (!$filmMedia && $jury->getPerson() && $jury->getPerson()->getMedias()->count()) {
                foreach ($jury->getPerson()->getMedias() as $media) {
                    $filmMedia = $media->getMedia();
                }
            }
            if (!$hasPresident && in_array($jury->getFunction()->getId(), array(1, 4))) {
                $president = array(
                    'jury'       => $jury,
                    'film_media' => $filmMedia,
                );
                $hasPresident = true;
            } else {
                array_push($members, array(
                    'jury'       => $jury,
                    'film_media' => $filmMedia,
                ));
            }
        }

        $next = null;
        if (count($pages) > 1) {
            foreach ($pages as $item) {
                if ($next) {
                    $next = $item;
                    break;
                }
                if ($item->getId() == $page->getId()) {
                    $next = true;
                }
            }
            if ($next === true) {
                if ($pages[0]->getId() !== $page->getId()) {
                    $next = $pages[0];
                } else {
                    $next = $pages[1];
                }
            }
        }

        return array(
            'page'      => $page,
            'pages'     => $pages,
            'next'      => is_object($next) ? $next : false,
            'members'   => $members,
            'president' => $president,
        );

    }
}