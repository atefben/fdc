<?php

namespace FDC\CourtMetrageBundle\Form;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmNewsWidgetGalleryType class.
 *
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetGalleryType extends CcmNewsWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetGallery')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetGallery';

    /**
     * ccmNewsWidgetGalleryDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $newsWidgetGalleryDummyAdmin;

    /**
     * @var mixed
     */
    private $galleryDummyAdmin;

    /**
     * setNewsWidgetGalleryDummyAdmin function.
     *
     * @access public
     * @param mixed $newsWidgetGalleryDummyAdmin
     * @return void
     */
    public function setNewsWidgetGalleryDummyAdmin($newsWidgetGalleryDummyAdmin)
    {
        $this->newsWidgetGalleryDummyAdmin = $newsWidgetGalleryDummyAdmin;
    }

    /**
     * @param mixed $galleryAdmin
     */
    public function setGalleryAdmin($galleryAdmin)
    {
        $this->galleryDummyAdmin = $galleryAdmin;
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
            'sonata_field_description' => $this->newsWidgetGalleryDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager'            => $this->galleryDummyAdmin->getModelManager(),
            'class'                    => $this->galleryDummyAdmin->getClass(),
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
        return 'ccm_news_widget_gallery_type';
    }
}