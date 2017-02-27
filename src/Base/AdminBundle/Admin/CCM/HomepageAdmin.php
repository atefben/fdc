<?php

namespace  Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class HomepageAdmin extends Admin
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
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
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
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title' => array(
                        'label'              => 'form.ccm.label.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => true
                    ),
                )
            ))
            ->add('sliders', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'ccm_homepage_slider_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('pushes', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'ccm_homepage_push_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('selectionSection', 'sonata_type_model_list', array(
                'label'    => 'form.ccm.label.court.film_selection',
                'required' => true,
                'btn_add' => false,
                ))
            ->add('courtIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.court.court_is_activated',
                'required' => false,
            ))
            ->add('courtYear', 'text', array(
                'label'    => 'form.ccm.label.court.court_year',
            ))
            ->add('pushIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.catalog.push_is_activated',
                'required' => false,
            ))
            ->add('catalogIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.catalog.push_is_activated',
                'required' => false,
            ))
            ->add('catalogPushes', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'ccm_catalog_push_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
//            ->add('actualites', 'infinite_form_polycollection', array(
//                'label'        => false,
//                'types'        => array(
//                    'ccm_homepage_actualite_type',
//                ),
//                'allow_add'    => true,
//                'allow_delete' => true,
//                'prototype'    => true,
//                'by_reference' => false,
//            ))
            ->add('catalogImage', 'sonata_type_model_list', array(
                    'required' => true,
                )
            )
            ->add('actualiteIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.actualite.is_active',
                'required' => false,
            ))
            ->add('sejoures', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'ccm_homepage_sejour_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('sejourIsActive', 'checkbox', array(
                'label'    => 'form.ccm.label.sejour.sejour_is_activated',
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
