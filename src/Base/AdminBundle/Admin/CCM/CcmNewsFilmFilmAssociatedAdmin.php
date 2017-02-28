<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * CcmNewsFilmFilmAssociatedAdmin class.
 *
 * \@extends Admin
 */
class CcmNewsFilmFilmAssociatedAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if(isset($_GET['code'])) {
            $condition = ($_GET['code'] == 'base.admin.film_film');
        } else {
            $condition = in_array('filmfilm',explode('/',$_SERVER['REQUEST_URI']));
        }

        if($condition) {
            $formMapper
                ->add('ccmNews', 'sonata_type_model_list', array('btn_add' => false, 'btn_delete' => false))
            ;
        } else {
            $formMapper
                ->add('association', 'sonata_type_model_list', array('btn_add' => false, 'btn_delete' => false))
            ;
        }

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
