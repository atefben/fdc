<?php

namespace Base\ApiBundle\Controller;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;
use Base\ApiBundle\Component\FOSRestController;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use FOS\RestBundle\View\View;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * FilmSelectionController class.
 *
 * \@extends FOSRestController
 */
class FilmSelectionController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmSelection';

    /**
     * Return an array of film selections, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all selections",
     *   section="Film Selections",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmSelection",
     *      "groups"={"film_selection_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="film_id", description="The Film id")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @return View
     */
    public function getFilmSelectionsAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // create query
        $queryBuilder = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository($this->repository)
            ->getApiSelections($paramFetcher->get('film_id'))
        ;

        // get items
        $items = $coreManager->getPaginationItems($queryBuilder, $paramFetcher);

        // set context view
        $groups = array('film_selection_list');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}