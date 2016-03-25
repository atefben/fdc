<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\NewsNewsAssociated;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class MediaVideoAdmin extends Admin
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
            ->add('id', null, array('label' => 'id'))
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
                'label'      => 'filter.media_video.label_title_video',
            ))
            ->add('theme')
            ->add('webTv', null, array(
                'label' => 'filter.media_video.label_web_tv'
            ))
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addPublishedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addStatusFilter($datagridMapper);
        $datagridMapper = $this->addPriorityFilter($datagridMapper);


        $datagridMapper
            ->add('displayedHome', null, array(
                'field_type' => 'checkbox',
                'label'      => 'filter.media_video.displayed_home',

            ))
            ->add('displayedTrailer', null, array(
                'label'      => 'filter.media_video.displayed_trailer',
                'field_type' => 'checkbox',
            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array(
                'label'              => 'list.media_video.label_id',
                'translation_domain' => 'BaseAdminBundle',
            ))
            ->add('title', null, array(
                'label'              => 'list.media_video.label_title_video',
                'template'           => 'BaseAdminBundle:MediaVideo:list_title.html.twig',
                'translation_domain' => 'BaseAdminBundle',
            ))
            ->add('theme')
            ->add('webTv', null, array(
                'label'              => 'list.media_video.label_web_tv',
                'translation_domain' => 'BaseAdminBundle',
            ))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => MediaVideo::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => MediaVideoTranslation::getStatuses(),
                'catalogue' => 'BaseAdminBundle',
            ))
            ->add('state', null, array(
                'label'              => 'list.media_video.label_encoding_state',
                'template'           => 'BaseAdminBundle:MediaVideo:list_state.html.twig',
                'translation_domain' => 'BaseAdminBundle',
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
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
                    'createdAt'      => array(
                        'display' => false
                    ),
                    'updatedAt'      => array(
                        'display' => false
                    ),
                    'imageAmazonUrl' => array(
                        'display' => false
                    ),
                    'jobWebmState'   => array(
                        'display' => false
                    ),
                    'jobMp4State'    => array(
                        'display' => false
                    ),
                    'jobMp4Id'       => array(
                        'display' => false
                    ),
                    'jobWebmId'      => array(
                        'display' => false
                    ),
                    'mp4Url'         => array(
                        'display' => false
                    ),
                    'webmUrl'        => array(
                        'display' => false
                    ),
                    'file'           => array(
                        'required'           => false,
                        'field_type'         => 'sonata_media_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'provider'           => 'sonata.media.provider.video',
                        'context'            => 'media_video',
                    ),
                    'amazonRemoteFile'           => array(
                        'required'           => false,
                        'field_type'         => 'entity',
                        'class' => 'BaseCoreBundle:AmazonRemoteFile',
                    ),
                    'title'          => array(
                        'label'              => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media_video.helper_title',
                        'locale_options'     => array(
                            'fr' => array(
                                'required' => true,
                            )
                        ),
                        'attr' => array(
                            'maxlength' => 200
                        )
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MediaVideoTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
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
            ->add('webTv', 'sonata_type_model_list', array(
                'label'    => 'form.label_webTv_required',
                'required' => false,
                'attr' => array(
                    'class' => 'webTvField'
                )
            ))
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
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.label_media_video_image',
                'help'  => 'form.media_image.helper_file',
                'required' => false
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
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
                    'inline' => 'table',
                )
            )
            ->add('translate')
            ->add('displayedMobile')
            ->add('displayedAll', null, array(
                'label' => 'form.media_video.displayed_all'
            ))
            ->add('displayedHome', null, array(
                'label' => 'form.media_video.displayed_home'
            ))
            ->add('associatedFilm', 'sonata_type_model_list', array(
                'help' => 'form.news.helper_film_film_associated',
                'required' => false,
                'btn_add' => false
            ))
            ->add('associatedEvent', 'sonata_type_model_list', array(
                'help' => 'form.news.helper_event_associated',
                'required' => false,
                'btn_add' => false
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
            ->add('translateOptions', 'choice', array(
                'choices'            => MediaVideo::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => MediaVideo::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('displayedWebTv', null, array(
                'label' => 'form.media_video.displayed_webTv',
                'attr'  => array(
                    'class' => 'displayWebTvChannels'
                )
            ))
            ->add('displayedTrailer', null, array(
                'label' => 'form.media_video.displayed_trailer'
            ))
            ->add('displayedMobile', null, array(
                'label' => 'form.media_video.displayed_mobile'
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false
            ))
            // must be added to display informations about creation user / date, update user / date (top of right sidebar)
            ->add('createdAt', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden'
                )
            ))
            ->add('createdBy', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden'
                )
            ))
            ->add('updatedAt', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden'
                )
            ))
            ->add('updatedBy', null, array(
                'label' => false,
                'attr'  => array(
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
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param string $context
     * @return \Sonata\AdminBundle\Datagrid\ProxyQueryInterface
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $pcode = $this->getRequest()->get('pcode') === 'base.admin.fdc_page_web_tv_live_media_video_associated';
        if ($pcode && $context == 'list') {
            $query->andWhere($query->getRootAlias() . '.displayedTrailer = 1');
        }
        return $query;
    }

    public function getExportFields()
    {
        return array(
            'Id'                                        => 'id',
            'Titre de la vidéo'                         => 'exportTitle',
            'Thème'                                     => 'exportTheme',
            'Chaîne'                                    => 'exportWebTv',
            'Id créateur'                               => 'exportAuthor',
            'Date de création'                          => 'exportCreatedAt',
            'Dates de publication'                      => 'exportPublishDates',
            'Date de modification'                      => 'exportUpdatedAt',
            'Statut master'                             => 'exportStatusMaster',
            'Statut traduction es'                      => 'exportStatusEn',
            'Statut traduction en'                      => 'exportStatusEs',
            'Statut traduction zh'                      => 'exportStatusZh',
            'Publié sur'                                => 'exportSites',
            'Affiché en tant qu\'actualité sur la home' => 'exportDisplayedHome',
            'Bande annonce'                             => 'exportDisplayedTrailer',
        );
    }

}
