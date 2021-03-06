<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\FilmProjection;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * EventController class.
 * \@extends FOSRestController
 */
class HomeController extends FOSRestController
{

    /**
     * Return the homepage,
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

        $limitDate = new \DateTime();
        $limitDate->setDate(2016, 9, 30);
        $limitDate->setTime(23, 59, 59);

        $output = array();
        $news = $this->getNews($festival, $locale, $limitDate);
        $infos = $this->getInfos($festival, $locale, $limitDate);
        $statements = $this->getStatements($festival, $locale, $limitDate);

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

    /**
     * Return the homepage,
     * @Rest\Get("/home-2017")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get the homepage 2017",
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
     * @Rest\QueryParam(name="orange", default="0", description="Get also Orange news")
     * @param ParamFetcher $paramFetcher
     * @return View
     * @throws \Exception
     */
    public function getHome2017Action(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        $locale = $paramFetcher->get('lang');
        $orange = (int)$paramFetcher->get('orange');
        $festival = $coreManager->getApiFestivalYear()->getId();

        $since = new \DateTime();
        $since->setDate(2016, 1, 1);
        $since->setTime(0, 0, 0);

        $limitDate = new \DateTime();
        $limitDate->setDate(2016, 10, 1);
        $limitDate->setTime(0, 0, 0);

        $output = array();
        $news = $this->getNews2017($festival, $locale, $since, null, null, $limitDate, $orange);
        $infos = $this->getInfos2017($festival, $locale, $since, null, null, $limitDate, $orange);
        $statements = $this->getStatements2017($festival, $locale, $since, null, null, $limitDate, $orange);

        $output['news'] = array_merge($news, $infos, $statements);
        krsort($output['news']);
        $output['news'] = array_values($output['news']);

        // set context view
        $groups = array('home');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($output, $output ? 200 : 204);
        $view->setSerializationContext($context);
        return $view;
    }

    protected function getNews($festival, $locale, \DateTime $limitDate)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->getApiLastsNews($locale, $festival, new \DateTime(), 3, $limitDate)
        ;

        $news = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId();
            $news[$key] = $item;
        }
        return $news;
    }

    protected function getNews2017($festival, $locale, $since, $page, $count, \DateTime $limitDate, $orange = false)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->getApiNewsHome2017($locale, $festival, $since, $page, $count, $limitDate, $orange)
        ;

        $news = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId() . '-3';
            $news[$key] = $item;
        }
        return $news;
    }

    protected function getInfos($festival, $locale, \DateTime $limitDate)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Info')
            ->getApiLastInfos($festival, new \DateTime(), $locale, 3, $limitDate)
        ;

        $infos = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId();
            $infos[$key] = $item;
        }
        return $infos;
    }

    protected function getInfos2017($festival, $locale, $since, $page, $count, \DateTime $limitDate, $orange = false)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Info')
            ->getApiInfoHome2017($locale, $festival, $since, $page, $count, $limitDate, $orange)
        ;

        $infos = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId() . '-2';
            $infos[$key] = $item;
        }
        return $infos;
    }

    protected function getStatements($festival, $locale, \DateTime $limitDate)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getApiLastStatements($festival, new \DateTime(), $locale, 3, $limitDate)
        ;

        $statements = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId();
            $statements[$key] = $item;
        }

        return $statements;
    }

    protected function getStatements2017($festival, $locale, $since, $page, $count, \DateTime $limitDate, $orange = false)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getApiStatementHome2017($locale, $festival, $since, $page, $count, $limitDate, $orange)
        ;

        $statements = array();
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->format('Y-m-d-H-i-s') . '-' . $item->getId() . '-1';
            $statements[$key] = $item;
        }

        return $statements;
    }

    public function getNextProjections($festival)
    {
        $coreManager = $this->get('base.api.core_manager');
        $festival = $coreManager->getApiFestivalYear();

        $now = new \DateTime();
        if ($festival->getFestivalEndsAt() < $now) {
            $now = $festival->getFestivalEndsAt();
        }

        $results = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmProjection')
            ->getNewsApiProjections($festival, $now)
        ;

        $projections = array();
        $exclude = array('Séance de presse', 'Conférence de presse');
        foreach ($results as $projection) {

            if ($projection->getProgrammationSection() != 'Cinéfondation' && $projection->getProgrammationSection() != 'En Compétition - Courts métrages') {
                if ($projection instanceof FilmProjection and (int)$projection->getStartsAt()->format('H') < 4) {
                    $tomorrow = clone $projection->getStartsAt();
                    $tomorrow->add(date_interval_create_from_date_string('1 day'));
                    $key = $tomorrow->getTimestamp();
                } else {
                    $key = $projection->getStartsAt()->getTimestamp();
                }
                if (!in_array($projection->getType(), $exclude)) {
                    if ($key > $now->getTimestamp()) {
                        $projections[$key . '-' . $projection->getId()] = $projection;
                    }
                }
            }
        }
        ksort($projections);
        return array_slice(array_values($projections), 0, 3);
    }

}