<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FilmAtelierAdmin extends SoifAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('titleVO')
            ->add('productionYear')
            ->add('budgetEstimation')
            ->add('filmingDate')
            ->add('filmingPlace')
            ->add('duration')
            ->add('sessionName')
            ->add('budgetAcquired')
            ->add('cinandoUrl')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('titleVO')
            ->add('productionYear')
            ->add('budgetEstimation')
            ->add('filmingDate')
            ->add('filmingPlace')
            ->add('duration')
            ->add('sessionName')
            ->add('budgetAcquired')
            ->add('cinandoUrl')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'soif_refresh' => array('template' => 'BaseAdminBundle:CRUD:list__action_soif_refresh.html.twig')
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('titleVO')
            ->add('productionYear')
            ->add('budgetEstimation')
            ->add('filmingDate')
            ->add('filmingPlace')
            ->add('duration')
            ->add('sessionName')
            ->add('budgetAcquired')
            ->add('cinandoUrl')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('titleVO')
            ->add('productionYear')
            ->add('budgetEstimation')
            ->add('filmingDate')
            ->add('filmingPlace')
            ->add('duration')
            ->add('sessionName')
            ->add('budgetAcquired')
            ->add('cinandoUrl')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }
}
