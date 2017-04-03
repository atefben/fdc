<?php

namespace Base\ApiBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * FilmProjectionController class.
 *
 * \@extends FOSRestController
 */
class FilmProjectionController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmProjection';

    /**
     * Return an array of projections, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all projections",
     *   section="Projections",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmProjection",
     *      "groups"={"projection_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="time", description="Timestamp of the day")
     * @Rest\QueryParam(name="film_id", description="The film id")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getProjectionsAction(ParamFetcher $paramFetcher)
    {
        // core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();


        $time = $paramFetcher->get('time') ? $paramFetcher->get('time') : time();
        $filmId = $paramFetcher->get('film_id') ? $paramFetcher->get('film_id') : null;
        $rooms = $this
            ->getDoctrine()
            ->getRepository('BaseCoreBundle:FilmProjectionRoom')
            ->getApiRooms($festival, $time, $filmId)
            ->getQuery()
            ->getResult()
        ;

        $date = new \DateTime();
        $date->setTimestamp($time);
        if ($festival->getFestivalEndsAt() < $date) {
            $date = $festival->getFestivalEndsAt();
        }

        foreach ($rooms as $key => $room) {
            $ac = new ArrayCollection();
            $temp = [];

            foreach ($room->getProjections() as $projection) {
                if ($projection->getProgrammationFilms()->count()) {
                    if ($projection->getProgrammationSection() != 'Cinéfondation' && $projection->getProgrammationSection() != 'En Compétition - Courts métrages') {
                        if ($projection->isProjectionOfTheDay($date)) {
                            if ((int)$projection->getStartsAt()->format('H') < 4) {
                                $tomorrow = clone $projection->getStartsAt();
                                $tomorrow->add(date_interval_create_from_date_string('1 day'));
                                $keyDay = $tomorrow->getTimestamp() . '-' . $projection->getId();
                            } else {
                                $keyDay = $projection->getStartsAt()->getTimestamp() . '-' . $projection->getId();
                            }
                            $temp[$keyDay] = $projection;
                        }
                    }
                }
            }
            ksort($temp);
            foreach ($temp as $tempItem) {
                $ac->add($tempItem);
            }
            $rooms[$key]->setProjections($ac);
        }


        $groups = ['projection_list'];
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($rooms, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return an array of projections, can be filtered with page / offset parameters
     *
     * @Rest\Get("/projections-2017")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all projections",
     *   section="Projections",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmProjection",
     *      "groups"={"projection_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="time", description="Timestamp of the day")
     * @Rest\QueryParam(name="film_id", description="The film id")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getProjections2017Action(ParamFetcher $paramFetcher)
    {
        // core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();


        $time = $paramFetcher->get('time') ? $paramFetcher->get('time') : time();
        $filmId = $paramFetcher->get('film_id') ? $paramFetcher->get('film_id') : null;
        $rooms = $this
            ->getDoctrine()
            ->getRepository('BaseCoreBundle:FilmProjectionRoom')
            ->getApiRooms($festival, $time, $filmId)
            ->getQuery()
            ->getResult()
        ;

        $date = new \DateTime();
        $date->setTimestamp($time);
        if ($festival->getFestivalEndsAt() < $date) {
            $date = $festival->getFestivalEndsAt();
        }

        foreach ($rooms as $key => $room) {
            $ac = new ArrayCollection();
            $temp = [];

            foreach ($room->getProjections() as $projection) {
                if ($projection->getProgrammationFilms()->count()) {
                    if ($projection->isProjectionOfTheDay($date)) {
                        if ((int)$projection->getStartsAt()->format('H') < 4) {
                            $tomorrow = clone $projection->getStartsAt();
                            $tomorrow->add(date_interval_create_from_date_string('1 day'));
                            $keyDay = $tomorrow->getTimestamp() . '-' . $projection->getId();
                        } else {
                            $keyDay = $projection->getStartsAt()->getTimestamp() . '-' . $projection->getId();
                        }
                        $temp[$keyDay] = $projection;
                    }
                }
            }
            ksort($temp);
            foreach ($temp as $tempItem) {
                $ac->add($tempItem);
            }
            $rooms[$key]->setProjections($ac);
        }


        $groups = ['projection_list'];
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($rooms, 200);
        $view->setSerializationContext($context);

        return $view;
    }


    /**
     * Return a single projection by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a projection by $id",
     *  section="Projections",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The projection identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmProjection",
     *      "groups"={"projection_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getProjectionAction(ParamFetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(['projection_show']);
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}