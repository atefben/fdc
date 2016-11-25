<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ServiceWidgetType
 * @package Base\AdminBundle\Form\Type
 */
class ServiceWidgetType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\ServiceWidget';

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
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'  => $this->dataClass,
            'model_class' => $this->dataClass,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'service_widget_type';
    }
}