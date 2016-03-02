<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * PressDownloadSectionWidgetDocumentDummyAdmin class.
 * 
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetDocumentDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image', 'sonata_type_model_list')
            ->add('file', 'sonata_type_model_list',array(),
                array(
                    'link_parameters' => array(
                        'context'  => 'pdf',
                        'filter'   => array('context' => array('value' => 'pdf')),
                        'provider' => 'sonata.media.provider.file'
                    )
            ))
            ->add('secondFile', 'sonata_type_model_list',array(),
                array(
                    'link_parameters' => array(
                        'context'  => 'pdf',
                        'filter'   => array('context' => array('value' => 'pdf')),
                        'provider' => 'sonata.media.provider.file'
                    )
            ))
        ;
    }
}
