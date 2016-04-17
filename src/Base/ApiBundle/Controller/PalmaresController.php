<?php

namespace Base\ApiBundle\Controller;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use FOS\RestBundle\View\View;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;

/**
 * FilmAwardController class.
 *
 * \@extends FOSRestController
 */
class PalmaresController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmAward';

    /**
     * Return an array of awards, can be filtered with page / offset parameters
     *
     * @Rest\Get("/palmares")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all awards",
     *   section="Awards",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmAward",
     *      "groups"={"award_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @param  Paramfetcher $paramFetcher
     *
     * @return View
     */
    public function PalmaresAction(ParamFetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // parameters
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');


        $competition = $this->getCompetitionAwards($festival, $lang);
        $certainRegard = $this->getUnCertainRegard($festival, $lang);
        $cinefondation = $this->getCinefondationRegard($festival, $lang);
        $cameraDOr = $this->getCameraDOrRegard($festival, $lang);
        $items = array_merge($competition, $certainRegard, $cinefondation, $cameraDOr);

        // set context view
        $groups = array('award_list');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * @param $festival
     * @param $locale
     * @return \Base\CoreBundle\Entity\FDCPageAward
     */
    public function getCompetitionAwards($festival, $locale)
    {
        $page = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageAward')
            ->find($this->getParameter('admin_fdc_page_award_competition_id'))
        ;
        $awards = array();

        $selectionSectionId = $page->getSelectionLongsMetrages()->getId();
        $category = $page->getCategory();
        $name = $page->findTranslationByLocale($locale)->getNameLongsMetrages();
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($festival, $category, $selectionSectionId)
        ;

        $awards['competition_longs_metrages'] = array(
            'name'   => $name,
            'awards' => $items,
        );


        $selectionSectionId = $page->getSelectionCourtsMetrages()->getId();
        $category = $page->getCategory();
        $name = $page->findTranslationByLocale($locale)->getNameCourtsMetrages();
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($festival, $category, $selectionSectionId)
        ;

        $awards['competition_courts_metrages'] = array(
            'name'   => $name,
            'awards' => $items,
        );

        return $awards;
    }

    public function getUnCertainRegard($festival, $locale)
    {
        $page = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageAward')
            ->find($this->getParameter('admin_fdc_page_award_certain_regard_id'))
        ;

        $awards = array();

        $category = $page->getCategory();
        $name = $page->findTranslationByLocale($locale)->getName();

        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($festival, $category)
        ;

        $awards['un_certain_regard'] = array(
            'name'   => $name,
            'awards' => $items,
        );

        return $awards;
    }

    public function getCinefondationRegard($festival, $locale)
    {
        $page = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageAward')
            ->find($this->getParameter('admin_fdc_page_award_cinefondation_id'))
        ;

        $awards = array();

        $category = $page->getCategory();
        $name = $page->findTranslationByLocale($locale)->getName();

        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($festival, $category)
        ;

        $awards['cinefondation'] = array(
            'name'   => $name,
            'awards' => $items,
        );

        return $awards;
    }

    public function getCameraDOrRegard($festival, $locale)
    {
        $page = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageAward')
            ->find($this->getParameter('admin_fdc_page_award_camera_dor_id'))
        ;

        $awards = array();

        $category = $page->getCategory();
        $name = $page->findTranslationByLocale($locale)->getName();

        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getByCategoryWithAward($festival, $category)
        ;

        $selectionSectionIds = array(
            $page->getSelectionLongsMetrages()->getId(),
            $page->getSelectioncourtsMetrages()->getId(),
        );

        foreach ($page->getOtherSelectionSectionsAssociated() as $associated) {
            if ($associated->getAssociation()) {
                $competitionIds[] = $associated->getAssociation()->getId();
            }
        }

        $others = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmAwardAssociation')
            ->getCameraDOr($festival, $selectionSectionIds)
        ;

        $awards['camera_dor'] = array(
            'name'        => $name,
            'awards'      => $items,
            'competitors' => $others,
        );

        return $awards;
    }

}