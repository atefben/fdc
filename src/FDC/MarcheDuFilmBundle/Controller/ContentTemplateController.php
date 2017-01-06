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
     */
    public function indexAction()
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');

        $request = $this->container->get('request');
        $routeName = $request->get('_route');

        $pageType = '';
        switch ($routeName) {
            case 'fdc_marche_du_film_edition_presentation':
                $pageType = MdfContentTemplate::TYPE_EDITION_PRESENTATION;
                break;
            case 'fdc_marche_du_film_edition_projections':
                $pageType = MdfContentTemplate::TYPE_EDITION_PROJECTIONS;
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

        return $this->render('FDCMarcheDuFilmBundle:contentTemplate:editionPresentation.html.twig', array(
            'titleHeader' => $titleHeader,
            'widgets' => $widgets
        ));
    }
}
