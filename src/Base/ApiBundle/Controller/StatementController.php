<?php

namespace Base\ApiBundle\Controller;

use \DateTime;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * StatementController class.
 *
 * \@extends FOSRestController
 */
class StatementController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:Statement';
    /**
     * Return an array of statement, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all statement",
     *   section="Statement",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\Statement",
     *      "groups"={"statement_list"}
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
    public function getStatementsAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        //create query
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository($this->repository)->getStatement($festival, new DateTime(), $lang);

        // get items, passing options to fix Cannot count query which selects two FROM components, cannot make distinction
        //
        $items = $coreManager->getPaginationItems($query, $paramFetcher, array('distinct' => false));

        // set context view
        $groups = array('statement_list');
        $context = $coreManager->setContext($groups, $paramFetcher);
        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }


    /**
     * Return a single statement by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a statement by $id",
     *  section="Statement",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no statement is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The statement identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\Statement",
     *      "groups"={"statement_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @return View
     */
    public function getStatementAction(Paramfetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository($this->repository)->getStatementById($id, $festival, new DateTime(), $lang);

        // set context view
        $groups = array('statement_show');
        $context = $coreManager->setContext($groups, $paramFetcher);
        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}