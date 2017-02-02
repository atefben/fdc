<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class MdfVideoDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('video', 'sonata_type_model_list', array(
                     'required' => true,
                 )
            )
        ;
    }
}
