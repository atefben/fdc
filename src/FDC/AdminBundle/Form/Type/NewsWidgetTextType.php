<?php

namespace FDC\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsWidgetTextType extends NewsWidgetType
{
    protected $dataClass = 'FDC\CoreBundle\Entity\NewsWidgetText';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    public function getName()
    {
        return 'news_widget_text_type';
    }
}