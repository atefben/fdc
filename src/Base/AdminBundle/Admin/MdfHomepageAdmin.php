<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class MdfHomepageAdmin extends Admin
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
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
                    'delete' => array(),
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
                    'category'          => array(
                        'label'              => 'form.mdf.label.content_block.category',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.label.content_block.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'label'              => 'form.mdf.label.content_block.description',
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'required' => true,
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget'
                    ),
                    'url'          => array(
                        'label'              => 'form.mdf.label.content_block.url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'servicesCategory'          => array(
                        'label'              => 'form.mdf.home.service.category',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'servicesTitle'          => array(
                        'label'              => 'form.mdf.home.service.title',
                        'translation_domain' => 'BaseAdminBundle',
                    )
                )
            ))
            ->add('slidersTop', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'home_slider_top_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('sliders', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'home_slider_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('gallery', 'sonata_type_model_list', array(
                'label' => 'form.mdf.gallery',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('services', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'home_service_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
        ;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
        ;
    }
}
