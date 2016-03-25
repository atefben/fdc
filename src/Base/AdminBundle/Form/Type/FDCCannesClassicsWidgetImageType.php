<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCCannesClassicsWidgetImageType class.
 *
 * \@extends FDCCannesClassicsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCCannesClassicsWidgetImageType extends FDCCannesClassicsWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\FDCCannesClassicsWidgetImage')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCCannesClassicsWidgetImage';

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

    public function setgalleryAdmin($galleryAdmin)
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
        return 'fdc_cannes_classics_widget_image_type';
    }
}