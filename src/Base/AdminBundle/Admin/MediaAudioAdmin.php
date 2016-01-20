<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaAudio;

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
                        'context' => 'news_audio',
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
            ->add('image', 'sonata_media_type', array(
                'required' => $requiredFile,
                'sonata_help' => 'form.media_image.helper_file',
                'translation_domain' => 'BaseAdminBundle',
                'provider' => 'sonata.media.provider.image',
                'context' => 'news_header_image',
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
            ))
            ->add('film', 'sonata_type_model_list', array(
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
            ->add('displayedAll', null, array(
                'label' => 'form.media_video.displayed_all'
            ))
            ->add('displayedHome', null, array(
                'label' => 'form.media_video.displayed_home'
            ))
            ->add('displayedMobile', null, array(
                'label' => 'form.media_video.displayed_mobile'
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
