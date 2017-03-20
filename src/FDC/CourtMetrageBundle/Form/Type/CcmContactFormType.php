<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CcmContactFormType extends AbstractType
{

    private $contactSubjects;

    public function __construct($contactSubjects)
    {
        $this->contactSubjects = array_merge(
            ['default' => 'ccm.contact.select_theme'],
            $contactSubjects
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                    'attr' => array(
                        'placeholder' => 'ccm.contact.name'
                    ),
                    'required' => false,
                )
            )
            ->add('object', 'text', array(
                    'attr' => array(
                        'placeholder' => 'ccm.contact.object'
                    ),
                    'required' => false,
                ) 
            )
            ->add('message', 'textarea', array(
                    'attr' => array(
                        'placeholder' => 'ccm.contact.message',
                        'class' => 'bigHeight'
                    ),
                    'required' => false,
                )
            )
            ->add('email', 'email', array(
                    'attr' => array(
                        'placeholder' => 'ccm.contact.email'
                    ),
                    'required' => false,
                )
            )
            ->add('select', 'choice', array(
                'attr' => array(
                    'data-name' => 'select',
                ),
                'required' => false,
                'choices' => $this->contactSubjects,
                'empty_value' => false,
                'choice_attr' => function($val) {
                    if ($val == 'default') {
                        $attr = ['class' => 'default'];
                    } else {
                        $attr = [];
                    }

                    return $attr;
                }
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ccm_contact_form_type';
    }
}