<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * InfoWidgetType class.
 * 
 * \@extends BaseType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class InfoWidgetType extends BaseType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\CoreBundle\Entity\InfoWidget')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\InfoWidget';
    
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
     * @param mixed $object
     */
    public function prePersist($object)
    {

        foreach ($object->getWidgets() as $widget) {
            $object->addWidget($widget);
        }

    }

    /**
     * @param mixed $object
     */
    public function preUpdate($object)
    {

        foreach ($object->getWidgets() as $widget) {
            $object->addWidget($widget);
        }

    }


    /**
     * getName function.
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'info_widget_type';
    }
}