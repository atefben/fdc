<?php

namespace FDC\EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                    'placeholder' => $this->translator->trans('footer.newsletter.placeholder.votreadresse')
                ),
                'label' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
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