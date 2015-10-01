<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use JMS\SecurityExtraBundle\Annotation\Secure;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;

/**
 * FilmJuryController class.
 * 
 * \@extends FOSRestController
 */
class FilmJuryController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmJury';
    /**
     * Return an array of juries, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all juries",
     *   section="Juries",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmJury",
     *      "groups"={"jury_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     * @Rest\QueryParam(name="type_id", description="The type id")
     *
     * @return View
     */
    public function getJuriesAction(Paramfetcher $paramFetcher)
    {
        // get festival
        $festival = $this->get('base.api.core_manager')->getFestivalSettings($paramFetcher->get('festival_id'));
        if ($festival === null) {
            return $this->view(array(), 404);
        }

        // create query
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT fj FROM {$this->repository} fj WHERE fj.festival = :festival";
        // if selection is defined, add it to the query
        if ($type !== null) {
            $dql .= ' AND fj.type = :type';
        }

        $query = $em
            ->createQuery($dql)
            ->setParameter('festival', $festival->getId());
        // if selection is defined, add it to the query
        if ($type !== null) {
            $query = $query->setParameter('type', $type);
        }
        
        // get items
        $items = $this->get('base.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('jury_list', 'time');
        $context = $this->get('base.api.core_manager')->setContext($groups, $paramFetcher);
        
        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

    
    /**
     * Return a single jury by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a jury by $id",
     *  section="Juries",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The jury identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmJury",
     *      "groups"={"jury_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @return View
     */
    public function getJuryAction(Paramfetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $em = $this->getDoctrine()->getManager();
        
        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('jury_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}