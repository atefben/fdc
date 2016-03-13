<?php

namespace Base\ApiBundle\Controller;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;

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
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     * @Rest\QueryParam(name="type_id", description="The type id")
     *
     * @return View
     */
    public function getJuriesAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // parameters
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $type = $paramFetcher->get('type_id');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository($this->repository)->getApiJuries($festival, $type);

        // get items
        $items = $coreManager->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('jury_list');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));

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
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @return View
     */
    public function getJuryAction(Paramfetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // parameters
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();

        $projection = $em->getRepository($this->repository)->getApiJury($id, $festival);

        // set context view
        $groups = array('jury_show');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));

        // create view
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}