<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
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
                        'label'              => 'form.label.category',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title'          => array(
                        'label'              => 'form.label.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'label'              => 'form.label.description',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                    ),
                    'url'          => array(
                        'label'              => 'form.label.url',
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
            ->add('contentSliders', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'home_content_slider_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
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
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
        ;
    }
}
