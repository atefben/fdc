<?php

namespace FDC\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FilmMediaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('contentType')
            ->add('noteVf')
            ->add('noteVa')
            ->add('copyright')
            ->add('credits')
            ->add('type')
            ->add('internet')
            ->add('titleVf')
            ->add('titleVa')
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
            ->add('contentType')
            ->add('noteVf')
            ->add('noteVa')
            ->add('copyright')
            ->add('credits')
            ->add('type')
            ->add('internet')
            ->add('titleVf')
            ->add('titleVa')
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
            ->add('contentType')
            ->add('noteVf')
            ->add('noteVa')
            ->add('copyright')
            ->add('credits')
            ->add('type')
            ->add('internet')
            ->add('titleVf')
            ->add('titleVa')
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
            ->add('contentType')
            ->add('noteVf')
            ->add('noteVa')
            ->add('copyright')
            ->add('credits')
            ->add('type')
            ->add('internet')
            ->add('titleVf')
            ->add('titleVa')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
            ->add('file')
        ;
    }
}
