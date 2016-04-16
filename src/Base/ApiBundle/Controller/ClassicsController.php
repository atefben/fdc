<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class classicsController
 * @package Base\ApiBundle\Controller
 */
class ClassicsController extends FOSRestController
{

    /**
     * Return an array of events, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all classics",
     *   section="Classics",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics",
     *      "groups"={"classics"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getClassicsAction(ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival
        $festival = $coreManager->getApiFestivalYear();


        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository("BaseCoreBundle:FDCPageLaSelectionCannesClassics")
            ->getApiList($festival, $paramFetcher->get('lang'))
        ;

        // set context view
        $groups = array('classics');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, $items ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }

}