<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PressController
 *
 * @package FDC\MarcheDuFilmBundle\Controller
 */
class PressController extends Controller
{
    /**
     * @Route("presse/communique-de-presse", name="fdc_marche_du_film_press_releases")
     */
    public function pressReleases()
    {
        $pressReleaseManager = $this->get('mdf.manager.press_release');
        $contentTemplateManager = $this->get('mdf.manager.content_template');

        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $pressReleasePage = $pressReleaseManager->getPressReleasePage();

        if(!$pressReleasePage) {
            throw new NotFoundHttpException();
        }

        return $this->render('FDCMarcheDuFilmBundle::presse/pressReleases.html.twig', array(
            'pressReleasePage' => $pressReleasePage,
            'news' => $newsContent
        ));
    }

    /**
     * @Route("/presse/galerie-photos", name="fdc_marche_du_film_press_gallery")
     */
    public function pressGalleryAction()
    {
        $pressGalleryManager = $this->get('mdf.manager.press_gallery');

        $pressGalleryContent = $pressGalleryManager->getPressGalleryContent();
        $pressGalleryWidgets = $pressGalleryManager->getPressGalleryWidgets();

        return $this->render('FDCMarcheDuFilmBundle:presse:pressGallery.html.twig', array(
            'pressGalleryContent' => $pressGalleryContent,
            'pressGalleryWidgets' => $pressGalleryWidgets
        ));
    }

    /**
     * @Route("/presse/charte-graphique", name="fdc_marche_du_film_press_graphical_charter")
     */
    public function pressGraphicalCharterAction()
    {
        $pressGraphicalCharterManager = $this->get('mdf.manager.press_graphical_charter');

        $pressGraphicalCharterContent = $pressGraphicalCharterManager->getPressGraphicalCharterContent();
        $pressGraphicalCharterWidgets = $pressGraphicalCharterManager->getPressGraphicalCharterWidgets();

        return $this->render('FDCMarcheDuFilmBundle:presse:pressGraphicalCharter.html.twig', array(
            'pressGraphicalCharterContent' => $pressGraphicalCharterContent,
            'pressGraphicalCharterWidgets' => $pressGraphicalCharterWidgets
        ));
    }

    /**
     * @Route("/presse/retombees-presse", options = { "expose" = true }, name="fdc_marche_du_film_press_coverage")
     */
    public function pressCoverageAction(Request $request)
    {
        $pressCoverageManager = $this->get('mdf.manager.press_coverage');
        
        if ($offset = $request->request->get('numberOfArticles')) {
            $pressCoverageWidgets = $pressCoverageManager->getPressCoverageWidgets($offset);

            return $this->render('FDCMarcheDuFilmBundle:presse:articleList.html.twig', array(
                'pressCoverageWidgets' => $pressCoverageWidgets
            ));
        } else {
            $pressCoverageContent = $pressCoverageManager->getPressCoverageContent();
            $pressCoverageWidgets = $pressCoverageManager->getPressCoverageWidgets();
            $showMoreButton = $pressCoverageManager->showMoreButton();

            return $this->render('FDCMarcheDuFilmBundle:presse:pressCoverage.html.twig', array(
                'pressCoverageContent' => $pressCoverageContent,
                'pressCoverageWidgets' => $pressCoverageWidgets,
                'showMoreButton' => $showMoreButton
            ));
        }
    }
}
