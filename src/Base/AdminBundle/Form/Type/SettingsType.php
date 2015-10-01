<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('festivalStartsAt', 'sonata_type_datetime_picker', array(
                'label' => 'form.label_festival_starts_at',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('festivalEndsAt', 'sonata_type_datetime_picker', array(
                'label' => 'form.label_festival_ends_at',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('save', 'submit', array(
                'label' => 'form.label_save'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Base\CoreBundle\Entity\Settings',
            'translation_domain' => 'BaseAdminBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'base_adminbundle_settings';
    }
}
