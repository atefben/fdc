<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCPageParticipateSectionWidgetTypetwoType class.
 *
 * \@extends FDCPageParticipateWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageParticipateSectionWidgetTypetwoType extends FDCPageParticipateSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidgetDocument')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidgetTypetwo';

    /**
     * PressGuideWidgetDocumentDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $FDCPageParticipateSectionWidgetTypetwoDummyAdmin;

    /**
     * setFDCPageParticipateSectionWidgetTypetwoDummyAdmin function.
     *
     * @access public
     * @param mixed $FDCPageParticipateSectionWidgetTypetwoDummyAdmin
     * @return void
     */
    public function setFDCPageParticipateSectionWidgetTypetwoDummyAdmin($FDCPageParticipateSectionWidgetTypetwoDummyAdmin)
    {
        $this->FDCPageParticipateSectionWidgetTypetwoDummyAdmin = $FDCPageParticipateSectionWidgetTypetwoDummyAdmin;
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

                    'sponsorFirstName' => array(
                        'label' => 'form.label_first_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sponsorLastName' => array(
                        'label' => 'form.label_last_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'sponsorRole' => array(
                        'label' => 'form.label_role',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                )
            ))

            ->add('image', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->FDCPageParticipateSectionWidgetTypetwoDummyAdmin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->FDCPageParticipateSectionWidgetTypetwoDummyAdmin->getModelManager(),
                'class' => $this->FDCPageParticipateSectionWidgetTypetwoDummyAdmin->getFormFieldDescriptions()['image']->getAssociationAdmin()->getClass(),
                'label' => 'form.label_sponsor_logo'
            ))
            ->add('sponsorImage', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->FDCPageParticipateSectionWidgetTypetwoDummyAdmin->getFormFieldDescriptions()['sponsorImage'],
                'model_manager' => $this->FDCPageParticipateSectionWidgetTypetwoDummyAdmin->getModelManager(),
                'class' => $this->FDCPageParticipateSectionWidgetTypetwoDummyAdmin->getFormFieldDescriptions()['sponsorImage']->getAssociationAdmin()->getClass(),
                'label' => 'form.label_sponsor_image'
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
        return 'fdc_page_participate_section_widget_typetwo_type';
    }
}