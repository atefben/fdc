<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class CcmModulePFAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('logo', 'sonata_type_model_list', array(
                    'required' => true,
                )
            )
            ->add('photo', 'sonata_type_model_list', array(
                    'required' => true,
                )
            )
        ;
    }
}