<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\OrangeProgrammationOCS;
use Base\CoreBundle\Entity\OrangeProgrammationOCSTranslation;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class OrangeProgrammationOCSAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );

    protected $translationDomain = 'BaseAdminBundle';

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
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%'. $value['value']. '%');

                    return true;
                },
                'field_type' => 'text'
            ))
            ->add('translate')
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
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:News:list_title.html.twig',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => OrangeProgrammationOCS::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle',
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => OrangeProgrammationOCSTranslation::getMainStatuses(),
                'catalogue' => 'BaseAdminBundle',
            ))
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
                'locales' => array('fr', 'en')
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
                'locales' => array('fr', 'en'),
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'title' => array(
                        'label' => 'form.event.label_title',
                        'required' => true,
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.event.helper_title',
                    ),
                    'introduction' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.event.label_introduction',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'createdAt' => array(
                        'display' => false,
                    ),
                    'updatedAt' => array(
                        'display' => false,
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => OrangeProgrammationOCSTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                )
            ))
            
            ->add('widgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'orange_widget_film_ocs_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => OrangeProgrammationOCS::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => OrangeProgrammationOCS::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
            
            // must be added to display informations about creation user / date, update user / date (top of right sidebar)
            ->add('createdAt', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden',
                )
            ))
            ->add('updatedAt', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden',
                )
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
            ->add('translate')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
