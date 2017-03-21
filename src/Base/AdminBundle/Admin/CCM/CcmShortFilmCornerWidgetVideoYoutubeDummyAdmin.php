<?php

namespace Base\AdminBundle\Admin\CCM;


use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
/**
 * CcmShortFilmCornerWidgetVideoYoutubeDummyAdmin class.
 *
 * \@extends Admin
 * \@company Ohwee
 */
class CcmShortFilmCornerWidgetVideoYoutubeDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image', 'sonata_type_model_list')
        ;
    }
}
