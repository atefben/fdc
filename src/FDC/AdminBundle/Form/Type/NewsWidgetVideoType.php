<?php

namespace FDC\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * NewsWidgetVideoType class.
 * 
 * @extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class NewsWidgetVideoType extends NewsWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'FDC\\CoreBundle\\Entity\\NewsWidgetVideo')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\\CoreBundle\\Entity\\NewsWidgetVideo';

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
        $builder->add('file');
    }

    /**
     * getName function.
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'news_widget_video_type';
    }
}