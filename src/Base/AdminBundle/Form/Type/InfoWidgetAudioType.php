<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * InfoWidgetAudioType class.
 * 
 * \@extends InfoWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class InfoWidgetAudioType extends InfoWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\\CoreBundle\\Entity\\InfoWidgetAudio')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\InfoWidgetAudio';

    /**
     * infoWidgetAudioDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $infoWidgetAudioDummyAdmin;

    /**
     * setInfoWidgetAudioDummyAdmin function.
     *
     * @access public
     * @param mixed $infoWidgetAudioDummyAdmin
     * @return void
     */
    public function setInfoWidgetAudioDummyAdmin($infoWidgetAudioDummyAdmin)
    {
        $this->infoWidgetAudioDummyAdmin = $infoWidgetAudioDummyAdmin;
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
            'sonata_field_description' =>  $this->infoWidgetAudioDummyAdmin->getFormFieldDescriptions()['file'],
            'model_manager' => $this->infoWidgetAudioDummyAdmin->getModelManager(),
            'class' => $this->infoWidgetAudioDummyAdmin->getFormFieldDescriptions()['file']->getAssociationAdmin()->getClass()
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
        return 'info_widget_audio_type';
    }
}