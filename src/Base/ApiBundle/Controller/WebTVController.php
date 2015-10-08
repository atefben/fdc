<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * WebTVController class.
 *
 * \@extends FOSRestController
 */
class WebTvController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:WebTv';
    /**
     * Return an array of web tvs, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all web tvs",
     *   section="Web Tvs",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\WebTv",
     *      "groups"={"web_tv_list", "time"}
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
    public function getWebTvsAction(Paramfetcher $paramFetcher)
    {
        // get festival
        $festival = $this->get('base.api.core_manager')->getFestivalSettings($paramFetcher->get('festival_id'));
        if ($festival === null) {
            return $this->view(array(), 404);
        }

        // create query
        $em = $this->getDoctrine()->getManager();
        // @TODO only where status is translated
        $dql = "SELECT wt FROM {$this->repository} wt JOIN wt.mediaVideos mv
          WHERE mv.festival = :festival AND mv.inWebTv = :inWebTv";

        $query = $em
            ->createQuery($dql)
            ->setParameter('festival', $festival)
            ->setParameter('inWebTv', true);

        // get items
        $items = $this->get('base.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('web_tv_list', 'time');
        $context = $this->get('base.api.core_manager')->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return a single web tv by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a web tv by $id",
     *  section="Web Tvs",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\d+]",
     *          "dataType"="string",
     *          "description"="The web tv identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmFilm",
     *      "groups"={"web_tv_show", "time"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     *
     * @return View
     */
    public function getWebTvAction($id)
    {
        // get festival
        $festival = $this->get('base.api.core_manager')->getFestivalSettings($paramFetcher->get('festival_id'));
        if ($festival === null) {
            return $this->view(array(), 404);
        }

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