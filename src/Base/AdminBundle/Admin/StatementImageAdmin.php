<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Entity\StatementImage;
use Base\CoreBundle\Entity\StatementImageTranslation;
use Base\CoreBundle\Entity\StatementStatementAssociated;

use Base\AdminBundle\Component\Admin\StatementCommonAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * StatementImageAdmin class.
 *
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class StatementImageAdmin extends Admin
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
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.news.helper_title'
                    ),
                    'introduction' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_introduction',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
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
                        'choices' => StatementImageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'seoTitle' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label' => 'form.label_seo_title',
                        'sonata_help' => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'seoDescription' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_description'
                        ),
                        'label' => 'form.label_seo_description',
                        'sonata_help' => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false

                    )
                )
            ))
            ->add('mobileDisplay', 'choice', array(
                'required' => false,
                'choices'  => [
                    'big'                       => 'form.label_mobile_display_big',
                    'main'                      => 'form.label_mobile_display_main',
                ],
                'choice_translation_domain' => 'BaseAdminBundle',
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
                    'statement_widget_text_type',
                    'statement_widget_quote_type',
                    'statement_widget_audio_type',
                    'statement_widget_image_type',
                    'statement_widget_image_dual_align_type',
                    'statement_widget_video_type',
                    'statement_widget_video_youtube_type'
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
                'help' => 'form.news.helper_tags',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('signature', null, array(
                'help' => 'form.news.helper_signature'
            ))
            ->add('gallery', 'sonata_type_model_list', array(
                'label' => 'form.label_header_gallery',
                'help' => 'form.news.helper_header_gallery',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false
            ))
            ->add('header', 'sonata_type_model_list', array(
                'label' => 'form.label_header_image',
                'help' => 'form.news.helper_header_image',
                'translation_domain' => 'BaseAdminBundle',
                'required' => false
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
            ->add('associatedStatement', 'sonata_type_collection', array(
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
            ->add('hideSameDay')
            ->add('displayedHome')
            ->add('displayedMobile')
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => Statement::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => Statement::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help' => 'form.seo.helper_file',
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
        foreach ($object->getAssociatedStatement() as $statement) {
            $statement->setStatement($object);
        }
    }

    public function preUpdate($object)
    {
        foreach ($object->getAssociatedStatement() as $statement) {
            $statement->setStatement($object);
        }
    }
}
