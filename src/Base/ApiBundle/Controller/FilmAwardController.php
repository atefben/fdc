<?php

namespace Base\ApiBundle\Controller;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;

/**
 * FilmAwardController class.
 * 
 * \@extends FOSRestController
 */
class FilmAwardController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmAward';

    /**
     * Return an array of awards, can be filtered with page / offset parameters
     *
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
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @return View
     */
    public function getAwardsAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // parameters
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        // create query
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository($this->repository)->getApiAwards($festival);

        // get items
        $items = $coreManager->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('award_list', 'time');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($coreManager->getLocale()));

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    
    /**
     * Return a single award by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get an award by $id",
     *  section="Awards",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The award identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmAward",
     *      "groups"={"award_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @return View
     */
    public function getAwardAction(Paramfetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // parameters
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        
        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository($this->repository)->getApiAward($id, $festival);

        // set context view
        $groups = array('award_show', 'time');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);

        // create view
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}