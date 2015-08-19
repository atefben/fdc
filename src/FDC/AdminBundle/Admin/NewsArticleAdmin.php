<?php

namespace FDC\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NewsArticleAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'FDCAdminBundle:CRUD:edit_polycollection.html.twig');
    }
    
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('FDCAdminBundle:Form:polycollection.html.twig')
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('publishedAt')
            ->add('publishEndedAt')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('publishedAt')
            ->add('publishEndedAt')
            ->add('createdAt')
            ->add('updatedAt')
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
        // https://github.com/a2lix/TranslationFormBundle/issues/155
        $themeAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\Theme");
        $translationDummyAdmin = $this->configurationPool->getAdminByAdminCode('fdc.admin.translation_dummy');

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'fields' => array(
                    'title' => array(
                        'sonata_help' => 'X caractères max.'
                    ),
                    'introduction' => array(
                        'field_type' => 'ckeditor'
                    ),
                    'widgets' => array(
                        'field_type' => 'infinite_form_polycollection',
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
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'publishedAt' => array(
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        )
                    ),
                    'publishEndedAt' => array(
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        )
                    ),
                    'theme' => array(
                        'field_type' => 'sonata_type_model',
                        'sonata_field_description' => $translationDummyAdmin->getFormFieldDescriptions()['theme'],
                        'model_manager' => $themeAdmin->getModelManager(),
                        'class' => $themeAdmin->getClass(),
                       //'class' => 'FDCCoreBundle:Theme',
                      //  'allow_add' => true,
                    )
                )
            ))
            ->end()
            /*->add('header', 'sonata_type_model_list')
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('publishEndedAt')
            ->end()*/
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('publishedAt')
            ->add('publishEndedAt')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
