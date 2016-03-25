<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * EventWidgetImageDualAlignType class.
 *
 * \@extends EventWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class EventWidgetImageDualAlignType extends EventWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\EventWidgetImageDualAlign')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\EventWidgetImageDualAlign';

    /**
     * eventWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $eventWidgetImageDummyAdmin;

    private $galleryAdmin;

    /**
     * setEventWidgetImageDummyAdmin function.
     *
     * @access public
     * @param mixed $eventWidgetImageDummyAdmin
     * @return void
     */
    public function setEventWidgetImageDummyAdmin($eventWidgetImageDummyAdmin)
    {
        $this->eventWidgetImageDummyAdmin = $eventWidgetImageDummyAdmin;
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
            'sonata_field_description' => $this->eventWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager'            => $this->galleryAdmin->getModelManager(),
            'class'                    => $this->galleryAdmin->getClass(),
            'label'                    => false,
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
        return 'event_widget_image_dual_align_type';
    }
}