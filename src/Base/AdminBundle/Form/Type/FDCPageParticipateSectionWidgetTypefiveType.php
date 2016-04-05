<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCPageParticipateSectionWidgetTypefiveType class.
 *
 * \@extends FDCPageParticipateWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageParticipateSectionWidgetTypefiveType extends FDCPageParticipateSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidgetDocument')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidgetTypefive';

    /**
     * PressGuideWidgetDocumentDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $FDCPageParticipateSectionWidgetTypefiveDummyAdmin;

    /**
     * setFDCPageParticipateSectionWidgetTypefiveDummyAdmin function.
     *
     * @access public
     * @param mixed $FDCPageParticipateSectionWidgetTypefiveDummyAdmin
     * @return void
     */
    public function setFDCPageParticipateSectionWidgetTypefiveDummyAdmin($FDCPageParticipateSectionWidgetTypefiveDummyAdmin)
    {
        $this->FDCPageParticipateSectionWidgetTypefiveDummyAdmin = $FDCPageParticipateSectionWidgetTypefiveDummyAdmin;
    }

    /**
     * buildForm function.
     *
     * @access public
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'oneIcon' => array(
                        'field_type' => 'choice',
                        'choices' => array(
                            'icon_enregistreur' => 'Appareil photo',
                            'icon_selfie' => 'Selfie',
                            'icon_telephone' => 'Téléphone',
                            'icon_dress-code' => 'Noeud papillon',
                        ),
                        'label' => 'form.label_information_icon',
                        'translation_domain' => 'BaseAdminBundle',
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'oneDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'widget'
                    ),
                    'twoIcon' => array(
                        'field_type' => 'choice',
                        'choices' => array(
                            'icon_enregistreur' => 'Appareil photo',
                            'icon_selfie' => 'Selfie',
                            'icon_telephone' => 'Téléphone',
                            'icon_dress-code' => 'Noeud papillon',
                        ),
                        'label' => 'form.label_information_icon',
                        'translation_domain' => 'BaseAdminBundle',
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'twoDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'widget'
                    ),
                    'threeIcon' => array(
                        'field_type' => 'choice',
                        'choices' => array(
                            'icon_enregistreur' => 'Appareil photo',
                            'icon_selfie' => 'Selfie',
                            'icon_telephone' => 'Téléphone',
                            'icon_dress-code' => 'Noeud papillon',
                        ),
                        'label' => 'form.label_information_icon',
                        'translation_domain' => 'BaseAdminBundle',
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'threeDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'widget'
                    ),
                    'fourIcon' => array(
                        'field_type' => 'choice',
                        'choices' => array(
                            'icon_enregistreur' => 'Appareil photo',
                            'icon_selfie' => 'Selfie',
                            'icon_telephone' => 'Téléphone',
                            'icon_dress-code' => 'Noeud papillon',
                        ),
                        'label' => 'form.label_information_icon',
                        'translation_domain' => 'BaseAdminBundle',
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'fourDescription' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'widget'
                    ),
                )
            ));

    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'fdc_page_participate_section_widget_typefive_type';
    }
}