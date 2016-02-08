<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\InfoImage;
use Base\CoreBundle\Entity\InfoImageTranslation;
use Base\CoreBundle\Entity\InfoInfoAssociated;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * InfoImageAdmin class.
 *
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class InfoImageAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );

    protected $translationDomain = 'BaseAdminBundle';


    public function getNewInstance()
    {
        $instance = parent::getNewInstance();

        $instance->addAssociatedInfo(new InfoInfoAssociated());
        $instance->addAssociatedInfo(new InfoInfoAssociated());

        return $instance;
    }


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
                    'choices' => InfoImageTranslation::getStatuses(),
                    'choice_translation_domain' => 'BaseAdminBundle'
                ),
            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title', null, array('template' => 'BaseAdminBundle:Info:list_title.html.twig'))
            ->add('theme')
            ->add('createdAt')
            ->add('publishedInterval', null, array('template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig'))
            ->add('priorityStatus', 'choice', array(
                'choices' => InfoImage::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices' => InfoImageTranslation::getStatuses(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig'
            ))
            ->add('_preview', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_preview.html.twig'
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
                'fields' => array(
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.info.helper_title'
                    ),
                    'introduction' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_introduction',
                        'translation_domain' => 'BaseAdminBundle'
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
                        'choices' => InfoImageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'seoTitle' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label' => 'form.label_seo_title',
                        'sonata_help' => 'form.info.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'seoDescription' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_description'
                        ),
                        'label' => 'form.label_seo_description',
                        'sonata_help' => 'form.info.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false

                    )
                )
            ))
            ->add('sites', null, array(
                'label' => 'form.label_publish_on',
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
                'label' => false,
                'types' => array(
                    'info_widget_text_type',
                    'info_widget_quote_type',
                    'info_widget_audio_type',
                    'info_widget_image_type',
                    'info_widget_video_type',
                    'info_widget_video_youtube_type'
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
            ))
            ->add('tags', 'sonata_type_collection', array(
                'label' => 'form.label_article_tags',
                'help' => 'form.info.helper_tags',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('signature', null, array(
                'help' => 'form.info.helper_signature'
            ))
            ->add('gallery', 'sonata_type_model_list', array(
                'label' => 'form.label_gallery_image',
                'help' => 'form.news.helper_gallery_image',
                'translation_domain' => 'BaseAdminBundle'
            ))
            ->add('associatedFilm', 'sonata_type_model_list', array(
                'help' => 'form.news.helper_film_film_associated',
                'required' => false
            ))
            ->add('associatedEvent', 'sonata_type_model_list', array(
                'help' => 'form.news.helper_event_associated',
                'required' => false
            ))
            ->add('associatedProjections', 'sonata_type_collection', array(
                'label' => 'form.label_news_film_projection_associated',
                'help' => 'form.news.helper_news_film_projection_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('associatedFilms', 'sonata_type_collection', array(
                'label' => 'form.label_news_film_film_associated',
                'help' => 'form.news.helper_news_film_film_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('associatedInfo', 'sonata_type_collection', array(
                'label' => 'form.label_news_news_associated',
                'help' => 'form.news.helper_news_news_associated',
                'by_reference' => false,
                'btn_add' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('displayedHome')
            ->add('displayedMobile')
            ->add('translate')
            ->add('priorityStatus', 'choice', array(
                'choices' => Info::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help' => 'form.info.helper_file',
                'required' => false
            ))
            // must be added to display informations about creation user / date, update user / date (top of right sidebar)
            ->add('createdAt', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden'
                )
            ))
            ->add('createdBy', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden'
                )
            ))
            ->add('updatedAt', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden'
                )
            ))
            ->add('updatedBy', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden'
                )
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

    public function prePersist($object)
    {
        foreach ($object->getAssociatedInfo() as $info) {
            $info->setInfo($object);
        }
    }

    public function preUpdate($object)
    {
        foreach ($object->getAssociatedInfo() as $info) {
            $info->setInfo($object);
        }
    }
}
