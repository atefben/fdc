<?php

namespace Base\AdminBundle\Controller;

use Application\Sonata\AdminBundle\Controller\CRUDController;

/**
 * MediaMdfAudioAdminController class.
 *
 * \@extends CRUDController
 */
class MediaMdfAudioAdminController extends CRUDController
{

    public function editAction($id = null)
    {
        $this
            ->get('base.amazon_remote_file')
            ->sync('audio')
        ;
        return parent::editAction($id); // TODO: Change the autogenerated stub
    }

    public function createAction()
    {
        $this
            ->get('base.amazon_remote_file')
            ->sync('audio')
        ;
        return parent::createAction(); // TODO: Change the autogenerated stub
    }

}
