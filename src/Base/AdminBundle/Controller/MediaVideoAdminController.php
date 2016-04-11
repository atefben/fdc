<?php

namespace Base\AdminBundle\Controller;

use Application\Sonata\AdminBundle\Controller\CRUDController;

class MediaVideoAdminController extends CRUDController
{

    public function listAction()
    {

        return parent::listAction();
    }

    public function editAction($id = null)
    {
        $this
            ->get('base.amazon_remote_file')
            ->sync()
        ;
        return parent::editAction($id); // TODO: Change the autogenerated stub
    }

    public function createAction()
    {
        $this
            ->get('base.amazon_remote_file')
            ->sync()
        ;
        return parent::createAction(); // TODO: Change the autogenerated stub
    }
}
