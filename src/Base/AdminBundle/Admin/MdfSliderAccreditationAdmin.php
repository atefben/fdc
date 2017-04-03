<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class MdfSliderAccreditationAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('_type', 'hidden', array(
                'data'   => 'slider_accreditation_type',
                'mapped' => false
            ))
            ->add('image', 'sonata_type_model_list', array(
                    'label' => 'form.mdf.label.slider_accreditation_image',
                    'constraints'        => array(
                        new NotBlank(),
                    ),
                    'required' => true,
                )
            )
        ;
    }
}