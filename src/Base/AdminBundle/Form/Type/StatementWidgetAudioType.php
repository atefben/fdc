<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * StatementWidgetAudioType class.
 * 
 * \@extends StatementWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class StatementWidgetAudioType extends StatementWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\\CoreBundle\\Entity\\StatementWidgetAudio')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\StatementWidgetAudio';

    /**
     * statementWidgetAudioDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $statementWidgetAudioDummyAdmin;

    /**
     * setStatementWidgetAudioDummyAdmin function.
     *
     * @access public
     * @param mixed $statementWidgetAudioDummyAdmin
     * @return void
     */
    public function setStatementWidgetAudioDummyAdmin($statementWidgetAudioDummyAdmin)
    {
        $this->statementWidgetAudioDummyAdmin = $statementWidgetAudioDummyAdmin;
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
            'sonata_field_description' =>  $this->statementWidgetAudioDummyAdmin->getFormFieldDescriptions()['file'],
            'model_manager' => $this->statementWidgetAudioDummyAdmin->getModelManager(),
            'class' => $this->statementWidgetAudioDummyAdmin->getFormFieldDescriptions()['file']->getAssociationAdmin()->getClass()
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
        return 'statement_widget_audio_type';
    }
}