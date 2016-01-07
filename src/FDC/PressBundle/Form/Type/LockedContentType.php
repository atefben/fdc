<?php

namespace FDC\PressBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Class LockedContentType
 * @package FDC\EventBundle\Form\Type
 *
 */

class LockedContentType extends AbstractType
{
    private $translator;

    /**
     * @param $translator
     */
    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password',  new PasswordType() , array(
                'attr' => array(
                    'placeholder' => $this->translator->trans('press.header.placeholder.motdepasse')
                ),
                'label' => false
            ));

    }


    /**
     * @return string
     */

    public function getName()
    {
        return 'pressPassword';
    }
}