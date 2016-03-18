<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressGuideWidgetImageType class.
 *
 * \@extends PressGuideWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressGuideWidgetImageType extends PressGuideWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\PressGuideWidgetImage')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressGuideWidgetImage';

    /**
     * PressGuideWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $PressGuideWidgetImageDummyAdmin;

    /**
     * setPressGuideWidgetImageDummyAdmin function.
     *
     * @access public
     * @param mixed $PressGuideWidgetImageDummyAdmin
     * @return void
     */
    public function setPressGuideWidgetImageDummyAdmin($PressGuideWidgetImageDummyAdmin)
    {
        $this->PressGuideWidgetImageDummyAdmin = $PressGuideWidgetImageDummyAdmin;
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
            ->add('gallery', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressGuideWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
                'model_manager' => $this->PressGuideWidgetImageDummyAdmin->getModelManager(),
                'class' => $this->PressGuideWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery']->getAssociationAdmin()->getClass(),
                'label' => 'form.label_image',
                'required' => false
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
        return 'press_guide_widget_image_type';
    }
}