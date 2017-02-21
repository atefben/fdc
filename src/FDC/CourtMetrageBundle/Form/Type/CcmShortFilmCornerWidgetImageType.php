<?php

namespace FDC\CourtMetrageBundle\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmShortFilmCornerWidgetImageType class.
 *
 * \@extends CcmShortFilmCornerWidgetType
 * \@company Ohwee
 */
class CcmShortFilmCornerWidgetImageType extends CcmShortFilmCornerWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidgetImage')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidgetImage';

    /**
     * newsWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var mixed
     */
    private $galleryAdmin;

    /**
     * sonataAdmin function.
     *
     * @access public
     * @param mixed $admin
     * @return void
     */
    public function setSonataAdmin($admin)
    {
        $this->admin = $admin;
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
            'sonata_field_description' => $this->admin->getFormFieldDescriptions()['gallery'],
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
        return 'ccm_sfc_widget_image_type';
    }
}