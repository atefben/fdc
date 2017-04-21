<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SettingsPushFilmType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('push_film_fr_message', 'text', [
                'required' => false,
            ])
            ->add('push_film_en_message', 'text', [
                'required' => false,
            ])
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'base_adminbundle_settings_push_film';
    }
}
