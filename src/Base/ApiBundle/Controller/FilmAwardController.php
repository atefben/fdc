<?php

namespace Base\ApiBundle\Controller;

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
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     *
     * @return View
     */
    public function getAwardsAction(Paramfetcher $paramFetcher)
    {
        // get festival
        $festival = $this->get('Base.api.core_manager')->getFestivalSettings($paramFetcher->get('festival_id'));
        if ($festival === null) {
            return $this->view(array(), 404);
        }

        // create query
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT fa FROM {$this->repository} fa WHERE fa.festival = :festival";
        $query = $em
            ->createQuery($dql)
            ->setParameter('festival', $festival->getId());

        // get items
        $items = $this->get('Base.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('award_list', 'time');
        $context = $this->get('Base.api.core_manager')->setContext($groups, $paramFetcher);

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
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $em = $this->getDoctrine()->getManager();
        
        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('award_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}