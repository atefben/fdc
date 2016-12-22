<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContentTemplateController extends Controller
{
    /**
     * @Route("presentation", name="fdc_marche_du_film_presentation")
     */
    public function indexAction()
    {
        $contentTemplateManager = $this->get('mdf.manager.content_template');

        $titleHeader = $contentTemplateManager->getTitleHeaderContent(MdfContentTemplate::TYPE_EDITION_PRESENTATION);
        $textWidgets = $contentTemplateManager->getContentTemplateTextWidgets(MdfContentTemplate::TYPE_EDITION_PRESENTATION);

        $widgets = [];
        $widgets = array_merge($widgets, $textWidgets);

        return $this->render('FDCMarcheDuFilmBundle:contentTemplate:editionPresentation.html.twig', array(
            'titleHeader' => $titleHeader,
            'widgets' => $widgets
        ));
    }
}
