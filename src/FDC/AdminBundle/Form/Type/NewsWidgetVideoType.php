<?php

namespace FDC\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class NewsWidgetVideoType extends NewsWidgetType
{
    protected $dataClass = 'FDC\\CoreBundle\\Entity\\NewsWidgetVideo';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    public function getName()
    {
        return 'news_widget_video_type';
    }
}