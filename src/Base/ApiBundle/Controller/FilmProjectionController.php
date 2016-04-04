<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\FilmProjection;
use Base\CoreBundle\Entity\FilmProjectionRoom;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use FOS\RestBundle\View\View;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

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

//        foreach ($rooms as $key => $room) {
//            $ac = new ArrayCollection();
//            if ($room instanceof FilmProjectionRoom) {
//                foreach ($room->getProjections() as $projection) {
//                    if ($projection instanceof FilmProjection) {
//                        if ($projection->getStartsAt()->format('d-m-y') === $date->format('d-m-y')) {
//                            $ac->add($projection);
//                        }
//                    }
//                }
//            }
//            $rooms[$key]->setProjections($ac);
//        }
        $groups = array('projection_list');
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
     * @return View
     */
    public function getProjectionAction(Paramfetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        // create query
        $em = $this->getDoctrine()->getManager();
        $projection = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('projection_show'));
        $context->setVersion($version);
        $view = $this->view($projection, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}