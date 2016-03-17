<?php

namespace FDC\PressBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class SecurityController extends BaseController
{

    protected $currentRoute;

    /**
     * @param Request $originalRequest
     * @return RedirectResponse
     */
    public function setCurrentRouteAction(Request $originalRequest)
    {

        $this->setCurrentRoute($originalRequest->get('_route'));
        return $this->loginAction();

    }


    /**
     * @Route("/login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction()
    {

        $request = $this->container->get('request');
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        $session->getFlashBag()->add('loginSuccess', 'my success message');

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token'    => $csrfToken,
            'current_route' => $this->getCurrentRoute()
        ));
    }

    /**
     * @return mixed
     */
    public function getCurrentRoute()
    {
        return $this->currentRoute;
    }

    /**
     * @param mixed $currentRoute
     */
    public function setCurrentRoute($currentRoute)
    {
        $this->currentRoute = $currentRoute;
    }

    protected function renderLogin(array $data)
    {
        $template = sprintf('FDCPressBundle:Security:login.html.twig');

        return $this->container->get('templating')->renderResponse($template, $data);
    }

    /**
     * @Route("/login_check")
     */
    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

}