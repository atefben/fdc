<?php

namespace FDC\EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class ContactType
 * @package FDC\EventBundle\Form\Type
 *
 */

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('select', new ChoiceType() , array(
                'choices'  => array(
                    "Selectionner un thème" => 0,
                    "Thème 1" => 1,
                    "Thème 2" => 2
                ),
                'data' => 0,
                'choice_attr' => function($val, $key, $index) {
                    if ($val == 0) {
                        return ['class' => 'default'];
                    }
                    else {
                        return ['class' => ''];
                    }
                },
                'empty_value' => false,
                'choices_as_values' => true,
                'label' => 'Votre message concerne',
                'required' => false
            ))
            ->add('name', 'text', array(
                'attr' => array(
                    'placeholder' => 'Votre nom',
                    'pattern'     => '.{2,}' //minlength
                ),
                'label' => false
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'Votre adresse email'
                ),
                'label' => false
            ))
            ->add('subject', 'text', array(
                'attr' => array(
                    'placeholder' => 'Objet',
                    'pattern'     => '.{3,}' //minlength
                )
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => 'Votre message'
                )
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */

    public function configureOptions(OptionsResolver $resolver)
    {
        $collectionConstraint = new Collection(array(
            'select' => array(
                new NotBlank(array('message' => 'Ce champs est requis.')),
                new Length(array('min' => 0))
            ),
            'name' => array(
                new NotBlank(array('message' => 'Ce champs est requis.')),
                new Length(array('min' => 2))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Ce champs est requis.')),
                new Email(array('message' => 'Adresse email invalide.'))
            ),
            'subject' => array(
                new NotBlank(array('message' => 'Ce champs est requis.')),
                new Length(array('min' => 3))
            ),
            'message' => array(
                new NotBlank(array('message' => 'Ce champs est requis.')),
                new Length(array('min' => 5))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    /**
     * @return string
     */

    public function getName()
    {
        return 'contact';
    }
}