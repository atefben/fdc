<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\Service;
use FDC\MarcheDuFilmBundle\Entity\ServiceTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class ServiceAdmin extends Admin
{

    protected $translationDomain = 'BaseAdminBundle';
    protected $formOptions = array(
        'cascade_validation' => true,
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
                    'show'   => array(),
                    'edit'   => array(),
                    'delete' => array(),
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
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'             => array(
                        'label'              => 'form.label.service_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.theme.helper_service_title',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'attr'               => array(
                            'maxlength' => 30,
                        ),
                    ),
                    'subTitle'          => array(
                        'label'              => 'form.label.service_sub_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'header'            => array(
                        'label'              => 'form.label.service_header',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                    ),
                    'createdAt'         => array(
                        'display' => false,
                    ),
                    'updatedAt'         => array(
                        'display' => false,
                    ),
                    'status'            => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => ServiceTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'showContentBlock'  => array(
                        'label'              => 'form.label.service_content_block_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'contentBlockTitle' => array(
                        'label'              => 'form.label.service_content_block_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'contentBlockBody'  => array(
                        'label'              => 'form.label.service_content_block_body',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                    ),
                ),
            ))
            ->add('widgets', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'service_widget_product_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices'            => Service::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true,
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => Service::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
            ))
            ->add('publishEndedAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
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
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }
}
