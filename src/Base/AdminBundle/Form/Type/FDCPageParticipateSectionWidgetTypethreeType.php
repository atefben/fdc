<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCPageParticipateSectionWidgetTypethreeType class.
 *
 * \@extends FDCPageParticipateWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageParticipateSectionWidgetTypethreeType extends FDCPageParticipateSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidgetDocument')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidgetTypethree';

    /**
     * PressGuideWidgetDocumentDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $FDCPageParticipateSectionWidgetTypethreeDummyAdmin;

    /**
     * setFDCPageParticipateSectionWidgetTypethreeDummyAdmin function.
     *
     * @access public
     * @param mixed $FDCPageParticipateSectionWidgetTypethreeDummyAdmin
     * @return void
     */
    public function setFDCPageParticipateSectionWidgetTypethreeDummyAdmin($FDCPageParticipateSectionWidgetTypethreeDummyAdmin)
    {
        $this->FDCPageParticipateSectionWidgetTypethreeDummyAdmin = $FDCPageParticipateSectionWidgetTypethreeDummyAdmin;
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
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'icon' => array(
                        'field_type' => 'choice',
                        'choices' => array(
                            'icon_point-infos' => 'Point infos',
                            'icon_consignes' => 'Consignes',
                            'icon_objets-trouves' => 'Objets trouvés',
                            'icon_n-urgence' => 'Urgences',
                        ),
                        'label' => 'form.label_information_icon',
                        'translation_domain' => 'BaseAdminBundle',
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'content' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'widget'
                    ),
                )
            ))
            ;

    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'fdc_page_participate_section_widget_typethree_type';
    }
}