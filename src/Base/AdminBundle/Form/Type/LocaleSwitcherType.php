<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * LocaleSwitcherType class.
 * 
 * \@extends BaseType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class LocaleSwitcherType extends BaseType
{
    /**
     * locales
     * 
     * @var mixed
     * @access private
     */
    private $locales;
    
    /**
     * locales
     * 
     * @var mixed
     * @access private
     */
    private $localeSelected;
    
    /**
     * __construct function.
     * 
     * @access public
     * @param mixed $locales
     * @return void
     */
    public function __construct($locales, $localeSelected)
    {
        $this->locales = $locales;
        $this->localeSelected = $localeSelected;
    }

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
            ->add('locales', 'choice', array(
                'translation_domain' => 'BaseAdminBundle',
                'required' => false,
                'label' => 'label.locale_switcher',
                'choices' =>  $this->locales,
                'data' => $this->localeSelected,
                'attr' => array(
                    'data-sonata-select2-allow-clear' => 'false'
                )
            ))
            ->add('ok', 'submit', array(
                'label' => 'btn.submit',
                'attr' => array(
                    'class' => 'btn btn-success',
                ),
                'translation_domain' => 'BaseAdminBundle'
            ));
    }

    /**
     * getName function.
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'locale_switcher';
    }
}