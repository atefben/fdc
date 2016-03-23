<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * FDCPageParticipateWidgetType class.
 * 
 * \@extends BaseType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageParticipateSectionWidgetType extends BaseType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\CoreBundle\Entity\FDCPageParticipateSectionWidget')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageParticipateSectionWidget';
    
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
        return 'fdc_page_participate_section_widget_type';
    }
}