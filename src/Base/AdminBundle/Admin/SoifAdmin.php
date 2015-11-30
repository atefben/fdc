<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;

class SoifAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('soif-refresh', $this->getRouterIdParameter() . '/soif-refresh');
    }
}