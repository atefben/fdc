<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressDownloadSectionWidgetPhotoType class.
 *
 * \@extends PressGuideWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetPhotoType extends PressDownloadSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetPhoto')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetPhoto';

    /**
     * PressGuideWidgetColumnDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $PressDownloadSectionWidgetPhotoDummyAdmin;

    /**
     * setPressDownloadSectionWidgetPhotoDummyAdmin function.
     *
     * @access public
     * @param mixed $PressDownloadSectionWidgetPhotoDummyAdmin
     * @return void
     */
    public function setPressDownloadSectionWidgetPhotoDummyAdmin($PressDownloadSectionWidgetPhotoDummyAdmin)
    {
        $this->PressDownloadSectionWidgetPhotoDummyAdmin = $PressDownloadSectionWidgetPhotoDummyAdmin;
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
            ->add('gallery', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetPhotoDummyAdmin->getFormFieldDescriptions()['gallery'],
                'model_manager' => $this->PressDownloadSectionWidgetPhotoDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetPhotoDummyAdmin->getClass(),
            ))
//            ->add('createdAt', 'hidden')
//            ->add('updatedAt', 'hidden')
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
        return 'press_download_section_widget_photo_type';
    }
}