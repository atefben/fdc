<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class CcmModuleThreeColumnsAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image1', 'sonata_type_model_list', array(
                    'required' => false,
                )
            )
            ->add('image2', 'sonata_type_model_list', array(
                    'required' => false,
                )
            )
            ->add('image3', 'sonata_type_model_list', array(
                    'required' => false,
                )
            )
            ->add('pdf1', 'sonata_type_model_list', array(
                    'required' => false,
                )
            )
            ->add('pdf2', 'sonata_type_model_list', array(
                    'required' => false,
                )
            )
            ->add('pdf3', 'sonata_type_model_list', array(
                    'required' => false,
                )
            )
        ;
    }
}