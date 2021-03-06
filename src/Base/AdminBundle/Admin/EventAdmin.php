<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\Event;
use Base\CoreBundle\Entity\EventTranslation;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EventAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );

    protected $translationDomain = 'BaseAdminBundle';

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
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%'. $value['value']. '%');

                    return true;
                },
                'field_type' => 'text'
            ))
            ->add('translate')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('oldNewsId', 'doctrine_orm_callback', array(
                'label'    => 'dashboard.link.old_news_id',
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $references = explode(',', $value['value']);
                    $queryBuilder->andWhere("{$alias}.oldNewsId in (:references)");
                    $queryBuilder->setParameter(':references', $references);

                    return true;
                },
                'field_type' => 'text'
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
            ->add('title', null, array('template' => 'BaseAdminBundle:News:list_title.html.twig'))
            ->add('createdAt')
            ->add('updatedAt')
            ->add('displayedMobile', null, array(
                'label' => 'list.displayed_mobile',
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig'
            ))
            ->add('_preview', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_preview_event.html.twig'
            ))
            ->add('oldNewsId', null, array(
                'label'    => 'dashboard.link.old_news_id',
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
                    'title' => array(
                        'label' => 'form.event.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.event.helper_title',
                    ),
                    'introduction' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.event.label_introduction',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'createdAt' => array(
                        'display' => false,
                    ),
                    'updatedAt' => array(
                        'display' => false,
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => EventTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'seoTitle' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_title',
                        ),
                        'label' => 'form.label_seo_title',
                        'sonata_help' => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'seoDescription' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_description',
                        ),
                        'label' => 'form.label_seo_description',
                        'sonata_help' => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    )
                )
            ))
            ->add('sites', null, array(
                'label' => 'form.label_publish_on',
                'class' => 'BaseCoreBundle:Site',
                'multiple' => true,
                'expanded' => true,
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
                    'event_widget_text_type',
                    'event_widget_quote_type',
                    'event_widget_audio_type',
                    'event_widget_image_type',
                    'event_widget_image_dual_align_type',
                    'event_widget_video_type',
                    'event_widget_video_youtube_type',
                    'event_widget_subtitle_type',
                    'event_widget_mosaic_movie_type'
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false,
                'label' => 'form.event.label_theme',
            ))
            ->add('signature', 'text', array(
                'label' => 'form.event.label_signature',
                'help' => 'form.event.helper_signature',
                'required' => false,
            ))
            ->add('tags', 'sonata_type_collection', array(
                'label' => 'form.label_article_tags',
                'help' => 'form.news.helper_tags',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                )
            )
            ->add('header', 'sonata_type_model_list', array(
                'label' => 'form.event.label_header_image',
                'help' => 'form.news.helper_header_image',
                'translation_domain' => 'BaseAdminBundle',
                'required' => false,
            ))
            ->add('associatedProjections', 'sonata_type_collection', array(
                'label' => 'form.label_news_film_projection_associated',
                'help' => 'form.news.helper_news_film_projection_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                )
            )
            ->add('displayedMobile')
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => Event::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => Event::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help' => 'form.seo.helper_file',
                'required' => false,
            ))
            // must be added to display informations about creation user / date, update user / date (top of right sidebar)
            ->add('createdAt', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden',
                ),
                'years' => range(1960, (int)date('Y') + 5),
            ))
            ->add('createdBy', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden',
                )
            ))
            ->add('updatedAt', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden',
                )
            ))
            ->add('updatedBy', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden',
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
            ->add('translate')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
