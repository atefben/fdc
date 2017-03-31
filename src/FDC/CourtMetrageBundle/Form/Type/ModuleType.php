<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmModule';

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
                )
            )
            ->add('position', 'hidden')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
               'data_class'  => $this->dataClass,
               'model_class' => $this->dataClass,
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'module_type';
    }
}
