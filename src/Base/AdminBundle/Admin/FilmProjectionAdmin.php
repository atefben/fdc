<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FilmProjectionAdmin extends Admin
{

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['show']);
        unset($actions['edit']);
        unset($actions['delete']);

        return $actions;
    }
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('type')
            ->add('programmationSection')
            ->add('programmationFilms')
            ->add('startsAt')
            ->add('endsAt')
            ->add('soifUpdatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('type')
            ->add('programmationSection')
            ->add('programmationFilms')
            ->add('startsAt', null, array(
                'template' => 'BaseAdminBundle:FilmProjection:list_start_at.html.twig',
                'sortable' => 'startsAt',
            ))
            ->add('endsAt', null, array(
                'template' => 'BaseAdminBundle:FilmProjection:list_ends_at.html.twig',
                'sortable' => 'endsAt',
            ))
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
            ->add('programmationFilms')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }
}
