<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfPressGalleryTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfPressGraphicalCharterTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfPressReleaseTranslation;
use FDC\MarcheDuFilmBundle\Entity\PressCoverageTranslation;
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

        $pageTranslationStatus = $pressReleasePage->getStatus();
        if(($pageTranslationStatus != MdfPressReleaseTranslation::STATUS_TRANSLATED) && ($pageTranslationStatus != MdfPressReleaseTranslation::STATUS_PUBLISHED))
        {
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

        $pageTranslationStatus = $pressGalleryContent->getStatus();
        if(($pageTranslationStatus != MdfPressGalleryTranslation::STATUS_TRANSLATED) && ($pageTranslationStatus != MdfPressGalleryTranslation::STATUS_PUBLISHED))
        {
            throw new NotFoundHttpException();
        }

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

        $pageTranslationStatus = $pressGraphicalCharterContent->getStatus();
        if(($pageTranslationStatus != MdfPressGraphicalCharterTranslation::STATUS_TRANSLATED) && ($pageTranslationStatus != MdfPressGraphicalCharterTranslation::STATUS_PUBLISHED))
        {
            throw new NotFoundHttpException();
        }

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

            $pageTranslationStatus = $pressCoverageContent->getStatus();
            if(($pageTranslationStatus != PressCoverageTranslation::STATUS_TRANSLATED) && ($pageTranslationStatus != PressCoverageTranslation::STATUS_PUBLISHED))
            {
                throw new NotFoundHttpException();
            }

            $pressCoverageWidgets = $pressCoverageManager->getPressCoverageWidgets();
            $nrOfArticles = $pressCoverageManager->getNumberOfArticles();

            return $this->render('FDCMarcheDuFilmBundle:presse:pressCoverage.html.twig', array(
                'pressCoverageContent' => $pressCoverageContent,
                'pressCoverageWidgets' => $pressCoverageWidgets,
                'nrOfArticles' => $nrOfArticles
            ));
        }
    }
}
