<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PressCoverageWidgetType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\PressCoverageWidget';

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
            ->add('position', 'hidden')
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
                        'label'              => 'form.mdf.label.press_coverage.widget_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'source'          => array(
                        'label'              => 'form.mdf.label.press_coverage.widget_description',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'link'          => array(
                        'label'              => 'form.mdf.label.press_coverage.widget_link',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'label'    => 'form.mdf.label.press_coverage.widget_published_at',
                'translation_domain' => 'BaseAdminBundle',
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => true,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
            ))
        ;
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
        return 'press_coverage_widget_type';
    }
}
