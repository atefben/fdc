<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\SocialWall;
use \DateTime;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use FOS\RestBundle\View\View;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * NewsController class.
 *
 * \@extends FOSRestController
 */
class SocialWallController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:SocialWall';

    /**
     * Get all socialwall datas enabled for mobile
     *
     * @Rest\Get("/socialwall")
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
     *      "groups"={"social_wall_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="time", description="The day timestamp")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @param  ParamFetcher $paramFetcher
     * @return View
     */
    public function getSocialWallAction(ParamFetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $page = $paramFetcher->get('time');
        $offset = $paramFetcher->get('offset');

        $dateTime = new \DateTime();
        if ($paramFetcher->get('time')) {
            $dateTime->setTimestamp($paramFetcher->get('time'));
        }

        //create query
        $queryBuilder = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:SocialWall')
            ->getApiSocialWall($festival, $dateTime, true, $offset, $page)
        ;

        // get items
        $items = $coreManager->getPaginationItems($queryBuilder, $paramFetcher);

        // set context view
        $groups = array('social_wall_list');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);

        // create view
        $view = $this->view($this->buildDays($items), $items ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }


    protected function buildDays($items)
    {
        $days = array();
        foreach ($items as $item) {
            $dayKey = $item->getDate()->format("Y-m-d");
            if (!array_key_exists($dayKey, $days)) {
                $dateTime = $item->getDate();
                $dayTime = clone $dateTime;
                $days[$dayKey] = array(
                    'date'  => $dayTime,
                    'items' => array(),
                );
            }
            $itemKey = $item->getDate()->format('Y-m-d-H-i-s-') . $item->getId() . '-' . strtolower(get_class($item));
            $days[$dayKey]['items'][$itemKey] = $item;
        }

        foreach ($days as $key => $value) {
            krsort($days[$key]['items']);
            $days[$key]['items'] = array_values($days[$key]['items']);
        }
        ksort($days);
        return array_values($days);
    }
}