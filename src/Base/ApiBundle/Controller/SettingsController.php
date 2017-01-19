<?php

namespace Base\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SearchController
 * @package Base\ApiBundle\Controller
 */
class SettingsController extends FOSRestController
{
    /**
     * Get version settings
     * @Rest\Route("/settings/version")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   section="Settings",
     *   description = "Get API version settings"
     * )
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function versionAction(Request $request, ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $data = array(
            'iosVersion'     => $this->get('base.variable')->get('iosVersion'),
            'androidVersion' => $this->get('base.variable')->get('androidVersion'),
        );

        //set context view
        $view = $this->view($data, 200);

        return $view;
    }

    /**
     * Get countdown settings
     * @Rest\Route("/settings/countdown")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   section="Settings",
     *   description = "Get API countdown settings"
     * )
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return View
     */

    public function countdownAction(Request $request, ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $data = array(
            'countdown'     => $this->get('base.variable')->get('countdown'),
            'countdownTime' => $this->get('base.variable')->get('countdownTime'),
        );

        //set context view
        $view = $this->view($data, 200);

        return $view;
    }

    /**
     * Get redirect settings
     * @Rest\Route("/settings/redirect")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   section="Settings",
     *   description = "Get API redirect settings"
     * )
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function redirectAction(Request $request, ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $data = array(
            'mobileRedirect'    => $this->get('base.variable')->get('mobileRedirect'),
            'mobileRedirectUrl' => $this->get('base.variable')->get('mobileRedirectUrl'),
        );

        //set context view
        $view = $this->view($data, 200);

        return $view;
    }
}