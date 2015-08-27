<?php

namespace FDC\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TranslationDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('theme', 'sonata_type_model')
            ->add('header', 'sonata_type_model_list', array(), array('link_parameters' => array('edit' => 'list', 'context' => 'image')))
            ->add('tags', 'sonata_type_model_list', array(
                'btn_list' => false
            ))
            ->add('newsAssociated', 'sonata_type_model_list', array(
                'btn_list' => false
            ))
        ;
    }
}
