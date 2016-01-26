<?php

namespace FDC\PressBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class RegistrationType
 * @package FDC\EventBundle\Form
 *
 */

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('name');
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'fdc_press_password';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}

