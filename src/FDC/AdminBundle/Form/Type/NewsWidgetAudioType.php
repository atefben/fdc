<?php

namespace FDC\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class NewsWidgetAudioType extends NewsWidgetType
{
    protected $dataClass = 'FDC\\CoreBundle\\Entity\\NewsWidgetAudio';
    
    private $admin;
    
    public function setSonataAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('file');

      /*  $builder->add('file', 'sonata_type_model', array(
            'model_manager' => $this->admin->getModelManager(),
            'class' => $this->admin->getClass()
        ));*/
    }

    public function getName()
    {
        return 'news_widget_audio_type';
    }
}