<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Base\CoreBundle\Entity\FDCPagePrepareTranslation;
use Base\CoreBundle\Entity\FDCPagePrepare;

class FDCPagePrepareAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }


    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt');
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
            ));
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
                    'mainTitle' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'mainDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),


                    'arriveTitle' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'meetingTitle' => array(
                        'label' => 'Titre strate',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'meetingDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'Description',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                    'meetingLabel' => array(
                        'label' => 'Libellé lien PDF',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'meetingUrl' => array(
                        'label' => 'URL Googlemaps',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'informationTitle' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'informationDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                    'serviceTitle' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'serviceDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
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
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => FDCPagePrepareTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))
            ->add('translate', 'checkbox', array(
                'required' => false,
            ))
            ->add('translateOptions', 'choice', array(
                'choices' => FDCPagePrepare::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => FDCPagePrepare::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'seo_file',
                'help' => 'form.seo.helper_file',
                'required' => false,
            ))
            ->add('arriveWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'fdc_page_prepare_widget_image_type',
                    'fdc_page_prepare_widget_column_type',
                    'fdc_page_prepare_widget_picto_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('serviceWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'fdc_page_prepare_widget_image_type',
                    'fdc_page_prepare_widget_column_type',
                    'fdc_page_prepare_widget_picto_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('informationWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'fdc_page_prepare_widget_image_type',
                    'fdc_page_prepare_widget_column_type',
                    'fdc_page_prepare_widget_picto_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('mainIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon_palme' => 'Préparer son séjour',
                ),
                'label' => 'form.label_information_icon',
                'translation_domain' => 'BaseAdminBundle',
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('mainImage', 'sonata_type_model_list', array(
                'label' => 'form.label_image'
            ))
            ->add('arriveIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon_se-rendre-a-cannes' => 'Se rendre à Cannes',
                    'icon_a-votre-service' => 'Plans',
                    'icon_hebergement' => 'Hebergement',
                    'icon_informations' => "Pour plus d'informations",
                ),
                'label' => 'form.label_information_icon',
                'translation_domain' => 'BaseAdminBundle',
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('serviceIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon_se-rendre-a-cannes' => 'Se rendre à Cannes',
                    'icon_a-votre-service' => 'Plans',
                    'icon_hebergement' => 'Hebergement',
                    'icon_informations' => "Pour plus d'informations",
                ),
                'label' => 'form.label_information_icon',
                'translation_domain' => 'BaseAdminBundle',
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('meetingIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon_se-rendre-a-cannes' => 'Se rendre à Cannes',
                    'icon_a-votre-service' => 'Plans',
                    'icon_hebergement' => 'Hebergement',
                    'icon_informations' => "Pour plus d'informations",
                ),
                'label' => 'form.label_information_icon',
                'translation_domain' => 'BaseAdminBundle',
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('informationIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon_se-rendre-a-cannes' => 'Se rendre à Cannes',
                    'icon_a-votre-service' => 'Plans',
                    'icon_hebergement' => 'Hebergement',
                    'icon_informations' => "Pour plus d'informations",
                ),
                'label' => 'form.label_information_icon',
                'translation_domain' => 'BaseAdminBundle',
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('meetingFile', 'sonata_type_model_list', array(
                'label' => 'PDF'
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
            ->add('updatedAt');
    }
}
