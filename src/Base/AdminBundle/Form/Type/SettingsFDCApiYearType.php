<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingsFDCApiYearType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('festival', 'entity', array(
                'class' => 'BaseCoreBundle:FilmFestival',
                'property' => 'year'
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
        return 'base_adminbundle_settings_fdc_api_year';
    }
}
