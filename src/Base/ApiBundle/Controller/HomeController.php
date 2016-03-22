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
class HomeController extends FOSRestController
{

    private $repository = 'BaseCoreBundle:Homepage';

    /**
     * Return the homepage,
     *
     * @Rest\Get("/home")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get the homepage",
     *   section="Events",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\Homepage",
     *      "groups"={"home"}
     *  }
     * )
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     * @throws \Exception
     */
    public function getHomeAction(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        $event = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository($this->repository)
            ->find($this->getParameter('admin_homepage_id'))
        ;

        // set context view
        $groups = array('home');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($event, $event ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }

}