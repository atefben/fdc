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
class OrangeProgrammationOCSController extends FOSRestController
{

    /**
     * Return the orange programmation OCS list
     * @Rest\Route("/orange-programmation-ocs")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get the orange programmation OCS list",
     *   section="Orange",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\OrangeProgrammationOCS",
     *      "groups"={"orange_programmation_ocs"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function listAction(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        $items = $this
            ->getDoctrine()
            ->getRepository('BaseCoreBundle:OrangeProgrammationOCS')
            ->findAll()
        ;

        // set context view
        $groups = array('orange_programmation_ocs');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, $items ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }

}