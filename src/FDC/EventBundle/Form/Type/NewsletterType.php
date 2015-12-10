<?php

namespace FDC\EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

/**
 * Class ContactType
 * @package FDC\EventBundle\Form\Type
 *
 */

class NewsletterType extends AbstractType
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
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => $this->translator->trans('newsletter.input.placeholder')
                ),
                'label' => false
            ));
    }


    /**
     * @return string
     */

    public function getName()
    {
        return 'newsletter';
    }
}