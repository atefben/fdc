<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * InfoWidgetVideoType class.
 * 
 * \@extends InfoWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class InfoWidgetVideoType extends InfoWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\\CoreBundle\\Entity\\InfoWidgetVideo')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\InfoWidgetVideo';

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
        return 'info_widget_video_type';
    }
}