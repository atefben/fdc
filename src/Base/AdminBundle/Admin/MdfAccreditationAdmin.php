<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\AccreditationTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MdfAccreditationAdmin extends Admin
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
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.accreditation.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'subtitle'          => array(
                        'label'              => 'form.mdf.accreditation.subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'label'              => 'form.mdf.accreditation.information',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                    ),
                    'activeUrl'          => array(
                        'label'              => 'form.mdf.accreditation.see_more_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'state'            => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => AccreditationTranslation::getMainStatusesAccreditation(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionsTitle'          => array(
                        'label'              => 'form.mdf.accreditation.promotions_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'isEarlyBird'  => array(
                        'label'              => 'form.mdf.accreditation.is_early_bird',
                        'required'           => false,
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionTitle1'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_title_1',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionPrice1'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_price_1',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionInformation1'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_suffix_1',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionState1'            => array(
                        'label'                     => 'form.mdf.accreditation.promotion_state_1',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => AccreditationTranslation::getPromotionStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionTitle2'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_title_2',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionPrice2'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_price_2',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionInformation2'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_suffix_2',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionState2'            => array(
                        'label'                     => 'form.mdf.accreditation.promotion_state_2',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => AccreditationTranslation::getPromotionStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionTitle3'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_title_3',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionPrice3'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_price_3',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionInformation3'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_suffix_3',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionState3'            => array(
                        'label'                     => 'form.mdf.accreditation.promotion_state_3',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => AccreditationTranslation::getPromotionStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'promotionDetailsTitle1'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_title_1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPricePrefix1'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_prefix_1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPrice1'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPriceSuffix1'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_suffix_1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsInformation1'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_information_1',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                        'required'           => false,
                    ),
                    'promotionDetailsTitle2'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_title_2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPricePrefix2'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_prefix_2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPrice2'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPriceSuffix2'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_suffix_2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsInformation2'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_information_2',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                        'required'           => false,
                    ),
                    'promotionDetailsTitle3'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_title_3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPricePrefix3'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_prefix_3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPrice3'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsPriceSuffix3'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_price_suffix_3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'promotionDetailsInformation3'          => array(
                        'label'              => 'form.mdf.accreditation.promotion_details_information_3',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                        'required'           => false,
                    ),
                    'status'            => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => AccreditationTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    )
                ),
            ))
            ->add('accreditationWidgets', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'accreditation_widget_type',
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
