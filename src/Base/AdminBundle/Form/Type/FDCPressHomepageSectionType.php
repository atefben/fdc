<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * FDCPressHomepageSectionType class.
 *
 */
class FDCPressHomepageSectionType extends BaseType
{
    /**
     * dataClass
     *
     * (default value: 'Base\CoreBundle\Entity\FDCPressHomepageSection')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\FDCPressHomepageSection';

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
            ->add('position', 'integer');
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
        return 'fdc_press_homepage_section_type';
    }
}