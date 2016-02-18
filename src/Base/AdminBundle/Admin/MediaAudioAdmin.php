<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\Media;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * MediaAudioAdmin class.
 *
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class MediaAudioAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );

    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }

                    $queryBuilder = $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type' => 'text',
            ))
            ->add('theme')
            ->add('createdBefore', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] == null) {
                        return;
                    }
                    $queryBuilder->andWhere("{$alias}.createdAt < :before");
                    $queryBuilder->setParameter('before', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type' => 'date',
                'field_options' => array(
                    'widget' => 'single_text',
                ),
                'label' => 'filter.media_audio.label_created_before',
            ))
            ->add('createdAfter', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] == null) {
                        return;
                    }
                    $queryBuilder->andWhere("{$alias}.createdAt > :after");
                    $queryBuilder->setParameter('after', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type' => 'date',
                'field_options' => array(
                    'widget' => 'single_text',
                ),
                'label' => 'filter.media_audio.label_created_after',
            ))
            ->add('publishedBefore', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->andWhere("{$alias}.publishedAt < :before");
                    $queryBuilder->setParameter('before', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type' => 'date',
                'field_options' => array(
                    'widget' => 'single_text',
                ),
                'label' => 'filter.media_audio.label_published_before',
            ))
            ->add('publishedAfter', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->andWhere("{$alias}.publishedAt > :after");
                    $queryBuilder->setParameter('after', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type' => 'date',
                'field_options' => array(
                    'widget' => 'single_text',
                ),
                'label' => 'filter.media_audio.label_published_after',
            ))
            ->add('status', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder = $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                    $queryBuilder->andWhere('t.status = :status');
                    $queryBuilder->setParameter('status', $value['value']);

                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => MediaAudioTranslation::getMainStatuses(),
                    'choice_translation_domain' => 'BaseAdminBundle'
                ),
            ))
            ->add('priorityStatus', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->andWhere("{$alias}.priorityStatus = :priorityStatus");
                    $queryBuilder->setParameter('priorityStatus', $value['value']);

                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => MediaAudio::getPriorityStatusesList(),
                    'choice_translation_domain' => 'BaseAdminBundle'
                ),
            ))
            ->add('displayedAll', null, array(
                'field_type' => 'checkbox',
                'label' => 'filter.media_audio.displayed_all',

            ))
            ->add('displayedHome', null, array(
                'field_type' => 'checkbox',
                'label' => 'filter.media_audio.displayed_home',

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
            ->add('legend', null, array(
                'label'    => 'list.label_title_audio',
                'template' => 'BaseAdminBundle:MediaAudio:list_title.html.twig'
            ))
            ->add('theme')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('priorityStatus', 'choice', array(
                'choices'   => MediaAudio::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => MediaAudioTranslation::getStatuses(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig'
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $requiredFile = ($this->subject && $this->subject->getId()) ? false : true;

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => array('fr'),
                'fields'             => array(
                    // remove fields not set by user
                    'createdAt'      => array(
                        'display' => false
                    ),
                    'updatedAt'      => array(
                        'display' => false
                    ),
                    'file'           => array(
                        'required'           => $requiredFile,
                        'field_type'         => 'sonata_media_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'provider'           => 'sonata.media.provider.audio',
                        'context'            => 'media_audio',
                    ),
                    'title'          => array(
                        'label'              => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media_audio.helper_title',
                        'locale_options'     => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MediaAudioTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'seoTitle'       => array(
                        'attr'               => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label'              => 'form.label_seo_title',
                        'sonata_help'        => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ),
                    'seoDescription' => array(
                        'attr'               => array(
                            'placeholder' => 'form.placeholder_seo_description'
                        ),
                        'label'              => 'form.label_seo_description',
                        'sonata_help'        => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    )
                )
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.label_media_video_image',
                'constraints' => array(
                    new NotNull(),
                ),
            ))
            ->add('tags', 'sonata_type_collection', array(
                'label'        => 'form.label_tags',
                'help'         => 'form.media.helper_tags',
                'by_reference' => false,
                'required'     => false,
            ), array(
                    'edit'   => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('associatedFilms', 'sonata_type_collection', array(
                'label'        => 'form.label_news_film_film_associated',
                'help'         => 'form.news.helper_news_film_film_associated',
                'by_reference' => false,
                'required'     => false,
            ), array(
                    'edit'   => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('sites', null, array(
                'label'    => 'form.label_publish_on',
                'class'    => 'BaseCoreBundle:Site',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('publishEndedAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.news.helper_file',
                'required' => false
            ))
            ->add('translate')
            ->add('displayedMobile')
            ->add('displayedAll', null, array(
                'label' => 'form.media_audio.displayed_all'
            ))
            ->add('displayedHome', null, array(
                'label' => 'form.media_audio.displayed_home'
            ))
            ->add('translateOptions', 'choice', array(
                'choices'            => MediaAudio::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => MediaAudio::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
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
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
