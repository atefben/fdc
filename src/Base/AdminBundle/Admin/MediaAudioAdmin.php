<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\Media;

use Base\AdminBundle\Component\Admin\Admin;
use Doctrine\ORM\EntityRepository;
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
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('title', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder = $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type' => 'text',
                'label'      => 'list.label_title_audio',
            ))
            ->add('theme')
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addPublishedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addStatusFilter($datagridMapper);
        $datagridMapper = $this->addPriorityFilter($datagridMapper);
        $datagridMapper
            ->add('displayedAll', null, array(
                'field_type' => 'checkbox',
                'label'      => 'filter.media_audio.displayed_all',

            ))
            ->add('displayedHome', null, array(
                'field_type' => 'checkbox',
                'label'      => 'filter.media_audio.displayed_home',

            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('title', null, array(
                'label'    => 'list.label_title_audio',
                'template' => 'BaseAdminBundle:MediaAudio:list_title.html.twig'
            ))
            ->add('theme')
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => MediaAudio::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('state', null, array(
                'label'              => 'list.media_video.label_encoding_state',
                'template'           => 'BaseAdminBundle:MediaAudio:list_state.html.twig',
                'translation_domain' => 'BaseAdminBundle',
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
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => array('fr'),
                'fields'             => array(
                    // add fields not set by user
                    'createdAt'        => array(
                        'display' => false
                    ),
                    'updatedAt'        => array(
                        'display' => false
                    ),
                    'jobMp3State'      => array(
                        'display' => false
                    ),
                    'jobMp3Id'         => array(
                        'display' => false
                    ),
                    'mp3Url'           => array(
                        'display' => false
                    ),
                    'file'             => array(
                        'required'           => false,
                        'field_type'         => 'sonata_media_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'provider'           => 'sonata.media.provider.audio',
                        'context'            => 'media_audio',
                    ),
                    'amazonRemoteFile' => array(
                        'required'   => false,
                        'field_type' => 'entity',
                        'class'      => 'BaseCoreBundle:AmazonRemoteFile',
                        'label'      => 'Fichiers Amazon',
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('arf')
                                ->andWhere('arf.type = :type')
                                ->setParameter('type', 'audio')
                                ;
                        },
                    ),
                    'title'            => array(
                        'label'              => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media_audio.helper_title',
                        'locale_options'     => array(
                            'fr' => array(
                                'required' => true
                            )
                        ),
                        'attr'               => array(
                            'maxlength' => 200
                        )
                    ),
                    'status'           => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MediaAudioTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'seoTitle'         => array(
                        'attr'               => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label'              => 'form.label_seo_title',
                        'sonata_help'        => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ),
                    'seoDescription'   => array(
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
                'label'       => 'form.label_media_video_image',
                'help'        => 'form.media_image.helper_file',
                'constraints' => array(
                    new NotNull(),
                ),
            ))
            ->add('tags', 'sonata_type_collection', array(
                'label'        => 'form.label_article_tags',
                'help'         => 'form.news.helper_tags',
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
                'help'     => 'form.seo.helper_file',
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
            ->add('associatedFilm', 'sonata_type_model_list', array(
                'help'     => 'form.news.helper_film_film_associated',
                'required' => false,
                'btn_add'  => false
            ))
            ->add('associatedEvent', 'sonata_type_model_list', array(
                'help'     => 'form.news.helper_event_associated',
                'required' => false,
                'btn_add'  => false
            ))
            ->add('associatedProjections', 'sonata_type_collection', array(
                'label'        => 'form.label_news_film_projection_associated',
                'help'         => 'form.news.helper_news_film_projection_associated',
                'by_reference' => false,
                'required'     => false,
            ), array(
                    'edit'   => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('translateOptions', 'choice', array(
                'choices'            => MediaAudio::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => MediaAudio::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
                'multiple'                  => false
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

    public function getExportFields()
    {
        return array(
            'Id'                                            => 'id',
            'Titre de l\'audio'                             => 'exportTitle',
            'Thème'                                         => 'exportTheme',
            'Id créateur'                                   => 'exportAuthor',
            'Date de création'                              => 'exportCreatedAt',
            'Dates de publication'                          => 'exportPublishDates',
            'Date de modification'                          => 'exportUpdatedAt',
            'Statut master'                                 => 'exportStatusMaster',
            'Statut traduction es'                          => 'exportStatusEn',
            'Statut traduction en'                          => 'exportStatusEs',
            'Statut traduction zh'                          => 'exportStatusZh',
            'Publié sur'                                    => 'exportSites',
            'Remonté dans tous les audios'                  => 'exportDisplayedAll',
            'Remonté en tant qu\'actualité sur la homepage' => 'exportDisplayedHome',
        );
    }
}
