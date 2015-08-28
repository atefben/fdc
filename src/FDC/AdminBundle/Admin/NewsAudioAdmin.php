<?php

namespace FDC\AdminBundle\Admin;

use FDC\CoreBundle\Entity\NewsAudioTranslation;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NewsAudioAdmin extends Admin
{
    /**
     * configure function.
     * 
     * @access public
     * @return void
     */
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
        // https://github.com/a2lix/TranslationFormBundle/issues/155
        $themeAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\Theme");
        $newsAssociatedAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\NewsAssociated");
        $tagAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\NewsTag");
        $mediaAudioAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\MediaAudio");
        $translationDummyAdmin = $this->configurationPool->getAdminByAdminCode('fdc.admin.news_audio_translation_dummy');

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'required_locales' => array('fr'),
                'fields' => array(
                    'title' => array(
                        'sonata_help' => 'X caractères max.'
                    ),
                    'theme' => array(
                        'field_type' => 'sonata_type_model_list',
                        'sonata_field_description' => $translationDummyAdmin->getFormFieldDescriptions()['theme'],
                        'model_manager' => $themeAdmin->getModelManager(),
                        'class' => $themeAdmin->getClass(),
                        'btn_delete' => false
                    ),
                    'tags' => array(
                        'field_type' => 'sonata_type_model_list',
                        'sonata_field_description' => $translationDummyAdmin->getFormFieldDescriptions()['tags'],
                        'model_manager' => $tagAdmin->getModelManager(),
                        'class' => $tagAdmin->getClass(),
                        'btn_list' => false
                    ),
                    'header' => array(
                        'field_type' => 'sonata_type_model_list',
                        'sonata_field_description' => $translationDummyAdmin->getFormFieldDescriptions()['header'],
                        'model_manager' => $mediaAudioAdmin->getModelManager(),
                        'class' => $mediaAudioAdmin->getClass(),
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
                    'newsAssociated' => array(
                        'field_type' => 'sonata_type_model_list',
                        'sonata_field_description' => $translationDummyAdmin->getFormFieldDescriptions()['newsAssociated'],
                        'model_manager' => $newsAssociatedAdmin->getModelManager(),
                        'class' => $newsAssociatedAdmin->getClass(),
                        'btn_list' => false
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'sites' => array(
                        'class' => 'FDCCoreBundle:Site',
                        'multiple' => true,
                        'expanded' => true
                    ),
                    'publishedAt' => array(
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        ),
                        'required' => false
                    ),
                    'publishEndedAt' => array(
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        ),
                        'required' => false
                    ),
                    'status' => array(
                        'field_type' => 'choice',
                        'choices' => NewsAudioTranslation::getStatuses(),
                        'choice_translation_domain' => 'FDCAdminBundle'
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
        ;
    }
}
