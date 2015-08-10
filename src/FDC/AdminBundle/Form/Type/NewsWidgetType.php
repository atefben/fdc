<?php

namespace FDC\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsWidgetType extends BaseType
{
    protected $dataClass = 'FDC\CoreBundle\Entity\NewsWidget';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('position');
        $builder->add('_type', 'hidden', array(
            'data'   => $this->getName(),
            'mapped' => false
        ));
        
        $builder->add('translations', 'a2lix_translations');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'  => $this->dataClass,
            'model_class' => $this->dataClass,
        ));
    }

    public function getName()
    {
        return 'news_widget_type';
    }
}