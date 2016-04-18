<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\FAQPage;
use Base\CoreBundle\Entity\FAQPageTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class FAQPageAdmin extends Admin
{

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
            ->add('title', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label'      => 'form.label_question',
            ))
            ->add('theme')
            ->add('priorityStatus', 'doctrine_orm_choice', array(), 'choice', array(
                'choices'                   => FAQPage::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
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
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:News:list_title.html.twig',
                'label'    => 'form.label_question',
            ))
            ->add('theme')
            ->add('priorityStatus', 'choice', array(
                'choices'   => FAQPage::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
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
                    'title' => array(
                        'label' => 'form.label_question',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.news.helper_title',
                        'constraints' => array(
                            new NotBlank()
                        )
                    ),
                    'content' => array(
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'label' => 'form.label_answer',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => true
                    ),
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
                        'choices' => FAQPageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => FAQPage::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => FAQPage::getPriorityStatuses(),
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
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }

    public function getExportFields()
    {
        return array(
            'Id'                   => 'id',
            'Question'             => 'exportName',
            'Thème'                => 'theme',
            'Date de création'     => 'exportCreatedAt',
            'Date de modification' => 'exportUpdatedAt',
            'Statut master'        => 'exportStatusMaster',
            'Traduction en'        => 'exportTranslationEn',
            'Statut en'            => 'exportStatusEn',
            'Traduction es'        => 'exportTranslationEs',
            'Statut es'            => 'exportStatusEs',
            'Traduction zh'        => 'exportTranslationZh',
            'Statut zh'            => 'exportStatusZh',
        );
    }
}
