<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MobileSettingsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('iosVersion', 'text', [
                    'required' => false,
                    'label' => 'form.mobile_settings.ios_version',
                ]
            )
            ->add('androidVersion', 'text', [
                    'required' => false,
                    'label' => 'form.mobile_settings.android_version',
                ]
            )
            ->add('countdown', 'checkbox', [
                    'required' => false,
                    'label' => 'form.mobile_settings.countdown',
                ]
            )
            ->add('countdownTime', 'datetime', [
                    'required' => false,
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                    'label' => 'form.mobile_settings.countdown_time',
                ]
            )
            ->add('mobileRedirect', 'checkbox', [
                    'required' => false,
                    'label' => 'form.mobile_settings.mobile_redirect',
                ]
            )
            ->add('mobileRedirectUrl', 'text', [
                    'required' => false,
                    'label' => 'form.mobile_settings.mobile_redirect_url',
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'BaseAdminBundle',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mobile_settings';
    }
}
