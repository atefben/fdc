<?php

namespace FDC\PressBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

/**
 * Class LockedContentType
 * @package FDC\EventBundle\Form\Type
 *
 */

class LockedContentType extends BaseType
{
    private $translator;

//    /**
//     * @param $translator
//     */
//    public function __construct($translator)
//    {
//        $this->translator = $translator;
//    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'FOSUserBundle'
        ));
    }


    /**
     * @return string
     */

    public function getName()
    {
        return 'fdc_press_password';
    }
}