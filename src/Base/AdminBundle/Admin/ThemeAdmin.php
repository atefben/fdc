<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\Theme;
use Base\CoreBundle\Entity\ThemeTranslation;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * ThemeAdmin class.
 *
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class ThemeAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );

    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name', 'doctrine_orm_callback', array(
                'label'              => 'form.label_theme_name',
                'translation_domain' => 'BaseAdminBundle',
                'callback'           => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.name LIKE :name');
                    $queryBuilder->setParameter('name', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type'         => 'text'
            ))
            ->add('priorityStatus', 'doctrine_orm_choice', array(), 'choice', array(
                'choices'                   => Theme::getPriorityStatuses(),
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
            ->add('name', null, array('label' => 'list.label_theme_name'))
            ->add('priorityStatus', 'choice', array(
                'choices'   => Theme::getPriorityStatusesList(),
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
                'label'  => false,
                'fields' => array(
                    'name'      => array(
                        'label'              => 'form.label_theme_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.theme.helper_name',
                        'constraints'        => array(
                            new NotBlank()
                        )
                    ),
                    'status'    => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => ThemeTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                )
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices'            => Theme::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => Theme::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
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


    public function getExportFields()
    {
        return array(
            'Id'                   => 'id',
            'Nom du thème master'  => 'exportName',
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
