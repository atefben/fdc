<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressDownloadSectionWidgetVideoType class.
 *
 * \@extends PressGuideWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetVideoType extends PressDownloadSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetVideo')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetVideo';

    /**
     * PressGuideWidgetColumnDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $PressDownloadSectionWidgetVideoDummyAdmin;

    /**
     * setPressDownloadSectionWidgetVideoDummyAdmin function.
     *
     * @access public
     * @param mixed $PressDownloadSectionWidgetVideoDummyAdmin
     * @return void
     */
    public function setPressDownloadSectionWidgetVideoDummyAdmin($PressDownloadSectionWidgetVideoDummyAdmin)
    {
        $this->PressDownloadSectionWidgetVideoDummyAdmin = $PressDownloadSectionWidgetVideoDummyAdmin;
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
                    'firstColumn' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))

            ->add('image', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetVideoDummyAdmin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->PressDownloadSectionWidgetVideoDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetVideoDummyAdmin->getClass(),
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
        return 'press_download_section_widget_video_type';
    }
}