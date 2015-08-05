<?php

namespace FDC\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class NewsWidgetImageType extends NewsWidgetType
{
    protected $dataClass = 'FDC\\CoreBundle\\Entity\\NewsWidgetImage';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('file');
    }

    public function getName()
    {
        return 'news_widget_image_type';
    }
}