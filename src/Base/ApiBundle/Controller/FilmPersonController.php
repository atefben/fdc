<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
/**
 * FilmPersonController class.
 * 
 * \@extends FOSRestController
 */
class FilmPersonController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmPerson';
    /**
     * Return a single person by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a film by $id",
     *  section="People",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The person identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmPerson",
     *      "groups"={"person_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @return View
     */
    public function getPersonAction(Paramfetcher $paramFetcher, $id)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');

        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository($this->repository)->findOneById($id);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(array('person_show', 'time'));
        $context->setVersion($version);
        $view = $this->view($film, 200);
        $view->setSerializationContext($context);
         
        return $view;
    }

}