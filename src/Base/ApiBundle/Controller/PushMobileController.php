<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\PushMobile;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class PushMobileController
 * @package Base\ApiBundle\Controller
 */
class PushMobileController extends FOSRestController
{

    /**
     * Save a mobile push
     *
     * @Rest\Route("/pushmobile")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "pull",
     *   section="Push Mobile",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     422 = "Unprocessable"
     *   }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="uuid", nullable=false, description="The uuid of the device")
     * @Rest\QueryParam(name="os", nullable=false, description="The operating system of the device")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function postPushMobileAction(ParamFetcher $paramFetcher)
    {
        $view = View::create();

        $uuid = $paramFetcher->get('uuid');
        $os = $paramFetcher->get('os');

        if ($uuid && $os) {
            $this->createPushMobile($uuid, $os);
            $view->setStatusCode(200)->setData(true);
        }
        else {
            $view->setStatusCode(422)->setData(false);
        }
        return $view;
    }

    protected function createPushMobile($uuid, $os)
    {
        $pushMobile = $this
            ->get('doctrine')
            ->getManager()
            ->getRepository('BaseCoreBundle:PushMobile')
            ->findOneBy(array(
                'uuid' => $uuid,
                'os'   => $os,
            ))
        ;

        if (!$pushMobile) {
            $pushMobile = new PushMobile();
            $pushMobile
                ->setUuid($uuid)
                ->setOs($os)
            ;
            $this->getDoctrine()->getManager()->persist($pushMobile);
            $this->getDoctrine()->getManager()->flush();
        }

        return $pushMobile;
    }

}