<?php

namespace Base\ApiBundle\Controller;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;
use \DateTime;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * WebTVController class.
 *
 * \@extends FOSRestController
 *
 */
class WebTvController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:WebTv';
    /**
     * Return an array of web tvs, can be filtered with page / offset parameters
     *
     * @Rest\Get("/web_tvs")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get web tvs",
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
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @return View
     */
    public function getWebTvsAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository($this->repository)->getApiWebTvs($festival, new DateTime(), $lang);

        // get items
        $items = $coreManager->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('web_tv_list', 'time');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return a single web tv by $id
     *
     * @Rest\Get("/web_tv/{id}")
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a web tv by id",
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
     *      "class"="Base\CoreBundle\Entity\WebTv",
     *      "groups"={"web_tv_show", "time"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @return View
     */
    public function getWebTvAction(Paramfetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->repository)->getApiWebTv($id, $festival, new DateTime(), $lang);

        // set context view
        $groups = array('web_tv_list', 'time');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $statusCode = ($entity !== null) ? 200 : 204;
        $view = $this->view($entity, $statusCode);
        $view->setSerializationContext($context);

        return $view;
    }

}