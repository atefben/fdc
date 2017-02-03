<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{

    private $contactSubjects;

    public function __construct($contactSubjects)
    {
        $this->contactSubjects = $contactSubjects;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                    'attr' => array(
                        'placeholder' => 'contactUs.name',
                    )
                )
            )
            ->add('object', 'text', array(
                    'attr' => array(
                        'placeholder' => 'contactUs.object',
                    )
                ) 
            )
            ->add('message', 'textarea', array(
                    'attr' => array(
                        'placeholder' => 'contactUs.message',
                    )
                )
            )
            ->add('select', 'choice', array(
                'label' => 'contactUs.select',
                'required' => false,
                'choices' => $this->contactSubjects,
            ));
    }

    public function getName()
    {
        return 'contact_form_type';
    }
}