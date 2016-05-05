<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LoginController extends Controller
{
    public function loginAction(Request $request)
    {
        $password=  $request->request->get('_password');
        $targetPath =  $request->request->get('_target_path');
        $failurePath =  $request->request->get('_failure_path');

        $user = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('ApplicationSonataUserBundle:User')
            ->findOneBy(array('username' => 'press'));

        $encodedPassword = $this->get('security.password_encoder')->encodePassword($user, $password);

        if ($encodedPassword === $user->getPassword()) {
            $token = new UsernamePasswordToken(
                $user->getUsername(),
                $user->getPassword(),
                'secured_area',
                $user->getRoles()
            );

            $this->get('security.token_storage')->setToken($token);
            // as suggested in some other answers
            $request->getSession()->set('_security_secured_area', serialize($token));

            $this->addFlash('loginSuccess', 'my success message');
            return $this->redirect($targetPath);
        }

        $request->getSession()->set('login_error', true);

        return $this->redirect($failurePath);
    }
}