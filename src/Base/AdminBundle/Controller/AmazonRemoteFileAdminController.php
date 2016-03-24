<?php

namespace Base\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class AmazonRemoteFileAdminController extends CRUDController
{

    public function listAction()
    {
        $this
            ->get('base.amazon_remote_file')
            ->sync()
        ;
        return parent::listAction();
    }

}
