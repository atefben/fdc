<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\Statement;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * EventController class.
 *
 * \@extends FOSRestController
 */
class HomeController extends FOSRestController
{

    /**
     * Return the homepage,
     *
     * @Rest\Get("/home")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get the homepage",
     *   section="Events",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\Homepage",
     *      "groups"={"home"}
     *  }
     * )
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", default="fr", description="The lang")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     * @throws \Exception
     */
    public function getHomeAction(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        $locale = $paramFetcher->get('lang');
        $festival = $coreManager->getApiFestivalYear()->getId();

        $output = array();
        $news = $this->getNews($festival, $locale);
        $infos = $this->getInfos($festival, $locale);
        $statements = $this->getStatements($festival, $locale);

        $output['news'] = array_merge($news, $infos, $statements);
        krsort($output['news']);

        $output['news'] = array_slice(array_values($output['news']), 0, 3);


        $output['next_projections'] = $this->getNextProjections($festival);

        // set context view
        $groups = array('home');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($output, $output ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }

    protected function getNews($festival, $locale)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->getApiLastsNews($locale, $festival, new \DateTime(), 3)
        ;

        $news = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId();
            $news[$key] = $item;
        }
        return $news;
    }

    protected function getInfos($festival, $locale)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Info')
            ->getLastInfos($festival, null, $locale, 3)
        ;

        $infos = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId();
            $infos[$key] = $item;
        }
        return $infos;
    }

    protected function getStatements($festival, $locale)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getLastStatements($festival, new \DateTime(), $locale, 3)
        ;

        $statements = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId();
            $statements[$key] = $item;
        }

        return $statements;
    }

    public function getNextProjections($festival)
    {
        return $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmProjection')
            ->getApiNextProjections($festival, 3)
            ;
    }

}