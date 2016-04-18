<?php

namespace Base\AdminBundle\Form\Type;

use Doctrine\ORM\EntityRepository;

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
                'placeholder' => '',
                'label' => 'form.settings.festival',
                'class' => 'BaseCoreBundle:FilmFestival',
                'property' => 'year',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ff')
                        ->orderBy('ff.year', 'DESC');
                }
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
