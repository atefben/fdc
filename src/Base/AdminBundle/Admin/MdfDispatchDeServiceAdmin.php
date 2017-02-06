<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MdfDispatchDeServiceAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';
    protected $formOptions = array(
        'cascade_validation' => true,
    );

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit'   => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.label.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'field_type' => 'ckeditor',
                        'label'              => 'form.mdf.label.description',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'contactTitle'          => array(
                        'required' => false,
                        'label'              => 'form.mdf.label.contact_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.mdf.label.contact_block_dispatch_du_service_info'
                    ),
                    'contactDescription'          => array(
                        'required' => false,
                        'field_type' => 'ckeditor',
                        'label'              => 'form.mdf.label.contact_description',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'contactSeeMoreUrl'          => array(
                        'required' => false,
                        'label'              => 'form.mdf.label.contact_see_more_url',
                        'translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('dispatchDeServiceWidgets', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'dispatch_de_service_widget_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
        ;
    }
}
