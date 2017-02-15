<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CcmMenuAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('name')
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
            ->add('programPicIsActive', 'checkbox', array(
                    'label' => 'form.ccm.label.menu.program_pic_is_active',
                    'required' => false,
                )
            )
            ->add('catalogPicIsActive', 'checkbox', array(
                    'label' => 'form.ccm.label.menu.catalog_pic_is_active',
                    'required' => false,
                )
            )
            ->add('registerPicIsActive', 'checkbox', array(
                    'label' => 'form.ccm.label.menu.register_pic_is_active',
                    'required' => false,
                )
            )
            ->add('mainNavsCollection', 'sonata_type_collection', array(
                    'by_reference'       => false,
                    'label'              => 'form.ccm.label.menu.main_nav_list',
                    'translation_domain' => 'BaseAdminBundle',
                ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
        ;
    }

//    /**
//     * @param RouteCollection $collection
//     */
//    protected function configureRoutes(RouteCollection $collection)
//    {
//        $collection->clearExcept(['edit', 'list']);
//    }
}