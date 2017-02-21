<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class ThemeDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image', 'sonata_type_model_list', array(
                    'required' => true,
                )
            )
            ->add('theme', 'sonata_type_model_list', array(
                    'required' => true,
                )
            )
        ;
    }
}
