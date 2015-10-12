<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * FilmTrailerController class.
 *
 * \@extends FOSRestController
 */
class FilmTrailerController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:Film';
    /**
     * Return an array of filmtrailers, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all film trailers",
     *   section="Trailers",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\Film",
     *      "groups"={"trailer_list", "time"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     * @Rest\QueryParam(name="festival_id", description="The festival year")

     * @return View
     */
    public function getTrailersAction(Paramfetcher $paramFetcher)
    {
        // create query
        $em = $this->getDoctrine()->getManager();

        // get current festival
        $settings = $em->getRepository('BaseCoreBundle:Settings')->getFestivalSettings();
        $festival = $em->getRepository('BaseCoreBundle:FilmFestival')->findOneByYear($settings->getYear());

        // create query
        // @TODO only where status is translated
        $dql = "SELECT wt FROM {$this->repository} wt JOIN wt.mediaVideos mv WHERE mv.festival = :festival";
        $query = $em
            ->createQuery($dql)
            ->setParameter('festival', $festival);

        // get items
        $items = $this->get('base.api.core_manager')->getPaginationItems($query, $paramFetcher);

        // set context view
        $groups = array('web_tv_list', 'time');
        $context = $this->get('base.api.core_manager')->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}