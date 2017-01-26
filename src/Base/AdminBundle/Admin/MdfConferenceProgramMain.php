<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MdfConferenceProgramMain extends Admin
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
            ->add('subTitle')
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
            ->add('isActive', 'checkbox', array(
                'label' => 'form.mdf.active',
                'required' => false
            ))
            ->add('contentTemplateConferenceWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'content_template_widget_text_type',
                    'content_template_widget_image_type',
                    'content_template_widget_gallery_type',
                    'content_template_widget_video_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('files', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'program_file_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
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

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
        ;
    }
}
