<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCPageParticipateSectionWidgetTypeoneType class.
 *
 * \@extends FDCPageParticipateWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageParticipateSectionWidgetTypeoneType extends FDCPageParticipateSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidgetDocument')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidgetTypeone';

    /**
     * PressGuideWidgetDocumentDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $FDCPageParticipateSectionWidgetTypeoneDummyAdmin;

    /**
     * setFDCPageParticipateSectionWidgetTypeoneDummyAdmin function.
     *
     * @access public
     * @param mixed $FDCPageParticipateSectionWidgetTypeoneDummyAdmin
     * @return void
     */
    public function setFDCPageParticipateSectionWidgetTypeoneDummyAdmin($FDCPageParticipateSectionWidgetTypeoneDummyAdmin)
    {
        $this->FDCPageParticipateSectionWidgetTypeoneDummyAdmin = $FDCPageParticipateSectionWidgetTypeoneDummyAdmin;
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
                    'content' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                )
            ))

            ->add('image', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->FDCPageParticipateSectionWidgetTypeoneDummyAdmin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->FDCPageParticipateSectionWidgetTypeoneDummyAdmin->getModelManager(),
                'class' => $this->FDCPageParticipateSectionWidgetTypeoneDummyAdmin->getFormFieldDescriptions()['image']->getAssociationAdmin()->getClass(),
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
        return 'fdc_page_participate_section_widget_typeone_type';
    }
}