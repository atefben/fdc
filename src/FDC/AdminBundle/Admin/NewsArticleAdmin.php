<?php

namespace FDC\AdminBundle\Admin;

use FDC\CoreBundle\Entity\NewsArticleTranslation;
use FDC\CoreBundle\Entity\NewsNewsAssociated;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NewsArticleAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );
    
    public function getNewInstance()
    {
       $instance = parent::getNewInstance();
       
       $instance->addAssociation(new NewsNewsAssociated());
       $instance->addAssociation(new NewsNewsAssociated());

       return $instance;
    }


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
            ->add('title')
            ->add('theme')
            ->add('publishedAt')
            ->add('publishEndedAt')
            ->add('status')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('theme')
            ->add('updatedAt')
            ->add('publishedInterval', null, array('template' => 'FDCAdminBundle:News:list_published_interval.html.twig'))
            ->add('status', null, array('template' => 'FDCAdminBundle:News:list_status.html.twig'))
            ->add('type', null, array('template' => 'FDCAdminBundle:News:list_type.html.twig'))
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
      /*  $themeAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\Theme");
        $newsAssociatedAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\NewsAssociated");
        $tagAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\NewsArticleTranslationNewsTag");
        $mediaImageAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\MediaImage");
        $translationDummyAdmin = $this->configurationPool->getAdminByAdminCode('fdc.admin.news_article_translation_dummy');*/

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'required_locales' => array(),
                'fields' => array(
                    'title' => array(
                        'sonata_help' => 'X caractères max.',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
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
                        )
                    ),
                    'publishEndedAt' => array(
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        )
                    )
                )
            ))
            ->add('status', 'choice', array(
                'choices' => NewsArticleTranslation::getStatuses(),
                'choice_translation_domain' => 'FDCAdminBundle'
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
    
    public function prePersist($object)
    {
        $this->updateAction($object);
    }

    public function preUpdate($object)
    {
        $this->updateAction($object);
    }
    
    public function updateAction($object)
    {
        
    }
}
