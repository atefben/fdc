<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
}
