<?php

namespace Base\ApiBundle\Controller;

use \DateTime;

use Base\ApiBundle\Exclusion\StatusExclusionStrategy;
use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * NewsController class.
 *
 * \@extends FOSRestController
 */
class NewsController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:News';
    /**
     * Return an array of news, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all news",
     *   section="News",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\News",
     *      "groups"={"news_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @return View
     */
    public function getNewsAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        //create query
        $em = $this->getDoctrine()->getManager();
        $count = $em->getRepository('BaseCoreBundle:News')->getNewsCount($festival, new DateTime(), $coreManager->getLocale());
       // $query = $em->getRepository('BaseCoreBundle:News')->getNews($festival, new DateTime(), $coreManager->getLocale(), $count);

        $query = $em->createQuery('SELECT n FROM Base\CoreBundle\Entity\News n LEFT JOIN Base\CoreBundle\Entity\NewsArticle na WITH na.id = n.id')
            ->setHint('knp_paginator.count', $count);
        // get items
        $items = $coreManager->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('news_list', 'time');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->addExclusionStrategy(new StatusExclusionStrategy());
        $context->addExclusionStrategy(new TranslationExclusionStrategy($coreManager->getLocale()));
        $context->setVersion($version);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }


    /**
     * Return a single news by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a news by $id",
     *  section="News",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no news is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The news identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\News",
     *      "groups"={"news_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @return View
     */
    public function getNewAction(Paramfetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('news_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}