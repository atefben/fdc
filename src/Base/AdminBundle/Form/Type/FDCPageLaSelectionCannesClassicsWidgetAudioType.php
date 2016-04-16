<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCPageLaSelectionCannesClassicsWidgetAudioType class.
 * 
 * \@extends FDCPageLaSelectionCannesClassicsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageLaSelectionCannesClassicsWidgetAudioType extends FDCPageLaSelectionCannesClassicsWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\\CoreBundle\\Entity\\FDCPageLaSelectionCannesClassicsWidgetAudio')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageLaSelectionCannesClassicsWidgetAudio';
    
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
     * @return void
     */
    public function getName()
    {
        return 'fdc_page_la_selection_cannes_classics_widget_audio_type';
    }
}