<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * EventController class.
 *
 * \@extends FOSRestController
 */
class EventController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:Event';
    /**
     * Return an array of events, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all events",
     *   section="Events",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\Event",
     *      "groups"={"event_list", "time"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     *
     * @return View
     */
    public function getEventsAction(Paramfetcher $paramFetcher)
    {
        // get festival
        $festival = $this->get('base.api.core_manager')->getFestivalSettings($paramFetcher->get('festival_id'));
        if ($festival === null) {
            return $this->view(array(), 404);
        }

        // create query
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT e FROM {$this->repository} e WHERE e.festival = :festival";

        $query = $em->createQuery($dql)
            ->setParameter('festival', $festival);

        // get items
        $items = $this->get('base.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('event_list', 'time');
        $context = $this->get('base.api.core_manager')->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}