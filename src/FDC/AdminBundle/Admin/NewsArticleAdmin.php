<?php

namespace FDC\AdminBundle\Admin;

use FDC\CoreBundle\Entity\NewsArticleTranslation;
use FDC\CoreBundle\Entity\NewsNewsAssociated;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * NewsArticleAdmin class.
 * 
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class NewsArticleAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );
    
    protected $translationDomain = 'FDCAdminBundle';
        
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
            ->add('title', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->where('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%'. $value['value']. '%');

                    return true;
                },
                'field_type' => 'text'
            ))
            ->add('theme')
            ->add('publishedAt', 'doctrine_orm_datetime', array('field_type' => 'sonata_type_datetime_picker'))
            ->add('publishEndedAt', 'doctrine_orm_datetime', array('field_type' => 'sonata_type_datetime_picker'))
            ->add('status', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->where('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.status = :status');
                    $queryBuilder->setParameter('status', $value['value']);

                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => NewsArticleTranslation::getStatuses(),
                    'choice_translation_domain' => 'FDCAdminBundle'
                ),
            ))
            ->add('translate')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title', null, array('template' => 'FDCAdminBundle:News:list_title.html.twig'))
            ->add('theme')
            ->add('updatedAt')
            ->add('publishedInterval', null, array('template' => 'FDCAdminBundle:News:list_published_interval.html.twig'))
            ->add('status', null, array('template' => 'FDCAdminBundle:News:list_status.html.twig'))
            ->add('type', null, array('template' => 'FDCAdminBundle:News:list_type.html.twig'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit_translations' => array('template' => 'FDCAdminBundle:CRUD:list__action_edit_translations.html.twig'),
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
                'translation_domain' => 'FDCAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'title' => array(
                        'label' => 'form.label_title',
                        'sonata_help' => 'form.helper_title',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'introduction' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_introduction'
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
                        'label' => 'form.label_published_at',
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        )
                    ),
                    'publishEndedAt' => array(
                        'label' => 'form.label_publish_ended_at',
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        )
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'field_type' => 'choice',
                        'choices' => NewsArticleTranslation::getStatuses(),
                        'choice_translation_domain' => 'FDCAdminBundle'
                    ),
                )
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
                'label' => 'form.label_header_image',
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
            ->add('translate', null, array('required' => false), array(
                'translation_domain' => 'FDCAdminBundle',
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
