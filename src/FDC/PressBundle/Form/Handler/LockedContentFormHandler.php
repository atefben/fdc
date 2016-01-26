<?php

namespace FDC\PressBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;

class LockedContentFormHandler extends BaseHandler
{
    protected function onSuccess(UserInterface $user, $confirmation)
    {

        parent::onSuccess($user, $confirmation);

        // otherwise add your functionality here
    }
}