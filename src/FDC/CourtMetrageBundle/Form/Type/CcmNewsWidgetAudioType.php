<?php

namespace FDC\CourtMetrageBundle\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmNewsWidgetAudioType class.
 * 
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetAudioType extends CcmNewsWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetAudio')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetAudio';
    
    /**
     * admin
     * 
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * mediaAudioAdmin
     *
     * @var mixed
     * @access private
     */
    private $mediaAudioAdmin;
    
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

    public function setMediaAudioAdmin($mediaAudioAdmin)
    {
        $this->mediaAudioAdmin = $mediaAudioAdmin;
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
            'model_manager' => $this->mediaAudioAdmin->getModelManager(),
            'class' => $this->mediaAudioAdmin->getClass(),
            'btn_delete' => false,
            'label' => false
        ));
    }

    /**
     * getName function.
     * 
     * @access public
     */
    public function getName()
    {
        return 'ccm_news_widget_audio_type';
    }
}