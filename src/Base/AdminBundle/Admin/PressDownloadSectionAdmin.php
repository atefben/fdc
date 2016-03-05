<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Base\CoreBundle\Entity\PressDownloadSectionTranslation;
use Base\CoreBundle\Entity\PressDownloadSection;

class PressDownloadSectionAdmin extends Admin
{

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
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
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
                'label'      => 'filter.press_download.label_section'
            ))
        ;
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
                'label'    => 'list.news_common.label_title',
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
            ->add('priorityStatus', 'choice', array(
                'choices'   => PressDownloadSection::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => PressDownloadSectionTranslation::getMainStatuses(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
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
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.news.helper_title'
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => PressDownloadSectionTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                )
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => PressDownloadSection::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => PressDownloadSection::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('widgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'press_download_section_widget_photo_type',
                    'press_download_section_widget_document_type',
                    'press_download_section_widget_file_type',
                    'press_download_section_widget_video_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
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
