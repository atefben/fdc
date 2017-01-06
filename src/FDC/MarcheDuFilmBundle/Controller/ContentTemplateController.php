<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContentTemplateController extends Controller
{
    /**
     * @Route("presentation", name="fdc_marche_du_film_edition_presentation")
     * @Route("projections", name="fdc_marche_du_film_edition_projections")
     * @Route("industryprogram", name="fdc_marche_du_film_industry_program_home")
     * @Route("quisommesnous/historique", name="fdc_marche_du_film_who_are_we_history")
     */
    public function indexAction()
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');

        $request = $this->container->get('request');
        $routeName = $request->get('_route');

        $pageType = '';
        $isWhoAreWe = false;
        $nextRoute = null;
        $backRoute = null;
        switch ($routeName) {
            case 'fdc_marche_du_film_edition_presentation':
                $pageType = MdfContentTemplate::TYPE_EDITION_PRESENTATION;
                break;
            case 'fdc_marche_du_film_edition_projections':
                $pageType = MdfContentTemplate::TYPE_EDITION_PROJECTIONS;
                break;
            case 'fdc_marche_du_film_industry_program_home':
                $pageType = MdfContentTemplate::TYPE_INDUSTRY_PROGRAM_HOME;
                break;
            case 'fdc_marche_du_film_who_are_we_history':
                $pageType = MdfContentTemplate::TYPE_WHO_ARE_WE_HISTORY;
                $isWhoAreWe = true;
        }

        $titleHeader = $contentTemplateManager->getTitleHeaderContent($pageType);
        $textWidgets = $contentTemplateManager->getContentTemplateTextWidgets($pageType);
        $imageWidgets = $contentTemplateManager->getContentTemplateImageWidgets($pageType);
        $galleryWidgets = $contentTemplateManager->getContentTemplateGalleryWidgets($pageType);
        $fileWidgets = $contentTemplateManager->getContentTemplateFileWidgets($pageType);

        $widgets = [];
        $widgets = array_merge($widgets, $textWidgets, $imageWidgets, $galleryWidgets, $fileWidgets);

        usort($widgets, function($a, $b)
        {
            if (property_exists($a, 'translatable') && property_exists($b, 'translatable')) {
                return strcmp($a->getTranslatable()->getPosition(), $b->getTranslatable()->getPosition());
            } else if (property_exists($a, 'translatable') && !property_exists($b, 'translatable')) {
                return strcmp($a->getTranslatable()->getPosition(), $b->getPosition());
            } else if (!property_exists($a, 'translatable') && property_exists($b, 'translatable')) {
                return strcmp($a->getPosition(), $b->getTranslatable()->getPosition());
            } else if (!property_exists($a, 'translatable') && !property_exists($b, 'translatable')) {
                return strcmp($a->getPosition(), $b->getPosition());
            }
        });

        return $this->render('FDCMarcheDuFilmBundle:contentTemplate:contentTemplate.html.twig', array(
            'titleHeader' => $titleHeader,
            'widgets' => $widgets,
            'isWhoAreWe' => $isWhoAreWe,
            'nextRoute' => $nextRoute,
            'backRoute' => $backRoute
        ));
    }
}
