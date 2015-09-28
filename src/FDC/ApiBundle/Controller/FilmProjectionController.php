<?php

namespace FDC\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
/**
 * FilmProjectionController class.
 * 
 * \@extends FOSRestController
 */
class FilmProjectionController extends FOSRestController
{
    /**
     * Return an array of projections, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all projections",
     *   section="Projections",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="FDC\CoreBundle\Entity\FilmProjection",
     *      "groups"={"projection_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @return View
     */
    public function getProjectionsAction(Paramfetcher $paramFetcher)
    {
        // get parameters
        $offset = ($paramFetcher->get('offset') !== null) ? (int)$paramFetcher->get('offset') : $this->container->getParameter('api_page_offset');
        $offset = ($offset <= 10) ? $offset : 10;
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $page = ($paramFetcher->get('page') !== null) ? (int)$paramFetcher->get('page') : 1;

        // create query
        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT fp FROM FDCCoreBundle:FilmProjection fp';
        $query = $em->createQuery($dql);
        
        // create pagination
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page,
            $offset
        );

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('film_list', 'time'));
        $context->setVersion($version);
        $view = $this->view($pagination->getItems(), 200);  
        $view->setSerializationContext($context);
         
        return $view;
    }

    
    /**
     * Return a single projection by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a projection by $id",
     *  section="Projections",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The projection identifier"
     *      }
     *  },
     *  output={
     *      "class"="FDC\CoreBundle\Entity\FilmProjection",
     *      "groups"={"projection_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @return View
     */
    public function getProjectionAction(Paramfetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $em = $this->getDoctrine()->getManager();
        
        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository('FDCCoreBundle:FilmProjection')->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('projection_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}