<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerTranslation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmShortFilmCornerAdmin extends Admin
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
                        'label'              => 'form.mdf.content_template.header',
                        'translation_domain' => 'BaseAdminBundle',
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
                    'ccm_sfc_widget_video_type',
                    'ccm_sfc_widget_video_youtube_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
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
