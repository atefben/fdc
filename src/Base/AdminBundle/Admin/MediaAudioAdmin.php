<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\Media;

use Sonata\AdminBundle\Admin\Admin;
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
            ->add('updatedAt')
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
                    // remove fields not set by user
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
                        'context' => 'media_audio',
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
                    'sites' => array(
                        'multiple' => true,
                        'expanded' => true,
                        'class' => 'BaseCoreBundle:Site'
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => MediaAudioTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.label_media_video_image'
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
            ->add('translate')
            ->add('displayedMobile')
            ->add('displayedAll', null, array(
                'label' => 'form.media_image.displayed_all'
            ))
            ->add('displayedHome', null, array(
                'label' => 'form.media_image.displayed_home'
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => MediaAudio::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
        ->end();
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
