<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * EventWidgetVideoType class.
 * 
 * \@extends EventWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class EventWidgetVideoType extends EventWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\\CoreBundle\\Entity\\EventWidgetVideo')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\EventWidgetVideo';

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
        return 'event_widget_video_type';
    }
}