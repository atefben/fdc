<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\NewsAudioTranslation;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * StatementAudioAdmin class.
 * 
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class StatementAudioAdmin extends Admin
{
    /**
     * configure function.
     * 
     * @access public
     * @return void
     */
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
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
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
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'X caractères max.',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'introduction' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_introduction',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => NewsAudioTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))
            ->add('sites', null, array(
                'class' => 'BaseCoreBundle:Site',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('publishEndedAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('widgets', 'infinite_form_polycollection', array(
                'types' => array(
                    'news_widget_text_type',
                    'news_widget_audio_type',
                    'news_widget_image_type',
                    'news_widget_video_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'required' => false,
                'btn_delete' => false
            ))
            ->add('tags', 'sonata_type_collection', array(
                'by_reference' => false,
                'required' => false,
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('header', 'sonata_type_model_list', array(
                'label' => 'form.label_header_audio',
                'translation_domain' => 'BaseAdminBundle',
                'required' => false
            ))
            ->add('associations', 'sonata_type_collection', array(
                'by_reference' => false,
                'btn_add' => false,
                'required' => false,
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('translate', null, array(), array(
                'translation_domain' => 'BaseAdminBundle'
            ))
            ->end()
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
