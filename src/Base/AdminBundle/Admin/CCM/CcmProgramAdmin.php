<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsTranslation;

class CcmProgramAdmin extends Admin
{
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
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
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
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'locales' => array('fr', 'en'),
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.ccm.label.program.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => true,
                    ),
                    'body'            => array(
                        'label'              => 'form.ccm.label.program.body',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
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
                        'choices'                   => MdfGlobalEventsTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'required' => true,
                'label' => 'form.ccm.label.program.image',
                'btn_delete' => false
            ))
            ->add('daysCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.ccm.label.program.days_collection',
                'translation_domain' => 'BaseAdminBundle',
            ), array(
                'edit'     => 'inline',
                'inline'   => 'table',
                'sortable' => 'position',
            ))
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
                    'label'    => 'form.ccm.label.program.sejour_is_activated',
                    'required' => false,
                )
            )
            ->add('positionSejour',
                'integer',
                array(
                    'label'    => 'form.ccm.label.program.position_sejour',
                    'required' => false,
                )
            )
            ->add('positionSocial',
                'integer',
                array(
                    'label'    => 'form.ccm.label.program.position_social',
                    'required' => false,
                ))
            ->add('socialIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.program.social_is_activated',
                'required' => false,
            ))
            ->add('positionActualites',
                'integer',
                array(
                    'label'    => 'form.ccm.label.program.position_actualite',
                    'required' => false,
                ))
            ->add('actualiteIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.program.actualite_is_activated',
                'required' => false,
            ))
            ->add('catalogIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.program.catalog_is_activated',
                'required' => false,
            ))
            ->add('positionCatalog',
                'integer',
                array(
                    'label'    => 'form.ccm.label.program.position_catalog',
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
