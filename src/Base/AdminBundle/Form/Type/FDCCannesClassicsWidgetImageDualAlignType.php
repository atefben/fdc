<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCCannesClassicsWidgetImageDualAlignType class.
 *
 * \@extends FDCCannesClassicsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCCannesClassicsWidgetImageDualAlignType extends FDCCannesClassicsWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\FDCCannesClassicsWidgetImageDualAlign')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCCannesClassicsWidgetImageDualAlign';

    /**
     * FDCCannesClassicsWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $FDCCannesClassicsWidgetImageDummyAdmin;

    private $galleryAdmin;

    /**
     * setFDCCannesClassicsWidgetImageDummyAdmin function.
     *
     * @access public
     * @param mixed $FDCCannesClassicsWidgetImageDummyAdmin
     * @return void
     */
    public function setFDCCannesClassicsWidgetImageDummyAdmin($FDCCannesClassicsWidgetImageDummyAdmin)
    {
        $this->FDCCannesClassicsWidgetImageDummyAdmin = $FDCCannesClassicsWidgetImageDummyAdmin;
    }

    public function setGalleryAdmin($galleryAdmin)
    {
        $this->galleryAdmin = $galleryAdmin;
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
        $builder->add('gallery', 'sonata_type_model_list', array(
            'sonata_field_description' =>  $this->FDCCannesClassicsWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager' => $this->galleryAdmin->getModelManager(),
            'class' => $this->galleryAdmin->getClass(),
            'label' => false
        ));
    }

    /**
     * getName function.
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'fdc_cannes_classics_widget_image_dual_align_type';
    }
}