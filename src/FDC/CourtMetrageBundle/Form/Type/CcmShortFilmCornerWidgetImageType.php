<?php

namespace FDC\CourtMetrageBundle\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

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
    private $imageAdmin;

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

    public function setImageAdmin($imageAdmin)
    {
        $this->imageAdmin = $imageAdmin;
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
        $builder->add('file', 'sonata_type_model_list', array(
            'sonata_field_description' => $this->admin->getFormFieldDescriptions()['file'],
            'model_manager'            => $this->imageAdmin->getModelManager(),
            'class'                    => $this->imageAdmin->getClass(),
            'label'                    => false,
            'constraints'              => [
                new NotBlank()
            ]
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