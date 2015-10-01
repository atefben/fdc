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
 * FilmController class.
 * 
 * \@extends FOSRestController
 */
class FilmController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmFilm';

    /**
     * Return an array of films, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all films",
     *   section="Films",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmFilm",
     *      "groups"={"film_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     * @Rest\QueryParam(name="selection_id", description="The festival year")
     *
     * @return View
     */
    public function getFilmsAction(Paramfetcher $paramFetcher)
    {
        // parameters
        $selection = $paramFetcher->get('selection_id');

        // get festival
        $festival = $this->get('base.api.core_manager')->getFestivalSettings($paramFetcher->get('festival_id'));
        if ($festival === null) {
            return $this->view(array(), 404);
        }

        // create query
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT ff FROM {$this->repository} ff WHERE ff.festival = :festival";
        // if selection is defined, add it to the query
        if ($selection !== null) {
            $dql .= ' AND ff.selection = :selection';
        }

        $query = $em
            ->createQuery($dql)
            ->setParameter('festival', $festival->getId());
        // if selection is defined, add it to the query
        if ($selection !== null) {
            $query = $query->setParameter('selection', $selection);
        }

        // get items
        $items = $this->get('base.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('film_list', 'time');
        $context = $this->get('base.api.core_manager')->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return a single film by $id, the id format is xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a film by $id",
     *  section="Films",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The film identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmFilm",
     *      "groups"={"film_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @return View
     */
    public function getFilmAction(Paramfetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('film_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($film, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}