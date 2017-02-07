<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidget;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetFile;
use FDC\MarcheDuFilmBundle\Entity\MdfSitePlanTranslation;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfImage;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="fdc_marche_du_film_search")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $searchTerm = $request->query->get('term');
        $locale = $request->getLocale();
        $items = array(
            'contentResults' => array(),
            'mediaResults' => array(),
            'documentResults' => array(),
        );
        
        /** FOS\ElasticaBundle\Manager\RepositoryManager */
        $repositoryManager = $this->container->get('fos_elastica.manager');

        if ($searchTerm) {
            $items['contentResults'] = $repositoryManager
                    ->getRepository(MdfContentTemplate::class)
                    ->findWithCustomQuery($locale, $searchTerm);
                    
            $items['documentResults'] = $repositoryManager
                    ->getRepository(MdfContentTemplateWidgetFile::class)
                    ->findWithCustomQuery($locale, $searchTerm);
                    
            $items['mediaResults'] = $repositoryManager
                    ->getRepository(MdfContentTemplateWidget::class)
                    ->findWithCustomQuery($locale, $searchTerm);
        }

        return $this->render('FDCMarcheDuFilmBundle::search/index.html.twig', array(
            'searchTerm' => $searchTerm,
            'items' => $items,
        ));
    }
    
    /**
     * @Route("/get-media-source/{type}/{id}", name="fdc_marche_du_film_get_media_source")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMediaSourceAction($type, $id, Request $request)
    {
        $locale = $request->getLocale();
        $args = array();
        
        //get pages of type MdfContentTemplate containing media $id of type $type
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contentTemplates = $contentTemplateManager->findContentTemplateByWidget($locale, $type, $id);

        $route = 'fdc_marche_du_film_' . $contentTemplates[0]->getTranslatable()->getType();

        if ($contentTemplates[0]->getTranslatable()->getType() == MdfContentTemplate::TYPE_NEWS_DETAILS) {
            $args = array('slug' => $contentTemplates[0]->getSlug());
        }
        
        //TO DO: get pages of type ...other containing media $id of type $type
        
        return $this->redirectToRoute($route, $args, 301);
    }
}
