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
                        'data-name' => 'name',
                    ),
                    'required' => false,
                )
            )
            ->add('object', 'text', array(
                    'attr' => array(
                        'placeholder' => 'contactUs.object',
                        'data-name' => 'object',
                    ),
                    'required' => false,
                ) 
            )
            ->add('message', 'textarea', array(
                    'attr' => array(
                        'placeholder' => 'contactUs.message',
                        'data-name' => 'message',
                        'class' => 'bigHeight'
                    ),
                    'required' => false,
                )
            )
            ->add('email', 'email', array(
                    'attr' => array(
                        'placeholder' => 'contactUs.email',
                        'data-name' => 'email'
                    ),
                    'required' => false,
                )
            )
            ->add('select', 'choice', array(
                'attr' => array(
                    'data-name' => 'select',
                    'class' => 'selection',
                    'size' => 8,
                    'onclick' => "$(this).hide().closest('div').find('input').val($(this).find('option:selected').text());"
                ),
                'required' => false,
                'choices' => $this->contactSubjects,
                'empty_value' => false,
            ));
    }

    public function getName()
    {
        return 'contact_form_type';
    }
}