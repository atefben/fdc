<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * EventController class.
 *
 * \@extends FOSRestController
 */
class TodayImagesController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:MediaImage';

    /**
     * Return an array of events, can be filtered with page / offset parameters
     *
     * @Rest\Get("images-of-the-day")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all images of the day",
     *   section="Events",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\MediaImage",
     *      "groups"={"today_image"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getTodayImagesAction(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();


        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository($this->repository)
            ->getApiTodayImages($festival, $paramFetcher->get('lang'))
        ;


        // set context view
        $groups = array('today_images');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}