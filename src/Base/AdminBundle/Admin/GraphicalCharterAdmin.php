<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\GraphicalCharterTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class GraphicalCharterAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @return array
     */
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            ['BaseAdminBundle:Form:polycollection.html.twig']
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('_action', 'actions', [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ]
            ])
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', 'a2lix_translations', [
                'label'   => false,
                'fields'  => [
                    'applyChanges' => [
                        'field_type' => 'hidden',
                        'attr'       => [
                            'class' => 'hidden',
                        ],
                    ],
                    'pageTitle'    => [
                        'label'              => 'form.ccm.graphical_charter.page_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ],
                    'title'        => [
                        'label'              => 'form.ccm.graphical_charter.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ],
                    'header'       => [
                        'label'              => 'form.ccm.graphical_charter.header',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                        'input_sync'         => true
                    ],
                    'text'         => [
                        'label'              => 'form.ccm.graphical_charter.text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                        'field_type'         => 'ckeditor',
                        'input_sync'         => true
                    ],
                    'status'       => [
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => GraphicalCharterTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ]
                ]
            ])
            ->add('graphicalCharterSections', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'graphical_charter_section_position_type',
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
            ->add('id');
    }
}
