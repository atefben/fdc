<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * FDCPageParticipateWidgetColumnDummyAdmin class.
 *
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageParticipateWidgetColumnDummyAdmin extends Admin
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
                        'context'  => 'media_archive',
                        'filter'   => array('context' => array('value' => 'media_archive')),
                        'provider' => 'sonata.media.provider.archive'
                    )
                ))
        ;
    }
}
