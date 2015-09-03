<?php

namespace FDC\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * NewsWidgetTextType class.
 * 
 * @extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class NewsWidgetTextType extends NewsWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'FDC\CoreBundle\Entity\NewsWidgetText')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CoreBundle\Entity\NewsWidgetText';
    
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
        $builder->add('content', 'ckeditor');
    }
    
    /**
     * getName function.
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'news_widget_text_type';
    }
}