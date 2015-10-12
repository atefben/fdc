<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * FilmAtelierController class.
 *
 * \@extends FOSRestController
 */
class FilmAtelierController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmAtelier';

    /**
     * Return an array of films atelier, can be filtered with page / offset parameters
     *
     * @Rest\Get("/films_atelier")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all films ateliers",
     *   section="Films Atelier",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmAtelier",
     *      "groups"={"film_list"}
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
    public function getFilmsAtelierAction(Paramfetcher $paramFetcher)
    {
        // get festival
        $festival = $this->get('base.api.core_manager')->getFestivalSettings($paramFetcher->get('festival_id'));
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
        $items = $this->get('base.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('film_atelier_list', 'time');
        $context = $this->get('base.api.core_manager')->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return a single film atelier by $id
     *
     * @Rest\Get("/film_atelier/{id}")
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a film atelier by $id",
     *  section="Films",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film atelier is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The film atelier identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmAtelier",
     *      "groups"={"film_atelier_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @return View
     */
    public function getFilmAtelierAction(Paramfetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('film_atelier_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($film, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}