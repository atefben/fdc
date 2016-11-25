<?php

namespace FDC\MarcheDuFilmBundle\Component;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @return ObjectManager
     */
    protected function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }

}