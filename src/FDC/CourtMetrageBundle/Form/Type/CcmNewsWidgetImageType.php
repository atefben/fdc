<?php

namespace FDC\CourtMetrageBundle\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmNewsWidgetImageType class.
 *
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetImageType extends CcmNewsWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetImage')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetImage';

    /**
     * newsWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $newsWidgetImageDummyAdmin;

    private $galleryAdmin;

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
            'sonata_field_description' => $this->newsWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager'            => $this->galleryAdmin->getModelManager(),
            'class'                    => $this->galleryAdmin->getClass(),
            'label'                    => false,
        ));
    }

    /**
     * getName function.
     *
     * @access public
     */
    public function getName()
    {
        return 'ccm_news_widget_image_type';
    }
}