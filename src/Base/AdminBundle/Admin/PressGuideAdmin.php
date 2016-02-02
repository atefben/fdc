<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Base\CoreBundle\Entity\PressGuideTranslation;
use Base\CoreBundle\Entity\PressGuide;

class PressGuideAdmin extends Admin
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
            ->add('updatedAt')
            ->add('status', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->where('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.status = :status');
                    $queryBuilder->setParameter('status', $value['value']);

                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => PressGuideTranslation::getStatuses(),
                    'choice_translation_domain' => 'BaseAdminBundle'
                ),
            ))
            ->add('translate', new CheckboxType() , array(
                'label'    => 'Traduction',
                'required' => false,
            ))

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
            ->add('status', null, array('template' => 'BaseAdminBundle:News:list_status.html.twig'))
            ->add('priorityStatus', 'choice', array(
                'choices' => PressGuide::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices' => PressGuideTranslation::getStatuses(),
                'catalogue' => 'BaseAdminBundle'
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
                        'label' => 'form.label_title',
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
                    'serviceTitle' => array(
                        'label' => 'form.label_title',
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
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => PressGuideTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))
            ->add('translate', 'checkbox' , array())

            ->add('priorityStatus', 'choice', array(
                'choices' => PressGuide::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('arriveWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'press_guide_widget_image_type',
                    'press_guide_widget_column_type',
                    'press_guide_widget_picto_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('meetingWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'press_guide_widget_image_type',
                    'press_guide_widget_column_type',
                    'press_guide_widget_picto_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('serviceWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'press_guide_widget_image_type',
                    'press_guide_widget_column_type',
                    'press_guide_widget_picto_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('informationWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'press_guide_widget_image_type',
                    'press_guide_widget_column_type',
                    'press_guide_widget_picto_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('arriveIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon-article' => 'Icone article',
                    'icon-communique' => 'Icone communique',
                    'icon-video' => 'Icone video',
                ),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('serviceIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon-article' => 'Icone article',
                    'icon-communique' => 'Icone communique',
                    'icon-video' => 'Icone video',
                ),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('meetingIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon-article' => 'Icone article',
                    'icon-communique' => 'Icone communique',
                    'icon-video' => 'Icone video',
                ),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('informationIcon', new ChoiceType(), array(
                'choices' => array(
                    'icon-article' => 'Icone article',
                    'icon-communique' => 'Icone communique',
                    'icon-video' => 'Icone video',
                ),
                'choice_translation_domain' => 'BaseAdminBundle'
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
}
