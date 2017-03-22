<?php

namespace Base\AdminBundle\Admin\CCM;


use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
/**
 * CcmShortFilmCornerWidgetImageDummyAdmin class.
 *
 * \@extends Admin
 * \@company Ohwee
 */
class CcmShortFilmCornerWidgetImageDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('file', 'sonata_type_model_list',array(
                'btn_delete' => true
            ))
        ;
    }
}
