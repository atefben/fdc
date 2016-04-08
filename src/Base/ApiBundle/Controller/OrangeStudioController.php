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
class OrangeStudioController extends FOSRestController
{

    /**
     * Return the orange studio object
     * @Rest\Route("/orange-studio")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get the orange studio object",
     *   section="Orange",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\OrangeStudio",
     *      "groups"={"orange_studio"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getAction(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        $item = $this
            ->getDoctrine()
            ->getRepository('BaseCoreBundle:OrangeStudio')
            ->find($this->getParameter('admin_fdc_orange_studio_id'))
        ;

        // set context view
        $groups = array('orange_studio');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($item, $item ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }

}