<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * PressGuideWidgetType class.
 * 
 * \@extends BaseType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetType extends BaseType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\CoreBundle\Entity\PressDownloadSectionWidget')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidget';
    
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
                ->add('lockedContent', 'checkbox', array(
                    'required' => false,
                    'label'    => 'form.label_locked_content',
                    'translation_domain' => 'BaseAdminBundle'
                ))
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
     * @return void
     */
    public function getName()
    {
        return 'press_download_section_widget_type';
    }
}