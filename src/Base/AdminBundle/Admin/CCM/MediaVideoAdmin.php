<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class MediaVideoAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true,
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
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addPublishedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addStatusFilter($datagridMapper);
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
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
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
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $isTranslatorEnEsCh = (
            $securityContext->isGranted('ROLE_TRANSLATOR_EN') ||
            $securityContext->isGranted('ROLE_TRANSLATOR_ES') ||
            $securityContext->isGranted('ROLE_TRANSLATOR_ZH')
        ) ? true : false;

        $requiredLocales = ($isTranslatorEnEsCh) ? array() : array('fr');
        $amazonRemoteFileAttrs = array();
//            $amazonRemoteFileAttrs = ($isTranslatorEnEsCh) ? array('readonly' => 'readonly') : array();

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => $requiredLocales,
                'fields'             => array(
                    'applyChanges'          => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'createdAt'             => array(
                        'display' => false,
                    ),
                    'updatedAt'             => array(
                        'display' => false,
                    ),
                    'imageAmazonUrl'        => array(
                        'display' => false,
                    ),
                    'jobWebmState'          => array(
                        'display' => false,
                    ),
                    'jobMp4State'           => array(
                        'display' => false,
                    ),
                    'jobMp4Id'              => array(
                        'display' => false,
                    ),
                    'jobWebmId'             => array(
                        'display' => false,
                    ),
                    'mp4Url'                => array(
                        'display' => false,
                    ),
                    'webmUrl'               => array(
                        'display' => false,
                    ),
                    'file'                  => array(
                        'required'           => false,
                        'field_type'         => 'sonata_media_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'provider'           => 'sonata.media.provider.video',
                        'context'            => 'media_video',
                    ),
                    'amazonRemoteFile'      => array(
                        'required'      => false,
                        'field_type'    => 'entity',
                        'class'         => 'BaseCoreBundle:AmazonRemoteFile',
                        'label'         => 'Fichiers Amazon',
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('arf')
                                      ->andWhere('arf.type = :type')
                                      ->setParameter('type', 'video')
                                ;
                        },
                        'read_only'     => true,
                        'attr'          => $amazonRemoteFileAttrs,
                    ),
                    'title'                 => array(
                        'label'              => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media_video.helper_title',
                        'locale_options'     => array(
                            'fr' => array(
                                'required' => true,
                            ),
                        ),
                        'attr'               => array(
                            'maxlength' => 200,
                        ),
                    ),
                    'status'                => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MediaVideoTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank(),
                        ),
                    ),
                    'seoTitle'              => array(
                        'attr'               => array(
                            'placeholder' => 'group.ccm.placeholder_seo_title',
                        ),
                        'label'              => 'form.label_seo_title',
                        'sonata_help'        => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'seoDescription'        => array(
                        'attr'               => array(
                            'placeholder' => 'form.placeholder_seo_description',
                        ),
                        'label'              => 'form.label_seo_description',
                        'sonata_help'        => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                ),
            ))
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
            ))
            ->add('publishEndedAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label'    => 'form.label_media_video_image',
                'help'     => 'form.media_image.helper_file',
                'required' => false,
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false,
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false,
            ))
            // must be added to display informations about creation user / date, update user / date (top of right sidebar)
            ->add('createdAt', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden',
                ),
            ))
            ->add('createdBy', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden',
                ),
            ))
            ->add('updatedAt', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden',
                ),
            ))
            ->add('updatedBy', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden',
                ),
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

    public function prePersist($object)
    {
        session_write_close();
    }

    public function preUpdate($object)
    {
        session_write_close();
    }
}
