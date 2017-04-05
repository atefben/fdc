<?php

namespace  Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\Homepage;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\Url;

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
                'locales' => ['fr','en'],
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'aProposLabel' => array(
                        'label'              => 'form.ccm.label.a_propos.label',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'aProposTitle' => array(
                        'label'              => 'form.ccm.label.a_propos.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'aProposDescription'    => array(
                        'label'              => 'form.ccm.label.a_propos.description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'field_type'         => 'ckeditor',
                    ),
                    'aProposUrl' => array(
                        'label'              => 'form.ccm.label.a_propos.url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'sonata_help' => 'form.ccm.label.help_relative_url',
                    ),

                )
            ))
            ->add('aProposType', 'choice', array(
                    'label'              => 'form.ccm.label.a_propos.type',
                    'translation_domain' => 'BaseAdminBundle',
                    'choices'  => Homepage::getAProposTypes(),
                    'required' => false,

                )
            )
            ->add('aProposIsActive', 'checkbox', array(
                    'label'    => 'form.ccm.label.a_propos.is_activated',
                    'translation_domain' => 'BaseAdminBundle',
                    'required' => false,
                )
            )
            ->add('videosCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.ccm.label.a_propos.videos_list',
                'translation_domain' => 'BaseAdminBundle',
                'required' => false,
            ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('youtubesCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.ccm.label.a_propos.youtubes_list',
                'translation_domain' => 'BaseAdminBundle',
                'required' => false,
            ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('gallery', 'sonata_type_model_list',array(
                    'label'              => 'form.ccm.label.a_propos.gallery',
                    'translation_domain' => 'BaseAdminBundle',
                    'required' => false,
                )
            )
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
            ->add('actualites', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'ccm_homepage_actualite_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('catalogImage', 'sonata_type_model_list', array(
                    'required' => true,
                    'label'    => 'form.ccm.label.catalog.catalog_image',
                ), array(
                    'sortable' => 'order',
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
            ->add('positionCatalog',
                'integer',
                array(
                    'label'    => 'form.ccm.label.homepage.position_catalog',
                    'required' => false,
                ))
            ->add('positionActualites',
                'integer',
                array(
                    'label'    => 'form.ccm.label.homepage.position_actualite',
                    'required' => false,
                ))
            ->add('positionSejour',
                'integer',
                array(
                    'label'    => 'form.ccm.label.homepage.position_sejour',
                    'required' => false,
                ))
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
