<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Count;
use FDC\MarcheDuFilmBundle\Entity\MdfContactPageTranslation;

class MdfContactPageAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @return array
     */
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit'   => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('_type', 'hidden', array(
                'data'   => 'contact_block_type',
                'mapped' => false
            ))
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.label.contact_page_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true,
                    ),
                    'body'          => array(
                        'label'              => 'form.mdf.label.contact_page_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                        'required' => false
                    ),
                    'status'            => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MdfContactPageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    ),
                )
            ))
            ->add('contactBlock', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'contact_block_type',
                ),
                'constraints'        => array(
                    new Count(
                        array(
                            'min' => 1,
                            'max' => 2,
                            'minMessage' => "validation.contact_block_min",
                            'maxMessage' => "validation.contact_block_max",
                        )
                    ),
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                )
            )
            ->add('subjectsList', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.mdf.label.contact_page_subjects_list',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new Count(
                        array(
                            'min' => 1,
                            'minMessage' => "validation.contact_page_subject_min"
                        )
                    ),
                ),
            ), array(
                'edit'     => 'inline',
                'inline'   => 'table',
                'sortable' => 'position',
                )
            )
        ;

    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }
}
