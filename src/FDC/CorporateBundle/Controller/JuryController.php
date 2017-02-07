<?php

namespace FDC\CorporateBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/69-editions/retrospective")
 */
class JuryController extends Controller
{
    /**
     * @Route("/{year}/juries/{slug}", requirements={"year" = "\d+"})
     * @param Request $request
     * @param $slug
     * @param $year
     * @return Response|RedirectResponse
     */
    public function juriesAction(Request $request, $year = null, $slug = null)
    {
        $this->isPageEnabled($request->get('_route'));
        $festival = $this->getFestival($year)->getId();
        $festivals = $this->getDoctrine()->getRepository('BaseCoreBundle:FilmFestival')->findAll();
        $locale = $request->getLocale();

        $waitingPage = $this->isWaitingPage($request);
        if ($waitingPage) {
            return $waitingPage;
        }

        $juryTypes = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmJuryType')
            ->getJuryTypeByFestival($festival)
        ;
        $available = [];

        foreach ($juryTypes as $juryType) {
            if (in_array($juryType->getId(), [3, 5])) {
                $available[] = 3;
                $available[] = 5;
            }
            else {
                $available[] = $juryType->getId();
            }

        }

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageJury')
            ->getPages($locale, $festival)
        ;

        foreach ($pages as $page) {
            if (!in_array($page->getJuryType()->getId(), $available)) {
                $pages = array_diff($pages, array($page));
            }
        }

        if ($slug === null) {
            foreach ($pages as $page) {
                if ($page->findTranslationByLocale($locale)) {
                    $slug = $page->findTranslationByLocale($locale)->getSlug();
                }
                if ($slug) {
                    return $this->redirectToRoute('fdc_corporate_jury_juries', array('slug' => $slug, 'year' => $year));
                }

            }
            throw $this->createNotFoundException('Page Jury not found');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageJury')
            ->getPageBySlug($locale, $slug)
        ;

        if ($page == null) {
            throw new NotFoundHttpException("Page Jury {$slug} not found");
        }

        $localeSlugs = $page->getLocaleSlugs();

        //SEO
        $this->get('base.manager.seo')->setFDCEventPageJurySeo($page, $locale);

        // find all juries by type
        $juryTypeId = $page->getJuryType()->getId();
        if (in_array($juryTypeId, [3, 5])) {
            $juryTypeId = [3, 5];
        }
        $juries = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmJury')
            ->getJurysByType($festival, $locale, $juryTypeId)
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

        if (2015 == $year) {
            $persons = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmPerson')
                ->findBy(['id' => [319026, 319034]])
            ;
            $presidents = [];
            foreach ($persons as $person) {
                $presidents[] = ['jury' => ['person' => $person]];
            }
        }
        else {
            $presidents = [$president];
        }

        return $this->render('FDCCorporateBundle:Jury:section.html.twig', [
            'festival'    => $this->getFestival($year),
            'page'        => $page,
            'pages'       => $pages,
            'next'        => is_object($next) ? $next : false,
            'members'     => $members,
            'presidents'   => $presidents,
            'localeSlugs' => $localeSlugs,
            'festivals'   => $festivals,
        ]);

    }
}