<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerTranslation;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmShortFilmCornerAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

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
        ;
        $this->addCreatedBetweenFilters($datagridMapper);
        $this->addStatusFilter($datagridMapper);
    }
    
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
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:FDCPageLaSelectionCannesClassics:list_title.html.twig',
                'label' => 'Titre'
            ))
            ->add('menuOrder',null,array('label' => 'Position'))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
                'label' => 'Date de création'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => CcmShortFilmCornerTranslation::getStatuses(),
                'catalogue' => 'BaseAdminBundle',
                'label' => 'Statut'
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
                'label' => 'Editer'

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
                'locales' => ['fr','en'],
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.content_template.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'header'          => array(
                        'field_type'         => 'ckeditor',
                        'label'              => 'form.mdf.content_template.header',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press',
                        'required' => false
                    ),
                    'status'         => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmShortFilmCornerTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    )
                )
            ))
            ->add(
                'image',
                'sonata_type_model_list'
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
            ->add('widgets', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'ccm_sfc_widget_text_type',
                    'ccm_sfc_widget_subtitle_type',
                    'ccm_sfc_widget_quote_type',
                    'ccm_sfc_widget_audio_type',
                    'ccm_sfc_widget_image_type',
                    'ccm_sfc_widget_image_dual_align_type',
                    'ccm_sfc_widget_gallery_type',
                    'ccm_sfc_widget_video_type',
                    'ccm_sfc_widget_video_youtube_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('menuOrder', 'number',[
                'label' => 'form.ccm.label.short_film_corner.position_du_menu'
            ])
        ;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list', 'create', 'delete', 'batch']);
    }
}
