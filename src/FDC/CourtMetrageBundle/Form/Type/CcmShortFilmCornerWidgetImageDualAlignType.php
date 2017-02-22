<?php

namespace FDC\CourtMetrageBundle\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;
/**
 * CcmShortFilmCornerWidgetImageDualAlignType class.
 *
 * \@extends CcmShortFilmCornerWidgetType
 * \@company Ohwee
 */
class CcmShortFilmCornerWidgetImageDualAlignType extends CcmShortFilmCornerWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidgetImageDualAlign')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidgetImageDualAlign';

    /**
     * ccmNewsWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var mixed
     */
    private $galleryDualAlignDummyAdmin;

    /**
     * setNewsWidgetImageDummyAdmin function.
     *
     * @access public
     * @param mixed $admin
     * @return void
     */
    public function setSonataAdmin($admin)
    {
        $this->admin = $admin;
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
            'sonata_field_description' => $this->admin->getFormFieldDescriptions()['gallery'],
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
        return 'ccm_sfc_widget_image_dual_align_type';
    }
}