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
 * FilmPrizeController class.
 * 
 * \@extends FOSRestController
 */
class FilmPrizeController extends FOSRestController
{
    /**
     * Return an array of prizes, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all prizes",
     *   section="Prizes",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="FDC\CoreBundle\Entity\FilmPrize",
     *      "groups"={"prize_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @return View
     */
    public function getPrizesAction(Paramfetcher $paramFetcher)
    {
        // get parameters
        $offset = ($paramFetcher->get('offset') !== null) ? (int)$paramFetcher->get('offset') : $this->container->getParameter('api_page_offset');
        $offset = ($offset <= 10) ? $offset : 10;
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $page = ($paramFetcher->get('page') !== null) ? (int)$paramFetcher->get('page') : 1;

        // create query
        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT fp FROM FDCCoreBundle:FilmPrize fp';
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
     * Return a single prize by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a prize by $id",
     *  section="Prizes",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The prize identifier"
     *      }
     *  },
     *  output={
     *      "class"="FDC\CoreBundle\Entity\FilmPrize",
     *      "groups"={"prize_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @return View
     */
    public function getPrizeAction(Paramfetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $em = $this->getDoctrine()->getManager();
        
        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository('FDCCoreBundle:FilmPrize')->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('projection_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}