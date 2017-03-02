<?php

namespace Base\AdminBundle\Admin\CCM;

use FDC\CourtMetrageBundle\Entity\CcmProsPageTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Count;

class CcmProsPageAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    protected $translationDomain = 'BaseAdminBundle';

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
            ->add('title')
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
            ->add('image', 'sonata_type_model_list',array(
                'label' => 'form.ccm.label.pros.page_image',
                'required' => false
            ))
            ->add('translations', 'a2lix_translations', array(
                'locales' => ['fr','en'],
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.ccm.label.pros.page_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'description'            => array(
                        'label'              => 'form.ccm.label.pros.page_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'input_sync' => true
                    ),
                    'createdAt'         => array(
                        'display' => false,
                    ),
                    'updatedAt'         => array(
                        'display' => false,
                    ),
                    'status'            => array(
                        'label'                     => 'form.ccm.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmProsPageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('domainsCollection', 'sonata_type_collection', array(
                    'by_reference'       => false,
                    'label'              => 'form.ccm.label.pros.page_domains_list',
                    'translation_domain' => 'BaseAdminBundle',
                ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
            ->add(
                'sejoures',
                'infinite_form_polycollection',
                array(
                    'label'        => false,
                    'types'        => array(
                        'ccm_homepage_sejour_type',
                    ),
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'prototype'    => true,
                    'by_reference' => false,
                )
            )
            ->add(
                'sejourIsActive',
                'checkbox',
                array(
                    'label'    => 'form.ccm.label.sejour.sejour_is_activated',
                    'required' => false,
                )
            )
            ->add('positionSejour',
                'integer',
                array(
                    'label'    => 'form.ccm.label.homepage.position_sejour',
                    'required' => false,
                )
            )
            ->add('positionSocial',
                'integer',
                array(
                    'label'    => 'form.ccm.label.social.position_social',
                    'required' => false,
                ))
            ->add('socialIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.social.social_is_activated',
                'required' => false,
            ))
            ->add('positionActualites',
                'integer',
                array(
                    'label'    => 'form.ccm.label.homepage.position_actualite',
                    'required' => false,
                ))
            ->add('actualiteIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.actualite.is_active',
                'required' => false,
            ))
            ->add('catalogIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.catalog.push_is_activated',
                'required' => false,
            ))
            ->add('positionCatalog',
                'integer',
                array(
                    'label'    => 'form.ccm.label.homepage.position_catalog',
                    'required' => false,
                ))
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