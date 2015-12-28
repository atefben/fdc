<?php

namespace Base\AdminBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * LockController class.
 *
 * \@extends Controller
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 *
 * @Route("/lock")
 */
class LockController extends Controller
{
    /**
     * createLockAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/create/{id}", options={"expose"=true})
     */
    public function createLockAction($id)
    {
        error_log('create lock: '. $id);
        $response = new JsonResponse();

        return $response;
    }
    /**
     * deleteLockAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/delete/{id}", options={"expose"=true})
     */
    public function deleteLockAction($id)
    {
        error_log('delete lock: '. $id);
        $response = new JsonResponse();

        return $response;
    }
}