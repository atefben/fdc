<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * MediaImageAdmin class.
 * 
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class MediaImageAdmin extends Admin
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
            ->add('legend', null, array(
                'label' => 'list.label_legend_img',
                'template' => 'BaseAdminBundle:MediaImage:list_legend.html.twig'
            ))
            ->add('createdAt')
            ->add('publishedInterval', null, array('template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig'))
            ->add('priorityStatus', 'choice', array(
                'choices' => MediaImage::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices' => MediaImageTranslation::getStatuses(),
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
                        'sonata_help' => 'form.media_image.helper_file',
                        'provider' => 'sonata.media.provider.image',
                        'context' => 'news_header_image',
                    ),
                    'legend' => array(
                        'label' => 'form.label_legend_img',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.media.helper_legend',
                        'locale_options' => array(
                            'fr' => array(
                                'constraints' => array(
                                    new NotBlank()
                                )
                            )
                        )
                    ),
                    'alt' => array(
                        'label' => 'form.label_alt_img',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.media.helper_alt',
                        'locale_options' => array(
                            'fr' => array(
                                'constraints' => array(
                                    new NotBlank()
                                )
                            )
                        )
                    ),
                    'copyright' => array(
                        'sonata_help' => 'form.media.helper_copyright',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => false
                            ),
                            'en' => array(
                                'required' => false
                            )
                        )
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => MediaImageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
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
                'choices' => MediaImage::getPriorityStatuses(),
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
