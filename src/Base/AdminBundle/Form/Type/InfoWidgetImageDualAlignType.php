<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * InfoWidgetImageDualAlignType class.
 *
 * \@extends InfoWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class InfoWidgetImageDualAlignType extends InfoWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\InfoWidgetImageDualAlign')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\InfoWidgetImageDualAlign';

    /**
     * infoWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $infoWidgetImageDummyAdmin;

    private $galleryDualAlignDummyAdmin;

    /**
     * setInfoWidgetImageDummyAdmin function.
     *
     * @access public
     * @param mixed $infoWidgetImageDummyAdmin
     * @return void
     */
    public function setInfoWidgetImageDummyAdmin($infoWidgetImageDummyAdmin)
    {
        $this->infoWidgetImageDummyAdmin = $infoWidgetImageDummyAdmin;
    }

    public function setGalleryDualAlignAdmin($galleryDualAlignDummyAdmin)
    {
        $this->galleryDualAlignAdmin = $galleryDualAlignDummyAdmin;
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
            'sonata_field_description' =>  $this->infoWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager' => $this->galleryDualAlignAdmin->getModelManager(),
            'class' => $this->galleryDualAlignAdmin->getClass(),
            'label' => false
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
        return 'info_widget_image_dual_align_type';
    }
}