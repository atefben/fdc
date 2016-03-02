<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * NewsWidgetImageDualAlignType class.
 *
 * \@extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class NewsWidgetImageDualAlignType extends NewsWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\NewsWidgetImageDualAlign')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\NewsWidgetImageDualAlign';

    /**
     * newsWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $newsWidgetImageDummyAdmin;

    private $galleryDualAlignDummyAdmin;

    /**
     * setNewsWidgetImageDummyAdmin function.
     *
     * @access public
     * @param mixed $newsWidgetImageDummyAdmin
     * @return void
     */
    public function setNewsWidgetImageDummyAdmin($newsWidgetImageDummyAdmin)
    {
        $this->newsWidgetImageDummyAdmin = $newsWidgetImageDummyAdmin;
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
            'sonata_field_description' =>  $this->newsWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
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
        return 'news_widget_image_dual_align_type';
    }
}