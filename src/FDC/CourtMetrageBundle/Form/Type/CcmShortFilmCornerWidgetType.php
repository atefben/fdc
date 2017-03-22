<?php

namespace FDC\CourtMetrageBundle\Form\Type;


use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * CcmShortFilmCornerWidgetType class.
 * 
 * \@extends BaseType
 * \@company Ohwee
 */
class CcmShortFilmCornerWidgetType extends BaseType
{
    /**
     * dataClass
     * 
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidget')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidget';
    
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
        return 'ccm_sfc_widget_type';
    }
}