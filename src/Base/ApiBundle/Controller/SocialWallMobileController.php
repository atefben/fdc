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
class SocialWallMobileController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:SocialWall';

    /**
     * Get all socialwall datas enabled for mobile
     *
     * @Rest\Get("/social_wall/mobile")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all SocialWall informations for Mobile",
     *   section="SocialWall",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\SocialWall",
     *      "groups"={"social_wall_list","time"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @return View
     */
    public function getSocialWallMobileAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        //create query
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository($this->repository)->findBy(array(
            'festival' => $festival,
            'enabledMobile' => true
        ),
            array('date' => 'ASC'),
            null,
            null);

        // get items, passing options to fix Cannot count query which selects two FROM components, cannot make distinction

        $items = $coreManager->getPaginationItems($query, $paramFetcher, array('distinct' => false));

        // set context view
        $groups = array('social_wall_list', 'time');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }
}