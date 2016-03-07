<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressGuideWidgetColumnType class.
 *
 * \@extends PressGuideWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressGuideWidgetColumnType extends PressGuideWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\PressGuideWidgetColumn')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressGuideWidgetColumn';

    /**
     * PressGuideWidgetColumnDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $PressGuideWidgetColumnDummyAdmin;

    /**
     * setPressGuideWidgetColumnDummyAdmin function.
     *
     * @access public
     * @param mixed $PressGuideWidgetColumnDummyAdmin
     * @return void
     */
    public function setPressGuideWidgetColumnDummyAdmin($PressGuideWidgetColumnDummyAdmin)
    {
        $this->PressGuideWidgetColumnDummyAdmin = $PressGuideWidgetColumnDummyAdmin;
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
                    'firstColumn' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'Bloc 1',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                    'secondColumn' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'Bloc 2',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                    'thirdColumn' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'Bloc 3',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                )
            ))

            ->add('gallery', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressGuideWidgetColumnDummyAdmin->getFormFieldDescriptions()['gallery'],
                'model_manager' => $this->PressGuideWidgetColumnDummyAdmin->getModelManager(),
                'class' => $this->PressGuideWidgetColumnDummyAdmin->getFormFieldDescriptions()['gallery']->getAssociationAdmin()->getClass(),
                'label' => 'form.label_image',
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
        return 'press_guide_widget_column_type';
    }
}