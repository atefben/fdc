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
class OrangeSeriesAndCieController extends FOSRestController
{

    /**
     * Return the orange series and cie object
     * @Rest\Route("/orange-series-and-cie")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get the orange series and cie object",
     *   section="Orange",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\OrangeSeriesAndCie",
     *      "groups"={"orange_series_and_cie"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getOrangeSeriesAndCieAction(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        $item = $this
            ->getDoctrine()
            ->getRepository('BaseCoreBundle:OrangeSeriesAndCie')
            ->find($this->getParameter('admin_fdc_orange_series_id'))
        ;

        // set context view
        $groups = array('orange_series_and_cie');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($item, $item ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }

}