<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MediaVideoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('createdAt')
            ->add('publishedInterval', null, array('template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig'))
            ->add('priorityStatus', 'choice', array(
                'choices' => MediaVideo::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices' => MediaVideoTranslation::getStatuses(),
                'catalogue' => 'BaseAdminBundle'
            ))
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
        $requiredFile = ($this->subject && $this->subject->getId()) ? false : true;

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'file' => array(
                        'required' => $requiredFile,
                        'field_type' => 'sonata_media_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'provider' => 'sonata.media.provider.file',
                        'context' => 'statement_video',
                    ),
                    'akamaiId' => array(
                        'label' => 'form.label_akamai_id',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.helper_title',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'alt' => array(
                        'label' => 'form.label_image',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.helper_alt',
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => MediaVideoTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))
            ->add('image', 'sonata_media_type', array(
                'required' => $requiredFile,
                'translation_domain' => 'BaseAdminBundle',
                'provider' => 'sonata.media.provider.image',
                'context' => 'media_video_image',
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
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
            ))
            ->add('tags', 'sonata_type_collection', array(
                'label' => 'form.label_tags',
                'help' => 'form.media.helper_tags',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('translate')
            ->add('displayedMobile')
            ->add('displayedAll', null, array(
                'label' => 'form.media_image.displayed_all'
            ))
            ->add('displayedHome', null, array(
                'label' => 'form.media_image.displayed_home'
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => MediaVideo::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('inAllVideos', null, array(
                'label' => 'form.media_video.in_all_videos'
            ))
            ->add('displayedAll', null, array(
                'label' => 'form.media_video.displayed_all'
            ))
            ->add('displayedHome', null, array(
                'label' => 'form.media_video.displayed_home'
            ))
            ->add('displayedWebTv', null, array(
                'label' => 'form.media_video.displayed_webTv'
            ))
            ->add('displayedTrailer', null, array(
                'label' => 'form.media_video.displayed_trailer'
            ))
            ->add('displayedMobile', null, array(
                'label' => 'form.media_video.displayed_mobile'
            ))
//            ->add('film', 'sonata_type_model_list', array(
//                'required' => false
//            ))
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
