<?php

namespace FDC\ApiBundle\Controller;

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
     *      "class"="FDC\CoreBundle\Entity\FilmJury",
     *      "groups"={"jury_list"}
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
    public function getJuriesAction(Paramfetcher $paramFetcher)
    {
        // get festival
        $festival = $this->get('fdc.api.core_manager')->getFestivalParameter($paramFetcher->get('festival_id'));
        if ($festival === null) {
            return $this->view(array(), 404);
        }

        // create query
        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT fj FROM FDCCoreBundle:FilmJury fj WHERE fj.festival = :festival';
        $query = $em
            ->createQuery($dql)
            ->setParameter('festival', $festival->getId());
        
        // get items
        $items = $this->get('fdc.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('jury_list', 'time');
        $context = $this->get('fdc.api.core_manager')->setContext($groups, $paramFetcher);
        
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
     *      "class"="FDC\CoreBundle\Entity\FilmJury",
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
        $projection = $em->getRepository('FDCCoreBundle:FilmAward')->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('jury_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}