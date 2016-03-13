<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

use FOS\RestBundle\View\View;
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
     *      "groups"={"event_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getEventsAction(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();


        $queryBuilder = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Event')
            ->getApiEvents($festival, $paramFetcher->get('lang'))
        ;

        // get items
        $items = $coreManager->getPaginationItems($queryBuilder, $paramFetcher);

        // set context view
        $groups = array('event_list');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}