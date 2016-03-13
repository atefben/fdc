<?php

namespace Base\ApiBundle\Controller;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;
use Base\CoreBundle\Entity\FilmFilm;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use FOS\RestBundle\View\View;
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
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     * @Rest\QueryParam(name="selection_id", description="The selection identifier")
     *
     * @param  Paramfetcher $paramFetcher
     *
     * @return View
     */
    public function getFilmsAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // parameters
        $selection = $paramFetcher->get('selection_id');
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // create query
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository($this->repository)->getApiFilms($festival, $selection);

        // get items
        $items = $coreManager->getPaginationItems($query, $paramFetcher);
		
        // set context view
        $groups = array('film_list');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));

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
     *      "groups"={"film_show", "time"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @return View
     */
    public function getFilmAction(Paramfetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager =  $this->get('base.api.core_manager');

        // parameters
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // create query
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository($this->repository)->getApiFilm($id, $festival);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('film_show', 'time'));
        $context->setVersion($version);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));

        // create view
        $view = $this->view($film, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}
