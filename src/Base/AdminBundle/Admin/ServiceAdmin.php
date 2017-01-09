<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\Service;
use FDC\MarcheDuFilmBundle\Entity\ServiceTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class ServiceAdmin extends Admin
{

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected $translationDomain = 'BaseAdminBundle';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('title', null, array(
                'translation_domain' => 'BaseAdminBundle',
            ))
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('name')
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
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
            ->add('widgetCollections', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.gallery.medias',
                'translation_domain' => 'BaseAdminBundle',
            ), array(
                'edit'     => 'inline',
                'inline'   => 'table',
                'sortable' => 'position',
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
        ;
    }
}
