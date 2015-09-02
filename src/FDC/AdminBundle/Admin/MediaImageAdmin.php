<?php

namespace FDC\AdminBundle\Admin;

use FDC\CoreBundle\Entity\MediaImageTranslation;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

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
        $locales = array('fr', 'en', 'es', 'pt', 'ru', 'jp', 'cn', 'ar');
        $validationGroups = array();
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'required_locales' => $validationGroups,
                'fields' => array(
                    // remove fields not set by user
                    'createdAt' => array(
                            'display' => false
                        ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'legend' => array(
                        'sonata_help' => 'X caractères max.',
                        'locale_options' => array(
                            'fr' => array(
                                'constraints' => array(
                                    new NotBlank()
                                )
                            )
                        )
                    ),
                    'theme' => array(
                       // 'field_type' => 'sonata_type_model',
                        //    'sonata_field_description' => $translationDummyAdmin->getFormFieldDescriptions()['theme'],
                        //    'model_manager' => $themeAdmin->getModelManager(),
                        //   'class' => $themeAdmin->getClass(),
                           'class' => 'FDCCoreBundle:Theme',
                          //  'allow_add' => true,  
                    ),
                    'alt' => array(
                        'sonata_help' => 'X caractères max.',
                        'locale_options' => array(
                            'fr' => array(
                                'constraints' => array(
                                    new NotBlank()
                                )
                            )
                        )
                    ),
                    'copyright' => array(
                        'sonata_help' => 'X caractères max.',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => false
                            ),
                            'en' => array(
                                'required' => false
                            )
                        )
                    ),
                    'publishedAt' => array(
                            'field_type' => 'sonata_type_datetime_picker',
                            'format' => 'dd/MM/yyyy HH:mm',
                            'attr' => array(
                                'data-date-format' => 'dd/MM/yyyy HH:mm',
                            )
                        ),
                    'publishEndedAt' => array(
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        )
                    ),
                    'sites' => array(
                        'multiple' => true,
                        'expanded' => true,
                        'class' => 'FDCCoreBundle:Site'
                    ),
                    'status' => array(
                        'field_type' => 'choice',
                        'choices' => MediaImageTranslation::getStatuses(),
                        'choice_translation_domain' => 'FDCAdminBundle'
                    )
                )
            ))
            ->add('file', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'header_image'
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
