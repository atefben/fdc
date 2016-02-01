<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PressHomepageAdmin extends Admin
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
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'sectionStatementInfoTitle' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sectionSchedulingTitle' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sectionMediaTitle' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sectionMediaSubtitle' => array(
                        'label' => 'form.label_subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sectionDownloadTitle' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sectionStatisticTitle' => array(
                        'label' => 'form.label_title',
                        'sonata_help' => 'form.press_homepage.helper_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sectionStatisticSubtitle' => array(
                        'label' => 'form.label_subtitle',
                        'sonata_help' => 'form.press_homepage.helper_subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sectionStatisticDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'sectionPushMainTitle' => array(
                        'label' => 'form.label_title',
                        'sonata_help' => 'form.press_homepage.helper_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sectionPushSecondaryTitle' => array(
                        'label' => 'form.label_title',
                        'sonata_help' => 'form.press_homepage.helper_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'seoTitle' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label' => 'form.label_seo_title',
                        'sonata_help' => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'seoDescription' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_description'
                        ),
                        'label' => 'form.label_seo_description',
                        'sonata_help' => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false

                    ),
                )
            ))
            ->add('sectionStatementInfoDisplay', 'checkbox', array(
                'label' => 'form.label_display',
                'required' => false,
            ))
            ->add('sectionSchedulingDisplay', 'checkbox', array(
                'label' => 'form.label_display',
                'required' => false,
            ))
            ->add('sectionMediaDisplay', 'checkbox', array(
                'label' => 'form.label_display',
                'required' => false,
            ))
            ->add('sectionDownloadDisplay', 'checkbox', array(
                'label' => 'form.label_display',
                'required' => false,
            ))
            ->add('sectionStatisticDisplay', 'checkbox', array(
                'label' => 'form.label_display',
                'required' => false,
            ))
            ->add('pushsMain', 'sonata_type_collection',
                array(
                    'by_reference' => false,
                    'label' => 'form.label_image_link'
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('pushsSecondary', 'sonata_type_collection',
                array(
                    'by_reference' => false,
                    'label' => 'form.label_image_link'
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('section', 'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => false,
                        'delete_options' => array(
                            'type'         => 'hidden',
                            'type_options' => array(
                                'mapped'   => false,
                                'required' => false,
                            )
                        )
                    ),
                    'label' => false,
                    'cascade_validation' => true,
                    'by_reference' => false,
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position'
                )
            )
            ->add('homeMedia', 'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => false,
                        'delete_options' => array(
                            'type'         => 'hidden',
                            'type_options' => array(
                                'mapped'   => false,
                                'required' => false,
                            )
                        )
                    ),
                    'cascade_validation' => true,
                    'by_reference' => false,
                    'help' => 'form.press_homepage.helper_media',
                    'label' => 'form.press_homepage.media_film'
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position',
                )
            )
            ->add('homeDownload', 'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => false,
                        'delete_options' => array(
                            'type'         => 'hidden',
                            'type_options' => array(
                                'mapped'   => false,
                                'required' => false,
                            )
                        )
                    ),
                    'cascade_validation' => true,
                    'by_reference' => false,
                    'label' => 'form.press_homepage.download'
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position',
                )
            )
            ->add('statImage', 'sonata_type_model_list', array(
                'label' => 'form.label_main_image',
                'translation_domain' => 'BaseAdminBundle'
            ))
            ->add('statImage2', 'sonata_type_model_list', array(
                'label' => 'form.label_second_image',
                'translation_domain' => 'BaseAdminBundle'
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
        ;
    }
}
