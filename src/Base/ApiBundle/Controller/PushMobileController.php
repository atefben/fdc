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
     *   description = "add push",
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
     * @Rest\QueryParam(name="lang", nullable=false, description="The lang of the device")
     * @Rest\QueryParam(name="enable", default="1", description="Enable or disable the ")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function postPushMobileAction(ParamFetcher $paramFetcher)
    {
        $view = View::create();

        $uuid = $paramFetcher->get('uuid');
        $os = $paramFetcher->get('os');
        $lang = $paramFetcher->get('lang');
        $enable = $paramFetcher->get('enable');

        if ($uuid && $os && $lang) {
            if ($enable) {
                $this->createPushMobile($uuid, $os, $lang);
            }
            else {
                $this->deletePushMobile($uuid, $os, $lang);;
            }
            $view->setStatusCode(200)->setData(true);
        } else {
            $view->setStatusCode(422)->setData(false);
        }
        return $view;
    }


    protected function createPushMobile($uuid, $os, $lang)
    {
        $pushMobile = $this
            ->get('doctrine')
            ->getManager()
            ->getRepository('BaseCoreBundle:PushMobile')
            ->findOneBy(array(
                'uuid' => $uuid,
                'os'   => $os,
                'lang' => $lang,
            ))
        ;

        if (!$pushMobile) {
            $pushMobile = new PushMobile();
            $pushMobile
                ->setUuid($uuid)
                ->setOs($os)
                ->setLang($lang)
            ;
            $this->getDoctrine()->getManager()->persist($pushMobile);
            $this->getDoctrine()->getManager()->flush();
        }

        return $pushMobile;
    }



    protected function deletePushMobile($uuid, $os, $lang)
    {
        $pushMobile = $this
            ->get('doctrine')
            ->getManager()
            ->getRepository('BaseCoreBundle:PushMobile')
            ->findOneBy(array(
                'uuid' => $uuid,
                'os'   => $os,
                'lang' => $lang,
            ))
        ;

        if ($pushMobile) {
            $this->getDoctrine()->getManager()->remove($pushMobile);
            $this->getDoctrine()->getManager()->flush();
        }

        return true;
    }
}