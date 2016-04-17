<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * NewsWidgetAudioDummyAdmin class.
 *
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class NewsWidgetAudioDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('file', 'sonata_type_model_list',array(
                'btn_delete' => true,
                'btn_add' => false
            ))
        ;
    }
}
