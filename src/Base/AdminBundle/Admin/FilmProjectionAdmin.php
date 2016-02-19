<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FilmProjectionAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('startsAt')
            ->add('endsAt')
            ->add('type')
            ->add('programmationSection')
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
            ->add('startsAt')
            ->add('endsAt')
            ->add('type')
            ->add('programmationSection')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
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
        $formMapper
            ->add('id')
            ->add('startsAt')
            ->add('endsAt')
            ->add('type')
            ->add('programmationSection')
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
            ->add('startsAt')
            ->add('endsAt')
            ->add('type')
            ->add('programmationSection')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }
}
