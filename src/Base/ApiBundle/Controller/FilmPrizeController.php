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
 * FilmPrizeController class.
 * 
 * \@extends FOSRestController
 */
class FilmPrizeController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmPrize';
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
     *      "class"="Base\CoreBundle\Entity\FilmPrize",
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
        // create query
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT fp FROM {$this->repository} fp";
        $query = $em->createQuery($dql);

        // get items
        $items = $this->get('Base.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('prize_list', 'time');
        $context = $this->get('Base.api.core_manager')->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
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
     *      "class"="Base\CoreBundle\Entity\FilmPrize",
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

        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('prize_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}