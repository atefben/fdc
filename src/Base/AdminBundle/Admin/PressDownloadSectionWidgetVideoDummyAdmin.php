<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * PressDownloadSectionWidgetVideoDummyAdmin class.
 * 
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetVideoDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image', 'sonata_type_model_list')
            ->add('video', 'sonata_type_model_list')
            ->add('file', 'sonata_type_model_list',array(),
                array(
                    'link_parameters' => array(
                        'context'  => 'media_archive',
                        'filter'   => array('context' => array('value' => 'media_archive')),
                        'provider' => 'sonata.media.provider.archive'
                    )
                ))
            ->add('secondFile', 'sonata_type_model_list',
                array(
                    'required' => false
                ),
                array(
                    'link_parameters' => array(
                        'context'  => 'media_archive',
                        'filter'   => array('context' => array('value' => 'media_archive')),
                        'provider' => 'sonata.media.provider.archive'
                    )
                ))
        ;
    }
}
