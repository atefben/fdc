<?php

namespace Base\ApiBundle\Controller;

use \DateTime;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * FilmTrailerController class.
 *
 * \@extends FOSRestController
 */
class FilmTrailerController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmFilm';
    /**
     * Return an array of Films with trailers, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all film with trailers",
     *   section="Trailers",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\Film",
     *      "groups"={"trailer_list"}
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
    public function getFilmsTrailersAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository($this->repository)->getApiFilmTrailers($festival, $lang);

        // get items
        $items = $coreManager->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('trailer_list');
        $context = $coreManager->setContext($groups, $paramFetcher);
        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return trailers of a single film by $id, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get all trailers of a film by id",
     *  section="Trailers",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\d+]",
     *          "dataType"="string",
     *          "description"="The film identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\Film",
     *      "groups"={"trailer_show"}
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
    public function getFilmTrailersAction(Paramfetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->repository)->getApiTrailers($id, $festival, $lang);

        $groups = array('trailer_show');
        $context = $coreManager->setContext($groups, $paramFetcher);
        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $statusCode = ($entity !== null) ? 200 : 204;
        $view = $this->view($entity, $statusCode);
        $view->setSerializationContext($context);

        return $view;
    }

}