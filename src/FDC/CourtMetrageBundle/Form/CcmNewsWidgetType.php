<?php

namespace FDC\CourtMetrageBundle\Form;


use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * CcmNewsWidgetType class.
 * 
 * \@extends BaseType
 * \@company Ohwee
 */
class CcmNewsWidgetType extends BaseType
{
    /**
     * dataClass
     * 
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidget')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidget';
    
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
        $builder
            ->add('_type', 'hidden', array(
                'data'   => $this->getName(),
                'mapped' => false
            ))
            ->add('position', 'hidden')
        ;
    }
    
    /**
     * setDefaultOptions function.
     * 
     * @access public
     * @param OptionsResolverInterface $resolver
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'  => $this->dataClass,
            'model_class' => $this->dataClass,
        ));
    }
    
    /**
     * getName function.
     * 
     * @access public
     * 
     */
    public function getName()
    {
        return 'ccm_news_widget_type';
    }
}