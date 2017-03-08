<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmNewsWidgetGalleryType class.
 *
 * \@extends CcmShortFilmCornerWidgetGalleryType
 * \@company Ohwee
 */
class CcmShortFilmCornerWidgetGalleryType extends CcmShortFilmCornerWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidgetGallery')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidgetGallery';

    /**
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var mixed
     */
    private $galleryDummyAdmin;

    /**
     * @access public
     * @param mixed $admin
     * @return void
     */
    public function setSonataAdmin($admin)
    {
        $this->admin = $admin;
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
            'sonata_field_description' => $this->admin->getFormFieldDescriptions()['gallery'],
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
        return 'ccm_sfc_widget_gallery_type';
    }
}