<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class MdfMenuAdmin
 * @package Base\AdminBundle\Admin
 */
class MdfMenuAdmin extends Admin
{

    protected $translationDomain = 'BaseAdminBundle';

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
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
            ->with('from.mdf.menu.program')
                ->add('programProjectsIsActive', 'checkbox', array(
                    'label' => 'from.mdf.menu.program.projections',
                    'required' => false
                ))
                ->add('programEventsIsActive', 'checkbox', array(
                    'label' => 'from.mdf.menu.program.events',
                    'required' => false
                ))
            ->end()
        ;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }
}
