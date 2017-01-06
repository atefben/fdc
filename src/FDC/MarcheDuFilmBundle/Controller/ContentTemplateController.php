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
     * @Route("quisommesnous/chiffrescles", name="fdc_marche_du_film_who_are_we_key_figures")
     * @Route("quisommesnous/demarchesenvironnementales", name="fdc_marche_du_film_who_are_we_environmental_approaches")
     * @Route("mentionslegales", name="fdc_marche_du_film_legal_mentions")
     * @Route("generalconditions", name="fdc_marche_du_film_general_conditions")
     */
    public function indexAction()
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');

        $request = $this->container->get('request');
        $routeName = $request->get('_route');

        return $this->render('FDCMarcheDuFilmBundle:contentTemplate:contentTemplate.html.twig', $contentTemplateManager->getPageData($routeName));
    }

    /**
     * @Route("actualite/{slug}", name="fdc_marche_du_film_news_details")
     */
    public function newsAction($slug)
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $pageType = MdfContentTemplate::TYPE_NEWS_DETAILS;
        $titleHeader = $contentTemplateManager->getTitleHeaderContentBySlug($pageType, $slug);

        if (empty($titleHeader))
            throw $this->createNotFoundException('Empty content');

        $pageId = $titleHeader->getTranslatable()->getId();

        $textWidgets = $contentTemplateManager->getContentTemplateTextWidgetsByPageId($pageId);
        $imageWidgets = $contentTemplateManager->getContentTemplateImageWidgetsByPageId($pageId);
        $galleryWidgets = $contentTemplateManager->getContentTemplateGalleryWidgetsByPageId($pageId);
        $fileWidgets = $contentTemplateManager->getContentTemplateFileWidgetsByPageId($pageId);

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
            'isWhoAreWe' => false
        ));
    }
}
