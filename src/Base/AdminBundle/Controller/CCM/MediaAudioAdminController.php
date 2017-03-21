<?php

namespace Base\AdminBundle\Controller\CCM;

use Application\Sonata\AdminBundle\Controller\CRUDController;

/**
 * MediaAudioAdminController class.
 *
 * \@extends CRUDController
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class MediaAudioAdminController extends CRUDController
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
