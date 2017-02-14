<?php

namespace FDC\CourtMetrageBundle\Form;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmNewsWidgetImageDualAlignType class.
 *
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetImageDualAlignType extends CcmNewsWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetImageDualAlign')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetImageDualAlign';

    /**
     * ccmNewsWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $newsWidgetImageDummyAdmin;

    /**
     * @var mixed
     */
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
        $this->galleryDualAlignDummyAdmin = $galleryDualAlignDummyAdmin;
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
            'sonata_field_description' => $this->newsWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager'            => $this->galleryDualAlignDummyAdmin->getModelManager(),
            'class'                    => $this->galleryDualAlignDummyAdmin->getClass(),
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
        return 'ccm_news_widget_image_dual_align_type';
    }
}