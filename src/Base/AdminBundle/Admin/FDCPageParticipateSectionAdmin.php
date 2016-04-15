<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Base\CoreBundle\Entity\FDCPageParticipateSectionTranslation;
use Base\CoreBundle\Entity\FDCPageParticipateSection;

class FDCPageParticipateSectionAdmin extends Admin
{

    protected $formOptions = array(
        'cascade_validation' => true
    );

    protected $translationDomain = 'BaseAdminBundle';

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label' => 'filter.fdc_page_participate.label_section'
            ));
        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addUpdatedBetweenFilters($datagridMapper);


    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:News:list_title.html.twig',
                'label' => 'Titre de la section',
            ))
            ->add('theme', null, array())
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig'
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
                'fields' => array(
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => FDCPageParticipateSectionTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'icon' => array(
                        'field_type' => 'choice',
                        'choices' => array(
                            'icon_horaires' => 'Horloge',
                            'icon_acces' => 'Carte ID',
                            'icon_informations' => 'Informations',
                            'icon_les-differents-types-dacces' => 'Différents types d\'accès',
                            'icon_les-salles-de-projections' => 'Projecteur',
                            'icon_les-bonnes-pratiques' => 'Check'

                        ),
                        'label' => 'form.label_information_icon',
                        'translation_domain' => 'BaseAdminBundle',
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'description' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press',
                        'required' => false
                    ),
                )
            ))
            ->add('mobile')
            ->add('page', 'choice' ,array(
                'choices' => array(
                    null => '',
                    '1' => 'Bonne Pratiques',
                    '2' => 'Différents types accès',
                    '3' => "Horaires",
                    '4' => 'Accès aux accréditations',
                    '5' => 'Informations utiles',
                    '6' => 'Se rendre',
                    '7' => 'A votre arrivée',
                    '8' => 'Rendez-vous des médias',
                    '9' => 'Services',
                    '10' => 'Plan'
                )
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => FDCPageParticipateSection::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => FDCPageParticipateSection::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('widgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'fdc_page_participate_section_widget_typeone_type',
                    'fdc_page_participate_section_widget_typetwo_type',
                    'fdc_page_participate_section_widget_typethree_type',
                    'fdc_page_participate_section_widget_typefour_type',
                    'fdc_page_participate_section_widget_typefive_type',
                    'fdc_page_participate_section_widget_subtitle_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
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