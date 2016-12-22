<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DispatchDeServiceWidgetType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceWidget';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_type', 'hidden', array(
                'data'   => $this->getName(),
                'mapped' => false
            ))
            ->add('translations', 'a2lix_translations', array(
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.label.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'subtitle'          => array(
                        'label'              => 'form.label.subTitle',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'label'              => 'form.label.description',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'imageUrl'          => array(
                        'label'              => 'form.label.imageUrl',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'seeMoreUrl'          => array(
                        'label'              => 'form.label.seeMoreUrl',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'  => $this->dataClass,
                'model_class' => $this->dataClass,
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dispatch_de_service_widget_type';
    }
}
