<?php

namespace Base\AdminBundle\Admin;

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
            ->add('inAllVideos')
            ->add('inHomepage')
            ->add('inWebTv')
            ->add('inTrailer')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('inAllVideos')
            ->add('inHomepage')
            ->add('inWebTv')
            ->add('inTrailer')
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
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
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
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    )
                )
            ))
            ->add('image', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'media_video_image',
                'required' => ($this->getSubject()->getId() === null) ? true : false
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
            ))
            ->add('tags', 'sonata_type_collection', array(
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )

//            ->add('inAllVideos', null, array(
//                'required' => false
//            ))
//            ->add('inHomepage', null, array(
//                'required' => false
//            ))
//            ->add('inWebTv', null, array(
//                'required' => false
//            ))
//            ->add('inTrailer', null, array(
//                'required' => false
//            ))

            ->add('film', 'sonata_type_model_list', array(
                'required' => false
            ))
            ->add('webTv', 'sonata_type_model_list', array(
                'required' => false
            ))
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
                'required' => false
            ))
            ->add('publishEndedAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
                'required' => false
            ))
            ->add('sites', null, array(
                'class' => 'BaseCoreBundle:Site',
                'multiple' => true,
                'expanded' => true
            ))
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
            ->add('inAllVideos')
            ->add('inHomepage')
            ->add('inWebTv')
            ->add('inTrailer')
        ;
    }
}
