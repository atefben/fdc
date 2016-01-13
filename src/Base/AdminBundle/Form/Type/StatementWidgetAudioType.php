<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * StatementWidgetAudioType class.
 * 
 * \@extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class StatementWidgetAudioType extends NewsWidgetType
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
     * admin
     * 
     * @var mixed
     * @access private
     */
    private $admin;
    
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
       /* $builder->add('gallery', 'sonata_type_model', array(
            'model_manager' => $this->admin->getModelManager(),
            'class' => $this->admin->getClass()
        ));*/

      /*  $builder->add('file', 'sonata_type_model', array(
            'model_manager' => $this->admin->getModelManager(),
            'class' => $this->admin->getClass()
        ));*/
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