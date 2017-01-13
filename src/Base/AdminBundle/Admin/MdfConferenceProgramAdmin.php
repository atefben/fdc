<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MdfConferenceProgramAdmin extends Admin
{
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
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.conference_program.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'subTitle'          => array(
                        'label'              => 'form.mdf.conference_program.subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'header'          => array(
                        'label'              => 'form.mdf.conference_program.header',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                    )
                )
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'label' => 'form.mdf.conference_program.theme',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('contentTemplateConferenceWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'content_template_widget_text_type',
                    'content_template_widget_image_type',
                    'content_template_widget_gallery_type'
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('file', 'sonata_type_model_list', array(
                'label' => 'form.mdf.file',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('dayWidgetCollections', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.mdf.label.new_program_day',
                'translation_domain' => 'BaseAdminBundle',
            ), array(
                      'edit'     => 'inline',
                      'inline'   => 'table',
                      'sortable' => 'position',
                  ))
        ;

    }
}
