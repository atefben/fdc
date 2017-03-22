<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmNewsWidgetVideoType class.
 * 
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetVideoType extends CcmNewsWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetVideo')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetVideo';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * mediaVideoAdmin
     *
     * @var mixed
     * @access private
     */
    private $mediaVideoAdmin;

    /**
     * setSonataAdmin function.
     *
     * @access public
     * @param mixed $admin
     * @return void
     */
    public function setSonataAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function setMediaVideoAdmin($mediaVideoAdmin)
    {
        $this->mediaVideoAdmin = $mediaVideoAdmin;
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
            'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['file'],
            'model_manager' => $this->mediaVideoAdmin->getModelManager(),
            'class' => $this->mediaVideoAdmin->getClass(),
            'btn_delete' => false,
            'label' => false
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
        return 'ccm_news_widget_video_type';
    }
}